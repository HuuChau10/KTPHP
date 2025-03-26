<?php
include_once __DIR__ . '/app/controller/SinhVienController.php';

$svController = new SinhVienController();
$sinhviens = $svController->index();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sinh Viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            text-align: center;
        }
        h2 {
            color: #2c3e50;
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

    <h2>Danh Sách Sinh Viên</h2>
    <a class="add-btn" href="app/views/create.php">➕ Thêm Sinh Viên</a>

    <table>
        <tr>
            <th>Mã SV</th>
            <th>Họ Tên</th>
            <th>Giới Tính</th>
            <th>Ngày Sinh</th>
            <th>Ngành</th>
            <th>Hình</th>
            <th>Hành Động</th>
        </tr>
        <?php if (!empty($sinhviens)): ?>
            <?php foreach ($sinhviens as $sv): ?>
            <tr>
                <td><?= htmlspecialchars($sv['MaSV']) ?></td>
                <td><?= htmlspecialchars($sv['HoTen']) ?></td>
                <td><?= htmlspecialchars($sv['GioiTinh']) ?></td>
                <td><?= htmlspecialchars($sv['NgaySinh']) ?></td>
                <td><?= htmlspecialchars($sv['MaNganh']) ?></td>
                <td>
                    <img src="<?= htmlspecialchars($sv['Hinh']) ?>" alt="Hình Sinh Viên">
                </td>
                <td>
                    <a href="app/views/detail.php?id=<?= urlencode($sv['MaSV']) ?>">👀 Xem</a> |
                    <a href="app/views/edit.php?id=<?= urlencode($sv['MaSV']) ?>">✏️ Sửa</a> |
                    <a href="app/views/delete.php?id=<?= urlencode($sv['MaSV']) ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">🗑 Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="7">Không có dữ liệu</td></tr>
        <?php endif; ?>
    </table>

</body>
</html>
