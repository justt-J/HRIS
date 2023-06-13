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
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <form action="actions/edit.php" method="POST">

        <input type="text" value="<?php echo $fetch['Firstname'];?>" name="fname" id="fname" required=""/><br><br> 
        <input type="text" value="<?php echo $fetch['lname'];?>" name="lname" id="lname" required=""/><br><br> 
        <input type="email" value="<?php echo $fetch['Email'];?>" name="email" id="email" required=""/><br><br> 
        <input type="text" value="<?php echo $fetch['Phone Number'];?>" name="phoneNo" id="phoneNo" required=""/><br><br> 
        <input type="hidden" name="hidden_id" id="hidden_id"value="<?php echo $fetch['_id'];?>"/>
        <!-- <input type="text" placeholder="Password" name="password" id="password" required=""/><br><br>  -->
        <input type="submit" name="update" id="update" value="Update info"/><br><br> 
        
    </form>
    <a href="profile.php">Profile Page</a>
</body>
</html>
<?php } ?>
