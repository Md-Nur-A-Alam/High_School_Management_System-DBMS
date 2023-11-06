<?php
@include 'database.php';

if (isset($_GET['deleteNID'])) {
    $id = $_GET['deleteNID'];
    
    $del = "DELETE FROM notices WHERE noticeID = $id;";
    

    if (mysqli_multi_query($conn, $del)) {
        header('Location: student_view_notice.php');
    } else {
        die(mysqli_error($conn));
    }
}
