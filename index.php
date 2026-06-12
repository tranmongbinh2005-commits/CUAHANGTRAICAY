<?php
session_start();

// Tự động tính toán thư mục gốc (Base Path) của ứng dụng
define('BASE_URL', '/CUAHANGTRAICAY/');

require_once 'app/helpers/SessionHelper.php';

$url = isset($_GET['url']) ? trim($_GET['url'], '/') : '';

if ($url === '') {
    include 'app/views/home.php';
    return;
}

$segments = explode('/', $url);

// Định tuyến các yêu cầu API
if (strtolower($segments[0] ?? '') === 'api' && isset($segments[1])) {
    $apiControllerName = ucfirst($segments[1]) . 'ApiController';
    if (file_exists('app/controllers/' . $apiControllerName . '.php')) {
        require_once 'app/controllers/' . $apiControllerName . '.php';
        $controller = new $apiControllerName();
        $method = $_SERVER['REQUEST_METHOD'];
        $id = $segments[2] ?? null;

        switch ($method) {
            case 'GET':
                $action = $id ? 'show' : 'index';
                break;
            case 'POST':
                $action = 'store';
                break;
            case 'PUT':
                if ($id) {
                    $action = 'update';
                }
                break;
            case 'DELETE':
                if ($id) {
                    $action = 'destroy';
                }
                break;
            default:
                http_response_code(405);
                echo json_encode(['message' => 'Method Not Allowed']);
                exit;
        }

        if (method_exists($controller, $action)) {
            if ($id) {
                call_user_func_array([$controller, $action], [$id]);
            } else {
                call_user_func_array([$controller, $action], []);
            }
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Action not found']);
        }
        exit;
    } else {
        http_response_code(404);
        echo json_encode(['message' => 'Controller not found']);
        exit;
    }
}

// Kiểm tra phần đầu tiên của URL để xác định controller
$controllerName = isset($segments[0]) && $segments[0] != '' ? ucfirst($segments[0]) . 'Controller' : 'DefaultController';
// Kiểm tra phần thứ hai của URL để xác định action
$action = isset($segments[1]) && $segments[1] != '' ? $segments[1] : 'index';

// Handle cases where filename does not match case exactly (like categoryController.php)
$controllerFile = 'app/controllers/' . $controllerName . '.php';
if (!file_exists($controllerFile)) {
    $lowerControllerFile = 'app/controllers/' . lcfirst($controllerName) . '.php';
    if (file_exists($lowerControllerFile)) {
        $controllerFile = $lowerControllerFile;
    } else {
        die('Controller not found: ' . htmlspecialchars($controllerName));
    }
}

require_once $controllerFile;
$controller = new $controllerName();

// Resolve action case-insensitively if needed
if (!method_exists($controller, $action)) {
    $methods = get_class_methods($controller);
    $found = false;
    foreach ($methods as $method) {
        if (strtolower($method) === strtolower($action)) {
            $action = $method;
            $found = true;
            break;
        }
    }
    if (!$found) {
        die('Action not found: ' . htmlspecialchars($action));
    }
}

// Gọi action với các tham số còn lại (nếu có)
call_user_func_array([$controller, $action], array_slice($segments, 2));
?>
