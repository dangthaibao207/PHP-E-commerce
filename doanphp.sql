-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2024 at 11:38 AM
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
-- Database: `doanphp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(250) NOT NULL,
  `admin_email` text NOT NULL,
  `admin_password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(2, 'dexter', 'trdongphuong@gmail.com', '69e49bb661f544df24f7e56233f41715');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_cost` decimal(6,2) NOT NULL,
  `order_status` varchar(100) NOT NULL DEFAULT 'on_hold',
  `user_id` int(11) NOT NULL,
  `user_phone` int(11) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `user_phone`, `user_city`, `user_address`, `order_date`) VALUES
(1, 560.00, 'Not paid', 1, 345878241, 'HCM', 'AMbatukam', '2024-03-21 09:55:08'),
(2, 1460.00, 'Not paid', 1, 908316263, 'asdsadsadsadda', '144/4 Long Biên ', '2024-03-21 10:13:53'),
(3, 420.00, 'Not paid', 1, 1234567890, 'sdaffffff', 'http://testphp.vulnweb.com/', '2024-03-21 10:58:40'),
(4, 900.00, 'Delivered', 1, 345878241, 'HCMM', '123 abc', '2024-03-24 09:00:25'),
(5, 1180.00, 'Not paid', 1, 1234567890, 'sdaffffff', '123 abc', '2024-03-24 11:25:15'),
(6, 140.00, 'paid', 1, 345878241, 'HCMM', '144/4 Long Biên ', '2024-04-04 06:33:40'),
(7, 140.00, 'Not paid', 1, 345878241, 'HCMM', '144/4 Long Biên ', '2024-04-04 07:12:33'),
(8, 140.00, 'Not paid', 1, 0, 'asdsadsad', 'asdadsadsad', '2024-04-04 07:18:32'),
(9, 140.00, 'Not paid', 1, 908316263, 'HCMM', '144/4 Long Biên ', '2024-04-04 07:39:20'),
(10, 120.00, 'Not paid', 1, 345878241, 'HCMM', '144/4 Long Biên ', '2024-04-04 07:52:57'),
(11, 120.00, 'Shipped', 1, 123456, '123456', '123456', '2024-04-04 09:43:12');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_name`, `product_image`, `product_price`, `product_quantity`, `user_id`, `order_date`) VALUES
(1, 2, '2', 'Women Pink Shirt', 'product_2.png', 140.00, 4, 1, '2024-03-21 10:13:53'),
(2, 2, '1', 'Women Black Jacket', 'product_1.png', 300.00, 3, 1, '2024-03-21 10:13:53'),
(3, 3, '2', 'Women Pink Shirt', 'product_2.png', 140.00, 3, 1, '2024-03-21 10:58:40'),
(4, 4, '1', 'Women Black Jacket', 'product_1.png', 300.00, 3, 1, '2024-03-24 09:00:25'),
(5, 5, '1', 'Women Black Jacket', 'product_1.png', 300.00, 3, 1, '2024-03-24 11:25:15'),
(6, 5, '2', 'Women Pink Shirt', 'product_2.png', 140.00, 2, 1, '2024-03-24 11:25:15'),
(7, 6, '2', 'Women Pink Shirt', 'product_2.png', 140.00, 1, 1, '2024-04-04 06:33:40'),
(8, 7, '2', 'Women Pink Shirt', 'product_2.png', 140.00, 1, 1, '2024-04-04 07:12:33'),
(9, 8, '2', 'Women Pink Shirt', 'product_2.png', 140.00, 1, 1, '2024-04-04 07:18:32'),
(10, 9, '2', 'Women Pink Shirt', 'product_2.png', 140.00, 1, 1, '2024-04-04 07:39:20'),
(11, 10, '4', 'Kid Sweater', 'product_28.png', 120.00, 1, 1, '2024-04-04 07:52:57'),
(12, 11, '4', 'Kid Sweater', 'product_28.png', 120.00, 1, 1, '2024-04-04 09:43:12');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `order_id`, `user_id`, `transaction_id`) VALUES
(1, 6, 1, '26');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_category` varchar(108) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_image2` varchar(255) DEFAULT NULL,
  `product_image3` varchar(255) DEFAULT NULL,
  `product_image4` varchar(255) DEFAULT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_special_offer` int(2) DEFAULT NULL,
  `product_color` varchar(108) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special_offer`, `product_color`) VALUES
(1, 'Women Black Jacket LGC', '0', 'Black, leather, moist', 'product_1.png', 'product_1.png', 'product_1.png', 'product_1.png', 299.00, 0, 'blacky'),
(2, 'Women Pink Shirt', 'shirt', 'Pink, light materials', 'product_2.png', 'product_2.png', 'product_2.png', 'product_2.png', 140.00, 0, 'Pink'),
(3, 'Men Coat 1', '10', 'White, waterproof', 'product_19.png', 'product_19.png', 'product_19.png', 'product_19.png', 250.00, 0, 'white'),
(4, 'Kid Sweater', 'sweater', 'Safe for skins', 'product_28.png', 'product_28.png', 'product_28.png', 'product_28.png', 120.00, 0, 'green'),
(5, 'asd', 'bags', 'Very standard name', 'asd1.jpeg', 'asd2.jpeg', 'asd3.jpeg', 'asd4.jpeg', 110.00, 10, 'Blue'),
(7, 'etuvan', 'clothes', 'Black, leather, moist', 'etuvan1.jpeg', 'etuvan2.jpeg', 'etuvan3.jpeg', 'etuvan4.jpeg', 111.00, 0, 'cyan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(108) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'dexter144', 'dpisindahouse@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `UX_Constraint` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
