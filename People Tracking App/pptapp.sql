-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2022 at 01:26 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pptapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `admin_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `unique_key` int(11) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `name`, `admin_id`, `password`, `unique_key`, `level`) VALUES
(1, 'sachin.developer.1994@gmail.com', 'sachin Singh', 'ADM100', '$2y$10$BZAhc3EilrSYWn2FfXbCv.6hawkaOJ7zF16xOo1s39wgBQfoEYZ6i', 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pwdrecovery`
--

CREATE TABLE `pwdrecovery` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `expire_count` int(11) NOT NULL,
  `hash_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `rfid` varchar(255) NOT NULL,
  `rf_key` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `from_date` datetime NOT NULL,
  `from_location` varchar(255) NOT NULL,
  `to_date` datetime NOT NULL,
  `to_location` varchar(255) NOT NULL,
  `requested_on` date NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `comments` text NOT NULL,
  `files` varchar(255) NOT NULL,
  `head_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `rfid`, `rf_key`, `reason`, `description`, `from_date`, `from_location`, `to_date`, `to_location`, `requested_on`, `user_id`, `status`, `comments`, `files`, `head_count`) VALUES
(3, '1U9V-REQ-100', 100, 'Medical Checkup for Me', 'Allow me to travel', '2022-01-27 00:00:00', 'Srikalhasthi', '2022-01-19 00:00:00', 'Bangalore', '2022-01-22', 'USE100', 'PENDING', '', 'Array', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `linked_id_type` varchar(255) NOT NULL,
  `linked_id` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `user_key` int(11) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `name`, `linked_id_type`, `linked_id`, `mobile`, `user_id`, `user_key`, `level`) VALUES
(1, 'sachincs526@gmail.com', '$2y$10$F4F54TkKoUgu9H6PFv2nluU/5d91TIQzk9Q8/cM8R2CPHBECvF8.q', 'Sachin Singh', 'aadhar', '447056538969', '91 7799209121', 'USE100', 100, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pwdrecovery`
--
ALTER TABLE `pwdrecovery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pwdrecovery`
--
ALTER TABLE `pwdrecovery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
