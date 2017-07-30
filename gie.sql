-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Ven 16 Juin 2017 à 14:35
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gie`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `IdClient` int(5) NOT NULL,
  `NomClient` varchar(50) NOT NULL,
  `PrenomClient` varchar(30) NOT NULL,
  `JourNaissance` int(2) NOT NULL,
  `MoisNaissance` varchar(20) NOT NULL,
  `AnneeNaissance` int(5) NOT NULL,
  `TelephoneClient` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `clients`
--

INSERT INTO `clients` (`IdClient`, `NomClient`, `PrenomClient`, `JourNaissance`, `MoisNaissance`, `AnneeNaissance`, `TelephoneClient`) VALUES
(1, 'TAIWO', 'Adechola Elisabeth', 15, 'Mai', 1992, '+2213698741'),
(2, 'BOUGUENZA', 'Bradley', 19, 'Octobre', 1994, '+24106854789'),
(3, 'MOUELE', 'Jesckha', 14, 'Octobre', 2002, '+2210523654');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `IdCommande` int(5) NOT NULL,
  `MoisCommande` varchar(15) DEFAULT NULL,
  `AnneCommande` int(5) DEFAULT NULL,
  `NumClient` int(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commandes`
--

INSERT INTO `commandes` (`IdCommande`, `MoisCommande`, `AnneCommande`, `NumClient`) VALUES
(1, 'Avril', 2017, 1),
(2, 'Mars', 2017, 2),
(3, 'Janvier', 1990, 3);

-- --------------------------------------------------------

--
-- Structure de la table `details`
--

CREATE TABLE `details` (
  `NumCommande` int(5) DEFAULT NULL,
  `NumProduit` int(5) DEFAULT NULL,
  `Qte` int(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `details`
--

INSERT INTO `details` (`NumCommande`, `NumProduit`, `Qte`) VALUES
(1, 1, 2),
(2, 2, 2),
(1, 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `IdProduit` int(5) NOT NULL,
  `LibProduit` varchar(50) NOT NULL,
  `PrixUnitaireProduit` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `produits`
--

INSERT INTO `produits` (`IdProduit`, `LibProduit`, `PrixUnitaireProduit`) VALUES
(1, 'Iphone 4 c', 160000),
(2, 'Iphone 5 c', 165000);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `IdUser` int(5) NOT NULL,
  `NomUser` varchar(50) NOT NULL,
  `MdpUser` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`IdUser`, `NomUser`, `MdpUser`) VALUES
(1, 'clea', 'keelian'),
(2, 'sarah', 'lebeau');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`IdClient`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`IdCommande`),
  ADD KEY `NumClient` (`NumClient`);

--
-- Index pour la table `details`
--
ALTER TABLE `details`
  ADD KEY `NumCommande` (`NumCommande`),
  ADD KEY `NumProduit` (`NumProduit`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`IdProduit`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`IdUser`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `IdClient` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `IdCommande` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `IdProduit` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `IdUser` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
