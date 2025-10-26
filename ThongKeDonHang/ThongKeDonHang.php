<?php 
require_once(__DIR__."/../public/header.php");
require_role(['admin']);
if (empty($_SESSION['user_id'])) {
    $redirect = '/DangNhap-DangKyTK/DangNhapDangKyTK.php?next=' . urlencode($_SERVER['REQUEST_URI']);
    header("Location: $redirect");
    exit;
}

// --- KHỞI TẠO BIẾN THỐNG KÊ TỔNG ---
$counts = [
    'shipped' => 0,
    'shipping' => 0,
    'done' => 0,
    'cancel' => 0
];

// --- LẤY TỔNG ĐƠN HÀNG ---
foreach (['to1XK', 'to1NK'] as $table) {
    $sql = "SELECT ThongKe, COUNT(*) as total FROM $table  WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH) GROUP BY ThongKe";
    $res = $conn->query($sql);
    if ($res) {
        while ($row = $res->fetch_assoc()) {
            $stt = strtolower(trim($row['ThongKe']));
            if (str_contains($stt, 'shipped')) $counts['shipped'] += $row['total'];
            elseif (str_contains($stt, 'shipping')) $counts['shipping'] += $row['total'];
            elseif (str_contains($stt, 'done')) $counts['done'] += $row['total'];
            elseif (str_contains($stt, 'cancel')) $counts['cancel'] += $row['total'];
        }
    }
}

// --- LẤY DỮ LIỆU BIỂU ĐỒ CỘT THEO THÁNG ---
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
    $res = $conn->query($sql);
    if ($res) {
        while ($row = $res->fetch_assoc()) {
            $month = (int)$row['thang'];
            if ($month < 1 || $month > 12) continue;
            $stt = strtolower(trim($row['ThongKe']));
            if (str_contains($stt, 'shipped')) $monthStats['shipped'][$month] += $row['total'];
            elseif (str_contains($stt, 'shipping')) $monthStats['shipping'][$month] += $row['total'];
            elseif (str_contains($stt, 'done')) $monthStats['done'][$month] += $row['total'];
            elseif (str_contains($stt, 'cancel')) $monthStats['cancel'][$month] += $row['total'];
        }
    }
}

// --- CHUẨN BỊ DỮ LIỆU GỬI SANG JS ---
$currentMonth = (int)date('n');
$months = [];
for ($i = 5; $i >= 0; $i--) { // chỉ lấy 6 tháng gần nhất
    $m = $currentMonth - $i;
    if ($m <= 0) $m += 12;
    $months[] = $m;
}

$jsMonths = json_encode(array_map(fn($m)=>"Tháng $m", $months));
$jsShipped = json_encode(array_map(fn($m)=>$monthStats['shipped'][$m] ?? 0, $months));
$jsShipping = json_encode(array_map(fn($m)=>$monthStats['shipping'][$m] ?? 0, $months));
$jsDone = json_encode(array_map(fn($m)=>$monthStats['done'][$m] ?? 0, $months));
$jsCancel = json_encode(array_map(fn($m)=>$monthStats['cancel'][$m] ?? 0, $months));
?>

<meta charset="UTF-8">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

<style>
.page-title {
    text-align: center;
    font-size: 28px;
    font-weight: 700;
    color: #0056A6;
    margin: 25px 0 30px 0;
}


body {
    background: #f8fafc;
    font-family: "Inter", sans-serif;
    margin: 0;
    padding: 0;
}

/* ======= KHU VỰC DASHBOARD ======= */
.dashboard {
    display: flex;
    justify-content: center;
    align-items: stretch;
    gap: 25px;
    padding: 0 40px 40px;
    max-width: 1200px;
    margin: 0 auto;
}

/* ======= CỘT TRÁI ======= */
.left {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    gap: 20px;
}

/* ======= 4 THẺ TRẠNG THÁI ======= */
.status-cards {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.card {
    background: white;
    border-radius: 10px;
    padding: 12px;
    text-align: center;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s;
    font-weight: bold;
    color: white;
    height: 55px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.card:hover {
    transform: scale(1.03);
}

.card h3 {
    margin: 0;
    font-size: 15px;
}

.card p {
    margin: 0;
    font-size: 13px;
}

.lay {
    background: linear-gradient(135deg, #1abc9c, #16a085);
}

.giao {
    background: linear-gradient(135deg, #f39c12, #e67e22);
}

.thanhcong {
    background: linear-gradient(135deg, #3498db, #2980b9);
}

.huy {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
}

/* ======= BIỂU ĐỒ TRÒN ======= */
.pieCard {
    background: white;
    border-radius: 10px;
    padding: 15px;
    text-align: center;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    height: 300px;
}

.pieCard h3 {
    margin-bottom: 10px;
    font-size: 16px;
    font-weight: 600;
}

/* ======= CỘT PHẢI (BIỂU ĐỒ CỘT) ======= */
.right {
    flex: 2;
    background: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
}


canvas {
    width: 100% !important;
    height: 100% !important;
}

/* ======= ĐÁP ỨNG MÀN HÌNH NHỎ ======= */
@media (max-width: 992px) {
    .dashboard {
        flex-direction: column;
        align-items: center;
    }

    .right {
        width: 100%;
        min-height: 400px;
    }
}
</style>
<div class="dashboard">
    <div class="left">
        <div class="card lay">
            <h3>ĐÃ LẤY HÀNG</h3>
            <p><?=$counts['shipped']??0?> ĐH</p>
        </div>
        <div class="card giao">
            <h3>ĐANG GIAO</h3>
            <p><?=$counts['shipping']??0?> ĐH</p>
        </div>
        <div class="card thanhcong">
            <h3>HOÀN THÀNH</h3>
            <p><?=$counts['done']??0?> ĐH</p>
        </div>
        <div class="card huy">
            <h3>ĐÃ HỦY</h3>
            <p><?=$counts['cancel']??0?> ĐH</p>
        </div>
        <div class="pieCard">
            <h3>Thống kê đơn hàng</h3>
            <canvas id="pieChart"></canvas>
        </div>
    </div>

    <div class="right">
        <canvas id="barChart"></canvas>
    </div>
</div>

<script>
const labels = <?= $jsMonths ?>;

new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
                label: 'Đã lấy',
                data: <?= $jsShipped ?>,
                backgroundColor: '#1abc9c'
            },
            {
                label: 'Đang giao',
                data: <?= $jsShipping ?>,
                backgroundColor: '#f39c12'
            },
            {
                label: 'Hoàn thành',
                data: <?= $jsDone ?>,
                backgroundColor: '#3498db'
            },
            {
                label: 'Đã hủy',
                data: <?= $jsCancel ?>,
                backgroundColor: '#e74c3c'
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            legend: {
                position: 'bottom'
            },
            title: {
                display: true,
                text: 'Số lượng đơn hàng theo tháng'
            }
        }
    }
});
</script>
<script>
new Chart(document.getElementById('pieChart'), {
    type: 'doughnut',
    data: {
        labels: ['Đã lấy', 'Đang giao', 'Hoàn thành', 'Đã hủy'],
        datasets: [{
            data: [<?=$counts['shipped']??0?>, <?=$counts['shipping']??0?>, <?=$counts['done']??0?>,
                <?=$counts['cancel']??0?>
            ],
            backgroundColor: ['#1abc9c', '#f39c12', '#3498db', '#e74c3c']
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
</script>
<?php include_once(__DIR__ . '/../public/footer.php'); ?>