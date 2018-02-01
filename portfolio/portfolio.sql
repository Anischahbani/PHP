-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 01 fév. 2018 à 17:27
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
-- Base de données :  `portfolio`
--

-- --------------------------------------------------------

--
-- Structure de la table `competences`
--

CREATE TABLE `competences` (
  `id_comtpetence` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `couleur` varchar(7) NOT NULL,
  `pourcentage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `competences`
--

INSERT INTO `competences` (`id_comtpetence`, `titre`, `couleur`, `pourcentage`) VALUES
(1, 'competence', '#ffd1ae', 20),
(2, 'competence2', 'skyblue', 40),
(3, 'competence3', 'red', 60);

-- --------------------------------------------------------

--
-- Structure de la table `experiences`
--

CREATE TABLE `experiences` (
  `id_experience` int(11) NOT NULL,
  `annee_fin` int(11) NOT NULL,
  `annee_debut` int(11) NOT NULL,
  `job` varchar(500) NOT NULL,
  `job_desc` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `experiences`
--

INSERT INTO `experiences` (`id_experience`, `annee_fin`, `annee_debut`, `job`, `job_desc`) VALUES
(1, 2015, 2014, 'experience 1', 'desc experrience 1');

-- --------------------------------------------------------

--
-- Structure de la table `formations`
--

CREATE TABLE `formations` (
  `id_formation` int(11) NOT NULL,
  `annee` int(11) NOT NULL,
  `universite` varchar(500) NOT NULL,
  `universite_desc` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `formations`
--

INSERT INTO `formations` (`id_formation`, `annee`, `universite`, `universite_desc`) VALUES
(1, 2011, 'université 1 ', 'université desc 1 '),
(2, 2010, 'université2', 'université desc2');

-- --------------------------------------------------------

--
-- Structure de la table `langages`
--

CREATE TABLE `langages` (
  `id_langage` int(11) NOT NULL,
  `image` varchar(250) NOT NULL,
  `alternatif` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `langages`
--

INSERT INTO `langages` (`id_langage`, `image`, `alternatif`) VALUES
(1, 'images/HTML.jpg', 'HTML'),
(2, 'images/PHP.jpg', 'PHP');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id_messaga` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `objet` varchar(150) NOT NULL,
  `msg` text NOT NULL,
  `datemessage` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id_messaga`, `email`, `objet`, `msg`, `datemessage`) VALUES
(4, 'anischahbani@gmail.com', 'objet11', 'fffffffffffff\r\n', '0000-00-00 00:00:00'),
(5, 'client1@ff.fr', 'objet112', 'mmmmmmmmmmmmmmmmm', '2018-02-01 14:38:08'),
(6, 'client1@ff.fr', 'objet112', 'mmmmmmmmmmmmmmmmm', '2018-02-01 14:55:36');

-- --------------------------------------------------------

--
-- Structure de la table `realisations`
--

CREATE TABLE `realisations` (
  `id_realisation` int(11) NOT NULL,
  `image` varchar(250) NOT NULL,
  `alternatif` varchar(50) NOT NULL,
  `legende` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `realisations`
--

INSERT INTO `realisations` (`id_realisation`, `image`, `alternatif`, `legende`) VALUES
(1, 'images/image1.jpg', 'réalisation 1', 'Création du site1');

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
-- Index pour la table `competences`
--
ALTER TABLE `competences`
  ADD PRIMARY KEY (`id_comtpetence`);

--
-- Index pour la table `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`id_experience`);

--
-- Index pour la table `formations`
--
ALTER TABLE `formations`
  ADD PRIMARY KEY (`id_formation`);

--
-- Index pour la table `langages`
--
ALTER TABLE `langages`
  ADD PRIMARY KEY (`id_langage`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_messaga`);

--
-- Index pour la table `realisations`
--
ALTER TABLE `realisations`
  ADD PRIMARY KEY (`id_realisation`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `competences`
--
ALTER TABLE `competences`
  MODIFY `id_comtpetence` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `experiences`
--
ALTER TABLE `experiences`
  MODIFY `id_experience` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `formations`
--
ALTER TABLE `formations`
  MODIFY `id_formation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `langages`
--
ALTER TABLE `langages`
  MODIFY `id_langage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id_messaga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `realisations`
--
ALTER TABLE `realisations`
  MODIFY `id_realisation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
