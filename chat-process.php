<?php
header('Content-Type: application/json');
require_once "config/config.php";
require_once "models/pdo_library.php";
require_once "models/ProductModel.php";

$productModel = new ProductModel();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die(json_encode(['success' => false, 'error' => 'Invalid request']));
}

$userMsg = isset($_POST['message']) ? trim($_POST['message']) : '';

if (empty($userMsg)) {
    die(json_encode(['success' => false, 'error' => 'Empty message']));
}

// 1. Lấy toàn bộ sản phẩm để làm "Kiến thức" cho AI
$allProducts = $productModel->select_all_products();

// 2. Logic "Kiểm soát AI" - Tìm kiếm sản phẩm thông minh hơn
$foundProducts = [];
// Tách từ khóa từ tin nhắn của khách (loại bỏ các từ đệm như "tư vấn", "cho", "tôi", "muốn")
$searchKey = str_ireplace(['tư vấn', 'cho tôi', 'tôi muốn', 'cần tìm', 'giá', 'bao nhiêu'], '', $userMsg);
$searchKey = trim($searchKey);

foreach ($allProducts as $p) {
    // Nếu tên sản phẩm chứa từ khóa khách hỏi (ví dụ: "áo thun")
    if (mb_stripos($p['name'], $searchKey) !== false && !empty($searchKey)) {
        $foundProducts[] = $p;
    }
}

// 3. Xây dựng câu trả lời dựa trên phạm vi sản phẩm của web
if (!empty($foundProducts)) {
    $reply = "Tôi tìm thấy sản phẩm bạn quan tâm: \n";
    foreach ($foundProducts as $p) {
        $price = number_format($p['price'], 0, ',', '.') . "đ";
        $sale = ($p['sale_price'] > 0) ? " (KM: " . number_format($p['sale_price'], 0, ',', '.') . "đ)" : "";
        $reply .= "- " . $p['name'] . ": " . $price . $sale . "\n";
    }
    $reply .= "Bạn có muốn xem chi tiết sản phẩm này không?";
} else {
    // Nếu hỏi chung chung, AI sẽ gợi ý các sản phẩm nổi bật
    if (mb_stripos($userMsg, "giá") !== false || mb_stripos($userMsg, "sản phẩm") !== false || mb_stripos($userMsg, "có gì") !== false) {
        $reply = "Cửa hàng hiện có nhiều mẫu quần áo mới. Một số sản phẩm nổi bật:\n";
        for ($i = 0; $i < min(3, count($allProducts)); $i++) {
            $reply .= "- " . $allProducts[$i]['name'] . ": " . number_format($allProducts[$i]['price'], 0, ',', '.') . "đ\n";
        }
        $reply .= "Bạn có thể nhập tên sản phẩm cụ thể để tôi báo giá chính xác nhé!";
    } else {
        $reply = "Xin chào! Tôi là trợ lý của FAHASA shop. Tôi chỉ có thể tư vấn về các sản phẩm quần áo và giá cả của shop mình. Bạn cần tìm mẫu áo hay quần nào không?";
    }
}

// Giả lập độ trễ AI suy nghĩ
sleep(1);

echo json_encode([
    'success' => true,
    'reply' => $reply
]);
