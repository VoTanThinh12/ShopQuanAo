-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 13, 2025 lúc 12:58 PM
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
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `receiver_name` varchar(255) NOT NULL,
  `receiver_email` varchar(255) NOT NULL,
  `receiver_phone` varchar(50) NOT NULL,
  `receiver_address` varchar(255) NOT NULL,
  `note` text,
  `total_price` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','paid','failed') DEFAULT 'pending',
  `payment_method` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `receiver_name`, `receiver_email`, `receiver_phone`, `receiver_address`, `note`, `total_price`, `payment_status`, `payment_method`, `created_at`) VALUES
(1, 1, 'John Doe', 'john@example.com', '555-1234', '123 Main St, Anytown, USA', 'No special instructions', 210.00, 'paid', 'Credit Card', '2025-05-12 07:45:31'),
(2, 1, 'Jane Smith', 'jane@example.com', '555-5678', '456 Elm St, Anytown, USA', 'Please deliver before 5pm', 210.00, 'paid', 'Credit Card', '2025-05-12 08:07:47'),
(3, 1, 'Bob Johnson', 'bob@example.com', '555-9012', '789 Oak St, Anytown, USA', NULL, 70.00, 'paid', 'Credit Card', '2025-05-12 08:13:43'),
(4, 1, 'Alice Brown', 'alice@example.com', '555-3456', '101 Pine St, Anytown, USA', NULL, 140.00, 'paid', 'Credit Card', '2025-05-12 08:21:49'),
(5, 1, 'Charlie Davis', 'charlie@example.com', '555-7890', '202 Maple St, Anytown, USA', NULL, 0.00, 'paid', 'Credit Card', '2025-05-12 08:24:47'),
(6, 1, 'Eve Green', 'eve@example.com', '555-2345', '303 Birch St, Anytown, USA', NULL, 0.00, 'paid', 'Credit Card', '2025-05-12 08:24:53'),
(7, 1, 'Grace Hill', 'grace@example.com', '555-6789', '404 Cedar St, Anytown, USA', NULL, 210.00, 'paid', 'Credit Card', '2025-05-12 08:42:09'),
(8, 1, 'Frank Miller', 'frank@example.com', '555-0123', '505 Elm St, Anytown, USA', NULL, 140.00, 'paid', 'Credit Card', '2025-05-12 08:42:46'),
(9, 1, 'Hannah Wilson', 'hannah@example.com', '555-4567', '606 Oak St, Anytown, USA', NULL, 70.00, 'paid', 'Credit Card', '2025-05-12 08:44:53'),
(10, 1, 'Ian Thompson', 'ian@example.com', '555-8901', '707 Pine St, Anytown, USA', NULL, 70.00, 'paid', 'Credit Card', '2025-05-12 08:45:18'),
(11, 1, 'Julia Adams', 'julia@example.com', '555-2345', '808 Maple St, Anytown, USA', NULL, 70.00, 'paid', 'Credit Card', '2025-05-12 14:39:07'),
(12, 1, 'Kevin Baker', 'kevin@example.com', '555-6789', '909 Elm St, Anytown, USA', NULL, 210.00, 'paid', 'Credit Card', '2025-05-12 14:52:48');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
