<?php
session_start();
include_once "../../app/config/database.php";

if (!isset($_SESSION['sinhvien'])) {
    header("Location: login.php");
    exit();
}

$maSV = $_SESSION['sinhvien']['MaSV'];
$maHP = isset($_GET['MaHP']) ? trim($_GET['MaHP']) : "";

if (!empty($maHP)) {
    $database = new Database();
    $conn = $database->getConnection();

    // Kiểm tra xem đã đăng ký môn này chưa
    $queryCheck = "SELECT * FROM dangki WHERE MaSV = :maSV AND MaHP = :maHP";
    $stmtCheck = $conn->prepare($queryCheck);
    $stmtCheck->bindParam(":maSV", $maSV);
    $stmtCheck->bindParam(":maHP", $maHP);
    $stmtCheck->execute();
    
    if ($stmtCheck->rowCount() > 0) {
        echo "<script>alert('Bạn đã đăng ký môn này rồi!'); window.location='hocphan.php';</script>";
    } else {
        // Thêm vào bảng đăng ký
        $queryInsert = "INSERT INTO dangki (MaSV, MaHP) VALUES (:maSV, :maHP)";
        $stmtInsert = $conn->prepare($queryInsert);
        $stmtInsert->bindParam(":maSV", $maSV);
        $stmtInsert->bindParam(":maHP", $maHP);
        
        if ($stmtInsert->execute()) {
            echo "<script>alert('Đăng ký thành công!'); window.location='hocphan.php';</script>";
        } else {
            echo "<script>alert('Lỗi đăng ký!'); window.location='hocphan.php';</script>";
        }
    }
} else {
    echo "<script>alert('Mã học phần không hợp lệ!'); window.location='hocphan.php';</script>";
}
?>
