<?php
require_once(__DIR__ . '/../config/database.php');
require_once(__DIR__ . '/../models/OrderModel.php');

class OrderController {
    private $orderModel;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->orderModel = new OrderModel($this->db);
    }

    public function list() {
        $orders = $this->orderModel->getAllOrders();
        include __DIR__ . '/../views/order/list.php';
    }

    public function details($id) {
        $order = $this->orderModel->getOrderById($id);
        include __DIR__ . '/../views/order/details.php';
    }
}
?>