CREATE DATABASE  IF NOT EXISTS `3heads` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `3heads`;
-- MySQL dump 10.13  Distrib 5.5.44, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: 3heads
-- ------------------------------------------------------
-- Server version	5.5.44-0ubuntu0.14.04.1

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
-- Table structure for table `fin_lancamento_parcela`
--

DROP TABLE IF EXISTS `fin_lancamento_parcela`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fin_lancamento_parcela` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fin_lancamento_id` int(11) unsigned NOT NULL,
  `forma_pagamento_id` int(11) unsigned NOT NULL,
  `parcela` int(11) DEFAULT NULL,
  `data_vencimento` date DEFAULT NULL,
  `data_pagamento` date DEFAULT NULL,
  `valor` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fin_lancamentos_parcelas_fin_lancamentos1_idx` (`fin_lancamento_id`),
  KEY `fk_fin_lancamentos_parcelas_formas_pagamentos1_idx` (`forma_pagamento_id`),
  CONSTRAINT `fk_fin_lancamentos_parcelas_fin_lancamentos1` FOREIGN KEY (`fin_lancamento_id`) REFERENCES `fin_lancamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_fin_lancamentos_parcelas_formas_pagamentos1` FOREIGN KEY (`forma_pagamento_id`) REFERENCES `forma_pagamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fin_lancamento_parcela`
--

LOCK TABLES `fin_lancamento_parcela` WRITE;
/*!40000 ALTER TABLE `fin_lancamento_parcela` DISABLE KEYS */;
/*!40000 ALTER TABLE `fin_lancamento_parcela` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,NULL,'Cadastro Básico','',1,'nav'),(2,1,'Perfil','perfil',1,'nav'),(3,1,'Usuário','usuario',2,'nav'),(4,1,'Menu','menu',3,'nav'),(5,1,'Pessoa','pessoa',1,'nav');
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
INSERT INTO `permissao` VALUES (1,2,0,0,0),(1,3,0,0,0),(1,4,0,0,0),(1,5,0,0,0);
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
  PRIMARY KEY (`id`),
  KEY `fk_pessoas_tipos_pessoas1_idx` (`tipo_pessoa_id`),
  KEY `fk_pessoas_pessoas1_idx` (`pessoa_id`),
  CONSTRAINT `fk_pessoas_pessoas1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pessoas_tipos_pessoas1` FOREIGN KEY (`tipo_pessoa_id`) REFERENCES `tipo_pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoa`
--

LOCK TABLES `pessoa` WRITE;
/*!40000 ALTER TABLE `pessoa` DISABLE KEYS */;
INSERT INTO `pessoa` VALUES (1,NULL,1,'12312312','3heads','contato','asdf','2015-09-24 00:00:00','F','1','S','N'),(3,1,2,'111111111111','Joelson de Adorno Braga','joelson@focomultimidia.com','Rua','2015-10-05 00:00:00','F','(11) 1111-1111','S','N'),(4,1,4,'111111111111','Joelson de Adorno Braga','joelson@focomultimidia.com','Rua','2015-10-05 00:00:00','F','(11) 1111-1111','S','N'),(5,1,5,'111111111111','Joelson de Adorno Braga','joelson@focomultimidia.com','Rua','2015-10-05 00:00:00','F','(11) 1111-1111','S','N');
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
-- Table structure for table `professor_markup`
--

DROP TABLE IF EXISTS `professor_markup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `professor_markup` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `professor_id` int(11) unsigned NOT NULL,
  `servico_id` int(11) unsigned DEFAULT NULL,
  `produto_id` int(11) unsigned DEFAULT NULL,
  `markup` float DEFAULT NULL,
  `tipo_markup` char(1) DEFAULT NULL COMMENT '% OU R$',
  `comissao` float DEFAULT NULL,
  `tipo_comissao` char(1) DEFAULT NULL COMMENT '% ou R$',
  PRIMARY KEY (`id`),
  KEY `fk_professor_markup_professor1_idx` (`professor_id`),
  KEY `fk_professore_markup_servico1_idx` (`servico_id`),
  KEY `fk_professore_markup_produto1_idx` (`produto_id`),
  CONSTRAINT `fk_professore_markup_produto1` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_professore_markup_servico1` FOREIGN KEY (`servico_id`) REFERENCES `servico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_professor_markup_professor1` FOREIGN KEY (`professor_id`) REFERENCES `professor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `professor_markup`
--

LOCK TABLES `professor_markup` WRITE;
/*!40000 ALTER TABLE `professor_markup` DISABLE KEYS */;
/*!40000 ALTER TABLE `professor_markup` ENABLE KEYS */;
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
  CONSTRAINT `FK_usuarios_1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`),
  CONSTRAINT `FK_usuario_2` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`)
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

-- Dump completed on 2015-10-05 16:57:03
