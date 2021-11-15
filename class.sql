-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2021 at 06:03 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `class`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bauthor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bprice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `bname`, `bauthor`, `bprice`, `userid`) VALUES
(72, 'bahubali', 'Ut dolor blanditiis ', '100', 1053),
(73, 'bahubali 2', 'Voluptas ea quae nos', '200', 1053),
(74, 'bahubali 3 ', 'Possimus adipisicin', '500', 1053),
(76, 'bahubali 4', 'Sunt explicabo Nihi', '999', 1055),
(82, 'bahubali 5', 'rajamouli', '1', 1055),
(83, 'bahubali 6', 'rajamouli', '666', 1055);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cid` int(50) NOT NULL,
  `uid` int(50) NOT NULL,
  `pid` int(50) NOT NULL,
  `quantity` varchar(50) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ordereditems`
--

CREATE TABLE `ordereditems` (
  `oiid` int(11) NOT NULL,
  `orderid` varchar(255) NOT NULL,
  `pid` int(255) NOT NULL,
  `quantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `oid` int(11) NOT NULL,
  `orderid` varchar(255) NOT NULL,
  `uid` int(50) NOT NULL,
  `total` int(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `role` int(50) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `mobile`, `role`, `photo`) VALUES
(1053, 'sathish', 'sathish@gmail.com', '1234', '', 0, '153273.jpg'),
(1054, 'Keith Hartman', 'lipuzap@mailinator.com', 'Aliqua Cillum imped', '', 0, '153243.jpg'),
(1055, 'sandeep', 'sandeep@gmail.com', '1234', '', 0, '153271.jpg'),
(1057, 'Debra Sargent', 'becu@mailinator.com', '1234', '9621533107', 0, 'engine.jpg'),
(1060, 'Adam Benjamin', 'vesohydyjo@mailinator.com', 'Soluta enim autem la', '10', 0, ''),
(1061, 'Cheyenne Grimes', 'kamubary@mailinator.com', 'Quasi irure est porr', '60', 0, ''),
(1062, 'Reagan Fowler', 'divumin@mailinator.com', 'Veniam voluptas qui', '83', 0, ''),
(1063, 'Clayton Perry', 'pamewa@mailinator.com', 'Corrupti amet exce', '22', 0, ''),
(1064, 'Harper Chambers', 'durahomeqy@mailinator.com', 'Fugit excepteur vol', '86', 0, ''),
(1065, 'Lillith Daniels', 'kuvan@mailinator.com', 'Rem est eum quia rer', '94', 0, ''),
(1066, 'Patricia Barrera', 'wotudafy@mailinator.com', 'Qui ullam et quibusd', '70', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `ordereditems`
--
ALTER TABLE `ordereditems`
  ADD PRIMARY KEY (`oiid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`oid`),
  ADD UNIQUE KEY `orderid` (`orderid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cid` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `ordereditems`
--
ALTER TABLE `ordereditems`
  MODIFY `oiid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1067;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
