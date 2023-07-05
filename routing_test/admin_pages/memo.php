<?php
$id = $_GET["id"];


if (isset($_SESSION["users_id"])) {
    
    $mysqli = include "connection/database.php";
    
    
    $sql = "SELECT * FROM users
            WHERE id = $id";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();

      
    if($user['user_type'] == 'admin'){

    }elseif ($user['user_type'] == 'user'){
        // header("Location: ../actions/logout.php");
        // die();
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
// if (!isset($id))
// {
//     header("Location: ../actions/logout.php");
//     die();
// }

    $mysqli = include "connection/database.php";
    $sql = "SELECT * FROM `users` WHERE id = $id";
    $result = $mysqli->query($sql);
    $row = mysqli_fetch_assoc($result);

?>
<div class="form-group">
    <form action="../actions/add_memo.php?id=<?php echo $row["id"] ?>" method="post"  enctype="multipart/form-data">
      
 
        <label>Add a MEMO:</label>
		<input type="file" class="form-control" id="txtFile" name="txtFile"  accept="application/pdf" required>

        
    <button type="submit" class="btn btn-success" name="submit" id="submit" value="submit">Send</button>
    </form>
    
    
							
</body>
</html>