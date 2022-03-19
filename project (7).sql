-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2022 at 04:19 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(20) NOT NULL,
  `apnt_no` int(20) NOT NULL,
  `apnt_date` date NOT NULL,
  `apnt_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `apnt_no`, `apnt_date`, `apnt_time`) VALUES
(14, 60, '2022-04-01', '23:22:00');

--
-- Triggers `appointment`
--
DELIMITER $$
CREATE TRIGGER `validate_ts` BEFORE INSERT ON `appointment` FOR EACH ROW BEGIN
        IF EXISTS(SELECT * FROM appointment WHERE apnt_date=NEW.apnt_date AND apnt_time=NEW.apnt_time)
        THEN 
            signal SQLSTATE '45000' SET message_text = "Appointment already present for this slot";
        END IF;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `has`
--

CREATE TABLE `has` (
  `mno` varchar(20) NOT NULL,
  `pno` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `has`
--

INSERT INTO `has` (`mno`, `pno`) VALUES
('Tramadol200', 149);

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `mno` varchar(20) NOT NULL,
  `mname` varchar(20) NOT NULL,
  `used_for` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`mno`, `mname`, `used_for`) VALUES
('ALERID10', 'ALERID', 'Eyepain'),
('Amlodipin100', 'Amlodipin', 'Blood pressure'),
('Br100', 'Borox', 'Ear pain'),
('Cipla101', 'Cipla', 'leg pain'),
('DOLO650', 'DOLO 650', 'FEVER'),
('Metformin100', 'Metformin', 'Diabetes'),
('Radix555', 'Radix', 'Headache'),
('Tramadol200', 'Tramadol', 'Body Pain');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `sex` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `location` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `name`, `sex`, `phone`, `location`, `dob`, `password`) VALUES
(1, 'admin', '', '', '', '0000-00-00', 'Admin@123'),
(13, 'madhur', 'm', '8217350256', 'mangalore', '2001-01-04', 'M@dhur123'),
(14, 'hitha', 'f', '8147330255', 'Bangalore', '1997-02-20', 'Hith@123');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `pno` int(20) NOT NULL,
  `id` int(20) NOT NULL,
  `dosage` varchar(20) NOT NULL,
  `start_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`pno`, `id`, `dosage`, `start_date`) VALUES
(149, 13, '1-0-0', '2022-04-02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`apnt_no`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `has`
--
ALTER TABLE `has`
  ADD KEY `mno` (`mno`),
  ADD KEY `pno` (`pno`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`mno`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`pno`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `apnt_no` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `pno` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`id`) REFERENCES `patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `has`
--
ALTER TABLE `has`
  ADD CONSTRAINT `has_ibfk_1` FOREIGN KEY (`mno`) REFERENCES `medicine` (`mno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `has_ibfk_2` FOREIGN KEY (`pno`) REFERENCES `prescription` (`pno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `prescription_ibfk_1` FOREIGN KEY (`id`) REFERENCES `patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
