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
$userCollection = $myDatabase->users;

if(isset($_POST['signup']))
{
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phoneNo = $_POST['phoneNo'];
    $password = sha1($_POST['password']);
}

$data = array(
    "Firstname" => $fname,
    "lname" => $lname,
    "Email" => $email,
    "Phone Number" => $phoneNo,
    "Password" => $password
);

//insert into mongoDB Users Collection
$insert = $userCollection->insertOne($data);

if($insert){
    ?>
        <center> <h4 style="color: green;"> Successfully Registered</h4></center>
        <center><a href="../loginPage.php">Login</a></center>
    <?php
}else{
    ?>
    <center> <h4 style="color: red;"> Failed Registered</h4></center>
    <center><a href="../signupPage.php">Login</a></center>
    <?php
}

?>