<?php 
    require_once(__DIR__."/../core/database.php");
    if (empty($_SESSION['user_id'])) {
     $redirect = '/DangNhap-DangKyTK/DangNhapDangKyTK.php?next=' . urlencode($_SERVER['REQUEST_URI']);
     header("Location: $redirect");
     exit;
 }
    // print_r($_POST);
    // exit();
    if(!$_POST){
        header("Location: To1XK.php");
    }
    $_SESSION['To1XK'] = $_POST;
    // echo '<pre>';
    // print_r($_SESSION['To1NK']);
    // exit();
?>
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
        width: 1000px;
        margin: 30px auto;
        background: #fff;
        border: 1px solid #ccc;
        padding: 20px 30px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .button-group {
        text-align: center;
        margin-top: 30px;
    }

    button.red {
        background-color: #d9534f;
    }

    button.red:hover {
        background-color: #c9302c;
    }

    h2 {
        text-align: center;
        color: #003399;
        margin-bottom: 20px;
    }

    .form-group {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    button {
        padding: 10px 20px;
        margin: 5px;
        font-weight: bold;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        color: #fff;
        background-color: #337ab7;
        transition: background-color 0.2s;
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
        <form method="POST" action="To3XK.php">
            <div class="form-group">
                <label>Mã:</label>
                <input type="text" name="MA" id="MA" placeholder="Nhập mã">
            </div>

            <div class="form-group">
                <label>Tên:</label>
                <input type="text" name="TEN" id="TEN" placeholder="Tên địa điểm">
            </div>

            <div class="form-group">
                <label>Địa chỉ:</label>
                <input type="text" name="DC" id="DC" placeholder="Địa chỉ">
            </div>

            <div class="container-grid">
                <label>Số Container:</label>
                <div class="grid">
                    <input type="text" name="SC1" id="SC1" placeholder="1">
                    <input type="text" name="SC2" id="SC2" placeholder="2">
                    <input type="text" name="SC3" id="SC3" placeholder="3">
                    <input type="text" name="SC4" id="SC4" placeholder="4">
                    <input type="text" name="SC5" id="SC5" placeholder="5">
                    <input type="text" name="SC6" id="SC6" placeholder="6">
                    <input type="text" name="SC7" id="SC7" placeholder="7">
                    <input type="text" name="SC8" id="SC8" placeholder="8">
                    <input type="text" name="SC9" id="SC9" placeholder="9">
                    <input type="text" name="SC10" id="SC10" placeholder="10">
                    <input type="text" name="SC11" id="SC11" placeholder="11">
                    <input type="text" name="SC12" id="SC12" placeholder="12">
                    <input type="text" name="SC13" id="SC13" placeholder="13">
                    <input type="text" name="SC14" id="SC14" placeholder="14">
                    <input type="text" name="SC15" id="SC15" placeholder="15">
                    <input type="text" name="SC15" id="SC16" placeholder="16">
                    <input type="text" name="SC17" id="SC17" placeholder="17">
                    <input type="text" name="SC18" id="SC18" placeholder="18">
                    <input type="text" name="SC19" id="SC19" placeholder="19">
                    <input type="text" name="SC20" id="SC20" placeholder="20">
                    <input type="text" name="SC21" id="SC21" placeholder="21">
                    <input type="text" name="SC22" id="SC22" placeholder="22">
                    <input type="text" name="SC23" id="SC23" placeholder="23">
                    <input type="text" name="SC24" id="SC24" placeholder="24">
                    <input type="text" name="SC25" id="SC25" placeholder="25">
                    <input type="text" name="SC26" id="SC26" placeholder="26">
                    <input type="text" name="SC27" id="SC27" placeholder="27">
                    <input type="text" name="SC28" id="SC28" placeholder="28">
                    <input type="text" name="SC29" id="SC29" placeholder="29">
                    <input type="text" name="SC30" id="SC30" placeholder="30">
                    <input type="text" name="SC31" id="SC31" placeholder="31">
                    <input type="text" name="SC32" id="SC32" placeholder="32">
                    <input type="text" name="SC33" id="SC33" placeholder="33">
                    <input type="text" name="SC34" id="SC34" placeholder="34">
                    <input type="text" name="SC35" id="SC35" placeholder="35">
                    <input type="text" name="SC36" id="SC36" placeholder="36">
                    <input type="text" name="SC37" id="SC37" placeholder="37">
                    <input type="text" name="SC38" id="SC38" placeholder="38">
                    <input type="text" name="SC39" id="SC39" placeholder="39">
                    <input type="text" name="SC40" id="SC40" placeholder="40">
                    <input type="text" name="SC41" id="SC41" placeholder="41">
                    <input type="text" name="SC42" id="SC42" placeholder="42">
                    <input type="text" name="SC43" id="SC43" placeholder="43">
                    <input type="text" name="SC44" id="SC44" placeholder="44">
                    <input type="text" name="SC45" id="SC45" placeholder="45">
                    <input type="text" name="SC46" id="SC46" placeholder="46">
                    <input type="text" name="SC47" id="SC47" placeholder="47">
                    <input type="text" name="SC48" id="SC48" placeholder="48">
                    <input type="text" name="SC49" id="SC49" placeholder="49">
                    <input type="text" name="SC50" id="SC50" placeholder="50">
                </div>
            </div>

            <div class="button-group">
                <button type="submit" name="action" value="next"
                    onclick="window.location.href='../TKXK/to1XK.php'">Trang trước</button>
                <button type="submit" name="action" value="next"
                    onclick="window.location.href='../TKXK/to3XK.php'">Trang sau</button>
                <button type="button" name="action" value="save">Lưu</button>
                <button type="button" onclick="timToKhai()">Tìm tờ khai</button>
                <button type="button" class="red" onclick="window.location.href='../index.php'">Đóng</button>
            </div>
            <script>
            function timToKhai() {
                alert("Thực hiện tìm tờ khai...");
            }
            </script>
    </div>
    </div>
    </form>
    </div>
</body>

</html>