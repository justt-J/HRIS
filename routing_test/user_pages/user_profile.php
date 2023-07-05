<?php 

//Set the session timeout for 2 seconds
$timeout = 2;

//Set the maxlifetime of the session
ini_set( "session.gc_maxlifetime", $timeout );

//Set the cookie lifetime of the session
ini_set( "session.cookie_lifetime", $timeout );
session_start();

if (isset($_SESSION["users_id"])) {
    
    $mysqli = include "connection/database.php";
    
    
    $sql = "SELECT * FROM users
            WHERE id = {$_SESSION["users_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();

    if($user['user_type'] == 'user'){

    }elseif ($user['user_type'] == 'admin'){
        header("Location: ../actions/logout.php");
        die();
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($user["name"]) ?></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="/js/validation.js" defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .center {

        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 10px;
        }
    </style>
</head>
<body>

<?php 
if (!isset($_SESSION['users_id']))
{
    header("Location: /");
    die();
}
?>
    <div class="center">
        <h1>Welcome <?= htmlspecialchars($user["user_name"]) ?> <h6><?= htmlspecialchars($user["user_type"]) ?></h6></h1>
        <p><b>Name:</b>  <?= htmlspecialchars($user["full_name"]) ?></p>
        <p><b>Email:</b> <?= htmlspecialchars($user["email"]) ?></p>
        <p><b>Department:</b> <?= htmlspecialchars($user["department"]) ?></p>
        <p><b>Position:</b> <?= htmlspecialchars($user["position"]) ?></p>
        <p><b>Work Status:</b> <?= htmlspecialchars($user["work_status"]) ?></p>
        <p><b>Location created:</b> <?= htmlspecialchars($user["location"])?></p>
        <p><b>Time Created:</b> <?= htmlspecialchars($user["date"]) ?></p>

    
    <tr>
        <td><button><a href="../actions/logout.php">LOG OUT</a></button></td>
        <td><button><a href="attendance">ATTENDANCE</a></button></td>
    </tr>
    
    </div>
    
</body>

</html>











