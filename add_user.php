<?php

include 'includes/db.php';


$password_global_admin = password_hash('global_admin_password', PASSWORD_DEFAULT);
$password_db_full_admin = password_hash('db_full_admin_password', PASSWORD_DEFAULT);
$password_db_admin = password_hash('db_admin_password', PASSWORD_DEFAULT);
$password_table_admin = password_hash('table_admin_password', PASSWORD_DEFAULT);
$password_user = password_hash('user_password', PASSWORD_DEFAULT);


$query = "INSERT INTO users (username, password, role) 
          VALUES 
          ('global_admin', '$password_global_admin', 'global_admin'),
          ('db_full_admin', '$password_db_full_admin', 'db_full_admin'),
          ('db_admin', '$password_db_admin', 'db_admin'),
          ('table_admin', '$password_table_admin', 'table_admin'),
          ('user', '$password_user', 'user')";

if ($conn->query($query) === TRUE) {
    echo "Користувачі успішно додані!";
} else {
    echo "Помилка при додаванні користувачів: " . $conn->error;
}
?>
