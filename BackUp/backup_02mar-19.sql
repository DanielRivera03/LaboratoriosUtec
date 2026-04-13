CREATE DATABASE  IF NOT EXISTS `control_laboratorios_utec` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `control_laboratorios_utec`;
-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: control_laboratorios_utec
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.24-MariaDB

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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accesos`
--

LOCK TABLES `accesos` WRITE;
/*!40000 ALTER TABLE `accesos` DISABLE KEYS */;
INSERT INTO `accesos` VALUES (23,'2023-03-01 18:40:56',NULL,1),(24,'2023-03-02 14:28:10',NULL,1),(25,'2023-03-02 19:06:32',NULL,1);
/*!40000 ALTER TABLE `accesos` ENABLE KEYS */;
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
  PRIMARY KEY (`idclasificacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clasificacion_notificaciones`
--

LOCK TABLES `clasificacion_notificaciones` WRITE;
/*!40000 ALTER TABLE `clasificacion_notificaciones` DISABLE KEYS */;
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
  `fechanacimiento` datetime NOT NULL,
  `estadocivil` varchar(25) NOT NULL,
  `idusuarios` int(11) NOT NULL,
  PRIMARY KEY (`iddetalleusuarios`),
  KEY `fk_detalleusuarios-usuarios` (`idusuarios`),
  CONSTRAINT `fk_detalleusuarios-usuarios` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detallesusuarios`
--

LOCK TABLES `detallesusuarios` WRITE;
/*!40000 ALTER TABLE `detallesusuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `detallesusuarios` ENABLE KEYS */;
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
  `fecharegistro` datetime NOT NULL,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado` varchar(25) NOT NULL DEFAULT 'pendiente',
  `comentario_actualizacion` varchar(700) NOT NULL,
  PRIMARY KEY (`idmanifiesto`),
  KEY `fk_manifiestos-usuarios` (`idusuarios`),
  CONSTRAINT `fk_manifiestos-usuarios` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manifiestos_plataforma`
--

LOCK TABLES `manifiestos_plataforma` WRITE;
/*!40000 ALTER TABLE `manifiestos_plataforma` DISABLE KEYS */;
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
  `fechamensaje` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idusuarios_destinatario` int(11) NOT NULL,
  `ocultarmensaje` char(2) NOT NULL DEFAULT 'no',
  PRIMARY KEY (`idmensajeria`),
  KEY `fk_mensajeria_usuarios_destinatariofinal` (`idusuarios`),
  CONSTRAINT `fk_mensajeria_usuarios_destinatariofinal` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`),
  CONSTRAINT `fk_usuarios_mensajeria_bandejaentrada` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensajeria`
--

LOCK TABLES `mensajeria` WRITE;
/*!40000 ALTER TABLE `mensajeria` DISABLE KEYS */;
/*!40000 ALTER TABLE `mensajeria` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificaciones`
--

LOCK TABLES `notificaciones` WRITE;
/*!40000 ALTER TABLE `notificaciones` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recuperacion`
--

LOCK TABLES `recuperacion` WRITE;
/*!40000 ALTER TABLE `recuperacion` DISABLE KEYS */;
INSERT INTO `recuperacion` VALUES (1,'dieselmods1@gmail.com','d1d9f3036b',36984,'2023-02-21 23:24:45','nousado'),(2,'2700772019@mail.utec.edu.sv','6b1c31125e',26768,'2023-02-21 23:27:03','nousado'),(3,'2700772019@mail.utec.edu.sv','cb23fd250e',51980,'2023-02-21 23:28:27','nousado'),(4,'2700772019@mail.utec.edu.sv','334b27940e',57782,'2023-02-22 00:31:58','nousado'),(5,'2734002018@mail.utec.edu.sv','df113d7db5',94742,'2023-02-22 00:35:00','nousado'),(6,'2731812020@mail.utec.edu.sv','e2c43efe98',96880,'2023-02-22 00:40:22','nousado'),(7,'dieselmods1@gmail.com','20fac59f4a',34110,'2023-02-22 00:59:54','nousado'),(8,'dieselmods1@gmail.com','d025faba43',32815,'2023-02-22 01:01:22','nousado'),(9,'dieselmods1@gmail.com','b6477aec52',72391,'2023-02-22 01:02:18','nousado'),(10,'dieselmods1@gmail.com','66da30ae73',42964,'2023-02-22 01:03:07','nousado'),(11,'dieselmods1@gmail.com','347c845124',90953,'2023-02-22 01:08:09','nousado'),(12,'dieselmods1@gmail.com','e0974284d7',18367,'2023-02-22 01:10:30','nousado'),(13,'dieselmods1@gmail.com','2640851eb5',68169,'2023-02-22 01:11:14','nousado'),(14,'dieselmods1@gmail.com','0fd8a43b38',85659,'2023-02-22 01:12:32','nousado'),(15,'2700772019@mail.utec.edu.sv','b7f58ebb43',56782,'2023-02-22 01:17:55','nousado'),(16,'2700772019@mail.utec.edu.sv','e42beb3e59',90219,'2023-02-22 01:19:23','nousado'),(17,'2794884@m.com','00c3ce476f',33900,'2023-02-22 01:23:27','nousado'),(18,'lorem@lorem.com','bf4baa298c',17707,'2023-02-22 20:54:22','nousado'),(19,'dieselmods1@gmail.com','8610fcb420',31141,'2023-02-22 21:05:39','nousado'),(20,'dieselmods1@gmail.com','15dbd8bd38',54540,'2023-02-22 21:06:09','nousado'),(21,'dieselmods1@gmail.com','6629f4ed02',15705,'2023-02-22 21:06:34','nousado'),(22,'dieselmods1@gmail.com','a08e7ffdb9',70806,'2023-02-22 21:07:16','nousado'),(23,'dieselmods1@gmail.com','380654cd88',29785,'2023-02-22 21:07:55','nousado'),(24,'dieselmods1@gmail.com','42360f8223',25276,'2023-02-22 21:09:51','nousado'),(25,'dieselmods1@gmail.com','5dfc7d5939',96698,'2023-02-22 21:11:10','nousado'),(26,'2700772019@mail.utec.edu.sv','8a2151df6c',92782,'2023-02-22 21:12:22','nousado'),(27,'dieselmods1@gmail.com','c04a2b8cc9',82330,'2023-02-22 21:13:58','nousado'),(28,'dieselmods1@gmail.com','00f6b34d0d',64165,'2023-02-22 21:53:05','nousado'),(29,'dieselmods1@gmail.com','b68e10f2a2',97175,'2023-02-22 23:33:17','nousado'),(30,'dieselmods1@gmail.com','c41ab7e423',79885,'2023-02-22 23:38:34','nousado'),(31,'dieselmods1@gmail.com','d67bcf0f4a',81978,'2023-02-22 23:40:10','nousado'),(32,'dieselmods1@gmail.com','1cfdb7e597',98332,'2023-02-22 23:41:20','nousado'),(33,'dieselmods1@gmail.com','8d601597b0',74052,'2023-02-23 00:00:51','usado'),(34,'dieselmods1@gmail.com','698f691c4a',26713,'2023-02-23 00:20:01','usado'),(35,'dieselmods1@gmail.com','5f487022cf',50748,'2023-02-23 00:21:46','usado'),(36,'dieselmods1@gmail.com','1585302ac0',40516,'2023-02-23 00:45:19','usado'),(37,'dieselmods1@gmail.com','5f46524704',90003,'2023-02-23 00:53:04','usado'),(38,'dieselmods1@gmail.com','eba985b3d9',37053,'2023-02-23 00:56:49','usado'),(39,'dieselmods1@gmail.com','d2b19709eb',20807,'2023-02-23 20:44:27','nousado'),(40,'dieselmods1@gmail.com','cd4c4b8cf4',74439,'2023-02-23 20:47:31','nousado'),(41,'dieselmods1@gmail.com','2ed887470f',21534,'2023-02-23 20:52:21','usado'),(42,'dieselmods1@gmail.com','13713b25c6',80515,'2023-02-23 21:54:25','usado'),(43,'dieselmods1@gmail.com','8b99ab20ca',83858,'2023-02-23 22:01:44','usado'),(44,'dieselmods1@gmail.com','b57bea1878',28354,'2023-02-23 22:09:39','nousado'),(45,'dieselmods1@gmail.com','55d1a8b02f',79401,'2023-02-23 23:09:39','nousado'),(46,'dieselmods1@gmail.com','9abb954d6d',10090,'2023-02-23 23:11:23','usado'),(47,'dieselmods1@gmail.com','0acbc3b66a',85461,'2023-02-23 23:15:40','usado'),(48,'dieselmods1@gmail.com','c719e90064',48299,'2023-02-24 00:02:56','usado'),(49,'dieselmods1@gmail.com','068010bbea',59875,'2023-02-24 00:04:57','usado'),(50,'dieselmods1@gmail.com','b10a9bb6f3',82755,'2023-02-24 00:57:02','nousado'),(51,'dieselmods1@gmail.com','438e432cb3',11414,'2023-02-24 00:58:35','usado'),(52,'dieselmods1@gmail.com','a49219f67c',17607,'2023-02-24 20:45:02','nousado'),(53,'dieselmods1@gmail.com','c4a1b6c7f2',24885,'2023-02-24 21:12:21','usado'),(54,'dieselmods1@gmail.com','d5abda5098',27442,'2023-03-01 01:26:24','nousado'),(55,'dieselmods1@gmail.com','bd944de381',51762,'2023-03-01 01:29:50','nousado'),(56,'dieselmods1@gmail.com','cb4e3f9137',73595,'2023-03-01 01:31:53','usado');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrador','Administrador general de sistema'),(2,'Administrador de Laboratorios','usuarios administradores de laboratorios');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
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
  `fotoperfil` varchar(255) NOT NULL,
  `contrasenia` varchar(255) NOT NULL,
  `nuevousuario` char(2) NOT NULL DEFAULT 'si',
  `ultimo_cambio_contrasenia` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado_usuario` varchar(15) NOT NULL DEFAULT 'activo',
  `labotatorio_asignado` int(11) NOT NULL DEFAULT 0,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idusuarios`),
  UNIQUE KEY `codigousuario` (`codigousuario`),
  UNIQUE KEY `correo` (`correo`),
  KEY `fk_usuarios-roles` (`idrolusuario`),
  CONSTRAINT `fk_usuarios-roles` FOREIGN KEY (`idrolusuario`) REFERENCES `roles` (`idrolusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,1,'Daniel','Rivera','daniel.rivera','dieselmods1@gmail.com','b1.png','$argon2i$v=19$m=65536,t=4,p=2$RUwwLjhpZGgwbzlJc2E2Rg$iwdsnaAchnnitq3BXaxFDM2KxVSg4uOffuCheUJ9YJY','si','2023-02-21 21:15:14','activo',0,'2023-02-28 20:47:12'),(2,1,'Kevin','Rivera','kevin.rivera','2734002018@mail.utec.edu.sv','','$argon2i$v=19$m=65536,t=4,p=2$V3F1V3UwTmRtSlQyOENEbg$v4ER5wPWkhFKkG810eiUcjIwq9I6TtVqJmdRy/J70rQ','si','2023-03-01 21:40:20','activo',0,'2023-03-01 21:40:20'),(3,1,'Irving','Dominguez','irving.dominguez','2731812020@mail.utec.edu.sv','','$argon2i$v=19$m=65536,t=4,p=2$V2pnRjVaMDlHeWE5YVVqRw$drPLhhprJO+gdZWOO4DWI9nmQ9E8sbPbCO9qt5lvuOE','si','2023-03-01 21:41:39','activo',0,'2023-03-01 21:41:39'),(4,2,'Elias','Martinez','elias.martinez','2700772019@mail.utec.edu.sv','','$argon2i$v=19$m=65536,t=4,p=2$NjNCdXNaRW1WWGlGUnVvVA$pIwPlcE2NwGX8k55OgftRBZBZtHBtxDv6ECpWYs1fog','si','2023-03-01 21:42:46','inactivo',2,'2023-03-01 21:42:46'),(9,1,'Elias','Martinez','elias.martinezz','proyectosedmr@gmail.com','','$argon2i$v=19$m=65536,t=4,p=2$QnhjYkhTTzhrV1BHYmljbA$NOOwTo3ccHjdT+6Gmdid1TCjTbfSwdzWODfFDIIj710','si','2023-03-01 22:11:35','bloqueado',0,'2023-03-01 22:11:35');
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
 1 AS `labotatorio_asignado`,
 1 AS `fecha_registro`*/;
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ConsultarCredencialesUsuarios`(IN Usuario VARCHAR(255))
SELECT idusuarios, codigousuario, correo, contrasenia, estado_usuario FROM usuarios WHERE (codigousuario=Usuario OR correo=Usuario) ;;
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
SELECT * FROM vista_autenticacionusuarios WHERE (codigousuario=Usuario OR correo=Usuario) AND contrasenia=Pass AND estado_usuario="activo" ;;
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ModificarDatosUsuarios`(IN `_idusuarios` INT, IN `_nombres` VARCHAR(255), IN `_apellidos` VARCHAR(255), IN `_codigousuario` VARCHAR(255), IN `_correo` VARCHAR(255), IN `_idrolusuario` INT, IN `_labotatorio_asignado` INT, IN `_estado_usuario` VARCHAR(15))
BEGIN

UPDATE usuarios SET nombres=_nombres, apellidos=_apellidos, codigousuario=_codigousuario, correo=_correo, idrolusuario=_idrolusuario, labotatorio_asignado=_labotatorio_asignado, estado_usuario=_estado_usuario WHERE idusuarios=_idusuarios;

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
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_RegistroNuevosUsuarios`(IN `_idrolusuario` INT, IN `_nombres` VARCHAR(255), IN `_apellidos` VARCHAR(255), IN `_codigousuario` VARCHAR(255), IN `_correo` VARCHAR(255), IN `_contrasenia` VARCHAR(255), IN `_labotatorio_asignado` INT)
BEGIN

INSERT INTO usuarios (idrolusuario,nombres,apellidos,codigousuario,correo,contrasenia,labotatorio_asignado) VALUES
(_idrolusuario,_nombres,_apellidos,_codigousuario,_correo,_contrasenia,_labotatorio_asignado);

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
/*!50001 VIEW `vista_consultageneralusuarios_registrados` AS select `usuarios`.`idusuarios` AS `idusuarios`,`usuarios`.`idrolusuario` AS `idrolusuario`,`roles`.`nombrerolusuario` AS `nombrerolusuario`,`usuarios`.`nombres` AS `nombres`,`usuarios`.`apellidos` AS `apellidos`,`usuarios`.`codigousuario` AS `codigousuario`,`usuarios`.`correo` AS `correo`,`usuarios`.`fotoperfil` AS `fotoperfil`,`usuarios`.`nuevousuario` AS `nuevousuario`,`usuarios`.`estado_usuario` AS `estado_usuario`,`usuarios`.`labotatorio_asignado` AS `labotatorio_asignado`,`usuarios`.`fecha_registro` AS `fecha_registro` from (`usuarios` join `roles` on(`usuarios`.`idrolusuario` = `roles`.`idrolusuario`)) */;
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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-03-02 19:08:17
