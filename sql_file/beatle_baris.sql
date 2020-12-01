-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 01, 2020 at 02:25 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beatle_baris`
--

-- --------------------------------------------------------

--
-- Table structure for table `baris_devision`
--

CREATE TABLE `baris_devision` (
  `id` bigint(11) NOT NULL,
  `devision_name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `baris_devision`
--

INSERT INTO `baris_devision` (`id`, `devision_name`, `created_by`, `status`, `created_date`, `updated_date`) VALUES
(1, 'Central Railway', 1, 1, '2020-11-27 12:46:43', '0000-00-00 00:00:00'),
(2, 'Eastern Railway', 1, 1, '2020-11-27 12:46:52', '0000-00-00 00:00:00'),
(3, 'East Central Railway', 1, 1, '2020-11-27 12:46:59', '0000-00-00 00:00:00'),
(4, 'East Coast Railway', 1, 1, '2020-11-27 12:47:04', '0000-00-00 00:00:00'),
(5, 'Northern Railway', 1, 1, '2020-11-27 12:47:10', '0000-00-00 00:00:00'),
(6, 'North Central Railway', 1, 1, '2020-11-27 12:47:22', '0000-00-00 00:00:00'),
(7, 'North Eastern Railway', 1, 1, '2020-11-27 12:47:31', '0000-00-00 00:00:00'),
(8, 'North Frontier Railway', 1, 1, '2020-11-27 12:47:43', '0000-00-00 00:00:00'),
(9, 'North Western Railway', 1, 1, '2020-11-27 12:47:49', '0000-00-00 00:00:00'),
(10, 'Southern Railway', 1, 1, '2020-11-27 12:47:57', '0000-00-00 00:00:00'),
(11, 'South Central Railway', 1, 1, '2020-11-27 12:48:03', '0000-00-00 00:00:00'),
(12, 'South Eastern Railway', 1, 1, '2020-11-27 12:48:08', '0000-00-00 00:00:00'),
(13, 'South East Central Railway', 1, 1, '2020-11-27 12:48:18', '0000-00-00 00:00:00'),
(14, 'South Western Railway', 1, 1, '2020-11-27 12:48:23', '0000-00-00 00:00:00'),
(15, 'Western Railway', 1, 1, '2020-11-27 12:48:31', '0000-00-00 00:00:00'),
(16, 'West Central Railway', 1, 1, '2020-11-27 12:48:36', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `baris_processes`
--

CREATE TABLE `baris_processes` (
  `id` bigint(11) NOT NULL,
  `processes_name` varchar(255) NOT NULL,
  `processes_full_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `baris_processes`
--

INSERT INTO `baris_processes` (`id`, `processes_name`, `processes_full_name`, `status`, `created_by`, `created_date`, `updated_date`) VALUES
(1, 'PMC', 'Platform Mechanized Cleaning / Equipment Consumable & Chemical', 1, 1, '2020-11-29 14:56:29', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `baris_station`
--

CREATE TABLE `baris_station` (
  `id` bigint(11) NOT NULL,
  `station_name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `baris_station`
--

INSERT INTO `baris_station` (`id`, `station_name`, `created_by`, `status`, `created_date`, `updated_date`) VALUES
(1, 'jaipur', 1, 1, '2020-12-01 00:00:00', '2020-12-01 00:00:00'),
(2, 'gorakhpur', 1, 1, '2020-12-01 00:00:00', '2020-12-01 00:00:00'),
(7, 'test', 1, 1, '2020-12-01 11:12:41', '0000-00-00 00:00:00'),
(8, 'mainstation', 1, 1, '2020-12-01 14:24:21', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `baris_subprocesses`
--

CREATE TABLE `baris_subprocesses` (
  `id` bigint(11) NOT NULL,
  `sub_processes_name` varchar(255) NOT NULL,
  `processes_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `baris_subprocesses`
--

INSERT INTO `baris_subprocesses` (`id`, `sub_processes_name`, `processes_id`, `status`, `created_by`, `created_date`, `updated_date`) VALUES
(6, ' Daily Surprise Audit ', 1, 1, 1, '2020-11-29 16:13:18', '0000-00-00 00:00:00'),
(7, 'Daily Machine Report', 1, 1, 1, '2020-11-29 16:13:18', '0000-00-00 00:00:00'),
(8, ' Manpower Log Details', 1, 1, 1, '2020-11-29 16:13:18', '0000-00-00 00:00:00'),
(9, 'Daily Performance Log', 1, 1, 1, '2020-11-29 16:13:18', '0000-00-00 00:00:00'),
(10, ' Billing', 1, 1, 1, '2020-11-29 16:13:18', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `baris_user`
--

CREATE TABLE `baris_user` (
  `id` bigint(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_devision` int(11) NOT NULL,
  `user_station` int(11) NOT NULL,
  `user_type` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `baris_user`
--

INSERT INTO `baris_user` (`id`, `username`, `user_password`, `first_name`, `last_name`, `user_email`, `user_phone`, `user_image`, `user_devision`, `user_station`, `user_type`, `status`, `created_by`, `created_date`, `updated_date`) VALUES
(1, 'admin', 'e6e061838856bf47e1de730719fb2609', 'baris', 'admin', 'admin@gmail.com', '9897885544', '', 0, 0, 1, 1, 0, '2020-11-28 00:00:00', '2020-11-28 00:00:00'),
(2, 'sdf', 'admin@123', 'sdf', 'sdf', 'sd@gsafd.as', '1234567890', '', 3, 2, 2, 1, 1, '2020-11-30 16:50:49', '0000-00-00 00:00:00'),
(5, 'ankitsharma', 'e807f1fcf82d132f9bb018ca6738a19f', 'annjali', 'sharma', 'test@gmail.com', '1234567890', '', 2, 8, 2, 1, 1, '2020-12-01 14:24:46', '0000-00-00 00:00:00'),
(6, 'amansharma', 'e807f1fcf82d132f9bb018ca6738a19f', 'aman', 'sharma', 'aman@gmail.com', '1234567890', '', 2, 1, 2, 1, 1, '2020-12-01 14:24:58', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `baris_devision`
--
ALTER TABLE `baris_devision`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `baris_processes`
--
ALTER TABLE `baris_processes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `baris_station`
--
ALTER TABLE `baris_station`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `baris_subprocesses`
--
ALTER TABLE `baris_subprocesses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `baris_user`
--
ALTER TABLE `baris_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `baris_devision`
--
ALTER TABLE `baris_devision`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `baris_processes`
--
ALTER TABLE `baris_processes`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `baris_station`
--
ALTER TABLE `baris_station`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `baris_subprocesses`
--
ALTER TABLE `baris_subprocesses`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `baris_user`
--
ALTER TABLE `baris_user`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
