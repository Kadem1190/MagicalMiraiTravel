-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Feb 13, 2025 at 12:15 PM
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
-- Database: `magical_mirai_travel`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `email`, `role`, `password`) VALUES
(1, 'Udin', 'udin@nopal.com', 'user', '$2y$10$xOuvOjVn/S2oUq8jp61.h.Iqng40OAcHEHFXJIWrOM9FwIJ0AKtg6'),
(2, 'Admin', 'admin@gmail.com', 'admin', '$2y$10$WMdGMvU2CNtA8Zi6F9naB.KR63YAGdizaZgGdzXOnV4I2Z8VuVi5m'),
(4, 'lkeizory123', 'keizoryadzra@gmail.com', 'admin', '$2y$10$kbE9RMhFqNqwdb2WA20wSuE8GS5nkXIrVrTC/jPzKZfdpgExOs.EC'),
(5, 'Kadem', 'kadem1190@icloud.com', 'user', '$2y$10$9AxQQMoqQCdf1eE8Y7hj/Orr0068D7EJ7Ad9XYFMp7BPh2We3JX/S'),
(6, 'Nopal', 'nopal@nopal.com', 'user', '$2y$10$Y6tJ0/6CUnaGoXjOqcFTqO5yLmU13299CRuAAbtD7Vle55U5zpvTK');

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `image` blob DEFAULT NULL,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`id`, `code`, `image`, `name`, `description`) VALUES
(1, 'TKY-NYK', NULL, 'Tokyo to New York', 'Experience the best in-flight services and comfort.'),
(2, 'PRS-TKY', NULL, 'Paris to Tokyo', 'Enjoy a seamless travel experience with our top-rated airlines.'),
(3, 'LDN-BLI', NULL, 'London to Bali', 'Fly in style and comfort with our premium flight options.');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `accounts_id` int(11) NOT NULL,
  `passenger_name` varchar(250) NOT NULL,
  `flight_code` varchar(10) NOT NULL,
  `seat` varchar(5) NOT NULL,
  `departure_date` date NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `status` enum('Dibayar','Diproses','Digagalkan') NOT NULL DEFAULT 'Dibayar',
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `accounts_id`, `passenger_name`, `flight_code`, `seat`, `departure_date`, `payment_method`, `status`, `date`) VALUES
(4, 1, 'Rizky Sugiharto', 'TKY-NYK', 'A4', '2025-02-15', 'Kartu Kredit', 'Dibayar', '0000-00-00'),
(5, 5, 'nigga', 'PRS-TKY', 'C5', '2025-02-21', 'Transfer Bank', 'Dibayar', '2025-02-13'),
(6, 5, 'nigga', 'PRS-TKY', 'C5', '2025-02-21', 'Transfer Bank', 'Dibayar', '2025-02-13'),
(7, 5, 'Rizky Sugiharto', 'TKY-NYK', 'B6', '2025-02-14', 'Kartu Kredit', 'Dibayar', '2025-02-13'),
(8, 5, 'Rizky Sugiharto', 'TKY-NYK', 'B6', '2025-02-14', 'Kartu Kredit', 'Dibayar', '2025-02-13'),
(9, 5, 'Rizky Sugiharto', 'TKY-NYK', 'B6', '2025-02-14', 'Kartu Kredit', 'Dibayar', '2025-02-13'),
(10, 6, 'rizky sugiharto', 'LDN-BLI', 'B2', '2025-02-28', 'Transfer Bank', 'Dibayar', '2025-02-13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `accounts` ADD FULLTEXT KEY `name` (`name`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key_flights_code` (`code`) USING BTREE;
ALTER TABLE `flights` ADD FULLTEXT KEY `ft_flights_name` (`name`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accounts_id` (`accounts_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`accounts_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
