-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mar. 05 déc. 2017 à 13:01
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bdd_mjc`
--
CREATE DATABASE IF NOT EXISTS `bdd_mjc` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bdd_mjc`;

-- --------------------------------------------------------

--
-- Structure de la table `activites`
--

CREATE TABLE `activites` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prix` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `activites`
--

INSERT INTO `activites` (`id`, `nom`, `prix`) VALUES
(1, 'artistiques', '200'),
(2, 'musicales', '180'),
(3, 'sportives', '150'),
(4, 'devperso', '220');

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

CREATE TABLE `inscription` (
  `id_utilisateur` int(11) NOT NULL,
  `id_activite` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  `prix` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `inscription`
--

INSERT INTO `inscription` (`id_utilisateur`, `id_activite`, `date`, `prix`) VALUES
(1, 1, '2017-12-05 00:00:00', '200'),
(1, 3, NULL, '120'),
(1, 4, NULL, '176');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `login` varchar(3) NOT NULL,
  `password` varchar(12) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `role` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `login`, `password`, `mail`, `role`) VALUES
(1, 'dti', 'azerty', 'david.tissot@ac-grenoble.fr', 'admin'),
(2, 'btr', 'azerty', 'brigitte.tricot@ac-grenoble.fr', 'admin'),
(3, 'pco', 'azerty', 'philippe.cosson@ac-grenoble.fr', 'admin'),
(4, 'gna', 'azerty', 'gerard.naville@ac-grenoble.fr', 'admin'),
(5, 'gde', 'qsdfg', 'ginette.delarue@gmail.com', 'user'),
(6, 'gde', 'qsdfg', 'gaston.desbiolles@gmail.com', 'user'),
(7, 'apo', 'qsdfg', 'annette.poirier@gmail.com', 'user'),
(8, 'xpe', 'qsdfg', 'xavier.perrier@gmail.com', 'user'),
(9, 'dmu', 'qsdfg', 'damien.murier@gmail.com', 'user'),
(10, 'qsa', 'qsdfg', 'quentin.salvi@gmail.com', 'user');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activites`
--
ALTER TABLE `activites`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD PRIMARY KEY (`id_utilisateur`,`id_activite`),
  ADD KEY `id_activite` (`id_activite`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activites`
--
ALTER TABLE `activites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `inscription_ibfk_1` FOREIGN KEY (`id_activite`) REFERENCES `activites` (`id`),
  ADD CONSTRAINT `inscription_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
