<?php
require_once(__DIR__ . "/../core/database.php");
require_once(__DIR__ . '/../core/phanQuyen.php');
require_role(['employee', 'customer', 'admin']);
if (empty($_SESSION['user_id'])) {
    $redirect = '/DangNhap-DangKyTK/DangNhapDangKyTK.php?next=' . urlencode($_SERVER['REQUEST_URI']);
    header("Location: $redirect");
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Tờ khai xuất khẩu</title>
    <link rel="stylesheet" href="style.css?v1.0.1">
</head>

<body>
    <div class="container">
        <h2>Tờ khai xuất khẩu - Thông tin chung</h2>
        <form method="POST" action="To2XK.php">
            <fieldset>
                <legend>Loại Xuất Khẩu:</legend>
                <div class="radio-group">
                    <label><input type="radio" name="khuvuc" value="trong_nuoc" checked>Trong nước</label>
                    <label><input type="radio" name="khuvuc" value="ngoai_nuoc">Ngoài nước</label>
                </div>
            </fieldset>
            <fieldset>
                <legend>Nhóm loại hình:</legend>
                <div class="radio-group">
                    <label><input type="radio" value="Kinh doanh, đầu tư" name="nhom_loai_hinh" checked> Kinh doanh, đầu
                        tư</label>
                    <label><input type="radio" value="Sản xuất xuất khẩu" name="nhom_loai_hinh"> Sản xuất xuất
                        khẩu</label>
                    <label><input type="radio" value="Gia công" name="nhom_loai_hinh"> Gia công</label>
                    <label><input type="radio" value="Chế xuất" name="nhom_loai_hinh"> Chế xuất</label>
                </div>
            </fieldset>

            <div class="form-group">
                <label>Mã loại hình:</label>
                <select name="MLH">
                    <option value="" checked></option>
                    <option value="Nhập kinh doanh tiêu dùng">A11: Nhập kinh doanh tiêu dùng</option>
                    <option value="Nhập kinh doanh sản xuất">A12: Nhập kinh doanh sản xuất</option>
                    <option value="Chuyển tiêu thụ nội địa từ nguồn tạm nhập">A21: Chuyển tiêu thụ nội địa từ nguồn tạm
                        nhập</option>
                    <option value="Nhập khẩu hàng hóa đã xuất khẩu">A31: Nhập khẩu hàng hóa đã xuất khẩu</option>
                    <option value="Nhập kinh doanh của doanh nghiệp thực hiện quyền nhập khẩu">A41: Nhập kinh doanh của
                        doanh nghiệp thực hiện quyền nhập khẩu</option>
                    <option value="Thay đổi mục đích sử dụng hoặc chuyển tiêu thụ nội địa từ các loại hình
                        khác,
                        trừ tạm nhập">A42: Thay đổi mục đích sử dụng hoặc chuyển tiêu thụ nội địa từ các loại hình
                        khác,
                        trừ tạm nhập
                    </option>
                    <option value="Nhập khẩu hàng hóa thuộc Chương trình ưu đãi thuế">A43: Nhập khẩu hàng hóa thuộc
                        Chương trình ưu đãi thuế</option>
                    <option value="Tạm nhập hàng hóa bán tại cửa hàng miễn thuế">A44: Tạm nhập hàng hóa bán tại cửa hàng
                        miễn thuế</option>
                    <option value="Nhập nguyên liệu của DNCX từ nước ngoài">E11: Nhập nguyên liệu của DNCX từ nước ngoài
                    </option>
                    <option value="Nhập hàng hóa khác vào DNCX">E13: Nhập hàng hóa khác vào DNCX</option>
                    <option value="Nhập nguyên liệu, vật tư của DNCX từ nội địa">E15: Nhập nguyên liệu, vật tư của DNCX
                        từ nội địa</option>
                    <option value="Nhập nguyên liệu, vật tư để gia công cho thương nhân nước ngoài">E21: Nhập nguyên
                        liệu, vật tư để gia công cho thương nhân nước ngoài</option>
                    <option value="Nhập nguyên liệu, vật tư gia công từ hợp đồng khác chuyển sang">E23: Nhập nguyên
                        liệu, vật tư gia công từ hợp đồng khác chuyển sang</option>
                    <option value="Nhập nguyên liệu sản xuất xuất khẩu">E31: Nhập nguyên liệu sản xuất xuất khẩu
                    </option>
                    <option value="Nhập nguyên liệu, vật tư vào kho bảo thuế">E33: Nhập nguyên liệu, vật tư vào kho bảo
                        thuế</option>
                    <option value="Nhập sản phẩm thuê gia công ở nước ngoài">E41: Nhập sản phẩm thuê gia công ở nước
                        ngoài</option>
                    <option value="Tạm nhập hàng kinh doanh tạm nhập tái xuất">G11: Tạm nhập hàng kinh doanh tạm nhập
                        tái xuất</option>
                    <option value="Tạm nhập máy móc, thiết bị phục vụ dự án có thời hạn">G12: Tạm nhập máy móc, thiết bị
                        phục vụ dự án có thời hạn</option>
                    <option value="Tạm nhập miễn thuế">G13: Tạm nhập miễn thuế</option>
                    <option value="Tạm nhập khác">G14: Tạm nhập khác</option>
                    <option value="Tái nhập hàng hóa đã tạm xuất">G51: Tái nhập hàng hóa đã tạm xuất</option>
                    <option value="Hàng nước ngoài gửi kho ngoại quan">C11: Hàng nước ngoài gửi kho ngoại quan</option>
                    <option value="Hàng đưa vào khu phi thuế quan">C21: Hàng đưa vào khu phi thuế quan</option>
                    <option value="Hàng nhập khẩu khác">H11: Hàng nhập khẩu khác</option>
                </select>
                <label style="width: 240px">Phân loại cá nhân/tổ chức:</label>
                <select name="PLCNTC">
                    <option value="" checked></option>
                    <option value="Cá nhân gửi cá nhân">1: Cá nhân gửi cá nhân</option>
                    <option value="Tổ chức gửi cá nhân">2: Tổ chức gửi cá nhân</option>
                    <option value="Cá nhân gửi tổ chức">3: Cá nhân gửi tổ chức</option>
                    <option value="Tổ chức gửi tổ chức">4: Tổ chức gửi tổ chức</option>
                    <option value="Khác">5: Khác</option>
                </select>
            </div>
            <div class="form-group">
                <label>Cơ quan Hải quan:</label>
                <select name="CQHQ">
                    <option value="" checked></option>
                    <option value="28NJ">28NJ - Chi cục HQ Hà Nam</option>
                    <option value="01NV">01NV - Chi cục HQ Nội Bài</option>
                </select>
                <label style="width: 240px">Mã hiệu phương thức vận chuyển:</label>
                <select name="MHPTVC">
                    <option value="" checked></option>
                    <option value="Đường không">1: Đường không</option>
                    <option value="Đường biển (container)">2: Đường biển (container)</option>
                    <option value="Đường biển (hàng rời, lỏng…)">3: Đường biển (hàng rời, lỏng…)</option>
                    <option value="Đường bộ (xe tải)">4: Đường bộ (xe tải)</option>
                    <option value="Đường sắt">5: Đường sắt</option>
                    <option value="Đường sông">6: Đường sông</option>
                    <option value="Khác">9: Khác</option>
                </select>
            </div>
            <div class="form-group">
                <label>Ngày khai báo (dự kiến):</label>
                <input type="date" name="NKBDK" id="NKBDK">
            </div>
            <fieldset>
                <legend>Thông tin người xuất khẩu:</legend>
                <div class="form-group">
                    <label>Mã số thuế doanh nghiệp:</label>
                    <input type="text" name="MSTDNXK" id="MSTDNXK" placeholder="Mã số thuế doanh nghiệp">
                    <label style="width: 97px;">Mã bưu chính:</label>
                    <input type=" text" name="MBCDNXK" id="MBCDNXK" placeholder="Mã bưu chính">
                </div>
                <div class="form-group">
                    <label>Tên doanh nghiệp:</label>
                    <input type="text" name="TDNXK" id="TDNXK" placeholder="Tên doanh nghiệp xuất khẩu">
                </div>
                <div class="form-group">
                    <label>Địa chỉ doanh nghiệp:</label>
                    <input type="text" name="DCDNXK" id="DCDNXK" placeholder="Địa chỉ doanh nghiệp xuất khẩu">
                </div>
                <div class="form-group">
                    <label>Số điện thoại doanh nghiệp:</label>
                    <input type="text" name="SDTDNXK" id="SDTDNXK" placeholder="Số điện thoại doanh nghiệp xuất khẩu">
                </div>
                <legend>Thông tin người ủy thác xuất khẩu:</legend>
                <div class="form-group">
                    <label>Tên người ủy thác:</label>
                    <input type="text" name="TNUTXK" id="TNUTXK" placeholder="Tên người ủy thác xuất khẩu">
                </div>
                <div class="form-group">
                    <label>Số điện thoại người ủy thác:</label>
                    <input type="text" name="SDTNUTXK" id="SDTNUTXK"
                        placeholder="Số điện thoại người ủy thác xuất khẩu">
                </div>
                <div class="form-group">
                    <label>Địa chỉ người ủy thác nhập khẩu:</label>
                    <input type="text" name="DCNUTXK" id="DCNUTXK" placeholder="Địa chỉ người ủy thác xuất khẩu">
                </div>
            </fieldset>
            <fieldset>
                <legend>Thông tin người nhập khẩu:</legend>

                <div class="form-group">
                    <label>Mã số thuế doanh nghiệp nhập khẩu:</label>
                    <input type="text" name="MSTDNNK" id="MSTDNNK" placeholder="Mã số thuế doanh nghiệp nhập khẩu">
                    <label style="width: 171px;">Mã bưu chính nhập khẩu:</label>
                    <input type="text" name="MBCDNNK" id="MBCDNNK" placeholder="Mã bưu chính nhập khẩu">
                </div>
                <div class="form-group">
                    <label>Tên doanh nghiệp nhập khẩu:</label>
                    <input type="text" name="TDNNK" id="TDNNK" placeholder="Tên doanh nghiệp nhập khẩu">
                </div>
                <div class="form-group">
                    <label>Địa chỉ doanh nghiệp nhập khẩu:</label>
                    <input type="text" name="DCDNNK" id="DCDNNK" placeholder="Địa chỉ doanh nghiệp nhập khẩu">
                </div>
                <div class="form-group">
                    <label>Số điện thoại doanh nghiệp nhập khẩu:</label>
                    <input type="text" name="SDTDNNK" id="SDTDNNK" placeholder="Số điện thoại doanh nghiệp nhập khẩu">
                </div>
                <legend>Thông tin người ủy thác nhập khẩu:</legend>
                <div class="form-group">
                    <label>Tên người ủy thác nhập khẩu:</label>
                    <input type="text" name="TNUTNK" id="TNUTNK" placeholder="Tên người ủy thác nhập khẩu">
                </div>
                <div class="form-group">
                    <label>Số điện thoại người ủy thác nhập khẩu:</label>
                    <input type="text" name="SDTNUTNK" id="SDTNUTNK"
                        placeholder="Số điện thoại người ủy thác nhập khẩu">
                </div>
                <div class="form-group">
                    <label>Địa chỉ người ủy thác nhập khẩu:</label>
                    <input type="text" name="DCNUTNK" id="DCNUTNK" placeholder="Địa chỉ người ủy thác nhập khẩu">
                </div>
            </fieldset>

            <fieldset>
                <legend>Thông tin vận đơn:</legend>
                <div class="form-group">
                    <label>Số vận đơn:</label>
                    <input type="text" name="SVD" id="SVD" placeholder="Số vận đơn">
                </div>
                <div class="form-group">
                    <label>Số lượng kiện:</label>
                    <input type="text" name="SLK" id="SLK" placeholder="Số lượng kiện">
                    <select name="DVK">
                        <option value="SET">SET: Bộ</option>
                        <option value="DZN">DZN: Tá</option>
                        <option value="PCE">PCE: Cái/Chiếc</option>
                        <option value="PR">PR: Đôi/Cặp</option>
                        <option value="INC">INC: Inch</option>
                        <option value="MTR">MTR: Mét</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tổng trọng lượng hàng:</label>
                    <input type="text" name="TTLH" id="TTLH" placeholder="Tổng trọng lượng hàng">
                    <select name="DVT">
                        <option value="GRM">GRM: Gam</option>
                        <option value="KGM">KGM: Kilogam</option>
                        <option value="TNE">TNE: Tấn</option>
                        <option value="LBR">LBR: Pao</option>
                    </select>
                </div>
                <div class="form-group" style="margin-top: 10px;">
                    <label>Mã địa điểm lưu kho hàng chờ thông quan dự kiến:</label>
                    <input type="text" id="MDDLK_code" name="MDDLKCTQDK" placeholder="Mã địa điểm lưu kho"
                        list="codes-by-region">
                    <select name="MDDLKCTQ" id="location-select">
                    </select>
                </div>
                <div class="form-group">
                    <label>Địa điểm nhận hàng cuối cùng:</label>
                    <input type="text" name="DDNHCC" id="DDNHCC" placeholder="Địa điểm nhận hàng cuối cùng"
                        list="codes-by-region">
                    <select name="DDNH" id="location-select2">
                    </select>
                </div>
                <div class="form-group">
                    <label>Địa điểm xếp hàng:</label>
                    <input type="text" name="DDXH" id="DDXK" placeholder="Địa điểm xếp hàng">
                    <select name="DDXH1" id="location-select3">
                    </select>
                </div>
                <div class="form-group">
                    <label>Phương tiện vận chuyển:</label>
                    <input type="text" id="col_9999" name="col_9999" placeholder="Nếu là tàu biển ghi 9999"
                        list="codes-by-region">
                    <input type="text" id="PTVC" name="PTVC" placeholder="Phương tiện vận chuyển">
                </div>
                <div class="form-group">
                    <label>Ngày hàng đi dự kiến:</label>
                    <input type="date" name="NHDDK" id="NHDDK">
                </div>
                <div class="form-group">
                    <label>Ký hiệu và số hiệu:</label>
                    <input type="text" name="KH_SH" id="KH_SH" placeholder="Ký hiệu và số hiệu">
                </div>
            </fieldset>
            <fieldset>
                <legend>Thông tin vận đơn:</legend>
                <div class="form-group">
                    <label>Phân loại hình thức hóa đơn:</label>
                    <select name="PLHTHD">
                        <option value="PLHTHDA">A: Giá hóa đơn cho hàng hóa phải trả tiền</option>
                        <option value="PLHTHDB">B: Giá hóa đơn cho hàng hóa không phải trả tiền</option>
                        <option value="PLHTHDC">C: Giá hóa đơn cho hàng hóa bao gồm phải trả tiền và không phải trả tiền
                        </option>
                        <option value="PLHTHDD">D: Các trường hợp khác</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Số tiếp nhận hóa đơn điện tử:</label>
                    <input type="text" name="STNHDDT" id="STNHDDT" placeholder="Số tiếp nhận hóa đơn điện tử">
                    <label style="padding-left: 19px">Số hóa đơn:</label>
                    <input type="text" name="SHD" id="SHD" placeholder="Số hóa đơn">
                </div>
                <div class="form-group">
                    <label>Ngày phát hành:</label>
                    <input type="date" name="NPH" id="NPH">
                    <label style="padding-left: 19px">Phương thức thanh toán:</label>
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
                        <option value="MPLHDA">A: Hóa đơn thương mại</option>
                        <option value="MPLHDB">B: Chứng từ thay thế hóa đơn thương mại hoặc không có hóa đơn thương mại:
                        </option>
                        <option value="MPLHDD">D: Hóa đơn điện tử được khai báo qua nghiệp vụ khai hóa đơn IVA</option>
                    </select>
                    <label style="padding-left: 19px">Điều kiện giá hóa đơn: </label>
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
                    <input type="text" name="TTGHD" id="TTGHD" placeholder="Tổng trị giá hóa đơn">
                    <label style="padding-left: 19px">Mã đồng tiền trị giá hóa đơn :</label>
                    <select name="MDTTGHD">
                        <option value="USD">USD</option>
                        <option value="CNY">CNY</option>
                        <option value="VND">VND</option>
                        <option value="JPY">JPY</option>
                        <option value="KRW">KRW</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Trị giá hóa đơn:</label>
                    <input type="text" name="TGHD" id="TGHD" placeholder="Trị giá hóa đơn">
                    <label style="padding-left: 19px">Mã đồng tiền trị giá tính thuế :</label>
                    <select name="MDTTGTT">
                        <option value="USD1">USD</option>
                        <option value="CNY1">CNY</option>
                        <option value="VND1">VND</option>
                        <option value="JPY1">JPY</option>
                        <option value="KRW1">KRW</option>
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
                    <input type="text" name="STK" placeholder="Số tài khoản">
                    <select name="MNHTTT">
                        <option value="BIDV2">BIDV</option>
                        <option value="TECHCOMBANK2">TECHCOMBANK</option>
                        <option value="VPBANK2">VPBANK</option>
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
                    <input type="text" name="STK2" placeholder="Số tài khoản">
                    <select name="MNHBL">
                        <option value="BIDV1">BIDV</option>
                        <option value="TECHCOMBANK1">TECHCOMBANK</option>
                        <option value="VPBANK1">VPBANK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Năm phát hành bảo lãnh: </label>
                    <input type="date" name="NPHBL" id="NPHBL">
                    <label style="width: 183px;">Ký hiệu chứng từ bảo lãnh: </label>
                    <input type="text" name="KHCUBL" id="KHCTBL" placeholder="Ký hiệu chứng từ bảo lãnh">
                    <label>Số chứng từ bảo lãnh: </label>
                    <input type="text" name="SCTBL" id="SCTBL" placeholder="Số chứng từ bảo lãnh">
                </div>
            </fieldset>
            <fieldset>
                <legend>Thông tin vận chuyển</legend>
                <div class="form-group">
                    <label>Ngày được phép nhập kho: </label>
                    <input type="date" name="NDPNK" id="NDPNK">
                    <label style="width: 218px;padding-left:26px;">Ngày khởi hành vận chuyển: </label>
                    <input type="date" name="NKHVC" id="NKHVC">
                </div>
                <div class="form-group">
                    <label>Thông tin trung chuyển:</label>
                    <label style="padding-left:75px">Địa điểm</label>
                    <label style="padding-left:73px">Ngày đến</label>
                    <label style="padding-left:58px">Ngày khởi hành</label>
                </div>
                <div class="form-group">
                    <label style="padding-left:192px">(1)</label>
                    <input type="text" name="DD1" id="DD1" placeholder="Địa điểm">
                    <input type="date" name="ND1" id="ND1">
                    <input type="date" name="NKH1" id="NKH1">
                </div>
                <div class="form-group">
                    <label style="padding-left:192px">(2)</label>
                    <input type="text" name="DD2" id="DD2" placeholder="Địa điểm">
                    <input type="date" name="ND2" id="ND2">
                    <input type="date" name="NKH2" id="NKH2">
                </div>
                <div class="form-group">
                    <label style="padding-left:192px">(3)</label>
                    <input type="text" name="DD3" id="DD3" placeholder="Địa điểm">
                    <input type="date" name="ND3" id="ND3">
                    <input type="date" name="NKH3" id="NKH3">
                </div>
                <div class="form-group">
                    <label>Địa điểm đích vận chuyển bảo thuế: </label>
                    <select name="DDDVCBT">
                        <option value="03S03">03S03</option>
                    </select>
                    <label style="width: 218px;padding-left: 146px;">Ngày đến: </label>
                    <input type="date" name="ND11">
                </div>
            </fieldset>
            <div class="button-group">
                <button type="submit" name="action" value="next"
                    onclick="window.location.href='../TKXK/to2XK.php'">Trang sau</button>
                <button type="button" class="red" onclick="window.location.href='../index.php'">Đóng</button>
            </div>
            <script>
            function timToKhai() {
                alert("Thực hiện tìm tờ khai...");
            }
            </script>
        </form>
    </div>

    <script>
    const locations = {
        trong_nuoc: [{
                code: "",
                name: ""
            },
            {
                code: "03CCS01",
                name: "HOÀNG DIỆU"
            },
            {
                code: "03CCS03",
                name: "TÂN CẢNG"
            },
            {
                code: "03CCS18",
                name: "HECHUN"
            },
            {
                code: "03CC0ZZ",
                name: "ĐĐ LƯU KHO KVI"
            },
            {
                code: "03CES01",
                name: "HẢI AN"
            },
            {
                code: "03CES02",
                name: "CHÙA VẼ"
            },
            {
                code: "03CES03",
                name: "KHO VIETFRACHT"
            },
            {
                code: "03CES04",
                name: "KHO NAM PHÁT (HAI MINH)"
            },
            {
                code: "03CES05",
                name: "KHO SAO ĐỎ"
            },
            {
                code: "03CES06",
                name: "KHO INLACO"
            },
            {
                code: "03CES07",
                name: "KHO TÂN TIÊN PHONG"
            },
            {
                code: "03CES11",
                name: "NAM ĐÌNH VŨ"
            },
            {
                code: "03CES14",
                name: "MPC PORT (MIPEC)"
            },
            {
                code: "03TGS01",
                name: "CẢNG NAM HẢI"
            },
            {
                code: "03TGS02",
                name: "CẢNG ĐOẠN XÁ"
            },
            {
                code: "03TGS03",
                name: "CẢNG TRANSVINA"
            },
            {
                code: "03TGS04",
                name: "CẢNG GREEN PORT"
            },
            {
                code: "03TGC01",
                name: "KHO VINABRIDGE"
            },
            {
                code: "03TGC02",
                name: "KHO VICONSHIP"
            },
            {
                code: "03TGC03",
                name: "KHO GERMADEPT ĐÔNG HẢI"
            },
            {
                code: "03TGC04",
                name: "KHO VIJACO"
            },
            {
                code: "03TGC05",
                name: "KHO LOGISTICS XANH"
            },
            {
                code: "03TGC06",
                name: "KHO CFS GLC"
            },
            {
                code: "03EES01",
                name: "CẢNG ĐÌNH VŨ"
            },
            {
                code: "03EES02",
                name: "TÂN CẢNG 189"
            },
            {
                code: "20CFS09",
                name: "CẢNG CÁI LÂN"
            },
            {
                code: "03CCS03",
                name: "CẢNG CÁI MÉP"
            },
            {
                code: "34CES01",
                name: "CẢNG TIÊN SA"
            },
            {
                code: "03EES09",
                name: "TÂN CẢNG 128"
            },
            {
                code: "03TGS02",
                name: "Tanamexco"
            }
        ],
        ngoai_nuoc: [{
                code: "",
                name: ""
            },
            {
                code: "JPMOJ",
                name: "Moji"
            },
            {
                code: "JPFUK",
                name: "Fukuoka"
            },
            {
                code: "JPNGO",
                name: "Nagoya"
            },
            {
                code: "CNSHA",
                name: "Shanghai"
            },
            {
                code: "CNSZX",
                name: "Shenzhen"
            },
            {
                code: "CNCAN",
                name: "Guangzhou"
            },
            {
                code: "CNCZZ",
                name: "Cangzhou"
            },
            {
                code: "KRPUS",
                name: "Busan"
            },
            {
                code: "KRINC",
                name: "Incheon"
            },
            {
                code: "SGSIN",
                name: "Singapore (Port)"
            },
            {
                code: "NLAMS",
                name: "Rotterdam"
            },
            {
                code: "USNYC",
                name: "New Jersey port area"
            },
            {
                code: "BRSSZ",
                name: "Santos"
            },
            {
                code: "DEHAM",
                name: "Hamburg"
            },
            {
                code: "ESVLC",
                name: "Valencia"
            },
            {
                code: "CAVAN",
                name: "Vancouver"
            },
            {
                code: "MAMAZ",
                name: "Manzanillo"
            },
            {
                code: "AUMEL",
                name: "Melbourne / Sydney"
            },
            {
                code: "INJNP",
                name: "Jawaharlal Nehru (JNPT)"
            },
            {
                code: "TRIST",
                name: "Istanbul"
            },
            {
                code: "THSRI",
                name: "Sriracha Harbour"
            },
            {
                code: "THSGZ",
                name: "Songkhla Port"
            },
            {
                code: "IDTPP",
                name: "Tanjung Priok (Jakarta)"
            },
            {
                code: "IDDUM",
                name: "Dumai Port"
            },
            {
                code: "MYPKG",
                name: "Port Klang"
            },
            {
                code: "PHMNL",
                name: "Port of Manila"
            },
            {
                code: "MYPEN",
                name: "Penang Port"
            }
        ]
    };

    /* =======================
            2) HELPERS CHUNG
            ======================= */
    function getCurrentRegion() {
        const checked = document.querySelector('input[name="khuvuc"]:checked');
        return checked ? checked.value : 'trong_nuoc';
    }

    // Gom unique theo code, uppercase để khớp so sánh
    function buildOptionsByRegion(region) {
        const uniq = new Map();
        (locations[region] || []).forEach(loc => {
            const code = (loc.code || '').toUpperCase();
            if (!uniq.has(code)) uniq.set(code, loc.name || '');
        });
        return Array.from(uniq.entries()).map(([code, name]) => ({
            code,
            name
        }));
    }


    /* =======================
      3) POPULATE SELECT THEO KHU VỰC
      ======================= */
    function populateSelectFromRegion(selectId, region) {
        const select = document.getElementById(selectId);
        if (!select) return;
        const keep = select.value;
        select.innerHTML = '';

        // option rỗng
        const empty = document.createElement('option');
        empty.value = '';
        empty.textContent = '';
        select.appendChild(empty);

        buildOptionsByRegion(region).forEach(({
            code,
            name
        }) => {
            const op = document.createElement('option');
            op.value = code;
            op.textContent = name || code;
            select.appendChild(op);
        });

        if (keep && Array.from(select.options).some(o => o.value === keep)) {
            select.value = keep;
        } else {
            select.value = '';
        }
    }

    /* =======================
       4) ĐỒNG BỘ INPUT ↔ SELECT
       ======================= */
    function syncInputToSelect(inputId, selectId) {
        const input = document.getElementById(inputId);
        const select = document.getElementById(selectId);
        if (!input || !select) return;
        const val = (input.value || '').trim().toUpperCase();
        select.value = val && Array.from(select.options).some(o => (o.value || '').toUpperCase() === val) ? val :
            '';
    }

    function syncSelectToInput(selectId, inputId) {
        const input = document.getElementById(inputId);
        const select = document.getElementById(selectId);
        if (!input || !select) return;
        input.value = select.value || '';
    }

    /* =======================
       5) BIND CẶP INPUT/SELECT
          - regionOverride: 'trong_nuoc' | 'ngoai_nuoc' | null
       ======================= */
    function bindInputSelectPair({
        inputId,
        selectId,
        regionSensitive = true,
        regionOverride = null
    }) {
        const input = document.getElementById(inputId);
        const select = document.getElementById(selectId);
        if (!input || !select) return;

        const resolveRegion = () => regionOverride || getCurrentRegion();

        // Render lần đầu
        populateSelectFromRegion(selectId, resolveRegion());

        // Gõ mã → ép UPPERCASE + sync
        input.addEventListener('input', () => {
            input.value = input.value.toUpperCase();
            syncInputToSelect(inputId, selectId);
        });

        // Chọn option → điền ngược mã
        select.addEventListener('change', () => syncSelectToInput(selectId, inputId));

        // Rời ô → snap theo mã
        input.addEventListener('blur', () => syncInputToSelect(inputId, selectId));

        // Khởi tạo đồng bộ
        syncInputToSelect(inputId, selectId);

        return {
            refreshByRegion() {
                // Nếu cặp này có override → không bị ảnh hưởng khi đổi khu vực
                if (regionOverride) return;
                if (!regionSensitive) return;
                populateSelectFromRegion(selectId, resolveRegion());
                syncInputToSelect(inputId, selectId);
            }
        };
    }

    /* =======================
       6) DATALIST GỢI Ý CƠ BẢN (FALLBACK)
       ======================= */
    function populateDatalistFromRegion(datalistId, region) {
        const dl = document.getElementById(datalistId);
        if (!dl) return;
        dl.innerHTML = '';

        const empty = document.createElement('option');
        empty.value = '';
        empty.label = '';
        dl.appendChild(empty);

        buildOptionsByRegion(region).forEach(({
            code,
            name
        }) => {
            const op = document.createElement('option');
            op.value = code;
            op.label = name || code;
            op.textContent = `${code} — ${name}`;
            dl.appendChild(op);
        });
    }

    /* =======================
       7) AUTOCOMPLETE TÙY BIẾN (HIỆN KHI GÕ)
       ======================= */
    (function injectAutocompleteStyles() {
        const css = `
  .ac-wrap{position:relative}
  .ac-list{
    position:absolute; z-index:9999; top:100%; left:0; right:0;
    max-height:220px; overflow:auto; border:1px solid #e5e7eb; background:#fff;
    border-radius:8px; box-shadow:0 6px 20px rgba(0,0,0,.08)
  }
  .ac-item{padding:8px 10px; cursor:pointer; font-size:14px; line-height:1.3}
  .ac-item:hover,.ac-item.active{background:#f3f4f6}
  .ac-muted{color:#6b7280; font-size:12px; margin-left:6px}
  .hidden{display:none}`;
        const style = document.createElement('style');
        style.textContent = css;
        document.head.appendChild(style);
    })();

    function getCodeList(region) {
        return buildOptionsByRegion(region)
            .filter(it => it.code)
            .sort((a, b) => a.code.localeCompare(b.code));
    }

    function attachAutocomplete({
        inputId,
        selectId,
        regionOverride = null
    }) {
        const input = document.getElementById(inputId);
        if (!input) return;

        // Bọc input
        if (!input.parentElement.classList.contains('ac-wrap')) {
            const wrap = document.createElement('div');
            wrap.className = 'ac-wrap';
            input.parentElement.insertBefore(wrap, input);
            wrap.appendChild(input);
        }
        const wrap = input.parentElement;

        // Tạo list
        let list = wrap.querySelector('.ac-list');
        if (!list) {
            list = document.createElement('div');
            list.className = 'ac-list hidden';
            wrap.appendChild(list);
        }

        let items = [];
        let idx = -1;

        function resolveRegion() {
            return regionOverride || getCurrentRegion();
        }

        function refreshItemsByRegion() {
            items = getCodeList(resolveRegion());
        }

        function renderList(filter) {
            const q = (filter || '').trim().toUpperCase();
            list.innerHTML = '';
            idx = -1;

            if (!q) {
                list.classList.add('hidden');
                return;
            }

            const starts = items.filter(it => it.code.startsWith(q));
            const contains = items.filter(it => !it.code.startsWith(q) && it.code.includes(q));
            const merged = [...starts, ...contains].slice(0, 12);

            if (merged.length === 0) {
                list.classList.add('hidden');
                return;
            }

            merged.forEach((it) => {
                const row = document.createElement('div');
                row.className = 'ac-item';
                row.dataset.code = it.code;
                row.innerHTML =
                    `<strong>${it.code}</strong><span class="ac-muted">— ${it.name || it.code}</span>`;
                row.addEventListener('mousedown', (e) => {
                    e.preventDefault();
                    pick(it.code);
                });
                list.appendChild(row);
            });

            list.classList.remove('hidden');
        }

        function highlight(delta) {
            const children = Array.from(list.children);
            if (children.length === 0) return;
            idx = (idx + delta + children.length) % children.length;
            children.forEach(c => c.classList.remove('active'));
            children[idx].classList.add('active');
            children[idx].scrollIntoView({
                block: 'nearest'
            });
        }

        function pick(code) {
            input.value = code.toUpperCase();
            list.classList.add('hidden');
            if (selectId) syncInputToSelect(inputId, selectId);
        }

        // Events
        input.addEventListener('input', () => {
            input.value = input.value.toUpperCase();
            renderList(input.value);
        });
        input.addEventListener('keydown', (e) => {
            if (list.classList.contains('hidden')) return;
            if (e.key === 'ArrowDown') {
                e.preventDefault();
                highlight(+1);
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                highlight(-1);
            } else if (e.key === 'Enter') {
                if (idx >= 0) {
                    e.preventDefault();
                    const el = list.children[idx];
                    if (el) pick(el.dataset.code);
                } else {
                    pick(input.value);
                }
            } else if (e.key === 'Escape') {
                list.classList.add('hidden');
            }
        });
        input.addEventListener('blur', () => {
            setTimeout(() => list.classList.add('hidden'), 150);
            if (selectId) syncInputToSelect(inputId, selectId);
        });

        // Init
        refreshItemsByRegion();

        return {
            refresh() {
                refreshItemsByRegion();
                if (document.activeElement === input && input.value) {
                    renderList(input.value);
                } else {
                    list.classList.add('hidden');
                }
            }
        };
    }

    /* =======================
       8) KHỞI TẠO & SỰ KIỆN
       ======================= */
    // Bind 3 cặp
    const handlers = [
        bindInputSelectPair({
            inputId: 'MDDLK_code',
            selectId: 'location-select',
            regionSensitive: true
        }),
        bindInputSelectPair({
            inputId: 'DDNHCC',
            selectId: 'location-select2',
            regionSensitive: false,
            regionOverride: 'trong_nuoc'
        }),
        bindInputSelectPair({
            inputId: 'DDXK',
            selectId: 'location-select3',
            regionSensitive: true
        })
    ].filter(Boolean);

    // Datalist fallback
    populateDatalistFromRegion('codes-by-region', getCurrentRegion());

    // Autocomplete tùy biến (hiện khi gõ)
    const acHandlers = [
        attachAutocomplete({
            inputId: 'MDDLK_code',
            selectId: 'location-select'
        }),
        attachAutocomplete({
            inputId: 'DDNHCC',
            selectId: 'location-select2',
            regionOverride: 'trong_nuoc'
        }),
        attachAutocomplete({
            inputId: 'DDXK',
            selectId: 'location-select3'
        })
    ].filter(Boolean);

    // Đổi radio khu vực → refresh datalist, autocomplete, và các select động
    document.querySelectorAll('input[name="khuvuc"]').forEach(radio => {
        radio.addEventListener('change', () => {
            const region = getCurrentRegion();
            // datalist
            populateDatalistFromRegion('codes-by-region', region);
            // autocomplete dropdown
            acHandlers.forEach(h => h.refresh && h.refresh());
            // select đã bind (bị ảnh hưởng bởi khu vực)
            handlers.forEach(h => h.refreshByRegion && h.refreshByRegion());
        });
    });
    </script>

    <datalist id="codes-by-region"></datalist>
</body>

</html>