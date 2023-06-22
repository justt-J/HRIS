<?php

session_start();

include 'C:\xampp\htdocs\applicant\includes\database.php';
?>
 	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
 		<title>Job Application Form</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
 	</head>
<body>
	<div class="container">
		<main>			
			<div class="application-form">
				<h2>Add your Contact Information</h2>
				<div class="application-form-detail">					
					<form action ="submit.php" method="post">
					
						<div class="form-group">
							<label>First Name *</label>
							<input type="text" class="form-control" id="txtFirstName" name="txtFirstName" required
							name= "First Name" placeholder="Enter First Name">
						</div>
                         <div class="form-group">
							<label>Last Name *</label>
							<input type="text" class="form-control" id="txtLastName" name="txtLastName" required
							name= "Last Name" placeholder="Enter Last Name">
						</div>
						 <div class="form-group">
							<label>Email *</label>
							<input type="email" class="form-control" id="txtEmail" name="txtEmail" required
							name= "email" placeholder="Enter Email">
						</div>
						 <div class="form-group">
							<label>Contact Number *</label>
							<input type="tel" class="form-control" id="txtContact" name="txtContact"  required
							name= "Contact Number" placeholder="Enter Contact Number">
						</div>
						 <div class="form-group">
							<label>Add a resume for Employer *</label>
							<input type="file" class="form-control" id="txtFile" name="txtFile" required>
						<div>
						<tr>
                      <td colspan="2"><label>
                        <label></label>
                        <div align="center">
                          <input type="submit" name="button2" id="button2" value="Submit" />
                          </div>

						
    </div>
                      </label></td>
                    </tr>
		                </div>
		                </div>
</body>
</html>	
<?php

if(isset($_POST['submit'])){

$remoteip = $_SERVER['REMOTE_ADDR'];

if($result['success'] == 0){



	$applicant_id=$_POST['txtID'];
    $applicant_firstname=$_POST['txtFirstName'];
    $applicant_lastname=$_POST['txtLastName'];
    $applicant_email=$_POST['txtEmail'];
    $applicant_contact=$_POST['txtContact'];
	$Status="Pending";
    $CurrentDate=$_POST['txtCurrentDate'];
    $applicant_resume=$_FILES["txtFile"]["name"];


}
}
?>
