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
    <style>
    /* CSS chuẩn (copy từ file chuẩn bạn đã cung cấp) */
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        line-height: 1.3;
        font-size: 14px;
        color: #333;
        padding: 20px;
    }

    .container {
        width: 1000px;
        margin: 30px auto;
        background: #fff;
        border: 1px solid #ccc;
        padding: 20px 30px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: #003399;
        margin: 20px 0 18px 0;
    }

    fieldset {
        margin: 16px 0;
        padding: 14px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    legend {
        font-weight: bold;
        padding: 0 10px;
    }

    .form-group {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        margin: 10px 0;
        gap: 10px;
    }

    .form-group label {
        width: 219px;
        font-weight: bold;
    }

    /* Ô hiển thị dữ liệu thay cho input/select */
    .data-view {
        flex: 1;
        min-width: 200px;
        padding: 6px;
        border: 1px solid #aaa;
        border-radius: 3px;
        background-color: #fafafa;
    }

    /* Các trường hiển thị ngắn (nếu cần) */
    .data-view.small {
        max-width: 240px;
    }

    .radio-view {
        display: flex;
        gap: 12px;
        align-items: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        background: #fff;
    }

    th,
    td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: left;
    }

    th {
        background: #003399;
        color: #fff;
        text-align: center;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .button-group {
        text-align: center;
        margin-top: 20px;
    }

    .btn,
    button {
        padding: 10px 20px;
        margin: 5px;
        font-weight: bold;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        color: #fff;
        background-color: #337ab7;
        transition: background-color 0.2s;
        text-decoration: none;
        display: inline-block;
    }

    .btn:hover,
    button:hover {
        background-color: #286090;
    }

    .red {
        background-color: #d9534f;
    }

    .red:hover {
        background-color: #c9302c;
    }

    /* Responsive nhỏ gọn */
    @media (max-width: 1100px) {
        .container {
            width: 94%;
            padding: 16px;
        }

        .form-group label {
            width: 170px;
        }
    }

    @media (max-width: 700px) {
        .form-group label {
            width: 100%;
        }

        .data-view {
            width: 100%;
        }
    }

    /* === FORM STYLE ĐỒNG BỘ VỚI to1XK.php === */
    /* === FORM STYLE ĐỒNG BỘ CHUẨN NHƯ to1XK.php === */

    form {
        display: flex;
        flex-direction: column;
        gap: 25px;
        background: #fff;
        padding: 20px 25px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    /* Fieldset section */
    fieldset {
        border: 1px solid #d8e1eb;
        border-radius: 10px;
        padding: 18px 22px 22px;
        background: #f9fcff;
    }

    legend {
        font-weight: 700;
        color: #114b8a;
        padding: 0 10px;
        font-size: 16px;
    }

    /* Grid layout 2 cột label - input đều nhau */
    .field-row {
        display: grid;
        grid-template-columns: 200px 1fr 200px 1fr;
        gap: 12px 18px;
        align-items: center;
        margin-bottom: 10px;
    }

    /* Label style */
    label {
        font-weight: 600;
        color: #333;
        white-space: nowrap;
        font-size: 15px;
    }

    /* Input, Select, Textarea đồng bộ chiều cao, padding, border */
    input[type="text"],
    input[type="number"],
    input[type="date"],
    select,
    textarea {
        display: block;
        width: 100%;
        height: 44px !important;
        /* Ép cứng chiều cao */
        padding: 8px 12px !important;
        /* Giống form gốc */
        border: 1px solid #c3d3e0;
        border-radius: 6px;
        background-color: #ffffff;
        font-size: 15px;
        color: #333;
        box-sizing: border-box;
        transition: all 0.2s ease;
    }

    textarea {
        min-height: 90px !important;
        resize: vertical;
    }

    /* Focus effect */
    input:focus,
    select:focus,
    textarea:focus {
        border-color: #1f6fb2;
        outline: none;
        box-shadow: 0 0 0 2px rgba(31, 111, 178, 0.15);
    }

    /* Đảm bảo đều hàng ngang */
    .field-row input,
    .field-row select,
    .field-row textarea {
        width: 100%;
    }

    /* Các section cách nhau đều */
    fieldset+fieldset {
        margin-top: 15px;
    }

    /* Nút bấm */
    button,
    .btn {
        display: inline-block;
        background-color: #1f6fb2;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 9px 20px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    button:hover,
    .btn:hover {
        background-color: #145281;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2>📄 Hoàn thành — Thông tin tờ khai xuất khẩu</h2>

        <!-- Thông tin chung -->
        <fieldset>
            <legend>Thông tin chung</legend>

            <div class="form-group"><label style="width: 240px">Nhóm loại hình:</label>
                <div class="data-view">
                    <?= htmlspecialchars($to1xk['nhom_loai_hinh'] ?? $to1xk['nhom_loai_hinh'] ?? $to1xk['nhom_loai_hinh'] ?? '') ?>
                </div>
            </div>

            <div class="form-group">
                <label>Mã loại hình:</label>
                <div class="data-view">
                    <?= htmlspecialchars($to1xk['MLH'] ?? $to1xk['ma_loai_hinh'] ?? $to1xk['ma_loai_hinh'] ?? '') ?>
                </div>

                <label style="width: 240px">Phân loại cá nhân/tổ chức:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['PLCNTC'] ?? $to1xk['PLCNTC'] ?? '') ?></div>
            </div>

            <div class="form-group">
                <label>Cơ quan Hải quan:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['CQHQ'] ?? $to1xk['CQHQ'] ?? '') ?></div>

                <label style="width: 240px">Mã hiệu phương thức vận chuyển:</label>
                <div class="data-view">
                    <?= htmlspecialchars($to1xk['MHPTVC1'] ?? $to1xk['MHPTVC'] ?? $to1xk['col_9999'] ?? '') ?></div>
            </div>

            <div class="form-group">
                <label>Ngày khai báo (dự kiến):</label>
                <div class="data-view small"><?= htmlspecialchars($to1xk['NKBDK'] ?? $to1xk['NKBDK'] ?? '') ?></div>
            </div>
        </fieldset>

        <!-- Doanh nghiệp xuất khẩu -->
        <fieldset>
            <legend>Doanh nghiệp xuất khẩu</legend>

            <div class="form-group">
                <label>Mã số thuế doanh nghiệp:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['MSTDNXK'] ?? $to1xk['mst_dnxk'] ?? '') ?></div>

                <label style="width: 97px;">Mã bưu chính:</label>
                <div class="data-view small"><?= htmlspecialchars($to1xk['MBCDNXK'] ?? $to1xk['MBCDNXK'] ?? '') ?></div>
            </div>

            <div class="form-group">
                <label>Tên doanh nghiệp:</label>
                <div class="data-view">
                    <?= htmlspecialchars($to1xk['TDNXK'] ?? $to1xk['Ten_DN'] ?? $to1xk['TDNXK'] ?? '') ?></div>
            </div>

            <div class="form-group">
                <label>Địa chỉ doanh nghiệp:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['DCDNXK'] ?? $to1xk['DCDNXK'] ?? '') ?></div>
            </div>

            <div class="form-group">
                <label>Số điện thoại doanh nghiệp:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['SDTDNXK'] ?? $to1xk['SDTDNXK'] ?? '') ?></div>
            </div>
        </fieldset>

        <!-- Ủy thác xuất khẩu -->
        <fieldset>
            <legend>Ủy thác xuất khẩu</legend>

            <div class="form-group">
                <label>Tên người ủy thác:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['TNUTXK'] ?? $to1xk['TNUTXK'] ?? '') ?></div>
            </div>

            <div class="form-group">
                <label>Số điện thoại người ủy thác:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['SDTNUTXK'] ?? $to1xk['SDTNUTXK'] ?? '') ?></div>
            </div>

            <div class="form-group">
                <label>Địa chỉ người ủy thác:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['DCNUTXK'] ?? $to1xk['DCNUTXK'] ?? '') ?></div>
            </div>
        </fieldset>

        <!-- Doanh nghiệp nhập khẩu -->
        <fieldset>
            <legend>Doanh nghiệp nhập khẩu</legend>

            <div class="form-group">
                <label>Mã số thuế doanh nghiệp nhập khẩu:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['MSTDNNK'] ?? $to1xk['MSTDNNK'] ?? '') ?></div>

                <label style="width: 171px;">Mã bưu chính:</label>
                <div class="data-view small"><?= htmlspecialchars($to1xk['MBCDNNK'] ?? $to1xk['MBCDNNK'] ?? '') ?></div>
            </div>

            <div class="form-group">
                <label>Tên doanh nghiệp nhập khẩu:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['TDNNK'] ?? $to1xk['TDNNK'] ?? '') ?></div>
            </div>

            <div class="form-group">
                <label>Địa chỉ doanh nghiệp nhập khẩu:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['DCDNNK'] ?? $to1xk['DCDNNK'] ?? '') ?></div>
            </div>

            <div class="form-group">
                <label>Số điện thoại doanh nghiệp nhập khẩu:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['SDTDNNK'] ?? $to1xk['SDTDNNK'] ?? '') ?></div>
            </div>
        </fieldset>

        <!-- Ủy thác nhập khẩu -->
        <fieldset>
            <legend>Ủy thác nhập khẩu</legend>

            <div class="form-group">
                <label>Tên người ủy thác nhập khẩu:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['TNUTNK'] ?? $to1xk['TNUTNK'] ?? '') ?></div>
            </div>

            <div class="form-group">
                <label>Số điện thoại người ủy thác nhập khẩu:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['SDTNUTNK'] ?? $to1xk['SDTNUTNK'] ?? '') ?></div>
            </div>

            <div class="form-group">
                <label>Địa chỉ người ủy thác nhập khẩu:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['DCNUTNK'] ?? $to1xk['DCNUTNK'] ?? '') ?></div>
            </div>
        </fieldset>

        <!-- Thông tin vận đơn / vận chuyển -->
        <fieldset>
            <legend>Thông tin vận đơn & vận chuyển</legend>

            <div class="form-group">
                <label>Số vận đơn:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['SVD'] ?? $to1xk['SVD'] ?? '') ?></div>
            </div>

            <div class="form-group">
                <label>Số lượng kiện:</label>
                <div class="data-view small"><?= htmlspecialchars($to1xk['SLK'] ?? $to1xk['SLK'] ?? '') ?></div>

                <label style="width: auto;">Đơn vị kiện:</label>
                <div class="data-view small"><?= htmlspecialchars($to1xk['DVK'] ?? $to1xk['DVK'] ?? '') ?></div>
            </div>

            <div class="form-group">
                <label>Tổng trọng lượng hàng:</label>
                <div class="data-view small"><?= htmlspecialchars($to1xk['TTLH'] ?? $to1xk['TTLH'] ?? '') ?></div>

                <label style="width: auto;">Đơn vị tính:</label>
                <div class="data-view small"><?= htmlspecialchars($to1xk['DVT'] ?? $to1xk['DVT'] ?? '') ?></div>
            </div>

            <div class="form-group">
                <label>Mã địa điểm lưu kho hàng chờ thông quan dự kiến:</label>
                <div class="data-view small"><?= htmlspecialchars($to1xk['MDDLKCTQDK'] ?? $to1xk['MDDLKCTQDK'] ?? '') ?>
                </div>

                <label style="width: auto;">Địa điểm lưu kho:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['MDDLKCTQ'] ?? $to1xk['MDDLKCTQ'] ?? '') ?></div>
            </div>

            <div class="form-group">
                <label>Địa điểm nhận hàng cuối cùng:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['DDNHCC'] ?? $to1xk['DDNHCC'] ?? '') ?></div>

                <label style="width: auto;">Địa điểm:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['DDNH'] ?? $to1xk['DDNH'] ?? '') ?></div>
            </div>

            <div class="form-group">
                <label>Địa điểm xếp hàng:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['DDXH'] ?? $to1xk['DDXH'] ?? '') ?></div>

                <label style="width: auto;">Ghi chú địa điểm:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['DDNH1'] ?? $to1xk['DDNH1'] ?? '') ?></div>
            </div>

            <div class="form-group">
                <label>Phương tiện vận chuyển (9999 nếu tàu):</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['col_9999'] ?? $to1xk['col_9999'] ?? '') ?></div>

                <label style="width: auto;">Phương tiện:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['PTVC'] ?? $to1xk['PTVC'] ?? '') ?></div>
            </div>

            <div class="form-group">
                <label>Ngày hàng đi dự kiến:</label>
                <div class="data-view small"><?= htmlspecialchars($to1xk['NHDDK'] ?? $to1xk['NHDDK'] ?? '') ?></div>

                <label style="width: auto;">Ký hiệu & số hiệu:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['KH_SH'] ?? $to1xk['KH_SH'] ?? '') ?></div>
            </div>
        </fieldset>

        <!-- Hóa đơn & Thanh toán -->
        <fieldset>
            <legend>Hóa đơn & Thanh toán</legend>

            <div class="form-group">
                <label>Phân loại hình thức hóa đơn:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['PLHTHD'] ?? $to1xk['PLHTHD'] ?? '') ?></div>
            </div>

            <div class="form-group">
                <label>Số tiếp nhận hóa đơn điện tử:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['STNHDDT'] ?? $to1xk['STNHDDT'] ?? '') ?></div>

                <label style="padding-left:19px">Số hóa đơn:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['SHD'] ?? $to1xk['SHD'] ?? '') ?></div>
            </div>

            <div class="form-group">
                <label>Ngày phát hành:</label>
                <div class="data-view small"><?= htmlspecialchars($to1xk['NPH'] ?? $to1xk['NPH'] ?? '') ?></div>

                <label style="padding-left:19px">Phương thức thanh toán:</label>
                <div class="data-view small"><?= htmlspecialchars($to1xk['PTTT'] ?? $to1xk['PTTT'] ?? '') ?></div>
            </div>

            <div class="form-group">
                <label>Mã phân loại hóa đơn:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['MPLHD'] ?? $to1xk['MPLHD'] ?? '') ?></div>

                <label style="padding-left:19px">Điều kiện giá hóa đơn:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['DKGHD'] ?? $to1xk['DKGHD'] ?? '') ?></div>
            </div>

            <div class="form-group">
                <label>Tổng trị giá hóa đơn:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['TTGHD'] ?? $to1xk['TTGHD'] ?? '') ?></div>

                <label style="padding-left:19px">Mã đồng tiền:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['MDTTGHD'] ?? $to1xk['MDTTGHD'] ?? '') ?></div>
            </div>

            <div class="form-group">
                <label>Trị giá tính thuế:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['TGHD'] ?? $to1xk['TGHD'] ?? '') ?></div>

                <label style="padding-left:19px">Mã đồng tiền (tính thuế):</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['MDTTGTT'] ?? $to1xk['MDTTGTT'] ?? '') ?></div>
            </div>
        </fieldset>

        <!-- Ngân hàng & Bảo lãnh -->
        <fieldset>
            <legend>Ngân hàng & Bảo lãnh</legend>

            <div class="form-group">
                <label>Mã lý do đề nghị BP:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['MLDDNBP'] ?? $to1xk['MLDDNBP'] ?? '') ?></div>

                <label style="width:auto">Chi tiết lý do:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['MLDDNBP1'] ?? $to1xk['MLDDNBP1'] ?? '') ?></div>
            </div>

            <div class="form-group">
                <label>Mã ngân hàng trả thuế thay:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['STK'] ?? $to1xk['STK'] ?? '') ?></div>

                <label style="width:auto">Tên ngân hàng:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['MNHTTT'] ?? $to1xk['MNHTTT'] ?? '') ?></div>
            </div>

            <div class="form-group">
                <label>Năm phát hành hạn mức:</label>
                <div class="data-view small"><?= htmlspecialchars($to1xk['NPHHM'] ?? $to1xk['NPHHM'] ?? '') ?></div>

                <label style="width:auto">Ký hiệu chứng từ hạn mức:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['KHCTHM'] ?? $to1xk['KHCTHM'] ?? '') ?></div>

                <label style="width:auto">Số chứng từ hạn mức:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['SCTHM'] ?? $to1xk['SCTHM'] ?? '') ?></div>
            </div>

            <div class="form-group">
                <label>Mã xác định thời hạn nộp thuế:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['MXDTHNT'] ?? $to1xk['MXDTHNT'] ?? '') ?></div>
            </div>

            <div class="form-group">
                <label>Mã ngân hàng bảo lãnh:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['STK2'] ?? $to1xk['STK2'] ?? '') ?></div>

                <label style="width:auto">Tên ngân hàng bảo lãnh:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['MNHBL'] ?? $to1xk['MNHBL'] ?? '') ?></div>
            </div>

            <div class="form-group">
                <label>Năm phát hành bảo lãnh:</label>
                <div class="data-view small"><?= htmlspecialchars($to1xk['NPHBL'] ?? $to1xk['NPHBL'] ?? '') ?></div>

                <label style="width:auto">Ký hiệu chứng từ bảo lãnh:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['KHCTBL'] ?? $to1xk['KHCTBL'] ?? '') ?></div>

                <label style="width:auto">Số chứng từ bảo lãnh:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['SCTBL'] ?? $to1xk['SCTBL'] ?? '') ?></div>
            </div>
        </fieldset>

        <!-- Thông tin vận chuyển (ngày nhập kho / khởi hành) -->
        <fieldset>
            <legend>Thông tin vận chuyển</legend>

            <div class="form-group">
                <label>Ngày được phép nhập kho:</label>
                <div class="data-view small"><?= htmlspecialchars($to1xk['NDPNK'] ?? $to1xk['NDPNK'] ?? '') ?></div>

                <label style="width:218px;padding-left:26px;">Ngày khởi hành vận chuyển:</label>
                <div class="data-view small"><?= htmlspecialchars($to1xk['NKHVC'] ?? $to1xk['NKHVC'] ?? '') ?></div>
            </div>

            <div class="form-group">
                <label>Thông tin trung chuyển (Địa điểm / Ngày đến / Ngày khởi hành):</label>
                <div class="data-view">
                    (1) <?= htmlspecialchars($to1xk['DD1'] ?? '') ?> — <?= htmlspecialchars($to1xk['ND1'] ?? '') ?> →
                    <?= htmlspecialchars($to1xk['NKH1'] ?? '') ?><br>
                    (2) <?= htmlspecialchars($to1xk['DD2'] ?? '') ?> — <?= htmlspecialchars($to1xk['ND2'] ?? '') ?> →
                    <?= htmlspecialchars($to1xk['NKH2'] ?? '') ?><br>
                    (3) <?= htmlspecialchars($to1xk['DD3'] ?? '') ?> — <?= htmlspecialchars($to1xk['ND3'] ?? '') ?> →
                    <?= htmlspecialchars($to1xk['NKH3'] ?? '') ?>
                </div>
            </div>

            <div class="form-group">
                <label>Địa điểm đích vận chuyển bảo thuế:</label>
                <div class="data-view"><?= htmlspecialchars($to1xk['DDDVCBT'] ?? $to1xk['DDDVCBT'] ?? '') ?></div>

                <label style="width:218px;padding-left:146px;">Ngày đến:</label>
                <div class="data-view small"><?= htmlspecialchars($to1xk['ND11'] ?? $to1xk['ND11'] ?? '') ?></div>
            </div>
        </fieldset>

        <!-- Danh sách hàng hóa (giữ nguyên dạng bảng) -->
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

        <div class="button-group">
            <a href="../index.php" class="btn">⬅ Quay lại trang chủ</a>
        </div>
    </div>
</body>

</html>