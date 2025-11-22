<?php
require_once(__DIR__ . "/../core/database.php");
require_once __DIR__ . '/vendor/autoload.php';

require_role(['admin']); // kiểm tra role

if (empty($_SESSION['user_id'])) {
    $redirect = '/DangNhap-DangKyTK/DangNhapDangKyTK.php?next=' . urlencode($_SERVER['REQUEST_URI']);
    header("Location: $redirect");
    exit;
}

use XLSXWriter\XLSXWriter;

// Lấy giá trị từ query string
$status = $_GET['status'] ?? 'all';
$fromDate = $_GET['fromDate'] ?? null;
$toDate = $_GET['toDate'] ?? null;

if (!$fromDate || !$toDate) {
    die("Thiếu ngày bắt đầu hoặc ngày kết thúc!");
}

// Chuẩn hóa ngày
$fromDate = date('Y-m-d 00:00:00', strtotime($fromDate));
$toDate = date('Y-m-d 23:59:59', strtotime($toDate));

// Mảng chứa dữ liệu để ghi Excel
$data = [];
$headerWritten = false;

// Các bảng cần thống kê
$tables = ['to1XK', 'to1NK'];

// Lặp từng bảng
foreach ($tables as $table) {
    $sql = "SELECT * FROM $table WHERE created_at BETWEEN ? AND ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $fromDate, $toDate);
    $stmt->execute();
    $res = $stmt->get_result();

    while ($row = $res->fetch_assoc()) {
        $stt = strtolower(trim($row['ThongKeTK']));

        // Kiểm tra trạng thái
        if ($status !== 'all') {
            if ($status === 'declaration' && !str_contains($stt, 'declaration'))
                continue;
            if ($status === 'declarating' && !str_contains($stt, 'declarating'))
                continue;
            if ($status === 'cancel' && !str_contains($stt, 'cancel'))
                continue;
        }

        // Ghi header một lần
        if (!$headerWritten) {
            $headers = [];
            foreach ($row as $key => $val) {
                $headers[$key] = 'string';
            }
            $headerWritten = true;
        }

        $data[] = $row;
    }
    $stmt->close();
}

if (empty($data)) {
    die("Không có dữ liệu để xuất!");
}

// Tạo XLSXWriter
$writer = new XLSXWriter();
$writer->setAuthor('Hệ thống Thống kê');

// Ghi header
$writer->writeSheetHeader('Tờ khai', $headers);

// Ghi dữ liệu
foreach ($data as $row) {
    $writer->writeSheetRow('Tờ khai', $row);
}

// Gửi file xuống trình duyệt
header('Content-disposition: attachment; filename="ThongKe_ToKhai.xlsx"');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
$writer->writeToStdOut();
exit;