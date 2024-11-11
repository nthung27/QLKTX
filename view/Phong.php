<title>Danh sách phòng ở</title>
<link rel="stylesheet" href="../css/home.css">
<link rel="icon" type="icon" href="../icon/logo.png">
<?php
    include "sliderbar.php";
    include_once "../config/db.php";

    $itemsPerPage = 5; // Số lượng bản ghi trên mỗi trang
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($currentPage - 1) * $itemsPerPage;

    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
    if ($searchTerm) {
        $sql = "SELECT * FROM phong WHERE Tenphong LIKE '%$searchTerm%' OR Maphong LIKE '%$searchTerm%' LIMIT $itemsPerPage OFFSET $offset";
        $countSql = "SELECT COUNT(*) AS total FROM phong WHERE Tenphong LIKE '%$searchTerm%' OR Maphong LIKE '%$searchTerm%'";
    } else {
        $sql = "SELECT * FROM phong LIMIT $itemsPerPage OFFSET $offset";
        $countSql = "SELECT COUNT(*) AS total FROM phong";
    }

    $result = mysqli_query($conn, $sql);
    $countResult = mysqli_query($conn, $countSql);
    $totalItems = mysqli_fetch_assoc($countResult)['total'];
    $totalPages = ceil($totalItems / $itemsPerPage);
?>
<body>
    <div class="sinhvien">
        <h1>Quản Lý Phòng</h1>
        <form method="GET" action="">
            <input class="tk" type="submit" value="Tìm kiếm">
            <input class="Timkiem" type="text" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>" placeholder="Nhập tên phòng hoặc mã phòng">
        </form>
        <a href="Themphong.php">Thêm phòng</a>
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Mã phòng</th>
                <th>Tên phòng</th>
                <th>Dãy nhà</th>
                <th>Tình trạng</th>
                <th>Thao tác</th>
            </tr>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($room = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $room['id']; ?></td>
                        <td><?php echo $room['Maphong']; ?></td>
                        <td><?php echo $room['Tenphong']; ?></td>
                        <td><?php echo $room['Daynha']; ?></td>
                        <td><?php echo $room['Tinhtrang']; ?></td>
                        <td>
                            <a href="Suaphong.php?id=<?php echo $room['id']; ?>">Sửa</a>
                            <a href="Xoaphong.php?id=<?php echo $room['id']; ?>">Xóa</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='6'>Không có dữ liệu</td></tr>";
            }

            // Đóng kết nối
            mysqli_close($conn);
            ?>
        </table>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php if ($currentPage > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>&search=<?php echo $searchTerm; ?>">Trước</a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php echo ($i == $currentPage) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo $searchTerm; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($currentPage < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>&search=<?php echo $searchTerm; ?>">Sau</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</body>
