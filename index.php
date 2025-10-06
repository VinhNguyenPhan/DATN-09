<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Trang chủ — Logistics & Khai báo Hải quan (Mockup)</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
    .features {
        max-width: 1100px;
        margin: 18px auto 6px;
        padding: 12px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px
    }

    .card {
        background: var(--card);
        border-radius: 12px;
        padding: 22px;
        box-shadow: var(--shadow);
        display: flex;
        flex-direction: column;
        gap: 12px;
        align-items: flex-start;
        border: 1px solid rgba(15, 23, 42, 0.04)
    }

    .card:hover {
        background-color: #2980b9;
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .card__icon {
        width: 56px;
        height: 56px;
        border-radius: 10px;
        background: linear-gradient(180deg, #f2f8ff, #edf7ff);
        display: flex;
        align-items: center;
        justify-content: center
    }

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

    .logo:hover {
        transform: scale(1.05);
        background: #2b86d6;
    }

    html,
    body {
        height: 100%;
    }

    body {
        margin: 0;
        font-family: "Inter", system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        background: linear-gradient(180deg, #ffffff 0%, #f6f9fc 100%);
        color: var(--text);
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    /* Header */
    .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 22px 36px;
        background: transparent;
        gap: 18px;
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
    }

    .brand .title {
        font-weight: 800;
        letter-spacing: 0.2px;
    }

    .brand .sub {
        font-size: 12px;
        color: var(--muted);
    }

    /* Navbar */
    .navbar {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    nav .menu {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        gap: 28px;
        align-items: center;
        font-weight: 600;
    }

    nav .menu li {
        position: relative;
    }

    nav .menu a {
        color: var(--accent);
        text-decoration: none;
        font-weight: 500;
        font-size: 16px;
        padding: 6px 4px;
        display: inline-block;
        transition: color .15s ease;
    }

    nav .menu a:hover,
    nav .menu a:focus {
        color: #e91e63;
        outline: none;
    }

    /* Dropdown */
    .dropdown>a {
        cursor: pointer;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: calc(100% + 10px);
        left: 0;
        min-width: 260px;
        background: #fff;
        border-radius: 12px;
        padding: 8px 0;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        z-index: 1000;
        transform-origin: top left;
    }

    /* Show on hover or focus-within (keyboard accessible) */
    .dropdown:hover .dropdown-menu,
    .dropdown:focus-within .dropdown-menu {
        display: block;
        animation: fadeInUp .22s ease;
    }

    .dropdown-menu li {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .dropdown-menu a {
        display: block;
        padding: 12px 18px;
        color: #333;
        text-decoration: none;
        font-size: 15px;
        transition: background .12s ease, color .12s ease;
    }

    .dropdown-menu a:hover,
    .dropdown-menu a:focus {
        background: #f5f7fb;
        color: var(--blue);
        border-radius: 8px;
        outline: none;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(6px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* CTA login */
    .cta-login {
        background: var(--blue);
        color: #fff;
        padding: 10px 16px;
        border-radius: 10px;
        border: 0;
        font-weight: 700;
        cursor: pointer;
        transition: transform .12s ease, box-shadow .12s ease;
    }

    .cta-login:hover {
        transform: scale(1.04);
        box-shadow: 0 6px 18px rgba(31, 111, 178, 0.18);
    }

    /* Hero */
    .hero {
        padding: 36px 36px 24px;
        display: grid;
        gap: 28px;
    }

    .hero-inner {
        background: transparent;
        border-radius: 16px;
        padding: 28px 18px;
    }

    .hero-title {
        font-size: 34px;
        line-height: 1.05;
        color: var(--blue);
        font-weight: 800;
        margin: 0;
    }

    .hero-sub {
        color: var(--muted);
        margin-top: 8px;
    }

    .hero-row {
        display: flex;
        gap: 20px;
        align-items: flex-start;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .hero-illu {
        width: 100%;
        max-height: 260px;
        object-fit: cover;
        border-radius: 12px;
    }

    .primary-btn {
        background: var(--blue);
        color: #fff;
        padding: 12px 20px;
        border-radius: 12px;
        border: 0;
        font-weight: 700;
        cursor: pointer;
    }

    .primary-btn:hover {
        background-color: #2980b9;
        transform: scale(1.03);
        box-shadow: 0 6px 16px rgba(41, 128, 185, 0.18);
    }

    /* Feature grid */
    .features {
        max-width: 1100px;
        margin: 18px auto 6px;
        padding: 12px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
    }

    .card {
        background: var(--card);
        border-radius: 12px;
        padding: 22px;
        box-shadow: var(--shadow);
        display: flex;
        flex-direction: column;
        gap: 12px;
        align-items: flex-start;
        border: 1px solid rgba(15, 23, 42, 0.04);
        text-decoration: none;
        color: inherit;
        transition: transform .15s ease, box-shadow .15s ease, background .15s ease;
    }

    .card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 24px rgba(12, 20, 39, 0.08);
    }

    .card__icon {
        width: 56px;
        height: 56px;
        border-radius: 10px;
        background: linear-gradient(180deg, #f2f8ff, #edf7ff);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card h4 {
        margin: 0;
        font-size: 18px;
        color: var(--text);
    }

    .card p {
        margin: 0;
        color: #333;
        font-size: 13px;
    }

    /* Search */
    .search-wrap {
        max-width: 1100px;
        margin: 14px auto;
        padding: 12px;
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .search {
        flex: 1;
        background: #fff;
        border-radius: 12px;
        padding: 12px 16px;
        display: flex;
        gap: 10px;
        align-items: center;
        box-shadow: 0 2px 10px rgba(12, 20, 39, 0.06);
    }

    .input {
        border: 0;
        outline: 0;
        font-size: 15px;
        width: 100%;
    }

    /* Footer */
    .footer {
        background: var(--blue);
        color: #fff;
        padding: 26px 36px;
        margin-top: 28px;
        border-top-left-radius: 18px;
        border-top-right-radius: 18px;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 18px;
    }

    .footer h5 {
        margin: 0 0 8px 0;
        color: #fff;
    }

    .muted-light {
        color: rgba(255, 255, 255, 0.95);
        font-size: 14px;
    }

    /* Responsive */
    @media (max-width:1000px) {
        .features {
            grid-template-columns: repeat(2, 1fr);
            padding: 8px;
        }

        .hero-title {
            font-size: 28px;
        }

        .footer-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width:640px) {
        .header {
            padding: 10px 20px;
        }

        nav .menu {
            display: none;
        }

        /* keep simple: hide full menu on small screens */
        .features {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .footer-grid {
            grid-template-columns: 1fr;
        }
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
                    <a role="menuitem" href="#" aria-expanded="false">Dịch vụ ▾</a>
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

                <li role="none"><a href="../TinTuc/TinTuc.php" role="menuitem" href="#">Tin tức</a></li>
                <li role="none"><a role="menuitem" href="../LienHe/ThongTinLienHe.php" target="_self">Liên hệ</a></li>
            </ul>
        </nav>

        <a href="../DangNhap-DangKyTK/DangNhapDangKyTK.php" target="_self">
            <button class="cta-login">Đăng nhập</button>
        </a>
    </header>

    <main>
        <!-- Hero -->
        <section class="hero" aria-label="Hero">
            <div class="hero-inner">
                <div class="hero-row">
                    <div style="flex:1; min-width:260px;">
                        <h1 class="hero-title">Giải pháp quản lý khai báo hải quan &amp; vận chuyển hàng hóa toàn diện
                        </h1>
                        <p class="hero-sub">Quản lý tờ khai, theo dõi đơn hàng real-time, tra cứu cước phí và kết nối
                            kho vận — tất cả tại một nơi.</p>
                        <div style="margin-top:18px; display:flex; gap:12px; flex-wrap:wrap;">
                            <button class="primary-btn">Bắt đầu ngay</button>
                            <button class="card"
                                style="background:transparent; border:1px solid rgba(47,84,145,0.12); padding:10px 14px; border-radius:12px; cursor:pointer;">Tìm
                                hiểu thêm</button>
                        </div>
                    </div>

                    <div style="width:460px; max-width:46%;">
                        <!-- Illustration -->
                        <svg class="hero-illu" viewBox="0 0 1200 600" xmlns="http://www.w3.org/2000/svg" role="img"
                            aria-label="illustration">
                            <defs>
                                <linearGradient id="g1" x1="0" x2="1">
                                    <stop offset="0" stop-color="#eaf4ff" />
                                    <stop offset="1" stop-color="#f4f9ff" />
                                </linearGradient>
                            </defs>
                            <rect width="1200" height="600" fill="url(#g1)" rx="12" />
                            <g transform="translate(40,40)" fill="#2b86d6" opacity="0.95">
                                <rect x="20" y="340" width="520" height="90" rx="6" fill="#234c7a" />
                                <rect x="60" y="300" width="140" height="60" rx="4" fill="#2b86d6" />
                                <rect x="220" y="300" width="140" height="60" rx="4" fill="#3b97e1" />
                                <rect x="420" y="300" width="140" height="60" rx="4" fill="#7fb9ea" />
                                <path d="M720 360h320v-60h-320z" fill="#2b86d6" />
                                <rect x="720" y="280" width="220" height="80" rx="6" fill="#5aa3df" />
                                <circle cx="980" cy="210" r="36" fill="#2b86d6" />
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features -->
        <section class="features" aria-label="Các chức năng chính">
            <a class="card" href="/TKXK/To1XK.php" target="_self" role="button" tabindex="0">
                <div class="card__icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                        <path d="M12 3v12" stroke="#1f6fb2" stroke-width="1.6" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M8 7l4-4 4 4" stroke="#1f6fb2" stroke-width="1.6" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M20 21H4" stroke="#9ab7dd" stroke-width="1.6" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <h4>Tờ khai xuất khẩu</h4>
                <p>Truy cập &amp; khai báo nhanh — mẫu và tệp đính kèm.</p>
            </a>

            <a class="card" href="/TKNK/To1NK.php" target="_self" role="button" tabindex="0">
                <div class="card__icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                        <path d="M12 21V9" stroke="#1f6fb2" stroke-width="1.6" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M16 17l-4 4-4-4" stroke="#1f6fb2" stroke-width="1.6" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M20 3H4" stroke="#9ab7dd" stroke-width="1.6" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <h4>Tờ khai nhập khẩu</h4>
                <p>Quản lý &amp; khai báo nhập khẩu — trạng thái, lịch sử.</p>
            </a>

            <a class="card" href="/ChucNangDonHang/ChucNangDonHang.php" target="_self" role="button" tabindex="0">
                <div class="card__icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                        <path d="M12 11.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" stroke="#1f6fb2" stroke-width="1.6"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M21 11.5c0 6-9 11.5-9 11.5S3 17.5 3 11.5a9 9 0 1 1 18 0z" stroke="#9ab7dd"
                            stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <h4>Xem vị trí đơn hàng</h4>
                <p>Theo dõi real-time bằng số vận đơn.</p>
            </a>

            <a class="card" href="/TraCuuCuocPhi/TraCuuCuocPhi.php" target="_self" role="button" tabindex="0">
                <div class="card__icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                        <path d="M12 1v22" stroke="#1f6fb2" stroke-width="1.6" stroke-linecap="round" />
                        <path d="M19 5H5v14h14V5z" stroke="#9ab7dd" stroke-width="1.2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <h4>Tra cứu cước phí</h4>
                <p>Nhập tuyến &amp; loại hàng – nhận báo giá nhanh.</p>
            </a>

            <a class="card" href="/ThongKeDonHang/ThongKeDonHang.php" target="_self" role="button" tabindex="0">
                <div class="card__icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M22 16.92V7.08A3 3 0 0 0 19.08 4H4.92A3 3 0 0 0 2 7.08v9.84A3 3 0 0 0 4.92 20h14.16A3 3 0 0 0 22 16.92z"
                            stroke="#1f6fb2" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M8 9h8" stroke="#9ab7dd" stroke-width="1.2" stroke-linecap="round" />
                    </svg>
                </div>
                <h4>Trạng thái đơn hàng</h4>
                <p>Đơn đã lấy, đang giao, đã giao và đơn hủy.</p>
            </a>

            <a class="card" href="/TTCongNo/ThanhToanCongNo.php" target="_self" role="button" tabindex="0">
                <div class="card__icon">
                    <!-- simplified lock icon -->
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                        <rect x="4" y="10" width="16" height="10" rx="2" stroke="#1f6fb2" stroke-width="1.6" />
                        <path d="M8 10V7a4 4 0 0 1 8 0v3" stroke="#1f6fb2" stroke-width="1.6" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <h4>Tra cứu công nợ</h4>
                <p>Dành cho tài khoản quản lý &amp; nhân viên.</p>
            </a>
        </section>

        <!-- Search -->
        <section class="search-wrap">
            <div class="search" role="search">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" style="opacity:0.7">
                    <path d="M21 21l-4.35-4.35" stroke="#6b7280" stroke-width="1.6" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <circle cx="11" cy="11" r="6" stroke="#6b7280" stroke-width="1.6" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <input class="input" placeholder="Nhập số vận đơn / số tờ khai..." aria-label="Tìm vận đơn" />
                <button class="primary-btn">Tra cứu</button>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-grid">
            <div>
                <h5>CÔNG TY CỔ PHẦN LOGISTICS U&I - MIỀN BẮC</h5>
                <div class="muted-light">Mã số thuế: 0108156122-002<br />Địa chỉ: Tầng 6, Tòa nhà Transerco, số 311-313
                    Trường Chinh, Phường Phương Liệt, TP. Hà Nội, Việt Nam</div>
            </div>
            <div>
                <h5>LIÊN HỆ</h5>
                <div class="muted-light">Hotline: +84 24 7300 0548<br />Email: info@unilogistics.vn</div>
            </div>
            <div>
                <h5>CHÍNH SÁCH</h5>
                <div class="muted-light">Bảo mật · Điều khoản sử dụng · Hỗ trợ khách hàng</div>
            </div>
        </div>
    </footer>
</body>

</html>