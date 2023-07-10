<?php 

session_start();


if (isset($_SESSION["user_id"])) {
    
    $mysqli = include "connections.php";
    
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();

}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
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
<body onload="">


    
    
    <div class="center">
    <h1>Signup</h1>
    <form class="myForm" action="process-signup.php" method="post" id="signup" novalidate>
        
        <div>
            <label for="username">username</label>
            <input type="username" id="username" name="username" required="">
        </div>

        
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required="">
        </div>
        <div>
        
       
        </div>     
        <div>
            <label for="password_confirmation">Repeat password</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>
       
        <button>Sign up</button>
    </form>

    </div>
 
    
</body>
</html>









