<?php
require_once('app/config/database.php');
require_once('app/models/AccountModel.php');
require_once('app/utils/JWTHandler.php');

class AccountController {
    private $accountModel;
    private $db;
    private $jwtHandler;

    public function __construct() {
        $this->db           = (new Database())->getConnection();
        $this->accountModel = new AccountModel($this->db);
        $this->jwtHandler   = new JWTHandler();
    }

    public function index() {
        $this->login();
    }

    public function register() {
        include_once 'app/views/account/register.php';
    }

    public function login() {
        include_once 'app/views/account/login.php';
    }

    public function save() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username        = trim($_POST['username']        ?? '');
            $fullName        = trim($_POST['fullname']        ?? '');
            $password        = $_POST['password']             ?? '';
            $confirmPassword = $_POST['confirmpassword']      ?? '';
            $email           = trim($_POST['email']           ?? '');
            $phone           = trim($_POST['phone']           ?? '');
            $address         = trim($_POST['address']         ?? '');
            $role            = 'user'; // Mặc định luôn là user

            $errors = [];
            if (empty($username))  $errors['username']    = "Vui lòng nhập tên tài khoản!";
            if (empty($fullName))  $errors['fullname']    = "Vui lòng nhập họ và tên!";
            if (empty($password))  $errors['password']    = "Vui lòng nhập mật khẩu!";
            if (strlen($password) < 6) $errors['passlen'] = "Mật khẩu phải có ít nhất 6 ký tự!";
            if ($password !== $confirmPassword) $errors['confirmPass'] = "Mật khẩu xác nhận chưa khớp!";
            if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Địa chỉ email không hợp lệ!";
            }

            if ($this->accountModel->getAccountByUsername($username)) {
                $errors['account'] = "Tên tài khoản này đã được sử dụng!";
            }

            if (count($errors) > 0) {
                include_once 'app/views/account/register.php';
            } else {
                $result = $this->accountModel->save($username, $fullName, $password, $role, $email, $phone, $address);
                if ($result) {
                    header('Location: ' . BASE_URL . 'account/login');
                    exit;
                } else {
                    $errors['db'] = "Có lỗi xảy ra khi lưu tài khoản, vui lòng thử lại.";
                    include_once 'app/views/account/register.php';
                }
            }
        }
    }

    public function logout() {
        SessionHelper::start();
        unset($_SESSION['username']);
        unset($_SESSION['role']);
        header('Location: ' . BASE_URL . 'Product');
        exit;
    }

    public function checkLogin()
    {
        // 1. Khai báo header báo cho trình duyệt biết dữ liệu trả về sẽ ở định dạng JSON
        header('Content-Type: application/json');
        
        // 2. Lấy dữ liệu (username, password) mà client (JS fetch) gửi lên dưới dạng chuỗi JSON thô
        $data = json_decode(file_get_contents("php://input"), true);
        $username = $data['username'] ?? '';
        $password = $data['password'] ?? '';
        
        // 3. Tìm tài khoản trong Database bằng username
        $user = $this->accountModel->getAccountByUserName($username);
        
        // 4. Kiểm tra user có tồn tại và mật khẩu người dùng nhập có khớp với mã Hash trong Database không
        if ($user && password_verify($password, $user->password)) {
            // ---> ĐĂNG NHẬP THÀNH CÔNG <---

            // Bước A: Cấp mã JWT Token chứa thông tin (id, username, role) cho Client
            $token = $this->jwtHandler->encode([
                'id' => $user->id, 
                'username' => $user->username,
                'role' => $user->role
            ]);
            
            // Bước B: Cập nhật Session PHP ở phía Server (Mô hình Hybrid)
            // Việc này rất quan trọng để hàm SessionHelper::isAdmin() có thể hoạt động, 
            // giúp các nút quản trị như "Thêm mới" hiển thị đúng cho Admin.
            SessionHelper::start();
            $_SESSION['username'] = $user->username;
            $_SESSION['role']     = $user->role;
            $_SESSION['user_id']  = $user->id;

            // Trả Token về cho Client (Javascript) để nó lưu vào localStorage
            echo json_encode(['token' => $token]);
        } else {
            // ---> ĐĂNG NHẬP THẤT BẠI <---
            // Trả về mã lỗi HTTP 401 Unauthorized (Không có quyền)
            http_response_code(401);
            echo json_encode(['message' => 'Invalid credentials']);
        }
    }
}
?>
