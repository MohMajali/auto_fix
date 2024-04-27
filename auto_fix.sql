-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2024 at 06:32 PM
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
-- Database: `auto_fix`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointmentes`
--

CREATE TABLE `appointmentes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mechanic_id` int(11) NOT NULL,
  `date` varchar(250) NOT NULL,
  `time` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `appointmentes`
--

INSERT INTO `appointmentes` (`id`, `user_id`, `mechanic_id`, `date`, `time`) VALUES
(1, 1, 2, '2024-05-01', '19:42');

-- --------------------------------------------------------

--
-- Table structure for table `mechanices`
--

CREATE TABLE `mechanices` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `password` varchar(191) NOT NULL,
  `specialization_id` int(11) NOT NULL,
  `location` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `mechanices`
--

INSERT INTO `mechanices` (`id`, `name`, `password`, `specialization_id`, `location`) VALUES
(2, 'Mechanic 1', '1234567890', 2, 'location 1');

-- --------------------------------------------------------

--
-- Table structure for table `reviewes`
--

CREATE TABLE `reviewes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mechanic_id` int(11) NOT NULL,
  `rating` double NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `reviewes`
--

INSERT INTO `reviewes` (`id`, `user_id`, `mechanic_id`, `rating`, `comment`) VALUES
(1, 1, 2, 5, 'lorem lorem lorem lorem lorem ');

-- --------------------------------------------------------

--
-- Table structure for table `specializations`
--

CREATE TABLE `specializations` (
  `id` int(11) NOT NULL,
  `specialization` varchar(191) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `specializations`
--

INSERT INTO `specializations` (`id`, `specialization`, `active`, `created_at`) VALUES
(1, 'Test 1', 1, '2024-04-27 17:11:24'),
(2, 'Test 2', 1, '2024-04-27 17:11:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'User 12222', 'user@yahoo.com', '1234567890');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointmentes`
--
ALTER TABLE `appointmentes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_FK_1` (`user_id`),
  ADD KEY `mechanic_id_FK_1` (`mechanic_id`);

--
-- Indexes for table `mechanices`
--
ALTER TABLE `mechanices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perzonalization_id_FK` (`specialization_id`);

--
-- Indexes for table `reviewes`
--
ALTER TABLE `reviewes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_FK` (`user_id`),
  ADD KEY `mechanic_id_FK` (`mechanic_id`);

--
-- Indexes for table `specializations`
--
ALTER TABLE `specializations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointmentes`
--
ALTER TABLE `appointmentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mechanices`
--
ALTER TABLE `mechanices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reviewes`
--
ALTER TABLE `reviewes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `specializations`
--
ALTER TABLE `specializations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointmentes`
--
ALTER TABLE `appointmentes`
  ADD CONSTRAINT `mechanic_id_FK_1` FOREIGN KEY (`mechanic_id`) REFERENCES `mechanices` (`id`),
  ADD CONSTRAINT `user_id_FK_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `mechanices`
--
ALTER TABLE `mechanices`
  ADD CONSTRAINT `perzonalization_id_FK` FOREIGN KEY (`specialization_id`) REFERENCES `specializations` (`id`);

--
-- Constraints for table `reviewes`
--
ALTER TABLE `reviewes`
  ADD CONSTRAINT `mechanic_id_FK` FOREIGN KEY (`mechanic_id`) REFERENCES `mechanices` (`id`),
  ADD CONSTRAINT `user_id_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
