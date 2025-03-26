<?php
session_start();
include_once "../../app/config/database.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $maSV = trim($_POST['MaSV']);
    
    if (!empty($maSV)) {
        $database = new Database();
        $conn = $database->getConnection();

        // Truy vấn kiểm tra sinh viên
        $query = "SELECT * FROM sinhvien WHERE MaSV = :maSV";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':maSV', $maSV);
        $stmt->execute();
        $sinhvien = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($sinhvien) {
            $_SESSION['sinhvien'] = $sinhvien;
            header("Location: ../../index.php");
            exit();
        } else {
            $error = "Mã sinh viên không tồn tại!";
        }
    } else {
        $error = "Vui lòng nhập Mã Sinh Viên!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow" style="width: 400px;">
        <h2 class="text-center">Đăng Nhập</h2>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label for="MaSV" class="form-label">Mã Sinh Viên</label>
                <input type="text" class="form-control" name="MaSV" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Đăng Nhập</button>
        </form>
        <a href="../../index.php" class="d-block text-center mt-3">Quay lại trang chủ</a>
    </div>
</body>
</html>
