<title>Thêm hồ sơ thanh toán</title>
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
                </div>
                <div class="form-group">
                    <label for="Mahopdong">Mã hợp đồng</label>
                    <input type="text" name="Mahopdong" id="mahopdong" placeholder="VD: HD1">
                    <button type="button" id="searchButton">Tìm kiếm</button>
                </div>
                <div class="form-group">
                    <label for="Hoten">Họ tên</label>
                    <input type="text" name="Hoten" id="hoten" readonly>
                </div>
                <div class="form-group">
                    <label for="Phong"> Mã phòng</label>
                    <input type="text" name="Phong" id="phong" readonly>
                </div>
                <div class="form-group">
                    <label for="Tiendien">Tiền điện</label>
                    <input type="text" name="Tiendien" id="tiendien">
                </div>
                <div class="form-group">
                    <label for="Tienvesinh">Tiền vệ sinh</label>
                    <input type="text" value="100000" name="Tienvesinh" id="tienvesinh" readonly>
                </div>
                <div class="form-group">
                    <label for="Tiennuoc">Tiền nước</label>
                    <input type="text" name="Tiennuoc" id="tiennuoc">
                </div>
                <div class="form-group">
                    <label for="Tiennha">Tiền nhà</label>
                    <input type="text" value="700000" name="Tiennha" id="tiennha" readonly>
                </div>
                <div class="form-group">
                    <label for="Tongtien">Tổng tiền</label>
                    <input type="text" name="Tongtien" id="tongtien" readonly>
                    <button type="button" id="Sumtongtien">Tổng tiền</button>
                </div>
                <div class="form-group">
                    <label for="Thanhtoan">Thanh toán</label>
                    <select name="Thanhtoan" id="thanhtoan">
                        <option>Đã thanh toán</option>
                        <option>Chưa thanh toán</option>
                    </select><br>
                </div>
                <div class="form-group" style="display: none;">
                    <label for="Ngaykyhopdong">Ngày ký hợp đồng</label>
                    <input type="text" name="Ngaykyhopdong" id="ngaykyhopdong" readonly>
                </div>
                <input type="submit" name="tdl" value="Thêm dữ liệu">
            </form>
        </div>
    </div>

    <!--xử lý nút tìm kiếm-->
    <script>
        document.getElementById('searchButton').addEventListener('click', function() {
            var mahopdong = document.getElementById('mahopdong').value;
            if (mahopdong) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'TimkiemMasinhvien.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var response = JSON.parse(xhr.responseText);
                        document.getElementById('hoten').value = response.Hoten;
                        document.getElementById('phong').value = response.Maphong;
                        document.getElementById('ngaykyhopdong').value = response.Ngaykyhopdong;
                    }
                };
                xhr.send('mahopdong=' + mahopdong);
            }
        });
    </script>

    <!--xử lý nút tính tiền-->
    <script>
    document.getElementById('Sumtongtien').addEventListener('click', function() {
        // Lấy giá trị từ các trường nhập liệu
        var tiendien = parseFloat(document.getElementById('tiendien').value) || 0;
        var tienvesinh = parseFloat(document.getElementById('tienvesinh').value) || 0;
        var tiennuoc = parseFloat(document.getElementById('tiennuoc').value) || 0;
        var tiennha = parseFloat(document.getElementById('tiennha').value) || 0;

        // Tính tổng tiền
        var tongtien = tiendien + tienvesinh + tiennuoc + tiennha;

        // Hiển thị tổng tiền
        document.getElementById('tongtien').value = tongtien;
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
        $Phong = $_POST['Phong'];
        $Tongtien = $_POST['Tongtien'];
        $Thanhtoan = $_POST['Thanhtoan'];
        $Ngaykyhopdong = $_POST['Ngaykyhopdong'];

        // Kiểm tra các trường không để trống
        if (empty($Mathanhtoan) || empty($Mahopdong) || empty($Hoten) || empty($Phong) || empty($Tongtien) || empty($Thanhtoan) || empty($Ngaykyhopdong)) {
            echo "<script>alert('Vui lòng điền đầy đủ thông tin.');</script>";
        } else {
            // Kiểm tra trùng mã sinh viên
            $check_sql = "SELECT * FROM thanhtoan WHERE Mathanhtoan = '$Mathanhtoan' OR Mahopdong = '$Mahopdong'";
            $result = mysqli_query($conn, $check_sql);

            if (mysqli_num_rows($result) > 0) {
                echo "<script>alert('Mã thanh toán hoặc mã hợp đồng đã tồn tại!');</script>";
            } else {
                // Tạo truy vấn SQL để chèn dữ liệu vào bảng thanhtoan
                $sql = "INSERT INTO thanhtoan (Mathanhtoan, Mahopdong, Hoten, Maphong, Tongtien, Thanhtoan, Ngaykyhopdong) 
                        VALUES ('$Mathanhtoan', '$Mahopdong', '$Hoten', '$Phong', '$Tongtien', '$Thanhtoan', '$Ngaykyhopdong')";

                // Thực thi truy vấn và kiểm tra kết quả
                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Thêm dữ liệu thành công'); window.location.href='Thanhtoan.php';</script>";
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


