<title>Xóa hồ sơ thanh toán</title>
<link rel="stylesheet" href="../css/xoasinhvien.css">
<link rel="icon" type="icon" href="../icon/logo.png">
<?php
    include_once "../config/db.php";

    // Kiểm tra xem có tham số ID được truyền vào không
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        // Truy vấn thông tin thanh toán dựa trên ID
        $sql = "SELECT * FROM thanhtoan WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 1) {
            $student = mysqli_fetch_assoc($result);
        } else {
            echo "<script>alert('Không tìm thấy dữ liệu');</script>";
            exit;
        }
    } else {
        echo "<script>alert('ID Dữ liệu không được cung cấp');</script>";
        exit;
    }

    // Xử lý việc xóa Thanh toán nếu người dùng xác nhận
    if(isset($_POST['delete'])) {
        $sql_delete = "DELETE FROM thanhtoan WHERE id = $id";
        if(mysqli_query($conn, $sql_delete)) {
            echo "<script>alert('Xóa dữ liệu thành công'); window.location.href='Thanhtoan.php';</script>";
            exit;
        } else {
            echo "<script>alert('Lỗi: " . mysqli_error($conn) . "');</script>";
        }
        exit;
    }
?>
<body>
    <h2>Xác nhận xóa dữ liệu</h2>
    <p>Bạn có chắc chắn muốn xóa dữ liệu <?php echo $student['Masinhvien']; ?> không?</p>
    <form method="post">
        <input type="submit" name="delete" value="Xác nhận xóa">
        <a href="javascript:history.go(-1)">Quay lại</a>
    </form>
</body>