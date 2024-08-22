<title>Danh sách thanh toán</title>
<link rel="stylesheet" href="../css/timkiem.css">
<link rel="icon" type="icon" href="../icon/logo.png">
<?php
    include "sliderbar.php";
    include_once "../config/db.php";
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
    if ($searchTerm) {
        $sql = "SELECT * FROM thanhtoan WHERE Phong LIKE '%$searchTerm%' OR Masinhvien LIKE '%$searchTerm%'";
    } else {
        $sql = "SELECT * FROM thanhtoan";
    }
?>
<body>
    <div class="sinhvien">
        <h1>Quản Lý Thanh Toán</h1>
        <form method="GET" action="">
            <input class="tk" type="submit" value="Tìm kiếm">
            <input class="Timkiem" type="text" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>" placeholder="Nhập tên phòng hoặc mã sinh viên">
        </form>
        <a href="Themthanhtoan.php">Thêm dữ liệu</a>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Mã sinh viên</th>
                <th>Phòng</th>
                <th>Tổng tiền</th>
                <th>Thanh toán</th>
                <th>Ngày tạo</th>
                <th>Thao tác</th>
            </tr>
            <?php
            $result = mysqli_query($conn, $sql);

            // Hiển thị dữ liệu trong bảng
            if (mysqli_num_rows($result) > 0) {
                while ($student = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $student['id']; ?></td>
                        <td><?php echo $student['Masinhvien']; ?></td>
                        <td><?php echo $student['Phong']; ?></td>
                        <td><?php echo $student['Tongtien']; ?></td>
                        <td><?php echo $student['Thanhtoan']; ?></td>
                        <td><?php echo $student['Ngaytao']; ?></td>
                        <td>
                            <a href="Suathanhtoan.php?id=<?php echo $student['id']; ?>">Sửa</a>
                            <a href="Xoathanhtoan.php?id=<?php echo $student['id']; ?>">Xóa</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='10'>Không có dữ liệu</td></tr>";
            }

            // Đóng kết nối
            mysqli_close($conn);
        ?>
        </table>
    </div>
</body>