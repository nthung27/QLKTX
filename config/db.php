<?php
$server = "localhost";
$user = "root";
$password = "";
$db = "baitaplon";

$conn = mysqli_connect($server,$user,$password,$db);

if(!$conn) {
    die("Lỗi kết nối:".mysqli_connect_error());
}

?>