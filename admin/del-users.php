<?php
  include('configure.php');


  //get the ID 
   $id = $_GET['id'];


  // create SQL Query to delete users from the database
  $sql = "DELETE FROM admin WHERE id=$id and id != 1";

  // execute
  $exe = mysqli_query($conn, $sql);

  //check the Query 
  if($exe==TRUE)
  {
    //success

    $_SESSION['del'] = "User Successfully Deleted";

    header('location: admin.php');

  }
  else
  {
    //failed

    $_SESSION['del'] = "User Failed to Deleted";


    header("location: admin.php");

  }











 ?>
