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
function get_IP_address()
{
    foreach (array('HTTP_CLIENT_IP',
                   'HTTP_X_FORWARDED_FOR',
                   'HTTP_X_FORWARDED',
                   'HTTP_X_CLUSTER_CLIENT_IP',
                   'HTTP_FORWARDED_FOR',
                   'HTTP_FORWARDED',
                   'REMOTE_ADDR') as $key){
        if (array_key_exists($key, $_SERVER) === true){
            foreach (explode(',', $_SERVER[$key]) as $IPaddress){
                $IPaddress = trim($IPaddress); // Just to be safe

                if (filter_var($IPaddress,
                               FILTER_VALIDATE_IP,
                               FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)
                    !== false) {

                    return $IPaddress;
                }
            }
        }
    }
}


$ip = get_IP_address();

$loc = file_get_contents(filename:"http://ip-api.com/json$ip");

$loc_o = json_decode($loc);

$country = $loc_o -> country;
$regionName = $loc_o -> regionName;
$city = $loc_o -> city;
$lat = $loc_o -> lat;
$lon = $loc_o -> lon;

$location = $country. " " . $regionName. " " . " " . $city;

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
                  $location,
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








