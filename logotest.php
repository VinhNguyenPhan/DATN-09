<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Trang chủ công ty</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <!-- Logo -->
        <div class="logo">
            <a href="index.html">
                <img src="Anh/UNI.png" alt="Logo công ty">
            </a>
        </div>
    </header>
</body>

</html>
<?php
function insertSafe($conn, $table, $fields, $data) { 
    //mới thêm
    if (!$conn->query($sql)) {
    echo "
    <pre>Lỗi SQL ($table): " . $conn->error . "\nCâu lệnh: $sql</pre>";
    throw new Exception($conn->error);
    }
    //mới thêm
    try {
    foreach ($fields as $f) {
    $data[$f] = isset($data[$f]) ? mysqli_real_escape_string($conn, $data[$f]) : '';
    }

    $values = implode("','", array_map(fn($f) => $data[$f], $fields));
    $sql = "INSERT INTO `$table` (" . implode(',', $fields) . ") VALUES ('{$values}')";

    if (!$conn->query($sql)) {
    throw new Exception($conn->error);
    }
    } catch (Exception $e) {
    error_log("❌ Lỗi khi thêm vào bảng `$table`: " . $e->getMessage());
    }
    } 
    ?>