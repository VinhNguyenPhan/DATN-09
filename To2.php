<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Địa điểm xếp hàng</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background: #f5f7fa;
        margin: 0;
        padding: 20px;
    }

    .container {
        max-width: 900px;
        margin: 0 auto;
        background: #fff;
        padding: 20px 30px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    .form-group {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .form-group label {
        flex: 0 0 100px;
        font-weight: bold;
        color: #444;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        flex: 1;
        padding: 8px 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
        outline: none;
    }

    .form-group textarea {
        resize: vertical;
        min-height: 60px;
    }

    .container-grid {
        margin-top: 20px;
    }

    .container-grid label {
        font-weight: bold;
        display: block;
        margin-bottom: 10px;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 10px;
    }

    .grid input {
        width: 80%;
        padding: 6px 8px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 13px;
    }

    .actions {
        margin-top: 20px;
        text-align: center;
    }

    .btn {
        padding: 10px 20px;
        background: #007bff;
        border: none;
        color: #fff;
        font-size: 15px;
        border-radius: 6px;
        cursor: pointer;
        margin: 0 10px;
        transition: 0.3s;
    }

    .btn:hover {
        background: #0056b3;
    }

    .btn.reset {
        background: #6c757d;
    }

    .btn.reset:hover {
        background: #4b4f52;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2>Tờ khai xuất khẩu - Thông tin container</h2>
        <h3>Địa điểm xếp hàng lên xe chở hàng</h3>

        <div class="form-group">
            <label>Mã:</label>
            <input type="text" placeholder="Nhập mã...">
        </div>

        <div class="form-group">
            <label>Tên:</label>
            <input type="text" placeholder="Tên địa điểm...">
        </div>

        <div class="form-group">
            <label>Địa chỉ:</label>
            <textarea placeholder="Địa chỉ chi tiết..."></textarea>
        </div>

        <div class="container-grid">
            <label>Số Container:</label>
            <div class="grid">
                <!-- Tạo 50 ô input -->
                <input type="text" placeholder="1">
                <input type="text" placeholder="2">
                <input type="text" placeholder="3">
                <input type="text" placeholder="4">
                <input type="text" placeholder="5">
                <input type="text" placeholder="6">
                <input type="text" placeholder="7">
                <input type="text" placeholder="8">
                <input type="text" placeholder="9">
                <input type="text" placeholder="10">
                <input type="text" placeholder="11">
                <input type="text" placeholder="12">
                <input type="text" placeholder="13">
                <input type="text" placeholder="14">
                <input type="text" placeholder="15">
                <input type="text" placeholder="16">
                <input type="text" placeholder="17">
                <input type="text" placeholder="18">
                <input type="text" placeholder="19">
                <input type="text" placeholder="20">
                <input type="text" placeholder="21">
                <input type="text" placeholder="22">
                <input type="text" placeholder="23">
                <input type="text" placeholder="24">
                <input type="text" placeholder="25">
                <input type="text" placeholder="26">
                <input type="text" placeholder="27">
                <input type="text" placeholder="28">
                <input type="text" placeholder="29">
                <input type="text" placeholder="30">
                <input type="text" placeholder="31">
                <input type="text" placeholder="32">
                <input type="text" placeholder="33">
                <input type="text" placeholder="34">
                <input type="text" placeholder="35">
                <input type="text" placeholder="36">
                <input type="text" placeholder="37">
                <input type="text" placeholder="38">
                <input type="text" placeholder="39">
                <input type="text" placeholder="40">
                <input type="text" placeholder="41">
                <input type="text" placeholder="42">
                <input type="text" placeholder="43">
                <input type="text" placeholder="44">
                <input type="text" placeholder="45">
                <input type="text" placeholder="46">
                <input type="text" placeholder="47">
                <input type="text" placeholder="48">
                <input type="text" placeholder="49">
                <input type="text" placeholder="50">
            </div>
        </div>

        <div class="actions">
            <a href="Index.php" target="seft">
                <button class="btn">Trang trước</button>
            </a>
            <a href="To3.php" target="seft">
                <button class="btn">Trang sau</button>
            </a>
            <button class="btn">Lưu</button>
            <button class="btn reset">Xóa</button>
        </div>
    </div>
</body>

</html>