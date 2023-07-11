<?php

if($_POST["captcha_in"]!=$_POST["captcha-rand_in"]){
        
    header( "refresh:0;url=/attendance" ); 
    echo "<script type='text/javascript'>alert('ERROR CAPTCHA');</script> ";
    // sleep(10);
    // die();
    }else{ 
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

        //sending type in DB
        $action = "LOGGED IN";

        date_default_timezone_set("America/New_York");
        $d=mktime(date("h"), date("i"), 54, date("m"), date("d"), date("Y"));


        $mysqli = include "../connection/database.php";

        //inserting into DB
        $sql = "INSERT INTO logbook_in (full_name, email,date,location,action)
                VALUES (?, ?, ?, ?, ?)";
                
        $stmt = $mysqli->stmt_init();

        if ( ! $stmt->prepare($sql)) {
            die("SQL error: " . $mysqli->error);
        }


        $stmt->bind_param("sssss",
                        $_POST["full_name"],
                        $_POST["email"],
                        $_POST[date("Y-m-d h:i a")],
                        $address,
                        $action);
                        
        if ($stmt->execute()) {

            header("Location: /user_profile");
            exit;
            
        } else {
            
            if ($mysqli->errno === 1062) {
                die("ERROR");
            } else {
                die($mysqli->error . " " . $mysqli->errno);
            }
        }
}



