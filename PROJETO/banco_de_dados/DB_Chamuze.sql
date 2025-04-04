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
-- Table structure for table `administrador`
--

DROP TABLE IF EXISTS `administrador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administrador` (
  `id_administrador` int(11) NOT NULL,
  PRIMARY KEY (`id_administrador`),
  CONSTRAINT `administrador_ibfk_1` FOREIGN KEY (`id_administrador`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrador`
--

LOCK TABLES `administrador` WRITE;
/*!40000 ALTER TABLE `administrador` DISABLE KEYS */;
/*!40000 ALTER TABLE `administrador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `administrador_prestador`
--

DROP TABLE IF EXISTS `administrador_prestador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administrador_prestador` (
  `id_administrador` int(11) NOT NULL,
  `id_prestador` int(11) NOT NULL,
  PRIMARY KEY (`id_administrador`,`id_prestador`),
  KEY `id_prestador` (`id_prestador`),
  CONSTRAINT `administrador_prestador_ibfk_1` FOREIGN KEY (`id_administrador`) REFERENCES `administrador` (`id_administrador`),
  CONSTRAINT `administrador_prestador_ibfk_2` FOREIGN KEY (`id_prestador`) REFERENCES `prestador` (`id_prestador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrador_prestador`
--

LOCK TABLES `administrador_prestador` WRITE;
/*!40000 ALTER TABLE `administrador_prestador` DISABLE KEYS */;
/*!40000 ALTER TABLE `administrador_prestador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `administrador_solicitante`
--

DROP TABLE IF EXISTS `administrador_solicitante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administrador_solicitante` (
  `id_administrador` int(11) NOT NULL,
  `id_solicitante` int(11) NOT NULL,
  PRIMARY KEY (`id_administrador`,`id_solicitante`),
  KEY `id_solicitante` (`id_solicitante`),
  CONSTRAINT `administrador_solicitante_ibfk_1` FOREIGN KEY (`id_administrador`) REFERENCES `administrador` (`id_administrador`),
  CONSTRAINT `administrador_solicitante_ibfk_2` FOREIGN KEY (`id_solicitante`) REFERENCES `solicitante` (`id_solicitante`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrador_solicitante`
--

LOCK TABLES `administrador_solicitante` WRITE;
/*!40000 ALTER TABLE `administrador_solicitante` DISABLE KEYS */;
/*!40000 ALTER TABLE `administrador_solicitante` ENABLE KEYS */;
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
  `cpf` varchar(11) NOT NULL,
  `img_rg` varchar(255) NOT NULL,
  `chave_pix` varchar(100) NOT NULL,
  `status_avaliacao` enum('aprovado','reprovado') NOT NULL,
  PRIMARY KEY (`id_prestador`),
  CONSTRAINT `prestador_ibfk_1` FOREIGN KEY (`id_prestador`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prestador`
--

LOCK TABLES `prestador` WRITE;
/*!40000 ALTER TABLE `prestador` DISABLE KEYS */;
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
  `valor` float NOT NULL,
  `mensagem` text NOT NULL,
  `id_solicitante` int(11) DEFAULT NULL,
  `id_prestador` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_proposta`),
  KEY `id_servico` (`id_servico`),
  KEY `id_solicitante` (`id_solicitante`),
  KEY `id_prestador` (`id_prestador`),
  CONSTRAINT `proposta_ibfk_1` FOREIGN KEY (`id_servico`) REFERENCES `servico` (`id_servico`),
  CONSTRAINT `proposta_ibfk_2` FOREIGN KEY (`id_solicitante`) REFERENCES `solicitante` (`id_solicitante`),
  CONSTRAINT `proposta_ibfk_3` FOREIGN KEY (`id_prestador`) REFERENCES `prestador` (`id_prestador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proposta`
--

LOCK TABLES `proposta` WRITE;
/*!40000 ALTER TABLE `proposta` DISABLE KEYS */;
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
  `status_servico` enum('aceito','disponivel') NOT NULL,
  `regiao` varchar(100) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `id_solicitante` int(11) DEFAULT NULL,
  `id_prestador` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_servico`),
  KEY `id_solicitante` (`id_solicitante`),
  KEY `id_prestador` (`id_prestador`),
  CONSTRAINT `servico_ibfk_1` FOREIGN KEY (`id_solicitante`) REFERENCES `solicitante` (`id_solicitante`),
  CONSTRAINT `servico_ibfk_2` FOREIGN KEY (`id_prestador`) REFERENCES `prestador` (`id_prestador`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servico`
--

LOCK TABLES `servico` WRITE;
/*!40000 ALTER TABLE `servico` DISABLE KEYS */;
INSERT INTO `servico` VALUES (1,'Corte de Grama','Corte de Grama','../uploads/servicos/67eede8cdc7db.jpg','jardinagem','aceito','alto_boqueirao',75.00,NULL,NULL),(2,'header(\"Location: ../solicitante/solicitarServico.php?erro=2\");//Erro 2: Erro ao salvar no Banco','Corte de Grama','../uploads/servicos/67eee1b0c52e0.jpg','encanamento','aceito','bacacheri',20.00,NULL,NULL),(3,'Corte de Grama 2','Corte de Grama','../uploads/servicos/67eee1e9019ef.pdf','jardinagem','aceito','bacacheri',50.00,NULL,NULL),(4,'Corte de Grama','Corte de Grama','../uploads/servicos/67eee241b5e1e.drawio','encanamento','aceito','augusta',23.00,NULL,NULL),(5,'Conserto de telhado','Conserto de telhado','../uploads/servicos/67eee3a7b630c.jpg','construcao','aceito','lamenha_pequena',100.00,NULL,NULL),(6,'Corte de Grama','1','boqueirao','Corte de Grama','aceito','jardinagem',0.00,NULL,NULL),(8,'Preciso de alguém para cortar a minha grama!','Corte de Grama','../uploads/servicos/67eee5f067590.jpg','jardinagem','aceito','alto_boqueirao',15.00,1,NULL),(9,'Conserto de telhado','Conserto de telhado','../uploads/servicos/67eee6e498378.jpg','construcao','aceito','cachoeira',450.00,1,NULL);
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
INSERT INTO `solicitante` VALUES (1);
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
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nota_reputacao` decimal(3,2) NOT NULL,
  `tipo_perfil` enum('administrador','prestador','solicitante') NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Solicitante','solicitante@gmail.com','$2y$10$iJsLDgYFSEG6vrb6GidjB.OYPTS1EDOZGPr.7/KJYG8LE0diZyT1e',0.00,'solicitante'),(2,'Prestador','prestador@gmail.com','$2y$10$iJsLDgYFSEG6vrb6GidjB.OYPTS1EDOZGPr.7/KJYG8LE0diZyT1e',0.00,'prestador'),(3,'Administrador','administrador@gmail.com','$2y$10$iJsLDgYFSEG6vrb6GidjB.OYPTS1EDOZGPr.7/KJYG8LE0diZyT1e',0.00,'administrador');
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

-- Dump completed on 2025-04-03 20:11:31
