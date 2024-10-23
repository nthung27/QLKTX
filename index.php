<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: view/Dangnhap.php');
        exit;
    }
?>
