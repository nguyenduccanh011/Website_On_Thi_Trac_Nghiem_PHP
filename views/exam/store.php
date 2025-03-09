<?php
require '../../config/db.php';
require '../../controllers/ExamController.php';
require '../../controllers/QuestionController.php';
require '../../controllers/AnswerController.php';

$examController = new ExamController($conn);
$questionController = new QuestionController($conn);
$answerController = new AnswerController($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];
    $total_marks = $_POST['total_marks'];
    $subject = $_POST['subject'];

    $message = $examController->createExam($title, $description, $duration, $total_marks, $subject);
    if (strpos($message, "thành công") !== false) {
        $exam_id = $conn->insert_id;

        $contents = $_POST['content'];
        $correct_options = $_POST['correct_option'];
        $answers_list = $_POST['answers'];

        for ($i = 0; $i < count($contents); $i++) {
            $content = $contents[$i];
            $correct_option = $correct_options[$i];
            $answers = $answers_list[$i];

            $message = $questionController->createQuestion($exam_id, $content, implode(',', $answers), $answers[$correct_option]);
            if (strpos($message, "thành công") !== false) {
                $question_id = $conn->insert_id;
                $stmt = $conn->prepare("INSERT INTO exam_questions (exam_id, question_id) VALUES (?, ?)");
                $stmt->bind_param("ii", $exam_id, $question_id);
                $stmt->execute();
                foreach ($answers as $index => $answer) {
                    $is_correct = $index == $correct_option ? 1 : 0;
                    $answerController->createAnswer($question_id, trim($answer), $is_correct);
                }
            } else {
                echo "<p>Error: $message</p>";
            }
        }
        echo "<p>Đề thi và tất cả câu hỏi đã được tạo thành công.</p>";
        header("Location: index.php"); // Redirect to exam list page
        exit();
    } else {
        echo "<p>Error: $message</p>";
    }
}

$conn->close();
?>
