<title>Danh sách sinh viên</title>
<link rel="stylesheet" href="../css/timkiem.css">
<link rel="icon" type="icon" href="../icon/logo.png">
<?php
    include "sliderbar.php";
    include_once "../config/db.php";
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
    if ($searchTerm) {
        $sql = "SELECT * FROM sinhvien WHERE Hoten LIKE '%$searchTerm%' OR Masinhvien LIKE '%$searchTerm%'";
    } else {
        $sql = "SELECT * FROM sinhvien";
    }
?>
<body>
    <div class="sinhvien">
        <h1>Quản Lý Sinh Viên</h1>
        <form method="GET" action="">
            <input class="tk" type="submit" value="Tìm kiếm">
            <input class="Timkiem" type="text" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>" placeholder="Nhập tên hoặc mã sinh viên">
        </form>
        <a href="Themsinhvien.php">Thêm sinh viên</a>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Mã sinh viên</th>
                <th>Họ tên</th>
                <th>Khoa</th>
                <th>Lớp</th>
                <th>Giới tính</th>
                <th>CCCD</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
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
                        <td><?php echo $student['Hoten']; ?></td>
                        <td><?php echo $student['Khoa']; ?></td>
                        <td><?php echo $student['Lop']; ?></td>
                        <td><?php echo $student['Gioitinh']; ?></td>
                        <td><?php echo $student['CCCD']; ?></td>
                        <td><?php echo $student['Sodienthoai']; ?></td>
                        <td><?php echo $student['Diachi']; ?></td>
                        <td>
                            <a href="Suasinhvien.php?id=<?php echo $student['id']; ?>">Sửa</a>
                            <a href="Xoasinhvien.php?id=<?php echo $student['id']; ?>">Xóa</a>
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