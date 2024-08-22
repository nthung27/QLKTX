<title>Sửa hồ sơ kết thúc</title>
<link rel="stylesheet" href="../css/themhopdong.css">
<link rel="icon" type="icon" href="../icon/logo.png">
<?php
    include "sliderbar.php";
    include_once "../config/db.php";

    // Kiểm tra xem có tham số ID được truyền vào không
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        // Truy vấn thông tin kết thúc dựa trên ID
        $sql = "SELECT * FROM ketthuc WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 1) {
            $student = mysqli_fetch_assoc($result);
        } else {
            echo "<script>alert('Không tìm thấy thông tin hợp đồng');</script>";
            exit;
        }
    } else {
        echo "<script>alert('ID Dữ liệu không được cung cấp');</script>";
        exit;
    }

    // Kiểm tra xem form đã được gửi đi chưa
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy dữ liệu từ form
        $masinhvien = $_POST['Masinhvien'];
        $hoten = $_POST['Hoten'];
        $lop = $_POST['Lop'];
        $phong = $_POST['Phong'];

        // Kiểm tra không để trống
        if(empty($masinhvien) || empty($hoten) || empty($lop) || empty($phong)) {
            echo "<script>alert('Vui lòng điền đầy đủ thông tin.');</script>";
        } else {
            // Cập nhật thông tin Kết thúc vào cơ sở dữ liệu
            $sql_update = "UPDATE ketthuc SET Masinhvien='$masinhvien', Hoten='$hoten', Lop='$lop', Phong='$phong' WHERE id=$id";
            if(mysqli_query($conn, $sql_update)) {
                echo "<script>alert('Sửa dữ liệu thành công'); window.location.href='Ketthuc.php';</script>";
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
                <label for="Masinhvien">Mã sinh viên</label>
                <input type="text" name="Masinhvien" id="masinhvien" value="<?php echo $student['Masinhvien']; ?>" readonly>

                <label for="Hoten">Họ tên</label>
                <input type="text" name="Hoten" id="hoten" value="<?php echo $student['Hoten']; ?>" readonly>

                <label for="Lop">Lớp</label>
                <input type="text" name="Lop" id="lop" value="<?php echo $student['Lop']; ?>" readonly>

                <label for="Phong">Phòng</label>
                <input type="text" name="Phong" id="phong" value="<?php echo $student['Phong']; ?>" readonly> 

                <input type="submit" value="Sửa dữ liệu">
            </form>

        </div>
    </div>
</body>
