<?php
require_once "config/config.php";
try {
    $conn = pdo_get_connection();
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute(['admin']);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        echo "USER INFO:\n";
        print_r($user);
    } else {
        echo "User 'admin' not found.\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
