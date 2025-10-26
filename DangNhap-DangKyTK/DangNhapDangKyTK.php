<?php 
require_once(__DIR__."/../core/database.php");
if(!empty($_SESSION["user_id"])){
    echo "<script>
        setTimeout(function(){
            window.location.href = '../index.php';
        }, 1);
    </script>";
    
}
if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $toast = ["type" => "error", "msg" => "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu!"];
    } else {
        $sql = "SELECT * FROM `users` WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $hashPass = md5($password);
        $stmt->bind_param("ss", $username, $hashPass);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

                if (!$user) {
            $toast = ["type" => "error", "msg" => "Tài khoản hoặc mật khẩu không đúng!"];
        } else {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];
            $_SESSION["role"] = $user["role"]; 
            $toast = ["type" => "success", "msg" => "Đăng nhập thành công!"];
            echo "<script>
                setTimeout(function(){
                    window.location.href = '../index.php';
                }, 1000);
            </script>";
        }

    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập - Logistic</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <style>
    * {
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background: #f9fafb;
        margin: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .header {
        display: flex;
        align-items: center;
        padding: 20px 40px;
        background: transparent;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 10;
    }

    .brand {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
    }

    .logo-box {
        width: 55px;
        height: 55px;
        border-radius: 12px;
        background-color: #1f6fb2;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease, background 0.3s ease;
    }

    .logo-text {
        font-family: "Inter", sans-serif;
        font-weight: 800;
        font-size: 20px;
        color: #fff;
        letter-spacing: 0.5px;
    }

    .brand-text {
        font-family: "Inter", sans-serif;
        font-size: 18px;
        font-weight: 700;
        color: #1f3c88;
        letter-spacing: 0.8px;
    }

    .brand-info .sub {
        font-size: 13px;
        color: #6b7280;
        font-weight: 400;
    }

    .brand:hover .logo-box {
        transform: scale(1.05);
        background-color: #2b86d6;
    }

    .login-wrapper {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        padding-top: 80px;
    }

    .login-container {
        background: #fff;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
        text-align: center;
    }

    .login-container h2 {
        margin-bottom: 20px;
        color: #2563eb;
    }

    .login-container h3 {
        color: #2563eb;
    }

    .form-group {
        text-align: left;
        margin-bottom: 15px;
    }

    .form-group label {
        font-size: 14px;
        color: #374151;
        display: block;
        margin-bottom: 6px;
    }

    .form-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        outline: none;
        transition: 0.2s;
    }

    .form-group input:focus {
        border-color: #2563eb;
        box-shadow: 0 0 4px rgba(37, 99, 235, 0.4);
    }

    .login-btn {
        width: 100%;
        background: #2563eb;
        color: #fff;
        padding: 12px;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        cursor: pointer;
        margin-top: 10px;
        transition: 0.3s;
    }

    .login-btn:hover {
        background: #1e40af;
    }

    .extra-links {
        margin-top: 15px;
        font-size: 14px;
    }

    .extra-links a {
        color: #2563eb;
        text-decoration: none;
        margin: 0 8px;
    }

    .extra-links a:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>
    <header class="header">
        <a href="../index.php" class="brand" style="padding-left:9px">
            <div class="logo-box">
                <span class="logo-text">U&amp;I</span>
            </div>
            <div class="brand-info">
                <div class="brand-text">U&I LOGISTICS</div>
                <div class="sub">Khai báo & Giải pháp vận tải</div>
            </div>
        </a>
    </header>

    <div class="login-wrapper">
        <div class="login-container">
            <h2>Đăng nhập</h2>
            <h3>Vui lòng đăng nhập tài khoản hệ thống</h3>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="username">Tên đăng nhập</label>
                    <input type="text" id="username" name="username" placeholder="Nhập tên đăng nhập">
                </div>

                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" id="password" name="password" placeholder="Nhập mật khẩu">
                </div>

                <button type="submit" name="submit" value="true" class="login-btn">Đăng nhập</button>
            </form>

            <div class="extra-links">
                <a href="#">Quên mật khẩu?</a>
            </div>
        </div>
    </div>

    <?php if (isset($toast)) : ?>
    <script>
    $(document).ready(function() {
        toastr.options = {
            "positionClass": "toast-top-center",
            "timeOut": "2000"
        };
        toastr["<?= $toast['type'] ?>"]("<?= $toast['msg'] ?>");
    });
    </script>
    <?php endif; ?>
</body>

</html>