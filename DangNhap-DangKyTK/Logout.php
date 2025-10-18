<?php
require_once(__DIR__."/../core/database.php");
session_destroy();
header("Location: \DangNhap-DangKyTK\DangNhapDangKyTK.php");
exit;