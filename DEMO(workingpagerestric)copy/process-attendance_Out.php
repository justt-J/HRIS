<?php

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

$action = "LOGGED OUT";

date_default_timezone_set("America/New_York");
$d=mktime(date("h"), date("i"), 54, date("m"), date("d"), date("Y"));

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO logbook_Out (full_name, email,client,date,location, dtr,action, password_hash)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ssssssss",
                  $_POST["full_name"],
                  $_POST["email"],
                  $_POST["client"],
                  $_POST[date("Y-m-d h:i a", $d)],
                  $address,
                  $_POST["dtr"],
                  $action,
                  $password_hash);
if ($stmt->execute()) {

    header("Location: test.php");
    exit;
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("ERROR");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}








