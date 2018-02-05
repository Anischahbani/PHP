-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 05 fév. 2018 à 14:28
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
-- Base de données :  `exercice_3`
--

-- --------------------------------------------------------

--
-- Structure de la table `movies`
--

CREATE TABLE `movies` (
  `id_movie` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `actors` varchar(255) NOT NULL,
  `director` varchar(255) NOT NULL,
  `producer` varchar(255) NOT NULL,
  `year_of_prod` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `category` enum('action','drame','comedie','thriller') NOT NULL,
  `storyline` text NOT NULL,
  `video` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `movies`
--

INSERT INTO `movies` (`id_movie`, `title`, `actors`, `director`, `producer`, `year_of_prod`, `language`, `category`, `storyline`, `video`) VALUES
(1, 'Forrest Gump', 'Tom Hanks, Gary Sinise, Robin Wright ', 'Robert Zemeckis ', 'Steve Starkey', '1994', 'English', 'drame', 'Quelques décennies d\'histoire américaine, des années 1940 à la fin du XXème siècle, à travers le regard et l\'étrange odyssée d\'un homme simple et pur, Forrest Gump. ', 'http://www.allocine.fr/video/player_gen_cmedia=19376882&cfilm=10568.html'),
(2, 'Gladiator', 'Russell Crowe, Joaquin Phoenix, Connie Nielsen ', 'Ridley Scott ', 'Steve Starkey', '2000', 'English', 'action', 'Le général romain Maximus est le plus fidèle soutien de l\'empereur Marc Aurèle, qu\'il a conduit de victoire en victoire avec une bravoure et un dévouement exemplaires. Jaloux du prestige de Maximus, et plus encore de l\'amour que lui voue l\'empereur, le fils de MarcAurèle, Commode, s\'arroge brutalement le pouvoir, puis ordonne l\'arrestation du général et son exécution. Maximus échappe à ses assassins mais ne peut empêcher le massacre de sa famille. Capturé par un marchand d\'esclaves, il devient gladiateur et prépare sa vengeance. ', 'http://www.allocine.fr/video/player_gen_cmedia=19376512&cfilm=24944.html'),
(3, 'Lion', ' Dev Patel, Rooney Mara, Nicole Kidman ', 'Garth Davis ', 'Steve Starkey', '2017', 'English', 'drame', 'Une incroyable histoire vraie : à 5 ans, Saroo se retrouve seul dans un train traversant l’Inde qui l’emmène malgré lui à des milliers de kilomètres de sa famille. Perdu, le petit garçon doit apprendre à survivre seul dans l’immense ville de Calcutta. Après des mois d’errance, il est recueilli dans un orphelinat et adopté par un couple d’Australiens.\r\n25 ans plus tard, Saroo est devenu un véritable Australien, mais il pense toujours à sa famille en Inde.\r\nArmé de quelques rares souvenirs et d’une inébranlable détermination, il commence à parcourir des photos satellites sur Google Earth, dans l’espoir de reconnaître son village.\r\nMais peut-on imaginer retrouver une simple famille dans un pays d’un milliard d’habitants ?', 'http://www.allocine.fr/video/player_gen_cmedia=19567433&cfilm=229070.html'),
(4, 'Django Unchained', ' Jamie Foxx, Christoph Waltz, Leonardo DiCaprio', 'Quentin Tarantino', 'Steve Starkey', '2013', 'English', 'action', 'Dans le sud des États-Unis, deux ans avant la guerre de Sécession, le Dr King Schultz, un chasseur de primes allemand, fait l’acquisition de Django, un esclave qui peut l’aider à traquer les frères Brittle, les meurtriers qu’il recherche. Schultz promet à Django de lui rendre sa liberté lorsqu’il aura capturé les Brittle – morts ou vifs.\r\nAlors que les deux hommes pistent les dangereux criminels, Django n’oublie pas que son seul but est de retrouver Broomhilda, sa femme, dont il fut séparé à cause du commerce des esclaves…\r\nLorsque Django et Schultz arrivent dans l’immense plantation du puissant Calvin Candie, ils éveillent les soupçons de Stephen, un esclave qui sert Candie et a toute sa confiance. Le moindre de leurs mouvements est désormais épié par une dangereuse organisation de plus en plus proche… Si Django et Schultz veulent espérer s’enfuir avec Broomhilda, ils vont devoir choisir entre l’indépendance et la solidarité, entre le sacrifice et la survie… ', 'http://www.allocine.fr/video/player_gen_cmedia=19353314&cfilm=190918.html');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id_movie`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `movies`
--
ALTER TABLE `movies`
  MODIFY `id_movie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
