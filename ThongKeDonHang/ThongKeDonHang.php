<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quản lý đơn hàng</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(135deg, #d0f2ff, #a8e0ff);
        margin: 0;
        padding: 15px;
    }

    /* Thanh tiêu đề U&I */
    .header {
        text-align: center;
        font-size: 22px;
        font-weight: bold;
        color: #ffffff;
        background: linear-gradient(135deg, #4facfe, #00f2fe);
        padding: 10px 0;
        border-radius: 8px;
        margin-bottom: 15px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        letter-spacing: 2px;
    }

    .dashboard {
        display: flex;
        gap: 15px;
        align-items: stretch;
    }

    .left {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .right {
        flex: 2;
        background: white;
        border-radius: 10px;
        padding: 10px;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card {
        background: white;
        border-radius: 8px;
        padding: 8px;
        text-align: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
        font-weight: bold;
        color: white;
        height: 55px;
        /* nhỏ gọn hơn */
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .card:hover {
        transform: scale(1.04);
    }

    .card h3 {
        margin: 0;
        font-size: 14px;
    }

    .card p {
        margin: 0;
        font-size: 12px;
    }

    /* Màu từng trạng thái */
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

    /* Biểu đồ tròn */
    .pieCard {
        background: white;
        border-radius: 8px;
        padding: 8px;
        text-align: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 120px;
        /* gọn lại */
    }

    .pieCard h3 {
        margin: 0 0 5px;
        font-size: 13px;
    }

    canvas {
        width: 100% !important;
        height: 100% !important;
    }
    </style>
</head>

<body>
    <!-- Header U&I -->
    <div class="header">U&I Dashboard</div>

    <div class="dashboard">
        <!-- Cột trái -->
        <div class="left">
            <div class="card lay">
                <h3>ĐÃ LẤY</h3>
                <p>0 ĐH</p>
            </div>
            <div class="card giao">
                <h3>ĐANG GIAO</h3>
                <p>0 ĐH</p>
            </div>
            <div class="card thanhcong">
                <h3>ĐÃ GIAO</h3>
                <p>0 ĐH</p>
            </div>
            <div class="card huy">
                <h3>ĐÃ HỦY</h3>
                <p>0 ĐH</p>
            </div>
            <div class="pieCard">
                <h3>Thống kê đơn hàng</h3>
                <canvas id="pieChart"></canvas>
            </div>
        </div>

        <!-- Cột phải -->
        <div class="right">
            <canvas id="barChart"></canvas>
        </div>
    </div>

    <script>
    // Biểu đồ cột
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6'],
            datasets: [{
                    label: 'Đã lấy',
                    data: [5, 7, 9, 6, 8, 10],
                    backgroundColor: '#1abc9c'
                },
                {
                    label: 'Đang giao',
                    data: [3, 5, 6, 8, 5, 7],
                    backgroundColor: '#f39c12'
                },
                {
                    label: 'Đã giao',
                    data: [10, 12, 15, 18, 16, 20],
                    backgroundColor: '#3498db'
                },
                {
                    label: 'Đã hủy',
                    data: [1, 2, 0, 3, 1, 2],
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
                }
            }
        }
    });

    // Biểu đồ tròn
    new Chart(document.getElementById('pieChart'), {
        type: 'doughnut',
        data: {
            labels: ['Đã lấy', 'Đang giao', 'Đã giao', 'Đã hủy'],
            datasets: [{
                data: [10, 20, 30, 5],
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
</body>

</html>