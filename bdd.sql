-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           5.7.19 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Export de la structure de la base pour homestead
CREATE DATABASE IF NOT EXISTS `homestead` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `homestead`;

-- Export de la structure de la table homestead. image
CREATE TABLE IF NOT EXISTS `image` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `src` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `image_user_id_foreign` (`user_id`),
  CONSTRAINT `image_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Export de données de la table homestead.image : ~0 rows (environ)
DELETE FROM `image`;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
/*!40000 ALTER TABLE `image` ENABLE KEYS */;

-- Export de la structure de la table homestead. image_tag
CREATE TABLE IF NOT EXISTS `image_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `image_tag_image_id_foreign` (`image_id`),
  KEY `image_tag_tag_id_foreign` (`tag_id`),
  CONSTRAINT `image_tag_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `image_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tagging_tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Export de données de la table homestead.image_tag : ~0 rows (environ)
DELETE FROM `image_tag`;
/*!40000 ALTER TABLE `image_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `image_tag` ENABLE KEYS */;

-- Export de la structure de la table homestead. migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Export de données de la table homestead.migrations : ~8 rows (environ)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_01_07_073615_create_tagged_table', 1),
	(2, '2014_01_07_073615_create_tags_table', 1),
	(3, '2014_10_12_000000_create_users_table', 1),
	(4, '2014_10_12_100000_create_password_resets_table', 1),
	(5, '2016_06_29_073615_create_tag_groups_table', 1),
	(6, '2016_06_29_073615_update_tags_table', 1),
	(7, '2018_05_29_131431_create_image_table', 1),
	(8, '2018_06_01_112357_create_image_tag_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Export de la structure de la table homestead. password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Export de données de la table homestead.password_resets : ~0 rows (environ)
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Export de la structure de la table homestead. tagging_tagged
CREATE TABLE IF NOT EXISTS `tagging_tagged` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `taggable_id` int(10) unsigned NOT NULL,
  `taggable_type` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag_name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag_slug` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tagging_tagged_taggable_id_index` (`taggable_id`),
  KEY `tagging_tagged_taggable_type_index` (`taggable_type`),
  KEY `tagging_tagged_tag_slug_index` (`tag_slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Export de données de la table homestead.tagging_tagged : ~0 rows (environ)
DELETE FROM `tagging_tagged`;
/*!40000 ALTER TABLE `tagging_tagged` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagging_tagged` ENABLE KEYS */;

-- Export de la structure de la table homestead. tagging_tags
CREATE TABLE IF NOT EXISTS `tagging_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag_group_id` int(10) unsigned DEFAULT NULL,
  `slug` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suggest` tinyint(1) NOT NULL DEFAULT '0',
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tagging_tags_slug_index` (`slug`),
  KEY `tagging_tags_tag_group_id_foreign` (`tag_group_id`),
  CONSTRAINT `tagging_tags_tag_group_id_foreign` FOREIGN KEY (`tag_group_id`) REFERENCES `tagging_tag_groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Export de données de la table homestead.tagging_tags : ~0 rows (environ)
DELETE FROM `tagging_tags`;
/*!40000 ALTER TABLE `tagging_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagging_tags` ENABLE KEYS */;

-- Export de la structure de la table homestead. tagging_tag_groups
CREATE TABLE IF NOT EXISTS `tagging_tag_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tagging_tag_groups_slug_index` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Export de données de la table homestead.tagging_tag_groups : ~0 rows (environ)
DELETE FROM `tagging_tag_groups`;
/*!40000 ALTER TABLE `tagging_tag_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagging_tag_groups` ENABLE KEYS */;

-- Export de la structure de la table homestead. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Export de données de la table homestead.users : ~2 rows (environ)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `admin`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'azerty', 'azerty@azerty.azerty', '$2y$10$rClWFk0FO1up6bc0ND1HAuQr33lSHYpjVT6OOImgfJpJHv4hrzlta', 0, 'WzoGSWftMeaN8lVcLZtcUytaSAiTgLaFoBb1EoubJklmJ55MNoh1IkZLa3KO', '2018-06-21 09:00:25', '2018-06-21 09:00:25'),
	(2, 'admin', 'admin@admin.admin', '$2y$10$JhogLoehMVCja2960p2V3eacEinCi3PRw7DZXSbU867Z9LBmYUCWq', 1, 'VkwXT92CFjLEms4Ippo8D3OsAEyGf9vHan6c1xFnXtd6YdJJK95FSNN2OfWR', '2018-06-21 09:01:43', '2018-06-21 09:01:43');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
