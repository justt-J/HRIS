<?php
session_start();

if (isset($_SESSION['applicant_id'])) {
  $applicant_id = $_SESSION['applicant_id'];
}

$sourceConnection = mysqli_connect("localhost", "root", "", "mitsi");
$targetConnection = mysqli_connect("localhost", "root", "", "mitsi");

// Check source connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit;
}

// Check target connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit;
}

if (isset($_GET['applicant_id'])) {
  $applicant_id = $_GET['applicant_id'];

  // Query to fetch data for the specific applicant from the source table
  $query = "SELECT applicant_firstname, applicant_lastname, applicant_email, applicant_contact FROM applicant WHERE applicant_id = $applicant_id";
  $result = mysqli_query($sourceConnection, $query);

  // Check if the applicant data is found
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $applicant_firstname = mysqli_real_escape_string($targetConnection, $row['applicant_firstname']);
    $applicant_lastname = mysqli_real_escape_string($targetConnection, $row['applicant_lastname']);
    $applicant_email = mysqli_real_escape_string($targetConnection, $row['applicant_email']);
    $applicant_contact = mysqli_real_escape_string($targetConnection, $row['applicant_contact']);

    // Insert the data into the target table
    $insertQuery = "INSERT INTO for_interview (interview_firstname, interview_lastname, interview_email, interview_contact) VALUES ('$applicant_firstname', '$applicant_lastname', '$applicant_email', '$applicant_contact')";
    mysqli_query($targetConnection, $insertQuery);

    echo "Data transferred successfully for applicant ID: $applicant_id";

    // Delete the transferred data from the source table
    $deleteQuery = "DELETE FROM applicant WHERE applicant_id = $applicant_id";
    mysqli_query($sourceConnection, $deleteQuery);
  } else {
    echo "No data found for the applicant ID: $applicant_id";
  }
} else {
  echo "Invalid applicant ID.";
}

// Close the database connections
mysqli_close($sourceConnection);
mysqli_close($targetConnection);
?>
