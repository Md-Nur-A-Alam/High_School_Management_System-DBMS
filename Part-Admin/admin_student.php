<?php
session_start();
include '../template/admin_header.html';
@include '../template/database.php';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $user_type = 'student';

    $select = " SELECT * FROM users WHERE email= '$email' && password ='$pass'";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        echo 'Student already exist!';
    } else {
        if ($pass != $cpass) {
            echo 'password does not match! <br>';
        } else {
            $insert = " INSERT INTO users(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
            mysqli_query($conn, $insert);
            // echo "data inserted successfully";
            header('location: admin_student.php');
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="../CSS/adminHeaderFooter.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <title>Admin Student</title>
</head>

<body>
    <hr>
    <div class="container my-3">
        <h2>Student Page:</h2>
        <form method="post">
            <div class="my-1">
                    <select name="class">
                        <option value="0" name="class">Select Class</option>
                        <option value="6" name="class">Class 6</option>
                        <option value="7" name="class">Class 7</option>
                        <option value="8" name="class">Class 8</option>
                        <option value="9" name="class">Class 9</option>
                        <option value="10" name="class">Class 10</option>
                    </select>
                    <select name="section">
                        <option value="0" name="section">Select Section</option>
                        <option value="1" name="section">A</option>
                        <option value="2" name="section">B</option>
                        <option value="3" name="section">C</option>
                    </select>
                    <button class="btn btn-dark mx-2 btn-sm" name="Search2">Class Search</button>
            </div>
            <input type="text" placeholder="Looking for..." name="search_data">
            <button class="btn btn-success mx-2 btn-sm" name="Search">General Search</button>
            <button class="btn btn-danger mx-2 btn-sm" name="List">Full List</button>
            <button class="btn btn-warning mx-2 btn-sm" name="approval">Approval Pending</button>
            <button class="btn btn-primary mx-2 btn-sm " name="AddStudent">Add Student</button>
        </form>
    </div>
    <div class="container">
        <table class="table">
            <tbody>
                <?php
                if (isset($_POST['AddStudent'])) {
                    $_POST['Search2'] = false;
                    $_POST['Search'] = false;
                    $_POST['approval'] = false;
                    $_POST['List'] = false;
                    echo '<div class="container my-5">
                    <form method="post">
                        <h2>Insert information for Student as User:</h2>
                        <hr>
                        <div class="mb-3">
                            <label>Student Name:</label>
                            <input type="text" class="form-control" placeholder="Enter Name..." name="name">
                        </div>
                        <div class="mb-3">
                            <label>Email address:</label>
                            <input type="email" class="form-control" placeholder="Enter Email address..." name="email">
                        </div>
                        <div class="mb-3">
                            <label>Password:</label>
                            <input type="password" class="form-control" placeholder="Enter Password..." name="password">
                        </div>
                        <div class="mb-3">
                            <label>Confirm Password:</label>
                            <input type="password" class="form-control" placeholder="Confirm Password..." name="cpassword">
                        </div>
            
                        <button type="submit" class="btn btn-primary" name="submit">Add Student</button>
                    </form>
                </div>';
                } elseif (isset($_POST['List'])) {
                    $_POST['Search2'] = false;
                    $_POST['Search'] = false;
                    $_POST['approval'] = false;
                    $_POST['AddStudent'] = false;
                    echo '<thead class="table-dark">
                    <tr>
                        <th scope="col" class="fw-normal">Sl.</th>
                        <th scope="col" class="fw-normal">Name</th>
                        <th scope="col" class="fw-normal">Class</th>
                        <th scope="col" class="fw-normal">Section</th>
                        <th scope="col" class="fw-normal">Gender</th>
                        <th scope="col" class="fw-normal">Guardian</th>
                        <th scope="col" class="fw-normal">Guardian phone.</th>
                        <th scope="col" class="fw-normal">Email</th>
                        <th scope="col" class="fw-normal">Operations</th>
                    </tr>
                </thead>';
                    $select = "SELECT
                    ROW_NUMBER() OVER (ORDER BY u.id) AS sl,
                    u.id,
                    s.student_id,
                    u.name,
                    c.class_name AS class,
                    sec.section_name AS section,
                    s.gender,
                    s.guardian_name AS guardian, -- Fixed the typo here
                    s.guardian_phone AS guardian_phone, -- Fixed the typo here
                    u.email
                FROM
                    users u
                LEFT JOIN students s ON u.id = s.user_id
                LEFT JOIN classes c ON c.class_id = s.class_id
                LEFT JOIN sections sec ON sec.section_id = s.section_id
                WHERE u.user_type = 'student' AND approval = '1'";
                    $result = mysqli_query($conn, $select);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $sl = $row['sl'];
                            $id = $row['id'];
                            $stu_id = $row['student_id'];
                            $name = $row['name'];
                            $class = $row['class'];
                            $section = $row['section'];
                            $gender = $row['gender'];
                            $guardian = $row['guardian'];
                            $guardian_phone = $row['guardian_phone'];
                            $email = $row['email'];
                            echo '<tr>
                        <td class="fw-light">' . $sl . '</th>
                    <td class="fw-light">' . $name . '</th>
                    <td class="fw-light">' . $class . '</th>
                    <td class="fw-light">' . $section . '</th>
                    <td class="fw-light">' . $gender . '</th>
                    <td class="fw-light">' . $guardian . '</th>
                    <td class="fw-light">' . $guardian_phone . '</th>
                    <td class="fw-light">' . $email . '</th>
                    <td>
                        <button class="btn btn-dark btn-sm"><a href="admin_student_details.php?detailUID=' . $id . '" class="text-light">Details</a></button>
                        <button class="btn btn-danger btn-sm" onclick="confirmDelete(' . $id . ')">Delete</button>
                    </td>
                    </tr>    ';
                        }
                    }
                } elseif (isset($_POST['approval'])) {
                    $_POST['Search2'] = false;
                    $_POST['Search'] = false;
                    $_POST['List'] = false;
                    $_POST['AddStudent'] = false;
                    echo '<thead class="table-dark">
                    <tr>
                        <th scope="col" class="fw-normal">Sl.</th>
                        <th scope="col" class="fw-normal">User ID</th>
                        <th scope="col" class="fw-normal">Name</th>
                        <th scope="col" class="fw-normal">Email</th>
                        <th scope="col" class="fw-normal">Registration Date</th>
                        <th scope="col" class="fw-normal">Operations</th>
                    </tr>
                </thead>';
                    $select = "SELECT
                    ROW_NUMBER() OVER (ORDER BY u.id) AS sl,
                    u.id,
                    u.name,
                    u.email,
                    u.registration_date
                FROM
                    users u
                LEFT JOIN students s ON u.id = s.user_id
                LEFT JOIN classes c ON c.class_id = s.class_id
                LEFT JOIN sections sec ON sec.section_id = s.section_id
                WHERE u.user_type = 'student' AND approval = '0'";
                    $result = mysqli_query($conn, $select);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $sl = $row['sl'];
                            $id = $row['id'];
                            $name = $row['name'];
                            $email = $row['email'];
                            $registration_date = $row['registration_date'];
                            echo '<tr>
                        <td class="fw-light">' . $sl . '</th>
                        <td class="fw-light">' . $id . '</th>
                    <td class="fw-light">' . $name . '</th>
                    <td class="fw-light">' . $email . '</th>
                    <td class="fw-light">' . $registration_date . '</th>
                    <td>
                        <button class="btn btn-dark btn-sm"><a href="admin_student_details.php?detailUID=' . $id . '" class="text-light">Details</a></button>
                        <button class="btn btn-danger btn-sm" onclick="confirmDelete(' . $id . ')">Delete</button>
                    </td>
                    </tr>    ';
                        }
                    }
                } elseif (isset($_POST['Search'])) {
                    $_POST['Search2'] = false;
                    $_POST['List'] = false;
                    $_POST['approval'] = false;
                    $_POST['AddStudent'] = false;
                    $search = $_POST['search_data'];
                    echo '<thead class="table-dark">
                    <tr>
                        <th scope="col" class="fw-normal">Sl.</th>
                        <th scope="col" class="fw-normal">Name</th>
                        <th scope="col" class="fw-normal">Class</th>
                        <th scope="col" class="fw-normal">Section</th>
                        <th scope="col" class="fw-normal">Gender</th>
                        <th scope="col" class="fw-normal">Guardian</th>
                        <th scope="col" class="fw-normal">Guardian phone.</th>
                        <th scope="col" class="fw-normal">Email</th>
                        <th scope="col" class="fw-normal">Operations</th>
                    </tr>
                </thead>';
                    $select = "SELECT
                a.sl,
                a.id,
                a.student_id,
                a.name,
                a.class_name AS class,
                a.section_name AS section,
                a.gender,
                a.guardian_name AS guardian,
                a.guardian_phone AS guardian_phone,
                a.email
            FROM (
                SELECT ROW_NUMBER() OVER (ORDER BY u.id) AS sl, u.id, s.student_id, u.name, c.class_name, sec.section_name, s.gender, s.guardian_name, s.guardian_phone, u.email
                FROM users u
                LEFT JOIN students s ON u.id = s.user_id
                LEFT JOIN classes c ON s.class_id = c.class_id
                LEFT JOIN sections sec ON sec.section_id = s.section_id
                WHERE
                    u.user_type = 'student'
                    AND (
                        u.name LIKE '%$search%'
                        OR u.email LIKE '%$search%'
                        OR c.class_name LIKE '%$search%'
                        OR sec.section_name LIKE '%$search%'
                        OR s.gender LIKE '%$search%'
                    )
            ) AS a;";
                    $result = mysqli_query($conn, $select);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $sl = $row['sl'];
                            $id = $row['id'];
                            $stu_id = $row['student_id'];
                            $name = $row['name'];
                            $class = $row['class'];
                            $section = $row['section'];
                            $gender = $row['gender'];
                            $guardian = $row['guardian'];
                            $guardian_phone = $row['guardian_phone'];
                            $email = $row['email'];
                            echo '<tr>
                        <td class="fw-light">' . $sl . '</th>
                    <td class="fw-light">' . $name . '</th>
                    <td class="fw-light">' . $class . '</th>
                    <td class="fw-light">' . $section . '</th>
                    <td class="fw-light">' . $gender . '</th>
                    <td class="fw-light">' . $guardian . '</th>
                    <td class="fw-light">' . $guardian_phone . '</th>
                    <td class="fw-light">' . $email . '</th>
                    <td>
                        <button class="btn btn-dark btn-sm"><a href="admin_student_details.php?detailUID=' . $id . '" class="text-light">Details</a></button>
                        <button class="btn btn-danger btn-sm" onclick="confirmDelete(' . $id . ')">Delete</button>
                    </td>
                    </tr>    ';
                        }
                    }
                } elseif (isset($_POST['Search2'])) {
                    $_POST['Search'] = false;
                    $_POST['List'] = false;
                    $_POST['approval'] = false;
                    $_POST['AddStudent'] = false;
                    $class = $_POST['class'];
                    $section = $_POST['section'];
                                    
                    if ($class == 0 || $section == 0) {
                        echo '<h3>Select both class and section first</h3>';
                    } else {
                        echo '<thead class="table-dark">
                            <tr>
                                <th scope="col" class="fw-normal">Sl.</th>
                                <th scope="col" class="fw-normal">Name</th>
                                <th scope="col" class="fw-normal">Class</th>
                                <th scope="col" class="fw-normal">Section</th>
                                <th scope="col" class="fw-normal">Gender</th>
                                <th scope="col" class="fw-normal">Guardian</th>
                                <th scope="col" class="fw-normal">Guardian phone.</th>
                                <th scope="col" class="fw-normal">Email</th>
                                <th scope="col" class="fw-normal">Operations</th>
                            </tr>
                        </thead>';
                
                        $select = "SELECT
                            a.sl,
                            a.id,
                            a.student_id,
                            a.name,
                            a.class_name AS class,
                            a.section_name AS section,
                            a.gender,
                            a.guardian_name AS guardian,
                            a.guardian_phone AS guardian_phone,
                            a.email
                        FROM (
                            SELECT ROW_NUMBER() OVER (ORDER BY u.id) AS sl, u.id, s.student_id, u.name, c.class_name, sec.section_name, s.gender, s.guardian_name, s.guardian_phone, u.email
                            FROM users u
                            LEFT JOIN students s ON u.id = s.user_id
                            LEFT JOIN classes c ON s.class_id = c.class_id
                            LEFT JOIN sections sec ON sec.section_id = s.section_id
                            WHERE
                                u.user_type = 'student'
                                AND s.class_id = $class
                                AND s.section_id = $section
                        ) AS a;";
                
                        $result = mysqli_query($conn, $select);
                        
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $sl = $row['sl'];
                                $id = $row['id'];
                                $stu_id = $row['student_id'];
                                $name = $row['name'];
                                $class = $row['class'];
                                $section = $row['section'];
                                $gender = $row['gender'];
                                $guardian = $row['guardian'];
                                $guardian_phone = $row['guardian_phone'];
                                $email = $row['email'];
                                echo '<tr>
                                    <td class="fw-light">' . $sl . '</th>
                                    <td class="fw-light">' . $name . '</th>
                                    <td class="fw-light">' . $class . '</th>
                                    <td class="fw-light">' . $section . '</th>
                                    <td class="fw-light">' . $gender . '</th>
                                    <td class="fw-light">' . $guardian . '</th>
                                    <td class="fw-light">' . $guardian_phone . '</th>
                                    <td class="fw-light">' . $email . '</th>
                                    <td>
                                        <button class="btn btn-dark btn-sm"><a href="admin_student_details.php?detailUID=' . $id . '" class="text-light">Details</a></button>
                                        <button class="btn btn-danger btn-sm" onclick="confirmDelete(' . $id . ')">Delete</button>
                                    </td>
                                </tr>';
                            }
                        }
                    }
                }
                ?>

            </tbody>
        </table>
    </div>
    <hr>
</body>

</html>

<script>
    function confirmDelete(uid) {
        var result = confirm("Are you sure you want to delete this Student?");
        if (result) {
            window.location.href = 'admin_student_delete.php?deleteUID=' + uid;
        }
    }
</script>

<?php
include '../template/admin_footer.html';
?>