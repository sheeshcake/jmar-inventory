-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2020 at 10:48 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jmar-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(85, 'Bulbs');

-- --------------------------------------------------------

--
-- Table structure for table `damaged_items`
--

CREATE TABLE `damaged_items` (
  `damage_id` int(11) NOT NULL,
  `item_id` varchar(32) NOT NULL,
  `item_count` varchar(32) NOT NULL,
  `damage_datetime` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `damaged_items`
--

INSERT INTO `damaged_items` (`damage_id`, `item_id`, `item_count`, `damage_datetime`) VALUES
(9, '59', '2', '12-04-2020 04:10 pm');

-- --------------------------------------------------------

--
-- Table structure for table `incoming_transaction`
--

CREATE TABLE `incoming_transaction` (
  `incoming_id` int(11) NOT NULL,
  `transaction_id` varchar(32) NOT NULL,
  `item_id` varchar(32) NOT NULL,
  `item_count` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `incoming_transaction`
--

INSERT INTO `incoming_transaction` (`incoming_id`, `transaction_id`, `item_id`, `item_count`) VALUES
(7, '63', '59', '100.00'),
(8, '64', '60', '200.00'),
(9, '65', '60', '200.00'),
(10, '65', '59', '100.00'),
(11, '68', '59', '100.00'),
(12, '70', '59', '100.00'),
(13, '73', '65', '69.00'),
(14, '75', '65', '100.00');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_img` text NOT NULL DEFAULT 'item.jpg',
  `item_name` varchar(32) NOT NULL,
  `item_brand` varchar(32) NOT NULL,
  `item_desc` text NOT NULL,
  `item_unit` varchar(32) NOT NULL,
  `item_unit_divisor` varchar(32) NOT NULL,
  `item_tax` varchar(32) NOT NULL,
  `item_price` varchar(32) NOT NULL,
  `item_tax_wholesale` varchar(32) NOT NULL,
  `item_price_wholesale` varchar(32) NOT NULL,
  `item_stock` varchar(32) NOT NULL,
  `item_added` varchar(32) NOT NULL,
  `category_id` varchar(32) NOT NULL,
  `supplier_id` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_img`, `item_name`, `item_brand`, `item_desc`, `item_unit`, `item_unit_divisor`, `item_tax`, `item_price`, `item_tax_wholesale`, `item_price_wholesale`, `item_stock`, `item_added`, `category_id`, `supplier_id`) VALUES
(65, '127225904_795555357966704_6894168839991592545_n.jpg', 'Firefly Basic Series LED A-Bulb', 'Firefly', 'sad boiGGGGGGG', 'Sack', '30', '10.00', '12.00', '12.00', '1200.00', '100', '12-14-2020 04:09 pm', '85', '2');

-- --------------------------------------------------------

--
-- Table structure for table `purchased_item`
--

CREATE TABLE `purchased_item` (
  `purchased_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `item_id` varchar(32) NOT NULL,
  `item_count` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchased_item`
--

INSERT INTO `purchased_item` (`purchased_id`, `transaction_id`, `item_id`, `item_count`) VALUES
(41, 58, '59', '20.00'),
(42, 59, '59', '2.00'),
(43, 60, '60', '10.00'),
(44, 60, '59', '32.00'),
(45, 61, '60', '1.00'),
(46, 62, '60', '100.00'),
(47, 66, '59', '1.00'),
(48, 67, '59', '2.00'),
(49, 69, '59', '100.00'),
(50, 71, '60', '1.00'),
(51, 71, '59', '2.00'),
(52, 72, '65', '1.00'),
(53, 74, '65', '192.00');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(32) NOT NULL,
  `supplier_contact_number` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `supplier_contact_number`) VALUES
(1, 'Supplier1', '1234567899'),
(2, 'Supplier2', '999999999');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `transaction_type` varchar(32) NOT NULL,
  `transaction_datetime` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `transaction_type`, `transaction_datetime`) VALUES
(58, 'outgoing', '12-03-2020 05:19 pm'),
(59, 'outgoing', '12-04-2020 01:28 pm'),
(60, 'outgoing', '12-04-2020 01:37 pm'),
(61, 'outgoing', '12-04-2020 02:44 pm'),
(62, 'outgoing', '12-04-2020 02:44 pm'),
(63, 'incoming', '12-04-2020 03:57 pm'),
(64, 'incoming', '12-04-2020 04:000 pm'),
(65, 'incoming', '12-04-2020 04:001 pm'),
(66, 'outgoing', '12-04-2020 04:43 pm'),
(67, 'outgoing', '12-04-2020 04:44 pm'),
(68, 'incoming', '12-04-2020 04:44 pm'),
(69, 'outgoing', '12-10-2020 03:55 pm'),
(70, 'incoming', '12-10-2020 03:56 pm'),
(71, 'outgoing', '12-14-2020 01:46 pm'),
(72, 'outgoing', '12-14-2020 04:55 pm'),
(73, 'incoming', '12-14-2020 04:56 pm'),
(74, 'outgoing', '12-14-2020 04:56 pm'),
(75, 'incoming', '12-14-2020 04:59 pm');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(65) NOT NULL,
  `f_name` varchar(32) NOT NULL,
  `l_name` varchar(32) NOT NULL,
  `user_img` varchar(32) NOT NULL DEFAULT 'user.jpg',
  `role` varchar(32) NOT NULL DEFAULT 'admin',
  `email` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `f_name`, `l_name`, `user_img`, `role`, `email`) VALUES
(3, 'jmar', '$2y$10$r.A3Rlgc5FElPfNd1BYrfeghPit8Mp/SJu53Xk4rbIpN7jCrnpsI.', 'J', 'Mar', 'user.jpg', 'admin', 'admin@gmail.com'),
(4, 'asd', '$2y$10$ESGVyK.l.RidFxLHIVVrt.meLydXjqDddbTu7/z4UihDm7ZnXs/VK', 'asd', 'asd', 'user.jpg', 'accountant', 'asd@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `damaged_items`
--
ALTER TABLE `damaged_items`
  ADD PRIMARY KEY (`damage_id`);

--
-- Indexes for table `incoming_transaction`
--
ALTER TABLE `incoming_transaction`
  ADD PRIMARY KEY (`incoming_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `purchased_item`
--
ALTER TABLE `purchased_item`
  ADD PRIMARY KEY (`purchased_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `damaged_items`
--
ALTER TABLE `damaged_items`
  MODIFY `damage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `incoming_transaction`
--
ALTER TABLE `incoming_transaction`
  MODIFY `incoming_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `purchased_item`
--
ALTER TABLE `purchased_item`
  MODIFY `purchased_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
