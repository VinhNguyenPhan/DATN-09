<?php 
    require_once(__DIR__."/../core/database.php")
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

        <!-- Nhóm loại hình -->
        <fieldset>
            <legend>Nhóm loại hình:</legend>
            <div class="radio-group">
                <label><input type="radio" name="nhom_loai_hinh" checked> Kinh doanh, đầu tư</label>
                <label><input type="radio" name="nhom_loai_hinh"> Sản xuất xuất khẩu</label>
                <label><input type="radio" name="nhom_loai_hinh"> Gia công</label>
                <label><input type="radio" name="nhom_loai_hinh"> Chế xuất</label>
            </div>
        </fieldset>

        <!-- Thông tin khai báo -->
        <div class="form-group">
            <label>Mã loại hình:</label>
            <select>
                <option value="A11">A11: Nhập kinh doanh tiêu dùng</option>
                <option value="A12">A12: Nhập kinh doanh sản xuất</option>
                <option value="A21">A21: Chuyển tiêu thụ nội địa từ nguồn tạm nhập</option>
                <option value="A31">A31: Nhập khẩu hàng hóa đã xuất khẩu</option>
                <option value="A41">A41: Nhập kinh doanh của doanh nghiệp thực hiện quyền nhập khẩu</option>
                <option value="A42">A42: Thay đổi mục đích sử dụng hoặc chuyển tiêu thụ nội địa từ các loại hình khác,
                    trừ tạm nhập
                </option>
                <option value="A43">A43: Nhập khẩu hàng hóa thuộc Chương trình ưu đãi thuế</option>
                <option value="A44">A44: Tạm nhập hàng hóa bán tại cửa hàng miễn thuế</option>
                <option value="E11">E11: Nhập nguyên liệu của DNCX từ nước ngoài</option>
                <option value="E13">E13: Nhập hàng hóa khác vào DNCX</option>
                <option value="E15">E15: Nhập nguyên liệu, vật tư của DNCX từ nội địa</option>
                <option value="E21">E21: Nhập nguyên liệu, vật tư để gia công cho thương nhân nước ngoài</option>
                <option value="E23">E23: Nhập nguyên liệu, vật tư gia công từ hợp đồng khác chuyển sang</option>
                <option value="E31">E31: Nhập nguyên liệu sản xuất xuất khẩu</option>
                <option value="E33">E33: Nhập nguyên liệu, vật tư vào kho bảo thuế</option>
                <option value="E41">E41: Nhập sản phẩm thuê gia công ở nước ngoài</option>
                <option value="G11">G11: Tạm nhập hàng kinh doanh tạm nhập tái xuất</option>
                <option value="G12">G12: Tạm nhập máy móc, thiết bị phục vụ dự án có thời hạn</option>
                <option value="G13">G13: Tạm nhập miễn thuế</option>
                <option value="G14">G14: Tạm nhập khác</option>
                <option value="G51">G51: Tái nhập hàng hóa đã tạm xuất</option>
                <option value="C11">C11: Hàng nước ngoài gửi kho ngoại quan</option>
                <option value="C21">C21: Hàng đưa vào khu phi thuế quan</option>
                <option value="H11">H11: Hàng nhập khẩu khác</option>
            </select>
            </select>
            <label style="width: 240px">Phân loại cá nhân/tổ chức:</label>
            <select>
                <option value="PLCNTC1">1: Cá nhân gửi cá nhân</option>
                <option value="PLCNTC2">2: Tổ chức gửi cá nhân</option>
                <option value="PLCNTC3">3: Cá nhân gửi tổ chức</option>
                <option value="PLCNTC4">4: Tổ chức gửi tổ chức</option>
                <option value="PLCNTC5">5: Khác</option>
            </select>
        </div>
        <div class="form-group">
            <label>Cơ quan Hải quan:</label>
            <select>
                <option value="28NJ">28NJ - Chi cục HQ Hà Nam</option>
                <option value="01NV">01NV - Chi cục HQ Nội Bài</option>
            </select>
            <label style="width: 240px">Mã hiệu phương thức vận chuyển:</label>
            <select>
                <option value="MHPTVC1">1: Đường không</option>
                <option value="MHPTVC2">2: Đường biển (container)</option>
                <option value="MHPTVC3">3: Đường biển (hàng rời, lỏng…)</option>
                <option value="MHPTVC4">4: Đường bộ (xe tải)</option>
                <option value="MHPTVC5">5: Đường sắt</option>
                <option value="MHPTVC6">6: Đường sông</option>
                <option value="MHPTVC9">9: Khác</option>
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
                <input type="text" name="SDTNUTXK" id="SDTNUTXK" placeholder="Số điện thoại người ủy thác xuất khẩu">
            </div>
            <div class="form-group">
                <label>Địa chỉ người ủy thác nhập khẩu:</label>
                <input type="text" name="DCNUTXK" id="DCNUTXK" placeholder="Địa chỉ người ủy thác xuất khẩu">
            </div>
        </fieldset>
        <!-- Thông tin người nhập khẩu -->
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
                <input type="text" name="SDTNUTNK" id="SDTNUTNK" placeholder="Số điện thoại người ủy thác nhập khẩu">
            </div>
            <div class="form-group">
                <label>Địa chỉ người ủy thác nhập khẩu:</label>
                <input type="text" name="DCNUTNK" id="DCNUTNK" placeholder="Địa chỉ người ủy thác nhập khẩu">
            </div>
        </fieldset>

        <!-- Thông tin người ủy thác nhập khẩu -->
        <fieldset>
            <legend>Thông tin vận đơn:</legend>
            <div class="form-group">
                <label>Số vận đơn:</label>
                <input type="text" name="SVD" id="SVD" placeholder="Số vận đơn">
            </div>
            <div class="form-group">
                <label>Số lượng kiện:</label>
                <input type="text" name="SLK" id="SLK" placeholder="Số lượng kiện">
                <select>
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
                <input type="text" placeholder="Tổng trọng lượng hàng">
                <select>
                    <option value="GRM">GRM: Gam</option>
                    <option value="KGM">KGM: Kilogam</option>
                    <option value="TNE">TNE: Tấn</option>
                    <option value="LBR">LBR: Pao</option>
                </select>
            </div>
            <div class="form-group">
                <label>Mã địa điểm lưu kho hàng chờ thông quan dự kiến:</label>
                <input type="text" placeholder="Mã địa điểm lưu kho">
                <select>
                    <option value="OSA">OSAKA</option>
                    <option value="HAN">HANOI</option>
                </select>
            </div>
            <div class="form-group">
                <label>Địa điểm nhận hàng cuối cùng:</label>
                <input type="text" name="DDNHCC" id="DDNHCC" placeholder="Địa điểm nhận hàng cuối cùng">
                <select>
                    <option value="OSA">OSAKA</option>
                    <option value="HAN">HANOI</option>
                </select>
            </div>
            <div class="form-group">
                <label>Địa điểm xếp hàng:</label>
                <input type="text" name="DDXH" id="DDXK" placeholder="Địa điểm xếp hàng">
                <select>
                    <option value="OSA">OSAKA</option>
                    <option value="HAN">HANOI</option>
                </select>
            </div>
            <div class="form-group">
                <label>Phương tiện vận chuyển:</label>
                <input type="text" id="9999" name="9999" placeholder="Nếu là tàu biển ghi 9999">
                <input type="text" id="PTVC" name="PTVC" placeholder="Phương tiện vận chuyển">
            </div>
            <div class="form-group">
                <label>Ngày hàng đi dự kiến:</label>
                <input type="date" name="NHDDK" id="NHDDK">
            </div>
            <div class="form-group">
                <label>Ký hiệu và số hiệu:</label>
                <input type="text" name="KH&SH" id="KH&SH" placeholder="Ký hiệu và số hiệu">
            </div>
        </fieldset>
        <fieldset>
            <legend>Thông tin vận đơn:</legend>
            <div class="form-group">
                <label>Phân loại hình thức hóa đơn:</label>
                <select>
                    <option value="PLHTHDA">A: Giá hóa đơn cho hàng hóa phải trả tiền</option>
                    <option value="PLHTHDB">B: Giá hóa đơn cho hàng hóa không phải trả tiền</option>
                    <option value="PLHTHDC">C: Giá hóa đơn cho hàng hóa bao gồm phải trả tiền và không phải trả tiền
                    </option>
                    <option value="PLHTHDD">D: Các trường hợp khác</option>
                </select>
            </div>
            <div class="form-group">
                <label>Số tiếp nhận hóa đơn điện tử:</label>
                <input type="text" name="STKHDDT" id="STNHDDT" placeholder="Số tiếp nhận hóa đơn điện tử">
                <label style="padding-left: 19px">Số hóa đơn:</label>
                <input type="text" name="SHD" id="SHD" placeholder="Số hóa đơn">
            </div>
            <div class="form-group">
                <label>Ngày phát hành:</label>
                <input type="date" name="NPH" id="NPH">
                <label style="padding-left: 19px">Phương thức thanh toán:</label>
                <select>
                    <option value="TT">T/T</option>
                    <option value="TTR">TTR</option>
                    <option value="COD">COD</option>
                    <option value="LC">L/C</option>
                </select>
            </div>
            <div class="form-group">
                <label>Mã phân loại hóa đơn: </label>
                <select>
                    <option value="MPLHDA">A: Hóa đơn thương mại</option>
                    <option value="MPLHDB">B: Chứng từ thay thế hóa đơn thương mại hoặc không có hóa đơn thương mại:
                    </option>
                    <option value="MPLHDD">D: Hóa đơn điện tử được khai báo qua nghiệp vụ khai hóa đơn IVA</option>
                </select>
                <label style="padding-left: 19px">Điều kiện giá hóa đơn: </label>
                <select>
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
                <label style="padding-left: 19px">Mã đồng tiền trị giá hóa đơn :</label>
                <select>
                    <option value="USD">USD</option>
                    <option value="CNY">CNY</option>
                    <option value="VND">VND</option>
                    <option value="JPY">JPY</option>
                    <option value="KRW">KRW</option>
                </select>
            </div>
            <div class="form-group">
                <label>Trị giá hóa đơn:</label>
                <input type="number" name="TGHD" id="TGHD" placeholder="Trị giá hóa đơn">
                <label style="padding-left: 19px">Mã đồng tiền trị giá tính thuế :</label>
                <select>
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
                <input type="text" placeholder="Mã lý do đề nghị BP">
                <select>
                    <option value="MLDDNBPA">A:chờ xác định mã số hàng hóa</option>
                    <option value="MLDDNBPB">B:chờ xác định trị giá tính thuế</option>
                    <option value="MLDDNBPC">C:trường hợp khác</option>
                </select>
            </div>
            <div class="form-group">
                <label>Mã ngân hàng trả thuế thay:</label>
                <input type="text" placeholder="Số tài khoản">
                <select>
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
                <select>
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
                <input type="text" placeholder="Số tài khoản">
                <select>
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
                <select>
                    <option value="DDDVCBT">03S03</option>
                </select>
                <label style="width: 218px;padding-left: 146px;">Ngày đến: </label>
                <input type="date">
            </div>
        </fieldset>
        <!-- Nút chức năng -->
        <div class="button-group">
            <a href="\TKXK\To2XK.php" target="_seft">
                <button>Trang sau</button>
            </a>
            <button>Lưu</button>
            <button>Tìm tờ khai</button>
            <button class="red">Đóng</button>
        </div>
    </div>
</body>

</html>