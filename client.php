<?php include 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Клієнти</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <a href="index.php">
        <button type="button">Home</button>
    </a>
    <h1>Список клієнтів</h1>
    <table align="center" border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ім'я</th>
                <th>Прізвище</th>
                <th>Телефон</th>
                <th>Адреса</th>
                <th>Дії</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = $conn->real_escape_string($_POST['name']);
                $surname = $conn->real_escape_string($_POST['surname']);
                $phone = $conn->real_escape_string($_POST['phone']);
                $address = $conn->real_escape_string($_POST['address']);

                $addQuery = "INSERT INTO client (client_name, client_surname, client_phonenum, client_adress) 
                             VALUES ('$name', '$surname', '$phone', '$address')";
                $conn->query($addQuery);

                
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
            }

            // Виведення таблиці клієнтів
            $query = "SELECT * FROM client";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['client_name']}</td>
                            <td>{$row['client_surname']}</td>
                            <td>{$row['client_phonenum']}</td>
                            <td>{$row['client_adress']}</td>
                            <td>
                                <a href='delete_client.php?id={$row['id']}' class='delete-btn'>Видалити</a>
                                <a href='edit_client.php?id={$row['id']}' class='edit-btn'>Редагувати</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Немає даних</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Форма для додавання клієнта -->
    <form method="POST" align="center" class="add-form">
        <h2>Додати клієнта</h2>
        <input type="text" name="name" placeholder="Ім'я" required>
        <input type="text" name="surname" placeholder="Прізвище" required>
        <input type="text" name="phone" placeholder="Телефон" required>
        <input type="text" name="address" placeholder="Адреса" required>
        <button type="submit" class="add-btn">Додати</button>
    </form>
</body>
</html>
