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

    public function createAccount($data) {
        $query = "INSERT INTO " . $this->table_name . " (username, email, password) 
                  VALUES (:username, :email, :password)";

        $stmt = $this->conn->prepare($query);

        // Sanitize data
        $data['username'] = htmlspecialchars(strip_tags($data['username']));
        $data['email'] = htmlspecialchars(strip_tags($data['email']));

        // Bind data to the query
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $data['password']);

        // Execute the query
        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    public function emailExists($email) {
        $query = "SELECT id FROM " . $this->table_name . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
    }

    public function getUserByEmail($email) {
        $query = "SELECT id, username, email, password, role FROM " . $this->table_name . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllAccounts() {
        $query = "SELECT id, username, email, role FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}