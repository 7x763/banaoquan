<?php
require_once "config/config.php";
require_once "models/pdo_library.php";

try {
    $conn = pdo_get_connection();
    
    // Check count
    $stmt = $conn->query("SELECT count(*) FROM products");
    $count = $stmt->fetchColumn();
    
    echo "<h1>Kiểm tra dữ liệu Sản phẩm</h1>";
    echo "<p>Số lượng sản phẩm trong bảng 'products': <b>$count</b></p>";
    
    if ($count > 0) {
        $stmt = $conn->query("SELECT * FROM products LIMIT 5");
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "<h3>Một số sản phẩm mới nhất:</h3><ul>";
        foreach ($products as $p) {
            echo "<li>" . $p['name'] . " - " . number_format($p['price'], 0, ',', '.') . "đ</li>";
        }
        echo "</ul>";
    } else {
        echo "<p style='color:red'>Bảng sản phẩm đang trống!</p>";
    }
} catch (Exception $e) {
    echo "Lỗi: " . $e->getMessage();
}
?>
