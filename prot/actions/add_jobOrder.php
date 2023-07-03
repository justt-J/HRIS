<?php
$id = $_GET["id"];

    $mysqli = include "../connection/database.php";
    $sqli = "SELECT * FROM `users` WHERE id = $id LIMIT 1";
    $result = $mysqli->query($sqli);
    $row = mysqli_fetch_assoc($result);

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
            $sql = "INSERT INTO user_joborder (full_name, email,applicant_resume, time, filecontent) 
            VALUES (?, ?, ?, ?, ?)" ;
            $stmt = $mysqli->stmt_init();

            if ( ! $stmt->prepare($sql)) {
                die("SQL error: " . $mysqli->error);
            }
           
            
            $stmt->bind_param("sssss",   
                                $row["full_name"],
                                $row["email"],
                                $applicant_resume, 
                                date("Y-m-d h:i a"),
                                $filecontent);
        
                  
            if ($stmt->execute()) {
                header("Location: ../admin_pages/admin_profile.php");
                exit;
                
            } else {
                
                if ($mysqli->errno === 1062) {
                    die("ERROR");
                } else {
                    die($mysqli->error . " " . $mysqli->errno);
                }
            }
        } else {
            // Error moving the file
            echo "Error: Unable to move the uploaded file.";
        }
    }

?>