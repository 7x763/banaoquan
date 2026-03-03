<?php
require_once "config/config.php";
require_once "models/pdo_library.php";
try {
    $stmt = pdo_get_connection()->query("DESCRIBE users");
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<pre>";
    print_r($res);
    echo "</pre>";
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
