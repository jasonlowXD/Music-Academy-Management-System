-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2022 at 05:26 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `music_academy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ADMIN_ID` int(10) NOT NULL,
  `ADMIN_NAME` varchar(255) NOT NULL,
  `ADMIN_EMAIL` varchar(50) NOT NULL,
  `ADMIN_PASS` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ADMIN_ID`, `ADMIN_NAME`, `ADMIN_EMAIL`, `ADMIN_PASS`) VALUES
(1, 'SuperAdmin', 'superadmin@admin.test', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `child`
--

CREATE TABLE `child` (
  `CHILD_ID` int(10) NOT NULL,
  `PARENT_ID` int(10) NOT NULL,
  `TEACHER_ID` int(10) NOT NULL,
  `COURSE_ID` int(10) NOT NULL,
  `CHILD_NAME` varchar(255) NOT NULL,
  `CHILD_AGE` int(10) NOT NULL,
  `CHILD_STATUS` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `child`
--

INSERT INTO `child` (`CHILD_ID`, `PARENT_ID`, `TEACHER_ID`, `COURSE_ID`, `CHILD_NAME`, `CHILD_AGE`, `CHILD_STATUS`) VALUES
(1, 1, 1, 1, 'super child 1', 6, 'active'),
(2, 1, 1, 2, 'super child 2', 3, 'active'),
(3, 1, 1, 1, 'super child 3', 12, 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `CLASS_ID` int(10) NOT NULL,
  `CLASSGROUP_ID` int(10) NOT NULL,
  `START_DATETIME` datetime NOT NULL,
  `END_DATETIME` datetime NOT NULL,
  `CLASS_DAY` int(10) NOT NULL COMMENT '1 is Monday, 2 is Tuesday,...',
  `CLASS_LOCATION` varchar(255) NOT NULL,
  `CLASS_DESC` varchar(500) NOT NULL,
  `ATTENDANCE` enum('absent','present') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`CLASS_ID`, `CLASSGROUP_ID`, `START_DATETIME`, `END_DATETIME`, `CLASS_DAY`, `CLASS_LOCATION`, `CLASS_DESC`, `ATTENDANCE`) VALUES
(2, 1, '2022-03-08 10:00:00', '2022-03-08 10:30:00', 2, 'super studio A', 'super desc', 'absent'),
(6, 2, '2022-03-11 15:00:00', '2022-03-11 16:00:00', 5, 'https://apps.google.com/meet/', 'super online meet', NULL),
(7, 2, '2022-03-12 14:00:00', '2022-03-12 15:00:00', 6, 'https://apps.google.com/meet/', 'super online meet', 'present'),
(8, 2, '2022-03-19 14:00:00', '2022-03-19 15:00:00', 6, 'https://apps.google.com/meet/', 'super online meet', NULL),
(9, 2, '2022-03-26 14:00:00', '2022-03-26 15:00:00', 6, 'https://apps.google.com/meet/', 'super online meet', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `class_group`
--

CREATE TABLE `class_group` (
  `CLASSGROUP_ID` int(10) NOT NULL,
  `ADMIN_ID` int(10) NOT NULL,
  `TEACHER_ID` int(10) NOT NULL,
  `CHILD_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_group`
--

INSERT INTO `class_group` (`CLASSGROUP_ID`, `ADMIN_ID`, `TEACHER_ID`, `CHILD_ID`) VALUES
(1, 1, 1, 1),
(2, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `COMMENT_ID` int(10) NOT NULL,
  `PROGRESS_ID` int(10) NOT NULL,
  `TEACHER_ID` int(10) DEFAULT NULL,
  `PARENT_ID` int(10) DEFAULT NULL,
  `COMMENT_CONTENT` varchar(500) NOT NULL,
  `COMMENT_DATETIME` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`COMMENT_ID`, `PROGRESS_ID`, `TEACHER_ID`, `PARENT_ID`, `COMMENT_CONTENT`, `COMMENT_DATETIME`) VALUES
(1, 1, 1, NULL, 'super comment👍👍', '2022-03-03 17:26:09'),
(2, 1, NULL, 1, '😂super walao nice🤣', '2022-03-03 17:26:31');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `COURSE_ID` int(10) NOT NULL,
  `ADMIN_ID` int(10) NOT NULL,
  `COURSE_NAME` varchar(255) NOT NULL,
  `COURSE_FEE` int(10) NOT NULL,
  `DURATION_PER_CLASS` int(10) NOT NULL COMMENT 'value are minutes, ex:60 mins',
  `COURSE_DESC` varchar(500) NOT NULL,
  `COURSE_STATUS` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`COURSE_ID`, `ADMIN_ID`, `COURSE_NAME`, `COURSE_FEE`, `DURATION_PER_CLASS`, `COURSE_DESC`, `COURSE_STATUS`) VALUES
(1, 1, 'supercourse', 100, 30, 'superadmin de course test', 'active'),
(2, 1, 'super extra course', 150, 60, 'superadmin de extra course', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `INVOICE_ID` int(10) NOT NULL,
  `ADMIN_ID` int(10) NOT NULL,
  `PARENT_ID` int(10) NOT NULL,
  `INVOICE_DATE` date NOT NULL,
  `INVOICE_STATUS` enum('paid','unpaid') NOT NULL,
  `INVOICE_AMOUNT` int(10) NOT NULL,
  `INVOICE_DESC` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`INVOICE_ID`, `ADMIN_ID`, `PARENT_ID`, `INVOICE_DATE`, `INVOICE_STATUS`, `INVOICE_AMOUNT`, `INVOICE_DESC`) VALUES
(999, 1, 1, '2022-02-01', 'paid', 350, 'super child 1 supercourse,100\nsuper child 2 super extra course,150\nsuper child 3 supercourse,100\n'),
(1000, 1, 1, '2022-03-03', 'unpaid', 250, 'super child 1 supercourse,100\nsuper child 2 super extra course,150\n');

-- --------------------------------------------------------

--
-- Table structure for table `learning_resource`
--

CREATE TABLE `learning_resource` (
  `RESOURCE_ID` int(10) NOT NULL,
  `TEACHER_ID` int(10) NOT NULL,
  `CHILD_ID` int(10) NOT NULL,
  `RESOURCE_TITLE` varchar(255) NOT NULL,
  `RESOURCE_URL` varchar(500) DEFAULT NULL,
  `RESOURCE_FILEPATH` varchar(500) DEFAULT NULL,
  `RESOURCE_DATETIME` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `learning_resource`
--

INSERT INTO `learning_resource` (`RESOURCE_ID`, `TEACHER_ID`, `CHILD_ID`, `RESOURCE_TITLE`, `RESOURCE_URL`, `RESOURCE_FILEPATH`, `RESOURCE_DATETIME`) VALUES
(1, 1, 1, 'super resource', 'https://www.youtube.com/', '../localFolder/resource/resourceFile.pdf', '2022-03-03 17:19:21');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `NOTIFICATION_ID` int(10) NOT NULL,
  `ADMIN_ID` int(10) DEFAULT NULL,
  `TEACHER_ID` int(10) DEFAULT NULL,
  `PARENT_ID` int(10) DEFAULT NULL,
  `TITLE` varchar(50) NOT NULL,
  `CONTENT` varchar(255) NOT NULL,
  `VIEW_STATUS` enum('seen','unseen') NOT NULL DEFAULT 'unseen',
  `DATETIME` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'auto delete after one month detected',
  `LINK` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`NOTIFICATION_ID`, `ADMIN_ID`, `TEACHER_ID`, `PARENT_ID`, `TITLE`, `CONTENT`, `VIEW_STATUS`, `DATETIME`, `LINK`) VALUES
(1, NULL, 1, NULL, 'You have a new child!', 'A new child (super child 1) has assigned to you!', 'seen', '2022-03-03 16:27:50', 'TChildren.php'),
(2, NULL, 1, NULL, 'You have a new child!', 'A new child (super child 2) has assigned to you!', 'seen', '2022-03-03 16:27:50', 'TChildren.php'),
(3, NULL, 1, NULL, 'You have a new child!', 'A new child (super child 3) has assigned to you!', 'seen', '2022-03-03 16:31:59', 'TChildren.php'),
(4, NULL, 1, NULL, 'New class added by Admin', 'super child 1 has new class start from 2022-03-01 10:00AM, please check!', 'seen', '2022-03-03 16:33:40', 'TCalendar.php'),
(5, NULL, NULL, 1, 'New class added by Admin', 'super child 1 has new class start from 2022-03-01 10:00AM, please check!', 'seen', '2022-03-03 16:33:40', 'PCalendar.php'),
(6, NULL, 1, NULL, 'New class added by Admin', 'super child 2 has new class start from 2022-03-05 2:00PM, please check!', 'seen', '2022-03-03 16:37:01', 'TCalendar.php'),
(7, NULL, NULL, 1, 'New class added by Admin', 'super child 2 has new class start from 2022-03-05 2:00PM, please check!', 'seen', '2022-03-03 16:37:01', 'PCalendar.php'),
(8, NULL, 1, NULL, 'Class updated by Admin', 'super child 1 2022-03-22 10:00AM class changed to 2022-03-23 10:00AM, please check!', 'seen', '2022-03-03 16:38:04', 'TCalendar.php'),
(9, NULL, NULL, 1, 'Class updated by Admin', 'super child 1 2022-03-22 10:00AM class changed to 2022-03-23 10:00AM, please check!', 'seen', '2022-03-03 16:38:04', 'PCalendar.php'),
(10, NULL, 1, NULL, 'Multiple Classes updated by Admin', 'super child 1 2022-03-23 10:00AM and following classes changed to start from 2022-03-21 10:00AM, please check!', 'seen', '2022-03-03 16:38:26', 'TCalendar.php'),
(11, NULL, NULL, 1, 'Multiple Classes updated by Admin', 'super child 1 2022-03-23 10:00AM and following classes changed to start from 2022-03-21 10:00AM, please check!', 'seen', '2022-03-03 16:38:26', 'PCalendar.php'),
(12, NULL, 1, NULL, 'Class deleted by Admin', 'super child 1 2022-03-21 10:00AM class has been deleted, please check!', 'seen', '2022-03-03 16:38:58', 'TCalendar.php'),
(13, NULL, NULL, 1, 'Class deleted by Admin', 'super child 1 2022-03-21 10:00AM class has been deleted, please check!', 'seen', '2022-03-03 16:38:58', 'PCalendar.php'),
(14, NULL, 1, NULL, 'Multiple Classes deleted by Admin', 'super child 1 2022-03-15 10:00AM and following classes has been deleted, please check!', 'seen', '2022-03-03 16:39:03', 'TCalendar.php'),
(15, NULL, NULL, 1, 'Multiple Classes deleted by Admin', 'super child 1 2022-03-15 10:00AM and following classes has been deleted, please check!', 'seen', '2022-03-03 16:39:03', 'PCalendar.php'),
(17, NULL, NULL, 1, 'New invoice alert', 'Your March invoice is here, please check!', 'seen', '2022-03-03 16:40:56', 'PInvoice.php'),
(18, 1, NULL, NULL, 'New class added by superTeacher', 'super child 1 has new class start from 2022-03-13 11:00AM, please check!', 'seen', '2022-03-03 16:56:57', 'ACalendar.php'),
(19, NULL, NULL, 1, 'New class added by superTeacher', 'super child 1 has new class start from 2022-03-13 11:00AM, please check!', 'seen', '2022-03-03 16:56:57', 'PCalendar.php'),
(20, 1, NULL, NULL, 'Class updated by superTeacher', 'super child 1 2022-03-13 11:00AM class changed to 2022-03-14 11:00AM, please check!', 'seen', '2022-03-03 17:00:33', 'ACalendar.php'),
(21, NULL, NULL, 1, 'Class updated by superTeacher', 'super child 1 2022-03-13 11:00AM class changed to 2022-03-14 11:00AM, please check!', 'seen', '2022-03-03 17:00:33', 'PCalendar.php'),
(22, 1, NULL, NULL, 'Multiple Classes updated by superTeacher', 'super child 1 2022-03-20 11:00AM and following classes changed to start from 2022-03-21 11:00AM, please check!', 'seen', '2022-03-03 17:01:12', 'ACalendar.php'),
(23, NULL, NULL, 1, 'Multiple Classes updated by superTeacher', 'super child 1 2022-03-20 11:00AM and following classes changed to start from 2022-03-21 11:00AM, please check!', 'seen', '2022-03-03 17:01:12', 'PCalendar.php'),
(24, 1, NULL, NULL, 'Class deleted by superTeacher', 'super child 1 2022-03-21 11:00AM class has been deleted, please check!', 'seen', '2022-03-03 17:01:33', 'ACalendar.php'),
(25, NULL, NULL, 1, 'Class deleted by superTeacher', 'super child 1 2022-03-21 11:00AM class has been deleted, please check!', 'seen', '2022-03-03 17:01:33', 'PCalendar.php'),
(26, 1, NULL, NULL, 'Multiple Classes deleted by superTeacher', 'super child 1 2022-03-14 11:00AM and following classes has been deleted, please check!', 'seen', '2022-03-03 17:01:46', 'ACalendar.php'),
(27, NULL, NULL, 1, 'Multiple Classes deleted by superTeacher', 'super child 1 2022-03-14 11:00AM and following classes has been deleted, please check!', 'seen', '2022-03-03 17:01:46', 'PCalendar.php'),
(28, NULL, 1, NULL, 'New class reschedule request', 'super child 2 2022-03-05 2:00PM class has a new reschedule request, please check!', 'seen', '2022-03-03 17:03:57', 'TCalendar.php'),
(29, NULL, NULL, 1, 'Reschedule request rejected', 'superTeacher has rejected your request on 2022-03-05 2:00PM class!', 'seen', '2022-03-03 17:05:18', 'PCalendar.php'),
(30, NULL, 1, NULL, 'New class reschedule request', 'super child 2 2022-03-05 2:00PM class has a new reschedule request, please check!', 'seen', '2022-03-03 17:05:51', 'TCalendar.php'),
(31, NULL, NULL, 1, 'Reschedule request accepted', 'superTeacher has accepted your request on 2022-03-05 2:00PM class and changed to 2022-03-11 3:00PM!', 'seen', '2022-03-03 17:06:47', 'PCalendar.php'),
(32, 1, NULL, NULL, 'Class updated by superTeacher', 'super child 2 2022-03-05 2:00PM class changed to 2022-03-11 3:00PM, please check!', 'seen', '2022-03-03 17:06:48', 'ACalendar.php'),
(33, 1, NULL, NULL, 'Class deleted by superTeacher', 'super child 1 2022-03-01 10:00AM class has been deleted, please check!', 'seen', '2022-03-03 17:10:05', 'ACalendar.php'),
(34, NULL, NULL, 1, 'Class deleted by superTeacher', 'super child 1 2022-03-01 10:00AM class has been deleted, please check!', 'seen', '2022-03-03 17:10:05', 'PCalendar.php'),
(35, 1, NULL, NULL, 'Class updated by superTeacher', 'super child 2 2022-03-11 3:00PM class changed to 2022-03-11 3:00PM, please check!', 'unseen', '2022-03-03 17:10:37', 'ACalendar.php'),
(36, NULL, NULL, 1, 'Class updated by superTeacher', 'super child 2 2022-03-11 3:00PM class changed to 2022-03-11 3:00PM, please check!', 'seen', '2022-03-03 17:10:37', 'PCalendar.php');

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `PARENT_ID` int(10) NOT NULL,
  `ADMIN_ID` int(10) NOT NULL,
  `PARENT_NAME` varchar(255) NOT NULL,
  `PARENT_EMAIL` varchar(50) NOT NULL,
  `PARENT_PASS` varchar(255) NOT NULL,
  `PARENT_PHONE_NUM` varchar(15) NOT NULL,
  `PARENT_STATUS` enum('active','inactive') NOT NULL,
  `PARENT_RELATIONSHIP` varchar(30) NOT NULL COMMENT 'guardian,mother,father...'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`PARENT_ID`, `ADMIN_ID`, `PARENT_NAME`, `PARENT_EMAIL`, `PARENT_PASS`, `PARENT_PHONE_NUM`, `PARENT_STATUS`, `PARENT_RELATIONSHIP`) VALUES
(1, 1, 'superparent', 'superparent@parent.parent', '202cb962ac59075b964b07152d234b70', '011-99999999', 'active', 'guardian');

-- --------------------------------------------------------

--
-- Table structure for table `payment_receipt`
--

CREATE TABLE `payment_receipt` (
  `RECEIPT_ID` int(10) NOT NULL,
  `INVOICE_ID` int(10) NOT NULL,
  `RECEIPT_DATE` date NOT NULL,
  `RECEIPT_AMOUNT` int(10) NOT NULL,
  `RECEIPT_DESC` varchar(500) NOT NULL,
  `RECEIPT_TYPE` enum('cash','card','ewallet','bank') NOT NULL,
  `RECEIPT_FILEPATH` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_receipt`
--

INSERT INTO `payment_receipt` (`RECEIPT_ID`, `INVOICE_ID`, `RECEIPT_DATE`, `RECEIPT_AMOUNT`, `RECEIPT_DESC`, `RECEIPT_TYPE`, `RECEIPT_FILEPATH`) VALUES
(1, 999, '2022-02-03', 100, 'ewallet payment', 'ewallet', ''),
(2, 999, '2022-02-05', 250, 'online', 'bank', '../localFolder/receipt/receipttest.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `practice_progress`
--

CREATE TABLE `practice_progress` (
  `PROGRESS_ID` int(10) NOT NULL,
  `TEACHER_ID` int(10) NOT NULL,
  `CHILD_ID` int(10) NOT NULL,
  `PROGRESS_COURSE` varchar(255) NOT NULL,
  `PROGRESS_TITLE` varchar(255) NOT NULL,
  `PROGRESS_FILEPATH` varchar(500) NOT NULL,
  `PROGRESS_DATETIME` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `practice_progress`
--

INSERT INTO `practice_progress` (`PROGRESS_ID`, `TEACHER_ID`, `CHILD_ID`, `PROGRESS_COURSE`, `PROGRESS_TITLE`, `PROGRESS_FILEPATH`, `PROGRESS_DATETIME`) VALUES
(1, 1, 1, 'supercourse', 'super progress', '../localFolder/progress/720p.mp4', '2022-03-03 17:24:07');

-- --------------------------------------------------------

--
-- Table structure for table `reschedule_request`
--

CREATE TABLE `reschedule_request` (
  `REQUEST_ID` int(10) NOT NULL,
  `CLASS_ID` int(10) NOT NULL,
  `PARENT_ID` int(10) NOT NULL,
  `REQUEST_DATETIME` datetime NOT NULL,
  `REQUEST_DESC` varchar(500) NOT NULL,
  `REQUEST_STATUS` enum('pending','accepted','rejected') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reschedule_request`
--

INSERT INTO `reschedule_request` (`REQUEST_ID`, `CLASS_ID`, `PARENT_ID`, `REQUEST_DATETIME`, `REQUEST_DESC`, `REQUEST_STATUS`) VALUES
(1, 6, 1, '2022-03-11 13:00:00', 'super sick', 'rejected'),
(2, 6, 1, '2022-03-11 15:00:00', 'request 2nd time', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `TEACHER_ID` int(10) NOT NULL,
  `ADMIN_ID` int(10) NOT NULL,
  `TEACHER_NAME` varchar(255) NOT NULL,
  `TEACHER_EMAIL` varchar(50) NOT NULL,
  `TEACHER_PASS` varchar(255) NOT NULL,
  `TEACHER_PHONE_NUM` varchar(15) NOT NULL,
  `TEACHER_STATUS` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`TEACHER_ID`, `ADMIN_ID`, `TEACHER_NAME`, `TEACHER_EMAIL`, `TEACHER_PASS`, `TEACHER_PHONE_NUM`, `TEACHER_STATUS`) VALUES
(1, 1, 'superTeacher', 'superteacher@teacher.teacher', '202cb962ac59075b964b07152d234b70', '012-3456789', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_course`
--

CREATE TABLE `teacher_course` (
  `TEACHER_COURSE_ID` int(10) NOT NULL,
  `COURSE_ID` int(10) NOT NULL,
  `TEACHER_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher_course`
--

INSERT INTO `teacher_course` (`TEACHER_COURSE_ID`, `COURSE_ID`, `TEACHER_ID`) VALUES
(1, 1, 1),
(2, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ADMIN_ID`);

--
-- Indexes for table `child`
--
ALTER TABLE `child`
  ADD PRIMARY KEY (`CHILD_ID`),
  ADD KEY `CHILD.PARENT_ID` (`PARENT_ID`),
  ADD KEY `CHILD.TEACHER_ID` (`TEACHER_ID`),
  ADD KEY `CHILD.COURSE_ID` (`COURSE_ID`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`CLASS_ID`),
  ADD KEY `CLASS.CLASSGROUP_ID` (`CLASSGROUP_ID`);

--
-- Indexes for table `class_group`
--
ALTER TABLE `class_group`
  ADD PRIMARY KEY (`CLASSGROUP_ID`),
  ADD KEY `CLASSGROUP.ADMIN_ID` (`ADMIN_ID`),
  ADD KEY `CLASSGROUP.TEACHER_ID` (`TEACHER_ID`),
  ADD KEY `CLASSGROUP.CHILD_ID` (`CHILD_ID`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`COMMENT_ID`),
  ADD KEY `COMMENT.PROGRESS_ID` (`PROGRESS_ID`),
  ADD KEY `COMMENT.TEACHER_ID` (`TEACHER_ID`),
  ADD KEY `COMMENT.PARENT_ID` (`PARENT_ID`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`COURSE_ID`),
  ADD KEY `COURSE.ADMIN_ID` (`ADMIN_ID`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`INVOICE_ID`),
  ADD KEY `INVOICE.ADMIN_ID` (`ADMIN_ID`),
  ADD KEY `INVOICE.PARENT_ID` (`PARENT_ID`);

--
-- Indexes for table `learning_resource`
--
ALTER TABLE `learning_resource`
  ADD PRIMARY KEY (`RESOURCE_ID`),
  ADD KEY `RESOURCE.TEACHER_ID` (`TEACHER_ID`),
  ADD KEY `RESOURCE.CHILD_ID` (`CHILD_ID`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`NOTIFICATION_ID`),
  ADD KEY `NOTIFICATION.ADMIN_ID` (`ADMIN_ID`),
  ADD KEY `NOTIFICATION.TEACHER_ID` (`TEACHER_ID`),
  ADD KEY `NOTIFICATION.PARENT_ID` (`PARENT_ID`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`PARENT_ID`),
  ADD KEY `PARENT.ADMIN_ID` (`ADMIN_ID`) USING BTREE;

--
-- Indexes for table `payment_receipt`
--
ALTER TABLE `payment_receipt`
  ADD PRIMARY KEY (`RECEIPT_ID`),
  ADD KEY `RECEIPT.INVOICE_ID` (`INVOICE_ID`);

--
-- Indexes for table `practice_progress`
--
ALTER TABLE `practice_progress`
  ADD PRIMARY KEY (`PROGRESS_ID`),
  ADD KEY `PROGRESS.TEACHER_ID` (`TEACHER_ID`),
  ADD KEY `PROGRESS.CHILD_ID` (`CHILD_ID`);

--
-- Indexes for table `reschedule_request`
--
ALTER TABLE `reschedule_request`
  ADD PRIMARY KEY (`REQUEST_ID`),
  ADD KEY `REQUEST.CLASS_ID` (`CLASS_ID`),
  ADD KEY `REQUEST.PARENT_ID` (`PARENT_ID`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`TEACHER_ID`),
  ADD KEY `TEACHER.ADMIN_ID` (`ADMIN_ID`) USING BTREE;

--
-- Indexes for table `teacher_course`
--
ALTER TABLE `teacher_course`
  ADD PRIMARY KEY (`TEACHER_COURSE_ID`),
  ADD KEY `TEACHER_COURSE.COURSE_ID` (`COURSE_ID`),
  ADD KEY `TEACHER_COURSE.TEACHER_ID` (`TEACHER_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ADMIN_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `child`
--
ALTER TABLE `child`
  MODIFY `CHILD_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `CLASS_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `class_group`
--
ALTER TABLE `class_group`
  MODIFY `CLASSGROUP_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `COMMENT_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `COURSE_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `INVOICE_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;

--
-- AUTO_INCREMENT for table `learning_resource`
--
ALTER TABLE `learning_resource`
  MODIFY `RESOURCE_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `NOTIFICATION_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
  MODIFY `PARENT_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_receipt`
--
ALTER TABLE `payment_receipt`
  MODIFY `RECEIPT_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `practice_progress`
--
ALTER TABLE `practice_progress`
  MODIFY `PROGRESS_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reschedule_request`
--
ALTER TABLE `reschedule_request`
  MODIFY `REQUEST_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `TEACHER_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teacher_course`
--
ALTER TABLE `teacher_course`
  MODIFY `TEACHER_COURSE_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `child`
--
ALTER TABLE `child`
  ADD CONSTRAINT `CHILD.COURSE_ID` FOREIGN KEY (`COURSE_ID`) REFERENCES `course` (`COURSE_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `CHILD.PARENT_ID` FOREIGN KEY (`PARENT_ID`) REFERENCES `parent` (`PARENT_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `CHILD.TEACHER_ID` FOREIGN KEY (`TEACHER_ID`) REFERENCES `teacher` (`TEACHER_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `CLASS.CLASSGROUP_ID` FOREIGN KEY (`CLASSGROUP_ID`) REFERENCES `class_group` (`CLASSGROUP_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `class_group`
--
ALTER TABLE `class_group`
  ADD CONSTRAINT `CLASSGROUP.ADMIN_ID` FOREIGN KEY (`ADMIN_ID`) REFERENCES `admin` (`ADMIN_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `CLASSGROUP.CHILD_ID` FOREIGN KEY (`CHILD_ID`) REFERENCES `child` (`CHILD_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `CLASSGROUP.TEACHER_ID` FOREIGN KEY (`TEACHER_ID`) REFERENCES `teacher` (`TEACHER_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `COMMENT.PARENT_ID` FOREIGN KEY (`PARENT_ID`) REFERENCES `parent` (`PARENT_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `COMMENT.PROGRESS_ID` FOREIGN KEY (`PROGRESS_ID`) REFERENCES `practice_progress` (`PROGRESS_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `COMMENT.TEACHER_ID` FOREIGN KEY (`TEACHER_ID`) REFERENCES `teacher` (`TEACHER_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `COURSE.ADMIN_ID` FOREIGN KEY (`ADMIN_ID`) REFERENCES `admin` (`ADMIN_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `INVOICE.ADMIN_ID` FOREIGN KEY (`ADMIN_ID`) REFERENCES `admin` (`ADMIN_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `INVOICE.PARENT_ID	` FOREIGN KEY (`PARENT_ID`) REFERENCES `parent` (`PARENT_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `learning_resource`
--
ALTER TABLE `learning_resource`
  ADD CONSTRAINT `RESOURCE.CHILD_ID` FOREIGN KEY (`CHILD_ID`) REFERENCES `child` (`CHILD_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `RESOURCE.TEACHER_ID` FOREIGN KEY (`TEACHER_ID`) REFERENCES `teacher` (`TEACHER_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `NOTIFICATION.ADMIN_ID` FOREIGN KEY (`ADMIN_ID`) REFERENCES `admin` (`ADMIN_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `NOTIFICATION.PARENT_ID` FOREIGN KEY (`PARENT_ID`) REFERENCES `parent` (`PARENT_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `NOTIFICATION.TEACHER_ID` FOREIGN KEY (`TEACHER_ID`) REFERENCES `teacher` (`TEACHER_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `parent`
--
ALTER TABLE `parent`
  ADD CONSTRAINT `PARENT.ADMIN_ID` FOREIGN KEY (`ADMIN_ID`) REFERENCES `admin` (`ADMIN_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_receipt`
--
ALTER TABLE `payment_receipt`
  ADD CONSTRAINT `RECEIPT.INVOICE_ID` FOREIGN KEY (`INVOICE_ID`) REFERENCES `invoice` (`INVOICE_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `practice_progress`
--
ALTER TABLE `practice_progress`
  ADD CONSTRAINT `PROGRESS.CHILD_ID` FOREIGN KEY (`CHILD_ID`) REFERENCES `child` (`CHILD_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `PROGRESS.TEACHER_ID` FOREIGN KEY (`TEACHER_ID`) REFERENCES `teacher` (`TEACHER_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reschedule_request`
--
ALTER TABLE `reschedule_request`
  ADD CONSTRAINT `REQUEST.CLASS_ID` FOREIGN KEY (`CLASS_ID`) REFERENCES `class` (`CLASS_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `REQUEST.PARENT_ID	` FOREIGN KEY (`PARENT_ID`) REFERENCES `parent` (`PARENT_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `TEACHER.ADMIN_ID` FOREIGN KEY (`ADMIN_ID`) REFERENCES `admin` (`ADMIN_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher_course`
--
ALTER TABLE `teacher_course`
  ADD CONSTRAINT `TEACHER_COURSE.COURSE_ID	` FOREIGN KEY (`COURSE_ID`) REFERENCES `course` (`COURSE_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `TEACHER_COURSE.TEACHER_ID` FOREIGN KEY (`TEACHER_ID`) REFERENCES `teacher` (`TEACHER_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
