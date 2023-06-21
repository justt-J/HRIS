<?php
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
                  $location,
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








