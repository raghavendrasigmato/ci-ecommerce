-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2018 at 10:13 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amruth`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `login_id` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `login_id`, `pwd`, `email_id`) VALUES
(1, 'admin', 'admin', 'girish.sigmato@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `attribute_id` int(11) NOT NULL,
  `attribute_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`attribute_id`, `attribute_name`) VALUES
(1, 'Weight');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(200) NOT NULL,
  `brand_logo_path` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categories_id` int(11) NOT NULL,
  `categories_name` varchar(255) NOT NULL,
  `active_status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`, `active_status`) VALUES
(1, 'Herbs', '1'),
(2, 'Dried Fruits', '1'),
(3, 'Pooja Articles', '1'),
(4, 'Spices', '1'),
(5, 'Others', '1'),
(6, 'test', '0'),
(7, 'test', '0'),
(8, 'test', '0'),
(9, 'Test', '0'),
(10, 'sdefrs', '0'),
(11, 'test12322', '0');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `images_id` int(11) NOT NULL,
  `image_path` longtext NOT NULL,
  `pid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`images_id`, `image_path`, `pid`) VALUES
(1, 'http://localhost/amruth/./assets/backend/img/100518100223C_SDX3422_AKPRH008_P_1481883428938.jpg', 1),
(3, 'http://localhost/amruth/./assets/backend/img/100518125629C_SDX3422_AKPRH055_P_1485431084666.jpg', 3),
(4, 'http://localhost/amruth/./assets/backend/img/100518014701C_SDX3422_AKPRH032_P_1484742178095.jpg', 4),
(5, 'http://localhost/amruth/./assets/backend/img/100518015430C_SDX3422_AKPRP003_P_1482831670056.jpg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `map_attributes_values`
--

CREATE TABLE `map_attributes_values` (
  `map_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `map_attributes_values`
--

INSERT INTO `map_attributes_values` (`map_id`, `attribute_id`, `value`) VALUES
(3, 1, '25 gms'),
(4, 1, '50 gms'),
(5, 1, '100 gms'),
(6, 1, '250 gms');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `txnid` varchar(255) NOT NULL,
  `user_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_no` bigint(20) NOT NULL,
  `pincode` int(10) NOT NULL,
  `locality` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `landmark` varchar(255) NOT NULL,
  `alt_ph_no` bigint(20) NOT NULL,
  `bill_total` double NOT NULL,
  `date` date NOT NULL,
  `status` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `order_prod_id` int(11) NOT NULL,
  `txnid` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pricing_structure`
--

CREATE TABLE `pricing_structure` (
  `structure_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `map_id` int(11) NOT NULL,
  `retail_price` double NOT NULL,
  `retail_price_tax` double NOT NULL,
  `cost_price` double NOT NULL,
  `on_sale_status` enum('0','1') NOT NULL COMMENT '0=non active, 1=active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pricing_structure`
--

INSERT INTO `pricing_structure` (`structure_id`, `pid`, `map_id`, `retail_price`, `retail_price_tax`, `cost_price`, `on_sale_status`) VALUES
(1, 1, 3, 75, 2, 75, '0'),
(3, 3, 4, 115, 5, 115, '0'),
(4, 4, 5, 125, 0, 125, '1'),
(5, 5, 4, 40, 0, 40, '1'),
(6, 5, 5, 50, 2, 50, '0'),
(7, 5, 6, 90, 5, 90, '0');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sub_cat_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `summary` longtext NOT NULL,
  `description` longtext NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `featured_status` enum('0','1') NOT NULL COMMENT '0=non active, 1=active',
  `active_status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=non active, 1=active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `cat_id`, `sub_cat_id`, `name`, `brand_id`, `summary`, `description`, `added_on`, `featured_status`, `active_status`) VALUES
(1, 1, 3, 'Niranjan Phal', NULL, '<p>Locally known, as the &#39;Malva Nut&#39; Niranjan Phal is a native fruit available in South East Asia and is used extensively in many Siddha medicines in India. Niranjan Phal has two essential healing properties as it cools down the body and also relaxes the bowels, eases constipation and cures piles. It is also used as a cleansing and detoxifying agent to cleanse the body.</p>\r\n', '<p>Locally known, as the &#39;Malva Nut&#39; Niranjan Phal is a native fruit available in South East Asia and is used extensively in many Siddha medicines in India. Niranjan Phal has two essential healing properties as it cools down the body and also relaxes the bowels, eases constipation and cures piles. It is also used as a cleansing and detoxifying agent to cleanse the body.</p>\r\n', '2018-05-10 18:30:00', '0', '1'),
(3, 1, 4, 'Bedana-Behdana-Apple Seeds', NULL, '', '', '2018-05-09 18:30:00', '0', '1'),
(4, 1, 3, 'Small Hippli-Sanna Hippli-Thippli-Pipper-Long Pepper', NULL, '', '', '2018-05-09 18:30:00', '0', '1'),
(5, 1, 2, 'Kumkum one', NULL, '<p>Kumkum is prepared using turmeric and lime which gives its characteristic crimson colour. Apart from the religious significance there are many health benefits that are associated with applying kumkum on one&#39;s forehead. Kumkum is believed to calm the sixth chakra that is supposed reside between one&#39;s eyebrows.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', '<p>Kumkum is prepared using turmeric and lime which gives its characteristic crimson colour. Apart from the religious significance there are many health benefits that are associated with applying kumkum on one&#39;s forehead. Kumkum is believed to calm the sixth chakra that is supposed reside between one&#39;s eyebrows.</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2018-05-10 18:30:00', '0', '1');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_master`
--

CREATE TABLE `shipping_master` (
  `shipping_master_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `map_id` int(11) NOT NULL,
  `cost` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping_master`
--

INSERT INTO `shipping_master` (`shipping_master_id`, `pid`, `map_id`, `cost`) VALUES
(1, 1, 4, 75),
(3, 3, 4, 115),
(4, 4, 5, 125),
(5, 5, 4, 40),
(6, 5, 5, 50),
(7, 5, 6, 90);

-- --------------------------------------------------------

--
-- Table structure for table `stock_master`
--

CREATE TABLE `stock_master` (
  `stock_master_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `skuid` varchar(100) NOT NULL,
  `map_id` int(11) NOT NULL,
  `instock` int(11) NOT NULL,
  `reorder_level` int(11) NOT NULL,
  `min_qty_to_order` int(11) NOT NULL,
  `oos_status` enum('0','1') NOT NULL COMMENT '0=deny orders, 1=accept orders'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_master`
--

INSERT INTO `stock_master` (`stock_master_id`, `pid`, `skuid`, `map_id`, `instock`, `reorder_level`, `min_qty_to_order`, `oos_status`) VALUES
(1, 1, 'AK1', 3, 15, 5, 1, '0'),
(3, 3, 'AK2', 4, 25, 5, 1, '0'),
(4, 4, 'AK3', 5, 15, 5, 1, '0'),
(5, 5, 'AK4', 5, 25, 5, 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `subcategories_id` int(11) NOT NULL,
  `subcategories_name` varchar(255) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `active_status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=inactive, 1=active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`subcategories_id`, `subcategories_name`, `categories_id`, `active_status`) VALUES
(1, 'Herbs', 1, '1'),
(2, 'Others', 1, '1'),
(3, 'Fruits', 1, '1'),
(4, 'Seeds', 1, '1'),
(5, 'Roots or Rhizomes', 1, '1'),
(6, 'Subtest', 9, '0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `number` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `email`, `pwd`, `number`) VALUES
(1, 'Raghu', 'sdgfs', 'test@test', '123', 8174649769),
(2, 'Raghavendra', 'Acharya', 'ranarts@gmail.com', '123', 8147649769);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`attribute_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categories_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`images_id`);

--
-- Indexes for table `map_attributes_values`
--
ALTER TABLE `map_attributes_values`
  ADD PRIMARY KEY (`map_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `pricing_structure`
--
ALTER TABLE `pricing_structure`
  ADD PRIMARY KEY (`structure_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `shipping_master`
--
ALTER TABLE `shipping_master`
  ADD PRIMARY KEY (`shipping_master_id`);

--
-- Indexes for table `stock_master`
--
ALTER TABLE `stock_master`
  ADD PRIMARY KEY (`stock_master_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`subcategories_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `attribute_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `images_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `map_attributes_values`
--
ALTER TABLE `map_attributes_values`
  MODIFY `map_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pricing_structure`
--
ALTER TABLE `pricing_structure`
  MODIFY `structure_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shipping_master`
--
ALTER TABLE `shipping_master`
  MODIFY `shipping_master_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stock_master`
--
ALTER TABLE `stock_master`
  MODIFY `stock_master_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `subcategories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
