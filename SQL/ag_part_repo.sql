-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 14, 2023 at 11:51 AM
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
-- Table structure for table `ag_part_repo`
--

DROP TABLE IF EXISTS `ag_part_repo`;
CREATE TABLE IF NOT EXISTS `ag_part_repo` (
  `ag_part_repo_id` int NOT NULL AUTO_INCREMENT,
  `ag_part_id` int NOT NULL,
  `ag_brand_no` int NOT NULL,
  `ag_vehicle_no` int NOT NULL,
  `ag_part_company` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `ag_part_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ag_part_repo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ag_part_repo`
--

INSERT INTO `ag_part_repo` (`ag_part_repo_id`, `ag_part_id`, `ag_brand_no`, `ag_vehicle_no`, `ag_part_company`, `ag_part_name`) VALUES
(28, 0, 630676143, 193825068, 'eee', 'Xyz'),
(29, 0, 1441387750, 550893339, 'eee', 'Foot Rest'),
(30, 0, 1508640779, 1700026017, 'eee', 'Foot Rest'),
(31, 0, 1441387750, 550893339, 'eee', 'Foot Rest'),
(32, 33, 1441387750, 193825068, 'eee', ''),
(33, 33, 1441387750, 550893339, 'eee', ''),
(34, 33, 630676143, 193825068, 'eee', ''),
(35, 33, 630676143, 550893339, 'eee', ''),
(36, 34, 385965455, 1693345631, 'eee', 'Foot Rest'),
(37, 34, 924116792, 1693345631, 'eee', 'Foot Rest');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
