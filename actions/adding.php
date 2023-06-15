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

if(isset($_POST['update']))
{
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phoneNo = $_POST['phoneNo'];
    $hidden_id = $_POST['hidden_id'];
    $sss = $_POST['SSS'];
    $philHealth = $_POST['philHealth'];
    $healthInsurance = $_POST['healthInsurance'];
    $pagIbig = $_POST['SSS'];
    $age = $_POST['age'];
}

$data = array('$set' => array(
    "Firstname" => $fname,
    "lname" => $lname,
    "Email" => $email,
    "Phone Number" => $phoneNo,
    "SSS" => $sss,
    "Phil Health" => $philHealth,
    "Health Insurance" => $healthInsurance,
    "Pag IBIG" => $pagIbig,
    "Age" => $age
));

//insert into mongoDB Users Collection
$update = $userCollection->updateOne(['_id' => new \MongoDB\BSON\ObjectID($hidden_id)], $data);

if($update){
   header('Location: ../profile.php');
}else{
    ?>
    <center> <h4 style="color: red;"> update Failed</h4></center>
    <center><a href="../edit-profile.php?id=<?php echo $hidden_id; ?>">Login</a></center>
    <?php
}

?>