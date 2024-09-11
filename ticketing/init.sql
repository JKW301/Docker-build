-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           11.3.2-MariaDB - mariadb.org binary distribution
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour atd
DROP DATABASE IF EXISTS `atd`;
CREATE DATABASE IF NOT EXISTS `atd` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;
USE `atd`;

-- Listage de la structure de la table atd. message
DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `author` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket_id` (`ticket_id`),
  CONSTRAINT `message_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Listage des données de la table atd.message : ~2 rows (environ)
DELETE FROM `message`;
INSERT INTO `message` (`id`, `ticket_id`, `content`, `created_at`, `author`) VALUES
	(1, 1, 'ticket de zinzin', '2024-03-28 13:45:27', NULL),
	(2, 1, 'ticket de ouf?', '2024-03-28 13:58:38', NULL);

-- Listage de la structure de la table atd. ticket
DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_manager` int(11) DEFAULT NULL,
  `title` varchar(50) NOT NULL DEFAULT '0',
  `content` varchar(500) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_ticket_user` (`id_user`),
  KEY `FK_ticket_user_2` (`id_manager`),
  CONSTRAINT `FK_ticket_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_ticket_user_2` FOREIGN KEY (`id_manager`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Listage des données de la table atd.ticket : ~7 rows (environ)
DELETE FROM `ticket`;
INSERT INTO `ticket` (`id`, `id_user`, `id_manager`, `title`, `content`, `status`) VALUES
	(1, 1, NULL, 'Titre', 'super ticket', 1),
	(2, 2, NULL, 'Ticket', 'ptit ticket', 1),
	(3, 1, NULL, 'Ticket resolu', 'cest résolu', 1),
	(4, 1, NULL, 'ee', 'eee', 1),
	(5, 1, NULL, 'tickettest', 'superticket3', 1),
	(6, 2, NULL, 'Ticket5', '0', 0),
	(7, 1, NULL, 'Ticket4', '0', 1);

-- Listage de la structure de la table atd. user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL DEFAULT '',
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Listage des données de la table atd.user : ~2 rows (environ)
DELETE FROM `user`;
INSERT INTO `user` (`id`, `name`, `password`, `status`) VALUES
	(1, 'Utilisateur', 'test', 0),
	(2, 'Jerome', 'pw', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
