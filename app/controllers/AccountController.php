<?php
require_once(__DIR__ . '/../config/database.php'); 
require_once(__DIR__ . '/../models/AccountModel.php');

class AccountController { 
    private $accountModel; 
    private $db; 

    public function __construct() { 
        $this->db = (new Database())->getConnection(); 
        $this->accountModel = new AccountModel($this->db); 
    } 

    public function register() { 
        include_once __DIR__ . '/../views/account/register.php'; 
    } 

    public function login() { 
        include_once __DIR__ . '/../views/account/login.php'; 
    } 

    public function save() { 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
            $username = $_POST['username'] ?? ''; 
            $fullName = $_POST['fullname'] ?? ''; 
            $password = $_POST['password'] ?? ''; 
            $confirmPassword = $_POST['confirmpassword'] ?? ''; 
            $errors = []; 

            if (empty($username)) { 
                $errors['username'] = "Vui lòng nhập userName!"; 
            } 
            if (empty($fullName)) { 
                $errors['fullname'] = "Vui lòng nhập fullName!"; 
            } 
            if (empty($password)) { 
                $errors['password'] = "Vui lòng nhập password!"; 
            } 
            if ($password != $confirmPassword) { 
                $errors['confirmPass'] = "Mật khẩu và xác nhận chưa đúng"; 
            } 

            // Kiểm tra username đã được đăng ký chưa?
            $account = $this->accountModel->getAccountByUsername($username); 
            if ($account) { 
                $errors['account'] = "Tài khoản này đã có người đăng ký!"; 
            } 

            if (count($errors) > 0) { 
                include_once __DIR__ . '/../views/account/register.php'; 
            } else { 
                $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
                $result = $this->accountModel->save($username, $fullName, $password); 

                if ($result) { 
                    header('Location: /webbanhang/account/login'); 
                } 
            } 
        } 
    } 

    public function logout() { 
        unset($_SESSION['username']); 
        unset($_SESSION['role']); 
        header('Location: /webbanhang/product'); 
    } 

    public function checkLogin() { 
        // Kiểm tra xem liệu form đã được submit
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
            $username = $_POST['username'] ?? ''; 
            $password = $_POST['password'] ?? ''; 
            $account = $this->accountModel->getAccountByUserName($username); 

            if ($account) { 
                $pwd_hashed = $account->password; 
                // Check mật khẩu
                if (password_verify($password, $pwd_hashed)) { 
                    session_start(); 
                    $_SESSION['username'] = $account->username; 
                    header('Location: /webbanhang/product'); 
                    exit; 
                } else { 
                    echo "Password incorrect."; 
                } 
            } else { 
                echo "Báo lỗi không tìm thấy tài khoản"; 
            } 
        } 
    } 
}