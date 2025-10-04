<section class="about-section">
    <div class="container">
        <!-- Cột trái -->
        <div class="about-left">
            <h2>Giới thiệu về dịch vụ</h2>
            <p>
                Với hơn 140 xe đầu kéo container được lắp đặt thiết bị giám sát hành trình và hơn 200 rơ mooc hợp chuẩn,
                U&I Logistics cung cấp giải pháp vận tải đường bộ kết nối các khu vực kinh tế trọng điểm Bắc – Trung –
                Nam.
            </p>
            <p>
                Chúng tôi ứng dụng công nghệ vào vận hành giúp xác định chính xác vị trí đầu kéo, rơ mooc, tiết kiệm tối
                đa thời gian và chi phí vận chuyển cho khách hàng. Nổi bật là hệ thống theo dõi hành trình hàng hóa theo
                công nghệ GPS, phần mềm quản lý vận tải (TMS) cùng app mobile dành cho tài xế. Nhờ đó, chúng tôi đã vận
                tải thành công 20.000 TEUs/tháng.

            <h3>Các dịch vụ vận tải hàng hóa nội địa gồm: </h3>
            <ul class="service-list">
                <li>📌 Vận chuyển đường bộ bằng container</li>
                <li>📌 Vận chuyển đường sắt</li>
                <li>📌 Vận chuyển đường thủy nội địa</li>
                <li>📌 Vận chuyển đường biển ven bờ</li>
            </ul>
        </div>

        <!-- Cột phải -->
        <div class="about-right">
            <h2>Đặc điểm nổi bật</h2>
            <div class="highlight-grid">
                <div class="highlight-card">
                    <h3>100</h3>
                    <p>đầu kéo</p>
                </div>
                <div class="highlight-card">
                    <h3>200</h3>
                    <p>rơ móc</p>
                </div>
                <div class="highlight-card">
                    <h3>200,000</h3>
                    <p>TEUs mỗi tháng</p>
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