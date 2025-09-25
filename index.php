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
                <option>A11: Nhập kinh doanh tiêu dùng</option>
                <option>A12: Nhập kinh doanh sản xuất</option>
                <option>A21: Chuyển tiêu thụ nội địa từ nguồn tạm nhập</option>
                <option>A31: Nhập khẩu hàng hóa đã xuất khẩu</option>
                <option>A41: Nhập kinh doanh của doanh nghiệp thực hiện quyền nhập khẩu</option>
                <option>A42: Thay đổi mục đích sử dụng hoặc chuyển tiêu thụ nội địa từ các loại hình khác, trừ tạm nhập
                </option>
                <option>A43: Nhập khẩu hàng hóa thuộc Chương trình ưu đãi thuế</option>
                <option>A44: Tạm nhập hàng hóa bán tại cửa hàng miễn thuế</option>
                <option>E11: Nhập nguyên liệu của DNCX từ nước ngoài</option>
                <option>E13: Nhập hàng hóa khác vào DNCX</option>
                <option>E15: Nhập nguyên liệu, vật tư của DNCX từ nội địa</option>
                <option>E21: Nhập nguyên liệu, vật tư để gia công cho thương nhân nước ngoài</option>
                <option>E23: Nhập nguyên liệu, vật tư gia công từ hợp đồng khác chuyển sang</option>
                <option>E31: Nhập nguyên liệu sản xuất xuất khẩu</option>
                <option>E33: Nhập nguyên liệu, vật tư vào kho bảo thuế</option>
                <option>E41: Nhập sản phẩm thuê gia công ở nước ngoài</option>
                <option>G11: Tạm nhập hàng kinh doanh tạm nhập tái xuất</option>
                <option>G12: Tạm nhập máy móc, thiết bị phục vụ dự án có thời hạn</option>
                <option>G13: Tạm nhập miễn thuế</option>
                <option>G14: Tạm nhập khác</option>
                <option>G51: Tái nhập hàng hóa đã tạm xuất</option>
                <option>C11: Hàng nước ngoài gửi kho ngoại quan</option>
                <option>C21: Hàng đưa vào khu phi thuế quan</option>
                <option>H11: Hàng nhập khẩu khác</option>
            </select>
        </div>
        <div class="form-group">
            <label>Cơ quan Hải quan:</label>
            <select>
                <option>28NJ - Chi cục HQ Hà Nam</option>
                <option>01NV - Chi cục HQ Nội Bài</option>
            </select>
        </div>
        <div class="form-group">
            <label>Ngày khai báo (dự kiến):</label>
            <input type="date">
        </div>
        <fieldset>
            <legend>Thông tin người xuất khẩu:</legend>
            <div class="form-group">
                <label>Mã số thuế doanh nghiệp:</label>
                <input type="text" placeholder="Mã số thuế doanh nghiệp">
                <label style="width: 97px;">Mã bưu chính:</label>
                <input type=" text" placeholder="Mã bưu chính">
            </div>
            <div class="form-group">
                <label>Tên doanh nghiệp:</label>
                <input type="text" placeholder="Tên doanh nghiệp">
            </div>
            <div class="form-group">
                <label>Địa chỉ doanh nghiệp:</label>
                <input type="text" placeholder="Địa chỉ doanh nghiệp">
            </div>
            <div class="form-group">
                <label>Số điện thoại doanh nghiệp:</label>
                <input type="text" placeholder="Số điện thoại doanh nghiệp">
            </div>
            <legend>Thông tin người ủy thác xuất khẩu:</legend>
            <div class="form-group">
                <label>Tên người ủy thác:</label>
                <input type="text" placeholder="Tên người ủy thác xuất khẩu">
            </div>
            <div class="form-group">
                <label>Số điện thoại người ủy thác:</label>
                <input type="text" placeholder="Số điện thoại người ủy thác">
            </div>
            <div class="form-group">
                <label>Địa chỉ người ủy thác nhập khẩu:</label>
                <input type="text" placeholder="Địa chỉ người ủy thác nhập khẩu">
            </div>
        </fieldset>
        <!-- Thông tin người nhập khẩu -->
        <fieldset>
            <legend>Thông tin người nhập khẩu:</legend>

            <div class="form-group">
                <label>Mã số thuế doanh nghiệp nhập khẩu:</label>
                <input type="text" placeholder="Mã số thuế doanh nghiệp nhập khẩu">
                <label style="width: 171px;">Mã bưu chính nhập khẩu:</label>
                <input type="text" placeholder="Mã bưu chính nhập khẩu">
            </div>
            <div class="form-group">
                <label>Tên doanh nghiệp nhập khẩu:</label>
                <input type="text" placeholder="Tên doanh nghiệp nhập khẩu">
            </div>
            <div class="form-group">
                <label>Địa chỉ doanh nghiệp nhập khẩu:</label>
                <input type="text" placeholder="Địa chỉ doanh nghiệp nhập khẩu">
            </div>
            <div class="form-group">
                <label>Số điện thoại doanh nghiệp nhập khẩu:</label>
                <input type="text" placeholder="Số điện thoại doanh nghiệp nhập khẩu">
            </div>
            <legend>Thông tin người ủy thác nhập khẩu:</legend>
            <div class="form-group">
                <label>Tên người ủy thác nhập khẩu:</label>
                <input type="text" placeholder="Tên người ủy thác nhập khẩu">
            </div>
            <div class="form-group">
                <label>Số điện thoại người ủy thác nhập khẩu:</label>
                <input type="text" placeholder="Số điện thoại người ủy thác nhập khẩu">
            </div>
            <div class="form-group">
                <label>Địa chỉ người ủy thác nhập khẩu:</label>
                <input type="text" placeholder="Địa chỉ người ủy thác nhập khẩu">
            </div>
        </fieldset>

        <!-- Thông tin người ủy thác nhập khẩu -->
        <fieldset>
            <legend>Thông tin vận đơn:</legend>
            <div class="form-group">
                <label>Số vận đơn:</label>
                <input type="text" placeholder="Số vận đơn">
            </div>
            <div class="form-group">
                <label>Số lượng kiện:</label>
                <input type="text" placeholder="Số lượng kiện">
                <select>
                    <option>SET: Bộ</option>
                    <option>DZN: Tá</option>
                    <option>PCE: Cái/Chiếc</option>
                    <option>PR: Đôi/Cặp</option>
                    <option>INC: Inch</option>
                    <option>MTR: Mét</option>
                </select>
            </div>
            <div class="form-group">
                <label>Tổng trọng lượng hàng:</label>
                <input type="text" placeholder="Tổng trọng lượng hàng">
                <select>
                    <option>GRM: Gam</option>
                    <option>KGM: Kilogam</option>
                    <option>TNE: Tấn</option>
                    <option>LBR: Pao</option>
                </select>
            </div>
            <div class="form-group">
                <label>Mã địa điểm lưu kho hàng chờ thông quan dự kiến:</label>
                <input type="text" placeholder="Mã địa điểm lưu kho">
                <select>
                    <option>OSAKA</option>
                    <option>HANOI</option>
                </select>
            </div>
            <div class="form-group">
                <label>Địa điểm nhận hàng cuối cùng:</label>
                <input type="text" placeholder="Địa điểm nhận hàng cuối cùng">
                <select>
                    <option>OSAKA</option>
                    <option>HANOI</option>
                </select>
            </div>
            <div class="form-group">
                <label>Địa điểm xếp hàng:</label>
                <input type="text" placeholder="Địa điểm xếp hàng">
                <select>
                    <option>OSAKA</option>
                    <option>HANOI</option>
                </select>
            </div>
            <div class="form-group">
                <label>Phương tiện vận chuyển:</label>
                <input type="text" placeholder="Nếu là tàu biển ghi 9999">
                <input type="text" placeholder="Phương tiện vận chuyển">
            </div>
            <div class="form-group">
                <label>Ngày hàng đi dự kiến:</label>
                <input type="date">
            </div>
            <div class="form-group">
                <label>Ký hiệu và số hiệu:</label>
                <input type="text" placeholder="Ký hiệu và số hiệu">
            </div>
        </fieldset>
        <fieldset>
            <legend>Thông tin vận đơn:</legend>
            <div class="form-group">
                <label>Phân loại hình thức hóa đơn:</label>
                <select>
                    <option>A: Giá hóa đơn cho hàng hóa phải trả tiền</option>
                    <option>B: Giá hóa đơn cho hàng hóa không phải trả tiền</option>
                    <option>C: Giá hóa đơn cho hàng hóa bao gồm phải trả tiền và không phải trả tiền</option>
                    <option>D: Các trường hợp khác</option>
                </select>
            </div>
            <div class="form-group">
                <label>Số tiếp nhận hóa đơn điện tử:</label>
                <input type="text" placeholder="Số tiếp nhận hóa đơn điện tử">
                <label>Số hóa đơn:</label>
                <input type="text" placeholder="Số hóa đơn">
            </div>
            <div class="form-group">
                <label>Ngày phát hành:</label>
                <input type="date">
                <label>Phương thức thanh toán:</label>
                <select>
                    <option>T/T</option>
                    <option>TTR</option>
                    <option>COD</option>
                    <option>L/C</option>
                </select>
            </div>
            <div class="form-group">
                <label>Mã phân loại hóa đơn: </label>
                <select>
                    <option>A: Hóa đơn thương mại</option>
                    <option>B: Chứng từ thay thế hóa đơn thương mại hoặc không có hóa đơn thương mại:</option>
                    <option>D: Hóa đơn điện tử được khai báo qua nghiệp vụ khai hóa đơn IVA</option>
                </select>
                <label>Điều kiện giá hóa đơn: </label>
                <select>
                    <option>EXW</option>
                    <option>FCA</option>
                    <option>CPT</option>
                    <option>CIP</option>
                    <option>DAP</option>
                    <option>DPU</option>
                    <option>DDP</option>
                    <option>FAS</option>
                    <option>FOB</option>
                    <option>CFR</option>
                    <option>CIF</option>
                </select>
            </div>
            <div class="form-group">
                <label>Tổng trị giá hóa đơn:</label>
                <input type="number" placeholder="Tổng trị giá hóa đơn">
                <label>Mã đồng tiền trị giá hóa đơn :</label>
                <select>
                    <option>USD</option>
                    <option>CNY</option>
                    <option>VND</option>
                    <option>JPY</option>
                    <option>KRW</option>
                </select>
            </div>
            <div class="form-group">
                <label>Trị giá hóa đơn:</label>
                <input type="number" placeholder="Trị giá hóa đơn">
                <label>Mã đồng tiền trị giá tính thuế :</label>
                <select>
                    <option>USD</option>
                    <option>CNY</option>
                    <option>VND</option>
                    <option>JPY</option>
                    <option>KRW</option>
                </select>
            </div>
        </fieldset>
        <fieldset>
            <legend>Thuế và bảo lãnh</legend>
            <div class="form-group">
                <label>Mã lý do đề nghị BP:</label>
                <input type="text" placeholder="Mã lý do đề nghị BP">
                <select>
                    <option>A:chờ xác định mã số hàng hóa</option>
                    <option>B:chờ xác định trị giá tính thuế</option>
                    <option>C:trường hợp khác</option>
                </select>
            </div>
            <div class="form-group">
                <label>Mã ngân hàng trả thuế thay:</label>
                <input type="text" placeholder="Số tài khoản">
                <select>
                    <option>BIDV</option>
                    <option>TECHCOMBANK</option>
                    <option>VPBANK</option>
                </select>
            </div>
            <div class="form-group">
                <label>Năm phát hành hạn mức: </label>
                <input type="text" placeholder="Năm phát hành hạn mức">
                <label style="width: 185px;">Ký hiệu chứng từ hạn mức: </label>
                <input type="text" placeholder="Ký hiệu chứng từ hạn mức">
                <label>Số chứng từ hạn mức: </label>
                <input type="text" placeholder="Số chứng từ hạn mức">
            </div>
            <div class="form-group">
                <label>Mã xác định thời hạn nộp thuế : </label>
                <select>
                    <option>A:Trường hợp được áp dụng thời hạn nộp thuế do sử dụng bảo lãnh riêng.</option>
                    <option>B:Trường hợp được áp dụng thời hạn nộp thuế do sử dụng bảo lãnh chung</option>
                    <option>C:Trường hợp được áp dụng thời hạn nộp thuế mà không sử dụng bảo lãnh</option>
                    <option>D:Trong trường hợp nộp thuế ngay.</option>
                </select>
            </div>
            <div class="form-group">
                <label>Mã ngân hàng bảo lãnh:</label>
                <input type="text" placeholder="Số tài khoản">
                <select>
                    <option>BIDV</option>
                    <option>TECHCOMBANK</option>
                    <option>VPBANK</option>
                </select>
            </div>
            <div class="form-group">
                <label>Năm phát hành bảo lãnh: </label>
                <input type="text" placeholder="Năm phát hành bảo lãnh">
                <label style="width: 183px;">Ký hiệu chứng từ bảo lãnh: </label>
                <input type="text" placeholder="Ký hiệu chứng từ bảo lãnh">
                <label>Số chứng từ bảo lãnh: </label>
                <input type="text" placeholder="Số chứng từ bảo lãnh">
            </div>
        </fieldset>
        <fieldset>
            <legend>Thông tin vận chuyển</legend>
            <div class="form-group">
                <label>Ngày được phép nhập kho: </label>
                <input type="date" placeholder="Ngày được phép nhập kho">
                <label>Ngày khởi hành vận chuyển: </label>
                <input type="date" placeholder="Ngày khởi hành vận chuyển">
            </div>
            <div class="form-group">
                <label>Thông tin trung chuyển:</label>
                <label>Địa điểm:</label>
                <label>Ngày đến:</label>
                <label>Ngày khởi hành:</label>
            </div>
            <div class="form-group">
                <label>(1)</label>
                <input type="text" placeholder="Địa điểm">
                <input type="date" placeholder="Ngày đến">
                <input type="date" placeholder="Ngày khởi hành">
            </div>
            <div class="form-group">
                <label>(2)</label>
                <input type="text" placeholder="Địa điểm">
                <input type="date" placeholder="Ngày đến">
                <input type="date" placeholder="Ngày khởi hành">
            </div>
            <div class="form-group">
                <label>(3)</label>
                <input type="text" placeholder="Địa điểm">
                <input type="date" placeholder="Ngày đến">
                <input type="date" placeholder="Ngày khởi hành">
            </div>
            <div class="form-group">
                <label>Địa điểm đích vận chuyển bảo thuế: </label>
                <select>
                    <option>03S03</option>
                </select>
                <label>Ngày đến: </label>
                <input type="date">
            </div>
        </fieldset>
        <!-- Nút chức năng -->
        <div class="button-group">
            <a href="To2.php" target="_seft">
                <button>Trang sau</button>
            </a>
            <button>Lưu</button>
            <button>Tạo mới</button>
            <button>Tìm tờ khai</button>
            <button class="red">Đóng</button>
        </div>
    </div>
</body>

</html>