<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>View Resume</title>
  <style media="screen">
    embed {
      border: 2px solid black;
      margin-top: 30px;
    }
  </style>
</head>
<body>
  <div class="div1">
    <?php
    if (isset($_GET['applicant_id'])) {
      $applicant_id = $_GET['applicant_id'];
      $connection = mysqli_connect("localhost", "root", "", "mitsi");

      // Check connection
      if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit;
      }

      // Query to fetch data including file content
      $query = "SELECT applicant_resume, filecontent, applicant_email, applicant_firstname, applicant_lastname FROM applicant WHERE applicant_id = $applicant_id";
      $result = mysqli_query($connection, $query);

      if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $applicant_resume = $row['applicant_resume'];
        $filecontent = $row['filecontent'];
        $applicant_email = $row['applicant_email'];
        $first_name = $row['applicant_firstname'];
        $last_name = $row['applicant_lastname'];

        // Check if the file content exists
        if (!empty($filecontent)) {
          // Output the file content
          echo "<embed src='data:application/pdf;base64," . base64_encode($filecontent) . "' width='800px' height='600px'>";

         // Output the buttons with the applicant's email
          echo "<form id=\"myForm\" action=\"forinterview.php\" method=\"GET\">";
          echo "<input type=\"hidden\" name=\"applicant_email\" value=\"" . $applicant_email . "\">";
          echo "<input type=\"hidden\" name=\"applicant_id\" value=\"" . $applicant_id . "\">";
          echo "<button type=\"submit\" onclick=\"generateInterviewEmail('" . $applicant_email . "', '" . $first_name . "', '" . $last_name . "')\">Proceed</button>";
          echo "</form>";
          
          echo "<form id=\"myForm\" action=\"denied.php\" method=\"GET\">";
          echo "<input type=\"hidden\" name=\"applicant_email\" value=\"" . $applicant_email . "\">";
          echo "<input type=\"hidden\" name=\"applicant_id\" value=\"" . $applicant_id . "\">";
          echo "<button type=\"submit\" onclick=\"generateDeniedEmail('" . $applicant_email . "', '" . $first_name . "', '" . $last_name . "')\">Denied</button>";
          echo "</form>";

        } else {
          echo "No resume found for the applicant.";
        }
      } else {
        echo "No resume found for the applicant.";
      }

      // Free the result set
      mysqli_free_result($result);

      // Close the database connection
      mysqli_close($connection);
    } else {
      echo "Invalid applicant ID.";
    }
    ?>
<script>
      function getNextValidDate() {
        const today = new Date();
        const daysToAdd = 3;

        let nextDate = new Date();
        nextDate.setDate(today.getDate() + daysToAdd);

        // Check if the next date is Sunday or a holiday, if yes, add one more day
        while (isSunday(nextDate) || isHoliday(nextDate)) {
          nextDate.setDate(nextDate.getDate() + 1);
        }

        return nextDate;
      }

      function isSunday(date) {
        return date.getDay() === 0;
      }

      function isHoliday(date) {
        const holidays = [
          // List of holiday dates (format: "DD/MM/YYYY")
          "01/01/2023", // New Year's Day
          "22/01/2023", // Lunar New Year
          "06/04/2023", // Maundy Thursday
          "07/04/2023", // Good Friday
          "09/04/2023", // Day of Valor
          "21/04/2023", // Eid al-Fitr
          "01/05/2023", // Labour Day
          "12/06/2023", // Philippines Independence Day
          "28/06/2023", // Eid al-Adha
          "28/08/2023", // National Heroes' Day
          "01/11/2023", // All Saints' Day
          "27/11/2023", // Bonifacio Day
          "08/12/2023", // Feast of the Immaculate Conception
          "25/12/2023", // Christmas
          "20/12/2023", // Rizal Day
          // Special Non-working Holiday
          "24/02/2023", // EDSA People Revolution Anniversary
          "08/04/2023", // Black Saturday
          "21/08/2023", // Ninoy Aquino Day
          "31/12/2023", // Last day of the Year
          "02/01/2023", // Additional Special (Non-Working) Day
          "02/02/2023", // Additional Special (Non-Working) Day
        ];

        const formattedDate = formatDate(date);

        return holidays.includes(formattedDate);
      }

      function formatDate(date) {
        const day = date.getDate();
        const month = date.getMonth() + 1;
        const year = date.getFullYear();

        return `${padZero(day)}/${padZero(month)}/${year}`;
      }

      function padZero(value) {
        return value.toString().padStart(2, '0');
      }

      function generateInterviewEmail(email, firstName, lastName) {
        var recipient = email;
        var subject = "Job Application";
        var body = "Ms/Mr." + " " + firstName + " " + lastName + ",\n\n" + "Congratulations!" + "\n\n" + "Please get ready for an initial interview. We are excited to speak with you and learn more about your qualifications." + "\n\n" + "Thank you for your interest in joining Massive Integrated Tech Solutions Inc. We look forward to meeting you soon.";
 
        var nextDate = getNextValidDate();
        var formattedDate = nextDate.toDateString();

        body += "\n\nThe interview is scheduled on: " + formattedDate; 
        

        var mailtoLink = "mailto:" + recipient + "?subject=" + encodeURIComponent(subject) + "&body=" + encodeURIComponent(body + "\n\n");
         
        window.location.href = mailtoLink;
      }

      function generateDeniedEmail(email, firstName, lastName) {
        var recipient = email;
        var subject = "Job Application";
        var body = "Greetings!" + "\n\n" + "Ms/Mr." + firstName + " " + lastName + ",\n\n" +
        "We regret to inform that that your application has been denied. However, we appreciate your interest in our company and encourage you to keep an eye out for future job opportunities." + "\n\n" + "Thank you again for applying to Massive Integrated Tech Solutions Inc. and we wish you all the best in your job search." + "\n\n" ;

        var mailtoLink = "mailto:" + recipient + "?subject=" + encodeURIComponent(subject) + "&body=" + encodeURIComponent(body);

        window.location.href = mailtoLink;
      }
    </script>
  </div>
</body>
</html>
