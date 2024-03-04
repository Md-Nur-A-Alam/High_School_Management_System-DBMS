<?php
session_start();
$s_id = $_SESSION['stu_id'];
@include '../template/database.php';

if (isset($_GET['BID'])) {
    $bid = $_GET['BID'];
    $update = "UPDATE take_books SET return_req = 1 WHERE book_id = $bid AND s_id = $s_id;";
    $result = mysqli_query($conn, $update);
    
    header('location: student_library.php');
}
?>