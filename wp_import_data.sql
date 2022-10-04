-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2022 at 02:59 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wordpress_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `wp_import_data`
--

CREATE TABLE `wp_import_data` (
  `ID` int(11) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `address` varchar(150) NOT NULL,
  `phone_no` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wp_import_data`
--

INSERT INTO `wp_import_data` (`ID`, `first_name`, `last_name`, `address`, `phone_no`) VALUES
(1, 'Abhinav', 'Bindtra', 'Lucknow', '9876543210'),
(2, 'Mahendra', 'Singh', 'Rachi', '8976585473'),
(3, 'Sakshi', 'Malik', 'Hariyana', '8926900884'),
(4, 'Geeta', 'Fogard', 'Hariyana', '9987768900'),
(5, 'Vivek', 'Aanad', 'India', '7897700001');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wp_import_data`
--
ALTER TABLE `wp_import_data`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wp_import_data`
--
ALTER TABLE `wp_import_data`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
