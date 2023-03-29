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
CREATE DATABASE IF NOT EXISTS `forumgk` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `forumgk`;

-- Listage de la structure de table forumgk. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `label` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  PRIMARY KEY (`id_category`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forumgk.category : ~0 rows (environ)
INSERT INTO `category` (`id_category`, `label`) VALUES
	(1, 'Domestique'),
	(2, 'Sauvage');

-- Listage de la structure de table forumgk. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `text` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin,
  `datePost` date NOT NULL,
  `user_id` int NOT NULL,
  `topic_id` int NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `FK_postToTopic` (`topic_id`),
  KEY `FK_postToUser` (`user_id`),
  CONSTRAINT `FK_postToTopic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`),
  CONSTRAINT `FK_postToUser` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forumgk.post : ~0 rows (environ)
INSERT INTO `post` (`id_post`, `text`, `datePost`, `user_id`, `topic_id`) VALUES
	(1, 'lorem ipsum', '2023-03-28', 2, 4);

-- Listage de la structure de table forumgk. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `creationDate` date NOT NULL,
  `category_id` int NOT NULL,
  `user_id` int NOT NULL,
  `closed` tinyint NOT NULL,
  PRIMARY KEY (`id_topic`) USING BTREE,
  KEY `FK_topicToCategory` (`category_id`),
  KEY `FK_topicToUser` (`user_id`),
  CONSTRAINT `FK_topicToCategory` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`),
  CONSTRAINT `FK_topicToUser` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forumgk.topic : ~5 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `creationDate`, `category_id`, `user_id`, `closed`) VALUES
	(1, 'Topic chien', '2023-03-27', 1, 1, 0),
	(2, 'Topic chat', '2022-02-18', 1, 1, 0),
	(3, 'Topic poisson', '2021-01-08', 1, 1, 0),
	(4, 'Topic tortue', '2023-03-28', 2, 1, 0),
	(5, 'Topic serpent', '2020-09-12', 2, 1, 0);

-- Listage de la structure de table forumgk. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `dateCreate` date NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `role` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  PRIMARY KEY (`id_user`) USING BTREE,
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `pseudonyme` (`pseudo`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forumgk.user : ~1 rows (environ)
INSERT INTO `user` (`id_user`, `pseudo`, `password`, `dateCreate`, `email`, `role`) VALUES
	(1, 'pseudo', ',zfo,zego', '2023-03-27', 'nnzeginjg@sokngesg.fr', 'user'),
	(2, 'Guillaume', 'sfsfsf', '2023-03-28', 'fsfsfsfsf@dqdqd.fr', 'admin');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;