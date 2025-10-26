<?php
session_start();
$host = "localhost";
$user = "root";       // tài khoản MySQL
$pass = "";           // mật khẩu MySQL
$db   = "dulieu";     // tên database

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
   die("Kết nối thất bại: " . $conn->connect_error);
}

include_once(__DIR__.'/phanQuyen.php');
$_role_KhaiBao= ["admin","employee","custommer"];
$_role_TimToKhai= ["admin","employee","custommer","accounting"];
$_role_TraCuuViTri = ["admin","employee","custommer","accounting","shipper"];
$_role_ThongKe =["admin"];
$_role_ThanhToan =["admin","accounting","custommer"];
$_role_ChinhSuaTrangThai =["admin"];
$_role_ChinhSuaViTri =["admin","shipper"];
?>