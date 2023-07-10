<?php
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
$mysqli = include "connections.php";
    

$sql = "INSERT INTO user (username, password_hash)
        VALUES (?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ss",
                  $_POST["username"],
                  $password_hash);
                  
if ($stmt->execute()) {

    header("Location: login.php");
    exit;
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("ERROR");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}








