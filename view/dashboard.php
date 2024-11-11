<title>Dashboard</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="../css/styles.css">
<link rel="icon" type="icon" href="../icon/logo.png">
<?php
    include "sliderbar.php";
    include_once "../config/db.php";
?>
<div class="main">
    <div>
        <i class="fa fa-users  mb-2"></i>
            <h4>Tài khoản</h4>
            <h5>
            <?php
                $sql="SELECT COUNT(*) as total FROM dangnhap";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $count = $row['total'];
                } else {
                    $count = 0;
                }
                echo $count;
        ?></h5>
    </div>

    <div>
        <i class="fa-solid fa-id-card"></i>
            <h4>Hồ sơ hợp đồng</h4>
            <h5>
            <?php
                $sql="SELECT COUNT(*) as total FROM hopdong";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $count = $row['total'];
                } else {
                    $count = 0;
                }
                echo $count;
        ?></h5>
    </div>

    <div>
        <i class="fa-solid fa-file-signature"></i>
            <h4>Kết thúc hợp đồng</h4>
            <h5>
            <?php
                $sql="SELECT COUNT(*) as total FROM ketthuc";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $count = $row['total'];
                } else {
                    $count = 0;
                }
                echo $count;
        ?></h5>
    </div>

    <div>
        <i class="fa-solid fa-hotel"></i>
            <h4>Hồ sơ phòng ở</h4>
            <h5>
            <?php
                $sql="SELECT COUNT(*) as total FROM phong";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $count = $row['total'];
                } else {
                    $count = 0;
                }
                echo $count;
        ?></h5>
    </div>

    <div>
        <i class="fa-solid fa-user-pen"></i>
            <h4>Hồ sơ sinh viên</h4>
            <h5>
            <?php
                $sql="SELECT COUNT(*) as total FROM sinhvien";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $count = $row['total'];
                } else {
                    $count = 0;
                }
                echo $count;
        ?></h5>
    </div>

    <div>
        <i class="fa-regular fa-pen-to-square"></i>
            <h4>Hồ sơ thanh toán</h4>
            <h5>
            <?php
                $sql="SELECT COUNT(*) as total FROM thanhtoan";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $count = $row['total'];
                } else {
                    $count = 0;
                }
                echo $count;
        ?></h5>
    </div>
</div>