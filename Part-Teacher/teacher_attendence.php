<?php
session_start();
include '../template/teacher_header.html';
include '../template/database.php';
$uid = $_SESSION['teacher_id'];
$error=null;

// Function to create or update attendance for a given student on a specific date
function markAttendance($conn, $student_id, $date) {
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
    }else {
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
    <div class="container my-5">
        <h2>Take Attendance</h2>
        <h5 class="text-danger"><?php echo $error ?></h5>
        <hr>
        <form class="form" method="post">
            <div class="row">
                <div class="col">
                    <label>Date: </label>
                    <input type="date" name="date" required>
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
</body>

</html>

<?php
include('../template/teacher_footer.html');
?>