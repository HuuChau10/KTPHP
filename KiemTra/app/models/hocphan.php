<?php
include_once __DIR__ . '/../config/database.php';

class HocPhan {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAll() {
        $sql = "SELECT * FROM HocPhan";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
