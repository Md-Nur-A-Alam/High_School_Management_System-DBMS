<?php
session_start();
include '../template/admin_header.html';
@include '../template/database.php';
$uid = null;
$sid = null;
$name = null;
$email = null;
$class = null;
$section = null;
$blood = null;
$guardian = null;
$gPhone = null;
$dob = null;
$address = null;
$phone = null;
$gender = null;
$Up_uid = null;
$Up_sid = null;
$Up_name = null;
$Up_email = null;
$Up_class = null;
$Up_section = null;
$Up_blood = null;
$Up_guardian = null;
$Up_gPhone = null;
$Up_dob = null;
$Up_address = null;
$Up_phone = null;
$Up_gender = null;

$profilePicName = null;
$pp = '';  // Initialize the profile picture HTML variable

if (isset($_GET['detailUID'])) {
    $uid = $_GET['detailUID']; //
    $select = "SELECT *
    FROM users u
    LEFT JOIN students s ON u.id = s.user_id
    LEFT JOIN classes c ON s.`class_id` = c.`class_id`
    LEFT JOIN sections sec ON sec.`section_id`=s.`section_id`
    WHERE u.id = '$uid' AND u.`user_type`='student';";

    $result = mysqli_query($conn, $select);
    $row = mysqli_fetch_assoc($result);
    $sid = $row['student_id']; //
    $name = $row['name']; //
    $email = $row['email']; //
    $class = $row['class_name']; //
    $section = $row['section_name']; //
    $blood = $row['blood_group'];
    $guardian = $row['guardian_name'];
    $gPhone = $row['guardian_phone'];
    $rdob = $row['date_of_birth'];
    $dob = date('F j, Y', strtotime($rdob));
    $address = $row['address']; //
    $phone = $row['phone_number']; //
    $gender = $row['gender']; //

    
    $select = "SELECT class_name,
	section_name,
	spa.`class_id` AS cls,
	spa.`section_id` AS sec,
	spa.`gender`,
	spa.`phone`,
	spa.`dob`,
	spa.`blood_group`,
	spa.`guardian`,
	spa.`guardian_phone`,
	spa.`address`
    FROM users u
    INNER JOIN stu_profile_approval spa ON spa.`user_id` = u.`id`
    LEFT JOIN classes c ON spa.`class_id` = c.`class_id`
    LEFT JOIN sections sec ON sec.`section_id`=spa.`section_id`
    WHERE u.id = '$uid';";

    $profilePicName = $row['profile_pic'];
        if ($profilePicName == null) {
            $profilePicName = 'default.jpg';
        }


    $result = mysqli_query($conn, $select);
    $row = mysqli_fetch_assoc($result);
    $Up_class = $row['class_name']; //
    $Up_section = $row['section_name']; //
    $Up_blood = $row['blood_group'];
    $Up_guardian = $row['guardian'];
    $Up_gPhone = $row['guardian_phone'];
    $Up_rdob = $row['dob'];
    $Up_dob = date('F j, Y', strtotime($Up_rdob));
    $Up_address = $row['address']; //
    $Up_phone = $row['phone']; //
    $Up_gender = $row['gender']; //

    $ucls = $row['cls'];
    $usec = $row['sec'];


    
}
$pp = '<div class="col-3">
        <div><img src="../uploads/student_profile_pictures/' . $profilePicName . '" class="profile-image" alt="' . $name . '"></div>
        </div>';


if (isset($_POST['back'])) {
    header('Location: admin_student.php');
} elseif (isset($_POST['update'])) {

        $select2 = "UPDATE students
        SET
            class_id = '$ucls',
            section_id = '$usec',
            phone_number = '$Up_phone',
            gender = '$Up_gender',
            date_of_birth = '$Up_rdob',
            address = '$Up_address',
            guardian_name = '$Up_guardian',
            guardian_phone = '$Up_gPhone',
            blood_group = '$Up_blood'
        WHERE
            user_id = '$uid';";
        mysqli_query($conn, $select2);

        $delete = "DELETE FROM stu_profile_approval where user_id = $uid;";
        mysqli_query($conn, $delete);

    header('location: admin_student_details.php?detailUID=' . $uid . '');
}
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
    <title>Student Profile Approval</title>

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

    <!-- ============ show data from here ============== -->
    <div class="container my-5">
        <h2>Student information show:</h2>
        <hr>
        <div class="row">
            <div class="col-3">
                <?php echo $pp; ?>
            </div>
            <div class="col-9">
                <?php
                echo '
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-3 fw-bold">Name</div>
                            <div class="col-4">: ' . $name . '</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-3 fw-bold">Class</div>
                            <div class="col-5">: ' . $class . '</div>
                            <div class="col-4 text-primary fw-bold">to --> ' . $Up_class . '</div>
                        </div>
                    </div>
                    <div class="mb-3">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-3 fw-bold">Section</div>
                            <div class="col-5">: ' . $section . '</div>
                            <div class="col-4 text-primary fw-bold">to --> ' . $Up_section . '</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-3 fw-bold">Student ID</div>
                            <div class="col-5">: ' . $sid . '</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-3 fw-bold">User ID</div>
                            <div class="col-5">: ' . $uid . '</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-3 fw-bold">Gender</div>
                            <div class="col-5">: ' . $gender . '</div>
                            <div class="col-4 text-primary fw-bold">to --> ' . $Up_gender . '</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-3 fw-bold">Phone No.</div>
                            <div class="col-5">: ' . $phone . '</div>
                            <div class="col-4 text-primary fw-bold">to --> ' . $Up_phone . '</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-3 fw-bold">Email</div>
                            <div class="col-5">: ' . $email . '</div>                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-3 fw-bold">Date of Birth</div>
                            <div class="col-5">: ' . $dob . '</div>
                            <div class="col-4 text-primary fw-bold">to --> ' . $Up_dob . '</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-3 fw-bold">Blood Group:</div>
                            <div class="col-5">: ' . $blood . '</div>
                            <div class="col-4 text-primary fw-bold">to --> ' . $Up_blood . '</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-3 fw-bold">Guardian</div>
                            <div class="col-5">: ' . $guardian . '</div>
                            <div class="col-4 text-primary fw-bold">to --> ' . $Up_guardian . '</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-3 fw-bold">Guardian Phone</div>
                            <div class="col-5 text-success fw-normal">: ' . $gPhone . '</div>
                            <div class="col-4 text-primary fw-bold">to --> ' . $Up_gPhone . '</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-3 fw-bold">Address</div>
                            <div class="col-5">: ' . $address . '</div>
                            <div class="col-4 text-primary fw-bold">to --> ' . $Up_address . '</div>
                        </div>
                    </div>'; ?>
            </div>

            <hr>
            <!-- =========== modify button here =========== -->
            <div class="container my-3 d-flex justify-content-between">
                <form method="post">
                    <button class="btn btn-dark" name="back">Back</button>
                </form>
                <form method="post">
                    <button class="btn btn-danger" name="update">Update data</button>
                </form>

            </div>
        </div>
    </div>
    </div>
</body>

</html>

<?php
include '../template/admin_footer.html';
?>