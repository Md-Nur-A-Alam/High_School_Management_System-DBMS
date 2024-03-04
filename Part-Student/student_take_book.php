<?php
session_start();
$s_id = $_SESSION['stu_id'];
@include '../template/database.php';

if (isset($_GET['BID'])) {
    $bid = $_GET['BID'];
    $insert = "INSERT INTO take_books(s_id, book_id) VALUES($s_id, $bid)";
    $result = mysqli_query($conn, $insert);
    
    header('location: student_library.php');
}
?>