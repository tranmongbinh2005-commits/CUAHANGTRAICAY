<?php
class AccountModel {
    private $conn;
    private $table_name = "account";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAccountByUsername($username) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username LIMIT 0,1";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Đăng ký tài khoản mới với đầy đủ thông tin cá nhân.
     */
    public function save($username, $fullName, $password, $role = 'user', $email = '', $phone = '', $address = '') {
        if ($this->getAccountByUsername($username)) {
            return false;
        }

        $query = "INSERT INTO " . $this->table_name .
                 " SET username=:username, fullname=:fullname, password=:password, role=:role,
                       email=:email, phone=:phone, address=:address";
        $stmt = $this->conn->prepare($query);

        $username = htmlspecialchars(strip_tags($username));
        $fullName = htmlspecialchars(strip_tags($fullName));
        $password = password_hash($password, PASSWORD_BCRYPT);
        $role     = htmlspecialchars(strip_tags($role));
        $email    = htmlspecialchars(strip_tags($email));
        $phone    = htmlspecialchars(strip_tags($phone));
        $address  = htmlspecialchars(strip_tags($address));

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":fullname", $fullName);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":role",     $role);
        $stmt->bindParam(":email",    $email);
        $stmt->bindParam(":phone",    $phone);
        $stmt->bindParam(":address",  $address);

        return $stmt->execute();
    }
}
?>
