<?php
session_start();
include_once "../../app/config/database.php";

// Kết nối Database
$database = new Database();
$conn = $database->getConnection();

// Lấy danh sách học phần
$query = "SELECT * FROM hocphan";
$stmt = $conn->prepare($query);
$stmt->execute();
$hocphans = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Học Phần</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="app/views/sua.php">Test1</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="sinhvien.php">Sinh Viên</a></li>
                <li class="nav-item"><a class="nav-link" href="hocphan.php">Học Phần</a></li>
                <?php if (isset($_SESSION['sinhvien'])): ?>
                    <li class="nav-item">
                        <a class="nav-link text-warning" href="#">👤 <?= $_SESSION['sinhvien']['HoTen'] ?> (<?= $_SESSION['sinhvien']['MaSV'] ?>)</a>
                    </li>
                    <li class="nav-item"><a class="nav-link btn btn-danger btn-sm text-white" href="logout.php">Đăng Xuất</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link btn btn-primary btn-sm text-white" href="login.php">Đăng Nhập</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="text-center">DANH SÁCH HỌC PHẦN</h2>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Mã Học Phần</th>
                    <th>Tên Học Phần</th>
                    <th>Số Tín Chỉ</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($hocphans as $hp): ?>
                <tr>
                    <td><?= htmlspecialchars($hp['MaHP']) ?></td>
                    <td><?= htmlspecialchars($hp['TenHP']) ?></td>
                    <td><?= htmlspecialchars($hp['SoTinChi']) ?></td>
                    <td><a href="dangki.php?MaHP=<?= urlencode($hp['MaHP']) ?>" class="btn btn-success">Đăng Kí</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
