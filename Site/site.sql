-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 02 fév. 2018 à 09:39
-- Version du serveur :  10.1.22-MariaDB
-- Version de PHP :  7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `site`
--

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(3) NOT NULL,
  `id_membre` int(3) NOT NULL,
  `montant` int(3) NOT NULL,
  `date_enregistrement` datetime NOT NULL,
  `etat` enum('en cours de traitement','envoyÃ©','livrÃ©') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `id_membre`, `montant`, `date_enregistrement`, `etat`) VALUES
(1, 3, 60, '2018-01-31 14:10:52', 'en cours de traitement'),
(2, 4, 175, '2018-01-31 14:50:06', 'en cours de traitement'),
(3, 4, 150, '2018-01-31 14:52:01', 'en cours de traitement');

-- --------------------------------------------------------

--
-- Structure de la table `details_commande`
--

CREATE TABLE `details_commande` (
  `id_details_commande` int(3) NOT NULL,
  `id_commande` int(3) NOT NULL,
  `id_produit` int(3) NOT NULL,
  `quantite` int(3) NOT NULL,
  `prix` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `details_commande`
--

INSERT INTO `details_commande` (`id_details_commande`, `id_commande`, `id_produit`, `quantite`, `prix`) VALUES
(1, 1, 1, 2, 30),
(2, 2, 1, 1, 30),
(3, 2, 5, 2, 60),
(4, 2, 15, 1, 25),
(5, 3, 10, 1, 30),
(6, 3, 12, 1, 120);

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(3) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(32) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `civilite` enum('m','f') NOT NULL,
  `ville` varchar(20) NOT NULL,
  `code_postal` int(5) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `statut` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `nom`, `prenom`, `email`, `civilite`, `ville`, `code_postal`, `adresse`, `statut`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'chahbani', 'anis', 'anischahani@gmail.com', 'm', 'paris', 75019, '', 1),
(3, 'client1', 'a165dd3c2e98d5d607181d0b87a4c66b', 'client1', 'client1', 'clien1@gmail.com', 'm', 'paris', 75014, 'message', 0),
(4, 'client2', '2c66045d4e4a90814ce9280272e510ec', 'client2', 'client2', 'client2@gmail.com', 'm', 'paris', 75014, '................', 0);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(3) NOT NULL,
  `reference` varchar(20) NOT NULL,
  `categorie` varchar(20) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `couleur` varchar(20) NOT NULL,
  `taille` varchar(5) NOT NULL,
  `public` enum('m','f','mixte') NOT NULL,
  `photo` varchar(250) NOT NULL,
  `prix` int(3) NOT NULL,
  `stock` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `reference`, `categorie`, `titre`, `description`, `couleur`, `taille`, `public`, `photo`, `prix`, `stock`) VALUES
(1, 'CH01', 'CHEMISE', 'chemise', 'chemise a carreaux', 'rouge', 'S', 'm', '/PHP/BASES/site/photo/CH01-chemise-a-carreaux.jpg', 30, 20),
(2, 'CH02', 'CHEMISE', 'chemise', 'chemise bleu', 'bleu', 'M', 'm', '/PHP/BASES/site/photo/CH02-chemise-homme.jpg', 30, 28),
(3, 'CH03', 'CHEMISE', 'chemise', 'chemise', 'bleu', 'S', 'f', '/PHP/BASES/site/photo/CH03-chemise-femme.jpg', 20, 19),
(4, 'TS01', 'POLO', 'POLO', 'polo manche courte', 'blanc', 'L', 'm', '/PHP/BASES/site/photo/TS01-polo-homme.jpg', 50, 10),
(5, 'TS02', 'POLO', 'POLO', 'polo bleu', 'bleu', 'S', 'f', '/PHP/BASES/site/photo/TS02-Polo-femme.jpg', 60, 8),
(6, 'PL01', 'PULL', 'PULL', 'pull pour homme', 'gris', 'L', 'm', '/PHP/BASES/site/photo/PL01-pull-homme.jpg', 40, 29),
(7, 'PL02', 'PULL', 'PULL', 'pull pour femme', 'blanc', 'S', 'f', '/PHP/BASES/site/photo/PL02-pull-femme.jpg', 70, 5),
(8, 'SW01', 'SWEAT', 'sweat', 'sweat gris', 'gris', 'S', 'mixte', '/PHP/BASES/site/photo/SW01-sweat.jpg', 45, 15),
(9, 'TS03', 'T_SHIRT', 't-shirt', 't-shirt blanc ', 'blanc', 'M', 'm', '/PHP/BASES/site/photo/TS03-t-shirt-homme.jpg', 50, 20),
(10, 'TS04', 'T_SHIRT', 't-shirt', 't-shirt blanc', 'blanc', 'S', 'f', '/PHP/BASES/site/photo/TS04-t-shirt-femme.jpg', 30, 9),
(11, 'MT01', 'MANTEAU', 'Manteau ', 'manteau femme', 'marron', 'M', 'f', '/PHP/BASES/site/photo/MT01-manteau-femme.jpg', 95, 12),
(12, 'MT02', 'MANTEAU', 'Manteau ', 'manteau hommr', 'beige', 'L', 'm', '/PHP/BASES/site/photo/MT02-manteau-homme.jpg', 120, 4),
(13, 'JEANS01', 'JEANS', 'JEANS', 'jeans pour homme', 'bleu clair', 'L', 'm', '/PHP/BASES/site/photo/JEANS01-jeans-homme.jpg', 150, 13),
(14, 'JEANS02', 'JEANS', 'JEANS', 'jeans pour femme', 'bleu clair', 'S', 'f', '/PHP/BASES/site/photo/JEANS02-jeans_femme.jpg', 110, 15),
(15, 'CAS01', 'CASQUETTE', 'casquette', 'casquette new era noir', 'noir', 'S', 'mixte', '/PHP/BASES/site/photo/CAS01-casquette.jpg', 25, 7);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`);

--
-- Index pour la table `details_commande`
--
ALTER TABLE `details_commande`
  ADD PRIMARY KEY (`id_details_commande`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `details_commande`
--
ALTER TABLE `details_commande`
  MODIFY `id_details_commande` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
