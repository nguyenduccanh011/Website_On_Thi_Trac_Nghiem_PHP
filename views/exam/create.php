<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo đề thi và câu hỏi mới</title>
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
            background: #f0f0f0;
            overflow-y: auto; /* Allow vertical scrolling */
            padding: 20px;
        }

        /* Container chính */
        .exam-container {
            background: #fff;
            border-radius: 20px;
            padding: 30px;
            width: 100%;
            max-width: 1200px; /* Increase max-width */
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
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
            color: #333;
            font-size: 2em;
            margin-bottom: 20px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* Label và input */
        form label {
            color: #333;
            font-size: 0.95em;
            margin-bottom: 8px;
            display: block;
            font-weight: 500;
            text-align: left;
        }

        form input[type="text"],
        form textarea,
        form input[type="number"] {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background: #f9f9f9;
            color: #333;
            font-size: 1em;
            transition: all 0.3s ease;
        }

        form input[type="text"]:focus,
        form textarea:focus,
        form input[type="number"]:focus {
            outline: none;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Nút tạo đề thi */
        .button-container {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        button {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(45deg, #00ddeb, #7b42ff);
            color: #fff;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 221, 235, 0.4);
        }

        button:active {
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
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
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
                padding: 20px;
                margin: 20px;
            }
            h2 {
                font-size: 1.8em;
            }
            form label {
                font-size: 0.85em;
            }
            form input[type="text"],
            form textarea,
            form input[type="number"] {
                font-size: 0.9em;
            }
            button {
                font-size: 1em;
            }
        }

        .question-block {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background: #f9f9f9;
        }

        .question-block h3 {
            margin-bottom: 10px;
            font-size: 1.2em;
            color: #333;
        }

        .answer-option {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .answer-option input[type="text"] {
            flex: 1;
            margin-left: 10px;
        }

        .answer-option label {
            margin-right: 10px;
            font-weight: bold;
        }

        .add-answer-btn {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 15px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .add-answer-btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="exam-container">
        <h2>Tạo đề thi và câu hỏi mới</h2>
        <form method="post" action="store.php" id="examForm">
            <label for="title">Tiêu đề:</label>
            <input type="text" id="title" name="title" required>
            
            <label for="description">Mô tả:</label>
            <textarea id="description" name="description" required></textarea>
            
            <label for="duration">Thời gian (phút):</label>
            <input type="number" id="duration" name="duration" required>
            
            <label for="total_marks">Tổng điểm:</label>
            <input type="number" id="total_marks" name="total_marks" required>
            
            <label for="subject">Môn học:</label>
            <input type="text" id="subject" name="subject" required>
            
            <div id="questions">
                <div class="question-block">
                    <h3>Câu hỏi 1</h3>
                    <label for="content">Nội dung câu hỏi:</label>
                    <textarea id="content" name="content[]" required></textarea>
                    
                    <div class="answer-options">
                        <div class="answer-option">
                            <label>A</label>
                            <input type="radio" name="correct_option[0]" value="0" required>
                            <input type="text" name="answers[0][]" placeholder="Đáp án" required>
                        </div>
                    </div>
                    <button type="button" class="add-answer-btn" onclick="addAnswerOption(this)">Thêm đáp án</button>
                </div>
            </div>
            <div class="button-container">
                <button type="button" onclick="addQuestion()">Thêm câu hỏi</button>
                <button type="submit">Tạo đề thi</button>
            </div>
        </form>
    </div>
    <script>
        let questionCount = 1;

        function addQuestion() {
            const questionBlock = document.createElement('div');
            questionBlock.className = 'question-block';
            questionBlock.innerHTML = `
                <h3>Câu hỏi ${++questionCount}</h3>
                <label for="content">Nội dung câu hỏi:</label>
                <textarea id="content" name="content[]" required></textarea>
                <div class="answer-options">
                    <div class="answer-option">
                        <label>A</label>
                        <input type="radio" name="correct_option[${questionCount - 1}]" value="0" required>
                        <input type="text" name="answers[${questionCount - 1}][]" placeholder="Đáp án" required>
                    </div>
                </div>
                <button type="button" class="add-answer-btn" onclick="addAnswerOption(this)">Thêm đáp án</button>
            `;
            document.getElementById('questions').appendChild(questionBlock);
        }

        function addAnswerOption(button) {
            const answerOptions = button.previousElementSibling;
            const answerCount = answerOptions.querySelectorAll('.answer-option').length;
            const questionIndex = Array.from(document.getElementById('questions').children).indexOf(button.parentElement);
            const answerOption = document.createElement('div');
            answerOption.className = 'answer-option';
            answerOption.innerHTML = `
                <label>${String.fromCharCode(65 + answerCount)}</label>
                <input type="radio" name="correct_option[${questionIndex}]" value="${answerCount}" required>
                <input type="text" name="answers[${questionIndex}][]" placeholder="Đáp án" required>
            `;
            answerOptions.appendChild(answerOption);
        }
    </script>
</body>
</html>
<?php
$message = ""; // Initialize the $message variable
if (strpos($message, "thành công") !== false) {
    $exam_id = $conn->insert_id;
    header("Location: ../question/create.php?exam_id=$exam_id");
    exit();
}
?>
