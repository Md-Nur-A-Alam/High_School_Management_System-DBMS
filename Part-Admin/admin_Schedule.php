<?php
session_start();
include '../template/admin_header.html';
include '../template/database.php';
$cl = null;
$sec = null;

if (isset($_POST['update'])) {
    $cl = ($_POST['class_u']);
    $sec = ($_POST['section_u']);
    // $s11 = ($_POST['s11']);
    // $s12 = ($_POST['s12']);
    // $s13 = ($_POST['s13']);
    // $s14 = ($_POST['s14']);
    // $s15 = ($_POST['s15']);
    // $s16 = ($_POST['s16']);
    // $t11 = ($_POST['t11']);
    // $t12 = ($_POST['t12']);
    // $t13 = ($_POST['t13']);
    // $t14 = ($_POST['t14']);
    // $t15 = ($_POST['t15']);
    // $t16 = ($_POST['t16']);
    $s21 = ($_POST['s21']);
    $s22 = ($_POST['s22']);
    $s23 = ($_POST['s23']);
    $s24 = ($_POST['s24']);
    $s25 = ($_POST['s25']);
    $s26 = ($_POST['s26']);
    $t21 = ($_POST['t21']);
    $t22 = ($_POST['t22']);
    $t23 = ($_POST['t23']);
    $t24 = ($_POST['t24']);
    $t25 = ($_POST['t25']);
    $t26 = ($_POST['t26']);
    $s31 = ($_POST['s31']);
    $s32 = ($_POST['s32']);
    $s33 = ($_POST['s33']);
    $s34 = ($_POST['s34']);
    $s35 = ($_POST['s35']);
    $s36 = ($_POST['s36']);
    $t31 = ($_POST['t31']);
    $t32 = ($_POST['t32']);
    $t33 = ($_POST['t33']);
    $t34 = ($_POST['t34']);
    $t35 = ($_POST['t35']);
    $t36 = ($_POST['t36']);
    $s41 = ($_POST['s41']);
    $s42 = ($_POST['s42']);
    $s43 = ($_POST['s43']);
    $s44 = ($_POST['s44']);
    $s45 = ($_POST['s45']);
    $s46 = ($_POST['s46']);
    $t41 = ($_POST['t41']);
    $t42 = ($_POST['t42']);
    $t43 = ($_POST['t43']);
    $t44 = ($_POST['t44']);
    $t45 = ($_POST['t45']);
    $t46 = ($_POST['t46']);
    $s51 = ($_POST['s51']);
    $s52 = ($_POST['s52']);
    $s53 = ($_POST['s53']);
    $s54 = ($_POST['s54']);
    $s55 = ($_POST['s55']);
    $s56 = ($_POST['s56']);
    $t51 = ($_POST['t51']);
    $t52 = ($_POST['t52']);
    $t53 = ($_POST['t53']);
    $t54 = ($_POST['t54']);
    $t55 = ($_POST['t55']);
    $t56 = ($_POST['t56']);
    $s61 = ($_POST['s61']);
    $s62 = ($_POST['s62']);
    $s63 = ($_POST['s63']);
    $s64 = ($_POST['s64']);
    $s65 = ($_POST['s65']);
    $s66 = ($_POST['s66']);
    $t61 = ($_POST['t61']);
    $t62 = ($_POST['t62']);
    $t63 = ($_POST['t63']);
    $t64 = ($_POST['t64']);
    $t65 = ($_POST['t65']);
    $t66 = ($_POST['t66']);

    // echo "{$cl} - {$sec}<br>
    // {$s21} - {$s22} - {$s23} - {$s24} - {$s25} - {$s26}<br>
    // {$t21} - {$t22} - {$t23} - {$t24} - {$t25} - {$t26}<br>
    // {$s31} - {$s32} - {$s33} - {$s34} - {$s35} - {$s36}<br>
    // {$t31} - {$t32} - {$t33} - {$t34} - {$t35} - {$t36}<br>";

    $u2 = "UPDATE class_routine
        SET 
            1st_subject_id = $s21,
            2nd_subject_id = $s22,
            3rd_subject_id = $s23,
            4th_subject_id = $s24,
            5th_subject_id = $s25,
            6th_subject_id = $s26,
            1st_teacher_id = $t21,
            2nd_teacher_id = $t22,
            3rd_teacher_id = $t23,
            4th_teacher_id = $t24,
            5th_teacher_id = $t25,
            6th_teacher_id = $t26
        WHERE class_id = $cl AND section_id = $sec AND day = 'Sun'";

    $u3 = "UPDATE class_routine
        SET 
            1st_subject_id = $s31,
            2nd_subject_id = $s32,
            3rd_subject_id = $s33,
            4th_subject_id = $s34,
            5th_subject_id = $s35,
            6th_subject_id = $s36,
            1st_teacher_id = $t31,
            2nd_teacher_id = $t32,
            3rd_teacher_id = $t33,
            4th_teacher_id = $t34,
            5th_teacher_id = $t35,
            6th_teacher_id = $t36
        WHERE class_id = $cl AND section_id = $sec AND day = 'Mon'";

    $u4 = "UPDATE class_routine
        SET 
            1st_subject_id = $s41,
            2nd_subject_id = $s42,
            3rd_subject_id = $s43,
            4th_subject_id = $s44,
            5th_subject_id = $s45,
            6th_subject_id = $s46,
            1st_teacher_id = $t41,
            2nd_teacher_id = $t42,
            3rd_teacher_id = $t43,
            4th_teacher_id = $t44,
            5th_teacher_id = $t45,
            6th_teacher_id = $t46
        WHERE class_id = $cl AND section_id = $sec AND day = 'Tue'";

    $u5 = "UPDATE class_routine
        SET 
            1st_subject_id = $s51,
            2nd_subject_id = $s52,
            3rd_subject_id = $s53,
            4th_subject_id = $s54,
            5th_subject_id = $s55,
            6th_subject_id = $s56,
            1st_teacher_id = $t51,
            2nd_teacher_id = $t52,
            3rd_teacher_id = $t53,
            4th_teacher_id = $t54,
            5th_teacher_id = $t55,
            6th_teacher_id = $t56
        WHERE class_id = $cl AND section_id = $sec AND day = 'Wed'";

    $u6 = "UPDATE class_routine
        SET 
            1st_subject_id = $s61,
            2nd_subject_id = $s62,
            3rd_subject_id = $s63,
            4th_subject_id = $s64,
            5th_subject_id = $s65,
            6th_subject_id = $s66,
            1st_teacher_id = $t61,
            2nd_teacher_id = $t62,
            3rd_teacher_id = $t63,
            4th_teacher_id = $t64,
            5th_teacher_id = $t65,
            6th_teacher_id = $t66
        WHERE class_id = $cl AND section_id = $sec AND day = 'Thu';";

    mysqli_query($conn, $u2);
    mysqli_query($conn, $u3);
    mysqli_query($conn, $u4);
    mysqli_query($conn, $u5);
    mysqli_query($conn, $u6);
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
    <title>Admin Schedule</title>
</head>

<body>
    <div class="container my-5">
        <form method="post">
            <h2>Schedule:</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">
                            <select class="form-select" name="class">
                                <option value="6" name="class">Class 6</option>
                                <option value="7" name="class">Class 7</option>
                                <option value="8" name="class">Class 8</option>
                                <option value="9" name="class">Class 9</option>
                                <option value="10" name="class">Class 10</option>
                            </select>
                        </th>
                        <th scope="col">
                            <select class="form-select" name="section">
                                <option value="1" name="section">A</option>
                                <option value="2" name="section">B</option>
                                <option value="3" name="section">C</option>
                            </select>
                        </th>
                        <th scope="col">
                            <button type="submit" class="btn btn-dark" name="Search">Search</button>
                        </th>
                    </tr>
                </thead>
            </table>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Day</th>
                    <th scope="col">1st</th>
                    <th scope="col">2nd</th>
                    <th scope="col">3rd</th>
                    <th scope="col">4th</th>
                    <th scope="col">5th</th>
                    <th scope="col">6th</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_POST['Search'])) {
                    $class = ($_POST['class']);
                    $section = ($_POST['section']);
                    $select = "SELECT
                            cr.day as d,
                            s1.subject_name AS s_1,
                            u1.name AS t_1,
                            s2.subject_name AS s_2,
                            u2.name AS t_2,
                            s3.subject_name AS s_3,
                            u3.name AS t_3,
                            s4.subject_name AS s_4,
                            u4.name AS t_4,
                            s5.subject_name AS s_5,
                            u5.name AS t_5,
                            s6.subject_name AS s_6,
                            u6.name AS t_6
                        FROM class_routine cr
                        LEFT JOIN subjects s1 ON cr.1st_subject_id = s1.subject_id
                        LEFT JOIN teachers t1 ON cr.1st_teacher_id = t1.teacher_id
                        LEFT JOIN users u1 ON t1.user_id = u1.id
                        LEFT JOIN subjects s2 ON cr.2nd_subject_id = s2.subject_id
                        LEFT JOIN teachers t2 ON cr.2nd_teacher_id = t2.teacher_id
                        LEFT JOIN users u2 ON t2.user_id = u2.id
                        LEFT JOIN subjects s3 ON cr.3rd_subject_id = s3.subject_id
                        LEFT JOIN teachers t3 ON cr.3rd_teacher_id = t3.teacher_id
                        LEFT JOIN users u3 ON t3.user_id = u3.id
                        LEFT JOIN subjects s4 ON cr.4th_subject_id = s4.subject_id
                        LEFT JOIN teachers t4 ON cr.4th_teacher_id = t4.teacher_id
                        LEFT JOIN users u4 ON t4.user_id = u4.id
                        LEFT JOIN subjects s5 ON cr.5th_subject_id = s5.subject_id
                        LEFT JOIN teachers t5 ON cr.5th_teacher_id = t5.teacher_id
                        LEFT JOIN users u5 ON t5.user_id = u5.id
                        LEFT JOIN subjects s6 ON cr.6th_subject_id = s6.subject_id
                        LEFT JOIN teachers t6 ON cr.6th_teacher_id = t6.teacher_id
                        LEFT JOIN users u6 ON t6.user_id = u6.id
                        WHERE cr.class_id = $class AND cr.section_id = $section and cr.day<> 'Fri' and cr.day<> 'Sat'";

                    $result = mysqli_query($conn, $select);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $d = $row['d'];
                            $s1 = $row['s_1'];
                            $t1 = $row['t_1'];
                            $s2 = $row['s_2'];
                            $t2 = $row['t_2'];
                            $s3 = $row['s_3'];
                            $t3 = $row['t_3'];
                            $s4 = $row['s_4'];
                            $t4 = $row['t_4'];
                            $s5 = $row['s_5'];
                            $t5 = $row['t_5'];
                            $s6 = $row['s_6'];
                            $t6 = $row['t_6'];
                            echo '<tr>
                                <th rowspan="2">' . $d . '</th>
                                <td>' . $s1 . '</td>
                                <td>' . $s2 . '</td>
                                <td>' . $s3 . '</td>
                                <td>' . $s4 . '</td>
                                <td>' . $s5 . '</td>
                                <td>' . $s6 . '</td>
                            </tr>
                            <tr>
                                <td>' . $t1 . '</td>
                                <td>' . $t2 . '</td>
                                <td>' . $t3 . '</td>
                                <td>' . $t4 . '</td>
                                <td>' . $t5 . '</td>
                                <td>' . $t6 . '</td>
                            </tr>';
                        }
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <hr>
    <div class="container my-5">

        <table class="table table-bordered">
            <thead class="table-success">
                <tr>
                    <th scope="col">Bangla</th>
                    <th scope="col">English</th>
                    <th scope="col">Mathematics</th>
                    <th scope="col">Religion</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>
                        <?php
                        $sql = "SELECT t.teacher_id AS id, u.name AS name
                                    FROM subjects s
                                    LEFT JOIN teachers t ON s.subject_id = t.subject_id
                                    LEFT JOIN users u ON t.user_id = u.id
                                    WHERE s.subject_id = 1
                                    ORDER BY u.`name`";

                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-danger" scope="col">ID</th>
                                                    <th scope="col">Names</th>
                                                </tr>
                                            </thead>
                                            <tbody>';

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<th class="text-danger">' . ($row['id'] ? $row['id'] : ' - ') . '</th>';
                                echo '<td>' . ($row['name'] ? $row['name'] : '- - - - -') . '</td>';
                                echo '</tr>';
                            }

                            echo '</tbody></table>';
                        } else {
                            echo "No data found.";
                        }
                        ?>
                    </th>
                    <th>
                        <?php
                        $sql = "SELECT t.teacher_id AS id, u.name AS name
                                    FROM subjects s
                                    LEFT JOIN teachers t ON s.subject_id = t.subject_id
                                    LEFT JOIN users u ON t.user_id = u.id
                                    WHERE s.subject_id = 2
                                    ORDER BY u.`name`";

                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-danger" scope="col">ID</th>
                                                    <th scope="col">Names</th>
                                                </tr>
                                            </thead>
                                            <tbody>';

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<th class="text-danger">' . ($row['id'] ? $row['id'] : ' - ') . '</th>';
                                echo '<td>' . ($row['name'] ? $row['name'] : '- - - - -') . '</td>';
                                echo '</tr>';
                            }

                            echo '</tbody></table>';
                        } else {
                            echo "No data found.";
                        }
                        ?>
                    </th>
                    <th>
                        <?php
                        $sql = "SELECT t.teacher_id AS id, u.name AS name
                                    FROM subjects s
                                    LEFT JOIN teachers t ON s.subject_id = t.subject_id
                                    LEFT JOIN users u ON t.user_id = u.id
                                    WHERE s.subject_id = 3
                                    ORDER BY u.`name`";

                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-danger" scope="col">ID</th>
                                                    <th scope="col">Names</th>
                                                </tr>
                                            </thead>
                                            <tbody>';

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<th class="text-danger">' . ($row['id'] ? $row['id'] : ' - ') . '</th>';
                                echo '<td>' . ($row['name'] ? $row['name'] : '- - - - -') . '</td>';
                                echo '</tr>';
                            }

                            echo '</tbody></table>';
                        } else {
                            echo "No data found.";
                        }
                        ?>
                    </th>
                    <th>
                        <?php
                        $sql = "SELECT t.teacher_id AS id, u.name AS name
                                    FROM subjects s
                                    LEFT JOIN teachers t ON s.subject_id = t.subject_id
                                    LEFT JOIN users u ON t.user_id = u.id
                                    WHERE s.subject_id = 10
                                    ORDER BY u.`name`";

                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-danger" scope="col">ID</th>
                                                    <th scope="col">Names</th>
                                                </tr>
                                            </thead>
                                            <tbody>';

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<th class="text-danger">' . ($row['id'] ? $row['id'] : ' - ') . '</th>';
                                echo '<td>' . ($row['name'] ? $row['name'] : '- - - - -') . '</td>';
                                echo '</tr>';
                            }

                            echo '</tbody></table>';
                        } else {
                            echo "No data found.";
                        }
                        ?>
                    </th>
                </tr>
            </tbody>
            <thead class="table-success">
                <tr>
                    <th scope="col">ICT</th>
                    <th scope="col">Science</th>
                    <th scope="col">Commerce</th>
                    <th scope="col">Arts</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>
                        <?php
                        $sql = "SELECT t.teacher_id AS id, u.name AS name
                                    FROM subjects s
                                    LEFT JOIN teachers t ON s.subject_id = t.subject_id
                                    LEFT JOIN users u ON t.user_id = u.id
                                    WHERE s.subject_id = 9
                                    ORDER BY u.`name`";

                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-danger" scope="col">ID</th>
                                                    <th scope="col">Names</th>
                                                </tr>
                                            </thead>
                                            <tbody>';

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<th class="text-danger">' . ($row['id'] ? $row['id'] : ' - ') . '</th>';
                                echo '<td>' . ($row['name'] ? $row['name'] : '- - - - -') . '</td>';
                                echo '</tr>';
                            }

                            echo '</tbody></table>';
                        } else {
                            echo "No data found.";
                        }
                        ?>
                    </th>
                    <th>
                        <?php
                        $sql = "SELECT t.teacher_id AS id, u.name AS name
                                    FROM subjects s
                                    LEFT JOIN teachers t ON s.subject_id = t.subject_id
                                    LEFT JOIN users u ON t.user_id = u.id
                                    WHERE s.subject_id = 5
                                    ORDER BY u.`name`";

                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-danger" scope="col">ID</th>
                                                    <th scope="col">Names</th>
                                                </tr>
                                            </thead>
                                            <tbody>';

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<th class="text-danger">' . ($row['id'] ? $row['id'] : ' - ') . '</th>';
                                echo '<td>' . ($row['name'] ? $row['name'] : '- - - - -') . '</td>';
                                echo '</tr>';
                            }

                            echo '</tbody></table>';
                        } else {
                            echo "No data found.";
                        }
                        ?>
                    </th>
                    <th>
                        <?php
                        $sql = "SELECT t.teacher_id AS id, u.name AS name
                                    FROM subjects s
                                    LEFT JOIN teachers t ON s.subject_id = t.subject_id
                                    LEFT JOIN users u ON t.user_id = u.id
                                    WHERE s.subject_id = 6
                                    ORDER BY u.`name`";

                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-danger" scope="col">ID</th>
                                                    <th scope="col">Names</th>
                                                </tr>
                                            </thead>
                                            <tbody>';

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<th class="text-danger">' . ($row['id'] ? $row['id'] : ' - ') . '</th>';
                                echo '<td>' . ($row['name'] ? $row['name'] : '- - - - -') . '</td>';
                                echo '</tr>';
                            }

                            echo '</tbody></table>';
                        } else {
                            echo "No data found.";
                        }
                        ?>
                    </th>
                    <th>
                        <?php
                        $sql = "SELECT t.teacher_id AS id, u.name AS name
                                    FROM subjects s
                                    LEFT JOIN teachers t ON s.subject_id = t.subject_id
                                    LEFT JOIN users u ON t.user_id = u.id
                                    WHERE s.subject_id = 7
                                    ORDER BY u.`name`";

                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-danger" scope="col">ID</th>
                                                    <th scope="col">Names</th>
                                                </tr>
                                            </thead>
                                            <tbody>';

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<th class="text-danger">' . ($row['id'] ? $row['id'] : ' - ') . '</th>';
                                echo '<td>' . ($row['name'] ? $row['name'] : '- - - - -') . '</td>';
                                echo '</tr>';
                            }

                            echo '</tbody></table>';
                        } else {
                            echo "No data found.";
                        }
                        ?>
                    </th>
                </tr>
            </tbody>
            <thead class="table-success">
                <tr>
                    <th scope="col">Social Science</th>
                    <th scope="col">Physical Education</th>
                    <th scope="col">Agriculture</th>
                    <th scope="col">Extra</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>
                        <?php
                        $sql = "SELECT t.teacher_id AS id, u.name AS name
                                    FROM subjects s
                                    LEFT JOIN teachers t ON s.subject_id = t.subject_id
                                    LEFT JOIN users u ON t.user_id = u.id
                                    WHERE s.subject_id = 4
                                    ORDER BY u.`name`";

                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-danger" scope="col">ID</th>
                                                    <th scope="col">Names</th>
                                                </tr>
                                            </thead>
                                            <tbody>';

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<th class="text-danger">' . ($row['id'] ? $row['id'] : ' - ') . '</th>';
                                echo '<td>' . ($row['name'] ? $row['name'] : '- - - - -') . '</td>';
                                echo '</tr>';
                            }

                            echo '</tbody></table>';
                        } else {
                            echo "No data found.";
                        }
                        ?>
                    </th>
                    <th>
                        <?php
                        $sql = "SELECT t.teacher_id AS id, u.name AS name
                                    FROM subjects s
                                    LEFT JOIN teachers t ON s.subject_id = t.subject_id
                                    LEFT JOIN users u ON t.user_id = u.id
                                    WHERE s.subject_id = 8
                                    ORDER BY u.`name`";

                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-danger" scope="col">ID</th>
                                                    <th scope="col">Names</th>
                                                </tr>
                                            </thead>
                                            <tbody>';

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<th class="text-danger">' . ($row['id'] ? $row['id'] : ' - ') . '</th>';
                                echo '<td>' . ($row['name'] ? $row['name'] : '- - - - -') . '</td>';
                                echo '</tr>';
                            }

                            echo '</tbody></table>';
                        } else {
                            echo "No data found.";
                        }
                        ?>
                    </th>
                    <th>
                        <?php
                        $sql = "SELECT t.teacher_id AS id, u.name AS name
                                    FROM subjects s
                                    LEFT JOIN teachers t ON s.subject_id = t.subject_id
                                    LEFT JOIN users u ON t.user_id = u.id
                                    WHERE s.subject_id = 11
                                    ORDER BY u.`name`";

                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-danger" scope="col">ID</th>
                                                    <th scope="col">Names</th>
                                                </tr>
                                            </thead>
                                            <tbody>';

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<th class="text-danger">' . ($row['id'] ? $row['id'] : ' - ') . '</th>';
                                echo '<td>' . ($row['name'] ? $row['name'] : '- - - - -') . '</td>';
                                echo '</tr>';
                            }

                            echo '</tbody></table>';
                        } else {
                            echo "No data found.";
                        }
                        ?>
                    </th>
                    <th>
                        <?php
                        $sql = "SELECT t.teacher_id AS id, u.name AS name
                                    FROM subjects s
                                    LEFT JOIN teachers t ON s.subject_id = t.subject_id
                                    LEFT JOIN users u ON t.user_id = u.id
                                    WHERE s.subject_id = 12
                                    ORDER BY u.`name`";

                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-danger" scope="col">ID</th>
                                                    <th scope="col">Names</th>
                                                </tr>
                                            </thead>
                                            <tbody>';

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<th class="text-danger">' . ($row['id'] ? $row['id'] : ' - ') . '</th>';
                                echo '<td>' . ($row['name'] ? $row['name'] : '- - - - -') . '</td>';
                                echo '</tr>';
                            }

                            echo '</tbody></table>';
                        } else {
                            echo "No data found.";
                        }
                        ?>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="container my-5">

        <form method="get"><button type="submit" class="btn btn-warning" name="Modify">Modify Schedule</button></form>

        <?php
        if (isset($_GET['Modify'])) {
            echo '
                <table class="table">
                    <tr>
                        <td class="col-4">
                            <h2 class="text-primary">Schedule Modify:</h2></button>
                        </td>
                        <td>
                        </td>
                        <td class="col-4">
                            <form method="get" ><button type="submit" class="btn btn-dark form-control" name="back">Close Schedule Modify Table</button></form>
                        </td>
                    </tr>
                </table>';

            if (isset($_GET['back'])) {
                $_GET['Modify'] = false;
            }


            echo '
                    <form method="post">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <select class="form-select" name="class_u">
                                        <option value="6" name="class_u">Class 6</option>
                                        <option value="7" name="class_u">Class 7</option>
                                        <option value="8" name="class_u">Class 8</option>
                                        <option value="9" name="class_u">Class 9</option>
                                        <option value="10" name="class_u">Class 10</option>
                                    </select>
                                </th>
                                <th scope="col">
                                    <select class="form-select" name="section_u">
                                        <option value="1" name="section_u">A</option>
                                        <option value="2" name="section_u">B</option>
                                        <option value="3" name="section_u">C</option>
                                    </select>
                                </th>
                            </tr>
                        </thead>
                    </table>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Day</th>
                            <th scope="col">1st</th>
                            <th scope="col">2nd</th>
                            <th scope="col">3rd</th>
                            <th scope="col">4th</th>
                            <th scope="col">5th</th>
                            <th scope="col">6th</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <th rowspan="2">Sun</th>
                                <td>
                                    <select class="form-select" name="s21">
                                        <option value="1" name="s21">Bangla</option>
                                        <option value="2" name="s21">English</option>
                                        <option value="3" name="s21">Math</option>
                                        <option value="4" name="s21">Social Science</option>
                                        <option value="5" name="s21">Science</option>
                                        <option value="6" name="s21">Commerce</option>
                                        <option value="7" name="s21">Arts</option>
                                        <option value="8" name="s21">Physical Education</option>
                                        <option value="9" name="s21">ICT</option>
                                        <option value="10" name="s21">Religion</option>
                                        <option value="11" name="s21">Agriculture</option>
                                        <option value="12" name="s21">Extra</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="s22">
                                        <option value="1" name="s22">Bangla</option>
                                        <option value="2" name="s22">English</option>
                                        <option value="3" name="s22">Math</option>
                                        <option value="4" name="s22">Social Science</option>
                                        <option value="5" name="s22">Science</option>
                                        <option value="6" name="s22">Commerce</option>
                                        <option value="7" name="s22">Arts</option>
                                        <option value="8" name="s22">Physical Education</option>
                                        <option value="9" name="s22">ICT</option>
                                        <option value="10" name="s22">Religion</option>
                                        <option value="11" name="s22">Agriculture</option>
                                        <option value="12" name="s22">Extra</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="s23">
                                        <option value="1" name="s23">Bangla</option>
                                        <option value="2" name="s23">English</option>
                                        <option value="3" name="s23">Math</option>
                                        <option value="4" name="s23">Social Science</option>
                                        <option value="5" name="s23">Science</option>
                                        <option value="6" name="s23">Commerce</option>
                                        <option value="7" name="s23">Arts</option>
                                        <option value="8" name="s23">Physical Education</option>
                                        <option value="9" name="s23">ICT</option>
                                        <option value="10" name="s23">Religion</option>
                                        <option value="11" name="s23">Agriculture</option>
                                        <option value="12" name="s23">Extra</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="s24">
                                        <option value="1" name="s24">Bangla</option>
                                        <option value="2" name="s24">English</option>
                                        <option value="3" name="s24">Math</option>
                                        <option value="4" name="s24">Social Science</option>
                                        <option value="5" name="s24">Science</option>
                                        <option value="6" name="s24">Commerce</option>
                                        <option value="7" name="s24">Arts</option>
                                        <option value="8" name="s24">Physical Education</option>
                                        <option value="9" name="s24">ICT</option>
                                        <option value="10" name="s24">Religion</option>
                                        <option value="11" name="s24">Agriculture</option>
                                        <option value="12" name="s24">Extra</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="s25">
                                        <option value="1" name="s25">Bangla</option>
                                        <option value="2" name="s25">English</option>
                                        <option value="3" name="s25">Math</option>
                                        <option value="4" name="s25">Social Science</option>
                                        <option value="5" name="s25">Science</option>
                                        <option value="6" name="s25">Commerce</option>
                                        <option value="7" name="s25">Arts</option>
                                        <option value="8" name="s25">Physical Education</option>
                                        <option value="9" name="s25">ICT</option>
                                        <option value="10" name="s25">Religion</option>
                                        <option value="11" name="s25">Agriculture</option>
                                        <option value="12" name="s25">Extra</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="s26">
                                        <option value="1" name="s26">Bangla</option>
                                        <option value="2" name="s26">English</option>
                                        <option value="3" name="s26">Math</option>
                                        <option value="4" name="s26">Social Science</option>
                                        <option value="5" name="s26">Science</option>
                                        <option value="6" name="s26">Commerce</option>
                                        <option value="7" name="s26">Arts</option>
                                        <option value="8" name="s26">Physical Education</option>
                                        <option value="9" name="s26">ICT</option>
                                        <option value="10" name="s26">Religion</option>
                                        <option value="11" name="s26">Agriculture</option>
                                        <option value="12" name="s26">Extra</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="text" class="form-control" required placeholder="t id.." name="t21"></td>
                                <td><input type="text" class="form-control" required placeholder="t id.." name="t22"></td>
                                <td><input type="text" class="form-control" required placeholder="t id.." name="t23"></td>
                                <td><input type="text" class="form-control" required placeholder="t id.." name="t24"></td>
                                <td><input type="text" class="form-control" required placeholder="t id.." name="t25"></td>
                                <td><input type="text" class="form-control" required placeholder="t id.." name="t26"></td>
                            </tr>
                            <tr>
                                <th rowspan="2">Mon</th>
                                <td>
                                    <select class="form-select" name="s31">
                                        <option value="1" name="s31">Bangla</option>
                                        <option value="2" name="s31">English</option>
                                        <option value="3" name="s31">Math</option>
                                        <option value="4" name="s31">Social Science</option>
                                        <option value="5" name="s31">Science</option>
                                        <option value="6" name="s31">Commerce</option>
                                        <option value="7" name="s31">Arts</option>
                                        <option value="8" name="s31">Physical Education</option>
                                        <option value="9" name="s31">ICT</option>
                                        <option value="10" name="s31">Religion</option>
                                        <option value="11" name="s31">Agriculture</option>
                                        <option value="12" name="s31">Extra</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="s32">
                                        <option value="1" name="s32">Bangla</option>
                                        <option value="2" name="s32">English</option>
                                        <option value="3" name="s32">Math</option>
                                        <option value="4" name="s32">Social Science</option>
                                        <option value="5" name="s32">Science</option>
                                        <option value="6" name="s32">Commerce</option>
                                        <option value="7" name="s32">Arts</option>
                                        <option value="8" name="s32">Physical Education</option>
                                        <option value="9" name="s32">ICT</option>
                                        <option value="10" name="s32">Religion</option>
                                        <option value="11" name="s32">Agriculture</option>
                                        <option value="12" name="s32">Extra</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="s33">
                                        <option value="1" name="s33">Bangla</option>
                                        <option value="2" name="s33">English</option>
                                        <option value="3" name="s33">Math</option>
                                        <option value="4" name="s33">Social Science</option>
                                        <option value="5" name="s33">Science</option>
                                        <option value="6" name="s33">Commerce</option>
                                        <option value="7" name="s33">Arts</option>
                                        <option value="8" name="s33">Physical Education</option>
                                        <option value="9" name="s33">ICT</option>
                                        <option value="10" name="s33">Religion</option>
                                        <option value="11" name="s33">Agriculture</option>
                                        <option value="12" name="s33">Extra</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="s34">
                                        <option value="1" name="s34">Bangla</option>
                                        <option value="2" name="s34">English</option>
                                        <option value="3" name="s34">Math</option>
                                        <option value="4" name="s34">Social Science</option>
                                        <option value="5" name="s34">Science</option>
                                        <option value="6" name="s34">Commerce</option>
                                        <option value="7" name="s34">Arts</option>
                                        <option value="8" name="s34">Physical Education</option>
                                        <option value="9" name="s34">ICT</option>
                                        <option value="10" name="s34">Religion</option>
                                        <option value="11" name="s34">Agriculture</option>
                                        <option value="12" name="s34">Extra</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="s35">
                                        <option value="1" name="s35">Bangla</option>
                                        <option value="2" name="s35">English</option>
                                        <option value="3" name="s35">Math</option>
                                        <option value="4" name="s35">Social Science</option>
                                        <option value="5" name="s35">Science</option>
                                        <option value="6" name="s35">Commerce</option>
                                        <option value="7" name="s35">Arts</option>
                                        <option value="8" name="s35">Physical Education</option>
                                        <option value="9" name="s35">ICT</option>
                                        <option value="10" name="s35">Religion</option>
                                        <option value="11" name="s35">Agriculture</option>
                                        <option value="12" name="s35">Extra</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="s36">
                                        <option value="1" name="s36">Bangla</option>
                                        <option value="2" name="s36">English</option>
                                        <option value="3" name="s36">Math</option>
                                        <option value="4" name="s36">Social Science</option>
                                        <option value="5" name="s36">Science</option>
                                        <option value="6" name="s36">Commerce</option>
                                        <option value="7" name="s36">Arts</option>
                                        <option value="8" name="s36">Physical Education</option>
                                        <option value="9" name="s36">ICT</option>
                                        <option value="10" name="s36">Religion</option>
                                        <option value="11" name="s36">Agriculture</option>
                                        <option value="12" name="s36">Extra</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="text" class="form-control" required placeholder="t id.." name="t31"></td>
                                <td><input type="text" class="form-control" required placeholder="t id.." name="t32"></td>
                                <td><input type="text" class="form-control" required placeholder="t id.." name="t33"></td>
                                <td><input type="text" class="form-control" required placeholder="t id.." name="t34"></td>
                                <td><input type="text" class="form-control" required placeholder="t id.." name="t35"></td>
                                <td><input type="text" class="form-control" required placeholder="t id.." name="t36"></td>
                            </tr>
                            <tr>
                                <th rowspan="2">Tue</th>
                                <td>
                                    <select class="form-select" name="s41">
                                        <option value="1" name="s41">Bangla</option>
                                        <option value="2" name="s41">English</option>
                                        <option value="3" name="s41">Math</option>
                                        <option value="4" name="s41">Social Science</option>
                                        <option value="5" name="s41">Science</option>
                                        <option value="6" name="s41">Commerce</option>
                                        <option value="7" name="s41">Arts</option>
                                        <option value="8" name="s41">Physical Education</option>
                                        <option value="9" name="s41">ICT</option>
                                        <option value="10" name="s41">Religion</option>
                                        <option value="11" name="s41">Agriculture</option>
                                        <option value="12" name="s41">Extra</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="s42">
                                        <option value="1" name="s42">Bangla</option>
                                        <option value="2" name="s42">English</option>
                                        <option value="3" name="s42">Math</option>
                                        <option value="4" name="s42">Social Science</option>
                                        <option value="5" name="s42">Science</option>
                                        <option value="6" name="s42">Commerce</option>
                                        <option value="7" name="s42">Arts</option>
                                        <option value="8" name="s42">Physical Education</option>
                                        <option value="9" name="s42">ICT</option>
                                        <option value="10" name="s42">Religion</option>
                                        <option value="11" name="s42">Agriculture</option>
                                        <option value="12" name="s42">Extra</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="s43">
                                        <option value="1" name="s43">Bangla</option>
                                        <option value="2" name="s43">English</option>
                                        <option value="3" name="s43">Math</option>
                                        <option value="4" name="s43">Social Science</option>
                                        <option value="5" name="s43">Science</option>
                                        <option value="6" name="s43">Commerce</option>
                                        <option value="7" name="s43">Arts</option>
                                        <option value="8" name="s43">Physical Education</option>
                                        <option value="9" name="s43">ICT</option>
                                        <option value="10" name="s43">Religion</option>
                                        <option value="11" name="s43">Agriculture</option>
                                        <option value="12" name="s43">Extra</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="s44">
                                        <option value="1" name="s44">Bangla</option>
                                        <option value="2" name="s44">English</option>
                                        <option value="3" name="s44">Math</option>
                                        <option value="4" name="s44">Social Science</option>
                                        <option value="5" name="s44">Science</option>
                                        <option value="6" name="s44">Commerce</option>
                                        <option value="7" name="s44">Arts</option>
                                        <option value="8" name="s44">Physical Education</option>
                                        <option value="9" name="s44">ICT</option>
                                        <option value="10" name="s44">Religion</option>
                                        <option value="11" name="s44">Agriculture</option>
                                        <option value="12" name="s44">Extra</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="s45">
                                        <option value="1" name="s45">Bangla</option>
                                        <option value="2" name="s45">English</option>
                                        <option value="3" name="s45">Math</option>
                                        <option value="4" name="s45">Social Science</option>
                                        <option value="5" name="s45">Science</option>
                                        <option value="6" name="s45">Commerce</option>
                                        <option value="7" name="s45">Arts</option>
                                        <option value="8" name="s45">Physical Education</option>
                                        <option value="9" name="s45">ICT</option>
                                        <option value="10" name="s45">Religion</option>
                                        <option value="11" name="s45">Agriculture</option>
                                        <option value="12" name="s45">Extra</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="s46">
                                        <option value="1" name="s46">Bangla</option>
                                        <option value="2" name="s46">English</option>
                                        <option value="3" name="s46">Math</option>
                                        <option value="4" name="s46">Social Science</option>
                                        <option value="5" name="s46">Science</option>
                                        <option value="6" name="s46">Commerce</option>
                                        <option value="7" name="s46">Arts</option>
                                        <option value="8" name="s46">Physical Education</option>
                                        <option value="9" name="s46">ICT</option>
                                        <option value="10" name="s46">Religion</option>
                                        <option value="11" name="s46">Agriculture</option>
                                        <option value="12" name="s46">Extra</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="text" class="form-control" required placeholder="t id.." name="t41"></td>
                                <td><input type="text" class="form-control" required placeholder="t id.." name="t42"></td>
                                <td><input type="text" class="form-control" required placeholder="t id.." name="t43"></td>
                                <td><input type="text" class="form-control" required placeholder="t id.." name="t44"></td>
                                <td><input type="text" class="form-control" required placeholder="t id.." name="t45"></td>
                                <td><input type="text" class="form-control" required placeholder="t id.." name="t46"></td>
                            </tr>
                            <tr>
                                <th rowspan="2">Wed</th>
                                <td>
                                    <select class="form-select" name="s51">
                                        <option value="1" name="s51">Bangla</option>
                                        <option value="2" name="s51">English</option>
                                        <option value="3" name="s51">Math</option>
                                        <option value="4" name="s51">Social Science</option>
                                        <option value="5" name="s51">Science</option>
                                        <option value="6" name="s51">Commerce</option>
                                        <option value="7" name="s51">Arts</option>
                                        <option value="8" name="s51">Physical Education</option>
                                        <option value="9" name="s51">ICT</option>
                                        <option value="10" name="s51">Religion</option>
                                        <option value="11" name="s51">Agriculture</option>
                                        <option value="12" name="s51">Extra</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="s52">
                                        <option value="1" name="s52">Bangla</option>
                                        <option value="2" name="s52">English</option>
                                        <option value="3" name="s52">Math</option>
                                        <option value="4" name="s52">Social Science</option>
                                        <option value="5" name="s52">Science</option>
                                        <option value="6" name="s52">Commerce</option>
                                        <option value="7" name="s52">Arts</option>
                                        <option value="8" name="s52">Physical Education</option>
                                        <option value="9" name="s52">ICT</option>
                                        <option value="10" name="s52">Religion</option>
                                        <option value="11" name="s52">Agriculture</option>
                                        <option value="12" name="s52">Extra</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="s53">
                                        <option value="1" name="s53">Bangla</option>
                                        <option value="2" name="s53">English</option>
                                        <option value="3" name="s53">Math</option>
                                        <option value="4" name="s53">Social Science</option>
                                        <option value="5" name="s53">Science</option>
                                        <option value="6" name="s53">Commerce</option>
                                        <option value="7" name="s53">Arts</option>
                                        <option value="8" name="s53">Physical Education</option>
                                        <option value="9" name="s53">ICT</option>
                                        <option value="10" name="s53">Religion</option>
                                        <option value="11" name="s53">Agriculture</option>
                                        <option value="12" name="s53">Extra</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="s54">
                                        <option value="1" name="s54">Bangla</option>
                                        <option value="2" name="s54">English</option>
                                        <option value="3" name="s54">Math</option>
                                        <option value="4" name="s54">Social Science</option>
                                        <option value="5" name="s54">Science</option>
                                        <option value="6" name="s54">Commerce</option>
                                        <option value="7" name="s54">Arts</option>
                                        <option value="8" name="s54">Physical Education</option>
                                        <option value="9" name="s54">ICT</option>
                                        <option value="10" name="s54">Religion</option>
                                        <option value="11" name="s54">Agriculture</option>
                                        <option value="12" name="s54">Extra</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="s55">
                                        <option value="1" name="s55">Bangla</option>
                                        <option value="2" name="s55">English</option>
                                        <option value="3" name="s55">Math</option>
                                        <option value="4" name="s55">Social Science</option>
                                        <option value="5" name="s55">Science</option>
                                        <option value="6" name="s55">Commerce</option>
                                        <option value="7" name="s55">Arts</option>
                                        <option value="8" name="s55">Physical Education</option>
                                        <option value="9" name="s55">ICT</option>
                                        <option value="10" name="s55">Religion</option>
                                        <option value="11" name="s55">Agriculture</option>
                                        <option value="12" name="s55">Extra</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="s56">
                                        <option value="1" name="s56">Bangla</option>
                                        <option value="2" name="s56">English</option>
                                        <option value="3" name="s56">Math</option>
                                        <option value="4" name="s56">Social Science</option>
                                        <option value="5" name="s56">Science</option>
                                        <option value="6" name="s56">Commerce</option>
                                        <option value="7" name="s56">Arts</option>
                                        <option value="8" name="s56">Physical Education</option>
                                        <option value="9" name="s56">ICT</option>
                                        <option value="10" name="s56">Religion</option>
                                        <option value="11" name="s56">Agriculture</option>
                                        <option value="12" name="s56">Extra</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="text" class="form-control" required placeholder="t id.." name="t51"></td>
                                <td><input type="text" class="form-control" required placeholder="t id.." name="t52"></td>
                                <td><input type="text" class="form-control" required placeholder="t id.." name="t53"></td>
                                <td><input type="text" class="form-control" required placeholder="t id.." name="t54"></td>
                                <td><input type="text" class="form-control" required placeholder="t id.." name="t55"></td>
                                <td><input type="text" class="form-control" required placeholder="t id.." name="t56"></td>
                            </tr>
                            <tr>
                                <th rowspan="2">Thu</th>
                                <td>
                                    <select class="form-select" name="s61">
                                        <option value="1" name="s61">Bangla</option>
                                        <option value="2" name="s61">English</option>
                                        <option value="3" name="s61">Math</option>
                                        <option value="4" name="s61">Social Science</option>
                                        <option value="5" name="s61">Science</option>
                                        <option value="6" name="s61">Commerce</option>
                                        <option value="7" name="s61">Arts</option>
                                        <option value="8" name="s61">Physical Education</option>
                                        <option value="9" name="s61">ICT</option>
                                        <option value="10" name="s61">Religion</option>
                                        <option value="11" name="s61">Agriculture</option>
                                        <option value="12" name="s61">Extra</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="s62">
                                        <option value="1" name="s62">Bangla</option>
                                        <option value="2" name="s62">English</option>
                                        <option value="3" name="s62">Math</option>
                                        <option value="4" name="s62">Social Science</option>
                                        <option value="5" name="s62">Science</option>
                                        <option value="6" name="s62">Commerce</option>
                                        <option value="7" name="s62">Arts</option>
                                        <option value="8" name="s62">Physical Education</option>
                                        <option value="9" name="s62">ICT</option>
                                        <option value="10" name="s62">Religion</option>
                                        <option value="11" name="s62">Agriculture</option>
                                        <option value="12" name="s62">Extra</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="s63">
                                        <option value="1" name="s63">Bangla</option>
                                        <option value="2" name="s63">English</option>
                                        <option value="3" name="s63">Math</option>
                                        <option value="4" name="s63">Social Science</option>
                                        <option value="5" name="s63">Science</option>
                                        <option value="6" name="s63">Commerce</option>
                                        <option value="7" name="s63">Arts</option>
                                        <option value="8" name="s63">Physical Education</option>
                                        <option value="9" name="s63">ICT</option>
                                        <option value="10" name="s63">Religion</option>
                                        <option value="11" name="s63">Agriculture</option>
                                        <option value="12" name="s63">Extra</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="s64">
                                        <option value="1" name="s64">Bangla</option>
                                        <option value="2" name="s64">English</option>
                                        <option value="3" name="s64">Math</option>
                                        <option value="4" name="s64">Social Science</option>
                                        <option value="5" name="s64">Science</option>
                                        <option value="6" name="s64">Commerce</option>
                                        <option value="7" name="s64">Arts</option>
                                        <option value="8" name="s64">Physical Education</option>
                                        <option value="9" name="s64">ICT</option>
                                        <option value="10" name="s64">Religion</option>
                                        <option value="11" name="s64">Agriculture</option>
                                        <option value="12" name="s64">Extra</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="s65">
                                        <option value="1" name="s65">Bangla</option>
                                        <option value="2" name="s65">English</option>
                                        <option value="3" name="s65">Math</option>
                                        <option value="4" name="s65">Social Science</option>
                                        <option value="5" name="s65">Science</option>
                                        <option value="6" name="s65">Commerce</option>
                                        <option value="7" name="s65">Arts</option>
                                        <option value="8" name="s65">Physical Education</option>
                                        <option value="9" name="s65">ICT</option>
                                        <option value="10" name="s65">Religion</option>
                                        <option value="11" name="s65">Agriculture</option>
                                        <option value="12" name="s65">Extra</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="s66">
                                        <option value="1" name="s66">Bangla</option>
                                        <option value="2" name="s66">English</option>
                                        <option value="3" name="s66">Math</option>
                                        <option value="4" name="s66">Social Science</option>
                                        <option value="5" name="s66">Science</option>
                                        <option value="6" name="s66">Commerce</option>
                                        <option value="7" name="s66">Arts</option>
                                        <option value="8" name="s66">Physical Education</option>
                                        <option value="9" name="s66">ICT</option>
                                        <option value="10" name="s66">Religion</option>
                                        <option value="11" name="s66">Agriculture</option>
                                        <option value="12" name="s66">Extra</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="text" class="form-control" required placeholder="t id.." name="t61"></td>
                                <td><input type="text" class="form-control" required placeholder="t id.." name="t62"></td>
                                <td><input type="text" class="form-control" required placeholder="t id.." name="t63"></td>
                                <td><input type="text" class="form-control" required placeholder="t id.." name="t64"></td>
                                <td><input type="text" class="form-control" required placeholder="t id.." name="t65"></td>
                                <td><input type="text" class="form-control" required placeholder="t id.." name="t66"></td>
                            </tr>
                            <tr>
                                <td colspan="5"></td>
                                <td colspan="2"><button type="submit" class="btn btn-success form-control" name="update">Save Modified Schedule</button></td>
                            </tr>
                        </form>
                        ';
        }
        ?>
        </tbody>
        </table>
    </div>



</body>

</html>

<?php
include '../template/admin_footer.html';
?>