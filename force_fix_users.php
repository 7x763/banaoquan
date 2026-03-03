<?php
require_once "config/config.php";
require_once "models/pdo_library.php";

try {
    $conn = pdo_get_connection();
    
    // Thêm các cột còn thiếu vào bảng users
    $queries = [
        "ALTER TABLE users ADD COLUMN IF NOT EXISTS username varchar(100) NOT NULL AFTER user_id",
        "ALTER TABLE users ADD COLUMN IF NOT EXISTS password varchar(255) NOT NULL AFTER username",
        "ALTER TABLE users ADD COLUMN IF NOT EXISTS full_name varchar(255) NOT NULL AFTER password",
        "ALTER TABLE users ADD COLUMN IF NOT EXISTS image varchar(255) NOT NULL AFTER full_name",
        "ALTER TABLE users ADD COLUMN IF NOT EXISTS phone varchar(10) NOT NULL AFTER email",
        "ALTER TABLE users ADD COLUMN IF NOT EXISTS address varchar(255) NOT NULL AFTER phone",
        "ALTER TABLE users ADD COLUMN IF NOT EXISTS role tinyint(1) NOT NULL DEFAULT 0 AFTER address",
        "ALTER TABLE users ADD COLUMN IF NOT EXISTS active tinyint(1) NOT NULL DEFAULT 1 AFTER role"
    ];

    echo "<h1>Đang sửa lỗi Database...</h1>";
    foreach ($queries as $q) {
        try {
            $conn->exec($q);
            echo "<p style='color:green'>Thành công: $q</p>";
        } catch (Exception $e) {
            echo "<p style='color:orange'>Đã tồn tại hoặc lỗi nhỏ: " . $e->getMessage() . "</p>";
        }
    }
    
    echo "<h2 style='color:blue'>Hoàn tất! Hãy F5 lại trang Đăng ký.</h2>";
} catch (Exception $e) {
    echo "<h2 style='color:red'>Lỗi: " . $e->getMessage() . "</h2>";
}
?>
