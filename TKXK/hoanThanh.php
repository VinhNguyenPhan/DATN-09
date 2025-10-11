<?php
require_once(__DIR__."/../core/database.php");

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Không tìm thấy ID tờ khai!");
}

$sql1 = "SELECT * FROM to1xk WHERE id = ?";
$stmt1 = $conn->prepare($sql1);
if (!$stmt1) {
    die("SQL Error in to1xk: " . $conn->error);
}
$stmt1->bind_param("i", $id);
$stmt1->execute();
$result1 = $stmt1->get_result();
$to1xk = $result1->fetch_assoc();

$sql2 = "SELECT * FROM to2xk WHERE to1xk = ?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("i", $id);
$stmt2->execute();
$result2 = $stmt2->get_result();
$to2xk = $result2->fetch_assoc();

$sql3 = "SELECT * FROM to3xk WHERE to1xk = ?";
$stmt3 = $conn->prepare($sql3);
$stmt3->bind_param("i", $id);
$stmt3->execute();
$result3 = $stmt3->get_result();
$hanghoa = $result3->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Xem tờ khai xuất khẩu</title>
    <style>
    body {
        font-family: "Segoe UI", sans-serif;
        background: #f4f8fb;
        color: #333;
        margin: 0;
        padding: 20px;
    }

    h2 {
        color: #1f6fb2;
        border-bottom: 2px solid #1f6fb2;
        padding-bottom: 5px;
    }

    .section {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 8px 20px;
    }

    .info-grid div {
        background: #f9fcff;
        padding: 6px 10px;
        border-radius: 6px;
        border: 1px solid #e1e8f0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    th {
        background: #1f6fb2;
        color: white;
        text-align: center;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .btn {
        display: inline-block;
        padding: 8px 16px;
        background: #1f6fb2;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        margin-top: 15px;
    }

    .btn:hover {
        background: #155b8c;
    }
    </style>
</head>

<body>

    <h2>📄 Thông tin tờ khai xuất khẩu</h2>

    <div class="section">
        <div class="info-grid">
            <div><b>Nhóm loại hình:</b> <?= htmlspecialchars($to1xk['nhom_loai_hinh']) ?></div>
            <div><b>Mã loại hình:</b> <?= htmlspecialchars($to1xk['ma_loai_hinh']) ?></div>
            <div><b>Mã DN XK:</b> <?= htmlspecialchars($to1xk['MSTDNNXK']) ?></div>
            <div><b>Mã BC HQ:</b> <?= htmlspecialchars($to1xk['MBCXK']) ?></div>
            <div><b>Tên DN XK:</b> <?= htmlspecialchars($to1xk['TDNXK']) ?></div>
            <div><b>Địa chỉ:</b> <?= htmlspecialchars($to1xk['DCDNXK']) ?></div>
            <div><b>SĐT:</b> <?= htmlspecialchars($to1xk['SDTDNXK']) ?></div>
            <div><b>Người đại diện:</b> <?= htmlspecialchars($to1xk['NUTXK']) ?></div>
        </div>
    </div>

    <h2>🧾 Thông tin hợp đồng / vận đơn</h2>

    <div class="section">
        <div class="info-grid">
            <div><b>Số hợp đồng:</b> <?= htmlspecialchars($to2xk['SHD']) ?></div>
            <div><b>Ngày phát hành:</b> <?= htmlspecialchars($to2xk['NPH']) ?></div>
            <div><b>Phương thức thanh toán:</b> <?= htmlspecialchars($to2xk['PTTT']) ?></div>
            <div><b>Số vận đơn:</b> <?= htmlspecialchars($to2xk['SCTBL']) ?></div>
            <div><b>Ngày vận đơn:</b> <?= htmlspecialchars($to2xk['NPHBL']) ?></div>
            <div><b>Ngân hàng TT:</b> <?= htmlspecialchars($to2xk['MNHTTT']) ?></div>
        </div>
    </div>

    <h2>📦 Danh sách hàng hóa</h2>

    <div class="section">
        <table>
            <thead>
                <tr>
                    <th>Mã HS</th>
                    <th>Tên hàng</th>
                    <th>ĐVT</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Trị giá</th>
                    <th>Nước nhập khẩu</th>
                    <th>Ghi chú</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($hanghoa as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['HSC']) ?></td>
                    <td><?= htmlspecialchars($row['TH']) ?></td>
                    <td><?= htmlspecialchars($row['DVT']) ?></td>
                    <td><?= htmlspecialchars($row['SL']) ?></td>
                    <td><?= htmlspecialchars($row['GIA']) ?></td>
                    <td><?= htmlspecialchars($row['VALUE']) ?></td>
                    <td><?= htmlspecialchars($row['XX']) ?></td>
                    <td><?= htmlspecialchars($row['GC']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <a href="../index.php" class="btn">⬅ Quay lại trang chủ</a>

</body>

</html>