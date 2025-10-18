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
    <title>Xem tờ khai xuất khẩu</title>
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

    /* Fieldset */
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

    .form-group input,
    .form-group select,
    .form-group textarea {
        flex: 1;
        min-width: 200px;
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
    </style>
</head>

<body>

    <h2>📄 Thông tin tờ khai xuất khẩu</h2>

    <div class="section">
        <div class="info-grid">
            <div><b>Nhóm loại hình:</b> <?= htmlspecialchars($to1xk['nhom_loai_hinh']??'') ?></div>
            <div><b>Mã loại hình:</b> <?= htmlspecialchars($to1xk['ma_loai_hinh']??'') ?></div>
            <div><b>Phân loại cá nhân, tổ chức:</b> <?= htmlspecialchars($to1xk['PLCNTC']??'') ?></div>
            <div><b>Cơ quan hải quan:</b> <?= htmlspecialchars($to1xk['CQHQ']??'') ?></div>
            <div><b>Mã hiệu phương thức vận chuyển:</b> <?= htmlspecialchars($to1xk['MHPTVC']??'') ?></div>
            <div><b>Ngày khai báo dự kiến:</b> <?= htmlspecialchars($to1xk['NKBDK']??'') ?></div>
            <div><b>Mã số thuế doanh nghiệp xuất khẩu:</b> <?= htmlspecialchars($to1xk['MSTDNXK'])??'' ?></div>
            <div><b>Tên doanh nghiệp xuất khẩu:</b> <?= htmlspecialchars($to1xk['TDNXK'])??'' ?></div>
            <div><b>Địa chỉ doanh nghiệp xuất khẩu:</b> <?= htmlspecialchars($to1xk['DCDNXK']??'') ?></div>
            <div><b>SĐT doanh nghiệp xuất khẩu:</b> <?= htmlspecialchars($to1xk['SDTDNXK']??'') ?></div>
            <div><b>Tên người ủy thác xuất khẩu:</b> <?= htmlspecialchars($to1xk['TNUTXK']??'') ?></div>
            <div><b>SĐT người ủy thác xuất khẩu:</b> <?= htmlspecialchars($to1xk['SDTNUTXK']??'') ?></div>
            <div><b>Địa chỉ người ủy thác xuất khẩu:</b> <?= htmlspecialchars($to1xk['DCNUTXK']??'') ?></div>
            <div style="grid-column: 1 / -1;"><b>Mã số thuế doanh nghiệp nhập khẩu:</b>
                <?= htmlspecialchars($to1xk['MSTDNNK'])??'' ?></div>
            <div><b>Tên doanh nghiệp nhập khẩu:</b> <?= htmlspecialchars($to1xk['TDNNK'])??'' ?></div>
            <div><b>Địa chỉ doanh nghiệp nhập khẩu:</b> <?= htmlspecialchars($to1xk['DCDNNK']??'') ?></div>
            <div><b>SĐT doanh nghiệp nhập khẩu:</b> <?= htmlspecialchars($to1xk['SDTDNNK']??'') ?></div>
            <div style="grid-column: 1 / -1;"><b>Tên người ủy thác nhập khẩu:</b>
                <?= htmlspecialchars($to1xk['TNUTNK']??'') ?></div>
            <div><b>SĐT người ủy thác nhập khẩu:</b> <?= htmlspecialchars($to1xk['SDTNUTNK']??'') ?></div>
            <div><b>Địa chỉ người ủy thác nhập khẩu:</b> <?= htmlspecialchars($to1xk['DCNUTNK']??'') ?></div>
            <div style="grid-column: 1 / -1;">
                <b>Số vận đơn:</b> <?= htmlspecialchars($to1xk['SVD'] ?? '') ?>
            </div>
            <div>
                <b>Số lượng kiện:</b> <?= htmlspecialchars($to1xk['SLK'] ?? '') ?>
            </div>
            <div>
                <b>Đơn vị kiện:</b> <?= htmlspecialchars($to1xk['DVK'] ?? '') ?>
            </div>
            <div><b>Tổng trọng lượng hàng:</b> <?= htmlspecialchars($to1xk['TTLH'])??'' ?></div>
            <div><b>Đơn vị tính:</b> <?= htmlspecialchars($to1xk['DVT'])??'' ?></div>
            <div><b>Mã địa điểm lưu kho hàng chờ thông quan dự kiến:</b> <?= htmlspecialchars($to1xk['MDDLKCTQDK']) ?>
            </div>
            <div><b></b> <?= htmlspecialchars($to1xk['MDDLKCTQ']) ?></div>
            <div><b>Địa điểm nhận hàng cuối cùng:</b> <?= htmlspecialchars($to1xk['DDNHCC'] ?? '') ?></div>
            <div><b></b> <?= htmlspecialchars($to1xk['DDNH'] ?? '') ?></div>
            <div><b>Địa điểm xếp hàng:</b> <?= htmlspecialchars($to1xk['DDXH'] ?? '') ?></div>
            <div><b></b> <?= htmlspecialchars($to1xk['DDNH1'] ?? '') ?></div>
            <div><b>Phương tiện vận chuyển:</b> <?= htmlspecialchars($to1xk['col_9999'] ?? '') ?></div>
            <div><b></b> <?= htmlspecialchars($to1xk['PTVC'] ?? '') ?></div>
            <div><b>Ngày hàng đi dự kiến:</b> <?= htmlspecialchars($to1xk['NHDDK'] ?? '') ?></div>
            <div><b>Ký hiệu và số hiệu</b> <?= htmlspecialchars($to1xk['KH_SH'] ?? '') ?></div>
            <div style="grid-column: 1 / -1;"><b>Phân loại hình thức hóa đơn:</b>
                <?= htmlspecialchars($to1xk['PLHTHD'] ?? '') ?></div>
            <div><b>Số tiếp nhận hóa đơn điện tử:</b> <?= htmlspecialchars($to1xk['STNHDDT'] ?? '') ?></div>
            <div><b>Số hóa đơn:</b> <?= htmlspecialchars($to1xk['SHD'] ?? '') ?></div>
            <div><b>Ngày phát hành:</b> <?= htmlspecialchars($to1xk['NPH'] ?? '') ?></div>
            <div><b>Phương thức thanh toán:</b> <?= htmlspecialchars($to1xk['PTTT'] ?? '') ?></div>
            <div><b>Mã phân loại hóa đơn:</b> <?= htmlspecialchars($to1xk['MPLHD'] ?? '') ?></div>
            <div><b>Điều kiện giá hóa đơn:</b> <?= htmlspecialchars($to1xk['DKGHD'] ?? '') ?></div>
            <div><b>Tổng trị giá hóa đơn:</b> <?= htmlspecialchars($to1xk['TTGHD'] ?? '') ?></div>
            <div><b>Mã đồng tiền trị giá hóa đơn:</b> <?= htmlspecialchars($to1xk['MDTTGHD'] ?? '') ?></div>
            <div><b>Trị giá tính thuế:</b> <?= htmlspecialchars($to1xk['TGHD'] ?? '') ?></div>
            <div><b>Mã đồng tiền trị giá tính thuế</b> <?= htmlspecialchars($to1xk['MDTTGTT'] ?? '') ?></div>
            <div><b>Mã lý do đề nghị BP:</b><?= htmlspecialchars($to1xk['MLDDNBP'] ?? '') ?></div>
            <div><b></b> <?= htmlspecialchars($to1xk['MLDDNBP1'] ?? '') ?></div>
            <div><b>Mã ngân hàng trả thuế thay:</b> <?= htmlspecialchars($to1xk['STK'] ?? '') ?></div>
            <div><b></b> <?= htmlspecialchars($to1xk['MNHTTT'] ?? '') ?></div>
            <div><b>Năm phát hành hạn mức:</b> <?= htmlspecialchars($to1xk['NPHHM'] ?? '') ?></div>
            <div><b>Ký hiệu chứng từ hạn mức:</b> <?= htmlspecialchars($to1xk['KHCTHM'] ?? '') ?></div>
            <div style="grid-column: 1 / -1;"><b>Số chứng từ hạn mức:</b> <?= htmlspecialchars($to1xk['SCTHM'] ?? '') ?>
            </div>
            <div style="grid-column: 1 / -1;"><b>Mã xác định thời hạn nộp thuế:</b>
                <?= htmlspecialchars($to1xk['MXDTHNT'] ?? '') ?></div>
            <div><b>Mã ngân hàng bảo lãnh:</b> <?= htmlspecialchars($to1xk['STK2'] ?? '') ?></div>
            <div><b></b> <?= htmlspecialchars($to1xk['MNHBL'] ?? '') ?></div>
            <div><b>Năm phát hành bảo lãnh:</b> <?= htmlspecialchars($to1xk['NPHBL'] ?? '') ?></div>
            <div><b>Ký hiệu chứng từ bảo lãnh:</b> <?= htmlspecialchars($to1xk['KHCTBL'] ?? '') ?></div>
            <div style="grid-column: 1 / -1;"><b>Số chứng từ bảo lãnh:</b>
                <?= htmlspecialchars($to1xk['SCTBL'] ?? '') ?>
            </div>
        </div>
    </div>
    </div>

    <h2>🧾 Thông tin container/Kho bãi</h2>

    <div class="section">
        <div class="info-grid">
            <div><b>Số hợp đồng:</b> <?= htmlspecialchars($to1xk['SHD']) ?></div>
            <div><b>Ngày phát hành:</b> <?= htmlspecialchars($to1xk['NPH']) ?></div>
            <div><b>Phương thức thanh toán:</b> <?= htmlspecialchars($to1xk['PTTT']) ?></div>
            <div><b>Số vận đơn:</b> <?= htmlspecialchars($to1xk['SCTBL']) ?></div>
            <div><b>Ngày vận đơn:</b> <?= htmlspecialchars($to1xk['NPHBL']) ?></div>
            <div><b>Ngân hàng TT:</b> <?= htmlspecialchars($to1xk['MNHTTT']) ?></div>
        </div>
    </div>

    <h2>📦 Danh sách hàng hóa</h2>

    <div class="section">
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
                <?php foreach ($hanghoa as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['HSC']) ?></td>
                    <td><?= htmlspecialchars($row['TH']) ?></td>
                    <td><?= htmlspecialchars($row['DVT']) ?></td>
                    <td><?= htmlspecialchars($row['SL']) ?></td>
                    <td><?= htmlspecialchars($row['GIA']) ?></td>
                    <td><?= htmlspecialchars($row['VALUE']) ?></td>
                    <td><?= htmlspecialchars($row['XX']) ?></td>
                    <td><?= htmlspecialchars($row['GC']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <a href="../index.php" class="btn">⬅ Quay lại trang chủ</a>

</body>

</html>