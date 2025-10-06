<!-- Phần GIỚI THIỆU (có sẵn của bạn) -->
<section class="about-section">
    <header class="header">
        <!-- Logo: Toàn bộ logo là link -->
        <a href="../index.php" class="brand">
            <div class="logo-box">
                <span class="logo-text">U&amp;I</span>
            </div>
            <div class="brand-info">
                <div class="brand-text">LOGISTICS</div>
                <div class="sub">Khai báo & Giải pháp vận tải</div>
            </div>
        </a>
    </header>
    <div class="container">
        <!-- Cột trái -->
        <div class="about-left" style="padding-top:25px">
            <h1>Về chúng tôi</h1>
            <h2>Chào mừng đến với U&I LOGISTICS Miền Bắc</h2>
            <p>
                Công ty Cổ phần Đầu tư U&I (U&I Investment Corporation) là tên gọi của công ty mẹ bao gồm nhiều công ty
                thành viên và liên doanh hoạt động trong nhiều lĩnh vực khác nhau như Logistics, bất động sản và xây
                dựng,
                dịch vụ tài chính, kế toán kiểm toán, bán lẻ, nông nghiệp và sản xuất hàng xuất khẩu. U&I là từ viết tắt
                của
                cụm từ Bạn và Tôi trong tiếng Anh (You and I).
            </p>
            <p>
                U&I Logistics là một thành viên đứng đầu trong lĩnh vực logistics thuộc Unigroup. Được điều hành bởi
                những doanh nhân Việt Nam giàu kinh nghiệm, chúng tôi luôn tự hào là một trong những công ty hàng đầu
                tại Việt Nam chuyên cung cấp các dịch vụ đại lý khai thuê hải quan, giao nhận hàng hóa xuất nhập khẩu,
                kho hàng hóa, vận tải nội địa bằng đường bộ, đường thủy nội địa, ven biển và đường sắt. Chúng tôi hiểu
                rằng để tồn tại và phát triển U&I Logistics phải luôn tự hoàn thiện mình để cung cấp cho khách hàng
                những dịch vụ tin cậy nhất.
            </p>
        </div>

        <!-- Cột phải -->
        <div class="about-right">
            <h2>Đặc điểm nổi bật</h2>
            <div class="highlight-grid">
                <div class="highlight-card">
                    <h3>20+</h3>
                    <p>năm kinh nghiệm với niềm tự hào</p>
                </div>
                <div class="highlight-card">
                    <h3>100.000+</h3>
                    <p>Tờ khai mỗi năm</p>
                </div>
                <div class="highlight-card">
                    <h3>200+</h3>
                    <p>Nhân viên</p>
                </div>
                <div class="highlight-card">
                    <h3>1.830.769+</h3>
                    <p>Ballet lưu trữ hàng hóa</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Phần TẦM NHÌN – CAM KẾT – BHAG (đồng bộ giao diện) -->
<section class="core-values-section">
    <div class="core-container">
        <!-- Khối 1 -->
        <div class="core-card">
            <h2>Tầm nhìn, sứ mệnh và giá trị cốt lõi</h2>
            <p><strong>Tầm nhìn:</strong> Trở thành nhà cung cấp các dịch vụ logistics hiệu quả nhất tại Việt Nam.</p>
            <p><strong>Sứ mệnh:</strong> Cung cấp các giải pháp logistics đáp ứng đúng nhu cầu của từng khách hàng.</p>
            <p><strong>Giá trị cốt lõi:</strong></p>
            <ul>
                <li><strong>Trung thực:</strong> Là phẩm chất cần có đầu tiên đối với người lao động U&I Logistics.</li>
                <li><strong>Kỷ luật:</strong> Giá trị cốt lõi vượt trội là kỷ luật.</li>
                <li><strong>Uy tín:</strong> Chữ tín quý hơn vàng.</li>
            </ul>
        </div>

        <!-- Khối 2 -->
        <div class="core-card">
            <h2>Các cam kết</h2>
            <p><strong>Với người lao động:</strong> Môi trường làm việc cạnh tranh, tôn trọng và có cơ hội khẳng định
                mình.</p>
            <p><strong>Với khách hàng:</strong> Vì quyền lợi của khách hàng trước tiên.</p>
            <p><strong>Với cổ đông:</strong> Trung thực và minh bạch.</p>
            <p><strong>Với xã hội:</strong> Tôn trọng lợi ích chung.</p>
        </div>

        <!-- Khối 3 -->
        <div class="core-card">
            <h2>BHAG</h2>
            <p>Là hạt nhân kết nối tạo thành mạng lưới logistics lớn nhất Việt Nam trước năm 2025.</p>
        </div>
    </div>
</section>

<!-- CSS ĐỒNG BỘ -->
<style>
.header {
    display: flex;
    align-items: center;
    background: transparent;
}

.brand {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    /* bỏ gạch chân */
}

/* Logo hình vuông */
.logo-box {
    width: 55px;
    height: 55px;
    border-radius: 12px;
    background-color: #1f6fb2;
    /* xanh dương chủ đạo */
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s ease, background 0.3s ease;
}

/* Chữ U&I trong logo */
.logo-text {
    font-family: "Inter", sans-serif;
    font-weight: 800;
    font-size: 20px;
    color: #fff;
    /* màu trắng */
    letter-spacing: 0.5px;
}

.brand-text {
    font-family: "Inter", sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: #000;
    /* màu đen */
    letter-spacing: 0.8px;
}

/* Phần chữ LOGISTICS */
.brand-info .title {
    font-weight: 800;
    letter-spacing: 0.3px;
    color: #1f3c88;
    font-size: 18px;
}

.brand-info .sub {
    font-size: 13px;
    color: #6b7280;
    font-weight: 400;
}

/* Hiệu ứng hover toàn khối logo */
.brand:hover .logo-box {
    transform: scale(1.05);
    background-color: #2b86d6;
}


/* Giữ nguyên màu khi click/focus */
.brand:visited,
.brand:active,
.brand:focus {
    text-decoration: none;
    outline: none;
}

body {
    font-family: "Inter", sans-serif;
    margin: 0;
    padding: 0;
    background: #fff;
}

/* ====== ABOUT SECTION ====== */
.about-section {
    padding: 20px 60px;
    background: #f9fafc;
    font-family: "Inter", sans-serif;
}

.container {
    display: flex;
    gap: 60px;
    justify-content: space-between;
    align-items: flex-start;
}

.about-left {
    flex: 1;
    max-width: 60%;
}

.about-left h2 {
    font-size: 26px;
    font-weight: 800;
    margin-bottom: 18px;
    color: #1f3c88;
}

.about-left p {
    line-height: 1.7;
    margin-bottom: 16px;
    color: #333;
}

.about-right {
    flex: 1;
    max-width: 35%;
}

.about-right h2 {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 20px;
    color: #1f3c88;
}

.highlight-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
}

.highlight-card {
    background: #fff;
    border-radius: 14px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
    transition: 0.3s;
}

.highlight-card:hover {
    transform: translateY(-5px);
    background: linear-gradient(135deg, #1f6fb2, #2b86d6);
    color: #fff;
}

/* ====== CORE VALUES SECTION ====== */
.core-values-section {
    padding: 80px 100px;
    background: #fff;
}

.core-container {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 24px;
}

.core-card {
    flex: 1;
    min-width: 300px;
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 32px 26px;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
    transition: all 0.35s ease;
    cursor: pointer;
}

.core-card h2 {
    font-size: 20px;
    font-weight: 700;
    color: #1f3c88;
    margin-bottom: 18px;
    border-left: 5px solid #f89b29;
    padding-left: 10px;
}

.core-card p {
    color: #333;
    line-height: 1.6;
    margin-bottom: 10px;
}

.core-card ul {
    margin: 8px 0 0 18px;
    padding: 0;
}

.core-card ul li {
    margin-bottom: 8px;
    color: #333;
}

/* Hover đồng bộ */
.core-card:hover {
    background: linear-gradient(135deg, #1f6fb2, #2b86d6);
    color: #fff;
    transform: translateY(-6px);
    box-shadow: 0 10px 28px rgba(0, 0, 0, 0.15);
}

.core-card:hover h2 {
    color: #fff;
    border-left-color: #ffa726;
}

.core-card:hover p,
.core-card:hover li,
.core-card:hover strong {
    color: #fff;
}

@media (max-width: 1024px) {

    .container,
    .core-container {
        flex-direction: column;
    }
}
</style>