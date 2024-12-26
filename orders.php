<?php include 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Замовлення</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .hidden {
            display: none;
        }
        .details {
            background-color: #f9f9f9;
        }
    </style>
    <script>
        function toggleDetails(orderId) {
            const detailsRow = document.getElementById('details-' + orderId);
            detailsRow.classList.toggle('hidden');
        }

        function showAddFoodForm(orderId) {
            const formDiv = document.getElementById('food-form-' + orderId);
            formDiv.classList.toggle('hidden');
        }
    </script>
</head>
<body>
    <a href="index.php">
        <button type="button">Home</button>
    </a>
    <h1>Список замовлень</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Клієнт</th>
                <th>Адміністратор</th>
                <th>Кур'єр</th>
                <th>Оплата</th>
                <th>Деталі</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT o.id, c.client_name, c.client_surname, a.admin_name, a.admin_surname, 
                             ch.chief_name, ch.chief_surname, co.courier_name, co.courier_surname, 
                             o.payment_type 
                      FROM `order` o
                      JOIN client c ON o.client_id = c.id
                      JOIN administrator a ON o.admin_id = a.id
                      JOIN chief ch ON o.chief_id = ch.id
                      JOIN courier co ON o.courier_id = co.id";
            $result = $conn->query($query);
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $payment = $row['payment_type'] ? 'Готівка' : 'Картка';
            ?>
                    <tr onclick="toggleDetails(<?php echo $row['id']; ?>)" style="cursor: pointer;">
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['client_name'] . ' ' . $row['client_surname']; ?></td>
                        <td><?php echo $row['admin_name'] . ' ' . $row['admin_surname']; ?></td>
                        <td><?php echo $row['chief_name'] . ' ' . $row['chief_surname']; ?></td>
                        <td><?php echo $row['courier_name'] . ' ' . $row['courier_surname']; ?></td>
                        <td><?php echo $payment; ?></td>
                        <td>
                            <button onclick="showAddFoodForm(<?php echo $row['id']; ?>)">Додати їжу</button>
                            Показати/Приховати
                        </td>
                    </tr>

                    <?php
                    $detailsQuery = "SELECT d.dish_name, d.dish_price, ol.quantity, ol.dish_id 
                                     FROM order_list ol
                                     JOIN dish d ON ol.dish_id = d.id
                                     WHERE ol.order_id = {$row['id']}";
                    $detailsResult = $conn->query($detailsQuery);

                    
                    echo "<tr id='details-{$row['id']}' class='hidden details'>
                            <td colspan='6'>
                                <strong>Деталі замовлення:</strong>
                                <ul>";
                    if ($detailsResult->num_rows > 0) {
                        while ($details = $detailsResult->fetch_assoc()) {
                            echo "<li>
                                    {$details['dish_name']} - {$details['quantity']} шт. - 
                                    {$details['dish_price']} грн
                                    <a href='remove_food.php?order_id={$row['id']}&dish_id={$details['dish_id']}'>Видалити</a>
                                  </li>";
                        }
                    } else {
                        echo "<li>Деталі відсутні</li>";
                    }
                    echo "  </ul>
                            </td>
                          </tr>";

                   
                    echo "<tr id='food-form-{$row['id']}' class='hidden'>
                            <td colspan='7'>
                                <h3>Додати їжу до замовлення #{$row['id']}</h3>
                                <form action='add_food.php' method='post'>
                                    <input type='hidden' name='order_id' value='{$row['id']}'>
                                    <label for='dish_id'>Страва:</label>
                                    <select name='dish_id' id='dish_id'>";
                    
                    $dishesQuery = "SELECT id, dish_name FROM dish";
                    $dishesResult = $conn->query($dishesQuery);
                    while ($dish = $dishesResult->fetch_assoc()) {
                        echo "<option value='{$dish['id']}'>{$dish['dish_name']}</option>";
                    }
                    echo "</select><br>
                          <label for='quantity'>Кількість:</label>
                          <input type='number' name='quantity' id='quantity' min='1' required><br>
                          <button type='submit'>Додати страву</button>
                        </form>
                      </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Немає даних</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <h2 align="center">Створити нове замовлення</h2>
    <form align="center" action="add_order.php" method="post">
        <label for="client_id">Клієнт:</label>
        <select name="client_id" id="client_id">
            <?php
            $clientsQuery = "SELECT id, client_name, client_surname FROM client";
            $clientsResult = $conn->query($clientsQuery);
            while ($client = $clientsResult->fetch_assoc()) {
                echo "<option value=\"{$client['id']}\">{$client['client_name']} {$client['client_surname']}</option>";
            }
            ?>
        </select><br>

        <label for="admin_id">Адміністратор:</label>
        <select name="admin_id" id="admin_id">
            <?php
            $adminsQuery = "SELECT id, admin_name, admin_surname FROM administrator";
            $adminsResult = $conn->query($adminsQuery);
            while ($admin = $adminsResult->fetch_assoc()) {
                echo "<option value=\"{$admin['id']}\">{$admin['admin_name']} {$admin['admin_surname']}</option>";
            }
            ?>
        </select><br>

        <label for="chief_id">Шеф:</label>
        <select name="chief_id" id="chief_id">
            <?php
            $chiefsQuery = "SELECT id, chief_name, chief_surname FROM chief";
            $chiefsResult = $conn->query($chiefsQuery);
            while ($chief = $chiefsResult->fetch_assoc()) {
                echo "<option value=\"{$chief['id']}\">{$chief['chief_name']} {$chief['chief_surname']}</option>";
            }
            ?>
        </select><br>

        <label for="courier_id">Кур'єр:</label>
        <select name="courier_id" id="courier_id">
            <?php
            $couriersQuery = "SELECT id, courier_name, courier_surname FROM courier";
            $couriersResult = $conn->query($couriersQuery);
            while ($courier = $couriersResult->fetch_assoc()) {
                echo "<option value=\"{$courier['id']}\">{$courier['courier_name']} {$courier['courier_surname']}</option>";
            }
            ?>
        </select><br>

        <label for="payment_type">Оплата:</label>
        <select name="payment_type" id="payment_type">
            <option value="1">Готівка</option>
            <option value="0">Картка</option>
        </select><br>

        <button type="submit">Створити замовлення</button>
    </form>
</body>
</html>
