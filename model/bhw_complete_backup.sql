-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2026 at 05:21 PM
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
-- Table structure for table `a_demand`
--

CREATE TABLE `a_demand` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` int(10) UNSIGNED NOT NULL COMMENT 'Parent form / survey record',
  `indicator` varchar(500) NOT NULL COMMENT 'Row label / indicator name',
  `age_10_14` decimal(15,2) DEFAULT NULL,
  `age_15_19` decimal(15,2) DEFAULT NULL,
  `age_20_49` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `a_demand`
--

INSERT INTO `a_demand` (`id`, `record_id`, `indicator`, `age_10_14`, `age_15_19`, `age_20_49`, `total`, `remarks`, `created_at`, `updated_at`) VALUES
(10, 1, 'No of women of reproductive age(WRA) 15-49 years old who have demand for Family Planning(FP) and currently using, or whose partner is currently using, any modern FP Methods.', 0.00, 0.00, 0.00, 0.00, '', '2026-05-21 23:13:56', '2026-05-21 23:13:56');

-- --------------------------------------------------------

--
-- Table structure for table `a_modern`
--

CREATE TABLE `a_modern` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` int(10) UNSIGNED NOT NULL COMMENT 'Parent form / survey record',
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

--
-- Dumping data for table `a_modern`
--

INSERT INTO `a_modern` (`id`, `record_id`, `indicator`, `current_begin_10_14`, `current_begin_15_19`, `current_begin_20_49`, `current_begin_total`, `new_prev_10_14`, `new_prev_15_19`, `new_prev_20_49`, `new_prev_total`, `other_acceptors_10_14`, `other_acceptors_15_19`, `other_acceptors_20_49`, `other_acceptors_total`, `drop_10_14`, `drop_15_19`, `drop_20_49`, `drop_total`, `current_end_10_14`, `current_end_15_19`, `current_end_20_49`, `current_end_total`, `new_present_10_14`, `new_present_15_19`, `new_present_20_49`, `new_present_total`, `created_at`, `updated_at`) VALUES
(118, 1, 'BTL', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2026-05-21 23:13:56', '2026-05-21 23:13:56'),
(119, 1, 'NSV', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2026-05-21 23:13:56', '2026-05-21 23:13:56'),
(120, 1, 'Condom', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2026-05-21 23:13:56', '2026-05-21 23:13:56'),
(121, 1, 'Pills (a. Pills-POP, b. Implants-PP)', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2026-05-21 23:13:56', '2026-05-21 23:13:56'),
(122, 1, 'Injectables', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2026-05-21 23:13:56', '2026-05-21 23:13:56'),
(123, 1, 'Implant (a. Implants-Interval b. Implants PP)', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2026-05-21 23:13:56', '2026-05-21 23:13:56'),
(124, 1, 'IUD (a. IUD- Interval b. IUD PP)', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2026-05-21 23:13:56', '2026-05-21 23:13:56'),
(125, 1, 'NFP-LAM', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2026-05-21 23:13:56', '2026-05-21 23:13:56'),
(126, 1, 'NFP-BBT', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2026-05-21 23:13:56', '2026-05-21 23:13:56'),
(127, 1, 'NFP-CMM', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2026-05-21 23:13:56', '2026-05-21 23:13:56'),
(128, 1, 'NFP-STM', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2026-05-21 23:13:56', '2026-05-21 23:13:56'),
(129, 1, 'NFP-SDM', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2026-05-21 23:13:56', '2026-05-21 23:13:56'),
(130, 1, 'Total Current Users', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2026-05-21 23:13:56', '2026-05-21 23:13:56');

-- --------------------------------------------------------

--
-- Table structure for table `b_prenatal`
--

CREATE TABLE `b_prenatal` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` int(10) UNSIGNED NOT NULL COMMENT 'Parent form / survey record',
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
  `record_id` int(10) UNSIGNED NOT NULL COMMENT 'Parent form / survey record',
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
  `record_id` int(10) UNSIGNED NOT NULL COMMENT 'Parent form / survey record',
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
  `record_id` int(10) UNSIGNED NOT NULL COMMENT 'Parent form / survey record',
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
  `record_id` int(10) UNSIGNED NOT NULL COMMENT 'Parent form / survey record',
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
  `record_id` int(10) UNSIGNED NOT NULL COMMENT 'Parent form / survey record',
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
  `record_id` int(10) UNSIGNED NOT NULL COMMENT 'Parent form / survey record',
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
  `record_id` int(10) UNSIGNED NOT NULL COMMENT 'Parent form / survey record',
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
  `record_id` int(10) UNSIGNED NOT NULL COMMENT 'Parent form / survey record',
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
  `record_id` int(10) UNSIGNED NOT NULL COMMENT 'Parent form / survey record',
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
  `record_id` int(10) UNSIGNED NOT NULL COMMENT 'Parent form / survey record',
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
  `record_id` int(10) UNSIGNED NOT NULL COMMENT 'Parent form / survey record',
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
  `record_id` int(10) UNSIGNED NOT NULL COMMENT 'Parent form / survey record',
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
  `record_id` int(10) UNSIGNED NOT NULL COMMENT 'Parent form / survey record',
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
  `record_id` int(10) UNSIGNED NOT NULL COMMENT 'Parent form / survey record',
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
  `record_id` int(10) UNSIGNED NOT NULL COMMENT 'Parent form / survey record',
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
  `record_id` int(10) UNSIGNED NOT NULL COMMENT 'Parent form / survey record',
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
  `record_id` int(10) UNSIGNED NOT NULL COMMENT 'Parent form / survey record',
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
  `record_id` int(10) UNSIGNED NOT NULL COMMENT 'Parent form / survey record',
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
  `record_id` int(10) UNSIGNED NOT NULL COMMENT 'Parent form / survey record',
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
  `record_id` int(10) UNSIGNED NOT NULL COMMENT 'Parent form / survey record',
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
  `record_id` int(10) UNSIGNED NOT NULL COMMENT 'Parent form / survey record',
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
  `record_id` int(10) UNSIGNED NOT NULL COMMENT 'Parent form / survey record',
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
  `record_id` int(10) UNSIGNED NOT NULL COMMENT 'Parent form / survey record',
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
(32, 'September-2026', 'September', 2026, 'sample', 'sample', 'sample', 'sample', 100, 'sample', 'sample', 'sample', '2026-05-21');

-- --------------------------------------------------------

--
-- Table structure for table `m1brgy_section_a`
--

CREATE TABLE `m1brgy_section_a` (
  `id` int(100) NOT NULL,
  `month_year_id` varchar(100) NOT NULL,
  `TDS_age_group_1` int(100) NOT NULL,
  `TDS_age_group_2` int(100) NOT NULL,
  `TDS_age_group_3` int(100) NOT NULL,
  `TDS_total` int(100) NOT NULL,
  `TDS_remarks` varchar(100) NOT NULL,
  `BTL` varchar(1000) NOT NULL,
  `NSV` varchar(1000) NOT NULL,
  `condom` varchar(1000) NOT NULL,
  `pills` varchar(1000) NOT NULL,
  `injectibles` varchar(1000) NOT NULL,
  `implants` varchar(1000) NOT NULL,
  `IUD` varchar(1000) NOT NULL,
  `NFPLAM` varchar(1000) NOT NULL,
  `NFPBBT` varchar(1000) NOT NULL,
  `NFPCMM` varchar(1000) NOT NULL,
  `NFPSTM` varchar(1000) NOT NULL,
  `NFPSDM` varchar(1000) NOT NULL,
  `TotalCurrentUsers` varchar(1000) NOT NULL,
  `BTL_CUBOM_1` int(100) NOT NULL,
  `BTL_CUBOM_2` int(100) NOT NULL,
  `BTL_CUBOM_3` int(100) NOT NULL,
  `BTL_CUBOM_Total` int(100) NOT NULL,
  `BTL_NAPM_1` int(100) NOT NULL,
  `BTL_NAPM_2` int(100) NOT NULL,
  `BTL_NAPM_3` int(100) NOT NULL,
  `BTL_NAPM_Total` int(100) NOT NULL,
  `TMFP_NSV_CU_BOM_1` int(100) NOT NULL,
  `TMFP_NSV_CU_BOM_2` int(100) NOT NULL,
  `TMFP_NSV_CU_BOM_3` int(100) NOT NULL,
  `TMFP_NSV_CU_BOM_4` int(100) NOT NULL,
  `TMFP_Condom_CU_BOM_1` int(100) NOT NULL,
  `TMFP_Condom_CU_BOM_2` int(100) NOT NULL,
  `TMFP_Condom_CU_BOM_3` int(100) NOT NULL,
  `TMFP_Condom_CU_BOM_4` int(100) NOT NULL,
  `TMFP_Pills_CU_BOM_1` int(100) NOT NULL,
  `TMFP_Pills_CU_BOM_2` int(100) NOT NULL,
  `TMFP_Pills_CU_BOM_3` int(100) NOT NULL,
  `TMFP_Pills_CU_BOM_4` int(100) NOT NULL,
  `TMFP_Injectibles_CU_BOM_1` int(100) NOT NULL,
  `TMFP_Injectibles_CU_BOM_2` int(100) NOT NULL,
  `TMFP_Injectibles_CU_BOM_3` int(100) NOT NULL,
  `TMFP_Injectibles_CU_BOM_4` int(100) NOT NULL,
  `TMFP_Implant_CU_BOM_1` int(100) NOT NULL,
  `TMFP_Implant_CU_BOM_2` int(100) NOT NULL,
  `TMFP_Implant_CU_BOM_3` int(100) NOT NULL,
  `TMFP_Implant_CU_BOM_4` int(100) NOT NULL,
  `TMFP_IUD_CU_BOM_1` int(100) NOT NULL,
  `TMFP_IUD_CU_BOM_2` int(100) NOT NULL,
  `TMFP_IUD_CU_BOM_3` int(100) NOT NULL,
  `TMFP_IUD_CU_BOM_4` int(100) NOT NULL,
  `TMFP_NFP-LAM_CU_BOM_1` int(100) NOT NULL,
  `TMFP_NFP-LAM_CU_BOM_2` int(100) NOT NULL,
  `TMFP_NFP-LAM_CU_BOM_3` int(100) NOT NULL,
  `TMFP_NFP-LAM_CU_BOM_4` int(100) NOT NULL,
  `TMFP_NFP-BBT_CU_BOM_1` int(100) NOT NULL,
  `TMFP_NFP-BBT_CU_BOM_2` int(100) NOT NULL,
  `TMFP_NFP-BBT_CU_BOM_3` int(100) NOT NULL,
  `TMFP_NFP-BBT_CU_BOM_4` int(100) NOT NULL,
  `TMFP_NFP-CMM_CU_BOM_1` int(100) NOT NULL,
  `TMFP_NFP-CMM_CU_BOM_2` int(100) NOT NULL,
  `TMFP_NFP-CMM_CU_BOM_3` int(100) NOT NULL,
  `TMFP_NFP-CMM_CU_BOM_4` int(100) NOT NULL,
  `TMFP_NFP-STM_CU_BOM_1` int(100) NOT NULL,
  `TMFP_NFP-STM_CU_BOM_2` int(100) NOT NULL,
  `TMFP_NFP-STM_CU_BOM_3` int(100) NOT NULL,
  `TMFP_NFP-STM_CU_BOM_4` int(100) NOT NULL,
  `TMFP_NFP-SDM_CU_BOM_1` int(100) NOT NULL,
  `TMFP_NFP-SDM_CU_BOM_2` int(100) NOT NULL,
  `TMFP_NFP-SDM_CU_BOM_3` int(100) NOT NULL,
  `TMFP_NFP-SDM_CU_BOM_4` int(100) NOT NULL,
  `Total_Current_Users` int(100) NOT NULL,
  `BTL_OAPM_1` int(100) NOT NULL,
  `BTL_OAPM_2` int(100) NOT NULL,
  `BTL_OAPM_3` int(100) NOT NULL,
  `BTL_OAPM_Total` int(100) NOT NULL,
  `BTL_DPM_1` int(100) NOT NULL,
  `BTL_DPM_2` int(100) NOT NULL,
  `BTL_DPM_3` int(100) NOT NULL,
  `BTL_DPM_Total` int(100) NOT NULL,
  `BTL_CUEM_1` int(100) NOT NULL,
  `BTL_CUEM_2` int(100) NOT NULL,
  `BTL_CUEM_3` int(100) NOT NULL,
  `BTL_CUEM_Total` int(100) NOT NULL,
  `BTL_NPM_1` int(100) NOT NULL,
  `BTL_NPM_2` int(100) NOT NULL,
  `BTL_NPM_3` int(100) NOT NULL,
  `BTL_NPM_Total` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m1brgy_section_a`
--

INSERT INTO `m1brgy_section_a` (`id`, `month_year_id`, `TDS_age_group_1`, `TDS_age_group_2`, `TDS_age_group_3`, `TDS_total`, `TDS_remarks`, `BTL`, `NSV`, `condom`, `pills`, `injectibles`, `implants`, `IUD`, `NFPLAM`, `NFPBBT`, `NFPCMM`, `NFPSTM`, `NFPSDM`, `TotalCurrentUsers`, `BTL_CUBOM_1`, `BTL_CUBOM_2`, `BTL_CUBOM_3`, `BTL_CUBOM_Total`, `BTL_NAPM_1`, `BTL_NAPM_2`, `BTL_NAPM_3`, `BTL_NAPM_Total`, `TMFP_NSV_CU_BOM_1`, `TMFP_NSV_CU_BOM_2`, `TMFP_NSV_CU_BOM_3`, `TMFP_NSV_CU_BOM_4`, `TMFP_Condom_CU_BOM_1`, `TMFP_Condom_CU_BOM_2`, `TMFP_Condom_CU_BOM_3`, `TMFP_Condom_CU_BOM_4`, `TMFP_Pills_CU_BOM_1`, `TMFP_Pills_CU_BOM_2`, `TMFP_Pills_CU_BOM_3`, `TMFP_Pills_CU_BOM_4`, `TMFP_Injectibles_CU_BOM_1`, `TMFP_Injectibles_CU_BOM_2`, `TMFP_Injectibles_CU_BOM_3`, `TMFP_Injectibles_CU_BOM_4`, `TMFP_Implant_CU_BOM_1`, `TMFP_Implant_CU_BOM_2`, `TMFP_Implant_CU_BOM_3`, `TMFP_Implant_CU_BOM_4`, `TMFP_IUD_CU_BOM_1`, `TMFP_IUD_CU_BOM_2`, `TMFP_IUD_CU_BOM_3`, `TMFP_IUD_CU_BOM_4`, `TMFP_NFP-LAM_CU_BOM_1`, `TMFP_NFP-LAM_CU_BOM_2`, `TMFP_NFP-LAM_CU_BOM_3`, `TMFP_NFP-LAM_CU_BOM_4`, `TMFP_NFP-BBT_CU_BOM_1`, `TMFP_NFP-BBT_CU_BOM_2`, `TMFP_NFP-BBT_CU_BOM_3`, `TMFP_NFP-BBT_CU_BOM_4`, `TMFP_NFP-CMM_CU_BOM_1`, `TMFP_NFP-CMM_CU_BOM_2`, `TMFP_NFP-CMM_CU_BOM_3`, `TMFP_NFP-CMM_CU_BOM_4`, `TMFP_NFP-STM_CU_BOM_1`, `TMFP_NFP-STM_CU_BOM_2`, `TMFP_NFP-STM_CU_BOM_3`, `TMFP_NFP-STM_CU_BOM_4`, `TMFP_NFP-SDM_CU_BOM_1`, `TMFP_NFP-SDM_CU_BOM_2`, `TMFP_NFP-SDM_CU_BOM_3`, `TMFP_NFP-SDM_CU_BOM_4`, `Total_Current_Users`, `BTL_OAPM_1`, `BTL_OAPM_2`, `BTL_OAPM_3`, `BTL_OAPM_Total`, `BTL_DPM_1`, `BTL_DPM_2`, `BTL_DPM_3`, `BTL_DPM_Total`, `BTL_CUEM_1`, `BTL_CUEM_2`, `BTL_CUEM_3`, `BTL_CUEM_Total`, `BTL_NPM_1`, `BTL_NPM_2`, `BTL_NPM_3`, `BTL_NPM_Total`) VALUES
(3, 'March-2026', 22, 17, 26, 65, '0', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 'April-2026', 100, 100, 100, 300, '', '{\"fpcu\":[\"1\",\"2\",\"3\",\"6\"],\"fpnapm\":[\"4\",\"5\",\"6\",\"15\"],\"fpoa\":[\"7\",\"8\",\"9\",\"24\"],\"fpdo\":[\"10\",\"11\",\"12\",\"33\"],\"fpcueo\":[\"13\",\"14\",\"15\",\"42\"],\"fpnapm2\":[\"16\",\"17\",\"18\",\"51\"]}', '{\"fpcu\":[\"19\",\"20\",\"21\",\"60\"],\"fpnapm\":[\"22\",\"23\",\"24\",\"69\"],\"fpoa\":[\"25\",\"26\",\"27\",\"78\"],\"fpdo\":[\"28\",\"29\",\"30\",\"87\"],\"fpcueo\":[\"31\",\"32\",\"33\",\"96\"],\"fpnapm2\":[\"34\",\"35\",\"36\",\"105\"]}', '{\"fpcu\":[\"37\",\"38\",\"39\",\"114\"],\"fpnapm\":[\"40\",\"41\",\"42\",\"123\"],\"fpoa\":[\"43\",\"44\",\"45\",\"132\"],\"fpdo\":[\"46\",\"47\",\"48\",\"141\"],\"fpcueo\":[\"49\",\"50\",\"51\",\"150\"],\"fpnapm2\":[\"52\",\"53\",\"54\",\"159\"]}', '{\"fpcu\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm\":[\"0\",\"0\",\"0\",\"0\"],\"fpoa\":[\"0\",\"0\",\"0\",\"0\"],\"fpdo\":[\"0\",\"0\",\"0\",\"0\"],\"fpcueo\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm2\":[\"0\",\"0\",\"0\",\"0\"]}', '{\"fpcu\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm\":[\"0\",\"0\",\"0\",\"0\"],\"fpoa\":[\"0\",\"0\",\"0\",\"0\"],\"fpdo\":[\"0\",\"0\",\"0\",\"0\"],\"fpcueo\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm2\":[\"0\",\"0\",\"0\",\"0\"]}', '{\"fpcu\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm\":[\"0\",\"0\",\"0\",\"0\"],\"fpoa\":[\"0\",\"0\",\"0\",\"0\"],\"fpdo\":[\"0\",\"0\",\"0\",\"0\"],\"fpcueo\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm2\":[\"0\",\"0\",\"0\",\"0\"]}', '{\"fpcu\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm\":[\"0\",\"0\",\"0\",\"0\"],\"fpoa\":[\"0\",\"0\",\"0\",\"0\"],\"fpdo\":[\"0\",\"0\",\"0\",\"0\"],\"fpcueo\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm2\":[\"0\",\"0\",\"0\",\"0\"]}', '{\"fpcu\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm\":[\"0\",\"0\",\"0\",\"0\"],\"fpoa\":[\"0\",\"0\",\"0\",\"0\"],\"fpdo\":[\"0\",\"0\",\"0\",\"0\"],\"fpcueo\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm2\":[\"0\",\"0\",\"0\",\"0\"]}', '{\"fpcu\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm\":[\"0\",\"0\",\"0\",\"0\"],\"fpoa\":[\"0\",\"0\",\"0\",\"0\"],\"fpdo\":[\"0\",\"0\",\"0\",\"0\"],\"fpcueo\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm2\":[\"0\",\"0\",\"0\",\"0\"]}', '{\"fpcu\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm\":[\"0\",\"0\",\"0\",\"0\"],\"fpoa\":[\"0\",\"0\",\"0\",\"0\"],\"fpdo\":[\"0\",\"0\",\"0\",\"0\"],\"fpcueo\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm2\":[\"0\",\"0\",\"0\",\"0\"]}', '{\"fpcu\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm\":[\"0\",\"0\",\"0\",\"0\"],\"fpoa\":[\"0\",\"0\",\"0\",\"0\"],\"fpdo\":[\"0\",\"0\",\"0\",\"0\"],\"fpcueo\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm2\":[\"0\",\"0\",\"0\",\"0\"]}', '{\"fpcu\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm\":[\"0\",\"0\",\"0\",\"0\"],\"fpoa\":[\"0\",\"0\",\"0\",\"0\"],\"fpdo\":[\"0\",\"0\",\"0\",\"0\"],\"fpcueo\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm2\":[\"0\",\"0\",\"0\",\"0\"]}', '{\"fpcu\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm\":[\"0\",\"0\",\"0\",\"0\"],\"fpoa\":[\"0\",\"0\",\"0\",\"0\"],\"fpdo\":[\"0\",\"0\",\"0\",\"0\"],\"fpcueo\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm2\":[\"0\",\"0\",\"0\",\"0\"]}', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 'baadasaaa-asdsada', 0, 0, 0, 0, '', '{\"fpcu\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm\":[\"0\",\"0\",\"0\",\"0\"],\"fpoa\":[\"0\",\"0\",\"0\",\"0\"],\"fpdo\":[\"0\",\"0\",\"0\",\"0\"],\"fpcueo\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm2\":[\"0\",\"0\",\"0\",\"0\"]}', '{\"fpcu\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm\":[\"0\",\"0\",\"0\",\"0\"],\"fpoa\":[\"0\",\"0\",\"0\",\"0\"],\"fpdo\":[\"0\",\"0\",\"0\",\"0\"],\"fpcueo\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm2\":[\"0\",\"0\",\"0\",\"0\"]}', '{\"fpcu\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm\":[\"0\",\"0\",\"0\",\"0\"],\"fpoa\":[\"0\",\"0\",\"0\",\"0\"],\"fpdo\":[\"0\",\"0\",\"0\",\"0\"],\"fpcueo\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm2\":[\"0\",\"0\",\"0\",\"0\"]}', '{\"fpcu\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm\":[\"0\",\"0\",\"0\",\"0\"],\"fpoa\":[\"0\",\"0\",\"0\",\"0\"],\"fpdo\":[\"0\",\"0\",\"0\",\"0\"],\"fpcueo\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm2\":[\"0\",\"0\",\"0\",\"0\"]}', '{\"fpcu\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm\":[\"0\",\"0\",\"0\",\"0\"],\"fpoa\":[\"0\",\"0\",\"0\",\"0\"],\"fpdo\":[\"0\",\"0\",\"0\",\"0\"],\"fpcueo\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm2\":[\"0\",\"0\",\"0\",\"0\"]}', '{\"fpcu\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm\":[\"0\",\"0\",\"0\",\"0\"],\"fpoa\":[\"0\",\"0\",\"0\",\"0\"],\"fpdo\":[\"0\",\"0\",\"0\",\"0\"],\"fpcueo\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm2\":[\"0\",\"0\",\"0\",\"0\"]}', '{\"fpcu\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm\":[\"0\",\"0\",\"0\",\"0\"],\"fpoa\":[\"0\",\"0\",\"0\",\"0\"],\"fpdo\":[\"0\",\"0\",\"0\",\"0\"],\"fpcueo\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm2\":[\"0\",\"0\",\"0\",\"0\"]}', '{\"fpcu\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm\":[\"0\",\"0\",\"0\",\"0\"],\"fpoa\":[\"0\",\"0\",\"0\",\"0\"],\"fpdo\":[\"0\",\"0\",\"0\",\"0\"],\"fpcueo\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm2\":[\"0\",\"0\",\"0\",\"0\"]}', '{\"fpcu\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm\":[\"0\",\"0\",\"0\",\"0\"],\"fpoa\":[\"0\",\"0\",\"0\",\"0\"],\"fpdo\":[\"0\",\"0\",\"0\",\"0\"],\"fpcueo\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm2\":[\"0\",\"0\",\"0\",\"0\"]}', '{\"fpcu\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm\":[\"0\",\"0\",\"0\",\"0\"],\"fpoa\":[\"0\",\"0\",\"0\",\"0\"],\"fpdo\":[\"0\",\"0\",\"0\",\"0\"],\"fpcueo\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm2\":[\"0\",\"0\",\"0\",\"0\"]}', '{\"fpcu\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm\":[\"0\",\"0\",\"0\",\"0\"],\"fpoa\":[\"0\",\"0\",\"0\",\"0\"],\"fpdo\":[\"0\",\"0\",\"0\",\"0\"],\"fpcueo\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm2\":[\"0\",\"0\",\"0\",\"0\"]}', '{\"fpcu\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm\":[\"0\",\"0\",\"0\",\"0\"],\"fpoa\":[\"0\",\"0\",\"0\",\"0\"],\"fpdo\":[\"0\",\"0\",\"0\",\"0\"],\"fpcueo\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm2\":[\"0\",\"0\",\"0\",\"0\"]}', '{\"fpcu\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm\":[\"0\",\"0\",\"0\",\"0\"],\"fpoa\":[\"0\",\"0\",\"0\",\"0\"],\"fpdo\":[\"0\",\"0\",\"0\",\"0\"],\"fpcueo\":[\"0\",\"0\",\"0\",\"0\"],\"fpnapm2\":[\"0\",\"0\",\"0\",\"0\"]}', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `m1brgy_section_b`
--

CREATE TABLE `m1brgy_section_b` (
  `id` int(11) NOT NULL,
  `month_year_id` int(11) NOT NULL,
  `1A_OP1` int(11) NOT NULL,
  `1A_OP2` int(11) NOT NULL,
  `1A_OP3` int(11) NOT NULL,
  `1B_OP1` int(11) NOT NULL,
  `1B_OP2` int(11) NOT NULL,
  `1B_OP3` int(11) NOT NULL,
  `1B_A_OP1` int(11) NOT NULL,
  `1B_A_OP2` int(11) NOT NULL,
  `1B_A_OP3` int(11) NOT NULL,
  `1B_B_OP1` int(11) NOT NULL,
  `1B_B_OP2` int(11) NOT NULL,
  `1B_B_OP3` int(11) NOT NULL,
  `1C_OP1` int(11) NOT NULL,
  `1C_OP2` int(11) NOT NULL,
  `1C_OP3` int(11) NOT NULL,
  `1C_A_OP1` int(11) NOT NULL,
  `1C_A_OP2` int(11) NOT NULL,
  `1C_A_OP3` int(11) NOT NULL,
  `1C_B_OP1` int(11) NOT NULL,
  `1C_B_OP2` int(11) NOT NULL,
  `1C_B_OP3` int(11) NOT NULL,
  `1C_C_OP1` int(11) NOT NULL,
  `1C_C_OP2` int(11) NOT NULL,
  `1C_C_OP3` int(11) NOT NULL,
  `2A_OP1` int(11) NOT NULL,
  `2A_OP2` int(11) NOT NULL,
  `2A_OP3` int(11) NOT NULL,
  `2B_OP1` int(11) NOT NULL,
  `2B_OP2` int(11) NOT NULL,
  `2B_OP3` int(11) NOT NULL,
  `2C_OP1` int(11) NOT NULL,
  `2C_OP2` int(11) NOT NULL,
  `2C_OP3` int(11) NOT NULL,
  `3A_OP1` int(11) NOT NULL,
  `3A_OP2` int(11) NOT NULL,
  `3A_OP3` int(11) NOT NULL,
  `3B_OP1` int(11) NOT NULL,
  `3B_OP2` int(11) NOT NULL,
  `3B_OP3` int(11) NOT NULL,
  `4_OP1` int(11) NOT NULL,
  `4_OP2` int(11) NOT NULL,
  `4_OP3` int(11) NOT NULL,
  `5_OP1` int(11) NOT NULL,
  `5_OP2` int(11) NOT NULL,
  `5_OP3` int(11) NOT NULL,
  `6_OP1` int(11) NOT NULL,
  `6_OP2` int(11) NOT NULL,
  `6_OP3` int(11) NOT NULL,
  `7_OP1` int(11) NOT NULL,
  `7_OP2` int(11) NOT NULL,
  `7_OP3` int(11) NOT NULL,
  `8A_OP1` int(11) NOT NULL,
  `8A_OP2` int(11) NOT NULL,
  `8A_OP3` int(11) NOT NULL,
  `8B_OP1` int(11) NOT NULL,
  `8B_OP2` int(11) NOT NULL,
  `8B_OP3` int(11) NOT NULL,
  `9A_OP1` int(11) NOT NULL,
  `9A_OP2` int(11) NOT NULL,
  `9A_OP3` int(11) NOT NULL,
  `9B_OP1` int(11) NOT NULL,
  `9B_OP2` int(11) NOT NULL,
  `9B_OP3` int(11) NOT NULL,
  `10A_OP1` int(11) NOT NULL,
  `10A_OP2` int(11) NOT NULL,
  `10A_OP3` int(11) NOT NULL,
  `10B_OP1` int(11) NOT NULL,
  `10B_OP2` int(11) NOT NULL,
  `10B_OP3` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m1brgy_section_c`
--

CREATE TABLE `m1brgy_section_c` (
  `id` int(100) NOT NULL,
  `month_year_id` int(100) NOT NULL,
  `A1_CPAB_M` int(100) NOT NULL,
  `A1_CPAB_F` int(100) NOT NULL,
  `A1_BCG_1_M` int(100) NOT NULL,
  `A1_BCG_1_F` int(100) NOT NULL,
  `A1_BCG_2_M` int(100) NOT NULL,
  `A1_BCG_2_F` int(100) NOT NULL,
  `A2_HepB_1_M` int(100) NOT NULL,
  `A2_HepB_1_F` int(100) NOT NULL,
  `A2_HepB_2_M` int(100) NOT NULL,
  `A2_HepB_2_F` int(100) NOT NULL,
  `A2_HepB_3_M` int(100) NOT NULL,
  `A2_HepB_3_F` int(100) NOT NULL,
  `A2_OPV_1_M` int(100) NOT NULL,
  `A2_OPV_1_F` int(100) NOT NULL,
  `A2_OPV_2_M` int(100) NOT NULL,
  `A2_OPV_2_F` int(100) NOT NULL,
  `A2_OPV_3_M` int(100) NOT NULL,
  `A2_OPV_3_F` int(100) NOT NULL,
  `A2_IPV_1_M` int(100) NOT NULL,
  `A2_IPV_1_F` int(100) NOT NULL,
  `A2_IPV_2_M` int(100) NOT NULL,
  `A2_IPV_2_F` int(100) NOT NULL,
  `A2_PCV_1_M` int(100) NOT NULL,
  `A2_PCV_1_F` int(100) NOT NULL,
  `A2_PCV_2_M` int(100) NOT NULL,
  `A2_PCV_2_F` int(100) NOT NULL,
  `A2_PCV_3_M` int(100) NOT NULL,
  `A2_PCV_3_F` int(100) NOT NULL,
  `A2_MMR_1_M` int(100) NOT NULL,
  `A2_MMR_1_F` int(100) NOT NULL,
  `A2_FIC_M` int(100) NOT NULL,
  `A2_FIC_F` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m1brgy_section_d`
--

CREATE TABLE `m1brgy_section_d` (
  `id` int(100) NOT NULL,
  `month_year_id` int(100) NOT NULL,
  `BOHC_Fit_M` int(100) NOT NULL,
  `BOHC_Fit_F` int(100) NOT NULL,
  `BOHC_DMF_M` int(100) NOT NULL,
  `BOHC_DMF_F` int(100) NOT NULL,
  `BOHC_Infant_M` int(100) NOT NULL,
  `BOHC_Infant_F` int(100) NOT NULL,
  `BOHC_CH_1_M` int(100) NOT NULL,
  `BOHC_CH_1_F` int(100) NOT NULL,
  `BOHC_CH_2_M` int(100) NOT NULL,
  `BOHC_CH_2_F` int(100) NOT NULL,
  `BOHC_ADO_1_M` int(100) NOT NULL,
  `BOHC_ADO_1_F` int(100) NOT NULL,
  `BOHC_ADO_2_M` int(100) NOT NULL,
  `BOHC_ADO_2_F` int(100) NOT NULL,
  `BOHC_ADU_M` int(100) NOT NULL,
  `BOHC_ADU_F` int(100) NOT NULL,
  `BOHC_SEN_M` int(100) NOT NULL,
  `BOHC_SEN_F` int(100) NOT NULL,
  `BOHC_PREG_M` int(100) NOT NULL,
  `BOHC_PREG_F` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m1brgy_section_e`
--

CREATE TABLE `m1brgy_section_e` (
  `id` int(11) NOT NULL,
  `month_year_id` int(11) NOT NULL,
  `E1_1_M` int(11) NOT NULL,
  `E1_1_F` int(11) NOT NULL,
  `E1_1A_M` int(11) NOT NULL,
  `E1_1A_F` int(11) NOT NULL,
  `E1_1B_M` int(11) NOT NULL,
  `E1_1B_F` int(11) NOT NULL,
  `E1_1C_M` int(11) NOT NULL,
  `E1_1C_F` int(11) NOT NULL,
  `E1_1D_M` int(11) NOT NULL,
  `E1_1D_F` int(11) NOT NULL,
  `E1_1E_M` int(11) NOT NULL,
  `E1_1E_F` int(11) NOT NULL,
  `E1_1F_M` int(11) NOT NULL,
  `E1_1F_F` int(11) NOT NULL,
  `E1_2_M` int(11) NOT NULL,
  `E1_2_F` int(11) NOT NULL,
  `E1_2A_M` int(11) NOT NULL,
  `E1_2A_F` int(11) NOT NULL,
  `E1_2B_M` int(11) NOT NULL,
  `E1_2B_F` int(11) NOT NULL,
  `E1_2C_M` int(11) NOT NULL,
  `E1_2C_F` int(11) NOT NULL,
  `E1_2D_M` int(11) NOT NULL,
  `E1_2D_F` int(11) NOT NULL,
  `E1_2E_M` int(11) NOT NULL,
  `E1_2E_F` int(11) NOT NULL,
  `E1_2F_M` int(11) NOT NULL,
  `E1_2F_F` int(11) NOT NULL,
  `E2_1_M` int(11) NOT NULL,
  `E2_1_F` int(11) NOT NULL,
  `E2_2_M` int(11) NOT NULL,
  `E2_2_F` int(11) NOT NULL,
  `E2_2A_M` int(11) NOT NULL,
  `E2_2A_F` int(11) NOT NULL,
  `E2_2B_M` int(11) NOT NULL,
  `E2_2B_F` int(11) NOT NULL,
  `E2_3_M` int(11) NOT NULL,
  `E2_3_F` int(11) NOT NULL,
  `E2_4_M` int(11) NOT NULL,
  `E2_4_F` int(11) NOT NULL,
  `E2_4A_M` int(11) NOT NULL,
  `E2_4A_F` int(11) NOT NULL,
  `E2_4B_M` int(11) NOT NULL,
  `E2_4B_F` int(11) NOT NULL,
  `E3_1_M` int(11) NOT NULL,
  `E3_1_F` int(11) NOT NULL,
  `E3_2_M` int(11) NOT NULL,
  `E3_2_F` int(11) NOT NULL,
  `E3_2A_M` int(11) NOT NULL,
  `E3_2A_F` int(11) NOT NULL,
  `E3_2B_M` int(11) NOT NULL,
  `E3_2B_F` int(11) NOT NULL,
  `E3_3_M` int(11) NOT NULL,
  `E3_3_F` int(11) NOT NULL,
  `E3_4_M` int(11) NOT NULL,
  `E3_4_F` int(11) NOT NULL,
  `E3_4A_M` int(11) NOT NULL,
  `E3_4A_F` int(11) NOT NULL,
  `E3_4B_M` int(11) NOT NULL,
  `E3_4B_F` int(11) NOT NULL,
  `E4_1_M` int(11) NOT NULL,
  `E4_1_F` int(11) NOT NULL,
  `E4_2_M` int(11) NOT NULL,
  `E4_2_F` int(11) NOT NULL,
  `E4_3_M` int(11) NOT NULL,
  `E4_3_F` int(11) NOT NULL,
  `E5_1_M` int(11) NOT NULL,
  `E5_1_F` int(11) NOT NULL,
  `E5_2_M` int(11) NOT NULL,
  `E5_2_F` int(11) NOT NULL,
  `E5_3_M` int(11) NOT NULL,
  `E5_3_F` int(11) NOT NULL,
  `E5_4_M` int(11) NOT NULL,
  `E5_4_F` int(11) NOT NULL,
  `E6_1_M` int(11) NOT NULL,
  `E6_1_F` int(11) NOT NULL,
  `E6_1A_M` int(11) NOT NULL,
  `E6_1A_F` int(11) NOT NULL,
  `E6_1B_M` int(11) NOT NULL,
  `E6_1B_F` int(11) NOT NULL,
  `E6_1C_M` int(11) NOT NULL,
  `E6_1C_F` int(11) NOT NULL,
  `E6_1D_M` int(11) NOT NULL,
  `E6_1D_F` int(11) NOT NULL,
  `E6_2_M` int(11) NOT NULL,
  `E6_2_F` int(11) NOT NULL,
  `E6_3_M` int(11) NOT NULL,
  `E6_3_F` int(11) NOT NULL,
  `E6_3A_M` int(11) NOT NULL,
  `E6_3A_F` int(11) NOT NULL,
  `E6_3B_M` int(11) NOT NULL,
  `E6_3B_F` int(11) NOT NULL,
  `E6_4_M` int(11) NOT NULL,
  `E6_4_F` int(11) NOT NULL,
  `E6_5_M` int(11) NOT NULL,
  `E6_5_F` int(11) NOT NULL,
  `E6_5A_M` int(11) NOT NULL,
  `E6_5A_F` int(11) NOT NULL,
  `E6_5B_M` int(11) NOT NULL,
  `E6_5B_F` int(11) NOT NULL,
  `E7_1_M` int(11) NOT NULL,
  `E7_1_F` int(11) NOT NULL,
  `E7_1A_M` int(11) NOT NULL,
  `E7_1A_F` int(11) NOT NULL,
  `E7_1B_M` int(11) NOT NULL,
  `E7_1B_F` int(11) NOT NULL,
  `E7_2_M` int(11) NOT NULL,
  `E7_2_F` int(11) NOT NULL,
  `E7_2A_M` int(11) NOT NULL,
  `E7_2A_F` int(11) NOT NULL,
  `E7_2B_M` int(11) NOT NULL,
  `E7_2B_F` int(11) NOT NULL,
  `E7_3_M` int(11) NOT NULL,
  `E7_3_F` int(11) NOT NULL,
  `E7_4_M` int(11) NOT NULL,
  `E7_4_F` int(11) NOT NULL,
  `E7_4A_M` int(11) NOT NULL,
  `E7_4A_F` int(11) NOT NULL,
  `E7_4B_M` int(11) NOT NULL,
  `E7_4B_F` int(11) NOT NULL,
  `E7_5_M` int(11) NOT NULL,
  `E7_5_F` int(11) NOT NULL,
  `E7_5A_M` int(11) NOT NULL,
  `E7_5A_F` int(11) NOT NULL,
  `E7_6_M` int(11) NOT NULL,
  `E7_6_F` int(11) NOT NULL,
  `E8_MENTAL_M` int(11) NOT NULL,
  `E8_MENTAL_F` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m1brgy_section_f`
--

CREATE TABLE `m1brgy_section_f` (
  `id` int(11) NOT NULL,
  `month_year_id` int(11) NOT NULL,
  `GW_1` int(11) NOT NULL,
  `GW_1A` int(11) NOT NULL,
  `GW_1B` int(11) NOT NULL,
  `GW_1C` int(11) NOT NULL,
  `GW_2` int(11) NOT NULL,
  `GS_1` int(11) NOT NULL,
  `GS_1A` int(11) NOT NULL,
  `GS_1B` int(11) NOT NULL,
  `GS_1C` int(11) NOT NULL,
  `GS_2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m1brgy_section_g`
--

CREATE TABLE `m1brgy_section_g` (
  `id` int(11) NOT NULL,
  `month_year_id` int(11) NOT NULL,
  `A_1_M` int(11) NOT NULL,
  `A_1_F` int(11) NOT NULL,
  `A_2_M` int(11) NOT NULL,
  `A_2_F` int(11) NOT NULL,
  `A_3_M` int(11) NOT NULL,
  `A_3_F` int(11) NOT NULL,
  `B_1_M` int(11) NOT NULL,
  `B_1_F` int(11) NOT NULL,
  `B_2_M` int(11) NOT NULL,
  `B_2_F` int(11) NOT NULL,
  `C_1_M` int(11) NOT NULL,
  `C_1_F` int(11) NOT NULL,
  `C_2_M` int(11) NOT NULL,
  `C_2_F` int(11) NOT NULL,
  `C_3_M` int(11) NOT NULL,
  `C_3_F` int(11) NOT NULL,
  `C_4_M` int(11) NOT NULL,
  `C_4_F` int(11) NOT NULL,
  `C_5_M` int(11) NOT NULL,
  `C_5_F` int(11) NOT NULL,
  `C_6_M` int(11) NOT NULL,
  `C_6_F` int(11) NOT NULL,
  `C_7_M` int(11) NOT NULL,
  `C_7_F` int(11) NOT NULL,
  `C_8_M` int(11) NOT NULL,
  `C_8_F` int(11) NOT NULL,
  `C_9_M` int(11) NOT NULL,
  `C_9_F` int(11) NOT NULL,
  `D_1_M` int(11) NOT NULL,
  `D_1_F` int(11) NOT NULL,
  `D_2_M` int(11) NOT NULL,
  `D_2_F` int(11) NOT NULL,
  `D_3_M` int(11) NOT NULL,
  `D_3_F` int(11) NOT NULL,
  `D_4_M` int(11) NOT NULL,
  `D_4_F` int(11) NOT NULL,
  `D_5_M` int(11) NOT NULL,
  `D_5_F` int(11) NOT NULL,
  `E_1_M` int(11) NOT NULL,
  `E_1_F` int(11) NOT NULL,
  `E_2_M` int(11) NOT NULL,
  `E_2_F` int(11) NOT NULL,
  `F_1_M` int(11) NOT NULL,
  `F_1_F` int(11) NOT NULL,
  `F_1A_M` int(11) NOT NULL,
  `F_1A_F` int(11) NOT NULL,
  `F_1B_M` int(11) NOT NULL,
  `F_1B_F` int(11) NOT NULL,
  `F_1C_M` int(11) NOT NULL,
  `F_1C_F` int(11) NOT NULL,
  `F_2_M` int(11) NOT NULL,
  `F_2_F` int(11) NOT NULL,
  `F_2A_M` int(11) NOT NULL,
  `F_2A_F` int(11) NOT NULL,
  `F_2B_M` int(11) NOT NULL,
  `F_2B_F` int(11) NOT NULL,
  `F_2C_M` int(11) NOT NULL,
  `F_2C_F` int(11) NOT NULL,
  `F_3_M` int(11) NOT NULL,
  `F_3_F` int(11) NOT NULL,
  `F_3A_M` int(11) NOT NULL,
  `F_3A_F` int(11) NOT NULL,
  `F_3B_M` int(11) NOT NULL,
  `F_3B_F` int(11) NOT NULL,
  `F_3C_M` int(11) NOT NULL,
  `F_3C_F` int(11) NOT NULL,
  `F_4_M` int(11) NOT NULL,
  `F_4_F` int(11) NOT NULL,
  `F_4A_M` int(11) NOT NULL,
  `F_4A_F` int(11) NOT NULL,
  `F_4B_M` int(11) NOT NULL,
  `F_4B_F` int(11) NOT NULL,
  `F_4C_M` int(11) NOT NULL,
  `F_4C_F` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m1brgy_section_h`
--

CREATE TABLE `m1brgy_section_h` (
  `id` int(11) NOT NULL,
  `month_year_id` int(11) NOT NULL,
  `P1_Total_1` int(11) NOT NULL,
  `P1_Total_2` int(11) NOT NULL,
  `P1_Total_3` int(11) NOT NULL,
  `P1_Direct_1` int(11) NOT NULL,
  `P1_Direct_2` int(11) NOT NULL,
  `P1_Direct_3` int(11) NOT NULL,
  `P1_ResidentA_1` int(11) NOT NULL,
  `P1_ResidentA_2` int(11) NOT NULL,
  `P1_ResidentA_3` int(11) NOT NULL,
  `P1_NonResidentA_1` int(11) NOT NULL,
  `P1_NonResidentA_2` int(11) NOT NULL,
  `P1_NonResidentA_3` int(11) NOT NULL,
  `P1_Indirect_1` int(11) NOT NULL,
  `P1_Indirect_2` int(11) NOT NULL,
  `P1_Indirect_3` int(11) NOT NULL,
  `P1_ResidentB_1` int(11) NOT NULL,
  `P1_ResidentB_2` int(11) NOT NULL,
  `P1_ResidentB_3` int(11) NOT NULL,
  `P1_NonResidentB_1` int(11) NOT NULL,
  `P1_NonResidentB_2` int(11) NOT NULL,
  `P1_NonResidentB_3` int(11) NOT NULL,
  `P2_LiveBirths_M` int(11) NOT NULL,
  `P2_LiveBirths_F` int(11) NOT NULL,
  `P2_ABR_M` int(11) NOT NULL,
  `P2_ABR_F` int(11) NOT NULL,
  `P2_ABRA_M` int(11) NOT NULL,
  `P2_ABRA_F` int(11) NOT NULL,
  `P2_ABRB_M` int(11) NOT NULL,
  `P2_ABRB_F` int(11) NOT NULL,
  `P2_ABRC_M` int(11) NOT NULL,
  `P2_ABRC_F` int(11) NOT NULL,
  `P2_TD_1_M` int(11) NOT NULL,
  `P2_TD_1_F` int(11) NOT NULL,
  `P2_TD_2_M` int(11) NOT NULL,
  `P2_TD_2_F` int(11) NOT NULL,
  `P2_TD_3_M` int(11) NOT NULL,
  `P2_TD_3_F` int(11) NOT NULL,
  `P2_TD_4_M` int(11) NOT NULL,
  `P2_TD_4_F` int(11) NOT NULL,
  `P2_TD_5_M` int(11) NOT NULL,
  `P2_TD_5_F` int(11) NOT NULL,
  `P2_TD_6A_M` int(11) NOT NULL,
  `P2_TD_6A_F` int(11) NOT NULL,
  `P2_TD_6B_M` int(11) NOT NULL,
  `P2_TD_6B_F` int(11) NOT NULL
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

-- --------------------------------------------------------

--
-- Table structure for table `vital_mortality`
--

CREATE TABLE `vital_mortality` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` int(10) UNSIGNED NOT NULL COMMENT 'Parent form / survey record',
  `indicator` varchar(500) NOT NULL COMMENT 'Row label / indicator name',
  `age_10_14` decimal(15,2) DEFAULT NULL,
  `age_15_19` decimal(15,2) DEFAULT NULL,
  `age_20_49` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vital_mortality`
--

INSERT INTO `vital_mortality` (`id`, `record_id`, `indicator`, `age_10_14`, `age_15_19`, `age_20_49`, `total`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 2, 'Maternal Mortality - Total', 0.00, 0.00, 0.00, 0.00, '', '2026-05-21 23:03:37', '2026-05-21 23:03:37'),
(2, 2, 'a. Direct', 0.00, 0.00, 0.00, 0.00, '', '2026-05-21 23:03:37', '2026-05-21 23:03:37'),
(3, 2, 'a1. Resident', 0.00, 0.00, 0.00, 0.00, '', '2026-05-21 23:03:37', '2026-05-21 23:03:37'),
(4, 2, 'a2. Non-resident', 0.00, 0.00, 0.00, 0.00, '', '2026-05-21 23:03:37', '2026-05-21 23:03:37'),
(5, 2, 'b. Indirect', 0.00, 0.00, 0.00, 0.00, '', '2026-05-21 23:03:37', '2026-05-21 23:03:37'),
(6, 2, 'b1. Resident', 0.00, 0.00, 0.00, 0.00, '', '2026-05-21 23:03:37', '2026-05-21 23:03:37'),
(7, 2, 'b2. Non-resident', 0.00, 0.00, 0.00, 0.00, '', '2026-05-21 23:03:37', '2026-05-21 23:03:37');

-- --------------------------------------------------------

--
-- Table structure for table `vital_natality`
--

CREATE TABLE `vital_natality` (
  `id` int(10) UNSIGNED NOT NULL,
  `record_id` int(10) UNSIGNED NOT NULL COMMENT 'Parent form / survey record',
  `indicator` varchar(500) NOT NULL COMMENT 'Row label / indicator name',
  `male` decimal(15,2) DEFAULT NULL,
  `female` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vital_natality`
--

INSERT INTO `vital_natality` (`id`, `record_id`, `indicator`, `male`, `female`, `total`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 2, 'Live births', NULL, NULL, NULL, '', '2026-05-21 23:03:37', '2026-05-21 23:03:37'),
(2, 2, 'Adolescent Birth Rate (ABR)', NULL, NULL, NULL, '', '2026-05-21 23:03:37', '2026-05-21 23:03:37'),
(3, 2, 'a. <10 YEARS OLD', NULL, NULL, NULL, '', '2026-05-21 23:03:37', '2026-05-21 23:03:37'),
(4, 2, 'b. 10-14 years old', NULL, NULL, NULL, '', '2026-05-21 23:03:37', '2026-05-21 23:03:37'),
(5, 2, 'c. 15-19 years old', NULL, NULL, NULL, '', '2026-05-21 23:03:37', '2026-05-21 23:03:37'),
(6, 2, 'Total Deaths', NULL, NULL, NULL, '', '2026-05-21 23:03:37', '2026-05-21 23:03:37'),
(7, 2, 'Under-five Deaths', NULL, NULL, NULL, '', '2026-05-21 23:03:37', '2026-05-21 23:03:37'),
(8, 2, 'Infant Deaths', NULL, NULL, NULL, '', '2026-05-21 23:03:37', '2026-05-21 23:03:37'),
(9, 2, 'Neonatal Deaths', NULL, NULL, NULL, '', '2026-05-21 23:03:37', '2026-05-21 23:03:37'),
(10, 2, 'Perinatal Deaths - Total', NULL, NULL, NULL, '', '2026-05-21 23:03:37', '2026-05-21 23:03:37'),
(11, 2, '6a. Fetal Deaths', NULL, NULL, NULL, '', '2026-05-21 23:03:37', '2026-05-21 23:03:37'),
(12, 2, '6b. Early Neonatal Deaths', NULL, NULL, NULL, '', '2026-05-21 23:03:37', '2026-05-21 23:03:37');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `m1brgy_section_a`
--
ALTER TABLE `m1brgy_section_a`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m1brgy_section_b`
--
ALTER TABLE `m1brgy_section_b`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m1brgy_section_c`
--
ALTER TABLE `m1brgy_section_c`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m1brgy_section_d`
--
ALTER TABLE `m1brgy_section_d`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m1brgy_section_e`
--
ALTER TABLE `m1brgy_section_e`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m1brgy_section_f`
--
ALTER TABLE `m1brgy_section_f`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m1brgy_section_g`
--
ALTER TABLE `m1brgy_section_g`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m1brgy_section_h`
--
ALTER TABLE `m1brgy_section_h`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `a_demand`
--
ALTER TABLE `a_demand`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `a_modern`
--
ALTER TABLE `a_modern`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `b_prenatal`
--
ALTER TABLE `b_prenatal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `m1brgy_section_a`
--
ALTER TABLE `m1brgy_section_a`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `m1brgy_section_b`
--
ALTER TABLE `m1brgy_section_b`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m1brgy_section_c`
--
ALTER TABLE `m1brgy_section_c`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m1brgy_section_d`
--
ALTER TABLE `m1brgy_section_d`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m1brgy_section_e`
--
ALTER TABLE `m1brgy_section_e`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m1brgy_section_f`
--
ALTER TABLE `m1brgy_section_f`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m1brgy_section_g`
--
ALTER TABLE `m1brgy_section_g`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m1brgy_section_h`
--
ALTER TABLE `m1brgy_section_h`
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
