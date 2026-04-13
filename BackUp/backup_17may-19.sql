CREATE DATABASE  IF NOT EXISTS `control_laboratorios_utec` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `control_laboratorios_utec`;
-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: control_laboratorios_utec
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.27-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `accesos`
--

DROP TABLE IF EXISTS `accesos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `accesos` (
  `idacceso` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_ingreso` datetime NOT NULL,
  `fecha_cierresesion` datetime DEFAULT NULL,
  `idusuarios` int(11) NOT NULL,
  PRIMARY KEY (`idacceso`),
  KEY `fk_acceso-usuarios` (`idusuarios`),
  CONSTRAINT `fk_acceso-usuarios` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`)
) ENGINE=InnoDB AUTO_INCREMENT=256 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accesos`
--

LOCK TABLES `accesos` WRITE;
/*!40000 ALTER TABLE `accesos` DISABLE KEYS */;
INSERT INTO `accesos` VALUES (23,'2023-03-01 18:40:56',NULL,1),(24,'2023-03-02 14:28:10',NULL,1),(25,'2023-03-02 19:06:32',NULL,1),(26,'2023-03-02 19:19:56',NULL,1),(27,'2023-03-03 00:47:39',NULL,1),(28,'2023-03-03 01:14:05',NULL,1),(29,'2023-03-03 14:43:41',NULL,1),(30,'2023-03-03 17:39:09',NULL,1),(31,'2023-03-03 17:55:53',NULL,1),(32,'2023-03-03 19:05:49',NULL,1),(33,'2023-03-05 22:19:24','2023-03-05 22:57:44',1),(34,'2023-03-05 23:04:15',NULL,1),(35,'2023-03-05 23:05:20','2023-03-05 23:06:34',1),(36,'2023-03-05 23:15:37',NULL,1),(38,'2023-03-05 23:20:56','2023-03-05 23:22:05',1),(39,'2023-03-05 23:22:15','2023-03-05 23:54:28',1),(40,'2023-03-05 23:54:32','2023-03-06 00:17:34',1),(41,'2023-03-06 14:40:02','2023-03-06 19:12:47',1),(42,'2023-03-07 14:45:21',NULL,1),(43,'2023-03-08 14:35:54','2023-03-08 14:49:35',1),(44,'2023-03-08 14:50:29','2023-03-08 15:28:21',9),(45,'2023-03-08 15:28:26',NULL,1),(46,'2023-03-08 16:31:21',NULL,9),(47,'2023-03-09 14:50:01','2023-03-09 14:51:20',1),(48,'2023-03-09 14:51:25','2023-03-09 18:19:54',1),(49,'2023-03-09 15:17:43',NULL,9),(50,'2023-03-09 16:08:45',NULL,9),(51,'2023-03-09 17:57:42',NULL,9),(52,'2023-03-09 18:19:58','2023-03-09 19:25:09',1),(53,'2023-03-10 00:16:33','2023-03-10 00:19:20',1),(54,'2023-03-10 00:22:32','2023-03-10 00:24:29',9),(55,'2023-03-10 14:41:20',NULL,1),(56,'2023-03-10 17:05:39',NULL,1),(57,'2023-03-10 23:39:03','2023-03-10 23:55:49',1),(58,'2023-03-10 23:55:55','2023-03-11 00:21:22',1),(59,'2023-03-12 18:53:13','2023-03-12 18:54:15',1),(60,'2023-03-13 14:09:26',NULL,1),(61,'2023-03-14 14:45:19',NULL,1),(62,'2023-03-14 18:43:34','2023-03-14 19:23:30',1),(63,'2023-03-15 14:12:55','2023-03-15 19:06:14',1),(64,'2023-03-15 19:08:31','2023-03-15 19:20:56',1),(65,'2023-03-16 14:20:11','2023-03-16 15:52:58',1),(66,'2023-03-16 16:06:11','2023-03-16 18:54:54',1),(67,'2023-03-17 17:27:00','2023-03-17 18:59:50',1),(68,'2023-03-17 23:29:55','2023-03-18 00:27:19',1),(69,'2023-03-20 15:06:31','2023-03-20 18:01:38',1),(70,'2023-03-20 18:05:16','2023-03-20 19:32:41',1),(71,'2023-03-21 14:31:50',NULL,1),(72,'2023-03-21 15:55:19','2023-03-21 19:11:30',1),(73,'2023-03-21 23:16:31','2023-03-21 23:18:54',1),(74,'2023-03-22 14:58:48',NULL,1),(75,'2023-03-23 13:57:07',NULL,1),(76,'2023-03-23 15:52:42','2023-03-23 15:58:51',4),(77,'2023-03-23 15:58:57','2023-03-23 15:59:11',1),(78,'2023-03-23 15:59:15',NULL,1),(79,'2023-03-23 16:00:03',NULL,1),(80,'2023-03-23 16:00:53',NULL,1),(81,'2023-03-23 16:01:10','2023-03-23 16:03:00',1),(82,'2023-03-23 16:03:04',NULL,1),(83,'2023-03-23 16:03:33','2023-03-23 16:04:57',1),(84,'2023-03-23 16:30:12',NULL,1),(85,'2023-03-23 16:30:46','2023-03-23 19:33:22',1),(86,'2023-03-23 23:06:04',NULL,1),(87,'2023-03-24 00:10:20','2023-03-24 00:33:48',1),(88,'2023-03-24 00:38:39',NULL,18),(89,'2023-03-24 00:39:15','2023-03-24 00:40:50',18),(90,'2023-03-24 13:18:01','2023-03-24 13:23:46',1),(91,'2023-03-24 13:19:11','2023-03-24 13:19:22',4),(92,'2023-03-24 13:19:44','2023-03-24 13:22:54',4),(93,'2023-03-24 13:45:49','2023-03-24 18:57:28',1),(94,'2023-03-24 14:06:04',NULL,18),(95,'2023-03-24 23:51:04',NULL,1),(96,'2023-03-24 23:51:24','2023-03-25 01:31:09',1),(97,'2023-03-25 14:16:47','2023-03-25 14:18:52',1),(98,'2023-03-25 14:21:06','2023-03-25 14:35:06',1),(99,'2023-03-25 14:35:15',NULL,1),(100,'2023-03-25 15:08:33','2023-03-25 19:22:35',1),(101,'2023-03-25 22:14:50','2023-03-26 00:33:14',1),(102,'2023-03-26 00:41:48','2023-03-26 00:42:01',1),(103,'2023-03-26 00:48:03','2023-03-26 00:48:34',1),(104,'2023-03-26 13:41:15','2023-03-26 15:49:35',1),(105,'2023-03-26 18:21:26',NULL,1),(106,'2023-03-27 16:05:09','2023-03-27 19:04:50',1),(107,'2023-03-28 15:22:32','2023-03-28 15:27:02',1),(108,'2023-03-28 15:30:39','2023-03-28 16:07:29',1),(109,'2023-03-28 17:08:32','2023-03-28 17:32:51',1),(110,'2023-03-28 17:34:36','2023-03-28 17:37:57',1),(111,'2023-03-28 17:42:48','2023-03-28 17:46:50',1),(112,'2023-03-28 17:54:38','2023-03-28 18:00:34',1),(113,'2023-03-28 18:02:53',NULL,1),(114,'2023-03-29 00:34:16','2023-03-29 00:45:39',1),(115,'2023-03-29 14:06:42','2023-03-29 16:07:13',1),(116,'2023-03-30 13:36:37',NULL,1),(117,'2023-03-30 16:08:05',NULL,1),(118,'2023-03-30 16:24:59','2023-03-30 16:26:13',1),(119,'2023-03-30 16:28:17',NULL,1),(120,'2023-03-30 16:36:54','2023-03-30 16:37:22',1),(121,'2023-03-30 16:37:32','2023-03-30 19:02:11',1),(122,'2023-03-30 19:03:18','2023-03-30 19:07:04',1),(123,'2023-03-31 13:32:49','2023-03-31 18:12:54',1),(124,'2023-03-31 18:15:46',NULL,18),(125,'2023-03-31 18:18:59','2023-03-31 18:55:04',1),(126,'2023-04-02 14:43:10','2023-04-02 19:40:40',1),(127,'2023-04-02 20:40:09',NULL,1),(128,'2023-04-02 23:41:57','2023-04-03 01:19:33',1),(129,'2023-04-03 14:07:42',NULL,1),(130,'2023-04-03 15:12:51',NULL,1),(131,'2023-04-03 17:43:16','2023-04-03 19:08:44',1),(132,'2023-04-03 23:24:38','2023-04-04 00:43:03',1),(133,'2023-04-04 00:43:08',NULL,1),(134,'2023-04-09 14:27:27','2023-04-09 18:00:12',1),(135,'2023-04-09 18:00:17',NULL,1),(136,'2023-04-10 14:20:50','2023-04-10 17:36:34',1),(137,'2023-04-11 14:34:25','2023-04-11 19:16:44',1),(138,'2023-04-12 14:33:56','2023-04-12 18:38:13',1),(139,'2023-04-13 14:33:56','2023-04-13 19:20:32',1),(140,'2023-04-13 17:24:01','2023-04-13 17:25:00',11),(141,'2023-04-14 14:27:56','2023-04-14 19:04:31',1),(142,'2023-04-14 22:45:54','2023-04-14 23:40:53',1),(143,'2023-04-14 23:11:36',NULL,3),(144,'2023-04-14 23:12:06','2023-04-14 23:35:20',2),(145,'2023-04-14 23:44:35',NULL,3),(146,'2023-04-14 23:51:46','2023-04-15 00:09:44',1),(147,'2023-04-16 00:25:34','2023-04-16 00:36:19',1),(148,'2023-04-16 13:50:58','2023-04-16 19:28:30',1),(149,'2023-04-17 14:39:39','2023-04-17 18:46:10',1),(150,'2023-04-18 14:08:40',NULL,1),(151,'2023-04-18 23:04:45','2023-04-18 23:26:07',1),(152,'2023-04-18 23:26:41','2023-04-19 00:19:47',1),(153,'2023-04-18 23:39:07','2023-04-19 00:02:14',2),(154,'2023-04-19 14:06:20','2023-04-19 19:17:01',1),(155,'2023-04-19 19:17:15','2023-04-19 19:17:38',1),(156,'2023-04-19 19:17:48','2023-04-19 19:18:57',1),(157,'2023-04-20 14:31:45','2023-04-20 19:34:11',1),(158,'2023-04-21 17:47:07','2023-04-21 19:14:31',1),(159,'2023-04-21 22:56:05','2023-04-21 23:30:08',1),(160,'2023-04-21 23:44:05','2023-04-22 00:46:45',1),(161,'2023-04-23 15:33:27',NULL,1),(162,'2023-04-24 14:40:53','2023-04-24 19:29:41',1),(163,'2023-04-24 23:12:23',NULL,1),(164,'2023-04-25 23:38:14',NULL,1),(165,'2023-04-25 23:38:24',NULL,1),(166,'2023-04-25 23:38:41','2023-04-25 23:39:20',1),(167,'2023-04-25 23:39:25',NULL,1),(168,'2023-04-25 23:39:59',NULL,1),(169,'2023-04-25 23:40:22','2023-04-25 23:42:48',1),(170,'2023-04-25 23:42:54',NULL,1),(171,'2023-04-25 23:43:08','2023-04-25 23:46:05',1),(172,'2023-04-25 23:48:37',NULL,1),(173,'2023-04-25 23:48:49','2023-04-25 23:49:33',1),(174,'2023-04-25 23:49:38',NULL,1),(175,'2023-04-25 23:49:50','2023-04-25 23:50:05',1),(176,'2023-04-25 23:52:15',NULL,1),(177,'2023-04-25 23:52:55',NULL,1),(178,'2023-04-25 23:53:21',NULL,1),(179,'2023-04-25 23:56:16',NULL,1),(180,'2023-04-25 23:56:29','2023-04-26 00:00:11',1),(181,'2023-04-26 13:46:34','2023-04-26 19:45:56',1),(182,'2023-04-26 23:21:33',NULL,1),(183,'2023-04-27 12:56:11',NULL,1),(184,'2023-04-27 14:51:00',NULL,1),(185,'2023-04-27 18:50:14',NULL,1),(186,'2023-04-27 22:37:50',NULL,1),(187,'2023-04-28 16:58:31',NULL,1),(188,'2023-04-28 19:24:27',NULL,1),(189,'2023-04-29 14:24:11',NULL,1),(190,'2023-04-29 18:32:22','2023-04-29 20:01:25',1),(191,'2023-04-30 00:41:50',NULL,1),(192,'2023-04-30 00:48:44',NULL,1),(193,'2023-05-01 00:09:29',NULL,1),(194,'2023-05-01 13:08:59','2023-05-01 19:17:43',1),(195,'2023-05-02 13:53:41',NULL,1),(196,'2023-05-02 15:27:53',NULL,1),(197,'2023-05-02 17:34:02','2023-05-02 19:23:12',1),(198,'2023-05-03 14:32:15',NULL,1),(199,'2023-05-03 16:12:17','2023-05-03 18:52:37',1),(200,'2023-05-04 14:15:03',NULL,1),(201,'2023-05-04 17:34:54',NULL,1),(202,'2023-05-05 13:45:19','2023-05-05 18:29:17',1),(203,'2023-05-07 16:11:42','2023-05-07 17:53:39',1),(204,'2023-05-08 13:49:35',NULL,1),(205,'2023-05-08 17:38:01','2023-05-08 18:57:42',1),(206,'2023-05-09 14:46:23','2023-05-09 19:13:10',1),(207,'2023-05-11 14:15:05','2023-05-11 18:59:28',1),(208,'2023-05-11 18:59:36','2023-05-11 19:12:59',1),(209,'2023-05-12 14:21:01','2023-05-12 16:49:08',1),(210,'2023-05-12 16:49:12',NULL,1),(211,'2023-05-12 16:49:53','2023-05-12 16:50:02',1),(212,'2023-05-12 17:04:30','2023-05-12 17:04:37',1),(213,'2023-05-12 17:04:59',NULL,1),(214,'2023-05-12 18:18:26','2023-05-12 18:18:30',1),(215,'2023-05-12 18:18:48',NULL,1),(216,'2023-05-12 18:20:17',NULL,1),(217,'2023-05-12 18:21:26',NULL,1),(218,'2023-05-12 18:23:23',NULL,1),(219,'2023-05-12 18:26:32','2023-05-12 18:32:51',1),(220,'2023-05-12 18:32:55',NULL,1),(221,'2023-05-14 13:55:00','2023-05-14 15:14:30',1),(222,'2023-05-14 15:14:39',NULL,1),(223,'2023-05-14 15:18:01','2023-05-14 15:18:05',1),(224,'2023-05-14 15:19:05',NULL,1),(225,'2023-05-14 16:48:01',NULL,1),(226,'2023-05-14 16:48:48',NULL,1),(227,'2023-05-14 16:49:20',NULL,1),(228,'2023-05-14 16:50:13','2023-05-14 17:18:52',1),(229,'2023-05-14 17:19:00','2023-05-14 17:20:54',1),(230,'2023-05-14 17:21:01','2023-05-14 17:21:37',1),(231,'2023-05-14 17:38:20','2023-05-14 17:41:02',1),(232,'2023-05-14 17:42:41',NULL,1),(233,'2023-05-14 17:43:29','2023-05-14 18:05:42',1),(234,'2023-05-14 18:05:46',NULL,1),(235,'2023-05-14 18:22:41','2023-05-14 18:48:18',1),(236,'2023-05-14 18:48:32','2023-05-14 18:55:35',1),(237,'2023-05-14 18:55:46','2023-05-14 19:04:54',1),(238,'2023-05-15 15:15:25','2023-05-15 15:37:28',1),(239,'2023-05-15 15:37:48','2023-05-15 15:39:13',1),(240,'2023-05-15 15:39:27','2023-05-15 15:47:20',1),(241,'2023-05-15 15:49:29','2023-05-15 16:08:08',1),(242,'2023-05-15 16:08:28','2023-05-15 16:09:50',1),(243,'2023-05-15 16:13:20','2023-05-15 16:14:23',1),(244,'2023-05-15 16:15:03','2023-05-15 16:24:07',1),(245,'2023-05-15 16:37:15','2023-05-15 18:32:53',1),(246,'2023-05-15 18:32:56','2023-05-15 18:34:24',1),(247,'2023-05-15 18:34:36','2023-05-15 18:39:30',1),(248,'2023-05-16 14:04:03','2023-05-16 17:02:28',1),(249,'2023-05-16 17:02:41','2023-05-16 17:04:07',1),(250,'2023-05-16 17:04:17','2023-05-16 18:59:45',1),(251,'2023-05-17 14:26:34','2023-05-17 16:41:17',1),(252,'2023-05-17 16:41:21','2023-05-17 18:39:04',1),(253,'2023-05-17 18:39:08','2023-05-17 18:49:58',1),(254,'2023-05-17 18:50:10','2023-05-17 19:00:57',1),(255,'2023-05-17 19:01:07',NULL,1);
/*!40000 ALTER TABLE `accesos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aplicaciones_laboratorios`
--

DROP TABLE IF EXISTS `aplicaciones_laboratorios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aplicaciones_laboratorios` (
  `idaplicacion` int(11) NOT NULL AUTO_INCREMENT,
  `codigoaplicacion` varchar(100) NOT NULL,
  `nombreaplicacion` varchar(255) NOT NULL,
  `lab1` char(2) NOT NULL,
  `lab2` char(2) NOT NULL,
  `lab3` char(2) NOT NULL,
  `lab4` char(2) NOT NULL,
  `lab5` char(2) NOT NULL,
  `lab6` char(2) NOT NULL,
  `lab7` char(2) NOT NULL,
  `lab8` char(2) NOT NULL,
  `lab9` char(2) NOT NULL,
  `lab10` char(2) NOT NULL,
  `lab11` char(2) NOT NULL,
  `lab12` char(2) NOT NULL,
  `lab13` char(2) NOT NULL,
  `lab14` char(2) NOT NULL,
  `lab15` char(2) NOT NULL,
  `idclasificacionlaboratorio` int(11) NOT NULL,
  `fecharegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idaplicacion`),
  KEY `lab1` (`lab1`),
  KEY `fk_aplicacioneslab_clasificaciones_aplicacioneslab` (`idclasificacionlaboratorio`),
  CONSTRAINT `fk_aplicacioneslab_clasificaciones_aplicacioneslab` FOREIGN KEY (`idclasificacionlaboratorio`) REFERENCES `clasificacion_aplicaciones_laboratorios` (`idclasificacionlaboratorio`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aplicaciones_laboratorios`
--

LOCK TABLES `aplicaciones_laboratorios` WRITE;
/*!40000 ALTER TABLE `aplicaciones_laboratorios` DISABLE KEYS */;
INSERT INTO `aplicaciones_laboratorios` VALUES (1,'W8','Windows 8','si','no','no','no','no','no','no','si','no','no','no','no','no','no','no',1,'2023-03-15 20:27:56'),(2,'W10','Windows 10','no','si','si','no','no','si','si','no','si','si','no','no','no','no','no',1,'2023-03-15 20:34:27'),(3,'W12S','Windows 12 Server','si','si','si','no','no','si','no','si','si','si','no','no','no','no','no',1,'2023-03-15 20:39:47'),(4,'MSOFF2016','Microsoft Office 2016','si','si','si','no','no','si','no','si','si','si','si','no','no','no','si',1,'2023-03-15 20:46:56'),(5,'WS2003','Windows 2003 Server','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',1,'2023-03-15 23:38:58'),(6,'WS2008','Windows 2008 Server','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',1,'2023-03-15 23:39:33'),(7,'Y_MacOs','Yosemite (Mac OS)','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',1,'2023-03-15 23:40:58'),(8,'C_MacOs','Capitan (Mac OS)','no','no','no','no','no','no','no','no','no','no','no','si','no','no','no',1,'2023-03-15 23:41:36'),(9,'M_MacOs','Mojave (Mac OS)','no','no','no','no','no','no','no','no','no','no','no','no','no','si','no',1,'2023-03-15 23:44:28'),(10,'MP2010','Microsoft Project 2010','si','si','no','no','no','si','no','si','no','si','si','no','no','no','no',1,'2023-03-15 23:45:52'),(11,'MV2010','Microsoft Visio 2010','si','si','no','no','no','no','no','si','no','no','si','no','no','no','no',1,'2023-03-15 23:47:22'),(12,'MOFF_MacOs','Microsoft Office para MAC 2016','no','no','no','no','no','no','no','no','no','no','no','si','no','si','no',1,'2023-03-15 23:48:51'),(13,'VS2013','Visual Studio 2013','si','si','si','no','no','si','no','si','no','si','no','no','no','no','no',2,'2023-03-15 23:51:08'),(14,'JLE','Jcreator LE','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',2,'2023-03-15 23:53:33'),(15,'Java1x','Java 1.x.xx','si','si','no','no','no','no','no','si','si','no','no','no','no','no','no',2,'2023-03-15 23:54:28'),(16,'MySQL','MySQL','si','si','si','no','no','no','no','si','no','si','no','no','no','no','no',2,'2023-03-15 23:55:35'),(17,'NetBeans','NetBeans','si','si','si','no','no','si','no','si','si','si','no','si','no','si','no',2,'2023-03-15 23:57:35'),(18,'php','php','no','no','si','no','no','si','no','si','no','si','no','no','no','no','no',2,'2023-03-15 23:59:10'),(19,'MSSQL2014','SQL Server 2014','si','si','si','no','no','si','no','si','si','si','no','no','no','no','no',2,'2023-03-16 00:01:57'),(20,'Apache','Apache','si','si','si','no','no','no','no','si','no','si','no','no','no','no','no',2,'2023-03-16 00:03:39'),(21,'Tomcat','Tomcat','si','si','si','no','no','no','no','si','no','si','no','no','no','no','no',2,'2023-03-16 00:04:37'),(22,'WAMP','WAMP','no','no','no','no','no','no','no','si','no','no','no','no','no','no','no',2,'2023-03-16 00:05:19'),(23,'XAMPP','XAMPP','si','si','si','no','no','no','no','si','no','si','no','si','no','si','no',2,'2023-03-16 00:06:15'),(24,'WP','Windows Phone','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',2,'2023-03-16 00:06:35'),(25,'AS','Android Studio','si','si','si','no','no','si','no','si','si','si','no','no','no','no','no',2,'2023-03-16 00:07:22'),(26,'StarUML','StarUML','no','si','si','no','no','si','no','si','no','si','no','no','no','no','no',2,'2023-03-16 00:09:12'),(27,'MySQL_Workbench','Workbench','no','no','no','no','no','no','no','no','no','si','no','no','no','no','no',2,'2023-03-16 00:10:13'),(28,'VirBox','Virtual Box','si','no','si','no','no','si','no','si','si','si','si','si','no','si','no',3,'2023-03-16 00:11:10'),(29,'VmwareP','Vmware Player','si','si','si','no','no','no','no','si','no','no','no','no','no','no','no',3,'2023-03-16 00:12:25'),(30,'H-V','Hyper-V','no','no','no','no','no','no','no','si','no','no','no','no','no','no','no',3,'2023-03-16 00:12:55'),(31,'ME','Microsoft Edge','si','si','si','no','no','si','si','no','si','si','no','no','no','no','no',4,'2023-03-16 00:13:44'),(32,'MF','Mozilla firefox','si','si','si','no','no','si','no','si','si','si','no','no','no','no','no',4,'2023-03-16 00:15:24'),(33,'GC','Google Chrome','si','si','si','no','no','si','si','si','si','si','si','si','no','si','si',4,'2023-03-16 00:16:12'),(34,'Safari','Safari','no','no','no','no','no','no','no','no','no','no','no','si','no','si','no',4,'2023-03-16 00:17:15'),(35,'Opera','Opera','si','no','no','no','no','no','no','no','no','no','no','no','no','no','no',4,'2023-03-16 00:17:58'),(36,'I-Photo','I-Photo','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',5,'2023-03-16 00:18:26'),(37,'GSketchup','Google Sketchup','no','no','no','no','no','no','no','no','no','no','no','si','no','si','no',5,'2023-03-16 00:19:47'),(38,'ADOSTUCS6','Adobe Studio CS6','no','no','si','no','no','no','no','no','si','no','no','si','no','no','no',5,'2023-03-16 00:24:12'),(39,'ACC2015','Adobe CC 2015','no','no','no','no','no','no','no','no','no','no','no','no','no','si','no',5,'2023-03-16 00:24:51'),(40,'Gimp','Gimp','si','si','no','no','no','no','no','no','si','no','no','no','no','no','no',5,'2023-03-16 00:25:23'),(41,'3DSMAX','3ds Max ','no','no','no','no','no','si','no','no','si','no','no','no','no','no','no',6,'2023-03-16 00:26:24'),(42,'A360 ','A360 ','si','no','no','no','no','si','no','no','si','no','no','no','no','no','no',6,'2023-03-16 00:26:45'),(43,'AutoCAD','AutoCAD','si','no','no','no','no','si','no','no','si','no','no','no','no','no','no',6,'2023-03-16 00:27:44'),(44,'AutoCADElectrical','AutoCAD Electrical','no','no','no','no','no','si','no','no','si','si','no','no','no','no','no',6,'2023-03-16 00:28:32'),(45,'AutoCADMap3D','AutoCAD Map 3D','no','no','no','no','no','no','no','no','si','no','no','no','no','no','no',6,'2023-03-16 00:29:00'),(46,'AutoCAD Plant3D','AutoCAD  Plant 3D','no','no','no','no','no','si','no','no','si','no','no','no','no','no','no',6,'2023-03-16 00:30:12'),(47,'AutoCADUtilityDesign','AutoCAD Utility Design','no','no','no','no','no','si','no','no','si','no','no','no','no','no','no',6,'2023-03-16 00:30:50'),(48,'AutoCADPlant3DSpecEditor','AutoCAD Plant 3D Spec Editor','no','no','no','no','no','si','no','no','si','no','no','no','no','no','no',6,'2023-03-16 00:31:13'),(49,'AutoCADPlantReportCreator','AutoCAD Plant Report Creator','no','no','no','no','no','si','no','no','si','no','no','no','no','no','no',6,'2023-03-16 00:31:34'),(50,'InfraWorks360','InfraWorks 360','no','no','no','no','no','si','no','no','si','no','no','no','no','no','no',6,'2023-03-16 00:32:03'),(51,'Inventor','Inventor','no','no','no','no','no','no','no','no','si','no','no','no','no','no','no',6,'2023-03-16 00:32:26'),(52,'ReCap','ReCap','si','no','no','no','no','no','no','no','si','no','no','no','no','no','no',6,'2023-03-16 00:33:06'),(53,'RobotStructuralAnalysis','Robot Structural Analysis','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',6,'2023-03-16 00:33:57'),(54,'Showcase','Showcase','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',6,'2023-03-16 00:34:09'),(55,'StormSanitaryAnalysis','Storm and Sanitary Analysis','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',6,'2023-03-16 00:34:46'),(56,'Civil3DImperial','Civil 3D Imperial','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',6,'2023-03-16 00:35:11'),(57,'Civil3DMetric','Civil 3D Metric','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',6,'2023-03-16 00:35:28'),(58,'DWGTrueView','DWG TrueView','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',6,'2023-03-16 00:35:53'),(59,'IMDataEditor','IM Data Editor','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',6,'2023-03-16 00:36:12'),(60,'Maya','Maya','no','no','no','no','no','no','no','no','si','no','no','si','no','si','no',6,'2023-03-16 00:36:44'),(61,'MotionBuilder','MotionBuilder','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',6,'2023-03-16 00:37:01'),(62,'Mudbox','Mudbox','no','no','no','no','no','no','no','no','si','no','no','si','no','si','no',6,'2023-03-16 00:37:18'),(63,'NavisworksManage','Navisworks Manage','no','no','no','no','no','no','no','no','no','si','no','no','no','no','no',6,'2023-03-16 00:37:36'),(64,'RaterDesign','Rater Design','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',6,'2023-03-16 00:38:04'),(65,'Revit','Revit','si','no','no','no','no','si','no','no','si','si','no','no','no','no','no',6,'2023-03-16 00:38:34'),(66,'Fusion360','Fusion 360','si','no','no','no','no','si','no','no','si','no','no','si','no','si','no',6,'2023-03-16 00:39:04'),(67,'RevitStructure','Revit Structure','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',6,'2023-03-16 00:39:28'),(68,'AcrobatReader','Acrobat Reader','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',7,'2023-03-16 00:40:06'),(69,'NitroPDF','Nitro PDF','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',7,'2023-03-16 00:40:21'),(70,'FoxitReader','Foxit Reader','si','si','si','no','no','si','no','si','si','si','no','si','no','si','no',7,'2023-03-16 00:40:55'),(71,'SlimPDFReader','SlimPDF Reader','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',7,'2023-03-16 00:41:17'),(72,'Jzip','Jzip','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',8,'2023-03-16 00:42:32'),(73,'7Zip','7Zip','no','no','si','no','no','si','no','si','si','si','no','no','no','no','no',8,'2023-03-16 00:43:14'),(74,'X-rar','X-rar','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',8,'2023-03-16 00:43:28'),(75,'Keka','Keka','no','no','no','no','no','no','no','no','no','no','no','si','no','si','no',8,'2023-03-16 00:44:00'),(76,'Winzip','Winzip','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',8,'2023-03-16 00:44:15'),(77,'Winrar','Winrar','si','no','no','no','no','no','no','no','no','no','no','no','no','no','no',8,'2023-03-16 00:44:28'),(78,'Blockbuster','Block buster(I, II, III, IV)','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',9,'2023-03-16 00:45:16'),(79,'GrammarEnglish','Grammar of English','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',9,'2023-03-16 00:45:33'),(80,'Agu','Agu','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',9,'2023-03-16 00:45:45'),(81,'PlacementeTest','Placemente Test','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',9,'2023-03-16 00:46:17'),(82,'TeoflTest','Teofl Test','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',9,'2023-03-16 00:46:33'),(83,'TelephoningEnglish','Telephoning English','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',9,'2023-03-16 00:46:48'),(84,'Phonetics','Phonetics','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',9,'2023-03-16 00:46:59'),(85,'Interchange','Interchange (I,II y II)','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',9,'2023-03-16 00:47:16'),(86,'WMP','Windows Media Player','si','si','si','no','no','si','no','si','si','si','no','no','no','no','no',10,'2023-03-16 00:48:16'),(87,'Itunes','I tunes','no','no','no','no','no','no','no','no','no','no','no','si','no','si','no',10,'2023-03-16 00:48:36'),(88,'IMovie','I Movie','no','no','no','no','no','no','no','no','no','no','no','si','no','si','no',10,'2023-03-16 00:48:54'),(89,'PlayerQuickTime','Player QuickTime','no','no','no','no','no','no','no','no','no','no','no','si','no','si','no',10,'2023-03-16 00:49:13'),(90,'WMM','Windows Movie Maker','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',10,'2023-03-16 00:49:28'),(91,'Audacity','Audacity','si','si','si','no','no','si','no','no','si','si','no','no','no','no','no',10,'2023-03-16 00:49:54'),(92,'FlvPlayer','Flv Player','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',10,'2023-03-16 00:50:16'),(93,'Packettracer','Packet tracer','si','si','si','no','no','si','no','si','no','si','no','no','no','no','no',11,'2023-03-16 00:51:36'),(94,'ESETEndpointSecurityClientes','ESET Endpoint Security Clientes','si','si','si','no','no','si','no','si','si','si','no','si','no','si','no',11,'2023-03-16 00:52:22'),(95,'ESETRemoteAdministratorConsole','ESET Remote Administrator Console','si','si','si','no','no','si','no','si','si','si','no','no','no','no','no',11,'2023-03-16 00:53:02'),(96,'Brackets','Brackets (Editor HTML)','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',11,'2023-03-16 00:53:18'),(97,'Ccleaner','Ccleaner','si','si','si','no','no','si','no','no','si','no','no','si','no','si','no',11,'2023-03-16 00:53:48'),(98,'Máxima','Máxima','si','no','no','no','no','no','no','no','no','no','no','no','no','no','no',11,'2023-03-16 00:54:42'),(99,'GeoGebra','GeoGebra','si','si','si','no','no','si','no','si','si','si','no','no','no','no','no',11,'2023-03-16 00:55:11'),(100,'Graphmatica','Graphmatica','si','no','no','no','no','no','no','no','no','no','no','no','no','no','no',11,'2023-03-16 00:55:28'),(101,'Z-suite','Z-suite','no','no','no','no','no','no','si','no','no','no','no','no','no','no','no',11,'2023-03-16 00:55:43'),(102,'Arduino','Arduino','no','no','no','no','no','no','si','no','no','no','no','no','no','no','no',11,'2023-03-16 00:55:57'),(103,'BantamTools','Bantam Tools','no','no','no','no','no','no','si','no','no','no','no','no','no','no','no',11,'2023-03-16 00:56:16'),(104,'DobotStudio','DobotStudio','no','no','no','no','no','no','si','no','no','no','no','no','no','no','no',11,'2023-03-16 00:56:32'),(105,'Inkscape','Inkscape','no','no','no','no','no','no','si','no','no','no','no','no','no','no','no',11,'2023-03-16 00:56:47'),(106,'Blender','Blender','no','no','no','no','no','no','si','no','no','no','no','no','no','no','no',11,'2023-03-16 00:57:00'),(107,'mBlock','mBlock','no','no','no','no','no','no','si','no','no','no','no','no','no','no','no',11,'2023-03-16 00:57:14'),(108,'Oculus','Oculus (Rift)','no','no','no','no','no','no','si','no','no','no','no','no','no','no','no',11,'2023-03-16 00:57:29'),(109,'R','R (Estadística)','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',11,'2023-03-16 00:57:42'),(110,'CtrlPracticasLab','Control de Prácticas Lab','si','no','si','no','no','no','si','no','no','no','no','no','no','no','no',11,'2023-03-16 00:58:17');
/*!40000 ALTER TABLE `aplicaciones_laboratorios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clasificacion_aplicaciones_laboratorios`
--

DROP TABLE IF EXISTS `clasificacion_aplicaciones_laboratorios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clasificacion_aplicaciones_laboratorios` (
  `idclasificacionlaboratorio` int(11) NOT NULL AUTO_INCREMENT,
  `codigoclasificacionlaboratorio` varchar(255) NOT NULL,
  PRIMARY KEY (`idclasificacionlaboratorio`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clasificacion_aplicaciones_laboratorios`
--

LOCK TABLES `clasificacion_aplicaciones_laboratorios` WRITE;
/*!40000 ALTER TABLE `clasificacion_aplicaciones_laboratorios` DISABLE KEYS */;
INSERT INTO `clasificacion_aplicaciones_laboratorios` VALUES (1,'Ofimática'),(2,'Desarrollo y Bases de Datos'),(3,'Máquinas Virtuales'),(4,'Navegadores'),(5,'Diseño Gráfico'),(6,'AutoDesk'),(7,'Lectores PDF'),(8,'Compresores'),(9,'Inglés'),(10,'Reproductores y Editores de Audio y Video'),(11,'Otros');
/*!40000 ALTER TABLE `clasificacion_aplicaciones_laboratorios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clasificacion_notificaciones`
--

DROP TABLE IF EXISTS `clasificacion_notificaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clasificacion_notificaciones` (
  `idclasificacion` int(11) NOT NULL AUTO_INCREMENT,
  `codigoclasificacion` varchar(50) NOT NULL,
  `descripcionclasificacion` varchar(255) NOT NULL,
  PRIMARY KEY (`idclasificacion`),
  UNIQUE KEY `codigoclasificacion` (`codigoclasificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clasificacion_notificaciones`
--

LOCK TABLES `clasificacion_notificaciones` WRITE;
/*!40000 ALTER TABLE `clasificacion_notificaciones` DISABLE KEYS */;
INSERT INTO `clasificacion_notificaciones` VALUES (1,'solicitudaprobada','Todas las solicitudes que los usuarios ingresen, con un estado de aprobado.'),(2,'solicituddenegada','Todas las solicitudes que los usuarios ingresan, con estado deganado'),(3,'nuevomensaje','Nuevo mensaje recibido en bandeja de entrada, todos los usuarios..'),(4,'aprobacioninicial','Todas las solicitudes que los usuarios ingresen, con un estado aprobación inicial'),(5,'solicitudcancelada','Todas las solicitudes que usuarios ingresen que por algún motivo tienen que ser canceladas. Grupo de reservaciones'),(6,'reservacioncancelada','Cancelar reservaciones dentro de un grupo de reservaciones asignados bajo el código identificador único');
/*!40000 ALTER TABLE `clasificacion_notificaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detallesusuarios`
--

DROP TABLE IF EXISTS `detallesusuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detallesusuarios` (
  `iddetalleusuarios` int(11) NOT NULL AUTO_INCREMENT,
  `telefonoprincipal` varchar(9) NOT NULL,
  `genero` char(2) NOT NULL,
  `fechanacimiento` date NOT NULL,
  `estadocivil` varchar(25) NOT NULL,
  `idusuarios` int(11) NOT NULL,
  PRIMARY KEY (`iddetalleusuarios`),
  KEY `fk_detalleusuarios-usuarios` (`idusuarios`),
  CONSTRAINT `fk_detalleusuarios-usuarios` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detallesusuarios`
--

LOCK TABLES `detallesusuarios` WRITE;
/*!40000 ALTER TABLE `detallesusuarios` DISABLE KEYS */;
INSERT INTO `detallesusuarios` VALUES (1,'7051-8293','m','1997-03-28','soltero',1);
/*!40000 ALTER TABLE `detallesusuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `ActualizarCompletoPerfilUsuarios` AFTER INSERT ON `detallesusuarios` FOR EACH ROW BEGIN
	UPDATE usuarios SET completarperfil='si' WHERE idusuarios = new.idusuarios;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `escuelas`
--

DROP TABLE IF EXISTS `escuelas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `escuelas` (
  `idescuela` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_escuela` varchar(255) NOT NULL,
  `idfacultad` int(11) NOT NULL,
  PRIMARY KEY (`idescuela`),
  KEY `fk_escuelas-facultades` (`idfacultad`),
  CONSTRAINT `fk_escuelas-facultades` FOREIGN KEY (`idfacultad`) REFERENCES `facultades` (`idfacultad`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `escuelas`
--

LOCK TABLES `escuelas` WRITE;
/*!40000 ALTER TABLE `escuelas` DISABLE KEYS */;
INSERT INTO `escuelas` VALUES (1,'Escuela de Comunicaciones',2),(2,'Escuela de Administración y Finanzas',3),(3,'Escuela de Antropología',2),(4,'Escuela de Psicología',2),(5,'Escuela de Idiomas',2),(6,'Escuela de Derecho',4),(7,'Escuela de Informática',1),(8,'Escuela de Ciencias Aplicadas',1);
/*!40000 ALTER TABLE `escuelas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facultades`
--

DROP TABLE IF EXISTS `facultades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `facultades` (
  `idfacultad` int(11) NOT NULL AUTO_INCREMENT,
  `nombrefacultad` varchar(150) NOT NULL,
  `codigofacultad` varchar(40) NOT NULL,
  PRIMARY KEY (`idfacultad`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facultades`
--

LOCK TABLES `facultades` WRITE;
/*!40000 ALTER TABLE `facultades` DISABLE KEYS */;
INSERT INTO `facultades` VALUES (1,'Informática y Ciencias Aplicadas','FICA'),(2,'Ciencias Sociales','FCS'),(3,'Ciencias Empresariales','FCE'),(4,'Derecho','FD');
/*!40000 ALTER TABLE `facultades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laboratorios`
--

DROP TABLE IF EXISTS `laboratorios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `laboratorios` (
  `idlaboratorio` int(11) NOT NULL AUTO_INCREMENT,
  `codigolaboratorio` varchar(15) NOT NULL,
  `nombrelaboratorio` varchar(40) NOT NULL,
  `capacidadlaboratorio` int(11) NOT NULL,
  `maquinasfuerauso` int(11) NOT NULL DEFAULT 0,
  `estadolaboratorio` varchar(25) NOT NULL DEFAULT 'activo',
  `codigocolor` text NOT NULL,
  `mod1` int(11) NOT NULL DEFAULT 0,
  `mod2` int(11) NOT NULL DEFAULT 0,
  `mod3` int(11) NOT NULL DEFAULT 0,
  `mod4` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idlaboratorio`),
  UNIQUE KEY `codigolaboratorio` (`codigolaboratorio`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laboratorios`
--

LOCK TABLES `laboratorios` WRITE;
/*!40000 ALTER TABLE `laboratorios` DISABLE KEYS */;
INSERT INTO `laboratorios` VALUES (1,'LAB1','Laboratorio 1 Informática',79,0,'activo','#e00000',-1,-1,-1,-1),(2,'LAB2','Laboratorio 2 Informatica',90,0,'activo','#f19898',-1,-1,-1,-1),(3,'LAB3','Laboratorio 3 Informática',125,0,'activo','#f971ce',27,36,36,26),(4,'LAB4','Laboratorio 4 Informática',30,0,'activo','#f312d5',-1,-1,-1,-1),(5,'LAB5','Laboratorio 5 Informática',60,0,'activo','#9e62c6',-1,-1,-1,-1),(6,'LAB6','Laboratorio 6 Informática',60,0,'activo','#6b099f',-1,-1,-1,-1),(7,'LAB7','Laboratorio 7 Informática',30,0,'activo','#705d92',-1,-1,-1,-1),(8,'LAB8','Laboratorio 8 Informática',88,0,'activo','#3a19e1',23,30,31,-1),(9,'LAB9','Laboratorio 9 Informática',50,0,'activo','#4d6fd5',-1,-1,-1,-1),(10,'LAB10','Laboratorio 10 Informática',50,0,'inactivo','#42b0f5',-1,-1,-1,-1),(11,'LAB11','Laboratorio 11 Informática',30,0,'activo','#61e5ff',-1,-1,-1,-1),(12,'LAB12','Laboratorio 12 Informática',30,0,'activo','#a6f2cf',-1,-1,-1,-1),(13,'LAB13','Laboratorio 13 Informática',65,0,'activo','#4fab61',-1,-1,-1,-1),(14,'LAB14','Laboratorio 14 Informática',65,0,'activo','#54a800',32,32,-1,-1),(15,'LAB15','Laboratorio 15 Informática',20,0,'activo','#fff700',-1,-1,-1,-1),(18,'LAB163','LAB156',40,0,'activo','#ccd1d0',0,0,0,0),(19,'lab17','dfndfnjkd',49,0,'activo','#24695c',0,0,0,0);
/*!40000 ALTER TABLE `laboratorios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manifiestos_plataforma`
--

DROP TABLE IF EXISTS `manifiestos_plataforma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `manifiestos_plataforma` (
  `idmanifiesto` int(11) NOT NULL AUTO_INCREMENT,
  `idusuarios` int(11) NOT NULL,
  `nombremanifiesto` varchar(255) NOT NULL,
  `descripcionmanifiesto` varchar(700) NOT NULL,
  `fotomanifiesto` varchar(255) NOT NULL,
  `fecharegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado` varchar(25) NOT NULL DEFAULT 'pendiente',
  `comentario_actualizacion` varchar(700) DEFAULT NULL,
  PRIMARY KEY (`idmanifiesto`),
  KEY `fk_manifiestos-usuarios` (`idusuarios`),
  CONSTRAINT `fk_manifiestos-usuarios` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manifiestos_plataforma`
--

LOCK TABLES `manifiestos_plataforma` WRITE;
/*!40000 ALTER TABLE `manifiestos_plataforma` DISABLE KEYS */;
INSERT INTO `manifiestos_plataforma` VALUES (1,1,'Reporte Problema 1','Problema de plataforma numero uno, prueba.','332345413_187456700654787_5766189019673036167_n.jpg','2023-03-10 21:37:06','2023-03-11 00:39:45','cerrado',NULL),(2,1,'Problema Numero Dos, Lorem De Ipsum Dolor Percent Lorem Dr Dolor Ipsum','Problema Numero Dos, Lorem De Ipsum Dolor Percent Lorem Dr Dolor Ipsum Problema Numero Dos, Lorem De Ipsum Dolor Percent Lorem Dr Dolor Ipsum Problema Numero Dos, Lorem De Ipsum Dolor Percent Lorem Dr Dolor Ipsum','pngwing.com.png','2023-03-10 22:03:19','2023-03-10 22:03:19','pendiente',NULL),(3,1,'Problema Numero Tres, Lorem De Ipsum Dolor Percent Lorem Dr Dolor Ipsum','Problema Numero Tres, Lorem De Ipsum Dolor Percent Lorem Dr Dolor IpsumProblema Numero Tres, Lorem De Ipsum Dolor Percent Lorem Dr Dolor IpsumProblema Numero Tres, Lorem De Ipsum Dolor Percent Lorem Dr Dolor IpsumProblema Numero Tres, Lorem De Ipsum Dolor Percent Lorem Dr Dolor IpsumProblema Numero Tres, Lorem De Ipsum Dolor Percent Lorem Dr Dolor IpsumProblema Numero Tres, Lorem De Ipsum Dolor Percent Lorem Dr Dolor IpsumProblema Numero Tres, Lorem De Ipsum Dolor Percent Lorem Dr Dolor IpsumProblema Numero Tres, Lorem De Ipsum Dolor Percent Lorem Dr Dolor Ipsum','131454_640f8d81d274c_pngwing.com.png','2023-03-13 20:54:25','2023-03-13 20:54:25','pendiente',NULL),(4,1,'Problema Numero Cuatro','Problema Numero CuatroProblema Numero CuatroProblema Numero CuatroProblema Numero CuatroProblema Numero CuatroProblema Numero CuatroProblema Numero CuatroProblema Numero CuatroProblema Numero CuatroProblema Numero CuatroProblema Numero CuatroProblema Numero CuatroProblema Numero CuatroProblema Numero CuatroProblema Numero CuatroProblema Numero CuatroProblema Numero CuatroProblema Numero Cuatro','131458_640f8e5dab314_Captura de pantalla 2023-03-13 145753.png','2023-03-13 20:58:05','2023-03-13 21:30:01','resuelto','Gestionando\r\nResuelto'),(5,1,'LOREM','LOREM','111640_645d6ece6db89_Captura de pantalla 2023-05-11 154200.png','2023-05-11 22:40:14','2023-05-11 22:40:41','en proceso','lorem');
/*!40000 ALTER TABLE `manifiestos_plataforma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensajeria`
--

DROP TABLE IF EXISTS `mensajeria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mensajeria` (
  `idmensajeria` int(11) NOT NULL AUTO_INCREMENT,
  `idusuarios` int(11) NOT NULL,
  `nombremensaje` varchar(255) NOT NULL,
  `asuntomensaje` varchar(255) NOT NULL,
  `detallemensaje` text NOT NULL,
  `fechamensaje` timestamp NOT NULL DEFAULT current_timestamp(),
  `idusuarios_destinatario` int(11) NOT NULL,
  `mensajeleido` char(2) NOT NULL DEFAULT 'no',
  `archivo_adjunto` varchar(255) DEFAULT NULL,
  `ocultarmensaje` char(2) NOT NULL DEFAULT 'no',
  PRIMARY KEY (`idmensajeria`),
  KEY `fk_mensajeria_usuarios_destinatariofinal` (`idusuarios`),
  KEY `fk_usuarios_mensajeria_bandejaentrada` (`idusuarios_destinatario`),
  CONSTRAINT `fk_mensajeria_usuarios_destinatariofinal` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`),
  CONSTRAINT `fk_usuarios_mensajeria_bandejaentrada` FOREIGN KEY (`idusuarios_destinatario`) REFERENCES `usuarios` (`idusuarios`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensajeria`
--

LOCK TABLES `mensajeria` WRITE;
/*!40000 ALTER TABLE `mensajeria` DISABLE KEYS */;
INSERT INTO `mensajeria` VALUES (1,1,'lorem','lorem','<p>lorem</p>\r\n','2023-05-11 22:03:05',1,'no',NULL,'si');
/*!40000 ALTER TABLE `mensajeria` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `EnvioNotificacionesNuevosMensajesUsuarios` AFTER INSERT ON `mensajeria` FOR EACH ROW BEGIN
INSERT INTO notificaciones (idusuarios,titulonotificacion,descripcion_notificacion,idclasificacion,ocultarnotificacion) SELECT CONCAT(new.idusuarios_destinatario),CONCAT("Nuevo Mensaje Recibido, Nombre Mensaje: ",new.nombremensaje),CONCAT("Por favor revisa tu bandeja de entrada, has recibido un nuevo mensaje. Asunto: ",new.asuntomensaje),CONCAT(3),CONCAT("no");
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `notificaciones`
--

DROP TABLE IF EXISTS `notificaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notificaciones` (
  `idnotificaciones` int(11) NOT NULL AUTO_INCREMENT,
  `idusuarios` int(11) NOT NULL,
  `titulonotificacion` varchar(255) NOT NULL,
  `descripcion_notificacion` varchar(255) NOT NULL,
  `fechanotificacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `idclasificacion` int(11) NOT NULL,
  `ocultarnotificacion` char(2) NOT NULL,
  PRIMARY KEY (`idnotificaciones`),
  KEY `fk_notificaciones-clasificacionesnotificaciones` (`idclasificacion`),
  KEY `fk_notificaciones-usuarios` (`idusuarios`),
  CONSTRAINT `fk_notificaciones-clasificacionesnotificaciones` FOREIGN KEY (`idclasificacion`) REFERENCES `clasificacion_notificaciones` (`idclasificacion`),
  CONSTRAINT `fk_notificaciones-usuarios` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`)
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificaciones`
--

LOCK TABLES `notificaciones` WRITE;
/*!40000 ALTER TABLE `notificaciones` DISABLE KEYS */;
INSERT INTO `notificaciones` VALUES (84,1,'Su solicitud de reservación: 1-02-2023_23-e31647ac se ha cancelado exitosamente','Por favor revise la sección *Mis Reservaciones*. Estado: cancelado','2023-05-03 20:49:51',5,'si'),(85,1,'Su reservación bajo el identificador: 1-02-2023_23-e31647ac','En fecha y horario: 2023-05-0314:36:00 Ha sido cancelada','2023-05-03 20:49:51',5,'si'),(86,1,'Su solicitud de reservación: 1-02-2023_23-e31647ac se ha aprobado','Por favor revise la sección *Mis Reservaciones*. Estado: aprobado','2023-05-03 20:50:39',1,'si'),(87,1,'Su solicitud de reservación: 1-02-2023_23-e31647ac se ha cancelado exitosamente','Por favor revise la sección *Mis Reservaciones*. Estado: cancelado','2023-05-03 20:53:42',5,'si'),(88,1,'Su reservación bajo el identificador: 1-02-2023_23-e31647ac','En fecha y horario: 2023-05-03 - 14:36:00 Ha sido cancelada','2023-05-03 20:53:42',6,'si'),(89,1,'Su solicitud de reservación: 1-02-2023_23-e31647ac se ha aprobado','Por favor revise la sección *Mis Reservaciones*. Estado: aprobado','2023-05-03 20:55:34',1,'si'),(90,1,'Su reservación bajo el identificador: 1-02-2023_23-e31647ac','En fecha y horario: 2023-05-03 - 14:36:00 Ha sido cancelada','2023-05-03 20:56:40',6,'si'),(91,1,'Su reservación bajo el identificador: 1-02-2023_23-e31647ac se ha cancelado','En fecha y horario: 2023-05-03 - 14:36:00 Ha sido cancelada','2023-05-03 20:59:11',6,'si'),(92,1,'Su solicitud de reservación: 1-02-2023_23-e31647ac se ha cancelado exitosamente','Por favor revise la sección *Mis Reservaciones*. Estado: cancelado','2023-05-03 21:02:30',5,'no'),(93,1,'Su reservación bajo el identificador: 1-02-2023_23-e31647ac se ha cancelado','En fecha y horario: 2023-05-03 - 14:36:00 Ha sido cancelada','2023-05-03 21:02:43',6,'no'),(94,1,'Su reservación bajo el identificador: 1-02-2023_23-e31647ac se ha cancelado','En fecha y horario: 2023-05-03 - 14:36:00 Ha sido cancelada','2023-05-03 21:10:29',6,'no'),(95,1,'Su solicitud de reservación: 1-02-2023_23-a7f5aa9d se ha actualizado','Por favor revise la sección *Mis Reservaciones*. Estado: aprobacioninicial','2023-05-04 21:02:14',4,'no'),(96,1,'Su solicitud de reservación: 1-02-2023_23-a7f5aa9d se ha aprobado','Por favor revise la sección *Mis Reservaciones*. Estado: aprobado','2023-05-04 21:02:46',1,'no'),(97,1,'Su solicitud de reservación: 1-02-2023_23-8b8d9c18 se ha actualizado','Por favor revise la sección *Mis Reservaciones*. Estado: aprobacioninicial','2023-05-04 22:54:49',4,'no'),(98,1,'Su solicitud de reservación: 1-02-2023_23-8b8d9c18 se ha aprobado','Por favor revise la sección *Mis Reservaciones*. Estado: aprobado','2023-05-04 22:55:14',1,'no'),(99,1,'Su solicitud de reservación: 1-02-2023_23-410d82d5 se ha actualizado','Por favor revise la sección *Mis Reservaciones*. Estado: aprobacioninicial','2023-05-04 23:37:59',4,'no'),(100,1,'Su solicitud de reservación: 1-02-2023_23-c47bc7e9 se ha actualizado','Por favor revise la sección *Mis Reservaciones*. Estado: aprobacioninicial','2023-05-04 23:38:23',4,'no'),(101,1,'Su solicitud de reservación: 1-02-2023_23-410d82d5 se ha aprobado','Por favor revise la sección *Mis Reservaciones*. Estado: aprobado','2023-05-04 23:40:18',1,'no'),(102,1,'Su solicitud de reservación: 1-02-2023_23-c47bc7e9 se ha aprobado','Por favor revise la sección *Mis Reservaciones*. Estado: aprobado','2023-05-04 23:40:42',1,'no'),(103,1,'Su solicitud de reservación: 1-02-2023_23-f223c781 se ha denegado','Por favor revise la sección *Mis Reservaciones*. Estado: denegada','2023-05-05 21:46:59',2,'no'),(104,1,'Su solicitud de reservación: 1-02-2023_23-1d5d5652 se ha actualizado','Por favor revise la sección *Mis Reservaciones*. Estado: aprobacioninicial','2023-05-05 22:37:32',4,'no'),(105,1,'Su solicitud de reservación: 1-02-2023_23-bea44684 se ha actualizado','Por favor revise la sección *Mis Reservaciones*. Estado: aprobacioninicial','2023-05-05 22:38:11',4,'no'),(106,1,'Su solicitud de reservación: 1-02-2023_23-1d5d5652 se ha aprobado','Por favor revise la sección *Mis Reservaciones*. Estado: aprobado','2023-05-05 22:38:31',1,'no'),(107,1,'Su solicitud de reservación: 1-02-2023_23-bea44684 se ha aprobado','Por favor revise la sección *Mis Reservaciones*. Estado: aprobado','2023-05-05 22:38:48',1,'no'),(108,1,'Su solicitud de reservación: 1-02-2023_23-bbc9bb2e se ha actualizado','Por favor revise la sección *Mis Reservaciones*. Estado: aprobacioninicial','2023-05-05 22:43:56',4,'no'),(109,1,'Su solicitud de reservación: 1-02-2023_23-bbc9bb2e se ha aprobado','Por favor revise la sección *Mis Reservaciones*. Estado: aprobado','2023-05-05 22:44:20',1,'no'),(110,1,'Su solicitud de reservación: 1-02-2023_23-4a5477e7 se ha actualizado','Por favor revise la sección *Mis Reservaciones*. Estado: aprobacioninicial','2023-05-06 00:18:04',4,'no'),(111,1,'Su solicitud de reservación: 1-02-2023_23-4a5477e7 se ha aprobado','Por favor revise la sección *Mis Reservaciones*. Estado: aprobado','2023-05-06 00:18:35',1,'no'),(112,1,'Su solicitud de reservación: 1-02-2023_23-d433fdd7 se ha actualizado','Por favor revise la sección *Mis Reservaciones*. Estado: aprobacioninicial','2023-05-07 23:47:31',4,'no'),(113,1,'Su solicitud de reservación: 1-02-2023_23-136dfd50 se ha actualizado','Por favor revise la sección *Mis Reservaciones*. Estado: aprobacioninicial','2023-05-08 20:20:17',4,'no'),(114,1,'Su solicitud de reservación: 1-02-2023_23-3e186f54 se ha actualizado','Por favor revise la sección *Mis Reservaciones*. Estado: aprobacioninicial','2023-05-08 20:20:36',4,'no'),(115,1,'Su solicitud de reservación: 1-02-2023_23-136dfd50 se ha aprobado','Por favor revise la sección *Mis Reservaciones*. Estado: aprobado','2023-05-08 20:26:25',1,'no'),(116,1,'Su solicitud de reservación: 1-02-2023_23-3e186f54 se ha aprobado','Por favor revise la sección *Mis Reservaciones*. Estado: aprobado','2023-05-08 20:35:41',1,'no'),(118,1,'Su reservación bajo el identificador: 1-02-2023_23-136dfd50 se ha cancelado','En fecha y horario: 2023-05-08 - 13:00:00 Ha sido cancelada','2023-05-08 20:47:37',6,'no'),(119,1,'Su reservación bajo el identificador: 1-02-2023_23-136dfd50 se ha cancelado','En fecha y horario: 2023-05-08 - 13:00:00 Ha sido cancelada','2023-05-08 20:49:52',6,'no'),(125,1,'Su reservación bajo el identificador: 1-02-2023_23-136dfd50 se ha cancelado','En fecha y horario: 2023-05-08 - 13:00:00 Ha sido cancelada','2023-05-08 21:03:59',6,'no'),(126,1,'Su reservación bajo el identificador: 1-02-2023_23-136dfd50 se ha cancelado','En fecha y horario: 2023-05-08 - 13:00:00 Ha sido cancelada','2023-05-08 21:04:29',6,'no'),(129,1,'Su reservación bajo el identificador: 1-02-2023_23-1d5d5652 se ha cancelado','En fecha y horario: 2023-05-12 - 08:00:00 Ha sido cancelada','2023-05-09 21:09:57',6,'no'),(130,1,'Su reservación bajo el identificador: 1-02-2023_23-1d5d5652 se ha cancelado','En fecha y horario: 2023-05-12 - 08:00:00 Ha sido cancelada','2023-05-09 21:10:29',6,'no'),(131,1,'Su reservación bajo el identificador: 1-02-2023_23-1d5d5652 se ha cancelado','En fecha y horario: 2023-05-08 - 08:00:00 Ha sido cancelada','2023-05-09 21:10:52',6,'no'),(132,1,'Su reservación bajo el identificador: 1-02-2023_23-1d5d5652 se ha cancelado','En fecha y horario: 2023-05-05 - 08:00:00 Ha sido cancelada','2023-05-09 21:12:28',6,'no'),(133,1,'Su reservación bajo el identificador: 1-02-2023_23-1d5d5652 se ha cancelado','En fecha y horario: 2023-05-08 - 08:00:00 Ha sido cancelada','2023-05-09 21:12:31',6,'no'),(134,1,'Su solicitud de reservación: 1-02-2023_23-bce68dea se ha actualizado','Por favor revise la sección *Mis Reservaciones*. Estado: aprobacioninicial','2023-05-11 21:35:15',4,'no'),(135,1,'Su solicitud de reservación: 1-02-2023_23-6dff97ef se ha actualizado','Por favor revise la sección *Mis Reservaciones*. Estado: aprobacioninicial','2023-05-11 21:35:44',4,'no'),(136,1,'Su solicitud de reservación: 1-02-2023_23-6dff97ef se ha aprobado','Por favor revise la sección *Mis Reservaciones*. Estado: aprobado','2023-05-11 21:37:48',1,'no'),(137,1,'Su solicitud de reservación: 1-02-2023_23-bce68dea se ha aprobado','Por favor revise la sección *Mis Reservaciones*. Estado: aprobado','2023-05-11 21:38:06',1,'no'),(138,1,'Su solicitud de reservación: 1-02-2023_23-d433fdd7 se ha aprobado','Por favor revise la sección *Mis Reservaciones*. Estado: aprobado','2023-05-11 21:38:23',1,'no'),(139,2,'Nuevo Mensaje Recibido, Nombre Mensaje: lorem','Por favor revisa tu bandeja de entrada, has recibido un nuevo mensaje. Asunto: lorem','2023-05-11 22:03:05',3,'no'),(140,1,'Su reservación bajo el identificador: 1-02-2023_23-bbc9bb2e se ha cancelado','En fecha y horario: 2023-05-12 - 08:00:00 Ha sido cancelada','2023-05-11 23:04:22',6,'no'),(141,1,'Su reservación bajo el identificador: 1-02-2023_23-bbc9bb2e se ha cancelado','En fecha y horario: 2023-05-19 - 08:00:00 Ha sido cancelada','2023-05-11 23:17:41',6,'no'),(142,1,'Su reservación bajo el identificador: 1-02-2023_23-bbc9bb2e se ha cancelado','En fecha y horario: 2023-06-02 - 08:00:00 Ha sido cancelada','2023-05-11 23:19:07',6,'no'),(143,1,'Su reservación bajo el identificador: 1-02-2023_23-bbc9bb2e se ha cancelado','En fecha y horario: 2023-06-02 - 08:00:00 Ha sido cancelada','2023-05-11 23:28:03',6,'no'),(144,1,'Su reservación bajo el identificador: 1-02-2023_23-bbc9bb2e se ha cancelado','En fecha y horario: 2023-06-02 - 08:00:00 Ha sido cancelada','2023-05-11 23:29:18',6,'no'),(145,1,'Su reservación bajo el identificador: 1-02-2023_23-bbc9bb2e se ha cancelado','En fecha y horario: 2023-05-12 - 08:00:00 Ha sido cancelada','2023-05-11 23:30:23',6,'no'),(146,1,'Su solicitud de reservación: 1-02-2023_23-2cc1be2d se ha actualizado','Por favor revise la sección *Mis Reservaciones*. Estado: aprobacioninicial','2023-05-14 21:47:43',4,'no'),(147,1,'Su solicitud de reservación: 1-02-2023_23-2cc1be2d se ha aprobado','Por favor revise la sección *Mis Reservaciones*. Estado: aprobado','2023-05-14 21:52:23',1,'no'),(148,1,'Su solicitud de reservación: 1-02-2023_23-e8852e4a se ha actualizado','Por favor revise la sección *Mis Reservaciones*. Estado: aprobacioninicial','2023-05-16 22:37:32',4,'no'),(149,1,'Su reservación bajo el identificador: 1-02-2023_23-1d5d5652 se ha cancelado','En fecha y horario: 2023-05-19 - 08:00:00 Ha sido cancelada','2023-05-16 22:56:29',6,'no'),(150,1,'Su reservación bajo el identificador: 1-02-2023_23-1d5d5652 se ha cancelado','En fecha y horario: 2023-05-22 - 08:00:00 Ha sido cancelada','2023-05-16 22:56:44',6,'no'),(151,1,'Su solicitud de reservación: 1-02-2023_23-94d85532 se ha denegado','Por favor revise la sección *Mis Reservaciones*. Estado: denegada','2023-05-16 23:03:13',2,'no');
/*!40000 ALTER TABLE `notificaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `practicas_libres`
--

DROP TABLE IF EXISTS `practicas_libres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `practicas_libres` (
  `idpracticalibre` int(11) NOT NULL AUTO_INCREMENT,
  `idaplicacion` int(11) NOT NULL,
  `idtiporeservacion` int(11) NOT NULL,
  `idlaboratorio` int(11) NOT NULL,
  `idfacultad` int(11) NOT NULL,
  `idusuarios` int(11) NOT NULL,
  `nombreusuario_reservacion` varchar(255) NOT NULL,
  `carneusuario_reservacion` varchar(12) NOT NULL,
  `fechainicio` date NOT NULL,
  `horainicio` time NOT NULL,
  `horafin` time DEFAULT NULL,
  `ciclo` varchar(8) NOT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'activa',
  PRIMARY KEY (`idpracticalibre`),
  KEY `fk_practicalibre-aplicaciones` (`idaplicacion`),
  KEY `fk_practicalibre-tiporeservacion` (`idtiporeservacion`),
  KEY `fk_practicalibre-laboratorio` (`idlaboratorio`),
  KEY `fk_practicalibre-facultad` (`idfacultad`),
  KEY `fk_practicalibre-usuarios` (`idusuarios`),
  CONSTRAINT `fk_practicalibre-aplicaciones` FOREIGN KEY (`idaplicacion`) REFERENCES `aplicaciones_laboratorios` (`idaplicacion`),
  CONSTRAINT `fk_practicalibre-facultad` FOREIGN KEY (`idfacultad`) REFERENCES `facultades` (`idfacultad`),
  CONSTRAINT `fk_practicalibre-laboratorio` FOREIGN KEY (`idlaboratorio`) REFERENCES `laboratorios` (`idlaboratorio`),
  CONSTRAINT `fk_practicalibre-tiporeservacion` FOREIGN KEY (`idtiporeservacion`) REFERENCES `tipo_reservaciones` (`idtiporeservacion`),
  CONSTRAINT `fk_practicalibre-usuarios` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `practicas_libres`
--

LOCK TABLES `practicas_libres` WRITE;
/*!40000 ALTER TABLE `practicas_libres` DISABLE KEYS */;
INSERT INTO `practicas_libres` VALUES (11,19,6,10,1,1,'Elias Daniel Martinez Rivera','27-0077-2019','2023-04-25','10:00:00','17:43:48','02-2023','finalizado'),(12,16,6,3,1,1,'Lorem de Ipsum','22-3323-2122','2023-05-05','17:00:00','17:50:40','02-2023','finalizado'),(13,16,6,3,1,1,'lorem','22-3333-4444','2023-05-05','08:00:00','17:44:09','02-2023','finalizado'),(14,17,6,6,1,1,'Lorem de Ipsumen','22-3344-2020','2023-05-05','11:06:00','14:23:22','02-2023','finalizado'),(15,18,6,10,1,1,'Lorem Lorem Lorem','22-3344-5544','2023-05-06','14:21:00','14:23:29','02-2023','finalizado'),(16,18,6,10,1,1,'Lorem Lorem Lorem','22-3333-3333','2023-05-06','14:21:00','14:23:39','02-2023','finalizado'),(17,4,6,10,1,1,'Lorem Dolores','22-3333-4332','2023-05-08','15:26:00','15:39:15','02-2023','finalizado'),(18,4,6,11,1,1,'Joaquin Lorem','22-3333-2323','2023-05-08','15:26:00','15:38:28','02-2023','finalizado'),(19,4,6,15,1,1,'Rosa Lorem','22-3333-4233','2023-05-08','15:26:00','15:39:25','02-2023','finalizado'),(20,4,6,11,1,1,'Juan Lorem','22-3232-3232','2023-05-08','15:26:00','15:38:40','02-2023','finalizado'),(21,4,6,11,1,1,'Lorem Lorem','22-2323-2323','2023-05-08','15:26:00','15:38:53','02-2023','finalizado'),(22,4,6,11,2,1,'Lorem Dolor','11-3242-3222','2023-05-08','15:26:00','15:45:10','02-2023','finalizado'),(23,4,6,2,3,1,'Lorem de Ipsum','22-3334-2020','2023-05-11','15:44:00','15:51:56','02-2023','finalizado'),(24,4,6,2,2,1,'Lorem Lorem','22-2222-2222','2023-05-11','15:44:00','15:52:04','02-2023','finalizado'),(25,33,6,15,2,1,'Lorem Dolor','11-2233-2020','2023-05-16','18:13:00','18:49:24','02-2023','finalizado');
/*!40000 ALTER TABLE `practicas_libres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recuperacion`
--

DROP TABLE IF EXISTS `recuperacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recuperacion` (
  `idrecuperaciones` int(11) NOT NULL AUTO_INCREMENT,
  `correo` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `codigo` int(11) NOT NULL,
  `fechasolicitud` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado` varchar(15) NOT NULL DEFAULT 'nousado',
  PRIMARY KEY (`idrecuperaciones`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recuperacion`
--

LOCK TABLES `recuperacion` WRITE;
/*!40000 ALTER TABLE `recuperacion` DISABLE KEYS */;
INSERT INTO `recuperacion` VALUES (1,'dieselmods1@gmail.com','d1d9f3036b',36984,'2023-02-21 23:24:45','nousado'),(2,'2700772019@mail.utec.edu.sv','6b1c31125e',26768,'2023-02-21 23:27:03','nousado'),(3,'2700772019@mail.utec.edu.sv','cb23fd250e',51980,'2023-02-21 23:28:27','nousado'),(4,'2700772019@mail.utec.edu.sv','334b27940e',57782,'2023-02-22 00:31:58','nousado'),(5,'2734002018@mail.utec.edu.sv','df113d7db5',94742,'2023-02-22 00:35:00','nousado'),(6,'2731812020@mail.utec.edu.sv','e2c43efe98',96880,'2023-02-22 00:40:22','nousado'),(7,'dieselmods1@gmail.com','20fac59f4a',34110,'2023-02-22 00:59:54','nousado'),(8,'dieselmods1@gmail.com','d025faba43',32815,'2023-02-22 01:01:22','nousado'),(9,'dieselmods1@gmail.com','b6477aec52',72391,'2023-02-22 01:02:18','nousado'),(10,'dieselmods1@gmail.com','66da30ae73',42964,'2023-02-22 01:03:07','nousado'),(11,'dieselmods1@gmail.com','347c845124',90953,'2023-02-22 01:08:09','nousado'),(12,'dieselmods1@gmail.com','e0974284d7',18367,'2023-02-22 01:10:30','nousado'),(13,'dieselmods1@gmail.com','2640851eb5',68169,'2023-02-22 01:11:14','nousado'),(14,'dieselmods1@gmail.com','0fd8a43b38',85659,'2023-02-22 01:12:32','nousado'),(15,'2700772019@mail.utec.edu.sv','b7f58ebb43',56782,'2023-02-22 01:17:55','nousado'),(16,'2700772019@mail.utec.edu.sv','e42beb3e59',90219,'2023-02-22 01:19:23','nousado'),(17,'2794884@m.com','00c3ce476f',33900,'2023-02-22 01:23:27','nousado'),(18,'lorem@lorem.com','bf4baa298c',17707,'2023-02-22 20:54:22','nousado'),(19,'dieselmods1@gmail.com','8610fcb420',31141,'2023-02-22 21:05:39','nousado'),(20,'dieselmods1@gmail.com','15dbd8bd38',54540,'2023-02-22 21:06:09','nousado'),(21,'dieselmods1@gmail.com','6629f4ed02',15705,'2023-02-22 21:06:34','nousado'),(22,'dieselmods1@gmail.com','a08e7ffdb9',70806,'2023-02-22 21:07:16','nousado'),(23,'dieselmods1@gmail.com','380654cd88',29785,'2023-02-22 21:07:55','nousado'),(24,'dieselmods1@gmail.com','42360f8223',25276,'2023-02-22 21:09:51','nousado'),(25,'dieselmods1@gmail.com','5dfc7d5939',96698,'2023-02-22 21:11:10','nousado'),(26,'2700772019@mail.utec.edu.sv','8a2151df6c',92782,'2023-02-22 21:12:22','nousado'),(27,'dieselmods1@gmail.com','c04a2b8cc9',82330,'2023-02-22 21:13:58','nousado'),(28,'dieselmods1@gmail.com','00f6b34d0d',64165,'2023-02-22 21:53:05','nousado'),(29,'dieselmods1@gmail.com','b68e10f2a2',97175,'2023-02-22 23:33:17','nousado'),(30,'dieselmods1@gmail.com','c41ab7e423',79885,'2023-02-22 23:38:34','nousado'),(31,'dieselmods1@gmail.com','d67bcf0f4a',81978,'2023-02-22 23:40:10','nousado'),(32,'dieselmods1@gmail.com','1cfdb7e597',98332,'2023-02-22 23:41:20','nousado'),(33,'dieselmods1@gmail.com','8d601597b0',74052,'2023-02-23 00:00:51','usado'),(34,'dieselmods1@gmail.com','698f691c4a',26713,'2023-02-23 00:20:01','usado'),(35,'dieselmods1@gmail.com','5f487022cf',50748,'2023-02-23 00:21:46','usado'),(36,'dieselmods1@gmail.com','1585302ac0',40516,'2023-02-23 00:45:19','usado'),(37,'dieselmods1@gmail.com','5f46524704',90003,'2023-02-23 00:53:04','usado'),(38,'dieselmods1@gmail.com','eba985b3d9',37053,'2023-02-23 00:56:49','usado'),(39,'dieselmods1@gmail.com','d2b19709eb',20807,'2023-02-23 20:44:27','nousado'),(40,'dieselmods1@gmail.com','cd4c4b8cf4',74439,'2023-02-23 20:47:31','nousado'),(41,'dieselmods1@gmail.com','2ed887470f',21534,'2023-02-23 20:52:21','usado'),(42,'dieselmods1@gmail.com','13713b25c6',80515,'2023-02-23 21:54:25','usado'),(43,'dieselmods1@gmail.com','8b99ab20ca',83858,'2023-02-23 22:01:44','usado'),(44,'dieselmods1@gmail.com','b57bea1878',28354,'2023-02-23 22:09:39','nousado'),(45,'dieselmods1@gmail.com','55d1a8b02f',79401,'2023-02-23 23:09:39','nousado'),(46,'dieselmods1@gmail.com','9abb954d6d',10090,'2023-02-23 23:11:23','usado'),(47,'dieselmods1@gmail.com','0acbc3b66a',85461,'2023-02-23 23:15:40','usado'),(48,'dieselmods1@gmail.com','c719e90064',48299,'2023-02-24 00:02:56','usado'),(49,'dieselmods1@gmail.com','068010bbea',59875,'2023-02-24 00:04:57','usado'),(50,'dieselmods1@gmail.com','b10a9bb6f3',82755,'2023-02-24 00:57:02','nousado'),(51,'dieselmods1@gmail.com','438e432cb3',11414,'2023-02-24 00:58:35','usado'),(52,'dieselmods1@gmail.com','a49219f67c',17607,'2023-02-24 20:45:02','nousado'),(53,'dieselmods1@gmail.com','c4a1b6c7f2',24885,'2023-02-24 21:12:21','usado'),(54,'dieselmods1@gmail.com','d5abda5098',27442,'2023-03-01 01:26:24','nousado'),(55,'dieselmods1@gmail.com','bd944de381',51762,'2023-03-01 01:29:50','nousado'),(56,'dieselmods1@gmail.com','cb4e3f9137',73595,'2023-03-01 01:31:53','usado'),(57,'proyectosedmr@gmail.com','1392769904',19156,'2023-03-10 06:21:19','usado'),(58,'dieselmods1@gmail.com','e924a674c2',63432,'2023-03-16 21:53:12','nousado'),(59,'dieselmods1@gmail.com','65e2d47c73',88712,'2023-03-16 21:55:45','nousado'),(60,'dieselmods1@gmail.com','c2a016f0a9',44234,'2023-03-16 22:03:56','nousado'),(61,'dieselmods1@gmail.com','cdb12a9239',25626,'2023-03-16 22:05:37','usado'),(62,'dieselmods1@gmail.com','66371074a9',95234,'2023-03-18 06:28:01','nousado'),(63,'dieselmods1@gmail.com','8465a87aaf',33528,'2023-03-18 06:29:36','nousado'),(64,'dieselmods1@gmail.com','a6f8d63175',28679,'2023-03-18 06:33:05','nousado'),(65,'dieselmods1@gmail.com','521c635d2f',22670,'2023-03-24 06:34:06','nousado'),(66,'dieselmods1@gmail.com','2245d1f79d',38372,'2023-03-24 06:34:29','nousado'),(67,'dieselmods1@gmail.com','54126800ad',24076,'2023-03-24 06:35:05','nousado'),(68,'2700772019@mail.utec.edu.sv','beb1eaff14',62634,'2023-03-24 06:37:39','usado'),(69,'2700772019@mail.utec.edu.sv','884e971271',72946,'2023-03-24 19:16:58','nousado'),(70,'2700772019@mail.utec.edu.sv','627c2d1711',60262,'2023-03-24 19:44:52','usado'),(71,'dieselmods1@gmail.com','219d4f628e',76191,'2023-04-01 00:13:06','nousado'),(72,'2700772019@mail.utec.edu.sv','21a3359193',24975,'2023-04-01 00:14:46','usado'),(73,'2700772019@mail.utec.edu.sv','2ac15eb72b',95277,'2023-04-13 00:38:25','nousado'),(74,'2700772019@mail.utec.edu.sv','fa27693334',33342,'2023-04-15 05:43:54','usado'),(75,'dieselmods1@gmail.com','580a28398f',21362,'2023-04-15 05:44:59','nousado'),(76,'dieselmods1@gmail.com','45a0a7458b',57827,'2023-04-15 05:46:31','nousado'),(77,'dieselmods1@gmail.com','888be803c6',43468,'2023-04-15 05:48:26','nousado'),(78,'dieselmods1@gmail.com','487fe746db',33832,'2023-04-15 05:51:02','usado'),(79,'proyectosedmr@gmail.com','62fa388601',86746,'2023-04-19 05:37:34','nousado');
/*!40000 ALTER TABLE `recuperacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservaciones`
--

DROP TABLE IF EXISTS `reservaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservaciones` (
  `idreservacion` int(11) NOT NULL AUTO_INCREMENT,
  `idusuarios` int(11) NOT NULL,
  `idfacultad` int(11) NOT NULL,
  `idescuela` int(11) NOT NULL,
  `idlaboratorio` int(11) NOT NULL,
  `idaplicacion` int(11) NOT NULL,
  `idtiporeservacion` int(11) NOT NULL,
  `codigounico_identificador` varchar(100) NOT NULL,
  `codigoreservacion` varchar(255) NOT NULL,
  `ciclo` varchar(8) NOT NULL,
  `nombrereservacion` varchar(255) NOT NULL,
  `seccionreservacion` int(11) NOT NULL,
  `fechainicioreservacion` date NOT NULL,
  `fechafinreservacion` date NOT NULL,
  `horainicioreservacion` time NOT NULL,
  `horafinreservacion` time NOT NULL,
  `numerousuarios` int(11) NOT NULL,
  `estadoreservacion` varchar(40) NOT NULL DEFAULT 'pendiente',
  `otrotipo_reservacion` varchar(255) DEFAULT NULL,
  `comentario_adminlaboratorios` varchar(500) DEFAULT NULL,
  `comentario_coordlaboratorio` varchar(500) DEFAULT NULL,
  `finalizado` char(2) NOT NULL DEFAULT 'no',
  `usuario_gestion` varchar(255) DEFAULT NULL,
  `fecharegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `completo_seguimiento` char(2) NOT NULL DEFAULT 'no',
  `mod1` int(11) NOT NULL DEFAULT 0,
  `mod2` int(11) NOT NULL DEFAULT 0,
  `mod3` int(11) NOT NULL DEFAULT 0,
  `mod4` int(11) NOT NULL DEFAULT 0,
  `titular_reservacion` char(2) NOT NULL,
  `nombre_otrotitular` varchar(255) DEFAULT NULL,
  `aula_procedencia` varchar(30) NOT NULL,
  `comentario_cancelacion` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`idreservacion`),
  KEY `fk_usuarios-reservaciones` (`idusuarios`),
  KEY `fk_facultad-reservaciones` (`idfacultad`),
  KEY `fk_laboratorio-reservaciones` (`idlaboratorio`),
  KEY `fk_aplicacioneslaboratorios-reservaciones` (`idaplicacion`),
  KEY `fk_tiporeservacion-reservaciones` (`idtiporeservacion`),
  KEY `fk_escuelas-facultades-reservaciones` (`idescuela`),
  CONSTRAINT `fk_aplicacioneslaboratorios-reservaciones` FOREIGN KEY (`idaplicacion`) REFERENCES `aplicaciones_laboratorios` (`idaplicacion`),
  CONSTRAINT `fk_escuelas-facultades-reservaciones` FOREIGN KEY (`idescuela`) REFERENCES `escuelas` (`idescuela`),
  CONSTRAINT `fk_facultad-reservaciones` FOREIGN KEY (`idfacultad`) REFERENCES `facultades` (`idfacultad`),
  CONSTRAINT `fk_laboratorio-reservaciones` FOREIGN KEY (`idlaboratorio`) REFERENCES `laboratorios` (`idlaboratorio`),
  CONSTRAINT `fk_tiporeservacion-reservaciones` FOREIGN KEY (`idtiporeservacion`) REFERENCES `tipo_reservaciones` (`idtiporeservacion`),
  CONSTRAINT `fk_usuarios-reservaciones` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservaciones`
--

LOCK TABLES `reservaciones` WRITE;
/*!40000 ALTER TABLE `reservaciones` DISABLE KEYS */;
INSERT INTO `reservaciones` VALUES (1,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-01-23','2023-01-23','08:00:00','09:29:00',87,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','si',27,36,24,0,'si',NULL,'BJ-402',NULL),(2,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-01-27','2023-01-27','08:00:00','09:29:00',87,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',27,36,24,0,'si',NULL,'BJ-402',NULL),(3,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-01-30','2023-01-30','08:00:00','09:29:00',87,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',27,36,24,0,'si',NULL,'BJ-402',NULL),(4,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-02-03','2023-02-03','08:00:00','09:29:00',87,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',27,36,24,0,'si',NULL,'BJ-402',NULL),(5,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-02-06','2023-02-06','08:00:00','09:29:00',87,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',27,36,24,0,'si',NULL,'BJ-402',NULL),(6,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-02-10','2023-02-10','08:00:00','09:29:00',87,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',27,36,24,0,'si',NULL,'BJ-402',NULL),(7,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-02-13','2023-02-13','08:00:00','09:29:00',87,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',27,36,24,0,'si',NULL,'BJ-402',NULL),(8,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-02-17','2023-02-17','08:00:00','09:29:00',87,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',27,36,24,0,'si',NULL,'BJ-402',NULL),(9,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-02-20','2023-02-20','08:00:00','09:29:00',87,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',27,36,24,0,'si',NULL,'BJ-402',NULL),(10,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-02-24','2023-02-24','08:00:00','09:29:00',87,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',27,36,24,0,'si',NULL,'BJ-402',NULL),(11,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-02-27','2023-02-27','08:00:00','09:29:00',87,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',27,36,24,0,'si',NULL,'BJ-402',NULL),(12,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-03-03','2023-03-03','08:00:00','09:29:00',87,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',27,36,24,0,'si',NULL,'BJ-402',NULL),(13,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-03-06','2023-03-06','08:00:00','09:29:00',87,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',27,36,24,0,'si',NULL,'BJ-402',NULL),(14,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-03-10','2023-03-10','08:00:00','09:29:00',87,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',27,36,24,0,'si',NULL,'BJ-402',NULL),(15,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-03-13','2023-03-13','08:00:00','09:29:00',87,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',27,36,24,0,'si',NULL,'BJ-402',NULL),(16,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-03-17','2023-03-17','08:00:00','09:29:00',87,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',27,36,24,0,'si',NULL,'BJ-402',NULL),(17,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-03-20','2023-03-20','08:00:00','09:29:00',87,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',27,36,24,0,'si',NULL,'BJ-402',NULL),(18,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-03-24','2023-03-24','08:00:00','09:29:00',87,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',27,36,24,0,'si',NULL,'BJ-402',NULL),(19,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-03-27','2023-03-27','08:00:00','09:29:00',87,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',27,36,24,0,'si',NULL,'BJ-402',NULL),(20,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-03-31','2023-03-31','08:00:00','09:29:00',87,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',27,36,24,0,'si',NULL,'BJ-402',NULL),(21,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-04-10','2023-04-10','08:00:00','09:29:00',87,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',27,36,24,0,'si',NULL,'BJ-402',NULL),(22,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-04-14','2023-04-14','08:00:00','09:29:00',87,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',27,36,24,0,'si',NULL,'BJ-402',NULL),(23,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-04-17','2023-04-17','08:00:00','09:29:00',87,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',27,36,24,0,'si',NULL,'BJ-402',NULL),(24,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-04-21','2023-04-21','08:00:00','09:29:00',87,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',27,36,24,0,'si',NULL,'BJ-402',NULL),(25,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-04-24','2023-04-24','08:00:00','09:29:00',87,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',27,36,24,0,'si',NULL,'BJ-402',NULL),(26,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-04-28','2023-04-28','08:00:00','09:29:00',87,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',27,36,24,0,'si',NULL,'BJ-402',NULL),(27,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-05-05','2023-05-05','08:00:00','09:29:00',87,'cancelada','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',27,36,24,0,'si',NULL,'BJ-402',NULL),(28,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-05-08','2023-05-08','08:00:00','09:29:00',87,'cancelada','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',27,36,24,0,'si',NULL,'BJ-402',NULL),(29,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-05-12','2023-05-12','08:00:00','09:29:00',87,'cancelada','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',0,0,0,0,'si',NULL,'BJ-402','CANCELO'),(30,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-05-15','2023-05-15','08:00:00','09:29:00',87,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',27,36,24,0,'si',NULL,'BJ-402',NULL),(31,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-05-19','2023-05-19','08:00:00','09:29:00',87,'cancelada','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',0,0,0,0,'si',NULL,'BJ-402','NO LLEGARA'),(32,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-05-22','2023-05-22','08:00:00','09:29:00',87,'cancelada','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',0,0,0,0,'si',NULL,'BJ-402','NO LLEGARA'),(33,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-05-26','2023-05-26','08:00:00','09:29:00',87,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',27,36,24,0,'si',NULL,'BJ-402',NULL),(34,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-05-29','2023-05-29','08:00:00','09:29:00',87,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',27,36,24,0,'si',NULL,'BJ-402',NULL),(35,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-06-02','2023-06-02','08:00:00','09:29:00',87,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',27,36,24,0,'si',NULL,'BJ-402',NULL),(36,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','BAS1-I','02-2023','Bases de Datos I',1,'2023-06-05','2023-06-05','08:00:00','09:29:00',87,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:35:15','no',27,36,24,0,'si',NULL,'BJ-402',NULL),(37,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-02-01','2023-02-01','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(38,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-02-04','2023-02-04','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(39,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-02-08','2023-02-08','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(40,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-02-11','2023-02-11','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(41,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-02-15','2023-02-15','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(42,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-02-18','2023-02-18','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(43,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-02-22','2023-02-22','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(44,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-02-25','2023-02-25','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(45,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-03-01','2023-03-01','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(46,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-03-04','2023-03-04','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(47,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-03-08','2023-03-08','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(48,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-03-11','2023-03-11','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(49,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-03-15','2023-03-15','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(50,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-03-18','2023-03-18','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(51,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-03-22','2023-03-22','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(52,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-03-25','2023-03-25','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(53,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-03-29','2023-03-29','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(54,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-04-12','2023-04-12','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(55,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-04-15','2023-04-15','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(56,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-04-19','2023-04-19','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(57,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-04-22','2023-04-22','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(58,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-04-26','2023-04-26','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(59,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-04-29','2023-04-29','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(60,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-05-03','2023-05-03','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(61,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-05-06','2023-05-06','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(62,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-05-13','2023-05-13','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(63,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-05-17','2023-05-17','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(64,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-05-20','2023-05-20','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(65,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-05-24','2023-05-24','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(66,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-05-27','2023-05-27','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(67,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-05-31','2023-05-31','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(68,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-06-03','2023-06-03','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(69,1,1,7,10,13,1,'1-02-2023_23-bea44684','DPWEB','02-2023','Desarrollo de la Plataforma Web',2,'2023-06-07','2023-06-07','09:30:00','11:09:00',47,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:36:59','no',-1,-1,-1,-1,'si',NULL,'FM-301',NULL),(70,1,1,7,3,17,6,'1-02-2023_23-bbc9bb2e','INSTR-POO-I1','02-2023','Instructoria Programacion Orientada a Objetos',0,'2023-02-10','2023-02-10','08:00:00','09:29:00',25,'aprobado','Instructoria POO-I','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:43:05','no',0,0,0,25,'no',NULL,'Desconocido',NULL),(71,1,1,7,3,17,6,'1-02-2023_23-bbc9bb2e','INSTR-POO-I1','02-2023','Instructoria Programacion Orientada a Objetos',0,'2023-02-17','2023-02-17','08:00:00','09:29:00',25,'aprobado','Instructoria POO-I','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:43:05','no',0,0,0,25,'no',NULL,'Desconocido',NULL),(72,1,1,7,3,17,6,'1-02-2023_23-bbc9bb2e','INSTR-POO-I1','02-2023','Instructoria Programacion Orientada a Objetos',0,'2023-02-24','2023-02-24','08:00:00','09:29:00',25,'aprobado','Instructoria POO-I','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:43:05','no',0,0,0,25,'no',NULL,'Desconocido',NULL),(73,1,1,7,3,17,6,'1-02-2023_23-bbc9bb2e','INSTR-POO-I1','02-2023','Instructoria Programacion Orientada a Objetos',0,'2023-03-03','2023-03-03','08:00:00','09:29:00',25,'aprobado','Instructoria POO-I','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:43:05','no',0,0,0,25,'no',NULL,'Desconocido',NULL),(74,1,1,7,3,17,6,'1-02-2023_23-bbc9bb2e','INSTR-POO-I1','02-2023','Instructoria Programacion Orientada a Objetos',0,'2023-03-10','2023-03-10','08:00:00','09:29:00',25,'aprobado','Instructoria POO-I','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:43:05','no',0,0,0,25,'no',NULL,'Desconocido',NULL),(75,1,1,7,3,17,6,'1-02-2023_23-bbc9bb2e','INSTR-POO-I1','02-2023','Instructoria Programacion Orientada a Objetos',0,'2023-03-17','2023-03-17','08:00:00','09:29:00',25,'aprobado','Instructoria POO-I','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:43:05','no',0,0,0,25,'no',NULL,'Desconocido',NULL),(76,1,1,7,3,17,6,'1-02-2023_23-bbc9bb2e','INSTR-POO-I1','02-2023','Instructoria Programacion Orientada a Objetos',0,'2023-03-24','2023-03-24','08:00:00','09:29:00',25,'aprobado','Instructoria POO-I','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:43:05','no',0,0,0,25,'no',NULL,'Desconocido',NULL),(77,1,1,7,3,17,6,'1-02-2023_23-bbc9bb2e','INSTR-POO-I1','02-2023','Instructoria Programacion Orientada a Objetos',0,'2023-03-31','2023-03-31','08:00:00','09:29:00',25,'aprobado','Instructoria POO-I','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:43:05','no',0,0,0,25,'no',NULL,'Desconocido',NULL),(78,1,1,7,3,17,6,'1-02-2023_23-bbc9bb2e','INSTR-POO-I1','02-2023','Instructoria Programacion Orientada a Objetos',0,'2023-04-14','2023-04-14','08:00:00','09:29:00',25,'aprobado','Instructoria POO-I','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:43:05','no',0,0,0,25,'no',NULL,'Desconocido',NULL),(79,1,1,7,3,17,6,'1-02-2023_23-bbc9bb2e','INSTR-POO-I1','02-2023','Instructoria Programacion Orientada a Objetos',0,'2023-04-21','2023-04-21','08:00:00','09:29:00',25,'aprobado','Instructoria POO-I','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:43:05','no',0,0,0,25,'no',NULL,'Desconocido',NULL),(80,1,1,7,3,17,6,'1-02-2023_23-bbc9bb2e','INSTR-POO-I1','02-2023','Instructoria Programacion Orientada a Objetos',0,'2023-04-28','2023-04-28','08:00:00','09:29:00',25,'aprobado','Instructoria POO-I','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:43:05','no',0,0,0,25,'no',NULL,'Desconocido',NULL),(81,1,1,7,3,17,6,'1-02-2023_23-bbc9bb2e','INSTR-POO-I1','02-2023','Instructoria Programacion Orientada a Objetos',0,'2023-05-05','2023-05-05','08:00:00','09:29:00',25,'aprobado','Instructoria POO-I','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:43:05','no',0,0,0,25,'no',NULL,'Desconocido',NULL),(82,1,1,7,12,17,6,'1-02-2023_23-bbc9bb2e','INSTR-POO-I1','02-2023','Instructoria Programacion Orientada a Objetos',0,'2023-05-12','2023-05-12','08:00:00','09:29:00',25,'cancelada','Instructoria POO-I','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:43:05','no',0,0,0,0,'no',NULL,'Desconocido','DOCENTE NO LLEGARA'),(83,1,1,7,3,17,6,'1-02-2023_23-bbc9bb2e','INSTR-POO-I1','02-2023','Instructoria Programacion Orientada a Objetos',0,'2023-05-19','2023-05-19','08:00:00','09:29:00',25,'cancelada','Instructoria POO-I','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:43:05','no',0,0,0,0,'no',NULL,'Desconocido','NO LLEGARA'),(84,1,1,7,3,17,6,'1-02-2023_23-bbc9bb2e','INSTR-POO-I1','02-2023','Instructoria Programacion Orientada a Objetos',0,'2023-05-26','2023-05-26','08:00:00','09:29:00',25,'aprobado','Instructoria POO-I','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:43:05','no',0,0,0,25,'no',NULL,'Desconocido',NULL),(85,1,1,7,3,17,6,'1-02-2023_23-bbc9bb2e','INSTR-POO-I1','02-2023','Instructoria Programacion Orientada a Objetos',0,'2023-06-02','2023-06-02','08:00:00','09:29:00',25,'cancelada','Instructoria POO-I','Aprobado','Aprobado','no','daniel.rivera','2023-05-05 22:43:05','no',0,0,0,0,'no',NULL,'Desconocido','DOCENTE NO LLEGARA'),(86,1,1,7,2,33,4,'1-02-2023_23-4a5477e7','NI','02-2023','TOUR UTEC',0,'2023-05-08','2023-05-08','10:00:00','11:29:00',39,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-06 00:16:30','no',-1,-1,-1,-1,'no',NULL,'Desconocido',NULL),(87,1,1,7,2,33,4,'1-02-2023_23-4a5477e7','NI','02-2023','TOUR UTEC',0,'2023-05-09','2023-05-09','10:00:00','11:29:00',39,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-06 00:16:30','no',-1,-1,-1,-1,'no',NULL,'Desconocido',NULL),(88,1,1,7,2,33,4,'1-02-2023_23-4a5477e7','NI','02-2023','TOUR UTEC',0,'2023-05-11','2023-05-11','10:00:00','11:29:00',39,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-06 00:16:30','no',-1,-1,-1,-1,'no',NULL,'Desconocido',NULL),(89,1,1,7,2,33,4,'1-02-2023_23-4a5477e7','NI','02-2023','TOUR UTEC',0,'2023-05-12','2023-05-12','10:00:00','11:29:00',39,'aprobado','N/D','Aprobado','Aprobado','no','daniel.rivera','2023-05-06 00:16:30','no',-1,-1,-1,-1,'no',NULL,'Desconocido',NULL),(90,1,1,7,8,19,5,'1-02-2023_23-d433fdd7','CERT-BD','02-2023','Certificacion Basica Bases de Datos Relacionales',0,'2023-05-16','2023-05-16','06:00:00','12:59:00',73,'aprobado','N/D','Aprobado','APROBADO','no','daniel.rivera','2023-05-07 22:13:42','no',23,30,20,-1,'si','','Desconocido',NULL),(91,1,1,7,8,19,5,'1-02-2023_23-d433fdd7','CERT-BD','02-2023','Certificacion Basica Bases de Datos Relacionales',0,'2023-05-18','2023-05-18','06:00:00','12:59:00',73,'aprobado','N/D','Aprobado','APROBADO','no','daniel.rivera','2023-05-07 22:13:42','no',23,30,20,-1,'si','','Desconocido',NULL),(92,1,1,7,2,33,4,'1-02-2023_23-136dfd50','NI','02-2023','TOUR UTEC',0,'2023-05-08','2023-05-08','13:00:00','15:59:00',49,'cancelada','N/D','APROBADO','APROBADO','no','daniel.rivera','2023-05-08 19:51:13','no',0,0,0,0,'no','Juan Alberto Mendoza','Desconocido','CANCELADO'),(93,1,1,7,2,33,4,'1-02-2023_23-136dfd50','NI','02-2023','TOUR UTEC',0,'2023-05-12','2023-05-12','13:00:00','15:59:00',49,'aprobado','N/D','APROBADO','APROBADO','no','daniel.rivera','2023-05-08 19:51:13','no',-1,-1,-1,-1,'no','Juan Alberto Mendoza','Desconocido',NULL),(94,1,1,8,11,4,6,'1-02-2023_23-3e186f54','INSTR-INFORMATICA','02-2023','INSTRUCTORIA INFORMATICA',0,'2023-05-11','2023-05-11','12:00:00','13:29:00',29,'aprobado','INSTRUCTORIA','APROBADO','APROBADO','no','daniel.rivera','2023-05-08 20:18:53','no',-1,-1,-1,-1,'si','','BJ-400',NULL),(95,1,1,8,11,4,6,'1-02-2023_23-3e186f54','INSTR-INFORMATICA','02-2023','INSTRUCTORIA INFORMATICA',0,'2023-05-12','2023-05-12','12:00:00','13:29:00',29,'aprobado','INSTRUCTORIA','APROBADO','APROBADO','no','daniel.rivera','2023-05-08 20:18:53','no',-1,-1,-1,-1,'si','','BJ-400',NULL),(96,1,1,8,11,4,6,'1-02-2023_23-3e186f54','INSTR-INFORMATICA','02-2023','INSTRUCTORIA INFORMATICA',0,'2023-05-13','2023-05-13','12:00:00','13:29:00',29,'aprobado','INSTRUCTORIA','APROBADO','APROBADO','no','daniel.rivera','2023-05-08 20:18:53','no',-1,-1,-1,-1,'si','','BJ-400',NULL),(97,1,1,8,11,4,6,'1-02-2023_23-3e186f54','INSTR-INFORMATICA','02-2023','INSTRUCTORIA INFORMATICA',0,'2023-05-14','2023-05-14','12:00:00','13:29:00',29,'aprobado','INSTRUCTORIA','APROBADO','APROBADO','no','daniel.rivera','2023-05-08 20:18:53','no',-1,-1,-1,-1,'si','','BJ-400',NULL),(98,1,1,8,11,4,6,'1-02-2023_23-3e186f54','INSTR-INFORMATICA','02-2023','INSTRUCTORIA INFORMATICA',0,'2023-05-17','2023-05-17','12:00:00','13:29:00',29,'aprobado','INSTRUCTORIA','APROBADO','APROBADO','no','daniel.rivera','2023-05-08 20:18:53','no',-1,-1,-1,-1,'si','','BJ-400',NULL),(99,1,1,8,11,4,6,'1-02-2023_23-3e186f54','INSTR-INFORMATICA','02-2023','INSTRUCTORIA INFORMATICA',0,'2023-05-18','2023-05-18','12:00:00','13:29:00',29,'aprobado','INSTRUCTORIA','APROBADO','APROBADO','no','daniel.rivera','2023-05-08 20:18:53','no',-1,-1,-1,-1,'si','','BJ-400',NULL),(100,1,1,8,11,4,6,'1-02-2023_23-3e186f54','INSTR-INFORMATICA','02-2023','INSTRUCTORIA INFORMATICA',0,'2023-05-19','2023-05-19','12:00:00','13:29:00',29,'aprobado','INSTRUCTORIA','APROBADO','APROBADO','no','daniel.rivera','2023-05-08 20:18:53','no',-1,-1,-1,-1,'si','','BJ-400',NULL),(101,1,1,8,11,4,6,'1-02-2023_23-3e186f54','INSTR-INFORMATICA','02-2023','INSTRUCTORIA INFORMATICA',0,'2023-05-20','2023-05-20','12:00:00','13:29:00',29,'aprobado','INSTRUCTORIA','APROBADO','APROBADO','no','daniel.rivera','2023-05-08 20:18:53','no',-1,-1,-1,-1,'si','','BJ-400',NULL),(102,1,1,8,11,4,6,'1-02-2023_23-3e186f54','INSTR-INFORMATICA','02-2023','INSTRUCTORIA INFORMATICA',0,'2023-05-21','2023-05-21','12:00:00','13:29:00',29,'aprobado','INSTRUCTORIA','APROBADO','APROBADO','no','daniel.rivera','2023-05-08 20:18:53','no',-1,-1,-1,-1,'si','','BJ-400',NULL),(103,1,1,8,11,4,6,'1-02-2023_23-3e186f54','INSTR-INFORMATICA','02-2023','INSTRUCTORIA INFORMATICA',0,'2023-05-24','2023-05-24','12:00:00','13:29:00',29,'aprobado','INSTRUCTORIA','APROBADO','APROBADO','no','daniel.rivera','2023-05-08 20:18:53','no',-1,-1,-1,-1,'si','','BJ-400',NULL),(104,1,1,8,11,4,6,'1-02-2023_23-3e186f54','INSTR-INFORMATICA','02-2023','INSTRUCTORIA INFORMATICA',0,'2023-05-25','2023-05-25','12:00:00','13:29:00',29,'aprobado','INSTRUCTORIA','APROBADO','APROBADO','no','daniel.rivera','2023-05-08 20:18:53','no',-1,-1,-1,-1,'si','','BJ-400',NULL),(105,1,1,8,11,4,6,'1-02-2023_23-3e186f54','INSTR-INFORMATICA','02-2023','INSTRUCTORIA INFORMATICA',0,'2023-05-26','2023-05-26','12:00:00','13:29:00',29,'aprobado','INSTRUCTORIA','APROBADO','APROBADO','no','daniel.rivera','2023-05-08 20:18:53','no',-1,-1,-1,-1,'si','','BJ-400',NULL),(106,1,1,8,11,4,6,'1-02-2023_23-3e186f54','INSTR-INFORMATICA','02-2023','INSTRUCTORIA INFORMATICA',0,'2023-05-27','2023-05-27','12:00:00','13:29:00',29,'aprobado','INSTRUCTORIA','APROBADO','APROBADO','no','daniel.rivera','2023-05-08 20:18:53','no',-1,-1,-1,-1,'si','','BJ-400',NULL),(107,1,1,8,11,4,6,'1-02-2023_23-3e186f54','INSTR-INFORMATICA','02-2023','INSTRUCTORIA INFORMATICA',0,'2023-05-28','2023-05-28','12:00:00','13:29:00',29,'aprobado','INSTRUCTORIA','APROBADO','APROBADO','no','daniel.rivera','2023-05-08 20:18:53','no',-1,-1,-1,-1,'si','','BJ-400',NULL),(108,1,1,8,11,4,6,'1-02-2023_23-3e186f54','INSTR-INFORMATICA','02-2023','INSTRUCTORIA INFORMATICA',0,'2023-05-31','2023-05-31','12:00:00','13:29:00',29,'aprobado','INSTRUCTORIA','APROBADO','APROBADO','no','daniel.rivera','2023-05-08 20:18:53','no',-1,-1,-1,-1,'si','','BJ-400',NULL),(109,1,1,8,11,4,6,'1-02-2023_23-3e186f54','INSTR-INFORMATICA','02-2023','INSTRUCTORIA INFORMATICA',0,'2023-06-01','2023-06-01','12:00:00','13:29:00',29,'aprobado','INSTRUCTORIA','APROBADO','APROBADO','no','daniel.rivera','2023-05-08 20:18:53','no',-1,-1,-1,-1,'si','','BJ-400',NULL),(110,1,1,8,11,4,6,'1-02-2023_23-3e186f54','INSTR-INFORMATICA','02-2023','INSTRUCTORIA INFORMATICA',0,'2023-06-02','2023-06-02','12:00:00','13:29:00',29,'aprobado','INSTRUCTORIA','APROBADO','APROBADO','no','daniel.rivera','2023-05-08 20:18:53','no',-1,-1,-1,-1,'si','','BJ-400',NULL),(111,1,1,8,11,4,6,'1-02-2023_23-3e186f54','INSTR-INFORMATICA','02-2023','INSTRUCTORIA INFORMATICA',0,'2023-06-03','2023-06-03','12:00:00','13:29:00',29,'aprobado','INSTRUCTORIA','APROBADO','APROBADO','no','daniel.rivera','2023-05-08 20:18:53','no',-1,-1,-1,-1,'si','','BJ-400',NULL),(112,1,1,8,11,4,6,'1-02-2023_23-3e186f54','INSTR-INFORMATICA','02-2023','INSTRUCTORIA INFORMATICA',0,'2023-06-04','2023-06-04','12:00:00','13:29:00',29,'aprobado','INSTRUCTORIA','APROBADO','APROBADO','no','daniel.rivera','2023-05-08 20:18:53','no',-1,-1,-1,-1,'si','','BJ-400',NULL),(113,1,1,7,3,16,1,'1-02-2023_23-6dff97ef','DPWEB','02-2023','DESARROLLO DE LA PLATAFORMA WEB',1,'2023-05-14','2023-05-14','10:00:00','12:59:00',48,'aprobado','N/D','APROBADO','APROBADO','no','daniel.rivera','2023-05-09 21:28:06','no',27,21,0,0,'si','','FM-205',NULL),(114,1,1,7,3,16,1,'1-02-2023_23-6dff97ef','DPWEB','02-2023','DESARROLLO DE LA PLATAFORMA WEB',1,'2023-05-21','2023-05-21','10:00:00','12:59:00',48,'aprobado','N/D','APROBADO','APROBADO','no','daniel.rivera','2023-05-09 21:28:06','no',27,21,0,0,'si','','FM-205',NULL),(115,1,1,7,3,16,1,'1-02-2023_23-6dff97ef','DPWEB','02-2023','DESARROLLO DE LA PLATAFORMA WEB',1,'2023-05-28','2023-05-28','10:00:00','12:59:00',48,'aprobado','N/D','APROBADO','APROBADO','no','daniel.rivera','2023-05-09 21:28:06','no',27,21,0,0,'si','','FM-205',NULL),(116,1,1,7,3,16,1,'1-02-2023_23-6dff97ef','DPWEB','02-2023','DESARROLLO DE LA PLATAFORMA WEB',1,'2023-06-04','2023-06-04','10:00:00','12:59:00',48,'aprobado','N/D','APROBADO','APROBADO','no','daniel.rivera','2023-05-09 21:28:06','no',27,21,0,0,'si','','FM-205',NULL),(117,1,2,2,9,4,6,'1-02-2023_23-bce68dea','INSTR-INF1','02-2023','INSTRUCTORIA INFORMATICA',0,'2023-05-20','2023-05-20','13:00:00','14:59:00',34,'aprobado','INSTRUCTORIA','APROBADO','APROBADO','no','daniel.rivera','2023-05-11 21:29:44','no',-1,-1,-1,-1,'si','','BJ-200',NULL),(118,1,2,2,9,4,6,'1-02-2023_23-bce68dea','INSTR-INF1','02-2023','INSTRUCTORIA INFORMATICA',0,'2023-05-21','2023-05-21','13:00:00','14:59:00',34,'aprobado','INSTRUCTORIA','APROBADO','APROBADO','no','daniel.rivera','2023-05-11 21:29:44','no',-1,-1,-1,-1,'si','','BJ-200',NULL),(119,1,2,2,9,4,6,'1-02-2023_23-bce68dea','INSTR-INF1','02-2023','INSTRUCTORIA INFORMATICA',0,'2023-05-27','2023-05-27','13:00:00','14:59:00',34,'aprobado','INSTRUCTORIA','APROBADO','APROBADO','no','daniel.rivera','2023-05-11 21:29:44','no',-1,-1,-1,-1,'si','','BJ-200',NULL),(120,1,2,2,9,4,6,'1-02-2023_23-bce68dea','INSTR-INF1','02-2023','INSTRUCTORIA INFORMATICA',0,'2023-05-28','2023-05-28','13:00:00','14:59:00',34,'aprobado','INSTRUCTORIA','APROBADO','APROBADO','no','daniel.rivera','2023-05-11 21:29:44','no',-1,-1,-1,-1,'si','','BJ-200',NULL),(121,1,2,2,9,4,6,'1-02-2023_23-bce68dea','INSTR-INF1','02-2023','INSTRUCTORIA INFORMATICA',0,'2023-06-03','2023-06-03','13:00:00','14:59:00',34,'aprobado','INSTRUCTORIA','APROBADO','APROBADO','no','daniel.rivera','2023-05-11 21:29:44','no',-1,-1,-1,-1,'si','','BJ-200',NULL),(122,1,1,7,14,17,1,'1-02-2023_23-2cc1be2d','POO-I','02-2023','Programacion Orientada a Objetos',4,'2023-05-15','2023-05-15','08:00:00','09:29:00',38,'aprobado','N/D','APROBADO','APROBADO','no','daniel.rivera','2023-05-14 21:46:42','no',32,6,-1,-1,'si','','SB-200',NULL),(123,1,1,7,14,17,1,'1-02-2023_23-2cc1be2d','POO-I','02-2023','Programacion Orientada a Objetos',4,'2023-05-16','2023-05-16','08:00:00','09:29:00',38,'aprobado','N/D','APROBADO','APROBADO','no','daniel.rivera','2023-05-14 21:46:42','no',32,6,-1,-1,'si','','SB-200',NULL),(124,1,1,7,14,17,1,'1-02-2023_23-2cc1be2d','POO-I','02-2023','Programacion Orientada a Objetos',4,'2023-05-17','2023-05-17','08:00:00','09:29:00',38,'aprobado','N/D','APROBADO','APROBADO','no','daniel.rivera','2023-05-14 21:46:42','no',32,6,-1,-1,'si','','SB-200',NULL),(125,1,1,7,1,19,6,'1-02-2023_23-94d85532','INSTR-SQL','02-2023','INSTRUCTORIA BASES DE DATOS 1',0,'2023-05-15','2023-05-15','11:00:00','12:29:00',28,'denegada','INSTRUCTORIA','NO CUMPLE PARAMETROS',NULL,'no','daniel.rivera','2023-05-15 00:12:09','no',-1,-1,-1,-1,'no','','Desconocido',NULL),(126,1,1,7,14,23,1,'1-02-2023_23-e8852e4a','DPWEB-I','02-2023','Desarrollo de la Plataforma Web',2,'2023-05-17','2023-05-17','09:30:00','11:09:00',30,'aprobacioninicial','N/D','APROBADO',NULL,'no','daniel.rivera','2023-05-16 21:43:28','no',30,0,-1,-1,'si','','BJ-500',NULL),(127,1,1,7,14,23,1,'1-02-2023_23-e8852e4a','DPWEB-I','02-2023','Desarrollo de la Plataforma Web',2,'2023-05-20','2023-05-20','09:30:00','11:09:00',30,'aprobacioninicial','N/D','APROBADO',NULL,'no','daniel.rivera','2023-05-16 21:43:28','no',30,0,-1,-1,'si','','BJ-500',NULL),(128,1,1,7,3,23,1,'1-02-2023_23-f7f6d8b0','DPWEB-I','02-2023','Desarrollo de la Plataforma Web',5,'2023-05-17','2023-05-17','09:30:00','11:09:00',46,'pendiente','N/D',NULL,NULL,'no',NULL,'2023-05-16 21:55:52','no',27,19,0,0,'si',NULL,'BJ-201',NULL),(129,1,1,7,3,23,1,'1-02-2023_23-f7f6d8b0','DPWEB-I','02-2023','Desarrollo de la Plataforma Web',5,'2023-05-20','2023-05-20','09:30:00','11:09:00',46,'pendiente','N/D',NULL,NULL,'no',NULL,'2023-05-16 21:55:52','no',27,19,0,0,'si',NULL,'BJ-201',NULL);
/*!40000 ALTER TABLE `reservaciones` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `EnvioNotificacionesCambioEstadoAprobacionInicialReservaciones` AFTER UPDATE ON `reservaciones` FOR EACH ROW BEGIN
INSERT INTO notificaciones (idusuarios, titulonotificacion, descripcion_notificacion, idclasificacion, ocultarnotificacion)
SELECT CONCAT(new.idusuarios), CONCAT("Su solicitud de reservación: ", new.codigounico_identificador, " se ha actualizado"), CONCAT("Por favor revise la sección *Mis Reservaciones*. Estado: ", new.estadoreservacion), CONCAT(4), CONCAT("no")
FROM dual
WHERE NOT EXISTS (
    SELECT *
    FROM notificaciones
    WHERE idusuarios = CONCAT(new.idusuarios)
      AND descripcion_notificacion = CONCAT("Por favor revise la sección *Mis Reservaciones*. Estado: ", new.estadoreservacion)
      AND idclasificacion = CONCAT(4)
      AND ocultarnotificacion = CONCAT("no")
      AND titulonotificacion = CONCAT("Su solicitud de reservación: ", new.codigounico_identificador, " se ha actualizado")
) AND new.codigounico_identificador = new.codigounico_identificador AND new.estadoreservacion = 'aprobacioninicial'
LIMIT 1;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `EnvioNotificacionesCambioEstadoDenegadasReservaciones` AFTER UPDATE ON `reservaciones` FOR EACH ROW BEGIN
INSERT INTO notificaciones (idusuarios, titulonotificacion, descripcion_notificacion, idclasificacion, ocultarnotificacion)
SELECT CONCAT(new.idusuarios), CONCAT("Su solicitud de reservación: ", new.codigounico_identificador, " se ha denegado"), CONCAT("Por favor revise la sección *Mis Reservaciones*. Estado: ", new.estadoreservacion), CONCAT(2), CONCAT("no")
FROM dual
WHERE NOT EXISTS (
    SELECT *
    FROM notificaciones
    WHERE idusuarios = CONCAT(new.idusuarios)
      AND descripcion_notificacion = CONCAT("Por favor revise la sección *Mis Reservaciones*. Estado: ", new.estadoreservacion)
      AND idclasificacion = CONCAT(2)
      AND ocultarnotificacion = CONCAT("no")
      AND titulonotificacion = CONCAT("Su solicitud de reservación: ", new.codigounico_identificador, " se ha denegado")
) AND new.codigounico_identificador = new.codigounico_identificador AND new.estadoreservacion = 'denegada'
LIMIT 1;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `EnvioNotificacionesCambioEstadoAprobadasReservaciones` AFTER UPDATE ON `reservaciones` FOR EACH ROW BEGIN
INSERT INTO notificaciones (idusuarios, titulonotificacion, descripcion_notificacion, idclasificacion, ocultarnotificacion)
SELECT CONCAT(new.idusuarios), CONCAT("Su solicitud de reservación: ", new.codigounico_identificador, " se ha aprobado"), CONCAT("Por favor revise la sección *Mis Reservaciones*. Estado: ", new.estadoreservacion), CONCAT(1), CONCAT("no")
FROM dual
WHERE NOT EXISTS (
    SELECT *
    FROM notificaciones
    WHERE idusuarios = CONCAT(new.idusuarios)
      AND descripcion_notificacion = CONCAT("Por favor revise la sección *Mis Reservaciones*. Estado: ", new.estadoreservacion)
      AND idclasificacion = CONCAT(1)
      AND ocultarnotificacion = CONCAT("no")
      AND titulonotificacion = CONCAT("Su solicitud de reservación: ", new.codigounico_identificador, " se ha aprobado")
) AND new.codigounico_identificador = new.codigounico_identificador AND new.estadoreservacion = 'aprobado'
LIMIT 1;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `EnvioNotificacionesCambioEstadoCanceladoReservaciones` AFTER UPDATE ON `reservaciones` FOR EACH ROW BEGIN
INSERT INTO notificaciones (idusuarios, titulonotificacion, descripcion_notificacion, idclasificacion, ocultarnotificacion)
SELECT CONCAT(new.idusuarios), CONCAT("Su solicitud de reservación: ", new.codigounico_identificador, " se ha cancelado exitosamente"), CONCAT("Por favor revise la sección *Mis Reservaciones*. Estado: ", new.estadoreservacion), CONCAT(5), CONCAT("no")
FROM dual
WHERE NOT EXISTS (
    SELECT *
    FROM notificaciones
    WHERE idusuarios = CONCAT(new.idusuarios)
      AND descripcion_notificacion = CONCAT("Por favor revise la sección *Mis Reservaciones*. Estado: ", new.estadoreservacion)
      AND idclasificacion = CONCAT(5)
      AND ocultarnotificacion = CONCAT("no")
      AND titulonotificacion = CONCAT("Su solicitud de reservación: ", new.codigounico_identificador, " se ha cancelado exitosamente")
) AND new.codigounico_identificador = new.codigounico_identificador AND new.estadoreservacion = 'cancelado'
LIMIT 1;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `EnvioNotificacionesReservacionIndividualCancelada` AFTER UPDATE ON `reservaciones` FOR EACH ROW BEGIN
INSERT INTO notificaciones (idusuarios,titulonotificacion,descripcion_notificacion,idclasificacion,ocultarnotificacion) SELECT CONCAT(new.idusuarios),CONCAT("Su reservación bajo el identificador: ",new.codigounico_identificador," se ha cancelado"),CONCAT("En fecha y horario: ",new.fechainicioreservacion," - ",new.horainicioreservacion," Ha sido cancelada"),CONCAT(6),CONCAT("no") WHERE new.idreservacion AND new.estadoreservacion = 'cancelada';
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `idrolusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombrerolusuario` varchar(50) NOT NULL,
  `descripcionrolusuario` varchar(100) NOT NULL,
  PRIMARY KEY (`idrolusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Coordinador de Laboratorios','Administrador general de sistema, coordinador general de laboratorios..'),(2,'Administrador de Laboratorios','Usuarios asignados a un laboratorio especifico. Administradores de uno o varios laboratorios.'),(3,'Docente','Todos los docentes de las diferentes facultades de la universidad.'),(4,'dsnkdsnkfdmkfdkmdfd','fdnjfdnfdndfnk\r\n'),(5,'fgmldfmllmfdlmdf','fdmkdfkmdfkmkdfmdf');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seguimiento_reservaciones`
--

DROP TABLE IF EXISTS `seguimiento_reservaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seguimiento_reservaciones` (
  `idseguimiento` int(11) NOT NULL AUTO_INCREMENT,
  `idreservacion` int(11) NOT NULL,
  `idfacultad` int(11) NOT NULL,
  `idescuela` int(11) NOT NULL,
  `idlaboratorio` int(11) NOT NULL,
  `idaplicacion` int(11) NOT NULL,
  `idtiporeservacion` int(11) NOT NULL,
  `codigounico_identificador` varchar(100) NOT NULL,
  `dividio_grupo` char(2) NOT NULL,
  `cantidad_grupos` int(11) DEFAULT NULL,
  `cantidadusuarios` varchar(255) NOT NULL,
  `ciclo` varchar(8) NOT NULL,
  `fecharegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `idusuarios` int(11) NOT NULL,
  PRIMARY KEY (`idseguimiento`),
  KEY `fk_reservaciones-seguimiento` (`idreservacion`),
  KEY `fk_facultad-seguimiento` (`idfacultad`),
  KEY `fk_escuela-seguimiento` (`idescuela`),
  KEY `fk_laboratorio-seguimiento` (`idlaboratorio`),
  KEY `fk_aplicaciones-seguimiento` (`idaplicacion`),
  KEY `fk_usuarios-seguimiento` (`idusuarios`),
  CONSTRAINT `fk_aplicaciones-seguimiento` FOREIGN KEY (`idaplicacion`) REFERENCES `aplicaciones_laboratorios` (`idaplicacion`),
  CONSTRAINT `fk_escuela-seguimiento` FOREIGN KEY (`idescuela`) REFERENCES `escuelas` (`idescuela`),
  CONSTRAINT `fk_facultad-seguimiento` FOREIGN KEY (`idfacultad`) REFERENCES `facultades` (`idfacultad`),
  CONSTRAINT `fk_laboratorio-seguimiento` FOREIGN KEY (`idlaboratorio`) REFERENCES `laboratorios` (`idlaboratorio`),
  CONSTRAINT `fk_reservaciones-seguimiento` FOREIGN KEY (`idreservacion`) REFERENCES `reservaciones` (`idreservacion`),
  CONSTRAINT `fk_usuarios-seguimiento` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seguimiento_reservaciones`
--

LOCK TABLES `seguimiento_reservaciones` WRITE;
/*!40000 ALTER TABLE `seguimiento_reservaciones` DISABLE KEYS */;
INSERT INTO `seguimiento_reservaciones` VALUES (28,1,1,7,3,19,1,'1-02-2023_23-1d5d5652','no',0,'30','02-2023','2023-05-09 21:09:13',1);
/*!40000 ALTER TABLE `seguimiento_reservaciones` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `ActualizarEstadoCompletoSeguimiento` AFTER INSERT ON `seguimiento_reservaciones` FOR EACH ROW UPDATE reservaciones SET completo_seguimiento='si' WHERE idreservacion=new.idreservacion */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `tipo_reservaciones`
--

DROP TABLE IF EXISTS `tipo_reservaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_reservaciones` (
  `idtiporeservacion` int(11) NOT NULL AUTO_INCREMENT,
  `tiporeservacion` varchar(255) NOT NULL,
  `descripciontiporeservacion` varchar(255) NOT NULL,
  PRIMARY KEY (`idtiporeservacion`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_reservaciones`
--

LOCK TABLES `tipo_reservaciones` WRITE;
/*!40000 ALTER TABLE `tipo_reservaciones` DISABLE KEYS */;
INSERT INTO `tipo_reservaciones` VALUES (1,'Práctica Programada (Clases)','Práctica programada hora clase, para todas las asignaturas que requieran el uso de los laboratorios de informática'),(2,'Cursos Libres','Diferentes cursos libres, ofrecidos a la comunidad estudiantil o terceros'),(3,'Seminarios','Diferentes seminarios ofrecidos en las asignaturas requeridas'),(4,'Tour Utec','Tour ofrecido a potenciales estudiantes de nuevo ingreso UTEC'),(5,'Certificaciones','Diferentes certificaciones ofrecidas a la comunidad estudiantil o público en general.'),(6,'Otras','Diferentes tipos de reservaciones a las establecidas, pueden ser prácticas libres, u otra actividad fuera de la programación ordinaria'),(7,'knnkjnkdkmkmd','fdkndfnkjdfkdf');
/*!40000 ALTER TABLE `tipo_reservaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `idusuarios` int(11) NOT NULL AUTO_INCREMENT,
  `idrolusuario` int(11) NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `codigousuario` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `fotoperfil` varchar(255) NOT NULL DEFAULT 'icon-fotoperfildefecto.gif',
  `contrasenia` varchar(255) NOT NULL,
  `nuevousuario` char(2) NOT NULL DEFAULT 'si',
  `ultimo_cambio_contrasenia` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado_usuario` varchar(15) NOT NULL DEFAULT 'activo',
  `lab1` char(2) NOT NULL,
  `lab2` char(2) NOT NULL,
  `lab3` char(2) NOT NULL,
  `lab4` char(2) NOT NULL,
  `lab5` char(2) NOT NULL,
  `lab6` char(2) NOT NULL,
  `lab7` char(2) NOT NULL,
  `lab8` char(2) NOT NULL,
  `lab9` char(2) NOT NULL,
  `lab10` char(2) NOT NULL,
  `lab11` char(2) NOT NULL,
  `lab12` char(2) NOT NULL,
  `lab13` char(2) NOT NULL,
  `lab14` char(2) NOT NULL,
  `lab15` char(2) NOT NULL,
  `completarperfil` char(2) NOT NULL DEFAULT 'no',
  `ubic_lab1` varchar(255) DEFAULT NULL,
  `ubic_lab2` varchar(255) DEFAULT NULL,
  `ubic_lab3` varchar(255) DEFAULT NULL,
  `ubic_lab4` varchar(255) DEFAULT NULL,
  `ubic_lab5` varchar(255) DEFAULT NULL,
  `ubic_lab6` varchar(255) DEFAULT NULL,
  `ubic_lab7` varchar(255) DEFAULT NULL,
  `ubic_lab8` varchar(255) DEFAULT NULL,
  `ubic_lab9` varchar(255) DEFAULT NULL,
  `ubic_lab10` varchar(255) DEFAULT NULL,
  `ubic_lab11` varchar(255) DEFAULT NULL,
  `ubic_lab12` varchar(255) DEFAULT NULL,
  `ubic_lab13` varchar(255) DEFAULT NULL,
  `ubic_lab14` varchar(255) DEFAULT NULL,
  `ubic_lab15` varchar(255) DEFAULT NULL,
  `extensiones` varchar(500) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idusuarios`),
  UNIQUE KEY `codigousuario` (`codigousuario`),
  UNIQUE KEY `correo` (`correo`),
  KEY `fk_usuarios-roles` (`idrolusuario`),
  CONSTRAINT `fk_usuarios-roles` FOREIGN KEY (`idrolusuario`) REFERENCES `roles` (`idrolusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,2,'Daniel','Rivera','daniel.rivera','dieselmods1@gmail.com','icon-fotoperfildefecto.gif','$argon2i$v=19$m=65536,t=4,p=2$emV4Ljg1TnNWTU9WSi4wUQ$f+ydUWVcfJec6v4lUf5nGuI9MhQZsCCkp8ydMAvASnM','no','2023-05-14 22:48:13','activo','no','no','si','si','si','si','si','si','si','si','si','si','si','si','si','si','bjj','bjj','bjj','bjj','bjj','bjj','bjj','bjj','bjj','bjj','bjj','bjj','bjj','bjj','bjj','8822','2023-02-28 20:47:12'),(2,1,'Daniel','Martinez','daniel.martinez','proyectosedmr@gmail.com','icon-fotoperfildefecto.gif','$argon2i$v=19$m=65536,t=4,p=2$emV4Ljg1TnNWTU9WSi4wUQ$f+ydUWVcfJec6v4lUf5nGuI9MhQZsCCkp8ydMAvASnM','si','2023-04-15 05:06:51','activo','si','si','si','si','si','si','si','si','si','si','si','si','si','si','si','si','n/d','n/d','n/d','n/d','n/d','n/d','n/d','n/d','n/d','n/d','n/d','n/d','n/d','n/d','n/d','n/d','2023-04-15 05:06:51'),(3,2,'Elias','Martinez','elias.martinez','2700772019@mail.utec.edu.sv','icon-fotoperfildefecto.gif','$argon2i$v=19$m=65536,t=4,p=2$eDBBNUJrM1F6WDVZQlNjaA$WJWdpkomt3AQPrZG1cz52BA2yOnDppVX8dg0y/lEQ7M','si','2023-04-15 05:44:10','activo','si','si','si','no','no','no','no','si','no','no','no','no','no','no','si','si','Francisco Morazan LAB1','Francisco Morazan LAB2','Benito Juarez LAB3','n/d','n/d','n/d','n/d','n/d','n/d','n/d','n/d','n/d','n/d','n/d','Francisco Morazan LAB15','8878,8879','2023-04-15 05:09:20'),(4,1,'fdkmdfmkdf','dfnkfdndfnkdf','fdkmdfkkdf','dfnkdfk@akvjf.es','icon-fotoperfildefecto.gif','$argon2i$v=19$m=65536,t=4,p=1$QjRaZ001di5xV0NBMmo2Vg$+xR8uPGkodgO9v7uqzZ+mhwdyDDSnNck6nnH4yPc3SA','si','2023-05-11 21:10:59','activo','si','si','si','si','si','si','si','si','si','si','si','si','si','si','si','si','n/d','n/d','n/d','n/d','n/d','n/d','n/d','n/d','n/d','n/d','n/d','n/d','n/d','n/d','n/d','n/d','2023-05-11 21:10:59'),(5,1,'sdmksdmksd','dsnkdsnksd','dskmndskmds','dsnksdnksd@fdjkdfk.es','icon-fotoperfildefecto.gif','$argon2i$v=19$m=65536,t=4,p=1$VHJ2RHNIdFlkL2wxUTFGWA$kLOTFljcVutkmFihj6sa4FyKuGkP/BXdSEPI7KkwZbs','si','2023-05-11 21:11:57','activo','si','si','si','si','si','si','si','si','si','si','si','si','si','si','si','si','n/d','n/d','n/d','n/d','n/d','n/d','n/d','n/d','n/d','n/d','n/d','n/d','n/d','n/d','n/d','n/d','2023-05-11 21:11:57');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `vista_aplicacionesinstaladas_laboratorio1`
--

DROP TABLE IF EXISTS `vista_aplicacionesinstaladas_laboratorio1`;
/*!50001 DROP VIEW IF EXISTS `vista_aplicacionesinstaladas_laboratorio1`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_aplicacionesinstaladas_laboratorio1` AS SELECT 
 1 AS `idaplicacion`,
 1 AS `codigoaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `fecharegistro`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_aplicacionesinstaladas_laboratorio10`
--

DROP TABLE IF EXISTS `vista_aplicacionesinstaladas_laboratorio10`;
/*!50001 DROP VIEW IF EXISTS `vista_aplicacionesinstaladas_laboratorio10`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_aplicacionesinstaladas_laboratorio10` AS SELECT 
 1 AS `idaplicacion`,
 1 AS `codigoaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `fecharegistro`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_aplicacionesinstaladas_laboratorio11`
--

DROP TABLE IF EXISTS `vista_aplicacionesinstaladas_laboratorio11`;
/*!50001 DROP VIEW IF EXISTS `vista_aplicacionesinstaladas_laboratorio11`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_aplicacionesinstaladas_laboratorio11` AS SELECT 
 1 AS `idaplicacion`,
 1 AS `codigoaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `fecharegistro`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_aplicacionesinstaladas_laboratorio12`
--

DROP TABLE IF EXISTS `vista_aplicacionesinstaladas_laboratorio12`;
/*!50001 DROP VIEW IF EXISTS `vista_aplicacionesinstaladas_laboratorio12`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_aplicacionesinstaladas_laboratorio12` AS SELECT 
 1 AS `idaplicacion`,
 1 AS `codigoaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `fecharegistro`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_aplicacionesinstaladas_laboratorio13`
--

DROP TABLE IF EXISTS `vista_aplicacionesinstaladas_laboratorio13`;
/*!50001 DROP VIEW IF EXISTS `vista_aplicacionesinstaladas_laboratorio13`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_aplicacionesinstaladas_laboratorio13` AS SELECT 
 1 AS `idaplicacion`,
 1 AS `codigoaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `fecharegistro`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_aplicacionesinstaladas_laboratorio14`
--

DROP TABLE IF EXISTS `vista_aplicacionesinstaladas_laboratorio14`;
/*!50001 DROP VIEW IF EXISTS `vista_aplicacionesinstaladas_laboratorio14`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_aplicacionesinstaladas_laboratorio14` AS SELECT 
 1 AS `idaplicacion`,
 1 AS `codigoaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `fecharegistro`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_aplicacionesinstaladas_laboratorio15`
--

DROP TABLE IF EXISTS `vista_aplicacionesinstaladas_laboratorio15`;
/*!50001 DROP VIEW IF EXISTS `vista_aplicacionesinstaladas_laboratorio15`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_aplicacionesinstaladas_laboratorio15` AS SELECT 
 1 AS `idaplicacion`,
 1 AS `codigoaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `fecharegistro`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_aplicacionesinstaladas_laboratorio2`
--

DROP TABLE IF EXISTS `vista_aplicacionesinstaladas_laboratorio2`;
/*!50001 DROP VIEW IF EXISTS `vista_aplicacionesinstaladas_laboratorio2`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_aplicacionesinstaladas_laboratorio2` AS SELECT 
 1 AS `idaplicacion`,
 1 AS `codigoaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `fecharegistro`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_aplicacionesinstaladas_laboratorio3`
--

DROP TABLE IF EXISTS `vista_aplicacionesinstaladas_laboratorio3`;
/*!50001 DROP VIEW IF EXISTS `vista_aplicacionesinstaladas_laboratorio3`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_aplicacionesinstaladas_laboratorio3` AS SELECT 
 1 AS `idaplicacion`,
 1 AS `codigoaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `fecharegistro`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_aplicacionesinstaladas_laboratorio4`
--

DROP TABLE IF EXISTS `vista_aplicacionesinstaladas_laboratorio4`;
/*!50001 DROP VIEW IF EXISTS `vista_aplicacionesinstaladas_laboratorio4`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_aplicacionesinstaladas_laboratorio4` AS SELECT 
 1 AS `idaplicacion`,
 1 AS `codigoaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `fecharegistro`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_aplicacionesinstaladas_laboratorio5`
--

DROP TABLE IF EXISTS `vista_aplicacionesinstaladas_laboratorio5`;
/*!50001 DROP VIEW IF EXISTS `vista_aplicacionesinstaladas_laboratorio5`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_aplicacionesinstaladas_laboratorio5` AS SELECT 
 1 AS `idaplicacion`,
 1 AS `codigoaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `fecharegistro`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_aplicacionesinstaladas_laboratorio6`
--

DROP TABLE IF EXISTS `vista_aplicacionesinstaladas_laboratorio6`;
/*!50001 DROP VIEW IF EXISTS `vista_aplicacionesinstaladas_laboratorio6`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_aplicacionesinstaladas_laboratorio6` AS SELECT 
 1 AS `idaplicacion`,
 1 AS `codigoaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `fecharegistro`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_aplicacionesinstaladas_laboratorio7`
--

DROP TABLE IF EXISTS `vista_aplicacionesinstaladas_laboratorio7`;
/*!50001 DROP VIEW IF EXISTS `vista_aplicacionesinstaladas_laboratorio7`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_aplicacionesinstaladas_laboratorio7` AS SELECT 
 1 AS `idaplicacion`,
 1 AS `codigoaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `fecharegistro`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_aplicacionesinstaladas_laboratorio8`
--

DROP TABLE IF EXISTS `vista_aplicacionesinstaladas_laboratorio8`;
/*!50001 DROP VIEW IF EXISTS `vista_aplicacionesinstaladas_laboratorio8`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_aplicacionesinstaladas_laboratorio8` AS SELECT 
 1 AS `idaplicacion`,
 1 AS `codigoaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `fecharegistro`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_aplicacionesinstaladas_laboratorio9`
--

DROP TABLE IF EXISTS `vista_aplicacionesinstaladas_laboratorio9`;
/*!50001 DROP VIEW IF EXISTS `vista_aplicacionesinstaladas_laboratorio9`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_aplicacionesinstaladas_laboratorio9` AS SELECT 
 1 AS `idaplicacion`,
 1 AS `codigoaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `fecharegistro`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_autenticacionusuarios`
--

DROP TABLE IF EXISTS `vista_autenticacionusuarios`;
/*!50001 DROP VIEW IF EXISTS `vista_autenticacionusuarios`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_autenticacionusuarios` AS SELECT 
 1 AS `idusuarios`,
 1 AS `idrolusuario`,
 1 AS `nombres`,
 1 AS `apellidos`,
 1 AS `codigousuario`,
 1 AS `correo`,
 1 AS `fotoperfil`,
 1 AS `contrasenia`,
 1 AS `nuevousuario`,
 1 AS `ultimo_cambio_contrasenia`,
 1 AS `ContadorCambioContrasenia`,
 1 AS `estado_usuario`,
 1 AS `fecha_registro`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_clasificacion_aplicaciones_laboratorios`
--

DROP TABLE IF EXISTS `vista_clasificacion_aplicaciones_laboratorios`;
/*!50001 DROP VIEW IF EXISTS `vista_clasificacion_aplicaciones_laboratorios`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_clasificacion_aplicaciones_laboratorios` AS SELECT 
 1 AS `idclasificacionlaboratorio`,
 1 AS `codigoclasificacionlaboratorio`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_clasificacion_notificacionesregistradas`
--

DROP TABLE IF EXISTS `vista_clasificacion_notificacionesregistradas`;
/*!50001 DROP VIEW IF EXISTS `vista_clasificacion_notificacionesregistradas`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_clasificacion_notificacionesregistradas` AS SELECT 
 1 AS `idclasificacion`,
 1 AS `codigoclasificacion`,
 1 AS `descripcionclasificacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_consultaaplicacionesreservacion`
--

DROP TABLE IF EXISTS `vista_consultaaplicacionesreservacion`;
/*!50001 DROP VIEW IF EXISTS `vista_consultaaplicacionesreservacion`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_consultaaplicacionesreservacion` AS SELECT 
 1 AS `idaplicacion`,
 1 AS `lab1`,
 1 AS `lab2`,
 1 AS `lab3`,
 1 AS `lab4`,
 1 AS `lab5`,
 1 AS `lab6`,
 1 AS `lab7`,
 1 AS `lab8`,
 1 AS `lab9`,
 1 AS `lab10`,
 1 AS `lab11`,
 1 AS `lab12`,
 1 AS `lab13`,
 1 AS `lab14`,
 1 AS `lab15`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_consultabandejaentradamensajeriausuarios`
--

DROP TABLE IF EXISTS `vista_consultabandejaentradamensajeriausuarios`;
/*!50001 DROP VIEW IF EXISTS `vista_consultabandejaentradamensajeriausuarios`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_consultabandejaentradamensajeriausuarios` AS SELECT 
 1 AS `idmensajeria`,
 1 AS `idusuarios`,
 1 AS `idusuarios_destinatario`,
 1 AS `nombres`,
 1 AS `apellidos`,
 1 AS `fotoperfil`,
 1 AS `nombremensaje`,
 1 AS `asuntomensaje`,
 1 AS `detallemensaje`,
 1 AS `fechamensaje`,
 1 AS `mensajeleido`,
 1 AS `archivo_adjunto`,
 1 AS `ocultarmensaje`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_consultacorreoactualizacionreservaciones`
--

DROP TABLE IF EXISTS `vista_consultacorreoactualizacionreservaciones`;
/*!50001 DROP VIEW IF EXISTS `vista_consultacorreoactualizacionreservaciones`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_consultacorreoactualizacionreservaciones` AS SELECT 
 1 AS `idreservacion`,
 1 AS `codigounico_identificador`,
 1 AS `idusuarios`,
 1 AS `codigousuario`,
 1 AS `correo`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_consultacorreousuariosreservaciones`
--

DROP TABLE IF EXISTS `vista_consultacorreousuariosreservaciones`;
/*!50001 DROP VIEW IF EXISTS `vista_consultacorreousuariosreservaciones`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_consultacorreousuariosreservaciones` AS SELECT 
 1 AS `idreservacion`,
 1 AS `codigounico_identificador`,
 1 AS `idusuarios`,
 1 AS `codigousuario`,
 1 AS `correo`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_consultadatosaplicacionesreservaciones`
--

DROP TABLE IF EXISTS `vista_consultadatosaplicacionesreservaciones`;
/*!50001 DROP VIEW IF EXISTS `vista_consultadatosaplicacionesreservaciones`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_consultadatosaplicacionesreservaciones` AS SELECT 
 1 AS `idaplicacion`,
 1 AS `nombreaplicacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_consultaespecificagestionreservaciones`
--

DROP TABLE IF EXISTS `vista_consultaespecificagestionreservaciones`;
/*!50001 DROP VIEW IF EXISTS `vista_consultaespecificagestionreservaciones`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_consultaespecificagestionreservaciones` AS SELECT 
 1 AS `idreservacion`,
 1 AS `idusuarios`,
 1 AS `idlaboratorio`,
 1 AS `idtiporeservacion`,
 1 AS `nombres`,
 1 AS `apellidos`,
 1 AS `codigousuario`,
 1 AS `codigolaboratorio`,
 1 AS `nombrelaboratorio`,
 1 AS `capacidadlaboratorio`,
 1 AS `maquinasfuerauso`,
 1 AS `tiporeservacion`,
 1 AS `codigounico_identificador`,
 1 AS `codigoreservacion`,
 1 AS `ciclo`,
 1 AS `nombrereservacion`,
 1 AS `seccionreservacion`,
 1 AS `fechainicioreservacion`,
 1 AS `fechafinreservacion`,
 1 AS `horainicioreservacion`,
 1 AS `horafinreservacion`,
 1 AS `numerousuarios`,
 1 AS `otrotipo_reservacion`,
 1 AS `comentario_adminlaboratorios`,
 1 AS `comentario_coordlaboratorio`,
 1 AS `estadoreservacion`,
 1 AS `finalizado`,
 1 AS `idfacultad`,
 1 AS `nombrefacultad`,
 1 AS `idescuela`,
 1 AS `nombre_escuela`,
 1 AS `idaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `usuario_gestion`,
 1 AS `fecharegistro`,
 1 AS `completo_seguimiento`,
 1 AS `mod1`,
 1 AS `mod2`,
 1 AS `mod3`,
 1 AS `mod4`,
 1 AS `titular_reservacion`,
 1 AS `nombre_otrotitular`,
 1 AS `aula_procedencia`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_consultaestadousuarios`
--

DROP TABLE IF EXISTS `vista_consultaestadousuarios`;
/*!50001 DROP VIEW IF EXISTS `vista_consultaestadousuarios`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_consultaestadousuarios` AS SELECT 
 1 AS `idusuarios`,
 1 AS `codigousuario`,
 1 AS `estado_usuario`,
 1 AS `lab1`,
 1 AS `lab2`,
 1 AS `lab3`,
 1 AS `lab4`,
 1 AS `lab5`,
 1 AS `lab6`,
 1 AS `lab7`,
 1 AS `lab8`,
 1 AS `lab9`,
 1 AS `lab10`,
 1 AS `lab11`,
 1 AS `lab12`,
 1 AS `lab13`,
 1 AS `lab14`,
 1 AS `lab15`,
 1 AS `nuevousuario`,
 1 AS `completarperfil`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_consultageneralusuarios_registrados`
--

DROP TABLE IF EXISTS `vista_consultageneralusuarios_registrados`;
/*!50001 DROP VIEW IF EXISTS `vista_consultageneralusuarios_registrados`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_consultageneralusuarios_registrados` AS SELECT 
 1 AS `idusuarios`,
 1 AS `idrolusuario`,
 1 AS `nombrerolusuario`,
 1 AS `nombres`,
 1 AS `apellidos`,
 1 AS `codigousuario`,
 1 AS `correo`,
 1 AS `fotoperfil`,
 1 AS `nuevousuario`,
 1 AS `estado_usuario`,
 1 AS `fecha_registro`,
 1 AS `lab1`,
 1 AS `lab2`,
 1 AS `lab3`,
 1 AS `lab4`,
 1 AS `lab5`,
 1 AS `lab6`,
 1 AS `lab7`,
 1 AS `lab8`,
 1 AS `lab9`,
 1 AS `lab10`,
 1 AS `lab11`,
 1 AS `lab12`,
 1 AS `lab13`,
 1 AS `lab14`,
 1 AS `lab15`,
 1 AS `ubic_lab1`,
 1 AS `ubic_lab2`,
 1 AS `ubic_lab3`,
 1 AS `ubic_lab4`,
 1 AS `ubic_lab5`,
 1 AS `ubic_lab6`,
 1 AS `ubic_lab7`,
 1 AS `ubic_lab8`,
 1 AS `ubic_lab9`,
 1 AS `ubic_lab10`,
 1 AS `ubic_lab11`,
 1 AS `ubic_lab12`,
 1 AS `ubic_lab13`,
 1 AS `ubic_lab14`,
 1 AS `ubic_lab15`,
 1 AS `extensiones`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_consultalaboratoriosreservaciones`
--

DROP TABLE IF EXISTS `vista_consultalaboratoriosreservaciones`;
/*!50001 DROP VIEW IF EXISTS `vista_consultalaboratoriosreservaciones`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_consultalaboratoriosreservaciones` AS SELECT 
 1 AS `idlaboratorio`,
 1 AS `codigolaboratorio`,
 1 AS `nombrelaboratorio`,
 1 AS `capacidadlaboratorio`,
 1 AS `maquinasfuerauso`,
 1 AS `estadolaboratorio`,
 1 AS `mod1`,
 1 AS `mod2`,
 1 AS `mod3`,
 1 AS `mod4`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_consultareservacionesaprobadas_gestionreservaciones`
--

DROP TABLE IF EXISTS `vista_consultareservacionesaprobadas_gestionreservaciones`;
/*!50001 DROP VIEW IF EXISTS `vista_consultareservacionesaprobadas_gestionreservaciones`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_consultareservacionesaprobadas_gestionreservaciones` AS SELECT 
 1 AS `idreservacion`,
 1 AS `codigounico_identificador`,
 1 AS `codigoreservacion`,
 1 AS `nombrereservacion`,
 1 AS `seccionreservacion`,
 1 AS `fechainicioreservacion`,
 1 AS `fechafinreservacion`,
 1 AS `horainicioreservacion`,
 1 AS `horafinreservacion`,
 1 AS `idlaboratorio`,
 1 AS `estadoreservacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_consultatelefonosenviosms`
--

DROP TABLE IF EXISTS `vista_consultatelefonosenviosms`;
/*!50001 DROP VIEW IF EXISTS `vista_consultatelefonosenviosms`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_consultatelefonosenviosms` AS SELECT 
 1 AS `idreservacion`,
 1 AS `codigounico_identificador`,
 1 AS `telefonoprincipal`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_consultausuariosasignadoslaboratorios`
--

DROP TABLE IF EXISTS `vista_consultausuariosasignadoslaboratorios`;
/*!50001 DROP VIEW IF EXISTS `vista_consultausuariosasignadoslaboratorios`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_consultausuariosasignadoslaboratorios` AS SELECT 
 1 AS `idusuarios`,
 1 AS `nombres`,
 1 AS `apellidos`,
 1 AS `codigousuario`,
 1 AS `correo`,
 1 AS `lab1`,
 1 AS `lab2`,
 1 AS `lab3`,
 1 AS `lab4`,
 1 AS `lab5`,
 1 AS `lab6`,
 1 AS `lab7`,
 1 AS `lab8`,
 1 AS `lab9`,
 1 AS `lab10`,
 1 AS `lab11`,
 1 AS `lab12`,
 1 AS `lab13`,
 1 AS `lab14`,
 1 AS `lab15`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_conteoiniciocoordinadorlaboratorios`
--

DROP TABLE IF EXISTS `vista_conteoiniciocoordinadorlaboratorios`;
/*!50001 DROP VIEW IF EXISTS `vista_conteoiniciocoordinadorlaboratorios`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_conteoiniciocoordinadorlaboratorios` AS SELECT 
 1 AS `CantidadAdministradoresLaboratorios`,
 1 AS `CantidadDocentes`,
 1 AS `CantidadLaboratoriosInactivos`,
 1 AS `CantidadAplicaciones`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_detallereservacionesregistradas`
--

DROP TABLE IF EXISTS `vista_detallereservacionesregistradas`;
/*!50001 DROP VIEW IF EXISTS `vista_detallereservacionesregistradas`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_detallereservacionesregistradas` AS SELECT 
 1 AS `idreservacion`,
 1 AS `idaplicacion`,
 1 AS `idusuarios`,
 1 AS `idlaboratorio`,
 1 AS `idtiporeservacion`,
 1 AS `idfacultad`,
 1 AS `idescuela`,
 1 AS `nombres`,
 1 AS `apellidos`,
 1 AS `codigousuario`,
 1 AS `codigolaboratorio`,
 1 AS `nombrelaboratorio`,
 1 AS `tiporeservacion`,
 1 AS `codigounico_identificador`,
 1 AS `codigoreservacion`,
 1 AS `ciclo`,
 1 AS `nombrereservacion`,
 1 AS `seccionreservacion`,
 1 AS `fechainicioreservacion`,
 1 AS `fechafinreservacion`,
 1 AS `horainicioreservacion`,
 1 AS `horafinreservacion`,
 1 AS `numerousuarios`,
 1 AS `otrotipo_reservacion`,
 1 AS `comentario_adminlaboratorios`,
 1 AS `comentario_coordlaboratorio`,
 1 AS `estadoreservacion`,
 1 AS `finalizado`,
 1 AS `fecharegistro`,
 1 AS `completo_seguimiento`,
 1 AS `mod1`,
 1 AS `mod2`,
 1 AS `mod3`,
 1 AS `mod4`,
 1 AS `titular_reservacion`,
 1 AS `nombre_otrotitular`,
 1 AS `aula_procedencia`,
 1 AS `comentario_cancelacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_detallespefilusuarios`
--

DROP TABLE IF EXISTS `vista_detallespefilusuarios`;
/*!50001 DROP VIEW IF EXISTS `vista_detallespefilusuarios`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_detallespefilusuarios` AS SELECT 
 1 AS `idusuarios`,
 1 AS `idrolusuario`,
 1 AS `nombres`,
 1 AS `apellidos`,
 1 AS `codigousuario`,
 1 AS `correo`,
 1 AS `fotoperfil`,
 1 AS `ultimo_cambio_contrasenia`,
 1 AS `estado_usuario`,
 1 AS `fecha_registro`,
 1 AS `telefonoprincipal`,
 1 AS `genero`,
 1 AS `fechanacimiento`,
 1 AS `estadocivil`,
 1 AS `lab1`,
 1 AS `lab2`,
 1 AS `lab3`,
 1 AS `lab4`,
 1 AS `lab5`,
 1 AS `lab6`,
 1 AS `lab7`,
 1 AS `lab8`,
 1 AS `lab9`,
 1 AS `lab10`,
 1 AS `lab11`,
 1 AS `lab12`,
 1 AS `lab13`,
 1 AS `lab14`,
 1 AS `lab15`,
 1 AS `ubic_lab1`,
 1 AS `ubic_lab2`,
 1 AS `ubic_lab3`,
 1 AS `ubic_lab4`,
 1 AS `ubic_lab5`,
 1 AS `ubic_lab6`,
 1 AS `ubic_lab7`,
 1 AS `ubic_lab8`,
 1 AS `ubic_lab9`,
 1 AS `ubic_lab10`,
 1 AS `ubic_lab11`,
 1 AS `ubic_lab12`,
 1 AS `ubic_lab13`,
 1 AS `ubic_lab14`,
 1 AS `ubic_lab15`,
 1 AS `extensiones`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_disponibilidadreservaciones`
--

DROP TABLE IF EXISTS `vista_disponibilidadreservaciones`;
/*!50001 DROP VIEW IF EXISTS `vista_disponibilidadreservaciones`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_disponibilidadreservaciones` AS SELECT 
 1 AS `idreservacion`,
 1 AS `idlaboratorio`,
 1 AS `codigolaboratorio`,
 1 AS `fechafinreservacion`,
 1 AS `fechainicioreservacion`,
 1 AS `horafinreservacion`,
 1 AS `horainicioreservacion`,
 1 AS `estadoreservacion`,
 1 AS `numerousuarios`,
 1 AS `mod1`,
 1 AS `mod2`,
 1 AS `mod3`,
 1 AS `mod4`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_informaciongenerallaboratoriosreservaciones`
--

DROP TABLE IF EXISTS `vista_informaciongenerallaboratoriosreservaciones`;
/*!50001 DROP VIEW IF EXISTS `vista_informaciongenerallaboratoriosreservaciones`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_informaciongenerallaboratoriosreservaciones` AS SELECT 
 1 AS `idlaboratorio`,
 1 AS `codigolaboratorio`,
 1 AS `nombrelaboratorio`,
 1 AS `capacidadreal`,
 1 AS `estadolaboratorio`,
 1 AS `codigocolor`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_ingresosusuarios_iniciosesiones`
--

DROP TABLE IF EXISTS `vista_ingresosusuarios_iniciosesiones`;
/*!50001 DROP VIEW IF EXISTS `vista_ingresosusuarios_iniciosesiones`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_ingresosusuarios_iniciosesiones` AS SELECT 
 1 AS `idacceso`,
 1 AS `fecha_ingreso`,
 1 AS `fecha_cierresesion`,
 1 AS `duracion_sesion`,
 1 AS `idusuarios`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_laboratoriosasignadosusuarios`
--

DROP TABLE IF EXISTS `vista_laboratoriosasignadosusuarios`;
/*!50001 DROP VIEW IF EXISTS `vista_laboratoriosasignadosusuarios`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_laboratoriosasignadosusuarios` AS SELECT 
 1 AS `idusuarios`,
 1 AS `codigousuario`,
 1 AS `idrolusuario`,
 1 AS `lab1`,
 1 AS `lab2`,
 1 AS `lab3`,
 1 AS `lab4`,
 1 AS `lab5`,
 1 AS `lab6`,
 1 AS `lab7`,
 1 AS `lab8`,
 1 AS `lab9`,
 1 AS `lab10`,
 1 AS `lab11`,
 1 AS `lab12`,
 1 AS `lab13`,
 1 AS `lab14`,
 1 AS `lab15`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_laboratoriosinformaticaregistrados`
--

DROP TABLE IF EXISTS `vista_laboratoriosinformaticaregistrados`;
/*!50001 DROP VIEW IF EXISTS `vista_laboratoriosinformaticaregistrados`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_laboratoriosinformaticaregistrados` AS SELECT 
 1 AS `idlaboratorio`,
 1 AS `codigolaboratorio`,
 1 AS `nombrelaboratorio`,
 1 AS `capacidadlaboratorio`,
 1 AS `maquinasfuerauso`,
 1 AS `estadolaboratorio`,
 1 AS `codigocolor`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_listadoescuelasfacultades`
--

DROP TABLE IF EXISTS `vista_listadoescuelasfacultades`;
/*!50001 DROP VIEW IF EXISTS `vista_listadoescuelasfacultades`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_listadoescuelasfacultades` AS SELECT 
 1 AS `idescuela`,
 1 AS `nombre_escuela`,
 1 AS `idfacultad`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_listadofacultadesregistradas`
--

DROP TABLE IF EXISTS `vista_listadofacultadesregistradas`;
/*!50001 DROP VIEW IF EXISTS `vista_listadofacultadesregistradas`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_listadofacultadesregistradas` AS SELECT 
 1 AS `idfacultad`,
 1 AS `nombrefacultad`,
 1 AS `codigofacultad`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_listadogeneralaplicacionesinstaladaslaboratorios`
--

DROP TABLE IF EXISTS `vista_listadogeneralaplicacionesinstaladaslaboratorios`;
/*!50001 DROP VIEW IF EXISTS `vista_listadogeneralaplicacionesinstaladaslaboratorios`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_listadogeneralaplicacionesinstaladaslaboratorios` AS SELECT 
 1 AS `idaplicacion`,
 1 AS `codigoaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `lab1`,
 1 AS `lab2`,
 1 AS `lab3`,
 1 AS `lab4`,
 1 AS `lab5`,
 1 AS `lab6`,
 1 AS `lab7`,
 1 AS `lab8`,
 1 AS `lab9`,
 1 AS `lab10`,
 1 AS `lab11`,
 1 AS `lab12`,
 1 AS `lab13`,
 1 AS `lab14`,
 1 AS `lab15`,
 1 AS `idclasificacionlaboratorio`,
 1 AS `codigoclasificacionlaboratorio`,
 1 AS `fecharegistro`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_listadonotificacionesrecibidas`
--

DROP TABLE IF EXISTS `vista_listadonotificacionesrecibidas`;
/*!50001 DROP VIEW IF EXISTS `vista_listadonotificacionesrecibidas`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_listadonotificacionesrecibidas` AS SELECT 
 1 AS `idnotificaciones`,
 1 AS `idusuarios`,
 1 AS `titulonotificacion`,
 1 AS `descripcion_notificacion`,
 1 AS `fechanotificacion`,
 1 AS `idclasificacion`,
 1 AS `codigoclasificacion`,
 1 AS `ocultarnotificacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_listadoreportesplataformaregistrados`
--

DROP TABLE IF EXISTS `vista_listadoreportesplataformaregistrados`;
/*!50001 DROP VIEW IF EXISTS `vista_listadoreportesplataformaregistrados`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_listadoreportesplataformaregistrados` AS SELECT 
 1 AS `idmanifiesto`,
 1 AS `idusuarios`,
 1 AS `nombres`,
 1 AS `apellidos`,
 1 AS `codigousuario`,
 1 AS `nombremanifiesto`,
 1 AS `descripcionmanifiesto`,
 1 AS `fotomanifiesto`,
 1 AS `fecharegistro`,
 1 AS `fecha_actualizacion`,
 1 AS `estado`,
 1 AS `comentario_actualizacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_listadotiposreservaciones`
--

DROP TABLE IF EXISTS `vista_listadotiposreservaciones`;
/*!50001 DROP VIEW IF EXISTS `vista_listadotiposreservaciones`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_listadotiposreservaciones` AS SELECT 
 1 AS `idtiporeservacion`,
 1 AS `tiporeservacion`,
 1 AS `descripciontiporeservacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_practicalibresfinalizadas`
--

DROP TABLE IF EXISTS `vista_practicalibresfinalizadas`;
/*!50001 DROP VIEW IF EXISTS `vista_practicalibresfinalizadas`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_practicalibresfinalizadas` AS SELECT 
 1 AS `idpracticalibre`,
 1 AS `idaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `idlaboratorio`,
 1 AS `idfacultad`,
 1 AS `nombrefacultad`,
 1 AS `idusuarios`,
 1 AS `nombreusuario_reservacion`,
 1 AS `carneusuario_reservacion`,
 1 AS `fechainicio`,
 1 AS `horainicio`,
 1 AS `horafin`,
 1 AS `ciclo`,
 1 AS `estado`,
 1 AS `quienregistro`,
 1 AS `duracionpractica`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_practicalibresfinalizadaslab1`
--

DROP TABLE IF EXISTS `vista_practicalibresfinalizadaslab1`;
/*!50001 DROP VIEW IF EXISTS `vista_practicalibresfinalizadaslab1`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_practicalibresfinalizadaslab1` AS SELECT 
 1 AS `idpracticalibre`,
 1 AS `idaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `idlaboratorio`,
 1 AS `idfacultad`,
 1 AS `nombrefacultad`,
 1 AS `idusuarios`,
 1 AS `nombreusuario_reservacion`,
 1 AS `carneusuario_reservacion`,
 1 AS `fechainicio`,
 1 AS `horainicio`,
 1 AS `horafin`,
 1 AS `ciclo`,
 1 AS `estado`,
 1 AS `quienregistro`,
 1 AS `duracionpractica`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_practicalibresfinalizadaslab10`
--

DROP TABLE IF EXISTS `vista_practicalibresfinalizadaslab10`;
/*!50001 DROP VIEW IF EXISTS `vista_practicalibresfinalizadaslab10`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_practicalibresfinalizadaslab10` AS SELECT 
 1 AS `idpracticalibre`,
 1 AS `idaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `idlaboratorio`,
 1 AS `idfacultad`,
 1 AS `nombrefacultad`,
 1 AS `idusuarios`,
 1 AS `nombreusuario_reservacion`,
 1 AS `carneusuario_reservacion`,
 1 AS `fechainicio`,
 1 AS `horainicio`,
 1 AS `horafin`,
 1 AS `ciclo`,
 1 AS `estado`,
 1 AS `quienregistro`,
 1 AS `duracionpractica`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_practicalibresfinalizadaslab11`
--

DROP TABLE IF EXISTS `vista_practicalibresfinalizadaslab11`;
/*!50001 DROP VIEW IF EXISTS `vista_practicalibresfinalizadaslab11`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_practicalibresfinalizadaslab11` AS SELECT 
 1 AS `idpracticalibre`,
 1 AS `idaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `idlaboratorio`,
 1 AS `idfacultad`,
 1 AS `nombrefacultad`,
 1 AS `idusuarios`,
 1 AS `nombreusuario_reservacion`,
 1 AS `carneusuario_reservacion`,
 1 AS `fechainicio`,
 1 AS `horainicio`,
 1 AS `horafin`,
 1 AS `ciclo`,
 1 AS `estado`,
 1 AS `quienregistro`,
 1 AS `duracionpractica`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_practicalibresfinalizadaslab12`
--

DROP TABLE IF EXISTS `vista_practicalibresfinalizadaslab12`;
/*!50001 DROP VIEW IF EXISTS `vista_practicalibresfinalizadaslab12`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_practicalibresfinalizadaslab12` AS SELECT 
 1 AS `idpracticalibre`,
 1 AS `idaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `idlaboratorio`,
 1 AS `idfacultad`,
 1 AS `nombrefacultad`,
 1 AS `idusuarios`,
 1 AS `nombreusuario_reservacion`,
 1 AS `carneusuario_reservacion`,
 1 AS `fechainicio`,
 1 AS `horainicio`,
 1 AS `horafin`,
 1 AS `ciclo`,
 1 AS `estado`,
 1 AS `quienregistro`,
 1 AS `duracionpractica`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_practicalibresfinalizadaslab13`
--

DROP TABLE IF EXISTS `vista_practicalibresfinalizadaslab13`;
/*!50001 DROP VIEW IF EXISTS `vista_practicalibresfinalizadaslab13`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_practicalibresfinalizadaslab13` AS SELECT 
 1 AS `idpracticalibre`,
 1 AS `idaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `idlaboratorio`,
 1 AS `idfacultad`,
 1 AS `nombrefacultad`,
 1 AS `idusuarios`,
 1 AS `nombreusuario_reservacion`,
 1 AS `carneusuario_reservacion`,
 1 AS `fechainicio`,
 1 AS `horainicio`,
 1 AS `horafin`,
 1 AS `ciclo`,
 1 AS `estado`,
 1 AS `quienregistro`,
 1 AS `duracionpractica`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_practicalibresfinalizadaslab14`
--

DROP TABLE IF EXISTS `vista_practicalibresfinalizadaslab14`;
/*!50001 DROP VIEW IF EXISTS `vista_practicalibresfinalizadaslab14`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_practicalibresfinalizadaslab14` AS SELECT 
 1 AS `idpracticalibre`,
 1 AS `idaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `idlaboratorio`,
 1 AS `idfacultad`,
 1 AS `nombrefacultad`,
 1 AS `idusuarios`,
 1 AS `nombreusuario_reservacion`,
 1 AS `carneusuario_reservacion`,
 1 AS `fechainicio`,
 1 AS `horainicio`,
 1 AS `horafin`,
 1 AS `ciclo`,
 1 AS `estado`,
 1 AS `quienregistro`,
 1 AS `duracionpractica`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_practicalibresfinalizadaslab15`
--

DROP TABLE IF EXISTS `vista_practicalibresfinalizadaslab15`;
/*!50001 DROP VIEW IF EXISTS `vista_practicalibresfinalizadaslab15`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_practicalibresfinalizadaslab15` AS SELECT 
 1 AS `idpracticalibre`,
 1 AS `idaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `idlaboratorio`,
 1 AS `idfacultad`,
 1 AS `nombrefacultad`,
 1 AS `idusuarios`,
 1 AS `nombreusuario_reservacion`,
 1 AS `carneusuario_reservacion`,
 1 AS `fechainicio`,
 1 AS `horainicio`,
 1 AS `horafin`,
 1 AS `ciclo`,
 1 AS `estado`,
 1 AS `quienregistro`,
 1 AS `duracionpractica`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_practicalibresfinalizadaslab2`
--

DROP TABLE IF EXISTS `vista_practicalibresfinalizadaslab2`;
/*!50001 DROP VIEW IF EXISTS `vista_practicalibresfinalizadaslab2`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_practicalibresfinalizadaslab2` AS SELECT 
 1 AS `idpracticalibre`,
 1 AS `idaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `idlaboratorio`,
 1 AS `idfacultad`,
 1 AS `nombrefacultad`,
 1 AS `idusuarios`,
 1 AS `nombreusuario_reservacion`,
 1 AS `carneusuario_reservacion`,
 1 AS `fechainicio`,
 1 AS `horainicio`,
 1 AS `horafin`,
 1 AS `ciclo`,
 1 AS `estado`,
 1 AS `quienregistro`,
 1 AS `duracionpractica`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_practicalibresfinalizadaslab3`
--

DROP TABLE IF EXISTS `vista_practicalibresfinalizadaslab3`;
/*!50001 DROP VIEW IF EXISTS `vista_practicalibresfinalizadaslab3`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_practicalibresfinalizadaslab3` AS SELECT 
 1 AS `idpracticalibre`,
 1 AS `idaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `idlaboratorio`,
 1 AS `idfacultad`,
 1 AS `nombrefacultad`,
 1 AS `idusuarios`,
 1 AS `nombreusuario_reservacion`,
 1 AS `carneusuario_reservacion`,
 1 AS `fechainicio`,
 1 AS `horainicio`,
 1 AS `horafin`,
 1 AS `ciclo`,
 1 AS `estado`,
 1 AS `quienregistro`,
 1 AS `duracionpractica`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_practicalibresfinalizadaslab4`
--

DROP TABLE IF EXISTS `vista_practicalibresfinalizadaslab4`;
/*!50001 DROP VIEW IF EXISTS `vista_practicalibresfinalizadaslab4`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_practicalibresfinalizadaslab4` AS SELECT 
 1 AS `idpracticalibre`,
 1 AS `idaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `idlaboratorio`,
 1 AS `idfacultad`,
 1 AS `nombrefacultad`,
 1 AS `idusuarios`,
 1 AS `nombreusuario_reservacion`,
 1 AS `carneusuario_reservacion`,
 1 AS `fechainicio`,
 1 AS `horainicio`,
 1 AS `horafin`,
 1 AS `ciclo`,
 1 AS `estado`,
 1 AS `quienregistro`,
 1 AS `duracionpractica`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_practicalibresfinalizadaslab5`
--

DROP TABLE IF EXISTS `vista_practicalibresfinalizadaslab5`;
/*!50001 DROP VIEW IF EXISTS `vista_practicalibresfinalizadaslab5`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_practicalibresfinalizadaslab5` AS SELECT 
 1 AS `idpracticalibre`,
 1 AS `idaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `idlaboratorio`,
 1 AS `idfacultad`,
 1 AS `nombrefacultad`,
 1 AS `idusuarios`,
 1 AS `nombreusuario_reservacion`,
 1 AS `carneusuario_reservacion`,
 1 AS `fechainicio`,
 1 AS `horainicio`,
 1 AS `horafin`,
 1 AS `ciclo`,
 1 AS `estado`,
 1 AS `quienregistro`,
 1 AS `duracionpractica`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_practicalibresfinalizadaslab6`
--

DROP TABLE IF EXISTS `vista_practicalibresfinalizadaslab6`;
/*!50001 DROP VIEW IF EXISTS `vista_practicalibresfinalizadaslab6`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_practicalibresfinalizadaslab6` AS SELECT 
 1 AS `idpracticalibre`,
 1 AS `idaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `idlaboratorio`,
 1 AS `idfacultad`,
 1 AS `nombrefacultad`,
 1 AS `idusuarios`,
 1 AS `nombreusuario_reservacion`,
 1 AS `carneusuario_reservacion`,
 1 AS `fechainicio`,
 1 AS `horainicio`,
 1 AS `horafin`,
 1 AS `ciclo`,
 1 AS `estado`,
 1 AS `quienregistro`,
 1 AS `duracionpractica`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_practicalibresfinalizadaslab7`
--

DROP TABLE IF EXISTS `vista_practicalibresfinalizadaslab7`;
/*!50001 DROP VIEW IF EXISTS `vista_practicalibresfinalizadaslab7`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_practicalibresfinalizadaslab7` AS SELECT 
 1 AS `idpracticalibre`,
 1 AS `idaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `idlaboratorio`,
 1 AS `idfacultad`,
 1 AS `nombrefacultad`,
 1 AS `idusuarios`,
 1 AS `nombreusuario_reservacion`,
 1 AS `carneusuario_reservacion`,
 1 AS `fechainicio`,
 1 AS `horainicio`,
 1 AS `horafin`,
 1 AS `ciclo`,
 1 AS `estado`,
 1 AS `quienregistro`,
 1 AS `duracionpractica`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_practicalibresfinalizadaslab8`
--

DROP TABLE IF EXISTS `vista_practicalibresfinalizadaslab8`;
/*!50001 DROP VIEW IF EXISTS `vista_practicalibresfinalizadaslab8`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_practicalibresfinalizadaslab8` AS SELECT 
 1 AS `idpracticalibre`,
 1 AS `idaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `idlaboratorio`,
 1 AS `idfacultad`,
 1 AS `nombrefacultad`,
 1 AS `idusuarios`,
 1 AS `nombreusuario_reservacion`,
 1 AS `carneusuario_reservacion`,
 1 AS `fechainicio`,
 1 AS `horainicio`,
 1 AS `horafin`,
 1 AS `ciclo`,
 1 AS `estado`,
 1 AS `quienregistro`,
 1 AS `duracionpractica`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_practicalibresfinalizadaslab9`
--

DROP TABLE IF EXISTS `vista_practicalibresfinalizadaslab9`;
/*!50001 DROP VIEW IF EXISTS `vista_practicalibresfinalizadaslab9`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_practicalibresfinalizadaslab9` AS SELECT 
 1 AS `idpracticalibre`,
 1 AS `idaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `idlaboratorio`,
 1 AS `idfacultad`,
 1 AS `nombrefacultad`,
 1 AS `idusuarios`,
 1 AS `nombreusuario_reservacion`,
 1 AS `carneusuario_reservacion`,
 1 AS `fechainicio`,
 1 AS `horainicio`,
 1 AS `horafin`,
 1 AS `ciclo`,
 1 AS `estado`,
 1 AS `quienregistro`,
 1 AS `duracionpractica`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_practicaslibresprocesadas`
--

DROP TABLE IF EXISTS `vista_practicaslibresprocesadas`;
/*!50001 DROP VIEW IF EXISTS `vista_practicaslibresprocesadas`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_practicaslibresprocesadas` AS SELECT 
 1 AS `idpracticalibre`,
 1 AS `idaplicacion`,
 1 AS `idtiporeservacion`,
 1 AS `idlaboratorio`,
 1 AS `idfacultad`,
 1 AS `idusuarios`,
 1 AS `nombreaplicacion`,
 1 AS `nombrefacultad`,
 1 AS `nombreusuario_reservacion`,
 1 AS `carneusuario_reservacion`,
 1 AS `fechainicio`,
 1 AS `horainicio`,
 1 AS `horafin`,
 1 AS `ciclo`,
 1 AS `estado`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_proximareservacionlabotatorio1`
--

DROP TABLE IF EXISTS `vista_proximareservacionlabotatorio1`;
/*!50001 DROP VIEW IF EXISTS `vista_proximareservacionlabotatorio1`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_proximareservacionlabotatorio1` AS SELECT 
 1 AS `idreservacion`,
 1 AS `idlaboratorio`,
 1 AS `codigoreservacion`,
 1 AS `nombres`,
 1 AS `apellidos`,
 1 AS `nombrereservacion`,
 1 AS `fechainicioreservacion`,
 1 AS `horainicioreservacion`,
 1 AS `horafinreservacion`,
 1 AS `finalizado`,
 1 AS `fecharegistro`,
 1 AS `estadoreservacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_proximareservacionlabotatorio10`
--

DROP TABLE IF EXISTS `vista_proximareservacionlabotatorio10`;
/*!50001 DROP VIEW IF EXISTS `vista_proximareservacionlabotatorio10`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_proximareservacionlabotatorio10` AS SELECT 
 1 AS `idreservacion`,
 1 AS `idlaboratorio`,
 1 AS `codigoreservacion`,
 1 AS `nombres`,
 1 AS `apellidos`,
 1 AS `nombrereservacion`,
 1 AS `fechainicioreservacion`,
 1 AS `horainicioreservacion`,
 1 AS `horafinreservacion`,
 1 AS `finalizado`,
 1 AS `fecharegistro`,
 1 AS `estadoreservacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_proximareservacionlabotatorio11`
--

DROP TABLE IF EXISTS `vista_proximareservacionlabotatorio11`;
/*!50001 DROP VIEW IF EXISTS `vista_proximareservacionlabotatorio11`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_proximareservacionlabotatorio11` AS SELECT 
 1 AS `idreservacion`,
 1 AS `idlaboratorio`,
 1 AS `codigoreservacion`,
 1 AS `nombres`,
 1 AS `apellidos`,
 1 AS `nombrereservacion`,
 1 AS `fechainicioreservacion`,
 1 AS `horainicioreservacion`,
 1 AS `horafinreservacion`,
 1 AS `finalizado`,
 1 AS `fecharegistro`,
 1 AS `estadoreservacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_proximareservacionlabotatorio12`
--

DROP TABLE IF EXISTS `vista_proximareservacionlabotatorio12`;
/*!50001 DROP VIEW IF EXISTS `vista_proximareservacionlabotatorio12`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_proximareservacionlabotatorio12` AS SELECT 
 1 AS `idreservacion`,
 1 AS `idlaboratorio`,
 1 AS `codigoreservacion`,
 1 AS `nombres`,
 1 AS `apellidos`,
 1 AS `nombrereservacion`,
 1 AS `fechainicioreservacion`,
 1 AS `horainicioreservacion`,
 1 AS `horafinreservacion`,
 1 AS `finalizado`,
 1 AS `fecharegistro`,
 1 AS `estadoreservacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_proximareservacionlabotatorio13`
--

DROP TABLE IF EXISTS `vista_proximareservacionlabotatorio13`;
/*!50001 DROP VIEW IF EXISTS `vista_proximareservacionlabotatorio13`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_proximareservacionlabotatorio13` AS SELECT 
 1 AS `idreservacion`,
 1 AS `idlaboratorio`,
 1 AS `codigoreservacion`,
 1 AS `nombres`,
 1 AS `apellidos`,
 1 AS `nombrereservacion`,
 1 AS `fechainicioreservacion`,
 1 AS `horainicioreservacion`,
 1 AS `horafinreservacion`,
 1 AS `finalizado`,
 1 AS `fecharegistro`,
 1 AS `estadoreservacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_proximareservacionlabotatorio14`
--

DROP TABLE IF EXISTS `vista_proximareservacionlabotatorio14`;
/*!50001 DROP VIEW IF EXISTS `vista_proximareservacionlabotatorio14`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_proximareservacionlabotatorio14` AS SELECT 
 1 AS `idreservacion`,
 1 AS `idlaboratorio`,
 1 AS `codigoreservacion`,
 1 AS `nombres`,
 1 AS `apellidos`,
 1 AS `nombrereservacion`,
 1 AS `fechainicioreservacion`,
 1 AS `horainicioreservacion`,
 1 AS `horafinreservacion`,
 1 AS `finalizado`,
 1 AS `fecharegistro`,
 1 AS `estadoreservacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_proximareservacionlabotatorio15`
--

DROP TABLE IF EXISTS `vista_proximareservacionlabotatorio15`;
/*!50001 DROP VIEW IF EXISTS `vista_proximareservacionlabotatorio15`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_proximareservacionlabotatorio15` AS SELECT 
 1 AS `idreservacion`,
 1 AS `idlaboratorio`,
 1 AS `codigoreservacion`,
 1 AS `nombres`,
 1 AS `apellidos`,
 1 AS `nombrereservacion`,
 1 AS `fechainicioreservacion`,
 1 AS `horainicioreservacion`,
 1 AS `horafinreservacion`,
 1 AS `finalizado`,
 1 AS `fecharegistro`,
 1 AS `estadoreservacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_proximareservacionlabotatorio2`
--

DROP TABLE IF EXISTS `vista_proximareservacionlabotatorio2`;
/*!50001 DROP VIEW IF EXISTS `vista_proximareservacionlabotatorio2`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_proximareservacionlabotatorio2` AS SELECT 
 1 AS `idreservacion`,
 1 AS `idlaboratorio`,
 1 AS `codigoreservacion`,
 1 AS `nombres`,
 1 AS `apellidos`,
 1 AS `nombrereservacion`,
 1 AS `fechainicioreservacion`,
 1 AS `horainicioreservacion`,
 1 AS `horafinreservacion`,
 1 AS `finalizado`,
 1 AS `fecharegistro`,
 1 AS `estadoreservacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_proximareservacionlabotatorio3`
--

DROP TABLE IF EXISTS `vista_proximareservacionlabotatorio3`;
/*!50001 DROP VIEW IF EXISTS `vista_proximareservacionlabotatorio3`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_proximareservacionlabotatorio3` AS SELECT 
 1 AS `idreservacion`,
 1 AS `idlaboratorio`,
 1 AS `codigoreservacion`,
 1 AS `nombres`,
 1 AS `apellidos`,
 1 AS `nombrereservacion`,
 1 AS `fechainicioreservacion`,
 1 AS `horainicioreservacion`,
 1 AS `horafinreservacion`,
 1 AS `finalizado`,
 1 AS `fecharegistro`,
 1 AS `estadoreservacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_proximareservacionlabotatorio4`
--

DROP TABLE IF EXISTS `vista_proximareservacionlabotatorio4`;
/*!50001 DROP VIEW IF EXISTS `vista_proximareservacionlabotatorio4`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_proximareservacionlabotatorio4` AS SELECT 
 1 AS `idreservacion`,
 1 AS `idlaboratorio`,
 1 AS `codigoreservacion`,
 1 AS `nombres`,
 1 AS `apellidos`,
 1 AS `nombrereservacion`,
 1 AS `fechainicioreservacion`,
 1 AS `horainicioreservacion`,
 1 AS `horafinreservacion`,
 1 AS `finalizado`,
 1 AS `fecharegistro`,
 1 AS `estadoreservacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_proximareservacionlabotatorio5`
--

DROP TABLE IF EXISTS `vista_proximareservacionlabotatorio5`;
/*!50001 DROP VIEW IF EXISTS `vista_proximareservacionlabotatorio5`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_proximareservacionlabotatorio5` AS SELECT 
 1 AS `idreservacion`,
 1 AS `idlaboratorio`,
 1 AS `codigoreservacion`,
 1 AS `nombres`,
 1 AS `apellidos`,
 1 AS `nombrereservacion`,
 1 AS `fechainicioreservacion`,
 1 AS `horainicioreservacion`,
 1 AS `horafinreservacion`,
 1 AS `finalizado`,
 1 AS `fecharegistro`,
 1 AS `estadoreservacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_proximareservacionlabotatorio6`
--

DROP TABLE IF EXISTS `vista_proximareservacionlabotatorio6`;
/*!50001 DROP VIEW IF EXISTS `vista_proximareservacionlabotatorio6`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_proximareservacionlabotatorio6` AS SELECT 
 1 AS `idreservacion`,
 1 AS `idlaboratorio`,
 1 AS `codigoreservacion`,
 1 AS `nombres`,
 1 AS `apellidos`,
 1 AS `nombrereservacion`,
 1 AS `fechainicioreservacion`,
 1 AS `horainicioreservacion`,
 1 AS `horafinreservacion`,
 1 AS `finalizado`,
 1 AS `fecharegistro`,
 1 AS `estadoreservacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_proximareservacionlabotatorio7`
--

DROP TABLE IF EXISTS `vista_proximareservacionlabotatorio7`;
/*!50001 DROP VIEW IF EXISTS `vista_proximareservacionlabotatorio7`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_proximareservacionlabotatorio7` AS SELECT 
 1 AS `idreservacion`,
 1 AS `idlaboratorio`,
 1 AS `codigoreservacion`,
 1 AS `nombres`,
 1 AS `apellidos`,
 1 AS `nombrereservacion`,
 1 AS `fechainicioreservacion`,
 1 AS `horainicioreservacion`,
 1 AS `horafinreservacion`,
 1 AS `finalizado`,
 1 AS `fecharegistro`,
 1 AS `estadoreservacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_proximareservacionlabotatorio8`
--

DROP TABLE IF EXISTS `vista_proximareservacionlabotatorio8`;
/*!50001 DROP VIEW IF EXISTS `vista_proximareservacionlabotatorio8`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_proximareservacionlabotatorio8` AS SELECT 
 1 AS `idreservacion`,
 1 AS `idlaboratorio`,
 1 AS `codigoreservacion`,
 1 AS `nombres`,
 1 AS `apellidos`,
 1 AS `nombrereservacion`,
 1 AS `fechainicioreservacion`,
 1 AS `horainicioreservacion`,
 1 AS `horafinreservacion`,
 1 AS `finalizado`,
 1 AS `fecharegistro`,
 1 AS `estadoreservacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_proximareservacionlabotatorio9`
--

DROP TABLE IF EXISTS `vista_proximareservacionlabotatorio9`;
/*!50001 DROP VIEW IF EXISTS `vista_proximareservacionlabotatorio9`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_proximareservacionlabotatorio9` AS SELECT 
 1 AS `idreservacion`,
 1 AS `idlaboratorio`,
 1 AS `codigoreservacion`,
 1 AS `nombres`,
 1 AS `apellidos`,
 1 AS `nombrereservacion`,
 1 AS `fechainicioreservacion`,
 1 AS `horainicioreservacion`,
 1 AS `horafinreservacion`,
 1 AS `finalizado`,
 1 AS `fecharegistro`,
 1 AS `estadoreservacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_reservaciones`
--

DROP TABLE IF EXISTS `vista_reservaciones`;
/*!50001 DROP VIEW IF EXISTS `vista_reservaciones`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_reservaciones` AS SELECT 
 1 AS `idlaboratorio`,
 1 AS `codigoreservacion`,
 1 AS `nombres`,
 1 AS `apellidos`,
 1 AS `nombrereservacion`,
 1 AS `fechainicioreservacion`,
 1 AS `horainicioreservacion`,
 1 AS `horafinreservacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_reservacionescalendarioactividades_general`
--

DROP TABLE IF EXISTS `vista_reservacionescalendarioactividades_general`;
/*!50001 DROP VIEW IF EXISTS `vista_reservacionescalendarioactividades_general`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_reservacionescalendarioactividades_general` AS SELECT 
 1 AS `idreservacion`,
 1 AS `idusuarios`,
 1 AS `nombres`,
 1 AS `apellidos`,
 1 AS `codigousuario`,
 1 AS `idlaboratorio`,
 1 AS `codigolaboratorio`,
 1 AS `nombrelaboratorio`,
 1 AS `capacidadlaboratorio`,
 1 AS `idaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `idtiporeservacion`,
 1 AS `tiporeservacion`,
 1 AS `codigounico_identificador`,
 1 AS `codigoreservacion`,
 1 AS `ciclo`,
 1 AS `nombrereservacion`,
 1 AS `seccionreservacion`,
 1 AS `fechainicioreservacion`,
 1 AS `fechafinreservacion`,
 1 AS `horainicioreservacion`,
 1 AS `horafinreservacion`,
 1 AS `numerousuarios`,
 1 AS `estadoreservacion`,
 1 AS `fecharegistro`,
 1 AS `mod1`,
 1 AS `mod2`,
 1 AS `mod3`,
 1 AS `mod4`,
 1 AS `titular_reservacion`,
 1 AS `nombre_otrotitular`,
 1 AS `aula_procedencia`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_rolesusuariosregistrados`
--

DROP TABLE IF EXISTS `vista_rolesusuariosregistrados`;
/*!50001 DROP VIEW IF EXISTS `vista_rolesusuariosregistrados`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_rolesusuariosregistrados` AS SELECT 
 1 AS `idrolusuario`,
 1 AS `nombrerolusuario`,
 1 AS `descripcionrolusuario`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_seguimientoreservacionesfinalizadas`
--

DROP TABLE IF EXISTS `vista_seguimientoreservacionesfinalizadas`;
/*!50001 DROP VIEW IF EXISTS `vista_seguimientoreservacionesfinalizadas`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_seguimientoreservacionesfinalizadas` AS SELECT 
 1 AS `idseguimiento`,
 1 AS `idreservacion`,
 1 AS `codigounico_identificador`,
 1 AS `codigoreservacion`,
 1 AS `nombrereservacion`,
 1 AS `seccionreservacion`,
 1 AS `fechainicioreservacion`,
 1 AS `fechafinreservacion`,
 1 AS `horainicioreservacion`,
 1 AS `horafinreservacion`,
 1 AS `dividio_grupo`,
 1 AS `cantidad_grupos`,
 1 AS `cantidadusuarios`,
 1 AS `ciclo`,
 1 AS `nombres`,
 1 AS `apellidos`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_seleccionaraplicacionesregistradasreservaciones`
--

DROP TABLE IF EXISTS `vista_seleccionaraplicacionesregistradasreservaciones`;
/*!50001 DROP VIEW IF EXISTS `vista_seleccionaraplicacionesregistradasreservaciones`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_seleccionaraplicacionesregistradasreservaciones` AS SELECT 
 1 AS `idaplicacion`,
 1 AS `codigoaplicacion`,
 1 AS `nombreaplicacion`,
 1 AS `idclasificacionlaboratorio`,
 1 AS `fecharegistro`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_ultimasreservacionesaprobadasdocentes`
--

DROP TABLE IF EXISTS `vista_ultimasreservacionesaprobadasdocentes`;
/*!50001 DROP VIEW IF EXISTS `vista_ultimasreservacionesaprobadasdocentes`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_ultimasreservacionesaprobadasdocentes` AS SELECT 
 1 AS `idreservacion`,
 1 AS `idusuarios`,
 1 AS `codigoreservacion`,
 1 AS `nombrereservacion`,
 1 AS `ciclo`,
 1 AS `codigounico_identificador`,
 1 AS `fechainicioreservacion`,
 1 AS `fechafinreservacion`,
 1 AS `horainicioreservacion`,
 1 AS `horafinreservacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Dumping events for database 'control_laboratorios_utec'
--

--
-- Dumping routines for database 'control_laboratorios_utec'
--
/*!50003 DROP PROCEDURE IF EXISTS `sp_ActivarUsuarios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ActivarUsuarios`(IN `_idusuarios` INT)
BEGIN
	UPDATE usuarios SET estado_usuario="activo" WHERE idusuarios=_idusuarios;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ActualizacionConfiguracionCuentaUsuarios_ConFotoPerfil` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ActualizacionConfiguracionCuentaUsuarios_ConFotoPerfil`(IN `_idusuarios` INT, IN `_nombres` VARCHAR(255), IN `_apellidos` VARCHAR(255), IN `_correo` VARCHAR(255), IN `_fotoperfil` VARCHAR(255), IN `_contrasenia` VARCHAR(255), IN `_ultimo_cambio_contrasenia` TIMESTAMP)
BEGIN
	UPDATE usuarios SET nombres=_nombres, apellidos=_apellidos, correo=_correo, fotoperfil=_fotoperfil, contrasenia=_contrasenia, ultimo_cambio_contrasenia=_ultimo_cambio_contrasenia WHERE idusuarios=_idusuarios;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ActualizacionConfiguracionCuentaUsuarios_SinFotoPerfil` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ActualizacionConfiguracionCuentaUsuarios_SinFotoPerfil`(IN `_idusuarios` INT, IN `_nombres` VARCHAR(255), IN `_apellidos` VARCHAR(255), IN `_correo` VARCHAR(255), IN `_contrasenia` VARCHAR(255), IN `_ultimo_cambio_contrasenia` TIMESTAMP)
BEGIN
	UPDATE usuarios SET nombres=_nombres, apellidos=_apellidos, correo=_correo, contrasenia=_contrasenia, ultimo_cambio_contrasenia=_ultimo_cambio_contrasenia WHERE idusuarios=_idusuarios;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ActualizacionDatosGestionLaboratoriosInformatica` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ActualizacionDatosGestionLaboratoriosInformatica`(IN `_idlaboratorio` INT, IN `_codigolaboratorio` VARCHAR(15), IN `_nombrelaboratorio` VARCHAR(40), IN `_capacidadlaboratorio` INT, IN `_maquinasfuerauso` INT, IN `_estadolaboratorio` VARCHAR(25), IN `_codigocolor` TEXT)
BEGIN
	UPDATE laboratorios SET codigolaboratorio=_codigolaboratorio, nombrelaboratorio=_nombrelaboratorio, capacidadlaboratorio=_capacidadlaboratorio, maquinasfuerauso=_maquinasfuerauso, estadolaboratorio=_estadolaboratorio, codigocolor=_codigocolor WHERE idlaboratorio=_idlaboratorio;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ActualizacionDatosGestionLaboratoriosInformaticaAdminLabs` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ActualizacionDatosGestionLaboratoriosInformaticaAdminLabs`(IN `_idlaboratorio` INT, IN `_capacidadlaboratorio` INT, IN `_maquinasfuerauso` INT, IN `_estadolaboratorio` VARCHAR(25))
BEGIN
	UPDATE laboratorios SET capacidadlaboratorio=_capacidadlaboratorio, maquinasfuerauso=_maquinasfuerauso, estadolaboratorio=_estadolaboratorio
    WHERE idlaboratorio=_idlaboratorio;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ActualizacionDetallesUsuariosMiPerfil` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ActualizacionDetallesUsuariosMiPerfil`(IN `_idusuarios` INT, IN `_telefonoprincipal` VARCHAR(9), IN `_genero` CHAR(2), IN `_fechanacimiento` DATE, IN `_estadocivil` VARCHAR(25))
BEGIN
	UPDATE detallesusuarios SET telefonoprincipal=_telefonoprincipal, genero=_genero, fechanacimiento=_fechanacimiento, estadocivil=_estadocivil WHERE idusuarios=_idusuarios;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ActualizacionFinalEstadoReservaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ActualizacionFinalEstadoReservaciones`(IN `_codigounico_identificador` VARCHAR(100), IN `_estadoreservacion` VARCHAR(40), IN `_comentario_coordlaboratorio` VARCHAR(500), IN `_nombre_otrotitular` VARCHAR(255))
BEGIN
	UPDATE reservaciones SET estadoreservacion=_estadoreservacion, comentario_coordlaboratorio = _comentario_coordlaboratorio,
    nombre_otrotitular = _nombre_otrotitular WHERE codigounico_identificador = _codigounico_identificador;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ActualizacionInicialEstadoReservaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ActualizacionInicialEstadoReservaciones`(IN `_codigounico_identificador` VARCHAR(100), IN `_estadoreservacion` VARCHAR(40), IN `_comentario_adminlaboratorios` VARCHAR(500), IN `_usuario_gestion` VARCHAR(255), IN `_nombre_otrotitular` VARCHAR(255))
UPDATE reservaciones SET estadoreservacion=_estadoreservacion, comentario_adminlaboratorios = _comentario_adminlaboratorios, usuario_gestion = _usuario_gestion, nombre_otrotitular = _nombre_otrotitular WHERE codigounico_identificador = _codigounico_identificador ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ActualizacionReportesProblemasPlataforma` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ActualizacionReportesProblemasPlataforma`(IN `_idmanifiesto` INT, IN `_estado` VARCHAR(25), IN `_comentario_actualizacion` VARCHAR(700))
BEGIN
	UPDATE manifiestos_plataforma SET estado=_estado, comentario_actualizacion=_comentario_actualizacion WHERE idmanifiesto=_idmanifiesto;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_BloquearUsuarios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_BloquearUsuarios`(IN `_idusuarios` INT)
BEGIN
	UPDATE usuarios SET estado_usuario="bloqueado" WHERE idusuarios=_idusuarios;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_CambioContraseniaRecuperacion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_CambioContraseniaRecuperacion`(IN `_contrasenia` VARCHAR(255), IN `_correo` VARCHAR(255))
UPDATE usuarios SET contrasenia=_contrasenia, ultimo_cambio_contrasenia=current_timestamp() WHERE correo=_correo ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_CambioCredencialesNuevosUsuarios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_CambioCredencialesNuevosUsuarios`(IN `_idusuarios` INT, IN `_contrasenia` VARCHAR(255))
BEGIN
	UPDATE usuarios SET nuevousuario="no", ultimo_cambio_contrasenia = NOW(), contrasenia = _contrasenia  WHERE idusuarios = _idusuarios;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_CambioEstadoToken` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_CambioEstadoToken`(IN `_correo` VARCHAR(255), IN `_token` VARCHAR(255), IN `_codigo` INT, IN `_estado` VARCHAR(15))
UPDATE recuperacion SET estado="usado" WHERE correo=_correo AND token=_token AND codigo=_codigo ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_CancelarReservacionesProcesadasIndividualmente` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_CancelarReservacionesProcesadasIndividualmente`(IN `_idreservacion` INT, IN `_comentario_cancelacion` VARCHAR(500))
BEGIN
	UPDATE reservaciones SET estadoreservacion = 'cancelada', comentario_cancelacion = _comentario_cancelacion,
    mod1 = 0,
    mod2 = 0,
    mod3 = 0,
    mod4 = 0 
    WHERE idreservacion = _idreservacion;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaAccesosUsuarios_PerfilUsuarios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaAccesosUsuarios_PerfilUsuarios`(IN `_idusuarios` INT)
BEGIN 
	SELECT * FROM vista_ingresosusuarios_iniciosesiones WHERE idusuarios=_idusuarios;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaAplicacionesInstaladasLaboratorio1` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaAplicacionesInstaladasLaboratorio1`()
BEGIN
	SELECT * FROM vista_aplicacionesinstaladas_laboratorio1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaAplicacionesInstaladasLaboratorio10` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaAplicacionesInstaladasLaboratorio10`()
BEGIN
	SELECT * FROM vista_aplicacionesinstaladas_laboratorio10;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaAplicacionesInstaladasLaboratorio11` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaAplicacionesInstaladasLaboratorio11`()
BEGIN
	SELECT * FROM vista_aplicacionesinstaladas_laboratorio11;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaAplicacionesInstaladasLaboratorio12` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaAplicacionesInstaladasLaboratorio12`()
BEGIN
	SELECT * FROM vista_aplicacionesinstaladas_laboratorio12;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaAplicacionesInstaladasLaboratorio13` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaAplicacionesInstaladasLaboratorio13`()
BEGIN
	SELECT * FROM vista_aplicacionesinstaladas_laboratorio13;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaAplicacionesInstaladasLaboratorio14` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaAplicacionesInstaladasLaboratorio14`()
BEGIN
	SELECT * FROM vista_aplicacionesinstaladas_laboratorio14;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaAplicacionesInstaladasLaboratorio15` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaAplicacionesInstaladasLaboratorio15`()
BEGIN
	SELECT * FROM vista_aplicacionesinstaladas_laboratorio15;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaAplicacionesInstaladasLaboratorio2` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaAplicacionesInstaladasLaboratorio2`()
BEGIN
	SELECT * FROM vista_aplicacionesinstaladas_laboratorio2;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaAplicacionesInstaladasLaboratorio3` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaAplicacionesInstaladasLaboratorio3`()
BEGIN
	SELECT * FROM vista_aplicacionesinstaladas_laboratorio3;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaAplicacionesInstaladasLaboratorio4` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaAplicacionesInstaladasLaboratorio4`()
BEGIN
	SELECT * FROM vista_aplicacionesinstaladas_laboratorio4;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaAplicacionesInstaladasLaboratorio5` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaAplicacionesInstaladasLaboratorio5`()
BEGIN
	SELECT * FROM vista_aplicacionesinstaladas_laboratorio5;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaAplicacionesInstaladasLaboratorio6` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaAplicacionesInstaladasLaboratorio6`()
BEGIN
	SELECT * FROM vista_aplicacionesinstaladas_laboratorio6;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaAplicacionesInstaladasLaboratorio7` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaAplicacionesInstaladasLaboratorio7`()
BEGIN
	SELECT * FROM vista_aplicacionesinstaladas_laboratorio7;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaAplicacionesInstaladasLaboratorio8` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaAplicacionesInstaladasLaboratorio8`()
BEGIN
	SELECT * FROM vista_aplicacionesinstaladas_laboratorio8;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaAplicacionesInstaladasLaboratorio9` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaAplicacionesInstaladasLaboratorio9`()
BEGIN
	SELECT * FROM vista_aplicacionesinstaladas_laboratorio9;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaBandejaEntrada_MensajeriaUsuarios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaBandejaEntrada_MensajeriaUsuarios`(IN `_idusuarios_destinatario` INT)
SELECT * FROM vista_consultabandejaentradamensajeriausuarios WHERE idusuarios_destinatario=_idusuarios_destinatario AND ocultarmensaje="no" ORDER BY fechamensaje DESC LIMIT 50 ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaBandejaEntrada_MensajesOcultos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaBandejaEntrada_MensajesOcultos`(IN `_idusuarios_destinatario` INT)
SELECT * FROM vista_consultabandejaentradamensajeriausuarios WHERE idusuarios_destinatario=_idusuarios_destinatario AND ocultarmensaje="si" ORDER BY fechamensaje DESC LIMIT 100 ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaCalendarioActividadesGeneral` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaCalendarioActividadesGeneral`()
BEGIN
	SELECT * FROM
    vista_reservacionescalendarioactividades_general WHERE
    estadoreservacion="aprobado" AND ciclo="02-2023";

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaCalendarioActividadesGestionReservaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaCalendarioActividadesGestionReservaciones`(IN `_idlaboratorio` INT)
BEGIN
	SELECT * FROM
    vista_reservacionescalendarioactividades_general WHERE
    estadoreservacion="aprobado" AND  ciclo="02-2023" AND idlaboratorio=_idlaboratorio;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaCalendarioActividadesLaboratorio1` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaCalendarioActividadesLaboratorio1`()
BEGIN
	SELECT * FROM
    vista_reservacionescalendarioactividades_general WHERE
    estadoreservacion="aprobado" AND ciclo="02-2023" AND idlaboratorio=1;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaCalendarioActividadesLaboratorio10` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaCalendarioActividadesLaboratorio10`()
BEGIN
	SELECT * FROM
    vista_reservacionescalendarioactividades_general WHERE
    estadoreservacion="aprobado" AND ciclo="02-2023" AND idlaboratorio=10;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaCalendarioActividadesLaboratorio11` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaCalendarioActividadesLaboratorio11`()
BEGIN
	SELECT * FROM
    vista_reservacionescalendarioactividades_general WHERE
    estadoreservacion="aprobado" AND ciclo="02-2023" AND idlaboratorio=11;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaCalendarioActividadesLaboratorio12` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaCalendarioActividadesLaboratorio12`()
BEGIN
	SELECT * FROM
    vista_reservacionescalendarioactividades_general WHERE
    estadoreservacion="aprobado" AND ciclo="02-2023" AND idlaboratorio=12;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaCalendarioActividadesLaboratorio13` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaCalendarioActividadesLaboratorio13`()
BEGIN
	SELECT * FROM
    vista_reservacionescalendarioactividades_general WHERE
    estadoreservacion="aprobado" AND ciclo="02-2023" AND idlaboratorio=13;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaCalendarioActividadesLaboratorio14` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaCalendarioActividadesLaboratorio14`()
BEGIN
	SELECT * FROM
    vista_reservacionescalendarioactividades_general WHERE
    estadoreservacion="aprobado" AND ciclo="02-2023" AND idlaboratorio=14;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaCalendarioActividadesLaboratorio15` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaCalendarioActividadesLaboratorio15`()
BEGIN
	SELECT * FROM
    vista_reservacionescalendarioactividades_general WHERE
    estadoreservacion="aprobado" AND ciclo="02-2023" AND idlaboratorio=15;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaCalendarioActividadesLaboratorio2` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaCalendarioActividadesLaboratorio2`()
BEGIN
	SELECT * FROM
    vista_reservacionescalendarioactividades_general WHERE
    estadoreservacion="aprobado" AND ciclo="02-2023" AND idlaboratorio=2;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaCalendarioActividadesLaboratorio3` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaCalendarioActividadesLaboratorio3`()
BEGIN
	SELECT * FROM
    vista_reservacionescalendarioactividades_general WHERE
    estadoreservacion="aprobado" AND  ciclo="02-2023" AND idlaboratorio=3;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaCalendarioActividadesLaboratorio4` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaCalendarioActividadesLaboratorio4`()
BEGIN
	SELECT * FROM
    vista_reservacionescalendarioactividades_general WHERE
    estadoreservacion="aprobado" AND ciclo="02-2023" AND idlaboratorio=4;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaCalendarioActividadesLaboratorio5` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaCalendarioActividadesLaboratorio5`()
BEGIN
	SELECT * FROM
    vista_reservacionescalendarioactividades_general WHERE
    estadoreservacion="aprobado" AND ciclo="02-2023" AND idlaboratorio=5;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaCalendarioActividadesLaboratorio6` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaCalendarioActividadesLaboratorio6`()
BEGIN
	SELECT * FROM
    vista_reservacionescalendarioactividades_general WHERE
    estadoreservacion="aprobado" AND ciclo="02-2023" AND idlaboratorio=6;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaCalendarioActividadesLaboratorio7` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaCalendarioActividadesLaboratorio7`()
BEGIN
	SELECT * FROM
    vista_reservacionescalendarioactividades_general WHERE
    estadoreservacion="aprobado" AND ciclo="02-2023" AND idlaboratorio=7;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaCalendarioActividadesLaboratorio8` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaCalendarioActividadesLaboratorio8`()
BEGIN
	SELECT * FROM
    vista_reservacionescalendarioactividades_general WHERE
    estadoreservacion="aprobado" AND ciclo="02-2023" AND idlaboratorio=8;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaCalendarioActividadesLaboratorio9` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaCalendarioActividadesLaboratorio9`()
BEGIN
	SELECT * FROM
    vista_reservacionescalendarioactividades_general WHERE
    estadoreservacion="aprobado" AND ciclo="02-2023" AND idlaboratorio=9;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaClasificacionesNotificaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaClasificacionesNotificaciones`()
SELECT * FROM vista_clasificacion_notificacionesregistradas ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaCorreoActualizacionReservaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaCorreoActualizacionReservaciones`(IN `_codigounico_identificador` VARCHAR(100))
BEGIN
	SELECT * FROM vista_consultacorreoactualizacionreservaciones WHERE codigounico_identificador = _codigounico_identificador LIMIT 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaCorreoEnvioNotificacionReasignacionReservaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaCorreoEnvioNotificacionReasignacionReservaciones`(IN `_codigounico_identificador` VARCHAR(100), IN `_idreservacion` INT)
BEGIN
	SELECT * FROM vista_consultacorreousuariosreservaciones WHERE codigounico_identificador=_codigounico_identificador AND idreservacion = _idreservacion LIMIT 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaDatosAplicacionesNuevasReservaciones_CorreoAutomatico` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaDatosAplicacionesNuevasReservaciones_CorreoAutomatico`(IN `_idaplicacion` INT)
SELECT * FROM vista_consultadatosaplicacionesreservaciones WHERE idaplicacion=_idaplicacion ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaDatosLaboratoriosReservaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaDatosLaboratoriosReservaciones`()
SELECT * FROM vista_informaciongenerallaboratoriosreservaciones ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaDatosSeguimientoReservacionesFinalizadas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaDatosSeguimientoReservacionesFinalizadas`(IN `_codigounico_identificador` VARCHAR(100))
BEGIN
	SELECT * FROM vista_seguimientoreservacionesfinalizadas WHERE codigounico_identificador = _codigounico_identificador;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaDetallesMensajesRecibidos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaDetallesMensajesRecibidos`(IN `_idusuarios_destinatario` INT, IN `_idmensajeria` INT)
SELECT * FROM vista_consultabandejaentradamensajeriausuarios WHERE idusuarios_destinatario=_idusuarios_destinatario AND idmensajeria=_idmensajeria ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaDetallesPerfilUsuarios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaDetallesPerfilUsuarios`(IN `_idusuarios` INT)
BEGIN
	SELECT * FROM vista_detallespefilusuarios WHERE idusuarios=_idusuarios;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaDetallesReasignacionGrupoReservacionesProcesadas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaDetallesReasignacionGrupoReservacionesProcesadas`(IN `_codigounico_identificador` VARCHAR(100), IN `_idreservacion` INT)
BEGIN
	SELECT * FROM vista_detallereservacionesregistradas WHERE codigounico_identificador= _codigounico_identificador
    AND idreservacion = _idreservacion;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaDetallesReservacionesAprobadasGestion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaDetallesReservacionesAprobadasGestion`(IN `_codigounico_identificador` VARCHAR(100))
SELECT * FROM vista_detallereservacionesregistradas WHERE codigounico_identificador = _codigounico_identificador ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaDetallesReservacionesPendientes` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaDetallesReservacionesPendientes`(IN `_codigounico_identificador` VARCHAR(100))
SELECT * FROM vista_detallereservacionesregistradas WHERE codigounico_identificador = _codigounico_identificador ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaDisponibilidadModulosLaboratorios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaDisponibilidadModulosLaboratorios`(IN `_fechainicioreservacion` DATE, IN `_fechafinreservacion` DATE, IN `_horainicioreservacion` TIME, IN `_horafinreservacion` TIME, IN `_idaplicacion` INT)
BEGIN
SELECT laboratorios.idlaboratorio, laboratorios.codigolaboratorio, laboratorios.capacidadlaboratorio, laboratorios.maquinasfuerauso, laboratorios.estadolaboratorio,
    IFNULL(laboratorios.mod1, -1) as mod1,
    IFNULL(laboratorios.mod2, -1) as mod2,
    IFNULL(laboratorios.mod3, -1) as mod3,
    IFNULL(laboratorios.mod4, -1) as mod4,
    CASE 
        WHEN laboratorios.mod1 = -1 THEN NULL 
        WHEN EXISTS (SELECT * FROM reservaciones WHERE reservaciones.idlaboratorio = laboratorios.idlaboratorio AND reservaciones.mod1 > 0 AND
            ((reservaciones.fechainicioreservacion <= _fechafinreservacion AND reservaciones.fechafinreservacion >= _fechainicioreservacion) AND 
            (reservaciones.horainicioreservacion <= _horainicioreservacion AND reservaciones.horafinreservacion >= _horafinreservacion))) THEN 
            CASE 
                WHEN laboratorios.mod1 - IFNULL(SUM(reservaciones.mod1), 0) < 0 THEN 0 
                ELSE laboratorios.mod1 - IFNULL(SUM(reservaciones.mod1), 0)
            END
        ELSE laboratorios.mod1
    END AS espacio_disponible_mod1,
    CASE 
        WHEN laboratorios.mod2 = -1 THEN NULL 
        WHEN EXISTS (SELECT * FROM reservaciones WHERE reservaciones.idlaboratorio = laboratorios.idlaboratorio AND reservaciones.mod2 > 0 AND
            ((reservaciones.fechainicioreservacion <= _fechafinreservacion AND reservaciones.fechafinreservacion >= _fechainicioreservacion) AND 
            (reservaciones.horainicioreservacion <= _horainicioreservacion AND reservaciones.horafinreservacion >= _horafinreservacion))) THEN 
            CASE 
                WHEN laboratorios.mod2 - IFNULL(SUM(reservaciones.mod2), 0) < 0 THEN 0 
                ELSE laboratorios.mod2 - IFNULL(SUM(reservaciones.mod2), 0)
            END
        ELSE laboratorios.mod2
    END AS espacio_disponible_mod2,
    CASE 
        WHEN laboratorios.mod3 = -1 THEN NULL 
        WHEN EXISTS (SELECT * FROM reservaciones WHERE reservaciones.idlaboratorio = laboratorios.idlaboratorio AND reservaciones.mod3 > 0 AND
            ((reservaciones.fechainicioreservacion <= _fechafinreservacion AND reservaciones.fechafinreservacion >= _fechainicioreservacion) AND 
            (reservaciones.horainicioreservacion <= _horainicioreservacion AND reservaciones.horafinreservacion >= _horafinreservacion))) THEN 
            CASE 
                WHEN laboratorios.mod3 - IFNULL(SUM(reservaciones.mod3), 0) < 0 THEN 0 
                ELSE laboratorios.mod3 - IFNULL(SUM(reservaciones.mod3), 0)
            END
        ELSE laboratorios.mod3
    END AS espacio_disponible_mod3,
    CASE 
        WHEN laboratorios.mod4 = -1 THEN NULL 
        WHEN EXISTS (SELECT * FROM reservaciones WHERE reservaciones.idlaboratorio = laboratorios.idlaboratorio AND reservaciones.mod4 > 0 AND
            ((reservaciones.fechainicioreservacion <= _fechafinreservacion AND reservaciones.fechafinreservacion >= _fechainicioreservacion) AND 
            (reservaciones.horainicioreservacion <= _horainicioreservacion AND reservaciones.horafinreservacion >= _horafinreservacion))) THEN 
            CASE 
                WHEN laboratorios.mod4 - IFNULL(SUM(reservaciones.mod4), 0) < 0 THEN 0 
                ELSE laboratorios.mod4 - IFNULL(SUM(reservaciones.mod4), 0)
            END
        ELSE laboratorios.mod4
    END AS espacio_disponible_mod4
FROM laboratorios 
LEFT JOIN reservaciones  ON laboratorios.idlaboratorio = reservaciones.idlaboratorio
AND estadoreservacion IN ('aprobado', 'pendiente')
JOIN aplicaciones_laboratorios aplicacion ON 
    aplicacion.idaplicacion = _idaplicacion AND (
        aplicacion.lab1 = 'si' AND laboratorios.codigolaboratorio = 'lab1' OR 
        aplicacion.lab2 = 'si' AND laboratorios.codigolaboratorio = 'lab2' OR 
        aplicacion.lab3 = 'si' AND laboratorios.codigolaboratorio = 'lab3' OR 
        aplicacion.lab4 = 'si' AND laboratorios.codigolaboratorio = 'lab4' OR 
        aplicacion.lab5 = 'si' AND laboratorios.codigolaboratorio = 'lab5' OR 
        aplicacion.lab6 = 'si' AND laboratorios.codigolaboratorio = 'lab6' OR 
        aplicacion.lab7 = 'si' AND laboratorios.codigolaboratorio = 'lab7' OR 
        aplicacion.lab8 = 'si' AND laboratorios.codigolaboratorio = 'lab8' OR 
        aplicacion.lab9 = 'si' AND laboratorios.codigolaboratorio = 'lab9' OR 
        aplicacion.lab10 = 'si' AND laboratorios.codigolaboratorio = 'lab10' OR
        aplicacion.lab11 = 'si' AND laboratorios.codigolaboratorio = 'lab11' OR
        aplicacion.lab12 = 'si' AND laboratorios.codigolaboratorio = 'lab12' OR
        aplicacion.lab13 = 'si' AND laboratorios.codigolaboratorio = 'lab13' OR
        aplicacion.lab14 = 'si' AND laboratorios.codigolaboratorio = 'lab14' OR
        aplicacion.lab15 = 'si' AND laboratorios.codigolaboratorio = 'lab15'
    )
WHERE (laboratorios.mod1 > 0 OR laboratorios.mod2 > 0 OR laboratorios.mod3 > 0 OR laboratorios.mod4 > 0)
    AND NOT (laboratorios.mod1 = -1 AND laboratorios.mod2 = -1 AND laboratorios.mod3 = -1 AND laboratorios.mod4 = -1)
GROUP BY laboratorios.idlaboratorio;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaDisponibilidadReservaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaDisponibilidadReservaciones`(IN `_idaplicacion` INT, IN `_totalusuarios` INT, IN `_fechainicioreservacion` DATE, IN `_fechafinreservacion` DATE, IN `_horainicioreservacion` TIME, IN `_horafinreservacion` TIME)
BEGIN
SELECT 
    tlb_derivada.idlaboratorio,
    tlb_derivada.codigolaboratorio,
    tlb_derivada.nombrelaboratorio,
    tlb_derivada.capacidadlaboratorio - tlb_derivada.maquinasfuerauso AS capacidadreal,
    tlb_derivada.estadolaboratorio
FROM (
    SELECT 
        laboratoriosreservaciones.idlaboratorio,
        laboratoriosreservaciones.codigolaboratorio,
        laboratoriosreservaciones.nombrelaboratorio,
        laboratoriosreservaciones.capacidadlaboratorio,
        laboratoriosreservaciones.maquinasfuerauso,
        laboratoriosreservaciones.estadolaboratorio
    FROM vista_consultalaboratoriosreservaciones laboratoriosreservaciones
    WHERE 
        laboratoriosreservaciones.capacidadlaboratorio - laboratoriosreservaciones.maquinasfuerauso >= _totalusuarios AND 
        laboratoriosreservaciones.estadolaboratorio = 'activo'
) tlb_derivada
JOIN aplicaciones_laboratorios aplicacion ON 
    aplicacion.idaplicacion = _idaplicacion AND (
        aplicacion.lab1 = 'si' AND tlb_derivada.codigolaboratorio = 'lab1' OR 
        aplicacion.lab2 = 'si' AND tlb_derivada.codigolaboratorio = 'lab2' OR 
        aplicacion.lab3 = 'si' AND tlb_derivada.codigolaboratorio = 'lab3' OR 
        aplicacion.lab4 = 'si' AND tlb_derivada.codigolaboratorio = 'lab4' OR 
        aplicacion.lab5 = 'si' AND tlb_derivada.codigolaboratorio = 'lab5' OR 
        aplicacion.lab6 = 'si' AND tlb_derivada.codigolaboratorio = 'lab6' OR 
        aplicacion.lab7 = 'si' AND tlb_derivada.codigolaboratorio = 'lab7' OR 
        aplicacion.lab8 = 'si' AND tlb_derivada.codigolaboratorio = 'lab8' OR 
        aplicacion.lab9 = 'si' AND tlb_derivada.codigolaboratorio = 'lab9' OR 
        aplicacion.lab10 = 'si' AND tlb_derivada.codigolaboratorio = 'lab10' OR 
        aplicacion.lab11 = 'si' AND tlb_derivada.codigolaboratorio = 'lab11' OR 
        aplicacion.lab12 = 'si' AND tlb_derivada.codigolaboratorio = 'lab12' OR 
        aplicacion.lab13 = 'si' AND tlb_derivada.codigolaboratorio = 'lab13' OR 
        aplicacion.lab14 = 'si' AND tlb_derivada.codigolaboratorio = 'lab14' OR 
        aplicacion.lab15 = 'si' AND tlb_derivada.codigolaboratorio = 'lab15'
    )
LEFT JOIN (
    SELECT 
        idlaboratorio,
        horainicioreservacion,
        horafinreservacion
    FROM vista_disponibilidadreservaciones 
    WHERE 
        ((fechainicioreservacion >= _fechainicioreservacion AND fechainicioreservacion <= _fechafinreservacion) OR (fechafinreservacion >= _fechainicioreservacion AND fechafinreservacion <= _fechafinreservacion) 
         OR (fechainicioreservacion <= _fechainicioreservacion AND fechafinreservacion >= _fechafinreservacion)) AND 
        ((horainicioreservacion >= _horainicioreservacion AND horainicioreservacion < _horafinreservacion) OR (horafinreservacion > _horafinreservacion AND horafinreservacion <= _horafinreservacion)) AND
        estadoreservacion IN ('aprobado', 'pendiente')
) disponibilidad_reservacion ON tlb_derivada.idlaboratorio = disponibilidad_reservacion.idlaboratorio 
WHERE 
    disponibilidad_reservacion.idlaboratorio IS NULL AND
    NOT EXISTS (
        SELECT 1 
        FROM vista_disponibilidadreservaciones 
        WHERE 
            tlb_derivada.idlaboratorio = vista_disponibilidadreservaciones.idlaboratorio AND 
            vista_disponibilidadreservaciones.horainicioreservacion <= _horafinreservacion AND 
            vista_disponibilidadreservaciones.horafinreservacion >= _horainicioreservacion AND
            vista_disponibilidadreservaciones.estadoreservacion IN ('aprobado', 'pendiente') AND
            ((vista_disponibilidadreservaciones.fechainicioreservacion >= _fechainicioreservacion AND vista_disponibilidadreservaciones.fechainicioreservacion <= _fechafinreservacion) OR (vista_disponibilidadreservaciones.fechafinreservacion >= _fechainicioreservacion AND vista_disponibilidadreservaciones.fechafinreservacion <= _fechafinreservacion) 
             OR (vista_disponibilidadreservaciones.fechainicioreservacion <= _fechainicioreservacion AND vista_disponibilidadreservaciones.fechafinreservacion >= _fechafinreservacion))
    )
GROUP BY 
    tlb_derivada.codigolaboratorio,
    tlb_derivada.nombrelaboratorio,
    tlb_derivada.capacidadlaboratorio;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaDisponibilidadReservacionesPracticasLibres` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaDisponibilidadReservacionesPracticasLibres`(IN `_idaplicacion` INT, IN `_totalusuarios` INT, IN `_fechainicioreservacion` DATE, IN `_fechafinreservacion` DATE, IN `_horainicioreservacion` TIME, IN `_horafinreservacion` TIME)
BEGIN
SELECT 
    tlb_derivada.idlaboratorio,
    tlb_derivada.codigolaboratorio,
    tlb_derivada.nombrelaboratorio,
    tlb_derivada.capacidadlaboratorio - tlb_derivada.maquinasfuerauso - COALESCE(reservaciones.usuarios_reservados, 0)-COALESCE(pl.practicas_libres_count, 0) AS capacidadreal,
    tlb_derivada.estadolaboratorio
FROM (
    SELECT 
        laboratoriosreservaciones.idlaboratorio,
        laboratoriosreservaciones.codigolaboratorio,
        laboratoriosreservaciones.nombrelaboratorio,
        laboratoriosreservaciones.capacidadlaboratorio,
        laboratoriosreservaciones.maquinasfuerauso,
        laboratoriosreservaciones.estadolaboratorio
    FROM vista_consultalaboratoriosreservaciones laboratoriosreservaciones
    WHERE 
        laboratoriosreservaciones.capacidadlaboratorio - laboratoriosreservaciones.maquinasfuerauso >= _totalusuarios AND 
        laboratoriosreservaciones.estadolaboratorio = 'activo'
) tlb_derivada
JOIN aplicaciones_laboratorios aplicacion ON 
    aplicacion.idaplicacion = _idaplicacion AND (
        aplicacion.lab1 = 'si' AND tlb_derivada.codigolaboratorio = 'lab1' OR 
        aplicacion.lab2 = 'si' AND tlb_derivada.codigolaboratorio = 'lab2' OR 
        aplicacion.lab3 = 'si' AND tlb_derivada.codigolaboratorio = 'lab3' OR 
        aplicacion.lab4 = 'si' AND tlb_derivada.codigolaboratorio = 'lab4' OR 
        aplicacion.lab5 = 'si' AND tlb_derivada.codigolaboratorio = 'lab5' OR 
        aplicacion.lab6 = 'si' AND tlb_derivada.codigolaboratorio = 'lab6' OR 
        aplicacion.lab7 = 'si' AND tlb_derivada.codigolaboratorio = 'lab7' OR 
        aplicacion.lab8 = 'si' AND tlb_derivada.codigolaboratorio = 'lab8' OR 
        aplicacion.lab9 = 'si' AND tlb_derivada.codigolaboratorio = 'lab9' OR 
        aplicacion.lab10 = 'si' AND tlb_derivada.codigolaboratorio = 'lab10' OR 
        aplicacion.lab11 = 'si' AND tlb_derivada.codigolaboratorio = 'lab11' OR 
        aplicacion.lab12 = 'si' AND tlb_derivada.codigolaboratorio = 'lab12' OR 
        aplicacion.lab13 = 'si' AND tlb_derivada.codigolaboratorio = 'lab13' OR 
        aplicacion.lab14 = 'si' AND tlb_derivada.codigolaboratorio = 'lab14' OR 
        aplicacion.lab15 = 'si' AND tlb_derivada.codigolaboratorio = 'lab15'
    )
LEFT JOIN (
    SELECT
        idlaboratorio,
        SUM(numerousuarios) AS usuarios_reservados
    FROM reservaciones
    WHERE
        (
            (fechainicioreservacion >= _fechainicioreservacion AND fechainicioreservacion <= _fechafinreservacion)
            OR (fechafinreservacion >= _fechainicioreservacion AND fechafinreservacion <= _fechafinreservacion)
            OR (fechainicioreservacion <= _fechainicioreservacion AND fechafinreservacion >= _fechafinreservacion)
        )
        AND ((horainicioreservacion >= _horainicioreservacion) OR (horafinreservacion > _horafinreservacion))
    AND estadoreservacion IN ('aprobado', 'pendiente')
    GROUP BY idlaboratorio
) reservaciones ON tlb_derivada.idlaboratorio = reservaciones.idlaboratorio
LEFT JOIN (
    SELECT idlaboratorio, COUNT(idpracticalibre) AS practicas_libres_count
    FROM practicas_libres
    WHERE estado = 'activa'
    GROUP BY idlaboratorio
) pl ON tlb_derivada.idlaboratorio = pl.idlaboratorio
WHERE
    (tlb_derivada.capacidadlaboratorio - tlb_derivada.maquinasfuerauso - COALESCE(reservaciones.usuarios_reservados, 0)) >= (_totalusuarios + COALESCE(pl.practicas_libres_count, 0))
    AND tlb_derivada.estadolaboratorio = 'activo'
GROUP BY
    tlb_derivada.idlaboratorio,
    tlb_derivada.codigolaboratorio,
    tlb_derivada.nombrelaboratorio,
    tlb_derivada.capacidadlaboratorio,
    tlb_derivada.maquinasfuerauso,
    tlb_derivada.estadolaboratorio;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaEspecificaClasificacionNotificaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaEspecificaClasificacionNotificaciones`(IN `_idclasificacion` INT)
SELECT * FROM vista_clasificacion_notificacionesregistradas WHERE idclasificacion=_idclasificacion ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaEspecificaConsultarMisReservaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaEspecificaConsultarMisReservaciones`(IN `_idusuarios` INT, IN `_codigounico_identificador` VARCHAR(100), IN `_idreservacion` INT)
SELECT * FROM vista_consultaespecificagestionreservaciones WHERE idusuarios = _idusuarios AND codigounico_identificador = _codigounico_identificador
AND idreservacion = _idreservacion ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaEspecificaGestionAplicacionesLaboratorios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaEspecificaGestionAplicacionesLaboratorios`(IN `_idaplicacion` INT)
SELECT * FROM vista_listadogeneralaplicacionesinstaladaslaboratorios WHERE idaplicacion = _idaplicacion ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaEspecificaGestionarReservaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaEspecificaGestionarReservaciones`(IN `_codigounico_identificador` VARCHAR(100))
SELECT * FROM vista_consultaespecificagestionreservaciones WHERE codigounico_identificador = _codigounico_identificador ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaEspecificaLaboratoriosInformaticaRegistrados` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaEspecificaLaboratoriosInformaticaRegistrados`(IN `_idlaboratorio` INT)
SELECT * FROM vista_laboratoriosinformaticaregistrados WHERE idlaboratorio=_idlaboratorio ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaEspecificaReporteProblemasPlataforma` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaEspecificaReporteProblemasPlataforma`(IN `_idmanifiesto` INT)
SELECT * FROM vista_listadoreportesplataformaregistrados WHERE idmanifiesto=_idmanifiesto ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaEspecificaRolesUsuariosRegistrados` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaEspecificaRolesUsuariosRegistrados`(IN `_idrolusuario` INT)
SELECT * FROM vista_rolesusuariosregistrados WHERE idrolusuario=_idrolusuario ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaEspecificaTiposReservaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaEspecificaTiposReservaciones`(IN `_idtiporeservacion` INT)
SELECT * FROM vista_listadotiposreservaciones WHERE idtiporeservacion=_idtiporeservacion ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaEspecificaUsuariosRegistrados` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaEspecificaUsuariosRegistrados`(IN `_idusuarios` INT)
SELECT * FROM vista_consultageneralusuarios_registrados WHERE idusuarios=_idusuarios ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaGeneralAplicacionesLaboratorios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaGeneralAplicacionesLaboratorios`()
SELECT * FROM vista_listadogeneralaplicacionesinstaladaslaboratorios ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaGeneralLaboratoriosInformaticaRegistrados` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaGeneralLaboratoriosInformaticaRegistrados`()
SELECT * FROM vista_laboratoriosinformaticaregistrados ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaGeneralLaboratoriosInformaticaRegistradosInactivos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaGeneralLaboratoriosInformaticaRegistradosInactivos`()
SELECT * FROM vista_laboratoriosinformaticaregistrados WHERE estadolaboratorio="inactivo" ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaGeneralPracticasLibresActivas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaGeneralPracticasLibresActivas`()
BEGIN
	SELECT * FROM vista_practicaslibresprocesadas WHERE estado='activa';
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaGeneralPracticasLibresFinalizadas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaGeneralPracticasLibresFinalizadas`()
BEGIN
	SELECT * FROM vista_practicalibresfinalizadas WHERE estado='finalizado' AND ciclo='02-2023';
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaGraficoConteoReservacionesPorEstado` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaGraficoConteoReservacionesPorEstado`(IN `_anio` INT)
BEGIN
	SELECT meses.Mes, 
       COUNT(CASE WHEN reservaciones.estadoreservacion = 'aprobado' THEN 1 END) AS Aprobado, 
       COUNT(CASE WHEN reservaciones.estadoreservacion = 'cancelado' THEN 1 END) AS Cancelado, 
       COUNT(CASE WHEN reservaciones.estadoreservacion = 'denegada' THEN 1 END) AS Denegado
       FROM (
           SELECT 1 AS Mes UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 
           UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 
           UNION SELECT 11 UNION SELECT 12
       ) AS meses
       LEFT JOIN reservaciones AS reservaciones 
       ON meses.Mes = MONTH(reservaciones.fechainicioreservacion) AND YEAR(reservaciones.fechainicioreservacion) = 2023
       GROUP BY meses.Mes;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaGraficoConteoReservacionesPorFacultades` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaGraficoConteoReservacionesPorFacultades`(IN `_anioactual` INT)
BEGIN
WITH meses AS (
  SELECT 1 AS numeromes
  UNION ALL SELECT 2
  UNION ALL SELECT 3
  UNION ALL SELECT 4
  UNION ALL SELECT 5
  UNION ALL SELECT 6
  UNION ALL SELECT 7
  UNION ALL SELECT 8
  UNION ALL SELECT 9
  UNION ALL SELECT 10
  UNION ALL SELECT 11
  UNION ALL SELECT 12
)
SELECT facultades.idfacultad, facultades.nombrefacultad,
       meses.numeromes AS mes,
       COUNT(reservaciones.idreservacion) AS cantidad
FROM meses meses
CROSS JOIN facultades facultades
LEFT JOIN reservaciones reservaciones ON facultades.idfacultad = reservaciones.idfacultad
                          AND reservaciones.estadoreservacion = 'aprobado'
                          AND YEAR(reservaciones.fechainicioreservacion) = _anioactual
                          AND MONTH(reservaciones.fechainicioreservacion) = meses.numeromes
GROUP BY facultades.idfacultad, facultades.nombrefacultad, meses.numeromes
ORDER BY facultades.idfacultad, meses.numeromes;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaInformacionLaboratoriosReservaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaInformacionLaboratoriosReservaciones`()
SELECT * FROM vista_informaciongenerallaboratoriosreservaciones ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaLaboratoriosAsignadosUsuarios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaLaboratoriosAsignadosUsuarios`()
SELECT * FROM vista_laboratoriosasignadosusuarios WHERE idrolusuario=2 ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaListadoEscuelas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaListadoEscuelas`()
SELECT * FROM vista_listadoescuelasfacultades ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaListadoFacultades` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaListadoFacultades`()
SELECT * FROM vista_listadofacultadesregistradas ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaListadoTiposRerservaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaListadoTiposRerservaciones`()
SELECT * FROM vista_listadotiposreservaciones ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaPracticasLibresFinalizadasLab1` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaPracticasLibresFinalizadasLab1`()
SELECT * FROM vista_practicalibresfinalizadaslab1 ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaPracticasLibresFinalizadasLab10` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaPracticasLibresFinalizadasLab10`()
SELECT * FROM vista_practicalibresfinalizadaslab10 ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaPracticasLibresFinalizadasLab11` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaPracticasLibresFinalizadasLab11`()
SELECT * FROM vista_practicalibresfinalizadaslab11 ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaPracticasLibresFinalizadasLab12` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaPracticasLibresFinalizadasLab12`()
SELECT * FROM vista_practicalibresfinalizadaslab12 ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaPracticasLibresFinalizadasLab13` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaPracticasLibresFinalizadasLab13`()
SELECT * FROM vista_practicalibresfinalizadaslab13 ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaPracticasLibresFinalizadasLab14` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaPracticasLibresFinalizadasLab14`()
SELECT * FROM vista_practicalibresfinalizadaslab14 ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaPracticasLibresFinalizadasLab15` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaPracticasLibresFinalizadasLab15`()
SELECT * FROM vista_practicalibresfinalizadaslab15 ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaPracticasLibresFinalizadasLab2` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaPracticasLibresFinalizadasLab2`()
SELECT * FROM vista_practicalibresfinalizadaslab2 ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaPracticasLibresFinalizadasLab3` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaPracticasLibresFinalizadasLab3`()
SELECT * FROM vista_practicalibresfinalizadaslab3 ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaPracticasLibresFinalizadasLab4` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaPracticasLibresFinalizadasLab4`()
SELECT * FROM vista_practicalibresfinalizadaslab4 ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaPracticasLibresFinalizadasLab5` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaPracticasLibresFinalizadasLab5`()
SELECT * FROM vista_practicalibresfinalizadaslab5 ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaPracticasLibresFinalizadasLab6` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaPracticasLibresFinalizadasLab6`()
SELECT * FROM vista_practicalibresfinalizadaslab6 ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaPracticasLibresFinalizadasLab7` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaPracticasLibresFinalizadasLab7`()
SELECT * FROM vista_practicalibresfinalizadaslab7 ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaPracticasLibresFinalizadasLab8` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaPracticasLibresFinalizadasLab8`()
SELECT * FROM vista_practicalibresfinalizadaslab8 ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaPracticasLibresFinalizadasLab9` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaPracticasLibresFinalizadasLab9`()
SELECT * FROM vista_practicalibresfinalizadaslab9 ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaProblemasPlataformaRegistrados` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaProblemasPlataformaRegistrados`()
SELECT * FROM vista_listadoreportesplataformaregistrados ORDER BY fecharegistro DESC ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaProximasActividadesLaboratorios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaProximasActividadesLaboratorios`()
BEGIN
SELECT *
FROM (
    SELECT * FROM vista_proximareservacionlabotatorio1
    UNION ALL
    SELECT * FROM vista_proximareservacionlabotatorio2
    UNION ALL
    SELECT * FROM vista_proximareservacionlabotatorio3
    UNION ALL
    SELECT * FROM vista_proximareservacionlabotatorio4
    UNION ALL
    SELECT * FROM vista_proximareservacionlabotatorio5
    UNION ALL
    SELECT * FROM vista_proximareservacionlabotatorio6
    UNION ALL
    SELECT * FROM vista_proximareservacionlabotatorio7
    UNION ALL
    SELECT * FROM vista_proximareservacionlabotatorio8
    UNION ALL
    SELECT * FROM vista_proximareservacionlabotatorio9
    UNION ALL
    SELECT * FROM vista_proximareservacionlabotatorio10
    UNION ALL
    SELECT * FROM vista_proximareservacionlabotatorio11
    UNION ALL
    SELECT * FROM vista_proximareservacionlabotatorio12
    UNION ALL
    SELECT * FROM vista_proximareservacionlabotatorio13
    UNION ALL
    SELECT * FROM vista_proximareservacionlabotatorio14
    UNION ALL
    SELECT * FROM vista_proximareservacionlabotatorio15
) AS combined
ORDER BY idlaboratorio ASC;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultarClasificacionesAplicacionesLaboratorio` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultarClasificacionesAplicacionesLaboratorio`()
BEGIN
	SELECT * FROM vista_clasificacion_aplicaciones_laboratorios;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultarCorreoContactoUsuariosReservaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultarCorreoContactoUsuariosReservaciones`(IN `_lab1` CHAR(2), IN `_lab2` CHAR(2), IN `_lab3` CHAR(2), IN `_lab4` CHAR(2), IN `_lab5` CHAR(2), IN `_lab6` CHAR(2), IN `_lab7` CHAR(2), IN `_lab8` CHAR(2), IN `_lab9` CHAR(2), IN `_lab10` CHAR(2), IN `_lab11` CHAR(2), IN `_lab12` CHAR(2), IN `_lab13` CHAR(2), IN `_lab14` CHAR(2), IN `_lab15` CHAR(2))
SELECT * FROM vista_consultausuariosasignadoslaboratorios WHERE 
(lab1 = _lab1 OR lab2 = _lab2 OR lab3 = _lab3 OR lab4 = _lab4 OR lab5 = _lab5 OR lab6 = _lab6 OR lab7 = _lab7 OR lab8 = _lab8 OR lab9 = _lab9 OR lab10 = _lab10 OR lab11 = _lab11 OR lab12 = _lab12 OR lab13 = _lab13 OR lab14 = _lab14 OR lab15 = _lab15) ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultarCredencialesUsuarios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultarCredencialesUsuarios`(IN `Usuario` VARCHAR(255))
SELECT idusuarios, codigousuario, correo, contrasenia, estado_usuario FROM usuarios WHERE (codigousuario=Usuario OR correo=Usuario) ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultarDetallesMisReservaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultarDetallesMisReservaciones`(IN `_idusuarios` INT, IN `_codigounico_identificador` VARCHAR(100))
SELECT * FROM vista_detallereservacionesregistradas WHERE idusuarios = _idusuarios AND codigounico_identificador = _codigounico_identificador ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaReservacionesComprobanteMisReservaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaReservacionesComprobanteMisReservaciones`(IN `_codigounico_identificador` VARCHAR(100), IN `_idusuarios` INT)
BEGIN
	SELECT * FROM vista_detallereservacionesregistradas WHERE codigounico_identificador = _codigounico_identificador AND idusuarios = _idusuarios;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaReservacionesProcesadasHistorico` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaReservacionesProcesadasHistorico`(IN `_ciclo` VARCHAR(8))
BEGIN
	SELECT * FROM vista_detallereservacionesregistradas WHERE ciclo = _ciclo;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaReservacionesRegistradasAprobacionInicial` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaReservacionesRegistradasAprobacionInicial`()
SELECT *, MIN(fechainicioreservacion) AS fechainicio, MAX(fechafinreservacion) AS fechafin
FROM vista_detallereservacionesregistradas 
WHERE estadoreservacion='aprobacioninicial' AND ciclo='02-2023'
GROUP BY codigounico_identificador 
ORDER BY fechainicio DESC ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaReservacionesRegistradasAprobadas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaReservacionesRegistradasAprobadas`()
SELECT *, MIN(fechainicioreservacion) AS fechainicio, MAX(fechafinreservacion) AS fechafin
FROM vista_detallereservacionesregistradas 
WHERE estadoreservacion='aprobado' AND ciclo='02-2023'
GROUP BY codigounico_identificador 
ORDER BY fechainicio DESC ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaReservacionesRegistradasCanceladas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaReservacionesRegistradasCanceladas`()
SELECT * FROM vista_detallereservacionesregistradas WHERE (estadoreservacion='cancelado' OR estadoreservacion='cancelada') AND ciclo='02-2023' ORDER BY fecharegistro DESC ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaReservacionesRegistradasDenegadas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaReservacionesRegistradasDenegadas`()
SELECT *, MIN(fechainicioreservacion) AS fechainicio, MAX(fechafinreservacion) AS fechafin
FROM vista_detallereservacionesregistradas 
WHERE estadoreservacion='denegada' AND ciclo='02-2023'
GROUP BY codigounico_identificador 
ORDER BY fechainicio DESC ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaReservacionesRegistradasPendientes` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaReservacionesRegistradasPendientes`()
SELECT *, MIN(fechainicioreservacion) AS fechainicio, MAX(fechafinreservacion) AS fechafin
FROM vista_detallereservacionesregistradas 
WHERE estadoreservacion='pendiente' AND ciclo='02-2023'
GROUP BY codigounico_identificador 
ORDER BY fechainicio DESC ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultarExistenciaCodigosUsuariosUnicos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultarExistenciaCodigosUsuariosUnicos`(IN `_codigousuario` VARCHAR(255))
SELECT * FROM usuarios WHERE codigousuario=_codigousuario ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultarExistenciaUsuarios_RecuperacionCuentas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultarExistenciaUsuarios_RecuperacionCuentas`(IN `_correo` VARCHAR(255))
SELECT * FROM usuarios WHERE correo=_correo ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultarMisReservacionesCicloActual` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultarMisReservacionesCicloActual`(IN `_idusuarios` INT, IN `_ciclo` VARCHAR(8))
SELECT * FROM vista_detallereservacionesregistradas WHERE idusuarios = _idusuarios AND ciclo = _ciclo ORDER BY fecharegistro DESC ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultarRolesUsuariosRegistrados` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultarRolesUsuariosRegistrados`()
SELECT * FROM vista_rolesusuariosregistrados ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultarUsuariosRegistrados_General` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultarUsuariosRegistrados_General`()
SELECT * FROM vista_consultageneralusuarios_registrados ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaTelefonosEnvioSmsAutomatico` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaTelefonosEnvioSmsAutomatico`(IN `_codigounico_identificador` VARCHAR(100))
BEGIN
	SELECT * FROM vista_consultatelefonosenviosms WHERE codigounico_identificador=_codigounico_identificador LIMIT 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaUltimasReservacionesDocentes` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaUltimasReservacionesDocentes`(IN `_idusuarios` INT)
SELECT * FROM vista_ultimasreservacionesaprobadasdocentes WHERE idusuarios = _idusuarios ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaValidacionDuplicadosNuevasReservaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaValidacionDuplicadosNuevasReservaciones`(IN `_idlaboratorio` INT, IN `_fechainicioreservacion` DATE, IN `_fechafinreservacion` DATE, IN `_horainicioreservacion` TIME, IN `_horafinreservacion` TIME)
BEGIN

SELECT  SUM(CASE WHEN mod1 = 0 THEN 1 ELSE 0 END) AS mod1_cero,
            SUM(CASE WHEN mod2 = 0 THEN 1 ELSE 0 END) AS mod2_cero,
            SUM(CASE WHEN mod3 = 0 THEN 1 ELSE 0 END) AS mod3_cero,
            SUM(CASE WHEN mod4 = 0 THEN 1 ELSE 0 END) AS mod4_cero FROM reservaciones 
            WHERE idlaboratorio = _idlaboratorio AND (
                (fechainicioreservacion <= _fechafinreservacion AND fechafinreservacion >= _fechainicioreservacion 
                AND horainicioreservacion < _horainicioreservacion AND horafinreservacion > _horainicioreservacion) 
                OR (fechainicioreservacion >= _fechainicioreservacion AND fechafinreservacion <= _fechafinreservacion 
                AND horainicioreservacion >= _horainicioreservacion AND horafinreservacion <= _horafinreservacion)
                ); 

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConsultaValidacionDuplicadosNuevasReservacionesSinModulos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaValidacionDuplicadosNuevasReservacionesSinModulos`(IN `_idlaboratorio` INT, IN `_fechainicioreservacion` DATE, IN `_fechafinreservacion` DATE, IN `_horainicioreservacion` TIME, IN `_horafinreservacion` TIME)
BEGIN
	SELECT * FROM reservaciones WHERE idlaboratorio = _idlaboratorio AND
    fechainicioreservacion <= _fechainicioreservacion AND fechafinreservacion >= _fechafinreservacion AND
    horainicioreservacion < _horainicioreservacion AND horafinreservacion > _horafinreservacion;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConteoEstadosReportesProblemasPlataforma` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConteoEstadosReportesProblemasPlataforma`()
SELECT
(SELECT COUNT(*) FROM vista_listadoreportesplataformaregistrados WHERE estado = "pendiente") AS ReportesPendientes,
(SELECT COUNT(*) FROM vista_listadoreportesplataformaregistrados WHERE estado = "en proceso") AS ReportesEnProceso,
(SELECT COUNT(*) FROM vista_listadoreportesplataformaregistrados WHERE estado = "resuelto") AS ReportesResueltos,
(SELECT COUNT(*) FROM vista_listadoreportesplataformaregistrados WHERE estado = "cerrado") AS ReportesCerrados ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ConteoInicialInicioCoordinadoresLaboratorios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConteoInicialInicioCoordinadoresLaboratorios`()
SELECT * FROM vista_conteoiniciocoordinadorlaboratorios ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ControladorEstadoUsuariosPortal` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ControladorEstadoUsuariosPortal`(IN `_idusuarios` INT)
SELECT * FROM vista_consultaestadousuarios WHERE idusuarios = _idusuarios ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_DesactivarUsuarios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DesactivarUsuarios`(IN `_idusuarios` INT)
BEGIN
	UPDATE usuarios SET estado_usuario="inactivo" WHERE idusuarios=_idusuarios;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_FinalizarPracticasLibres` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_FinalizarPracticasLibres`(IN `_idpracticalibre` INT)
BEGIN
	UPDATE practicas_libres SET estado='finalizado', horafin= CURRENT_TIMESTAMP() WHERE idpracticalibre = _idpracticalibre;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_FinalizarReservacionesUsuarios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_FinalizarReservacionesUsuarios`(IN `_idusuarios` INT, IN `_idreservacion` INT)
BEGIN
	UPDATE reservaciones SET finalizado='si' WHERE idusuarios = _idusuarios AND idreservacion = _idreservacion;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_IniciarReservacionesUsuarios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_IniciarReservacionesUsuarios`(IN `_idusuarios` INT, IN `_idreservacion` INT)
BEGIN
	UPDATE reservaciones SET finalizado='ec' WHERE idusuarios = _idusuarios AND idreservacion = _idreservacion;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_InicioSesionUsuarios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_InicioSesionUsuarios`(IN `Usuario` VARCHAR(255), IN `Pass` VARCHAR(255))
SELECT * FROM vista_autenticacionusuarios WHERE (codigousuario=Usuario OR correo=Usuario) AND contrasenia=Pass ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ListadoAplicacionesReservaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ListadoAplicacionesReservaciones`()
SELECT * FROM vista_seleccionaraplicacionesregistradasreservaciones ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ListadoMensajesRecibidosRecortado` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ListadoMensajesRecibidosRecortado`(IN `_idusuarios_destinatario` INT)
SELECT * FROM vista_consultabandejaentradamensajeriausuarios WHERE idusuarios_destinatario=_idusuarios_destinatario AND ocultarmensaje="no" ORDER BY fechamensaje DESC LIMIT 6 ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ListadoMisNotificacionesRecibidas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ListadoMisNotificacionesRecibidas`(IN `_idusuarios` INT)
SELECT * FROM vista_listadonotificacionesrecibidas WHERE idusuarios=_idusuarios AND ocultarnotificacion="no" ORDER BY fechanotificacion DESC LIMIT 100 ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ListadoMisNotificacionesRecibidasRecortado` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ListadoMisNotificacionesRecibidasRecortado`(IN `_idusuarios` INT)
SELECT * FROM vista_listadonotificacionesrecibidas WHERE idusuarios=_idusuarios ORDER BY fechanotificacion DESC LIMIT 6 ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_MarcarComoLeidoMensajeria` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_MarcarComoLeidoMensajeria`(IN `_idmensajeria` INT)
UPDATE mensajeria SET mensajeleido="si" WHERE idmensajeria=_idmensajeria ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ModificarAplicacionesRegistradasLaboratorios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ModificarAplicacionesRegistradasLaboratorios`(IN `_idaplicacion` INT, IN `_codigoaplicacion` VARCHAR(100), IN `_nombreaplicacion` VARCHAR(255), IN `_lab1` CHAR(2), IN `_lab2` CHAR(2), IN `_lab3` CHAR(2), IN `_lab4` CHAR(2), IN `_lab5` CHAR(2), IN `_lab6` CHAR(2), IN `_lab7` CHAR(2), IN `_lab8` CHAR(2), IN `_lab9` CHAR(2), IN `_lab10` CHAR(2), IN `_lab11` CHAR(2), IN `_lab12` CHAR(2), IN `_lab13` CHAR(2), IN `_lab14` CHAR(2), IN `_lab15` CHAR(2), IN `_idclasificacionlaboratorio` INT)
BEGIN
	UPDATE aplicaciones_laboratorios SET codigoaplicacion=_codigoaplicacion,nombreaplicacion=_nombreaplicacion,lab1=_lab1,lab2=_lab2,lab3=_lab3,lab4=_lab4,lab5=_lab5,lab6=_lab6,
	lab7=_lab7,lab8=_lab8,lab9=_lab9,lab10=_lab10,lab11=_lab11,lab12=_lab12,lab13=_lab13,lab14=_lab14,lab15=_lab15,idclasificacionlaboratorio=_idclasificacionlaboratorio WHERE idaplicacion=_idaplicacion;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ModificarDatosClasificacionesNotificaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ModificarDatosClasificacionesNotificaciones`(IN `_idclasificacion` INT, IN `_codigoclasificacion` VARCHAR(50), IN `_descripcionclasificacion` VARCHAR(255))
BEGIN
	UPDATE clasificacion_notificaciones SET codigoclasificacion=_codigoclasificacion, descripcionclasificacion=_descripcionclasificacion WHERE idclasificacion=_idclasificacion;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ModificarDatosUsuarios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ModificarDatosUsuarios`(IN `_idusuarios` INT, IN `_nombres` VARCHAR(255), IN `_apellidos` VARCHAR(255), IN `_codigousuario` VARCHAR(255), IN `_correo` VARCHAR(255), IN `_idrolusuario` INT, IN `_estado_usuario` VARCHAR(15), IN `_lab1` CHAR(2), IN `_lab2` CHAR(2), IN `_lab3` CHAR(2), IN `_lab4` CHAR(2), IN `_lab5` CHAR(2), IN `_lab6` CHAR(2), IN `_lab7` CHAR(2), IN `_lab8` CHAR(2), IN `_lab9` CHAR(2), IN `_lab10` CHAR(2), IN `_lab11` CHAR(2), IN `_lab12` CHAR(2), IN `_lab13` CHAR(2), IN `_lab14` CHAR(2), IN `_lab15` CHAR(2), IN `_ubic_lab1` VARCHAR(255), IN `_ubic_lab2` VARCHAR(255), IN `_ubic_lab3` VARCHAR(255), IN `_ubic_lab4` VARCHAR(255), IN `_ubic_lab5` VARCHAR(255), IN `_ubic_lab6` VARCHAR(255), IN `_ubic_lab7` VARCHAR(255), IN `_ubic_lab8` VARCHAR(255), IN `_ubic_lab9` VARCHAR(255), IN `_ubic_lab10` VARCHAR(255), IN `_ubic_lab11` VARCHAR(255), IN `_ubic_lab12` VARCHAR(255), IN `_ubic_lab13` VARCHAR(255), IN `_ubic_lab14` VARCHAR(255), IN `_ubic_lab15` VARCHAR(255), IN `_extensiones` VARCHAR(500))
BEGIN

UPDATE usuarios SET nombres=_nombres, apellidos=_apellidos, codigousuario=_codigousuario, correo=_correo, idrolusuario=_idrolusuario, estado_usuario=_estado_usuario, lab1=_lab1, lab2=_lab2, lab3=_lab3, lab4=_lab4, lab5=_lab5, lab6=_lab6, lab7=_lab7, lab8=_lab8, lab9=_lab9, lab10=_lab10, lab11=_lab11, lab12=_lab12, lab13=_lab13, lab14=_lab14, lab15=_lab15,
ubic_lab1=_ubic_lab1, ubic_lab2=_ubic_lab2, ubic_lab3=_ubic_lab3, ubic_lab4=_ubic_lab4, ubic_lab5=_ubic_lab5, ubic_lab6=_ubic_lab6, ubic_lab7=_ubic_lab7, ubic_lab8=_ubic_lab8,
ubic_lab9=_ubic_lab9, ubic_lab10=_ubic_lab10, ubic_lab11=_ubic_lab11, ubic_lab12=_ubic_lab12, ubic_lab13=_ubic_lab13, ubic_lab14=_ubic_lab14, ubic_lab15=_ubic_lab15, extensiones=_extensiones
WHERE idusuarios=_idusuarios;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ModificarRolesUsuarios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ModificarRolesUsuarios`(IN `_idrolusuario` INT, IN `_nombrerolusuario` VARCHAR(50), IN `_descripcionrolusuario` VARCHAR(100))
BEGIN
	UPDATE roles SET nombrerolusuario = _nombrerolusuario, descripcionrolusuario = _descripcionrolusuario WHERE idrolusuario = _idrolusuario;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ModificarTiposReservaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ModificarTiposReservaciones`(IN `_idtiporeservacion` INT, IN `_tiporeservacion` VARCHAR(255), IN `_descripciontiporeservacion` VARCHAR(255))
BEGIN

	UPDATE tipo_reservaciones SET tiporeservacion = _tiporeservacion, descripciontiporeservacion = _descripciontiporeservacion WHERE idtiporeservacion = _idtiporeservacion;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_OcultarMensajesUsuarios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_OcultarMensajesUsuarios`(IN `_idmensajeria` INT)
UPDATE mensajeria SET ocultarmensaje="si" WHERE idmensajeria=_idmensajeria ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_OcultarNotificacionesUsuarios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_OcultarNotificacionesUsuarios`(IN `_idnotificaciones` INT)
BEGIN
	UPDATE notificaciones SET ocultarnotificacion = "si" WHERE idnotificaciones = _idnotificaciones;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ReasignacionReservacionesProcesadas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ReasignacionReservacionesProcesadas`(IN `_idreservacion` INT, IN `_codigounico_identificador` VARCHAR(100), IN `_idlaboratorio` INT, IN `_mod1` INT, IN `_mod2` INT, IN `_mod3` INT, IN `_mod4` INT)
BEGIN
	UPDATE reservaciones SET idlaboratorio = _idlaboratorio, mod1 = _mod1, mod2 = _mod2,
    mod3 = _mod3, mod4 = _mod4 WHERE idreservacion = _idreservacion AND codigounico_identificador = _codigounico_identificador;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ReestablecerContrasenias` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ReestablecerContrasenias`(IN `_correo` VARCHAR(255), IN `_token` VARCHAR(255), IN `_codigo` INT)
BEGIN
INSERT INTO recuperacion (correo,token,codigo) VALUES (_correo,_token,_codigo);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_RegistroAccesosUsuarios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_RegistroAccesosUsuarios`(IN `_fecha_ingreso` DATETIME, IN `_idusuarios` INT)
INSERT INTO accesos (fecha_ingreso,idusuarios) VALUES (_fecha_ingreso,_idusuarios) ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_RegistroCierreSesionUsuarios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_RegistroCierreSesionUsuarios`(IN `_idusuarios` INT, IN `_fecha_cierresesion` DATETIME)
BEGIN
	UPDATE accesos SET fecha_cierresesion=_fecha_cierresesion WHERE idusuarios=_idusuarios ORDER BY accesos.fecha_ingreso DESC LIMIT 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_RegistroDetallesPerfilUsuarios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_RegistroDetallesPerfilUsuarios`(IN `_telefonoprincipal` VARCHAR(9), IN `_genero` CHAR(2), IN `_fechanacimiento` DATE, IN `_estadocivil` VARCHAR(25), IN `_idusuarios` INT)
BEGIN
	INSERT INTO detallesusuarios (telefonoprincipal,genero,fechanacimiento,estadocivil,idusuarios) 
    VALUES
    (_telefonoprincipal,_genero,_fechanacimiento,_estadocivil,_idusuarios);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_RegistroNuevasAplicacionesLaboratoriosInformatica` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_RegistroNuevasAplicacionesLaboratoriosInformatica`(IN `_codigoaplicacion` VARCHAR(100), IN `_nombreaplicacion` VARCHAR(255), IN `_lab1` CHAR(2), IN `_lab2` CHAR(2), IN `_lab3` CHAR(2), IN `_lab4` CHAR(2), IN `_lab5` CHAR(2), IN `_lab6` CHAR(2), IN `_lab7` CHAR(2), IN `_lab8` CHAR(2), IN `_lab9` CHAR(2), IN `_lab10` CHAR(2), IN `_lab11` CHAR(2), IN `_lab12` CHAR(2), IN `_lab13` CHAR(2), IN `_lab14` CHAR(2), IN `_lab15` CHAR(2), IN `_idclasificacionlaboratorio` INT)
BEGIN
	INSERT INTO aplicaciones_laboratorios (codigoaplicacion,nombreaplicacion,lab1,lab2,lab3,lab4,lab5,lab6,lab7,lab8,lab9,lab10,lab11,lab12,lab13,lab14,lab15,idclasificacionlaboratorio) VALUES (_codigoaplicacion,_nombreaplicacion,_lab1,_lab2,_lab3,_lab4,_lab5,_lab6,_lab7,_lab8,_lab9,_lab10,_lab11,_lab12,_lab13,_lab14,_lab15,_idclasificacionlaboratorio);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_RegistroNuevasClasificacionesNotificaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_RegistroNuevasClasificacionesNotificaciones`(IN `_codigoclasificacion` VARCHAR(50), IN `_descripcionclasificacion` VARCHAR(255))
BEGIN
	INSERT INTO clasificacion_notificaciones (codigoclasificacion,descripcionclasificacion) VALUES (_codigoclasificacion,_descripcionclasificacion);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_RegistroNuevasPracticasLibres` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_RegistroNuevasPracticasLibres`(IN `_idaplicacion` INT, IN `_idtiporeservacion` INT, IN `_idlaboratorio` INT, IN `_idfacultad` INT, IN `_idusuarios` INT, IN `_nombreusuario_reservacion` VARCHAR(255), IN `_carneusuario_reservacion` VARCHAR(255), IN `_fechainicio` DATE, IN `_horainicio` TIME, IN `_ciclo` VARCHAR(8))
BEGIN
	INSERT INTO practicas_libres (idaplicacion,idtiporeservacion,idlaboratorio,idfacultad,idusuarios,nombreusuario_reservacion,carneusuario_reservacion,fechainicio,horainicio,ciclo)
    VALUES (_idaplicacion,_idtiporeservacion,_idlaboratorio,_idfacultad,_idusuarios,_nombreusuario_reservacion,_carneusuario_reservacion,_fechainicio,_horainicio,_ciclo);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_RegistroNuevasReservacionesLaborarorios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_RegistroNuevasReservacionesLaborarorios`(IN `_idusuarios` INT, IN `_idfacultad` INT, IN `_idescuela` INT, IN `_idlaboratorio` INT, IN `_idaplicacion` INT, IN `_idtiporeservacion` INT, IN `_codigounico_identificador` VARCHAR(100), IN `_codigoreservacion` VARCHAR(255), IN `_ciclo` VARCHAR(8), IN `_nombrereservacion` VARCHAR(255), IN `_seccionreservacion` INT, IN `_fechainicioreservacion` DATE, IN `_fechafinreservacion` DATE, IN `_horainicioreservacion` TIME, IN `_horafinreservacion` TIME, IN `_numerousuarios` INT, IN `_otrotipo_reservacion` VARCHAR(255), IN `_mod1` INT, IN `_mod2` INT, IN `_mod3` INT, IN `_mod4` INT, IN `_titular_reservacion` CHAR(2), IN `_aula_procedencia` VARCHAR(30))
BEGIN
	INSERT INTO reservaciones (idusuarios,idfacultad,idescuela,idlaboratorio,idaplicacion,
                               idtiporeservacion,codigounico_identificador,codigoreservacion,ciclo,nombrereservacion,seccionreservacion,fechainicioreservacion,
                               fechafinreservacion,horainicioreservacion,horafinreservacion,numerousuarios,otrotipo_reservacion,mod1,mod2,mod3,mod4,titular_reservacion,aula_procedencia)
                               VALUES
                               (_idusuarios,_idfacultad,_idescuela,_idlaboratorio,_idaplicacion,
                               _idtiporeservacion,_codigounico_identificador,_codigoreservacion,_ciclo,_nombrereservacion,_seccionreservacion,_fechainicioreservacion,
                               _fechafinreservacion,_horainicioreservacion,_horafinreservacion,_numerousuarios,_otrotipo_reservacion,
                                _mod1,_mod2,_mod3,_mod4,_titular_reservacion,_aula_procedencia);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_RegistroNuevosLaboratoriosInformatica` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_RegistroNuevosLaboratoriosInformatica`(IN `_codigolaboratorio` VARCHAR(15), IN `_nombrelaboratorio` VARCHAR(40), IN `_capacidadlaboratorio` INT, IN `_codigocolor` TEXT)
BEGIN
	INSERT INTO laboratorios (codigolaboratorio,nombrelaboratorio,capacidadlaboratorio,codigocolor) VALUES (_codigolaboratorio,_nombrelaboratorio,_capacidadlaboratorio,_codigocolor);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_RegistroNuevosMensajesConArchivoAdjunto` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_RegistroNuevosMensajesConArchivoAdjunto`(IN `_idusuarios` INT, IN `_nombremensaje` VARCHAR(255), IN `_asuntomensaje` VARCHAR(255), IN `_detallemensaje` TEXT, IN `_idusuarios_destinatario` INT, IN `_archivo_adjunto` VARCHAR(255))
BEGIN
	INSERT INTO mensajeria (idusuarios,nombremensaje,asuntomensaje,detallemensaje,idusuarios_destinatario,archivo_adjunto) VALUES (_idusuarios,_nombremensaje,_asuntomensaje,_detallemensaje,_idusuarios_destinatario,_archivo_adjunto);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_RegistroNuevosMensajesSinArchivoAdjunto` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_RegistroNuevosMensajesSinArchivoAdjunto`(IN `_idusuarios` INT, IN `_nombremensaje` VARCHAR(255), IN `_asuntomensaje` VARCHAR(255), IN `_detallemensaje` TEXT, IN `_idusuarios_destinatario` INT)
BEGIN
	INSERT INTO mensajeria (idusuarios,nombremensaje,asuntomensaje,detallemensaje,idusuarios_destinatario) VALUES (_idusuarios,_nombremensaje,_asuntomensaje,_detallemensaje,_idusuarios_destinatario);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_RegistroNuevosRolesUsuarios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_RegistroNuevosRolesUsuarios`(IN `_nombrerolusuario` VARCHAR(50), IN `_descripcionrolusuario` VARCHAR(100))
BEGIN
	INSERT INTO roles (nombrerolusuario, descripcionrolusuario) VALUES (_nombrerolusuario, _descripcionrolusuario) ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_RegistroNuevosTiposReservaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_RegistroNuevosTiposReservaciones`(IN `_tiporeservacion` VARCHAR(255), IN `_descripciontiporeservacion` VARCHAR(255))
BEGIN
	INSERT INTO tipo_reservaciones (tiporeservacion, descripciontiporeservacion) VALUES (_tiporeservacion, _descripciontiporeservacion);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_RegistroNuevosUsuarios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_RegistroNuevosUsuarios`(IN `_idrolusuario` INT, IN `_nombres` VARCHAR(255), IN `_apellidos` VARCHAR(255), IN `_codigousuario` VARCHAR(255), IN `_correo` VARCHAR(255), IN `_contrasenia` VARCHAR(255), IN `_lab1` CHAR(2), IN `_lab2` CHAR(2), IN `_lab3` CHAR(2), IN `_lab4` CHAR(2), IN `_lab5` CHAR(2), IN `_lab6` CHAR(2), IN `_lab7` CHAR(2), IN `_lab8` CHAR(2), IN `_lab9` CHAR(2), IN `_lab10` CHAR(2), IN `_lab11` CHAR(2), IN `_lab12` CHAR(2), IN `_lab13` CHAR(2), IN `_lab14` CHAR(2), IN `_lab15` CHAR(2), IN `_ubic_lab1` VARCHAR(255), IN `_ubic_lab2` VARCHAR(255), IN `_ubic_lab3` VARCHAR(255), IN `_ubic_lab4` VARCHAR(255), IN `_ubic_lab5` VARCHAR(255), IN `_ubic_lab6` VARCHAR(255), IN `_ubic_lab7` VARCHAR(255), IN `_ubic_lab8` VARCHAR(255), IN `_ubic_lab9` VARCHAR(255), IN `_ubic_lab10` VARCHAR(255), IN `_ubic_lab11` VARCHAR(255), IN `_ubic_lab12` VARCHAR(255), IN `_ubic_lab13` VARCHAR(255), IN `_ubic_lab14` VARCHAR(255), IN `_ubic_lab15` VARCHAR(255), IN `_extensiones` VARCHAR(500))
BEGIN

INSERT INTO usuarios (idrolusuario,nombres,apellidos,codigousuario,correo,contrasenia,lab1,lab2,lab3,lab4,lab5,lab6,lab7,lab8,lab9,lab10,lab11,lab12,lab13,lab14,lab15,
                     ubic_lab1,ubic_lab2,ubic_lab3,ubic_lab4,ubic_lab5,ubic_lab6,ubic_lab7,ubic_lab8,ubic_lab9,ubic_lab10,ubic_lab11,ubic_lab12,ubic_lab13,
                     ubic_lab14,ubic_lab15,extensiones) VALUES
(_idrolusuario,_nombres,_apellidos,_codigousuario,_correo,_contrasenia,_lab1,_lab2,_lab3,_lab4,_lab5,_lab6,_lab7,_lab8,_lab9,_lab10,_lab11,_lab12,_lab13,_lab14,_lab15,
_ubic_lab1,_ubic_lab2,_ubic_lab3,_ubic_lab4,_ubic_lab5,_ubic_lab6,_ubic_lab7,_ubic_lab8,_ubic_lab9,_ubic_lab10,_ubic_lab11,_ubic_lab12,_ubic_lab13,
                     _ubic_lab14,_ubic_lab15,_extensiones);

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_RegistroReportesProblemasPlataforma` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_RegistroReportesProblemasPlataforma`(IN `_idusuarios` INT, IN `_nombremanifiesto` VARCHAR(255), IN `_descripcionmanifiesto` VARCHAR(700), IN `_fotomanifiesto` VARCHAR(255))
BEGIN
 	INSERT INTO manifiestos_plataforma (idusuarios,nombremanifiesto,descripcionmanifiesto,fotomanifiesto) VALUES (_idusuarios,_nombremanifiesto,_descripcionmanifiesto,_fotomanifiesto);

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_RegistroSeguimientoReservacionesFinalizadas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_RegistroSeguimientoReservacionesFinalizadas`(IN `_idreservacion` INT, IN `_idfacultad` INT, IN `_idescuela` INT, IN `_idlaboratorio` INT, IN `_idaplicacion` INT, IN `_idtiporeservacion` INT, IN `_codigounico_identificador` VARCHAR(100), IN `_dividio_grupo` CHAR(2), IN `_cantidad_grupos` INT, IN `_cantidadusuarios` VARCHAR(255), IN `_ciclo` VARCHAR(8), IN `_idusuarios` INT)
BEGIN
	INSERT INTO seguimiento_reservaciones (idreservacion,idfacultad,idescuela,idlaboratorio,idaplicacion,idtiporeservacion,codigounico_identificador,
 dividio_grupo,cantidad_grupos,cantidadusuarios,ciclo,idusuarios) VALUES (_idreservacion,_idfacultad,_idescuela,_idlaboratorio,_idaplicacion,_idtiporeservacion,_codigounico_identificador,
 _dividio_grupo,_cantidad_grupos,_cantidadusuarios,_ciclo,_idusuarios);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ReportePracticasLibresFinalizadasPorCiclo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ReportePracticasLibresFinalizadasPorCiclo`(IN `_ciclo` VARCHAR(8))
BEGIN
SELECT vista_practicalibresfinalizadas.idpracticalibre, 
vista_practicalibresfinalizadas.idaplicacion, 
vista_practicalibresfinalizadas.nombreaplicacion, 
vista_practicalibresfinalizadas.idlaboratorio, 
vista_practicalibresfinalizadas.idfacultad, 
vista_practicalibresfinalizadas.nombrefacultad, 
vista_practicalibresfinalizadas.idusuarios, 
vista_practicalibresfinalizadas.nombreusuario_reservacion, 
vista_practicalibresfinalizadas.carneusuario_reservacion, 
vista_practicalibresfinalizadas.fechainicio,
vista_practicalibresfinalizadas.horainicio,vista_practicalibresfinalizadas.horafin, 
vista_practicalibresfinalizadas.ciclo, vista_practicalibresfinalizadas.estado, 
vista_practicalibresfinalizadas.quienregistro, vista_practicalibresfinalizadas.duracionpractica
FROM vista_practicalibresfinalizadas
WHERE ciclo = _ciclo;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ReportePracticasLibresFinalizadasRangoFechas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ReportePracticasLibresFinalizadasRangoFechas`(IN `_fechainicio` DATE, IN `_fechafin` DATE)
BEGIN
SELECT vista_practicalibresfinalizadas.idpracticalibre, vista_practicalibresfinalizadas.idaplicacion, vista_practicalibresfinalizadas.nombreaplicacion, vista_practicalibresfinalizadas.idlaboratorio, vista_practicalibresfinalizadas.idfacultad, vista_practicalibresfinalizadas.nombrefacultad, vista_practicalibresfinalizadas.idusuarios, vista_practicalibresfinalizadas.nombreusuario_reservacion, vista_practicalibresfinalizadas.carneusuario_reservacion, vista_practicalibresfinalizadas.fechainicio, vista_practicalibresfinalizadas.horainicio, vista_practicalibresfinalizadas.horafin, vista_practicalibresfinalizadas.ciclo, vista_practicalibresfinalizadas.estado, vista_practicalibresfinalizadas.quienregistro, vista_practicalibresfinalizadas.duracionpractica
FROM vista_practicalibresfinalizadas
WHERE fechainicio >= _fechainicio 
AND fechainicio <= _fechafin
AND estado="finalizado";
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ReportePracticasLibresFinalizadasRangoFechasPorLaboratorios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ReportePracticasLibresFinalizadasRangoFechasPorLaboratorios`(IN `_fechainicio` DATE, IN `_fechafin` DATE, IN `_idlaboratorio` INT)
BEGIN
SELECT vista_practicalibresfinalizadas.idpracticalibre, vista_practicalibresfinalizadas.idaplicacion, vista_practicalibresfinalizadas.nombreaplicacion, vista_practicalibresfinalizadas.idlaboratorio, vista_practicalibresfinalizadas.idfacultad, vista_practicalibresfinalizadas.nombrefacultad, vista_practicalibresfinalizadas.idusuarios, vista_practicalibresfinalizadas.nombreusuario_reservacion, vista_practicalibresfinalizadas.carneusuario_reservacion, vista_practicalibresfinalizadas.fechainicio, vista_practicalibresfinalizadas.horainicio, vista_practicalibresfinalizadas.horafin, vista_practicalibresfinalizadas.ciclo, vista_practicalibresfinalizadas.estado, vista_practicalibresfinalizadas.quienregistro, vista_practicalibresfinalizadas.duracionpractica
FROM vista_practicalibresfinalizadas
WHERE fechainicio >= _fechainicio 
AND fechainicio <= _fechafin
AND idlaboratorio = _idlaboratorio
AND estado="finalizado";
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_VerificarCodigoSeguridad` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_VerificarCodigoSeguridad`(IN `_codigo` INT, IN `_correo` VARCHAR(255), IN `_token` VARCHAR(255))
SELECT * FROM recuperacion WHERE codigo=_codigo AND correo=_correo AND token=_token AND estado="nousado" ORDER BY idrecuperaciones DESC LIMIT 1 ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `vista_aplicacionesinstaladas_laboratorio1`
--

/*!50001 DROP VIEW IF EXISTS `vista_aplicacionesinstaladas_laboratorio1`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_aplicacionesinstaladas_laboratorio1` AS select `vista_listadogeneralaplicacionesinstaladaslaboratorios`.`idaplicacion` AS `idaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`codigoaplicacion` AS `codigoaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`nombreaplicacion` AS `nombreaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`fecharegistro` AS `fecharegistro` from `vista_listadogeneralaplicacionesinstaladaslaboratorios` where `vista_listadogeneralaplicacionesinstaladaslaboratorios`.`lab1` = 'si' */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_aplicacionesinstaladas_laboratorio10`
--

/*!50001 DROP VIEW IF EXISTS `vista_aplicacionesinstaladas_laboratorio10`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_aplicacionesinstaladas_laboratorio10` AS select `vista_listadogeneralaplicacionesinstaladaslaboratorios`.`idaplicacion` AS `idaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`codigoaplicacion` AS `codigoaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`nombreaplicacion` AS `nombreaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`fecharegistro` AS `fecharegistro` from `vista_listadogeneralaplicacionesinstaladaslaboratorios` where `vista_listadogeneralaplicacionesinstaladaslaboratorios`.`lab10` = 'si' */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_aplicacionesinstaladas_laboratorio11`
--

/*!50001 DROP VIEW IF EXISTS `vista_aplicacionesinstaladas_laboratorio11`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_aplicacionesinstaladas_laboratorio11` AS select `vista_listadogeneralaplicacionesinstaladaslaboratorios`.`idaplicacion` AS `idaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`codigoaplicacion` AS `codigoaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`nombreaplicacion` AS `nombreaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`fecharegistro` AS `fecharegistro` from `vista_listadogeneralaplicacionesinstaladaslaboratorios` where `vista_listadogeneralaplicacionesinstaladaslaboratorios`.`lab11` = 'si' */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_aplicacionesinstaladas_laboratorio12`
--

/*!50001 DROP VIEW IF EXISTS `vista_aplicacionesinstaladas_laboratorio12`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_aplicacionesinstaladas_laboratorio12` AS select `vista_listadogeneralaplicacionesinstaladaslaboratorios`.`idaplicacion` AS `idaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`codigoaplicacion` AS `codigoaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`nombreaplicacion` AS `nombreaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`fecharegistro` AS `fecharegistro` from `vista_listadogeneralaplicacionesinstaladaslaboratorios` where `vista_listadogeneralaplicacionesinstaladaslaboratorios`.`lab12` = 'si' */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_aplicacionesinstaladas_laboratorio13`
--

/*!50001 DROP VIEW IF EXISTS `vista_aplicacionesinstaladas_laboratorio13`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_aplicacionesinstaladas_laboratorio13` AS select `vista_listadogeneralaplicacionesinstaladaslaboratorios`.`idaplicacion` AS `idaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`codigoaplicacion` AS `codigoaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`nombreaplicacion` AS `nombreaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`fecharegistro` AS `fecharegistro` from `vista_listadogeneralaplicacionesinstaladaslaboratorios` where `vista_listadogeneralaplicacionesinstaladaslaboratorios`.`lab13` = 'si' */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_aplicacionesinstaladas_laboratorio14`
--

/*!50001 DROP VIEW IF EXISTS `vista_aplicacionesinstaladas_laboratorio14`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_aplicacionesinstaladas_laboratorio14` AS select `vista_listadogeneralaplicacionesinstaladaslaboratorios`.`idaplicacion` AS `idaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`codigoaplicacion` AS `codigoaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`nombreaplicacion` AS `nombreaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`fecharegistro` AS `fecharegistro` from `vista_listadogeneralaplicacionesinstaladaslaboratorios` where `vista_listadogeneralaplicacionesinstaladaslaboratorios`.`lab14` = 'si' */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_aplicacionesinstaladas_laboratorio15`
--

/*!50001 DROP VIEW IF EXISTS `vista_aplicacionesinstaladas_laboratorio15`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_aplicacionesinstaladas_laboratorio15` AS select `vista_listadogeneralaplicacionesinstaladaslaboratorios`.`idaplicacion` AS `idaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`codigoaplicacion` AS `codigoaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`nombreaplicacion` AS `nombreaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`fecharegistro` AS `fecharegistro` from `vista_listadogeneralaplicacionesinstaladaslaboratorios` where `vista_listadogeneralaplicacionesinstaladaslaboratorios`.`lab15` = 'si' */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_aplicacionesinstaladas_laboratorio2`
--

/*!50001 DROP VIEW IF EXISTS `vista_aplicacionesinstaladas_laboratorio2`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_aplicacionesinstaladas_laboratorio2` AS select `vista_listadogeneralaplicacionesinstaladaslaboratorios`.`idaplicacion` AS `idaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`codigoaplicacion` AS `codigoaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`nombreaplicacion` AS `nombreaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`fecharegistro` AS `fecharegistro` from `vista_listadogeneralaplicacionesinstaladaslaboratorios` where `vista_listadogeneralaplicacionesinstaladaslaboratorios`.`lab2` = 'si' */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_aplicacionesinstaladas_laboratorio3`
--

/*!50001 DROP VIEW IF EXISTS `vista_aplicacionesinstaladas_laboratorio3`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_aplicacionesinstaladas_laboratorio3` AS select `vista_listadogeneralaplicacionesinstaladaslaboratorios`.`idaplicacion` AS `idaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`codigoaplicacion` AS `codigoaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`nombreaplicacion` AS `nombreaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`fecharegistro` AS `fecharegistro` from `vista_listadogeneralaplicacionesinstaladaslaboratorios` where `vista_listadogeneralaplicacionesinstaladaslaboratorios`.`lab3` = 'si' */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_aplicacionesinstaladas_laboratorio4`
--

/*!50001 DROP VIEW IF EXISTS `vista_aplicacionesinstaladas_laboratorio4`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_aplicacionesinstaladas_laboratorio4` AS select `vista_listadogeneralaplicacionesinstaladaslaboratorios`.`idaplicacion` AS `idaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`codigoaplicacion` AS `codigoaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`nombreaplicacion` AS `nombreaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`fecharegistro` AS `fecharegistro` from `vista_listadogeneralaplicacionesinstaladaslaboratorios` where `vista_listadogeneralaplicacionesinstaladaslaboratorios`.`lab4` = 'si' */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_aplicacionesinstaladas_laboratorio5`
--

/*!50001 DROP VIEW IF EXISTS `vista_aplicacionesinstaladas_laboratorio5`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_aplicacionesinstaladas_laboratorio5` AS select `vista_listadogeneralaplicacionesinstaladaslaboratorios`.`idaplicacion` AS `idaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`codigoaplicacion` AS `codigoaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`nombreaplicacion` AS `nombreaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`fecharegistro` AS `fecharegistro` from `vista_listadogeneralaplicacionesinstaladaslaboratorios` where `vista_listadogeneralaplicacionesinstaladaslaboratorios`.`lab5` = 'si' */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_aplicacionesinstaladas_laboratorio6`
--

/*!50001 DROP VIEW IF EXISTS `vista_aplicacionesinstaladas_laboratorio6`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_aplicacionesinstaladas_laboratorio6` AS select `vista_listadogeneralaplicacionesinstaladaslaboratorios`.`idaplicacion` AS `idaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`codigoaplicacion` AS `codigoaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`nombreaplicacion` AS `nombreaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`fecharegistro` AS `fecharegistro` from `vista_listadogeneralaplicacionesinstaladaslaboratorios` where `vista_listadogeneralaplicacionesinstaladaslaboratorios`.`lab6` = 'si' */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_aplicacionesinstaladas_laboratorio7`
--

/*!50001 DROP VIEW IF EXISTS `vista_aplicacionesinstaladas_laboratorio7`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_aplicacionesinstaladas_laboratorio7` AS select `vista_listadogeneralaplicacionesinstaladaslaboratorios`.`idaplicacion` AS `idaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`codigoaplicacion` AS `codigoaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`nombreaplicacion` AS `nombreaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`fecharegistro` AS `fecharegistro` from `vista_listadogeneralaplicacionesinstaladaslaboratorios` where `vista_listadogeneralaplicacionesinstaladaslaboratorios`.`lab7` = 'si' */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_aplicacionesinstaladas_laboratorio8`
--

/*!50001 DROP VIEW IF EXISTS `vista_aplicacionesinstaladas_laboratorio8`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_aplicacionesinstaladas_laboratorio8` AS select `vista_listadogeneralaplicacionesinstaladaslaboratorios`.`idaplicacion` AS `idaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`codigoaplicacion` AS `codigoaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`nombreaplicacion` AS `nombreaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`fecharegistro` AS `fecharegistro` from `vista_listadogeneralaplicacionesinstaladaslaboratorios` where `vista_listadogeneralaplicacionesinstaladaslaboratorios`.`lab8` = 'si' */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_aplicacionesinstaladas_laboratorio9`
--

/*!50001 DROP VIEW IF EXISTS `vista_aplicacionesinstaladas_laboratorio9`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_aplicacionesinstaladas_laboratorio9` AS select `vista_listadogeneralaplicacionesinstaladaslaboratorios`.`idaplicacion` AS `idaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`codigoaplicacion` AS `codigoaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`nombreaplicacion` AS `nombreaplicacion`,`vista_listadogeneralaplicacionesinstaladaslaboratorios`.`fecharegistro` AS `fecharegistro` from `vista_listadogeneralaplicacionesinstaladaslaboratorios` where `vista_listadogeneralaplicacionesinstaladaslaboratorios`.`lab9` = 'si' */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_autenticacionusuarios`
--

/*!50001 DROP VIEW IF EXISTS `vista_autenticacionusuarios`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_autenticacionusuarios` AS select `usuarios`.`idusuarios` AS `idusuarios`,`usuarios`.`idrolusuario` AS `idrolusuario`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`usuarios`.`codigousuario` AS `codigousuario`,`usuarios`.`correo` AS `correo`,`usuarios`.`fotoperfil` AS `fotoperfil`,`usuarios`.`contrasenia` AS `contrasenia`,`usuarios`.`nuevousuario` AS `nuevousuario`,`usuarios`.`ultimo_cambio_contrasenia` AS `ultimo_cambio_contrasenia`,to_days(current_timestamp()) - to_days(`usuarios`.`ultimo_cambio_contrasenia`) AS `ContadorCambioContrasenia`,`usuarios`.`estado_usuario` AS `estado_usuario`,`usuarios`.`fecha_registro` AS `fecha_registro` from `usuarios` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_clasificacion_aplicaciones_laboratorios`
--

/*!50001 DROP VIEW IF EXISTS `vista_clasificacion_aplicaciones_laboratorios`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_clasificacion_aplicaciones_laboratorios` AS select `clasificacion_aplicaciones_laboratorios`.`idclasificacionlaboratorio` AS `idclasificacionlaboratorio`,`clasificacion_aplicaciones_laboratorios`.`codigoclasificacionlaboratorio` AS `codigoclasificacionlaboratorio` from `clasificacion_aplicaciones_laboratorios` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_clasificacion_notificacionesregistradas`
--

/*!50001 DROP VIEW IF EXISTS `vista_clasificacion_notificacionesregistradas`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_clasificacion_notificacionesregistradas` AS select `clasificacion_notificaciones`.`idclasificacion` AS `idclasificacion`,`clasificacion_notificaciones`.`codigoclasificacion` AS `codigoclasificacion`,`clasificacion_notificaciones`.`descripcionclasificacion` AS `descripcionclasificacion` from `clasificacion_notificaciones` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_consultaaplicacionesreservacion`
--

/*!50001 DROP VIEW IF EXISTS `vista_consultaaplicacionesreservacion`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_consultaaplicacionesreservacion` AS select `aplicaciones_laboratorios`.`idaplicacion` AS `idaplicacion`,`aplicaciones_laboratorios`.`lab1` AS `lab1`,`aplicaciones_laboratorios`.`lab2` AS `lab2`,`aplicaciones_laboratorios`.`lab3` AS `lab3`,`aplicaciones_laboratorios`.`lab4` AS `lab4`,`aplicaciones_laboratorios`.`lab5` AS `lab5`,`aplicaciones_laboratorios`.`lab6` AS `lab6`,`aplicaciones_laboratorios`.`lab7` AS `lab7`,`aplicaciones_laboratorios`.`lab8` AS `lab8`,`aplicaciones_laboratorios`.`lab9` AS `lab9`,`aplicaciones_laboratorios`.`lab10` AS `lab10`,`aplicaciones_laboratorios`.`lab11` AS `lab11`,`aplicaciones_laboratorios`.`lab12` AS `lab12`,`aplicaciones_laboratorios`.`lab13` AS `lab13`,`aplicaciones_laboratorios`.`lab14` AS `lab14`,`aplicaciones_laboratorios`.`lab15` AS `lab15` from `aplicaciones_laboratorios` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_consultabandejaentradamensajeriausuarios`
--

/*!50001 DROP VIEW IF EXISTS `vista_consultabandejaentradamensajeriausuarios`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_consultabandejaentradamensajeriausuarios` AS select `mensajeria`.`idmensajeria` AS `idmensajeria`,`mensajeria`.`idusuarios` AS `idusuarios`,`mensajeria`.`idusuarios_destinatario` AS `idusuarios_destinatario`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`usuarios`.`fotoperfil` AS `fotoperfil`,`mensajeria`.`nombremensaje` AS `nombremensaje`,`mensajeria`.`asuntomensaje` AS `asuntomensaje`,`mensajeria`.`detallemensaje` AS `detallemensaje`,`mensajeria`.`fechamensaje` AS `fechamensaje`,`mensajeria`.`mensajeleido` AS `mensajeleido`,`mensajeria`.`archivo_adjunto` AS `archivo_adjunto`,`mensajeria`.`ocultarmensaje` AS `ocultarmensaje` from (`mensajeria` join `usuarios` on(`mensajeria`.`idusuarios` = `usuarios`.`idusuarios`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_consultacorreoactualizacionreservaciones`
--

/*!50001 DROP VIEW IF EXISTS `vista_consultacorreoactualizacionreservaciones`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_consultacorreoactualizacionreservaciones` AS select `reservaciones`.`idreservacion` AS `idreservacion`,`reservaciones`.`codigounico_identificador` AS `codigounico_identificador`,`reservaciones`.`idusuarios` AS `idusuarios`,`usuarios`.`codigousuario` AS `codigousuario`,`usuarios`.`correo` AS `correo` from (`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_consultacorreousuariosreservaciones`
--

/*!50001 DROP VIEW IF EXISTS `vista_consultacorreousuariosreservaciones`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_consultacorreousuariosreservaciones` AS select `reservaciones`.`idreservacion` AS `idreservacion`,`reservaciones`.`codigounico_identificador` AS `codigounico_identificador`,`reservaciones`.`idusuarios` AS `idusuarios`,`usuarios`.`codigousuario` AS `codigousuario`,`usuarios`.`correo` AS `correo` from (`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_consultadatosaplicacionesreservaciones`
--

/*!50001 DROP VIEW IF EXISTS `vista_consultadatosaplicacionesreservaciones`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_consultadatosaplicacionesreservaciones` AS select `aplicaciones_laboratorios`.`idaplicacion` AS `idaplicacion`,`aplicaciones_laboratorios`.`nombreaplicacion` AS `nombreaplicacion` from `aplicaciones_laboratorios` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_consultaespecificagestionreservaciones`
--

/*!50001 DROP VIEW IF EXISTS `vista_consultaespecificagestionreservaciones`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_consultaespecificagestionreservaciones` AS select `reservaciones`.`idreservacion` AS `idreservacion`,`reservaciones`.`idusuarios` AS `idusuarios`,`reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`idtiporeservacion` AS `idtiporeservacion`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`usuarios`.`codigousuario` AS `codigousuario`,`laboratorios`.`codigolaboratorio` AS `codigolaboratorio`,`laboratorios`.`nombrelaboratorio` AS `nombrelaboratorio`,`laboratorios`.`capacidadlaboratorio` AS `capacidadlaboratorio`,`laboratorios`.`maquinasfuerauso` AS `maquinasfuerauso`,`tipo_reservaciones`.`tiporeservacion` AS `tiporeservacion`,`reservaciones`.`codigounico_identificador` AS `codigounico_identificador`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`reservaciones`.`ciclo` AS `ciclo`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`seccionreservacion` AS `seccionreservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`fechafinreservacion` AS `fechafinreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion`,`reservaciones`.`numerousuarios` AS `numerousuarios`,`reservaciones`.`otrotipo_reservacion` AS `otrotipo_reservacion`,`reservaciones`.`comentario_adminlaboratorios` AS `comentario_adminlaboratorios`,`reservaciones`.`comentario_coordlaboratorio` AS `comentario_coordlaboratorio`,`reservaciones`.`estadoreservacion` AS `estadoreservacion`,`reservaciones`.`finalizado` AS `finalizado`,`facultades`.`idfacultad` AS `idfacultad`,`facultades`.`nombrefacultad` AS `nombrefacultad`,`escuelas`.`idescuela` AS `idescuela`,`escuelas`.`nombre_escuela` AS `nombre_escuela`,`aplicaciones_laboratorios`.`idaplicacion` AS `idaplicacion`,`aplicaciones_laboratorios`.`nombreaplicacion` AS `nombreaplicacion`,`reservaciones`.`usuario_gestion` AS `usuario_gestion`,`reservaciones`.`fecharegistro` AS `fecharegistro`,`reservaciones`.`completo_seguimiento` AS `completo_seguimiento`,`reservaciones`.`mod1` AS `mod1`,`reservaciones`.`mod2` AS `mod2`,`reservaciones`.`mod3` AS `mod3`,`reservaciones`.`mod4` AS `mod4`,`reservaciones`.`titular_reservacion` AS `titular_reservacion`,`reservaciones`.`nombre_otrotitular` AS `nombre_otrotitular`,`reservaciones`.`aula_procedencia` AS `aula_procedencia` from ((((((`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) join `laboratorios` on(`reservaciones`.`idlaboratorio` = `laboratorios`.`idlaboratorio`)) join `tipo_reservaciones` on(`reservaciones`.`idtiporeservacion` = `tipo_reservaciones`.`idtiporeservacion`)) join `facultades` on(`reservaciones`.`idfacultad` = `facultades`.`idfacultad`)) join `escuelas` on(`reservaciones`.`idescuela` = `escuelas`.`idescuela`)) join `aplicaciones_laboratorios` on(`reservaciones`.`idaplicacion` = `aplicaciones_laboratorios`.`idaplicacion`)) order by `reservaciones`.`idreservacion` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_consultaestadousuarios`
--

/*!50001 DROP VIEW IF EXISTS `vista_consultaestadousuarios`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_consultaestadousuarios` AS select `usuarios`.`idusuarios` AS `idusuarios`,`usuarios`.`codigousuario` AS `codigousuario`,`usuarios`.`estado_usuario` AS `estado_usuario`,`usuarios`.`lab1` AS `lab1`,`usuarios`.`lab2` AS `lab2`,`usuarios`.`lab3` AS `lab3`,`usuarios`.`lab4` AS `lab4`,`usuarios`.`lab5` AS `lab5`,`usuarios`.`lab6` AS `lab6`,`usuarios`.`lab7` AS `lab7`,`usuarios`.`lab8` AS `lab8`,`usuarios`.`lab9` AS `lab9`,`usuarios`.`lab10` AS `lab10`,`usuarios`.`lab11` AS `lab11`,`usuarios`.`lab12` AS `lab12`,`usuarios`.`lab13` AS `lab13`,`usuarios`.`lab14` AS `lab14`,`usuarios`.`lab15` AS `lab15`,`usuarios`.`nuevousuario` AS `nuevousuario`,`usuarios`.`completarperfil` AS `completarperfil` from `usuarios` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_consultageneralusuarios_registrados`
--

/*!50001 DROP VIEW IF EXISTS `vista_consultageneralusuarios_registrados`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_consultageneralusuarios_registrados` AS select `usuarios`.`idusuarios` AS `idusuarios`,`usuarios`.`idrolusuario` AS `idrolusuario`,`roles`.`nombrerolusuario` AS `nombrerolusuario`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`usuarios`.`codigousuario` AS `codigousuario`,`usuarios`.`correo` AS `correo`,`usuarios`.`fotoperfil` AS `fotoperfil`,`usuarios`.`nuevousuario` AS `nuevousuario`,`usuarios`.`estado_usuario` AS `estado_usuario`,`usuarios`.`fecha_registro` AS `fecha_registro`,`usuarios`.`lab1` AS `lab1`,`usuarios`.`lab2` AS `lab2`,`usuarios`.`lab3` AS `lab3`,`usuarios`.`lab4` AS `lab4`,`usuarios`.`lab5` AS `lab5`,`usuarios`.`lab6` AS `lab6`,`usuarios`.`lab7` AS `lab7`,`usuarios`.`lab8` AS `lab8`,`usuarios`.`lab9` AS `lab9`,`usuarios`.`lab10` AS `lab10`,`usuarios`.`lab11` AS `lab11`,`usuarios`.`lab12` AS `lab12`,`usuarios`.`lab13` AS `lab13`,`usuarios`.`lab14` AS `lab14`,`usuarios`.`lab15` AS `lab15`,`usuarios`.`ubic_lab1` AS `ubic_lab1`,`usuarios`.`ubic_lab2` AS `ubic_lab2`,`usuarios`.`ubic_lab3` AS `ubic_lab3`,`usuarios`.`ubic_lab4` AS `ubic_lab4`,`usuarios`.`ubic_lab5` AS `ubic_lab5`,`usuarios`.`ubic_lab6` AS `ubic_lab6`,`usuarios`.`ubic_lab7` AS `ubic_lab7`,`usuarios`.`ubic_lab8` AS `ubic_lab8`,`usuarios`.`ubic_lab9` AS `ubic_lab9`,`usuarios`.`ubic_lab10` AS `ubic_lab10`,`usuarios`.`ubic_lab11` AS `ubic_lab11`,`usuarios`.`ubic_lab12` AS `ubic_lab12`,`usuarios`.`ubic_lab13` AS `ubic_lab13`,`usuarios`.`ubic_lab14` AS `ubic_lab14`,`usuarios`.`ubic_lab15` AS `ubic_lab15`,`usuarios`.`extensiones` AS `extensiones` from (`usuarios` join `roles` on(`usuarios`.`idrolusuario` = `roles`.`idrolusuario`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_consultalaboratoriosreservaciones`
--

/*!50001 DROP VIEW IF EXISTS `vista_consultalaboratoriosreservaciones`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_consultalaboratoriosreservaciones` AS select `laboratorios`.`idlaboratorio` AS `idlaboratorio`,`laboratorios`.`codigolaboratorio` AS `codigolaboratorio`,`laboratorios`.`nombrelaboratorio` AS `nombrelaboratorio`,`laboratorios`.`capacidadlaboratorio` AS `capacidadlaboratorio`,`laboratorios`.`maquinasfuerauso` AS `maquinasfuerauso`,`laboratorios`.`estadolaboratorio` AS `estadolaboratorio`,`laboratorios`.`mod1` AS `mod1`,`laboratorios`.`mod2` AS `mod2`,`laboratorios`.`mod3` AS `mod3`,`laboratorios`.`mod4` AS `mod4` from `laboratorios` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_consultareservacionesaprobadas_gestionreservaciones`
--

/*!50001 DROP VIEW IF EXISTS `vista_consultareservacionesaprobadas_gestionreservaciones`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_consultareservacionesaprobadas_gestionreservaciones` AS select `reservaciones`.`idreservacion` AS `idreservacion`,`reservaciones`.`codigounico_identificador` AS `codigounico_identificador`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`seccionreservacion` AS `seccionreservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`fechafinreservacion` AS `fechafinreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion`,`reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`estadoreservacion` AS `estadoreservacion` from `reservaciones` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_consultatelefonosenviosms`
--

/*!50001 DROP VIEW IF EXISTS `vista_consultatelefonosenviosms`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_consultatelefonosenviosms` AS select `reservaciones`.`idreservacion` AS `idreservacion`,`reservaciones`.`codigounico_identificador` AS `codigounico_identificador`,`detallesusuarios`.`telefonoprincipal` AS `telefonoprincipal` from (`reservaciones` join `detallesusuarios` on(`reservaciones`.`idusuarios` = `detallesusuarios`.`idusuarios`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_consultausuariosasignadoslaboratorios`
--

/*!50001 DROP VIEW IF EXISTS `vista_consultausuariosasignadoslaboratorios`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_consultausuariosasignadoslaboratorios` AS select `usuarios`.`idusuarios` AS `idusuarios`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`usuarios`.`codigousuario` AS `codigousuario`,`usuarios`.`correo` AS `correo`,`usuarios`.`lab1` AS `lab1`,`usuarios`.`lab2` AS `lab2`,`usuarios`.`lab3` AS `lab3`,`usuarios`.`lab4` AS `lab4`,`usuarios`.`lab5` AS `lab5`,`usuarios`.`lab6` AS `lab6`,`usuarios`.`lab7` AS `lab7`,`usuarios`.`lab8` AS `lab8`,`usuarios`.`lab9` AS `lab9`,`usuarios`.`lab10` AS `lab10`,`usuarios`.`lab11` AS `lab11`,`usuarios`.`lab12` AS `lab12`,`usuarios`.`lab13` AS `lab13`,`usuarios`.`lab14` AS `lab14`,`usuarios`.`lab15` AS `lab15` from `usuarios` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_conteoiniciocoordinadorlaboratorios`
--

/*!50001 DROP VIEW IF EXISTS `vista_conteoiniciocoordinadorlaboratorios`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_conteoiniciocoordinadorlaboratorios` AS select (select count(0) from `usuarios` where `usuarios`.`idrolusuario` = 2) AS `CantidadAdministradoresLaboratorios`,(select count(0) from `usuarios` where `usuarios`.`idrolusuario` = 3) AS `CantidadDocentes`,(select count(0) from `laboratorios` where `laboratorios`.`estadolaboratorio` = 'inactivo') AS `CantidadLaboratoriosInactivos`,(select count(0) from `aplicaciones_laboratorios`) AS `CantidadAplicaciones` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_detallereservacionesregistradas`
--

/*!50001 DROP VIEW IF EXISTS `vista_detallereservacionesregistradas`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_detallereservacionesregistradas` AS select `reservaciones`.`idreservacion` AS `idreservacion`,`reservaciones`.`idaplicacion` AS `idaplicacion`,`reservaciones`.`idusuarios` AS `idusuarios`,`reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`idtiporeservacion` AS `idtiporeservacion`,`reservaciones`.`idfacultad` AS `idfacultad`,`reservaciones`.`idescuela` AS `idescuela`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`usuarios`.`codigousuario` AS `codigousuario`,`laboratorios`.`codigolaboratorio` AS `codigolaboratorio`,`laboratorios`.`nombrelaboratorio` AS `nombrelaboratorio`,`tipo_reservaciones`.`tiporeservacion` AS `tiporeservacion`,`reservaciones`.`codigounico_identificador` AS `codigounico_identificador`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`reservaciones`.`ciclo` AS `ciclo`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`seccionreservacion` AS `seccionreservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`fechafinreservacion` AS `fechafinreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion`,`reservaciones`.`numerousuarios` AS `numerousuarios`,`reservaciones`.`otrotipo_reservacion` AS `otrotipo_reservacion`,`reservaciones`.`comentario_adminlaboratorios` AS `comentario_adminlaboratorios`,`reservaciones`.`comentario_coordlaboratorio` AS `comentario_coordlaboratorio`,`reservaciones`.`estadoreservacion` AS `estadoreservacion`,`reservaciones`.`finalizado` AS `finalizado`,`reservaciones`.`fecharegistro` AS `fecharegistro`,`reservaciones`.`completo_seguimiento` AS `completo_seguimiento`,`reservaciones`.`mod1` AS `mod1`,`reservaciones`.`mod2` AS `mod2`,`reservaciones`.`mod3` AS `mod3`,`reservaciones`.`mod4` AS `mod4`,`reservaciones`.`titular_reservacion` AS `titular_reservacion`,`reservaciones`.`nombre_otrotitular` AS `nombre_otrotitular`,`reservaciones`.`aula_procedencia` AS `aula_procedencia`,`reservaciones`.`comentario_cancelacion` AS `comentario_cancelacion` from (((`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) join `laboratorios` on(`reservaciones`.`idlaboratorio` = `laboratorios`.`idlaboratorio`)) join `tipo_reservaciones` on(`reservaciones`.`idtiporeservacion` = `tipo_reservaciones`.`idtiporeservacion`)) order by `reservaciones`.`idreservacion` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_detallespefilusuarios`
--

/*!50001 DROP VIEW IF EXISTS `vista_detallespefilusuarios`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_detallespefilusuarios` AS select `usuarios`.`idusuarios` AS `idusuarios`,`usuarios`.`idrolusuario` AS `idrolusuario`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`usuarios`.`codigousuario` AS `codigousuario`,`usuarios`.`correo` AS `correo`,`usuarios`.`fotoperfil` AS `fotoperfil`,`usuarios`.`ultimo_cambio_contrasenia` AS `ultimo_cambio_contrasenia`,`usuarios`.`estado_usuario` AS `estado_usuario`,`usuarios`.`fecha_registro` AS `fecha_registro`,`detallesusuarios`.`telefonoprincipal` AS `telefonoprincipal`,`detallesusuarios`.`genero` AS `genero`,`detallesusuarios`.`fechanacimiento` AS `fechanacimiento`,`detallesusuarios`.`estadocivil` AS `estadocivil`,`usuarios`.`lab1` AS `lab1`,`usuarios`.`lab2` AS `lab2`,`usuarios`.`lab3` AS `lab3`,`usuarios`.`lab4` AS `lab4`,`usuarios`.`lab5` AS `lab5`,`usuarios`.`lab6` AS `lab6`,`usuarios`.`lab7` AS `lab7`,`usuarios`.`lab8` AS `lab8`,`usuarios`.`lab9` AS `lab9`,`usuarios`.`lab10` AS `lab10`,`usuarios`.`lab11` AS `lab11`,`usuarios`.`lab12` AS `lab12`,`usuarios`.`lab13` AS `lab13`,`usuarios`.`lab14` AS `lab14`,`usuarios`.`lab15` AS `lab15`,`usuarios`.`ubic_lab1` AS `ubic_lab1`,`usuarios`.`ubic_lab2` AS `ubic_lab2`,`usuarios`.`ubic_lab3` AS `ubic_lab3`,`usuarios`.`ubic_lab4` AS `ubic_lab4`,`usuarios`.`ubic_lab5` AS `ubic_lab5`,`usuarios`.`ubic_lab6` AS `ubic_lab6`,`usuarios`.`ubic_lab7` AS `ubic_lab7`,`usuarios`.`ubic_lab8` AS `ubic_lab8`,`usuarios`.`ubic_lab9` AS `ubic_lab9`,`usuarios`.`ubic_lab10` AS `ubic_lab10`,`usuarios`.`ubic_lab11` AS `ubic_lab11`,`usuarios`.`ubic_lab12` AS `ubic_lab12`,`usuarios`.`ubic_lab13` AS `ubic_lab13`,`usuarios`.`ubic_lab14` AS `ubic_lab14`,`usuarios`.`ubic_lab15` AS `ubic_lab15`,`usuarios`.`extensiones` AS `extensiones` from (`usuarios` join `detallesusuarios` on(`detallesusuarios`.`idusuarios` = `usuarios`.`idusuarios`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_disponibilidadreservaciones`
--

/*!50001 DROP VIEW IF EXISTS `vista_disponibilidadreservaciones`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_disponibilidadreservaciones` AS select `reservaciones`.`idreservacion` AS `idreservacion`,`reservaciones`.`idlaboratorio` AS `idlaboratorio`,`laboratorios`.`codigolaboratorio` AS `codigolaboratorio`,`reservaciones`.`fechafinreservacion` AS `fechafinreservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`estadoreservacion` AS `estadoreservacion`,`reservaciones`.`numerousuarios` AS `numerousuarios`,`reservaciones`.`mod1` AS `mod1`,`reservaciones`.`mod2` AS `mod2`,`reservaciones`.`mod3` AS `mod3`,`reservaciones`.`mod4` AS `mod4` from (`reservaciones` join `laboratorios` on(`reservaciones`.`idlaboratorio` = `laboratorios`.`idlaboratorio`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_informaciongenerallaboratoriosreservaciones`
--

/*!50001 DROP VIEW IF EXISTS `vista_informaciongenerallaboratoriosreservaciones`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_informaciongenerallaboratoriosreservaciones` AS select `laboratorios`.`idlaboratorio` AS `idlaboratorio`,`laboratorios`.`codigolaboratorio` AS `codigolaboratorio`,`laboratorios`.`nombrelaboratorio` AS `nombrelaboratorio`,`laboratorios`.`capacidadlaboratorio` - `laboratorios`.`maquinasfuerauso` AS `capacidadreal`,`laboratorios`.`estadolaboratorio` AS `estadolaboratorio`,`laboratorios`.`codigocolor` AS `codigocolor` from `laboratorios` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_ingresosusuarios_iniciosesiones`
--

/*!50001 DROP VIEW IF EXISTS `vista_ingresosusuarios_iniciosesiones`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_ingresosusuarios_iniciosesiones` AS select `accesos`.`idacceso` AS `idacceso`,`accesos`.`fecha_ingreso` AS `fecha_ingreso`,`accesos`.`fecha_cierresesion` AS `fecha_cierresesion`,timestampdiff(MINUTE,`accesos`.`fecha_ingreso`,`accesos`.`fecha_cierresesion`) AS `duracion_sesion`,`accesos`.`idusuarios` AS `idusuarios` from `accesos` order by `accesos`.`fecha_ingreso` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_laboratoriosasignadosusuarios`
--

/*!50001 DROP VIEW IF EXISTS `vista_laboratoriosasignadosusuarios`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_laboratoriosasignadosusuarios` AS select `usuarios`.`idusuarios` AS `idusuarios`,`usuarios`.`codigousuario` AS `codigousuario`,`usuarios`.`idrolusuario` AS `idrolusuario`,`usuarios`.`lab1` AS `lab1`,`usuarios`.`lab2` AS `lab2`,`usuarios`.`lab3` AS `lab3`,`usuarios`.`lab4` AS `lab4`,`usuarios`.`lab5` AS `lab5`,`usuarios`.`lab6` AS `lab6`,`usuarios`.`lab7` AS `lab7`,`usuarios`.`lab8` AS `lab8`,`usuarios`.`lab9` AS `lab9`,`usuarios`.`lab10` AS `lab10`,`usuarios`.`lab11` AS `lab11`,`usuarios`.`lab12` AS `lab12`,`usuarios`.`lab13` AS `lab13`,`usuarios`.`lab14` AS `lab14`,`usuarios`.`lab15` AS `lab15` from `usuarios` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_laboratoriosinformaticaregistrados`
--

/*!50001 DROP VIEW IF EXISTS `vista_laboratoriosinformaticaregistrados`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_laboratoriosinformaticaregistrados` AS select `laboratorios`.`idlaboratorio` AS `idlaboratorio`,`laboratorios`.`codigolaboratorio` AS `codigolaboratorio`,`laboratorios`.`nombrelaboratorio` AS `nombrelaboratorio`,`laboratorios`.`capacidadlaboratorio` AS `capacidadlaboratorio`,`laboratorios`.`maquinasfuerauso` AS `maquinasfuerauso`,`laboratorios`.`estadolaboratorio` AS `estadolaboratorio`,`laboratorios`.`codigocolor` AS `codigocolor` from `laboratorios` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_listadoescuelasfacultades`
--

/*!50001 DROP VIEW IF EXISTS `vista_listadoescuelasfacultades`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_listadoescuelasfacultades` AS select `escuelas`.`idescuela` AS `idescuela`,`escuelas`.`nombre_escuela` AS `nombre_escuela`,`escuelas`.`idfacultad` AS `idfacultad` from `escuelas` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_listadofacultadesregistradas`
--

/*!50001 DROP VIEW IF EXISTS `vista_listadofacultadesregistradas`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_listadofacultadesregistradas` AS select `facultades`.`idfacultad` AS `idfacultad`,`facultades`.`nombrefacultad` AS `nombrefacultad`,`facultades`.`codigofacultad` AS `codigofacultad` from `facultades` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_listadogeneralaplicacionesinstaladaslaboratorios`
--

/*!50001 DROP VIEW IF EXISTS `vista_listadogeneralaplicacionesinstaladaslaboratorios`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_listadogeneralaplicacionesinstaladaslaboratorios` AS select `aplicaciones_laboratorios`.`idaplicacion` AS `idaplicacion`,`aplicaciones_laboratorios`.`codigoaplicacion` AS `codigoaplicacion`,`aplicaciones_laboratorios`.`nombreaplicacion` AS `nombreaplicacion`,`aplicaciones_laboratorios`.`lab1` AS `lab1`,`aplicaciones_laboratorios`.`lab2` AS `lab2`,`aplicaciones_laboratorios`.`lab3` AS `lab3`,`aplicaciones_laboratorios`.`lab4` AS `lab4`,`aplicaciones_laboratorios`.`lab5` AS `lab5`,`aplicaciones_laboratorios`.`lab6` AS `lab6`,`aplicaciones_laboratorios`.`lab7` AS `lab7`,`aplicaciones_laboratorios`.`lab8` AS `lab8`,`aplicaciones_laboratorios`.`lab9` AS `lab9`,`aplicaciones_laboratorios`.`lab10` AS `lab10`,`aplicaciones_laboratorios`.`lab11` AS `lab11`,`aplicaciones_laboratorios`.`lab12` AS `lab12`,`aplicaciones_laboratorios`.`lab13` AS `lab13`,`aplicaciones_laboratorios`.`lab14` AS `lab14`,`aplicaciones_laboratorios`.`lab15` AS `lab15`,`aplicaciones_laboratorios`.`idclasificacionlaboratorio` AS `idclasificacionlaboratorio`,`clasificacion_aplicaciones_laboratorios`.`codigoclasificacionlaboratorio` AS `codigoclasificacionlaboratorio`,`aplicaciones_laboratorios`.`fecharegistro` AS `fecharegistro` from (`aplicaciones_laboratorios` join `clasificacion_aplicaciones_laboratorios` on(`aplicaciones_laboratorios`.`idclasificacionlaboratorio` = `clasificacion_aplicaciones_laboratorios`.`idclasificacionlaboratorio`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_listadonotificacionesrecibidas`
--

/*!50001 DROP VIEW IF EXISTS `vista_listadonotificacionesrecibidas`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_listadonotificacionesrecibidas` AS select `notificaciones`.`idnotificaciones` AS `idnotificaciones`,`notificaciones`.`idusuarios` AS `idusuarios`,`notificaciones`.`titulonotificacion` AS `titulonotificacion`,`notificaciones`.`descripcion_notificacion` AS `descripcion_notificacion`,`notificaciones`.`fechanotificacion` AS `fechanotificacion`,`notificaciones`.`idclasificacion` AS `idclasificacion`,`clasificacion_notificaciones`.`codigoclasificacion` AS `codigoclasificacion`,`notificaciones`.`ocultarnotificacion` AS `ocultarnotificacion` from (`notificaciones` join `clasificacion_notificaciones` on(`notificaciones`.`idclasificacion` = `clasificacion_notificaciones`.`idclasificacion`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_listadoreportesplataformaregistrados`
--

/*!50001 DROP VIEW IF EXISTS `vista_listadoreportesplataformaregistrados`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_listadoreportesplataformaregistrados` AS select `manifiestos_plataforma`.`idmanifiesto` AS `idmanifiesto`,`manifiestos_plataforma`.`idusuarios` AS `idusuarios`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`usuarios`.`codigousuario` AS `codigousuario`,`manifiestos_plataforma`.`nombremanifiesto` AS `nombremanifiesto`,`manifiestos_plataforma`.`descripcionmanifiesto` AS `descripcionmanifiesto`,`manifiestos_plataforma`.`fotomanifiesto` AS `fotomanifiesto`,`manifiestos_plataforma`.`fecharegistro` AS `fecharegistro`,`manifiestos_plataforma`.`fecha_actualizacion` AS `fecha_actualizacion`,`manifiestos_plataforma`.`estado` AS `estado`,`manifiestos_plataforma`.`comentario_actualizacion` AS `comentario_actualizacion` from (`manifiestos_plataforma` join `usuarios` on(`manifiestos_plataforma`.`idusuarios` = `usuarios`.`idusuarios`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_listadotiposreservaciones`
--

/*!50001 DROP VIEW IF EXISTS `vista_listadotiposreservaciones`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_listadotiposreservaciones` AS select `tipo_reservaciones`.`idtiporeservacion` AS `idtiporeservacion`,`tipo_reservaciones`.`tiporeservacion` AS `tiporeservacion`,`tipo_reservaciones`.`descripciontiporeservacion` AS `descripciontiporeservacion` from `tipo_reservaciones` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_practicalibresfinalizadas`
--

/*!50001 DROP VIEW IF EXISTS `vista_practicalibresfinalizadas`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_practicalibresfinalizadas` AS select `practicas_libres`.`idpracticalibre` AS `idpracticalibre`,`practicas_libres`.`idaplicacion` AS `idaplicacion`,`aplicaciones_laboratorios`.`nombreaplicacion` AS `nombreaplicacion`,`practicas_libres`.`idlaboratorio` AS `idlaboratorio`,`practicas_libres`.`idfacultad` AS `idfacultad`,`facultades`.`nombrefacultad` AS `nombrefacultad`,`practicas_libres`.`idusuarios` AS `idusuarios`,`practicas_libres`.`nombreusuario_reservacion` AS `nombreusuario_reservacion`,`practicas_libres`.`carneusuario_reservacion` AS `carneusuario_reservacion`,`practicas_libres`.`fechainicio` AS `fechainicio`,`practicas_libres`.`horainicio` AS `horainicio`,`practicas_libres`.`horafin` AS `horafin`,`practicas_libres`.`ciclo` AS `ciclo`,`practicas_libres`.`estado` AS `estado`,`usuarios`.`codigousuario` AS `quienregistro`,timestampdiff(MINUTE,`practicas_libres`.`horainicio`,`practicas_libres`.`horafin`) AS `duracionpractica` from (((`practicas_libres` join `aplicaciones_laboratorios` on(`practicas_libres`.`idaplicacion` = `aplicaciones_laboratorios`.`idaplicacion`)) join `facultades` on(`practicas_libres`.`idfacultad` = `facultades`.`idfacultad`)) join `usuarios` on(`practicas_libres`.`idusuarios` = `usuarios`.`idusuarios`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_practicalibresfinalizadaslab1`
--

/*!50001 DROP VIEW IF EXISTS `vista_practicalibresfinalizadaslab1`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_practicalibresfinalizadaslab1` AS select `vista_practicalibresfinalizadas`.`idpracticalibre` AS `idpracticalibre`,`vista_practicalibresfinalizadas`.`idaplicacion` AS `idaplicacion`,`vista_practicalibresfinalizadas`.`nombreaplicacion` AS `nombreaplicacion`,`vista_practicalibresfinalizadas`.`idlaboratorio` AS `idlaboratorio`,`vista_practicalibresfinalizadas`.`idfacultad` AS `idfacultad`,`vista_practicalibresfinalizadas`.`nombrefacultad` AS `nombrefacultad`,`vista_practicalibresfinalizadas`.`idusuarios` AS `idusuarios`,`vista_practicalibresfinalizadas`.`nombreusuario_reservacion` AS `nombreusuario_reservacion`,`vista_practicalibresfinalizadas`.`carneusuario_reservacion` AS `carneusuario_reservacion`,`vista_practicalibresfinalizadas`.`fechainicio` AS `fechainicio`,`vista_practicalibresfinalizadas`.`horainicio` AS `horainicio`,`vista_practicalibresfinalizadas`.`horafin` AS `horafin`,`vista_practicalibresfinalizadas`.`ciclo` AS `ciclo`,`vista_practicalibresfinalizadas`.`estado` AS `estado`,`vista_practicalibresfinalizadas`.`quienregistro` AS `quienregistro`,`vista_practicalibresfinalizadas`.`duracionpractica` AS `duracionpractica` from `vista_practicalibresfinalizadas` where `vista_practicalibresfinalizadas`.`idlaboratorio` = 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_practicalibresfinalizadaslab10`
--

/*!50001 DROP VIEW IF EXISTS `vista_practicalibresfinalizadaslab10`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_practicalibresfinalizadaslab10` AS select `vista_practicalibresfinalizadas`.`idpracticalibre` AS `idpracticalibre`,`vista_practicalibresfinalizadas`.`idaplicacion` AS `idaplicacion`,`vista_practicalibresfinalizadas`.`nombreaplicacion` AS `nombreaplicacion`,`vista_practicalibresfinalizadas`.`idlaboratorio` AS `idlaboratorio`,`vista_practicalibresfinalizadas`.`idfacultad` AS `idfacultad`,`vista_practicalibresfinalizadas`.`nombrefacultad` AS `nombrefacultad`,`vista_practicalibresfinalizadas`.`idusuarios` AS `idusuarios`,`vista_practicalibresfinalizadas`.`nombreusuario_reservacion` AS `nombreusuario_reservacion`,`vista_practicalibresfinalizadas`.`carneusuario_reservacion` AS `carneusuario_reservacion`,`vista_practicalibresfinalizadas`.`fechainicio` AS `fechainicio`,`vista_practicalibresfinalizadas`.`horainicio` AS `horainicio`,`vista_practicalibresfinalizadas`.`horafin` AS `horafin`,`vista_practicalibresfinalizadas`.`ciclo` AS `ciclo`,`vista_practicalibresfinalizadas`.`estado` AS `estado`,`vista_practicalibresfinalizadas`.`quienregistro` AS `quienregistro`,`vista_practicalibresfinalizadas`.`duracionpractica` AS `duracionpractica` from `vista_practicalibresfinalizadas` where `vista_practicalibresfinalizadas`.`idlaboratorio` = 10 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_practicalibresfinalizadaslab11`
--

/*!50001 DROP VIEW IF EXISTS `vista_practicalibresfinalizadaslab11`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_practicalibresfinalizadaslab11` AS select `vista_practicalibresfinalizadas`.`idpracticalibre` AS `idpracticalibre`,`vista_practicalibresfinalizadas`.`idaplicacion` AS `idaplicacion`,`vista_practicalibresfinalizadas`.`nombreaplicacion` AS `nombreaplicacion`,`vista_practicalibresfinalizadas`.`idlaboratorio` AS `idlaboratorio`,`vista_practicalibresfinalizadas`.`idfacultad` AS `idfacultad`,`vista_practicalibresfinalizadas`.`nombrefacultad` AS `nombrefacultad`,`vista_practicalibresfinalizadas`.`idusuarios` AS `idusuarios`,`vista_practicalibresfinalizadas`.`nombreusuario_reservacion` AS `nombreusuario_reservacion`,`vista_practicalibresfinalizadas`.`carneusuario_reservacion` AS `carneusuario_reservacion`,`vista_practicalibresfinalizadas`.`fechainicio` AS `fechainicio`,`vista_practicalibresfinalizadas`.`horainicio` AS `horainicio`,`vista_practicalibresfinalizadas`.`horafin` AS `horafin`,`vista_practicalibresfinalizadas`.`ciclo` AS `ciclo`,`vista_practicalibresfinalizadas`.`estado` AS `estado`,`vista_practicalibresfinalizadas`.`quienregistro` AS `quienregistro`,`vista_practicalibresfinalizadas`.`duracionpractica` AS `duracionpractica` from `vista_practicalibresfinalizadas` where `vista_practicalibresfinalizadas`.`idlaboratorio` = 11 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_practicalibresfinalizadaslab12`
--

/*!50001 DROP VIEW IF EXISTS `vista_practicalibresfinalizadaslab12`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_practicalibresfinalizadaslab12` AS select `vista_practicalibresfinalizadas`.`idpracticalibre` AS `idpracticalibre`,`vista_practicalibresfinalizadas`.`idaplicacion` AS `idaplicacion`,`vista_practicalibresfinalizadas`.`nombreaplicacion` AS `nombreaplicacion`,`vista_practicalibresfinalizadas`.`idlaboratorio` AS `idlaboratorio`,`vista_practicalibresfinalizadas`.`idfacultad` AS `idfacultad`,`vista_practicalibresfinalizadas`.`nombrefacultad` AS `nombrefacultad`,`vista_practicalibresfinalizadas`.`idusuarios` AS `idusuarios`,`vista_practicalibresfinalizadas`.`nombreusuario_reservacion` AS `nombreusuario_reservacion`,`vista_practicalibresfinalizadas`.`carneusuario_reservacion` AS `carneusuario_reservacion`,`vista_practicalibresfinalizadas`.`fechainicio` AS `fechainicio`,`vista_practicalibresfinalizadas`.`horainicio` AS `horainicio`,`vista_practicalibresfinalizadas`.`horafin` AS `horafin`,`vista_practicalibresfinalizadas`.`ciclo` AS `ciclo`,`vista_practicalibresfinalizadas`.`estado` AS `estado`,`vista_practicalibresfinalizadas`.`quienregistro` AS `quienregistro`,`vista_practicalibresfinalizadas`.`duracionpractica` AS `duracionpractica` from `vista_practicalibresfinalizadas` where `vista_practicalibresfinalizadas`.`idlaboratorio` = 12 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_practicalibresfinalizadaslab13`
--

/*!50001 DROP VIEW IF EXISTS `vista_practicalibresfinalizadaslab13`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_practicalibresfinalizadaslab13` AS select `vista_practicalibresfinalizadas`.`idpracticalibre` AS `idpracticalibre`,`vista_practicalibresfinalizadas`.`idaplicacion` AS `idaplicacion`,`vista_practicalibresfinalizadas`.`nombreaplicacion` AS `nombreaplicacion`,`vista_practicalibresfinalizadas`.`idlaboratorio` AS `idlaboratorio`,`vista_practicalibresfinalizadas`.`idfacultad` AS `idfacultad`,`vista_practicalibresfinalizadas`.`nombrefacultad` AS `nombrefacultad`,`vista_practicalibresfinalizadas`.`idusuarios` AS `idusuarios`,`vista_practicalibresfinalizadas`.`nombreusuario_reservacion` AS `nombreusuario_reservacion`,`vista_practicalibresfinalizadas`.`carneusuario_reservacion` AS `carneusuario_reservacion`,`vista_practicalibresfinalizadas`.`fechainicio` AS `fechainicio`,`vista_practicalibresfinalizadas`.`horainicio` AS `horainicio`,`vista_practicalibresfinalizadas`.`horafin` AS `horafin`,`vista_practicalibresfinalizadas`.`ciclo` AS `ciclo`,`vista_practicalibresfinalizadas`.`estado` AS `estado`,`vista_practicalibresfinalizadas`.`quienregistro` AS `quienregistro`,`vista_practicalibresfinalizadas`.`duracionpractica` AS `duracionpractica` from `vista_practicalibresfinalizadas` where `vista_practicalibresfinalizadas`.`idlaboratorio` = 13 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_practicalibresfinalizadaslab14`
--

/*!50001 DROP VIEW IF EXISTS `vista_practicalibresfinalizadaslab14`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_practicalibresfinalizadaslab14` AS select `vista_practicalibresfinalizadas`.`idpracticalibre` AS `idpracticalibre`,`vista_practicalibresfinalizadas`.`idaplicacion` AS `idaplicacion`,`vista_practicalibresfinalizadas`.`nombreaplicacion` AS `nombreaplicacion`,`vista_practicalibresfinalizadas`.`idlaboratorio` AS `idlaboratorio`,`vista_practicalibresfinalizadas`.`idfacultad` AS `idfacultad`,`vista_practicalibresfinalizadas`.`nombrefacultad` AS `nombrefacultad`,`vista_practicalibresfinalizadas`.`idusuarios` AS `idusuarios`,`vista_practicalibresfinalizadas`.`nombreusuario_reservacion` AS `nombreusuario_reservacion`,`vista_practicalibresfinalizadas`.`carneusuario_reservacion` AS `carneusuario_reservacion`,`vista_practicalibresfinalizadas`.`fechainicio` AS `fechainicio`,`vista_practicalibresfinalizadas`.`horainicio` AS `horainicio`,`vista_practicalibresfinalizadas`.`horafin` AS `horafin`,`vista_practicalibresfinalizadas`.`ciclo` AS `ciclo`,`vista_practicalibresfinalizadas`.`estado` AS `estado`,`vista_practicalibresfinalizadas`.`quienregistro` AS `quienregistro`,`vista_practicalibresfinalizadas`.`duracionpractica` AS `duracionpractica` from `vista_practicalibresfinalizadas` where `vista_practicalibresfinalizadas`.`idlaboratorio` = 14 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_practicalibresfinalizadaslab15`
--

/*!50001 DROP VIEW IF EXISTS `vista_practicalibresfinalizadaslab15`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_practicalibresfinalizadaslab15` AS select `vista_practicalibresfinalizadas`.`idpracticalibre` AS `idpracticalibre`,`vista_practicalibresfinalizadas`.`idaplicacion` AS `idaplicacion`,`vista_practicalibresfinalizadas`.`nombreaplicacion` AS `nombreaplicacion`,`vista_practicalibresfinalizadas`.`idlaboratorio` AS `idlaboratorio`,`vista_practicalibresfinalizadas`.`idfacultad` AS `idfacultad`,`vista_practicalibresfinalizadas`.`nombrefacultad` AS `nombrefacultad`,`vista_practicalibresfinalizadas`.`idusuarios` AS `idusuarios`,`vista_practicalibresfinalizadas`.`nombreusuario_reservacion` AS `nombreusuario_reservacion`,`vista_practicalibresfinalizadas`.`carneusuario_reservacion` AS `carneusuario_reservacion`,`vista_practicalibresfinalizadas`.`fechainicio` AS `fechainicio`,`vista_practicalibresfinalizadas`.`horainicio` AS `horainicio`,`vista_practicalibresfinalizadas`.`horafin` AS `horafin`,`vista_practicalibresfinalizadas`.`ciclo` AS `ciclo`,`vista_practicalibresfinalizadas`.`estado` AS `estado`,`vista_practicalibresfinalizadas`.`quienregistro` AS `quienregistro`,`vista_practicalibresfinalizadas`.`duracionpractica` AS `duracionpractica` from `vista_practicalibresfinalizadas` where `vista_practicalibresfinalizadas`.`idlaboratorio` = 15 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_practicalibresfinalizadaslab2`
--

/*!50001 DROP VIEW IF EXISTS `vista_practicalibresfinalizadaslab2`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_practicalibresfinalizadaslab2` AS select `vista_practicalibresfinalizadas`.`idpracticalibre` AS `idpracticalibre`,`vista_practicalibresfinalizadas`.`idaplicacion` AS `idaplicacion`,`vista_practicalibresfinalizadas`.`nombreaplicacion` AS `nombreaplicacion`,`vista_practicalibresfinalizadas`.`idlaboratorio` AS `idlaboratorio`,`vista_practicalibresfinalizadas`.`idfacultad` AS `idfacultad`,`vista_practicalibresfinalizadas`.`nombrefacultad` AS `nombrefacultad`,`vista_practicalibresfinalizadas`.`idusuarios` AS `idusuarios`,`vista_practicalibresfinalizadas`.`nombreusuario_reservacion` AS `nombreusuario_reservacion`,`vista_practicalibresfinalizadas`.`carneusuario_reservacion` AS `carneusuario_reservacion`,`vista_practicalibresfinalizadas`.`fechainicio` AS `fechainicio`,`vista_practicalibresfinalizadas`.`horainicio` AS `horainicio`,`vista_practicalibresfinalizadas`.`horafin` AS `horafin`,`vista_practicalibresfinalizadas`.`ciclo` AS `ciclo`,`vista_practicalibresfinalizadas`.`estado` AS `estado`,`vista_practicalibresfinalizadas`.`quienregistro` AS `quienregistro`,`vista_practicalibresfinalizadas`.`duracionpractica` AS `duracionpractica` from `vista_practicalibresfinalizadas` where `vista_practicalibresfinalizadas`.`idlaboratorio` = 2 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_practicalibresfinalizadaslab3`
--

/*!50001 DROP VIEW IF EXISTS `vista_practicalibresfinalizadaslab3`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_practicalibresfinalizadaslab3` AS select `vista_practicalibresfinalizadas`.`idpracticalibre` AS `idpracticalibre`,`vista_practicalibresfinalizadas`.`idaplicacion` AS `idaplicacion`,`vista_practicalibresfinalizadas`.`nombreaplicacion` AS `nombreaplicacion`,`vista_practicalibresfinalizadas`.`idlaboratorio` AS `idlaboratorio`,`vista_practicalibresfinalizadas`.`idfacultad` AS `idfacultad`,`vista_practicalibresfinalizadas`.`nombrefacultad` AS `nombrefacultad`,`vista_practicalibresfinalizadas`.`idusuarios` AS `idusuarios`,`vista_practicalibresfinalizadas`.`nombreusuario_reservacion` AS `nombreusuario_reservacion`,`vista_practicalibresfinalizadas`.`carneusuario_reservacion` AS `carneusuario_reservacion`,`vista_practicalibresfinalizadas`.`fechainicio` AS `fechainicio`,`vista_practicalibresfinalizadas`.`horainicio` AS `horainicio`,`vista_practicalibresfinalizadas`.`horafin` AS `horafin`,`vista_practicalibresfinalizadas`.`ciclo` AS `ciclo`,`vista_practicalibresfinalizadas`.`estado` AS `estado`,`vista_practicalibresfinalizadas`.`quienregistro` AS `quienregistro`,`vista_practicalibresfinalizadas`.`duracionpractica` AS `duracionpractica` from `vista_practicalibresfinalizadas` where `vista_practicalibresfinalizadas`.`idlaboratorio` = 3 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_practicalibresfinalizadaslab4`
--

/*!50001 DROP VIEW IF EXISTS `vista_practicalibresfinalizadaslab4`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_practicalibresfinalizadaslab4` AS select `vista_practicalibresfinalizadas`.`idpracticalibre` AS `idpracticalibre`,`vista_practicalibresfinalizadas`.`idaplicacion` AS `idaplicacion`,`vista_practicalibresfinalizadas`.`nombreaplicacion` AS `nombreaplicacion`,`vista_practicalibresfinalizadas`.`idlaboratorio` AS `idlaboratorio`,`vista_practicalibresfinalizadas`.`idfacultad` AS `idfacultad`,`vista_practicalibresfinalizadas`.`nombrefacultad` AS `nombrefacultad`,`vista_practicalibresfinalizadas`.`idusuarios` AS `idusuarios`,`vista_practicalibresfinalizadas`.`nombreusuario_reservacion` AS `nombreusuario_reservacion`,`vista_practicalibresfinalizadas`.`carneusuario_reservacion` AS `carneusuario_reservacion`,`vista_practicalibresfinalizadas`.`fechainicio` AS `fechainicio`,`vista_practicalibresfinalizadas`.`horainicio` AS `horainicio`,`vista_practicalibresfinalizadas`.`horafin` AS `horafin`,`vista_practicalibresfinalizadas`.`ciclo` AS `ciclo`,`vista_practicalibresfinalizadas`.`estado` AS `estado`,`vista_practicalibresfinalizadas`.`quienregistro` AS `quienregistro`,`vista_practicalibresfinalizadas`.`duracionpractica` AS `duracionpractica` from `vista_practicalibresfinalizadas` where `vista_practicalibresfinalizadas`.`idlaboratorio` = 4 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_practicalibresfinalizadaslab5`
--

/*!50001 DROP VIEW IF EXISTS `vista_practicalibresfinalizadaslab5`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_practicalibresfinalizadaslab5` AS select `vista_practicalibresfinalizadas`.`idpracticalibre` AS `idpracticalibre`,`vista_practicalibresfinalizadas`.`idaplicacion` AS `idaplicacion`,`vista_practicalibresfinalizadas`.`nombreaplicacion` AS `nombreaplicacion`,`vista_practicalibresfinalizadas`.`idlaboratorio` AS `idlaboratorio`,`vista_practicalibresfinalizadas`.`idfacultad` AS `idfacultad`,`vista_practicalibresfinalizadas`.`nombrefacultad` AS `nombrefacultad`,`vista_practicalibresfinalizadas`.`idusuarios` AS `idusuarios`,`vista_practicalibresfinalizadas`.`nombreusuario_reservacion` AS `nombreusuario_reservacion`,`vista_practicalibresfinalizadas`.`carneusuario_reservacion` AS `carneusuario_reservacion`,`vista_practicalibresfinalizadas`.`fechainicio` AS `fechainicio`,`vista_practicalibresfinalizadas`.`horainicio` AS `horainicio`,`vista_practicalibresfinalizadas`.`horafin` AS `horafin`,`vista_practicalibresfinalizadas`.`ciclo` AS `ciclo`,`vista_practicalibresfinalizadas`.`estado` AS `estado`,`vista_practicalibresfinalizadas`.`quienregistro` AS `quienregistro`,`vista_practicalibresfinalizadas`.`duracionpractica` AS `duracionpractica` from `vista_practicalibresfinalizadas` where `vista_practicalibresfinalizadas`.`idlaboratorio` = 5 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_practicalibresfinalizadaslab6`
--

/*!50001 DROP VIEW IF EXISTS `vista_practicalibresfinalizadaslab6`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_practicalibresfinalizadaslab6` AS select `vista_practicalibresfinalizadas`.`idpracticalibre` AS `idpracticalibre`,`vista_practicalibresfinalizadas`.`idaplicacion` AS `idaplicacion`,`vista_practicalibresfinalizadas`.`nombreaplicacion` AS `nombreaplicacion`,`vista_practicalibresfinalizadas`.`idlaboratorio` AS `idlaboratorio`,`vista_practicalibresfinalizadas`.`idfacultad` AS `idfacultad`,`vista_practicalibresfinalizadas`.`nombrefacultad` AS `nombrefacultad`,`vista_practicalibresfinalizadas`.`idusuarios` AS `idusuarios`,`vista_practicalibresfinalizadas`.`nombreusuario_reservacion` AS `nombreusuario_reservacion`,`vista_practicalibresfinalizadas`.`carneusuario_reservacion` AS `carneusuario_reservacion`,`vista_practicalibresfinalizadas`.`fechainicio` AS `fechainicio`,`vista_practicalibresfinalizadas`.`horainicio` AS `horainicio`,`vista_practicalibresfinalizadas`.`horafin` AS `horafin`,`vista_practicalibresfinalizadas`.`ciclo` AS `ciclo`,`vista_practicalibresfinalizadas`.`estado` AS `estado`,`vista_practicalibresfinalizadas`.`quienregistro` AS `quienregistro`,`vista_practicalibresfinalizadas`.`duracionpractica` AS `duracionpractica` from `vista_practicalibresfinalizadas` where `vista_practicalibresfinalizadas`.`idlaboratorio` = 6 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_practicalibresfinalizadaslab7`
--

/*!50001 DROP VIEW IF EXISTS `vista_practicalibresfinalizadaslab7`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_practicalibresfinalizadaslab7` AS select `vista_practicalibresfinalizadas`.`idpracticalibre` AS `idpracticalibre`,`vista_practicalibresfinalizadas`.`idaplicacion` AS `idaplicacion`,`vista_practicalibresfinalizadas`.`nombreaplicacion` AS `nombreaplicacion`,`vista_practicalibresfinalizadas`.`idlaboratorio` AS `idlaboratorio`,`vista_practicalibresfinalizadas`.`idfacultad` AS `idfacultad`,`vista_practicalibresfinalizadas`.`nombrefacultad` AS `nombrefacultad`,`vista_practicalibresfinalizadas`.`idusuarios` AS `idusuarios`,`vista_practicalibresfinalizadas`.`nombreusuario_reservacion` AS `nombreusuario_reservacion`,`vista_practicalibresfinalizadas`.`carneusuario_reservacion` AS `carneusuario_reservacion`,`vista_practicalibresfinalizadas`.`fechainicio` AS `fechainicio`,`vista_practicalibresfinalizadas`.`horainicio` AS `horainicio`,`vista_practicalibresfinalizadas`.`horafin` AS `horafin`,`vista_practicalibresfinalizadas`.`ciclo` AS `ciclo`,`vista_practicalibresfinalizadas`.`estado` AS `estado`,`vista_practicalibresfinalizadas`.`quienregistro` AS `quienregistro`,`vista_practicalibresfinalizadas`.`duracionpractica` AS `duracionpractica` from `vista_practicalibresfinalizadas` where `vista_practicalibresfinalizadas`.`idlaboratorio` = 7 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_practicalibresfinalizadaslab8`
--

/*!50001 DROP VIEW IF EXISTS `vista_practicalibresfinalizadaslab8`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_practicalibresfinalizadaslab8` AS select `vista_practicalibresfinalizadas`.`idpracticalibre` AS `idpracticalibre`,`vista_practicalibresfinalizadas`.`idaplicacion` AS `idaplicacion`,`vista_practicalibresfinalizadas`.`nombreaplicacion` AS `nombreaplicacion`,`vista_practicalibresfinalizadas`.`idlaboratorio` AS `idlaboratorio`,`vista_practicalibresfinalizadas`.`idfacultad` AS `idfacultad`,`vista_practicalibresfinalizadas`.`nombrefacultad` AS `nombrefacultad`,`vista_practicalibresfinalizadas`.`idusuarios` AS `idusuarios`,`vista_practicalibresfinalizadas`.`nombreusuario_reservacion` AS `nombreusuario_reservacion`,`vista_practicalibresfinalizadas`.`carneusuario_reservacion` AS `carneusuario_reservacion`,`vista_practicalibresfinalizadas`.`fechainicio` AS `fechainicio`,`vista_practicalibresfinalizadas`.`horainicio` AS `horainicio`,`vista_practicalibresfinalizadas`.`horafin` AS `horafin`,`vista_practicalibresfinalizadas`.`ciclo` AS `ciclo`,`vista_practicalibresfinalizadas`.`estado` AS `estado`,`vista_practicalibresfinalizadas`.`quienregistro` AS `quienregistro`,`vista_practicalibresfinalizadas`.`duracionpractica` AS `duracionpractica` from `vista_practicalibresfinalizadas` where `vista_practicalibresfinalizadas`.`idlaboratorio` = 8 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_practicalibresfinalizadaslab9`
--

/*!50001 DROP VIEW IF EXISTS `vista_practicalibresfinalizadaslab9`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_practicalibresfinalizadaslab9` AS select `vista_practicalibresfinalizadas`.`idpracticalibre` AS `idpracticalibre`,`vista_practicalibresfinalizadas`.`idaplicacion` AS `idaplicacion`,`vista_practicalibresfinalizadas`.`nombreaplicacion` AS `nombreaplicacion`,`vista_practicalibresfinalizadas`.`idlaboratorio` AS `idlaboratorio`,`vista_practicalibresfinalizadas`.`idfacultad` AS `idfacultad`,`vista_practicalibresfinalizadas`.`nombrefacultad` AS `nombrefacultad`,`vista_practicalibresfinalizadas`.`idusuarios` AS `idusuarios`,`vista_practicalibresfinalizadas`.`nombreusuario_reservacion` AS `nombreusuario_reservacion`,`vista_practicalibresfinalizadas`.`carneusuario_reservacion` AS `carneusuario_reservacion`,`vista_practicalibresfinalizadas`.`fechainicio` AS `fechainicio`,`vista_practicalibresfinalizadas`.`horainicio` AS `horainicio`,`vista_practicalibresfinalizadas`.`horafin` AS `horafin`,`vista_practicalibresfinalizadas`.`ciclo` AS `ciclo`,`vista_practicalibresfinalizadas`.`estado` AS `estado`,`vista_practicalibresfinalizadas`.`quienregistro` AS `quienregistro`,`vista_practicalibresfinalizadas`.`duracionpractica` AS `duracionpractica` from `vista_practicalibresfinalizadas` where `vista_practicalibresfinalizadas`.`idlaboratorio` = 9 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_practicaslibresprocesadas`
--

/*!50001 DROP VIEW IF EXISTS `vista_practicaslibresprocesadas`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_practicaslibresprocesadas` AS select `practicas_libres`.`idpracticalibre` AS `idpracticalibre`,`practicas_libres`.`idaplicacion` AS `idaplicacion`,`practicas_libres`.`idtiporeservacion` AS `idtiporeservacion`,`practicas_libres`.`idlaboratorio` AS `idlaboratorio`,`practicas_libres`.`idfacultad` AS `idfacultad`,`practicas_libres`.`idusuarios` AS `idusuarios`,`aplicaciones_laboratorios`.`nombreaplicacion` AS `nombreaplicacion`,`facultades`.`nombrefacultad` AS `nombrefacultad`,`practicas_libres`.`nombreusuario_reservacion` AS `nombreusuario_reservacion`,`practicas_libres`.`carneusuario_reservacion` AS `carneusuario_reservacion`,`practicas_libres`.`fechainicio` AS `fechainicio`,`practicas_libres`.`horainicio` AS `horainicio`,`practicas_libres`.`horafin` AS `horafin`,`practicas_libres`.`ciclo` AS `ciclo`,`practicas_libres`.`estado` AS `estado` from ((`practicas_libres` join `aplicaciones_laboratorios` on(`practicas_libres`.`idaplicacion` = `aplicaciones_laboratorios`.`idaplicacion`)) join `facultades` on(`practicas_libres`.`idfacultad` = `facultades`.`idfacultad`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_proximareservacionlabotatorio1`
--

/*!50001 DROP VIEW IF EXISTS `vista_proximareservacionlabotatorio1`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_proximareservacionlabotatorio1` AS select distinct `reservaciones`.`idreservacion` AS `idreservacion`,`reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion`,`reservaciones`.`finalizado` AS `finalizado`,`reservaciones`.`fecharegistro` AS `fecharegistro`,`reservaciones`.`estadoreservacion` AS `estadoreservacion` from (`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) where `reservaciones`.`idlaboratorio` = 1 and `reservaciones`.`estadoreservacion` = 'aprobado' and `reservaciones`.`fechainicioreservacion` = cast(current_timestamp() as date) and `reservaciones`.`fechafinreservacion` = cast(current_timestamp() as date) and `reservaciones`.`horainicioreservacion` <= cast(current_timestamp() as time) and `reservaciones`.`horafinreservacion` >= cast(current_timestamp() as time) order by `reservaciones`.`fechainicioreservacion`,`reservaciones`.`horainicioreservacion` limit 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_proximareservacionlabotatorio10`
--

/*!50001 DROP VIEW IF EXISTS `vista_proximareservacionlabotatorio10`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_proximareservacionlabotatorio10` AS select distinct `reservaciones`.`idreservacion` AS `idreservacion`,`reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion`,`reservaciones`.`finalizado` AS `finalizado`,`reservaciones`.`fecharegistro` AS `fecharegistro`,`reservaciones`.`estadoreservacion` AS `estadoreservacion` from (`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) where `reservaciones`.`idlaboratorio` = 10 and `reservaciones`.`estadoreservacion` = 'aprobado' and `reservaciones`.`fechainicioreservacion` = cast(current_timestamp() as date) and `reservaciones`.`fechafinreservacion` = cast(current_timestamp() as date) and `reservaciones`.`horainicioreservacion` <= cast(current_timestamp() as time) and `reservaciones`.`horafinreservacion` >= cast(current_timestamp() as time) order by `reservaciones`.`fechainicioreservacion`,`reservaciones`.`horainicioreservacion` limit 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_proximareservacionlabotatorio11`
--

/*!50001 DROP VIEW IF EXISTS `vista_proximareservacionlabotatorio11`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_proximareservacionlabotatorio11` AS select distinct `reservaciones`.`idreservacion` AS `idreservacion`,`reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion`,`reservaciones`.`finalizado` AS `finalizado`,`reservaciones`.`fecharegistro` AS `fecharegistro`,`reservaciones`.`estadoreservacion` AS `estadoreservacion` from (`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) where `reservaciones`.`idlaboratorio` = 11 and `reservaciones`.`estadoreservacion` = 'aprobado' and `reservaciones`.`fechainicioreservacion` = cast(current_timestamp() as date) and `reservaciones`.`fechafinreservacion` = cast(current_timestamp() as date) and `reservaciones`.`horainicioreservacion` <= cast(current_timestamp() as time) and `reservaciones`.`horafinreservacion` >= cast(current_timestamp() as time) order by `reservaciones`.`fechainicioreservacion`,`reservaciones`.`horainicioreservacion` limit 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_proximareservacionlabotatorio12`
--

/*!50001 DROP VIEW IF EXISTS `vista_proximareservacionlabotatorio12`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_proximareservacionlabotatorio12` AS select distinct `reservaciones`.`idreservacion` AS `idreservacion`,`reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion`,`reservaciones`.`finalizado` AS `finalizado`,`reservaciones`.`fecharegistro` AS `fecharegistro`,`reservaciones`.`estadoreservacion` AS `estadoreservacion` from (`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) where `reservaciones`.`idlaboratorio` = 12 and `reservaciones`.`estadoreservacion` = 'aprobado' and `reservaciones`.`fechainicioreservacion` = cast(current_timestamp() as date) and `reservaciones`.`fechafinreservacion` = cast(current_timestamp() as date) and `reservaciones`.`horainicioreservacion` <= cast(current_timestamp() as time) and `reservaciones`.`horafinreservacion` >= cast(current_timestamp() as time) order by `reservaciones`.`fechainicioreservacion`,`reservaciones`.`horainicioreservacion` limit 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_proximareservacionlabotatorio13`
--

/*!50001 DROP VIEW IF EXISTS `vista_proximareservacionlabotatorio13`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_proximareservacionlabotatorio13` AS select distinct `reservaciones`.`idreservacion` AS `idreservacion`,`reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion`,`reservaciones`.`finalizado` AS `finalizado`,`reservaciones`.`fecharegistro` AS `fecharegistro`,`reservaciones`.`estadoreservacion` AS `estadoreservacion` from (`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) where `reservaciones`.`idlaboratorio` = 13 and `reservaciones`.`estadoreservacion` = 'aprobado' and `reservaciones`.`fechainicioreservacion` = cast(current_timestamp() as date) and `reservaciones`.`fechafinreservacion` = cast(current_timestamp() as date) and `reservaciones`.`horainicioreservacion` <= cast(current_timestamp() as time) and `reservaciones`.`horafinreservacion` >= cast(current_timestamp() as time) order by `reservaciones`.`fechainicioreservacion`,`reservaciones`.`horainicioreservacion` limit 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_proximareservacionlabotatorio14`
--

/*!50001 DROP VIEW IF EXISTS `vista_proximareservacionlabotatorio14`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_proximareservacionlabotatorio14` AS select distinct `reservaciones`.`idreservacion` AS `idreservacion`,`reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion`,`reservaciones`.`finalizado` AS `finalizado`,`reservaciones`.`fecharegistro` AS `fecharegistro`,`reservaciones`.`estadoreservacion` AS `estadoreservacion` from (`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) where `reservaciones`.`idlaboratorio` = 14 and `reservaciones`.`estadoreservacion` = 'aprobado' and `reservaciones`.`fechainicioreservacion` = cast(current_timestamp() as date) and `reservaciones`.`fechafinreservacion` = cast(current_timestamp() as date) and `reservaciones`.`horainicioreservacion` <= cast(current_timestamp() as time) and `reservaciones`.`horafinreservacion` >= cast(current_timestamp() as time) order by `reservaciones`.`fechainicioreservacion`,`reservaciones`.`horainicioreservacion` limit 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_proximareservacionlabotatorio15`
--

/*!50001 DROP VIEW IF EXISTS `vista_proximareservacionlabotatorio15`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_proximareservacionlabotatorio15` AS select distinct `reservaciones`.`idreservacion` AS `idreservacion`,`reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion`,`reservaciones`.`finalizado` AS `finalizado`,`reservaciones`.`fecharegistro` AS `fecharegistro`,`reservaciones`.`estadoreservacion` AS `estadoreservacion` from (`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) where `reservaciones`.`idlaboratorio` = 15 and `reservaciones`.`estadoreservacion` = 'aprobado' and `reservaciones`.`fechainicioreservacion` = cast(current_timestamp() as date) and `reservaciones`.`fechafinreservacion` = cast(current_timestamp() as date) and `reservaciones`.`horainicioreservacion` <= cast(current_timestamp() as time) and `reservaciones`.`horafinreservacion` >= cast(current_timestamp() as time) order by `reservaciones`.`fechainicioreservacion`,`reservaciones`.`horainicioreservacion` limit 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_proximareservacionlabotatorio2`
--

/*!50001 DROP VIEW IF EXISTS `vista_proximareservacionlabotatorio2`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_proximareservacionlabotatorio2` AS select distinct `reservaciones`.`idreservacion` AS `idreservacion`,`reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion`,`reservaciones`.`finalizado` AS `finalizado`,`reservaciones`.`fecharegistro` AS `fecharegistro`,`reservaciones`.`estadoreservacion` AS `estadoreservacion` from (`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) where `reservaciones`.`idlaboratorio` = 2 and `reservaciones`.`estadoreservacion` = 'aprobado' and `reservaciones`.`fechainicioreservacion` = cast(current_timestamp() as date) and `reservaciones`.`fechafinreservacion` = cast(current_timestamp() as date) and `reservaciones`.`horainicioreservacion` <= cast(current_timestamp() as time) and `reservaciones`.`horafinreservacion` >= cast(current_timestamp() as time) order by `reservaciones`.`fechainicioreservacion`,`reservaciones`.`horainicioreservacion` limit 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_proximareservacionlabotatorio3`
--

/*!50001 DROP VIEW IF EXISTS `vista_proximareservacionlabotatorio3`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_proximareservacionlabotatorio3` AS select distinct `reservaciones`.`idreservacion` AS `idreservacion`,`reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion`,`reservaciones`.`finalizado` AS `finalizado`,`reservaciones`.`fecharegistro` AS `fecharegistro`,`reservaciones`.`estadoreservacion` AS `estadoreservacion` from (`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) where `reservaciones`.`idlaboratorio` = 3 and `reservaciones`.`estadoreservacion` = 'aprobado' and `reservaciones`.`fechainicioreservacion` = cast(current_timestamp() as date) and `reservaciones`.`fechafinreservacion` = cast(current_timestamp() as date) and `reservaciones`.`horainicioreservacion` <= cast(current_timestamp() as time) and `reservaciones`.`horafinreservacion` >= cast(current_timestamp() as time) order by `reservaciones`.`fechainicioreservacion`,`reservaciones`.`horainicioreservacion` limit 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_proximareservacionlabotatorio4`
--

/*!50001 DROP VIEW IF EXISTS `vista_proximareservacionlabotatorio4`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_proximareservacionlabotatorio4` AS select distinct `reservaciones`.`idreservacion` AS `idreservacion`,`reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion`,`reservaciones`.`finalizado` AS `finalizado`,`reservaciones`.`fecharegistro` AS `fecharegistro`,`reservaciones`.`estadoreservacion` AS `estadoreservacion` from (`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) where `reservaciones`.`idlaboratorio` = 4 and `reservaciones`.`estadoreservacion` = 'aprobado' and `reservaciones`.`fechainicioreservacion` = cast(current_timestamp() as date) and `reservaciones`.`fechafinreservacion` = cast(current_timestamp() as date) and `reservaciones`.`horainicioreservacion` <= cast(current_timestamp() as time) and `reservaciones`.`horafinreservacion` >= cast(current_timestamp() as time) order by `reservaciones`.`fechainicioreservacion`,`reservaciones`.`horainicioreservacion` limit 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_proximareservacionlabotatorio5`
--

/*!50001 DROP VIEW IF EXISTS `vista_proximareservacionlabotatorio5`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_proximareservacionlabotatorio5` AS select distinct `reservaciones`.`idreservacion` AS `idreservacion`,`reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion`,`reservaciones`.`finalizado` AS `finalizado`,`reservaciones`.`fecharegistro` AS `fecharegistro`,`reservaciones`.`estadoreservacion` AS `estadoreservacion` from (`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) where `reservaciones`.`idlaboratorio` = 5 and `reservaciones`.`estadoreservacion` = 'aprobado' and `reservaciones`.`fechainicioreservacion` = cast(current_timestamp() as date) and `reservaciones`.`fechafinreservacion` = cast(current_timestamp() as date) and `reservaciones`.`horainicioreservacion` <= cast(current_timestamp() as time) and `reservaciones`.`horafinreservacion` >= cast(current_timestamp() as time) order by `reservaciones`.`fechainicioreservacion`,`reservaciones`.`horainicioreservacion` limit 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_proximareservacionlabotatorio6`
--

/*!50001 DROP VIEW IF EXISTS `vista_proximareservacionlabotatorio6`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_proximareservacionlabotatorio6` AS select distinct `reservaciones`.`idreservacion` AS `idreservacion`,`reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion`,`reservaciones`.`finalizado` AS `finalizado`,`reservaciones`.`fecharegistro` AS `fecharegistro`,`reservaciones`.`estadoreservacion` AS `estadoreservacion` from (`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) where `reservaciones`.`idlaboratorio` = 6 and `reservaciones`.`estadoreservacion` = 'aprobado' and `reservaciones`.`fechainicioreservacion` = cast(current_timestamp() as date) and `reservaciones`.`fechafinreservacion` = cast(current_timestamp() as date) and `reservaciones`.`horainicioreservacion` <= cast(current_timestamp() as time) and `reservaciones`.`horafinreservacion` >= cast(current_timestamp() as time) order by `reservaciones`.`fechainicioreservacion`,`reservaciones`.`horainicioreservacion` limit 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_proximareservacionlabotatorio7`
--

/*!50001 DROP VIEW IF EXISTS `vista_proximareservacionlabotatorio7`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_proximareservacionlabotatorio7` AS select distinct `reservaciones`.`idreservacion` AS `idreservacion`,`reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion`,`reservaciones`.`finalizado` AS `finalizado`,`reservaciones`.`fecharegistro` AS `fecharegistro`,`reservaciones`.`estadoreservacion` AS `estadoreservacion` from (`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) where `reservaciones`.`idlaboratorio` = 7 and `reservaciones`.`estadoreservacion` = 'aprobado' and `reservaciones`.`fechainicioreservacion` = cast(current_timestamp() as date) and `reservaciones`.`fechafinreservacion` = cast(current_timestamp() as date) and `reservaciones`.`horainicioreservacion` <= cast(current_timestamp() as time) and `reservaciones`.`horafinreservacion` >= cast(current_timestamp() as time) order by `reservaciones`.`fechainicioreservacion`,`reservaciones`.`horainicioreservacion` limit 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_proximareservacionlabotatorio8`
--

/*!50001 DROP VIEW IF EXISTS `vista_proximareservacionlabotatorio8`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_proximareservacionlabotatorio8` AS select distinct `reservaciones`.`idreservacion` AS `idreservacion`,`reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion`,`reservaciones`.`finalizado` AS `finalizado`,`reservaciones`.`fecharegistro` AS `fecharegistro`,`reservaciones`.`estadoreservacion` AS `estadoreservacion` from (`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) where `reservaciones`.`idlaboratorio` = 8 and `reservaciones`.`estadoreservacion` = 'aprobado' and `reservaciones`.`fechainicioreservacion` = cast(current_timestamp() as date) and `reservaciones`.`fechafinreservacion` = cast(current_timestamp() as date) and `reservaciones`.`horainicioreservacion` <= cast(current_timestamp() as time) and `reservaciones`.`horafinreservacion` >= cast(current_timestamp() as time) order by `reservaciones`.`fechainicioreservacion`,`reservaciones`.`horainicioreservacion` limit 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_proximareservacionlabotatorio9`
--

/*!50001 DROP VIEW IF EXISTS `vista_proximareservacionlabotatorio9`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_proximareservacionlabotatorio9` AS select distinct `reservaciones`.`idreservacion` AS `idreservacion`,`reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion`,`reservaciones`.`finalizado` AS `finalizado`,`reservaciones`.`fecharegistro` AS `fecharegistro`,`reservaciones`.`estadoreservacion` AS `estadoreservacion` from (`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) where `reservaciones`.`idlaboratorio` = 9 and `reservaciones`.`estadoreservacion` = 'aprobado' and `reservaciones`.`fechainicioreservacion` = cast(current_timestamp() as date) and `reservaciones`.`fechafinreservacion` = cast(current_timestamp() as date) and `reservaciones`.`horainicioreservacion` <= cast(current_timestamp() as time) and `reservaciones`.`horafinreservacion` >= cast(current_timestamp() as time) order by `reservaciones`.`fechainicioreservacion`,`reservaciones`.`horainicioreservacion` limit 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_reservaciones`
--

/*!50001 DROP VIEW IF EXISTS `vista_reservaciones`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_reservaciones` AS select `reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion` from (`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) where `reservaciones`.`finalizado` = 'no' and `reservaciones`.`idlaboratorio` = 1 union select `reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion` from (`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) where `reservaciones`.`finalizado` = 'no' and `reservaciones`.`idlaboratorio` = 2 union select `reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion` from (`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) where `reservaciones`.`finalizado` = 'no' and `reservaciones`.`idlaboratorio` = 3 union select `reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion` from (`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) where `reservaciones`.`finalizado` = 'no' and `reservaciones`.`idlaboratorio` = 4 union select `reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion` from (`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) where `reservaciones`.`finalizado` = 'no' and `reservaciones`.`idlaboratorio` = 5 union select `reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion` from (`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) where `reservaciones`.`finalizado` = 'no' and `reservaciones`.`idlaboratorio` = 6 union select `reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion` from (`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) where `reservaciones`.`finalizado` = 'no' and `reservaciones`.`idlaboratorio` = 7 union select `reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion` from (`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) where `reservaciones`.`finalizado` = 'no' and `reservaciones`.`idlaboratorio` = 8 union select `reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion` from (`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) where `reservaciones`.`finalizado` = 'no' and `reservaciones`.`idlaboratorio` = 9 union select `reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion` from (`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) where `reservaciones`.`finalizado` = 'no' and `reservaciones`.`idlaboratorio` = 10 union select `reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion` from (`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) where `reservaciones`.`finalizado` = 'no' and `reservaciones`.`idlaboratorio` = 11 union select `reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion` from (`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) where `reservaciones`.`finalizado` = 'no' and `reservaciones`.`idlaboratorio` = 12 union select `reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion` from (`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) where `reservaciones`.`finalizado` = 'no' and `reservaciones`.`idlaboratorio` = 13 union select `reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion` from (`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) where `reservaciones`.`finalizado` = 'no' and `reservaciones`.`idlaboratorio` = 14 union select `reservaciones`.`idlaboratorio` AS `idlaboratorio`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion` from (`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) where `reservaciones`.`finalizado` = 'no' and `reservaciones`.`idlaboratorio` = 15 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_reservacionescalendarioactividades_general`
--

/*!50001 DROP VIEW IF EXISTS `vista_reservacionescalendarioactividades_general`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_reservacionescalendarioactividades_general` AS select `reservaciones`.`idreservacion` AS `idreservacion`,`reservaciones`.`idusuarios` AS `idusuarios`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`usuarios`.`codigousuario` AS `codigousuario`,`reservaciones`.`idlaboratorio` AS `idlaboratorio`,`laboratorios`.`codigolaboratorio` AS `codigolaboratorio`,`laboratorios`.`nombrelaboratorio` AS `nombrelaboratorio`,`laboratorios`.`capacidadlaboratorio` AS `capacidadlaboratorio`,`reservaciones`.`idaplicacion` AS `idaplicacion`,`aplicaciones_laboratorios`.`nombreaplicacion` AS `nombreaplicacion`,`reservaciones`.`idtiporeservacion` AS `idtiporeservacion`,`tipo_reservaciones`.`tiporeservacion` AS `tiporeservacion`,`reservaciones`.`codigounico_identificador` AS `codigounico_identificador`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`reservaciones`.`ciclo` AS `ciclo`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`seccionreservacion` AS `seccionreservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`fechafinreservacion` AS `fechafinreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion`,`reservaciones`.`numerousuarios` AS `numerousuarios`,`reservaciones`.`estadoreservacion` AS `estadoreservacion`,`reservaciones`.`fecharegistro` AS `fecharegistro`,`reservaciones`.`mod1` AS `mod1`,`reservaciones`.`mod2` AS `mod2`,`reservaciones`.`mod3` AS `mod3`,`reservaciones`.`mod4` AS `mod4`,`reservaciones`.`titular_reservacion` AS `titular_reservacion`,`reservaciones`.`nombre_otrotitular` AS `nombre_otrotitular`,`reservaciones`.`aula_procedencia` AS `aula_procedencia` from ((((`reservaciones` join `usuarios` on(`reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) join `laboratorios` on(`reservaciones`.`idlaboratorio` = `laboratorios`.`idlaboratorio`)) join `aplicaciones_laboratorios` on(`reservaciones`.`idaplicacion` = `aplicaciones_laboratorios`.`idaplicacion`)) join `tipo_reservaciones` on(`reservaciones`.`idtiporeservacion` = `tipo_reservaciones`.`idtiporeservacion`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_rolesusuariosregistrados`
--

/*!50001 DROP VIEW IF EXISTS `vista_rolesusuariosregistrados`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_rolesusuariosregistrados` AS select `roles`.`idrolusuario` AS `idrolusuario`,`roles`.`nombrerolusuario` AS `nombrerolusuario`,`roles`.`descripcionrolusuario` AS `descripcionrolusuario` from `roles` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_seguimientoreservacionesfinalizadas`
--

/*!50001 DROP VIEW IF EXISTS `vista_seguimientoreservacionesfinalizadas`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_seguimientoreservacionesfinalizadas` AS select `seguimiento_reservaciones`.`idseguimiento` AS `idseguimiento`,`seguimiento_reservaciones`.`idreservacion` AS `idreservacion`,`seguimiento_reservaciones`.`codigounico_identificador` AS `codigounico_identificador`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`seccionreservacion` AS `seccionreservacion`,`reservaciones`.`fechainicioreservacion` AS `fechainicioreservacion`,`reservaciones`.`fechafinreservacion` AS `fechafinreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion`,`seguimiento_reservaciones`.`dividio_grupo` AS `dividio_grupo`,`seguimiento_reservaciones`.`cantidad_grupos` AS `cantidad_grupos`,`seguimiento_reservaciones`.`cantidadusuarios` AS `cantidadusuarios`,`seguimiento_reservaciones`.`ciclo` AS `ciclo`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos` from ((`seguimiento_reservaciones` join `reservaciones` on(`seguimiento_reservaciones`.`idreservacion` = `reservaciones`.`idreservacion`)) join `usuarios` on(`seguimiento_reservaciones`.`idusuarios` = `usuarios`.`idusuarios`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_seleccionaraplicacionesregistradasreservaciones`
--

/*!50001 DROP VIEW IF EXISTS `vista_seleccionaraplicacionesregistradasreservaciones`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_seleccionaraplicacionesregistradasreservaciones` AS select `aplicaciones_laboratorios`.`idaplicacion` AS `idaplicacion`,`aplicaciones_laboratorios`.`codigoaplicacion` AS `codigoaplicacion`,`aplicaciones_laboratorios`.`nombreaplicacion` AS `nombreaplicacion`,`aplicaciones_laboratorios`.`idclasificacionlaboratorio` AS `idclasificacionlaboratorio`,`aplicaciones_laboratorios`.`fecharegistro` AS `fecharegistro` from `aplicaciones_laboratorios` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_ultimasreservacionesaprobadasdocentes`
--

/*!50001 DROP VIEW IF EXISTS `vista_ultimasreservacionesaprobadasdocentes`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_ultimasreservacionesaprobadasdocentes` AS select `reservaciones`.`idreservacion` AS `idreservacion`,`reservaciones`.`idusuarios` AS `idusuarios`,`reservaciones`.`codigoreservacion` AS `codigoreservacion`,`reservaciones`.`nombrereservacion` AS `nombrereservacion`,`reservaciones`.`ciclo` AS `ciclo`,`reservaciones`.`codigounico_identificador` AS `codigounico_identificador`,min(`reservaciones`.`fechainicioreservacion`) AS `fechainicioreservacion`,max(`reservaciones`.`fechafinreservacion`) AS `fechafinreservacion`,`reservaciones`.`horainicioreservacion` AS `horainicioreservacion`,`reservaciones`.`horafinreservacion` AS `horafinreservacion` from `reservaciones` where `reservaciones`.`estadoreservacion` = 'aprobado' group by `reservaciones`.`codigounico_identificador` order by `reservaciones`.`fechainicioreservacion` desc limit 25 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-17 19:04:37
