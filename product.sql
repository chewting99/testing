-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2018 at 07:30 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `product`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `product_id` varchar(5) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` decimal(9,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `username` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `handbag`
--

CREATE TABLE `handbag` (
  `handbag_ID` varchar(5) NOT NULL,
  `handbag_name` varchar(100) NOT NULL,
  `handbag_image` varchar(200) NOT NULL,
  `handbag_price` decimal(9,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `item_type` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `handbag`
--

INSERT INTO `handbag` (`handbag_ID`, `handbag_name`, `handbag_image`, `handbag_price`, `quantity`, `item_type`) VALUES
('B1001', 'The Monday Blue', 'Picture/Image/backpack1.jpg', '699.00', 2, 'B'),
('B1002', 'TOP man blue', 'Picture/Image/backpack2.jpg', '499.00', 1, 'B'),
('B1003', 'Deep blue backpack', 'Picture/Image/backpack3.jpg', '49.00', 2, 'B'),
('B1004', 'Herschel blue fashion ', 'Picture/Image/backpack4.jpg', '149.00', 1, 'B'),
('B1005', 'HYPE sky blue', 'Picture/Image/backpack5.jpg', '499.00', 1, 'B'),
('B1006', 'FJALLRAVEN KANKEN RED', 'Picture/Image/backpack6.jpg', '99.99', 1, 'B'),
('B1007', 'Red stripped ', 'Picture/Image/backpack7.jpg', '299.00', 1, 'B'),
('B1008', 'Gucci top red', 'Picture/Image/backpack8.jpg', '999.00', 1, 'B'),
('B1009', 'Korean style red', 'Picture/Image/backpack9.jpg', '39.00', 1, 'B'),
('H1001', 'LOVE red handbag', 'Picture/Image/womenBag1.jpg', '599.00', 1, 'H'),
('H1002', 'PlayBoy handbag', 'Picture/Image/womenBag2.jpg', '2599.00', 1, 'H'),
('H1003', 'Crimson web handbag', 'Picture/Image/womenBag3.jpg', '499.00', 1, 'H'),
('H1004', 'Autotronic red handbag', 'Picture/Image/womenBag4.jpg', '399.00', 1, 'H'),
('H1005', 'mickey mouse red', 'Picture/Image/womenBag5.jpg', '199.00', 1, 'H'),
('H1006', 'Bonia blue', 'Picture/Image/womenBag6.jpg', '999.00', 1, 'H'),
('H1007', 'Blue rose', 'Picture/Image/womenBag7.jpg', '499.00', 1, 'H'),
('H1008', 'ELLE top blue', 'Picture/Image/womenBag8.jpg', '799.00', 1, 'H'),
('H1009', 'Playboy blue fashion', 'Picture/Image/womenBag9.jpg', '999.00', 1, 'H'),
('T1001', 'SUPREME travel bag', 'Picture/Image/travelbag1.jpg', '9999.00', 1, 'T'),
('T1002', 'American Touter', 'Picture/Image/travelbag2.jpg', '499.00', 1, 'T'),
('T1003', 'Apple red travel bag', 'Picture/Image/travelbag3.jpg', '199.00', 1, 'T'),
('T1004', 'Sun red travel bag', 'Picture/Image/travelbag4.jpg', '699.00', 1, 'T'),
('T1005', 'Gucci red travel bag', 'Picture/Image/travelbag5.jpg', '2099.00', 1, 'T'),
('T1006', 'Blue sky travel bag', 'Picture/Image/travelbag6.jpg', '399.00', 1, 'T'),
('T1007', 'Assiimov blue travel bag', 'Picture/Image/travelbag7.jpg', '899.00', 1, 'T'),
('T1008', 'Bright water blue travel bag', 'Picture/Image/travelbag8.jpg', '1500.00', 1, '0'),
('T1009', 'Scepter travel bag', 'Picture/Image/travelbag9.jpg', '599.00', 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `manager_username` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `manager_pass` varchar(16) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`manager_username`, `manager_pass`) VALUES
('manager1', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `orderlist`
--

CREATE TABLE `orderlist` (
  `order_id` int(11) NOT NULL,
  `prod_id` varchar(5) NOT NULL,
  `order_date` date NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `total_amount` decimal(11,2) NOT NULL,
  `username` varchar(32) NOT NULL,
  `order_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderlist`
--

INSERT INTO `orderlist` (`order_id`, `prod_id`, `order_date`, `item_name`, `order_quantity`, `total_amount`, `username`, `order_status`) VALUES
(19, 'B1001', '2018-08-07', 'The Monday Blue', 1, '699.00', 'Anonymous', 'Delivered'),
(20, 'B1001', '2018-08-07', 'The Monday Blue', 1, '699.00', 'feng9991', 'Delivered'),
(21, 'B1003', '2018-08-07', 'Deep blue backpack', 1, '49.00', 'feng9991', 'Delivered'),
(22, 'B1001', '2018-08-07', 'The Monday Blue', 1, '699.00', 'feng9991', 'Delivered'),
(23, 'B1001', '2018-08-07', 'The Monday Blue', 1, '699.00', 'feng9991', 'Delivered'),
(24, 'B1001', '2018-08-07', 'The Monday Blue', 1, '699.00', 'theam1127', 'Delivered'),
(26, 'B1001', '2018-08-08', 'The Monday Blue', 1, '699.00', 'emojuin', 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rate_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(5) NOT NULL,
  `username_rate` varchar(100) NOT NULL,
  `star` int(11) NOT NULL,
  `comment` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rate_id`, `order_id`, `product_id`, `username_rate`, `star`, `comment`) VALUES
(26, 19, 'B1001', 'Anonymous', 20, 'very bad, must give 1 star'),
(28, 21, 'B1003', 'feng9991', 20, '1 star å·®è¯„å·®è¯„'),
(33, 24, 'B1001', 'theam1127', 20, 'å¾ˆå·®å¾ˆå·®ï¼Œ å·®è¯„'),
(34, 26, 'B1001', 'emojuin', 100, 'çœŸé¸¡å·´èµžï¼Œ å¥½è¯„å¥½è¯„');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `username` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(35) NOT NULL,
  `password` varchar(16) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` char(11) NOT NULL,
  `gender` char(1) NOT NULL,
  `birthday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`username`, `email`, `password`, `name`, `phone`, `gender`, `birthday`) VALUES
('chewting1999', 'chewting99@gmail.com', 'abc123', 'Chew Ting', '010-4030227', 'F', '1999-01-08'),
('emojuin', 'juinta0813@gmail.com', 'blowjob69', 'Juin Ta', '013-4567891', 'M', '1997-08-13'),
('feng9991', 'feng489699@gmail.com', '1234', 'Zhen Feng', '010-4030227', 'M', '1999-05-24'),
('theam1127', 'theam1997@gmail.com', '19971127', 'Yeh Theam', '019223022', 'M', '1997-10-22');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `product_ID` char(5) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` decimal(9,2) NOT NULL,
  `username` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`product_ID`, `product_name`, `product_price`, `username`) VALUES
('B1001', 'The Monday Blue', '699.00', ''),
('B1001', 'The Monday Blue', '699.00', ''),
('B1001', 'The Monday Blue', '699.00', ''),
('B1001', 'The Monday Blue', '699.00', ''),
('B1001', 'The Monday Blue', '699.00', ''),
('B1001', 'The Monday Blue', '699.00', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `handbag`
--
ALTER TABLE `handbag`
  ADD PRIMARY KEY (`handbag_ID`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`manager_username`);

--
-- Indexes for table `orderlist`
--
ALTER TABLE `orderlist`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rate_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orderlist`
--
ALTER TABLE `orderlist`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
