-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: formulario
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `artista`
--

DROP TABLE IF EXISTS `artista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `artista` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_fantasia` varchar(45) NOT NULL,
  `cnpj` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `email` varchar(110) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `genero_music` varchar(45) NOT NULL DEFAULT 'Sem declarar',
  `data_formacao` date NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `endereco` varchar(110) NOT NULL,
  `tipo_usuario` varchar(45) NOT NULL DEFAULT 'artista',
  `foto_perfil` longblob DEFAULT NULL,
  `artistacol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artista`
--

LOCK TABLES `artista` WRITE;
/*!40000 ALTER TABLE `artista` DISABLE KEYS */;
INSERT INTO `artista` VALUES (1,'','123','123','123','123','123','1998-04-08','123','123','123','usuario',NULL,NULL),(2,'','12','12','12','12','12','1998-04-08','12','12','12','usuario',NULL,NULL),(3,'','12','12','12','12','12','1998-04-08','12','12','12','usuario',NULL,NULL),(4,'','art','art','art','art','art','0198-12-04','art','art','art','usuario',NULL,NULL),(5,'','qwer','qwer','qwer','qwer','qwer','1998-04-08','qwer','qwer','qwer','usuario',NULL,NULL),(6,'','1234','1234','1234','1234','1234','0000-00-00','1234','1234','1234','artista',NULL,NULL),(7,'','1234','1234','1234','1234','1234','1998-04-08','1234','1234','1234','artista',NULL,NULL),(8,'','123','123','123','123','123','1998-04-08','123','123','123','artista',NULL,NULL),(9,'','12346','12346','12346','12346','12346','1998-04-08','12346','12346','12346','artista',NULL,NULL),(10,'','alice','alice','alice','alice','alice','1111-11-11','alice','alice','alice','artista',NULL,NULL),(11,'','a','a','a','a','a','1998-04-08','a','a','a','artista',NULL,NULL),(12,'','alituria','alituria','alituria','alituria','alituria','1998-04-08','alituria','alituria','alituria','artista',NULL,NULL),(13,'Rubens','aaaaaa','akali','akali','8540028922','rock pesado','1998-04-08','Fortaleza','Ceará','Rua general sampaio, 354','artista',_binary 'uploads/perfil/6759ee436d5b6_rockriderlogo.png',NULL);
/*!40000 ALTER TABLE `artista` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-11 17:06:28
