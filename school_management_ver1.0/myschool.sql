-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2021 at 05:04 AM
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
-- Database: `myschool`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `className` varchar(12) NOT NULL,
  `maxStudent` int(11) NOT NULL,
  `numOfStudents` int(11) NOT NULL,
  `teacherId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `className`, `maxStudent`, `numOfStudents`, `teacherId`) VALUES
(1, 'K64-CLC', 60, 0, 20),
(101, 'K64-L', 50, 0, 11),
(106, 'K64-CF', 50, 0, 17),
(110, 'K64-CK', 50, 0, 13),
(112, 'K65-CB', 50, 0, 16),
(116, 'K64-CN', 50, 0, 10),
(123, 'K65-CM', 45, 0, 14),
(127, 'K65-CT', 45, 0, 15),
(128, 'K65-CE', 50, 0, 18);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `credit` int(11) NOT NULL,
  `startTime` varchar(5) NOT NULL,
  `endTime` varchar(5) NOT NULL,
  `place` varchar(11) NOT NULL,
  `courseCode` varchar(15) NOT NULL,
  `courseName` varchar(50) NOT NULL,
  `courseClassCode` varchar(20) NOT NULL,
  `maxStudent` int(11) NOT NULL,
  `teacherId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `credit`, `startTime`, `endTime`, `place`, `courseCode`, `courseName`, `courseClassCode`, `maxStudent`, `teacherId`) VALUES
(1, 2, '7h', '10h', '301-GĐ2', '1101', 'Toán cao cấp', 'INT2210 1', 50, 19),
(2, 3, '7h', '10h', '301-G2', '1103', 'Cấu giải', '1103 1', 50, 11),
(7, 4, '7h', '11h', '301-GĐ2', 'INT2213', 'Nhập môn lập trình', 'INT2213 1', 50, 20),
(8, 4, '7h', '11h', '301-GĐ2', 'INT2213', 'Nhập môn lập trình', 'INT2213 1', 50, 19),
(9, 3, '10h', '13h', '201-G2', 'INT2203', 'Lập trình nâng cao', 'INT2203 1', 60, 19),
(10, 2, '9h', '11h', '307-GĐ2', 'INT2207', 'Lịch sử Đảng', 'INT2207 1', 50, 18);

-- --------------------------------------------------------

--
-- Table structure for table `registers`
--

CREATE TABLE `registers` (
  `id` int(11) NOT NULL,
  `courseId` int(11) NOT NULL,
  `studentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registers`
--

INSERT INTO `registers` (`id`, `courseId`, `studentId`) VALUES
(120, 1, 19020452),
(121, 2, 19020452),
(122, 7, 19020452),
(123, 9, 19020452),
(131, 9, 19020445),
(134, 2, 19020467),
(135, 7, 19020467),
(136, 9, 19020467),
(143, 1, 19020469),
(144, 2, 19020469),
(145, 7, 19020469),
(146, 9, 19020469),
(148, 1, 19020470),
(149, 2, 19020470),
(150, 7, 19020470),
(151, 9, 19020470),
(153, 7, 19020471),
(154, 9, 19020471),
(156, 1, 19020472),
(157, 2, 19020472),
(158, 7, 19020472),
(159, 9, 19020472),
(161, 2, 19020474),
(162, 7, 19020474),
(163, 1, 19020475),
(164, 2, 19020475),
(165, 7, 19020475),
(166, 9, 19020475),
(168, 1, 19020476),
(169, 2, 19020476),
(170, 7, 19020476),
(171, 9, 19020476),
(173, 7, 19020477),
(174, 9, 19020477),
(176, 1, 19020478),
(177, 2, 19020478),
(178, 7, 19020478),
(179, 1, 19020479),
(180, 2, 19020479),
(181, 7, 19020479),
(182, 9, 19020479),
(184, 1, 19020480),
(185, 2, 19020480),
(186, 7, 19020480),
(187, 9, 19020480),
(189, 1, 19020481),
(190, 2, 19020481),
(191, 7, 19020481),
(192, 1, 19020482),
(193, 2, 19020482),
(194, 7, 19020482),
(196, 1, 19020441),
(197, 2, 19020441),
(198, 7, 19020441),
(199, 7, 19020446),
(200, 10, 19020446);

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `id` int(11) NOT NULL,
  `score` decimal(3,1) NOT NULL,
  `courseId` int(11) NOT NULL,
  `studentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`id`, `score`, `courseId`, `studentId`) VALUES
(6703, '10.0', 1, 19020452),
(6704, '9.0', 2, 19020452),
(6705, '9.0', 7, 19020452),
(6706, '8.0', 9, 19020452),
(6707, '7.0', 9, 19020445),
(6708, '7.0', 2, 19020467),
(6709, '9.0', 7, 19020467),
(6710, '0.0', 9, 19020467),
(6711, '9.0', 1, 19020469),
(6712, '0.0', 2, 19020469),
(6713, '0.0', 7, 19020469),
(6714, '8.0', 9, 19020469),
(6715, '0.0', 1, 19020470),
(6716, '9.0', 2, 19020470),
(6717, '0.0', 7, 19020470),
(6718, '10.0', 9, 19020470),
(6719, '0.0', 7, 19020471),
(6720, '10.0', 9, 19020471),
(6721, '0.0', 1, 19020472),
(6722, '0.0', 2, 19020472),
(6723, '0.0', 7, 19020472),
(6724, '0.0', 9, 19020472),
(6725, '9.0', 2, 19020474),
(6726, '0.0', 7, 19020474),
(6727, '0.0', 1, 19020475),
(6728, '0.0', 2, 19020475),
(6729, '0.0', 7, 19020475),
(6730, '0.0', 9, 19020475),
(6731, '0.0', 1, 19020476),
(6732, '0.0', 2, 19020476),
(6733, '0.0', 7, 19020476),
(6734, '0.0', 9, 19020476),
(6735, '0.0', 7, 19020477),
(6736, '0.0', 9, 19020477),
(6737, '0.0', 1, 19020478),
(6738, '0.0', 2, 19020478),
(6739, '0.0', 7, 19020478),
(6740, '0.0', 1, 19020479),
(6741, '0.0', 2, 19020479),
(6742, '0.0', 7, 19020479),
(6743, '0.0', 9, 19020479),
(6744, '0.0', 1, 19020480),
(6745, '0.0', 2, 19020480),
(6746, '0.0', 7, 19020480),
(6747, '0.0', 9, 19020480),
(6748, '0.0', 1, 19020481),
(6749, '0.0', 2, 19020481),
(6750, '0.0', 7, 19020481),
(6751, '0.0', 1, 19020482),
(6752, '0.0', 2, 19020482),
(6753, '0.0', 7, 19020482),
(6754, '0.0', 1, 19020441),
(6755, '0.0', 2, 19020441),
(6756, '0.0', 7, 19020441),
(6757, '0.0', 7, 19020446),
(6758, '0.0', 10, 19020446);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `classId` int(11) NOT NULL,
  `contactNumber` varchar(11) NOT NULL,
  `dob` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `fullName`, `classId`, `contactNumber`, `dob`) VALUES
(19020441, 'Đỗ Đức Tâm', 1, '0123456789', '2001-08-06'),
(19020445, 'Nguyễn Bá', 1, '0123456789', '2021-04-01'),
(19020446, 'Nguyễn Bá Vinh', 1, '0343543199', '2021-04-01'),
(19020447, 'Nguyễn Bá Vinh', 1, '0123456789', '2021-04-01'),
(19020448, 'Nguyễn Bá Vinh', 1, '0123456789', '2021-04-01'),
(19020450, 'Nguyễn Bá Vinh', 1, '0123456789', '2021-03-30'),
(19020452, 'Nguyễn Văn A', 106, '097282821', '2001-08-30'),
(19020453, 'Nguyễn Văn A', 106, '097282821', '2001-08-30'),
(19020454, 'Nguyễn Văn A', 106, '097282821', '2001-08-30'),
(19020455, 'Nguyễn Văn C', 110, '08678768', '2021-04-02'),
(19020462, 'eth', 106, 'rthrth', '2021-04-10'),
(19020463, 'eth', 106, 'rthrth', '2021-04-10'),
(19020464, 'sb', 106, '0789797', '2021-04-03'),
(19020467, 'Nguyễn Thị Thu', 110, '0120102012', '2001-04-22'),
(19020469, 'Tô Viết Ninh', 101, '07867856856', '2020-12-16'),
(19020470, 'Bùi Thị Ánh', 112, '06789659', '2021-05-13'),
(19020471, 'Trần Văn An', 1, '0578', '2001-06-20'),
(19020472, 'Nguyễn Thị Mùi', 127, '059678452', '2021-05-02'),
(19020473, 'Nana', 110, '07484', '2021-05-14'),
(19020474, 'Nguyễn Văn B', 116, '0798689', '2021-05-09'),
(19020475, 'Lò Thị Sáo', 116, '01288121', '2021-05-13'),
(19020476, 'Đinh Thị Hinh', 116, '058584585', '2021-05-12'),
(19020477, 'Trần Thị Hạnh', 123, '019291211', '2021-05-12'),
(19020478, 'Nguyễn Thị Hợp', 116, '091299192', '2021-05-12'),
(19020479, 'Trần Văn Hiên', 110, '091828121', '2001-05-21'),
(19020480, 'Nguyễn Bá Thành Bắc', 1, '019291212', '2001-05-13'),
(19020481, 'Lê Văn Sáng', 1, '0192912111', '2001-05-06'),
(19020482, 'Dương Đình Nghệ', 123, '091821921', '2001-05-21');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `contactNumber` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `fullName`, `unit`, `contactNumber`) VALUES
(8, 'Nguyễn Bá', 'UEB', '0343543199'),
(10, 'Nguyễn Bá Vinh', 'UET', '0123456789'),
(11, 'Nguyễn Bá Vinh', 'UET', '0123456789'),
(12, 'fdsdf', 'UET', '967915306'),
(13, 'hgfhg', 'UET', '575756757'),
(14, 'fsfdoisp rewrowpoeroipwr', 'UET', '0343543198'),
(15, '43954039', 'UET', '54354345305'),
(16, '43234', 'UET', '432432'),
(17, 'Đỗ Đức Tâm', 'UEB', '3219032912'),
(18, '4234204', 'UET', '42349203492'),
(19, 'Ma Thắm', 'UET', '0123456789'),
(20, 'Đỗ Đạt', 'UET', '0343543199');

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
(19020441, 'Đỗ Đức Tâm', 'K64-CLC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teacherId` (`teacherId`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `courseClassCode` (`courseClassCode`),
  ADD KEY `teacherId` (`teacherId`);

--
-- Indexes for table `registers`
--
ALTER TABLE `registers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courseId` (`courseId`),
  ADD KEY `studentId` (`studentId`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idStudent` (`studentId`),
  ADD KEY `courseClassCode` (`courseId`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classID` (`classId`),
  ADD KEY `idClass` (`classId`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `registers`
--
ALTER TABLE `registers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6759;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19020483;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`teacherId`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`teacherId`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `registers`
--
ALTER TABLE `registers`
  ADD CONSTRAINT `registers_ibfk_5` FOREIGN KEY (`studentId`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `registers_ibfk_6` FOREIGN KEY (`courseId`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `scores`
--
ALTER TABLE `scores`
  ADD CONSTRAINT `scores_ibfk_2` FOREIGN KEY (`studentId`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `scores_ibfk_3` FOREIGN KEY (`courseId`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`classId`) REFERENCES `classes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
