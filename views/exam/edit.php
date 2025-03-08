<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa đề thi</title>
    <style>
        /* ...existing styles... */
    </style>
</head>
<body>
    <div class="exam-container">
        <h2>Chỉnh sửa đề thi</h2>
        <?php
        require '../../config/db.php';
        require '../../models/Exam.php';
        require '../../controllers/ExamController.php';

        $examController = new ExamController($conn);
        $id = $_GET['id'];
        $result = $conn->query("SELECT * FROM exams WHERE id = $id");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $exam = new Exam($row['id'], $row['title'], $row['description']);
        ?>
        <form method="post" action="update.php">
            <input type="hidden" name="id" value="<?php echo $exam->id; ?>">
            <label for="title">Tiêu đề:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($exam->title); ?>" required>
            
            <label for="description">Mô tả:</label>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($exam->description); ?></textarea>
            
            <button type="submit">Cập nhật đề thi</button>
        </form>
        <?php
        } else {
            echo "<p>Đề thi không tồn tại.</p>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
