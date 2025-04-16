<?php
require_once 'app/config/database.php';

$database = new Database();
$db = $database->getConnection();

require_once 'app/controllers/BrandController.php';
$brandController = new BrandController($db);
$brands = $brandController->getBrandsWithProductCount();

require_once 'app/models/ProductModel.php';
$productModel = new ProductModel($db);
$products = $productModel->getProducts();

require_once 'app/models/CategoryModel.php';
$categoryModel = new CategoryModel($db);
$categories = $categoryModel->getCategories();

require_once 'app/controllers/AccountController.php';
$accountController = new AccountController();
$users = $accountController->list();

require_once 'app/controllers/OrderController.php';
$orderController = new OrderController();
$orders = $orderController->list();

require_once 'app/controllers/CartController.php';
$cartController = new CartController();
$cartItems = $cartController->getCartItems();

require_once 'app/controllers/ReviewController.php';
$reviewController = new ReviewController();
$reviews = $reviewController->getAllReviews();
?>