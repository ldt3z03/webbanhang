<?php
require_once(__DIR__ . '/../config/database.php');
require_once(__DIR__ . '/../models/ProductModel.php');
require_once(__DIR__ . '/../helpers/SessionHelper.php');

class CartController
{
    private $db;
    private $productModel;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }

    public function index()
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

        include __DIR__ . '/../views/cart/Cart.php';
    }

    public function add($productId)
    {
        if (!SessionHelper::isLoggedIn()) {
            header('Location: /webbanhang/account/login');
            return;
        }

        $userId = $_SESSION['user_id'];
        $query = "INSERT INTO cart (user_id, product_id, quantity) 
                  VALUES (:user_id, :product_id, 1)
                  ON DUPLICATE KEY UPDATE quantity = quantity + 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();

        // Return JSON response for AJAX
        echo json_encode(['success' => true, 'message' => 'Thêm vào giỏ hàng thành công']);
    }

    public function remove($productId)
    {
        if (!SessionHelper::isLoggedIn()) {
            header('Location: /webbanhang/account/login');
            return;
        }

        $userId = $_SESSION['user_id'];
        $query = "DELETE FROM cart WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();

        header('Location: /webbanhang/Cart');
    }

    public function updateQuantity($productId)
    {
        if (!SessionHelper::isLoggedIn()) {
            header('Location: /webbanhang/account/login');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $quantity = (int)$_POST['quantity'];
            if ($quantity < 1) {
                $quantity = 1;
            }

            $userId = $_SESSION['user_id'];
            $query = "UPDATE cart SET quantity = :quantity WHERE user_id = :user_id AND product_id = :product_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
            $stmt->execute();

            // Return JSON response for AJAX
            echo json_encode(['success' => true]);
            return;
        }

        echo json_encode(['success' => false]);
    }
}
?>