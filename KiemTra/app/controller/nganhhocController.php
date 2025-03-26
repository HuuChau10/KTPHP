<?php
include_once __DIR__ . '/../models/nganhhoc.php';

class NganhHocController {
    private $model;

    public function __construct() {
        $this->model = new NganhHoc();
    }

    public function index() {
        return $this->model->getAll();
    }
}
?>
