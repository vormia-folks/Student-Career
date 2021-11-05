-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 05, 2021 at 05:54 PM
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
(4, 'stamina@stpaul.ac.ke', 4, 'student', '2021-11-05 17:27:52', 1),
(5, '14s03adit005@anu.ac.ke', 5, 'student', '2021-11-05 17:33:54', 1),
(6, '17j01acs@anu.ac.ke', 6, 'student', '2021-11-05 17:36:23', 1),
(7, 'alphaguru@guruz.ac.ke', 7, 'student', '2021-11-05 17:50:41', 1);

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
  `student_password` varchar(200) NOT NULL,
  `student_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `student_flg` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_first_name`, `student_last_name`, `student_email`, `student_phone_number`, `student_personal_email`, `student_password`, `student_stamp`, `student_flg`) VALUES
(1, 'Joshua', 'Minga', '16j01acs012@anu.ac.ke', '7085496611', 'fastemail47@gmail.com', '7d38307ef52e802145060851c5225f7e02dd9581', '2021-11-01 19:19:55', 1),
(2, 'Fabian', 'Alex', '19j01acs015@anu.ac.ke', '', NULL, '644850cb8939d255ed752957b7c4458c52900f75', '2021-11-02 13:02:37', 1),
(3, 'Ony\'ango ', '<br /> Maina', '19s01acs03@anu.ac.ke', '', NULL, '7d38307ef52e802145060851c5225f7e02dd9581', '2021-11-05 16:13:11', 1),
(4, 'Stamina', 'Rayoal', 'stamina@stpaul.ac.ke', '', NULL, '7d38307ef52e802145060851c5225f7e02dd9581', '2021-11-05 17:27:52', 1),
(5, 'Dennis', 'Shiraho', '14s03adit005@anu.ac.ke', '', NULL, '7d38307ef52e802145060851c5225f7e02dd9581', '2021-11-05 17:33:54', 1),
(6, 'Brain', 'Obebo', '17j01acs@anu.ac.ke', '', NULL, '7d38307ef52e802145060851c5225f7e02dd9581', '2021-11-05 17:36:23', 1),
(7, 'Alpha', 'Guru', 'alphaguru@guruz.ac.ke', '', NULL, '7d38307ef52e802145060851c5225f7e02dd9581', '2021-11-05 17:50:41', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `login_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
