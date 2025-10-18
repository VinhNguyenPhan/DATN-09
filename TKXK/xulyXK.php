<?php
require_once (__DIR__ ."/../core/database.php");

$data1 = $_SESSION['To1XK'] ?? [];
$data2 = $_SESSION['To2XK'] ?? [];
$data3 = $_POST; 

function n($v) {
    if ($v === null) return null;
    $v = trim((string)$v);
    return ($v === '') ? null : $v;
}

function insertSafe($conn, $table, $fields, $data) {
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

$last_id = null;

try {
    $fields1 = [
        'nhom_loai_hinh','MLH','PLCNTC','CQHQ','MHPTVC','NKBDK',
        'MSTDNXK','MBCDNXK','TDNXK','DCDNXK','SDTDNXK','TNUTXK','SDTNUTXK',
        'DCNUTXK','MSTDNNK','MBCDNNK','TDNNK','DCDNNK','SDTDNNK','TNUTNK',
        'SDTNUTNK','DCNUTNK','SVD','SLK','DVK','TTLH','DVT',
        'MDDLKCTQDK','MDDLKCTQ','DDNHCC','DDNH','DDXH','DDXH1','col_9999',
        'PTVC','NHDDK','KH_SH','PLHTHD','STNHDDT','SHD','NPH',
        'PTTT','MPLHD','DKGHD','TTGHD','MDTTGHD','TGHD','MDTTGTT',
        'MLDDNBP','MLDDNBP1','STK','MNHTTT','NPHHM','KHCTHM','SCTHM',
        'MXDTHNT','STK2','MNHBL','NPHBL','KHCUBL','SCTBL','NDPNK',
        'NKHVC','DD1','ND1','NKH1','DD2','ND2','NKH2',
        'DD3','ND3','NKH3','DDDVCBT','ND11'
    ];
    insertSafe($conn, 'to1XK', $fields1, $data1);
    $last_id = $conn->insert_id;
} catch (Exception $e) {
    error_log("Lỗi khi thêm to1xk: " . $e->getMessage());
}

try {
    $data2['to1xk'] = $last_id;
    $fields2 = [
        'to1xk', 'MA', 'TEN', 'DC', 'SC1', 'SC2', 'SC3', 
        'SC4', 'SC5', 'SC6', 'SC7', 'SC8', 'SC9', 'SC10', 'SC11', 
        'SC12', 'SC13', 'SC14', 'SC15', 'SC16', 'SC17', 'SC18', 'SC19', 
        'SC20', 'SC21', 'SC22', 'SC23', 'SC24', 'SC25', 'SC26', 'SC27', 
        'SC28', 'SC29', 'SC30', 'SC31', 'SC32', 'SC33', 'SC34', 'SC35', 
        'SC36', 'SC37', 'SC38', 'SC39', 'SC40', 'SC41', 'SC42', 'SC43', 
        'SC44', 'SC45', 'SC46', 'SC47', 'SC48', 'SC49', 'SC50'
    ];
    insertSafe($conn, 'to2XK', $fields2, $data2);
} catch (Exception $e) {
    error_log("Lỗi khi thêm to2xk: " . $e->getMessage());
}

try {
    $fields3 = [
        'to1xk', 'STK', 'NGAY', 'NK', 'GCC', 'HSC', 'TH', 
        'DVT', 'SL', 'GIA', 'VALUE', 'XX', 'BB', 
        'VD', 'TS', 'TT', 'GC'
    ];

    if (!empty($data3['HSC'])) {
        foreach ($data3['HSC'] as $key => $val) {
            $row3 = [
                'to1xk' => $last_id,
                'STK'   => $data3['STK'][$key] ?? '',
                'NGAY'  => $data3['NGAY'][$key] ?? '',
                'NK'    => $data3['NK'][$key] ?? '',
                'GCC'   => $data3['GCC'][$key] ?? '',
                'HSC'   => $data3['HSC'][$key] ?? '',
                'TH'    => $data3['TH'][$key] ?? '',
                'DVT'   => $data3['DVT'][$key] ?? '',
                'SL'    => $data3['SL'][$key] ?? 0,
                'GIA'   => $data3['GIA'][$key] ?? 0,
                'VALUE' => $data3['VALUE'][$key] ?? 0,
                'XX'    => $data3['XX'][$key] ?? '',
                'BB'    => $data3['BB'][$key] ?? '',
                'VD'    => $data3['VD'][$key] ?? '',
                'TS'    => $data3['TS'][$key] ?? '',
                'TT'    => $data3['TT'][$key] ?? '',
                'GC'    => $data3['GC'][$key] ?? ''
            ];
            insertSafe($conn, 'to3XK', $fields3, $row3);
        }
    }
} catch (Exception $e) {
    error_log("Lỗi khi thêm to3xk: " . $e->getMessage());
}

if ($last_id) {
    header("Location: hoanThanh.php?id=" . urlencode($last_id));
    exit();
} else {
    echo "Lỗi: Không lấy được ID to1xk.";
}
?>