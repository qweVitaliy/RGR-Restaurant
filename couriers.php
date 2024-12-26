<?php include 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Кур'єри</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Список кур'єрів</h1>
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
            // Додавання кур'єра
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = $conn->real_escape_string($_POST['name']);
                $surname = $conn->real_escape_string($_POST['surname']);
                $phone = $conn->real_escape_string($_POST['phone']);
                $transport = $conn->real_escape_string($_POST['salary']);

                $addQuery = "INSERT INTO courier (courier_name, courier_surname, courier_phonenum, courier_salary) 
                             VALUES ('$name', '$surname', '$phone', '$transport')";
                $conn->query($addQuery);

                // Перезавантаження сторінки
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
            }

            // Виведення списку кур'єрів
            $query = "SELECT * FROM courier";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['courier_name']}</td>
                            <td>{$row['courier_surname']}</td>
                            <td>{$row['courier_phonenum']}</td>
                            <td>{$row['courier_salary']}</td>
                            <td>
                                <a href='delete_courier.php?id={$row['id']}' class='delete-btn'>Видалити</a>
                                <a href='edit_courier.php?id={$row['id']}' class='edit-btn'>Редагувати</a>
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
        <h2>Додати кур'єра</h2>
        <input type="text" name="name" placeholder="Ім'я" required>
        <input type="text" name="surname" placeholder="Прізвище" required>
        <input type="text" name="phone" placeholder="Телефон" required>
        <input type="text" name="salary" placeholder="Зарплата" required>
        <button type="submit" class="add-btn">Додати</button>
    </form>
</body>
</html>
