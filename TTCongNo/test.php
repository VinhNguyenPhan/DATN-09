<?php
declare(strict_types=1);
date_default_timezone_set('Asia/Ho_Chi_Minh');

include_once(__DIR__ . '/../public/header.php');
if (session_status() === PHP_SESSION_NONE)
    session_start();
require_role(['customer', 'admin', 'accounting']);
if (empty($_SESSION['user_id'])) {
    $redirect = '/DangNhap-DangKyTK/DangNhapDangKyTK.php?next=' . urlencode($_SERVER['REQUEST_URI']);
    header("Location: $redirect");
    exit;
}

function formatCurrencyVND($amount): string
{
    $amount = (float) $amount;
    return number_format($amount, 0, ',', '.'); // 1.234.567
}
function calculateLateFee($baseAmount, $dueDate, float $ratePerDayPercent = 0.05): float
{
    $baseAmount = (float) $baseAmount;
    $due = strtotime($dueDate);
    $today = strtotime(date('Y-m-d'));
    if ($due === false)
        return 0.0;

    $daysLate = max(0, (int) floor(($today - $due) / 86400));
    if ($daysLate <= 0)
        return 0.0;

    $rate = $ratePerDayPercent / 100.0;
    return $baseAmount * $rate * $daysLate;
}
function fetchInvoicesFromDb($conn, $userId): array
{
    $rows = [];
    try {
        if (!$userId)
            return $rows;

        $sqlXK = "SELECT to1xk.id, to1xk.SVD, to1xk.created_at, to1xk.TTGHD as amount, to1xk.tt_thanhtoan FROM to1XK WHERE to1XK.ThongKeTK = 'declaration' ORDER BY to1xk.id DESC";
        $sqlNK = "SELECT to1nk.id, to1nk.SVD, to1nk.created_at, to2nk.TTGHD as amount, to1nk.tt_thanhtoan FROM to1NK JOIN to2nk ON to2nk.to1nk = to1nk.id to1nk.ThongKeTK = 'declaration' ORDER BY to1nk.id DESC;";

        $resXK = $conn->query($sqlXK);
        $resNK = $conn->query($sqlNK);

        $orders = [];
        if ($resXK) {
            $xkData = $resXK->fetch_all(MYSQLI_ASSOC);
            foreach ($xkData as &$row)
                $row['loai'] = 'to1xk';
            $orders = array_merge($orders, $xkData);
        }
        if ($resNK) {
            $nkData = $resNK->fetch_all(MYSQLI_ASSOC);
            foreach ($nkData as &$row)
                $row['loai'] = 'to1nk';
            $orders = array_merge($orders, $nkData);
        }
        usort($orders, fn($a, $b) => strtotime($b['created_at'] ?? '0') <=> strtotime($a['created_at'] ?? '0'));

        $tz = new DateTimeZone('Asia/Ho_Chi_Minh');
        $defaultDue = (new DateTime('now', $tz))->modify('+7 days')->format('Y-m-d');

        foreach ($orders as $r) {
            $rows[] = [
                'id' => (string) ($r['id'] ?? ''),
                'SVD' => (string) ($r['SVD'] ?? ''),
                'loai' => (string) ($r['loai'] ?? ''),
                'issued_date' => !empty($r['created_at']) ? date('Y-m-d', strtotime($r['created_at'])) : date('Y-m-d'),
                'goods_amount' => (float) ($r['amount'] ?? 0),
                'freight_fee' => 0.0,
                'due_date' => !empty($r['due_date']) ? date('Y-m-d', strtotime($r['due_date'])) : $defaultDue,
                'status' => $r['tt_thanhtoan'] ?? 'pending',
            ];
        }
    } catch (Throwable $e) {
    }
    return $rows;
}

$userId = (int) ($_SESSION['user_id'] ?? 0);
$invoices = fetchInvoicesFromDb($conn, $userId);

foreach ($invoices as $idx => $inv) {
    $goods = (float) ($inv['goods_amount'] ?? 0);
    $ship = (float) ($inv['freight_fee'] ?? 0);
    $base = $goods + $ship;

    $due = $inv['due_date'] ?? date('Y-m-d');
    $late = calculateLateFee($base, $due);
    $total = $base + $late;

    $invoices[$idx]['base_amount'] = $base;
    $invoices[$idx]['late_fee'] = $late;
    $invoices[$idx]['total_amount'] = $total;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'complaint') {

    require_once(__DIR__ . '/../core/database.php');

    $id = $_POST['id'];
    $reason = $_POST['reason'];

    $sql = "INSERT INTO complaints (invoice_id, reason, created_at) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $id, $reason);
    $stmt->execute();

    echo "OK";
    exit;
}

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Theo dõi công nợ & Thanh toán online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <style>
        .page-header {
            text-align: center;
            margin: 30px 0;
        }

        .page-header h1 {
            font-size: 30px;
            font-weight: 800;
            color: #0D47A1;
            letter-spacing: 1px;
            text-transform: uppercase;
            display: inline-block;
            position: relative;
        }


        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        body {
            font-family: "Inter", system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            background: #f1f5f9;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            padding: 40px 20px;
        }

        .card {
            background: #fff;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, .15);
            text-align: center;
            max-width: 600px;
            width: 100%;
            transition: transform .3s ease;
        }

        .card:hover {
            transform: scale(1.03);
        }

        .card .icon {
            font-size: 50px;
            margin-bottom: 20px;
        }

        .card h3 {
            font-size: 24px;
            margin-bottom: 12px;
            color: #1f3c88;
        }

        .card p {
            font-size: 16px;
            color: #555;
            margin-bottom: 20px;
        }

        .card .btn {
            background: #1f6fb2;
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 12px;
            font-size: 16px;
            cursor: pointer;
            transition: background .3s, transform .2s;
        }

        .card .btn:hover {
            background: #155b8a;
            transform: scale(1.05);
        }

        .modal {
            display: none;
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, .5);
            z-index: 1000;
        }

        .modal-content {
            background: #fff;
            margin: 5% auto;
            padding: 30px;
            border-radius: 16px;
            width: 90%;
            max-width: 1000px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .25);
            position: relative;
        }

        .close {
            position: absolute;
            right: 16px;
            top: 10px;
            font-size: 28px;
            font-weight: 700;
            cursor: pointer;
            color: #666;
        }

        .close:hover {
            color: #000;
        }

        .debt-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 16px;
            table-layout: auto;
        }

        .debt-table th,
        .debt-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
            white-space: nowrap;
        }

        .debt-table th {
            background: #1f6fb2;
            color: #fff;
        }

        .pay-btn {
            background: #10b981;
            color: #fff;
            border: none;
            padding: 10px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            transition: background .3s, transform .2s;
            white-space: nowrap;
        }

        .pay-btn:hover {
            background: #0d946b;
            transform: scale(1.05);
        }

        .pay-btn.disabled {
            background: gray;
            cursor: not-allowed;
        }

        /* CSS cho nút Đã Chuyển Khoản */
        .btn-paid-notify {
            background: #dc2626;
            /* Màu đỏ */
            color: #fff;
            border: none;
            padding: 10px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            margin-top: 15px;
            /* Khoảng cách với QR */
            transition: background .3s, transform .2s;
            display: block;
            /* Chiếm hết chiều ngang */
            width: 100%;
        }

        .btn-paid-notify:hover {
            background: #991b1b;
            transform: scale(1.02);
        }

        .pager {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 16px;
            gap: 12px;
            flex-wrap: wrap;
        }

        .pager .left {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .pager button {
            padding: 8px 12px;
            border: none;
            border-radius: 8px;
            background: #e5e7eb;
            cursor: pointer;
        }

        .pager button:disabled {
            opacity: .5;
            cursor: not-allowed;
        }

        .pager .info {
            font-size: 14px;
            color: #374151;
        }

        .pager select {
            padding: 6px 10px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
        }

        .pay-modal {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 2000;
        }

        .pay-backdrop {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, .6);
        }

        .pay-panel {
            position: relative;
            z-index: 2001;
            max-width: 520px;
            width: 92%;
            margin: 6% auto;
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .35);
            text-align: center;
            animation: pop .2s ease;
        }

        @keyframes pop {
            from {
                transform: scale(.96);
                opacity: 0
            }

            to {
                transform: scale(1);
                opacity: 1
            }
        }

        .pay-close {
            position: absolute;
            right: 12px;
            top: 10px;
            font-size: 24px;
            cursor: pointer;
            color: #666;
        }

        .pay-close:hover {
            color: #000;
        }

        .pay-title {
            margin: 0 0 8px;
            font-size: 20px;
            font-weight: 700;
            color: #1f3c88;
        }

        .pay-sub {
            margin: 0 0 16px;
            color: #374151;
        }

        .qr-img {
            width: 280px;
            height: auto;
            border: 4px solid #1f6fb2;
            border-radius: 14px;
            margin: 12px auto;
            display: block;
        }

        .qr-desc {
            margin-top: 8px;
            color: #333;
            font-size: 15px;
        }

        .pay-actions {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }

        /* Media Queries */
        @media (max-width:768px) {
            .container {
                padding: 20px 10px;
            }

            .card {
                padding: 30px 20px;
            }

            .card h3 {
                font-size: 22px;
            }

            .card p {
                font-size: 15px;
            }

            .pay-btn {
                font-size: 13px;
                padding: 8px 12px;
            }

            .qr-img {
                width: 220px;
            }

            .btn-paid-notify {
                font-size: 16px;
                padding: 12px;
            }
        }

        main {
            display: block;
        }

        /* ==========================
   COMPLAIN MODAL (NEW)
   ========================== */
        .complain-modal {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 2100;
            /* cao hơn pay modal */
        }

        .complain-backdrop {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, .55);
            backdrop-filter: blur(2px);
        }

        .complain-panel {
            position: relative;
            z-index: 2101;
            background: #fff;
            width: 90%;
            max-width: 520px;
            margin: 7% auto;
            padding: 28px 26px;
            border-radius: 20px;

            box-shadow: 0 10px 28px rgba(0, 0, 0, .28);

            animation: pop .22s ease-out;
            font-family: "Inter", sans-serif;
        }

        .complain-close {
            position: absolute;
            top: 12px;
            right: 14px;
            font-size: 24px;
            font-weight: 700;
            cursor: pointer;
            color: #666;
        }

        .complain-close:hover {
            color: #000;
        }

        .complain-title {
            margin: 0 0 12px;
            font-size: 22px;
            font-weight: 800;
            color: #1f3c88;
            text-align: center;
        }

        .complain-sub {
            margin: 0 0 20px;
            color: #374151;
            text-align: center;
            font-size: 15px;
        }

        /* Select box */
        .complain-select {
            width: 100%;
            padding: 12px 14px;
            font-size: 15px;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            outline: none;
            transition: border .2s, box-shadow .2s;
        }

        .complain-select:focus {
            border-color: #1f6fb2;
            box-shadow: 0 0 0 3px rgba(31, 111, 178, .25);
        }

        /* Send button */
        .complain-submit {
            width: 100%;
            margin-top: 22px;
            padding: 13px 0;
            font-size: 16px;
            background: #1f6fb2;
            color: #fff;
            border: none;
            border-radius: 14px;
            cursor: pointer;
            transition: background .25s, transform .2s;
        }

        .complain-submit:hover {
            background: #155b8a;
            transform: scale(1.02);
        }

        .complain-btn {
            background: #dc2626;
            /* Đỏ tươi */
            color: #fff;
            border: none;
            padding: 10px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            white-space: nowrap;
            transition: background .3s ease, transform .2s ease;
        }

        .complain-btn:hover {
            background: #b91c1c;
            /* Đỏ đậm hơn khi hover */
            transform: scale(1.05);
        }

        .complain-btn:disabled {
            background: #9ca3af;
            cursor: not-allowed;
        }
    </style>
</head>

<body>

    <div class="page-header">
        <h1>Thanh toán công nợ</h1>
    </div>

    <div class="container">
        <div class="card">
            <div class="icon">💳</div>
            <h3>Theo dõi công nợ & Thanh toán online</h3>
            <p>Xem công nợ còn lại, lịch sử thanh toán và thực hiện thanh toán trực tuyến an toàn.</p>
            <button class="btn" onclick="openDebtModal()">Xem chi tiết</button>
        </div>
    </div>

    <div id="debtModal" class="modal" role="dialog" aria-modal="true" aria-labelledby="debtModalTitle">
        <div class="modal-content">
            <span class="close" onclick="closeDebtModal()" aria-label="Đóng">&times;</span>
            <h2 id="debtModalTitle">Công nợ & Thanh toán online</h2>

            <table id="debt-table" class="debt-table">
                <thead>
                    <tr>
                        <th>Số vận đơn</th>
                        <th>Ngày khai báo</th>
                        <th>Số tiền (VNĐ)</th>
                        <th>Tình trạng TT</th>
                        <th>Hạn thanh toán</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody id="debt-tbody">
                </tbody>
            </table>

            <div class="pager">
                <div class="left">
                    <button id="pgPrev" onclick="gotoPrevPage()">&laquo; Trước</button>
                    <span class="info" id="pgInfo">Trang 1/1</span>
                    <button id="pgNext" onclick="gotoNextPage()">Sau &raquo;</button>
                </div>
                <div class="right">
                    <label for="pgSize">Hiển thị:</label>
                    <select id="pgSize" onchange="changePageSize(this.value)">
                        <option value="4">4 dòng</option>
                        <option value="10">10 dòng</option>
                        <option value="-1">Tất cả</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div id="payModal" class="pay-modal" aria-hidden="true">
        <div class="pay-backdrop" onclick="closePayModal()"></div>
        <div class="pay-panel">
            <span class="pay-close" onclick="closePayModal()" aria-label="Đóng">&times;</span>
            <h3 class="pay-title">Thanh toán hóa đơn</h3>
            <p class="pay-sub" id="paySub">Vui lòng quét mã để thanh toán.</p>
            <img id="payQR" class="qr-img" src="" alt="QR Code Thanh toán">
            <p class="qr-desc" id="payDesc"></p>

            <div class="pay-actions">
                <button class="btn-paid-notify" id="btnPaidNotify" onclick="markAsPaid('')">
                    <span class="icon"></span> Đã Thanh toán xong
                </button>
            </div>
        </div>
    </div>

    <div id="complainModal" class="complain-modal">
        <div class="complain-backdrop" onclick="closeComplaintModal()"></div>

        <div class="complain-panel">
            <span class="complain-close" onclick="closeComplaintModal()">&times;</span>

            <h2 class="complain-title">Khiếu nại hóa đơn</h2>
            <p class="complain-sub">Vui lòng chọn lý do khiếu nại để chúng tôi hỗ trợ bạn tốt hơn.</p>

            <select id="complaintReason" class="complain-select">
                <option value="">-- Chọn lý do --</option>
                <option value="Sai số tiền">Sai số tiền</option>
                <option value="Sai thông tin vận đơn">Sai thông tin vận đơn</option>
                <option value="Giao hàng chậm">Giao hàng chậm</option>
                <option value="Mất hàng">Mất hàng</option>
                <option value="Phát sinh không hợp lý">Phát sinh không hợp lý</option>
                <option value="Khác">Khác</option>
            </select>

            <button class="complain-submit" onclick="submitComplaint()">
                Gửi khiếu nại
            </button>
        </div>
    </div>



    <script>
        let complaintInvoiceId = null;
        let selectedReason = "";

        // Mở modal khiếu nại
        function openComplaintModal(id) {
            complaintInvoiceId = id; // ✅ GÁN ĐÚNG ID
            document.getElementById("complainModal").style.display = "block";
        }

        // Đóng modal
        function closeComplaintModal() {
            document.getElementById("complainModal").style.display = "none";
        }

        function submitComplaint() {
            const selectedReason = document.getElementById("complaintReason").value;

            if (!selectedReason) {
                alert("Vui lòng chọn lý do khiếu nại!");
                return;
            }

            const note = document.getElementById("complaintNote").value || "";

            fetch("<?php echo $_SERVER['PHP_SELF']; ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "action=complaint" +
                    "&id=" + encodeURIComponent(complaintInvoiceId) +
                    "&reason=" + encodeURIComponent(selectedReason) +
                    "&note=" + encodeURIComponent(note)
            })
                .then(r => r.text())
                .then(res => {
                    alert("✅ Đã gửi khiếu nại!");
                    closeComplaintModal();
                })
                .catch(err => {
                    alert("❌ Lỗi gửi khiếu nại!");
                    console.error(err);
                });
        }
        document.querySelectorAll(".reason-item").forEach(item => {
            item.addEventListener("click", function () {

                document.querySelectorAll(".reason-item")
                    .forEach(i => i.classList.remove("active"));

                this.classList.add("active");

                selectedReason = this.getAttribute("data-value"); // ✅ CHUẨN
            });
        });


        const chatux = (typeof ChatUx !== "undefined") ? new ChatUx() : null;
        if (chatux) {
            const opt = {
                api: {
                    endpoint: 'http://localhost/chat/chat-server.php',
                    method: 'GET',
                    dataType: 'jsonp',
                    escapeUserInput: true
                },
                window: {
                    title: 'My chat',
                    size: {
                        width: 350,
                        height: 500,
                        minWidth: 300,
                        minHeight: 300,
                        titleHeight: 50
                    },
                    appearance: {
                        border: {
                            shadow: '2px 2px 10px rgba(0,0,0,.5)',
                            width: 0,
                            radius: 6
                        },
                        titleBar: {
                            fontSize: 14,
                            color: 'white',
                            background: '#4784d4',
                            leftMargin: 40,
                            height: 40,
                            buttonWidth: 36,
                            buttonHeight: 16,
                            buttonColor: 'white',
                            buttons: [{
                                fa: 'fas fa-times',
                                name: 'hideButton',
                                visible: true
                            }],
                            buttonsOnLeft: [{
                                fa: 'fas fa-comment-alt',
                                name: 'info',
                                visible: true
                            }]
                        },
                    }
                },
            };
            chatux.init(opt);
            chatux.start(true);
        }
    </script>

    <script>
        const USER_ROLE = "<?php echo $_SESSION['role'] ?? ''; ?>";
        const INVOICES = <?php echo json_encode($invoices, JSON_UNESCAPED_UNICODE); ?>;

        function fmtVND(n) {
            return new Intl.NumberFormat('vi-VN').format(Math.round(+n || 0));
        }

        function toDMY(iso) {
            if (!iso) return '';
            const d = new Date(iso);
            const dd = String(d.getDate()).padStart(2, '0');
            const mm = String(d.getMonth() + 1).padStart(2, '0');
            const yy = d.getFullYear();
            return `${dd}/${mm}/${yy}`;
        }

        let pageIndex = 0;
        let pageSize = 5;
        let totalPages = 1;

        function calcTotalPages() {
            if (pageSize === -1) return 1;
            return Math.max(1, Math.ceil(INVOICES.length / pageSize));
        }

        function sliceData() {
            if (pageSize === -1) return INVOICES;
            const start = pageIndex * pageSize;
            return INVOICES.slice(start, start + pageSize);
        }

        function renderTable() {
            const tbody = document.getElementById('debt-tbody');
            tbody.innerHTML = '';
            const rows = sliceData();

            if (INVOICES.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6">Không có dữ liệu công nợ.</td></tr>';
            }

            rows.forEach(inv => {
                const id = String(inv.id || '');
                const SVD = String(inv.SVD || '');
                const date = toDMY(inv.issued_date);
                const due = toDMY(inv.due_date);
                const total = fmtVND(inv.total_amount || 0);
                // Trạng thái hiển thị cho người dùng
                let statusText = 'Chưa thanh toán';
                if (inv.status === 'done') {
                    statusText = 'Đã thanh toán';
                } else if (inv.late_fee > 0) {
                    statusText = 'Quá hạn (' + fmtVND(inv.late_fee) + ' đ phí phạt)';
                }

                const isDone = (inv.status === 'done');

                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${escapeHtml(SVD)}</td>
                    <td>${date}</td>
                    <td>${total} đ</td>
                    <td>${statusText}</td>
                    <td>${due}</td>
                    <td>
                    ${USER_ROLE === 'customer'
                        ? (
                            isDone
                                ? '<button class="pay-btn disabled" disabled>Đã thanh toán</button>'
                                : `<button class="pay-btn" onclick="openPayModal('${escapeAttr(id)}', ${Math.round(inv.total_amount || 0)})">Thanh toán</button>`
                        )
                        : ''
                    }

                        ${USER_ROLE === 'customer'
                        ? `<br><button class="complain-btn" onclick="openComplaintModal('${escapeAttr(id)}')">Khiếu nại</button>`
                        : ''
                    }
                    </td>
                `;
                tbody.appendChild(tr);
            });
            totalPages = calcTotalPages();
            const info = document.getElementById('pgInfo');
            info.textContent = `Trang ${totalPages === 0 ? 0 : pageIndex + 1}/${totalPages}`;

            document.getElementById('pgPrev').disabled = (pageIndex <= 0);
            document.getElementById('pgNext').disabled = (pageIndex >= totalPages - 1);
        }

        function gotoPrevPage() {
            if (pageIndex > 0) {
                pageIndex--;
                renderTable();
            }
        }

        function gotoNextPage() {
            if (pageIndex < totalPages - 1) {
                pageIndex++;
                renderTable();
            }
        }

        function changePageSize(val) {
            pageSize = parseInt(val, 10);
            pageIndex = 0;
            renderTable();
        }

        function openDebtModal() {
            document.getElementById('debtModal').style.display = 'block';
            document.getElementById('pgSize').value = String(pageSize);
            renderTable();
        }

        function closeDebtModal() {
            document.getElementById('debtModal').style.display = 'none';
        }

        // Biến toàn cục để lưu ID hóa đơn đang được thanh toán
        let currentInvoiceId = '';

        function openPayModal(invoiceId, amount) {
            currentInvoiceId = invoiceId; // Lưu ID hóa đơn

            const bankCode = 'VPB';
            const account = '0383671656';
            const addInfo = encodeURIComponent(`TT ${invoiceId}`);
            const qrUrl =
                `https://img.vietqr.io/image/${bankCode}-${account}-print.png?amount=${amount}&addInfo=${addInfo}`;

            document.getElementById('payQR').src = qrUrl;
            document.getElementById('paySub').textContent = `Hóa đơn: ${invoiceId}`;
            document.getElementById('payDesc').textContent = `Số tiền: ${fmtVND(amount)} đ • Quét mã VietQR để thanh toán.`;

            // Cập nhật onclick cho nút "Đã Chuyển Khoản"
            document.getElementById('btnPaidNotify').setAttribute('onclick', `markAsPaid('${escapeAttr(invoiceId)}')`);

            const pm = document.getElementById('payModal');
            pm.style.display = 'block';
        }

        function closePayModal() {
            const pm = document.getElementById('payModal');
            pm.style.display = 'none';
            currentInvoiceId = ''; // Xóa ID hóa đơn khi đóng modal
        }

        /**
         * Hàm gửi thông báo đã thanh toán bằng QR/Chuyển khoản đến Admin
         * @param {string} invoiceId - Số vận đơn/ID hóa đơn
         */
        function markAsPaid(invoiceId) {
            if (!invoiceId) {
                alert('Lỗi: Không tìm thấy ID hóa đơn.');
                return;
            }

            // Tìm hóa đơn trong danh sách INVOICES để lấy thông tin chi tiết (nếu cần)
            const invoice = INVOICES.find(inv => inv.id === invoiceId);

            // Nếu bạn đang dùng SVD làm ID, hãy dùng nó để hiển thị trong confirm
            const SVD = invoice?.SVD || '';
            const loai = invoice?.loai || '';

            const confirmed = confirm(
                `Bạn có chắc chắn muốn báo đã chuyển khoản cho hóa đơn này không? Admin sẽ kiểm tra và cập nhật trạng thái.`
            );

            if (confirmed) {
                // Lấy User ID đã được nhúng từ PHP
                const userId = <?php echo $userId; ?>;

                // Vô hiệu hóa nút báo cáo tạm thời để tránh spam
                const btn = document.getElementById('btnPaidNotify');
                btn.disabled = true;
                btn.textContent = 'Đang gửi...';

                // Gửi yêu cầu AJAX (Fetch API) đến server
                fetch('payment_notify.php', { // <--- ĐƯỜNG DẪN DÙNG TRONG PHP BACKEND BÊN DƯỚI
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id: invoiceId,
                        SVD: SVD,
                        loai: loai,
                        action: 'notify_transfer' // Thao tác cụ thể
                    })
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Lỗi Server hoặc mạng lưới.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            alert(`✅ Đã gửi thông báo thanh toán thành công cho hóa đơn! Vui lòng chờ Admin xác nhận.`);
                            closePayModal();
                        } else {
                            alert(`❌ Gửi thông báo thất bại: ${data.message}`);
                        }
                    })
                    .catch(error => {
                        console.error('Lỗi khi gửi thông báo:', error);
                        alert('⚠️ Lỗi kết nối hoặc xử lý. Vui lòng kiểm tra console hoặc thử lại.');
                    })
                    .finally(() => {
                        if (btn) {
                            btn.disabled = false;
                            btn.textContent = '✅ Đã Chuyển Khoản (Báo Admin)';
                        }
                    });
            }
        }

        function escapeHtml(str) {
            return String(str)
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;')
                .replaceAll("'", '&#039;');
        }

        function escapeAttr(str) {
            return escapeHtml(str).replaceAll('"', '&quot;');
        }
        document.addEventListener('DOMContentLoaded', () => { });
        window.openDebtModal = openDebtModal;
        window.closeDebtModal = closeDebtModal;
        window.gotoPrevPage = gotoPrevPage;
        window.gotoNextPage = gotoNextPage;
        window.changePageSize = changePageSize;
        window.openPayModal = openPayModal;
        window.closePayModal = closePayModal;
        window.markAsPaid = markAsPaid; // Đưa hàm mới ra window scope
        function openComplaintPage(invoiceId) {
            if (!invoiceId) return alert("Không tìm thấy ID hóa đơn!");
            window.location.href = "khieunai.php?id=" + encodeURIComponent(invoiceId);
        }
        window.openComplaintPage = openComplaintPage;
    </script>

</body>

</html>
<?php include_once(__DIR__ . '/../public/footer.php'); ?>