<?php
require_once(__DIR__ . "/../public/header.php");

require_role(['admin']);
if (empty($_SESSION['user_id'])) {
    $redirect = '/DangNhap-DangKyTK/DangNhapDangKyTK.php?next=' . urlencode($_SERVER['REQUEST_URI']);
    header("Location: $redirect");
    exit;
}

$counts = [
    'cancel' => 0,
    'declarating' => 0,
    'declaration' => 0
];

foreach (['to1XK', 'to1NK'] as $table) {
    $sql = "SELECT ThongKeTK, COUNT(*) as total
            FROM $table
            WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH)
            GROUP BY ThongKeTK";
    if ($res = $conn->query($sql)) {
        while ($row = $res->fetch_assoc()) {
            $stt = strtolower(trim($row['ThongKeTK']));
            if (str_contains($stt, 'declaration'))
                $counts['declaration'] += (int) $row['total'];
            elseif (str_contains($stt, 'declarating'))
                $counts['declarating'] += (int) $row['total'];
            elseif (str_contains($stt, 'cancel'))
                $counts['cancel'] += (int) $row['total'];
        }
    }
}
$monthStats = [
    'declaration' => array_fill(1, 12, 0),
    'declarating' => array_fill(1, 12, 0),
    'cancel' => array_fill(1, 12, 0),
];

foreach (['to1XK', 'to1NK'] as $table) {
    $sql = "
        SELECT MONTH(created_at) AS thang, ThongKeTK, COUNT(*) AS total
        FROM $table
        WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH)
        GROUP BY thang, ThongKeTK
    ";
    if ($res = $conn->query($sql)) {
        while ($row = $res->fetch_assoc()) {
            $month = (int) $row['thang'];
            if ($month < 1 || $month > 12)
                continue;
            $stt = strtolower(trim($row['ThongKeTK']));
            if (str_contains($stt, 'declaration'))
                $monthStats['declaration'][$month] += (int) $row['total'];
            elseif (str_contains($stt, 'declarating'))
                $monthStats['declarating'][$month] += (int) $row['total'];
            elseif (str_contains($stt, 'cancel'))
                $monthStats['cancel'][$month] += (int) $row['total'];
        }
    }
}

$currentMonth = (int) date('n');
$months = [];
for ($i = 5; $i >= 0; $i--) {
    $m = $currentMonth - $i;
    if ($m <= 0)
        $m += 12;
    $months[] = $m;
}

$jsMonths = json_encode(array_map(fn($m) => "Tháng $m", $months), JSON_UNESCAPED_UNICODE);
$jsDeclaration = json_encode(array_map(fn($m) => $monthStats['declaration'][$m] ?? 0, $months));
$jsDeclarating = json_encode(array_map(fn($m) => $monthStats['declarating'][$m] ?? 0, $months));
$jsCancel = json_encode(array_map(fn($m) => $monthStats['cancel'][$m] ?? 0, $months));

$totalOrders = ($counts['declaration'] + $counts['declarating'] + $counts['cancel']);
$lastUpdated = date('d/m/Y H:i');
?>
<meta charset="UTF-8">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    :root {
        --bg: #f5f7fb;
        --card: #ffffff;
        --text: #0f172a;
        --muted: #6b7280;
        --ring: #e5e7eb;

        --green-1: #16a085;
        --orange-1: #e67e22;
        --blue-1: #2980b9;
        --red-1: #c0392b;

        --shadow: 0 10px 25px rgba(2, 6, 23, .08);
        --radius: 14px;
    }

    * {
        box-sizing: border-box
    }

    body {
        background: var(--bg);
        font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
        margin: 0;
        color: var(--text);
    }

    .page {
        max-width: 1240px;
        margin: 0 auto;
        padding: 28px 20px 40px;
    }

    .page-header {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        margin-bottom: 22px;
        flex-direction: column;
        text-align: center;
    }

    .page .title-wrap {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .page .title {
        font-size: 30px;
        font-weight: 800;
        color: #0D47A1;
        letter-spacing: 1px;
        text-transform: uppercase;
        display: inline-block;
        position: relative;
    }

    .subtitle {
        margin: 0;
        font-size: 14px;
        color: var(--muted);
    }

    .summary-badges {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .badge {
        background: var(--card);
        border: 1px solid var(--ring);
        border-radius: 999px;
        padding: 8px 12px;
        box-shadow: var(--shadow);
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: #111827;
    }

    .dot {
        width: 10px;
        height: 10px;
        border-radius: 999px;
        display: inline-block
    }

    .dashboard {
        display: grid;
        grid-template-columns: 1.1fr 2fr;
        gap: 22px;
    }

    @media (max-width: 980px) {
        .dashboard {
            grid-template-columns: 1fr;
        }
    }

    .left-col {
        display: flex;
        flex-direction: column;
        gap: 22px;
    }

    .status-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 12px;
    }

    .card {
        background: var(--card);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        border: 1px solid var(--ring);
        padding: 14px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .card .label {
        font-weight: 700;
        font-size: 14px;
        letter-spacing: .2px;
    }

    .card .value {
        font-weight: 800;
        font-size: 18px;
    }

    .card.lay .label {
        color: var(--green-1)
    }

    .card.giao .label {
        color: var(--orange-1)
    }

    .card.thanhcong .label {
        color: var(--blue-1)
    }

    .card.huy .label {
        color: var(--red-1)
    }

    .panel {
        background: var(--card);
        border: 1px solid var(--ring);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        padding: 18px;
    }

    .panel-title {
        margin: 0 0 12px 0;
        font-size: 16px;
        font-weight: 700;
        letter-spacing: .2px;
    }

    .panel-sub {
        margin: 0 0 8px 0;
        color: var(--muted);
        font-size: 13px;
    }

    .chart-wrap {
        position: relative;
        width: 100%;
        min-height: 300px;
    }

    .right-col .panel {
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .right-col .chart-wrap {
        min-height: 420px;
    }

    main {
        display: block
    }
</style>

<div class="page">
    <div class="page-header">
        <div class="title-wrap">
            <h1 class="title">Thống kê tờ khai </h1>
            <p class="subtitle">Cập nhật lần cuối: <?= htmlspecialchars($lastUpdated) ?> · Tổng tờ khai:
                <strong><?= number_format($totalOrders, 0, ',', '.') ?></strong>
            </p>
        </div>
    </div>

    <div style="margin: 20px 0; display:flex; align-items:center; gap:12px; flex-wrap:wrap; justify-content:flex-end;">
        <select id="statusSelect" style="padding:8px 12px; border-radius:6px; border:1px solid #ccc;">
            <option value="all">Tất cả</option>
            <option value="declaration">Đã khai báo</option>
            <option value="declarating">Đang khai báo</option>
            <option value="cancel">Đã hủy</option>
        </select>

        <label>
            Từ:
            <input type="date" id="fromDate" style="padding:8px 12px; border-radius:6px; border:1px solid #ccc;">
        </label>

        <label>
            Đến:
            <input type="date" id="toDate" style="padding:8px 12px; border-radius:6px; border:1px solid #ccc;">
        </label>

        <button id="exportExcelBtn" style="
        padding: 10px 18px;
        background-color: #28a745;
        color: #fff;
        border-radius: 8px;
        border: none;
        font-weight: 600;
        cursor: pointer;
    ">
            📄 Xuất Excel
        </button>
    </div>


    <script>
        document.getElementById('exportExcelBtn').addEventListener('click', function () {
            const status = document.getElementById('statusSelect').value;
            const from = document.getElementById('fromDate').value;
            const to = document.getElementById('toDate').value;
            const url =
                `export_tk_excel.php?status=${encodeURIComponent(status)}&from=${encodeURIComponent(from)}&to=${encodeURIComponent(to)}`;
            window.location.href = url;
        });

        function exportExcel() {
            const status = document.getElementById('statusSelect').value;
            const fromDate = document.getElementById('fromDate').value;
            const toDate = document.getElementById('toDate').value;

            const params = new URLSearchParams({
                status,
                fromDate,
                toDate
            });
            window.location.href = 'export_tk_excel.php?' + params.toString();
        }
    </script>

    <div class="dashboard">
        <div class="left-col">
            <h3 style="margin:0; font-size:22px ;">Tổng quan trạng thái</h3>
            <div class="status-grid">
                <div class="card lay">
                    <div class="label">ĐÃ KHAI BÁO</div>
                    <div class="value"><?= number_format($counts['declaration'], 0, ',', '.') ?> TK</div>
                </div>
                <div class="card giao">
                    <div class="label">ĐANG KHAI BÁO</div>
                    <div class="value"><?= number_format($counts['declarating'], 0, ',', '.') ?> TK</div>
                </div>
                <div class="card huy">
                    <div class="label">ĐÃ HỦY</div>
                    <div class="value"><?= number_format($counts['cancel'], 0, ',', '.') ?> TK</div>
                </div>
            </div>

            <div class="panel">
                <h3 class="panel-title">Tỉ trọng trạng thái (12 tháng)</h3>
                <p class="panel-sub">Phân bổ phần trăm giữa các trạng thái đơn hàng.</p>
                <div class="chart-wrap">
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </div>
        <div class="right-col">
            <div class="panel">
                <h3 class="panel-title">Xu hướng theo tháng (6 tháng gần nhất)</h3>
                <p class="panel-sub">Số lượng đơn theo trạng thái qua các tháng.</p>
                <div class="chart-wrap">
                    <canvas id="barChart" height="600"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const labels = <?= $jsMonths ?>;
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Đã khai báo',
                data: <?= $jsDeclaration ?>,
                backgroundColor: '#16a085'
            },
            {
                label: 'Đang khai báo',
                data: <?= $jsDeclarating ?>,
                backgroundColor: '#e67e22'
            },
            {
                label: 'Đã hủy',
                data: <?= $jsCancel ?>,
                backgroundColor: '#c0392b'
            }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    grid: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'bottom'
                },
                title: {
                    display: false
                }
            }
        }
    });
    new Chart(document.getElementById('pieChart'), {
        type: 'doughnut',
        data: {
            labels: ['Đã khai báo', 'Đang khai báo', 'Đã hủy'],
            datasets: [{
                data: [
                    <?= (int) $counts['declaration'] ?>,
                    <?= (int) $counts['declarating'] ?>,
                    <?= (int) $counts['cancel'] ?>
                ],
                backgroundColor: ['#16a085', '#e67e22', '#c0392b']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                title: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function (ctx) {
                            const value = ctx.parsed;
                            const total = <?= (int) $totalOrders ?> || 1;
                            const pct = (value * 100 / total).toFixed(1);
                            return `${ctx.label}: ${value} (${pct}%)`;
                        }
                    }
                }
            },
            cutout: '60%'
        }
    });
</script>

<?php include_once(__DIR__ . '/../public/footer.php'); ?>