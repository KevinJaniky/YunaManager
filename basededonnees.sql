-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Client :
-- Généré le :  Ven 30 Juin 2017 à 11:17
-- Version du serveur :  5.6.34-log

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `yunamanager`
--

-- --------------------------------------------------------

--
-- Structure de la table `chambre`
--

CREATE TABLE IF NOT EXISTS `chambre` (
  `id` int(11) NOT NULL,
  `nom` varchar(3) NOT NULL,
  `type` varchar(255) NOT NULL,
  `etat` int(1) NOT NULL DEFAULT '0',
  `msg` text
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `chambre`
--

INSERT INTO `chambre` (`id`, `nom`, `type`, `etat`, `msg`) VALUES
(1, 'A01', 'suite', 1, NULL),
(2, 'A02', 'simple', 1, 'en travaux'),
(3, 'A03', 'double', 0, NULL),
(4, 'A04', 'famille', 2, NULL),
(5, 'A05', 'suite', 0, NULL),
(6, 'B01', 'simple', 2, NULL),
(7, 'B02', 'simple', 2, NULL),
(8, 'B03', 'simple', 0, NULL),
(9, 'B04', 'simple', 3, 'Partie de jambe en l''air qui a mal tournÃ©'),
(10, 'B05', 'simple', 0, NULL),
(11, 'B06', 'simple', 3, 'azertyuiop'),
(12, 'B07', 'simple', 0, NULL),
(13, 'B08', 'simple', 2, NULL),
(14, 'B09', 'simple', 0, NULL),
(15, 'C01', 'simple', 0, NULL),
(16, 'C02', 'simple', 0, NULL),
(17, 'C03', 'simple', 0, NULL),
(18, 'C04', 'simple', 0, NULL),
(19, 'C05', 'simple', 0, NULL),
(20, 'C06', 'simple', 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `forgotpassword`
--

CREATE TABLE IF NOT EXISTS `forgotpassword` (
  `id` int(11) NOT NULL,
  `cle` varchar(32) NOT NULL,
  `who` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `etat` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `forgotpassword`
--

INSERT INTO `forgotpassword` (`id`, `cle`, `who`, `date`, `etat`) VALUES
(1, 'FgK3pO3AUXgD9NypIGtPmGJ8ZyTNg1HR', 1, '2017-03-07 10:42:31', 0),
(2, '28cbnhi88DxWqyGfPEMKkUCCHVQWhvRW', 1, '2017-03-07 10:43:40', 0),
(3, 'P06P5b8LBNlBcT9nnII9yLq5BFiMhVUk', 1, '2017-03-07 12:52:53', 0),
(4, 'eUbR9NBn0UL8VESK34PugTDuOt0liVc1', 1, '2017-03-07 13:18:14', 1),
(5, 'AxKFvcNIEMJ0HuXKQtGMB8Gp8a9iwDtD', 5, '2017-04-30 19:27:14', 0),
(6, 'X9y7EpQJhKkTMmvZwc6425IRrgkuTE1i', 5, '2017-04-30 19:27:34', 0),
(7, 'E1frqIhuQOe02rKxm5rxRcB7V8CAE7Qb', 1, '2017-06-29 18:01:05', 1),
(8, 'VtPPD6ukjAMhf6A0GeArXdTdP86a4iNO', 1, '2017-06-29 18:01:39', 1);

-- --------------------------------------------------------

--
-- Structure de la table `mail`
--

CREATE TABLE IF NOT EXISTS `mail` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `dest` int(11) NOT NULL,
  `exp` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `obj` varchar(10000) NOT NULL,
  `etat` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `mail`
--

INSERT INTO `mail` (`id`, `message`, `dest`, `exp`, `date`, `obj`, `etat`) VALUES
(3, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras aliquet porta pharetra. Nulla facilisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec varius sed eros id euismod. Sed non mi eu lorem congue fermentum eget sed ligula. Donec condimentum nulla euismod sagittis fringilla. Nunc elementum consequat ex a pharetra. Quisque dignissim eleifend semper. Praesent cursus ac justo nec venenatis. Suspendisse viverra vel nibh non vulputate.</p>\r\n\r\n<p>Morbi non vulputate ex. Integer feugiat sit amet sem et vestibulum. Suspendisse semper metus libero, et rhoncus eros sodales eu. Proin eu accumsan libero. Quisque placerat vehicula elit eu pretium. Proin vel ante auctor, volutpat ante vel, sollicitudin felis. Etiam id odio vel nisl tempus pellentesque fringilla vel lectus. Nullam dapibus ullamcorper tempus. Nullam blandit eros in sem convallis blandit. Proin vitae magna varius, dignissim nisi in, tempus nulla. Donec vitae molestie lectus. Mauris justo est, blandit eget ultrices vitae, vehicula et risus. Cras auctor condimentum dui ut commodo.</p>', 5, 1, '2017-06-29 20:09:19', 'je suis un oobjet', 0),
(4, '<p>azereazereazereazereazere&nbsp;azereazereazereazereazereazereazereazereazereazereazereazereazere&nbsp;azereazereazereazereazereazereazereazereazereazereazereazereazere&nbsp;azereazereazereazereazereazereazereazereazereazereazereazereazere&nbsp;azereazereazereazereazereazereazereazereazereazereazereazereazere&nbsp;azereazereazereazereazereazereazereazereazereazereazereazereazere&nbsp;azereazereazereazereazereazereazereazereazereazereazereazereazere&nbsp;azereazereazereazereazereazereazereazereazereazereazereazereazere&nbsp;azereazereazereazereazereazereazereazere</p>', 5, 1, '2017-06-30 07:58:56', 'testttttttttt', 0);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `arrive` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `chambre` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `reservation`
--

INSERT INTO `reservation` (`id`, `nom`, `prenom`, `arrive`, `chambre`) VALUES
(1, 'JANIKY', 'KEVIN', '2017-06-29 20:07:01', 1),
(2, 'JANIKY', 'Kevin', '2017-06-29 21:47:49', 2),
(3, 'test', 'tzest', '2017-06-30 07:57:35', 1);

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `cat` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `stock`
--

INSERT INTO `stock` (`id`, `nom`, `cat`, `stock`) VALUES
(16, 'Sucre', 'Plateau de bienvenue', 2989),
(17, 'CafÃ©', 'Plateau de bienvenue', 990),
(18, 'CuillÃ¨re en plastique', 'Plateau de bienvenue', 1990),
(19, 'Bouteille d''eau', 'Plateau de bienvenue', 4990),
(20, 'Ampoule', 'Chambres', 200),
(22, 'Poubelle', 'Chambres', 148),
(23, 'OreillÃ©', 'Chambres', 18),
(24, 'Couverture', 'Chambres', 8),
(25, 'Drap', 'Chambres', 48),
(26, 'House de couette', 'Chambres', 24),
(27, 'Savon douche', 'Chambres', 499),
(28, 'Brosse a dent', 'Chambres', 149),
(29, 'Serviette', 'Chambres', 50),
(30, 'Papier toilette', 'Chambres', 400),
(31, 'Ceintre', 'Chambres', 100),
(32, 'Peignoir de luxe', 'Chambres', 50),
(33, 'Produit vitre', 'Entretien', 1487),
(34, 'Chiffon', 'Entretien', 197),
(35, 'Dose de machine a laver', 'Entretien', 997),
(36, 'Dosage de produit sol', 'Entretien', 997),
(37, 'Gant', 'Entretien', 49),
(38, 'Coca', 'Distributeur', 99),
(39, 'Oasis', 'Distributeur', 100),
(40, 'Ice tea', 'Distributeur', 100),
(41, '7up', 'Distributeur', 100),
(42, 'Eau plate', 'Distributeur', 100),
(43, 'Eau gazeuse', 'Distributeur', 100),
(50, 'again', 'Plateau de bienvenue', -1),
(51, 'ThÃ© vert', 'Plateau de bienvenue', 997),
(52, 'Test', 'Plateau de bienvenue', 3),
(53, 'test1', 'Plateau de bienvenue', -3);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mdp` varchar(32) NOT NULL,
  `dateins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `droit` int(1) NOT NULL DEFAULT '3',
  `mail` varchar(255) NOT NULL,
  `whoisconnected` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `mdp`, `dateins`, `droit`, `mail`, `whoisconnected`) VALUES
(1, 'JANIKY', 'Kevin', '45a6000d48e8fb7ab869f2076d3e8e60', '2017-03-06 20:00:11', 1, 'kevin.janiky@gmail.com', 1),
(5, 'Agent', 'Acceuil', '21232f297a57a5a743894a0e4a801fc3', '2017-04-30 15:22:12', 2, 'accueil@gmail.com', 0),
(6, 'Agent', 'Nettoyage', '21232f297a57a5a743894a0e4a801fc3', '2017-04-30 15:53:12', 3, 'an@gmail.com', 0),
(14, 'Agent', 'Nettoyage2', '21232f297a57a5a743894a0e4a801fc3', '2017-06-29 21:47:21', 3, 'an2@gmail.com', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `chambre`
--
ALTER TABLE `chambre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `forgotpassword`
--
ALTER TABLE `forgotpassword`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `chambre`
--
ALTER TABLE `chambre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `forgotpassword`
--
ALTER TABLE `forgotpassword`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `mail`
--
ALTER TABLE `mail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
