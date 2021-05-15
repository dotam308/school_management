-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2021 at 04:55 AM
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
(127, 'K65-CT', 46, 0, 15);

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
(7, 4, '7h', '11h', '301-GĐ2', 'INT2213', 'Nhập môn lập trình', 'INT2213 1', 50, 20),
(9, 3, '10h', '13h', '201-G2', 'INT2203', 'Lập trình nâng cao', 'INT2203 1', 60, 19),
(65, 5, '7h', '12h', '304-GĐ2', 'INT2210', 'Cấu giải', 'INT2210 1', 50, 27),
(66, 3, '13h', '16h', '202-G2', 'INT3005', 'Xác suất thông kê', 'INT3005 1', 50, 27),
(67, 2, '7h', '9h', '307-GĐ2', 'HIS1008', 'Lịch sử Đảng', 'HIS1008 1', 60, 21);

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
(266, 65, 19020482),
(267, 66, 19020482),
(268, 7, 19020480),
(269, 66, 19020480),
(270, 7, 19020475),
(271, 9, 19020475),
(272, 65, 19020475),
(273, 66, 19020475),
(276, 7, 19020472),
(277, 9, 19020472),
(278, 65, 19020472),
(279, 66, 19020472),
(280, 7, 19020479),
(281, 9, 19020479),
(282, 65, 19020479),
(283, 66, 19020479),
(284, 7, 19020470),
(285, 9, 19020470),
(286, 65, 19020470),
(287, 66, 19020470),
(288, 7, 19020467),
(289, 9, 19020467),
(290, 65, 19020467),
(291, 66, 19020467),
(311, 7, 19020483),
(312, 65, 19020483),
(313, 66, 19020483),
(314, 9, 19020483),
(322, 65, 19020481),
(323, 66, 19020481),
(324, 7, 19020481),
(325, 9, 19020481),
(328, 7, 19020488),
(329, 9, 19020488),
(332, 66, 19020488),
(333, 7, 19020482),
(334, 9, 19020482),
(335, 7, 19020441),
(336, 9, 19020441),
(337, 65, 19020441),
(338, 66, 19020441),
(339, 67, 19020441),
(340, 7, 19020493),
(341, 9, 19020493),
(342, 65, 19020493),
(343, 66, 19020493),
(344, 67, 19020493);

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
(6890, '9.0', 65, 19020482),
(6891, '8.0', 66, 19020482),
(6892, '8.0', 7, 19020480),
(6893, '9.0', 66, 19020480),
(6894, '0.0', 7, 19020475),
(6895, '9.0', 9, 19020475),
(6896, '0.0', 65, 19020475),
(6897, '0.0', 66, 19020475),
(6898, '6.0', 7, 19020472),
(6899, '8.0', 9, 19020472),
(6900, '9.0', 65, 19020472),
(6901, '8.0', 66, 19020472),
(6902, '9.0', 7, 19020479),
(6903, '0.0', 9, 19020479),
(6904, '0.0', 65, 19020479),
(6905, '0.0', 66, 19020479),
(6906, '7.0', 7, 19020470),
(6907, '8.0', 9, 19020470),
(6908, '0.0', 65, 19020470),
(6909, '0.0', 66, 19020470),
(6910, '0.0', 7, 19020467),
(6911, '6.0', 9, 19020467),
(6912, '0.0', 65, 19020467),
(6913, '0.0', 66, 19020467),
(6914, '0.0', 7, 19020483),
(6915, '0.0', 65, 19020483),
(6916, '0.0', 66, 19020483),
(6917, '0.0', 9, 19020483),
(6918, '0.0', 65, 19020481),
(6919, '0.0', 66, 19020481),
(6920, '0.0', 7, 19020481),
(6921, '0.0', 9, 19020481),
(6922, '0.0', 7, 19020488),
(6923, '0.0', 9, 19020488),
(6924, '0.0', 66, 19020488),
(6925, '0.0', 7, 19020482),
(6926, '0.0', 9, 19020482),
(6927, '10.0', 7, 19020441),
(6928, '10.0', 9, 19020441),
(6929, '9.0', 65, 19020441),
(6930, '10.0', 66, 19020441),
(6931, '9.0', 67, 19020441),
(6932, '0.0', 7, 19020493),
(6933, '0.0', 9, 19020493),
(6934, '0.0', 65, 19020493),
(6935, '0.0', 66, 19020493),
(6936, '0.0', 67, 19020493);

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
(19020441, 'Đỗ Đức Tâm', 1, '012345678', '2001-08-07'),
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
(19020472, 'Nguyễn Thị Mùi', 127, '059678452', '2021-05-02'),
(19020473, 'Nana', 110, '07484', '2021-05-14'),
(19020474, 'Nguyễn Văn B', 116, '0798689', '2021-05-09'),
(19020475, 'Lò Thị Sáo', 116, '01288121', '2021-05-13'),
(19020476, 'Đinh Thị Hinh', 116, '058584585', '2001-05-12'),
(19020477, 'Trần Thị Hạnh', 123, '019291211', '2021-05-12'),
(19020478, 'Nguyễn Thị Hợp', 116, '091299192', '2021-05-12'),
(19020479, 'Trần Văn Hiên', 110, '091828121', '2001-05-21'),
(19020480, 'Nguyễn Bá Thành Bắc', 1, '019291212', '2001-05-13'),
(19020481, 'Lê Văn Sáng', 1, '0192912111', '2001-05-06'),
(19020482, 'Dương Đình Nghệ', 123, '091821921', '2001-05-21'),
(19020483, 'ABC', 116, '097878787', '2021-05-28'),
(19020488, 'Trần Quốc Vượng', 1, '0718292111', '2001-04-27'),
(19020492, 'Tô Viết Ninh', 110, '01299192', '2001-05-09'),
(19020493, 'Nguyễn Trọng Hoàng', 110, '099819212', '2001-04-28');

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
(19, 'Ma Thắm', 'UET', '0123456789'),
(20, 'Đỗ Đạt', 'UET', '0343543199'),
(21, 'Trần Thị Mai', 'UEB', '09129121'),
(24, 'Đỗ Đức Tâm', 'UET', '0343543199'),
(27, 'Đỗ Đức Tâm', 'UET', '0343543199');

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `representName` varchar(50) DEFAULT NULL,
  `img-personal` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `title`, `username`, `pass`, `representName`, `img-personal`) VALUES
(1, 'admin', 'admin', '1234', 'Admin', NULL),
(2, 'student', '19020441', '12345678', 'Đỗ Đức Tâm', 'images/Jellyfish.jpg');

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `registers`
--
ALTER TABLE `registers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=345;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6937;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19020494;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
