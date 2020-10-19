-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 19 oct. 2020 à 08:42
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pfs`
--

-- --------------------------------------------------------

--
-- Structure de la table `absent`
--

DROP TABLE IF EXISTS `absent`;
CREATE TABLE IF NOT EXISTS `absent` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_etudiant` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `absent`
--

INSERT INTO `absent` (`ID`, `ID_etudiant`, `date`) VALUES
(1, 1, '2020-10-14 14:30:00'),
(2, 3, '2020-10-14 14:30:00'),
(3, 2, '2020-10-14 08:30:00'),
(4, 4, '2020-10-14 08:30:00'),
(5, 5, '2020-10-14 14:30:00');

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

DROP TABLE IF EXISTS `cours`;
CREATE TABLE IF NOT EXISTS `cours` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_module` int(11) NOT NULL,
  `ID_user` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `semistre` int(11) NOT NULL,
  `filiere` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`ID`, `ID_module`, `ID_user`, `nom`, `semistre`, `filiere`) VALUES
(1, 1, 2, 'LANGUES ET TECHNIQUES D’EXPRESSION', 1, 'GI'),
(2, 2, 5, 'MATHEMATIQUES', 1, 'GI'),
(3, 3, 4, 'ARCHITECTURE DES ORDINATEURS ET ELECTRONIQUE NUMERIQUE', 1, 'GI'),
(4, 4, 3, 'ALGORITHMIQUE ET PROGRAMMATION', 1, 'GI'),
(5, 5, 2, 'LANGUES ET TECHNIQUES D’EXPRESSION', 1, 'IDSD'),
(6, 6, 5, 'MATHEMATIQUES', 1, 'IDSD'),
(7, 7, 4, 'ARCHITECTURE DES ORDINATEURS ET ELECTRONIQUE NUMERIQUE', 1, 'IDSD'),
(8, 8, 3, 'ALGORITHMIQUE ET PROGRAMMATION', 1, 'IDSD');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `filiere` varchar(255) NOT NULL,
  `semistre` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `genre` varchar(1) NOT NULL,
  `date_naissance` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`ID`, `nom`, `prenom`, `filiere`, `semistre`, `email`, `telephone`, `genre`, `date_naissance`) VALUES
(1, 'mohammed', 'mohammed', 'GI', 1, 'med@email.com', '06xxxxxxxx', 'm', '2000-01-01'),
(2, 'khadija', 'khadija', 'IDSD', 1, 'khadija@email.com', '06xxxxxxxx', 'f', '2000-02-01'),
(3, 'hamdach', 'ismail', 'GI', 1, 'ismail@email.com', '06xxxxxxxx', 'm', '2000-06-07'),
(4, 'etuduant', 'etuduant', 'IDSD', 1, 'etuduant@email.com', '06xxxxxxxx', 'f', '2000-12-06'),
(5, 'etu1', 'etu', 'GI', 1, 'etu@email.com', '06xxxxxxxx', 'm', '2000-06-07'),
(6, 'etu2', 'etu', 'IDSD', 1, 'etu2@email.com', '06xxxxxxxx', 'f', '2000-12-06');

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

DROP TABLE IF EXISTS `filiere`;
CREATE TABLE IF NOT EXISTS `filiere` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `filiere`
--

INSERT INTO `filiere` (`ID`, `nom`) VALUES
(1, 'GI'),
(2, 'IDSD');

-- --------------------------------------------------------

--
-- Structure de la table `module`
--

DROP TABLE IF EXISTS `module`;
CREATE TABLE IF NOT EXISTS `module` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `filiere` varchar(225) NOT NULL,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `module`
--

INSERT INTO `module` (`ID`, `filiere`, `nom`) VALUES
(1, 'GI', 'LANGUES ET TECHNIQUES D’EXPRESSION '),
(2, 'GI', 'MATHEMATIQUES '),
(3, 'GI', 'ARCHITECTURE DES ORDINATEURS ET ELECTRONIQUE NUMERIQUE'),
(4, 'GI', 'ALGORITHMIQUE ET PROGRAMMATION'),
(5, 'IDSD', 'LANGUES ET TECHNIQUES D’EXPRESSION '),
(6, 'IDSD', 'MATHEMATIQUES'),
(7, 'IDSD', 'ARCHITECTURE DES ORDINATEURS ET ELECTRONIQUE NUMERIQUE'),
(8, 'IDSD', 'ALGORITHMIQUE ET PROGRAMMATION');

-- --------------------------------------------------------

--
-- Structure de la table `programme`
--

DROP TABLE IF EXISTS `programme`;
CREATE TABLE IF NOT EXISTS `programme` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_cours` int(11) NOT NULL,
  `heur` time NOT NULL,
  `jour` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `programme`
--

INSERT INTO `programme` (`ID`, `ID_cours`, `heur`, `jour`) VALUES
(1, 1, '08:30:00', 'mon'),
(2, 2, '14:30:00', 'mon'),
(3, 3, '08:30:00', 'tue'),
(4, 4, '14:30:00', 'tue'),
(5, 5, '08:30:00', 'mon'),
(6, 6, '14:30:00', 'mon'),
(7, 7, '14:30:00', 'tue'),
(8, 8, '08:30:00', 'tue'),
(9, 4, '14:30:00', 'wed'),
(10, 8, '08:30:00', 'wed');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `genre` varchar(1) NOT NULL,
  `date_naissance` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`ID`, `nom`, `prenom`, `email`, `password`, `telephone`, `genre`, `date_naissance`) VALUES
(1, 'admin', 'admin', 'admin@email.com', 'admin', '06xxxxxxxx', 'm', '1970-01-01'),
(2, 'BEN MASSOUD', 'Jihane', 'jihane@email.com', 'prof', '06xxxxxxxx', 'f', '1970-01-01'),
(3, 'Karami', 'Fahd', 'fahd@email.com', 'prof', '06xxxxxxxx', 'm', '1970-01-01'),
(4, 'GUEZZAZ', 'Azidine', 'azidine@email.com', 'prof', '06xxxxxxxx', 'm', '1970-01-01'),
(5, 'EL MESKIN', '', 'elmeskin@email.com', 'prof', '06xxxxxxxx', 'm', '1970-01-01');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
