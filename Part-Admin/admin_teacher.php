<?php
session_start();
include '../template/admin_header.html';
include '../template/database.php';
$error = null;
function sanitizeName($input)
{
    // Remove any characters that are not letters (A-Z and a-z), '.', or '-'
    $sanitized = preg_replace("/[^A-Za-z .-]+/", "", $input);
    return $sanitized;
}
if (isset($_POST['submit'])) {
    $name = SanitizeName($_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $user_type = 'teacher';
    if ($name !== $_POST['name']) {
        $error = "ERROR: insert a valid name please";
    } else {
        $select = " SELECT * FROM users WHERE email= '$email' && password ='$pass'";

        $result = mysqli_query($conn, $select);

        if (mysqli_num_rows($result) > 0) {
            echo 'teacher already exist!';
        } else {
            if ($pass != $cpass) {
                echo 'password does not match! <br>';
            } else {
                $insert = " INSERT INTO users(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
                mysqli_query($conn, $insert);
                // echo "data inserted successfully";
                header('location: admin_teacher.php');
            }
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
    <title>Admin Teacher</title>
</head>

<body>
    <hr>
    <div class="container my-3">
    <h4 class="text-danger fw-bold"><?php echo $error ?></h4>
        <h2>Teacher Page:</h2>
        <form method="post">
            <input type="text" placeholder="Looking for..." name="search_data">
            <button class="btn btn-success mx-2 btn-sm" name="Search">Search</button>
            <button class="btn btn-danger mx-2 btn-sm" name="List">Full List</button>
            <button class="btn btn-warning mx-2 btn-sm" name="approval">Approval Pending</button>
            <button class="btn btn-primary mx-2 btn-sm " name="AddTeacher">Add Teacher</button>
        </form>
    </div>
    <div class="container">
        <table class="table">
            <tbody>
                <?php
                if (isset($_POST['AddTeacher'])) {
                    $_POST['Search'] = false;
                    $_POST['approval'] = false;
                    $_POST['List'] = false;
                    echo '<div class="container my-5 ">
                    <form method="post">
                        <h2>Insert information for Teacher as User:</h2>
                        <hr>
                        <div class="mb-3">
                            <label>Teacher Name:</label>
                            <input type="text" class="form-control" required placeholder="Enter Name..." name="name">
                        </div>
                        <div class="mb-3">
                            <label>Email address:</label>
                            <input type="email" class="form-control" required placeholder="Enter Email address..." name="email">
                        </div>
                        <div class="mb-3">
                            <label>Password:</label>
                            <input type="password" class="form-control" required placeholder="Enter Password..." name="password">
                        </div>
                        <div class="mb-3">
                            <label>Confirm Password:</label>
                            <input type="password" class="form-control" required placeholder="Confirm Password..." name="cpassword">
                        </div>
            
                        <button type="submit" class="btn btn-primary" name="submit">Add Teacher</button>
                    </form>
                </div>';
                } elseif (isset($_POST['List'])) {
                    $_POST['Search'] = false;
                    $_POST['approval'] = false;
                    $_POST['AddTeacher'] = false;
                    echo '<thead class="table-dark">
                    <tr>
                        <th scope="col" class="fw-normal">Sl.</th>
                        <th scope="col" class="fw-normal">T_ID</th>
                        <th scope="col" class="fw-normal">Name</th>
                        <th scope="col" class="fw-normal">Email</th>
                        <th scope="col" class="fw-normal">Designation</th>
                        <th scope="col" class="fw-normal">Phone No.</th>
                        <th scope="col" class="fw-normal">Gender</th>
                        <th scope="col" class="fw-normal">Salary</th>
                        <th scope="col" class="fw-normal">Operations</th>
                    </tr>
                </thead>';
                    $select = "SELECT
                    ROW_NUMBER() OVER (ORDER BY u.id) AS sl,
                    u.id,
                    t.teacher_id,
                    u.name,
                    u.email,
                    td.designation_name,
                    t.phone_number,
                    t.gender,
                    t.salary
                FROM
                    users u
                LEFT JOIN teachers t ON u.id = t.user_id
                LEFT JOIN teacher_designations td ON t.designation_id = td.designation_id
                WHERE u.user_type = 'teacher' and approval = '1'";
                    $result = mysqli_query($conn, $select);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $sl = $row['sl'];
                            $id = $row['id'];
                            $tech_id = $row['teacher_id'];
                            $name = $row['name'];
                            $email = $row['email'];
                            $desig = $row['designation_name'];
                            $phoneNo = $row['phone_number'];
                            $gender = $row['gender'];
                            $salary = $row['salary'];
                            echo '<tr>
                        <td class="fw-light">' . $sl . '</th>
                    <td class="fw-light">' . $tech_id . '</th>
                    <td class="fw-light">' . $name . '</th>
                    <td class="fw-light">' . $email . '</th>
                    <td class="fw-light">' . $desig . '</th>
                    <td class="fw-light">' . $phoneNo . '</th>
                    <td class="fw-light">' . $gender . '</th>
                    <td class="fw-light">' . $salary . '</th>
                    <td>
                    <button class="btn btn-dark btn-sm"><a href="admin_teacher_details.php?detailUID=' . $id . '" class="text-light">Details</a></button>
                    <button class="btn btn-danger btn-sm" onclick="confirmDelete(' . $id . ')">Delete</button>
                    </td>
                    </tr>    ';
                        }
                    }
                } elseif (isset($_POST['approval'])) {
                    $_POST['Search'] = false;
                    $_POST['List'] = false;
                    $_POST['AddTeacher'] = false;
                    echo '<thead class="table-dark">
                    <tr>
                        <th scope="col" class="fw-normal">Sl.</th>
                        <th scope="col" class="fw-normal">User ID</th>
                        <th scope="col" class="fw-normal">Name</th>
                        <th scope="col" class="fw-normal">Email</th>
                        <th scope="col" class="fw-normal">Registration Time</th>
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
                WHERE u.user_type = 'teacher' and approval = '0'";
                    $result = mysqli_query($conn, $select);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $sl = $row['sl'];
                            $id = $row['id'];
                            $name = $row['name'];
                            $email = $row['email'];
                            $regTime = $row['registration_date'];
                            echo '<tr>
                        <td class="fw-light">' . $sl . '</th>
                        <td class="fw-light">' . $id . '</th>
                    <td class="fw-light">' . $name . '</th>
                    <td class="fw-light">' . $email . '</th>
                    <td class="fw-light">' . $regTime . '</th>
                    <td>
                    <button class="btn btn-success btn-sm"><a href="admin_teacher_details.php?detailUID=' . $id . '" class="text-light">Approve & Details</a></button>
                    <button class="btn btn-danger btn-sm" onclick="confirmDelete(' . $id . ')">Delete</button>
                    </td>
                    </tr>    ';
                        }
                    }
                } elseif (isset($_POST['Search'])) {
                    $_POST['List'] = false;
                    $_POST['approval'] = false;
                    $_POST['AddTeacher'] = false;
                    $search = $_POST['search_data'];
                    echo '<thead class="table-dark">
                    <tr>
                        <th scope="col" class="fw-normal">Sl.</th>
                        <th scope="col" class="fw-normal">T_ID</th>
                        <th scope="col" class="fw-normal">Name</th>
                        <th scope="col" class="fw-normal">Email</th>
                        <th scope="col" class="fw-normal">Designation</th>
                        <th scope="col" class="fw-normal">Phone No.</th>
                        <th scope="col" class="fw-normal">Gender</th>
                        <th scope="col" class="fw-normal">Salary</th>
                        <th scope="col" class="fw-normal">Operations</th>
                    </tr>
                </thead>';
                    $select = "SELECT
                    ROW_NUMBER() OVER (ORDER BY a.id) AS sl,
                    a.id,
                    a.teacher_id,
                    a.name,
                    a.email,
                    a.designation_name,
                    a.phone_number,
                    a.gender,
                    a.salary
                FROM (
                    SELECT 
                        u.id,
                        t.teacher_id,
                        u.name,
                        u.email,
                        td.designation_name,
                        t.phone_number,
                        t.gender,
                        t.salary,
                        u.user_type
                    FROM users u
                    LEFT JOIN teachers t ON u.id = t.user_id
                    LEFT JOIN teacher_designations td ON t.designation_id = td.designation_id
                    WHERE
                        t.teacher_id LIKE '%$search%'
                        OR u.name LIKE '%$search%'
                        OR u.email LIKE '%$search%'
                        OR td.designation_name LIKE '%$search%'
                        OR t.phone_number LIKE '%$search%'
                        OR t.gender LIKE '%$search%'
                        OR t.salary LIKE '%$search%'
                ) AS a
                WHERE a.user_type = 'teacher'";
                    $result = mysqli_query($conn, $select);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $sl = $row['sl'];
                            $id = $row['id'];
                            $tech_id = $row['teacher_id'];
                            $name = $row['name'];
                            $email = $row['email'];
                            $desig = $row['designation_name'];
                            $phoneNo = $row['phone_number'];
                            $gender = $row['gender'];
                            $salary = $row['salary'];
                            echo '<tr>
                        <th class="fw-light">' . $sl . '</th>
                    <td class="fw-light">' . $tech_id . '</th>
                    <td class="fw-light">' . $name . '</th>
                    <td class="fw-light">' . $email . '</th>
                    <td class="fw-light">' . $desig . '</th>
                    <td class="fw-light">' . $phoneNo . '</th>
                    <td class="fw-light">' . $gender . '</th>
                    <td class="fw-light">' . $salary . '</th>
                    <td>
                    <button class="btn btn-dark btn-sm"><a href="admin_teacher_details.php?detailUID=' . $id . '" class="text-light">Details</a></button>
                    <button class="btn btn-danger btn-sm" onclick="confirmDelete(' . $id . ')">Delete</button>
                    </td>
                    
                    </tr>';
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
        var result = confirm("Are you sure you want to delete this teacher?");
        if (result) {
            window.location.href = 'admin_teacher_delete.php?deleteUID=' + uid;
        }
    }
</script>

<?php
include '../template/admin_footer.html';
?>