-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2019 at 11:20 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pasodo`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ID`, `name`) VALUES
(1, 'categories list'),
(2, 'staff'),
(3, 'others'),
(4, 'farmer');

-- --------------------------------------------------------

--
-- Table structure for table `client2`
--

CREATE TABLE `client2` (
  `ID` int(11) NOT NULL,
  `clientID` int(8) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `phone` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `image` blob NOT NULL,
  `created_at` varchar(20) NOT NULL,
  `updated_at` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client2`
--

INSERT INTO `client2` (`ID`, `clientID`, `firstName`, `middleName`, `lastName`, `phone`, `category_id`, `gender`, `image`, `created_at`, `updated_at`) VALUES
(70, 32608135, 'Oscar', 'Hazard', 'Master', 711522738, 4, 'male', 0x32303135303530375f3039303335302e6a7067, '20-01-2019 03:29:36', '20-01-2019 03:29:36'),
(73, 23547689, 'Jane', 'Hazard', 'Doe', 724657487, 3, 'male', 0x32303135303530375f3039303335302e6a7067, '20-01-2019 10:02:12', '20-01-2019 10:02:12');

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `ID` int(11) NOT NULL,
  `clientID` int(10) NOT NULL,
  `amount` int(10) NOT NULL,
  `created_at` varchar(20) NOT NULL,
  `updated_at` varchar(20) NOT NULL,
  `deadline_at` varchar(20) NOT NULL,
  `image` blob NOT NULL,
  `notes` varchar(1000) NOT NULL,
  `status` enum('approved','pending','unapproved','') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`ID`, `clientID`, `amount`, `created_at`, `updated_at`, `deadline_at`, `image`, `notes`, `status`) VALUES
(25, 32608135, 1000, '20-01-2019 12:56:25', '20-01-2019 12:56:25', '2019-01-30', 0x34383430383936345f31303135363835393536363736383931375f353034373133333134363034333132313636345f6e2e6a7067, 'Add notes here', 'approved'),
(26, 32608135, 2300, '20-01-2019 13:19:37', '20-01-2019 13:19:37', '2019-01-30', 0x313432363039313637313332322e706e67, 'Good loan to be paid', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `ID` int(11) NOT NULL,
  `clientID` int(10) NOT NULL,
  `amount` int(10) NOT NULL,
  `created_at` varchar(20) NOT NULL,
  `updated_at` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `client2`
--
ALTER TABLE `client2`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `client2`
--
ALTER TABLE `client2`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
