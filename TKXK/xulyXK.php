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

$last_id = null;

try {
    $to1xk = "INSERT INTO `to1xk`(
        `nhom_loai_hinh`, `MLH`, `PLCNTC`, `CQHQ`, `MHPTVC`, `NKBDK`, 
        `MSTDNXK`, `MBCDNXK`, `TDNXK`, `DCDNXK`, `SDTDNXK`, `TNUTXK`, `SDTNUTXK`, 
        `DCNUTXK`, `MSTDNNK`, `MBCDNNK`, `TDNNK`, `DCDNNK`, `SDTDNNK`, `TNUTNK`, 
        `SDTNUTNK`, `DCNUTNK`, `SVD`, `SLK`, `DVK`, `TTLH`, `DVT`, 
        `MDDLKCTQDK`, `MDDLKCTQ`, `DDNHCC`, `DDNH`, `DDXH`, `DDXH1`, `col_9999`, 
        `PTVC`, `NHDDK`, `KH_SH`, `PLHTHD`, `STNHDDT`, `SHD`, `NPH`, 
        `PTTT`, `MPLHD`, `DKGHD`, `TTGHD`, `MDTTGHD`, `TGHD`, `MDTTGTT`, 
        `MLDDNBP`, `MLDDNBP1`, `STK`, `MNHTTT`, `NPHHM`, `KHCTHM`, `SCTHM`, 
        `MXDTHNT`, `STK2`, `MNHBL`, `NPHBL`, `KHCUBL`, `SCTBL`, `NDPNK`, 
        `NKHVC`, `DD1`, `ND1`, `NKH1`, `DD2`, `ND2`, `NKH2`, 
        `DD3`, `ND3`, `NKH3`, `DDDVCBT`, `ND11`
    ) VALUES (
        '".$data1['nhom_loai_hinh']."','".$data1['MLH']."','".$data1['PLCNTC']."','".$data1['CQHQ']."','".$data1['MHPTVC']."','".$data1['NKBDK']."',
        '".$data1['MSTDNXK']."','".$data1['MBCDNXK']."','".$data1['TDNXK']."','".$data1['DCDNXK']."','".$data1['SDTDNXK']."','".$data1['TNUTXK']."','".$data1['SDTNUTXK']."',
        '".$data1['DCNUTXK']."','".$data1['MSTDNNK']."','".$data1['MBCDNNK']."','".$data1['TDNNK']."','".$data1['DCDNNK']."','".$data1['SDTDNNK']."','".$data1['TNUTNK']."',
        '".$data1['SDTNUTNK']."','".$data1['DCNUTNK']."','".$data1['SVD']."','".$data1['SLK']."','".$data1['DVK']."','".$data1['TTLH']."','".$data1['DVT']."',
        '".$data1['MDDLKCTQDK']."','".$data1['MDDLKCTQ']."','".$data1['DDNHCC']."','".$data1['DDNH']."','".$data1['DDXH']."','".$data1['DDXH1']."','".$data1['col_9999']."',
        '".$data1['PTVC']."','".$data1['NHDDK']."','".$data1['KH_SH']."','".$data1['PLHTHD']."','".$data1['STNHDDT']."','".$data1['SHD']."','".$data1['NPH']."',
        '".$data1['PTTT']."','".$data1['MPLHD']."','".$data1['DKGHD']."','".$data1['TTGHD']."','".$data1['MDTTGHD']."','".$data1['TGHD']."','".$data1['MDTTGTT']."',
        '".$data1['MLDDNBP']."','".$data1['MLDDNBP1']."','".$data1['STK']."','".$data1['MNHTTT']."','".$data1['NPHHM']."','".$data1['KHCTHM']."','".$data1['SCTHM']."',
        '".$data1['MXDTHNT']."','".$data1['STK2']."','".$data1['MNHBL']."','".$data1['NPHBL']."','".$data1['KHCUBL']."','".$data1['SCTBL']."','".$data1['NDPNK']."',
        '".$data1['NKHVC']."','".$data1['DD1']."','".$data1['ND1']."','".$data1['NKH1']."','".$data1['DD2']."','".$data1['ND2']."','".$data1['NKH2']."',
        '".$data1['DD3']."','".$data1['ND3']."','".$data1['NKH3']."','".$data1['DDDVCBT']."','".$data1['ND11']."')";
    $conn->query($to1xk);
    $last_id = $conn->insert_id;
} catch (Exception $e) {
    error_log("Lỗi khi thêm to1xk: " . $e->getMessage());
}

try {
    $to2xk ="INSERT INTO `to2xk`(
        `to1xk`, `MA`, `TEN`, `DC`, `SC1`, `SC2`, `SC3`, 
        `SC4`, `SC5`, `SC6`, `SC7`, `SC8`, `SC9`, `SC10`, `SC11`, 
        `SC12`, `SC13`, `SC14`, `SC15`, `SC16`, `SC17`, `SC18`, `SC19`, 
        `SC20`, `SC21`, `SC22`, `SC23`, `SC24`, `SC25`, `SC26`, `SC27`, 
        `SC28`, `SC29`, `SC30`, `SC31`, `SC32`, `SC33`, `SC34`, `SC35`, 
        `SC36`, `SC37`, `SC38`, `SC39`, `SC40`, `SC41`, `SC42`, `SC43`, 
        `SC44`, `SC45`, `SC46`, `SC47`, `SC48`, `SC49`, `SC50`
    ) VALUES (
        '".$last_id."','".$data2['MA']."','".$data2['TEN']."','".$data2['DC']."','".$data2['SC1']."','".$data2['SC2']."','".$data2['SC3']."',
        '".$data2['SC4']."','".$data2['SC5']."','".$data2['SC6']."','".$data2['SC7']."','".$data2['SC8']."','".$data2['SC9']."','".$data2['SC10']."','".$data2['SC11']."',
        '".$data2['SC12']."','".$data2['SC13']."','".$data2['SC14']."','".$data2['SC15']."','".$data2['SC16']."','".$data2['SC17']."','".$data2['SC18']."','".$data2['SC19']."',
        '".$data2['SC20']."','".$data2['SC21']."','".$data2['SC22']."','".$data2['SC23']."','".$data2['SC24']."','".$data2['SC25']."','".$data2['SC26']."','".$data2['SC27']."',
        '".$data2['SC28']."','".$data2['SC29']."','".$data2['SC30']."','".$data2['SC31']."','".$data2['SC32']."','".$data2['SC33']."','".$data2['SC34']."','".$data2['SC35']."',
        '".$data2['SC36']."','".$data2['SC37']."','".$data2['SC38']."','".$data2['SC39']."','".$data2['SC40']."','".$data2['SC41']."','".$data2['SC42']."','".$data2['SC43']."',
        '".$data2['SC44']."','".$data2['SC45']."','".$data2['SC46']."','".$data2['SC47']."','".$data2['SC48']."','".$data2['SC49']."','".$data2['SC50']."')";
    $conn->query($to2xk);
} catch (Exception $e) {
    error_log("Lỗi khi thêm to2xk: " . $e->getMessage());
}

try {
    foreach ($data3['HSC'] as $key => $value) {
        $to3xk = "INSERT INTO `to3xk` (
            `to1xk`, `STK`, `NGAY`, `NK`, `GCC`, `HSC`, `TH`, 
            `DVT`, `SL`, `GIA`, `VALUE`, `XX`, `BB`, 
            `VD`, `TS`, `TT`, `GC`
        ) VALUES (
            '".$last_id."', '".$data3['STK']."', '".$data3['NGAY']."', '".$data3['NK']."', '".$data3['GCC']."', '".$data3['HSC'][$key]."', '".$data3['TH'][$key]."', 
            '".$data3['DVT'][$key]."', '".$data3['SL'][$key]."', '".$data3['GIA'][$key]."', '".$data3['VALUE'][$key]."', '".$data3['XX'][$key]."', '".$data3['BB'][$key]."', 
            '".$data3['VD'][$key]."', '".$data3['TS'][$key]."', '".$data3['TT'][$key]."', '".$data3['GC'][$key]."')";
        $conn->query($to3xk);
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