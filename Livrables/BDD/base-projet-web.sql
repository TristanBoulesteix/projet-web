-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 29 jan. 2019 à 10:58
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet-web`
--

DELIMITER $$
--
-- Procédures
--
DROP PROCEDURE IF EXISTS `addLike`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `addLike` (`id_image` INT)  BEGIN
	UPDATE `images` 
	SET `votes` = `votes` + 1 
	WHERE `id` = id_image ;
END$$

DROP PROCEDURE IF EXISTS `addLikeIdea`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `addLikeIdea` (`id_idea` INT)  BEGIN
	UPDATE `ideas` 
	SET `votes` = `votes` + 1 
	WHERE `id` = id_idea ;
END$$

DROP PROCEDURE IF EXISTS `allProducts`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `allProducts` ()  BEGIN
	SELECT `name`, `description`, `price`, `id_category`
	FROM `products`;
END$$

DROP PROCEDURE IF EXISTS `categories`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `categories` ()  BEGIN
	SELECT `id_category`,`name_category`
	FROM `categories`;
END$$

DROP PROCEDURE IF EXISTS `categoryPerProducts`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `categoryPerProducts` (IN `category` VARCHAR(255))  BEGIN
SET FOREIGN_KEY_CHECKS = ON;
    SELECT `products`.`id`,`products`.`name`,`description`,`price`
	FROM `products`
	INNER JOIN `categories` ON products.`id_category`= categories.id
	WHERE `category` = category;
END$$

DROP PROCEDURE IF EXISTS `commentPerImage`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `commentPerImage` (IN `image_id` INT)  BEGIN 
	SELECT `comment`.`comment`
	FROM `comment`
	INNER JOIN `images` ON comment.`id_image`= images.id
	WHERE `id_image`= image_id;
END$$

DROP PROCEDURE IF EXISTS `ideas`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ideas` ()  BEGIN
	SELECT *
	FROM `ideas`;
END$$

DROP PROCEDURE IF EXISTS `idPerCampus`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `idPerCampus` (IN `campus_id` INT)  BEGIN 
	SELECT `name` 
	FROM `campus`
	WHERE `id_campus`= campus_id;
END$$

DROP PROCEDURE IF EXISTS `imagePerEvent`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `imagePerEvent` (IN `event` INT)  BEGIN 
	SELECT `images`.`id`,`images`.`image`,`votes` 
	FROM `images`
	INNER JOIN `events` ON images.`id_event`= events.id
	WHERE `id_event`= event;
END$$

DROP PROCEDURE IF EXISTS `oldEvent`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `oldEvent` ()  BEGIN
    SELECT `id`,name,`description`, `date`,`type`,`cost`, `image`, `name`
	FROM `events`
	WHERE `date` < CURRENT_DATE();
END$$

DROP PROCEDURE IF EXISTS `productPerCategory`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `productPerCategory` ()  BEGIN
    SELECT `products`.`id`,`products`.`name`,`description`,`price`,`image`, `category`
	FROM `products`
	INNER JOIN `categories` ON products.`id_category`= categories.id;
END$$

DROP PROCEDURE IF EXISTS `recentEvent`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `recentEvent` ()  BEGIN
    SELECT `id`,name,`description`, `date`,`type`,`cost`, `image`
	FROM `events`
	WHERE `date` > CURRENT_DATE();
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(1, 'neutre'),
(2, 'Salade'),
(3, 'Salade'),
(4, 'Salade'),
(5, 'Salade'),
(6, 'Salade'),
(7, 'Salade');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `comment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_image` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_id_image_foreign` (`id_image`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `image`, `date`, `type`, `cost`) VALUES
(1, 'Tristan', 'The test !!!!!!!!!!!', 'Tristan-1548683967.jpg', '2019-01-16', 'weekly', '50.00'),
(2, 'Test', 'Ceci est un test !!!', 'Test-1548717002.jpg', '2019-01-29', 'weekly', '0.00'),
(3, 'idée', 'boite', 'idée-1548752485.jpg', '2019-01-31', 'none', '0.00');

-- --------------------------------------------------------

--
-- Structure de la table `ideas`
--

DROP TABLE IF EXISTS `ideas`;
CREATE TABLE IF NOT EXISTS `ideas` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `votes` int(11) NOT NULL DEFAULT '0',
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ideas_id_user_foreign` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ideas`
--

INSERT INTO `ideas` (`id`, `name`, `description`, `image`, `votes`, `id_user`) VALUES
(1, 'test', 'test', 'test-1548671815.jpg', 0, 2);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `votes` int(11) NOT NULL DEFAULT '0',
  `id_event` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `images_id_event_foreign` (`id_event`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `image`, `votes`, `id_event`) VALUES
(1, '-1548748990.jpg', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `keep`
--

DROP TABLE IF EXISTS `keep`;
CREATE TABLE IF NOT EXISTS `keep` (
  `id_products` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  KEY `keep_id_products_foreign` (`id_products`),
  KEY `keep_id_user_foreign` (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=134 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(132, '2019_01_23_141007_create_keep_table', 2),
(131, '2019_01_19_135551_create_participate_table', 2),
(130, '2019_01_18_124510_create_role_table', 1),
(129, '2019_01_18_124030_create_images_table', 1),
(128, '2019_01_18_085117_create_orders_table', 1),
(127, '2019_01_18_083243_create_ideas_table', 1),
(126, '2019_01_18_082939_create_categories_table', 1),
(125, '2019_01_18_082516_create_products_table', 1),
(124, '2019_01_18_080103_create_events_table', 1),
(122, '2014_10_12_100000_create_password_resets_table', 1),
(123, '2019_01_16_151912_create_campus_table', 1),
(121, '2014_10_12_000000_create_users_table', 1),
(133, '2019_01_23_141748_create_comments_table', 2);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id_products` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  KEY `orders_id_products_foreign` (`id_products`),
  KEY `orders_id_user_foreign` (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `participate`
--

DROP TABLE IF EXISTS `participate`;
CREATE TABLE IF NOT EXISTS `participate` (
  `id_user` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  KEY `participate_id_user_foreign` (`id_user`),
  KEY `participate_id_event_foreign` (`id_event`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `participate`
--

INSERT INTO `participate` (`id_user`, `id_event`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_category` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `products_id_category_foreign` (`id_category`)
) ENGINE=MyISAM AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `id_category`) VALUES
(103, 'Tristan', 'Tomate', 15, 'Tristan-1548750085.jpg', 6),
(102, 'Salade de riz', 'Ceci est très bon !', 350, 'Salade de riz-1548682401.jpg', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
