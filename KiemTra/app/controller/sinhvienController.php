<?php
include_once __DIR__ . '/../models/sinhvien.php';

class SinhVienController {
    private $model;

    public function __construct() {
        $this->model = new SinhVien();
    }

    public function index() {
        return $this->model->getAll();
    }

    public function getById($id) {
        return $this->model->getById($id);
    }

    public function view($id) {
        return $this->model->getById($id);
    }

    public function create($data) {
        return $this->model->insert($data);
    }

    public function update($data) {
        return $this->model->update($data);
    }

    public function delete($id) {
        return $this->model->delete($id);
    }
}
?>
