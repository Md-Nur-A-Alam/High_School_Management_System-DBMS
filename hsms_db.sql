-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2023 at 11:52 PM
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
(1, 'Class 1'),
(2, 'Class 2'),
(3, 'Class 3'),
(4, 'Class 4'),
(5, 'Class 5'),
(6, 'Class 6'),
(7, 'Class 7'),
(8, 'Class 8'),
(9, 'Class 9'),
(10, 'Class 10');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `section_id` int(11) NOT NULL,
  `section_name` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`section_id`, `section_name`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C'),
(4, 'D'),
(5, 'X');

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
(1, 8, 6, 3, NULL, NULL, '01914387831', NULL, NULL, NULL, NULL, NULL),
(2, 8, 8, 2, NULL, NULL, '01914387831', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `subject_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_name`, `subject_code`) VALUES
(1, 'Mathematics', 'MATH101'),
(2, 'Science', 'SCI201'),
(3, 'English', 'ENG301'),
(4, 'History', 'HIST401'),
(5, 'ICT', 'ICT501'),
(6, 'Bangla', 'BANGL601'),
(7, 'Religion', 'RELIG701'),
(8, 'Biology', 'BIO801'),
(9, 'Physics', 'PHYS901'),
(10, 'Chemistry', 'CHEM1001');

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
(3, 31, 6, 2, NULL, NULL, NULL, NULL, NULL, 72000.00, NULL),
(4, 30, 5, 1, NULL, NULL, NULL, NULL, NULL, 72000.00, NULL),
(5, 32, 1, 4, NULL, NULL, NULL, NULL, NULL, 55005.00, NULL),
(7, 35, 9, 1, NULL, NULL, NULL, NULL, NULL, 60000.00, NULL);

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
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `registration_date`) VALUES
(2, 'MD.kayes', 'kayes.bd32@gmail.com', '306241d400574f6fcee180eb1687b119', 'student', '2023-10-06 14:09:53'),
(3, 'Israt Jahan Risha', 'isratjahanrisha03@gmail.com', 'd3375f1855a388355c1b44e914f4c2ec', 'student', '2023-10-06 14:10:18'),
(4, 'Prapti Nandi', 'praptinandi19@gmail.com', '23aa89ab63cbed7fd8844af75ce523da', 'student', '2023-10-06 14:10:43'),
(5, 'Md abdul high sharif', 'Sujohn379@gmail.com', '000bb123d49929ff50572103511a1c72', 'student', '2023-10-06 14:11:11'),
(6, 'Mounota Islam', 'mounota638@gmail.com', 'dfc78177f9367ffd9fc0af527efbf385', 'student', '2023-10-06 14:11:35'),
(7, 'Dip Karmakar', 'rdip42810@gmail.com', 'e1fa039b68e258737e3e5f742b3e177b', 'student', '2023-10-06 14:11:59'),
(8, 'Mousumi monira khatun', 'ibnatrahmanrahman@gmail.com', 'ca46d540b00f7a1cbad97fad4c168858', 'student', '2023-10-06 14:13:13'),
(9, 'Mahin Reza', 'mahinreza333@gmail.com', 'e21642add94e50a744bcc60dd4b7ed19', 'student', '2023-10-06 14:21:53'),
(10, 'Sharifa Rahman Sweety ', 'sharifarahamnsweety@gmail.com', '1d474077cce9818295929995f60c5c99', 'student', '2023-10-06 14:22:14'),
(11, 'Ifti Haque', 'ifti.baust.cse.020@gmail.com', '2709023981e0111a3912d1f8e5b4fad9', 'student', '2023-10-06 14:22:31'),
(12, 'Md. Nihad Hossain', 'nihadgo75@gmail.com', '4ee84762d9e4c1070a9fe1810717e1fc', 'student', '2023-10-06 14:22:47'),
(13, 'Most.Sadia parveen', 'sadiaparveensadia321@gmail.com', '85590258530e10cb21d8745f2b9d606a', 'student', '2023-10-06 14:23:08'),
(14, 'Sk.Md Abir Hasan Imran', 'abirhashan16@gmail.com', 'b07770b3b43f421797a0dcb92ebb442a', 'student', '2023-10-06 14:24:09'),
(15, 'Shariful hasan mondal', 'sharifulhasan817@gmail.com', '92c57b9a04797a1a09637b39adea8e4f', 'student', '2023-10-06 14:24:22'),
(16, 'MD Fahmid Foisal', 'foisalfahim032@gmail.com', '6c3eea88cddda2c89466f81f2a854b9c', 'student', '2023-10-06 14:24:39'),
(17, 'Sumaiya islam suchi ', '210201031sumaiyaislamsuchi@gmail.com', 'b0538760742874e109039e1eecf10980', 'student', '2023-10-06 14:25:11'),
(18, 'Rownak E Ikram', 'razor149876197@gmail.com', 'bfd53f3d627def131dfbded3c4a438f9', 'student', '2023-10-06 14:26:04'),
(19, 'Rayhan Sarkar Roman', 'roman59155@gmail.com', 'fc18ea4c094e1bd1a69b440e0217f041', 'student', '2023-10-06 14:26:19'),
(20, 'Fatema Tuj Zohora ', 'www.atmsfatema@gmail.com', 'cea83ce58abb068623283a30add97bd8', 'student', '2023-10-06 14:28:17'),
(21, 'Shadekujjaman Anik', 'shadekujjamananik@gmail.com', 'eee7f9134f8e199e87acac4af7e6f49e', 'student', '2023-10-06 14:29:29'),
(22, 'Harisa Mumtahena ', 'esitaakther143@gmail.com', '4cd2b10b6072991539f8e01141206d79', 'student', '2023-10-06 14:30:05'),
(23, 'MD, NUR A ALAM', 'mdnuralam2812@gmail.com', '7ac55335bf8e6f68487cdef1fad050c5', 'student', '2023-10-06 14:30:26'),
(24, 'Rakib Hasan Fahim ', 'rakibhasanfahim3@gmail.com', 'b0373c556cd303f46d2c1a5ce16d1e97', 'student', '2023-10-06 14:30:43'),
(26, 'Seam Nur', 'seamnur@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'admin', '2023-10-06 19:18:43'),
(30, 'Md. Al Hasan', 'mdalhasan@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'teacher', '2023-10-07 10:00:12'),
(31, 'Hasan Mohammad Kafi', 'kafi@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'teacher', '2023-10-07 10:00:32'),
(32, 'Mehadi Hasan', 'mehadihasansir@gmail.com', '202cb962ac59075b964b07152d234b70', 'teacher', '2023-10-07 10:01:17'),
(35, 'Md. Sydur Rahman', 'sydurrahman@gmail.com', '202cb962ac59075b964b07152d234b70', 'teacher', '2023-10-08 01:31:16'),
(36, 'Hari Sanker bormon', 'hari@gmail.com', '7ac55335bf8e6f68487cdef1fad050c5', 'student', '2023-10-08 18:54:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`);

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
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`),
  ADD UNIQUE KEY `subject_code` (`subject_code`);

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
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `teacher_designations`
--
ALTER TABLE `teacher_designations`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`),
  ADD CONSTRAINT `students_ibfk_3` FOREIGN KEY (`section_id`) REFERENCES `sections` (`section_id`);

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
