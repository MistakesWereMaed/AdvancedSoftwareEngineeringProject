-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 02, 2024 at 05:29 PM
-- Server version: 8.0.36-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `equipment`
--

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `device_id` int NOT NULL,
  `device_type` int NOT NULL,
  `manufacturer` int NOT NULL,
  `serial_number` varchar(96) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `device_types`
--

CREATE TABLE `device_types` (
  `type_id` int NOT NULL,
  `device_type` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `device_types`
--

INSERT INTO `device_types` (`type_id`, `device_type`) VALUES
(20, 'computer'),
(28, 'laptop'),
(3, 'mobile phone'),
(1, 'projector'),
(5, 'tablet'),
(2, 'television'),
(6, 'vehicle');

-- --------------------------------------------------------

--
-- Table structure for table `error_log`
--

CREATE TABLE `error_log` (
  `auto_id` int NOT NULL,
  `line_number` int NOT NULL,
  `error_type` varchar(3) NOT NULL,
  `row` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manufacturers`
--

CREATE TABLE `manufacturers` (
  `manufacturer_id` int NOT NULL,
  `manufacturer` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `manufacturers`
--

INSERT INTO `manufacturers` (`manufacturer_id`, `manufacturer`) VALUES
(8, 'Acer'),
(12, 'Apple'),
(65, 'Asus'),
(102, 'Chevorlet'),
(7, 'Chrysler'),
(45, 'Dell'),
(13, 'Epson'),
(32, 'Ford'),
(35, 'Gateway'),
(21, 'Generic'),
(58, 'GM'),
(52, 'Hisense'),
(60, 'HP'),
(17, 'Hyundai'),
(25, 'IBM'),
(98, 'Insignia'),
(49, 'Jeep'),
(10, 'KIA'),
(34, 'Lenovo'),
(4, 'LG'),
(1, 'Microsoft'),
(18, 'OnePlus'),
(15, 'Optoma'),
(334, 'Panasonic'),
(9, 'Samsung'),
(2, 'Sony'),
(50, 'TCL'),
(40, 'ViewSonic'),
(41, 'VIZIO'),
(121, 'Westinghouse');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`device_id`),
  ADD UNIQUE KEY `serial_number` (`serial_number`),
  ADD KEY `device_type_link` (`device_type`),
  ADD KEY `manufacturer_link` (`manufacturer`);

--
-- Indexes for table `device_types`
--
ALTER TABLE `device_types`
  ADD PRIMARY KEY (`type_id`),
  ADD UNIQUE KEY `device_type` (`device_type`);

--
-- Indexes for table `error_log`
--
ALTER TABLE `error_log`
  ADD PRIMARY KEY (`auto_id`);

--
-- Indexes for table `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`manufacturer_id`),
  ADD UNIQUE KEY `manufacturer` (`manufacturer`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `device_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `device_types`
--
ALTER TABLE `device_types`
  MODIFY `type_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50367;

--
-- AUTO_INCREMENT for table `error_log`
--
ALTER TABLE `error_log`
  MODIFY `auto_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `manufacturer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50367;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
