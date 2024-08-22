<title>Thêm tài khoản</title>
<link rel="stylesheet" href="../css/themsinhvien.css">
<link rel="icon" type="icon" href="../icon/logo.png">
<?php
    include "sliderbar.php";
    include_once "../config/db.php";
?>
<body>
    <div class="themsinhvien">
        <div>
            <form action="" method="POST">
                <label for="Hoten">Họ tên</label>
                <input type="text" name="Hoten" id="hoten" placeholder="VD: Nguyễn Thành Hưng">

                <label for="Taikhoan">Tên tài khoản</label>
                <input type="text" name="Taikhoan" id="taikhoan" placeholder="VD: admin">

                <label for="Matkhau">Mật khẩu</label>
                <input type="text" name="Matkhau" id="matkhau" placeholder="VD: 123456">

                <label for="Email">Email</label>
                <input type="text" name="Email" id="email" placeholder="VD: hung@gmail.com">

                <input type="submit" value="Thêm tài khoản">
            </form>
        </div>
    </div>
</body>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy dữ liệu từ form
        $Hoten = $_POST['Hoten'];
        $Taikhoan = $_POST['Taikhoan'];
        $Matkhau = $_POST['Matkhau'];
        $Email = $_POST['Email'];

        // Kiểm tra các trường không để trống
        if (empty($Hoten) || empty($Taikhoan) || empty($Matkhau) || empty($Email)) {
            echo "<script>alert('Vui lòng điền đầy đủ thông tin.');</script>";
        } else {
            // Kiểm tra định dạng email
            if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                echo "<script>alert('Email không đúng định dạng.');</script>";
            } else {
                // Kiểm tra trùng email
                $check_email_sql = "SELECT * FROM dangnhap WHERE email = '$Email'";
                $result = mysqli_query($conn, $check_email_sql);

                if (mysqli_num_rows($result) > 0) {
                    echo "<script>alert('Email đã tồn tại');</script>";
                } else {
                    // Tạo truy vấn SQL để chèn dữ liệu vào bảng dangnhap
                    $sql = "INSERT INTO dangnhap (hoten, taikhoan, matkhau, email) 
                            VALUES ('$Hoten', '$Taikhoan', '$Matkhau', '$Email')";

                    // Thực thi truy vấn và kiểm tra kết quả
                    if (mysqli_query($conn, $sql)) {
                        echo "<script>alert('Thêm tài khoản thành công'); window.location.href='Taikhoan.php';</script>";
                        exit;
                    } else {
                        echo "<script>alert('Lỗi: " . mysqli_error($conn) . "');</script>";
                    }
                }

                // Đóng kết nối đến cơ sở dữ liệu
                mysqli_close($conn);
            }
        }
    }
?>
