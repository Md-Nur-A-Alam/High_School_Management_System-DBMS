<?php
session_start();
include '../template/admin_header.html';
include '../template/database.php';

$select = "SELECT COUNT(*) AS sl
FROM users
WHERE user_type = 'student'";
$result = mysqli_query($conn, $select);
$row = mysqli_fetch_assoc($result);
$student_sl = $row['sl'];

$select = "SELECT COUNT(*) AS sl
FROM users
WHERE user_type = 'teacher'";
$result = mysqli_query($conn, $select);
$row = mysqli_fetch_assoc($result);
$teacher_sl = $row['sl'];

$select = "SELECT COUNT(*) AS sl
FROM users
WHERE user_type = 'accounts'";
$result = mysqli_query($conn, $select);
$row = mysqli_fetch_assoc($result);
$accounts_sl = $row['sl'];

$select = "SELECT COUNT(*) AS sl
FROM users
WHERE user_type = 'admin'";
$result = mysqli_query($conn, $select);
$row = mysqli_fetch_assoc($result);
$admin_sl = $row['sl'];
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
    <title>HSMS - Admin</title>
</head>

<body>
    <div class="container my-5">
        <h1>Hello <b class="text-success"><?php echo $_SESSION['admin_name'] ?></b>, welcome to HSMS Admin page</h1>
        <hr>
        <div class="row ">
            <div class="col card text-white bg-primary mb-3 mx-1" style="max-width: 18rem;">
                <div class="card-header">We have...</div>
                <div class="card-body">
                    <h2 class="h1 text-center" style="font-size: 80px;"><span><?php echo $student_sl  ?></span></h2>
                    <h3 class="card-title">Student Users</h3>
                </div>
            </div>
            <div class="col card text-white bg-success mb-3 mx-1" style="max-width: 18rem;">
                <div class="card-header">We have...</div>
                <div class="card-body">
                    <h2 class="h1 text-center" style="font-size: 80px;"><span><?php echo $teacher_sl  ?></span></h2>
                    <h3 class="card-title">Teacher Users</h3>
                </div>
            </div>
            <div class="col card text-white bg-danger mb-3 mx-1" style="max-width: 18rem;">
                <div class="card-header">We have...</div>
                <div class="card-body">
                    <h2 class="h1 text-center" style="font-size: 80px;"><span><?php echo $accounts_sl  ?></span></h2>
                    <h3 class="card-title">Accounts Users</h3>
                </div>
            </div>
            <div class="col card text-dark bg-warning mb-3 mx-1" style="max-width: 18rem;">
                <div class="card-header">We have...</div>
                <div class="card-body">
                    <h2 class="h1 text-center" style="font-size: 80px;"><span><?php echo $admin_sl  ?></span></h2>
                    <h3 class="card-title">Admin Users</h3>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
include ('../template/admin_footer.html');
?>