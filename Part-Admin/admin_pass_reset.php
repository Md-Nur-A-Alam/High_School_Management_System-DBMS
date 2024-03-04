<?php
session_start();
if (!empty($_SESSION['admin_name'])) {
    include '../template/admin_header.html';
    include '../template/database.php';

    $uid = null;
    $name = null;
    $email = null;
    $phoNo = null;
    $profilePicName = null;
    $error = null;

    if (isset($_GET['detailUID'])) {
        $uid = $_GET['detailUID'];
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
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $email = $row['email'];
        $acPhoneNo = $row['acPhoneNo'];
        $stPhoneNo = $row['stPhoneNo'];
        $tcPhoneNo = $row['tcPhoneNo'];
    }


    if (isset($_POST['back'])) {
        header('Location: admin_account.php');
    } elseif (isset($_POST['reset'])) {
        $approval = '1';
        $reset_pass = '0';
        $npass = md5($_POST['n_password']);
        $cpass = md5($_POST['c_password']);
    
        if ($npass != $cpass) {
            $error = '<hr><p class="text-danger">Password does not match!</p>';
        } else {    
            $update = "UPDATE users
                        SET
                            reset_pass = '0',
                            password = '$npass'
                        WHERE
                            email = '$email'";
    
            mysqli_query($conn, $update);
    
            if (mysqli_affected_rows($conn) > 0) {
                header('location: admin_page.php');
            } else {
                $error = '<hr><p class="text-danger">Error updating password!</p>';
            }
        }
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
        <title>Admin Accounts Details</title>
    </head>

    <body>

        <!-- ============ show data from here ============== -->
        <div class="container my-5">
            <h1>Details: </h1>
            <?php if ($error != null) {
                echo $error;
            } ?>
            <hr>
            <div class="row">
                <div class="col-9">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-3 fw-bold">Name</div>
                            <div class="col-9">: <?php echo $name; ?></div>
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
                            <div class="col-3 fw-bold">Phone No.</div>
                            <div class="col-9">: <?php echo  $acPhoneNo . '' . $stPhoneNo . '' . $tcPhoneNo ?></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-3 fw-bold">Email</div>
                            <div class="col-9">: <?php echo $email; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <!-- =========== modify button here =========== -->
        <div class="container my-3 d-flex justify-content-between">
            <form method="post">
                <button class="btn btn-dark" name="back">Back</button>
            </form>
            <form method="post">
                <button class="btn btn-danger" name="Set_pass">Set Password</button>
            </form>

        </div>
        <!-- ======== Update form here ========= -->
        <div class="container">

            <?php
            if (isset($_POST['Set_pass'])) { ?>
                <div class="container my-5 ">
                    <form method="post">
                    <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" class="form-control" name="n_password">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="c_password">
                        </div>
                        <button type="submit" name="reset" class="btn btn-primary">Confirm Reset</button>
                    </form>
                </div>
            <?php } ?>
        </div>
        <hr>

    </body>

    </html>

<?php
    include '../template/admin_footer.html';
} else {
    header('location: ../login.php');
}
?>