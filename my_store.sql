-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 17, 2025 lúc 07:34 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `my_store`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` varchar(50) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `email`, `created_at`, `role`) VALUES
(1, 'user1', '$2y$12$KVjK40UxlMWxku03gpZfXeLIAONfGtsfQ1cP9AmLELnojL4cIeYWW', 'user1@example.com', '2025-04-07 09:33:21', 'user'),
(2, 'admin ', '$2y$12$saKOMhQkk1qNlMQ3VcAJmelWItFuEiD8UBXGGYdxCFUa/.xuBjqHm', 'admin @example.com', '2025-04-07 10:03:10', 'admin'),
(3, 'admin1', '$2y$12$KEwB0vbSzAwkEXlhxI6oOOdhs/jsz7zjZV6E7KuRgw9ZFpCPaFtiu', 'admin1@example.com', '2025-04-07 10:12:56', 'admin'),
(4, 'Test', '$2y$10$gIk.4vcgXdk4QnVuAEFMP.syolnW7X0UOpfR0iYRQ79mGRUa7Vqwy', 'test1@gmail.com', '2025-04-14 04:14:17', 'user');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `brand`
--

INSERT INTO `brand` (`id`, `name`, `description`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'Nike', 'Thương hiệu thể thao hàng đầu thế giới ', 'uploads/67fa3c2e6ed59-nike.jpg', '2025-04-07 20:16:03', '2025-04-16 16:00:34'),
(2, 'Adidas', 'Thương hiệu thể thao nổi tiếng đến từ Đức', 'uploads/67ff5cd681b2d-adidas.jpg', '2025-04-07 20:16:03', '2025-04-16 14:31:34'),
(3, 'Reebok', 'Công ty con của Adidas, chuyên sản xuất giày và trang phục thể thao', 'uploads/67ff5d236b229-Reebok.png', '2025-04-07 20:16:03', '2025-04-16 14:32:51'),
(4, 'Converse', 'Nổi tiếng với dòng giày Chuck Taylor', 'uploads/67ff5dcc40422-converse.jpg', '2025-04-07 20:16:03', '2025-04-16 14:35:40'),
(5, 'Vans', 'Thương hiệu gắn liền với văn hóa trượt ván', 'uploads/67ff5dfdd5c4a-Vans.png', '2025-04-07 20:16:03', '2025-04-16 14:36:29'),
(6, 'Puma', 'Thương hiệu thời trang thể thao toàn cầu', 'uploads/67ff5e2ec184c-puma.jpg', '2025-04-07 20:16:03', '2025-04-16 14:37:18'),
(7, 'Under Armour', 'Thương hiệu thể thao hiện đại từ Mỹ', 'uploads/67ff5ec189366-Under Armour.JPG', '2025-04-07 20:16:03', '2025-04-16 14:39:45'),
(8, 'Skechers', 'Chuyên sản xuất giày dép thoải mái và thời trang', 'uploads/67ff5f124e5f5-Skechers.png', '2025-04-07 20:16:03', '2025-04-16 14:41:06'),
(9, 'Balenciaga', 'Thương hiệu thời trang cao cấp đến từ Tây Ban Nha', 'uploads/67ff5f48e7a86-Balenciaga.jpg', '2025-04-07 20:16:03', '2025-04-16 14:42:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 31, '2025-04-07 10:52:12', '2025-04-14 04:04:11'),
(2, 3, 2, 1, '2025-04-07 10:52:21', '2025-04-07 10:52:21'),
(3, 3, 1, 31, '2025-04-12 11:05:30', '2025-04-14 04:04:11'),
(4, 3, 1, 31, '2025-04-12 11:06:42', '2025-04-14 04:04:11'),
(5, 3, 1, 31, '2025-04-12 11:12:53', '2025-04-14 04:04:11'),
(6, 3, 1, 31, '2025-04-12 11:15:41', '2025-04-14 04:04:11'),
(9, 4, 1, 3, '2025-04-14 04:15:03', '2025-04-14 04:52:02'),
(10, 4, 1, 3, '2025-04-14 04:42:18', '2025-04-14 04:52:02'),
(11, 4, 1, 3, '2025-04-14 04:44:32', '2025-04-14 04:52:02'),
(12, 4, 1, 3, '2025-04-14 04:46:05', '2025-04-14 04:52:02'),
(13, 4, 1, 3, '2025-04-14 04:48:23', '2025-04-14 04:52:02'),
(14, 4, 1, 3, '2025-04-14 04:48:30', '2025-04-14 04:52:02'),
(15, 4, 1, 3, '2025-04-14 04:50:14', '2025-04-14 04:52:02'),
(16, 4, 1, 3, '2025-04-14 04:51:47', '2025-04-14 04:52:02'),
(17, 3, 1, 1, '2025-04-14 09:08:14', '2025-04-14 09:08:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `description`) VALUES
(1, 'Giày thể thao', 'Các loại giày thể thao phù hợp cho hoạt động thể dục, chạy bộ, hoặc chơi thể thao                            '),
(6, 'Giày công sở', 'Giày lịch sự, sang trọng dành cho môi trường làm việc hoặc các sự kiện quan trọng.'),
(7, 'Giày thời trang', 'Giày thiết kế thời trang, phù hợp cho các buổi đi chơi hoặc dạo phố.'),
(8, 'Giày trẻ em', 'Giày dành cho trẻ em với thiết kế dễ thương và thoải mái.'),
(9, 'Giày leo núi', 'Giày chuyên dụng cho các hoạt động leo núi hoặc đi phượt.'),
(10, 'Giày dép mùa hè', 'Các loại giày dép thoáng mát, phù hợp cho mùa hè.'),
(11, 'Giày sneaker', 'Giày sneaker phong cách, phù hợp cho mọi lứa tuổi.'),
(12, 'Giày cao gót', 'Giày cao gót dành cho phái nữ, phù hợp cho các buổi tiệc hoặc sự kiện.'),
(13, 'Giày boot', 'Giày boot thời trang, phù hợp cho mùa đông hoặc phong cách cá tính.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `phone`, `address`, `payment_method`, `created_at`) VALUES
(1, 'Tỉnh Lương', '', '0945832579', 'Khu Công nghệ cao TP.HCM SHTP, Xa lộ Hà Nội, P. Hiệp Phú, TP. Thủ Đức, TP.HCM', '', '2025-04-02 03:29:37'),
(2, 'Tỉnh Lương', '', '0945832579', 'Khu Công nghệ cao TP.HCM SHTP, Xa lộ Hà Nội, P. Hiệp Phú, TP. Thủ Đức, TP.HCM', '', '2025-04-02 03:31:22'),
(3, 'A', '', '0945832579', 'Khu Công nghệ cao TP.HCM SHTP, Xa lộ Hà Nội, P. Hiệp Phú, TP. Thủ Đức, TP.HCM', 'cod', '2025-04-16 07:07:23'),
(4, 'A', '', '0945832579', 'Khu Công nghệ cao TP.HCM SHTP, Xa lộ Hà Nội, P. Hiệp Phú, TP. Thủ Đức, TP.HCM', 'cod', '2025-04-16 07:17:57'),
(5, 'A', '', '0945832579', 'Khu Công nghệ cao TP.HCM SHTP, Xa lộ Hà Nội, P. Hiệp Phú, TP. Thủ Đức, TP.HCM', 'cod', '2025-04-16 07:25:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 1, 3, 20000.00),
(2, 1, 2, 2, 1212.00),
(3, 2, 1, 1, 20000.00),
(4, 3, 1, 1, 3100000.00),
(5, 3, 2, 1, 5500000.00),
(6, 4, 1, 1, 3100000.00),
(7, 5, 1, 1, 3100000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `image`, `category_id`, `brand_id`) VALUES
(1, 'Giày Nike Air Zoom ', 'Giày Nike Zoom Vapor Pro 2 HC ‘White’ DR6191-101', 3100000.00, 'uploads/dr6191-101_blanc_1.png', 1, 1),
(2, 'Giày Asics', 'Giày Tennis Asics Court FF Novak ‘Cranberry White’ 1041A089-605', 5500000.00, 'uploads/image__75__cc6b82033896498bbbfad5b30e04cd57.png', 1, 7),
(3, 'Giày SSTR V Bape', 'ưdawdadwadw', 3300000.00, 'uploads/adidas-superstar-x-bape.jpg', 1, 2),
(4, 'Giày Balenciaga Triple S Trainer Black Red', 'Fullbox Balen Triple S Trainer Black Red 2018 Dad Shoe. Đế giày tăng chiều cao. Phù hợp: nam nữ, đi học, đi làm, hoạt động thể thao. Chất liệu: Da. Giao hàng toàn quốc. Đổi trả dễ dàng. Streetwear, trẻ trung năng động.', 1595000.00, 'uploads/Triple-S-Trainer-Black-Red-2018.jpg', 7, 9),
(5, 'Giày Reebok Zig Dynamica Black/Red FY7054', 'Giày Thể Thao Reebok Zig Dynamica Black/Red FY7054 Màu Đen Đỏ', 2250000.00, 'uploads/reebook.jpg', 1, 9);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `fk_brand` (`brand_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_brand` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`),
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
