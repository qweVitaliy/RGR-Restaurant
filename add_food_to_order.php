<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $dish_id = $_POST['dish_id'];
    $quantity = $_POST['quantity'];

    $checkQuery = "SELECT * FROM `order_list` WHERE order_id = ? AND dish_id = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("ii", $order_id, $dish_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $updateQuery = "UPDATE `order_list` SET quantity = quantity + ? WHERE order_id = ? AND dish_id = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("iii", $quantity, $order_id, $dish_id);
        $updateStmt->execute();
        echo "Кількість страви оновлено!";
    } else {

        $insertQuery = "INSERT INTO `order_list` (order_id, dish_id, quantity) VALUES (?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("iii", $order_id, $dish_id, $quantity);
        $insertStmt->execute();
        echo "Страву додано до замовлення!";
    }

    $stmt->close();
    $updateStmt->close();
    $insertStmt->close();
    $conn->close();
}
?>
