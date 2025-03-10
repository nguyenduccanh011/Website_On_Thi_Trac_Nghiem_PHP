<?php
session_start(); // Ensure session is started
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân</title>
    <link rel="stylesheet" href="/Web_on_thi_trac_phiem_php/template/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <?php include '../../template/header.php'; ?>
        <?php include '../../template/sidebar.php'; ?>

        <main class="content">
            <section>
                <h2 class="section-title">Thông tin cá nhân</h2>
                <?php
                require '../../config/db.php';
                require '../../controllers/UserController.php';

                $username = $_SESSION['user'];
                $userController = new UserController($conn);
                $userInfo = $userController->getUserInfo($username);

                if ($userInfo) {
                    echo "<p>Tên đăng nhập: " . htmlspecialchars($userInfo['username']) . "</p>";
                    echo "<p>Email: " . htmlspecialchars($userInfo['email']) . "</p>";
                    echo "<p>Tên: " . htmlspecialchars($userInfo['name']) . "</p>";
                    echo "<p>Chức vụ: " . htmlspecialchars($userInfo['position']) . "</p>";
                } else {
                    echo "<p>Không tìm thấy thông tin người dùng.</p>";
                }

                $conn->close();
                ?>
                <a href="../../login.php?logout=true">Đăng xuất</a>
            </section>
        </main>
    </div>
</body>
</html>
