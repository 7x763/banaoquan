<?php
require_once "config/config.php";
try {
    $conn = pdo_get_connection();
    $stmt = $conn->query("DESCRIBE users");
    $cols = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "COLUMNS:\n";
    print_r($cols);
    
    $stmt = $conn->query("SELECT * FROM users WHERE username = 'admin'");
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "ADMIN DATA:\n";
    foreach($user as $key => $val) {
        echo "[$key] => (" . strlen($val) . ") '$val'\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
