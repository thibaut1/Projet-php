-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 05 Décembre 2017 à 14:46
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
CREATE DATABASE IF NOT EXISTS `bibligrp3` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `bibligrp3`;
--
-- Base de données :  `bdd_biblio_grp3`
--

-- --------------------------------------------------------

--
-- Structure de la table `adhésion`
--

CREATE TABLE `adhesion` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `date_naissance` date NOT NULL,
  `date_adhesion` date NOT NULL,
  `prix_adhesion` float NOT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `id_ville` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `utilisateur`
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

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE `ville` (
  `id` int(11) NOT NULL,
  `nom_ville` varchar(20) NOT NULL,
  `tarif` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `adhésion`
--
ALTER TABLE `adhesion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_ville` (`id_ville`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ville`
--
ALTER TABLE `ville`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `adhésion`
--
ALTER TABLE `adhesion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `ville`
--
ALTER TABLE `ville`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `adhésion`
--
ALTER TABLE `adhesion`
  ADD CONSTRAINT `adhesion_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `adhesion_ibfk_2` FOREIGN KEY (`id_ville`) REFERENCES `ville` (`id`);
CREATE USER 'admin3'@'%' IDENTIFIED BY 'azerty';GRANT SELECT, INSERT ON bibligrp3.* TO 'admin3'@'%' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;GRANT ALL PRIVILEGES ON `bibligrp3`.* TO 'admin3'@'%'; 
CREATE USER 'user3'@'%' IDENTIFIED BY '12345';GRANT INSERT ON bibligrp3.adhesion TO 'user3'@'%' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;GRANT ALL PRIVILEGES ON `bibligrp3`.* TO 'admin3'@'%'; 
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
