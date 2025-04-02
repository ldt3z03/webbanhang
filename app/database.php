<?php
class Database {
    private $host = "localhost";
    private $db_name = "webbanhang";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Hiển thị lỗi chi tiết
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            die("Connection error: " . $exception->getMessage()); // Dừng và hiển thị lỗi
        }

        return $this->conn;
    }
}
