<?php
include_once __DIR__ . '/../config/database.php';

class SinhVien {
    private $db;

    public function __construct() {
        $this->db = new PDO("mysql:host=localhost;dbname=your_database", "root", "");
    }

    public function getAll() {
        $sql = "SELECT sv.*, nh.TenNganh FROM SinhVien sv 
                LEFT JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT * FROM SinhVien WHERE MaSV = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($data) {
        $sql = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($data) {
        $sql = "UPDATE SinhVien SET HoTen=?, GioiTinh=?, NgaySinh=?, Hinh=?, MaNganh=? WHERE MaSV=?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($id) {
        $sql = "DELETE FROM SinhVien WHERE MaSV=?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
