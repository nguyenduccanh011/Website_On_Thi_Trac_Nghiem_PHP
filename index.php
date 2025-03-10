<?php
session_start();
require 'config/db.php'; // Kết nối cơ sở dữ liệu

// Kiểm tra nếu người dùng đã đăng nhập
if (isset($_SESSION['user']) || isset($_COOKIE['username'])) {
    $username = $_SESSION['user'] ?? $_COOKIE['username'];
} else {
    header("Location: login.php"); // Chuyển hướng nếu chưa đăng nhập
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chính</title>
    <link rel="stylesheet" href="css/menu.css">
    <script src="js/menu.js" defer></script>
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
            background: linear-gradient(135deg, #2a5298 0%, #1e3c72 100%);
            overflow: hidden;
            position: relative;
        }

        /* Container chính */
        .main-container {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            padding: 50px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
            text-align: center;
            animation: slideUp 0.8s ease-out;
        }

        /* Hiệu ứng slide-up */
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            color: #fff;
            font-size: 2.2em;
            margin-bottom: 20px;
            letter-spacing: 1px;
            text-transform: uppercase;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        p {
            color: #e0e0e0;
            font-size: 1.1em;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        /* Nút đăng xuất */
        a {
            display: inline-block;
            padding: 12px 25px;
            background: linear-gradient(45deg, #ff6b6b, #ff8e8e);
            color: #fff;
            text-decoration: none;
            border-radius: 10px;
            font-size: 1em;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        a:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(255, 107, 107, 0.4);
            background: linear-gradient(45deg, #ff8e8e, #ff6b6b);
        }

        a:active {
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
            background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, rgba(255, 255, 255, 0) 70%);
            animation: pulse 12s infinite;
            z-index: -1;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 0.4;
            }
            50% {
                transform: scale(1.15);
                opacity: 0.2;
            }
            100% {
                transform: scale(1);
                opacity: 0.4;
            }
        }

        /* Responsive */
        @media (max-width: 480px) {
            .main-container {
                padding: 30px;
                margin: 20px;
            }
            h2 {
                font-size: 1.8em;
            }
            p {
                font-size: 1em;
            }
            a {
                padding: 10px 20px;
                font-size: 0.9em;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <ul class="navbar-menu">
            <li><a href="index.php">Trang chính</a></li>
            <li><a href="views/exam/index.php">Danh sách đề thi</a></li>
            <li><a href="views/exam/create.php">Tạo đề thi mới</a></li>
            <li><a href="views/user/profile.php">Thông tin cá nhân</a></li>
            <li><a href="views/user/update_password.php">Cập nhật mật khẩu</a></li>
            <li><a href="login.php?logout=true">Đăng xuất</a></li>
        </ul>
    </nav>
    <div class="main-container">
        <h2>Chào mừng, <?php echo htmlspecialchars($username); ?>!</h2>
        <p>Đây là trang chính của bạn.</p>
        <a href="login.php?logout=true">Đăng xuất</a>
        <br><br>
        <a href="views/exam/index.php">Danh sách đề thi</a>
        <br><br>
        <a href="views/exam/create.php">Tạo đề thi mới</a>
        <br><br>
        <a href="views/user/profile.php">Thông tin cá nhân</a>
        <br><br>
        <a href="views/user/update_password.php">Cập nhật mật khẩu</a>
    </div>
</body>
</html>