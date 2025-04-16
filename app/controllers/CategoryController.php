<?php
// Require SessionHelper and other necessary files
require_once(__DIR__ . '/../config/database.php');
require_once(__DIR__ . '/../models/CategoryModel.php');

class CategoryController
{
    private $categoryModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->categoryModel = new CategoryModel($this->db);
    }

    public function index()
    {
        $this->list();
    }

    public function list()
    {
        $categories = $this->categoryModel->getCategories();
        include __DIR__ . '/../views/category/list.php';
    }

    public function add()
    {
        include __DIR__ . '/../views/category/add.php';
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'] ?? null;

            if ($this->categoryModel->addCategory($name, $description)) {
                $_SESSION['success'] = 'Danh mục đã được thêm thành công!';
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra khi thêm danh mục.';
            }

            header('Location: /webbanhang/Category');
        }
    }

    public function edit($id)
    {
        $category = $this->categoryModel->getCategoryById($id);
        include __DIR__ . '/../views/category/edit.php';
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'] ?? null;

            if ($this->categoryModel->updateCategory($id, $name, $description)) {
                $_SESSION['success'] = 'Danh mục đã được cập nhật thành công!';
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra khi cập nhật danh mục.';
            }

            header('Location: /webbanhang/Category');
        }
    }

    public function delete($id)
    {
        $category = $this->categoryModel->getCategoryById($id);
        include __DIR__ . '/../views/category/delete.php';
    }

    public function deleteConfirm($id)
    {
        if ($this->categoryModel->deleteCategory($id)) {
            $_SESSION['success'] = 'Danh mục đã được xóa thành công!';
        } else {
            $_SESSION['error'] = 'Có lỗi xảy ra khi xóa danh mục.';
        }

        header('Location: /webbanhang/Category');
    }
}
?>