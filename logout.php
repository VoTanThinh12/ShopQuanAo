<?php
// Bắt đầu session nếu chưa được bắt đầu
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra và require file db.php
if (file_exists('db.php')) {
    require 'db.php';
} else {
    die('Không thể tìm thấy file db.php');
}

// Xóa tất cả dữ liệu session
$_SESSION = array();

// Xóa cookie session nếu có
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-3600, '/');
}

// Hủy session
session_unset();
session_destroy();

// Chuyển hướng về trang chủ
header('Location: index.php');
exit;
?> 