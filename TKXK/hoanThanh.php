<?php
require_once(__DIR__ . "/../core/database.php");

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

    /* 1. Khối bao ngoài bảng */
    .goods-wrap {
        background: var(--card-bg);
        border: 1px solid var(--card-b);
        border-radius: 10px;
        padding: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, .05);
        overflow-x: auto;
    }

    /* 2. Table chính */
    table.goods {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
        font-size: 14px;
    }

    /* 3. Ô tiêu đề và ô dữ liệu */
    table.goods th,
    table.goods td {
        border: 1px solid #e6edf3;
        padding: 8px;
        vertical-align: middle;
        background: #fff;
    }

    /* 4. Chỉ định riêng cho tiêu đề bảng */
    table.goods th {
        background: #0b63a6;
        color: #fff;
        font-weight: 600;
        position: sticky;
        top: 0;
        z-index: 1;
    }

    /* 5. Căn phải */
    .ta-right {
        text-align: right;
    }

    /* 6. Cột dạng ellipsis (hạn chiều rộng) */
    .cell {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    /* 7. Cột dạng xuống dòng tự động */
    .wrap {
        white-space: normal;
        word-break: break-word;
        overflow: visible;
    }

    /* 8. Tô màu so le các dòng */
    table.goods tbody tr:nth-child(even) {
        background: #fafbfc;
    }

    /* 9. Hiệu ứng hover */
    table.goods tbody tr:hover {
        background: #f2f7ff;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2>📄 Hoàn thành — Thông tin tờ khai xuất khẩu</h2>
        <fieldset>
            <legend>Thông tin chung</legend>

            <div class="form-group">
                <label style="width: 220px">Nhóm loại hình:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['nhom_loai_hinh'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label style="width: 220px">Mã loại hình:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['MLH'] ?? '') ?>">
                <label style="width: 180px">Phân loại cá nhân/tổ chức:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['PLCNTC'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Cơ quan Hải quan:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['CQHQ'] ?? '') ?>">
                <label style="width: 180px">Mã hiệu phương thức vận chuyển:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['MHPTVC'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Ngày khai báo (dự kiến):</label>
                <input type="date" disabled value="<?= htmlspecialchars($to1xk['NKBDK'] ?? '') ?>">
            </div>
        </fieldset>
        <fieldset>
            <legend>Thông tin người xuất khẩu</legend>
            <div class="form-group">
                <label>Mã số thuế doanh nghiệp:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['mst_dnxk'] ?? '') ?>">
                <label style="width: 97px;">Mã bưu chính:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['MBCDNXK'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Tên doanh nghiệp:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['TDNXK'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Địa chỉ doanh nghiệp:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['DCDNXK'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Số điện thoại doanh nghiệp:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['SDTDNXK'] ?? '') ?>">
            </div>
        </fieldset>
        <fieldset>
            <legend>Ủy thác xuất khẩu</legend>

            <div class="form-group">
                <label>Tên người ủy thác:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['TNUTXK'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Số điện thoại người ủy thác:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['SDTNUTXK'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Địa chỉ người ủy thác:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['DCNUTXK'] ?? '') ?>">
            </div>
        </fieldset>
        <fieldset>
            <legend>Doanh nghiệp nhập khẩu</legend>

            <div class="form-group">
                <label>Mã số thuế doanh nghiệp nhập khẩu:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['MSTDNNK'] ?? '') ?>">

                <label style="width: 171px;">Mã bưu chính:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['MBCDNNK'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Tên doanh nghiệp nhập khẩu:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['TDNNK'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Địa chỉ doanh nghiệp nhập khẩu:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['DCDNNK'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Số điện thoại doanh nghiệp nhập khẩu:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['SDTDNNK'] ?? '') ?>">
            </div>
        </fieldset>
        <fieldset>
            <legend>Ủy thác nhập khẩu</legend>

            <div class="form-group">
                <label>Tên người ủy thác nhập khẩu:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['TNUTNK'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Số điện thoại người ủy thác nhập khẩu:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['SDTNUTNK'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Địa chỉ người ủy thác nhập khẩu:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['DCNUTNK'] ?? '') ?>">
            </div>
        </fieldset>
        <fieldset>
            <legend>Thông tin vận đơn & vận chuyển</legend>

            <div class="form-group">
                <label>Số vận đơn:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['SVD'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Số lượng kiện:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['SLK'] ?? '') ?>">
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['DVK'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Tổng trọng lượng hàng:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['TTLH'] ?? '') ?>">
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['DVT'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Mã địa điểm lưu kho hàng chờ thông quan dự kiến:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['MDDLKCTQDK'] ?? '') ?>">
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['MDDLKCTQ'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Địa điểm nhận hàng cuối cùng:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['DDNHCC'] ?? '') ?>">
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['DDNH'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Địa điểm xếp hàng:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['DDXH'] ?? '') ?>">
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['DDNH1'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Phương tiện vận chuyển:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['col_9999'] ?? '') ?>">
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['PTVC'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Ngày hàng đi dự kiến:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['NHDDK'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Ký hiệu & số hiệu:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['KH_SH'] ?? '') ?>">
            </div>
        </fieldset>
        <fieldset>
            <legend>Hóa đơn & Thanh toán</legend>

            <div class="form-group">
                <label>Phân loại hình thức hóa đơn:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['PLHTHD'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Số tiếp nhận hóa đơn điện tử:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['STNHDDT'] ?? '') ?>">
                <label style="padding-left:19px">Số hóa đơn:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['SHD'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Ngày phát hành:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['NPH'] ?? '') ?>">
                <label style="padding-left:19px">Phương thức thanh toán:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['PTTT'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Mã phân loại hóa đơn:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['MPLHD'] ?? '') ?>">

                <label style="padding-left:19px">Điều kiện giá hóa đơn:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['DKGHD'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Tổng trị giá hóa đơn:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['TTGHD'] ?? '') ?>">
                <label style="padding-left:19px">Mã đồng tiền:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['MDTTGHD'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Trị giá tính thuế:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['TGHD'] ?? '') ?>">
                <label style="padding-left:19px">Mã đồng tiền (tính thuế):</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['MDTTGTT'] ?? '') ?>">
            </div>
        </fieldset>
        <fieldset>
            <legend>Ngân hàng & Bảo lãnh</legend>

            <div class="form-group">
                <label>Mã lý do đề nghị BP:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['MLDDNBP'] ?? '') ?>">
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['MLDDNBP1'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Mã ngân hàng trả thuế thay:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['STK'] ?? '') ?>">
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['MNHTTT'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Năm phát hành hạn mức:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['NPHHM'] ?? '') ?>">
                <label style="width:auto">Ký hiệu chứng từ hạn mức:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['KHCTHM'] ?? '') ?>">
                <label style="width: 219px;">Số chứng từ hạn mức:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['SCTHM'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Mã xác định thời hạn nộp thuế:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['MXDTHNT'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Mã ngân hàng bảo lãnh:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['STK2'] ?? '') ?>">
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['MNHBL'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Năm phát hành bảo lãnh:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['NPHBL'] ?? '') ?>">
                <label style="width:auto">Ký hiệu chứng từ bảo lãnh:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['KHCTBL'] ?? '') ?>">
                <label style="width: 219px;">Số chứng từ bảo lãnh:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['SCTBL'] ?? '') ?>">
            </div>
        </fieldset>
        <fieldset>
            <legend>Thông tin vận chuyển</legend>

            <div class="form-group">
                <label>Ngày được phép nhập kho:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['NDPNK'] ?? '') ?>">
                <label style="width:218px;padding-left:26px;">Ngày khởi hành vận chuyển:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['NKHVC'] ?? '') ?>">
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
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['DDDVCBT'] ?? '') ?>">
                <label style="width:218px;padding-left:146px;">Ngày đến:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1xk['ND11'] ?? '') ?>">
            </div>
        </fieldset>
        <div>
            <fieldset>
                <h2>Tờ khai xuất khẩu - Thông tin container</h2>
                <h3>Địa điểm xếp hàng lên xe chở hàng</h3>
                <div class="form-group">
                    <label style="width:100px">Mã:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($to1xk['MA'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label style="width:100px">Tên:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($to1xk['TEN'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label style="width:100px">Địa chỉ:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($to1xk['DC'] ?? '') ?>">
                </div>

                <div class="container-grid">
                    <label>Số Container:</label>
                    <div class="grid">
                        <input type="text" disabled placeholder="1"
                            value="<?= htmlspecialchars($to1xk['SC1'] ?? '') ?>">
                        <input type="text" disabled placeholder="2"
                            value="<?= htmlspecialchars($to1xk['SC2'] ?? '') ?>">
                        <input type="text" disabled placeholder="3"
                            value="<?= htmlspecialchars($to1xk['SC3'] ?? '') ?>">
                        <input type="text" disabled placeholder="4"
                            value="<?= htmlspecialchars($to1xk['SC4'] ?? '') ?>">
                        <input type="text" disabled placeholder="5"
                            value="<?= htmlspecialchars($to1xk['SC5'] ?? '') ?>">
                        <input type="text" disabled placeholder="6"
                            value="<?= htmlspecialchars($to1xk['SC6'] ?? '') ?>">
                        <input type="text" disabled placeholder="7"
                            value="<?= htmlspecialchars($to1xk['SC7'] ?? '') ?>">
                        <input type="text" disabled placeholder="8"
                            value="<?= htmlspecialchars($to1xk['SC8'] ?? '') ?>">
                        <input type="text" disabled placeholder="9"
                            value="<?= htmlspecialchars($to1xk['SC9'] ?? '') ?>">
                        <input type="text" disabled placeholder="10"
                            value="<?= htmlspecialchars($to1xk['SC10'] ?? '') ?>">
                        <input type="text" disabled placeholder="11"
                            value="<?= htmlspecialchars($to1xk['SC11'] ?? '') ?>">
                        <input type="text" disabled placeholder="12"
                            value="<?= htmlspecialchars($to1xk['SC12'] ?? '') ?>">
                        <input type="text" disabled placeholder="13"
                            value="<?= htmlspecialchars($to1xk['SC13'] ?? '') ?>">
                        <input type="text" disabled placeholder="14"
                            value="<?= htmlspecialchars($to1xk['SC14'] ?? '') ?>">
                        <input type="text" disabled placeholder="15"
                            value="<?= htmlspecialchars($to1xk['SC15'] ?? '') ?>">
                        <input type="text" disabled placeholder="16"
                            value="<?= htmlspecialchars($to1xk['SC16'] ?? '') ?>">
                        <input type="text" disabled placeholder="17"
                            value="<?= htmlspecialchars($to1xk['SC17'] ?? '') ?>">
                        <input type="text" disabled placeholder="18"
                            value="<?= htmlspecialchars($to1xk['SC18'] ?? '') ?>">
                        <input type="text" disabled placeholder="19"
                            value="<?= htmlspecialchars($to1xk['SC19'] ?? '') ?>">
                        <input type="text" disabled placeholder="20"
                            value="<?= htmlspecialchars($to1xk['SC20'] ?? '') ?>">
                        <input type="text" disabled placeholder="21"
                            value="<?= htmlspecialchars($to1xk['SC21'] ?? '') ?>">
                        <input type="text" disabled placeholder="22"
                            value="<?= htmlspecialchars($to1xk['SC22'] ?? '') ?>">
                        <input type="text" disabled placeholder="23"
                            value="<?= htmlspecialchars($to1xk['SC23'] ?? '') ?>">
                        <input type="text" disabled placeholder="24"
                            value="<?= htmlspecialchars($to1xk['SC24'] ?? '') ?>">
                        <input type="text" disabled placeholder="25"
                            value="<?= htmlspecialchars($to1xk['SC25'] ?? '') ?>">
                        <input type="text" disabled placeholder="26"
                            value="<?= htmlspecialchars($to1xk['SC26'] ?? '') ?>">
                        <input type="text" disabled placeholder="27"
                            value="<?= htmlspecialchars($to1xk['SC27'] ?? '') ?>">
                        <input type="text" disabled placeholder="28"
                            value="<?= htmlspecialchars($to1xk['SC28'] ?? '') ?>">
                        <input type="text" disabled placeholder="29"
                            value="<?= htmlspecialchars($to1xk['SC29'] ?? '') ?>">
                        <input type="text" disabled placeholder="30"
                            value="<?= htmlspecialchars($to1xk['SC30'] ?? '') ?>">
                        <input type="text" disabled placeholder="31"
                            value="<?= htmlspecialchars($to1xk['SC31'] ?? '') ?>">
                        <input type="text" disabled placeholder="32"
                            value="<?= htmlspecialchars($to1xk['SC32'] ?? '') ?>">
                        <input type="text" disabled placeholder="33"
                            value="<?= htmlspecialchars($to1xk['SC33'] ?? '') ?>">
                        <input type="text" disabled placeholder="34"
                            value="<?= htmlspecialchars($to1xk['SC34'] ?? '') ?>">
                        <input type="text" disabled placeholder="35"
                            value="<?= htmlspecialchars($to1xk['SC35'] ?? '') ?>">
                        <input type="text" disabled placeholder="36"
                            value="<?= htmlspecialchars($to1xk['SC36'] ?? '') ?>">
                        <input type="text" disabled placeholder="37"
                            value="<?= htmlspecialchars($to1xk['SC37'] ?? '') ?>">
                        <input type="text" disabled placeholder="38"
                            value="<?= htmlspecialchars($to1xk['SC38'] ?? '') ?>">
                        <input type="text" disabled placeholder="39"
                            value="<?= htmlspecialchars($to1xk['SC39'] ?? '') ?>">
                        <input type="text" disabled placeholder="40"
                            value="<?= htmlspecialchars($to1xk['SC40'] ?? '') ?>">
                        <input type="text" disabled placeholder="41"
                            value="<?= htmlspecialchars($to1xk['SC41'] ?? '') ?>">
                        <input type="text" disabled placeholder="42"
                            value="<?= htmlspecialchars($to1xk['SC42'] ?? '') ?>">
                        <input type="text" disabled placeholder="43"
                            value="<?= htmlspecialchars($to1xk['SC43'] ?? '') ?>">
                        <input type="text" disabled placeholder="44"
                            value="<?= htmlspecialchars($to1xk['SC44'] ?? '') ?>">
                        <input type="text" disabled placeholder="45"
                            value="<?= htmlspecialchars($to1xk['SC45'] ?? '') ?>">
                        <input type="text" disabled placeholder="46"
                            value="<?= htmlspecialchars($to1xk['SC46'] ?? '') ?>">
                        <input type="text" disabled placeholder="47"
                            value="<?= htmlspecialchars($to1xk['SC47'] ?? '') ?>">
                        <input type="text" disabled placeholder="48"
                            value="<?= htmlspecialchars($to1xk['SC48'] ?? '') ?>">
                        <input type="text" disabled placeholder="49"
                            value="<?= htmlspecialchars($to1xk['SC49'] ?? '') ?>">
                        <input type="text" disabled placeholder="50"
                            value="<?= htmlspecialchars($to1xk['SC50'] ?? '') ?>">

                    </div>
                </div>
            </fieldset>
            <fieldset>
                <h2>📦 Danh sách hàng hóa</h2>
                <div class="goods-wrap">
                    <table class="goods">
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
                                <td><?= htmlspecialchars($row['HSC'] ?? '') ?></td>
                                <td><?= htmlspecialchars($row['TH'] ?? '') ?></td>
                                <td><?= htmlspecialchars($row['DVT'] ?? '') ?></td>
                                <td><?= htmlspecialchars($row['SL'] ?? '') ?></td>
                                <td><?= htmlspecialchars($row['GIA'] ?? '') ?></td>
                                <td><?= htmlspecialchars($row['VALUE'] ?? '') ?></td>
                                <td><?= htmlspecialchars($row['XX'] ?? '') ?></td>
                                <td><?= htmlspecialchars($row['GC'] ?? '') ?></td>
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
            <button type="button" onclick="window.location.href='editXK.php?id=<?= $id ?>'">Sửa</button>
            <button type="button" onclick="window.print()">🖨️ In</button>
            <button type="button" class="red" onclick="window.location.href='../index.php'">Đóng</button>
        </div>
    </div>
</body>

</html>