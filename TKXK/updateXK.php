<?php
// updateXK.php
require_once(__DIR__ . "/../core/database.php");
if (($_SESSION['role'] ?? '') !== 'admin') {
    die("Bạn không có quyền thực hiện hành động này.");
}

$id = $_POST['id'] ?? null;
if (!$id) die("Thiếu ID tờ khai.");

$conn->begin_transaction();

try {
    // --- CẬP NHẬT to1xk (tự động lấy các field từ POST, trừ id)
    $to1Fields = [];
    $to1Values = [];
    foreach ($_POST as $k => $v) {
        // exclude to2 / to3 fields and special arrays
        if (in_array($k, ['id','item_id'])) continue;
        // fields from to3 are arrays => skip them here (they end with [])
        if (is_array($v)) continue;
        // decide whether field belongs to to1xk table by checking column existence
        // we try to update anyway; we'll build statement using only keys present in DB to avoid errors
        $to1Fields[$k] = $v;
    }

    // build update sql for to1xk: only keys that actually exist as columns
    $colsToUse = [];
    if (!empty($to1Fields)) {
        // get column list of to1xk
        $res = $conn->query("SHOW COLUMNS FROM to1xk");
        $cols = [];
        while ($r = $res->fetch_assoc()) $cols[] = $r['Field'];
        foreach ($to1Fields as $k => $v){
            if (in_array($k, $cols)) {
                $colsToUse[$k] = $v;
            }
        }
    }

    if (!empty($colsToUse)) {
        $sets = [];
        $types = '';
        $vals = [];
        foreach ($colsToUse as $k => $v){
            $sets[] = "`$k` = ?";
            $types .= 's';
            $vals[] = $v;
        }
        $sql = "UPDATE to1xk SET " . implode(", ", $sets) . " WHERE id = ?";
        $stmt = $conn->prepare($sql);
        // bind params dynamic
        $types .= 'i';
        $vals[] = (int)$id;
        $stmt->bind_param($types, ...$vals);
        $stmt->execute();
        $stmt->close();
    }

    // --- CẬP NHẬT to2xk (tương tự)
    $to2Fields = [];
    foreach ($_POST as $k => $v) {
        if (is_array($v)) continue;
        // skip fields that belong to to1 (already used)
        if (array_key_exists($k, $colsToUse)) continue;
        $to2Fields[$k] = $v;
    }

    $res2 = $conn->query("SHOW COLUMNS FROM to2xk");
    $cols2 = [];
    while ($r = $res2->fetch_assoc()) $cols2[] = $r['Field'];
    $colsToUse2 = [];
    foreach ($to2Fields as $k => $v){
        if (in_array($k, $cols2)) $colsToUse2[$k] = $v;
    }

    if (!empty($colsToUse2)) {
        $sets = [];
        $types = '';
        $vals = [];
        foreach ($colsToUse2 as $k => $v){
            $sets[] = "`$k` = ?";
            $types .= 's';
            $vals[] = $v;
        }
        $sql = "UPDATE to2xk SET " . implode(", ", $sets) . " WHERE to1xk = ?";
        $stmt = $conn->prepare($sql);
        $types .= 'i';
        $vals[] = (int)$id;
        $stmt->bind_param($types, ...$vals);
        $stmt->execute();
        $stmt->close();
    }

    // --- CẬP NHẬT to3xk: xóa dòng cũ, insert lại từ các mảng POST
    // find item columns from POST arrays (take keys that have array values)
    $arrayFields = [];
    foreach ($_POST as $k => $v){
        if (is_array($v)){
            $arrayFields[$k] = $v;
        }
    }

    // if there is any HSC[] or TH[] etc
    if (!empty($arrayFields)) {
        // delete old rows
        $del = $conn->prepare("DELETE FROM to3xk WHERE to1xk = ?");
        $del->bind_param("i",$id);
        $del->execute();
        $del->close();

        // determine columns to insert (exclude 'item_id' if present)
        $colsInsert = array_keys($arrayFields);
        // ensure all arrays have same length
        $len = count(reset($arrayFields));
        // build insert SQL
        $colsList = [];
        foreach ($colsInsert as $c) {
            $colsList[] = "`" . $c . "`";
        }
        // always add to1xk column first
        array_unshift($colsList, "`to1xk`");
        $placeholders = '(' . implode(',', array_fill(0, count($colsList), '?')) . ')';
        $sqlIns = "INSERT INTO to3xk (" . implode(',', $colsList) . ") VALUES $placeholders";
        $stmtIns = $conn->prepare($sqlIns);

        for ($i = 0; $i < $len; $i++) {
            $params = [];
            $types = '';
            // to1xk first
            $params[] = $id; $types .= 'i';
            foreach ($colsInsert as $col) {
                $val = $arrayFields[$col][$i] ?? null;
                // store as string; numeric fields still accepted as strings
                $params[] = $val;
                $types .= 's';
            }
            // bind dynamic
            $stmtIns->bind_param($types, ...$params);
            $stmtIns->execute();
        }
        $stmtIns->close();
    }

    $conn->commit();
    header("Location: doneXK.php?id=" . urlencode($id));
    exit();

} catch (Exception $e) {
    $conn->rollback();
    echo "Lỗi khi cập nhật: " . $e->getMessage();
}