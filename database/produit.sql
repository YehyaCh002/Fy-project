-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 20 أغسطس 2024 الساعة 01:13
-- إصدار الخادم: 10.1.36-MariaDB
-- PHP Version: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `produit`
--

-- --------------------------------------------------------

--
-- بنية الجدول `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `description` text NOT NULL,
  `category` varchar(100) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- إرجاع أو استيراد بيانات الجدول `products`
--

INSERT INTO `products` (`id`, `image`, `title`, `price`, `description`, `category`, `meta_description`, `meta_keywords`) VALUES
(1, 'samsung-s21-ultra.jpg', 'Samsung S21 Ultra', 98000, 'The Samsung Galaxy S21 Ultra is a flagship smartphone featuring a 6.8-inch Dynamic AMOLED 2X display, a powerful Exynos 2100 or Snapdragon 888 processor, and a versatile quad-camera setup with a 108MP main sensor. It supports S Pen functionality and offers 5G connectivity, delivering top-tier performance and cutting-edge features.', 'samsung', 'product description', 'product keywords'),
(2, 'samsung-s22-ultra.jpg', 'Samsung S22 Ultra', 128000, 'The Samsung Galaxy S22 Ultra is a flagship smartphone featuring a 6.8-inch Dynamic AMOLED 2X display, a powerful Exynos 2100 or Snapdragon 888 processor, and a versatile quad-camera setup with a 108MP main sensor. It supports S Pen functionality and offers 5G connectivity, delivering top-tier performance and cutting-edge features.', 'samsung', 'product description', 'product keywords'),
(3, 'samsung-s23-ultra.jpg', 'Samsung S23 Ultra', 160000, 'The Samsung Galaxy S23 Ultra is a flagship smartphone featuring a 6.8-inch Dynamic AMOLED 2X display, a powerful Exynos 2100 or Snapdragon 888 processor, and a versatile quad-camera setup with a 108MP main sensor. It supports S Pen functionality and offers 5G connectivity, delivering top-tier performance and cutting-edge features.', 'samsung', 'product description', 'product keywords'),
(4, 'iphone-12-pro-max.jpg', 'Iphone 12 Pro Max', 130000, 'The Iphone 12 Pro Max is a flagship smartphone featuring a 6.7-inch Super Retina XDR display, a powerful A14 Bionic chip, and a triple-camera setup with a 12MP main sensor. It supports 5G connectivity, delivering top-tier performance and cutting-edge features.', 'iphone', 'product description', 'product keywords'),
(5, 'iphone-11.jpg', 'Iphone 11', 90000, 'The Iphone 11 is a flagship smartphone featuring a 6.1-inch Liquid Retina HD display, a powerful A13 Bionic chip, and a dual-camera setup with a 12MP main sensor. It supports 4G connectivity, delivering top-tier performance and cutting-edge features.', 'iphone', 'product description', 'product keywords'),
(6, 'iphone-14.jpg', 'Iphone 14', 160000, 'The Iphone 14 is a flagship smartphone featuring a 6.1-inch Super Retina XDR display, a powerful A15 Bionic chip, and a triple-camera setup with a 12MP main sensor. It supports 5G connectivity, delivering top-tier performance and cutting-edge features.', 'iphone', 'product description', 'product keywords'),
(7, 'oppo-find-x3-pro.jpg', 'Oppo Find X3 Pro', 58000, 'The Oppo Find X3 Pro is a flagship smartphone featuring a 6.7-inch QHD+ AMOLED display, a powerful Snapdragon 888 processor, and a versatile quad-camera setup with a 50MP main sensor. It supports 5G connectivity, delivering top-tier performance and cutting-edge features.', 'oppo', 'product description', 'product keywords'),
(8, 'oppo-a12.jpg', 'Oppo A12', 38000, 'The Oppo A12 is a budget-friendly smartphone featuring a 6.22-inch HD+ display, a MediaTek Helio P35 processor, and a dual-camera setup with a 12MP main sensor. It supports 4G connectivity, delivering reliable performance and essential features.', 'oppo', 'product description', 'product keywords'),
(9, 'realme-11-pro.jpg', 'Realme 11 Pro', 68000, 'The Realme 11 Pro is a mid-range smartphone featuring a 6.4-inch FHD+ AMOLED display, a powerful Snapdragon 765G processor, and a quad-camera setup with a 64MP main sensor. It supports 5G connectivity, delivering impressive performance and value.', 'realme', 'product description', 'product keywords'),
(10, 'realme-10.jpg', 'Realme 10', 35000, 'The Realme 10 is a budget-friendly smartphone featuring a 6.5-inch HD+ display, a MediaTek Helio G85 processor, and a dual-camera setup with a 13MP main sensor. It supports 4G connectivity, delivering reliable performance and essential features.', 'realme', 'product description', 'product keywords');

-- --------------------------------------------------------

--
-- بنية الجدول `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- إرجاع أو استيراد بيانات الجدول `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(4, 'normal user');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `role_id`) VALUES
(205, 'Chehida Yehia', 'yahiayahiachehida@gmail.com', '$2y$10$XvIeYY.q9E5np3O/QqfrxONwOyViVdJfidmHulLlT/XiwqBvWYLka', '2024-05-25 17:53:06', 1),
(206, 'anes islem', 'anesislem@gmail.com', '$2y$10$slE4VUgHxqnFpj1g2JnttuXGBxPZa8N9Bwm2EvyGO3DXM.lr6iyUS', '2024-05-25 17:53:50', NULL),
(207, 'helloworld', 'hello@gmail.com', '$2y$10$t3HSGRWvCQWAeo4B3IuFPe5bE5dw5Qp4xjwSPzdFW3LY6d3oQ4vAu', '2024-08-13 19:36:48', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_role` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
