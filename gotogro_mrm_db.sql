-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 1, 2022 at 06:56 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

DROP DATABASE IF EXISTS `gotogro_mrm`;

--
-- Database: `gotogro_mrm`
--

CREATE DATABASE `gotogro_mrm`;
USE `gotogro_mrm`;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `emp_id` int(11) NOT NULL,
  `emp_name` varchar(50) DEFAULT NULL,
  `emp_email` varchar(50) DEFAULT NULL,
  `emp_password` varchar(50) DEFAULT NULL,
  `emp_contact` varchar(20) DEFAULT NULL,
  `emp_position` int(1) DEFAULT NULL,
  `emp_status` int(1) DEFAULT NULL,
  `emp_dateCreated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `members_id` int(11) NOT NULL,
  `members_name` varchar(50) DEFAULT NULL,
  `members_email` varchar(50) DEFAULT NULL,
  `members_contact` varchar(50) DEFAULT NULL,
  `members_address` varchar(150) DEFAULT NULL,
  `members_status` int(1) DEFAULT NULL,
  `members_dateCreated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`emp_id`, `emp_name`, `emp_email`, `emp_password`, `emp_contact`, `emp_position`, `emp_status`, `emp_dateCreated`) VALUES
(1, 'Manager', 'acl_9@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '01112223333', 9, 1, '2021-07-17 13:32:10'),
(2, 'Site-management Staff', 'acl_2@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '01112223333', 2, 1, '2021-07-17 13:33:10'),
(3, 'In-store Staff', 'acl_1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '01112223333', 1, 1, '2021-07-17 13:35:04'),
(4, 'Delivery Staff', 'acl_0@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '01112223333', 0, 1, '2021-07-17 13:35:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`members_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `members`
  MODIFY `members_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
CREATE TABLE `inventory` (
  `inv_id` int(11) NOT NULL,
  `inv_title` varchar(50) DEFAULT NULL,
  `inv_image` varchar(255) DEFAULT NULL,
  `inv_description` text DEFAULT NULL,
  `inv_price` decimal(10,2) DEFAULT NULL,
  `best_seller` int(1) NOT NULL,
  `inv_status` int(1) DEFAULT NULL,
  `inv_dateCreated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `inv`
  MODIFY `inv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
  
  CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `item_idList` varchar(255) DEFAULT NULL,
  `sales_totalPrice` decimal(10,2) DEFAULT NULL,
  `sales_pickupMethod` int(1) DEFAULT NULL COMMENT '0=pickup 1=delivery',
  `sales_receipt` text DEFAULT NULL,
  `preffered_date` varchar(11) DEFAULT NULL,
  `preffered_time` varchar(11) DEFAULT NULL,
  `shipment_date` text NOT NULL,
  `sales_status` int(1) NOT NULL DEFAULT 0,
  `sales_dateCreated` datetime DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `emp_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
