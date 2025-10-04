<!-- Card chức năng -->
<div class="card">
    <div class="icon">💳</div>
    <h3>Theo dõi công nợ & Thanh toán online</h3>
    <p>Xem công nợ còn lại, lịch sử thanh toán và thực hiện thanh toán trực tuyến an toàn.</p>
    <button class="btn" onclick="openDebtModal()">Xem chi tiết</button>
</div>

<!-- Modal hiển thị công nợ -->
<div id="debtModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeDebtModal()">&times;</span>
        <h2>Công nợ & Thanh toán online</h2>

        <!-- Bảng công nợ -->
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

<!-- CSS -->
<style>
.card {
    background: #fff;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.card .icon {
    font-size: 32px;
    margin-bottom: 10px;
}

.card h3 {
    font-size: 18px;
    margin-bottom: 8px;
}

.card p {
    font-size: 14px;
    color: #555;
}

.card .btn {
    margin-top: 12px;
    background: #2563eb;
    color: #fff;
    border: none;
    padding: 8px 16px;
    border-radius: 8px;
    cursor: pointer;
}

.card .btn:hover {
    background: #1e40af;
}

/* Modal */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
}

.modal-content {
    background: #fff;
    margin: 8% auto;
    padding: 20px;
    border-radius: 12px;
    width: 80%;
    max-width: 800px;
}

.close {
    float: right;
    font-size: 24px;
    cursor: pointer;
}

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
    background: #2563eb;
    color: #fff;
}

.pay-btn {
    background: #10b981;
    color: white;
    border: none;
    padding: 6px 12px;
    border-radius: 6px;
    cursor: pointer;
}

.pay-btn.disabled {
    background: gray;
    cursor: not-allowed;
}
</style>

<!-- JavaScript -->
<script>
function openDebtModal() {
    document.getElementById("debtModal").style.display = "block";
}

function closeDebtModal() {
    document.getElementById("debtModal").style.display = "none";
}
</script>