-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2024 at 04:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `home server`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `fname` varchar(13) NOT NULL,
  `lname` varchar(13) NOT NULL,
  `gender` varchar(8) NOT NULL,
  `phonenum` varchar(15) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birthdate` varchar(15) NOT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `folder path` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `fname`, `lname`, `gender`, `phonenum`, `email`, `password`, `birthdate`, `priority`, `folder path`) VALUES
(4, 'mhamed', 'ahmed', 'male', '01222223', 'mohamed.ahmed@ws', '$2y$10$GHcjSV9qyC63dui/qK9h4OOhZQBLIBHRJbObWDQ5EImx7SJMXMTK2', '2222-12-22', 0, 'uploads/mohamed.ahmed@ws'),
(5, 'ahmed', 'ali', 'male', '011442423', 'mohamed.ali@wa', '$2y$10$jSVbLYrfwyMQMELMB1Xrq./wVT9r/vtclahN/GrEkxszOuBCjfXLW', '2222-02-22', 1, 'uploads/mohamed.ali@wa'),
(1, 'omar', 'khaled', 'male', '01286246292', 'omar.khaled@ws', '$2y$10$3jAlud6pEVeG3.cvTFYm4es06NSkizb12RDYKHF3laSxYO4jK3vLq', '2000-12-22', 0, 'uploads/omar.khaled@ws');

-- --------------------------------------------------------

--
-- Table structure for table `friendships`
--

CREATE TABLE `friendships` (
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `status` varchar(25) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `friendships`
--

INSERT INTO `friendships` (`user_id`, `friend_id`, `status`, `id`) VALUES
(1, 4, 'accepted', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `reciver` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `secret_key` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `username`, `reciver`, `message`, `secret_key`, `timestamp`) VALUES
(1, 'omar.khaled@ws', 'mohamed.ahmed@ws', '2njS0AC6C0URYEJvGcPaqw==', 'adba6c8bafa4f59b989e94ffef7af4a4', '2024-07-15 12:29:02'),
(2, 'mohamed.ahmed@ws', 'omar.khaled@ws', 'iWvZiBBe4WOX1ylL2tRTQw==', 'e65f321830255cfd85695f3e5bf5c27d', '2024-07-15 12:30:16'),
(3, 'mohamed.ahmed@ws', 'omar.khaled@ws', 'kaC7yqXmNqTuMA23y+4uog==', '3c99a47b4b23f83aa374cb1b343ddbd5', '2024-07-15 12:32:16'),
(4, 'omar.khaled@ws', 'mohamed.ahmed@ws', 'E08RuRhICKRPy1gkJHonLA==', '784956a88d30ebe5b2d1f236fbc31767', '2024-07-15 12:32:20'),
(5, 'omar.khaled@ws', 'mohamed.ahmed@ws', 'ZNAcLDFuHD0jKxyb0gCwnw==', '04b507e0e16cec129b2b0159a4d4ab00', '2024-07-15 12:32:22');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `sender` varchar(50) NOT NULL,
  `reciver` varchar(50) NOT NULL,
  `filepath` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `friendships`
--
ALTER TABLE `friendships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `friendships`
--
ALTER TABLE `friendships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
