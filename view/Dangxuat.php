<?php
// Bắt đầu hoặc sử dụng lại phiên làm việc đã tồn tại
session_start();

// Hủy phiên đăng nhập bằng cách xóa tất cả các biến phiên
session_unset();

// Hủy phiên làm việc
session_destroy();

// Sử dụng JavaScript để hiển thị thông báo và chuyển hướng
echo "<script>alert('Bạn đã đăng xuất khỏi hệ thống!');window.location.href = 'Dangnhap.php';</script>";
exit;
?>
