<?php
    // Kiểm tra đăng nhập
    session_start();
    if (!isset($_SESSION['username'])) {
        // Người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
        header('Location: view/Dangnhap.php');
        exit;
    }
    // Nếu đã đăng nhập, không cần thực hiện thêm gì ở đây
?>
