-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2022 at 06:58 PM
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
(1, 'SuperAdmin', 'superadmin@admin.test', '202cb962ac59075b964b07152d234b70'),
(2, 'Jason Low', 'jasonlow011@gmail.com', '202cb962ac59075b964b07152d234b70');

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
(1, 1, 1, 1, 'superchild', 14, 'active'),
(2, 1, 1, 1, 'superchild2', 15, 'active'),
(3, 2, 2, 2, 'Wan Wen', 12, 'active'),
(4, 2, 2, 3, 'Wan Thing', 14, 'active'),
(5, 2, 3, 3, 'Jun Kit', 15, 'active'),
(6, 3, 3, 2, 'Kate', 5, 'active');

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
(1, 1, '2022-02-06 09:00:00', '2022-02-06 09:30:00', 0, 'piano room A', 'learn piano beginner lesson in 3 months', 'present'),
(2, 1, '2022-02-13 09:00:00', '2022-02-13 09:30:00', 0, 'piano room A', 'learn piano beginner lesson in 3 months', 'absent'),
(3, 1, '2022-02-20 09:00:00', '2022-02-20 09:30:00', 0, 'piano room A', 'learn piano beginner lesson in 3 months', NULL),
(4, 1, '2022-02-27 09:00:00', '2022-02-27 09:30:00', 0, 'piano room A', 'learn piano beginner lesson in 3 months', NULL),
(5, 1, '2022-03-06 09:00:00', '2022-03-06 09:30:00', 0, 'piano room A', 'learn piano beginner lesson in 3 months', NULL),
(6, 1, '2022-03-13 09:00:00', '2022-03-13 09:30:00', 0, 'piano room A', 'learn piano beginner lesson in 3 months', NULL),
(7, 1, '2022-03-20 09:00:00', '2022-03-20 09:30:00', 0, 'piano room A', 'learn piano beginner lesson in 3 months', NULL),
(8, 1, '2022-03-27 09:00:00', '2022-03-27 09:30:00', 0, 'piano room A', 'learn piano beginner lesson in 3 months', NULL),
(9, 1, '2022-04-03 09:00:00', '2022-04-03 09:30:00', 0, 'piano room A', 'learn piano beginner lesson in 3 months', NULL),
(10, 1, '2022-04-10 09:00:00', '2022-04-10 09:30:00', 0, 'piano room A', 'learn piano beginner lesson in 3 months', NULL),
(11, 1, '2022-04-17 09:00:00', '2022-04-17 09:30:00', 0, 'piano room A', 'learn piano beginner lesson in 3 months', NULL),
(12, 1, '2022-04-24 09:00:00', '2022-04-24 09:30:00', 0, 'piano room A', 'learn piano beginner lesson in 3 months', NULL),
(13, 2, '2022-02-04 13:00:00', '2022-02-04 14:00:00', 5, 'piano room E', 'grade 2 lesson', 'absent'),
(15, 2, '2022-02-12 13:00:00', '2022-02-12 14:00:00', 6, 'piano room E', 'grade 2 lesson', 'present'),
(16, 2, '2022-02-18 13:00:00', '2022-02-18 14:00:00', 5, 'piano room E', 'grade 2 lesson', NULL),
(17, 2, '2022-02-26 13:00:00', '2022-02-26 14:00:00', 6, 'piano room E', 'grade 2 lesson', NULL),
(18, 2, '2022-03-05 13:00:00', '2022-03-05 14:00:00', 6, 'piano room E', 'grade 2 lesson', NULL);

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
(1, 2, 2, 3),
(2, 2, 3, 5);

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
(1, 2, 2, NULL, 'good listening and focusing during class\r\nkeep it up', '2022-02-07 23:39:22'),
(2, 2, NULL, 2, 'great to hear that', '2022-02-08 00:12:00'),
(3, 4, 3, NULL, 'interesting', '2022-02-08 00:17:16'),
(4, 4, NULL, 2, 'good performance', '2022-02-08 00:23:38'),
(5, 1, 2, NULL, 'fast learning and understanding', '2022-02-09 14:32:02'),
(6, 6, 2, NULL, 'good practice', '2022-02-09 14:44:06'),
(8, 2, 2, NULL, 'good👍👍🏻👍🏼👍🏽👍🏾👍🏿', '2022-02-14 16:59:07'),
(9, 1, NULL, 2, 'ok noted with thanks😊', '2022-02-14 17:16:27'),
(10, 6, NULL, 2, 'okok👍', '2022-02-14 17:17:31');

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
(1, 1, 'Piano grade 1', 100, 45, 'superadmin de piano grade 1', 'active'),
(2, 2, 'Piano grade 1', 110, 30, '-Learn scales and arpeggios in C, G, F majors and A, D minors\r\n-Sight reading in G, F majors and A minor\r\n-Aural tests\r\n-ABRSM Grade 1 Piano Exam', 'active'),
(3, 2, 'Piano grade 2', 120, 60, '-Learn scales and arpeggios in C, G, F, D, A majors and A, D, E, G minors\r\n-Sight reading in D major and E, G minors\r\n-Aural tests\r\n-ABRSM Grade 2 Piano Exam', 'active'),
(4, 2, 'Piano grade 3', 150, 30, '-Learn scales and arpeggios in D, A, E, Bb, Eb, majors and E, G, B, C minors\r\n-Sight reading in A, Bb, Eb majors and B minor\r\n-Aural tests\r\n-ABRSM Grade 3 Piano Exam', 'active'),
(5, 2, 'Guitar grade 1', 110, 30, '-Learn scales and arpeggios in G, F majors and A, E minors\r\n-Sight reading in C, G, F majors and A, E minors\r\n        -Time signature 4/4, 3/4 and 2/4\r\n-Aural tests\r\n-ABRSM Grade 1 Guitar Exam', 'active');

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
(1, 2, 4, 'Piano C major scale', 'https://www.youtube.com/watch?v=QDWKzG5oaog', '../localFolder/resource/piano-scales-major.pdf', '2022-01-26 15:51:36'),
(2, 2, 3, 'Piano fingering position', 'https://www.youtube.com/watch?v=v84wcuKn6sM', '', '2022-01-26 15:51:45'),
(3, 2, 4, 'Piano G major scale', 'https://app.diagrams.net/#G1Kys7lV-uJ1P_n63Ob4J6NLFZxdCbucrG', '', '2022-02-09 14:35:23'),
(4, 3, 5, 'A minors scale', '', '../localFolder/resource/Am.png', '2022-01-26 15:46:21'),
(5, 2, 4, 'Piano C major scale', '', '../localFolder/resource/complete_guitar_syllabus.pdf', '2022-02-09 14:34:38');

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
  `DATETIME` datetime NOT NULL DEFAULT current_timestamp(),
  `LINK` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`NOTIFICATION_ID`, `ADMIN_ID`, `TEACHER_ID`, `PARENT_ID`, `TITLE`, `CONTENT`, `VIEW_STATUS`, `DATETIME`, `LINK`) VALUES
(1, NULL, 2, NULL, 'You have a new child!', 'A new child (Wan Wen) has assigned to you!', 'unseen', '2022-01-21 23:20:44', 'TChildren.php'),
(2, NULL, 2, NULL, 'You have a new child!', 'A new child (Wan Thing) has assigned to you!', 'seen', '2022-01-21 23:20:44', 'TChildren.php'),
(3, NULL, 3, NULL, 'You have a new child!', 'A new child (Jun Kit) has assigned to you!', 'unseen', '2022-01-21 23:22:14', 'TChildren.php'),
(4, NULL, 3, NULL, 'You have a new child!', 'A new child (Kate) has assigned to you!', 'unseen', '2022-02-09 01:35:30', 'TChildren.php');

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
(1, 1, 'SuperParent', 'superparent@parent.test', '202cb962ac59075b964b07152d234b70', '011-12341234', 'active', 'guardian'),
(2, 2, 'Leong CK', 'leong@leong.leong', '202cb962ac59075b964b07152d234b70', '011-44443333', 'active', 'father'),
(3, 2, 'Angeline Chong', 'ange@mail.com', '202cb962ac59075b964b07152d234b70', '013-7776363', 'active', 'mother');

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
(1, 2, 4, 'Piano grade 2', '4/2 class video', '../localFolder/progress/WanThing1.mp4', '2022-02-09 01:49:07'),
(2, 2, 3, 'Piano grade 1', '3/2 class video', '../localFolder/progress/WanWen1.mp4', '2022-02-09 01:49:26'),
(3, 2, 4, 'Piano grade 2', '2nd class video', '../localFolder/progress/720p - Copy.webm', '2022-02-09 12:46:49'),
(4, 3, 5, 'Piano grade 1', 'final class on 1/2', '../localFolder/progress/junkit_grade1_Final.mp4', '2022-02-09 02:13:54'),
(5, 3, 5, 'Piano grade 2', '1st class on 3/2', '../localFolder/progress/junkit_grade2_1.mp4', '2022-02-09 02:14:10'),
(6, 2, 3, 'Piano grade 1', '3rd class video', '../localFolder/progress/class2.mp4', '2022-02-09 14:43:22');

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
(1, 1, 'superTeacher', 'superTeacher@teacher.com', '202cb962ac59075b964b07152d234b70', '011-99999999', 'active'),
(2, 2, 'Chloe', 'chloe@chloe.chloe', '202cb962ac59075b964b07152d234b70', '012-3456789', 'active'),
(3, 2, 'Su Ling', 'su@su.su', '202cb962ac59075b964b07152d234b70', '013-4446666', 'active'),
(4, 2, 'Christina', 'christina@chemail.com', '202cb962ac59075b964b07152d234b70', '011-78784545', 'active');

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
(4, 3, 2),
(5, 3, 3),
(6, 4, 3),
(7, 2, 2),
(8, 2, 3),
(9, 2, 4);

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
  MODIFY `CHILD_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `CLASS_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `class_group`
--
ALTER TABLE `class_group`
  MODIFY `CLASSGROUP_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `COMMENT_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `COURSE_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `learning_resource`
--
ALTER TABLE `learning_resource`
  MODIFY `RESOURCE_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `NOTIFICATION_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
  MODIFY `PARENT_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `practice_progress`
--
ALTER TABLE `practice_progress`
  MODIFY `PROGRESS_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reschedule_request`
--
ALTER TABLE `reschedule_request`
  MODIFY `REQUEST_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `TEACHER_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teacher_course`
--
ALTER TABLE `teacher_course`
  MODIFY `TEACHER_COURSE_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
