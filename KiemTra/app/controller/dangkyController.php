<?php
include_once __DIR__ . '/../models/dangky.php';

class DangKyController {
    private $model;

    public function __construct() {
        $this->model = new DangKy();
    }

    public function index() {
        return $this->model->getAll();
    }
}
?>
