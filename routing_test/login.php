<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = include "connection/database.php";

    $sql = sprintf("SELECT * FROM users
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();

    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            //Set the session timeout for 2 seconds
            $timeout = 300;

            //Set the maxlifetime of the session
            ini_set( "session.gc_maxlifetime", $timeout );

            //Set the cookie lifetime of the session
            ini_set( "session.cookie_lifetime", $timeout );
            session_start();
            
            session_regenerate_id();

            if(mysqli_num_rows($result) > 0){

                $row = mysqli_fetch_array($result);
          
                if($user['user_type'] == 'admin'){
          
                  
                   $_SESSION["users_id"] = $user["id"];
                   header('location: /admin_profile');
          
                }elseif($user['user_type'] == 'user'){
          
                
                   $_SESSION["users_id"] = $user["id"];
                   header('location: /user_profile');
          
                }
          
             }
            
    
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
<body>
    
    <h1>LOGIN</h1>
    <br>
    
    <?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>
    
    <form method="post">
        <label for="email">email</label>
        <input type="email" placeholder="Enter your Email" name="email" id="email"
               value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
        <br>
        <label for="password">Password</label>
        <input type="password" placeholder="Enter your Password" name="password" id="password">
        <br><br><br><br>    
        
        <button>Log in</button>
    </form>
  
    
</body>
</html>








