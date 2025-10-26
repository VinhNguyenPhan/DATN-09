<?php
// chat-server.php — Backend PHP thuần cho ChatUx
header("Content-Type: application/javascript; charset=UTF-8");

// ======= LẤY DỮ LIỆU NGƯỜI DÙNG GỬI =======
$text = isset($_GET['text']) ? strtolower(trim($_GET['text'])) : '';
$callback = isset($_GET['callback']) ? $_GET['callback'] : 'callback';

// ======= XỬ LÝ LOGIC TRẢ LỜI =======
$reply = "Xin lỗi, tôi chưa hiểu ý bạn 😅";
$output = [];

// Chào hỏi
if (strpos($text, 'chào') !== false || strpos($text, 'hello') !== false) {
    $reply = "Chào bạn 👋! Tôi là trợ lý ChatUx chạy bằng PHP thuần.";
}
// Hỏi tên
elseif (strpos($text, 'tên') !== false) {
    $reply = "Tôi là bot ChatUx, backend PHP không cần cơ sở dữ liệu 😎.";
}
// Hỏi giờ
elseif (strpos($text, 'mấy giờ') !== false || strpos($text, 'giờ') !== false) {
    $reply = "Bây giờ là " . date("H:i:s") . " ⏰";
}
// Hỏi ngày
elseif (strpos($text, 'ngày') !== false) {
    $reply = "Hôm nay là " . date("d/m/Y") . " 📅";
}
// Yêu cầu ảnh/logo
elseif (strpos($text, 'logo') !== false || strpos($text, 'ảnh') !== false) {
    $output[] = [
        "type" => "html",
        "value" => "<img src='https://yourdomain.com/img/logo.png' width='100' style='border-radius:8px;'>"
    ];
    $reply = "Đây là logo của tôi 😄";
}
// Tạm biệt
elseif (strpos($text, 'bye') !== false || strpos($text, 'tạm biệt') !== false) {
    $reply = "Tạm biệt nhé 👋, hẹn gặp lại!";
}

// ======= GHÉP KẾT QUẢ =======
$output[] = [
    "type" => "text",
    "value" => $reply
];

$response = ["output" => $output];

// ======= TRẢ JSONP VỀ CHATUX =======
echo $callback . '(' . json_encode($response, JSON_UNESCAPED_UNICODE) . ');';
?>