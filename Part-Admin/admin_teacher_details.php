<?php
session_start();
include '../template/admin_header.html';
include '../template/database.php';

$uid = null;
$tid = null;
$name = null;
$email = null;
$sub = null;
$designation = null;
$dob = null;
$address = null;
$phoNo = null;
$gender = null;
$qualification = null;
$salary = null;
$designation_id = null;
$subject_id = null;

if (isset($_GET['detailUID'])) {
    $uid = $_GET['detailUID'];
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
}
// echo "{$uid} <br> {$tid}";


if (isset($_POST['back'])) {
    header('Location: admin_teacher.php');
} elseif (isset($_POST['update'])) {
    $designation = ($_POST['designation']);
    $sub = ($_POST['subject']);
    $gender = ($_POST['gender']);
    $salary = ($_POST['salary']);
    $phone = ($_POST['phone']);
    $dob = ($_POST['dob']);
    $user_type = 'teacher';
    $approval = '1';



    if (!$tid) {
        $insert = "INSERT INTO teachers (user_id, subject_id, designation_id, salary,gender, date_of_birth, phone_number)
            VALUES ('$uid', '$sub', '$designation', '$salary', '$gender', '$dob', '$phone');";
        mysqli_query($conn, $insert);
        echo "foreign key inserted successfully";
    } else {
        $select2 = "UPDATE teachers
        SET
            subject_id = '$sub',
            designation_id = '$designation',
            salary = '$salary',
            gender = '$gender',
            date_of_birth = '$dob',
            phone_number = '$phone'
        WHERE
            teacher_id = '$tid';";
        mysqli_query($conn, $select2);
    }
    $select1 = "UPDATE users
                SET
                    approval = '$approval'
                WHERE
                    id = '$uid'";
    mysqli_query($conn, $select1);

    header('location: admin_teacher_details.php?detailUID=' . $uid . '');
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
    <title>Admin Teacher Details</title>
</head>

<body>

    <!-- ============ show data from here ============== -->
    <?php
    echo '
    <div class="container my-5">
    <h2>Teacher information show:</h2>
            <hr>
            <div class="mb-3">
                <div class="row">
                    <div class="col-3 fw-bold">Name</div>
                    <div class="col-9">: ' . $name . '</div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-3 fw-bold">Designation</div>
                    <div class="col-9">: ' . $designation . '</div>
                </div>
            </div>
            <div class="mb-3">
            <div class="mb-3">
                <div class="row">
                    <div class="col-3 fw-bold">Spatialize subject</div>
                    <div class="col-9">: ' . $sub . '</div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-3 fw-bold">Teacher ID</div>
                    <div class="col-9">: ' . $tid . '</div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-3 fw-bold">User ID</div>
                    <div class="col-9">: ' . $uid . '</div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-3 fw-bold">Gender</div>
                    <div class="col-9">: ' . $gender . '</div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-3 fw-bold">Phone No.</div>
                    <div class="col-9">: ' . $phoNo . '</div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-3 fw-bold">Email</div>
                    <div class="col-9">: ' . $email . '</div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-3 fw-bold">Date of Birth</div>
                    <div class="col-9">: ' . $dob . '</div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-3 fw-bold">Address</div>
                    <div class="col-9">: ' . $address . '</div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-3 fw-bold">Qualification</div>
                    <div class="col-9">: ' . $qualification . '</div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-3 fw-bold">Salary</div>
                    <div class="col-9 text-success fw-normal">: ' . $salary . '</div>
                </div>
            </div>
    </div>';
    ?>
    <hr>
    <!-- =========== modify button here =========== -->
    <div class="container my-3 d-flex justify-content-between">
        <form method="post">
            <button class="btn btn-dark" name="back">Back</button>
        </form>
        <form method="post">
            <button class="btn btn-danger" name="modify">Update data</button>
        </form>

    </div>
    <!-- ======== Update form here ========= -->
    <div class="container">

        <?php
        if (isset($_POST['modify'])) {
            echo '<div class="container my-5 ">
            <form method="post">
                <h2>Teacher information update:</h2>
                <hr>
                <div class="mb-3">
                    <label>Designation:</label>
                    <select class="form-select" name="designation">
                        <option selected>Select Designation</option>
                        <option value="1" name="designation">Principal</option>
                        <option value="2" name="designation">Head Teacher</option>
                        <option value="3" name="designation">Instructor</option>
                        <option value="4" name="designation">Librarian</option>
                        <option value="5" name="designation">Counselor</option>
                    </select>

                </div>
                <div class="mb-3">
                    <label>Specialize subject:</label>
                    <select class="form-select" name="subject">
                        <option selected>Select Subject</option>
                        <option value="1" name="subject">Bangla</option>
                        <option value="2" name="subject">English</option>
                        <option value="3" name="subject">Math</option>
                        <option value="4" name="subject">Social Science</option>
                        <option value="5" name="subject">Science</option>
                        <option value="6" name="subject">Commerce</option>
                        <option value="7" name="subject">Arts</option>
                        <option value="8" name="subject">Physical Education</option>
                        <option value="9" name="subject">ICT</option>
                        <option value="10" name="subject">Religion</option>
                        <option value="11" name="subject">Agriculture</option>
                        <option value="12" name="subject">Extra</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Gender:</label>
                    <select class="form-select" name="gender">
                        <option value="Female" name="gender">Female</option>
                        <option value="Male" name="gender">Male</option>
                        <option value="Other" name="gender">Others</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Date of Birth:</label>
                    <input type="date" class="form-control" placeholder="Enter Date of Birth..." name="dob">
                </div>
                <div class="mb-3">
                    <label>Phone Number:</label>
                    <input type="text" class="form-control" placeholder="Enter Phone No..." name="phone">
                </div>
                <div class="mb-3">
                    <label>Salary:</label>
                    <input type="text" class="form-control" placeholder="Enter salary in taka" name="salary">
                </div>

                <button type="submit" class="btn btn-warning" name="update">Save Data</button>
            </form>
        </div>';
        }
        ?>
    </div>
    <hr>

</body>

</html>

<?php
include '../template/admin_footer.html';
?>