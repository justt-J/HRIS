<?php
//this pulls the MongoDB Driver from vendor folder
session_start();
use MongoDB\Operation\InsertOne;
require_once  '../vendor/autoload.php';

//connect to mongoDB
$databaseConnection = new MongoDB\Client;
    // $databaseConnection = new MongoDB\Client('mongodb://localhost:27017');

//connecting to specific database in mongoDB
$myDatabase = $databaseConnection->myDB;

//connecting to user collection
$userCollection = $myDatabase->users;


if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
}

$data = array(
    "Email" => $email,
    "Password" => $password
);
//fetch user form MONGODB
$fetch = $userCollection->findOne($data);
//insert into mongoDB Users Collection

if($fetch){
    $_SESSION['email'] = $fetch['Email'];

    //redirect to the profile page
    header(('location: ../profile.php'));
    exit();
}else{
    ?> 
        <center><h4 style="color:red">User Not Found</h4></center>
        <center><a href="../index.php">Try Again</a></center>

    <?php
}
?>