-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 03, 2023 at 03:08 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apna_g`
--

-- --------------------------------------------------------

--
-- Table structure for table `ag_brand`
--

DROP TABLE IF EXISTS `ag_brand`;
CREATE TABLE IF NOT EXISTS `ag_brand` (
  `ag_brand_id` int NOT NULL AUTO_INCREMENT,
  `ag_brand_no` int NOT NULL,
  `ag_brand_code` varchar(10) NOT NULL,
  `ag_brand_name` varchar(30) NOT NULL,
  `ag_brand_category` varchar(15) NOT NULL,
  `ag_brand_img` text NOT NULL COMMENT 'l=100',
  `ag_brand_status` int NOT NULL COMMENT '1=Active\r\n2=In Active',
  PRIMARY KEY (`ag_brand_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ag_brand`
--

INSERT INTO `ag_brand` (`ag_brand_id`, `ag_brand_no`, `ag_brand_code`, `ag_brand_name`, `ag_brand_category`, `ag_brand_img`, `ag_brand_status`) VALUES
(1, 1508640779, 'ag_01', 'Honda', 'Bike', '2023-07-03-1735622875.png', 0),
(2, 1441387750, 'ag_02', 'TVS', 'Bike', '2023-07-03-1963712477.png', 0),
(17, 385965455, 'AG_3', 'Bajaj', 'Bike', '2023-07-03-327665657.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ag_part`
--

DROP TABLE IF EXISTS `ag_part`;
CREATE TABLE IF NOT EXISTS `ag_part` (
  `ag_part_id` int NOT NULL AUTO_INCREMENT,
  `ag_part_no` int NOT NULL,
  `ag_part_code` varchar(20) NOT NULL,
  `ag_brand_no` int NOT NULL,
  `ag_part_name` varchar(50) NOT NULL,
  `ag_part_purchase_price` decimal(10,2) NOT NULL,
  `ag_part_sale_price` decimal(10,2) NOT NULL,
  `ag_part_qty` int NOT NULL,
  `ag_part_cat` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ag_part_hsn` varchar(10) NOT NULL,
  `ag_part_img` text NOT NULL COMMENT 'l=30',
  `ag_part_status` int NOT NULL COMMENT '1=active\r\n2=inactive',
  `ag_part_date` date NOT NULL,
  PRIMARY KEY (`ag_part_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ag_vehicle`
--

DROP TABLE IF EXISTS `ag_vehicle`;
CREATE TABLE IF NOT EXISTS `ag_vehicle` (
  `ag_vehicle_id` int NOT NULL AUTO_INCREMENT,
  `ag_vehicle_no` int NOT NULL,
  `ag_vehicle_brand_no` int NOT NULL,
  `ag_vehicle_model_name` varchar(30) NOT NULL,
  `ag_vehicle_model_type` varchar(20) NOT NULL,
  `ag_vehicle_mg_year` int NOT NULL,
  `ag_vehicle_cc` varchar(10) NOT NULL,
  `ag_vehicle_fuel` varchar(30) NOT NULL,
  `ag_vehicle_img` text NOT NULL COMMENT 'l=50',
  `ag_vehicle_status` int NOT NULL COMMENT '1=active\r\n2=inactive',
  `ag_vehicle_date` date NOT NULL,
  PRIMARY KEY (`ag_vehicle_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ag_vehicle`
--

INSERT INTO `ag_vehicle` (`ag_vehicle_id`, `ag_vehicle_no`, `ag_vehicle_brand_no`, `ag_vehicle_model_name`, `ag_vehicle_model_type`, `ag_vehicle_mg_year`, `ag_vehicle_cc`, `ag_vehicle_fuel`, `ag_vehicle_img`, `ag_vehicle_status`, `ag_vehicle_date`) VALUES
(1, 123456, 1508640779, 'Activa', 'Scooter', 2023, '150', 'Petrol', '1.png', 1, '2023-07-01');

-- --------------------------------------------------------

--
-- Table structure for table `ag_vehicle_parts`
--

DROP TABLE IF EXISTS `ag_vehicle_parts`;
CREATE TABLE IF NOT EXISTS `ag_vehicle_parts` (
  `ag_vehicle_part_id` int NOT NULL AUTO_INCREMENT,
  `ag_vehicle_no` int NOT NULL,
  `ag_vehicle_part_no` int NOT NULL,
  PRIMARY KEY (`ag_vehicle_part_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
