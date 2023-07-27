-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 27, 2023 at 08:00 AM
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
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(28, 1085779345, 'AG_7', 'Honda city', 'Bike', '2023-07-11-1752959018.png', 1),
(29, 924116792, 'AG_8', 'hummer', 'Bike', '2023-07-13-976891001.png', 1),
(30, 131313086, 'AG_9', 'hummerq', 'Bike', '2023-07-13-2094842879.png', 1),
(31, 2040405938, 'AG_10', 'abcd', 'Bike', '2023-07-13-1509996871.png', 1),
(32, 868398116, 'AG_11', 'qqqq', 'Bike', '2023-07-13-1804225304.png', 1),
(33, 1191283215, 'AG_12', 'TVSdsd', 'Bike', '2023-07-13-1445093179.png', 1);

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
-- Table structure for table `ag_customer`
--

DROP TABLE IF EXISTS `ag_customer`;
CREATE TABLE IF NOT EXISTS `ag_customer` (
  `ag_customer_id` int NOT NULL AUTO_INCREMENT,
  `ag_customer_no` int NOT NULL,
  `ag_customer_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_customer_phone_no` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_customer_address` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_customer_pending_amt` int NOT NULL,
  PRIMARY KEY (`ag_customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_customer`
--

INSERT INTO `ag_customer` (`ag_customer_id`, `ag_customer_no`, `ag_customer_name`, `ag_customer_phone_no`, `ag_customer_address`, `ag_customer_pending_amt`) VALUES
(1, 1979575117, 'Anisha', '', '', 0),
(2, 160416819, 'Azaz', '', '', 3300),
(3, 826458423, 'Abhishekk', '', '', 0),
(4, 1170478072, 'Moin', '', '', 0),
(5, 2084508650, 'Test', '12345667789', 'Goa,dfsd', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ag_mg_company`
--

DROP TABLE IF EXISTS `ag_mg_company`;
CREATE TABLE IF NOT EXISTS `ag_mg_company` (
  `ag_mg_company_id` int NOT NULL AUTO_INCREMENT,
  `ag_mg_company_code` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_mg_company_no` int NOT NULL,
  `ag_mg_company_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ag_mg_company_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_mg_company`
--

INSERT INTO `ag_mg_company` (`ag_mg_company_id`, `ag_mg_company_code`, `ag_mg_company_no`, `ag_mg_company_name`) VALUES
(1, 'AGC_1', 1777862565, 'Minda'),
(2, 'AGC_2', 249738810, 'ABC'),
(3, 'AGC_3', 84770721, 'pqr'),
(4, 'AGC_4', 525765510, 'pqr'),
(5, 'AGC_5', 1786563193, 'pqrz'),
(6, 'AGC_6', 1388397476, 'qqq'),
(7, 'AGC_7', 2050916898, 'Minda abc'),
(8, 'AGC_8', 451355281, 'm');

-- --------------------------------------------------------

--
-- Table structure for table `ag_part`
--

DROP TABLE IF EXISTS `ag_part`;
CREATE TABLE IF NOT EXISTS `ag_part` (
  `ag_part_id` int NOT NULL AUTO_INCREMENT,
  `ag_part_no` int NOT NULL,
  `ag_part_code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ag_brand_no` int NOT NULL,
  `ag_vehicle_no` int NOT NULL,
  `ag_part_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ag_part_company` int NOT NULL,
  `ag_part_purchase_price` decimal(10,2) NOT NULL,
  `ag_part_selling_price` decimal(10,2) NOT NULL,
  `ag_part_qty` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_part_alert_qty` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ag_part_hsn` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ag_part_cat` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_part_img` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'l=30',
  `ag_part_status` int NOT NULL COMMENT '1=active\r\n2=inactive',
  `ag_part_date` date NOT NULL,
  PRIMARY KEY (`ag_part_id`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_part`
--

INSERT INTO `ag_part` (`ag_part_id`, `ag_part_no`, `ag_part_code`, `ag_brand_no`, `ag_vehicle_no`, `ag_part_name`, `ag_part_company`, `ag_part_purchase_price`, `ag_part_selling_price`, `ag_part_qty`, `ag_part_alert_qty`, `ag_part_hsn`, `ag_part_cat`, `ag_part_img`, `ag_part_status`, `ag_part_date`) VALUES
(58, 659222676, 'AGP_6', 0, 0, 'Foot Rest', 1777862565, '40.00', '100.00', '20', '', 'fgdf', 'Oil', '2023-07-18-1188591637.png', 1, '2023-07-18'),
(57, 2066138375, 'AGP_5', 0, 0, 'fOOT rest', 1777862565, '200.00', '450.00', '66', '', 'dsadsad', 'Spare', '2023-07-18-1882673074.png', 1, '2023-07-18'),
(55, 870311119, 'AGP_3', 0, 0, 'abc', 1777862565, '50.00', '100.00', '4', '', '145sd', 'Oil', '2023-07-17-1518832456.png', 1, '2023-07-17'),
(56, 908887308, 'AGP_4', 0, 0, 'Foot Rest', 1777862565, '100.00', '350.00', '51', '', '145', 'Oil', '2023-07-18-972191209.png', 1, '2023-07-17'),
(54, 1803760710, 'AGP_2', 0, 0, 'Long Rest', 1777862565, '200.00', '450.00', '5', '', 'tytyty', 'Oil', '2023-07-16-266967418.png', 1, '2023-07-16'),
(53, 705675026, 'AGP_01', 0, 0, 'Foot Rest', 1777862565, '100.00', '550.00', '5', '', 'dsadsad', 'Oil', '2023-07-16-219744753.png', 1, '2023-07-16'),
(59, 1486878628, 'AGP_7', 0, 0, 'Foot Rest', 1777862565, '100.00', '400.00', '3', '60', 'tytyty', 'Oil', '2023-07-18-639875899.png', 1, '2023-07-18'),
(64, 739119981, 'AGP_12', 0, 0, 'Xyz', 1777862565, '100.00', '0.00', '2', '0', '145', 'Oil', '2023-07-19-1356035622.png', 1, '2023-07-19'),
(63, 1469610007, 'AGP_11', 0, 0, 'ewrwer', 1777862565, '100.00', '500.00', '3', '50', 'dsadsad', 'Oil', '2023-07-18-1188066601.png', 1, '2023-07-18'),
(62, 1325361987, 'AGP_10', 0, 0, 'ewrwer', 1777862565, '100.00', '500.00', '1', '50', 'dsadsad', 'Oil', '2023-07-18-751735388.png', 1, '2023-07-18'),
(65, 1873757089, 'AGP_13', 0, 0, '1888392439', 1777862565, '100.00', '0.00', '0', '0', '145', 'Oil', '2023-07-19-433974970.png', 1, '2023-07-19'),
(66, 1879130021, 'AGP_14', 0, 0, '1888392439', 1777862565, '100.00', '600.00', '1', '0', 'tytyty200', 'Oil', '2023-07-19-1449045762.png', 1, '2023-07-19'),
(67, 984757432, 'AGP_15', 0, 0, '672617900', 525765510, '0.00', '0.00', '1', '0', 'dsadsad', 'Oil', '2023-07-24-1212534400.png', 1, '2023-07-24'),
(68, 1181289683, 'AGP_16', 0, 0, '2072172372', 249738810, '0.00', '0.00', '1', '0', 'dsadsad', 'Oil', '2023-07-24-1448580921.png', 1, '2023-07-24'),
(69, 374243966, 'AGP_17', 0, 0, '1888392439', 84770721, '0.00', '0.00', '1', '0', 'tytyty', 'Accessories', '2023-07-24-208803529.png', 1, '2023-07-24'),
(70, 195247848, 'AGP_18', 0, 0, 'Long Rest', 249738810, '90.00', '150.00', '2', '0', 'dsadsad', 'Spare', '2023-07-24-339024754.png', 1, '2023-07-24'),
(71, 2088100901, 'AGP_19', 0, 0, 'Break', 1777862565, '0.00', '0.00', '50', '0', 'z', 'Spare', '2023-07-26-290662378.png', 1, '2023-07-26');

-- --------------------------------------------------------

--
-- Table structure for table `ag_partname`
--

DROP TABLE IF EXISTS `ag_partname`;
CREATE TABLE IF NOT EXISTS `ag_partname` (
  `ag_partname_id` int NOT NULL AUTO_INCREMENT,
  `ag_partname_no` int NOT NULL,
  `ag_partname_name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ag_partname_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_partname`
--

INSERT INTO `ag_partname` (`ag_partname_id`, `ag_partname_no`, `ag_partname_name`) VALUES
(1, 554478382, 'Foot rest'),
(2, 502103883, 'Long Rest'),
(3, 1888392439, 'Break'),
(4, 672617900, 'example'),
(5, 492670296, 'abcde'),
(6, 2072172372, 'qqqqqqqqqq'),
(7, 507764993, 'aaaaa');

-- --------------------------------------------------------

--
-- Table structure for table `ag_part_hold_stock`
--

DROP TABLE IF EXISTS `ag_part_hold_stock`;
CREATE TABLE IF NOT EXISTS `ag_part_hold_stock` (
  `ag_hold_id` int NOT NULL AUTO_INCREMENT,
  `ag_part_no` int NOT NULL,
  `ag_old_pp` decimal(10,2) NOT NULL,
  `ag_old_sp` decimal(10,2) NOT NULL,
  `ag_new_pp` decimal(10,2) NOT NULL,
  `ag_new_sp` decimal(10,2) NOT NULL,
  `ag_hold_qty` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_hold_status` int NOT NULL COMMENT '1=hold\r\n2=pushed',
  PRIMARY KEY (`ag_hold_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_part_hold_stock`
--

INSERT INTO `ag_part_hold_stock` (`ag_hold_id`, `ag_part_no`, `ag_old_pp`, `ag_old_sp`, `ag_new_pp`, `ag_new_sp`, `ag_hold_qty`, `ag_hold_status`) VALUES
(1, 1803760710, '100.00', '450.00', '200.00', '450.00', '25', 2),
(2, 659222676, '20.00', '80.00', '40.00', '100.00', '7', 2),
(3, 659222676, '40.00', '100.00', '60.00', '200.00', '50', 1),
(4, 1181289683, '0.00', '0.00', '20.00', '50.00', '1', 1),
(5, 195247848, '0.00', '0.00', '90.00', '150.00', '2', 2),
(6, 659222676, '40.00', '100.00', '50.00', '100.00', '1', 1),
(7, 2088100901, '0.00', '0.00', '100.00', '150.00', '15', 1),
(8, 2088100901, '0.00', '0.00', '100.00', '200.00', '50', 1),
(9, 2088100901, '0.00', '0.00', '30.00', '40.00', '1', 1),
(10, 2066138375, '100.00', '450.00', '200.00', '450.00', '25', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ag_part_repo`
--

DROP TABLE IF EXISTS `ag_part_repo`;
CREATE TABLE IF NOT EXISTS `ag_part_repo` (
  `ag_part_repo_id` int NOT NULL AUTO_INCREMENT,
  `ag_part_id` int NOT NULL,
  `ag_brand_no` int NOT NULL,
  `ag_vehicle_no` int NOT NULL,
  `ag_part_company` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ag_part_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ag_part_repo_status` int NOT NULL COMMENT '1=active\r\n2=inactive',
  PRIMARY KEY (`ag_part_repo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=148 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_part_repo`
--

INSERT INTO `ag_part_repo` (`ag_part_repo_id`, `ag_part_id`, `ag_brand_no`, `ag_vehicle_no`, `ag_part_company`, `ag_part_name`, `ag_part_repo_status`) VALUES
(123, 54, 1508640779, 1700026017, 'RST', 'Long Rest', 1),
(122, 53, 1441387750, 963161555, 'fhfhfgh', 'Foot Rest', 1),
(121, 53, 1441387750, 692048720, 'fhfhfgh', 'Foot Rest', 1),
(120, 53, 1441387750, 1062940961, 'fhfhfgh', 'Foot Rest', 1),
(119, 53, 924116792, 1693345631, 'fhfhfgh', 'Foot Rest', 1),
(118, 53, 1441387750, 1050315894, 'fhfhfgh', 'Foot Rest', 1),
(117, 53, 1441387750, 550893339, 'fhfhfgh', 'Foot Rest', 1),
(116, 53, 630676143, 1, 'fhfhfgh', 'Foot Rest', 1),
(115, 53, 630676143, 193825068, 'fhfhfgh', 'Foot Rest', 1),
(114, 53, 630676143, 1786629320, 'fhfhfgh', 'Foot Rest', 1),
(113, 53, 1508640779, 1700026017, 'fhfhfgh', 'Foot Rest', 1),
(124, 54, 1441387750, 692048720, 'RST', 'Long Rest', 1),
(125, 55, 1441387750, 1050315894, 'eee', 'abc', 1),
(126, 55, 1508640779, 1700026017, 'eee', 'abc', 1),
(127, 55, 630676143, 193825068, 'eee', 'abc', 1),
(128, 55, 630676143, 1786629320, 'eee', 'abc', 1),
(129, 56, 1441387750, 550893339, 'eee', 'Foot Rest', 1),
(130, 56, 1508640779, 1700026017, 'eee', 'Foot Rest', 1),
(131, 57, 1508640779, 1922786709, 'ABC', 'fOOT rest', 1),
(132, 57, 1441387750, 1062940961, 'ABC', 'fOOT rest', 1),
(133, 58, 1508640779, 1922786709, 'ABC', 'Foot Rest', 1),
(134, 59, 1441387750, 1050315894, 'ABC', 'Foot Rest', 1),
(135, 62, 1508640779, 1922786709, 'fhfhfgh', 'ewrwer', 1),
(136, 62, 630676143, 1786629320, 'fhfhfgh', 'ewrwer', 1),
(137, 63, 1508640779, 1922786709, 'fhfhfgh', 'ewrwer', 1),
(138, 63, 630676143, 1786629320, 'fhfhfgh', 'ewrwer', 1),
(139, 64, 924116792, 1693345631, 'eee', 'Xyz', 1),
(140, 65, 1441387750, 550893339, '1777862565', '1888392439', 1),
(141, 66, 1508640779, 1922786709, '1777862565', '1888392439', 1),
(142, 67, 1508640779, 1922786709, '525765510', '672617900', 1),
(143, 67, 1508640779, 1171453103, '525765510', '672617900', 1),
(144, 68, 1508640779, 1922786709, '249738810', '2072172372', 1),
(145, 69, 1441387750, 550893339, '84770721', '1888392439', 1),
(146, 70, 1508640779, 1922786709, '249738810', 'Long Rest', 1),
(147, 71, 1508640779, 1922786709, '1777862565', 'Break', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ag_po_cart`
--

DROP TABLE IF EXISTS `ag_po_cart`;
CREATE TABLE IF NOT EXISTS `ag_po_cart` (
  `ag_po_cart_id` int NOT NULL AUTO_INCREMENT,
  `ag_retailer_no` int NOT NULL,
  `ag_po_invoice_no` int NOT NULL,
  `ag_part_no` int NOT NULL,
  `ag_part_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ag_mg_company_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_po_qty` int NOT NULL,
  `ag_po_price` decimal(10,2) NOT NULL,
  `ag_po_sale_price` decimal(10,2) NOT NULL,
  `ag_po_discount` int NOT NULL,
  `ag_po_tax` int NOT NULL,
  `ag_po_date` date NOT NULL,
  `ag_po_status` int NOT NULL COMMENT '1=active\r\n2=inactive',
  PRIMARY KEY (`ag_po_cart_id`)
) ENGINE=MyISAM AUTO_INCREMENT=176 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_po_cart`
--

INSERT INTO `ag_po_cart` (`ag_po_cart_id`, `ag_retailer_no`, `ag_po_invoice_no`, `ag_part_no`, `ag_part_name`, `ag_mg_company_name`, `ag_po_qty`, `ag_po_price`, `ag_po_sale_price`, `ag_po_discount`, `ag_po_tax`, `ag_po_date`, `ag_po_status`) VALUES
(87, 231924102, 32836023, 870311119, 'abc', 'Minda', 1, '100.00', '0.00', 2, 10, '2023-07-21', 1),
(86, 231924102, 32836023, 2066138375, 'fOOT rest', 'Minda', 1, '200.00', '0.00', 0, 12, '2023-07-21', 1),
(85, 231924102, 32836023, 659222676, 'Foot Rest', 'Minda', 1, '300.00', '0.00', 1, 0, '2023-07-21', 1),
(84, 231924102, 780873569, 870311119, 'abc', 'Minda', 10, '100.00', '0.00', 5, 15, '2023-07-20', 1),
(83, 231924102, 780873569, 2066138375, 'fOOT rest', 'Minda', 12, '200.00', '0.00', 6, 12, '2023-07-20', 1),
(82, 231924102, 780873569, 659222676, 'Foot Rest', 'Minda', 11, '300.00', '0.00', 7, 14, '2023-07-20', 1),
(81, 231924102, 386649930, 705675026, 'Foot Rest', 'Minda', 1, '200.00', '0.00', 0, 0, '2023-07-20', 1),
(80, 231924102, 386649930, 870311119, 'abc', 'Minda', 2, '500.00', '0.00', 0, 0, '2023-07-20', 1),
(79, 231924102, 977403182, 2066138375, 'fOOT rest', 'Minda', 2, '10.00', '0.00', 0, 0, '2023-07-20', 1),
(78, 231924102, 977403182, 659222676, 'Foot Rest', 'Minda', 1, '100.00', '0.00', 0, 0, '2023-07-20', 1),
(88, 2035485059, 501010795, 659222676, 'Foot Rest', 'Minda', 1, '100.00', '0.00', 5, 10, '2023-07-21', 1),
(89, 2035485059, 501010795, 2066138375, 'fOOT rest', 'Minda', 1, '200.00', '0.00', 2, 5, '2023-07-21', 1),
(90, 2035485059, 37230352, 659222676, 'Foot Rest', 'Minda', 1, '100.00', '0.00', 5, 12, '2023-07-21', 1),
(91, 2035485059, 37230352, 739119981, 'Xyz', 'Minda', 1, '200.00', '0.00', 10, 18, '2023-07-24', 1),
(92, 2035485059, 1446015765, 870311119, 'abc', 'Minda', 1, '200.00', '0.00', 5, 12, '2023-07-24', 1),
(93, 2035485059, 1446015765, 739119981, 'Xyz', 'Minda', 1, '4000.00', '0.00', 10, 18, '2023-07-24', 1),
(94, 2035485059, 2038523784, 870311119, 'abc', 'Minda', 1, '100.00', '0.00', 0, 0, '2023-07-24', 1),
(95, 2035485059, 1295377738, 870311119, 'abc', 'Minda', 1, '100.00', '0.00', 0, 0, '2023-07-24', 1),
(96, 2035485059, 256755646, 870311119, 'abc', 'Minda', 1, '10.00', '0.00', 0, 0, '2023-07-24', 1),
(97, 1815203693, 8037024, 659222676, 'Foot Rest', 'Minda', 1, '100.00', '0.00', 0, 0, '2023-07-24', 1),
(98, 1815203693, 412736951, 1469610007, 'ewrwer', 'Minda', 1, '200.00', '0.00', 0, 0, '2023-07-24', 1),
(99, 231924102, 673083353, 870311119, 'abc', 'Minda', 1, '120.00', '200.00', 5, 12, '2023-07-24', 1),
(100, 231924102, 673083353, 705675026, 'Foot Rest', 'Minda', 1, '50.00', '400.00', 0, 0, '2023-07-24', 1),
(101, 2035485059, 1058335773, 659222676, 'Foot Rest', 'Minda', 1, '20.00', '80.00', 0, 0, '2023-07-24', 1),
(102, 2035485059, 1058335773, 870311119, 'abc', 'Minda', 1, '50.00', '100.00', 0, 0, '2023-07-24', 1),
(110, 231924102, 435543805, 908887308, 'Foot Rest', 'Minda', 5, '100.00', '350.00', 0, 0, '2023-07-24', 1),
(109, 231924102, 435543805, 2066138375, 'fOOT rest', 'Minda', 10, '100.00', '450.00', 0, 0, '2023-07-24', 1),
(108, 231924102, 435543805, 659222676, 'Foot Rest', 'Minda', 15, '20.00', '80.00', 0, 0, '2023-07-24', 1),
(111, 1815203693, 345160479, 870311119, 'abc', 'Minda', 1, '50.00', '100.00', 0, 0, '2023-07-24', 1),
(112, 1815203693, 345160479, 1803760710, 'Long Rest', 'Minda', 25, '200.00', '450.00', 0, 0, '2023-07-24', 1),
(113, 2035485059, 1926131378, 659222676, 'Foot Rest', 'Minda', 7, '40.00', '100.00', 0, 0, '2023-07-24', 1),
(114, 1815203693, 1219626256, 659222676, 'Foot Rest', 'Minda', 50, '60.00', '200.00', 0, 0, '2023-07-24', 1),
(115, 1815203693, 1219626256, 2066138375, 'fOOT rest', 'Minda', 1, '100.00', '450.00', 0, 0, '2023-07-24', 1),
(116, 1815203693, 1219626256, 870311119, 'abc', 'Minda', 1, '50.00', '100.00', 0, 0, '2023-07-24', 1),
(117, 231924102, 1382341998, 659222676, 'Foot Rest', 'Minda', 2, '40.00', '100.00', 0, 0, '2023-07-24', 1),
(118, 231924102, 1382341998, 870311119, 'abc', 'Minda', 1, '50.00', '100.00', 0, 0, '2023-07-24', 1),
(119, 231924102, 1382341998, 1879130021, '1888392439', 'Minda', 1, '100.00', '600.00', 0, 0, '2023-07-24', 1),
(120, 231924102, 1382341998, 1181289683, '2072172372', 'ABC', 1, '20.00', '50.00', 0, 0, '2023-07-24', 1),
(121, 231924102, 1382341998, 195247848, 'Long Rest', 'ABC', 2, '90.00', '150.00', 0, 0, '2023-07-24', 1),
(122, 231924102, 1382341998, 1803760710, 'Long Rest', 'Minda', 1, '200.00', '450.00', 0, 0, '2023-07-24', 1),
(123, 231924102, 1422101753, 659222676, 'Foot Rest', 'Minda', 1, '40.00', '100.00', 0, 0, '2023-07-24', 1),
(124, 231924102, 1422101753, 870311119, 'abc', 'Minda', 2, '50.00', '100.00', 0, 0, '2023-07-24', 1),
(125, 231924102, 1422101753, 2066138375, 'fOOT rest', 'Minda', 1, '100.00', '450.00', 0, 0, '2023-07-25', 1),
(126, 1815203693, 844304267, 659222676, 'Foot Rest', 'Minda', 1, '40.00', '100.00', 5, 10, '2023-07-25', 1),
(127, 54144432, 1384872748, 659222676, 'Foot Rest', 'Minda', 1, '50.00', '100.00', 0, 0, '2023-07-25', 1),
(128, 54144432, 1384872748, 1469610007, 'ewrwer', 'Minda', 1, '100.00', '500.00', 0, 0, '2023-07-25', 1),
(129, 1815203693, 597902161, 659222676, 'Foot Rest', 'Minda', 3, '40.00', '100.00', 0, 0, '2023-07-25', 1),
(130, 1815203693, 597902161, 2066138375, 'fOOT rest', 'Minda', 1, '100.00', '450.00', 0, 0, '2023-07-25', 1),
(131, 1815203693, 597902161, 1803760710, 'Long Rest', 'Minda', 2, '200.00', '450.00', 0, 0, '2023-07-25', 1),
(132, 1815203693, 597902161, 1486878628, 'Foot Rest', 'Minda', 1, '100.00', '400.00', 0, 0, '2023-07-25', 1),
(133, 1815203693, 597902161, 739119981, 'Xyz', 'Minda', 1, '100.00', '0.00', 0, 0, '2023-07-25', 1),
(134, 1815203693, 597902161, 1325361987, 'ewrwer', 'Minda', 1, '100.00', '500.00', 0, 0, '2023-07-25', 1),
(135, 1815203693, 1996527498, 659222676, 'Foot Rest', 'Minda', 10, '40.00', '100.00', 0, 0, '2023-07-25', 1),
(136, 1815203693, 1996527498, 2066138375, 'fOOT rest', 'Minda', 30, '100.00', '450.00', 0, 0, '2023-07-25', 1),
(137, 1815203693, 655815708, 870311119, 'abc', 'Minda', 15, '50.00', '100.00', 0, 0, '2023-07-25', 1),
(138, 1815203693, 655815708, 908887308, 'Foot Rest', 'Minda', 25, '100.00', '350.00', 0, 0, '2023-07-25', 1),
(146, 231924102, 1674279374, 2088100901, 'Break', 'Minda', 15, '100.00', '150.00', 5, 12, '2023-07-26', 1),
(147, 231924102, 1632352167, 1803760710, 'Long Rest', 'Minda', 12, '200.00', '450.00', 0, 0, '2023-07-26', 1),
(148, 231924102, 638972740, 870311119, 'abc', 'Minda', 2, '50.00', '100.00', 0, 0, '2023-07-26', 1),
(149, 1438042722, 350559639, 908887308, 'Foot Rest', 'Minda', 1, '100.00', '350.00', 0, 0, '2023-07-26', 1),
(150, 1800173552, 1828431876, 659222676, 'Foot Rest', 'Minda', 2, '40.00', '100.00', 0, 0, '2023-07-26', 1),
(151, 90690151, 1517104343, 739119981, 'Xyz', 'Minda', 1, '100.00', '0.00', 0, 0, '2023-07-26', 1),
(154, 54144432, 713042926, 659222676, 'Foot Rest', 'Minda', 5, '40.00', '100.00', 5, 15, '2023-07-26', 1),
(153, 1815203693, 1654884297, 2088100901, 'Break', 'Minda', 50, '100.00', '200.00', 5, 10, '2023-07-26', 1),
(155, 54144432, 713042926, 2088100901, 'Break', 'Minda', 1, '30.00', '40.00', 10, 20, '2023-07-26', 1),
(160, 1815203693, 540665023, 659222676, 'Foot Rest', 'Minda', 6, '40.00', '100.00', 0, 0, '2023-07-26', 1),
(159, 54144432, 713042926, 1486878628, 'Foot Rest', 'Minda', 1, '100.00', '400.00', 0, 0, '2023-07-26', 1),
(161, 1815203693, 1084895769, 659222676, 'Foot Rest', 'Minda', 5, '40.00', '100.00', 0, 0, '2023-07-26', 1),
(162, 231924102, 646082574, 2066138375, 'fOOT rest', 'Minda', 25, '200.00', '450.00', 0, 0, '2023-07-26', 1),
(163, 231924102, 646082574, 659222676, 'Foot Rest', 'Minda', 5, '40.00', '100.00', 0, 0, '2023-07-26', 1),
(165, 231924102, 1674430101, 659222676, 'Foot Rest', 'Minda', 1, '40.00', '100.00', 0, 0, '2023-07-26', 1),
(166, 231924102, 1674430101, 870311119, 'abc', 'Minda', 1, '50.00', '100.00', 0, 0, '2023-07-26', 1),
(167, 231924102, 334634707, 2066138375, 'fOOT rest', 'Minda', 1, '200.00', '450.00', 0, 0, '2023-07-26', 1),
(168, 1800173552, 1554204720, 870311119, 'abc', 'Minda', 1, '50.00', '100.00', 0, 0, '2023-07-26', 1),
(169, 1800173552, 263314604, 1486878628, 'Foot Rest', 'Minda', 1, '100.00', '400.00', 0, 0, '2023-07-26', 1),
(170, 2035485059, 1711157364, 1803760710, 'Long Rest', 'Minda', 1, '200.00', '450.00', 0, 0, '2023-07-26', 1),
(171, 0, 367070811, 1803760710, 'Long Rest', 'Minda', 1, '200.00', '450.00', 0, 0, '2023-07-26', 0),
(172, 0, 367070811, 705675026, 'Foot Rest', 'Minda', 1, '100.00', '550.00', 0, 0, '2023-07-26', 0),
(173, 0, 367070811, 2066138375, 'fOOT rest', 'Minda', 1, '200.00', '450.00', 0, 0, '2023-07-27', 0),
(174, 0, 367070811, 1486878628, 'Foot Rest', 'Minda', 1, '100.00', '400.00', 0, 0, '2023-07-27', 0),
(175, 0, 367070811, 1469610007, 'ewrwer', 'Minda', 1, '100.00', '500.00', 0, 0, '2023-07-27', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ag_po_cart_repo`
--

DROP TABLE IF EXISTS `ag_po_cart_repo`;
CREATE TABLE IF NOT EXISTS `ag_po_cart_repo` (
  `ag_po_cart_repo_id` int NOT NULL AUTO_INCREMENT,
  `ag_po_invoice_no` int NOT NULL,
  `ag_retailer_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_retailer_company_phone` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_retailer_company_email` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_retailer_company_gst` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_retailer_company_tin` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_retailer_state` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_retailer_city` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_retailer_area` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_retailer_house_no` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_retailer_pincode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ag_po_payment_type` int NOT NULL COMMENT '1-cash\r\n2-online\r\n3-cheque',
  `ag_po_receipt_no` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_po_amount_paid` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_po_pending_amt` decimal(10,2) NOT NULL,
  `ag_po_cust_pay` decimal(10,2) NOT NULL,
  `ag_po_invoice_date` date NOT NULL,
  `ag_po_invoice_due_date` date NOT NULL,
  `ag_po_receipt_img` text COLLATE utf8mb4_general_ci NOT NULL,
  `ag_no_of_items` int NOT NULL,
  `ag_po_cart_repo_status` int NOT NULL COMMENT '1-Active\r\n2-In Active',
  PRIMARY KEY (`ag_po_cart_repo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_po_cart_repo`
--

INSERT INTO `ag_po_cart_repo` (`ag_po_cart_repo_id`, `ag_po_invoice_no`, `ag_retailer_name`, `ag_retailer_company_phone`, `ag_retailer_company_email`, `ag_retailer_company_gst`, `ag_retailer_company_tin`, `ag_retailer_state`, `ag_retailer_city`, `ag_retailer_area`, `ag_retailer_house_no`, `ag_retailer_pincode`, `ag_po_payment_type`, `ag_po_receipt_no`, `ag_po_amount_paid`, `ag_po_pending_amt`, `ag_po_cust_pay`, `ag_po_invoice_date`, `ag_po_invoice_due_date`, `ag_po_receipt_img`, `ag_no_of_items`, `ag_po_cart_repo_status`) VALUES
(4, 386649930, 'Shiv Automobiles', '', '', '', '', '', '', '', '', '', 2, 'sdf231', '12000', '0.00', '0.00', '2023-07-20', '2023-07-22', '2023-07-20-1356397151.png', 2, 1),
(3, 977403182, 'Shiv Automobiles', '', '', '', '', '', '', '', '', '', 1, 'sdf231', '12000', '0.00', '0.00', '2023-07-20', '2023-07-21', '2023-07-20-1065072329.png', 2, 1),
(5, 780873569, 'Shiv Automobiles', '', '', '', '', '', '', '', '', '', 2, 'sdf231', '12000', '0.00', '0.00', '2023-07-21', '2023-07-22', '2023-07-21-1041793634.png', 3, 1),
(6, 32836023, 'Shiv Automobiles', '', '', '', '', '', '', '', '', '', 1, 'sdf231', '628', '0.00', '0.00', '2023-07-22', '2023-07-22', '2023-07-21-727223268.png', 3, 1),
(7, 501010795, 'xyz', '', '', '', '', '', '', '', '', '', 2, 'sdf231', '310', '0.00', '0.00', '2023-07-22', '2023-07-22', '2023-07-21-291432637.png', 2, 1),
(8, 1295377738, 'xyz', '1125421212', 'xyz@gmail.com', 'GT12456', '123', '1211211715', '2064270509', 'qaqaqa', 'ac145', '392020', 1, 'fdf123', '100', '0.00', '0.00', '2023-07-07', '2023-07-25', '2023-07-24-2106273158.png', 1, 1),
(9, 412736951, 'ABC', '1125421212', 'abc@gmail.com', 'GT12456', '123', 'Gujarat', 'Bharuch', '', 'ac145', '392020', 1, 'fdf123', '200', '0.00', '0.00', '2023-07-04', '2023-07-28', '2023-07-24-1713660707.png', 1, 1),
(10, 673083353, 'Shiv Automobiles', '7698903619', 'Shivautomobile@gmail.com', 'GT12456', '1235543', 'Gujarat', 'Bharuch', '', 'ac14555', '392200', 2, 'fdf123', '177.68', '0.00', '0.00', '2023-07-23', '2023-07-24', '2023-07-24-288071508.png', 2, 1),
(11, 1058335773, 'xyz', '1125421212', 'xyz@gmail.com', 'GT12456', '123', 'Gujarat', 'Bharuch', 'qaqaqa', 'ac145', '392020', 2, 'fdf123', '70', '0.00', '0.00', '2023-07-16', '2023-07-24', '2023-07-24-1665912144.png', 2, 1),
(12, 435543805, 'Shiv Automobiles', '7698903619', 'Shivautomobile@gmail.com', 'GT12456', '1235543', 'Gujarat', 'Bharuch', '', 'ac14555', '392200', 1, 'fdf123', '1800', '0.00', '0.00', '2023-07-03', '2023-07-24', '2023-07-24-647594844.png', 3, 1),
(13, 345160479, 'ABC', '1125421212', 'abc@gmail.com', 'GT12456', '123', 'Gujarat', 'Bharuch', '', 'ac145', '392020', 1, 'fdf123', '5050', '0.00', '0.00', '2023-06-27', '2023-07-23', '2023-07-24-989585179.png', 2, 1),
(14, 1926131378, 'xyz', '1125421212', 'xyz@gmail.com', 'GT12456', '123', 'Gujarat', 'Bharuch', 'qaqaqa', 'ac145', '392020', 1, 'fdf123', '280', '0.00', '0.00', '2023-06-26', '2023-07-23', '2023-07-24-278073000.png', 1, 1),
(15, 1219626256, 'ABC', '1125421212', 'abc@gmail.com', 'GT12456', '123', 'Gujarat', 'Bharuch', '', 'ac145', '392020', 1, 'fdf123', '3150', '0.00', '0.00', '2023-07-04', '2023-06-26', '2023-07-24-2022731887.png', 3, 1),
(16, 1382341998, 'Shiv Automobiles', '7698903619', 'Shivautomobile@gmail.com', 'GT12456', '1235543', 'Gujarat', 'Bharuch', '', 'ac14555', '392200', 1, 'fdf123', '630', '10.00', '0.00', '2023-07-11', '2023-07-24', '2023-07-24-933704911.png', 6, 1),
(17, 1422101753, 'Shiv Automobiles', '7698903619', 'Shivautomobile@gmail.com', 'GT12456', '1235543', 'Gujarat', 'Bharuch', '', 'ac14555', '392200', 1, 'fdf123', '240', '0.00', '0.00', '2023-07-18', '2023-07-28', '2023-07-25-2131150245.png', 3, 1),
(18, 844304267, 'ABC', '1125421212', 'abc@gmail.com', 'GT12456', '123', 'Gujarat', 'Bharuch', '', 'ac145', '392020', 1, 'fdf123', '41.8', '10.00', '0.00', '2023-07-19', '2023-07-26', '2023-07-25-518393151.png', 1, 1),
(19, 1384872748, 'ecomITSolution', '7698903619', 'ecom@gmail.com', '12312', '1235543', 'Gujarat', 'Bharuch', 'hfg', 'ac14555', '392200', 1, 'fdf123', '150', '0.00', '0.00', '2023-07-19', '2023-08-04', '2023-07-25-1914864574.png', 2, 1),
(20, 597902161, 'ABC', '1125421212', 'abc@gmail.com', 'GT12456', '123', 'Gujarat', 'Bharuch', '', 'ac145', '392020', 1, 'fdf123', '920', '0.00', '0.00', '2023-07-10', '2023-07-25', '2023-07-25-813947732.png', 6, 1),
(21, 1996527498, 'ABC', '1125421212', 'abc@gmail.com', 'GT12456', '123', 'Gujarat', 'Bharuch', '', 'ac145', '392020', 1, 'fdf123', '3400', '460.00', '0.00', '2023-07-02', '2023-07-25', '2023-07-25-341807769.png', 2, 1),
(22, 655815708, 'ABC', '1125421212', 'abc@gmail.com', 'GT12456', '123', 'Gujarat', 'Bharuch', '', 'ac145', '392020', 1, '', '3250', '1930.00', '0.00', '0000-00-00', '0000-00-00', '2023-07-25-1850828605.png', 2, 1),
(23, 1674279374, 'Shiv Automobiles', '7698903619', 'Shivautomobile@gmail.com', 'GT12456', '1235543', 'Gujarat', 'Bharuch', '', 'ac14555', '392200', 1, 'fdf123', '1596', '0.00', '0.00', '2023-07-19', '2023-08-03', '2023-07-26-927521626.png', 1, 1),
(24, 1632352167, 'Shiv Automobiles', '7698903619', 'Shivautomobile@gmail.com', 'GT12456', '1235543', 'Gujarat', 'Bharuch', '', 'ac14555', '392200', 1, '', '200', '798.00', '0.00', '0000-00-00', '0000-00-00', '2023-07-26-652532216.png', 1, 1),
(25, 638972740, 'Shiv Automobiles', '7698903619', 'Shivautomobile@gmail.com', 'GT12456', '1235543', 'Gujarat', 'Bharuch', '', 'ac14555', '392200', 1, 'fdf123', '50', '798.00', '0.00', '0000-00-00', '0000-00-00', '2023-07-26-829074568.png', 1, 1),
(26, 350559639, 'Shiv Automobiles', '1125421212', 'Shivautomobile@gmail.com', 'GT12456', '123', 'Gujarat', 'Bharuch', '', 'ac145', '392020', 1, 'fdf123', '100', '0.00', '0.00', '2023-07-26', '2023-08-05', '2023-07-26-2002949009.png', 1, 1),
(27, 1828431876, 'ecom', '7698903619', 'ecom@gmail.com', '12312', '12312', 'Gujarat', 'Bharuch', 'hfg', 'ac14555', '392200', 1, '', '40', '0.00', '0.00', '0000-00-00', '0000-00-00', '2023-07-26-1082971986.png', 1, 1),
(28, 1517104343, 'moonsquare', '7698903619', 'ecom@gmail.com', '12312', '1235543', 'Gujarat', 'Bharuch', 'hfg', 'ac14555', '392200', 1, 'fdf123', '100', '0.00', '0.00', '2023-07-25', '2023-08-05', '2023-07-26-747563098.png', 1, 1),
(29, 1654884297, 'ABC', '1125421212', 'abc@gmail.com', 'GT12456', '123', 'Gujarat', 'Bharuch', '', 'ac145', '392020', 1, 'fdf123', '5225', '5180.00', '0.00', '2023-07-27', '2023-08-04', '2023-07-26-2051805204.png', 1, 1),
(30, 713042926, 'ecomITSolution', '7698903619', 'ecom@gmail.com', '12312', '1235543', 'Gujarat', 'Bharuch', 'hfg', 'ac14555', '392200', 1, 'fdf123', '350.9', '0.00', '0.00', '2023-07-12', '2023-08-04', '2023-07-26-1836357596.png', 3, 1),
(31, 540665023, 'ABC', '1125421212', 'abc@gmail.com', 'GT12456', '123', 'Gujarat', 'Bharuch', '', 'ac145', '392020', 1, 'fdf123', '240', '5180.00', '0.00', '2023-06-26', '2023-07-16', '2023-07-26-865966658.png', 1, 1),
(32, 1084895769, 'ABC', '1125421212', 'abc@gmail.com', 'GT12456', '123', 'Gujarat', 'Bharuch', '', 'ac145', '392020', 1, 'fdf123', '200', '5180.00', '0.00', '2023-06-25', '2023-07-25', '2023-07-26-1886623978.png', 1, 1),
(33, 646082574, 'Shiv Automobiles', '7698903619', 'Shivautomobile@gmail.com', 'GT12456', '1235543', 'Gujarat', 'Bharuch', '', 'ac14555', '392200', 1, 'fdf123', '5200', '424.00', '0.00', '2023-06-26', '2023-07-25', '2023-07-26-1861624915.png', 2, 1),
(34, 334634707, 'Shiv Automobiles', '7698903619', 'Shivautomobile@gmail.com', 'GT12456', '1235543', 'Gujarat', 'Bharuch', '', 'ac14555', '392200', 1, '', '200', '424.00', '624.00', '2023-06-25', '2023-07-10', '2023-07-26-822952893.png', 1, 1),
(35, 1554204720, 'ecom', '7698903619', 'ecom@gmail.com', '12312', '12312', 'Gujarat', 'Bharuch', 'hfg', 'ac14555', '392200', 1, 'fdf123', '50', '20.00', '60.00', '2023-07-02', '2023-07-03', '2023-07-26-1892595447.png', 1, 1),
(36, 263314604, 'ecom', '7698903619', 'ecom@gmail.com', '12312', '12312', 'Gujarat', 'Bharuch', 'hfg', 'ac14555', '392200', 1, 'fdf123', '100', '10.00', '0.00', '2023-07-02', '2023-07-24', '2023-07-26-1241325004.png', 1, 1),
(37, 1711157364, 'xyz', '1125421212', 'xyz@gmail.com', 'GT12456', '123', 'Gujarat', 'Bharuch', 'qaqaqa', 'ac145', '392020', 1, 'fdf123', '200', '0.00', '150.00', '2023-07-03', '2023-07-17', '2023-07-26-382327073.png', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ag_retailer`
--

DROP TABLE IF EXISTS `ag_retailer`;
CREATE TABLE IF NOT EXISTS `ag_retailer` (
  `ag_retailer_id` int NOT NULL AUTO_INCREMENT,
  `ag_retailer_no` int NOT NULL,
  `ag_retailer_code` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_retailer_pending_amt` decimal(10,2) NOT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_retailer`
--

INSERT INTO `ag_retailer` (`ag_retailer_id`, `ag_retailer_no`, `ag_retailer_code`, `ag_retailer_pending_amt`, `ag_retailer_company_name`, `ag_retailer_owner_name`, `ag_retailer_comapny_phone`, `ag_retailer_comapny_alt_phone`, `ag_retailer_company_email`, `ag_retailer_company_website`, `ag_retailer_company_gst`, `ag_retailer_company_tin`, `ag_retailer_contact_persone_name`, `ag_retailer_contact_person_phone`, `ag_retailer_state`, `ag_retailer_city`, `ag_retailer_area`, `ag_retailer_house_no`, `ag_retailer_pincode`, `ag_retailer_register_date`, `ag_retailer_status`) VALUES
(2, 231924102, 'RT_2', '424.00', 'Shiv Automobiles', 'Pravin Patelsd', 7698903619, 7698903699, 'Shivautomobile@gmail.com', 'www.shivautomob.com', 'GT12456', '1235543', 'Deepen Pandeye', 2147483647, 1111343021, 2064270509, '', 'ac14555', 392200, '2023-03-29', 0),
(3, 1815203693, 'RT_3', '5180.00', 'ABC', 'Maynak', 1125421212, 2147483647, 'abc@gmail.com', 'www.abc.com', 'GT12456', '123', 'Abhishek Patel', 2147483647, 1111343021, 1026896286, '', 'ac145', 392020, '2022-11-30', 0),
(5, 2035485059, 'RT_4', '50.00', 'xyz', 'Pravin Patel', 1125421212, 2147483647, 'xyz@gmail.com', 'www.xyz.com', 'GT12456', '123', 'Abhishek Patel', 2147483647, 1211211715, 2064270509, 'qaqaqa', 'ac145', 392020, '2023-07-07', 0),
(6, 1438042722, 'RT_5', '50.00', 'Shiv Automobiles', 'Pravin Patel', 1125421212, 0, 'Shivautomobile@gmail.com', 'www.shivautomob.com', 'GT12456', '123', 'Deepen Pandey', 2147483647, 1111343021, 1026896286, '', 'ac145', 392020, '2023-04-05', 0),
(7, 503325297, 'RT_6', '0.00', 'Shiv Automobiles', 'Pravin Patel', 1125421212, 0, 'Shivautomobile@gmail.com', 'www.shivautomob.com', 'GT12456', '123', 'Deepen Pandey', 2147483647, 1111343021, 1026896286, '', 'ac145', 392020, '2023-04-05', 0),
(8, 1800173552, 'RT_7', '110.00', 'ecom', 'Pravin Patelsd', 7698903619, 7698903699, 'ecom@gmail.com', 'www.ecom.com', '12312', '12312', 'Deepen Pandeye', 2134124234, 1111343021, 0, 'hfg', 'ac14555', 392200, '2023-07-23', 0),
(9, 54144432, 'RT_8', '175.45', 'ecomITSolution', 'Pravin Patelsd', 7698903619, 7698903699, 'ecom@gmail.com', 'www.ecom.com', '12312', '1235543', 'Deepen Pandeye', 2134124234, 1211211715, 0, 'hfg', 'ac14555', 392200, '2023-07-26', 0),
(10, 90690151, 'RT_9', '50.00', 'moonsquare', 'Pravin Patelsd', 7698903619, 7698903699, 'ecom@gmail.com', 'www.ecom.com', '12312', '1235543', 'Deepen Pandeye', 2134124234, 1111343021, 0, 'hfg', 'ac14555', 392200, '2023-07-24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ag_sells_order_cart`
--

DROP TABLE IF EXISTS `ag_sells_order_cart`;
CREATE TABLE IF NOT EXISTS `ag_sells_order_cart` (
  `ag_sells_order_id` int NOT NULL AUTO_INCREMENT,
  `ag_customer_no` int NOT NULL,
  `ag_sells_invoice_no` int NOT NULL,
  `ag_part_no` int NOT NULL,
  `ag_part_name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_mg_company_name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_sells_qty` int NOT NULL,
  `ag_sells_price` decimal(10,2) NOT NULL,
  `ag_sells_purchase_price` decimal(10,2) NOT NULL,
  `ag_sells_discount` int NOT NULL,
  `ag_sells_tax` int NOT NULL,
  `ag_sells_date` date NOT NULL,
  `ag_sells_status` int NOT NULL COMMENT '1-Active\r\n2-In active',
  PRIMARY KEY (`ag_sells_order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_sells_order_cart`
--

INSERT INTO `ag_sells_order_cart` (`ag_sells_order_id`, `ag_customer_no`, `ag_sells_invoice_no`, `ag_part_no`, `ag_part_name`, `ag_mg_company_name`, `ag_sells_qty`, `ag_sells_price`, `ag_sells_purchase_price`, `ag_sells_discount`, `ag_sells_tax`, `ag_sells_date`, `ag_sells_status`) VALUES
(16, 1979575117, 899389473, 870311119, 'abc', '1777862565', 6, '100.00', '50.00', 0, 0, '2023-07-26', 1),
(12, 1979575117, 201756474, 705675026, 'Foot Rest', '1777862565', 5, '550.00', '100.00', 7, 10, '2023-07-26', 1),
(17, 1979575117, 1112698313, 870311119, 'abc', '1777862565', 1, '100.00', '50.00', 0, 0, '2023-07-26', 1),
(20, 160416819, 1579778810, 2066138375, 'fOOT rest', '1777862565', 1, '450.00', '200.00', 0, 0, '2023-07-27', 1),
(21, 1979575117, 1304725674, 659222676, 'Foot Rest', '1777862565', 1, '100.00', '40.00', 0, 0, '2023-07-27', 1),
(22, 826458423, 1679813511, 705675026, 'Foot Rest', '1777862565', 1, '550.00', '100.00', 0, 0, '2023-07-27', 1),
(23, 1979575117, 998990657, 1803760710, 'Long Rest', '1777862565', 1, '450.00', '200.00', 0, 0, '2023-07-27', 1),
(24, 160416819, 1368011786, 659222676, 'Foot Rest', '1777862565', 6, '100.00', '40.00', 0, 0, '2023-07-27', 1),
(25, 160416819, 1991998954, 2066138375, 'fOOT rest', '1777862565', 2, '450.00', '200.00', 5, 10, '2023-07-27', 1),
(26, 1979575117, 171292618, 2066138375, 'fOOT rest', '1777862565', 5, '450.00', '200.00', 0, 0, '2023-07-27', 1),
(27, 160416819, 1269453874, 2066138375, 'fOOT rest', '1777862565', 1, '450.00', '200.00', 0, 0, '2023-07-27', 1),
(28, 160416819, 1395667354, 2066138375, 'fOOT rest', '1777862565', 2, '450.00', '200.00', 0, 0, '2023-07-27', 1),
(29, 160416819, 1723659023, 2066138375, 'fOOT rest', '1777862565', 3, '450.00', '200.00', 0, 0, '2023-07-27', 1),
(30, 1979575117, 2075358512, 2066138375, 'fOOT rest', '1777862565', 1, '450.00', '200.00', 0, 0, '2023-07-27', 1),
(31, 1979575117, 2110573202, 705675026, 'Foot Rest', '1777862565', 4, '550.00', '100.00', 0, 0, '2023-07-27', 1),
(32, 1979575117, 752879960, 2066138375, 'fOOT rest', '1777862565', 5, '450.00', '200.00', 0, 0, '2023-07-27', 1),
(33, 1979575117, 1340567942, 2066138375, 'fOOT rest', '1777862565', 1, '450.00', '200.00', 0, 0, '2023-07-27', 1),
(34, 1979575117, 1882444062, 2066138375, 'fOOT rest', '1777862565', 2, '450.00', '200.00', 0, 0, '2023-07-27', 1),
(35, 1979575117, 1372108591, 2066138375, 'fOOT rest', '1777862565', 1, '450.00', '200.00', 0, 0, '2023-07-27', 1),
(36, 1979575117, 1209044594, 870311119, 'abc', '1777862565', 3, '100.00', '50.00', 0, 0, '2023-07-27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ag_sells_order_cart_repo`
--

DROP TABLE IF EXISTS `ag_sells_order_cart_repo`;
CREATE TABLE IF NOT EXISTS `ag_sells_order_cart_repo` (
  `ag_sells_order_cart_repo_id` int NOT NULL AUTO_INCREMENT,
  `ag_sells_invoice_no` int NOT NULL,
  `ag_customer_name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_customer_phone` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_customer_address` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_sells_payment_type` int NOT NULL COMMENT '1-cash\r\n2-online\r\n3-cheque',
  `ag_sells_amount_paid` int NOT NULL,
  `ag_so_receipt_no` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_sells_pending_amt` decimal(10,2) NOT NULL,
  `ag_sells_cust_pay` decimal(10,2) NOT NULL,
  `ag_so_invoice_date` date NOT NULL,
  `ag_so_receipt_img` text COLLATE utf8mb4_general_ci NOT NULL,
  `ag_no_of_items` int NOT NULL,
  `ag_sells_order_cart_repo_status` int NOT NULL COMMENT '1-Active\r\n2-In Active',
  PRIMARY KEY (`ag_sells_order_cart_repo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_sells_order_cart_repo`
--

INSERT INTO `ag_sells_order_cart_repo` (`ag_sells_order_cart_repo_id`, `ag_sells_invoice_no`, `ag_customer_name`, `ag_customer_phone`, `ag_customer_address`, `ag_sells_payment_type`, `ag_sells_amount_paid`, `ag_so_receipt_no`, `ag_sells_pending_amt`, `ag_sells_cust_pay`, `ag_so_invoice_date`, `ag_so_receipt_img`, `ag_no_of_items`, `ag_sells_order_cart_repo_status`) VALUES
(1, 1368011786, 'Azaz', '', '', 1, 600, '0', '12.00', '0.00', '2023-07-19', '2023-07-27-348098135.png', 1, 1),
(2, 171292618, 'Anisha', '', '', 1, 2250, 'fdf123', '10.00', '0.00', '2023-07-19', '2023-07-27-1575172271.png', 1, 1),
(3, 1269453874, 'Azaz', '', '', 2, 450, 'fdf123', '600.00', '0.00', '2023-07-19', '2023-07-27-759603283.png', 1, 1),
(4, 1395667354, 'Azaz', '', '', 2, 900, 'fdf123', '1050.00', '0.00', '2023-07-25', '2023-07-27-1064018572.png', 1, 1),
(5, 1723659023, 'Azaz', '', '', 1, 1350, '', '1950.00', '0.00', '0000-00-00', '2023-07-27-1963383027.png', 1, 1),
(6, 2075358512, 'Anisha', '', '', 1, 2650, 'fdf123', '2260.00', '0.00', '2023-07-04', '2023-07-27-1863153479.png', 2, 1),
(7, 752879960, 'Anisha', '', '', 1, 2250, 'fdf123', '4910.00', '0.00', '2023-07-05', '2023-07-27-752607509.png', 1, 1),
(8, 1340567942, 'Anisha', '', '', 1, 450, 'fdf123', '7160.00', '0.00', '2023-07-06', '2023-07-27-372260614.png', 1, 1),
(9, 1882444062, 'Anisha', '', '', 1, 900, 'fdf123', '7610.00', '0.00', '0000-00-00', '2023-07-27-1151193322.png', 1, 1),
(10, 1372108591, 'Anisha', '', '', 2, 450, 'fdf123', '8510.00', '0.00', '2023-07-19', '2023-07-27-1464472161.png', 1, 1),
(11, 1209044594, 'Anisha', '', '', 2, 300, 'fdf123', '0.00', '0.00', '2023-07-02', '2023-07-27-1955296224.png', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ag_service`
--

DROP TABLE IF EXISTS `ag_service`;
CREATE TABLE IF NOT EXISTS `ag_service` (
  `ag_service_id` int NOT NULL AUTO_INCREMENT,
  `ag_service_no` int NOT NULL,
  `ag_service_type` int NOT NULL COMMENT '1=in_service\r\n2=out_service',
  `ag_brand_no` int NOT NULL,
  `ag_vehicle_no` int NOT NULL,
  `ag_service_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_service_charge` decimal(10,2) NOT NULL,
  `ag_service_tax` int NOT NULL,
  PRIMARY KEY (`ag_service_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ag_service_parts`
--

DROP TABLE IF EXISTS `ag_service_parts`;
CREATE TABLE IF NOT EXISTS `ag_service_parts` (
  `ag_service_part_id` int NOT NULL AUTO_INCREMENT,
  `ag_service_no` int NOT NULL,
  `ag_part_no` int NOT NULL,
  `ag_service_part_status` int NOT NULL,
  `ag_service_type_status` int NOT NULL COMMENT '1=in_service\r\n2=out_service',
  PRIMARY KEY (`ag_service_part_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_service_parts`
--

INSERT INTO `ag_service_parts` (`ag_service_part_id`, `ag_service_no`, `ag_part_no`, `ag_service_part_status`, `ag_service_type_status`) VALUES
(8, 0, 510293075, 0, 1),
(7, 0, 1687722590, 0, 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=161 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_vehicle`
--

INSERT INTO `ag_vehicle` (`ag_vehicle_id`, `ag_vehicle_code`, `ag_vehicle_no`, `ag_brand_no`, `ag_vehicle_model_name`, `ag_vehicle_model_type`, `ag_vehicle_mg_year`, `ag_vehicle_cc`, `ag_vehicle_fuel`, `ag_vehicle_img`, `ag_vehicle_status`, `ag_vehicle_date`) VALUES
(160, 'AGV_08', 1922786709, 1508640779, 'GRAZIA', 'Scooter', 2023, '125', 'Petrol', '2023-07-18-459513136.png', 1, '2023-07-18'),
(29, 'AGV_01', 1700026017, 1508640779, 'Activa', 'Scooter', 2012, '169', 'Petrol', '2023-07-06-1290059301.png', 1, '2023-07-06'),
(30, 'AGV_02', 1171453103, 1508640779, 'Activa', 'Scooter', 2010, '150', 'Diesel', '2023-07-10-1826550690.png', 1, '2023-07-10'),
(159, 'AGV_07', 1693345631, 924116792, 'example', 'Scooter', 2012, '34', 'Petrol', '2023-07-13-65877793.png', 1, '2023-07-13'),
(158, 'AGV_01', 193825068, 630676143, 'C', 'Scooter', 2023, '160', 'Petrol', '2023-07-11-756992506.png', 1, '2023-07-11'),
(157, 'AGV_01', 1, 630676143, 'default', 'Scooter', 2013, '150', 'Petrol', '2023-07-11-941764334.png', 1, '2023-07-11'),
(156, 'AGV_01', 1786629320, 630676143, 'A', 'Scooter', 2012, '34', 'Petrol', '2023-07-11-163996481.png', 1, '2023-07-11'),
(155, 'AGV_06', 550893339, 1441387750, 'ex3', 'Scooter', 2023, '160', 'Petrol', '2023-07-11-1623506901.png', 1, '2023-07-11'),
(154, 'AGV_05', 1050315894, 1441387750, 'ex1', 'Scooter', 2012, '34', 'Petrol', '2023-07-11-177353981.png', 1, '2023-07-11'),
(153, 'AGV_04', 836174151, 1441387750, 'ex2', 'Scooter', 2013, '150', 'Petrol', '2023-07-11-1734376328.png', 1, '2023-07-11'),
(152, 'AGV_03', 1062940961, 1441387750, 'model3', 'Scooter', 2023, '160', 'Petrol', '2023-07-11-1626124827.png', 1, '2023-07-11'),
(151, 'AGV_03', 963161555, 1441387750, 'model2', 'Scooter', 2013, '150', 'Petrol', '2023-07-11-203198660.png', 1, '2023-07-11'),
(150, 'AGV_03', 692048720, 1441387750, 'model1', 'Scooter', 2012, '34', 'Petrol', '2023-07-11-2133146271.png', 1, '2023-07-11');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
