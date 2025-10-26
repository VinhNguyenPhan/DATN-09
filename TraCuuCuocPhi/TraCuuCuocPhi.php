<?php include_once(__DIR__ . '/../public/header.php'); ?>

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

<style>
/* === KHỐI TRẮNG CHÍNH === */
.main-wrapper {
    background: #ffffff;
    max-width: 100%;
    border-radius: 20px;
    margin: 40px auto;
    padding: 60px 120px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

/* === TIÊU ĐỀ === */
h1 {
    text-align: center;
    font-size: 38px;
    color: #1e3a8a;
    font-weight: 700;
    margin-bottom: 50px;
}

h2 {
    font-size: 28px;
    font-weight: bold;
    color: #1e3a8a;
    margin-bottom: 30px;
    text-align: center;
}

/* === BẢNG GIÁ === */
.pricing-table {
    width: 100%;
    border-collapse: collapse;
    background: #f3f4f6;
    border-radius: 12px;
    overflow: hidden;
    font-size: 18px;
    border: 1px solid #d1d5db;
    margin-bottom: 60px;
}

.pricing-table th {
    background: #1e3a8a;
    color: #fff;
    font-weight: 700;
    text-align: center;
    padding: 20px;
    border: 1px solid #e2e8f0;
}

.pricing-table td {
    text-align: center;
    padding: 18px;
    border: 1px solid #e2e8f0;
    background: #f3f4f6;
    font-size: 16px;
}

/* === TRA CỨU === */
.search-box {
    padding: 60px;
    border-radius: 16px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
    max-width: 1000px;
    margin: 0 auto;
}

.search-box h3 {
    color: #1e3a8a;
    margin-bottom: 30px;
    text-align: center;
    font-size: 24px;
    font-weight: 700;
}

.search-row {
    display: flex;
    gap: 40px;
    justify-content: center;
    flex-wrap: wrap;
}

.form-group {
    display: flex;
    flex-direction: column;
    width: 30%;
    min-width: 240px;
}

label {
    font-weight: 600;
    margin-bottom: 8px;
    font-size: 15px;
    text-align: center;
}

input,
select {
    width: 100%;
    padding: 14px;
    border: 1px solid #cbd5e1;
    border-radius: 12px;
    outline: none;
    font-size: 16px;
    background: #f9fafb;
}

input:focus,
select:focus {
    border-color: #1d4ed8;
    background: #fff;
}

.btn-center {
    text-align: center;
    margin-top: 25px;
}

button {
    background: #1d4ed8;
    color: #fff;
    padding: 14px 50px;
    border: none;
    border-radius: 12px;
    font-size: 18px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: #2563eb;
}

.result {
    margin-top: 25px;
    padding: 18px;
    background: #f3f4f6;
    border-radius: 12px;
    font-size: 16px;
    display: none;
}

/* RESPONSIVE */
@media (max-width: 1024px) {
    .main-wrapper {
        padding: 50px 40px;
    }

    .search-box {
        padding: 40px 30px;
    }

    .form-group {
        width: 45%;
    }
}

@media (max-width: 768px) {
    .main-wrapper {
        padding: 30px 20px;
    }

    .search-box {
        padding: 30px 20px;
    }

    .form-group {
        width: 100%;
    }

    button {
        width: 100%;
        font-size: 16px;
        padding: 12px;
    }
}
</style>

<div class="main-wrapper">
    <h1>Bảng giá & Tra cứu cước phí</h1>
    <section>
        <h2>Bảng giá cước phí vận chuyển</h2>
        <table class="pricing-table">
            <thead>
                <tr>
                    <th>Phương tiện</th>
                    <th>Trong nước (VNĐ/km)</th>
                    <th>Quốc tế (USD/kg)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Xe tải</td>
                    <td>15.000</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Container</td>
                    <td>25.000</td>
                    <td>0.8</td>
                </tr>
                <tr>
                    <td>Máy bay</td>
                    <td>-</td>
                    <td>3.5</td>
                </tr>
                <tr>
                    <td>Tàu hỏa</td>
                    <td>12.000</td>
                    <td>0.6</td>
                </tr>
                <tr>
                    <td>Tàu biển</td>
                    <td>-</td>
                    <td>0.4</td>
                </tr>
            </tbody>
        </table>
    </section>

    <section class="search-box">
        <h3>Tra cứu cước phí</h3>
        <form onsubmit="event.preventDefault(); calculate();">
            <div class="search-row">
                <div class="form-group">
                    <label for="from">Nơi gửi</label>
                    <input type="text" id="from" placeholder="Nhập nơi gửi">
                </div>
                <div class="form-group">
                    <label for="to">Nơi nhận</label>
                    <input type="text" id="to" placeholder="Nhập nơi nhận">
                </div>
                <div class="form-group">
                    <label for="vehicle">Phương tiện</label>
                    <select id="vehicle">
                        <option value="Xe tải">Xe tải</option>
                        <option value="Container">Container</option>
                        <option value="Máy bay">Máy bay</option>
                        <option value="Tàu hỏa">Tàu hỏa</option>
                        <option value="Tàu biển">Tàu biển</option>
                    </select>
                </div>
            </div>
            <div class="btn-center">
                <button type="submit">Tính phí</button>
            </div>
        </form>
        <div id="result" class="result"></div>
    </section>
</div>

<script>
function calculate() {
    const from = document.getElementById('from').value.trim();
    const to = document.getElementById('to').value.trim();
    const vehicle = document.getElementById('vehicle').value;
    const resultBox = document.getElementById('result');

    if (!from || !to) {
        resultBox.innerHTML = "⚠️ Vui lòng nhập đầy đủ nơi gửi và nơi nhận.";
        resultBox.style.display = "block";
        return;
    }

    const fakeDistance = Math.floor(Math.random() * 900) + 100; // 100–1000 km
    const rates = {
        "Xe tải": 15000,
        "Container": 25000,
        "Máy bay": 0,
        "Tàu hỏa": 12000,
        "Tàu biển": 0
    };

    let cost = 0;
    if (rates[vehicle] > 0) {
        cost = fakeDistance * rates[vehicle];
        resultBox.innerHTML = `
            🚚 Khoảng cách ước tính: <b>${fakeDistance} km</b><br>
            Phương tiện: <b>${vehicle}</b><br>
            💰 Cước phí ước tính: <b>${cost.toLocaleString()} VNĐ</b>
        `;
    } else {
        resultBox.innerHTML = `
            🌍 Tuyến quốc tế - Phương tiện <b>${vehicle}</b><br>
            Vui lòng liên hệ để được báo giá chính xác.
        `;
    }

    resultBox.style.display = "block";
}
</script>

<?php include_once(__DIR__ . '/../public/footer.php'); ?>