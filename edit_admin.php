<?php
include 'includes/db.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $query = "SELECT * FROM administrator WHERE id = '$id'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Адміністратор не знайдений.";
        exit;
    }
} else {
    echo "Ідентифікатор адміністратора не вказано.";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $surname = $conn->real_escape_string($_POST['surname']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $salary = $conn->real_escape_string($_POST['salary']);

   
    $updateQuery = "UPDATE administrator SET admin_name = '$name', admin_surname = '$surname', 
                    admin_phonenum = '$phone', admin_salary = '$salary' WHERE id = '$id'";

    if ($conn->query($updateQuery) === TRUE) {
       
        header("Location: index.php");
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
    <title>Редагування адміністратора</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Редагування адміністратора</h1>
    <form method="POST" align="center">
        <input type="text" name="name" value="<?php echo $row['admin_name']; ?>" required>
        <input type="text" name="surname" value="<?php echo $row['admin_surname']; ?>" required>
        <input type="text" name="phone" value="<?php echo $row['admin_phonenum']; ?>" required>
        <input type="number" name="salary" value="<?php echo $row['admin_salary']; ?>" required>
        <button type="submit" class="edit-btn">Оновити</button>
    </form>
</body>
</html>
