<?php
require_once(__DIR__."/../core/database.php");

$id = $_GET['id'] ?? null;
if (!$id) die("Không tìm thấy ID tờ khai!");

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

$isAdmin = ($_SESSION['role'] ?? '') === 'admin';
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <title>Tờ khai nhập khẩu - Xem thông tin</title>
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
    </style>
</head>

<body>
    <div class="container">
        <h2>Tờ khai nhập khẩu - Thông tin chung 1</h2>
        <fieldset>
            <div class="form-group">
                <label style="width:219px">Nhóm loại hình:</label>
                <input type="text" disabled value="<?= htmlspecialchars($to1nk['nhom_loai_hinh'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Mã loại hình:</label>
                <select disabled>
                    <option><?= htmlspecialchars($to1nk['ma_loai_hinh'] ?? '') ?></option>
                </select>

                <label style="width:240px">Phân loại cá nhân/tổ chức:</label>
                <select disabled>
                    <option><?= htmlspecialchars($to1nk['phan_loai_to_chuc'] ?? '') ?></option>
                </select>
            </div>

            <div class="form-group">
                <label>Cơ quan Hải quan:</label>
                <select disabled>
                    <option><?= htmlspecialchars($to1nk['co_quan_hq'] ?? '') ?></option>
                </select>

                <label style="width:240px">Mã hiệu phương thức vận chuyển:</label>
                <select disabled>
                    <option><?= htmlspecialchars($to1nk['phuong_thuc_vc'] ?? '') ?></option>
                </select>
            </div>

            <div class="form-group">
                <label>Mã phân loại hàng hóa:</label>
                <select disabled>
                    <option><?= htmlspecialchars($to1nk['ma_phan_loai_hang'] ?? '') ?></option>
                </select>

                <label style="width:240px">Mã bộ phận xử lí tờ khai:</label>
                <select disabled>
                    <option><?= htmlspecialchars($to1nk['ma_bo_phan_xu_ly'] ?? '') ?></option>
                </select>
            </div>

            <fieldset>
                <legend>Thông tin người nhập khẩu</legend>
                <div class="form-group">
                    <label>Mã số thuế doanh nghiệp:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($to1nk['MSTDNNK'] ?? '') ?>">
                    <label style="width:97px;">Mã bưu chính:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($to1nk['MBCNK'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Tên doanh nghiệp:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($to1nk['TDNNK'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Địa chỉ doanh nghiệp:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($to1nk['DCDNNK'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Số điện thoại doanh nghiệp:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($to1nk['SDTDNNK'] ?? '') ?>">
                </div>
                <legend>Thông tin người ủy thác nhập khẩu</legend>
                <div class="form-group">
                    <label>Tên người ủy thác nhập khẩu:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($to1nk['NUTNK'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>SĐT người ủy thác nhập khẩu:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($to1nk['SDTUTNK'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Địa chỉ người ủy thác nhập khẩu:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($to1nk['DCUTNK'] ?? '') ?>">
                </div>
            </fieldset>

            <fieldset>
                <legend>Thông tin người xuất khẩu</legend>
                <div class="form-group">
                    <label>Mã số thuế DN xuất khẩu:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($to1nk['MSTDNXK'] ?? '') ?>">
                    <label style="width:171px;">Mã bưu chính xuất khẩu:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($to1nk['MBCXK'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Tên DN xuất khẩu:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($to1nk['TDNXK'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Địa chỉ DN xuất khẩu:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($to1nk['DCDNXK'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>SĐT DN xuất khẩu:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($to1nk['SDTDNXK'] ?? '') ?>">
                </div>
                <legend>Thông tin người ủy thác xuất khẩu</legend>
                <div class="form-group">
                    <label>Tên người ủy thác xuất khẩu:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($to1nk['NUTXK'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>SĐT người ủy thác xuất khẩu:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($to1nk['SDTUTXK'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Địa chỉ người ủy thác xuất khẩu:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($to1nk['DCUTXK'] ?? '') ?>">
                </div>
            </fieldset>

            <fieldset>
                <legend>Thông tin vận đơn</legend>
                <div class="form-group">
                    <label>Số vận đơn:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($to1nk['SVD'] ?? '') ?>">
                    <label style="width:98px;">Ngày vận đơn:</label>
                    <input type="date" disabled value="<?= htmlspecialchars($to1nk['NVD'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Số lượng kiện:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($to1nk['SLK'] ?? '') ?>">
                    <select disabled>
                        <option><?= htmlspecialchars($to1nk['don_vi_kien'] ?? '') ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tổng trọng lượng hàng:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($to1nk['TTLH'] ?? '') ?>">
                    <select disabled>
                        <option><?= htmlspecialchars($to1nk['don_vi_tl'] ?? '') ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Mã địa điểm lưu kho:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($to1nk['MDDLK'] ?? '') ?>">
                    <select disabled>
                        <option><?= htmlspecialchars($to1nk['dia_diem_luu_kho'] ?? '') ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Ký hiệu & số hiệu bao bì:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($to1nk['KH_SHBB'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Phương tiện vận chuyển:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($to1nk['so_hieu_tau'] ?? '') ?>">
                    <input type="text" disabled value="<?= htmlspecialchars($to1nk['PTVC'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Ngày hàng đến:</label>
                    <input type="date" disabled value="<?= htmlspecialchars($to1nk['NHD'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Địa điểm dỡ hàng:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($to1nk['DDDH'] ?? '') ?>">
                    <select disabled>
                        <option><?= htmlspecialchars($to1nk['ma_dd_dohang'] ?? '') ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Địa điểm xếp hàng:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($to1nk['DDXH'] ?? '') ?>">
                    <select disabled>
                        <option><?= htmlspecialchars($to1nk['ma_dd_xephang'] ?? '') ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Số lượng container:</label>
                    <input type="number" disabled value="<?= htmlspecialchars($to1nk['SLCT'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Mã kết quả kiểm tra nội dung:</label>
                    <select disabled>
                        <option><?= htmlspecialchars($to1nk['ma_kq_ktnd'] ?? '') ?></option>
                    </select>
                </div>
            </fieldset>

            <?php 
$to2nk = $_SESSION['To2NK'] ?? [];
?>
            <h2>Tờ khai nhập khẩu - Thông tin chung 2</h2>
            <fieldset>
                <legend>Thông tin giấy phép và văn bản</legend>
                <div class="form-group">
                    <label>Mã văn bản phạm quy khác:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($data['MVBPQK'] ?? '') ?>" readonly>
                </div>

                <div class="form-group">
                    <label>Giấy phép nhập khẩu:</label>
                    <label>(1):</label>
                    <input type="text" disabled value="<?= htmlspecialchars($data['GPNK1'] ?? '') ?>" readonly>
                    <input type="text" disabled value="<?= htmlspecialchars($data['GPNK11'] ?? '') ?>" readonly>
                </div>
                <div class="form-group">
                    <label></label>
                    <label>(2):</label>
                    <input type="text" disabled value="<?= htmlspecialchars($data['GPNK2'] ?? '') ?>" readonly>
                    <input type="text" disabled value="<?= htmlspecialchars($data['GPNK22'] ?? '') ?>" readonly>
                </div>
                <div class="form-group">
                    <label></label>
                    <label>(3):</label>
                    <input type="text" disabled value="<?= htmlspecialchars($data['GPNK3'] ?? '') ?>" readonly>
                    <input type="text" disabled value="<?= htmlspecialchars($data['GPNK33'] ?? '') ?>" readonly>
                </div>
                <div class="form-group">
                    <label></label>
                    <label>(4):</label>
                    <input type="text" disabled value="<?= htmlspecialchars($data['GPNK4'] ?? '') ?>" readonly>
                    <input type="text" disabled value="<?= htmlspecialchars($data['GPNK44'] ?? '') ?>" readonly>
                </div>
            </fieldset>

            <fieldset>
                <legend>Hóa đơn thương mại</legend>
                <div class="form-group">
                    <label>Phân loại hình thức hóa đơn:</label>
                    <select disabled>
                        <option <?= isset($data['PLHTHD']) && $data['PLHTHD']=='A2'?'selected':'' ?>>A: Hóa đơn</option>
                        <option <?= isset($data['PLHTHD']) && $data['PLHTHD']=='B2'?'selected':'' ?>>B: Chứng từ thay
                            thế
                            hóa đơn</option>
                        <option <?= isset($data['PLHTHD']) && $data['PLHTHD']=='D2'?'selected':'' ?>>D: Hóa đơn điện tử
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Số tiếp nhận hóa đơn điện tử:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($data['STNHDDT'] ?? '') ?>" readonly>
                    <label>Số hóa đơn:</label>
                    <input type="text" disabled value="<?= htmlspecialchars($data['SHD'] ?? '') ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Ngày phát hành:</label>
                    <input type="date" disabled value="<?= htmlspecialchars($data['NPH'] ?? '') ?>" readonly>
                    <label>Phương thức thanh toán:</label>
                    <select disabled>
                        <option <?= isset($data['PTTT']) && $data['PTTT']=='TT'?'selected':'' ?>>T/T</option>
                        <option <?= isset($data['PTTT']) && $data['PTTT']=='TTR'?'selected':'' ?>>TTR</option>
                        <option <?= isset($data['PTTT']) && $data['PTTT']=='COD'?'selected':'' ?>>COD</option>
                        <option <?= isset($data['PTTT']) && $data['PTTT']=='LC'?'selected':'' ?>>L/C</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Mã phân loại hóa đơn:</label>
                    <select disabled>
                        <option <?= isset($data['MPLHD']) && $data['MPLHD']=='A3'?'selected':'' ?>>A: Hóa đơn thương mại
                        </option>
                        <option <?= isset($data['MPLHD']) && $data['MPLHD']=='B3'?'selected':'' ?>>B: Chứng từ thay thế
                        </option>
                        <option <?= isset($data['MPLHD']) && $data['MPLHD']=='D3'?'selected':'' ?>>D: Hóa đơn điện tử
                            IVA
                        </option>
                    </select>
                    <label>Điều kiện giá hóa đơn:</label>
                    <select disabled>
                        <?php
                    $options = ['EXW','FCA','CPT','CIP','DAP','DPU','DDP','FAS','FOB','CFR','CIF'];
                    foreach($options as $opt){
                        $selected = (isset($data['DKGHD']) && $data['DKGHD']==$opt)?'selected':'';
                        echo "<option $selected>$opt</option>";
                    }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tổng trị giá hóa đơn:</label>
                    <input type="number" disabled value="<?= htmlspecialchars($data['TTGHD'] ?? '') ?>" readonly>
                    <label>Mã đồng tiền hóa đơn:</label>
                    <select disabled>
                        <?php
                    $currs = ['USD','CNY','VND','JPY','KRW'];
                    foreach($currs as $c){
                        $selected = (isset($data['MDTHD']) && $data['MDTHD']==$c)?'selected':'';
                        echo "<option $selected>$c</option>";
                    }
                    ?>
                    </select>
                </div>
            </fieldset>

            <fieldset>
                <legend>Tờ khai trị giá</legend>
                <div class="form-group">
                    <label>Mã phân loại khai trị giá:</label>
                    <select disabled>
                        <?php
                    $options = [
                        'MPLKTG0'=>"0: Khai trị giá tổng hợp",
                        'MPLKTG1'=>"1: Xác định trị giá tính thuế theo phương pháp trị giá giao dịch của hàng hóa giống hệt",
                        'MPLKTG2'=>"2: Xác định trị giá tính thuế theo phương pháp giá giao dịch của hàng hóa tương tự",
                        'MPLKTG3'=>"3: Xác định giá tính thuế theo phương pháp khấu trừ",
                        'MPLKTG4'=>"4: Xác định giá tính thuế theo phương pháp tính toán",
                        'MPLKTG5'=>"5: Áp dụng một hoặc nhiều TKTG tổng hợp cho một phần hàng hóa khai báo",
                        'MPLKTG6'=>"6: Áp dụng phương pháp trị giá giao dịch",
                        'MPLKTG7'=>"7: Áp dụng phương pháp trị giá giao dịch trong trường hợp có mối quan hệ đặc biệt nhưng không ảnh hưởng tới trị giá giao dịch",
                        'MPLKTG8'=>"8: Áp dụng phương pháp trị giá giao dịch nhưng phân bổ khoản điều chỉnh tính trị giá tính thuế thủ công",
                        'MPLKTG9'=>"9: Xác định trị giá theo phương pháp suy luận",
                        'MPLKTGZ'=>"Z: Áp dụng TKTG tổng hợp chưa đăng ký vào hệ thống",
                        'MPLKTGT'=>"T: Xác định trị giá trong trường hợp đặc biệt"
                    ];
                    foreach($options as $val=>$txt){
                        $selected = (isset($data['MPLKTG']) && $data['MPLKTG']==$val)?'selected':'';
                        echo "<option $selected>$txt</option>";
                    }
                    ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Phí vận chuyển:</label>
                    <label style="width:70px;">Mã loại:</label>
                    <input style="min-width: 100px;max-width: 112px;" disabled type="text"
                        value="<?= htmlspecialchars($data['ML1'] ?? '') ?>">
                    <label style="width: 106px;">Mã đồng tiền:</label>
                    <input style="min-width: 100px;max-width: 104px;" disabled type="text"
                        value="<?= htmlspecialchars($data['MDT1'] ?? '') ?>">
                    <label style="width: 124px;">Phí vận chuyển:</label>
                    <input style="min-width: 90px;max-width: 96px;" disabled type="text"
                        value="<?= htmlspecialchars($data['PVC1'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label>Phí bảo hiểm:</label>
                    <label style="width:70px;">Mã loại:</label>
                    <input style="min-width: 100px;max-width: 112px;" disabled type="text"
                        value="<?= htmlspecialchars($data['ML2'] ?? '') ?>">
                    <label style="width: 106px;">Mã đồng tiền:</label>
                    <input style="min-width: 100px;max-width: 104px;" type="text"
                        value="<?= htmlspecialchars($data['MDT2'] ?? '') ?>" disabled>
                    <label style="width: 124px;">Phí bảo hiểm:</label>
                    <input style="min-width: 90px;max-width: 96px;" type="text"
                        value="<?= htmlspecialchars($data['PBH2'] ?? '') ?>" disabled>
                </div>

                <div class="form-group">
                    <label>Chi tiết khai trị giá:</label>
                    <input type="text" value="<?= htmlspecialchars($data['CTKTG'] ?? '') ?>" disabled>
                </div>

                <div class="form-group">
                    <label>Người nộp thuế:</label>
                    <select disabled>
                        <option <?= isset($data['NNT']) && $data['NNT']=='NNT1'?'selected':'' ?>>1: Người nhập khẩu
                        </option>
                        <option <?= isset($data['NNT']) && $data['NNT']=='NNT2'?'selected':'' ?>>2: Đại lý hải quan
                        </option>
                    </select>
                </div>
            </fieldset>

            <fieldset>
                <legend>Thuế và bảo lãnh</legend>
                <div class="form-group">
                    <label>Mã lý do đề nghị BP:</label>
                    <input type="text" value="<?= htmlspecialchars($data['MLDDNBP'] ?? '') ?>" disabled>
                    <select disabled>
                        <option <?= isset($data['MLDDNBP1']) && $data['MLDDNBP1']=='MLDDNBPA'?'selected':'' ?>>A: chờ
                            xác
                            định mã</option>
                        <option <?= isset($data['MLDDNBP1']) && $data['MLDDNBP1']=='MLDDNBPB'?'selected':'' ?>>B: khác
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Mã ngân hàng trả thuế thay:</label>
                    <input type="text" value="<?= htmlspecialchars($data['MNHTTT'] ?? '') ?>" disabled>
                    <input type="text" value="<?= htmlspecialchars($data['MaNHTTT'] ?? '') ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Năm phát hành hạn mức:</label>
                    <input type="text" value="<?= htmlspecialchars($data['NPHHM'] ?? '') ?>" disabled>
                    <label style="width: 185px;">Ký hiệu chứng từ hạn mức:</label>
                    <input type="text" value="<?= htmlspecialchars($data['KHCTHM'] ?? '') ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Số chứng từ hạn mức:</label>
                    <input type="text" value="<?= htmlspecialchars($data['SCTHM'] ?? '') ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Mã xác định thời hạn nộp thuế:</label>
                    <input type="text" value="<?= htmlspecialchars($data['MXDTHNT'] ?? '') ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Mã ngân hàng bảo lãnh:</label>
                    <input type="text" value="<?= htmlspecialchars($data['MNHBL'] ?? '') ?>" disabled>
                    <input type="text" value="<?= htmlspecialchars($data['MNHBL'] ?? '') ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Năm phát hành bảo lãnh:</label>
                    <input type="text" value="<?= htmlspecialchars($data['MNHBL'] ?? '') ?>" disabled>
                    <label style="width: 185px;">Ký hiệu chứng từ bảo lãnh:</label>
                    <input type="text" value="<?= htmlspecialchars($data['KHCTBL'] ?? '') ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Số chứng từ bảo lãnh:</label>
                    <input type="text" value="<?= htmlspecialchars($data['SCTBL'] ?? '') ?>" disabled>
                </div>
            </fieldset>
            <fieldset>
                <legend>Thông tin đính kèm</legend>
                <div class="form-group">
                    <label>Số đính kèm khai báo điện tử: </label>
                    <label style="width: 336px;padding-left: 101px;">Phân loại đính kèm</label>
                    <label style="padding-left: 112px;">Số đính kèm</label>
                </div>
                <div class="form-group">
                    <label style="padding-left: 192px">(1)</label>
                    <input type="text" value="<?= htmlspecialchars($data['SDKKBDT1'] ?? '') ?>" disabled>
                    <input type="text" value="<?= htmlspecialchars($data['SDK1'] ?? '') ?>" disabled>
                </div>
                <div class="form-group">
                    <label style="padding-left: 192px">(2)</label>
                    <input type="text" value="<?= htmlspecialchars($data['SDKKBDT2'] ?? '') ?>" disabled>
                    <input type="text" value="<?= htmlspecialchars($data['SDK2'] ?? '') ?>" disabled>
                </div>
                <div class="form-group">
                    <label style="padding-left: 192px">(3)</label>
                    <input type="text" value="<?= htmlspecialchars($data['SDKKBDT3'] ?? '') ?>" disabled>
                    <input type="text" value="<?= htmlspecialchars($data['SDK3'] ?? '') ?>" disabled>
                </div>
            </fieldset>
            <fieldset>
                <legend>Thông tin vận chuyển</legend>
                <div class="form-group">
                    <label>Ngày được phép nhập kho: </label>
                    <input type="date" value="<?= htmlspecialchars($data['NDPNK'] ?? '') ?>" disabled>
                    <label>Ngày khởi hành vận chuyển: </label>
                    <input type="date" value="<?= htmlspecialchars($data['NKHVC'] ?? '') ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Thông tin trung chuyển:</label>
                    <label style="padding-left: 75px;">Địa điểm</label>
                    <label style="padding-left: 73px;">Ngày đến</label>
                    <label style="padding-left: 58px;">Ngày khởi hành</label>
                </div>
                <div class="form-group">
                    <label style="padding-left: 192px;">(1)</label>
                    <input type="text" value="<?= htmlspecialchars($data['DD1'] ?? '') ?>" disabled>
                    <input type="date" value="<?= htmlspecialchars($data['ND1'] ?? '') ?>" disabled>
                    <input type="date" value="<?= htmlspecialchars($data['NKH1'] ?? '') ?>" disabled>
                </div>
                <div class="form-group">
                    <label style="padding-left: 192px;">(2)</label>
                    <input type="text" value="<?= htmlspecialchars($data['DD2'] ?? '') ?>" disabled>
                    <input type="date" value="<?= htmlspecialchars($data['DD2'] ?? '') ?>" disabled>
                    <input type="date" value="<?= htmlspecialchars($data['NKH2'] ?? '') ?>" disabled>
                </div>
                <div class="form-group">
                    <label style="padding-left: 192px;">(3)</label>
                    <input type="text" value="<?= htmlspecialchars($data['DD3'] ?? '') ?>" disabled>
                    <input type="date" value="<?= htmlspecialchars($data['DD3'] ?? '') ?>" disabled>
                    <input type="date" value="<?= htmlspecialchars($data['NKH3'] ?? '') ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Địa điểm đích vận chuyển bảo thuế: </label>
                    <input type="text" value="<?= htmlspecialchars($data['DDDVCBT'] ?? '') ?>" disabled>
                    <label style="padding-left: 148px; width: 219px;">Ngày đến: </label>
                    <input type="text" value="<?= htmlspecialchars($data['ND11'] ?? '') ?>" disabled>
                </div>
            </fieldset>
            <fieldset>
                <legend>Thông tin hợp đồng</legend>
                <div class="form-group">
                    <label>Số hợp đồng:</label>
                    <input type="text" value="<?= htmlspecialchars($data['SHD1'] ?? '') ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Ngày bắt đầu:</label>
                    <input type="date" value="<?= htmlspecialchars($data['NBD'] ?? '') ?>" disabled>
                    <label style="padding-left: 122px;width: 219px;">Ngày kết thúc:</label>
                    <input type="date" value="<?= htmlspecialchars($data['NKT'] ?? '') ?>" disabled>
                </div>
            </fieldset>
            <fieldset>
                <legend>Thông tin khác</legend>
                <div class="form-group">
                    <label>Chú thích:</label>
                    <input type="text" value="<?= htmlspecialchars($data['CT'] ?? '') ?>" disabled>
                    <label>Phần quản lý của nội bộ doanh nghiệp:</label>
                    <input type="text" value="<?= htmlspecialchars($data['PQLNBCDN'] ?? '') ?>" disabled>
                </div>
            </fieldset>
            <h2>Tờ khai nhập khẩu - Danh sách hàng hóa</h2>
            <fieldset>
                <table border="1" width="100%" cellspacing="0" cellpadding="5">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã hàng</th>
                            <th>Tên hàng</th>
                            <th>Đơn vị tính</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Trị giá</th>
                            <th>Thuế suất (%)</th>
                            <th>Tiền thuế</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($to3nk)): ?>
                        <?php foreach ($to3nk as $i => $row): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><input type="text" disabled value="<?= htmlspecialchars($row['ma_hang'] ?? '') ?>">
                            </td>
                            <td><input type="text" disabled value="<?= htmlspecialchars($row['ten_hang'] ?? '') ?>">
                            </td>
                            <td><input type="text" disabled value="<?= htmlspecialchars($row['don_vi'] ?? '') ?>">
                            </td>
                            <td><input type="text" disabled value="<?= htmlspecialchars($row['so_luong'] ?? '') ?>">
                            </td>
                            <td><input type="text" disabled value="<?= htmlspecialchars($row['don_gia'] ?? '') ?>">
                            </td>
                            <td><input type="text" disabled value="<?= htmlspecialchars($row['tri_gia'] ?? '') ?>">
                            </td>
                            <td><input type="text" disabled value="<?= htmlspecialchars($row['thue_suat'] ?? '') ?>">
                            </td>
                            <td><input type="text" disabled value="<?= htmlspecialchars($row['tien_thue'] ?? '') ?>">
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="9" style="text-align:center;">Không có dữ liệu hàng hóa</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </fieldset>

            <div class="button-group" style="text-align:center;margin-top:20px;">
                <button type="button" class="red" onclick="window.location.href='../index.php'">Đóng</button>
            </div>
    </div>
</body>

</html>