<?php 
$id = $_GET["id"];

if (isset($_POST["submit"])) {
  $holidays = $_POST['holidays'];
  $leave = $_POST['leave'];
  $days_worked = $_POST['days_worked'];
  

  $sql = "UPDATE `users` SET `holidays`='$holidays' , `leave`='$leave' , `days_worked`='$days_worked' WHERE id = $id";
  $mysqli = include "../connection/database.php";
  $result = $mysqli->query($sql);

  if ($result) {
    header("Location: payroll_list.php?msg=Data updated successfully");
  } else {
    echo "Failed: ";
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
<body  onload="getDays()">

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
    

     
    <button type="submit" class="btn btn-success" name="submit" id="submit" onclick="getDays()">Update</button>
    <a href="../admin_pages/payroll_list.php" class="btn btn-danger">Cancel</a>

</form>
   
    <script type="text/javascript">

        function getDays(){
            //leave
            let leave_input = document.getElementById("leave_input");
            let leave = document.getElementById("leave");
           
            let holidays_input = document.getElementById("holidays_input");
            let holidays = document.getElementById("holidays");

            let total_holidays = parseInt(holidays_input.value) + holidays.valueAsNumber
           	let total_leave = leave_input.valueAsNumber + leave.valueAsNumber;
            
            let days = document.getElementById("days_worked");
            let total_days = days.valueAsNumber + parseInt(holidays_input.value) + leave_input.valueAsNumber 
            
            document.getElementById("leave").value = total_leave; 
            document.getElementById("holidays").value = total_holidays; 
            document.getElementById("days_worked").value = total_days; 
            
        }

    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>

