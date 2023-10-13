-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2023 at 09:47 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobseeker_vacancy`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_candidate`
--

CREATE TABLE `t_candidate` (
  `candidate_id` int(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `full_name` varchar(50) NOT NULL,
  `dob` varchar(25) NOT NULL,
  `pob` varchar(25) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `year_exp` varchar(3) NOT NULL,
  `last_salary` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_candidate`
--

INSERT INTO `t_candidate` (`candidate_id`, `email`, `phone_number`, `full_name`, `dob`, `pob`, `gender`, `year_exp`, `last_salary`) VALUES
(1, 'john.doe@example.com', '555-123-4567', 'John Doe', '1990-05-15', 'New York', 'M', '5', '60000'),
(2, 'jane.smith@example.com', '555-987-6543', 'Jane Smith', '1988-12-03', 'Los Angeles', 'F', '7', '75000'),
(3, 'mark.wilson@example.com', '555-456-7890', 'Mark Wilson', '1995-09-20', 'Chicago', 'M', '3', '55000'),
(4, 'susan.johnson@example.com', '555-222-3333', 'Susan Johnson', '1987-04-10', 'Houston', 'F', '10', '90000'),
(5, 'robert.miller@example.com', '555-777-8888', 'Robert Miller', '1992-07-30', 'Phoenix', 'M', '6', '68000'),
(6, 'lisa.brown@example.com', '555-444-5555', 'Lisa Brown', '1989-11-22', 'Philadelphia', 'F', '8', '82000'),
(7, 'michael.jones@example.com', '555-111-2222', 'Michael Jones', '1994-02-05', 'San Diego', 'M', '2', '50000'),
(8, 'emily.davis@example.com', '555-666-7777', 'Emily Davis', '1991-08-18', 'San Francisco', 'F', '4', '60000'),
(9, 'david.wilson@example.com', '555-333-4444', 'David Wilson', '1993-03-25', 'Denver', 'M', '9', '85000'),
(10, 'sarah.anderson@example.com', '555-888-9999', 'Sarah Anderson', '1986-06-12', 'Seattle', 'F', '11', '95000');

-- --------------------------------------------------------

--
-- Table structure for table `t_vacancy`
--

CREATE TABLE `t_vacancy` (
  `vacancy_id` int(12) NOT NULL,
  `vacancy_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_vacancy`
--

INSERT INTO `t_vacancy` (`vacancy_id`, `vacancy_name`) VALUES
(0, 'Software Engineer'),
(2, 'Web Developer'),
(3, 'Data Analyst'),
(4, 'Product Manager'),
(5, 'Network Administrator'),
(6, 'Graphic Designer'),
(7, 'Marketing Specialist'),
(8, 'Quality Assurance Tester'),
(9, 'UI/UX Designer'),
(10, 'Database Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `t_vacancy_apply`
--

CREATE TABLE `t_vacancy_apply` (
  `apply_id` int(12) NOT NULL,
  `vacancy_id` int(12) NOT NULL,
  `candidate_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_vacancy_apply`
--

INSERT INTO `t_vacancy_apply` (`apply_id`, `vacancy_id`, `candidate_id`) VALUES
(47203273, 5, 1),
(1553136480, 6, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_candidate`
--
ALTER TABLE `t_candidate`
  ADD PRIMARY KEY (`candidate_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Indexes for table `t_vacancy`
--
ALTER TABLE `t_vacancy`
  ADD PRIMARY KEY (`vacancy_id`);

--
-- Indexes for table `t_vacancy_apply`
--
ALTER TABLE `t_vacancy_apply`
  ADD PRIMARY KEY (`apply_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
