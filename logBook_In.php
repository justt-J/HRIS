<?php 
session_start();

if(!isset($_SESSION['email'])){
    header('Location: index.php');
    exit();
}else{

    require_once  'vendor/autoload.php';

    //connect to mongoDB
    $databaseConnection = new MongoDB\Client;
        // $databaseConnection = new MongoDB\Client('mongodb://localhost:27017');

    //connecting to specific database in mongoDB
    $myDatabase = $databaseConnection->myDB;

    //connecting to user collection
    $userCollection = $myDatabase->users;

    $userEmail = $_SESSION['email'];

    $data = array(
        "Email" => $userEmail,
    );
    //fetch user form MONGODB
    $fetch = $userCollection->findOne($data);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> ATTENDANCE </title>
    <link rel="stylesheet" href="signdown.css">

<footer>
</footer>

   </head>
<body>


  <div class="wrapper">
    <h2>ATTENDANCE</h2>
    <form action="actions/actionLog_In.php" method="POST">
     
    <input type="hidden" value="<?php echo $fetch['Firstname'];?>" name="fname" id="fname" required=""/><br><br> 
        <input type="hidden" value="<?php echo $fetch['lname'];?>" name="lname" id="lname" required=""/><br><br> 
        <input type="hidden" value="<?php echo $fetch['Email'];?>" name="email" id="email" required=""/><br><br> 
        <!-- <input type="hidden" placeholder="middlename" name="mname" id="mname" required=""/> -->
        <input type="hidden" value="<?php echo $fetch['Phone Number'];?>" name="phoneNo" id="phoneNo" required=""/><br><br>
        <input type="hidden" name="hidden_id" id="hidden_id"value="<?php echo $fetch['_id'];?>"/>
        <input type="hidden" placeholder="Password" name="password" id="password" required=""/>
        <input type="Submit" name="create" id="create" value="Continue"/>
    </form>
  </div>

</body>
</html>
<?php } ?>
