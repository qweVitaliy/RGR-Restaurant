<?php
include 'includes/db.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $deleteQuery = "DELETE FROM administrator WHERE id = '$id'";
    if ($conn->query($deleteQuery) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Помилка видалення: " . $conn->error;
    }
} else {
    echo "Ідентифікатор адміністратора не вказано.";
}
?>
