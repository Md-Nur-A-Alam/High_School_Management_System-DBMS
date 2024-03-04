<?php
session_start();
@include '../template/database.php';

if (isset($_GET['BID']) && isset($_GET['SID'])) {
    $bid = $_GET['BID'];
    $sid = $_GET['SID'];

    // Sanitize the input
    $bid = mysqli_real_escape_string($conn, $bid);
    $sid = mysqli_real_escape_string($conn, $sid);

    $delete = "DELETE FROM take_books WHERE book_id = $bid AND s_id = $sid;";
    $result = mysqli_query($conn, $delete);

    if ($result) {
        header('location: admin_library.php');
    } else {
        echo "Error deleting the record: " . mysqli_error($conn);
    }
} else {
    // Handle the case when BID or SID is not set in the URL
    echo "BID or SID not provided in the URL.";
}
?>
