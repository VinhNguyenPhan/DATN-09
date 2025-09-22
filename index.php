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
                <input type="number" id="Ma" name="Ma" style="width:100%">
                <!-- ẩn -->
                <label for=" Ma"></label>
            </div>
            <div style="padding: 0 80px; display:flex;">
                <label class="title-donvixuatnhapkhau" for="TenCongTy">Tên doanh nghiệp:</label>
                <input type="text" id="TenCongTy" name="Ten" style="width:100%">
            </div>
            <div style="padding: 0 80px; display:flex;">
                <div class="title-donvixuatnhapkhau">Mã bưu chính:</div>
                <input type="text" id="MaBuuChinh" name="BuuChinh" style="width:100%">
                <label for=" MaBuuChinh"></label>
            </div>
            <div style="padding: 0 80px; display:flex; align-item: center">
                <div class="title-donvixuatnhapkhau">Địa Chỉ:</div>
                <input type="string" id="DiaChi" name="DC" style="width:100%">
                <label for=" DiaChi"></label>
            </div>
            <div style="padding: 0 80px; display:flex;">
                <!-- label -->
                <label class="title-donvixuatnhapkhau" for="DienThoai">Điện thoại:</label>
                <input type="text" id="DienThoai" name="DT" style="width:100%">
                <!-- label -->
            </div>
            <span style="padding: 0 20px;">Người xuất khẩu</span>
            <div style="display:flex; padding: 0 80px;">
                <div class="title-donvixuatnhapkhau">Mã số thuế:</div>
                <input type="number" id="Ma" name="Ma" style="width:100%">
                <label for=" Ma"></label>
            </div>
            <div style="padding: 0 80px; display:flex;">
                <div class="title-donvixuatnhapkhau">Tên doanh nghiệp:</div>
                <input type="text" id="TenCongTy" name="Ten" style="width:100%">
                <label for="TenCongTy"></label>
            </div>
            <div style="padding: 0 80px; display:flex">
                <div class="title-donvixuatnhapkhau">Mã bưu chính:</div>
                <input type="text" id="MaBuuChinh" name="BuuChinh" style="width:100%">
                <label for=" MaBuuChinh"></label>
            </div>
            <div style="padding: 0 80px; display:flex; align-item: center">
                <div class="title-donvixuatnhapkhau">Địa Chỉ:</div>
                <input type="string" id="DiaChi" name="DC" style="width:100%">
                <label for=" DiaChi"></label>
            </div>
            <div style="padding: 0 80px; display:flex">
                <!-- label -->
                <label class="title-donvixuatnhapkhau" for="DienThoai">Điện thoại:</label>
                <input type="text" id="DienThoai" name="DT" style="width:100%">
                <!-- label -->
            </div>
            <div>
                <b>Vận Đơn</b>
            </div>
            <div style="padding: 0 80px; display:flex">
                <label class="title-donvixuatnhapkhau" for="MaVanDon">Mã Vận Đơn:</label>
                <input type="text" id="MaVanDon" name="MVD" style="width:100%">
            </div>
            <div>

            </div>
        </section>
    </div>