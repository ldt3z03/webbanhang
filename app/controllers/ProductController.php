<?php
// Require SessionHelper and other necessary files
require_once(__DIR__ . '/../config/database.php');
require_once(__DIR__ . '/../models/ProductModel.php');
require_once(__DIR__ . '/../models/CategoryModel.php');
require_once(__DIR__ . '/../models/BrandModel.php');
require_once(__DIR__ . '/../helpers/SessionHelper.php');

class ProductController
{
    private $productModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }

    public function index()
    {
        $products = $this->productModel->getProducts();
        include __DIR__ . '/../views/product/list.php';
    }

    public function show($id)
    {
        $product = $this->productModel->getProductById($id);
        if ($product) {
            include __DIR__ . '/../views/product/show.php';
        } else {
            echo "Không thấy sản phẩm.";
        }
    }

    public function add()
    {
        $categories = (new CategoryModel($this->db))->getCategories();
        $brands = (new BrandModel($this->db))->getBrands();
        include_once __DIR__ . '/../views/product/add.php';
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? '';
            $category_id = $_POST['category_id'] ?? null;
            $brand_id = $_POST['brand_id'] ?? null;

            $image = isset($_FILES['image']) && $_FILES['image']['error'] == 0
                ? $this->uploadImage($_FILES['image'])
                : "";

            $result = $this->productModel->addProduct($name, $description, $price, $category_id, $brand_id, $image);

            if (is_array($result)) {
                $errors = $result;
                $categories = (new CategoryModel($this->db))->getCategories();
                $brands = (new BrandModel($this->db))->getBrands();
                include __DIR__ . '/../views/product/add.php';
            } else {
                header('Location: /webbanhang/Product');
                exit;
            }
        }
    }

    public function edit($id)
    {
        $product = $this->productModel->getProductById($id);
        $categories = (new CategoryModel($this->db))->getCategories();
        $brands = (new BrandModel($this->db))->getBrands();
        if ($product) {
            include __DIR__ . '/../views/product/edit.php';
        } else {
            echo "Không thấy sản phẩm.";
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category_id = $_POST['category_id'];
            $brand_id = $_POST['brand_id'];
            $image = isset($_FILES['image']) && $_FILES['image']['error'] == 0
                ? $this->uploadImage($_FILES['image'])
                : $_POST['existing_image'];

            $edit = $this->productModel->updateProduct($id, $name, $description, $price, $category_id, $brand_id, $image);

            if ($edit) {
                header('Location: /webbanhang/Product');
                exit;
            } else {
                echo "Đã xảy ra lỗi khi lưu sản phẩm.";
            }
        }
    }

    public function delete($id)
    {
        if ($this->productModel->deleteProduct($id)) {
            header('Location: /webbanhang/Product');
        } else {
            echo "Đã xảy ra lỗi khi xóa sản phẩm.";
        }
    }

    private function uploadImage($file)
    {
        $target_dir = __DIR__ . '/../../uploads/';
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $target_file = $target_dir . basename($file["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Kiểm tra xem file có phải là hình ảnh không
        if (!isset($file["tmp_name"]) || !getimagesize($file["tmp_name"])) {
            throw new Exception("File không phải là hình ảnh.");
        }

        // Chỉ chấp nhận các định dạng file hình ảnh
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowed_types)) {
            throw new Exception("Chỉ chấp nhận các file hình ảnh có định dạng JPG, JPEG, PNG, GIF.");
        }

        // Kiểm tra kích thước file (giới hạn 2MB)
        if ($file["size"] > 2 * 1024 * 1024) {
            throw new Exception("Kích thước file không được vượt quá 2MB.");
        }

        // Di chuyển file tải lên đến thư mục đích
        if (!move_uploaded_file($file["tmp_name"], $target_file)) {
            throw new Exception("Không thể tải lên file.");
        }

        return 'uploads/' . basename($file["name"]);
    }

    public function addToCart($id)
    {
        if (!SessionHelper::isLoggedIn()) {
            header('Location: /webbanhang/account/login');
            exit;
        }

        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'Lỗi: Không tìm thấy user_id trong session.']);
            return;
        }

        $userId = $_SESSION['user_id'];
        $product = $this->productModel->getProductById($id);

        if (!$product) {
            echo json_encode(['success' => false, 'message' => 'Không tìm thấy sản phẩm.']);
            return;
        }

        $query = "INSERT INTO cart (user_id, product_id, quantity) 
                  VALUES (:user_id, :product_id, 1)
                  ON DUPLICATE KEY UPDATE quantity = quantity + 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':product_id', $id);
        $stmt->execute();

        echo json_encode(['success' => true, 'message' => 'Thêm vào giỏ hàng thành công!']);
    }

    public function cart()
    {
        if (!SessionHelper::isLoggedIn()) {
            header('Location: /webbanhang/account/login');
            return;
        }

        $userId = $_SESSION['user_id'];
        $query = "SELECT c.product_id, c.quantity, p.name, p.price, p.image 
                  FROM cart c
                  JOIN product p ON c.product_id = p.id
                  WHERE c.user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        $cart = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ . '/../views/cart/Cart.php'; // Sửa đường dẫn để trỏ đến vị trí mới của file Cart.php
    }

    public function checkout()
    {
        if (!SessionHelper::isLoggedIn()) {
            header('Location: /webbanhang/account/login');
            exit;
        }

        $userId = $_SESSION['user_id'];
        $query = "SELECT c.product_id, c.quantity, p.name, p.price, p.image 
                  FROM cart c
                  JOIN product p ON c.product_id = p.id
                  WHERE c.user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        $cart = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ . '/../views/product/checkout.php';
    }

    public function processCheckout()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['customer_name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $payment_method = $_POST['payment_method'];

            $userId = $_SESSION['user_id'] ?? null;
            if (!$userId) {
                echo "Người dùng chưa đăng nhập.";
                return;
            }

            // Lấy giỏ hàng từ cơ sở dữ liệu
            $query = "SELECT c.product_id, c.quantity, p.price FROM cart c JOIN product p ON c.product_id = p.id WHERE c.user_id = :user_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();
            $cart = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($cart)) {
                echo "Giỏ hàng trống.";
                return;
            }

            $this->db->beginTransaction();
            try {
                // Thêm đơn hàng vào bảng orders
                $query = "INSERT INTO orders (name, phone, address, payment_method, created_at) VALUES (:name, :phone, :address, :payment_method, NOW())";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':address', $address);
                $stmt->bindParam(':payment_method', $payment_method);
                $stmt->execute();

                $order_id = $this->db->lastInsertId();
                $_SESSION['last_order_id'] = $order_id;

                // Thêm chi tiết đơn hàng vào bảng order_details
                foreach ($cart as $item) {
                    $query = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)";
                    $stmt = $this->db->prepare($query);
                    $stmt->bindParam(':order_id', $order_id);
                    $stmt->bindParam(':product_id', $item['product_id']);
                    $stmt->bindParam(':quantity', $item['quantity']);
                    $stmt->bindParam(':price', $item['price']);
                    $stmt->execute();
                }

                // Xóa giỏ hàng sau khi đặt hàng
                $query = "DELETE FROM cart WHERE user_id = :user_id";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':user_id', $userId);
                $stmt->execute();

                $this->db->commit();

                header('Location: /webbanhang/Product/orderConfirmation');
            } catch (Exception $e) {
                $this->db->rollBack();
                echo "Đã xảy ra lỗi khi xử lý đơn hàng: " . $e->getMessage();
            }
        }
    }

    public function orderConfirmation()
    {
        // Ghi nhật ký để kiểm tra giá trị của $_SESSION['last_order_id']
        error_log('Session last_order_id: ' . ($_SESSION['last_order_id'] ?? 'Not set'));

        if (!isset($_SESSION['last_order_id'])) {
            echo "Không tìm thấy thông tin đơn hàng.";
            return;
        }

        $orderId = $_SESSION['last_order_id'];

        // Lấy thông tin đơn hàng
        $query = "SELECT * FROM orders WHERE id = :order_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':order_id', $orderId);
        $stmt->execute();
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$order) {
            echo "Không tìm thấy thông tin đơn hàng.";
            return;
        }

        // Lấy thông tin sản phẩm trong đơn hàng
        $query = "SELECT od.*, p.name, p.image, b.name AS brand_name FROM order_details od
                  JOIN product p ON od.product_id = p.id
                  LEFT JOIN brand b ON p.brand_id = b.id
                  WHERE od.order_id = :order_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':order_id', $orderId);
        $stmt->execute();
        $orderItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ . '/../views/product/orderConfirmation.php';
    }

    public function search()
    {
        $query = $_GET['q'] ?? '';
        $category = $_GET['category'] ?? null;
        $brand = $_GET['brand'] ?? null;

        $products = $this->productModel->searchProducts($query, $category, $brand);
        include __DIR__ . '/../views/product/list.php';
    }

    public function autocomplete()
    {
        $query = $_GET['q'] ?? '';
        $suggestions = $this->productModel->searchProducts($query);

        // Trả về danh sách tên sản phẩm dưới dạng JSON
        $result = array_map(function ($product) {
            return $product->name;
        }, $suggestions);

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function listAdmin()
    {
        $products = $this->productModel->getProducts();
        include __DIR__ . '/../views/admin/listAdmin.php';
    }
}
?>
