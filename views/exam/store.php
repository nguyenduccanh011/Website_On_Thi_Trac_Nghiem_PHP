<?php
require '../../config/db.php';
require '../../controllers/ExamController.php';

$examController = new ExamController($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];
    $total_marks = $_POST['total_marks'];
    $subject = $_POST['subject'];

    $message = $examController->createExam($title, $description, $duration, $total_marks, $subject);
    if (strpos($message, "thành công") !== false) {
        $exam_id = $conn->insert_id;
        header("Location: ../question/create.php?exam_id=$exam_id");
        exit();
    } else {
        echo "<p>Error: $message</p>";
    }
}

$conn->close();
?>
