<?php
// Lấy thông tin thanh toán từ form
$card_number = $_POST['card_number'];
$expiry_date = $_POST['expiry_date'];
$cvv = $_POST['cvv'];
$total_price = $_POST['total_price'];

// Giả lập kết quả thanh toán từ cổng thanh toán (ví dụ PayPal hoặc Stripe)
$payment_status = 'paid'; // Hoặc 'failed' nếu thanh toán thất bại

// Lưu thông tin đơn hàng vào cơ sở dữ liệu
require 'db.php';
session_start();
$user_id = $_SESSION['user_id']; // ID người dùng từ session

// Chèn đơn hàng vào bảng orders
$stmt = $pdo->prepare("INSERT INTO orders (user_id, total_price, payment_status, payment_method) VALUES (?, ?, ?, ?)");
$stmt->execute([$user_id, $total_price, $payment_status, 'PayPal']); // Thay thế PayPal bằng cổng thanh toán bạn chọn

// Kiểm tra thanh toán
if ($payment_status == 'paid') {
    echo "Thanh toán thành công!";
    // Chuyển hướng đến trang xác nhận đơn hàng hoặc thông báo
    header("Location: order_confirmation.php");
} else {
    echo "Thanh toán thất bại, vui lòng thử lại!";
}
?>
