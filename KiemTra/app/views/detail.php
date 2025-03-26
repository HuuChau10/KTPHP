<?php
include_once __DIR__ . '/../controller/sinhvienController.php';

$svController = new SinhVienController();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $sinhvien = $svController->getById($id);

    if (!$sinhvien) {
        die("<h3>Không tìm thấy sinh viên!</h3>");
    }
} else {
    die("<h3>Thiếu hoặc sai ID sinh viên.</h3>");
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sinh Viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            width: 50%;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            background: #f9f9f9;
        }
        img {
            width: 80px;
            height: auto;
            border-radius: 5px;
        }
        a {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 12px;
            background: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }
        a:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Thông Tin Sinh Viên</h2>
        <p><b>Họ Tên:</b> <?= htmlspecialchars($sinhvien['HoTen']) ?></p>
        <p><b>Giới Tính:</b> <?= htmlspecialchars($sinhvien['GioiTinh']) ?></p>
        <p><b>Ngày Sinh:</b> <?= htmlspecialchars($sinhvien['NgaySinh']) ?></p>
        <p><b>Ngành Học:</b> <?= htmlspecialchars($sinhvien['MaNganh']) ?></p>
        <p><b>Hình Ảnh:</b><br> 
            <img src="<?= htmlspecialchars($sinhvien['Hinh']) ?>" alt="Hình Sinh Viên">
        </p>
        <a href="http://127.0.0.1/BT%20PHP/KiemTra/index.php">Quay lại</a>
    </div>
</body>
</html>
