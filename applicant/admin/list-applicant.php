<?php

if (isset($_SESSION["applicant_id"])) {
    
    $mysqli = require __DIR__ . "includes\database.php";
    
    $sql = "SELECT * FROM applicant
            WHERE id = {$_SESSION["applicant_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="UTF-8">
      <link rel="stylesheet" href="applications.css">
      <title>Application</title>
   </style>    
<footer>
   <div class="footer">
      <a>©2023 MITSI EMPLOYEES PROFILING. ALL RIGHTS RESERVED.</a>
   </div>
</footer>
<body>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <div class="text-profile">
      <h1>Application</h1>
   </div>
   <div class="text-profile">
      <h2>Employee name</h2>
   </div>
<div class="tabs">
      <div class="tab">
         <input type="radio" name="css-tabs" id="tab-1" checked class="tab-switch">
         <label for="tab-1" class="tab-label">APPLICANTS</label>
         <div class="tab-content">
            <div class="wrap">
               <div class="search">
                  <input type="text" class="searchTerm" placeholder="What are you looking for?">
                  <button type="submit" class="searchButton">
                    <i class="fa fa-search"></i>
                 </button>
               </div>
            </div>
            <div class="table-wrapper-scroll-y my-custom-scrollbar">
               <table>


               

                     <tr>
                        <td>First Name & Last Name</td>
                        <td>Date and Time</td>
                     </tr>

                     <td><?php echo $applicant_firstname & $applicant_lastname?></td>
                    <td><?php echo $applicant_time?></td>


                    <?php 
                

                $connection =mysqli_connect("localhost", "root","","mitsi");

                $sql = "SELECT applicant_firstname, applicant_lastname, applicant_currentdate FROM applicant";

                mysqli_query($connection,$sql);
                

                $get_applicant = "select * from applicant";

                $run_applicant = mysqli_query($connection,$get_applicant);

                $row_applicant = mysqli_fetch_array($run_applicant);

                $applicant_firstname = $row_applicant['applicant_firstname'];

                $applicant_lastname = $row_applicant['applicant_lastname'];

                $applicant_time = $row_applicant['applicant_currentdate'];

                $connection->close();

               
                 ?>

<?php
global $applicant_firstname;
global $applicant_lastname;
global $applicant_currentdate;

$applicant_firstname = 'txtFirstName';

if(!isset($applicant_firstname)){
$applicant_firstname = 'Variable firstname is not set';
}
if(!isset($applicant_lastname)){
$applicant_lastname = 'Variable lastname is not set';
}
if(!isset($applicant_currentdate)){
$applicant_lastname = 'Variable currentdate is not set';
}
echo 'First Name: ' . $applicant_firstname.'<br>';
echo 'Last Name:' . $applicant_lastname.'<br>';
echo 'Date: ' . $applicant_currentdate;
?>
               

</body>
