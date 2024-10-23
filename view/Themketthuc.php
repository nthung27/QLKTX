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
                    <label for="Mathanhtoan">Mã thanh toán</label>
                    <input type="text" name="Mathanhtoan" id="mathanhtoan" placeholder="VD: TT1">
                    <button type="button" id="searchButton">Tìm kiếm</button>
                </div>
                <div class="form-group">
                    <label for="Mahopdong">Mã hợp đồng</label>
                    <input type="text" name="Mahopdong" id="mahopdong" readonly>
                </div>
                <div class="form-group">
                    <label for="Hoten">Họ tên</label>
                    <input type="text" name="Hoten" id="hoten" readonly>
                </div>
                <div class="form-group">
                    <label for="Thanhtoan">Thanh toán</label>
                    <input type="text" name="Thanhtoan" id="thanhtoan" readonly>
                </div>
                <div class="form-group">
                    <label for="Phong">Mã phòng</label>
                    <input type="text" name="Phong" id="phong" readonly>
                </div>
                <input type="submit" name="tdl" value="Kết thúc hợp đồng">
            </form>
        </div>
    </div>

    <!--xử lý nút tìm kiếm-->
    <script>
        document.getElementById('searchButton').addEventListener('click', function() {
            var mathanhtoan = document.getElementById('mathanhtoan').value;
            if (mathanhtoan) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'TimkiemKetthuc.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var response = JSON.parse(xhr.responseText);
                        document.getElementById('mahopdong').value = response.Mahopdong;
                        document.getElementById('hoten').value = response.Hoten;
                        document.getElementById('thanhtoan').value = response.Thanhtoan;
                        document.getElementById('phong').value = response.Maphong;
                    }
                };
                xhr.send('mathanhtoan=' + mathanhtoan);
            }
        });
    </script>
</body>

<!--php xử lý nút thêm-->
<?php
    if (isset($_POST['tdl'])) {
        // Lấy dữ liệu từ form
        $Mathanhtoan = $_POST['Mathanhtoan'];
        $Mahopdong = $_POST['Mahopdong'];
        $Hoten = $_POST['Hoten'];
        $Thanhtoan = $_POST['Thanhtoan'];
        $Phong = $_POST['Phong'];

        // Kiểm tra các trường không để trống
        if (empty($Mathanhtoan) || empty($Mahopdong) || empty($Hoten) || empty($Thanhtoan) || empty($Phong)) {
            echo "<script>alert('Vui lòng điền đầy đủ thông tin.');</script>";
        } else {
            // Kiểm tra trùng mã kết thúc và mã thanh toán
            $check_sql = "SELECT * FROM ketthuc WHERE Mathanhtoan = '$Mathanhtoan' ";
            $result = mysqli_query($conn, $check_sql);

            if (mysqli_num_rows($result) > 0) {
                echo "<script>alert('Dữ liệu đã tồn tại!');</script>";
            } else {
                // Tạo truy vấn SQL để chèn dữ liệu vào bảng ketthuc
                $sql_insert = "INSERT INTO ketthuc (Mathanhtoan, Mahopdong, Hoten, Thanhtoan, Maphong) 
                            VALUES ('$Mathanhtoan', '$Mahopdong', '$Hoten', '$Thanhtoan', '$Phong')";

                // Thực thi truy vấn chèn và kiểm tra kết quả
                if (mysqli_query($conn, $sql_insert)) {
                    // Tạo truy vấn xóa dữ liệu bảng hopdong
                    $sql_delete = "DELETE FROM hopdong WHERE Mahopdong = '$Mahopdong'";

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


