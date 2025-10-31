<?php include_once(__DIR__.'/../public/header.php'); ?>

<?php
require_role(['employee','customer','admin']);
// include_once(__DIR__.'/../public/header.php');
if (empty($_SESSION['user_id'])) {
    $redirect = '/DangNhap-DangKyTK/DangNhapDangKyTK.php?next=' . urlencode($_SERVER['REQUEST_URI']);
    header("Location: $redirect");
    exit;
}
// --- LẤY DANH SÁCH ĐƠN HÀNG ---
$sqlXK = "SELECT * FROM to1XK ORDER BY id DESC";
$sqlNK = "SELECT * FROM to1NK ORDER BY id DESC";

$resXK = $conn->query($sqlXK);
$resNK = $conn->query($sqlNK);

$orders = [];
if ($resXK) {
    $xkData = $resXK->fetch_all(MYSQLI_ASSOC);
    foreach ($xkData as &$row) $row['loai'] = 'Xuất khẩu';
    $orders = array_merge($orders, $xkData);
}
if ($resNK) {
    $nkData = $resNK->fetch_all(MYSQLI_ASSOC);
    foreach ($nkData as &$row) $row['loai'] = 'Nhập khẩu';
    $orders = array_merge($orders, $nkData);
}
usort($orders, fn($a,$b)=>strtotime($b['ngay_tao']??'0')<=>strtotime($a['ngay_tao']??'0'));
?>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

<style>
/* Layout container to align spacing with site */
.page-container {
    width: 90%;
}

h2.page-title {
    font-weight: 800;
    font-size: 22px;
    color: var(--blue);
    text-transform: uppercase;
    margin: 0 0 20px 0;
    letter-spacing: 1px;
    text-align: center;
}

/* ===== TIÊU ĐỀ TRANG (h1 căn giữa) ===== */
.page-title {
    background: transparent;
    text-align: center;
    padding: 32px 0 18px;
    box-shadow: none;
}

.page-title h1 {
    font-size: 26px;
    color: #1f6fb2;
    font-weight: 700;
    margin: 0;
    letter-spacing: 0.3px;
}


/* Bộ lọc và tìm kiếm */
.filter-box {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.filter-box input,
.filter-box select {
    padding: 10px 14px;
    border-radius: 10px;
    border: 1px solid #cbd5e1;
    font-size: 15px;
    transition: all 0.2s ease;
}

.filter-box input {
    width: 420px;
    max-width: 90%;
}

.filter-box input:focus,
.filter-box select:focus {
    border-color: var(--blue);
    box-shadow: 0 0 0 2px rgba(31, 111, 178, 0.12);
    outline: none;
}

/* Bảng */
#orderTable {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(31, 111, 178, 0.08);
    overflow: hidden;
}

#orderTable thead {
    background: var(--blue);
    color: #fff;
    text-align: center;
}

#orderTable th,
#orderTable td {
    padding: 12px 10px;
    border-bottom: 1px solid #e2e8f0;
    text-align: center;
    font-size: 15px;
}

#orderTable tbody tr:hover {
    background: rgba(31, 111, 178, 0.05);
}

/* Nút xem */
#orderTable a {
    background: var(--blue);
    color: #fff;
    padding: 6px 12px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: 0.2s;
}

#orderTable a:hover {
    background: var(--blue-600);
}

/* Phân trang */
#pagination {
    margin-top: 20px;
    text-align: center;
}

#pagination button {
    margin: 3px;
    padding: 6px 12px;
    border: 1px solid var(--blue);
    background: #fff;
    color: var(--blue);
    border-radius: 6px;
    cursor: pointer;
    font-weight: 600;
    transition: 0.2s;
}

#pagination button:hover,
#pagination button.active {
    background: var(--blue);
    color: #fff;
}

/* Responsive */
@media (max-width: 768px) {
    .page-container {
        padding: 20px;
    }

    h2.page-title {
        font-size: 18px;
    }

    #orderTable th,
    #orderTable td {
        font-size: 13px;
        padding: 8px;
    }
}
</style>

<div class="page-container">
    <!-- ✅ Tiêu đề trang -->
    <div class="page-title">
        <h1>Tra cứu tờ khai</h1>
    </div>

    <!-- Controls -->
    <div class="filter-box" role="region" aria-label="Bộ lọc và tìm kiếm">
        <input type="text" id="searchBox" placeholder="🔍 Tìm kiếm theo số vận đơn..." aria-label="Tìm kiếm số vận đơn">
        <select id="filterLoai" aria-label="Lọc theo loại">
            <option value="">Tất cả</option>
            <option value="Xuất khẩu">Xuất khẩu</option>
            <option value="Nhập khẩu">Nhập khẩu</option>
        </select>
    </div>

    <!-- Table -->
    <table id="orderTable" aria-describedby="Danh sách đơn hàng">
        <thead>
            <tr>
                <th>STT</th>
                <th>Số vận đơn</th>
                <th>Loại</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody id="orderBody">
            <?php if (!empty($orders)): $i=1; foreach ($orders as $od): ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= htmlspecialchars($od['SVD']) ?></td>
                <td><?= htmlspecialchars($od['loai']) ?></td>
                <td><?= htmlspecialchars($od['trang_thai'] ?? 'Đang xử lý') ?></td>
                <td><?= htmlspecialchars($od['created_at'] ?? '-') ?></td>
                <td>
                    <?php if ($od['loai'] === 'Xuất khẩu'): ?>
                    <a href="/TKXK/hoanThanh.php?id=<?= $od['id'] ?>">Xem</a>
                    <?php else: ?>
                    <a href="/TKNK/done.php?id=<?= $od['id'] ?>" style="background:#155c92;">Xem</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; else: ?>
            <tr>
                <td colspan="6">Không có dữ liệu đơn hàng.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div id="pagination" aria-label="Phân trang"></div>

    <script>
    const rows = Array.from(document.querySelectorAll('#orderTable tbody tr'));
    const searchBox = document.getElementById('searchBox');
    const filterLoai = document.getElementById('filterLoai');
    const tbody = document.getElementById('orderBody');
    const pagination = document.getElementById('pagination');
    const rowsPerPage = 15;
    let currentPage = 1;

    // ✅ Đọc giá trị từ URL nếu có
    const urlParams = new URLSearchParams(window.location.search);
    const searchValue = urlParams.get('search');
    if (searchValue) {
        searchBox.value = searchValue;
    }

    function renderTable() {
        const keyword = searchBox.value.toLowerCase();
        const filter = filterLoai.value;
        const filteredRows = rows.filter(row => {
            const svd = row.cells[1].innerText.toLowerCase();
            const loai = row.cells[2].innerText;
            return svd.includes(keyword) && (!filter || loai === filter);
        });
        const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
        if (currentPage > totalPages) currentPage = 1;

        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        tbody.innerHTML = '';
        filteredRows.slice(start, end).forEach(r => tbody.appendChild(r));
        renderPagination(totalPages);
    }

    function renderPagination(totalPages) {
        pagination.innerHTML = '';
        if (totalPages <= 1) return;
        for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement('button');
            btn.textContent = i;
            if (i === currentPage) btn.classList.add('active');
            btn.addEventListener('click', () => {
                currentPage = i;
                renderTable();
            });
            pagination.appendChild(btn);
        }
    }

    searchBox.addEventListener('keyup', () => {
        currentPage = 1;
        const params = new URLSearchParams(window.location.search);
        params.set('search', searchBox.value);
        window.history.replaceState({}, '', `${location.pathname}?${params}`);
        renderTable();
    });

    filterLoai.addEventListener('change', () => {
        currentPage = 1;
        renderTable();
    });

    renderTable();
    </script>
</div>
<?php include_once(__DIR__.'/../public/footer.php'); ?>

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