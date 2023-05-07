-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2023 at 02:48 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `esp_parking`
--

-- --------------------------------------------------------

--
-- Table structure for table `main_table`
--

CREATE TABLE `main_table` (
  `id` int(11) NOT NULL,
  `cId` varchar(255) NOT NULL,
  `cName` varchar(255) NOT NULL,
  `cPlate` varchar(255) NOT NULL,
  `cTimecheckin` timestamp NULL DEFAULT current_timestamp(),
  `cTimecheckout` timestamp NULL DEFAULT current_timestamp(),
  `cParkArena` int(11) NOT NULL,
  `cParkLocation` int(11) NOT NULL,
  `cStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `main_table`
--

INSERT INTO `main_table` (`id`, `cId`, `cName`, `cPlate`, `cTimecheckin`, `cTimecheckout`, `cParkArena`, `cParkLocation`, `cStatus`) VALUES
(1, 'hnmu-p1', 'Nguyen Van B', '30A-12345', '2023-05-05 06:04:18', '2023-05-06 11:08:54', 1, 1, 1),
(2, 'hnmu-p2', 'Nguyen Van B', '30C-14545', '2023-05-05 11:08:54', '2023-05-06 12:08:54', 1, 3, 2),
(3, 'hnmu-p3', 'Nguyen Van C', '30A-45678', '2023-05-06 11:12:42', '2023-05-09 11:11:59', 1, 5, 2),
(4, 'hnmu-p4', 'Nguyen Van C', '29L5-40520', '2023-05-18 12:38:59', '2023-05-26 12:38:59', 1, 4, 1),
(5, 'hnmu-p5', '', '', NULL, NULL, 1, 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `main_table`
--
ALTER TABLE `main_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `main_table`
--
ALTER TABLE `main_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
