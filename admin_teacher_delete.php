<?php
include 'database.php';
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
    // echo "{$uid} <br> {$tid}"

    if ($tid) {
        $del = "DELETE FROM teachers
        WHERE teacher_id= $tid;";
    } else {
        $del = "DELETE FROM users
        WHERE id= $uid;";
    }

    if (mysqli_multi_query($conn, $del)) {
        do {
            // Keep fetching results until there are no more
        } while (mysqli_next_result($conn));
        header('Location: admin_teacher.php');
    } else {
        die(mysqli_error($conn));
    }
}
