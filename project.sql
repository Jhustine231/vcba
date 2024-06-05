-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2024 at 07:14 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `Username` varchar(200) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `Username`, `Email`, `Password`) VALUES
(1, 'Aiko Quijance', 'test1@gmail.com', '387e6278d8e06083d813358762e0ac63');

-- --------------------------------------------------------

--
-- Table structure for table `alarms`
--

CREATE TABLE `alarms` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `time_in` varchar(100) DEFAULT NULL,
  `time_out` varchar(100) DEFAULT NULL,
  `alarm_day` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alarms`
--

INSERT INTO `alarms` (`id`, `user_id`, `time_in`, `time_out`, `alarm_day`) VALUES
(1, 1, '08:00', NULL, 'Monday'),
(2, 1, NULL, '09:00', 'Monday'),
(3, 1, '09:01', NULL, 'Monday'),
(4, 1, NULL, '10:00', 'Monday'),
(6, 1, '10:01', NULL, 'Monday'),
(7, 1, NULL, '11:00', 'Monday'),
(8, 1, '11:01', NULL, 'Monday'),
(9, 1, NULL, '12:00', 'Monday'),
(10, 1, '08:00', NULL, 'Tuesday'),
(11, 1, '08:00', NULL, 'Wednesday'),
(12, 1, '08:00', NULL, 'Thursday'),
(13, 1, '08:00', NULL, 'Friday'),
(14, 1, '08:00', NULL, 'Saturday'),
(15, 1, NULL, '09:00', 'Tuesday'),
(16, 1, NULL, '09:00', 'Wednesday'),
(17, 1, NULL, '09:00', 'Thursday'),
(18, 1, NULL, '09:00', 'Friday'),
(19, 1, NULL, '09:00', 'Saturday'),
(20, 1, '09:01', NULL, 'Tuesday'),
(21, 1, '09:01', NULL, 'Wednesday'),
(22, 1, '09:01', NULL, 'Thursday'),
(23, 1, '09:01', NULL, 'Friday'),
(24, 1, '09:01', NULL, 'Saturday'),
(25, 1, NULL, '10:00', 'Tuesday'),
(26, 1, NULL, '10:00', 'Wednesday'),
(27, 1, NULL, '10:00', 'Thursday'),
(28, 1, NULL, '10:00', 'Friday'),
(29, 1, NULL, '10:00', 'Saturday'),
(30, 1, '10:01', NULL, 'Tuesday'),
(31, 1, '10:01', NULL, 'Wednesday'),
(32, 1, '10:01', NULL, 'Thursday'),
(33, 1, '10:01', NULL, 'Friday'),
(34, 1, '10:01', NULL, 'Saturday'),
(35, 1, '11:01', NULL, 'Tuesday'),
(36, 1, '11:01', NULL, 'Wednesday'),
(37, 1, '11:01', NULL, 'Thursday'),
(38, 1, '11:01', NULL, 'Friday'),
(39, 1, '11:01', NULL, 'Saturday'),
(40, 1, NULL, '11:00', 'Tuesday'),
(41, 1, NULL, '11:00', 'Wednesday'),
(42, 1, NULL, '11:00', 'Thursday'),
(43, 1, NULL, '11:00', 'Friday'),
(44, 1, NULL, '11:00', 'Saturday'),
(45, 1, NULL, '12:00', 'Tuesday'),
(46, 1, NULL, '12:00', 'Wednesday'),
(47, 1, NULL, '12:00', 'Thursday'),
(48, 1, NULL, '12:00', 'Friday'),
(49, 1, NULL, '12:00', 'Saturday');

-- --------------------------------------------------------

--
-- Table structure for table `bell_in`
--

CREATE TABLE `bell_in` (
  `ID` int(11) NOT NULL,
  `time_in` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bell_in`
--

INSERT INTO `bell_in` (`ID`, `time_in`) VALUES
(4, '7:00'),
(5, '9:00');

-- --------------------------------------------------------

--
-- Table structure for table `bell_out`
--

CREATE TABLE `bell_out` (
  `ID` int(11) NOT NULL,
  `time_out` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bell_out`
--

INSERT INTO `bell_out` (`ID`, `time_out`) VALUES
(1, '8:00'),
(2, '10:00');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `ID` int(11) NOT NULL,
  `Username` varchar(200) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`ID`, `Username`, `Email`, `Password`) VALUES
(1, 'Lea Lagdamen', 'test@gmail.com', '387e6278d8e06083d813358762e0ac63');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `message` varchar(300) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `name`, `email`, `message`, `time`) VALUES
(1, 'student', 'student@example.com', 'hi maam', '2024-05-31 08:27:26'),
(2, 'teacher', 'teacher@example.com', 'good morning!', '2024-05-31 08:27:37'),
(3, 'student', 'student@example.com', 'good morning po maam', '2024-05-31 08:30:24');

-- --------------------------------------------------------

--
-- Table structure for table `school_events`
--

CREATE TABLE `school_events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(500) NOT NULL,
  `event_date` varchar(500) NOT NULL,
  `event_details` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `school_events`
--

INSERT INTO `school_events` (`id`, `event_name`, `event_date`, `event_details`) VALUES
(2, 'Intramurals', 'May 6 - 10', 'Location is at  V-Court.'),
(3, 'PE Days', 'June 2-3', 'Day to celebrate the PE Days, to encourage sportsmanship.'),
(5, 'VCBA Days', 'May 6 - 10', 'Location is at  V-Court. Attendance is a must!'),
(6, 'Artech Day', 'November 16- 17', 'Celebration of BSIS and BACOM.'),
(9, 'Socialization Day', 'September 23', 'A day to socialize with schoolmates. Location Amandari Coves Resort');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `ID` int(11) NOT NULL,
  `Username` varchar(300) NOT NULL,
  `Email` varchar(300) NOT NULL,
  `Password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`ID`, `Username`, `Email`, `Password`) VALUES
(1, 'Jhustine Kurt Abe', 'abejeff1@gmail.com', '387e6278d8e06083d813358762e0ac63');

-- --------------------------------------------------------

--
-- Table structure for table `stud_sched`
--

CREATE TABLE `stud_sched` (
  `id` int(255) NOT NULL,
  `stud_name` varchar(255) NOT NULL,
  `stud_sub` varchar(255) NOT NULL,
  `time_in` varchar(255) NOT NULL,
  `time_out` varchar(255) NOT NULL,
  `stud_day` varchar(255) NOT NULL,
  `stud_grade` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stud_sched`
--

INSERT INTO `stud_sched` (`id`, `stud_name`, `stud_sub`, `time_in`, `time_out`, `stud_day`, `stud_grade`) VALUES
(1, 'Jhustine Kurt Abe', 'CC105', '9:00 AM', '10:00 AM', 'Monday - Wednesday', '');

-- --------------------------------------------------------

--
-- Table structure for table `teach_sched`
--

CREATE TABLE `teach_sched` (
  `id` int(255) NOT NULL,
  `teach_name` varchar(255) NOT NULL,
  `teach_sub` varchar(255) NOT NULL,
  `time_in` varchar(255) NOT NULL,
  `time_out` varchar(255) NOT NULL,
  `teach_day` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teach_sched`
--

INSERT INTO `teach_sched` (`id`, `teach_name`, `teach_sub`, `time_in`, `time_out`, `teach_day`) VALUES
(1, 'Lea Lagdamen', 'CC105', '9:00 AM', '10:00 AM', 'Monday - Wednesday');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `image` varchar(245) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_number` varchar(255) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `id_number`, `role`) VALUES
(1, 'Jhustine Kurt Abe', '$2y$10$j8wSRimqm0bs16pHc2tdGeOmaqpxxfb6bV6x1BZ4tKqADJPmVyLgy', 's111', 3),
(2, 'Lea Lagdamen', '$2y$10$tqdrrU2YKeZSKlafx0jn6OwwIycFLAStBmPqmxpcDdOIj46QREWLy', 'f111', 2),
(3, 'Aiko Quijance', '$2y$10$lNSMGIl13yveNtZeGq2LB.lRsZ19MosfBW.XphFwBIf/wmpe6DRBi', 'a111', 1),
(4, 'Red', '$2y$10$mJVb7u98/aIlgrzCr3L7NeNf7KqhlZh0047TW43nSkKVB5ks9mglS', 's222', 3),
(5, 'Blue', '$2y$10$/l50a9c8eMl8esAm18yeTO/QmSAqA3K.MHteduoyjwdcYWWo2u1ji', 'f222', 2),
(6, 'Green', '$2y$10$0rLqHAzt9ujpLJbsFwAN4.QQa8wIuof1z86RYaHUsAOOoZ/bmgBDy', 'a222', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `alarms`
--
ALTER TABLE `alarms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bell_in`
--
ALTER TABLE `bell_in`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `bell_out`
--
ALTER TABLE `bell_out`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_events`
--
ALTER TABLE `school_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `stud_sched`
--
ALTER TABLE `stud_sched`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teach_sched`
--
ALTER TABLE `teach_sched`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`,`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `alarms`
--
ALTER TABLE `alarms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `bell_in`
--
ALTER TABLE `bell_in`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bell_out`
--
ALTER TABLE `bell_out`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `school_events`
--
ALTER TABLE `school_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stud_sched`
--
ALTER TABLE `stud_sched`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teach_sched`
--
ALTER TABLE `teach_sched`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
