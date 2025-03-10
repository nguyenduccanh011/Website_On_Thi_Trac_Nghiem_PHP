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
    <title>QLTSGeek - Trang ôn thi trắc nghiệm</title>
    <link rel="stylesheet" href="template/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <?php include 'template/header.php'; ?>
        <?php include 'template/sidebar.php'; ?>

        <main class="content">
            <section>
                <h2 class="section-title">Welcome</h2>
                <p>Chào mừng, <?php echo htmlspecialchars($username); ?>!</p>
                <a href="login.php?logout=true">Đăng xuất</a>
            </section>
        </main>
    </div>
</body>
</html>