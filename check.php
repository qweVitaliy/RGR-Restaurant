<?php

include 'includes/db.php';


$query = "SELECT username, password, role FROM users";
$result = $conn->query($query);

if ($result->num_rows > 0) {

    echo "<h2>Список користувачів:</h2>";
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><th>Ім'я користувача</th><th>Пароль (хешований)</th><th>Роль</th></tr>";


    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['username']}</td>
                <td>{$row['password']}</td>
                <td>{$row['role']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Немає користувачів у базі даних.";
}
?>
