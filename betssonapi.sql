-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 01 fév. 2022 à 15:43
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `betssonapi`
--

-- --------------------------------------------------------

--
-- Structure de la table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gender` varchar(1) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `countryCode` varchar(2) NOT NULL,
  `email` text NOT NULL,
  `bonusPercent` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `bonusBalance` int(11) NOT NULL,
  `depositCounter` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `customers`
--

INSERT INTO `customers` (`id`, `gender`, `firstName`, `lastName`, `countryCode`, `email`, `bonusPercent`, `balance`, `bonusBalance`, `depositCounter`) VALUES
(1, 'F', 'test', 'test', 'MT', 'nicolas@gmail.com', 10, 0, 0, 3),
(11, 'F', 'test', 'test', 'MT', 'nicdoddds@gmail.com', 8, 200, 0, 1),
(12, 'F', 'test', 'test', 'MT', 'nicdodddds@gmail.com', 8, 200, 0, 1),
(13, 'F', 'test', 'test', 'MT', 'nicdodsssddds@gmail.com', 10, 200, 0, 1),
(15, 'F', 'test', 'test', 'MT', 'nicdodsssdddds@gmail.comd', 6, 600, 6, 5),
(14, 'F', 'test', 'test', 'MT', 'nicdodsssddds@gmail.comd', 8, 200, 0, 1),
(10, 'F', 'test', 'test', 'MT', 'nicoddds@gmail.com', 18, 100, 0, 0),
(16, 'F', 'test', 'test', 'MT', 'nicdodsssdddds@gmail.comdd', 19, 50, 0, 0),
(17, 'F', 'test', 'test', 'MT', 'nicdodsssdddds@gmail.comddd', 15, 50, 0, 0),
(18, 'F', 'test', 'test', 'MT', 'nicdodsssdddds@gmail.comdddd', 12, 50, 0, 0),
(19, 'F', 'test', 'test', 'MT', 'nicdodsssdddds@gmail.comddddd', 20, 50, 0, 0),
(20, 'F', 'test', 'test', 'MT', 'nicdodsssdddds@gmail.comdddddd', 6, 50, 0, 0),
(21, 'F', 'test', 'test', 'MT', 'nicdodsssdddds@gmail.comddddddd', 10, 100, 0, 0),
(22, 'F', 'test', 'test', 'MT', 'nicdodsssdddds@gmail.comdddddddd', 11, 100, 0, 0),
(23, 'F', 'test', 'test', 'MT', '', 18, 100, 0, 0),
(24, 'F', 'test', 'test', 'MT', 'dddd', 9, 100, 0, 0),
(25, 'F', 'test', 'test', 'MT', 'dddd@gmail.com', 13, 100, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `reporting`
--

DROP TABLE IF EXISTS `reporting`;
CREATE TABLE IF NOT EXISTS `reporting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime(6) NOT NULL,
  `countryCode` varchar(2) NOT NULL,
  `customerId` int(11) NOT NULL,
  `action` enum('deposit','withdraw') NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reporting`
--

INSERT INTO `reporting` (`id`, `date`, `countryCode`, `customerId`, `action`, `amount`) VALUES
(1, '2022-01-30 13:32:30.000000', 'MT', 1, 'withdraw', 1),
(2, '2022-01-10 13:34:01.000000', 'MT', 1, 'deposit', 100),
(3, '2022-02-01 12:17:29.000000', 'LU', 11, 'deposit', 100),
(4, '2022-02-01 12:17:32.000000', 'LU', 12, 'deposit', 100),
(5, '2022-02-01 12:17:34.000000', 'MT', 13, 'deposit', 100),
(6, '2022-02-01 12:17:35.000000', 'FR', 14, 'deposit', 100),
(7, '2022-02-01 12:17:38.000000', 'MT', 15, 'deposit', 100),
(8, '2022-02-01 12:17:51.000000', 'FR', 16, 'withdraw', 50),
(9, '2022-02-01 12:17:54.000000', 'MT', 17, 'withdraw', 50),
(10, '2022-02-01 12:17:55.000000', 'FR', 18, 'withdraw', 50),
(11, '2022-02-01 12:17:57.000000', 'MT', 19, 'withdraw', 50),
(12, '2022-02-01 12:17:59.000000', 'MT', 20, 'withdraw', 50),
(13, '2022-01-30 13:32:30.000000', 'MT', 1, 'withdraw', 1),
(14, '2022-02-01 14:27:44.000000', 'MT', 15, 'deposit', 100),
(15, '2022-02-01 14:28:50.000000', 'MT', 15, 'deposit', 100),
(16, '2022-02-01 14:29:15.000000', 'MT', 15, 'deposit', 100),
(17, '2022-02-01 14:30:25.000000', 'MT', 15, 'deposit', 100);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
