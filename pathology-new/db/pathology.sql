-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2021 at 10:02 AM
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
  `name` varchar(255) NOT NULL,
  `reference_interval` varchar(255) NOT NULL,
  `specimen_type` varchar(255) DEFAULT NULL,
  `testing_frequency` varchar(255) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tests_type`
--

INSERT INTO `tests_type` (`id`, `name`, `reference_interval`, `specimen_type`, `testing_frequency`, `comments`, `status`, `is_deleted`) VALUES
(1, 'Glucose, Fasting', '70-99 mg/dL', '', '', '3.86-5.45 mmol/L', 1, 0),
(2, 'Glucose, Random', '70-139 mg/dL', '', '', '3.86-7.66 mmol/L', 1, 0),
(3, 'Hemoglobin, Men', '13.3-17.7 g/dL', '', '', '133-177 g/L', 1, 0),
(4, 'Hemoglobin, Women', '11.7-15.7 g/dL', '', '', '117-157 g/L', 1, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
