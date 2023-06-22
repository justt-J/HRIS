<?php

session_start();

include 'C:\xampp\htdocs\applicant\includes\database.php';
error_reporting(0);

if(!isset($_SESSION['applicant_id'])){


}

else {

?>

<?php

$applicant_session = $_SESSION['applicant_id'];

$get_applicant = "select * from applicant  where applicant_email='$applicant_session'";

$run_applicant = mysqli_query($con,$get_applicant);

$row_applicant = mysqli_fetch_array($run_applicant);



    $applicant_id=$row_applicant;
    $applicant_firstname=$row_applicant['txtFirstName'];
    $applicant_lastname=$row_applicant['txtLastName'];
    $applicant_email=$row_applicant['txtEmail'];
    $applicant_contact=$row_applicant['txtContact'];
    $application_time=$row_applicant;
    $applicant_resume=$row_applicant["txtFile"];

$get_applicant = "SELECT * FROM applicant";
$run_products = mysqli_query($con,$get_applicant);
$count_products = mysqli_num_rows($run_applicant);


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




<?php

if(isset($_GET['applicants'])){

include("list-applicant.php");

}

if(isset($_GET['for interview'])){

include("list-forinterview.php");

}

if(isset($_GET['selected'])){

include("list-selected.php");

}

if(isset($_GET['denied'])){

include("list-denied.php");

}


?>



</body>


</html>

<?php } ?>