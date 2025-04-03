-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 05, 2021 at 05:19 AM
-- Server version: 8.0.24
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u434392900_maxdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `full_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(175) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime NOT NULL,
  `join_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sdate` datetime NOT NULL,
  `edate` datetime NOT NULL,
  `permissions` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mac` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `last_login`, `join_date`, `sdate`, `edate`, `permissions`, `mac`) VALUES
(1, 'ummer', 'ummer27@gmail.com', 'phenom27', '2021-12-04 05:36:35', '2016-12-22 23:15:21', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'admin', '12345'),
(36, 'ucool', 'ucool38', '123456', '0000-00-00 00:00:00', '2019-07-19 03:36:57', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'admin', ''),
(71, 'tester2', 'tester2', 'tester2', '0000-00-00 00:00:00', '2021-11-26 05:02:51', '2021-12-15 00:00:00', '2021-12-31 00:00:00', 'user', NULL),
(79, 'tester1', 'tester1', 'tester1', '0000-00-00 00:00:00', '2021-12-01 18:58:43', '2021-12-02 00:00:00', '2021-12-31 00:00:00', 'user', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
