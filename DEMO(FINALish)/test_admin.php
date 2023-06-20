<?php 
session_start();

if (isset($_SESSION["users_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM users
            WHERE id = {$_SESSION["users_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
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
        top: 70%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 10px;
        }
    </style>
</head>
<body>
    
    <div class="center">
        <h1>Welcome <?= htmlspecialchars($user["user_name"]) ?> <h6> -<?= htmlspecialchars($user["user_type"]) ?></h6></h1>
        <br> <br>
        <p><b>Name:</b>  <?= htmlspecialchars($user["full_name"]) ?></p>
        <p><b>Email:</b> <?= htmlspecialchars($user["email"]) ?></p>
        <p><b>Department:</b> <?= htmlspecialchars($user["department"]) ?></p>
        <p><b>Position:</b> <?= htmlspecialchars($user["position"]) ?></p>
        <p><b>Work Status:</b> <?= htmlspecialchars($user["work_status"]) ?></p>
        <p><b>Location created:</b> <?= htmlspecialchars($user["location"])?></p>
        <p><b>Time Created:</b> <?= htmlspecialchars($user["date"]) ?></p>
        <br><br><br>

    
    <tr>
        <td><button><a href="signup.php">ADD USER</a></button></td>
        <td><button><a href="attendance_list.php"> ATTENDANCE LIST</a></button></td>
        <td><button><a href="logout.php">LOG OUT</a></button></td>
    </tr>
    
    </div>
    
</body>

</html>











