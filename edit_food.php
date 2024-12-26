<?php
include 'includes/db.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_food'])) {
    $dish_id = $_POST['dish_id'];
    $dish_name = $_POST['dish_name'];
    $dish_price = $_POST['dish_price'];

    $query = "UPDATE dish SET dish_name = ?, dish_price = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sdi', $dish_name, $dish_price, $dish_id);
    if ($stmt->execute()) {
        echo "Страва успішно оновлена!";
    } else {
        echo "Помилка при оновленні страви: " . $stmt->error;
    }

    $stmt->close();  
}

if (isset($_GET['id'])) {
    $dish_id = $_GET['id'];
    $query = "SELECT * FROM dish WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $dish_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $dish = $result->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редагувати страву</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Редагувати страву</h1>

    <?php if (isset($dish)): ?>
        <form action="edit_food.php" method="POST">
            <input type="hidden" name="dish_id" value="<?php echo $dish['id']; ?>">
            <label for="dish_name">Назва страви:</label>
            <input type="text" name="dish_name" id="dish_name" value="<?php echo htmlspecialchars($dish['dish_name']); ?>" required><br><br>

            <label for="dish_price">Ціна:</label>
            <input type="number" name="dish_price" id="dish_price" value="<?php echo htmlspecialchars($dish['dish_price']); ?>" required><br><br>

            <button type="submit" name="edit_food">Оновити страву</button>
        </form>
    <?php else: ?>
        <p>Страва не знайдена.</p>
    <?php endif; ?>

</body>
</html>
