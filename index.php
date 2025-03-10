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
        <header class="top-nav">
            <div class="logo">
                <a href="/">QLTSGeek</a>
            </div>

            <div class="search-bar">
                <i class="fas fa-search"></i> <input type="text" placeholder="Tìm kiếm bài kiểm tra, chủ đề...">
            </div>

            <div class="user-info">
                <img src="https://photo.znews.vn/w1200/Uploaded/mdf_eioxrd/2021_07_06/1q.jpg" alt="Avatar" class="avatar">
                <div class="user-details">
                    <span><?php echo htmlspecialchars($username); ?></span>
                    <span class="role">Student</span>
                </div>
                <div class="user-dropdown">
                    <a href="views/user/profile.php"><i class="fas fa-user"></i> Hồ sơ</a>
                    <a href="#"><i class="fas fa-cog"></i> Cài đặt</a>
                    <a href="login.php?logout=true"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                </div>
            </div>
        </header>

        <aside class="sidebar">
            <nav>
                <ul>
                    <li><a href="index.php"><i class="fas fa-tachometer-alt"></i> Trang chủ</a></li>
                    <li><a href="views/exam/index.php"><i class="fas fa-book"></i> Danh sách đề thi</a></li>
                    <li><a href="views/exam/create.php"><i class="fas fa-stethoscope"></i> Tạo đề thi mới</a></li>
                    <li><a href="views/user/profile.php"><i class="fas fa-user"></i> Thông tin cá nhân</a></li>
                    <li><a href="views/user/update_password.php"><i class="fas fa-key"></i> Cập nhật mật khẩu</a></li>
                    <li><a href="login.php?logout=true"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a></li>
                </ul>
            </nav>
        </aside>

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