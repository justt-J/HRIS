<?php
//this pulls the MongoDB Driver from vendor folder

use MongoDB\Operation\InsertOne;

    require_once  '../vendor/autoload.php';

//connect to mongoDB
    $databaseConnection = new MongoDB\Client;
    // $databaseConnection = new MongoDB\Client('mongodb://localhost:27017');

//connecting to specific database in mongoDB
    $myDatabase = $databaseConnection->myDB;

//connecting to user collection
$logCollection = $myDatabase->logBook;
function get_IP_address(){
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

// echo $loc;
$country = $loc_o -> country;
$regionName = $loc_o -> regionName;
$city = $loc_o -> city;
$lat = $loc_o -> lat;
$lon = $loc_o -> lon;
date_default_timezone_set("Asia/Manila");
$d=mktime(date("h"), date("i"), 54, date("m"), date("d"), date("Y"));
// echo "Created date is " . date("Y-m-d h:i", $d);

if(isset($_POST['create']))
{
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    // $mname = $_POST['mname'];
    $phoneNo = $_POST['phoneNo'];
    $password = sha1($_POST['password']);
}

$data = array(
    "Firstname" => $fname,
    "lname" => $lname,
    "Email" => $email,
    "Phone Number" => $phoneNo,
    "Password" => $password,
    "Country" => $country,
    "Region" => $regionName,
    "City" => $city,
    "Date" => date("Y-m-d h:i a", $d),
    "Type" => "LOGGED IN"
);

//insert into mongoDB Users Collection
$insert = $logCollection->insertOne($data);
header(('location: ../profile.php'));
exit();


?>