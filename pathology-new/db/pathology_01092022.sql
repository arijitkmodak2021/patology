-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2022 at 08:36 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

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
(1, 'Dr. .........', '', 1),
(2, 'Dr. ...........', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pathologists_list`
--

CREATE TABLE `pathologists_list` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `signature_path` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pathologists_list`
--

INSERT INTO `pathologists_list` (`id`, `name`, `description`, `signature_path`, `status`) VALUES
(1, 'Dr. Murari Mohan Das', '', 'sign1.png', 1),
(2, 'Dr. Ayan Santra', '', 'sign2.png', 1);

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
(5, 'P-202189637', 'reg-1234567890', 'Jane Doe', '', 'F', '1970-01-01', 24, '9123456789', '5\"7\'', '68', 'B+', '12/3 Sample Road, Newcity, Dist1, West Bengal, 75321', 2, 'Word No 2', 'operator_01', 'Arijit Kumar Modak', '2021-09-25 00:00:00', 0, '0000-00-00 00:00:00', 1),
(6, 'P-202199474', 'reg-1234567892', 'Test patient', '', 'M', '0000-00-00', 34, '9123456789', '', '', '', '', 3, 'Word No 3', 'operator_01', 'Test Doctor 1', '2021-09-30 00:00:00', 0, '0000-00-00 00:00:00', 1),
(7, 'P-202116463', '12345', 'AMIT DAS', '', 'M', '0000-00-00', 45, '9153091530', '', '', '', '', 1, 'Word No 1', 'admin', 'Arijit Kumar Modak', '2021-12-09 00:00:00', 0, '0000-00-00 00:00:00', 1),
(8, 'P-202115130', 'RG-2021005278', 'RAJA DAS', '', 'M', '0000-00-00', 40, '9153091530', '', '', '', '', 1, 'Word No 1', 'admin', 'Test Doctor 1', '2021-12-10 00:00:00', 0, '0000-00-00 00:00:00', 1),
(9, 'P-202134538', '123456', 'TEST REPORT', '', 'M', '0000-00-00', 50, '9153091530', '', '', '', '', 1, 'Male Medicine Ward', 'admin', 'Dr. Susanta Mondal', '2021-12-10 00:00:00', 0, '0000-00-00 00:00:00', 1),
(10, 'P-202247601', '1234561111', 'Test Patient', '', 'M', '0000-00-00', 42, '9153091530', '', '', '', '', 1, 'Male Medicine Ward', 'admin', 'Dr. Susanta Mondal', '2022-05-31 00:00:00', 0, '0000-00-00 00:00:00', 1);

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
(48, 5, 8, 'P-202189637', 'Urine Test', 6, 'URINE ANALYSIS', 27, 'URINE PREGNANCY', '', '', '99', '2021-09-26 00:00:00', 1),
(54, 6, 10, 'P-202199474', 'Sort Blood Test', 3, 'HAEMATOLOGY', 29, 'HAEMOGLOBIN', 'gms%', 'M 13.5 - 15.5 / F 12.5 - 14.5 gms', '8', '2021-09-30 00:00:00', 1),
(55, 6, 10, 'P-202199474', 'Sort Blood Test', 3, 'HAEMATOLOGY', 30, 'PACKED CELL VOLUME', '', 'F 36 - 47% / M 40 - 54%', '4', '2021-09-30 00:00:00', 1),
(56, 6, 10, 'P-202199474', 'Sort Blood Test', 3, 'HAEMATOLOGY', 32, 'Total R.B.C Count', '', '4.5 - 6.5 Million/ Cumm', '2', '2021-09-30 00:00:00', 1),
(57, 6, 10, 'P-202199474', 'Sort Blood Test', 3, 'HAEMATOLOGY', 31, 'Total W.B.C Count', '', '4000 - 10000 /Cumm', '7', '2021-09-30 00:00:00', 1),
(58, 6, 10, 'P-202199474', 'Stool Test', 8, 'Chemical', 51, 'St-ch-1', 'mg/l', '12 - 28', '6', '2021-09-30 00:00:00', 1),
(59, 6, 10, 'P-202199474', 'Urine Test', 6, 'URINE ANALYSIS', 28, 'Deposits', '', '', '67', '2021-09-30 00:00:00', 1),
(60, 6, 10, 'P-202199474', 'Urine Test', 6, 'URINE ANALYSIS', 27, 'URINE PREGNANCY', '', '', '34', '2021-09-30 00:00:00', 1),
(61, 6, 11, 'P-202199474', 'Urine Test', 6, 'URINE ANALYSIS', 28, 'Deposits', '', '', '5', '2021-10-01 00:00:00', 1),
(62, 6, 11, 'P-202199474', 'Urine Test', 6, 'URINE ANALYSIS', 27, 'URINE PREGNANCY', '', '', 'u', '2021-10-01 00:00:00', 1),
(63, 6, 12, 'P-202199474', 'Urine Test', 6, 'URINE ANALYSIS', 28, 'Deposits', '', '', '5', '2021-10-01 00:00:00', 1),
(64, 6, 12, 'P-202199474', 'Urine Test', 6, 'URINE ANALYSIS', 27, 'URINE PREGNANCY', '', '', 'u', '2021-10-01 00:00:00', 1),
(65, 6, 13, 'P-202199474', 'Urine Test', 6, 'URINE ANALYSIS', 28, 'Deposits', '', '', '5', '2021-10-01 00:00:00', 1),
(66, 6, 13, 'P-202199474', 'Urine Test', 6, 'URINE ANALYSIS', 27, 'URINE PREGNANCY', '', '', 'u', '2021-10-01 00:00:00', 1),
(74, 6, 23, 'P-202199474', 'Blood Test', 1, 'BIO-CHEMISTRY', 10, 'Blood Urea', 'mg/dl', '15 - 45', '65', '2021-10-04 00:00:00', 1),
(75, 6, 23, 'P-202199474', 'Blood Test', 1, 'BIO-CHEMISTRY', 6, 'Fasting', 'mg/dl', '60 - 110', '80', '2021-10-04 00:00:00', 1),
(76, 6, 23, 'P-202199474', 'Blood Test', 1, 'BIO-CHEMISTRY', 7, 'Serum Uric Acid', 'mg/dl', '1.5 - 7.0', '4', '2021-10-04 00:00:00', 1),
(77, 6, 23, 'P-202199474', 'Sort Blood Test', 3, 'HAEMATOLOGY', 29, 'HAEMOGLOBIN', 'gms%', 'M 13.5 - 15.5 / F 12.5 - 14.5 gms', '15', '2021-10-04 00:00:00', 1),
(78, 6, 23, 'P-202199474', 'Sort Blood Test', 3, 'HAEMATOLOGY', 30, 'PACKED CELL VOLUME', '', 'F 36 - 47% / M 40 - 54%', '45', '2021-10-04 00:00:00', 1),
(79, 6, 23, 'P-202199474', 'Sort Blood Test', 3, 'HAEMATOLOGY', 32, 'Total R.B.C Count', '', '4.5 - 6.5 Million/ Cumm', '8', '2021-10-04 00:00:00', 1),
(80, 6, 23, 'P-202199474', 'Sort Blood Test', 3, 'HAEMATOLOGY', 31, 'Total W.B.C Count', '', '4000 - 10000 /Cumm', '400000', '2021-10-04 00:00:00', 1),
(81, 7, 24, 'P-202116463', 'Blood Test', 1, 'BIO-CHEMISTRY', 10, 'Blood Urea', 'mg/dl', '15 - 45', '20', '2021-12-09 00:00:00', 1),
(82, 7, 24, 'P-202116463', 'Blood Test', 1, 'BIO-CHEMISTRY', 6, 'Fasting', 'mg/dl', '60 - 110', '75', '2021-12-09 00:00:00', 1),
(83, 8, 25, 'P-202115130', 'Blood Test', 1, 'BIO-CHEMISTRY', 10, 'Blood Urea', 'mg/dl', '15 - 45', '30', '2021-12-10 00:00:00', 1),
(84, 8, 25, 'P-202115130', 'Blood Test', 1, 'BIO-CHEMISTRY', 6, 'Fasting', 'mg/dl', '60 - 110', '70', '2021-12-10 00:00:00', 1),
(85, 8, 25, 'P-202115130', 'Blood Test', 1, 'BIO-CHEMISTRY', 8, 'Post Prantial', 'mg/dl', '80 - 160', '90', '2021-12-10 00:00:00', 1),
(86, 8, 25, 'P-202115130', 'Blood Test', 1, 'BIO-CHEMISTRY', 9, 'Random', 'mg/dl', '80 - 140', '90', '2021-12-10 00:00:00', 1),
(87, 9, 26, 'P-202134538', 'Blood Test', 1, 'BIO-CHEMISTRY', 10, 'Blood Urea', 'mg/dl', '15 - 45', '50', '2021-12-10 00:00:00', 1),
(88, 9, 26, 'P-202134538', 'Blood Test', 1, 'BIO-CHEMISTRY', 6, 'Fasting', 'mg/dl', '60 - 110', '80', '2021-12-10 00:00:00', 1),
(89, 9, 26, 'P-202134538', 'Blood Test', 1, 'BIO-CHEMISTRY', 8, 'Post Prantial', 'mg/dl', '80 - 160', '110', '2021-12-10 00:00:00', 1),
(90, 7, 27, 'P-202116463', 'Blood Test', 1, 'BIO-CHEMISTRY', 10, 'Blood Urea', 'mg/dl', '15 - 45', '30', '2022-05-30 00:00:00', 1),
(91, 7, 27, 'P-202116463', 'Blood Test', 1, 'BIO-CHEMISTRY', 6, 'Fasting', 'mg/dl', '60 - 110', '110', '2022-05-30 00:00:00', 1),
(92, 6, 28, 'P-202199474', 'Blood Test', 1, 'BIO-CHEMISTRY', 10, 'Blood Urea', 'mg/dl', '15 - 45', '30', '2022-05-30 00:00:00', 1),
(93, 6, 28, 'P-202199474', 'Blood Test', 1, 'BIO-CHEMISTRY', 6, 'Fasting', 'mg/dl', '60 - 110', '110', '2022-05-30 00:00:00', 1),
(94, 6, 28, 'P-202199474', 'Blood Test', 1, 'BIO-CHEMISTRY', 8, 'Post Prantial', 'mg/dl', '80 - 160', '150', '2022-05-30 00:00:00', 1),
(95, 6, 28, 'P-202199474', 'Blood Test', 2, 'DIFFERENTIAL COUNT', 40, 'Absolute Eosinophils Count', 'Ce', '40 - 440 Ce/Cumm', '50', '2022-05-30 00:00:00', 1),
(96, 6, 28, 'P-202199474', 'Sort Blood Test', 3, 'HAEMATOLOGY', 29, 'HAEMOGLOBIN', 'gms%', 'M 13.5 - 15.5 / F 12.5 - 14.5 gms', '14.5', '2022-05-30 00:00:00', 1),
(97, 6, 28, 'P-202199474', 'Sort Blood Test', 3, 'HAEMATOLOGY', 30, 'PACKED CELL VOLUME', '', 'F 36 - 47% / M 40 - 54%', '50', '2022-05-30 00:00:00', 1),
(98, 6, 28, 'P-202199474', 'Sort Blood Test', 3, 'HAEMATOLOGY', 32, 'Total R.B.C Count', '', '4.5 - 6.5 Million/ Cumm', '5.5', '2022-05-30 00:00:00', 1),
(99, 6, 28, 'P-202199474', 'Sort Blood Test', 3, 'HAEMATOLOGY', 31, 'Total W.B.C Count', '', '4000 - 10000 /Cumm', '5000', '2022-05-30 00:00:00', 1),
(100, 10, 29, 'P-202247601', 'Blood Test', 1, 'BIO-CHEMISTRY', 10, 'Blood Urea', 'mg/dl', '15 - 45', '45', '2022-05-31 00:00:00', 1),
(101, 10, 29, 'P-202247601', 'Blood Test', 1, 'BIO-CHEMISTRY', 6, 'Fasting', 'mg/dl', '60 - 110', '110', '2022-05-31 00:00:00', 1),
(102, 10, 29, 'P-202247601', 'Blood Test', 1, 'BIO-CHEMISTRY', 8, 'Post Prantial', 'mg/dl', '80 - 160', '150', '2022-05-31 00:00:00', 1),
(103, 8, 30, 'P-202115130', 'Blood Test', 1, 'BIO-CHEMISTRY', 10, 'Blood Urea', 'mg/dl', '15 - 45', '35', '2022-05-31 00:00:00', 1),
(104, 8, 30, 'P-202115130', 'Blood Test', 1, 'BIO-CHEMISTRY', 6, 'Fasting', 'mg/dl', '60 - 110', '110', '2022-05-31 00:00:00', 1),
(105, 8, 30, 'P-202115130', 'Blood Test', 1, 'BIO-CHEMISTRY', 8, 'Post Prantial', 'mg/dl', '80 - 160', '90', '2022-05-31 00:00:00', 1),
(106, 8, 30, 'P-202115130', 'Blood Test', 1, 'BIO-CHEMISTRY', 9, 'Random', 'mg/dl', '80 - 140', '90', '2022-05-31 00:00:00', 1),
(107, 9, 31, 'P-202134538', 'Blood Test', 1, 'BIO-CHEMISTRY', 10, 'Blood Urea', 'mg/dl', '15 - 45', '30', '2022-06-03 00:00:00', 1),
(108, 9, 31, 'P-202134538', 'Blood Test', 1, 'BIO-CHEMISTRY', 53, 'BT', 'mg', '60-70', '70', '2022-06-03 00:00:00', 1),
(109, 9, 31, 'P-202134538', 'Blood Test', 1, 'BIO-CHEMISTRY', 6, 'Fasting', 'mg/dl', '60 - 110', '110', '2022-06-03 00:00:00', 1),
(110, 9, 31, 'P-202134538', 'Blood Test', 1, 'BIO-CHEMISTRY', 8, 'Post Prantial', 'mg/dl', '80 - 160', '90', '2022-06-03 00:00:00', 1),
(111, 9, 31, 'P-202134538', 'Sort Blood Test', 3, 'HAEMATOLOGY', 29, 'HAEMOGLOBIN', 'gms%', 'M 13.5 - 15.5 / F 12.5 - 14.5 gms', '15', '2022-06-03 00:00:00', 1),
(112, 7, 32, 'P-202116463', 'Blood Test', 1, 'BIO-CHEMISTRY', 6, 'Fasting', 'mg/dl', '60 - 110', '70', '2022-06-03 00:00:00', 1),
(113, 7, 32, 'P-202116463', 'Blood Test', 1, 'BIO-CHEMISTRY', 8, 'Post Prantial', 'mg/dl', '80 - 160', '110', '2022-06-03 00:00:00', 1),
(114, 7, 32, 'P-202116463', 'Liver Function Test', 13, 'Liver Test', 119, 'SGOT', 'l.u/l', '8-20 according to span reagent', '10', '2022-06-03 00:00:00', 1),
(115, 7, 32, 'P-202116463', 'Liver Function Test', 13, 'Liver Test', 120, 'SGPT', 'iu/l', '10-40 as per span reagent', '10', '2022-06-03 00:00:00', 1),
(116, 7, 32, 'P-202116463', 'Mantoux Test', 14, 'Mantoux Test', 110, 'Induration', 'mm', '.', '2', '2022-06-03 00:00:00', 1),
(117, 7, 32, 'P-202116463', 'Sort Blood Test', 3, 'HAEMATOLOGY', 29, 'HAEMOGLOBIN', 'gms%', 'M 13.5 - 15.5 / F 12.5 - 14.5 gms', '14.5', '2022-06-03 00:00:00', 1),
(118, 7, 32, 'P-202116463', 'Stool Test', 8, 'Chemical', 73, 'Blood', '.', '.', '10', '2022-06-03 00:00:00', 1),
(119, 7, 32, 'P-202116463', 'Stool Test', 8, 'Chemical', 72, 'Colour', '.', '.', 'PALE YELLOW', '2022-06-03 00:00:00', 1),
(120, 7, 32, 'P-202116463', 'Urine Test', 6, 'Casts', 127, 'Amorphous phosphate', '.', '.', '111', '2022-06-03 00:00:00', 1),
(121, 6, 33, 'P-202199474', 'Blood Test', 1, 'BIO-CHEMISTRY', 10, 'Blood Urea', 'mg/dl', '15 - 45', '30', '2022-09-01 00:00:00', 1),
(122, 6, 33, 'P-202199474', 'Blood Test', 1, 'BIO-CHEMISTRY', 53, 'BT', 'mg', '60-70', '65', '2022-09-01 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `patient_tests`
--

CREATE TABLE `patient_tests` (
  `id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `patient_id` varchar(255) NOT NULL,
  `test_main_categories` text NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `doctor_name` varchar(255) NOT NULL,
  `pathologist_id` int(11) NOT NULL,
  `pathologist_name` varchar(255) DEFAULT NULL,
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

INSERT INTO `patient_tests` (`id`, `p_id`, `patient_id`, `test_main_categories`, `created_by`, `doctor_name`, `pathologist_id`, `pathologist_name`, `word_no`, `notes`, `modified_by`, `modified_date`, `create_date`, `status`) VALUES
(6, 5, 'P-202189637', 'Blood Test, Sort Blood Test, Urine Test', 'operator_01', 'Test Doctor 2', 0, NULL, 'Word No 2', '', '', '0000-00-00 00:00:00', '2021-09-26 00:00:00', 1),
(8, 5, 'P-202189637', 'Sort Blood Test, Urine Test', 'operator_01', 'Test Doctor 2', 0, NULL, 'Word No 2', '', '', '0000-00-00 00:00:00', '2021-09-26 00:00:00', 1),
(10, 6, 'P-202199474', 'Sort Blood Test, Stool Test, Urine Test', 'operator_01', 'Test Doctor 1', 0, NULL, 'Word No 3', '', '', '0000-00-00 00:00:00', '2021-09-30 00:00:00', 1),
(13, 6, 'P-202199474', 'Urine Test', 'operator_01', 'Test Doctor 1', 0, NULL, 'Word No 3', '', '', '0000-00-00 00:00:00', '2021-10-01 00:00:00', 1),
(23, 6, 'P-202199474', 'Blood Test,Sort Blood Test', 'operator_01', 'Test Doctor 1', 0, NULL, 'Word No 3', '', '', '0000-00-00 00:00:00', '2021-10-04 00:00:00', 1),
(24, 7, 'P-202116463', 'Blood Test', 'admin', 'Test Doctor 2', 0, NULL, 'Word No 1', '', '', '0000-00-00 00:00:00', '2021-12-09 00:00:00', 1),
(25, 8, 'P-202115130', 'Blood Test', 'admin', 'Test Doctor 1', 0, NULL, 'Word No 1', '', '', '0000-00-00 00:00:00', '2021-12-10 00:00:00', 1),
(28, 6, 'P-202199474', 'Blood Test,Sort Blood Test', 'operator_01', 'Test Doctor 1', 0, NULL, 'Word No 3', '', '', '0000-00-00 00:00:00', '2022-05-30 00:00:00', 1),
(30, 8, 'P-202115130', 'Blood Test', 'admin', 'Test Doctor 1', 0, NULL, 'Word No 1', '', '', '0000-00-00 00:00:00', '2022-05-31 00:00:00', 1),
(32, 7, 'P-202116463', 'Blood Test,Liver Function Test,Mantoux Test,Sort Blood Test,Stool Test,Urine Test', 'admin', 'Medical Officer', 0, NULL, 'Word No 1', '', '', '0000-00-00 00:00:00', '2022-06-03 00:00:00', 1),
(33, 6, 'P-202199474', 'Blood Test', 'operator_01', 'Test Doctor 1', 1, 'Dr. Murari Mohan Das', 'Word No 3', '', '', '0000-00-00 00:00:00', '2022-09-01 00:00:00', 1);

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
(47, 2, 43, 'M F', 'DIFFERENTIAL COUNT', '', '50.00000000', '', 1),
(51, 8, 0, 'St-ch-1', 'Chemical', 'mg/l', '0.00000000', '12 - 28', 1),
(52, 1, 0, 'TC', 'BIO-CHEMISTRY', 'mg', '0.00000000', '60-70', 1),
(53, 1, 0, 'BT', 'BIO-CHEMISTRY', 'mg', '0.00000000', '60-70', 1),
(54, 11, 0, 'TEST CHEMICAL', 'Chemical', 'mg', '0.00000000', '10-20', 1),
(55, 10, 0, 'Sediment', 'Physical', '.', '0.00000000', '.', 1),
(56, 10, 0, 'Colour', 'Physical', '.', '0.00000000', '.', 1),
(57, 13, 0, 'HCV', 'Liver Test', '.', '0.00000000', '.', 1),
(58, 10, 0, 'colour', 'Physical', '.', '0.00000000', '.', 1),
(59, 10, 0, 'Sediment', 'Physical', '.', '0.00000000', '.', 1),
(60, 10, 0, 'specific Gravity', 'Physical', '.', '0.00000000', '.', 1),
(61, 11, 0, 'Reaction', 'Chemical', '.', '0.00000000', '.', 1),
(62, 11, 0, 'Albumin', 'Chemical', '.', '0.00000000', '.', 1),
(63, 11, 0, 'Phosphate', 'Chemical', '.', '0.00000000', '.', 1),
(64, 11, 0, 'Sugar', 'Chemical', '.', '0.00000000', '.', 1),
(65, 11, 0, 'Sugar', 'Chemical', '.', '0.00000000', '.', 1),
(66, 11, 0, 'Blood', 'Chemical', '.', '0.00000000', '.', 1),
(67, 11, 0, 'Bile Salt', 'Chemical', '.', '0.00000000', '.', 1),
(68, 12, 0, 'R.B.C', 'Microseopica', '.', '0.00000000', '.', 1),
(69, 12, 0, 'Pus Cells', 'Microseopica', '.', '0.00000000', '.', 1),
(70, 12, 0, 'Pavement Epithelium', 'Microseopica', '.', '0.00000000', '.', 1),
(71, 8, 0, 'Form', 'Chemical', '.', '0.00000000', '.', 1),
(72, 8, 0, 'Colour', 'Chemical', '.', '0.00000000', '.', 1),
(73, 8, 0, 'Blood', 'Chemical', '.', '0.00000000', '.', 1),
(74, 8, 0, 'Mucus', 'Chemical', '.', '0.00000000', '.', 1),
(75, 8, 0, 'Undigested Food', 'Chemical', '.', '0.00000000', '.', 1),
(76, 8, 0, 'Particles', 'Chemical', '.', '0.00000000', '.', 1),
(77, 8, 0, 'Reaction', 'Chemical', '.', '0.00000000', '.', 1),
(78, 8, 0, 'Occult Blood', 'Chemical', '.', '0.00000000', '.', 1),
(79, 9, 0, 'Pus Cell', 'Microseopica', '.', '0.00000000', '.', 1),
(80, 9, 0, 'R.B.C', 'Microseopica', '.', '0.00000000', '.', 1),
(81, 9, 0, 'Ephithelial Cell', 'Microseopica', '.', '0.00000000', '.', 1),
(82, 9, 0, 'Vegetable Cell', 'Microseopica', '.', '0.00000000', '.', 1),
(83, 9, 0, 'Starch Granules', 'Microseopica', '.', '0.00000000', '.', 1),
(84, 9, 0, 'Charcot Layden', 'Microseopica', '.', '0.00000000', '.', 1),
(85, 9, 0, 'Crystals', 'Microseopica', '.', '0.00000000', '.', 1),
(86, 9, 0, 'Ova', 'Microseopica', '.', '0.00000000', '.', 1),
(87, 12, 0, 'Prota zoa', 'Microseopica', '.', '0.00000000', '.', 1),
(88, 9, 0, 'Cyst', 'Microseopica', '.', '0.00000000', '.', 1),
(89, 7, 0, 'Form', 'Physical', '.', '0.00000000', '.', 1),
(90, 7, 0, 'Colour', 'Physical', '.', '0.00000000', '.', 1),
(91, 7, 0, 'Blood', 'Physical', '.', '0.00000000', '.', 1),
(92, 7, 0, 'Mucus', 'Physical', '.', '0.00000000', '.', 1),
(93, 7, 0, 'Undigested Food', 'Physical', '.', '0.00000000', '.', 1),
(94, 7, 0, 'Particles', 'Physical', '.', '0.00000000', '.', 1),
(95, 4, 0, 'Serum Chelesterol', 'LIPID PROFILE', 'mg/dl', '0.00000000', '130-250', 1),
(96, 4, 0, 'Triglyceerid', 'LIPID PROFILE', 'mg/dl', '0.00000000', '60-160', 1),
(97, 4, 0, 'Triglyceride', 'LIPID PROFILE', 'mg/dl', '0.00000000', '60-160', 1),
(98, 4, 0, 'HDL Cholesterol', 'LIPID PROFILE', 'mg/dl', '0.00000000', 'Normal more than 35 ', 1),
(99, 4, 0, 'LDL Cholesterol', 'LIPID PROFILE', 'mg/dl', '0.00000000', 'Normal more than 150', 1),
(100, 4, 0, 'VLDL Cholesterol', 'LIPID PROFILE', 'mg/dl', '0.00000000', 'Normal more than 30', 1),
(101, 4, 0, 'Sodium (Na+)', 'LIPID PROFILE', 'mmol/L', '0.00000000', '125-155', 1),
(102, 4, 0, 'Potassium(K+)', 'LIPID PROFILE', 'mmol/L', '0.00000000', '3.5-5.5', 1),
(103, 4, 0, 'ASO - Titre', 'LIPID PROFILE', 'i.u/ml', '0.00000000', '.', 1),
(104, 4, 0, 'RA-Factor', 'LIPID PROFILE', 'i.u/ml', '0.00000000', '.', 1),
(105, 4, 0, 'AMYLASE', 'LIPID PROFILE', 'i.u/ml', '0.00000000', '5-40', 1),
(106, 4, 0, 'LIPASE', 'LIPID PROFILE', 'i.u/ml', '0.00000000', '5-40', 1),
(107, 4, 0, 'HBSAG', 'LIPID PROFILE', '.', '0.00000000', '.', 1),
(108, 4, 0, 'HCV', 'LIPID PROFILE', '.', '0.00000000', '.', 1),
(109, 14, 0, 'Result noted after', 'Mantoux Test', 'hrs', '0.00000000', '.', 1),
(110, 14, 0, 'Induration', 'Mantoux Test', 'mm', '0.00000000', '.', 1),
(111, 14, 0, 'Inference', 'Mantoux Test', 'negative/positive', '0.00000000', '.', 1),
(112, 13, 0, 'Serum Bilirubin(Total)', 'Liver Test', 'Mg/dl', '0.00000000', '0.2-1.2', 1),
(113, 13, 0, 'Conjugated', 'Liver Test', 'mg/dl', '0.00000000', '.', 1),
(114, 13, 0, 'Unconjugated', 'Liver Test', 'mg/dl', '0.00000000', '.', 1),
(115, 13, 0, 'Total Protein', 'Liver Test', 'gm/dl', '0.00000000', '5.5-8.5', 1),
(116, 13, 0, 'Albumin', 'Liver Test', 'gm/dl', '0.00000000', '3.5-5.0', 1),
(117, 13, 0, 'Alkaline Phosphate', 'Liver Test', 'lu/l', '0.00000000', '42-128', 1),
(118, 13, 0, 'URIC ACID', 'Liver Test', 'mg/dl', '0.00000000', '4-6', 1),
(119, 13, 0, 'SGOT', 'Liver Test', 'l.u/l', '0.00000000', '8-20 according to span reagent', 1),
(120, 13, 0, 'SGPT', 'Liver Test', 'iu/l', '0.00000000', '10-40 as per span reagent', 1),
(121, 6, 0, 'Hyaline', 'Casts', '.', '0.00000000', '.', 1),
(122, 6, 0, 'Epetheclial', 'Casts', '.', '0.00000000', '.', 1),
(123, 6, 0, 'Granular', 'Casts', '.', '0.00000000', '.', 1),
(124, 6, 0, 'R.B.C', 'Casts', '.', '0.00000000', '.', 1),
(125, 6, 0, 'Leucocyte', 'Casts', '.', '0.00000000', '.', 1),
(126, 6, 0, 'Calcium oxalate crystals', 'Casts', '.', '0.00000000', '.', 1),
(127, 6, 0, 'Amorphous phosphate', 'Casts', '.', '0.00000000', '.', 1),
(128, 6, 0, 'Amorphous Ureate', 'Casts', '.', '0.00000000', '.', 1),
(129, 15, 0, 'WBC', 'Total Count of', 'c.m.m', '0.00000000', '.', 1),
(130, 15, 0, 'RBC', 'Total Count of', 'c.m.m', '0.00000000', '.', 1),
(131, 15, 0, 'Platelet', 'Total Count of', 'c.m.m', '0.00000000', '.', 1),
(132, 5, 0, 'Typhi \'O\'', 'SERUM WIDAL', '.', '0.00000000', '.', 1),
(133, 5, 0, 'Typhi \'H\'', 'SERUM WIDAL', '.', '0.00000000', '.', 1),
(134, 5, 0, 'Paratyphi \'AH\'', 'SERUM WIDAL', '.', '0.00000000', '.', 1),
(135, 5, 0, 'ABO', 'SERUM WIDAL', '.', '0.00000000', '.', 1),
(136, 5, 0, 'RH', 'SERUM WIDAL', '.', '0.00000000', '.', 1),
(137, 5, 0, 'Paratyphi \'BH\'', 'SERUM WIDAL', '.', '0.00000000', '.', 1),
(138, 5, 0, 'RH', 'SERUM WIDAL', '.', '0.00000000', '.', 1),
(139, 15, 0, 'HB%', 'Total Count of', 'gm%', '0.00000000', '.', 1),
(140, 2, 0, 'Neutrophils', 'DIFFERENTIAL COUNT', '%', '0.00000000', '.', 1),
(141, 2, 0, 'Lymphoytes', 'DIFFERENTIAL COUNT', '%', '0.00000000', '.', 1),
(142, 2, 0, 'Monocytes', 'DIFFERENTIAL COUNT', '%', '0.00000000', '.', 1),
(143, 2, 0, 'Eosinophils', 'DIFFERENTIAL COUNT', '%', '0.00000000', '.', 1),
(144, 2, 0, 'Basophils', 'DIFFERENTIAL COUNT', '%', '0.00000000', '.', 1),
(145, 2, 0, 'Malaria parasite', 'DIFFERENTIAL COUNT', '%', '0.00000000', '.', 1),
(146, 2, 0, 'ESR', 'DIFFERENTIAL COUNT', '%', '0.00000000', '.', 1);

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
(6, 'Urine Test', 'Casts', 1),
(7, 'Stool Test', 'Physical', 1),
(8, 'Stool Test', 'Chemical', 1),
(9, 'Stool Test', 'Microseopica', 1),
(10, 'Urine Test', 'Physical', 1),
(11, 'Urine Test', 'Chemical', 1),
(12, 'Urine Test', 'Microseopica', 1),
(13, 'Liver Function Test', 'Liver Test', 1),
(14, 'Mantoux Test', 'Mantoux Test', 1),
(15, 'Blood Test', 'Total Count of', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
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

INSERT INTO `users` (`id`, `name`, `role`, `user_name`, `password`, `email`, `user_type`, `status`, `is_deleted`, `is_subadmin`, `created_date`, `modified_by`, `modified_date`) VALUES
(1, 'Admin 01', 'Administrator', 'admin', '12345678', 'admin@pathologylabs.com', 1, 1, 0, 0, '0000-00-00 00:00:00', NULL, NULL),
(2, 'Test Ope 01', 'Operator', 'operator_01', '12345678', 'operator@pathologylabs.com', 2, 1, 0, 1, '2016-06-04 03:00:07', NULL, '2016-06-04 03:00:07'),
(3, 'Test Pat 01', 'Patient', 'patient_01', '12345678', 'patient@pathologylabs.com', 3, 1, 0, 1, '2016-06-04 03:01:08', NULL, '2016-06-04 03:01:08');

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
(1, 'MMW', 1, 'Test Doctor 1', 1),
(2, 'FMW', 1, 'Test Doctor 1', 1),
(3, 'SNCU', 1, 'Test Doctor 1', 1),
(4, 'PNW', 1, 'Dr...', 1),
(5, 'ANW', 1, 'Dr...', 1),
(6, 'FSW', 1, 'Dr...', 1),
(7, 'MSW', 1, 'Dr...', 1),
(8, 'OPD', 1, 'Dr...', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctor_list`
--
ALTER TABLE `doctor_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pathologists_list`
--
ALTER TABLE `pathologists_list`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pathologists_list`
--
ALTER TABLE `pathologists_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patient_details`
--
ALTER TABLE `patient_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `patient_report`
--
ALTER TABLE `patient_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `patient_tests`
--
ALTER TABLE `patient_tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tests_type`
--
ALTER TABLE `tests_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `test_categories`
--
ALTER TABLE `test_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `word_details`
--
ALTER TABLE `word_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
