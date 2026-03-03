<?php
require_once "config/config.php";
require_once "models/pdo_library.php";

try {
    $conn = pdo_get_connection();
    $stmt = $conn->query("DESCRIBE users");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h1>Cấu trúc bảng users hiện tại:</h1>";
    echo "<table border='1'>";
    echo "<tr><th>Field</th><th>Type</th></tr>";
    foreach ($columns as $col) {
        echo "<tr><td>{$col['Field']}</td><td>{$col['Type']}</td></tr>";
    }
    echo "</table>";
} catch (Exception $e) {
    echo "Lỗi: " . $e->getMessage();
}
?>
