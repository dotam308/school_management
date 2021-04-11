-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2021 at 04:14 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `classdata`
--

CREATE TABLE `classdata` (
  `name` varchar(10) NOT NULL,
  `maxQuatity` int(80) NOT NULL,
  `currentQuatity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classdata`
--

INSERT INTO `classdata` (`name`, `maxQuatity`, `currentQuatity`) VALUES
('K64-CLC', 50, 4),
('K64-CN', 50, 1),
('K65-CC', 70, 1);

-- --------------------------------------------------------

--
-- Table structure for table `coursedata`
--

CREATE TABLE `coursedata` (
  `courseCode` varchar(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `teacher` varchar(30) NOT NULL,
  `creditQuatity` int(11) NOT NULL,
  `period` text NOT NULL,
  `place` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coursedata`
--

INSERT INTO `coursedata` (`courseCode`, `name`, `teacher`, `creditQuatity`, `period`, `place`) VALUES
('1101', 'Toán rời rạc', 'Lê Phê Đô', 3, '7h-10h', '303-GĐ2'),
('1103', 'Cấu giải', 'Cao Thiên Cường', 4, '10h-2h', '102-G2');

-- --------------------------------------------------------

--
-- Table structure for table `gradedata`
--

CREATE TABLE `gradedata` (
  `id` int(11) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `belongUnit` varchar(20) NOT NULL,
  `courseName` varchar(20) NOT NULL,
  `grade` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gradedata`
--

INSERT INTO `gradedata` (`id`, `fullName`, `belongUnit`, `courseName`, `grade`) VALUES
(1, 'Đỗ Đức Tâm', 'K64-CLC', 'Toán rời rạc', '10.00'),
(5, 'Nguyễn Bá Vinh', 'K64-CLC', 'Cấu giải', '10.00'),
(1, 'Đỗ Đức Tâm', 'K64-CLC', 'Cấu giải', '10.00');

-- --------------------------------------------------------

--
-- Table structure for table `registdata`
--

CREATE TABLE `registdata` (
  `id` int(11) NOT NULL,
  `fullName` varchar(30) NOT NULL,
  `belongUnit` varchar(11) NOT NULL,
  `courseCode` varchar(10) NOT NULL,
  `courseName` varchar(50) NOT NULL,
  `creditQuatity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registdata`
--

INSERT INTO `registdata` (`id`, `fullName`, `belongUnit`, `courseCode`, `courseName`, `creditQuatity`) VALUES
(1, 'Đỗ Đức Tâm', 'K64-CLC', '1101', 'Toán rời rạc', 3),
(1, 'Đỗ Đức Tâm', 'K64-CLC', '1103', 'Cấu giải', 4);

-- --------------------------------------------------------

--
-- Table structure for table `studentdata`
--

CREATE TABLE `studentdata` (
  `id` int(11) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `dateOfBirth` date NOT NULL DEFAULT current_timestamp(),
  `contactNumber` int(10) NOT NULL,
  `belongUnit` varchar(15) NOT NULL,
  `other` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studentdata`
--

INSERT INTO `studentdata` (`id`, `fullname`, `dateOfBirth`, `contactNumber`, `belongUnit`, `other`) VALUES
(1, 'Đỗ Đức Tâm', '2001-08-30', 967915305, 'K64-CLC', ''),
(5, 'Nguyễn Bá Vinh', '2001-08-30', 967915305, 'K64-CLC', 'abc'),
(12, 'Nguyễn Bá Quát', '2001-08-30', 1201020210, 'K65-CC', ''),
(22, 'Nguyễn Văn A', '2001-12-02', 12129192, 'K64-CLC', ''),
(103, 'Đỗ Trung Kiên', '2001-08-30', 343543199, 'K64-CN', ''),
(38250, 'Đỗ Mạnh Cường', '2001-08-30', 967915305, 'K64-CLC', 'abcdef');

-- --------------------------------------------------------

--
-- Table structure for table `teacherdata`
--

CREATE TABLE `teacherdata` (
  `id` int(11) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `contactNumber` int(11) NOT NULL,
  `belongUnit` varchar(15) NOT NULL,
  `manageUnit` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacherdata`
--

INSERT INTO `teacherdata` (`id`, `fullname`, `dateOfBirth`, `contactNumber`, `belongUnit`, `manageUnit`) VALUES
(1, 'Đỗ Mạnh Cường', '1993-04-12', 343543199, 'UET', 'K65-CC'),
(2, 'Nguyễn Bá Vinh', '1994-11-01', 1201020210, 'VNU', 'K64-CLC');

-- --------------------------------------------------------

--
-- Table structure for table `temp_table`
--

CREATE TABLE `temp_table` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `class` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `temp_table`
--

INSERT INTO `temp_table` (`id`, `name`, `class`) VALUES
(1, 'Đỗ Đức Tâm', 'K64-CLC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coursedata`
--
ALTER TABLE `coursedata`
  ADD PRIMARY KEY (`courseCode`);

--
-- Indexes for table `studentdata`
--
ALTER TABLE `studentdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacherdata`
--
ALTER TABLE `teacherdata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `studentdata`
--
ALTER TABLE `studentdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19020390;

--
-- AUTO_INCREMENT for table `teacherdata`
--
ALTER TABLE `teacherdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1994;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
