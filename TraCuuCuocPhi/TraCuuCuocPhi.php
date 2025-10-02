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

    header {
        background: #ffffff;
        padding: 20px 50px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #e2e8f0;
    }

    header h1 {
        font-size: 20px;
        color: #1e3a8a;
        font-weight: bold;
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

    /* Bảng giá */
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

    /* Form tra cứu */
    .search-box {
        background: #fff;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .search-box h3 {
        color: #1e3a8a;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 6px;
        font-weight: 500;
    }

    input,
    select {
        width: 100%;
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

    button {
        background: #1d4ed8;
        color: #fff;
        padding: 12px 24px;
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
    <header>
        <h1>U&I LOGISTICS</h1>
        <nav>
            <a href="#">Trang chủ</a> |
            <a href="#">Dịch vụ</a> |
            <a href="#">Hỗ trợ</a>
        </nav>
    </header>

    <div class="container">
        <!-- Bảng giá -->
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

        <!-- Form tra cứu -->
        <div class="search-box">
            <h3>Tra cứu cước phí</h3>
            <div class="form-group">
                <label>Nơi gửi</label>
                <input type="text" id="from" placeholder="Nhập nơi gửi">
            </div>
            <div class="form-group">
                <label>Nơi nhận</label>
                <input type="text" id="to" placeholder="Nhập nơi nhận">
            </div>
            <div class="form-group">
                <label>Phương tiện</label>
                <select id="vehicle">
                    <option value="xe tải">Xe tải</option>
                    <option value="container">Container</option>
                    <option value="máy bay">Máy bay</option>
                    <option value="tàu hỏa">Tàu hỏa</option>
                    <option value="tàu biển">Tàu biển</option>
                </select>
            </div>
            <button onclick="calculate()">Tính phí</button>

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