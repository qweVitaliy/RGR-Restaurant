<?php
session_start();
include 'includes/db.php';

$error = '';  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
        $error = "Логін може містити тільки латинські букви та цифри!";
    }

    
    if (strlen($password) < 8) {
        $error = "Пароль повинен бути не коротшим за 8 символів!";
    }

    
    if (empty($error)) {
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                header("Location: index.php");
                exit;
            } else {
                $error = "Невірний пароль!";
            }
        } else {
            $error = "Користувач не знайдений!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизація</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Авторизація</h1>
    <?php if (!empty($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <form method="POST" action="login.php">
        <label for="username">Логін:</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">Пароль:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <button type="submit">Увійти</button>
    </form>
</body>
</html>
