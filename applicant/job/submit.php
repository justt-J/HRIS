
<?php

    $applicant_id=$_POST;
    $applicant_firstname=$_POST['txtFirstName'];
    $applicant_lastname=$_POST['txtLastName'];
    $applicant_email=$_POST['txtEmail'];
    $applicant_contact=$_POST['txtContact'];
	$Status="Pending";
    $application_time=$_POST;
    $applicant_resume=$_POST["txtFile"];

    if (isset($_FILES['pdf_file']['name']))
    {
      $file_name = $_FILES['pdf_file']['name'];
      $file_tmp = $_FILES['pdf_file']['tmp_name'];

      move_uploaded_file($file_tmp,"./pdf/".$file_name);

      $insertquery =
      "INSERT INTO pdf_data(username,filename) VALUES('$applicant_resume','$file_name')";
      $iquery = mysqli_query($con, $insertquery);
    }
    

	
	$conn = mysqli_connect ("localhost","root","","mitsi");
	// Select Database	mysql_select_db("ssmitsi", $con);
	// Specify the query to Insert Record
//	$sql = "insert into applicant(applicant_id,applicant_firstname,applicant_lastname,applicant_email,applicant_contact,applicant_resume,currentdate) values(
//'".$applicant_id."','".$applicant_firstname."','".$applicant_lastname."','".$applicant_email."',".$applicant_contact.",'".$applicant_resume."','".$currentdate."')";

$sql="insert into applicant(applicant_id,applicant_firstname,applicant_lastname,applicant_email,applicant_contact,applicant_resume,currentdate) VALUES (
    '$applicant_firstname','$applicant_lastname','$applicant_email','$applicant_contact','$applicant_resume')";
	// execute query

if($conn->connect_error){
    die('Connection Failed ; ' .$conn->connect_error);
}else{
    $stmt= $conn->prepare("insert into applicant(applicant_firstname,applicant_lastname,applicant_email,applicant_contact,applicant_resume)
    values('$applicant_firstname','$applicant_lastname','$applicant_email','$applicant_contact','$applicant_resume')");
    $stmt->execute();
    echo "<script>alert('Submitted Successfully')</script>";
    $stmt->close();
    $conn->close();
}
	// Close The Connection


?>
</body>
</html>
