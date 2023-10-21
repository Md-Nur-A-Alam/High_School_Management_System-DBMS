<?php
include '../template/database.php';
if (isset($_GET['deleteUID'])) {
    $uid = $_GET['deleteUID'];
    $select = "SELECT u.id,
                    t.teacher_id
                FROM users u
                LEFT JOIN teachers t ON u.id = t.user_id
                WHERE u.id = $uid AND u.`user_type`='teacher';";
    $result = mysqli_query($conn, $select);
    $row = mysqli_fetch_assoc($result);
    $tid = $row['teacher_id'];

    if ($tid) {
        $update = "UPDATE class_routine
                SET
                    1st_teacher_id = CASE WHEN 1st_teacher_id = $tid THEN NULL ELSE 1st_teacher_id END,
                    2nd_teacher_id = CASE WHEN 2nd_teacher_id = $tid THEN NULL ELSE 2nd_teacher_id END,
                    3rd_teacher_id = CASE WHEN 3rd_teacher_id = $tid THEN NULL ELSE 3rd_teacher_id END,
                    4th_teacher_id = CASE WHEN 4th_teacher_id = $tid THEN NULL ELSE 4th_teacher_id END,
                    5th_teacher_id = CASE WHEN 5th_teacher_id = $tid THEN NULL ELSE 5th_teacher_id END,
                    6th_teacher_id = CASE WHEN 6th_teacher_id = $tid THEN NULL ELSE 6th_teacher_id END;
                ";
        mysqli_query($conn, $update);
        
        $del1 = "DELETE FROM teachers WHERE teacher_id= $tid;";
        mysqli_query($conn, $del1);
    }

    $del2 = "DELETE FROM users WHERE id= $uid;";
    mysqli_query($conn, $del2);
    header('Location: admin_teacher.php');
}
?>