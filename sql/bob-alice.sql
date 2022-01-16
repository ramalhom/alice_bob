CREATE DATABASE  IF NOT EXISTS `alicebob_game` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `alicebob_game`;
-- MySQL dump 10.13  Distrib 8.0.21, for Win64 (x86_64)
--
-- Host: localhost    Database: alicebob_game
-- ------------------------------------------------------
-- Server version	8.0.21

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
-- Table structure for table `t_form`
--

DROP TABLE IF EXISTS `t_form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_form` (
  `pk_form` int NOT NULL AUTO_INCREMENT,
  `form_url` varchar(200) DEFAULT NULL,
  `fk_session` int DEFAULT NULL,
  PRIMARY KEY (`pk_form`),
  KEY `fk_session_idx` (`fk_session`),
  CONSTRAINT `fk_session` FOREIGN KEY (`fk_session`) REFERENCES `t_game` (`session`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_form`
--

LOCK TABLES `t_form` WRITE;
/*!40000 ALTER TABLE `t_form` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_game`
--

DROP TABLE IF EXISTS `t_game`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_game` (
  `pk_game` int NOT NULL AUTO_INCREMENT,
  `session` int DEFAULT NULL,
  PRIMARY KEY (`pk_game`),
  UNIQUE KEY `session_UNIQUE` (`session`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_game`
--

LOCK TABLES `t_game` WRITE;
/*!40000 ALTER TABLE `t_game` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_game` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_message`
--

DROP TABLE IF EXISTS `t_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_message` (
  `pk_message` int NOT NULL AUTO_INCREMENT,
  `step` int DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `private_key` int DEFAULT NULL,
  `public_key` int DEFAULT NULL,
  `crypted_with` varchar(45) DEFAULT NULL,
  `fk_user` int DEFAULT NULL,
  `fk_game` int DEFAULT NULL,
  PRIMARY KEY (`pk_message`),
  KEY `fk_user_idx` (`fk_user`),
  KEY `fk_game_idx` (`fk_game`),
  CONSTRAINT `fk_game` FOREIGN KEY (`fk_game`) REFERENCES `t_game` (`pk_game`),
  CONSTRAINT `fk_user` FOREIGN KEY (`fk_user`) REFERENCES `t_user` (`pk_user`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_message`
--

LOCK TABLES `t_message` WRITE;
/*!40000 ALTER TABLE `t_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_user`
--

DROP TABLE IF EXISTS `t_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_user` (
  `pk_user` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `icon` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`pk_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_user`
--

LOCK TABLES `t_user` WRITE;
/*!40000 ALTER TABLE `t_user` DISABLE KEYS */;
INSERT INTO `t_user` VALUES (1,'Alice','alice.png'),(2,'Bob','bob.png'),(3,'Eve','eve.png'),(4,'Trudi','trudi.png');
/*!40000 ALTER TABLE `t_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-10-21 10:41:32
