<?php 
session_start();

if (isset($_SESSION["users_id"])) {
    
    $mysqli = include "../connection/database.php";
    
    
    $sql = "SELECT * FROM users
            WHERE id = {$_SESSION["users_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();

}

  




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>Document</title>
</head>
<body onload="getLocation();" onclick="getDays()">

<?php 
if (!isset($_SESSION['users_id']))
{
    header("Location: ../index.php");
    die();
}

$mysqli = include "../connection/database.php";
    $sql = "SELECT * FROM `users` WHERE id = {$_SESSION["users_id"]}";
    $result = $mysqli->query($sql);
    $row = mysqli_fetch_assoc($result);

?>
<div class="center">
    <tr>
    <td><form class="myFormIN" action="../actions/process-attendance_In.php" method="post" >
        <div>
             
            <input type="hidden" value=<?= htmlspecialchars($user["full_name"]) ?> id="full_name" name="full_name">
        </div>
        
        <div>
             
            <input type="hidden" value=<?= htmlspecialchars($user["email"]) ?> id="email" name="email">
        </div>

        <div>
             
            <input type="hidden" id="age" name="age">
        </div>
        
        <div>
             
            <input type="hidden" id="password" name="password">
        </div>
        <div>
            <input type="hidden" id="date" name="date">
            <input type="hidden" id="location" name="location">
            <input type="hidden" id="action" name="action">
            <input type="hidden" name="latitude" required value="">
            <input type="hidden" name="longitude" required value="">
        </div>     
        <div>
            
            <input type="hidden" id="password_confirmation" name="password_confirmation">
        </div>
        <button>sign in</button>

</form>
</td>
    <td ><form class="myFormOUT" action="../actions/process-attendance_Out.php" method="post">
    
    <div>
             
            <input type="hidden" value=<?= htmlspecialchars($user["full_name"]) ?> id="full_name" name="full_name">
        </div>
        
        <div>
             
            <input type="hidden" value=<?= htmlspecialchars($user["email"]) ?> id="email" name="email">
        </div>

        <div>
                 
            <input type="hidden" id="age" name="age">
        </div>
        
        <div>   
             
            <input type="hidden" id="password" name="password">
        </div>
        <div>
            <input type="hidden" id="date" name="date">
            <input type="hidden" id="location" name="location">
            <input type="hidden" id="action" name="action">
            <input type="hidden" name="latitude" required value="">
            <input type="hidden" name="longitude" required value="">
            <input class="form-control" type="hidden" name="days_worked" id="days_worked" value="<?php echo $row['days_worked'] ?>">
                    
        
        </div>     
        <div>
            
        <input type="hidden" id="password_confirmation" name="password_confirmation">
        </div>
    <label for="client">CLIENT: </label>
    <textarea id="client" name="client" rows="4" cols=auto>
    </textarea>
    <label for="dtr">Daily Time Record</label>
    <textarea id="dtr" name="dtr" rows="4" cols=auto>
    </textarea>
    <button type="submit" name="submit" id="submit">sign Out</button>
</form></td>
   </tr> 
    </div>  
<script type="text/javascript">

    function getDays(){
        let a = document.getElementById("days_worked");
        let days = a.valueAsNumber + 1;
    
        
        document.getElementById("days_worked").value = days 

    }

    $('#submit').click(function(){
            var p = $('#salary').html();
            $('#total_salary').val(p);
          });

    function getLocation(){
        if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(showPosition);
        }
    }
    function showPosition(position){
        document.querySelector('.myFormIN input[name= "latitude"]').value = position.coords.latitude;
        document.querySelector('.myFormIN input[name= "longitude"]').value = position.coords.longitude;
        document.querySelector('.myFormOUT input[name= "latitude"]').value = position.coords.latitude;
        document.querySelector('.myFormOUT input[name= "longitude"]').value = position.coords.longitude;
    }

</script>





</body>
</html>
