<title>Sửa danh sách sinh viên</title>
<link rel="stylesheet" href="../css/themsinhvien.css">
<link rel="icon" type="icon" href="../icon/logo.png">
<?php
    include "sliderbar.php";
    include_once "../config/db.php";

    // Kiểm tra xem có tham số ID được truyền vào không
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        // Truy vấn thông tin sinh viên dựa trên ID
        $sql = "SELECT * FROM sinhvien WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 1) {
            $student = mysqli_fetch_assoc($result);
        } else {
            echo "<script>alert('Không tìm thấy thông tin sinh viên');</script>";
            exit;
        }
    } else {
        echo "<script>alert('ID Sinh viên không được cung cấp');</script>";
        exit;
    }

    // Kiểm tra xem form đã được gửi đi chưa
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy dữ liệu từ form
        $masinhvien = $_POST['Masinhvien'];
        $hoten = $_POST['Hoten'];
        $khoa = $_POST['Khoa'];
        $lop = $_POST['Lop'];
        $gioitinh = $_POST['Gioitinh'];
        $cccd = $_POST['CCCD'];
        $sdt = $_POST['Sodienthoai'];
        $diachi = $_POST['Diachi'];

        // Kiểm tra không để trống
        if(empty($masinhvien) || empty($hoten) || empty($khoa) || empty($lop) || empty($gioitinh) || empty($cccd) || empty($sdt) || empty($diachi)) {
            echo "<script>alert('Vui lòng điền đầy đủ thông tin.');</script>";
        } else {
            // Kiểm tra số điện thoại và CCCD phải là số
            if(!is_numeric($cccd) || !is_numeric($sdt)) {
                echo "<script>alert('CCCD và Số điện thoại phải là số.');</script>";
            } else {
                // Cập nhật thông tin sinh viên vào cơ sở dữ liệu
                $sql_update = "UPDATE sinhvien SET Masinhvien='$masinhvien', Hoten='$hoten', Khoa='$khoa', Lop='$lop', Gioitinh='$gioitinh', CCCD='$cccd', Sodienthoai='$sdt', Diachi='$diachi' WHERE id=$id";
                if(mysqli_query($conn, $sql_update)) {
                    echo "<script>alert('Sửa sinh viên thành công'); window.location.href='Sinhvien.php';</script>";
                } else {
                    echo "<script>alert('Lỗi: " . mysqli_error($conn) . "');</script>";
                }
            }
        }
    }
?>
<body>
    <div class="themsinhvien">
        <div>
            <form action="" method="POST">
                <label for="msv">Mã sinh viên</label>
                <input type="text" name="Masinhvien" id="msv" value="<?php echo $student['Masinhvien']; ?>">

                <label for="hoten">Họ tên</label>
                <input type="text" name="Hoten" id="hoten" value="<?php echo $student['Hoten']; ?>">

                <label for="khoa">Khoa</label>
                <input type="text" name="Khoa" id="khoa" value="<?php echo $student['Khoa']; ?>">

                <label for="lop">Lớp</label>
                <input type="text" name="Lop" id="lop" value="<?php echo $student['Lop']; ?>">

                <label for="gioitinh">Giới tính</label>
                <select name="Gioitinh" id="gioitinh">
                    <option value="Nam" <?php if($student['Gioitinh'] == 'Nam') echo 'selected'; ?>>Nam</option>
                    <option value="Nữ" <?php if($student['Gioitinh'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
                    <option value="Khác" <?php if($student['Gioitinh'] == 'Khác') echo 'selected'; ?>>Khác</option>
                </select><br>

                <label for="cccd">CCCD</label>
                <input type="text" name="CCCD" id="cccd" value="<?php echo $student['CCCD']; ?>">

                <label for="sdt">Số điện thoại</label>
                <input type="text" name="Sodienthoai" id="sdt" value="<?php echo $student['Sodienthoai']; ?>">

                <label for="diachi">Địa chỉ</label>
                <input type="text" name="Diachi" id="diachi" value="<?php echo $student['Diachi']; ?>">

                <input type="submit" value="Sửa sinh viên">
            </form>
        </div>
    </div>

    <!--Check số điện thoại và CCCD-->
    <script>
        function validateForm() {
            let cccd = document.getElementById("cccd").value;
            let sdt = document.getElementById("sdt").value;
            let numberPattern = /^[0-9]+$/;

            if (!numberPattern.test(cccd)) {
                alert("CCCD phải chứa số.");
                return false;
            }

            if (!numberPattern.test(sdt)) {
                alert("Số điện thoại phải chứa số.");
                return false;
            }

            return true;
        }
    </script>
</body>
