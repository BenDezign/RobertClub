-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  jeu. 21 mars 2019 à 15:19
-- Version du serveur :  5.6.38
-- Version de PHP :  7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `sport`
--

-- --------------------------------------------------------

--
-- Structure de la table `adherents`
--

CREATE TABLE `adherents` (
  `idAdherents` int(11) NOT NULL,
  `prenomAdherents` varchar(45) NOT NULL,
  `nomAdherents` varchar(45) NOT NULL,
  `dateBornAdherents` varchar(45) NOT NULL,
  `genreAdherents` enum('H','F') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `adherents`
--

INSERT INTO `adherents` (`idAdherents`, `prenomAdherents`, `nomAdherents`, `dateBornAdherents`, `genreAdherents`) VALUES
(4, 'Ben', 'Teboul', '1988-01-16', 'H'),
(7, 'Ben', 'Jaoui', '2000-01-16', 'H'),
(8, 'Marciano', 'Chirel', '1990-01-01', 'F'),
(9, 'Sellam', 'Cheina', '1956-01-01', 'F'),
(10, 'Boukris', 'Yossef', '2011-01-01', 'H'),
(11, 'Aurelie', 'Zenou', '1998-01-01', 'F'),
(12, 'Toledano', 'Alan', '1990-01-01', 'H'),
(13, 'Joyce', 'Elmaleh', '1998-01-01', 'F');

-- --------------------------------------------------------

--
-- Structure de la table `adherents_inscrit`
--

CREATE TABLE `adherents_inscrit` (
  `idInscription` int(11) NOT NULL,
  `idAdherents` int(11) NOT NULL,
  `idClubs` int(11) NOT NULL,
  `date_inscription` datetime NOT NULL,
  `annee_licence` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `adherents_inscrit`
--

INSERT INTO `adherents_inscrit` (`idInscription`, `idAdherents`, `idClubs`, `date_inscription`, `annee_licence`) VALUES
(12, 4, 8, '2019-03-21 15:12:47', '2019'),
(18, 11, 8, '2019-03-21 15:15:49', '2019'),
(19, 11, 10, '2019-03-21 15:15:49', '2019'),
(20, 11, 12, '2019-03-21 15:15:49', '2019'),
(21, 10, 8, '2019-03-21 15:16:12', '2019'),
(22, 10, 11, '2019-03-21 15:16:12', '2019'),
(23, 10, 12, '2019-03-21 15:16:12', '2019'),
(24, 9, 9, '2019-03-21 15:16:22', '2019'),
(25, 9, 10, '2019-03-21 15:16:22', '2019'),
(26, 9, 11, '2019-03-21 15:16:22', '2019'),
(27, 8, 8, '2019-03-21 15:16:32', '2019'),
(28, 8, 10, '2019-03-21 15:16:32', '2019'),
(29, 8, 12, '2019-03-21 15:16:32', '2019'),
(30, 7, 9, '2019-03-21 15:16:42', '2019'),
(31, 7, 11, '2019-03-21 15:16:42', '2019'),
(32, 12, 11, '2019-03-21 15:17:20', '2018'),
(33, 13, 11, '2019-03-21 15:17:45', '2018');

-- --------------------------------------------------------

--
-- Structure de la table `clubs`
--

CREATE TABLE `clubs` (
  `idClubs` int(11) NOT NULL,
  `nomClubs` varchar(255) NOT NULL,
  `codePostalClubs` varchar(45) NOT NULL,
  `villeClubs` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `clubs`
--

INSERT INTO `clubs` (`idClubs`, `nomClubs`, `codePostalClubs`, `villeClubs`) VALUES
(8, 'AS CRETEIL', '94000', 'CRETEIL'),
(9, 'AS PARIS ', '75000', 'CRETEIL'),
(10, 'AS MONTPELLIER', '34000', 'Montpellier'),
(11, 'AS LYON', '65000', 'Lyon'),
(12, 'AS LE-HAVRE', '76600', 'Le-Havre');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adherents`
--
ALTER TABLE `adherents`
  ADD PRIMARY KEY (`idAdherents`);

--
-- Index pour la table `adherents_inscrit`
--
ALTER TABLE `adherents_inscrit`
  ADD PRIMARY KEY (`idInscription`);

--
-- Index pour la table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`idClubs`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adherents`
--
ALTER TABLE `adherents`
  MODIFY `idAdherents` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `adherents_inscrit`
--
ALTER TABLE `adherents_inscrit`
  MODIFY `idInscription` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `idClubs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
