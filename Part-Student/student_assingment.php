<?php
session_start();
include '../template/database.php';

$uid = $_SESSION['student_id'];
$name = $_SESSION['student_name'];
$sid = $_SESSION['stu_id'];

// Define the directory where assignments will be stored
$assignmentDirectory = '../uploads/assignment/';

if (isset($_POST['uploadAssignment'])) {
    $subject = $_POST['subject'];
    $file = $_FILES['assignment'];

    // Check for file upload errors
    if ($file['error'] === UPLOAD_ERR_OK) {
        // Get the file extension
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);

        // Check if the uploaded file is either a PDF or an image (JPEG, JPG, PNG)
        if (in_array(strtolower($fileExtension), ['pdf', 'jpeg', 'jpg', 'png'])) {
            // Generate a unique file name to prevent overwriting
            $uniqueFileName = uniqid('assignment_', true) . '.' . $fileExtension;

            // Define the destination path for the assignment file
            $destination = $assignmentDirectory . $uniqueFileName;

            // Move the uploaded file to the desired location
            if (move_uploaded_file($file['tmp_name'], $destination)) {
                // Insert or update assignment data in the database
                $assignmentData = mysqli_real_escape_string($conn, $uniqueFileName);
                $sql = "SELECT id FROM Assignment WHERE stu_id = $sid";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // Update the existing assignment
                    $row = mysqli_fetch_assoc($result);
                    $assignmentId = $row['id'];
                    $updateSql = "UPDATE Assignment SET '$subject' = '$assignmentData' WHERE id = $assignmentId";

                    if (mysqli_query($conn, $updateSql)) {
                        echo "Assignment updated successfully!";
                    } else {
                        echo "Error updating assignment: " . mysqli_error($conn);
                    }
                } else {
                    // Insert a new assignment
                    $insertSql = "INSERT INTO Assignment (stu_id, $subject) VALUES ($sid, '$assignmentData')";

                    if (mysqli_query($conn, $insertSql)) {
                        echo "Assignment uploaded successfully!";
                    } else {
                        echo "Error uploading assignment: " . mysqli_error($conn);
                    }
                }
            } else {
                echo "Error uploading assignment to the server.";
            }
        } else {
            echo "Error: Please upload a PDF or an image (JPEG, JPG, PNG).";
        }
    } else {
        echo "Error uploading assignment: " . $file['error'];
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/adminHeaderFooter.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <title>HSMS - Teacher</title>

    <style>
        .profile-image {
            width: 400%;
            border-radius: 10px;
            border-color: black;
            box-shadow: 0 0 3px 0.5px rgb(40, 40, 40);
        }

        
       
    
    </style>

</head>

<body>
    <header class="header">
        <nav>
            <a href="admin_page.php"><img src="Images/logo.png" alt="HSMS"></a>
            <div class="nav-links" id="navLinks">
                <i class="ri-close-circle-fill" id="close" onclick="hideMenu()"></i>
                <ul>
                    <li><a href="studentHomePage.php">Dashboard</a></li>
                    <li><a href="update_student_profile.php">Edit Profile</a></li>
                    <li><a href="student_change_password.php">Change Password</a></li>
                    <li><a href="login.php">LOG OUT</a></li>
                </ul>
            </div>
            <i class="ri-menu-line" id="menu" onclick="showMenu()"></i>
        </nav>
    </header>
    <div class="container my-5">
        <form method="post" enctype="multipart/form-data">
            <label for="sub">Select Subject:</label>
            <select name="subject" id="sub" class="form-control">
                <option value="Bangla" name="subject">Bangla</option>
                <option value="English" name="subject">English</option>
                <option value="Math" name="subject">Math</option>
                <option value="SocialScience" name="subject">Social Science</option>
                <option value="Science" name="subject">Science</option>
                <option value="Commerce" name="subject">Commerce</option>
                <option value="Arts" name="subject">Arts</option>
                <option value="PhysicalEducation" name="subject">Physical Education</option>
                <option value="ICT" name="subject">ICT</option>
                <option value="Religion" name="subject">Religion</option>
                <option value="Agriculture" name="subject">Agriculture</option>
            </select>
            <label class="my-3">Upload your Assignment here (PDF or Image):</label>
            <input type="file" name="assignment" accept=".pdf, .jpeg, .jpg, .png" class="form-control" required>
            <button class="btn btn-secondary mt-3" name="uploadAssignment">Upload Assignment</button>
        </form>
    </div>

</body>

</html>

<?php
include('footer.html');
?>