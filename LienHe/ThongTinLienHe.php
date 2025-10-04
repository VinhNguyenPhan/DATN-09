<!DOCTYPE html>
<html lang="en">

<style>
.contact-section {
    padding: 60px 20px;
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