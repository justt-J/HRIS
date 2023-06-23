<?php

if (empty($_POST["user_name"])) {
    die("username is required");
}

if (empty($_POST["full_name"])) {
    die("full name is required");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (empty($_POST["contact_number"])) {
    die("contact_number is required");
}

if (empty($_POST["department"])) {
    die("department is required");
}

if (empty($_POST["position"])) {
    die("position is required");
}

if (empty($_POST["work_status"])) {
    die("work status is required");
}

if (empty($_POST["user_type"])) {
    die("user_type is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

$data = file_get_contents("php://input");
$user = json_decode($data, true);

function getAddressFromCoordinates($latitude, $longitude, $apiKey) {
    $url = "https://api.opencagedata.com/geocode/v1/json?q=$latitude+$longitude&key=$apiKey";
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    if ($data['status']['code'] === 200) {
        $addressComponents = $data['results'][0]['components'];
        $address = $data['results'][0]['formatted'];
        return [$address, $addressComponents];
    } else {
        return false;
    }
}
$apiKey = "37dc084847004285923817bee53c4109";

// Get the address from coordinates
$result = getAddressFromCoordinates($_POST["latitude"], $_POST["longitude"], $apiKey);
[$address, $addressComponents] = $result;

date_default_timezone_set("America/New_York");
$d=mktime(date("h"), date("i"), 54, date("m"), date("d"), date("Y"));

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO users (user_name, email, full_name, position, work_status, contact_number, department,sex, user_type, date,location, dtr,action, password_hash)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ssssssssssssss",
                  $_POST["user_name"],
                  $_POST["email"],
                  $_POST["full_name"],
                  $_POST["position"],
                  $_POST["work_status"],
                  $_POST["contact_number"],
                  $_POST["department"],
                  $_POST["sex"],
                  $_POST["user_type"],
                  $_POST[date("Y-m-d h:i a", $d)],
                  $address,
                  $_POST["dtr"],
                  $_POST["action"],
                  $password_hash);
                  
if ($stmt->execute()) {

    header("Location: test_admin.php");
    exit;
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("ERROR");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}








