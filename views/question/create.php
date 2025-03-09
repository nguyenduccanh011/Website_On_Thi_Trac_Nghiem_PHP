<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo câu hỏi mới</title>
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
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            overflow: hidden;
            position: relative;
        }

        /* Container chính */
        .question-container {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            padding: 50px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
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
            color: #fff;
            font-size: 2.2em;
            margin-bottom: 20px;
            letter-spacing: 1px;
            text-transform: uppercase;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        /* Label và input */
        form label {
            color: #fff;
            font-size: 0.95em;
            margin-bottom: 8px;
            display: block;
            font-weight: 500;
        }

        form input[type="text"],
        form textarea {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: none;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            font-size: 1em;
            transition: all 0.3s ease;
        }

        form input[type="text"]:focus,
        form textarea:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        /* Nút tạo câu hỏi */
        button {
            width: 100%;
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
            background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, rgba(255, 255, 255, 0) 70%);
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
            .question-container {
                padding: 30px;
                margin: 20px;
            }
            h2 {
                font-size: 1.8em;
            }
            form label {
                font-size: 0.85em;
            }
            form input[type="text"],
            form textarea {
                font-size: 0.9em;
            }
            button {
                font-size: 1em;
            }
        }
    </style>
</head>
<body>
    <div class="question-container">
        <h2>Tạo câu hỏi mới</h2>
        <form method="post" action="store.php">
            <label for="exam_id">ID Đề thi:</label>
            <input type="text" id="exam_id" name="exam_id" value="<?php echo $_GET['exam_id'] ?? ''; ?>" required>
            
            <label for="content">Nội dung câu hỏi:</label>
            <textarea id="content" name="content" required></textarea>
            
            <label for="options">Các lựa chọn (ngăn cách bằng dấu phẩy):</label>
            <textarea id="options" name="options" required></textarea>
            
            <label for="correct_option">Lựa chọn đúng:</label>
            <input type="text" id="correct_option" name="correct_option" required>
            
            <label for="answers">Đáp án (ngăn cách bằng dấu phẩy):</label>
            <textarea id="answers" name="answers" required></textarea>
            
            <button type="submit">Tạo câu hỏi</button>
        </form>
    </div>
</body>
</html>
