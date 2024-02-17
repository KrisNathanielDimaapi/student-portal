-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2024 at 07:13 AM
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
-- Database: `student_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `accountID` int(10) NOT NULL,
  `accFirstName` varchar(100) NOT NULL,
  `accLastName` varchar(100) NOT NULL,
  `accEmail` varchar(100) NOT NULL,
  `accPassword` varchar(20) NOT NULL,
  `accRole` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`accountID`, `accFirstName`, `accLastName`, `accEmail`, `accPassword`, `accRole`) VALUES
(100001, 'Benedict', 'Comia', 'bene@gmail.com', 'Kris@123', 'Teacher'),
(100002, 'Grant', 'Obiedo', 'grant@gmail.com', 'Grant_016', 'Student'),
(100003, 'Berlie', 'Garcia', 'berlie@gmail.com', 'Berlie_016', 'Student'),
(100004, 'Kris', 'Dimaapi', 'kris@gmail.com', 'Kris_016', 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(30) NOT NULL,
  `levelsection` varchar(200) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `levelsection`, `date_created`) VALUES
(1, 'Fourth-A', '0000-00-00 00:00:00'),
(12, 'Second-A', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(30) NOT NULL,
  `student_id` int(30) NOT NULL,
  `marks_percentage` varchar(5) NOT NULL,
  `class_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `result_items`
--

CREATE TABLE `result_items` (
  `id` int(30) NOT NULL,
  `result_id` int(30) NOT NULL,
  `subject_id` int(30) NOT NULL,
  `mark` float NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewID` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `instructor` varchar(255) NOT NULL,
  `review` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewID`, `email`, `subject`, `instructor`, `review`) VALUES
(7, 'dbarrassej@narod.ru', 'SCIENCE', 'MR. KRIS NATHANIEL DIMAAPI', 'MAANGAS SIYA '),
(8, 'dbarrassej@narod.ru', 'SCIENCE', 'MR. KRIS NATHANIEL DIMAAPI', 'MABAIT'),
(11, 'kndimaapi@gmail.com', 'Araling Panlipunan', 'hakdog', 'asdas'),
(12, 'asd', 'Math', 'asdas', 'mahirap'),
(13, 'asdas', 'Araling Panlipunan', 'asdas', 'asdasd'),
(14, 'asdas', 'Math', 'asdas', 'asdasd'),
(15, 'bene@gmail.com', 'Araling Panlipunan', 'asdsadsaddssagfdg', 'sagafdgdfgd');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(30) NOT NULL,
  `student_code` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `class_id` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_code`, `firstname`, `middlename`, `lastname`, `gender`, `address`, `class_id`, `date_created`) VALUES
(33, '123124', 'sad', 'sdfsdsdf', 'nathanielsdf', 'asd', 'San Pascual', 'Second-A', '2024-02-09 19:34:17'),
(34, '123124', 'sdfsdf', 'Gabrielsdfsdf', 'Dimaapi', 'asd', 'San Pascual', 'Fourth-B', '2024-02-09 19:54:19'),
(35, 'sdf234234', 'asdasd', 'Gabrielasd', 'asf', 'sd', 'sdfsd', 'Fourth-B', '2024-02-09 20:50:42'),
(36, '2141435', 'Nigga', 'asdfd', 'sdf', 'asd', 'asdsad', 'Fourth-C', '2024-02-09 21:34:14'),
(37, '2141435', 'Nigga', 'asdfd', 'sdf', 'asd', 'asdsad', 'Fourth-A', '2024-02-10 09:35:11');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(30) NOT NULL,
  `subject_code` varchar(50) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_code`, `subject`, `description`, `date_created`) VALUES
(1, '1102', 'Math', 'Math', '0000-00-00 00:00:00'),
(4, '1102', 'Science', ' Science', '0000-00-00 00:00:00'),
(5, '1108', 'Araling Panlipunan', 'Jose Rizal', '0000-00-00 00:00:00'),
(6, '', '', ' ', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(30) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `firstname`, `middlename`, `lastname`, `gender`, `address`, `contact`, `email`) VALUES
(4, 'asdasd', 'Gabriel', 'Dimaapi', 'Male', 'sdad', '09491278814', 'asdsa'),
(5, 'sdf', 'sdf', 'sdf', 'sdf', 'sadasdsad', 'sdf', 'asdfsdfs'),
(6, 'sda', 'sad', 'd', 'sad', 'asdasd', 'sad', 'asdas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`accountID`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result_items`
--
ALTER TABLE `result_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `accountID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100006;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `result_items`
--
ALTER TABLE `result_items`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
