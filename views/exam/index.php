<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đề thi</title>
    <link rel="stylesheet" href="/Web_on_thi_trac_phiem_php/template/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <?php include '../../template/header.php'; ?>
        <?php include '../../template/sidebar.php'; ?>

        <main class="content">
            <section>
                <h2 class="section-title">Danh sách đề thi</h2>
                <div class="grid">
                    <?php
                    require '../../config/db.php';
                    require '../../models/Exam.php';
                    require '../../controllers/ExamController.php';

                    $examController = new ExamController($conn);
                    $result = $conn->query("SELECT * FROM exams");

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $exam = new Exam($row['id'], $row['title'], $row['description']);
                            echo "<div class='card'>";
                            echo "<h3><a href='show.php?id=" . $exam->id . "'>" . htmlspecialchars($exam->title) . "</a></h3>";
                            echo "<p>" . htmlspecialchars($exam->description) . "</p>";
                            echo "<button class='btn'>Xem chi tiết</button>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>Không có đề thi nào.</p>";
                    }

                    $conn->close();
                    ?>
                </div>
                <div class="view-more">
                    <a href="#">Xem thêm ></a>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
