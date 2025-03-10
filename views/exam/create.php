<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo đề thi và câu hỏi mới</title>
    <link rel="stylesheet" href="/Web_on_thi_trac_phiem_php/template/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <?php include '../../template/header.php'; ?>
        <?php include '../../template/sidebar.php'; ?>

        <main class="content">
            <h2 class="section-title">Tạo đề thi và câu hỏi mới</h2>
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
        </main>
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
