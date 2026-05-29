<?php
// Require SessionHelper and other necessary files
require_once('app/config/database.php');
require_once('app/models/ProductModel.php');
require_once('app/models/CategoryModel.php');

class ProductController 
{
    private $productModel;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }

    public function index() {
        $products = $this->productModel->getProducts();
        $categories = (new CategoryModel($this->db))->getCategories();
        include 'app/views/product/list.php';
    }

    public function show($id) {
        $product = $this->productModel->getProductById($id);
        if ($product) {
            include 'app/views/product/show.php';
        } else {
            echo "Không thấy sản phẩm.";
        }
    }

    public function add() {
        $categories = (new CategoryModel($this->db))->getCategories();
        include_once 'app/views/product/add.php';
    }

    public function save() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? '';
            $category_id = $_POST['category_id'] ?? null;
            $errors = [];

            $image = "";
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                try {
                    $image = $this->uploadImage($_FILES['image']);
                } catch (Exception $e) {
                    $errors['image'] = $e->getMessage();
                }
            }

            if (empty($errors)) {
                $result = $this->productModel->addProduct($name, $description, $price, $category_id, $image);
                if (is_array($result)) {
                    $errors = array_merge($errors, $result);
                } else if ($result) {
                    header('Location: ' . BASE_URL . 'Product');
                    return;
                } else {
                    $errors['db'] = "Đã xảy ra lỗi khi lưu sản phẩm vào cơ sở dữ liệu.";
                }
            }

            // If we have errors, reload categories and include add product page
            $categories = (new CategoryModel($this->db))->getCategories();
            include 'app/views/product/add.php';
        }
    }

    public function edit($id) {
        $product = $this->productModel->getProductById($id);
        $categories = (new CategoryModel($this->db))->getCategories();

        if ($product) {
            include 'app/views/product/edit.php';
        } else {
            echo "Không thấy sản phẩm.";
        }
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category_id = $_POST['category_id'];
            $existing_image = $_POST['existing_image'];
            $errors = [];

            $image = $existing_image;
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                try {
                    $image = $this->uploadImage($_FILES['image']);
                } catch (Exception $e) {
                    $errors['image'] = $e->getMessage();
                }
            }

            if (empty($errors)) {
                $edit = $this->productModel->updateProduct($id, $name, $description, $price, $category_id, $image);
                if ($edit) {
                    header('Location: ' . BASE_URL . 'Product');
                    return;
                } else {
                    $errors['db'] = "Đã xảy ra lỗi khi cập nhật sản phẩm.";
                }
            }

            // If we have errors, reload product & categories and load edit page again
            $product = $this->productModel->getProductById($id);
            $categories = (new CategoryModel($this->db))->getCategories();
            include 'app/views/product/edit.php';
        }
    }

    public function delete($id) {
        if ($this->productModel->deleteProduct($id)) {
            header('Location: ' . BASE_URL . 'Product');
        } else {
            echo "Đã xảy ra lỗi khi xóa sản phẩm.";
        }
    }

    private function uploadImage($file) {
        $target_dir = "uploads/";

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $target_file = $target_dir . basename($file["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($file["tmp_name"]);
        if ($check === false) {
            throw new Exception("File không phải là hình ảnh.");
        }

        if ($file["size"] > 10 * 1024 * 1024) {
            throw new Exception("Hình ảnh có kích thước quá lớn.");
        }

        if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
            throw new Exception("Chỉ cho phép các định dạng JPG, JPEG, PNG và GIF.");
        }

        if (!move_uploaded_file($file["tmp_name"], $target_file)) {
            throw new Exception("Có lỗi xảy ra khi tải lên hình ảnh.");
        }

        return $target_file;
    }

    public function addToCart($id) {
        $product = $this->productModel->getProductById($id);
        if (!$product) {
            echo "Không tìm thấy sản phẩm.";
            return;
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity']++;
        } else {
            $_SESSION['cart'][$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image
            ];
        }

        header('Location: ' . BASE_URL . 'Product/cart');
    }

    // Hiển thị giỏ hàng
    public function cart() {
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        include 'app/views/product/cart.php';
    }

    // Cập nhật số lượng sản phẩm trong giỏ hàng
    public function updateCart() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantities'])) {
            foreach ($_POST['quantities'] as $id => $quantity) {
                $quantity = intval($quantity);
                if ($quantity <= 0) {
                    unset($_SESSION['cart'][$id]);
                } else if (isset($_SESSION['cart'][$id])) {
                    $_SESSION['cart'][$id]['quantity'] = $quantity;
                }
            }
        }
        header('Location: ' . BASE_URL . 'Product/cart');
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart($id) {
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
        header('Location: ' . BASE_URL . 'Product/cart');
    }

    // Hiển thị trang đặt hàng / thanh toán
    public function checkout() {
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        if (empty($cart)) {
            header('Location: ' . BASE_URL . 'Product/cart');
            return;
        }
        include 'app/views/product/checkout.php';
    }

    // Xử lý tạo đơn đặt hàng
    public function processCheckout() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customer_name = $_POST['customer_name'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $address = $_POST['address'] ?? '';
            $payment_method = $_POST['payment_method'] ?? 'cod';
            $notes = $_POST['notes'] ?? '';
            $errors = [];

            if (empty($customer_name)) {
                $errors['customer_name'] = "Họ và tên không được để trống.";
            }
            if (empty($phone)) {
                $errors['phone'] = "Số điện thoại không được để trống.";
            }
            if (empty($address)) {
                $errors['address'] = "Địa chỉ nhận hàng không được để trống.";
            }

            $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
            if (empty($cart)) {
                header('Location: ' . BASE_URL . 'Product/cart');
                return;
            }

            if (empty($errors)) {
                require_once 'app/models/OrderModel.php';
                $orderModel = new OrderModel($this->db);
                
                $total_price = 0;
                foreach ($cart as $item) {
                    $total_price += $item['price'] * $item['quantity'];
                }

                $order_id = $orderModel->createOrder($customer_name, $email, $phone, $address, $payment_method, $notes, $total_price, $cart);

                if ($order_id) {
                    // Xóa giỏ hàng sau khi đặt thành công
                    unset($_SESSION['cart']);
                    
                    // Lưu hóa đơn tạm thời vào session để hiển thị ở trang thành công
                    $_SESSION['order_success'] = [
                        'order_id' => $order_id,
                        'customer_name' => $customer_name,
                        'phone' => $phone,
                        'address' => $address,
                        'total_price' => $total_price,
                        'payment_method' => $payment_method
                    ];
                    
                    include 'app/views/product/success.php';
                    return;
                } else {
                    $errors['db'] = "Đã xảy ra lỗi trong quá trình lưu đơn hàng. Vui lòng thử lại.";
                }
            }

            // Nếu có lỗi thì load lại trang checkout kèm theo mảng lỗi
            include 'app/views/product/checkout.php';
        }
    }

    public function list() {
        $products = $this->productModel->getProducts();
        $categories = (new CategoryModel($this->db))->getCategories();
        require_once 'app/views/product/list.php';
    }
    public function home() {
    // Lấy danh sách sản phẩm để đếm số lượng truyền ra trang chủ
    $products = $this->productModel->getProducts();
    include dirname(__DIR__) . '/views/product/index.php';
}
}
?>