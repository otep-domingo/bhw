-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2026 at 02:25 PM
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
-- Database: `bhw`
--

-- --------------------------------------------------------

--
-- Table structure for table `accomplishment_data`
--

CREATE TABLE `accomplishment_data` (
  `id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `row_key` varchar(60) NOT NULL,
  `jan` smallint(6) DEFAULT 0,
  `feb` smallint(6) DEFAULT 0,
  `mar` smallint(6) DEFAULT 0,
  `apr` smallint(6) DEFAULT 0,
  `may` smallint(6) DEFAULT 0,
  `jun` smallint(6) DEFAULT 0,
  `jul` smallint(6) DEFAULT 0,
  `aug` smallint(6) DEFAULT 0,
  `sep` smallint(6) DEFAULT 0,
  `oct` smallint(6) DEFAULT 0,
  `nov` smallint(6) DEFAULT 0,
  `dec` smallint(6) DEFAULT 0,
  `row_total` smallint(6) GENERATED ALWAYS AS (`jan` + `feb` + `mar` + `apr` + `may` + `jun` + `jul` + `aug` + `sep` + `oct` + `nov` + `dec`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `a_demand`
--

CREATE TABLE `a_demand` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` varchar(100) DEFAULT NULL COMMENT 'Parent form / survey record',
  `indicator` varchar(500) NOT NULL COMMENT 'Row label / indicator name',
  `age_10_14` decimal(15,2) DEFAULT NULL,
  `age_15_19` decimal(15,2) DEFAULT NULL,
  `age_20_49` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `a_modern`
--

CREATE TABLE `a_modern` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` varchar(100) DEFAULT NULL COMMENT 'Parent form / survey record',
  `indicator` varchar(500) NOT NULL COMMENT 'Row label / indicator name',
  `current_begin_10_14` decimal(15,2) DEFAULT NULL,
  `current_begin_15_19` decimal(15,2) DEFAULT NULL,
  `current_begin_20_49` decimal(15,2) DEFAULT NULL,
  `current_begin_total` decimal(15,2) DEFAULT NULL,
  `new_prev_10_14` decimal(15,2) DEFAULT NULL,
  `new_prev_15_19` decimal(15,2) DEFAULT NULL,
  `new_prev_20_49` decimal(15,2) DEFAULT NULL,
  `new_prev_total` decimal(15,2) DEFAULT NULL,
  `other_acceptors_10_14` decimal(15,2) DEFAULT NULL,
  `other_acceptors_15_19` decimal(15,2) DEFAULT NULL,
  `other_acceptors_20_49` decimal(15,2) DEFAULT NULL,
  `other_acceptors_total` decimal(15,2) DEFAULT NULL,
  `drop_10_14` decimal(15,2) DEFAULT NULL,
  `drop_15_19` decimal(15,2) DEFAULT NULL,
  `drop_20_49` decimal(15,2) DEFAULT NULL,
  `drop_total` decimal(15,2) DEFAULT NULL,
  `current_end_10_14` decimal(15,2) DEFAULT NULL,
  `current_end_15_19` decimal(15,2) DEFAULT NULL,
  `current_end_20_49` decimal(15,2) DEFAULT NULL,
  `current_end_total` decimal(15,2) DEFAULT NULL,
  `new_present_10_14` decimal(15,2) DEFAULT NULL,
  `new_present_15_19` decimal(15,2) DEFAULT NULL,
  `new_present_20_49` decimal(15,2) DEFAULT NULL,
  `new_present_total` decimal(15,2) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `b_prenatal`
--

CREATE TABLE `b_prenatal` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` varchar(100) DEFAULT NULL COMMENT 'Parent form / survey record',
  `indicator` varchar(500) NOT NULL COMMENT 'Row label / indicator name',
  `age_10_14` decimal(15,2) DEFAULT NULL,
  `age_15_19` decimal(15,2) DEFAULT NULL,
  `age_20_49` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `c_a1`
--

CREATE TABLE `c_a1` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` varchar(100) DEFAULT NULL COMMENT 'Parent form / survey record',
  `indicator` varchar(500) NOT NULL COMMENT 'Row label / indicator name',
  `male` decimal(15,2) DEFAULT NULL,
  `female` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `c_a2`
--

CREATE TABLE `c_a2` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` varchar(100) DEFAULT NULL COMMENT 'Parent form / survey record',
  `indicator` varchar(500) NOT NULL COMMENT 'Row label / indicator name',
  `male` decimal(15,2) DEFAULT NULL,
  `female` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `c_a3`
--

CREATE TABLE `c_a3` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` varchar(100) DEFAULT NULL COMMENT 'Parent form / survey record',
  `indicator` varchar(500) NOT NULL COMMENT 'Row label / indicator name',
  `male` decimal(15,2) DEFAULT NULL,
  `female` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `c_a4`
--

CREATE TABLE `c_a4` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` varchar(100) DEFAULT NULL COMMENT 'Parent form / survey record',
  `indicator` varchar(500) NOT NULL COMMENT 'Row label / indicator name',
  `male` decimal(15,2) DEFAULT NULL,
  `female` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `c_nutrition`
--

CREATE TABLE `c_nutrition` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` varchar(100) DEFAULT NULL COMMENT 'Parent form / survey record',
  `indicator` varchar(500) NOT NULL COMMENT 'Row label / indicator name',
  `male` decimal(15,2) DEFAULT NULL,
  `female` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `c_sick`
--

CREATE TABLE `c_sick` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` varchar(100) DEFAULT NULL COMMENT 'Parent form / survey record',
  `indicator` varchar(500) NOT NULL COMMENT 'Row label / indicator name',
  `male` decimal(15,2) DEFAULT NULL,
  `female` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `d_oral`
--

CREATE TABLE `d_oral` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` varchar(100) DEFAULT NULL COMMENT 'Parent form / survey record',
  `indicator` varchar(500) NOT NULL COMMENT 'Row label / indicator name',
  `male` decimal(15,2) DEFAULT NULL,
  `female` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `e_e1`
--

CREATE TABLE `e_e1` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` varchar(100) DEFAULT NULL COMMENT 'Parent form / survey record',
  `indicator` varchar(500) NOT NULL COMMENT 'Row label / indicator name',
  `male` decimal(15,2) DEFAULT NULL,
  `female` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `e_e2`
--

CREATE TABLE `e_e2` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` varchar(100) DEFAULT NULL COMMENT 'Parent form / survey record',
  `indicator` varchar(500) NOT NULL COMMENT 'Row label / indicator name',
  `male` decimal(15,2) DEFAULT NULL,
  `female` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `e_e3`
--

CREATE TABLE `e_e3` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` varchar(100) DEFAULT NULL COMMENT 'Parent form / survey record',
  `indicator` varchar(500) NOT NULL COMMENT 'Row label / indicator name',
  `male` decimal(15,2) DEFAULT NULL,
  `female` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `e_e4`
--

CREATE TABLE `e_e4` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` varchar(100) DEFAULT NULL COMMENT 'Parent form / survey record',
  `indicator` varchar(500) NOT NULL COMMENT 'Row label / indicator name',
  `male` decimal(15,2) DEFAULT NULL,
  `female` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `e_e5`
--

CREATE TABLE `e_e5` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` varchar(100) DEFAULT NULL COMMENT 'Parent form / survey record',
  `indicator` varchar(500) NOT NULL COMMENT 'Row label / indicator name',
  `male` decimal(15,2) DEFAULT NULL,
  `female` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `e_e6`
--

CREATE TABLE `e_e6` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` varchar(100) DEFAULT NULL COMMENT 'Parent form / survey record',
  `indicator` varchar(500) NOT NULL COMMENT 'Row label / indicator name',
  `male` decimal(15,2) DEFAULT NULL,
  `female` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `e_e7`
--

CREATE TABLE `e_e7` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` varchar(100) DEFAULT NULL COMMENT 'Parent form / survey record',
  `indicator` varchar(500) NOT NULL COMMENT 'Row label / indicator name',
  `male` decimal(15,2) DEFAULT NULL,
  `female` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `e_e8`
--

CREATE TABLE `e_e8` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` varchar(100) DEFAULT NULL COMMENT 'Parent form / survey record',
  `indicator` varchar(500) NOT NULL COMMENT 'Row label / indicator name',
  `male` decimal(15,2) DEFAULT NULL,
  `female` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `family_planning_methods`
--

CREATE TABLE `family_planning_methods` (
  `id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `fp_pills` tinyint(1) DEFAULT 0,
  `fp_injectables` tinyint(1) DEFAULT 0,
  `fp_btl` tinyint(1) DEFAULT 0,
  `fp_vasectomy` tinyint(1) DEFAULT 0,
  `fp_implant` tinyint(1) DEFAULT 0,
  `fp_condom` tinyint(1) DEFAULT 0,
  `fp_cm` tinyint(1) DEFAULT 0,
  `fp_bbt` tinyint(1) DEFAULT 0,
  `fp_stm` tinyint(1) DEFAULT 0,
  `fp_sdm` tinyint(1) DEFAULT 0
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
-- Table structure for table `f_sanitation`
--

CREATE TABLE `f_sanitation` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` varchar(100) DEFAULT NULL COMMENT 'Parent form / survey record',
  `indicator` varchar(500) NOT NULL COMMENT 'Row label / indicator name',
  `count` decimal(15,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `f_water`
--

CREATE TABLE `f_water` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` varchar(100) DEFAULT NULL COMMENT 'Parent form / survey record',
  `indicator` varchar(500) NOT NULL COMMENT 'Row label / indicator name',
  `count` decimal(15,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `g_filariasis`
--

CREATE TABLE `g_filariasis` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` varchar(100) DEFAULT NULL COMMENT 'Parent form / survey record',
  `indicator` varchar(500) NOT NULL COMMENT 'Row label / indicator name',
  `male` decimal(15,2) DEFAULT NULL,
  `female` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `g_hiv`
--

CREATE TABLE `g_hiv` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` varchar(100) DEFAULT NULL COMMENT 'Parent form / survey record',
  `indicator` varchar(500) NOT NULL COMMENT 'Row label / indicator name',
  `male` decimal(15,2) DEFAULT NULL,
  `female` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `g_leprosy`
--

CREATE TABLE `g_leprosy` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` varchar(100) DEFAULT NULL COMMENT 'Parent form / survey record',
  `indicator` varchar(500) NOT NULL COMMENT 'Row label / indicator name',
  `male` decimal(15,2) DEFAULT NULL,
  `female` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `g_rabies`
--

CREATE TABLE `g_rabies` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` varchar(100) DEFAULT NULL COMMENT 'Parent form / survey record',
  `indicator` varchar(500) NOT NULL COMMENT 'Row label / indicator name',
  `male` decimal(15,2) DEFAULT NULL,
  `female` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `g_schistosomiasis`
--

CREATE TABLE `g_schistosomiasis` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` varchar(100) DEFAULT NULL COMMENT 'Parent form / survey record',
  `indicator` varchar(500) NOT NULL COMMENT 'Row label / indicator name',
  `male` decimal(15,2) DEFAULT NULL,
  `female` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `g_sth`
--

CREATE TABLE `g_sth` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` varchar(100) DEFAULT NULL COMMENT 'Parent form / survey record',
  `indicator` varchar(500) NOT NULL COMMENT 'Row label / indicator name',
  `male` decimal(15,2) DEFAULT NULL,
  `female` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m1brgy_report_info`
--

CREATE TABLE `m1brgy_report_info` (
  `id` int(100) NOT NULL,
  `month_year_id` varchar(100) NOT NULL,
  `report_for_month` varchar(100) NOT NULL,
  `report_year` int(100) NOT NULL,
  `brgy_name` varchar(100) NOT NULL,
  `bhs_name` varchar(100) NOT NULL,
  `city_name` varchar(100) NOT NULL,
  `province_name` varchar(100) NOT NULL,
  `projected_population_year` int(100) NOT NULL,
  `prepared_by` varchar(100) NOT NULL,
  `verified_by` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `prepared_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m1brgy_report_info`
--

INSERT INTO `m1brgy_report_info` (`id`, `month_year_id`, `report_for_month`, `report_year`, `brgy_name`, `bhs_name`, `city_name`, `province_name`, `projected_population_year`, `prepared_by`, `verified_by`, `position`, `prepared_date`) VALUES
(9, 'February-2025', 'February', 2025, 'Dela Paz', 'Dela Paz City Hall', 'Binan City', 'Laguna', 1500, 'Marc Ace J. Legaspi', 'Abigail T. Velasco', 'COP', '2026-05-08'),
(13, 'March-2026', 'March', 2026, 'UBL', 'UBL City Hall', 'San Pedro City', 'Laguna', 1600, 'Abigail T. Velasco', 'Marc Ace J. Legaspi', 'EDTECH', '2026-05-08'),
(15, 'April-2026', 'April', 2026, 'Brgy. Makiling', 'Makiling City Hall', 'Calamba City', 'Laguna', 2500, 'Abigail T. Velasco', 'Marc Ace J. Legaspi', 'EDTECH', '2026-05-08'),
(16, 'July-2024', 'July', 2024, 'asdasd', 'asd', 'saasd', 'asasd', 1123123, 'asdas', 'asda', 'asasdasd', '2026-05-13'),
(25, 'February-2026', 'February', 2026, 'sample', 'sample', 'sample', 'sample', 100, 'sample', 'sample', 'sample', '2026-05-17'),
(29, 'May-2026', 'May', 2026, 'sample', 'sample', 'SAN PEDRO (LAGUNA)', 'LAGUNA', 100, 'sample', 'sample', 'sample', '2026-05-17'),
(30, 'December-2026', 'December', 2026, 'sample', 'sample', 'SAN PEDRO (LAGUNA)', 'LAGUNA', 100, 'sample', 'sample', 'sample', '2026-05-17'),
(31, 'November-2026', 'November', 2026, 'Sample', 'Sample', 'Sample', 'Sample', 1500, 'Sample', 'Sample', 'Sample', '2026-05-18'),
(32, 'September-2026', 'September', 2026, 'sample', 'sample', 'sample', 'sample', 100, 'sample', 'sample', 'sample', '2026-05-21'),
(33, 'January-2026', 'January', 2026, 'asdasd', 'asdas', 'asdasd', 'asdasd', 1000, 'asdasd', 'asdasd', 'asdasd', '2026-05-25');

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
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `year` smallint(6) NOT NULL,
  `bhw_name` varchar(150) NOT NULL,
  `barangay` varchar(150) NOT NULL,
  `area` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `barangay` varchar(150) NOT NULL,
  `area` varchar(150) NOT NULL,
  `role` enum('bhw','admin') DEFAULT 'bhw',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vital_mortality`
--

CREATE TABLE `vital_mortality` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` varchar(100) DEFAULT NULL COMMENT 'Parent form / survey record',
  `indicator` varchar(500) NOT NULL COMMENT 'Row label / indicator name',
  `age_10_14` decimal(15,2) DEFAULT NULL,
  `age_15_19` decimal(15,2) DEFAULT NULL,
  `age_20_49` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vital_natality`
--

CREATE TABLE `vital_natality` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` varchar(100) DEFAULT NULL COMMENT 'Parent form / survey record',
  `indicator` varchar(500) NOT NULL COMMENT 'Row label / indicator name',
  `male` decimal(15,2) DEFAULT NULL,
  `female` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_category_totals`
-- (See below for the actual view)
--
CREATE TABLE `vw_category_totals` (
`report_id` int(11)
,`maternal_care` decimal(27,0)
,`delivery` decimal(27,0)
,`post_partum` decimal(27,0)
,`childcare` decimal(27,0)
,`immunization` decimal(27,0)
,`nutrition` decimal(27,0)
,`family_planning` decimal(27,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_monthly_totals`
-- (See below for the actual view)
--
CREATE TABLE `vw_monthly_totals` (
`report_id` int(11)
,`jan` decimal(27,0)
,`feb` decimal(27,0)
,`mar` decimal(27,0)
,`apr` decimal(27,0)
,`may` decimal(27,0)
,`jun` decimal(27,0)
,`jul` decimal(27,0)
,`aug` decimal(27,0)
,`sep` decimal(27,0)
,`oct` decimal(27,0)
,`nov` decimal(27,0)
,`dec` decimal(27,0)
,`yearly_total` decimal(27,0)
);

-- --------------------------------------------------------

--
-- Structure for view `vw_category_totals`
--
DROP TABLE IF EXISTS `vw_category_totals`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_category_totals`  AS SELECT `accomplishment_data`.`report_id` AS `report_id`, sum(case when `accomplishment_data`.`row_key` in ('maternal_1_1','maternal_1_2','maternal_1_3','maternal_1_4') then `accomplishment_data`.`row_total` else 0 end) AS `maternal_care`, sum(case when `accomplishment_data`.`row_key` in ('delivery_2_1a','delivery_2_1b') then `accomplishment_data`.`row_total` else 0 end) AS `delivery`, sum(case when `accomplishment_data`.`row_key` = 'postpartum_3_1' then `accomplishment_data`.`row_total` else 0 end) AS `post_partum`, sum(case when `accomplishment_data`.`row_key` = 'childcare_4_1' then `accomplishment_data`.`row_total` else 0 end) AS `childcare`, sum(case when `accomplishment_data`.`row_key` in ('nip_5_1','nip_5_2','nip_5_3','nip_5_4') then `accomplishment_data`.`row_total` else 0 end) AS `immunization`, sum(case when `accomplishment_data`.`row_key` in ('nutrition_6_1','nutrition_6_2a','nutrition_6_2b','nutrition_6_3a','nutrition_6_3b','nutrition_6_4') then `accomplishment_data`.`row_total` else 0 end) AS `nutrition`, sum(case when `accomplishment_data`.`row_key` in ('fp_7_1','fp_7_2','fp_7_3') then `accomplishment_data`.`row_total` else 0 end) AS `family_planning` FROM `accomplishment_data` GROUP BY `accomplishment_data`.`report_id` ;

-- --------------------------------------------------------

--
-- Structure for view `vw_monthly_totals`
--
DROP TABLE IF EXISTS `vw_monthly_totals`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_monthly_totals`  AS SELECT `accomplishment_data`.`report_id` AS `report_id`, sum(`accomplishment_data`.`jan`) AS `jan`, sum(`accomplishment_data`.`feb`) AS `feb`, sum(`accomplishment_data`.`mar`) AS `mar`, sum(`accomplishment_data`.`apr`) AS `apr`, sum(`accomplishment_data`.`may`) AS `may`, sum(`accomplishment_data`.`jun`) AS `jun`, sum(`accomplishment_data`.`jul`) AS `jul`, sum(`accomplishment_data`.`aug`) AS `aug`, sum(`accomplishment_data`.`sep`) AS `sep`, sum(`accomplishment_data`.`oct`) AS `oct`, sum(`accomplishment_data`.`nov`) AS `nov`, sum(`accomplishment_data`.`dec`) AS `dec`, sum(`accomplishment_data`.`row_total`) AS `yearly_total` FROM `accomplishment_data` GROUP BY `accomplishment_data`.`report_id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accomplishment_data`
--
ALTER TABLE `accomplishment_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_row` (`report_id`,`row_key`),
  ADD KEY `idx_acc_report` (`report_id`);

--
-- Indexes for table `a_demand`
--
ALTER TABLE `a_demand`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_record_id` (`record_id`);

--
-- Indexes for table `a_modern`
--
ALTER TABLE `a_modern`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_record_id` (`record_id`);

--
-- Indexes for table `b_prenatal`
--
ALTER TABLE `b_prenatal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_record_id` (`record_id`);

--
-- Indexes for table `c_a1`
--
ALTER TABLE `c_a1`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_record_id` (`record_id`);

--
-- Indexes for table `c_a2`
--
ALTER TABLE `c_a2`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_record_id` (`record_id`);

--
-- Indexes for table `c_a3`
--
ALTER TABLE `c_a3`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_record_id` (`record_id`);

--
-- Indexes for table `c_a4`
--
ALTER TABLE `c_a4`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_record_id` (`record_id`);

--
-- Indexes for table `c_nutrition`
--
ALTER TABLE `c_nutrition`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_record_id` (`record_id`);

--
-- Indexes for table `c_sick`
--
ALTER TABLE `c_sick`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_record_id` (`record_id`);

--
-- Indexes for table `d_oral`
--
ALTER TABLE `d_oral`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_record_id` (`record_id`);

--
-- Indexes for table `e_e1`
--
ALTER TABLE `e_e1`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_record_id` (`record_id`);

--
-- Indexes for table `e_e2`
--
ALTER TABLE `e_e2`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_record_id` (`record_id`);

--
-- Indexes for table `e_e3`
--
ALTER TABLE `e_e3`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_record_id` (`record_id`);

--
-- Indexes for table `e_e4`
--
ALTER TABLE `e_e4`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_record_id` (`record_id`);

--
-- Indexes for table `e_e5`
--
ALTER TABLE `e_e5`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_record_id` (`record_id`);

--
-- Indexes for table `e_e6`
--
ALTER TABLE `e_e6`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_record_id` (`record_id`);

--
-- Indexes for table `e_e7`
--
ALTER TABLE `e_e7`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_record_id` (`record_id`);

--
-- Indexes for table `e_e8`
--
ALTER TABLE `e_e8`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_record_id` (`record_id`);

--
-- Indexes for table `family_planning_methods`
--
ALTER TABLE `family_planning_methods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `report_id` (`report_id`);

--
-- Indexes for table `f_sanitation`
--
ALTER TABLE `f_sanitation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_record_id` (`record_id`);

--
-- Indexes for table `f_water`
--
ALTER TABLE `f_water`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_record_id` (`record_id`);

--
-- Indexes for table `g_filariasis`
--
ALTER TABLE `g_filariasis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_record_id` (`record_id`);

--
-- Indexes for table `g_hiv`
--
ALTER TABLE `g_hiv`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_record_id` (`record_id`);

--
-- Indexes for table `g_leprosy`
--
ALTER TABLE `g_leprosy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_record_id` (`record_id`);

--
-- Indexes for table `g_rabies`
--
ALTER TABLE `g_rabies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_record_id` (`record_id`);

--
-- Indexes for table `g_schistosomiasis`
--
ALTER TABLE `g_schistosomiasis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_record_id` (`record_id`);

--
-- Indexes for table `g_sth`
--
ALTER TABLE `g_sth`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_record_id` (`record_id`);

--
-- Indexes for table `m1brgy_report_info`
--
ALTER TABLE `m1brgy_report_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_report` (`user_id`,`year`),
  ADD KEY `idx_reports_user` (`user_id`),
  ADD KEY `idx_reports_year` (`year`),
  ADD KEY `idx_reports_barangay` (`barangay`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `vital_mortality`
--
ALTER TABLE `vital_mortality`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_record_id` (`record_id`);

--
-- Indexes for table `vital_natality`
--
ALTER TABLE `vital_natality`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_record_id` (`record_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accomplishment_data`
--
ALTER TABLE `accomplishment_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `a_demand`
--
ALTER TABLE `a_demand`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `a_modern`
--
ALTER TABLE `a_modern`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=339;

--
-- AUTO_INCREMENT for table `b_prenatal`
--
ALTER TABLE `b_prenatal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `c_a1`
--
ALTER TABLE `c_a1`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `c_a2`
--
ALTER TABLE `c_a2`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `c_a3`
--
ALTER TABLE `c_a3`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `c_a4`
--
ALTER TABLE `c_a4`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `c_nutrition`
--
ALTER TABLE `c_nutrition`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `c_sick`
--
ALTER TABLE `c_sick`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `d_oral`
--
ALTER TABLE `d_oral`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `e_e1`
--
ALTER TABLE `e_e1`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `e_e2`
--
ALTER TABLE `e_e2`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `e_e3`
--
ALTER TABLE `e_e3`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `e_e4`
--
ALTER TABLE `e_e4`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `e_e5`
--
ALTER TABLE `e_e5`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `e_e6`
--
ALTER TABLE `e_e6`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `e_e7`
--
ALTER TABLE `e_e7`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `e_e8`
--
ALTER TABLE `e_e8`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `family_planning_methods`
--
ALTER TABLE `family_planning_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `f_sanitation`
--
ALTER TABLE `f_sanitation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `f_water`
--
ALTER TABLE `f_water`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `g_filariasis`
--
ALTER TABLE `g_filariasis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `g_hiv`
--
ALTER TABLE `g_hiv`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `g_leprosy`
--
ALTER TABLE `g_leprosy`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `g_rabies`
--
ALTER TABLE `g_rabies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `g_schistosomiasis`
--
ALTER TABLE `g_schistosomiasis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `g_sth`
--
ALTER TABLE `g_sth`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m1brgy_report_info`
--
ALTER TABLE `m1brgy_report_info`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vital_mortality`
--
ALTER TABLE `vital_mortality`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vital_natality`
--
ALTER TABLE `vital_natality`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accomplishment_data`
--
ALTER TABLE `accomplishment_data`
  ADD CONSTRAINT `accomplishment_data_ibfk_1` FOREIGN KEY (`report_id`) REFERENCES `reports` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `family_planning_methods`
--
ALTER TABLE `family_planning_methods`
  ADD CONSTRAINT `family_planning_methods_ibfk_1` FOREIGN KEY (`report_id`) REFERENCES `reports` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
