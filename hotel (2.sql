-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 10 Mai 2017 à 14:29
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `yunacreabxap`
--

-- --------------------------------------------------------

--
-- Structure de la table `chambre`
--

CREATE TABLE IF NOT EXISTS `chambre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(3) NOT NULL,
  `type` varchar(255) NOT NULL,
  `etat` int(1) NOT NULL DEFAULT '0',
  `msg` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `chambre`
--

INSERT INTO `chambre` (`id`, `nom`, `type`, `etat`, `msg`) VALUES
(1, 'A01', 'suite', 1, NULL),
(2, 'A02', 'simple', 2, 'Hello ceci est un test'),
(3, 'A03', 'double', 2, NULL),
(4, 'A04', 'famille', 3, NULL),
(5, 'A05', 'suite', 0, NULL),
(6, 'B01', 'simple', 0, NULL),
(7, 'B02', 'simple', 0, NULL),
(8, 'B03', 'simple', 0, NULL),
(9, 'B04', 'simple', 0, NULL),
(10, 'B05', 'simple', 0, NULL),
(11, 'B06', 'simple', 0, NULL),
(12, 'B07', 'simple', 1, NULL),
(13, 'B08', 'simple', 0, NULL),
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cle` varchar(32) NOT NULL,
  `who` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `etat` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `forgotpassword`
--

INSERT INTO `forgotpassword` (`id`, `cle`, `who`, `date`, `etat`) VALUES
(1, 'FgK3pO3AUXgD9NypIGtPmGJ8ZyTNg1HR', 1, '2017-03-07 10:42:31', 0),
(2, '28cbnhi88DxWqyGfPEMKkUCCHVQWhvRW', 1, '2017-03-07 10:43:40', 0),
(3, 'P06P5b8LBNlBcT9nnII9yLq5BFiMhVUk', 1, '2017-03-07 12:52:53', 0),
(4, 'eUbR9NBn0UL8VESK34PugTDuOt0liVc1', 1, '2017-03-07 13:18:14', 1),
(5, 'AxKFvcNIEMJ0HuXKQtGMB8Gp8a9iwDtD', 5, '2017-04-30 19:27:14', 0),
(6, 'X9y7EpQJhKkTMmvZwc6425IRrgkuTE1i', 5, '2017-04-30 19:27:34', 0);

-- --------------------------------------------------------

--
-- Structure de la table `mail`
--

CREATE TABLE IF NOT EXISTS `mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `dest` int(11) NOT NULL,
  `exp` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `obj` varchar(10000) NOT NULL,
  `etat` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `mail`
--

INSERT INTO `mail` (`id`, `message`, `dest`, `exp`, `date`, `obj`, `etat`) VALUES
(9, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ac pellentesque velit, vel molestie est. Cras cursus nunc sed ipsum efficitur ultricies. Donec vel tellus sit amet tortor malesuada tincidunt at eu libero. Sed suscipit faucibus vehicula. Nullam massa lorem, lobortis in varius et, commodo ac nisi. Curabitur sem leo, tristique sed egestas vel, varius ut metus. Integer gravida nisl nulla, ac maximus felis dapibus ac. Morbi urna tortor, ullamcorper a ligula nec, gravida semper lacus. Suspendisse viverra purus sit amet imperdiet volutpat. Nullam iaculis, elit quis blandit placerat, est ante scelerisque erat, non mattis purus erat eu libero. Vestibulum dignissim aliquet ultricies. Maecenas cursus turpis id dictum gravida. Cras iaculis mauris ornare nunc rutrum, vel euismod nisl auctor. Duis consectetur id tellus a sodales. Suspendisse tincidunt condimentum elit id efficitur.\r\n\r\nCurabitur scelerisque a urna ut gravida. Morbi at mattis arcu. Quisque in odio lectus. Pellentesque nec velit et est accumsan porttitor a eget ipsum. Phasellus tellus eros, scelerisque eu posuere sed, convallis at nunc. Nam a ipsum aliquet, laoreet neque sed, varius nulla. Etiam ac erat ante. Ut posuere maximus egestas.\r\n\r\nPhasellus lacinia nisl nisi, consectetur posuere turpis faucibus eu. Ut auctor orci a nibh congue aliquam. Nulla et leo ac enim dapibus feugiat et in tellus. Nullam id convallis massa. Sed imperdiet elementum augue quis sodales. Nullam vulputate posuere tortor, eget volutpat ex venenatis eu. Mauris nisl ex, consectetur vitae libero sodales, tristique eleifend odio. Etiam feugiat vulputate consequat.\r\n\r\nMorbi ullamcorper rutrum magna quis molestie. Ut porttitor consequat lorem quis gravida. Nunc at tortor massa. Nunc laoreet sit amet odio nec convallis. Vestibulum quis quam tincidunt, tristique nunc nec, volutpat magna. Praesent pharetra turpis a felis pellentesque, id porttitor felis dignissim. Donec vitae aliquam mauris, at dapibus justo. Vestibulum porttitor sem vitae molestie feugiat. Ut nibh orci, ultrices hendrerit libero bibendum, tincidunt accumsan ipsum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec mattis massa ut arcu fringilla euismod. Morbi neque dolor, facilisis vitae est sed, blandit pretium risus. Maecenas lacinia arcu enim, in vestibulum ligula varius in. Donec consequat urna at libero tristique porttitor.\r\n\r\nQuisque varius est vel ex blandit euismod. Quisque at lobortis felis, ut varius neque. Cras nec auctor ex. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec volutpat ligula nulla, ut pulvinar justo imperdiet quis. Fusce nibh nibh, interdum ut elementum at, tincidunt et risus. Suspendisse potenti.', 2, 1, '2017-03-31 16:07:54', 'cdscdd', 0),
(10, 'dfsfdsfsd', 1, 1, '2017-04-04 09:47:11', 'Test huge message', 0),
(11, 'Ceci est un message', 1, 2, '2017-04-04 09:50:14', 'Objet test', 0),
(12, 'Saut c''est la reponse', 2, 1, '2017-04-04 09:50:26', 'Objet test', 0),
(13, 'Super sa fonctionne ', 1, 2, '2017-04-04 13:12:45', 'Objet test', 0),
(15, 'fdsfsd', 4, 5, '2017-04-30 15:38:21', 'fsdfsdfsdf', 1),
(16, 'dfgdfgfdgdfg', 5, 5, '2017-04-30 15:39:46', 'gfdgdfg', 0),
(17, 'gfdgdfgdfgdfgd', 5, 5, '2017-04-30 15:39:52', 'gfdgdfg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `arrive` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `chambre` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `reservation`
--

INSERT INTO `reservation` (`id`, `nom`, `prenom`, `arrive`, `chambre`) VALUES
(1, 'dqsdsq', 'dsqdq', '2017-03-14 15:28:22', 0),
(2, 'dsqdsq', 'dsqdqsdqsd', '2017-03-14 15:32:32', 2),
(3, 'dsqdsq', 'dqsdq', '2017-03-14 15:33:45', 7),
(4, 'cdwdsq', 'dqsdqs', '2017-03-14 15:39:38', 2),
(5, 'Janiky', 'Kevin', '2017-03-14 17:12:25', 10),
(6, 'Kevin', 'Kevin', '2017-03-17 19:35:07', 6),
(7, 'Janiky', 'kevin', '2017-03-17 19:35:45', 12),
(8, 'Janiky', 'Kevin', '2017-04-30 11:55:30', 1),
(9, 'Kevin', 'Kevin', '2017-04-30 11:58:25', 1),
(10, 'Kevin', 'rezrzer', '2017-04-30 12:31:47', 10),
(11, 'blablabla', 'blabla', '2017-04-30 15:38:06', 1),
(12, 'fsdfsdf', 'sfdsfsdf', '2017-04-30 16:23:42', 2),
(13, 'grosse pute', 'nike ta mere', '2017-05-09 12:34:17', 12);

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `cat` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Contenu de la table `stock`
--

INSERT INTO `stock` (`id`, `nom`, `cat`, `stock`) VALUES
(13, 'ThÃ© vert', 'Plateau de bienvenue', 995),
(14, 'ThÃ© menthe', 'Plateau de bienvenue', 997),
(15, 'Tasse en plastique', 'Plateau de bienvenue', 1997),
(16, 'Sucre', 'Plateau de bienvenue', 2997),
(17, 'CafÃ©', 'Plateau de bienvenue', 998),
(18, 'CuillÃ¨re en plastique', 'Plateau de bienvenue', 1998),
(19, 'Bouteille d''eau', 'Plateau de bienvenue', 4998),
(20, 'Ampoule', 'Chambres', 200),
(22, 'Poubelle', 'Chambres', 149),
(23, 'OreillÃ©', 'Chambres', 19),
(24, 'Couverture', 'Chambres', 9),
(25, 'Drap', 'Chambres', 49),
(26, 'House de couette', 'Chambres', 24),
(27, 'Savon douche', 'Chambres', 500),
(28, 'Brosse a dent', 'Chambres', 150),
(29, 'Serviette', 'Chambres', 50),
(30, 'Papier toilette', 'Chambres', 400),
(31, 'Ceintre', 'Chambres', 100),
(32, 'Peignoir de luxe', 'Chambres', 50),
(33, 'Produit vitre', 'Entretien', 1490),
(34, 'Chiffon', 'Entretien', 198),
(35, 'Dose de machine a laver', 'Entretien', 998),
(36, 'Dosage de produit sol', 'Entretien', 999),
(37, 'Gant', 'Entretien', 50),
(38, 'Coca', 'Distributeur', 99),
(39, 'Oasis', 'Distributeur', 100),
(40, 'Ice tea', 'Distributeur', 100),
(41, '7up', 'Distributeur', 100),
(42, 'Eau plate', 'Distributeur', 100),
(43, 'Eau gazeuse', 'Distributeur', 100);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mdp` varchar(32) NOT NULL,
  `dateins` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `droit` int(1) NOT NULL DEFAULT '3',
  `mail` varchar(255) NOT NULL,
  `whoisconnected` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `mdp`, `dateins`, `droit`, `mail`, `whoisconnected`) VALUES
(1, 'JANIKY', 'Kevin', '21232f297a57a5a743894a0e4a801fc3', '2017-03-06 20:00:11', 1, 'kevin.janiky@gmail.com', 0),
(5, 'Kevin', 'Janiky', '21232f297a57a5a743894a0e4a801fc3', '2017-04-30 15:22:12', 2, 'accueil@gmail.com', 0),
(6, 'nettoyage', 'nettoyage', '21232f297a57a5a743894a0e4a801fc3', '2017-04-30 15:53:12', 3, 'an@gmail.com', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
