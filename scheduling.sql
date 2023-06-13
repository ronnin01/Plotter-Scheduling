-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2023 at 01:59 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scheduling`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL,
  `dept_code` varchar(100) NOT NULL,
  `dept_title` varchar(100) NOT NULL,
  `dept_designation` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_code`, `dept_title`, `dept_designation`) VALUES
(3, 'COT', 'College of Technology', 'Dean, College of Technology');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `room_department` varchar(100) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `room_building` varchar(100) NOT NULL,
  `room_capacity` int(11) NOT NULL,
  `room_room_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_department`, `room_name`, `room_building`, `room_capacity`, `room_room_type`) VALUES
(1, 'COT', 'Rm. 204', 'COT Building', 40, 'Air Conditioned');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(11) NOT NULL,
  `schedule_department` varchar(100) NOT NULL,
  `schedule_semester` varchar(100) NOT NULL,
  `schedule_school_year` varchar(100) NOT NULL,
  `schedule_room` varchar(100) NOT NULL,
  `schedule_section` varchar(100) NOT NULL,
  `schedule_week_day` varchar(100) NOT NULL,
  `schedule_teacher` varchar(100) NOT NULL,
  `schedule_subject` varchar(100) NOT NULL,
  `schedule_start_time` time NOT NULL,
  `schedule_end_time` time NOT NULL,
  `schedule_rowspan` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `schedule_department`, `schedule_semester`, `schedule_school_year`, `schedule_room`, `schedule_section`, `schedule_week_day`, `schedule_teacher`, `schedule_subject`, `schedule_start_time`, `schedule_end_time`, `schedule_rowspan`) VALUES
(5, 'COT', '2nd Semester', '2023-2024', 'Rm. 204', 'BSIT 1A Day', 'Monday', 'Mila Jean Cerenio Fulgar', '2', '07:00:00', '09:00:00', 4),
(8, 'COT', '2nd Semester', '2023-2024', 'Rm. 204', 'BSIT 1A Day', 'Monday', 'Mila Jean Cerenio Fulgar', '2', '09:00:00', '12:00:00', 6),
(9, 'COT', '1st Semester', '2023-2024', 'Rm. 204', 'BSIT 1A Day', 'Monday', 'Mila Jean Cerenio Fulgar', '2', '09:00:00', '12:00:00', 6),
(12, 'COT', '2nd Semester', '2023-2024', 'Rm. 204', 'BSIT 1A Day', 'Tuesday', 'Glenard Jay D. Sarmiento', '3', '07:00:00', '12:00:00', 10),
(14, 'COT', '2nd Semester', '2023-2024', 'Rm. 204', 'BSIT 1A Day', 'Monday', 'Glenard Jay D. Sarmiento', '3', '13:00:00', '15:30:00', 5),
(16, 'COT', '2nd Semester', '2023-2024', 'Rm. 204', 'BSIT 1A Day', 'Wednesday', 'Glenard Jay D. Sarmiento', '3', '13:00:00', '16:00:00', 6),
(17, 'COT', '2nd Semester', '2023-2024', 'Rm. 204', 'BSIT 1A Day', 'Wednesday', 'Mila Jean Cerenio Fulgar', '2', '07:00:00', '12:00:00', 10),
(18, 'COT', '2nd Semester', '2023-2024', 'Rm. 204', 'BSIT 1A Day', 'Thursday', 'Glenard Jay D. Sarmiento', '3', '07:00:00', '10:00:00', 6),
(19, 'COT', '2nd Semester', '2023-2024', 'Rm. 204', 'BSIT 1A Night', 'Monday', 'Glenard Jay D. Sarmiento', '3', '17:30:00', '21:30:00', 8);

-- --------------------------------------------------------

--
-- Table structure for table `school_a_y`
--

CREATE TABLE `school_a_y` (
  `ay_id` int(10) NOT NULL,
  `ay_year` varchar(100) DEFAULT NULL,
  `ay_semester` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `school_a_y`
--

INSERT INTO `school_a_y` (`ay_id`, `ay_year`, `ay_semester`) VALUES
(1, '2023-2024', '2nd Semester');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `section_id` int(11) NOT NULL,
  `section_name` varchar(100) NOT NULL,
  `section_program` varchar(100) NOT NULL,
  `section_department` varchar(100) NOT NULL,
  `section_major` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_id`, `section_name`, `section_program`, `section_department`, `section_major`) VALUES
(1, 'BSIT 1A', 'Day', 'COT', 'Information Technology'),
(2, 'BSIT 1A', 'Night', 'COT', 'Information Technology');

-- --------------------------------------------------------

--
-- Table structure for table `section_detail`
--

CREATE TABLE `section_detail` (
  `section_detail_id` int(11) NOT NULL,
  `section_detail_section_id` int(11) NOT NULL,
  `section_detail_semester` varchar(100) NOT NULL,
  `section_detail_school_year` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `section_detail`
--

INSERT INTO `section_detail` (`section_detail_id`, `section_detail_section_id`, `section_detail_semester`, `section_detail_school_year`) VALUES
(1, 1, '2nd Semester', '2023-2024'),
(2, 1, '1st Semester', '2023-2024'),
(3, 2, '2nd Semester', '2023-2024');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  `subject_title` varchar(100) NOT NULL,
  `subject_unit` int(100) NOT NULL,
  `subject_lecture_hour` int(100) NOT NULL,
  `subject_laboratory_hour` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `subject_name`, `subject_title`, `subject_unit`, `subject_lecture_hour`, `subject_laboratory_hour`) VALUES
(2, 'Tech 326', 'Computer Programming', 15, 5, 10),
(3, 'Comp 1', 'Basic Computer', 3, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `subject_detail`
--

CREATE TABLE `subject_detail` (
  `subject_detail_id` int(11) NOT NULL,
  `subject_detail_department` varchar(100) NOT NULL,
  `subject_detail_semester` varchar(100) NOT NULL,
  `subject_detail_school_year` varchar(100) NOT NULL,
  `subject_detail_teacher_fullname` varchar(100) NOT NULL,
  `subject_detail_subject_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject_detail`
--

INSERT INTO `subject_detail` (`subject_detail_id`, `subject_detail_department`, `subject_detail_semester`, `subject_detail_school_year`, `subject_detail_teacher_fullname`, `subject_detail_subject_id`) VALUES
(4, 'COT', '2nd Semester', '2023-2024', 'Mila Jean Cerenio Fulgar', 2),
(5, 'COT', '1st Semester', '2023-2024', 'Mila Jean Cerenio Fulgar', 2),
(6, 'COT', '2nd Semester', '2023-2024', 'Glenard Jay D. Sarmiento', 3);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int(11) NOT NULL,
  `teacher_id_number` int(100) NOT NULL,
  `teacher_firstname` varchar(100) NOT NULL,
  `teacher_lastname` varchar(100) NOT NULL,
  `teacher_middlename` varchar(100) NOT NULL,
  `teacher_bachelor` varchar(100) NOT NULL,
  `teacher_master` varchar(100) NOT NULL,
  `teacher_doctor` varchar(100) NOT NULL,
  `teacher_special` varchar(100) NOT NULL,
  `teacher_major` varchar(100) NOT NULL,
  `teacher_minor` varchar(100) NOT NULL,
  `teacher_designation` varchar(100) NOT NULL,
  `teacher_status` varchar(100) NOT NULL,
  `teacher_research` varchar(100) NOT NULL,
  `teacher_production` varchar(100) NOT NULL,
  `teacher_extension` varchar(100) NOT NULL,
  `teacher_others` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `teacher_id_number`, `teacher_firstname`, `teacher_lastname`, `teacher_middlename`, `teacher_bachelor`, `teacher_master`, `teacher_doctor`, `teacher_special`, `teacher_major`, `teacher_minor`, `teacher_designation`, `teacher_status`, `teacher_research`, `teacher_production`, `teacher_extension`, `teacher_others`) VALUES
(2, 123456, 'Aaron', 'Fulgar', 'Jimenez', 'None', 'None', 'None', 'None', 'None', 'None', 'None', 'Part-time', 'None', 'None', 'None', 'None'),
(3, 3190423, 'Mila Jean', 'Fulgar', 'Cerenio', 'None', 'None', 'None', 'None', 'None', 'None', 'None', 'Organic', 'None', 'None', 'None', 'None'),
(4, 31067, 'Glenard Jay', 'Sarmiento', 'D.', 'B.S. Info Tech', 'MSIT', 'None', 'Programming', 'Programming', 'None', 'Instructor', 'Part-time', 'None', 'None', 'None', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_detail`
--

CREATE TABLE `teacher_detail` (
  `teacher_detail_id` int(11) NOT NULL,
  `teacher_fullname` varchar(100) NOT NULL,
  `teacher_department` varchar(100) NOT NULL,
  `teacher_semester` varchar(100) NOT NULL,
  `teacher_school_year` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher_detail`
--

INSERT INTO `teacher_detail` (`teacher_detail_id`, `teacher_fullname`, `teacher_department`, `teacher_semester`, `teacher_school_year`) VALUES
(7, 'Glenard Jay D. Sarmiento', 'COT', '2nd Semester', '2023-2024'),
(8, 'Aaron Jimenez Fulgar', 'COT', '2nd Semester', '2023-2024'),
(9, 'Mila Jean Cerenio Fulgar', 'COT', '2nd Semester', '2023-2024'),
(11, 'Mila Jean Cerenio Fulgar', 'COT', '1st Semester', '2023-2024'),
(12, 'Glenard Jay D. Sarmiento', 'COT', '1st Semester', '2023-2024'),
(13, 'Aaron Jimenez Fulgar', '', '', ''),
(14, 'Mila Jean Cerenio Fulgar', '', '', ''),
(15, 'Glenard Jay D. Sarmiento', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_username` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_fullname` varchar(100) NOT NULL,
  `user_contact` int(100) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `user_address` varchar(100) NOT NULL,
  `user_id_number` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_username`, `user_password`, `user_fullname`, `user_contact`, `user_type`, `user_address`, `user_id_number`) VALUES
(3, 'admin', 'admin', 'admin', 1, 'Admin', 'None', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `school_a_y`
--
ALTER TABLE `school_a_y`
  ADD PRIMARY KEY (`ay_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `section_detail`
--
ALTER TABLE `section_detail`
  ADD PRIMARY KEY (`section_detail_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `subject_detail`
--
ALTER TABLE `subject_detail`
  ADD PRIMARY KEY (`subject_detail_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `teacher_detail`
--
ALTER TABLE `teacher_detail`
  ADD PRIMARY KEY (`teacher_detail_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `school_a_y`
--
ALTER TABLE `school_a_y`
  MODIFY `ay_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `section_detail`
--
ALTER TABLE `section_detail`
  MODIFY `section_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subject_detail`
--
ALTER TABLE `subject_detail`
  MODIFY `subject_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teacher_detail`
--
ALTER TABLE `teacher_detail`
  MODIFY `teacher_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
