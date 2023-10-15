<?php

use LDAP\Result;

session_start();
include 'template/admin_header.html';
include 'database.php';

if (isset($_POST['submit'])) {
    $sub = $_POST['sub'];
    $for = $_POST['for'];
    $notice = $_POST['notice'];
    $from = 'admin';

    $insert = "INSERT INTO notices(sender, receiver, subject, message) VALUES('$from','$for','$sub','$notice')";
    mysqli_query($conn, $insert);
    header('location: admin_notice.php');
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
    <title>Admin Notice</title>
</head>

<body>
    <div class="container my-3">
        <h1></h1>
        <form method="get">
            <select name="receiver" class="col-4">
                <option value="student" name="receiver">To Student</option>
                <option value="teacher" name="receiver">To Teacher</option>
                <option value="accounts" name="receiver">To Accounts</option>
            </select>
            <button class="btn btn-primary mx-2 " name="search">Search</button>
            <button class="btn btn-primary mx-2 " name="addNotice">Add Notice</button>
        </form>
    </div>
    <div class="container my-3">

        <?php
        if (isset($_GET['search'])) {
            $_GET['addNotice'] = false;
            $receiver = $_GET['receiver'];
            $select = "SELECT
                        ROW_NUMBER() OVER (ORDER BY n.noticeID) AS sl,
                        noticeID,
                        DATE(noticeDate) AS noticeDate,
                        subject,
                        message
                    FROM
                        notices AS n
                    WHERE
                        sender = 'admin' AND receiver = '$receiver';";
            $result = mysqli_query($conn, $select);
            if ($result) {
                echo '
                    <table class="table">
                    <thead class="table-success">
                        <tr>
                            <th class="">SL</th>
                            <th class="">Date</th>
                            <th class="col-2">Subject</th>
                            <th class="">Notice text</th>
                            <th colspan=2 class="">Operations</th>
                        </tr>
                    </thead>';
                while ($row = mysqli_fetch_assoc($result)) {
                    $sl = $row['sl'];
                    $date = $row['noticeDate'];
                    $sub = $row['subject'];
                    $text = $row['message'];
                    $id = $row['noticeID'];
                    echo '
                    <tbody>
                        <tr>
                            <td class="fw-bold">' . $sl . '</td>
                            <td class="fw-light">' . $date . '</td>
                            <td class="fw-bold">' . $sub . '</td>
                            <td class="fw-light">' . $text . '</td>
                            <td>
                                <button class="btn btn-dark btn-sm"><a href="admin_notice_details.php?detailsNID=' . $id . '" class="text-light">Details</a></button>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm"><a href="admin_notice_delete.php?deleteNID=' . $id . '" class="text-light">Delete</a></button>
                            </td>
                        </tr>
                    </tbody>';
                }
                echo '</table>';
            }
        } elseif (isset($_GET['addNotice'])) {
            $_GET['search'] = false;
            echo '
                <form method="post">
                    <h2 class="text-success">Insert Notice:</h2>
                    <hr>
                    <div class="mb-3">
                        <label class="fw-bold">Notice for</label>
                        <select name="for" required class="form-control text-danger fw-bold">
                            <option value="student" name="for" class="">Students</option>
                            <option value="teacher" name="for" class="">Teachers</option>
                            <option value="accounts" name="for" class="">Accounts</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Subject</label>
                        <input type="text" class="form-control" placeholder="Enter Notice Subject..." name="sub" required>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Write the Notice:</label>
                        <input type="text" class="form-control" placeholder="Enter Notice Message..." name="notice" required>
                    </div>
                    <button type="submit" class="btn btn-danger" name="submit">Publish Notice</button>
                </form>
            ';
        }

        ?>
    </div>
</body>

</html>

<?php
include 'template/admin_footer.html';
?>