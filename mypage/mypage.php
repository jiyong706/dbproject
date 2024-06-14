<?php
session_start();
include 'functions.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];
$projects = getUserProjects($userId);
$panels = getUserPanels($userId);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>My Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1, h2 {
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin: 5px 0;
        }
        a {
            text-decoration: none;
            color: #0066cc;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Welcome to My Page</h1>

    <h2>Your Projects</h2>
    <ul>
        <?php foreach ($projects as $project): ?>
            <li><a href="project.php?id=<?php echo $project['id']; ?>"><?php echo $project['name']; ?></a></li>
        <?php endforeach; ?>
    </ul>

    <h2>Your Panels</h2>
    <ul>
        <?php foreach ($panels as $panel): ?>
            <li><a href="panel.php?id=<?php echo $panel['id']; ?>"><?php echo $panel['name']; ?></a></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
