-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2026 at 03:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_status`
--

CREATE TABLE `booking_status` (
  `booking_status_id` int(11) NOT NULL,
  `status_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Id` int(11) NOT NULL,
  `Title` char(5) NOT NULL,
  `FName` varchar(50) NOT NULL,
  `LName` varchar(50) DEFAULT NULL,
  `NIC` char(12) NOT NULL,
  `ContactNo` int(10) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Id`, `Title`, `FName`, `LName`, `NIC`, `ContactNo`, `Email`, `Address`, `City`) VALUES
(1, 'Ms', 'Dewmini', 'Anuththara', '123456789012', 712356789, 'dewminianu123@gmail.com', 'No:8/8, Abc Rd, Gampaha', 'Gampaha'),
(2, 'Mr', 'Thusitha', 'Kumara', '1234567890V', 718223678, '', '', 'Gampaha');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `Id` int(10) NOT NULL,
  `Code` char(10) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Type_Id` int(10) NOT NULL,
  `Venue` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `Start Time` time NOT NULL,
  `End Time` time NOT NULL,
  `Status_Id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`Id`, `Code`, `Title`, `Type_Id`, `Venue`, `City`, `Date`, `Start Time`, `End Time`, `Status_Id`) VALUES
(1, 'TESTEVENT1', 'Ahankara Nagare', 3, 'Port City', 'Colombo', '2026-02-13', '19:00:00', '00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `event_bookings`
--

CREATE TABLE `event_bookings` (
  `Id` int(10) NOT NULL,
  `Code` char(10) NOT NULL,
  `event_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_status`
--

CREATE TABLE `event_status` (
  `Status_Id` int(10) NOT NULL,
  `Status Type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_status`
--

INSERT INTO `event_status` (`Status_Id`, `Status Type`) VALUES
(1, 'Active'),
(2, 'Inactive'),
(3, 'PostPone'),
(4, 'Cancel');

-- --------------------------------------------------------

--
-- Table structure for table `event_type`
--

CREATE TABLE `event_type` (
  `Type_Id` int(10) NOT NULL,
  `Type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_type`
--

INSERT INTO `event_type` (`Type_Id`, `Type`) VALUES
(3, 'Musical Show'),
(4, 'Drama'),
(5, 'Dance Show'),
(6, 'Stand-Up Comedy');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `Role_Id` int(10) NOT NULL,
  `Role Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`Role_Id`, `Role Name`) VALUES
(1, 'Admin'),
(2, 'Event Manager'),
(3, 'Event Organizer'),
(4, 'Event Staff'),
(5, 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(10) NOT NULL,
  `code` char(10) NOT NULL,
  `category_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `Price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_category`
--

CREATE TABLE `ticket_category` (
  `category_id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(10) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role_Id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Name`, `Password`, `Role_Id`) VALUES
(1, 'Sandani', 'Abc@123456789', 1),
(2, 'Dilmi', 'Abc@123456789', 1),
(3, 'Kasun', 'Abc@123456789', 2),
(4, 'Namal', 'Abc@123456789', 4),
(5, 'Gayangi', 'Xyz@123456789', 5),
(6, 'Nimal', 'Xyz@123456789', 3),
(7, 'Kevin', 'Xyz@123456789', 5),
(8, 'Dinithi', 'Xyz@123456789', 5),
(9, 'Kavindya', 'Xyz@123456789', 5),
(10, 'Yasith', 'Xyz@123456789', 5),
(11, 'Joseph', 'Abc@123456789', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_status`
--
ALTER TABLE `booking_status`
  ADD KEY `booking_status_id_fk` (`booking_status_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `type_id_fk` (`Type_Id`),
  ADD KEY `status_id_fk` (`Status_Id`);

--
-- Indexes for table `event_bookings`
--
ALTER TABLE `event_bookings`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `event_id_fk` (`event_id`),
  ADD KEY `customer_id_fk` (`customer_id`),
  ADD KEY `ticket_id_fk` (`ticket_id`);

--
-- Indexes for table `event_status`
--
ALTER TABLE `event_status`
  ADD PRIMARY KEY (`Status_Id`);

--
-- Indexes for table `event_type`
--
ALTER TABLE `event_type`
  ADD PRIMARY KEY (`Type_Id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`Role_Id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `event_id_fk` (`event_id`),
  ADD KEY `category_id_fk` (`category_id`) USING BTREE;

--
-- Indexes for table `ticket_category`
--
ALTER TABLE `ticket_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `role_id_fk` (`Role_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_status`
--
ALTER TABLE `booking_status`
  MODIFY `booking_status_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event_bookings`
--
ALTER TABLE `event_bookings`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_status`
--
ALTER TABLE `event_status`
  MODIFY `Status_Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `event_type`
--
ALTER TABLE `event_type`
  MODIFY `Type_Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `Role_Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket_category`
--
ALTER TABLE `ticket_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`Status_Id`) REFERENCES `event_status` (`status_id`),
  ADD CONSTRAINT `event_ibfk_2` FOREIGN KEY (`Type_Id`) REFERENCES `event_type` (`type_id`);

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_ibfk_1` FOREIGN KEY (`Role_Id`) REFERENCES `users` (`Id`);

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `ticket_category` (`Category_Id`),
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `event` (`Id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`Role_Id`) REFERENCES `roles` (`Role_Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
