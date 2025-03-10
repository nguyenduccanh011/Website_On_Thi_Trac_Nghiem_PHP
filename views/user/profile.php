<?php
session_start(); // Ensure session is started
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân</title>
    <link rel="stylesheet" href="../../template/style.css">
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
                    <span><?php echo htmlspecialchars($_SESSION['user']); ?></span>
                    <span class="role">Student</span>
                </div>
                <div class="user-dropdown">
                    <a href="profile.php"><i class="fas fa-user"></i> Hồ sơ</a>
                    <a href="#"><i class="fas fa-cog"></i> Cài đặt</a>
                    <a href="../../login.php?logout=true"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                </div>
            </div>
        </header>

        <aside class="sidebar">
            <nav>
                <ul>
                    <li><a href="../../index.php"><i class="fas fa-tachometer-alt"></i> Trang chủ</a></li>
                    <li><a href="../exam/index.php"><i class="fas fa-book"></i> Danh sách đề thi</a></li>
                    <li><a href="../exam/create.php"><i class="fas fa-stethoscope"></i> Tạo đề thi mới</a></li>
                    <li><a href="profile.php"><i class="fas fa-user"></i> Thông tin cá nhân</a></li>
                    <li><a href="update_password.php"><i class="fas fa-key"></i> Cập nhật mật khẩu</a></li>
                    <li><a href="../../login.php?logout=true"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a></li>
                </ul>
            </nav>
        </aside>

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
