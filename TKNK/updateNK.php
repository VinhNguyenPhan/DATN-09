<?php
require_once(__DIR__ . "/../core/database.php");

if (($_SESSION['role'] ?? '') !== 'admin') {
    die("⛔ Bạn không có quyền thực hiện hành động này!");
}

$id = $_POST['id'] ?? null;
if (!$id)
    die("Thiếu ID!");

$conn->begin_transaction();

try {
    $stmt1 = $conn->prepare("
    UPDATE to1nk SET 
    
    -- Thông tin chung
    nhom_loai_hinh=?, 
    ma_loai_hinh=?, 
    phan_loai_to_chuc=?, 
    co_quan_hq=?,
    phuong_thuc_vc=?,

    -- Người nhập khẩu
    MSTDNNK=?, TDNNK=?, DCDNNK=?, SDTDNNK=?, NHD=?,

    -- Thuế và bảo lãnh
    MLDDNBP=?, MLDDNBP1=?, 
    MNHTTT=?, MaNHTTT=?, 
    NPHHM=?, KHCTHM=?, SCTHM=?, 
    MXDTHNT=?, 
    MNHBL=?, MNHBL1=?, 
    NPHBL=?, KHCTBL=?, SCTBL=?,

    -- Thông tin đính kèm (SDK)
    SDKKBDT1=?, SDK1=?,
    SDKKBDT2=?, SDK2=?,
    SDKKBDT3=?, SDK3=?,

    -- Thông tin vận chuyển
    NDPNK=?, NKHVC=?, 
    DD1=?, ND1=?, NKH1=?,
    DD2=?, ND2=?, NKH2=?,
    DD3=?, ND3=?, NKH3=?,
    DDDVCBT=?, ND11=?,

    -- Thông tin hợp đồng
    SHD1=?, NBD=?, NKT=?,

    -- Thông tin khác
    CT=?, PQLNBCDN=?    

    WHERE id=?
");

    $stmt1->bind_param(
        "sssssssssssssssssssssssssssssssssssssssssssssssi",

        // Thông tin chung
        $_POST['nhom_loai_hinh'],
        $_POST['ma_loai_hinh'],
        $_POST['phan_loai_to_chuc'],
        $_POST['co_quan_hq'],
        $_POST['phuong_thuc_vc'],

        // Người nhập khẩu
        $_POST['MSTDNNK'],
        $_POST['TDNNK'],
        $_POST['DCDNNK'],
        $_POST['SDTDNNK'],
        $_POST['NHD'],

        // Thuế và bảo lãnh
        $_POST['MLDDNBP'],
        $_POST['MLDDNBP1'],
        $_POST['MNHTTT'],
        $_POST['MaNHTTT'],
        $_POST['NPHHM'],
        $_POST['KHCTHM'],
        $_POST['SCTHM'],
        $_POST['MXDTHNT'],
        $_POST['MNHBL'],
        $_POST['MNHBL1'],
        $_POST['NPHBL'],
        $_POST['KHCTBL'],
        $_POST['SCTBL'],

        // Đính kèm
        $_POST['SDKKBDT1'],
        $_POST['SDK1'],
        $_POST['SDKKBDT2'],
        $_POST['SDK2'],
        $_POST['SDKKBDT3'],
        $_POST['SDK3'],

        // Vận chuyển
        $_POST['NDPNK'],
        $_POST['NKHVC'],
        $_POST['DD1'],
        $_POST['ND1'],
        $_POST['NKH1'],
        $_POST['DD2'],
        $_POST['ND2'],
        $_POST['NKH2'],
        $_POST['DD3'],
        $_POST['ND3'],
        $_POST['NKH3'],
        $_POST['DDDVCBT'],
        $_POST['ND11'],

        // Hợp đồng
        $_POST['SHD1'],
        $_POST['NBD'],
        $_POST['NKT'],

        // Khác
        $_POST['CT'],
        $_POST['PQLNBCDN'],

        $id
    );
    $stmt1->execute();

    $stmt2 = $conn->prepare("
        UPDATE to2nk SET 
         MVBPQK=?, 
        GPNK1=?, GPNK11=?, 
        GPNK2=?, GPNK22=?, 
        GPNK3=?, GPNK33=?, 
        GPNK4=?, GPNK44=?,

        -- Hóa đơn thương mại
        PLHTHD=?, STNHDDT=?, SHD=?, NPH=?, 
        PTTT=?, MPLHD=?, DKGHD=?, TTGHD=?, MDTHD=?,

        -- Tờ khai trị giá
        MPLKTG=?, 
        ML1=?, MDT1=?, PVC1=?, 
        ML2=?, MDT2=?, PBH2=?, 
        CTKTG=?, NNT=?,

        -- Thuế và bảo lãnh
        MLDDNBP=?, MLDDNBP1=?, 
        MNHTTT=?, MaNHTTT=?, 
        NPHHM=?, KHCTHM=?, SCTHM=?, 
        MXDTHNT=?, 
        MNHBL=?, MNHBL_select=?, 
        NPHBL=?, KHCTBL=?, SCTBL=?,

        -- Thông tin đính kèm
        SDKKBDT1=?, SDK1=?, 
        SDKKBDT2=?, SDK2=?, 
        SDKKBDT3=?, SDK3=?,

        -- Thông tin vận chuyển
        NDPNK=?, NKHVC=?, 
        DD1=?, ND1=?, NKH1=?,
        DD2=?, ND2=?, NKH2=?,
        DD3=?, ND3=?, NKH3=?,
        DDDVCBT=?, ND11=?
        WHERE to1nk=?
    ");
    $stmt2->bind_param(
        "ssssssssssssssssssssssssssssssssssssssssssssssssssssssi",

        // Thông tin chung 2
        $_POST['MVBPQK'],
        $_POST['GPNK1'],
        $_POST['GPNK11'],
        $_POST['GPNK2'],
        $_POST['GPNK22'],
        $_POST['GPNK3'],
        $_POST['GPNK33'],
        $_POST['GPNK4'],
        $_POST['GPNK44'],

        // Hóa đơn thương mại
        $_POST['PLHTHD'],
        $_POST['STNHDDT'],
        $_POST['SHD'],
        $_POST['NPH'],
        $_POST['PTTT'],
        $_POST['MPLHD'],
        $_POST['DKGHD'],
        $_POST['TTGHD'],
        $_POST['MDTHD'],

        // Tờ khai trị giá
        $_POST['MPLKTG'],
        $_POST['ML1'],
        $_POST['MDT1'],
        $_POST['PVC1'],
        $_POST['ML2'],
        $_POST['MDT2'],
        $_POST['PBH2'],
        $_POST['CTKTG'],
        $_POST['NNT'],

        // Thuế và bảo lãnh
        $_POST['MLDDNBP'],
        $_POST['MLDDNBP1'],
        $_POST['MNHTTT'],
        $_POST['MaNHTTT'],
        $_POST['NPHHM'],
        $_POST['KHCTHM'],
        $_POST['SCTHM'],
        $_POST['MXDTHNT'],
        $_POST['MNHBL'],
        $_POST['MNHBL_select'],
        $_POST['NPHBL'],
        $_POST['KHCTBL'],
        $_POST['SCTBL'],

        // Thông tin đính kèm
        $_POST['SDKKBDT1'],
        $_POST['SDK1'],
        $_POST['SDKKBDT2'],
        $_POST['SDK2'],
        $_POST['SDKKBDT3'],
        $_POST['SDK3'],

        // Thông tin vận chuyển
        $_POST['NDPNK'],
        $_POST['NKHVC'],
        $_POST['DD1'],
        $_POST['ND1'],
        $_POST['NKH1'],
        $_POST['DD2'],
        $_POST['ND2'],
        $_POST['NKH2'],
        $_POST['DD3'],
        $_POST['ND3'],
        $_POST['NKH3'],
        $_POST['DDDVCBT'],
        $_POST['ND11'],

        $id
    );
    $stmt2->execute();
    $conn->query("DELETE FROM to3nk WHERE to1nk = $id");
    $stmt3 = $conn->prepare("
        INSERT INTO to3nk (to1nk, HSC, TH, DVT, SL, GIA, VALUE, XX, GC)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    foreach ($_POST['HSC'] as $i => $hs) {
        $stmt3->bind_param(
            "isssddsss",
            $id,
            $_POST['HSC'][$i],
            $_POST['TH'][$i],
            $_POST['DVT'][$i],
            $_POST['SL'][$i],
            $_POST['GIA'][$i],
            $_POST['VALUE'][$i],
            $_POST['XX'][$i],
            $_POST['GC'][$i]
        );
        $stmt3->execute();
    }

    $conn->commit();
    header("Location: done.php?id=" . urlencode($id));
    exit();

} catch (Exception $e) {
    $conn->rollback();
    echo "❌ Lỗi cập nhật: " . $e->getMessage();
}
?>