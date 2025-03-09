<?php
class AnswerController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createAnswer($question_id, $content, $is_correct) {
        $stmt = $this->conn->prepare("INSERT INTO answers (question_id, content, is_correct) VALUES (?, ?, ?)");
        $stmt->bind_param("isi", $question_id, $content, $is_correct);
        if ($stmt->execute()) {
            return "Đáp án đã được tạo thành công.";
        } else {
            return "Lỗi: " . $stmt->error;
        }
    }
}
?>
