<?php
require_once "config/config.php";
require_once "models/pdo_library.php";

try {
    $conn = pdo_get_connection();
    $stmt = $conn->query("DESCRIBE orders");
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "ORDERS_TABLE_STRUCT_BEGIN\n";
    print_r($res);
    echo "ORDERS_TABLE_STRUCT_END\n";
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage();
}
?>
