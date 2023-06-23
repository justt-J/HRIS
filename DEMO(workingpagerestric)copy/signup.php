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
<body onload="getLocation();">

<?php 
if (!isset($_SESSION['users_id']))
{
    header("Location: index.php");
    die();
}
?>
    
    
    <div class="center">
    <h1>Signup</h1>
    <form class="myForm" action="process-signup.php" method="post" id="signup" novalidate>
        
        <div>
            <label for="user_name">Username</label>
            <input type="text" id="user_name" name="user_name" required="">
        </div>
        
        <div>
            <label for="email">email</label>
            <input type="email" id="email" name="email" required="">
        </div>

        <div>
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" required="">
        </div>
        
        <div>
            <label for="position">Position</label>
            <input type="position" id="position" name="position" required="">
        </div>

        <label for="work_status">Work Status</label>
        <select name="work_status" id="work_status">
            <option value="regular">Regular</option>
            <option value="ireggular">Ireggular</option>
        </select>

        <div>
            <label for="department">Department</label>
            <input type="department" id="department" name="department" required="">
        </div>

        <div>
            <label for="contact_number">Contact Number</label>
            <input type="text" id="contact_number" name="contact_number" required="">
        </div>

        <label for="sex">Sex</label>
        <select name="sex" id="sex">
            <option value="male">Male</option>
            <option value="femal">Female</option>
        </select>
        
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required="">
        </div>
        <div>
            <input type="hidden" id="date" name="date">
            <input type="hidden" id="location" name="location">
            <input type="hidden" id="action" name="action">
            <input type="hidden" id="dtr" name="dtr">
        </div>     
        <div>
            <label for="password_confirmation">Repeat password</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>
        <label for="user_type">User Type</label>
        <select name="user_type">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        <input type="text" name="latitude" required value="">
        <input type="text" name="longitude" required value="">
        
        <button>Sign up</button>
    </form>
    <button> <a href="test_admin.php"> BACK</a></button>
    </div>
    <script type="text/javascript">

        function getLocation(){
            if(navigator.geolocation){
                navigator.geolocation.getCurrentPosition(showPosition);
            }
        }
        function showPosition(position){
            document.querySelector('.myForm input[name= "latitude"]').value = position.coords.latitude;
            document.querySelector('.myForm input[name= "longitude"]').value = position.coords.longitude;
        }

</script>
   
    
</body>
</html>









