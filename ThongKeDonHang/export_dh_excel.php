<?php
require_once(__DIR__ . "/../core/database.php");

require_role(['admin']);

if (empty($_SESSION['user_id'])) {
    $redirect = '/DangNhap-DangKyTK/DangNhapDangKyTK.php?next=' . urlencode($_SERVER['REQUEST_URI']);
    header("Location: $redirect");
    exit;
}

$status = $_GET['status'] ?? 'all';

$toDate = $_GET['to'] ?? date('Y-m-d');
$fromDate = $_GET['from'] ?? date('Y-m-d', strtotime('-30 days', strtotime($toDate)));

$fromDate = date('Y-m-d 00:00:00', strtotime($fromDate));
$toDate = date('Y-m-d 23:59:59', strtotime($toDate));

if (!$fromDate || !$toDate) {
    die("Thiếu ngày bắt đầu hoặc ngày kết thúc!");
}

$data = [];
$tables = ['to1XK', 'to1NK'];

$col_SVD = 'SVD';
$col_Money = 'TTGHD';
$col_Status = 'ThongKe';
$col_Date = 'created_at';

foreach ($tables as $table) {
    $sql = "SELECT * FROM $table WHERE created_at BETWEEN ? AND ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Lỗi prepare: " . $conn->error);
    }

    $stmt->bind_param("ss", $fromDate, $toDate);
    $stmt->execute();
    $res = $stmt->get_result();

    while ($row = $res->fetch_assoc()) {
        $stt = strtolower(trim($row[$col_Status] ?? ''));
        if ($status !== 'all') {
            if ($status === 'shipping' && !str_contains($stt, 'shipping'))
                continue;
            if ($status === 'shipped' && !str_contains($stt, 'shipped'))
                continue;
            if ($status === 'done' && !str_contains($stt, 'done'))
                continue;
            if ($status === 'cancel' && !str_contains($stt, 'cancel'))
                continue;
        }

        $data[] = [
            'SVD' => $row[$col_SVD] ?? '',
            'Loại' => $table,
            'Số Tiền' => $row[$col_Money] ?? '',
            'Trạng Thái' => $row[$col_Status] ?? '',
            'Ngày' => $row[$col_Date] ?? '',
        ];
    }

    $stmt->close();
}

if (empty($data)) {
    die("Không có dữ liệu để xuất!");
}

$filename = "ThongKe_DonHang_" . date('Ymd_His') . ".csv";

header('Content-Type: text/csv; charset=UTF-8');
header("Content-Disposition: attachment; filename=\"$filename\"");

echo "\xEF\xBB\xBF";

$out = fopen('php://output', 'w');

fputcsv($out, ['SVD', 'Loại', 'Số Tiền', 'Trạng Thái', 'Ngày']);

foreach ($data as $row) {
    fputcsv($out, $row);
}

fclose($out);
exit;