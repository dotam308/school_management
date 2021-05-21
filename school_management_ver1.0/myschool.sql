-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2021 at 03:32 PM
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
(110, 'K64-CK', 50, 0, 13),
(112, 'K65-CB', 50, 0, 16),
(116, 'K64-CN', 50, 0, 10),
(127, 'K65-CT', 46, 0, 30),
(170, 'K66-CL', 50, 0, 27),
(172, 'K65-CJ', 62, 0, 32),
(179, 'K65-CL', 50, 0, 34),
(180, 'K65-CE', 50, 0, 45),
(181, 'K65-CO', 50, 0, 46),
(182, 'K65-CT', 60, 0, 47);

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
(9, 3, '10h', '13h', '201-G3', 'INT2203', 'Lập trình nâng cao', 'INT2203 1', 60, 19),
(65, 5, '7h', '12h', '304-GĐ2', 'INT2210', 'Cấu giải', 'INT2210 1', 50, 27),
(66, 3, '13h', '16h', '202-G2', 'INT3005', 'Xác suất thông kê', 'INT3005 1', 50, 27),
(67, 2, '7h', '9h', '307-GĐ2', 'HIS1008', 'Lịch sử Đảng', 'HIS1008 1', 60, 21),
(68, 3, '13h', '16h', '308-GĐ2', 'INT2210', 'Cấu giải', 'INT2210 2', 50, 31);

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
(361, 9, 19020500),
(362, 65, 19020500),
(364, 9, 19020508),
(365, 65, 19020508),
(367, 66, 19020508),
(370, 9, 19020498),
(371, 65, 19020498),
(372, 66, 19020498),
(376, 9, 19020503),
(377, 65, 19020503),
(378, 66, 19020503),
(379, 67, 19020503),
(380, 65, 19020502),
(381, 66, 19020502);

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
(6948, '10.0', 9, 19020514),
(6949, '10.0', 65, 19020514),
(6950, '10.0', 66, 19020514),
(6953, '10.0', 9, 19020500),
(6954, '10.0', 65, 19020500),
(6956, '9.0', 9, 19020508),
(6957, '0.0', 65, 19020508),
(6958, '0.0', 67, 19020514),
(6959, '0.0', 66, 19020508),
(6962, '0.0', 9, 19020498),
(6963, '0.0', 65, 19020498),
(6964, '0.0', 66, 19020498),
(6966, '0.0', 67, 19020514),
(6968, '0.0', 9, 19020503),
(6969, '0.0', 65, 19020503),
(6970, '0.0', 66, 19020503),
(6971, '0.0', 67, 19020503),
(6972, '0.0', 65, 19020502),
(6973, '0.0', 66, 19020502),
(6974, '0.0', 67, 19020502),
(6975, '0.0', 65, 19020514);

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
(19020441, 'Đỗ Đức Tâm', 1, '012345678', '2001-08-30'),
(19020445, 'Nguyễn Bá', 1, '0123456789', '2021-04-01'),
(19020446, 'Nguyễn Bá Vinh', 1, '0343543199', '2021-04-01'),
(19020455, 'Nguyễn Văn C', 110, '08678768', '2021-04-02'),
(19020467, 'Nguyễn Thị Thu', 110, '0120102012', '2001-04-22'),
(19020470, 'Bùi Thị Ánh', 112, '06789659', '2021-05-13'),
(19020472, 'Nguyễn Thị Mùi', 127, '059678452', '2021-05-02'),
(19020473, 'Nana', 110, '07484', '2021-05-14'),
(19020474, 'Nguyễn Văn B', 116, '0798689', '2021-05-09'),
(19020475, 'Lò Thị Sáo', 116, '01288121', '2021-05-13'),
(19020476, 'Đinh Thị Hinh', 116, '058584585', '2001-05-12'),
(19020478, 'Nguyễn Thị Hợp', 116, '091299192', '2021-05-12'),
(19020479, 'Trần Văn Hiên', 110, '091828121', '2001-05-21'),
(19020480, 'Nguyễn Bá Thành Bắc', 1, '019291212', '2001-05-13'),
(19020481, 'Lê Văn Sáng', 1, '0192912111', '2001-05-06'),
(19020483, 'ABC', 116, '097878787', '2021-05-28'),
(19020488, 'Trần Quốc Vượng', 1, '0718292111', '2001-04-27'),
(19020492, 'Tô Viết Ninh', 110, '01299192', '2001-05-09'),
(19020493, 'Nguyễn Trọng Hoàng', 110, '099819212', '2001-04-28'),
(19020494, 'Lê Văn Chương', 1, '0912991291', '2001-05-02'),
(19020495, 'Trần Văn An', 1, '01921212', '2001-04-28'),
(19020496, 'Đỗ Văn Mạnh', 112, '071828182', '2001-05-15'),
(19020497, 'smdnvsdv', 127, '080780780', '2001-05-15'),
(19020498, 'Trần Như Quỳnh', 172, '01829912', '2001-05-06'),
(19020499, 'Trần Việt Bảo', 170, '0192912', '2001-05-26'),
(19020500, 'Đỗ Linh', 116, '0172812', '2001-05-28'),
(19020501, 'Lê Văn Long', 112, '065645648', '2001-04-29'),
(19020502, 'Nguyễn Minh Chiến', 127, '088181811', '2001-05-18'),
(19020503, 'Lê Thị Hợi', 116, '08191911', '2001-05-18'),
(19020508, 'Võ Thị Mai', 112, '01278121', '2001-05-14'),
(19020510, 'Nguyễn Bình', 1, '071281821', '2001-05-08'),
(19020512, 'Lê Bai', 127, '01829121', '2001-05-12'),
(19020514, 'Ong Thị Nguyệt', 170, '01271212', '2001-05-13');

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
(27, 'Đỗ Đức Tâm', 'UET', '0343543199'),
(29, 'Trần Lê Bình', 'UET', '09077077'),
(30, 'Đỗ Hồng Hà', 'USSH', '019291921'),
(31, 'Lê Thị Mai', 'ULIS', '012192901'),
(32, 'Lê Thị Hợp', 'UET', '0812912'),
(33, 'Phan Gia Bảo', 'USSH', '01829121'),
(34, 'Đỗ Quang Khải', 'UET', '01928182'),
(35, 'Trần Bình', 'IS', '081921212'),
(36, 'Lê Biên', 'UET', '01929121'),
(37, 'Ong Nguyệt', 'UET', '01819111'),
(38, 'Nguyễn Hương Ly', 'ULIS', '098199191'),
(39, 'Phùng Ánh', 'UET', '0657474'),
(42, 'Lê Văn Hợi', 'UET', '01782912'),
(44, 'Trần Ngọc Ánh', 'ULIS', '07912221'),
(45, 'Lỡ Thắm', 'ULIS', '08129121'),
(46, 'Lỡ Hồng', 'UEB', '0172912'),
(47, 'Lỡ Anh', 'USSH', '08912111');

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

--
-- Dumping data for table `tempstudent`
--

INSERT INTO `tempstudent` (`id`, `fullName`, `classId`, `contactNumber`, `dob`) VALUES
(19020441, 'Đỗ Đức Tâm', 1, '012345678', '2001-08-30'),
(19020445, 'Nguyễn Bá', 1, '0123456789', '2021-04-01'),
(19020446, 'Nguyễn Bá Vinh', 1, '0343543199', '2021-04-01'),
(19020455, 'Nguyễn Văn C', 110, '08678768', '2021-04-02'),
(19020467, 'Nguyễn Thị Thu', 110, '0120102012', '2001-04-22'),
(19020470, 'Bùi Thị Ánh', 112, '06789659', '2021-05-13'),
(19020472, 'Nguyễn Thị Mùi', 127, '059678452', '2021-05-02'),
(19020473, 'Nana', 110, '07484', '2021-05-14'),
(19020474, 'Nguyễn Văn B', 116, '0798689', '2021-05-09'),
(19020475, 'Lò Thị Sáo', 116, '01288121', '2021-05-13'),
(19020476, 'Đinh Thị Hinh', 116, '058584585', '2001-05-12'),
(19020478, 'Nguyễn Thị Hợp', 116, '091299192', '2021-05-12'),
(19020479, 'Trần Văn Hiên', 110, '091828121', '2001-05-21'),
(19020480, 'Nguyễn Bá Thành Bắc', 1, '019291212', '2001-05-13'),
(19020481, 'Lê Văn Sáng', 1, '0192912111', '2001-05-06'),
(19020483, 'ABC', 116, '097878787', '2021-05-28'),
(19020488, 'Trần Quốc Vượng', 1, '0718292111', '2001-04-27'),
(19020492, 'Tô Viết Ninh', 110, '01299192', '2001-05-09'),
(19020493, 'Nguyễn Trọng Hoàng', 110, '099819212', '2001-04-28'),
(19020494, 'Lê Văn Chương', 1, '0912991291', '2001-05-02'),
(19020495, 'Trần Văn An', 1, '01921212', '2001-04-28'),
(19020496, 'Đỗ Văn Mạnh', 112, '071828182', '2001-05-15'),
(19020497, 'smdnvsdv', 127, '080780780', '2001-05-15'),
(19020498, 'Trần Như Quỳnh', 172, '01829912', '2001-05-06'),
(19020499, 'Trần Việt Bảo', 170, '0192912', '2001-05-26'),
(19020500, 'Đỗ Linh', 116, '0172812', '2001-05-28'),
(19020501, 'Lê Văn Long', 112, '065645648', '2001-04-29'),
(19020502, 'Nguyễn Minh Chiến', 127, '088181811', '2001-05-18'),
(19020503, 'Lê Thị Hợi', 116, '08191911', '2001-05-18'),
(19020508, 'Võ Thị Mai', 112, '01278121', '2001-05-14'),
(19020510, 'Nguyễn Bình', 1, '071281821', '2001-05-08'),
(19020512, 'Lê Bai', 127, '01829121', '2001-05-12'),
(19020514, 'Ong Thị Nguyệt', 170, '01271212', '2001-05-13');

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

INSERT INTO `users` (`id`, `title`, `username`, `pass`, `salt`, `representName`, `img-personal`) VALUES
(19, 'admin', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', '', '', NULL),
(21, 'admin', 'admin1', '25d55ad283aa400af464c76d713c07ad', '', '1234', NULL),
(25, 'admin', 'admin2', '81dc9bdb52d04dc20036dbd8313ed055', '', NULL, NULL),
(31, 'student', '19020495', '1e9a1ac73703648ff08151acd778989c', '7nvna', NULL, NULL),
(36, '', 'srhxdn', '', '', NULL, NULL),
(37, 'student', '19020496', '0905c789472e204cebdf0f53ecae2374', 'p93hs', NULL, NULL),
(38, 'student', '19020497', '509917305ebf8f196734e5518952299f', 'ydjub', NULL, NULL),
(40, 'admin', 'lethihop', 'aff38e536e52a685f357efa830736a5f', '7lagy', 'Lê Thị Hợp', 'images/flower.jpg'),
(41, 'admin', 'phangiabao', '86abcb34f7352a445b14ac1aa923e1c1', 'meb1b', NULL, NULL),
(42, 'admin', 'doquangkhai', 'd53607abf31b5e15ed9558846309b260', 'sa4rx', NULL, NULL),
(43, 'admin', 'tranbinh', '5df5daf5d1dda305ac1ebbb544cd78a9', 'i0lip', NULL, NULL),
(44, 'admin', 'lebien', '226daa4b332a16082fb65671c8a14c54', '2x6ey', NULL, NULL),
(45, 'admin', 'ongnguyet', '3e113a103edb508f66ce5b37acfd085c', 'sc34q', NULL, NULL),
(46, 'admin', 'nguyenhuongly', '22430862a9800ca7c3bc9ef23c136efc', 'qoc9r', NULL, NULL),
(47, 'student', '19020498', '2ffd62761152f45450d2a01ea65c0a99', 'bdv2s', NULL, NULL),
(48, 'student', '19020499', 'e40f10ffbd297792e0f3481b5d70c46a', 'exoe3', 'Trần Việt Bảo', NULL),
(49, 'student', '19020500', '94123f0eb0ee5c2c15965e0444aebdc1', 's4i58', 'Đỗ Linh', 'images/Tulips.jpg'),
(50, 'student', '19020501', 'c4dab3568f2d5c94b75c995ebbe77a08', '5bla7', 'Lê Văn Long', NULL),
(51, 'student', '19020512', 'f76411d940f553edf4b2bc3562f5383f', 'nj1cw', 'Lê Bai', NULL),
(53, 'student', '19020514', '2d534c865c39b03e1ae88c118d997934', 'q89wy', 'Ong Thị Nguyệt', 'images/Hydrangeas.jpg'),
(54, 'admin', 'phunganh', 'cb2cc388f84f9b984b7f68c4ffaf81f8', 'sprr5', 'Phùng Ánh', NULL),
(57, 'admin', 'levanhoi', '75b52f68c5c32af50db778b124bcd0de', '6run4', 'Lê Văn Hợi', NULL),
(59, 'admin', 'tranngocanh', '7993df933a52b8c67e688221b7772972', 'qn54s', 'Trần Ngọc Ánh', ''),
(62, 'admin', 'lotham', '7f2741383a086c2786ac90b55405e916', 'okzmz', 'Lỡ Thắm', ''),
(63, 'admin', 'lohong', '9ac6f697884e81f5977a276611174771', 'ih30a', 'Lỡ Hồng', ''),
(64, 'admin', 'loanh', 'ffb2cb5018140aab90fabc87b9c1b2fc', 'ohmew', 'Lỡ Anh', '');

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
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `registers`
--
ALTER TABLE `registers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=403;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6976;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19020515;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

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
