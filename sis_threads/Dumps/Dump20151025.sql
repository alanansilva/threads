CREATE DATABASE  IF NOT EXISTS `3heads` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `3heads`;
-- MySQL dump 10.13  Distrib 5.5.44, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: 3heads
-- ------------------------------------------------------
-- Server version	5.6.19-0ubuntu0.14.04.1

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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banner`
--

LOCK TABLES `banner` WRITE;
/*!40000 ALTER TABLE `banner` DISABLE KEYS */;
INSERT INTO `banner` VALUES (1,1,'Teste2323','Teste2323','S','<p>Teste</p>\n'),(2,2,'Teste 2','Teste 2','S','<p>Teste</p>\n'),(3,3,'Teste 3','Teste 3','S','<p>Teste 3Teste 3Teste 3</p>\n'),(4,1,'teste up','teste','S','<p>sssssssssss</p>\r\n'),(5,1,'teste up','sss','S','<p>ssssss</p>\r\n'),(6,1,'tv','ddddddddddd','S','<p>dddddddddd</p>\r\n'),(7,1,'testes up','sss','S','<p>sssssssss</p>\r\n'),(8,1,'testeste uplo','aaaaaaaaaaaa','S','<p>aaaaaaaaaaaaa</p>\r\n'),(9,1,'tev teesee','eee','S','<p>eeeeeeeee</p>\r\n'),(10,1,'teeeses','eee','S','<p>eeeeeeeeee</p>\r\n'),(11,1,'ererere','ererer','S','<p>errer</p>\r\n'),(12,2,'aaaaaaaaaaaaa','aaaaaaaaaaa','S','<p>aaaaaaaaaaaaaaaaa</p>\r\n'),(13,1,'teste dvejvhsd','cccccccccccccc','S','<p>ccccccccccccccccccccccc</p>\r\n'),(15,2,'aa','aaaaaaaaaaaaaaaaaaaaaaa','S','<p>aaaaaaaaaaaaaa</p>\r\n'),(16,2,'Alana Nunes da Silva','aaaaaaa','S','<p>aaaaaaaaaaaaaaaaaaaa</p>\r\n'),(17,2,'Alana Nunes da Silva','aaaaaaa','S','<p>aaaaaaaaaaaaaaaaaaaa</p>'),(18,2,'wwwww','wwwwwwwwwwwwww','S','<p>wwwwwwwwwwwwwwww</p>\r\n'),(19,3,'aaaaaaaaaaaaaaaaaaa','aaaaaaaaaaaaaaaaaaaaa','S','<p>aaaaaaaaaaaaaaaaaaa</p>\r\n'),(20,1,'aaa','aaaaaaaaaaaaaaaa','S','<p>aaaaaaaaaaaaaa</p>\r\n'),(21,1,'aaaaaaaaa','aaaaaaaaaa','S','<p>aaaaaaaaaaaaaa</p>\r\n'),(22,3,'aaa','aaaaaaaaaaaaaaaaaaaaaa','S','<p>aaaaaaaaaaaaaaaaaaaaaaa</p>\r\n'),(23,2,'dddddddddd','dddddddddddddddddddddd','S','<p>ddddddddddddddddddd</p>\r\n'),(25,1,'aa','aaaaaaaaaaaaaaaaaaa','S','<p>aaaaaaaaaaaa</p>\r\n'),(26,1,'aaaaa','aaaaaaaaaaaaaaaaaaaaaaa','S','<p>aaaaaaaaaaaaaaaaa</p>\r\n');
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
  CONSTRAINT `fk_conteudo_1` FOREIGN KEY (`conteudo_categoria_id`) REFERENCES `conteudo_categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conteudo`
--

LOCK TABLES `conteudo` WRITE;
/*!40000 ALTER TABLE `conteudo` DISABLE KEYS */;
INSERT INTO `conteudo` VALUES (1,1,'Esse é meu produtossss','Esse é meu produto','<p>Esse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produtoEsse &eacute; meu produto</p>\n','Esse é meu produtoEsse é meu produtoEsse é meu produtoEsse é meu produto',0,'S',25,NULL,NULL,NULL),(2,2,'Esse é meu serviço','Esse é meu serviçoEsse é meu serviço','<p>Esse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;oEsse &eacute; meu servi&ccedil;o</p>\n','Esse é meu serviçoEsse é meu serviço',0,'S',26,NULL,NULL,NULL),(3,3,'Nós somos o maior negócio do mundo criativo','teste quem ssomos','<p>Existem muitas varia&ccedil;&otilde;es dispon&iacute;veis de passagens de Lorem Ipsum,&nbsp;<br />\n&nbsp;mas a maioria sofreu algum tipo de altera&ccedil;&atilde;o, seja por inser&ccedil;&atilde;o&nbsp;<br />\nde passagens com humor, ou palavras aleat&oacute;rias que n&atilde;o parecem&nbsp;<br />\n&nbsp;nem um pouco convincentes. Se voc&ecirc; pretende usar uma passagem&nbsp;<br />\nde Lorem Ipsum, precisa ter certeza de que n&atilde;o h&aacute; algo embara&ccedil;oso&nbsp;<br />\n&nbsp;escrito escondido no meio do texto.&nbsp;</p>\n','teste quem ssomosteste quem ssomosteste quem ssomos',0,'S',33,'','',''),(5,2,'teste 2 servico','teste 2 servico','<p>teste 2 servico&nbsp;teste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servico</p>\n','teste 2 servico teste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 servicoteste 2 s',0,'S',33,NULL,NULL,NULL),(7,4,'','','','',0,'S',0,'Alana Nunes da Silva','Analista','Desenvolvedor Web');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conteudo_categoria`
--

LOCK TABLES `conteudo_categoria` WRITE;
/*!40000 ALTER TABLE `conteudo_categoria` DISABLE KEYS */;
INSERT INTO `conteudo_categoria` VALUES (1,'Produtos'),(2,'Serviços'),(3,'Quem Somos'),(4,'Equipe');
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
-- Table structure for table `imagem`
--

DROP TABLE IF EXISTS `imagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imagem` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned NOT NULL,
  `relacionamento_id` int(10) unsigned NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `destaque` int(11) DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_imagem_1_idx` (`menu_id`),
  KEY `fk_imagem_2_idx` (`relacionamento_id`),
  CONSTRAINT `fk_imagem_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagem`
--

LOCK TABLES `imagem` WRITE;
/*!40000 ALTER TABLE `imagem` DISABLE KEYS */;
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

-- Dump completed on 2015-10-25 21:00:31
