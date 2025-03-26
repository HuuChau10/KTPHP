<?php
include_once __DIR__ . '/../controller/sinhvienController.php';

$svController = new SinhVienController();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sinhvien = $svController->getById($id);
} else {
    echo "Thiếu ID sinh viên.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Chi Tiết Sinh Viên</title></head>
<body>
    <h2>Thông Tin Sinh Viên</h2>
    <p><b>Họ Tên:</b> <?= $sinhvien['HoTen'] ?></p>
    <p><b>Giới Tính:</b> <?= $sinhvien['GioiTinh'] ?></p>
    <p><b>Ngày Sinh:</b> <?= $sinhvien['NgaySinh'] ?></p>
    <p><b>Ngành Học:</b> <?= $sinhvien['MaNganh'] ?></p>
    <p><b>Hình:</b><br> 
       <img src="../<?= $sinhvien['Hinh'] ?>" width="150">
    </p>
    <a href="index.php">Quay lại</a>
</body>
</html>
