<?php
include 'includes/db.php';


$query = "SELECT * FROM dish";
$result = $conn->query($query);


if ($result->num_rows > 0) {
    echo "<h1 style='text-align: center; font-family: Arial, sans-serif;'>Список страв</h1>";
    echo "<table style='width: 80%; margin: 0 auto; border-collapse: collapse; font-family: Arial, sans-serif;'>";
    echo "<thead style='background-color: #f4f4f4;'>";
    echo "<tr><th style='border: 1px solid #ddd; padding: 8px;'>ID</th><th style='border: 1px solid #ddd; padding: 8px;'>Назва страви</th><th style='border: 1px solid #ddd; padding: 8px;'>Ціна</th></tr>";
    echo "</thead>";
    echo "<tbody>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr style='text-align: center;'>";
        echo "<td style='border: 1px solid #ddd; padding: 8px;'>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td style='border: 1px solid #ddd; padding: 8px;'>" . htmlspecialchars($row['dish_name']) . "</td>";
        echo "<td style='border: 1px solid #ddd; padding: 8px;'>" . htmlspecialchars($row['dish_price']) . " грн</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";

    echo "<div style='text-align: center; margin-top: 20px; font-family: Arial, sans-serif;'>";
    echo "<p style='font-size: 18px; font-weight: bold;'>Замовити страву можна за телефонами:</p>";
    echo "<p style='font-size: 16px;'>+380 123 456 789</p>";
    echo "<p style='font-size: 16px;'>+380 987 654 321</p>";
    echo "</div>";
} else {
    echo "<p style='text-align: center; font-family: Arial, sans-serif;'>Жодної страви не знайдено.</p>";
}

$conn->close();
?>
