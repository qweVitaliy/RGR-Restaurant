<?php
include 'includes/db.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $deleteQuery = "DELETE FROM client WHERE id = '$id'";
    if ($conn->query($deleteQuery) === TRUE) {
        header("Location: client.php");
        exit;
    } else {
        echo "Помилка видалення: " . $conn->error;
    }
} else {
    echo "Ідентифікатор клієнта не вказано.";
}
?>
