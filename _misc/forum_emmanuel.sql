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


-- Listage de la structure de la base pour forum_emmanuel
CREATE DATABASE IF NOT EXISTS `forum_emmanuel` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `forum_emmanuel`;

-- Listage de la structure de table forum_emmanuel. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id_category`),
  UNIQUE KEY `categoryName` (`categoryName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table forum_emmanuel.category : ~5 rows (environ)
INSERT INTO `category` (`id_category`, `categoryName`) VALUES
	(3, 'Chickens'),
	(5, 'DIY Builds'),
	(1, 'Farm Life'),
	(4, 'Food Conservation'),
	(2, 'Gardening');

-- Listage de la structure de table forum_emmanuel. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nickname` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `mail` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT 'user',
  `registrationDate` date DEFAULT (curdate()),
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `nickname` (`nickname`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table forum_emmanuel.user : ~0 rows (environ)
INSERT INTO `user` (`id_user`, `nickname`, `password`, `mail`, `role`, `registrationDate`) VALUES
	(1, 'john_doe', 'password123', 'john_doe@example.com', 'user', '2024-12-18'),
	(2, 'jane_smith', 'password123', 'jane_smith@example.com', 'user', '2024-12-18'),
	(3, 'michael_brown', 'password123', 'michael_brown@example.com', 'user', '2024-12-18'),
	(4, 'lisa_white', 'password123', 'lisa_white@example.com', 'user', '2024-12-18'),
	(5, 'susan_black', 'password123', 'susan_black@example.com', 'user', '2024-12-18'),
	(6, 'david_green', 'password123', 'david_green@example.com', 'user', '2024-12-18');

  -- Listage de la structure de table forum_emmanuel. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `content` text COLLATE utf8mb4_bin NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `closed` tinyint NOT NULL DEFAULT '0',
  `category_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id_topic`) USING BTREE,
  KEY `category_id` (`category_id`) USING BTREE,
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_topic_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`),
  CONSTRAINT `FK_topic_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table forum_emmanuel.topic : ~0 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `content`, `creationDate`, `closed`, `category_id`, `user_id`) VALUES
	(1, 'Living the Farm Life', 'The first message of the topic', '2024-12-18 16:32:14', 0, 1, 1),
	(2, 'Tips for a Beautiful Garden', 'The first message of the topic', '2024-12-18 16:32:14', 0, 2, 2),
	(3, 'Raising Healthy Chickens', 'The first message of the topic', '2024-12-18 16:32:14', 0, 3, 3),
	(4, 'Methods of Food Preservation', 'The first message of the topic', '2024-12-18 16:32:14', 0, 4, 4),
	(5, 'Building Your Own Shed', 'The first message of the topic', '2024-12-18 16:32:14', 0, 5, 5);

-- Listage de la structure de table forum_emmanuel. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `postDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` text COLLATE utf8mb4_bin NOT NULL,
  `topic_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `topic_id` (`topic_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK__topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`),
  CONSTRAINT `FK__user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table forum_emmanuel.post : ~0 rows (environ)
INSERT INTO `post` (`id_post`, `postDate`, `content`, `topic_id`, `user_id`) VALUES
	(1, '2024-12-18 16:32:23', 'Farm life is hard but rewarding.', 1, 1),
	(2, '2024-12-18 16:32:23', 'The joy of living on a farm is incredible!', 1, 2),
	(3, '2024-12-18 16:32:23', 'A well-maintained garden brings peace and beauty.', 2, 3),
	(4, '2024-12-18 16:32:23', 'Gardening is an art that anyone can master.', 2, 4),
	(5, '2024-12-18 16:32:23', 'Chickens need a proper space to roam freely.', 3, 5),
	(6, '2024-12-18 16:32:23', 'Make sure to provide them with fresh water daily.', 3, 6),
	(7, '2024-12-18 16:32:23', 'Canning is a great method for long-term storage.', 4, 1),
	(8, '2024-12-18 16:32:23', 'Drying and freezing are also excellent preservation techniques.', 4, 2),
	(9, '2024-12-18 16:32:23', 'A good shed starts with a solid foundation.', 5, 3),
	(10, '2024-12-18 16:32:23', 'Make sure to use quality materials for your DIY build.', 5, 4);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
