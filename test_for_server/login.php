<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = include "connections.php";

    $sql = sprintf("SELECT * FROM user
                    WHERE username = '%s'",
                   $mysqli->real_escape_string($_POST["username"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();

    
    if ($user) {
        // $captcha = $_REQUEST['captcha'];
        // $captcharandom = $_REQUEST['captcha-rand'];

            if (password_verify($_POST["password"], $user["password_hash"])) {
                //Set the session timeout for 2 seconds
                $timeout = 300;
    
                //Set the maxlifetime of the session
                ini_set( "session.gc_maxlifetime", $timeout );
    
                //Set the cookie lifetime of the session
                ini_set( "session.cookie_lifetime", $timeout );
                session_start();
                
                session_regenerate_id();
    
                $_SESSION["user_id"] = $user["id"];
                header("location: profile.php");
                exit;
            }
    }
    
    $is_invalid = true;
};

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
    .captcha{
        width: 50%;
        background: yellow;
        text-align: center;
        font-size: 24;
        font-weight: 700;
    }
</style>
<body>
    
    <h1>LOGIN</h1>
    <br>
    
    <?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>
    
    <form method="post">
        <label for="username">username</label>
        <input type="username" placeholder="Enter your username" name="username" id="username"
               value="<?= htmlspecialchars($_POST["username"] ?? "") ?>">
        <br>
        <label for="password">Password</label>
        <input type="password" placeholder="Enter your Password" name="password" id="password">
       
        <button>Log in</button>
       
    </form>
    <button><a href="/signup.php">Sign up</a></button>
  
    
</body>
</html>








