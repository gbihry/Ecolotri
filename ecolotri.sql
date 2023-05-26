-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 02 mai 2023 à 18:08
-- Version du serveur : 5.7.36
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecolotri`
--

-- --------------------------------------------------------

--
-- Structure de la table `pesee`
--

DROP TABLE IF EXISTS `pesee`;
CREATE TABLE IF NOT EXISTS `pesee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateDepot` date DEFAULT NULL,
  `heure` varchar(25) DEFAULT NULL,
  `poidArrivee` int(11) DEFAULT NULL,
  `poidDepart` int(11) DEFAULT NULL,
  `immatriculationCamion` varchar(255) DEFAULT NULL,
  `idDechet` int(11) NOT NULL,
  `idSyndicat` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idDechet` (`idDechet`),
  KEY `idSyndicat` (`idSyndicat`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `syndicat`
--

DROP TABLE IF EXISTS `syndicat`;
CREATE TABLE IF NOT EXISTS `syndicat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) DEFAULT NULL,
  `adresse` varchar(25) DEFAULT NULL,
  `cp` int(11) DEFAULT NULL,
  `ville` varchar(25) DEFAULT NULL,
  `contact` varchar(25) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `telephone` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `syndicat`
--

INSERT INTO `syndicat` (`id`, `nom`, `adresse`, `cp`, `ville`, `contact`, `mail`, `telephone`) VALUES
(1, 'Roess', '86 rue des jardins', 57000, 'Belfort', 'Monique', 'roess@gmail.com', 606060606),
(2, 'Bihry', '10 rue de mon coeur', 69000, 'lyon', 'guigui', 'guigui@gmail.com', 3630),
(3, 'Nappey', '14 faubourg de la vigne', 68000, 'colmar', 'John doe', 'john@gmail.com', 1020);

-- --------------------------------------------------------

--
-- Structure de la table `typedechet`
--

DROP TABLE IF EXISTS `typedechet`;
CREATE TABLE IF NOT EXISTS `typedechet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `typedechet`
--

INSERT INTO `typedechet` (`id`, `libelle`) VALUES
(1, 'verre'),
(2, 'métal'),
(3, 'carton'),
(4, 'bois'),
(5, 'végétaux'),
(6, 'ménager');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
