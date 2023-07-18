-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 18, 2023 at 03:23 AM
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
-- Table structure for table `ag_po_cart`
--

DROP TABLE IF EXISTS `ag_po_cart`;
CREATE TABLE IF NOT EXISTS `ag_po_cart` (
  `ag_po_cart_id` int NOT NULL AUTO_INCREMENT,
  `ag_retailer_no` int NOT NULL,
  `ag_brand_no` int NOT NULL,
  `ag_vehicle_no` int NOT NULL,
  `ag_po_invoice_no` int NOT NULL,
  `ag_part_no` int NOT NULL,
  `ag_part_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ag_brand_name` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_vehicle_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_po_qty` int NOT NULL,
  `ag_po_price` decimal(10,2) NOT NULL,
  `ag_po_discount` int NOT NULL,
  `ag_po_tax` int NOT NULL,
  `ag_po_date` date NOT NULL,
  `ag_po_status` int NOT NULL COMMENT '1=active\r\n2=inactive',
  PRIMARY KEY (`ag_po_cart_id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_po_cart`
--

INSERT INTO `ag_po_cart` (`ag_po_cart_id`, `ag_retailer_no`, `ag_brand_no`, `ag_vehicle_no`, `ag_po_invoice_no`, `ag_part_no`, `ag_part_name`, `ag_brand_name`, `ag_vehicle_name`, `ag_po_qty`, `ag_po_price`, `ag_po_discount`, `ag_po_tax`, `ag_po_date`, `ag_po_status`) VALUES
(37, 231924102, 1441387750, 963161555, 113934927, 705675026, 'Foot Rest', 'TVS', 'model2', 1, '100.00', 5, 12, '2023-07-17', 1),
(38, 231924102, 1441387750, 1062940961, 113934927, 705675026, 'Foot Rest', 'TVS', 'model3', 1, '200.00', 0, 0, '2023-07-17', 1),
(36, 231924102, 1508640779, 1700026017, 113934927, 1803760710, 'Long Rest', 'Honda', 'Activa', 1, '300.00', 0, 0, '2023-07-17', 1),
(39, 1815203693, 1508640779, 1700026017, 1995510163, 1803760710, 'Long Rest', 'Honda', 'Activa', 10, '50.00', 0, 0, '2023-07-17', 1),
(40, 1815203693, 1441387750, 963161555, 1995510163, 705675026, 'Foot Rest', 'TVS', 'model2', 20, '60.00', 0, 0, '2023-07-17', 1),
(41, 1815203693, 1441387750, 1062940961, 1995510163, 705675026, 'Foot Rest', 'TVS', 'model3', 30, '70.00', 0, 0, '2023-07-17', 1),
(42, 1815203693, 1441387750, 692048720, 1892855951, 705675026, 'Foot Rest', 'TVS', 'model1', 1, '10.00', 0, 0, '2023-07-17', 1),
(43, 1815203693, 1441387750, 1062940961, 1892855951, 705675026, 'Foot Rest', 'TVS', 'model3', 1, '30.00', 0, 0, '2023-07-17', 1),
(44, 1438042722, 1441387750, 963161555, 326932848, 705675026, 'Foot Rest', 'TVS', 'model2', 1, '10.00', 0, 0, '2023-07-17', 1),
(45, 1438042722, 1441387750, 692048720, 326932848, 705675026, 'Foot Rest', 'TVS', 'model1', 1, '20.00', 0, 0, '2023-07-17', 1),
(46, 1438042722, 1508640779, 1700026017, 326932848, 1803760710, 'Long Rest', 'Honda', 'Activa', 1, '30.00', 0, 0, '2023-07-17', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
