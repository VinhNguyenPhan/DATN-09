<?php
header("Content-Type: application/javascript; charset=UTF-8");
$text = isset($_GET['text']) ? strtolower(trim($_GET['text'])) : '';
$callback = isset($_GET['callback']) ? $_GET['callback'] : 'callback';
$reply = "Xin lỗi, tôi chưa hiểu ý bạn 😅";
$output = [];
if (strpos($text, 'chào') !== false || strpos($text, 'hello') !== false) {
    $reply = "Chào bạn 👋! Tôi là nhân viên CSKH của công ty U&I Logistic miền Bắc.";
} elseif (strpos($text, 'tên') !== false) {
    $reply = "Tôi là bot ChatUx, backend PHP không cần cơ sở dữ liệu 😎.";
} elseif (strpos($text, 'mấy giờ') !== false || strpos($text, 'giờ') !== false) {
    $reply = "Bây giờ là " . date("H:i:s") . " ⏰";
} elseif (strpos($text, 'ngày') !== false) {
    $reply = "Hôm nay là " . date("d/m/Y") . " 📅";
} elseif (strpos($text, 'logo') !== false || strpos($text, 'ảnh') !== false) {
    $output[] = [
        "type" => "html",
        "value" => "<img src='https://yourdomain.com/img/logo.png' width='100' style='border-radius:8px;'>"
    ];
    $reply = "Đây là logo của tôi 😄";
} elseif (strpos($text, 'bye') !== false || strpos($text, 'tạm biệt') !== false) {
    $reply = "Tạm biệt nhé 👋, hẹn gặp lại!";
}
$output[] = [
    "type" => "text",
    "value" => $reply
];

$response = ["output" => $output];
echo $callback . '(' . json_encode($response, JSON_UNESCAPED_UNICODE) . ');';
?>