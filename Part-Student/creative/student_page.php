<?php
session_start();
include '../template/database.php';

$uid = $_SESSION['student_id'];
$name = $_SESSION['student_name'];

$sql="SELECT * FROM students WHERE user_id = $uid";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$sid = $row['student_id'];
$profilePicName=$row['profile_pic'];
if ($profilePicName == null) {
    $profilePicName = 'default.jpg';
}
$error = '';
$pp = '';  // Initialize the profile picture HTML variable

if (isset($_POST['update'])) {
    $class = $_POST['class'];
    $section = $_POST['section'];
    $blood = $_POST['blood'];
    $gender = $_POST['gender'];
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $guard = mysqli_real_escape_string($conn, $_POST['guard']);
    $guardPhone = mysqli_real_escape_string($conn, $_POST['guardPhone']);

    // Check if user_id exists in the table
    $checkExistence = "SELECT user_id FROM stu_profile_approval WHERE user_id = $uid";
    $result = mysqli_query($conn, $checkExistence);

    if (mysqli_num_rows($result) > 0) {
        // User_id exists, perform an update
        $update = "UPDATE stu_profile_approval
                   SET 
                   class_id = '$class',
                   section_id = '$section',
                   gender = '$gender',
                   blood_group = '$blood',
                   address = '$address',
                   dob = '$dob',
                   phone = '$phone',
                   guardian = '$guard',
                   guardian_phone = '$guardPhone'
                   WHERE user_id = $uid";

        if (mysqli_query($conn, $update)) {
            header('location: student_edit_profile.php');
        } else {
            $error = mysqli_error($conn);
        }
    } else {
        // User_id doesn't exist, perform an insert
        $insert = "INSERT INTO stu_profile_approval
                   (user_id, class_id, section_id, gender, blood_group, address, dob, phone, guardian, guardian_phone)
                   VALUES ('$uid', '$class', '$section', '$gender', '$blood', '$address', '$dob', '$phone', '$guard', '$guardPhone')";

        if (mysqli_query($conn, $insert)) {
            header('location: student_page.php');       // should be change
        } else {
            $error = mysqli_error($conn);
        }
    }
}


if (isset($_POST['changePass'])) {
    $oldPass = $_POST['Opass'];
    $newPass = $_POST['Npass'];
    $confirmPass = $_POST['Cpass'];

    // Verify the old password
    $selectPassword = "SELECT password FROM users WHERE id = $uid";
    $result = mysqli_query($conn, $selectPassword);
    $row = mysqli_fetch_assoc($result);
    $hashedOldPassword = md5($oldPass);

    if ($hashedOldPassword === $row['password']) {
        if ($newPass === $confirmPass) {
            // Hash the new password
            $hashedNewPassword = md5($newPass);

            // Update the password in the database
            $updatePasswordQuery = "UPDATE users SET password = '$hashedNewPassword' WHERE id = $uid";

            if (mysqli_query($conn, $updatePasswordQuery)) {
                $error = "Password changed successfully!";
            } else {
                $error = "Error changing password: " . mysqli_error($conn);
            }
        } else {
            $error = "New password and confirmation do not match.";
        }
    } else {
        $error = "Incorrect old password. Password not changed.";
    }
}


if (isset($_POST['uploadProPic'])) {
    if ($_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/student_profile_pictures/'; // Directory where profile pictures are stored
        $tempFile = $_FILES['profile_pic']['tmp_name'];
        $profilePicName = $_FILES['profile_pic']['name'];
        $destination = $uploadDir . $profilePicName;

        // Check if a profile picture already exists and delete it
        if (file_exists($destination)) {
            unlink($destination);
        }

        // Move the uploaded file to the desired location
        if (move_uploaded_file($tempFile, $destination)) {
            // Update the 'profile_pic' column in the 'teachers' table
            $updateQuery = "UPDATE students SET profile_pic = '$profilePicName' WHERE student_id = $sid";
            if (mysqli_query($conn, $updateQuery)) {
                header('location: student_page.php');            // should be change
            } else {
                $error = "Error updating profile picture: " . mysqli_error($conn);
            }
        } else {
            $error = "Error uploading profile picture.";
        }
    } else {
        $error = "Error: " . $_FILES['profile_pic']['error'];
    }
}

// Check if a profile picture is available, display it
$pp = '<div class="col-3">
        <div><img src="../uploads/student_profile_pictures/' . $profilePicName . '" class="profile-image" alt="' . $name . '"></div>
        </div>';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/adminHeaderFooter.css">
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
            <a href="admin_page.php"><img src="../Images/logo.png" alt="HSMS"></a>
            <div class="nav-links" id="navLinks">
                <i class="ri-close-circle-fill" id="close" onclick="hideMenu()"></i>
                <ul>
                    <li><a href="student_page.php">Edit Profile</a></li>
                    <li><a href="student_assignment.php">Assignment</a></li>
                    <li><a href="../login.php">LOG OUT</a></li>
                </ul>
            </div>
            <i class="ri-menu-line" id="menu" onclick="showMenu()"></i>
        </nav>
    </header>
    <div class="container">
        <h4 class="text-danger"><?php echo $error; ?></h4>
    </div>
    <div class="container my-5">
        <h1>Hello <b class="text-success"><?php echo $name; ?></b>, welcome to HSMS...</h1>
        <hr>
        <div class="row">
            <div class="col-4">
                <?php echo $pp; ?>
            </div>
        </div>
    </div>

    <hr>
    <!-- =========== modify button here =========== -->
    <div class="container my-3 d-flex justify-content-between">
        <form method="post">
            <button class="btn btn-primary" name="uploadPP">Upload Profile Picture</button>
        </form>
        <form method="post">
            <button class="btn btn-warning" name="EditProfile">Edit Profile</button>
        </form>


    </div>
    <!-- ======== Update form here ========= -->
    <div class="container">
        <?php if (isset($_POST['uploadPP'])) {       ?> <!-- UPLOAD Profile picture -->

            <hr>
            <form method="post" enctype="multipart/form-data">
                <div>Rename the picture first like: <p class="text-danger"> <?php echo $sid . '.jpg or ' . $sid . '.jpeg or ' . $sid . '.png'; ?></p>
                </div>
                <input type="file" name="profile_pic" accept="image/*">
                <div><button class="btn btn-secondary mt-3" name="uploadProPic">Upload Picture</button></div>
            </form>



        <?php } elseif (isset($_POST['EditProfile'])) {       ?> <!-- UPLOAD Profile data -->


            <div class="container my-5 ">
                <form method="post">
                    <h2>Student information update:</h2>
                    <hr>
                    <div class="mb-3">
                        <label>Class:</label>
                        <select name="class" class="form-control">
                            <option value="6" name="class">Class 6</option>
                            <option value="7" name="class">Class 7</option>
                            <option value="8" name="class">Class 8</option>
                            <option value="9" name="class">Class 9</option>
                            <option value="10" name="class">Class 10</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Section:</label>
                        <select name="section" class="form-control">
                            <option value="1" name="section">Section A</option>
                            <option value="2" name="section">Section B</option>
                            <option value="3" name="section">Section C</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Blood Group:</label>
                        <select name="blood" class="form-control">
                            <option value="A-" name="blood">A-</option>
                            <option value="A+" name="blood">A+</option>
                            <option value="B-" name="blood">B-</option>
                            <option value="B+" name="blood">B+</option>
                            <option value="AB-" name="blood">AB-</option>
                            <option value="O-" name="blood">O-</option>
                            <option value="O+" name="blood">O+</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Gender:</label>
                        <select name="gender" class="form-control">
                            <option value="Female" name="gender">Female </option>
                            <option value="Male" name="gender">Male </option>
                            <option value="Others" name="gender">Others </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Date of Birth:</label>
                        <input type="date" name="dob" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Address:</label>
                        <input type="text" name="address" class="form-control" required placeholder="Enter your correct address">
                    </div>
                    <div class="mb-3">
                        <label>Phone No:</label>
                        <input type="text" name="phone" class="form-control" required placeholder="Enter your correct phone no.">
                    </div>
                    <div class="mb-3">
                        <label>Guardian Name:</label>
                        <input type="text" name="guard" class="form-control" required placeholder="Enter your correct Qualification">
                    </div>
                    <div class="mb-3">
                        <label>Guardian Phone:</label>
                        <input type="text" name="guardPhone" class="form-control" required placeholder="Enter your correct Qualification">
                    </div>
                    <button type="submit" class="btn btn-success" name="update">Update</button>
                </form>
            </div>
        <?php } ?>
    </div>
    <hr>
</body>

</html>

<?php
include('../template/teacher_footer.html');
?>