<?php include_once(__DIR__ . '/../public/header.php'); ?>
<style>
    :root {
        --primary: #1f6fb2;
        --primary-dark: #155c92;
        --bg: #f8fafc;
        --card: #ffffff;
        --border: #e5e7eb;
        --text: #0b1220;
        --muted: #475569;
        --radius: 14px;
        --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    body {
        background: var(--bg);
    }

    h1 {
        text-align: center;
        font-size: 36px;
        margin: 40px 0 24px;
        color: var(--primary);
        font-weight: 800;
    }

    main {
        max-width: 1000px;
        margin: auto;
        padding: 20px;
    }

    .card {
        background: var(--card);
        padding: 30px;
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
        animation: fadeIn .35s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 25px;
    }

    label {
        font-weight: 600;
        color: var(--muted);
        margin-bottom: 6px;
        display: block;
    }

    select,
    input {
        width: 100%;
        padding: 14px 16px;
        font-size: 16px;
        border-radius: var(--radius);
        border: 1px solid var(--border);
        outline: none;
        transition: .25s;
        background: #fff;
    }

    select:focus,
    input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(31, 111, 178, 0.15);
    }

    .button-row {
        display: flex;
        justify-content: center;
        margin-top: 10px;
    }

    button {
        background: var(--primary);
        color: #fff;
        padding: 14px 36px;
        font-size: 18px;
        border: none;
        border-radius: var(--radius);
        cursor: pointer;
        font-weight: 700;
        transition: .25s;
    }

    button:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
    }

    .result {
        margin-top: 35px;
        padding: 30px;
        background: var(--card);
        border-radius: var(--radius);
        border: 1px solid var(--border);
        box-shadow: var(--shadow);
    }

    .value-box {
        padding: 16px;
        background: #f1f5f9;
        border-radius: var(--radius);
        font-size: 22px;
        font-weight: 700;
        text-align: center;
    }

    main {
        display: block;
    }
</style>

<?php
require_once(__DIR__ . '/../core/database.php');
require_role(['admin', 'employee', 'accounting']);

$orders = [];
$type = $_POST['loai_don'] ?? '';
$q = null;

// ===============================
// LẤY DANH SÁCH ĐƠN THEO LOẠI XUẤT / NHẬP KHẨU
// ===============================

// Trường hợp xuất khẩu
if ($type === 'XK') {
    $q = $conn->query("
        SELECT id, SVD, TTGHD 
        FROM to1xk 
        ORDER BY id DESC
    ");
}

// Trường hợp nhập khẩu
elseif ($type === 'NK') {
    $q = $conn->query("
        SELECT to1nk.id, to1nk.SVD, to2nk.TTGHD
        FROM to1nk
        LEFT JOIN to2nk ON to2nk.id = to1nk.id
        ORDER BY to1nk.id DESC
    ");
}

// Nếu có lỗi SQL thì dừng và báo lỗi
if (!$q && ($type === 'XK' || $type === 'NK')) {
    die("SQL ERROR: " . $conn->error);
}

// Convert dữ liệu ra mảng
if ($q) {
    while ($r = $q->fetch_assoc()) {
        $orders[] = $r;
    }
}

// ===============================
// TỰ ĐỔ TRỊ GIÁ HÓA ĐƠN KHI CHỌN SỐ VẬN ĐƠN
// ===============================
$autoPrice = 0;

if (!empty($_POST['SVD'])) {
    foreach ($orders as $o) {
        if ($o['id'] == $_POST['SVD']) {
            $autoPrice = $o['TTGHD'] ?? 0;
            break;
        }
    }
}
?>


<h1>Tính Công Nợ</h1>
<main>
    <div class="card">
        <form method="POST">

            <div class="form-grid">
                <div>
                    <label>Loại đơn hàng</label>
                    <select name="loai_don" onchange="this.form.submit()" required>
                        <option value="">-- Chọn loại --</option>
                        <option value="XK" <?= ($type === 'XK' ? 'selected' : '') ?>>Xuất khẩu</option>
                        <option value="NK" <?= ($type === 'NK' ? 'selected' : '') ?>>Nhập khẩu</option>
                    </select>
                </div>

                <div>
                    <label>Số vận đơn</label>
                    <select name="SVD" onchange="this.form.submit()" <?= empty($type) ? 'disabled' : '' ?> required>
                        <option value="">-- Chọn số vận đơn --</option>
                        <?php foreach ($orders as $o):
                            // đảm bảo TTGHD tồn tại và là số
                            $ttghd = isset($o['TTGHD']) ? (float) $o['TTGHD'] : 0;
                            ?>
                            <option value="<?= htmlspecialchars($o['id']) ?>" data-ttghd="<?= $ttghd ?>"
                                <?= (!empty($_POST['SVD']) && $_POST['SVD'] == $o['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($o['SVD']) . " (ID: " . $o['id'] . ")" ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label>Tổng trị giá hóa đơn</label>
                    <input type="text" id="TTGHD" name="hoa_don"
                        value="<?= isset($autoPrice) ? number_format($autoPrice, 2, '.', ',') : '' ?>" readonly>
                </div>

            </div>

            <div class="form-grid">
                <div>
                    <label>Phí khai tờ khai</label>
                    <input type="number" name="phi_khai" step="0.01" required>
                </div>
                <div>
                    <label>Phí vận chuyển</label>
                    <input type="number" name="phi_vc" step="0.01" required>
                </div>
                <div>
                    <label>Thuế</label>
                    <input type="number" name="thue" step="0.01" required>
                </div>
            </div>

            <div class="form-grid">
                <div>
                    <label>Phí lưu kho bãi (nếu có)</label>
                    <input type="number" name="phi_kho" step="0.01">
                </div>
                <div>
                    <label>Phí chậm trả (nếu có)</label>
                    <input type="number" name="phi_cham" step="0.01">
                </div>
                <div>
                    <label>Bảo hiểm (nếu có)</label>
                    <input type="number" name="bao_hiem" step="0.01">
                </div>
                <div>
                    <label>Bồi thường (nếu có)</label>
                    <input type="number" name="boi_thuong" step="0.01">
                </div>
            </div>

            <div class="button-row">
                <button type="submit">💰 Tính Công Nợ</button>
            </div>
        </form>
    </div>

    <?php if (!empty($_POST['hoa_don'])) {
        $tong = $_POST['hoa_don'] + $_POST['phi_khai'] + $_POST['phi_vc'] + ($_POST['phi_kho'] ?? 0) + ($_POST['phi_cham'] ?? 0) + $_POST['thue'] + ($_POST['bao_hiem'] ?? 0) - ($_POST['boi_thuong'] ?? 0);
        ?>
        <div class="result">
            <h2>Kết Quả Công Nợ</h2>
            <div class="value-box"><?= number_format($tong, 0) ?> VNĐ</div>
        </div>
    <?php } ?>

</main>
<script>
    (function () {
        // Format theo Việt Nam
        const formatter = new Intl.NumberFormat('vi-VN');

        // Lấy element
        const selectSVD = document.getElementById('SVD');
        const inputTTGHD = document.getElementById('TTGHD');

        if (!selectSVD || !inputTTGHD) return;

        // Hàm lấy data-ttghd, convert sang số, trả về number
        function getOptionTTGHD(opt) {
            if (!opt) return 0;
            // đọc attribute data-ttghd
            let raw = opt.getAttribute('data-ttghd') || '0';
            // đảm bảo raw là số (loại bỏ comma nếu có)
            raw = raw.toString().replace(/,/g, '');
            let num = parseFloat(raw);
            return isNaN(num) ? 0 : num;
        }

        // Cập nhật input bằng option hiện tại
        function updateTTGHDFromSelect() {
            const selected = selectSVD.options[selectSVD.selectedIndex];
            const val = getOptionTTGHD(selected);
            // Format hiển thị
            inputTTGHD.value = formatter.format(val);
            // Nếu bạn cần gửi giá trị nguyên thô khi submit:
            // tạo/ cập nhật hidden field có tên hoa_don_raw
            let hidden = document.getElementById('hoa_don_raw');
            if (!hidden) {
                hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = 'hoa_don_raw';
                hidden.id = 'hoa_don_raw';
                selectSVD.form.appendChild(hidden);
            }
            hidden.value = val;
        }

        // Lắng nghe thay đổi
        selectSVD.addEventListener('change', function (e) {
            updateTTGHDFromSelect();
            // nếu bạn không muốn submit form khi chọn SVD, xóa this.form.submit() trên select
        });

        // Khi trang load, set lần đầu (nếu đã có SVD selected do server render)
        document.addEventListener('DOMContentLoaded', function () {
            updateTTGHDFromSelect();
        });
    })();
</script>

<?php include_once(__DIR__ . '/../public/footer.php'); ?>