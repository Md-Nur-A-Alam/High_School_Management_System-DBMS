<?php
session_start();
include '../template/admin_header.html';
include '../template/database.php';

if (!empty($_SESSION['admin_name'])) {

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
        <div class="container my-5">
            <form method="post"><button class="btn btn-danger mx-2 btn-sm" name="ResetPass">Reset Pass Approval</button></form>
        </div>
        <div class="container">
            <table class="table">
                <tbody>
                    <?php
                    if (isset($_POST['ResetPass'])) {
                        echo '<thead class="table-dark">
                    <tr>
                        <th scope="col" class="fw-normal">Sl.</th>
                        <th scope="col" class="fw-normal">User_ID</th>
                        <th scope="col" class="fw-normal">Name</th>
                        <th scope="col" class="fw-normal">Email</th>
                        <th scope="col" class="fw-normal">Phone No.</th>
                        <th scope="col" class="fw-normal">U_type</th>
                        <th scope="col" class="fw-normal">Operations</th>
                    </tr>
                </thead>';
                        $select = "SELECT
                    ROW_NUMBER() OVER (ORDER BY u.id) AS sl,
                    u.id,
                    a.account_id,
                    t.teacher_id,
                    s.student_id,
                    u.name,
                    u.email,
                    a.phone_number acPhoneNo,
                    s.phone_number stPhoneNo,
                    t.phone_number tcPhoneNo,
                    u.user_type
                FROM
                    users u
                LEFT JOIN accounts a ON u.id = a.user_id
                LEFT JOIN teachers t ON u.id = t.user_id
                LEFT JOIN students s ON u.id = s.user_id
                WHERE u.reset_pass = '1' and approval = '1'";
                        $result = mysqli_query($conn, $select);
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $sl = $row['sl'];
                                $id = $row['id'];
                                $name = $row['name'];
                                $email = $row['email'];
                                $u_type = $row['user_type'];
                                $acPhoneNo = $row['acPhoneNo'];
                                $stPhoneNo = $row['stPhoneNo'];
                                $tcPhoneNo = $row['tcPhoneNo'];
                                echo '<tr>
                        <td class="fw-light">' . $sl . '</th>
                    <td class="fw-light">' . $id . '</th>
                    <td class="fw-light">' . $name . '</th>
                    <td class="fw-light">' . $email . '</th>
                    <td class="fw-light">' . $acPhoneNo. '' . $stPhoneNo. '' . $tcPhoneNo. '</th>
                    <td class="fw-light">' . $u_type . '</th>
                    <td>
                    <button class="btn btn-dark btn-sm"><a href="admin_pass_reset.php?detailUID=' . $id . '" class="text-light">Reset</a></button>
                    <button class="btn btn-danger btn-sm" onclick="confirmDelete(' . $id . ')">Deny</button>
                    </td>
                    </tr>    ';
                            }
                        }
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </body>

    </html>

<?php
    include('../template/admin_footer.html');
} else {
    header('location: ../login.php');
}
?>