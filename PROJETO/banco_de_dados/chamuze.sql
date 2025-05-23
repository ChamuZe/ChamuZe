-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: chamuze
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
-- Table structure for table `endereco`
--

DROP TABLE IF EXISTS `endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `endereco` (
  `id_endereco` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `bairro` varchar(150) NOT NULL,
  `logradouro` varchar(150) NOT NULL,
  `numero_casa` int(11) NOT NULL,
  `cep` varchar(50) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_endereco`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `endereco_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `endereco`
--

LOCK TABLES `endereco` WRITE;
/*!40000 ALTER TABLE `endereco` DISABLE KEYS */;
/*!40000 ALTER TABLE `endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagamento`
--

DROP TABLE IF EXISTS `pagamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pagamento` (
  `id_pagamento` int(11) NOT NULL AUTO_INCREMENT,
  `data_pagamento` date NOT NULL,
  `status_pagamento` enum('pago','pendente') NOT NULL,
  `valor_pagamento` decimal(10,2) NOT NULL,
  `id_solicitante` int(11) DEFAULT NULL,
  `id_prestador` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pagamento`),
  KEY `id_solicitante` (`id_solicitante`),
  KEY `id_prestador` (`id_prestador`),
  CONSTRAINT `pagamento_ibfk_1` FOREIGN KEY (`id_solicitante`) REFERENCES `solicitante` (`id_solicitante`),
  CONSTRAINT `pagamento_ibfk_2` FOREIGN KEY (`id_prestador`) REFERENCES `prestador` (`id_prestador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagamento`
--

LOCK TABLES `pagamento` WRITE;
/*!40000 ALTER TABLE `pagamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `pagamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prestador`
--

DROP TABLE IF EXISTS `prestador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prestador` (
  `id_prestador` int(11) NOT NULL,
  `cnpj` varchar(14) NOT NULL,
  `img_rg` varchar(255) NOT NULL,
  `chave_pix` varchar(100) NOT NULL,
  `status_avaliacao` enum('aprovado','naoverificado') NOT NULL,
  PRIMARY KEY (`id_prestador`),
  CONSTRAINT `prestador_ibfk_1` FOREIGN KEY (`id_prestador`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prestador`
--

LOCK TABLES `prestador` WRITE;
/*!40000 ALTER TABLE `prestador` DISABLE KEYS */;
INSERT INTO `prestador` VALUES (2,'12345678000199','prestador_rg.jpg','prestador_pix@bank.com','aprovado'),(4,'12345678000199','prestador2_rg.jpg','prestador2_pix@bank.com','aprovado'),(11,'34352353453453','../uploads/rg/680a2481eb5d1.jpg','123','aprovado'),(14,'34352353453453','../uploads/rg/680a50cf39ac9.jpg','123','aprovado'),(15,'34352353453453','../uploads/rg/680a84cadef30.jpg','123','aprovado'),(22,'34352353453489','../uploads/rg/680b6999df0be.png','123','aprovado'),(24,'34352353453453','../uploads/rg/680b6c6485437.png','in23ug9d3g','naoverificado'),(26,'12345678123567','../uploads/rg/680b74058807a.png','12345678','aprovado');
/*!40000 ALTER TABLE `prestador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proposta`
--

DROP TABLE IF EXISTS `proposta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proposta` (
  `id_proposta` int(11) NOT NULL AUTO_INCREMENT,
  `id_servico` int(11) NOT NULL,
  `id_prestador` int(11) DEFAULT NULL,
  `id_solicitante` int(11) DEFAULT NULL,
  `valor_proposta` decimal(10,2) NOT NULL,
  `justificativa` text NOT NULL,
  PRIMARY KEY (`id_proposta`),
  KEY `id_solicitante` (`id_solicitante`),
  KEY `id_prestador` (`id_prestador`),
  KEY `id_servico` (`id_servico`),
  CONSTRAINT `id_servico` FOREIGN KEY (`id_servico`) REFERENCES `servico` (`id_servico`) ON DELETE CASCADE,
  CONSTRAINT `proposta_ibfk_1` FOREIGN KEY (`id_servico`) REFERENCES `servico` (`id_servico`),
  CONSTRAINT `proposta_ibfk_2` FOREIGN KEY (`id_solicitante`) REFERENCES `solicitante` (`id_solicitante`),
  CONSTRAINT `proposta_ibfk_3` FOREIGN KEY (`id_prestador`) REFERENCES `prestador` (`id_prestador`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proposta`
--

LOCK TABLES `proposta` WRITE;
/*!40000 ALTER TABLE `proposta` DISABLE KEYS */;
INSERT INTO `proposta` VALUES (20,6,4,3,90.00,'Por conta dos curos adicionais preciso cobrar 15 reais acima do valor proprorto por você.'),(23,7,4,3,100.00,'Por conta dos curos adicionais preciso cobrar 15 reais acima do valor proprorto por você.'),(26,9,11,5,250.00,'Muito longe de onde moro'),(27,10,11,3,234.00,'21w'),(28,14,26,25,120.00,'muito baixo');
/*!40000 ALTER TABLE `proposta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servico`
--

DROP TABLE IF EXISTS `servico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servico` (
  `id_servico` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` text NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `img_servico` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `status_servico` enum('disponivel','aceito') DEFAULT 'disponivel',
  `local_servico` varchar(100) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `id_solicitante` int(11) DEFAULT NULL,
  `id_prestador` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_servico`),
  KEY `id_solicitante` (`id_solicitante`),
  KEY `id_prestador` (`id_prestador`),
  CONSTRAINT `servico_ibfk_1` FOREIGN KEY (`id_solicitante`) REFERENCES `solicitante` (`id_solicitante`),
  CONSTRAINT `servico_ibfk_2` FOREIGN KEY (`id_prestador`) REFERENCES `prestador` (`id_prestador`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servico`
--

LOCK TABLES `servico` WRITE;
/*!40000 ALTER TABLE `servico` DISABLE KEYS */;
INSERT INTO `servico` VALUES (6,'cdvukvucvavcab','Conserto de texxAAlhado','../uploads/servicosimg_680a280d14e3a.jpg','encanamento','aceito','abranches',50.00,3,4),(7,'deeae','Blá Blá Blá Blá','../uploads/servicos/67f7b4eccb783.jpg','encanamento','aceito','abranches',123.00,3,4),(9,'Conserto de telhado','Conserto de telhado','../uploads/servicos/680a23ed66574.jpg','construcao','aceito','cachoeira',234.00,5,11),(10,'Corte de GramaCorte de GramaCorte de Grama','Corte de GramaCorte de Grama','../uploads/servicos/680a4fa106e17.jpg','encanamento','aceito','boqueirao',50.00,3,26),(12,'Preciso cortar minha grama, pois está bem alta.\r\nMinha disponibilidade é na sexta-feira 25/04/2025 13:00','Corte de Grama','../uploads/servicos/680b60d74d8e4.jpg','jardinagem','disponivel','butiatuvinha',89.00,21,NULL),(14,'asd','Corte de Grama rosa MODIFICADO Novamente','../uploads/servicos/680b737d4fec5.jpg','construcao','aceito','abranches',100.00,25,26);
/*!40000 ALTER TABLE `servico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitante`
--

DROP TABLE IF EXISTS `solicitante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `solicitante` (
  `id_solicitante` int(11) NOT NULL,
  PRIMARY KEY (`id_solicitante`),
  CONSTRAINT `solicitante_ibfk_1` FOREIGN KEY (`id_solicitante`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitante`
--

LOCK TABLES `solicitante` WRITE;
/*!40000 ALTER TABLE `solicitante` DISABLE KEYS */;
INSERT INTO `solicitante` VALUES (3),(5),(19),(21),(25);
/*!40000 ALTER TABLE `solicitante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `telefone` varchar(30) NOT NULL,
  `nacionalidade` varchar(50) NOT NULL,
  `data_nascimento` date NOT NULL,
  `nota_reputacao` decimal(3,2) NOT NULL,
  `genero` enum('F','M','O') NOT NULL,
  `tipo_perfil` enum('administrador','prestador','solicitante') NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Administrador','Teste','admin@teste.com','$2y$10$iJsLDgYFSEG6vrb6GidjB.OYPTS1EDOZGPr.7/KJYG8LE0diZyT1e','00000000001','11999990001','Brasileiro','1990-01-01',5.00,'O','administrador'),(2,'Prestador','Teste','prestador@teste.com','$2y$10$iJsLDgYFSEG6vrb6GidjB.OYPTS1EDOZGPr.7/KJYG8LE0diZyT1e','00000000002','11999990002','Brasileiro','1992-02-02',4.50,'M','prestador'),(3,'Solicitante','Teste','solicitante@teste.com','$2y$10$iJsLDgYFSEG6vrb6GidjB.OYPTS1EDOZGPr.7/KJYG8LE0diZyT1e','00000000003','11999990003','Brasileiro','1995-03-03',4.80,'F','solicitante'),(4,'Prestador2','Teste2','prestador2@teste.com','$2y$10$iJsLDgYFSEG6vrb6GidjB.OYPTS1EDOZGPr.7/KJYG8LE0diZyT1e','00000000002','11999990002','Brasileiro','1992-02-02',0.00,'M','prestador'),(5,'Juliana','Solicitante','julianas@gmail.com','$2y$10$xWv5iiOKfTtRoFjpyeY8q.dhND2soAkZ8b/.sVuKOMDRds6mAlnNG','12345678910','Brasileiro','4199999999','2006-02-17',0.00,'F','solicitante'),(6,'João','Silva','joao.silva@email.com','$2y$10$xWv5iiOKfTtRoFjpyeY8q.dhND2soAkZ8b/.sVuKOMDRds6mAlnNG','12345678901','999999999','Brasileiro','1990-05-15',4.50,'M','prestador'),(11,'Juliana','pp','prestador@gmail.com','$2y$10$f9LKzai0BY67uzzyY4Dk2OGfUR4NA6.ZNs8gztn5FMXGgQXxjzp7S','14923829917','Brasileiro','41999999999','0123-03-12',0.00,'F','prestador'),(14,'prestador3@teste.com','prestador3@teste.com','prestador3@teste.com','$2y$10$r1/cRtPooq2oT/heyP5/AeXaODIipYaTrPxiEDpkW3QXgkM255lwy','14905829917','Brasileiro','4199999999','1908-03-23',0.00,'F','prestador'),(15,'solicitante@teste2.com','solicitante@teste2.com','solicitante@teste2.com','$2y$10$/TKWO/stXjb43LDdCw6K6u5obEdIsa7etYvlTJ.R2XW2iKEtIgE6m','14905829917','Brasileiro','4199999999','2009-03-12',0.00,'M','prestador'),(19,'Juliana','Teste','solicitante@gmail.com','$2y$10$Mpb2Z5Uey2kSv9iiffOY7uytv4aayZLQHaMjaaKpzhsWTkr5AegzO','12345678910','Brasileiro','41999999999','1009-03-31',0.00,'M','solicitante'),(21,'Juliana','Aparecida','julianasolicitante@gmail.com','$2y$10$vDQ9xqJsc19IwMtRZkZLPu89r1IdY5KYTQ2l5ZFC4XE/klYFGGohm','12345678910','Brasileiro','41999999999','2006-02-17',0.00,'F','solicitante'),(22,'Roberto','Silva','robertosilva@gmail.com','$2y$10$6FjaDKUjUpaCUbXoLPqPNOWqqqnsE6O6OazgN.IJfcncnGzY.nEmq','12345678914','Brasileiro','41993452342','1970-03-23',0.00,'F','prestador'),(24,'Julia','Aparecida','juliaaparecida@gmail.com','$2y$10$Rqipe/DjViu7hmCq02XWb.uH.1U15vAP0oNWgaN2VXxzt9ad2eHFS','14905829917','Brasileiro','41999999999','1989-03-04',0.00,'F','prestador'),(25,'Rafael','Souza','rafael@teste.com','$2y$10$C8OmiEZI6BVzu24F0oHiUOnGX6EI/XMLmbnq/z7SwgiYXzrnECbXq','14905829917','Brasileiro','41999999999','2000-02-12',0.00,'M','solicitante'),(26,'Caio','Caio','caio@gmail.com','$2y$10$T4viqQKdnjjOHOrYvxAz3.1HbY0v7uT9rpLOsYX9wzTU4I2hGbjmW','12345612345','Brasileiro','41999999999','1999-03-12',0.00,'M','prestador');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-25 10:50:20
