<section class="timeline-section">
    <div class="container">
        <h2 class="timeline-title">Lịch sử hình thành & phát triển</h2>
        <p class="timeline-intro">
            Hành trình phát triển hơn 20 năm của <strong>U&I Logistics</strong> là minh chứng cho sự nỗ lực không ngừng,
            từng bước vươn lên trở thành doanh nghiệp logistics hàng đầu Việt Nam.
        </p>

        <div class="timeline">
            <div class="timeline-item">
                <div class="timeline-year">2003</div>
                <div class="timeline-content">
                    <h3>Thành lập công ty</h3>
                    <p>U&I Logistics chính thức được thành lập, đặt nền móng đầu tiên tại Bình Dương với định hướng trở
                        thành nhà cung cấp dịch vụ logistics toàn diện.</p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-year">2008</div>
                <div class="timeline-content">
                    <h3>Mở rộng kho bãi và dịch vụ</h3>
                    <p>Đầu tư hệ thống kho bãi quy mô lớn, đồng thời phát triển thêm dịch vụ vận tải đường bộ và đại lý
                        hải quan.</p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-year">2013</div>
                <div class="timeline-content">
                    <h3>Thành lập chi nhánh miền Bắc</h3>
                    <p>Mở rộng hoạt động ra miền Bắc với trung tâm logistics hiện đại tại Hải Phòng và Hà Nội.</p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-year">2017</div>
                <div class="timeline-content">
                    <h3>Đạt chứng nhận quốc tế</h3>
                    <p>Nhận chứng chỉ ISO 9001:2015 và nhiều giải thưởng uy tín trong lĩnh vực logistics Việt Nam.</p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-year">2020</div>
                <div class="timeline-content">
                    <h3>Chuyển đổi số mạnh mẽ</h3>
                    <p>Triển khai hệ thống quản lý logistics thông minh, số hóa toàn bộ quy trình giao nhận và kho vận.
                    </p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-year">2023</div>
                <div class="timeline-content">
                    <h3>Vươn tầm quốc tế</h3>
                    <p>Trở thành một trong những doanh nghiệp logistics hàng đầu Việt Nam, mở rộng hợp tác quốc tế tại
                        khu vực châu Á – Thái Bình Dương.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Lịch sử hình thành */
.timeline-section {
    background: #f9fafc;
    padding: 80px 100px;
    font-family: "Inter", sans-serif;
}

.timeline-title {
    text-align: center;
    font-size: 30px;
    font-weight: 800;
    color: #1f3c88;
    margin-bottom: 10px;
}

.timeline-intro {
    text-align: center;
    color: #444;
    font-size: 16px;
    margin-bottom: 50px;
    line-height: 1.6;
}

.timeline {
    position: relative;
    max-width: 1000px;
    margin: 0 auto;
}

.timeline::before {
    content: "";
    position: absolute;
    left: 50%;
    top: 0;
    width: 4px;
    height: 100%;
    background: #1f6fb2;
    transform: translateX(-50%);
    border-radius: 10px;
}

.timeline-item {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    margin-bottom: 50px;
    position: relative;
}

.timeline-item:nth-child(even) {
    flex-direction: row-reverse;
}

.timeline-year {
    background: #1f6fb2;
    color: #fff;
    font-size: 20px;
    font-weight: 700;
    padding: 14px 22px;
    border-radius: 50px;
    box-shadow: 0 4px 15px rgba(31, 111, 178, 0.4);
    z-index: 2;
    transition: 0.3s;
}

.timeline-content {
    background: #fff;
    padding: 25px 30px;
    border-radius: 16px;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
    width: 45%;
    transition: 0.3s;
}

.timeline-item:nth-child(odd) .timeline-content {
    margin-left: 30px;
}

.timeline-item:nth-child(even) .timeline-content {
    margin-right: 30px;
}

.timeline-content h3 {
    font-size: 20px;
    font-weight: 700;
    color: #1f3c88;
    margin-bottom: 10px;
}

.timeline-content p {
    font-size: 15px;
    color: #333;
    line-height: 1.6;
}

/* Hiệu ứng hover */
.timeline-item:hover .timeline-content {
    transform: translateY(-5px);
    background: linear-gradient(135deg, #1f6fb2, #2b86d6);
    color: #fff;
}

.timeline-item:hover .timeline-content h3 {
    color: #fff;
}

.timeline-item:hover .timeline-year {
    background: #2b86d6;
    box-shadow: 0 6px 16px rgba(31, 111, 178, 0.6);
}
</style>