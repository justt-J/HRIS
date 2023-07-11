<?php 
$id = $_GET["id"];
session_start();
if (isset($_POST["submit"])) {
  
  $holidays = $_POST['holidays'];
  $leave = $_POST['leave'];
  $days_worked = $_POST['days_worked'];
  $total_salary = $_POST['total_salary'];
  

  $sql = "UPDATE `users` SET `holidays`='$holidays' , `leave`='$leave' , `days_worked`='$days_worked' , `total_salary`='$total_salary' WHERE id = $id";
  $mysqli = include "connection/database.php";
  $result = $mysqli->query($sql);

  if ($result) {
    header("Location: payroll_list.php?msg=Data updated successfully");
  } else {
    echo "Failed: ";
  }
}

$mysqli = include "../connection/database.php";
  
  
  $sql = "SELECT * FROM users
          WHERE id = {$_SESSION["users_id"]}";
          
  $result = $mysqli->query($sql);
  
  $user = $result->fetch_assoc();
  
  if($user['user_type'] == 'admin'){

  }elseif ($user['user_type'] == 'user'){
      header("Location: ../actions/logout.php");
      die();
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
<body >

<?php
$mysqli = include "../connection/database.php";
$sql = "SELECT * FROM `users` WHERE id = $id LIMIT 1";
$result = $mysqli->query($sql);
$row = mysqli_fetch_assoc($result);
?>

<form action="" method="post">
<div></div>
          <label class="form-label">Leave day(s):</p></label>
          <input type="number" id = "leave_input" name="leave_input" value="0" >


    
    <div class="mb-3">
        <label for="holidays_input">Holiday</label>

            <select type="number" id="holidays_input">
            <option value="0">None</option>
            <option value="2">Worked</option>
            <option value="1">Not worked</option>
    </select>
    </div>
    <div class="mb-3">
          <label class="form-label">Leave:</label>
          <input type="number" class="form-control" id = "leave" name="leave" value="<?php echo $row['leave'] ?>">
    </div>

    <div class="mb-3">
          <label class="form-label">Holidays:</label>
          <input type="number" class="form-control" id = "holidays" name="holidays" value="<?php echo $row['holidays'] ?>">
    </div>

    <div class="mb-3">
          <label class="form-label">Days Worked:</label>
          <input type="number" class="form-control" id = "days_worked" name="days_worked" value="<?php echo $row['days_worked'] ?>">
    </div>

    
    <input class="form-control" type="hidden" name="gross_pay" id="gross_pay"  value="<?php echo $row['gross_pay'] ?>">
    
    <input class="form-control" type="hidden" name="total_salary" id="total_salary"  value="<?php echo $row['total_salary'] ?>">
    <input type="hidden" class="form-control" id = "phil_health" name="phil_health" value="<?php echo $row['phil_health'] ?>">
    <input type="hidden" class="form-control" id = "sss" name="sss" value="<?php echo $row['sss'] ?>">
    <input type="hidden" class="form-control" id = "pag_ibig" name="pag_ibig" value="<?php echo $row['pag_ibig'] ?>">
    <input type="hidden" class="form-control" id = "health_insurance" name="health_insurance" value="<?php echo $row['health_insurance'] ?>">
    

     
    <button type="submit" class="btn btn-success" name="submit" id="submit" onclick="getDays()">Update</button>
    <a href="../admin_pages/payroll_list.php" class="btn btn-danger">Cancel</a>

</form>
   
    <script type="text/javascript">

        function getDays(){
            let phil_health = document.getElementById("phil_health");
            let sss = document.getElementById("sss");
            let pag_ibig = document.getElementById("pag_ibig");
            let health_insurance = document.getElementById("health_insurance");
            let gross_pay = document.getElementById("gross_pay");


            //leave
            let leave_input = document.getElementById("leave_input");
            let leave = document.getElementById("leave");
           
            let holidays_input = document.getElementById("holidays_input");
            let holidays = document.getElementById("holidays");

            let total_holidays = parseInt(holidays_input.value) + holidays.valueAsNumber
           	let total_leave = leave_input.valueAsNumber + leave.valueAsNumber;
            
            let days = document.getElementById("days_worked");
            let total_days = days.valueAsNumber + parseInt(holidays_input.value) + leave_input.valueAsNumber;
            
            // let hol_leave = (parseInt(holidays_input.value) + leave_input.valueAsNumber)
            // let tsalary = document.getElementById("total_salary");
            // let sal = tsalary.value * (parseInt(holidays_input.value) + leave_input.valueAsNumber);

            let deduc = phil_health.valueAsNumber + sss.valueAsNumber + pag_ibig.valueAsNumber + health_insurance.valueAsNumber;
            let salary = gross_pay.value * (days.valueAsNumber + parseInt(holidays_input.value) + leave_input.valueAsNumber);
            let t_salary = salary - deduc;


            document.getElementById("leave").value = total_leave; 
            document.getElementById("holidays").value = total_holidays; 
            document.getElementById("days_worked").value = total_days; 
            document.getElementById("total_salary").value = t_salary; 
            
        }

    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>

