<?php 
require_once(__DIR__."/../core/database.php");
?>

<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Trang chủ — Logistics & Khai báo Hải quan (Mockup)</title>
    <script src="https://cdn.jsdelivr.net/gh/riversun/chatux/dist/chatux.min.js"></script>

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

    main {
        min-height: 500px;
        display: flex;
        justify-content: center;
        padding: 40px 0;
        background: #f5f7fa;
        font-family: 'Inter', sans-serif;
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
        gap: 12px;
        text-decoration: none;
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

    /*logout menu*/
    /* --- Hồ sơ tài khoản / User Menu --- */
    /* --- Hồ sơ tài khoản / User Menu --- */
    .user-profile {
        position: relative;
        display: inline-block;
        font-family: "Inter", sans-serif;
    }

    /* Kích hoạt hover */
    .user-profile:hover .user-dropdown,
    .user-profile:focus-within .user-dropdown {
        display: block;
    }

    /* Nút kích hoạt */
    .user-toggle {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        background: #f3f6fb;
        padding: 6px 10px;
        border-radius: 20px;
        border: 1px solid #d0e3f7;
        transition: background 0.2s ease, box-shadow 0.2s ease;
        position: relative;
        z-index: 10;
    }

    .user-toggle:hover {
        background: #e8f1fb;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
    }

    /* Avatar */
    .avatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: var(--blue);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 700;
        font-size: 14px;
    }

    /* Dropdown menu */
    .user-dropdown {
        display: none;
        position: absolute;
        right: 0;
        top: calc(100% + 6px);
        background: #fff;
        border-radius: 12px;
        box-shadow: var(--shadow);
        list-style: none;
        padding: 6px 0;
        margin: 0;
        min-width: 190px;
        z-index: 5;
        animation: fadeIn 0.2s ease;
        pointer-events: auto;
    }

    /* Tạo “vùng đệm an toàn” giúp hover dễ hơn */
    .user-profile::after {
        content: "";
        position: absolute;
        top: 100%;
        right: 0;
        width: 100%;
        height: 10px;
        background: transparent;
    }

    /* Item */
    .user-dropdown li {
        padding: 0;
    }

    .user-dropdown a {
        display: block;
        padding: 10px 16px;
        color: var(--accent);
        text-decoration: none;
        font-weight: 500;
        font-size: 15px;
        transition: background 0.2s ease, color 0.2s ease;
    }

    .user-dropdown a:hover {
        background: #f0f5ff;
        color: #e91e63;
    }

    .user-dropdown a.logout {
        color: #c0392b;
        font-weight: 600;
    }

    .user-dropdown a.logout:hover {
        background: #ffeaea;
    }

    /* Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-6px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    </style>
</head>

<body>
    <header class="header">
        <a href="../index.php" class="brand">
            <div class="logo">U&I</div>
            <div>
                <div class="title">U&I LOGISTICS</div>
                <div class="sub">Khai báo & Giải pháp vận tải</div>
            </div>
        </a>

        <nav class="navbar" aria-label="Chính">
            <ul class="menu" role="menubar">
                <li class="dropdown" role="none" aria-haspopup="true">
                    <a role="menuitem" href="#" aria-expanded="false">Giới thiệu ▾</a>
                    <ul class="dropdown-menu" role="menu" aria-label="Danh sách giới thiệu">
                        <li role="none"><a role="menuitem" href="/GioiThieu/VeChungToi.php">
                                Về chúng tôi</a>
                        </li>
                        <li role="none"><a role="menuitem" href="/GioiThieu/LichSuHinhThanh.php">Lịch sử hình
                                thành</a>
                        </li>
                        <li role="none"><a role="menuitem" href="/GioiThieu/CongTyThanhVien.php">Công ty thành
                                viên</a>
                        </li>
                        <li role="none"><a role="menuitem" href="/GioiThieu/CauChuyenThuongHieu.php">Câu chuyện
                                thương
                                hiệu</a></li>
                    </ul>
                </li>
                <li class="dropdown" role="none" aria-haspopup="true">
                    <a role="menuitem" href="#" aria-expanded="false">Giới thiệu dịch vụ ▾</a>
                    <ul class="dropdown-menu" role="menu" aria-label="Danh sách dịch vụ">
                        <li role="none"><a role="menuitem" href="/TraCuuCuocPhi/TraCuuCuocPhi.php">Tra cứu cước
                                phí</a>
                        </li>
                        <li role="none"><a role="menuitem" href="/ListDichVu/DaiLyThuTucHaiQuan.php">
                                Đại lý thủ tục hải quan</a>
                        </li>
                        <li role="none"><a role="menuitem" href="/ListDichVu/KhoVanPhanPhoiHangHoa.php">Kho vận
                                &amp;
                                phân
                                phối hàng hóa</a></li>
                        <li role="none"><a role="menuitem" href="/ListDichVu/VanTaiNoiDia.php">Vận tải nội
                                địa</a></li>
                        <li role="none"><a role="menuitem" href="/ListDichVu/VanTaiQuocTe.php">Vận tải quốc
                                tế</a></li>
                    </ul>
                </li>
                <?php if(!empty($_SESSION["user_id"])):?>
                <li class="dropdown" role="none" aria-haspopup="true">
                    <a role="menuitem" href="#" aria-expanded="false">Chức năng/Khai báo ▾</a>
                    <ul class="dropdown-menu" role="menu" aria-label="Danh sách chức năng">
                        <?php
                            if(in_array($_SESSION['role'], $_role_KhaiBao)): 
                        ?>
                        <li role="none"><a role="menuitem" href="/TKXK/To1XK.php">Tờ khai xuất khẩu</a></li>
                        <li role="none"><a role="menuitem" href="/TKNK/To1NK.php">Tờ khai nhập khẩu</a></li>
                        <?php endif; ?>
                        <?php
                            if(in_array($_SESSION['role'], $_role_TimToKhai)): 
                        ?>
                        <li role="none"><a role="menuitem" href="/TraCuuDonHang/TraCuu.php">Tìm tờ khai</a>
                        </li>
                        <?php endif; ?>
                        <?php
                            if(in_array($_SESSION['role'], $_role_TraCuuViTri)): 
                        ?>
                        <li role="none"><a role="menuitem" href="/ChucNangDonHang/ChucNangDonHang.php">Tra cứu
                                vị trí
                                đơn hàng</a></li>
                        <?php endif; ?>

                        <?php
                            if(in_array($_SESSION['role'], $_role_ThongKe)): 
                        ?>
                        <li role="none"><a role="menuitem" href="/ThongKeDonHang/ThongKeDonHang.php">Thống kê
                                đơn
                                hàng</a></li>
                        <?php endif; ?>

                        <?php
                            if(in_array($_SESSION['role'], $_role_ThanhToan)): 
                        ?>
                        <li role="none"><a role="menuitem" href="/TTCongNo/ThanhToanCongNo.php">Thanh toán công
                                nợ</a></li>
                        <?php endif; ?>

                        <?php
                            if(in_array($_SESSION['role'], $_role_ChinhSuaTrangThai)): 
                        ?>
                        <li role="none"><a role="menuitem" href="/TraCuuDonHang/ChinhSuaTrangThaiDH.php">Chỉnh
                                sửa trạng
                                thái đơn hàng</a></li>
                        <?php endif; ?>

                        <?php
                            if(in_array($_SESSION['role'], $_role_ChinhSuaViTri)): 
                        ?>
                        <li role="none"><a role="menuitem" href="/CapNhatViTri/CapNhatViTri.php">Cập nhật vị trí đơn
                                hàng</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>

                <li role="none"><a href="../TinTuc/TinTuc.php" role="menuitem" href="#">Tin tức</a></li>
                <li role="none"><a role="menuitem" href="../LienHe/ThongTinLienHe.php" target="_self">Liên
                        hệ</a></li>
            </ul>
        </nav>

        <form class="header-search" action="/TraCuuDonHang/TraCuu.php" method="GET">
            <input type="text" name="search" placeholder="Mã vận đơn...">
            <button type="submit">Tìm</button>
        </form>

        <?php if (!isset($_SESSION['user_id'])): ?>
        <!-- CHƯA ĐĂNG NHẬP -->
        <a class="cta-login" href="../DangNhap-DangKyTK/DangNhapDangKyTK.php">Đăng nhập</a>
        <?php else: ?>
        <!-- ĐÃ ĐĂNG NHẬP -->
        <?php
        $uid = $_SESSION['user_id'];
        $user = $conn->query("SELECT username FROM users WHERE id = '$uid'")->fetch_assoc();
    ?>
        <div class="user-profile">
            <div class="user-toggle" tabindex="0">
                <div class="avatar">
                    <span><?= strtoupper(substr($user['username'], 0, 1)) ?></span>
                </div>
                <span class="welcome-text"><?= htmlspecialchars($user['username']) ?></span>
                <svg class="icon-caret" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    viewBox="0 0 16 16">
                    <path d="M1.5 5.5l6 6 6-6" stroke="currentColor" stroke-width="2" fill="none"
                        stroke-linecap="round" />
                </svg>
            </div>

            <ul class="user-dropdown">
                <li><a href="../DangNhap-DangKyTK/HoSoTK.php">👤 Hồ sơ tài khoản</a></li>
                <li><a href="../DangNhap-DangKyTK/Logout.php" class="logout">🚪 Đăng xuất</a></li>
            </ul>
        </div>
        <?php endif; ?>

    </header>

    <main>