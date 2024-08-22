<title>Xóa sinh viên</title>
<link rel="stylesheet" href="../css/xoasinhvien.css">
<link rel="icon" type="icon" href="../icon/logo.png">
<?php
    include_once "../config/db.php";

    // Kiểm tra xem có tham số ID được truyền vào không
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        // Truy vấn thông tin sinh viên dựa trên ID
        $sql = "SELECT * FROM sinhvien WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 1) {
            $student = mysqli_fetch_assoc($result);
        } else {
            echo "<script>alert('Không tìm thấy sinh viên');</script>";
            exit;
        }
    } else {
        echo "<script>alert('ID Sinh viên không được cung cấp');</script>";
        exit;
    }

    // Xử lý việc xóa sinh viên nếu người dùng xác nhận
    if(isset($_POST['delete'])) {
        $sql_delete = "DELETE FROM sinhvien WHERE id = $id";
        if(mysqli_query($conn, $sql_delete)) {
            echo "<script>alert('Xóa sinh viên thành công'); window.location.href='Sinhvien.php';</script>";
            exit;
        } else {
            echo "<script>alert('Lỗi: " . mysqli_error($conn) . "');</script>";
        }
        exit;
    }
?>
<body>
    <h2>Xác nhận xóa sinh viên</h2>
    <p>Bạn có chắc chắn muốn xóa sinh viên <?php echo $student['Hoten']; ?> không?</p>
    <form method="post">
        <input type="submit" name="delete" value="Xác nhận xóa">
        <a href="javascript:history.go(-1)">Quay lại</a>
    </form>
</body>