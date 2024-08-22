<title>Sửa hợp đồng</title>
<link rel="stylesheet" href="../css/themhopdong.css">
<link rel="icon" type="icon" href="../icon/logo.png">
<?php
    include "sliderbar.php";
    include_once "../config/db.php";

    $phong_sql = "SELECT tenphong FROM phong";
    $phong_result = $conn->query($phong_sql);

    if (!$phong_result) {
        die("Lỗi truy vấn: " . $conn->error);
    }

    // Kiểm tra xem có tham số ID được truyền vào không
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        // Truy vấn thông tin hợp đồng dựa trên ID
        $sql = "SELECT * FROM hopdong WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 1) {
            $student = mysqli_fetch_assoc($result);
        } else {
            echo "<script>alert('Không tìm thấy thông tin hợp đồng');</script>";
            exit;
        }
    } else {
        echo "<script>alert('ID Hợp đồng không được cung cấp');</script>";
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
            // Cập nhật thông tin Hợp đồng vào cơ sở dữ liệu
            $sql_update = "UPDATE hopdong SET Masinhvien='$masinhvien', Hoten='$hoten', Lop='$lop', Phong='$phong'  WHERE id=$id";
            if(mysqli_query($conn, $sql_update)) {
                echo "<script>alert('Sửa hợp đồng thành công'); window.location.href='Hopdong.php';</script>";
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
                <select name="Phong" id="phong">
                    <?php
                        if ($phong_result->num_rows > 0) {
                            while($row = $phong_result->fetch_assoc()) {
                                // Kiểm tra nếu phòng này đã được chọn
                                $selected = ($row['tenphong'] == $student['Phong']) ? 'selected' : '';
                                echo "<option value='" . $row['tenphong'] . "' $selected>" . $row['tenphong'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>Không có phòng</option>";
                        }
                    ?>
                </select>

                <input type="submit" value="Sửa hợp đồng">
            </form>

        </div>
    </div>
</body>
