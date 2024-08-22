<title>Thêm sinh viên</title>
<link rel="stylesheet" href="../css/themsinhvien.css">
<link rel="icon" type="icon" href="../icon/logo.png">
<body>
    <?php
        include "sliderbar.php";
        include_once "../config/db.php";
    ?>

    <div class="themsinhvien">
        <div>
            <form action="" method="POST" onsubmit="return validateForm()">
                <label for="msv">Mã sinh viên</label>
                <input type="text" name="Masinhvien" id="msv" placeholder="VD: 72DCHT20024">

                <label for="hoten">Họ tên</label>
                <input type="text" name="Hoten" id="hoten" placeholder="VD: Nguyễn Thành Hưng">

                <label for="khoa">Khoa</label>
                <input type="text" name="Khoa" id="khoa" placeholder="VD: Công nghệ thông tin">

                <label for="lop">Lớp</label>
                <input type="text" name="Lop" id="lop" placeholder="VD: 72DCHT21">

                <label for="gioitinh">Giới tính</label>
                <select name="Gioitinh" id="gioitinh">
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                    <option value="Khác">Khác</option>
                </select><br>

                <label for="cccd">CCCD</label>
                <input type="text" name="CCCD" id="cccd" placeholder="VD: 098763517635">

                <label for="sdt">Số điện thoại</label>
                <input type="text" name="Sodienthoai" id="sdt" placeholder="VD: 098763517">

                <label for="diachi">Địa chỉ</label>
                <input type="text" name="Diachi" id="diachi" placeholder="VD: Hà Nội">

                <input type="submit" value="Thêm sinh viên">
            </form>
        </div>
    </div>

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

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lấy dữ liệu từ form
            $Masinhvien = $_POST['Masinhvien'];
            $Hoten = $_POST['Hoten'];
            $Khoa = $_POST['Khoa'];
            $Lop = $_POST['Lop'];
            $Gioitinh = $_POST['Gioitinh'];
            $CCCD = $_POST['CCCD'];
            $Sodienthoai = $_POST['Sodienthoai'];
            $Diachi = $_POST['Diachi'];

            // Kiểm tra các trường không để trống
            if (empty($Masinhvien) || empty($Hoten) || empty($Khoa) || empty($Lop) || empty($Gioitinh) || empty($CCCD) || empty($Sodienthoai) || empty($Diachi)) {
                echo "<script>alert('Vui lòng điền đầy đủ thông tin.');</script>";
            } else if (!ctype_digit($CCCD) || !ctype_digit($Sodienthoai)) {
                echo "<script>alert('CCCD và Số điện thoại phải là số.');</script>";
            } else {
                // Kiểm tra trùng mã sinh viên
                $check_sql = "SELECT * FROM sinhvien WHERE Masinhvien = '$Masinhvien'";
                $result = mysqli_query($conn, $check_sql);

                if (mysqli_num_rows($result) > 0) {
                    echo "<script>alert('Mã sinh viên đã tồn tại');</script>";
                } else {
                    // Tạo truy vấn SQL để chèn dữ liệu vào bảng sinhvien
                    $sql = "INSERT INTO sinhvien (Masinhvien, Hoten, Khoa, Lop, Gioitinh, CCCD, Sodienthoai, Diachi) 
                            VALUES ('$Masinhvien', '$Hoten', '$Khoa', '$Lop', '$Gioitinh', '$CCCD', '$Sodienthoai', '$Diachi')";

                    // Thực thi truy vấn và kiểm tra kết quả
                    if (mysqli_query($conn, $sql)) {
                        echo "<script>alert('Thêm sinh viên thành công'); window.location.href='Sinhvien.php';</script>";
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
</body>
