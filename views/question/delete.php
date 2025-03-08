<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa câu hỏi</title>
    <style>
        /* ...existing styles... */
    </style>
</head>
<body>
    <div class="question-container">
        <h2>Xóa câu hỏi</h2>
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
        <p>Bạn có chắc chắn muốn xóa câu hỏi "<?php echo htmlspecialchars($question->content); ?>"?</p>
        <form method="post" action="destroy.php">
            <input type="hidden" name="id" value="<?php echo $question->id; ?>">
            <button type="submit">Xóa</button>
            <a href="index.php">Hủy</a>
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
