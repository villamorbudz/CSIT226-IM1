-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2024 at 10:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbomasasf1`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblevent`
--

CREATE TABLE `tblevent` (
  `Event_ID` bigint(20) NOT NULL,
  `Event_Title` varchar(100) NOT NULL,
  `Event_Description` varchar(255) NOT NULL,
  `Event_Date` date NOT NULL,
  `Event_Time` time NOT NULL,
  `Event_Venue` varchar(255) NOT NULL,
  `Event_Type` varchar(100) NOT NULL,
  `Host_ID` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblevent`
--

INSERT INTO `tblevent` (`Event_ID`, `Event_Title`, `Event_Description`, `Event_Date`, `Event_Time`, `Event_Venue`, `Event_Type`, `Host_ID`) VALUES
(1, 'Test YIPEE', 'Testing ras code (edited)', '2024-04-13', '17:00:00', 'Akong Balay', 'Chill lang', 1),
(3, 'Jane BDAY', 'Celebrate My Birthday with Me', '2024-10-08', '17:00:00', 'My House', 'Birthday', 4),
(4, 'More testing', 'Testing after editing some small parts of code', '2024-04-13', '18:00:00', 'INDA HOUSE ! ! !', 'Homework', 1),
(5, 'Housewarming Event', 'Help me feel welcome inda neigbourhood', '2024-04-06', '10:00:00', 'My house', 'Chilling Tah', 3),
(6, 'Welcome US', 'Beginners Welcome Party', '2024-04-13', '18:44:00', 'My House', 'Welcome Party', 8),
(8, 'Testing_host00', 'Testing whether currentuser_id reflects on tblevent', '2024-05-05', '13:30:00', 'Home', 'Chill', 5),
(11, 'Testing_edit00 KArylle', 'testing edit portion for events (this is now edited)', '2024-05-20', '04:00:00', 'Home', 'Homework', 2),
(12, 'Tesitng_count00', 'testing count report 00 EDITED', '2024-04-06', '02:00:00', 'Home', 'Homework', 2),
(13, 'Testing_count01', 'Testing count report 01', '2024-04-13', '11:00:00', 'Homework', 'Home', 1),
(14, 'Bday nako', 'Bday nako oi', '2024-12-25', '23:59:00', 'Balay nako', 'Bday', 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbluseraccount`
--

CREATE TABLE `tbluseraccount` (
  `acctid` bigint(20) UNSIGNED NOT NULL,
  `emailadd` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `usertype` enum('ADMIN','USER') NOT NULL DEFAULT 'USER',
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluseraccount`
--

INSERT INTO `tbluseraccount` (`acctid`, `emailadd`, `username`, `password`, `usertype`, `active`) VALUES
(1, 'fiel@gmail.com', 'adminFiel', '$2y$12$fZlilWjU3ZrrwC8Ps/eRgu3RQTu8Ph0OAzCG0FLT55GUfq11qrQxW', 'ADMIN', 1),
(2, 'giles@gmail.com', 'adminGiles', '$2y$12$2ZbsdGRfSn1rxsjHAtLBZ.Dcr/XjroyfpQMpVE8aD17iUViVome9S', 'ADMIN', 1),
(3, 'gwen@gmail.com', 'gwen123', '$2y$12$JuwYNUXUsob/PmQpGndMWeQWWWfb3e6p0j0L2qQPeXxfOd.v1gZzi', 'USER', 1),
(4, 'jane@gmail.com', 'jane123', '$2y$12$vLOzd7/4wOqihh/LwBL1BuWeYFLdhXsjcRilOeQdmityApL82H7FC', 'USER', 1),
(5, 'jeffrey@gmail.com', 'jeff123', '$2y$12$AopIXnoolsRxIdtfSMYq6OIt2zlV783Vo1TL8R3jhDNYcgCQSrpDm', 'USER', 0),
(6, 'arabela@gmail.com', 'arabela123', '$2y$12$.6DtCets43ynXsz8.DMZNuXTvAbEBSz5zMBMcdAkFEVV5HA44amSe', 'USER', 1),
(7, 'thea@gmail.com', 'thea123', '$2y$12$Uj7ZImUrAoM/Hy2ub.J8m.W/QYCJUbjibquW63PiqCbUCti2xYnrm', 'USER', 1),
(8, 'charisse@gmail.com', 'char123', '$2y$12$NNb2GKo2b76jTZQUL2IJ0.LfyYYu.2KYZqmYjbfWQ98ZJIp5S9FPy', 'USER', 1),
(9, 'miggy@gmail.com', 'miggy123', '$2y$12$PZmGmgylqZScAo46bt.ch.5e6jJ0FfXRWEyo3z/aqZGIt6WGgQh6G', 'USER', 1),
(10, 'jimmy@gmail.com', 'jimmy123', '$2y$12$tjbodT6tvkUMzL3SaqmlXuvzTs2LNzvtgWnEK7C93R3LeXWMxF7ti', 'USER', 1),
(11, 'wakwak@gmail.com', 'wakwak123', '$2y$12$FbUldhp00WAcBljnUIY9weWy1VkfBru4hl2qKimntx/ZbwWNNd8Uq', 'USER', 1),
(12, 'karylle@gmail.com', 'karylle123', '$2y$12$sYJN8NeEJqRcCRzwvs9n7OnPNrIoXzrXON2vYqAg5jHdHrMjS1XQq', 'USER', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbluserprofile`
--

CREATE TABLE `tbluserprofile` (
  `userid` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `gender` enum('MALE','FEMALE','OTHER') NOT NULL,
  `birthdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluserprofile`
--

INSERT INTO `tbluserprofile` (`userid`, `firstname`, `lastname`, `gender`, `birthdate`) VALUES
(1, 'Fiel', 'Omas-as', 'MALE', '2004-07-08'),
(2, 'Giles', 'Villamor', 'MALE', '2004-07-08'),
(3, 'Gwyneth', 'Teloren', 'FEMALE', '2003-08-08'),
(4, 'Jane', 'Labasteda', 'FEMALE', '2003-10-08'),
(5, 'Jeffrey', 'Kho', 'MALE', '2003-12-13'),
(6, 'Arabela', 'Uy', 'FEMALE', '2003-01-15'),
(7, 'Thea', 'Omas-as', 'FEMALE', '2000-12-05'),
(8, 'Charisse', 'Inso', 'FEMALE', '2000-01-01'),
(9, 'Miggy', 'Labasteda', 'MALE', '2014-01-08'),
(10, 'Jimmy', 'Malvoro', 'MALE', '2002-06-11'),
(11, 'Wakwak', 'Ako', 'OTHER', '2015-01-06'),
(12, 'Karylle', 'Delos Reyes', 'FEMALE', '2003-12-25'),
(13, 'User00', 'user', 'OTHER', '2024-05-16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblevent`
--
ALTER TABLE `tblevent`
  ADD PRIMARY KEY (`Event_ID`),
  ADD KEY `host` (`Host_ID`);

--
-- Indexes for table `tbluseraccount`
--
ALTER TABLE `tbluseraccount`
  ADD PRIMARY KEY (`acctid`);

--
-- Indexes for table `tbluserprofile`
--
ALTER TABLE `tbluserprofile`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblevent`
--
ALTER TABLE `tblevent`
  MODIFY `Event_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbluseraccount`
--
ALTER TABLE `tbluseraccount`
  MODIFY `acctid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbluserprofile`
--
ALTER TABLE `tbluserprofile`
  MODIFY `userid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblevent`
--
ALTER TABLE `tblevent`
  ADD CONSTRAINT `host` FOREIGN KEY (`Host_ID`) REFERENCES `tbluseraccount` (`acctid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
