<title>Sửa danh sách phòng ở</title>
<link rel="stylesheet" href="../css/themsinhvien.css">
<link rel="icon" type="icon" href="../icon/logo.png">
<?php
    include "sliderbar.php";
    include_once "../config/db.php";

    // Kiểm tra xem có tham số ID được truyền vào không
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        // Truy vấn thông tin phòng dựa trên ID
        $sql = "SELECT * FROM phong WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 1) {
            $student = mysqli_fetch_assoc($result);
        } else {
            echo "<script>alert('Không tìm thấy thông tin phòng');</script>";
            exit;
        }
    } else {
        echo "<script>alert('ID Phòng không được cung cấp');</script>";
        exit;
    }

    // Kiểm tra xem form đã được gửi đi chưa
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy dữ liệu từ form
        $maphong = $_POST['Maphong'];
        $tenphong = $_POST['Tenphong'];
        $daynha = $_POST['Daynha'];
        $tinhtrang = $_POST['Tinhtrang'];

        // Kiểm tra không để trống
        if(empty($maphong) || empty($tenphong) || empty($daynha) || empty($tinhtrang)) {
            echo "<script>alert('Vui lòng điền đầy đủ thông tin.');</script>";
        } else {
            // Cập nhật thông tin Phòng vào cơ sở dữ liệu
            $sql_update = "UPDATE phong SET Maphong='$maphong', Tenphong='$tenphong', Daynha='$daynha', Tinhtrang='$tinhtrang' WHERE id=$id";
            if(mysqli_query($conn, $sql_update)) {
                echo "<script>alert('Sửa phòng thành công'); window.location.href='Phong.php';</script>";
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
                <label for="msv">Mã phòng</label>
                <input type="text" name="Maphong" id="maphong" value="<?php echo $student['Maphong']; ?>" readonly>

                <label for="tenphong">Tên phòng</label>
                <input type="text" name="Tenphong" id="tenphong" value="<?php echo $student['Tenphong']; ?>">

                <label for="Daynha">Dãy nhà</label>
                <select name="Daynha" id="daynha">
                    <option value="">Chọn dãy nhà</option>
                    <option value="A01" <?php if ($student['Daynha'] == 'A01') echo 'selected'; ?>>A01</option>
                    <option value="A02" <?php if ($student['Daynha'] == 'A02') echo 'selected'; ?>>A02</option>
                    <option value="B01" <?php if ($student['Daynha'] == 'B01') echo 'selected'; ?>>B01</option>
                    <option value="B02" <?php if ($student['Daynha'] == 'B02') echo 'selected'; ?>>B02</option>
                    <!-- Thêm các tùy chọn dãy nhà khác nếu cần -->
                </select>

                <label for="tinhtrang">Tình trạng</label>
                <input type="text" name="Tinhtrang" id="tinhtrang" value="<?php echo $student['Tinhtrang']; ?>">

                <input type="submit" value="Sửa phòng">
            </form>
        </div>
    </div>
</body>

