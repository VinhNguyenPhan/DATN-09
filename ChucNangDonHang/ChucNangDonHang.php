<?php include_once(__DIR__.'/../public/header.php'); ?>
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
    display: block;
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



/* --- Bản đồ --- */
#map {
    width: 100%;
    height: 420px;
    border-radius: 12px;
    margin-top: 20px;
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
    margin-bottom: 120px;
    z-index: 0;
}

/* --- Timeline --- */
.timeline {
    list-style: none;
    padding-left: 15px;
    border-left: 3px solid #1f6fb2;
    margin-top: 15px;
}

.timeline li {
    margin-bottom: 10px;
    padding-left: 10px;
    position: relative;
}

.timeline li::before {
    content: "●";
    color: #1f6fb2;
    position: absolute;
    left: -12px;
}

.timeline li.delivered::before {
    color: #16a34a;
}

.timeline li.return::before {
    color: #dc2626;
}

.result {
    margin-top: 40px;
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
}

.result h3 {
    margin-top: 25px;
    color: #1f6fb2;
}
</style>
<?php 
require_role(['admin','customer','accounting','employee','shipper']);

// --- KIỂM TRA ĐĂNG NHẬP ---
if (empty($_SESSION['user_id'])) {
    $redirect = '/DangNhap-DangKyTK/DangNhapDangKyTK.php?next=' . urlencode($_SERVER['REQUEST_URI']);
    header("Location: $redirect");
    exit;
}

$trackingOutput = '';
if (!empty($_GET["tracking"])) {
    $loai = $_GET["lua_chon"] ?? 'to1XK';
    $id = (int) ($_GET["tracking"] ?? 0);
    $namefilter = ($_GET["filter"] ?? 'shipping');

    $where = '';
    if(!empty($namefilter)){
        $where .= " AND `ThongKe`='{$namefilter}'";
    }

    // Lấy dữ liệu tờ khai
    $sql = "SELECT * FROM `{$loai}` WHERE (SVD = ? OR id = ?) $where";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id, $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if (!$data) {
        $trackingOutput = "
            <div class='result animate'>
                <div class='status' style='color:red'>❌ <b>Không tìm thấy đơn hàng với mã:</b> $id</div>
                <div>📦 Vui lòng kiểm tra lại mã vận đơn hoặc lựa chọn đúng loại tờ khai.</div>
            </div>
        ";
    } else {
        // Lấy dữ liệu vị trí
        $vitriID = (int)($data['vi_tri'] ?? 0);
        $sql = "SELECT * FROM `vi_tri` WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $vitriID);
        $stmt->execute();
        $result = $stmt->get_result();
        $dVi_tri = $result->fetch_assoc();

        if (!$dVi_tri) {
            $trackingOutput = "
                <div class='result animate'>
                    <div class='status' style='color:red'>❌ <b>Không tìm thấy vị trí kho cho đơn hàng này.</b></div>
                    <div>📦 Vui lòng liên hệ bộ phận hỗ trợ để kiểm tra lại thông tin đơn hàng.</div>
                </div>
            ";
        } else {
            $statusLabels = [
    'done' => 'Hoàn thành',
    'cancel' => 'Đã hủy',
    'shipping' => 'Đang vận chuyển',
    'shipped' => 'Đã giao hàng'
];

$displayStatus = $statusLabels[$data['ThongKe']] ?? $data['ThongKe'];
            ?>
<script>
let currentData = {
    tracking_number: <?=$id?>,
    current_status: "<?=htmlspecialchars($displayStatus ?? 'Đang xử lý')?>",
    last_location: "<?=htmlspecialchars($dVi_tri['name'])?>",
    lat: <?=floatval($dVi_tri['X'])?>,
    lng: <?=floatval($dVi_tri['Y'])?>,
    updated_at: "<?=date('Y-m-d H:i:s')?>"
};

function applyFilter() {
    if (!currentData) return;
    renderOutput(currentData);
}

function renderOutput(data) {
    const output = document.getElementById('output');
    output.innerHTML = `
                        <div class='result animate'>
                            <div class='status'>🚚 <b>Trạng thái hiện tại:</b> ${data.current_status}</div>
                            <div>📍 <b>Vị trí cuối:</b> ${data.last_location}</div>
                            <div>⏰ <b>Cập nhật:</b> ${new Date(data.updated_at).toLocaleString()}</div>
                            <div id='map'></div>
                        </div>
                    `;
    const map = L.map('map').setView([data.lat, data.lng], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);
    L.marker([data.lat, data.lng]).addTo(map)
        .bindPopup(`<b>${data.last_location}</b><br/>${data.current_status}`)
        .openPopup();
}

window.onload = function() {
    renderOutput(currentData);
};
</script>
<?php
}
}
}
?>

<!-- CSS & JS của Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<!-- Giao diện -->
<h1>Tra cứu tờ khai</h1>
<form method="GET" action="">
    <div class="form-row">
        <select name="lua_chon" required>
            <option value="to1XK">Tờ khai xuất khẩu</option>
            <option value="to1NK">Tờ khai nhập khẩu</option>
        </select>

        <input type="number" name="tracking" id="tracking" placeholder="Nhập số vận đơn..." required />

        <select id="filter" name="filter" onchange="applyFilter()">
            <option value="">Tất cả</option>
            <option value="shipped">Đơn đã gửi</option>
            <option value="shipping">Đang vận chuyển</option>
            <option value="done">Đơn đã giao thành công</option>
            <option value="cancel">Đơn hoàn hàng</option>
        </select>
    </div>

    <div class="button-row">
        <button type="submit">🔍 Tra cứu</button>
    </div>
</form>

<div id="output"><?= $trackingOutput ?></div>

<?php include_once(__DIR__.'/../public/footer.php'); ?>