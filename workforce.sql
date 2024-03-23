-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 28, 2024 at 10:58 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `workforce`
--
CREATE DATABASE IF NOT EXISTS `workforce` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `workforce`;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `role` varchar(256) NOT NULL,
  `contact_num` varchar(20) NOT NULL,
  `age` int NOT NULL,
  `dob` date NOT NULL,
  `vac_count` int NOT NULL,
  `quarantine` tinyint(1) NOT NULL DEFAULT '0',
  `salary` decimal(10,2) NOT NULL DEFAULT '0.00',
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `FK_EMPLOYEE_USER_ID` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `role`, `contact_num`, `age`, `dob`, `vac_count`, `quarantine`, `salary`, `user_id`) VALUES
(22, 'Raf', 'Driver', '0136824144', 32, '1992-06-01', 1, 1, 2100.00, 42),
(23, 'Khalid', 'Warehouse', '01267810122', 21, '2003-02-12', 3, 0, 1500.00, 43),
(24, 'Kamal', 'Warehouse', '0188856931', 21, '2003-12-04', 2, 0, 1500.00, 44);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  `role` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `id`, `role`) VALUES
('test', '$2y$10$8D5pSj45N4OI734YGNFkhOkNcxx4.7lvxElVyCPSxwLV2WxhfOoV.', 41, 'admin'),
('raf', '$2y$10$U83TfNiHbVL0CeIqySSkq.M37VVQqmHoTP/qO1rwxQ3m4dBQxujVW', 42, 'user'),
('khalid', '$2y$10$3IP9TrOZl4YC7wKcsibE2O/P0qRqe63eK27qWquOKaSruD1MuFlVS', 43, 'user'),
('kamal', '$2y$10$ab4Fn4axN9fezbAB0gNvrun.HoMiSGZACZzixMDygeFJSQz0lSHJy', 44, 'user');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `FK_EMP_USER_ID` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
