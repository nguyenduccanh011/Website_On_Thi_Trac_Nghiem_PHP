<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đề thi</title>
    <style>
        /* Reset mặc định */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #2a5298 0%, #1e3c72 100%);
            overflow: hidden;
            position: relative;
        }

        /* Container chính */
        .exam-container {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            padding: 50px;
            width: 100%;
            max-width: 600px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
            text-align: center;
            animation: slideUp 0.8s ease-out;
        }

        /* Hiệu ứng slide-up */
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            color: #fff;
            font-size: 2.2em;
            margin-bottom: 20px;
            letter-spacing: 1px;
            text-transform: uppercase;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        h3 {
            color: #fff;
            font-size: 1.8em;
            margin-bottom: 10px;
        }

        p {
            color: #e0e0e0;
            font-size: 1em;
            margin-bottom: 20px;
        }

        .question-item {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .question-item h4 {
            color: #fff;
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .question-item p {
            color: #e0e0e0;
            font-size: 1em;
            margin-bottom: 10px;
        }

        /* Nút quay lại */
        a {
            display: inline-block;
            padding: 12px 25px;
            background: linear-gradient(45deg, #ff6b6b, #ff8e8e);
            color: #fff;
            text-decoration: none;
            border-radius: 10px;
            font-size: 1em;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        a:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(255, 107, 107, 0.4);
            background: linear-gradient(45deg, #ff8e8e, #ff6b6b);
        }

        a:active {
            transform: translateY(0);
        }

        /* Hiệu ứng nền động */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, rgba(255, 255, 255, 0) 70%);
            animation: pulse 12s infinite;
            z-index: -1;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 0.4;
            }
            50% {
                transform: scale(1.15);
                opacity: 0.2;
            }
            100% {
                transform: scale(1);
                opacity: 0.4;
            }
        }

        /* Responsive */
        @media (max-width: 480px) {
            .exam-container {
                padding: 30px;
                margin: 20px;
            }
            h2 {
                font-size: 1.8em;
            }
            h3 {
                font-size: 1.5em;
            }
            .question-item h4 {
                font-size: 1.2em;
            }
            .question-item p {
                font-size: 0.9em;
            }
            a {
                padding: 10px 20px;
                font-size: 0.9em;
            }
        }
    </style>
</head>
<body></body></body>
    <div class="exam-container">
        <h2>Chi tiết đề thi</h2>
        <?php
        require '../../config/db.php';
        require '../../models/Exam.php';
        require '../../models/Question.php';
        require '../../controllers/ExamController.php';
        require '../../controllers/QuestionController.php';

        $examController = new ExamController($conn);
        $questionController = new QuestionController($conn);
        $id = $_GET['id'];
        $result = $conn->query("SELECT * FROM exams WHERE id = $id");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $exam = new Exam($row['id'], $row['title'], $row['description']);
            echo "<h3>" . htmlspecialchars($exam->title) . "</h3>";
            echo "<p>" . htmlspecialchars($exam->description) . "</p>";

            $questions = $conn->query("SELECT * FROM questions WHERE exam_id = $id");
            if ($questions->num_rows > 0) {
                while ($questionRow = $questions->fetch_assoc()) {
                    $question = new Question($questionRow['id'], $questionRow['exam_id'], $questionRow['content'], $questionRow['options'], $questionRow['correct_option']);
                    echo "<div class='question-item'>";
                    echo "<h4>" . htmlspecialchars($question->content) . "</h4>";
                    echo "<p>" . htmlspecialchars($question->options) . "</p>";
                    echo "<p>Lựa chọn đúng: " . htmlspecialchars($question->correct_option) . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>Không có câu hỏi nào.</p>";
            }
        } else {
            echo "<p>Đề thi không tồn tại.</p>";
        }

        $conn->close();
        ?>
        <a href="index.php">Quay lại danh sách đề thi</a>
    </div>
</body>
</html>
