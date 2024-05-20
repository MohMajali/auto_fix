-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2024 at 12:11 AM
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
-- Database: `auto_fix_2024`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointmentes`
--

CREATE TABLE `appointmentes` (
  `id` int(11) NOT NULL,
  `specialization_id` int(11) NOT NULL,
  `mechanic_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date` varchar(191) NOT NULL,
  `time` varchar(191) NOT NULL,
  `price` double DEFAULT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'PENDING',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `appointmentes`
--

INSERT INTO `appointmentes` (`id`, `specialization_id`, `mechanic_id`, `customer_id`, `date`, `time`, `price`, `status`, `created_at`) VALUES
(1, 1, 2, 3, '2024-05-17', '14:34', 1222, 'Accepted', '2024-05-04 21:35:32'),
(2, 2, 4, 3, '2024-05-15', '21:57', 10, 'Accepted', '2024-05-05 19:57:17');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `created_at`) VALUES
(1, 'Amman', '2024-05-04 20:43:02'),
(2, 'Irbid', '2024-05-04 20:43:02'),
(3, 'Alaqaba', '2024-05-05 19:55:37'),
(4, 'Alzarqa', '2024-05-05 19:55:37');

-- --------------------------------------------------------

--
-- Table structure for table `mechanices_customers_ratings`
--

CREATE TABLE `mechanices_customers_ratings` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `mechanic_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `mechanices_customers_ratings`
--

INSERT INTO `mechanices_customers_ratings` (`id`, `customer_id`, `mechanic_id`, `rate`) VALUES
(6, 3, 2, 5),
(7, 3, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `reviewes`
--

CREATE TABLE `reviewes` (
  `id` int(11) NOT NULL,
  `mechanic_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `review` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `reviewes`
--

INSERT INTO `reviewes` (`id`, `mechanic_id`, `customer_id`, `review`, `created_at`) VALUES
(1, 2, 3, 'lorem lorem lorem lorem lorem lorem lorem', '2024-05-04 22:04:54'),
(2, 4, 3, 'lorem 0lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem ', '2024-05-05 19:59:51');

-- --------------------------------------------------------

--
-- Table structure for table `specliazations`
--

CREATE TABLE `specliazations` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `specliazations`
--

INSERT INTO `specliazations` (`id`, `name`, `active`, `created_at`) VALUES
(1, 'ميكانيكي', 1, '2024-05-04 20:53:49'),
(2, 'كهرابا', 1, '2024-05-05 19:44:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `specalization_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `type` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `total_rate` double NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `specalization_id`, `location_id`, `type`, `name`, `email`, `phone`, `password`, `total_rate`, `active`, `created_at`) VALUES
(1, NULL, NULL, 'ADMIN', 'Admin', 'admin@yahoo.com', '7412589630', '1234567890', 0, 1, '2024-05-04 20:37:33'),
(2, 1, 1, 'MICHANIC', 'Mechanic 1', 'mechanic@yahoo.com', '9876543210', 'Ab@12345', 2, 1, '2024-05-04 21:07:03'),
(3, NULL, NULL, 'USER', 'Khaled', 'user@yahoo.com', '8523697410', '1234567890', 0, 1, '2024-05-04 21:29:35'),
(4, 2, 4, 'MICHANIC', 'Mohammad', 'mechanic2@yahoo.com', '741325960', '1234567890', 4, 1, '2024-05-05 19:48:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointmentes`
--
ALTER TABLE `appointmentes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `specialization_id_FK_app` (`specialization_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mechanices_customers_ratings`
--
ALTER TABLE `mechanices_customers_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mechanic_id_FK` (`mechanic_id`),
  ADD KEY `customer_id_FK` (`customer_id`);

--
-- Indexes for table `reviewes`
--
ALTER TABLE `reviewes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mechanic_id_review_FK` (`mechanic_id`),
  ADD KEY `customer_id_review_FK` (`customer_id`);

--
-- Indexes for table `specliazations`
--
ALTER TABLE `specliazations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `specialization_id_FK` (`specalization_id`),
  ADD KEY `location_id_FK` (`location_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointmentes`
--
ALTER TABLE `appointmentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mechanices_customers_ratings`
--
ALTER TABLE `mechanices_customers_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reviewes`
--
ALTER TABLE `reviewes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `specliazations`
--
ALTER TABLE `specliazations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointmentes`
--
ALTER TABLE `appointmentes`
  ADD CONSTRAINT `specialization_id_FK_app` FOREIGN KEY (`specialization_id`) REFERENCES `specliazations` (`id`);

--
-- Constraints for table `mechanices_customers_ratings`
--
ALTER TABLE `mechanices_customers_ratings`
  ADD CONSTRAINT `customer_id_FK` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `mechanic_id_FK` FOREIGN KEY (`mechanic_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `reviewes`
--
ALTER TABLE `reviewes`
  ADD CONSTRAINT `customer_id_review_FK` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `mechanic_id_review_FK` FOREIGN KEY (`mechanic_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `location_id_FK` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`),
  ADD CONSTRAINT `specialization_id_FK` FOREIGN KEY (`specalization_id`) REFERENCES `specliazations` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
