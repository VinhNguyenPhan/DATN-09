<?php 
    require_once(__DIR__."/../core/database.php");
    // print_r($_POST);
    // exit();
    if (empty($_SESSION['user_id'])) {
     $redirect = '/DangNhap-DangKyTK/DangNhapDangKyTK.php?next=' . urlencode($_SERVER['REQUEST_URI']);
     header("Location: $redirect");
     exit;
 }
    if(!$_POST){
        header("Location: To1NK.php");
    }
    $_SESSION['To1NK'] = $_POST;
    // echo '<pre>';
    // print_r($_SESSION['To1NK']);
    // exit();

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Tờ khai nhập khẩu</title>
    <link rel="stylesheet" href="style.css?v1.0.2">
</head>

<body>
    <div class="container">
        <h2>Tờ khai nhập khẩu - Thông tin chung 2</h2>
        <form method="POST" action="To3NK.php">
            <fieldset>
                <div class="form-group">
                    <legend></legend>
                    <label>Mã văn bản phạm quy khác:</label>
                    <input type="text" id="MVBPQK" name="MVBPQK" placeholder="Mã văn bản phạm quy khác">
                </div>
                <div class="form-group">
                    <legend></legend>
                    <label>Giấy phép nhập khẩu:</label>
                    <label>(1)</label>
                    <input type="text" id="GPNK1" name="GPNK1">
                    <input type="text" id="GPNK11" name="GPNK11">
                </div>
                <div class="form-group">
                    <legend></legend>
                    <label></label>
                    <label>(2)</label>
                    <input type="text" id="GPNK2" name="GPNK2">
                    <input type="text" id="GPNK22" name="GPNK22">
                </div>
                <div class="form-group">
                    <legend></legend>
                    <label></label>
                    <label>(3)</label>
                    <input type="text" id="GPNK3" name="GPNK3">
                    <input type="text" id="GPNK33" name="GPNK33">
                </div>
                <div class="form-group">
                    <legend></legend>
                    <label></label>
                    <label>(4)</label>
                    <input type="text" id="GPNK4" name="GPNK4">
                    <input type="text" id="GPNK44" name="GPNK44">
                </div>
            </fieldset>
            <fieldset>
                <legend>Hóa đơn thương mại:</legend>
                <div class="form-group">
                    <label>Phân loại hình thức hóa đơn:</label>
                    <select name="PLHTHD">
                        <option value="A2">A: Hóa đơn</option>
                        <option value="B2">B: Chứng từ thay thế hóa đơn</option>
                        <option value="D2">D: Hóa đơn điện tử (trong trường hợp đăng kí hóa đơn điện tử trên VNACCS)
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Số tiếp nhận hóa đơn điện tử:</label>
                    <input type="text" id="STNHDDT" name="STNHDDT" placeholder="Số tiếp nhận hóa đơn điện tử">
                    <label style="padding-left: 36px;">Số hóa đơn:</label>
                    <input type="text" type="text" id="SHD" name="SHD" placeholder="Số hóa đơn">
                </div>
                <div class="form-group">
                    <label>Ngày phát hành:</label>
                    <input type="date" name="NPH" id="NPH">
                    <label style="padding-left: 37px;">Phương thức thanh toán:</label>
                    <select name="PTTT">
                        <option value="TT">T/T</option>
                        <option value="TTR">TTR</option>
                        <option value="COD">COD</option>
                        <option value="LC">L/C</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Mã phân loại hóa đơn: </label>
                    <select name="MPLHD">
                        <option value="A3">A: Hóa đơn thương mại</option>
                        <option value="B3">B: Chứng từ thay thế hóa đơn thương mại hoặc không có hóa đơn thương mại:
                        </option>
                        <option value="D3">D: Hóa đơn điện tử được khai báo qua nghiệp vụ khai hóa đơn IVA</option>
                    </select>
                    <label style="padding-left: 37px;">Điều kiện giá hóa đơn: </label>
                    <select name="DKGHD">
                        <option value="EXW">EXW</option>
                        <option value="FCA">FCA</option>
                        <option value="CPT">CPT</option>
                        <option value="CIP">CIP</option>
                        <option value="DAP">DAP</option>
                        <option value="DPU">DPU</option>
                        <option value="DDP">DDP</option>
                        <option value="FAS">FAS</option>
                        <option value="FOB">FOB</option>
                        <option value="CFR">CFR</option>
                        <option value="CIF">CIF</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tổng trị giá hóa đơn:</label>
                    <input type="number" name="TTGHD" id="TTGHD" placeholder="Tổng trị giá hóa đơn">
                    <label style="padding-left: 38px;">Mã đồng tiền hóa đơn :</label>
                    <select name="MDTHD">
                        <option value="USD">USD</option>
                        <option value="CNY">CNY</option>
                        <option value="VND">VND</option>
                        <option value="JPY">JPY</option>
                        <option value="KRW">KRW</option>
                    </select>
                </div>
            </fieldset>
            <fieldset>
                <legend>Tờ khai trị giá</legend>
                <div class="form-group">
                    <label>Mã phân loại khai trị giá:</label>
                    <select name="MPLKTG">
                        <option value="MPLKTG0">0: Khai trị giá tổng hợp</option>
                        <option value="MPLKTG1">1: Xác định trị giá tính thuế theo phương pháp trị giá giao dịch của
                            hàng
                            hóa giống hệt
                        </option>
                        <option value="MPLKTG2">2: Xác định trị giá tính thuế theo phương pháp giá giao dịch của hàng
                            hóa
                            tương tự</option>
                        <option value="MPLKTG3">3: Xác định giá tính thuế theo phương pháp khấu trừ</option>
                        <option value="MPLKTG4">4: Xác định giá tính thuế theo phương pháp tính toán</option>
                        <option value="MPLKTG5">5: Áp dụng một hoặc nhiều TKTG tổng hợp cho một phần hàng hóa khai báo
                        </option>
                        <option value="MPLKTG6">6: Áp dụng phương pháp trị giá giao dịch</option>
                        <option value="MPLKTG7">7: Áp dụng phương pháp trị giá giao dịch trong trường hợp có mối quan hệ
                            đặc
                            biệt nhưng
                            không ảnh hưởng tới trị giá giao dịch</option>
                        <option value="MPLKTG8">8: Áp dụng phương pháp trị giá giao dịch nhưng phân bổ khoản điều chỉnh
                            tính
                            trị giá tính
                            thuế thủ công, nhập bằng tay vào ô trị giá tính thuế của từng dòng hàng</option>
                        <option value="MPLKTG9">9: Xác định trị giá theo phương pháp suy luận</option>
                        <option value="MPLKTGZ">Z: Áp dụng TKTG tổng hợp chưa đăng ký vào hệ thống</option>
                        <option value="MPLKTGT">T: Xác định trị giá trong trường hợp đặc biệt</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Phí vận chuyển: </label>
                    <label style="width:70px;">Mã loại: </label>
                    <input type="text" name="ML1" id="ML1" style="min-width: 100px;max-width: 112px;">
                    <label style="width: 106px;">Mã đồng tiền: </label>
                    <input type="text" name="MDT1" id="MDT1" style="min-width: 100px;max-width: 104px;">
                    <label style="width: 124px;">Phí vận chuyển: </label>
                    <input type="text" name="PVC1" id="PVC1" style="min-width: 100px;max-width: 145px;">
                </div>
                <div class="form-group" style="flex-wrap: nowrap;">
                    <label style="width: 219px;">Phí bảo hiểm: </label>
                    <label style="width: 70px;">Mã loại: </label>
                    <input type="text" name="ML2" id="ML2" style="min-width: 95px;max-width: 112px;">
                    <label style="width: 106px;">Mã đồng tiền: </label>
                    <input type="text" name="MDT2" id="MDT2" style="min-width: 100px;max-width: 104px;">
                    <label style="width: 124px;">Phí bảo hiểm: </label>
                    <input type="text" name="PBH2" id="PBH2" style="min-width: 95px;max-width: 112px;">
                </div>
                <div class="form-group">
                    <label>Chi tiết khai trị giá: </label>
                    <input type="text" name="CTKTG" id="CTKTG" placeholder="Chi tiết khai trị giá">
                </div>
                <div class="form-group">
                    <label>Người nộp thuế: </label>
                    <select name="NNT">
                        <option value="NNT1">1: Người nhập khẩu</option>
                        <option value="NNT2">2: Đại lý hải quan</option>
                    </select>
                </div>
            </fieldset>
            <fieldset>
                <legend>Thuế và bảo lãnh</legend>
                <div class="form-group">
                    <label>Mã lý do đề nghị BP:</label>
                    <input type="text" name="MLDDNBP" placeholder="Mã lý do đề nghị BP">
                    <select name="MLDDNBP1">
                        <option value="MLDDNBPA">A:chờ xác định mã số hàng hóa</option>
                        <option value="MLDDNBPB">B:chờ xác định trị giá tính thuế</option>
                        <option value="MLDDNBPC">C:trường hợp khác</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Mã ngân hàng trả thuế thay:</label>
                    <input type="text" name="MNHTTT" id="MNHTTT" placeholder="Số tài khoản">
                    <select name="MaNHTTT">
                        <option value="BIDV">BIDV</option>
                        <option value="TECHCOMBANK">TECHCOMBANK</option>
                        <option value="VPBANK">VPBANK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Năm phát hành hạn mức: </label>
                    <input type="text" name="NPHHM" id="NPHHM" placeholder="Năm phát hành hạn mức">
                    <label style="width: 185px;">Ký hiệu chứng từ hạn mức: </label>
                    <input type="text" name="KHCTHM" id="KHCTHM" placeholder="Ký hiệu chứng từ hạn mức">
                    <label>Số chứng từ hạn mức: </label>
                    <input type="text" name="SCTHM" id="SCTHM" placeholder="Số chứng từ hạn mức">
                </div>
                <div class="form-group">
                    <label>Mã xác định thời hạn nộp thuế : </label>
                    <select name="MXDTHNT">
                        <option value="MXDTHNTA">A:Trường hợp được áp dụng thời hạn nộp thuế do sử dụng bảo lãnh riêng.
                        </option>
                        <option value="MXDTHNTB">B:Trường hợp được áp dụng thời hạn nộp thuế do sử dụng bảo lãnh chung
                        </option>
                        <option value="MXDTHNTC">C:Trường hợp được áp dụng thời hạn nộp thuế mà không sử dụng bảo lãnh
                        </option>
                        <option value="MXDTHNTD">D:Trong trường hợp nộp thuế ngay.</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Mã ngân hàng bảo lãnh:</label>
                    <input type="text" name="MNHBL" id="MNHBL" placeholder="Số tài khoản">
                    <select name="MNHBL">
                        <option value="BIDV1">BIDV</option>
                        <option value="TECHCOMBANK1">TECHCOMBANK</option>
                        <option value="VPBANK1">VPBANK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Năm phát hành bảo lãnh: </label>
                    <input type="text" name="NPHBL" id="NPHBL" placeholder="Năm phát hành bảo lãnh">
                    <label style="width: 183px;">Ký hiệu chứng từ bảo lãnh: </label>
                    <input type="text" name="KHCTBL" id="KHCTBL" placeholder="Ký hiệu chứng từ bảo lãnh">
                    <label>Số chứng từ bảo lãnh: </label>
                    <input type="text" name="SCTBL" id="SCTBL" placeholder="Số chứng từ bảo lãnh">
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
                    <select name="SDKKBDT1">
                        <option value="INV1">INV</option>
                        <option value="BL1">B/L</option>
                        <option value="AWB1">AWB</option>
                        <option value="INS1">INS</option>
                        <option value="CON1">CON</option>
                        <option value="DM1">DM</option>
                        <option value="ALL1">ALL</option>
                        <option value="ECT1">ETC</option>
                    </select>
                    <input type="text" name="SDK1" id="SDK1" placeholder="Số đính kèm">
                </div>
                <div class="form-group">
                    <label style="padding-left: 192px">(2)</label>
                    <select name="SDKKBDT2">
                        <option value="INV2">INV</option>
                        <option value="BL2">B/L</option>
                        <option value="AWB2">AWB</option>
                        <option value="AWB2">INS</option>
                        <option value="AWB2">CON</option>
                        <option value="DM2">DM</option>
                        <option value="ALL2">ALL</option>
                        <option value="ECT2">ETC</option>
                    </select>
                    <input type="text" name="SDK2" id="SDK2" placeholder="Số đính kèm">
                </div>
                <div class="form-group">
                    <label style="padding-left: 192px">(3)</label>
                    <select name="SDKKBDT3">
                        <option value="INV3">INV</option>
                        <option value="BL3">B/L</option>
                        <option value="AWB3">AWB</option>
                        <option value="AWB3">INS</option>
                        <option value="AWB3">CON</option>
                        <option value="DM3">DM</option>
                        <option value="ALL3">ALL</option>
                        <option value="ALL3">ETC</option>
                    </select>
                    <input type="text" name="SDK3" id="SDK3" placeholder="Số đính kèm">
                </div>
            </fieldset>
            <fieldset>
                <legend>Thông tin vận chuyển</legend>
                <div class="form-group">
                    <label>Ngày được phép nhập kho: </label>
                    <input type="date" name="NDPNK" id="NDPNK">
                    <label>Ngày khởi hành vận chuyển: </label>
                    <input type="date" name="NKHVC" id="NKHVC">
                </div>
                <div class="form-group">
                    <label>Thông tin trung chuyển:</label>
                    <label style="padding-left: 75px;">Địa điểm</label>
                    <label style="padding-left: 73px;">Ngày đến</label>
                    <label style="padding-left: 58px;">Ngày khởi hành</label>
                </div>
                <div class="form-group">
                    <label style="padding-left: 192px;">(1)</label>
                    <input type="text" name="DD1" id="DD1" placeholder="Địa điểm">
                    <input type="date" name="ND1" id="ND1">
                    <input type="date" name="NKH1" id="NKH1">
                </div>
                <div class="form-group">
                    <label style="padding-left: 192px;">(2)</label>
                    <input type="text" name="DD2" id="DD2" placeholder="Địa điểm">
                    <input type="date" name="ND2" id="ND2">
                    <input type="date" name="NKH2" id="NKH2">
                </div>
                <div class="form-group">
                    <label style="padding-left: 192px;">(3)</label>
                    <input type="text" name="DD3" id="DD3" placeholder="Địa điểm">
                    <input type="date" name="ND3" id="ND3">
                    <input type="date" name="NKH3" id="NKH3">
                </div>
                <div class="form-group">
                    <label>Địa điểm đích vận chuyển bảo thuế: </label>
                    <select name="DDDVCBT">
                        <option value="03S03">03S03</option>
                    </select>
                    <label style="padding-left: 148px; width: 219px;">Ngày đến: </label>
                    <input type="date" name="ND11" id="ND11">
                </div>
            </fieldset>
            <fieldset>
                <legend>Thông tin hợp đồng</legend>
                <div class="form-group">
                    <label>Số hợp đồng:</label>
                    <input type="text" name="SHD1" id="SHD1" placeholder="Số hợp đồng">
                </div>
                <div class="form-group">
                    <label>Ngày bắt đầu:</label>
                    <input type="date" name="NBD" id="NBD">
                    <label style="padding-left: 122px;width: 219px;">Ngày kết thúc:</label>
                    <input type="date" name="NKT" id="NKT">
                </div>
            </fieldset>
            <fieldset>
                <legend>Thông tin khác</legend>
                <div class="form-group">
                    <label>Chú thích:</label>
                    <input type="text" name="CT" id="CT" placeholder="Chú thích">
                    <label>Phần quản lý của nội bộ doanh nghiệp:</label>
                    <input type="text" name="PQLNBCDN" id="PQLNBCDN" placeholder="Số quản lý của nội bộ doanh nghiệp">
                </div>
            </fieldset>
            <div class="button-group">
                <button type="submit" name="action" value="next"
                    onclick="window.location.href='../TKNK/to1NK.php'">Trang trước</button>
                <button type="submit" name="action" value="next"
                    onclick="window.location.href='../TKNK/to3NK.php'">Trang sau</button>
                <button type="button" name="action" value="save">Lưu</button>
                <button type="button" onclick="timToKhai()">Tìm tờ khai</button>
                <button type="button" class="red" onclick="window.location.href='../index.php'">Đóng</button>
            </div>
            <script>
            function timToKhai() {
                alert("Thực hiện tìm tờ khai...");
            }
            </script>
        </form>
    </div>
</body>

</html>