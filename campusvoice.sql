-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2025 at 06:18 PM
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
-- Database: `campusvoice`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('Submitted','In Progress','Resolved') DEFAULT 'Submitted',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `user_id`, `title`, `description`, `status`, `created_at`) VALUES
(2, 1, 'Classroom Issue', 'fan is not working ', 'Submitted', '2025-09-26 09:32:43'),
(3, 1, 'Classroom Issue', 'fan is not working ', 'Submitted', '2025-09-26 09:35:42'),
(4, 1, 'Classroom Issue', 'fan is not working ', 'Submitted', '2025-09-26 09:35:54'),
(5, 1, 'Classroom Issue', 'fan is not working ', 'Submitted', '2025-09-26 09:35:59'),
(6, 1, 'Classroom Issue', 'fan is not working ', 'Submitted', '2025-09-26 09:36:04'),
(7, 1, 'Classroom Issue', 'fan is not working ', 'Submitted', '2025-09-26 09:38:40'),
(8, 1, 'Classroom Issue', 'fan is not working ', 'Submitted', '2025-09-26 09:39:37'),
(9, 1, 'Hostel Issue', 'food', 'Submitted', '2025-09-26 09:39:52'),
(10, 1, 'Sports Facility', '', 'In Progress', '2025-09-26 11:23:26'),
(11, 1, 'Others', 'electricity ports are not workin tybca class', 'Resolved', '2025-09-26 11:25:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `rollno` varchar(50) NOT NULL,
  `class` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `rollno`, `class`, `department`, `phone`, `email`, `password`, `created_at`) VALUES
(1, 'Magnus Rodrigues', '45', 'TY', 'B.Com', '08975525710', 'rodriguesmagnus528@gmail.com', '$2y$10$WxRhjoZzpHybgGcmRHdGmeDXO4UTaoNlpOshxXpzWk4gS4035ZxHi', '2025-09-23 09:42:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
