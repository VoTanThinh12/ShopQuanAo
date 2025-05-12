<?php
// Lấy thông tin đơn hàng từ cơ sở dữ liệu
require 'db.php';
if (session_status() == PHP_SESSION_NONE) session_start();
$user_id = $_SESSION['user_id'];

// Lấy đơn hàng mới nhất của người dùng
$stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC LIMIT 1");
$stmt->execute([$user_id]);
$order = $stmt->fetch();

// Xóa toàn bộ giỏ hàng của user sau khi thanh toán
$stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = ?");
$stmt->execute([$user_id]);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Xác nhận đơn hàng | Shopin</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/style4.css" rel="stylesheet" type="text/css" media="all" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        .order-confirm-box {
            max-width: 500px;
            margin: 60px auto 0 auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 24px #f6777740;
            padding: 40px 30px 30px 30px;
            text-align: center;
        }
        .order-confirm-box h2 {
            color: #f67777;
            margin-bottom: 20px;
            font-size: 2em;
        }
        .order-confirm-box .info {
            font-size: 1.1em;
            color: #444;
            margin-bottom: 18px;
        }
        .order-confirm-box .label {
            color: #f67777;
            font-weight: bold;
        }
        .order-confirm-box .btn-home {
            margin-top: 25px;
            background: #f67777;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 10px 30px;
            font-size: 1.1em;
            transition: background 0.2s;
            text-decoration: none;
            display: inline-block;
        }
        .order-confirm-box .btn-home:hover {
            background: #d95c5c;
            color: #fff;
        }
        body {
            background: #f8f8f8;
        }
    </style>
</head>
<body>
    <div class="order-confirm-box">
        <?php if ($order): ?>
            <h2>Đơn hàng của bạn đã được xác nhận!</h2>
            <div class="info"><span class="label">Tổng tiền:</span> <?php echo number_format($order['total_price'], 0, ',', '.'); ?> VND</div>
            <div class="info"><span class="label">Trạng thái thanh toán:</span> <?php echo htmlspecialchars($order['payment_status']); ?></div>
            <div class="info"><span class="label">Phương thức thanh toán:</span> <?php echo htmlspecialchars($order['payment_method']); ?></div>
            <a href="index.php" class="btn-home">Quay về trang chủ</a>
        <?php else: ?>
            <h2>Không có đơn hàng nào.</h2>
            <a href="index.php" class="btn-home">Quay về trang chủ</a>
        <?php endif; ?>
    </div>
</body>
</html>
