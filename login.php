<?php
session_start();

// Xử lý đăng xuất
if (isset($_GET['logout'])) {
    setcookie("username", "", time() - 3600, "/"); // Xóa cookie
    setcookie("password", "", time() - 3600, "/");
    session_destroy(); // Hủy phiên
    header("Location: index.php");
    exit();
}

// Xử lý đăng nhập
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);
    
    // Kiểm tra đăng nhập (ở đây dùng tài khoản mẫu)
    if ($username === "admin" && $password === "123456") {
        $_SESSION['user'] = $username;
        
        if ($remember) {
            // Nếu chọn "Ghi nhớ đăng nhập", lưu cookie
            setcookie("username", $username, time() + (86400 * 30), "/"); // 30 ngày
            setcookie("password", $password, time() + (86400 * 30), "/");
        } else {
            // Nếu không chọn, xóa cookie (nếu có từ trước)
            setcookie("username", "", time() - 3600, "/");
            setcookie("password", "", time() - 3600, "/");
        }
        
        header("Location: index.php");
        exit();
    } else {
        $error = "Tên đăng nhập hoặc mật khẩu không đúng!";
    }
}

// Kiểm tra trạng thái đăng nhập
if (isset($_COOKIE['username']) && !isset($_SESSION['user'])) {
    // Nếu có cookie mà không có session, tự động đăng nhập lại
    if ($_COOKIE['username'] === "admin" && $_COOKIE['password'] === "123456") {
        $_SESSION['user'] = $_COOKIE['username'];
    }
}

// Nếu đã đăng nhập qua session, hiển thị thông tin
if (isset($_SESSION['user'])) {
    echo "<p>Chào, " . $_SESSION['user'] . "</p>";
    echo "<a href='?logout=true'>Đăng xuất</a>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
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
        .login-container {
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
        p[style*="color:red"] {
            color: #ff6b6b !important;
            text-align: center;
            margin-bottom: 20px;
            font-size: 0.9em;
            background: rgba(255, 75, 75, 0.1);
            padding: 10px;
            border-radius: 8px;
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
        form input[type="password"]:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        /* Checkbox */
        form label input[type="checkbox"] {
            margin-right: 8px;
            accent-color: #00ddeb;
        }

        /* Nút đăng nhập */
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
            .login-container {
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
    <div class="login-container">
        <h2>Đăng nhập</h2>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="post">
            <label>Tên đăng nhập:</label>
            <input type="text" name="username" value="<?php echo $_COOKIE['username'] ?? ''; ?>" required>
            
            <label>Mật khẩu:</label>
            <input type="password" name="password" value="<?php echo $_COOKIE['password'] ?? ''; ?>" required>
            
            <label>
                <input type="checkbox" name="remember" <?php echo isset($_COOKIE['username']) ? 'checked' : ''; ?>> Ghi nhớ đăng nhập
            </label>
            
            <button type="submit">Đăng nhập</button>
        </form>
    </div>
</body>
</html>