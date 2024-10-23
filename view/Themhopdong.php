<title>Thêm hợp đồng</title>
<link rel="stylesheet" href="../css/themhopdong.css">
<link rel="icon" type="icon" href="../icon/logo.png">
<?php
    include "sliderbar.php";
    include_once "../config/db.php";

    $phong_sql = "SELECT Maphong FROM phong";
    $phong_result = $conn->query($phong_sql);

    if (!$phong_result) {
        die("Lỗi truy vấn: " . $conn->error);
    }
?>
<body>
    <div class="themsinhvien">
        <h2 style="font-style: italic;">(Lưu ý: Mỗi phòng chỉ được đăng ký tối đa 10 sinh viên)</h2>
        <div>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="Mahopdong">Mã hợp đồng</label>
                    <input type="text" name="Mahopdong" id="mahopdong" placeholder="VD: HD1">
                </div>
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
                    <label for="Phong">Mã phòng</label>
                    <select name="Phong" id="phong">
                        <?php
                            if ($phong_result->num_rows > 0) {
                                while($row = $phong_result->fetch_assoc()) {
                                    echo "<option value='" . $row['Maphong'] . "'>" . $row['Maphong'] . "</option>";
                                }
                            } else {
                                echo "<option value=''>Không có phòng</option>";
                            }
                        ?>
                    </select>
                </div>
                <input type="submit" name="thd" value="Thêm hợp đồng">
            </form>
        </div>
    </div>

    <!--Tìm kiếm mã sinh viên-->
    <script>
        document.getElementById('searchButton').addEventListener('click', function() {
            var masinhvien = document.getElementById('masinhvien').value;
            if (masinhvien) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'Timkiemsinhvien.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var response = JSON.parse(xhr.responseText);
                        document.getElementById('hoten').value = response.hoten;
                        document.getElementById('lop').value = response.lop;
                    }
                };
                xhr.send('masinhvien=' + masinhvien);
            }
        });
    </script>
</body>

<?php
    if (isset($_POST['thd'])) {
        // Lấy dữ liệu từ form
        $Mahopdong = $_POST['Mahopdong'];
        $Masinhvien = $_POST['Masinhvien'];
        $Hoten = $_POST['Hoten'];
        $Lop = $_POST['Lop'];
        $Phong = $_POST['Phong'];

        // Kiểm tra các trường không để trống
        if (empty($Masinhvien) || empty($Hoten) || empty($Lop) || empty($Phong)) {
            echo "<script>alert('Vui lòng điền đầy đủ thông tin.');</script>";
        } else {
            // Kiểm tra số lượng sinh viên trong phòng
            $count_sql = "SELECT COUNT(*) AS total FROM hopdong WHERE Maphong = '$Phong'";
            $count_result = mysqli_query($conn, $count_sql);
            $row = mysqli_fetch_assoc($count_result);

            if ($row['total'] >= 2) {
                echo "<script>alert('Phòng này đã đủ 10 sinh viên. Vui lòng chọn phòng khác.');</script>";
            } else {
                // Kiểm tra trùng mã sinh viên hoặc mã hợp đồng
                $check_sql = "SELECT * FROM hopdong WHERE Masinhvien = '$Masinhvien' OR Mahopdong = '$Mahopdong'";
                $result = mysqli_query($conn, $check_sql);

                if (mysqli_num_rows($result) > 0) {
                    echo "<script>alert('Mã sinh viên hoặc mã hợp đồng đã tồn tại!');</script>";
                } else {
                    // Tạo truy vấn SQL để chèn dữ liệu vào bảng hopdong
                    $sql = "INSERT INTO hopdong (Mahopdong, Masinhvien, Hoten, Lop, Maphong) 
                            VALUES ('$Mahopdong', '$Masinhvien', '$Hoten', '$Lop', '$Phong')";

                    // Thực thi truy vấn và kiểm tra kết quả
                    if (mysqli_query($conn, $sql)) {
                        echo "<script>alert('Thêm hợp đồng thành công'); window.location.href='Hopdong.php';</script>";
                        exit;
                    } else {
                        echo "<script>alert('Lỗi: " . mysqli_error($conn) . "');</script>";
                    }
                }
            }

            // Đóng kết nối đến cơ sở dữ liệu
            mysqli_close($conn);
        }
    }
?>



