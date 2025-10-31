<?php
// editXK.php
require_once(__DIR__ . "/../core/database.php");
if (session_status() === PHP_SESSION_NONE)
    session_start();

if (($_SESSION['role'] ?? '') !== 'admin') {
    http_response_code(403);
    die("Bạn không có quyền truy cập trang chỉnh sửa.");
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if (!$id) {
    http_response_code(400);
    die("Thiếu ID tờ khai!");
}

/* --------------------- Helpers --------------------- */
function h($v)
{
    return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');
}

function renderInput($name, $value, $opts = null)
{
    $safe = h($value);
    if ($opts && is_array($opts)) {
        echo "<select name=\"" . h($name) . "\">";
        foreach ($opts as $k => $lab) {
            $sel = ($k == $value) ? 'selected' : '';
            echo "<option value=\"" . h($k) . "\" $sel>" . h($lab) . "</option>";
        }
        echo "</select>";
        return;
    }
    // detect date yyyy-mm-dd
    if (is_string($value) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
        echo "<input type=\"date\" name=\"" . h($name) . "\" value=\"$safe\">";
        return;
    }
    // detect number
    if ($value !== '' && is_numeric($value)) {
        echo "<input type=\"number\" step=\"any\" name=\"" . h($name) . "\" value=\"$safe\">";
        return;
    }
    // default text
    echo "<input type=\"text\" name=\"" . h($name) . "\" value=\"$safe\">";
}

/**
 * Build câu UPDATE động, bind hết kiểu string cho gọn.
 * @param mysqli $conn
 * @param string $table
 * @param array $data  [col => val]
 * @param array $where [col => val] (AND)
 */
function run_update(mysqli $conn, string $table, array $data, array $where): bool
{
    if (!$data)
        return true;
    $sets = [];
    $vals = [];
    foreach ($data as $c => $v) {
        $sets[] = "`$c` = ?";
        $vals[] = $v;
    }
    $conds = [];
    foreach ($where as $c => $v) {
        $conds[] = "`$c` = ?";
        $vals[] = $v;
    }
    $sql = "UPDATE `$table` SET " . implode(', ', $sets) . " WHERE " . implode(' AND ', $conds) . " LIMIT 1";
    $stmt = $conn->prepare($sql);
    if (!$stmt)
        throw new Exception("Prepare fail: " . $conn->error);
    $types = str_repeat('s', count($vals));
    $stmt->bind_param($types, ...$vals);
    $ok = $stmt->execute();
    if (!$ok)
        throw new Exception("Update `$table` lỗi: " . $stmt->error);
    $stmt->close();
    return true;
}

/* --------------------- Lấy dữ liệu ban đầu --------------------- */
$stmt1 = $conn->prepare("SELECT * FROM to1xk WHERE id = ?");
$stmt1->bind_param("i", $id);
$stmt1->execute();
$to1 = $stmt1->get_result()->fetch_assoc();
$stmt1->close();

$stmt2 = $conn->prepare("SELECT * FROM to2xk WHERE to1xk = ?");
$stmt2->bind_param("i", $id);
$stmt2->execute();
$to2 = $stmt2->get_result()->fetch_assoc();
$stmt2->close();

$stmt3 = $conn->prepare("SELECT * FROM to3xk WHERE to1xk = ? ORDER BY id ASC");
$stmt3->bind_param("i", $id);
$stmt3->execute();
$items = $stmt3->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt3->close();

if (!$to1) {
    http_response_code(404);
    die("Không tìm thấy to1xk id=" . $id);
}

/* --------------------- Options select mẫu --------------------- */
$opts = [
    'nhom_loai_hinh' => ['KDSX' => 'Kinh doanh, đầu tư', 'SXXK' => 'Sản xuất xuất khẩu', 'GC' => 'Gia công', 'CX' => 'Chế xuất'],
    'phuong_thuc_vc' => ['P1' => 'Đường không', 'P2' => 'Đường biển', 'P3' => 'Đường bộ'],
    'PTTT' => ['TT' => 'T/T', 'TTR' => 'TTR', 'COD' => 'COD', 'LC' => 'L/C'],
    'don_vi_kien' => ['SET' => 'Bộ', 'DZN' => 'Tá', 'PCE' => 'Cái/Chiếc'],
    'don_vi_tl' => ['GRM' => 'Gam', 'KGM' => 'Kilogam', 'TNE' => 'Tấn'],
    'tt_thanhtoan' => ['pending' => 'Chưa Thanh Toán', 'done' => 'Đã Thanh Toán'],
];

/* --------------------- Xử lý POST lưu trực tiếp --------------------- */
$errors = [];
$success = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // CSRF nhẹ (tuỳ chọn): bạn có thể bổ sung token nếu đã có hệ thống sẵn
        // if (empty($_POST['_token']) || $_POST['_token'] !== ($_SESSION['_token_editxk'] ?? '')) throw new Exception('CSRF token không hợp lệ.');

        $conn->begin_transaction();

        // --- Chuẩn bị dữ liệu UPDATE to1xk: dựa vào cột đang có trong $to1 (trừ id)
        $to1Cols = array_keys($to1);
        $to1Data = [];
        foreach ($to1Cols as $col) {
            if ($col === 'id')
                continue;
            if (isset($_POST[$col]))
                $to1Data[$col] = $_POST[$col];
        }
        if ($to1Data)
            run_update($conn, 'to1xk', $to1Data, ['id' => $id]);

        // --- UPDATE to2xk nếu có bản ghi
        if ($to2) {
            $to2Cols = array_keys($to2);
            $to2Data = [];
            foreach ($to2Cols as $col) {
                if (in_array($col, ['id', 'to1xk']))
                    continue;
                if (isset($_POST[$col]))
                    $to2Data[$col] = $_POST[$col];
            }
            if ($to2Data)
                run_update($conn, 'to2xk', $to2Data, ['to1xk' => $id]);
        }

        // --- UPDATE từng dòng to3xk theo item_id[]
        // Lấy danh sách cột từ một dòng mẫu, loại bỏ id, to1xk
        $itemCols = [];
        if (!empty($items)) {
            $itemCols = array_keys($items[0]);
            $itemCols = array_values(array_filter($itemCols, fn($c) => !in_array($c, ['id', 'to1xk'])));
        }

        $postedItemIds = $_POST['item_id'] ?? [];
        if (!is_array($postedItemIds))
            $postedItemIds = [];

        foreach ($postedItemIds as $idx => $itemId) {
            $itemId = (int) $itemId;
            if ($itemId <= 0)
                continue;

            $rowData = [];
            foreach ($itemCols as $c) {
                // các input name cho to3 mình đặt dạng {$c}[]
                if (isset($_POST[$c]) && isset($_POST[$c][$idx])) {
                    $rowData[$c] = $_POST[$c][$idx];
                }
            }
            if ($rowData) {
                run_update($conn, 'to3xk', $rowData, ['id' => $itemId, 'to1xk' => $id]);
            }
        }

        $conn->commit();
        $success = "Đã lưu thay đổi thành công.";
        // Refresh lại dữ liệu sau khi lưu để hiển thị đúng giá trị mới
        header("Location: editXK.php?id=" . $id . "&saved=1");
        exit;
    } catch (Throwable $e) {
        $conn->rollback();
        $errors[] = $e->getMessage();
    }
}

// Flash nếu redirect về
if (isset($_GET['saved'])) {
    $success = "Đã lưu thay đổi thành công.";
}

/* --------------------- Lấy lại dữ liệu sau khi lưu (khi không redirect) --------------------- */
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || $errors) {
    // reload vì có thể có thay đổi
    $stmt1 = $conn->prepare("SELECT * FROM to1xk WHERE id = ?");
    $stmt1->bind_param("i", $id);
    $stmt1->execute();
    $to1 = $stmt1->get_result()->fetch_assoc();
    $stmt1->close();

    $stmt2 = $conn->prepare("SELECT * FROM to2xk WHERE to1xk = ?");
    $stmt2->bind_param("i", $id);
    $stmt2->execute();
    $to2 = $stmt2->get_result()->fetch_assoc();
    $stmt2->close();

    $stmt3 = $conn->prepare("SELECT * FROM to3xk WHERE to1xk = ? ORDER BY id ASC");
    $stmt3->bind_param("i", $id);
    $stmt3->execute();
    $items = $stmt3->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt3->close();
}
?>
<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <title>Chỉnh sửa tờ khai xuất khẩu</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background: #f8fafc;
            font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            margin: 0
        }

        .container {
            max-width: 1100px;
            margin: 20px auto;
            padding: 0 16px
        }

        .alert {
            padding: 12px 14px;
            border-radius: 8px;
            margin: 12px 0
        }

        .alert.success {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0
        }

        .alert.error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca
        }

        .section {
            background: #fff;
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 16px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, .06);
            border: 1px solid #e5e7eb
        }

        .h-title {
            color: #0b63a6;
            margin: 8px 0 14px 0;
            font-size: 22px
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px 14px
        }

        .form-row {
            margin-bottom: 8px
        }

        label {
            display: block;
            font-size: 13px;
            color: #475569;
            margin-bottom: 6px
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #d1d7e0;
            background: #fff
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px
        }

        .table th,
        .table td {
            padding: 8px;
            border: 1px solid #e6edf3
        }

        .table th {
            background: #0b63a6;
            color: #fff
        }

        .actions {
            margin-top: 14px;
            display: flex;
            gap: 10px
        }

        .btn {
            display: inline-block;
            padding: 10px 14px;
            background: #0b63a6;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            border: none;
            cursor: pointer
        }

        .btn.cancel {
            background: #6b7280
        }

        .muted {
            color: #6b7280;
            font-size: 13px
        }

        @media (max-width:860px) {
            .grid {
                grid-template-columns: 1fr
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="h-title">✏️ Chỉnh sửa tờ khai xuất khẩu — ID <?= h($id) ?></h2>

        <?php if ($success): ?>
            <div class="alert success">✅
                <?= h($success) ?>
            </div>
        <?php endif; ?>
        <?php if ($errors): ?>
            <div class="alert error">
                <strong>❌ Có lỗi khi lưu:</strong>
                <ul style="margin:6px 0 0 18px">
                    <?php foreach ($errors as $e): ?>
                        <li><?= h($e) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="editXK.php?id=<?= h($id) ?>">
            <!-- Nếu có hệ thống CSRF token, thêm vào đây -->
            <!-- <input type="hidden" name="_token" value="<?= h($_SESSION['_token_editxk'] = bin2hex(random_bytes(16))) ?>">
            -->

            <div class="section">
                <h3>Thông tin chung (To1)</h3>
                <div class="grid">
                    <?php
                    if ($to1) {
                        foreach ($to1 as $k => $v) {
                            if ($k === 'id')
                                continue;
                            echo "<div class='form-row'><label>" . h($k) . "</label>";
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
                    if ($to2) {
                        foreach ($to2 as $k => $v) {
                            if (in_array($k, ['id', 'to1xk']))
                                continue;
                            echo "<div class='form-row'><label>" . h($k) . "</label>";
                            $useOpts = $opts[$k] ?? null;
                            renderInput($k, $v, $useOpts);
                            echo "</div>";
                        }
                    } else {
                        echo "<div>Không có dữ liệu To2.</div>";
                    }
                    ?>
                </div>
            </div>

            <div class="section">
                <h3>Danh sách hàng (To3)</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <?php
                            if (!empty($items)) {
                                $first = $items[0];
                                foreach ($first as $k => $v) {
                                    if (in_array($k, ['to1xk']))
                                        continue; // vẫn hiển thị cột 'id' để tiện tham chiếu
                                    echo "<th>" . h($k) . "</th>";
                                }
                            } else {
                                echo "<th>Không có hàng</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($items)): ?>
                            <?php foreach ($items as $i => $row): ?>
                                <tr>
                                    <?php foreach ($row as $k => $v): ?>
                                        <?php if ($k === 'to1xk')
                                            continue; ?>
                                        <td>
                                            <?php if ($k === 'id'): ?>
                                                <!-- Hiển thị id item + input hidden để update -->
                                                <strong>#<?= h($v) ?></strong> <input type="hidden" name="item_id[]"
                                                    value="<?= h($v) ?>">
                                            <?php else: ?>
                                                <input type="text" name="<?= h($k) ?>[]" value="<?= h($v) ?>">
                                            <?php endif; ?>
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <p class="muted" style="margin-top:8px">
                    Ghi chú: hiện form chỉ cập nhật các dòng đang có. Nếu cần thêm/xóa dòng hàng, mình có thể bổ sung
                    nút JS thêm/xóa.
                </p>
            </div>

            <div class="actions">
                <button type="submit" class="btn">💾 Lưu thay đổi</button>
                <a class="btn cancel" href="hoanThanh.php?id=<?= urlencode((string) $id) ?>">Hủy / Quay lại</a>
            </div>
        </form>
    </div>
</body>

</html>