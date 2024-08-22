<title>Đăng nhập vào hệ thống</title>
<link rel="stylesheet" href="../css/dangnhap.css">
<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/a81368914c.js"></script>
<link rel="icon" type="icon" href="icon/logo.png">
<body>
    <div class="container">
        <div class="login-box">
            <h2>ĐĂNG NHẬP</h2>
            <form action method="POST">
                <div class="input-box">
                    <input type="text" class="input" name="taikhoan">
                    <label>Tài khoản</label>
                </div>
                <div class="input-box">
                    <input type="password" class="input" name="matkhau">
                    <label>Mật khẩu</label>
                </div>
                <div class="forgot-pass">
                    <a href="#">Bạn quên mật khẩu?</a>
                </div>
                <button type="submit" class="btn">Đăng nhập</button>
            </form>
        </div>

        <span style="--i:0;"></span>
        <span style="--i:1;"></span>
        <span style="--i:2;"></span>
        <span style="--i:3;"></span>
        <span style="--i:4;"></span>
        <span style="--i:5;"></span>
        <span style="--i:6;"></span>
        <span style="--i:7;"></span>
        <span style="--i:8;"></span>
        <span style="--i:9;"></span>
        <span style="--i:10;"></span>
        <span style="--i:11;"></span>
        <span style="--i:12;"></span>
        <span style="--i:13;"></span>
        <span style="--i:14;"></span>
        <span style="--i:15;"></span>
        <span style="--i:16;"></span>
        <span style="--i:17;"></span>
        <span style="--i:18;"></span>
        <span style="--i:19;"></span>
        <span style="--i:20;"></span>
        <span style="--i:21;"></span>
        <span style="--i:22;"></span>
        <span style="--i:23;"></span>
        <span style="--i:24;"></span>
        <span style="--i:25;"></span>
        <span style="--i:26;"></span>
        <span style="--i:27;"></span>
        <span style="--i:28;"></span>
        <span style="--i:29;"></span>
        <span style="--i:30;"></span>
        <span style="--i:31;"></span>
        <span style="--i:32;"></span>
        <span style="--i:33;"></span>
        <span style="--i:34;"></span>
        <span style="--i:35;"></span>
        <span style="--i:36;"></span>
        <span style="--i:37;"></span>
        <span style="--i:38;"></span>
        <span style="--i:39;"></span>
        <span style="--i:40;"></span>
        <span style="--i:41;"></span>
        <span style="--i:42;"></span>
        <span style="--i:43;"></span>
        <span style="--i:44;"></span>
        <span style="--i:45;"></span>
        <span style="--i:46;"></span>
        <span style="--i:47;"></span>
        <span style="--i:48;"></span>
        <span style="--i:49;"></span>
    </div>

</body>

<?php
require_once '../config/db.php';

// Lấy dữ liệu từ form đăng nhập
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $taikhoan = $_POST['taikhoan'];
    $matkhau = $_POST['matkhau'];

    // Kiểm tra thông tin đăng nhập trong cơ sở dữ liệu
    $sql = "SELECT * FROM dangnhap WHERE taikhoan = '$taikhoan' AND matkhau = '$matkhau'";
    $result = mysqli_query($conn, $sql);

    // Đếm số hàng kết quả trả về
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        echo "<script>alert('Đăng nhập thành công'); window.location.href='dashboard.php';</script>";
        exit;
    } else {
        echo "<script>alert('Bạn đã nhập sai tài khoản hoặc mật khẩu!'); window.location.href='Dangnhap.php';</script>";
        exit;
    }
}
?>
