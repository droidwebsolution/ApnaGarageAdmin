-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 05, 2023 at 01:30 PM
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
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_brand`
--

INSERT INTO `ag_brand` (`ag_brand_id`, `ag_brand_no`, `ag_brand_code`, `ag_brand_name`, `ag_brand_category`, `ag_brand_img`, `ag_brand_status`) VALUES
(37, 1321118392, 'AG_4', 'Audi', 'Bike', '2023-07-29-1110519513.png', 1),
(36, 1591114283, 'AG_3', 'Toyota', 'Bike', '2023-07-29-1056881617.png', 1),
(35, 1920214437, 'AG_2', 'BMW', 'Bike', '2023-07-29-7099042.png', 1),
(34, 380274377, 'AG_01', 'Honda', 'Bike', '2023-07-29-1698173921.png', 1);

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
(3, 1942143500, 1111343021, 'vadodara'),
(7, 666511050, 1211211715, 'Haryana');

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
(2, 160416819, 'Azaz', '', '', 0),
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
(6, 'AGC_6', 1388397476, 'Rane Holding Ltd.'),
(7, 'AGC_7', 2050916898, 'Minda'),
(8, 'AGC_8', 451355281, 'Usha International ltd.');

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
) ENGINE=MyISAM AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_part`
--

INSERT INTO `ag_part` (`ag_part_id`, `ag_part_no`, `ag_part_code`, `ag_brand_no`, `ag_vehicle_no`, `ag_part_name`, `ag_part_company`, `ag_part_purchase_price`, `ag_part_selling_price`, `ag_part_qty`, `ag_part_alert_qty`, `ag_part_hsn`, `ag_part_cat`, `ag_part_img`, `ag_part_status`, `ag_part_date`) VALUES
(75, 1372845642, 'AGP_3', 0, 0, 'Foot rest', 2050916898, '150.00', '200.00', '70', '20', '140hsn', 'Oil', '2023-07-29-985043114.png', 1, '2023-07-29'),
(74, 319273130, 'AGP_2', 0, 0, 'Break', 1777862565, '200.00', '300.00', '51', '15', 'hsn45', 'Spare', '2023-07-29-1766202291.png', 1, '2023-07-29'),
(73, 1263731381, 'AGP_01', 0, 0, 'Long Rest', 1777862565, '250.00', '0.00', '10', '2', '125hsn', 'Oil', '2023-07-29-209490418.png', 1, '2023-07-29');

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_partname`
--

INSERT INTO `ag_partname` (`ag_partname_id`, `ag_partname_no`, `ag_partname_name`) VALUES
(1, 554478382, 'Foot rest'),
(2, 502103883, 'Long Rest'),
(3, 1888392439, 'Break'),
(4, 672617900, 'example'),
(8, 1152952945, 'cylencer');

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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_part_hold_stock`
--

INSERT INTO `ag_part_hold_stock` (`ag_hold_id`, `ag_part_no`, `ag_old_pp`, `ag_old_sp`, `ag_new_pp`, `ag_new_sp`, `ag_hold_qty`, `ag_hold_status`) VALUES
(1, 1803760710, '100.00', '450.00', '200.00', '450.00', '25', 2),
(2, 659222676, '20.00', '80.00', '40.00', '100.00', '7', 2),
(3, 659222676, '40.00', '100.00', '60.00', '200.00', '50', 2),
(4, 1181289683, '0.00', '0.00', '20.00', '50.00', '1', 2),
(5, 195247848, '0.00', '0.00', '90.00', '150.00', '2', 2),
(6, 659222676, '40.00', '100.00', '50.00', '100.00', '1', 2),
(7, 2088100901, '0.00', '0.00', '100.00', '150.00', '15', 2),
(10, 2066138375, '100.00', '450.00', '200.00', '450.00', '25', 2),
(11, 1372845642, '0.00', '0.00', '150.00', '200.00', '1', 2),
(12, 319273130, '0.00', '0.00', '200.00', '300.00', '1', 2),
(13, 319273130, '0.00', '0.00', '300.00', '450.00', '1', 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=153 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(147, 71, 1508640779, 1922786709, '1777862565', 'Break', 1),
(148, 72, 630676143, 193825068, '1777862565', 'aaaaa', 1),
(149, 73, 1591114283, 1736351801, '1777862565', 'Long Rest', 1),
(150, 74, 1321118392, 842597676, '1777862565', 'Break', 1),
(151, 75, 1920214437, 1620643035, '2050916898', 'Foot rest', 2),
(152, 75, 1591114283, 48196536, '2050916898', 'Foot rest', 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=187 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_po_cart`
--

INSERT INTO `ag_po_cart` (`ag_po_cart_id`, `ag_retailer_no`, `ag_po_invoice_no`, `ag_part_no`, `ag_part_name`, `ag_mg_company_name`, `ag_po_qty`, `ag_po_price`, `ag_po_sale_price`, `ag_po_discount`, `ag_po_tax`, `ag_po_date`, `ag_po_status`) VALUES
(186, 0, 263860743, 1372845642, 'Foot rest', 'Minda', 1, '350.00', '200.00', 0, 0, '2023-07-31', 0),
(185, 0, 263860743, 1263731381, 'Long Rest', 'Minda', 1, '0.00', '0.00', 0, 0, '2023-07-31', 0),
(184, 1800173552, 75091944, 1372845642, 'Foot rest', 'Minda', 3, '150.00', '200.00', 0, 0, '2023-07-31', 1),
(182, 1800173552, 1577495123, 319273130, 'Break', 'Minda', 1, '200.00', '300.00', 5, 10, '2023-07-31', 1),
(180, 231924102, 1599808864, 1372845642, 'Foot rest', 'Minda', 1, '150.00', '200.00', 0, 0, '2023-07-29', 1),
(183, 1800173552, 180369404, 319273130, 'Break', 'Minda', 1, '300.00', '450.00', 0, 0, '2023-07-31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ag_po_cart_repo`
--

DROP TABLE IF EXISTS `ag_po_cart_repo`;
CREATE TABLE IF NOT EXISTS `ag_po_cart_repo` (
  `ag_po_cart_repo_id` int NOT NULL AUTO_INCREMENT,
  `ag_po_invoice_no` int NOT NULL,
  `ag_retailer_no` int NOT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_po_cart_repo`
--

INSERT INTO `ag_po_cart_repo` (`ag_po_cart_repo_id`, `ag_po_invoice_no`, `ag_retailer_no`, `ag_retailer_name`, `ag_retailer_company_phone`, `ag_retailer_company_email`, `ag_retailer_company_gst`, `ag_retailer_company_tin`, `ag_retailer_state`, `ag_retailer_city`, `ag_retailer_area`, `ag_retailer_house_no`, `ag_retailer_pincode`, `ag_po_payment_type`, `ag_po_receipt_no`, `ag_po_amount_paid`, `ag_po_pending_amt`, `ag_po_cust_pay`, `ag_po_invoice_date`, `ag_po_invoice_due_date`, `ag_po_receipt_img`, `ag_no_of_items`, `ag_po_cart_repo_status`) VALUES
(42, 75091944, 1800173552, 'ecom', '7698903619', 'ecom@gmail.com', '12312', '12312', 'Gujarat', 'Bharuch', 'hfg', 'ac14555', '392200', 1, 'fdf123', '450', '0.00', '250.00', '2023-06-25', '2023-08-02', '2023-07-31-1134105888.png', 1, 1),
(41, 180369404, 1800173552, 'ecom', '7698903619', 'ecom@gmail.com', '12312', '12312', 'Gujarat', 'Bharuch', 'hfg', 'ac14555', '392200', 1, 'fdf123', '300', '0.00', '300.00', '2023-07-18', '2023-08-05', '2023-07-31-800789840.png', 1, 1),
(39, 1599808864, 231924102, 'Shiv Automobiles', '7698903619', 'Shivautomobile@gmail.com', 'GT12456', '1235543', 'Gujarat', 'Bharuch', '', 'ac14555', '392200', 1, 'fdf123', '150', '0.00', '150.00', '2023-07-21', '2023-08-01', '2023-07-29-1826100119.png', 1, 1),
(40, 1577495123, 1800173552, 'ecom', '7698903619', 'ecom@gmail.com', '12312', '12312', 'Gujarat', 'Bharuch', 'hfg', 'ac14555', '392200', 1, 'fdf123', '209', '0.00', '209.00', '2023-06-26', '2023-08-03', '2023-07-31-971212005.png', 1, 1);

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
(2, 231924102, 'RT_2', '0.00', 'Shiv Automobiles', 'Pravin Patelsd', 7698903619, 7698903699, 'Shivautomobile@gmail.com', 'www.shivautomob.com', 'GT12456', '1235543', 'Deepen Pandeye', 2147483647, 1111343021, 2064270509, '', 'ac14555', 392200, '2023-03-29', 0),
(3, 1815203693, 'RT_3', '25.00', 'ABC', 'Maynak', 1125421212, 2147483647, 'abc@gmail.com', 'www.abc.com', 'GT12456', '123', 'Abhishek Patel', 2147483647, 1111343021, 1026896286, '', 'ac145', 392020, '2022-11-30', 0),
(5, 2035485059, 'RT_4', '0.00', 'xyz', 'Pravin Patel', 1125421212, 2147483647, 'xyz@gmail.com', 'www.xyz.com', 'GT12456', '123', 'Abhishek Patel', 2147483647, 1211211715, 2064270509, 'qaqaqa', 'ac145', 392020, '2023-07-07', 0),
(8, 1800173552, 'RT_7', '0.00', 'ecom', 'Pravin Patelsd', 7698903619, 7698903699, 'ecom@gmail.com', 'www.ecom.com', '12312', '12312', 'Deepen Pandeye', 2134124234, 1111343021, 0, 'hfg', 'ac14555', 392200, '2023-07-23', 0),
(9, 54144432, 'RT_8', '0.00', 'ecomITSolution', 'Pravin Patelsd', 7698903619, 7698903699, 'ecom@gmail.com', 'www.ecom.com', '12312', '1235543', 'Deepen Pandeye', 2134124234, 1211211715, 0, 'hfg', 'ac14555', 392200, '2023-07-26', 0),
(10, 90690151, 'RT_9', '0.00', 'moonsquare', 'Pravin Patelsd', 7698903619, 7698903699, 'ecom@gmail.com', 'www.ecom.com', '12312', '1235543', 'Deepen Pandeye', 2134124234, 1111343021, 0, 'hfg', 'ac14555', 392200, '2023-07-24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ag_retailer_credit`
--

DROP TABLE IF EXISTS `ag_retailer_credit`;
CREATE TABLE IF NOT EXISTS `ag_retailer_credit` (
  `ag_rc_id` int NOT NULL AUTO_INCREMENT,
  `ag_rc_no` int NOT NULL,
  `ag_retailer_no` int NOT NULL,
  `ag_pay_amt` decimal(10,2) NOT NULL,
  `ag_pay_date` date NOT NULL,
  `ag_pay_type` int NOT NULL COMMENT '1-cash\r\n2-online\r\n3-cheque',
  PRIMARY KEY (`ag_rc_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_retailer_credit`
--

INSERT INTO `ag_retailer_credit` (`ag_rc_id`, `ag_rc_no`, `ag_retailer_no`, `ag_pay_amt`, `ag_pay_date`, `ag_pay_type`) VALUES
(1, 1929678043, 1815203693, '10.00', '2023-08-10', 1),
(2, 675486865, 1815203693, '5.00', '2023-08-05', 2);

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
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_sells_order_cart`
--

INSERT INTO `ag_sells_order_cart` (`ag_sells_order_id`, `ag_customer_no`, `ag_sells_invoice_no`, `ag_part_no`, `ag_part_name`, `ag_mg_company_name`, `ag_sells_qty`, `ag_sells_price`, `ag_sells_purchase_price`, `ag_sells_discount`, `ag_sells_tax`, `ag_sells_date`, `ag_sells_status`) VALUES
(37, 160416819, 1034002268, 1372845642, 'Foot rest', '2050916898', 1, '200.00', '150.00', 0, 0, '2023-08-03', 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_sells_order_cart_repo`
--

INSERT INTO `ag_sells_order_cart_repo` (`ag_sells_order_cart_repo_id`, `ag_sells_invoice_no`, `ag_customer_name`, `ag_customer_phone`, `ag_customer_address`, `ag_sells_payment_type`, `ag_sells_amount_paid`, `ag_so_receipt_no`, `ag_sells_pending_amt`, `ag_sells_cust_pay`, `ag_so_invoice_date`, `ag_so_receipt_img`, `ag_no_of_items`, `ag_sells_order_cart_repo_status`) VALUES
(12, 1034002268, 'Azaz', '', '', 1, 200, 'fdf123', '3300.00', '0.00', '2023-08-03', '2023-08-03-1924039391.png', 1, 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=166 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_vehicle`
--

INSERT INTO `ag_vehicle` (`ag_vehicle_id`, `ag_vehicle_code`, `ag_vehicle_no`, `ag_brand_no`, `ag_vehicle_model_name`, `ag_vehicle_model_type`, `ag_vehicle_mg_year`, `ag_vehicle_cc`, `ag_vehicle_fuel`, `ag_vehicle_img`, `ag_vehicle_status`, `ag_vehicle_date`) VALUES
(165, 'AGV_05', 48196536, 1591114283, 'Fortuner', 'Motorcycle', 2011, '125cc', 'Diesel', '2023-07-29-2028305295.png', 1, '2023-07-29'),
(164, 'AGV_04', 1620643035, 1920214437, 'X1', 'Motorcycle', 2013, '26cc', 'Diesel', '2023-07-29-1919017233.png', 1, '2023-07-29'),
(163, 'AGV_03', 842597676, 1321118392, 'A6', 'Motorcycle', 2012, '124cc', 'Diesel', '2023-07-29-882269993.png', 1, '2023-07-29'),
(162, 'AGV_02', 1374616566, 1591114283, 'Model1', 'Motorcycle', 2011, '125cc', 'Diesel', '2023-07-29-1911975737.png', 1, '2023-07-29'),
(161, 'AGV_01', 1736351801, 1591114283, 'GRAZIA', 'Scooter', 2015, '125', 'Petrol', '2023-07-29-1656617452.png', 1, '2023-07-29');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
