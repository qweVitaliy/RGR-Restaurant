<?php include 'includes/db.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_chef'])) {
    $chief_name = $_POST['chief_name'];
    $chief_surname = $_POST['chief_surname'];
    $chief_phonenum = $_POST['chief_phonenum'];
    $chief_salary = $_POST['chief_salary'];

    $query = "INSERT INTO chief (chief_name, chief_surname, chief_phonenum, chief_salary) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssd', $chief_name, $chief_surname, $chief_phonenum, $chief_salary);

    if ($stmt->execute()) {
        echo "Шеф успішно доданий!";
    } else {
        echo "Помилка при додаванні шефа: " . $stmt->error;
    }

    $stmt->close();
}


if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $query = "DELETE FROM chief WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $delete_id);

    if ($stmt->execute()) {
        echo "Шеф успішно видалений!";
    } else {
        echo "Помилка при видаленні шефа: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Шефи</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <a href="index.php">
        <button type="button">Home</button>
    </a>
    <h1>Список шефів</h1>
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
            $query = "SELECT * FROM chief";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['chief_name']}</td>
                            <td>{$row['chief_surname']}</td>
                            <td>{$row['chief_phonenum']}</td>
                            <td>{$row['chief_salary']}</td>
                            <td><a href='edit_chef.php?id={$row['id']}'>Редагувати</a>
                            <a href='chefs.php?delete_id={$row['id']}' onclick='return confirm(\"Ви впевнені, що хочете видалити цього шефа?\")'>Видалити</a></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Немає даних</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <h2 align="center">Додати нового шефа</h2>
    <form action="chefs.php" align="center" method="POST">
        <input type="text" name="chief_name" id="chief_name" placeholder="Ім'я" required><br><br>
        <input type="text" name="chief_surname" id="chief_surname" placeholder="Прізвище" required><br><br>

        <input type="text" name="chief_phonenum" id="chief_phonenum" placeholder="Телефон" required><br><br>
        <input type="number" name="chief_salary" id="chief_salary" placeholder="Зарплата" required><br><br>

        <button type="submit" name="add_chef">Додати шефа</button>
    </form>

</body>
</html>
