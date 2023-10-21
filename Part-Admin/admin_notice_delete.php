<?php
@include '../template/database.php';

if (isset($_GET['deleteNID'])) {
    $id = $_GET['deleteNID'];
    
    $del = "DELETE FROM notices WHERE noticeID = $id;";
    

    if (mysqli_multi_query($conn, $del)) {
        header('Location: admin_notice.php');
    } else {
        die(mysqli_error($conn));
    }
}
