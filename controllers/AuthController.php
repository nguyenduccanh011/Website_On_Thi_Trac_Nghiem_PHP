<?php
class AuthController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // ...code for handling authentication...

    public function register($username, $email, $password, $name, $position) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO users (username, email, password, name, position) VALUES (?, ?, ?, ?, ?)");
        if ($stmt === false) {
            return "Lỗi: " . $this->conn->error;
        }
        $stmt->bind_param("sssss", $username, $email, $hashed_password, $name, $position);
        if ($stmt->execute()) {
            return "Đăng ký thành công!";
        } else {
            return "Lỗi: " . $stmt->error;
        }
    }
}
?>
