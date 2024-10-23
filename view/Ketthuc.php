<title>Danh sách hồ sơ kết thúc</title>
<link rel="stylesheet" href="../css/timkiem.css">
<link rel="icon" type="icon" href="../icon/logo.png">
<?php
    include "sliderbar.php";
    include_once "../config/db.php";
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
    if ($searchTerm) {
        $sql = "SELECT * FROM ketthuc WHERE Hoten LIKE '%$searchTerm%' OR Mahopdong LIKE '%$searchTerm%'";
    } else {
        $sql = "SELECT * FROM ketthuc";
    }
?>
<body>
    <div class="sinhvien">
        <h1>Quản Lý Kết Thúc Hợp Đồng</h1>
        <form method="GET" action="">
            <input class="tk" type="submit" value="Tìm kiếm">
            <input class="Timkiem" type="text" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>" placeholder="Nhập họ tên hoặc mã hợp đồng">
        </form>
        <a href="Themketthuc.php">Thêm dữ liệu</a>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Mã hợp đồng</th>
                <th>Họ tên</th>
                <th>Mã phòng</th>
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
                        <td><?php echo $student['Mahopdong']; ?></td>
                        <td><?php echo $student['Hoten']; ?></td>
                        <td><?php echo $student['Maphong']; ?></td>
                        <td><?php echo $student['Thanhtoan']; ?></td>
                        <td><?php echo $student['Ngaytao']; ?></td>
                        <td>
                            <a href="Suaketthuc.php?id=<?php echo $student['id']; ?>">Sửa</a>
                            <a href="Xoaketthuc.php?id=<?php echo $student['id']; ?>">Xóa</a>
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