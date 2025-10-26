<?php
require_once (__DIR__ ."/../core/database.php");

$data1 = $_SESSION['ToNK']['form1'] ?? [];
$data2 = $_SESSION['ToNK']['form2'] ?? [];
$data3 = $_POST;

function n($v) {
    if ($v === null) return null;
    $v = trim((string)$v);
    return ($v === '') ? null : $v;
}

//mới thêm
function insertSafe($conn, $table, $fields, $data) {
    // Nếu không có dữ liệu thì coi như tất cả đều rỗng
    if (empty($data)) $data = [];

    // Đảm bảo giá trị rỗng vẫn được chèn vào đúng số lượng cột
    $values = [];
    foreach ($fields as $f) {
        $v = isset($data[$f]) ? trim($data[$f]) : '';
        // Nếu muốn để NULL trong SQL thay vì chuỗi rỗng, bạn có thể đổi '' -> NULL ở đây
        $values[] = $conn->real_escape_string($v);
    }

    // Ghép cột và giá trị để chèn
    $sql = "INSERT INTO `$table` (" . implode(',', $fields) . ") VALUES ('" . implode("','", $values) . "')";
    
    // Debug nếu cần
    // echo "<pre>$sql</pre>";

    if (!$conn->query($sql)) {
        throw new Exception("Lỗi khi thêm vào $table: " . $conn->error);
    }
}

//mới thêm, code cũ ở logotest

$last_id = null;

try {
    $fields1 = [
        'nhom_loai_hinh', 'ma_loai_hinh', 'phan_loai_to_chuc', 'co_quan_hq',
        'phuong_thuc_vc', 'ma_phan_loai_hang', 'ma_bo_phan_xu_ly', 'MSTDNNK', 'MBCNK',
        'TDNNK', 'DCDNNK', 'SDTDNNK', 'NUTNK', 'SDTUTNK', 'DCUTNK', 'MSTDNXK', 'MBCXK',
        'TDNXK', 'DCDNXK', 'SDTDNXK', 'NUTXK', 'SDTUTXK', 'DCUTXK', 'SVD', 'NVD', 'SLK',
        'don_vi_kien', 'TTLH', 'don_vi_tl', 'MDDLK', 'dia_diem_luu_kho', 'KH_SHBB',
        'so_hieu_tau', 'PTVC', 'NHD', 'DDDH', 'ma_dd_dohang', 'DDXH', 'ma_dd_xephang',
        'SLCT', 'ma_kq_ktnd'
    ];
    insertSafe($conn, 'to1NK', $fields1, $data1);
    $last_id = $conn->insert_id;
} catch (Exception $e) {
    error_log("Lỗi khi thêm to1nk: " . $e->getMessage());
}

try {
    $data2['to1nk'] = $last_id;
    $fields2 = [
        'to1nk', 'MVBPQK', 'GPNK1', 'GPNK11', 'GPNK2', 'GPNK22', 'GPNK3', 'GPNK33', 'GPNK4', 'GPNK44', 
        'PLHTHD', 'STNHDDT', 'SHD', 'NPH', 'PTTT', 'MPLHD', 'DKGHD', 'TTGHD', 'MDTHD', 'MPLKTG', 'ML1', 
        'MDT1', 'PVC1', 'ML2', 'MDT2', 'PBH2', 'CTKTG', 'NNT', 'MLDDNBP', 'MLDDNBP1', 'MNHTTT', 'MaNHTTT', 
        'NPHHM', 'KHCTHM', 'SCTHM', 'MXDTHNT', 'MNHBL', 'NPHBL', 'KHCTBL', 'SCTBL', 'SDKKBDT1', 'SDK1', 
        'SDKKBDT2', 'SDK2', 'SDKKBDT3', 'SDK3', 'NDPNK', 'NKHVC', 'DD1', 'ND1', 'NKH1', 'DD2', 'ND2', 'NKH2', 
        'DD3', 'ND3', 'NKH3', 'DDDVCBT', 'ND11', 'SHD1', 'NBD', 'NKT', 'CT', 'PQLNBCDN'
    ];
    insertSafe($conn, 'to2NK', $fields2, $data2);
} catch (Exception $e) {
    error_log("Lỗi khi thêm to2nk: " . $e->getMessage());
}

try {
    $fields3 = [
        'to1nk', 'STK', 'NGAY', 'NK', 'GCC', 'HSC', 'TH', 
        'DVT', 'SL', 'GIA', 'VALUE', 'XX', 'BB', 
        'VD', 'TS', 'TT', 'GC'
    ];

    if (!empty($data3['HSC'])) {
        foreach ($data3['HSC'] as $key => $val) {
            $row3 = [
                'to1nk' => $last_id,
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
            insertSafe($conn, 'to3NK', $fields3, $row3);
        }
    }
} catch (Exception $e) {
    error_log("Lỗi khi thêm to3nk: " . $e->getMessage());
}

if ($last_id) {
    $_SESSION['ToNK']['form1'] = [];
    $_SESSION['ToNK']['form2'] = [];
    header("Location: done.php?id=" . urlencode($last_id));
    exit();
} else {
    echo "Lỗi: Không lấy được ID to1nk.";
}
?>