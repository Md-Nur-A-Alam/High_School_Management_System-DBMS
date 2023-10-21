<?php
$host='localhost';
$user='root';
$pass='';
$db='hsms_db';

$conn = mysqli_connect($host, $user, $pass, $db);
if($conn == false)
{
    die("connection error");
}
?>
