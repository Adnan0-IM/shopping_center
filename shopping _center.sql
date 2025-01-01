-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2024 at 06:07 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping_center`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `item_id`, `quantity`) VALUES
(3, 2, 0, 10),
(11, 2, 2, 1),
(16, 3, 2, 1),
(17, 4, 0, 13),
(24, 5, 0, 15),
(56, 5, 10, 1),
(60, 5, 7, 1),
(65, 19, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `price`, `image`) VALUES
(9, 'Coffee', 98943.00, 'uploads/istockphoto-517282254-612x612.jpg'),
(11, 'Ubuntu', 94874.00, 'uploads/328981.jpg'),
(12, 'MacOS', 878.00, 'uploads/Apple-macOS-13-wallpaper-Dark-Mode.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `shipping_address` text NOT NULL DEFAULT 'Placeholder Address',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `item_id`, `quantity`, `total_price`, `shipping_address`, `created_at`) VALUES
(26, 5, 3, 1, 34.00, 'Placeholder Address', '2024-09-27 18:53:06'),
(27, 5, 7, 1, 2332.00, 'Placeholder Address', '2024-09-27 18:53:47'),
(28, 5, 8, 1, 238232.00, 'Placeholder Address', '2024-09-27 18:53:52'),
(29, 5, 6, 1, 5999.00, 'Placeholder Address', '2024-09-27 19:01:57'),
(30, 5, 5, 1, 4353.00, 'Placeholder Address', '2024-09-27 19:02:01'),
(31, 5, 8, 1, 238232.00, 'Placeholder Address', '2024-09-27 19:07:09'),
(32, 5, 6, 1, 5999.00, 'Placeholder Address', '2024-09-27 19:07:14'),
(33, 5, 7, 1, 2332.00, 'Placeholder Address', '2024-09-27 19:07:17'),
(34, 5, 2, 3, 15000.00, 'Placeholder Address', '2024-09-27 19:07:21'),
(35, 5, 5, 2, 8706.00, 'Placeholder Address', '2024-09-27 19:07:25'),
(36, 5, 7, 1, 2332.00, 'Placeholder Address', '2024-09-27 19:08:01'),
(37, 5, 5, 1, 4353.00, 'Placeholder Address', '2024-09-27 19:14:47'),
(38, 5, 6, 3, 17997.00, 'Placeholder Address', '2024-09-28 04:44:39'),
(39, 5, 3, 1, 34.00, 'Placeholder Address', '2024-09-28 04:47:55'),
(40, 5, 1, 2, 2000.00, 'Placeholder Address', '2024-09-28 04:48:00'),
(41, 5, 8, 1, 238232.00, 'Placeholder Address', '2024-09-28 04:53:17'),
(42, 4, 2, 1, 5000.00, 'Placeholder Address', '2024-09-28 05:43:09'),
(43, 5, 6, 1, 5999.00, 'Placeholder Address', '2024-09-28 11:31:32'),
(44, 5, 7, 1, 2332.00, 'Placeholder Address', '2024-09-28 11:31:39'),
(45, 5, 3, 1, 34.00, 'Placeholder Address', '2024-09-28 11:38:30'),
(46, 5, 5, 1, 4353.00, 'Placeholder Address', '2024-09-28 11:38:36'),
(47, 5, 10, 1, 98943.00, 'Placeholder Address', '2024-09-28 11:38:39'),
(48, 5, 4, 1, 5444.00, 'Placeholder Address', '2024-09-28 11:38:42'),
(49, 5, 2, 1, 5000.00, 'Placeholder Address', '2024-09-29 07:48:51'),
(50, 5, 6, 1, 5999.00, 'Placeholder Address', '2024-09-29 10:27:42'),
(51, 5, 7, 1, 2332.00, 'Placeholder Address', '2024-10-01 08:23:24'),
(52, 5, 9, 1, 98943.00, 'Placeholder Address', '2024-10-06 20:03:06'),
(53, 5, 11, 1, 94874.00, 'Placeholder Address', '2024-10-06 20:07:36'),
(54, 5, 11, 1, 94874.00, 'Placeholder Address', '2024-10-06 20:17:59'),
(55, 17, 9, 1, 98943.00, 'Placeholder Address', '2024-10-12 20:02:19'),
(56, 17, 11, 1, 94874.00, 'Placeholder Address', '2024-10-12 20:02:30'),
(57, 17, 12, 1, 878.00, 'Placeholder Address', '2024-10-12 20:04:35');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('IVM','user','salesperson','manager') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `role`) VALUES
(16, 'adnan', '$2y$10$aJMoFKL1mYyIUyM0Yik2BeCNL6pCRVWEq8nl3yydrEeVy6JhbK4qe', 'adnan@gmail.com', 'IVM'),
(17, 'user', '$2y$10$uJCM.WdEm9C013p5L6hsIezfujclD88g8sZxOHggIvvlxTvAGSWqG', 'user@gmail.com', 'user'),
(18, 'manager', '$2y$10$usEaEN4/6TdZvFXqixaIH.Wnsa1hhh0ZsassB8lxThasIczUboN3K', 'manager@gmail.com', 'manager'),
(19, 'salesperson', '$2y$10$l/r.vvvEn7128GGHmGAHdO7/NF72WMwdY22itkLOgLs59DelI0lNK', 'salesperson@gmail.com', 'salesperson');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
