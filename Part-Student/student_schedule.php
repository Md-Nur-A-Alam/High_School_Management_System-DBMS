<?php
include 'database.php';
include 'header.html';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Style/adminHeaderFooter.css">
    <title>Student schedule</title>
    <style>
        body{
            /* background-color: antiquewhite; */
        }
    </style>
</head>
<body>
<div class="container my-5">
        <form method="post">
            <h2>My Schedule:</h2>
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

        <table class="table table-bordered table-success" >
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
                        WHERE cr.class_id = $class AND cr.section_id = $section";

                    $result = mysqli_query($conn, $select);
                    if ($result) {
                        $group = null;
                        if ($section == '1') {
                            $group = 'A';
                        } elseif ($section == '2') {
                            $group = 'B';
                        } else {
                            $group = 'C';
                        }
                        echo
                        '
                        <h3 class = "text-success">Routine for class <b class="text-primary">'.$class.'</b> section <b class="text-primary">'.$group.'</b> :</h3><hr>
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
                        ';
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
</body>
</html>

<?php
include 'footer.html';
?>