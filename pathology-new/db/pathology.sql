-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2021 at 08:29 PM
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
  `patient_id` int(11) NOT NULL,
  `registration_no` varchar(255) NOT NULL,
  `name` text NOT NULL,
  `gender` char(1) NOT NULL,
  `dob` date NOT NULL,
  `age` int(11) NOT NULL,
  `mobile_no` int(11) NOT NULL,
  `height` varchar(100) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `word_no` int(11) NOT NULL,
  `word_name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `doctor_name` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient_details`
--

INSERT INTO `patient_details` (`id`, `patient_id`, `registration_no`, `name`, `gender`, `dob`, `age`, `mobile_no`, `height`, `weight`, `blood_group`, `address`, `word_no`, `word_name`, `created_by`, `doctor_name`, `created_date`, `modified_by`, `modified_date`, `status`) VALUES
(5, 0, 'fasdawsda', 'sdasd', 'M', '0000-00-00', 0, 0, NULL, NULL, NULL, NULL, 2, 'Word No 2', 0, 'Arijit Kumar Modak', '2021-09-25 00:00:00', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `patient_report`
--

CREATE TABLE `patient_report` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `test_type_id` int(11) NOT NULL,
  `test_type_name` varchar(255) NOT NULL,
  `test_type_unit` varchar(255) NOT NULL,
  `normal_range` varchar(255) NOT NULL,
  `result_value` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` varchar(255) NOT NULL,
  `deleted_on` datetime NOT NULL,
  `deleted_by` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `patient_tests`
--

CREATE TABLE `patient_tests` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `word` varchar(255) NOT NULL,
  `serial_no` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `test_det_type` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(49, 3, 0, 'test 1', 'HAEMATOLOGY', '45', '0.00000000', '70 - 90 mg/l', 1);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_report_fk_id` (`patient_id`,`serial_no`),
  ADD KEY `tests_type_fk_id` (`serial_no`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_tests`
--
ALTER TABLE `patient_tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `patient_tests`
--
ALTER TABLE `patient_tests`
  ADD CONSTRAINT `patient_tests_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient_reports` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_tests_ibfk_2` FOREIGN KEY (`serial_no`) REFERENCES `tests_type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
