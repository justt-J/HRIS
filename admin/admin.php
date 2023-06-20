<?php

  @include 'configure.php';


  if (!isset($_SESSION['admin_use'])) {
    header('location: login.php');
  }


  if (isset($_SESSION['add']))
{
  echo $_SESSION['add']; // displaying session message
  unset ($_SESSION['add']); //removing session message
}
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin Page</title>
  </head>
  <body>
    <div class="">
      HELLO ADMIN <br>
      <a href="logout.php">Log out</a> <br>
      <a href="adding-users.php">Add users</a>
    </div>
  </body>
</html>
