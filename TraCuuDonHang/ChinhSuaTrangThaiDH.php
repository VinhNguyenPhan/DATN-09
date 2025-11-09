<?php
require_once(__DIR__ . '/../public/header.php');
require_role(['admin']);

if (empty($_SESSION['user_id'])) {
    $redirect = '/DangNhap-DangKyTK/DangNhapDangKyTK.php?next=' . urlencode($_SERVER['REQUEST_URI']);
    header("Location: $redirect");
    exit;
}

$allowedStatuses = ['done', 'cancel', 'shipping', 'shipped'];



$message = '';
$error = '';
$currentOrder = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = strtolower(trim($_POST['type'] ?? ''));
    $orderId = trim($_POST['order_id'] ?? '');
    $status = strtolower(trim($_POST['status'] ?? ''));

    if (!in_array($status, $allowedStatuses, true)) {
        $error = 'Trạng thái không hợp lệ.';
    } elseif ($type !== 'xk' && $type !== 'nk') {
        $error = 'Loại đơn không hợp lệ.';
    } elseif ($orderId === '') {
        $error = 'Vui lòng chọn mã vận đơn.';
    } else {
        $table = $type === 'xk' ? 'to1XK' : 'to1NK';
        $stmt = $conn->prepare("UPDATE $table SET ThongKe = ? WHERE id = ?");
        $stmt->bind_param('si', $status, $orderId);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = '✅ Cập nhật trạng thái thành công.';
            $_SESSION['order_id_last'] = $orderId;
            $_SESSION['type_last'] = $type;
        } else {
            $error = 'Lỗi khi cập nhật trạng thái.';
        }
        $stmt->close();
    }
}
if (!empty($_SESSION['success_message'])) {
    $message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

if (!empty($_SESSION['order_id_last']) && !empty($_SESSION['type_last'])) {
    $orderId = $_SESSION['order_id_last'];
    $type = $_SESSION['type_last'];
    unset($_SESSION['order_id_last'], $_SESSION['type_last']);

    $table = $type === 'xk' ? 'to1XK' : 'to1NK';
    $stmt = $conn->prepare("SELECT id, SVD, ThongKe, created_at FROM $table WHERE id = ? LIMIT 1");
    $stmt->bind_param('i', $orderId);
    $stmt->execute();
    $currentOrder = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}

include_once(__DIR__ . '/../public/header.php');
?>

<style>
    .page-container {
        padding: 6px 1%;
        width: 70%;
        display: flex;
        justify-content: center;
    }

    .card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 6px 30px rgba(0, 0, 0, 0.08);
        padding: 40px;
        max-width: 1300px;
        width: 100%;
        transition: all 0.3s ease;
    }

    h1 {
        margin-bottom: 24px;
        font-size: 26px;
        color: #1e3a8a;
        font-weight: 700;
        text-align: center;
    }

    .form-inline {
        display: flex;
        gap: 16px;
        align-items: center;
        flex-wrap: nowrap;
        justify-content: space-between;
    }

    select {
        border-radius: 12px;
        border: 1px solid #cbd5e1;
        font-size: 16px;
        padding: 12px 14px;
        height: 48px;
        flex: 1;
        background-color: #fafafa;
        transition: all 0.3s ease;
    }

    select:focus {
        border-color: #3b82f6;
        background-color: #fff;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
        outline: none;
    }

    .select2-selection--single {
        height: 48px !important;
        border-radius: 12px !important;
        display: flex !important;
        align-items: center !important;
        border: 1px solid #cbd5e1 !important;
        background: #fafafa !important;
    }

    .select2-selection__arrow {
        height: 46px !important;
    }

    .select2-selection__rendered {
        font-size: 16px !important;
        color: #111827 !important;
    }

    .btn {
        padding: 12px 20px;
        border-radius: 12px;
        border: none;
        cursor: pointer;
        font-weight: 600;
        transition: 0.25s;
        font-size: 15px;
    }

    .btn.primary {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: #fff;
    }

    .btn.secondary {
        background: #f3f4f6;
        color: #374151;
        border: 1px solid #d1d5db;
    }

    .actions {
        display: flex;
        gap: 12px;
        justify-content: center;
        margin-top: 22px;
    }

    .msg {
        padding: 16px 22px;
        border-radius: 12px;
        font-size: 18px;
        font-weight: 600;
        text-align: center;
        margin-bottom: 20px;
    }

    .msg.success {
        background: #dcfce7;
        color: #166534;
        border: 2px solid #22c55e;
        box-shadow: 0 4px 10px rgba(34, 197, 94, 0.15);
    }

    .msg.error {
        background: #fee2e2;
        color: #991b1b;
        border: 2px solid #ef4444;
        box-shadow: 0 4px 10px rgba(239, 68, 68, 0.15);
    }
</style>

<div class="page-container">
    <div class="card">
        <h1>Chỉnh sửa trạng thái đơn hàng</h1>

        <?php if ($message): ?>
            <div class="msg success"><?= htmlspecialchars($message) ?></div><?php endif; ?>
        <?php if ($error): ?>
            <div class="msg error"><?= htmlspecialchars($error) ?></div><?php endif; ?>

        <form method="post">
            <div class="form-inline">
                <select name="type" id="type" required>
                    <option value="">-- Loại đơn --</option>
                    <option value="xk">Xuất khẩu</option>
                    <option value="nk">Nhập khẩu</option>
                </select>

                <select name="order_id" id="order_id" required>
                    <option value="">-- Chọn hoặc tìm mã vận đơn --</option>
                </select>

                <select name="status" required>
                    <?php
                    $statusLabels = [
                        'done' => 'Hoàn thành',
                        'cancel' => 'Đã hủy',
                        'shipping' => 'Đang giao',
                        'shipped' => 'Đã lấy hàng'
                    ];
                    foreach ($allowedStatuses as $st):
                        ?>
                        <option value="<?= $st ?>"><?= $statusLabels[$st] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="actions">
                <button type="submit" class="btn primary">Cập nhật</button>
                <a href="/TraCuuDonHang/TraCuu.php" class="btn secondary" style="text-decoration:none;">Quay lại tra
                    cứu</a>
            </div>
        </form>

        <?php if ($currentOrder): ?>
            <div style="margin-top:24px; font-size:15px; text-align:center; color:#334155;">
                <b>Mã vận đơn:</b> <?= htmlspecialchars($currentOrder['SVD']) ?> |
                <?php
                $statusLabels = [
                    'done' => 'Hoàn thành',
                    'cancel' => 'Đã hủy',
                    'shipping' => 'Đang vận chuyển',
                    'shipped' => 'Đã giao hàng'
                ];
                $displayStatus = $statusLabels[$currentOrder['ThongKe']] ?? $currentOrder['ThongKe'];
                ?>
                <b>Trạng thái:</b> <?= htmlspecialchars($displayStatus) ?> |
                <b>Ngày tạo:</b> <?= htmlspecialchars($currentOrder['created_at']) ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        const $type = $('#type');
        const $order = $('#order_id');

        $order.select2({
            placeholder: "🔍 Tìm kiếm mã vận đơn...",
            allowClear: true,
            width: '100%'
        });

        $type.on('change', function () {
            const type = $(this).val();
            $order.empty().trigger('change').prop('disabled', true);
            if (!type) return;

            $order.append('<option>Đang tải...</option>');
            fetch(`TruyVan.php?ajax=list&type=${type}`)
                .then(res => res.json())
                .then(data => {
                    $order.empty();
                    if (data.length === 0) {
                        $order.append('<option value="">(Không có đơn hàng nào)</option>');
                    } else {
                        data.forEach(item => {
                            const option = new Option(item.SVD, item.id);
                            $order.append(option);
                        });
                    }
                    $order.prop('disabled', false).trigger('change');
                })
                .catch(() => {
                    $order.empty().append('<option value="">Lỗi tải dữ liệu</option>');
                });
        });
    });
</script>

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
                    shadow: '2px 2px 10px  rgba(0, 0, 0, 0.5)',
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
                    }],
                },
            }
        },
    };

    chatux.init(opt);
    chatux.start(true);
</script>

<?php include_once(__DIR__ . '/../public/footer.php'); ?>