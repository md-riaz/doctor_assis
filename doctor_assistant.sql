-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 28, 2021 at 03:04 AM
-- Server version: 10.3.23-MariaDB
-- PHP Version: 7.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smart_doctor`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `self` tinyint(4) NOT NULL,
  `symptom` text CHARACTER SET utf8mb4 NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `blood_group` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `appoint_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `doc_id`, `user_id`, `hospital_id`, `name`, `self`, `symptom`, `gender`, `blood_group`, `address`, `appoint_date`, `status`, `created_at`) VALUES
(1, 3, 2, 4, '', 0, 'Ratione eius aliquid', 1, 'Soluta ea totam aut ', 'Veniam quisquam est', '2021-06-29 16:01:00', 1, '2021-06-27 21:26:29'),
(2, 3, 2, 8, 'Isabella Ayala', 1, 'Fugiat nisi excepteu', 0, 'Rerum voluptates sae', 'Asperiores labore mo', '2021-06-29 13:52:00', 1, '2021-06-27 21:26:45'),
(3, 3, 2, 8, 'Cassady Ochoa', 1, 'Id ratione quidem qu', 0, 'Officia commodo moll', 'Enim deserunt ipsum', '2021-06-29 09:07:00', 1, '2021-06-27 21:27:14');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `status`, `created_at`) VALUES
(1, 'Cardiac Surgery - Adult', 1, '2021-06-22 09:20:44'),
(2, 'Cardiology - Adult', 1, '2021-06-22 09:20:44'),
(3, 'Microbiology', 1, '2021-06-22 09:20:44'),
(4, 'Radiology', 1, '2021-06-22 09:25:48'),
(5, 'General Surgery', 1, '2021-06-22 09:25:48'),
(6, 'Gastroenterology - Medical', 1, '2021-06-22 09:25:48'),
(7, 'Electrophysiology', 1, '2021-06-22 09:25:48'),
(8, 'Gastroenterology - Surgical', 1, '2021-06-22 09:25:48'),
(9, 'Uro - Oncology', 1, '2021-06-22 09:25:48'),
(10, 'Orthopaedics', 1, '2021-06-22 09:25:48'),
(11, 'Kidney Transplant - Adult', 0, '2021-06-22 09:25:48'),
(12, 'Diabetology', 1, '2021-06-22 09:25:48'),
(13, 'Blood Bank', 0, '2021-06-22 09:25:48'),
(14, 'Emergency Medicine', 0, '2021-06-22 09:25:48'),
(15, 'Neurosurgery', 1, '2021-06-22 09:25:48');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `short_qualification` text NOT NULL,
  `about` text NOT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `linkedin` varchar(100) DEFAULT NULL,
  `specialist` text DEFAULT NULL,
  `experience` text DEFAULT NULL,
  `qulification` text DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `membership` text DEFAULT NULL,
  `chamber_availability` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `user_id`, `short_qualification`, `about`, `facebook`, `linkedin`, `specialist`, `experience`, `qulification`, `department_id`, `membership`, `chamber_availability`, `status`, `created_at`) VALUES
(1, 3, 'MBBS, FCPS (SURGERY)', 'I am an Assistant Professor, Department of Surgery at Dhaka Central International Medical College & Hospital. My sub-specialty interest is to ensure continued medical education and side by side medical research.', '#', '#', NULL, NULL, NULL, 1, NULL, NULL, 1, '2021-06-23 11:22:14'),
(3, 5, 'MS,FCPS, MRCS, MRCPS, WHO Fellow, Urology & Renal Transplant', 'Assistant Professor,\r\nDept. of Urology,\r\nShaheed Suhrawardy Medical College and Hospital, Dhaka.\r\n\r\nWHO Fellow in Urology and Renal Transplant.\r\n\r\nEx. Specialist Registrar,\r\nUrology, National Health Services, UK', '#', '#', NULL, NULL, NULL, 1, NULL, NULL, 0, '2021-06-24 20:01:50');

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `id` int(11) NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `district` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`id`, `name`, `district`, `status`, `created_at`) VALUES
(1, 'Saic General Hospital', 'Bogra', 1, '2021-06-22 09:32:01'),
(2, 'Independent General Hospital', 'Bogra', 1, '2021-06-22 09:32:01'),
(3, 'Ibn Sina Diagnostic & Consultation Center', 'Bogra', 1, '2021-06-22 09:32:01'),
(4, 'MCH Hospital', 'Bogra', 1, '2021-06-22 09:32:01'),
(5, 'Shondhani General Hospital', 'Bogra', 1, '2021-06-22 09:32:01'),
(6, 'Mohammad Ali Hospital', 'Bogra', 1, '2021-06-22 09:32:01'),
(7, 'Bogura Nursing Home', 'Bogra', 1, '2021-06-22 09:32:01'),
(8, 'Shaheed Ziaur Rahman Medical College Hospital (SZMCH)', 'Bogra', 1, '2021-06-22 09:33:39'),
(9, 'Doctors Clinic Unit 1', 'Bogra', 1, '2021-06-22 09:33:39'),
(10, 'Doctors Clinic Unit 2', 'Bogra', 1, '2021-06-22 09:33:39'),
(11, 'Rainbow Community Hospital & Diagnostic Centre', 'Bogra', 1, '2021-06-22 09:33:39'),
(12, 'Central General Hospital', 'Bogra', 1, '2021-06-22 09:34:49');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `appoint_id` int(11) NOT NULL,
  `prescription` text CHARACTER SET utf8mb4 NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `group_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `phone`, `password`, `group_id`, `status`, `created_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '01797810793', '$2y$10$LaiRMlLkV4ZNDR4Lf1GDhuW3oGw8oV6Ts1X0XBTFYENTRZW.M/dni', 1, 1, '2021-06-22 09:35:52'),
(2, 'User', 'user@gmail.com', '01797810793', '$2y$10$LaiRMlLkV4ZNDR4Lf1GDhuW3oGw8oV6Ts1X0XBTFYENTRZW.M/dni', 0, 1, '2021-06-22 09:35:52'),
(3, 'Dr. Hasnat Zaman Zim', 'doctor@gmail.com', '01797810793', '$2y$10$LaiRMlLkV4ZNDR4Lf1GDhuW3oGw8oV6Ts1X0XBTFYENTRZW.M/dni', 2, 1, '2021-06-22 09:35:52'),
(5, 'Dr. Md. Fazal Naser', 'fazalnasir@gmail.com', '', '$2y$10$ezE9DU9EnCS0396yfQT/HuSG1uZWx2dglV35V3V/JfGijBVNrK5b.', 2, 1, '2021-06-24 20:01:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
