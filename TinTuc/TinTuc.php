<?php
include_once(__DIR__.'/../public/header.php');
?>
<section class="news-section">

    <div class="news-container">
        <h2 class="news-title">Tin tức Logistics</h2>
        <p class="news-subtitle">Cập nhật nhanh chóng - Chính xác - Đa chiều về ngành Logistics</p>

        <div class="news-grid">
            <!-- Tin tức 1 -->
            <div class="news-card">
                <img src="https://mit.vn/wp-content/uploads/2023/11/thumb_bialogistics.png"
                    alt="Xu hướng logistics 2025">
                <div class="news-content">
                    <h3>Xu hướng phát triển ngành Logistics Việt Nam 2025</h3>
                    <p>Ngành logistics Việt Nam đang tăng tốc chuyển đổi số mạnh mẽ, hướng tới tự động hóa và phát triển
                        bền vững...</p>
                    <a href="#" class="read-more">Đọc thêm &raquo;</a>
                </div>
            </div>

            <!-- Tin tức 2 -->
            <div class="news-card">
                <img src="https://mit.vn/wp-content/uploads/2023/11/he1bba5ndd.jpg" alt="Chuỗi cung ứng toàn cầu">
                <div class="news-content">
                    <h3>Chuỗi cung ứng toàn cầu sau đại dịch: Cơ hội và thách thức</h3>
                    <p>Các doanh nghiệp Việt Nam cần thích ứng linh hoạt với biến động của chuỗi cung ứng toàn cầu để
                        tối ưu chi phí vận tải...</p>
                    <a href="#" class="read-more">Đọc thêm &raquo;</a>
                </div>
            </div>

            <!-- Tin tức 3 -->
            <div class="news-card">
                <img src="https://mit.vn/wp-content/uploads/2023/11/hjsdfvbgfdgshfjgkl.jpg"
                    alt="Giải pháp logistics xanh">
                <div class="news-content">
                    <h3>Logistics xanh – Xu thế tất yếu của tương lai</h3>
                    <p>U&I Logistics tiên phong trong việc ứng dụng năng lượng mặt trời và tối ưu hóa vận hành xanh
                        trong hệ thống kho bãi...</p>
                    <a href="#" class="read-more">Đọc thêm &raquo;</a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* --- Nền xám bao ngoài --- */
.news-wrapper {
    background-color: #f0f0f0;
    /* màu xám nhẹ */
    padding: 40px 0;
    display: flex;
    justify-content: center;
}

/* --- Nền trắng chiếm 80% trang --- */
.news-section {
    background-color: #fff;
    width: 80%;
    padding: 40px 45px;
    color: #222;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
    border-radius: 0;
    /* Nếu muốn vuông góc */
}

.news-container {
    max-width: 1200px;
    margin: 0 auto;
    text-align: center;
}

/* Giữ nguyên các phần còn lại */
.news-title {
    font-size: 32px;
    font-weight: 800;
    color: #1f3c88;
    margin-bottom: 8px;
}

.news-subtitle {
    font-size: 18px;
    color: #555;
    margin-bottom: 50px;
}

.news-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 30px;
}

.news-card {
    background: #fafbfc;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
    overflow: hidden;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    text-align: left;
}

.news-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
}

.news-card img {
    width: 100%;
    height: 220px;
    object-fit: cover;
}

.news-content {
    padding: 20px;
}

.news-content h3 {
    font-size: 20px;
    color: #1f3c88;
    margin-bottom: 10px;
    line-height: 1.4;
}

.news-content p {
    font-size: 15px;
    color: #333;
    margin-bottom: 12px;
    line-height: 1.6;
}

.read-more {
    display: inline-block;
    font-size: 15px;
    font-weight: 600;
    color: #1f6fb2;
    text-decoration: none;
    transition: color 0.3s ease;
}

.read-more:hover {
    color: #2b86d6;
    text-decoration: underline;
}

.news-card:hover .news-content h3 {
    color: #2b86d6;
}
</style>
<?php
include_once(__DIR__.'/../public/footer.php');
?>