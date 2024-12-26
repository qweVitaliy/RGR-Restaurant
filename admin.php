<?php include 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Адміністратор</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
session_start();


if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'global_admin') {
    
    header("Location: login.php");
    exit;
}


echo "Ласкаво просимо, {$_SESSION['username']}! Ви маєте доступ до цієї сторінки.";
?>
    <a href="index.php">
        <button type="button">Home</button>
    </a>
    <h1>Список адміністраторів</h1>
    <table align="center" border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ім'я</th>
                <th>Прізвище</th>
                <th>Телефон</th>
                <th>Зарплата</th>
                <th>Дії</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = $conn->real_escape_string($_POST['name']);
                $surname = $conn->real_escape_string($_POST['surname']);
                $phone = $conn->real_escape_string($_POST['phone']);
                $salary = $conn->real_escape_string($_POST['salary']);

                $addQuery = "INSERT INTO administrator (admin_name, admin_surname, admin_phonenum, admin_salary) 
                             VALUES ('$name', '$surname', '$phone', '$salary')";
                $conn->query($addQuery);

            
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
            }

           
            $query = "SELECT * FROM administrator";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['admin_name']}</td>
                            <td>{$row['admin_surname']}</td>
                            <td>{$row['admin_phonenum']}</td>
                            <td>{$row['admin_salary']}</td>
                            <td>
                                <a href='delete_admin.php?id={$row['id']}' class='delete-btn'>Видалити</a>
                                <a href='edit_admin.php?id={$row['id']}' class='edit-btn'>Редагувати</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Немає даних</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <form method="POST" align="center" class="add-form">
        <h2>Додати адміністратора</h2>
        <input type="text" name="name" placeholder="Ім'я" required>
        <input type="text" name="surname" placeholder="Прізвище" required>
        <input type="text" name="phone" placeholder="Телефон" required>
        <input type="number" name="salary" placeholder="Зарплата" required>
        <button type="submit" class="add-btn">Додати</button>
    </form>
</body>
</html>
