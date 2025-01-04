-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 04 jan. 2025 à 11:18
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `restaurant`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20241230144112', '2025-01-03 13:50:52', 13120),
('DoctrineMigrations\\Version20241230153840', '2025-01-03 13:51:05', 345),
('DoctrineMigrations\\Version20241231161541', '2025-01-03 13:51:05', 818);

-- --------------------------------------------------------

--
-- Structure de la table `menu_categories`
--

DROP TABLE IF EXISTS `menu_categories`;
CREATE TABLE IF NOT EXISTS `menu_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `menu_categories`
--

INSERT INTO `menu_categories` (`id`, `name`, `created_at`) VALUES
(1, 'Bento', '2025-01-03 15:00:00'),
(2, 'A la carte', '2025-01-03 15:05:00'),
(3, 'Omusubi', '2025-01-03 15:06:00'),
(4, 'Sandwich', '2025-01-03 15:06:00'),
(5, 'Dessert', '2025-01-03 15:07:00');

-- --------------------------------------------------------

--
-- Structure de la table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `menu_categories_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_size` int DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_70B2CA2A4D14121` (`menu_categories_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_categories_id`, `name`, `description`, `price`, `stock_quantity`, `created_at`, `image_name`, `image_size`, `updated_at`) VALUES
(1, 1, 'Omusubi', '2 Omusubis, fried chicken, omelette and edamame', 9.50, 11, '2025-01-03 17:08:00', 'bento-01-67780b800a3d1262421672.jpg', 908569, '2025-01-03 16:08:32'),
(2, 1, 'Vegan', '2 Omusubis, croquette, teriyaki tofu and edamame', 9.50, 7, '2025-01-03 17:58:00', 'bento-02-677817519da9e880702416.jpg', 38179, '2025-01-03 16:58:57'),
(3, 1, 'Kare rice', 'Japanese curry', 9.00, 5, '2025-01-03 18:34:00', 'bento-03-67781f95d703d975039918.jpg', 521479, '2025-01-03 17:34:13'),
(4, 2, 'Yakitori', 'Chicken skewer with teriyaki sauce', 2.50, 8, '2025-01-03 18:41:00', 'carte-02-6778214af1b84967800874.jpg', 613276, '2025-01-03 17:41:31'),
(5, 2, 'Karaage', 'Japanese fried chicken', 7.50, 6, '2025-01-03 18:43:00', 'carte-03-677821ca2d543506855071.jpg', 592335, '2025-01-03 17:43:38'),
(6, 3, 'Kombu', 'Preserved seaweed in soy sauce', 2.80, 6, '2025-01-04 11:53:00', 'omusubi-01-6779132a5dd56359604517.jpg', 166388, '2025-01-04 10:53:30'),
(7, 3, 'Takana', 'Pickled mustard leaves', 2.80, 8, '2025-01-04 11:55:00', 'omusubi-02-677913a449408352397857.jpg', 1293699, '2025-01-04 10:55:32'),
(8, 3, 'Salmon', 'Salted salmon', 3.20, 6, '2025-01-04 11:58:00', 'omusubi-03-677914440ecc4550486773.jpg', 80725, '2025-01-04 10:58:12'),
(9, 4, 'Tamago', 'Egg sandwich', 4.80, 4, '2025-01-04 11:59:00', 'sandwich-01-6779148fc2fcb502011104.jpg', 63990, '2025-01-04 10:59:27'),
(10, 4, 'Tonkatsu', 'Crispy pork sandwich', 6.20, 7, '2025-01-04 12:01:00', 'sandwich-02-6779151fd77ac048336824.jpg', 169137, '2025-01-04 11:01:51'),
(11, 5, 'Japanna Cotta', 'Matcha panna cotta', 3.50, 5, '2025-01-04 12:05:00', 'dessert-01-677915e92ffe6136281675.jpg', 110892, '2025-01-04 11:05:13'),
(12, 5, 'Mochidora', 'Mochi pancake with red bean paste', 2.20, 9, '2025-01-04 12:06:00', 'dessert-02-67791657227bc369107867.jpg', 454712, '2025-01-04 11:07:03');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `orders_id` int DEFAULT NULL,
  `menu_items_id` int DEFAULT NULL,
  `quantity` int NOT NULL,
  `subtotal_price` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_62809DB0CFFE9AD6` (`orders_id`),
  KEY `IDX_62809DB047E1EB12` (`menu_items_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(2, 'admin@admin.com', '[]', '$2y$13$Z//8Zcg/EVHSOuLI3bG3vORWmDYo9qB9ppTpHrKomO6qIBO3IYUJS');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `FK_70B2CA2A4D14121` FOREIGN KEY (`menu_categories_id`) REFERENCES `menu_categories` (`id`);

--
-- Contraintes pour la table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `FK_62809DB047E1EB12` FOREIGN KEY (`menu_items_id`) REFERENCES `menu_items` (`id`),
  ADD CONSTRAINT `FK_62809DB0CFFE9AD6` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
