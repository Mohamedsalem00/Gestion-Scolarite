-- MySQL dump 10.13  Distrib 8.0.43, for Linux (x86_64)
--
-- Host: localhost    Database: gestionscolarité
-- ------------------------------------------------------
-- Server version	8.0.43-0ubuntu0.24.04.2

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
-- Table structure for table `administrateurs`
--

DROP TABLE IF EXISTS `administrateurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administrateurs` (
  `id_administrateur` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mot_de_passe` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_administrateur`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrateurs`
--

LOCK TABLES `administrateurs` WRITE;
/*!40000 ALTER TABLE `administrateurs` DISABLE KEYS */;
INSERT INTO `administrateurs` VALUES (1,'Directeur Principal','Mohamed','admin@ecole.com','$2y$10$B4xpIrf3a1oMJO27g3iaQeDZa4v1tbifa4WyiQ/bi6KrmYB.AA1tG','2025-09-15 21:08:04','2025-09-15 21:08:04'),(2,'Secrétaire Générale','Fatima','secretaire@ecole.com','$2y$10$l0JEIxCOE.egdMWVQQw5seo8SWflHwgkY0l5ryr7TlYKGRNceFDDm','2025-09-15 21:08:04','2025-09-15 21:08:04'),(3,'Comptable','Ahmed','comptable@ecole.com','$2y$10$EbzilHH9orHmiZ3xkVzZ2eAhQiLNS0bL0pVPeaSEYjZQOafAZeczG','2025-09-15 21:08:04','2025-09-15 21:08:04');
/*!40000 ALTER TABLE `administrateurs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `classes` (
  `id_classe` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom_classe` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `niveau` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_classe_translations` json DEFAULT NULL,
  `niveau_translations` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_classe`),
  KEY `classes_niveau_index` (`niveau`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classes`
--

LOCK TABLES `classes` WRITE;
/*!40000 ALTER TABLE `classes` DISABLE KEYS */;
INSERT INTO `classes` VALUES (1,'CP1','1',NULL,NULL,'2025-09-15 21:08:04','2025-09-15 21:08:04'),(2,'CP2','2',NULL,NULL,'2025-09-15 21:08:04','2025-09-15 21:08:04'),(3,'CE1','3',NULL,NULL,'2025-09-15 21:08:04','2025-09-15 21:08:04'),(4,'CE2','4',NULL,NULL,'2025-09-15 21:08:04','2025-09-15 21:08:04'),(5,'CM1','5',NULL,NULL,'2025-09-15 21:08:04','2025-09-15 21:08:04'),(6,'CM2','6',NULL,NULL,'2025-09-15 21:08:04','2025-09-15 21:08:04'),(7,'6ème A','7',NULL,NULL,'2025-09-15 21:08:04','2025-09-15 21:08:04'),(8,'6ème B','7',NULL,NULL,'2025-09-15 21:08:04','2025-09-15 21:08:04'),(9,'5ème A','8',NULL,NULL,'2025-09-15 21:08:04','2025-09-15 21:08:04'),(10,'5ème B','8',NULL,NULL,'2025-09-15 21:08:04','2025-09-15 21:08:04'),(11,'4ème A','9',NULL,NULL,'2025-09-15 21:08:04','2025-09-15 21:08:04'),(12,'4ème B','9',NULL,NULL,'2025-09-15 21:08:04','2025-09-15 21:08:04'),(13,'3ème A','10',NULL,NULL,'2025-09-15 21:08:04','2025-09-15 21:08:04'),(14,'3ème B','10',NULL,NULL,'2025-09-15 21:08:04','2025-09-15 21:08:04'),(15,'2nde A','11',NULL,NULL,'2025-09-15 21:08:04','2025-09-15 21:08:04'),(16,'2nde B','11',NULL,NULL,'2025-09-15 21:08:04','2025-09-15 21:08:04'),(17,'1ère L','12',NULL,NULL,'2025-09-15 21:08:04','2025-09-15 21:08:04'),(18,'1ère S','12',NULL,NULL,'2025-09-15 21:08:04','2025-09-15 21:08:04'),(19,'Terminale L','13',NULL,NULL,'2025-09-15 21:08:04','2025-09-15 21:08:04'),(20,'Terminale S','13',NULL,NULL,'2025-09-15 21:08:04','2025-09-15 21:08:04');
/*!40000 ALTER TABLE `classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cours`
--

DROP TABLE IF EXISTS `cours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cours` (
  `id_cours` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_matiere` bigint unsigned NOT NULL,
  `jour` enum('lundi','mardi','mercredi','jeudi','vendredi','samedi','dimanche') COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_debut` time NOT NULL,
  `date_fin` time NOT NULL,
  `id_enseignant` bigint unsigned NOT NULL,
  `id_classe` bigint unsigned NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_cours`),
  KEY `cours_id_classe_foreign` (`id_classe`),
  KEY `cours_id_enseignant_id_classe_index` (`id_enseignant`,`id_classe`),
  KEY `cours_jour_index` (`jour`),
  KEY `cours_id_matiere_foreign` (`id_matiere`),
  CONSTRAINT `cours_id_classe_foreign` FOREIGN KEY (`id_classe`) REFERENCES `classes` (`id_classe`),
  CONSTRAINT `cours_id_enseignant_foreign` FOREIGN KEY (`id_enseignant`) REFERENCES `enseignants` (`id_enseignant`),
  CONSTRAINT `cours_id_matiere_foreign` FOREIGN KEY (`id_matiere`) REFERENCES `matieres` (`id_matiere`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cours`
--

LOCK TABLES `cours` WRITE;
/*!40000 ALTER TABLE `cours` DISABLE KEYS */;
INSERT INTO `cours` VALUES (1,2,'mardi','16:00:00','17:00:00',5,7,'Cours de Français pour la classe 6ème A','2025-09-15 21:08:05','2025-09-15 21:08:05'),(2,2,'jeudi','11:00:00','12:00:00',5,12,'Cours de Français pour la classe 4ème B','2025-09-15 21:08:05','2025-09-15 21:08:05'),(3,2,'lundi','14:00:00','15:00:00',5,12,'Cours de Français pour la classe 4ème B','2025-09-15 21:08:05','2025-09-15 21:08:05'),(4,5,'mardi','11:00:00','12:00:00',5,7,'Cours de Sciences Physiques pour la classe 6ème A','2025-09-15 21:08:05','2025-09-15 21:08:05'),(5,5,'jeudi','09:00:00','10:00:00',5,12,'Cours de Sciences Physiques pour la classe 4ème B','2025-09-15 21:08:05','2025-09-15 21:08:05'),(6,10,'mercredi','09:00:00','10:00:00',5,7,'Cours de Informatique pour la classe 6ème A','2025-09-15 21:08:05','2025-09-15 21:08:05'),(7,10,'vendredi','15:00:00','16:00:00',5,7,'Cours de Informatique pour la classe 6ème A','2025-09-15 21:08:05','2025-09-15 21:08:05'),(8,10,'mardi','09:00:00','10:00:00',5,12,'Cours de Informatique pour la classe 4ème B','2025-09-15 21:08:05','2025-09-15 21:08:05'),(9,10,'vendredi','09:00:00','10:00:00',5,12,'Cours de Informatique pour la classe 4ème B','2025-09-15 21:08:05','2025-09-15 21:08:05'),(10,1,'lundi','14:00:00','15:00:00',1,1,'Cours de Mathématiques pour la classe CP1','2025-09-15 21:08:05','2025-09-15 21:08:05'),(11,1,'jeudi','16:00:00','17:00:00',1,2,'Cours de Mathématiques pour la classe CP2','2025-09-15 21:08:05','2025-09-15 21:08:05'),(12,5,'lundi','09:00:00','10:00:00',1,1,'Cours de Sciences Physiques pour la classe CP1','2025-09-15 21:08:05','2025-09-15 21:08:05'),(13,5,'vendredi','09:00:00','10:00:00',1,2,'Cours de Sciences Physiques pour la classe CP2','2025-09-15 21:08:05','2025-09-15 21:08:05'),(14,5,'lundi','08:00:00','09:00:00',1,2,'Cours de Sciences Physiques pour la classe CP2','2025-09-15 21:08:05','2025-09-15 21:08:05'),(15,1,'mercredi','10:00:00','11:00:00',2,1,'Cours de Mathématiques pour la classe CP1','2025-09-15 21:08:05','2025-09-15 21:08:05'),(16,1,'lundi','09:00:00','10:00:00',2,5,'Cours de Mathématiques pour la classe CM1','2025-09-15 21:08:05','2025-09-15 21:08:05'),(17,6,'mardi','09:00:00','10:00:00',2,1,'Cours de Sciences de la Vie et de la Terre pour la classe CP1','2025-09-15 21:08:05','2025-09-15 21:08:05'),(18,6,'mercredi','08:00:00','09:00:00',2,1,'Cours de Sciences de la Vie et de la Terre pour la classe CP1','2025-09-15 21:08:05','2025-09-15 21:08:05'),(19,6,'mercredi','14:00:00','15:00:00',2,5,'Cours de Sciences de la Vie et de la Terre pour la classe CM1','2025-09-15 21:08:05','2025-09-15 21:08:05'),(20,6,'lundi','10:00:00','11:00:00',2,5,'Cours de Sciences de la Vie et de la Terre pour la classe CM1','2025-09-15 21:08:05','2025-09-15 21:08:05'),(21,7,'vendredi','14:00:00','15:00:00',2,1,'Cours de Education Physique et Sportive pour la classe CP1','2025-09-15 21:08:05','2025-09-15 21:08:05'),(22,7,'vendredi','14:00:00','15:00:00',2,5,'Cours de Education Physique et Sportive pour la classe CM1','2025-09-15 21:08:05','2025-09-15 21:08:05'),(23,7,'lundi','08:00:00','09:00:00',2,5,'Cours de Education Physique et Sportive pour la classe CM1','2025-09-15 21:08:05','2025-09-15 21:08:05'),(24,1,'mardi','10:00:00','11:00:00',3,8,'Cours de Mathématiques pour la classe 6ème B','2025-09-15 21:08:05','2025-09-15 21:08:05'),(25,1,'jeudi','11:00:00','12:00:00',3,13,'Cours de Mathématiques pour la classe 3ème A','2025-09-15 21:08:05','2025-09-15 21:08:05'),(26,2,'vendredi','14:00:00','15:00:00',3,8,'Cours de Français pour la classe 6ème B','2025-09-15 21:08:05','2025-09-15 21:08:05'),(27,2,'mardi','15:00:00','16:00:00',3,8,'Cours de Français pour la classe 6ème B','2025-09-15 21:08:05','2025-09-15 21:08:05'),(28,2,'vendredi','16:00:00','17:00:00',3,13,'Cours de Français pour la classe 3ème A','2025-09-15 21:08:05','2025-09-15 21:08:05'),(29,4,'mardi','14:00:00','15:00:00',3,8,'Cours de Histoire-Géographie pour la classe 6ème B','2025-09-15 21:08:05','2025-09-15 21:08:05'),(30,4,'vendredi','10:00:00','11:00:00',3,8,'Cours de Histoire-Géographie pour la classe 6ème B','2025-09-15 21:08:05','2025-09-15 21:08:05'),(31,4,'mercredi','16:00:00','17:00:00',3,13,'Cours de Histoire-Géographie pour la classe 3ème A','2025-09-15 21:08:05','2025-09-15 21:08:05'),(32,3,'jeudi','09:00:00','10:00:00',4,12,'Cours de Anglais pour la classe 4ème B','2025-09-15 21:08:05','2025-09-15 21:08:05'),(33,3,'lundi','09:00:00','10:00:00',4,16,'Cours de Anglais pour la classe 2nde B','2025-09-15 21:08:05','2025-09-15 21:08:05'),(34,6,'mercredi','10:00:00','11:00:00',4,12,'Cours de Sciences de la Vie et de la Terre pour la classe 4ème B','2025-09-15 21:08:05','2025-09-15 21:08:05'),(35,6,'lundi','16:00:00','17:00:00',4,16,'Cours de Sciences de la Vie et de la Terre pour la classe 2nde B','2025-09-15 21:08:05','2025-09-15 21:08:05'),(36,6,'mardi','09:00:00','10:00:00',4,16,'Cours de Sciences de la Vie et de la Terre pour la classe 2nde B','2025-09-15 21:08:05','2025-09-15 21:08:05'),(37,7,'lundi','14:00:00','15:00:00',4,12,'Cours de Education Physique et Sportive pour la classe 4ème B','2025-09-15 21:08:05','2025-09-15 21:08:05'),(38,7,'mercredi','08:00:00','09:00:00',4,16,'Cours de Education Physique et Sportive pour la classe 2nde B','2025-09-15 21:08:05','2025-09-15 21:08:05');
/*!40000 ALTER TABLE `cours` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enseignant_matiere_classe`
--

DROP TABLE IF EXISTS `enseignant_matiere_classe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enseignant_matiere_classe` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_enseignant` bigint unsigned NOT NULL,
  `id_matiere` bigint unsigned NOT NULL,
  `id_classe` bigint unsigned NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_enseignant_matiere_classe` (`id_enseignant`,`id_matiere`,`id_classe`),
  KEY `enseignant_matiere_classe_id_matiere_index` (`id_matiere`),
  KEY `enseignant_matiere_classe_id_classe_index` (`id_classe`),
  KEY `enseignant_matiere_classe_active_index` (`active`),
  CONSTRAINT `enseignant_matiere_classe_id_classe_foreign` FOREIGN KEY (`id_classe`) REFERENCES `classes` (`id_classe`) ON DELETE CASCADE,
  CONSTRAINT `enseignant_matiere_classe_id_enseignant_foreign` FOREIGN KEY (`id_enseignant`) REFERENCES `enseignants` (`id_enseignant`) ON DELETE CASCADE,
  CONSTRAINT `enseignant_matiere_classe_id_matiere_foreign` FOREIGN KEY (`id_matiere`) REFERENCES `matieres` (`id_matiere`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enseignant_matiere_classe`
--

LOCK TABLES `enseignant_matiere_classe` WRITE;
/*!40000 ALTER TABLE `enseignant_matiere_classe` DISABLE KEYS */;
INSERT INTO `enseignant_matiere_classe` VALUES (1,1,1,1,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(2,1,1,2,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(3,1,5,1,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(4,1,5,2,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(5,2,1,1,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(6,2,1,5,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(7,2,6,1,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(8,2,6,5,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(9,2,7,1,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(10,2,7,5,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(11,3,1,8,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(12,3,1,13,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(13,3,2,8,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(14,3,2,13,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(15,3,4,8,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(16,3,4,13,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(17,4,3,12,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(18,4,3,16,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(19,4,6,12,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(20,4,6,16,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(21,4,7,12,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(22,4,7,16,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(23,5,2,7,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(24,5,2,12,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(25,5,5,7,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(26,5,5,12,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(27,5,10,7,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(28,5,10,12,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(29,1,1,7,1,'2025-09-15 22:22:42','2025-09-15 22:22:42'),(30,1,2,7,1,'2025-09-15 22:35:18','2025-09-15 22:35:18');
/*!40000 ALTER TABLE `enseignant_matiere_classe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enseignants`
--

DROP TABLE IF EXISTS `enseignants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enseignants` (
  `id_enseignant` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_enseignant`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enseignants`
--

LOCK TABLES `enseignants` WRITE;
/*!40000 ALTER TABLE `enseignants` DISABLE KEYS */;
INSERT INTO `enseignants` VALUES (1,'El Moctar','Sidi Mohamed','elmoctar@ecole.com','+222 20 11 22 33','2025-09-15 21:08:04','2025-09-15 21:08:04'),(2,'Mint Mohamedou','Aminetou','aminetou@ecole.com','+222 20 11 22 34','2025-09-15 21:08:04','2025-09-15 21:08:04'),(3,'Ould Baba','Oumar','oumar@ecole.com','+222 20 11 22 35','2025-09-15 21:08:04','2025-09-15 21:08:04'),(4,'Mint Ahmed','Khadija','khadija@ecole.com','+222 20 11 22 36','2025-09-15 21:08:04','2025-09-15 21:08:04'),(5,'Ould Sid Ahmed','Mohamed Lemine','lemine@ecole.com','+222 20 11 22 37','2025-09-15 21:08:04','2025-09-15 21:08:04');
/*!40000 ALTER TABLE `enseignants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enseignpaiements`
--

DROP TABLE IF EXISTS `enseignpaiements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enseignpaiements` (
  `id_paiements` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `typepaiement` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` decimal(10,2) NOT NULL DEFAULT '0.00',
  `statut` enum('paye','non_paye','partiel') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non_paye',
  `date_paiement` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_paiements`),
  KEY `enseignpaiements_statut_index` (`statut`),
  KEY `enseignpaiements_user_id_foreign` (`user_id`),
  CONSTRAINT `enseignpaiements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enseignpaiements`
--

LOCK TABLES `enseignpaiements` WRITE;
/*!40000 ALTER TABLE `enseignpaiements` DISABLE KEYS */;
/*!40000 ALTER TABLE `enseignpaiements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etudepaiements`
--

DROP TABLE IF EXISTS `etudepaiements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `etudepaiements` (
  `id_paiements` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_etudiant` bigint unsigned NOT NULL,
  `typepaye` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` decimal(10,2) NOT NULL DEFAULT '0.00',
  `statut` enum('paye','non_paye','partiel') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non_paye',
  `date_paiement` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_paiements`),
  KEY `etudepaiements_id_etudiant_index` (`id_etudiant`),
  KEY `etudepaiements_statut_index` (`statut`),
  CONSTRAINT `etudepaiements_id_etudiant_foreign` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiants` (`id_etudiant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etudepaiements`
--

LOCK TABLES `etudepaiements` WRITE;
/*!40000 ALTER TABLE `etudepaiements` DISABLE KEYS */;
/*!40000 ALTER TABLE `etudepaiements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etudiants`
--

DROP TABLE IF EXISTS `etudiants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `etudiants` (
  `id_etudiant` bigint unsigned NOT NULL AUTO_INCREMENT,
  `matricule` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `genre` enum('masculin','feminin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_classe` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_etudiant`),
  UNIQUE KEY `etudiants_matricule_unique` (`matricule`),
  KEY `etudiants_id_classe_index` (`id_classe`),
  KEY `etudiants_nom_index` (`nom`),
  KEY `etudiants_matricule_index` (`matricule`),
  CONSTRAINT `etudiants_id_classe_foreign` FOREIGN KEY (`id_classe`) REFERENCES `classes` (`id_classe`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etudiants`
--

LOCK TABLES `etudiants` WRITE;
/*!40000 ALTER TABLE `etudiants` DISABLE KEYS */;
INSERT INTO `etudiants` VALUES (1,'ETU0001','Ba','Aissata','2010-03-15','feminin','+222 30 11 22 33','Tevragh Zeina, Nouakchott','aissata.ba@etudiant.com',7,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(2,'ETU0002','Ould Ahmed','Mohamed Salem','2010-07-22','masculin','+222 30 11 22 34','Ksar, Nouakchott','salem.ahmed@etudiant.com',7,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(3,'ETU0003','Mint Sidi','Fatimata','2010-11-08','feminin','+222 30 11 22 35','El Mina, Nouakchott','fatimata.sidi@etudiant.com',7,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(4,'ETU0004','Ould Baba','Ahmed Mahmoud','2010-01-12','masculin','+222 30 11 22 36','Sebkha, Nouakchott','ahmed.baba@etudiant.com',8,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(5,'ETU0005','Sy','Mariama','2010-05-30','feminin','+222 30 11 22 37','Arafat, Nouakchott','mariama.sy@etudiant.com',8,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(6,'ETU0006','Ould Mohamed','Sidi Mohamed','2009-09-14','masculin','+222 30 11 22 38','Toujounine, Nouakchott','sidi.mohamed@etudiant.com',9,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(7,'ETU0007','Mint Vall','Aïcha','2009-02-28','feminin','+222 30 11 22 39','Dar Naim, Nouakchott','aicha.vall@etudiant.com',9,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(8,'ETU0008','Kane','Ousmane','2005-12-10','masculin','+222 30 11 22 40','Riad, Nouakchott','ousmane.kane@etudiant.com',20,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(9,'ETU0009','Mint Ebnou','Khadijetou','2005-08-16','feminin','+222 30 11 22 41','Hay Saken, Nouakchott','khadijetou.ebnou@etudiant.com',20,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(10,'ETU0010','Diallo','Amadou','2012-04-25','masculin','+222 30 11 22 42','Medina, Nouakchott','amadou.diallo@etudiant.com',6,'2025-09-15 21:08:05','2025-09-15 21:08:05');
/*!40000 ALTER TABLE `etudiants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evaluations`
--

DROP TABLE IF EXISTS `evaluations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `evaluations` (
  `id_evaluation` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_matiere` bigint unsigned NOT NULL,
  `titre` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `date_debut` time DEFAULT NULL,
  `date_fin` time DEFAULT NULL,
  `id_classe` bigint unsigned NOT NULL,
  `type` enum('devoir','examen','controle') COLLATE utf8mb4_unicode_ci NOT NULL,
  `note_max` decimal(5,2) NOT NULL DEFAULT '20.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_evaluation`),
  KEY `evaluations_id_classe_index` (`id_classe`),
  KEY `evaluations_id_matiere_index` (`id_matiere`),
  CONSTRAINT `evaluations_id_classe_foreign` FOREIGN KEY (`id_classe`) REFERENCES `classes` (`id_classe`),
  CONSTRAINT `evaluations_id_matiere_foreign` FOREIGN KEY (`id_matiere`) REFERENCES `matieres` (`id_matiere`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluations`
--

LOCK TABLES `evaluations` WRITE;
/*!40000 ALTER TABLE `evaluations` DISABLE KEYS */;
INSERT INTO `evaluations` VALUES (1,2,'Devoir de Français - Séance 1','2025-08-05','13:30:00','14:30:00',7,'devoir',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(2,2,'Examen de Français - Séance 2','2025-09-23','15:30:00','16:30:00',7,'examen',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(3,2,'Controle de Français - Séance 3','2025-07-28','15:00:00','18:00:00',7,'controle',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(4,2,'Controle de Français - Séance 1','2025-09-16','08:30:00','10:30:00',12,'controle',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(5,2,'Devoir de Français - Séance 2','2025-10-01','09:00:00','12:00:00',12,'devoir',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(6,2,'Devoir de Français - Séance 3','2025-08-01','15:00:00','16:00:00',12,'devoir',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(7,2,'Devoir de Français - Séance 1','2025-08-16','15:00:00','17:00:00',12,'devoir',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(8,2,'Devoir de Français - Séance 2','2025-07-17','09:30:00','10:30:00',12,'devoir',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(9,5,'Examen de Sciences Physiques - Séance 1','2025-08-07','10:30:00','13:30:00',7,'examen',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(10,5,'Devoir de Sciences Physiques - Séance 2','2025-07-11','10:30:00','13:30:00',7,'devoir',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(11,5,'Devoir de Sciences Physiques - Séance 1','2025-09-05','14:30:00','17:30:00',12,'devoir',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(12,5,'Examen de Sciences Physiques - Séance 2','2025-08-03','10:00:00','12:00:00',12,'examen',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(13,5,'Controle de Sciences Physiques - Séance 3','2025-08-24','14:30:00','16:30:00',12,'controle',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(14,10,'Controle de Informatique - Séance 1','2025-08-28','13:00:00','14:00:00',7,'controle',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(15,10,'Examen de Informatique - Séance 2','2025-09-28','15:30:00','16:30:00',7,'examen',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(16,10,'Devoir de Informatique - Séance 3','2025-08-12','09:30:00','10:30:00',7,'devoir',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(17,10,'Controle de Informatique - Séance 1','2025-09-17','09:00:00','12:00:00',7,'controle',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(18,10,'Devoir de Informatique - Séance 2','2025-08-10','14:00:00','17:00:00',7,'devoir',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(19,10,'Devoir de Informatique - Séance 1','2025-07-27','13:00:00','14:00:00',12,'devoir',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(20,10,'Examen de Informatique - Séance 2','2025-08-23','14:00:00','15:00:00',12,'examen',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(21,10,'Controle de Informatique - Séance 3','2025-07-12','13:30:00','15:30:00',12,'controle',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(22,10,'Controle de Informatique - Séance 1','2025-09-20','15:00:00','17:00:00',12,'controle',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(23,10,'Examen de Informatique - Séance 2','2025-08-02','09:00:00','11:00:00',12,'examen',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(24,1,'Controle de Mathématiques - Séance 1','2025-09-28','10:30:00','13:30:00',1,'controle',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(25,1,'Examen de Mathématiques - Séance 2','2025-07-25','15:00:00','17:00:00',1,'examen',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(26,1,'Controle de Mathématiques - Séance 1','2025-08-17','15:00:00','16:00:00',2,'controle',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(27,1,'Controle de Mathématiques - Séance 2','2025-07-16','10:00:00','11:00:00',2,'controle',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(28,5,'Controle de Sciences Physiques - Séance 1','2025-08-15','15:00:00','17:00:00',1,'controle',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(29,5,'Controle de Sciences Physiques - Séance 2','2025-09-13','14:30:00','15:30:00',1,'controle',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(30,5,'Controle de Sciences Physiques - Séance 1','2025-07-16','13:00:00','14:00:00',2,'controle',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(31,5,'Controle de Sciences Physiques - Séance 2','2025-09-09','13:30:00','15:30:00',2,'controle',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(32,5,'Examen de Sciences Physiques - Séance 3','2025-09-21','10:00:00','13:00:00',2,'examen',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(33,5,'Controle de Sciences Physiques - Séance 1','2025-07-11','09:00:00','12:00:00',2,'controle',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(34,5,'Examen de Sciences Physiques - Séance 2','2025-08-21','15:30:00','17:30:00',2,'examen',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(35,1,'Examen de Mathématiques - Séance 1','2025-07-10','10:30:00','13:30:00',1,'examen',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(36,1,'Devoir de Mathématiques - Séance 2','2025-07-16','15:30:00','16:30:00',1,'devoir',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(37,1,'Devoir de Mathématiques - Séance 3','2025-08-31','09:00:00','12:00:00',1,'devoir',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(38,1,'Controle de Mathématiques - Séance 1','2025-07-30','15:00:00','18:00:00',5,'controle',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(39,1,'Devoir de Mathématiques - Séance 2','2025-07-25','08:30:00','10:30:00',5,'devoir',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(40,1,'Controle de Mathématiques - Séance 3','2025-09-11','15:30:00','16:30:00',5,'controle',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(41,6,'Examen de Sciences de la Vie et de la Terre - Séance 1','2025-09-15','13:30:00','15:30:00',1,'examen',20.00,'2025-10-02 14:31:59','2025-10-02 14:31:59'),(42,6,'Controle de Sciences de la Vie et de la Terre - Séance 2','2025-07-24','08:00:00','10:00:00',1,'controle',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(43,6,'Examen de Sciences de la Vie et de la Terre - Séance 1','2025-09-13','14:00:00','16:00:00',1,'examen',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(44,6,'Examen de Sciences de la Vie et de la Terre - Séance 2','2025-07-28','15:00:00','16:00:00',1,'examen',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(45,6,'Controle de Sciences de la Vie et de la Terre - Séance 3','2025-08-13','09:30:00','11:30:00',1,'controle',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(46,6,'Examen de Sciences de la Vie et de la Terre - Séance 1','2025-08-29','10:00:00','12:00:00',5,'examen',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(47,6,'Devoir de Sciences de la Vie et de la Terre - Séance 2','2025-08-29','14:30:00','17:30:00',5,'devoir',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(48,6,'Devoir de Sciences de la Vie et de la Terre - Séance 3','2025-08-07','15:00:00','18:00:00',5,'devoir',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(49,6,'Controle de Sciences de la Vie et de la Terre - Séance 1','2025-09-02','13:00:00','15:00:00',5,'controle',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(50,6,'Devoir de Sciences de la Vie et de la Terre - Séance 2','2025-08-19','14:00:00','16:00:00',5,'devoir',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(51,7,'Examen de Education Physique et Sportive - Séance 1','2025-08-03','14:30:00','16:30:00',1,'examen',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(52,7,'Controle de Education Physique et Sportive - Séance 2','2025-07-11','09:30:00','11:30:00',1,'controle',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(53,7,'Devoir de Education Physique et Sportive - Séance 1','2025-07-22','08:30:00','11:30:00',5,'devoir',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(54,7,'Devoir de Education Physique et Sportive - Séance 2','2025-09-06','08:00:00','09:00:00',5,'devoir',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(55,7,'Controle de Education Physique et Sportive - Séance 1','2025-07-30','15:30:00','16:30:00',5,'controle',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(56,7,'Devoir de Education Physique et Sportive - Séance 2','2025-08-15','13:30:00','15:30:00',5,'devoir',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(57,1,'Examen de Mathématiques - Séance 1','2025-07-05','10:00:00','12:00:00',8,'examen',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(58,1,'Devoir de Mathématiques - Séance 2','2025-08-10','14:00:00','16:00:00',8,'devoir',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(59,1,'Controle de Mathématiques - Séance 3','2025-08-09','09:30:00','11:30:00',8,'controle',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(60,1,'Controle de Mathématiques - Séance 1','2025-07-05','13:30:00','16:30:00',13,'controle',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(61,1,'Controle de Mathématiques - Séance 2','2025-07-23','08:00:00','11:00:00',13,'controle',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(62,2,'Devoir de Français - Séance 1','2025-07-11','13:00:00','16:00:00',8,'devoir',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(63,2,'Controle de Français - Séance 2','2025-07-14','13:00:00','16:00:00',8,'controle',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(64,2,'Examen de Français - Séance 3','2025-09-06','10:30:00','13:30:00',8,'examen',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(65,2,'Devoir de Français - Séance 1','2025-07-05','15:30:00','16:30:00',8,'devoir',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(66,2,'Devoir de Français - Séance 2','2025-08-26','14:00:00','15:00:00',8,'devoir',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(67,2,'Devoir de Français - Séance 1','2025-07-22','10:30:00','12:30:00',13,'devoir',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(68,2,'Examen de Français - Séance 2','2025-07-29','15:30:00','18:30:00',13,'examen',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(69,2,'Examen de Français - Séance 3','2025-08-08','13:30:00','15:30:00',13,'examen',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(70,4,'Examen de Histoire-Géographie - Séance 1','2025-08-17','08:00:00','11:00:00',8,'examen',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(71,4,'Devoir de Histoire-Géographie - Séance 2','2025-07-16','13:30:00','15:30:00',8,'devoir',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(72,4,'Devoir de Histoire-Géographie - Séance 3','2025-08-10','09:00:00','11:00:00',8,'devoir',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(73,4,'Controle de Histoire-Géographie - Séance 1','2025-07-31','09:00:00','10:00:00',8,'controle',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(74,4,'Devoir de Histoire-Géographie - Séance 2','2025-08-01','10:30:00','13:30:00',8,'devoir',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(75,4,'Devoir de Histoire-Géographie - Séance 1','2025-08-19','13:30:00','16:30:00',13,'devoir',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(76,4,'Controle de Histoire-Géographie - Séance 2','2025-09-05','15:30:00','18:30:00',13,'controle',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(77,4,'Controle de Histoire-Géographie - Séance 3','2025-07-22','10:30:00','13:30:00',13,'controle',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(78,3,'Controle de Anglais - Séance 1','2025-07-23','08:30:00','09:30:00',12,'controle',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(79,3,'Devoir de Anglais - Séance 2','2025-07-23','08:00:00','10:00:00',12,'devoir',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(80,3,'Devoir de Anglais - Séance 3','2025-08-29','13:30:00','15:30:00',12,'devoir',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(81,3,'Controle de Anglais - Séance 1','2025-07-14','09:00:00','10:00:00',16,'controle',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(82,3,'Controle de Anglais - Séance 2','2025-07-31','08:30:00','11:30:00',16,'controle',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(83,6,'Controle de Sciences de la Vie et de la Terre - Séance 1','2025-07-27','13:00:00','14:00:00',12,'controle',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(84,6,'Examen de Sciences de la Vie et de la Terre - Séance 2','2025-09-25','13:30:00','14:30:00',12,'examen',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(85,6,'Devoir de Sciences de la Vie et de la Terre - Séance 3','2025-07-19','08:30:00','11:30:00',12,'devoir',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(86,6,'Devoir de Sciences de la Vie et de la Terre - Séance 1','2025-07-19','08:00:00','09:00:00',16,'devoir',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(87,6,'Examen de Sciences de la Vie et de la Terre - Séance 2','2025-09-01','14:30:00','17:30:00',16,'examen',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(88,6,'Devoir de Sciences de la Vie et de la Terre - Séance 3','2025-08-01','13:30:00','15:30:00',16,'devoir',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(89,6,'Examen de Sciences de la Vie et de la Terre - Séance 1','2025-09-21','09:30:00','11:30:00',16,'examen',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(90,6,'Controle de Sciences de la Vie et de la Terre - Séance 2','2025-07-12','09:00:00','11:00:00',16,'controle',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(91,7,'Controle de Education Physique et Sportive - Séance 1','2025-09-21','14:00:00','15:00:00',12,'controle',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(92,7,'Devoir de Education Physique et Sportive - Séance 2','2025-08-14','14:00:00','16:00:00',12,'devoir',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(93,7,'Examen de Education Physique et Sportive - Séance 3','2025-09-29','15:00:00','16:00:00',12,'examen',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(94,7,'Examen de Education Physique et Sportive - Séance 1','2025-09-12','08:30:00','10:30:00',16,'examen',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(95,7,'Devoir de Education Physique et Sportive - Séance 2','2025-09-06','10:00:00','11:00:00',16,'devoir',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00'),(96,7,'Examen de Education Physique et Sportive - Séance 3','2025-09-22','08:00:00','11:00:00',16,'examen',20.00,'2025-10-02 14:32:00','2025-10-02 14:32:00');
/*!40000 ALTER TABLE `evaluations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matieres`
--

DROP TABLE IF EXISTS `matieres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `matieres` (
  `id_matiere` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom_matiere` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_matiere` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `coefficient` int NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_matiere`),
  UNIQUE KEY `matieres_code_matiere_unique` (`code_matiere`),
  KEY `matieres_code_matiere_index` (`code_matiere`),
  KEY `matieres_active_index` (`active`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matieres`
--

LOCK TABLES `matieres` WRITE;
/*!40000 ALTER TABLE `matieres` DISABLE KEYS */;
INSERT INTO `matieres` VALUES (1,'Mathématiques','MATH','Mathématiques générales',4,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(2,'Français','FR','Langue française et littérature',3,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(3,'Anglais','ANG','Langue anglaise',2,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(4,'Histoire-Géographie','HG','Histoire et géographie',3,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(5,'Sciences Physiques','PHY','Physique et chimie',3,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(6,'Sciences de la Vie et de la Terre','SVT','Biologie et géologie',3,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(7,'Education Physique et Sportive','EPS','Sport et éducation physique',1,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(8,'Education Civique','EC','Education civique et morale',1,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(9,'Arts Plastiques','ART','Arts visuels et plastiques',1,1,'2025-09-15 21:08:05','2025-09-15 21:08:05'),(10,'Informatique','INFO','Informatique et technologies',2,1,'2025-09-15 21:08:05','2025-09-15 21:08:05');
/*!40000 ALTER TABLE `matieres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2014_10_12_100000_create_password_resets_table',1),(4,'2019_08_19_000000_create_failed_jobs_table',1),(5,'2019_12_14_000001_create_personal_access_tokens_table',1),(6,'2023_07_25_192911_create_classes_table',1),(7,'2023_07_25_192912_create_administrateurs_table',1),(8,'2023_07_25_192912_create_enseignants_table',1),(9,'2023_07_25_192912_create_etudiants_table',1),(10,'2023_07_25_192913_create_cours_table',1),(11,'2023_07_25_192914_create_evaluations_table',1),(12,'2023_07_25_192915_create_etudepaiements_table',1),(13,'2023_07_25_192915_create_notes_table',1),(14,'2023_07_25_192916_create_enseignpaiements_table',1),(15,'2025_09_14_125323_create_clean_auth_system',1),(16,'2025_09_15_133352_add_note_max_to_evaluations_table',1),(17,'2025_09_15_142536_create_matieres_table',1),(18,'2025_09_15_142607_create_enseignant_matiere_classe_table',1),(19,'2025_09_15_143446_update_evaluations_table_for_matieres',1),(20,'2025_09_15_154536_update_cours_table_for_matieres',1),(21,'2025_09_15_154725_update_notes_table_for_matieres',1),(22,'2025_09_15_154850_update_enseignpaiements_table_for_users',1),(23,'2025_09_15_160056_fix_enseignant_matiere_classe_table',1),(24,'2025_09_15_235842_add_unique_constraint_to_notes_table',2),(26,'2025_09_23_204852_remove_redundant_columns_from_users_and_enseignants_tables',3),(27,'2025_09_23_205110_fix_enseignant_matiere_classe_user_to_enseignant_id',4),(28,'2025_09_24_120000_fix_evaluations_table_relationships',5),(29,'2025_10_02_152321_update_evaluations_table_structure',6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notes` (
  `id_note` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_matiere` bigint unsigned NOT NULL,
  `note` decimal(5,2) NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_etudiant` bigint unsigned NOT NULL,
  `id_evaluation` bigint unsigned NOT NULL,
  `id_classe` bigint unsigned NOT NULL,
  `commentaire` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_note`),
  UNIQUE KEY `unique_student_evaluation` (`id_etudiant`,`id_evaluation`),
  KEY `notes_id_evaluation_foreign` (`id_evaluation`),
  KEY `notes_id_etudiant_id_evaluation_index` (`id_etudiant`,`id_evaluation`),
  KEY `notes_id_classe_index` (`id_classe`),
  KEY `notes_id_matiere_foreign` (`id_matiere`),
  CONSTRAINT `notes_id_classe_foreign` FOREIGN KEY (`id_classe`) REFERENCES `classes` (`id_classe`),
  CONSTRAINT `notes_id_etudiant_foreign` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiants` (`id_etudiant`),
  CONSTRAINT `notes_id_evaluation_foreign` FOREIGN KEY (`id_evaluation`) REFERENCES `evaluations` (`id_evaluation`),
  CONSTRAINT `notes_id_matiere_foreign` FOREIGN KEY (`id_matiere`) REFERENCES `matieres` (`id_matiere`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notes`
--

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
INSERT INTO `notes` VALUES (1,2,13.00,'devoir',1,1,7,'Quelques lacunes à combler.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(2,2,17.50,'devoir',2,1,7,'Travail satisfaisant, continuez.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(3,2,14.00,'devoir',3,1,7,'Bonne compréhension du sujet.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(4,2,20.00,'examen',1,2,7,'Très belle performance, continuez ainsi.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(5,2,11.50,'examen',2,2,7,'Travail moyen, peut mieux faire.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(6,2,10.00,'examen',3,2,7,'Travail acceptable, à améliorer.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(7,2,12.50,'controle',1,3,7,'Quelques lacunes à combler.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(8,2,14.00,'controle',2,3,7,'Bon travail, bien maîtrisé.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(9,2,11.50,'controle',3,3,7,'Quelques lacunes à combler.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(10,5,4.50,'examen',1,9,7,'Travail insuffisant, il faut réviser.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(11,5,0.00,'examen',2,9,7,'Beaucoup d\'efforts à fournir.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(12,5,10.50,'examen',3,9,7,'Travail acceptable, à améliorer.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(13,5,19.50,'devoir',1,10,7,'Résultat remarquable, parfait.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(14,5,14.50,'devoir',2,10,7,'Bonne compréhension du sujet.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(15,5,17.50,'devoir',3,10,7,'Bon travail, bien maîtrisé.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(16,10,13.50,'controle',1,14,7,'Travail acceptable, à améliorer.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(17,10,11.00,'controle',2,14,7,'Efforts à poursuivre.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(18,10,17.50,'controle',3,14,7,'Bonne compréhension du sujet.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(19,10,17.50,'examen',1,15,7,'Bonne compréhension du sujet.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(20,10,10.00,'examen',2,15,7,'Travail moyen, peut mieux faire.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(21,10,19.00,'examen',3,15,7,'Très belle performance, continuez ainsi.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(22,10,9.00,'devoir',1,16,7,'Difficultés importantes, besoin d\'aide.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(23,10,13.00,'devoir',2,16,7,'Quelques lacunes à combler.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(24,10,4.00,'devoir',3,16,7,'Travail insuffisant, il faut réviser.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(25,10,12.00,'controle',1,17,7,'Efforts à poursuivre.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(26,10,15.00,'controle',2,17,7,'Bien joué, quelques points à améliorer.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(27,10,16.50,'controle',3,17,7,'Bon travail, bien maîtrisé.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(28,10,14.50,'devoir',1,18,7,'Bon travail, bien maîtrisé.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(29,10,10.50,'devoir',2,18,7,'Travail acceptable, à améliorer.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(30,10,11.00,'devoir',3,18,7,'Travail moyen, peut mieux faire.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(31,1,3.50,'examen',4,57,8,'Difficultés importantes, besoin d\'aide.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(32,1,11.50,'examen',5,57,8,'Efforts à poursuivre.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(33,1,13.00,'devoir',4,58,8,'Quelques lacunes à combler.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(34,1,1.00,'devoir',5,58,8,'Travail insuffisant, il faut réviser.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(35,1,8.50,'controle',4,59,8,'Travail insuffisant, il faut réviser.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(36,1,16.00,'controle',5,59,8,'Travail satisfaisant, continuez.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(37,2,17.00,'devoir',4,62,8,'Travail satisfaisant, continuez.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(38,2,11.00,'devoir',5,62,8,'Travail moyen, peut mieux faire.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(39,2,16.00,'controle',4,63,8,'Travail satisfaisant, continuez.','2025-10-02 14:32:47','2025-10-07 12:10:39'),(40,2,5.50,'controle',5,63,8,'Beaucoup d\'efforts à fournir.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(41,2,6.50,'examen',4,64,8,'Beaucoup d\'efforts à fournir.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(42,2,17.00,'examen',5,64,8,'Travail satisfaisant, continuez.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(43,2,4.50,'devoir',4,65,8,'Difficultés importantes, besoin d\'aide.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(44,2,9.00,'devoir',5,65,8,'Travail insuffisant, il faut réviser.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(45,2,15.50,'devoir',4,66,8,'Bon travail, bien maîtrisé.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(46,2,14.50,'devoir',5,66,8,'Travail satisfaisant, continuez.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(47,4,12.50,'examen',4,70,8,'Travail acceptable, à améliorer.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(48,4,5.50,'examen',5,70,8,'Beaucoup d\'efforts à fournir.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(49,4,9.50,'devoir',4,71,8,'Difficultés importantes, besoin d\'aide.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(50,4,17.50,'devoir',5,71,8,'Bonne compréhension du sujet.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(51,4,9.50,'devoir',4,72,8,'Difficultés importantes, besoin d\'aide.','2025-10-02 14:32:47','2025-10-07 12:10:20'),(52,4,10.50,'devoir',5,72,8,'Travail moyen, peut mieux faire.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(53,4,1.50,'controle',4,73,8,'Beaucoup d\'efforts à fournir.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(54,4,12.50,'controle',5,73,8,'Travail moyen, peut mieux faire.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(55,4,15.00,'devoir',4,74,8,'Bon travail, bien maîtrisé.','2025-10-02 14:32:47','2025-10-02 14:32:47'),(56,4,19.50,'devoir',5,74,8,'Excellent travail ! Félicitations.','2025-10-02 14:32:47','2025-10-02 14:32:47');
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','enseignant') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `telephone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Mohamed Directeur Principal','Mohamed','Directeur Principal','admin@ecole.com','admin',NULL,1,'2025-09-15 21:08:04','$2y$10$B4xpIrf3a1oMJO27g3iaQeDZa4v1tbifa4WyiQ/bi6KrmYB.AA1tG','iAaB7pap4HJBvH3kzz90PuHwrmzIPDVq4hyixrVo0WT36iUghMobnkSXeg9T','2025-09-15 21:08:04','2025-09-15 21:08:04'),(2,'Fatima Secrétaire Générale','Fatima','Secrétaire Générale','secretaire@ecole.com','admin',NULL,1,'2025-09-15 21:08:04','$2y$10$l0JEIxCOE.egdMWVQQw5seo8SWflHwgkY0l5ryr7TlYKGRNceFDDm',NULL,'2025-09-15 21:08:04','2025-09-15 21:08:04'),(3,'Ahmed Comptable','Ahmed','Comptable','comptable@ecole.com','admin',NULL,1,'2025-09-15 21:08:04','$2y$10$EbzilHH9orHmiZ3xkVzZ2eAhQiLNS0bL0pVPeaSEYjZQOafAZeczG',NULL,'2025-09-15 21:08:04','2025-09-15 21:08:04'),(4,'Sidi Mohamed El Moctar','Sidi Mohamed','El Moctar','elmoctar@ecole.com','enseignant','+222 20 11 22 33',1,'2025-09-15 21:08:04','$2y$10$n5pv49q9Gg3FyiPP8u68m.vBbLNOCnkkV/sGpdT8qD7JSDINl33MS','Q8MTJ214P0JVjMgDbYCcIstYeRSDQc0b12NbtsrVhPWP41nRE2oohaGpCvuN','2025-09-15 21:08:04','2025-09-21 13:41:13'),(5,'Aminetou Mint Mohamedou','Aminetou','Mint Mohamedou','aminetou@ecole.com','enseignant','+222 20 11 22 34',1,'2025-09-15 21:08:04','$2y$10$G6cM8WETPBlUAejjss2eAu3TYqFO2L6p4WaT1biuduHizZFvRAke.',NULL,'2025-09-15 21:08:04','2025-09-15 21:08:04'),(6,'Oumar Ould Baba','Oumar','Ould Baba','oumar@ecole.com','enseignant','+222 20 11 22 35',1,'2025-09-15 21:08:04','$2y$10$wLWYTjOsHgBtPvNFX3uK3eq60.Z8pZnaA7fhI7nKQXQNF6Wy3HkuG',NULL,'2025-09-15 21:08:04','2025-09-15 21:08:04'),(7,'Khadija Mint Ahmed','Khadija','Mint Ahmed','khadija@ecole.com','enseignant','+222 20 11 22 36',1,'2025-09-15 21:08:04','$2y$10$rct3clfLBtOeXWyyP3wjteiNHZrzW3g1rq0HaorwhESbcQ7gLai5S',NULL,'2025-09-15 21:08:04','2025-09-15 21:08:04'),(8,'Mohamed Lemine Ould Sid Ahmed','Mohamed Lemine','Ould Sid Ahmed','lemine@ecole.com','enseignant','+222 20 11 22 37',1,'2025-09-15 21:08:05','$2y$10$rKYDdDFOJRamFSl0KbTaI.ns/Zjdlv.nTOLXGUgtTinCJYlbp6DSO',NULL,'2025-09-15 21:08:05','2025-09-15 21:08:05');
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

-- Dump completed on 2025-10-10  0:35:50
