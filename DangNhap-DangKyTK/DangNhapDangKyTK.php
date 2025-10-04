<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập - Logistic</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background: #f9fafb;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
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

    .role-tabs {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        border-radius: 12px;
        background: #e5e7eb;
        padding: 5px;
    }

    .role-tabs button {
        flex: 1;
        padding: 10px;
        border: none;
        background: transparent;
        border-radius: 10px;
        cursor: pointer;
        font-weight: bold;
        color: #374151;
        transition: 0.3s;
    }

    .role-tabs button.active {
        background: #2563eb;
        color: #fff;
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

    <div class="login-container">
        <h2>Đăng nhập</h2>

        <!-- Tabs chọn vai trò -->
        <div class="role-tabs">
            <button class="active" id="btn-customer" onclick="switchRole('customer')">Khách hàng</button>
            <button id="btn-staff" onclick="switchRole('staff')">Quản lý / Nhân viên</button>
        </div>

        <!-- Form đăng nhập -->
        <form id="login-form">
            <div class="form-group">
                <label for="username">Tên đăng nhập</label>
                <input type="text" id="username" name="username" placeholder="Nhập tên đăng nhập">
            </div>

            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu">
            </div>

            <button type="submit" class="login-btn">Đăng nhập</button>
        </form>

        <div class="extra-links">
            <a href="#">Quên mật khẩu?</a> |
            <a href="#">Đăng ký</a>
        </div>
    </div>

    <script>
    let currentRole = "customer";

    function switchRole(role) {
        currentRole = role;

        // highlight tab
        document.getElementById("btn-customer").classList.remove("active");
        document.getElementById("btn-staff").classList.remove("active");

        if (role === "customer") {
            document.getElementById("btn-customer").classList.add("active");
        } else {
            document.getElementById("btn-staff").classList.add("active");
        }
    }

    document.getElementById("login-form").addEventListener("submit", function(e) {
        e.preventDefault();
        alert("Bạn đang đăng nhập với vai trò: " + (currentRole === "customer" ? "Khách hàng" :
            "Quản lý / Nhân viên"));
        // Sau này có thể gửi dữ liệu lên server: username, password, currentRole
    });
    </script>

</body>

</html>