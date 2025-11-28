<?php
require_once(__DIR__ . "/../core/database.php");

if (($_SESSION['role'] ?? '') !== 'admin') {
    die("⛔ Bạn không có quyền truy cập trang này!");
}

$id = $_GET['id'] ?? null;
if (!$id)
    die("Thiếu ID tờ khai!");

$sql1 = "SELECT * FROM to1nk WHERE id = ?";
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param("i", $id);
$stmt1->execute();
$to1nk = $stmt1->get_result()->fetch_assoc();

$sql2 = "SELECT * FROM to2nk WHERE to1nk = ?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("i", $id);
$stmt2->execute();
$to2nk = $stmt2->get_result()->fetch_assoc();

$sql3 = "SELECT * FROM to3nk WHERE to1nk = ?";
$stmt3 = $conn->prepare($sql3);
$stmt3->bind_param("i", $id);
$stmt3->execute();
$hanghoa = $stmt3->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Chỉnh sửa tờ khai nhập khẩu</title>
    <style>
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
            margin-bottom: 20px;
        }

        fieldset {
            margin: 20px 0;
            padding: 15px;
            border: 1px solid #ccc;
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

        .date {
            min-width: 80px;
            max-width: 120px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            flex: 1;
            min-width: 200px;
            max-width: 678px;
            padding: 6px;
            border: 1px solid #aaa;
            border-radius: 3px;
        }

        .radio-group {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .button-group {
            text-align: center;
            margin-top: 30px;
        }

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
        }

        button:hover {
            background-color: #286090;
        }

        button.red {
            background-color: #d9534f;
        }

        button.red:hover {
            background-color: #c9302c;
        }

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

        <form action="updateNK.php" method="POST">
            <input type="hidden" name="id" value="<?= $id ?>">
            <fieldset>
                <legend>Nhóm loại hình:</legend>
                <div class="radio-group">
                    <label><input type="radio" value="Kinh doanh, đầu tư" name="nhom_loai_hinh" checked> Kinh doanh,
                        đầu
                        tư</label>
                    <label><input type="radio" value="Sản xuất xuất khẩu" name="nhom_loai_hinh"> Sản xuất
                        xuất
                        khẩu</label>
                    <label><input type="radio" value="Gia công" name="nhom_loai_hinh"> Gia công</label>
                    <label><input type="radio" value="Chế xuất" name="nhom_loai_hinh"> Chế xuất</label>
                </div>
                <div class="form-group">
                    <label>Mã loại hình:</label>
                    <select name="ma_loai_hinh">
                        <option value="" <?= ($to1nk['ma_loai_hinh'] == '') ? 'selected' : '' ?>></option>
                        <option value="A11" <?= ($to1nk['ma_loai_hinh'] == 'A11') ? 'selected' : '' ?>>A11: Nhập kinh
                            doanh tiêu dùng</option>
                        <option value="A12" <?= ($to1nk['ma_loai_hinh'] == 'A12') ? 'selected' : '' ?>>A12: Nhập kinh
                            doanh sản xuất</option>
                    </select>

                    <label style="width:240px">Phân loại cá nhân/tổ chức:</label>
                    <select name="phan_loai_to_chuc">
                        <option value="" <?= ($to1nk['phan_loai_to_chuc'] == '') ? 'selected' : '' ?>></option>
                        <option value="P1" <?= ($to1nk['phan_loai_to_chuc'] == 'P1') ? 'selected' : '' ?>>1: Cá nhân gửi
                            cá nhân</option>
                        <option value="P2" <?= ($to1nk['phan_loai_to_chuc'] == 'P2') ? 'selected' : '' ?>>2: Tổ chức gửi
                            cá nhân</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Cơ quan Hải quan:</label>
                    <select name="co_quan_hq">
                        <option value=""></option>
                        <option value="28NJ" <?= ($to1nk['co_quan_hq'] ?? '') === '28NJ' ? 'selected' : '' ?>>
                            28NJ - Chi cục HQ Hà Nam
                        </option>
                        <option value="01VN" <?= ($to1nk['co_quan_hq'] ?? '') === '01VN' ? 'selected' : '' ?>>
                            01NV - Chi cục HQ Nội Bài
                        </option>
                    </select>

                    <label style="width: 240px">Mã hiệu phương thức vận chuyển:</label>
                    <select name="phuong_thuc_vc">
                        <option value=""></option>
                        <option value="P1" <?= ($to1nk['phuong_thuc_vc'] ?? '') === 'P1' ? 'selected' : '' ?>>
                            1: Đường không
                        </option>
                        <option value="P2" <?= ($to1nk['phuong_thuc_vc'] ?? '') === 'P2' ? 'selected' : '' ?>>
                            2: Đường biển (container)
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Mã phân loại hàng hóa:</label>
                    <select name="ma_phan_loai_hang">
                        <option value=""></option>
                        <option value="A" <?= ($to1nk['ma_phan_loai_hang'] ?? '') === 'A' ? 'selected' : '' ?>>
                            A: Hàng quà biếu, quà tặng
                        </option>
                        <option value="B" <?= ($to1nk['ma_phan_loai_hang'] ?? '') === 'B' ? 'selected' : '' ?>>
                            B: Hàng an ninh, quốc phòng
                        </option>
                    </select>

                    <label style="width: 240px">Mã bộ phận xử lí tờ khai:</label>
                    <select name="ma_bo_phan_xu_ly">
                        <option value=""></option>
                        <option value="00" <?= ($to1nk['ma_bo_phan_xu_ly'] ?? '') === '00' ? 'selected' : '' ?>>
                            00: Bộ phận hàng hóa nhập khẩu hàng mậu dịch Kho TCS.
                        </option>
                        <option value="01" <?= ($to1nk['ma_bo_phan_xu_ly'] ?? '') === '01' ? 'selected' : '' ?>>
                            01: Bộ phận hàng hóa nhập khẩu hàng mậu dịch Kho SCSC.
                        </option>
                    </select>
                </div>
            </fieldset>
            <fieldset>
                <legend>Thông tin người nhập khẩu:</legend>
                <div class="form-group">
                    <label>Mã số thuế DN:</label>
                    <input type="text" value="<?= htmlspecialchars($to1nk['MSTDNNK'] ?? '') ?>">
                    <label style="width: 97px;">Mã bưu chính:</label>
                    <input type="text" value="<?= htmlspecialchars($to1nk['MBCNK'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Tên doanh nghiệp:</label>
                    <input type="text" name="TDNNK" placeholder="Tên doanh nghiệp nhập khẩu"
                        value="<?= htmlspecialchars($to1nk['TDNNK'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                </div>

                <div class="form-group">
                    <label>Địa chỉ doanh nghiệp:</label>
                    <input type="text" name="DCDNNK" placeholder="Địa chỉ doanh nghiệp nhập khẩu"
                        value="<?= htmlspecialchars($to1nk['DCDNNK'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                </div>

                <div class="form-group">
                    <label>Số điện thoại doanh nghiệp:</label>
                    <input type="text" name="SDTDNNK" placeholder="Số điện thoại doanh nghiệp nhập khẩu"
                        value="<?= htmlspecialchars($to1nk['SDTDNNK'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                </div>

                <legend>Thông tin người ủy thác nhập khẩu:</legend>

                <div class="form-group">
                    <label>Tên người ủy thác nhập khẩu:</label>
                    <input type="text" name="NUTNK" placeholder="Tên người ủy thác nhập khẩu"
                        value="<?= htmlspecialchars($to1nk['NUTNK'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                </div>

                <div class="form-group">
                    <label>Số điện thoại người ủy thác nhập khẩu:</label>
                    <input type="text" name="SDTUTNK" placeholder="Số điện thoại người ủy thác nhập khẩu"
                        value="<?= htmlspecialchars($to1nk['SDTUTNK'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                </div>

                <div class="form-group">
                    <label>Địa chỉ người ủy thác nhập khẩu:</label>
                    <input type="text" name="DCUTNK" placeholder="Địa chỉ người ủy thác nhập khẩu"
                        value="<?= htmlspecialchars($to1nk['DCUTNK'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                </div>

            </fieldset>

            <fieldset>
                <legend>Thông tin người xuất khẩu:</legend>

                <div class="form-group">
                    <label>Mã số thuế DN xuất khẩu:</label>
                    <input type="text" name="MSTDNXK" placeholder="Mã số thuế DN xuất khẩu"
                        value="<?= htmlspecialchars($to1nk['MSTDNXK'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

                    <label style="width: 171px;">Mã bưu chính xuất khẩu:</label>
                    <input type="text" name="MBCXK" placeholder="Mã bưu chính xuất khẩu"
                        value="<?= htmlspecialchars($to1nk['MBCXK'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                </div>

                <div class="form-group">
                    <label>Tên DN xuất khẩu:</label>
                    <input type="text" name="TDNXK" placeholder="Tên DN xuất khẩu"
                        value="<?= htmlspecialchars($to1nk['TDNXK'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                </div>

                <div class="form-group">
                    <label>Địa chỉ DN xuất khẩu:</label>
                    <input type="text" name="DCDNXK" placeholder="Địa chỉ DN xuất khẩu"
                        value="<?= htmlspecialchars($to1nk['DCDNXK'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                </div>

                <div class="form-group">
                    <label>SĐT DN xuất khẩu:</label>
                    <input type="text" name="SDTDNXK" placeholder="SĐT DN xuất khẩu"
                        value="<?= htmlspecialchars($to1nk['SDTDNXK'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                </div>

                <legend>Thông tin người ủy thác xuất khẩu:</legend>

                <div class="form-group">
                    <label>Tên người ủy thác xuất khẩu:</label>
                    <input type="text" name="NUTXK" placeholder="Tên người ủy thác xuất khẩu"
                        value="<?= htmlspecialchars($to1nk['NUTXK'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                </div>

                <div class="form-group">
                    <label>SĐT người ủy thác xuất khẩu:</label>
                    <input type="text" name="SDTUTXK" placeholder="SĐT người ủy thác xuất khẩu"
                        value="<?= htmlspecialchars($to1nk['SDTUTXK'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                </div>

                <div class="form-group">
                    <label>Địa chỉ người ủy thác xuất khẩu:</label>
                    <input type="text" name="DCUTXK" placeholder="Địa chỉ người ủy thác xuất khẩu"
                        value="<?= htmlspecialchars($to1nk['DCUTXK'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                </div>
            </fieldset>


            <fieldset>
                <legend>Thông tin vận đơn:</legend>

                <div class="form-group">
                    <label>Số vận đơn:</label>
                    <input type="text" name="SVD" placeholder="Số vận đơn"
                        value="<?= htmlspecialchars($to1nk['SVD'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

                    <label style="width: 98px">Ngày vận đơn:</label>
                    <input type="date" name="NVD"
                        value="<?= htmlspecialchars($to1nk['NVD'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                </div>

                <div class="form-group">
                    <label>Số lượng kiện:</label>
                    <input type="text" name="SLK" placeholder="Số lượng kiện"
                        value="<?= htmlspecialchars($to1nk['SLK'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

                    <select name="don_vi_kien">
                        <option value="" <?= ($to1nk['don_vi_kien'] ?? '') === '' ? 'selected' : '' ?>></option>
                        <option value="SET" <?= ($to1nk['don_vi_kien'] ?? '') === 'SET' ? 'selected' : '' ?>>SET: Bộ
                        </option>
                        <option value="DZN" <?= ($to1nk['don_vi_kien'] ?? '') === 'DZN' ? 'selected' : '' ?>>DZN: Tá
                        </option>
                        <option value="PCE" <?= ($to1nk['don_vi_kien'] ?? '') === 'PCE' ? 'selected' : '' ?>>PCE:
                            Cái/Chiếc</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tổng trọng lượng hàng:</label>
                    <input type="text" name="TTLH" placeholder="Tổng trọng lượng hàng"
                        value="<?= htmlspecialchars($to1nk['TTLH'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

                    <select name="don_vi_tl">
                        <option value="" <?= ($to1nk['don_vi_tl'] ?? '') === '' ? 'selected' : '' ?>></option>
                        <option value="GRM" <?= ($to1nk['don_vi_tl'] ?? '') === 'GRM' ? 'selected' : '' ?>>GRM: Gam
                        </option>
                        <option value="KGM" <?= ($to1nk['don_vi_tl'] ?? '') === 'KGM' ? 'selected' : '' ?>>KGM: Kilogam
                        </option>
                        <option value="TNE" <?= ($to1nk['don_vi_tl'] ?? '') === 'TNE' ? 'selected' : '' ?>>TNE: Tấn
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Mã địa điểm lưu kho:</label>
                    <input type="text" id="MDDLK_code" name="MDDLK" placeholder="Mã địa điểm lưu kho"
                        list="codes-by-region"
                        value="<?= htmlspecialchars($to1nk['MDDLK'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

                    <select name="dia_diem_luu_kho" id="location-select">
                        <option value="<?= htmlspecialchars($to1nk['dia_diem_luu_kho'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                            <?= htmlspecialchars($to1nk['dia_diem_luu_kho'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Ký hiệu & số hiệu bao bì:</label>
                    <input type="text" name="KH_SHBB" placeholder="Ký hiệu và số hiệu bao bì"
                        value="<?= htmlspecialchars($to1nk['KH_SHBB'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                </div>

                <div class="form-group">
                    <label>Phương tiện vận chuyển:</label>
                    <input type="text" name="so_hieu_tau" placeholder="Nếu là tàu biển ghi 9999"
                        value="<?= htmlspecialchars($to1nk['so_hieu_tau'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

                    <input type="text" name="PTVC" placeholder="Phương tiện vận chuyển"
                        value="<?= htmlspecialchars($to1nk['PTVC'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                </div>

                <div class="form-group">
                    <label>Ngày hàng đến:</label>
                    <input type="date" name="NHD"
                        value="<?= htmlspecialchars($to1nk['NHD'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                </div>

                <div class="form-group">
                    <label>Địa điểm dỡ hàng:</label>
                    <input type="text" id="DDDH_code" name="DDDH" placeholder="Địa điểm dỡ hàng" list="codes-by-region"
                        value="<?= htmlspecialchars($to1nk['DDDH'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

                    <select name="ma_dd_dohang" id="location-select2">
                        <option value="<?= htmlspecialchars($to1nk['ma_dd_dohang'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                            <?= htmlspecialchars($to1nk['ma_dd_dohang'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Địa điểm xếp hàng:</label>
                    <input type="text" id="DDXH_code" name="DDXH" placeholder="Địa điểm xếp hàng" list="codes-by-region"
                        value="<?= htmlspecialchars($to1nk['DDXH'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

                    <select name="ma_dd_xephang" id="location-select3">
                        <option value="<?= htmlspecialchars($to1nk['ma_dd_xephang'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                            <?= htmlspecialchars($to1nk['ma_dd_xephang'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Số lượng container:</label>
                    <input type="number" name="SLCT"
                        value="<?= htmlspecialchars($to1nk['SLCT'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                </div>

                <div class="form-group">
                    <label>Mã kết quả kiểm tra nội dung:</label>
                    <select name="ma_kq_ktnd">
                        <option value="" <?= ($to1nk['ma_kq_ktnd'] ?? '') === '' ? 'selected' : '' ?>></option>
                        <option value="A1" <?= ($to1nk['ma_kq_ktnd'] ?? '') === 'A1' ? 'selected' : '' ?>>A: Không có
                            bất thường</option>
                        <option value="B1" <?= ($to1nk['ma_kq_ktnd'] ?? '') === 'B1' ? 'selected' : '' ?>>B: Có bất
                            thường</option>
                        <option value="C1" <?= ($to1nk['ma_kq_ktnd'] ?? '') === 'C1' ? 'selected' : '' ?>>C: Cần tham
                            vấn HQ</option>
                    </select>
                </div>
            </fieldset>
        </form>
        <div class="">
            <h2>Tờ khai nhập khẩu - Thông tin chung 2</h2>
            <form method="POST" action="To3NK.php">
                <fieldset>
                    <div class="form-group">
                        <legend></legend>
                        <label>Mã văn bản phạm quy khác:</label>
                        <input type="text" id="MVBPQK" name="MVBPQK"
                            value="<?= htmlspecialchars($data['MVBPQK'] ?? '') ?>"
                            placeholder="Mã văn bản phạm quy khác">
                    </div>

                    <div class="form-group">
                        <legend></legend>
                        <label>Giấy phép nhập khẩu:</label>
                        <label>(1)</label>
                        <input type="text" id="GPNK1" name="GPNK1"
                            value="<?= htmlspecialchars($data['GPNK1'] ?? '') ?>">
                        <input type="text" id="GPNK11" name="GPNK11"
                            value="<?= htmlspecialchars($data['GPNK11'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <legend></legend>
                        <label></label>
                        <label>(2)</label>
                        <input type="text" id="GPNK2" name="GPNK2"
                            value="<?= htmlspecialchars($data['GPNK2'] ?? '') ?>">
                        <input type="text" id="GPNK22" name="GPNK22"
                            value="<?= htmlspecialchars($data['GPNK22'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <legend></legend>
                        <label></label>
                        <label>(3)</label>
                        <input type="text" id="GPNK3" name="GPNK3"
                            value="<?= htmlspecialchars($data['GPNK3'] ?? '') ?>">
                        <input type="text" id="GPNK33" name="GPNK33"
                            value="<?= htmlspecialchars($data['GPNK33'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <legend></legend>
                        <label></label>
                        <label>(4)</label>
                        <input type="text" id="GPNK4" name="GPNK4"
                            value="<?= htmlspecialchars($data['GPNK4'] ?? '') ?>">
                        <input type="text" id="GPNK44" name="GPNK44"
                            value="<?= htmlspecialchars($data['GPNK44'] ?? '') ?>">
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Hóa đơn thương mại:</legend>

                    <div class="form-group">
                        <label>Phân loại hình thức hóa đơn:</label>
                        <select name="PLHTHD">
                            <option value=""></option>
                            <option value="A2" <?= ($data['PLHTHD'] ?? '') === 'A2' ? 'selected' : '' ?>>A: Hóa đơn
                            </option>
                            <option value="B2" <?= ($data['PLHTHD'] ?? '') === 'B2' ? 'selected' : '' ?>>B: Chứng từ
                                thay thế hóa đơn</option>
                            <option value="D2" <?= ($data['PLHTHD'] ?? '') === 'D2' ? 'selected' : '' ?>>
                                D: Hóa đơn điện tử (trong trường hợp đăng kí hóa đơn điện tử trên VNACCS)
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Số tiếp nhận hóa đơn điện tử:</label>
                        <input type="text" id="STNHDDT" name="STNHDDT"
                            value="<?= htmlspecialchars($data['STNHDDT'] ?? '') ?>"
                            placeholder="Số tiếp nhận hóa đơn điện tử">

                        <label style="padding-left: 36px;">Số hóa đơn:</label>
                        <input type="text" id="SHD" name="SHD" value="<?= htmlspecialchars($data['SHD'] ?? '') ?>"
                            placeholder="Số hóa đơn">
                    </div>

                    <div class="form-group">
                        <label>Ngày phát hành:</label>
                        <input type="date" name="NPH" id="NPH" value="<?= htmlspecialchars($data['NPH'] ?? '') ?>">

                        <label style="padding-left: 37px;">Phương thức thanh toán:</label>
                        <select name="PTTT">
                            <option value=""></option>
                            <option value="TT" <?= ($data['PTTT'] ?? '') === 'TT' ? 'selected' : '' ?>>T/T</option>
                            <option value="TTR" <?= ($data['PTTT'] ?? '') === 'TTR' ? 'selected' : '' ?>>TTR
                            </option>
                            <option value="COD" <?= ($data['PTTT'] ?? '') === 'COD' ? 'selected' : '' ?>>COD
                            </option>
                            <option value="LC" <?= ($data['PTTT'] ?? '') === 'LC' ? 'selected' : '' ?>>L/C</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Mã phân loại hóa đơn: </label>
                        <select name="MPLHD">
                            <option value=""></option>
                            <option value="A3" <?= ($data['MPLHD'] ?? '') === 'A3' ? 'selected' : '' ?>>A: Hóa đơn
                                thương mại</option>
                            <option value="B3" <?= ($data['MPLHD'] ?? '') === 'B3' ? 'selected' : '' ?>>
                                B: Chứng từ thay thế hóa đơn thương mại hoặc không có hóa đơn thương mại
                            </option>
                            <option value="D3" <?= ($data['MPLHD'] ?? '') === 'D3' ? 'selected' : '' ?>>
                                D: Hóa đơn điện tử khai báo qua IVA
                            </option>
                        </select>

                        <label style="padding-left: 37px;">Điều kiện giá hóa đơn: </label>
                        <select name="DKGHD">
                            <option value=""></option>
                            <option value="EXW" <?= ($data['DKGHD'] ?? '') === 'EXW' ? 'selected' : '' ?>>EXW
                            </option>
                            <option value="FCA" <?= ($data['DKGHD'] ?? '') === 'FCA' ? 'selected' : '' ?>>FCA
                            </option>
                            <option value="CPT" <?= ($data['DKGHD'] ?? '') === 'CPT' ? 'selected' : '' ?>>CPT
                            </option>
                            <option value="CIP" <?= ($data['DKGHD'] ?? '') === 'CIP' ? 'selected' : '' ?>>CIP
                            </option>
                            <option value="DAP" <?= ($data['DKGHD'] ?? '') === 'DAP' ? 'selected' : '' ?>>DAP
                            </option>
                            <option value="DPU" <?= ($data['DKGHD'] ?? '') === 'DPU' ? 'selected' : '' ?>>DPU
                            </option>
                            <option value="DDP" <?= ($data['DKGHD'] ?? '') === 'DDP' ? 'selected' : '' ?>>DDP
                            </option>
                            <option value="FAS" <?= ($data['DKGHD'] ?? '') === 'FAS' ? 'selected' : '' ?>>FAS
                            </option>
                            <option value="FOB" <?= ($data['DKGHD'] ?? '') === 'FOB' ? 'selected' : '' ?>>FOB
                            </option>
                            <option value="CFR" <?= ($data['DKGHD'] ?? '') === 'CFR' ? 'selected' : '' ?>>CFR
                            </option>
                            <option value="CIF" <?= ($data['DKGHD'] ?? '') === 'CIF' ? 'selected' : '' ?>>CIF
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tổng trị giá hóa đơn:</label>
                        <input type="number" name="TTGHD" id="TTGHD"
                            value="<?= htmlspecialchars($data['TTGHD'] ?? '') ?>" placeholder="Tổng trị giá hóa đơn">

                        <label style="padding-left: 38px;">Mã đồng tiền hóa đơn :</label>
                        <select name="MDTHD">
                            <option value=""></option>
                            <option value="USD" <?= ($data['MDTHD'] ?? '') === 'USD' ? 'selected' : '' ?>>USD
                            </option>
                            <option value="CNY" <?= ($data['MDTHD'] ?? '') === 'CNY' ? 'selected' : '' ?>>CNY
                            </option>
                            <option value="VND" <?= ($data['MDTHD'] ?? '') === 'VND' ? 'selected' : '' ?>>VND
                            </option>
                            <option value="JPY" <?= ($data['MDTHD'] ?? '') === 'JPY' ? 'selected' : '' ?>>JPY
                            </option>
                            <option value="KRW" <?= ($data['MDTHD'] ?? '') === 'KRW' ? 'selected' : '' ?>>KRW
                            </option>
                        </select>
                    </div>

                </fieldset>

                <fieldset>
                    <legend>Tờ khai trị giá</legend>

                    <div class="form-group">
                        <label>Mã phân loại khai trị giá:</label>
                        <select name="MPLKTG">
                            <option value=""></option>
                            <option value="MPLKTG0" <?= ($data['MPLKTG'] ?? '') === 'MPLKTG0' ? 'selected' : '' ?>>
                                0: Khai trị giá tổng hợp</option>
                            <option value="MPLKTG1" <?= ($data['MPLKTG'] ?? '') === 'MPLKTG1' ? 'selected' : '' ?>>
                                1: Xác định trị giá tính thuế theo phương pháp trị giá giao dịch của hàng hóa giống
                                hệt
                            </option>
                            <option value="MPLKTG2" <?= ($data['MPLKTG'] ?? '') === 'MPLKTG2' ? 'selected' : '' ?>>
                                2: Xác định trị giá tính thuế theo phương pháp giá giao dịch của hàng hóa tương tự
                            </option>
                            <option value="MPLKTG3" <?= ($data['MPLKTG'] ?? '') === 'MPLKTG3' ? 'selected' : '' ?>>
                                3: Xác định giá tính thuế theo phương pháp khấu trừ
                            </option>
                            <option value="MPLKTG4" <?= ($data['MPLKTG'] ?? '') === 'MPLKTG4' ? 'selected' : '' ?>>
                                4: Xác định giá tính thuế theo phương pháp tính toán
                            </option>
                            <option value="MPLKTG5" <?= ($data['MPLKTG'] ?? '') === 'MPLKTG5' ? 'selected' : '' ?>>
                                5: Áp dụng một hoặc nhiều TKTG tổng hợp cho một phần hàng hóa khai báo
                            </option>
                            <option value="MPLKTG6" <?= ($data['MPLKTG'] ?? '') === 'MPLKTG6' ? 'selected' : '' ?>>
                                6: Áp dụng phương pháp trị giá giao dịch
                            </option>
                            <option value="MPLKTG7" <?= ($data['MPLKTG'] ?? '') === 'MPLKTG7' ? 'selected' : '' ?>>
                                7: Áp dụng phương pháp trị giá giao dịch trong trường hợp có mối quan hệ đặc biệt
                                nhưng không ảnh hưởng tới trị giá giao dịch
                            </option>
                            <option value="MPLKTG8" <?= ($data['MPLKTG'] ?? '') === 'MPLKTG8' ? 'selected' : '' ?>>
                                8: Áp dụng phương pháp trị giá giao dịch nhưng phân bổ khoản điều chỉnh thủ công
                            </option>
                            <option value="MPLKTG9" <?= ($data['MPLKTG'] ?? '') === 'MPLKTG9' ? 'selected' : '' ?>>
                                9: Xác định trị giá theo phương pháp suy luận
                            </option>
                            <option value="MPLKTGZ" <?= ($data['MPLKTG'] ?? '') === 'MPLKTGZ' ? 'selected' : '' ?>>
                                Z: Áp dụng TKTG tổng hợp chưa đăng ký</option>
                            <option value="MPLKTGT" <?= ($data['MPLKTG'] ?? '') === 'MPLKTGT' ? 'selected' : '' ?>>
                                T: Xác định trị giá trong trường hợp đặc biệt</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Phí vận chuyển: </label>

                        <label style="width:70px;">Mã loại: </label>
                        <input type="text" name="ML1" id="ML1" value="<?= htmlspecialchars($data['ML1'] ?? '') ?>"
                            style="min-width: 100px;max-width: 112px;">

                        <label style="width: 106px;">Mã đồng tiền: </label>
                        <input type="text" name="MDT1" id="MDT1" value="<?= htmlspecialchars($data['MDT1'] ?? '') ?>"
                            style="min-width: 100px;max-width: 104px;">

                        <label style="width: 124px;">Phí vận chuyển: </label>
                        <input type="text" name="PVC1" id="PVC1" value="<?= htmlspecialchars($data['PVC1'] ?? '') ?>"
                            style="min-width: 100px;max-width: 145px;">
                    </div>

                    <div class="form-group" style="flex-wrap: nowrap;">
                        <label style="width: 219px;">Phí bảo hiểm: </label>

                        <label style="width: 70px;">Mã loại: </label>
                        <input type="text" name="ML2" id="ML2" value="<?= htmlspecialchars($data['ML2'] ?? '') ?>"
                            style="min-width: 95px;max-width: 112px;">

                        <label style="width: 106px;">Mã đồng tiền: </label>
                        <input type="text" name="MDT2" id="MDT2" value="<?= htmlspecialchars($data['MDT2'] ?? '') ?>"
                            style="min-width: 100px;max-width: 104px;">

                        <label style="width: 124px;">Phí bảo hiểm: </label>
                        <input type="text" name="PBH2" id="PBH2" value="<?= htmlspecialchars($data['PBH2'] ?? '') ?>"
                            style="min-width: 95px;max-width: 112px;">
                    </div>

                    <div class="form-group">
                        <label>Chi tiết khai trị giá: </label>
                        <input type="text" name="CTKTG" id="CTKTG" value="<?= htmlspecialchars($data['CTKTG'] ?? '') ?>"
                            placeholder="Chi tiết khai trị giá">
                    </div>

                    <div class="form-group">
                        <label>Người nộp thuế: </label>
                        <select name="NNT">
                            <option value=""></option>
                            <option value="NNT1" <?= ($data['NNT'] ?? '') === 'NNT1' ? 'selected' : '' ?>>1: Người
                                nhập khẩu</option>
                            <option value="NNT2" <?= ($data['NNT'] ?? '') === 'NNT2' ? 'selected' : '' ?>>2: Đại lý
                                hải quan</option>
                        </select>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Thuế và bảo lãnh</legend>

                    <div class="form-group">
                        <label style="width:220px;">Mã lý do đề nghị BP:</label>
                        <input type="text" name="MLDDNBP" value="<?= htmlspecialchars($data['MLDDNBP'] ?? '') ?>"
                            style="min-width:95px; max-width:350px;">
                        <select name="MLDDNBP1">
                            <option value="" checked></option>
                            <option value="MLDDNBPA">A:chờ xác định mã số hàng hóa</option>
                            <option value="MLDDNBPB">B:chờ xác định trị giá tính thuế</option>
                            <option value="MLDDNBPC">C:trường hợp khác</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label style="width:220px;">Mã ngân hàng trả thuế thay:</label>
                        <input type="text" name="MNHTTT" id="MNHTTT"
                            value="<?= htmlspecialchars($data['MNHTTT'] ?? '') ?>"
                            style="min-width:95px; max-width:350px;">
                        <select name="MaNHTTT">
                            <option value="" checked></option>
                            <option value="BIDV">BIDV</option>
                            <option value="TECHCOMBANK">TECHCOMBANK</option>
                            <option value="VPBANK">VPBANK</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label style="width:220px;">Năm phát hành hạn mức:</label>
                        <input type="text" name="NPHHM" id="NPHHM" value="<?= htmlspecialchars($data['NPHHM'] ?? '') ?>"
                            style="min-width:95px; max-width:112px;">

                        <label style="width:185px;">Ký hiệu chứng từ hạn mức:</label>
                        <input type="text" name="KHCTHM" id="KHCTHM"
                            value="<?= htmlspecialchars($data['KHCTHM'] ?? '') ?>"
                            style="min-width:95px; max-width:112px;">

                        <label style="width:152px;">Số chứng từ hạn mức:</label>
                        <input type="text" name="SCTHM" id="SCTHM" value="<?= htmlspecialchars($data['SCTHM'] ?? '') ?>"
                            style="min-width:95px; max-width:112px;">
                    </div>

                    <div class="form-group">
                        <label style="width:220px;">Mã xác định thời hạn nộp thuế:</label>
                        <select name="MXDTHNT">
                            <option value="" checked></option>
                            <option value="MXDTHNTA">A:Trường hợp được áp dụng thời hạn nộp thuế do sử dụng bảo lãnh
                                riêng.</option>
                            <option value="MXDTHNTB">B:Trường hợp được áp dụng thời hạn nộp thuế do sử dụng bảo lãnh
                                chung</option>
                            <option value="MXDTHNTC">C:Trường hợp được áp dụng thời hạn nộp thuế mà không sử dụng
                                bảo lãnh</option>
                            <option value="MXDTHNTD">D:Trong trường hợp nộp thuế ngay.</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label style="width:220px;">Mã ngân hàng bảo lãnh:</label>
                        <input type="text" name="MNHBL" id="MNHBL" value="<?= htmlspecialchars($data['MNHBL'] ?? '') ?>"
                            style="min-width:95px; max-width:350px;">
                        <select name="MNHBL">
                            <option value="" checked></option>
                            <option value="BIDV1">BIDV</option>
                            <option value="TECHCOMBANK1">TECHCOMBANK</option>
                            <option value="VPBANK1">VPBANK</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label style="width:220px;">Năm phát hành bảo lãnh:</label>
                        <input type="text" name="NPHBL" id="NPHBL" value="<?= htmlspecialchars($data['NPHBL'] ?? '') ?>"
                            style="min-width:95px; max-width:112px;">

                        <label style="width:183px;">Ký hiệu chứng từ bảo lãnh:</label>
                        <input type="text" name="KHCTBL" id="KHCTBL"
                            value="<?= htmlspecialchars($data['KHCTBL'] ?? '') ?>"
                            style="min-width:95px; max-width:112px;">

                        <label style="width:168px;">Số chứng từ bảo lãnh:</label>
                        <input type="text" name="SCTBL" id="SCTBL" value="<?= htmlspecialchars($data['SCTBL'] ?? '') ?>"
                            style="min-width:95px; max-width:112px;">
                    </div>

                </fieldset>

                <fieldset>
                    <legend>Thông tin đính kèm</legend>

                    <div class="form-group">
                        <label style="width:200px;">Số đính kèm khai báo điện tử:</label>
                        <label style="width:255px; padding-left:127px;">Phân loại đính kèm</label>
                        <label style="width:285px; padding-left:195px;">Số đính kèm</label>
                    </div>

                    <div class="form-group">
                        <label style="padding-left:192px;">(1)</label>

                        <select name="SDKKBDT1">
                            <option value="" checked></option>
                            <option value="INV1">INV</option>
                            <option value="BL1">B/L</option>
                            <option value="AWB1">AWB</option>
                            <option value="INS1">INS</option>
                            <option value="CON1">CON</option>
                            <option value="DM1">DM</option>
                            <option value="ALL1">ALL</option>
                            <option value="ECT1">ETC</option>
                        </select>

                        <input type="text" name="SDK1" id="SDK1" value="<?= htmlspecialchars($data['SDK1'] ?? '') ?>"
                            style="min-width:95px; max-width:335px;" placeholder="Số đính kèm">
                    </div>

                    <div class="form-group">
                        <label style="padding-left:192px;">(2)</label>

                        <select name="SDKKBDT2">
                            <option value="" checked></option>
                            <option value="INV2">INV</option>
                            <option value="BL2">B/L</option>
                            <option value="AWB2">AWB</option>
                            <option value="INS2">INS</option>
                            <option value="CON2">CON</option>
                            <option value="DM2">DM</option>
                            <option value="ALL2">ALL</option>
                            <option value="ECT2">ETC</option>
                        </select>

                        <input type="text" name="SDK2" id="SDK2" value="<?= htmlspecialchars($data['SDK2'] ?? '') ?>"
                            style="min-width:95px; max-width:335px;" placeholder="Số đính kèm">
                    </div>

                    <div class="form-group">
                        <label style="padding-left:192px;">(3)</label>

                        <select name="SDKKBDT3">
                            <option value="" checked></option>
                            <option value="INV3">INV</option>
                            <option value="BL3">B/L</option>
                            <option value="AWB3">AWB</option>
                            <option value="INS3">INS</option>
                            <option value="CON3">CON</option>
                            <option value="DM3">DM</option>
                            <option value="ALL3">ALL</option>
                            <option value="ECT3">ETC</option>
                        </select>

                        <input type="text" name="SDK3" id="SDK3" value="<?= htmlspecialchars($data['SDK3'] ?? '') ?>"
                            style="min-width:95px; max-width:335px;" placeholder="Số đính kèm">
                    </div>

                </fieldset>

                <fieldset>
                    <legend>Thông tin vận chuyển</legend>

                    <div class="form-group">
                        <label>Ngày được phép nhập kho: </label>
                        <input type="date" name="NDPNK" id="NDPNK"
                            value="<?= htmlspecialchars($data['NDPNK'] ?? '') ?>">

                        <label>Ngày khởi hành vận chuyển: </label>
                        <input type="date" name="NKHVC" id="NKHVC"
                            value="<?= htmlspecialchars($data['NKHVC'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label>Thông tin trung chuyển:</label>
                        <label style="padding-left: 75px;">Địa điểm</label>
                        <label style="padding-left: 73px;">Ngày đến</label>
                        <label style="padding-left: 58px;">Ngày khởi hành</label>
                    </div>

                    <div class="form-group">
                        <label style="padding-left:192px;">(1)</label>
                        <input type="text" name="DD1" id="DD1" value="<?= htmlspecialchars($data['DD1'] ?? '') ?>"
                            placeholder="Địa điểm" style="min-width:95px; max-width:112px;">

                        <input type="date" name="ND1" id="ND1" value="<?= htmlspecialchars($data['ND1'] ?? '') ?>">

                        <input type="date" name="NKH1" id="NKH1" value="<?= htmlspecialchars($data['NKH1'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label style="padding-left:192px;">(2)</label>
                        <input type="text" name="DD2" id="DD2" value="<?= htmlspecialchars($data['DD2'] ?? '') ?>"
                            placeholder="Địa điểm" style="min-width:95px; max-width:112px;">

                        <input type="date" name="ND2" id="ND2" value="<?= htmlspecialchars($data['ND2'] ?? '') ?>">

                        <input type="date" name="NKH2" id="NKH2" value="<?= htmlspecialchars($data['NKH2'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label style="padding-left:192px;">(3)</label>
                        <input type="text" name="DD3" id="DD3" value="<?= htmlspecialchars($data['DD3'] ?? '') ?>"
                            placeholder="Địa điểm" style="min-width:95px; max-width:112px;">

                        <input type="date" name="ND3" id="ND3" value="<?= htmlspecialchars($data['ND3'] ?? '') ?>">

                        <input type="date" name="NKH3" id="NKH3" value="<?= htmlspecialchars($data['NKH3'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label>Địa điểm đích vận chuyển bảo thuế: </label>
                        <select name="DDDVCBT">
                            <option value="03S03" <?= (isset($data['DDDVCBT']) && $data['DDDVCBT'] == '03S03') ? 'selected' : '' ?>>
                                03S03
                            </option>
                        </select>

                        <label style="padding-left:148px; width:219px;">Ngày đến: </label>
                        <input type="date" name="ND11" id="ND11" value="<?= htmlspecialchars($data['ND11'] ?? '') ?>">
                    </div>
                </fieldset>


                <fieldset>
                    <legend>Thông tin hợp đồng</legend>

                    <div class="form-group">
                        <label>Số hợp đồng:</label>
                        <input type="text" name="SHD1" id="SHD1" value="<?= htmlspecialchars($data['SHD1'] ?? '') ?>"
                            placeholder="Số hợp đồng" style="min-width:95px; max-width:112px;">
                    </div>

                    <div class="form-group">
                        <label>Ngày bắt đầu:</label>
                        <input type="date" name="NBD" id="NBD" value="<?= htmlspecialchars($data['NBD'] ?? '') ?>">

                        <label style="padding-left:122px; width:219px;">Ngày kết thúc:</label>
                        <input type=" date" name="NKT" id="NKT" value="<?= htmlspecialchars($data['NKT'] ?? '') ?>">
                    </div>
                </fieldset>


                <fieldset>
                    <legend>Thông tin khác</legend>

                    <div class="form-group">
                        <label>Chú thích:</label>
                        <input type="text" name="CT" id="CT" value="<?= htmlspecialchars($data['CT'] ?? '') ?>"
                            placeholder="Chú thích" style="min-width:95px; max-width:112px;">

                        <label>Phần quản lý của nội bộ doanh nghiệp:</label>
                        <input type="text" name="PQLNBCDN" id="PQLNBCDN"
                            value="<?= htmlspecialchars($data['PQLNBCDN'] ?? '') ?>"
                            placeholder="Số quản lý của nội bộ doanh nghiệp" style="min-width:95px; max-width:320px;">
                    </div>
                </fieldset>
            </form>
            <style>
                /* Container bao bọc (giúp bảng có thể cuộn ngang nếu quá rộng) */
                .goods-wrap {
                    overflow-x: auto;
                    border: 1px solid #ccc;
                    /* Thêm đường viền bao ngoài */
                    max-height: 400px;
                    /* Giới hạn chiều cao và cho phép cuộn dọc */
                    overflow-y: auto;
                }

                /* Định dạng chung cho bảng */
                .goods {
                    width: 100%;
                    border-collapse: collapse;
                    /* Gộp các đường viền lại */
                    table-layout: fixed;
                    /* Giữ các cột có chiều rộng cố định theo COLGROUP */
                }

                /* Định dạng tiêu đề */
                .goods thead th {
                    border: 1px solid #ddd;
                    padding: 10px 5px;
                    text-align: center;
                    font-size: 14px;
                    white-space: nowrap;
                    /* Ngăn tiêu đề xuống dòng */
                    position: sticky;
                    /* Giúp tiêu đề dính khi cuộn dọc */
                    top: 0;
                    z-index: 10;
                }

                /* Định dạng các ô dữ liệu và ô nhập */
                .goods tbody td {
                    border: 1px solid #ddd;
                    padding: 0;
                    /* Xóa padding để input lấp đầy ô */
                    text-align: center;
                }

                .goods tbody input {
                    width: 100%;
                    height: 100%;
                    /* Đảm bảo input lấp đầy ô td */
                    box-sizing: border-box;
                    /* Tính cả padding và border vào width/height */
                    border: none;
                    padding: 8px 5px;
                    text-align: right;
                    /* Căn phải cho các trường số (Số lượng, Đơn giá, Trị giá...) */
                    font-size: 13px;
                    margin: 0;
                }

                /* Căn giữa cho cột STT */
                .goods tbody .stt-col {
                    text-align: center;
                    padding: 8px 5px;
                }

                /* Căn trái cho Tên hàng */
                .goods tbody tr td:nth-child(3) input {
                    text-align: left;
                }

                /* Tô màu nền khi di chuột qua hàng */
                .goods tbody tr:hover {
                    background-color: #f9f9f9;
                }
            </style>
            <fieldset>
                <div class="goods-wrap">
                    <table class="goods">
                        <colgroup>
                            <col style="width:5%">
                            <col style="width:8%">
                            <col style="width:20%">
                            <col style="width:8%">
                            <col style="width:8%">
                            <col style="width:8%">
                            <col style="width:8%">
                            <col style="width:10%">
                            <col style="width:10%">
                            <col style="width:5%">
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
                                <th></th>
                            </tr>
                        </thead>
                        <tbody> <?php foreach ($hanghoa as $i => $h): ?>
                                <tr>
                                    <td class="stt-col">
                                        <?= $i + 1 ?>
                                    </td>

                                    <td><input name="HSC[]" value="<?= htmlspecialchars($h['HSC']) ?>"></td>

                                    <td><input name="TH[]" value="<?= htmlspecialchars($h['TH']) ?>"></td>

                                    <td><input name="DVT[]" value="<?= htmlspecialchars($h['DVT']) ?>"></td>

                                    <td><input name="SL[]" value="<?= htmlspecialchars($h['SL']) ?>"></td>

                                    <td><input name="GIA[]" value="<?= htmlspecialchars($h['GIA']) ?>"></td>

                                    <td><input name="VALUE[]" value="<?= htmlspecialchars($h['VALUE']) ?>"></td>

                                    <td><input name="XX[]" value="<?= htmlspecialchars($h['XX']) ?>"></td>

                                    <td><input name="GC[]" value="<?= htmlspecialchars($h['GC']) ?>"></td>

                                    <td></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </fieldset>
            <button class="btn" type="submit">💾 Lưu thay đổi</button>
            <button class="btn"><a href="done.php?id=<?= $id ?>">Quay lại</a></button>

            <!-- </form> -->
</body>

</html>