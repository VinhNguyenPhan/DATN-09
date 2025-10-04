<pre>
    <?php
require_once (__DIR__."/../core/database.php");

// gom dữ liệu
$data1 = $_SESSION['To1NK'] ?? [];
$data2 = $_SESSION['To2NK'] ?? [];
$data3 = $_POST; // danh sách hàng

print_r($data1);
// print_r($data2);
// print_r($data3);
function n($v) {
    if ($v === null) return null;
    $v = trim((string)$v);
    return ($v === '') ? null : $v;
}
try {
    // 1) Insert bảng cha to_khai_nhap_khau
    $so_to_khai = uniqid("TKN_");

    $sql = "INSERT INTO to_khai_nhap_khau
    (so_to_khai, nhom_loai_hinh, ma_loai_hinh, phan_loai_to_chuc,
     co_quan_hq, phuong_thuc_vc, ma_phan_loai_hang, ma_bo_phan_xu_ly,
     mst_dn_nk, ma_bc_dn_nk, ten_dn_nk, dia_chi_dn_nk, sdt_dn_nk,
     ten_uy_thac_nk, sdt_uy_thac_nk, dia_chi_uy_thac_nk,
     mst_dn_xk, ma_bc_dn_xk, ten_dn_xk, dia_chi_dn_xk, sdt_dn_xk,
     ten_uy_thac_xk, sdt_uy_thac_xk, dia_chi_uy_thac_xk,
     so_van_don, ngay_van_don, so_luong_kien, don_vi_kien,
     tong_trong_luong, don_vi_tl, ma_dia_diem_luu_kho, dia_diem_luu_kho,
     ky_hieu_bao_bi, so_hieu_tau, phuong_tien_vc, ngay_hang_den,
     dia_diem_do_hang, ma_dd_dohang, dia_diem_xep_hang, ma_dd_xephang,
     so_luong_container, ma_kq_ktnd, ghi_chu_chung)
VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("❌ Prepare failed: " . $conn->error);
}
$nhom_loai_hinh     = n($data1['nhom_loai_hinh'] ?? null);
$ma_loai_hinh       = n($data1['ma_loai_hinh'] ?? null);
$phan_loai_to_chuc  = n($data1['phan_loai_to_chuc'] ?? null);
$co_quan_hq         = n($data1['co_quan_hq'] ?? null);
$phuong_thuc_vc     = n($data1['phuong_thuc_vc'] ?? null);
$ma_phan_loai_hang  = n($data1['ma_phan_loai_hang'] ?? null);
$ma_bo_phan_xu_ly   = n($data1['ma_bo_phan_xu_ly'] ?? null);
$mst_dn_nk          = n($data1['MSTDNNK'] ?? null);
$ma_bc_dn_nk        = n($data1['MBCNK'] ?? null);
$ten_dn_nk          = n($data1['TDNNK'] ?? null);
$dia_chi_dn_nk      = n($data1['DCDNNK'] ?? null);
$sdt_dn_nk          = n($data1['SDTDNNK'] ?? null);
$ten_uy_thac_nk     = n($data1['NUTNK'] ?? null);
$sdt_uy_thac_nk     = n($data1['SDTUTNK'] ?? null);
$dia_chi_uy_thac_nk = n($data1['DCUTNK'] ?? null);
$mst_dn_xk          = n($data1['MSTDNXK'] ?? null);
$ma_bc_dn_xk        = n($data1['MBCXK'] ?? null);
$ten_dn_xk          = n($data1['TDNXK'] ?? null);
$dia_chi_dn_xk      = n($data1['DCDNXK'] ?? null);
$sdt_dn_xk          = n($data1['SDTDNXK'] ?? null);
$ten_uy_thac_xk     = n($data1['NUTXK'] ?? null);
$sdt_uy_thac_xk     = n($data1['SDTUTXK'] ?? null);
$dia_chi_uy_thac_xk = n($data1['DCUTXK'] ?? null);
$so_van_don         = n($data1['SVD'] ?? null);
$ngay_van_don       = n($data1['NVD'] ?? null);
$so_luong_kien      = (int)($data1['SLK'] ?? 0);
$don_vi_kien        = n($data1['don_vi_kien'] ?? null);
$tong_trong_luong   = (float)($data1['TTLH'] ?? 0);
$don_vi_tl          = n($data1['don_vi_tl'] ?? null);
$ma_dia_diem_luu_kho= n($data1['MDDLK'] ?? null);
$dia_diem_luu_kho   = n($data1['dia_diem_luu_kho'] ?? null);
$ky_hieu_bao_bi     = n($data1['KH_SHBB'] ?? null);
$so_hieu_tau        = n($data1['so_hieu_tau'] ?? null);
$phuong_tien_vc     = n($data1['PTVC'] ?? null);
$ngay_hang_den      = n($data1['NHD'] ?? null);
$dia_diem_do_hang   = n($data1['DDDH'] ?? null);
$ma_dd_dohang       = n($data1['ma_dd_dohang'] ?? null);
$dia_diem_xep_hang  = n($data1['DDXH'] ?? null);
$ma_dd_xephang      = n($data1['ma_dd_xephang'] ?? null);
$so_luong_container = (int)($data1['SLCT'] ?? 0);
$ma_kq_ktnd         = n($data1['ma_kq_ktnd'] ?? null);
$ghi_chu_chung      = n($data2['GCC'] ?? null);

$stmt->bind_param(
    "ssssssssssssssssssssssssssissssssssssssisss", 
    $so_to_khai,
    $nhom_loai_hinh,
    $ma_loai_hinh,
    $phan_loai_to_chuc,
    $co_quan_hq,
    $phuong_thuc_vc,
    $ma_phan_loai_hang,
    $ma_bo_phan_xu_ly,
    $mst_dn_nk,
    $ma_bc_dn_nk,
    $ten_dn_nk,
    $dia_chi_dn_nk,
    $sdt_dn_nk,
    $ten_uy_thac_nk,
    $sdt_uy_thac_nk,
    $dia_chi_uy_thac_nk,
    $mst_dn_xk,
    $ma_bc_dn_xk,
    $ten_dn_xk,
    $dia_chi_dn_xk,
    $sdt_dn_xk,
    $ten_uy_thac_xk,
    $sdt_uy_thac_xk,
    $dia_chi_uy_thac_xk,
    $so_van_don,
    $ngay_van_don,
    $so_luong_kien,
    $don_vi_kien,
    $tong_trong_luong,
    $don_vi_tl,
    $ma_dia_diem_luu_kho,
    $dia_diem_luu_kho,
    $ky_hieu_bao_bi,
    $so_hieu_tau,
    $phuong_tien_vc,
    $ngay_hang_den,
    $dia_diem_do_hang,
    $ma_dd_dohang,
    $dia_diem_xep_hang,
    $ma_dd_xephang,
    $so_luong_container,
    $ma_kq_ktnd,
    $ghi_chu_chung
);
$stmt->execute();

    $to_khai_id = $stmt->insert_id;
    $stmt->close();

    // 2) Insert bảng to_khai_bo_sung
$sql = "INSERT INTO to_khai_bo_sung 
    (to_khai_id, ma_vb_pqk, 
     gp_nhap_khau1, gp_nhap_khau11,
     gp_nhap_khau2, gp_nhap_khau22,
     gp_nhap_khau3, gp_nhap_khau33,
     gp_nhap_khau4, gp_nhap_khau44,
     so_tiep_nhan_hd, so_hd, ngay_phat_hanh,
     phuong_thuc_tt, tong_tri_gia, tien_te,
     ct_ktg, nnt)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("❌ Lỗi prepare to_khai_bo_sung: " . $conn->error);
}

$stmt->bind_param(
    "isssssssssss sdss",   // type string
    $to_khai_id,
    $data2['MVBPQK'],
    $data2['GPNK1'],
    $data2['GPNK11'],
    $data2['GPNK2'],
    $data2['GPNK22'],
    $data2['GPNK3'],
    $data2['GPNK33'],
    $data2['GPNK4'],
    $data2['GPNK44'],
    $data2['STNHDDT'],
    $data2['SHD'],
    $data2['NPH'],         // DATE (nếu bạn truyền string dạng yyyy-mm-dd thì dùng 's')
    $data2['PTTT'],
    $data2['TTGHD'],       // DECIMAL -> d
    $data2['TTT'],
    $data2['CTKTG'],
    $data2['NNT']
);

$stmt->execute();
$stmt->close();

    // ========== 3. Insert bảng chi_tiet_hang ==========
    $sql = "INSERT INTO chi_tiet_hang
        (to_khai_id, line_no, ma_hs, ten_hang, don_vi, so_luong, don_gia, tri_gia,
         nuoc_xuat_xu, loai_bao_bi, so_van_don, thue_suat, tien_thue, chung_tu)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);

    // Lấy toàn bộ input dạng mảng (do trùng name nhiều dòng -> PHP thành array)
    $rows = count($data3['HSC'] ?? []);
    for ($i=0; $i < $rows; $i++) {
        $ma_hs = n($data3['HSC'][$i] ?? null);
        $ten_hang = n($data3['TH'][$i] ?? null);
        $don_vi = n($data3['DVT'][$i] ?? null);
        $so_luong = (float)($data3['SL'][$i] ?? 0);
        $don_gia = (float)($data3['GIA'][$i] ?? 0);
        $tri_gia = (float)($data3['VALUE'][$i] ?? $so_luong*$don_gia);
        $nuoc_xuat = n($data3['XX'][$i] ?? null);
        $loai_bao = n($data3['BB'][$i] ?? null);
        $so_van = n($data3['VD'][$i] ?? null);
        $thue_suat = (float)($data3['TS'][$i] ?? 0);
        $tien_thue = (float)($data3['TT'][$i] ?? 0);
        $chung_tu = n($data3['GC'][$i] ?? null);

        $line_no = $i+1;

        $stmt->bind_param("iissssssssssss",
            $to_khai_id, $line_no, $ma_hs, $ten_hang, $don_vi,
            $so_luong, $don_gia, $tri_gia, $nuoc_xuat, $loai_bao,
            $so_van, $thue_suat, $tien_thue, $chung_tu
        );
        $stmt->execute();
    }
    $stmt->close();

    $conn->commit();
    echo "✅ Lưu thành công tờ khai: $so_to_khai";

} catch (Exception $e) {
    $conn->rollback();
    echo "❌ Lỗi: " . $e->getMessage();
}