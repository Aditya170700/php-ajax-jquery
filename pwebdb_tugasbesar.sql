-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2020 at 06:24 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pwebdb_tugasbesar`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `product_code` char(3) DEFAULT NULL,
  `cart_qty` smallint(4) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Makanan Ringan'),
(3, 'Snack');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL,
  `member_name` varchar(30) DEFAULT NULL,
  `member_address` varchar(255) DEFAULT NULL,
  `member_phone` varchar(20) DEFAULT NULL,
  `member_email` varchar(40) DEFAULT NULL,
  `member_password` varchar(255) DEFAULT NULL,
  `member_identity` char(16) DEFAULT NULL,
  `member_gender` enum('L','P') DEFAULT NULL,
  `member_saldo` int(11) DEFAULT NULL,
  `member_status` enum('0','1','2') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `member_name`, `member_address`, `member_phone`, `member_email`, `member_password`, `member_identity`, `member_gender`, `member_saldo`, `member_status`) VALUES
(14, 'Mela Sintiya', 'Watusigar RT03 RW12, Watusigar, Ngawen', '08812668976', 'mela@gmail.com', '$2y$10$l7mZFMpkfAXvEhdQ5xJxFO7wbxojKf/E9pcLIBF8taRQ/c7GBI7R2', '3403131707000001', 'L', 0, '2'),
(15, 'Aditya Ricki Julianto', 'Kampus 1 Universitas Teknologi Yogyakarta', '08812668976', 'aditya@gmail.com', '$2y$10$tFpXiG0AoSNO.B937qviX.dGkVINzy4QaQgB/vX6X8cT5vm76zA2q', '3403131707000001', 'L', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `ordering`
--

CREATE TABLE `ordering` (
  `id` int(11) NOT NULL,
  `order_date` date DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `count_items` smallint(4) DEFAULT NULL,
  `product_code` char(3) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ordering`
--

INSERT INTO `ordering` (`id`, `order_date`, `amount`, `count_items`, `product_code`, `member_id`) VALUES
(9, '2020-05-20', 100000, 1, 'PR1', 14),
(10, '2020-05-20', 400000, 2, 'PR2', 14);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_code` char(3) NOT NULL,
  `product_name` varchar(30) DEFAULT NULL,
  `product_price` int(11) DEFAULT NULL,
  `product_desc` text DEFAULT NULL,
  `product_number` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_code`, `product_name`, `product_price`, `product_desc`, `product_number`, `category_id`) VALUES
('PR1', 'Tempe Goreng', 100000, 'Tempe adalah makanan orang Jawa yang terbuat dari fermentasi terhadap biji kedelai atau beberapa bahan lain yang menggunakan beberapa jenis kapang Rhizopus, seperti Rhizopus oligosporus, Rh. oryzae, Rh. stolonifer, atau Rh. arrhizus. Sediaan fermentasi ini secara umum dikenal sebagai \"ragi tempe\".', 1, 1),
('PR2', 'Tahu', 200000, 'Tahu adalah makanan yang dibuat dari endapan perasan biji kedelai yang mengalami koagulasi. Tahu berasal dari Tiongkok, seperti halnya kecap, tauco, bakpau, dan bakso. Nama \"tahu\" merupakan serapan dari bahasa Hokkian, yang secara harfiah berarti \"kedelai terfermentasi\".', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `product_code` (`product_code`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `ordering`
--
ALTER TABLE `ordering`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `product_code` (`product_code`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_code`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ordering`
--
ALTER TABLE `ordering`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_code`) REFERENCES `product` (`product_code`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);

--
-- Constraints for table `ordering`
--
ALTER TABLE `ordering`
  ADD CONSTRAINT `ordering_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`),
  ADD CONSTRAINT `ordering_ibfk_2` FOREIGN KEY (`product_code`) REFERENCES `product` (`product_code`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
