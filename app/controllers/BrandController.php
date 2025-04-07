<?php
require_once(__DIR__ . '/../config/database.php');
require_once(__DIR__ . '/../models/BrandModel.php');

class BrandController
{
    private $brandModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->brandModel = new BrandModel($this->db);
    }

    public function list()
    {
        $brands = $this->brandModel->getBrands();
        include __DIR__ . '/../views/brand/list.php';
    }

    public function add()
    {
        include __DIR__ . '/../views/brand/add.php';
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $this->brandModel->addBrand($name, $description);
            header('Location: /webbanhang/Brand/list');
        }
    }

    public function edit($id)
    {
        $brand = $this->brandModel->getBrandById($id);
        include __DIR__ . '/../views/brand/edit.php';
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $this->brandModel->updateBrand($id, $name, $description);
            header('Location: /webbanhang/Brand/list');
        }
    }

    public function delete($id)
    {
        $this->brandModel->deleteBrand($id);
        header('Location: /webbanhang/Brand/list');
    }
}
?>
