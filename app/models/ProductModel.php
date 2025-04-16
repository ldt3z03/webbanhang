<?php
class ProductModel
{
    private $conn;
    private $table_name = "product";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getProducts()
    {
        $query = "SELECT p.id, p.name, p.description, p.price, p.image, 
                         c.name as category_name, b.name as brand_name
                  FROM " . $this->table_name . " p
                  LEFT JOIN category c ON p.category_id = c.id
                  LEFT JOIN brand b ON p.brand_id = b.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function getProductById($id)
    {
        $query = "SELECT p.*, c.name as category_name, b.name as brand_name, b.logo as brand_logo
                  FROM " . $this->table_name . " p
                  LEFT JOIN category c ON p.category_id = c.id
                  LEFT JOIN brand b ON p.brand_id = b.id
                  WHERE p.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function addProduct($name, $description, $price, $category_id, $brand_id, $image)
    {
        $errors = [];
        if (empty($name)) {
            $errors['name'] = 'Tên sản phẩm không được để trống';
        }
        if (empty($description)) {
            $errors['description'] = 'Mô tả không được để trống';
        }
        if (!is_numeric($price) || $price < 0) {
            $errors['price'] = 'Giá sản phẩm không hợp lệ';
        }
        if (count($errors) > 0) {
            return $errors;
        }

        $query = "INSERT INTO " . $this->table_name . " (name, description, price, category_id, brand_id, image) 
                  VALUES (:name, :description, :price, :category_id, :brand_id, :image)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':brand_id', $brand_id);
        $stmt->bindParam(':image', $image);

        return $stmt->execute();
    }

    public function updateProduct($id, $name, $description, $price, $category_id, $brand_id, $image)
    {
        $query = "UPDATE " . $this->table_name . " 
                  SET name = :name, description = :description, price = :price, 
                      category_id = :category_id, brand_id = :brand_id, image = :image 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':brand_id', $brand_id);
        $stmt->bindParam(':image', $image);

        return $stmt->execute();
    }

    public function deleteProduct($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function searchProducts($query, $category = null, $brand = null)
    {
        $searchQuery = "%" . $query . "%";
        $query = "SELECT p.id, p.name, p.description, p.price, p.image, 
                         c.name as category_name, b.name as brand_name
                  FROM " . $this->table_name . " p
                  LEFT JOIN category c ON p.category_id = c.id
                  LEFT JOIN brand b ON p.brand_id = b.id
                  WHERE (p.name LIKE :query OR p.description LIKE :query)";

        if ($category) {
            $query .= " AND c.id = :category";
        }

        if ($brand) {
            $query .= " AND b.id = :brand";
        }

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':query', $searchQuery);

        if ($category) {
            $stmt->bindParam(':category', $category);
        }

        if ($brand) {
            $stmt->bindParam(':brand', $brand);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
?>