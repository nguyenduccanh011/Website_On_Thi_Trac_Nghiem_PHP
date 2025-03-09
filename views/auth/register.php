<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <style>
        /* Reset mặc định */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            overflow: hidden;
        }

        /* Container cho form */
        .register-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
            animation: fadeIn 0.8s ease-in-out;
        }

        /* Hiệu ứng fade in */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            color: #fff;
            text-align: center;
            margin-bottom: 30px;
            font-size: 2em;
            letter-spacing: 1px;
            text-transform: uppercase;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        /* Thông báo lỗi */
        p[style*="color:red"], p[style*="color:green"] {
            text-align: center;
            margin-bottom: 20px;
            font-size: 0.9em;
            padding: 10px;
            border-radius: 8px;
        }

        p[style*="color:red"] {
            color: #ff6b6b !important;
            background: rgba(255, 75, 75, 0.1);
        }

        p[style*="color:green"] {
            color: #6bff6b !important;
            background: rgba(75, 255, 75, 0.1);
        }

        /* Label và input */
        form label {
            color: #fff;
            font-size: 0.95em;
            margin-bottom: 8px;
            display: block;
            font-weight: 500;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: none;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            font-size: 1em;
            transition: all 0.3s ease;
        }

        form input[type="text"]:focus,
        form input[type="email"]:focus,
        form input[type="password"]:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        /* Nút đăng ký */
        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(45deg, #00ddeb, #7b42ff);
            color: #fff;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 221, 235, 0.4);
        }

        button:active {
            transform: translateY(0);
        }

        /* Hiệu ứng nền động */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
            animation: pulse 15s infinite;
            z-index: -1;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 0.5;
            }
            50% {
                transform: scale(1.2);
                opacity: 0.2;
            }
            100% {
                transform: scale(1);
                opacity: 0.5;
            }
        }

        /* Responsive */
        @media (max-width: 480px) {
            .register-container {
                padding: 20px;
                margin: 20px;
            }
            h2 {
                font-size: 1.5em;
            }
        }
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
            $name = $_POST['name'] ?? null;
            $position = $_POST['position'] ?? null;

            if ($password === $confirm_password) {
                $message = $authController->register($username, $email, $password, $name, $position);
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
            
            <label>Tên:</label>
            <input type="text" name="name" required>
            
            <label>Chức vụ:</label>
            <input type="text" name="position" required>
            
            <button type="submit">Đăng ký</button>
        </form>
        <p>Đã có tài khoản? <a href="../../login.php">Đăng nhập</a></p>
    </div>
</body>
</html>
