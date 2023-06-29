<?php
$id = $_GET["id"];

if (isset($_POST["submit"])) {
  $holidays = $_POST['holidays'];
  $leave = $_POST['leave'];
  $gross_pay = $_POST['gross_pay'];
  $phil_health = $_POST['phil_health'];
  $sss = $_POST['sss'];
  $pag_ibig = $_POST['pag_ibig'];
  $health_insurance = $_POST['health_insurance'];
  $total_salary = $_POST['total_salary'];
  $days_worked = $_POST['days_worked'];
  

  $sql = "UPDATE `users` SET `holidays`='$holidays' , `leave`='$leave' , `gross_pay`='$gross_pay',`phil_health`='$phil_health',`sss`='$sss' , `pag_ibig`='$pag_ibig' , `health_insurance`='$health_insurance' , `total_salary`='$total_salary' , `days_worked` = '$days_worked' WHERE id = $id";
  $mysqli = include "../connection/database.php";
  $result = $mysqli->query($sql);

  if ($result) {
    header("Location: ../admin_pages/payroll_list.php?msg=Data updated successfully");
  } else {
    echo "Failed: ";
  }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">

  <title>PHP CRUD Application</title>
</head>

<body onload="getSalary()">


  <div class="container">
    <div class="text-center mb-4">
      <h3>Edit User Information</h3>
      <p class="text-muted">Click update after changing any information</p>
    </div>

    <?php
    $mysqli = include "../connection/database.php";
    $sql = "SELECT * FROM `users` WHERE id = $id LIMIT 1";
    $result = $mysqli->query($sql);
    $row = mysqli_fetch_assoc($result);
    ?>

  
    <div class="container d-flex justify-content-center">
      <form action="" method="post" style="width:50vw; min-width:300px;">
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">Full Name:</label>
            <p><?php echo $row['full_name'] ?></p>
            <!-- <input type="text" class="form-control" name="full_name" value="<?php echo $row['full_name'] ?>"> -->
          </div>

          <div class="col">
            <label class="form-label">Gross Pay:</label>
            <input type="number" class="form-control" id = "gross_pay" name="gross_pay" value="<?php echo $row['gross_pay'] ?>">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Phil Health:</label>
          <input type="number" class="form-control" id = "phil_health" name="phil_health" value="<?php echo $row['phil_health'] ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">SSS:</label>
          <input type="number" class="form-control" id = "sss" name="sss" value="<?php echo $row['sss'] ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Pag-IBIG:</label>
          <input type="number" class="form-control" id = "pag_ibig" name="pag_ibig" value="<?php echo $row['pag_ibig'] ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Health Insurance:</label>
          <input type="number" class="form-control" id = "health_insurance" name="health_insurance" value="<?php echo $row['health_insurance'] ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Salary:</label>
          <input class="form-control" type="number" name="total_salary" id="total_salary"  value="<?php echo $row['total_salary'] ?>">
          <p type="number" id="salary" name="salary"></p>
        </div>

        </div>
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

     

        <div>
          <button type="submit" class="btn btn-success" name="submit" id="submit"  onclick="getSalary()">Update</button>
          <a href="../admin_pages/payroll_list.php" class="btn btn-danger">Cancel</a>
        </div>
      </form>
    </div>
  </div>

  <script type="text/javascript">

        function getSalary(){
          let phil_health = document.getElementById("phil_health");
          let sss = document.getElementById("sss");
          let pag_ibig = document.getElementById("pag_ibig");
          let health_insurance = document.getElementById("health_insurance");
          let gross_pay = document.getElementById("gross_pay");
          let a = document.getElementById("days_worked");

    
          
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
            document.getElementById("total_salary").value = t_salary 
          
          
        }

        // $('#submit').click(function(){
        //     var p = $('#salary').html();
        //     $('#total_salary').val(p);
        //   });
  </script>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>