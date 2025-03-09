<?php
require '../../config/db.php';
require '../../controllers/QuestionController.php';
require '../../controllers/AnswerController.php';

$questionController = new QuestionController($conn);
$answerController = new AnswerController($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $exam_id = $_POST['exam_id'];
    $content = $_POST['content'];
    $options = $_POST['options'];
    $correct_option = $_POST['correct_option'];
    $answers = explode(',', $_POST['answers']);

    $message = $questionController->createQuestion($exam_id, $content, $options, $correct_option);
    if (strpos($message, "thành công") !== false) {
        $question_id = $conn->insert_id;
        foreach ($answers as $answer) {
            $is_correct = trim($answer) == $correct_option ? 1 : 0;
            $answerController->createAnswer($question_id, trim($answer), $is_correct);
        }
        echo "<p>$message</p>";
    } else {
        echo "<p>Error: $message</p>";
    }
}

$conn->close();
?>
