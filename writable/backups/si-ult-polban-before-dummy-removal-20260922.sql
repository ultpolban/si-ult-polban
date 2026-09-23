-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: si-ult-polban
-- ------------------------------------------------------
-- Server version	8.4.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activity_logs`
--

DROP TABLE IF EXISTS `activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activity_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
  `action` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `module` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `reference_id` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `old_data` json DEFAULT NULL,
  `new_data` json DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `module` (`module`),
  KEY `action` (`action`),
  KEY `reference_id` (`reference_id`),
  KEY `created_at` (`created_at`),
  CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_logs`
--

LOCK TABLES `activity_logs` WRITE;
/*!40000 ALTER TABLE `activity_logs` DISABLE KEYS */;
INSERT INTO `activity_logs` VALUES (1,5,'LOGOUT','auth','5',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 05:47:13'),(2,5,'LOGIN','auth','5',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 05:47:18'),(3,5,'LOGOUT','auth','5',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 05:47:41'),(4,6,'LOGIN','auth','6',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 05:47:47'),(5,6,'LOGOUT','auth','6',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 05:48:09'),(6,3,'LOGIN','auth','3',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 05:48:21'),(7,3,'LOGOUT','auth','3',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:39:56'),(8,3,'LOGIN','auth','3',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:40:03'),(9,3,'LOGOUT','auth','3',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:51:19'),(10,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:51:26'),(11,1,'LOGOUT','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:51:37'),(12,6,'LOGIN','auth','6',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:51:48'),(13,6,'LOGOUT','auth','6',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:53:20'),(14,3,'LOGIN','auth','3',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:53:25'),(15,3,'LOGOUT','auth','3',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:58:51'),(16,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:58:59'),(17,1,'LOGOUT','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:00:01'),(18,4,'LOGIN','auth','4',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:00:08'),(19,4,'LOGOUT','auth','4',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:00:32'),(20,3,'LOGIN','auth','3',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:00:45'),(21,3,'LOGOUT','auth','3',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:02:18'),(22,7,'LOGIN','auth','7',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:02:25'),(23,7,'LOGOUT','auth','7',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:02:30'),(24,8,'LOGIN','auth','8',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:02:39'),(25,8,'LOGOUT','auth','8',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:02:43'),(26,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:04:04'),(27,1,'LOGOUT','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:05:16'),(28,3,'LOGIN','auth','3',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:06:43'),(29,3,'LOGOUT','auth','3',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:20:40'),(30,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:20:47'),(31,1,'LOGOUT','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:21:12'),(32,6,'LOGIN','auth','6',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:21:18'),(33,6,'LOGOUT','auth','6',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:21:41'),(34,3,'LOGIN','auth','3',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:21:46'),(35,3,'LOGOUT','auth','3',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:26:33'),(36,4,'LOGIN','auth','4',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:26:41'),(37,4,'LOGOUT','auth','4',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:38:00'),(38,3,'LOGIN','auth','3',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:38:11'),(39,3,'LOGOUT','auth','3',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:38:30'),(40,4,'LOGIN','auth','4',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:38:35'),(41,4,'LOGOUT','auth','4',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:43:06'),(42,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:43:16'),(43,1,'LOGOUT','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:43:31'),(44,8,'LOGIN','auth','8',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:43:41'),(45,8,'LOGOUT','auth','8',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:47:48'),(46,7,'LOGIN','auth','7',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:47:58'),(47,7,'LOGOUT','auth','7',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:50:22'),(48,7,'LOGIN','auth','7',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:50:46'),(49,7,'LOGOUT','auth','7',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 08:25:10'),(50,8,'LOGIN','auth','8',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 08:25:17'),(51,8,'LOGOUT','auth','8',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 08:26:23'),(52,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 08:26:28'),(53,1,'LOGOUT','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 08:46:23'),(54,6,'LOGIN','auth','6',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 08:46:30'),(55,6,'LOGOUT','auth','6',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 09:05:48'),(56,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 09:05:54'),(57,1,'LOGOUT','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 09:35:38'),(58,3,'LOGIN','auth','3',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 09:35:45'),(59,3,'LOGOUT','auth','3',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 09:36:48'),(60,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 09:36:53'),(61,1,'LOGOUT','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 09:45:05'),(62,4,'LOGIN','auth','4',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 09:45:14'),(63,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 00:41:26'),(64,1,'LOGOUT','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 00:47:21'),(65,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 00:47:32'),(66,1,'LOGOUT','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:04:49'),(67,4,'LOGIN','auth','4',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:04:55'),(68,4,'LOGOUT','auth','4',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:07:10'),(69,3,'LOGIN','auth','3',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:07:16'),(70,3,'LOGOUT','auth','3',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:09:19'),(71,4,'LOGIN','auth','4',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:09:24'),(72,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-16 04:09:54'),(73,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 02:24:28'),(74,1,'LOGOUT','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 02:26:52'),(75,4,'LOGIN','auth','4',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 02:26:59'),(76,4,'LOGOUT','auth','4',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 02:27:44'),(77,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 02:27:49'),(78,1,'LOGOUT','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 03:51:23'),(79,5,'LOGIN','auth','5',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 03:51:31'),(80,5,'LOGOUT','auth','5',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 03:52:02'),(81,3,'LOGIN','auth','3',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 03:52:24'),(82,3,'LOGOUT','auth','3',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 03:52:51'),(83,8,'LOGIN','auth','8',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 03:52:59'),(84,8,'LOGOUT','auth','8',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 03:53:24'),(85,7,'LOGIN','auth','7',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 03:53:40'),(86,7,'LOGOUT','auth','7',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 04:13:04'),(87,6,'LOGIN','auth','6',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 04:13:12'),(88,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 08:51:28'),(89,1,'LOGOUT','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 08:52:59'),(90,6,'LOGIN','auth','6',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 08:53:06'),(91,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-21 00:45:50'),(92,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-22 01:27:29'),(93,1,'LOGOUT','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-22 01:29:08'),(94,6,'LOGIN','auth','6',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-22 01:29:13'),(95,6,'LOGOUT','auth','6',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-22 01:29:26'),(96,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-22 02:01:00'),(97,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-22 05:36:08'),(98,1,'LOGOUT','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-22 05:36:27'),(99,6,'LOGIN','auth','6',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-22 05:36:31'),(100,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-22 05:52:24'),(101,1,'LOGOUT','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-22 05:52:55'),(102,6,'LOGIN','auth','6',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-22 05:52:58'),(103,6,'LOGIN','auth','6',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-22 05:52:59'),(104,6,'LOGOUT','auth','6',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-22 05:59:25'),(105,3,'LOGIN','auth','3',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-22 06:00:08');
/*!40000 ALTER TABLE `activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `administrasi_umum_activity_logs`
--

DROP TABLE IF EXISTS `administrasi_umum_activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administrasi_umum_activity_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
  `ticket_id` bigint unsigned DEFAULT NULL,
  `action` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `activity` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_general_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `ticket_id` (`ticket_id`),
  KEY `action` (`action`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrasi_umum_activity_logs`
--

LOCK TABLES `administrasi_umum_activity_logs` WRITE;
/*!40000 ALTER TABLE `administrasi_umum_activity_logs` DISABLE KEYS */;
INSERT INTO `administrasi_umum_activity_logs` VALUES (1,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:46:57'),(2,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:46:59'),(3,3,2,'RESULT_UPLOADED','Menambahkan hasil layanan tiket ADM-UMUM-DUMMY-2','processing','','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:47:28'),(4,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:47:28'),(5,3,2,'TICKET_PROCESSED','Memproses tiket ADM-UMUM-DUMMY-2','completed','Sedang diproses oleh petugas unit.','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:47:56'),(6,3,2,'STATUS_CHANGED','Mengubah status tiket ADM-UMUM-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:47:56'),(7,3,2,'NOTE_ADDED','Menambahkan catatan pada tiket ADM-UMUM-DUMMY-2','completed','Sedang diproses oleh petugas unit.','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:47:56'),(8,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:47:56'),(9,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:49:36'),(10,3,NULL,'DASHBOARD_VIEW','Membuka dashboard Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:49:44'),(11,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:49:48'),(12,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:49:51'),(13,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:58:10'),(14,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:58:13'),(15,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:58:47'),(16,4,NULL,'LOGIN','Login ke sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:00:08'),(17,4,NULL,'DASHBOARD_VIEW','Membuka dashboard Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:00:08'),(18,4,NULL,'TICKET_LIST_VIEW','Membuka data tiket Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:00:11'),(19,4,2,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:00:14'),(20,4,NULL,'DASHBOARD_VIEW','Membuka dashboard Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:00:28'),(21,4,NULL,'LOGOUT','Logout dari sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:00:32'),(22,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:06:53'),(23,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:07:25'),(24,4,NULL,'LOGIN','Login ke sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:26:41'),(25,4,NULL,'DASHBOARD_VIEW','Membuka dashboard Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:26:41'),(26,4,NULL,'TICKET_LIST_VIEW','Membuka data tiket Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:26:44'),(27,4,4,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:26:46'),(28,4,4,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:26:58'),(29,4,NULL,'DASHBOARD_VIEW','Membuka dashboard Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:27:01'),(30,4,NULL,'TICKET_LIST_VIEW','Membuka data tiket Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:27:03'),(31,4,4,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:27:06'),(32,4,4,'TICKET_PROCESSED','Memproses tiket ADM-UMUM-DUMMY-2','completed','Sedang diproses oleh petugas unit.','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:30:58'),(33,4,4,'STATUS_CHANGED','Mengubah status tiket ADM-UMUM-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:30:58'),(34,4,4,'NOTE_ADDED','Menambahkan catatan pada tiket ADM-UMUM-DUMMY-2','completed','Sedang diproses oleh petugas unit.','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:30:58'),(35,4,4,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:30:58'),(36,4,4,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:32:26'),(37,4,NULL,'TICKET_LIST_VIEW','Membuka data tiket Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:32:33'),(38,4,3,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-1','submitted',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:32:34'),(39,4,3,'TICKET_PROCESSED','Memproses tiket ADM-UMUM-DUMMY-1','completed','aa','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:32:50'),(40,4,3,'STATUS_CHANGED','Mengubah status tiket ADM-UMUM-DUMMY-1','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:32:50'),(41,4,3,'NOTE_ADDED','Menambahkan catatan pada tiket ADM-UMUM-DUMMY-1','completed','aa','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:32:50'),(42,4,3,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-1','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:32:50'),(43,4,3,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-1','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:34:41'),(44,4,NULL,'TICKET_LIST_VIEW','Membuka data tiket Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:34:45'),(45,4,4,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:34:47'),(46,4,4,'TICKET_PROCESSED','Memproses tiket ADM-UMUM-DUMMY-2','completed','Sedangs diproses oleh petugas unit.','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:35:06'),(47,4,4,'NOTE_ADDED','Menambahkan catatan pada tiket ADM-UMUM-DUMMY-2','completed','Sedangs diproses oleh petugas unit.','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:35:06'),(48,4,4,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:35:06'),(49,4,4,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:36:38'),(50,4,4,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:37:47'),(51,4,NULL,'TICKET_LIST_VIEW','Membuka data tiket Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:37:53'),(52,4,4,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:37:56'),(53,4,NULL,'LOGOUT','Logout dari sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:38:00'),(54,4,NULL,'LOGIN','Login ke sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:38:35'),(55,4,NULL,'DASHBOARD_VIEW','Membuka dashboard Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:38:35'),(56,4,NULL,'TICKET_LIST_VIEW','Membuka data tiket Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:38:36'),(57,4,4,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:38:39'),(58,4,4,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:40:04'),(59,4,4,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:41:17'),(60,4,4,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:42:56'),(61,4,NULL,'LOGOUT','Logout dari sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:43:06'),(62,4,NULL,'LOGIN','Login ke sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 09:45:14'),(63,4,NULL,'DASHBOARD_VIEW','Membuka dashboard Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 09:45:14'),(64,4,NULL,'TICKET_LIST_VIEW','Membuka data tiket Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 09:46:10'),(65,4,4,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 09:46:15'),(66,4,NULL,'TICKET_LIST_VIEW','Membuka data tiket Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 09:46:19'),(67,4,4,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 09:47:01'),(68,4,NULL,'TICKET_LIST_VIEW','Membuka data tiket Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 09:47:07'),(69,4,NULL,'TICKET_LIST_VIEW','Membuka data tiket Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 09:47:18'),(70,4,4,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 09:47:21'),(71,4,NULL,'LOGIN','Login ke sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:04:55'),(72,4,NULL,'DASHBOARD_VIEW','Membuka dashboard Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:04:55'),(73,4,NULL,'TICKET_LIST_VIEW','Membuka data tiket Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:04:58'),(74,4,3,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-1','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:05:02'),(75,4,3,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-1','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:06:49'),(76,4,3,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-1','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:06:54'),(77,4,NULL,'LOGOUT','Logout dari sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:07:10'),(78,4,NULL,'LOGIN','Login ke sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:09:24'),(79,4,NULL,'DASHBOARD_VIEW','Membuka dashboard Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:09:25'),(80,4,NULL,'DASHBOARD_VIEW','Membuka dashboard Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:10:13'),(81,4,NULL,'TICKET_LIST_VIEW','Membuka data tiket Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:10:15'),(82,4,3,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-1','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:10:18'),(83,4,3,'TICKET_SENT_TO_ULT','Mengirim tiket ADM-UMUM-DUMMY-1 ke Petugas ULT','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:10:23'),(84,4,3,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-1','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:10:23'),(85,4,NULL,'ACTIVITY_LOG_VIEW','Membuka log aktivitas Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:10:27'),(86,4,NULL,'LOGIN','Login ke sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 02:26:59'),(87,4,NULL,'DASHBOARD_VIEW','Membuka dashboard Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 02:27:00'),(88,4,NULL,'TICKET_LIST_VIEW','Membuka data tiket Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 02:27:02'),(89,4,4,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 02:27:05'),(90,4,4,'TICKET_PROCESSED','Memproses tiket ADM-UMUM-DUMMY-2','processing','Sedangs diproses oleh petugas unit.','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 02:27:13'),(91,4,4,'STATUS_CHANGED','Mengubah status tiket ADM-UMUM-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 02:27:13'),(92,4,4,'NOTE_ADDED','Menambahkan catatan pada tiket ADM-UMUM-DUMMY-2','processing','Sedangs diproses oleh petugas unit.','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 02:27:13'),(93,4,4,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 02:27:13'),(94,4,4,'TICKET_PROCESSED','Memproses tiket ADM-UMUM-DUMMY-2','completed','Sedangs diproses oleh petugas unit.','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 02:27:30'),(95,4,4,'STATUS_CHANGED','Mengubah status tiket ADM-UMUM-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 02:27:30'),(96,4,4,'NOTE_ADDED','Menambahkan catatan pada tiket ADM-UMUM-DUMMY-2','completed','Sedangs diproses oleh petugas unit.','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 02:27:30'),(97,4,4,'TICKET_DETAIL_VIEW','Melihat detail tiket ADM-UMUM-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 02:27:30'),(98,4,NULL,'ACTIVITY_LOG_VIEW','Membuka log aktivitas Administrasi Umum',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 02:27:38'),(99,4,NULL,'LOGOUT','Logout dari sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 02:27:44');
/*!40000 ALTER TABLE `administrasi_umum_activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `administrasi_umum_tickets`
--

DROP TABLE IF EXISTS `administrasi_umum_tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administrasi_umum_tickets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ticket_number` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `applicant_name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `applicant_identifier` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `service_name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `service_category` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `unit_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `title` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `status` enum('submitted','processing','completed','rejected','cancelled') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'submitted',
  `priority` enum('low','normal','high','urgent') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'normal',
  `assigned_to` int unsigned DEFAULT NULL,
  `admin_note` text COLLATE utf8mb4_general_ci,
  `result_note` text COLLATE utf8mb4_general_ci,
  `result_file` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `submitted_at` datetime DEFAULT NULL,
  `processed_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `sent_to_ult` tinyint(1) NOT NULL DEFAULT '0',
  `sent_to_ult_at` datetime DEFAULT NULL,
  `sent_to_applicant` tinyint(1) NOT NULL DEFAULT '0',
  `sent_to_applicant_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ticket_number` (`ticket_number`),
  KEY `status` (`status`),
  KEY `priority` (`priority`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrasi_umum_tickets`
--

LOCK TABLES `administrasi_umum_tickets` WRITE;
/*!40000 ALTER TABLE `administrasi_umum_tickets` DISABLE KEYS */;
INSERT INTO `administrasi_umum_tickets` VALUES (3,'ADM-UMUM-DUMMY-1','Siti Rahmawati','3201010101010001','Administrasi Umum','Bagian Administrasi Umum','Bagian Administrasi Umum','Permohonan layanan administrasi umum','Data dummy untuk pengujian alur layanan Administrasi Umum pada unit Bagian Administrasi Umum.','completed','normal',NULL,'aa',NULL,NULL,'2026-09-11 07:03:46',NULL,'2026-09-11 07:32:50','2026-09-11 07:03:46','2026-09-14 01:10:23',NULL,1,'2026-09-14 01:10:23',0,NULL),(4,'ADM-UMUM-DUMMY-2','Bambang Pratama','3201010101010002','Administrasi Kepegawaian','Bagian Administrasi Umum','Bagian Administrasi Umum','Permohonan administrasi kepegawaian','Data dummy untuk pengujian alur layanan Administrasi Kepegawaian pada unit Bagian Administrasi Umum.','completed','normal',NULL,'Sedangs diproses oleh petugas unit.',NULL,NULL,'2026-09-11 07:03:46','2026-09-11 07:03:46','2026-09-11 07:30:58','2026-09-11 07:03:46','2026-09-17 02:27:30',NULL,0,NULL,0,NULL);
/*!40000 ALTER TABLE `administrasi_umum_tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `akademik_activity_logs`
--

DROP TABLE IF EXISTS `akademik_activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `akademik_activity_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
  `ticket_id` bigint unsigned DEFAULT NULL,
  `action` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `activity` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket_id` (`ticket_id`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `akademik_activity_logs`
--

LOCK TABLES `akademik_activity_logs` WRITE;
/*!40000 ALTER TABLE `akademik_activity_logs` DISABLE KEYS */;
INSERT INTO `akademik_activity_logs` VALUES (1,1,1,'STATUS_CHANGED','Mengubah status tiket AKD-DUMMY-1','processing',NULL,'2026-09-11 08:26:54'),(2,1,2,'STATUS_CHANGED','Mengubah status tiket AKD-DUMMY-2','completed','Sedang diproses oleh petugas unit.','2026-09-11 09:08:50'),(3,1,2,'RESULT_UPLOADED','Mengunggah 1 dokumen hasil layanan untuk tiket AKD-DUMMY-2','completed',NULL,'2026-09-11 09:08:50');
/*!40000 ALTER TABLE `akademik_activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `akademik_tickets`
--

DROP TABLE IF EXISTS `akademik_tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `akademik_tickets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ticket_number` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `applicant_name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `applicant_identifier` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `service_name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `service_category` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `unit_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `status` enum('submitted','processing','completed','rejected','cancelled') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'submitted',
  `priority` enum('low','normal','high','urgent') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'normal',
  `admin_note` text COLLATE utf8mb4_general_ci,
  `result_note` text COLLATE utf8mb4_general_ci,
  `result_file` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `submitted_at` datetime DEFAULT NULL,
  `processed_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `sent_to_ult` tinyint(1) NOT NULL DEFAULT '0',
  `sent_to_ult_at` datetime DEFAULT NULL,
  `sent_to_applicant` tinyint(1) NOT NULL DEFAULT '0',
  `sent_to_applicant_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ticket_number` (`ticket_number`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `akademik_tickets`
--

LOCK TABLES `akademik_tickets` WRITE;
/*!40000 ALTER TABLE `akademik_tickets` DISABLE KEYS */;
INSERT INTO `akademik_tickets` VALUES (1,'AKD-DUMMY-1','Ayu Lestari','3201010101010007','Cuti Akademik','Akademik','Akademik','Permohonan cuti akademik semester ganjil','Data dummy untuk pengujian alur layanan Cuti Akademik pada unit Akademik.','completed','normal','','Surat hasil layanan Akademik berhasil diunggah.','1789611897_d44911a12641b0c61fb3.pdf','2026-09-11 07:03:46',NULL,'2026-09-17 08:52:17','2026-09-11 07:03:46','2026-09-17 08:52:17',NULL,0,NULL,0,NULL),(2,'AKD-DUMMY-2','Raka Pratama','3201010101010008','Surat Keterangan Aktif Kuliah','Akademik','Akademik','Pengajuan surat keterangan aktif kuliah','Data dummy untuk pengujian alur layanan Surat Keterangan Aktif Kuliah pada unit Akademik.','completed','normal','','Dokumen hasil layanan berhasil diunggah.','[{\"nama_file\":\"1789117730_6bc1d3ee0cc4f0a03214.pdf\",\"nama_asli\":\"04-Anggi Dwi Permana-XPPLG 2-Tugas poster.pdf\"}]','2026-09-11 07:03:46','2026-09-17 02:26:03','2026-09-17 02:57:18','2026-09-11 07:03:46','2026-09-21 00:52:56',NULL,1,'2026-09-21 00:52:56',1,'2026-09-14 01:03:48');
/*!40000 ALTER TABLE `akademik_tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dokumen_hasil`
--

DROP TABLE IF EXISTS `dokumen_hasil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dokumen_hasil` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `penanganan_id` int unsigned NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `nama_asli` varchar(255) DEFAULT NULL,
  `ukuran_file` int unsigned DEFAULT NULL,
  `tipe_file` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_penanganan_id` (`penanganan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dokumen_hasil`
--

LOCK TABLES `dokumen_hasil` WRITE;
/*!40000 ALTER TABLE `dokumen_hasil` DISABLE KEYS */;
INSERT INTO `dokumen_hasil` VALUES (1,1,'1787802002_dcb99234f969f25573f9.jpg',NULL,NULL,NULL,NULL,NULL),(2,1,'1787802476_b7936046247365747b96.jpg',NULL,NULL,NULL,NULL,NULL),(3,1,'1788078492_dd354dc84a09a6271072.jpg',NULL,NULL,NULL,NULL,NULL),(4,2,'1788917698_8526b2d234d6a0bceab8.pdf','dispen_Raysia.pdf',188454,'application/pdf','2026-09-09 01:34:58','2026-09-09 01:34:58'),(5,2,'1788917761_a12402f99b1d269008c4.pdf','dispen_Anggi Dwi P.pdf',188959,'application/pdf','2026-09-09 01:36:01','2026-09-09 01:36:01');
/*!40000 ALTER TABLE `dokumen_hasil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jurusan_activity_logs`
--

DROP TABLE IF EXISTS `jurusan_activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jurusan_activity_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
  `ticket_id` bigint unsigned DEFAULT NULL,
  `action` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `activity` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket_id` (`ticket_id`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jurusan_activity_logs`
--

LOCK TABLES `jurusan_activity_logs` WRITE;
/*!40000 ALTER TABLE `jurusan_activity_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jurusan_activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jurusan_tickets`
--

DROP TABLE IF EXISTS `jurusan_tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jurusan_tickets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ticket_number` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `applicant_name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `applicant_identifier` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `service_name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `service_category` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `unit_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Jurusan',
  `title` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('submitted','processing','completed','rejected','cancelled') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'submitted',
  `priority` enum('low','normal','high','urgent') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'normal',
  `admin_note` text COLLATE utf8mb4_general_ci,
  `result_note` text COLLATE utf8mb4_general_ci,
  `result_file` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `submitted_at` datetime DEFAULT NULL,
  `processed_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `sent_to_ult` tinyint(1) NOT NULL DEFAULT '0',
  `sent_to_ult_at` datetime DEFAULT NULL,
  `sent_to_applicant` tinyint(1) NOT NULL DEFAULT '0',
  `sent_to_applicant_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ticket_number` (`ticket_number`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jurusan_tickets`
--

LOCK TABLES `jurusan_tickets` WRITE;
/*!40000 ALTER TABLE `jurusan_tickets` DISABLE KEYS */;
INSERT INTO `jurusan_tickets` VALUES (3,'JURUSAN-DUMMY-1','Aulia Ramadhan','3201010101010005','Surat Pengantar Jurusan','Jurusan','Jurusan','Pengajuan surat pengantar jurusan','Data dummy untuk pengujian alur layanan Surat Pengantar Jurusan pada unit Jurusan.','completed','normal','s',NULL,NULL,'2026-09-11 07:03:46','2026-09-11 08:25:39','2026-09-11 08:25:39','2026-09-11 07:03:46','2026-09-11 08:25:39',NULL,0,NULL,0,NULL),(4,'JURUSAN-DUMMY-2','Dimas Saputra','3201010101010006','Administrasi Jurusan','Jurusan','Jurusan','Permohonan administrasi jurusan','Data dummy untuk pengujian alur layanan Administrasi Jurusan pada unit Jurusan.','completed','normal','Sedang diproses oleh petugas unit.',NULL,NULL,'2026-09-11 07:03:46','2026-09-17 03:53:20','2026-09-17 03:53:20','2026-09-11 07:03:46','2026-09-17 03:53:20',NULL,0,NULL,0,NULL);
/*!40000 ALTER TABLE `jurusan_tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kemahasiswaan_activity_logs`
--

DROP TABLE IF EXISTS `kemahasiswaan_activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kemahasiswaan_activity_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
  `ticket_id` bigint unsigned DEFAULT NULL,
  `action` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `activity` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket_id` (`ticket_id`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kemahasiswaan_activity_logs`
--

LOCK TABLES `kemahasiswaan_activity_logs` WRITE;
/*!40000 ALTER TABLE `kemahasiswaan_activity_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `kemahasiswaan_activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kemahasiswaan_tickets`
--

DROP TABLE IF EXISTS `kemahasiswaan_tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kemahasiswaan_tickets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ticket_number` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `applicant_name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `applicant_identifier` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `service_name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `service_category` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `unit_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `status` enum('submitted','processing','completed','rejected','cancelled') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'submitted',
  `priority` enum('low','normal','high','urgent') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'normal',
  `admin_note` text COLLATE utf8mb4_general_ci,
  `result_note` text COLLATE utf8mb4_general_ci,
  `result_file` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `submitted_at` datetime DEFAULT NULL,
  `processed_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `sent_to_ult` tinyint(1) NOT NULL DEFAULT '0',
  `sent_to_ult_at` datetime DEFAULT NULL,
  `sent_to_applicant` tinyint(1) NOT NULL DEFAULT '0',
  `sent_to_applicant_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ticket_number` (`ticket_number`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kemahasiswaan_tickets`
--

LOCK TABLES `kemahasiswaan_tickets` WRITE;
/*!40000 ALTER TABLE `kemahasiswaan_tickets` DISABLE KEYS */;
INSERT INTO `kemahasiswaan_tickets` VALUES (1,'KMS-DUMMY-1','Ayu Lestari','3201010101010009','Surat Keterangan Aktif','Kemahasiswaan','Kemahasiswaan','Permohonan surat keterangan aktif mahasiswa','Data dummy untuk pengujian alur layanan surat keterangan aktif pada unit Kemahasiswaan.','completed','normal','',NULL,NULL,'2026-09-11 05:42:40',NULL,'2026-09-17 03:51:51','2026-09-11 05:42:40','2026-09-17 03:51:51',NULL,0,NULL,0,NULL),(2,'KMS-DUMMY-2','Doni Setiawan','3201010101010010','Beasiswa Mahasiswa','Kemahasiswaan','Kemahasiswaan','Pengajuan layanan beasiswa mahasiswa','Data dummy untuk pengujian alur layanan beasiswa mahasiswa pada unit Kemahasiswaan.','completed','high','',NULL,NULL,'2026-09-11 05:42:40','2026-09-11 05:42:40','2026-09-11 05:47:32','2026-09-11 05:42:40','2026-09-11 05:47:32',NULL,0,NULL,0,NULL);
/*!40000 ALTER TABLE `kemahasiswaan_tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keuangan_activity_logs`
--

DROP TABLE IF EXISTS `keuangan_activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `keuangan_activity_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
  `ticket_id` bigint unsigned DEFAULT NULL,
  `action` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `activity` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket_id` (`ticket_id`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keuangan_activity_logs`
--

LOCK TABLES `keuangan_activity_logs` WRITE;
/*!40000 ALTER TABLE `keuangan_activity_logs` DISABLE KEYS */;
INSERT INTO `keuangan_activity_logs` VALUES (1,6,2,'STATUS_CHANGED','Mengubah status tiket KEU-DUMMY-2','completed','Sedang diproses oleh petugas Keuangan.','2026-09-11 05:48:02'),(2,6,2,'STATUS_CHANGED','Mengubah status tiket KEU-DUMMY-2','completed','Sedang diproses oleh petugas Keuangan.','2026-09-11 08:56:13'),(3,6,2,'STATUS_CHANGED','Mengubah status tiket KEU-DUMMY-2','submitted','Sedang diproses oleh petugas Keuangan.','2026-09-11 08:58:06'),(4,6,2,'STATUS_CHANGED','Mengubah status tiket KEU-DUMMY-2','submitted','Sedang diproses oleh petugas Keuangan.','2026-09-11 08:58:18'),(5,6,2,'STATUS_CHANGED','Mengubah status tiket KEU-DUMMY-2','completed','Sedang diproses oleh petugas Keuangan.','2026-09-11 09:00:53'),(6,6,2,'STATUS_CHANGED','Mengubah status tiket KEU-DUMMY-2','completed','Sedang diproses oleh petugas Keuangan.','2026-09-11 09:03:23'),(7,6,1,'STATUS_CHANGED','Mengubah status tiket KEU-DUMMY-1','completed','','2026-09-17 04:13:27'),(8,6,2,'TICKET_SENT','Mengirim tiket KEU-DUMMY-2','completed',NULL,'2026-09-17 08:53:20'),(9,6,2,'TICKET_SENT','Mengirim tiket KEU-DUMMY-2','completed',NULL,'2026-09-17 08:54:32'),(10,6,2,'TICKET_SENT','Mengirim tiket KEU-DUMMY-2','completed',NULL,'2026-09-17 09:02:24');
/*!40000 ALTER TABLE `keuangan_activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keuangan_tickets`
--

DROP TABLE IF EXISTS `keuangan_tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `keuangan_tickets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ticket_number` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `applicant_name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `applicant_identifier` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `service_name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `service_category` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `unit_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `status` enum('submitted','processing','completed','rejected','cancelled') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'submitted',
  `priority` enum('low','normal','high','urgent') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'normal',
  `admin_note` text COLLATE utf8mb4_general_ci,
  `result_note` text COLLATE utf8mb4_general_ci,
  `result_file` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `submitted_at` datetime DEFAULT NULL,
  `processed_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `sent_to_ult` tinyint(1) NOT NULL DEFAULT '0',
  `sent_to_ult_at` datetime DEFAULT NULL,
  `sent_to_applicant` tinyint(1) NOT NULL DEFAULT '0',
  `sent_to_applicant_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ticket_number` (`ticket_number`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keuangan_tickets`
--

LOCK TABLES `keuangan_tickets` WRITE;
/*!40000 ALTER TABLE `keuangan_tickets` DISABLE KEYS */;
INSERT INTO `keuangan_tickets` VALUES (1,'KEU-DUMMY-1','Rina Amelia','3201010101010007','Pembayaran UKT','Keuangan','Keuangan','Permohonan pembayaran UKT','Data dummy untuk pengujian alur layanan pembayaran UKT pada unit Keuangan.','completed','normal','',NULL,NULL,'2026-09-11 05:42:40',NULL,'2026-09-17 04:13:27','2026-09-11 05:42:40','2026-09-17 04:13:27',NULL,0,NULL,0,NULL),(2,'KEU-DUMMY-2','Bagus Wijaya','3201010101010008','Pengajuan Refund','Keuangan','Keuangan','Pengajuan refund biaya administrasi','Data dummy untuk pengujian alur layanan refund biaya administrasi pada unit Keuangan.','completed','high','Sedang diproses oleh petugas Keuangan.',NULL,NULL,'2026-09-11 05:42:40','2026-09-11 05:42:40','2026-09-11 09:03:23','2026-09-11 05:42:40','2026-09-17 09:02:24',NULL,1,'2026-09-17 09:02:24',1,'2026-09-17 08:54:32');
/*!40000 ALTER TABLE `keuangan_tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_applicant_types`
--

DROP TABLE IF EXISTS `master_applicant_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_applicant_types` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `is_internal` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `is_internal` (`is_internal`),
  KEY `is_active` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_applicant_types`
--

LOCK TABLES `master_applicant_types` WRITE;
/*!40000 ALTER TABLE `master_applicant_types` DISABLE KEYS */;
INSERT INTO `master_applicant_types` VALUES (1,'MHS','Mahasiswa','Mahasiswa aktif POLBAN',1,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(2,'ALUMNI','Alumni','Lulusan POLBAN',1,2,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(3,'TENDIK','Tendik','Tenaga Kependidikan',1,3,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(4,'DOSEN','Dosen','Dosen POLBAN',1,4,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(5,'MITRA','Mitra','Mitra Kerja Sama / Instansi',0,5,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(6,'WALI','Orang Tua / Wali','Orang tua atau wali mahasiswa',0,6,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(7,'UMUM','Masyarakat Umum','Pemohon dari masyarakat umum',0,7,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL);
/*!40000 ALTER TABLE `master_applicant_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_classes`
--

DROP TABLE IF EXISTS `master_classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_classes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `study_program_id` int unsigned NOT NULL,
  `code` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `level` tinyint(1) NOT NULL,
  `parallel_class` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `entry_year` year NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `sort_order` int NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `study_program_id` (`study_program_id`),
  KEY `entry_year` (`entry_year`),
  KEY `level` (`level`),
  CONSTRAINT `master_classes_study_program_id_foreign` FOREIGN KEY (`study_program_id`) REFERENCES `master_study_programs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_classes`
--

LOCK TABLES `master_classes` WRITE;
/*!40000 ALTER TABLE `master_classes` DISABLE KEYS */;
INSERT INTO `master_classes` VALUES (1,1,'D3-TKG-3A','Teknik Konstruksi Gedung 3A',0,'',0000,NULL,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(2,2,'D3-TKS-3A','Teknik Konstruksi Sipil 3A',0,'',0000,NULL,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(3,3,'D4-TPJJ-4A','Teknik Perancangan Jalan dan Jembatan 4A',0,'',0000,NULL,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(4,4,'D4-TPPG-4A','Teknik Perawatan dan Perbaikan Gedung 4A',0,'',0000,NULL,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(5,6,'D3-TM-3A','Teknik Mesin 3A',0,'',0000,NULL,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(6,7,'D3-TA-3A','Teknik Aeronautika 3A',0,'',0000,NULL,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(7,8,'D4-TPKM-4A','Teknik Perancangan dan Konstruksi Mesin 4A',0,'',0000,NULL,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(8,9,'D4-PM-4A','Proses Manufaktur 4A',0,'',0000,NULL,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(9,10,'D3-TPTU-3A','Teknik Pendingin dan Tata Udara 3A',0,'',0000,NULL,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(10,11,'D4-TPTU-4A','Teknik Pendingin dan Tata Udara 4A',0,'',0000,NULL,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(11,12,'D3-TKE-3A','Teknik Konversi Energi 3A',0,'',0000,NULL,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(12,13,'D4-TPTL-4A','Teknologi Pembangkit Tenaga Listrik 4A',0,'',0000,NULL,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(13,14,'D3-TEL-3A','Teknik Elektronika 3A',0,'',0000,NULL,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(14,15,'D3-TL-3A','Teknik Listrik 3A',0,'',0000,NULL,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(15,16,'D3-TT-3A','Teknik Telekomunikasi 3A',0,'',0000,NULL,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(16,17,'D4-TEL-4A','Teknik Elektronika 4A',0,'',0000,NULL,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(17,18,'D4-TOI-4A','Teknik Otomasi Industri 4A',0,'',0000,NULL,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(18,19,'D4-TT-4A','Teknik Telekomunikasi 4A',0,'',0000,NULL,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(19,20,'D3-TK-3A','Teknik Kimia 3A',0,'',0000,NULL,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(20,21,'D3-ANKIM-3A','Analis Kimia 3A',0,'',0000,NULL,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(21,22,'D4-TKK-4A','Teknik Kimia Produksi Bersih 4A',0,'',0000,NULL,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(22,23,'D3-TI-3A','Teknik Informatika 3A',0,'',0000,NULL,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(23,24,'D4-TI-4A','Teknik Informatika 4A',0,'',0000,NULL,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(24,25,'D3-AK-3A','Akuntansi 3A',0,'',0000,NULL,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(25,27,'D4-AK-4A','Akuntansi 4A',0,'',0000,NULL,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(26,30,'D3-AB-3A','Administrasi Bisnis 3A',0,'',0000,NULL,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(27,33,'D4-AB-4A','Administrasi Bisnis 4A',0,'',0000,NULL,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(28,37,'D3-BI-3A','Bahasa Inggris 3A',0,'',0000,NULL,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(29,38,'D4-BIKBP-4A','Bahasa Inggris 4A',0,'',0000,NULL,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL);
/*!40000 ALTER TABLE `master_classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_departments`
--

DROP TABLE IF EXISTS `master_departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_departments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `short_name` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `sort_order` int NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `is_active` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_departments`
--

LOCK TABLES `master_departments` WRITE;
/*!40000 ALTER TABLE `master_departments` DISABLE KEYS */;
INSERT INTO `master_departments` VALUES (1,'TS','Jurusan Teknik Sipil','Teknik Sipil',NULL,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(2,'TM','Jurusan Teknik Mesin','Teknik Mesin',NULL,2,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(3,'TRTU','Jurusan Teknik Refrigerasi dan Tata Udara','TRTU',NULL,3,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(4,'TKE','Jurusan Teknik Konversi Energi','TKE',NULL,4,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(5,'TE','Jurusan Teknik Elektro','Teknik Elektro',NULL,5,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(6,'TK','Jurusan Teknik Kimia','Teknik Kimia',NULL,6,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(7,'TKI','Jurusan Teknik Komputer dan Informatika','TKI',NULL,7,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(8,'AK','Jurusan Akuntansi','Akuntansi',NULL,8,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(9,'AN','Jurusan Administrasi Niaga','Administrasi Niaga',NULL,9,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(10,'BI','Jurusan Bahasa Inggris','Bahasa Inggris',NULL,10,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL);
/*!40000 ALTER TABLE `master_departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_service_categories`
--

DROP TABLE IF EXISTS `master_service_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_service_categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `service_unit_id` int unsigned NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `icon` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `color` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `service_unit_id` (`service_unit_id`),
  KEY `sort_order` (`sort_order`),
  KEY `is_active` (`is_active`),
  CONSTRAINT `master_service_categories_service_unit_id_foreign` FOREIGN KEY (`service_unit_id`) REFERENCES `master_service_units` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_service_categories`
--

LOCK TABLES `master_service_categories` WRITE;
/*!40000 ALTER TABLE `master_service_categories` DISABLE KEYS */;
INSERT INTO `master_service_categories` VALUES (1,'AKD-SURAT','Surat Akademik',2,'Layanan surat akademik',NULL,NULL,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(2,'AKD-STATUS','Status Mahasiswa',2,'Layanan perubahan status mahasiswa',NULL,NULL,2,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(3,'AKD-WISUDA','Wisuda',2,'Layanan administrasi wisuda',NULL,NULL,3,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(4,'KEU-UKT','UKT',3,'Layanan UKT',NULL,NULL,4,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(5,'KEU-PEMBAYARAN','Administrasi Pembayaran',3,'Administrasi pembayaran',NULL,NULL,5,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(6,'KMH-BEASISWA','Beasiswa',4,'Layanan beasiswa',NULL,NULL,6,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(7,'KMH-ORMAWA','Organisasi Mahasiswa',4,'Layanan organisasi mahasiswa',NULL,NULL,7,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(8,'PERPUS-LAYANAN','Layanan Perpustakaan',5,'Layanan perpustakaan',NULL,NULL,8,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(9,'JUR-AKADEMIK','Administrasi Jurusan',6,'Administrasi jurusan',NULL,NULL,9,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(10,'JUR-TA','Tugas Akhir',6,'Layanan administrasi tugas akhir mahasiswa.',NULL,NULL,10,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(11,'UPTIK-AKUN','Akun dan Sistem Informasi',7,'Layanan akun dan sistem informasi',NULL,NULL,10,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(12,'UPTIK-LAYANAN','Layanan Teknologi Informasi',7,'Layanan umum teknologi informasi kampus.',NULL,NULL,12,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(13,'ADM-UMUM','Administrasi Umum',8,'Layanan administrasi umum.',NULL,NULL,13,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL);
/*!40000 ALTER TABLE `master_service_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_service_requirements`
--

DROP TABLE IF EXISTS `master_service_requirements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_service_requirements` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `service_id` int unsigned NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `file_type` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pdf' COMMENT 'pdf,jpg,jpeg,png,doc,docx,xls,xlsx',
  `max_file_size` int NOT NULL DEFAULT '2048' COMMENT 'KB',
  `is_required` tinyint(1) NOT NULL DEFAULT '1',
  `allowed_extensions` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_id` (`service_id`),
  KEY `is_required` (`is_required`),
  KEY `is_active` (`is_active`),
  KEY `sort_order` (`sort_order`),
  CONSTRAINT `master_service_requirements_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `master_services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_service_requirements`
--

LOCK TABLES `master_service_requirements` WRITE;
/*!40000 ALTER TABLE `master_service_requirements` DISABLE KEYS */;
INSERT INTO `master_service_requirements` VALUES (1,1,'KTM','Scan KTM','pdf',2048,1,'pdf,jpg,jpeg,png',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(2,1,'KRS Semester Berjalan','Scan KRS','pdf',4096,1,'pdf',2,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(3,2,'KTM','Scan KTM','pdf',2048,1,'pdf,jpg,png',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(4,2,'KRS','KRS aktif','pdf',4096,1,'pdf',2,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(5,3,'KTM','Scan KTM','pdf',2048,1,'pdf,jpg,png',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(6,4,'Scan Ijazah','Ijazah asli','pdf',4096,1,'pdf',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(7,4,'KTP','Identitas','pdf',2048,1,'pdf,jpg,png',2,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(8,5,'Scan Transkrip','Transkrip nilai','pdf',4096,1,'pdf',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(9,11,'Surat Permohonan','Surat permohonan penyesuaian UKT.','pdf',4096,1,'pdf',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(10,11,'KTM','Scan KTM.','pdf',2048,1,'pdf,jpg,jpeg,png',2,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(11,11,'Kartu Keluarga','Scan KK.','pdf',4096,1,'pdf,jpg,jpeg,png',3,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(12,11,'Slip Gaji Orang Tua','Slip gaji atau surat penghasilan.','pdf',4096,1,'pdf,jpg,jpeg,png',4,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(13,12,'Surat Permohonan','Surat permohonan cicilan UKT.','pdf',4096,1,'pdf',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(14,12,'KTM','Scan KTM.','pdf',2048,1,'pdf,jpg,jpeg,png',2,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(15,12,'KRS','KRS semester berjalan.','pdf',4096,1,'pdf',3,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(16,13,'Surat Permohonan','Surat penundaan pembayaran.','pdf',4096,1,'pdf',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(17,13,'KTM','Scan KTM.','pdf',2048,1,'pdf,jpg,jpeg,png',2,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(18,14,'Bukti Pembayaran','Upload bukti pembayaran.','pdf',4096,1,'pdf,jpg,jpeg,png',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(19,15,'Surat Permohonan','Surat pengembalian dana.','pdf',4096,1,'pdf',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(20,15,'Bukti Pembayaran','Bukti transfer/pembayaran.','pdf',4096,1,'pdf,jpg,jpeg,png',2,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(21,16,'Bukti Pembayaran','Upload bukti pembayaran.','pdf',4096,1,'pdf,jpg,jpeg,png',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(22,17,'Bukti Pembayaran','Upload bukti pembayaran.','pdf',4096,1,'pdf,jpg,jpeg,png',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(23,17,'Surat Permohonan','Jelaskan data yang perlu diperbaiki.','pdf',4096,0,'pdf',2,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(24,18,'Formulir Pendaftaran','Formulir pendaftaran beasiswa.','pdf',4096,1,'pdf',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(25,18,'KTM','Scan KTM.','pdf',2048,1,'pdf,jpg,jpeg,png',2,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(26,18,'KHS / Transkrip Nilai','Nilai akademik terbaru.','pdf',4096,1,'pdf',3,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(27,18,'Surat Penghasilan Orang Tua','Surat keterangan penghasilan.','pdf',4096,1,'pdf',4,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(28,19,'KHS Terbaru','KHS semester terakhir.','pdf',4096,1,'pdf',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(29,19,'Surat Pernyataan','Surat pernyataan masih memenuhi syarat.','pdf',4096,1,'pdf',2,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(30,20,'Surat Permohonan','Permohonan surat rekomendasi.','pdf',2048,1,'pdf',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(31,21,'Proposal Kegiatan','Proposal kegiatan organisasi.','pdf',8192,1,'pdf',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(32,21,'Susunan Panitia','Daftar panitia kegiatan.','pdf',4096,1,'pdf',2,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(33,22,'Proposal Anggaran','Proposal dan RAB kegiatan.','pdf',8192,1,'pdf',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(34,23,'Surat Permohonan','Surat peminjaman fasilitas.','pdf',2048,1,'pdf',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(35,24,'Sertifikat Prestasi','Sertifikat atau piagam prestasi.','pdf',4096,1,'pdf,jpg,jpeg,png',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(36,24,'Dokumentasi','Foto atau dokumentasi kegiatan.','pdf',8192,0,'pdf,jpg,jpeg,png',2,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(37,25,'Form Konseling','Formulir permohonan konseling.','pdf',2048,1,'pdf',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(38,26,'KTM','Scan KTM.','pdf',2048,1,'pdf,jpg,jpeg,png',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(39,26,'KRS Terakhir','KRS semester terakhir.','pdf',4096,1,'pdf',2,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(40,27,'KTM','Scan KTM.','pdf',2048,1,'pdf,jpg,jpeg,png',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(41,28,'Surat Kehilangan (Jika Hilang)','Surat kehilangan dari kepolisian (opsional jika hilang).','pdf',4096,0,'pdf,jpg,jpeg,png',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(42,28,'KTM','Scan KTM.','pdf',2048,1,'pdf,jpg,jpeg,png',2,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(43,29,'Bukti Pembayaran','Upload bukti pembayaran denda.','pdf',4096,1,'pdf,jpg,jpeg,png',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(44,30,'Form Usulan Buku','Form usulan pengadaan buku.','pdf',2048,1,'pdf',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(45,31,'Topik Penelitian','Dokumen atau uraian topik penelitian.','pdf',4096,1,'pdf,doc,docx',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(46,32,'KTM','Scan KTM','pdf',2048,1,'pdf,jpg,jpeg,png',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(47,33,'Proposal PKL','Proposal Kerja Praktik','pdf',8192,1,'pdf',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(48,33,'Transkrip Nilai','Transkrip sementara','pdf',4096,1,'pdf',2,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(49,33,'KRS','KRS aktif','pdf',4096,1,'pdf',3,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(50,34,'Proposal Magang','Proposal magang','pdf',8192,1,'pdf',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(51,34,'CV','Curriculum Vitae','pdf',2048,1,'pdf',2,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(52,35,'Proposal TA','Proposal tugas akhir','pdf',8192,1,'pdf',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(53,35,'Transkrip Nilai','Transkrip akademik','pdf',4096,1,'pdf',2,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(54,36,'Form Pengajuan Judul','Form pengajuan judul','pdf',4096,1,'pdf',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(55,36,'Proposal Singkat','Ringkasan proposal','pdf',4096,1,'pdf',2,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(56,37,'Proposal TA','Proposal lengkap','pdf',8192,1,'pdf',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(57,37,'Lembar Persetujuan Pembimbing','Persetujuan pembimbing','pdf',2048,1,'pdf',2,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(58,38,'Laporan TA','Draft laporan TA','pdf',10240,1,'pdf',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(59,38,'Lembar Bimbingan','Lembar konsultasi','pdf',4096,1,'pdf',2,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(60,39,'Laporan Final','Laporan tugas akhir final','pdf',15360,1,'pdf',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(61,39,'Lembar Persetujuan','Persetujuan pembimbing','pdf',4096,1,'pdf',2,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(62,39,'Bukti Bebas Pustaka','Surat bebas pustaka','pdf',2048,1,'pdf',3,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(63,40,'Surat Permohonan','Surat permohonan','pdf',2048,1,'pdf',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(64,41,'KTM','Scan KTM','pdf',2048,1,'pdf,jpg,jpeg,png',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(65,42,'KTM','Scan KTM','pdf',2048,1,'pdf,jpg,jpeg,png',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(66,43,'KTM','Scan KTM','pdf',2048,1,'pdf,jpg,jpeg,png',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(67,44,'KTP / KTM','Identitas pemohon.','pdf',2048,1,'pdf,jpg,jpeg,png',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(68,45,'KTM','Scan KTM.','pdf',2048,1,'pdf,jpg,jpeg,png',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(69,46,'Surat Permohonan','Permohonan akses VPN.','pdf',2048,1,'pdf',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(70,47,'Screenshot Kendala','Screenshot error (opsional).','pdf',4096,0,'jpg,jpeg,png,pdf',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(71,48,'Surat Permohonan','Surat peminjaman ruangan.','pdf',2048,1,'pdf',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(72,48,'Proposal Kegiatan','Proposal kegiatan (jika ada).','pdf',8192,0,'pdf',2,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(73,49,'Surat Permohonan','Surat permohonan peminjaman.','pdf',2048,1,'pdf',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(74,50,'Draft Surat','Draft surat yang akan diproses.','pdf',4096,1,'pdf,doc,docx',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL);
/*!40000 ALTER TABLE `master_service_requirements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_service_units`
--

DROP TABLE IF EXISTS `master_service_units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_service_units` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `email` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'default.png',
  `sort_order` int NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `sort_order` (`sort_order`),
  KEY `is_active` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_service_units`
--

LOCK TABLES `master_service_units` WRITE;
/*!40000 ALTER TABLE `master_service_units` DISABLE KEYS */;
INSERT INTO `master_service_units` VALUES (1,'ULT','Unit Layanan Terpadu','Unit Layanan Terpadu Politeknik Negeri Bandung',NULL,NULL,NULL,NULL,'default.png',1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(2,'AKD','Bagian Akademik','Pelayanan akademik mahasiswa',NULL,NULL,NULL,NULL,'default.png',2,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(3,'KEU','Bagian Keuangan','Pelayanan administrasi keuangan',NULL,NULL,NULL,NULL,'default.png',3,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(4,'KEMHS','Bagian Kemahasiswaan','Pelayanan kemahasiswaan',NULL,NULL,NULL,NULL,'default.png',4,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(5,'PERPUS','Perpustakaan','Pelayanan perpustakaan',NULL,NULL,NULL,NULL,'default.png',5,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(6,'JUR','Jurusan','Pelayanan administrasi jurusan',NULL,NULL,NULL,NULL,'default.png',6,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(7,'UPTIK','UPT Teknologi Informasi dan Komunikasi','Pelayanan teknologi informasi',NULL,NULL,NULL,NULL,'default.png',7,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(8,'ADM','Administrasi Umum','Unit layanan administrasi umum',NULL,NULL,NULL,NULL,'default.png',12,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(9,'BAUK','Bagian Administrasi Umum','Administrasi umum dan kepegawaian',NULL,NULL,NULL,NULL,'default.png',8,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL);
/*!40000 ALTER TABLE `master_service_units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_services`
--

DROP TABLE IF EXISTS `master_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_services` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `service_unit_id` int unsigned NOT NULL,
  `service_category_id` int unsigned NOT NULL,
  `code` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `service_hours` int NOT NULL DEFAULT '24' COMMENT 'Estimasi penyelesaian dalam jam',
  `max_file_size` int NOT NULL DEFAULT '2048' COMMENT 'KB',
  `is_online` tinyint(1) NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `service_unit_id` (`service_unit_id`),
  KEY `service_category_id` (`service_category_id`),
  KEY `is_active` (`is_active`),
  KEY `sort_order` (`sort_order`),
  CONSTRAINT `master_services_service_category_id_foreign` FOREIGN KEY (`service_category_id`) REFERENCES `master_service_categories` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `master_services_service_unit_id_foreign` FOREIGN KEY (`service_unit_id`) REFERENCES `master_service_units` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_services`
--

LOCK TABLES `master_services` WRITE;
/*!40000 ALTER TABLE `master_services` DISABLE KEYS */;
INSERT INTO `master_services` VALUES (1,2,1,'SURAT-AKTIF','Surat Keterangan Aktif Kuliah','Permohonan Surat Keterangan Aktif Kuliah.',24,2048,1,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(2,2,1,'SURAT-MHS','Surat Keterangan Mahasiswa','Permohonan Surat Keterangan Mahasiswa.',24,2048,1,1,2,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(3,2,1,'DAFTAR-NILAI','Permohonan Daftar Nilai','Permohonan Daftar Nilai Akademik.',24,2048,1,1,3,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(4,2,1,'LEGALISIR-IJAZAH','Legalisasi Ijazah','Permohonan legalisasi ijazah.',48,4096,1,1,4,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(5,2,1,'LEGALISIR-TRANSKRIP','Legalisasi Transkrip Nilai','Permohonan legalisasi transkrip nilai.',48,4096,1,1,5,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(6,2,2,'CUTI-AKADEMIK','Pengajuan Cuti Akademik','Pengajuan cuti akademik.',72,4096,1,1,6,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(7,2,2,'AKTIF-KEMBALI','Aktif Kembali Setelah Cuti','Permohonan aktif kembali setelah cuti.',72,4096,1,1,7,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(8,2,2,'PENGUNDURAN-DIRI','Pengunduran Diri Mahasiswa','Permohonan pengunduran diri sebagai mahasiswa.',120,4096,1,1,8,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(9,2,3,'PENDAFTARAN-WISUDA','Pendaftaran Wisuda','Permohonan pendaftaran wisuda.',72,4096,1,1,9,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(10,2,3,'YUDISIUM','Administrasi Yudisium','Permohonan administrasi yudisium.',72,4096,1,1,10,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(11,3,4,'PENGAJUAN-UKT','Pengajuan Penyesuaian UKT','Pengajuan penyesuaian besaran UKT.',120,4096,1,1,11,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(12,3,4,'CICILAN-UKT','Pengajuan Cicilan UKT','Pengajuan pembayaran UKT secara cicilan.',120,4096,1,1,12,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(13,3,4,'PENUNDAAN-UKT','Pengajuan Penundaan Pembayaran UKT','Pengajuan penundaan pembayaran UKT.',120,4096,1,1,13,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(14,3,5,'VALIDASI-PEMBAYARAN','Validasi Pembayaran','Validasi bukti pembayaran mahasiswa.',24,4096,1,1,14,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(15,3,5,'PENGEMBALIAN-DANA','Pengembalian Dana','Permohonan pengembalian dana pembayaran.',168,4096,1,1,15,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(16,3,5,'KWITANSI','Permohonan Kwitansi Pembayaran','Permohonan penerbitan kwitansi pembayaran resmi.',24,2048,1,1,16,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(17,3,5,'KOREKSI-PEMBAYARAN','Koreksi Data Pembayaran','Permohonan koreksi data pembayaran mahasiswa.',48,4096,1,1,17,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(18,4,6,'BEASISWA-PENDAFTARAN','Pendaftaran Beasiswa','Pengajuan pendaftaran program beasiswa.',120,4096,1,1,18,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(19,4,6,'BEASISWA-PERPANJANGAN','Perpanjangan Beasiswa','Pengajuan perpanjangan beasiswa.',120,4096,1,1,19,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(20,4,6,'BEASISWA-SURAT','Surat Rekomendasi Beasiswa','Permohonan surat rekomendasi beasiswa.',48,2048,1,1,20,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(21,4,7,'ORMAWA-KEGIATAN','Persetujuan Kegiatan Organisasi Mahasiswa','Pengajuan persetujuan kegiatan organisasi mahasiswa.',72,4096,1,1,21,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(22,4,7,'ORMAWA-PENDANAAN','Pengajuan Pendanaan Kegiatan','Pengajuan bantuan dana kegiatan organisasi mahasiswa.',120,4096,1,1,22,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(23,4,7,'ORMAWA-FASILITAS','Peminjaman Fasilitas Kegiatan','Pengajuan peminjaman fasilitas untuk kegiatan mahasiswa.',48,2048,1,1,23,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(24,4,7,'PRESTASI-MHS','Pelaporan Prestasi Mahasiswa','Pelaporan prestasi akademik maupun non-akademik mahasiswa.',48,4096,1,1,24,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(25,4,7,'KONSELING-MHS','Layanan Konseling Mahasiswa','Pengajuan layanan konseling mahasiswa.',24,2048,1,1,25,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(26,5,8,'BEBAS-PUSTAKA','Surat Bebas Pustaka','Permohonan Surat Bebas Pustaka bagi mahasiswa.',24,2048,1,1,26,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(27,5,8,'DAFTAR-ANGGOTA','Pendaftaran Anggota Perpustakaan','Pendaftaran anggota perpustakaan.',24,2048,1,1,27,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(28,5,8,'GANTI-KARTU-PERPUS','Penggantian Kartu Perpustakaan','Permohonan penggantian kartu anggota perpustakaan.',24,2048,1,1,28,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(29,5,8,'DENDA-PERPUS','Pembayaran Denda Perpustakaan','Layanan pembayaran denda keterlambatan pengembalian buku.',24,2048,1,1,29,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(30,5,8,'USUL-BUKU','Usulan Pengadaan Buku','Pengajuan usulan pengadaan koleksi buku baru.',168,2048,1,1,30,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(31,5,8,'LITERATUR','Bantuan Penelusuran Literatur','Permohonan bantuan pencarian referensi ilmiah.',48,2048,1,1,31,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(32,6,9,'DOSEN-PA','Pengajuan Dosen Pembimbing Akademik','Permohonan penetapan atau perubahan dosen pembimbing akademik.',72,2048,1,1,32,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(33,6,9,'PKL','Pengajuan Kerja Praktik / PKL','Pengajuan administrasi Kerja Praktik atau PKL.',72,4096,1,1,33,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(34,6,9,'MAGANG','Pengajuan Magang','Pengajuan administrasi kegiatan magang.',72,4096,1,1,34,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(35,6,10,'TA-PEMBIMBING','Pengajuan Dosen Pembimbing Tugas Akhir','Permohonan penetapan dosen pembimbing tugas akhir.',72,4096,1,1,35,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(36,6,10,'TA-JUDUL','Pengajuan Judul Tugas Akhir','Pengajuan atau perubahan judul tugas akhir.',72,4096,1,1,36,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(37,6,10,'SEMPRO','Pendaftaran Seminar Proposal','Pendaftaran seminar proposal tugas akhir.',72,4096,1,1,37,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(38,6,10,'SEMHAS','Pendaftaran Seminar Hasil','Pendaftaran seminar hasil tugas akhir.',72,4096,1,1,38,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(39,6,10,'SIDANG-TA','Pendaftaran Sidang Tugas Akhir','Pendaftaran sidang tugas akhir.',120,4096,1,1,39,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(40,6,9,'SURAT-PENGANTAR','Surat Pengantar Jurusan','Permohonan surat pengantar dari jurusan.',24,2048,1,1,40,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(41,7,11,'RESET-PASSWORD','Reset Password Akun Mahasiswa','Permohonan reset password akun mahasiswa.',24,2048,1,1,41,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(42,7,11,'AKTIVASI-AKUN','Aktivasi Akun Mahasiswa','Permohonan aktivasi akun mahasiswa.',24,2048,1,1,42,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(43,7,11,'EMAIL-INSTITUSI','Aktivasi Email Institusi','Permohonan aktivasi email institusi.',24,2048,1,1,43,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(44,7,11,'UBAH-DATA-AKUN','Perubahan Data Akun','Permohonan perubahan data akun pengguna.',24,2048,1,1,44,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(45,7,12,'WIFI-KAMPUS','Akses WiFi Kampus','Permohonan bantuan akses WiFi kampus.',24,2048,1,1,45,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(46,7,12,'VPN','Akses VPN Kampus','Permohonan akses VPN kampus.',24,2048,1,1,46,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(47,7,12,'HELPDESK-TI','Layanan Helpdesk TI','Pelaporan kendala layanan teknologi informasi.',24,2048,1,1,47,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(48,8,13,'PINJAM-RUANG','Peminjaman Ruangan','Permohonan peminjaman ruangan.',48,2048,1,1,48,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(49,8,13,'PINJAM-SARPRAS','Peminjaman Sarana dan Prasarana','Permohonan peminjaman sarana dan prasarana.',48,2048,1,1,49,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(50,8,13,'SURAT-MASUK','Layanan Surat Masuk dan Keluar','Administrasi surat masuk dan surat keluar.',24,2048,1,1,50,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL);
/*!40000 ALTER TABLE `master_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_study_programs`
--

DROP TABLE IF EXISTS `master_study_programs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_study_programs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `department_id` int unsigned NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `short_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `degree` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `sort_order` int NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `department_id` (`department_id`),
  KEY `degree` (`degree`),
  KEY `is_active` (`is_active`),
  CONSTRAINT `master_study_programs_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `master_departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_study_programs`
--

LOCK TABLES `master_study_programs` WRITE;
/*!40000 ALTER TABLE `master_study_programs` DISABLE KEYS */;
INSERT INTO `master_study_programs` VALUES (1,1,'TKG','Teknik Konstruksi Gedung','TKG','D3',NULL,1,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(2,1,'TKS','Teknik Konstruksi Sipil','TKS','D3',NULL,2,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(3,1,'TPJJ','Teknik Perancangan Jalan dan Jembatan','TPJJ','D4',NULL,3,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(4,1,'TPPG','Teknik Perawatan dan Perbaikan Gedung','TPPG','D4',NULL,4,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(5,1,'RI','Rekayasa Infrastruktur','RI','S2',NULL,5,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(6,2,'TM','Teknik Mesin','TM','D3',NULL,6,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(7,2,'TA','Teknik Aeronautika','TA','D3',NULL,7,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(8,2,'TPKM','Teknik Perancangan dan Konstruksi Mesin','TPKM','D4',NULL,8,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(9,2,'PM','Proses Manufaktur','PM','D4',NULL,9,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(10,3,'D3-TPTU','Teknik Pendingin dan Tata Udara','TPTU','D3',NULL,10,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(11,3,'D4-TPTU','Teknik Pendingin dan Tata Udara','TPTU','D4',NULL,11,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(12,4,'TKE','Teknik Konversi Energi','TKE','D3',NULL,12,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(13,4,'TPTL','Teknologi Pembangkit Tenaga Listrik','TPTL','D4',NULL,13,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(14,5,'D3-TEL','Teknik Elektronika','Teknik Elektronika','D3',NULL,15,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(15,5,'TL','Teknik Listrik','Teknik Listrik','D3',NULL,16,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(16,5,'D3-TT','Teknik Telekomunikasi','Teknik Telekomunikasi','D3',NULL,17,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(17,5,'D4-TEL','Teknik Elektronika','Teknik Elektronika','D4',NULL,18,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(18,5,'TOI','Teknik Otomasi Industri','TOI','D4',NULL,19,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(19,5,'D4-TT','Teknik Telekomunikasi','Teknik Telekomunikasi','D4',NULL,20,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(20,6,'TK','Teknik Kimia','Teknik Kimia','D3',NULL,21,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(21,6,'AK','Analis Kimia','Analis Kimia','D3',NULL,22,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(22,6,'TKK','Teknik Kimia Produksi Bersih','TKPB','D4',NULL,23,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(23,7,'D3-TI','Teknik Informatika','Teknik Informatika','D3',NULL,24,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(24,7,'D4-TI','Teknik Informatika','Teknik Informatika','D4',NULL,25,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(25,8,'D3-AK','Akuntansi','Akuntansi','D3',NULL,26,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(26,8,'D3-KP','Keuangan dan Perbankan','Keuangan & Perbankan','D3',NULL,27,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(27,8,'D4-AK','Akuntansi','Akuntansi','D4',NULL,28,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(28,8,'D4-AMP','Akuntansi Manajemen Pemerintahan','AMP','D4',NULL,29,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(29,8,'D4-KS','Keuangan Syariah','Keuangan Syariah','D4',NULL,30,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(30,9,'D3-AB','Administrasi Bisnis','Administrasi Bisnis','D3',NULL,31,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(31,9,'D3-UPW','Usaha Perjalanan Wisata','UPW','D3',NULL,32,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(32,9,'D3-MP','Manajemen Pemasaran','Manajemen Pemasaran','D3',NULL,33,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(33,9,'D4-AB','Administrasi Bisnis','Administrasi Bisnis','D4',NULL,34,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(34,9,'D4-DP','Destinasi Pariwisata','Destinasi Pariwisata','D4',NULL,35,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(35,9,'D4-MA','Manajemen Aset','Manajemen Aset','D4',NULL,36,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(36,9,'D4-MP','Manajemen Pemasaran','Manajemen Pemasaran','D4',NULL,37,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(37,10,'D3-BI','Bahasa Inggris','Bahasa Inggris','D3',NULL,38,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(38,10,'D4-BIKBP','Bahasa Inggris untuk Komunikasi Bisnis dan Profesional','BIKBP','D4',NULL,39,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(39,1,'S2-RI','Rekayasa Infrastruktur','RI','S2',NULL,40,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(40,8,'S2-KPS','Keuangan dan Perbankan Syariah','KPS','S2',NULL,41,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL),(41,9,'S2-PIT','Pemasaran, Inovasi dan Teknologi','PIT','S2',NULL,42,1,'2026-09-11 05:42:40','2026-09-11 05:42:40',NULL);
/*!40000 ALTER TABLE `master_study_programs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2026-08-03-000001','App\\Database\\Migrations\\CreateRolesTable','default','App',1787030189,1),(2,'2026-08-03-000002','App\\Database\\Migrations\\CreatePermissionsTable','default','App',1787030189,1),(3,'2026-08-03-000003','App\\Database\\Migrations\\CreateRolePermissionsTable','default','App',1787030190,1),(4,'2026-08-03-000004','App\\Database\\Migrations\\CreateUsersTable','default','App',1787030190,1),(5,'2026-08-03-000005','App\\Database\\Migrations\\CreateMasterDepartmentsTable','default','App',1787030190,1),(6,'2026-08-03-000006','App\\Database\\Migrations\\CreateMasterStudyProgramsTable','default','App',1787030190,1),(7,'2026-08-03-000007','App\\Database\\Migrations\\CreateMasterClassesTable','default','App',1787030190,1),(8,'2026-08-03-000008','App\\Database\\Migrations\\CreateMasterApplicantTypesTable','default','App',1787030190,1),(9,'2026-08-03-000009','App\\Database\\Migrations\\CreateUserProfilesTable','default','App',1787030190,1),(10,'2026-08-03-000010','App\\Database\\Migrations\\CreateMasterServiceUnitsTable','default','App',1787030190,1),(11,'2026-08-03-000011','App\\Database\\Migrations\\CreateMasterServiceCategoriesTable','default','App',1787030190,1),(12,'2026-08-03-000012','App\\Database\\Migrations\\CreateMasterServicesTable','default','App',1787030190,1),(13,'2026-08-03-000013','App\\Database\\Migrations\\CreateMasterServiceRequirementsTable','default','App',1787030190,1),(14,'2026-08-03-000014','App\\Database\\Migrations\\CreateServiceRequestsTable','default','App',1787030190,1),(15,'2026-08-03-000015','App\\Database\\Migrations\\CreateServiceRequestFilesTable','default','App',1787030190,1),(16,'2026-08-03-000016','App\\Database\\Migrations\\CreateServiceRequestLogsTable','default','App',1787030191,1),(17,'2026-08-03-000017','App\\Database\\Migrations\\CreateNotificationsTable','default','App',1787030191,1),(18,'2026-08-03-000018','App\\Database\\Migrations\\CreateActivityLogsTable','default','App',1787030191,1),(19,'2026-08-03-000019','App\\Database\\Migrations\\AddMissingColumnsToPermissionsAndRoles','default','App',1787030191,1),(20,'2026-08-07-000001','App\\Database\\Migrations\\AddApplicantDetailFieldsToUserProfiles','default','App',1787030191,1),(21,'2026-08-09-000001','App\\Database\\Migrations\\CreateTicketsTable','default','App',1787030191,1),(22,'2026-08-24-000001','App\\Database\\Migrations\\AddMfaColumnsToUsersTable','default','App',1788747169,2),(23,'2026-09-11-000001','App\\Database\\Migrations\\CreateUptTikTicketsTable','default','App',1789089495,3),(24,'2026-09-11-000002','App\\Database\\Migrations\\CreateUptTikActivityLogsTable','default','App',1789090174,4),(25,'2026-09-11-000003','App\\Database\\Migrations\\CreateAdministrasiUmumTicketsTable','default','App',1789092380,5),(26,'2026-09-11-000004','App\\Database\\Migrations\\CreateAdministrasiUmumActivityLogsTable','default','App',1789092380,5),(27,'2026-09-11-000005','App\\Database\\Migrations\\CreatePerpustakaanTicketsTable','default','App',1789099393,6),(28,'2026-09-11-000006','App\\Database\\Migrations\\CreatePerpustakaanActivityLogsTable','default','App',1789099393,6),(29,'2026-09-11-000007','App\\Database\\Migrations\\CreateJurusanTicketsTable','default','App',1789099393,6),(30,'2026-09-11-000008','App\\Database\\Migrations\\CreateJurusanActivityLogsTable','default','App',1789099393,6),(31,'2026-09-11-000009','App\\Database\\Migrations\\AddMetadataToAdministrasiUmumTickets','default','App',1789099471,7),(32,'2026-09-11-000010','App\\Database\\Migrations\\CreateCoreUnitIsolatedTickets','default','App',1789100732,8),(33,'2026-09-11-000011','App\\Database\\Migrations\\CreateCoreUnitActivityLogs','default','App',1789100732,8),(34,'2026-09-11-000010','App\\Database\\Migrations\\CreateAndMigrateCoreUnitData','default','App',1789102359,9),(35,'2026-09-14-000001','App\\Database\\Migrations\\AddSentTrackingColumnsToUnitTickets','default','App',1789347598,10),(36,'2026-09-17-000001','App\\Database\\Migrations\\AddResultDocumentColumnsToUptTikTickets','default','App',1789612826,11);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `service_request_id` bigint unsigned DEFAULT NULL,
  `title` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `type` enum('info','success','warning','danger') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'info',
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `read_at` datetime DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `service_request_id` (`service_request_id`),
  KEY `is_read` (`is_read`),
  KEY `created_at` (`created_at`),
  CONSTRAINT `notifications_service_request_id_foreign` FOREIGN KEY (`service_request_id`) REFERENCES `service_requests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `module` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sort_order` int DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'dashboard.view','Lihat Dashboard','Lihat Dashboard - Dashboard','Dashboard',1,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(2,'department.view','Lihat Jurusan','Lihat Jurusan - Department','Department',1,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(3,'department.create','Tambah Jurusan','Tambah Jurusan - Department','Department',2,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(4,'department.update','Ubah Jurusan','Ubah Jurusan - Department','Department',3,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(5,'department.delete','Hapus Jurusan','Hapus Jurusan - Department','Department',4,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(6,'department.restore','Pulihkan Jurusan','Pulihkan Jurusan - Department','Department',5,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(7,'study_program.view','Lihat Program Studi','Lihat Program Studi - Study Program','Study Program',1,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(8,'study_program.create','Tambah Program Studi','Tambah Program Studi - Study Program','Study Program',2,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(9,'study_program.update','Ubah Program Studi','Ubah Program Studi - Study Program','Study Program',3,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(10,'study_program.delete','Hapus Program Studi','Hapus Program Studi - Study Program','Study Program',4,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(11,'study_program.restore','Pulihkan Program Studi','Pulihkan Program Studi - Study Program','Study Program',5,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(12,'class.view','Lihat Kelas','Lihat Kelas - Class','Class',1,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(13,'class.create','Tambah Kelas','Tambah Kelas - Class','Class',2,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(14,'class.update','Ubah Kelas','Ubah Kelas - Class','Class',3,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(15,'class.delete','Hapus Kelas','Hapus Kelas - Class','Class',4,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(16,'class.restore','Pulihkan Kelas','Pulihkan Kelas - Class','Class',5,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(17,'applicant_type.view','Lihat Jenis Pemohon','Lihat Jenis Pemohon - Applicant Type','Applicant Type',1,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(18,'applicant_type.create','Tambah Jenis Pemohon','Tambah Jenis Pemohon - Applicant Type','Applicant Type',2,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(19,'applicant_type.update','Ubah Jenis Pemohon','Ubah Jenis Pemohon - Applicant Type','Applicant Type',3,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(20,'applicant_type.delete','Hapus Jenis Pemohon','Hapus Jenis Pemohon - Applicant Type','Applicant Type',4,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(21,'applicant_type.restore','Pulihkan Jenis Pemohon','Pulihkan Jenis Pemohon - Applicant Type','Applicant Type',5,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(22,'service_unit.view','Lihat Unit Layanan','Lihat Unit Layanan - Service Unit','Service Unit',1,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(23,'service_unit.create','Tambah Unit Layanan','Tambah Unit Layanan - Service Unit','Service Unit',2,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(24,'service_unit.update','Ubah Unit Layanan','Ubah Unit Layanan - Service Unit','Service Unit',3,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(25,'service_unit.delete','Hapus Unit Layanan','Hapus Unit Layanan - Service Unit','Service Unit',4,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(26,'service_unit.restore','Pulihkan Unit Layanan','Pulihkan Unit Layanan - Service Unit','Service Unit',5,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(27,'service_category.view','Lihat Kategori Layanan','Lihat Kategori Layanan - Service Category','Service Category',1,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(28,'service_category.create','Tambah Kategori Layanan','Tambah Kategori Layanan - Service Category','Service Category',2,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(29,'service_category.update','Ubah Kategori Layanan','Ubah Kategori Layanan - Service Category','Service Category',3,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(30,'service_category.delete','Hapus Kategori Layanan','Hapus Kategori Layanan - Service Category','Service Category',4,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(31,'service_category.restore','Pulihkan Kategori Layanan','Pulihkan Kategori Layanan - Service Category','Service Category',5,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(32,'service.view','Lihat Layanan','Lihat Layanan - Service','Service',1,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(33,'service.create','Tambah Layanan','Tambah Layanan - Service','Service',2,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(34,'service.update','Ubah Layanan','Ubah Layanan - Service','Service',3,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(35,'service.delete','Hapus Layanan','Hapus Layanan - Service','Service',4,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(36,'service.restore','Pulihkan Layanan','Pulihkan Layanan - Service','Service',5,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(37,'service_requirement.view','Lihat Persyaratan','Lihat Persyaratan - Service Requirement','Service Requirement',1,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(38,'service_requirement.create','Tambah Persyaratan','Tambah Persyaratan - Service Requirement','Service Requirement',2,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(39,'service_requirement.update','Ubah Persyaratan','Ubah Persyaratan - Service Requirement','Service Requirement',3,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(40,'service_requirement.delete','Hapus Persyaratan','Hapus Persyaratan - Service Requirement','Service Requirement',4,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(41,'service_requirement.restore','Pulihkan Persyaratan','Pulihkan Persyaratan - Service Requirement','Service Requirement',5,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(42,'user.view','Lihat User','Lihat User - User','User',1,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(43,'user.create','Tambah User','Tambah User - User','User',2,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(44,'user.update','Ubah User','Ubah User - User','User',3,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(45,'user.delete','Hapus User','Hapus User - User','User',4,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(46,'user.restore','Pulihkan User','Pulihkan User - User','User',5,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(47,'user.reset_password','Reset Password','Reset Password - User','User',6,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(48,'role.view','Lihat Role','Lihat Role - Role','Role',1,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(49,'role.create','Tambah Role','Tambah Role - Role','Role',2,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(50,'role.update','Ubah Role','Ubah Role - Role','Role',3,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(51,'role.delete','Hapus Role','Hapus Role - Role','Role',4,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(52,'permission.view','Lihat Permission','Lihat Permission - Permission','Permission',1,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(53,'permission.update','Ubah Permission','Ubah Permission - Permission','Permission',2,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(54,'request.create','Buat Pengajuan','Buat Pengajuan - Request','Request',1,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(55,'request.view','Lihat Pengajuan','Lihat Pengajuan - Request','Request',2,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(56,'request.verify','Verifikasi Pengajuan','Verifikasi Pengajuan - Request','Request',3,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(57,'request.approve','Setujui Pengajuan','Setujui Pengajuan - Request','Request',4,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(58,'request.reject','Tolak Pengajuan','Tolak Pengajuan - Request','Request',5,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(59,'request.complete','Selesaikan Pengajuan','Selesaikan Pengajuan - Request','Request',6,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(60,'request.cancel','Batalkan Pengajuan','Batalkan Pengajuan - Request','Request',7,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(61,'notification.view','Lihat Notifikasi','Lihat Notifikasi - Notification','Notification',1,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(62,'activity_log.view','Lihat Activity Log','Lihat Activity Log - Activity Log','Activity Log',1,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(63,'report.view','Lihat Laporan','Lihat Laporan - Report','Report',1,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(64,'report.export','Export Laporan','Export Laporan - Report','Report',2,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(65,'statistic.view','Lihat Statistik','Lihat Statistik - Statistic','Statistic',1,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perpustakaan_activity_logs`
--

DROP TABLE IF EXISTS `perpustakaan_activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perpustakaan_activity_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
  `ticket_id` bigint unsigned DEFAULT NULL,
  `action` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `activity` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket_id` (`ticket_id`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perpustakaan_activity_logs`
--

LOCK TABLES `perpustakaan_activity_logs` WRITE;
/*!40000 ALTER TABLE `perpustakaan_activity_logs` DISABLE KEYS */;
INSERT INTO `perpustakaan_activity_logs` VALUES (1,7,4,'STATUS_CHANGED','Mengubah status tiket PERPUS-DUMMY-2','completed',NULL,'2026-09-11 08:14:27'),(2,7,3,'STATUS_CHANGED','Mengubah status tiket PERPUS-DUMMY-1','completed',NULL,'2026-09-11 08:15:18'),(3,7,3,'STATUS_CHANGED','Mengubah status tiket PERPUS-DUMMY-1','completed',NULL,'2026-09-11 08:15:55'),(4,7,4,'STATUS_CHANGED','Mengubah status tiket PERPUS-DUMMY-2','completed',NULL,'2026-09-11 08:23:36');
/*!40000 ALTER TABLE `perpustakaan_activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perpustakaan_tickets`
--

DROP TABLE IF EXISTS `perpustakaan_tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perpustakaan_tickets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ticket_number` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `applicant_name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `applicant_identifier` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `service_name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `service_category` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `unit_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Perpustakaan',
  `title` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('submitted','processing','completed','rejected','cancelled') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'submitted',
  `priority` enum('low','normal','high','urgent') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'normal',
  `admin_note` text COLLATE utf8mb4_general_ci,
  `result_note` text COLLATE utf8mb4_general_ci,
  `result_file` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `submitted_at` datetime DEFAULT NULL,
  `processed_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `sent_to_ult` tinyint(1) NOT NULL DEFAULT '0',
  `sent_to_ult_at` datetime DEFAULT NULL,
  `sent_to_applicant` tinyint(1) NOT NULL DEFAULT '0',
  `sent_to_applicant_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ticket_number` (`ticket_number`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perpustakaan_tickets`
--

LOCK TABLES `perpustakaan_tickets` WRITE;
/*!40000 ALTER TABLE `perpustakaan_tickets` DISABLE KEYS */;
INSERT INTO `perpustakaan_tickets` VALUES (3,'PERPUS-DUMMY-1','Nadia Putri','3201010101010003','Peminjaman Buku','Perpustakaan','Perpustakaan','Permohonan peminjaman buku referensi','Data dummy untuk pengujian alur layanan Peminjaman Buku pada unit Perpustakaan.','completed','normal','',NULL,NULL,'2026-09-11 07:03:46','2026-09-11 07:51:01','2026-09-11 08:15:55','2026-09-11 07:03:46','2026-09-11 08:15:55',NULL,0,NULL,0,NULL),(4,'PERPUS-DUMMY-2','Rizky Maulana','3201010101010004','Surat Bebas Pustaka','Perpustakaan','Perpustakaan','Pengajuan surat bebas pustaka','Data dummy untuk pengujian alur layanan Surat Bebas Pustaka pada unit Perpustakaan.','completed','normal','Sedang diproses oleh petugas unit.',NULL,NULL,'2026-09-11 07:03:46','2026-09-17 03:54:03','2026-09-17 03:54:03','2026-09-11 07:03:46','2026-09-17 03:54:03',NULL,0,NULL,0,NULL);
/*!40000 ALTER TABLE `perpustakaan_tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_permissions`
--

DROP TABLE IF EXISTS `role_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_permissions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int unsigned NOT NULL,
  `permission_id` int unsigned NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_permissions_role_id_foreign` (`role_id`),
  KEY `role_permissions_permission_id_foreign` (`permission_id`),
  CONSTRAINT `role_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_permissions`
--

LOCK TABLES `role_permissions` WRITE;
/*!40000 ALTER TABLE `role_permissions` DISABLE KEYS */;
INSERT INTO `role_permissions` VALUES (1,1,1,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(2,1,2,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(3,1,3,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(4,1,4,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(5,1,5,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(6,1,6,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(7,1,7,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(8,1,8,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(9,1,9,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(10,1,10,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(11,1,11,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(12,1,12,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(13,1,13,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(14,1,14,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(15,1,15,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(16,1,16,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(17,1,17,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(18,1,18,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(19,1,19,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(20,1,20,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(21,1,21,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(22,1,22,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(23,1,23,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(24,1,24,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(25,1,25,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(26,1,26,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(27,1,27,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(28,1,28,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(29,1,29,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(30,1,30,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(31,1,31,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(32,1,32,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(33,1,33,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(34,1,34,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(35,1,35,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(36,1,36,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(37,1,37,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(38,1,38,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(39,1,39,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(40,1,40,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(41,1,41,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(42,1,42,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(43,1,43,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(44,1,44,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(45,1,45,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(46,1,46,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(47,1,47,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(48,1,48,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(49,1,49,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(50,1,50,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(51,1,51,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(52,1,52,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(53,1,53,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(54,1,54,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(55,1,55,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(56,1,56,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(57,1,57,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(58,1,58,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(59,1,59,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(60,1,60,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(61,1,61,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(62,1,62,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(63,1,63,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(64,1,64,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(65,1,65,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(66,2,1,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(67,2,42,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(68,2,43,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(69,2,44,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(70,2,45,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(71,2,46,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(72,2,47,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(73,2,17,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(74,2,18,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(75,2,19,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(76,2,20,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(77,2,21,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(78,2,2,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(79,2,3,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(80,2,4,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(81,2,5,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(82,2,6,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(83,2,7,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(84,2,8,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(85,2,9,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(86,2,10,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(87,2,11,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(88,2,12,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(89,2,13,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(90,2,14,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(91,2,15,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(92,2,16,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(93,2,22,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(94,2,23,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(95,2,24,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(96,2,25,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(97,2,26,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(98,2,27,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(99,2,28,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(100,2,29,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(101,2,30,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(102,2,31,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(103,2,32,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(104,2,33,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(105,2,34,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(106,2,35,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(107,2,36,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(108,2,37,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(109,2,38,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(110,2,39,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(111,2,40,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(112,2,41,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(113,2,55,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(114,2,54,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(115,2,56,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(116,2,57,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(117,2,58,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(118,2,59,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(119,2,60,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(120,2,61,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(121,2,62,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(122,2,63,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(123,2,64,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(124,2,65,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(125,8,1,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(126,8,55,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(127,8,56,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(128,8,59,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(129,8,61,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(130,8,65,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(131,9,1,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(132,9,55,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(133,9,56,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(134,9,59,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(135,9,61,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(136,9,65,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(137,10,1,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(138,10,55,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(139,10,54,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(140,10,60,'2026-09-11 05:42:39','2026-09-11 05:42:39'),(141,10,61,'2026-09-11 05:42:39','2026-09-11 05:42:39');
/*!40000 ALTER TABLE `role_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `sort_order` int DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'SUPER_ADMIN','Super Administrator','Memiliki akses penuh ke seluruh sistem.',1,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(2,'ADMIN_ULT','Admin ULT','Mengelola layanan dan operasional Unit Layanan Terpadu.',2,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(3,'PETUGAS_AKADEMIK','Petugas Akademik','Memverifikasi dan memproses layanan akademik.',3,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(4,'PETUGAS_TIK','Petugas UPT TIK','Mengelola tiket layanan teknologi informasi dan komunikasi.',4,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(5,'PETUGAS_UMUM','Petugas Administrasi Umum','Mengelola tiket layanan Bagian Administrasi Umum.',5,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(6,'PETUGAS_KEMAHASISWAAN','Petugas Kemahasiswaan','Memverifikasi dan memproses layanan kemahasiswaan.',6,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(7,'PETUGAS_KEUANGAN','Petugas Keuangan','Memverifikasi dan memproses layanan keuangan.',7,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(8,'PETUGAS_PERPUSTAKAAN','Petugas Perpustakaan','Memverifikasi dan memproses layanan perpustakaan.',8,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(9,'PETUGAS_JURUSAN','Petugas Jurusan','Memverifikasi dan memproses layanan jurusan.',9,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL),(10,'PEMOHON','Pemohon','Pengguna yang mengajukan layanan.',10,1,'2026-09-11 05:42:39','2026-09-11 05:42:39',NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_request_files`
--

DROP TABLE IF EXISTS `service_request_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_request_files` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `service_request_id` bigint unsigned NOT NULL,
  `requirement_id` int unsigned NOT NULL,
  `original_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `file_extension` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `mime_type` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `file_size` int NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `verified_by` int unsigned DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `notes` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_request_id` (`service_request_id`),
  KEY `requirement_id` (`requirement_id`),
  KEY `verified_by` (`verified_by`),
  CONSTRAINT `service_request_files_requirement_id_foreign` FOREIGN KEY (`requirement_id`) REFERENCES `master_service_requirements` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `service_request_files_service_request_id_foreign` FOREIGN KEY (`service_request_id`) REFERENCES `service_requests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `service_request_files_verified_by_foreign` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_request_files`
--

LOCK TABLES `service_request_files` WRITE;
/*!40000 ALTER TABLE `service_request_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_request_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_request_logs`
--

DROP TABLE IF EXISTS `service_request_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_request_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `service_request_id` bigint unsigned NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `old_status` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `new_status` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `action` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_request_id` (`service_request_id`),
  KEY `user_id` (`user_id`),
  KEY `new_status` (`new_status`),
  CONSTRAINT `service_request_logs_service_request_id_foreign` FOREIGN KEY (`service_request_id`) REFERENCES `service_requests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `service_request_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_request_logs`
--

LOCK TABLES `service_request_logs` WRITE;
/*!40000 ALTER TABLE `service_request_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_request_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_requests`
--

DROP TABLE IF EXISTS `service_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ticket_number` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `user_profile_id` int unsigned NOT NULL,
  `service_id` int unsigned NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `status` enum('draft','submitted','verification','revision','processing','completed','rejected','cancelled') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'submitted',
  `priority` enum('low','normal','high','urgent') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'normal',
  `assigned_to` int unsigned DEFAULT NULL,
  `submitted_at` datetime DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `processed_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `rejected_at` datetime DEFAULT NULL,
  `cancelled_at` datetime DEFAULT NULL,
  `admin_note` text COLLATE utf8mb4_general_ci,
  `rejection_reason` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ticket_number` (`ticket_number`),
  KEY `user_profile_id` (`user_profile_id`),
  KEY `service_id` (`service_id`),
  KEY `assigned_to` (`assigned_to`),
  KEY `status` (`status`),
  KEY `priority` (`priority`),
  CONSTRAINT `service_requests_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `service_requests_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `master_services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `service_requests_user_profile_id_foreign` FOREIGN KEY (`user_profile_id`) REFERENCES `user_profiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_requests`
--

LOCK TABLES `service_requests` WRITE;
/*!40000 ALTER TABLE `service_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tickets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ticket_number` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `user_profile_id` int unsigned NOT NULL,
  `service_id` int unsigned NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `status` enum('draft','submitted','verification','revision','assigned','processing','completed','rejected','cancelled') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'submitted',
  `priority` enum('low','normal','high','urgent') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'normal',
  `assigned_to` int unsigned DEFAULT NULL,
  `submitted_at` datetime DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `processed_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `rejected_at` datetime DEFAULT NULL,
  `cancelled_at` datetime DEFAULT NULL,
  `admin_note` text COLLATE utf8mb4_general_ci,
  `rejection_reason` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `sent_to_ult` tinyint(1) NOT NULL DEFAULT '0',
  `sent_to_ult_at` datetime DEFAULT NULL,
  `sent_to_applicant` tinyint(1) NOT NULL DEFAULT '0',
  `sent_to_applicant_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ticket_number` (`ticket_number`),
  KEY `user_profile_id` (`user_profile_id`),
  KEY `service_id` (`service_id`),
  KEY `assigned_to` (`assigned_to`),
  KEY `status` (`status`),
  KEY `priority` (`priority`),
  CONSTRAINT `tickets_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `tickets_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `master_services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tickets_user_profile_id_foreign` FOREIGN KEY (`user_profile_id`) REFERENCES `user_profiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
INSERT INTO `tickets` VALUES (1,'TKT-20260827-001',1,1,'Pengajuan Surat Keterangan Aktif Kuliah','Saya mengajukan permohonan Surat Keterangan Aktif Kuliah untuk keperluan administrasi.','completed','normal',NULL,'2026-08-27 09:50:25',NULL,'2026-08-31 01:14:41','2026-08-31 01:17:29',NULL,NULL,'',NULL,'2026-08-27 09:50:25','2026-09-08 00:59:40',NULL,1,'2026-09-01 08:56:38',1,'2026-09-01 03:50:09'),(2,'TKT-20260830-002',1,1,'Pengajuan Surat Keterangan Aktif Kuliah','Saya mengajukan permohonan Surat Keterangan Aktif Kuliah untuk keperluan administrasi.','completed','normal',NULL,'2026-08-30 17:02:09',NULL,'2026-09-01 07:09:01','2026-09-02 06:34:56',NULL,NULL,'',NULL,'2026-08-30 17:02:09','2026-09-22 02:02:33',NULL,1,'2026-09-22 02:02:33',1,'2026-09-01 03:20:10');
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `upt_tik_activity_logs`
--

DROP TABLE IF EXISTS `upt_tik_activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `upt_tik_activity_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
  `ticket_id` bigint unsigned DEFAULT NULL,
  `action` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `activity` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_general_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `ticket_id` (`ticket_id`),
  KEY `action` (`action`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `upt_tik_activity_logs`
--

LOCK TABLES `upt_tik_activity_logs` WRITE;
/*!40000 ALTER TABLE `upt_tik_activity_logs` DISABLE KEYS */;
INSERT INTO `upt_tik_activity_logs` VALUES (1,3,NULL,'LOGIN','Login ke sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 05:48:21'),(2,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 05:48:21'),(3,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 05:48:23'),(4,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 05:48:25'),(5,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 05:49:06'),(6,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 05:50:03'),(7,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 05:50:06'),(8,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 05:53:10'),(9,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 05:53:13'),(10,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 05:53:30'),(11,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 05:55:50'),(12,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 05:55:53'),(13,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:06:06'),(14,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:06:09'),(15,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:06:12'),(16,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:06:33'),(17,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:06:35'),(18,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:11:52'),(19,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:11:55'),(20,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:11:57'),(21,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:13:25'),(22,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:13:27'),(23,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:13:29'),(24,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:13:33'),(25,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:15:26'),(26,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:15:29'),(27,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:15:31'),(28,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:15:34'),(29,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:19:38'),(30,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:19:40'),(31,3,1,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-1','submitted',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:19:42'),(32,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:19:47'),(33,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:22:33'),(34,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:22:35'),(35,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:22:38'),(36,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:22:54'),(37,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:22:56'),(38,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:24:50'),(39,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:24:52'),(40,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:24:55'),(41,3,1,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-1','submitted',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:25:12'),(42,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:25:14'),(43,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:28:02'),(44,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:28:03'),(45,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:28:06'),(46,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:28:08'),(47,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:28:11'),(48,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:28:14'),(49,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:28:17'),(50,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:30:23'),(51,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:30:25'),(52,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:30:27'),(53,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:30:30'),(54,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:30:48'),(55,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:30:50'),(56,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:30:52'),(57,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:30:54'),(58,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:32:54'),(59,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:32:55'),(60,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:32:58'),(61,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:33:00'),(62,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:33:05'),(63,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:34:29'),(64,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:36:11'),(65,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:36:13'),(66,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:36:15'),(67,3,1,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-1','submitted',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:36:18'),(68,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:36:21'),(69,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:39:20'),(70,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:39:22'),(71,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:39:24'),(72,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:39:27'),(73,3,NULL,'LOGOUT','Logout dari sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:39:56'),(74,3,NULL,'LOGIN','Login ke sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:40:03'),(75,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:40:04'),(76,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:40:06'),(77,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:40:08'),(78,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:40:10'),(79,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:42:22'),(80,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:42:23'),(81,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:42:25'),(82,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:42:27'),(83,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:44:31'),(84,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:44:33'),(85,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:44:35'),(86,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:44:38'),(87,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:46:42'),(88,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:46:43'),(89,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:46:45'),(90,3,NULL,'LOGOUT','Logout dari sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:51:19'),(91,3,NULL,'LOGIN','Login ke sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:53:25'),(92,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:53:25'),(93,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:53:50'),(94,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:53:51'),(95,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:53:53'),(96,3,NULL,'LOGOUT','Logout dari sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 06:58:51'),(97,3,NULL,'LOGIN','Login ke sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:00:45'),(98,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:00:45'),(99,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:00:50'),(100,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:01:24'),(101,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:01:42'),(102,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:01:44'),(103,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:02:00'),(104,3,NULL,'PROFILE_VIEW','Membuka profil petugas',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:02:01'),(105,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:02:02'),(106,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:02:06'),(107,3,NULL,'LOGOUT','Logout dari sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:02:18'),(108,3,NULL,'LOGIN','Login ke sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:06:43'),(109,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:06:44'),(110,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:06:46'),(111,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:06:48'),(112,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:07:19'),(113,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:07:22'),(114,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:07:55'),(115,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:10:45'),(116,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:10:47'),(117,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:10:49'),(118,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:15:00'),(119,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:15:02'),(120,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:15:09'),(121,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:15:14'),(122,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:15:17'),(123,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:15:22'),(124,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:19:51'),(125,3,2,'TICKET_PROCESS_VIEW','Membuka halaman proses tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:19:54'),(126,3,2,'TICKET_PROCESSED','Memproses tiket TIK-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:20:12'),(127,3,2,'STATUS_CHANGED','Mengubah status tiket TIK-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:20:12'),(128,3,2,'NOTE_ADDED','Menambahkan catatan pada tiket TIK-DUMMY-2','completed','Akses sistem sedang ditinjau oleh petugas UPT TIK.','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:20:12'),(129,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:20:12'),(130,3,NULL,'LOGOUT','Logout dari sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:20:40'),(131,3,NULL,'LOGIN','Login ke sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:21:46'),(132,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:21:46'),(133,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:21:49'),(134,3,1,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-1','submitted',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:21:51'),(135,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:21:55'),(136,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:21:57'),(137,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:23:59'),(138,3,2,'TICKET_PROCESS_VIEW','Membuka halaman proses tiket TIK-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:24:09'),(139,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:24:14'),(140,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:24:17'),(141,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:24:24'),(142,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:24:30'),(143,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:26:04'),(144,3,NULL,'ACTIVITY_LOG_VIEW','Membuka log aktivitas UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:26:27'),(145,3,NULL,'LOGOUT','Logout dari sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:26:33'),(146,3,NULL,'LOGIN','Login ke sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:38:11'),(147,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:38:11'),(148,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:38:13'),(149,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:38:15'),(150,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:38:19'),(151,3,1,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-1','submitted',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:38:20'),(152,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:38:24'),(153,3,NULL,'LOGOUT','Logout dari sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:38:30'),(154,3,NULL,'LOGIN','Login ke sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 09:35:45'),(155,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 09:35:46'),(156,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 09:35:48'),(157,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 09:35:52'),(158,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 09:36:06'),(159,3,NULL,'ACTIVITY_LOG_VIEW','Membuka log aktivitas UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 09:36:14'),(160,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 09:36:17'),(161,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 09:36:20'),(162,3,2,'TICKET_PROCESS_VIEW','Membuka halaman proses tiket TIK-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 09:36:22'),(163,3,2,'TICKET_PROCESSED','Memproses tiket TIK-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 09:36:33'),(164,3,2,'NOTE_ADDED','Menambahkan catatan pada tiket TIK-DUMMY-2','completed','Akses sistem sedang ditinjau oleh petugas UPT TIK.','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 09:36:33'),(165,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 09:36:33'),(166,3,NULL,'LOGOUT','Logout dari sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 09:36:48'),(167,3,NULL,'LOGIN','Login ke sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:07:16'),(168,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:07:16'),(169,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:07:18'),(170,3,1,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-1','submitted',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:07:21'),(171,3,1,'TICKET_PROCESS_VIEW','Membuka halaman proses tiket TIK-DUMMY-1','submitted',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:07:24'),(172,3,1,'TICKET_PROCESSED','Memproses tiket TIK-DUMMY-1','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:07:41'),(173,3,1,'STATUS_CHANGED','Mengubah status tiket TIK-DUMMY-1','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:07:41'),(174,3,1,'NOTE_ADDED','Menambahkan catatan pada tiket TIK-DUMMY-1','completed','ju','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:07:41'),(175,3,1,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-1','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:07:41'),(176,3,1,'TICKET_SENT_TO_ULT','Mengirim tiket TIK-DUMMY-1 ke Petugas ULT','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:07:47'),(177,3,1,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-1','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:07:47'),(178,3,NULL,'LOGOUT','Logout dari sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-14 01:09:19'),(179,3,NULL,'LOGIN','Login ke sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 03:52:24'),(180,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 03:52:24'),(181,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 03:52:26'),(182,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 03:52:29'),(183,3,2,'TICKET_PROCESS_VIEW','Membuka halaman proses tiket TIK-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 03:52:32'),(184,3,2,'TICKET_PROCESSED','Memproses tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 03:52:36'),(185,3,2,'STATUS_CHANGED','Mengubah status tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 03:52:37'),(186,3,2,'NOTE_ADDED','Menambahkan catatan pada tiket TIK-DUMMY-2','processing','Akses sistem sedang ditinjau oleh petugas UPT TIK.','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 03:52:37'),(187,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 03:52:37'),(188,3,2,'TICKET_PROCESS_VIEW','Membuka halaman proses tiket TIK-DUMMY-2','processing',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 03:52:41'),(189,3,2,'TICKET_PROCESSED','Memproses tiket TIK-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 03:52:46'),(190,3,2,'STATUS_CHANGED','Mengubah status tiket TIK-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 03:52:46'),(191,3,2,'NOTE_ADDED','Menambahkan catatan pada tiket TIK-DUMMY-2','completed','Akses sistem sedang ditinjau oleh petugas UPT TIK.','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 03:52:46'),(192,3,2,'TICKET_DETAIL_VIEW','Melihat detail tiket TIK-DUMMY-2','completed',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 03:52:46'),(193,3,NULL,'LOGOUT','Logout dari sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 03:52:51'),(194,3,NULL,'LOGIN','Login ke sistem utama',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-22 06:00:08'),(195,3,NULL,'DASHBOARD_VIEW','Membuka dashboard UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-22 06:00:08'),(196,3,NULL,'TICKET_LIST_VIEW','Membuka data tiket UPT TIK',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-22 06:00:17');
/*!40000 ALTER TABLE `upt_tik_activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `upt_tik_tickets`
--

DROP TABLE IF EXISTS `upt_tik_tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `upt_tik_tickets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ticket_number` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `applicant_name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `applicant_identifier` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `service_name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `status` enum('submitted','processing','completed','rejected','cancelled') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'submitted',
  `priority` enum('low','normal','high','urgent') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'normal',
  `assigned_to` int unsigned DEFAULT NULL,
  `admin_note` text COLLATE utf8mb4_general_ci,
  `submitted_at` datetime DEFAULT NULL,
  `processed_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `sent_to_ult` tinyint(1) NOT NULL DEFAULT '0',
  `sent_to_ult_at` datetime DEFAULT NULL,
  `sent_to_applicant` tinyint(1) NOT NULL DEFAULT '0',
  `sent_to_applicant_at` datetime DEFAULT NULL,
  `result_note` text COLLATE utf8mb4_general_ci,
  `result_file` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ticket_number` (`ticket_number`),
  KEY `status` (`status`),
  KEY `priority` (`priority`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `upt_tik_tickets`
--

LOCK TABLES `upt_tik_tickets` WRITE;
/*!40000 ALTER TABLE `upt_tik_tickets` DISABLE KEYS */;
INSERT INTO `upt_tik_tickets` VALUES (1,'TIK-DUMMY-1','Citra Dewi','3201010101010011','Reset Password Akun','Data dummy untuk pengujian alur layanan reset password akun pada unit UPT TIK.','completed','normal',NULL,'ju','2026-09-11 05:42:40',NULL,'2026-09-14 01:07:41','2026-09-11 05:42:40','2026-09-14 01:07:47',NULL,1,'2026-09-14 01:07:47',0,NULL,NULL,NULL),(2,'TIK-DUMMY-2','Farhan Akbar','3201010101010012','Permintaan Akses Sistem','Data dummy untuk pengujian alur layanan permintaan akses sistem pada unit UPT TIK.','completed','high',NULL,'Akses sistem sedang ditinjau oleh petugas UPT TIK.','2026-09-11 05:42:40','2026-09-17 03:52:36','2026-09-17 03:52:46','2026-09-11 05:42:40','2026-09-17 03:52:46',NULL,0,NULL,0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `upt_tik_tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_profiles`
--

DROP TABLE IF EXISTS `user_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_profiles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `applicant_type_id` int unsigned DEFAULT NULL,
  `study_program_id` int unsigned DEFAULT NULL,
  `class_id` int unsigned DEFAULT NULL,
  `student_name` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `institution_name` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `position` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nim` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nik` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_general_ci,
  `photo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_profiles_user_id_foreign` (`user_id`),
  KEY `user_profiles_applicant_type_id_foreign` (`applicant_type_id`),
  KEY `user_profiles_study_program_id_foreign` (`study_program_id`),
  KEY `user_profiles_class_id_foreign` (`class_id`),
  CONSTRAINT `user_profiles_applicant_type_id_foreign` FOREIGN KEY (`applicant_type_id`) REFERENCES `master_applicant_types` (`id`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `user_profiles_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `master_classes` (`id`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `user_profiles_study_program_id_foreign` FOREIGN KEY (`study_program_id`) REFERENCES `master_study_programs` (`id`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `user_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_profiles`
--

LOCK TABLES `user_profiles` WRITE;
/*!40000 ALTER TABLE `user_profiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int unsigned NOT NULL,
  `full_name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `identity_number` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `profile_photo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `last_login` datetime DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `mfa_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `mfa_secret` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mfa_recovery_codes` text COLLATE utf8mb4_general_ci,
  `mfa_confirmed_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`),
  KEY `identity_number` (`identity_number`),
  KEY `is_active` (`is_active`),
  KEY `deleted_at` (`deleted_at`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'Super Administrator','ADM001','081234567890','superadmin@polban.ac.id','$2y$10$YlHJMP.Hk5511c3N0VZ6ne28sqzW1P8EjiY/kpF3ozI9d/BBzNYDW',NULL,1,'2026-09-22 05:52:24',NULL,'2026-09-11 05:42:40','2026-09-11 05:42:40','2026-09-22 05:52:24',NULL,0,NULL,NULL,NULL),(2,3,'Petugas Akademik','AKD001',NULL,'petugas.akademik@polban.ac.id','$2y$10$.UKk2GZENhdAVObY.TqQIOV2tRbuzKtTX9u2m.CdCmLeBIkj9c.w.',NULL,1,NULL,NULL,'2026-09-11 05:42:40','2026-09-11 05:42:40','2026-09-11 05:42:40',NULL,0,NULL,NULL,NULL),(3,4,'Petugas UPT TIK','TIK001',NULL,'petugas.tik@polban.ac.id','$2y$10$W2xCBKerWowug/JpB6x.DeGy4Ia2bHe47Bmtqz.xWqt7RfXirz9dm',NULL,1,'2026-09-22 06:00:08',NULL,'2026-09-11 05:42:40','2026-09-11 05:42:40','2026-09-22 06:00:08',NULL,0,NULL,NULL,NULL),(4,5,'Petugas Administrasi Umum','UMUM001',NULL,'petugas.umum@polban.ac.id','$2y$10$/zlPsmX.kBijd5CFqIP.4untKFMjsVJK8iHTGAVeR7couRgAEJLKO',NULL,1,'2026-09-17 02:26:59',NULL,'2026-09-11 05:42:40','2026-09-11 05:42:40','2026-09-17 02:26:59',NULL,0,NULL,NULL,NULL),(5,6,'Petugas Kemahasiswaan','KMS001',NULL,'petugas.kemahasiswaan@polban.ac.id','$2y$10$zwZb4Jmn0PfgetrgSoCokuE8gWStxqflVR0GcA7KLauYglMh1.P8u',NULL,1,'2026-09-17 03:51:31',NULL,'2026-09-11 05:42:40','2026-09-11 05:42:40','2026-09-17 03:51:31',NULL,0,NULL,NULL,NULL),(6,7,'Petugas Keuangan','KEU001',NULL,'petugas.keuangan@polban.ac.id','$2y$10$MQkojgnYf2izU3z8uuXdUOGciREGnS4zgtfPZvtWsII4ePNZJcVly',NULL,1,'2026-09-22 05:52:59',NULL,'2026-09-11 05:42:40','2026-09-11 05:42:40','2026-09-22 05:52:59',NULL,0,NULL,NULL,NULL),(7,8,'Petugas Perpustakaan','PERP001',NULL,'petugas.perpustakaan@polban.ac.id','$2y$10$/q0/BETU3QRH.nj5ncWko.f0c5cpTmDF2IgI3JRW7E1nrU1ThdjJq',NULL,1,'2026-09-17 03:53:40',NULL,'2026-09-11 05:42:40','2026-09-11 05:42:40','2026-09-17 03:53:40',NULL,0,NULL,NULL,NULL),(8,9,'Petugas Jurusan','JUR001',NULL,'petugas.jurusan@polban.ac.id','$2y$10$A2xwPTGsnWTtGvC7/YmB5OkVNQkcKUipNNmpZSHO9um8Vt0bT7SQG',NULL,1,'2026-09-17 03:52:59',NULL,'2026-09-11 05:42:40','2026-09-11 05:42:40','2026-09-17 03:52:59',NULL,0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'si-ult-polban'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-22 13:10:49
