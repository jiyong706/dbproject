<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>프로젝트 만들기</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background: url('이미지') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Arial', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-header h1 {
            font-size: 36px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 18px;
            color: #666;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-group textarea {
            resize: vertical;
            height: 150px;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 50px;
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            margin: 0 10px;
        }

        .header .logo {
            font-size: 24px;
            color: #333;
        }

        .header a.active {
            color: #ff6347;
        }

        .main {
            text-align: center;
            margin-top: 50px;
        }

        .main h1 {
            font-size: 48px;
            color: #333;
        }

        .main p {
            font-size: 24px;
            color: #666;
        }

        .main .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
        }

        .main .btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">패널</div>
        <nav>
            <a href="/index.php">홈</a>
            <a href="/project/project.php" class="active">프로젝트</a>
            <a href="/login/logout.php">로그아웃</a>
        </nav>
    </div>
    <div class="container">
        <div class="form-header">
            <h1>프로젝트 만들기</h1>
        </div>
        <form method="post" action="/project/process_create_project.php">
            <div class="form-group">
                <label for="project_name">프로젝트 이름:</label>
                <input type="text" id="project_name" name="project_name" required>
            </div>
            <div class="form-group">
                <label for="project_password">프로젝트 비밀번호:</label>
                <input type="password" id="project_password" name="project_password" required>
            </div>
            <button type="submit">프로젝트 생성</button>
        </form>
    </div>
</body>
</html>
