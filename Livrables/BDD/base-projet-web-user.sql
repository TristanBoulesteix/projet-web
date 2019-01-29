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
-- Base de données :  `projet-web-user`
--

DELIMITER $$
--
-- Procédures
--
DROP PROCEDURE IF EXISTS `allUsers`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `allUsers` ()  BEGIN
SELECT users.id, `users`.first_name, `users`.last_name, `users`.email, roles.role, `campus`.name 
FROM `users` 
INNER JOIN roles ON roles.id =`users`.role 
INNER JOIN `campus` ON campus.id = `users`.campus;
END$$

DROP PROCEDURE IF EXISTS `campusID`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `campusID` (IN `campus_name` VARCHAR(255))  BEGIN 
	SELECT `id` 
	FROM `campus`
	WHERE `name`= campus_name;
END$$

DROP PROCEDURE IF EXISTS `campusName`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `campusName` ()  BEGIN
	SELECT `name` 
	FROM `campus`;
END$$

DROP PROCEDURE IF EXISTS `changeUser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `changeUser` (IN `id_user` INT(255), IN `selection` INT)  BEGIN
	UPDATE  `users`
	SET role = selection
	WHERE `id` = id_user;
END$$

DROP PROCEDURE IF EXISTS `idPerCampus`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `idPerCampus` (IN `campus_id` INT)  BEGIN 
	SELECT `name` 
	FROM `campus`
	WHERE `id_campus`= campus_id;
END$$

DROP PROCEDURE IF EXISTS `rolePerId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `rolePerId` (IN `role_name` VARCHAR(255))  NO SQL
BEGIN
	SELECT id FROM roles WHERE roles.role = role_name;
END$$

DROP PROCEDURE IF EXISTS `rolPerUser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `rolPerUser` (`name` VARCHAR(255))  BEGIN
	SELECT `role`
	FROM `roles`
	INNER JOIN `user` ON role.id=user.role
	WHERE `first_name` = name;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `campus`
--

DROP TABLE IF EXISTS `campus`;
CREATE TABLE IF NOT EXISTS `campus` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `campus`
--

INSERT INTO `campus` (`id`, `name`) VALUES
(1, 'Lyon');

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'Student'),
(2, 'CESI'),
(3, 'BDE');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `campus` int(11) NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_foreign` (`role`),
  KEY `users_campus_foreign` (`campus`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `role`, `campus`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Tristan', 'BOULESTEIX', 'tristan.boulesteix@gmail.com', 1, 1, '$2y$10$DysZBrEvtvgE7SOgd.DK8.4kK/bGavY8mJKw6BAM/MmmAbnzSs5OK', 'fICRjZSl0CpfaLDXoNDHLJi9aRsP3CbyEmKKuJXVg78LbS4lGSlW2Tve1a82', '2019-01-28 09:12:34', '2019-01-28 09:12:34'),
(2, 'Bureau', 'des élèves', 'testustest00@gmail.com', 3, 1, '$2y$10$2UnWlMnaxegPyW5Tl0dnJuUBhBvLtiSi5V2mFdlwYxXvb7Ktu6HgW', 'vHz5CZbC4372lYUoSUx7FBYGfqF4EhLQDLbKRACe7Vu80ky9JFpTheJDISoq', '2019-01-28 09:14:38', '2019-01-28 09:14:38'),
(3, 'CESI', 'EXIA', 'tristan.boulesteix@viacesi.fr', 2, 1, '$2y$10$3KWmLrhwvbLRpBCfT83F3OV6ct8h4ylzEto2weIgZWNQqTfU4CvB6', NULL, '2019-01-29 08:23:41', '2019-01-29 08:23:41');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
