<title>Thêm danh sách phòng ở</title>
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
                <label for="Maphong">Mã phòng</label>
                <input type="text" name="Maphong" id="maphong" placeholder="VD: MP1">

                <label for="tenphong">Tên phòng</label>
                <input type="text" name="Tenphong" id="tenphong" placeholder="VD: PA01">

                <label for="daynha">Dãy nhà</label>
                <select name="Daynha" id="daynha">
                    <option value="">Chọn dãy nhà</option>
                    <option value="A01">A01</option>
                    <option value="A02">A02</option>
                    <option value="B01">B01</option>
                    <option value="B02">B02</option>
                </select>

                <label for="tinhtrang">Tình trạng</label>
                <input type="text" name="Tinhtrang" id="tinhtrang" placeholder="VD: Sạch sẽ">

                <input type="submit" value="Thêm phòng">
            </form>
        </div>
    </div>
</body>


<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy dữ liệu từ form
        $Maphong = $_POST['Maphong'];
        $Tenphong = $_POST['Tenphong'];
        $Daynha = $_POST['Daynha'];
        $Tinhtrang = $_POST['Tinhtrang'];

        // Kiểm tra các trường không để trống
        if (empty($Maphong) || empty($Tenphong) || empty($Daynha) || empty($Tinhtrang)) {
            echo "<script>alert('Vui lòng điền đầy đủ thông tin.');</script>";
        } else {
            // Kiểm tra trùng mã phòng
            $check_sql = "SELECT * FROM phong WHERE Maphong = '$Maphong'";
            $result = mysqli_query($conn, $check_sql);

            if (mysqli_num_rows($result) > 0) {
                echo "<script>alert('Mã phòng đã tồn tại');</script>";
            } else {
                // Tạo truy vấn SQL để chèn dữ liệu vào bảng phong
                $sql = "INSERT INTO phong (Maphong, Tenphong, Daynha, Tinhtrang) 
                        VALUES ('$Maphong', '$Tenphong', '$Daynha', '$Tinhtrang')";

                // Thực thi truy vấn và kiểm tra kết quả
                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Thêm phòng thành công'); window.location.href='Phong.php';</script>";
                    exit;
                } else {
                    echo "<script>alert('Lỗi: " . mysqli_error($conn) . "');</script>";
                }
            }

            // Đóng kết nối đến cơ sở dữ liệu
            mysqli_close($conn);
        }
    }
?>