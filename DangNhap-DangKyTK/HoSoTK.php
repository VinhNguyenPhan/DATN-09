<?php
include_once(__DIR__ . '/../public/header.php');

if (empty($_SESSION['user_id'])) {
    header("Location: ../DangNhap-DangKyTK/DangNhapDangKyTK.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
if (!$stmt) {
    die("Lỗi prepare SQL: " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("Không tìm thấy thông tin người dùng.");
}

if (!empty($_POST['oldPassword']) && !empty($_POST['newPassword'])) {
    if (md5($_POST['oldPassword']) == $user['password']) {
        if ($_POST['oldPassword'] == $_POST['newPassword']) {
            $error = "Mật khẩu mới không được trùng với mật khẩu cũ. Vui lòng thử lại!";
        } else {
            $sql = "UPDATE users SET `password` = '" . md5($_POST['newPassword']) . "' WHERE `id`= '" . $user['id'] . "'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $success = "Đổi mật khẩu thành công";
        }
    } else {
        $error = "Mật khẩu không chính xác";
    }
} else {
    $error = "Vui lòng nhập đầy đủ dữ liệu";
}
?>

<style>
    .profile-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        padding: 40px 50px;
        max-width: 480px;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 25px;
    }

    .info {
        width: 100%;
    }

    .info label {
        display: block;
        font-weight: 600;
        color: #333;
        margin-bottom: 6px;
        font-size: 14px;
    }

    .info input {
        width: 100%;
        padding: 10px 14px;
        border: 1.5px solid #d0d7de;
        border-radius: 10px;
        background: #f9fbfd;
        font-size: 15px;
        color: #222;
        transition: all 0.2s ease;
        margin-bottom: 18px;
    }

    .info input:focus {
        border-color: var(--blue, #007bff);
        background: #fff;
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.15);
    }

    .btn-save {
        width: 100%;
        background: var(--blue, #007bff);
        color: white;
        padding: 12px 0;
        border-radius: 10px;
        border: none;
        font-size: 16px;
        font-weight: 600;
        cursor: not-allowed;
        opacity: 0.7;
        transition: all 0.3s ease;
    }

    .btn-save:enabled {
        cursor: pointer;
        opacity: 1;
    }

    .btn-save:enabled:hover {
        background: #0056d2;
    }

    footer {
        text-align: center;
        padding: 20px;
        color: #666;
        font-size: 14px;
        background: #f8fafc;
        border-top: 1px solid #e0e4ea;
        margin-top: 40px;
    }
</style>
<div>
    <h1>Thông tin cá nhân</h1>

    <div class="profile-card">
        <div class="info">
            <?php
            if (!empty($error)) {
                echo ($error);
            }
            if (!empty($success)) {
                echo ($success);
            }
            ?>
            <form method="POST" action="">
                <label>Tên đăng nhập</label>
                <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" readonly>

                <label>Mật khẩu cũ</label>
                <input type="password" name="oldPassword">
                <label>Mật khẩu mới</label>
                <input type="password" name="newPassword">
                <button type="submit" class="btn-save">Lưu mật khẩu mới</button>
            </form>
        </div>
    </div>
</div>
<?php
include_once(__DIR__ . '/../public/footer.php');
?>