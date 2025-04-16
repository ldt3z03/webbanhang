<?php

class CartModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getCartByUserId($userId)
    {
        $query = "SELECT c.product_id, c.quantity, p.name, p.price, p.image 
                  FROM cart c
                  JOIN product p ON c.product_id = p.id
                  WHERE c.user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addToCart($userId, $productId, $quantity = 1)
    {
        $query = "INSERT INTO cart (user_id, product_id, quantity) 
                  VALUES (:user_id, :product_id, :quantity)
                  ON DUPLICATE KEY UPDATE quantity = quantity + :quantity";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':product_id', $productId);
        $stmt->bindParam(':quantity', $quantity);
        return $stmt->execute();
    }

    public function updateCartQuantity($userId, $productId, $quantity)
    {
        $query = "UPDATE cart SET quantity = :quantity WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':product_id', $productId);
        $stmt->bindParam(':quantity', $quantity);
        return $stmt->execute();
    }

    public function removeFromCart($userId, $productId)
    {
        $query = "DELETE FROM cart WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':product_id', $productId);
        return $stmt->execute();
    }

    public function clearCart($userId)
    {
        $query = "DELETE FROM cart WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        return $stmt->execute();
    }
}
