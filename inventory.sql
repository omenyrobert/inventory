-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2021 at 08:58 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `profits`
--

CREATE TABLE `profits` (
  `id` bigint(20) NOT NULL,
  `profits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stockin`
--

CREATE TABLE `stockin` (
  `id` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `item` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `bprice` int(11) NOT NULL,
  `sprice` int(11) NOT NULL,
  `businessId` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stockin`
--

INSERT INTO `stockin` (`id`, `date`, `item`, `qty`, `bprice`, `sprice`, `businessId`) VALUES
(1, '2021-11-24', 'mouse', 200, 3000, 5000, ''),
(3, '2021-11-24', 'cable', 2000, 10000, 15000, ''),
(4, '2021-11-24', 'laptop', 20, 300000, 450000, 'DXgrwa4N'),
(5, '2021-11-24', 'Monitor', 50, 100000, 250000, 'DXgrwa4N'),
(6, '2021-11-24', 'Jacket', 150, 25000, 35000, 'opRZ1LsO'),
(7, '2021-11-24', 'pants', 200, 40000, 50000, 'opRZ1LsO');

-- --------------------------------------------------------

--
-- Table structure for table `stockout`
--

CREATE TABLE `stockout` (
  `id` bigint(20) NOT NULL,
  `ddate` date NOT NULL,
  `sitem` varchar(100) NOT NULL,
  `sbprice` int(11) NOT NULL,
  `ssprice` int(11) NOT NULL,
  `sqty` int(11) NOT NULL,
  `businessId` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stockout`
--

INSERT INTO `stockout` (`id`, `ddate`, `sitem`, `sbprice`, `ssprice`, `sqty`, `businessId`) VALUES
(1, '2021-11-24', 'cable', 10000, 15000, 5, ''),
(2, '2021-11-24', 'cable', 10000, 15000, 1990, ''),
(3, '2021-11-24', 'mouse', 3000, 5000, 10, ''),
(4, '2021-11-24', 'mouse', 3000, 5000, 1, ''),
(5, '2021-11-24', 'mouse', 3000, 5000, 180, ''),
(6, '2021-11-24', 'laptop', 300000, 450000, 2, ''),
(7, '2021-11-24', 'laptop', 300000, 450000, 1, ''),
(8, '2021-11-24', 'laptop', 300000, 450000, 1, ''),
(9, '2021-11-24', 'laptop', 300000, 450000, 1, 'DXgrwa4N'),
(10, '2021-11-24', 'Monitor', 100000, 250000, 1, 'DXgrwa4N'),
(11, '2021-11-24', 'pants', 40000, 50000, 2, 'opRZ1LsO'),
(12, '2021-11-24', 'Jacket', 25000, 35000, 5, 'opRZ1LsO');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` bigint(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `businessName` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `role` varchar(100) NOT NULL,
  `businessId` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `username`, `password`, `contact`, `address`, `businessName`, `description`, `role`, `businessId`) VALUES
(5, 'teddy', '962b2d2b8e72dc6771bca613d49b46fb', '754788985', 'Park Engade', 'Alden Fashions', 'Classic men and women', 'admin', 'opRZ1LsO'),
(6, 'robert', '684c851af59965b680086b7b4896ff98', '77773234', 'Kampala road shop No. FG07', 'Robert Guitars', 'All guitars and their accessories that include, cables and coiple', 'admin', 'W89AYMJ6'),
(7, 'extreme', '287e9593819b2fcdf9945e7ccacd637d', '07767646896\r\n07004657565\r\n05488656', 'Cornerstone Plaza Shop No. 656ds', 'Extreme Sales Ug', 'All laptops, computers, accessories, flatscreens', 'admin', 'DXgrwa4N');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `profits`
--
ALTER TABLE `profits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stockin`
--
ALTER TABLE `stockin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stockout`
--
ALTER TABLE `stockout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `profits`
--
ALTER TABLE `profits`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stockin`
--
ALTER TABLE `stockin`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stockout`
--
ALTER TABLE `stockout`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
