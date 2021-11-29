-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 29, 2021 at 05:30 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `external_studentcareer`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `application_id` bigint(20) NOT NULL,
  `application_internship` bigint(20) NOT NULL,
  `application_student` bigint(20) NOT NULL,
  `application_description` varchar(2000) DEFAULT NULL,
  `application_viewed` int(11) NOT NULL DEFAULT '0',
  `application_status` int(11) DEFAULT NULL,
  `application_response` varchar(1000) DEFAULT NULL,
  `application_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `application_flg` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`application_id`, `application_internship`, `application_student`, `application_description`, `application_viewed`, `application_status`, `application_response`, `application_stamp`, `application_flg`) VALUES
(1, 5, 3, 'I will do my best Two', 1, 3, 'Good approved', '2021-11-08 14:50:54', 1),
(3, 2, 3, NULL, 0, NULL, NULL, '2021-11-09 17:43:24', 1),
(4, 2, 12, NULL, 1, 2, 'We have approved', '2021-11-18 08:51:38', 1),
(5, 2, 6, 'I wish to join', 1, 3, NULL, '2021-11-28 20:55:05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `company_id` bigint(20) NOT NULL,
  `company_email` varchar(50) NOT NULL,
  `company_mobile` varchar(12) DEFAULT NULL,
  `company_organization` bigint(20) DEFAULT NULL,
  `company_password` varchar(200) NOT NULL,
  `company_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `company_flg` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`company_id`, `company_email`, `company_mobile`, `company_organization`, `company_password`, `company_stamp`, `company_flg`) VALUES
(2, 'info@eabl.com', '713549110', 2, '7d38307ef52e802145060851c5225f7e02dd9581', '2021-11-07 16:24:50', 1),
(3, 'info@safaricom.co.ke', '', 1, '7d38307ef52e802145060851c5225f7e02dd9581', '2021-11-07 16:46:21', 1),
(4, 'info@kcbgroup.com', '', 3, '7d38307ef52e802145060851c5225f7e02dd9581', '2021-11-07 16:47:48', 1),
(5, 'info@smartwebkenya.com', '', 4, '7d38307ef52e802145060851c5225f7e02dd9581', '2021-11-18 08:51:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `curriculums`
--

CREATE TABLE `curriculums` (
  `curriculum_id` bigint(20) NOT NULL,
  `curriculum_student` bigint(20) NOT NULL,
  `curriculum_university` bigint(20) NOT NULL,
  `curriculum_attachment` bigint(20) DEFAULT NULL,
  `curriculum_availability` bigint(20) DEFAULT NULL,
  `curriculum_major` bigint(20) DEFAULT NULL,
  `curriculum_about` varchar(1000) NOT NULL,
  `curriculum_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `curriculum_flg` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `curriculums`
--

INSERT INTO `curriculums` (`curriculum_id`, `curriculum_student`, `curriculum_university`, `curriculum_attachment`, `curriculum_availability`, `curriculum_major`, `curriculum_about`, `curriculum_stamp`, `curriculum_flg`) VALUES
(1, 3, 1, 1, 10, 3, 'I have experience in Programming and Project Management', '2021-11-07 15:03:27', 1),
(2, 10, 1, 6, 2, 12, 'Africa Nazarene University', '2021-11-09 20:03:01', 1),
(3, 12, 1, 1, 11, 3, 'Am dedicated', '2021-11-18 08:50:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `interships`
--

CREATE TABLE `interships` (
  `intership_id` bigint(20) NOT NULL,
  `intership_organization` bigint(20) NOT NULL,
  `intership_attachment` bigint(20) NOT NULL,
  `intership_major` bigint(20) NOT NULL,
  `intership_availability` bigint(20) NOT NULL,
  `intership_paid` varchar(15) DEFAULT NULL,
  `intership_university` bigint(20) DEFAULT NULL,
  `intership_description` varchar(5000) DEFAULT NULL,
  `intership_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `intership_flg` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `interships`
--

INSERT INTO `interships` (`intership_id`, `intership_organization`, `intership_attachment`, `intership_major`, `intership_availability`, `intership_paid`, `intership_university`, `intership_description`, `intership_stamp`, `intership_flg`) VALUES
(2, 3, 6, 12, 2, 'paid', NULL, NULL, '2021-11-08 07:18:14', 1),
(3, 3, 8, 14, 11, 'paid', 2, 'If well archived we can hire for a long term employment Job', '2021-11-08 07:29:45', 1),
(4, 3, 5, 3, 9, 'none-paid', 3, NULL, '2021-11-08 07:30:16', 1),
(5, 3, 5, 3, 11, 'paid', 1, 'Expert in Web and mobile App development', '2021-11-08 07:43:11', 0),
(6, 2, 4, 13, 10, 'paid', 3, 'More', '2021-11-09 16:59:16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `login_id` bigint(20) NOT NULL,
  `login_email` varchar(50) NOT NULL,
  `login_account` bigint(20) NOT NULL,
  `login_type` varchar(20) NOT NULL,
  `login_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `login_flg` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`login_id`, `login_email`, `login_account`, `login_type`, `login_stamp`, `login_flg`) VALUES
(1, '16j01acs012@anu.ac.ke', 1, 'student', '2021-11-01 19:19:55', 1),
(2, '19j01acs015@anu.ac.ke', 2, 'student', '2021-11-02 13:02:37', 1),
(3, '19s01acs03@anu.ac.ke', 3, 'student', '2021-11-05 16:13:11', 1),
(4, 'stamina@spu.ac.ke', 4, 'student', '2021-11-05 17:27:52', 1),
(5, '14s03adit005@anu.ac.ke', 5, 'student', '2021-11-05 17:33:54', 1),
(6, '17j01acs@anu.ac.ke', 6, 'student', '2021-11-05 17:36:23', 1),
(7, 'alphaguru@kemu.ac.ke', 7, 'student', '2021-11-05 17:50:41', 1),
(8, '20allan@spu.ac.ke', 8, 'student', '2021-11-07 11:19:55', 1),
(10, 'info@eabl.com', 2, 'company', '2021-11-07 16:24:50', 1),
(11, 'info@safaricom.co.ke', 3, 'company', '2021-11-07 16:46:21', 1),
(12, 'info@kcbgroup.com', 4, 'company', '2021-11-07 16:47:48', 1),
(13, '13s01acs02@anu.ac.ke', 9, 'student', '2021-11-09 14:49:09', 1),
(14, 'alfred@anu.ac.ke', 10, 'student', '2021-11-09 19:56:55', 1),
(15, 'endwin@anu.ac.ke', 11, 'student', '2021-11-18 08:45:08', 1),
(16, 'michael@anu.ac.ke', 12, 'student', '2021-11-18 08:49:23', 1),
(17, 'info@smartwebkenya.com', 5, 'company', '2021-11-18 08:51:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `option_id` bigint(20) NOT NULL,
  `option_type` varchar(80) NOT NULL,
  `option_parent` bigint(20) NOT NULL,
  `option_title` varchar(80) NOT NULL,
  `option_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `option_flg` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`option_id`, `option_type`, `option_parent`, `option_title`, `option_stamp`, `option_flg`) VALUES
(1, 'attachment', 0, 'Technical', '2021-11-07 12:30:24', 1),
(2, 'availability', 0, 'January - May', '2021-11-07 12:30:24', 1),
(3, 'major', 0, 'IT', '2021-11-07 12:30:50', 1),
(4, 'attachment', 0, 'Medical', '2021-11-07 12:30:24', 1),
(5, 'attachment', 0, 'Programming', '2021-11-07 12:30:24', 1),
(6, 'attachment', 0, 'Design', '2021-11-07 12:30:24', 1),
(7, 'attachment', 0, 'Support', '2021-11-07 12:30:24', 1),
(8, 'attachment', 0, 'Hospitality', '2021-11-07 12:30:24', 1),
(9, 'availability', 0, 'May - July', '2021-11-07 12:30:24', 1),
(10, 'availability', 0, 'July - September', '2021-11-07 12:30:24', 1),
(11, 'availability', 0, 'October - December', '2021-11-07 12:30:24', 1),
(12, 'major', 0, 'Business', '2021-11-07 12:30:50', 1),
(13, 'major', 0, 'MassComm', '2021-11-07 12:30:50', 1),
(14, 'major', 0, 'Public Relation', '2021-11-07 12:30:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `organization_id` bigint(20) NOT NULL,
  `organization_name` varchar(80) NOT NULL,
  `organization_website` varchar(100) NOT NULL,
  `organization_toplevel` varchar(50) NOT NULL,
  `organization_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `organization_flg` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`organization_id`, `organization_name`, `organization_website`, `organization_toplevel`, `organization_stamp`, `organization_flg`) VALUES
(1, 'Safaricom', 'www.safaricom.co.ke', 'safaricom.co.ke', '2021-11-07 16:05:22', 1),
(2, 'East African Breweries', 'www.eabl.com', 'eabl.com', '2021-11-07 16:10:06', 1),
(3, 'KCB Bank Kenya Limited', 'ke.kcbgroup.com', 'kcbgroup.com', '2021-11-07 16:10:06', 1),
(4, 'Smart Web Kenya Limited', 'www.smartwebkenya.com', 'smartwebkenya.com', '2021-11-07 16:10:06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` bigint(20) NOT NULL,
  `rating_application` bigint(20) NOT NULL,
  `rating_student` bigint(20) NOT NULL,
  `rating_score` int(11) NOT NULL DEFAULT '0',
  `rating_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rating_flg` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rating_id`, `rating_application`, `rating_student`, `rating_score`, `rating_stamp`, `rating_flg`) VALUES
(1, 5, 6, 10, '2021-11-29 04:23:31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` bigint(20) NOT NULL,
  `student_first_name` varchar(20) NOT NULL,
  `student_last_name` varchar(20) NOT NULL,
  `student_email` varchar(50) NOT NULL,
  `student_phone_number` varchar(12) DEFAULT NULL,
  `student_personal_email` varchar(30) DEFAULT NULL,
  `student_university` bigint(20) NOT NULL,
  `student_password` varchar(200) NOT NULL,
  `student_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `student_flg` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_first_name`, `student_last_name`, `student_email`, `student_phone_number`, `student_personal_email`, `student_university`, `student_password`, `student_stamp`, `student_flg`) VALUES
(1, 'Joshua', 'Minga', '16j01acs012@anu.ac.ke', '7085496611', 'fastemail47@gmail.com', 1, '7d38307ef52e802145060851c5225f7e02dd9581', '2021-11-01 19:19:55', 1),
(2, 'Fabian', 'Alex', '19j01acs015@anu.ac.ke', '', NULL, 1, '644850cb8939d255ed752957b7c4458c52900f75', '2021-11-02 13:02:37', 1),
(3, 'Onyango', 'Maina', '19s01acs03@anu.ac.ke', '', NULL, 1, '7d38307ef52e802145060851c5225f7e02dd9581', '2021-11-05 16:13:11', 1),
(4, 'Stamina', 'Rayoal', 'stamina@spu.ac.ke', '', NULL, 2, '7d38307ef52e802145060851c5225f7e02dd9581', '2021-11-05 17:27:52', 1),
(5, 'Dennis', 'Shiraho', '14s03adit005@anu.ac.ke', '', NULL, 1, '7d38307ef52e802145060851c5225f7e02dd9581', '2021-11-05 17:33:54', 1),
(6, 'Brain', 'Obebo', '17j01acs@anu.ac.ke', '', NULL, 1, '7d38307ef52e802145060851c5225f7e02dd9581', '2021-11-05 17:36:23', 1),
(7, 'Alpha', 'Guru', 'alphaguru@kemu.ac.ke', '', NULL, 3, '7d38307ef52e802145060851c5225f7e02dd9581', '2021-11-05 17:50:41', 1),
(8, 'Allan', 'Mukami', '20allan@spu.ac.ke', '', NULL, 2, '7d38307ef52e802145060851c5225f7e02dd9581', '2021-11-07 11:19:55', 1),
(9, 'Brian', 'Obebo', '13s01acs02@anu.ac.ke', '708229611', NULL, 1, '7d38307ef52e802145060851c5225f7e02dd9581', '2021-11-09 14:49:09', 1),
(10, 'Alfred', 'Mutua', 'alfred@anu.ac.ke', '', NULL, 1, '7d38307ef52e802145060851c5225f7e02dd9581', '2021-11-09 19:56:55', 1),
(11, 'Edwin', 'Michael', 'endwin@anu.ac.ke', '706119022', NULL, 1, '7d38307ef52e802145060851c5225f7e02dd9581', '2021-11-18 08:45:08', 1),
(12, 'Michael', 'Mbinga', 'michael@anu.ac.ke', '', 'mbinga@gmail.com', 1, '7d38307ef52e802145060851c5225f7e02dd9581', '2021-11-18 08:49:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `universities`
--

CREATE TABLE `universities` (
  `university_id` bigint(20) NOT NULL,
  `university_name` varchar(80) NOT NULL,
  `university_website` varchar(100) NOT NULL,
  `university_toplevel` varchar(20) DEFAULT NULL,
  `university_stamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `university_flg` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `universities`
--

INSERT INTO `universities` (`university_id`, `university_name`, `university_website`, `university_toplevel`, `university_stamp`, `university_flg`) VALUES
(1, 'Africa Nazarene University', 'www.anu.ac.ke', 'anu.ac.ke', '2021-11-07 12:35:58', 1),
(2, 'St Pauls University', 'www.spu.ac.ke', 'spu.ac.ke', '2021-11-07 12:38:45', 1),
(3, 'Kenya Methodist University', 'www.kemu.ac.ke', 'kemu.ac.ke', '2021-11-07 12:41:07', 1),
(4, 'University Of naironi', 'www.uon.ac.ke', 'uon.ac.ke', '2021-11-07 12:41:07', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `curriculums`
--
ALTER TABLE `curriculums`
  ADD PRIMARY KEY (`curriculum_id`);

--
-- Indexes for table `interships`
--
ALTER TABLE `interships`
  ADD PRIMARY KEY (`intership_id`);

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`organization_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `universities`
--
ALTER TABLE `universities`
  ADD PRIMARY KEY (`university_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `application_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `company_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `curriculums`
--
ALTER TABLE `curriculums`
  MODIFY `curriculum_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `interships`
--
ALTER TABLE `interships`
  MODIFY `intership_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `login_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `option_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `organization_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `universities`
--
ALTER TABLE `universities`
  MODIFY `university_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
