-- MySQL dump 10.13  Distrib 5.7.40, for Win32 (AMD64)
--
-- Host: localhost    Database: testdb1
-- ------------------------------------------------------
-- Server version	5.7.40-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `burgers`
--

DROP TABLE IF EXISTS `burgers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `burgers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `orders_count` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `adress` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `burgers`
--

LOCK TABLES `burgers` WRITE;
/*!40000 ALTER TABLE `burgers` DISABLE KEYS */;
INSERT INTO `burgers` VALUES (1,'one@example.com',NULL,NULL,'Zelenaya 23-15');
/*!40000 ALTER TABLE `burgers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `burgers2`
--

DROP TABLE IF EXISTS `burgers2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `burgers2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `orders_count` int(11) DEFAULT NULL,
  `mydate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `adress` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `burgers2`
--

LOCK TABLES `burgers2` WRITE;
/*!40000 ALTER TABLE `burgers2` DISABLE KEYS */;
/*!40000 ALTER TABLE `burgers2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `burgers3`
--

DROP TABLE IF EXISTS `burgers3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `burgers3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `orders_count` int(11) DEFAULT NULL,
  `mydate` datetime DEFAULT CURRENT_TIMESTAMP,
  `adress` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `burgers3`
--

LOCK TABLES `burgers3` WRITE;
/*!40000 ALTER TABLE `burgers3` DISABLE KEYS */;
INSERT INTO `burgers3` VALUES (1,'one@example.com',NULL,'2022-12-07 12:03:24','Zelenaya 23-15');
/*!40000 ALTER TABLE `burgers3` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `burgers4`
--

DROP TABLE IF EXISTS `burgers4`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `burgers4` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `orders_count` int(11) DEFAULT '0',
  `mydate` datetime DEFAULT CURRENT_TIMESTAMP,
  `adress` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `burgers4`
--

LOCK TABLES `burgers4` WRITE;
/*!40000 ALTER TABLE `burgers4` DISABLE KEYS */;
INSERT INTO `burgers4` VALUES (1,'one@example.com',0,'2022-12-07 14:21:57','Zelenaya 23-15'),(2,'two@example.com',1,'2022-12-07 14:23:57','Solnechnaya 1-9'),(4,'ttt@tt.ru',16,'2022-12-07 15:07:07','bykovaya 33-3'),(5,'aaa@aaa.ru',0,'2022-12-08 10:00:36','ÑƒÐ» Ð´ Ðº ÐºÐ² ÑÑ‚'),(6,'r@r.ru',10,'2022-12-08 10:00:54','    '),(7,'krk@ty.ru',0,'2022-12-08 10:27:52','ÐµÐ»Ð¾Ð²Ð°Ñ 3 1 10 5'),(8,'dfds@gf.ru',0,'2022-12-08 10:33:05','ÑˆÐ¸ÑˆÐºÐ¸Ð½Ð° 34 2 3 4'),(9,'fff@g.ru',2,'2022-12-08 10:34:14','Ð¿Ð°Ñ€ÐºÐ¾Ð²Ð°Ñ 34 3 2 5'),(10,'ddd@dfr.ru',1,'2022-12-08 10:39:19','ÑÐ¾Ð»Ð½ÐµÑ‡Ð½Ð°Ñ 56 2 2 3'),(11,'fff@www.ru',0,'2022-12-08 10:40:57','ÑÐ¸Ð½ÑÑ 5 4 5 4'),(12,'ddddd@fff.ru',0,'2022-12-08 10:42:36','ÑƒÐ». Ð¿ÑÑ‚Ð°Ñ, Ð´. 34, ÐºÐ¾Ñ€Ð¿. 65, ÐºÐ². 4, ÑÑ‚. 4');
/*!40000 ALTER TABLE `burgers4` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `adress` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,1111,NULL,'Zelenaya 23-15');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `orders_count` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'ttt@ttt.ru',1);
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

-- Dump completed on 2022-12-08 11:13:04
