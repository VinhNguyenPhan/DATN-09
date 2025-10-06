<!DOCTYPE html>
<html lang="en">

<style>
.header {
    display: flex;
    align-items: center;
    padding: 22px 36px;
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

.contact-section {
    padding: 5px 20px;
    background: #f9fbfd;
    text-align: center;
}

.contact-section .title {
    font-size: 28px;
    font-weight: bold;
    color: #1f3c88;
    margin-bottom: 10px;
}

.contact-section .subtitle {
    font-size: 16px;
    color: #555;
    margin-bottom: 30px;
}

.contact-form {
    max-width: 600px;
    margin: 0 auto;
    background: #fff;
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    text-align: left;
}

.contact-form .form-group {
    margin-bottom: 20px;
}

.contact-form label {
    display: block;
    margin-bottom: 6px;
    font-weight: 500;
    color: #333;
}

.contact-form input,
.contact-form select {
    width: 100%;
    padding: 12px 14px;
    border: 1px solid #ddd;
    border-radius: 10px;
    font-size: 15px;
    outline: none;
    transition: all 0.2s ease;
}

.contact-form input:focus,
.contact-form select:focus {
    border-color: #1f6fb2;
    box-shadow: 0 0 4px rgba(31, 111, 178, 0.3);
}

.btn-submit {
    width: 100%;
    padding: 14px;
    border: none;
    border-radius: 12px;
    background: #1f6fb2;
    color: #fff;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.2s ease;
}

.btn-submit:hover {
    background: #155a91;
}
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên hệ</title>
</head>

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

<body>
    <section class="contact-section">
        <div class="container">
            <h2 class="title">Đăng ký nhận tư vấn</h2>
            <p class="subtitle">Vui lòng để lại thông tin để nhận được tư vấn tốt nhất từ các chuyên gia của chúng tôi.
            </p>

            <form class="contact-form">
                <div class="form-group">
                    <label for="name">Họ tên</label>
                    <input type="text" id="name" placeholder="Nhập họ tên" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" placeholder="Nhập email" required>
                </div>

                <div class="form-group">
                    <label for="phone">Số điện thoại</label>
                    <input type="tel" id="phone" placeholder="Nhập số điện thoại" required>
                </div>

                <div class="form-group">
                    <label for="company">Tên doanh nghiệp</label>
                    <input type="text" id="company" placeholder="Nhập tên doanh nghiệp">
                </div>

                <div class="form-group">
                    <label for="service">Bạn quan tâm đến dịch vụ nào?</label>
                    <select id="service" required>
                        <option value="">-- Chọn dịch vụ --</option>
                        <option value="haiquan">Đại lý thủ tục hải quan</option>
                        <option value="kho">Kho vận và phân phối hàng hóa</option>
                        <option value="vantai">Vận tải</option>
                        <option value="quocte">Vận tải đường biển và hàng không quốc tế</option>
                    </select>
                </div>

                <button type="submit" class="btn-submit">Gửi thông tin</button>
            </form>
        </div>
    </section>
</body>

</html>