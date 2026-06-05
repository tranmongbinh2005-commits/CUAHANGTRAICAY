<?php
class OrderModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
        $this->createTablesIfNotExist();
    }

    // Tự động tạo bảng nếu chưa tồn tại
    private function createTablesIfNotExist()
    {
        // Bảng orders
        $query1 = "CREATE TABLE IF NOT EXISTS `orders` (
            `id`             INT AUTO_INCREMENT PRIMARY KEY,
            `customer_name`  VARCHAR(255) NOT NULL,
            `email`          VARCHAR(255) NULL,
            `phone`          VARCHAR(50)  NOT NULL,
            `address`        TEXT         NOT NULL,
            `payment_method` VARCHAR(50)  DEFAULT 'cod',
            `notes`          TEXT         NULL,
            `total_price`    DECIMAL(15,2) NOT NULL,
            `created_at`     TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        // Bảng order_details – KHÔNG dùng FOREIGN KEY để tránh lỗi khi product bị xóa
        $query2 = "CREATE TABLE IF NOT EXISTS `order_details` (
            `id`           INT AUTO_INCREMENT PRIMARY KEY,
            `order_id`     INT NOT NULL,
            `product_id`   INT NOT NULL,
            `product_name` VARCHAR(255) NOT NULL DEFAULT '',
            `quantity`     INT          NOT NULL,
            `price`        DECIMAL(15,2) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        try {
            $this->conn->exec($query1);
            $this->conn->exec($query2);
        } catch (PDOException $e) {
            // Bỏ qua nếu bảng đã tồn tại
        }

        // Thêm cột product_name vào bảng cũ nếu chưa có
        try {
            $this->conn->exec(
                "ALTER TABLE `order_details` ADD COLUMN `product_name` VARCHAR(255) NOT NULL DEFAULT '';"
            );
        } catch (PDOException $e) {
            // Cột đã tồn tại – bỏ qua
        }
    }

    // Tạo đơn hàng mới và lưu chi tiết sản phẩm
    public function createOrder($customer_name, $email, $phone, $address, $payment_method, $notes, $total_price, $cart)
    {
        try {
            $this->conn->beginTransaction();

            $query = "INSERT INTO `orders`
                        (customer_name, email, phone, address, payment_method, notes, total_price)
                      VALUES
                        (:customer_name, :email, :phone, :address, :payment_method, :notes, :total_price)";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':customer_name',  $customer_name);
            $stmt->bindParam(':email',          $email);
            $stmt->bindParam(':phone',          $phone);
            $stmt->bindParam(':address',        $address);
            $stmt->bindParam(':payment_method', $payment_method);
            $stmt->bindParam(':notes',          $notes);
            $stmt->bindParam(':total_price',    $total_price);
            $stmt->execute();

            $order_id = $this->conn->lastInsertId();

            // Lưu từng sản phẩm trong giỏ
            $detailQuery = "INSERT INTO `order_details`
                                (order_id, product_id, product_name, quantity, price)
                            VALUES
                                (:order_id, :product_id, :product_name, :quantity, :price)";
            $detailStmt = $this->conn->prepare($detailQuery);

            foreach ($cart as $product_id => $item) {
                $detailStmt->bindValue(':order_id',     $order_id);
                $detailStmt->bindValue(':product_id',   $product_id);
                $detailStmt->bindValue(':product_name', $item['name'] ?? '');
                $detailStmt->bindValue(':quantity',     $item['quantity']);
                $detailStmt->bindValue(':price',        $item['price']);
                $detailStmt->execute();
            }

            $this->conn->commit();
            return $order_id;

        } catch (Exception $e) {
            $this->conn->rollBack();
            // Lưu lỗi vào session để debug nếu cần
            $_SESSION['order_error_debug'] = $e->getMessage();
            return false;
        }
    }
}
?>
