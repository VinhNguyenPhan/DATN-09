<?php
require_once(__DIR__ . "/../core/database.php");
if (($_SESSION['role'] ?? '') !== 'admin') {
    die("Bạn không có quyền thực hiện hành động này.");
}

$id = $_POST['id'] ?? null;
if (!$id)
    die("Thiếu ID tờ khai.");

$conn->begin_transaction();

try {
    $to1Fields = [];
    $to1Values = [];
    foreach ($_POST as $k => $v) {
        if (in_array($k, ['id', 'item_id']))
            continue;
        if (is_array($v))
            continue;
        $to1Fields[$k] = $v;
    }
    $colsToUse = [];
    if (!empty($to1Fields)) {
        $res = $conn->query("SHOW COLUMNS FROM to1xk");
        $cols = [];
        while ($r = $res->fetch_assoc())
            $cols[] = $r['Field'];
        foreach ($to1Fields as $k => $v) {
            if (in_array($k, $cols)) {
                $colsToUse[$k] = $v;
            }
        }
    }

    if (!empty($colsToUse)) {
        $sets = [];
        $types = '';
        $vals = [];
        foreach ($colsToUse as $k => $v) {
            $sets[] = "`$k` = ?";
            $types .= 's';
            $vals[] = $v;
        }
        $sql = "UPDATE to1xk SET " . implode(", ", $sets) . " WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $types .= 'i';
        $vals[] = (int) $id;
        $stmt->bind_param($types, ...$vals);
        $stmt->execute();
        $stmt->close();
    }

    $to2Fields = [];
    foreach ($_POST as $k => $v) {
        if (is_array($v))
            continue;
        if (array_key_exists($k, $colsToUse))
            continue;
        $to2Fields[$k] = $v;
    }

    $res2 = $conn->query("SHOW COLUMNS FROM to2xk");
    $cols2 = [];
    while ($r = $res2->fetch_assoc())
        $cols2[] = $r['Field'];
    $colsToUse2 = [];
    foreach ($to2Fields as $k => $v) {
        if (in_array($k, $cols2))
            $colsToUse2[$k] = $v;
    }

    if (!empty($colsToUse2)) {
        $sets = [];
        $types = '';
        $vals = [];
        foreach ($colsToUse2 as $k => $v) {
            $sets[] = "`$k` = ?";
            $types .= 's';
            $vals[] = $v;
        }
        $sql = "UPDATE to2xk SET " . implode(", ", $sets) . " WHERE to1xk = ?";
        $stmt = $conn->prepare($sql);
        $types .= 'i';
        $vals[] = (int) $id;
        $stmt->bind_param($types, ...$vals);
        $stmt->execute();
        $stmt->close();
    }
    $arrayFields = [];
    foreach ($_POST as $k => $v) {
        if (is_array($v)) {
            $arrayFields[$k] = $v;
        }
    }

    if (!empty($arrayFields)) {
        $del = $conn->prepare("DELETE FROM to3xk WHERE to1xk = ?");
        $del->bind_param("i", $id);
        $del->execute();
        $del->close();
        $colsInsert = array_keys($arrayFields);
        $len = count(reset($arrayFields));
        $colsList = [];
        foreach ($colsInsert as $c) {
            $colsList[] = "`" . $c . "`";
        }
        array_unshift($colsList, "`to1xk`");
        $placeholders = '(' . implode(',', array_fill(0, count($colsList), '?')) . ')';
        $sqlIns = "INSERT INTO to3xk (" . implode(',', $colsList) . ") VALUES $placeholders";
        $stmtIns = $conn->prepare($sqlIns);

        for ($i = 0; $i < $len; $i++) {
            $params = [];
            $types = '';
            // to1xk first
            $params[] = $id;
            $types .= 'i';
            foreach ($colsInsert as $col) {
                $val = $arrayFields[$col][$i] ?? null;
                $params[] = $val;
                $types .= 's';
            }
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