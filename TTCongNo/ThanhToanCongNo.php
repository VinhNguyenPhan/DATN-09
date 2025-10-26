<?php 
    include_once(__DIR__.'/../public/header.php');
    require_role(['customer','admin','accounting']);
    if (empty($_SESSION['user_id'])) {
        $redirect = '/DangNhap-DangKyTK/DangNhapDangKyTK.php?next=' . urlencode($_SERVER['REQUEST_URI']);
        header("Location: $redirect");
        exit;
    }

    function formatCurrencyVND($amount){
        $amount = (float)$amount;
        return number_format($amount, 0, ',', '.');
    }

    function calculateLateFee($baseAmount, $dueDate, $ratePerDayPercent = 0.05){
        $baseAmount = (float)$baseAmount;
        $due = strtotime($dueDate);
        $today = strtotime(date('Y-m-d'));
        if($due === false) return 0;
        $daysLate = max(0, (int) floor(($today - $due) / 86400));
        if($daysLate <= 0) return 0;
        $rate = ($ratePerDayPercent / 100.0);
        return $baseAmount * $rate * $daysLate;
    }

    function fetchInvoicesFromDb($conn, $userId){
        $rows = [];
        try{
            if(!$userId) return $rows;
            $sql = "SELECT id, issued_date, goods_amount, freight_fee, due_date, status FROM invoices WHERE user_id = ? ORDER BY issued_date DESC";
            $stmt = $conn->prepare($sql);
            if(!$stmt) return $rows;
            $stmt->bind_param('i', $userId);
            $stmt->execute();
            $res = $stmt->get_result();
            while($r = $res->fetch_assoc()){
                $rows[] = [
                    'id' => (string)$r['id'],
                    'issued_date' => $r['issued_date'] ?: '',
                    'goods_amount' => (float)$r['goods_amount'],
                    'freight_fee' => (float)$r['freight_fee'],
                    'due_date' => $r['due_date'] ?: '',
                    'status' => $r['status'] ?: 'unpaid',
                ];
            }
        }catch(Throwable $e){}
        return $rows;
    }

    $invoices = fetchInvoicesFromDb($conn, (int)($_SESSION['user_id'] ?? 0));
    if(empty($invoices)){
        $invoices = [
            ['id'=>'HD001','issued_date'=>'2025-10-01','goods_amount'=>4800000,'freight_fee'=>200000,'due_date'=>'2025-10-10','status'=>'unpaid'],
            ['id'=>'HD002','issued_date'=>'2025-09-15','goods_amount'=>3000000,'freight_fee'=>200000,'due_date'=>'2025-09-20','status'=>'paid']
        ];
    }

    foreach($invoices as $idx => $inv){
        $base = (float)$inv['goods_amount'] + (float)$inv['freight_fee'];
        $lateFee = calculateLateFee($base, $inv['due_date']);
        $total = $base + $lateFee;
        $invoices[$idx]['base_amount'] = $base;
        $invoices[$idx]['late_fee'] = $lateFee;
        $invoices[$idx]['total_amount'] = $total;
    }
?>

<script>
const chatux = new ChatUx();

const opt = {
    api: {
        endpoint: 'http://localhost/chat/chat-server.php',
        method: 'GET',
        dataType: 'jsonp',
        escapeUserInput: true
    },
    window: {
        title: 'My chat', //window title 
        size: {
            width: 350, //window width in px
            height: 500, //window height in px
            minWidth: 300, //window minimum-width in px
            minHeight: 300, //window minimum-height in px
            titleHeight: 50 //title bar height in px
        },
        appearance: {
            //border - border style of the window
            border: {
                shadow: '2px 2px 10px  rgba(0, 0, 0, 0.5)',
                width: 0,
                radius: 6
            },
            //titleBar - title style of the window
            titleBar: {
                fontSize: 14,
                color: 'white',
                background: '#4784d4',
                leftMargin: 40,
                height: 40,
                buttonWidth: 36,
                buttonHeight: 16,
                buttonColor: 'white',
                buttons: [
                    //Icon named 'hideButton' to close chat window
                    {
                        fa: 'fas fa-times', //specify font awesome icon
                        name: 'hideButton',
                        visible: true
                    }
                ],
                buttonsOnLeft: [
                    //Icon named 'info' to jump to 'infourl' when clicked
                    {
                        fa: 'fas fa-comment-alt', //specify font awesome icon
                        name: 'info',
                        visible: true
                    }
                ],
            },
        }
    },
};

chatux.init(opt);
chatux.start(true);
</script>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Theo dõi công nợ & Thanh toán online</title>
    <style>
    body {
        font-family: "Inter", sans-serif;
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
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        text-align: center;
        max-width: 600px;
        width: 100%;
        transition: transform 0.3s ease;
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
        transition: background 0.3s, transform 0.2s;
    }

    .card .btn:hover {
        background: #155b8a;
        transform: scale(1.05);
    }

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
        margin: 5% auto;
        padding: 30px;
        border-radius: 16px;
        width: 90%;
        max-width: 900px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
    }

    .close {
        float: right;
        font-size: 28px;
        font-weight: bold;
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
    }

    .debt-table th,
    .debt-table td {
        border: 1px solid #ddd;
        padding: 12px;
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
        padding: 10px 16px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
        transition: background 0.3s, transform 0.2s;
    }

    .pay-btn:hover {
        background: #0d946b;
        transform: scale(1.05);
    }

    .pay-btn.disabled {
        background: gray;
        cursor: not-allowed;
    }

    #qrSection {
        display: none;
        text-align: center;
        margin-top: 25px;
        padding-top: 15px;
        border-top: 1px solid #ddd;
    }

    #qrSection h3 {
        color: #1f3c88;
        margin-bottom: 12px;
    }

    #qrImage {
        width: 220px;
        height: auto;
        margin-top: 12px;
        border: 4px solid #1f6fb2;
        border-radius: 14px;
    }

    #qrDesc {
        color: #333;
        margin-top: 10px;
        font-size: 15px;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
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

        #qrImage {
            width: 180px;
        }
    }
    </style>
</head>

<body>

    <div class="container">
        <div class="card">
            <div class="icon">💳</div>
            <h3>Theo dõi công nợ & Thanh toán online</h3>
            <p>Xem công nợ còn lại, lịch sử thanh toán và thực hiện thanh toán trực tuyến an toàn.</p>
            <button class="btn" onclick="openDebtModal()">Xem chi tiết</button>
        </div>
    </div>

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
                    <?php foreach($invoices as $inv): 
                    $displayDate = date('d/m/Y', strtotime($inv['issued_date']));
                    $displayDue = date('d/m/Y', strtotime($inv['due_date']));
                    $displayAmount = formatCurrencyVND($inv['total_amount']);
                    $isPaid = $inv['status'] === 'paid';
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($inv['id']); ?></td>
                        <td><?php echo $displayDate; ?></td>
                        <td><?php echo $displayAmount; ?> đ</td>
                        <td><?php echo $isPaid ? 'Đã thanh toán' : 'Chưa thanh toán'; ?></td>
                        <td><?php echo $displayDue; ?></td>
                        <td>
                            <?php if($isPaid): ?>
                            <button class="pay-btn disabled">Đã thanh toán</button>
                            <?php else: ?>
                            <button class="pay-btn"
                                onclick="showQR('<?php echo htmlspecialchars($inv['id']); ?>', <?php echo (int) round($inv['total_amount']); ?>)">Thanh
                                toán</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div id="qrSection">
                <h3>Quét mã QR để thanh toán</h3>
                <img id="qrImage" src="" alt="QR Code Thanh Toán">
                <p id="qrDesc"></p>
            </div>
        </div>
    </div>

    <script>
    function openDebtModal() {
        document.getElementById("debtModal").style.display = "block";
    }

    function closeDebtModal() {
        document.getElementById("debtModal").style.display = "none";
        document.getElementById("qrSection").style.display = "none";
    }

    function showQR(invoiceId, amount) {
        const qrSection = document.getElementById("qrSection");
        const qrImage = document.getElementById("qrImage");
        const qrDesc = document.getElementById("qrDesc");

        const yourQR = "https://img.vietqr.io/image/VPB-0383671656-print.png";
        qrImage.src = yourQR;
        const amountFormatted = new Intl.NumberFormat('vi-VN').format(amount);
        qrDesc.textContent = `Hóa đơn: ${invoiceId} | Số tiền: ${amountFormatted} đ | Vui lòng quét mã để thanh toán.`;

        qrSection.style.display = "block";
    }
    </script>

</body>

</html>
<?php include_once(__DIR__.'/../public/footer.php'); ?>