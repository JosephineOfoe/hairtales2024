DROP DATABASE IF EXISTS hairtales;
CREATE DATABASE hairtales;
USE hairtales;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 06, 2024 at 14:51 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hairtales`
--

-- --------------------------------------------------------
CREATE TABLE `Role` (
  `rid` INT PRIMARY KEY NOT NULL,
  `rname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Table structure for table `Staffs`
--

CREATE TABLE `Staffs` (
`staffId` INT PRIMARY KEY AUTO_INCREMENT, 
`rid` INT NOT NULL,
`staff_fname` VARCHAR(20) NOT NULL, 
`staff_lname` VARCHAR(20) NOT NULL, 
`staff_contact` INT UNIQUE NOT NULL, 
`staff_email` VARCHAR(30) UNIQUE NOT NULL,
`staff_passwd` VARCHAR(255) UNIQUE NOT NULL,
`staff_dob` DATE NOT NULL, 
`staff_gender` VARCHAR(10) NOT NULL,
FOREIGN KEY (rid) REFERENCES Role(rid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Table structure for table `Clients`
--

CREATE TABLE `Clients` (
`clientId` INT PRIMARY KEY AUTO_INCREMENT,
`rid` INT NOT NULL,
`client_fname` VARCHAR(20) NOT NULL,
`client_lname` VARCHAR(20) NOT NULL,
`client_contact` INT NOT NULL,
`client_email` VARCHAR(30) UNIQUE NOT NULL,
`client_passwd` VARCHAR(255) UNIQUE NOT NULL,
`client_dob` DATE NOT NULL, 
`client_gender` VARCHAR(10) NOT NULL,
FOREIGN KEY (rid) REFERENCES Role(rid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Table structure for table `Services`
--

--
-- Table structure for table `Bookings`
--

CREATE TABLE `Bookings` (
`bookingId` INT PRIMARY KEY AUTO_INCREMENT,
`staffId` INT,
`clientId` INT NOT NULL,
`servicename` VARCHAR(100) NOT NULL,
`current_date` DATE,
`booking_date` DATE,  
`starttime_slot` TIME NOT NULL,
`endtime_slot` TIME NOT NULL,
FOREIGN KEY (staffId) REFERENCES Staffs(staffId),
FOREIGN KEY (clientId) REFERENCES Clients(clientId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Role`
--

--
-- Dumping data for table `Role`
--

INSERT INTO `Role` (`rid`, `rname`) VALUES
(1, 'salonowner'),
(2, 'staff'),
(3, 'client');
--
-- Indexes for table `Clients`
--
ALTER TABLE `Clients`
  DROP PRIMARY KEY,  -- Drop existing primary key
  ADD PRIMARY KEY (`clientId`);

--
-- Indexes for table `Role`
--
ALTER TABLE `Role`
  DROP PRIMARY KEY,  -- Drop existing primary key
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `Staffs`
--
ALTER TABLE `Staffs`
  DROP PRIMARY KEY,  -- Drop existing primary key
  ADD PRIMARY KEY (`staffId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Bookings`
--
ALTER TABLE `Bookings`
  MODIFY `bookingId` INT NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Staffs`
--
ALTER TABLE `Staffs`
  MODIFY `staffId` INT NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Clients`
--
ALTER TABLE `Clients`
  MODIFY `clientId` INT NOT NULL AUTO_INCREMENT;

--
ALTER TABLE `Staffs`
  DROP FOREIGN KEY `staffs_ibfk_1`;

-- Constraints for table `Bookings`
-- Indexes for table `Bookings`
ALTER TABLE `Bookings`
  ADD INDEX `idx_staffId` (`staffId`),
  ADD INDEX `idx_booking_date` (`booking_date`),
  ADD INDEX `idx_starttime_slot` (`starttime_slot`),
  ADD INDEX `idx_endtime_slot` (`endtime_slot`);

-- Recreate the foreign key constraint
ALTER TABLE `Staffs` ADD CONSTRAINT `staffs_ibfk_1` FOREIGN KEY (`rid`) REFERENCES `Role` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Staffs`
--
ALTER TABLE `Clients`
  DROP FOREIGN KEY `clients_ibfk_1`;

ALTER TABLE `Clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`rid`) REFERENCES `Role` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;