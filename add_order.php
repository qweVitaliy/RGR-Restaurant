<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $client_id = $_POST['client_id'];
    $admin_id = $_POST['admin_id'];
    $chief_id = $_POST['chief_id'];
    $courier_id = $_POST['courier_id'];
    $payment_type = $_POST['payment_type'];

    $query = "INSERT INTO `order` (client_id, admin_id, chief_id, courier_id, payment_type) 
              VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiiii", $client_id, $admin_id, $chief_id, $courier_id, $payment_type);

    if ($stmt->execute()) {
        echo "Замовлення успішно додано.";
    } else {
        echo "Помилка при додаванні замовлення: " . $stmt->error;
    }
    $stmt->close();
}
?>
