-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2022 at 05:37 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gotogro_mrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `Members_id` int(11) NOT NULL,
  `Members_name` varchar(50) DEFAULT NULL,
  `Members_email` varchar(50) DEFAULT NULL,
  `Members_password` varchar(50) DEFAULT NULL,
  `Members_contact` varchar(50) DEFAULT NULL,
  `Members_address` varchar(150) DEFAULT NULL,
  `Members_status` int(1) DEFAULT NULL,
  `Members_dateCreated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`Members_id`, `Members_name`, `Members_email`, `Members_password`, `Members_contact`, `Members_address`, `Members_status`, `Members_dateCreated`) VALUES
(1, 'SO WAI TING', 'Emilysowt@gmail.com', '12345', '0123456789', '17,jalan pjs 9/5', 1, '2022-10-07 17:35:59');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
