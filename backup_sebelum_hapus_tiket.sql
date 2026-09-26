-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: si-ult-polban
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `action` varchar(100) NOT NULL,
  `module` varchar(100) NOT NULL,
  `reference_id` varchar(100) DEFAULT NULL,
  `old_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`old_data`)),
  `new_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`new_data`)),
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `module` (`module`),
  KEY `action` (`action`),
  KEY `reference_id` (`reference_id`),
  KEY `created_at` (`created_at`),
  CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_logs`
--

LOCK TABLES `activity_logs` WRITE;
/*!40000 ALTER TABLE `activity_logs` DISABLE KEYS */;
INSERT INTO `activity_logs` VALUES (1,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-07 07:08:47'),(2,1,'LOGOUT','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-07 07:30:33'),(3,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-07 07:30:38'),(4,1,'LOGOUT','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-07 07:32:40'),(5,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-09 02:08:54'),(6,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-10 02:15:21'),(7,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-10 09:02:42'),(8,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 01:14:22'),(9,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0','2026-09-11 07:06:45'),(10,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-14 01:20:08'),(11,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-15 03:45:55'),(12,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-16 04:24:05'),(13,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 01:28:01'),(14,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-17 08:52:19'),(15,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-18 00:58:34'),(16,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-18 09:43:24'),(17,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-22 01:29:07'),(18,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-22 04:17:48'),(19,1,'LOGOUT','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-22 06:41:16'),(20,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-22 06:41:21'),(21,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-23 02:50:37'),(22,1,'LOGIN','auth','1',NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','2026-09-24 01:03:20');
/*!40000 ALTER TABLE `activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faqs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(255) DEFAULT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`),
  KEY `sort_order` (`sort_order`),
  KEY `is_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_applicant_types`
--

DROP TABLE IF EXISTS `master_applicant_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_applicant_types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `is_internal` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
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
INSERT INTO `master_applicant_types` VALUES (1,'MHS','Mahasiswa','Mahasiswa aktif POLBAN',1,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(2,'ALUMNI','Alumni','Lulusan POLBAN',1,2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(3,'TENDIK','Tendik','Tenaga Kependidikan',1,3,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(4,'DOSEN','Dosen','Dosen POLBAN',1,4,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(5,'MITRA','Mitra','Mitra Kerja Sama / Instansi',0,5,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(6,'WALI','Orang Tua / Wali','Orang tua atau wali mahasiswa',0,6,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(7,'UMUM','Masyarakat Umum','Pemohon dari masyarakat umum',0,7,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL);
/*!40000 ALTER TABLE `master_applicant_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_classes`
--

DROP TABLE IF EXISTS `master_classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_classes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `study_program_id` int(11) unsigned NOT NULL,
  `code` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `level` tinyint(1) NOT NULL,
  `parallel_class` varchar(5) NOT NULL,
  `entry_year` year(4) NOT NULL,
  `description` text DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
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
INSERT INTO `master_classes` VALUES (1,1,'D3-TKG-3A','Teknik Konstruksi Gedung 3A',0,'',0000,NULL,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(2,2,'D3-TKS-3A','Teknik Konstruksi Sipil 3A',0,'',0000,NULL,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(3,3,'D4-TPJJ-4A','Teknik Perancangan Jalan dan Jembatan 4A',0,'',0000,NULL,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(4,4,'D4-TPPG-4A','Teknik Perawatan dan Perbaikan Gedung 4A',0,'',0000,NULL,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(5,6,'D3-TM-3A','Teknik Mesin 3A',0,'',0000,NULL,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(6,7,'D3-TA-3A','Teknik Aeronautika 3A',0,'',0000,NULL,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(7,8,'D4-TPKM-4A','Teknik Perancangan dan Konstruksi Mesin 4A',0,'',0000,NULL,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(8,9,'D4-PM-4A','Proses Manufaktur 4A',0,'',0000,NULL,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(9,10,'D3-TPTU-3A','Teknik Pendingin dan Tata Udara 3A',0,'',0000,NULL,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(10,11,'D4-TPTU-4A','Teknik Pendingin dan Tata Udara 4A',0,'',0000,NULL,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(11,12,'D3-TKE-3A','Teknik Konversi Energi 3A',0,'',0000,NULL,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(12,13,'D4-TPTL-4A','Teknologi Pembangkit Tenaga Listrik 4A',0,'',0000,NULL,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(13,14,'D3-TEL-3A','Teknik Elektronika 3A',0,'',0000,NULL,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(14,15,'D3-TL-3A','Teknik Listrik 3A',0,'',0000,NULL,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(15,16,'D3-TT-3A','Teknik Telekomunikasi 3A',0,'',0000,NULL,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(16,17,'D4-TEL-4A','Teknik Elektronika 4A',0,'',0000,NULL,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(17,18,'D4-TOI-4A','Teknik Otomasi Industri 4A',0,'',0000,NULL,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(18,19,'D4-TT-4A','Teknik Telekomunikasi 4A',0,'',0000,NULL,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(19,20,'D3-TK-3A','Teknik Kimia 3A',0,'',0000,NULL,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(20,21,'D3-ANKIM-3A','Analis Kimia 3A',0,'',0000,NULL,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(21,22,'D4-TKK-4A','Teknik Kimia Produksi Bersih 4A',0,'',0000,NULL,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(22,23,'D3-TI-3A','Teknik Informatika 3A',0,'',0000,NULL,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(23,24,'D4-TI-4A','Teknik Informatika 4A',0,'',0000,NULL,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(24,25,'D3-AK-3A','Akuntansi 3A',0,'',0000,NULL,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(25,27,'D4-AK-4A','Akuntansi 4A',0,'',0000,NULL,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(26,30,'D3-AB-3A','Administrasi Bisnis 3A',0,'',0000,NULL,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(27,33,'D4-AB-4A','Administrasi Bisnis 4A',0,'',0000,NULL,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(28,37,'D3-BI-3A','Bahasa Inggris 3A',0,'',0000,NULL,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(29,38,'D4-BIKBP-4A','Bahasa Inggris 4A',0,'',0000,NULL,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL);
/*!40000 ALTER TABLE `master_classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_departments`
--

DROP TABLE IF EXISTS `master_departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_departments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `name` varchar(150) NOT NULL,
  `short_name` varchar(30) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
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
INSERT INTO `master_departments` VALUES (1,'TS','Jurusan Teknik Sipil','Teknik Sipil',NULL,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(2,'TM','Jurusan Teknik Mesin','Teknik Mesin',NULL,2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(3,'TRTU','Jurusan Teknik Refrigerasi dan Tata Udara','TRTU',NULL,3,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(4,'TKE','Jurusan Teknik Konversi Energi','TKE',NULL,4,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(5,'TE','Jurusan Teknik Elektro','Teknik Elektro',NULL,5,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(6,'TK','Jurusan Teknik Kimia','Teknik Kimia',NULL,6,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(7,'TKI','Jurusan Teknik Komputer dan Informatika','TKI',NULL,7,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(8,'AK','Jurusan Akuntansi','Akuntansi',NULL,8,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(9,'AN','Jurusan Administrasi Niaga','Administrasi Niaga',NULL,9,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(10,'BI','Jurusan Bahasa Inggris','Bahasa Inggris',NULL,10,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL);
/*!40000 ALTER TABLE `master_departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_service_categories`
--

DROP TABLE IF EXISTS `master_service_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_service_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(150) NOT NULL,
  `service_unit_id` int(11) unsigned NOT NULL,
  `description` text DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
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
INSERT INTO `master_service_categories` VALUES (1,'AKD-SURAT','Surat Akademik',2,'Layanan surat akademik',NULL,NULL,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(2,'AKD-STATUS','Status Mahasiswa',2,'Layanan perubahan status mahasiswa',NULL,NULL,2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(3,'AKD-WISUDA','Wisuda',2,'Layanan administrasi wisuda',NULL,NULL,3,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(4,'KEU-UKT','UKT',3,'Layanan UKT',NULL,NULL,4,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(5,'KEU-PEMBAYARAN','Administrasi Pembayaran',3,'Administrasi pembayaran',NULL,NULL,5,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(6,'KMH-BEASISWA','Beasiswa',4,'Layanan beasiswa',NULL,NULL,6,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(7,'KMH-ORMAWA','Organisasi Mahasiswa',4,'Layanan organisasi mahasiswa',NULL,NULL,7,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(8,'PERPUS-LAYANAN','Layanan Perpustakaan',5,'Layanan perpustakaan',NULL,NULL,8,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(9,'JUR-AKADEMIK','Administrasi Jurusan',6,'Administrasi jurusan',NULL,NULL,9,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(10,'JUR-TA','Tugas Akhir',6,'Layanan administrasi tugas akhir mahasiswa.',NULL,NULL,10,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(11,'UPTIK-AKUN','Akun dan Sistem Informasi',7,'Layanan akun dan sistem informasi',NULL,NULL,10,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(12,'UPTIK-LAYANAN','Layanan Teknologi Informasi',7,'Layanan umum teknologi informasi kampus.',NULL,NULL,12,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(13,'ADM-UMUM','Administrasi Umum',8,'Layanan administrasi umum.',NULL,NULL,13,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL);
/*!40000 ALTER TABLE `master_service_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_service_requirements`
--

DROP TABLE IF EXISTS `master_service_requirements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_service_requirements` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` int(11) unsigned NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `file_type` varchar(100) NOT NULL DEFAULT 'pdf' COMMENT 'pdf,jpg,jpeg,png,doc,docx,xls,xlsx',
  `max_file_size` int(11) NOT NULL DEFAULT 2048 COMMENT 'KB',
  `is_required` tinyint(1) NOT NULL DEFAULT 1,
  `allowed_extensions` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
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
INSERT INTO `master_service_requirements` VALUES (1,1,'KTM','Scan KTM','pdf',2048,1,'pdf,jpg,jpeg,png',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(2,1,'KRS Semester Berjalan','Scan KRS','pdf',4096,1,'pdf',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(3,2,'KTM','Scan KTM','pdf',2048,1,'pdf,jpg,png',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(4,2,'KRS','KRS aktif','pdf',4096,1,'pdf',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(5,3,'KTM','Scan KTM','pdf',2048,1,'pdf,jpg,png',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(6,4,'Scan Ijazah','Ijazah asli','pdf',4096,1,'pdf',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(7,4,'KTP','Identitas','pdf',2048,1,'pdf,jpg,png',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(8,5,'Scan Transkrip','Transkrip nilai','pdf',4096,1,'pdf',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(9,11,'Surat Permohonan','Surat permohonan penyesuaian UKT.','pdf',4096,1,'pdf',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(10,11,'KTM','Scan KTM.','pdf',2048,1,'pdf,jpg,jpeg,png',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(11,11,'Kartu Keluarga','Scan KK.','pdf',4096,1,'pdf,jpg,jpeg,png',3,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(12,11,'Slip Gaji Orang Tua','Slip gaji atau surat penghasilan.','pdf',4096,1,'pdf,jpg,jpeg,png',4,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(13,12,'Surat Permohonan','Surat permohonan cicilan UKT.','pdf',4096,1,'pdf',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(14,12,'KTM','Scan KTM.','pdf',2048,1,'pdf,jpg,jpeg,png',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(15,12,'KRS','KRS semester berjalan.','pdf',4096,1,'pdf',3,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(16,13,'Surat Permohonan','Surat penundaan pembayaran.','pdf',4096,1,'pdf',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(17,13,'KTM','Scan KTM.','pdf',2048,1,'pdf,jpg,jpeg,png',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(18,14,'Bukti Pembayaran','Upload bukti pembayaran.','pdf',4096,1,'pdf,jpg,jpeg,png',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(19,15,'Surat Permohonan','Surat pengembalian dana.','pdf',4096,1,'pdf',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(20,15,'Bukti Pembayaran','Bukti transfer/pembayaran.','pdf',4096,1,'pdf,jpg,jpeg,png',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(21,16,'Bukti Pembayaran','Upload bukti pembayaran.','pdf',4096,1,'pdf,jpg,jpeg,png',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(22,17,'Bukti Pembayaran','Upload bukti pembayaran.','pdf',4096,1,'pdf,jpg,jpeg,png',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(23,17,'Surat Permohonan','Jelaskan data yang perlu diperbaiki.','pdf',4096,0,'pdf',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(24,18,'Formulir Pendaftaran','Formulir pendaftaran beasiswa.','pdf',4096,1,'pdf',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(25,18,'KTM','Scan KTM.','pdf',2048,1,'pdf,jpg,jpeg,png',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(26,18,'KHS / Transkrip Nilai','Nilai akademik terbaru.','pdf',4096,1,'pdf',3,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(27,18,'Surat Penghasilan Orang Tua','Surat keterangan penghasilan.','pdf',4096,1,'pdf',4,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(28,19,'KHS Terbaru','KHS semester terakhir.','pdf',4096,1,'pdf',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(29,19,'Surat Pernyataan','Surat pernyataan masih memenuhi syarat.','pdf',4096,1,'pdf',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(30,20,'Surat Permohonan','Permohonan surat rekomendasi.','pdf',2048,1,'pdf',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(31,21,'Proposal Kegiatan','Proposal kegiatan organisasi.','pdf',8192,1,'pdf',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(32,21,'Susunan Panitia','Daftar panitia kegiatan.','pdf',4096,1,'pdf',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(33,22,'Proposal Anggaran','Proposal dan RAB kegiatan.','pdf',8192,1,'pdf',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(34,23,'Surat Permohonan','Surat peminjaman fasilitas.','pdf',2048,1,'pdf',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(35,24,'Sertifikat Prestasi','Sertifikat atau piagam prestasi.','pdf',4096,1,'pdf,jpg,jpeg,png',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(36,24,'Dokumentasi','Foto atau dokumentasi kegiatan.','pdf',8192,0,'pdf,jpg,jpeg,png',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(37,25,'Form Konseling','Formulir permohonan konseling.','pdf',2048,1,'pdf',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(38,26,'KTM','Scan KTM.','pdf',2048,1,'pdf,jpg,jpeg,png',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(39,26,'KRS Terakhir','KRS semester terakhir.','pdf',4096,1,'pdf',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(40,27,'KTM','Scan KTM.','pdf',2048,1,'pdf,jpg,jpeg,png',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(41,28,'Surat Kehilangan (Jika Hilang)','Surat kehilangan dari kepolisian (opsional jika hilang).','pdf',4096,0,'pdf,jpg,jpeg,png',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(42,28,'KTM','Scan KTM.','pdf',2048,1,'pdf,jpg,jpeg,png',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(43,29,'Bukti Pembayaran','Upload bukti pembayaran denda.','pdf',4096,1,'pdf,jpg,jpeg,png',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(44,30,'Form Usulan Buku','Form usulan pengadaan buku.','pdf',2048,1,'pdf',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(45,31,'Topik Penelitian','Dokumen atau uraian topik penelitian.','pdf',4096,1,'pdf,doc,docx',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(46,32,'KTM','Scan KTM','pdf',2048,1,'pdf,jpg,jpeg,png',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(47,33,'Proposal PKL','Proposal Kerja Praktik','pdf',8192,1,'pdf',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(48,33,'Transkrip Nilai','Transkrip sementara','pdf',4096,1,'pdf',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(49,33,'KRS','KRS aktif','pdf',4096,1,'pdf',3,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(50,34,'Proposal Magang','Proposal magang','pdf',8192,1,'pdf',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(51,34,'CV','Curriculum Vitae','pdf',2048,1,'pdf',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(52,35,'Proposal TA','Proposal tugas akhir','pdf',8192,1,'pdf',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(53,35,'Transkrip Nilai','Transkrip akademik','pdf',4096,1,'pdf',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(54,36,'Form Pengajuan Judul','Form pengajuan judul','pdf',4096,1,'pdf',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(55,36,'Proposal Singkat','Ringkasan proposal','pdf',4096,1,'pdf',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(56,37,'Proposal TA','Proposal lengkap','pdf',8192,1,'pdf',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(57,37,'Lembar Persetujuan Pembimbing','Persetujuan pembimbing','pdf',2048,1,'pdf',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(58,38,'Laporan TA','Draft laporan TA','pdf',10240,1,'pdf',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(59,38,'Lembar Bimbingan','Lembar konsultasi','pdf',4096,1,'pdf',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(60,39,'Laporan Final','Laporan tugas akhir final','pdf',15360,1,'pdf',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(61,39,'Lembar Persetujuan','Persetujuan pembimbing','pdf',4096,1,'pdf',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(62,39,'Bukti Bebas Pustaka','Surat bebas pustaka','pdf',2048,1,'pdf',3,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(63,40,'Surat Permohonan','Surat permohonan','pdf',2048,1,'pdf',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(64,41,'KTM','Scan KTM','pdf',2048,1,'pdf,jpg,jpeg,png',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(65,42,'KTM','Scan KTM','pdf',2048,1,'pdf,jpg,jpeg,png',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(66,43,'KTM','Scan KTM','pdf',2048,1,'pdf,jpg,jpeg,png',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(67,44,'KTP / KTM','Identitas pemohon.','pdf',2048,1,'pdf,jpg,jpeg,png',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(68,45,'KTM','Scan KTM.','pdf',2048,1,'pdf,jpg,jpeg,png',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(69,46,'Surat Permohonan','Permohonan akses VPN.','pdf',2048,1,'pdf',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(70,47,'Screenshot Kendala','Screenshot error (opsional).','pdf',4096,0,'jpg,jpeg,png,pdf',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(71,48,'Surat Permohonan','Surat peminjaman ruangan.','pdf',2048,1,'pdf',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(72,48,'Proposal Kegiatan','Proposal kegiatan (jika ada).','pdf',8192,0,'pdf',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(73,49,'Surat Permohonan','Surat permohonan peminjaman.','pdf',2048,1,'pdf',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(74,50,'Draft Surat','Draft surat yang akan diproses.','pdf',4096,1,'pdf,doc,docx',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL);
/*!40000 ALTER TABLE `master_service_requirements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_service_units`
--

DROP TABLE IF EXISTS `master_service_units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_service_units` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `logo` varchar(255) NOT NULL DEFAULT 'default.png',
  `sort_order` int(11) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
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
INSERT INTO `master_service_units` VALUES (1,'ULT','Unit Layanan Terpadu','Unit Layanan Terpadu Politeknik Negeri Bandung',NULL,NULL,NULL,NULL,'default.png',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(2,'AKD','Bagian Akademik','Pelayanan akademik mahasiswa',NULL,NULL,NULL,NULL,'default.png',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(3,'KEU','Bagian Keuangan','Pelayanan administrasi keuangan',NULL,NULL,NULL,NULL,'default.png',3,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(4,'KEMHS','Bagian Kemahasiswaan','Pelayanan kemahasiswaan',NULL,NULL,NULL,NULL,'default.png',4,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(5,'PERPUS','Perpustakaan','Pelayanan perpustakaan',NULL,NULL,NULL,NULL,'default.png',5,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(6,'JUR','Jurusan','Pelayanan administrasi jurusan',NULL,NULL,NULL,NULL,'default.png',6,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(7,'UPTIK','UPT Teknologi Informasi dan Komunikasi','Pelayanan teknologi informasi',NULL,NULL,NULL,NULL,'default.png',7,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(8,'ADM','Administrasi Umum','Unit layanan administrasi umum',NULL,NULL,NULL,NULL,'default.png',12,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(9,'BAUK','Bagian Administrasi Umum','Administrasi umum dan kepegawaian',NULL,NULL,NULL,NULL,'default.png',8,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL);
/*!40000 ALTER TABLE `master_service_units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_services`
--

DROP TABLE IF EXISTS `master_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_services` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `service_unit_id` int(11) unsigned NOT NULL,
  `service_category_id` int(11) unsigned NOT NULL,
  `code` varchar(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `service_hours` int(11) NOT NULL DEFAULT 24 COMMENT 'Estimasi penyelesaian dalam jam',
  `max_file_size` int(11) NOT NULL DEFAULT 2048 COMMENT 'KB',
  `is_online` tinyint(1) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `service_unit_id` (`service_unit_id`),
  KEY `service_category_id` (`service_category_id`),
  KEY `is_active` (`is_active`),
  KEY `sort_order` (`sort_order`),
  CONSTRAINT `master_services_service_category_id_foreign` FOREIGN KEY (`service_category_id`) REFERENCES `master_service_categories` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `master_services_service_unit_id_foreign` FOREIGN KEY (`service_unit_id`) REFERENCES `master_service_units` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_services`
--

LOCK TABLES `master_services` WRITE;
/*!40000 ALTER TABLE `master_services` DISABLE KEYS */;
INSERT INTO `master_services` VALUES (1,2,1,'SURAT-AKTIF','Surat Keterangan Aktif Kuliah','Permohonan Surat Keterangan Aktif Kuliah.',24,2048,1,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(2,2,1,'SURAT-MHS','Surat Keterangan Mahasiswa','Permohonan Surat Keterangan Mahasiswa.',24,2048,1,1,2,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(3,2,1,'DAFTAR-NILAI','Permohonan Daftar Nilai','Permohonan Daftar Nilai Akademik.',24,2048,1,1,3,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(4,2,1,'LEGALISIR-IJAZAH','Legalisasi Ijazah','Permohonan legalisasi ijazah.',48,4096,1,1,4,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(5,2,1,'LEGALISIR-TRANSKRIP','Legalisasi Transkrip Nilai','Permohonan legalisasi transkrip nilai.',48,4096,1,1,5,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(6,2,2,'CUTI-AKADEMIK','Pengajuan Cuti Akademik','Pengajuan cuti akademik.',72,4096,1,1,6,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(7,2,2,'AKTIF-KEMBALI','Aktif Kembali Setelah Cuti','Permohonan aktif kembali setelah cuti.',72,4096,1,1,7,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(8,2,2,'PENGUNDURAN-DIRI','Pengunduran Diri Mahasiswa','Permohonan pengunduran diri sebagai mahasiswa.',120,4096,1,1,8,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(9,2,3,'PENDAFTARAN-WISUDA','Pendaftaran Wisuda','Permohonan pendaftaran wisuda.',72,4096,1,1,9,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(10,2,3,'YUDISIUM','Administrasi Yudisium','Permohonan administrasi yudisium.',72,4096,1,1,10,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(11,3,4,'PENGAJUAN-UKT','Pengajuan Penyesuaian UKT','Pengajuan penyesuaian besaran UKT.',120,4096,1,1,11,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(12,3,4,'CICILAN-UKT','Pengajuan Cicilan UKT','Pengajuan pembayaran UKT secara cicilan.',120,4096,1,1,12,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(13,3,4,'PENUNDAAN-UKT','Pengajuan Penundaan Pembayaran UKT','Pengajuan penundaan pembayaran UKT.',120,4096,1,1,13,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(14,3,5,'VALIDASI-PEMBAYARAN','Validasi Pembayaran','Validasi bukti pembayaran mahasiswa.',24,4096,1,1,14,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(15,3,5,'PENGEMBALIAN-DANA','Pengembalian Dana','Permohonan pengembalian dana pembayaran.',168,4096,1,1,15,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(16,3,5,'KWITANSI','Permohonan Kwitansi Pembayaran','Permohonan penerbitan kwitansi pembayaran resmi.',24,2048,1,1,16,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(17,3,5,'KOREKSI-PEMBAYARAN','Koreksi Data Pembayaran','Permohonan koreksi data pembayaran mahasiswa.',48,4096,1,1,17,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(18,4,6,'BEASISWA-PENDAFTARAN','Pendaftaran Beasiswa','Pengajuan pendaftaran program beasiswa.',120,4096,1,1,18,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(19,4,6,'BEASISWA-PERPANJANGAN','Perpanjangan Beasiswa','Pengajuan perpanjangan beasiswa.',120,4096,1,1,19,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(20,4,6,'BEASISWA-SURAT','Surat Rekomendasi Beasiswa','Permohonan surat rekomendasi beasiswa.',48,2048,1,1,20,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(21,4,7,'ORMAWA-KEGIATAN','Persetujuan Kegiatan Organisasi Mahasiswa','Pengajuan persetujuan kegiatan organisasi mahasiswa.',72,4096,1,1,21,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(22,4,7,'ORMAWA-PENDANAAN','Pengajuan Pendanaan Kegiatan','Pengajuan bantuan dana kegiatan organisasi mahasiswa.',120,4096,1,1,22,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(23,4,7,'ORMAWA-FASILITAS','Peminjaman Fasilitas Kegiatan','Pengajuan peminjaman fasilitas untuk kegiatan mahasiswa.',48,2048,1,1,23,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(24,4,7,'PRESTASI-MHS','Pelaporan Prestasi Mahasiswa','Pelaporan prestasi akademik maupun non-akademik mahasiswa.',48,4096,1,1,24,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(25,4,7,'KONSELING-MHS','Layanan Konseling Mahasiswa','Pengajuan layanan konseling mahasiswa.',24,2048,1,1,25,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(26,5,8,'BEBAS-PUSTAKA','Surat Bebas Pustaka','Permohonan Surat Bebas Pustaka bagi mahasiswa.',24,2048,1,1,26,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(27,5,8,'DAFTAR-ANGGOTA','Pendaftaran Anggota Perpustakaan','Pendaftaran anggota perpustakaan.',24,2048,1,1,27,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(28,5,8,'GANTI-KARTU-PERPUS','Penggantian Kartu Perpustakaan','Permohonan penggantian kartu anggota perpustakaan.',24,2048,1,1,28,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(29,5,8,'DENDA-PERPUS','Pembayaran Denda Perpustakaan','Layanan pembayaran denda keterlambatan pengembalian buku.',24,2048,1,1,29,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(30,5,8,'USUL-BUKU','Usulan Pengadaan Buku','Pengajuan usulan pengadaan koleksi buku baru.',168,2048,1,1,30,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(31,5,8,'LITERATUR','Bantuan Penelusuran Literatur','Permohonan bantuan pencarian referensi ilmiah.',48,2048,1,1,31,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(32,6,9,'DOSEN-PA','Pengajuan Dosen Pembimbing Akademik','Permohonan penetapan atau perubahan dosen pembimbing akademik.',72,2048,1,1,32,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(33,6,9,'PKL','Pengajuan Kerja Praktik / PKL','Pengajuan administrasi Kerja Praktik atau PKL.',72,4096,1,1,33,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(34,6,9,'MAGANG','Pengajuan Magang','Pengajuan administrasi kegiatan magang.',72,4096,1,1,34,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(35,6,10,'TA-PEMBIMBING','Pengajuan Dosen Pembimbing Tugas Akhir','Permohonan penetapan dosen pembimbing tugas akhir.',72,4096,1,1,35,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(36,6,10,'TA-JUDUL','Pengajuan Judul Tugas Akhir','Pengajuan atau perubahan judul tugas akhir.',72,4096,1,1,36,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(37,6,10,'SEMPRO','Pendaftaran Seminar Proposal','Pendaftaran seminar proposal tugas akhir.',72,4096,1,1,37,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(38,6,10,'SEMHAS','Pendaftaran Seminar Hasil','Pendaftaran seminar hasil tugas akhir.',72,4096,1,1,38,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(39,6,10,'SIDANG-TA','Pendaftaran Sidang Tugas Akhir','Pendaftaran sidang tugas akhir.',120,4096,1,1,39,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(40,6,9,'SURAT-PENGANTAR','Surat Pengantar Jurusan','Permohonan surat pengantar dari jurusan.',24,2048,1,1,40,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(41,7,11,'RESET-PASSWORD','Reset Password Akun Mahasiswa','Permohonan reset password akun mahasiswa.',24,2048,1,1,41,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(42,7,11,'AKTIVASI-AKUN','Aktivasi Akun Mahasiswa','Permohonan aktivasi akun mahasiswa.',24,2048,1,1,42,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(43,7,11,'EMAIL-INSTITUSI','Aktivasi Email Institusi','Permohonan aktivasi email institusi.',24,2048,1,1,43,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(44,7,11,'UBAH-DATA-AKUN','Perubahan Data Akun','Permohonan perubahan data akun pengguna.',24,2048,1,1,44,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(45,7,12,'WIFI-KAMPUS','Akses WiFi Kampus','Permohonan bantuan akses WiFi kampus.',24,2048,1,1,45,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(46,7,12,'VPN','Akses VPN Kampus','Permohonan akses VPN kampus.',24,2048,1,1,46,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(47,7,12,'HELPDESK-TI','Layanan Helpdesk TI','Pelaporan kendala layanan teknologi informasi.',24,2048,1,1,47,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(48,8,13,'PINJAM-RUANG','Peminjaman Ruangan','Permohonan peminjaman ruangan.',48,2048,1,1,48,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(49,8,13,'PINJAM-SARPRAS','Peminjaman Sarana dan Prasarana','Permohonan peminjaman sarana dan prasarana.',48,2048,1,1,49,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(50,8,13,'SURAT-MASUK','Layanan Surat Masuk dan Keluar','Administrasi surat masuk dan surat keluar.',24,2048,1,1,50,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL);
/*!40000 ALTER TABLE `master_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_study_programs`
--

DROP TABLE IF EXISTS `master_study_programs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_study_programs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `department_id` int(11) unsigned NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `short_name` varchar(50) DEFAULT NULL,
  `degree` varchar(10) NOT NULL,
  `description` text DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
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
INSERT INTO `master_study_programs` VALUES (1,1,'TKG','Teknik Konstruksi Gedung','TKG','D3',NULL,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(2,1,'TKS','Teknik Konstruksi Sipil','TKS','D3',NULL,2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(3,1,'TPJJ','Teknik Perancangan Jalan dan Jembatan','TPJJ','D4',NULL,3,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(4,1,'TPPG','Teknik Perawatan dan Perbaikan Gedung','TPPG','D4',NULL,4,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(5,1,'RI','Rekayasa Infrastruktur','RI','S2',NULL,5,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(6,2,'TM','Teknik Mesin','TM','D3',NULL,6,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(7,2,'TA','Teknik Aeronautika','TA','D3',NULL,7,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(8,2,'TPKM','Teknik Perancangan dan Konstruksi Mesin','TPKM','D4',NULL,8,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(9,2,'PM','Proses Manufaktur','PM','D4',NULL,9,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(10,3,'D3-TPTU','Teknik Pendingin dan Tata Udara','TPTU','D3',NULL,10,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(11,3,'D4-TPTU','Teknik Pendingin dan Tata Udara','TPTU','D4',NULL,11,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(12,4,'TKE','Teknik Konversi Energi','TKE','D3',NULL,12,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(13,4,'TPTL','Teknologi Pembangkit Tenaga Listrik','TPTL','D4',NULL,13,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(14,5,'D3-TEL','Teknik Elektronika','Teknik Elektronika','D3',NULL,15,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(15,5,'TL','Teknik Listrik','Teknik Listrik','D3',NULL,16,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(16,5,'D3-TT','Teknik Telekomunikasi','Teknik Telekomunikasi','D3',NULL,17,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(17,5,'D4-TEL','Teknik Elektronika','Teknik Elektronika','D4',NULL,18,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(18,5,'TOI','Teknik Otomasi Industri','TOI','D4',NULL,19,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(19,5,'D4-TT','Teknik Telekomunikasi','Teknik Telekomunikasi','D4',NULL,20,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(20,6,'TK','Teknik Kimia','Teknik Kimia','D3',NULL,21,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(21,6,'AK','Analis Kimia','Analis Kimia','D3',NULL,22,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(22,6,'TKK','Teknik Kimia Produksi Bersih','TKPB','D4',NULL,23,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(23,7,'D3-TI','Teknik Informatika','Teknik Informatika','D3',NULL,24,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(24,7,'D4-TI','Teknik Informatika','Teknik Informatika','D4',NULL,25,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(25,8,'D3-AK','Akuntansi','Akuntansi','D3',NULL,26,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(26,8,'D3-KP','Keuangan dan Perbankan','Keuangan & Perbankan','D3',NULL,27,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(27,8,'D4-AK','Akuntansi','Akuntansi','D4',NULL,28,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(28,8,'D4-AMP','Akuntansi Manajemen Pemerintahan','AMP','D4',NULL,29,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(29,8,'D4-KS','Keuangan Syariah','Keuangan Syariah','D4',NULL,30,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(30,9,'D3-AB','Administrasi Bisnis','Administrasi Bisnis','D3',NULL,31,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(31,9,'D3-UPW','Usaha Perjalanan Wisata','UPW','D3',NULL,32,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(32,9,'D3-MP','Manajemen Pemasaran','Manajemen Pemasaran','D3',NULL,33,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(33,9,'D4-AB','Administrasi Bisnis','Administrasi Bisnis','D4',NULL,34,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(34,9,'D4-DP','Destinasi Pariwisata','Destinasi Pariwisata','D4',NULL,35,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(35,9,'D4-MA','Manajemen Aset','Manajemen Aset','D4',NULL,36,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(36,9,'D4-MP','Manajemen Pemasaran','Manajemen Pemasaran','D4',NULL,37,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(37,10,'D3-BI','Bahasa Inggris','Bahasa Inggris','D3',NULL,38,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(38,10,'D4-BIKBP','Bahasa Inggris untuk Komunikasi Bisnis dan Profesional','BIKBP','D4',NULL,39,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(39,1,'S2-RI','Rekayasa Infrastruktur','RI','S2',NULL,40,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(40,8,'S2-KPS','Keuangan dan Perbankan Syariah','KPS','S2',NULL,41,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(41,9,'S2-PIT','Pemasaran, Inovasi dan Teknologi','PIT','S2',NULL,42,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL);
/*!40000 ALTER TABLE `master_study_programs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2026-08-03-000001','App\\Database\\Migrations\\CreateRolesTable','default','App',1786675335,1),(2,'2026-08-03-000002','App\\Database\\Migrations\\CreatePermissionsTable','default','App',1786675335,1),(3,'2026-08-03-000003','App\\Database\\Migrations\\CreateRolePermissionsTable','default','App',1786675335,1),(4,'2026-08-03-000004','App\\Database\\Migrations\\CreateUsersTable','default','App',1786675335,1),(5,'2026-08-03-000005','App\\Database\\Migrations\\CreateMasterDepartmentsTable','default','App',1786675336,1),(6,'2026-08-03-000006','App\\Database\\Migrations\\CreateMasterStudyProgramsTable','default','App',1786675336,1),(7,'2026-08-03-000007','App\\Database\\Migrations\\CreateMasterClassesTable','default','App',1786675336,1),(8,'2026-08-03-000008','App\\Database\\Migrations\\CreateMasterApplicantTypesTable','default','App',1786675336,1),(9,'2026-08-03-000009','App\\Database\\Migrations\\CreateUserProfilesTable','default','App',1786675336,1),(10,'2026-08-03-000010','App\\Database\\Migrations\\CreateMasterServiceUnitsTable','default','App',1786675336,1),(11,'2026-08-03-000011','App\\Database\\Migrations\\CreateMasterServiceCategoriesTable','default','App',1786675336,1),(12,'2026-08-03-000012','App\\Database\\Migrations\\CreateMasterServicesTable','default','App',1786675336,1),(13,'2026-08-03-000013','App\\Database\\Migrations\\CreateMasterServiceRequirementsTable','default','App',1786675336,1),(14,'2026-08-03-000014','App\\Database\\Migrations\\CreateServiceRequestsTable','default','App',1786675336,1),(15,'2026-08-03-000015','App\\Database\\Migrations\\CreateServiceRequestFilesTable','default','App',1786675336,1),(16,'2026-08-03-000016','App\\Database\\Migrations\\CreateServiceRequestLogsTable','default','App',1786675336,1),(17,'2026-08-03-000017','App\\Database\\Migrations\\CreateNotificationsTable','default','App',1786675336,1),(18,'2026-08-03-000018','App\\Database\\Migrations\\CreateActivityLogsTable','default','App',1786675336,1),(19,'2026-08-03-000019','App\\Database\\Migrations\\AddMissingColumnsToPermissionsAndRoles','default','App',1786675337,1),(20,'2026-08-07-000001','App\\Database\\Migrations\\AddApplicantDetailFieldsToUserProfiles','default','App',1786675337,1),(21,'2026-08-09-000001','App\\Database\\Migrations\\CreateTicketsTable','default','App',1786675337,1),(22,'2026-08-14-000001','App\\Database\\Migrations\\CreateTicketAuditTables','default','App',1786694890,2),(23,'2026-08-19-000001','App\\Database\\Migrations\\AddGenderToUsersTable','default','App',1787799892,3),(24,'2026-08-19-000002','App\\Database\\Migrations\\CreateServiceApplicantTypesTable','default','App',1787799892,3),(25,'2026-08-24-000001','App\\Database\\Migrations\\AddMfaColumnsToUsersTable','default','App',1787799892,3),(26,'2026-08-27-000001','App\\Database\\Migrations\\CreateFaqsTable','default','App',1787799892,3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `service_request_id` bigint(20) unsigned DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `type` enum('info','success','warning','danger') NOT NULL DEFAULT 'info',
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `read_at` datetime DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,1,NULL,'Tiket Walk In Baru','Tiket ULT-20260918024943900 dari pangestu telah masuk melalui Laporan Tamu.','info',0,NULL,'http://localhost:8080/datatiket','2026-09-18 02:49:44','2026-09-18 02:49:44',NULL),(2,1,NULL,'Tiket Walk In Baru','Tiket ULT-20260918095348167 dari zein telah masuk melalui Laporan Tamu.','info',0,NULL,'http://localhost:8080/datatiket','2026-09-18 09:53:48','2026-09-18 09:53:48',NULL),(3,1,NULL,'Tiket Walk In Baru','Tiket ULT-20260922041846523 dari nan telah masuk melalui Laporan Tamu.','info',0,NULL,'http://localhost:8080/datatiket','2026-09-22 04:18:46','2026-09-22 04:18:46',NULL),(4,1,NULL,'Tiket Walk In Baru','Tiket ULT-20260922065034563 dari rakkk telah masuk melalui Laporan Tamu.','info',0,NULL,'http://localhost:8080/datatiket','2026-09-22 06:50:35','2026-09-22 06:50:35',NULL),(5,1,NULL,'Tiket Walk In Baru','Tiket ULT-20260922065834985 dari rijal telah masuk melalui Laporan Tamu.','info',0,NULL,'http://localhost:8080/datatiket','2026-09-22 06:58:35','2026-09-22 06:58:35',NULL),(6,1,NULL,'Tiket Walk In Baru','Tiket ULT-20260922082655444 dari yaku telah masuk melalui Laporan Tamu.','info',0,NULL,'http://localhost:8080/datatiket','2026-09-22 08:26:56','2026-09-22 08:26:56',NULL),(7,1,NULL,'Tiket Walk In Baru','Tiket ULT-20260923054609200 dari rasyaa telah masuk melalui Laporan Tamu.','info',0,NULL,'http://localhost:8080/datatiket','2026-09-23 05:46:09','2026-09-23 05:46:09',NULL),(8,1,1,'Tiket Walk In Baru','Tiket ULT-20260923061215636 dari alpinn telah masuk melalui Laporan Tamu.','info',0,NULL,'http://localhost:8080/datatiket','2026-09-23 06:12:15','2026-09-23 06:12:15',NULL),(9,1,17,'Tiket Walk In Baru','Tiket ULT-20260923065403445 dari alvinnn telah masuk melalui Laporan Tamu.','info',0,NULL,'http://localhost:8080/datatiket','2026-09-23 06:54:03','2026-09-23 06:54:03',NULL);
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `module` varchar(100) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'dashboard.view','Lihat Dashboard','Lihat Dashboard - Dashboard','Dashboard',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(2,'department.view','Lihat Jurusan','Lihat Jurusan - Department','Department',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(3,'department.create','Tambah Jurusan','Tambah Jurusan - Department','Department',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(4,'department.update','Ubah Jurusan','Ubah Jurusan - Department','Department',3,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(5,'department.delete','Hapus Jurusan','Hapus Jurusan - Department','Department',4,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(6,'department.restore','Pulihkan Jurusan','Pulihkan Jurusan - Department','Department',5,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(7,'study_program.view','Lihat Program Studi','Lihat Program Studi - Study Program','Study Program',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(8,'study_program.create','Tambah Program Studi','Tambah Program Studi - Study Program','Study Program',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(9,'study_program.update','Ubah Program Studi','Ubah Program Studi - Study Program','Study Program',3,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(10,'study_program.delete','Hapus Program Studi','Hapus Program Studi - Study Program','Study Program',4,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(11,'study_program.restore','Pulihkan Program Studi','Pulihkan Program Studi - Study Program','Study Program',5,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(12,'class.view','Lihat Kelas','Lihat Kelas - Class','Class',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(13,'class.create','Tambah Kelas','Tambah Kelas - Class','Class',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(14,'class.update','Ubah Kelas','Ubah Kelas - Class','Class',3,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(15,'class.delete','Hapus Kelas','Hapus Kelas - Class','Class',4,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(16,'class.restore','Pulihkan Kelas','Pulihkan Kelas - Class','Class',5,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(17,'applicant_type.view','Lihat Jenis Pemohon','Lihat Jenis Pemohon - Applicant Type','Applicant Type',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(18,'applicant_type.create','Tambah Jenis Pemohon','Tambah Jenis Pemohon - Applicant Type','Applicant Type',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(19,'applicant_type.update','Ubah Jenis Pemohon','Ubah Jenis Pemohon - Applicant Type','Applicant Type',3,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(20,'applicant_type.delete','Hapus Jenis Pemohon','Hapus Jenis Pemohon - Applicant Type','Applicant Type',4,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(21,'applicant_type.restore','Pulihkan Jenis Pemohon','Pulihkan Jenis Pemohon - Applicant Type','Applicant Type',5,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(22,'service_unit.view','Lihat Unit Layanan','Lihat Unit Layanan - Service Unit','Service Unit',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(23,'service_unit.create','Tambah Unit Layanan','Tambah Unit Layanan - Service Unit','Service Unit',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(24,'service_unit.update','Ubah Unit Layanan','Ubah Unit Layanan - Service Unit','Service Unit',3,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(25,'service_unit.delete','Hapus Unit Layanan','Hapus Unit Layanan - Service Unit','Service Unit',4,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(26,'service_unit.restore','Pulihkan Unit Layanan','Pulihkan Unit Layanan - Service Unit','Service Unit',5,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(27,'service_category.view','Lihat Kategori Layanan','Lihat Kategori Layanan - Service Category','Service Category',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(28,'service_category.create','Tambah Kategori Layanan','Tambah Kategori Layanan - Service Category','Service Category',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(29,'service_category.update','Ubah Kategori Layanan','Ubah Kategori Layanan - Service Category','Service Category',3,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(30,'service_category.delete','Hapus Kategori Layanan','Hapus Kategori Layanan - Service Category','Service Category',4,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(31,'service_category.restore','Pulihkan Kategori Layanan','Pulihkan Kategori Layanan - Service Category','Service Category',5,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(32,'service.view','Lihat Layanan','Lihat Layanan - Service','Service',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(33,'service.create','Tambah Layanan','Tambah Layanan - Service','Service',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(34,'service.update','Ubah Layanan','Ubah Layanan - Service','Service',3,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(35,'service.delete','Hapus Layanan','Hapus Layanan - Service','Service',4,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(36,'service.restore','Pulihkan Layanan','Pulihkan Layanan - Service','Service',5,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(37,'service_requirement.view','Lihat Persyaratan','Lihat Persyaratan - Service Requirement','Service Requirement',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(38,'service_requirement.create','Tambah Persyaratan','Tambah Persyaratan - Service Requirement','Service Requirement',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(39,'service_requirement.update','Ubah Persyaratan','Ubah Persyaratan - Service Requirement','Service Requirement',3,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(40,'service_requirement.delete','Hapus Persyaratan','Hapus Persyaratan - Service Requirement','Service Requirement',4,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(41,'service_requirement.restore','Pulihkan Persyaratan','Pulihkan Persyaratan - Service Requirement','Service Requirement',5,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(42,'user.view','Lihat User','Lihat User - User','User',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(43,'user.create','Tambah User','Tambah User - User','User',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(44,'user.update','Ubah User','Ubah User - User','User',3,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(45,'user.delete','Hapus User','Hapus User - User','User',4,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(46,'user.restore','Pulihkan User','Pulihkan User - User','User',5,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(47,'user.reset_password','Reset Password','Reset Password - User','User',6,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(48,'role.view','Lihat Role','Lihat Role - Role','Role',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(49,'role.create','Tambah Role','Tambah Role - Role','Role',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(50,'role.update','Ubah Role','Ubah Role - Role','Role',3,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(51,'role.delete','Hapus Role','Hapus Role - Role','Role',4,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(52,'permission.view','Lihat Permission','Lihat Permission - Permission','Permission',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(53,'permission.update','Ubah Permission','Ubah Permission - Permission','Permission',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(54,'request.create','Buat Pengajuan','Buat Pengajuan - Request','Request',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(55,'request.view','Lihat Pengajuan','Lihat Pengajuan - Request','Request',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(56,'request.verify','Verifikasi Pengajuan','Verifikasi Pengajuan - Request','Request',3,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(57,'request.approve','Setujui Pengajuan','Setujui Pengajuan - Request','Request',4,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(58,'request.reject','Tolak Pengajuan','Tolak Pengajuan - Request','Request',5,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(59,'request.complete','Selesaikan Pengajuan','Selesaikan Pengajuan - Request','Request',6,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(60,'request.cancel','Batalkan Pengajuan','Batalkan Pengajuan - Request','Request',7,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(61,'notification.view','Lihat Notifikasi','Lihat Notifikasi - Notification','Notification',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(62,'activity_log.view','Lihat Activity Log','Lihat Activity Log - Activity Log','Activity Log',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(63,'report.view','Lihat Laporan','Lihat Laporan - Report','Report',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(64,'report.export','Export Laporan','Export Laporan - Report','Report',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(65,'statistic.view','Lihat Statistik','Lihat Statistik - Statistic','Statistic',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(66,'faq.view','Lihat FAQ','Lihat FAQ - Faq','Faq',1,1,'2026-09-07 06:32:42','2026-09-07 06:32:42',NULL),(67,'faq.create','Tambah FAQ','Tambah FAQ - Faq','Faq',1,1,'2026-09-07 06:32:42','2026-09-07 06:32:42',NULL),(68,'faq.update','Ubah FAQ','Ubah FAQ - Faq','Faq',1,1,'2026-09-07 06:32:42','2026-09-07 06:32:42',NULL),(69,'faq.delete','Hapus FAQ','Hapus FAQ - Faq','Faq',1,1,'2026-09-07 06:32:42','2026-09-07 06:32:42',NULL),(70,'faq.restore','Pulihkan FAQ','Pulihkan FAQ - Faq','Faq',1,1,'2026-09-07 06:32:42','2026-09-07 06:32:42',NULL);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_permissions`
--

DROP TABLE IF EXISTS `role_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_permissions_role_id_foreign` (`role_id`),
  KEY `role_permissions_permission_id_foreign` (`permission_id`),
  CONSTRAINT `role_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_permissions`
--

LOCK TABLES `role_permissions` WRITE;
/*!40000 ALTER TABLE `role_permissions` DISABLE KEYS */;
INSERT INTO `role_permissions` VALUES (1,1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(2,1,2,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(3,1,3,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(4,1,4,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(5,1,5,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(6,1,6,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(7,1,7,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(8,1,8,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(9,1,9,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(10,1,10,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(11,1,11,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(12,1,12,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(13,1,13,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(14,1,14,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(15,1,15,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(16,1,16,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(17,1,17,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(18,1,18,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(19,1,19,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(20,1,20,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(21,1,21,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(22,1,22,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(23,1,23,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(24,1,24,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(25,1,25,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(26,1,26,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(27,1,27,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(28,1,28,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(29,1,29,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(30,1,30,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(31,1,31,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(32,1,32,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(33,1,33,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(34,1,34,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(35,1,35,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(36,1,36,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(37,1,37,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(38,1,38,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(39,1,39,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(40,1,40,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(41,1,41,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(42,1,42,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(43,1,43,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(44,1,44,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(45,1,45,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(46,1,46,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(47,1,47,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(48,1,48,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(49,1,49,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(50,1,50,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(51,1,51,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(52,1,52,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(53,1,53,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(54,1,54,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(55,1,55,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(56,1,56,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(57,1,57,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(58,1,58,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(59,1,59,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(60,1,60,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(61,1,61,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(62,1,62,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(63,1,63,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(64,1,64,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(65,1,65,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(66,2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(67,2,42,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(68,2,43,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(69,2,44,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(70,2,45,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(71,2,46,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(72,2,47,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(73,2,17,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(74,2,18,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(75,2,19,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(76,2,20,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(77,2,21,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(78,2,2,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(79,2,3,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(80,2,4,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(81,2,5,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(82,2,6,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(83,2,7,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(84,2,8,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(85,2,9,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(86,2,10,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(87,2,11,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(88,2,12,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(89,2,13,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(90,2,14,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(91,2,15,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(92,2,16,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(93,2,22,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(94,2,23,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(95,2,24,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(96,2,25,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(97,2,26,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(98,2,27,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(99,2,28,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(100,2,29,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(101,2,30,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(102,2,31,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(103,2,32,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(104,2,33,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(105,2,34,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(106,2,35,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(107,2,36,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(108,2,37,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(109,2,38,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(110,2,39,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(111,2,40,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(112,2,41,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(113,2,55,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(114,2,54,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(115,2,56,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(116,2,57,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(117,2,58,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(118,2,59,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(119,2,60,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(120,2,61,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(121,2,62,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(122,2,63,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(123,2,64,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(124,2,65,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(125,6,1,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(126,6,55,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(127,6,54,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(128,6,60,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(129,6,61,'2026-08-14 08:45:58','2026-08-14 08:45:58'),(130,2,66,'2026-09-07 06:32:42','2026-09-07 06:32:42'),(131,2,67,'2026-09-07 06:32:42','2026-09-07 06:32:42'),(132,2,68,'2026-09-07 06:32:42','2026-09-07 06:32:42'),(133,2,69,'2026-09-07 06:32:42','2026-09-07 06:32:42'),(134,2,70,'2026-09-07 06:32:42','2026-09-07 06:32:42'),(135,1,66,'2026-09-07 06:32:42','2026-09-07 06:32:42'),(136,1,67,'2026-09-07 06:32:42','2026-09-07 06:32:42'),(137,1,68,'2026-09-07 06:32:42','2026-09-07 06:32:42'),(138,1,69,'2026-09-07 06:32:42','2026-09-07 06:32:42'),(139,1,70,'2026-09-07 06:32:42','2026-09-07 06:32:42');
/*!40000 ALTER TABLE `role_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'SUPER_ADMIN','Super Administrator','Memiliki akses penuh ke seluruh sistem.',1,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(2,'ADMIN_ULT','Admin ULT','Mengelola layanan dan operasional Unit Layanan Terpadu.',2,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(3,'PETUGAS_AKADEMIK','Petugas Akademik','Memverifikasi dan memproses layanan akademik.',3,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(4,'PETUGAS_KEUANGAN','Petugas Keuangan','Memverifikasi dan memproses layanan keuangan.',4,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(5,'PETUGAS_UMUM','Petugas Umum','Memverifikasi dan memproses layanan umum.',5,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL),(6,'PEMOHON','Pemohon','Pengguna yang mengajukan layanan.',6,1,'2026-08-14 08:45:58','2026-08-14 08:45:58',NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_applicant_types`
--

DROP TABLE IF EXISTS `service_applicant_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_applicant_types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` int(11) unsigned NOT NULL,
  `applicant_type_id` int(11) unsigned NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `service_id_applicant_type_id` (`service_id`,`applicant_type_id`),
  KEY `applicant_type_id` (`applicant_type_id`),
  CONSTRAINT `service_applicant_types_applicant_type_id_foreign` FOREIGN KEY (`applicant_type_id`) REFERENCES `master_applicant_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `service_applicant_types_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `master_services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_applicant_types`
--

LOCK TABLES `service_applicant_types` WRITE;
/*!40000 ALTER TABLE `service_applicant_types` DISABLE KEYS */;
INSERT INTO `service_applicant_types` VALUES (1,1,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(2,2,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(3,3,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(4,3,2,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(5,4,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(6,4,2,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(7,5,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(8,5,2,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(9,6,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(10,7,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(11,8,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(12,9,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(13,9,2,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(14,10,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(15,11,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(16,11,6,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(17,12,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(18,12,6,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(19,13,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(20,13,6,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(21,14,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(22,14,6,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(23,15,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(24,15,6,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(25,16,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(26,16,6,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(27,17,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(28,17,6,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(29,18,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(30,19,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(31,20,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(32,21,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(33,22,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(34,23,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(35,24,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(36,25,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(37,26,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(38,26,2,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(39,27,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(40,27,4,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(41,27,3,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(42,27,7,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(43,28,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(44,28,4,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(45,28,3,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(46,28,7,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(47,29,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(48,29,4,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(49,29,3,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(50,29,7,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(51,30,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(52,30,4,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(53,30,3,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(54,31,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(55,31,2,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(56,31,4,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(57,31,3,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(58,32,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(59,33,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(60,34,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(61,35,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(62,36,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(63,37,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(64,38,1,'2026-09-07 06:32:34','2026-09-07 06:32:34'),(65,39,1,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(66,40,1,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(67,40,2,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(68,41,1,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(69,41,4,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(70,41,3,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(71,42,1,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(72,42,4,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(73,42,3,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(74,43,1,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(75,43,4,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(76,43,3,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(77,44,1,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(78,44,4,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(79,44,3,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(80,45,1,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(81,45,4,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(82,45,3,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(83,46,1,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(84,46,4,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(85,46,3,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(86,47,1,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(87,47,4,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(88,47,3,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(89,47,7,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(90,48,1,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(91,48,4,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(92,48,3,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(93,48,7,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(94,49,1,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(95,49,4,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(96,49,3,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(97,49,7,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(98,50,4,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(99,50,3,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(100,50,5,'2026-09-07 06:32:35','2026-09-07 06:32:35'),(101,50,7,'2026-09-07 06:32:35','2026-09-07 06:32:35');
/*!40000 ALTER TABLE `service_applicant_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_request_files`
--

DROP TABLE IF EXISTS `service_request_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_request_files` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `service_request_id` bigint(20) unsigned NOT NULL,
  `requirement_id` int(11) unsigned NOT NULL,
  `original_name` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_extension` varchar(20) NOT NULL,
  `mime_type` varchar(100) NOT NULL,
  `file_size` int(11) NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `verified_by` int(11) unsigned DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_request_id` (`service_request_id`),
  KEY `requirement_id` (`requirement_id`),
  KEY `verified_by` (`verified_by`),
  CONSTRAINT `service_request_files_requirement_id_foreign` FOREIGN KEY (`requirement_id`) REFERENCES `master_service_requirements` (`id`) ON DELETE CASCADE,
  CONSTRAINT `service_request_files_service_request_id_foreign` FOREIGN KEY (`service_request_id`) REFERENCES `service_requests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `service_request_files_verified_by_foreign` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_request_files`
--

LOCK TABLES `service_request_files` WRITE;
/*!40000 ALTER TABLE `service_request_files` DISABLE KEYS */;
INSERT INTO `service_request_files` VALUES (1,1,18,'phon .pdf','1790143935_2562bec1e18660deecc8.pdf','uploads/1790143935_2562bec1e18660deecc8.pdf','pdf','',2116268,0,NULL,NULL,NULL,'2026-09-23 06:12:15','2026-09-23 06:12:15',NULL),(2,17,5,'tte_pk_2026.pdf','1790146443_250c56aa63d95c9141fa.pdf','uploads/1790146443_250c56aa63d95c9141fa.pdf','pdf','',992485,0,NULL,NULL,NULL,'2026-09-23 06:54:03','2026-09-23 06:54:03',NULL);
/*!40000 ALTER TABLE `service_request_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_request_logs`
--

DROP TABLE IF EXISTS `service_request_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_request_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `service_request_id` bigint(20) unsigned NOT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  `old_status` varchar(30) DEFAULT NULL,
  `new_status` varchar(30) NOT NULL,
  `action` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_request_id` (`service_request_id`),
  KEY `user_id` (`user_id`),
  KEY `new_status` (`new_status`),
  CONSTRAINT `service_request_logs_service_request_id_foreign` FOREIGN KEY (`service_request_id`) REFERENCES `service_requests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `service_request_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_number` varchar(30) NOT NULL,
  `user_profile_id` int(11) unsigned NOT NULL,
  `service_id` int(11) unsigned NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('draft','submitted','verification','revision','processing','completed','rejected','cancelled') NOT NULL DEFAULT 'submitted',
  `priority` enum('low','normal','high','urgent') NOT NULL DEFAULT 'normal',
  `assigned_to` int(11) unsigned DEFAULT NULL,
  `submitted_at` datetime DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `processed_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `rejected_at` datetime DEFAULT NULL,
  `cancelled_at` datetime DEFAULT NULL,
  `admin_note` text DEFAULT NULL,
  `rejection_reason` text DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_requests`
--

LOCK TABLES `service_requests` WRITE;
/*!40000 ALTER TABLE `service_requests` DISABLE KEYS */;
INSERT INTO `service_requests` VALUES (1,'ULT-20260923061215636',28,14,'Validasi Pembayaran','hai','submitted','normal',NULL,'2026-09-23 06:12:15',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-09-23 06:12:15','2026-09-23 06:12:15',NULL),(2,'ULT-20260901020733314',11,50,'Layanan Surat Masuk dan Keluar','tes','verification','low',NULL,'2026-09-01 02:07:33','2026-09-01 06:35:49',NULL,NULL,NULL,NULL,NULL,NULL,'2026-09-01 02:07:33','2026-09-01 02:07:33',NULL),(3,'ULT-20260903083112286',12,50,'Layanan Surat Masuk dan Keluar','tes','processing','normal',4,'2026-09-03 08:31:12','2026-09-14 03:15:33',NULL,NULL,NULL,NULL,NULL,NULL,'2026-09-03 08:31:12','2026-09-14 06:29:24',NULL),(4,'ULT-20260910032341781',16,45,'Akses WiFi Kampus','tes','verification','normal',NULL,'2026-09-10 03:23:41','2026-09-10 03:24:22',NULL,NULL,NULL,NULL,'sok',NULL,'2026-09-10 03:23:41','2026-09-10 03:23:41',NULL),(5,'ULT-20260914051210335',17,2,'Surat Keterangan Mahasiswa','p','submitted','normal',NULL,'2026-09-14 05:12:10',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-09-14 05:12:10','2026-09-14 05:12:10',NULL),(6,'ULT-20260914052606283',18,24,'Pelaporan Prestasi Mahasiswa','p','processing','low',4,'2026-09-14 05:26:06','2026-09-15 03:46:56',NULL,NULL,NULL,NULL,NULL,NULL,'2026-09-14 05:26:06','2026-09-14 05:26:06',NULL),(7,'ULT-20260917085616454',19,46,'Akses VPN Kampus','p','submitted','normal',NULL,'2026-09-17 08:56:16',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-09-17 08:56:16','2026-09-17 08:56:16',NULL),(8,'ULT-20260918024008391',20,23,'Peminjaman Fasilitas Kegiatan','hai','submitted','normal',NULL,'2026-09-18 02:40:08',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-09-18 02:40:08','2026-09-18 02:40:08',NULL),(9,'ULT-20260918024943900',21,45,'Akses WiFi Kampus','hey','submitted','normal',NULL,'2026-09-18 02:49:44',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-09-18 02:49:44','2026-09-18 02:49:44',NULL),(10,'ULT-20260918095348167',22,15,'Pengembalian Dana','pe','submitted','normal',NULL,'2026-09-18 09:53:48',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-09-18 09:53:48','2026-09-18 09:53:48',NULL),(11,'ULT-20260922041846523',23,10,'Administrasi Yudisium','tes','processing','normal',2,'2026-09-22 04:18:46','2026-09-22 04:19:14',NULL,NULL,NULL,NULL,'tes',NULL,'2026-09-22 04:18:46','2026-09-22 04:18:46',NULL),(12,'ULT-20260922065034563',24,5,'Legalisasi Transkrip Nilai','tes','submitted','normal',NULL,'2026-09-22 06:50:35',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-09-22 06:50:35','2026-09-22 06:50:35',NULL),(13,'ULT-20260922065834985',25,31,'Bantuan Penelusuran Literatur','tes','submitted','normal',NULL,'2026-09-22 06:58:35',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-09-22 06:58:35','2026-09-22 06:58:35',NULL),(14,'ULT-20260922082655444',26,2,'Surat Keterangan Mahasiswa','tes','submitted','normal',NULL,'2026-09-22 08:26:56',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-09-22 08:26:56','2026-09-22 08:26:56',NULL),(15,'ULT-20260923054609200',27,4,'Legalisasi Ijazah','pe','submitted','normal',NULL,'2026-09-23 05:46:09',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-09-23 05:46:09','2026-09-23 05:46:09',NULL),(17,'ULT-20260923065403445',29,3,'Permohonan Daftar Nilai','hai','submitted','normal',NULL,'2026-09-23 06:54:03',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-09-23 06:54:03','2026-09-23 06:54:03',NULL);
/*!40000 ALTER TABLE `service_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_attachments`
--

DROP TABLE IF EXISTS `ticket_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` bigint(20) unsigned NOT NULL,
  `requirement_id` int(11) DEFAULT NULL,
  `requirement_name` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(500) NOT NULL,
  `file_extension` varchar(20) DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_ticket_id` (`ticket_id`),
  KEY `idx_requirement_id` (`requirement_id`),
  CONSTRAINT `fk_ticket_attachments_ticket` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_attachments`
--

LOCK TABLES `ticket_attachments` WRITE;
/*!40000 ALTER TABLE `ticket_attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_comments`
--

DROP TABLE IF EXISTS `ticket_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket_comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) unsigned NOT NULL,
  `sender` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket_id` (`ticket_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_comments`
--

LOCK TABLES `ticket_comments` WRITE;
/*!40000 ALTER TABLE `ticket_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_logs`
--

DROP TABLE IF EXISTS `ticket_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket_logs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) unsigned NOT NULL,
  `activity` varchar(255) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket_id` (`ticket_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_logs`
--

LOCK TABLES `ticket_logs` WRITE;
/*!40000 ALTER TABLE `ticket_logs` DISABLE KEYS */;
INSERT INTO `ticket_logs` VALUES (18,24,'verified','raka','2026-09-01 06:35:49'),(19,25,'Tiket didisposisikan ke unit: Bagian Kemahasiswaan','rakaa','2026-09-14 06:29:24'),(20,28,'Tiket didisposisikan otomatis ke unit: Bagian Kemahasiswaan','rakaa','2026-09-17 08:57:32'),(21,33,'Tiket didisposisikan otomatis ke unit: Bagian Akademik','rakaaa','2026-09-22 04:19:26');
/*!40000 ALTER TABLE `ticket_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tickets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_number` varchar(30) NOT NULL,
  `user_profile_id` int(11) unsigned NOT NULL,
  `service_id` int(11) unsigned NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('draft','submitted','verification','verified','revision','assigned','processing','completed','rejected','cancelled') NOT NULL DEFAULT 'submitted',
  `priority` enum('low','normal','high','urgent') NOT NULL DEFAULT 'normal',
  `assigned_to` int(11) unsigned DEFAULT NULL,
  `submitted_at` datetime DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `processed_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `rejected_at` datetime DEFAULT NULL,
  `cancelled_at` datetime DEFAULT NULL,
  `admin_note` text DEFAULT NULL,
  `rejection_reason` text DEFAULT NULL,
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
  CONSTRAINT `tickets_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `tickets_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `master_services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tickets_user_profile_id_foreign` FOREIGN KEY (`user_profile_id`) REFERENCES `user_profiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
INSERT INTO `tickets` VALUES (24,'ULT-20260901020733314',11,50,'Layanan Surat Masuk dan Keluar','tes','verified','low',NULL,'2026-09-01 02:07:33','2026-09-01 06:35:49',NULL,NULL,NULL,NULL,NULL,NULL,'2026-09-01 02:07:33','2026-09-01 02:07:33',NULL),(25,'ULT-20260903083112286',12,50,'Layanan Surat Masuk dan Keluar','tes','assigned','',4,'2026-09-03 08:31:12','2026-09-14 03:15:33',NULL,NULL,NULL,NULL,NULL,NULL,'2026-09-03 08:31:12','2026-09-14 06:29:24',NULL),(26,'ULT-20260910032341781',16,45,'Akses WiFi Kampus','tes','verified','',NULL,'2026-09-10 03:23:41','2026-09-10 03:24:22',NULL,NULL,NULL,NULL,'sok',NULL,'2026-09-10 03:23:41','2026-09-10 03:23:41',NULL),(27,'ULT-20260914051210335',17,2,'Surat Keterangan Mahasiswa','p','submitted','normal',NULL,'2026-09-14 05:12:10',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-09-14 05:12:10','2026-09-14 05:12:10',NULL),(28,'ULT-20260914052606283',18,24,'Pelaporan Prestasi Mahasiswa','p','assigned','low',4,'2026-09-14 05:26:06','2026-09-15 03:46:56',NULL,NULL,NULL,NULL,NULL,NULL,'2026-09-14 05:26:06','2026-09-14 05:26:06',NULL),(29,'ULT-20260917085616454',19,46,'Akses VPN Kampus','p','submitted','normal',NULL,'2026-09-17 08:56:16',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-09-17 08:56:16','2026-09-17 08:56:16',NULL),(30,'ULT-20260918024008391',20,23,'Peminjaman Fasilitas Kegiatan','hai','submitted','normal',NULL,'2026-09-18 02:40:08',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-09-18 02:40:08','2026-09-18 02:40:08',NULL),(31,'ULT-20260918024943900',21,45,'Akses WiFi Kampus','hey','submitted','normal',NULL,'2026-09-18 02:49:44',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-09-18 02:49:44','2026-09-18 02:49:44',NULL),(32,'ULT-20260918095348167',22,15,'Pengembalian Dana','pe','submitted','normal',NULL,'2026-09-18 09:53:48',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-09-18 09:53:48','2026-09-18 09:53:48',NULL),(33,'ULT-20260922041846523',23,10,'Administrasi Yudisium','tes','assigned','',2,'2026-09-22 04:18:46','2026-09-22 04:19:14',NULL,NULL,NULL,NULL,'tes',NULL,'2026-09-22 04:18:46','2026-09-22 04:18:46',NULL),(34,'ULT-20260922065034563',24,5,'Legalisasi Transkrip Nilai','tes','submitted','normal',NULL,'2026-09-22 06:50:35',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-09-22 06:50:35','2026-09-22 06:50:35',NULL),(35,'ULT-20260922065834985',25,31,'Bantuan Penelusuran Literatur','tes','submitted','normal',NULL,'2026-09-22 06:58:35',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-09-22 06:58:35','2026-09-22 06:58:35',NULL),(36,'ULT-20260922082655444',26,2,'Surat Keterangan Mahasiswa','tes','submitted','normal',NULL,'2026-09-22 08:26:56',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-09-22 08:26:56','2026-09-22 08:26:56',NULL),(37,'ULT-20260923054609200',27,4,'Legalisasi Ijazah','pe','submitted','normal',NULL,'2026-09-23 05:46:09',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-09-23 05:46:09','2026-09-23 05:46:09',NULL),(38,'ULT-20260923061215636',28,14,'Validasi Pembayaran','hai','submitted','normal',NULL,'2026-09-23 06:12:15',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-09-23 06:12:15','2026-09-23 06:12:15',NULL),(39,'ULT-20260923065403445',29,3,'Permohonan Daftar Nilai','hai','submitted','normal',NULL,'2026-09-23 06:54:03',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-09-23 06:54:03','2026-09-23 06:54:03',NULL);
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_profiles`
--

DROP TABLE IF EXISTS `user_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `applicant_type_id` int(10) unsigned DEFAULT NULL,
  `study_program_id` int(10) unsigned DEFAULT NULL,
  `class_id` int(10) unsigned DEFAULT NULL,
  `student_name` varchar(150) DEFAULT NULL,
  `institution_name` varchar(200) DEFAULT NULL,
  `position` varchar(150) DEFAULT NULL,
  `nim` varchar(30) DEFAULT NULL,
  `nik` varchar(30) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_profiles`
--

LOCK TABLES `user_profiles` WRITE;
/*!40000 ALTER TABLE `user_profiles` DISABLE KEYS */;
INSERT INTO `user_profiles` VALUES (11,1,1,NULL,NULL,'nanaaa',NULL,NULL,'0998727726612222',NULL,'nanaaa','nanaaa@gmail.com','9900028737222',NULL,NULL,'2026-09-01 02:07:33','2026-09-01 02:07:33',NULL),(12,1,1,NULL,NULL,'raka',NULL,NULL,'09987277266122223',NULL,'raka','raka@gmail.com','99000287372223',NULL,NULL,'2026-09-03 08:31:12','2026-09-03 08:31:12',NULL),(13,2,7,NULL,NULL,NULL,NULL,NULL,NULL,'121311313','masyarakat super','masyarakat@gmail.com','081234567890','jl.raya',NULL,'2026-09-07 07:35:26','2026-09-07 07:35:26',NULL),(14,3,7,NULL,NULL,NULL,NULL,NULL,NULL,'111','superadmin@polban.ac.id','masyaraka1t@gmail.com','081234567890','jalan',NULL,'2026-09-07 09:06:48','2026-09-07 09:06:48',NULL),(15,4,7,NULL,NULL,NULL,NULL,NULL,NULL,'111','superadmin@polban.ac.id','masyarakat1@gmail.com','081234567890','jl.raya',NULL,'2026-09-07 09:10:14','2026-09-07 09:10:14',NULL),(16,1,1,NULL,NULL,'raja',NULL,NULL,'7867487679',NULL,'raja','raja@gmail.com','08465476485',NULL,NULL,'2026-09-10 03:23:41','2026-09-10 03:23:41',NULL),(17,1,1,NULL,NULL,'ratu',NULL,NULL,NULL,NULL,'ratu','ratu@gmail.com',NULL,NULL,NULL,'2026-09-14 05:12:10','2026-09-14 12:38:40',NULL),(18,1,1,NULL,NULL,'alvin',NULL,NULL,NULL,NULL,'alvin','alvin@gmail.com','0873253547',NULL,NULL,'2026-09-14 05:26:06','2026-09-14 05:26:06',NULL),(19,1,1,NULL,NULL,'rasya',NULL,NULL,NULL,NULL,'rasya','rasya@gmail.com','08853765',NULL,NULL,'2026-09-17 08:56:16','2026-09-17 08:56:16',NULL),(20,1,1,NULL,NULL,'mahardika',NULL,NULL,NULL,NULL,'mahardika','mahardika@gmail.com','0838776216',NULL,NULL,'2026-09-18 02:40:08','2026-09-18 02:40:08',NULL),(21,1,1,NULL,NULL,'pangestu',NULL,NULL,NULL,NULL,'pangestu','pangestu@gmail.com','08521763255',NULL,NULL,'2026-09-18 02:49:44','2026-09-18 02:49:44',NULL),(22,1,1,NULL,NULL,'zein',NULL,NULL,NULL,NULL,'zein','zein@gmail.com','086512465832',NULL,NULL,'2026-09-18 09:53:48','2026-09-18 09:53:48',NULL),(23,1,1,NULL,NULL,'nan',NULL,NULL,NULL,NULL,'nan','zeian@gmail.com','02212312',NULL,NULL,'2026-09-22 04:18:46','2026-09-22 04:18:46',NULL),(24,1,1,NULL,NULL,'rakkk',NULL,NULL,NULL,NULL,'rakkk','rakkk@gmail.com','098888',NULL,NULL,'2026-09-22 06:50:35','2026-09-22 06:50:35',NULL),(25,1,1,NULL,NULL,'rijal',NULL,NULL,NULL,NULL,'rijal','rijal@gmail.com','098888',NULL,NULL,'2026-09-22 06:58:35','2026-09-22 06:58:35',NULL),(26,1,1,NULL,NULL,'yaku',NULL,NULL,NULL,NULL,'yaku','yaku@gmail.com','12222',NULL,NULL,'2026-09-22 08:26:56','2026-09-22 08:26:56',NULL),(27,1,1,NULL,NULL,'rasyaa',NULL,NULL,NULL,NULL,'rasyaa','rasyaa@gmail.com','0865375465',NULL,NULL,'2026-09-23 05:46:09','2026-09-23 05:46:09',NULL),(28,1,1,NULL,NULL,'alpinn',NULL,NULL,NULL,NULL,'alpinn','alpinn@gmail.com','08364764823',NULL,NULL,'2026-09-23 06:12:15','2026-09-23 06:12:15',NULL),(29,1,1,NULL,NULL,'alvinnn',NULL,NULL,NULL,NULL,'alvinnn','alvinnn@gmail.com','0859842652',NULL,NULL,'2026-09-23 06:54:03','2026-09-23 06:54:03',NULL);
/*!40000 ALTER TABLE `user_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `role_id` int(11) unsigned NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `identity_number` varchar(30) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `gender` enum('L','P') DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `last_login` datetime DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `mfa_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `mfa_secret` varchar(255) DEFAULT NULL,
  `mfa_recovery_codes` text DEFAULT NULL,
  `mfa_confirmed_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`),
  KEY `identity_number` (`identity_number`),
  KEY `is_active` (`is_active`),
  KEY `deleted_at` (`deleted_at`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,NULL,1,'rakaaa','ADM001','081234567890',NULL,'superadmin@polban.ac.id','$2y$10$uZ2OCuWcZ1xDGNmS4z1s1e4Hmd2jkq/OA.MuOo6nV1gCFd3k1.kVe','1788425378_9c2fac2a0f8d16125716.png',1,'2026-09-24 01:03:20',NULL,'2026-08-14 08:45:58','2026-08-14 08:45:58','2026-09-24 01:03:20',NULL,0,NULL,NULL,NULL),(2,NULL,6,'masyarakat super',NULL,'081234567890','L','masyarakat@gmail.com','$2y$10$.g0qVo93o7EdRdkWicPVMOKD398cuYko4ipWy8B8rKh.hYXGHur.W',NULL,0,NULL,NULL,NULL,'2026-09-07 07:35:26','2026-09-07 07:35:26',NULL,0,'T24BWF3DBQTCX47Y24HCSHSVWX3Q3ETO','[\"B0AB-23FA\",\"A0CA-A7C8\",\"9F4F-B9C1\",\"714A-772D\",\"7561-F41E\",\"C490-D6DF\",\"1CDD-C863\",\"64CC-71A8\",\"F429-88C7\",\"8E36-6634\"]',NULL),(3,NULL,6,'superadmin@polban.ac.id',NULL,'081234567890','L','masyaraka1t@gmail.com','$2y$10$nMdl4G18ptCiMso9y1Foc.zBnUjzZhnciyfACb9FNdgeyfLm8pARC',NULL,0,NULL,NULL,NULL,'2026-09-07 09:06:48','2026-09-07 09:06:48',NULL,0,'BERSTDOP25V2D5VELIKUPEHZE3HLG3NP','[\"DA19-CCFD\",\"38A8-AAD2\",\"8B32-27C1\",\"6B45-FE24\",\"C582-FD53\",\"5788-37FF\",\"89FA-3448\",\"1395-45FD\",\"AB49-14AF\",\"FEF9-D7CC\"]',NULL),(4,NULL,6,'superadmin@polban.ac.id',NULL,'081234567890','L','masyarakat1@gmail.com','$2y$10$HtKFWAO3fjauZFdiKjtBi.NTTHiQvATVGTNhm.SPjh/FdqMWs5SNC',NULL,0,NULL,NULL,NULL,'2026-09-07 09:10:14','2026-09-07 09:10:14',NULL,0,'URYSKBFEJFAHWKHVAQ5DBFGM2EJ2V5CE','[\"7CAD-2B28\",\"6F60-6B04\",\"28CF-F03F\",\"54F5-C5E3\",\"F501-2149\",\"EB24-C833\",\"E5B8-11C4\",\"5C6C-9880\",\"3503-4497\",\"47B7-31B5\"]',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-24  8:06:40
