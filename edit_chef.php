<?php
include 'includes/db.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_chef'])) {
    $chef_id = $_POST['chef_id'];
    $chef_name = $_POST['chef_name'];
    $chef_surname = $_POST['chef_surname'];
    $chef_phonenum = $_POST['chef_phonenum'];
    $chef_salary = $_POST['chef_salary'];

    $query = "UPDATE chief SET chief_name = ?, chief_surname = ?, chief_phonenum = ?, chief_salary = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssssi', $chef_name, $chef_surname, $chef_phonenum, $chef_salary, $chef_id);

    if ($stmt->execute()) {
        echo "Шеф успішно оновлений!";
    } else {
        echo "Помилка при оновленні шефа: " . $stmt->error;
    }

    $stmt->close();
}


if (isset($_GET['id'])) {
    $chef_id = $_GET['id'];
    $query = "SELECT * FROM chief WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $chef_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $chef = $result->fetch_assoc();
    $stmt->close();
} else {
    echo "Невідомий шеф.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редагувати шефа</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Редагувати шефа</h1>
    <form action="edit_chef.php" method="POST">
        <input type="hidden" name="chef_id" value="<?php echo $chef['id']; ?>">

        <label for="chef_name">Ім'я:</label>
        <input type="text" name="chef_name" id="chef_name" value="<?php echo htmlspecialchars($chef['chief_name']); ?>" required><br><br>

        <label for="chef_surname">Прізвище:</label>
        <input type="text" name="chef_surname" id="chef_surname" value="<?php echo htmlspecialchars($chef['chief_surname']); ?>" required><br><br>

        <label
