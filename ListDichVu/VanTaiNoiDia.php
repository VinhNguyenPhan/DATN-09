<?php
include_once(__DIR__ . '/../public/header.php');
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
            title: 'My chat',
            size: {
                width: 350,
                height: 500,
                minWidth: 300,
                minHeight: 300,
                titleHeight: 50
            },
            appearance: {
                border: {
                    shadow: '2px 2px 10px  rgba(0, 0, 0, 0.5)',
                    width: 0,
                    radius: 6
                },
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
                        {
                            fa: 'fas fa-times',
                            name: 'hideButton',
                            visible: true
                        }
                    ],
                    buttonsOnLeft: [
                        {
                            fa: 'fas fa-comment-alt',
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
            <div class="about-left">
                <h2>Giới thiệu về dịch vụ</h2>
                <p>
                    Với hơn 140 xe đầu kéo container được lắp đặt thiết bị giám sát hành trình và hơn 200 rơ mooc hợp
                    chuẩn,
                    U&I Logistics cung cấp giải pháp vận tải đường bộ kết nối các khu vực kinh tế trọng điểm Bắc – Trung
                    –
                    Nam.
                </p>
                <p>
                    Chúng tôi ứng dụng công nghệ vào vận hành giúp xác định chính xác vị trí đầu kéo, rơ mooc, tiết kiệm
                    tối
                    đa thời gian và chi phí vận chuyển cho khách hàng. Nổi bật là hệ thống theo dõi hành trình hàng hóa
                    theo
                    công nghệ GPS, phần mềm quản lý vận tải (TMS) cùng app mobile dành cho tài xế. Nhờ đó, chúng tôi đã
                    vận
                    tải thành công 20.000 TEUs/tháng.

                <h3>Các dịch vụ vận tải hàng hóa nội địa gồm: </h3>
                <ul class="service-list">
                    <li>📌 Vận chuyển đường bộ bằng container</li>
                    <li>📌 Vận chuyển đường sắt</li>
                    <li>📌 Vận chuyển đường thủy nội địa</li>
                    <li>📌 Vận chuyển đường biển ven bờ</li>
                </ul>
            </div>
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
    .about-wrapper {
        background: transparent;
        padding: 40px 0;
    }

    .about-section {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 60px;
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
<?php include_once(__DIR__ . '/../public/footer.php'); ?>