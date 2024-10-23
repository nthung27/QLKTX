<?php
include_once "../config/db.php";

if (isset($_POST['mathanhtoan'])) {
    $mathanhtoan = $_POST['mathanhtoan'];

    $sql = "SELECT Mahopdong, Hoten, Thanhtoan, Maphong FROM thanhtoan WHERE Mathanhtoan = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $mathanhtoan);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(['Mahopdong' => '', 'Hoten' => '', 'Thanhtoan' => '', 'Maphong' => '']);
    }

    $stmt->close();
    $conn->close();
}
?>
