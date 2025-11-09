<?php
require_once(__DIR__ . "/../core/database.php");
if (session_status() === PHP_SESSION_NONE)
    session_start();

if (($_SESSION['role'] ?? '') !== 'admin') {
    die("⛔ Bạn không có quyền truy cập trang này!");
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if (!$id)
    die("Thiếu ID tờ khai!");

$sql1 = "SELECT * FROM to1nk WHERE id = ?";
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param("i", $id);
$stmt1->execute();
$to1nk = $stmt1->get_result()->fetch_assoc();
$stmt1->close();

$sql2 = "SELECT * FROM to2nk WHERE to1nk = ?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("i", $id);
$stmt2->execute();
$to2nk = $stmt2->get_result()->fetch_assoc();
$stmt2->close();

$sql3 = "SELECT * FROM to3nk WHERE to1nk = ?";
$stmt3 = $conn->prepare($sql3);
$stmt3->bind_param("i", $id);
$stmt3->execute();
$hanghoa = $stmt3->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt3->close();

function h($v)
{
    return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');
}
function nf($n, $d = 2)
{
    if ($n === null || $n === '' || !is_numeric($n))
        return h((string) $n);
    return number_format((float) $n, $d, '.', ',');
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Chỉnh sửa tờ khai nhập khẩu</title>
    <style>
        :root {
            --label-w: 220px;
            --gap: 10px;
            --bg: #f8fafc;
            --card-bg: #fff;
            --card-b: #e5e7eb;
            --text: #0b1220;
            --muted: #475569;
            --primary: #0b63a6;
        }

        * {
            box-sizing: border-box
        }

        body {
            font-family: Inter, system-ui, -apple-system, 'Segoe UI', Roboto, Arial;
            background: var(--bg);
            color: var(--text);
            margin: 0;
            padding: 20px
        }

        .container {
            max-width: 1100px;
            margin: 0 auto
        }

        h2 {
            color: var(--primary);
            margin: 6px 0 18px;
            font-weight: 700
        }

        fieldset {
            background: var(--card-bg);
            border: 1px solid var(--card-b);
            border-radius: 10px;
            padding: 14px;
            margin: 14px 0;
            box-shadow: 0 2px 6px rgba(0, 0, 0, .05)
        }

        legend {
            padding: 0 6px;
            font-weight: 700;
            color: #0f172a
        }

        .form-group {
            display: flex;
            flex-wrap: wrap;
            gap: var(--gap);
            align-items: center;
            margin: 8px 0
        }

        .form-group label {
            min-width: var(--label-w);
            color: var(--muted);
            font-size: 13px
        }

        input[type=text],
        input[type=date],
        input[type=number],
        select,
        textarea {
            flex: 1;
            min-width: 220px;
            padding: 8px;
            border: 1px solid #d1d7e0;
            border-radius: 6px;
            background: #fff
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 10px
        }

        .goods-wrap {
            background: var(--card-bg);
            border: 1px solid var(--card-b);
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, .05);
            overflow-x: auto
        }

        table.goods {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 14px
        }

        table.goods th,
        table.goods td {
            border: 1px solid #e6edf3;
            padding: 8px;
            vertical-align: middle;
            background: #fff
        }

        table.goods th {
            background: var(--primary);
            color: #fff;
            font-weight: 600;
            position: sticky;
            top: 0;
            z-index: 1
        }

        .ta-right {
            text-align: right
        }

        .cell {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis
        }

        .wrap {
            white-space: normal;
            word-break: break-word;
            overflow: visible
        }

        .button-group {
            margin-top: 20px;
            display: flex;
            gap: 10px;
            justify-content: center;
            align-items: center
        }

        .button-group .btn,
        .button-group button {
            background: var(--primary);
            color: #fff;
            border: none;
            padding: 10px 14px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600
        }

        .button-group .red {
            background: #ef4444
        }

        .small {
            max-width: 120px
        }

        table.goods input {
            width: 100%;
            padding: 6px;
            border: 1px solid #d1d7e0;
            border-radius: 4px
        }

        @media print {
            .button-group {
                display: none !important
            }

            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact
            }

            table.goods th {
                position: relative
            }

            @page {
                size: A4;
                margin: 12mm 10mm
            }

            .page-break {
                page-break-before: always
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>✏️ Chỉnh sửa tờ khai nhập khẩu</h2>

        <form action="updateNK.php" method="POST">
            <input type="hidden" name="id" value="<?= $id ?>">

            <fieldset>
                <legend>Thông tin chung 1</legend>
                <div class="form-group">
                    <label>Nhóm loại hình:</label>
                    <select name="nhom_loai_hinh">
                        <option <?= ($to1nk['nhom_loai_hinh'] ?? '') === 'A11' ? 'selected' : '' ?>>A11</option>
                        <option <?= ($to1nk['nhom_loai_hinh'] ?? '') === 'A12' ? 'selected' : '' ?>>A12</option>
                        <option <?= ($to1nk['nhom_loai_hinh'] ?? '') === 'B13' ? 'selected' : '' ?>>B13</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Mã loại hình:</label>
                    <input name="ma_loai_hinh" value="<?= h($to1nk['ma_loai_hinh'] ?? '') ?>">
                    <label style="width:240px">Phân loại cá nhân/tổ chức:</label>
                    <input name="phan_loai_to_chuc" value="<?= h($to1nk['phan_loai_to_chuc'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label>Cơ quan Hải quan:</label>
                    <input name="co_quan_hq" value="<?= h($to1nk['co_quan_hq'] ?? '') ?>">
                    <label style="width:240px">Mã hiệu phương thức vận chuyển:</label>
                    <input name="phuong_thuc_vc" value="<?= h($to1nk['phuong_thuc_vc'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label>Mã phân loại hàng hóa:</label>
                    <input name="ma_phan_loai_hang" value="<?= h($to1nk['ma_phan_loai_hang'] ?? '') ?>">
                    <label style="width:240px">Mã bộ phận xử lí tờ khai:</label>
                    <input name="ma_bo_phan_xu_ly" value="<?= h($to1nk['ma_bo_phan_xu_ly'] ?? '') ?>">
                </div>

                <fieldset>
                    <legend>Thông tin người nhập khẩu</legend>
                    <div class="form-group"><label>Mã số thuế DN:</label><input name="MSTDNNK"
                            value="<?= h($to1nk['MSTDNNK'] ?? '') ?>"><label style="width:97px;">Mã bưu
                            chính:</label><input name="MBCNK" value="<?= h($to1nk['MBCNK'] ?? '') ?>"></div>
                    <div class="form-group"><label>Tên DN:</label><input name="TDNNK"
                            value="<?= h($to1nk['TDNNK'] ?? '') ?>"></div>
                    <div class="form-group"><label>Địa chỉ DN:</label><input name="DCDNNK"
                            value="<?= h($to1nk['DCDNNK'] ?? '') ?>"></div>
                    <div class="form-group"><label>SĐT DN:</label><input name="SDTDNNK"
                            value="<?= h($to1nk['SDTDNNK'] ?? '') ?>"></div>

                    <legend>Người ủy thác nhập khẩu</legend>
                    <div class="form-group"><label>Tên người ủy thác NK:</label><input name="NUTNK"
                            value="<?= h($to1nk['NUTNK'] ?? '') ?>"></div>
                    <div class="form-group"><label>SĐT người ủy thác NK:</label><input name="SDTUTNK"
                            value="<?= h($to1nk['SDTUTNK'] ?? '') ?>"></div>
                    <div class="form-group"><label>Địa chỉ người ủy thác NK:</label><input name="DCUTNK"
                            value="<?= h($to1nk['DCUTNK'] ?? '') ?>"></div>
                </fieldset>

                <fieldset>
                    <legend>Thông tin người xuất khẩu</legend>
                    <div class="form-group"><label>MST DN XK:</label><input name="MSTDNXK"
                            value="<?= h($to1nk['MSTDNXK'] ?? '') ?>"><label style="width:120px;">Mã bưu chính
                            XK:</label><input name="MBCXK" value="<?= h($to1nk['MBCXK'] ?? '') ?>"></div>
                    <div class="form-group"><label>Tên DN XK:</label><input name="TDNXK"
                            value="<?= h($to1nk['TDNXK'] ?? '') ?>"></div>
                    <div class="form-group"><label>Địa chỉ DN XK:</label><input name="DCDNXK"
                            value="<?= h($to1nk['DCDNXK'] ?? '') ?>"></div>
                    <div class="form-group"><label>SĐT DN XK:</label><input name="SDTDNXK"
                            value="<?= h($to1nk['SDTDNXK'] ?? '') ?>"></div>

                    <legend>Người ủy thác xuất khẩu</legend>
                    <div class="form-group"><label>Tên người ủy thác XK:</label><input name="NUTXK"
                            value="<?= h($to1nk['NUTXK'] ?? '') ?>"></div>
                    <div class="form-group"><label>SĐT người ủy thác XK:</label><input name="SDTUTXK"
                            value="<?= h($to1nk['SDTUTXK'] ?? '') ?>"></div>
                    <div class="form-group"><label>Địa chỉ người ủy thác XK:</label><input name="DCUTXK"
                            value="<?= h($to1nk['DCUTXK'] ?? '') ?>"></div>
                </fieldset>

                <fieldset>
                    <legend>Thông tin vận đơn</legend>
                    <div class="form-group"><label>Số vận đơn:</label><input name="SVD"
                            value="<?= h($to1nk['SVD'] ?? '') ?>"><label style="width:98px;">Ngày vận đơn:</label><input
                            type="date" name="NVD" value="<?= h($to1nk['NVD'] ?? '') ?>"></div>
                    <div class="form-group"><label>Số lượng kiện:</label><input name="SLK"
                            value="<?= h($to1nk['SLK'] ?? '') ?>"><select name="don_vi_kien">
                            <option><?= h($to1nk['don_vi_kien'] ?? '') ?></option>
                        </select></div>
                    <div class="form-group"><label>Tổng trọng lượng hàng:</label><input name="TTLH"
                            value="<?= h($to1nk['TTLH'] ?? '') ?>"><select name="don_vi_tl">
                            <option><?= h($to1nk['don_vi_tl'] ?? '') ?></option>
                        </select></div>
                    <div class="form-group"><label>Mã địa điểm lưu kho:</label><input name="MDDLK"
                            value="<?= h($to1nk['MDDLK'] ?? '') ?>"><select name="dia_diem_luu_kho">
                            <option><?= h($to1nk['dia_diem_luu_kho'] ?? '') ?></option>
                        </select></div>
                    <div class="form-group"><label>Ký hiệu & số hiệu bao bì:</label><input name="KH_SHBB"
                            value="<?= h($to1nk['KH_SHBB'] ?? '') ?>"></div>
                    <div class="form-group"><label>Phương tiện vận chuyển:</label><input name="so_hieu_tau"
                            value="<?= h($to1nk['so_hieu_tau'] ?? '') ?>"><input name="PTVC"
                            value="<?= h($to1nk['PTVC'] ?? '') ?>"></div>
                    <div class="form-group"><label>Ngày hàng đến:</label><input type="date" name="NHD"
                            value="<?= h($to1nk['NHD'] ?? '') ?>"></div>
                    <div class="form-group"><label>Địa điểm dỡ hàng:</label><input name="DDDH"
                            value="<?= h($to1nk['DDDH'] ?? '') ?>"><select name="ma_dd_dohang">
                            <option><?= h($to1nk['ma_dd_dohang'] ?? '') ?></option>
                        </select></div>
                    <div class="form-group"><label>Địa điểm xếp hàng:</label><input name="DDXH"
                            value="<?= h($to1nk['DDXH'] ?? '') ?>"><select name="ma_dd_xephang">
                            <option><?= h($to1nk['ma_dd_xephang'] ?? '') ?></option>
                        </select></div>
                    <div class="form-group"><label>Số lượng container:</label><input type="number" name="SLCT"
                            value="<?= h($to1nk['SLCT'] ?? '') ?>"></div>
                    <div class="form-group"><label>Mã kết quả kiểm tra nội dung:</label><input name="ma_kq_ktnd"
                            value="<?= h($to1nk['ma_kq_ktnd'] ?? '') ?>"></div>
                </fieldset>
            </fieldset>

            <?php $data = $to2nk ?: []; ?>

            <fieldset>
                <legend>Thông tin giấy phép và văn bản (Tờ 2)</legend>
                <div class="form-group"><label>Mã văn bản phạm quy khác:</label><input name="MVBPQK"
                        value="<?= h($data['MVBPQK'] ?? '') ?>"></div>
                <div class="form-group"><label>Giấy phép nhập khẩu (1):</label><input name="GPNK1"
                        value="<?= h($data['GPNK1'] ?? '') ?>"><input name="GPNK11"
                        value="<?= h($data['GPNK11'] ?? '') ?>"></div>
                <div class="form-group"><label></label><input name="GPNK2" value="<?= h($data['GPNK2'] ?? '') ?>"><input
                        name="GPNK22" value="<?= h($data['GPNK22'] ?? '') ?>"></div>
                <div class="form-group"><label></label><input name="GPNK3" value="<?= h($data['GPNK3'] ?? '') ?>"><input
                        name="GPNK33" value="<?= h($data['GPNK33'] ?? '') ?>"></div>
                <div class="form-group"><label></label><input name="GPNK4" value="<?= h($data['GPNK4'] ?? '') ?>"><input
                        name="GPNK44" value="<?= h($data['GPNK44'] ?? '') ?>"></div>
            </fieldset>

            <fieldset>
                <legend>Hóa đơn thương mại</legend>
                <div class="form-group"><label>Phân loại hình thức hóa đơn:</label>
                    <select name="PLHTHD">
                        <option <?= (($data['PLHTHD'] ?? '') === 'A2') ? 'selected' : ''; ?>>A: Hóa đơn</option>
                        <option <?= (($data['PLHTHD'] ?? '') === 'B2') ? 'selected' : ''; ?>>B: Chứng từ thay thế hóa
                            đơn</option>
                        <option <?= (($data['PLHTHD'] ?? '') === 'D2') ? 'selected' : ''; ?>>D: Hóa đơn điện tử</option>
                    </select>
                </div>
                <div class="form-group"><label>Số tiếp nhận hóa đơn điện tử:</label><input name="STNHDDT"
                        value="<?= h($data['STNHDDT'] ?? '') ?>"><label>Số hóa đơn:</label><input name="SHD"
                        value="<?= h($data['SHD'] ?? '') ?>"></div>
                <div class="form-group"><label>Ngày phát hành:</label><input type="date" name="NPH"
                        value="<?= h($data['NPH'] ?? '') ?>"><label>Phương thức thanh toán:</label>
                    <select name="PTTT">
                        <option <?= (($data['PTTT'] ?? '') === 'TT') ? 'selected' : ''; ?>>T/T</option>
                        <option <?= (($data['PTTT'] ?? '') === 'TTR') ? 'selected' : ''; ?>>TTR</option>
                        <option <?= (($data['PTTT'] ?? '') === 'COD') ? 'selected' : ''; ?>>COD</option>
                        <option <?= (($data['PTTT'] ?? '') === 'LC') ? 'selected' : ''; ?>>L/C</option>
                    </select>
                </div>
                <div class="form-group"><label>Mã phân loại hóa đơn:</label>
                    <select name="MPLHD">
                        <option <?= (($data['MPLHD'] ?? '') === 'A3') ? 'selected' : ''; ?>>A: Hóa đơn thương mại
                        </option>
                        <option <?= (($data['MPLHD'] ?? '') === 'B3') ? 'selected' : ''; ?>>B: Chứng từ thay thế
                        </option>
                        <option <?= (($data['MPLHD'] ?? '') === 'D3') ? 'selected' : ''; ?>>D: Hóa đơn điện tử IVA
                        </option>
                    </select>
                    <label>Điều kiện giá hóa đơn:</label>
                    <select name="DKGHD">
                        <?php foreach (['EXW', 'FCA', 'CPT', 'CIP', 'DAP', 'DPU', 'DDP', 'FAS', 'FOB', 'CFR', 'CIF'] as $opt): ?>
                            <option <?= (($data['DKGHD'] ?? '') === $opt) ? 'selected' : ''; ?>><?= $opt ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group"><label>Tổng trị giá hóa đơn:</label><input name="TTGHD"
                        value="<?= h($data['TTGHD'] ?? '') ?>"><label>Mã đồng tiền hóa đơn:</label>
                    <select name="MDTHD">
                        <?php foreach (['USD', 'CNY', 'VND', 'JPY', 'KRW'] as $c): ?>
                            <option <?= (($data['MDTHD'] ?? '') === $c) ? 'selected' : ''; ?>><?= $c ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </fieldset>

            <fieldset>
                <legend>Tờ khai trị giá</legend>
                <div class="form-group"><label>Mã phân loại khai trị giá:</label>
                    <select name="MPLKTG">
                        <?php
                        $opts = ['MPLKTG0' => "0: Khai trị giá tổng hợp", 'MPLKTG1' => "1: Giao dịch hàng hóa giống hệt", 'MPLKTG2' => "2: Giao dịch hàng hóa tương tự", 'MPLKTG3' => "3: Khấu trừ", 'MPLKTG4' => "4: Tính toán", 'MPLKTG5' => "5: Tổng hợp một phần hàng hóa", 'MPLKTG6' => "6: Trị giá giao dịch", 'MPLKTG7' => "7: Giao dịch có quan hệ đặc biệt", 'MPLKTG8' => "8: Giao dịch + phân bổ điều chỉnh thủ công", 'MPLKTG9' => "9: Suy luận", 'MPLKTGZ' => "Z: Tổng hợp chưa đăng ký", 'MPLKTGT' => "T: Trường hợp đặc biệt"];
                        $cur = $data['MPLKTG'] ?? '';
                        foreach ($opts as $k => $txt) {
                            $sel = ($cur === $k) ? 'selected' : '';
                            echo "<option $sel>" . h($txt) . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group"><label>Phí vận chuyển:</label><label style="width:70px;">Mã loại:</label><input
                        class="small" name="ML1" value="<?= h($data['ML1'] ?? '') ?>"><label style="width:106px;">Mã
                        đồng tiền:</label><input class="small" name="MDT1" value="<?= h($data['MDT1'] ?? '') ?>"><label
                        style="width:124px;">Phí vận chuyển:</label><input class="small" name="PVC1"
                        value="<?= h($data['PVC1'] ?? '') ?>"></div>
                <div class="form-group"><label>Phí bảo hiểm:</label><label style="width:70px;">Mã loại:</label><input
                        class="small" name="ML2" value="<?= h($data['ML2'] ?? '') ?>"><label style="width:106px;">Mã
                        đồng tiền:</label><input class="small" name="MDT2" value="<?= h($data['MDT2'] ?? '') ?>"><label
                        style="width:124px;">Phí bảo hiểm:</label><input class="small" name="PBH2"
                        value="<?= h($data['PBH2'] ?? '') ?>"></div>
                <div class="form-group"><label>Chi tiết khai trị giá:</label><input name="CTKTG"
                        value="<?= h($data['CTKTG'] ?? '') ?>"></div>
                <div class="form-group"><label>Người nộp thuế:</label><select name="NNT">
                        <option <?= (($data['NNT'] ?? '') === 'NNT1') ? 'selected' : ''; ?>>1: Người nhập khẩu</option>
                        <option <?= (($data['NNT'] ?? '') === 'NNT2') ? 'selected' : ''; ?>>2: Đại lý hải quan</option>
                    </select></div>
            </fieldset>

            <fieldset>
                <legend>Thuế và bảo lãnh</legend>
                <div class="form-group"><label>Mã lý do đề nghị BP:</label><input name="MLDDNBP"
                        value="<?= h($data['MLDDNBP'] ?? '') ?>"><select name="MLDDNBP1">
                        <option <?= (($data['MLDDNBP1'] ?? '') === 'MLDDNBPA') ? 'selected' : ''; ?>>MLDDNBPA</option>
                        <option <?= (($data['MLDDNBP1'] ?? '') === 'MLDDNBPB') ? 'selected' : ''; ?>>MLDDNBPB</option>
                    </select></div>
                <div class="form-group"><label>Mã ngân hàng trả thuế thay:</label><input name="MNHTTT"
                        value="<?= h($data['MNHTTT'] ?? '') ?>"><input name="MaNHTTT"
                        value="<?= h($data['MaNHTTT'] ?? '') ?>"></div>
                <div class="form-group"><label>Năm phát hành hạn mức:</label><input name="NPHHM"
                        value="<?= h($data['NPHHM'] ?? '') ?>"><label style="width:185px;">Ký hiệu chứng từ hạn
                        mức:</label><input name="KHCTHM" value="<?= h($data['KHCTHM'] ?? '') ?>"></div>
                <div class="form-group"><label>Số chứng từ hạn mức:</label><input name="SCTHM"
                        value="<?= h($data['SCTHM'] ?? '') ?>"></div>
                <div class="form-group"><label>Mã xác định thời hạn nộp thuế:</label><input name="MXDTHNT"
                        value="<?= h($data['MXDTHNT'] ?? '') ?>"></div>
                <div class="form-group"><label>Mã ngân hàng bảo lãnh:</label><input name="MNHBL"
                        value="<?= h($data['MNHBL'] ?? '') ?>"><input name="MNHBL2"
                        value="<?= h($data['MNHBL'] ?? '') ?>"></div>
                <div class="form-group"><label>Năm phát hành bảo lãnh:</label><input name="NPHBL"
                        value="<?= h($data['NPHBL'] ?? '') ?>"><label style="width:185px;">Ký hiệu chứng từ bảo
                        lãnh:</label><input name="KHCTBL" value="<?= h($data['KHCTBL'] ?? '') ?>"></div>
                <div class="form-group"><label>Số chứng từ bảo lãnh:</label><input name="SCTBL"
                        value="<?= h($data['SCTBL'] ?? '') ?>"></div>
            </fieldset>

            <fieldset>
                <legend>Thông tin đính kèm</legend>
                <div class="form-group"><label>Số đính kèm khai báo điện tử:</label><label
                        style="width:336px;padding-left:101px;">Phân loại đính kèm</label><label
                        style="padding-left:112px;">Số đính kèm</label></div>
                <div class="form-group"><label style="padding-left:192px;">(1)</label><input name="SDKKBDT1"
                        value="<?= h($data['SDKKBDT1'] ?? '') ?>"><input name="SDK1"
                        value="<?= h($data['SDK1'] ?? '') ?>"></div>
                <div class="form-group"><label style="padding-left:192px;">(2)</label><input name="SDKKBDT2"
                        value="<?= h($data['SDKKBDT2'] ?? '') ?>"><input name="SDK2"
                        value="<?= h($data['SDK2'] ?? '') ?>"></div>
                <div class="form-group"><label style="padding-left:192px;">(3)</label><input name="SDKKBDT3"
                        value="<?= h($data['SDKKBDT3'] ?? '') ?>"><input name="SDK3"
                        value="<?= h($data['SDK3'] ?? '') ?>"></div>
            </fieldset>

            <fieldset>
                <legend>Thông tin vận chuyển</legend>
                <div class="form-group"><label>Ngày được phép nhập kho:</label><input type="date" name="NDPNK"
                        value="<?= h($data['NDPNK'] ?? '') ?>"><label>Ngày khởi hành vận chuyển:</label><input
                        type="date" name="NKHVC" value="<?= h($data['NKHVC'] ?? '') ?>"></div>
                <div class="form-group"><label>Thông tin trung chuyển:</label><label style="padding-left:75px;">Địa
                        điểm</label><label style="padding-left:73px;">Ngày đến</label><label
                        style="padding-left:58px;">Ngày khởi hành</label></div>
                <div class="form-group"><label style="padding-left:192px;">(1)</label><input name="DD1"
                        value="<?= h($data['DD1'] ?? '') ?>"><input type="date" name="ND1"
                        value="<?= h($data['ND1'] ?? '') ?>"><input type="date" name="NKH1"
                        value="<?= h($data['NKH1'] ?? '') ?>"></div>
                <div class="form-group"><label style="padding-left:192px;">(2)</label><input name="DD2"
                        value="<?= h($data['DD2'] ?? '') ?>"><input type="date" name="ND2"
                        value="<?= h($data['ND2'] ?? '') ?>"><input type="date" name="NKH2"
                        value="<?= h($data['NKH2'] ?? '') ?>"></div>
                <div class="form-group"><label style="padding-left:192px;">(3)</label><input name="DD3"
                        value="<?= h($data['DD3'] ?? '') ?>"><input type="date" name="ND3"
                        value="<?= h($data['ND3'] ?? '') ?>"><input type="date" name="NKH3"
                        value="<?= h($data['NKH3'] ?? '') ?>"></div>
                <div class="form-group"><label>Địa điểm đích vận chuyển bảo thuế:</label><input name="DDDVCBT"
                        value="<?= h($data['DDDVCBT'] ?? '') ?>"><label style="padding-left:148px;width:219px;">Ngày
                        đến:</label><input name="ND11" value="<?= h($data['ND11'] ?? '') ?>"></div>
            </fieldset>

            <fieldset>
                <legend>Thông tin hợp đồng</legend>
                <div class="form-group"><label>Số hợp đồng:</label><input name="SHD1"
                        value="<?= h($data['SHD1'] ?? '') ?>"></div>
                <div class="form-group"><label>Ngày bắt đầu:</label><input type="date" name="NBD"
                        value="<?= h($data['NBD'] ?? '') ?>"><label style="padding-left:122px;width:219px;">Ngày kết
                        thúc:</label><input type="date" name="NKT" value="<?= h($data['NKT'] ?? '') ?>"></div>
            </fieldset>

            <fieldset>
                <legend>Thông tin khác</legend>
                <div class="form-group"><label>Chú thích:</label><input name="CT"
                        value="<?= h($data['CT'] ?? '') ?>"><label>Phần quản lý của nội bộ DN:</label><input
                        name="PQLNBCDN" value="<?= h($data['PQLNBCDN'] ?? '') ?>"></div>
            </fieldset>

            <fieldset>
                <h2>Tờ khai nhập khẩu - Danh sách hàng hóa</h2>
                <div class="goods-wrap">
                    <table class="goods">
                        <colgroup>
                            <col style="width:6%">
                            <col style="width:12%">
                            <col style="width:28%">
                            <col style="width:8%">
                            <col style="width:9%">
                            <col style="width:12%">
                            <col style="width:12%">
                            <col style="width:6%">
                            <col style="width:7%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã hàng</th>
                                <th>Tên hàng</th>
                                <th>ĐVT</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Trị giá</th>
                                <th>Thuế suất (%)</th>
                                <th>Tiền thuế</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($hanghoa)):
                                foreach ($hanghoa as $i => $r): ?>
                                    <tr>
                                        <td class="ta-right"><?= $i + 1 ?></td>
                                        <td><input name="HSC[]" value="<?= h($r['HSC'] ?? '') ?>"></td>
                                        <td><input name="TH[]" value="<?= h($r['TH'] ?? '') ?>"></td>
                                        <td><input name="DVT[]" value="<?= h($r['DVT'] ?? $r['dvt'] ?? '') ?>"></td>
                                        <td class="ta-right"><input name="SL[]" class="small" value="<?= h($r['SL'] ?? '') ?>">
                                        </td>
                                        <td class="ta-right"><input name="GIA[]" class="small"
                                                value="<?= h($r['GIA'] ?? '') ?>"></td>
                                        <td class="ta-right"><input name="VALUE[]" class="small"
                                                value="<?= h($r['VALUE'] ?? '') ?>"></td>
                                        <td class="ta-right"><input name="TS[]" class="small" value="<?= h($r['TS'] ?? '') ?>">
                                        </td>
                                        <td class="ta-right"><input name="TT[]" class="small" value="<?= h($r['TT'] ?? '') ?>">
                                        </td>
                                    </tr>
                                <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="9" style="text-align:center">Không có dữ liệu hàng hóa</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </fieldset>

            <div class="button-group">
                <button type="submit" class="btn">💾 Lưu thay đổi</button>
                <button type="button" onclick="window.location.href='viewNK.php?id=<?= $id ?>'" class="btn">⬅
                    Hủy</button>
                <button type="button" class="btn red" onclick="window.location.href='../index.php'">Đóng</button>
            </div>
        </form>
    </div>
</body>

</html>