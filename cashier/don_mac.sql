-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2024 at 12:56 AM
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
-- Database: `don_mac`
--

-- --------------------------------------------------------

--
-- Table structure for table `drinks`
--

CREATE TABLE `drinks` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `image` varchar(500) NOT NULL,
  `user_id` varchar(60) NOT NULL,
  `date` datetime NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `status` varchar(20) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drinks`
--

INSERT INTO `drinks` (`id`, `description`, `qty`, `amount`, `image`, `user_id`, `date`, `views`, `status`) VALUES
(8, 'Hot Caramel', 1, 39.00, 'uploads/ea0336e1c8483f64575c6723eaabaac9c93ef5e0_6564.jpeg', '2', '2024-09-24 22:55:28', 9, 'active'),
(9, 'Hot Darko', 1, 39.00, 'uploads/ba5a80effb436db88bd46f0447f9c2501dd34cc7_7503.jpeg', '2', '2024-09-24 22:56:45', 8, 'active'),
(10, 'Matcha Berry', 1, 39.00, 'uploads/51c6f5f51babafc2db9a625ce7fd284e232e5aab_5900.jpg', '2', '2024-09-24 22:57:12', 8, 'active'),
(11, 'Don Darko', 1, 39.00, 'uploads/800a76f6cc279a2731d394f96faa629d49f3ef7f_4909.jpg', '2', '2024-09-24 22:57:32', 9, 'active'),
(12, 'Don Barako', 1, 39.00, 'uploads/ba33d9fec4e02ec1555d310b306e6030f9f2ecd4_2654.jpeg', '2', '2024-09-24 22:58:02', 2, 'active'),
(13, 'Black Forest', 1, 39.00, 'uploads/124f02a23c74a9d74732b89841ba5683955bc4fa_6667.jpg', '2', '2024-09-24 22:58:30', 1, 'active'),
(14, 'Don Matchatos', 1, 39.00, 'uploads/212f0a9b011e9e5d4575e8a3b608f64931763ce6_3463.jpg', '2', '2024-09-24 22:59:05', 2, 'active'),
(15, 'Donya Berry', 1, 39.00, 'uploads/44b70c9061e8cd28e5d73a53c97197e6cfb367c9_4890.jpg', '2', '2024-09-24 22:59:23', 2, 'active'),
(16, 'Caramel Machiattos', 1, 39.00, 'uploads/907464bc6b31ea2b5959ffdc3abf7032a06cc749_5580.jpg', '2', '2024-09-24 22:59:48', 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `receipt_no` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `date` datetime NOT NULL,
  `user_id` varchar(60) NOT NULL,
  `transaction_no` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `receipt_no`, `description`, `qty`, `amount`, `total`, `date`, `user_id`, `transaction_no`) VALUES
(51, 34, 'Matcha Berry', 1, 39.00, 39.00, '2024-10-04 05:12:24', '2', '202410040001'),
(52, 35, 'Hot Darko', 1, 39.00, 39.00, '2024-10-04 05:12:47', '2', '202410040002'),
(53, 35, 'Hot Caramel', 1, 39.00, 39.00, '2024-10-04 05:12:47', '2', '202410040002'),
(54, 35, 'Matcha Berry', 1, 39.00, 39.00, '2024-10-04 05:12:47', '2', '202410040002'),
(55, 36, 'Matcha Berry', 1, 39.00, 39.00, '2024-10-10 18:44:03', '2', '202410100001'),
(56, 37, 'Don Darko', 1, 39.00, 39.00, '2024-10-11 01:57:13', '2', '202410110001'),
(57, 37, 'Black Forest', 1, 39.00, 39.00, '2024-10-11 01:57:13', '2', '202410110001'),
(58, 37, 'Hot Caramel', 1, 39.00, 39.00, '2024-10-11 01:57:13', '2', '202410110001'),
(59, 37, 'Donya Berry', 1, 39.00, 39.00, '2024-10-11 01:57:13', '2', '202410110001'),
(60, 38, 'Don Darko', 1, 39.00, 39.00, '2024-10-11 02:13:25', '2', '202410110002'),
(61, 39, 'Hot Caramel', 6, 39.00, 234.00, '2024-10-11 02:13:57', '2', '202410110003'),
(62, 39, 'Don Matchatos', 1, 39.00, 39.00, '2024-10-11 02:13:57', '2', '202410110003'),
(63, 40, 'Don Darko', 3, 39.00, 117.00, '2024-10-11 02:15:14', '8', '202410110004'),
(64, 41, 'Don Darko', 3, 39.00, 117.00, '2024-10-11 02:16:58', '8', '202410110005'),
(65, 42, 'Don Barako', 1, 39.00, 39.00, '2024-10-15 00:53:49', '2', '202410150001');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `role` varchar(20) NOT NULL,
  `gender` varchar(6) NOT NULL DEFAULT 'male',
  `deletable` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `date`, `image`, `role`, `gender`, `deletable`) VALUES
(2, 'Tristan', 'tristan@yahoo.com', '$2y$10$RVmRhZEtQY2t01RTEi2KHONKLK9r7fXCiGvG4WuyHow2T4Ho9d3FS', '2024-09-07 12:42:11', NULL, 'admin', 'male', 1),
(8, 'Sandy', 'sandy@yahoo.com', '$2y$10$SWPA5Jc8U42kvebrLFVi2u0KA6V9uUSgIVhu46e76GFwbVr3LWSXa', '2024-09-23 10:56:42', NULL, 'cashier', 'female', 1),
(9, 'Angelica', 'angelica@yahoo.com', '$2y$10$1kgCjwfUuns32i9Q5xGAyOSAR.w0r9nGA3bjcwmgiCn/ROsRvBLmS', '2024-09-24 21:48:28', NULL, 'supervisor', 'female', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `drinks`
--
ALTER TABLE `drinks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `description` (`description`),
  ADD KEY `qty` (`qty`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `date` (`date`),
  ADD KEY `views` (`views`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receipt_no` (`receipt_no`),
  ADD KEY `date` (`date`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `description` (`description`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `date` (`date`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `drinks`
--
ALTER TABLE `drinks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
