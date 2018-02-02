-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 02 fév. 2018 à 17:27
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
-- Base de données :  `tp`
--

-- --------------------------------------------------------

--
-- Structure de la table `programmes`
--

CREATE TABLE `programmes` (
  `id_programme` int(11) NOT NULL,
  `nom_du_programme` varchar(50) NOT NULL,
  `date_diffusion` varchar(250) NOT NULL,
  `heure_debut` varchar(250) NOT NULL,
  `heure_fin` varchar(250) NOT NULL,
  `image` varchar(1000) NOT NULL,
  `public` enum('tout public','accord parental indispensable') NOT NULL,
  `genre` varchar(1000) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `programmes`
--

INSERT INTO `programmes` (`id_programme`, `nom_du_programme`, `date_diffusion`, `heure_debut`, `heure_fin`, `image`, `public`, `genre`, `description`) VALUES
(1, 'programme1', '12/12/2018', '20H', '21h', 'assets/images/img1.jpg', 'tout public', 'action', 'sss'),
(2, 'programme2', '22/02/2018', '21h', '22h30', 'assets/images/img2.jpg', 'tout public', 'drame', 'sssssssssssdsff'),
(3, 'programme3', '13/12/2018', '20H', '21h', 'assets/images/img3.jpg', '', 'action', ''),
(4, 'porgramme 4 ', '30/12/2017', '15h30', '16h00', 'assets/images/img5.jpg', 'tout public', 'emision', 'sssssssssdsdfs');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `login`, `password`) VALUES
(1, 'anis', '1d8751c0eec52ac383272ae9ce46396da37f36b0');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `programmes`
--
ALTER TABLE `programmes`
  ADD PRIMARY KEY (`id_programme`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `programmes`
--
ALTER TABLE `programmes`
  MODIFY `id_programme` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
