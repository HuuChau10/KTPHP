<?php
include_once __DIR__ . '/../models/chitietdangky.php';

class ChiTietDangKyController {
    private $model;

    public function __construct() {
        $this->model = new ChiTietDangKy();
    }

    public function index() {
        return $this->model->getAll();
    }
}
?>
