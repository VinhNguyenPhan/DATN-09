<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Bảng giá & Tra cứu cước phí</title>
    <style>
    body {
        font-family: 'Segoe UI', Arial, sans-serif;
        background: #f8fafc;
        margin: 0;
        padding: 0;
        color: #1e293b;
    }

    /* ===== HEADER ===== */
    header {
        background: #ffffff;
        display: flex;
        align-items: center;
        padding: 22px 40px;
        border-bottom: 1px solid #e2e8f0;
    }

    .brand {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
    }

    .logo-box {
        width: 55px;
        height: 55px;
        border-radius: 12px;
        background-color: #1f6fb2;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .logo-text {
        font-family: "Inter", sans-serif;
        font-weight: 800;
        font-size: 20px;
        color: #fff;
        letter-spacing: 0.5px;
    }

    .brand-text {
        display: flex;
        flex-direction: column;
        line-height: 1;
    }

    .brand-text .title {
        font-family: "Inter", sans-serif;
        font-size: 18px;
        font-weight: 800;
        color: #000;
        letter-spacing: 0.8px;
    }

    .brand-text .sub {
        font-family: "Inter", sans-serif;
        font-size: 13px;
        color: #6b7280;
        margin-top: 4px;
        font-weight: 400;
    }

    .brand:visited,
    .brand:active,
    .brand:focus {
        text-decoration: none;
        outline: none;
    }

    h1 {
        text-align: center;
        font-size: 22px;
        color: #1e3a8a;
        font-weight: bold;
        margin: 28px 0;
    }

    .container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 20px;
    }

    h2 {
        font-size: 24px;
        font-weight: bold;
        color: #1e3a8a;
        margin-bottom: 20px;
    }

    .pricing-table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        margin-bottom: 40px;
    }

    .pricing-table th,
    .pricing-table td {
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid #e2e8f0;
    }

    .pricing-table th {
        background: #f1f5f9;
        color: #1e3a8a;
        font-weight: bold;
    }

    .pricing-table tr:last-child td {
        border-bottom: none;
    }

    /* ===== TRA CỨU ===== */
    .search-box {
        background: #fff;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .search-box h3 {
        color: #1e3a8a;
        margin-bottom: 20px;
        text-align: center;
    }

    .search-row {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        width: 30%;
        min-width: 220px;
    }

    label {
        font-weight: 500;
        margin-bottom: 6px;
    }

    input,
    select {
        width: 90%;
        padding: 12px;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        outline: none;
        font-size: 14px;
    }

    input:focus,
    select:focus {
        border-color: #1d4ed8;
    }

    .btn-center {
        text-align: center;
        margin-top: 20px;
    }

    button {
        background: #1d4ed8;
        color: #fff;
        padding: 12px 40px;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        cursor: pointer;
        transition: 0.2s;
    }

    button:hover {
        background: #2563eb;
    }

    .result {
        margin-top: 20px;
        padding: 15px;
        background: #f1f5f9;
        border-radius: 10px;
        display: none;
    }
    </style>
</head>

<body>
    <!-- HEADER -->
    <header>
        <a href="../index.php" class="brand">
            <div class="logo-box">
                <span class="logo-text">U&amp;I</span>
            </div>
            <div class="brand-text">
                <span class="title">LOGISTICS</span>
                <span class="sub">Khai báo và giải pháp vận tải</span>
            </div>
        </a>
    </header>

    <h1>Bảng giá & Tra cứu cước phí</h1>

    <div class="container">
        <!-- BẢNG GIÁ -->
        <h2>Bảng giá cước phí vận chuyển</h2>
        <table class="pricing-table">
            <tr>
                <th>Phương tiện</th>
                <th>Trong nước (VNĐ/km)</th>
                <th>Quốc tế (USD/kg)</th>
            </tr>
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
        </table>

        <!-- TRA CỨU -->
        <div class="search-box">
            <h3>Tra cứu cước phí</h3>
            <div class="search-row">
                <div class="form-group">
                    <label for="from" style="padding-left:130px">Nơi gửi</label>
                    <input type="text" id="from" placeholder="Nhập nơi gửi">
                </div>

                <div class="form-group">
                    <label for="to" style="padding-left:130px">Nơi nhận</label>
                    <input type="text" id="to" placeholder="Nhập nơi nhận">
                </div>

                <div class="form-group">
                    <label for="vehicle" style="padding-left:110px">Phương tiện</label>
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
                <button onclick="calculate()">Tính phí</button>
            </div>

            <div class="result" id="result"></div>
        </div>
    </div>

    <script>
    function calculate() {
        const from = document.getElementById('from').value;
        const to = document.getElementById('to').value;
        const vehicle = document.getElementById('vehicle').value;
        const resultBox = document.getElementById('result');

        if (!from || !to) {
            resultBox.innerHTML = "Vui lòng nhập đầy đủ nơi gửi và nơi nhận!";
        } else {
            resultBox.innerHTML =
                `Cước phí ước tính từ <b>${from}</b> đến <b>${to}</b> bằng phương tiện <b>${vehicle}</b> sẽ được báo giá cụ thể khi xác nhận đơn hàng.`;
        }

        resultBox.style.display = "block";
    }
    </script>
</body>

</html>