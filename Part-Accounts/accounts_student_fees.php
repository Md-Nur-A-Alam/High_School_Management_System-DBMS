<?php
session_start();
if (!empty($_SESSION['accounts_name'])) {
    include '../template/accounts_header.html';
    @include '../template/database.php';
    $error = null;
    $sid = null;
    $month = null;

    if (isset($_POST['submit_fees'])) {
        $month = $_POST['month'];
        $fees = $_POST['fee_amount'];

        $update = "UPDATE tuition_fees SET $month = '$fees'";
        mysqli_query($conn, $update);
        $select = "SELECT 
                        s_id,
                        dues,
                        paid,
                        extra,
                        jan_24 + feb_24 + mar_24 + apr_24 + may_24 + jun_24 +
                        jul_24 + aug_24 + sep_24 + oct_24 + nov_24 + dec_24 +
                        jan_25 + feb_25 + mar_25 + apr_25 + may_25 + jun_25 +
                        jul_25 + aug_25 + sep_25 + oct_25 + nov_25 + dec_25 AS totalSum
                    FROM tuition_fees
                    GROUP BY s_id";
        $result = mysqli_query($conn, $select);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $sid = $row['s_id'];
                $totalSum = $row['totalSum'];
                $paid = $row['paid'];

                if ($totalSum > $paid) {
                    $dues = $totalSum - $paid;
                    $extra = '0';
                } else {
                    $extra = $paid - $totalSum;
                    $dues = '0';
                }

                $update = "UPDATE tuition_fees 
                            SET dues = '$dues',
                                extra = '$extra',
                                total = '$totalSum'
                            WHERE
                                s_id = $sid";
                mysqli_query($conn, $update);
            }
        }
        $result = mysqli_query($conn, $select);
        $row = mysqli_fetch_assoc($result);

        header('location: accounts_student_fees.php');
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
        <title>Accounts fees</title>
    </head>

    <body>
        <hr>
        <div class="container my-3">
            <h4 class="text-danger fw-bold"><?php echo $error ?></h4>
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
                    <button class="btn btn-dark mx-2 btn-sm" name="Search">Class Search</button>
                </div>
                <button class="btn btn-danger mx-2 btn-sm" name="List">Full List</button>
                <button class="btn btn-secondary mx-2 btn-sm" name="dueList">Due List</button>
                <button class="btn btn-secondary mx-2 btn-sm" name="clrList">Clear List</button>
                <button class="btn btn-primary mx-2 btn-sm " name="AddFees">Add Fees</button>
            </form>
        </div>
        <div class="container">
            <table class="table">
                <tbody>
                    <?php
                    if (isset($_POST['AddFees'])) {
                        $_POST['Search2'] = false;
                        $_POST['Search'] = false;
                        $_POST['Proapproval'] = false;
                        $_POST['List'] = false; ?>
                        <form method="post">
                            <hr>
                            <div class="my-1">
                                <div class="my-3">
                                    <label>Month:</label>
                                    <select name="month" class="form-control">
                                        <option value="0" name="month">Select Month</option>
                                        <option value="jan_24" name="month">January, 24</option>
                                        <option value="feb_24" name="month">February, 24</option>
                                        <option value="mar_24" name="month">March, 24</option>
                                        <option value="apr_24" name="month">April, 24</option>
                                        <option value="may_24" name="month">May, 24</option>
                                        <option value="jun_24" name="month">June, 24</option>
                                        <option value="jul_24" name="month">July, 24</option>
                                        <option value="aug_24" name="month">August, 24</option>
                                        <option value="sep_24" name="month">September, 24</option>
                                        <option value="oct_24" name="month">October, 24</option>
                                        <option value="nov_24" name="month">November, 24</option>
                                        <option value="dec_24" name="month">December, 24</option>
                                        <option value="jan_25" name="month">January, 25</option>
                                        <option value="feb_25" name="month">February, 25</option>
                                        <option value="mar_25" name="month">March, 25</option>
                                        <option value="apr_25" name="month">April, 25</option>
                                        <option value="may_25" name="month">May, 25</option>
                                        <option value="jun_25" name="month">June, 25</option>
                                        <option value="jul_25" name="month">July, 25</option>
                                        <option value="aug_25" name="month">August, 25</option>
                                        <option value="sep_25" name="month">September, 25</option>
                                        <option value="oct_25" name="month">October, 25</option>
                                        <option value="nov_25" name="month">November, 25</option>
                                        <option value="dec_25" name="month">December, 25</option>
                                    </select>
                                </div>
                                <div class="my-3">
                                    <label>Fees amount: </label>
                                    <input type="number" class="form-control" name="fee_amount" placeholder="Enter the Tuition fees here">
                                </div>
                                <div class="my-3">
                                    <button class="btn btn-warning mx-2" name="submit_fees">Confirm Fees</button>
                                </div>
                            <?php
                    } 
                        
                        
                    elseif (isset($_POST['List'])) {
                            $_POST['Search2'] = false;
                            $_POST['Search'] = false;
                            $_POST['Proapproval'] = false;
                            $_POST['approval'] = false;
                            $_POST['AddStudent'] = false;
                            echo '<thead class="table-dark">
                            <tr>
                                <th scope="col" class="fw-normal">Sl.</th>
                                <th scope="col" class="fw-normal">St_ID</th>
                                <th scope="col" class="fw-normal">Name</th>
                                <th scope="col" class="fw-normal">Class</th>
                                <th scope="col" class="fw-normal">Section</th>
                                <th scope="col" class="fw-normal">Total</th>
                                <th scope="col" class="fw-normal">Paid</th>
                                <th scope="col" class="fw-normal">Dues</th>
                                <th scope="col" class="fw-normal">Extra</th>
                            </tr>
                        </thead>';
                            $select = "SELECT
                                ROW_NUMBER() OVER (ORDER BY u.id DESC) AS sl,
                                f.s_id,
                                u.name,
                                c.class_name AS class,
                                sec.section_name AS section,
                                f.total,
                                f.paid,
                                f.dues,
                                f.extra
                            FROM
                                users u
                            RIGHT JOIN students s ON u.id = s.user_id
                            LEFT JOIN classes c ON c.class_id = s.class_id
                            LEFT JOIN sections sec ON sec.section_id = s.section_id
                            LEFT JOIN tuition_fees f ON s.student_id = f.s_id
                            ORDER BY u.id DESC";
                            $result = mysqli_query($conn, $select);
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $sl = $row['sl'];
                                    $sid = $row['s_id'];
                                    $name = $row['name'];
                                    $class = $row['class'];
                                    $section = $row['section'];
                                    $total = $row['total'];
                                    $paid = $row['paid'];
                                    $dues = $row['dues'];
                                    $extra = $row['extra'];
                                    echo '<tr>
                        <td class="fw-light">' . $sl . '</th>
                        <td class="fw-light">' . $sid . '</th>
                        <td class="fw-light">' . $name . '</th>
                        <td class="fw-light">' . $class . '</th>
                        <td class="fw-light">' . $section . '</th>
                        <td class="fw-light">' . $total . '</th>
                        <td class="fw-light">' . $paid . '</th>
                        <td class="fw-light">' . $dues . '</th>
                        <td class="fw-light">' . $extra . '</th>
                        </tr>    ';
                                }
                            }
                    }
                        
                    elseif (isset($_POST['dueList'])) {
                        $_POST['Search2'] = false;
                        $_POST['Search'] = false;
                        $_POST['Proapproval'] = false;
                        $_POST['approval'] = false;
                        $_POST['AddStudent'] = false;
                        echo '<thead class="table-dark">
                                <tr>
                                    <th scope="col" class="fw-normal">Sl.</th>
                                    <th scope="col" class="fw-normal">St_ID</th>
                                    <th scope="col" class="fw-normal">Name</th>
                                    <th scope="col" class="fw-normal">Class</th>
                                    <th scope="col" class="fw-normal">Section</th>
                                    <th scope="col" class="fw-normal">Total</th>
                                    <th scope="col" class="fw-normal">Paid</th>
                                    <th scope="col" class="fw-normal">Dues</th>
                                    <th scope="col" class="fw-normal">Extra</th>
                                </tr>
                            </thead>';
                        $select = "SELECT
                            ROW_NUMBER() OVER (ORDER BY u.id DESC) AS sl,
                            f.s_id,
                            u.name,
                            c.class_name AS class,
                            sec.section_name AS section,
                            f.total,
                            f.paid,
                            f.dues,
                            f.extra
                        FROM
                            users u
                        RIGHT JOIN students s ON u.id = s.user_id
                        LEFT JOIN classes c ON c.class_id = s.class_id
                        LEFT JOIN sections sec ON sec.section_id = s.section_id
                        LEFT JOIN tuition_fees f ON s.student_id = f.s_id
                        WHERE f.dues > '0'
                        ORDER BY u.id DESC";
                        $result = mysqli_query($conn, $select);
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $sl = $row['sl'];
                                $sid = $row['s_id'];
                                $name = $row['name'];
                                $class = $row['class'];
                                $section = $row['section'];
                                $total = $row['total'];
                                $paid = $row['paid'];
                                $dues = $row['dues'];
                                $extra = $row['extra'];
                                echo '<tr>
                            <td class="fw-light">' . $sl . '</th>
                            <td class="fw-light">' . $sid . '</th>
                            <td class="fw-light">' . $name . '</th>
                            <td class="fw-light">' . $class . '</th>
                            <td class="fw-light">' . $section . '</th>
                            <td class="fw-light">' . $total . '</th>
                            <td class="fw-light">' . $paid . '</th>
                            <td class="fw-light">' . $dues . '</th>
                            <td class="fw-light">' . $extra . '</th>
                            </tr>    ';
                                    }
                                }
                    }
                    
                    elseif (isset($_POST['clrList'])) {
                        $_POST['Search2'] = false;
                        $_POST['Search'] = false;
                        $_POST['Proapproval'] = false;
                        $_POST['approval'] = false;
                        $_POST['AddStudent'] = false;
                        echo '<thead class="table-dark">
                                <tr>
                                    <th scope="col" class="fw-normal">Sl.</th>
                                    <th scope="col" class="fw-normal">St_ID</th>
                                    <th scope="col" class="fw-normal">Name</th>
                                    <th scope="col" class="fw-normal">Class</th>
                                    <th scope="col" class="fw-normal">Section</th>
                                    <th scope="col" class="fw-normal">Total</th>
                                    <th scope="col" class="fw-normal">Paid</th>
                                    <th scope="col" class="fw-normal">Dues</th>
                                    <th scope="col" class="fw-normal">Extra</th>
                                </tr>
                            </thead>';
                        $select = "SELECT
                            ROW_NUMBER() OVER (ORDER BY u.id DESC) AS sl,
                            f.s_id,
                            u.name,
                            c.class_name AS class,
                            sec.section_name AS section,
                            f.total,
                            f.paid,
                            f.dues,
                            f.extra
                        FROM
                            users u
                        RIGHT JOIN students s ON u.id = s.user_id
                        LEFT JOIN classes c ON c.class_id = s.class_id
                        LEFT JOIN sections sec ON sec.section_id = s.section_id
                        LEFT JOIN tuition_fees f ON s.student_id = f.s_id
                        WHERE f.dues = '0'
                        ORDER BY u.id DESC";
                        $result = mysqli_query($conn, $select);
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $sl = $row['sl'];
                                $sid = $row['s_id'];
                                $name = $row['name'];
                                $class = $row['class'];
                                $section = $row['section'];
                                $total = $row['total'];
                                $paid = $row['paid'];
                                $dues = $row['dues'];
                                $extra = $row['extra'];
                                echo '<tr>
                            <td class="fw-light">' . $sl . '</th>
                            <td class="fw-light">' . $sid . '</th>
                            <td class="fw-light">' . $name . '</th>
                            <td class="fw-light">' . $class . '</th>
                            <td class="fw-light">' . $section . '</th>
                            <td class="fw-light">' . $total . '</th>
                            <td class="fw-light">' . $paid . '</th>
                            <td class="fw-light">' . $dues . '</th>
                            <td class="fw-light">' . $extra . '</th>
                            </tr>    ';
                                    }
                                }
                    }
                    
                    elseif (isset($_POST['Search'])) {

                            $class = $_POST['class'];
                            $section = $_POST['section'];
                            echo '<thead class="table-dark">
                            <tr>
                                <th scope="col" class="fw-normal">Sl.</th>
                                <th scope="col" class="fw-normal">St_ID</th>
                                <th scope="col" class="fw-normal">Name</th>
                                <th scope="col" class="fw-normal">Class</th>
                                <th scope="col" class="fw-normal">Section</th>
                                <th scope="col" class="fw-normal">Total</th>
                                <th scope="col" class="fw-normal">Paid</th>
                                <th scope="col" class="fw-normal">Dues</th>
                                <th scope="col" class="fw-normal">Extra</th>
                            </tr>
                        </thead>';
                            $select = "SELECT
                                ROW_NUMBER() OVER (ORDER BY u.id DESC) AS sl,
                                f.s_id,
                                s.class_id,
                                s.section_id,
                                u.name,
                                c.class_name AS class,
                                sec.section_name AS section,
                                f.total,
                                f.paid,
                                f.dues,
                                f.extra
                            FROM
                                users u
                            RIGHT JOIN students s ON u.id = s.user_id
                            LEFT JOIN classes c ON c.class_id = s.class_id
                            LEFT JOIN sections sec ON sec.section_id = s.section_id
                            LEFT JOIN tuition_fees f ON s.student_id = f.s_id
                            WHERE s.class_id = '$class' and s.section_id = '$section'
                            ORDER BY u.id DESC";
                            $result = mysqli_query($conn, $select);
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $sl = $row['sl'];
                                    $sid = $row['s_id'];
                                    $name = $row['name'];
                                    $class = $row['class'];
                                    $section = $row['section'];
                                    $total = $row['total'];
                                    $paid = $row['paid'];
                                    $dues = $row['dues'];
                                    $extra = $row['extra'];
                                    echo '<tr>
                        <td class="fw-light">' . $sl . '</th>
                        <td class="fw-light">' . $sid . '</th>
                        <td class="fw-light">' . $name . '</th>
                        <td class="fw-light">' . $class . '</th>
                        <td class="fw-light">' . $section . '</th>
                        <td class="fw-light">' . $total . '</th>
                        <td class="fw-light">' . $paid . '</th>
                        <td class="fw-light">' . $dues . '</th>
                        <td class="fw-light">' . $extra . '</th>
                        </tr>    ';
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

        function confirmUPDelete(uid) {
            var result = confirm("Are you sure you want to delete this Student?");
            if (result) {
                window.location.href = 'admin_student_delete_update_details.php?deleteUID=' + uid;
            }
        }
    </script>

<?php
    include '../template/admin_footer.html';
} else {
    header('location: ../login.php');
}
?>