-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2024 at 05:08 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school_portal`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `account_view`
-- (See below for the actual view)
--
CREATE TABLE `account_view` (
`name` varchar(255)
,`email` varchar(255)
,`role` varchar(7)
);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `user`, `password`) VALUES
(0, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `classID` int(11) NOT NULL,
  `level` varchar(20) DEFAULT NULL,
  `section` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`classID`, `level`, `section`) VALUES
(1, 'First', 'A'),
(2, 'First', 'B'),
(3, 'Second', 'A'),
(4, 'Second', 'B'),
(5, 'Third', 'A'),
(6, 'Third', 'B'),
(7, 'Fourth', 'A'),
(8, 'Fourth', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `gradeID` int(11) NOT NULL,
  `studentID` int(11) DEFAULT NULL,
  `teacherID` int(11) DEFAULT NULL,
  `subjectID` int(11) DEFAULT NULL,
  `studName` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `grade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`gradeID`, `studentID`, `teacherID`, `subjectID`, `studName`, `subject`, `grade`) VALUES
(5, 1, 1, 1, 'Jose Stockham', 'Filipino', 90),
(6, 2, 1, 1, 'Rozella Ostrosky', 'Filipino', 90),
(7, 3, 1, 1, 'Valentine Gillian', 'Filipino', 89),
(8, 4, 1, 1, 'Kati Rulapaugh', 'Filipino', 92),
(9, 5, 1, 1, 'Youlanda Schemmer', 'Filipino', 87),
(10, 1, 4, 2, 'Jose Stockham', 'Mathematics', 89),
(11, 2, 4, 2, 'Rozella Ostrosky', 'Mathematics', 87),
(12, 3, 4, 2, 'Valentine Gillian', 'Mathematics', 90),
(13, 4, 4, 2, 'Kati Rulapaugh', 'Mathematics', 90),
(14, 5, 4, 2, 'Youlanda Schemmer', 'Mathematics', 88),
(15, 1, 7, 3, 'Jose Stockham', 'Science and Technology', 91),
(16, 2, 7, 3, 'Rozella Ostrosky', 'Science and Technology', 91),
(17, 3, 7, 3, 'Valentine Gillian', 'Science and Technology', 89),
(18, 4, 7, 3, 'Kati Rulapaugh', 'Science and Technology', 89),
(19, 5, 7, 3, 'Youlanda Schemmer', 'Science and Technology', 96);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewID` int(11) NOT NULL,
  `subjectID` int(11) DEFAULT NULL,
  `studentID` int(11) DEFAULT NULL,
  `teacherID` int(11) DEFAULT NULL,
  `subject_name` varchar(100) DEFAULT NULL,
  `studentName` varchar(255) DEFAULT NULL,
  `teacherName` varchar(255) DEFAULT NULL,
  `evaluation` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `studentID` int(11) NOT NULL,
  `classID` int(11) DEFAULT NULL,
  `studentCode` varchar(50) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `contact` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `level_section` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`studentID`, `classID`, `studentCode`, `full_name`, `email`, `password`, `gender`, `contact`, `address`, `level_section`) VALUES
(1, 1, '10011', 'Jose Stockham', 'jose@yahoo.com', 'jose', 'Male', '212-675-8570', '128 Bransten Rd New York', 'FirstA'),
(2, 1, '93012', 'Rozella Ostrosky', 'rozella.ostrosky@ostrosky.com', 'rozella', 'Female', '805-832-6163', '17 Morena Blvd Camarillo Ventura', 'FirstA'),
(3, 2, '78204', 'Valentine Gillian', 'valentine_gillian@gmail.com', 'valentine', 'Female', '210-812-9597', '775 W 17th St San Antonio Bexar', 'FirstB'),
(4, 2, '67410', 'Kati Rulapaugh', 'kati.rulapaugh@hotmail.com', 'kati', 'Female', '785-463-7829', '6980 Dorsett Rd	Abilene Dickinson', 'FirstB'),
(5, 3, '97754', 'Youlanda Schemmer', 'youlanda@aol.com', 'youlanda', 'Female', '541-548-8197', '2881 Lewis Rd Prineville Crook', 'SecondA'),
(6, 3, '66204', 'Dyan Oldroyd', 'doldroyd@aol.com', 'doldroy', 'Male', '913-413-4604', '7219 Woodfield Rd Overland Park Johnson', 'SecondA'),
(7, 4, '99708', 'Roxane Campain', 'roxane@hotmail.com', 'roxane', 'Female', '907-231-4722', '1048 Main St Fairbanks Fairbanks North Star', 'SecondB'),
(8, 4, '33196', 'Lavera Perin', 'lperin@perin.org', 'lavera', 'Female', '305-606-7291', '678 3rd Ave Miami Miami-Dade', 'SecondB'),
(9, 5, '99712', 'Erick	Ferencz', 'erick.ferencz@aol.com', 'erick', 'Male', '907-741-1044', '20 S Babcock St	Fairbanks Fairbanks North Star', 'ThirdA'),
(10, 7, '55343', 'Fatima Saylors', 'fsaylors@saylors.org', 'fatima', 'Female', '952-768-2416', '2 Lighthouse Ave Hopkins Hennepin', 'FourthA');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subjectID` int(11) NOT NULL,
  `teacherID` int(11) DEFAULT NULL,
  `subjectCode` varchar(50) DEFAULT NULL,
  `subject_name` varchar(100) DEFAULT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subjectID`, `teacherID`, `subjectCode`, `subject_name`, `description`) VALUES
(1, 1, 'Fili 101', 'Filipino', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'),
(2, 2, 'Math 101', 'Mathematics', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'),
(3, 3, 'Science 101', 'Science and Technology', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'),
(4, 4, 'Eng101', 'English', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'),
(5, 5, 'AP 101', 'Araling Panlipunan', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'),
(6, 6, 'Com 101', 'Computer', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'),
(7, 7, 'TLE 101', 'Technology and Livelihood Education', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacherID` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacherID`, `full_name`, `email`, `password`, `gender`, `address`, `contact`) VALUES
(1, 'Demi Chavez', 'demichavez@gmail.com', 'demichavez', 'Female', 'Makati City, Metro Manila,', '504-845-1427'),
(2, 'James Butt\r\n', 'jbutt@gmail.com', '123456\r\n', 'Male', '4 B Blue Ridge Blvd', '810-292-9388'),
(3, 'Donette Foller\r\n', 'donette.foller@cox.net', '123456', 'Female', '34 Center St Hamilton Butler\r\n', '513-549-4561'),
(4, 'Mattie Poquette', 'mattie@aol.com', '123456', 'Female', '73 State Road 434 E Phoenix Maricopa', '602-277-4385'),
(5, 'Fletcher Flosi', 'fletcher.flosi@yahoo.com', '123456', 'Female', '394 Manchester Blvd Rockford Winnebago\r\n', '815-828-2147'),
(6, 'Maryann Royster', 'mroyster@royster.com', '123456', 'Female', '74 S Westgate St Albany Albany', '518-966-7987'),
(7, 'Ezekiel	Chui', 'ezekiel@chui.com', '123456\r\n', 'Male', '2 Cedar Ave #84 Easton Talbot', '410-669-1642');

-- --------------------------------------------------------

--
-- Structure for view `account_view`
--
DROP TABLE IF EXISTS `account_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `account_view`  AS   (select `students`.`full_name` AS `name`,`students`.`email` AS `email`,'Student' AS `role` from `students`) union (select `teachers`.`full_name` AS `name`,`teachers`.`email` AS `email`,'Teacher' AS `role` from `teachers`)  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`classID`),
  ADD KEY `idx_classID` (`classID`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`gradeID`),
  ADD KEY `teacherID` (`teacherID`),
  ADD KEY `studentID` (`studentID`),
  ADD KEY `subjectID` (`subjectID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewID`),
  ADD KEY `teacherID` (`teacherID`),
  ADD KEY `studentID` (`studentID`),
  ADD KEY `subjectID` (`subjectID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`studentID`),
  ADD UNIQUE KEY `student_email` (`email`),
  ADD KEY `classID` (`classID`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subjectID`),
  ADD KEY `teacherID` (`teacherID`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacherID`),
  ADD UNIQUE KEY `teacherEmail` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `classID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `gradeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacherID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_4` FOREIGN KEY (`teacherID`) REFERENCES `teachers` (`teacherID`) ON DELETE CASCADE,
  ADD CONSTRAINT `grades_ibfk_5` FOREIGN KEY (`studentID`) REFERENCES `students` (`studentID`) ON DELETE CASCADE,
  ADD CONSTRAINT `grades_ibfk_6` FOREIGN KEY (`subjectID`) REFERENCES `subjects` (`subjectID`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_4` FOREIGN KEY (`teacherID`) REFERENCES `teachers` (`teacherID`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_5` FOREIGN KEY (`studentID`) REFERENCES `students` (`studentID`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_6` FOREIGN KEY (`subjectID`) REFERENCES `subjects` (`subjectID`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`classID`) REFERENCES `classes` (`classID`);

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_2` FOREIGN KEY (`teacherID`) REFERENCES `teachers` (`teacherID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
