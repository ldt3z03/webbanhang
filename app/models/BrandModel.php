<?php

class BrandModel
{
    private $conn;
    private $table_name = "brand";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getBrands()
    {
        $query = "SELECT * FROM brand";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getBrandsWithProductCount()
    {
        $query = "SELECT brand.*, COUNT(product.id) AS product_count
                  FROM brand
                  LEFT JOIN product ON product.brand_id = brand.id
                  GROUP BY brand.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getBrandById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function addBrand($name, $description, $logo = null)
    {
        $query = "INSERT INTO " . $this->table_name . " (name, description, logo) VALUES (:name, :description, :logo)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':logo', $logo);
        return $stmt->execute();
    }

    public function updateBrand($id, $name, $description, $logo = null)
    {
        $query = "UPDATE " . $this->table_name . " SET name = :name, description = :description" .
                 ($logo ? ", logo = :logo" : "") . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        if ($logo) {
            $stmt->bindParam(':logo', $logo);
        }
        return $stmt->execute();
    }

    public function deleteBrand($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
