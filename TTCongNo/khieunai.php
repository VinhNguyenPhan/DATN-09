<?php
// Lấy ID từ URL
$id = $_GET['id'] ?? '';

// =======================
// XỬ LÝ KHI SUBMIT FORM
// =======================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $reason = $_POST['reason'] ?? '';

    if ($id === '' || $reason === '') {
        die("Thiếu dữ liệu khiếu nại!");
    }

    // --- KẾT NỐI DB ---
    require_once(__DIR__ . '/../core/database.php');

    // --- LƯU VÀO CSDL ---
    $sql = "INSERT INTO complaints (invoice_id, reason, created_at) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $id, $reason);

    if ($stmt->execute()) {
        echo "<h3>✅ Đã gửi khiếu nại thành công!</h3>";
        echo "<p>Mã hóa đơn: <b>$id</b></p>";
        echo "<p>Lý do: <b>$reason</b></p>";
        echo '<a href="javascript:history.back()">⬅ Quay lại</a>';
        exit;
    } else {
        echo "<h3>❌ Lỗi lưu dữ liệu!</h3>";
        echo "<p>" . $conn->error . "</p>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Khiếu nại</title>
</head>

<body>
    <h2>Khiếu nại cho hóa đơn: <?php echo htmlspecialchars($id); ?></h2>

    <form method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

        <label>Lý do khiếu nại:</label>
        <select name="reason" required>
            <option value="">-- Chọn lý do --</option>
            <option value="Sai số tiền">Sai số tiền</option>
            <option value="Sai thông tin vận đơn">Sai thông tin vận đơn</option>
            <option value="Phát sinh không hợp lý">Phát sinh không hợp lý</option>
            <option value="Khác">Khác</option>
        </select>

        <br><br>
        <button type="submit">Gửi khiếu nại</button>
    </form>
</body>

</html>