-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 05, 2024 at 11:13 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatroom`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id_m` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `msg` varchar(500) NOT NULL,
  `date` datetime DEFAULT NULL,
  `text_color` varchar(20) DEFAULT NULL,
  `is_bold` tinyint(1) DEFAULT '0',
  `is_italics` tinyint(1) DEFAULT '0',
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_m`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id_m`, `email`, `msg`, `date`, `text_color`, `is_bold`, `is_italics`, `image`) VALUES
(1, 'Sarouman@gmail.com', 'Hey, salut à tous les amis, c\'est David Lafarge Pokemon', '2023-11-23 16:14:29', '#0000FF', 1, 0, NULL),
(3, 'Sarouman@gmail.com', 'Gros con', '2023-11-22 16:16:39', NULL, 0, 0, NULL),
(4, 'Sarouman@gmail.com', 'Lol', '2023-11-22 16:19:14', NULL, 0, 0, NULL),
(5, 'z@z', 'dd', '2024-02-05 10:17:06', '', 0, 0, NULL),
(6, 'z@z', 'dfsgwdhxfncg,', '2024-02-05 10:20:17', '#000000', 1, 1, NULL),
(7, 'z@z', 'lien chatgpt : ', '2024-02-05 10:21:11', '#000000', 1, 0, NULL),
(8, 'z@z', 'dfghjklm', '2024-02-05 10:23:40', '#ff8040', 0, 0, NULL),
(9, 'z@z', 'gqzhzehzr', '2024-02-05 10:23:57', '#8080ff', 0, 0, NULL),
(10, 'z@z', 'qdswfdhj', '2024-02-05 10:42:15', '#000000', 0, 0, 'uploads/Mabel.png'),
(18, 'z@z', 'One punch man planet', '2024-02-05 11:15:53', '#008000', 0, 1, ''),
(12, 'z@z', '\r\nc\r\nc\r\nc\r\nc\r\n\r\n', '2024-02-05 11:01:37', '#000000', 0, 0, ''),
(13, 'z@z', 'c', '2024-02-05 11:01:39', '#000000', 0, 0, ''),
(14, 'z@z', 'c', '2024-02-05 11:01:40', '#000000', 0, 0, ''),
(15, 'z@z', 'c', '2024-02-05 11:01:42', '#000000', 0, 0, ''),
(16, 'z@z', 'Image tree', '2024-02-05 11:10:59', '#800040', 0, 1, ''),
(17, 'z@z', 'sdfgh,', '2024-02-05 11:11:20', '#000000', 0, 0, ''),
(19, 'z@z', 'One punch man planet 2', '2024-02-05 11:19:48', '#400040', 1, 0, ''),
(20, 'z@z', 'ffff', '2024-02-05 11:28:44', '#000000', 0, 0, ''),
(21, 'z@z', 'hi', '2024-02-05 11:36:08', '#000000', 0, 0, ''),
(22, 'z@z', 'hi\r\n', '2024-02-05 11:36:16', '#800080', 0, 0, ''),
(23, 'z@z', 'hi', '2024-02-05 11:36:27', '#400000', 1, 0, ''),
(24, 'z@z', 'hi', '2024-02-05 11:36:36', '#000000', 0, 1, ''),
(25, 'z@z', 'hi image', '2024-02-05 11:36:55', '#000000', 0, 0, 'uploads/My honest reaction.jpg'),
(26, 'z@z', 'dqswfdcgb', '2024-02-05 11:37:28', '#000000', 0, 0, ''),
(27, 'z@z', 'test image v2', '2024-02-05 11:38:32', '#000000', 0, 0, 'uploads/God of war.png'),
(28, 'z@z', 'd', '2024-02-05 11:38:57', '#000000', 0, 0, 'uploads/Unknown Warrior.png'),
(29, 'z@z', 'd', '2024-02-05 11:39:15', '#000000', 0, 0, 'uploads/rice field sunrise.jpg'),
(30, 'z@z', 'd', '2024-02-05 11:39:28', '#000000', 0, 0, 'uploads/Darkest Dungeon.png'),
(31, 'z@z', 'https://github.com/', '2024-02-05 11:43:53', '#000000', 0, 0, ''),
(32, 'z@z', 'https://github.com/', '2024-02-05 12:04:13', '#0000ff', 0, 0, ''),
(33, 'azerty@mail', 'Ce message est en orange et gras avec une image ', '2024-02-05 12:10:03', '#ff8000', 1, 0, 'uploads/sunset.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_u` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  PRIMARY KEY (`id_u`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_u`, `email`, `mdp`) VALUES
(5, 'azerty@mail', '$2y$10$0NFjyi9v3GpxBQhl6bZ4Auuf3hZ/4t6nz6ZNAiSo6WhhwMiyF1qB6'),
(4, 'z@z', '$2y$10$bzUlAMyJAeT.YluEtT8AfuLpjzgd0ypcaBEAOMsNP0BikxyznfbwG');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
