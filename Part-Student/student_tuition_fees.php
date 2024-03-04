<?php
require('../FPDF/fpdf.php');

use LDAP\Result;

session_start();
$sid = $_SESSION['stu_id'];
include '../template/student_header.html';
@include '../template/database.php';

if (isset($_POST['submitPay'])) {
    $select = "SELECT * FROM tuition_fees WHERE s_id = $sid";
    $result = mysqli_query($conn, $select);
    $row = mysqli_fetch_assoc($result);
    $paid = $row['paid'] + $_POST['pay'];
    $total = $row['total'];
    $due = null;
    $extra = null;
    if ($paid < $total) {
        $extra = 0;
        $due = $total - $paid;
    }
    else {
        $extra = $paid - $total;
        $due = 0;
    }

    $update = "UPDATE tuition_fees
                SET dues = $due,
                    extra = $extra,
                    paid = $paid
                WHERE s_id = $sid";
    mysqli_query($conn, $update);

}

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
        body {
            /* background-color: antiquewhite; */
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <h2>Your accounts status:</h2>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th scope="col" class="fw-normal">Total_fees</th>
                    <th scope="col" class="fw-normal">Paid</th>
                    <th scope="col" class="fw-normal">Dues</th>
                    <th scope="col" class="fw-normal">Extra</th>
                    <th scope="col" class="fw-normal">JAN</th>
                    <th scope="col" class="fw-normal">FEB</th>
                    <th scope="col" class="fw-normal">MAR</th>
                    <th scope="col" class="fw-normal">APR</th>
                    <th scope="col" class="fw-normal">MAY</th>
                    <th scope="col" class="fw-normal">JUN</th>
                    <th scope="col" class="fw-normal">JUL</th>
                    <th scope="col" class="fw-normal">AUG</th>
                    <th scope="col" class="fw-normal">SEP</th>
                    <th scope="col" class="fw-normal">OCT</th>
                    <th scope="col" class="fw-normal">NOV</th>
                    <th scope="col" class="fw-normal">DEC</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $select = "SELECT * FROM tuition_fees WHERE s_id = $sid";
                $result = mysqli_query($conn, $select);

                $row = mysqli_fetch_assoc($result);
                    $totalfee = $row['total'];
                    $paid = $row['paid'];
                    $dues = $row['dues'];
                    $extra = $row['extra'];
                    $jan = $row['jan_24'];
                    $feb = $row['feb_24'];
                    $mar = $row['mar_24'];
                    $apr = $row['apr_24'];
                    $may = $row['may_24'];
                    $jun = $row['jun_24'];
                    $jul = $row['jul_24'];
                    $aug = $row['aug_24'];
                    $sep = $row['sep_24'];
                    $oct = $row['oct_24'];
                    $nov = $row['nov_24'];
                    $dec = $row['dec_24'];

                    echo '<tr>
                    <td scope="col" class="fw-normal bg-warning">' . $totalfee . '</td>
                    <td scope="col" class="fw-normal bg-warning">' . $paid . '</td>
                    <td scope="col" class="fw-normal bg-warning">' . $dues . '</td>
                    <td scope="col" class="fw-normal bg-warning">' . $extra . '</td>
                    <td scope="col" class="fw-normal bg-warning">' . $jan . '</td>
                    <td scope="col" class="fw-normal bg-warning">' . $feb . '</td>
                    <td scope="col" class="fw-normal bg-warning">' . $mar . '</td>
                    <td scope="col" class="fw-normal bg-warning">' . $apr . '</td>
                    <td scope="col" class="fw-normal bg-warning">' . $may . '</td>
                    <td scope="col" class="fw-normal bg-warning">' . $jun . '</td>
                    <td scope="col" class="fw-normal bg-warning">' . $jul . '</td>
                    <td scope="col" class="fw-normal bg-warning">' . $aug . '</td>
                    <td scope="col" class="fw-normal bg-warning">' . $sep . '</td>
                    <td scope="col" class="fw-normal bg-warning">' . $oct . '</td>
                    <td scope="col" class="fw-normal bg-warning">' . $nov . '</td>
                    <td scope="col" class="fw-normal bg-warning">' . $dec . '</td>
                </tr>';
                
                ?>
            </tbody>
        </table>
        <hr>
    </div>
    <div class="container my-5 form-control">
        <form method="post">
            <label for=""><b>Payment :</b></label>
            <input class="form-control my-1" type="number" name="pay" placeholder="Enter payment amount">
            <button class="btn btn-success my-3 btn-sm" name="submitPay">Pay</button>
        </form>
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
        var xhr = new XMLHttpRequest(); //http request from server
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