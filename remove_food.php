<?php
include 'includes/db.php';


if (isset($_GET['order_id']) && isset($_GET['dish_id'])) {
    $order_id = $_GET['order_id'];
    $dish_id = $_GET['dish_id'];

    
    $query = "DELETE FROM order_list WHERE order_id = $order_id AND dish_id = $dish_id";
    if ($conn->query($query) === TRUE) {
        echo "Страва успішно видалена з замовлення!";
        header("Location: orders.php"); 
    } else {
        echo "Помилка при видаленні страви з замовлення: " . $conn->error;
    }
} else {
    echo "Не вдалося знайти відповідні параметри.";
}
?>
