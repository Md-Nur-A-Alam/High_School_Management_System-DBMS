<?php
@include '../template/database.php';

if (isset($_GET['deleteUID'])) {
    $uid = $_GET['deleteUID'];
    $del2 = "DELETE FROM stu_profile_approval WHERE user_id = $uid;";
    mysqli_query($conn,$del2);
    header('location: admin_student.php');
}
?>