<?php

//Start Session

session_start();


//create constant to store non repeating values
define('SITE', 'http://localhost/admin/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'data');



$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //databse connection

$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());// select database


 ?>
