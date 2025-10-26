<?php
require_once(__DIR__."/../core/database.php");

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Không tìm thấy ID tờ khai!");
}

$sql1 = "SELECT * FROM to1xk WHERE id = ?";
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param("i", $id);
$stmt1->execute();
$result1 = $stmt1->get_result();
$to1xk = $result1->fetch_assoc();
$stmt1->close();

$sql2 = "SELECT * FROM to2xk WHERE to1xk = ?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("i", $to1xk['id']);
$stmt2->execute();
$result2 = $stmt2->get_result();
$to2xk = $result2->fetch_assoc();

$sql3 = "SELECT * FROM to3xk WHERE to1xk = ?";
$stmt3 = $conn->prepare($sql3);
$stmt3->bind_param("i", $to1xk['id']);
$stmt3->execute();
$result3 = $stmt3->get_result();
$hanghoa = $result3->fetch_all(MYSQLI_ASSOC);
$stmt3->close();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Hoàn thành — Xem tờ khai xuất khẩu</title>
    <link rel="stylesheet" href="style.css?v1.0.3">
    <style>
    input[disabled],
    select[disabled],
    textarea[disabled] {
        background-color: #f8f8f8;
        color: #000;
        border: 1px solid #ccc;
        cursor: not-allowed;
    }

    .container-grid label {
        font-weight: bold;
        display: block;
        margin-bottom: 10px;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 10px;
    }

    .grid input {
        width: 80%;
        padding: 6px 8px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 13px;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2>📄 Hoàn thành — Thông tin tờ khai xuất khẩu</h2>

        <!-- Thông tin chung -->
        <fieldset>
            <legend>Thông tin chung</legend>

            <div class="form-group">
                <label style="width: 220px">Nhóm loại hình:</label>
                <input type="text" disabled
                    value="<?= htmlspecialchars($to1xk['nhom_loai_hinh'] ?? $to1xk['nhom_loai_hinh'] ?? $to1xk['nhom_loai_hinh'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label style="width: 220px">Mã loại hình:</label>
                <input type="text" disabled
                    value="<?= htmlspecialchars($to1xk['MLH'] ?? $to1xk['ma_loai_hinh'] ?? $to1xk['ma_loai_hinh'] ?? '') ?>">
                <label style="width: 180px">Phân loại cá nhân/tổ chức:</label>
                <input type="text" disabled
                    value="<?= htmlspecialchars($to1xk['PLCNTC'] ?? $to1xk['PLCNTC'] ?? $to1xk['PLCNTC'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Cơ quan Hải quan:</label>
                <input type="text" disabled
                    value="<?= htmlspecialchars($to1xk['CQHQ'] ?? $to1xk['CQHQ'] ?? $to1xk['CQHQ'] ?? '') ?>">
                <label style="width: 180px">Mã hiệu phương thức vận chuyển:</label>
                <input type="text" disabled
                    value="<?= htmlspecialchars($to1xk['MHPTVC'] ?? $to1xk['MHPTVC'] ?? $to1xk['MHPTVC'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Ngày khai báo (dự kiến):</label>
                <input type="date" disabled
                    value="<?= htmlspecialchars($to1xk['NKBDK'] ?? $to1xk['NKBDK'] ?? $to1xk['NKBDK'] ?? '') ?>">
            </div>
        </fieldset>

        <!-- Doanh nghiệp xuất khẩu -->
        <fieldset>
            <legend>Thông tin người xuất khẩu</legend>
            <div class="form-group">
                <label>Mã số thuế doanh nghiệp:</label>
                <input type="text" disabled
                    value="<?= htmlspecialchars($to1xk['MSTDNXK'] ?? $to1xk['mst_dnxk'] ?? '') ?>">
                <label style="width: 97px;">Mã bưu chính:</label>
                <input type="text" disabled
                    value="<?= htmlspecialchars($to1xk['MBCDNXK'] ?? $to1xk['MBCDNXK'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Tên doanh nghiệp:</label>
                <input type="text" disabled
                    value="<?= htmlspecialchars($to1xk['TDNXK'] ?? $to1xk['Ten_DN'] ?? $to1xk['TDNXK'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Địa chỉ doanh nghiệp:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['DCDNXK'] ?? $to1xk['DCDNXK'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Số điện thoại doanh nghiệp:</label>
                <input type="text" disabled
                    value="<?= htmlspecialchars($to1xk['SDTDNXK'] ?? $to1xk['SDTDNXK'] ?? '') ?>">
            </div>
        </fieldset>

        <!-- Ủy thác xuất khẩu -->
        <fieldset>
            <legend>Ủy thác xuất khẩu</legend>

            <div class="form-group">
                <label>Tên người ủy thác:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['TNUTXK'] ?? $to1xk['TNUTXK'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Số điện thoại người ủy thác:</label>
                <input type="text" disabled
                    value="<?= htmlspecialchars($to1xk['SDTNUTXK'] ?? $to1xk['SDTNUTXK'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Địa chỉ người ủy thác:</label>
                <input type="text" disabled
                    value="<?= htmlspecialchars($to1xk['DCNUTXK'] ?? $to1xk['DCNUTXK'] ?? '') ?>">
            </div>
        </fieldset>

        <!-- Doanh nghiệp nhập khẩu -->
        <fieldset>
            <legend>Doanh nghiệp nhập khẩu</legend>

            <div class="form-group">
                <label>Mã số thuế doanh nghiệp nhập khẩu:</label>
                <input type="text" disabled
                    value="<?= htmlspecialchars($to1xk['MSTDNNK'] ?? $to1xk['MSTDNNK'] ?? '') ?>">

                <label style="width: 171px;">Mã bưu chính:</label>
                <input type="text" disabled
                    value="<?= htmlspecialchars($to1xk['MBCDNNK'] ?? $to1xk['MBCDNNK'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Tên doanh nghiệp nhập khẩu:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['TDNNK'] ?? $to1xk['TDNNK'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Địa chỉ doanh nghiệp nhập khẩu:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['DCDNNK'] ?? $to1xk['DCDNNK'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Số điện thoại doanh nghiệp nhập khẩu:</label>
                <input type="text" disabled
                    value="<?= htmlspecialchars($to1xk['SDTDNNK'] ?? $to1xk['SDTDNNK'] ?? '') ?>">
            </div>
        </fieldset>

        <!-- Ủy thác nhập khẩu -->
        <fieldset>
            <legend>Ủy thác nhập khẩu</legend>

            <div class="form-group">
                <label>Tên người ủy thác nhập khẩu:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['TNUTNK'] ?? $to1xk['TNUTNK'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Số điện thoại người ủy thác nhập khẩu:</label>
                <input type="text" disabled
                    value="<?= htmlspecialchars($to1xk['SDTNUTNK'] ?? $to1xk['SDTNUTNK'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Địa chỉ người ủy thác nhập khẩu:</label>
                <input type="text" disabled
                    value="<?= htmlspecialchars($to1xk['DCNUTNK'] ?? $to1xk['DCNUTNK'] ?? '') ?>">
            </div>
        </fieldset>

        <!-- Thông tin vận đơn / vận chuyển -->
        <fieldset>
            <legend>Thông tin vận đơn & vận chuyển</legend>

            <div class="form-group">
                <label>Số vận đơn:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['SVD'] ?? $to1xk['SVD'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Số lượng kiện:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['SLK'] ?? $to1xk['SLK'] ?? '') ?>">
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['DVK'] ?? $to1xk['DVK'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Tổng trọng lượng hàng:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['TTLH'] ?? $to1xk['TTLH'] ?? '') ?>">
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['DVT'] ?? $to1xk['DVT'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Mã địa điểm lưu kho hàng chờ thông quan dự kiến:</label>
                <input type="text" disabled
                    value="<?= htmlspecialchars($to1xk['MDDLKCTQDK'] ?? $to1xk['MDDLKCTQDK'] ?? '') ?>">
                <input type="text" disabled
                    value="<?= htmlspecialchars($to1xk['MDDLKCTQ'] ?? $to1xk['MDDLKCTQ'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Địa điểm nhận hàng cuối cùng:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['DDNHCC'] ?? $to1xk['DDNHCC'] ?? '') ?>">
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['DDNH'] ?? $to1xk['DDNH'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Địa điểm xếp hàng:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['DDXH'] ?? $to1xk['DDXH'] ?? '') ?>">
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['DDNH1'] ?? $to1xk['DDNH1'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Phương tiện vận chuyển:</label>
                <input type="text" disabled
                    value="<?= htmlspecialchars($to1xk['col_9999'] ?? $to1xk['col_9999'] ?? '') ?>">
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['PTVC'] ?? $to1xk['PTVC'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Ngày hàng đi dự kiến:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['NHDDK'] ?? $to1xk['NHDDK'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Ký hiệu & số hiệu:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['KH_SH'] ?? $to1xk['KH_SH'] ?? '') ?>">
            </div>
        </fieldset>

        <!-- Hóa đơn & Thanh toán -->
        <fieldset>
            <legend>Hóa đơn & Thanh toán</legend>

            <div class="form-group">
                <label>Phân loại hình thức hóa đơn:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['PLHTHD'] ?? $to1xk['PLHTHD'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Số tiếp nhận hóa đơn điện tử:</label>
                <input type="text" disabled
                    value="<?= htmlspecialchars($to1xk['STNHDDT'] ?? $to1xk['STNHDDT'] ?? '') ?>">
                <label style="padding-left:19px">Số hóa đơn:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['SHD'] ?? $to1xk['SHD'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Ngày phát hành:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['NPH'] ?? $to1xk['NPH'] ?? '') ?>">
                <label style="padding-left:19px">Phương thức thanh toán:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['PTTT'] ?? $to1xk['PTTT'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Mã phân loại hóa đơn:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['MPLHD'] ?? $to1xk['MPLHD'] ?? '') ?>">

                <label style="padding-left:19px">Điều kiện giá hóa đơn:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['DKGHD'] ?? $to1xk['DKGHD'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Tổng trị giá hóa đơn:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['TTGHD'] ?? $to1xk['TTGHD'] ?? '') ?>">
                <label style="padding-left:19px">Mã đồng tiền:</label>
                <input type="text" disabled
                    value="<?= htmlspecialchars($to1xk['MDTTGHD'] ?? $to1xk['MDTTGHD'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Trị giá tính thuế:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['TGHD'] ?? $to1xk['TGHD'] ?? '') ?>">
                <label style="padding-left:19px">Mã đồng tiền (tính thuế):</label>
                <input type="text" disabled
                    value="<?= htmlspecialchars($to1xk['MDTTGTT'] ?? $to1xk['MDTTGTT'] ?? '') ?>">
            </div>
        </fieldset>

        <!-- Ngân hàng & Bảo lãnh -->
        <fieldset>
            <legend>Ngân hàng & Bảo lãnh</legend>

            <div class="form-group">
                <label>Mã lý do đề nghị BP:</label>
                <input type="text" disabled
                    value="<?= htmlspecialchars($to1xk['MLDDNBP'] ?? $to1xk['MLDDNBP'] ?? '') ?>">
                <input type="text" disabled
                    value="<?= htmlspecialchars($to1xk['MLDDNBP1'] ?? $to1xk['MLDDNBP1'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Mã ngân hàng trả thuế thay:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['STK'] ?? $to1xk['STK'] ?? '') ?>">
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['MNHTTT'] ?? $to1xk['MNHTTT'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Năm phát hành hạn mức:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['NPHHM'] ?? $to1xk['NPHHM'] ?? '') ?>">
                <label style="width:auto">Ký hiệu chứng từ hạn mức:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['KHCTHM'] ?? $to1xk['KHCTHM'] ?? '') ?>">
                <label style="width: 219px;">Số chứng từ hạn mức:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['SCTHM'] ?? $to1xk['SCTHM'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Mã xác định thời hạn nộp thuế:</label>
                <input type="text" disabled
                    value="<?= htmlspecialchars($to1xk['MXDTHNT'] ?? $to1xk['MXDTHNT'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Mã ngân hàng bảo lãnh:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['STK2'] ?? $to1xk['STK2'] ?? '') ?>">
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['MNHBL'] ?? $to1xk['MNHBL'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Năm phát hành bảo lãnh:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['NPHBL'] ?? $to1xk['NPHBL'] ?? '') ?>">
                <label style="width:auto">Ký hiệu chứng từ bảo lãnh:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['KHCTBL'] ?? $to1xk['KHCTBL'] ?? '') ?>">
                <label style="width: 219px;">Số chứng từ bảo lãnh:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['SCTBL'] ?? $to1xk['SCTBL'] ?? '') ?>">
            </div>
        </fieldset>

        <!-- Thông tin vận chuyển (ngày nhập kho / khởi hành) -->
        <fieldset>
            <legend>Thông tin vận chuyển</legend>

            <div class="form-group">
                <label>Ngày được phép nhập kho:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['NDPNK'] ?? $to1xk['NDPNK'] ?? '') ?>">
                <label style="width:218px;padding-left:26px;">Ngày khởi hành vận chuyển:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['NKHVC'] ?? $to1xk['NKHVC'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Thông tin trung chuyển:</label>
                <label style="padding-left:75px">Địa điểm</label>
                <label style="padding-left:73px">Ngày đến</label>
                <label style="padding-left:58px">Ngày khởi hành</label>
            </div>
            <div class="form-group">
                <label style="padding-left:192px">(1)</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['DD1'] ?? '') ?>"> <input type="text"
                    disabled value="<?= htmlspecialchars($to1xk['ND1'] ?? '') ?>">
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['NKH1'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label style="padding-left:192px">(2)</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['DD2'] ?? '') ?>"> <input type="text"
                    disabled value="<?= htmlspecialchars($to1xk['ND2'] ?? '') ?>">
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['NKH2'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label style="padding-left:192px">(3)</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['DD3'] ?? '') ?>"> <input type="text"
                    disabled value="<?= htmlspecialchars($to1xk['ND3'] ?? '') ?>">
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['NKH3'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Địa điểm đích vận chuyển bảo thuế:</label>
                <input type="text" disabled
                    value="<?= htmlspecialchars($to1xk['DDDVCBT'] ?? $to1xk['DDDVCBT'] ?? '') ?>">
                <label style="width:218px;padding-left:146px;">Ngày đến:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['ND11'] ?? $to1xk['ND11'] ?? '') ?>">
            </div>
        </fieldset>
        <div>
            <fieldset>
                <h2>Tờ khai xuất khẩu - Thông tin container</h2>
                <h3>Địa điểm xếp hàng lên xe chở hàng</h3>
                <div class="form-group">
                    <label style="width:100px">Mã:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($to1xk['MA'] ?? $to1xk['MA'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label style="width:100px">Tên:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($to1xk['TEN'] ?? $to1xk['TEN'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label style="width:100px">Địa chỉ:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($to1xk['DC'] ?? $to1xk['DC'] ?? '') ?>">
                </div>

                <div class="container-grid">
                    <label>Số Container:</label>
                    <div class="grid">
                        <input type="text" disabled placeholder="1"
                            value="<?= htmlspecialchars($to1xk['SC1'] ?? $to1xk['SC1'] ?? '') ?>">
                        <input type="text" disabled placeholder="2"
                            value="<?= htmlspecialchars($to1xk['SC2'] ?? $to1xk['SC2'] ?? '') ?>">
                        <input type="text" disabled placeholder="3"
                            value="<?= htmlspecialchars($to1xk['SC3'] ?? $to1xk['SC3'] ?? '') ?>">
                        <input type="text" disabled placeholder="4"
                            value="<?= htmlspecialchars($to1xk['SC4'] ?? $to1xk['SC4'] ?? '') ?>">
                        <input type="text" disabled placeholder="5"
                            value="<?= htmlspecialchars($to1xk['SC5'] ?? $to1xk['SC5'] ?? '') ?>">
                        <input type="text" disabled placeholder="6"
                            value="<?= htmlspecialchars($to1xk['SC6'] ?? $to1xk['SC6'] ?? '') ?>">
                        <input type="text" disabled placeholder="7"
                            value="<?= htmlspecialchars($to1xk['SC7'] ?? $to1xk['SC7'] ?? '') ?>">
                        <input type="text" disabled placeholder="8"
                            value="<?= htmlspecialchars($to1xk['SC8'] ?? $to1xk['SC8'] ?? '') ?>">
                        <input type="text" disabled placeholder="9"
                            value="<?= htmlspecialchars($to1xk['SC9'] ?? $to1xk['SC9'] ?? '') ?>">
                        <input type="text" disabled placeholder="10"
                            value="<?= htmlspecialchars($to1xk['SC10'] ?? $to1xk['SC10'] ?? '') ?>">
                        <input type="text" disabled placeholder="11"
                            value="<?= htmlspecialchars($to1xk['SC11'] ?? $to1xk['SC11'] ?? '') ?>">
                        <input type="text" disabled placeholder="12"
                            value="<?= htmlspecialchars($to1xk['SC12'] ?? $to1xk['SC12'] ?? '') ?>">
                        <input type="text" disabled placeholder="13"
                            value="<?= htmlspecialchars($to1xk['SC13'] ?? $to1xk['SC13'] ?? '') ?>">
                        <input type="text" disabled placeholder="14"
                            value="<?= htmlspecialchars($to1xk['SC14'] ?? $to1xk['SC14'] ?? '') ?>">
                        <input type="text" disabled placeholder="15"
                            value="<?= htmlspecialchars($to1xk['SC15'] ?? $to1xk['SC15'] ?? '') ?>">
                        <input type="text" disabled placeholder="16"
                            value="<?= htmlspecialchars($to1xk['SC16'] ?? $to1xk['SC16'] ?? '') ?>">
                        <input type="text" disabled placeholder="17"
                            value="<?= htmlspecialchars($to1xk['SC17'] ?? $to1xk['SC17'] ?? '') ?>">
                        <input type="text" disabled placeholder="18"
                            value="<?= htmlspecialchars($to1xk['SC18'] ?? $to1xk['SC18'] ?? '') ?>">
                        <input type="text" disabled placeholder="19"
                            value="<?= htmlspecialchars($to1xk['SC19'] ?? $to1xk['SC19'] ?? '') ?>">
                        <input type="text" disabled placeholder="20"
                            value="<?= htmlspecialchars($to1xk['SC20'] ?? $to1xk['SC20'] ?? '') ?>">
                        <input type="text" disabled placeholder="21"
                            value="<?= htmlspecialchars($to1xk['SC21'] ?? $to1xk['SC21'] ?? '') ?>">
                        <input type="text" disabled placeholder="22"
                            value="<?= htmlspecialchars($to1xk['SC22'] ?? $to1xk['SC22'] ?? '') ?>">
                        <input type="text" disabled placeholder="23"
                            value="<?= htmlspecialchars($to1xk['SC23'] ?? $to1xk['SC23'] ?? '') ?>">
                        <input type="text" disabled placeholder="24"
                            value="<?= htmlspecialchars($to1xk['SC24'] ?? $to1xk['SC24'] ?? '') ?>">
                        <input type="text" disabled placeholder="25"
                            value="<?= htmlspecialchars($to1xk['SC25'] ?? $to1xk['SC25'] ?? '') ?>">
                        <input type="text" disabled placeholder="26"
                            value="<?= htmlspecialchars($to1xk['SC26'] ?? $to1xk['SC26'] ?? '') ?>">
                        <input type="text" disabled placeholder="27"
                            value="<?= htmlspecialchars($to1xk['SC27'] ?? $to1xk['SC27'] ?? '') ?>">
                        <input type="text" disabled placeholder="28"
                            value="<?= htmlspecialchars($to1xk['SC28'] ?? $to1xk['SC28'] ?? '') ?>">
                        <input type="text" disabled placeholder="29"
                            value="<?= htmlspecialchars($to1xk['SC29'] ?? $to1xk['SC29'] ?? '') ?>">
                        <input type="text" disabled placeholder="30"
                            value="<?= htmlspecialchars($to1xk['SC30'] ?? $to1xk['SC30'] ?? '') ?>">
                        <input type="text" disabled placeholder="31"
                            value="<?= htmlspecialchars($to1xk['SC31'] ?? $to1xk['SC31'] ?? '') ?>">
                        <input type="text" disabled placeholder="32"
                            value="<?= htmlspecialchars($to1xk['SC32'] ?? $to1xk['SC32'] ?? '') ?>">
                        <input type="text" disabled placeholder="33"
                            value="<?= htmlspecialchars($to1xk['SC33'] ?? $to1xk['SC33'] ?? '') ?>">
                        <input type="text" disabled placeholder="34"
                            value="<?= htmlspecialchars($to1xk['SC34'] ?? $to1xk['SC34'] ?? '') ?>">
                        <input type="text" disabled placeholder="35"
                            value="<?= htmlspecialchars($to1xk['SC35'] ?? $to1xk['SC35'] ?? '') ?>">
                        <input type="text" disabled placeholder="36"
                            value="<?= htmlspecialchars($to1xk['SC36'] ?? $to1xk['SC36'] ?? '') ?>">
                        <input type="text" disabled placeholder="37"
                            value="<?= htmlspecialchars($to1xk['SC37'] ?? $to1xk['SC37'] ?? '') ?>">
                        <input type="text" disabled placeholder="38"
                            value="<?= htmlspecialchars($to1xk['SC38'] ?? $to1xk['SC38'] ?? '') ?>">
                        <input type="text" disabled placeholder="39"
                            value="<?= htmlspecialchars($to1xk['SC39'] ?? $to1xk['SC39'] ?? '') ?>">
                        <input type="text" disabled placeholder="40"
                            value="<?= htmlspecialchars($to1xk['SC40'] ?? $to1xk['SC40'] ?? '') ?>">
                        <input type="text" disabled placeholder="41"
                            value="<?= htmlspecialchars($to1xk['SC41'] ?? $to1xk['SC41'] ?? '') ?>">
                        <input type="text" disabled placeholder="42"
                            value="<?= htmlspecialchars($to1xk['SC42'] ?? $to1xk['SC42'] ?? '') ?>">
                        <input type="text" disabled placeholder="43"
                            value="<?= htmlspecialchars($to1xk['SC43'] ?? $to1xk['SC43'] ?? '') ?>">
                        <input type="text" disabled placeholder="44"
                            value="<?= htmlspecialchars($to1xk['SC44'] ?? $to1xk['SC44'] ?? '') ?>">
                        <input type="text" disabled placeholder="45"
                            value="<?= htmlspecialchars($to1xk['SC45'] ?? $to1xk['SC45'] ?? '') ?>">
                        <input type="text" disabled placeholder="46"
                            value="<?= htmlspecialchars($to1xk['SC46'] ?? $to1xk['SC46'] ?? '') ?>">
                        <input type="text" disabled placeholder="47"
                            value="<?= htmlspecialchars($to1xk['SC47'] ?? $to1xk['SC47'] ?? '') ?>">
                        <input type="text" disabled placeholder="48"
                            value="<?= htmlspecialchars($to1xk['SC48'] ?? $to1xk['SC48'] ?? '') ?>">
                        <input type="text" disabled placeholder="49"
                            value="<?= htmlspecialchars($to1xk['SC49'] ?? $to1xk['SC49'] ?? '') ?>">
                        <input type="text" disabled placeholder="50"
                            value="<?= htmlspecialchars($to1xk['SC50'] ?? $to1xk['SC50'] ?? '') ?>">

                    </div>
                </div>
            </fieldset>
            <fieldset>
                <h2>📦 Danh sách hàng hóa</h2>
                <div class="form-group" style="margin-top:8px;">
                    <div style="width:100%;">
                        <table>
                            <thead>
                                <tr>
                                    <th>Mã HS</th>
                                    <th>Tên hàng</th>
                                    <th>ĐVT</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Trị giá</th>
                                    <th>Nước nhập khẩu</th>
                                    <th>Ghi chú</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($hanghoa)): ?>
                                <?php foreach ($hanghoa as $row): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['HSC'] ?? $row['HSC']) ?></td>
                                    <td><?= htmlspecialchars($row['TH'] ?? $row['TH']) ?></td>
                                    <td><?= htmlspecialchars($row['DVT'] ?? $row['DVT']) ?></td>
                                    <td><?= htmlspecialchars($row['SL'] ?? $row['SL']) ?></td>
                                    <td><?= htmlspecialchars($row['GIA'] ?? $row['GIA']) ?></td>
                                    <td><?= htmlspecialchars($row['VALUE'] ?? $row['VALUE']) ?></td>
                                    <td><?= htmlspecialchars($row['XX'] ?? $row['XX']) ?></td>
                                    <td><?= htmlspecialchars($row['GC'] ?? $row['GC']) ?></td>
                                </tr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="8" style="text-align:center;padding:12px;">Không có hàng hóa</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </fieldset>
            <div class="button-group">
                <a href="../index.php" class="btn">⬅ Quay lại trang chủ</a>
            </div>
        </div>
</body>

</html>