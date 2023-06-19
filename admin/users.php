<?php
@include 'configure.php';

if (!isset($_SESSION['user_use'])) {
  header('location: login.php');
}
 ?>





<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="">
      HELLO <?php echo $_SESSION['user_use']; ?>
    </div>

    <a href="logout.php">Logout</a>
  </body>
</html>
