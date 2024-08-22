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
                    <label for="Masinhvien">Mã sinh viên</label>
                    <input type="text" name="Masinhvien" id="masinhvien" placeholder="VD: 72DCHT20024">
                    <button type="button" id="searchButton">Tìm kiếm</button>
                </div>
                <div class="form-group">
                    <label for="Phong">Phòng</label>
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
                xhr.open('POST', 'TimkiemMasinhvien.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var response = JSON.parse(xhr.responseText);
                        document.getElementById('phong').value = response.phong;
                    }
                };
                xhr.send('masinhvien=' + masinhvien);
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

<!--php xử lý nút tính tiền-->
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $tiendien = isset($_POST['Tiendien']) ? floatval($_POST['Tiendien']) : 0;
        $tienvesinh = isset($_POST['Tienvesinh']) ? floatval($_POST['Tienvesinh']) : 100000;
        $tiennuoc = isset($_POST['Tiennuoc']) ? floatval($_POST['Tiennuoc']) : 0;
        $tiennha = isset($_POST['Tiennha']) ? floatval($_POST['Tiennha']) : 700000;
    
        // Tính tổng tiền
        $tongtien = $tiendien + $tienvesinh + $tiennuoc + $tiennha;
    
        // Thực hiện các thao tác với tổng tiền (ví dụ: lưu vào cơ sở dữ liệu)
        // ...
    
        echo "Tổng tiền: " . $tongtien;
    }
?>


<!--php xử lý nút thêm-->
<?php
    if (isset($_POST['tdl'])) {
        // Lấy dữ liệu từ form
        $Masinhvien = $_POST['Masinhvien'];
        $Phong = $_POST['Phong'];
        $Tongtien = $_POST['Tongtien'];
        $Thanhtoan = $_POST['Thanhtoan'];

        // Kiểm tra các trường không để trống
        if (empty($Masinhvien) || empty($Phong) || empty($Tongtien) || empty($Thanhtoan)) {
            echo "<script>alert('Vui lòng điền đầy đủ thông tin.');</script>";
        } else {
            // Kiểm tra trùng mã sinh viên
            $check_sql = "SELECT * FROM sinhvien WHERE Masinhvien = '$Masinhvien'";
            $result = mysqli_query($conn, $check_sql);

            if (mysqli_num_rows($result) > 0) {
                echo "<script>alert('Mã sinh viên đã tồn tại');</script>";
            } else {
                // Tạo truy vấn SQL để chèn dữ liệu vào bảng thanhtoan
                $sql = "INSERT INTO thanhtoan (Masinhvien, Phong, Tongtien, Thanhtoan) 
                        VALUES ('$Masinhvien', '$Phong', '$Tongtien', '$Thanhtoan')";

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


