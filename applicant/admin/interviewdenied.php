<?php
session_start();

if (isset($_SESSION['interview_id'])) {
  $interview_id = $_SESSION['interview_id'];
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

if (isset($_GET['interview_id'])) {
  $interview_id = $_GET['interview_id'];

  // Query to fetch data for the specific interview from the source table
  $query = "SELECT interview_firstname, interview_lastname, interview_email, interview_contact FROM for_interview WHERE interview_id = '$interview_id'";
  $result = mysqli_query($sourceConnection, $query);

  // Check if the interview data is found
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $interview_firstname = mysqli_real_escape_string($targetConnection, $row['interview_firstname']);
    $interview_lastname = mysqli_real_escape_string($targetConnection, $row['interview_lastname']);
    $interview_email = mysqli_real_escape_string($targetConnection, $row['interview_email']);
    $interview_contact = mysqli_real_escape_string($targetConnection, $row['interview_contact']);

    // Insert the data into the target table
    $insertQuery = "INSERT INTO denied (denied_firstname, denied_lastname, denied_email, denied_contact) VALUES ('$interview_firstname', '$interview_lastname', '$interview_email', '$interview_contact')";
    mysqli_query($targetConnection, $insertQuery);

    echo "Data transferred successfully for interview ID: $interview_id";

    // Delete the transferred data from the source table
    $deleteQuery = "DELETE FROM for_interview WHERE interview_id = '$interview_id'";
    mysqli_query($sourceConnection, $deleteQuery);
  } else {
    echo "No data found for the interview ID: $interview_id";
  }
} else {
  echo "Invalid interview ID.";
}

// Close the database connections
mysqli_close($sourceConnection);
mysqli_close($targetConnection);
?>
