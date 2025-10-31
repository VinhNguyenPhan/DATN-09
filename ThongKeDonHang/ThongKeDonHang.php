<?php
require_once(__DIR__ . "/../public/header.php");

require_role(['admin']);
if (empty($_SESSION['user_id'])) {
    $redirect = '/DangNhap-DangKyTK/DangNhapDangKyTK.php?next=' . urlencode($_SERVER['REQUEST_URI']);
    header("Location: $redirect");
    exit;
}

// --- KHỞI TẠO BIẾN THỐNG KÊ TỔNG ---
$counts = [
    'shipped' => 0,   // ĐÃ LẤY HÀNG
    'shipping' => 0,   // ĐANG GIAO
    'done' => 0,   // HOÀN THÀNH
    'cancel' => 0    // ĐÃ HỦY
];

// --- LẤY TỔNG ĐƠN HÀNG 12 THÁNG GẦN NHẤT ---
foreach (['to1XK', 'to1NK'] as $table) {
    $sql = "SELECT ThongKe, COUNT(*) as total
            FROM $table
            WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH)
            GROUP BY ThongKe";
    if ($res = $conn->query($sql)) {
        while ($row = $res->fetch_assoc()) {
            $stt = strtolower(trim($row['ThongKe']));
            if (str_contains($stt, 'shipped'))
                $counts['shipped'] += (int) $row['total'];
            elseif (str_contains($stt, 'shipping'))
                $counts['shipping'] += (int) $row['total'];
            elseif (str_contains($stt, 'done'))
                $counts['done'] += (int) $row['total'];
            elseif (str_contains($stt, 'cancel'))
                $counts['cancel'] += (int) $row['total'];
        }
    }
}

// --- LẤY DỮ LIỆU BIỂU ĐỒ CỘT THEO THÁNG (12 tháng, hiển thị 6 tháng gần nhất) ---
$monthStats = [
    'shipped' => array_fill(1, 12, 0),
    'shipping' => array_fill(1, 12, 0),
    'done' => array_fill(1, 12, 0),
    'cancel' => array_fill(1, 12, 0),
];

foreach (['to1XK', 'to1NK'] as $table) {
    $sql = "
        SELECT MONTH(created_at) AS thang, ThongKe, COUNT(*) AS total
        FROM $table
        WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH)
        GROUP BY thang, ThongKe
    ";
    if ($res = $conn->query($sql)) {
        while ($row = $res->fetch_assoc()) {
            $month = (int) $row['thang'];
            if ($month < 1 || $month > 12)
                continue;
            $stt = strtolower(trim($row['ThongKe']));
            if (str_contains($stt, 'shipped'))
                $monthStats['shipped'][$month] += (int) $row['total'];
            elseif (str_contains($stt, 'shipping'))
                $monthStats['shipping'][$month] += (int) $row['total'];
            elseif (str_contains($stt, 'done'))
                $monthStats['done'][$month] += (int) $row['total'];
            elseif (str_contains($stt, 'cancel'))
                $monthStats['cancel'][$month] += (int) $row['total'];
        }
    }
}

// --- CHUẨN BỊ DỮ LIỆU GỬI SANG JS ---
$currentMonth = (int) date('n');
$months = [];
for ($i = 5; $i >= 0; $i--) { // 6 tháng gần nhất
    $m = $currentMonth - $i;
    if ($m <= 0)
        $m += 12;
    $months[] = $m;
}

$jsMonths = json_encode(array_map(fn($m) => "Tháng $m", $months), JSON_UNESCAPED_UNICODE);
$jsShipped = json_encode(array_map(fn($m) => $monthStats['shipped'][$m] ?? 0, $months));
$jsShipping = json_encode(array_map(fn($m) => $monthStats['shipping'][$m] ?? 0, $months));
$jsDone = json_encode(array_map(fn($m) => $monthStats['done'][$m] ?? 0, $months));
$jsCancel = json_encode(array_map(fn($m) => $monthStats['cancel'][$m] ?? 0, $months));

$totalOrders = ($counts['shipped'] + $counts['shipping'] + $counts['done'] + $counts['cancel']);
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
        /* lấy hàng */
        --orange-1: #e67e22;
        /* đang giao */
        --blue-1: #2980b9;
        /* hoàn thành */
        --red-1: #c0392b;
        /* hủy */

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

    /* ======= PAGE HEADER ======= */
    .page {
        max-width: 1240px;
        margin: 0 auto;
        padding: 28px 20px 40px;
    }

    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 22px;
    }

    .page .title-wrap {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .page .title {
        margin: 0;
        font-size: 28px;
        font-weight: 800;
        letter-spacing: .2px;
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

    /* ======= LAYOUT ======= */
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

    /* LEFT COLUMN */
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

    /* RIGHT COLUMN (bar chart) */
    .right-col .panel {
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .right-col .chart-wrap {
        min-height: 420px;
    }

    /* Optional helper */
    main {
        display: block
    }
</style>

<div class="page">
    <!-- ======= HEADER + SUMMARY ======= -->
    <div class="page-header">
        <div class="title-wrap">
            <h1 class="title">Thống kê đơn hàng (12 tháng gần nhất)</h1>
            <p class="subtitle">Cập nhật lần cuối: <?= htmlspecialchars($lastUpdated) ?> · Tổng đơn:
                <strong><?= number_format($totalOrders, 0, ',', '.') ?></strong>
            </p>
        </div>
    </div>

    <!-- ======= DASHBOARD ======= -->
    <div class="dashboard">
        <!-- LEFT -->
        <div class="left-col">
            <!-- Tiêu đề khu trạng thái -->
            <div class="panel" style="padding:12px 16px">
                <h3 class="panel-title" style="margin:0">Tổng quan trạng thái</h3>
            </div>

            <div class="status-grid">
                <div class="card lay">
                    <div class="label">ĐÃ LẤY HÀNG</div>
                    <div class="value"><?= number_format($counts['shipped'], 0, ',', '.') ?> ĐH</div>
                </div>
                <div class="card giao">
                    <div class="label">ĐANG GIAO</div>
                    <div class="value"><?= number_format($counts['shipping'], 0, ',', '.') ?> ĐH</div>
                </div>
                <div class="card thanhcong">
                    <div class="label">HOÀN THÀNH</div>
                    <div class="value"><?= number_format($counts['done'], 0, ',', '.') ?> ĐH</div>
                </div>
                <div class="card huy">
                    <div class="label">ĐÃ HỦY</div>
                    <div class="value"><?= number_format($counts['cancel'], 0, ',', '.') ?> ĐH</div>
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

        <!-- RIGHT -->
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
    // BAR CHART
    const labels = <?= $jsMonths ?>;
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Đã lấy',
                data: <?= $jsShipped ?>,
                backgroundColor: '#16a085'
            },
            {
                label: 'Đang giao',
                data: <?= $jsShipping ?>,
                backgroundColor: '#e67e22'
            },
            {
                label: 'Hoàn thành',
                data: <?= $jsDone ?>,
                backgroundColor: '#2980b9'
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

    // PIE / DOUGHNUT CHART
    new Chart(document.getElementById('pieChart'), {
        type: 'doughnut',
        data: {
            labels: ['Đã lấy', 'Đang giao', 'Hoàn thành', 'Đã hủy'],
            datasets: [{
                data: [
                    <?= (int) $counts['shipped'] ?>,
                    <?= (int) $counts['shipping'] ?>,
                    <?= (int) $counts['done'] ?>,
                    <?= (int) $counts['cancel'] ?>
                ],
                backgroundColor: ['#16a085', '#e67e22', '#2980b9', '#c0392b']
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