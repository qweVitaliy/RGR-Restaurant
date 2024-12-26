<?php
include 'includes/db.php';


if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);
    $deleteQuery = "DELETE FROM courier WHERE id = '$id'";
    if ($conn->query($deleteQuery) === TRUE) {
        header("Location: couriers.php");
        exit;
    } else {
        echo "Помилка видалення: " . $conn->error;
    }
} else {
    echo "Ідентифікатор не вказано.";
}
?>
