<?php
require '../../config/db.php';
require '../../controllers/QuestionController.php';
require '../../controllers/AnswerController.php';

$questionController = new QuestionController($conn);
$answerController = new AnswerController($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $exam_ids = $_POST['exam_id'];
    $contents = $_POST['content'];
    $options = $_POST['options'];
    $correct_options = $_POST['correct_option'];
    $answers_list = $_POST['answers'];

    for ($i = 0; $i < count($contents); $i++) {
        $exam_id = $exam_ids[$i];
        $content = $contents[$i];
        $option = $options[$i];
        $correct_option = $correct_options[$i];
        $answers = explode(',', $answers_list[$i]);

        $message = $questionController->createQuestion($exam_id, $content, $option, $correct_option);
        if (strpos($message, "thành công") !== false) {
            $question_id = $conn->insert_id;
            $stmt = $conn->prepare("INSERT INTO exam_questions (exam_id, question_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $exam_id, $question_id);
            $stmt->execute();
            foreach ($answers as $answer) {
                $is_correct = trim($answer) == $correct_option ? 1 : 0;
                $answerController->createAnswer($question_id, trim($answer), $is_correct);
            }
        } else {
            echo "<p>Error: $message</p>";
        }
    }
    echo "<p>Tất cả câu hỏi đã được tạo thành công.</p>";
}

$conn->close();
?>
