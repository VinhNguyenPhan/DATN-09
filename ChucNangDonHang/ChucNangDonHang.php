<?php include_once(__DIR__.'/../public/header.php'); ?>
<?php 
require_once(__DIR__."/../core/database.php");

// --- BẢO VỆ ĐĂNG NHẬP ---
if (empty($_SESSION['user_id'])) {
    $redirect = '/DangNhap-DangKyTK/DangNhapDangKyTK.php?next=' . urlencode($_SERVER['REQUEST_URI']);
    header("Location: $redirect");
    exit;
}

// --- TRA CỨU ĐƠN HÀNG ---
if (!empty($_GET["tracking"])) {
    $loai = $_GET["lua_chon"] ?? 'to1XK';
    $id = (int) ($_GET["tracking"] ?? 0);
    $sql = "SELECT * FROM `{$loai}` WHERE SVD = '{$id}' or id = '{$id}' ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    $vitriID = $data['vi_tri']??'1';
    $sql = "SELECT * FROM `vi_tri` WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $vitriID);
    $stmt->execute();
    $result = $stmt->get_result();
    $dVi_tri = $result->fetch_assoc();
    ?>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
let currentData = null;

// --- GIẢ LẬP API ---
function mockApi(trackingNumber) {
    return {
        tracking_number: trackingNumber,
        current_status: "Đang vận chuyển",
        last_location: '<?= isset($dVi_tri['name']) ? $dVi_tri['name'] : "kho 1" ?>',
        lat: <?= isset($dVi_tri['X']) ? floatval($dVi_tri['X']) : 21.0278 ?>,
        lng: <?= isset($dVi_tri['Y']) ? floatval($dVi_tri['Y']) : 105.8342 ?>,
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
            <div class="result animate">
              <div class="status">🚚 <b>Trạng thái hiện tại:</b> ${data.current_status}</div>
              <div>📍 <b>Vị trí cuối:</b> ${data.last_location}</div>
              <div>⏰ <b>Cập nhật:</b> ${new Date(data.updated_at).toLocaleString()}</div>
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

window.onload = function() {
    currentData = mockApi(<?= $id ?>);
    renderOutput(currentData);
};
</script>
<?php } ?>
<!doctype html>
<html lang="vi">


<style>
h1 {
    text-align: center;
    font-size: 32px;
    margin: 40px 0 24px;
    color: #1f6fb2;
    font-weight: 800;
}

main {
    padding: 40px 20px;
    max-width: 1100px;
    margin: auto;
}

.form-row {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
    margin-bottom: 25px;
}

.form-row select,
.form-row input {
    padding: 14px 16px;
    font-size: 16px;
    border-radius: 10px;
    border: 1px solid #cbd5e1;
    outline: none;
    transition: 0.2s;
}

.form-row select {
    width: 220px;
    min-width: 180px;
}

.form-row input {
    flex: 1;
    min-width: 350px;
}

.form-row select:focus,
.form-row input:focus {
    border-color: #1f6fb2;
    box-shadow: 0 0 0 3px rgba(31, 111, 178, 0.15);
}

.button-row {
    display: flex;
    justify-content: center;
}

.button-row button {
    background: #1f6fb2;
    color: #fff;
    padding: 14px 32px;
    border: none;
    border-radius: 10px;
    font-size: 18px;
    cursor: pointer;
    font-weight: 600;
    transition: background 0.25s ease, transform 0.1s ease;
}

.button-row button:hover {
    background: #155c92;
    transform: scale(1.05);
}
</style>

<body>

    <main>
        <form method="GET" action="">
            <div class="form-row">
                <select name="lua_chon" required>
                    <option value="to1XK">Tờ khai xuất khẩu</option>
                    <option value="to1NK">Tờ khai nhập khẩu</option>
                </select>

                <input type="number" name="tracking" id="tracking" placeholder="Nhập số vận đơn..." required />

                <select id="filter" name="filter">
                    <option value="all">Tất cả</option>
                    <option value="Đơn đã gửi">Đơn đã gửi</option>
                    <option value="Đang vận chuyển">Đang vận chuyển</option>
                    <option value="Đơn đã giao thành công">Đơn đã giao thành công</option>
                    <option value="Đơn hoàn hàng">Đơn hoàn hàng</option>
                </select>
            </div>

            <div class="button-row">
                <button type="submit">🔍 Tra cứu</button>
            </div>
        </form>
        <div id="output"></div>
    </main>
</body>

</html>
<?php include_once(__DIR__.'/../public/footer.php'); ?>