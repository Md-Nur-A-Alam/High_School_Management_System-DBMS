<?php
include 'database.php';

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
        $del = "DELETE FROM students WHERE student_id = $sid;";
    } else {
        $del = "DELETE FROM users WHERE id = $uid;";
    }

    // Perform the deletion
    if (mysqli_multi_query($conn, $del)) {
        do {
            // Keep fetching results until there are no more
        } while (mysqli_next_result($conn));
        header('Location: admin_student.php');
    } else {
        die(mysqli_error($conn));
    }
}
?>
