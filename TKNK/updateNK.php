<?php
require_once(__DIR__."/../core/database.php");

if (($_SESSION['role'] ?? '') !== 'admin') {
    die("⛔ Bạn không có quyền thực hiện hành động này!");
}

$id = $_POST['id'] ?? null;
if (!$id) die("Thiếu ID!");

$conn->begin_transaction();

try {
    // Cập nhật to1nk
    $stmt1 = $conn->prepare("
        UPDATE to1nk SET 
        nhom_loai_hinh=?, ma_loai_hinh=?, phan_loai_to_chuc=?, co_quan_hq=?,
        phuong_thuc_vc=?, MSTDNNK=?, TDNNK=?, DCDNNK=?, SDTDNNK=?, NHD=?
        WHERE id=?
    ");
    $stmt1->bind_param("ssssssssssi",
        $_POST['nhom_loai_hinh'], $_POST['ma_loai_hinh'], $_POST['phan_loai_to_chuc'], $_POST['co_quan_hq'],
        $_POST['phuong_thuc_vc'], $_POST['MSTDNNK'], $_POST['TDNNK'], $_POST['DCDNNK'], $_POST['SDTDNNK'], $_POST['NHD'],
        $id
    );
    $stmt1->execute();

    // Cập nhật to2nk
    $stmt2 = $conn->prepare("
        UPDATE to2nk SET 
        SHD=?, NPH=?, PTTT=?, MNHTTT=?, SCTBL=?, NPHBL=?
        WHERE to1nk=?
    ");
    $stmt2->bind_param("ssssssi",
        $_POST['SHD'], $_POST['NPH'], $_POST['PTTT'], $_POST['MNHTTT'], $_POST['SCTBL'], $_POST['NPHBL'], $id
    );
    $stmt2->execute();

    // Xóa hàng cũ và thêm lại (to3nk)
    $conn->query("DELETE FROM to3nk WHERE to1nk = $id");
    $stmt3 = $conn->prepare("
        INSERT INTO to3nk (to1nk, HSC, TH, DVT, SL, GIA, VALUE, XX, GC)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    foreach ($_POST['HSC'] as $i => $hs) {
        $stmt3->bind_param("isssddsss", $id,
            $_POST['HSC'][$i], $_POST['TH'][$i], $_POST['DVT'][$i],
            $_POST['SL'][$i], $_POST['GIA'][$i], $_POST['VALUE'][$i],
            $_POST['XX'][$i], $_POST['GC'][$i]
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