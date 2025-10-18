<?php session_start(); ?>
<?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true): ?>
<!-- Hiện menu chức năng như bình thường -->
<li class="dropdown"> ... Chức năng/Khai báo ...</li>
<?php else: ?>
<!-- Hoặc hiện link dẫn tới đăng nhập (khi click vào vẫn chuyển về login) -->
<li class="dropdown">
    <a href="/DangNhap-DangKyTK/DangNhapDangKyTK.php">Chức năng/Khai báo</a>
</li>
<?php endif; ?>

<!-- Và đổi nút Đăng nhập/Đăng xuất -->
<?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']===true): ?>
<a class="cta-login" href="/logout.php">Đăng xuất (
    <?=htmlspecialchars($_SESSION['username'])?>)
</a>
<?php else: ?>
<a class="cta-login" href="/DangNhap-DangKyTK/DangNhapDangKyTK.php">Đăng nhập</a>
<?php endif; ?>


<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Trang chủ — Logistics & Khai báo Hải quan (Mockup)</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
    :root {
        --blue: #1f6fb2;
        --blue-600: #2b86d6;
        --muted: #6b7280;
        --card: #ffffff;
        --surface: #f7fafc;
        --shadow: 0 6px 20px rgba(22, 61, 106, 0.08);
        --radius: 14px;
        --text: #0f172a;
        --accent: #1f3c88;
    }

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: "Inter", sans-serif;
        background: linear-gradient(180deg, #ffffff 0%, #f6f9fc 100%);
        color: var(--text);
    }

    /* Header */
    .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 18px 36px;
        background: #fff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .brand {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .logo {
        width: 46px;
        height: 46px;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--blue), var(--blue-600));
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 700;
        transition: transform 0.2s ease;
    }

    .logo:hover {
        transform: scale(1.05);
    }

    .brand .title {
        font-weight: 800;
        color: var(--accent);
    }

    .brand .sub {
        font-size: 12px;
        color: var(--muted);
    }

    /* Navbar */
    .navbar {
        display: flex;
        align-items: center;
        gap: 28px;
    }

    nav .menu {
        list-style: none;
        display: flex;
        gap: 24px;
        margin: 0;
        padding: 0;
    }

    nav .menu a {
        text-decoration: none;
        color: var(--accent);
        font-weight: 500;
    }

    nav .menu a:hover {
        color: #e91e63;
    }

    .dropdown {
        position: relative;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background: #fff;
        min-width: 230px;
        box-shadow: var(--shadow);
        border-radius: var(--radius);
        padding: 10px 0;
        z-index: 200;
        list-style: none;
    }

    .dropdown-menu li {
        padding: 8px 16px;
    }

    .dropdown-menu li a {
        color: var(--accent);
        text-decoration: none;
        display: block;
        font-size: 15px;
        transition: background 0.2s;
    }

    .dropdown-menu li a:hover {
        background: #f0f5ff;
        color: #e91e63;
    }

    /* Kích hoạt menu khi hover */
    .dropdown:hover>.dropdown-menu {
        display: block;
    }

    /* Đảm bảo menu cha không bị lệch khi hover */
    .dropdown>a {
        position: relative;
        z-index: 201;
    }

    /* Search in header */
    .header-search {
        display: flex;
        align-items: center;
        background: #f3f6fb;
        border-radius: 20px;
        padding: 4px 8px;
        box-shadow: inset 0 0 0 2px #d0e3f7;
    }

    .header-search input {
        border: none;
        outline: none;
        background: transparent;
        padding: 6px 8px;
        font-size: 14px;
        color: #004b8d;
        width: 160px;
    }

    .header-search button {
        background: var(--blue);
        border: none;
        color: #fff;
        padding: 6px 12px;
        border-radius: 16px;
        cursor: pointer;
        font-weight: 600;
    }

    .header-search button:hover {
        background: #2b86d6;
    }

    .cta-login {
        background: var(--blue);
        color: #fff;
        padding: 8px 14px;
        border-radius: 10px;
        border: 0;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
    }

    .cta-login:hover {
        background: #004aad;
        text-decoration: none;
    }

    /* Feature Section */
    .feature-section {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 80px 10%;
        gap: 50px;
    }

    .feature-section:nth-child(even) {
        flex-direction: row-reverse;
        background-color: #f7faff;
    }

    .feature-text {
        flex: 1;
        color: #004b8d;
    }

    .feature-text h2 {
        font-size: 30px;
        font-weight: 700;
        margin-bottom: 16px;
    }

    .feature-text p {
        font-size: 16px;
        line-height: 1.6;
        color: #1a1a1a;
        margin-bottom: 24px;
    }

    .feature-text a {
        display: inline-block;
        background-color: #ff7f32;
        color: white;
        padding: 10px 24px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        transition: 0.3s;
    }

    .feature-text a:hover {
        background-color: #e56e20;
    }

    .feature-img {
        flex: 1;
    }

    .feature-img img {
        width: 100%;
        border-radius: 16px;
        height: 420px;
        object-fit: cover;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s ease;
    }

    .feature-img img:hover {
        transform: scale(1.03);
    }

    .footer {
        background-color: #004b8d;
        color: white;
        padding: 60px 10%;
        margin-top: 60px;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 40px;
    }

    .footer h5 {
        font-size: 16px;
        margin-bottom: 10px;
        color: #ffffff;
        font-weight: 700;
    }

    .muted-light {
        color: #d1e6ff;
        font-size: 14px;
        line-height: 1.6;
        text-decoration: none;
    }

    .muted-light a {
        text-decoration: none;
        color: #f8f8f8ff;
        font-weight: 600;
        transition: color 0.3s ease;
    }
    </style>
</head>

<body>
    <header class="header">
        <div class="brand">
            <div class="logo">U&I</div>
            <div>
                <div class="title">U&I LOGISTICS</div>
                <div class="sub">Khai báo & Giải pháp vận tải</div>
            </div>
        </div>

        <nav class="navbar" aria-label="Chính">
            <ul class="menu" role="menubar">
                <li class="dropdown" role="none" aria-haspopup="true">
                    <a role="menuitem" href="#" aria-expanded="false">Giới thiệu ▾</a>
                    <ul class="dropdown-menu" role="menu" aria-label="Danh sách giới thiệu">
                        <li role="none"><a role="menuitem" href="/GioiThieu/VeChungToi.php">
                                Về chúng tôi</a>
                        </li>
                        <li role="none"><a role="menuitem" href="/GioiThieu/LichSuHinhThanh.php">Lịch sử hình thành</a>
                        </li>
                        <li role="none"><a role="menuitem" href="/GioiThieu/CongTyThanhVien.php">Công ty thành viên</a>
                        </li>
                        <li role="none"><a role="menuitem" href="/GioiThieu/CauChuyenThuongHieu.php">Câu chuyện thương
                                hiệu</a></li>
                    </ul>
                </li>
                <li class="dropdown" role="none" aria-haspopup="true">
                    <a role="menuitem" href="#" aria-expanded="false">Giới thiệu dịch vụ ▾</a>
                    <ul class="dropdown-menu" role="menu" aria-label="Danh sách dịch vụ">
                        <li role="none"><a role="menuitem" href="/ListDichVu/DaiLyThuTucHaiQuan.php">
                                Đại lý thủ tục hải quan</a>
                        </li>
                        <li role="none"><a role="menuitem" href="/ListDichVu/KhoVanPhanPhoiHangHoa.php">Kho vận &amp;
                                phân
                                phối hàng hóa</a></li>
                        <li role="none"><a role="menuitem" href="/ListDichVu/VanTaiNoiDia.php">Vận tải nội địa</a></li>
                        <li role="none"><a role="menuitem" href="/ListDichVu/VanTaiQuocTe.php">Vận tải quốc tế</a></li>
                    </ul>
                </li>

                <li class="dropdown" role="none" aria-haspopup="true">
                    <a role="menuitem" href="#" aria-expanded="false">Chức năng/Khai báo ▾</a>
                    <ul class="dropdown-menu" role="menu" aria-label="Danh sách chức năng">
                        <li role="none"><a role="menuitem" href="/TKXK/To1XK.php">Tờ khai xuất khẩu</a></li>
                        <li role="none"><a role="menuitem" href="/TKNK/To1NK.php">Tờ khai nhập khẩu</a></li>
                        <li role="none"><a role="menuitem" href="/ChucNangDonHang/ChucNangDonHang.php">Tra cứu đơn
                                hàng</a></li>
                        <li role="none"><a role="menuitem" href="/TraCuuCuocPhi/TraCuuCuocPhi.php">Tra cứu cước phí</a>
                        </li>
                        <li role="none"><a role="menuitem" href="/ThongKeDonHang/ThongKeDonHang.php">Thống kê đơn
                                hàng</a>
                        </li>
                        <li role="none"><a role="menuitem" href="/TTCongNo/ThanhToanCongNo.php">Thanh toán công nợ</a>
                        </li>
                    </ul>
                </li>

                <li role="none"><a href="../TinTuc/TinTuc.php" role="menuitem" href="#">Tin tức</a></li>
                <li role="none"><a role="menuitem" href="../LienHe/ThongTinLienHe.php" target="_self">Liên hệ</a></li>
            </ul>
        </nav>

        <form class="header-search" action="#" method="GET">
            <input type="text" name="tracking_code" placeholder="Mã vận đơn...">
            <button type="submit">Tìm</button>
        </form>

        <a class="cta-login" href="../DangNhap-DangKyTK/DangNhapDangKyTK.php">Đăng nhập</a>
    </header>

    <main>
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
                <img src="https://channel.mediacdn.vn/2019/5/4/photo-2-1556962025890735174566.jpg"
                    alt="Mạng lưới phân phối">
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
                <a href="../ListDichVu/CongTyThanhVien.php">XEM THÊM</a>
            </div>
            <div class="feature-img">
                <img src="https://www.unilogistics.vn/upload/images/dich-vu/Van_tai_duong_bien_1.jpg"
                    alt="Giải pháp logistics">
            </div>
        </section>
    </main>

    <!-- Footer -->
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