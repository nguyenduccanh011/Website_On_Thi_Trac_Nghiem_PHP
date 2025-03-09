<?php
class ExamController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createExam($title, $description, $duration, $total_marks, $subject) {
        $stmt = $this->conn->prepare("INSERT INTO exams (title, description, duration, total_marks, subject) VALUES (?, ?, ?, ?, ?)");
        if ($stmt === false) {
            return "Lỗi: " . $this->conn->error;
        }
        $stmt->bind_param("ssdis", $title, $description, $duration, $total_marks, $subject);
        if ($stmt->execute()) {
            return "Đề thi đã được tạo thành công.";
        } else {
            return "Lỗi: " . $stmt->error;
        }
    }

    public function updateExam($id, $title, $description) {
        $stmt = $this->conn->prepare("UPDATE exams SET title = ?, description = ? WHERE id = ?");
        if ($stmt === false) {
            return "Lỗi: " . $this->conn->error;
        }
        $stmt->bind_param("ssi", $title, $description, $id);
        if ($stmt->execute()) {
            return "Đề thi đã được cập nhật thành công.";
        } else {
            return "Lỗi: " . $stmt->error;
        }
    }

    public function deleteExam($id) {
        $stmt = $this->conn->prepare("DELETE FROM exams WHERE id = ?");
        if ($stmt === false) {
            return "Lỗi: " . $this->conn->error;
        }
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            return "Đề thi đã được xóa thành công.";
        } else {
            return "Lỗi: " . $stmt->error;
        }
    }
}
?>
