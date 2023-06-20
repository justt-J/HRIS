<?php
 @include 'configure.php';

 if (isset($_POST['submit'])) {
   // 1. Get the data

   $fname = $_POST['fname'];
   $email = $_POST['email'];
   $contact = $_POST['contact'];
   $password = $_POST['password'];
   $user_type = $_POST['user_type'];

   //2. sql query or like form to save the data to put it in our database
   $sql = "INSERT INTO admin SET
   fname = '$fname',
   email = '$email',
   contact = '$contact',
   password = '$password',
   user_type = '$user_type'
 ";

  // execute

  $exe = mysqli_query($conn, $sql) or die(mysqli_error());

  if ($exe == TRUE)
{
  //data inserted

  //create a session variable to display Message

  $_SESSION['add'] = "Adding User is a Success";

  //redirect page

  header("location: admin.php");

}
else
{
  //data failed to insert

  //create a session variable to display Message

  $_SESSION['add'] = "Adding User is not Success";

  //redirect page

  header("location: admin.php");
}

}

 ?>





<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add Users</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
  </head>
  <body>
    <h1>Add Users</h1>
<form method="post">
  <input type="text" name="fname" required placeholder="enter your name">
  <input type="email" name="email" required placeholder="enter your email">
  <input type="text" name="contact" required placeholder="enter your contact">
  <input type="password" name="password" required placeholder="enter your password">
  <select name="user_type">
   <option value="user">User</option>
   <option value="admin">Admin</option>
    </select>

  <br> <br>
  <input type="submit" name="submit">
  <a href="admin.php">Back</a>
</form>

  </body>
</html>
