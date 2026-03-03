<?php
require_once "config/config.php";
try {
    $conn = pdo_get_connection();
    // Reset password for username 'admin' to 'admin123'
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ? AND role = 1");
    $stmt->execute(['admin123', 'admin']);
    
    if ($stmt->rowCount() > 0) {
        echo "Password for 'admin' has been reset to 'admin123'\n";
    } else {
        echo "No admin user with username 'admin' found or password already 'admin123'\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
