-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2023 at 07:46 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hsms_db`
--
DROP DATABASE IF EXISTS `hsms_db`;
CREATE DATABASE IF NOT EXISTS `hsms_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hsms_db`;

-- --------------------------------------------------------

--
-- Table structure for table `arch_students`
--

CREATE TABLE `arch_students` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `DATE` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arch_students`
--

INSERT INTO `arch_students` (`id`, `student_id`, `user_id`, `class_id`, `section_id`, `address`, `DATE`) VALUES
(1, 41, 24, 10, 2, 'Jashore, Bangladesh', '2023-11-02');

-- --------------------------------------------------------

--
-- Table structure for table `arch_teachers`
--

CREATE TABLE `arch_teachers` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `DATE` date DEFAULT curdate(),
  `qualification` text DEFAULT NULL,
  `salary` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arch_teachers`
--

INSERT INTO `arch_teachers` (`id`, `teacher_id`, `user_id`, `designation_id`, `DATE`, `qualification`, `salary`) VALUES
(1, 13, 30, 4, '2023-11-02', NULL, 65000),
(2, 9, 32, 3, '2023-11-02', NULL, 55000);

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `id` int(11) NOT NULL,
  `stu_id` int(11) DEFAULT NULL,
  `Bangla` longblob DEFAULT NULL,
  `English` longblob DEFAULT NULL,
  `Math` longblob DEFAULT NULL,
  `SocialScience` longblob DEFAULT NULL,
  `Science` longblob DEFAULT NULL,
  `Commerce` longblob DEFAULT NULL,
  `Arts` longblob DEFAULT NULL,
  `PhysicalEducation` longblob DEFAULT NULL,
  `ICT` longblob DEFAULT NULL,
  `Religion` longblob DEFAULT NULL,
  `Agriculture` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`id`, `stu_id`, `Bangla`, `English`, `Math`, `SocialScience`, `Science`, `Commerce`, `Arts`, `PhysicalEducation`, `ICT`, `Religion`, `Agriculture`) VALUES
(1, 28, NULL, NULL, NULL, NULL, 0x61737369676e6d656e745f36353365396461386165383733352e38363830363537372e706466, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `class_name`) VALUES
(0, 'Default'),
(6, 'Class 6'),
(7, 'Class 7'),
(8, 'Class 8'),
(9, 'Class 9'),
(10, 'Class 10');

-- --------------------------------------------------------

--
-- Table structure for table `class_routine`
--

CREATE TABLE `class_routine` (
  `id` int(11) NOT NULL,
  `day` varchar(20) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `1st_subject_id` int(11) DEFAULT NULL,
  `1st_teacher_id` int(11) DEFAULT NULL,
  `2nd_subject_id` int(11) DEFAULT NULL,
  `2nd_teacher_id` int(11) DEFAULT NULL,
  `3rd_subject_id` int(11) DEFAULT NULL,
  `3rd_teacher_id` int(11) DEFAULT NULL,
  `4th_subject_id` int(11) DEFAULT NULL,
  `4th_teacher_id` int(11) DEFAULT NULL,
  `5th_subject_id` int(11) DEFAULT NULL,
  `5th_teacher_id` int(11) DEFAULT NULL,
  `6th_subject_id` int(11) DEFAULT NULL,
  `6th_teacher_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_routine`
--

INSERT INTO `class_routine` (`id`, `day`, `class_id`, `section_id`, `1st_subject_id`, `1st_teacher_id`, `2nd_subject_id`, `2nd_teacher_id`, `3rd_subject_id`, `3rd_teacher_id`, `4th_subject_id`, `4th_teacher_id`, `5th_subject_id`, `5th_teacher_id`, `6th_subject_id`, `6th_teacher_id`) VALUES
(1, 'Sat', 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Sat', 6, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Sat', 6, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Sun', 6, 1, 1, NULL, 3, NULL, 7, NULL, 8, 9, 7, NULL, 6, NULL),
(5, 'Sun', 6, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Sun', 6, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Mon', 6, 1, 4, 10, 5, 9, 5, NULL, 5, NULL, 8, 9, 8, NULL),
(8, 'Mon', 6, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Mon', 6, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Tue', 6, 1, 1, NULL, 1, 10, 1, 9, 1, NULL, 1, NULL, 1, 9),
(11, 'Tue', 6, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'Tue', 6, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'Wed', 6, 1, 1, NULL, 1, NULL, 1, 9, 1, NULL, 1, 10, 1, 9),
(14, 'Wed', 6, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'Wed', 6, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Thu', 6, 1, 1, 9, 1, 10, 1, NULL, 1, NULL, 1, 9, 1, NULL),
(17, 'Thu', 6, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'Thu', 6, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'Fri', 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'Fri', 6, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'Fri', 6, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'Sat', 7, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'Sat', 7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'Sat', 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'Sun', 7, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'Sun', 7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 'Sun', 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 'Mon', 7, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'Mon', 7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 'Mon', 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 'Tue', 7, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'Tue', 7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 'Tue', 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 'Wed', 7, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'Wed', 7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 'Wed', 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 'Thu', 7, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 'Thu', 7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 'Thu', 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 'Fri', 7, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 'Fri', 7, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 'Fri', 7, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 'Sat', 8, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 'Sat', 8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 'Sat', 8, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 'Sun', 8, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 'Sun', 8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 'Sun', 8, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 'Mon', 8, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 'Mon', 8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 'Mon', 8, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 'Tue', 8, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 'Tue', 8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(54, 'Tue', 8, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 'Wed', 8, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 'Wed', 8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 'Wed', 8, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58, 'Thu', 8, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, 'Thu', 8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60, 'Thu', 8, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(61, 'Fri', 8, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, 'Fri', 8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(63, 'Fri', 8, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64, 'Sat', 9, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, 'Sat', 9, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(66, 'Sat', 9, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(67, 'Sun', 9, 1, 1, 11, 3, 9, 2, 17, 4, 16, 5, 18, 6, 13),
(68, 'Sun', 9, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(69, 'Sun', 9, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70, 'Mon', 9, 1, 1, 11, 11, 13, 10, 10, 9, 10, 8, 16, 7, 18),
(71, 'Mon', 9, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(72, 'Mon', 9, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(73, 'Tue', 9, 1, 1, 11, 4, 13, 5, 10, 3, 9, 6, 16, 5, 18),
(74, 'Tue', 9, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(75, 'Tue', 9, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(76, 'Wed', 9, 1, 1, 11, 3, 9, 6, 10, 2, 13, 6, 18, 2, 17),
(77, 'Wed', 9, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 'Wed', 9, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(79, 'Thu', 9, 1, 1, 11, 2, 17, 7, 18, 11, 10, 10, 16, 8, 10),
(80, 'Thu', 9, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 'Thu', 9, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(82, 'Fri', 9, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(83, 'Fri', 9, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(84, 'Fri', 9, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(85, 'Sat', 10, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(86, 'Sat', 10, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(87, 'Sat', 10, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(88, 'Sun', 10, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(89, 'Sun', 10, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, 'Sun', 10, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(91, 'Mon', 10, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(92, 'Mon', 10, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(93, 'Mon', 10, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(94, 'Tue', 10, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(95, 'Tue', 10, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(96, 'Tue', 10, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(97, 'Wed', 10, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(98, 'Wed', 10, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(99, 'Wed', 10, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(100, 'Thu', 10, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(101, 'Thu', 10, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(102, 'Thu', 10, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(103, 'Fri', 10, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(104, 'Fri', 10, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(105, 'Fri', 10, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `noticeID` int(11) NOT NULL,
  `noticeDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `sender` enum('student','teacher','accounts','admin') DEFAULT NULL,
  `receiver` enum('student','teacher','accounts','admin') DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`noticeID`, `noticeDate`, `sender`, `receiver`, `user_id`, `subject`, `message`) VALUES
(1, '2023-10-15 21:46:41', 'admin', 'student', NULL, 'Idea Contest', 'Dear all students please submit your idea with in 1 week. i.e. 22-10-2023'),
(5, '2023-10-15 22:08:31', 'admin', 'teacher', NULL, 'Meeting', 'All teachers have to come to the meeting room al 12pm on 2023-10-17'),
(8, '2023-10-20 21:23:20', 'admin', 'student', NULL, 'Important Notice Regarding Upcoming Examinations', 'Dear students,  We hope this notice finds you well. As we approach the end of the semester, we want to inform you about some important details regarding the upcoming examinations.  **1. Examination Schedule:** The final examination schedule has been posted on our school\'s website. Please take a moment to review the schedule carefully. Ensure that you are aware of the date, time, and location of each of your examinations. If you have any concerns or scheduling conflicts, please reach out to our academic office immediately.  **2. Study Resources:** We encourage all students to make the most of our extensive library resources and academic support services. Preparing well for your exams is crucial for your success. If you need any assistance with your studies, don\'t hesitate to ask your professors or the academic support team.  **3. COVID-19 Safety Measures:** In light of the ongoing pandemic, we want to stress the importance of adhering to COVID-19 safety guidelines. Please wear your masks, maintain social distancing, and follow all safety protocols while on campus during the examination period. Your health and the health of others are our top priorities.  **4. Late Submissions and Absences:** Please remember that late submissions and unexcused absences from exams may result in academic penalties. If you anticipate any issues that may affect your ability to sit for an examination, contact the academic office as soon as possible to discuss your options.  **5. Additional Support:** If you\'re feeling stressed or overwhelmed during this period, our counseling services are available to provide support and resources for your mental well-being.  We understand that examinations can be a stressful time, but we have confidence in your abilities. Study hard, stay focused, and do your best. We\'re here to support you in your academic journey.  Best of luck with your preparations, and we look forward to seeing you succeed in your exams.  Sincerely,  [Your Name] [Your Title] [School Name] [Contact Information]'),
(11, '2023-10-24 09:24:52', 'teacher', 'student', NULL, 'Assignment Submission', 'Please submit your assignment with in 7 days');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `section_id` int(11) NOT NULL,
  `section_name` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`section_id`, `section_name`) VALUES
(1, 'Sec-A'),
(2, 'Sec-B'),
(3, 'Sec-C');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `guardian_name` varchar(255) DEFAULT NULL,
  `guardian_phone` varchar(15) DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `blood_group` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') DEFAULT NULL,
  `profile_pic` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `user_id`, `class_id`, `section_id`, `date_of_birth`, `address`, `phone_number`, `guardian_name`, `guardian_phone`, `gender`, `blood_group`, `profile_pic`) VALUES
(21, 3, 6, 1, '2023-10-02', NULL, '01914387831', NULL, NULL, 'Female', NULL, NULL),
(22, 4, 6, 1, '2023-10-11', NULL, '+8801643067065', NULL, NULL, 'Female', NULL, NULL),
(23, 5, 6, 1, '2023-10-02', NULL, '01914387831', NULL, NULL, 'Male', NULL, NULL),
(24, 6, 6, 1, '2023-10-23', NULL, '+8801643067065', NULL, NULL, 'Female', NULL, NULL),
(25, 8, 8, 2, '2001-12-12', 'parbatiput, nilphamary', '01742833288', 'ABBA', '01643067065', 'Female', 'O+', 0x32352e6a7067),
(26, 9, 6, 2, '2023-10-04', NULL, '01643067065', NULL, NULL, 'Male', NULL, NULL),
(27, 10, 6, 2, '2023-10-02', NULL, '01643067065', NULL, NULL, 'Female', NULL, NULL),
(28, 11, 10, 1, '0000-00-00', 'dhaka', '+8801643067065', 'Zikrul Haque', '01911170999', 'Male', 'A+', 0x6e6f6e2d736d696c696e672d4c696e6b6564496e2d70726f66696c652d70686f746f2e6a7067),
(29, 12, 7, 1, '2023-09-18', NULL, '01643067065', NULL, NULL, 'Male', NULL, NULL),
(30, 13, 7, 1, '2023-08-17', NULL, '01643067065', NULL, NULL, 'Female', NULL, NULL),
(31, 14, 7, 1, '2023-07-05', NULL, '01859265415', NULL, NULL, 'Male', NULL, NULL),
(32, 15, 7, 1, '2023-03-09', NULL, '01859265415', NULL, NULL, 'Male', NULL, NULL),
(33, 16, 8, 1, '2023-09-07', NULL, '01643067065', NULL, NULL, 'Male', NULL, 0x33332e6a7067),
(34, 17, 8, 1, '2022-11-16', NULL, '01643067065', NULL, NULL, 'Female', NULL, NULL),
(35, 18, 8, 1, '2023-06-24', NULL, '01914387831', NULL, NULL, 'Female', NULL, NULL),
(36, 19, 9, 1, '2023-04-16', NULL, '01643067065', NULL, NULL, 'Male', NULL, NULL),
(37, 20, 7, 2, '2023-06-03', NULL, '01859265415', NULL, NULL, 'Female', NULL, NULL),
(38, 21, 8, 2, '2023-04-16', NULL, '+8801643067065', NULL, NULL, 'Male', NULL, NULL),
(39, 22, 9, 2, '2022-10-29', NULL, '01643067065', NULL, NULL, 'Female', NULL, NULL),
(40, 23, 10, 1, '2001-12-28', 'Satkhira, Khulna, Dhaka', '+8801643067065', 'Md. Shah Alam', '01725794566', 'Male', 'O+', 0x34302e6a7067),
(41, 24, 10, 1, '2001-01-30', 'Jashore, Bangladesh', '01914387831', 'AMMU', '01643067065', 'Male', 'B-', 0x34312e6a7067),
(42, 36, 10, 1, '2022-03-28', NULL, '+8801643067065', NULL, NULL, 'Male', NULL, NULL),
(44, 72, 6, 2, '2023-10-04', NULL, '01914387831', NULL, NULL, 'Male', NULL, NULL);

--
-- Triggers `students`
--
DELIMITER $$
CREATE TRIGGER `after_students_insert` AFTER INSERT ON `students` FOR EACH ROW BEGIN
    INSERT INTO student_attendance (stu_id) VALUES (NEW.student_id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_students_update` AFTER UPDATE ON `students` FOR EACH ROW BEGIN
    IF OLD.class_id <> NEW.class_id OR OLD.section_id <> NEW.section_id OR OLD.address <> NEW.address THEN
        INSERT INTO arch_students(student_id, user_id, class_id, section_id, address)
        VALUES(NEW.student_id, NEW.user_id, OLD.class_id, OLD.section_id, OLD.address);
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_students_delete` BEFORE DELETE ON `students` FOR EACH ROW BEGIN
    delete from student_attendance where stu_id = old.student_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `student_attendance`
--

CREATE TABLE `student_attendance` (
  `atten_id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `2023-10-23` int(11) DEFAULT 0,
  `2023-10-24` int(11) DEFAULT 0,
  `2023-10-22` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_attendance`
--

INSERT INTO `student_attendance` (`atten_id`, `stu_id`, `2023-10-23`, `2023-10-24`, `2023-10-22`) VALUES
(3, 21, 1, 1, 1),
(4, 22, 1, 1, 1),
(5, 23, 1, 1, 0),
(6, 24, 0, 1, 0),
(7, 25, 1, 0, 0),
(8, 26, 0, 0, 0),
(9, 27, 1, 0, 0),
(10, 28, 1, 0, 0),
(11, 29, 1, 0, 0),
(12, 30, 1, 0, 0),
(13, 31, 0, 0, 0),
(14, 32, 1, 0, 0),
(15, 33, 1, 0, 0),
(16, 34, 1, 0, 0),
(17, 35, 0, 0, 0),
(18, 36, 1, 0, 0),
(19, 37, 1, 0, 0),
(20, 38, 1, 0, 0),
(21, 39, 0, 0, 0),
(22, 40, 1, 0, 0),
(23, 41, 1, 0, 0),
(24, 42, 0, 0, 0),
(26, 44, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stu_profile_approval`
--

CREATE TABLE `stu_profile_approval` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `guardian` varchar(100) DEFAULT NULL,
  `guardian_phone` varchar(20) DEFAULT NULL,
  `gender` enum('Female','Male','Others') DEFAULT NULL,
  `blood_group` enum('A-','A+','B-','B+','AB-','AB+','O-','O+') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_name`) VALUES
(1, 'Bangla'),
(2, 'English'),
(3, 'Math'),
(4, 'Social Science'),
(5, 'Science'),
(6, 'Commerce'),
(7, 'Arts'),
(8, 'Physical Education'),
(9, 'ICT'),
(10, 'Religion'),
(11, 'Agriculture'),
(12, 'Extra');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `profile_pic` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `user_id`, `subject_id`, `designation_id`, `date_of_birth`, `address`, `phone_number`, `gender`, `qualification`, `salary`, `profile_pic`) VALUES
(9, 32, 9, 2, '2023-10-04', NULL, '+8801643067065', 'Male', NULL, 55000.00, NULL),
(10, 43, 10, 3, '2023-10-04', NULL, '+8801643067065', 'Male', NULL, 55005.00, NULL),
(11, 44, 1, 3, '2023-10-03', NULL, '01859265415', 'Male', NULL, 50000.00, NULL),
(13, 30, 5, 3, '2023-10-01', NULL, '01914387832', 'Male', NULL, 65000.00, 0x31332e6a7067),
(16, 55, 9, 3, '2023-10-03', NULL, '01859265415', 'Female', NULL, 55000.00, NULL),
(17, 54, 2, 3, '2023-08-31', NULL, '01859265415', 'Male', NULL, 65000.00, NULL),
(18, 53, 5, 1, '2023-10-02', 'Satkhira, Khulna, Dhaka', '01914387831', 'Male', 'B.Sc in CSE - CGPA 4.00', 950000.00, 0x31382e6a706567);

--
-- Triggers `teachers`
--
DELIMITER $$
CREATE TRIGGER `after_teachers_update` AFTER UPDATE ON `teachers` FOR EACH ROW BEGIN
    IF OLD.`designation_id` <> NEW.`designation_id` OR OLD.`qualification` <> NEW.`qualification` OR OLD.`salary` <> NEW.`salary` THEN
        INSERT INTO arch_teachers(`teacher_id`, `user_id`, `designation_id`, `qualification`, `salary`)
        VALUES(NEW.`teacher_id`, NEW.`user_id`, OLD.`designation_id`, OLD.`qualification`, OLD.`salary`);
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_designations`
--

CREATE TABLE `teacher_designations` (
  `designation_id` int(11) NOT NULL,
  `designation_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_designations`
--

INSERT INTO `teacher_designations` (`designation_id`, `designation_name`) VALUES
(5, 'Counselor'),
(2, 'Head Teacher'),
(3, 'Instructor'),
(4, 'Librarian'),
(1, 'Principal');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('student','teacher','admin','accounts') NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `approval` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `registration_date`, `approval`) VALUES
(3, 'Israt Jahan Risha', 'isratjahanrisha03@gmail.com', 'd3375f1855a388355c1b44e914f4c2ec', 'student', '2023-10-06 14:10:18', 1),
(4, 'Prapti Nandi', 'praptinandi19@gmail.com', '23aa89ab63cbed7fd8844af75ce523da', 'student', '2023-10-06 14:10:43', 1),
(5, 'Md abdul high sharif', 'Sujohn379@gmail.com', '000bb123d49929ff50572103511a1c72', 'student', '2023-10-06 14:11:11', 1),
(6, 'Mounota Islam', 'mounota638@gmail.com', 'dfc78177f9367ffd9fc0af527efbf385', 'student', '2023-10-06 14:11:35', 1),
(8, 'Mousumi Monera', 'mousumi@gmail.com', 'ca46d540b00f7a1cbad97fad4c168858', 'student', '2023-10-06 14:13:13', 1),
(9, 'Mahin Reza', 'mahinreza333@gmail.com', 'e21642add94e50a744bcc60dd4b7ed19', 'student', '2023-10-06 14:21:53', 1),
(10, 'Sharifa Rahman Sweety ', 'sharifarahamnsweety@gmail.com', '1d474077cce9818295929995f60c5c99', 'student', '2023-10-06 14:22:14', 1),
(11, 'Ifti Haque', 'ifti.baust.cse.020@gmail.com', '2709023981e0111a3912d1f8e5b4fad9', 'student', '2023-10-06 14:22:31', 1),
(12, 'Md. Nihad Hossain', 'nihadgo75@gmail.com', '4ee84762d9e4c1070a9fe1810717e1fc', 'student', '2023-10-06 14:22:47', 1),
(13, 'Most.Sadia parveen', 'sadiaparveensadia321@gmail.com', '85590258530e10cb21d8745f2b9d606a', 'student', '2023-10-06 14:23:08', 1),
(14, 'Sk.Md Abir Hasan Imran', 'abirhashan16@gmail.com', 'b07770b3b43f421797a0dcb92ebb442a', 'student', '2023-10-06 14:24:09', 1),
(15, 'Shariful hasan mondal', 'sharifulhasan817@gmail.com', '92c57b9a04797a1a09637b39adea8e4f', 'student', '2023-10-06 14:24:22', 1),
(16, 'MD Fahmid Foisal', 'foisalfahim032@gmail.com', '6c3eea88cddda2c89466f81f2a854b9c', 'student', '2023-10-06 14:24:39', 1),
(17, 'Sumaiya islam suchi ', '210201031sumaiyaislamsuchi@gmail.com', 'b0538760742874e109039e1eecf10980', 'student', '2023-10-06 14:25:11', 1),
(18, 'Rownak E Ikram', 'razor149876197@gmail.com', 'bfd53f3d627def131dfbded3c4a438f9', 'student', '2023-10-06 14:26:04', 1),
(19, 'Rayhan Sarkar Roman', 'roman59155@gmail.com', 'fc18ea4c094e1bd1a69b440e0217f041', 'student', '2023-10-06 14:26:19', 1),
(20, 'Fatema Tuj Zohora ', 'www.atmsfatema@gmail.com', 'cea83ce58abb068623283a30add97bd8', 'student', '2023-10-06 14:28:17', 1),
(21, 'Shadekujjaman Anik', 'shadekujjamananik@gmail.com', 'eee7f9134f8e199e87acac4af7e6f49e', 'student', '2023-10-06 14:29:29', 1),
(22, 'Harisa Mumtahena ', 'esitaakther143@gmail.com', '4cd2b10b6072991539f8e01141206d79', 'student', '2023-10-06 14:30:05', 1),
(23, 'MD, NUR A ALAM', 'mdnuralam2812@gmail.com', '7ac55335bf8e6f68487cdef1fad050c5', 'student', '2023-10-06 14:30:26', 1),
(24, 'Rakib Hasan Fahim ', 'rakibhasanfahim3@gmail.com', 'b0373c556cd303f46d2c1a5ce16d1e97', 'student', '2023-10-06 14:30:43', 1),
(26, 'Seam Nur', 'seamnur@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'admin', '2023-10-06 19:18:43', 1),
(30, 'Md. Al Hasan', 'mdalhasan@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'teacher', '2023-10-07 10:00:12', 1),
(32, 'Mehadi Hasan', 'mehadihasansir@gmail.com', '202cb962ac59075b964b07152d234b70', 'teacher', '2023-10-07 10:01:17', 1),
(36, 'Hari Sanker bormon', 'hari@gmail.com', '7ac55335bf8e6f68487cdef1fad050c5', 'student', '2023-10-08 18:54:55', 1),
(42, 'SK Niyaz Romiz', 'niyazromiz@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'accounts', '2023-10-11 20:27:18', 1),
(43, 'Khalid', 'khalid@gamil.com', '827ccb0eea8a706c4c34a16891f84e7b', 'teacher', '2023-10-14 18:06:29', 1),
(44, 'Asif tanvir', 'asif@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'teacher', '2023-10-19 02:03:08', 1),
(53, 'Hasan Mohammad Kafi', 'kafi@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'teacher', '2023-10-20 19:56:06', 1),
(54, 'Sydur rahman', 'sydurrahman@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'teacher', '2023-10-20 19:56:30', 1),
(55, 'Jerin Tasnim', 'jerintasnim@baust.com', '827ccb0eea8a706c4c34a16891f84e7b', 'teacher', '2023-10-20 19:56:55', 1),
(72, 'Moin', 'moin@gmail.com', '202cb962ac59075b964b07152d234b70', 'student', '2023-10-28 01:08:28', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arch_students`
--
ALTER TABLE `arch_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arch_teachers`
--
ALTER TABLE `arch_teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `class_routine`
--
ALTER TABLE `class_routine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `1st_subject_id` (`1st_subject_id`),
  ADD KEY `1st_teacher_id` (`1st_teacher_id`),
  ADD KEY `2nd_subject_id` (`2nd_subject_id`),
  ADD KEY `2nd_teacher_id` (`2nd_teacher_id`),
  ADD KEY `3rd_subject_id` (`3rd_subject_id`),
  ADD KEY `3rd_teacher_id` (`3rd_teacher_id`),
  ADD KEY `4th_subject_id` (`4th_subject_id`),
  ADD KEY `4th_teacher_id` (`4th_teacher_id`),
  ADD KEY `5th_subject_id` (`5th_subject_id`),
  ADD KEY `5th_teacher_id` (`5th_teacher_id`),
  ADD KEY `6th_subject_id` (`6th_subject_id`),
  ADD KEY `6th_teacher_id` (`6th_teacher_id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`noticeID`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `student_attendance`
--
ALTER TABLE `student_attendance`
  ADD PRIMARY KEY (`atten_id`),
  ADD KEY `fk_student_attendance_stu_id` (`stu_id`);

--
-- Indexes for table `stu_profile_approval`
--
ALTER TABLE `stu_profile_approval`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `designation_id` (`designation_id`);

--
-- Indexes for table `teacher_designations`
--
ALTER TABLE `teacher_designations`
  ADD PRIMARY KEY (`designation_id`),
  ADD UNIQUE KEY `designation_name` (`designation_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arch_students`
--
ALTER TABLE `arch_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `arch_teachers`
--
ALTER TABLE `arch_teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `class_routine`
--
ALTER TABLE `class_routine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `noticeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `student_attendance`
--
ALTER TABLE `student_attendance`
  MODIFY `atten_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `stu_profile_approval`
--
ALTER TABLE `stu_profile_approval`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `teacher_designations`
--
ALTER TABLE `teacher_designations`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class_routine`
--
ALTER TABLE `class_routine`
  ADD CONSTRAINT `class_routine_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`),
  ADD CONSTRAINT `class_routine_ibfk_10` FOREIGN KEY (`4th_teacher_id`) REFERENCES `teachers` (`teacher_id`),
  ADD CONSTRAINT `class_routine_ibfk_11` FOREIGN KEY (`5th_subject_id`) REFERENCES `subjects` (`subject_id`),
  ADD CONSTRAINT `class_routine_ibfk_12` FOREIGN KEY (`5th_teacher_id`) REFERENCES `teachers` (`teacher_id`),
  ADD CONSTRAINT `class_routine_ibfk_13` FOREIGN KEY (`6th_subject_id`) REFERENCES `subjects` (`subject_id`),
  ADD CONSTRAINT `class_routine_ibfk_14` FOREIGN KEY (`6th_teacher_id`) REFERENCES `teachers` (`teacher_id`),
  ADD CONSTRAINT `class_routine_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `sections` (`section_id`),
  ADD CONSTRAINT `class_routine_ibfk_3` FOREIGN KEY (`1st_subject_id`) REFERENCES `subjects` (`subject_id`),
  ADD CONSTRAINT `class_routine_ibfk_4` FOREIGN KEY (`1st_teacher_id`) REFERENCES `teachers` (`teacher_id`),
  ADD CONSTRAINT `class_routine_ibfk_5` FOREIGN KEY (`2nd_subject_id`) REFERENCES `subjects` (`subject_id`),
  ADD CONSTRAINT `class_routine_ibfk_6` FOREIGN KEY (`2nd_teacher_id`) REFERENCES `teachers` (`teacher_id`),
  ADD CONSTRAINT `class_routine_ibfk_7` FOREIGN KEY (`3rd_subject_id`) REFERENCES `subjects` (`subject_id`),
  ADD CONSTRAINT `class_routine_ibfk_8` FOREIGN KEY (`3rd_teacher_id`) REFERENCES `teachers` (`teacher_id`),
  ADD CONSTRAINT `class_routine_ibfk_9` FOREIGN KEY (`4th_subject_id`) REFERENCES `subjects` (`subject_id`);

--
-- Constraints for table `notices`
--
ALTER TABLE `notices`
  ADD CONSTRAINT `notices_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`),
  ADD CONSTRAINT `students_ibfk_3` FOREIGN KEY (`section_id`) REFERENCES `sections` (`section_id`);

--
-- Constraints for table `student_attendance`
--
ALTER TABLE `student_attendance`
  ADD CONSTRAINT `fk_student_attendance_stu_id` FOREIGN KEY (`stu_id`) REFERENCES `students` (`student_id`);

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `teachers_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`),
  ADD CONSTRAINT `teachers_ibfk_3` FOREIGN KEY (`designation_id`) REFERENCES `teacher_designations` (`designation_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
