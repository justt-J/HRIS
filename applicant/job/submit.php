<?php
$conn = mysqli_connect("localhost", "root", "", "mitsi");

if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    $applicant_firstname = $_POST['txtFirstName'];
    $applicant_lastname = $_POST['txtLastName'];
    $applicant_email = $_POST['txtEmail'];
    $applicant_contact = $_POST['txtContact'];
    $applicant_resume = $_FILES['txtFile']['name'];

    if (isset($_FILES['txtFile']['name'])) {
        $uploadedFile = $_FILES['txtFile']['tmp_name'];
        $destinationDirectory = 'C:\xampp\htdocs\applicant\admin\resume';
        $fileName = time() . '_' . $_FILES['txtFile']['name'];
        $destinationPath = $destinationDirectory . '/' . $fileName;

        // Set appropriate permissions on the destination directory
        chmod($destinationDirectory, 0755); // Adjust permissions as needed

        // Move the uploaded file to the destination directory with the unique file name
        if (move_uploaded_file($uploadedFile, $destinationPath)) {
            // Read the file content
            $filecontent = file_get_contents($destinationPath);

            // Insert the file name and content into the database
            $insertquery = "INSERT INTO applicant (applicant_firstname, applicant_lastname, applicant_email, applicant_contact, applicant_currentdate, applicant_resume, filecontent) VALUES (?, ?, ?, ?, NOW(), ?, ?)";
            $stmt = mysqli_prepare($conn, $insertquery);
            mysqli_stmt_bind_param($stmt, "ssssss", $applicant_firstname, $applicant_lastname, $applicant_email, $applicant_contact, $applicant_resume, $filecontent);
            mysqli_stmt_execute($stmt);

            echo "<script>alert('Submitted Successfully')</script>";
        } else {
            // Error moving the file
            echo "Error: Unable to move the uploaded file.";
        }
    }

    mysqli_close($conn);
}
?>
</body>
</html>
