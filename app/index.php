<?php
session_start();
require_once __DIR__ . '/models/ProductModel.php';

$url = $_GET['url'] ?? '';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);

if (empty($url[0]) || $url[0] === '') {
    $url[0] = 'Product'; // Mặc định chuyển đến controller Product
    $url[1] = 'index';   // Mặc định action là index
}

$controllerName = isset($url[0]) && $url[0] != '' ? ucfirst($url[0]) . 'Controller' : 'ProductController';

if (!file_exists(__DIR__ . '/controllers/' . $controllerName . '.php')) {
    die("Controller not found: $controllerName");
}

require_once __DIR__ . '/controllers/' . $controllerName . '.php';
$controller = new $controllerName();

$action = isset($url[1]) && $url[1] != '' ? $url[1] : 'index';

if (!method_exists($controller, $action)) {
    die("Action not found: $action");
}

call_user_func_array([$controller, $action], array_slice($url, 2));