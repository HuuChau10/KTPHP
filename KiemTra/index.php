<?php
session_start();
include_once __DIR__ . '/app/controller/SinhVienController.php';

$svController = new SinhVienController();
$sinhviens = $svController->index();
$sinhvien = isset($_SESSION['sinhvien']) ? $_SESSION['sinhvien'] : null;

// Xử lý thông báo nếu có
$thongbao = isset($_SESSION['thongbao']) ? $_SESSION['thongbao'] : "";
unset($_SESSION['thongbao']); // Xóa thông báo sau khi hiển thị
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sinh Viên</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2 {
            color: #2c3e50;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f8f9fa;
        }
        img {
            width: 80px;
            height: auto;
            border-radius: 5px;
        }
        a {
            text-decoration: none;
            margin: 5px;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
        .add-btn {
            display: inline-block;
            margin-bottom: 10px;
            padding: 8px 12px;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }
        .add-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<!-- 🟢 Thanh menu -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Test1</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="app/views/hocphan.php">Học Phần</a></li>
            <li class="nav-item"><a class="nav-link" href="app/views/sinhvien.php">Sinh Viên</a></li>

            <?php if ($sinhvien): ?>
                <li class="nav-item">
                    <a class="nav-link text-warning" href="#">
                        👤 <?= htmlspecialchars($sinhvien['HoTen']) ?> (<?= htmlspecialchars($sinhvien['MaSV']) ?>)
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-danger btn-sm text-white" href="app/views/logout.php">Đăng Xuất</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary btn-sm text-white" href="app/views/login.php">Đăng Nhập</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<!-- 🟢 Thông báo -->
<?php if (!empty($thongbao)): ?>
    <div class="alert alert-success text-center"><?= htmlspecialchars($thongbao) ?></div>
<?php endif; ?>

<!-- 🟢 Nội dung chính -->
<div class="container">
    <h2>Danh Sách Sinh Viên</h2>
    <a class="add-btn" href="app/views/create.php">➕ Thêm Sinh Viên</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã SV</th>
                <th>Họ Tên</th>
                <th>Giới Tính</th>
                <th>Ngày Sinh</th>
                <th>Ngành</th>
                <th>Hình</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($sinhviens)): ?>
                <?php foreach ($sinhviens as $sv): ?>
                <tr>
                    <td><?= htmlspecialchars($sv['MaSV']) ?></td>
                    <td><?= htmlspecialchars($sv['HoTen']) ?></td>
                    <td><?= htmlspecialchars($sv['GioiTinh']) ?></td>
                    <td><?= htmlspecialchars($sv['NgaySinh']) ?></td>
                    <td><?= htmlspecialchars($sv['MaNganh']) ?></td>
                    <td>
                        <img src="<?= filter_var($sv['Hinh'], FILTER_SANITIZE_URL) ?>" alt="Hình Sinh Viên">
                    </td>
                    <td>
                        <a href="app/views/detail.php?id=<?= urlencode($sv['MaSV']) ?>">👀 Xem</a> |
                        <a href="app/views/sua.php?id=<?= urlencode($sv['MaSV']) ?>">✏️ Sửa</a> |
                        <a href="app/views/delete.php?id=<?= urlencode($sv['MaSV']) ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">🗑 Xóa</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7" class="text-center">Không có dữ liệu</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
