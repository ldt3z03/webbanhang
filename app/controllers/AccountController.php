<?php
require_once(__DIR__ . '/../config/database.php'); 
require_once(__DIR__ . '/../models/AccountModel.php');
require_once(__DIR__ . '/../helpers/SessionHelper.php');

class AccountController { 
    private $accountModel; 
    private $db; 
    private $sessionHelper;

    public function __construct() { 
        $this->db = (new Database())->getConnection(); 
        $this->accountModel = new AccountModel($this->db); 
        $this->sessionHelper = new SessionHelper();
    } 

    private function validateEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return 'Email không hợp lệ';
        }
        return null;
    }

    private function validatePassword($password) {
        if (strlen($password) < 8) {
            return 'Mật khẩu phải có ít nhất 8 ký tự';
        }
        if (!preg_match('/[A-Za-z]/', $password) || !preg_match('/\d/', $password)) {
            return 'Mật khẩu phải chứa cả chữ và số';
        }
        // Allow special characters
        return null;
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirmPassword'] ?? '';

            // Validation
            if (empty($username)) {
                $_SESSION['error'] = 'Vui lòng điền tên người dùng';
                header('Location: /webbanhang/Account/register');
                exit;
            }

            $emailError = $this->validateEmail($email);
            if ($emailError) {
                $_SESSION['error'] = $emailError;
                header('Location: /webbanhang/Account/register');
                exit;
            }

            if ($this->accountModel->emailExists($email)) {
                $_SESSION['error'] = 'Email đã được sử dụng';
                header('Location: /webbanhang/Account/register');
                exit;
            }

            $passwordError = $this->validatePassword($password);
            if ($passwordError) {
                $_SESSION['error'] = $passwordError;
                header('Location: /webbanhang/Account/register');
                exit;
            }

            if ($password !== $confirmPassword) {
                $_SESSION['error'] = 'Mật khẩu xác nhận không khớp';
                header('Location: /webbanhang/Account/register');
                exit;
            }

            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Create account
            $userId = $this->accountModel->createAccount([
                'username' => $username,
                'email' => $email,
                'password' => $hashedPassword
            ]);

            if ($userId) {
                $_SESSION['success'] = 'Đăng ký thành công';
                $this->sessionHelper->setUserSession($userId, $email, $username, $user['role']);
                header('Location: /webbanhang/app/');
                exit;
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra, vui lòng thử lại';
                header('Location: /webbanhang/Account/register');
                exit;
            }
        }

        // GET request - show register form
        include __DIR__ . '/../views/account/register.php';
    } 

    public function login() { 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $rememberMe = isset($_POST['remember_me']);

            // Validation
            $emailError = $this->validateEmail($email);
            if ($emailError) {
                $_SESSION['error'] = $emailError;
                header('Location: /webbanhang/Account/login');
                exit;
            }

            // Get user
            $user = $this->accountModel->getUserByEmail($email);
            
            if (!$user || !password_verify($password, $user['password'])) {
                $_SESSION['error'] = 'Email hoặc mật khẩu không chính xác';
                header('Location: /webbanhang/Account/login');
                exit;
            }

            // Set session
            $this->sessionHelper->setUserSession(
                $user['id'], 
                $user['email'],
                $user['firstName'] . ' ' . $user['lastName'],
                $user['role']
            );

            // Handle Remember Me
            if ($rememberMe) {
                $token = bin2hex(random_bytes(32));
                $this->accountModel->saveRememberMeToken($user['id'], $token);
                setcookie('remember_token', $token, time() + (30 * 24 * 60 * 60), '/');
            }

            header('Location: /webbanhang/app/');
            exit;
        }

        // GET request - show login form
        include __DIR__ . '/../views/account/login.php';
    } 

    public function logout() { 
        // Clear remember me token if exists
        if (isset($_COOKIE['remember_token'])) {
            $this->accountModel->clearRememberMeToken($_SESSION['user_id']);
            setcookie('remember_token', '', time() - 3600, '/');
        }

        $this->sessionHelper->clearUserSession();
        header('Location: /webbanhang/Account/login');
        exit;
    } 

    // Check if user is logged in via remember me token
    public function checkRememberMe() {
        if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_token'])) {
            $token = $_COOKIE['remember_token'];
            $user = $this->accountModel->getUserByRememberToken($token);
            
            if ($user) {
                $this->sessionHelper->setUserSession(
                    $user['id'],
                    $user['email'],
                    $user['firstName'] . ' ' . $user['lastName'],
                    $user['role']
                );
            }
        }
    }

    public function list() {
        $users = $this->accountModel->getAllAccounts();
        return $users;
    }
}