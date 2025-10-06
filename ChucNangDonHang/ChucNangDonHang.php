<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Tra cứu đơn hàng | U&I Logistics</title>
    <style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        margin: 0;
        background: #f7f9fc;
        color: #0f172a;
    }

    /* ===== HEADER CHỨA LOGO ===== */
    header {
        background: #ffffff;
        padding: 12px 32px;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    /* ===== LOGO ===== */
    .brand {
        display: flex;
        align-items: center;
        gap: 14px;
        text-decoration: none;
    }

    .logo-box {
        width: 60px;
        height: 60px;
        background: #1f6fb2;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-weight: 800;
        font-size: 22px;
        letter-spacing: 0.5px;
        text-decoration: none;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        transition: transform 0.25s ease;
    }

    .logo-box:hover {
        transform: scale(1.05);
    }

    .brand-text {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .brand-text .title {
        font-weight: 800;
        font-size: 20px;
        color: #000000;
        letter-spacing: 0.4px;
    }

    .brand-text .sub {
        font-size: 13px;
        color: #6b7280;
        margin-top: 2px;
    }

    /* ===== TIÊU ĐỀ TRANG ===== */
    h1 {
        text-align: center;
        font-size: 24px;
        margin: 30px 0;
        color: #1f6fb2;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    main {
        padding: 24px;
        max-width: 900px;
        margin: auto;
    }

    .form {
        display: flex;
        gap: 12px;
        margin-bottom: 16px;
    }

    input,
    select {
        padding: 10px 12px;
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        font-size: 15px;
    }

    input {
        flex: 1;
    }

    button {
        background: #1f6fb2;
        color: #fff;
        padding: 10px 16px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
    }

    button:hover {
        background: #145a8d;
    }

    .result {
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
    }

    .status {
        margin-bottom: 12px;
        font-weight: 600;
    }

    #map {
        width: 100%;
        height: 300px;
        border-radius: 12px;
        overflow: hidden;
        margin-top: 16px;
    }

    ul.timeline {
        list-style: none;
        padding-left: 0;
        margin-top: 16px;
    }

    ul.timeline li {
        margin-bottom: 10px;
        padding-left: 22px;
        position: relative;
    }

    ul.timeline li::before {
        content: "";
        position: absolute;
        left: 0;
        top: 6px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #1f6fb2;
    }

    .delivered::before {
        background: green;
    }

    .return::before {
        background: red;
    }

    a {
        text-decoration: none;
    }
    </style>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
</head>

<body>
    <!-- HEADER + LOGO -->
    <header>
        <a href="../index.php" class="brand">
            <div class="logo-box">U&amp;I</div>
            <div class="brand-text">
                <div class="title">U&amp;I LOGISTICS</div>
                <div class="sub">Khai báo &amp; Giải pháp vận tải</div>
            </div>
        </a>
    </header>

    <h1>Tra cứu đơn hàng</h1>

    <main>
        <div class="form">
            <input id="tracking" placeholder="Nhập số vận đơn..." />
            <button onclick="track()">Tra cứu</button>
        </div>

        <div class="form">
            <label for="filter">Lọc theo trạng thái:</label>
            <select id="filter" onchange="applyFilter()">
                <option value="all">Tất cả</option>
                <option value="Đơn đã gửi">Đơn đã gửi</option>
                <option value="Đang vận chuyển">Đang vận chuyển</option>
                <option value="Đơn đã giao thành công">Đơn đã giao thành công</option>
                <option value="Đơn hoàn hàng">Đơn hoàn hàng</option>
            </select>
        </div>

        <div id="output"></div>
    </main>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
    let currentData = null;

    function mockApi(trackingNumber) {
        return {
            tracking_number: trackingNumber,
            current_status: "Đang vận chuyển",
            last_location: "Kho trung chuyển Hà Nội",
            lat: 21.0278,
            lng: 105.8342,
            updated_at: new Date().toISOString(),
            history: [{
                    status: "Đơn đã gửi",
                    time: "2025-09-25 08:00"
                },
                {
                    status: "Đang vận chuyển",
                    time: "2025-09-25 15:00"
                },
                {
                    status: "Đơn đã giao thành công",
                    time: "2025-09-26 09:30"
                },
                {
                    status: "Đơn hoàn hàng",
                    time: "2025-09-26 10:00"
                }
            ]
        };
    }

    function track() {
        const code = document.getElementById('tracking').value;
        if (!code) {
            alert("Vui lòng nhập số vận đơn");
            return;
        }
        currentData = mockApi(code);
        renderOutput(currentData);
    }

    function applyFilter() {
        if (!currentData) return;
        renderOutput(currentData);
    }

    function renderOutput(data) {
        const filter = document.getElementById('filter').value;
        const output = document.getElementById('output');
        let historyHtml = '<ul class="timeline">';

        data.history
            .filter(item => filter === 'all' || item.status === filter)
            .forEach(item => {
                let cls = '';
                if (item.status.includes("thành công")) cls = 'delivered';
                if (item.status.includes("hoàn")) cls = 'return';
                historyHtml += `<li class="${cls}"><b>${item.status}</b> - ${item.time}</li>`;
            });

        historyHtml += '</ul>';

        output.innerHTML = `
        <div class="result">
          <div class="status">Trạng thái hiện tại: ${data.current_status}</div>
          <div>Vị trí cuối: ${data.last_location}</div>
          <div>Cập nhật: ${new Date(data.updated_at).toLocaleString()}</div>
          <div id="map"></div>
          <h3>Lịch sử đơn hàng</h3>
          ${historyHtml}
        </div>`;

        const map = L.map('map').setView([data.lat, data.lng], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19
        }).addTo(map);
        L.marker([data.lat, data.lng]).addTo(map)
            .bindPopup(`<b>${data.last_location}</b><br/>${data.current_status}`)
            .openPopup();
    }
    </script>
</body>

</html>