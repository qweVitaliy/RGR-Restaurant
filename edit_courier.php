<?php
include 'includes/db.php';


if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);
    $query = "SELECT * FROM courier WHERE id = '$id'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Кур'єр не знайдений.";
        exit;
    }
} else {
    echo "Ідентифікатор не вказано.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $surname = $conn->real_escape_string($_POST['surname']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $transport = $conn->real_escape_string($_POST['salary']);

    $updateQuery = "UPDATE courier SET courier_name = '$name', courier_surname = '$surname', 
                    courier_phonenum = '$phone', courier_salary = '$transport' WHERE id = '$id'";
    if ($conn->query($updateQuery) === TRUE) {
        header("Location: couriers.php");
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
    <title>Редагування кур'єра</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Редагування кур'єра</h1>
    <form method="POST" align="center">
        <input type="text" name="name" value="<?php echo $row['courier_name']; ?>" required>
        <input type="text" name="surname" value="<?php echo $row['courier_surname']; ?>" required>
        <input type="text" name="phone" value="<?php echo $row['courier_phonenum']; ?>" required>
        <input type="text" name="salary" value="<?php echo $row['courier_salary']; ?>" required>
        <button type="submit" class="edit-btn">Оновити</button>
    </form>
</body>
</html>
