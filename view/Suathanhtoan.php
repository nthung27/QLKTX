<title>Sửa hồ sơ thanh toán</title>
<link rel="stylesheet" href="../css/themhopdong.css">
<link rel="icon" type="icon" href="../icon/logo.png">
<?php
    include "sliderbar.php";
    include_once "../config/db.php";

    // Kiểm tra xem có tham số ID được truyền vào không
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        // Truy vấn thông tin thanh toán dựa trên ID
        $sql = "SELECT * FROM thanhtoan WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 1) {
            $student = mysqli_fetch_assoc($result);
        } else {
            echo "<script>alert('Không tìm thấy thông tin thanh toán');</script>";
            exit;
        }
    } else {
        echo "<script>alert('ID Thanh toán không được cung cấp');</script>";
        exit;
    }

    // Kiểm tra xem form đã được gửi đi chưa
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy dữ liệu từ form
        $mathanhtoan = $_POST['Mathanhtoan'];
        $mahopdong = $_POST['Mahopdong'];
        $hoten = $_POST['Hoten'];
        $phong = $_POST['Phong'];
        $tongtien = $_POST['Tongtien'];
        $thanhtoan = $_POST['Thanhtoan'];

        // Kiểm tra không để trống
        if(empty($mathanhtoan) || empty($mahopdong) || empty($hoten) || empty($phong) || empty($tongtien) || empty($thanhtoan)) {
            echo "<script>alert('Vui lòng điền đầy đủ thông tin.');</script>";
        } else {
            // Cập nhật thông tin Thanh toán vào cơ sở dữ liệu
            $sql_update = "UPDATE thanhtoan SET Mathanhtoan='$mathanhtoan', Mahopdong='$mahopdong', Hoten='$hoten', Maphong='$phong', Thanhtoan='$thanhtoan', Tongtien='$tongtien' WHERE id=$id";
            if(mysqli_query($conn, $sql_update)) {
                echo "<script>alert('Sửa dữ liệu thành công'); window.location.href='Thanhtoan.php';</script>";
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
                <label for="Mathanhtoan">Mã thanh toán</label>
                <input type="text" name="Mathanhtoan" id="mathanhtoan" value="<?php echo $student['Mathanhtoan']; ?>" readonly>

                <label for="Mahopdong">Mã hợp đồng</label>
                <input type="text" name="Mahopdong" id="mahopdong" value="<?php echo $student['Mahopdong']; ?>" readonly>

                <label for="Hoten">Họ tên</label>
                <input type="text" name="Hoten" id="hoten" value="<?php echo $student['Hoten']; ?>" readonly>

                <label for="Phong">Phòng</label>
                <input type="text" name="Phong" id="phong" value="<?php echo $student['Maphong']; ?>" readonly>

                <label for="Tongtien">Tổng tiền</label>
                <input type="text" name="Tongtien" id="tongtien" value="<?php echo $student['Tongtien']; ?>" readonly>

                <label for="Phong">Thanh toán</label>
                    <select name="Thanhtoan" id="thanhtoan">
                        <option value="Đã thanh toán" <?php echo $student['Thanhtoan'] == 'Đã thanh toán' ? 'selected' : ''; ?>>Đã thanh toán</option>
                        <option value="Chưa thanh toán" <?php echo $student['Thanhtoan'] == 'Chưa thanh toán' ? 'selected' : ''; ?>>Chưa thanh toán</option>
                    </select>
                    
                <input type="submit" value="Sửa dữ liệu">
            </form>

        </div>
    </div>
</body>
