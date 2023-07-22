-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 22, 2023 at 09:56 AM
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
  `ag_part_purchase_price` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_part_selling_price` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ag_part_qty` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_part_alert_qty` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ag_part_hsn` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ag_part_cat` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_part_img` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'l=30',
  `ag_part_status` int NOT NULL COMMENT '1=active\r\n2=inactive',
  `ag_part_date` date NOT NULL,
  PRIMARY KEY (`ag_part_id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_part`
--

INSERT INTO `ag_part` (`ag_part_id`, `ag_part_no`, `ag_part_code`, `ag_brand_no`, `ag_vehicle_no`, `ag_part_name`, `ag_part_company`, `ag_part_purchase_price`, `ag_part_selling_price`, `ag_part_qty`, `ag_part_alert_qty`, `ag_part_hsn`, `ag_part_cat`, `ag_part_img`, `ag_part_status`, `ag_part_date`) VALUES
(58, 659222676, 'AGP_6', 0, 0, 'Foot Rest', 1777862565, '', '320', '11', '', 'fgdf', 'Oil', '2023-07-18-1188591637.png', 1, '2023-07-18'),
(57, 2066138375, 'AGP_5', 0, 0, 'fOOT rest', 1777862565, '', '450', '12', '', 'dsadsad', 'Spare', '2023-07-18-1882673074.png', 1, '2023-07-18'),
(55, 870311119, 'AGP_3', 0, 0, 'abc', 1777862565, '', '', '10', '', '145sd', 'Oil', '2023-07-17-1518832456.png', 1, '2023-07-17'),
(56, 908887308, 'AGP_4', 0, 0, 'Foot Rest', 1777862565, '', '350', '2', '', '145', 'Oil', '2023-07-18-972191209.png', 1, '2023-07-17'),
(54, 1803760710, 'AGP_2', 0, 0, 'Long Rest', 1777862565, '', '', '0', '', 'tytyty', 'Oil', '2023-07-16-266967418.png', 1, '2023-07-16'),
(53, 705675026, 'AGP_01', 0, 0, 'Foot Rest', 1777862565, '', '', '0', '', 'dsadsad', 'Oil', '2023-07-16-219744753.png', 1, '2023-07-16'),
(59, 1486878628, 'AGP_7', 0, 0, 'Foot Rest', 1777862565, '', '400', '0', '60', 'tytyty', 'Oil', '2023-07-18-639875899.png', 1, '2023-07-18'),
(64, 739119981, 'AGP_12', 0, 0, 'Xyz', 1777862565, '', '0', '0', '0', '145', 'Oil', '2023-07-19-1356035622.png', 1, '2023-07-19'),
(63, 1469610007, 'AGP_11', 0, 0, 'ewrwer', 1777862565, '', '500', '2', '50', 'dsadsad', 'Oil', '2023-07-18-1188066601.png', 1, '2023-07-18'),
(62, 1325361987, 'AGP_10', 0, 0, 'ewrwer', 1777862565, '', '500', '0', '50', 'dsadsad', 'Oil', '2023-07-18-751735388.png', 1, '2023-07-18'),
(65, 1873757089, 'AGP_13', 0, 0, '1888392439', 1777862565, '', '0', '0', '0', '145', 'Oil', '2023-07-19-433974970.png', 1, '2023-07-19'),
(66, 1879130021, 'AGP_14', 0, 0, '1888392439', 1777862565, '0', '0', '0', '0', 'tytyty200', 'Oil', '2023-07-19-1449045762.png', 1, '2023-07-19');

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
) ENGINE=MyISAM AUTO_INCREMENT=142 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(141, 66, 1508640779, 1922786709, '1777862565', '1888392439', 1);

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
  `ag_po_discount` int NOT NULL,
  `ag_po_tax` int NOT NULL,
  `ag_po_date` date NOT NULL,
  `ag_po_status` int NOT NULL COMMENT '1=active\r\n2=inactive',
  PRIMARY KEY (`ag_po_cart_id`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_po_cart`
--

INSERT INTO `ag_po_cart` (`ag_po_cart_id`, `ag_retailer_no`, `ag_po_invoice_no`, `ag_part_no`, `ag_part_name`, `ag_mg_company_name`, `ag_po_qty`, `ag_po_price`, `ag_po_discount`, `ag_po_tax`, `ag_po_date`, `ag_po_status`) VALUES
(87, 231924102, 32836023, 870311119, 'abc', 'Minda', 1, '100.00', 2, 10, '2023-07-21', 1),
(86, 231924102, 32836023, 2066138375, 'fOOT rest', 'Minda', 1, '200.00', 0, 12, '2023-07-21', 1),
(85, 231924102, 32836023, 659222676, 'Foot Rest', 'Minda', 1, '300.00', 1, 0, '2023-07-21', 1),
(84, 231924102, 780873569, 870311119, 'abc', 'Minda', 10, '100.00', 5, 15, '2023-07-20', 1),
(83, 231924102, 780873569, 2066138375, 'fOOT rest', 'Minda', 12, '200.00', 6, 12, '2023-07-20', 1),
(82, 231924102, 780873569, 659222676, 'Foot Rest', 'Minda', 11, '300.00', 7, 14, '2023-07-20', 1),
(81, 231924102, 386649930, 705675026, 'Foot Rest', 'Minda', 1, '200.00', 0, 0, '2023-07-20', 1),
(80, 231924102, 386649930, 870311119, 'abc', 'Minda', 2, '500.00', 0, 0, '2023-07-20', 1),
(79, 231924102, 977403182, 2066138375, 'fOOT rest', 'Minda', 2, '10.00', 0, 0, '2023-07-20', 1),
(78, 231924102, 977403182, 659222676, 'Foot Rest', 'Minda', 1, '100.00', 0, 0, '2023-07-20', 1),
(88, 2035485059, 501010795, 659222676, 'Foot Rest', 'Minda', 1, '100.00', 5, 10, '2023-07-21', 1),
(89, 2035485059, 501010795, 2066138375, 'fOOT rest', 'Minda', 1, '200.00', 2, 5, '2023-07-21', 1),
(90, 0, 37230352, 659222676, 'Foot Rest', 'Minda', 1, '0.00', 0, 0, '2023-07-21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ag_po_cart_repo`
--

DROP TABLE IF EXISTS `ag_po_cart_repo`;
CREATE TABLE IF NOT EXISTS `ag_po_cart_repo` (
  `ag_po_cart_repo_id` int NOT NULL AUTO_INCREMENT,
  `ag_po_invoice_no` int NOT NULL,
  `ag_retailer_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_po_payment_mode` int NOT NULL COMMENT '1-full payment\r\n2-partly\r\n3-pending',
  `ag_po_payment_type` int NOT NULL COMMENT '1-cash\r\n2-online\r\n3-cheque',
  `ag_po_receipt_no` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_po_amount_paid` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_po_invoice_date` date NOT NULL,
  `ag_po_invoice_due_date` date NOT NULL,
  `ag_po_receipt_img` text COLLATE utf8mb4_general_ci NOT NULL,
  `ag_no_of_items` int NOT NULL,
  `ag_po_cart_repo_status` int NOT NULL COMMENT '1-Active\r\n2-In Active',
  PRIMARY KEY (`ag_po_cart_repo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_po_cart_repo`
--

INSERT INTO `ag_po_cart_repo` (`ag_po_cart_repo_id`, `ag_po_invoice_no`, `ag_retailer_name`, `ag_po_payment_mode`, `ag_po_payment_type`, `ag_po_receipt_no`, `ag_po_amount_paid`, `ag_po_invoice_date`, `ag_po_invoice_due_date`, `ag_po_receipt_img`, `ag_no_of_items`, `ag_po_cart_repo_status`) VALUES
(4, 386649930, 'Shiv Automobiles', 2, 2, 'sdf231', '12000', '2023-07-20', '2023-07-22', '2023-07-20-1356397151.png', 2, 1),
(3, 977403182, 'Shiv Automobiles', 2, 1, 'sdf231', '12000', '2023-07-20', '2023-07-21', '2023-07-20-1065072329.png', 2, 1),
(5, 780873569, 'Shiv Automobiles', 2, 2, 'sdf231', '12000', '2023-07-21', '2023-07-22', '2023-07-21-1041793634.png', 3, 1),
(6, 32836023, 'Shiv Automobiles', 2, 1, 'sdf231', '628', '2023-07-22', '2023-07-22', '2023-07-21-727223268.png', 3, 1),
(7, 501010795, 'xyz', 2, 2, 'sdf231', '310', '2023-07-22', '2023-07-22', '2023-07-21-291432637.png', 2, 1);

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
