<?php
include_once __DIR__ . '/../config/database.php';

class NganhHoc {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getAll() {
        $sql = "SELECT * FROM NganhHoc";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
