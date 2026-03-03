<?php
require_once "config/config.php";
require_once "models/pdo_library.php";
try {
    $stmt = pdo_get_connection()->query("DESCRIBE orders");
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<h3>Bảng orders:</h3><pre>";
    print_r($res);
    echo "</pre>";

    $stmt = pdo_get_connection()->query("DESCRIBE orderdetails");
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<h3>Bảng orderdetails:</h3><pre>";
    print_r($res);
    echo "</pre>";
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
