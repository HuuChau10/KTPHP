<?php
include_once __DIR__ . '/../controller/sinhvienController.php';
include_once __DIR__ . '/../controller/nganhhocController.php';

$svController = new SinhVienController();
$nganhController = new NganhHocController();

$id = $_GET['id'] ?? null;
if (!$id) {
    die("⚠️ Lỗi: Không có ID sinh viên.");
}

$sinhvien = $svController->getById($id);
$nganhs = $nganhController->index();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uploadDir = __DIR__ . '/../images/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    function convertToFilename($str) {
        return strtolower(preg_replace('/[^a-z0-9]/', '_', trim($str))) . ".jpg";
    }

    $file_name = convertToFilename($_POST['HoTen']);
    $target_file = $uploadDir . $file_name;

    if (!empty($_FILES["Hinh"]["name"])) {
        move_uploaded_file($_FILES["Hinh"]["tmp_name"], $target_file);
        $sinhvien['Hinh'] = "app/images/" . $file_name;
    }

    $data = [
        $_POST['HoTen'],
        $_POST['GioiTinh'],
        $_POST['NgaySinh'],
        $sinhvien['Hinh'], // Sử dụng ảnh mới nếu có
        $_POST['MaNganh'],
        $id
    ];

    $svController->update($data);
    header("Location: http://127.0.0.1/BT%20PHP/KiemTra/index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Sinh Viên</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { width: 400px; padding: 10px; border: 1px solid #ccc; }
        input, select, button { width: 100%; padding: 8px; margin: 5px 0; }
    </style>
</head>
<body>
    <h2>Chỉnh Sửa Sinh Viên</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Họ Tên:</label>
        <input type="text" name="HoTen" value="<?= htmlspecialchars($sinhvien['HoTen']) ?>" required>

        <label>Giới Tính:</label>
        <select name="GioiTinh">
            <option value="Nam" <?= ($sinhvien['GioiTinh'] == 'Nam') ? 'selected' : '' ?>>Nam</option>
            <option value="Nữ" <?= ($sinhvien['GioiTinh'] == 'Nữ') ? 'selected' : '' ?>>Nữ</option>
        </select>

        <label>Ngày Sinh:</label>
        <input type="date" name="NgaySinh" value="<?= htmlspecialchars($sinhvien['NgaySinh']) ?>" required>

        <label>Hình hiện tại:</label><br>
        <img src="../<?= htmlspecialchars($sinhvien['Hinh']) ?>" width="150"><br>
        
        <label>Cập nhật hình ảnh:</label>
        <input type="file" name="Hinh">

        <label>Ngành:</label>
        <select name="MaNganh">
            <?php foreach ($nganhs as $nganh) { ?>
                <option value="<?= $nganh['MaNganh'] ?>" <?= ($sinhvien['MaNganh'] == $nganh['MaNganh']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($nganh['TenNganh']) ?>
                </option>
            <?php } ?>
        </select>

        <button type="submit">Cập Nhật</button>
    </form>
    <a href="http://127.0.0.1/BT%20PHP/KiemTra/index.php">Quay lại</a>
</body>
</html>
