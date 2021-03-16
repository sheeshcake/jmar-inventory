-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2021 at 09:22 AM
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

--
-- Dumping data for table `damaged_items`
--

INSERT INTO `damaged_items` (`damage_id`, `item_id`, `item_count`, `damage_datetime`) VALUES
(9, '59', '2', '12-04-2020 04:10 pm'),
(10, '66', '2', '12-16-2020 02:16 pm'),
(11, '67', '3', '01-08-2021 02:08 pm'),
(12, '67', '10', '01-08-2021 02:08 pm'),
(13, '69', '1', '01-13-2021 01:44 pm');

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
(28, '97', '66', '100'),
(29, '98', '66', '50'),
(30, '101', '66', '200'),
(31, '105', '77', '20'),
(32, '105', '77', '20'),
(33, '105', '77', '20'),
(34, '112', '67', '25'),
(35, '113', '77', '20'),
(36, '113', '101', '0'),
(37, '114', '77', '20'),
(38, '114', '101', '0'),
(39, '115', '67', '25'),
(40, '115', '102', '0'),
(41, '116', '78', '20'),
(42, '116', '103', '0'),
(43, '117', '79', '20'),
(44, '117', '107', '2'),
(45, '118', '79', '20'),
(46, '118', '108', '2'),
(47, '119', '77', '20'),
(48, '119', '113', '2'),
(49, '120', '79', '20'),
(50, '120', '114', '2'),
(51, '121', '117', '1'),
(52, '124', '117', '1'),
(53, '125', '79', '20'),
(54, '125', '130', '1');

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
(67, 'Factory-Price-Roofing-Screw-Nails-for-Roof-Building-and-Construction.jpg', 'Roof Nail', 'None', 'nail', 'Sack', '25', '20.00', '20.00', '10.00', '700.00', '96', '12-15-2020 11:34 am', '131', '1'),
(69, 'color-samples.png', 'Enamel Paint', 'Boysen', 'asd', 'Box', '12', '20', '100', '20', '1500', '45', '12-15-2020 11:44 am', '86', '1'),
(70, '127225904_795555357966704_6894168839991592545_n.jpg', 'Sad', 'Boi', 'sad boi 69\ncalculation algorithm test', 'Box', '30', '20.00', '100.67', '50.00', '2450.00', '135', '12-16-2020 03:42 pm', '86', '1'),
(75, 'a4e97c3e-8b98-4081-a3f8-53c9ec806c77.jpeg', 'Plywood', 'None', 'Alexandria B-C grade pine plywood handy panel is p\nB-C grade\nSuitable for use that requires a smooth surface (sanded)\nSuperior dimensional stability\nExceptional strength durability\n1/2 inch x 4 feet width x 4 feet length size plywood panels', 'Box', '10', '10.00', '1000.00', '10.00', '10000.00', '110', '01-07-2021 03:26 pm', '87', '1'),
(76, 'pipe.jpg', 'Water Distribution Pipes', 'None', 'Length of one pipe	3m, 6m, 12 m\nType	Hard Tube\nThickness	2-8mm\nColor	White\nNominal', 'Box', '100', '0.00', '10.00', '10.00', '1000.00', '1010', '01-08-2021 09:41 am', '130', '1'),
(77, 'paint roller.jpg', 'Paint Roller', 'None', 'Rodapin Non-Drip Paint Roller, 11522', 'Box', '20', '10.00', '25.00', '20.00', '500.00', '330', '01-08-2021 09:49 am', '132', '1'),
(78, 'Toughened-Glass.jpg', 'Glass', 'None', 'Home décor and furnishing trends have come a long way. From wood to metals and now glass, there are stylish designs options that can instantly beautify your interiors.', 'Box', '20', '0.00', '100.00', '20.00', '2000.00', '40', '01-08-2021 10:01 am', '128', '1'),
(79, 'cement.jpg', 'Cement', 'None', 'Largest size:\n5000 x 3750 px (16.67 x 12.50 in.) - 300 dpi - RGB', 'Sack', '20', '20.00', '50.00', '10.00', '1000.00', '290', '01-08-2021 11:05 am', '129', '1'),
(130, '134743841_734630747173737_5538955419837420893_n.png', 'asd', 'asd', 'asd', 'Sack', '1', '1.00', '1.00', '1.00', '1.00', '0', '01-14-2021 01:14 pm', '132', '1'),
(131, 'es-led-bulb3w-sale-654x800.jpg', 'ES LED BULB 3w', 'Firefly', 'ELBLB1-3W-E27-WW	Specifications\r\nWattage	3 Watts\r\nLuminous Flux	300 lm\r\nLight Source	High bright LED SMD\r\nColor Temperature	2700 – 3000 K / Warm White\r\nPC Cover	Frosted\r\nMaterial	PC Cover and Aluminum PCB\r\nBulb Holder	E27\r\nBeam Angle	120 Degrees\r\nWorking Voltage	AC 85-265V', 'Sack', '50', '20', '48.00', '10', '2400', '50', '01-14-2021 01:21 pm', '85', '1');

-- --------------------------------------------------------

--
-- Table structure for table `purchased_item`
--

CREATE TABLE `purchased_item` (
  `purchased_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `item_id` varchar(32) NOT NULL,
  `item_count` varchar(32) NOT NULL,
  `item_type` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchased_item`
--

INSERT INTO `purchased_item` (`purchased_id`, `transaction_id`, `item_id`, `item_count`, `item_type`) VALUES
(61, 95, '69', '1.00', 'retail'),
(62, 95, '67', '25.00', 'wholesale'),
(63, 95, '66', '50.00', 'wholesale'),
(64, 96, '66', '12.00', 'retail'),
(65, 96, '66', '7650.00', 'wholesale'),
(66, 99, '66', '1.00', 'retail'),
(67, 100, '66', '149.00', 'retail'),
(69, 102, '66', '1.00', 'retail'),
(71, 104, '67', '5.00', 'retail'),
(72, 104, '66', '5.00', 'retail'),
(74, 107, '67', '5.00', 'retail'),
(82, 123, '67', '23', 'wholesale'),
(83, 126, '69', '1.00', 'retail'),
(84, 126, '67', '1.00', 'retail'),
(85, 127, '130', '1.00', 'retail'),
(86, 128, '78', '400.00', 'wholesale'),
(87, 129, '67', '1.00', 'retail'),
(88, 130, '67', '1.00', 'retail'),
(89, 131, '69', '1.00', 'retail'),
(90, 132, '69', '1.00', 'retail'),
(91, 133, '67', '1.00', 'retail'),
(92, 133, '67', '1.00', 'retail'),
(93, 134, '67', '1.00', 'retail'),
(94, 134, '67', '1.00', 'retail'),
(95, 135, '67', '1.00', 'retail'),
(96, 136, '67', '1.00', 'retail'),
(97, 137, '67', '1.00', 'retail');

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
  `courier` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `transaction_type`, `transaction_datetime`, `user_id`, `courier`) VALUES
(95, 'outgoing', '12-18-2020 02:20 pm', NULL, NULL),
(96, 'outgoing', '12-18-2020 02:40 pm', NULL, NULL),
(97, 'incoming', '12-18-2020 02:47 pm', NULL, NULL),
(98, 'incoming', '12-18-2020 02:47 pm', NULL, NULL),
(99, 'outgoing', '12-18-2020 02:48 pm', NULL, NULL),
(100, 'outgoing', '12-18-2020 04:006 pm', NULL, NULL),
(101, 'incoming', '12-18-2020 04:009 pm', NULL, NULL),
(102, 'outgoing', '01-07-2021 03:32 pm', NULL, NULL),
(103, 'outgoing', '01-08-2021 09:54 am', NULL, NULL),
(104, 'outgoing', '01-08-2021 10:002 am', NULL, NULL),
(105, 'incoming', '01-08-2021 10:24 am', NULL, NULL),
(106, 'outgoing', '01-08-2021 10:28 am', NULL, NULL),
(107, 'outgoing', '01-08-2021 10:29 am', NULL, NULL),
(108, 'outgoing', '01-08-2021 10:32 am', NULL, NULL),
(109, 'outgoing', '01-08-2021 10:33 am', NULL, NULL),
(110, 'outgoing', '01-08-2021 01:27 pm', NULL, NULL),
(111, 'outgoing', '01-08-2021 02:006 pm', NULL, NULL),
(112, 'incoming', '01-12-2021 02:004 pm', NULL, NULL),
(113, 'incoming', '01-12-2021 03:46 pm', NULL, NULL),
(114, 'incoming', '01-12-2021 03:46 pm', NULL, NULL),
(115, 'incoming', '01-12-2021 03:50 pm', NULL, NULL),
(116, 'incoming', '01-12-2021 03:53 pm', NULL, NULL),
(117, 'incoming', '01-12-2021 04:000 pm', NULL, NULL),
(118, 'incoming', '01-12-2021 04:001 pm', NULL, NULL),
(119, 'incoming', '01-12-2021 04:009 pm', NULL, NULL),
(120, 'incoming', '01-12-2021 04:11 pm', NULL, NULL),
(121, 'incoming', '01-12-2021 04:40 pm', NULL, NULL),
(122, 'outgoing', '01-13-2021 01:30 pm', NULL, NULL),
(123, 'outgoing', '01-13-2021 01:46 pm', NULL, NULL),
(124, 'incoming', '01-13-2021 01:47 pm', NULL, NULL),
(125, 'incoming', '01-14-2021 01:14 pm', NULL, NULL),
(126, 'outgoing', '01-14-2021 01:30 pm', NULL, NULL),
(127, 'outgoing', '01-19-2021 03:15 pm', NULL, NULL),
(128, 'outgoing', '01-19-2021 03:15 pm', NULL, NULL),
(129, 'outgoing', '01-19-2021 04:001 pm', NULL, NULL),
(130, 'outgoing', '01-19-2021 04:001 pm', NULL, NULL),
(131, 'outgoing', '01-19-2021 04:002 pm', NULL, NULL),
(132, 'outgoing', '01-19-2021 04:003 pm', NULL, NULL),
(133, 'outgoing', '01-19-2021 04:005 pm', '', NULL),
(134, 'outgoing', '01-19-2021 04:005 pm', '', NULL),
(135, 'outgoing', '01-19-2021 04:005 pm', '', NULL),
(136, 'outgoing', '01-19-2021 04:007 pm', '3', NULL),
(137, 'outgoing', '01-19-2021 04:16 pm', '3', 'Raul');

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
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `damaged_items`
--
ALTER TABLE `damaged_items`
  MODIFY `damage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `incoming_transaction`
--
ALTER TABLE `incoming_transaction`
  MODIFY `incoming_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `purchased_item`
--
ALTER TABLE `purchased_item`
  MODIFY `purchased_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
