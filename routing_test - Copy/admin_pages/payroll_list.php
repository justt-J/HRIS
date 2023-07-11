<?php 
session_start();

if(isset($_SESSION["users_id"])){
  
$mysqli = include "connection/database.php";
$sql = "SELECT * FROM users
        WHERE id = {$_SESSION["users_id"]}";
        
$result = $mysqli->query($sql);

$user = $result->fetch_assoc();

if($user['user_type'] == 'admin'){

}elseif ($user['user_type'] == 'user'){
    header("Location: ../actions/logout.php");
    die();
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
  

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
  <title>PHP CRUD Application</title>
</head>

<body onclick="getSalary();">
<?php 
if (!isset($_SESSION['users_id']))
{
    header("Location: /");
    die();
}
?>
  <button><a href="/admin_profile"> BACK</a></button>

  <div class="container">


    <?php
    if (isset($_GET["msg"])) {
      $msg = $_GET["msg"];
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      ' . $msg . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>
    <!-- <a href="add-new.php" class="btn btn-dark mb-3">Add New</a> -->

            <input type="hidden" id="phil_health" name="phil_health">
            <input type="hidden" id="sss" name="sss">
            <input type="hidden" id="pag_ibig" name="pag_ibig">
            <input type="hidden" id="health_insurance" name="health_insurance">
            <input type="hidden" id="gross_pay" name="gross_pay">
            <input type="hidden" id="days_worked" name="days_worked">
            <input type="hidden" id="holidays" name="holidays">
            <input type="hidden" id="leave" name="leave">
         

    <table class="table table-hover text-center">
      <thead class="table-dark">
        <tr>
          <th scope="col">Full Name</th>
          <th scope="col">Email</th>
          <th scope="col">Gross Pay</th>
          <th scope="col">Salary</th>

          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $mysqli = include "connection/database.php";
        $sql = "SELECT * FROM `users`";
        $result = $mysqli->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <tr>
            <td><?php echo $row["full_name"] ?></td>
            <td><?php echo $row["email"] ?></td>
            <td><?php echo $row["gross_pay"] ?></td>
            <td><?php echo $row["total_salary"] ?></td>
        
            <td>
              <a href="/edit_payroll?id=<?php echo $row["id"] ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
              <a href="/add_job_order?id=<?php echo $row["id"] ?>" class="link-dark"><i class="fas fa-file"></i></a>
              <a href="/add_memo?id=<?php echo $row["id"] ?>" class="link-dark"><i class="fas fa-bars"></i></a>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
          


  

</body>

</html>