<title>Sửa danh sách tài khoản</title>
<link rel="stylesheet" href="../css/themsinhvien.css">
<link rel="icon" type="icon" href="../icon/logo.png">
<?php
    include "sliderbar.php";
    include_once "../config/db.php";

    // Kiểm tra xem có tham số ID được truyền vào không
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        // Truy vấn thông tin phòng dựa trên ID
        $sql = "SELECT * FROM dangnhap WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 1) {
            $student = mysqli_fetch_assoc($result);
        } else {
            echo "<script>alert('Không tìm thấy thông tin tài khoản');</script>";
            exit;
        }
    } else {
        echo "<script>alert('ID Tài khoản không được cung cấp');</script>";
        exit;
    }

    // Kiểm tra xem form đã được gửi đi chưa
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy dữ liệu từ form
        $hoten = $_POST['Hoten'];
        $taikhoan = $_POST['Taikhoan'];
        $matkhau = $_POST['Matkhau'];
        $email = $_POST['Email'];

        // Kiểm tra không để trống
        if(empty($hoten) || empty($taikhoan) || empty($matkhau) || empty($email)) {
            echo "<script>alert('Vui lòng điền đầy đủ thông tin.');</script>";
        } else {
            // Cập nhật thông tin Tài khoản vào cơ sở dữ liệu
            $sql_update = "UPDATE dangnhap SET Hoten='$hoten', Taikhoan='$taikhoan', Matkhau='$matkhau', Email='$email' WHERE id=$id";
            if(mysqli_query($conn, $sql_update)) {
                echo "<script>alert('Sửa tài khoản thành công'); window.location.href='Taikhoan.php';</script>";
            } else {
                echo "<script>alert('Lỗi: " . mysqli_error($conn) . "');</script>";
            }
        }
    }
?>
<body>
    <div class="themsinhvien">
        <div>
            <form action="" method="POST">
                <label for="Hoten">Họ tên</label>
                <input type="text" name="Hoten" id="hoten" value="<?php echo $student['hoten']; ?>">

                <label for="Taikhoan">Tên tài khoản</label>
                <input type="text" name="Taikhoan" id="taikhoan" value="<?php echo $student['taikhoan']; ?>">

                <label for="Matkhau">Mật khẩu</label>
                <input type="text" name="Matkhau" id="matkhau" value="<?php echo $student['matkhau']; ?>">

                <label for="Email">Email</label>
                <input type="text" name="Email" id="email" value="<?php echo $student['email']; ?>">

                <input type="submit" value="Sửa phòng">
            </form>
        </div>
    </div>
</body>
