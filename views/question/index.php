<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách câu hỏi</title>
    <style>
        /* ...existing styles... */
    </style>
</head>
<body>
    <div class="question-container">
        <h2>Danh sách câu hỏi</h2>
        <?php
        require '../../config/db.php';
        require '../../models/Question.php';
        require '../../controllers/QuestionController.php';

        $questionController = new QuestionController($conn);
        $result = $conn->query("SELECT * FROM questions");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $question = new Question($row['id'], $row['exam_id'], $row['content'], $row['options'], $row['correct_option']);
                echo "<div class='question-item'>";
                echo "<h3>" . htmlspecialchars($question->content) . "</h3>";
                echo "<p>" . htmlspecialchars($question->options) . "</p>";
                echo "<p>Lựa chọn đúng: " . htmlspecialchars($question->correct_option) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>Không có câu hỏi nào.</p>";
        }

        $conn->close();
        ?>
        <a href="../../login.php?logout=true">Đăng xuất</a>
    </div>
</body>
</html>