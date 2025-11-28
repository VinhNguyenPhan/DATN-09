<?php
include_once(__DIR__ . '/../core/database.php');
include_once(__DIR__ . '/../public/header.php'); ?>
<style>
    :root {
        --blue: #1f6fb2;
        --blue-600: #2b86d6;
        --muted: #6b7280;
        --card: #ffffff;
        --surface: #f7fafc;
        --shadow: 0 6px 20px rgba(22, 61, 106, 0.08);
        --radius: 14px;
        --text: #0f172a;
        --accent: #1f3c88;
    }

    body {
        margin: 0;
        font-family: "Inter", sans-serif;
        background: linear-gradient(180deg, #ffffff 0%, #f6f9fc 100%);
        color: var(--text);
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

    .result-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-icon {
        background: #f59e0b;
        /* Màu cam */
        color: white;
        border: none;
        border-radius: 6px;
        padding: 4px 10px;
        font-size: 12px;
        cursor: pointer;
        margin-left: 10px;
        width: auto;
        /* Override width 100% của button chung */
        margin-top: 0;
    }

    .btn-icon:hover {
        background: #d97706;
        transform: none;
    }

    .edit-input {
        display: none;
        /* Mặc định ẩn */
        width: 150px;
        padding: 4px 8px;
        margin-bottom: 0;
        border: 1px solid var(--navy);
        font-weight: bold;
        font-size: 18px;
        text-align: right;
    }

    main {
        display: block;
    }
</style>

<?php
require_once(__DIR__ . '/../core/database.php');
require_role(['admin', 'employee', 'accounting']);

// 1. Lấy dữ liệu cho Xuất khẩu (XK)
$orders_xk = [];
$q_xk = $conn->query("SELECT id, SVD, TTGHD FROM to1xk ORDER BY id DESC");
if ($q_xk) {
    while ($r = $q_xk->fetch_assoc()) {
        $r['TTGHD'] = $r['TTGHD'] ?? 0;
        $orders_xk[] = $r;
    }
}

// 2. Lấy dữ liệu cho Nhập khẩu (NK)
$orders_nk = [];
$q_nk = $conn->query("
    SELECT to1nk.id, to1nk.SVD, to2nk.TTGHD
    FROM to1nk
    LEFT JOIN to2nk ON to2nk.id = to1nk.id
    ORDER BY to1nk.id DESC
");
if ($q_nk) {
    while ($r = $q_nk->fetch_assoc()) {
        $r['TTGHD'] = $r['TTGHD'] ?? 0;
        $orders_nk[] = $r;
    }
}

$all_orders = [
    'XK' => $orders_xk,
    'NK' => $orders_nk
];
$json_all_orders = json_encode($all_orders);
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
                        <option value="">-- Chọn loại tờ khai trước --</option>
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
    <?php $current_role = $_SESSION['role'] ?? '';
    $isAdmin = ($current_role === 'admin');
    ?>
    <!-- RIGHT: RESULT -->
    <div class="right">
        <div class="result-title">Kết Quả Công Nợ</div>

        <div class="result-box">
            <div class="result-label">Tổng Công Nợ</div>
            <?php if ($isAdmin): ?>
                <button type="button" id="btnEditTong" class="btn-icon" title="Chỉnh sửa thủ công">
                    ✎ Sửa
                </button>
            <?php endif; ?>
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
    // --- 1. KHỞI TẠO DỮ LIỆU & BIẾN ---
    const ALL_ORDERS = <?= $json_all_orders ?>;

    // Các phần tử giao diện chính
    const loaiTk = document.getElementById('loaiTk');
    const svd = document.getElementById('SVD');
    const ttghd = document.getElementById('TTGHD');
    const btnTinh = document.getElementById('btnTinh');
    const err = document.getElementById('errorBox');

    // Các input nhập liệu
    const phi_khai = document.getElementById('phi_khai');
    const phi_vc = document.getElementById('phi_vc');
    const thue = document.getElementById('thue');
    const phi_kho = document.getElementById('phi_kho');
    const phi_cham = document.getElementById('phi_cham');
    const bao_hiem = document.getElementById('bao_hiem');
    const boiThuong = document.getElementById('boiThuong');

    // Các phần tử hiển thị kết quả & Admin Edit
    const kqTongDiv = document.getElementById('kq_tong');
    const inputTongEdit = document.getElementById('input_tong_edit'); // Input ẩn
    const btnEditTong = document.getElementById('btnEditTong'); // Nút sửa (có thể null nếu ko phải admin)

    // Biến lưu tổng tiền hiện tại (dạng số nguyên)
    let currentTotal = 0;

    // --- 2. CÁC HÀM HỖ TRỢ (HELPER) ---

    // Chuyển chuỗi (1.000.000) hoặc số thành số thực (float) để tính toán
    const toNum = (v) => {
        if (!v) return 0;
        if (typeof v === 'number') return v;
        // Xóa dấu chấm/phẩy phân cách ngàn trước khi parse
        const cleanStr = v.toString().replace(/\./g, '').replace(/,/g, '');
        return parseFloat(cleanStr) || 0;
    };

    // Định dạng số thành tiền tệ VN (1000000 -> 1.000.000)
    const formatMoney = (num) => {
        return new Intl.NumberFormat('vi-VN').format(num);
    };

    // --- 3. HÀM LƯU DỮ LIỆU (DÙNG CHUNG) ---
    // Hàm này được gọi khi bấm "Tính" hoặc bấm "Lưu" (Admin)
    const saveToDatabase = (amount) => {
        if (!svd.value) return; // Không có vận đơn thì không lưu

        fetch("updateCongNo.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: new URLSearchParams({
                loaiTk: loaiTk.value,
                id: svd.value,
                tong: amount // Gửi giá trị cuối cùng lên server
            })
        })
            .then(res => res.json())
            .then(data => {
                if (data.status === "success") {
                    console.log("Đã lưu công nợ thành công:", amount);

                    // Hiệu ứng nháy màu xanh để báo thành công
                    const originalColor = kqTongDiv.style.color;
                    kqTongDiv.style.color = "#10b981"; // Xanh lá
                    kqTongDiv.style.fontWeight = "800";
                    setTimeout(() => {
                        kqTongDiv.style.color = originalColor; // Trả về màu cũ
                    }, 800);
                } else {
                    alert("Có lỗi khi lưu dữ liệu: " + (data.msg || "Lỗi không xác định"));
                }
            })
            .catch(error => {
                console.error("Lỗi kết nối:", error);
                alert("Không thể kết nối đến máy chủ.");
            });
    };

    // --- 4. XỬ LÝ SỰ KIỆN FILTER DỮ LIỆU ---

    // Khi chọn Loại Tờ Khai -> Load danh sách SVD
    loaiTk.addEventListener("change", () => {
        const selectedType = loaiTk.value;
        const orders = ALL_ORDERS[selectedType] || [];

        // Reset
        svd.innerHTML = '<option value="">-- Chọn --</option>';
        ttghd.value = '';
        currentTotal = 0;
        kqTongDiv.innerText = "0 VNĐ";

        if (selectedType && orders.length > 0) {
            let optionsHtml = '<option value="">-- Chọn --</option>';
            orders.forEach(o => {
                // Lưu giá trị gốc vào dataset để lấy cho chính xác
                const ttghdValue = o.TTGHD || 0;
                optionsHtml += `<option value="${o.id}" data-ttghd="${ttghdValue}">
                                    ${o.SVD}
                                </option>`;
            });
            svd.innerHTML = optionsHtml;
        } else if (selectedType) {
            svd.innerHTML = '<option value="">-- Không tìm thấy vận đơn --</option>';
        }
    });

    // Khi chọn SVD -> Hiển thị Tổng Trị Giá Hóa Đơn
    svd.addEventListener("change", () => {
        const opt = svd.options[svd.selectedIndex];
        const val = opt.dataset.ttghd || 0;
        ttghd.value = formatMoney(val); // Hiển thị đẹp
    });

    // --- 5. LOGIC TÍNH CÔNG NỢ (NÚT TÍNH) ---
    btnTinh.onclick = () => {
        err.style.display = "none";

        // Validate
        if (!svd.value || !loaiTk.value) {
            err.style.display = "block";
            return;
        }

        // Lấy giá trị từ form
        const totalInvoiceValue = toNum(ttghd.value);
        const feeKhai = toNum(phi_khai.value);
        const feeVC = toNum(phi_vc.value);
        const tax = toNum(thue.value);
        const feeKho = toNum(phi_kho.value);
        const feeCham = toNum(phi_cham.value);
        const baoHiem = toNum(bao_hiem.value);
        const boiThuongValue = toNum(boiThuong.value);

        // Tính toán
        const tong = totalInvoiceValue + feeKhai + feeVC + tax + feeKho + feeCham + baoHiem - boiThuongValue;
        currentTotal = tong; // Cập nhật biến toàn cục

        // Cập nhật giao diện Kết Quả
        kqTongDiv.innerText = formatMoney(tong) + " VNĐ";
        document.getElementById("kq_thue").innerText = formatMoney(tax);
        document.getElementById("kq_vc").innerText = formatMoney(feeVC);
        document.getElementById("kq_khai").innerText = formatMoney(feeKhai);

        // Nếu đang mở chế độ Sửa (Admin) thì đóng lại để hiện số mới
        if (inputTongEdit && inputTongEdit.style.display === 'block') {
            inputTongEdit.style.display = 'none';
            kqTongDiv.style.display = 'block';
            btnEditTong.innerText = '✎ Sửa';
            btnEditTong.style.backgroundColor = ''; // Reset màu
        }

        // Lưu vào Database
        saveToDatabase(tong);
    };

    // --- 6. LOGIC NÚT SỬA (CHỈ DÀNH CHO ADMIN) ---
    if (btnEditTong) {
        btnEditTong.addEventListener('click', () => {
            // Kiểm tra trạng thái hiện tại (đang hiện Input hay đang hiện Text?)
            const isEditing = inputTongEdit.style.display === 'block';

            if (!isEditing) {
                // --- CHUYỂN SANG CHẾ ĐỘ SỬA ---
                kqTongDiv.style.display = 'none'; // Ẩn text
                inputTongEdit.style.display = 'block'; // Hiện input

                // Gán giá trị hiện tại vào input (bỏ format để dễ sửa)
                inputTongEdit.value = currentTotal;
                inputTongEdit.focus();

                // Đổi giao diện nút
                btnEditTong.innerText = '💾 Lưu';
                btnEditTong.style.backgroundColor = '#10b981'; // Xanh lá
                btnEditTong.title = "Lưu giá trị mới vào hệ thống";
            } else {
                // --- LƯU LẠI ---
                // 1. Lấy giá trị người dùng nhập
                const newVal = toNum(inputTongEdit.value);
                currentTotal = newVal; // Cập nhật biến toàn cục

                // 2. Cập nhật giao diện
                kqTongDiv.innerText = formatMoney(newVal) + " VNĐ";

                // 3. Đóng input, hiện text
                inputTongEdit.style.display = 'none';
                kqTongDiv.style.display = 'block';

                // 4. Reset nút về ban đầu
                btnEditTong.innerText = '✎ Sửa';
                btnEditTong.style.backgroundColor = ''; // Về màu CSS gốc
                btnEditTong.title = "Chỉnh sửa thủ công";

                // 5. GỌI API LƯU GIÁ TRỊ MỚI
                saveToDatabase(newVal);
            }
        });

        // Thêm tính năng bấm Enter trong input để lưu nhanh
        inputTongEdit.addEventListener("keypress", function (event) {
            if (event.key === "Enter") {
                event.preventDefault();
                btnEditTong.click(); // Kích hoạt nút Lưu
            }
        });
    }
</script>


<!-- <script>
    // Khởi tạo biến dữ liệu từ PHP (Chứa tất cả SVD và TTGHD)
    const ALL_ORDERS = <?= $json_all_orders ?>;

    const loaiTk = document.getElementById('loaiTk');
    const svd = document.getElementById('SVD');
    const ttghd = document.getElementById('TTGHD');
    const btn = document.getElementById('btnTinh');
    const err = document.getElementById('errorBox');

    // Khai báo các input cần thiết cho tính toán
    const phi_khai = document.getElementById('phi_khai');
    const phi_vc = document.getElementById('phi_vc');
    const thue = document.getElementById('thue');
    const phi_kho = document.getElementById('phi_kho');
    const phi_cham = document.getElementById('phi_cham');
    const bao_hiem = document.getElementById('bao_hiem');
    const boiThuong = document.getElementById('boiThuong'); // ID input

    // Hàm chuyển đổi từ chuỗi có dấu phẩy/chấm sang số
    const toNum = v => {
        if (typeof v === 'string') {
            v = v.replace(/\./g, '').replace(/,/g, '');
        }
        return parseFloat(v || 0) || 0;
    };

    // --- LOGIC 1: Lọc SVD theo Loại Tờ Khai khi có thay đổi trên #loaiTk ---
    loaiTk.addEventListener("change", () => {
        const selectedType = loaiTk.value;
        const orders = ALL_ORDERS[selectedType] || [];

        // 1. Reset SVD và TTGHD
        svd.innerHTML = '<option value="">-- Chọn --</option>';
        ttghd.value = '';

        // 2. Điền danh sách vận đơn mới
        if (selectedType && orders.length > 0) {
            let optionsHtml = '<option value="">-- Chọn --</option>';
            orders.forEach(o => {
                const ttghdValue = o.TTGHD || 0;
                optionsHtml += `<option value="${o.id}" data-ttghd="${ttghdValue}">
                                    ${o.SVD}
                                </option>`;
            });
            svd.innerHTML = optionsHtml;
        } else if (selectedType) {
            svd.innerHTML = '<option value="">-- Không tìm thấy vận đơn --</option>';
        }
    });


    // --- LOGIC 2: Cập nhật TTGHD khi SVD thay đổi ---
    svd.addEventListener("change", () => {
        const opt = svd.options[svd.selectedIndex];
        const val = opt.dataset.ttghd || 0;
        // Sử dụng định dạng tiền tệ Việt Nam
        ttghd.value = new Intl.NumberFormat('vi-VN').format(val);
    });

    // --- LOGIC 3: Tính Công Nợ ---
    btn.onclick = () => {
        err.style.display = "none";

        if (!svd.value || !loaiTk.value) {
            err.style.display = "block";
            return;
        }

        const totalInvoiceValue = toNum(ttghd.value);
        const feeKhai = toNum(phi_khai.value);
        const feeVC = toNum(phi_vc.value);
        const tax = toNum(thue.value);
        const feeKho = toNum(phi_kho.value);
        const feeCham = toNum(phi_cham.value);
        const baoHiem = toNum(bao_hiem.value);
        const boiThuongValue = toNum(boiThuong.value);

        const tong =
            totalInvoiceValue +
            feeKhai +
            feeVC +
            tax +
            feeKho +
            feeCham +
            baoHiem -
            boiThuongValue;

        // ==== CẬP NHẬT GIAO DIỆN ====
        document.getElementById("kq_tong").innerText =
            new Intl.NumberFormat('vi-VN').format(tong) + " VNĐ";

        document.getElementById("kq_thue").innerText = tax.toLocaleString('vi-VN');
        document.getElementById("kq_vc").innerText = feeVC.toLocaleString('vi-VN');
        document.getElementById("kq_khai").innerText = feeKhai.toLocaleString('vi-VN');

        // ==== GỬI LÊN SERVER LƯU CÔNG NỢ ====
        fetch("updateCongNo.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: new URLSearchParams({
                loaiTk: loaiTk.value,
                id: svd.value,
                tong: tong
            })
        })
            .then(res => res.json())
            .then(data => {
                if (data.status === "success") {
                    console.log("Đã lưu công nợ!");
                } else {
                    console.error("Lỗi:", data.msg);
                }
            });
    }
</script>

<?php include_once(__DIR__ . '/../public/footer.php'); ?> 