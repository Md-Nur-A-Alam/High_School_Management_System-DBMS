<?php
require('../FPDF/fpdf.php');

use LDAP\Result;

session_start();
include '../template/accounts_header.html';
@include '../template/database.php';

if (isset($_POST['submit'])) {
    $sub = $_POST['sub'];
    $for = $_POST['for'];
    $notice = mysqli_real_escape_string($conn, $_POST['notice']);
    $from = 'accounts';

    $insert = "INSERT INTO notices(sender, receiver, subject, message) VALUES('$from','$for','$sub','$notice')";
    mysqli_query($conn, $insert);
    header('location: accounts_notice.php');
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
    <title>Teacher Notice</title>
</head>

<body>
    <div class="container my-3">
        <h1></h1>
        <form method="get">
            <select name="receiver" class="col-4">
                <option value="admin" name="receiver">To Admin</option>
                <option value="student" name="receiver">To Student</option>
                <option value="teacher" name="receiver">To Teacher</option>
                <option value="accounts" name="receiver">For Me</option>
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
            if ($receiver == 'accounts') {
                $select = "SELECT
                        ROW_NUMBER() OVER (ORDER BY n.noticeID) AS sl,
                        noticeID,
                        DATE(noticeDate) AS noticeDate,
                        sender,
                        subject,
                        message
                    FROM
                        notices AS n
                    WHERE
                        receiver = '$receiver';";
            $result = mysqli_query($conn, $select);
            if ($result) {
                echo '
                    <h4 class="text-primary fw-bold">To '.$receiver.'</h4>
                    <table class="table my-1">
                    <thead class="table-success">
                        <tr>
                            <th class="">SL</th>
                            <th class="">Date</th>
                            <th class="">Sender</th>
                            <th class="col-2">Subject</th>
                            <th class="">Notice text</th>
                            <th colspan=3 class="">Operations</th>
                        </tr>
                    </thead>';
                while ($row = mysqli_fetch_assoc($result)) {
                    $sl = $row['sl'];
                    $date = date('M j, Y', strtotime($row['noticeDate']));
                    $sender = $row['sender'];
                    $sub = $row['subject'];
                    $text = $row['message'];
                    $id = $row['noticeID'];
                    echo '
                    <tbody>
                        <tr>
                            <td class="fw-bold">' . $sl . '</td>
                            <td class="fw-light">' . $date . '</td>
                            <td class="fw-bold text-primary">' . $sender . '</td>
                            <td class="fw-bold">' . $sub . '</td>'; ?>
                            <td class="fw-light">
                                <div id="notice_<?php echo $id; ?>"><?php echo $text; ?></div>
                            </td>
                            <td>
                                <button class="btn btn-dark btn-sm" onclick="toggleNoticeText(<?php echo $id; ?>)">Toggle Text</button>
                            </td>

                        <?php echo 
                            '<td>
                                <button class="btn btn-success btn-sm" onclick="downloadNotice(' . $id . ')">Download Notice</button>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete(' . $id . ')">Delete Notice</button>
                            </td>
                        </tr>
                    </tbody>';
                }
                echo '</table>';
            }
            } else {
                $select = "SELECT
                        ROW_NUMBER() OVER (ORDER BY n.noticeID) AS sl,
                        noticeID,
                        DATE(noticeDate) AS noticeDate,
                        sender,
                        subject,
                        message
                    FROM
                        notices AS n
                    WHERE
                        sender = 'accounts' AND receiver = '$receiver';";
            $result = mysqli_query($conn, $select);
            if ($result) {
                echo '
                    <h4 class="text-primary fw-bold">To '.$receiver.'</h4>
                    <table class="table my-1">
                    <thead class="table-success">
                        <tr>
                            <th class="">SL</th>
                            <th class="">Date</th>
                            <th class="">Sender</th>
                            <th class="col-2">Subject</th>
                            <th class="">Notice text</th>
                            <th colspan=3 class="">Operations</th>
                        </tr>
                    </thead>';
                while ($row = mysqli_fetch_assoc($result)) {
                    $sl = $row['sl'];
                    $date = date('M j, Y', strtotime($row['noticeDate']));
                    $sender = $row['sender'];
                    $sub = $row['subject'];
                    $text = $row['message'];
                    $id = $row['noticeID'];
                    echo '
                    <tbody>
                        <tr>
                            <td class="fw-bold">' . $sl . '</td>
                            <td class="fw-light">' . $date . '</td>
                            <td class="fw-bold text-primary">' . $sender . '</td>
                            <td class="fw-bold">' . $sub . '</td>'; ?>
                            <td class="fw-light">
                                <div id="notice_<?php echo $id; ?>"><?php echo $text; ?></div>
                            </td>
                            <td>
                                <button class="btn btn-dark btn-sm" onclick="toggleNoticeText(<?php echo $id; ?>)">Toggle Text</button>
                            </td>

                        <?php echo 
                            '<td>
                                <button class="btn btn-success btn-sm" onclick="downloadNotice(' . $id . ')">Download Notice</button>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete(' . $id . ')">Delete Notice</button>
                            </td>
                        </tr>
                    </tbody>';
                }
                echo '</table>';
            }
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
                            <option value="admin" name="for" class="">Admin</option>
                            <option value="teacher" name="for" class="">Teacher</option>
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

<script>
    function confirmDelete(uid) {
        var result = confirm("Are you sure you want to delete this Notice?");
        if (result) {
            window.location.href = 'teacher_notice_delete.php?deleteNID=' + uid;
        }
    }

    function downloadNotice(id) {
        // Create an AJAX request to generate the PDF file
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'teacher_generate_notice.php?id=' + id, true);
        xhr.responseType = 'arraybuffer';

        xhr.onload = function() {
            if (this.status === 200) {
                var blob = new Blob([this.response], {
                    type: 'application/pdf'
                });
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = 'notice.pdf';
                link.click();
            }
        };

        xhr.send();
    }


    function toggleNoticeText(id) {
        var noticeDiv = document.getElementById('notice_' + id);
        
        if (noticeDiv) {
            if (noticeDiv.classList.contains('truncated')) {
                noticeDiv.classList.remove('truncated');
                noticeDiv.innerHTML = noticeDiv.getAttribute('data-full-text');
            } else {
                noticeDiv.classList.add('truncated');
                var fullText = noticeDiv.innerHTML;
                var truncatedText = fullText.substring(0, 100);
                noticeDiv.innerHTML = truncatedText + '...';
                noticeDiv.setAttribute('data-full-text', fullText);
            }
        }
    }
</script>
</script>


<?php
include '../template/teacher_footer.html';
?>