<?php
declare(strict_types=1);

require_once(__DIR__ . "/../core/database.php");
if (session_status() === PHP_SESSION_NONE)
    session_start();

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0)
    die("Không tìm thấy ID tờ khai!");

$sql1 = "SELECT * FROM to1nk WHERE id = ?";
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param("i", $id);
$stmt1->execute();
$to1nk = $stmt1->get_result()->fetch_assoc();
$stmt1->close();

if (!$to1nk)
    die("Không tìm thấy dữ liệu tờ khai!");

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

$isAdmin = (($_SESSION['role'] ?? '') === 'admin');
$userId = (int) ($_SESSION['user_id'] ?? 0);

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
    <meta charset="UTF-8">
    <title>Tờ khai nhập khẩu - Xem thông tin</title>
    <link rel="stylesheet" href="style.css?v1.0.3">
    <style>
        /* :root {
            --label-w: 220px;
            --gap: 10px;
            --bg: #f8fafc;
            --card-bg: #fff;
            --card-b: #e5e7eb;
            --text: #0b1220;
            --muted: #475569;
        }

        * {
            box-sizing: border-box;
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: "Inter", system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1100px;
            margin: 20px auto;
            padding: 0 16px;
        }

        h2 {
            margin: 16px 0 12px;
            color: #0b63a6;
            font-weight: 700;
        }

        fieldset {
            background: var(--card-bg);
            border: 1px solid var(--card-b);
            border-radius: 10px;
            padding: 14px;
            margin: 14px 0;
            box-shadow: 0 2px 6px rgba(0, 0, 0, .05);
        }

        legend {
            padding: 0 6px;
            font-weight: 700;
            color: #0f172a;
        }

        .form-group {
            display: flex;
            flex-wrap: wrap;
            gap: var(--gap);
            align-items: center;
            margin: 8px 0;
        }

        .form-group label {
            min-width: var(--label-w);
            color: var(--muted);
            font-size: 13px;
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
            background: #fff;
        } */
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

        input[disabled],
        select[disabled],
        textarea[disabled] {
            background-color: #f8f8f8;
            color: #000;
            border: 1px solid #ccc;
            cursor: not-allowed;
        }

        .goods-wrap {
            background: var(--card-bg);
            border: 1px solid var(--card-b);
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, .05);
            overflow-x: auto;
        }

        table.goods {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 14px;
        }

        table.goods th,
        table.goods td {
            border: 1px solid #e6edf3;
            padding: 8px;
            vertical-align: middle;
            background: #fff;
        }

        table.goods th {
            background: #0b63a6;
            color: #fff;
            font-weight: 600;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .ta-right {
            text-align: right;
        }

        .cell {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .wrap {
            white-space: normal;
            word-break: break-word;
            overflow: visible;
        }

        table.goods tbody tr:nth-child(even) {
            background: #fafbfc;
        }

        table.goods tbody tr:hover {
            background: #f2f7ff;
        }

        .button-group {
            margin-top: 20px;
            display: flex;
            gap: 10px;
            justify-content: center;
            align-items: center;
        }

        .button-group .btn,
        .button-group button {
            background: #0b63a6;
            color: #fff;
            border: none;
            padding: 10px 14px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
        }

        .button-group .btn:hover,
        .button-group button:hover {
            opacity: .9;
        }

        .button-group .red {
            background: #ef4444;
        }

        @media print {
            .button-group {
                display: none !important;
            }

            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            table.goods th {
                position: relative;
            }

            @page {
                size: A4;
                margin: 12mm 10mm;
            }

            .page-break {
                page-break-before: always;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Tờ khai nhập khẩu - Thông tin chung 1</h2>

        <fieldset>
            <div class="form-group">
                <label>Nhóm loại hình:</label>
                <input type="text" disabled value="<?= h($to1nk['nhom_loai_hinh'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Mã loại hình:</label>
                <select disabled>
                    <option><?= h($to1nk['ma_loai_hinh'] ?? '') ?></option>
                </select>
                <label style="width:240px">Phân loại cá nhân/tổ chức:</label>
                <select disabled>
                    <option><?= h($to1nk['phan_loai_to_chuc'] ?? '') ?></option>
                </select>
            </div>

            <div class="form-group">
                <label>Cơ quan Hải quan:</label>
                <select disabled>
                    <option><?= h($to1nk['co_quan_hq'] ?? '') ?></option>
                </select>
                <label style="width:240px">Mã hiệu phương thức vận chuyển:</label>
                <select disabled>
                    <option><?= h($to1nk['phuong_thuc_vc'] ?? '') ?></option>
                </select>
            </div>

            <div class="form-group">
                <label>Mã phân loại hàng hóa:</label>
                <select disabled>
                    <option><?= h($to1nk['ma_phan_loai_hang'] ?? '') ?></option>
                </select>
                <label style="width:240px">Mã bộ phận xử lí tờ khai:</label>
                <select disabled>
                    <option><?= h($to1nk['ma_bo_phan_xu_ly'] ?? '') ?></option>
                </select>
            </div>

            <fieldset>
                <legend>Thông tin người nhập khẩu</legend>
                <div class="form-group">
                    <label>Mã số thuế DN:</label>
                    <input type="text" disabled value="<?= h($to1nk['MSTDNNK'] ?? '') ?>">
                    <label style="width: 97px;">Mã bưu chính:</label>
                    <input type="text" disabled value="<?= h($to1nk['MBCNK'] ?? '') ?>">
                </div>
                <div class="form-group"><label>Tên DN:</label><input type="text" disabled
                        value="<?= h($to1nk['TDNNK'] ?? '') ?>"></div>
                <div class="form-group"><label>Địa chỉ DN:</label><input type="text" disabled
                        value="<?= h($to1nk['DCDNNK'] ?? '') ?>"></div>
                <div class="form-group"><label>SĐT DN:</label><input type="text" disabled
                        value="<?= h($to1nk['SDTDNNK'] ?? '') ?>"></div>

                <legend>Thông tin người ủy thác nhập khẩu</legend>
                <div class="form-group"><label>Tên người ủy thác NK:</label><input type="text" disabled
                        value="<?= h($to1nk['NUTNK'] ?? '') ?>"></div>
                <div class="form-group"><label>SĐT người ủy thác NK:</label><input type="text" disabled
                        value="<?= h($to1nk['SDTUTNK'] ?? '') ?>"></div>
                <div class="form-group"><label>Địa chỉ người ủy thác NK:</label><input type="text" disabled
                        value="<?= h($to1nk['DCUTNK'] ?? '') ?>"></div>
            </fieldset>

            <fieldset>
                <legend>Thông tin người xuất khẩu</legend>
                <div class="form-group">
                    <label>MST DN XK:</label><input type="text" disabled value="<?= h($to1nk['MSTDNXK'] ?? '') ?>">
                    <label style="width:120px;">Mã bưu chính XK:</label><input type="text" disabled
                        value="<?= h($to1nk['MBCXK'] ?? '') ?>">
                </div>
                <div class="form-group"><label>Tên DN XK:</label><input type="text" disabled
                        value="<?= h($to1nk['TDNXK'] ?? '') ?>"></div>
                <div class="form-group"><label>Địa chỉ DN XK:</label><input type="text" disabled
                        value="<?= h($to1nk['DCDNXK'] ?? '') ?>"></div>
                <div class="form-group"><label>SĐT DN XK:</label><input type="text" disabled
                        value="<?= h($to1nk['SDTDNXK'] ?? '') ?>"></div>

                <legend>Thông tin người ủy thác xuất khẩu</legend>
                <div class="form-group"><label>Tên người ủy thác XK:</label><input type="text" disabled
                        value="<?= h($to1nk['NUTXK'] ?? '') ?>"></div>
                <div class="form-group"><label>SĐT người ủy thác XK:</label><input type="text" disabled
                        value="<?= h($to1nk['SDTUTXK'] ?? '') ?>"></div>
                <div class="form-group"><label>Địa chỉ người ủy thác XK:</label><input type="text" disabled
                        value="<?= h($to1nk['DCUTXK'] ?? '') ?>"></div>
            </fieldset>

            <fieldset>
                <legend>Thông tin vận đơn</legend>
                <div class="form-group">
                    <label>Số vận đơn:</label><input type="text" disabled value="<?= h($to1nk['SVD'] ?? '') ?>">
                    <label style="width:98px;">Ngày vận đơn:</label><input type="date" disabled
                        value="<?= h($to1nk['NVD'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Số lượng kiện:</label><input type="text" disabled value="<?= h($to1nk['SLK'] ?? '') ?>">
                    <select disabled>
                        <option><?= h($to1nk['don_vi_kien'] ?? '') ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tổng trọng lượng hàng:</label><input type="text" disabled
                        value="<?= h($to1nk['TTLH'] ?? '') ?>">
                    <select disabled>
                        <option><?= h($to1nk['don_vi_tl'] ?? '') ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Mã địa điểm lưu kho:</label><input type="text" disabled
                        value="<?= h($to1nk['MDDLK'] ?? '') ?>">
                    <select disabled>
                        <option><?= h($to1nk['dia_diem_luu_kho'] ?? '') ?></option>
                    </select>
                </div>
                <div class="form-group"><label>Ký hiệu & số hiệu bao bì:</label><input type="text" disabled
                        value="<?= h($to1nk['KH_SHBB'] ?? '') ?>"></div>
                <div class="form-group"><label>Phương tiện vận chuyển:</label><input type="text" disabled
                        value="<?= h($to1nk['so_hieu_tau'] ?? '') ?>"><input type="text" disabled
                        value="<?= h($to1nk['PTVC'] ?? '') ?>"></div>
                <div class="form-group"><label>Ngày hàng đến:</label><input type="date" disabled
                        value="<?= h($to1nk['NHD'] ?? '') ?>"></div>
                <div class="form-group">
                    <label>Địa điểm dỡ hàng:</label><input type="text" disabled value="<?= h($to1nk['DDDH'] ?? '') ?>">
                    <select disabled>
                        <option><?= h($to1nk['ma_dd_dohang'] ?? '') ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Địa điểm xếp hàng:</label><input type="text" disabled value="<?= h($to1nk['DDXH'] ?? '') ?>">
                    <select disabled>
                        <option><?= h($to1nk['ma_dd_xephang'] ?? '') ?></option>
                    </select>
                </div>
                <div class="form-group"><label>Số lượng container:</label><input type="number" disabled
                        value="<?= h($to1nk['SLCT'] ?? '') ?>"></div>
                <div class="form-group">
                    <label>Mã kết quả kiểm tra nội dung:</label>
                    <select disabled>
                        <option><?= h($to1nk['ma_kq_ktnd'] ?? '') ?></option>
                    </select>
                </div>
            </fieldset>
        </fieldset>

        <?php $data = $to2nk ?: []; ?>

        <h2>Tờ khai nhập khẩu - Thông tin chung 2</h2>

        <fieldset>
            <legend>Thông tin giấy phép và văn bản</legend>
            <div class="form-group">
                <label>Mã văn bản phạm quy khác:</label>
                <input type="text" disabled value="<?= h($data['MVBPQK'] ?? '') ?>" readonly>
            </div>
            <div class="form-group">
                <label>Giấy phép nhập khẩu:</label><label>(1):</label>
                <input type="text" disabled value="<?= h($data['GPNK1'] ?? '') ?>" readonly>
                <input type="text" disabled value="<?= h($data['GPNK11'] ?? '') ?>" readonly>
            </div>
            <div class="form-group"><label></label><label>(2):</label>
                <input type="text" disabled value="<?= h($data['GPNK2'] ?? '') ?>" readonly>
                <input type="text" disabled value="<?= h($data['GPNK22'] ?? '') ?>" readonly>
            </div>
            <div class="form-group"><label></label><label>(3):</label>
                <input type="text" disabled value="<?= h($data['GPNK3'] ?? '') ?>" readonly>
                <input type="text" disabled value="<?= h($data['GPNK33'] ?? '') ?>" readonly>
            </div>
            <div class="form-group"><label></label><label>(4):</label>
                <input type="text" disabled value="<?= h($data['GPNK4'] ?? '') ?>" readonly>
                <input type="text" disabled value="<?= h($data['GPNK44'] ?? '') ?>" readonly>
            </div>
        </fieldset>

        <fieldset>
            <legend>Hóa đơn thương mại</legend>
            <div class="form-group">
                <label>Phân loại hình thức hóa đơn:</label>
                <select disabled>
                    <option <?= (($data['PLHTHD'] ?? '') === 'A2') ? 'selected' : ''; ?>>A: Hóa đơn</option>
                    <option <?= (($data['PLHTHD'] ?? '') === 'B2') ? 'selected' : ''; ?>>B: Chứng từ thay thế hóa đơn
                    </option>
                    <option <?= (($data['PLHTHD'] ?? '') === 'D2') ? 'selected' : ''; ?>>D: Hóa đơn điện tử</option>
                </select>
            </div>
            <div class="form-group">
                <label>Số tiếp nhận hóa đơn điện tử:</label><input type="text" disabled
                    value="<?= h($data['STNHDDT'] ?? '') ?>" readonly>
                <label>Số hóa đơn:</label><input type="text" disabled value="<?= h($data['SHD'] ?? '') ?>" readonly>
            </div>
            <div class="form-group">
                <label>Ngày phát hành:</label><input type="date" disabled value="<?= h($data['NPH'] ?? '') ?>" readonly>
                <label>Phương thức thanh toán:</label>
                <select disabled>
                    <option <?= (($data['PTTT'] ?? '') === 'TT') ? 'selected' : ''; ?>>T/T</option>
                    <option <?= (($data['PTTT'] ?? '') === 'TTR') ? 'selected' : ''; ?>>TTR</option>
                    <option <?= (($data['PTTT'] ?? '') === 'COD') ? 'selected' : ''; ?>>COD</option>
                    <option <?= (($data['PTTT'] ?? '') === 'LC') ? 'selected' : ''; ?>>L/C</option>
                </select>
            </div>
            <div class="form-group">
                <label>Mã phân loại hóa đơn:</label>
                <select disabled>
                    <option <?= (($data['MPLHD'] ?? '') === 'A3') ? 'selected' : ''; ?>>A: Hóa đơn thương mại</option>
                    <option <?= (($data['MPLHD'] ?? '') === 'B3') ? 'selected' : ''; ?>>B: Chứng từ thay thế</option>
                    <option <?= (($data['MPLHD'] ?? '') === 'D3') ? 'selected' : ''; ?>>D: Hóa đơn điện tử IVA</option>
                </select>
                <label>Điều kiện giá hóa đơn:</label>
                <select disabled>
                    <?php foreach (['EXW', 'FCA', 'CPT', 'CIP', 'DAP', 'DPU', 'DDP', 'FAS', 'FOB', 'CFR', 'CIF'] as $opt): ?>
                        <option <?= (($data['DKGHD'] ?? '') === $opt) ? 'selected' : ''; ?>><?= $opt ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Tổng trị giá hóa đơn:</label><input type="text" disabled
                    value="<?= nf($data['TTGHD'] ?? null, 2) ?>" readonly>
                <label>Mã đồng tiền hóa đơn:</label>
                <select disabled>
                    <?php foreach (['USD', 'CNY', 'VND', 'JPY', 'KRW'] as $c): ?>
                        <option <?= (($data['MDTHD'] ?? '') === $c) ? 'selected' : ''; ?>><?= $c ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </fieldset>

        <fieldset>
            <legend>Tờ khai trị giá</legend>
            <div class="form-group">
                <label>Mã phân loại khai trị giá:</label>
                <select disabled>
                    <?php
                    $opts = [
                        'MPLKTG0' => "0: Khai trị giá tổng hợp",
                        'MPLKTG1' => "1: Giao dịch hàng hóa giống hệt",
                        'MPLKTG2' => "2: Giao dịch hàng hóa tương tự",
                        'MPLKTG3' => "3: Khấu trừ",
                        'MPLKTG4' => "4: Tính toán",
                        'MPLKTG5' => "5: Tổng hợp một phần hàng hóa",
                        'MPLKTG6' => "6: Trị giá giao dịch",
                        'MPLKTG7' => "7: Giao dịch có quan hệ đặc biệt",
                        'MPLKTG8' => "8: Giao dịch + phân bổ điều chỉnh thủ công",
                        'MPLKTG9' => "9: Suy luận",
                        'MPLKTGZ' => "Z: Tổng hợp chưa đăng ký",
                        'MPLKTGT' => "T: Trường hợp đặc biệt"
                    ];
                    $cur = $data['MPLKTG'] ?? '';
                    foreach ($opts as $k => $txt) {
                        $sel = ($cur === $k) ? 'selected' : '';
                        echo "<option $sel>" . h($txt) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Phí vận chuyển:</label>
                <label style="width:70px;">Mã loại:</label><input style="min-width:100px;max-width:112px;" disabled
                    type="text" value="<?= h($data['ML1'] ?? '') ?>">
                <label style="width:106px;">Mã đồng tiền:</label><input style="min-width:100px;max-width:104px;"
                    disabled type="text" value="<?= h($data['MDT1'] ?? '') ?>">
                <label style="width:124px;">Phí vận chuyển:</label><input style="min-width:90px;max-width:96px;"
                    disabled type="text" value="<?= nf($data['PVC1'] ?? null, 2) ?>">
            </div>
            <div class="form-group">
                <label>Phí bảo hiểm:</label>
                <label style="width:70px;">Mã loại:</label><input style="min-width:100px;max-width:112px;" disabled
                    type="text" value="<?= h($data['ML2'] ?? '') ?>">
                <label style="width:106px;">Mã đồng tiền:</label><input style="min-width:100px;max-width:104px;"
                    disabled type="text" value="<?= h($data['MDT2'] ?? '') ?>">
                <label style="width:124px;">Phí bảo hiểm:</label><input style="min-width:90px;max-width:96px;" disabled
                    type="text" value="<?= nf($data['PBH2'] ?? null, 2) ?>">
            </div>
            <div class="form-group"><label>Chi tiết khai trị giá:</label><input type="text" disabled
                    value="<?= h($data['CTKTG'] ?? '') ?>"></div>
            <div class="form-group">
                <label>Người nộp thuế:</label>
                <select disabled>
                    <option <?= (($data['NNT'] ?? '') === 'NNT1') ? 'selected' : ''; ?>>1: Người nhập khẩu</option>
                    <option <?= (($data['NNT'] ?? '') === 'NNT2') ? 'selected' : ''; ?>>2: Đại lý hải quan</option>
                </select>
            </div>
        </fieldset>

        <fieldset>
            <legend>Thuế và bảo lãnh</legend>
            <div class="form-group">
                <label>Mã lý do đề nghị BP:</label>
                <input type="text" value="<?= h($data['MLDDNBP'] ?? '') ?>" disabled>
                <select disabled>
                    <option <?= (($data['MLDDNBP1'] ?? '') === 'MLDDNBPA') ? 'selected' : ''; ?>>A: chờ xác định mã
                    </option>
                    <option <?= (($data['MLDDNBP1'] ?? '') === 'MLDDNBPB') ? 'selected' : ''; ?>>B: khác</option>
                </select>
            </div>
            <div class="form-group">
                <label>Mã ngân hàng trả thuế thay:</label>
                <input type="text" value="<?= h($data['MNHTTT'] ?? '') ?>" disabled>
                <input type="text" value="<?= h($data['MaNHTTT'] ?? '') ?>" disabled>
            </div>
            <div class="form-group">
                <label>Năm phát hành hạn mức:</label><input type="text" value="<?= h($data['NPHHM'] ?? '') ?>" disabled>
                <label style="width:185px;">Ký hiệu chứng từ hạn mức:</label><input type="text"
                    value="<?= h($data['KHCTHM'] ?? '') ?>" disabled>
            </div>
            <div class="form-group"><label>Số chứng từ hạn mức:</label><input type="text"
                    value="<?= h($data['SCTHM'] ?? '') ?>" disabled></div>
            <div class="form-group"><label>Mã xác định thời hạn nộp thuế:</label><input type="text"
                    value="<?= h($data['MXDTHNT'] ?? '') ?>" disabled></div>
            <div class="form-group">
                <label>Mã ngân hàng bảo lãnh:</label><input type="text" value="<?= h($data['MNHBL'] ?? '') ?>" disabled>
                <input type="text" value="<?= h($data['MNHBL'] ?? '') ?>" disabled>
            </div>
            <div class="form-group">
                <label>Năm phát hành bảo lãnh:</label><input type="text" value="<?= h($data['NPHBL'] ?? '') ?>"
                    disabled>
                <label style="width:185px;">Ký hiệu chứng từ bảo lãnh:</label><input type="text"
                    value="<?= h($data['KHCTBL'] ?? '') ?>" disabled>
            </div>
            <div class="form-group"><label>Số chứng từ bảo lãnh:</label><input type="text"
                    value="<?= h($data['SCTBL'] ?? '') ?>" disabled></div>
        </fieldset>

        <fieldset>
            <legend>Thông tin đính kèm</legend>
            <div class="form-group">
                <label>Số đính kèm khai báo điện tử:</label>
                <label style="width:336px;padding-left:101px;">Phân loại đính kèm</label>
                <label style="padding-left:112px;">Số đính kèm</label>
            </div>
            <div class="form-group"><label style="padding-left:192px;">(1)</label>
                <input type="text" value="<?= h($data['SDKKBDT1'] ?? '') ?>" disabled>
                <input type="text" value="<?= h($data['SDK1'] ?? '') ?>" disabled>
            </div>
            <div class="form-group"><label style="padding-left:192px;">(2)</label>
                <input type="text" value="<?= h($data['SDKKBDT2'] ?? '') ?>" disabled>
                <input type="text" value="<?= h($data['SDK2'] ?? '') ?>" disabled>
            </div>
            <div class="form-group"><label style="padding-left:192px;">(3)</label>
                <input type="text" value="<?= h($data['SDKKBDT3'] ?? '') ?>" disabled>
                <input type="text" value="<?= h($data['SDK3'] ?? '') ?>" disabled>
            </div>
        </fieldset>

        <fieldset>
            <legend>Thông tin vận chuyển</legend>
            <div class="form-group">
                <label>Ngày được phép nhập kho:</label><input type="date" value="<?= h($data['NDPNK'] ?? '') ?>"
                    disabled>
                <label>Ngày khởi hành vận chuyển:</label><input type="date" value="<?= h($data['NKHVC'] ?? '') ?>"
                    disabled>
            </div>
            <div class="form-group">
                <label>Thông tin trung chuyển:</label>
                <label style="padding-left:75px;">Địa điểm</label>
                <label style="padding-left:73px;">Ngày đến</label>
                <label style="padding-left:58px;">Ngày khởi hành</label>
            </div>
            <div class="form-group"><label style="padding-left:192px;">(1)</label>
                <input type="text" value="<?= h($data['DD1'] ?? '') ?>" disabled>
                <input type="date" value="<?= h($data['ND1'] ?? '') ?>" disabled>
                <input type="date" value="<?= h($data['NKH1'] ?? '') ?>" disabled>
            </div>
            <div class="form-group"><label style="padding-left:192px;">(2)</label>
                <input type="text" value <?= '="' . h($data['DD2'] ?? '') . '"' ?> disabled>
                <input type="date" value="<?= h($data['ND2'] ?? '') ?>" disabled>
                <input type="date" value="<?= h($data['NKH2'] ?? '') ?>" disabled>
            </div>
            <div class="form-group"><label style="padding-left:192px;">(3)</label>
                <input type="text" value="<?= h($data['DD3'] ?? '') ?>" disabled>
                <input type="date" value="<?= h($data['ND3'] ?? '') ?>" disabled>
                <input type="date" value="<?= h($data['NKH3'] ?? '') ?>" disabled>
            </div>
            <div class="form-group">
                <label>Địa điểm đích vận chuyển bảo thuế:</label><input type="text"
                    value="<?= h($data['DDDVCBT'] ?? '') ?>" disabled>
                <label style="padding-left:148px;width:219px;">Ngày đến:</label><input type="text"
                    value="<?= h($data['ND11'] ?? '') ?>" disabled>
            </div>
        </fieldset>

        <fieldset>
            <legend>Thông tin hợp đồng</legend>
            <div class="form-group"><label>Số hợp đồng:</label><input type="text" value="<?= h($data['SHD1'] ?? '') ?>"
                    disabled></div>
            <div class="form-group">
                <label>Ngày bắt đầu:</label><input type="date" value="<?= h($data['NBD'] ?? '') ?>" disabled>
                <label style="padding-left:122px;width:219px;">Ngày kết thúc:</label><input type="date"
                    value="<?= h($data['NKT'] ?? '') ?>" disabled>
            </div>
        </fieldset>

        <fieldset>
            <legend>Thông tin khác</legend>
            <div class="form-group">
                <label>Chú thích:</label><input type="text" value="<?= h($data['CT'] ?? '') ?>" disabled>
                <label>Phần quản lý của nội bộ DN:</label><input type="text" value="<?= h($data['PQLNBCDN'] ?? '') ?>"
                    disabled>
            </div>
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
                                    <td>
                                        <div class="cell"><?= h($r['HSC'] ?? '') ?></div>
                                    </td>
                                    <td>
                                        <div class="wrap"><?= h($r['TH'] ?? '') ?></div>
                                    </td>
                                    <td>
                                        <div class="cell"><?= h($r['DVT'] ?? $r['dvt'] ?? '') ?></div>
                                    </td>
                                    <td class="ta-right">
                                        <div class="cell"><?= nf($r['SL'] ?? null, 2) ?></div>
                                    </td>
                                    <td class="ta-right">
                                        <div class="cell"><?= nf($r['GIA'] ?? null, 2) ?></div>
                                    </td>
                                    <td class="ta-right">
                                        <div class="cell"><?= nf($r['VALUE'] ?? null, 2) ?></div>
                                    </td>
                                    <td class="ta-right">
                                        <div class="cell"><?= nf($r['TS'] ?? null, 2) ?></div>
                                    </td>
                                    <td class="ta-right">
                                        <div class="cell"><?= nf($r['TT'] ?? null, 2) ?></div>
                                    </td>
                                </tr>
                            <?php endforeach; else: ?>
                            <tr>
                                <td colspan="9" style="text-align:center;">Không có dữ liệu hàng hóa</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </fieldset>
        <div class="button-group">
            <button type="button" onclick="window.location.href='editNK.php?id=<?= $id ?>'">Sửa</button>
            <button type="button" onclick="window.print()">🖨️ In</button>
            <button type="button" class="red" onclick="window.location.href='../index.php'">Đóng</button>
        </div>
    </div>
</body>

</html>