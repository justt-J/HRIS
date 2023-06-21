<?php 
    date_default_timezone_set("America/New_York");
    $d=mktime(date("h"), date("i"), 54, date("m"), date("d"), date("Y"));
    $date = date("Y-m-d", $d);


    $mysqli = require __DIR__ . "/database.php";


    session_start();

    if (isset($_SESSION["users_id"])) {
        
        $mysqli = require __DIR__ . "/database.php";
        
        $sql = "SELECT * FROM users
                WHERE id = {$_SESSION["users_id"]}";
                
        $result = $mysqli->query($sql);
        
        $user = $result->fetch_assoc();
    }




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>LOGGED IN</title>
</head>
<body>

<?php 
if (!isset($_SESSION['users_id']))
{
    header("Location: index.php");
    die();
}
?>
    <h1>ATTENDANCE LIST: LOGGED IN</h1>
    <h2>Date: <?php echo $date ?></h2>  
    <?php 
      
       // select all the user
       $sql = "SELECT * FROM logbook_in";
       //execute Query
       $result = $mysqli->query($sql);

       //check if the Query is executed
       if ($result==TRUE)
       {
         //counting rows to check weather we have the data in our database or not
         $count = mysqli_num_rows($result); 

         $sn=1; // assign value

         if($count>0) 
         {
           // pass
           while($rows=mysqli_fetch_assoc($result))
           {
             //use while loop to get all the data in our Database
             //and while loop will run as long as we have the data in our database
             $id=$rows['id'];
             $fname=$rows['full_name'];
             $email=$rows['email'];
             $date=$rows['date'];
             $location=$rows['location'];

             //now its going to display the data in the table

             ?>

             <tr>
               <br>
               <td><?php echo "Full name:",$fname; ?>      </td><br>
               <td><?php echo "Email:",$email; ?>     </td><br>
               <td><?php echo "Date logged IN:",$date; ?>     </td> <br>
               <td><?php echo "Location:", $location; ?></td> <br>
               <hr>

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

    <button> <a href="attendance_list.php">Back</a></button>
</body>
</html>