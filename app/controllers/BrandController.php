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

    public function index()
    {
        $brands = $this->getBrandsWithProductCount();
        include __DIR__ . '/../views/brand/list.php';
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
            $logo = $_FILES['logo'] ?? null;

            if ($logo && $logo['error'] === UPLOAD_ERR_OK) {
                $targetDir = __DIR__ . '/../../uploads/';
                $fileName = uniqid() . '-' . basename($logo['name']);
                $targetFile = $targetDir . $fileName;

                if (move_uploaded_file($logo['tmp_name'], $targetFile)) {
                    $this->brandModel->addBrand($name, $description, 'uploads/' . $fileName);
                } else {
                    $_SESSION['error'] = 'Không thể tải lên logo.';
                }
            } else {
                $this->brandModel->addBrand($name, $description);
            }

            header('Location: /webbanhang/Brand');
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
            $logo = $_FILES['logo'] ?? null;

            if ($logo && $logo['error'] === UPLOAD_ERR_OK) {
                $targetDir = __DIR__ . '/../../uploads/';
                $fileName = uniqid() . '-' . basename($logo['name']);
                $targetFile = $targetDir . $fileName;

                if (move_uploaded_file($logo['tmp_name'], $targetFile)) {
                    $this->brandModel->updateBrand($id, $name, $description, 'uploads/' . $fileName);
                } else {
                    $_SESSION['error'] = 'Không thể tải lên logo.';
                }
            } else {
                $this->brandModel->updateBrand($id, $name, $description);
            }

            header('Location: /webbanhang/Brand');
        }
    }

    public function delete($id)
    {
        $this->brandModel->deleteBrand($id);
        header('Location: /webbanhang/Brand');
    }

    public function getBrandsWithProductCount() {
        $query = "SELECT brand.*, COUNT(product.id) AS product_count
                  FROM brand
                  LEFT JOIN product ON product.brand_id = brand.id
                  GROUP BY brand.id";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
?>
