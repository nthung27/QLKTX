<title>Danh sách phòng ở</title>
<link rel="stylesheet" href="../css/timkiem.css">
<link rel="icon" type="icon" href="../icon/logo.png">
<?php
    include "sliderbar.php";
    include_once "../config/db.php";
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
    if ($searchTerm) {
        $sql = "SELECT * FROM phong WHERE Tenphong LIKE '%$searchTerm%' OR Maphong LIKE '%$searchTerm%'";
    } else {
        $sql = "SELECT * FROM phong";
    }
?>
<body>
    <div class="sinhvien">
        <h1>Quản Lý Phòng</h1>
        <form method="GET" action="">
            <input class="tk" type="submit" value="Tìm kiếm">
            <input class="Timkiem" type="text" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>" placeholder="Nhập tên phòng hoặc mã phòng">
        </form>
        <a href="Themphong.php">Thêm phòng</a>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Mã phòng</th>
                <th>Tên phòng</th>
                <th>Dãy nhà</th>
                <th>Tình trạng</th>
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
                        <td><?php echo $student['Maphong']; ?></td>
                        <td><?php echo $student['Tenphong']; ?></td>
                        <td><?php echo $student['Daynha']; ?></td>
                        <td><?php echo $student['Tinhtrang']; ?></td>
                        <td>
                            <a href="Suaphong.php?id=<?php echo $student['id']; ?>">Sửa</a>
                            <a href="Xoaphong.php?id=<?php echo $student['id']; ?>">Xóa</a>
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