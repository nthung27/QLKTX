<title>Danh sách thanh toán</title>
<link rel="stylesheet" href="../css/home.css">
<link rel="icon" type="icon" href="../icon/logo.png">
<?php
    include "sliderbar.php";
    include_once "../config/db.php";

    $itemsPerPage = 10; // Số lượng bản ghi trên mỗi trang
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($currentPage - 1) * $itemsPerPage;

    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
    if ($searchTerm) {
        $sql = "SELECT * FROM thanhtoan WHERE Phong LIKE '%$searchTerm%' OR Masinhvien LIKE '%$searchTerm%' LIMIT $itemsPerPage OFFSET $offset";
        $countSql = "SELECT COUNT(*) AS total FROM thanhtoan WHERE Phong LIKE '%$searchTerm%' OR Masinhvien LIKE '%$searchTerm%'";
    } else {
        $sql = "SELECT * FROM thanhtoan LIMIT $itemsPerPage OFFSET $offset";
        $countSql = "SELECT COUNT(*) AS total FROM thanhtoan";
    }

    $result = mysqli_query($conn, $sql);
    $countResult = mysqli_query($conn, $countSql);
    $totalItems = mysqli_fetch_assoc($countResult)['total'];
    $totalPages = ceil($totalItems / $itemsPerPage);
?>
<body>
    <div class="sinhvien">
        <h1>Quản Lý Thanh Toán</h1>
        <form method="GET" action="">
            <input class="tk" type="submit" value="Tìm kiếm">
            <input class="Timkiem" type="text" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>" placeholder="Nhập tên phòng hoặc mã sinh viên">
        </form>
        <a href="Themthanhtoan.php">Thêm dữ liệu</a>
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Mã thanh toán</th>
                <th>Mã hợp đồng</th>
                <th>Họ tên</th>
                <th>Mã phòng</th>
                <th>Tổng tiền</th>
                <th>Thanh toán</th>
                <th>Ngày tạo</th>
                <th>Thao tác</th>
            </tr>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($student = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $student['id']; ?></td>
                        <td><?php echo $student['Mathanhtoan']; ?></td>
                        <td><?php echo $student['Mahopdong']; ?></td>
                        <td><?php echo $student['Hoten']; ?></td>
                        <td><?php echo $student['Maphong']; ?></td>
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
                echo "<tr><td colspan='9'>Không có dữ liệu</td></tr>";
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
