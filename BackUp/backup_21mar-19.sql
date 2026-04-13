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
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accesos`
--

LOCK TABLES `accesos` WRITE;
/*!40000 ALTER TABLE `accesos` DISABLE KEYS */;
INSERT INTO `accesos` VALUES (23,'2023-03-01 18:40:56',NULL,1),(24,'2023-03-02 14:28:10',NULL,1),(25,'2023-03-02 19:06:32',NULL,1),(26,'2023-03-02 19:19:56',NULL,1),(27,'2023-03-03 00:47:39',NULL,1),(28,'2023-03-03 01:14:05',NULL,1),(29,'2023-03-03 14:43:41',NULL,1),(30,'2023-03-03 17:39:09',NULL,1),(31,'2023-03-03 17:55:53',NULL,1),(32,'2023-03-03 19:05:49',NULL,1),(33,'2023-03-05 22:19:24','2023-03-05 22:57:44',1),(34,'2023-03-05 23:04:15',NULL,1),(35,'2023-03-05 23:05:20','2023-03-05 23:06:34',1),(36,'2023-03-05 23:15:37',NULL,1),(38,'2023-03-05 23:20:56','2023-03-05 23:22:05',1),(39,'2023-03-05 23:22:15','2023-03-05 23:54:28',1),(40,'2023-03-05 23:54:32','2023-03-06 00:17:34',1),(41,'2023-03-06 14:40:02','2023-03-06 19:12:47',1),(42,'2023-03-07 14:45:21',NULL,1),(43,'2023-03-08 14:35:54','2023-03-08 14:49:35',1),(44,'2023-03-08 14:50:29','2023-03-08 15:28:21',9),(45,'2023-03-08 15:28:26',NULL,1),(46,'2023-03-08 16:31:21',NULL,9),(47,'2023-03-09 14:50:01','2023-03-09 14:51:20',1),(48,'2023-03-09 14:51:25','2023-03-09 18:19:54',1),(49,'2023-03-09 15:17:43',NULL,9),(50,'2023-03-09 16:08:45',NULL,9),(51,'2023-03-09 17:57:42',NULL,9),(52,'2023-03-09 18:19:58','2023-03-09 19:25:09',1),(53,'2023-03-10 00:16:33','2023-03-10 00:19:20',1),(54,'2023-03-10 00:22:32','2023-03-10 00:24:29',9),(55,'2023-03-10 14:41:20',NULL,1),(56,'2023-03-10 17:05:39',NULL,1),(57,'2023-03-10 23:39:03','2023-03-10 23:55:49',1),(58,'2023-03-10 23:55:55','2023-03-11 00:21:22',1),(59,'2023-03-12 18:53:13','2023-03-12 18:54:15',1),(60,'2023-03-13 14:09:26',NULL,1),(61,'2023-03-14 14:45:19',NULL,1),(62,'2023-03-14 18:43:34','2023-03-14 19:23:30',1),(63,'2023-03-15 14:12:55','2023-03-15 19:06:14',1),(64,'2023-03-15 19:08:31','2023-03-15 19:20:56',1),(65,'2023-03-16 14:20:11','2023-03-16 15:52:58',1),(66,'2023-03-16 16:06:11','2023-03-16 18:54:54',1),(67,'2023-03-17 17:27:00','2023-03-17 18:59:50',1),(68,'2023-03-17 23:29:55','2023-03-18 00:27:19',1),(69,'2023-03-20 15:06:31','2023-03-20 18:01:38',1),(70,'2023-03-20 18:05:16','2023-03-20 19:32:41',1),(71,'2023-03-21 14:31:50',NULL,1),(72,'2023-03-21 15:55:19','2023-03-21 19:11:30',1);
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
INSERT INTO `aplicaciones_laboratorios` VALUES (1,'W8','Windows 8','si','no','no','no','no','no','no','si','no','no','no','no','no','no','no',1,'2023-03-15 20:27:56'),(2,'W10','Windows 10','no','si','si','no','no','si','si','no','si','si','no','no','no','no','no',1,'2023-03-15 20:34:27'),(3,'W12S','Windows 12 Server','si','si','si','no','no','si','no','si','si','si','no','no','no','no','no',1,'2023-03-15 20:39:47'),(4,'MSOFF2016','Microsoft Office 2016','si','si','si','no','no','si','no','si','si','si','si','no','no','no','si',1,'2023-03-15 20:46:56'),(5,'WS2003','Windows 2003 Server','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',1,'2023-03-15 23:38:58'),(6,'WS2008','Windows 2008 Server','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',1,'2023-03-15 23:39:33'),(7,'Y_MacOs','Yosemite (Mac OS)','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',1,'2023-03-15 23:40:58'),(8,'C_MacOs','Capitan (Mac OS)','no','no','no','no','no','no','no','no','no','no','no','si','no','no','no',1,'2023-03-15 23:41:36'),(9,'M_MacOs','Mojave (Mac OS)','no','no','no','no','no','no','no','no','no','no','no','no','no','si','no',1,'2023-03-15 23:44:28'),(10,'MP2010','Microsoft Project 2010','si','si','no','no','no','si','no','si','no','si','si','no','no','no','no',1,'2023-03-15 23:45:52'),(11,'MV2010','Microsoft Visio 2010','si','si','no','no','no','no','no','si','no','no','si','no','no','no','no',1,'2023-03-15 23:47:22'),(12,'MOFF_MacOs','Microsoft Office para MAC 2016','no','no','no','no','no','no','no','no','no','no','no','si','no','si','no',1,'2023-03-15 23:48:51'),(13,'VS2013','Visual Studio 2013','si','si','si','no','no','si','no','si','no','si','no','no','no','no','no',2,'2023-03-15 23:51:08'),(14,'JLE','Jcreator LE','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',2,'2023-03-15 23:53:33'),(15,'Java1x','Java 1.x.xx','si','si','no','no','no','no','no','si','si','no','no','no','no','no','no',2,'2023-03-15 23:54:28'),(16,'MySQL','MySQL','si','si','si','no','no','no','no','si','no','si','no','no','no','no','no',2,'2023-03-15 23:55:35'),(17,'NetBeans','NetBeans','si','si','si','no','no','si','no','si','si','si','no','si','no','si','no',2,'2023-03-15 23:57:35'),(18,'php','php','no','no','si','no','no','si','no','si','no','si','no','no','no','no','no',2,'2023-03-15 23:59:10'),(19,'MSSQL2014','SQL Server 2014','si','si','si','no','no','si','no','si','si','si','no','no','no','no','no',2,'2023-03-16 00:01:57'),(20,'Apache','Apache','si','si','si','no','no','no','no','si','no','si','no','no','no','no','no',2,'2023-03-16 00:03:39'),(21,'Tomcat','Tomcat','si','si','si','no','no','no','no','si','no','si','no','no','no','no','no',2,'2023-03-16 00:04:37'),(22,'WAMP','WAMP','no','no','no','no','no','no','no','si','no','no','no','no','no','no','no',2,'2023-03-16 00:05:19'),(23,'XAMPP','XAMPP','si','si','si','no','no','no','no','si','no','si','no','si','no','si','no',2,'2023-03-16 00:06:15'),(24,'WP','Windows Phone','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',2,'2023-03-16 00:06:35'),(25,'AS','Android Studio','si','si','si','no','no','si','no','si','si','si','no','no','no','no','no',2,'2023-03-16 00:07:22'),(26,'StarUML','StarUML','no','si','si','no','no','si','no','si','no','si','no','no','no','no','no',2,'2023-03-16 00:09:12'),(27,'MySQL_Workbench','Workbench','no','no','no','no','no','no','no','no','no','si','no','no','no','no','no',2,'2023-03-16 00:10:13'),(28,'VirBox','Virtual Box','si','no','si','no','no','si','no','si','si','si','si','si','no','si','no',3,'2023-03-16 00:11:10'),(29,'VmwareP','Vmware Player','si','si','si','no','no','no','no','si','no','no','no','no','no','no','no',3,'2023-03-16 00:12:25'),(30,'H-V','Hyper-V','no','no','no','no','no','no','no','si','no','no','no','no','no','no','no',3,'2023-03-16 00:12:55'),(31,'ME','Microsoft Edge','si','si','si','no','no','si','si','no','si','si','no','no','no','no','no',4,'2023-03-16 00:13:44'),(32,'MF','Mozilla firefox','si','si','si','no','no','si','no','si','si','si','no','no','no','no','no',4,'2023-03-16 00:15:24'),(33,'GC','Google Chrome','si','si','si','no','no','si','si','si','si','si','si','si','no','si','si',4,'2023-03-16 00:16:12'),(34,'Safari','Safari','no','no','no','no','no','no','no','no','no','no','no','si','no','si','no',4,'2023-03-16 00:17:15'),(35,'Opera','Opera','si','no','no','no','no','no','no','no','no','no','no','no','no','no','no',4,'2023-03-16 00:17:58'),(36,'I-Photo','I-Photo','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',5,'2023-03-16 00:18:26'),(37,'GSketchup','Google Sketchup','no','no','no','no','no','no','no','no','no','no','no','si','no','si','no',5,'2023-03-16 00:19:47'),(38,'ADOSTUCS6','Adobe Studio CS6','no','no','si','no','no','no','no','no','si','no','no','si','no','no','no',5,'2023-03-16 00:24:12'),(39,'ACC2015','Adobe CC 2015','no','no','no','no','no','no','no','no','no','no','no','no','no','si','no',5,'2023-03-16 00:24:51'),(40,'Gimp','Gimp','si','si','no','no','no','no','no','no','si','no','no','no','no','no','no',5,'2023-03-16 00:25:23'),(41,'3DSMAX','3ds Max ','no','no','no','no','no','si','no','no','si','no','no','no','no','no','no',6,'2023-03-16 00:26:24'),(42,'A360 ','A360 ','si','no','no','no','no','si','no','no','si','no','no','no','no','no','no',6,'2023-03-16 00:26:45'),(43,'AutoCAD','AutoCAD','si','no','no','no','no','si','no','no','si','no','no','no','no','no','no',6,'2023-03-16 00:27:44'),(44,'AutoCADElectrical','AutoCAD Electrical','no','no','no','no','no','si','no','no','si','si','no','no','no','no','no',6,'2023-03-16 00:28:32'),(45,'AutoCADMap3D','AutoCAD Map 3D','no','no','no','no','no','no','no','no','si','no','no','no','no','no','no',6,'2023-03-16 00:29:00'),(46,'AutoCAD Plant3D','AutoCAD  Plant 3D','no','no','no','no','no','si','no','no','si','no','no','no','no','no','no',6,'2023-03-16 00:30:12'),(47,'AutoCADUtilityDesign','AutoCAD Utility Design','no','no','no','no','no','si','no','no','si','no','no','no','no','no','no',6,'2023-03-16 00:30:50'),(48,'AutoCADPlant3DSpecEditor','AutoCAD Plant 3D Spec Editor','no','no','no','no','no','si','no','no','si','no','no','no','no','no','no',6,'2023-03-16 00:31:13'),(49,'AutoCADPlantReportCreator','AutoCAD Plant Report Creator','no','no','no','no','no','si','no','no','si','no','no','no','no','no','no',6,'2023-03-16 00:31:34'),(50,'InfraWorks360','InfraWorks 360','no','no','no','no','no','si','no','no','si','no','no','no','no','no','no',6,'2023-03-16 00:32:03'),(51,'Inventor','Inventor','no','no','no','no','no','no','no','no','si','no','no','no','no','no','no',6,'2023-03-16 00:32:26'),(52,'ReCap','ReCap','si','no','no','no','no','no','no','no','si','no','no','no','no','no','no',6,'2023-03-16 00:33:06'),(53,'RobotStructuralAnalysis','Robot Structural Analysis','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',6,'2023-03-16 00:33:57'),(54,'Showcase','Showcase','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',6,'2023-03-16 00:34:09'),(55,'StormSanitaryAnalysis','Storm and Sanitary Analysis','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',6,'2023-03-16 00:34:46'),(56,'Civil3DImperial','Civil 3D Imperial','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',6,'2023-03-16 00:35:11'),(57,'Civil3DMetric','Civil 3D Metric','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',6,'2023-03-16 00:35:28'),(58,'DWGTrueView','DWG TrueView','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',6,'2023-03-16 00:35:53'),(59,'IMDataEditor','IM Data Editor','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',6,'2023-03-16 00:36:12'),(60,'Maya','Maya','no','no','no','no','no','no','no','no','si','no','no','si','no','si','no',6,'2023-03-16 00:36:44'),(61,'MotionBuilder','MotionBuilder','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',6,'2023-03-16 00:37:01'),(62,'Mudbox','Mudbox','no','no','no','no','no','no','no','no','si','no','no','si','no','si','no',6,'2023-03-16 00:37:18'),(63,'NavisworksManage','Navisworks Manage','no','no','no','no','no','no','no','no','no','si','no','no','no','no','no',6,'2023-03-16 00:37:36'),(64,'RaterDesign','Rater Design','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',6,'2023-03-16 00:38:04'),(65,'Revit','Revit','si','no','no','no','no','si','no','no','si','si','no','no','no','no','no',6,'2023-03-16 00:38:34'),(66,'Fusion360','Fusion 360','si','no','no','no','no','si','no','no','si','no','no','si','no','si','no',6,'2023-03-16 00:39:04'),(67,'RevitStructure','Revit Structure','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',6,'2023-03-16 00:39:28'),(68,'AcrobatReader','Acrobat Reader','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',7,'2023-03-16 00:40:06'),(69,'NitroPDF','Nitro PDF','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',7,'2023-03-16 00:40:21'),(70,'FoxitReader','Foxit Reader','si','si','si','no','no','si','no','si','si','si','no','si','no','si','no',7,'2023-03-16 00:40:55'),(71,'SlimPDFReader','SlimPDF Reader','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',7,'2023-03-16 00:41:17'),(72,'Jzip','Jzip','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',8,'2023-03-16 00:42:32'),(73,'7Zip','7Zip','si','si','si','no','no','si','no','si','si','si','no','no','no','no','no',8,'2023-03-16 00:43:14'),(74,'X-rar','X-rar','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',8,'2023-03-16 00:43:28'),(75,'Keka','Keka','no','no','no','no','no','no','no','no','no','no','no','si','no','si','no',8,'2023-03-16 00:44:00'),(76,'Winzip','Winzip','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',8,'2023-03-16 00:44:15'),(77,'Winrar','Winrar','si','no','no','no','no','no','no','no','no','no','no','no','no','no','no',8,'2023-03-16 00:44:28'),(78,'Blockbuster','Block buster(I, II, III, IV)','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',9,'2023-03-16 00:45:16'),(79,'GrammarEnglish','Grammar of English','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',9,'2023-03-16 00:45:33'),(80,'Agu','Agu','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',9,'2023-03-16 00:45:45'),(81,'PlacementeTest','Placemente Test','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',9,'2023-03-16 00:46:17'),(82,'TeoflTest','Teofl Test','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',9,'2023-03-16 00:46:33'),(83,'TelephoningEnglish','Telephoning English','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',9,'2023-03-16 00:46:48'),(84,'Phonetics','Phonetics','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',9,'2023-03-16 00:46:59'),(85,'Interchange','Interchange (I,II y II)','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',9,'2023-03-16 00:47:16'),(86,'WMP','Windows Media Player','si','si','si','no','no','si','no','si','si','si','no','no','no','no','no',10,'2023-03-16 00:48:16'),(87,'Itunes','I tunes','no','no','no','no','no','no','no','no','no','no','no','si','no','si','no',10,'2023-03-16 00:48:36'),(88,'IMovie','I Movie','no','no','no','no','no','no','no','no','no','no','no','si','no','si','no',10,'2023-03-16 00:48:54'),(89,'PlayerQuickTime','Player QuickTime','no','no','no','no','no','no','no','no','no','no','no','si','no','si','no',10,'2023-03-16 00:49:13'),(90,'WMM','Windows Movie Maker','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',10,'2023-03-16 00:49:28'),(91,'Audacity','Audacity','si','si','si','no','no','si','no','no','si','si','no','no','no','no','no',10,'2023-03-16 00:49:54'),(92,'FlvPlayer','Flv Player','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',10,'2023-03-16 00:50:16'),(93,'Packettracer','Packet tracer','si','si','si','no','no','si','no','si','no','si','no','no','no','no','no',11,'2023-03-16 00:51:36'),(94,'ESETEndpointSecurityClientes','ESET Endpoint Security Clientes','si','si','si','no','no','si','no','si','si','si','no','si','no','si','no',11,'2023-03-16 00:52:22'),(95,'ESETRemoteAdministratorConsole','ESET Remote Administrator Console','si','si','si','no','no','si','no','si','si','si','no','no','no','no','no',11,'2023-03-16 00:53:02'),(96,'Brackets','Brackets (Editor HTML)','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',11,'2023-03-16 00:53:18'),(97,'Ccleaner','Ccleaner','si','si','si','no','no','si','no','no','si','no','no','si','no','si','no',11,'2023-03-16 00:53:48'),(98,'Máxima','Máxima','si','no','no','no','no','no','no','no','no','no','no','no','no','no','no',11,'2023-03-16 00:54:42'),(99,'GeoGebra','GeoGebra','si','si','si','no','no','si','no','si','si','si','no','no','no','no','no',11,'2023-03-16 00:55:11'),(100,'Graphmatica','Graphmatica','si','no','no','no','no','no','no','no','no','no','no','no','no','no','no',11,'2023-03-16 00:55:28'),(101,'Z-suite','Z-suite','no','no','no','no','no','no','si','no','no','no','no','no','no','no','no',11,'2023-03-16 00:55:43'),(102,'Arduino','Arduino','no','no','no','no','no','no','si','no','no','no','no','no','no','no','no',11,'2023-03-16 00:55:57'),(103,'BantamTools','Bantam Tools','no','no','no','no','no','no','si','no','no','no','no','no','no','no','no',11,'2023-03-16 00:56:16'),(104,'DobotStudio','DobotStudio','no','no','no','no','no','no','si','no','no','no','no','no','no','no','no',11,'2023-03-16 00:56:32'),(105,'Inkscape','Inkscape','no','no','no','no','no','no','si','no','no','no','no','no','no','no','no',11,'2023-03-16 00:56:47'),(106,'Blender','Blender','no','no','no','no','no','no','si','no','no','no','no','no','no','no','no',11,'2023-03-16 00:57:00'),(107,'mBlock','mBlock','no','no','no','no','no','no','si','no','no','no','no','no','no','no','no',11,'2023-03-16 00:57:14'),(108,'Oculus','Oculus (Rift)','no','no','no','no','no','no','si','no','no','no','no','no','no','no','no',11,'2023-03-16 00:57:29'),(109,'R','R (Estadística)','no','no','no','no','no','no','no','no','no','no','no','no','no','no','no',11,'2023-03-16 00:57:42'),(110,'CtrlPracticasLab','Control de Prácticas Lab','si','no','si','no','no','no','si','no','no','no','no','no','no','no','no',11,'2023-03-16 00:58:17');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clasificacion_notificaciones`
--

LOCK TABLES `clasificacion_notificaciones` WRITE;
/*!40000 ALTER TABLE `clasificacion_notificaciones` DISABLE KEYS */;
INSERT INTO `clasificacion_notificaciones` VALUES (1,'solicitudaprobada','Todas las solicitudes que los usuarios ingresen, con un estado de aprobado.'),(2,'solicituddenegada','Todas las solicitudes que los usuarios ingresan, con estado deganado'),(3,'nuevomensaje','Nuevo mensaje recibido en bandeja de entrada, todos los usuarios.');
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
  `telefonotrabajo` varchar(9) NOT NULL,
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
INSERT INTO `detallesusuarios` VALUES (1,'2233-4411','2233-4400','m','1997-03-28','soltero',1);
/*!40000 ALTER TABLE `detallesusuarios` ENABLE KEYS */;
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
  PRIMARY KEY (`idlaboratorio`),
  UNIQUE KEY `codigolaboratorio` (`codigolaboratorio`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laboratorios`
--

LOCK TABLES `laboratorios` WRITE;
/*!40000 ALTER TABLE `laboratorios` DISABLE KEYS */;
INSERT INTO `laboratorios` VALUES (1,'LAB1','Laboratorio 1 Informática',85,0,'inactivo','#e00000'),(2,'LAB2','Laboratorio 2 Informatica',80,0,'activo','#f19898'),(3,'LAB3','Laboratorio 3 Informática',125,0,'activo','#f971ce'),(4,'LAB4','Laboratorio 4 Informática',30,0,'activo','#f312d5'),(5,'LAB5','Laboratorio 5 Informática',60,0,'activo','#9e62c6'),(6,'LAB6','Laboratorio 6 Informática',60,0,'activo','#6b099f'),(7,'LAB7','Laboratorio 7 Informática',0,0,'activo','#705d92'),(8,'LAB8','Laboratorio 8 Informática',88,10,'activo','#3a19e1'),(9,'LAB9','Laboratorio 9 Informática',50,0,'activo','#4d6fd5'),(10,'LAB10','Laboratorio 10 Informática',50,0,'activo','#42b0f5'),(11,'LAB11','Laboratorio 11 Informática',30,0,'activo','#61e5ff'),(12,'LAB12','Laboratorio 12 Informática',30,0,'activo','#a6f2cf'),(13,'LAB13','Laboratorio 13 Informática',65,0,'activo','#4fab61'),(14,'LAB14','Laboratorio 14 Informática',65,0,'activo','#54a800'),(15,'LAB15','Laboratorio 15 Informática',20,0,'activo','#fff700');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manifiestos_plataforma`
--

LOCK TABLES `manifiestos_plataforma` WRITE;
/*!40000 ALTER TABLE `manifiestos_plataforma` DISABLE KEYS */;
INSERT INTO `manifiestos_plataforma` VALUES (1,1,'Reporte Problema 1','Problema de plataforma numero uno, prueba.','332345413_187456700654787_5766189019673036167_n.jpg','2023-03-10 21:37:06','2023-03-11 00:39:45','cerrado',NULL),(2,1,'Problema Numero Dos, Lorem De Ipsum Dolor Percent Lorem Dr Dolor Ipsum','Problema Numero Dos, Lorem De Ipsum Dolor Percent Lorem Dr Dolor Ipsum Problema Numero Dos, Lorem De Ipsum Dolor Percent Lorem Dr Dolor Ipsum Problema Numero Dos, Lorem De Ipsum Dolor Percent Lorem Dr Dolor Ipsum','pngwing.com.png','2023-03-10 22:03:19','2023-03-10 22:03:19','pendiente',NULL),(3,1,'Problema Numero Tres, Lorem De Ipsum Dolor Percent Lorem Dr Dolor Ipsum','Problema Numero Tres, Lorem De Ipsum Dolor Percent Lorem Dr Dolor IpsumProblema Numero Tres, Lorem De Ipsum Dolor Percent Lorem Dr Dolor IpsumProblema Numero Tres, Lorem De Ipsum Dolor Percent Lorem Dr Dolor IpsumProblema Numero Tres, Lorem De Ipsum Dolor Percent Lorem Dr Dolor IpsumProblema Numero Tres, Lorem De Ipsum Dolor Percent Lorem Dr Dolor IpsumProblema Numero Tres, Lorem De Ipsum Dolor Percent Lorem Dr Dolor IpsumProblema Numero Tres, Lorem De Ipsum Dolor Percent Lorem Dr Dolor IpsumProblema Numero Tres, Lorem De Ipsum Dolor Percent Lorem Dr Dolor Ipsum','131454_640f8d81d274c_pngwing.com.png','2023-03-13 20:54:25','2023-03-13 20:54:25','pendiente',NULL),(4,1,'Problema Numero Cuatro','Problema Numero CuatroProblema Numero CuatroProblema Numero CuatroProblema Numero CuatroProblema Numero CuatroProblema Numero CuatroProblema Numero CuatroProblema Numero CuatroProblema Numero CuatroProblema Numero CuatroProblema Numero CuatroProblema Numero CuatroProblema Numero CuatroProblema Numero CuatroProblema Numero CuatroProblema Numero CuatroProblema Numero CuatroProblema Numero Cuatro','131458_640f8e5dab314_Captura de pantalla 2023-03-13 145753.png','2023-03-13 20:58:05','2023-03-13 21:30:01','resuelto','Gestionando\r\nResuelto');
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensajeria`
--

LOCK TABLES `mensajeria` WRITE;
/*!40000 ALTER TABLE `mensajeria` DISABLE KEYS */;
INSERT INTO `mensajeria` VALUES (1,1,'Lorem','De Ipsum','<p>Nuevo Mensaje.</p>\n\n<p><strong>Por favor ejecutar prueba.</strong></p>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li><strong>No existen nuevos registros</strong></li>\n</ul>\n\n<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:500px\">\n	<tbody>\n		<tr>\n			<td>UNO</td>\n			<td>DOS</td>\n		</tr>\n		<tr>\n			<td>RES</td>\n			<td>AQUA</td>\n		</tr>\n		<tr>\n			<td>LOREM</td>\n			<td>IPSUM</td>\n		</tr>\n	</tbody>\n</table>\n\n<p>&nbsp;</p>\n','2023-03-07 23:58:49',2,'no',NULL,'no'),(2,1,'Lorem','Lorem','<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:500px\">\n	<tbody>\n		<tr>\n			<td>s</td>\n			<td>s</td>\n		</tr>\n		<tr>\n			<td>d</td>\n			<td>g</td>\n		</tr>\n		<tr>\n			<td>d</td>\n			<td>g</td>\n		</tr>\n	</tbody>\n</table>\n\n<p>PRUEBA DE NUEVO MENSAJE</p>\n\n<p>&nbsp;</p>\n\n<p><input type=\"text\" />APLICAR NUEVO MENSAJE</p>\n\n<p><span style=\"color:#c0392b\">NUEVO MENSAJE DE PRUEBA</span></p>\n\n<p><span style=\"color:#66ffff\">lorem de ipsum</span></p>\n','2023-03-08 00:06:52',2,'no',NULL,'no'),(3,1,'Lorem','Lorem','<p>TERCERA PRUEBA.</p>\r\n','2023-03-08 00:18:09',3,'no',NULL,'no'),(4,1,'Uno','Dos','<p>Tercero</p>\r\n','2023-03-08 00:18:37',4,'no',NULL,'no'),(5,1,'Cuarto','Cuarto','<p>Cuarto</p>\r\n','2023-03-08 00:21:19',4,'no',NULL,'no'),(6,1,'Qunti','Qunti','<p>Qunti</p>\r\n','2023-03-08 00:33:15',9,'no','071833__Consolidado Usuarios Registrados.xlsx','no'),(7,1,'Muestra PDF','PDF','<p>Visualice el pdf</p>\r\n','2023-03-08 00:37:54',9,'no','071837_6407d8e25d03c_Título del documento (2).pdf','si'),(8,9,'Libro Contable Excel Reservaciones','Urgente, Envio Libro Contable','<p>Estimado(a), es un gusto saludarle de nuevo. Es urgente que se envie el libro contable de reservaciones en formato excel, a mas tardar a las 18 horas de este dia.</p>\n\n<p><span class=\"marker\">Debera agregar los nuevos formatos que se le mencionaron en la reunion pasada.</span></p>\n','2023-03-08 21:28:00',1,'si','','si'),(9,9,'Control de Laboratorios','Control de Laboratorios Archivo Excel','<p>Buen dia, favor adjuntar el archivo en excel&nbsp;Control de Laboratorios</p>\r\n\r\n<p>Llevara este formato:</p>\r\n\r\n<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:500px\">\r\n	<tbody>\r\n		<tr>\r\n			<td>TITULO 1</td>\r\n			<td>TITULO2</td>\r\n		</tr>\r\n		<tr>\r\n			<td>XXXX</td>\r\n			<td>XXXX</td>\r\n		</tr>\r\n		<tr>\r\n			<td>XXXX</td>\r\n			<td>XXXX</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Favor respetar el orden. Gracias</p>\r\n','2023-03-08 22:34:03',1,'si','081634_64090d5b021d1_Consolidado Usuarios Registrados.xlsx','no'),(11,9,'Prueba Editor','Editor CK Probando','<h2>Technical details <a id=\"tech-details\" name=\"tech-details\"></a></h2>\r\n\r\n<table align=\"right\" border=\"1\" cellpadding=\"5\" cellspacing=\"0\">\r\n	<caption><strong>Mission crew</strong></caption>\r\n	<thead>\r\n		<tr>\r\n			<th scope=\"col\">Position</th>\r\n			<th scope=\"col\">Astronaut</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>Commander</td>\r\n			<td>Neil A. Armstrong</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Command Module Pilot</td>\r\n			<td>Michael Collins</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Lunar Module Pilot</td>\r\n			<td>Edwin &quot;Buzz&quot; E. Aldrin, Jr.</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Launched by a <strong>Saturn V</strong> rocket from <a href=\"javascript:void(0)\">Kennedy Space Center</a> in Merritt Island, Florida on July 16, Apollo 11 was the fifth manned mission of <a href=\"javascript:void(0)\">NASA</a>&#39;s Apollo program. The Apollo spacecraft had three parts:</p>\r\n\r\n<ol>\r\n	<li><strong>Command Module</strong> with a cabin for the three astronauts which was the only part which landed back on Earth</li>\r\n	<li><strong>Service Module</strong> which supported the Command Module with propulsion, electrical power, oxygen and water</li>\r\n	<li><strong>Lunar Module</strong> for landing on the Moon.</li>\r\n</ol>\r\n\r\n<p>After being sent to the Moon by the Saturn V&#39;s upper stage, the astronauts separated the spacecraft from it and travelled for three days until they entered into lunar orbit. Armstrong and Aldrin then moved into the Lunar Module and landed in the <a href=\"javascript:void(0)\">Sea of Tranquility</a>. They stayed a total of about 21 and a half hours on the lunar surface. After lifting off in the upper part of the Lunar Module and rejoining Collins in the Command Module, they returned to Earth and landed in the <a href=\"javascript:void(0)\">Pacific Ocean</a> on July 24.</p>\r\n','2023-03-09 21:20:34',1,'si','091520_640a4da2e3264_Hoja de Grupo y Tema (1).doc','no'),(14,9,'Libro Word','Envio Libro Word','<h2>Technical details <a id=\"tech-details\" name=\"tech-details\"></a></h2>\r\n\r\n<table align=\"right\" border=\"1\" cellpadding=\"5\" cellspacing=\"0\">\r\n	<caption><strong>Mission crew</strong></caption>\r\n	<thead>\r\n		<tr>\r\n			<th scope=\"col\">Position</th>\r\n			<th scope=\"col\">Astronaut</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>Commander</td>\r\n			<td>Neil A. Armstrong</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Command Module Pilot</td>\r\n			<td>Michael Collins</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Lunar Module Pilot</td>\r\n			<td>Edwin &quot;Buzz&quot; E. Aldrin, Jr.</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Launched by a <strong>Saturn V</strong> rocket from <a href=\"javascript:void(0)\">Kennedy Space Center</a> in Merritt Island, Florida on July 16, Apollo 11 was the fifth manned mission of <a href=\"javascript:void(0)\">NASA</a>&#39;s Apollo program. The Apollo spacecraft had three parts:</p>\r\n\r\n<ol>\r\n	<li><strong>Command Module</strong> with a cabin for the three astronauts which was the only part which landed back on Earth</li>\r\n	<li><strong>Service Module</strong> which supported the Command Module with propulsion, electrical power, oxygen and water</li>\r\n	<li><strong>Lunar Module</strong> for landing on the Moon.</li>\r\n</ol>\r\n\r\n<p>After being sent to the Moon by the Saturn V&#39;s upper stage, the astronauts separated the spacecraft from it and travelled for three days until they entered into lunar orbit. Armstrong and Aldrin then moved into the Lunar Module and landed in the <a href=\"javascript:void(0)\">Sea of Tranquility</a>. They stayed a total of about 21 and a half hours on the lunar surface. After lifting off in the upper part of the Lunar Module and rejoining Collins in the Command Module, they returned to Earth and landed in the <a href=\"javascript:void(0)\">Pacific Ocean</a> on July 24.</p>\r\n','2023-03-09 21:27:04',1,'si','091527_640a4f2860196_Hoja de Grupo y Tema (1).doc','si'),(15,9,'Mensaje de libro contable','Envio Mensaje de libro contable','<h2>Technical details <a id=\"tech-details\" name=\"tech-details\"></a></h2>\r\n\r\n<table align=\"right\" border=\"1\" cellpadding=\"5\" cellspacing=\"0\">\r\n	<caption><strong>Mission crew</strong></caption>\r\n	<thead>\r\n		<tr>\r\n			<th scope=\"col\">Position</th>\r\n			<th scope=\"col\">Astronaut</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>Commander</td>\r\n			<td>Neil A. Armstrong</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Command Module Pilot</td>\r\n			<td>Michael Collins</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Lunar Module Pilot</td>\r\n			<td>Edwin &quot;Buzz&quot; E. Aldrin, Jr.</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Launched by a <strong>Saturn V</strong> rocket from <a href=\"javascript:void(0)\">Kennedy Space Center</a> in Merritt Island, Florida on July 16, Apollo 11 was the fifth manned mission of <a href=\"javascript:void(0)\">NASA</a>&#39;s Apollo program. The Apollo spacecraft had three parts:</p>\r\n\r\n<ol>\r\n	<li><strong>Command Module</strong> with a cabin for the three astronauts which was the only part which landed back on Earth</li>\r\n	<li><strong>Service Module</strong> which supported the Command Module with propulsion, electrical power, oxygen and water</li>\r\n	<li><strong>Lunar Module</strong> for landing on the Moon.</li>\r\n</ol>\r\n\r\n<p>After being sent to the Moon by the Saturn V&#39;s upper stage, the astronauts separated the spacecraft from it and travelled for three days until they entered into lunar orbit. Armstrong and Aldrin then moved into the Lunar Module and landed in the <a href=\"javascript:void(0)\">Sea of Tranquility</a>. They stayed a total of about 21 and a half hours on the lunar surface. After lifting off in the upper part of the Lunar Module and rejoining Collins in the Command Module, they returned to Earth and landed in the <a href=\"javascript:void(0)\">Pacific Ocean</a> on July 24.</p>\r\n','2023-03-09 21:30:11',1,'si','091530_640a4fe35840f_Hoja de Grupo y Tema (1).doc','no'),(16,9,'lorem de uips','lorem de uipslorem de uipslorem de uips','<h2>Technical details <a id=\"tech-details\" name=\"tech-details\"></a></h2>\r\n\r\n<table align=\"right\" border=\"1\" cellpadding=\"5\" cellspacing=\"0\">\r\n	<caption><strong>Mission crew</strong></caption>\r\n	<thead>\r\n		<tr>\r\n			<th scope=\"col\">Position</th>\r\n			<th scope=\"col\">Astronaut</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>Commander</td>\r\n			<td>Neil A. Armstrong</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Command Module Pilot</td>\r\n			<td>Michael Collins</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Lunar Module Pilot</td>\r\n			<td>Edwin &quot;Buzz&quot; E. Aldrin, Jr.</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Launched by a <strong>Saturn V</strong> rocket from <a href=\"javascript:void(0)\">Kennedy Space Center</a> in Merritt Island, Florida on July 16, Apollo 11 was the fifth manned mission of <a href=\"javascript:void(0)\">NASA</a>&#39;s Apollo program. The Apollo spacecraft had three parts:</p>\r\n\r\n<ol>\r\n	<li><strong>Command Module</strong> with a cabin for the three astronauts which was the only part which landed back on Earth</li>\r\n	<li><strong>Service Module</strong> which supported the Command Module with propulsion, electrical power, oxygen and water</li>\r\n	<li><strong>Lunar Module</strong> for landing on the Moon.</li>\r\n</ol>\r\n\r\n<p>After being sent to the Moon by the Saturn V&#39;s upper stage, the astronauts separated the spacecraft from it and travelled for three days until they entered into lunar orbit. Armstrong and Aldrin then moved into the Lunar Module and landed in the <a href=\"javascript:void(0)\">Sea of Tranquility</a>. They stayed a total of about 21 and a half hours on the lunar surface. After lifting off in the upper part of the Lunar Module and rejoining Collins in the Command Module, they returned to Earth and landed in the <a href=\"javascript:void(0)\">Pacific Ocean</a> on July 24.</p>\r\n','2023-03-09 21:43:52',1,'si','091543_640a5318698fd_Hoja de Grupo y Tema (1).doc','si'),(17,1,'IMAGEN','IMAGEN','<p><img alt=\"\" src=\"https://99designs-blog.imgix.net/blog/wp-content/uploads/2016/08/7-types-of-logos.png?auto=format&amp;q=60&amp;fit=max&amp;w=930\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Una Imagen. Fin</p>\r\n','2023-03-18 00:18:42',1,'no',NULL,'no');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificaciones`
--

LOCK TABLES `notificaciones` WRITE;
/*!40000 ALTER TABLE `notificaciones` DISABLE KEYS */;
INSERT INTO `notificaciones` VALUES (3,1,'Nuevo Mensaje Recibido, Nombre Mensaje: Mensaje de libro contable','Por favor revisa tu bandeja de entrada, has recibido un nuevo mensaje. Asunto: Envio Mensaje de libro contable','2023-03-09 21:30:11',3,'no'),(4,1,'Nuevo Mensaje Recibido, Nombre Mensaje: lorem de uips','Por favor revisa tu bandeja de entrada, has recibido un nuevo mensaje. Asunto: lorem de uipslorem de uipslorem de uips','2023-03-09 21:43:52',3,'si'),(5,4,'Nuevo Mensaje Recibido, Nombre Mensaje: IMAGEN','Por favor revisa tu bandeja de entrada, has recibido un nuevo mensaje. Asunto: IMAGEN','2023-03-18 00:18:42',3,'no');
/*!40000 ALTER TABLE `notificaciones` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recuperacion`
--

LOCK TABLES `recuperacion` WRITE;
/*!40000 ALTER TABLE `recuperacion` DISABLE KEYS */;
INSERT INTO `recuperacion` VALUES (1,'dieselmods1@gmail.com','d1d9f3036b',36984,'2023-02-21 23:24:45','nousado'),(2,'2700772019@mail.utec.edu.sv','6b1c31125e',26768,'2023-02-21 23:27:03','nousado'),(3,'2700772019@mail.utec.edu.sv','cb23fd250e',51980,'2023-02-21 23:28:27','nousado'),(4,'2700772019@mail.utec.edu.sv','334b27940e',57782,'2023-02-22 00:31:58','nousado'),(5,'2734002018@mail.utec.edu.sv','df113d7db5',94742,'2023-02-22 00:35:00','nousado'),(6,'2731812020@mail.utec.edu.sv','e2c43efe98',96880,'2023-02-22 00:40:22','nousado'),(7,'dieselmods1@gmail.com','20fac59f4a',34110,'2023-02-22 00:59:54','nousado'),(8,'dieselmods1@gmail.com','d025faba43',32815,'2023-02-22 01:01:22','nousado'),(9,'dieselmods1@gmail.com','b6477aec52',72391,'2023-02-22 01:02:18','nousado'),(10,'dieselmods1@gmail.com','66da30ae73',42964,'2023-02-22 01:03:07','nousado'),(11,'dieselmods1@gmail.com','347c845124',90953,'2023-02-22 01:08:09','nousado'),(12,'dieselmods1@gmail.com','e0974284d7',18367,'2023-02-22 01:10:30','nousado'),(13,'dieselmods1@gmail.com','2640851eb5',68169,'2023-02-22 01:11:14','nousado'),(14,'dieselmods1@gmail.com','0fd8a43b38',85659,'2023-02-22 01:12:32','nousado'),(15,'2700772019@mail.utec.edu.sv','b7f58ebb43',56782,'2023-02-22 01:17:55','nousado'),(16,'2700772019@mail.utec.edu.sv','e42beb3e59',90219,'2023-02-22 01:19:23','nousado'),(17,'2794884@m.com','00c3ce476f',33900,'2023-02-22 01:23:27','nousado'),(18,'lorem@lorem.com','bf4baa298c',17707,'2023-02-22 20:54:22','nousado'),(19,'dieselmods1@gmail.com','8610fcb420',31141,'2023-02-22 21:05:39','nousado'),(20,'dieselmods1@gmail.com','15dbd8bd38',54540,'2023-02-22 21:06:09','nousado'),(21,'dieselmods1@gmail.com','6629f4ed02',15705,'2023-02-22 21:06:34','nousado'),(22,'dieselmods1@gmail.com','a08e7ffdb9',70806,'2023-02-22 21:07:16','nousado'),(23,'dieselmods1@gmail.com','380654cd88',29785,'2023-02-22 21:07:55','nousado'),(24,'dieselmods1@gmail.com','42360f8223',25276,'2023-02-22 21:09:51','nousado'),(25,'dieselmods1@gmail.com','5dfc7d5939',96698,'2023-02-22 21:11:10','nousado'),(26,'2700772019@mail.utec.edu.sv','8a2151df6c',92782,'2023-02-22 21:12:22','nousado'),(27,'dieselmods1@gmail.com','c04a2b8cc9',82330,'2023-02-22 21:13:58','nousado'),(28,'dieselmods1@gmail.com','00f6b34d0d',64165,'2023-02-22 21:53:05','nousado'),(29,'dieselmods1@gmail.com','b68e10f2a2',97175,'2023-02-22 23:33:17','nousado'),(30,'dieselmods1@gmail.com','c41ab7e423',79885,'2023-02-22 23:38:34','nousado'),(31,'dieselmods1@gmail.com','d67bcf0f4a',81978,'2023-02-22 23:40:10','nousado'),(32,'dieselmods1@gmail.com','1cfdb7e597',98332,'2023-02-22 23:41:20','nousado'),(33,'dieselmods1@gmail.com','8d601597b0',74052,'2023-02-23 00:00:51','usado'),(34,'dieselmods1@gmail.com','698f691c4a',26713,'2023-02-23 00:20:01','usado'),(35,'dieselmods1@gmail.com','5f487022cf',50748,'2023-02-23 00:21:46','usado'),(36,'dieselmods1@gmail.com','1585302ac0',40516,'2023-02-23 00:45:19','usado'),(37,'dieselmods1@gmail.com','5f46524704',90003,'2023-02-23 00:53:04','usado'),(38,'dieselmods1@gmail.com','eba985b3d9',37053,'2023-02-23 00:56:49','usado'),(39,'dieselmods1@gmail.com','d2b19709eb',20807,'2023-02-23 20:44:27','nousado'),(40,'dieselmods1@gmail.com','cd4c4b8cf4',74439,'2023-02-23 20:47:31','nousado'),(41,'dieselmods1@gmail.com','2ed887470f',21534,'2023-02-23 20:52:21','usado'),(42,'dieselmods1@gmail.com','13713b25c6',80515,'2023-02-23 21:54:25','usado'),(43,'dieselmods1@gmail.com','8b99ab20ca',83858,'2023-02-23 22:01:44','usado'),(44,'dieselmods1@gmail.com','b57bea1878',28354,'2023-02-23 22:09:39','nousado'),(45,'dieselmods1@gmail.com','55d1a8b02f',79401,'2023-02-23 23:09:39','nousado'),(46,'dieselmods1@gmail.com','9abb954d6d',10090,'2023-02-23 23:11:23','usado'),(47,'dieselmods1@gmail.com','0acbc3b66a',85461,'2023-02-23 23:15:40','usado'),(48,'dieselmods1@gmail.com','c719e90064',48299,'2023-02-24 00:02:56','usado'),(49,'dieselmods1@gmail.com','068010bbea',59875,'2023-02-24 00:04:57','usado'),(50,'dieselmods1@gmail.com','b10a9bb6f3',82755,'2023-02-24 00:57:02','nousado'),(51,'dieselmods1@gmail.com','438e432cb3',11414,'2023-02-24 00:58:35','usado'),(52,'dieselmods1@gmail.com','a49219f67c',17607,'2023-02-24 20:45:02','nousado'),(53,'dieselmods1@gmail.com','c4a1b6c7f2',24885,'2023-02-24 21:12:21','usado'),(54,'dieselmods1@gmail.com','d5abda5098',27442,'2023-03-01 01:26:24','nousado'),(55,'dieselmods1@gmail.com','bd944de381',51762,'2023-03-01 01:29:50','nousado'),(56,'dieselmods1@gmail.com','cb4e3f9137',73595,'2023-03-01 01:31:53','usado'),(57,'proyectosedmr@gmail.com','1392769904',19156,'2023-03-10 06:21:19','usado'),(58,'dieselmods1@gmail.com','e924a674c2',63432,'2023-03-16 21:53:12','nousado'),(59,'dieselmods1@gmail.com','65e2d47c73',88712,'2023-03-16 21:55:45','nousado'),(60,'dieselmods1@gmail.com','c2a016f0a9',44234,'2023-03-16 22:03:56','nousado'),(61,'dieselmods1@gmail.com','cdb12a9239',25626,'2023-03-16 22:05:37','usado'),(62,'dieselmods1@gmail.com','66371074a9',95234,'2023-03-18 06:28:01','nousado'),(63,'dieselmods1@gmail.com','8465a87aaf',33528,'2023-03-18 06:29:36','nousado'),(64,'dieselmods1@gmail.com','a6f8d63175',28679,'2023-03-18 06:33:05','nousado');
/*!40000 ALTER TABLE `recuperacion` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Coordinador de Laboratorios','Administrador general de sistema, coordinador general de laboratorios.'),(2,'Administrador de Laboratorios','Usuarios asignados a un laboratorio especifico. Administradores de uno o varios laboratorios.'),(3,'Docente','Todos los docentes de las diferentes facultades de la universidad.');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_reservaciones`
--

LOCK TABLES `tipo_reservaciones` WRITE;
/*!40000 ALTER TABLE `tipo_reservaciones` DISABLE KEYS */;
INSERT INTO `tipo_reservaciones` VALUES (1,'Práctica Programada (Clases)','Práctica programada hora clase, para todas las asignaturas que requieran el uso de los laboratorios de informática'),(2,'Cursos Libres','Diferentes cursos libres, ofrecidos a la comunidad estudiantil o terceros'),(3,'Seminarios','Diferentes seminarios ofrecidos en las asignaturas requeridas'),(4,'Tour Utec','Tour ofrecido a potenciales estudiantes de nuevo ingreso UTEC'),(5,'Certificaciones','Diferentes certificaciones ofrecidas a la comunidad estudiantil o público en general.');
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
  `completarperfil` char(2) NOT NULL DEFAULT 'si',
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idusuarios`),
  UNIQUE KEY `codigousuario` (`codigousuario`),
  UNIQUE KEY `correo` (`correo`),
  KEY `fk_usuarios-roles` (`idrolusuario`),
  CONSTRAINT `fk_usuarios-roles` FOREIGN KEY (`idrolusuario`) REFERENCES `roles` (`idrolusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,1,'Daniel','Rivera','daniel.rivera','dieselmods1@gmail.com','icon-fotoperfildefecto.gif','$argon2i$v=19$m=65536,t=4,p=2$NVlOd3J0LjRTZFRZclJYUg$BHVTY8NCM50f0gttEoMKV5V1A1IzpW4JwTh9rwx7gSg','si','2023-03-06 10:11:15','activo','si','si','si','si','si','si','si','si','si','si','si','si','si','si','si','si','2023-02-28 20:47:12'),(2,1,'Kevin','Rivera','kevin.rivera','2734002018@mail.utec.edu.sv','icon-fotoperfildefecto.gif','$argon2i$v=19$m=65536,t=4,p=2$V3F1V3UwTmRtSlQyOENEbg$v4ER5wPWkhFKkG810eiUcjIwq9I6TtVqJmdRy/J70rQ','si','2023-03-01 21:40:20','activo','si','si','si','si','si','si','si','si','si','si','si','si','si','si','si','si','2023-03-01 21:40:20'),(3,1,'Irving','Dominguez','irving.dominguez','2731812020@mail.utec.edu.sv','icon-fotoperfildefecto.gif','$argon2i$v=19$m=65536,t=4,p=2$V2pnRjVaMDlHeWE5YVVqRw$drPLhhprJO+gdZWOO4DWI9nmQ9E8sbPbCO9qt5lvuOE','si','2023-03-01 21:41:39','activo','si','si','si','si','si','si','si','si','si','si','si','si','si','si','si','si','2023-03-01 21:41:39'),(4,2,'Elias','Martinez','elias.martinez','a@a.com','icon-fotoperfildefecto.gif','$argon2i$v=19$m=65536,t=4,p=2$NjNCdXNaRW1WWGlGUnVvVA$pIwPlcE2NwGX8k55OgftRBZBZtHBtxDv6ECpWYs1fog','si','2023-03-01 21:42:46','inactivo','','','','','','','','','','','','','','','','si','2023-03-01 21:42:46'),(9,1,'Elias','Martinez','elias.martinezz','proyectosedmr@gmail.com','061611_640665036b8ee_1590693630_image.jpg','$argon2i$v=19$m=65536,t=4,p=2$UkJCUk8zaXJUZVhjbGx2ZQ$ADlmc12hulg3grVXr0AOZk5u2vxjK2y5YFOqPuL/lDM','si','2023-03-01 22:11:35','activo','','','','','','','','','','','','','','','','si','2023-03-01 22:11:35'),(18,2,'Maria DBA','Lorem','mari.lorem','2700772019@mail.utec.edu.sv','icon-fotoperfildefecto.gif','$argon2i$v=19$m=65536,t=4,p=2$V2ljTFJrTU1SVnVnUzdLMg$srsxfIReHyJZmMPtrvYyZhpEI6/J2RQhUaC/CBBPCQk','si','2023-03-16 21:51:36','activo','si','no','no','no','no','no','no','no','no','no','no','no','no','no','si','si','2023-03-16 21:51:36');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

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
 1 AS `lab15`*/;
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
 1 AS `telefonotrabajo`,
 1 AS `genero`,
 1 AS `fechanacimiento`,
 1 AS `estadocivil`*/;
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
 1 AS `estadolaboratorio`*/;
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ActualizacionDetallesUsuariosMiPerfil`(IN `_idusuarios` INT, IN `_telefonoprincipal` VARCHAR(9), IN `_telefonotrabajo` VARCHAR(9), IN `_genero` CHAR(2), IN `_fechanacimiento` DATE, IN `_estadocivil` VARCHAR(25))
BEGIN
	UPDATE detallesusuarios SET telefonoprincipal=_telefonoprincipal, telefonotrabajo=_telefonotrabajo, genero=_genero, fechanacimiento=_fechanacimiento, estadocivil=_estadocivil WHERE idusuarios=_idusuarios;
END ;;
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
UPDATE usuarios SET contrasenia=_contrasenia WHERE correo=_correo ;;
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultaDisponibilidadReservaciones`(IN `_idaplicacion` INT, IN `_totalusuarios` INT)
BEGIN
SELECT 
    laboratorios.codigolaboratorio,
    laboratorios.nombrelaboratorio,
    laboratorios.capacidadlaboratorio-laboratorios.maquinasfuerauso AS capacidadreal
FROM 
    aplicaciones_laboratorios
    JOIN laboratorios ON 
        (aplicaciones_laboratorios.lab1 = 'si' AND laboratorios.codigolaboratorio = 'lab1') OR 
        (aplicaciones_laboratorios.lab2 = 'si' AND laboratorios.codigolaboratorio = 'lab2') OR 
        (aplicaciones_laboratorios.lab3 = 'si' AND laboratorios.codigolaboratorio = 'lab3') OR 
        (aplicaciones_laboratorios.lab4 = 'si' AND laboratorios.codigolaboratorio = 'lab4') OR 
        (aplicaciones_laboratorios.lab5 = 'si' AND laboratorios.codigolaboratorio = 'lab5') OR 
        (aplicaciones_laboratorios.lab6 = 'si' AND laboratorios.codigolaboratorio = 'lab6') OR 
        (aplicaciones_laboratorios.lab7 = 'si' AND laboratorios.codigolaboratorio = 'lab7') OR 
        (aplicaciones_laboratorios.lab8 = 'si' AND laboratorios.codigolaboratorio = 'lab8') OR 
        (aplicaciones_laboratorios.lab9 = 'si' AND laboratorios.codigolaboratorio = 'lab9') OR 
        (aplicaciones_laboratorios.lab10 = 'si' AND laboratorios.codigolaboratorio = 'lab10') OR 
        (aplicaciones_laboratorios.lab11 = 'si' AND laboratorios.codigolaboratorio = 'lab11') OR 
        (aplicaciones_laboratorios.lab12 = 'si' AND laboratorios.codigolaboratorio = 'lab12') OR 
        (aplicaciones_laboratorios.lab13 = 'si' AND laboratorios.codigolaboratorio = 'lab13') OR 
        (aplicaciones_laboratorios.lab14 = 'si' AND laboratorios.codigolaboratorio = 'lab14') OR 
        (aplicaciones_laboratorios.lab15 = 'si' AND laboratorios.codigolaboratorio = 'lab15')
WHERE 
    aplicaciones_laboratorios.idaplicacion = _idaplicacion AND laboratorios.capacidadlaboratorio-laboratorios.maquinasfuerauso >=_totalusuarios AND laboratorios.estadolaboratorio='activo'
GROUP BY 
    laboratorios.codigolaboratorio,
    laboratorios.nombrelaboratorio,
    laboratorios.capacidadlaboratorio;
    
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ModificarDatosUsuarios`(IN `_idusuarios` INT, IN `_nombres` VARCHAR(255), IN `_apellidos` VARCHAR(255), IN `_codigousuario` VARCHAR(255), IN `_correo` VARCHAR(255), IN `_idrolusuario` INT, IN `_estado_usuario` VARCHAR(15), IN `_lab1` CHAR(2), IN `_lab2` CHAR(2), IN `_lab3` CHAR(2), IN `_lab4` CHAR(2), IN `_lab5` CHAR(2), IN `_lab6` CHAR(2), IN `_lab7` CHAR(2), IN `_lab8` CHAR(2), IN `_lab9` CHAR(2), IN `_lab10` CHAR(2), IN `_lab11` CHAR(2), IN `_lab12` CHAR(2), IN `_lab13` CHAR(2), IN `_lab14` CHAR(2), IN `_lab15` CHAR(2))
BEGIN

UPDATE usuarios SET nombres=_nombres, apellidos=_apellidos, codigousuario=_codigousuario, correo=_correo, idrolusuario=_idrolusuario, estado_usuario=_estado_usuario, lab1=_lab1, lab2=_lab2, lab3=_lab3, lab4=_lab4, lab5=_lab5, lab6=_lab6, lab7=_lab7, lab8=_lab8, lab9=_lab9, lab10=_lab10, lab11=_lab11, lab12=_lab12, lab13=_lab13, lab14=_lab14, lab15=_lab15 WHERE idusuarios=_idusuarios;

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
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_RegistroNuevosUsuarios`(IN `_idrolusuario` INT, IN `_nombres` VARCHAR(255), IN `_apellidos` VARCHAR(255), IN `_codigousuario` VARCHAR(255), IN `_correo` VARCHAR(255), IN `_contrasenia` VARCHAR(255), IN `_lab1` CHAR(2), IN `_lab2` CHAR(2), IN `_lab3` CHAR(2), IN `_lab4` CHAR(2), IN `_lab5` CHAR(2), IN `_lab6` CHAR(2), IN `_lab7` CHAR(2), IN `_lab8` CHAR(2), IN `_lab9` CHAR(2), IN `_lab10` CHAR(2), IN `_lab11` CHAR(2), IN `_lab12` CHAR(2), IN `_lab13` CHAR(2), IN `_lab14` CHAR(2), IN `_lab15` CHAR(2))
BEGIN

INSERT INTO usuarios (idrolusuario,nombres,apellidos,codigousuario,correo,contrasenia,lab1,lab2,lab3,lab4,lab5,lab6,lab7,lab8,lab9,lab10,lab11,lab12,lab13,lab14,lab15) VALUES
(_idrolusuario,_nombres,_apellidos,_codigousuario,_correo,_contrasenia,_lab1,_lab2,_lab3,_lab4,_lab5,_lab6,_lab7,_lab8,_lab9,_lab10,_lab11,_lab12,_lab13,_lab14,_lab15);

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
/*!50001 VIEW `vista_consultageneralusuarios_registrados` AS select `usuarios`.`idusuarios` AS `idusuarios`,`usuarios`.`idrolusuario` AS `idrolusuario`,`roles`.`nombrerolusuario` AS `nombrerolusuario`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`usuarios`.`codigousuario` AS `codigousuario`,`usuarios`.`correo` AS `correo`,`usuarios`.`fotoperfil` AS `fotoperfil`,`usuarios`.`nuevousuario` AS `nuevousuario`,`usuarios`.`estado_usuario` AS `estado_usuario`,`usuarios`.`fecha_registro` AS `fecha_registro`,`usuarios`.`lab1` AS `lab1`,`usuarios`.`lab2` AS `lab2`,`usuarios`.`lab3` AS `lab3`,`usuarios`.`lab4` AS `lab4`,`usuarios`.`lab5` AS `lab5`,`usuarios`.`lab6` AS `lab6`,`usuarios`.`lab7` AS `lab7`,`usuarios`.`lab8` AS `lab8`,`usuarios`.`lab9` AS `lab9`,`usuarios`.`lab10` AS `lab10`,`usuarios`.`lab11` AS `lab11`,`usuarios`.`lab12` AS `lab12`,`usuarios`.`lab13` AS `lab13`,`usuarios`.`lab14` AS `lab14`,`usuarios`.`lab15` AS `lab15` from (`usuarios` join `roles` on(`usuarios`.`idrolusuario` = `roles`.`idrolusuario`)) */;
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
/*!50001 VIEW `vista_detallespefilusuarios` AS select `usuarios`.`idusuarios` AS `idusuarios`,`usuarios`.`idrolusuario` AS `idrolusuario`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`usuarios`.`codigousuario` AS `codigousuario`,`usuarios`.`correo` AS `correo`,`usuarios`.`fotoperfil` AS `fotoperfil`,`usuarios`.`ultimo_cambio_contrasenia` AS `ultimo_cambio_contrasenia`,`usuarios`.`estado_usuario` AS `estado_usuario`,`usuarios`.`fecha_registro` AS `fecha_registro`,`detallesusuarios`.`telefonoprincipal` AS `telefonoprincipal`,`detallesusuarios`.`telefonotrabajo` AS `telefonotrabajo`,`detallesusuarios`.`genero` AS `genero`,`detallesusuarios`.`fechanacimiento` AS `fechanacimiento`,`detallesusuarios`.`estadocivil` AS `estadocivil` from (`usuarios` join `detallesusuarios` on(`detallesusuarios`.`idusuarios` = `usuarios`.`idusuarios`)) */;
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
/*!50001 VIEW `vista_informaciongenerallaboratoriosreservaciones` AS select `laboratorios`.`idlaboratorio` AS `idlaboratorio`,`laboratorios`.`codigolaboratorio` AS `codigolaboratorio`,`laboratorios`.`nombrelaboratorio` AS `nombrelaboratorio`,`laboratorios`.`capacidadlaboratorio` - `laboratorios`.`maquinasfuerauso` AS `capacidadreal`,`laboratorios`.`estadolaboratorio` AS `estadolaboratorio` from `laboratorios` */;
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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-03-21 19:13:02
