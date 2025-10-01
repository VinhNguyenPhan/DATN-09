<?php 
    require_once(__DIR__."/../core/database.php");
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Tờ khai nhập khẩu</title>
    <link rel="stylesheet" href="style.css?v1.0.3">
</head>

<body>
    <div class="container">
        <h2>Tờ khai nhập khẩu - Thông tin chung 1</h2>
        <form method="GET" action="To2NK.php">
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
                <select name="ma-loai-hinh">
                    <option value="A11">A11: Nhập kinh doanh tiêu dùng</option>
                    <option value="A12">A12: Nhập kinh doanh sản xuất</option>
                    <option value="A21">A21: Chuyển tiêu thụ nội địa từ nguồn tạm nhập</option>
                    <option value="A31">A31: Nhập khẩu hàng hóa đã xuất khẩu</option>
                    <option value="A41">A41: Nhập kinh doanh của doanh nghiệp thực hiện quyền nhập khẩu</option>
                    <option value="A42">A42: Thay đổi mục đích sử dụng hoặc chuyển tiêu thụ nội địa từ các loại hình
                        khác, trừ tạm
                        nhập
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
                <label style="width: 240px">Phân loại cá nhân/tổ chức:</label>
                <select>
                    <option value="P1">1: Cá nhân gửi cá nhân</option>
                    <option value="P2">2: Tổ chức gửi cá nhân</option>
                    <option value="P3">3: Cá nhân gửi tổ chức</option>
                    <option value="P4">4: Tổ chức gửi tổ chức</option>
                    <option value="P5">5: Khác</option>
                </select>
            </div>
            <div class="form-group">
                <label>Cơ quan Hải quan:</label>
                <select>
                    <option value="28NJ">28NJ - Chi cục HQ Hà Nam</option>
                    <option value="01VN">01NV - Chi cục HQ Nội Bài</option>
                </select>
                <label style="width: 240px">Mã hiệu phương thức vận chuyển:</label>
                <select>
                    <option value="P1">1: Đường không</option>
                    <option value="P2">2: Đường biển (container)</option>
                    <option value="P3">3: Đường biển (hàng rời, lỏng…)</option>
                    <option value="P4">4: Đường bộ (xe tải)</option>
                    <option value="P5">5: Đường sắt</option>
                    <option value="P6">6: Đường sông</option>
                    <option value="P9">9: Khác</option>
                </select>
            </div>

            <div class="form-group">
                <label>Mã phân loại hàng hóa:</label>
                <select>
                    <option value="A">A: Hàng quà biếu, quà tặng</option>
                    <option value="B">B: Hàng an ninh, quốc phòng</option>
                    <option value="C">C: Hàng cứu trợ khẩn cấp</option>
                    <option value="D">D: Hàng phòng chống thiên tai, dịch bệnh.</option>
                    <option value="E">E: Hàng viện trợ nhân đạo</option>
                    <option value="F">F: Hàng bưu chính, chuyển phát nhanh</option>
                    <option value="G">G: Hàng tài sản di chuyển</option>
                    <option value="H">H: Hàng hóa được sử dụng cho PTVT xuất nhập cảnh</option>
                    <option value="I">I: Hàng ngoại giao</option>
                    <option value="J">J: Hàng khác theo quy định của Chính phủ</option>
                    <option value="K">K: Hàng bảo quản đặc biệt</option>
                </select>
                <label style="width: 240px">Mã bộ phận xử lí tờ khai:</label>
                <select>
                    <option value="00">00: Bộ phận hàng hóa nhập khẩu hàng mậu dịch Kho TCS.</option>
                    <option value="01">01: Bộ phận hàng hóa nhập khẩu hàng mậu dịch Kho SCSC.</option>
                    <option value="02">02: Bộ phận hàng hóa nhập khẩu hàng phi mậu dịch, tạm nhập, tái xuất.</option>
                    <option value="03">03: Bộ phận hàng hóa nhập khẩu ngoài giờ.</option>
                    <option value="04">04: Bộ phận hàng hóa xuất khẩu Kho TCS.</option>
                    <option value="05">05: Bộ phận hàng hóa xuất khẩu Kho SCSC.</option>
                </select>
            </div>
            <fieldset>
                <legend>Thông tin người nhập khẩu:</legend>
                <div class="form-group">
                    <label>Mã số thuế doanh nghiệp:</label>
                    <input type="text" id="MSTDNNK" name="MSTDNNK" placeholder="Mã số thuế doanh nghiệp nhập khẩu">
                    <label style="width: 97px;">Mã bưu chính:</label>
                    <input type=" text" id="MBCNK" name="MBCNK" placeholder="Mã bưu chính">
                </div>
                <div class="form-group">
                    <label>Tên doanh nghiệp:</label>
                    <input type="text" id="TDNNK" name="TDNNK" placeholder="Tên doanh nghiệp nhập khẩu">
                </div>
                <div class="form-group">
                    <label>Địa chỉ doanh nghiệp:</label>
                    <input type="text" id="DCDNNK" name="DCDNNK" placeholder="Địa chỉ doanh nghiệp nhập khẩu">
                </div>
                <div class="form-group">
                    <label>Số điện thoại doanh nghiệp:</label>
                    <input type="text" id="SDTDNNK" name="SDTDNNK" placeholder="Số điện thoại doanh nghiệp nhập khẩu">
                </div>
                <legend>Thông tin người ủy thác nhập khẩu:</legend>
                <div class="form-group">
                    <label>Tên người ủy thác nhập khẩu:</label>
                    <input type="text" id="NUTNK" name="NUTNK" placeholder="Tên người ủy thác nhập khẩu">
                </div>
                <div class="form-group">
                    <label>Số điện thoại người ủy thác nhập khẩu:</label>
                    <input type="text" id="SDTUTNK" name="SDTUTNK" placeholder="Số điện thoại người ủy thác nhập khẩu">
                </div>
                <div class="form-group">
                    <label>Địa chỉ người ủy thác nhập khẩu:</label>
                    <input type="text" id="DCUTNK" name="DCUTNK" placeholder="Địa chỉ người ủy thác nhập khẩu">
                </div>
            </fieldset>

            <fieldset>
                <legend>Thông tin người xuất khẩu:</legend>

                <div class="form-group">
                    <label>Mã số thuế doanh nghiệp xuất khẩu:</label>
                    <input type="text" id="MSTDNXK" name="MSTDNXK" placeholder="Mã số thuế doanh nghiệp xuất khẩu">
                    <label style="width: 171px;">Mã bưu chính xuất khẩu:</label>
                    <input type="text" id="MBCXK" name="MBCXK" placeholder="Mã bưu chính xuất khẩu">
                </div>
                <div class="form-group">
                    <label>Tên doanh nghiệp xuất khẩu:</label>
                    <input type="text" id="TDNXK" name="TDNXK" placeholder="Tên doanh nghiệp xuất khẩu">
                </div>
                <div class="form-group">
                    <label>Địa chỉ doanh nghiệp xuất khẩu:</label>
                    <input type="text" id="DCDNXK" name="DCDNXK" placeholder="Địa chỉ doanh nghiệp xuất khẩu">
                </div>
                <div class="form-group">
                    <label>Số điện thoại doanh nghiệp xuất khẩu:</label>
                    <input type="text" id="SDTDNXK" name="SDTDNXK" placeholder="Số điện thoại doanh nghiệp xuất khẩu">
                </div>
                <legend>Thông tin người ủy thác xuất khẩu:</legend>
                <div class="form-group">
                    <label>Tên người ủy thác xuất khẩu:</label>
                    <input type="text" id="NUTXK" name="NUTXK" placeholder="Tên người ủy thác xuất khẩu">
                </div>
                <div class="form-group">
                    <label>Số điện thoại người ủy thác xuất khẩu:</label>
                    <input type="text" id="SDTUTXK" name="SDTUTXK" placeholder="Số điện thoại người ủy thác xuất khẩu">
                </div>
                <div class="form-group">
                    <label>Địa chỉ người ủy thác xuất khẩu:</label>
                    <input type="text" id="DCUTXK" name="DCUTXK" placeholder="Địa chỉ người ủy thác xuất khẩu">
                </div>
            </fieldset>

            <fieldset>
                <legend>Thông tin vận đơn:</legend>
                <div class="form-group">
                    <label>Số vận đơn:</label>
                    <input type="text" id="SVD" name="SVD" placeholder="Số vận đơn">
                    <label style="width: 98px">Ngày vận đơn: </label>
                    <input type="date" id="NVD" name="NVD">
                </div>
                <div class="form-group">
                    <label>Số lượng kiện:</label>
                    <input type="text" id="SLK" name="SLK" placeholder="Số lượng kiện">
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
                    <input type="text" id="TTLH" name="TTLH" placeholder="Tổng trọng lượng hàng">
                    <select>
                        <option value="GRM">GRM: Gam</option>
                        <option value="KGM">KGM: Kilogam</option>
                        <option value="TNE">TNE: Tấn</option>
                        <option value="LBR">LBR: Pao</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Mã địa điểm lưu kho hàng chờ thông quan dự kiến:</label>
                    <input type="text" id="MDDLK" name="MDDLK" placeholder="Mã địa điểm lưu kho">
                    <select>
                        <option value="OSA">OSAKA</option>
                        <option value="HAN">HANOI</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Ký hiệu và số hiệu bao bì:</label>
                    <input type="text" id="KH&SHBB" name="KH&SHBB" placeholder="Ký hiệu và số hiệu bao bì">
                </div>
                <div class="form-group">
                    <label>Phương tiện vận chuyển:</label>
                    <input type="text" id="9999" name="9999" placeholder="Nếu là tàu biển ghi 9999">
                    <input type="text" id="PTVC" name="PTVC" placeholder="Phương tiện vận chuyển">
                </div>
                <div class="form-group">
                    <label>Ngày hàng đến:</label>
                    <input type="date" id="NHD" name="NHD">
                </div>
                <div class="form-group">
                    <label>Địa điểm dỡ hàng:</label>
                    <input type="text" id="DDDH" name="DDDH" placeholder="Địa điểm dỡ hàng">
                    <select>
                        <option value="OSA">OSAKA</option>
                        <option value="HAN">HANOI</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Địa điểm xếp hàng:</label>
                    <input type="text" id="DDXH" name="DDXH" placeholder="Địa điểm xếp hàng">
                    <select>
                        <option value="OSA">OSAKA</option>
                        <option value="HAN">HANOI</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Số lượng container:</label>
                    <input type="number" id="SLCT" name="SLCT">
                </div>
                <div class="form-group">
                    <label>Mã kết quả kiểm tra nội dung:</label>
                    <select>
                        <option value="A1">A: Không có bất thường</option>
                        <option value="B1">B: Có bất thường</option>
                        <option value="C1">C: Cần tham vấn cơ quan hải quan</option>
                    </select>
                </div>
                <div class="button-group">
                    <a href="\TKNK\To2NK.php" target="_seft">
                        <button>Trang sau</button>
                    </a>
                    <button>Tìm tờ khai</button>
                    <button class="red">Đóng</button>
                </div>
        </form>
    </div>
</body>

</html>