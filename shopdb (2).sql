-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 13, 2025 lúc 12:31 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shopdb`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','paid','failed') DEFAULT 'pending',
  `payment_method` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `payment_status`, `payment_method`, `created_at`) VALUES
(1, 1, 210.00, 'paid', 'Credit Card', '2025-05-12 07:45:31'),
(2, 1, 210.00, 'paid', 'Credit Card', '2025-05-12 08:07:47'),
(3, 1, 70.00, 'paid', 'Credit Card', '2025-05-12 08:13:43'),
(4, 1, 140.00, 'paid', 'Credit Card', '2025-05-12 08:21:49'),
(5, 1, 0.00, 'paid', 'Credit Card', '2025-05-12 08:24:47'),
(6, 1, 0.00, 'paid', 'Credit Card', '2025-05-12 08:24:53'),
(7, 1, 210.00, 'paid', 'Credit Card', '2025-05-12 08:42:09'),
(8, 1, 140.00, 'paid', 'Credit Card', '2025-05-12 08:42:46'),
(9, 1, 70.00, 'paid', 'Credit Card', '2025-05-12 08:44:53'),
(10, 1, 70.00, 'paid', 'Credit Card', '2025-05-12 08:45:18'),
(11, 1, 70.00, 'paid', 'Credit Card', '2025-05-12 14:39:07'),
(12, 1, 210.00, 'paid', 'Credit Card', '2025-05-12 14:52:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `gender` enum('Men','Women','Kids') DEFAULT 'Men',
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `gender`, `price`, `image`, `description`, `created_at`) VALUES
(1, 'Sed ut perspiciati', 'Shirt', 'Women', 70.00, 'images/pc.jpg', 'Áo sơ mi nữ màu xanh nhạt', '2025-05-11 11:45:24'),
(2, 'At vero eos', 'T-Shirt', 'Women', 70.00, 'images/pc1.jpg', 'Áo thun nữ in hình', '2025-05-11 11:45:24'),
(3, 'Sed ut perspiciati', 'Shirt', 'Men', 70.00, 'images/pc2.jpg', 'Áo sơ mi nam caro xanh', '2025-05-11 11:45:24'),
(4, 'On the other', 'Shirt', 'Women', 69.00, 'images/pc3.jpg', 'Áo sơ mi nữ caro hồng', '2025-05-11 11:45:24'),
(5, 'On the other', 'Shirt', 'Men', 78.00, 'images/pc4.jpg', 'Áo sơ mi nam caro nâu', '2025-05-11 11:45:24'),
(6, 'Sed ut perspiciati', 'Shirt', 'Men', 77.00, 'images/pc5.jpg', 'Áo sơ mi nam trắng', '2025-05-11 11:45:24'),
(7, 'At vero eos', 'T-Shirt', 'Women', 71.00, 'images/pc6.jpg', 'Áo thun nữ tím', '2025-05-11 11:45:24'),
(8, 'Sed ut perspiciati', 'Shirt', 'Men', 75.00, 'images/pc7.jpg', 'Áo sơ mi nam xanh đậm', '2025-05-11 11:45:24'),
(9, 'Luna Hoodie', 'Hoodie', 'Women', 65.00, 'images/hoodie/hoodie (2).jpg', 'Áo hoodie nữ phong cách mới', '2025-05-11 11:45:24'),
(10, 'Marcello Jeans', 'Jeans', 'Men', 75.00, 'images/jeans/jeans (2).jpg', 'Quần jeans nam xắn gấu', '2025-05-11 11:45:24'),
(11, 'Sophia Polo', 'Polo', 'Women', 60.00, 'images/polo/polo (2).jpg', 'Áo polo nữ, phối sọc', '2025-05-11 11:45:24'),
(12, 'Gavin Trousers', 'Trousers', 'Men', 80.00, 'images/trousers/trousers.jpg', 'Quần tây nam màu xám', '2025-05-11 11:45:24'),
(13, 'Ariana Polo', 'Polo', 'Women', 72.00, 'images/polo/polo (3).jpg', 'Áo polo nữ lưng dài', '2025-05-11 11:45:24'),
(14, 'Luca Tank Top', 'Tank Top', 'Men', 55.00, 'images/tank_top/tank_top.jpeg', 'Áo tank top nam đơn giản', '2025-05-11 11:45:24'),
(15, 'Isabella Trousers', 'Trousers', 'Women', 78.00, 'images/trousers/trousers (6).jpg', 'Quần tây nữ thanh lịch', '2025-05-11 11:45:24'),
(16, 'Bruno Hoodie', 'Hoodie', 'Men', 85.00, 'images/hoodie/hoodie (3).jpg', 'Áo hoodie nam có mũ', '2025-05-11 11:45:24'),
(17, 'Giovanna Polo', 'Polo', 'Women', 63.00, 'images/polo/polo (4).jpg', 'Áo polo nữ tay ngắn', '2025-05-11 11:45:24'),
(18, 'Zane Jeans', 'Jeans', 'Men', 77.00, 'images/jeans/jeans (4).jpg', 'Quần jeans nam cổ điển', '2025-05-11 11:45:24'),
(19, 'Clara Tank Top', 'Tank Top', 'Women', 50.00, 'images/tank_top/tank_top (3).jpg', 'Áo tank top nữ màu pastel', '2025-05-11 11:45:24'),
(20, 'Vito Trousers', 'Trousers', 'Men', 82.00, 'images/trousers/trousers (4).webp', 'Quần tây nam tối màu', '2025-05-11 11:45:24'),
(21, 'Elenora Hoodie', 'Hoodie', 'Women', 70.00, 'images/hoodie/hoodie (4).jpg', 'Áo hoodie nữ màu hồng', '2025-05-11 11:45:24'),
(22, 'Vincenzo Polo', 'Polo', 'Men', 67.00, 'images/polo/polo (5).jpg', 'Áo polo nam chất liệu cotton', '2025-05-11 11:45:24'),
(23, 'Eliana Trousers', 'Trousers', 'Women', 79.00, 'images/trousers/trousers (5).jpg', 'Quần nữ thời trang', '2025-05-11 11:45:24'),
(24, 'Maxim Jeans', 'Jeans', 'Men', 73.00, 'images/jeans/jeans (5).jpg', 'Quần jeans nam slim fit', '2025-05-11 11:45:24'),
(25, 'Bianca Tank Top', 'Tank Top', 'Women', 52.00, 'images/tank_top/tank_top (2).webp', 'Áo tank top nữ chất liệu nhẹ', '2025-05-11 11:45:24'),
(26, 'Dante Hoodie', 'Hoodie', 'Men', 90.00, 'images/hoodie/hoodie (5).jpg', 'Áo hoodie nam dáng rộng', '2025-05-11 11:45:24'),
(27, 'Emilia Polo', 'Polo', 'Women', 69.00, 'images/polo/polo (6).jpg', 'Áo polo nữ tay dài', '2025-05-11 11:45:24'),
(28, 'Theo Trousers', 'Trousers', 'Men', 85.00, 'images/trousers/trousers (3).jpg', 'Quần tây nam sang trọng', '2025-05-11 11:45:24'),
(29, 'Zara Polo', 'Polo', 'Women', 68.00, 'images/polo/polo (7).jpg', 'Áo polo nữ họa tiết', '2025-05-11 11:45:24'),
(30, 'Carlos Jeans', 'Jeans', 'Men', 76.00, 'images/jeans/jeans (6).jpg', 'Quần jeans nam kiểu dáng hiện đại', '2025-05-11 11:45:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password_hash`, `created_at`) VALUES
(1, '1', '1', '1@gmail.com', '$2y$10$e05oW1UvlynKYqhfEbDUPuHSblOwy1sfrPjuQ79p/SRwxJU7i6XG6', '2025-05-11 12:17:20');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
