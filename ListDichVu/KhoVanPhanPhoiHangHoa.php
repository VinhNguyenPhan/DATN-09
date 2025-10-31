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
                    ông ty Cổ phần Logistics U&I tự hào là đơn vị phát triển dịch vụ Kho vận và Phân phối hàng hóa đáng
                    tin
                    cậy tại Việt Nam nhờ sở hữu hệ thống kho ngoại quan lớn nhất Đông Nam Á với tổng diện tích hơn
                    242.320
                    m² (tương đương 2.609.000 ft²). Hệ thống kho vận và trung tâm phân phối có sức chứa hơn 2.000.000 m²
                    (tương đương 21.527.820 ft²) được đặt tại các khu vực kinh tế trọng điểm trên cả nước.
                </p>
                <p>
                    Hệ thống kho vận U&I Logistics được trang bị cơ sở hạ tầng hiện đại, công nghệ đúng chuẩn C-TPAT của
                    CBP
                    Hoa Kỳ và đạt chứng nhận ISO 9001 như: Phần mềm quản lý kho hiện đại (WMS), hệ thống quản lý hàng
                    hóa
                    bằng mã code, hệ thống hút ẩm tự động kiểm soát độ ẩm và côn trùng, v.v. Nhờ đó, U&I Logistics đã
                    nhận
                    được sự tin cậy từ nhiều đối tác chiến lược uy tín như Saigon Co.op và Trancy Logistics và tự tin
                    cung
                    cấp những giải pháp thiết thực đáp ứng mọi nhu cầu khắt khe của từng khách hàng.
                </p>

                <h3>Các dịch vụ kho vận và phân phối hàng hóa bao gồm:</h3>
                <ul class="service-list">
                    <li>📌 Kho ngoại quan</li>
                    <li>📌 Trung tâm phân phối dược phẩm</li>
                    <li>📌 Trung tâm phân phối hàng hóa tiêu dùng</li>
                    <li>📌 Kho thương mại điện tử</li>
                    <li>📌 Xử lý chứng từ</li>
                    <li>📌 Quản lý hàng tồn kho</li>
                    <li>📌 Quản lý đơn hàng</li>
                    <li>📌 Các dịch vụ gia tăng (đóng hàng vào pallet, đóng gói/đóng gói lại, phân loại hàng hoá, in
                        nhãn/dán nhãn, phân phối, barcode và các giải pháp hỗ trợ, v.v)</li>
                </ul>
            </div>
            <div class="about-right">
                <h2>Đặc điểm nổi bật</h2>
                <div class="highlight-grid">
                    <div class="highlight-card">
                        <h3>Top 1</h3>
                        <p>Kho ngoại quan lớn nhất ĐNA</p>
                    </div>
                    <div class="highlight-card">
                        <h3>2.000.000 m² </h3>
                        <p>diện tích lưu trữ hàng hóa</p>
                    </div>
                    <div class="highlight-card">
                        <h3>465.071 m²</h3>
                        <p>diện tích sàn kho</p>
                    </div>
                    <div class="highlight-card">
                        <h3>2.000+</h3>
                        <p>đơn hàng mỗi ngày</p>
                    </div>
                    <div class="highlight-card">
                        <h3>34.000+</h3>
                        <p>SKUs mỗi ngày</p>
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
<?php include_once(__DIR__ . '/../public/footer.php'); ?>