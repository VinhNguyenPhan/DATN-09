<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Theo dõi công nợ & Thanh toán online</title>
    <style>
    body {
        font-family: "Inter", sans-serif;
        background: #ffffff;
        margin: 0;
        padding: 0;
    }

    /* ===== PHẦN LOGO ===== */
    .header {
        display: flex;
        align-items: center;
        padding: 20px 40px;
        background-color: #fff;
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
    }

    .logo-text {
        font-weight: 800;
        font-size: 20px;
        color: #fff;
    }

    .brand-info {
        display: flex;
        flex-direction: column;
        line-height: 1.1;
    }

    .brand-info .title {
        font-size: 20px;
        font-weight: 800;
        color: #000;
        letter-spacing: 0.5px;
    }

    .brand-info .sub {
        font-size: 13px;
        color: #555;
        font-weight: 400;
    }

    /* ===== TIÊU ĐỀ TRANG ===== */
    .page-title {
        text-align: center;
        font-size: 22px;
        font-weight: 700;
        color: #000;
        margin: 10px 0 25px;
    }

    /* ===== CARD CHỨC NĂNG ===== */
    .container {
        display: flex;
        justify-content: center;
        padding: 20px;
    }

    .card {
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        text-align: center;
        max-width: 480px;
        width: 100%;
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: scale(1.02);
    }

    .card .icon {
        font-size: 36px;
        margin-bottom: 10px;
    }

    .card h3 {
        font-size: 18px;
        margin-bottom: 8px;
        color: #1f3c88;
    }

    .card p {
        font-size: 14px;
        color: #555;
        margin-bottom: 14px;
    }

    .card .btn {
        background: #1f6fb2;
        color: #fff;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .card .btn:hover {
        background: #155b8a;
    }

    /* ===== MODAL ===== */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
    }

    .modal-content {
        background: #fff;
        margin: 8% auto;
        padding: 24px;
        border-radius: 12px;
        width: 80%;
        max-width: 800px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .close {
        float: right;
        font-size: 26px;
        font-weight: bold;
        cursor: pointer;
        color: #666;
    }

    .close:hover {
        color: #000;
    }

    /* ===== BẢNG CÔNG NỢ ===== */
    .debt-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .debt-table th,
    .debt-table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }

    .debt-table th {
        background: #1f6fb2;
        color: #fff;
    }

    .pay-btn {
        background: #10b981;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 6px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .pay-btn:hover {
        background: #0d946b;
    }

    .pay-btn.disabled {
        background: gray;
        cursor: not-allowed;
    }
    </style>
</head>

<body>
    <!-- PHẦN LOGO -->
    <header class="header">
        <a href="../index.php" class="brand">
            <div class="logo-box">
                <span class="logo-text">U&I</span>
            </div>
            <div class="brand-info">
                <span class="title">LOGISTICS</span>
                <span class="sub">Khai báo và giải pháp vận tải</span>
            </div>
        </a>
    </header>

    <!-- TIÊU ĐỀ TRANG -->
    <div class="page-title">Theo dõi công nợ & Thanh toán online</div>

    <!-- CARD CHỨC NĂNG -->
    <div class="container">
        <div class="card">
            <div class="icon">💳</div>
            <h3>Theo dõi công nợ & Thanh toán online</h3>
            <p>Xem công nợ còn lại, lịch sử thanh toán và thực hiện thanh toán trực tuyến an toàn.</p>
            <button class="btn" onclick="openDebtModal()">Xem chi tiết</button>
        </div>
    </div>

    <!-- MODAL HIỂN THỊ CÔNG NỢ -->
    <div id="debtModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeDebtModal()">&times;</span>
            <h2>Công nợ & Thanh toán online</h2>

            <table class="debt-table">
                <thead>
                    <tr>
                        <th>Mã hóa đơn</th>
                        <th>Ngày lập</th>
                        <th>Số tiền</th>
                        <th>Trạng thái</th>
                        <th>Hạn thanh toán</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>HD001</td>
                        <td>01/10/2025</td>
                        <td>5.000.000 đ</td>
                        <td>Chưa thanh toán</td>
                        <td>10/10/2025</td>
                        <td><button class="pay-btn">Thanh toán</button></td>
                    </tr>
                    <tr>
                        <td>HD002</td>
                        <td>15/09/2025</td>
                        <td>3.200.000 đ</td>
                        <td>Đã thanh toán</td>
                        <td>20/09/2025</td>
                        <td><button class="pay-btn disabled">Đã thanh toán</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- SCRIPT -->
    <script>
    function openDebtModal() {
        document.getElementById("debtModal").style.display = "block";
    }

    function closeDebtModal() {
        document.getElementById("debtModal").style.display = "none";
    }
    </script>
</body>

</html>