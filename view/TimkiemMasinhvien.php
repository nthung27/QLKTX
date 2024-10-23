<?php
include_once "../config/db.php";

if (isset($_POST['mahopdong'])) {
    $mahopdong = $_POST['mahopdong'];

    $sql = "SELECT Hoten, Maphong FROM hopdong WHERE Mahopdong = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $mahopdong);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(['Hoten' =>'', 'Maphong' => '']);
    }

    $stmt->close();
    $conn->close();
}
?>
