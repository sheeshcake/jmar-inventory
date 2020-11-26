-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2020 at 07:22 AM
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
(74, 'Wires'),
(78, 'Bulbs'),
(79, 'Electrical');

-- --------------------------------------------------------

--
-- Table structure for table `damaged_items`
--

CREATE TABLE `damaged_items` (
  `damage_id` int(11) NOT NULL,
  `item_id` varchar(32) NOT NULL,
  `item_count` varchar(32) NOT NULL,
  `damage_desc` text NOT NULL,
  `damage_datetime` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `incoming_transaction`
--

CREATE TABLE `incoming_transaction` (
  `incoming_id` int(11) NOT NULL,
  `item_id` varchar(32) NOT NULL,
  `user_id` varchar(32) NOT NULL,
  `item_count` varchar(32) NOT NULL,
  `incoming_datetime` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `item_tax` varchar(32) NOT NULL,
  `item_price` varchar(32) NOT NULL,
  `item_stock` varchar(32) NOT NULL,
  `item_added` varchar(32) NOT NULL,
  `category_id` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_img`, `item_name`, `item_brand`, `item_desc`, `item_unit`, `item_tax`, `item_price`, `item_stock`, `item_added`, `category_id`) VALUES
(53, 'Firefly-Basic-Series-LED-A-Bulb-TUV-SUD.png', 'Firefly Basic Series LED A-Bulb', 'Firefly', 'jhhhh', 'pieces', '12', '12', '0', '11-24-2020 03:36 pm', '74'),
(54, 'Firefly-Basic-Series-LED-A-Bulb-TUV-SUD.png', 'asd', 'asd', 'asd', 'meter', '21', '12', '53', '11-25-2020 02:23 pm', '74');

-- --------------------------------------------------------

--
-- Table structure for table `outgoing_transaction`
--

CREATE TABLE `outgoing_transaction` (
  `outgoing_id` int(11) NOT NULL,
  `item_id` varchar(32) NOT NULL,
  `user_id` varchar(32) NOT NULL,
  `item_count` varchar(32) NOT NULL,
  `outgoing_datetime` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `outgoing_transaction`
--

INSERT INTO `outgoing_transaction` (`outgoing_id`, `item_id`, `user_id`, `item_count`, `outgoing_datetime`) VALUES
(99, '54', '3', '1', '11-25-2020 02:24 pm'),
(100, '54', '3', '8', '11-25-2020 02:26 pm'),
(101, '54', '3', '1', '11-25-2020 02:34 pm'),
(102, '54', '3', '1', '11-25-2020 02:35 pm'),
(103, '54', '3', '1', '11-25-2020 02:35 pm'),
(104, '54', '3', '1', '11-25-2020 02:35 pm'),
(105, '54', '3', '1', '11-25-2020 02:36 pm'),
(106, '54', '3', '1', '11-25-2020 02:37 pm'),
(107, '54', '3', '1', '11-25-2020 02:38 pm');

-- --------------------------------------------------------

--
-- Table structure for table `purchased_item`
--

CREATE TABLE `purchased_item` (
  `transaction_id` int(11) NOT NULL,
  `item_id` varchar(32) NOT NULL,
  `item_count` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchased_item`
--

INSERT INTO `purchased_item` (`transaction_id`, `item_id`, `item_count`) VALUES
(17, '54', '3'),
(17, '54', '2'),
(18, '54', '2'),
(18, '54', '12'),
(19, '54', '1'),
(20, '54', '3'),
(20, '54', '2'),
(21, '54', '2'),
(22, '54', '2'),
(23, '54', '2'),
(24, '54', '4'),
(24, '54', '2');

-- --------------------------------------------------------

--
-- Table structure for table `returned_items`
--

CREATE TABLE `returned_items` (
  `return_id` int(11) NOT NULL,
  `item_id` varchar(32) NOT NULL,
  `return_count` varchar(32) NOT NULL,
  `return_type` varchar(32) NOT NULL,
  `return_description` text NOT NULL,
  `return_datetime` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(17, 'incoming', '11-26-2020 02:13 pm'),
(18, 'incoming', '11-26-2020 02:13 pm'),
(19, 'incoming', '11-26-2020 02:14 pm'),
(20, 'incoming', '11-26-2020 02:17 pm'),
(21, 'incoming', '11-26-2020 02:19 pm'),
(22, 'incoming', '11-26-2020 02:19 pm'),
(23, 'incoming', '11-26-2020 02:19 pm'),
(24, 'incoming', '11-26-2020 02:21 pm');

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
(3, 'jmar', '$2y$10$dvXWYm98AEVb9eil5Hd/FeNK2FWfp2Ej.iOGxyU9fRpGk.YVG9wd2', 'J', 'Mar', 'user.jpg', 'admin', 'admin@gmail.com'),
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
-- Indexes for table `outgoing_transaction`
--
ALTER TABLE `outgoing_transaction`
  ADD PRIMARY KEY (`outgoing_id`);

--
-- Indexes for table `returned_items`
--
ALTER TABLE `returned_items`
  ADD PRIMARY KEY (`return_id`);

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
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `damaged_items`
--
ALTER TABLE `damaged_items`
  MODIFY `damage_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incoming_transaction`
--
ALTER TABLE `incoming_transaction`
  MODIFY `incoming_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `outgoing_transaction`
--
ALTER TABLE `outgoing_transaction`
  MODIFY `outgoing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `returned_items`
--
ALTER TABLE `returned_items`
  MODIFY `return_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
