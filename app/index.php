<?php
session_start();

require_once __DIR__ . '/models/ProductModel.php';
require_once __DIR__ . '/helpers/SessionHelper.php';

// Product/add
$url = $_GET['url'] ?? '';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);

// Determine the controller from the first part of the URL
$controllerName = isset($url[0]) && $url[0] != '' ? ucfirst($url[0]) . 'Controller' : 'ProductController';

// Determine the action from the second part of the URL
$action = isset($url[1]) && $url[1] != '' ? $url[1] : 'index';

// Redirect 'list' action to 'listAdmin' in ProductController
if ($controllerName === 'ProductController' && $action === 'list') {
    $action = 'listAdmin';
}

// Check if the controller file exists
if (!file_exists(__DIR__ . '/controllers/' . $controllerName . '.php')) {
    // Handle controller not found
    die('Controller not found');
}

require_once __DIR__ . '/controllers/' . $controllerName . '.php';
$controller = new $controllerName();

// Check if the action method exists in the controller
if (!method_exists($controller, $action)) {
    // Handle action not found
    die('Action not found');
}

// Call the action with the remaining parameters (if any)
call_user_func_array([$controller, $action], array_slice($url, 2));