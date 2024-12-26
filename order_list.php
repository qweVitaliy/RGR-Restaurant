<?php include 'includes/db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Додати страву до замовлення</title>
</head>
<body>

    <h1>Додати страву до замовлення</h1>


    <form action="add_food_to_order.php" method="POST">
        <label for="order_id">Виберіть замовлення:</label>
        <select name="order_id" id="order_id" required>
            <?php
            $ordersQuery = "SELECT id, client_id FROM `order`";
            $ordersResult = $conn->query($ordersQuery);
            while ($order = $ordersResult->fetch_assoc()) {
                echo "<option value='{$order['id']}'>Замовлення №{$order['id']}</option>";
            }
            ?>
        </select>
        <br><br>

        <label for="dish_id">Виберіть страву:</label>
        <select name="dish_id" id="dish_id" required>
            <?php
            $dishesQuery = "SELECT id, dish_name FROM `dish`";
            $dishesResult = $conn->query($dishesQuery);
            while ($dish = $dishesResult->fetch_assoc()) {
                echo "<option value='{$dish['id']}'>{$dish['dish_name']}</option>";
            }
            ?>
        </select>
        <br><br>

        <label for="quantity">Кількість:</label>
        <input type="number" name="quantity" id="quantity" required min="1">
        <br><br>

        <button type="submit">Додати страву</button>
    </form>

</body>
</html>
