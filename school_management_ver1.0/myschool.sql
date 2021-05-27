-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2021 at 04:11 PM
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
(184, 'K64-CCLC', 50, 3, 56),
(185, 'K64-CB', 60, 0, 57),
(186, 'K64-CE', 60, 3, 59),
(187, 'K64-CF', 60, 0, 60),
(188, 'K64-CJ', 60, 0, 61),
(189, 'K64-CN', 60, 0, 62),
(190, 'K64-CC', 50, 0, 63);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `credit` int(11) NOT NULL,
  `startTime` varchar(5) NOT NULL,
  `endTime` varchar(5) NOT NULL,
  `place` varchar(20) NOT NULL,
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
(75, 2, '7h', '9h', '303-GĐ2', 'HIS1008', 'Lịch sử Đảng', 'HIS1008 5', 80, 57),
(76, 3, '', '', '', 'INT3303', 'Cấu giải', '', 0, 57),
(77, 4, '', '', '', 'INT3304', 'Công nghệ phần mềm', 'INT3304 5', 0, 60),
(78, 3, '', '', '', 'INT2208', 'Toán rời rạc', '', 0, 61);

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
(422, 75, 19020527),
(423, 76, 19020527),
(424, 77, 19020527),
(425, 78, 19020527),
(426, 76, 19020526),
(427, 77, 19020526),
(428, 78, 19020526),
(429, 75, 19020535),
(430, 76, 19020535),
(431, 77, 19020535),
(432, 78, 19020535),
(433, 75, 19020528),
(434, 76, 19020528),
(435, 77, 19020528),
(436, 78, 19020528),
(439, 77, 19020536),
(440, 78, 19020536),
(452, 75, 19020540),
(453, 76, 19020540),
(454, 77, 19020540),
(455, 78, 19020540);

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
(7005, '0.0', 75, 19020527),
(7006, '0.0', 76, 19020527),
(7007, '0.0', 77, 19020527),
(7008, '0.0', 78, 19020527),
(7009, '0.0', 76, 19020526),
(7010, '0.0', 77, 19020526),
(7011, '0.0', 78, 19020526),
(7012, '0.0', 75, 19020535),
(7013, '0.0', 76, 19020535),
(7014, '0.0', 77, 19020535),
(7015, '0.0', 78, 19020535),
(7016, '0.0', 75, 19020528),
(7017, '0.0', 76, 19020528),
(7018, '0.0', 77, 19020528),
(7019, '0.0', 78, 19020528),
(7022, '0.0', 77, 19020536),
(7023, '0.0', 78, 19020536),
(7027, '10.0', 75, 19020540),
(7028, '10.0', 76, 19020540),
(7029, '10.0', 77, 19020540),
(7030, '10.0', 78, 19020540);

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
(19020526, 'Đỗ Đức Tâm', 184, '0967915305', '2001-08-30'),
(19020527, 'Trần Đình Nhạ', 184, '09919129', '2001-05-12'),
(19020528, 'Lê Nhạn', 186, '', '0000-00-00'),
(19020535, 'Lê Duẩn', 186, '0182912', '2001-05-11'),
(19020536, 'Nguyễn Thuỳ Linh', 186, ' ?? \'', '0000-00-00'),
(19020540, 'Phạm Gia Công', 184, '07876976', '0000-00-00');

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
(56, 'Đỗ Mạnh Cường', 'UET', '0343543199'),
(57, 'Nguyễn Bá Vinh', 'UEB', ''),
(58, 'Lê Văn Vinh', 'ULIS', '078856'),
(59, 'Ma Thắm', 'USSH', '0192929292'),
(60, 'Lê Hinh', 'IS', '0192929292'),
(61, 'Hồng Hạnh', 'IS', '0991291'),
(62, 'Lê Nga', 'ULIS', '0967915305'),
(63, 'Phạm Thuỳ Chi', 'ULIS', '018291212'),
(64, 'Lê Hợi', 'UEB', '0677687687');

-- --------------------------------------------------------

--
-- Table structure for table `teacherselectedlist`
--

CREATE TABLE `teacherselectedlist` (
  `id` int(11) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `contactNumber` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacherselectedlist`
--

INSERT INTO `teacherselectedlist` (`id`, `fullName`, `unit`, `contactNumber`) VALUES
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
(27, 'Đỗ Đức Tâm', 'UET', '0343543199'),
(29, 'Trần Lê Bình', 'UET', '09077077'),
(30, 'Đỗ Hồng Hà', 'USSH', '019291921'),
(31, 'Lê Thị Mai', 'ULIS', '012192901'),
(32, 'Lê Thị Hợp', 'UET', '0812912'),
(33, 'Phan Gia Bảo', 'USSH', '01829121'),
(34, 'Đỗ Quang Khải', 'UET', '01928182'),
(35, 'Trần Bình', 'IS', '081921212'),
(36, 'Lê Biên', 'UET', '01929121'),
(37, 'Ong Nguyệt', 'UET', '01819111');

-- --------------------------------------------------------

--
-- Table structure for table `tempstudent`
--

CREATE TABLE `tempstudent` (
  `id` int(11) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `classId` int(11) NOT NULL,
  `contactNumber` varchar(11) NOT NULL,
  `dob` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `temp_teacher`
--

CREATE TABLE `temp_teacher` (
  `id` int(11) NOT NULL,
  `object` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `temp_teacher`
--

INSERT INTO `temp_teacher` (`id`, `object`) VALUES
(1, ''),
(2, ''),
(3, 'UET'),
(4, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `representName` varchar(50) DEFAULT NULL,
  `img-personal` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userId`, `title`, `username`, `pass`, `salt`, `representName`, `img-personal`) VALUES
(19, 0, 'admin', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', '', 'Admin 1', 'images/85111flower.jpg'),
(21, 0, 'admin', 'admin1', '81dc9bdb52d04dc20036dbd8313ed055', '', '', NULL),
(25, 0, 'admin', 'admin2', '81dc9bdb52d04dc20036dbd8313ed055', '', NULL, NULL),
(84, 56, 'admin', 'domanhcuong1993', '41e6b526b2c45ded11c80af9fea7f9a9', 'jy4bx', 'Đỗ Mạnh Cường', 'images/d3763Lighthouse.jpg'),
(85, 57, 'admin', 'nguyenbavinh57', '45aa87b9641610e15d3280fb2bf060ae', 'solen', 'Nguyễn Bá Vinh', NULL),
(86, 58, 'admin', 'levanvinh58', '4bb2b876fc89dff37790bb7081eebfab', 'aj7uv', 'Lê Văn Vinh', NULL),
(87, 59, 'admin', 'matham59', '632a4f1f4c2ebed9966f800286851226', '9ffuv', 'Ma Thắm', NULL),
(88, 60, 'admin', 'lehinh60', '4deea68c13a7709c19b6f451b405a19c', 'n63xd', 'Lê Hinh', NULL),
(89, 61, 'admin', 'honghanh61', '0ce36b006266173c3faa1a23157f4951', 'gtuow', 'Hồng Hạnh', NULL),
(90, 62, 'admin', 'lenga62', '92881d2cb6f0b697d98507fbde23b005', '4z46r', 'Lê Nga', NULL),
(91, 63, 'admin', 'phamthuychi63', 'ee0cc989553d82c3d714508bec50e11b', 'eitk1', 'Phạm Thuỳ Chi', NULL),
(92, 64, 'admin', 'lehoi64', 'dc290cfaca2e8dd8cd06e5d184ff8474', 'pwb9d', 'Lê Hợi', NULL),
(93, 0, 'student', '19020526', '92f98dccf78bd218061c354833fbc37f', 'frwi3', 'Đỗ Đức Tâm', NULL),
(94, 0, 'student', '19020527', '8aa6c3f080b1241ba2990c39619ae89e', 'u561s', 'Trần Đình Nhạ', NULL),
(95, 0, 'student', '19020528', '8a6bfcbf7661b81110f04dfae6aaa6a1', 'r8eoj', 'Lê Nhạn', NULL),
(102, 0, 'student', '19020535', '04524026a2130b45e61ab55c930f075c', '3zfhc', 'Lê Duẩn', NULL),
(103, 0, 'student', '19020536', 'efd63fc7121344aeaa12c9bf247d9e94', '5w3ju', 'Nguyễn Thuỳ Linh', NULL),
(105, 0, 'student', '19020540', 'a408fc5b41c52dcf629c618c448db2fd', 'v9byy', 'Phạm Gia Công', NULL);

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
  ADD UNIQUE KEY `contactNumber` (`contactNumber`),
  ADD KEY `classID` (`classId`),
  ADD KEY `idClass` (`classId`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacherselectedlist`
--
ALTER TABLE `teacherselectedlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tempstudent`
--
ALTER TABLE `tempstudent`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classID` (`classId`),
  ADD KEY `idClass` (`classId`);

--
-- Indexes for table `temp_teacher`
--
ALTER TABLE `temp_teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `userId` (`userId`),
  ADD KEY `userId_2` (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `registers`
--
ALTER TABLE `registers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=456;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7031;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19020541;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `teacherselectedlist`
--
ALTER TABLE `teacherselectedlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tempstudent`
--
ALTER TABLE `tempstudent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19020515;

--
-- AUTO_INCREMENT for table `temp_teacher`
--
ALTER TABLE `temp_teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

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

--
-- Constraints for table `tempstudent`
--
ALTER TABLE `tempstudent`
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`classId`) REFERENCES `classes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
