-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 10, 2023 at 10:44 PM
-- Server version: 8.0.31-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `LPG`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_privileges`
--

CREATE TABLE `admin_privileges` (
  `adminNic` varchar(12) NOT NULL,
  `previlage` varchar(12) NOT NULL DEFAULT 'simple'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_privileges`
--

INSERT INTO `admin_privileges` (`adminNic`, `previlage`) VALUES
('admin123', 'super'),
('Admin1234', 'simple'),
('bgm', 'super'),
('nAdmin', 'simple');

-- --------------------------------------------------------

--
-- Table structure for table `complains`
--

CREATE TABLE `complains` (
  `id` int NOT NULL,
  `comid` varchar(12) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `readflag` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `complains`
--

INSERT INTO `complains` (`id`, `comid`, `subject`, `reason`, `message`, `date`, `readflag`) VALUES
(18, '199933803082', 'trouble to Byu', 'Can i buy 12.5Kg gas cylinder ', 'Hello sandaruwan ', '2023-01-10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `read_flag` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `email`, `name`, `subject`, `message`, `date`, `read_flag`) VALUES
(12, 'fsdfsd', 'sdffsd', 'sfsfs', 'sfsdfsf', '2023-01-08', 1),
(16, 'sandarusbandara110@gmail.com', 'sandaruwan', 'dsjhadjhas', 'dashjgdjasbasdbads', '2023-01-10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_gas_details`
--

CREATE TABLE `customer_gas_details` (
  `userNic` varchar(12) NOT NULL,
  `size` double NOT NULL,
  `brand` varchar(15) NOT NULL,
  `boughtDate` date DEFAULT NULL,
  `notificationRead` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_gas_details`
--

INSERT INTO `customer_gas_details` (`userNic`, `size`, `brand`, `boughtDate`, `notificationRead`) VALUES
('199933803082', 12.5, 'litro', NULL, 0),
('200030900587', 2, 'laughfs', '2023-01-10', 0),
('200034800653', 5, 'laughfs', NULL, 0),
('990720401v', 12.5, 'litro', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `dealer_gas_details`
--

CREATE TABLE `dealer_gas_details` (
  `dealerNic` varchar(12) NOT NULL,
  `code` varchar(100) NOT NULL,
  `brand` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dealer_gas_details`
--

INSERT INTO `dealer_gas_details` (`dealerNic`, `code`, `brand`) VALUES
('993180637v', '123456', 'litro');

-- --------------------------------------------------------

--
-- Table structure for table `gas_issue_history`
--

CREATE TABLE `gas_issue_history` (
  `id` int NOT NULL,
  `type` varchar(15) NOT NULL,
  `size` float NOT NULL,
  `toWhom` varchar(12) NOT NULL,
  `byWhom` varchar(12) NOT NULL,
  `date` date NOT NULL,
  `readFlag` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gas_issue_history`
--

INSERT INTO `gas_issue_history` (`id`, `type`, `size`, `toWhom`, `byWhom`, `date`, `readFlag`) VALUES
(2, 'laughfs', 2, '200030900587', '993180637v', '2023-01-09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gas_requests`
--

CREATE TABLE `gas_requests` (
  `id` int NOT NULL,
  `userNic` varchar(12) NOT NULL,
  `tankType` varchar(15) NOT NULL,
  `tankSize` float NOT NULL,
  `aprovel` int NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `lotSize` int NOT NULL,
  `noific` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gas_requests`
--

INSERT INTO `gas_requests` (`id`, `userNic`, `tankType`, `tankSize`, `aprovel`, `date`, `lotSize`, `noific`) VALUES
(12, '993180637v', 'laughfs', 5, 1, '2023-01-09', 50, 1),
(13, '993180637v', 'litro', 12.5, 0, '2023-01-10', 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `issue_history`
--

CREATE TABLE `issue_history` (
  `id` int NOT NULL,
  `userNic` varchar(12) NOT NULL,
  `dealerNic` varchar(12) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `issue_history`
--

INSERT INTO `issue_history` (`id`, `userNic`, `dealerNic`, `date`) VALUES
(13, '200030900587', '993180637v', '2023-01-01'),
(14, '200030900587', '993180637v', '2023-01-01'),
(15, '200030900587', '993180637v', '2023-01-02'),
(16, '200030900587', '993180637v', '2023-01-08'),
(17, '200030900587', '993180637v', '2023-01-08'),
(18, '200030900587', '993180637v', '2023-01-09'),
(19, '200030900587', '993180637v', '2023-01-09'),
(20, '200030900587', '993180637v', '2023-01-10');

-- --------------------------------------------------------

--
-- Table structure for table `laughfs_dealer_stock`
--

CREATE TABLE `laughfs_dealer_stock` (
  `dealernic` varchar(12) NOT NULL,
  `twoTanks` int NOT NULL,
  `fiveTanks` int NOT NULL,
  `twelveTanks` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `litro_dealer_stock`
--

CREATE TABLE `litro_dealer_stock` (
  `dealernic` varchar(12) NOT NULL,
  `twoTanks` int NOT NULL,
  `fiveTanks` int NOT NULL,
  `twelveTanks` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `litro_dealer_stock`
--

INSERT INTO `litro_dealer_stock` (`dealernic`, `twoTanks`, `fiveTanks`, `twelveTanks`) VALUES
('993180637v', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `main_stock`
--

CREATE TABLE `main_stock` (
  `laughfs2kg` int NOT NULL,
  `laughfs5kg` int NOT NULL,
  `laughfs12kg` int NOT NULL,
  `litro2kg` int NOT NULL,
  `litro5kg` int NOT NULL,
  `litro12kg` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `main_stock`
--

INSERT INTO `main_stock` (`laughfs2kg`, `laughfs5kg`, `laughfs12kg`, `litro2kg`, `litro5kg`, `litro12kg`) VALUES
(2500, 1500, 1000, 9300, 2100, 270);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int NOT NULL,
  `message` text NOT NULL,
  `fromNic` varchar(12) NOT NULL,
  `readflag` int NOT NULL DEFAULT '0',
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int NOT NULL,
  `toNic` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `subject` varchar(150) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `readFlag` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `userNic` varchar(12) NOT NULL,
  `times` int NOT NULL,
  `changedTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`userNic`, `times`, `changedTime`) VALUES
('200034800653', 1, '2023-01-01 06:09:32'),
('993180637v', 10, '2023-01-08 08:25:24');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'dealer'),
(2, 'customer'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `nic` varchar(12) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `gmail` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `registerd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `roleId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`nic`, `firstName`, `lastName`, `gmail`, `address`, `password`, `status`, `registerd`, `roleId`) VALUES
('199933803082', 'Chanuka', 'Sachith', 'chanukathilakarathna333@gmail.com', 'Polgahawela ', '$2y$10$2WFTFmwf/5HCZYW9X8FTpOyZOAYm7vsRlatxf5RxZkebPysLS1nj2', 1, '2023-01-10 05:19:50', 2),
('200030900587', 'gihan', 'sampath', 'kasun@gmail.com', 'ibbagamuwa', '$2y$10$SiWU4nryzuT61WxMIIvjeunzpqSrIEiLWv0KkokUwCddThZshZZj2', 0, '2022-12-18 10:16:44', 2),
('200034800653', 'buddhika', 'Thennakoon', 'buddhika1212thennakoon@gmail.com', 'monaragala', '$2y$10$QZEjCQHRgjZUzfDiG.sOxu6u4WETeUsag.eFS0YPK6AAgeNsGddXW', 0, '2022-12-21 11:09:37', 2),
('990720401v', 'prasanna', 'sampath', 'sandarusbandara110@gmail.com', 'rideegama', '$2y$10$W4cbxudSikfz.kbIBf/PV.qJSB.zGQTxPFTtxX7RjJAM.H1EIx6Mm', 0, '2023-01-10 03:04:42', 2),
('993180637v', 'Chanuka', 'Sachith', 'sandarusbandara110@gmail.com', 'Galewela', '$2y$10$xnPWEL600iP/02xd8qjvpO2m8DFW.ZE.k6cXG7HiJvgJ28akp5B3S', 0, '2022-12-30 17:33:40', 1),
('admin123', 'Sandaruwan', 'Bandara', 'sandarusbandara110@gmail.com', 'galewela', '$2y$10$S9UiYwI1BMRxg8sQKQfxF..J.3gwHmhr.qm7YUyZlTo7mfzHcsh0m', 0, '2022-12-20 19:49:35', 3),
('Admin1234', 'chanuka', 'sachith', 'chanuka@gmail.com', 'polgahawela', '$2y$10$S9UiYwI1BMRxg8sQKQfxF..J.3gwHmhr.qm7YUyZlTo7mfzHcsh0m', 0, '2023-01-01 05:36:44', 3),
('bgm', 'bhathika', 'gimhan', 'bhathika@gmail.com', 'millawana', '$2y$10$nrk8Pi0jI7Ucy9VpZ5iJMePTOem9v0WFfItpqxpTaRtflNZZvsnjW', 0, '2023-01-02 13:55:14', 3),
('nAdmin', 'Nihal', 'Silva', 'nihal@gmail.com', 'ibbagamuwa', '$2y$10$UP8bxEeyKLiT1pvzSDiFuucUvUV3Sa871xrAF63iAQzIQg3q.aqma', 0, '2023-01-02 10:38:03', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_privileges`
--
ALTER TABLE `admin_privileges`
  ADD PRIMARY KEY (`adminNic`);

--
-- Indexes for table `complains`
--
ALTER TABLE `complains`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user & complain` (`comid`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_gas_details`
--
ALTER TABLE `customer_gas_details`
  ADD PRIMARY KEY (`userNic`);

--
-- Indexes for table `dealer_gas_details`
--
ALTER TABLE `dealer_gas_details`
  ADD PRIMARY KEY (`dealerNic`);

--
-- Indexes for table `gas_issue_history`
--
ALTER TABLE `gas_issue_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dealer and user` (`byWhom`),
  ADD KEY `buyer and user` (`toWhom`);

--
-- Indexes for table `gas_requests`
--
ALTER TABLE `gas_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user & request` (`userNic`);

--
-- Indexes for table `issue_history`
--
ALTER TABLE `issue_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buyer & history` (`userNic`),
  ADD KEY `dealer & history` (`dealerNic`);

--
-- Indexes for table `laughfs_dealer_stock`
--
ALTER TABLE `laughfs_dealer_stock`
  ADD PRIMARY KEY (`dealernic`);

--
-- Indexes for table `litro_dealer_stock`
--
ALTER TABLE `litro_dealer_stock`
  ADD PRIMARY KEY (`dealernic`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `msg & user` (`fromNic`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`userNic`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`nic`),
  ADD KEY `role & user` (`roleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complains`
--
ALTER TABLE `complains`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `gas_issue_history`
--
ALTER TABLE `gas_issue_history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gas_requests`
--
ALTER TABLE `gas_requests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `issue_history`
--
ALTER TABLE `issue_history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_privileges`
--
ALTER TABLE `admin_privileges`
  ADD CONSTRAINT `adminPreviledges & admins ` FOREIGN KEY (`adminNic`) REFERENCES `user_details` (`nic`) ON DELETE CASCADE;

--
-- Constraints for table `complains`
--
ALTER TABLE `complains`
  ADD CONSTRAINT `user & complain` FOREIGN KEY (`comid`) REFERENCES `user_details` (`nic`) ON DELETE CASCADE;

--
-- Constraints for table `customer_gas_details`
--
ALTER TABLE `customer_gas_details`
  ADD CONSTRAINT `customer gas & customer` FOREIGN KEY (`userNic`) REFERENCES `user_details` (`nic`) ON DELETE CASCADE;

--
-- Constraints for table `dealer_gas_details`
--
ALTER TABLE `dealer_gas_details`
  ADD CONSTRAINT `dealer & brand` FOREIGN KEY (`dealerNic`) REFERENCES `user_details` (`nic`) ON DELETE CASCADE;

--
-- Constraints for table `gas_issue_history`
--
ALTER TABLE `gas_issue_history`
  ADD CONSTRAINT `buyer and user` FOREIGN KEY (`toWhom`) REFERENCES `user_details` (`nic`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `dealer and user` FOREIGN KEY (`byWhom`) REFERENCES `user_details` (`nic`) ON DELETE CASCADE;

--
-- Constraints for table `gas_requests`
--
ALTER TABLE `gas_requests`
  ADD CONSTRAINT `user & request` FOREIGN KEY (`userNic`) REFERENCES `dealer_gas_details` (`dealerNic`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `issue_history`
--
ALTER TABLE `issue_history`
  ADD CONSTRAINT `buyer & history` FOREIGN KEY (`userNic`) REFERENCES `user_details` (`nic`) ON DELETE CASCADE,
  ADD CONSTRAINT `dealer & history` FOREIGN KEY (`dealerNic`) REFERENCES `user_details` (`nic`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `laughfs_dealer_stock`
--
ALTER TABLE `laughfs_dealer_stock`
  ADD CONSTRAINT `laughfs & dealer` FOREIGN KEY (`dealernic`) REFERENCES `user_details` (`nic`) ON DELETE CASCADE;

--
-- Constraints for table `litro_dealer_stock`
--
ALTER TABLE `litro_dealer_stock`
  ADD CONSTRAINT `litro & dealer` FOREIGN KEY (`dealernic`) REFERENCES `user_details` (`nic`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `msg & user` FOREIGN KEY (`fromNic`) REFERENCES `user_details` (`nic`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `role & user` FOREIGN KEY (`roleId`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
