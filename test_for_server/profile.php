<?php 
session_start();
    $mysqli = include "connections.php";
    
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($user["username"]) ?></title>
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

    <div class="center">
        <h1>Welcome <?= htmlspecialchars($user["username"]) ?> 
   

    <br><br><br><br>
    <tr>
        <td><button><a href="logout.php">LOG OUT</a></button></td>
    </tr>
    
    </div>
    
</body>

</html>











