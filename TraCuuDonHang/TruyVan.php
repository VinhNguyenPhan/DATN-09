<?php require_once(__DIR__ . "/../core/database.php");

if (empty($_SESSION['user_id'])) {
    $redirect = '/DangNhap-DangKyTK/DangNhapDangKyTK.php?next=' . urlencode($_SERVER['REQUEST_URI']);
    header("Location: $redirect");
    exit;
}
if (isset($_GET['ajax']) && $_GET['ajax'] === 'list') {
    $type = $_GET['type'] ?? '';
    $table = $type === 'xk' ? 'to1XK' : ($type === 'nk' ? 'to1NK' : null);

    header('Content-Type: application/json; charset=utf-8');
    if (!$table) {
        echo json_encode([]);
        exit;
    }

    $svds = [];
    $res = $conn->query("SELECT id, SVD FROM $table ORDER BY created_at DESC LIMIT 500");
    if ($res) {
        while ($row = $res->fetch_assoc()) {
            $svds[] = $row;
        }
    }
    echo json_encode($svds);
    exit;
}