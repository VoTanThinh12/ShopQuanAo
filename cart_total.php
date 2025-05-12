<?php
if (session_status() == PHP_SESSION_NONE) session_start();
require_once 'db.php';
$user_id = $_SESSION['user_id'] ?? 0;
$total_price = 0;
if ($user_id) {
    $stmt = $pdo->prepare('SELECT * FROM cart WHERE user_id = ?');
    $stmt->execute([$user_id]);
    $cart_items = $stmt->fetchAll();
    foreach ($cart_items as $item) {
        $total_price += $item['price'] * $item['quantity'];
    }
}
?> 