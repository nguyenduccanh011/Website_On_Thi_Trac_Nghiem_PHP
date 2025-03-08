<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đề thi</title>
    <style>
        /* ...existing styles... */
    </style>
</head>
<body>
    <div class="exam-container">
        <h2>Danh sách đề thi</h2>
        <?php
        require '../../config/db.php';
        require '../../models/Exam.php';
        require '../../controllers/ExamController.php';

        $examController = new ExamController($conn);
        $result = $conn->query("SELECT * FROM exams");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $exam = new Exam($row['id'], $row['title'], $row['description']);
                echo "<div class='exam-item'>";
                echo "<h3>" . htmlspecialchars($exam->title) . "</h3>";
                echo "<p>" . htmlspecialchars($exam->description) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>Không có đề thi nào.</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
