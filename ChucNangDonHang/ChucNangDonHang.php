<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Demo Xem vị trí & trạng thái đơn hàng</title>
    <style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        margin: 0;
        background: #f7f9fc;
        color: #0f172a
    }

    header {
        padding: 16px 24px;
        background: #1f6fb2;
        color: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center
    }

    h1 {
        margin: 0;
        font-size: 20px
    }

    main {
        padding: 24px;
        max-width: 900px;
        margin: auto
    }

    .form {
        display: flex;
        gap: 12px;
        margin-bottom: 16px
    }

    input,
    select {
        padding: 10px 12px;
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        font-size: 15px
    }

    input {
        flex: 1
    }

    button {
        background: #1f6fb2;
        color: #fff;
        padding: 10px 16px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600
    }

    .result {
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06)
    }

    .status {
        margin-bottom: 12px;
        font-weight: 600
    }

    #map {
        width: 100%;
        height: 300px;
        border-radius: 12px;
        overflow: hidden;
        margin-top: 16px
    }

    ul.timeline {
        list-style: none;
        padding-left: 0;
        margin-top: 16px
    }

    ul.timeline li {
        margin-bottom: 10px;
        padding-left: 22px;
        position: relative
    }

    ul.timeline li::before {
        content: "";
        position: absolute;
        left: 0;
        top: 6px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #1f6fb2
    }

    .delivered::before {
        background: green
    }

    .return::before {
        background: red
    }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
</head>

<body>
    <header>
        <h1>Tra cứu đơn hàng</h1>
        <nav><a href="../index.php">Trang chủ</a> Tờ khai Tra cứu</nav>
    </header>
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
            lat: 20.0278,
            lng: 165.8342,
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