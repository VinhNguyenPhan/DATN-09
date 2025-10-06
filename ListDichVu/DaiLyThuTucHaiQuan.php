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
        <div class="about-left">
            <h2>Giới thiệu về dịch vụ</h2>
            <p>
                Công ty Cổ phần Logistics U&I là một trong những công ty tiên phong trong lĩnh vực thủ tục hải quan tại
                Việt Nam.
                Với phòng đại lý thủ tục Hải quan do chính chúng tôi vận hành, được đặt tại các vị trí chiến lược và có
                thể thực
                hiện nhiều loại biểu mẫu khai báo cho mọi loại hàng, mọi kích cỡ, với mọi phương tiện vận chuyển.
            </p>
            <p>
                Không chỉ cung cấp giải pháp chất lượng với chi phí hợp lý, chúng tôi còn thể hiện sự chuyên nghiệp
                thông qua thời
                gian xử lý lượng lớn các tờ khai một cách nhanh chóng với độ chính xác cao.
            </p>

            <h3>Các dịch vụ đại lý thủ tục hải quan gồm:</h3>
            <ul class="service-list">
                <li>📌 Dịch vụ khai thuê hải quan</li>
                <li>📌 Dịch vụ giao nhận</li>
                <li>📌 Xin cấp C/O</li>
                <li>📌 Tư vấn thuế</li>
                <li>📌 Lập báo cáo quyết toán cho loại hình sản xuất xuất khẩu & gia công</li>
            </ul>
        </div>

        <!-- Cột phải -->
        <div class="about-right">
            <h2>Đặc điểm nổi bật</h2>
            <div class="highlight-grid">
                <div class="highlight-card">
                    <h3>150+</h3>
                    <p>Khách hàng</p>
                </div>
                <div class="highlight-card">
                    <h3>20+</h3>
                    <p>Năm kinh nghiệm</p>
                </div>
                <div class="highlight-card">
                    <h3>100,000</h3>
                    <p>Tờ khai/năm</p>
                </div>
                <div class="highlight-card">
                    <h3>150,000</h3>
                    <p>TEUs hàng hóa/năm</p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* ===== HEADER & LOGO ===== */
.header {
    display: flex;
    align-items: center;
    padding: 5px;
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

.about-section {
    padding: 60px 80px;
    background: #f9fafc;
    font-family: "Inter", sans-serif;
}

.container {
    display: flex;
    gap: 60px;
    justify-content: space-between;
    align-items: flex-start;
}

/* Cột trái */
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

.about-left h3 {
    font-size: 20px;
    margin: 20px 0 14px;
    color: #1f6fb2;
}

.service-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.service-list li {
    margin-bottom: 10px;
    font-weight: 500;
    color: #444;
    padding-left: 6px;
}

/* Cột phải */
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

.highlight-card h3 {
    font-size: 28px;
    font-weight: 800;
    margin: 0;
}

.highlight-card p {
    margin-top: 8px;
    font-size: 15px;
    font-weight: 500;
}
</style>