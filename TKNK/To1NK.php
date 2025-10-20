<?php 
    require_once(__DIR__."/../core/database.php");
     if (empty($_SESSION['user_id'])) {
     $redirect = '/DangNhap-DangKyTK/DangNhapDangKyTK.php?next=' . urlencode($_SERVER['REQUEST_URI']);
     header("Location: $redirect");
     exit;

     
 }
//  if(!empty($_GET['id'])){
//         $sql = "SELECT * FROM `to1NK` WHERE id = ?";
//         $stmt = $conn->prepare($sql);
//         $stmt->bind_param("s", $_GET['id']);
//         $stmt->execute();
//         $result = $stmt->get_result();
//         $data = $result->fetch_assoc();
//         print_r($data); 
//      }
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
        <form method="POST" action="To2NK.php">
            <fieldset>
                <legend>Thông tin chung</legend>
                <div class="form-group">
                    <label style="width: 240px">Nhóm loại hình:</label>

            </fieldset>

            <div class="form-group">
                <label>Mã loại hình:</label>
                <select name="ma_loai_hinh">
                    <option value="A11">A11: Nhập kinh doanh tiêu dùng</option>
                    <option value="A12">A12: Nhập kinh doanh sản xuất</option>
                </select>
                <label style="width: 240px">Phân loại cá nhân/tổ chức:</label>
                <select name="phan_loai_to_chuc">
                    <option value="P1">1: Cá nhân gửi cá nhân</option>
                    <option value="P2">2: Tổ chức gửi cá nhân</option>
                </select>
            </div>

            <div class="form-group">
                <label>Cơ quan Hải quan:</label>
                <select name="co_quan_hq">
                    <option value="28NJ">28NJ - Chi cục HQ Hà Nam</option>
                    <option value="01VN">01NV - Chi cục HQ Nội Bài</option>
                </select>
                <label style="width: 240px">Mã hiệu phương thức vận chuyển:</label>
                <select name="phuong_thuc_vc">
                    <option value="P1">1: Đường không</option>
                    <option value="P2">2: Đường biển (container)</option>
                </select>
            </div>

            <div class="form-group">
                <label>Mã phân loại hàng hóa:</label>
                <select name="ma_phan_loai_hang">
                    <option value="A">A: Hàng quà biếu, quà tặng</option>
                    <option value="B">B: Hàng an ninh, quốc phòng</option>
                </select>
                <label style="width: 240px">Mã bộ phận xử lí tờ khai:</label>
                <select name="ma_bo_phan_xu_ly">
                    <option value="00">00: Bộ phận hàng hóa nhập khẩu hàng mậu dịch Kho TCS.</option>
                    <option value="01">01: Bộ phận hàng hóa nhập khẩu hàng mậu dịch Kho SCSC.</option>
                </select>
            </div>

            <fieldset>
                <legend>Thông tin người nhập khẩu:</legend>
                <div class="form-group">
                    <label>Mã số thuế doanh nghiệp:</label>
                    <input type="text" name="MSTDNNK" placeholder="Mã số thuế doanh nghiệp nhập khẩu">
                    <label style="width: 97px;">Mã bưu chính:</label>
                    <input type="text" name="MBCNK" placeholder="Mã bưu chính">
                </div>
                <div class="form-group">
                    <label>Tên doanh nghiệp:</label>
                    <input type="text" name="TDNNK" placeholder="Tên doanh nghiệp nhập khẩu">
                </div>
                <div class="form-group">
                    <label>Địa chỉ doanh nghiệp:</label>
                    <input type="text" name="DCDNNK" placeholder="Địa chỉ doanh nghiệp nhập khẩu">
                </div>
                <div class="form-group">
                    <label>Số điện thoại doanh nghiệp:</label>
                    <input type="text" name="SDTDNNK" placeholder="Số điện thoại doanh nghiệp nhập khẩu">
                </div>
                <legend>Thông tin người ủy thác nhập khẩu:</legend>
                <div class="form-group">
                    <label>Tên người ủy thác nhập khẩu:</label>
                    <input type="text" name="NUTNK" placeholder="Tên người ủy thác nhập khẩu">
                </div>
                <div class="form-group">
                    <label>Số điện thoại người ủy thác nhập khẩu:</label>
                    <input type="text" name="SDTUTNK" placeholder="Số điện thoại người ủy thác nhập khẩu">
                </div>
                <div class="form-group">
                    <label>Địa chỉ người ủy thác nhập khẩu:</label>
                    <input type="text" name="DCUTNK" placeholder="Địa chỉ người ủy thác nhập khẩu">
                </div>
            </fieldset>

            <fieldset>
                <legend>Thông tin người xuất khẩu:</legend>
                <div class="form-group">
                    <label>Mã số thuế DN xuất khẩu:</label>
                    <input type="text" name="MSTDNXK" placeholder="Mã số thuế DN xuất khẩu">
                    <label style="width: 171px;">Mã bưu chính xuất khẩu:</label>
                    <input type="text" name="MBCXK" placeholder="Mã bưu chính xuất khẩu">
                </div>
                <div class="form-group">
                    <label>Tên DN xuất khẩu:</label>
                    <input type="text" name="TDNXK" placeholder="Tên DN xuất khẩu">
                </div>
                <div class="form-group">
                    <label>Địa chỉ DN xuất khẩu:</label>
                    <input type="text" name="DCDNXK" placeholder="Địa chỉ DN xuất khẩu">
                </div>
                <div class="form-group">
                    <label>SĐT DN xuất khẩu:</label>
                    <input type="text" name="SDTDNXK" placeholder="SĐT DN xuất khẩu">
                </div>
                <legend>Thông tin người ủy thác xuất khẩu:</legend>
                <div class="form-group">
                    <label>Tên người ủy thác xuất khẩu:</label>
                    <input type="text" name="NUTXK" placeholder="Tên người ủy thác xuất khẩu">
                </div>
                <div class="form-group">
                    <label>SĐT người ủy thác xuất khẩu:</label>
                    <input type="text" name="SDTUTXK" placeholder="SĐT người ủy thác xuất khẩu">
                </div>
                <div class="form-group">
                    <label>Địa chỉ người ủy thác xuất khẩu:</label>
                    <input type="text" name="DCUTXK" placeholder="Địa chỉ người ủy thác xuất khẩu">
                </div>
            </fieldset>

            <fieldset>
                <legend>Thông tin vận đơn:</legend>
                <div class="form-group">
                    <label>Số vận đơn:</label>
                    <input type="text" name="SVD" placeholder="Số vận đơn">
                    <label style="width: 98px">Ngày vận đơn:</label>
                    <input type="date" name="NVD">
                </div>
                <div class="form-group">
                    <label>Số lượng kiện:</label>
                    <input type="text" name="SLK" placeholder="Số lượng kiện">
                    <select name="don_vi_kien">
                        <option value="SET">SET: Bộ</option>
                        <option value="DZN">DZN: Tá</option>
                        <option value="PCE">PCE: Cái/Chiếc</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tổng trọng lượng hàng:</label>
                    <input type="text" name="TTLH" placeholder="Tổng trọng lượng hàng">
                    <select name="don_vi_tl">
                        <option value="GRM">GRM: Gam</option>
                        <option value="KGM">KGM: Kilogam</option>
                        <option value="TNE">TNE: Tấn</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Mã địa điểm lưu kho:</label>
                    <input type="text" name="MDDLK" placeholder="Mã địa điểm lưu kho">
                    <select name="dia_diem_luu_kho">
                        <option value="OSA">OSAKA</option>
                        <option value="HAN">HANOI</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Ký hiệu & số hiệu bao bì:</label>
                    <input type="text" name="KH_SHBB" placeholder="Ký hiệu và số hiệu bao bì">
                </div>
                <div class="form-group">
                    <label>Phương tiện vận chuyển:</label>
                    <input type="text" name="so_hieu_tau" placeholder="Nếu là tàu biển ghi 9999">
                    <input type="text" name="PTVC" placeholder="Phương tiện vận chuyển">
                </div>
                <div class="form-group">
                    <label>Ngày hàng đến:</label>
                    <input type="date" name="NHD">
                </div>
                <div class="form-group">
                    <label>Địa điểm dỡ hàng:</label>
                    <input type="text" name="DDDH" placeholder="Địa điểm dỡ hàng">
                    <select name="ma_dd_dohang">
                        <option value="OSA">OSAKA</option>
                        <option value="HAN">HANOI</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Địa điểm xếp hàng:</label>
                    <input type="text" name="DDXH" placeholder="Địa điểm xếp hàng">
                    <select name="ma_dd_xephang">
                        <option value="OSA">OSAKA</option>
                        <option value="HAN">HANOI</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Số lượng container:</label>
                    <input type="number" name="SLCT">
                </div>
                <div class="form-group">
                    <label>Mã kết quả kiểm tra nội dung:</label>
                    <select name="ma_kq_ktnd">
                        <option value="A1">A: Không có bất thường</option>
                        <option value="B1">B: Có bất thường</option>
                        <option value="C1">C: Cần tham vấn HQ</option>
                    </select>
                </div>
            </fieldset>

            <div class="button-group">
                <button type="submit" name="action" onclick="window.location.href='../TKNK/to2nk.php'">Trang
                    sau</button>
                <button type="submit" name="action">Lưu</button>
                <button type="button" onclick="timToKhai()">Tìm tờ khai</button>
                <button type="button" class="red" onclick="window.location.href='../index.php'">Đóng</button>
            </div>
            <script>
            function timToKhai() {
                alert("Thực hiện tìm tờ khai...");
            }
            </script>
        </form>
</body>

</html>