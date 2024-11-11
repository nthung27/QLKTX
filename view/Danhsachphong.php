<title>Danh sách phòng sinh viên ở</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="../css/styles.css">
<link rel="icon" type="icon" href="../icon/logo.png">
<?php
    include "sliderbar.php";
    include_once "../config/db.php";

    // Tạo truy vấn để lấy Maphong và tổng số sinh viên theo Maphong từ bảng hopdong
    $query = "SELECT Maphong, COUNT(Masinhvien) AS TongSinhVien
              FROM hopdong
              GROUP BY Maphong"; // Nhóm theo Maphong

    $result = $conn->query($query);

    // Kiểm tra và hiển thị các phòng từ kết quả truy vấn
    if ($result) { // Kiểm tra xem truy vấn có thành công không
        if ($result->num_rows > 0) {
            echo '<div class="main">'; // Bắt đầu div main
            while ($row = $result->fetch_assoc()) {
                echo '<div class="room">'; // Thêm lớp cho mỗi phòng
                echo '<i class="fa-solid fa-hotel"></i>';
                echo '<h5>Phòng: ' . htmlspecialchars($row['Maphong']) . '</h5>'; // In Maphong ra
                echo '<h4>Tổng số sinh viên: ' . htmlspecialchars($row['TongSinhVien']) . '</h4>'; // In tổng số sinh viên ra

                // Thêm thẻ <a> để chuyển hướng
                echo '<a href="Chitietphong.php?maphong=' . htmlspecialchars($row['Maphong']) . '" class="btn">Xem chi tiết</a>'; // Liên kết đến trang chi tiết phòng
                echo '</div>';
            }
            echo '</div>'; // Kết thúc div main
        } else {
            echo '<p>Không có phòng nào.</p>';
        }
    } else {
        echo 'Lỗi truy vấn: ' . $conn->error; // In ra lỗi nếu có
    }
?>





