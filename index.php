
<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit;
}

$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вітаємо у системі</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 80%;
            max-width: 600px;
        }
        h1 {
            font-size: 2em;
            color: #333;
        }
        nav {
            margin-top: 20px;
        }
        nav a {
            margin: 0 15px;
            text-decoration: none;
            color: #007BFF;
            font-size: 1.1em;
        }
        nav a:hover {
            color: #0056b3;
        }
        .logout {
            margin-top: 20px;
            display: inline-block;
            background-color: #FF4C4C;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }
        .logout:hover {
            background-color: #e04343;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Вітаємо, <?php echo $_SESSION['username']; ?>!</h1>
        <nav>
            <?php
            if ($role === 'global_admin') {
                echo '<a href="admin.php">Адміністратор</a>';
                echo '<a href="client.php">Клієнт</a>';
                echo '<a href="orders.php">Замовлення</a>';
                echo '<a href="couriers.php">Кур\'єр</a>';
                echo '<a href="chefs.php">Шеф</a>';
                echo '<a href="manage_food.php">Їжа</a>';
            } elseif ($role === 'db_full_admin') {
                echo '<a href="client.php">Клієнт</a>';
                echo '<a href="orders.php">Замовлення</a>';
                echo '<a href="couriers.php">Кур\'єр</a>';
                echo '<a href="manage_food.php">Їжа</a>';
            } elseif ($role === 'db_admin') {
                echo '<a href="client.php">Клієнт</a>';
                echo '<a href="orders.php">Замовлення</a>';
                echo '<a href="manage_food.php">Їжа</a>';
            } elseif ($role === 'table_admin') {
                echo '<a href="client.php">Клієнт</a>';
                echo '<a href="manage_food.php">Їжа</a>';
            } elseif ($role === 'user') {
                echo '<a href="view_food.php">Перегляд їжі</a>';
            }
            ?>
        </nav>
        <a href="logout.php" class="logout">Вийти</a>
    </div>
</body>
</html>
