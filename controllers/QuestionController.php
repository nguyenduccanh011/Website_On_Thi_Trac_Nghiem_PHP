<?php
class QuestionController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createQuestion($exam_id, $content, $options, $correct_option) {
        $stmt = $this->conn->prepare("INSERT INTO questions (exam_id, content, options, correct_option) VALUES (?, ?, ?, ?)");
        if ($stmt === false) {
            return "Lỗi: " . $this->conn->error;
        }
        $stmt->bind_param("isss", $exam_id, $content, $options, $correct_option);
        if ($stmt->execute()) {
            return "Câu hỏi đã được tạo thành công.";
        } else {
            return "Lỗi: " . $stmt->error;
        }
    }

    public function updateQuestion($id, $content, $options, $correct_option) {
        $stmt = $this->conn->prepare("UPDATE questions SET content = ?, options = ?, correct_option = ? WHERE id = ?");
        $stmt->bind_param("sssi", $content, $options, $correct_option, $id);
        if ($stmt->execute()) {
            return "Câu hỏi đã được cập nhật thành công.";
        } else {
            return "Lỗi: " . $stmt->error;
        }
    }

    public function deleteQuestion($id) {
        $stmt = $this->conn->prepare("DELETE FROM questions WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            return "Câu hỏi đã được xóa thành công.";
        } else {
            return "Lỗi: " . $stmt->error;
        }
    }
}
?>
