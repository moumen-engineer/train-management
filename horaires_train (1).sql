-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2025 at 04:32 PM
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
-- Database: `horaires_train`
--

-- --------------------------------------------------------

--
-- Table structure for table `emploi_temps`
--

CREATE TABLE `emploi_temps` (
  `id` int(11) NOT NULL,
  `gare` varchar(100) DEFAULT NULL,
  `B134` time DEFAULT NULL,
  `B104` time DEFAULT NULL,
  `B136` time DEFAULT NULL,
  `B144` time DEFAULT NULL,
  `B140` time DEFAULT NULL,
  `direction` enum('aller','retour') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `emploi_temps`
--

INSERT INTO `emploi_temps` (`id`, `gare`, `B134`, `B104`, `B136`, `B144`, `B140`, `direction`) VALUES
(29, 'reghaia ', '12:54:00', '15:30:00', '00:00:00', '10:40:00', '08:47:00', 'aller'),
(33, 'rouiba ', '13:05:00', '15:40:00', '13:45:00', '11:10:00', '09:15:00', 'aller'),
(34, 'babzouar', '13:30:00', '16:00:00', '14:13:00', '11:30:00', '09:40:00', 'aller'),
(35, 'Dar El Beida', '14:00:00', '15:00:00', '15:30:00', '15:57:00', '16:20:00', 'aller'),
(39, 'boumerdes', '12:00:00', '14:32:00', '13:00:00', '10:14:00', '08:30:00', 'aller'),
(55, 'thenia', '10:10:00', '12:27:00', '12:00:00', '09:20:00', '08:00:00', 'aller'),
(57, 'borj menaiel', '09:00:00', '11:00:00', '11:30:00', '08:30:00', '07:30:00', 'aller'),
(63, 'hamoudi', '12:00:00', '12:27:00', '12:00:00', '11:10:00', '08:12:00', 'retour'),
(65, 'moumen', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 'retour');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `adresse` varchar(150) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'utilisateur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `nom`, `adresse`, `password`, `role`) VALUES
(4, 'amine98@gmail.com', 'amine', 'alger', '6fb42da0e32e07b61c9f0251fe627a9c', 'utilisateur'),
(7, 'momenhamo79@gmail.com', 'moumen', 'boumerdes', '5337c75ab4bf4ad9d4b8ae39f167cf66', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emploi_temps`
--
ALTER TABLE `emploi_temps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emploi_temps`
--
ALTER TABLE `emploi_temps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
