<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân</title>
    <style>
        /* ...existing styles... */
    </style>
</head>
<body>
    <div class="profile-container">
        <h2>Thông tin cá nhân</h2>
        <?php
        require '../../config/db.php';
        require '../../controllers/UserController.php';

        session_start();
        $username = $_SESSION['user'];
        $userController = new UserController($conn);
        $userInfo = $userController->getUserInfo($username);

        if ($userInfo) {
            echo "<p>Tên đăng nhập: " . htmlspecialchars($userInfo['username']) . "</p>";
            echo "<p>Email: " . htmlspecialchars($userInfo['email']) . "</p>";
        } else {
            echo "<p>Không tìm thấy thông tin người dùng.</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
