<?php 
session_start();

if(!isset($_SESSION['email'])){
    header('Location: loginPage.php');
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

    <table>
        <tr>
            <td>Firstname: </td>
            <td><?php echo $fetch['Firstname']?></td>
        </tr>
        <tr>
            <td>Lastname: </td>
            <td><?php echo $fetch['lname']?></td>
        </tr>
        <tr>
            <td>Email: </td>
            <td><?php echo $fetch['Email']?></td>
        </tr>
        <tr>
            <td>PhoneNo: </td>
            <td><?php echo $fetch['Phone Number']?></td>
        </tr>
        <tr>
            <td><a href="edit-profile.php?id=<?php echo$fetch['_id']; ?>">Edit</a></td>
            <td><a href="logout.php">Logout</a></td>
            <td><a href="attendancePage.php">Attendance</a></td>
        </tr>
    </table>
</body>
</html>

<?php } ?>