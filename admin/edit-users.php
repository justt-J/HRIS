<?PHP 
@include 'configure.php';

if(!isset($_SESSION['admin_use'])){
  header('location: login.php');
}
  ?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Users</title>
</head>
<body>
    <div>
        <h1>Edit User</h1>

        <?php  
        
        
        //getting the data
        $id = $_GET['id'];

        $sql = "SELECT * FROM admin WHERE id=$id";

        $exe = mysqli_query($conn, $sql);

        if ($exe == TRUE) {
            $count = mysqli_num_rows($exe);



            if ($count == 1) {
                $row = mysqli_fetch_assoc($exe);

                $fname=$row['fname'];
                $email=$row['email'];
                $contact=$row['contact'];
            }

            else
            {
              header("location: ../admin.php");
            }
        }
        ?>


        <form method="post">


        <table>

        <tr>
          <td> NAME:</td>
          <td><input type="text" name="fname" value="<?php echo $fname; ?>"></td>
        </tr>

        <tr>
          <td> EMAIL:</td>
          <td><input type="email" name="email" value="<?php echo $email; ?>"></td>
        </tr>

        <tr>
          <td> CONTACT:</td>
          <td><input type="text" name="contact" value="<?php echo $contact; ?>"></td>
        </tr>

        <tr>
        <td> USER TYPE:</td>
          <td>
    <select name="user_type">
   <option value="user">User</option>
   <option value="admin">Admin</option>
    </select>
</td>
      </tr>

        <td colspan="2">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <input type="submit" name="submit" value="Update User" class="btn-second">
        </td>
        </table>

        </form>
    </div>

    <?php
    
    if(isset($_POST['submit'])) {
        $id = $_POST['id'];
        $fname = $_POST['fname'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $user_type = $_POST['user_type'];

        $sql = "UPDATE admin SET

        fname = '$fname',
        email = '$email',
        contact = '$contact',
        user_type = '$user_type'
        WHERE ID='$id'
            
        ";
   //execute sql Query
   $exe = mysqli_query($conn, $sql);

   //checking the excution of query

   if ($exe == TRUE)
   {
     //pass

     $_SESSION['update'] = "Successfully Updated";

     header("location: admin.php");

   }
   else
   {
     //failed

     $_SESSION['update'] = "Failed to Update";

     header("location: admin.php");
   }
    }
    
    ?>
</body>
</html>