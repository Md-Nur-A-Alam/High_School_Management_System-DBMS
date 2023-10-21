<?php
session_start();
include '../template/teacher_header.html';
include '../template/database.php';

$uid = $_SESSION['teacher_id'];
$select = "SELECT *
            FROM users u
            LEFT JOIN teachers t ON u.id = t.user_id
            LEFT JOIN subjects s ON s.`subject_id` = t.`subject_id`
            LEFT JOIN teacher_designations td ON td.`designation_id`=t.`designation_id`
            WHERE u.id = $uid AND u.`user_type`='teacher'";

$result = mysqli_query($conn, $select);
$row = mysqli_fetch_assoc($result);
$tid = $row['teacher_id'];
$name = $row['name'];
$email = $row['email'];
$sub = $row['subject_name'];
$designation = $row['designation_name'];
$dob = $row['date_of_birth'];
$address = $row['address'];
$phoNo = $row['phone_number'];
$gender = $row['gender'];
$qualification = $row['qualification'];
$salary = $row['salary'];
$designation_id = $row['designation_id'];
$subject_id = $row['subject_id'];


if (isset($_POST['uploadProPic'])) {
    if ($_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/teacher_profile_pic'; // Directory where profile pictures are stored
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
            $updateQuery = "UPDATE teachers SET profile_pic = '$profilePicName' WHERE teacher_id = $tid";
            if (mysqli_query($conn, $updateQuery)) {
                echo "Profile picture uploaded and updated successfully.";
            } else {
                echo "Error updating profile picture: " . mysqli_error($conn);
            }
        } else {
            echo "Error uploading profile picture.";
        }
    } else {
        echo "Error: " . $_FILES['profile_pic']['error'];
    }
}
if (!empty($profilePicURL)) {
    // If a profile picture is available, display it
    $pp = '<div class="col-3">
              <div><img src="../uploads/teacher_profile_pic/' . $profilePicURL . '" class="img-thumbnail" alt="Profile Picture"></div>
              <div>Profile Picture</div>
          </div>';
} else {
    // If no profile picture is available, display a default image or a message
    $pp = '<div class="col-3">
              <div><img src="../uploads/teacher_profile_pic/default.jpg" class="img-thumbnail" alt="No Profile Picture"></div>
              <div>No Profile Picture</div>
          </div>';
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/adminHeaderFooter.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <title>HSMS - Teacher</title>
</head>

<body>
    <div class="container my-5">
        <h1>Hello <b class="text-success"><?php echo $_SESSION['teacher_name']; ?></b> sir, welcome to HSMS...</h1>
        <hr>
        <div class="row">
            <div class="col-3">
                <div><?php echo $pp; ?></div>
                <div>Profile Picture</div>
            </div>
            <div class="col-9">
                <div class="mb-3">
                    <div class="row">
                        <div class="col-3 fw-bold">Name</div>
                        <div class="col-9">: <?php echo $name; ?></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-3 fw-bold">Designation</div>
                        <div class="col-9">: <?php echo $designation; ?></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-3 fw-bold">Spatialize subject</div>
                        <div class="col-9">: <?php echo $sub; ?></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-3 fw-bold">Teacher ID</div>
                        <div class="col-9">: <?php echo $tid; ?></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-3 fw-bold">User ID</div>
                        <div class="col-9">: <?php echo $uid; ?></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-3 fw-bold">Gender</div>
                        <div class="col-9">: <?php echo $gender; ?></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-3 fw-bold">Phone No.</div>
                        <div class="col-9">: <?php echo $phoNo; ?></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-3 fw-bold">Email</div>
                        <div class="col-9">: <?php echo $email; ?></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-3 fw-bold">Date of Birth</div>
                        <div class="col-9">: <?php echo $dob; ?></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-3 fw-bold">Address</div>
                        <div class="col-9">: <?php echo $address; ?></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-3 fw-bold">Qualification</div>
                        <div class="col-9">: <?php echo $qualification; ?></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-3 fw-bold">Salary</div>
                        <div class="col-9 text-success fw-normal">: <?php echo $salary; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>
    <!-- =========== modify button here =========== -->
    <div class="container my-3 d-flex justify-content-between">
        <form method="post">
            <button class="btn btn-primary" name="uploadPP">Upload Profile Picture</button>
        </form>
    </div>
    <!-- ======== Update form here ========= -->
    <div class="container">
        <?php if (isset($_POST['uploadPP'])) {       ?>

            <hr>
            <form method="post" enctype="multipart/form-data">
                <input type="file" name="profile_pic" accept="image/*">
                <div><button class="btn btn-secondary mt-1" name="uploadProPic">Upload Picture</button></div>
            </form>



        <?php }?>


</body>

</html>

<?php
include('../template/teacher_footer.html');
?>