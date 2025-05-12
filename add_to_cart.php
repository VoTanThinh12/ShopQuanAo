<?php
require 'db.php';

session_start();

// Kiểm tra nếu người dùng chưa đăng nhập
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Kiểm tra xem user_id có tồn tại trong bảng users không
$stmt = $pdo->prepare('SELECT id FROM users WHERE id = ?');
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!$user) {
    // Nếu không tồn tại user_id, chuyển hướng về trang đăng nhập hoặc hiển thị thông báo lỗi
    header('Location: login.php');
    exit;
}

$product_name = $_POST['product_name'] ?? '';
$product_image = $_POST['product_image'] ?? '';
$price = $_POST['price'] ?? 0;

if ($product_name && $price) {
    // Kiểm tra sản phẩm đã có trong giỏ chưa
    $stmt = $pdo->prepare('SELECT id, quantity FROM cart WHERE user_id = ? AND product_name = ?');
    $stmt->execute([$user_id, $product_name]);
    $item = $stmt->fetch();

    if ($item) {
        // Nếu đã có thì tăng số lượng
        $stmt = $pdo->prepare('UPDATE cart SET quantity = quantity + 1 WHERE id = ?');
        $stmt->execute([$item['id']]);
    } else {
        // Nếu chưa có thì thêm mới
        $stmt = $pdo->prepare('INSERT INTO cart (user_id, product_name, product_image, price, quantity) VALUES (?, ?, ?, ?, 1)');
        $stmt->execute([$user_id, $product_name, $product_image, $price]);
    }
}

header('Location: checkout.php');
exit;
    