-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 06, 2023 at 12:25 PM
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
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ag_brand`
--

INSERT INTO `ag_brand` (`ag_brand_id`, `ag_brand_no`, `ag_brand_code`, `ag_brand_name`, `ag_brand_category`, `ag_brand_img`, `ag_brand_status`) VALUES
(1, 1508640779, 'ag_01', 'Honda', 'Bike', '2023-07-03-1735622875.png', 0),
(2, 1441387750, 'ag_02', 'TVS', 'Bike', '2023-07-03-1963712477.png', 0),
(22, 630676143, 'AG_4', 'Bajaj', 'Bike', '2023-07-06-1547431257.png', 0),
(17, 385965455, 'AG_3', 'Bajaj1', 'Bike', '2023-07-03-327665657.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ag_city`
--

DROP TABLE IF EXISTS `ag_city`;
CREATE TABLE IF NOT EXISTS `ag_city` (
  `ag_city_id` int NOT NULL AUTO_INCREMENT,
  `ag_city_no` int NOT NULL,
  `ag_state_no` int NOT NULL,
  `ag_city_name` varchar(30) NOT NULL,
  PRIMARY KEY (`ag_city_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ag_city`
--

INSERT INTO `ag_city` (`ag_city_id`, `ag_city_no`, `ag_state_no`, `ag_city_name`) VALUES
(1, 1026896286, 1211211715, 'Bharuch'),
(2, 2064270509, 1111343021, 'Surat'),
(3, 1942143500, 1211211715, 'vadodara'),
(7, 666511050, 1211211715, 'xyz');

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
  `ag_vehicle_no` int NOT NULL,
  `ag_part_name` varchar(50) NOT NULL,
  `ag_part_hsn` varchar(10) NOT NULL,
  `ag_part_cat` varchar(15) NOT NULL,
  `ag_part_img` text NOT NULL COMMENT 'l=30',
  `ag_part_status` int NOT NULL COMMENT '1=active\r\n2=inactive',
  `ag_part_date` date NOT NULL,
  PRIMARY KEY (`ag_part_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ag_part`
--

INSERT INTO `ag_part` (`ag_part_id`, `ag_part_no`, `ag_part_code`, `ag_brand_no`, `ag_vehicle_no`, `ag_part_name`, `ag_part_hsn`, `ag_part_cat`, `ag_part_img`, `ag_part_status`, `ag_part_date`) VALUES
(2, 329932558, 'AGP_1', 1441387750, 956600960, 'Foot Rest', 'KV102', 'spare', '2023-07-05-46493779.png', 1, '2023-07-05'),
(9, 526514842, 'AGP_8', 1508640779, 1508640779, 'break', 'kv105', 'Oil', '2023-07-06-1222250695.png', 1, '2023-07-06'),
(8, 1586245021, 'AGP_7', 1508640779, 1508640779, 'Foot Rest', 'kv105', 'Spare', '2023-07-06-1733960420.png', 1, '2023-07-06'),
(7, 558681596, 'AGP_6', 1508640779, 1508640779, 'Oil 250', 'KV101', 'Oil', '2023-07-06-104979787.png', 1, '2023-07-06');

-- --------------------------------------------------------

--
-- Table structure for table `ag_retailer`
--

DROP TABLE IF EXISTS `ag_retailer`;
CREATE TABLE IF NOT EXISTS `ag_retailer` (
  `ag_retailer_id` int NOT NULL AUTO_INCREMENT,
  `ag_retailer_no` int NOT NULL,
  `ag_retailer_code` varchar(10) NOT NULL,
  `ag_retailer_company_name` varchar(30) NOT NULL,
  `ag_retailer_owner_name` varchar(30) NOT NULL,
  `ag_retailer_comapny_phone` int NOT NULL,
  `ag_retailer_comapny_alt_phone` int NOT NULL,
  `ag_retailer_company_email` varchar(30) NOT NULL,
  `ag_retailer_company_website` varchar(30) NOT NULL,
  `ag_retailer_company_gst` varchar(10) NOT NULL,
  `ag_retailer_company_tin` varchar(10) NOT NULL,
  `ag_retailer_contact_persone_name` varchar(30) NOT NULL,
  `ag_retailer_contact_person_phone` int NOT NULL,
  `ag_retailer_state` varchar(15) NOT NULL,
  `ag_retailer_city` varchar(15) NOT NULL,
  `ag_retailer_area` varchar(15) NOT NULL,
  `ag_retailer_house_no` varchar(10) NOT NULL,
  `ag_retailer_pincode` int NOT NULL,
  `ag_retailer_register_date` date NOT NULL,
  PRIMARY KEY (`ag_retailer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ag_retailer`
--

INSERT INTO `ag_retailer` (`ag_retailer_id`, `ag_retailer_no`, `ag_retailer_code`, `ag_retailer_company_name`, `ag_retailer_owner_name`, `ag_retailer_comapny_phone`, `ag_retailer_comapny_alt_phone`, `ag_retailer_company_email`, `ag_retailer_company_website`, `ag_retailer_company_gst`, `ag_retailer_company_tin`, `ag_retailer_contact_persone_name`, `ag_retailer_contact_person_phone`, `ag_retailer_state`, `ag_retailer_city`, `ag_retailer_area`, `ag_retailer_house_no`, `ag_retailer_pincode`, `ag_retailer_register_date`) VALUES
(1, 792307898, 'AGR_1', 'ABC', '', 0, 0, '', '', '', '', '', 0, 'Guajarat', 'Bharuch', '', '', 0, '0000-00-00'),
(2, 231924102, 'RT_2', 'Shiv Automobiles', 'Pravin Patel', 1125421212, 0, 'Shivautomobile@gmail.com', 'www.shivautomob.com', 'GT12456', '123', 'Deepen Pandey', 2147483647, 'Guajarat', 'Bharuch', '', 'ac145', 392020, '2023-04-05'),
(3, 1815203693, 'RT_3', 'ABC', 'Maynak', 1125421212, 2147483647, 'abc@gmail.com', 'www.abc.com', 'GT12456', '123', 'Abhishek Patel', 2147483647, 'Guajarat', 'Bharuch', '', 'ac145', 392020, '2022-11-30'),
(4, 1755715726, 'RT_4', '', '', 0, 0, '', '', '', '', '', 0, '', '', '', '', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `ag_state`
--

DROP TABLE IF EXISTS `ag_state`;
CREATE TABLE IF NOT EXISTS `ag_state` (
  `ag_state_id` int NOT NULL AUTO_INCREMENT,
  `ag_state_no` int NOT NULL,
  `ag_state_name` varchar(30) NOT NULL,
  PRIMARY KEY (`ag_state_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ag_state`
--

INSERT INTO `ag_state` (`ag_state_id`, `ag_state_no`, `ag_state_name`) VALUES
(1, 1111343021, 'Gujarat'),
(2, 1211211715, 'Delhi');

-- --------------------------------------------------------

--
-- Table structure for table `ag_vehicle`
--

DROP TABLE IF EXISTS `ag_vehicle`;
CREATE TABLE IF NOT EXISTS `ag_vehicle` (
  `ag_vehicle_id` int NOT NULL AUTO_INCREMENT,
  `ag_vehicle_code` varchar(10) NOT NULL,
  `ag_vehicle_no` int NOT NULL,
  `ag_brand_no` int NOT NULL,
  `ag_vehicle_model_name` varchar(30) NOT NULL,
  `ag_vehicle_model_type` varchar(20) NOT NULL,
  `ag_vehicle_mg_year` int NOT NULL,
  `ag_vehicle_cc` varchar(10) NOT NULL,
  `ag_vehicle_fuel` varchar(30) NOT NULL,
  `ag_vehicle_img` text NOT NULL COMMENT 'l=50',
  `ag_vehicle_status` int NOT NULL COMMENT '1=active\r\n2=inactive',
  `ag_vehicle_date` date NOT NULL,
  PRIMARY KEY (`ag_vehicle_id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ag_vehicle`
--

INSERT INTO `ag_vehicle` (`ag_vehicle_id`, `ag_vehicle_code`, `ag_vehicle_no`, `ag_brand_no`, `ag_vehicle_model_name`, `ag_vehicle_model_type`, `ag_vehicle_mg_year`, `ag_vehicle_cc`, `ag_vehicle_fuel`, `ag_vehicle_img`, `ag_vehicle_status`, `ag_vehicle_date`) VALUES
(24, '0', 32043944, 1441387750, 'Activa', 'Bike', 2012, '169', 'Diesel', '2023-07-06-858200902.png', 1, '2023-07-06'),
(25, '0', 306479930, 1441387750, 'Splendar', 'Bike', 2012, '124', 'Diesel', '2023-07-06-563766608.png', 1, '2023-07-06'),
(26, '0', 1648172998, 1441387750, 'Activa', 'Bike', 2012, '169', 'Diesel', '2023-07-06-825091225.png', 1, '2023-07-06'),
(27, '0', 473597468, 1441387750, 'Activa', 'Bike', 2012, '169', 'Diesel', '2023-07-06-1861554998.png', 1, '2023-07-06'),
(28, '0', 770299755, 385965455, 'Splendar', 'Scooter', 2005, '169', 'Diesel', '2023-07-06-861047422.png', 1, '2023-07-06'),
(29, 'AGV_1', 1700026017, 1508640779, 'Activa', 'Scooter', 2012, '169', 'Petrol', '2023-07-06-1290059301.png', 1, '2023-07-06');

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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ag_vehicle_parts`
--

INSERT INTO `ag_vehicle_parts` (`ag_vehicle_part_id`, `ag_vehicle_no`, `ag_vehicle_part_no`) VALUES
(12, 843307550, 329932558),
(11, 843307550, 1797832085),
(10, 1512097201, 1797832085),
(13, 1771980632, 1797832085),
(14, 1771980632, 329932558),
(15, 322767753, 1797832085);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
