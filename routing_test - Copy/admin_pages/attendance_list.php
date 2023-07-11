<?php 
session_start();
 if (isset($_SESSION["users_id"])) {
    
    $mysqli = include "connection/database.php";
    
    
    $sql = "SELECT * FROM users
            WHERE id = {$_SESSION["users_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if($user['user_type'] == 'admin'){

    }elseif ($user['user_type'] == 'user'){
        header("Location: ../actions/logout.php");
        die();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>Document</title>
</head>
<body>
<?php 
if (!isset($_SESSION['users_id']))
{
    header("Location: /");
    die();
}
?>
    
    <tr>
        <td><button><a href="/admin_profile">BACK</a></button></td>
        <td><button><a href="/attendance_list_IN"> LOGGED IN LIST</a></button></td>
        <td><button><a href="attendance_list_OUT">LOGGED OUT LIST</a></button></td>
    </tr>
</body>
</html>