<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo đề thi mới</title>
    <style>
        /* ...existing styles... */
    </style>
</head>
<body>
    <div class="exam-container">
        <h2>Tạo đề thi mới</h2>
        <form method="post" action="store.php">
            <label for="title">Tiêu đề:</label>
            <input type="text" id="title" name="title" required>
            
            <label for="description">Mô tả:</label>
            <textarea id="description" name="description" required></textarea>
            
            <button type="submit">Tạo đề thi</button>
        </form>
    </div>
</body>
</html>
