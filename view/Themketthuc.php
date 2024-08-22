<title>Thêm hồ sơ kết thúc</title>
<link rel="stylesheet" href="../css/themhopdong.css">
<link rel="icon" type="icon" href="../icon/logo.png">
<?php
    include "sliderbar.php";
    include_once "../config/db.php";
?>
<body>
    <div class="themsinhvien">
        <div>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="Masinhvien">Mã sinh viên</label>
                    <input type="text" name="Masinhvien" id="masinhvien" placeholder="VD: 72DCHT20024">
                    <button type="button" id="searchButton">Tìm kiếm</button>
                </div>
                <div class="form-group">
                    <label for="Hoten">Họ tên</label>
                    <input type="text" name="Hoten" id="hoten" readonly>
                </div>
                <div class="form-group">
                    <label for="Lop">Lớp</label>
                    <input type="text" name="Lop" id="lop" readonly>
                </div>
                <div class="form-group">
                    <label for="Phong">Phòng</label>
                    <input type="text" name="Phong" id="phong" readonly>
                </div>
                <input type="submit" name="tdl" value="Thêm dữ liệu">
            </form>
        </div>
    </div>

    <!--xử lý nút tìm kiếm-->
    <script>
        document.getElementById('searchButton').addEventListener('click', function() {
            var masinhvien = document.getElementById('masinhvien').value;
            if (masinhvien) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'TimkiemKetthuc.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var response = JSON.parse(xhr.responseText);
                        document.getElementById('hoten').value = response.hoten;
                        document.getElementById('lop').value = response.lop;
                        document.getElementById('phong').value = response.phong;
                    }
                };
                xhr.send('masinhvien=' + masinhvien);
            }
        });
    </script>
</body>

<!--php xử lý nút thêm-->
<?php
    if (isset($_POST['tdl'])) {
        // Lấy dữ liệu từ form
        $Masinhvien = $_POST['Masinhvien'];
        $Hoten = $_POST['Hoten'];
        $Lop = $_POST['Lop'];
        $Phong = $_POST['Phong'];

        // Kiểm tra các trường không để trống
        if (empty($Masinhvien) || empty($Hoten) || empty($Lop) || empty($Phong)) {
            echo "<script>alert('Vui lòng điền đầy đủ thông tin.');</script>";
        } else {
            // Kiểm tra trùng mã sinh viên
            $check_sql = "SELECT * FROM ketthuc WHERE Masinhvien = '$Masinhvien'";
            $result = mysqli_query($conn, $check_sql);

            if (mysqli_num_rows($result) > 0) {
                echo "<script>alert('Mã sinh viên đã tồn tại');</script>";
            } else {
                // Tạo truy vấn SQL để chèn dữ liệu vào bảng ketthuc
                $sql_insert = "INSERT INTO ketthuc (Masinhvien, Hoten, Lop, Phong) 
                            VALUES ('$Masinhvien', '$Hoten', '$Lop', '$Phong')";

                // Thực thi truy vấn chèn và kiểm tra kết quả
                if (mysqli_query($conn, $sql_insert)) {
                    // Tạo truy vấn xóa dữ liệu bảng hopdong
                    $sql_delete = "DELETE FROM hopdong WHERE Masinhvien = '$Masinhvien'";

                    // Thực thi truy vấn xóa và kiểm tra kết quả
                    if (mysqli_query($conn, $sql_delete)) {
                        echo "<script>alert('Kết thúc hợp đồng thành công'); window.location.href='Ketthuc.php';</script>";
                    } else {
                        echo "<script>alert('Lỗi khi xóa dữ liệu: " . mysqli_error($conn) . "');</script>";
                    }
                } else {
                    echo "<script>alert('Lỗi khi thêm dữ liệu: " . mysqli_error($conn) . "');</script>";
                }
            }

            // Đóng kết nối đến cơ sở dữ liệu
            mysqli_close($conn);
        }
    }
?>


