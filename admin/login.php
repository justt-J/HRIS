<?php

@include 'configure.php';


if(isset($_POST['submit'])){


   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = ($_POST['password']);


   $select = " SELECT * FROM admin WHERE email = '$email' && password = '$password' ";

   //executed
   $exe = mysqli_query($conn, $select);

   if(mysqli_num_rows($exe) > 0){

      $row = mysqli_fetch_array($exe);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_use'] = $row['fname'];
         header('location: admin.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_use'] = $row['fname'];
         header('location: users.php');

      }

   }else{
      $error[] = 'Incorrect email or Password!';
   }

};
?>








<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Log In</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
  </head>
  <body>
    <form action="" method="post">
   <h3>Login</h3>
   <?php
   if(isset($error)){
      foreach($error as $error){
         echo $error;
      };
   };
   ?>
   <input type="email" name="email" required placeholder="enter your email">
   <input type="password" name="password" required placeholder="enter your password">
   <input type="submit" name="submit">

</form>
  </body>
</html>
