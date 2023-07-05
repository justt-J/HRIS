<?php 

function iset(){
    if (isset($_SESSION["users_id"])) {
    
        $mysqli = include "../connection/database.php";
        
        
        $sql = "SELECT * FROM users
                WHERE id = {$_SESSION["users_id"]}";
                
        $result = $mysqli->query($sql);
        
        $user = $result->fetch_assoc();
        
        if($user['user_type'] == 'admin'){
    
        }elseif ($user['user_type'] == 'user'){
            header("Location: ../index.php");
            die();
        }
    }
    
}

?>