<header class="top-nav">
    <div class="logo">
        <a href="/Web_on_thi_trac_phiem_php/index.php">QLTSGeek</a>
    </div>

    <div class="search-bar">
        <i class="fas fa-search"></i> <input type="text" placeholder="Tìm kiếm bài kiểm tra, chủ đề...">
    </div>

    <div class="user-info">
        <img src="https://photo.znews.vn/w1200/Uploaded/mdf_eioxrd/2021_07_06/1q.jpg" alt="Avatar" class="avatar">
        <div class="user-details">
            <?php
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $username = $_SESSION['user'] ?? 'Guest';
            ?>
            <span><?php echo htmlspecialchars($username); ?></span>
            <span class="role">Student</span>
        </div>
        <div class="user-dropdown">
            <a href="/Web_on_thi_trac_phiem_php/views/user/profile.php"><i class="fas fa-user"></i> Hồ sơ</a>
            <a href="#"><i class="fas fa-cog"></i> Cài đặt</a>
            <a href="/Web_on_thi_trac_phiem_php/login.php?logout=true"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
        </div>
    </div>
</header>
