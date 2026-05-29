<?php
session_start();

// Tự động tính toán thư mục gốc (Base Path) của ứng dụng
$scriptName = $_SERVER['SCRIPT_NAME'] ?? '/index.php';
$baseDir = dirname($scriptName);
$basePath = ($baseDir === '/' || $baseDir === '\\') ? '/' : rtrim($baseDir, '/\\') . '/';
define('BASE_URL', $basePath);

require_once 'app/controllers/ProductController.php';
require_once 'app/controllers/categoryController.php';
require_once 'app/controllers/DefaultController.php';

$url = isset($_GET['url']) ? trim($_GET['url'], '/') : '';
$segments = $url === '' ? [] : explode('/', $url);

if (empty($segments)) {
    include 'app/views/home.php';
    return;
}

$controller = strtolower($segments[0]);
$action = isset($segments[1]) ? strtolower($segments[1]) : 'index';
$id = $segments[2] ?? null;

switch ($controller) {
    case 'product':
        $productController = new ProductController();
        if ($action === 'add') {
            $productController->add();
        } elseif ($action === 'save') {
            $productController->save();
        } elseif ($action === 'edit' && $id !== null) {
            $productController->edit($id);
        } elseif ($action === 'update') {
            $productController->update();
        } elseif ($action === 'delete' && $id !== null) {
            $productController->delete($id);
        } elseif ($action === 'show' && $id !== null) {
            $productController->show($id);
        } elseif ($action === 'addtocart' && $id !== null) {
            $productController->addToCart($id);
        } elseif ($action === 'cart') {
            $productController->cart();
        } elseif ($action === 'updatecart') {
            $productController->updateCart();
        } elseif ($action === 'removefromcart' && $id !== null) {
            $productController->removeFromCart($id);
        } elseif ($action === 'checkout') {
            $productController->checkout();
        } elseif ($action === 'processcheckout') {
            $productController->processCheckout();
        } elseif ($action === 'list') {
            $productController->list();
        } else {
            $productController->index();
        }
        break;

    case 'category':
        $categoryController = new CategoryController();
        if ($action === 'list' || $action === 'index') {
            $categoryController->list();
        } else {
            echo 'Route chưa hỗ trợ cho Category.';
        }
        break;

    default:
        echo '404 Not Found';
        break;
}
