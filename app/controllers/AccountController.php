<?php
require_once('app/config/database.php');
require_once('app/models/AccountModel.php');

class AccountController {
    private $accountModel;
    private $db;

    public function __construct() {
        $this->db           = (new Database())->getConnection();
        $this->accountModel = new AccountModel($this->db);
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

    public function checklogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password']      ?? '';

            $account = $this->accountModel->getAccountByUsername($username);
            if ($account && password_verify($password, $account->password)) {
                SessionHelper::start();
                if (!isset($_SESSION['username'])) {
                    $_SESSION['username'] = $account->username;
                    $_SESSION['role']     = $account->role;
                    $_SESSION['user_id']  = $account->id;
                }
                header('Location: ' . BASE_URL . 'Product');
                exit;
            } else {
                $error = $account ? "Mật khẩu không đúng!" : "Không tìm thấy tài khoản này!";
                include_once 'app/views/account/login.php';
                exit;
            }
        }
    }
}
?>
