<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa câu hỏi</title>
    <style>
        /* ...existing styles... */
    </style>
</head>
<body>
    <div class="question-container">
        <h2>Chỉnh sửa câu hỏi</h2>
        <?php
        require '../../config/db.php';
        require '../../models/Question.php';
        require '../../controllers/QuestionController.php';

        $questionController = new QuestionController($conn);
        $id = $_GET['id'];
        $result = $conn->query("SELECT * FROM questions WHERE id = $id");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $question = new Question($row['id'], $row['exam_id'], $row['content'], $row['options'], $row['correct_option']);
        ?>
        <form method="post" action="update.php">
            <input type="hidden" name="id" value="<?php echo $question->id; ?>">
            <label for="content">Nội dung câu hỏi:</label>
            <textarea id="content" name="content" required><?php echo htmlspecialchars($question->content); ?></textarea>
            
            <label for="options">Các lựa chọn (ngăn cách bằng dấu phẩy):</label>
            <textarea id="options" name="options" required><?php echo htmlspecialchars($question->options); ?></textarea>
            
            <label for="correct_option">Lựa chọn đúng:</label>
            <input type="text" id="correct_option" name="correct_option" value="<?php echo htmlspecialchars($question->correct_option); ?>" required>
            
            <button type="submit">Cập nhật câu hỏi</button>
        </form>
        <?php
        } else {
            echo "<p>Câu hỏi không tồn tại.</p>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
