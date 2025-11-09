<?php
require_once(__DIR__ . "/../core/database.php");

if (($_SESSION['role'] ?? '') !== 'admin') {
    die("⛔ Bạn không có quyền truy cập trang này!");
}

$id = $_GET['id'] ?? null;
if (!$id)
    die("Thiếu ID tờ khai!");

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
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Chỉnh sửa tờ khai nhập khẩu</title>
    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            background-color: #f4f8fb;
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
            border-radius: 8px;
            padding: 20px;
            margin-top: 15px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        input,
        select {
            width: 100%;
            padding: 6px;
            margin: 4px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
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

        .btn {
            display: inline-block;
            background: #1f6fb2;
            color: white;
            padding: 10px 16px;
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
    <h2>✏️ Chỉnh sửa thông tin tờ khai nhập khẩu</h2>

    <form action="updateNK.php" method="POST">
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="section">
            <h3>📘 Thông tin chung (Tờ 1)</h3>
            <label>Nhóm loại hình:</label>
            <select name="nhom_loai_hinh">
                <option <?= $to1nk['nhom_loai_hinh'] == 'A11' ? 'selected' : '' ?>>A11</option>
                <option <?= $to1nk['nhom_loai_hinh'] == 'A12' ? 'selected' : '' ?>>A12</option>
                <option <?= $to1nk['nhom_loai_hinh'] == 'B13' ? 'selected' : '' ?>>B13</option>
            </select>

            <label>Mã loại hình:</label>
            <input name="ma_loai_hinh" value="<?= htmlspecialchars($to1nk['ma_loai_hinh']) ?>">

            <label>Phân loại tổ chức:</label>
            <input name="phan_loai_to_chuc" value="<?= htmlspecialchars($to1nk['phan_loai_to_chuc']) ?>">

            <label>Cơ quan HQ:</label>
            <input name="co_quan_hq" value="<?= htmlspecialchars($to1nk['co_quan_hq']) ?>">

            <label>Phương thức vận chuyển:</label>
            <select name="phuong_thuc_vc">
                <option <?= $to1nk['phuong_thuc_vc'] == 'Đường biển' ? 'selected' : '' ?>>Đường biển</option>
                <option <?= $to1nk['phuong_thuc_vc'] == 'Đường hàng không' ? 'selected' : '' ?>>Đường hàng không
                </option>
                <option <?= $to1nk['phuong_thuc_vc'] == 'Đường bộ' ? 'selected' : '' ?>>Đường bộ</option>
            </select>

            <label>Mã số thuế DN NK:</label>
            <input name="MSTDNNK" value="<?= htmlspecialchars($to1nk['MSTDNNK']) ?>">

            <label>Tên DN NK:</label>
            <input name="TDNNK" value="<?= htmlspecialchars($to1nk['TDNNK']) ?>">

            <label>Địa chỉ:</label>
            <input name="DCDNNK" value="<?= htmlspecialchars($to1nk['DCDNNK']) ?>">

            <label>SĐT:</label>
            <input name="SDTDNNK" value="<?= htmlspecialchars($to1nk['SDTDNNK']) ?>">

            <label>Ngày hàng đến:</label>
            <input type="date" name="NHD" value="<?= htmlspecialchars($to1nk['NHD']) ?>">
        </div>
        <div class="section">
            <h3>📄 Thông tin hợp đồng / thanh toán (Tờ 2)</h3>
            <label>Số hợp đồng:</label>
            <input name="SHD" value="<?= htmlspecialchars($to2nk['SHD']) ?>">

            <label>Ngày phát hành:</label>
            <input type="date" name="NPH" value="<?= htmlspecialchars($to2nk['NPH']) ?>">

            <label>Phương thức thanh toán:</label>
            <select name="PTTT">
                <option <?= $to2nk['PTTT'] == 'T/T' ? 'selected' : '' ?>>T/T</option>
                <option <?= $to2nk['PTTT'] == 'L/C' ? 'selected' : '' ?>>L/C</option>
                <option <?= $to2nk['PTTT'] == 'Khác' ? 'selected' : '' ?>>Khác</option>
            </select>

            <label>Ngân hàng TT:</label>
            <input name="MNHTTT" value="<?= htmlspecialchars($to2nk['MNHTTT']) ?>">

            <label>Số vận đơn:</label>
            <input name="SCTBL" value="<?= htmlspecialchars($to2nk['SCTBL']) ?>">

            <label>Ngày vận đơn:</label>
            <input type="date" name="NPHBL" value="<?= htmlspecialchars($to2nk['NPHBL']) ?>">
        </div>
        <div class="section">
            <h3>📦 Danh sách hàng hóa (Tờ 3)</h3>
            <table>
                <tr>
                    <th>Mã HS</th>
                    <th>Tên hàng</th>
                    <th>ĐVT</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Trị giá</th>
                    <th>Xuất xứ</th>
                    <th>Ghi chú</th>
                </tr>
                <?php foreach ($hanghoa as $i => $h): ?>
                    <tr>
                        <td><input name="HSC[]" value="<?= htmlspecialchars($h['HSC']) ?>"></td>
                        <td><input name="TH[]" value="<?= htmlspecialchars($h['TH']) ?>"></td>
                        <td><input name="DVT[]" value="<?= htmlspecialchars($h['DVT']) ?>"></td>
                        <td><input name="SL[]" value="<?= htmlspecialchars($h['SL']) ?>"></td>
                        <td><input name="GIA[]" value="<?= htmlspecialchars($h['GIA']) ?>"></td>
                        <td><input name="VALUE[]" value="<?= htmlspecialchars($h['VALUE']) ?>"></td>
                        <td><input name="XX[]" value="<?= htmlspecialchars($h['XX']) ?>"></td>
                        <td><input name="GC[]" value="<?= htmlspecialchars($h['GC']) ?>"></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <button class="btn" type="submit">💾 Lưu thay đổi</button>
        <a href="done.php?id=<?= $id ?>" class="btn">⬅ Hủy</a>

    </form>
</body>

</html>