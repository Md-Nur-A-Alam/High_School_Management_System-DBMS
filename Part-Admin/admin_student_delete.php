<?php
@include '../template/database.php';

if (isset($_GET['deleteUID'])) {
    $uid = $_GET['deleteUID'];
    $select = "SELECT u.id, s.student_id
               FROM users u
               LEFT JOIN students s ON u.id = s.user_id
               WHERE u.id = $uid AND u.`user_type`='student';";
    $result = mysqli_query($conn, $select);
    $row = mysqli_fetch_assoc($result);
    $sid = $row['student_id'];

    if ($sid) {
        $del1 = "DELETE FROM students WHERE student_id = $sid;";
        mysqli_query($conn,$del1);
    }

    $del2 = "DELETE FROM users WHERE id = $uid;";
    mysqli_query($conn,$del2);
    header('location: admin_student.php');
}
?>