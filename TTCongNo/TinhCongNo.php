<?php include_once(__DIR__ . '/../public/header.php'); ?>
<style>
    :root {
        --navy: #1e3a8a;
        --navy-light: #2d4fb8;
        --bg: #f3f6fa;
        --card: #ffffff;
        --border: #d9e2ec;
        --text: #0b1220;
        --muted: #475569;
        --radius: 14px;
        --shadow: 0 4px 14px rgba(0, 0, 0, 0.07);
    }

    body {
        background: var(--bg);
        font-family: Arial, sans-serif;
    }

    h1 {
        text-align: center;
        margin: 30px 0;
        color: var(--navy);
        font-size: 32px;
        font-weight: 800;
    }

    .layout {
        display: flex;
        gap: 20px;
        max-width: 1200px;
        margin: auto;
        align-items: stretch;
    }

    .left,
    .right {
        width: 50%;
        background: var(--card);
        padding: 25px;
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
        display: flex;
        flex-direction: column;
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
        font-size: 15px;
        border-radius: var(--radius);
        border: 1px solid var(--border);
        outline: none;
        transition: .25s;
        background: #fff;
        margin-bottom: 16px;
    }

    select:focus,
    input:focus {
        border-color: var(--navy);
        box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.2);
    }

    button {
        background: var(--navy);
        color: #fff;
        padding: 14px 22px;
        font-size: 18px;
        border: none;
        border-radius: var(--radius);
        cursor: pointer;
        font-weight: 700;
        transition: .25s;
        width: 100%;
        margin-top: 10px;
    }

    button:hover {
        background: var(--navy-light);
        transform: translateY(-2px);
    }

    /* Result Section */
    .result-title {
        font-size: 22px;
        font-weight: 700;
        color: var(--navy);
        margin-bottom: 20px;
        text-align: center;
    }

    .result-box {
        padding: 16px;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        margin-bottom: 14px;
        background: #f8fafc;
    }

    .result-label {
        font-weight: 600;
        margin-bottom: 4px;
        color: var(--muted);
    }

    .result-value {
        font-size: 20px;
        font-weight: 700;
        color: var(--text);
    }

    .error {
        color: red;
        margin-bottom: 10px;
        font-weight: 600;
        display: none;
    }

    .two-col {
        display: flex;
        gap: 20px;
    }

    .two-col .form-group {
        flex: 1;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    label {
        font-weight: 600;
        margin-bottom: 6px;
        color: #0a2342;
        /* navy */
    }

    input,
    select {
        padding: 10px 12px;
        border: 1px solid #d0d7e1;
        border-radius: 8px;
        font-size: 15px;
        background: #fff;
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

if ($type === 'XK') {
    $q = $conn->query("SELECT id, SVD, TTGHD FROM to1xk ORDER BY id DESC");
} elseif ($type === 'NK') {
    $q = $conn->query("
        SELECT to1nk.id, to1nk.SVD, to2nk.TTGHD 
        FROM to1nk
        LEFT JOIN to2nk ON to2nk.id = to1nk.id
        ORDER BY to1nk.id DESC
    ");
}

if (!empty($q)) {
    while ($r = $q->fetch_assoc()) {
        $orders[] = $r;
    }
}
?>

<h1>Tính Công Nợ</h1>

<div class="layout">

    <!-- LEFT: FORM -->
    <div class="left">
        <form id="debtForm">

            <div class="error" id="errorBox">Vui lòng nhập đủ thông tin bắt buộc.</div>

            <div class="form-row two-col">
                <div class="form-group">
                    <label>Loại tờ khai <span>*</span></label>
                    <select id="loaiTk">
                        <option value="">-- Chọn loại --</option>
                        <option value="XK">Xuất khẩu</option>
                        <option value="NK">Nhập khẩu</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Số vận đơn *</label>
                    <select name="SVD" id="SVD" required>
                        <option value="">-- Chọn --</option>
                        <?php foreach ($orders as $o): ?>
                            <option value="<?= $o['id'] ?>" data-ttghd="<?= $o['TTGHD'] ?? 0 ?>">
                                <?= $o['SVD'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <label>Tổng trị giá hóa đơn *</label>
            <input type="text" id="TTGHD" readonly placeholder="Tự động lấy theo vận đơn">
            <div class="form-row two-col">
                <div class="form-group">
                    <label>Phí khai tờ khai</label>
                    <input type="number" id="phi_khai" step="0.01">
                </div>
                <div class="form-group">
                    <label>Phí vận chuyển</label>
                    <input type="number" id="phi_vc" step="0.01">
                </div>
            </div>
            <div class="form-row two-col">
                <div class="form-group">
                    <label>Thuế</label>
                    <input type="number" id="thue" step="0.01">
                </div>
                <div class="form-group">
                    <label>Phí lưu kho/bãi (nếu có)</label>
                    <input type="number" id="phi_kho" step="0.01">
                </div>
            </div>
            <div class="form-row two-col">
                <div class="form-group">
                    <label>Phí chậm trả (nếu có)</label>
                    <input type="number" id="phi_cham" step="0.01">
                </div>
                <div class="form-group">
                    <label>Bảo hiểm (nếu có)</label>
                    <input type="number" id="bao_hiem" step="0.01">
                </div>
            </div>
            <div class="form-row two-col">
                <div class="form-group">
                    <label>Số tiền bồi thường (nếu có)</label>
                    <input type="number" id="boiThuong">
                </div>

                <div class="form-group">
                    <label>Lý do bồi thường</label>
                    <select id="lyDoBoiThuong">
                        <option value="">-- Chọn lý do --</option>
                        <option value="do-hu-hong">Hư hỏng</option>
                        <option value="do-thieu-hang">Thiếu hàng</option>
                        <option value="do-cham-giao">Giao trễ</option>
                        <option value="khac">Khác</option>
                    </select>
                </div>
            </div>

            <button type="button" id="btnTinh">Tính Công Nợ</button>
        </form>
    </div>

    <!-- RIGHT: RESULT -->
    <div class="right">
        <div class="result-title">Kết Quả Công Nợ</div>

        <div class="result-box">
            <div class="result-label">Tổng Công Nợ</div>
            <div class="result-value" id="kq_tong">0 VNĐ</div>
        </div>

        <div class="result-box">
            <div class="result-label">Thuế</div>
            <div class="result-value" id="kq_thue">0</div>
        </div>

        <div class="result-box">
            <div class="result-label">Phí vận chuyển</div>
            <div class="result-value" id="kq_vc">0</div>
        </div>

        <div class="result-box">
            <div class="result-label">Phí khai</div>
            <div class="result-value" id="kq_khai">0</div>
        </div>
    </div>
</div>


<script>
    const svd = document.getElementById('SVD');
    const ttghd = document.getElementById('TTGHD');
    const btn = document.getElementById('btnTinh');
    const err = document.getElementById('errorBox');

    svd.addEventListener("change", () => {
        const opt = svd.options[svd.selectedIndex];
        const val = opt.dataset.ttghd || 0;
        ttghd.value = new Intl.NumberFormat('vi-VN').format(val);
    });

    btn.onclick = () => {
        err.style.display = "none";

        if (!svd.value || !ttghd.value) {
            err.style.display = "block";
            return;
        }

        const toNum = v => parseFloat((v || 0).toString().replace(/,/g, '')) || 0;

        const tong =
            toNum(ttghd.value) +
            toNum(phi_khai.value) +
            toNum(phi_vc.value) +
            toNum(thue.value) +
            toNum(phi_kho.value) +
            toNum(phi_cham.value) +
            toNum(bao_hiem.value) -
            toNum(boi_thuong.value);

        document.getElementById("kq_tong").innerText =
            new Intl.NumberFormat('vi-VN').format(tong) + " VNĐ";

        document.getElementById("kq_thue").innerText = thue.value || 0;
        document.getElementById("kq_vc").innerText = phi_vc.value || 0;
        document.getElementById("kq_khai").innerText = phi_khai.value || 0;
    }
</script>

<?php include_once(__DIR__ . '/../public/footer.php'); ?>