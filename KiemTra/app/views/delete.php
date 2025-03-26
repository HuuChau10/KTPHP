<?php
include_once __DIR__ . '/../controller/sinhvienController.php';

$svController = new SinhVienController();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sinhvien = $svController->getById($id);

    if ($sinhvien) {
        $image_path = __DIR__ . '/../' . $sinhvien['Hinh'];
        $svController->delete($id);

        if (file_exists($image_path)) {
            unlink($image_path);
        }

        header("Location: http://127.0.0.1/BT%20PHP/KiemTra/index.php");
        exit();
    } else {
        echo "Không tìm thấy sinh viên.";
    }
} else {
    echo "Thiếu ID sinh viên.";
}
?>
