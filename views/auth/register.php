<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <style>
        /* ...existing styles... */
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Đăng ký</h2>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            require '../../config/db.php';
            require '../../controllers/AuthController.php';

            $authController = new AuthController($conn);
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if ($password === $confirm_password) {
                $message = $authController->register($username, $email, $password);
                echo "<p style='color:green;'>$message</p>";
            } else {
                echo "<p style='color:red;'>Mật khẩu không khớp!</p>";
            }

            $conn->close();
        }
        ?>
        <form method="post">
            <label>Tên đăng nhập:</label>
            <input type="text" name="username" required>
            
            <label>Email:</label>
            <input type="email" name="email" required>
            
            <label>Mật khẩu:</label>
            <input type="password" name="password" required>
            
            <label>Xác nhận mật khẩu:</label>
            <input type="password" name="confirm_password" required>
            
            <button type="submit">Đăng ký</button>
        </form>
        <p>Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
    </div>
</body>
</html>
