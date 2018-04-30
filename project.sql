-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 04, 2018 at 11:16 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `checkeni_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL,
  `std_id` int(11) NOT NULL,
  `tutor_id` int(11) NOT NULL,
  `chat_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chat_id`, `std_id`, `tutor_id`, `chat_datetime`) VALUES
(1, 2, 1, '2018-02-26 16:16:20'),
(2, 4, 6, '2018-03-07 11:01:21'),
(3, 11, 10, '2018-03-07 11:59:22'),
(4, 12, 6, '2018-03-27 15:29:18');

-- --------------------------------------------------------

--
-- Table structure for table `clogs`
--

CREATE TABLE `clogs` (
  `clogs_id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `clogs_msg` text NOT NULL,
  `clogs_from` int(11) NOT NULL,
  `clogs_to` int(11) NOT NULL,
  `clogs_readbyfrom` int(1) NOT NULL COMMENT '1=read,0=unread',
  `clogs_readbyto` int(1) NOT NULL,
  `clogs_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clogs`
--

INSERT INTO `clogs` (`clogs_id`, `chat_id`, `clogs_msg`, `clogs_from`, `clogs_to`, `clogs_readbyfrom`, `clogs_readbyto`, `clogs_datetime`) VALUES
(1, 1, 'xxx', 2, 1, 1, 1, '2018-02-26 16:16:24'),
(2, 1, '11133', 1, 2, 1, 1, '2018-02-26 16:16:39'),
(3, 2, 'เอากันไหม', 4, 6, 1, 1, '2018-03-07 11:01:29'),
(4, 2, 'ควาย', 6, 4, 1, 1, '2018-03-07 11:01:41'),
(5, 2, 'กี่โมง', 4, 6, 1, 1, '2018-03-07 11:01:47'),
(6, 2, 'ทัก', 4, 6, 1, 1, '2018-03-07 11:50:28'),
(7, 3, 'ggggggg', 11, 10, 1, 1, '2018-03-07 11:59:36'),
(8, 3, 'gg', 11, 10, 1, 1, '2018-03-07 11:59:49'),
(9, 3, 'ggg', 11, 10, 1, 1, '2018-03-07 11:59:52'),
(10, 3, 'ggg', 10, 11, 1, 1, '2018-03-07 11:59:56'),
(11, 3, 'gggg', 10, 11, 1, 1, '2018-03-07 11:59:59'),
(12, 3, 'gg', 10, 11, 1, 1, '2018-03-07 12:00:02'),
(13, 3, 'ggggg', 10, 11, 1, 1, '2018-03-07 12:03:13'),
(14, 3, 'asd', 10, 11, 1, 1, '2018-03-07 12:03:21'),
(15, 4, 'หกด', 12, 6, 1, 0, '2018-03-27 15:33:08'),
(16, 4, 'อแปอ', 12, 6, 1, 0, '2018-03-27 15:35:17'),
(17, 4, 'แปผแผปแ', 12, 6, 1, 0, '2018-03-27 15:35:25'),
(18, 4, 'ผปแ', 12, 6, 1, 0, '2018-03-27 15:35:27'),
(19, 4, 'ผปแ', 12, 6, 1, 0, '2018-03-27 15:35:28'),
(20, 4, 'แแแ', 12, 6, 1, 0, '2018-03-27 15:35:32');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `Course_id` int(11) NOT NULL,
  `Course_Name` varchar(50) NOT NULL,
  `Course_Grade` varchar(20) NOT NULL,
  `Users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`Course_id`, `Course_Name`, `Course_Grade`, `Users_id`) VALUES
(1, 'Cal I', 'ปริญญาตรี ปี 1', 1),
(2, 'คณิต', 'ประถมศึกษาปีที่ 1', 6),
(3, 'Eng', 'ประถมศึกษาปีที่ 1', 6),
(4, '1', 'ประถมศึกษาปีที่ 1', 7),
(5, 'gggggggg', 'ประถมศึกษาปีที่ 6', 10);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_Id` int(11) NOT NULL,
  `invoice_price` double(11,2) NOT NULL,
  `course_id` int(11) NOT NULL,
  `user_Id` int(11) NOT NULL COMMENT 'Std',
  `invoice_detail` text NOT NULL,
  `invoice_status` enum('waiting','done') NOT NULL,
  `invoice_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_Id`, `invoice_price`, `course_id`, `user_Id`, `invoice_detail`, `invoice_status`, `invoice_datetime`) VALUES
(1, 450.00, 1, 2, 'xxx', 'done', '2018-02-26 16:17:07'),
(2, 50000.00, 2, 4, '14', 'done', '2018-03-07 11:01:58'),
(3, 30.00, 3, 4, 'เทส', 'done', '2018-03-07 11:50:55'),
(4, 60.00, 3, 4, 'กฟหหก', 'done', '2018-03-07 11:52:02'),
(5, 60.00, 3, 4, 'กฟหหก', 'waiting', '2018-03-07 11:52:03'),
(6, 111.00, 5, 11, 'asdf', 'done', '2018-03-07 12:00:21');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `review_point` int(5) NOT NULL COMMENT 'Min = 1,Max = 5',
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `review_point`, `course_id`, `user_id`, `review_datetime`) VALUES
(1, 4, 1, 2, '2018-02-26 16:17:24'),
(2, 5, 2, 4, '2018-03-07 11:02:22'),
(3, 3, 3, 4, '2018-03-07 11:51:24'),
(4, 5, 5, 11, '2018-03-07 12:00:55');

-- --------------------------------------------------------

--
-- Table structure for table `searchlogs`
--

CREATE TABLE `searchlogs` (
  `searchlogs_id` int(11) NOT NULL,
  `searchlogs_type` enum('keyword','grade') NOT NULL,
  `searchlogs_key` varchar(150) NOT NULL,
  `searchlogs_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `searchlogs`
--

INSERT INTO `searchlogs` (`searchlogs_id`, `searchlogs_type`, `searchlogs_key`, `searchlogs_datetime`) VALUES
(1, 'grade', 'ปริญญาตรี ปี 1', '2018-02-26 16:16:01'),
(2, 'grade', 'ปริญญาตรี ปี 1', '2018-02-26 16:16:17'),
(3, 'grade', 'ปริญญาตรี ปี 1', '2018-03-07 10:58:16'),
(4, 'keyword', 'คณิต', '2018-03-07 11:00:57'),
(5, 'grade', 'ประถมศึกษาปีที่ 1', '2018-03-07 11:01:06'),
(6, 'grade', 'ประถมศึกษาปีที่ 1', '2018-03-07 11:01:20'),
(7, 'grade', 'ประถมศึกษาปีที่ 1', '2018-03-07 11:02:46'),
(8, 'keyword', 'คณิ', '2018-03-07 11:47:51'),
(9, 'grade', 'ประถมศึกษาปีที่ 1', '2018-03-07 11:48:11'),
(10, 'keyword', 'คณิต', '2018-03-07 11:48:28'),
(11, 'grade', 'ประถมศึกษาปีที่ 1', '2018-03-07 11:48:44'),
(12, 'grade', 'ประถมศึกษาปีที่ 1', '2018-03-07 11:50:11'),
(13, 'grade', 'ประถมศึกษาปีที่ 1', '2018-03-07 11:54:23'),
(14, 'grade', 'ประถมศึกษาปีที่ 1', '2018-03-07 11:54:33'),
(15, 'grade', 'ประถมศึกษาปีที่ 1', '2018-03-07 11:54:53'),
(16, 'grade', 'ประถมศึกษาปีที่ 1', '2018-03-07 11:55:29'),
(17, 'keyword', 'ggg', '2018-03-07 11:59:17'),
(18, 'keyword', 'g', '2018-03-07 12:01:48'),
(19, 'keyword', 'g', '2018-03-07 12:02:08'),
(20, 'keyword', 'gggg', '2018-03-07 12:02:36'),
(21, 'grade', 'ประถมศึกษาปีที่ 6', '2018-03-07 12:02:47'),
(22, 'keyword', 'gggg', '2018-03-07 12:09:01'),
(23, 'keyword', 'ca', '2018-03-07 12:09:52'),
(24, 'grade', 'ประถมศึกษาปีที่ 1', '2018-03-07 12:12:26'),
(25, 'grade', 'ประถมศึกษาปีที่ 1', '2018-03-27 15:26:51'),
(26, 'grade', 'ประถมศึกษาปีที่ 1', '2018-03-27 15:29:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Users_id` int(11) NOT NULL,
  `Users_idName` varchar(50) NOT NULL,
  `Users_password` varchar(50) NOT NULL,
  `Users_FullName` varchar(200) NOT NULL,
  `Users_type` enum('tutor','student') NOT NULL,
  `Users_sex` enum('Male','Female') NOT NULL,
  `Users_education` text NOT NULL,
  `Users_job` text NOT NULL,
  `Users_grade` text NOT NULL,
  `Users_money` double(11,2) NOT NULL,
  `Users_status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Users_id`, `Users_idName`, `Users_password`, `Users_FullName`, `Users_type`, `Users_sex`, `Users_education`, `Users_job`, `Users_grade`, `Users_money`, `Users_status`) VALUES
(1, 'asd', '1111', 'Asd', 'tutor', 'Male', 'xxx', 'Tutor', 'ป.ตรี', 450.00, '1'),
(2, 'zxc', '1111', 'Zxc', 'student', 'Male', '', '', '', 0.00, '0'),
(3, 'up01', '123', 'Hdfj', 'student', 'Male', '', '', '', 0.00, '0'),
(4, 'man', '1234', 'tee', 'student', 'Male', '', '', '', 0.00, '0'),
(5, 'qnut', 'nut11840', 'ณัฐพร พันธุ์ยิ่งยก', 'student', 'Male', '', '', '', 0.00, '0'),
(6, 'nut', 'nut', 'mkuyloi9op', 'tutor', 'Male', '', '', '', 50090.00, '1'),
(7, 'asdf', 'asdf', 'asdf', 'tutor', 'Male', '', '', '', 0.00, '1'),
(8, 'tech', '1234', 'จาน', 'tutor', 'Male', '', '', '', 0.00, '1'),
(9, 'vvvv', 'vvvv', 'vvvv', 'student', 'Female', '', '', '', 0.00, '0'),
(10, 'gggg', 'gggg', 'gggg', 'tutor', 'Female', '', '', '', 111.00, '1'),
(11, 'hhhh', 'hhhh', 'hhhh', 'student', 'Male', '', '', '', 0.00, '0'),
(12, 'now', '1234', 'now', 'student', 'Male', '', '', '', 0.00, '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `std_id` (`std_id`),
  ADD KEY `tutor_id` (`tutor_id`);

--
-- Indexes for table `clogs`
--
ALTER TABLE `clogs`
  ADD PRIMARY KEY (`clogs_id`),
  ADD KEY `chat_from` (`clogs_from`),
  ADD KEY `chat_to` (`clogs_to`),
  ADD KEY `chat_id` (`chat_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`Course_id`),
  ADD KEY `Users_id` (`Users_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_Id`),
  ADD KEY `user_Id` (`user_Id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `searchlogs`
--
ALTER TABLE `searchlogs`
  ADD PRIMARY KEY (`searchlogs_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `clogs`
--
ALTER TABLE `clogs`
  MODIFY `clogs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `Course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `searchlogs`
--
ALTER TABLE `searchlogs`
  MODIFY `searchlogs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`std_id`) REFERENCES `users` (`Users_id`),
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`tutor_id`) REFERENCES `users` (`Users_id`);

--
-- Constraints for table `clogs`
--
ALTER TABLE `clogs`
  ADD CONSTRAINT `clogs_ibfk_1` FOREIGN KEY (`clogs_from`) REFERENCES `users` (`Users_id`),
  ADD CONSTRAINT `clogs_ibfk_2` FOREIGN KEY (`clogs_to`) REFERENCES `users` (`Users_id`),
  ADD CONSTRAINT `clogs_ibfk_3` FOREIGN KEY (`chat_id`) REFERENCES `chat` (`chat_id`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`Users_id`) REFERENCES `users` (`Users_id`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`user_Id`) REFERENCES `users` (`Users_id`),
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`Course_id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`Course_id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`Users_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
