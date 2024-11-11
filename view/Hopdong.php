<title>Danh sách hồ sơ hợp đồng</title>
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
        $sql = "SELECT * FROM hopdong WHERE Hoten LIKE '%$searchTerm%' OR Masinhvien LIKE '%$searchTerm%' LIMIT $itemsPerPage OFFSET $offset";
        $countSql = "SELECT COUNT(*) AS total FROM hopdong WHERE Hoten LIKE '%$searchTerm%' OR Masinhvien LIKE '%$searchTerm%'";
    } else {
        $sql = "SELECT * FROM hopdong LIMIT $itemsPerPage OFFSET $offset";
        $countSql = "SELECT COUNT(*) AS total FROM hopdong";
    }

    $result = mysqli_query($conn, $sql);
    $countResult = mysqli_query($conn, $countSql);
    $totalItems = mysqli_fetch_assoc($countResult)['total'];
    $totalPages = ceil($totalItems / $itemsPerPage);
?>
<body>
    <div class="sinhvien">
        <h1>Quản Lý Hợp Đồng</h1>
        <h2>(Lưu ý: Mỗi phòng chỉ được đăng ký tối đa 10 sinh viên)</h2>
        <form method="GET" action="">
            <input class="tk" type="submit" value="Tìm kiếm">
            <input class="Timkiem" type="text" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>" placeholder="Nhập tên hoặc mã sinh viên">
        </form>
        <a href="Themhopdong.php">Thêm hợp đồng</a>
        <a href="Danhsachphong.php">Danh sách phòng</a>
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Mã hợp đồng</th>
                <th>Mã sinh viên</th>
                <th>Họ tên</th>
                <th>Lớp</th>
                <th>Phòng</th>
                <th>Ngày tạo</th>
                <th>Thao tác</th>
            </tr>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($contract = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $contract['id']; ?></td>
                        <td><?php echo $contract['Mahopdong']; ?></td>
                        <td><?php echo $contract['Masinhvien']; ?></td>
                        <td><?php echo $contract['Hoten']; ?></td>
                        <td><?php echo $contract['Lop']; ?></td>
                        <td><?php echo $contract['Maphong']; ?></td>
                        <td><?php echo $contract['Ngaytao']; ?></td>
                        <td>
                            <a href="Suahopdong.php?id=<?php echo $contract['id']; ?>">Sửa</a>
                            <a href="Xoahopdong.php?id=<?php echo $contract['id']; ?>">Xóa</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='8'>Không có dữ liệu</td></tr>";
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
