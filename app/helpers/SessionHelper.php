<?php
class SessionHelper
{
    public static function isLoggedIn()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); 
        }
        return isset($_SESSION['username']);
    }

    public static function isAdmin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); 
        }
        return isset($_SESSION['username']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
    }

    public static function clearUserSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
    }

    public static function setUserSession($userId, $email, $username, $userRole) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['user_id'] = $userId;
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $username;
        $_SESSION['user_role'] = $userRole;
    }
}