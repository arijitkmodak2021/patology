-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2021 at 07:43 PM
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
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1464762364),
('m130524_201442_init', 1464762369);

-- --------------------------------------------------------

--
-- Table structure for table `patient_details`
--

CREATE TABLE `patient_details` (
  `id` int(11) NOT NULL,
  `user_fk_id` int(11) NOT NULL,
  `pass_code` varchar(255) NOT NULL,
  `gender` char(1) NOT NULL,
  `dob` date NOT NULL,
  `height` varchar(100) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient_details`
--

INSERT INTO `patient_details` (`id`, `user_fk_id`, `pass_code`, `gender`, `dob`, `height`, `weight`, `blood_group`, `address`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(1, 3, 'PL123', 'm', '1987-01-15', '5\'11\"', '73', 'B+', '', 2, '2016-06-04 03:01:08', NULL, '2016-06-04 03:01:08');

-- --------------------------------------------------------

--
-- Table structure for table `patient_reports`
--

CREATE TABLE `patient_reports` (
  `id` int(11) NOT NULL,
  `sample_no` int(11) NOT NULL,
  `patient_fk_id` int(11) NOT NULL,
  `exam` varchar(255) NOT NULL,
  `referred_doctor` varchar(255) NOT NULL,
  `doctor_specialization` varchar(255) NOT NULL,
  `prescription_image` varchar(255) DEFAULT NULL,
  `prescrption_text` text DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient_reports`
--

INSERT INTO `patient_reports` (`id`, `sample_no`, `patient_fk_id`, `exam`, `referred_doctor`, `doctor_specialization`, `prescription_image`, `prescrption_text`, `summary`, `status`, `is_deleted`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(1, 0, 1, 'EX01', 'Dr Rupesh K Gupta', 'General Surgeon', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n\r\nDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est.\r\n\r\nQui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', 1, 0, 2, '2016-06-04 03:05:37', NULL, '2016-06-04 03:05:37');

-- --------------------------------------------------------

--
-- Table structure for table `patient_tests`
--

CREATE TABLE `patient_tests` (
  `id` int(11) NOT NULL,
  `patient_report_fk_id` int(11) NOT NULL,
  `tests_type_fk_id` int(11) NOT NULL,
  `test_result` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient_tests`
--

INSERT INTO `patient_tests` (`id`, `patient_report_fk_id`, `tests_type_fk_id`, `test_result`, `is_deleted`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(1, 1, 2, '90 mg/dL', 0, 2, '2016-06-04 03:07:09', NULL, '2016-06-04 03:07:09'),
(2, 1, 1, '80 mg/dL', 0, 2, '2016-06-04 03:07:23', NULL, '2016-06-04 03:07:23'),
(3, 1, 3, '15 g/dL', 0, 2, '2016-06-04 03:07:41', NULL, '2016-06-04 03:07:41');

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
(1, 0, 0, 'Glucose, Fasting', '70-99 mg/dL', '', '0.00000000', '3.86-5.45 mmol/L', 1),
(2, 0, 0, 'Glucose, Random', '70-139 mg/dL', '', '0.00000000', '3.86-7.66 mmol/L', 1),
(3, 0, 0, 'Hemoglobin, Men', '13.3-17.7 g/dL', '', '0.00000000', '133-177 g/L', 1),
(4, 0, 0, 'Hemoglobin, Women', '11.7-15.7 g/dL', '', '0.00000000', '117-157 g/L', 1),
(6, 0, 1, 'Fasting', 'BIO-CHEMISTRY', 'mg/dl', '99.99999999', '60 - 110', 1),
(7, 0, 8, 'Serum Uric Acid', 'BIO-CHEMISTRY', 'mg/dl', '99.99999999', '1.5 - 7.0', 1),
(8, 0, 3, 'Post Prantial', 'BIO-CHEMISTRY', 'mg/dl', '99.99999999', '80 - 160', 1),
(9, 0, 4, 'Random', 'BIO-CHEMISTRY', 'mg/dl', '99.99999999', '80 - 140', 1),
(10, 0, 5, 'Blood Urea', 'BIO-CHEMISTRY', 'mg/dl', '99.99999999', '15 - 45', 1),
(11, 0, 6, 'Serum Creatinine', 'BIO-CHEMISTRY', 'mg/dl', '99.99999999', '0.6 - 1.5', 1),
(12, 0, 7, 'Serum T.Cholesterol', 'BIO-CHEMISTRY', 'mg/dl', '99.99999999', '150 - 200', 1),
(13, 0, 9, 'Serum Calcium', 'BIO-CHEMISTRY', 'mg/dl', '99.99999999', '8.5 - 11.00', 1),
(14, 0, 10, 'T.Cholesterol', 'LIPID PROFILE', 'mg/dl', '99.99999999', '125 - 200', 1),
(15, 0, 11, 'Triglycerides', 'LIPID PROFILE', 'mg/dl', '99.99999999', '25 - 200', 1),
(16, 0, 12, 'HDL', 'LIPID PROFILE', 'mg/dl', '99.99999999', '35 - 80', 1),
(17, 0, 13, 'LDL', 'LIPID PROFILE', 'mg/dl', '99.99999999', '85 - 130', 1),
(18, 0, 14, 'VLDL', 'LIPID PROFILE', 'mg/dl', '50.00000000', '05 - 40', 1),
(19, 0, 15, 'S TYPHI \"O\"', 'SERUM WIDAL', '', '60.00000000', '', 1),
(20, 0, 16, 'S TYPHI \"H\"', 'SERUM WIDAL', '', '55.00000000', '', 1),
(21, 0, 17, 'S PARA TYPHI AH', 'SERUM WIDAL', '', '60.00000000', '', 1),
(22, 0, 18, 'S PARA TYPHI BH', 'SERUM WIDAL', '', '50.00000000', '', 1),
(23, 0, 19, 'APPEARANCE', 'SERUM WIDAL', '', '50.00000000', '', 1),
(24, 0, 20, 'ALBUMIN', 'SERUM WIDAL', '', '50.00000000', '', 1),
(25, 0, 21, 'SUGAR', 'SERUM WIDAL', 'BILE SALTS', '50.00000000', '', 1),
(26, 0, 22, 'ACETONE', 'SERUM WIDAL', 'BILE PIGMENTS', '60.00000000', '', 1),
(27, 0, 23, 'URINE PREGNANCY', 'URINE ANALYSIS', '', '60.00000000', '', 1),
(28, 0, 24, 'Deposits', 'URINE ANALYSIS', '', '55.00000000', '', 1),
(29, 0, 25, 'HAEMOGLOBIN', 'HAEMATOLOGY', 'gms%', '60.00000000', 'M 13.5 - 15.5 / F 12.5 - 14.5 gms', 1),
(30, 0, 26, 'PACKED CELL VOLUME', 'HAEMATOLOGY', '', '65.00000000', 'F 36 - 47% / M 40 - 54%', 1),
(31, 0, 27, 'Total W.B.C Count', 'HAEMATOLOGY', '', '70.00000000', '4000 - 10000 /Cumm', 1),
(32, 0, 28, 'Total R.B.C Count', 'HAEMATOLOGY', '', '99.99999999', '4.5 - 6.5 Million/ Cumm', 1),
(33, 0, 29, 'N. POLYMORPHS', 'DIFFERENTIAL COUNT', '%', '65.00000000', '40 - 65 %', 1),
(34, 0, 30, 'LYMPHOCYTES', 'DIFFERENTIAL COUNT', '%', '90.00000000', '35 - 55 %', 1),
(35, 0, 31, 'EOSINOPHILS', 'DIFFERENTIAL COUNT', '%', '80.00000000', '1 - 6 %', 1),
(36, 0, 32, 'MONOCYTE', 'DIFFERENTIAL COUNT', '%', '70.00000000', '2 - 8 %', 1),
(37, 0, 33, 'BASOPHIL', 'DIFFERENTIAL COUNT', '%', '60.00000000', '0 - 1 %', 1),
(38, 0, 34, 'ESR: 1 / 2 Hour', 'DIFFERENTIAL COUNT', 'mm', '60.00000000', 'M 7 - 15', 1),
(39, 0, 35, 'ESR: 1 Hour', 'DIFFERENTIAL COUNT', 'mm', '60.00000000', 'F 12 - 17', 1),
(40, 0, 36, 'Absolute Eosinophils Count', 'DIFFERENTIAL COUNT', 'Ce', '50.00000000', '40 - 440 Ce/Cumm', 1),
(41, 0, 37, 'Platelet Count', 'DIFFERENTIAL COUNT', 'Ce', '60.00000000', '1 - 4 Lak Ce/Cumm', 1),
(42, 0, 38, 'BI Group', 'DIFFERENTIAL COUNT', '', '70.00000000', '', 1),
(43, 0, 39, 'Rh. Typing', 'DIFFERENTIAL COUNT', '', '50.00000000', '', 1),
(44, 0, 40, 'Bleeding Time', 'DIFFERENTIAL COUNT', 'Mts', '55.00000000', '1 - 6 Mts', 1),
(45, 0, 41, 'Clotting Time', 'DIFFERENTIAL COUNT', 'Mts', '60.00000000', '8 - 18 Mts', 1),
(46, 0, 42, 'M P Card', 'DIFFERENTIAL COUNT', '', '60.00000000', '', 1),
(47, 0, 43, 'M F', 'DIFFERENTIAL COUNT', '', '50.00000000', '', 1);

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `patient_details`
--
ALTER TABLE `patient_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pass_code` (`pass_code`),
  ADD KEY `user_fk_id` (`user_fk_id`);

--
-- Indexes for table `patient_reports`
--
ALTER TABLE `patient_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_fk_id` (`patient_fk_id`),
  ADD KEY `patient_fk_id_2` (`patient_fk_id`);

--
-- Indexes for table `patient_tests`
--
ALTER TABLE `patient_tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_report_fk_id` (`patient_report_fk_id`,`tests_type_fk_id`),
  ADD KEY `tests_type_fk_id` (`tests_type_fk_id`);

--
-- Indexes for table `tests_type`
--
ALTER TABLE `tests_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `patient_details`
--
ALTER TABLE `patient_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patient_reports`
--
ALTER TABLE `patient_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patient_tests`
--
ALTER TABLE `patient_tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tests_type`
--
ALTER TABLE `tests_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `patient_details`
--
ALTER TABLE `patient_details`
  ADD CONSTRAINT `patient_details_ibfk_1` FOREIGN KEY (`user_fk_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_reports`
--
ALTER TABLE `patient_reports`
  ADD CONSTRAINT `patient_reports_ibfk_1` FOREIGN KEY (`patient_fk_id`) REFERENCES `patient_details` (`id`);

--
-- Constraints for table `patient_tests`
--
ALTER TABLE `patient_tests`
  ADD CONSTRAINT `patient_tests_ibfk_1` FOREIGN KEY (`patient_report_fk_id`) REFERENCES `patient_reports` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_tests_ibfk_2` FOREIGN KEY (`tests_type_fk_id`) REFERENCES `tests_type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
