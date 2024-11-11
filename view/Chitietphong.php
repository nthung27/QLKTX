<title>Danh sách hồ sơ hợp đồng</title>
<link rel="stylesheet" href="../css/home.css">
<link rel="icon" type="icon" href="../icon/logo.png">
<?php
    include "sliderbar.php";
    include_once "../config/db.php";
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
    if ($searchTerm) {
        $sql = "SELECT * FROM hopdong WHERE Hoten LIKE '%$searchTerm%' OR Masinhvien LIKE '%$searchTerm%'";
    } else {
        $sql = "SELECT * FROM hopdong";
    }
?>
<body>
    <div class="sinhvien">
        <h1>Danh sách sinh viên thuê phòng</h1>
        <form method="GET" action="">
            <input class="tk" type="submit" value="Tìm kiếm">
            <input class="Timkiem" type="text" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>" placeholder="Nhập tên hoặc mã sinh viên">
        </form>
        <a href="Hopdong.php">Hợp đồng</a>
        <table border="1">
            <tr>
                <th>Mã hợp đồng</th>
                <th>Mã sinh viên</th>
                <th>Họ tên</th>
                <th>Lớp</th>
                <th>Phòng</th>
                <th>Ngày tạo</th>
            </tr>
            <?php
            $result = mysqli_query($conn, $sql);

            // Hiển thị dữ liệu trong bảng
            if (mysqli_num_rows($result) > 0) {
                while ($student = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $student['Mahopdong']; ?></td>
                        <td><?php echo $student['Masinhvien']; ?></td>
                        <td><?php echo $student['Hoten']; ?></td>
                        <td><?php echo $student['Lop']; ?></td>
                        <td><?php echo $student['Maphong']; ?></td>
                        <td><?php echo $student['Ngaytao']; ?></td>
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