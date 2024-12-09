-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 08, 2024 at 03:25 AM
-- Server version: 5.7.24
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tradesflow`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `ClientID` varchar(12) NOT NULL,
  `FirstName` varchar(12) DEFAULT NULL,
  `LastName` varchar(12) DEFAULT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Address` varchar(25) DEFAULT NULL,
  `City` varchar(12) DEFAULT NULL,
  `ZipCode` varchar(12) DEFAULT NULL,
  `Province` varchar(20) DEFAULT NULL,
  `Country` varchar(12) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Gender` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`ClientID`, `FirstName`, `LastName`, `PhoneNumber`, `Email`, `Address`, `City`, `ZipCode`, `Province`, `Country`, `DateOfBirth`, `Gender`) VALUES
('C001', 'Markus', 'Blessing', '604-767-2934', 'markusblessing2003@icloud.com', '13151 240 St', 'Maple Ridge', 'V4R 0A5', 'B.C.', 'Canada', '2003-12-10', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `crew`
--

CREATE TABLE `crew` (
  `crewID` varchar(10) NOT NULL,
  `specialty` varchar(50) DEFAULT NULL,
  `crewSize` int(11) DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `crew`
--

INSERT INTO `crew` (`crewID`, `specialty`, `crewSize`, `cost`) VALUES
('CrewA1', 'Electrician', 4, '9000.00'),
('CrewB2', 'Framer', 3, '800.00'),
('CrewC1', 'Drywall', 3, '250.00');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `JobID` varchar(10) NOT NULL,
  `JobStage` varchar(10) DEFAULT NULL,
  `JobStageDescription` varchar(50) DEFAULT NULL,
  `JobType` varchar(30) DEFAULT NULL,
  `JobSite` varchar(30) DEFAULT NULL,
  `CrewID` varchar(10) DEFAULT NULL,
  `HoursNeeded` int(11) DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `CompletionDate` date DEFAULT NULL,
  `DueDate` date DEFAULT NULL,
  `Cost` int(11) DEFAULT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `ClientID` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`JobID`, `JobStage`, `JobStageDescription`, `JobType`, `JobSite`, `CrewID`, `HoursNeeded`, `StartDate`, `CompletionDate`, `DueDate`, `Cost`, `Address`, `ClientID`) VALUES
('J001', 'D', 'Electrical', 'Building New Home', 'New Home', 'CrewA1', 40, '2024-12-01', '2024-12-31', '2024-12-30', 5000, '13151 240 St', 'C001'),
('J003', 'B', 'Electric', 'Building New Home ', 'New Home', 'CrewB2', 33, '2024-12-03', '2025-01-10', '2024-12-30', 11, '22529 Lougheed Hwy', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `JobID` varchar(10) NOT NULL,
  `CurrentWeek` date DEFAULT NULL,
  `Sunday` varchar(12) DEFAULT NULL,
  `Monday` varchar(12) DEFAULT NULL,
  `Tuesday` varchar(12) DEFAULT NULL,
  `Wednesday` varchar(12) DEFAULT NULL,
  `Thursday` varchar(12) DEFAULT NULL,
  `Friday` varchar(12) DEFAULT NULL,
  `Saturday` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`JobID`, `CurrentWeek`, `Sunday`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`) VALUES
('J001', '2024-12-01', 'CrewA1', 'CrewA1', 'CrewA2', 'CrewB1', 'CrewB1', 'CrewC1', 'CrewC2');

-- --------------------------------------------------------

--
-- Table structure for table `worker`
--

CREATE TABLE `worker` (
  `WorkerID` varchar(10) NOT NULL,
  `FirstName` varchar(12) DEFAULT NULL,
  `LastName` varchar(12) DEFAULT NULL,
  `Specialty` varchar(15) DEFAULT NULL,
  `CrewID` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `worker`
--

INSERT INTO `worker` (`WorkerID`, `FirstName`, `LastName`, `Specialty`, `CrewID`) VALUES
('W001', 'Markus', 'Blessing', 'Electrical', 'CrewA1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`ClientID`);

--
-- Indexes for table `crew`
--
ALTER TABLE `crew`
  ADD PRIMARY KEY (`crewID`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`JobID`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`JobID`);

--
-- Indexes for table `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`WorkerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- Simple Jobs
CREATE VIEW simple_jobs AS
SELECT JobID, JobStage, StartDate, CompletionDate, DueDate, Cost, Address
FROM jobs;

-- Crews and Members
CREATE VIEW crew_members AS
SELECT 
    c.CrewID, 
    c.Specialty AS CrewSpecialty, 
    c.CrewSize, 
    c.Cost AS CrewCost,
    w.WorkerID, 
    w.FirstName AS WorkerFirstName, 
    w.LastName AS WorkerLastName
FROM crews c
LEFT JOIN workers w ON c.CrewID = w.CrewID;

-- Schedule for Clients. When used, can filter by clientID
CREATE VIEW client_schedule AS
SELECT j.JobID, j.JobSite, j.JobStage, s.CurrentWeek, 
       s.Sunday, s.Monday, s.Tuesday, s.Wednesday, 
       s.Thursday, s.Friday, s.Saturday, j.ClientID
FROM jobs j
JOIN schedule s ON j.JobID = s.JobID;

-- Schedule for crews and workers. When used, can filter by crewID 
CREATE VIEW crew_schedule AS
SELECT j.JobID, j.JobSite, j.JobStage, w.FirstName AS WorkerFirstName,
       w.LastName AS WorkerLastName, c.Specialty AS CrewSpecialty, s.CurrentWeek,
       s.Sunday, s.Monday, s.Tuesday, s.Wednesday, s.Thursday, s.Friday, s.Saturday
FROM jobs j
JOIN workers w ON j.CrewID = w.CrewID
JOIN crews c ON w.CrewID = c.CrewID
JOIN schedule s ON j.JobID = s.JobID;