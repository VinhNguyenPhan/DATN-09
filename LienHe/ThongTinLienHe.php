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

<!DOCTYPE html>
<html lang="en">

<style>
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
<?php
include_once(__DIR__.'/../public/footer.php');
?>