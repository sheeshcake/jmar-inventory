-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2021 at 06:55 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

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
(85, 'Bulbs'),
(86, 'Paints'),
(87, 'Plywood'),
(128, 'Glass'),
(129, 'Cement'),
(130, 'Pipes'),
(131, 'Nails'),
(132, 'Misc');

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

-- --------------------------------------------------------

--
-- Table structure for table `incoming_details`
--

CREATE TABLE `incoming_details` (
  `incoming_details_id` int(11) NOT NULL,
  `transaction_id` varchar(32) NOT NULL,
  `driver_name` varchar(32) NOT NULL,
  `supplier_name` varchar(32) NOT NULL,
  `plate_no` varchar(32) NOT NULL,
  `terms_of_payment` varchar(32) NOT NULL,
  `address` text NOT NULL,
  `contact_no` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `incoming_details`
--

INSERT INTO `incoming_details` (`incoming_details_id`, `transaction_id`, `driver_name`, `supplier_name`, `plate_no`, `terms_of_payment`, `address`, `contact_no`) VALUES
(1, '22', 'asd', 'asd', 'asd', 'cod', 'asd', 'sd'),
(3, '24', 'asdas', 'asd', 'asd', 'cod', 'asd', 'sd'),
(4, '25', 'asdas', 'asd', 'asd', 'cod', 'asd', 'sd');

-- --------------------------------------------------------

--
-- Table structure for table `incoming_transaction`
--

CREATE TABLE `incoming_transaction` (
  `incoming_id` int(11) NOT NULL,
  `transaction_id` varchar(32) NOT NULL,
  `item_id` varchar(32) NOT NULL,
  `item_count` varchar(32) NOT NULL,
  `user_id` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `incoming_transaction`
--

INSERT INTO `incoming_transaction` (`incoming_id`, `transaction_id`, `item_id`, `item_count`, `user_id`) VALUES
(3, '24', '2', '75.00', '3'),
(4, '25', '2', '25.00', '3');

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
  `item_capital` varchar(32) NOT NULL,
  `item_capital_retail` varchar(32) NOT NULL,
  `item_tax` varchar(32) NOT NULL,
  `item_price` varchar(32) NOT NULL,
  `item_unit` varchar(32) NOT NULL DEFAULT 'Pieces',
  `item_unit_package` varchar(32) NOT NULL DEFAULT 'Pieces',
  `item_unit_divisor` varchar(32) DEFAULT NULL,
  `item_stock` varchar(32) NOT NULL,
  `item_stock_warehouse` varchar(32) NOT NULL DEFAULT '0',
  `item_added` varchar(32) NOT NULL,
  `category_id` varchar(32) NOT NULL,
  `supplier_id` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_img`, `item_name`, `item_brand`, `item_desc`, `item_capital`, `item_capital_retail`, `item_tax`, `item_price`, `item_unit`, `item_unit_package`, `item_unit_divisor`, `item_stock`, `item_stock_warehouse`, `item_added`, `category_id`, `supplier_id`) VALUES
(1, 'about.jpg', 'asd', 'asd', 'asd', '200', '200', '20', '240.00', 'Pieces', 'Pieces', '1', '288', '285', '03-01-2021 03:11 pm', '85', '1'),
(2, '', 'test2', 'test2', 'asdasd', '2000', '80.00', '20', '96.00', 'Box', 'Pieces', '25', '53', '87', '03-01-2021 03:15 pm', '85', '1'),
(3, '', 'asd1', 'asd1', 'asdasdasd', '2000', '2000', '20', '2400.00', 'Pieces', 'Pieces', '1', '0', '0', '03-01-2021 04:21 pm', '85', '1');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `note_id` int(11) NOT NULL,
  `user_id` varchar(32) NOT NULL,
  `note_data` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`note_id`, `user_id`, `note_data`) VALUES
(12, '3', 'asdasdasdasdasd');

-- --------------------------------------------------------

--
-- Table structure for table `purchased_item`
--

CREATE TABLE `purchased_item` (
  `purchased_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `item_id` varchar(32) NOT NULL,
  `item_count` varchar(32) NOT NULL,
  `item_on_warehouse` varchar(32) NOT NULL,
  `item_on_store` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchased_item`
--

INSERT INTO `purchased_item` (`purchased_id`, `transaction_id`, `item_id`, `item_count`, `item_on_warehouse`, `item_on_store`) VALUES
(1, 0, '2', '20', '0', '25'),
(2, 2, '2', '22', '1', '0'),
(4, 4, '2', '1.00', '0', '1'),
(5, 5, '1', '2', '0', '2'),
(7, 7, '2', '25.00', '1', '0'),
(8, 8, '2', '25.00', '1', '0'),
(9, 9, '2', '25.00', '1', '0'),
(10, 10, '2', '25.00', '1', '0'),
(11, 11, '2', '25.00', '1', '0'),
(12, 12, '2', '25.00', '1', '0'),
(13, 13, '2', '25.00', '1', '0'),
(14, 14, '1', '1.00', '1', '0'),
(15, 14, '1', '1.00', '0', '1'),
(16, 15, '2', '25.00', '1', '0'),
(17, 16, '2', '5.00', '0', '5'),
(18, 17, '1', '6.00', '0', '6'),
(19, 18, '1', '1.00', '1', '0'),
(20, 19, '1', '1.00', '1', '0'),
(21, 20, '1', '1.00', '0', '1'),
(22, 21, '2', '50.00', '2', '0');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL,
  `user_id` varchar(32) NOT NULL,
  `item_id` varchar(32) NOT NULL,
  `report_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stock_transfer`
--

CREATE TABLE `stock_transfer` (
  `transfer_id` int(11) NOT NULL,
  `user_id` varchar(32) NOT NULL,
  `transfer_date` varchar(32) NOT NULL,
  `transfer_time` varchar(32) NOT NULL,
  `driver_name` varchar(32) DEFAULT NULL,
  `plate_no` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `transaction_datetime` varchar(32) NOT NULL,
  `user_id` varchar(32) DEFAULT NULL,
  `courier` varchar(32) DEFAULT NULL,
  `cash` varchar(32) DEFAULT NULL,
  `reciept_no` varchar(32) DEFAULT NULL,
  `payment` varchar(32) NOT NULL,
  `customer` text NOT NULL,
  `address` text NOT NULL,
  `contact_no` varchar(32) NOT NULL,
  `discount` varchar(32) NOT NULL DEFAULT '0',
  `paid` varchar(12) NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `transaction_type`, `transaction_datetime`, `user_id`, `courier`, `cash`, `reciept_no`, `payment`, `customer`, `address`, `contact_no`, `discount`, `paid`) VALUES
(2, 'outgoing', '03-01-2021 03:34 pm', '3', 'asd', '2500', '123453', 'cod', 'asd', '', '', '0', 'true'),
(3, 'outgoing', '03-01-2021 03:35 pm', '3', 'counter', '2500', '123454', 'none', 'none', '', '', '0', 'true'),
(4, 'outgoing', '03-01-2021 03:36 pm', '3', 'counter', '100', '123455', 'none', 'none', '', '', '0', 'true'),
(5, 'outgoing', '03-01-2021 04:004 pm', '3', 'counter', '1500', '123456', 'none', 'none', '', '', '0', 'true'),
(6, 'outgoing', '03-01-2021 04:006 pm', '3', 'counter', '2500', '123457', 'none', 'none', '', '', '0', 'true'),
(7, 'outgoing', '03-01-2021 04:008 pm', '3', 'counter', '2500', '123458', 'none', 'none', '', '', '0', 'true'),
(8, 'outgoing', '03-01-2021 04:11 pm', '3', 'counter', '2400', '123459', 'none', 'none', '', '', '0', 'true'),
(9, 'outgoing', '03-01-2021 04:12 pm', '3', 'counter', '2400', '123460', 'none', 'none', '', '', '0', 'true'),
(10, 'outgoing', '03-01-2021 04:13 pm', '3', 'counter', '2500', '123461', 'none', 'none', '', '', '0', 'true'),
(11, 'outgoing', '03-01-2021 04:13 pm', '3', 'counter', '2500', '123462', 'none', 'none', '', '', '0', 'true'),
(12, 'outgoing', '03-01-2021 04:15 pm', '3', 'counter', '2500', '123463', 'none', 'none', '', '', '0', 'true'),
(13, 'outgoing', '03-01-2021 04:15 pm', '3', 'counter', '2500', '123464', 'none', 'none', '', '', '0', 'true'),
(14, 'outgoing', '03-01-2021 04:16 pm', '3', 'counter', '500', '123465', 'none', 'none', '', '', '0', 'true'),
(15, 'outgoing', '03-01-2021 04:16 pm', '3', 'counter', '2500', '123466', 'none', 'none', '', '', '0', 'true'),
(16, 'outgoing', '03-01-2021 04:16 pm', '3', 'counter', '480', '123467', 'none', 'none', '', '', '0', 'true'),
(17, 'outgoing', '03-01-2021 04:49 pm', '4', 'counter', '2000', '123468', 'none', 'none', '', '', '0', 'true'),
(18, 'outgoing', '03-01-2021 05:005 pm', '3', 'asd', '0', '123469', 'cod', 'asd', '', '', '0', 'false'),
(19, 'outgoing', '03-01-2021 05:10 pm', '3', 'asd', '0', '123470', 'cod', 'asd', '', '', '0', 'false'),
(20, 'outgoing', '03-01-2021 05:10 pm', '3', 'asd', '0', '123471', 'cod', 'asd', 'asd', 'asd', '0', 'false'),
(21, 'outgoing', '03-01-2021 05:24 pm', '3', 'asdasd', '0', '123472', 'cod', 'asd', '', '', '0', 'false'),
(24, 'incoming', '03-02-2021 01:42 pm', NULL, NULL, NULL, NULL, '', '', '', '', '0', 'false'),
(25, 'incoming', '03-02-2021 01:42 pm', NULL, NULL, NULL, NULL, '', '', '', '', '0', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `transfered_items`
--

CREATE TABLE `transfered_items` (
  `transfered_id` int(11) NOT NULL,
  `transfer_id` varchar(32) NOT NULL,
  `item_id` varchar(32) NOT NULL,
  `item_count` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(4, 'accountant', '$2y$10$XX42mRPFsW0dln.JbXnXtu3oI9oc.TZuJeJxjuYkCaI7/EZIYAU9m', 'Acc', 'ountant', 'user.jpg', 'accountant', 'asd@gmail.com'),
(5, 'encoder', '$2y$10$47.rnNPYuY0SRnigUi8uze.6FgfBwqZAajvD.IVz6CbNFhPxaHw9e', 'En', 'coder', 'user.jpg', 'encoder', 'de@gmail.com');

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
-- Indexes for table `incoming_details`
--
ALTER TABLE `incoming_details`
  ADD PRIMARY KEY (`incoming_details_id`);

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
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`note_id`);

--
-- Indexes for table `purchased_item`
--
ALTER TABLE `purchased_item`
  ADD PRIMARY KEY (`purchased_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `stock_transfer`
--
ALTER TABLE `stock_transfer`
  ADD PRIMARY KEY (`transfer_id`);

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
-- Indexes for table `transfered_items`
--
ALTER TABLE `transfered_items`
  ADD PRIMARY KEY (`transfered_id`);

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
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `damaged_items`
--
ALTER TABLE `damaged_items`
  MODIFY `damage_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incoming_details`
--
ALTER TABLE `incoming_details`
  MODIFY `incoming_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `incoming_transaction`
--
ALTER TABLE `incoming_transaction`
  MODIFY `incoming_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `purchased_item`
--
ALTER TABLE `purchased_item`
  MODIFY `purchased_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_transfer`
--
ALTER TABLE `stock_transfer`
  MODIFY `transfer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `transfered_items`
--
ALTER TABLE `transfered_items`
  MODIFY `transfered_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
