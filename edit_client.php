<?php
include 'includes/db.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

   
    $query = "SELECT * FROM client WHERE id = '$id'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Клієнт не знайдений.";
        exit;
    }
} else {
    echo "Ідентифікатор клієнта не вказано.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $surname = $conn->real_escape_string($_POST['surname']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);


    $updateQuery = "UPDATE client SET client_name = '$name', client_surname = '$surname', 
                    client_phonenum = '$phone', client_adress = '$address' WHERE id = '$id'";

    if ($conn->query($updateQuery) === TRUE) {
        header("Location: clients.php");
        exit;
    } else {
        echo "Помилка оновлення: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редагування клієнта</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Редагування клієнта</h1>
    <form method="POST" align="center">
        <input type="text" name="name" value="<?php echo $row['client_name']; ?>" required>
        <input type="text" name="surname" value="<?php echo $row['client_surname']; ?>" required>
        <input type="text" name="phone" value="<?php echo $row['client_phonenum']; ?>" required>
        <input type="text" name="address" value="<?php echo $row['client_adress']; ?>" required>
        <button type="submit" class="edit-btn">Оновити</button>
    </form>
</body>
</html>
