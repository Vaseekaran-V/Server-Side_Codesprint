-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 10, 2020 at 06:33 AM
-- Server version: 5.7.24
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codesprint`
--

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

DROP TABLE IF EXISTS `food`;
CREATE TABLE IF NOT EXISTS `food` (
  `foodId` int(100) NOT NULL AUTO_INCREMENT,
  `foodName` varchar(200) NOT NULL,
  `foodPrice` int(200) NOT NULL,
  `foodPicLarge` varchar(100) NOT NULL,
  `foodPicSmall` varchar(100) NOT NULL,
  `foodDescriptionShort` varchar(200) NOT NULL,
  `foodDescriptionLong` varchar(1000) NOT NULL,
  PRIMARY KEY (`foodId`),
  UNIQUE KEY `foodName` (`foodName`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`foodId`, `foodName`, `foodPrice`, `foodPicLarge`, `foodPicSmall`, `foodDescriptionShort`, `foodDescriptionLong`) VALUES
(1, 'Chocolate Milkshake', 250, 'chocolatemilkshakelarge.jpg', 'chocolatemilkshakesmall.jpg', 'Delicious Yummy Choc Shake', 'Chocolate Milkshake, made from the finest Cocoa beans and made with extra love. Will make your mouth water.'),
(2, 'Pizza', 500, 'pizzalarge.jpg', 'pizzasmall.jpg', 'Delicious Thin Crust Pizza', 'Delicious Chicken Pizza to feed all of your cravings. Order this and have your tummy stocked for the quarantine.');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `messageId` int(100) NOT NULL AUTO_INCREMENT,
  `SenderFName` varchar(200) NOT NULL,
  `SenderLName` varchar(200) NOT NULL,
  `senderEmail` varchar(100) NOT NULL,
  `messageDateTime` datetime NOT NULL,
  `message` varchar(500) NOT NULL,
  PRIMARY KEY (`messageId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `orderId` int(100) NOT NULL AUTO_INCREMENT,
  `orderTotal` int(100) NOT NULL,
  `orderStatus` varchar(100) NOT NULL,
  `orderDateTime` datetime NOT NULL,
  `userId` int(100) NOT NULL,
  PRIMARY KEY (`orderId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_line`
--

DROP TABLE IF EXISTS `order_line`;
CREATE TABLE IF NOT EXISTS `order_line` (
  `orderLineId` int(100) NOT NULL AUTO_INCREMENT,
  `orderId` int(100) NOT NULL,
  `foodId` int(100) NOT NULL,
  `quantityOrdered` int(100) NOT NULL,
  `subtotal` int(100) NOT NULL,
  PRIMARY KEY (`orderLineId`),
  KEY `orderId` (`orderId`),
  KEY `foodId` (`foodId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
CREATE TABLE IF NOT EXISTS `ratings` (
  `ratingId` int(100) NOT NULL AUTO_INCREMENT,
  `userId` int(100) NOT NULL,
  `foodId` int(100) NOT NULL,
  `rating` int(100) NOT NULL,
  `ratingTopic` varchar(250) NOT NULL,
  `ratingDecsription` varchar(500) NOT NULL,
  PRIMARY KEY (`ratingId`),
  KEY `userId` (`userId`),
  KEY `foodId` (`foodId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `riders`
--

DROP TABLE IF EXISTS `riders`;
CREATE TABLE IF NOT EXISTS `riders` (
  `riderId` int(100) NOT NULL AUTO_INCREMENT,
  `riderName` varchar(200) NOT NULL,
  `riderVehicle` varchar(100) NOT NULL,
  `riderTelephone` int(100) NOT NULL,
  `riderAddress` varchar(100) NOT NULL,
  `riderEmail` varchar(250) NOT NULL,
  `riderPassword` varchar(200) NOT NULL,
  `bankAccount` varchar(100) NOT NULL,
  PRIMARY KEY (`riderId`),
  UNIQUE KEY `riderEmail` (`riderEmail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userId` int(100) NOT NULL AUTO_INCREMENT,
  `userType` varchar(100) NOT NULL,
  `userFName` varchar(100) NOT NULL,
  `userSName` varchar(100) NOT NULL,
  `userAddress` varchar(1000) NOT NULL,
  `userPostCode` int(100) NOT NULL,
  `userTelNo` int(100) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userPassword` varchar(100) NOT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `userEmail` (`userEmail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
