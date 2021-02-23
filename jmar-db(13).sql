-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2021 at 07:08 AM
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
(4, '157', 'asd', 'asd', 'asd', 'cod', 'asd', 'asd'),
(5, '158', 'asd', 'asd', 'asd', 'cod', 'asd', 'asd'),
(6, '159', 'qwe', 'qwe', 'qwe', 'cod', 'qwe', 'qwe'),
(7, '160', 'asd', 'asd', 'asd', 'cod', 'asd', 'asd'),
(8, '161', 'asd', 'asd', 'asd', 'cod', 'asd', 'asd');

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
(58, '157', '78', '200'),
(59, '158', '78', '200'),
(60, '159', '77', '2.00'),
(61, '160', '69', '1.00'),
(62, '161', '69', '12');

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
  `item_unit_divisor` varchar(32) DEFAULT NULL,
  `item_tax` varchar(32) NOT NULL,
  `item_price` varchar(32) NOT NULL,
  `item_tax_wholesale` varchar(32) NOT NULL,
  `item_price_wholesale` varchar(32) NOT NULL,
  `item_stock` varchar(32) NOT NULL,
  `item_stock_warehouse` varchar(32) NOT NULL DEFAULT '0',
  `sell_in_wholesale` varchar(12) NOT NULL,
  `item_added` varchar(32) NOT NULL,
  `category_id` varchar(32) NOT NULL,
  `supplier_id` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_img`, `item_name`, `item_brand`, `item_desc`, `item_unit`, `item_unit_divisor`, `item_tax`, `item_price`, `item_tax_wholesale`, `item_price_wholesale`, `item_stock`, `item_stock_warehouse`, `sell_in_wholesale`, `item_added`, `category_id`, `supplier_id`) VALUES
(69, 'color-samples.png', 'Enamel Paint', 'Boysen', 'asd', 'Box', '12', '20', '100', '20', '1500', '24', '13', 'true', '12-15-2020 11:44 am', '86', '1'),
(70, '127225904_795555357966704_6894168839991592545_n.jpg', 'Sad', 'Boi', 'sad boi 69\ncalculation algorithm test', 'Box', '30', '20.00', '100.67', '50.00', '2450.00', '134', '0', 'true', '12-16-2020 03:42 pm', '86', '1'),
(75, 'a4e97c3e-8b98-4081-a3f8-53c9ec806c77.jpeg', 'Plywood', 'None', 'Alexandria B-C grade pine plywood handy panel is p\nB-C grade\nSuitable for use that requires a smooth surface (sanded)\nSuperior dimensional stability\nExceptional strength durability\n1/2 inch x 4 feet width x 4 feet length size plywood panels', 'Box', '10', '10.00', '1000.00', '10.00', '10000.00', '110', '0', 'true', '01-07-2021 03:26 pm', '87', '1'),
(76, 'pipe.jpg', 'Water Distribution Pipes', 'None', 'Length of one pipe	3m, 6m, 12 m\nType	Hard Tube\nThickness	2-8mm\nColor	White\nNominal', 'Box', '100', '0.00', '10.00', '10.00', '1000.00', '1009', '0', 'true', '01-08-2021 09:41 am', '130', '1'),
(77, 'paint roller.jpg', 'Paint Roller', 'None', 'Rodapin Non-Drip Paint Roller, 11522', 'Box', '20', '10.00', '25.00', '20.00', '500.00', '330', '2', 'true', '01-08-2021 09:49 am', '132', '1'),
(78, 'Toughened-Glass.jpg', 'Glass', 'None', 'Home décor and furnishing trends have come a long way. From wood to metals and now glass, there are stylish designs options that can instantly beautify your interiors.', 'Box', '20', '0.00', '100.00', '20.00', '2000.00', '243', '200', 'true', '01-08-2021 10:01 am', '128', '1'),
(79, 'cement.jpg', 'Cement', 'None', 'Largest size:\n5000 x 3750 px (16.67 x 12.50 in.) - 300 dpi - RGB', 'Sack', '20', '20.00', '50.00', '10.00', '1000.00', '290', '0', 'true', '01-08-2021 11:05 am', '129', '1'),
(131, 'es-led-bulb3w-sale-654x800.jpg', 'ES LED BULB 3w', 'Firefly', 'ELBLB1-3W-E27-WW	Specifications\nWattage	3 Watts\nLuminous Flux	300 lm\nLight Source	High bright LED SMD\nColor Temperature	2700 – 3000 K / Warm White\nPC Cover	Frosted\nMaterial	PC Cover and Aluminum PCB\nBulb Holder	E27\nBeam Angle	120 Degrees\nWorking Voltage	AC 85-265V', 'Sack', '50', '20.00', '48.00', '10.00', '2405.00', '50', '0', 'true', '01-14-2021 01:21 pm', '85', '1'),
(139, 'about.jpg', 'asd', 'asd', 'asd', 'Pieces', '0', '1.00', '1.00', 'NaN', '100.00', '1', '1', 'false', '02-22-2021 03:43 pm', '85', '1');

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
  `item_type` varchar(32) NOT NULL,
  `item_on_warehouse` varchar(32) NOT NULL,
  `item_on_store` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchased_item`
--

INSERT INTO `purchased_item` (`purchased_id`, `transaction_id`, `item_id`, `item_count`, `item_type`, `item_on_warehouse`, `item_on_store`) VALUES
(126, 155, '67', '1.00', 'retail', '', ''),
(127, 156, '69', '6.00', 'retail', '', ''),
(128, 156, '69', '12.00', 'wholesale', '', '');

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
  `discount` varchar(32) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `transaction_type`, `transaction_datetime`, `user_id`, `courier`, `cash`, `reciept_no`, `payment`, `customer`, `discount`) VALUES
(156, 'outgoing', '02-19-2021 04:42 pm', '3', 'counter', '5000', '', 'none', 'none', '0'),
(157, 'incoming', '02-22-2021 04:21 pm', NULL, NULL, NULL, NULL, '', '', '0'),
(158, 'incoming', '02-22-2021 04:22 pm', NULL, NULL, NULL, NULL, '', '', '0'),
(159, 'incoming', '02-22-2021 04:23 pm', NULL, NULL, NULL, NULL, '', '', '0'),
(160, 'incoming', '02-22-2021 04:56 pm', NULL, NULL, NULL, NULL, '', '', '0'),
(161, 'incoming', '02-22-2021 04:59 pm', NULL, NULL, NULL, NULL, '', '', '0');

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
(4, 'asd', '$2y$10$ESGVyK.l.RidFxLHIVVrt.meLydXjqDddbTu7/z4UihDm7ZnXs/VK', 'asd', 'asd', 'user.jpg', 'accountant', 'asd@gmail.com'),
(5, 'de', '$2y$10$WV/1sv97e2IlLUM7KdHU5.TyEKdYiOKpAda.7qc6AJMHUJV.ZE0HG', 'de', 'de', 'user.jpg', 'encoder', 'de@gmail.com');

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
  MODIFY `damage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `incoming_details`
--
ALTER TABLE `incoming_details`
  MODIFY `incoming_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `incoming_transaction`
--
ALTER TABLE `incoming_transaction`
  MODIFY `incoming_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `purchased_item`
--
ALTER TABLE `purchased_item`
  MODIFY `purchased_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

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
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

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
