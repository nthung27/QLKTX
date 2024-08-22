<?php
$server = "localhost";
$user = "root";
$password = "";
$db = "btl_java";

$conn = mysqli_connect($server,$user,$password,$db);

if(!$conn) {
    die("Lỗi kết nối:".mysqli_connect_error());
}

?>