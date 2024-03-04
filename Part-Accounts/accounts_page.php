<?php
session_start();
include '../template/accounts_header.html';
include '../template/database.php';

$uid = $_SESSION['accounts_user_id'];
$select = "SELECT *
            FROM users u
            LEFT JOIN accounts a ON u.id = a.user_id
            WHERE u.id = $uid AND u.`user_type`='accounts'";

$result = mysqli_query($conn, $select);
$row = mysqli_fetch_assoc($result);
$aid = $row['account_id'];
$name = $row['name'];
$email = $row['email'];
$rdob = $row['date_of_birth'];
$dob = date('F j, Y', strtotime($rdob));
$address = $row['address'];
$phoNo = $row['phone_number'];
$gender = $row['gender'];
$qualification = $row['qualification'];
$salary = $row['salary'];
$profilePicName = $row['profile_pic'];
if ($profilePicName == null) {
    $profilePicName = 'default.jpg';
}
$error = '';
$pp = '';  // Initialize the profile picture HTML variable

if (isset($_POST['update'])) {
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $qualification = mysqli_real_escape_string($conn, $_POST['qualification']);

    $update = "UPDATE accounts
               SET 
               address = '$address',
               date_of_birth = '$dob',
               phone_number = '$phone',
               qualification = '$qualification'
               WHERE account_id = $aid";

    $result = mysqli_query($conn, $update);

    if ($result) {
        header('location: accounts_page.php');
    } else {
        // Display the MySQL error for debugging
        echo "MySQL Error: " . mysqli_error($conn);
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
        $uploadDir = '../uploads/account_profile_pic/'; // Directory where profile pictures are stored
        $tempFile = $_FILES['profile_pic']['tmp_name'];
        $profilePicName = $_FILES['profile_pic']['name'];
        $destination = $uploadDir . $profilePicName;

        // Check if a profile picture already exists and delete it
        if (file_exists($destination)) {
            unlink($destination);
        }

        // Move the uploaded file to the desired location
        if (move_uploaded_file($tempFile, $destination)) {
            // Update the 'profile_pic' column in the 'accounts' table
            $updateQuery = "UPDATE accounts SET profile_pic = '$profilePicName' WHERE account_id = $aid";
            if (mysqli_query($conn, $updateQuery)) {
                header('location: accounts_page.php');
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
        <div><img src="../uploads/account_profile_pic/' . $profilePicName . '" class="profile-image" alt="' . $name . '"></div>
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
    <title>HSMS - account</title>

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
    <div class="container">
        <h4 class="text-danger"><?php echo $error; ?></h4>
    </div>
    <div class="container my-5">
        <h1>Hello <b class="text-success"><?php echo $_SESSION['accounts_name']; ?></b> sir, welcome to HSMS...</h1>
        <hr>
        <div class="row">
            <div class="col-3">
                <?php echo $pp; ?>
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
                        <div class="col-3 fw-bold">Accounts ID</div>
                        <div class="col-9">: <?php echo $aid; ?></div>
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
        <form method="post">
            <button class="btn btn-warning" name="EditProfile">Edit Profile</button>
        </form>
        <form method="post">
            <button class="btn btn-dark" name="ChangePass">Change Password</button>
        </form>


    </div>
    <!-- ======== Update form here ========= -->
    <div class="container">
        <?php if (isset($_POST['uploadPP'])) {       ?> <!-- UPLOAD Profile picture -->

            <hr>
            <form method="post" enctype="multipart/form-data">
                <div>Rename the picture first like: <p class="text-danger"> <?php echo $aid . '.jpg or ' . $aid . '.jpeg or ' . $aid . '.png'; ?></p>
                </div>
                <input type="file" name="profile_pic" accept="image/*">
                <div><button class="btn btn-secondary mt-3" name="uploadProPic">Upload Picture</button></div>
            </form>



        <?php } elseif (isset($_POST['EditProfile'])) {       ?> <!-- UPLOAD Profile data -->


            <div class="container my-5 ">
                <form method="post">
                    <h2>Accounts information update:</h2>
                    <hr>
                    <div class="mb-3">
                        <label>Address:</label>
                        <input type="text" name="address" class="form-control" required placeholder="Enter your correct address">
                    </div>
                    <div class="mb-3">
                        <label>Phone No:</label>
                        <input type="text" name="phone" class="form-control" required placeholder="Enter your correct phone no.">
                    </div>
                    <div class="mb-3">
                        <label>Date of Birth:</label>
                        <input type="date" name="dob" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Qualification:</label>
                        <input type="text" name="qualification" class="form-control" required placeholder="Enter your correct Qualification">
                    </div>
                    <button type="submit" class="btn btn-success" name="update">Update</button>
                </form>
            </div>


        <?php } elseif (isset($_POST['ChangePass'])) {       ?> <!-- change Password -->


            <div class="container my-5 ">
                <form method="post">
                    <h2>Accounts information update:</h2>
                    <hr>
                    <div class="mb-3">
                        <label>Old Password:</label>
                        <input type="password" class="form-control" placeholder="Enter Old Password" name="Opass">
                    </div>
                    <div class="mb-3">
                        <label>New Password:</label>
                        <input type="password" class="form-control" placeholder="Enter New Password" name="Npass">
                    </div>
                    <div class="mb-3">
                        <label>Confirm Password:</label>
                        <input type="password" class="form-control" placeholder="Enter New Password again" name="Cpass">
                    </div>
                    <button type="submit" class="btn btn-success" name="changePass">Change Password</button>
                </form>
            </div>

        <?php }                                     ?>


    </div>
    <hr>
    
</body>

</html>

<?php
include('../template/Accounts_footer.html');
?>