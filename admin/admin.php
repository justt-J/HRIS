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

if (isset($_SESSION['update']))
{
  echo $_SESSION['update'];
  unset ($_SESSION['update']);
}
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
  </head>
  <body>
    <div class="">
      HELLO ADMIN <br>
      <a href="logout.php">Log out</a> <br>
      <a href="adding-users.php">Add users</a>
    </div>

    <div>
    <table class="tbl">
      <tr>
        <th>NUMBER</th>
        <th>FULL NAME</th>
        <th>EMAIL</th>
        <th>CONTACT</th>
        <th>ACTIONS</th>
        <th>TYPE</th>
      </tr>


      <?php
          // select all the user
          $sql = "SELECT * FROM admin";
          //execute Query
          $exe = mysqli_query($conn, $sql);

          //check if the Query is executed
          if ($exe==TRUE)
          {
            //counting rows to check weather we have the data in our database or not
            $count = mysqli_num_rows($exe); 

            $sn=1; // assign value

            if($count>0) 
            {
              // pass
              while($rows=mysqli_fetch_assoc($exe))
              {
                //use while loop to get all the data in our Database
                //and while loop will run as long as we have the data in our database
                $id=$rows['id'];
                $fname=$rows['fname'];
                $email=$rows['email'];
                $contact=$rows['contact'];
                $user_type=$rows['user_type'];

                //now its going to display the data in the table

                ?>

                <tr>
                  <td><?php echo $sn++; ?></td>
                  <td><?php echo $fname; ?>      </td>
                  <td><?php echo $email; ?>     </td>
                  <td><?php echo $contact; ?>     </td>
                  <td>
                    <a href="<?php echo SITE; ?>edit-users.php?id=<?php echo $id; ?>" class="btn-second">Edit Users</a>
                    <a href="<?php echo SITE?>del-users.php?id=<?php echo $id; ?>" class="btn-danger">Delete Users</a>
                  </td>
                  <td><?php echo $user_type; ?></td>

                </tr>


                <?php
              }

            }
            else
            {
              // we dont have the data in our database
            }

          }


       ?>

    </table>
    </div>


  </body>
</html>
