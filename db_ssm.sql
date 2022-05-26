-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 27, 2022 at 01:18 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ssm`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_authernotification`
--

CREATE TABLE `tbl_authernotification` (
  `id` int(11) NOT NULL,
  `note` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_authernotification`
--

INSERT INTO `tbl_authernotification` (`id`, `note`, `status`) VALUES
(1, 'Hi,Student book a slot of date 2021-12-04 and time 10 AM', 0),
(2, 'Hi,Student book a slot of date 2021-12-04 and time 8 AM', 0),
(3, 'Hi,Student book a slot of date 2021-12-02 and time 2 PM', 0),
(4, 'Hi,Student book a slot of date 2021-12-01 and time 11 AM', 0),
(5, 'Hi,Student book a slot of date 2021-12-01 and time 9 AM', 0),
(7, 'Hi,Student book a slot of date 2021-12-01 and time 8 AM', 0),
(8, 'Hi, book a slot of date  and time ', 0),
(9, 'Hi,Student book a slot of date 2022-02-13 and time 10 AM', 0),
(10, 'Hi, book a slot of date 2/2/2022 and time 8am', 0),
(11, 'Hi,Student book a slot of date 2/4/2022 and time 8am', 0),
(12, 'Hi,Student book a slot of date 2/3/2022 and time 8am', 0),
(13, 'Hi,Student book a slot of date 2/3/2022 and time 8am', 0),
(14, 'Hi,Student book a slot of date 2/28/2022 and time 8am', 0),
(15, 'Hi,Student book a slot of date 2/14/2022 and time 8am', 0),
(16, 'Hi,Student book a slot of date 2/28/2022 and time 12pm', 0),
(17, 'Hi,Student book a slot of date 3/1/2022 and time 11am', 0),
(18, 'Hi,Student book a slot of date 2/1/2022 and time 10am', 0),
(19, 'Hi,newstu book a slot of date 3/1/2022 and time 12pm', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slot`
--

CREATE TABLE `tbl_slot` (
  `slot_id` int(11) NOT NULL,
  `slotdate` varchar(255) NOT NULL,
  `slottime` varchar(255) NOT NULL,
  `user_id` int(255) NOT NULL DEFAULT -1,
  `authorid` int(11) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_slot`
--

INSERT INTO `tbl_slot` (`slot_id`, `slotdate`, `slottime`, `user_id`, `authorid`, `status`) VALUES
(13, '2/3/2022', '8am', 4, 0, 2),
(14, '2/28/2022', '12pm', 4, 1, 2),
(15, '3/2/2022', '12pm', -1, 1, 0),
(16, '2/4/2022', '8am', 4, 0, 2),
(17, '2/2/2022', '8am', 4, 0, 2),
(18, '2/14/2022', '8am', 4, 0, 2),
(19, '2/28/2022', '8am', 4, 0, 2),
(20, '3/1/2022', '12pm', 9, 1, 2),
(21, '3/1/2022', '11am', 4, 5, 2),
(22, '2/1/2022', '10am', 4, 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_studentnotification`
--

CREATE TABLE `tbl_studentnotification` (
  `id` int(11) NOT NULL,
  `note` varchar(255) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_studentnotification`
--

INSERT INTO `tbl_studentnotification` (`id`, `note`, `userid`, `status`) VALUES
(1, 'Hi,Student you book a slot of date 2021-12-04 and time 10 AM has been approve', '4', 0),
(2, 'Hi,Student you book a slot of date 2021-12-04 and time 10 AM has been approve', '4', 0),
(3, 'Hi,Student you book a slot of date 2021-12-04 and time 10 AM has been approve', '4', 0),
(4, 'Hi,Student you book a slot of date 2021-12-04 and time 10 AM has been approve', '4', 0),
(5, 'Hi,Student you book a slot of date 2021-12-04 and time 8 AM has been approve', '4', 0),
(6, 'Hi,Student you book a slot of date 2021-12-02 and time 2 PM has been approve', '4', 0),
(7, 'Hi,Student you book a slot of date 2021-12-01 and time 11 AM has been approve', '4', 0),
(8, 'Hi,Student you book a slot of date 2021-12-01 and time 9 AM has been cancel', '4', 0),
(9, 'Hi,Student you book a slot of date 2021-12-01 and time 9 AM has been approve', '4', 0),
(10, 'Hi,Student you book a slot of date 2021-12-01 and time 8 AM has been approve', '4', 0),
(11, 'Hi,Student you book a slot of date 2022-02-13 and time 10 AM has been approve', '4', 0),
(12, 'Hi,Student you book a slot of date 2/2/2022 and time 8am has been approve', '4', 0),
(13, 'Hi,Student you book a slot of date 2/4/2022 and time 8am has been approve', '4', 0),
(14, 'Hi,Student you book a slot of date 2/3/2022 and time 8am has been approve', '4', 0),
(15, 'Hi,Student you book a slot of date 2/28/2022 and time 8am has been approve', '4', 0),
(16, 'Hi,Student you book a slot of date 2/28/2022 and time 12pm has been approve', '4', 0),
(17, 'Hi,Student you book a slot of date 2/14/2022 and time 8am has been approve', '4', 0),
(18, 'Hi,Student you book a slot of date 3/1/2022 and time 11am has been approve', '4', 0),
(19, 'Hi,Student you book a slot of date 2/1/2022 and time 10am has been approve', '4', 0),
(20, 'Hi,newstu you book a slot of date 3/1/2022 and time 12pm has been approve', '9', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `fname`, `lname`, `email`, `password`, `status`) VALUES
(1, 'Author', 'as', 'author@gmail.com', '123', 1),
(2, 'as', 'as', 'mkmanishkumar490@gmail.com', 'asasas', 0),
(3, 'as', 'as', 'mkmanishkumar490@gmail.com', 'asasas', 0),
(4, 'Student', 'ZSDa', 'test@gmail.com', '1', 0),
(5, 'Django ', 'noris', 'django@mail.com', '123', 1),
(8, 'bruce', 'wayne', 'bruce@mail.com', '1234', 1),
(9, 'newstu', 'name', 'newstudent@mail.com', '1234', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_authernotification`
--
ALTER TABLE `tbl_authernotification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_slot`
--
ALTER TABLE `tbl_slot`
  ADD PRIMARY KEY (`slot_id`);

--
-- Indexes for table `tbl_studentnotification`
--
ALTER TABLE `tbl_studentnotification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_authernotification`
--
ALTER TABLE `tbl_authernotification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_slot`
--
ALTER TABLE `tbl_slot`
  MODIFY `slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_studentnotification`
--
ALTER TABLE `tbl_studentnotification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
