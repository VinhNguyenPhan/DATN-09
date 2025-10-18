<?php
require_once(__DIR__."/../core/database.php");

$id = $_GET['id'] ?? null;
if (!$id) die("Không tìm thấy ID tờ khai!");

$sql1 = "SELECT * FROM to1nk WHERE id = ?";
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param("i", $id);
$stmt1->execute();
$to1nk = $stmt1->get_result()->fetch_assoc();

$sql2 = "SELECT * FROM to2nk WHERE to1nk = ?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("i", $id);
$stmt2->execute();
$to2nk = $stmt2->get_result()->fetch_assoc();

$sql3 = "SELECT * FROM to3nk WHERE to1nk = ?";
$stmt3 = $conn->prepare($sql3);
$stmt3->bind_param("i", $id);
$stmt3->execute();
$hanghoa = $stmt3->get_result()->fetch_all(MYSQLI_ASSOC);

$isAdmin = ($_SESSION['role'] ?? '') === 'admin';
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Tờ khai nhập khẩu - Hoàn thành</title>
    <style>
    body {
        font-family: "Segoe UI", sans-serif;
        background-color: #f4f8fb;
        color: #333;
        margin: 0;
        padding: 20px;
    }

    h2 {
        color: #1f6fb2;
        border-bottom: 2px solid #1f6fb2;
        padding-bottom: 5px;
        margin-top: 40px;
    }

    .section {
        background: #fff;
        border-radius: 8px;
        padding: 20px;
        margin-top: 15px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 8px 16px;
    }

    .info-grid div {
        padding: 6px 10px;
        background: #f9fcff;
        border-radius: 6px;
        border: 1px solid #e0e6ed;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    th {
        background: #1f6fb2;
        color: white;
    }

    tr:nth-child(even) {
        background: #f9f9f9;
    }

    .btn {
        display: inline-block;
        background: #1f6fb2;
        color: white;
        padding: 10px 18px;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 20px;
    }

    .btn:hover {
        background: #155b8c;
    }
    </style>
</head>

<body>

    <!-- if(isset($a)){
    echo $a;
}else{
    echo 'không tồn tại'
}

$a??'khong ton tai' -->

    <h2>📘 Thông tin chung (Tờ khai nhập khẩu)</h2>
    <div class="section">
        <div class="info-grid">
            <div><b>Nhóm loại hình:</b> <?= htmlspecialchars($to1nk['nhom_loai_hinh']) ?></div>
            <div><b>Mã loại hình:</b> <?= htmlspecialchars($to1nk['ma_loai_hinh']) ?></div>
            <div><b>Phân loại tổ chức:</b> <?= htmlspecialchars($to1nk['phan_loai_to_chuc']) ?></div>
            <div><b>Cơ quan HQ:</b> <?= htmlspecialchars($to1nk['co_quan_hq']) ?></div>
            <div><b>Phương thức vận chuyển:</b> <?= htmlspecialchars($to1nk['phuong_thuc_vc']) ?></div>
            <div><b>Mã phân loại hàng:</b> <?= htmlspecialchars($to1nk['ma_phan_loai_hang']) ?></div>
            <div><b>Mã bộ phận xử lý:</b> <?= htmlspecialchars($to1nk['ma_bo_phan_xu_ly']) ?></div>
            <div><b>Mã số thuế DN NK:</b> <?= htmlspecialchars($to1nk['MSTDNNK']) ?></div>
            <div><b>Tên DN NK:</b> <?= htmlspecialchars($to1nk['TDNNK']) ?></div>
            <div><b>Địa chỉ DN NK:</b> <?= htmlspecialchars($to1nk['DCDNNK']) ?></div>
            <div><b>SĐT DN NK:</b> <?= htmlspecialchars($to1nk['SDTDNNK']) ?></div>
            <div><b>Tên người ủy thác NK:</b> <?= htmlspecialchars($to1nk['NUTNK']) ?></div>
            <div><b>Địa chỉ người ủy thác NK:</b> <?= htmlspecialchars($to1nk['DCUTNK']) ?></div>
            <div><b>Mã địa điểm lưu kho:</b> <?= htmlspecialchars($to1nk['MDDLK']) ?></div>
            <div><b>Địa điểm dỡ hàng:</b> <?= htmlspecialchars($to1nk['DDDH']) ?></div>
            <div><b>Địa điểm xếp hàng:</b> <?= htmlspecialchars($to1nk['DDXH']) ?></div>
            <div><b>Ngày hàng đến:</b> <?= htmlspecialchars($to1nk['NHD']) ?></div>
        </div>
    </div>

    <h2>📄 Thông tin hợp đồng / thanh toán (Tờ 2 NK)</h2>
    <div class="section">
        <div class="info-grid">
            <div><b>Mã văn bản pháp quy:</b> <?= htmlspecialchars($to2nk['MVBPQK']) ?></div>
            <div><b>Phương thức thanh toán:</b> <?= htmlspecialchars($to2nk['PTTT']) ?></div>
            <div><b>Số hợp đồng:</b> <?= htmlspecialchars($to2nk['SHD']) ?></div>
            <div><b>Ngày phát hành:</b> <?= htmlspecialchars($to2nk['NPH']) ?></div>
            <div><b>Loại hợp đồng:</b> <?= htmlspecialchars($to2nk['MPLHD']) ?></div>
            <div><b>Ngân hàng thanh toán:</b> <?= htmlspecialchars($to2nk['MNHTTT']) ?></div>
            <div><b>Số vận đơn:</b> <?= htmlspecialchars($to2nk['SCTBL']) ?></div>
            <div><b>Ngày vận đơn:</b> <?= htmlspecialchars($to2nk['NPHBL']) ?></div>
            <div><b>Người nhận hàng:</b> <?= htmlspecialchars($to2nk['NNT']) ?></div>
            <div><b>Địa điểm 1:</b> <?= htmlspecialchars($to2nk['DD1']) ?></div>
            <div><b>Ngày khởi hành:</b> <?= htmlspecialchars($to2nk['NBD']) ?></div>
            <div><b>Ngày kết thúc:</b> <?= htmlspecialchars($to2nk['NKT']) ?></div>
        </div>
    </div>

    <h2>📦 Danh sách hàng hóa (Tờ 3 NK)</h2>
    <div class="section">
        <table>
            <thead>
                <tr>
                    <th>Số TK</th>
                    <th>Mã HS</th>
                    <th>Tên hàng</th>
                    <th>ĐVT</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Trị giá</th>
                    <th>Xuất xứ</th>
                    <th>Ghi chú</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($hanghoa as $h): ?>
                <tr>
                    <td><?= htmlspecialchars($h['STK']) ?></td>
                    <td><?= htmlspecialchars($h['HSC']) ?></td>
                    <td><?= htmlspecialchars($h['TH']) ?></td>
                    <td><?= htmlspecialchars($h['DVT']) ?></td>
                    <td><?= htmlspecialchars($h['SL']) ?></td>
                    <td><?= htmlspecialchars($h['GIA']) ?></td>
                    <td><?= htmlspecialchars($h['VALUE']) ?></td>
                    <td><?= htmlspecialchars($h['XX']) ?></td>
                    <td><?= htmlspecialchars($h['GC']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div>
        <a href="../index.php" class="btn">⬅ Quay lại</a>
        <?php if ($isAdmin): ?>
        <a href="editNK.php?id=<?= urlencode($id) ?>" class="btn" style="background:#28a745;">✏️ Chỉnh sửa</a>
        <?php endif; ?>
    </div>

</body>

</html>