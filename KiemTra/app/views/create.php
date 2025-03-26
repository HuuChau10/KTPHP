<?php
include_once __DIR__ . '/../controller/sinhvienController.php';
include_once __DIR__ . '/../controller/nganhhocController.php';

$svController = new SinhVienController();
$nganhController = new NganhHocController();
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

    if (move_uploaded_file($_FILES["Hinh"]["tmp_name"], $target_file)) {
        $data = [
            $_POST['MaSV'],
            $_POST['HoTen'],
            $_POST['GioiTinh'],
            $_POST['NgaySinh'],
            "app/images/" . $file_name,
            $_POST['MaNganh']
        ];
        $svController->create($data);
        header("Location: http://127.0.0.1/BT%20PHP/KiemTra/index.php");
        exit();
    } else {
        echo "Lỗi khi tải ảnh lên.";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Thêm Sinh Viên</title></head>
<body>
    <h2>Thêm Sinh Viên</h2>
    <form method="POST" enctype="multipart/form-data">
        Mã SV: <input type="text" name="MaSV" required><br>
        Họ Tên: <input type="text" name="HoTen" required><br>
        Giới Tính: <select name="GioiTinh"><option value="Nam">Nam</option><option value="Nữ">Nữ</option></select><br>
        Ngày Sinh: <input type="date" name="NgaySinh" required><br>
        Hình: <input type="file" name="Hinh" accept="image/*" required><br>
        Ngành: 
        <select name="MaNganh">
            <?php foreach ($nganhs as $nganh) { ?>
                <option value="<?= $nganh['MaNganh'] ?>"><?= $nganh['TenNganh'] ?></option>
            <?php } ?>
        </select><br>
        <button type="submit">Thêm</button>
    </form>
    <a href="http://127.0.0.1/BT%20PHP/KiemTra/index.php">Quay lại</a>
</body>
</html>
