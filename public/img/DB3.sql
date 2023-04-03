-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour forumgk
CREATE DATABASE IF NOT EXISTS `forumgk` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `forumgk`;

-- Listage de la structure de table forumgk. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `label` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  PRIMARY KEY (`id_category`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table forumgk.category : ~3 rows (environ)
INSERT INTO `category` (`id_category`, `label`) VALUES
	(1, 'Domestique'),
	(2, 'Sauvage'),
	(3, 'Dangeureux');

-- Listage de la structure de table forumgk. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `text` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `datePost` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL,
  `topic_id` int NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `FK_postToTopic` (`topic_id`),
  KEY `FK_postToUser` (`user_id`),
  CONSTRAINT `FK_postToTopic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`),
  CONSTRAINT `FK_postToUser` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table forumgk.post : ~6 rows (environ)
INSERT INTO `post` (`id_post`, `text`, `datePost`, `user_id`, `topic_id`) VALUES
	(1, 'lorem ipsum', '2023-03-28 00:00:00', 2, 4),
	(2, 'lotem', '2023-03-28 15:36:20', 1, 2),
	(5, 'test', '2023-04-03 14:22:42', 12, 4),
	(13, 'Combien ca donne  5 + 5 ?', '2023-04-03 15:26:41', 13, 4),
	(14, 'Je crois que c&#039;est 10', '2023-04-03 15:27:23', 12, 4),
	(15, 'dqqzdqzdqzdqdz', '2023-04-03 15:33:30', 12, 11);

-- Listage de la structure de table forumgk. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_id` int NOT NULL,
  `user_id` int NOT NULL,
  `closed` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_topic`) USING BTREE,
  KEY `FK_topicToCategory` (`category_id`),
  KEY `FK_topicToUser` (`user_id`),
  CONSTRAINT `FK_topicToCategory` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`),
  CONSTRAINT `FK_topicToUser` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table forumgk.topic : ~5 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `creationDate`, `category_id`, `user_id`, `closed`) VALUES
	(1, 'Topic chien', '2023-03-27 00:00:00', 1, 1, 1),
	(2, 'Topic chat', '2022-02-18 00:00:00', 1, 1, 1),
	(3, 'Topic poisson', '2021-01-08 00:00:00', 1, 1, 1),
	(4, 'Topic tortue', '2023-03-28 00:00:00', 2, 1, 1),
	(5, 'Topic serpent', '2020-09-12 00:00:00', 2, 1, 1),
	(11, 'Tortue malade', '2023-04-03 15:33:30', 2, 12, 1);

-- Listage de la structure de table forumgk. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `dateCreate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `role` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT 'user',
  `status` int DEFAULT '1',
  PRIMARY KEY (`id_user`) USING BTREE,
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `pseudonyme` (`pseudo`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table forumgk.user : ~5 rows (environ)
INSERT INTO `user` (`id_user`, `pseudo`, `password`, `dateCreate`, `email`, `role`, `status`) VALUES
	(1, 'pseudo', ',zfo,zego', '2023-03-27 00:00:00', 'nnzeginjg@sokngesg.fr', 'user', 1),
	(2, 'Guillaume', 'sfsfsf', '2023-03-28 00:00:00', 'fsfsfsfsf@dqdqd.fr', 'admin', 1),
	(12, 'user', '$2y$10$nEINEoM.xd7iK62sW6cvP.CSv.K.mbTj3WelskexPTNRVKOBTpxuu', '2023-03-31 08:31:50', 'user@user', 'user', 1),
	(13, 'admin', '$2y$10$Ig97TPeiqtzwy7oHyJsnn.kr0KmTlVSTnGQESkAXnM7Tw0Ur52J6u', '2023-03-31 08:34:31', 'admin@admin', 'admin', 1),
	(14, 'ban', '$2y$10$NtbFAx/Od55mBPWXfF1ta.ctwY3KKsHRRdqhqtfspyuM7I0WlK7x2', '2023-03-31 14:56:25', 'ban@ban', 'user', 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
