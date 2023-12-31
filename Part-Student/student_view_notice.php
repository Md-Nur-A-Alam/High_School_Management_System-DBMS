<?php
require('../FPDF/fpdf.php');

use LDAP\Result;

session_start();
include 'header.html';
@include 'database.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/adminHeaderFooter.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <title>Student Notice</title>
    <style>
        body{
            /* background-color: antiquewhite; */
        }
    </style>
</head>

<body>
    <div class="container my-3">
        <h1>My Notice: </h1>
        <form method="get">
            <select name="sender" class="col-4">
                <option value="admin" name="sender">From Admin</option>
                <option value="teacher" name="sender">From Teacher</option>
                <option value="accounts" name="sender">From Accounts</option>
            </select>
            <button class="btn btn-primary mx-2 " name="search">Search</button>
        </form>
    </div>
    <div class="container my-3">

        <?php
        if (isset($_GET['search'])) {
            $_GET['addNotice'] = false;
            $sender = $_GET['sender'];
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
                        sender = '$sender' and receiver='student';";
            $result = mysqli_query($conn, $select);
            if ($result) {
                echo '
                    <h4 class="text-primary fw-bold">From '.$sender.'</h4>
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
        ?>
    </div>
</body>

</html>

<script>
    function confirmDelete(uid) {
        var result = confirm("Are you sure you want to delete this Notice?");
        if (result) {
            window.location.href = 'student_notice_delete.php?deleteNID=' + uid;
        }
    }

    function downloadNotice(id) {
        // Create an AJAX request to generate the PDF file
        var xhr = new XMLHttpRequest();//http request from server
        xhr.open('GET', 'student_generate_notice.php?id=' + id, true);
        xhr.responseType = 'arraybuffer';
        //it should expect binary data as the response, which is common for file downloads.

        xhr.onload = function() {
            if (this.status === 200) {
                var blob = new Blob([this.response], {
                    type: 'application/pdf'
                });
                var link = document.createElement('a'); //used to trigger the file download.
                link.href = window.URL.createObjectURL(blob);
                //This URL is a temporary object URL that 
                //represents the generated PDF.
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
include 'footer.html';
?>