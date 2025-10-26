<?php
// editXK.php
require_once(__DIR__ . "/../core/database.php");
if (($_SESSION['role'] ?? '') !== 'admin') {
    die("Bạn không có quyền truy cập trang chỉnh sửa.");
}

$id = $_GET['id'] ?? null;
if (!$id) die("Thiếu ID tờ khai!");

// lấy dữ liệu
$stmt1 = $conn->prepare("SELECT * FROM to1xk WHERE id = ?");
$stmt1->bind_param("i", $id); $stmt1->execute(); $to1 = $stmt1->get_result()->fetch_assoc();

$stmt2 = $conn->prepare("SELECT * FROM to2xk WHERE to1xk = ?");
$stmt2->bind_param("i", $id); $stmt2->execute(); $to2 = $stmt2->get_result()->fetch_assoc();

$stmt3 = $conn->prepare("SELECT * FROM to3xk WHERE to1xk = ?");
$stmt3->bind_param("i", $id); $stmt3->execute(); $items = $stmt3->get_result()->fetch_all(MYSQLI_ASSOC);

// một số select options mẫu — bạn có thể chỉnh/ bổ sung
$opts = [
    'nhom_loai_hinh' => ['KDSX'=>'Kinh doanh, đầu tư','SXXK'=>'Sản xuất xuất khẩu','GC'=>'Gia công','CX'=>'Chế xuất'],
    'phuong_thuc_vc' => ['P1'=>'Đường không','P2'=>'Đường biển','P3'=>'Đường bộ'],
    'PTTT' => ['TT'=>'T/T','TTR'=>'TTR','COD'=>'COD','LC'=>'L/C'],
    'don_vi_kien' => ['SET'=>'Bộ','DZN'=>'Tá','PCE'=>'Cái/Chiếc'],
    'don_vi_tl' => ['GRM'=>'Gam','KGM'=>'Kilogam','TNE'=>'Tấn'],
];

function renderInput($name, $value, $opts=null){
    $safe = htmlspecialchars((string)$value);
    if ($opts && is_array($opts)){
        echo "<select name=\"" . htmlspecialchars($name) . "\">";
        foreach ($opts as $k => $lab){
            $sel = ($k == $value) ? 'selected' : '';
            echo "<option value=\"" . htmlspecialchars($k) . "\" $sel>" . htmlspecialchars($lab) . "</option>";
        }
        echo "</select>";
        return;
    }
    // detect date
    if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
        echo "<input type=\"date\" name=\"" . htmlspecialchars($name) . "\" value=\"$safe\">";
        return;
    }
    // detect number
    if (is_numeric($value) && $value !== '') {
        echo "<input type=\"number\" step=\"any\" name=\"" . htmlspecialchars($name) . "\" value=\"$safe\">";
        return;
    }
    // default text
    echo "<input type=\"text\" name=\"" . htmlspecialchars($name) . "\" value=\"$safe\">";
}
?>
<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <title>Chỉnh sửa tờ khai xuất khẩu</title>
    <link rel="stylesheet" href="style.css">
    <style>
    .container {
        max-width: 1100px;
        margin: 20px auto;
    }

    .section {
        background: #fff;
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 16px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, .06);
    }

    .h-title {
        color: #0b63a6;
        margin-bottom: 10px;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px 14px;
    }

    .form-row {
        margin-bottom: 8px;
    }

    label {
        display: block;
        font-size: 13px;
        color: #475569;
        margin-bottom: 6px;
    }

    input,
    select,
    textarea {
        width: 100%;
        padding: 8px;
        border-radius: 6px;
        border: 1px solid #d1d7e0;
        background: #fff;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .table th,
    .table td {
        padding: 8px;
        border: 1px solid #e6edf3;
    }

    .table th {
        background: #0b63a6;
        color: #fff;
    }

    .actions {
        margin-top: 12px;
    }

    .btn {
        display: inline-block;
        padding: 10px 14px;
        background: #0b63a6;
        color: #fff;
        border-radius: 6px;
        text-decoration: none;
    }

    .btn.cancel {
        background: #6b7280;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="h-title">✏️ Chỉnh sửa tờ khai xuất khẩu — ID <?= htmlspecialchars($id) ?></h2>

        <form method="POST" action="updateXK.php">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

            <div class="section">
                <h3>Thông tin chung (To1)</h3>
                <div class="grid">
                    <?php
            if ($to1){
                foreach ($to1 as $k => $v){
                    if ($k === 'id') continue;
                    echo "<div class='form-row'><label>" . htmlspecialchars($k) . "</label>";
                    $useOpts = $opts[$k] ?? null;
                    renderInput($k, $v, $useOpts);
                    echo "</div>";
                }
            } else {
                echo "<div>Không có dữ liệu To1.</div>";
            }
            ?>
                </div>
            </div>

            <div class="section">
                <h3>Thông tin hợp đồng / bổ sung (To2)</h3>
                <div class="grid">
                    <?php
            if ($to2){
                foreach ($to2 as $k => $v){
                    if (in_array($k, ['id','to1xk'])) continue;
                    echo "<div class='form-row'><label>" . htmlspecialchars($k) . "</label>";
                    $useOpts = $opts[$k] ?? null;
                    renderInput($k, $v, $useOpts);
                    echo "</div>";
                }
            } else echo "<div>Không có dữ liệu To2.</div>";
            ?>
                </div>
            </div>

            <div class="section">
                <h3>Danh sách hàng (To3)</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <?php if (!empty($items)){ $first = $items[0]; foreach ($first as $k => $v){ if (in_array($k,['id','to1xk'])) continue; echo "<th>" . htmlspecialchars($k) . "</th>"; } } else { echo "<th>Không có hàng</th>"; } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $i => $row): ?>
                        <tr>
                            <?php foreach ($row as $k => $v){
                        if (in_array($k,['id','to1xk'])) continue;
                        // include hidden id field per row so updateXK biết id hàng
                        if ($k === array_key_first($row)) {
                            // put item id hidden once per row after first column
                            echo "<td>";
                            echo "<input type='hidden' name='item_id[]' value='" . htmlspecialchars($row['id'] ?? '') . "'>";
                            echo "<input type='text' name='" . htmlspecialchars($k) . "[]' value='" . htmlspecialchars($v) . "'>";
                            echo "</td>";
                        } else {
                            echo "<td><input type='text' name='" . htmlspecialchars($k) . "[]' value='" . htmlspecialchars($v) . "'></td>";
                        }
                    } ?>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <p style="margin-top:8px;color:#6b7280;font-size:13px;">(Ghi chú: để thêm/xóa dòng, có thể chỉnh trực
                    tiếp trong DB hoặc mình có thể bổ sung JS thêm dòng nếu bạn muốn.)</p>
            </div>

            <div class="actions">
                <button type="submit" class="btn">💾 Lưu thay đổi</button>
                <a class="btn cancel" href="doneXK.php?id=<?= urlencode($id) ?>">Hủy / Quay lại</a>
            </div>

        </form>
    </div>
</body>

</html>