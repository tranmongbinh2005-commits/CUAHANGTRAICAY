<?php
require_once('app/config/database.php');
require_once('app/models/ProductModel.php');
require_once('app/models/categoryModel.php');
require_once('app/utils/JWTHandler.php');

class ProductApiController
{
    private $productModel;
    private $db;
    private $jwtHandler;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
        $this->jwtHandler = new JWTHandler();
    }

    // Hàm xác thực token JWT khi truy cập API
    private function authenticate()
    {
        // 1. Lấy tất cả thông tin Headers mà HTTP request gửi lên
        $headers = apache_request_headers();
        
        // 2. Kiểm tra xem Client có gửi header 'Authorization' (chứa Token) không
        if (isset($headers['Authorization'])) {
            $authHeader = $headers['Authorization'];
            // Token JWT thường có cấu trúc: "Bearer <Chuỗi_Token_Dài>"
            // Ta dùng khoảng trắng để tách lấy chuỗi Token phía sau chữ Bearer
            $arr = explode(" ", $authHeader);
            $jwt = $arr[1] ?? null; 
            
            if ($jwt) {
                // 3. Giải mã Token. 
                // Hàm decode sẽ tự động kiểm tra xem Token có hợp lệ, có bị sửa đổi hoặc hết hạn không.
                $decoded = $this->jwtHandler->decode($jwt);
                // Nếu giải mã thành công (trả về dữ liệu), tức là xác thực thành công (true)
                return $decoded ? true : false;
            }
        }
        // Nếu thiếu token hoặc token sai -> false
        return false;
    }

    // Lấy danh sách sản phẩm (Bảo vệ bằng JWT)
    public function index()
    {
        // Gọi hàm kiểm tra xác thực JWT ở trên
        if ($this->authenticate()) {
            // --> ĐÃ CÓ TOKEN HỢP LỆ <--
            // Trả về danh sách sản phẩm theo định dạng JSON
            header('Content-Type: application/json');
            $products = $this->productModel->getProducts();
            echo json_encode($products);
        } else {
            // --> KHÔNG CÓ HOẶC TOKEN SAI <--
            // Chặn truy cập, báo lỗi HTTP 401 Unauthorized để Postman/Web biết là chưa đăng nhập
            http_response_code(401);
            echo json_encode(['message' => 'Unauthorized']);
        }
    }

    // Lấy thông tin sản phẩm theo ID
    public function show($id)
    {
        header('Content-Type: application/json');
        $product = $this->productModel->getProductById($id);
        if ($product) {
            echo json_encode($product);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Product not found']);
        }
    }

    // Thêm sản phẩm mới
    public function store()
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents("php://input"), true);
        $name = $data['name'] ?? '';
        $description = $data['description'] ?? '';
        $price = $data['price'] ?? '';
        $category_id = $data['category_id'] ?? null;
        $image = $data['image'] ?? 'default.png'; // Default image since API payload might not have it

        $result = $this->productModel->addProduct($name, $description, $price, $category_id, $image);

        if (is_array($result)) {
            http_response_code(400);
            echo json_encode(['errors' => $result]);
        } else {
            http_response_code(201);
            echo json_encode(['message' => 'Product created successfully']);
        }
    }

    // Cập nhật sản phẩm theo ID
    public function update($id)
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents("php://input"), true);
        $name = $data['name'] ?? '';
        $description = $data['description'] ?? '';
        $price = $data['price'] ?? '';
        $category_id = $data['category_id'] ?? null;
        $image = $data['image'] ?? 'default.png';

        $result = $this->productModel->updateProduct($id, $name, $description, $price, $category_id, $image);

        if ($result) {
            echo json_encode(['message' => 'Product updated successfully']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Product update failed']);
        }
    }

    // Xóa sản phẩm theo ID
    public function destroy($id)
    {
        header('Content-Type: application/json');
        $result = $this->productModel->deleteProduct($id);
        if ($result) {
            echo json_encode(['message' => 'Product deleted successfully']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Product deletion failed']);
        }
    }
}
?>
