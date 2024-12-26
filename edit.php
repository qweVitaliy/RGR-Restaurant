<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "volodkovs_lab2";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Помилка з'єднання: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $phonenum = $_POST['phonenum'];
    $address = $_POST['address'];

    $sql = "UPDATE client SET 
            client_name='$name', 
            client_surname='$surname', 
            client_phonenum='$phonenum', 
            client_adress='$address' 
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Дані оновлено успішно!";
    } else {
        echo "Помилка: " . $conn->error;
    }

    $conn->close();
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM client WHERE id=$id";
    $result = $conn->query($sql);
    $client = $result->fetch_assoc();
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Редагувати клієнта</title>
</head>
<body>
    <h1>Редагувати клієнта</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $client['id']; ?>">
        <label>Ім'я:</label><br>
        <input type="text" name="name" value="<?= htmlspecialchars($client['client_name']); ?>" required><br>
        <label>Прізвище:</label><br>
        <input type="text" name="surname" value="<?= htmlspecialchars($client['client_surname']); ?>" required><br>
        <label>Телефон:</label><br>
        <input type="text" name="phonenum" value="<?= htmlspecialchars($client['client_phonenum']); ?>" required><br>
        <label>Адреса:</label><br>
        <input type="text" name="address" value="<?= htmlspecialchars($client['client_adress']); ?>" required><br>
        <button type="submit">Зберегти</button>
    </form>
    <a href="index.php">Повернутися до списку</a>
</body>
</html>
