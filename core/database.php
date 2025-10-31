<?php
session_start();
$host = "localhost";
$user = "root";
$pass = "";
$db = "dulieu";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
   die("Kết nối thất bại: " . $conn->connect_error);
}

include_once(__DIR__ . '/phanQuyen.php');
$_role_KhaiBao = ["admin", "employee"];
$_role_TimToKhai = ["admin", "employee", "customer", "accounting"];
$_role_TraCuuViTri = ["admin", "employee", "customer", "accounting", "shipper"];
$_role_ThongKe = ["admin"];
$_role_ThanhToan = ["admin", "accounting", "customer"];
$_role_ChinhSuaTrangThai = ["admin"];
$_role_ChinhSuaViTri = ["admin", "shipper"];
$_role_CongNo = ["admin", "accounting"];

function SendTele($text)
{
   $token = "8430398623:AAG6Sstcya8scqUVSwNZUENQdvDl8uIUdVA";
   $url = "https://api.telegram.org/bot{$token}/sendMessage";

   $post = [
      'chat_id' => '8005199440',
      'text' => $text,
      'parse_mode' => 'HTML'
   ];

   $ch = curl_init();
   curl_setopt_array($ch, [
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_POST => true,
      CURLOPT_POSTFIELDS => $post,
      CURLOPT_TIMEOUT => 10,
   ]);
   $response = curl_exec($ch);
   curl_close($ch);

   return json_decode($response, true);
}
?>