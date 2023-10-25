<?php
include ('../template/database.php');
include ('../template/teacher_header.html');
session_start();
$uid = $_SESSION['teacher_id'];
$name = $_SESSION['teacher_name'];
$sub = $_SESSION['subject'];
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
        <h3>Hello <span class="text-success fw-bold"><?php echo $name ?></span> sir, your students Assignment on <span  class="text-danger fw-bold"><?php echo $sub ?></span> subject's list is in here...</h3><hr>
        <form class="form" method="post">
            <div class="row">
                <div class="col">
                    <label>class: </label>
                    <select name="class">
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
                        <option value="1" name="section">Sec A</option>
                        <option value="2" name="section">Sec B</option>
                        <option value="3" name="section">Sec c</option>
                    </select>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-success" name="find">Find Assignments</button>
                </div>
            </div>
        </form>
        <?php if (isset($_POST['find'])) { $class = $_POST['class']; $section = $_POST['section'];?>
            <table class="table my-3">
                <thead class="table-dark">
                    <td>Sl</td>
                    <td>S_ID</td>
                    <td>Name</td>
                    <td>Assignment</td>
                    <td>Operation</td>
                </thead>
            </table>
            <tr>
                <?php
                    $select = "SELECT ROW_NUMBER() OVER (ORDER BY s.student_id) AS sl,
                                '$sub',
                                s.student_id,
                                u.name
                                FROM students s
                                INNER JOIN users u ON s.user_id = u.id
                                INNER JOIN assignment a ON s.student_id = a.stu_id";
                    $result = mysqli_query($conn, $select);

                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $row = mysqli_fetch_assoc($result);
                            $sl = $row['sl'];
                            $stu_id = $row['student_id'];
                            $stu_name = $row['name'];
                            $assignment = $row[$sub];
                ?>
                <td><?php echo $sl ?></td>
                <td><?php echo $stu_id ?></td>
                <td><?php echo $stu_name ?></td>
                <td><?php echo $assignment ?></td>
            </tr>
            
        <?php }}} ?>
    </div>
</body>
</html>
<?php
include ('../template/teacher_footer.html')
?>