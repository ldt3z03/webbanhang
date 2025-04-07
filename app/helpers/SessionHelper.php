<?php
class SessionHelper
{
    public static function isLoggedIn()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); // Chỉ khởi tạo session nếu chưa được khởi tạo
        }
        return isset($_SESSION['username']);
    }

    public static function isAdmin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); // Chỉ khởi tạo session nếu chưa được khởi tạo
        }
        return isset($_SESSION['username']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
    }
}