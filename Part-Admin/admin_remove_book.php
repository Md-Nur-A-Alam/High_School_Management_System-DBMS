<?php
session_start();
@include '../template/database.php';

if (isset($_GET['BID'])) {
    $bid = $_GET['BID'];
    $delete = "DELETE FROM take_books WHERE book_id = $bid";
    $result = mysqli_query($conn, $delete);

    $delete = "DELETE FROM books WHERE book_id = $bid";
    $result = mysqli_query($conn, $delete);
    
    header('location: admin_library.php');
}
?>