<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo câu hỏi mới</title>
    <style>
        /* ...existing styles... */
    </style>
</head>
<body>
    <div class="question-container">
        <h2>Tạo câu hỏi mới</h2>
        <form method="post" action="store.php">
            <label for="exam_id">ID Đề thi:</label>
            <input type="text" id="exam_id" name="exam_id" required>
            
            <label for="content">Nội dung câu hỏi:</label>
            <textarea id="content" name="content" required></textarea>
            
            <label for="options">Các lựa chọn (ngăn cách bằng dấu phẩy):</label>
            <textarea id="options" name="options" required></textarea>
            
            <label for="correct_option">Lựa chọn đúng:</label>
            <input type="text" id="correct_option" name="correct_option" required>
            
            <button type="submit">Tạo câu hỏi</button>
        </form>
    </div>
</body>
</html>
