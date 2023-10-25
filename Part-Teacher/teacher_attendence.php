<?php
session_start();
include '../template/teacher_header.html';
include '../template/database.php';
$uid = $_SESSION['teacher_id'];
$error = null;
$table_name = "student_attendance";


// Function to create or update attendance for a given student on a specific date
function markAttendance($conn, $student_id, $date)
{
    // Check if the column for the date exists; if not, create it with a default value of '0'
    $createColumnQuery = "ALTER TABLE student_attendance ADD COLUMN IF NOT EXISTS `$date` INT DEFAULT 0";
    mysqli_query($conn, $createColumnQuery);

    // Update the attendance for the student (set to '1') on the specified date
    $updateQuery = "UPDATE student_attendance SET `$date` = 1 WHERE stu_id = $student_id";
    mysqli_query($conn, $updateQuery);
}

// Handle the form submission
if (isset($_POST['submit'])) {
    if (!empty($_POST['date'])) {
        $selectedDate = $_POST['date'];
        $attendanceData = $_POST['attendance'];

        foreach ($attendanceData as $student_id => $attendance) {
            markAttendance($conn, $student_id, $selectedDate);
        }
    } else {
        $error = "Error: Please select the date first...";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/adminHeaderFooter.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <title>HSMS - Teacher</title>
</head>

<body>
    <!-- ============ insert attendance ============= -->
    <div class="container my-5">
        <h2>Take Attendance</h2>
        <h5 class="text-danger"><?php echo $error ?></h5>
        <hr>
        <form class="form" method="post">
            <div class="row">
                <div class="col">
                    <label>Date: </label>
                    <input type="date" name="date" id="date" required>
                </div>
                <div class="col">
                    <label>class: </label>
                    <select name="class">
                        <option value="0" name="class">Select Class</option>
                        <option value="6" name="class">class 6</option>
                        <option value="7" name="class">class 7</option>
                        <option value="8" name="class">class 8</option>
                        <option value="9" name="class">class 9</option>
                        <option value="10" name="class">class 10</option>
                    </select>
                </div>
                <div class="col">
                    <label>Section: </label>
                    <select name="section">
                        <option value="0" name="section">Select Section</option>
                        <option value="1" name="section">Sec A</option>
                        <option value="2" name="section">Sec B</option>
                        <option value="3" name="section">Sec c</option>
                    </select>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-success" name="find">Find Students</button>
                </div>
            </div>
        </form>
        <table class="table">
            <form method="post">
                <?php
                if (isset($_POST['find'])) {
                    $class = $_POST['class'];
                    $section = $_POST['section'];
                    $selectedDate = $_POST['date'];
                    if ($class == 0 || $section == 0) {
                        echo '<h3>Select both class and section first</h3>';
                    } else {
                        echo '<hr>
                            <div class="mb-3">
                                <label>Date: </label>
                                <input type="date" name="date" value="' . $selectedDate . '">
                            </div>
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" class="fw-normal">Sl.</th>
                                    <th scope="col" class="fw-normal">Student ID</th>
                                    <th scope="col" class="fw-normal">Name</th>
                                    <th scope="col" class="fw-normal">Class</th>
                                    <th scope="col" class="fw-normal">Section</th>
                                    <th scope="col" class="fw-normal">Attendance</th>
                                </tr>
                            </thead>';
                        $select = "SELECT ROW_NUMBER() OVER (ORDER BY u.id) AS sl, student_id, name, class_name, section_name
                                        FROM users as u
                                        INNER JOIN students as s ON s.user_id = u.id
                                        LEFT JOIN classes as c ON c.class_id = s.class_id
                                        LEFT JOIN sections as sec ON sec.section_id = s.section_id
                                        WHERE s.class_id = $class and s.section_id = $section";

                        $result = mysqli_query($conn, $select);

                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $sl = $row['sl'];
                                $stu_id = $row['student_id'];
                                $name = $row['name'];
                                $class = $row['class_name'];
                                $section = $row['section_name'];

                                echo '<tr>
                                        <td class="fw-light">' . $sl . '</th>
                                        <td class="fw-light">' . $stu_id . '</th>
                                        <td class="fw-light">' . $name . '</th>
                                        <td class="fw-light">' . $class . '</th>
                                        <td class="fw-light">' . $section . '</th>
                                        <td>
                                        <input class="form-check-input" type="checkbox" name="attendance[' . $stu_id . ']" value="1">
                                        </td>
                                    </tr>';
                            }
                            echo '
                                <tr>
                                    <td colspan=5>
                                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                    </td>
                                </tr>
                                ';
                        }
                    }
                }
                ?>

            </form>
        </table>

    </div>
    <hr>

    <!-- ============ check attendance ============= -->
    <div class="container">
        <h2>Check Attendance</h2>
        <hr>
        <form class="form" method="post">
            <div class="row">
                <div class="col">
                    <label class="text-primary fw-bold">From: </label>
                    <input type="date" name="start_date" id="s_date" required>
                </div>
                <div class="col">
                    <label class="text-primary fw-bold">To: </label>
                    <input type="date" name="end_date" id="e_date" required>
                </div>
                <div class="col">
                    <label class="text-primary fw-bold">Class: </label>
                    <select name="class">
                        <option value="6" name="class">class 6</option>
                        <option value="7" name="class">class 7</option>
                        <option value="8" name="class">class 8</option>
                        <option value="9" name="class">class 9</option>
                        <option value="10" name="class">class 10</option>
                    </select>
                </div>
                <div class="col">
                    <label class="text-primary fw-bold">Section: </label>
                    <select name="section">
                        <option value="1" name="section">Sec A</option>
                        <option value="2" name="section">Sec B</option>
                        <option value="3" name="section">Sec c</option>
                    </select>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-success" name="seeAttendance">Check Attendance</button>
                </div>
            </div>
        </form>

        <?php
        if (isset($_POST['seeAttendance'])) {

            $class = $_POST['class'];
            $section = $_POST['section'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $totalDate = null;



            // Construct a list of dates within the date range
            $dates = array();
            $current_date = new DateTime($start_date);
            $end_date = new DateTime($end_date);
            while ($current_date <= $end_date) {
                $dates[] = $current_date->format('Y-m-d');
                $current_date->modify('+1 day');
            }

            // Generate a dynamic SQL query to select the attendance for the specified date range
            $columns = array();

            foreach ($dates as $date) {
                $column_exists_query = "SHOW COLUMNS FROM $table_name LIKE '$date'";
                $column_exists_result = $conn->query($column_exists_query);

                if ($column_exists_result->num_rows > 0) {
                    // The column exists in the table
                    $columns[] = "`$date`";
                    $totalDate++;
                }
            }

            if (count($columns) > 0) {
                $column_list = implode(", ", $columns);

                $sql = "SELECT ROW_NUMBER() OVER (ORDER BY stu_id) AS sl, stu_id, name, class_name, section_name, $column_list
                                            FROM $table_name as sa
                                            INNER JOIN students as s on sa.stu_id = s.student_id
                                            INNER JOIN users as u ON s.user_id = u.id
                                            LEFT JOIN classes as c ON c.class_id = s.class_id
                                            LEFT JOIN sections as sec ON sec.section_id = s.section_id
                                            WHERE s.class_id = $class and s.section_id = $section";
                // $sql = "SELECT stu_id, $column_list FROM $table_name";

                $result = $conn->query($sql);

                if ($result) {
                    // Display the attendance data
                    echo "<table class='table my-1'>";
                    echo "<tr class='table-dark'>";
                    echo "<th>Sl</th>";
                    echo "<th>S_ID</th>";
                    echo "<th>Name</th>";
                    echo "<th>Class</th>";
                    echo "<th>Section</th>";
                    foreach ($dates as $date) {
                        if (in_array("`$date`", $columns)) {
                            $dt = date('j,M', strtotime($date));
                            echo "<th>$dt</th>";
                        }
                    }
                    echo "<th>Total</th>";
                    echo "<th>Present</th>";
                    echo "</tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['sl'] . "</td>";
                        echo "<td>" . $row['stu_id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['class_name'] . "</td>";
                        echo "<td>" . $row['section_name'] . "</td>";
                        $p = 0;
                        foreach ($dates as $date) {
                            if (in_array("`$date`", $columns)) {
                                $d = $row[$date];
                                echo "<td>" . $d . "</td>";
                                $p += $d;
                            }
                        }
                        echo "<th class='text-primary'>" . $totalDate . "</th>";
                        echo "<th class='text-danger'>" . $p . "</th>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "Error: " . $conn->error;
                }
            } else {
                echo "No matching columns found in the table for the specified date range.";
            }
        }
        ?>
    </div>
    <script>
        // Get the current date in 'YYYY-MM-DD' format
        const today = new Date().toISOString().split('T')[0];

        // Set the input element's value to the current date
        document.getElementById("date").value = today;
        document.getElementById("s_date").value = today;
        document.getElementById("e_date").value = today;
    </script>

</body>

</html>

<?php
include('../template/teacher_footer.html');
?>