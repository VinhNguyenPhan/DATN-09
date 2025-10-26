<?php
    require_once (__DIR__ ."/../core/database.php");
    require_once(__DIR__ . '/../core/phanQuyen.php');
    require_role(['employee','customer','admin']);
    if (empty($_SESSION['user_id'])) {
     $redirect = '/DangNhap-DangKyTK/DangNhapDangKyTK.php?next=' . urlencode($_SERVER['REQUEST_URI']);
     header("Location: $redirect");
     exit;
 }
    if(!$_POST){
        header("Location: To1XK.php");
    }
    $_SESSION['ToXK']['form2'] = $_POST;
?>
<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Danh sách hàng</title>
    <style>
    :root {
        --bg: #f5f7fb;
        --card: #ffffff;
        --accent: #2b6cb0;
        --muted: #6b7280;
        --danger: #e53e3e
    }

    * {
        box-sizing: border-box
    }

    body {
        font-family: Inter, Segoe UI, Roboto, Arial;
        line-height: 1.35;
        margin: 0;
        background: var(--bg);
        color: #0f1724;
        padding: 24px
    }

    .container {
        max-width: 1100px;
        margin: 0 auto
    }

    .button-group {
        text-align: center;
        margin-top: 30px;
    }

    button.red {
        background-color: #d9534f;
    }

    button.red:hover {
        background-color: #c9302c;
    }

    header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 18px
    }

    h2 {
        text-align: center;
        color: #003399;
        margin-bottom: 20px;
    }

    .card {
        background: var(--card);
        border-radius: 12px;
        padding: 18px;
        box-shadow: 0 6px 18px rgba(8, 15, 30, 0.06)
    }

    form .grid {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 10px
    }

    label {
        display: block;
        font-size: 13px;
        color: var(--muted);
        margin-bottom: 6px
    }

    input[type=text],
    input[type=number],
    select,
    textarea {
        width: 100%;
        padding: 8px 10px;
        border-radius: 8px;
        border: 1px solid #d1d5db;
        background: white;
        font-size: 14px
    }

    textarea {
        min-height: 54px
    }

    .col-3 {
        grid-column: span 3
    }

    .col-4 {
        grid-column: span 4
    }

    .col-6 {
        grid-column: span 6
    }

    .col-12 {
        grid-column: span 12
    }

    .actions {
        display: flex;
        gap: 8px;
        align-items: center
    }

    .center {
        margin-top: 20px;
        text-align: center;
    }

    button {
        background: var(--accent);
        color: white;
        border: none;
        padding: 10px 14px;
        border-radius: 8px;
        cursor: pointer
    }

    button.secondary {
        background: #fff;
        border: 1px solid #cbd5e1;
        color: #0f1724
    }

    .table-wrapper {
        overflow: auto;
        margin-top: 14px
    }

    table {
        border-collapse: collapse;
        width: 100%;
        min-width: 1200px
    }

    th,
    td {
        padding: 10px;
        border-bottom: 1px solid #eef2f7;
        text-align: left;
        font-size: 13px
    }

    th {
        background: #fbfdff;
        position: sticky;
        top: 0
    }

    .muted {
        color: var(--muted);
        font-size: 13px
    }

    .right {
        text-align: right
    }

    .small {
        font-size: 12px;
        color: var(--muted)
    }

    .btn-danger {
        background: var(--danger)
    }

    .controls {
        display: flex;
        gap: 8px;
        align-items: center;
        margin-top: 12px
    }

    /* responsive */
    @media (max-width:900px) {

        .col-3,
        .col-4 {
            grid-column: span 12
        }

        .table-wrapper table {
            min-width: 900px
        }
    }
    </style>
</head>

<body>
    <form method="POST" action="xulyXK.php">
        <div class="container">
            <div class="card">
                <h2 class="title">Tờ khai nhập khẩu - Danh sách hàng</h2>
                <div id="mainForm" onsubmit="return false">
                    <div class="grid">
                        <div class="col-3">
                            <label>Số tờ khai</label>
                            <input type="text" name="STK" id="STK" placeholder="VD: TKN000123">
                        </div>
                        <div class="col-3">
                            <label>Ngày</label>
                            <input type="date" name="NGAY" id="NGAY">
                        </div>
                        <div class="col-3">
                            <label>Người khai</label>
                            <input type="text" name="NK" id="NK" placeholder="Tên người/đơn vị" />
                        </div>
                        <div class="col-3">
                            <label>Ghi chú chung</label>
                            <input type="text" name="GCC" id="GCC" placeholder="Ghi chú (nếu có)" />
                        </div>

                        <div class="col-12">
                            <label>Danh sách hàng</label>
                            <div class="table-wrapper">
                                <table id="itemsTable">
                                    <thead>
                                        <tr>
                                            <th style="width:48px">#</th>
                                            <th style="width:110px">Mã HS</th>
                                            <th style="width:220px">Tên hàng / Mô tả</th>
                                            <th style="width:80px">ĐVT</th>
                                            <th style="width:100px">Số lượng</th>
                                            <th style="width:120px">Đơn giá</th>
                                            <th style="width:120px">Trị giá</th>
                                            <th style="width:120px">Nước xuất xứ</th>
                                            <th style="width:120px">Loại bao bì</th>
                                            <th style="width:120px">Số vận đơn / Container</th>
                                            <th style="width:120px">Thuế suất(%)</th>
                                            <th style="width:120px">Tiền thuế</th>
                                            <th style="width:140px">Chứng từ/ Ghi chú</th>
                                            <th style="width:80px">Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody id="itemsBody">
                                    </tbody>
                                </table>
                            </div>
                            <div class="controls">
                                <button type="button" id="addRowBtn">+ Thêm dòng hàng</button>
                                <button type="button" id="cloneRowBtn" class="secondary">Nhân bản dòng</button>
                                <button type="button" id="clearBtn" class="secondary">Xóa tất cả</button>
                                <div style="margin-left:auto;text-align:right">
                                    <div class="small">Tổng trị giá: <span id="totalValue">0</span></div>
                                    <div class="small">Tổng thuế: <span id="totalTax">0</span></div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div style="height:18px"></div>

        </div>

        <template id="rowTemplate">
            <tr>
                <td class="right lineNo"></td>
                <td><input type="text" name="HSC[]" id="HSC" class="hsCode" placeholder="0101.21" /></td>
                <td><input type="text" name="TH[]" id="TH" class="desc" placeholder="Mô tả hàng" /></td>
                <td><input type="text" name="DVT[]" id="DVT" class="unit" placeholder="kg/cái" /></td>
                <td><input type="number" name="SL[]" id="SL" class="qty" min="0" step="any" value="0" /></td>
                <td><input type="number" name="GIA[]" id="GIA" class="unitPrice" min="0" step="any" value="0" /></td>
                <td><input type="number" name="VALUE[]" id="VALUE" class="value" readonly /></td>
                <td><input type="text" name="XX[]" id="XX" class="origin" /></td>
                <td><input type="text" name="BB[]" id="BB" class="pack" /></td>
                <td><input type="text" name="VD[]" id="VD" class="bill" /></td>
                <td><input type="number" name="TS[]" id="TS" class="taxRate" min="0" step="any" value="0" /></td>
                <td><input type="number" name="TT[]" id="TT" class="taxAmount" readonly /></td>
                <td><input type="text" name="GC[]" id="GC" class="docs" /></td>
                <td><button type="button" class="removeBtn btn-danger">X</button></td>
            </tr>
        </template>

        <script>
        const itemsBody = document.getElementById('itemsBody');
        const addRowBtn = document.getElementById('addRowBtn');
        const cloneRowBtn = document.getElementById('cloneRowBtn');
        const clearBtn = document.getElementById('clearBtn');
        const totalValueEl = document.getElementById('totalValue');
        const totalTaxEl = document.getElementById('totalTax');
        const rowTemplate = document.getElementById('rowTemplate');

        function addRow(data) {
            const tr = rowTemplate.content.firstElementChild.cloneNode(true);
            itemsBody.appendChild(tr);
            updateLineNumbers();

            // populate if data passed
            if (data) {
                tr.querySelector('.hsCode').value = data.hs || '';
                tr.querySelector('.desc').value = data.desc || '';
                tr.querySelector('.unit').value = data.unit || '';
                tr.querySelector('.qty').value = data.qty || 0;
                tr.querySelector('.unitPrice').value = data.unitPrice || 0;
                tr.querySelector('.origin').value = data.origin || '';
                tr.querySelector('.pack').value = data.pack || '';
                tr.querySelector('.bill').value = data.bill || '';
                tr.querySelector('.taxRate').value = data.taxRate || 0;
                tr.querySelector('.docs').value = data.docs || '';
            }

            attachRowListeners(tr);
            recalcAll();
            return tr;
        }

        function attachRowListeners(tr) {
            const qty = tr.querySelector('.qty');
            const unitPrice = tr.querySelector('.unitPrice');
            const taxRate = tr.querySelector('.taxRate');
            const removeBtn = tr.querySelector('.removeBtn');

            function onChange() {
                const q = parseFloat(qty.value) || 0;
                const up = parseFloat(unitPrice.value) || 0;
                const rate = parseFloat(taxRate.value) || 0;
                const value = q * up;
                tr.querySelector('.value').value = round(value);
                const tax = value * rate / 100;
                tr.querySelector('.taxAmount').value = round(tax);
                recalcAll();
            }

            qty.addEventListener('input', onChange);
            unitPrice.addEventListener('input', onChange);
            taxRate.addEventListener('input', onChange);
            removeBtn.addEventListener('click', () => {
                tr.remove();
                updateLineNumbers();
                recalcAll();
            });
        }

        function round(v) {
            return Math.round((v + Number.EPSILON) * 100) / 100
        }

        function updateLineNumbers() {
            Array.from(itemsBody.querySelectorAll('tr')).forEach((r, i) => {
                r.querySelector('.lineNo').textContent = i + 1
            });
        }

        function recalcAll() {
            let totalValue = 0,
                totalTax = 0;
            Array.from(itemsBody.querySelectorAll('tr')).forEach(r => {
                const v = parseFloat(r.querySelector('.value').value) || 0;
                const t = parseFloat(r.querySelector('.taxAmount').value) || 0;
                totalValue += v;
                totalTax += t;
            });
            totalValueEl.textContent = round(totalValue).toLocaleString('en-US');
            totalTaxEl.textContent = round(totalTax).toLocaleString('en-US');
        }

        addRowBtn.addEventListener('click', () => addRow());
        cloneRowBtn.addEventListener('click', () => {
            const first = itemsBody.querySelector('tr');
            if (!first) {
                addRow();
                return
            }
            const data = {
                hs: first.querySelector('.hsCode').value,
                desc: first.querySelector('.desc').value,
                unit: first.querySelector('.unit').value,
                qty: first.querySelector('.qty').value,
                unitPrice: first.querySelector('.unitPrice').value,
                origin: first.querySelector('.origin').value,
                pack: first.querySelector('.pack').value,
                bill: first.querySelector('.bill').value,
                taxRate: first.querySelector('.taxRate').value,
                docs: first.querySelector('.docs').value
            };
            addRow(data);
        });

        clearBtn.addEventListener('click', () => {
            if (confirm('Xác nhận xóa tất cả dòng?')) {
                itemsBody.innerHTML = '';
                recalcAll();
            }
        });

        addRow({
            hs: '0101.21',
            desc: 'Mẫu hàng hóa',
            unit: 'cái',
            qty: 10,
            unitPrice: 12.5,
            taxRate: 10,
            origin: 'VN',
            pack: 'Thùng',
            bill: 'BL123',
            docs: 'C/O A'
        });

        function getAllItems() {
            return Array.from(itemsBody.querySelectorAll('tr')).map(r => ({
                lineNo: parseInt(r.querySelector('.lineNo').textContent || 0),
                hs: r.querySelector('.hsCode').value,
                desc: r.querySelector('.desc').value,
                unit: r.querySelector('.unit').value,
                qty: parseFloat(r.querySelector('.qty').value) || 0,
                unitPrice: parseFloat(r.querySelector('.unitPrice').value) || 0,
                value: parseFloat(r.querySelector('.value').value) || 0,
                origin: r.querySelector('.origin').value,
                pack: r.querySelector('.pack').value,
                bill: r.querySelector('.bill').value,
                taxRate: parseFloat(r.querySelector('.taxRate').value) || 0,
                taxAmount: parseFloat(r.querySelector('.taxAmount').value) || 0,
                docs: r.querySelector('.docs').value
            }));
        }

        document.addEventListener('keydown', e => {
            if (e.ctrlKey && e.altKey && e.key.toLowerCase() === 'e') {
                console.log(getAllItems());
                alert('Danh sách hàng đã được xuất ra console (Console sẽ hiển thị 1 JSON array)');
            }
        });
        </script>
        <div class="button-group">
            <button type="button" onclick="window.location.href='../TKXK/to2XK.php'">Trang
                trước</button>
            <button type="submit" name="action" value="save">Lưu</button>
            <button type="button" onclick="timToKhai()">Tìm tờ khai</button>
            <button type="button" class="red" onclick="window.location.href='../index.php'">Đóng</button>
        </div>
        <script>
        function timToKhai() {
            alert("Thực hiện tìm tờ khai...");
        }
        </script>
    </form>
</body>

</html>