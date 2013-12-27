-- MySQL dump 10.14  Distrib 5.5.32-MariaDB, for Linux (i686)
--
-- Host: localhost    Database: pset7
-- ------------------------------------------------------
-- Server version	5.5.32-MariaDB

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
-- Table structure for table `holdings`
--

DROP TABLE IF EXISTS `holdings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `holdings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `symbol` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(65,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`,`symbol`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `holdings`
--

LOCK TABLES `holdings` WRITE;
/*!40000 ALTER TABLE `holdings` DISABLE KEYS */;
INSERT INTO `holdings` VALUES (6,3,'GOOG',1026.11,2),(7,3,'MSFT',35.94,3),(17,17,'MSFT',36.64,12),(31,8,'S',6.91,15);
/*!40000 ALTER TABLE `holdings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `transaction_type` enum('BUY','SELL') COLLATE utf8_unicode_ci NOT NULL,
  `symbol` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(65,2) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,8,'BUY','GOOG',4,1026.00,'2013-11-05 07:08:07'),(2,8,'BUY','XLE',6,87.00,'2013-11-05 07:12:05'),(3,8,'BUY','XLE',3,87.00,'2013-11-05 07:13:32'),(4,8,'BUY','AAPL',1,527.00,'2013-11-05 07:17:16'),(5,8,'BUY','AAPL',1,527.00,'2013-11-05 07:18:32'),(6,8,'BUY','AAPL',1,527.00,'2013-11-05 07:18:55'),(7,8,'BUY','AAPL',1,527.00,'2013-11-05 07:20:27'),(8,8,'BUY','AAPL',1,527.00,'2013-11-05 07:21:29'),(9,8,'BUY','AAPL',1,527.00,'2013-11-05 07:22:31'),(10,8,'BUY','XLE',1,87.00,'2013-11-05 07:24:44'),(11,8,'BUY','XLE',10,87.00,'2013-11-05 07:31:48'),(12,3,'BUY','GOOG',2,1026.11,'2013-11-05 13:08:57'),(13,3,'BUY','MSFT',1,35.94,'2013-11-05 13:14:30'),(14,3,'BUY','MSFT',2,35.94,'2013-11-05 13:15:12'),(15,8,'BUY','AAPL',2,525.45,'2013-11-06 08:02:13'),(16,8,'BUY','XLE',10,86.36,'2013-11-06 08:12:01'),(17,8,'BUY','T',5,35.53,'2013-11-06 08:15:46'),(18,8,'BUY','TSLA',5,176.81,'2013-11-06 08:20:44'),(19,8,'BUY','AAPL',2,525.45,'2013-11-06 08:23:22'),(20,8,'BUY','TM',5,128.59,'2013-11-06 08:24:10'),(21,8,'SELL','TM',5,128.59,'2013-11-06 08:26:14'),(22,8,'BUY','AAPL',5,525.45,'2013-11-06 08:27:37'),(23,8,'BUY','IBM',2,177.85,'2013-11-06 08:27:51'),(24,8,'SELL','AAPL',5,525.45,'2013-11-06 08:28:33'),(25,8,'BUY','TSLA',12,176.81,'2013-11-06 08:29:07'),(26,8,'BUY','IBM',5,177.85,'2013-11-06 08:29:53'),(27,8,'BUY','GOOG',1,1021.52,'2013-11-06 08:30:31'),(28,8,'SELL','TSLA',17,176.81,'2013-11-06 08:30:48'),(29,17,'BUY','MSFT',12,36.64,'2013-11-06 08:34:38'),(30,8,'BUY','TSLA',5,176.81,'2013-11-06 12:43:17'),(31,8,'BUY','GOOG',3,1018.27,'2013-11-06 18:11:15'),(32,8,'BUY','GOOG',1,1018.27,'2013-11-06 18:11:28'),(33,8,'BUY','GOOG',1,1022.75,'2013-11-06 23:59:31'),(34,8,'BUY','AAPL',1,520.92,'2013-11-07 00:49:19'),(35,18,'BUY','AAPL',5,520.92,'2013-11-07 01:02:18'),(36,18,'SELL','AAPL',5,520.92,'2013-11-07 01:02:41'),(37,18,'BUY','AAPL',5,512.49,'2013-11-08 00:44:24'),(38,18,'SELL','AAPL',5,512.49,'2013-11-08 00:44:39'),(39,18,'BUY','AAPL',6,512.49,'2013-11-08 00:45:28'),(40,18,'SELL','AAPL',6,512.49,'2013-11-08 00:45:35'),(41,19,'BUY','XLE',10,85.28,'2013-11-08 03:40:48'),(42,19,'SELL','XLE',10,85.28,'2013-11-08 03:41:10'),(43,19,'BUY','TSLA',5,139.77,'2013-11-08 03:41:29'),(44,19,'BUY','S',5,6.99,'2013-11-08 03:43:17'),(45,19,'BUY','MSFT',8,37.50,'2013-11-08 03:44:11'),(46,19,'SELL','MSFT',8,37.50,'2013-11-08 03:44:22'),(47,19,'BUY','AAPL',2,512.49,'2013-11-08 03:44:56'),(48,19,'BUY','GOOG',2,1007.95,'2013-11-08 03:45:03'),(49,19,'BUY','F',25,16.55,'2013-11-08 03:45:35'),(50,19,'SELL','GOOG',2,1007.95,'2013-11-08 03:46:07'),(51,19,'SELL','F',25,16.55,'2013-11-08 03:46:20'),(52,19,'SELL','AAPL',2,512.49,'2013-11-08 03:46:38'),(53,8,'BUY','AAPL',5,519.50,'2013-11-08 16:44:57'),(54,8,'BUY','S',15,6.91,'2013-11-08 16:45:05'),(55,8,'SELL','AAPL',5,519.49,'2013-11-08 16:46:20');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cash` decimal(65,4) NOT NULL DEFAULT '10000.0000',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'caesar','$1$50$GHABNWBNE/o4VL7QjmQ6x0',10000.0000),(2,'hirschhorn','$1$50$lJS9HiGK6sphej8c4bnbX.',10000.0000),(3,'jharvard','$1$50$RX3wnAMNrGIbgzbRYrxM1/',7839.9680),(4,'malan','$1$HA$azTGIMVlmPi9W9Y12cYSj/',10000.0000),(5,'milo','$1$HA$6DHumQaK4GhpX8QE23C8V1',10000.0000),(6,'skroob','$1$50$euBi4ugiJmbpIbvTTfmfI.',10000.0000),(7,'zamyla','$1$50$uwfqB45ANW.9.6qaQ.DcF.',10000.0000),(8,'lrosselli','$1$LIXSJy8K$v270w2kzc4JJCpX1a1BtB1',11794.5050),(17,'lrosselli2','$1$UZ5D3TT8$ugWfIXCvSeQOvZhra.Vtp.',9560.3200),(18,'emm','$1$zi2Xh9vk$u21fkmcvAcGwudX9SDFcg0',10000.0000),(19,'auggie','$1$Cdj4fHCA$UZDtF1DKngKXZAvaLqe8G1',16000.0000),(20,'su$sie','$1$qayuADik$IIOTIjWx1EL6Afe3h0KBF1',10000.0000);
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

-- Dump completed on 2013-11-08 11:48:14
