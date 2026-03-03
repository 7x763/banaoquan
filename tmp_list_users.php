<?php
require_once "config/config.php";
try {
    $conn = pdo_get_connection();
    $stmt = $conn->query("SELECT user_id, username, password, email, role FROM users WHERE role = 1");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "ADMIN USERS:\n";
    foreach($users as $u) {
        echo "ID: " . $u['user_id'] . " | Username: " . $u['username'] . " | Pass: " . $u['password'] . " | Role: " . $u['role'] . "\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
