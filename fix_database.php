<?php
require_once "config/config.php";
require_once "models/pdo_library.php";

try {
    $conn = pdo_get_connection();
    
    // Đọc file SQL
    $sql_file = "duan1_quanao.sql";
    if (!file_exists($sql_file)) {
        die("Không tìm thấy file $sql_file");
    }

    $sql = file_get_contents($sql_file);
    
    // Tách các câu lệnh SQL (tạm thời sử dụng cách tách đơn giản bằng dấu ;)
    // Lưu ý: Cách này có thể không hoàn hảo với các store procedure phức tạp nhưng ổn với SQL dump cơ bản
    $queries = explode(';', $sql);

    echo "<h1>Bắt đầu đồng bộ Database...</h1>";
    echo "<ul>";
    foreach ($queries as $query) {
        $query = trim($query);
        if (!empty($query)) {
            try {
                $conn->exec($query);
                // echo "<li>Thực thi thành công: " . substr($query, 0, 50) . "...</li>";
            } catch (PDOException $e) {
                echo "<li style='color:red'>Lỗi khi chạy lệnh: " . $e->getMessage() . "</li>";
            }
        }
    }
    echo "</ul>";
    echo "<h2 style='color:green'>Hoàn tất! Bây giờ bạn hãy thử đăng ký lại nhé.</h2>";
} catch (Exception $e) {
    echo "<h2 style='color:red'>Lỗi nghiêm trọng: " . $e->getMessage() . "</h2>";
}
?>
