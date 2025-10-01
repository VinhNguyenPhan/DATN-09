<?php
$host = "localhost";
$user = "root";       // tài khoản MySQL
$pass = "";           // mật khẩu MySQL
$db   = "dulieu";     // tên database

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>