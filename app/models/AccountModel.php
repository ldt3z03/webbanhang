<?php
class AccountModel
{
    private $conn;
    private $table_name = "account";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAccountByUsername($username)
    {
        $query = "SELECT id, username, password, role FROM account WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function save($username, $name, $password, $role = "user")
    {
        $query = "INSERT INTO " . $this->table_name . " (username, password, role) 
                  VALUES (:username, :password, :role)";

        $stmt = $this->conn->prepare($query);

        // Sanitize data
        $name = htmlspecialchars(strip_tags($name));
        $username = htmlspecialchars(strip_tags($username));

        // Bind data to the query
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);

        // Execute the query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}