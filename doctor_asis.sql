-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 25, 2021 at 04:31 PM
-- Server version: 5.7.24
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doctor_asis`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `appointed_date` datetime NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `age` int(100) DEFAULT NULL,
  `gender` int(2) NOT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `number` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `name`, `email`, `password`, `age`, `gender`, `occupation`, `address`, `number`, `created_at`) VALUES
(1, 'Shad Washington', 'noxi@mailinator.com', '$2y$10$ruUMmUekbBawG4DJs/qT3O1HXr0IXvY8EZ0dpxW37xu9LCwcQLZIG', 50, 0, 'Nesciunt aut cum ni', 'Eos consectetur ut ', '+1 (686) 273-6023', '2021-01-17 22:19:51'),
(2, 'Wyatt Harding', 'huqaxujy@mailinator.com', '$2y$10$UieM0entS3ZrrIq0vsyNMOhiZowSg.zPFxd5fSwca/SKrfxSrNHTm', 54, 1, 'Maxime ad aspernatur', 'Ad molestias asperna', '+1 (635) 554-5823', '2021-01-17 22:30:54'),
(3, 'Addison Shaffer', 'gekytyn@mailinator.com', '$2y$10$hrasg0onNWzO7/sBElz0m.F/Ogs8eUGZMcpjWvkoH4/vMvS63eO9G', 8, 0, 'Et vel qui quis anim', 'Quas illo minim eos', '+1 (837) 947-7352', '2021-01-17 22:31:31'),
(4, 'Cyrus Albert', 'fepeleg@mailinator.com', '$2y$10$bSEUyW2yRT./kRpQyON6GOWc.R9oGvkZNLzZ9wgxEbnPbY0xTAWLK', 40, 1, 'Omnis harum autem ea', 'Sunt ut ratione fugi', '+1 (683) 363-7553', '2021-01-18 20:34:29'),
(5, 'Curran Klein', 'gelutolipi@mailinator.com', '$2y$10$c9qvF./ophHlSIdA1or/FufUvK.SIMw9czxzfA3xfCyknckVqz00G', 99, 1, 'Quis vitae ipsum dol', 'Ratione consequatur', '+1 (303) 466-7701', '2021-01-18 20:36:54'),
(6, 'Astra Ford', 'lyhycijyd@mailinator.com', '$2y$10$97zgjhjmtHixtIKnlmqGaev7FhoM51P7Ey3ssyrDTaSF58pV9QcdO', 42, 0, 'Nobis ipsam pariatur', 'Quis aut alias liber', '+1 (982) 622-1441', '2021-01-18 20:39:45'),
(7, 'Marny Carson', 'hulyfug@mailinator.com', '$2y$10$xtLcIrK6GD7MAPuyUbtG9OJ4WPaaPIccXaXIhKx4eUwCD1j8gCORS', 69, 1, 'Placeat ipsum vero', 'Sunt praesentium dol', '+1 (854) 453-3297', '2021-01-18 20:45:14'),
(8, 'Nicholas Williams', 'jegeqomaxa@mailinator.com', '$2y$10$yE4I20SHdG/rRtEcxLkwx.qRBjZNzHw12GoixHEw/TksNVkJVSZJW', 43, 1, 'Aut alias aliquid ma', 'Est voluptatem earu', '+1 (444) 685-7281', '2021-01-18 21:07:52');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `prescription` text,
  `disease_data` text NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `group_id`, `created_at`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$yE4I20SHdG/rRtEcxLkwx.qRBjZNzHw12GoixHEw/TksNVkJVSZJW', 1, '2021-01-18 21:31:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
