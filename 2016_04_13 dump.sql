CREATE DATABASE  IF NOT EXISTS `inforshop` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `inforshop`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: inforshop
-- ------------------------------------------------------
-- Server version	5.5.44-0+deb8u1

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `user` varchar(10) DEFAULT NULL,
  `pass` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin','admin');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `assist_cli`
--

DROP TABLE IF EXISTS `assist_cli`;
/*!50001 DROP VIEW IF EXISTS `assist_cli`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `assist_cli` AS SELECT 
 1 AS `id_Assistencia`,
 1 AS `descricao_assistencia`,
 1 AS `descricao_equipamento`,
 1 AS `data_entrada`,
 1 AS `data_saida`,
 1 AS `id_ue`,
 1 AS `id_estado`,
 1 AS `estado`,
 1 AS `id_servico`,
 1 AS `tipo_servico`,
 1 AS `id_instal`,
 1 AS `id_produto`,
 1 AS `nome_produto`,
 1 AS `quantidade`,
 1 AS `valor_total`,
 1 AS `id_cliente`,
 1 AS `nome_cli`,
 1 AS `id_funcionario`,
 1 AS `nome_func`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `assistencias`
--

DROP TABLE IF EXISTS `assistencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assistencias` (
  `id_assistencia` int(11) NOT NULL AUTO_INCREMENT,
  `descricao_assistencia` varchar(50) NOT NULL,
  `descricao_equipamento` varchar(50) NOT NULL,
  `data_entrada` date NOT NULL,
  `data_saida` date NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  PRIMARY KEY (`id_assistencia`),
  KEY `ch_estr_clientes` (`id_cliente`),
  KEY `ch_estr_funcionarios` (`id_funcionario`),
  CONSTRAINT `ch_estr_clientes` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ch_estr_funcionarios` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionarios` (`id_funcionario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assistencias`
--

LOCK TABLES `assistencias` WRITE;
/*!40000 ALTER TABLE `assistencias` DISABLE KEYS */;
INSERT INTO `assistencias` VALUES (16,'asdasd','asdfasdf','0000-00-00','0000-00-00',12.22,87,252),(17,'Sdasdasd','Sasfasd','2016-12-16','2016-12-16',23.44,138,252),(20,'ASDfasdfasdf','ASDFASDfasdf','2015-01-01','2015-01-02',13.66,2,1),(23,'','','0000-00-00','0000-00-00',12.00,139,259),(24,'','','0000-00-00','0000-00-00',12.00,139,259),(27,'TestesTestes','Testes12345','2016-01-01','2016-01-02',65.00,2,259),(28,'Limpeza disco','portatil HP 2123','2016-01-01','2016-01-03',50.99,140,260),(33,'Teste Limpeza','Testes Cooler','2016-01-02','2016-01-02',34.66,140,251),(34,'Asajhdaskjdasd','efgSDFGADFG','2016-01-08','2016-01-08',120.00,140,260),(35,'LKasdkasjd','GHDfghsd','2016-01-02','2016-01-02',160.00,1,251),(37,'Lzadaksjdas','Ygsfdsfdf','2016-01-03','2016-01-04',160.00,1,259),(39,'asdgfsdfasdf','dfgsdghsdfg','2016-01-06','2016-01-06',160.00,1,1),(40,'Troca Disco','Dell Computer Desktop','2016-04-01','0000-00-00',152.00,137,2),(41,'Formatação','Portátil Toshiba L200','2016-01-18','2016-04-11',50.00,137,251),(42,'Formatação','Portátil Toshiba L200','2016-01-18','2016-04-11',62.00,137,251),(44,'Remover parafusos','Portátil Toshiba Satellite Pro R50','2016-01-18','0000-00-00',20.00,140,1);
/*!40000 ALTER TABLE `assistencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome_categoria` varchar(50) NOT NULL,
  PRIMARY KEY (`id_categoria`),
  UNIQUE KEY `nome_categoria` (`nome_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (12,'2hand'),(13,'acessorios para portateis'),(2,'armazenamento de dados'),(3,'computadores'),(4,'consumiveis'),(1,'default'),(5,'diversos'),(6,'impressoras'),(7,'integracao'),(8,'perifericos'),(9,'redes'),(10,'software'),(17,'Testes1'),(18,'Testes2'),(11,'tinteiros reciclados');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nif` varchar(10) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `morada` varchar(50) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `nif` (`nif`)
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'123456790','José Silvo','Rua do Sobe e Desce, 10 - 2º Esq.','289001122','josesilva@mail.com'),(2,'111222333','António Rocha','Avenida de Cima, lote 200 - 5º Dto.','210000555','arocha@correio.pt'),(87,'123456789','Pedro Ribeira','Rua Janeiro','005512312','teste@mail.com'),(137,'224532227','Manuel Seromenho','Rua da Alagoa, Lote 19, Loja 4','289324374','geral@inforzen.com'),(138,'999999999','Consumidor Final','Nao aplicavel','0','0'),(139,'123123123','Jose Emanuel','Rua das Garças','123123123','asdjasdsad'),(140,'547525487','Roberto Carlos','Rua do Brasil, nº12, 4ºesq','289131231','robertocarlos@gmail.com');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `comp_por_cli`
--

DROP TABLE IF EXISTS `comp_por_cli`;
/*!50001 DROP VIEW IF EXISTS `comp_por_cli`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `comp_por_cli` AS SELECT 
 1 AS `id_compra`,
 1 AS `id_cliente`,
 1 AS `nome`,
 1 AS `data_compra`,
 1 AS `preco_total`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `compra`
--

DROP TABLE IF EXISTS `compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compra` (
  `id_compra` int(11) NOT NULL AUTO_INCREMENT,
  `data_compra` date NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `preco_total` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_compra`),
  KEY `ch_estr_cli_comp` (`id_cliente`),
  CONSTRAINT `ch_estr_cli_comp` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compra`
--

LOCK TABLES `compra` WRITE;
/*!40000 ALTER TABLE `compra` DISABLE KEYS */;
INSERT INTO `compra` VALUES (17,'2016-01-12',1,18.00),(18,'2016-01-02',140,4.50),(19,'2016-01-15',139,33.66),(20,'2016-01-11',87,333.00),(21,'2016-01-06',2,299.50),(22,'2016-03-02',2,387.00),(23,'2016-04-08',137,370.00);
/*!40000 ALTER TABLE `compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalhes_compra`
--

DROP TABLE IF EXISTS `detalhes_compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalhes_compra` (
  `id_det_compra` int(11) NOT NULL AUTO_INCREMENT,
  `id_compra` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `desconto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_det_compra`),
  KEY `ch_estr_comp` (`id_compra`),
  KEY `ch_estr_prod_comp` (`id_produto`),
  CONSTRAINT `ch_estr_comp` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id_compra`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ch_estr_prod_comp` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id_produto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalhes_compra`
--

LOCK TABLES `detalhes_compra` WRITE;
/*!40000 ALTER TABLE `detalhes_compra` DISABLE KEYS */;
INSERT INTO `detalhes_compra` VALUES (1,17,1,1,10),(2,17,1,1,10),(3,18,2,1,10),(4,19,1,1,1),(5,19,82,2,1),(6,20,1,1,10),(7,20,85,1,20),(8,20,3,2,10),(9,21,3,2,10),(10,21,1,5,5),(11,22,1,1,10),(12,22,3,3,10),(13,23,3,1,0),(14,23,3,1,0),(15,23,85,1,0);
/*!40000 ALTER TABLE `detalhes_compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estados`
--

DROP TABLE IF EXISTS `estados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estados` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(50) NOT NULL,
  PRIMARY KEY (`id_estado`),
  UNIQUE KEY `estado` (`estado`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estados`
--

LOCK TABLES `estados` WRITE;
/*!40000 ALTER TABLE `estados` DISABLE KEYS */;
INSERT INTO `estados` VALUES (3,'Concluido'),(1,'Iniciado'),(2,'Pendente');
/*!40000 ALTER TABLE `estados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionarios`
--

DROP TABLE IF EXISTS `funcionarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `funcionarios` (
  `id_funcionario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `morada` varchar(50) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `nif` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `data_entrada` date DEFAULT NULL,
  PRIMARY KEY (`id_funcionario`),
  UNIQUE KEY `nif` (`nif`)
) ENGINE=InnoDB AUTO_INCREMENT=262 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionarios`
--

LOCK TABLES `funcionarios` WRITE;
/*!40000 ALTER TABLE `funcionarios` DISABLE KEYS */;
INSERT INTO `funcionarios` VALUES (1,'Valter Antonio','Faro','289000001','111111111','valter@ualg.pt','1901-01-05','2001-01-08'),(2,'Manuel Seromenho','Quarteira','960000001','222222222','manuel@ualg.pt','1902-01-02','2005-01-02'),(3,'Susana Estevão','Olhao','910000000','333333335','susana@ualg.pt','1903-12-04','2010-01-02'),(251,'Jonh Ben','Olhao','910000000','444444444','susana@ualg.pt','1993-01-01','2010-01-01'),(252,'Lloyd Mcfly','Olhao','910000000','555555555','lloyd@ualg.pt','1993-01-01','2010-01-01'),(259,'José','Silva','289000111','123321456','jose.silva@mail.pt','2006-01-03','2016-01-12'),(260,'Maria Francisca','Rua Luis de Camões','278454545','875154854','mariafrancisca@hotmail.com','1984-06-13','2016-01-14'),(261,'sasasa','sass','as','sasass','asa','0000-00-00','0000-00-00');
/*!40000 ALTER TABLE `funcionarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instalacao`
--

DROP TABLE IF EXISTS `instalacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instalacao` (
  `id_instal` int(11) NOT NULL AUTO_INCREMENT,
  `quantidade` int(11) NOT NULL,
  `id_ue` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  PRIMARY KEY (`id_instal`),
  KEY `ch_estr_ue_inst` (`id_ue`),
  KEY `ch_estr_prod_inst` (`id_produto`),
  CONSTRAINT `ch_estr_prod_inst` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id_produto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ch_estr_ue_inst` FOREIGN KEY (`id_ue`) REFERENCES `usados_efetuados` (`id_ue`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instalacao`
--

LOCK TABLES `instalacao` WRITE;
/*!40000 ALTER TABLE `instalacao` DISABLE KEYS */;
INSERT INTO `instalacao` VALUES (1,1,12,84),(2,1,10,80),(3,2,11,3),(5,1,14,3),(7,1,16,3),(9,1,18,3),(10,1,19,82),(12,1,21,82),(13,1,22,82);
/*!40000 ALTER TABLE `instalacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marcas`
--

DROP TABLE IF EXISTS `marcas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marcas` (
  `id_marca` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(50) NOT NULL,
  PRIMARY KEY (`id_marca`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marcas`
--

LOCK TABLES `marcas` WRITE;
/*!40000 ALTER TABLE `marcas` DISABLE KEYS */;
INSERT INTO `marcas` VALUES (1,'default marca'),(2,'Kingston'),(3,'Fujitsu-Siemens'),(4,'Asus'),(5,'Compaq'),(6,'Dell'),(7,'Conceptronic'),(8,'Levelone'),(10,'HP'),(14,'Belkin'),(15,'Kingston Value'),(16,'Matrixx'),(17,'Asusa');
/*!40000 ALTER TABLE `marcas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos` (
  `id_produto` int(11) NOT NULL AUTO_INCREMENT,
  `nome_produto` varchar(50) NOT NULL,
  `num_serie` varchar(50) NOT NULL,
  `cod_barras` varchar(50) NOT NULL,
  `peso` float NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco_venda` decimal(10,2) NOT NULL,
  `id_subcategoria` int(11) DEFAULT NULL,
  `id_marca` int(11) NOT NULL,
  PRIMARY KEY (`id_produto`),
  UNIQUE KEY `num_serie` (`num_serie`),
  UNIQUE KEY `cod_barras` (`cod_barras`),
  KEY `ch_estr_subcategorias` (`id_subcategoria`),
  KEY `ch_estr_marcas` (`id_marca`),
  CONSTRAINT `ch_estr_marcas` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ch_estr_subcategorias` FOREIGN KEY (`id_subcategoria`) REFERENCES `subcategorias` (`id_subcategoria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,'Pen 8 GB','PD001','1010101',100,99,10.00,48,16),(2,'Pen 1000GB','343331','1010000100001',100,12,5.00,31,16),(3,'Disco 250GB SSD','SSD001','010001',100,89,140.00,43,2),(79,'Pen USB 512GB','003214ABC','10101011111111',100,100,50.00,33,2),(80,'Pen 16 GB','4000000001','4000000001',130,100,20.00,33,2),(82,'Testes343','aeasdfasdf','234123',12,6,12.00,113,4),(84,'Testes','123123','2312312',0.2,12,14.66,31,10),(85,'Led Screen Compativel','1010101010','1010101010',400,7,90.00,124,1);
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicos`
--

DROP TABLE IF EXISTS `servicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servicos` (
  `id_servico` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_servico` varchar(50) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `tempo_estimado` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_servico`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicos`
--

LOCK TABLES `servicos` WRITE;
/*!40000 ALTER TABLE `servicos` DISABLE KEYS */;
INSERT INTO `servicos` VALUES (1,'Formatacao',45.00,'120'),(2,'Instalação SO',50.99,'20'),(3,'Limpeza Virus',50.99,'20'),(7,'Diagnostico Geral',20.00,'30'),(8,'FISO',140.00,'480'),(9,'Testes',120.00,'2'),(10,'Integração LED Screen',40.00,'120');
/*!40000 ALTER TABLE `servicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcategorias`
--

DROP TABLE IF EXISTS `subcategorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subcategorias` (
  `id_subcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome_subcategoria` varchar(50) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id_subcategoria`),
  UNIQUE KEY `nome_subcategoria` (`nome_subcategoria`),
  KEY `ch_estr_categorias` (`id_categoria`),
  CONSTRAINT `ch_estr_categorias` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategorias`
--

LOCK TABLES `subcategorias` WRITE;
/*!40000 ALTER TABLE `subcategorias` DISABLE KEYS */;
INSERT INTO `subcategorias` VALUES (1,'default',1),(26,'Placas PCMCIA',13),(27,'DVD Externos',13),(28,'Carregadores',13),(29,'Cartoes Memorias',2),(30,'Cds e Dvds',2),(31,'Discos Externos',2),(32,'Leitores de Cartoes',2),(33,'Pen Drives',2),(34,'Desktop',3),(35,'Portateis',3),(36,'Rolos Termicos',4),(37,'Cabos',5),(38,'Carregadores de Pilhas',5),(39,'Tapetes de Rato',5),(40,'Impressoras Termicas',6),(41,'Impressores Multifuncoes',6),(42,'Impressoras Laser',6),(43,'Discos 2_5',7),(44,'Discos 3_5',7),(45,'Fontes de Alimentacao',7),(46,'Memorias Ram',7),(47,'Placas de Rede',7),(48,'Placas de Som',7),(49,'Placas Graficas',7),(50,'Refrigeracao',7),(51,'Adapt de Som Usb',8),(52,'Auscultadores C Micro',8),(53,'Webcam',8),(54,'Colunas de Som',8),(55,'Internet Movel',8),(56,'Ratos',8),(57,'Teclados',8),(58,'Ethernet',9),(59,'Internet',9),(60,'Wireless',9),(61,'Aplicacoes',10),(62,'Seguranca',10),(63,'Sistemas Operativos',10),(64,'HP',11),(65,'Epson',11),(66,'Brother',11),(67,'Lexmark',11),(68,'Inversores LCD',12),(69,'LCDS 15.4',12),(70,'LCDS 15.6',12),(71,'LCDS 14',12),(72,'LEDS 15.6',12),(73,'LEDS 14',12),(74,'RAM DDR 512MB',12),(75,'RAM DDR 1GB',12),(76,'RAM DDR2 512MB',12),(77,'RAM DDR2 1GB',12),(78,'RAM DDR2 2GB',12),(79,'RAM DDR3 2GB',12),(80,'RAM DDR3 4GB',12),(81,'RAM DDR3 8GB',12),(82,'FAN Notebook HP',12),(83,'FAN Notebook ACER',12),(84,'FAN Notebook Toshiba',12),(85,'FAN Notebook ASUS',12),(86,'Discos 2_5 2hand',12),(87,'Discos 3_5 2hand',12),(88,'Notebook Hinges HP',12),(89,'Notebook Bezel HP',12),(90,'Notebook Hinges ASUS',12),(100,'teste',1),(102,'teste_1',1),(104,'teste3',1),(112,'Defrag',10),(113,'TestesTestes123123',18),(114,'Testes_SPARTA5',17),(115,'Tesreas',1),(116,'Pens',2),(118,'Testes2_b',18),(119,'Testes2_a',18),(120,'Testes',17),(124,'LEDS Portatil',7);
/*!40000 ALTER TABLE `subcategorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usados_efetuados`
--

DROP TABLE IF EXISTS `usados_efetuados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usados_efetuados` (
  `id_ue` int(11) NOT NULL AUTO_INCREMENT,
  `id_assistencia` int(11) NOT NULL,
  `id_servico` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  PRIMARY KEY (`id_ue`),
  KEY `ch_estr_assistencias` (`id_assistencia`),
  KEY `ch_estr_servicos` (`id_servico`),
  KEY `ch_estr_estados` (`id_estado`),
  CONSTRAINT `ch_estr_assistencias` FOREIGN KEY (`id_assistencia`) REFERENCES `assistencias` (`id_assistencia`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ch_estr_estados` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ch_estr_servicos` FOREIGN KEY (`id_servico`) REFERENCES `servicos` (`id_servico`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usados_efetuados`
--

LOCK TABLES `usados_efetuados` WRITE;
/*!40000 ALTER TABLE `usados_efetuados` DISABLE KEYS */;
INSERT INTO `usados_efetuados` VALUES (10,27,1,3),(11,28,3,2),(12,33,7,2),(13,34,9,1),(14,35,7,3),(16,37,7,3),(18,39,7,3),(19,40,8,1),(20,41,2,2),(21,42,2,2),(22,27,2,2),(23,44,7,1);
/*!40000 ALTER TABLE `usados_efetuados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `assist_cli`
--

/*!50001 DROP VIEW IF EXISTS `assist_cli`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `assist_cli` AS (select `a`.`id_assistencia` AS `id_Assistencia`,`a`.`descricao_assistencia` AS `descricao_assistencia`,`a`.`descricao_equipamento` AS `descricao_equipamento`,`a`.`data_entrada` AS `data_entrada`,`a`.`data_saida` AS `data_saida`,`ue`.`id_ue` AS `id_ue`,`ue`.`id_estado` AS `id_estado`,`e`.`estado` AS `estado`,`ue`.`id_servico` AS `id_servico`,`s`.`tipo_servico` AS `tipo_servico`,`i`.`id_instal` AS `id_instal`,`i`.`id_produto` AS `id_produto`,`p`.`nome_produto` AS `nome_produto`,`i`.`quantidade` AS `quantidade`,`a`.`valor_total` AS `valor_total`,`a`.`id_cliente` AS `id_cliente`,`c`.`nome` AS `nome_cli`,`a`.`id_funcionario` AS `id_funcionario`,`f`.`nome` AS `nome_func` from (((((((`assistencias` `a` join `clientes` `c`) join `funcionarios` `f`) join `usados_efetuados` `ue`) join `servicos` `s`) join `estados` `e`) join `instalacao` `i`) join `produtos` `p`) where ((`a`.`id_cliente` = `c`.`id_cliente`) and (`a`.`id_funcionario` = `f`.`id_funcionario`) and (`ue`.`id_estado` = `e`.`id_estado`) and (`ue`.`id_servico` = `s`.`id_servico`) and (`ue`.`id_assistencia` = `a`.`id_assistencia`) and (`ue`.`id_ue` = `i`.`id_ue`) and (`i`.`id_produto` = `p`.`id_produto`)) order by `a`.`id_assistencia`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `comp_por_cli`
--

/*!50001 DROP VIEW IF EXISTS `comp_por_cli`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `comp_por_cli` AS (select distinct `c`.`id_compra` AS `id_compra`,`cli`.`id_cliente` AS `id_cliente`,`cli`.`nome` AS `nome`,`c`.`data_compra` AS `data_compra`,`c`.`preco_total` AS `preco_total` from (`compra` `c` join `clientes` `cli`) where (`c`.`id_cliente` = `cli`.`id_cliente`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-13 14:37:19
