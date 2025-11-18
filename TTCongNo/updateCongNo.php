<?php
require_once(__DIR__ . "/../core/database.php");
require_role(['admin', 'employee', 'accounting']);

header("Content-Type: application/json");

$loai = $_POST['loaiTk'] ?? '';
$id = intval($_POST['id'] ?? 0);
$tong = floatval($_POST['tong'] ?? 0);

if (!$loai || !$id) {
    echo json_encode(['status' => 'error', 'msg' => 'Thiếu dữ liệu']);
    exit;
}

if ($loai === 'XK') {
    $sql = "UPDATE to1xk SET congNo = ? WHERE id = ?";
} else if ($loai === 'NK') {
    $sql = "UPDATE to1nk SET congNo = ? WHERE id = ?";
} else {
    echo json_encode(['status' => 'error', 'msg' => 'Loại tờ khai không hợp lệ']);
    exit;
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("di", $tong, $id);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'msg' => 'Lỗi SQL']);
}