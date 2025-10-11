<?php
require_once (__DIR__ ."/../core/database.php");

$data1 = $_SESSION['To1NK'] ?? [];
$data2 = $_SESSION['To2NK'] ?? [];
$data3 = $_POST; 

function n($v) {
    if ($v === null) return null;
    $v = trim((string)$v);
    return ($v === '') ? null : $v;
}

$last_id = null;

try {
    $to1nk = "INSERT INTO `to1nk` (
        `nhom_loai_hinh`, `ma_loai_hinh`, `phan_loai_to_chuc`, `co_quan_hq`,
        `phuong_thuc_vc`, `ma_phan_loai_hang`, `ma_bo_phan_xu_ly`, `MSTDNNK`, `MBCNK`,
        `TDNNK`, `DCDNNK`, `SDTDNNK`, `NUTNK`, `SDTUTNK`, `DCUTNK`, `MSTDNXK`, `MBCXK`,
        `TDNXK`, `DCDNXK`, `SDTDNXK`, `NUTXK`, `SDTUTXK`, `DCUTXK`, `SVD`, `NVD`, `SLK`,
        `don_vi_kien`, `TTLH`, `don_vi_tl`, `MDDLK`, `dia_diem_luu_kho`, `KH_SHBB`,
        `so_hieu_tau`, `PTVC`, `NHD`, `DDDH`, `ma_dd_dohang`, `DDXH`, `ma_dd_xephang`,
        `SLCT`, `ma_kq_ktnd`
    ) VALUES (
        '".$data1['nhom_loai_hinh']."', '".$data1['ma_loai_hinh']."', '".$data1['phan_loai_to_chuc']."', '".$data1['co_quan_hq']."',
        '".$data1['phuong_thuc_vc']."', '".$data1['ma_phan_loai_hang']."', '".$data1['ma_bo_phan_xu_ly']."', '".$data1['MSTDNNK']."', '".$data1['MBCNK']."',
        '".$data1['TDNNK']."', '".$data1['DCDNNK']."', '".$data1['SDTDNNK']."', '".$data1['NUTNK']."', '".$data1['SDTUTNK']."', '".$data1['DCUTNK']."',
        '".$data1['MSTDNXK']."', '".$data1['MBCXK']."', '".$data1['TDNXK']."', '".$data1['DCDNXK']."', '".$data1['SDTDNXK']."',
        '".$data1['NUTXK']."', '".$data1['SDTUTXK']."', '".$data1['DCUTXK']."', '".$data1['SVD']."', '".$data1['NVD']."',
        '".$data1['SLK']."', '".$data1['don_vi_kien']."', '".$data1['TTLH']."', '".$data1['don_vi_tl']."', '".$data1['MDDLK']."',
        '".$data1['dia_diem_luu_kho']."', '".$data1['KH_SHBB']."', '".$data1['so_hieu_tau']."', '".$data1['PTVC']."',
        '".$data1['NHD']."', '".$data1['DDDH']."', '".$data1['ma_dd_dohang']."', '".$data1['DDXH']."',
        '".$data1['ma_dd_xephang']."', '".$data1['SLCT']."', '".$data1['ma_kq_ktnd']."'
    )";

    $conn->query($to1nk);
    $last_id = $conn->insert_id; 
} catch (Exception $e) {
    error_log("Lỗi khi thêm to1nk: " . $e->getMessage());
}

try {
    
    $to2nk = "INSERT INTO `to2nk` (
        `to1nk`, `MVBPQK`, `GPNK1`, `GPNK11`, `GPNK2`, `GPNK22`, `GPNK3`, `GPNK33`, `GPNK4`, `GPNK44`, 
        `PLHTHD`, `STNHDDT`, `SHD`, `NPH`, `PTTT`, `MPLHD`, `DKGHD`, `TTGHD`, `MDTHD`, `MPLKTG`, `ML1`, 
        `MDT1`, `PVC1`, `ML2`, `MDT2`, `PBH2`, `CTKTG`, `NNT`, `MLDDNBP`, `MLDDNBP1`, `MNHTTT`, `MaNHTTT`, 
        `NPHHM`, `KHCTHM`, `SCTHM`, `MXDTHNT`, `MNHBL`, `NPHBL`, `KHCTBL`, `SCTBL`, `SDKKBDT1`, `SDK1`, 
        `SDKKBDT2`, `SDK2`, `SDKKBDT3`, `SDK3`, `NDPNK`, `NKHVC`, `DD1`, `ND1`, `NKH1`, `DD2`, `ND2`, `NKH2`, 
        `DD3`, `ND3`, `NKH3`, `DDDVCBT`, `ND11`, `SHD1`, `NBD`, `NKT`, `CT`, `PQLNBCDN`
    ) VALUES (
        '".$last_id."', '".$data2['MVBPQK']."', '".$data2['GPNK1']."', '".$data2['GPNK11']."', '".$data2['GPNK2']."', '".$data2['GPNK22']."', '".$data2['GPNK3']."', '".$data2['GPNK33']."', '".$data2['GPNK4']."', '".$data2['GPNK44']."',
        '".$data2['PLHTHD']."', '".$data2['STNHDDT']."', '".$data2['SHD']."', '".$data2['NPH']."', '".$data2['PTTT']."', '".$data2['MPLHD']."', '".$data2['DKGHD']."', '".$data2['TTGHD']."', '".$data2['MDTHD']."', '".$data2['MPLKTG']."', '".$data2['ML1']."',
        '".$data2['MDT1']."', '".$data2['PVC1']."', '".$data2['ML2']."', '".$data2['MDT2']."', '".$data2['PBH2']."', '".$data2['CTKTG']."', '".$data2['NNT']."', '".$data2['MLDDNBP']."', '".$data2['MLDDNBP1']."', '".$data2['MNHTTT']."', '".$data2['MaNHTTT']."', 
        '".$data2['NPHHM']."', '".$data2['KHCTHM']."', '".$data2['SCTHM']."', '".$data2['MXDTHNT']."', '".$data2['MNHBL']."', '".$data2['NPHBL']."', '".$data2['KHCTBL']."', '".$data2['SCTBL']."', '".$data2['SDKKBDT1']."', '".$data2['SDK1']."', 
        '".$data2['SDKKBDT2']."', '".$data2['SDK2']."', '".$data2['SDKKBDT3']."', '".$data2['SDK3']."', '".$data2['NDPNK']."', '".$data2['NKHVC']."', '".$data2['DD1']."', '".$data2['ND1']."', '".$data2['NKH1']."', '".$data2['DD2']."', '".$data2['ND2']."', '".$data2['NKH2']."', 
        '".$data2['DD3']."', '".$data2['ND3']."', '".$data2['NKH3']."', '".$data2['DDDVCBT']."', '".$data2['ND11']."', '".$data2['SHD1']."', '".$data2['NBD']."', '".$data2['NKT']."', '".$data2['CT']."', '".$data2['PQLNBCDN']."'
    )";
    $conn->query($to2nk);
} catch (Exception $e) {
    error_log("Lỗi khi thêm to2nk: " . $e->getMessage());
}

try {
    
    foreach ($data3['HSC'] as $key => $value) {
        $to3nk = "INSERT INTO `to3nk` (
            `to1nk`, `STK`, `NGAY`, `NK`, `GCC`, `HSC`, `TH`, 
            `DVT`, `SL`, `GIA`, `VALUE`, `XX`, `BB`, 
            `VD`, `TS`, `TT`, `GC`
        ) VALUES (
            '".$last_id."', '".$data3['STK']."', '".$data3['NGAY']."', '".$data3['NK']."', '".$data3['GCC']."', '".$data3['HSC'][$key]."', '".$data3['TH'][$key]."', 
            '".$data3['DVT'][$key]."', '".$data3['SL'][$key]."', '".$data3['GIA'][$key]."', '".$data3['VALUE'][$key]."', '".$data3['XX'][$key]."', '".$data3['BB'][$key]."', 
            '".$data3['VD'][$key]."', '".$data3['TS'][$key]."', '".$data3['TT'][$key]."', '".$data3['GC'][$key]."'
        )";
        $conn->query($to3nk);
    }
} catch (Exception $e) {
    error_log("Lỗi khi thêm to3nk: " . $e->getMessage());
}

if ($last_id) {
    header("Location: done.php?id=" . urlencode($last_id));
    exit();
} else {
    echo "Lỗi: Không lấy được ID to1nk.";
}
?>