-- MySQL dump 10.13  Distrib 9.1.0, for Win64 (x86_64)
--
-- Host: localhost    Database: jamin_magazijn
-- ------------------------------------------------------
-- Server version	9.1.0

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
-- Table structure for table `allergeen`
--

DROP TABLE IF EXISTS `allergeen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `allergeen` (
  `Id` tinyint unsigned NOT NULL AUTO_INCREMENT,
  `Naam` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Omschrijving` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IsActief` bit(1) NOT NULL DEFAULT b'1',
  `Opmerkingen` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DatumAangemaakt` datetime(6) NOT NULL,
  `DatumGewijzigd` datetime(6) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `allergeen`
--

LOCK TABLES `allergeen` WRITE;
/*!40000 ALTER TABLE `allergeen` DISABLE KEYS */;
INSERT INTO `allergeen` VALUES (1,'Gluten','Dit product bevat gluten',_binary '',NULL,'2026-09-25 15:30:20.370578','2026-09-25 15:30:20.370581'),(2,'Gelatine','Dit product bevat gelatine',_binary '',NULL,'2026-09-25 15:30:20.370644','2026-09-25 15:30:20.370645'),(3,'AZO-Kleurstof','Dit product bevat AZO-kleurstoffen',_binary '',NULL,'2026-09-25 15:30:20.370663','2026-09-25 15:30:20.370664'),(4,'Lactose','Dit product bevat lactose',_binary '',NULL,'2026-09-25 15:30:20.370670','2026-09-25 15:30:20.370670'),(5,'Soja','Dit product bevat soja',_binary '',NULL,'2026-09-25 15:30:20.370674','2026-09-25 15:30:20.370675');
/*!40000 ALTER TABLE `allergeen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
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
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leverancier`
--

DROP TABLE IF EXISTS `leverancier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `leverancier` (
  `Id` tinyint unsigned NOT NULL AUTO_INCREMENT,
  `Naam` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ContactPersoon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LeverancierNummer` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Mobiel` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IsActief` bit(1) NOT NULL DEFAULT b'1',
  `Opmerkingen` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DatumAangemaakt` datetime(6) NOT NULL,
  `DatumGewijzigd` datetime(6) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `UQ_Leverancier_LeverancierNummer` (`LeverancierNummer`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leverancier`
--

LOCK TABLES `leverancier` WRITE;
/*!40000 ALTER TABLE `leverancier` DISABLE KEYS */;
INSERT INTO `leverancier` VALUES (1,'Venco','Bert van Linge','L1029384719','06-28493827',_binary '',NULL,'2026-09-25 15:30:20.404933','2026-09-25 15:30:20.404946'),(2,'Astra Sweets','Jasper del Monte','L1029284315','06-39398734',_binary '',NULL,'2026-09-25 15:30:20.405196','2026-09-25 15:30:20.405197'),(3,'Haribo','Sven Stalman','L1029324748','06-24383291',_binary '',NULL,'2026-09-25 15:30:20.405236','2026-09-25 15:30:20.405237'),(4,'Basset','Joyce Stelterberg','L1023845773','06-48293823',_binary '',NULL,'2026-09-25 15:30:20.405251','2026-09-25 15:30:20.405252'),(5,'De Bron','Remco Veenstra','L1023857736','06-34291234',_binary '',NULL,'2026-09-25 15:30:20.405260','2026-09-25 15:30:20.405260');
/*!40000 ALTER TABLE `leverancier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `magazijn`
--

DROP TABLE IF EXISTS `magazijn`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `magazijn` (
  `Id` tinyint unsigned NOT NULL AUTO_INCREMENT,
  `ProductId` tinyint unsigned NOT NULL,
  `VerpakkingsEenheid` decimal(5,2) unsigned NOT NULL,
  `AantalAanwezig` smallint unsigned DEFAULT NULL,
  `IsActief` bit(1) NOT NULL DEFAULT b'1',
  `Opmerkingen` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DatumAangemaakt` datetime(6) NOT NULL,
  `DatumGewijzigd` datetime(6) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_Magazijn_ProductId_Product_Id` (`ProductId`),
  CONSTRAINT `FK_Magazijn_ProductId_Product_Id` FOREIGN KEY (`ProductId`) REFERENCES `product` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magazijn`
--

LOCK TABLES `magazijn` WRITE;
/*!40000 ALTER TABLE `magazijn` DISABLE KEYS */;
INSERT INTO `magazijn` VALUES (1,1,5.00,453,_binary '',NULL,'2026-09-25 15:30:20.439664','2026-09-25 15:30:20.439667'),(2,2,2.50,400,_binary '',NULL,'2026-09-25 15:30:20.439773','2026-09-25 15:30:20.439774'),(3,3,5.00,1,_binary '',NULL,'2026-09-25 15:30:20.439817','2026-09-25 15:30:20.439819'),(4,4,1.00,800,_binary '',NULL,'2026-09-25 15:30:20.439848','2026-09-25 15:30:20.439848'),(5,5,3.00,234,_binary '',NULL,'2026-09-25 15:30:20.439856','2026-09-25 15:30:20.439856'),(6,6,2.00,345,_binary '',NULL,'2026-09-25 15:30:20.439862','2026-09-25 15:30:20.439862'),(7,7,1.00,795,_binary '',NULL,'2026-09-25 15:30:20.439867','2026-09-25 15:30:20.439868'),(8,8,10.00,233,_binary '',NULL,'2026-09-25 15:30:20.439874','2026-09-25 15:30:20.439874'),(9,9,2.50,123,_binary '',NULL,'2026-09-25 15:30:20.439880','2026-09-25 15:30:20.439881'),(10,10,3.00,NULL,_binary '',NULL,'2026-09-25 15:30:20.439886','2026-09-25 15:30:20.439887'),(11,11,2.00,367,_binary '',NULL,'2026-09-25 15:30:20.439892','2026-09-25 15:30:20.439892'),(12,12,1.00,467,_binary '',NULL,'2026-09-25 15:30:20.439900','2026-09-25 15:30:20.439901'),(13,13,5.00,20,_binary '',NULL,'2026-09-25 15:30:20.439915','2026-09-25 15:30:20.439915');
/*!40000 ALTER TABLE `magazijn` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_09_25_132913_add_rolename_to_users_table',1),(5,'2026_09_25_133008_import_database_jamin',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `Id` tinyint unsigned NOT NULL AUTO_INCREMENT,
  `Naam` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Barcode` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IsActief` bit(1) NOT NULL DEFAULT b'1',
  `Opmerkingen` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DatumAangemaakt` datetime(6) NOT NULL,
  `DatumGewijzigd` datetime(6) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `UQ_Product_Barcode` (`Barcode`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Mintnopjes','8719587231278',_binary '',NULL,'2026-09-25 15:30:20.352892','2026-09-25 15:30:20.352895'),(2,'Schoolkrijt','8719587326713',_binary '',NULL,'2026-09-25 15:30:20.352963','2026-09-25 15:30:20.352964'),(3,'Honingdrop','8719587327836',_binary '',NULL,'2026-09-25 15:30:20.352987','2026-09-25 15:30:20.352988'),(4,'Zure Beren','8719587321441',_binary '',NULL,'2026-09-25 15:30:20.352996','2026-09-25 15:30:20.352996'),(5,'Cola Flesjes','8719587321237',_binary '',NULL,'2026-09-25 15:30:20.353003','2026-09-25 15:30:20.353003'),(6,'Turtles','8719587322245',_binary '',NULL,'2026-09-25 15:30:20.353017','2026-09-25 15:30:20.353017'),(7,'Witte Muizen','8719587328256',_binary '',NULL,'2026-09-25 15:30:20.353024','2026-09-25 15:30:20.353025'),(8,'Reuzen Slangen','8719587325641',_binary '',NULL,'2026-09-25 15:30:20.353032','2026-09-25 15:30:20.353033'),(9,'Zoute Rijen','8719587322739',_binary '',NULL,'2026-09-25 15:30:20.353040','2026-09-25 15:30:20.353040'),(10,'Winegums','8719587327527',_binary '',NULL,'2026-09-25 15:30:20.353047','2026-09-25 15:30:20.353047'),(11,'Drop Munten','8719587322345',_binary '',NULL,'2026-09-25 15:30:20.353055','2026-09-25 15:30:20.353056'),(12,'Kruis Drop','8719587322265',_binary '',NULL,'2026-09-25 15:30:20.353063','2026-09-25 15:30:20.353063'),(13,'Zoute Ruitjes','8719587323256',_binary '',NULL,'2026-09-25 15:30:20.353069','2026-09-25 15:30:20.353070');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productperallergeen`
--

DROP TABLE IF EXISTS `productperallergeen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productperallergeen` (
  `Id` tinyint unsigned NOT NULL AUTO_INCREMENT,
  `ProductId` tinyint unsigned NOT NULL,
  `AllergeenId` tinyint unsigned NOT NULL,
  `IsActief` bit(1) NOT NULL DEFAULT b'1',
  `Opmerkingen` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DatumAangemaakt` datetime(6) NOT NULL,
  `DatumGewijzigd` datetime(6) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_ProductPerAllergeen_ProductId_Product_Id` (`ProductId`),
  KEY `FK_ProductPerAllergeen_AllergeenId_Allergeen_Id` (`AllergeenId`),
  CONSTRAINT `FK_ProductPerAllergeen_AllergeenId_Allergeen_Id` FOREIGN KEY (`AllergeenId`) REFERENCES `allergeen` (`Id`),
  CONSTRAINT `FK_ProductPerAllergeen_ProductId_Product_Id` FOREIGN KEY (`ProductId`) REFERENCES `product` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productperallergeen`
--

LOCK TABLES `productperallergeen` WRITE;
/*!40000 ALTER TABLE `productperallergeen` DISABLE KEYS */;
INSERT INTO `productperallergeen` VALUES (1,1,2,_binary '',NULL,'2026-09-25 15:30:20.470206','2026-09-25 15:30:20.470209'),(2,1,1,_binary '',NULL,'2026-09-25 15:30:20.470282','2026-09-25 15:30:20.470283'),(3,1,3,_binary '',NULL,'2026-09-25 15:30:20.470314','2026-09-25 15:30:20.470315'),(4,3,4,_binary '',NULL,'2026-09-25 15:30:20.470322','2026-09-25 15:30:20.470322'),(5,6,5,_binary '',NULL,'2026-09-25 15:30:20.470329','2026-09-25 15:30:20.470329'),(6,9,2,_binary '',NULL,'2026-09-25 15:30:20.470335','2026-09-25 15:30:20.470335'),(7,9,5,_binary '',NULL,'2026-09-25 15:30:20.470344','2026-09-25 15:30:20.470344'),(8,10,2,_binary '',NULL,'2026-09-25 15:30:20.470350','2026-09-25 15:30:20.470350'),(9,12,4,_binary '',NULL,'2026-09-25 15:30:20.470357','2026-09-25 15:30:20.470357'),(10,13,1,_binary '',NULL,'2026-09-25 15:30:20.470364','2026-09-25 15:30:20.470364'),(11,13,4,_binary '',NULL,'2026-09-25 15:30:20.470370','2026-09-25 15:30:20.470371'),(12,13,5,_binary '',NULL,'2026-09-25 15:30:20.470377','2026-09-25 15:30:20.470377');
/*!40000 ALTER TABLE `productperallergeen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productperleverancier`
--

DROP TABLE IF EXISTS `productperleverancier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productperleverancier` (
  `Id` tinyint unsigned NOT NULL AUTO_INCREMENT,
  `LeverancierId` tinyint unsigned NOT NULL,
  `ProductId` tinyint unsigned NOT NULL,
  `DatumLevering` date NOT NULL,
  `Aantal` smallint unsigned NOT NULL,
  `DatumEerstVolgendeLevering` date DEFAULT NULL,
  `IsActief` bit(1) NOT NULL DEFAULT b'1',
  `Opmerkingen` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DatumAangemaakt` datetime(6) NOT NULL,
  `DatumGewijzigd` datetime(6) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_ProductPerLeverancier_LeverancierId_Leverancier_Id` (`LeverancierId`),
  KEY `FK_ProductPerLeverancier_ProductId_Product_Id` (`ProductId`),
  CONSTRAINT `FK_ProductPerLeverancier_LeverancierId_Leverancier_Id` FOREIGN KEY (`LeverancierId`) REFERENCES `leverancier` (`Id`),
  CONSTRAINT `FK_ProductPerLeverancier_ProductId_Product_Id` FOREIGN KEY (`ProductId`) REFERENCES `product` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productperleverancier`
--

LOCK TABLES `productperleverancier` WRITE;
/*!40000 ALTER TABLE `productperleverancier` DISABLE KEYS */;
INSERT INTO `productperleverancier` VALUES (1,1,1,'2024-10-09',23,'2024-10-16',_binary '',NULL,'2026-09-25 15:30:20.499795','2026-09-25 15:30:20.499797'),(2,1,1,'2024-10-18',21,'2024-10-25',_binary '',NULL,'2026-09-25 15:30:20.499877','2026-09-25 15:30:20.499878'),(3,1,2,'2024-10-09',12,'2024-10-16',_binary '',NULL,'2026-09-25 15:30:20.499900','2026-09-25 15:30:20.499901'),(4,1,3,'2024-10-10',11,'2024-10-17',_binary '',NULL,'2026-09-25 15:30:20.499909','2026-09-25 15:30:20.499909'),(5,2,4,'2024-10-14',16,'2024-10-21',_binary '',NULL,'2026-09-25 15:30:20.499916','2026-09-25 15:30:20.499916'),(6,2,4,'2024-10-21',23,'2024-10-28',_binary '',NULL,'2026-09-25 15:30:20.499923','2026-09-25 15:30:20.499923'),(7,2,5,'2024-10-14',45,'2024-10-21',_binary '',NULL,'2026-09-25 15:30:20.499930','2026-09-25 15:30:20.499930'),(8,2,6,'2024-10-14',30,'2024-10-21',_binary '',NULL,'2026-09-25 15:30:20.499937','2026-09-25 15:30:20.499937'),(9,3,7,'2024-10-12',12,'2024-10-19',_binary '',NULL,'2026-09-25 15:30:20.499945','2026-09-25 15:30:20.499945'),(10,3,7,'2024-10-19',23,'2024-10-26',_binary '',NULL,'2026-09-25 15:30:20.499952','2026-09-25 15:30:20.499952'),(11,3,8,'2024-10-10',12,'2024-10-17',_binary '',NULL,'2026-09-25 15:30:20.499959','2026-09-25 15:30:20.499959'),(12,3,9,'2024-10-11',1,'2024-10-18',_binary '',NULL,'2026-09-25 15:30:20.499966','2026-09-25 15:30:20.499966'),(13,4,10,'2023-04-16',24,'2023-04-30',_binary '',NULL,'2026-09-25 15:30:20.499973','2026-09-25 15:30:20.499973'),(14,5,11,'2024-10-10',47,'2024-10-17',_binary '',NULL,'2026-09-25 15:30:20.499980','2026-09-25 15:30:20.499980'),(15,5,11,'2024-10-19',60,'2024-10-26',_binary '',NULL,'2026-09-25 15:30:20.499987','2026-09-25 15:30:20.499987'),(16,5,12,'2024-10-11',45,NULL,_binary '',NULL,'2026-09-25 15:30:20.499994','2026-09-25 15:30:20.499994'),(17,5,13,'2024-10-12',23,NULL,_binary '',NULL,'2026-09-25 15:30:20.500001','2026-09-25 15:30:20.500001');
/*!40000 ALTER TABLE `productperleverancier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rolename` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Magazijnmedewerker',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Test User','test@example.com','2026-09-25 11:37:05','$2y$12$GIxtmRGpi3QanPIcTwoY4uO59XdbYbD3X3uQlL8xW2t2pIti8R2aa','Magazijnmedewerker','8olxKHamcx','2026-09-25 11:37:06','2026-09-25 11:37:06'),(2,'Magazijnmedewerker','magazijn@jamin.nl','2026-09-25 11:37:06','$2y$12$GIxtmRGpi3QanPIcTwoY4uO59XdbYbD3X3uQlL8xW2t2pIti8R2aa','Magazijnmedewerker','IJBKBL2fxR','2026-09-25 11:37:06','2026-09-25 11:37:06');
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

-- Dump completed on 2026-09-25 16:06:35
