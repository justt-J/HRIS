<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <link rel="stylesheet" href="applications.css">
   <title>Application</title>
   <style>
      /* CSS styles for your application */
   </style>
</head>
<footer>
   <div class="footer">
      <a>©2023 MITSI EMPLOYEES PROFILING. ALL RIGHTS RESERVED.</a>
   </div>
</footer>
<body>
   <header>
      <div class="text-profile">
         <h1>Application</h1>
      </div>
      <div class="text-profile">
         <h2>Employee name</h2>
      </div>
   </header>
   <div class="tabs">
      <div class="tab">
         <input type="radio" name="css-tabs" id="tab-1" checked class="tab-switch">
         <label for="tab-1" class="tab-label">APPLICANTS</label>
         <div class="tab-content">
            <div class="wrap">
               <div class="search">
                  <input type="text" id="myInput1" onkeyup="myFunction('myTable1', 'myInput1')" class="searchTerm" placeholder="Search for names.." title="Type in a name">
                  <button type="submit" class="searchButton">
                    <i class="fa fa-search"></i>
                 </button>
               </div>
            </div>
            <div class="table-wrapper-scroll-y my-custom-scrollbar">
               <table id="myTable1">
                  <?php
                  $connection = mysqli_connect("localhost", "root", "", "mitsi");

                  // Check connection
                  if (mysqli_connect_errno()) {
                     echo "Failed to connect to MySQL: " . mysqli_connect_error();
                     exit;
                  }

                  // Query to fetch data from specific columns
                  $query = "SELECT applicant_id, applicant_firstname, applicant_lastname, applicant_currentdate, filecontent FROM applicant";

                  $result = mysqli_query($connection, $query);

                  if ($result) {
                     // Loop through the result set and fetch data
                     while ($row = mysqli_fetch_assoc($result)) {
                        $applicant_id = $row['applicant_id'];
                        $applicant_firstname = $row['applicant_firstname'];
                        $applicant_lastname = $row['applicant_lastname'];
                        $applicant_currentdate = $row['applicant_currentdate'];
                        $filecontent = '';

                        // Process the fetched data as needed
                        echo "<tr>";
                        echo "<td><a href='view-resume.php?applicant_id=" . $applicant_id . "'>" . $applicant_firstname . "  " . $applicant_lastname . "</a></td>";
                        echo "<td>" . $applicant_currentdate . "</td>";
                        echo "</tr>";
                     }

                     // Free the result set
                     mysqli_free_result($result);
                  } else {
                     echo "Error executing query: " . mysqli_error($connection);
                  }

                  // Close the database connection
                  mysqli_close($connection);
                  ?>
                    <?php
                     if (isset($_GET['filecontent'])) {
                       include("view-resume.php");
                    }
                   ?>
               </table>
            </div>
         </div>
      </div>
      <div class="tab">
         <input type="radio" name="css-tabs" id="tab-2" class="tab-switch">
         <label for="tab-2" class="tab-label">FOR INTERVIEW</label>
         <div class="tab-content">
            <div class="wrap">
               <div class="search">
                  <input type="text" id="myInput2" onkeyup="myFunction('myTable2', 'myInput2')" class="searchTerm" placeholder="Search for names.." title="Type in a name">
                  <button type="submit" class="searchButton">
                    <i class="fa fa-search"></i>
                 </button>
               </div>
            </div>
            <div class="table-wrapper-scroll-y my-custom-scrollbar">
               <table id="myTable2">
               <?php
$connection = mysqli_connect("localhost", "root", "", "mitsi");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit;
}

// Query to fetch data from specific columns
$query = "SELECT interview_id, interview_firstname, interview_lastname, interview_email FROM for_interview";

$result = mysqli_query($connection, $query);

if ($result) {
  // Loop through the result set and fetch data
  while ($row = mysqli_fetch_assoc($result)) {
    $interview_id = $row['interview_id'];
    $interview_firstname = $row['interview_firstname'];
    $interview_lastname = $row['interview_lastname'];
    $interview_email = $row['interview_email']; // Added interview_email variable

    // Process the fetched data as needed
    echo "<tr>";
    echo "<td>" . $interview_firstname . "  " . $interview_lastname . "</td>";

    echo "<td>";
    echo "<form id=\"myForm\" action=\"selected.php\" method=\"GET\">";
    echo "<input type=\"hidden\" name=\"interview_email\" value=\"" . $interview_email . "\">";
    echo "<input type=\"hidden\" name=\"interview_id\" value=\"" . $interview_id . "\">";
    echo "<button type=\"submit\" onclick=\"generateSelectedEmail('" . $interview_email . "', '" . $interview_firstname . "',  '" . $interview_lastname . "')\">Selected</button>";
    echo "</form>";
    echo "</td>";

    echo "<td>";
    echo "<form id=\"myForm\" action=\"interviewdenied.php\" method=\"GET\">";
    echo "<input type=\"hidden\" name=\"interview_email\" value=\"" . $interview_email . "\">";
    echo "<input type=\"hidden\" name=\"interview_id\" value=\"" . $interview_id . "\">";
    echo "<button type=\"submit\" onclick=\"generateInterviewDeniedEmail('" . $interview_email . "', '" . $interview_firstname . "',  '" . $interview_lastname . "')\">Denied</button>";
    echo "</form>";
    echo "</td>";

    echo "</tr>";
  }

  // Free the result set
  mysqli_free_result($result);
} else {
  echo "Error executing query: " . mysqli_error($connection);
}

// Close the database connection
mysqli_close($connection);
?>

<script>
  function generateSelectedEmail(interview_email, interview_firstname, interview_lastname) {
    var recipient = interview_email;
    var subject = "Job Application";
    var body = "Ms/Mr. " + interview_firstname + " " + interview_lastname + ",\n\n" +
      "Congratulations!\n\n" +
      "We hope this email finds you well. On behalf of Massive Integrated Tech Solutions Inc., we are thrilled to inform you that you have successfully passed the interview process.\n\n" +
      "We would like to extend our appreciation for your time and effort throughout the interview process. Your qualifications, skills, and experiences align perfectly with our requirements for the position, and we were impressed by your knowledge, enthusiasm, and professionalism.\n\n" +
      "Once again, congratulations on this achievement! We are excited to have you join our team. We look forward to working together and achieving great things.\n\n" +
      "Thank you and warm regards.";

    var mailtoLink = "mailto:" + recipient + "?subject=" + encodeURIComponent(subject) + "&body=" + encodeURIComponent(body + "\n\n");

    window.location.href = mailtoLink;
  }

  function generateInterviewDeniedEmail(interview_email, interview_firstname, interview_lastname) {
    var recipient = interview_email;
    var subject = "Job Application";
    var body = "Greetings!\n\n" +
      "Ms/Mr. " + interview_firstname + " " + interview_lastname + ",\n\n" +
      "We hope this email finds you well. We wanted to take a moment to update you on the outcome of your recent job interview at Massive Integrated Tech Solutions Inc.\n\n" +
      "After careful consideration and evaluation of all candidates, we regret to inform you that we have chosen to proceed with other applicants whose qualifications more closely align with our current requirements for the position. Although your skills and experience are impressive, we had to make a difficult decision based on the specific needs of the role and the competitive pool of candidates.\n\n" +
      "We genuinely appreciate your interest in joining our organization, and we wish you the very best in your career endeavors. We will retain your application on file for future reference and will reach out should a suitable position become available.\n\n" +
      "Thank you once again for your time and interest in MITSI. We wish you success in all your future endeavors.";

    var mailtoLink = "mailto:" + recipient + "?subject=" + encodeURIComponent(subject) + "&body=" + encodeURIComponent(body);

    window.location.href = mailtoLink;
  }
</script>

               </table>
            </div>
         </div>
      </div>
      <div class="tab">
         <input type="radio" name="css-tabs" id="tab-3" class="tab-switch">
         <label for="tab-3" class="tab-label">SELECTED</label>
         <div class="tab-content">
            <div class="wrap">
               <div class="search">
                  <input type="text" id="myInput3" onkeyup="myFunction('myTable3', 'myInput3')" class="searchTerm" placeholder="Search for names.." title="Type in a name">
                  <button type="submit" class="searchButton">
                    <i class="fa fa-search"></i>
                 </button>
               </div>
            </div>
            <div class="table-wrapper-scroll-y my-custom-scrollbar">
               <table id="myTable3">
               <?php
                  $connection = mysqli_connect("localhost", "root", "", "mitsi");

                  // Check connection
                  if (mysqli_connect_errno()) {
                     echo "Failed to connect to MySQL: " . mysqli_connect_error();
                     exit;
                  }

                  // Query to fetch data from specific columns
                  $query = "SELECT selected_id, selected_firstname, selected_lastname, selected_currentdate  FROM selected";

                  $result = mysqli_query($connection, $query);

                  if ($result) {
                     // Loop through the result set and fetch data
                     while ($row = mysqli_fetch_assoc($result)) {
                        $selected_id = $row['selected_id'];
                        $selected_firstname = $row['selected_firstname'];
                        $selected_lastname = $row['selected_lastname'];
                        $selected_currentdate = $row['selected_currentdate'];
                        

                        // Process the fetched data as needed
                        echo "<tr>";
                        echo "<td>" . $selected_firstname . "  " . $selected_lastname . "</td>";
                        echo "<td>" . $selected_currentdate . "</td>";
                        echo "</tr>";
                     }

                     // Free the result set
                     mysqli_free_result($result);
                  } else {
                     echo "Error executing query: " . mysqli_error($connection);
                  }

                  // Close the database connection
                  mysqli_close($connection);
                  ?>
               </table>
            </div>
         </div>
      </div>
      <div class="tab">
         <input type="radio" name="css-tabs" id="tab-4" class="tab-switch">
         <label for="tab-4" class="tab-label">DENIED</label>
         <div class="tab-content">
            <div class="wrap">
               <div class="search">
                  <input type="text" id="myInput4" onkeyup="myFunction('myTable4', 'myInput4')" class="searchTerm" placeholder="Search for names.." title="Type in a name">
                  <button type="submit" class="searchButton">
                    <i class="fa fa-search"></i>
                 </button>
               </div>
            </div>
            <div class="table-wrapper-scroll-y my-custom-scrollbar">
               <table id="myTable4">
               <?php
                  $connection = mysqli_connect("localhost", "root", "", "mitsi");

                  // Check connection
                  if (mysqli_connect_errno()) {
                     echo "Failed to connect to MySQL: " . mysqli_connect_error();
                     exit;
                  }

                  // Query to fetch data from specific columns
                  $query = "SELECT denied_id, denied_firstname, denied_lastname, denied_currentdate FROM denied";

                  $result = mysqli_query($connection, $query);

                  if ($result) {
                     // Loop through the result set and fetch data
                     while ($row = mysqli_fetch_assoc($result)) {
                        $denied_id = $row['denied_id'];
                        $denied_firstname = $row['denied_firstname'];
                        $denied_lastname = $row['denied_lastname'];
                        $denied_currentdate = $row['denied_currentdate'];
                        

                        // Process the fetched data as needed
                        echo "<tr>";
                        echo "<td>" . $denied_firstname . "  " . $denied_lastname . "</td>";
                        echo "<td>" . $denied_currentdate . "</td>";
                        echo "</tr>";
                     }

                     // Free the result set
                     mysqli_free_result($result);
                  } else {
                     echo "Error executing query: " . mysqli_error($connection);
                  }

                  // Close the database connection
                  mysqli_close($connection);
                  ?>
                   
               </table>
            </div>
         </div>
      </div>
   </div>

   <script>
      function myFunction(tableId, inputId) {
         var input, filter, table, tr, td, i, txtValue;
         input = document.getElementById(inputId);
         filter = input.value.toUpperCase();
         table = document.getElementById(tableId);
         tr = table.getElementsByTagName("tr");
         for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
               txtValue = td.textContent || td.innerText;
               if (txtValue.toUpperCase().indexOf(filter) > -1) {
                  tr[i].style.display = "";
               } else {
                  tr[i].style.display = "none";
               }
            }
         }
      }
   </script>
</body>
</html>