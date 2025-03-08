<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa đề thi</title>
    <style>
        /* ...existing styles... */
    </style>
</head>
<body>
    <div class="exam-container">
        <h2>Xóa đề thi</h2>
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
        <p>Bạn có chắc chắn muốn xóa đề thi "<?php echo htmlspecialchars($exam->title); ?>"?</p>
        <form method="post" action="destroy.php">
            <input type="hidden" name="id" value="<?php echo $exam->id; ?>">
            <button type="submit">Xóa</button>
            <a href="index.php">Hủy</a>
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
