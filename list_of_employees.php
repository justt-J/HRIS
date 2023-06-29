<?php 
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
    <title>HR INFORMATION</title>
    <link rel="stylesheet" href="List of employees/Home-nav.css">





<script>


function popUp(){
let popup=document.getElementById("popup");

if(popup.classList=="popup"){
 document.getElementById("popup").classList.remove('popup')
document.getElementById("popup").classList.toggle('show')

}else{
    return popup;

}


}
function close(){
    document.getElementById("popup").classList.remove('show')
    document.getElementById("popup").classList.toggle('popup')




}




</script>
  
  
    
</head>
<body >

    <header>
        
      
        <div class="HR-Information">
               <img src="List of employees/source/MITSI.png" alt="">
                 
         </div>
        <div class="menu-container">
             
               
                <a href="List of employees/source/test.html">BACK</a>
        </div>
   
    </header>


   <div class="main">
    <div class="home-section" >
        <div class="list-header">
            <h1>List of Employees</h1>
            <form id='add-data'action="">
                <button type="submit"> <p>Add New +</p></button>
            </form>
           
        </div>
        <div class="list-controller">
            <table>
                <tr >
                    <td><div class="show-entries">
                  
                        
                    </div>
                    </td>
                    <td>
                        <div class="search-bar">
                            <form action="">
                                
                                    <img src="List of employees/source/search-icon-png-21.png" alt="search-icon">
                                    <input type="text" id="search-bar" placeholder=" Search..." name="Search">
                               
                                     <button type="submit">Search</button>
                               
                                
                                
                            </form>
                          
                        </div>
                    </td>
                  
                </tr>
            </table>
            

        </div>
        <div class="employee-table">
            
            <table>
            
            <tr class="vo0">
                <th class="Employeename">Employee Name</th>
                <th class = "Em">Email</th>
                <th>Address</th>
                <th>Sex</th>
                <th>Age</th>
                <th>Contact Number</th>
                <th>Department</th>
                <th>Position</th>
                <th>Work Status</th>
                <th>Action</th>
            </tr>    
            
         
               
                <?php do{ ?>
                <tr class="vo1">
                
                    <td class="Employee-Name"><?php echo $row['Employee_Name']; ?></td>
                    <td class="Em"><?php echo $row['Email']; ?></td>
                    <td><?php echo $row['Address']; ?></td>
                    <td><?php echo $row['Sex']; ?></td>     
                    <td><?php echo $row['Contact']; ?></td>
                    <td><?php echo $row['Department']; ?></td>
                    <td><?php echo $row['Position']; ?></td>
                    <td><?php echo $row['Work_Status']; ?></td>
                    <td class="action">
                        <div class="memo">
                    
                       <button   type="submit" onclick="popUp()" class="btn">
                        <span><img src="List of employees/source/memo-icon.png" alt=""></span>Memo
                        
                        </button>

                         <div class="popup"  id="popup">
                                
                                    
                                    
                                    
                           <form action=""method="post">


                                <button  onclick="close()" class="btn"> x </button>   

                           

                               <div class="textarea">

                                        <label for="Memo">
                                        <textarea type="text" class='Memo' placeholder="Write a Memo ..." id="memo"></textarea>
                                        </label>
                                    </div>
                                    
                                <div class="submit">
                                    <label for="submit"></label>
                                    <button type="submit" onclick="close()">Submit</button>
                                </div>
                                
                            </form>
                            


                          </div>





                           
                        </div>
                        <div class="edit"><a href=""><span><img src="List of employees/source/edit.png.png" alt=""></span>Edit</a></div>
                        <div class="print"><a href=""><span><img src="List of employees/source/print.png.jpg" alt=""></span>Print</a></div>
                    </td>
                   
                </tr><?php }while($row=$data->fetch_assoc()); ?>
                
                  
                
                
                </table>
                  
                
    
            
          
           
        </div>

    </div>
</div>


<footer>

</footer>



    
  
</body>

</html>
