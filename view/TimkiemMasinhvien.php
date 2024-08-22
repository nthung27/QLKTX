<?php
include_once "../config/db.php";

if (isset($_POST['masinhvien'])) {
    $masinhvien = $_POST['masinhvien'];

    $sql = "SELECT phong FROM hopdong WHERE masinhvien = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $masinhvien);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(['phong' => '']);
    }

    $stmt->close();
    $conn->close();
}
?>
