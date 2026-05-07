-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2026 at 03:50 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bhw_monthly`
--

-- --------------------------------------------------------

--
-- Table structure for table `childcare`
--

CREATE TABLE `childcare` (
  `CC_1_1` int(100) NOT NULL,
  `CC_1_2` int(100) NOT NULL,
  `CC_1_3` int(100) NOT NULL,
  `CC_1_4` int(100) NOT NULL,
  `CC_1_5` int(100) NOT NULL,
  `CC_1_6` int(100) NOT NULL,
  `CC_1_7` int(100) NOT NULL,
  `CC_1_8` int(100) NOT NULL,
  `CC_1_9` int(100) NOT NULL,
  `CC_1_10` int(100) NOT NULL,
  `CC_1_11` int(100) NOT NULL,
  `CC_1_12` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `DEL_1_1` int(100) NOT NULL,
  `DEL_1_2` int(100) NOT NULL,
  `DEL_1_3` int(100) NOT NULL,
  `DEL_1_4` int(100) NOT NULL,
  `DEL_1_5` int(100) NOT NULL,
  `DEL_1_6` int(100) NOT NULL,
  `DEL_1_7` int(100) NOT NULL,
  `DEL_1_8` int(100) NOT NULL,
  `DEL_1_9` int(100) NOT NULL,
  `DEL_1_10` int(100) NOT NULL,
  `DEL_1_11` int(100) NOT NULL,
  `DEL_1_12` int(100) NOT NULL,
  `DEL_2_1` int(100) NOT NULL,
  `DEL_2_2` int(100) NOT NULL,
  `DEL_2_3` int(100) NOT NULL,
  `DEL_2_4` int(100) NOT NULL,
  `DEL_2_5` int(100) NOT NULL,
  `DEL_2_6` int(100) NOT NULL,
  `DEL_2_7` int(100) NOT NULL,
  `DEL_2_8` int(100) NOT NULL,
  `DEL_2_9` int(100) NOT NULL,
  `DEL_2_10` int(100) NOT NULL,
  `DEL_2_11` int(100) NOT NULL,
  `DEL_2_12` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `family`
--

CREATE TABLE `family` (
  `FP_1_1` int(100) NOT NULL,
  `FP_1_2` int(100) NOT NULL,
  `FP_1_3` int(100) NOT NULL,
  `FP_1_4` int(100) NOT NULL,
  `FP_1_5` int(100) NOT NULL,
  `FP_1_6` int(100) NOT NULL,
  `FP_1_7` int(100) NOT NULL,
  `FP_1_8` int(100) NOT NULL,
  `FP_1_9` int(100) NOT NULL,
  `FP_1_10` int(100) NOT NULL,
  `FP_1_11` int(100) NOT NULL,
  `FP_1_12` int(100) NOT NULL,
  `FP_2_1` int(100) NOT NULL,
  `FP_2_2` int(100) NOT NULL,
  `FP_2_3` int(100) NOT NULL,
  `FP_2_4` int(100) NOT NULL,
  `FP_2_5` int(100) NOT NULL,
  `FP_2_6` int(100) NOT NULL,
  `FP_2_7` int(100) NOT NULL,
  `FP_2_8` int(100) NOT NULL,
  `FP_2_9` int(100) NOT NULL,
  `FP_2_10` int(100) NOT NULL,
  `FP_2_11` int(100) NOT NULL,
  `FP_2_12` int(100) NOT NULL,
  `FP_3_1` int(100) NOT NULL,
  `FP_3_2` int(100) NOT NULL,
  `FP_3_3` int(100) NOT NULL,
  `FP_3_4` int(100) NOT NULL,
  `FP_3_5` int(100) NOT NULL,
  `FP_3_6` int(100) NOT NULL,
  `FP_3_7` int(100) NOT NULL,
  `FP_3_8` int(100) NOT NULL,
  `FP_3_9` int(100) NOT NULL,
  `FP_3_10` int(100) NOT NULL,
  `FP_3_11` int(100) NOT NULL,
  `FP_3_12` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fp_methods`
--

CREATE TABLE `fp_methods` (
  `method_name` varchar(100) NOT NULL,
  `method_type` enum('Modern','Natural') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `maternalcare`
--

CREATE TABLE `maternalcare` (
  `MC_1_1` int(100) NOT NULL,
  `MC_1_2` int(100) NOT NULL,
  `MC_1_3` int(100) NOT NULL,
  `MC_1_4` int(100) NOT NULL,
  `MC_1_5` int(100) NOT NULL,
  `MC_1_6` int(100) NOT NULL,
  `MC_1_7` int(100) NOT NULL,
  `MC_1_8` int(100) NOT NULL,
  `MC_1_9` int(100) NOT NULL,
  `MC_1_10` int(100) NOT NULL,
  `MC_1_11` int(100) NOT NULL,
  `MC_1_12` int(100) NOT NULL,
  `MC_2_1` int(100) NOT NULL,
  `MC_2_2` int(100) NOT NULL,
  `MC_2_3` int(100) NOT NULL,
  `MC_2_4` int(100) NOT NULL,
  `MC_2_5` int(100) NOT NULL,
  `MC_2_6` int(100) NOT NULL,
  `MC_2_7` int(100) NOT NULL,
  `MC_2_8` int(100) NOT NULL,
  `MC_2_9` int(100) NOT NULL,
  `MC_2_10` int(100) NOT NULL,
  `MC_2_11` int(100) NOT NULL,
  `MC_2_12` int(100) NOT NULL,
  `MC_3_1` int(100) NOT NULL,
  `MC_3_2` int(100) NOT NULL,
  `MC_3_3` int(100) NOT NULL,
  `MC_3_4` int(100) NOT NULL,
  `MC_3_5` int(100) NOT NULL,
  `MC_3_6` int(100) NOT NULL,
  `MC_3_7` int(100) NOT NULL,
  `MC_3_8` int(100) NOT NULL,
  `MC_3_9` int(100) NOT NULL,
  `MC_3_10` int(100) NOT NULL,
  `MC_3_11` int(100) NOT NULL,
  `MC_3_12` int(100) NOT NULL,
  `MC_4_1` int(100) NOT NULL,
  `MC_4_2` int(100) NOT NULL,
  `MC_4_3` int(100) NOT NULL,
  `MC_4_4` int(100) NOT NULL,
  `MC_4_5` int(100) NOT NULL,
  `MC_4_6` int(100) NOT NULL,
  `MC_4_7` int(100) NOT NULL,
  `MC_4_8` int(100) NOT NULL,
  `MC_4_9` int(100) NOT NULL,
  `MC_4_10` int(100) NOT NULL,
  `MC_4_11` int(100) NOT NULL,
  `MC_4_12` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nip`
--

CREATE TABLE `nip` (
  `NIP_1_1` int(100) NOT NULL,
  `NIP_1_2` int(100) NOT NULL,
  `NIP_1_3` int(100) NOT NULL,
  `NIP_1_4` int(100) NOT NULL,
  `NIP_1_5` int(100) NOT NULL,
  `NIP_1_6` int(100) NOT NULL,
  `NIP_1_7` int(100) NOT NULL,
  `NIP_1_8` int(100) NOT NULL,
  `NIP_1_9` int(100) NOT NULL,
  `NIP_1_10` int(100) NOT NULL,
  `NIP_1_11` int(100) NOT NULL,
  `NIP_1_12` int(100) NOT NULL,
  `NIP_2_1` int(100) NOT NULL,
  `NIP_2_2` int(100) NOT NULL,
  `NIP_2_3` int(100) NOT NULL,
  `NIP_2_4` int(100) NOT NULL,
  `NIP_2_5` int(100) NOT NULL,
  `NIP_2_6` int(100) NOT NULL,
  `NIP_2_7` int(100) NOT NULL,
  `NIP_2_8` int(100) NOT NULL,
  `NIP_2_9` int(100) NOT NULL,
  `NIP_2_10` int(100) NOT NULL,
  `NIP_2_11` int(100) NOT NULL,
  `NIP_2_12` int(100) NOT NULL,
  `NIP_3_1` int(100) NOT NULL,
  `NIP_3_2` int(100) NOT NULL,
  `NIP_3_3` int(100) NOT NULL,
  `NIP_3_4` int(100) NOT NULL,
  `NIP_3_5` int(100) NOT NULL,
  `NIP_3_6` int(100) NOT NULL,
  `NIP_3_7` int(100) NOT NULL,
  `NIP_3_8` int(100) NOT NULL,
  `NIP_3_9` int(100) NOT NULL,
  `NIP_3_10` int(100) NOT NULL,
  `NIP_3_11` int(100) NOT NULL,
  `NIP_3_12` int(100) NOT NULL,
  `NIP_4_1` int(100) NOT NULL,
  `NIP_4_2` int(100) NOT NULL,
  `NIP_4_3` int(100) NOT NULL,
  `NIP_4_4` int(100) NOT NULL,
  `NIP_4_5` int(100) NOT NULL,
  `NIP_4_6` int(100) NOT NULL,
  `NIP_4_7` int(100) NOT NULL,
  `NIP_4_8` int(100) NOT NULL,
  `NIP_4_9` int(100) NOT NULL,
  `NIP_4_10` int(100) NOT NULL,
  `NIP_4_11` int(100) NOT NULL,
  `NIP_4_12` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nutritions`
--

CREATE TABLE `nutritions` (
  `NUT_1_1` int(100) NOT NULL,
  `NUT_1_2` int(100) NOT NULL,
  `NUT_1_3` int(100) NOT NULL,
  `NUT_1_4` int(100) NOT NULL,
  `NUT_1_5` int(100) NOT NULL,
  `NUT_1_6` int(100) NOT NULL,
  `NUT_1_7` int(100) NOT NULL,
  `NUT_1_8` int(100) NOT NULL,
  `NUT_1_9` int(100) NOT NULL,
  `NUT_1_10` int(100) NOT NULL,
  `NUT_1_11` int(100) NOT NULL,
  `NUT_1_12` int(100) NOT NULL,
  `NUT_2_1` int(100) NOT NULL,
  `NUT_2_2` int(100) NOT NULL,
  `NUT_2_3` int(100) NOT NULL,
  `NUT_2_4` int(100) NOT NULL,
  `NUT_2_5` int(100) NOT NULL,
  `NUT_2_6` int(100) NOT NULL,
  `NUT_2_7` int(100) NOT NULL,
  `NUT_2_8` int(100) NOT NULL,
  `NUT_2_9` int(100) NOT NULL,
  `NUT_2_10` int(100) NOT NULL,
  `NUT_2_11` int(100) NOT NULL,
  `NUT_2_12` int(100) NOT NULL,
  `NUT_3_1` int(100) NOT NULL,
  `NUT_3_2` int(100) NOT NULL,
  `NUT_3_3` int(100) NOT NULL,
  `NUT_3_4` int(100) NOT NULL,
  `NUT_3_5` int(100) NOT NULL,
  `NUT_3_6` int(100) NOT NULL,
  `NUT_3_7` int(100) NOT NULL,
  `NUT_3_8` int(100) NOT NULL,
  `NUT_3_9` int(100) NOT NULL,
  `NUT_3_10` int(100) NOT NULL,
  `NUT_3_11` int(100) NOT NULL,
  `NUT_3_12` int(100) NOT NULL,
  `NUT_4_1` int(100) NOT NULL,
  `NUT_4_2` int(100) NOT NULL,
  `NUT_4_3` int(100) NOT NULL,
  `NUT_4_4` int(100) NOT NULL,
  `NUT_4_5` int(100) NOT NULL,
  `NUT_4_6` int(100) NOT NULL,
  `NUT_4_7` int(100) NOT NULL,
  `NUT_4_8` int(100) NOT NULL,
  `NIP_4_9` int(100) NOT NULL,
  `NUT_4_10` int(100) NOT NULL,
  `NUT_4_11` int(100) NOT NULL,
  `NUT_4_12` int(100) NOT NULL,
  `NUT_5_1` int(100) NOT NULL,
  `NUT_5_2` int(100) NOT NULL,
  `NUT_5_3` int(100) NOT NULL,
  `NUT_5_4` int(100) NOT NULL,
  `NUT_5_5` int(100) NOT NULL,
  `NUT_5_6` int(100) NOT NULL,
  `NUT_5_7` int(100) NOT NULL,
  `NUT_5_8` int(100) NOT NULL,
  `NUT_5_9` int(100) NOT NULL,
  `NUT_5_10` int(100) NOT NULL,
  `NUT_5_11` int(100) NOT NULL,
  `NUT_5_12` int(100) NOT NULL,
  `NUT_6_1` int(100) NOT NULL,
  `NUT_6_2` int(100) NOT NULL,
  `NUT_6_3` int(100) NOT NULL,
  `NUT_6_4` int(100) NOT NULL,
  `NUT_6_5` int(100) NOT NULL,
  `NUT_6_6` int(100) NOT NULL,
  `NUT_6_7` int(100) NOT NULL,
  `NUT_6_8` int(100) NOT NULL,
  `NUT_6_9` int(100) NOT NULL,
  `NUT_6_10` int(100) NOT NULL,
  `NUT_6_11` int(100) NOT NULL,
  `NUT_6_12` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `postpartum`
--

CREATE TABLE `postpartum` (
  `PP_1_1` int(100) NOT NULL,
  `PP_1_2` int(100) NOT NULL,
  `PP_1_3` int(100) NOT NULL,
  `PP_1_4` int(100) NOT NULL,
  `PP_1_5` int(100) NOT NULL,
  `PP_1_6` int(100) NOT NULL,
  `PP_1_7` int(100) NOT NULL,
  `PP_1_8` int(100) NOT NULL,
  `PP_1_9` int(100) NOT NULL,
  `PP_1_10` int(100) NOT NULL,
  `PP_1_11` int(100) NOT NULL,
  `PP_1_12` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report_info`
--

CREATE TABLE `report_info` (
  `report_year` year(4) NOT NULL,
  `bhw_name` varchar(255) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `area_office` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
