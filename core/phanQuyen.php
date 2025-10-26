<?php
require_once(__DIR__."/phanQuyen.php");
$user_role = $_SESSION['role'] ?? '';

if (empty($user_role)) {
    $uid = $_SESSION['user_id']??0;
    $res = $conn->query("SELECT role FROM users WHERE id = '$uid' LIMIT 1");
    if ($res && $res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $_SESSION['role'] = $row['role'];
        $user_role = $row['role'];
        echo $user_role;
    }
}
function require_role($allowed_roles) {
    global $user_role;
    if (!in_array($user_role, $allowed_roles)) {
        http_response_code(403);
    echo "
        <div style='text-align:center; margin-top:80px; font-family:Arial, sans-serif;'>
            <h2 style='color:#b91c1c;'>⛔ Bạn không có quyền truy cập vào chức năng này.</h2>
            <a href='/index.php' 
               style='display:inline-block; margin-top:15px; padding:10px 18px; background:#004b8d; 
                      color:#fff; text-decoration:none; border-radius:8px; font-weight:600;'>
                ⬅ Quay lại trang chủ
            </a>
        </div>";
        exit;
    }
}
?>