CREATE DATABASE  IF NOT EXISTS `3heads` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `3heads`;
-- MySQL dump 10.13  Distrib 5.5.46, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: 3heads
-- ------------------------------------------------------
-- Server version	5.6.27-0ubuntu0.14.04.1

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
-- Table structure for table `banner`
--

DROP TABLE IF EXISTS `banner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banner` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `banner_categoria_id` int(10) unsigned NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `link` varchar(45) DEFAULT NULL,
  `ativo` char(1) DEFAULT NULL,
  `descricao` text,
  PRIMARY KEY (`id`),
  KEY `fk_banner_1_idx` (`banner_categoria_id`),
  CONSTRAINT `fk_banner_1` FOREIGN KEY (`banner_categoria_id`) REFERENCES `banner_categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banner`
--

LOCK TABLES `banner` WRITE;
/*!40000 ALTER TABLE `banner` DISABLE KEYS */;
INSERT INTO `banner` VALUES (53,1,'Banner Topo','Banner Topo','S','<p>Banner Topo</p>\r\n');
/*!40000 ALTER TABLE `banner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banner_categoria`
--

DROP TABLE IF EXISTS `banner_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banner_categoria` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banner_categoria`
--

LOCK TABLES `banner_categoria` WRITE;
/*!40000 ALTER TABLE `banner_categoria` DISABLE KEYS */;
INSERT INTO `banner_categoria` VALUES (1,'TV1'),(2,'TV'),(3,'TV2');
/*!40000 ALTER TABLE `banner_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(11) unsigned NOT NULL,
  `razao_social` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cliente_pessoas1_idx` (`pessoa_id`),
  CONSTRAINT `fk_cliente_pessoas1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consulta`
--

DROP TABLE IF EXISTS `consulta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consulta` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) unsigned NOT NULL,
  `professor_id` int(11) unsigned NOT NULL,
  `consulta_id` int(11) unsigned DEFAULT NULL,
  `data` date DEFAULT NULL,
  `horario` timestamp NULL DEFAULT NULL,
  `tipo` char(1) DEFAULT NULL COMMENT 'M(Marcação)\nR(Remarcação)',
  `status` char(1) DEFAULT NULL COMMENT 'C(Cancelada)\n\n',
  PRIMARY KEY (`id`),
  KEY `fk_consultas_pacientes1_idx` (`paciente_id`),
  KEY `fk_consultas_professor1_idx` (`professor_id`),
  KEY `fk_consultas_consultas1_idx` (`consulta_id`),
  CONSTRAINT `fk_consultas_consultas1` FOREIGN KEY (`consulta_id`) REFERENCES `consulta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_consultas_pacientes1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_consultas_professor1` FOREIGN KEY (`professor_id`) REFERENCES `professor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consulta`
--

LOCK TABLES `consulta` WRITE;
/*!40000 ALTER TABLE `consulta` DISABLE KEYS */;
/*!40000 ALTER TABLE `consulta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conteudo`
--

DROP TABLE IF EXISTS `conteudo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conteudo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `conteudo_categoria_id` int(10) unsigned NOT NULL,
  `icone_bootstrap_id` int(10) unsigned NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `subtitulo` varchar(100) DEFAULT NULL,
  `descricao` text,
  `descricao_breve` varchar(100) DEFAULT NULL,
  `ordem` int(11) DEFAULT NULL,
  `ativo` char(1) DEFAULT NULL,
  `valor` double DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `cargo` varchar(45) DEFAULT NULL,
  `funcao` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_conteudo_1_idx` (`conteudo_categoria_id`),
  KEY `fk_conteudo_2_idx` (`icone_bootstrap_id`),
  CONSTRAINT `fk_conteudo_1` FOREIGN KEY (`conteudo_categoria_id`) REFERENCES `conteudo_categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conteudo`
--

LOCK TABLES `conteudo` WRITE;
/*!40000 ALTER TABLE `conteudo` DISABLE KEYS */;
INSERT INTO `conteudo` VALUES (1,1,0,'cora??oa','cora??oaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','<p>Esse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produto</p>\n','cora??oaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',0,'S',25,'','',''),(2,2,29,'Esse é meu serviço','Esse é meu serviçoEsse é meu serviço','<p>Esse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;o</p>\n','Esse é meu serviçoEsse é meu serviço',0,'S',26,'','',''),(3,3,0,'N?s somos o maior neg?cio do mundo criativo','teste quem ssomos','<p>Existem muitas varia&ccedil;&otilde;es dispon&iacute;veis de passagens de Lorem Ipsum,&nbsp;<br />\r\n&nbsp;mas a maioria sofreu algum tipo de altera&ccedil;&atilde;o, seja por inser&ccedil;&atilde;o&nbsp;<br />\r\nde passagens com humor, ou palavras aleat&oacute;rias que n&atilde;o parecem&nbsp;<br />\r\n&nbsp;nem um pouco convincentes. Se voc&ecirc; pretende usar uma passagem&nbsp;<br />\r\nde Lorem Ipsum, precisa ter certeza de que n&atilde;o h&aacute; algo embara&ccedil;oso&nbsp;<br />\r\n&nbsp;escrito escondido no meio do texto.&nbsp;</p>\r\n','teste quem ssomosteste quem ssomosteste quem ssomos',1,'S',33,'','',''),(5,2,40,'teste 2 servico','teste 2 servico','<p>teste 2 servico&nbsp;teste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servico</p>\n','teste 2 servico teste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 s',0,'S',33,'','',''),(7,4,0,'','','','',1,'S',0,'Alana Nunes da Silva','Analista','Desenvolvedor Web'),(8,4,0,'','','','',2,'S',0,'Anderson Fernando','Nó Cego','Nó Cego'),(9,4,0,'','','','',3,'S',0,'Joelson Bregaaaaaaaaaaaa','Comandante da Tropaaaaa','Pagodeiroaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'),(10,1,0,'testetsstetstste','testetsstetstste','<p>ffdfjdfjdfjsfdjsfdjsfjhfsj &nbsp;jhdjfgjgfjdg jdfjgsfgkdgfksgfkgdffdfjdfjdfjsfdjsfdjsfjhfsj &nbsp;jhdjfgjgfjdg jdfjgsfgkdgfksgfkgdffdfjdfjdfjsfdjsfdjsfjhfsj &nbsp;jhdjfgjgfjdg jdfjgsfgkdgfksgfkgdffdfjdfjdfjsfdjsfdjsfjhfsj &nbsp;jhdjfgjgfjdg jdfjgsfgkdgfksgfkgdffdfjdfjdfjsfdjsfdjsfjhfsj &nbsp;jhdjfgjgfjdg jdfjgsfgkdgfksgfkgd</p>\r\n','ffdfjdfjdfjsfdjsfdjsfjhfsj  jhdjfgjgfjdg jdfjgsfgkdgfksgfkgd',3,'S',25,'','',''),(11,1,0,'Juvenal Cara de Pau','Juvenal Cara de Pau','<p>Juvenal Cara de Pau&nbsp;Juvenal Cara de Pau&nbsp;Juvenal Cara de Pau&nbsp;Juvenal Cara de Pau</p>\r\n','Juvenal Cara de Pau Juvenal Cara de Pau Juvenal Cara de Pau',0,'S',33,'','',''),(12,5,0,'Parceiro 1','','','',0,'S',0,'','',''),(13,5,0,'Parceiro 2','','','',0,'S',0,'','',''),(14,5,0,'Parceiro 3','','','',0,'S',0,'','',''),(15,5,0,'Parceiro 4','','','',0,'S',0,'','',''),(16,6,0,'Cliente 1','Cliente 1','','Cliente 1',1,'S',0,'','',''),(17,6,0,'Cliente 2','Cliente 2','<p>Cliente 2Cliente 2Cliente 2</p>\r\n','Cliente 2',1,'S',0,'','',''),(18,6,0,'Cliente 3','Cliente 3','<p>Cliente 3Cliente 3Cliente 3Cliente 3Cliente 3</p>\r\n','Cliente 3',2,'S',0,'','',''),(19,6,0,'Cliente 4','Cliente 4','<p>Cliente 4</p>\r\n','Cliente 4',1,'S',0,'','',''),(20,6,0,'Cliente 5','Cliente 5','<p>Cliente 5</p>\r\n','Cliente 5',1,'S',0,'','',''),(21,7,0,'Portifolio 1','Portifolio 1','<p>Portifolio 1</p>\r\n','Portifolio 1',1,'S',0,'','',''),(22,7,0,'Portifolio 1','Portifolio 1','<p>Portifolio 1</p>\r\n','Portifolio 1',1,'S',0,'','',''),(23,7,0,'Portifolio 2','Portifolio 2','<p>Portifolio 1</p>\r\n','Portifolio 2',2,'S',0,'','',''),(24,7,0,'Portifolio 3','Portifolio 3','<p>Portifolio 2Portifolio 2</p>\r\n','Portifolio 3',3,'S',0,'','',''),(25,7,0,'Portifolio 4','Portifolio 4','<p>Portifolio 2Portifolio 2</p>\r\n','Portifolio 4',4,'S',0,'','',''),(26,2,32,'CoraÇão Serviço','teste sevi? novo','<p>teste sevi&ccedil; novoteste sevi&ccedil; novo</p>\n','teste sevi? novo',1,'S',0,'','',''),(27,1,0,'aaaaaaaaaa','aaaaaaaaaaaaaaaaaaaaa','<p>aaaaaaaaaaaaaaaaaaaaaaaaaa</p>\n','aaaaaaaaaaaaaaaaaaaaa',2,'S',0,'','',''),(28,5,0,'aaaaaaaaa','aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','<p>aaaaaaaaaaaaaaaaaaaaaaa</p>\n','aaaaaaaaaaaaaaaaaaaaaaaaaaaa',0,'S',0,'','','');
/*!40000 ALTER TABLE `conteudo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conteudo_categoria`
--

DROP TABLE IF EXISTS `conteudo_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conteudo_categoria` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conteudo_categoria`
--

LOCK TABLES `conteudo_categoria` WRITE;
/*!40000 ALTER TABLE `conteudo_categoria` DISABLE KEYS */;
INSERT INTO `conteudo_categoria` VALUES (1,'Produtos'),(2,'Serviços'),(3,'Quem Somos'),(4,'Equipe'),(5,'Parceiros'),(6,'Clientes'),(7,'Portifolio');
/*!40000 ALTER TABLE `conteudo_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fin_lancamento`
--

DROP TABLE IF EXISTS `fin_lancamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fin_lancamento` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(11) unsigned NOT NULL,
  `paciente_id` int(11) unsigned DEFAULT NULL,
  `consulta_id` int(11) unsigned DEFAULT NULL,
  `servico_id` int(11) unsigned DEFAULT NULL,
  `produto_id` int(11) unsigned DEFAULT NULL,
  `tipo` char(2) DEFAULT NULL COMMENT 'C (Credito)\nD (Debito)',
  `data_insercao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lancamentos_pessoas1_idx` (`pessoa_id`),
  KEY `fk_fin_lancamentos_pacientes1_idx` (`paciente_id`),
  KEY `fk_fin_lancamentos_consultas1_idx` (`consulta_id`),
  KEY `fk_fin_lancamentos_servicos1_idx` (`servico_id`),
  KEY `fk_fin_lancamentos_produtos1_idx` (`produto_id`),
  CONSTRAINT `fk_fin_lancamentos_consultas1` FOREIGN KEY (`consulta_id`) REFERENCES `consulta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_fin_lancamentos_pacientes1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_fin_lancamentos_produtos1` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_fin_lancamentos_servicos1` FOREIGN KEY (`servico_id`) REFERENCES `servico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lancamentos_pessoas1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fin_lancamento`
--

LOCK TABLES `fin_lancamento` WRITE;
/*!40000 ALTER TABLE `fin_lancamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `fin_lancamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fornecedor`
--

DROP TABLE IF EXISTS `fornecedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fornecedor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cliente_pessoa1_idx` (`pessoa_id`),
  CONSTRAINT `fk_cliente_pessoa11` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fornecedor`
--

LOCK TABLES `fornecedor` WRITE;
/*!40000 ALTER TABLE `fornecedor` DISABLE KEYS */;
/*!40000 ALTER TABLE `fornecedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `icone_bootstrap`
--

DROP TABLE IF EXISTS `icone_bootstrap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `icone_bootstrap` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `classe` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=latin1 COMMENT='Icones bootstrap';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `icone_bootstrap`
--

LOCK TABLES `icone_bootstrap` WRITE;
/*!40000 ALTER TABLE `icone_bootstrap` DISABLE KEYS */;
INSERT INTO `icone_bootstrap` VALUES (1,'glyphicon glyphicon-asterisk '),(2,'glyphicon glyphicon-plus '),(3,'glyphicon glyphicon-euro '),(4,'glyphicon glyphicon-minus '),(5,'glyphicon glyphicon-cloud '),(6,'glyphicon glyphicon-envelope '),(7,'glyphicon glyphicon-pencil '),(8,'glyphicon glyphicon-glass '),(9,'glyphicon glyphicon-music '),(10,'glyphicon glyphicon-search '),(11,'glyphicon glyphicon-heart '),(12,'glyphicon glyphicon-star '),(13,'glyphicon glyphicon-star-empty '),(14,'glyphicon glyphicon-user '),(15,'glyphicon glyphicon-film '),(16,'glyphicon glyphicon-th-large '),(17,'glyphicon glyphicon-th '),(18,'glyphicon glyphicon-th-list '),(19,'glyphicon glyphicon-ok '),(20,'glyphicon glyphicon-remove '),(21,'glyphicon glyphicon-zoom-in '),(22,'glyphicon glyphicon-zoom-out '),(23,'glyphicon glyphicon-off '),(24,'glyphicon glyphicon-signal '),(25,'glyphicon glyphicon-cog '),(26,'glyphicon glyphicon-trash '),(27,'glyphicon glyphicon-home '),(28,'glyphicon glyphicon-file '),(29,'glyphicon glyphicon-time '),(30,'glyphicon glyphicon-road '),(31,'glyphicon glyphicon-download-alt '),(32,'glyphicon glyphicon-download '),(33,'glyphicon glyphicon-upload '),(34,'glyphicon glyphicon-inbox '),(35,'glyphicon glyphicon-play-circle '),(36,'glyphicon glyphicon-repeat '),(37,'glyphicon glyphicon-refresh '),(38,'glyphicon glyphicon-list-alt '),(39,'glyphicon glyphicon-lock '),(40,'glyphicon glyphicon-flag '),(41,'glyphicon glyphicon-headphones '),(42,'glyphicon glyphicon-volume-off '),(43,'glyphicon glyphicon-volume-down '),(44,'glyphicon glyphicon-volume-up '),(45,'glyphicon glyphicon-qrcode '),(46,'glyphicon glyphicon-barcode '),(47,'glyphicon glyphicon-tag '),(48,'glyphicon glyphicon-tags '),(49,'glyphicon glyphicon-book '),(50,'glyphicon glyphicon-bookmark '),(51,'glyphicon glyphicon-print '),(52,'glyphicon glyphicon-camera '),(53,'glyphicon glyphicon-font '),(54,'glyphicon glyphicon-bold '),(55,'glyphicon glyphicon-italic '),(56,'glyphicon glyphicon-text-height '),(57,'glyphicon glyphicon-text-width '),(58,'glyphicon glyphicon-align-left '),(59,'glyphicon glyphicon-align-center '),(60,'glyphicon glyphicon-align-right '),(61,'glyphicon glyphicon-align-justify '),(62,'glyphicon glyphicon-list '),(63,'glyphicon glyphicon-indent-left '),(64,'glyphicon glyphicon-indent-right '),(65,'glyphicon glyphicon-facetime-video '),(66,'glyphicon glyphicon-picture '),(67,'glyphicon glyphicon-map-marker '),(68,'glyphicon glyphicon-adjust '),(69,'glyphicon glyphicon-tint '),(70,'glyphicon glyphicon-edit '),(71,'glyphicon glyphicon-share '),(72,'glyphicon glyphicon-check '),(73,'glyphicon glyphicon-move '),(74,'glyphicon glyphicon-step-backward '),(75,'glyphicon glyphicon-fast-backward '),(76,'glyphicon glyphicon-backward '),(77,'glyphicon glyphicon-play '),(78,'glyphicon glyphicon-pause '),(79,'glyphicon glyphicon-stop '),(80,'glyphicon glyphicon-forward '),(81,'glyphicon glyphicon-fast-forward '),(82,'glyphicon glyphicon-step-forward '),(83,'glyphicon glyphicon-eject '),(84,'glyphicon glyphicon-chevron-left '),(85,'glyphicon glyphicon-chevron-right '),(86,'glyphicon glyphicon-plus-sign '),(87,'glyphicon glyphicon-minus-sign '),(88,'glyphicon glyphicon-remove-sign '),(89,'glyphicon glyphicon-ok-sign '),(90,'glyphicon glyphicon-question-sign '),(91,'glyphicon glyphicon-info-sign '),(92,'glyphicon glyphicon-screenshot '),(93,'glyphicon glyphicon-remove-circle '),(94,'glyphicon glyphicon-ok-circle '),(95,'glyphicon glyphicon-ban-circle '),(96,'glyphicon glyphicon-arrow-left '),(97,'glyphicon glyphicon-arrow-right '),(98,'glyphicon glyphicon-arrow-up '),(99,'glyphicon glyphicon-arrow-down '),(100,'glyphicon glyphicon-share-alt '),(101,'glyphicon glyphicon-resize-full '),(102,'glyphicon glyphicon-resize-small '),(103,'glyphicon glyphicon-exclamation-sign '),(104,'glyphicon glyphicon-gift '),(105,'glyphicon glyphicon-leaf '),(106,'glyphicon glyphicon-fire '),(107,'glyphicon glyphicon-eye-open '),(108,'glyphicon glyphicon-eye-close '),(109,'glyphicon glyphicon-warning-sign '),(110,'glyphicon glyphicon-plane '),(111,'glyphicon glyphicon-calendar '),(112,'glyphicon glyphicon-random '),(113,'glyphicon glyphicon-comment '),(114,'glyphicon glyphicon-magnet '),(115,'glyphicon glyphicon-chevron-up '),(116,'glyphicon glyphicon-chevron-down '),(117,'glyphicon glyphicon-retweet '),(118,'glyphicon glyphicon-shopping-cart '),(119,'glyphicon glyphicon-folder-close '),(120,'glyphicon glyphicon-folder-open '),(121,'glyphicon glyphicon-resize-vertical '),(122,'glyphicon glyphicon-resize-horizontal '),(123,'glyphicon glyphicon-hdd '),(124,'glyphicon glyphicon-bullhorn '),(125,'glyphicon glyphicon-bell '),(126,'glyphicon glyphicon-certificate '),(127,'glyphicon glyphicon-thumbs-up '),(128,'glyphicon glyphicon-thumbs-down '),(129,'glyphicon glyphicon-hand-right '),(130,'glyphicon glyphicon-hand-left '),(131,'glyphicon glyphicon-hand-up '),(132,'glyphicon glyphicon-hand-down '),(133,'glyphicon glyphicon-circle-arrow-right '),(134,'glyphicon glyphicon-circle-arrow-left '),(135,'glyphicon glyphicon-circle-arrow-up '),(136,'glyphicon glyphicon-circle-arrow-down '),(137,'glyphicon glyphicon-globe '),(138,'glyphicon glyphicon-wrench '),(139,'glyphicon glyphicon-tasks '),(140,'glyphicon glyphicon-filter '),(141,'glyphicon glyphicon-briefcase '),(142,'glyphicon glyphicon-fullscreen '),(143,'glyphicon glyphicon-dashboard '),(144,'glyphicon glyphicon-paperclip '),(145,'glyphicon glyphicon-heart-empty '),(146,'glyphicon glyphicon-link '),(147,'glyphicon glyphicon-phone '),(148,'glyphicon glyphicon-pushpin '),(149,'glyphicon glyphicon-usd '),(150,'glyphicon glyphicon-gbp '),(151,'glyphicon glyphicon-sort '),(152,'glyphicon glyphicon-sort-by-alphabet '),(153,'glyphicon glyphicon-sort-by-alphabet-alt '),(154,'glyphicon glyphicon-sort-by-order '),(155,'glyphicon glyphicon-sort-by-order-alt '),(156,'glyphicon glyphicon-sort-by-attributes '),(157,'glyphicon glyphicon-sort-by-attributes-alt '),(158,'glyphicon glyphicon-unchecked '),(159,'glyphicon glyphicon-expand '),(160,'glyphicon glyphicon-collapse-down '),(161,'glyphicon glyphicon-collapse-up '),(162,'glyphicon glyphicon-log-in '),(163,'glyphicon glyphicon-flash '),(164,'glyphicon glyphicon-log-out '),(165,'glyphicon glyphicon-new-window '),(166,'glyphicon glyphicon-record '),(167,'glyphicon glyphicon-save '),(168,'glyphicon glyphicon-open '),(169,'glyphicon glyphicon-saved '),(170,'glyphicon glyphicon-import '),(171,'glyphicon glyphicon-export '),(172,'glyphicon glyphicon-send '),(173,'glyphicon glyphicon-floppy-disk '),(174,'glyphicon glyphicon-floppy-saved '),(175,'glyphicon glyphicon-floppy-remove '),(176,'glyphicon glyphicon-floppy-save '),(177,'glyphicon glyphicon-floppy-open '),(178,'glyphicon glyphicon-credit-card '),(179,'glyphicon glyphicon-transfer '),(180,'glyphicon glyphicon-cutlery '),(181,'glyphicon glyphicon-header '),(182,'glyphicon glyphicon-compressed '),(183,'glyphicon glyphicon-earphone '),(184,'glyphicon glyphicon-phone-alt '),(185,'glyphicon glyphicon-tower '),(186,'glyphicon glyphicon-stats '),(187,'glyphicon glyphicon-sd-video '),(188,'glyphicon glyphicon-hd-video '),(189,'glyphicon glyphicon-subtitles '),(190,'glyphicon glyphicon-sound-stereo '),(191,'glyphicon glyphicon-sound-dolby '),(192,'glyphicon glyphicon-sound-5-1 '),(193,'glyphicon glyphicon-sound-6-1 '),(194,'glyphicon glyphicon-sound-7-1 '),(195,'glyphicon glyphicon-copyright-mark '),(196,'glyphicon glyphicon-registration-mark '),(197,'glyphicon glyphicon-cloud-download '),(198,'glyphicon glyphicon-cloud-upload '),(199,'glyphicon glyphicon-tree-conifer '),(200,'glyphicon glyphicon-tree-deciduous ');
/*!40000 ALTER TABLE `icone_bootstrap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imagem`
--

DROP TABLE IF EXISTS `imagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imagem` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned NOT NULL,
  `relacionamento_id` int(10) unsigned NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `nome_img` varchar(100) DEFAULT NULL,
  `nome_thumb` varchar(45) DEFAULT NULL,
  `destaque` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_imagem_1_idx` (`menu_id`),
  KEY `fk_imagem_2_idx` (`relacionamento_id`),
  CONSTRAINT `fk_imagem_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagem`
--

LOCK TABLES `imagem` WRITE;
/*!40000 ALTER TABLE `imagem` DISABLE KEYS */;
INSERT INTO `imagem` VALUES (1,9,52,NULL,'3heads/images/banners/cliente_1/201510261445897575images(2).jpg','3heads/images/banners/cliente_1/thumbs/201510',1),(2,9,53,NULL,'3heads/images/banners/cliente_1/201510261445898263anner.jpg','3heads/images/banners/cliente_1/thumbs/201510',1),(3,9,53,NULL,'3heads/images/banners/cliente_1/201510261445898263banner2.jpg','3heads/images/banners/cliente_1/thumbs/201510',0),(4,9,53,NULL,'3heads/images/banners/cliente_1/201510261445898263banner3.jpg','3heads/images/banners/cliente_1/thumbs/201510',0),(5,7,3,NULL,'3heads/images/conteudo/cliente_1/201510271445961505images.jpg','3heads/images/conteudo/cliente_1/thumbs/20151',1),(6,7,7,NULL,'3heads/images/conteudo/cliente_1/201510271445961947team1.png','3heads/images/conteudo/cliente_1/thumbs/20151',1),(7,7,8,NULL,'3heads/images/conteudo/cliente_1/201510271445961988team2.png','3heads/images/conteudo/cliente_1/thumbs/20151',1),(8,7,9,NULL,'3heads/images/conteudo/cliente_1/201510271445962032team3.png','3heads/images/conteudo/cliente_1/thumbs/20151',1),(9,7,1,NULL,'3heads/images/conteudo/cliente_1/201510271445962460p1.jpg','3heads/images/conteudo/cliente_1/thumbs/20151',1),(10,7,10,NULL,'3heads/images/conteudo/cliente_1/201510271445962521p2.jpg','3heads/images/conteudo/cliente_1/thumbs/20151',1),(11,7,11,NULL,'3heads/images/conteudo/cliente_1/201510271445962562p3.jpg','3heads/images/conteudo/cliente_1/thumbs/20151',1),(12,7,12,NULL,'3heads/images/conteudo/cliente_1/2015102714459629201.png','3heads/images/conteudo/cliente_1/thumbs/20151',1),(13,7,13,NULL,'3heads/images/conteudo/cliente_1/2015102714459629442.png','3heads/images/conteudo/cliente_1/thumbs/20151',1),(14,7,14,NULL,'3heads/images/conteudo/cliente_1/2015102714459629723.png','3heads/images/conteudo/cliente_1/thumbs/20151',1),(15,7,15,NULL,'3heads/images/conteudo/cliente_1/2015102714459629954.png','3heads/images/conteudo/cliente_1/thumbs/20151',1),(23,7,16,NULL,'3heads/images/conteudo/cliente_1/2015102914460876521.png','3heads/images/conteudo/cliente_1/thumbs/20151',1),(24,7,17,NULL,'3heads/images/conteudo/cliente_1/2015102914460876872.png','3heads/images/conteudo/cliente_1/thumbs/20151',1),(25,7,18,NULL,'3heads/images/conteudo/cliente_1/2015102914460877193.png','3heads/images/conteudo/cliente_1/thumbs/20151',1),(26,7,19,NULL,'3heads/images/conteudo/cliente_1/2015102914460877684.png','3heads/images/conteudo/cliente_1/thumbs/20151',1),(27,7,20,NULL,'3heads/images/conteudo/cliente_1/2015102914460877945.png','3heads/images/conteudo/cliente_1/thumbs/20151',1),(28,7,21,NULL,'3heads/images/conteudo/cliente_1/201510291446088959a1.jpg','3heads/images/conteudo/cliente_1/thumbs/20151',1),(29,7,22,NULL,'3heads/images/conteudo/cliente_1/201510291446089004a1.jpg','3heads/images/conteudo/cliente_1/thumbs/20151',1),(30,7,23,NULL,'3heads/images/conteudo/cliente_1/201510291446089023a2.jpg','3heads/images/conteudo/cliente_1/thumbs/20151',1),(31,7,24,NULL,'3heads/images/conteudo/cliente_1/201510291446089045a3.jpg','3heads/images/conteudo/cliente_1/thumbs/20151',1),(32,7,25,NULL,'3heads/images/conteudo/cliente_1/201510291446089065a4.jpg','3heads/images/conteudo/cliente_1/thumbs/20151',1),(33,5,1,NULL,'3heads/images/pessoa/cliente_1/201510291446089617log.jpg','3heads/images/pessoa/cliente_1/thumbs/2015102',1);
/*!40000 ALTER TABLE `imagem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned DEFAULT NULL,
  `descricao` varchar(100) NOT NULL,
  `url` varchar(200) DEFAULT NULL,
  `posicao` int(10) unsigned NOT NULL,
  `iconCls` varchar(10) NOT NULL DEFAULT 'nav',
  PRIMARY KEY (`id`),
  UNIQUE KEY `descricao` (`descricao`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,NULL,'Cadastro Básico','',1,'nav'),(2,1,'Perfil','perfil',1,'nav'),(3,1,'Usuário','usuario',2,'nav'),(4,1,'Menu','menu',3,'nav'),(5,1,'Pessoa','pessoa',1,'nav'),(6,NULL,'Configuração Site',NULL,2,'nav'),(7,6,'Conteudo','conteudo',1,'nav'),(9,6,'Banner','banner',2,'nav'),(10,6,'Banner Categoria','banner_categoria',3,'nav');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paciente`
--

DROP TABLE IF EXISTS `paciente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paciente` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cliente_pessoa1_idx` (`pessoa_id`),
  CONSTRAINT `fk_cliente_pessoa10` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paciente`
--

LOCK TABLES `paciente` WRITE;
/*!40000 ALTER TABLE `paciente` DISABLE KEYS */;
/*!40000 ALTER TABLE `paciente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil`
--

DROP TABLE IF EXISTS `perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfil` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `pessoa_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Index_2` (`nome`),
  KEY `pessoa_id` (`pessoa_id`),
  CONSTRAINT `perfil_fk` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil`
--

LOCK TABLES `perfil` WRITE;
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` VALUES (1,'Master',1);
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissao`
--

DROP TABLE IF EXISTS `permissao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissao` (
  `perfil_id` int(10) unsigned NOT NULL,
  `menu_id` int(10) unsigned NOT NULL DEFAULT '0',
  `acao_inserir` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `acao_alterar` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `acao_excluir` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`perfil_id`,`menu_id`),
  KEY `FK_permissoes_2` (`menu_id`),
  CONSTRAINT `FK_permissoes_1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_permissoes_2` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissao`
--

LOCK TABLES `permissao` WRITE;
/*!40000 ALTER TABLE `permissao` DISABLE KEYS */;
INSERT INTO `permissao` VALUES (1,2,0,0,0),(1,3,0,0,0),(1,4,0,0,0),(1,5,0,0,0),(1,7,0,0,0),(1,9,0,0,0);
/*!40000 ALTER TABLE `permissao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pessoa`
--

DROP TABLE IF EXISTS `pessoa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pessoa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(11) unsigned DEFAULT NULL,
  `tipo_pessoa_id` int(11) unsigned NOT NULL,
  `cpf_cnpj` varchar(45) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `data_insercao` datetime DEFAULT NULL,
  `fisica_juridica` char(1) DEFAULT NULL COMMENT 'S OU N',
  `telefone` varchar(45) DEFAULT NULL,
  `ativo` char(1) DEFAULT 'S',
  `excluido` char(1) DEFAULT 'N',
  `mapa_localizacao` text,
  PRIMARY KEY (`id`),
  KEY `fk_pessoas_tipos_pessoas1_idx` (`tipo_pessoa_id`),
  KEY `fk_pessoas_pessoas1_idx` (`pessoa_id`),
  CONSTRAINT `fk_pessoas_pessoas1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pessoas_tipos_pessoas1` FOREIGN KEY (`tipo_pessoa_id`) REFERENCES `tipo_pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoa`
--

LOCK TABLES `pessoa` WRITE;
/*!40000 ALTER TABLE `pessoa` DISABLE KEYS */;
INSERT INTO `pessoa` VALUES (1,1,1,'12312312','3heads','alanansilva@gmail.com','asdf','0000-00-00 00:00:00','','(22) 2222-2222','S','N','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.4573936695815!2d-38.48161918517834!3d-12.942557490874915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7161ab1869fe98f%3A0x3dc38700516efff1!2sR.+Mello+Moraes+Filho+-+Fazenda+Grande+do+Retiro%2C+Salvador+-+BA!5e0!3m2!1spt-BR!2sbr!4v1445531018676'),(3,1,2,'111111111111','Joelson de Adorno Braga','joelson@focomultimidia.com','Rua','2015-10-05 00:00:00','F','(11) 1111-1111','S','N',NULL),(4,1,4,'111111111111','Joelson de Adorno Braga','joelson@focomultimidia.com','Rua','0000-00-00 00:00:00','J','(11) 1111-1111','S','N','https://www.google.com.br/maps/place/R.+Mello+Moraes+Filho+-+Fazenda+Grande+do+Retiro,+Salvador+-+BA/@-12.9425523,-38.4816246,17z/data=!3m1!4b1!4m2!3m1!1s0x7161ab1869fe98f:0x3dc38700516efff1'),(5,1,5,'111111111111','Joelson de Adorno Braga','joelson@focomultimidia.com','Rua','2015-10-05 00:00:00','F','(11) 1111-1111','S','N',NULL),(9,1,1,'1111111','Alana Nunes da Silva','alanansilva@gmail.com','Rua Melo Morais Filho','2015-10-22 00:00:00','F','7199659071','S','N','https://www.google.com.br/maps/place/R.+Mello+Moraes+Filho+-+Fazenda+Grande+do+Retiro,+Salvador+-+BA/@-12.9425523,-38.4816246,17z/data=!3m1!4b1!4m2!3m1!1s0x7161ab1869fe98f:0x3dc38700516efff1');
/*!40000 ALTER TABLE `pessoa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto`
--

DROP TABLE IF EXISTS `produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produto` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(11) unsigned NOT NULL,
  `fornecedor_id` int(11) unsigned NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `valor` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_produtos_pessoas1_idx` (`pessoa_id`),
  KEY `fk_produtos_fornecedor1_idx` (`fornecedor_id`),
  CONSTRAINT `fk_produtos_fornecedor1` FOREIGN KEY (`fornecedor_id`) REFERENCES `fornecedor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_produtos_pessoas1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto`
--

LOCK TABLES `produto` WRITE;
/*!40000 ALTER TABLE `produto` DISABLE KEYS */;
/*!40000 ALTER TABLE `produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `professor`
--

DROP TABLE IF EXISTS `professor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `professor` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cliente_pessoa1_idx` (`pessoa_id`),
  CONSTRAINT `fk_cliente_pessoa12` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `professor`
--

LOCK TABLES `professor` WRITE;
/*!40000 ALTER TABLE `professor` DISABLE KEYS */;
/*!40000 ALTER TABLE `professor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servico`
--

DROP TABLE IF EXISTS `servico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servico` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(11) unsigned NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `valor` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_servicos_pessoas1_idx` (`pessoa_id`),
  CONSTRAINT `fk_servicos_pessoas1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servico`
--

LOCK TABLES `servico` WRITE;
/*!40000 ALTER TABLE `servico` DISABLE KEYS */;
/*!40000 ALTER TABLE `servico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_pessoa`
--

DROP TABLE IF EXISTS `tipo_pessoa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_pessoa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_pessoa`
--

LOCK TABLES `tipo_pessoa` WRITE;
/*!40000 ALTER TABLE `tipo_pessoa` DISABLE KEYS */;
INSERT INTO `tipo_pessoa` VALUES (1,'Administrador'),(2,'Cliente'),(3,'Professor'),(4,'Fornecedor'),(5,'Paciente');
/*!40000 ALTER TABLE `tipo_pessoa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pessoa_id` int(10) unsigned DEFAULT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `ativo` int(11) unsigned NOT NULL DEFAULT '1',
  `nome` varchar(60) DEFAULT NULL,
  `perfil_id` int(10) unsigned DEFAULT NULL,
  `atendimento_online` tinyint(1) DEFAULT '0',
  `email` varchar(200) DEFAULT NULL,
  `primeiro_acesso` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Index_2` (`login`,`pessoa_id`),
  KEY `Index_3` (`pessoa_id`),
  KEY `Index_4` (`perfil_id`),
  CONSTRAINT `FK_usuario_2` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`),
  CONSTRAINT `FK_usuarios_1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,1,'master','eb0a191797624dd3a48fa681d3061212',1,'Joelson',1,0,'master@master.com.br',NULL);
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

-- Dump completed on 2015-10-29 23:09:35
