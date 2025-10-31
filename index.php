<?php include_once(__DIR__ . '/public/header.php'); ?>
<script>
    const chatux = new ChatUx();

    const opt = {
        api: {
            endpoint: 'http://localhost/chat/chat-server.php',
            method: 'GET',
            dataType: 'jsonp',
            escapeUserInput: true
        },
        window: {
            title: 'My chat',
            size: {
                width: 350,
                height: 500,
                minWidth: 300,
                minHeight: 300,
                titleHeight: 50
            },
            appearance: {
                border: {
                    shadow: '2px 2px 10px  rgba(0, 0, 0, 0.5)',
                    width: 0,
                    radius: 6
                },
                titleBar: {
                    fontSize: 14,
                    color: 'white',
                    background: '#4784d4',
                    leftMargin: 40,
                    height: 40,
                    buttonWidth: 36,
                    buttonHeight: 16,
                    buttonColor: 'white',
                    buttons: [{
                        fa: 'fas fa-times',
                        name: 'hideButton',
                        visible: true
                    }],
                    buttonsOnLeft: [{
                        fa: 'fas fa-comment-alt',
                        name: 'info',
                        visible: true
                    }],
                },
            }
        },
    };

    chatux.init(opt);
    chatux.start(true);
</script>
<style>
    main {
        display: block;
    }
</style>
<section class="feature-section">
    <div class="feature-text">
        <h2>Hệ thống kho vận hiện đại</h2>
        <p>Chúng tôi sở hữu chuỗi kho bãi đạt tiêu chuẩn quốc tế với tổng diện tích hơn 100.000m², trang bị hệ
            thống quản lý hàng hóa bằng công nghệ tiên tiến.</p>
        <a href="../ListDichVu/KhoVanPhanPhoiHangHoa.php">XEM THÊM</a>
    </div>
    <div class="feature-img">
        <img src="https://3w-logistics.com/wp-content/uploads/2022/06/cac-loai-kho-bai-trong-logistics-1.png"
            alt="Kho vận hiện đại">
    </div>
</section>

<section class="feature-section">
    <div class="feature-text">
        <h2>Mạng lưới phân phối toàn quốc</h2>
        <p>U&I Logistics cung cấp dịch vụ vận chuyển hàng hóa đa phương thức, kết nối 63 tỉnh thành và các cảng
            lớn trong cả nước.</p>
        <a href="../ListDichVu/VanTaiNoiDia.php">XEM THÊM</a>
    </div>
    <div class="feature-img">
        <img src="https://channel.mediacdn.vn/2019/5/4/photo-2-1556962025890735174566.jpg" alt="Mạng lưới phân phối">
    </div>
</section>

<section class="feature-section">
    <div class="feature-text">
        <h2>Đội xe vận tải chuyên nghiệp</h2>
        <p>Sở hữu đội xe container và đầu kéo hiện đại, bảo dưỡng định kỳ cùng đội ngũ tài xế nhiều năm kinh
            nghiệm.</p>
        <a href="../ListDichVu/VanTaiNoiDia.php">XEM THÊM</a>
    </div>
    <div class="feature-img">
        <img src="https://www.unilogistics.vn/upload/images/dich-vu/Van_tai_noi_dia_1.jpg" alt="Đội xe vận tải">
    </div>
</section>

<section class="feature-section">
    <div class="feature-text">
        <h2>Dịch vụ khai báo hải quan chuyên nghiệp</h2>
        <p>Đội ngũ nhân viên có chứng chỉ nghiệp vụ hải quan, hỗ trợ doanh nghiệp thực hiện tờ khai xuất nhập
            khẩu nhanh chóng và đúng quy định.</p>
        <a href="../ListDichVu/DaiLyThuTucHaiQuan.php">XEM THÊM</a>
    </div>
    <div class="feature-img">
        <img src="https://dhdlogistics.com/wp-content/uploads/2023/08/dich-vu-khai-hai-quan-nhanh.jpg"
            alt="Khai báo hải quan">
    </div>
</section>

<section class="feature-section">
    <div class="feature-text">
        <h2>Giải pháp logistics tích hợp</h2>
        <p>Chúng tôi cung cấp dịch vụ logistics trọn gói từ kho bãi, vận chuyển, hải quan đến giao hàng tận nơi
            – mang đến hiệu quả tối đa cho doanh nghiệp.</p>
        <a href="../GioiThieu/CongTyThanhVien.php">XEM THÊM</a>
    </div>
    <div class="feature-img">
        <img src="https://www.unilogistics.vn/upload/images/dich-vu/Van_tai_duong_bien_1.jpg" alt="Giải pháp logistics">
    </div>
</section>
</main>

<footer class="footer">
    <div class="footer-grid">
        <div>
            <h5>CÔNG TY CỔ PHẦN LOGISTICS U&I - MIỀN BẮC</h5>
            <div class="muted-light">
                Mã số thuế: 0108156122-002<br>
                Địa chỉ: Tầng 6, Tòa nhà Transerco, số 311-313 Trường Chinh, Phường Phương Liệt, TP. Hà Nội, Việt
                Nam
            </div>
        </div>
        <div>
            <h5>LIÊN HỆ</h5>
            <div class="muted-light">
                Hotline: +84 24 7300 0548<br>
                Email: info@unilogistics.vn
            </div>
        </div>
        <div>
            <h5>ĐIỀU KHOẢN - CHÍNH SÁCH</h5>
            <div class="muted-light">
                <a href="../DK-CS/DieuKhoan.php">Chính sách · Điều khoản</a>
            </div>
        </div>
    </div>
</footer>

</body>

</html>