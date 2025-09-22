<?php
    include_once(__DIR__.'/../core/functions.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tờ Khai Xuất Khẩu</title>
    <style>
    body {
        background-color: #e0dadaff;
    }

    a {
        text-decoration: none;
        padding: 4px 10px;
    }

    input {
        padding: 4px 10px;
        margin: 5px;
    }

    .title-thongtinchung {
        width: 225px;
    }

    .title-donvixuatnhapkhau {
        margin-top: 12px;
        width: 190px;
    }
    </style>
</head>

<body>
    <div style="display: flex">
        <section style="width: 340px; padding: 3px;">
            <div class="TrangThai" style="border:groove 2px; padding: 9px">
                <div class="NoiDung">
                    Trạng Thái: <b>Đang thêm mới</b>
                </div>
                <div class="PhanLuong">
                    Phân Luồng:
                    <input type="radio" id="PhanLuong1" name="PhanLuong" value="Vang">
                    <label for="PhanLuong1" style="color: #dc962cff">Vàng</label>
                    <input type="radio" id="PhanLuong2" name="PhanLuong" value="Do">
                    <label for="PhanLuong2" style="color: Red">Đỏ</label>
                    <input type="radio" id="PhanLuong3" name="PhanLuong" value="Xanh">
                    <label for="PhanLuong3" style="color: Blue">Xanh</label>
                </div>
            </div>
            <div style="border:solid 1px; margin: 5px 0; padding: 9px;">
                1. Lấy thông tin tờ khai từ Hải quan
            </div>
            <div style="border:solid 1px; margin: 5px 0; padding: 9px;">
                2. Khai trước thông tin tờ khai
            </div>
            <div style="border:solid 1px; margin: 5px 0; padding: 9px;">
                3. Khai chính thức tờ khai
            </div>
            <div style="border:solid 1px; margin: 5px 0; padding: 9px;">
                4. Lấy kết quả phân luồng, thông quan
            </div>
        </section>
        <section style="width: 1200px; padding: 3px 0; margin: 5px; border:solid 1px; border-radius:7px;">
            <nav>
                <a href="#" style="border-right: solid 1px; border-bottom: solid 1px">Thông tin chung</a>
                <a href="#" style="border-right: solid 1px; border-bottom: solid 1px">Thông tin container</a>
                <a href="#" style="border-right: solid 1px; border-bottom: solid 1px">Danh sách hàng</a>
            </nav>
            <div>
                <div style="padding: 5px; background-color: #cdbabaff">
                    <b>Nhóm loại hình:</b>
                    <input type="radio" id="NhomLoaiHinh1" name="NhomLoaiHinh" value="KDDT">
                    <label for="NhomLoaiHinh1">Kinh doanh, đầu tư</label>
                    <input type="radio" id="NhomLoaiHinh2" name="NhomLoaiHinh" value="SXXK">
                    <label for="NhomLoaiHinh2">Sản xuất,xuất khẩu</label>
                    <input type="radio" id="NhomLoaiHinh3" name="NhomLoaiHinh" value="GC">
                    <label for="NhomLoaiHinh3">Gia công</label>
                    <input type="radio" id="NhomLoaiHinh4" name="NhomLoaiHinh" value="CX">
                    <label for="NhomLoaiHinh4">Chế xuất</label>
                </div>
                <div style="padding: 5px; display: flex;">
                    <div class="title-thongtinchung">Mã loại hình</div>
                    <input type="text" name="MaLoaiHinh">
                    <select name="LoaiHinh" id="LoaiHinh" style="margin:5px">
                        <option value="A21">Nhập gia công cho thương nhân nước ngoài</option>
                        <option value="A31">Nhập sản xuất xuất khẩu</option>
                    </select>
                </div>
                <div style="padding: 0 5px; display: flex;">
                    <div class="title-thongtinchung">Cơ quan Hải quan</div>
                    <input type="text" name="MaHaiQuan">
                    <select name="HaiQuan" id="HaiQuan" style="margin: 5px">
                        <option value="G12.34.C7">Chi cục Hải quan khu vực IV</option>
                    </select>
                </div>
                <div style="padding: 5px; display: flex;">
                    <div class="title-thongtinchung">Mã hiệu phương thức vận chuyển</div>
                    <select name="phuongthuc" id="VanChuyen" style="padding: 5px; margin-left:5px;">
                        <option>Đường Hàng Không</option>
                        <option>Đường Bộ</option>
                        <option>Đường Sắt</option>
                        <option>Đường Biển</option>
                    </select>
                </div>
            </div>
            <div>
                <b>Đơn vị xuất nhập khẩu</b>
            </div>
            <span style="padding: 0 20px;">Người nhập khẩu</span>
            <div style="display:flex; padding: 0 80px;">
                <div class="title-donvixuatnhapkhau">Mã số thuế:</div>
                <input type="number" id="Ma" name="Ma" placeholder="Mã số thuế" style="width:100%"><!-- an -->
            </div>
            <div style="padding: 0 80px; display:flex;">
                <div class="title-donvixuatnhapkhau">Tên doanh nghiệp:</div>
                <input type="text" id="TenCongTy" name="Ten" placeholder="Tên Doanh Nghiệp" style="width:100%">
            </div>
            <div style="padding: 0 80px; display:flex;">
                <div class="title-donvixuatnhapkhau">Mã bưu chính:</div>
                <input type="text" id="MaBuuChinh" name="BuuChinh" placeholder="Mã Bưu Chính" style="width:100%">
            </div>
            <div style="padding: 0 80px; display:flex; align-item: center">
                <div class="title-donvixuatnhapkhau">Địa Chỉ:</div>
                <input type="string" id="DiaChi" name="DC" placeholder="Địa chỉ công ty" style="width:100%">
            </div>
            <div style="padding: 0 80px; display:flex;">
                <!-- label -->
                <label class="title-donvixuatnhapkhau" for="DienThoai">Điện thoại:</label>
                <input type="text" id="DienThoai" name="DT" placeholder="SĐT" style="width:100%">
                <!-- label -->
            </div>
            <span style="padding: 0 20px;">Người xuất khẩu</span>
            <div style="display:flex; padding: 0 80px;">
                <label class="title-donvixuatnhapkhau" for="Ma">Mã số thuế:</label>
                <input type="number" id="Ma" name="Ma" placeholder="Mã số thuế người xuất khẩu" style="width:100%">
            </div>
            <div style="padding: 0 80px; display:flex;">
                <div class="title-donvixuatnhapkhau">Tên doanh nghiệp:</div>
                <input type="text" id="TenCongTy" name="Ten" placeholder="Tên công ty xuất khẩu" style="width:100%">
                <label for="TenCongTy"></label>
            </div>
            <div style="padding: 0 80px; display:flex">
                <div class="title-donvixuatnhapkhau">Mã bưu chính:</div>
                <input type="text" id="MaBuuChinh" name="BuuChinh" placeholder="Mã bưu chính" style="width:100%">
                <label for=" MaBuuChinh"></label>
            </div>
            <div style="padding: 0 80px; display:flex; align-item: center">
                <label class="title-donvixuatnhapkhau">Địa Chỉ:</label>
                <input type="string" id="DiaChi2" name="DC2" placeholder="Địa chỉ công ty xuất khẩu" style="width:100%">
            </div>
            <div style="padding: 0 80px; display:flex">
                <!-- label -->
                <label class="title-donvixuatnhapkhau" for="DienThoai2">Điện thoại:</label>
                <input type="text" id="DienThoai2" name="DT2" placeholder="SĐT" style="width:100%">
                <!-- label -->
            </div>
            <div>
                <b>Vận Đơn</b>
            </div>
            <div style="padding: 0 80px; display:flex">
                <label class="title-donvixuatnhapkhau" for="MaVanDon">Số Vận Đơn:</label>
                <input type="text" id="MaVanDon" name="MVD" placeholder="Số vận đơn" style="width:100%">
            </div>
            <div style="padding: 0 80px; display:flex">
                <label class="title-donvixuatnhapkhau" for="SoLuongKien">Số lượng kiện hàng:</label>
                <input type="number" id="SoLuongKien" name="SLK" placeholder="Số lượng kiện" style="width:100%">
                <select name="DonviDo2" id="DVD2">
                    <option>Bó</option>
                    <option>Pallet</option>
                    <option>Thùng</option>
                    <option>Pack</option>
                    <option>Bó</option>
                    <option>Bó</option>
                    <option>Bó</option>
                </select>
                <label class="title-donvixuatnhapkhau" for="TrongLuongKien">Trọng lượng kiện hàng</label>
                <input type="number" id="TrongLuongKien" name="TLK" placeholder="Trọng lượng kiện" style="width:100%">
                <select name="DonViDo" id="DVD">
                    <option>KG</option>
                    <option>TẤN</option>
                    <option>Pound</option>
                    <option>Tạ</option>
                </select>
            </div>
            <div style="padding: 0 80px; display:flex">
                <label class="title-donvixuatnhapkhau" for="DD">Mã địa điểm thông quan dự kiến:</label>
                <input type="text" id="DD" name="MDD" placeholder="Mã địa điểm thông quan dự kiến" style="width:100%">
                <label class="title-donvixuatnhapkhau" for="MDD"></label>
                <input type="text" id="MDD" name="MDD2" placeholder="Tên địa điểm thông quan dự kiến"
                    style="width:100%">
            </div>
            <div style="padding: 0 80px; display:flex">
                <label class="title-donvixuatnhapkhau" for="DD3">Mã địa điểm nhận hàng cuối cùng:</label>
                <input type="text" id="DD3" name="MDDCC" placeholder="Mã địa điểm nhận hàng cuối cùng"
                    style="width:100%">
                <label class="title-donvixuatnhapkhau" for="MDDCC"></label>
                <input type="text" id="MDDCC" name="MDDCC" placeholder="Tên địa điểm nhận hàng cuối cùng"
                    style="width:100%">
            </div>
            <div style="padding: 0 80px; display:flex">
                <label class="title-donvixuatnhapkhau" for="MDDXH">Địa điểm xếp hàng:</label>
                <input type="text" id="MDDXH" name="MDDXH" placeholder="Mã địa điểm xếp hàng" style="width:100%">
                <label class="title-donvixuatnhapkhau" for="DDXH"></label>
                <input type="text" id="DDXH" name="DDXH" placeholder="Tên địa điểm xếp hàng" style="width:100%">
            </div>
            <div style="padding: 0 80px; display:flex">
                <label class="title-donvixuatnhapkhau" for="PTVC">Mã phương tiện vận chuyển:</label>
                <input type="text" id="PTVC" name="PTVC2" placeholder="Nếu là tàu biển nhập 9999" style="width:100%">
                <label class="title-donvixuatnhapkhau" for="MPTVC"></label>
                <input type="text" id="MPTVC" name="MPTVC2" placeholder="Mã số phương tiện vận chuyển"
                    style="width:100%">
            </div>
            <div style="padding: 0 80px; display:flex">
                <label class="title-donvixuatnhapkhau" for="NHDDK">Ngày hàng đi dự kiến:</label>
                <input type="date" id="NHDDK" name="NHDDK1" style="width:100%">
            </div>
            <div style="padding: 0 80px; display:flex">
                <label class="title-donvixuatnhapkhau" for="KH">Ký hiệu và số hiệu(nếu có):</label>
                <input type="text" id="KH" name="KH1" style="width:100%">
            </div>
            <div>
                <span><b>Thông tin hóa đơn</b></span>
            </div>
            <div style="padding: 0 80px; display:flex">
                <label class="title-donvixuatnhapkhau" for="HTHD1">Mã hình thức hóa đơn:</label>
                <select name="HTHD" id="HTHD2" ; style="width:50%">
                    <option>A: Giá hóa đơn cho hàng hóa phải trả tiền</option>
                    <option>B: Giá hóa đơn cho hàng hóa không phải trả tiền</option>
                    <option>C: Giá hóa đơn cho hàng hóa bao gồm phải trả tiền và không phải trả tiền</option>
                    <option>D: Các trường hợp khác</option>
                </select>
            </div>
            <div style="padding: 0 80px; display:flex">
                <label class="title-donvixuatnhapkhau" for="HDDT">Số tiếp nhận hóa đơn điện tử:</label>
                <input type="text" id="HDDT" name="HDDT2" placeholder="Số tiếp nhận hóa đơn điện tử" style="width:100%">
                <label class="title-donvixuatnhapkhau" for="SHD">Số hóa đơn</label>
                <input type="text" id="SHD" name="SHD2" placeholder="Số hóa đơn" style="width:100%">
            </div>
            <div style="padding: 0 80px; display:flex">
                <label class="title-donvixuatnhapkhau" for="NPH">Ngày phát hành:</label>
                <input type="date" id="NPH" name="NPH1" style="width:100%">
                <label class="title-donvixuatnhapkhau" for="PTTT">Phương thức thanh toán:</label>
                <select name="HTHD" id="HTHD2" ; style="width:50%">
                    <option>T/T</option>
                    <option>TTR</option>
                    <option>COD</option>
                    <option>L/C</option>
                </select>
            </div>
            <div style="padding: 0 80px; display:flex">
                <label class="title-donvixuatnhapkhau" for="MHD">Mã hóa đơn:</label>
                <select name="MHD" id="MHD1">
                    <option>A: Hóa đơn thương mại</option>
                    <option>B: Chứng từ thay thế hóa đơn thương mại hoặc không có hóa đơn thương mại:</option>
                    <option>D: Hóa đơn điện tử được khai báo qua nghiệp vụ khai hóa đơn IVA</option>
                </select>
                <label class="title-donvixuatnhapkhau" for="DKGHD">Điều kiện giá hóa đơn:</label>
                <select name="DKGHD" id="DKGHD1">
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
        </section>
    </div>