<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

$input = file_get_contents('php://input');
$data = json_decode($input, true);

$id = $data['id'] ?? '';
$SVD = $data['SVD'] ?? 0;
$action = $data['action'] ?? '';
$loai = $data['loai'];
$lydo = $data['lydo'];

// Kiểm tra dữ liệu đầu vào
if (empty($id) || $action !== 'notify_transfer' || empty($loai)) {
    echo json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ.']);
    exit;
}
require_once(__DIR__ . '/../core/database.php');

$success = false;
$message = "Khiếu nại thành công";

try {

    if ($loai == 'to1xk') {
        $sqlXK = "SELECT to1xk.TTGHD as amount FROM to1XK WHERE to1xk.id = '" . $id . "' LIMIT 1";
        $data = $conn->query($sqlXK)->fetch_assoc();
    } else {
        $sqlNK = "SELECT to2nk.TTGHD as amount FROM to1NK JOIN to2nk ON to2nk.to1nk = to1nk.id  WHERE to1nk.id = '" . $id . "' LIMIT 1";
        $data = $conn->query($sqlNK)->fetch_assoc();
    }

    SendTele("Khach Hang da khiếu nại tờ khai {$SVD}-{$id} \nloại: {$loai} với lý do: " . $lydo);
    $success = true;

} catch (Throwable $e) {
    $success = false;
    $message = "Lỗi hệ thống khi ghi nhận thông báo." . $e->getMessage();
}
echo json_encode(['success' => $success, 'message' => $message]);
?>