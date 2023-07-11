-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 11, 2023 at 12:31 PM
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
-- Table structure for table `ag_admin`
--

DROP TABLE IF EXISTS `ag_admin`;
CREATE TABLE IF NOT EXISTS `ag_admin` (
  `ag_admin_id` int NOT NULL AUTO_INCREMENT,
  `ag_admin_email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ag_admin_password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ag_admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_admin`
--

INSERT INTO `ag_admin` (`ag_admin_id`, `ag_admin_email`, `ag_admin_password`) VALUES
(1, 'admin@gmail.com', 'SUF4Rk1qN0JOUkhKNjdFYTZZeHpkUT09');

-- --------------------------------------------------------

--
-- Table structure for table `ag_brand`
--

DROP TABLE IF EXISTS `ag_brand`;
CREATE TABLE IF NOT EXISTS `ag_brand` (
  `ag_brand_id` int NOT NULL AUTO_INCREMENT,
  `ag_brand_no` int NOT NULL,
  `ag_brand_code` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_brand_name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_brand_category` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_brand_img` text COLLATE utf8mb4_general_ci NOT NULL COMMENT 'l=100',
  `ag_brand_status` int NOT NULL COMMENT '1=Active\r\n2=In Active',
  PRIMARY KEY (`ag_brand_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_brand`
--

INSERT INTO `ag_brand` (`ag_brand_id`, `ag_brand_no`, `ag_brand_code`, `ag_brand_name`, `ag_brand_category`, `ag_brand_img`, `ag_brand_status`) VALUES
(1, 1508640779, 'ag_01', 'Honda', 'Bike', '2023-07-03-1735622875.png', 1),
(2, 1441387750, 'ag_02', 'TVS', 'Bike', '2023-07-03-1963712477.png', 1),
(22, 630676143, 'AG_4', 'Bajaj', 'Bike', '2023-07-06-1547431257.png', 2),
(17, 385965455, 'AG_3', 'Bajaj1', 'Bike', '2023-07-03-327665657.png', 1),
(26, 1769269604, 'AG_5', 'sdgfgfdg', 'Bike', '2023-07-10-1397982160.png', 1),
(27, 2081912260, 'AG_6', 'Bajajddsfs', 'Bike', '2023-07-10-476109186.png', 1),
(28, 1085779345, 'AG_7', 'Honda city', 'Bike', '2023-07-11-1752959018.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ag_city`
--

DROP TABLE IF EXISTS `ag_city`;
CREATE TABLE IF NOT EXISTS `ag_city` (
  `ag_city_id` int NOT NULL AUTO_INCREMENT,
  `ag_city_no` int NOT NULL,
  `ag_state_no` int NOT NULL,
  `ag_city_name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ag_city_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `ag_part_code` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_brand_no` int NOT NULL,
  `ag_vehicle_no` int NOT NULL,
  `ag_part_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_part_hsn` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_part_cat` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_part_img` text COLLATE utf8mb4_general_ci NOT NULL COMMENT 'l=30',
  `ag_part_status` int NOT NULL COMMENT '1=active\r\n2=inactive',
  `ag_part_date` date NOT NULL,
  PRIMARY KEY (`ag_part_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_part`
--

INSERT INTO `ag_part` (`ag_part_id`, `ag_part_no`, `ag_part_code`, `ag_brand_no`, `ag_vehicle_no`, `ag_part_name`, `ag_part_hsn`, `ag_part_cat`, `ag_part_img`, `ag_part_status`, `ag_part_date`) VALUES
(14, 1687722590, 'AGP_01', 1441387750, 1700026017, 'Foot Rest', 'tytyty', 'Oil', '2023-07-06-979878611.png', 2, '2023-07-06'),
(15, 510293075, 'AGP_2', 385965455, 1700026017, 'Front break', 'dsadsad', 'Accessories', '2023-07-06-800382390.png', 1, '2023-07-06');

-- --------------------------------------------------------

--
-- Table structure for table `ag_po_cart`
--

DROP TABLE IF EXISTS `ag_po_cart`;
CREATE TABLE IF NOT EXISTS `ag_po_cart` (
  `ag_po_cart_id` int NOT NULL AUTO_INCREMENT,
  `ag_retailer_no` int NOT NULL,
  `ag_po_invoice_no` int NOT NULL,
  `ag_po_part_no` int NOT NULL,
  `ag_vehicle_no` int NOT NULL,
  `ag_vehicle_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_po_qty` int NOT NULL,
  `ag_po_price` decimal(10,2) NOT NULL,
  `ag_po_date` date NOT NULL,
  `ag_po_status` int NOT NULL COMMENT '1=active\r\n2=inactive',
  PRIMARY KEY (`ag_po_cart_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_po_cart`
--

INSERT INTO `ag_po_cart` (`ag_po_cart_id`, `ag_retailer_no`, `ag_po_invoice_no`, `ag_po_part_no`, `ag_vehicle_no`, `ag_vehicle_name`, `ag_po_qty`, `ag_po_price`, `ag_po_date`, `ag_po_status`) VALUES
(11, 0, 1262612359, 0, 770299755, 'Splendar', 4, '100.00', '2023-07-09', 0),
(14, 0, 1262612359, 0, 1700026017, 'Activa', 2, '100.00', '2023-07-09', 0),
(10, 0, 1262612359, 0, 1648172998, 'Activa', 7, '100.00', '2023-07-09', 0),
(16, 0, 1262612359, 0, 306479930, 'Splendar', 1, '100.00', '2023-07-09', 0),
(15, 0, 1262612359, 0, 473597468, 'Activa', 1, '100.00', '2023-07-09', 0),
(17, 0, 1262612359, 0, 32043944, 'Activa', 1, '100.00', '2023-07-09', 0),
(18, 0, 1262612359, 0, 1176080786, 'B', 1, '100.00', '2023-07-11', 0),
(19, 0, 1262612359, 0, 1171453103, 'Activa', 1, '100.00', '2023-07-11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ag_retailer`
--

DROP TABLE IF EXISTS `ag_retailer`;
CREATE TABLE IF NOT EXISTS `ag_retailer` (
  `ag_retailer_id` int NOT NULL AUTO_INCREMENT,
  `ag_retailer_no` int NOT NULL,
  `ag_retailer_code` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_retailer_company_name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_retailer_owner_name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_retailer_comapny_phone` bigint NOT NULL,
  `ag_retailer_comapny_alt_phone` bigint NOT NULL,
  `ag_retailer_company_email` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_retailer_company_website` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_retailer_company_gst` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_retailer_company_tin` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_retailer_contact_persone_name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_retailer_contact_person_phone` int NOT NULL,
  `ag_retailer_state` int NOT NULL,
  `ag_retailer_city` int NOT NULL,
  `ag_retailer_area` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_retailer_house_no` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_retailer_pincode` int NOT NULL,
  `ag_retailer_register_date` date NOT NULL,
  `ag_retailer_status` int NOT NULL COMMENT '1=active\r\n2=inactive',
  PRIMARY KEY (`ag_retailer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_retailer`
--

INSERT INTO `ag_retailer` (`ag_retailer_id`, `ag_retailer_no`, `ag_retailer_code`, `ag_retailer_company_name`, `ag_retailer_owner_name`, `ag_retailer_comapny_phone`, `ag_retailer_comapny_alt_phone`, `ag_retailer_company_email`, `ag_retailer_company_website`, `ag_retailer_company_gst`, `ag_retailer_company_tin`, `ag_retailer_contact_persone_name`, `ag_retailer_contact_person_phone`, `ag_retailer_state`, `ag_retailer_city`, `ag_retailer_area`, `ag_retailer_house_no`, `ag_retailer_pincode`, `ag_retailer_register_date`, `ag_retailer_status`) VALUES
(2, 231924102, 'RT_2', 'Shiv Automobiles', 'Pravin Patelsd', 7698903619, 7698903699, 'Shivautomobile@gmail.com', 'www.shivautomob.com', 'GT12456', '1235543', 'Deepen Pandeye', 2147483647, 1111343021, 2064270509, '', 'ac14555', 392200, '2023-03-29', 0),
(3, 1815203693, 'RT_3', 'ABC', 'Maynak', 1125421212, 2147483647, 'abc@gmail.com', 'www.abc.com', 'GT12456', '123', 'Abhishek Patel', 2147483647, 1111343021, 1026896286, '', 'ac145', 392020, '2022-11-30', 0),
(5, 2035485059, 'RT_4', 'xyz', 'Pravin Patel', 1125421212, 2147483647, 'xyz@gmail.com', 'www.xyz.com', 'GT12456', '123', 'Abhishek Patel', 2147483647, 1211211715, 2064270509, 'qaqaqa', 'ac145', 392020, '2023-07-07', 0),
(6, 1438042722, 'RT_5', 'Shiv Automobiles', 'Pravin Patel', 1125421212, 0, 'Shivautomobile@gmail.com', 'www.shivautomob.com', 'GT12456', '123', 'Deepen Pandey', 2147483647, 1111343021, 1026896286, '', 'ac145', 392020, '2023-04-05', 0),
(7, 503325297, 'RT_6', 'Shiv Automobiles', 'Pravin Patel', 1125421212, 0, 'Shivautomobile@gmail.com', 'www.shivautomob.com', 'GT12456', '123', 'Deepen Pandey', 2147483647, 1111343021, 1026896286, '', 'ac145', 392020, '2023-04-05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ag_state`
--

DROP TABLE IF EXISTS `ag_state`;
CREATE TABLE IF NOT EXISTS `ag_state` (
  `ag_state_id` int NOT NULL AUTO_INCREMENT,
  `ag_state_no` int NOT NULL,
  `ag_state_name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ag_state_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_state`
--

INSERT INTO `ag_state` (`ag_state_id`, `ag_state_no`, `ag_state_name`) VALUES
(1, 1111343021, 'Gujarat'),
(2, 1211211715, 'Delhi'),
(3, 1833473341, 'Check');

-- --------------------------------------------------------

--
-- Table structure for table `ag_vehicle`
--

DROP TABLE IF EXISTS `ag_vehicle`;
CREATE TABLE IF NOT EXISTS `ag_vehicle` (
  `ag_vehicle_id` int NOT NULL AUTO_INCREMENT,
  `ag_vehicle_code` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_vehicle_no` int NOT NULL,
  `ag_brand_no` int NOT NULL,
  `ag_vehicle_model_name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_vehicle_model_type` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_vehicle_mg_year` int NOT NULL,
  `ag_vehicle_cc` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_vehicle_fuel` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_vehicle_img` text COLLATE utf8mb4_general_ci NOT NULL COMMENT 'l=50',
  `ag_vehicle_status` int NOT NULL COMMENT '1=active\r\n2=inactive',
  `ag_vehicle_date` date NOT NULL,
  PRIMARY KEY (`ag_vehicle_id`)
) ENGINE=MyISAM AUTO_INCREMENT=159 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_vehicle`
--

INSERT INTO `ag_vehicle` (`ag_vehicle_id`, `ag_vehicle_code`, `ag_vehicle_no`, `ag_brand_no`, `ag_vehicle_model_name`, `ag_vehicle_model_type`, `ag_vehicle_mg_year`, `ag_vehicle_cc`, `ag_vehicle_fuel`, `ag_vehicle_img`, `ag_vehicle_status`, `ag_vehicle_date`) VALUES
(29, 'AGV_01', 1700026017, 1508640779, 'Activa', 'Scooter', 2012, '169', 'Petrol', '2023-07-06-1290059301.png', 1, '2023-07-06'),
(30, 'AGV_02', 1171453103, 1508640779, 'Activa', 'Scooter', 2010, '150', 'Diesel', '2023-07-10-1826550690.png', 1, '2023-07-10'),
(158, 'AGV_01', 193825068, 630676143, 'C', 'Scooter', 2023, '160', 'Petrol', '2023-07-11-756992506.png', 1, '2023-07-11'),
(157, 'AGV_01', 1176080786, 630676143, 'B', 'Scooter', 2013, '150', 'Petrol', '2023-07-11-941764334.png', 1, '2023-07-11'),
(156, 'AGV_01', 1786629320, 630676143, 'A', 'Scooter', 2012, '34', 'Petrol', '2023-07-11-163996481.png', 1, '2023-07-11'),
(155, 'AGV_06', 550893339, 1441387750, 'ex3', 'Scooter', 2023, '160', 'Petrol', '2023-07-11-1623506901.png', 1, '2023-07-11'),
(154, 'AGV_05', 1050315894, 1441387750, 'ex1', 'Scooter', 2012, '34', 'Petrol', '2023-07-11-177353981.png', 1, '2023-07-11'),
(153, 'AGV_04', 836174151, 1441387750, 'ex2', 'Scooter', 2013, '150', 'Petrol', '2023-07-11-1734376328.png', 1, '2023-07-11'),
(152, 'AGV_03', 1062940961, 1441387750, 'model3', 'Scooter', 2023, '160', 'Petrol', '2023-07-11-1626124827.png', 1, '2023-07-11'),
(151, 'AGV_03', 963161555, 1441387750, 'model2', 'Scooter', 2013, '150', 'Petrol', '2023-07-11-203198660.png', 1, '2023-07-11'),
(150, 'AGV_03', 692048720, 1441387750, 'model1', 'Scooter', 2012, '34', 'Petrol', '2023-07-11-2133146271.png', 1, '2023-07-11');

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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
