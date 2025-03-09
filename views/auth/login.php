<?php
session_start();
require '../../config/db.php'; // Kết nối cơ sở dữ liệu

// Specify the error log file location
ini_set('error_log', 'c:/xampp/htdocs/Web_on_thi_trac_phiem_php/php_errors.log');

// Xử lý đăng xuất
if (isset($_GET['logout'])) {
    setcookie("username", "", time() - 3600, "/"); // Xóa cookie
    setcookie("password", "", time() - 3600, "/");
    session_destroy(); // Hủy phiên
    header("Location: login.php");
    exit();
}

// Xử lý đăng nhập
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);
    
    // Kiểm tra tên đăng nhập từ cơ sở dữ liệu
    $stmt = $conn->prepare("SELECT id, password, name, position FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password, $name, $position);
        $stmt->fetch();
        
        // Log the hashed password and plain text password
        error_log("Hashed password from DB: " . $hashed_password);
        error_log("Plain text password entered: " . $password);
        
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user'] = $username;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['name'] = $name;
            $_SESSION['position'] = $position;
            
            if ($remember) {
                // Nếu chọn "Ghi nhớ đăng nhập", lưu cookie
                setcookie("username", $username, time() + (86400 * 30), "/"); // 30 ngày
                setcookie("password", $password, time() + (86400 * 30), "/");
            } else {
                // Nếu không chọn, xóa cookie (nếu có từ trước)
                setcookie("username", "", time() - 3600, "/");
                setcookie("password", "", time() - 3600, "/");
            }
            
            // Log successful login
            error_log("Login successful for user: " . $username);
            
            header("Location: ../../index.php");
            exit();
        } else {
            // Log the password verification failure
            error_log("Password verification failed for user: " . $username);
            error_log("password_verify result: " . (password_verify($password, $hashed_password) ? 'true' : 'false'));
            $error = "Mật khẩu không đúng!";
        }
    } else {
        $error = "Tên đăng nhập không tồn tại!";
    }
    $stmt->close();
}

// Kiểm tra trạng thái đăng nhập
if (isset($_COOKIE['username']) && !isset($_SESSION['user'])) {
    // Nếu có cookie mà không có session, tự động đăng nhập lại
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
    
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();
        
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user'] = $username;
            $_SESSION['user_id'] = $user_id;
        }
    }
    $stmt->close();
}

// Nếu đã đăng nhập qua session, hiển thị thông tin
if (isset($_SESSION['user'])) {
    echo "<p>Chào, " . htmlspecialchars($_SESSION['name']) . " (" . htmlspecialchars($_SESSION['position']) . ")</p>";
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
            
            <label>Tên:</label>
            <input type="text" name="name" value="<?php echo $_COOKIE['name'] ?? ''; ?>" required>
            
            <label>Chức vụ:</label>
            <input type="text" name="position" value="<?php echo $_COOKIE['position'] ?? ''; ?>" required>
            
            <label>
                <input type="checkbox" name="remember" <?php echo isset($_COOKIE['username']) ? 'checked' : ''; ?>> Ghi nhớ đăng nhập
            </label>
            
            <button type="submit">Đăng nhập</button>
        </form>
    </div>
</body>
</html>