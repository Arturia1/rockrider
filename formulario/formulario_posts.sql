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
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `conteudo` text NOT NULL,
  `foto` longblob DEFAULT NULL,
  `data_postagem` timestamp NOT NULL DEFAULT current_timestamp(),
  `tipo_usuario` enum('usuario','artista') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,13,'oieeeeee',_binary 'uploads/','2024-12-11 01:58:59','usuario'),(2,7,'aaaaaaaaaa',_binary 'uploads/','2024-12-11 08:51:54','usuario'),(3,7,'teste imagem',_binary 'uploads/rockriderlogo.png','2024-12-11 08:52:24','usuario'),(5,13,'oi',_binary 'uploads/','2024-12-11 12:04:44','artista'),(6,13,'oi',_binary 'uploads/','2024-12-11 12:06:19','artista'),(7,13,'oieee',_binary 'uploads/','2024-12-11 12:10:58','artista'),(8,13,'oi',_binary 'uploads/','2024-12-11 12:44:19','usuario'),(9,13,'oi',_binary 'uploads/','2024-12-11 12:47:20','usuario'),(10,13,'oi',_binary 'uploads/','2024-12-11 12:50:38','usuario'),(11,13,'oi',_binary 'uploads/','2024-12-11 12:52:21','usuario'),(12,13,'oi',_binary 'uploads/rockriderlogo.png','2024-12-11 12:52:55','usuario'),(13,13,'asasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassa',_binary 'uploads/','2024-12-11 12:53:22','usuario'),(14,13,'asasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassaasasssassa',_binary 'uploads/','2024-12-11 12:57:46','usuario'),(15,13,'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',_binary 'uploads/','2024-12-11 12:58:34','usuario'),(16,13,'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',_binary 'uploads/','2024-12-11 13:00:53','usuario'),(17,13,'teste',_binary 'uploads/','2024-12-11 13:01:05','usuario'),(18,13,'alou tudo?\r\n',_binary 'uploads/','2024-12-11 13:01:35','artista'),(19,13,'alou tudo?\r\n',_binary 'uploads/','2024-12-11 13:07:16','artista'),(20,13,'alou tudo?\r\n',_binary 'uploads/','2024-12-11 13:09:14','artista'),(21,13,'wew',_binary 'uploads/bossinv.png','2024-12-11 13:09:50','artista'),(22,13,'wew',_binary 'uploads/bossinv.png','2024-12-11 13:16:05','artista'),(23,13,'wew',_binary 'uploads/bossinv.png','2024-12-11 13:21:53','artista'),(24,13,'opa',_binary 'uploads/','2024-12-11 13:43:45','artista'),(25,13,'opa',_binary 'uploads/','2024-12-11 13:47:14','artista'),(26,13,'oi',_binary 'uploads/','2024-12-11 13:47:17','artista'),(27,13,'oi',_binary 'uploads/','2024-12-11 13:48:26','artista'),(28,13,'oiiii',_binary 'uploads/rockriderlogo.png','2024-12-11 13:48:44','artista'),(29,13,'oiiii',_binary 'uploads/rockriderlogo.png','2024-12-11 13:49:40','artista'),(30,13,'eu me chamo Arturia',_binary 'uploads/','2024-12-11 16:52:19','usuario'),(31,13,'teste',_binary 'uploads/My_PDF.png','2024-12-11 16:52:35','usuario'),(32,13,'oi',_binary 'uploads/','2024-12-11 16:56:25','artista'),(33,13,'oi',_binary 'uploads/','2024-12-11 16:58:31','artista'),(34,13,'oi',_binary 'uploads/','2024-12-11 17:00:07','artista'),(35,13,'Teste final',_binary 'uploads/noun-thinking-6470253.png','2024-12-11 17:14:36','artista');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-11 17:06:27
