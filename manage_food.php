<?php
include 'includes/db.php'; 


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_food'])) {
    $dish_name = $_POST['dish_name'];
    $dish_price = $_POST['dish_price'];

    
    $query = "INSERT INTO dish (dish_name, dish_price) VALUES ('$dish_name', '$dish_price')";
    if ($conn->query($query) === TRUE) {
        echo "Страва успішно додана!";
    } else {
        echo "Помилка при додаванні страви: " . $conn->error;
    }
}


if (isset($_GET['delete'])) {
    $dish_id = $_GET['delete'];

    
    $query = "DELETE FROM dish WHERE id = $dish_id";
    if ($conn->query($query) === TRUE) {
        echo "Страва успішно видалена!";
    } else {
        echo "Помилка при видаленні страви: " . $conn->error;
    }
}


$query = "SELECT * FROM dish";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управління стравами</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
        }
        th, td {
            text-align: center;
        }
        .form-container {
            margin: 20px 0;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <a href="index.php">
        <button type="button">Home</button>
    </a>
    <h1>Управління стравами</h1>
    

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Назва страви</th>
                <th>Ціна</th>
                <th>Дії</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr id='dish-{$row['id']}'>
                            <td>{$row['id']}</td>
                            <td>{$row['dish_name']}</td>
                            <td>{$row['dish_price']}</td>
                            <td>
                                <a href='edit_food.php?id={$row['id']}'>Редагувати</a> |
                                <a href='manage_food.php?delete={$row['id']}'>Видалити</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Немає страв у базі даних</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <div class="form-container">
        <h3 align="center">Додати нову їжу</h3>
        <form align="center" action="manage_food.php" method="post">
            <label for="dish_name">Назва страви:</label>
            <input type="text" name="dish_name" id="dish_name" required><br>

            <label for="dish_price">Ціна:</label>
            <input type="number" name="dish_price" id="dish_price" required><br>

            <button type="submit" name="add_food">Додати їжу</button>
        </form>
    </div>
</body>
</html>
