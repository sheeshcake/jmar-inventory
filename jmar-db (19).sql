-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2021 at 09:34 AM
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
(1, 'Bulbs'),
(2, 'Paints'),
(3, 'Plywood'),
(4, 'Glass'),
(5, 'Cement'),
(6, 'Pipes'),
(7, 'Nails'),
(8, 'Misc');

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


-- --------------------------------------------------------

--
-- Table structure for table `incoming_transaction`
--

CREATE TABLE `incoming_transaction` (
  `incoming_id` int(11) NOT NULL,
  `transaction_id` varchar(32) NOT NULL,
  `item_id` varchar(32) NOT NULL,
  `item_count` varchar(32) NOT NULL,
  `item_on_warehouse` varchar(32) NOT NULL DEFAULT '0',
  `item_on_store` varchar(32) NOT NULL DEFAULT '0',
  `user_id` varchar(32) NOT NULL
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
  `item_capital` varchar(32) NOT NULL,
  `item_capital_retail` varchar(32) NOT NULL,
  `item_tax` varchar(32) NOT NULL,
  `item_tax_type` varchar(32) NOT NULL DEFAULT 'percent',
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


-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_id` int(11) NOT NULL,
  `action` varchar(32) NOT NULL,
  `datetime` varchar(32) NOT NULL,
  `user_id` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `note_id` int(11) NOT NULL,
  `user_id` varchar(32) NOT NULL,
  `note_data` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


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
  `discount_type` varchar(32) NOT NULL DEFAULT 'percent',
  `paid` varchar(12) NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


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
(1, 'jmar', '$2y$10$r.A3Rlgc5FElPfNd1BYrfeghPit8Mp/SJu53Xk4rbIpN7jCrnpsI.', 'J', 'Mar', 'user.jpg', 'admin', 'admin@gmail.com'),
(2, 'accountant', '$2y$10$XX42mRPFsW0dln.JbXnXtu3oI9oc.TZuJeJxjuYkCaI7/EZIYAU9m', 'Acc', 'ountant', 'user.jpg', 'accountant', 'asd@gmail.com'),
(3, 'encoder', '$2y$10$47.rnNPYuY0SRnigUi8uze.6FgfBwqZAajvD.IVz6CbNFhPxaHw9e', 'En', 'coder', 'user.jpg', 'encoder', 'de@gmail.com');

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
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_id`);

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
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `damaged_items`
--
ALTER TABLE `damaged_items`
  MODIFY `damage_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incoming_details`
--
ALTER TABLE `incoming_details`
  MODIFY `incoming_details_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incoming_transaction`
--
ALTER TABLE `incoming_transaction`
  MODIFY `incoming_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchased_item`
--
ALTER TABLE `purchased_item`
  MODIFY `purchased_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transfered_items`
--
ALTER TABLE `transfered_items`
  MODIFY `transfered_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
