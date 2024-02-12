-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 12, 2024 at 11:05 AM
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
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id_m`, `email`, `msg`, `date`, `text_color`, `is_bold`, `is_italics`, `image`) VALUES
(1, 'Sarouman@gmail.com', 'Hey, salut à tous les amis, c\'est David Lafarge Pokemon', '2023-11-23 16:14:29', '#0000FF', 1, 0, NULL),
(43, 'z@z.z', 'dsfdgfhgjhk', '2024-02-12 11:12:36', '#804000', 1, 0, NULL),
(4, 'Sarouman@gmail.com', 'Lol', '2023-11-22 16:19:14', NULL, 0, 0, NULL),
(6, 'z@z', 'dfsgwdhxfncg,', '2024-02-05 10:20:17', '#000000', 1, 1, NULL),
(12, 'z@z', '\r\nc\r\nc\r\nc\r\nc\r\n\r\n', '2024-02-05 11:01:37', '#000000', 0, 0, ''),
(39, 'admin@man', 'qs', '2024-02-12 10:37:07', '#000000', 0, 0, 'uploads/Volibear original.jpg'),
(16, 'z@z', 'Image tree', '2024-02-05 11:10:59', '#800040', 0, 1, ''),
(20, 'z@z', 'ffff', '2024-02-05 11:28:44', '#000000', 0, 0, ''),
(37, 'admin@man', 'testing everything is ok', '2024-02-12 09:58:52', '#ff80c0', 0, 1, ''),
(25, 'z@z', 'hi image', '2024-02-05 11:36:55', '#000000', 0, 0, 'uploads/My honest reaction.jpg'),
(29, 'z@z', 'd', '2024-02-05 11:39:15', '#000000', 0, 0, 'uploads/rice field sunrise.jpg'),
(30, 'z@z', 'd', '2024-02-05 11:39:28', '#000000', 0, 0, 'uploads/Darkest Dungeon.png'),
(32, 'z@z', 'https://github.com/', '2024-02-05 12:04:13', '#0000ff', 0, 0, ''),
(33, 'azerty@mail', 'Ce message est en orange et gras avec une image ', '2024-02-05 12:10:03', '#ff8000', 1, 0, 'uploads/sunset.jpg'),
(36, 'aurelion@gmail.com', 'Hello Runterra ! Let\'s rock !', '2024-02-09 12:24:19', '#ffff80', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_u` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `IsAdmin` tinyint DEFAULT '0',
  PRIMARY KEY (`id_u`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_u`, `email`, `mdp`, `IsAdmin`) VALUES
(6, 'admin@man', '$2y$10$Ee6L9YlqHCTdQininTwAfeOQUDAP/1xKEyILTZNzxT7B.gQCU3IAW', 1),
(9, 'ken@mail.com', '$2y$10$0c/1vT/c9zJqNFV4Mafg0O7G.hhd2G3gUsv/d0m6XQCNkI/pDt76a', 0),
(11, 'aurelion@gmail.com', '$2y$10$Jgj3Gkjwz4P4fMD1dOwqneWFW3MJ/fYha1cpzrV.fIEZivK3N/fQ.', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
