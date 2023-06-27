<?php
$id = $_GET["id"];

if (isset($_POST["submit"])) {
  $gross_pay = $_POST['gross_pay'];
  $phil_health = $_POST['phil_health'];
  $sss = $_POST['sss'];
  $pag_ibig = $_POST['pag_ibig'];
  $health_insurance = $_POST['health_insurance'];
  $total_salary = $_POST['total_salary'];
  $days_worked = $_POST['days_worked'];
  

  $sql = "UPDATE `users` SET `gross_pay`='$gross_pay',`phil_health`='$phil_health',`sss`='$sss' , `pag_ibig`='$pag_ibig' , `health_insurance`='$health_insurance' , `total_salary`='$total_salary' , `days_worked` = '$days_worked' WHERE id = $id";
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

<body onclick="getSalary()" onload="getSalary()">


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

        <div class="mb-3">
          <label class="form-label">Days Worked:</label>
          <input type="number" name="days_worked" id="days_worked" value="<?php echo $row['days_worked'] ?>">
        </div>  

     

        <div>
          <button type="submit" class="btn btn-success" name="submit" id="submit">Update</button>
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

          let deduc = phil_health.valueAsNumber + sss.valueAsNumber + pag_ibig.valueAsNumber + health_insurance.valueAsNumber;
          let days = a.valueAsNumber;
          let salary = gross_pay.value - deduc ;
          t_salary = salary * a.valueAsNumber;
          
          
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