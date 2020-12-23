-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 23, 2020 at 01:39 PM
-- Server version: 8.0.22-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SithShopDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `Addresses`
--

CREATE TABLE `Addresses` (
  `AddressID` int NOT NULL,
  `country` varchar(255) NOT NULL,
  `province` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `street_and_nr` varchar(255) NOT NULL,
  `postalcode` varchar(255) NOT NULL,
  `CustomerID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Addresses`
--

INSERT INTO `Addresses` (`AddressID`, `country`, `province`, `city`, `street_and_nr`, `postalcode`, `CustomerID`) VALUES
(1, 'België', NULL, 'Kampenhout', 'Hutstraat 29', '1910', 3),
(2, 'België', NULL, 'BlaBlaStad', 'Blablastraat 2000', '1904', 4),
(3, 'België', NULL, 'Teststad', 'Teststraat 404', '404', 5);

-- --------------------------------------------------------

--
-- Table structure for table `Customers`
--

CREATE TABLE `Customers` (
  `CustomerID` int NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `registration_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Customers`
--

INSERT INTO `Customers` (`CustomerID`, `first_name`, `last_name`, `email_address`, `birth_date`, `password`, `registration_time`, `admin`) VALUES
(3, 'Sander', 'Van de Ven', 'sander.vandeven86@gmail.com', '2000-01-14', '$2y$10$LWA8NloAyMUfR./oPBv19ebXdN6obxR5Td.ERzWXKVfFBKb75EsUG', '2020-12-20 22:23:31', 1),
(4, 'Tom', 'Naegels', 'blablalbal@blablamail.com', '1999-06-02', '$2y$10$0VxFZ5G3sN5odSkrXPfb/OT4YqREgisx2YV4wZw8O0zfrdhNNoKGK', '2020-12-23 16:37:23', 0),
(5, 'Test', 'User', 'test@test.com', '2000-01-01', '$2y$10$65rongE5.8cBPjojSeoNGOJQikj.3dyoy8mslwZo9eLR07tc//oi.', '2020-12-23 20:54:25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `OrderID` int NOT NULL,
  `CustomerID` int NOT NULL,
  `order_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`OrderID`, `CustomerID`, `order_time`, `payed`) VALUES
(1, 3, '2020-12-21 21:09:16', 0),
(3, 3, '2020-12-23 16:03:24', 0),
(4, 3, '2020-12-23 18:56:20', 0),
(5, 3, '2020-12-23 19:06:13', 0),
(6, 3, '2020-12-23 19:23:50', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Order_details`
--

CREATE TABLE `Order_details` (
  `Order_detailID` int NOT NULL,
  `OrderID` int NOT NULL,
  `ProductID` int NOT NULL,
  `amount` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Order_details`
--

INSERT INTO `Order_details` (`Order_detailID`, `OrderID`, `ProductID`, `amount`) VALUES
(1, 1, 1, 5),
(2, 3, 4, 4),
(3, 3, 3, 4),
(4, 4, 3, 0),
(5, 5, 3, 1),
(6, 6, 3, 2),
(7, 6, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

CREATE TABLE `Products` (
  `ProductID` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `stock` int NOT NULL,
  `price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `image_name` varchar(255) NOT NULL DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`ProductID`, `name`, `stock`, `price`, `image_name`) VALUES
(3, 'Light Saber 1', 1, '500.00', 'default.png'),
(4, 'Light Saber 2', 2, '250.00', 'default.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Addresses`
--
ALTER TABLE `Addresses`
  ADD PRIMARY KEY (`AddressID`),
  ADD UNIQUE KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `Customers`
--
ALTER TABLE `Customers`
  ADD PRIMARY KEY (`CustomerID`),
  ADD UNIQUE KEY `EMAIL` (`email_address`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `Order_details`
--
ALTER TABLE `Order_details`
  ADD PRIMARY KEY (`Order_detailID`);

--
-- Indexes for table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`ProductID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Addresses`
--
ALTER TABLE `Addresses`
  MODIFY `AddressID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Customers`
--
ALTER TABLE `Customers`
  MODIFY `CustomerID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `OrderID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Order_details`
--
ALTER TABLE `Order_details`
  MODIFY `Order_detailID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Products`
--
ALTER TABLE `Products`
  MODIFY `ProductID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
