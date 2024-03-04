<?php
include '../template/database.php';
if (isset($_GET['deleteUID'])) {
    $uid = $_GET['deleteUID'];
    $select = "SELECT u.id,
                    a.account_id
                FROM users u
                LEFT JOIN accounts a ON u.id = a.user_id
                WHERE u.id = $uid AND u.`user_type`='accounts';";
    $result = mysqli_query($conn, $select);
    $row = mysqli_fetch_assoc($result);
    $aid = $row['account_id'];

    if ($aid) {
        $del1 = "DELETE FROM accounts WHERE account_id= $aid;";
        mysqli_query($conn, $del1);
    }

    $del2 = "DELETE FROM users WHERE id= $uid;";
    mysqli_query($conn, $del2);
    header('Location: admin_account.php');
}
?>