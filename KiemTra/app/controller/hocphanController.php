<?php
include_once __DIR__ . '/../models/hocphanhocphan.php';

class HocPhanController {
    private $model;

    public function __construct() {
        $this->model = new HocPhan();
    }

    public function index() {
        return $this->model->getAll();
    }
}
?>
