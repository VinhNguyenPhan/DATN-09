<?php
include_once(__DIR__.'/../public/header.php');
?>
<script>
const chatux = new ChatUx();

const opt = {
    api: {
        endpoint: 'http://localhost/chat/chat-server.php',
        method: 'GET',
        dataType: 'jsonp',
        escapeUserInput: true
    },
    window: {
        title: 'My chat', //window title 
        size: {
            width: 350, //window width in px
            height: 500, //window height in px
            minWidth: 300, //window minimum-width in px
            minHeight: 300, //window minimum-height in px
            titleHeight: 50 //title bar height in px
        },
        appearance: {
            //border - border style of the window
            border: {
                shadow: '2px 2px 10px  rgba(0, 0, 0, 0.5)',
                width: 0,
                radius: 6
            },
            //titleBar - title style of the window
            titleBar: {
                fontSize: 14,
                color: 'white',
                background: '#4784d4',
                leftMargin: 40,
                height: 40,
                buttonWidth: 36,
                buttonHeight: 16,
                buttonColor: 'white',
                buttons: [
                    //Icon named 'hideButton' to close chat window
                    {
                        fa: 'fas fa-times', //specify font awesome icon
                        name: 'hideButton',
                        visible: true
                    }
                ],
                buttonsOnLeft: [
                    //Icon named 'info' to jump to 'infourl' when clicked
                    {
                        fa: 'fas fa-comment-alt', //specify font awesome icon
                        name: 'info',
                        visible: true
                    }
                ],
            },
        }
    },
};

chatux.init(opt);
chatux.start(true);
</script>

<section class="about-wrapper">
    <div class="about-section">
        <div class="container">
            <!-- Cột trái -->
            <div class="about-left" style="padding-top:25px">
                <h1>Về chúng tôi</h1>
                <h2>Chào mừng đến với U&I LOGISTICS Miền Bắc</h2>
                <p>
                    Công ty Cổ phần Đầu tư U&I (U&I Investment Corporation) là tên gọi của công ty mẹ bao gồm nhiều công
                    ty
                    thành viên và liên doanh hoạt động trong nhiều lĩnh vực khác nhau như Logistics, bất động sản và xây
                    dựng, dịch vụ tài chính, kế toán kiểm toán, bán lẻ, nông nghiệp và sản xuất hàng xuất khẩu. U&I là
                    từ viết tắt
                    của cụm từ Bạn và Tôi trong tiếng Anh (You and I).
                </p>
                <p>
                    U&I Logistics là một thành viên đứng đầu trong lĩnh vực logistics thuộc Unigroup. Được điều hành bởi
                    những doanh nhân Việt Nam giàu kinh nghiệm, chúng tôi luôn tự hào là một trong những công ty hàng
                    đầu
                    tại Việt Nam chuyên cung cấp các dịch vụ đại lý khai thuê hải quan, giao nhận hàng hóa xuất nhập
                    khẩu,
                    kho hàng hóa, vận tải nội địa bằng đường bộ, đường thủy nội địa, ven biển và đường sắt. Chúng tôi
                    hiểu
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

        <!-- Phần TẦM NHÌN – CAM KẾT – BHAG -->
        <div class="core-container">
            <div class="core-card">
                <h2>Tầm nhìn, sứ mệnh và giá trị cốt lõi</h2>
                <p><strong>Tầm nhìn:</strong> Trở thành nhà cung cấp các dịch vụ logistics hiệu quả nhất tại Việt Nam.
                </p>
                <p><strong>Sứ mệnh:</strong> Cung cấp các giải pháp logistics đáp ứng đúng nhu cầu của từng khách hàng.
                </p>
                <p><strong>Giá trị cốt lõi:</strong></p>
                <ul>
                    <li><strong>Trung thực:</strong> Là phẩm chất cần có đầu tiên đối với người lao động U&I Logistics.
                    </li>
                    <li><strong>Kỷ luật:</strong> Giá trị cốt lõi vượt trội là kỷ luật.</li>
                    <li><strong>Uy tín:</strong> Chữ tín quý hơn vàng.</li>
                </ul>
            </div>

            <div class="core-card">
                <h2>Các cam kết</h2>
                <p><strong>Với người lao động:</strong> Môi trường làm việc cạnh tranh, tôn trọng và có cơ hội khẳng
                    định
                    mình.</p>
                <p><strong>Với khách hàng:</strong> Vì quyền lợi của khách hàng trước tiên.</p>
                <p><strong>Với cổ đông:</strong> Trung thực và minh bạch.</p>
                <p><strong>Với xã hội:</strong> Tôn trọng lợi ích chung.</p>
            </div>

            <div class="core-card">
                <h2>BHAG</h2>
                <p>Là hạt nhân kết nối tạo thành mạng lưới logistics lớn nhất Việt Nam trước năm 2025.</p>
            </div>
        </div>
    </div>
</section>

<!-- CSS đồng bộ, bố cục cân đối -->
<style>
.about-wrapper {
    background: transparent;
    /* Xoá nền xám */
    padding-top: 0;
    /* Sát header */
    padding-bottom: 40px;
    /* Giữ khoảng cách phía dưới */
}


.about-section {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 60px;
    font-family: "Inter", sans-serif;
}

/* --- Layout chính --- */
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

.about-left h1 {
    font-size: 32px;
    font-weight: 800;
    color: #1f3c88;
    margin-bottom: 10px;
}

.about-left h2 {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 16px;
    color: #1f3c88;
}

.about-left p {
    line-height: 1.7;
    margin-bottom: 16px;
    color: #333;
}

/* --- Cột phải --- */
.about-right {
    flex: 1;
    max-width: 35%;
}

.about-right h2 {
    font-size: 22px;
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

/* --- CORE SECTION --- */
.core-container {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 24px;
    margin-top: 50px;
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

/* --- Responsive --- */
@media (max-width: 1024px) {
    .container {
        flex-direction: column;
    }

    .about-right {
        max-width: 100%;
    }

    .core-container {
        flex-direction: column;
    }

    .about-section {
        padding: 30px 25px;
    }
}
</style>

<?php include_once(__DIR__.'/../public/footer.php'); ?>