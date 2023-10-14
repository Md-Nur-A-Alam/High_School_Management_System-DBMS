<?php
session_start();
include 'template/admin_header.html';
include 'database.php';

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
    $dob = $row['date_of_birth']; //
    $address = $row['address']; //
    $phone = $row['phone_number']; //
    $gender = $row['gender']; //
}

// echo "{$uid} = uid;<br>
// {$sid} = sid;<br>
// {$name} = name;<br>
// {$email} = email;<br>
// {$class} = class;<br>
// {$section} = section;<br>
// {$blood} = blood;<br>
// {$guardian} = guardian;<br>
// {$gPhone} = gPhone;<br>
// {$dob} = dob;<br>
// {$address} = address;<br>
// {$phone} = phone;<br>
// {$gender} = gender;";




if (isset($_POST['back'])) {
    header('Location: admin_student.php');
} elseif (isset($_POST['update'])) {
    $class = ($_POST['class']);
    $section = ($_POST['section']);
    $gender = ($_POST['gender']);
    $dob = ($_POST['dob']);
    $phone = ($_POST['phone']);
    $user_type = 'student';
    $approval = '1';



    if (!$sid) {
        $insert = "INSERT INTO students (user_id, class_id, section_id, phone_number, gender, date_of_birth)
            VALUES ('$uid', '$class', '$section', '$phone', '$gender', '$dob');";
        mysqli_query($conn, $insert);
    } else {
        $select2 = "UPDATE students
        SET
            class_id = '$class',
            section_id = '$section',
            phone_number = '$phone',
            gender = '$gender',
            date_of_birth = '$dob'
        WHERE
            student_id = '$sid';";
        mysqli_query($conn, $select2);
    }
    $select1 = "UPDATE users
                SET
                    approval = '$approval'
                WHERE
                    id = '$uid'";
    mysqli_query($conn, $select1);

    header('location: admin_student_details.php?detailUID=' . $uid . '');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/adminHeaderFooter.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <title>Admin Student Details</title>
</head>

<body>

    <!-- ============ show data from here ============== -->
    <?php
    echo '
    <div class="container my-5">
    <h2>Student information show:</h2>
            <hr>
            <div class="mb-3">
                <div class="row">
                    <div class="col-3 fw-bold">Name</div>
                    <div class="col-9">: ' . $name . '</div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-3 fw-bold">Class</div>
                    <div class="col-9">: ' . $class . '</div>
                </div>
            </div>
            <div class="mb-3">
            <div class="mb-3">
                <div class="row">
                    <div class="col-3 fw-bold">Section</div>
                    <div class="col-9">: ' . $section . '</div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-3 fw-bold">Student ID</div>
                    <div class="col-9">: ' . $sid . '</div>
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
                    <div class="col-9">: ' . $phone . '</div>
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
                    <div class="col-3 fw-bold">Guardian</div>
                    <div class="col-9">: ' . $guardian . '</div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-3 fw-bold">Guardian Phone</div>
                    <div class="col-9 text-success fw-normal">: ' . $gPhone . '</div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-3 fw-bold">Address</div>
                    <div class="col-9">: ' . $address . '</div>
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
                <h2>Student information update:</h2>
                <hr>
                <div class="mb-3">
                    <label>Class:</label>
                    <select class="form-select" name="class">
                        <option value="6" name="class">Class 6</option>
                        <option value="7" name="class">Class 7</option>
                        <option value="8" name="class">Class 8</option>
                        <option value="9" name="class">Class 9</option>
                        <option value="10" name="class">Class 10</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Section:</label>
                    <select class="form-select" name="section">
                        <option value="1" name="section">A</option>
                        <option value="2" name="section">B</option>
                        <option value="3" name="section">C</option>
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

                <button type="submit" class="btn btn-success" name="update">Save</button>
            </form>
        </div>';
        }
        ?>
    </div>
    <hr>

</body>

</html>

<?php
include 'template/admin_footer.html';
?>