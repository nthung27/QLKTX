<title>Danh sách tài khoản</title>
<link rel="stylesheet" href="../css/timkiem.css">
<link rel="icon" type="icon" href="../icon/logo.png">
<?php
    include "sliderbar.php";
    include_once "../config/db.php";
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
    if ($searchTerm) {
        $sql = "SELECT * FROM dangnhap WHERE hoten LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%'";
    } else {
        $sql = "SELECT * FROM dangnhap";
    }
?>
<body>
    <div class="sinhvien">
        <h1>Quản Lý Tài Khoản</h1>
        <form method="GET" action="">
            <input class="tk" type="submit" value="Tìm kiếm">
            <input class="Timkiem" type="text" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>" placeholder="Nhập họ tên hoặc email">
        </form>
        <a href="Themtaikhoan.php">Thêm tài khoản</a>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Họ tên</th>
                <th>Tài khoản</th>
                <th>Mật khẩu</th>
                <th>Email</th>
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
                        <td><?php echo $student['hoten']; ?></td>
                        <td><?php echo $student['taikhoan']; ?></td>
                        <td><?php echo $student['matkhau']; ?></td>
                        <td><?php echo $student['email']; ?></td>
                        <td>
                            <a href="Suataikhoan.php?id=<?php echo $student['id']; ?>">Sửa</a>
                            <a href="Xoataikhoan.php?id=<?php echo $student['id']; ?>">Xóa</a>
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