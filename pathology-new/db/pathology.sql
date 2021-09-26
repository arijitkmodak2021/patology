-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2021 at 08:48 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pathology`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctor_list`
--

CREATE TABLE `doctor_list` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doctor_list`
--

INSERT INTO `doctor_list` (`id`, `name`, `details`, `status`) VALUES
(1, 'Arijit Kumar Modak', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `patient_details`
--

CREATE TABLE `patient_details` (
  `id` int(11) NOT NULL,
  `patient_id` varchar(255) NOT NULL,
  `registration_no` varchar(255) NOT NULL,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `gender` char(1) NOT NULL,
  `dob` date NOT NULL,
  `age` int(11) NOT NULL,
  `mobile_no` varchar(255) NOT NULL,
  `height` varchar(100) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `word_no` int(11) NOT NULL,
  `word_name` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `doctor_name` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient_details`
--

INSERT INTO `patient_details` (`id`, `patient_id`, `registration_no`, `name`, `image`, `gender`, `dob`, `age`, `mobile_no`, `height`, `weight`, `blood_group`, `address`, `word_no`, `word_name`, `created_by`, `doctor_name`, `created_date`, `modified_by`, `modified_date`, `status`) VALUES
(5, 'P-202189637', 'reg-1234567890', 'Jane Doe', '', 'F', '1970-01-01', 24, '9123456789', '5\"7\'', '68', 'B+', '12/3 Sample Road, Newcity, Dist1, West Bengal, 75321', 2, 'Word No 2', 'operator_01', 'Arijit Kumar Modak', '2021-09-25 00:00:00', 0, '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `patient_report`
--

CREATE TABLE `patient_report` (
  `id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `patient_id` varchar(255) NOT NULL,
  `cat_grp_name` varchar(255) NOT NULL,
  `main_cat_id` int(11) NOT NULL,
  `main_cat_name` varchar(255) NOT NULL,
  `test_type_id` int(11) NOT NULL,
  `test_type_name` varchar(255) NOT NULL,
  `test_type_unit` varchar(255) NOT NULL,
  `normal_range` varchar(255) NOT NULL,
  `result_value` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient_report`
--

INSERT INTO `patient_report` (`id`, `p_id`, `report_id`, `patient_id`, `cat_grp_name`, `main_cat_id`, `main_cat_name`, `test_type_id`, `test_type_name`, `test_type_unit`, `normal_range`, `result_value`, `create_date`, `status`) VALUES
(2, 5, 6, '0', 'Blood Test', 1, 'BIO-CHEMISTRY', 10, 'Blood Urea', 'mg/dl', '15 - 45', '1', '2021-09-26 00:00:00', 1),
(3, 5, 6, '0', 'Blood Test', 1, 'BIO-CHEMISTRY', 6, 'Fasting', 'mg/dl', '60 - 110', '2', '2021-09-26 00:00:00', 1),
(4, 5, 6, '0', 'Blood Test', 1, 'BIO-CHEMISTRY', 8, 'Post Prantial', 'mg/dl', '80 - 160', '3', '2021-09-26 00:00:00', 1),
(5, 5, 6, '0', 'Blood Test', 1, 'BIO-CHEMISTRY', 9, 'Random', 'mg/dl', '80 - 140', '4', '2021-09-26 00:00:00', 1),
(6, 5, 6, '0', 'Blood Test', 1, 'BIO-CHEMISTRY', 13, 'Serum Calcium', 'mg/dl', '8.5 - 11.00', '5', '2021-09-26 00:00:00', 1),
(7, 5, 6, '0', 'Blood Test', 1, 'BIO-CHEMISTRY', 11, 'Serum Creatinine', 'mg/dl', '0.6 - 1.5', '6', '2021-09-26 00:00:00', 1),
(8, 5, 6, '0', 'Blood Test', 1, 'BIO-CHEMISTRY', 12, 'Serum T.Cholesterol', 'mg/dl', '150 - 200', '7', '2021-09-26 00:00:00', 1),
(9, 5, 6, '0', 'Blood Test', 1, 'BIO-CHEMISTRY', 7, 'Serum Uric Acid', 'mg/dl', '1.5 - 7.0', '9', '2021-09-26 00:00:00', 1),
(10, 5, 6, '0', 'Blood Test', 2, 'DIFFERENTIAL COUNT', 40, 'Absolute Eosinophils Count', 'Ce', '40 - 440 Ce/Cumm', '1', '2021-09-26 00:00:00', 1),
(11, 5, 6, '0', 'Blood Test', 2, 'DIFFERENTIAL COUNT', 37, 'BASOPHIL', '%', '0 - 1 %', '3', '2021-09-26 00:00:00', 1),
(12, 5, 6, '0', 'Blood Test', 2, 'DIFFERENTIAL COUNT', 42, 'BI Group', '', '', '4', '2021-09-26 00:00:00', 1),
(13, 5, 6, '0', 'Blood Test', 2, 'DIFFERENTIAL COUNT', 44, 'Bleeding Time', 'Mts', '1 - 6 Mts', '5', '2021-09-26 00:00:00', 1),
(14, 5, 6, '0', 'Blood Test', 2, 'DIFFERENTIAL COUNT', 45, 'Clotting Time', 'Mts', '8 - 18 Mts', '6', '2021-09-26 00:00:00', 1),
(15, 5, 6, '0', 'Blood Test', 2, 'DIFFERENTIAL COUNT', 35, 'EOSINOPHILS', '%', '1 - 6 %', '8', '2021-09-26 00:00:00', 1),
(16, 5, 6, '0', 'Blood Test', 2, 'DIFFERENTIAL COUNT', 38, 'ESR: 1 / 2 Hour', 'mm', 'M 7 - 15', '8', '2021-09-26 00:00:00', 1),
(17, 5, 6, '0', 'Blood Test', 2, 'DIFFERENTIAL COUNT', 39, 'ESR: 1 Hour', 'mm', 'F 12 - 17', '9', '2021-09-26 00:00:00', 1),
(18, 5, 6, '0', 'Blood Test', 2, 'DIFFERENTIAL COUNT', 34, 'LYMPHOCYTES', '%', '35 - 55 %', '1', '2021-09-26 00:00:00', 1),
(19, 5, 6, '0', 'Blood Test', 2, 'DIFFERENTIAL COUNT', 47, 'M F', '', '', '2', '2021-09-26 00:00:00', 1),
(20, 5, 6, '0', 'Blood Test', 2, 'DIFFERENTIAL COUNT', 46, 'M P Card', '', '', '3', '2021-09-26 00:00:00', 1),
(21, 5, 6, '0', 'Blood Test', 2, 'DIFFERENTIAL COUNT', 36, 'MONOCYTE', '%', '2 - 8 %', '5', '2021-09-26 00:00:00', 1),
(22, 5, 6, '0', 'Blood Test', 2, 'DIFFERENTIAL COUNT', 33, 'N. POLYMORPHS', '%', '40 - 65 %', '7', '2021-09-26 00:00:00', 1),
(23, 5, 6, '0', 'Blood Test', 2, 'DIFFERENTIAL COUNT', 41, 'Platelet Count', 'Ce', '1 - 4 Lak Ce/Cumm', '5', '2021-09-26 00:00:00', 1),
(24, 5, 6, '0', 'Blood Test', 2, 'DIFFERENTIAL COUNT', 43, 'Rh. Typing', '', '', '7', '2021-09-26 00:00:00', 1),
(25, 5, 6, '0', 'Blood Test', 4, 'LIPID PROFILE', 16, 'HDL', 'mg/dl', '35 - 80', '1', '2021-09-26 00:00:00', 1),
(26, 5, 6, '0', 'Blood Test', 4, 'LIPID PROFILE', 17, 'LDL', 'mg/dl', '85 - 130', '2', '2021-09-26 00:00:00', 1),
(27, 5, 6, '0', 'Blood Test', 4, 'LIPID PROFILE', 14, 'T.Cholesterol', 'mg/dl', '125 - 200', '3', '2021-09-26 00:00:00', 1),
(28, 5, 6, '0', 'Blood Test', 4, 'LIPID PROFILE', 15, 'Triglycerides', 'mg/dl', '25 - 200', '4', '2021-09-26 00:00:00', 1),
(29, 5, 6, '0', 'Blood Test', 4, 'LIPID PROFILE', 18, 'VLDL', 'mg/dl', '05 - 40', '5', '2021-09-26 00:00:00', 1),
(30, 5, 6, '0', 'Blood Test', 5, 'SERUM WIDAL', 26, 'ACETONE', 'BILE PIGMENTS', '', '1', '2021-09-26 00:00:00', 1),
(31, 5, 6, '0', 'Blood Test', 5, 'SERUM WIDAL', 24, 'ALBUMIN', '', '', '2', '2021-09-26 00:00:00', 1),
(32, 5, 6, '0', 'Blood Test', 5, 'SERUM WIDAL', 23, 'APPEARANCE', '', '', '3', '2021-09-26 00:00:00', 1),
(33, 5, 6, '0', 'Blood Test', 5, 'SERUM WIDAL', 21, 'S PARA TYPHI AH', '', '', '4', '2021-09-26 00:00:00', 1),
(34, 5, 6, '0', 'Blood Test', 5, 'SERUM WIDAL', 22, 'S PARA TYPHI BH', '', '', '5', '2021-09-26 00:00:00', 1),
(35, 5, 6, '0', 'Blood Test', 5, 'SERUM WIDAL', 25, 'SUGAR', 'BILE SALTS', '', '8', '2021-09-26 00:00:00', 1),
(36, 5, 6, '0', 'Sort Blood Test', 3, 'HAEMATOLOGY', 29, 'HAEMOGLOBIN', 'gms%', 'M 13.5 - 15.5 / F 12.5 - 14.5 gms', '6', '2021-09-26 00:00:00', 1),
(37, 5, 6, '0', 'Sort Blood Test', 3, 'HAEMATOLOGY', 30, 'PACKED CELL VOLUME', '', 'F 36 - 47% / M 40 - 54%', '7', '2021-09-26 00:00:00', 1),
(38, 5, 6, '0', 'Sort Blood Test', 3, 'HAEMATOLOGY', 49, 'test 1', '45', '70 - 90 mg/l', '8', '2021-09-26 00:00:00', 1),
(39, 5, 6, '0', 'Sort Blood Test', 3, 'HAEMATOLOGY', 32, 'Total R.B.C Count', '', '4.5 - 6.5 Million/ Cumm', '8', '2021-09-26 00:00:00', 1),
(40, 5, 6, '0', 'Sort Blood Test', 3, 'HAEMATOLOGY', 31, 'Total W.B.C Count', '', '4000 - 10000 /Cumm', '9', '2021-09-26 00:00:00', 1),
(41, 5, 6, '0', 'Urine Test', 6, 'URINE ANALYSIS', 28, 'Deposits', '', '', '6', '2021-09-26 00:00:00', 1),
(42, 5, 6, '0', 'Urine Test', 6, 'URINE ANALYSIS', 27, 'URINE PREGNANCY', '', '', '7', '2021-09-26 00:00:00', 1),
(43, 5, 8, 'P-202189637', 'Sort Blood Test', 3, 'HAEMATOLOGY', 29, 'HAEMOGLOBIN', 'gms%', 'M 13.5 - 15.5 / F 12.5 - 14.5 gms', '16', '2021-09-26 00:00:00', 1),
(44, 5, 8, 'P-202189637', 'Sort Blood Test', 3, 'HAEMATOLOGY', 30, 'PACKED CELL VOLUME', '', 'F 36 - 47% / M 40 - 54%', '45', '2021-09-26 00:00:00', 1),
(45, 5, 8, 'P-202189637', 'Sort Blood Test', 3, 'HAEMATOLOGY', 32, 'Total R.B.C Count', '', '4.5 - 6.5 Million/ Cumm', '7', '2021-09-26 00:00:00', 1),
(46, 5, 8, 'P-202189637', 'Sort Blood Test', 3, 'HAEMATOLOGY', 31, 'Total W.B.C Count', '', '4000 - 10000 /Cumm', '400000', '2021-09-26 00:00:00', 1),
(47, 5, 8, 'P-202189637', 'Urine Test', 6, 'URINE ANALYSIS', 28, 'Deposits', '', '', '67', '2021-09-26 00:00:00', 1),
(48, 5, 8, 'P-202189637', 'Urine Test', 6, 'URINE ANALYSIS', 27, 'URINE PREGNANCY', '', '', '99', '2021-09-26 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `patient_tests`
--

CREATE TABLE `patient_tests` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `doctor_name` varchar(255) NOT NULL,
  `word_no` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `modified_by` varchar(255) NOT NULL,
  `modified_date` datetime NOT NULL,
  `create_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient_tests`
--

INSERT INTO `patient_tests` (`id`, `patient_id`, `created_by`, `doctor_name`, `word_no`, `notes`, `modified_by`, `modified_date`, `create_date`, `status`) VALUES
(6, 5, 'operator_01', 'Arijit Kumar Modak', 'Word No 2', '', '', '0000-00-00 00:00:00', '2021-09-26 00:00:00', 1),
(8, 5, 'operator_01', 'Arijit Kumar Modak', 'Word No 2', '', '', '0000-00-00 00:00:00', '2021-09-26 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tests_type`
--

CREATE TABLE `tests_type` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `serial_no` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `cost` decimal(10,8) DEFAULT NULL,
  `normal_range` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tests_type`
--

INSERT INTO `tests_type` (`id`, `category_id`, `serial_no`, `name`, `category_name`, `unit`, `cost`, `normal_range`, `status`) VALUES
(6, 1, 1, 'Fasting', 'BIO-CHEMISTRY', 'mg/dl', '99.99999999', '60 - 110', 1),
(7, 1, 8, 'Serum Uric Acid', 'BIO-CHEMISTRY', 'mg/dl', '99.99999999', '1.5 - 7.0', 1),
(8, 1, 3, 'Post Prantial', 'BIO-CHEMISTRY', 'mg/dl', '99.99999999', '80 - 160', 1),
(9, 1, 4, 'Random', 'BIO-CHEMISTRY', 'mg/dl', '99.99999999', '80 - 140', 1),
(10, 1, 5, 'Blood Urea', 'BIO-CHEMISTRY', 'mg/dl', '99.99999999', '15 - 45', 1),
(11, 1, 6, 'Serum Creatinine', 'BIO-CHEMISTRY', 'mg/dl', '99.99999999', '0.6 - 1.5', 1),
(12, 1, 7, 'Serum T.Cholesterol', 'BIO-CHEMISTRY', 'mg/dl', '99.99999999', '150 - 200', 1),
(13, 1, 9, 'Serum Calcium', 'BIO-CHEMISTRY', 'mg/dl', '99.99999999', '8.5 - 11.00', 1),
(14, 4, 10, 'T.Cholesterol', 'LIPID PROFILE', 'mg/dl', '99.99999999', '125 - 200', 1),
(15, 4, 11, 'Triglycerides', 'LIPID PROFILE', 'mg/dl', '99.99999999', '25 - 200', 1),
(16, 4, 12, 'HDL', 'LIPID PROFILE', 'mg/dl', '99.99999999', '35 - 80', 1),
(17, 4, 13, 'LDL', 'LIPID PROFILE', 'mg/dl', '99.99999999', '85 - 130', 1),
(18, 4, 14, 'VLDL', 'LIPID PROFILE', 'mg/dl', '50.00000000', '05 - 40', 1),
(19, 5, 15, 'S TYPHI \"O\"', 'SERUM WIDAL', '', '60.00000000', '', 1),
(20, 5, 16, 'S TYPHI \"H\"', 'SERUM WIDAL', '', '55.00000000', '', 1),
(21, 5, 17, 'S PARA TYPHI AH', 'SERUM WIDAL', '', '60.00000000', '', 1),
(22, 5, 18, 'S PARA TYPHI BH', 'SERUM WIDAL', '', '50.00000000', '', 1),
(23, 5, 19, 'APPEARANCE', 'SERUM WIDAL', '', '50.00000000', '', 1),
(24, 5, 20, 'ALBUMIN', 'SERUM WIDAL', '', '50.00000000', '', 1),
(25, 5, 21, 'SUGAR', 'SERUM WIDAL', 'BILE SALTS', '50.00000000', '', 1),
(26, 5, 22, 'ACETONE', 'SERUM WIDAL', 'BILE PIGMENTS', '60.00000000', '', 1),
(27, 6, 23, 'URINE PREGNANCY', 'URINE ANALYSIS', '', '60.00000000', '', 1),
(28, 6, 24, 'Deposits', 'URINE ANALYSIS', '', '55.00000000', '', 1),
(29, 3, 25, 'HAEMOGLOBIN', 'HAEMATOLOGY', 'gms%', '60.00000000', 'M 13.5 - 15.5 / F 12.5 - 14.5 gms', 1),
(30, 3, 26, 'PACKED CELL VOLUME', 'HAEMATOLOGY', '', '65.00000000', 'F 36 - 47% / M 40 - 54%', 1),
(31, 3, 27, 'Total W.B.C Count', 'HAEMATOLOGY', '', '70.00000000', '4000 - 10000 /Cumm', 1),
(32, 3, 28, 'Total R.B.C Count', 'HAEMATOLOGY', '', '99.99999999', '4.5 - 6.5 Million/ Cumm', 1),
(33, 2, 29, 'N. POLYMORPHS', 'DIFFERENTIAL COUNT', '%', '65.00000000', '40 - 65 %', 1),
(34, 2, 30, 'LYMPHOCYTES', 'DIFFERENTIAL COUNT', '%', '90.00000000', '35 - 55 %', 1),
(35, 2, 31, 'EOSINOPHILS', 'DIFFERENTIAL COUNT', '%', '80.00000000', '1 - 6 %', 1),
(36, 2, 32, 'MONOCYTE', 'DIFFERENTIAL COUNT', '%', '70.00000000', '2 - 8 %', 1),
(37, 2, 33, 'BASOPHIL', 'DIFFERENTIAL COUNT', '%', '60.00000000', '0 - 1 %', 1),
(38, 2, 34, 'ESR: 1 / 2 Hour', 'DIFFERENTIAL COUNT', 'mm', '60.00000000', 'M 7 - 15', 1),
(39, 2, 35, 'ESR: 1 Hour', 'DIFFERENTIAL COUNT', 'mm', '60.00000000', 'F 12 - 17', 1),
(40, 2, 36, 'Absolute Eosinophils Count', 'DIFFERENTIAL COUNT', 'Ce', '50.00000000', '40 - 440 Ce/Cumm', 1),
(41, 2, 37, 'Platelet Count', 'DIFFERENTIAL COUNT', 'Ce', '60.00000000', '1 - 4 Lak Ce/Cumm', 1),
(42, 2, 38, 'BI Group', 'DIFFERENTIAL COUNT', '', '70.00000000', '', 1),
(43, 2, 39, 'Rh. Typing', 'DIFFERENTIAL COUNT', '', '50.00000000', '', 1),
(44, 2, 40, 'Bleeding Time', 'DIFFERENTIAL COUNT', 'Mts', '55.00000000', '1 - 6 Mts', 1),
(45, 2, 41, 'Clotting Time', 'DIFFERENTIAL COUNT', 'Mts', '60.00000000', '8 - 18 Mts', 1),
(46, 2, 42, 'M P Card', 'DIFFERENTIAL COUNT', '', '60.00000000', '', 1),
(47, 2, 43, 'M F', 'DIFFERENTIAL COUNT', '', '50.00000000', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `test_categories`
--

CREATE TABLE `test_categories` (
  `id` int(11) NOT NULL,
  `main_category` varchar(255) NOT NULL,
  `test_category` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test_categories`
--

INSERT INTO `test_categories` (`id`, `main_category`, `test_category`, `status`) VALUES
(1, 'Blood Test', 'BIO-CHEMISTRY', 1),
(2, 'Blood Test', 'DIFFERENTIAL COUNT', 1),
(3, 'Sort Blood Test', 'HAEMATOLOGY', 1),
(4, 'Blood Test', 'LIPID PROFILE', 1),
(5, 'Blood Test', 'SERUM WIDAL', 1),
(6, 'Urine Test', 'URINE ANALYSIS', 1),
(7, 'Stool Test', 'Physical', 1),
(8, 'Stool Test', 'Chemical', 1),
(9, 'Stool Test', 'Microseopica', 1),
(10, 'Urine Test', 'Physical', 1),
(11, 'Urine Test', 'Chemical', 1),
(12, 'Urine Test', 'Microseopica', 1),
(13, 'Liver Function Test', 'Liver Test', 1),
(14, 'Mantoux Test', 'Mantoux Test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` tinyint(4) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `is_subadmin` tinyint(1) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_name`, `password`, `email`, `user_type`, `status`, `is_deleted`, `is_subadmin`, `created_date`, `modified_by`, `modified_date`) VALUES
(1, 'Admin', 'admin_user_01', '12345678', 'admin@pathologylabs.com', 1, 1, 0, 0, '0000-00-00 00:00:00', NULL, NULL),
(2, 'Operator', 'operator_01', '12345678', 'operator@pathologylabs.com', 2, 1, 0, 1, '2016-06-04 03:00:07', NULL, '2016-06-04 03:00:07'),
(3, 'Patient', 'patient_01', '12345678', 'patient@pathologylabs.com', 3, 1, 0, 1, '2016-06-04 03:01:08', NULL, '2016-06-04 03:01:08');

-- --------------------------------------------------------

--
-- Table structure for table `word_details`
--

CREATE TABLE `word_details` (
  `id` int(11) NOT NULL,
  `word_name` varchar(255) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `doctor_name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `word_details`
--

INSERT INTO `word_details` (`id`, `word_name`, `doctor_id`, `doctor_name`, `status`) VALUES
(1, 'Word No 1', 1, 'Arijit Kumar Modak', 1),
(2, 'Word No 2', 1, 'Arijit Kumar Modak', 1),
(3, 'Word No 3', 1, 'Arijit Kumar Modak', 1),
(4, 'Word No 4', 1, 'Arijit Kumar Modak', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctor_list`
--
ALTER TABLE `doctor_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_details`
--
ALTER TABLE `patient_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_report`
--
ALTER TABLE `patient_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_tests`
--
ALTER TABLE `patient_tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tests_type`
--
ALTER TABLE `tests_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_categories`
--
ALTER TABLE `test_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `word_details`
--
ALTER TABLE `word_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctor_list`
--
ALTER TABLE `doctor_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patient_details`
--
ALTER TABLE `patient_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `patient_report`
--
ALTER TABLE `patient_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `patient_tests`
--
ALTER TABLE `patient_tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tests_type`
--
ALTER TABLE `tests_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `test_categories`
--
ALTER TABLE `test_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `word_details`
--
ALTER TABLE `word_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
