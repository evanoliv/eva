CREATE DATABASE  IF NOT EXISTS `eva` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `eva`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: localhost    Database: eva
-- ------------------------------------------------------
-- Server version	5.6.12-log

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
-- Table structure for table `tbl_acomodacao`
--

DROP TABLE IF EXISTS `tbl_acomodacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_acomodacao` (
  `aco_id` int(11) NOT NULL AUTO_INCREMENT,
  `aco_atr_id` int(11) DEFAULT NULL,
  `aco_eve_id` int(11) DEFAULT NULL,
  `aco_hos_id` int(11) DEFAULT NULL,
  `aco_chegada` timestamp NULL DEFAULT NULL,
  `aco_saida` timestamp NULL DEFAULT NULL,
  `aco_almoco` int(11) DEFAULT NULL,
  `aco_janta` int(11) DEFAULT NULL,
  `aco_catering` int(11) DEFAULT NULL,
  `aco_observacao` text,
  `aco_criado_em` timestamp NULL DEFAULT NULL,
  `aco_modificado_em` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`aco_id`),
  KEY `acomod_atracao_id_idx` (`aco_atr_id`),
  KEY `acomod_evento_id_idx` (`aco_eve_id`),
  KEY `acomod_hosped_id_idx` (`aco_hos_id`),
  CONSTRAINT `acomod_atracao_id` FOREIGN KEY (`aco_atr_id`) REFERENCES `tbl_atracao` (`atr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `acomod_evento_id` FOREIGN KEY (`aco_eve_id`) REFERENCES `tbl_evento` (`eve_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `acomod_hosped_id` FOREIGN KEY (`aco_hos_id`) REFERENCES `tbl_hospedagem` (`hos_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_acomodacao`
--

LOCK TABLES `tbl_acomodacao` WRITE;
/*!40000 ALTER TABLE `tbl_acomodacao` DISABLE KEYS */;
INSERT INTO `tbl_acomodacao` VALUES (5,2,2,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0,'','2015-05-12 12:13:55','2015-05-12 12:13:55');
/*!40000 ALTER TABLE `tbl_acomodacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_apresentacao`
--

DROP TABLE IF EXISTS `tbl_apresentacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_apresentacao` (
  `apr_id` int(11) NOT NULL AUTO_INCREMENT,
  `apr_eve_id` int(11) DEFAULT NULL,
  `apr_atr_id` int(11) DEFAULT NULL,
  `apr_loc_id` int(11) DEFAULT NULL,
  `apr_data` date DEFAULT NULL,
  `apr_hora` time DEFAULT NULL,
  `apr_duracao` time DEFAULT NULL,
  `apr_observacao` text,
  `apr_criado_em` timestamp NULL DEFAULT NULL,
  `apr_modificado_em` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`apr_id`),
  KEY `apr_evento_idx` (`apr_eve_id`),
  KEY `apr_atracao_idx` (`apr_atr_id`),
  KEY `apr_local_idx` (`apr_loc_id`),
  CONSTRAINT `apr_atracao` FOREIGN KEY (`apr_atr_id`) REFERENCES `tbl_atracao` (`atr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `apr_evento` FOREIGN KEY (`apr_eve_id`) REFERENCES `tbl_evento` (`eve_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `apr_local` FOREIGN KEY (`apr_loc_id`) REFERENCES `tbl_local` (`loc_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_apresentacao`
--

LOCK TABLES `tbl_apresentacao` WRITE;
/*!40000 ALTER TABLE `tbl_apresentacao` DISABLE KEYS */;
INSERT INTO `tbl_apresentacao` VALUES (4,2,3,7,'2015-04-14','21:00:00','00:00:00','200','2015-04-14 11:36:04','2015-04-14 12:32:04'),(8,2,2,8,'2015-04-15','10:10:00','12:21:00','','2015-05-07 01:13:13','2015-05-07 01:13:13'),(9,2,3,8,'2015-04-14','10:10:00','10:10:00','','2015-05-07 21:38:23','2015-05-07 21:38:26'),(10,3,4,9,'2015-04-03','12:00:00','12:00:00','123','2015-05-27 12:06:31','2015-05-27 12:06:31');
/*!40000 ALTER TABLE `tbl_apresentacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_area`
--

DROP TABLE IF EXISTS `tbl_area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_area` (
  `are_id` int(11) NOT NULL AUTO_INCREMENT,
  `are_nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`are_id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_area`
--

LOCK TABLES `tbl_area` WRITE;
/*!40000 ALTER TABLE `tbl_area` DISABLE KEYS */;
INSERT INTO `tbl_area` VALUES (1,'Antropologia'),(2,'Arqueologia'),(3,'Arquitetura-Urbanismo'),(4,'Arquivo'),(5,'Arte Digital'),(6,'Artes Visuais'),(7,'Artesanato'),(8,'Audiovisual'),(9,'Banda'),(10,'Biblioteca'),(11,'Capoeira'),(12,'Carnaval'),(13,'Ciência Política'),(14,'Cinema'),(15,'Circo'),(16,'Comunicação'),(17,'Coral'),(18,'Cultura Cigana'),(19,'Cultura Digital'),(20,'Cultura Estrangeira (imigrantes)'),(21,'Cultura Indígena'),(22,'Cultura LGBT'),(23,'Cultura Negra'),(24,'Cultura Popular'),(25,'Dança'),(26,'Design'),(27,'Direito Autoral'),(28,'Economia Criativa'),(29,'Educação'),(30,'Esporte'),(31,'Filosofia'),(32,'Fotografia'),(33,'Gastronomia'),(34,'Gestão Cultural'),(35,'Gestor Público de Cultura'),(36,'História'),(37,'Jogos Eletrônicos'),(38,'Jornalismo'),(39,'Leitura'),(40,'Literatura'),(41,'Livro'),(42,'Meio Ambiente'),(43,'Mídias Sociais'),(44,'Moda'),(45,'Museu'),(46,'Música'),(47,'Novas Mídias'),(48,'Ópera'),(49,'Orquestra'),(50,'Patrimônio Imaterial'),(51,'Patrimônio Material'),(52,'Pesquisa'),(53,'Produção Cultural'),(54,'Rádio'),(55,'Saúde'),(56,'Sociologia'),(57,'Teatro'),(58,'Televisão'),(59,'Turismo'),(60,'Intervenção'),(61,'Performance'),(62,'Poética'),(63,'Ciência'),(64,'Oficina'),(65,'Artes Plásticas');
/*!40000 ALTER TABLE `tbl_area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_atividade`
--

DROP TABLE IF EXISTS `tbl_atividade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_atividade` (
  `ati_id` int(11) NOT NULL AUTO_INCREMENT,
  `ati_usu_id` int(11) DEFAULT NULL,
  `ati_eve_id` int(11) DEFAULT NULL,
  `ati_tar_id` int(11) DEFAULT NULL,
  `ati_descricao` text,
  `ati_criado_em` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ati_id`),
  KEY `usuario_ativ_id_idx` (`ati_usu_id`),
  KEY `evento_ativ_id_idx` (`ati_eve_id`),
  KEY `tarefa_ativ_id_idx` (`ati_tar_id`),
  CONSTRAINT `evento_ativ_id` FOREIGN KEY (`ati_eve_id`) REFERENCES `tbl_evento` (`eve_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `usuario_ativ_id` FOREIGN KEY (`ati_usu_id`) REFERENCES `tbl_usuario` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_atividade`
--

LOCK TABLES `tbl_atividade` WRITE;
/*!40000 ALTER TABLE `tbl_atividade` DISABLE KEYS */;
INSERT INTO `tbl_atividade` VALUES (1,9,2,3,'Lucas Peixoto criou uma nova tarefa: <a href=\"http://localhost/eva/cronograma/editarTarefa/3\">Arrumar as malas</a>','2015-04-02 12:18:43'),(2,9,2,4,'Lucas Peixoto criou uma nova tarefa: <a href=\"http://localhost/eva/cronograma/editarTarefa/4\">Fazer flyers</a>','2015-04-02 12:19:03'),(3,9,2,3,'Lucas Peixoto mudou o a tarefa <a href=\"http://localhost/eva/cronograma/editarTarefa/3\">Desfazer as malas</a> para <strong>Executando</strong>.','2015-04-02 12:19:15'),(4,9,2,4,'Lucas Peixoto excluiu a tarefa <strong>Fazer flyers</strong>','2015-04-02 21:49:45'),(5,9,2,3,'<strong>Lucas Peixoto</strong> mudou o a tarefa <a href=\"http://localhost/eva/cronograma/editarTarefa/3\">Desfazer as malas</a> para <strong>Aberta</strong>.','2015-04-02 21:54:15'),(6,9,2,3,'<strong>Lucas Peixoto</strong> mudou o a tarefa <a href=\"http://localhost/eva/cronograma/editarTarefa/3\">Desfazer as malas</a> para <strong></strong>.','2015-04-02 21:54:28'),(7,9,2,3,'<strong>Lucas Peixoto</strong> mudou o a tarefa <a href=\"http://localhost/eva/cronograma/editarTarefa/3\">Desfazer as malas</a> (atribuída a <strong></strong>) para <strong>Fechada</strong>.','2015-04-02 22:17:41'),(8,9,2,3,'<strong>Lucas Peixoto</strong> mudou o a tarefa <a href=\"http://localhost/eva/cronograma/editarTarefa/3\">Desfazer as malas</a> (atribuída a <strong></strong>) para <strong>Fechada</strong>.','2015-04-02 22:18:00'),(9,9,2,7,'<strong>Lucas Peixoto</strong> criou uma nova tarefa: <strong>Comer</strong> (atribuída a <strong>Lucas Peixoto</strong>).','2015-04-02 22:21:00'),(10,9,2,5,'<strong>Lucas Peixoto</strong> mudou o a tarefa <strong>Comer muito mais</strong> (atribuída a <strong>Lucas Peixoto</strong>) para <strong>Executando</strong>.','2015-04-02 22:21:12'),(11,9,2,7,'<strong>Lucas Peixoto</strong> mudou o a tarefa <strong>Tomar banho</strong> (atribuída a <strong>Lucas Peixoto</strong>) para <strong>Concluída</strong>.','2015-04-02 22:21:21'),(12,9,2,5,'<strong>Lucas Peixoto</strong> mudou a tarefa <strong>Comer muito mais</strong> (atribuída a <strong>Lucas Peixoto</strong>) para <strong>Executando</strong>.','2015-04-02 22:46:18'),(13,9,2,6,'<strong>Lucas Peixoto</strong> mudou a tarefa <strong>Comer</strong> (atribuída a <strong>Lucas Peixoto</strong>) para <strong>Aberta</strong>.','2015-04-02 22:46:23'),(14,9,2,7,'<strong>Lucas Peixoto</strong> mudou a tarefa <strong>Tomar banho</strong> (atribuída a <strong>Lucas Peixoto</strong>) para <strong>Concluída</strong>.','2015-04-02 22:46:30'),(15,9,2,6,'<strong>Lucas Peixoto</strong> mudou a tarefa <strong>Comer</strong> (atribuída a <strong>Lucas Peixoto</strong>) para <strong>Aberta</strong>.','2015-04-02 23:02:33'),(16,9,2,5,'<strong>Lucas Peixoto</strong> excluiu a tarefa <strong>Comer muito mais</strong>','2015-04-02 23:02:39'),(17,9,2,3,'<strong>Lucas Peixoto</strong> mudou a tarefa <a href=\"base_urliniciacao/editarTarefa/3\"><strong>Desfazer as malas</a></strong> (atribuída a <strong>Lucas Peixoto</strong>) para <strong>Aberta</strong>.','2015-04-02 23:08:13'),(18,9,2,8,'<strong>Lucas Peixoto</strong> criou uma nova tarefa: <a href=\"base_urliniciacao/editarTarefa/8\"><strong>Lavar roupa</a></strong> (atribuída a <strong>Lucas Peixoto</strong>).','2015-04-02 23:08:30'),(19,9,2,6,'<strong>Lucas Peixoto</strong> mudou a tarefa <a href=\"base_urliniciacao/editarTarefa/6\">Jantar</a> (atribuída a <strong>Lucas Peixoto</strong>) para <strong>Aberta</strong>.','2015-04-02 23:09:28'),(20,9,2,6,'<strong>Lucas Peixoto</strong> mudou a tarefa <a href=\"base_urliniciacao/editarTarefa/6\">Jantar</a> (atribuída a <strong>Lucas Peixoto</strong>) para <strong></strong>.','2015-04-02 23:09:47'),(21,9,2,6,'<strong>Lucas Peixoto</strong> mudou a tarefa <a href=\"base_urliniciacao/editarTarefa/6\">Jantar</a> (atribuída a <strong>Lucas Peixoto</strong>) para <strong></strong>.','2015-04-14 02:11:37'),(22,9,2,6,'<strong>Lucas Peixoto</strong> mudou a tarefa <a href=\"base_urliniciacao/editarTarefa/6\">Jantar</a> (atribuída a <strong>Lucas Peixoto</strong>) para <strong></strong>.','2015-04-14 02:15:03'),(23,9,2,9,'<strong>Lucas Peixoto</strong> criou uma nova tarefa: <a href=\"base_urliniciacao/editarTarefa/9\">Verificar instalações</a> (atribuída a <strong>Lucas Peixoto</strong>).','2015-04-16 23:22:56'),(24,9,2,10,'<strong>admin</strong> criou uma nova tarefa: <a href=\"base_urliniciacao/editarTarefa/10\"></a> (atribuída a <strong>admin</strong>).','2015-05-04 23:33:05'),(25,9,2,11,'<strong>admin</strong> criou uma nova tarefa: <a href=\"base_urliniciacao/editarTarefa/11\">Divulgação da peça Arte slide/insert</a> (atribuída a <strong>admin</strong>).','2015-05-04 23:34:16'),(26,9,2,12,'<strong>admin</strong> criou uma nova tarefa: <a href=\"base_urliniciacao/editarTarefa/12\">Adquirir o item </a> (atribuída a <strong>admin</strong>).','2015-05-04 23:39:41'),(27,9,2,13,'<strong>admin</strong> criou uma nova tarefa: <a href=\"base_urliniciacao/editarTarefa/13\">Adquirir o item Aluguel de vaga/ Garagem</a> (atribuída a <strong>admin</strong>).','2015-05-04 23:40:25'),(28,9,2,14,'<strong>admin</strong> criou uma nova tarefa: <a href=\"base_urliniciacao/editarTarefa/14\">Adquirir o item Água</a> (atribuída a <strong>admin</strong>).','2015-05-04 23:41:00'),(29,9,2,15,'<strong>admin</strong> criou uma nova tarefa: <a href=\"base_urliniciacao/editarTarefa/15\">Adquirir o item Contribuição Patronal</a> (atribuída a <strong>admin</strong>).','2015-05-05 00:04:09'),(30,9,2,16,'<strong>admin</strong> criou uma nova tarefa: <a href=\"base_urliniciacao/editarTarefa/16\">Adquirir o item Direitos Autorais</a> (atribuída a <strong>admin</strong>).','2015-05-05 00:16:31'),(31,9,2,13,'<strong>admin</strong> mudou a tarefa <a href=\"base_urliniciacao/editarTarefa/13\">Adquirir o item Aluguel de vaga/ Garagem</a> (atribuída a <strong>admin</strong>) para <strong>Aprovada</strong>.','2015-05-05 21:47:32'),(32,9,2,10,'<strong>admin</strong> mudou a tarefa <a href=\"base_urliniciacao/editarTarefa/10\">Divulgação da peça Apostila</a> (atribuída a <strong>admin</strong>) para <strong>Aberta</strong>.','2015-05-05 21:48:43'),(33,9,2,7,'<strong>admin</strong> mudou a tarefa <a href=\"base_urliniciacao/editarTarefa/7\">Tomar banho</a> (atribuída a <strong>admin</strong>) para <strong>Concluída</strong>.','2015-05-05 21:48:50'),(34,9,2,3,'<strong>admin</strong> mudou a tarefa <a href=\"base_urliniciacao/editarTarefa/3\">Desfazer as malas</a> (atribuída a <strong>admin</strong>) para <strong>Aberta</strong>.','2015-05-05 21:51:49'),(35,9,2,6,'<strong>admin</strong> mudou a tarefa <a href=\"base_urliniciacao/editarTarefa/6\">Jantar</a> (atribuída a <strong>admin</strong>) para <strong></strong>.','2015-05-05 21:52:07'),(36,9,2,7,'<strong>admin</strong> mudou a tarefa <a href=\"base_urliniciacao/editarTarefa/7\">Tomar banho</a> (atribuída a <strong>admin</strong>) para <strong>Concluída</strong>.','2015-05-05 21:52:15'),(37,9,2,7,'<strong>admin</strong> mudou a tarefa <a href=\"base_urliniciacao/editarTarefa/7\">Tomar banho</a> (atribuída a <strong>admin</strong>) para <strong class=\"corSituacaoTarefa\">Executando</strong>.','2015-05-05 22:16:41'),(38,9,2,7,'<strong>admin</strong> mudou a tarefa <a href=\"base_urliniciacao/editarTarefa/7\">Tomar banho</a> (atribuída a <strong>admin</strong>) para <strong class=\"corSituacaoTarefa\">Concluída</strong>.','2015-05-05 22:16:50'),(39,9,2,6,'<strong>admin</strong> mudou a tarefa <a href=\"base_urliniciacao/editarTarefa/6\">Jantar</a> (atribuída a <strong>admin</strong>) para <strong class=\"corSituacaoTarefa\">Aprovada</strong>.','2015-05-05 22:16:55'),(40,9,2,3,'<a href=\"base_urlevento/perfil/9\">admin</a> mudou a tarefa <a href=\"base_urliniciacao/editarTarefa/3\">Desfazer as malas</a> para <strong class=\"corSituacaoTarefa\">Aberta</strong> (atribuída a <a href=\"base_urlevento/perfil/10\">Lucas Peixoto</a>).','2015-05-05 22:19:18'),(41,9,2,8,'<a href=\"base_urlevento/perfil/9\">admin</a> mudou a tarefa <a href=\"base_urliniciacao/editarTarefa/8\">Lavar roupa</a> para <strong class=\"corSituacaoTarefa\">Concluída</strong> (atribuída a <a href=\"base_urlevento/perfil/11\">Gabriele Evaristo</a>).','2015-05-05 22:19:22'),(42,9,2,17,'<strong>admin</strong> criou uma nova tarefa: <a href=\"base_urliniciacao/editarTarefa/17\">Teste</a> (atribuída a <strong>Lucas Peixoto</strong>).','2015-05-05 22:20:02'),(43,9,2,18,'<a href=\"base_urlevento/perfil/9\">admin</a> criou uma nova tarefa: <a href=\"base_urliniciacao/editarTarefa/18\">Teste</a> (atribuída a <a href=\"base_urlevento/perfil/10\">Lucas Peixoto</a>, prioridade <strong class=\"corPrioridadeTarefa\">Alta</strong>).','2015-05-05 22:22:31'),(44,9,2,19,'<a href=\"base_urlevento/perfil/9\">admin</a> criou uma nova tarefa: <a href=\"base_urliniciacao/editarTarefa/19\">Tes</a> (atribuída a <a href=\"base_urlevento/perfil/11\">Gabriele Evaristo</a>, prioridade <strong class=\"corPrioridadeTarefa\">Urgente</strong>).','2015-05-05 22:22:39'),(45,9,2,20,'<a href=\"base_urlevento/perfil/9\">admin</a> criou uma nova tarefa: <a href=\"base_urliniciacao/editarTarefa/20\">Teste</a> (atribuída a <a href=\"base_urlevento/perfil/10\">Lucas Peixoto</a>, prioridade <strong class=\"corPrioridadeTarefa\">Normal</strong>).','2015-05-05 22:22:51'),(46,9,2,NULL,'<a href=\"base_urlevento/perfil/9\">admin</a> removeu a atração <a href=\"base_urlevento/atracao/2\">Curta metragem</a>.','2015-05-06 12:05:41'),(47,9,2,NULL,'<a href=\"base_urlevento/perfil/9\">admin</a> selecionou a atração <a href=\"base_urlevento/atracao/2\">Curta metragem</a>.','2015-05-06 12:05:46'),(48,9,2,NULL,'<a href=\"base_urlevento/perfil/9\">admin</a> marcou uma apresentação da atração <a href=\"base_urlevento/atracao/2\">Curta metragem</a> no local <a href=\"base_urlevento/local/8\">Palco 2</a>.','2015-05-06 12:18:41'),(49,9,2,NULL,'<a href=\"base_urlevento/perfil/9\">admin</a> editou a apresentação da atração <a href=\"base_urlevento/atracao/2\">Curta metragem</a> no local <a href=\"base_urlevento/local/8\">Palco 2</a>.','2015-05-06 12:18:51'),(50,9,2,NULL,'<a href=\"base_urlevento/perfil/9\">admin</a> excluiu a apresentação da atração <a href=\"base_urlevento/atracao/2\">Curta metragem</a> no local <a href=\"base_urlevento/local/8\">Palco 2</a>.','2015-05-06 12:18:55'),(51,9,2,NULL,'<a href=\"base_urlevento/perfil/9\">admin</a> excluiu a apresentação da atração <a href=\"base_urlevento/atracao/2\">Curta metragem</a> no local <a href=\"base_urlevento/local/8\">Palco 2</a>.','2015-05-06 12:18:58'),(52,9,2,NULL,'<a href=\"base_urlevento/perfil/9\">admin</a> cadastrou um deslocamento para a atração <a href=\"base_urlevento/atracao/3\">Teatro Infantil</a>.','2015-05-06 12:26:33'),(53,9,2,NULL,'<a href=\"base_urlevento/perfil/9\">admin</a> editou um deslocamento da atração <a href=\"base_urlevento/atracao/3\">Teatro Infantil</a>.','2015-05-06 12:26:37'),(54,9,2,NULL,'<a href=\"base_urlevento/perfil/9\">admin</a> excluiu um deslocamento da atração <a href=\"base_urlevento/atracao/2\">Curta metragem</a>.','2015-05-06 12:26:43'),(55,9,2,NULL,'<a href=\"base_urlevento/perfil/9\">admin</a> cadastrou um deslocamento para a atração <a href=\"base_urlevento/atracao/2\">Curta metragem</a>.','2015-05-06 12:27:26'),(56,9,2,NULL,'<a href=\"base_urlevento/perfil/9\">admin</a> cadastrou uma acomodação para a atração <a href=\"base_urlevento/atracao/3\">Teatro Infantil</a>.','2015-05-06 12:31:24'),(57,9,2,NULL,'<a href=\"base_urlevento/perfil/9\">admin</a> editou uma acomodação da atração <a href=\"base_urlevento/atracao/2\">Curta metragem</a>.','2015-05-06 12:31:27'),(58,9,2,NULL,'<a href=\"base_urlevento/perfil/9\">admin</a> excluiu uma acomodação da atração <a href=\"base_urlevento/atracao/2\">Curta metragem</a>.','2015-05-06 12:31:29'),(59,9,2,20,'<strong>admin</strong> excluiu a tarefa <strong>Teste</strong>.','2015-05-07 01:05:17'),(60,9,2,3,'<span class=\"glyphicon glyphicon-time\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> mudou a tarefa <a href=\"base_urliniciacao/editarTarefa/3\">Desfazer as malas</a> para <strong class=\"corSituacaoTarefa\">Aberta</strong> (atribuída a <a href=\"base_urlevento/perfil/10\">Lucas Peixoto</a>).','2015-05-07 01:05:19'),(61,9,NULL,7,'<span class=\"glyphicon glyphicon-time\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> excluiu a tarefa .','2015-05-07 01:08:34'),(62,9,2,17,'<span class=\"glyphicon glyphicon-time\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> excluiu a tarefa Teste.','2015-05-07 01:08:39'),(63,9,2,21,'<span class=\"glyphicon glyphicon-time\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> criou uma nova tarefa: <a href=\"base_urliniciacao/editarTarefa/21\">Divulgação da peça Anúncio de Rodapé</a> (atribuída a <a href=\"base_urlevento/perfil/9\">admin</a>, prioridade <strong class=\"corPrioridadeTarefa\">Normal</strong>).','2015-05-07 01:10:46'),(64,9,2,NULL,'<span class=\"glyphicon glyphicon-apple\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> marcou uma apresentação da atração <a href=\"base_urlevento/atracao/2\">Curta metragem</a> no local <a href=\"base_urlevento/local/8\">Palco 2</a>.','2015-05-07 01:13:13'),(65,9,2,NULL,'<span class=\"glyphicon glyphicon-road\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> cadastrou um deslocamento para a atração <a href=\"base_urlevento/atracao/2\">Curta metragem</a>.','2015-05-07 01:13:47'),(66,9,2,NULL,'<span class=\"glyphicon glyphicon-home\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> cadastrou uma acomodação para a atração <a href=\"base_urlevento/atracao/2\">Curta metragem</a>.','2015-05-07 01:14:06'),(67,9,2,NULL,'<span class=\"glyphicon glyphicon-home\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> editou uma acomodação da atração <a href=\"base_urlevento/atracao/3\">Teatro Infantil</a>.','2015-05-07 01:43:30'),(68,9,2,22,'<span class=\"glyphicon glyphicon-time\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> criou uma nova tarefa: <a href=\"base_urliniciacao/showTarefa/22\">Com link</a> (atribuída a <a href=\"base_urlevento/perfil/11\">Gabriele Evaristo</a>, prioridade <strong class=\"corPrioridadeTarefa\"></strong>).','2015-05-07 21:37:51'),(69,9,2,22,'<span class=\"glyphicon glyphicon-time\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> mudou a tarefa <a href=\"base_urliniciacao/showTarefa/22\">Com link</a> para <strong class=\"corSituacaoTarefa\">Concluída</strong> (atribuída a <a href=\"base_urlevento/perfil/11\">Gabriele Evaristo</a>).','2015-05-07 21:38:07'),(70,9,2,NULL,'<span class=\"glyphicon glyphicon-apple\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> marcou a <a href=\"base_urlplanejamento/showApresentacao/9\">apresentação</a> para atração <a href=\"base_urlevento/atracao/3\">Teatro Infantil</a> no local <a href=\"base_urlevento/local/8\">Palco 2</a>.','2015-05-07 21:38:23'),(71,9,2,NULL,'<span class=\"glyphicon glyphicon-apple\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> editou a <a href=\"base_urlplanejamento/showApresentacao/9\">apresentação</a> da atração <a href=\"base_urlevento/atracao/3\">Teatro Infantil</a> no local <a href=\"base_urlevento/local/8\">Palco 2</a>.','2015-05-07 21:38:26'),(72,9,2,NULL,'<span class=\"glyphicon glyphicon-road\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> cadastrou o <a href=\"base_urlplanejamento/showDeslocamento/6\">deslocamento</a> para a atração <a href=\"base_urlevento/atracao/2\">Curta metragem</a>.','2015-05-07 21:38:52'),(73,9,2,NULL,'<span class=\"glyphicon glyphicon-road\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> editou o <a href=\"base_urlplanejamento/showDeslocamento/4\">deslocamento</a> da atração <a href=\"base_urlevento/atracao/3\">Teatro Infantil</a>.','2015-05-07 21:38:57'),(74,9,2,NULL,'<span class=\"glyphicon glyphicon-home\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> cadastrou a <a href=\"base_urlplanejamento/showAcomodacao/5\">acomodação</a> para a atração <a href=\"base_urlevento/atracao/2\">Curta metragem</a>.','2015-05-07 21:39:12'),(75,9,2,NULL,'<span class=\"glyphicon glyphicon-home\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> editou a <a href=\"base_urlplanejamento/showAcomodacao/3\">acomodação</a> da atração <a href=\"base_urlevento/atracao/3\">Teatro Infantil</a>.','2015-05-07 21:39:16'),(76,9,2,12,'<span class=\"glyphicon glyphicon-time\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> mudou a tarefa <a href=\"base_urliniciacao/showTarefa/12\">Adquirir o item </a> para <strong class=\"corSituacaoTarefa\">Aberta</strong> (atribuída a <a href=\"base_urlevento/perfil/9\">admin</a>).','2015-05-07 22:20:18'),(77,9,2,NULL,'<span class=\"glyphicon glyphicon-home\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> excluiu uma acomodação da atração <a href=\"base_urlevento/atracao/3\">Teatro Infantil</a>.','2015-05-07 23:47:27'),(78,9,2,NULL,'<span class=\"glyphicon glyphicon-home\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> excluiu uma acomodação da atração <a href=\"base_urlevento/atracao/2\">Curta metragem</a>.','2015-05-07 23:47:34'),(79,9,2,NULL,'<span class=\"glyphicon glyphicon-road\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> excluiu um deslocamento da atração <a href=\"base_urlevento/atracao/2\">Curta metragem</a>.','2015-05-12 12:01:36'),(80,9,2,NULL,'<span class=\"glyphicon glyphicon-road\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> excluiu um deslocamento da atração <a href=\"base_urlevento/atracao/2\">Curta metragem</a>.','2015-05-12 12:01:38'),(81,9,2,19,'<span class=\"glyphicon glyphicon-time\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> mudou a tarefa <a href=\"base_urliniciacao/showTarefa/19\">Tes</a> para <strong class=\"corSituacaoTarefa\"></strong> (atribuída a <a href=\"base_urlevento/perfil/11\">Gabriele Evaristo</a>).','2015-05-12 12:07:12'),(82,9,2,22,'<span class=\"glyphicon glyphicon-time\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> mudou a tarefa <a href=\"base_urliniciacao/showTarefa/22\">Com link</a> para <strong class=\"corSituacaoTarefa\">Concluída</strong> (atribuída a <a href=\"base_urlevento/perfil/11\">Gabriele Evaristo</a>).','2015-05-12 12:07:29'),(83,9,2,18,'<span class=\"glyphicon glyphicon-time\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> mudou a tarefa <a href=\"base_urliniciacao/showTarefa/18\">Teste</a> para <strong class=\"corSituacaoTarefa\"></strong> (atribuída a <a href=\"base_urlevento/perfil/10\">Lucas Peixoto</a>).','2015-05-12 12:07:36'),(84,9,2,12,'<span class=\"glyphicon glyphicon-time\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> mudou a tarefa <a href=\"base_urliniciacao/showTarefa/12\">Adquirir o item </a> para <strong class=\"corSituacaoTarefa\">Aberta</strong> (atribuída a <a href=\"base_urlevento/perfil/9\">admin</a>).','2015-05-12 12:07:42'),(85,9,2,10,'<span class=\"glyphicon glyphicon-time\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> mudou a tarefa <a href=\"base_urliniciacao/showTarefa/10\">Divulgação da peça Apostila</a> para <strong class=\"corSituacaoTarefa\">Aberta</strong> (atribuída a <a href=\"base_urlevento/perfil/9\">admin</a>).','2015-05-12 12:07:48'),(86,9,2,9,'<span class=\"glyphicon glyphicon-time\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> mudou a tarefa <a href=\"base_urliniciacao/showTarefa/9\">Verificar instalações</a> para <strong class=\"corSituacaoTarefa\">Executando</strong> (atribuída a <a href=\"base_urlevento/perfil/9\">admin</a>).','2015-05-12 12:08:01'),(87,9,2,8,'<span class=\"glyphicon glyphicon-time\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> mudou a tarefa <a href=\"base_urliniciacao/showTarefa/8\">Lavar roupa</a> para <strong class=\"corSituacaoTarefa\">Concluída</strong> (atribuída a <a href=\"base_urlevento/perfil/11\">Gabriele Evaristo</a>).','2015-05-12 12:08:06'),(88,9,2,3,'<span class=\"glyphicon glyphicon-time\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> mudou a tarefa <a href=\"base_urliniciacao/showTarefa/3\">Desfazer as malas</a> para <strong class=\"corSituacaoTarefa\">Aberta</strong> (atribuída a <a href=\"base_urlevento/perfil/10\">Lucas Peixoto</a>).','2015-05-12 12:08:12'),(89,9,2,NULL,'<span class=\"glyphicon glyphicon-road\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> cadastrou o <a href=\"base_urlplanejamento/showDeslocamento/7\">deslocamento</a> para a atração <a href=\"base_urlevento/atracao/2\">Curta metragem</a>.','2015-05-12 12:08:40'),(90,9,2,NULL,'<span class=\"glyphicon glyphicon-home\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> excluiu uma acomodação da atração <a href=\"base_urlevento/atracao/2\">Curta metragem</a>.','2015-05-12 12:11:32'),(91,9,2,NULL,'<span class=\"glyphicon glyphicon-home\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> cadastrou a <a href=\"base_urlplanejamento/showAcomodacao/5\">acomodação</a> para a atração <a href=\"base_urlevento/atracao/2\">Curta metragem</a>.','2015-05-12 12:13:55'),(92,9,2,3,'<span class=\"glyphicon glyphicon-time\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> mudou a tarefa <a href=\"base_urliniciacao/showTarefa/3\">Desfazer as malas</a> para <strong class=\"corSituacaoTarefa\">Aberta</strong> (atribuída a <a href=\"base_urlevento/perfil/9\">admin</a>).','2015-05-26 20:42:50'),(93,9,2,18,'<span class=\"glyphicon glyphicon-time\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/9\">admin</a> mudou a tarefa <a href=\"base_urliniciacao/showTarefa/18\">Teste</a> para <strong class=\"corSituacaoTarefa\"></strong> (atribuída a <a href=\"base_urlevento/perfil/9\">admin</a>).','2015-05-26 20:42:54'),(94,10,3,NULL,'<span class=\"glyphicon glyphicon-apple\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/10\">Lucas Peixoto</a> selecionou a atração <a href=\"base_urlevento/atracao/4\">Curta metragem</a>.','2015-05-27 12:06:04'),(95,10,3,NULL,'<span class=\"glyphicon glyphicon-apple\" aria-hidden=\"true\"></span> <a href=\"base_urlevento/perfil/10\">Lucas Peixoto</a> marcou a <a href=\"base_urlplanejamento/showApresentacao/10\">apresentação</a> para atração <a href=\"base_urlevento/atracao/4\">Curta metragem</a> no local <a href=\"base_urlevento/local/9\">O Teatro das sombras ocultas da morte</a>.','2015-05-27 12:06:31'),(96,9,2,NULL,'<i class=\"fa fa-users\"></i> <a href=\"base_urlevento/perfil/9\">admin</a> marcou uma reunião: <a href=\"base_urlevento/showReuniao/4\">yryry</a>, para o dia 06/06/2015.','2015-06-06 17:32:14'),(97,9,2,NULL,'<i class=\"fa fa-users\"></i> <a href=\"base_urlevento/perfil/9\">admin</a> editou a reunião: <a href=\"base_urlevento/showReuniao/\">yryry</a>, do dia 06/06/2015.','2015-06-06 17:32:29'),(98,9,2,NULL,'<i class=\"fa fa-users\"></i> <a href=\"base_urlevento/perfil/9\">admin</a> editou a reunião: <a href=\"base_urlevento/showReuniao/3\">reuniao</a>, do dia 06/06/2015.','2015-06-06 17:33:26'),(99,9,2,NULL,'<i class=\"fa fa-users\"></i> <a href=\"base_urlevento/perfil/9\">admin</a> excluiu a reunião: , do dia .','2015-06-06 17:33:33'),(100,9,2,NULL,'<i class=\"fa fa-users\"></i> <a href=\"base_urlevento/perfil/9\">admin</a> excluiu a reunião: yryry, do dia 06/06/2015.','2015-06-06 17:34:17'),(101,9,2,NULL,'<i class=\"fa fa-users\"></i> <a href=\"base_urlevento/perfil/9\">admin</a> editou a reunião: <a href=\"base_urlevento/showReuniao/2\">Reuniao final</a>, do dia 07/06/2015.','2015-06-06 17:47:56'),(102,9,2,NULL,'<i class=\"fa fa-users\"></i> <a href=\"base_urlevento/perfil/9\">admin</a> editou a reunião: <a href=\"base_urlevento/showReuniao/2\">Reuniao final</a>, do dia 06/06/2015.','2015-06-06 17:57:24'),(103,9,2,NULL,'<i class=\"fa fa-users\"></i> <a href=\"base_urlevento/perfil/9\">admin</a> editou a reunião: <a href=\"base_urlevento/showReuniao/2\">Reuniao final</a>, do dia 06/06/2015.','2015-06-06 18:11:07'),(104,9,2,NULL,'<i class=\"fa fa-users\"></i> <a href=\"base_urlevento/perfil/9\">admin</a> editou a reunião: <a href=\"base_urlevento/showReuniao/2\">Reuniao final</a>, do dia 06/06/2015.','2015-06-06 18:11:16'),(105,9,2,NULL,'<i class=\"fa fa-users\"></i> <a href=\"base_urlevento/perfil/9\">admin</a> editou a reunião: <a href=\"base_urlevento/showReuniao/2\">Reuniao final</a>, do dia 06/06/2015.','2015-06-06 18:11:24'),(106,9,3,NULL,'<i class=\"fa fa-users\"></i> <a href=\"base_urlevento/perfil/9\">admin</a> marcou uma reunião: <a href=\"base_urlevento/showReuniao/3\">123123</a>, para o dia 24/06/2015.','2015-06-24 23:14:47');
/*!40000 ALTER TABLE `tbl_atividade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_atracao`
--

DROP TABLE IF EXISTS `tbl_atracao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_atracao` (
  `atr_id` int(11) NOT NULL AUTO_INCREMENT,
  `atr_pro_id` int(11) DEFAULT NULL,
  `atr_eve_id` int(11) DEFAULT NULL,
  `atr_selecionado` varchar(1) DEFAULT NULL,
  `atr_transporte` varchar(1) DEFAULT NULL,
  `atr_alimentacao` varchar(1) DEFAULT NULL,
  `atr_hospedagem` varchar(1) DEFAULT NULL,
  `atr_solidaria` varchar(1) DEFAULT NULL,
  `atr_custo` float(11,2) DEFAULT NULL,
  `atr_observacao` text,
  `atr_criado_em` timestamp NULL DEFAULT NULL,
  `atr_modificado_em` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`atr_id`),
  KEY `atracao_produto_id_idx` (`atr_pro_id`),
  KEY `atracao_evento_id_idx` (`atr_eve_id`),
  CONSTRAINT `atracao_evento_id` FOREIGN KEY (`atr_eve_id`) REFERENCES `tbl_evento` (`eve_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `atracao_produto_id` FOREIGN KEY (`atr_pro_id`) REFERENCES `tbl_produto` (`pro_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_atracao`
--

LOCK TABLES `tbl_atracao` WRITE;
/*!40000 ALTER TABLE `tbl_atracao` DISABLE KEYS */;
INSERT INTO `tbl_atracao` VALUES (2,1,2,'1','2','1','1','0',2600.00,'cache negociavel','2015-04-10 00:28:19','2015-06-13 13:36:51'),(3,2,2,'1','1','0','0','1',100.00,'somos legais','2015-04-10 00:32:04','2015-04-10 00:32:04'),(4,1,3,'1','2','1','0','1',0.00,'','2015-05-27 12:05:36','2015-06-13 13:37:52'),(5,1,6,'0','0','0','0','0',1.23,'','2015-06-24 23:19:36','2015-06-24 23:19:36');
/*!40000 ALTER TABLE `tbl_atracao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_atuacao`
--

DROP TABLE IF EXISTS `tbl_atuacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_atuacao` (
  `atu_id` int(11) NOT NULL AUTO_INCREMENT,
  `atu_obj_id` int(11) DEFAULT NULL,
  `atu_are_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`atu_id`),
  KEY `atuacao_area_id_idx` (`atu_are_id`),
  KEY `atuacao_objeto_id_idx` (`atu_obj_id`),
  CONSTRAINT `atuacao_area_id` FOREIGN KEY (`atu_are_id`) REFERENCES `tbl_area` (`are_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `atuacao_objeto_id` FOREIGN KEY (`atu_obj_id`) REFERENCES `tbl_objeto` (`obj_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=319 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_atuacao`
--

LOCK TABLES `tbl_atuacao` WRITE;
/*!40000 ALTER TABLE `tbl_atuacao` DISABLE KEYS */;
INSERT INTO `tbl_atuacao` VALUES (292,1,6),(293,1,22),(294,1,26),(295,1,29),(305,10,20),(311,9,15),(315,3,4),(316,3,24),(318,2,7);
/*!40000 ALTER TABLE `tbl_atuacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_custo`
--

DROP TABLE IF EXISTS `tbl_custo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_custo` (
  `cus_id` int(11) NOT NULL AUTO_INCREMENT,
  `cus_eve_id` int(11) DEFAULT NULL,
  `cus_ite_id` int(11) DEFAULT NULL,
  `cus_tipo` varchar(1) DEFAULT NULL COMMENT '1 - Preproducao',
  `cus_valor` float(11,2) DEFAULT NULL,
  `cus_descricao` text,
  `cus_criado_em` timestamp NULL DEFAULT NULL,
  `cus_modificado_em` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cus_id`),
  KEY `custo_evento_id_idx` (`cus_eve_id`),
  KEY `custo_item_id_idx` (`cus_ite_id`),
  CONSTRAINT `custo_evento_id` FOREIGN KEY (`cus_eve_id`) REFERENCES `tbl_evento` (`eve_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `custo_item_id` FOREIGN KEY (`cus_ite_id`) REFERENCES `tbl_item` (`ite_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_custo`
--

LOCK TABLES `tbl_custo` WRITE;
/*!40000 ALTER TABLE `tbl_custo` DISABLE KEYS */;
INSERT INTO `tbl_custo` VALUES (1,2,450,'1',2000.00,'Descricao maluca','2015-03-31 21:12:21','2015-03-31 21:54:33'),(3,2,253,'1',300.00,'','2015-03-31 21:28:42','2015-03-31 21:28:42'),(5,2,509,'2',350.00,'roxo','2015-04-08 01:25:59','2015-04-08 01:31:03'),(6,2,256,'1',360.00,'4 pontas','2015-05-04 23:39:41','2015-05-04 23:39:41'),(7,2,269,'1',123.33,'','2015-05-04 23:40:24','2015-05-04 23:40:24'),(8,2,510,'2',35.00,'gelada','2015-05-04 23:40:59','2015-05-04 23:40:59'),(9,2,933,'4',3600.00,'teste','2015-05-05 00:04:08','2015-05-05 00:04:39'),(10,2,934,'4',250.00,'','2015-05-05 00:16:31','2015-05-05 00:16:31'),(11,2,936,'4',56.00,'','2015-05-05 00:17:00','2015-05-05 00:17:00');
/*!40000 ALTER TABLE `tbl_custo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_deslocamento`
--

DROP TABLE IF EXISTS `tbl_deslocamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_deslocamento` (
  `des_id` int(11) NOT NULL AUTO_INCREMENT,
  `des_atr_id` int(11) DEFAULT NULL,
  `des_eve_id` int(11) DEFAULT NULL,
  `des_mot_id` int(11) DEFAULT NULL,
  `des_vei_id` int(11) DEFAULT NULL,
  `des_origem` text,
  `des_destino` text,
  `des_saida` timestamp NULL DEFAULT NULL,
  `des_chegada` timestamp NULL DEFAULT NULL,
  `des_observacao` text,
  `des_criado_em` timestamp NULL DEFAULT NULL,
  `des_modificado_em` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`des_id`),
  KEY `desloc_atracao_id_idx` (`des_atr_id`),
  KEY `desloc_evento_id_idx` (`des_eve_id`),
  KEY `desloc_motor_id_idx` (`des_mot_id`),
  KEY `desloc_veiculo_id_idx` (`des_vei_id`),
  CONSTRAINT `desloc_atracao_id` FOREIGN KEY (`des_atr_id`) REFERENCES `tbl_atracao` (`atr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `desloc_evento_id` FOREIGN KEY (`des_eve_id`) REFERENCES `tbl_evento` (`eve_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `desloc_motor_id` FOREIGN KEY (`des_mot_id`) REFERENCES `tbl_motorista` (`mot_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `desloc_veiculo_id` FOREIGN KEY (`des_vei_id`) REFERENCES `tbl_veiculo` (`vei_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_deslocamento`
--

LOCK TABLES `tbl_deslocamento` WRITE;
/*!40000 ALTER TABLE `tbl_deslocamento` DISABLE KEYS */;
INSERT INTO `tbl_deslocamento` VALUES (3,3,2,1,1,'Rua Doutor João de Azevedo - de 148, 697 - Centro - Centro - Itajubá - MG - CEP: 37500020','Rua Cachoeira Paulista, 123 -  - Cidade Salvador - Jacareí - SP - CEP: 12312290','2015-05-06 13:00:00','2015-05-07 13:00:00','','2015-05-06 12:26:33','2015-05-06 12:26:37'),(4,3,2,1,1,'Rua Cachoeira Paulista, 123 - 123 - Cidade Salvador - Jacareí - SP - CEP: 12312290','Rua Doutor João de Azevedo - de 148, 697 - Centro - Centro - Itajubá - MG - CEP: 37500020','2015-05-07 13:00:00','2010-05-07 13:00:00','','2015-05-06 12:27:26','2015-05-07 21:38:57'),(7,2,2,1,1,'Rua Doutor João de Azevedo - de 148, 697 - Centro - Centro - Itajubá - MG - CEP: 37500020','Rua Cachoeira Paulista, 123 - 123 - Cidade Salvador - Jacareí - SP - CEP: 12312290','2015-05-12 13:10:00','2015-05-12 13:10:00','','2015-05-12 12:08:40','2015-05-12 12:08:40');
/*!40000 ALTER TABLE `tbl_deslocamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_divulgacao`
--

DROP TABLE IF EXISTS `tbl_divulgacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_divulgacao` (
  `div_id` int(11) NOT NULL AUTO_INCREMENT,
  `div_eve_id` int(11) DEFAULT NULL,
  `div_pec_id` int(11) DEFAULT NULL,
  `div_mei_id` int(11) DEFAULT NULL,
  `div_valor` float(11,2) DEFAULT NULL,
  `div_descricao` text,
  `div_criado_em` timestamp NULL DEFAULT NULL,
  `div_modificado_em` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`div_id`),
  KEY `divulg_evento_id_idx` (`div_eve_id`),
  KEY `divulg_peca_id_idx` (`div_pec_id`),
  KEY `divulg_meio_id_idx` (`div_mei_id`),
  CONSTRAINT `divulg_evento_id` FOREIGN KEY (`div_eve_id`) REFERENCES `tbl_evento` (`eve_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `divulg_meio_id` FOREIGN KEY (`div_mei_id`) REFERENCES `tbl_meio` (`mei_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `divulg_peca_id` FOREIGN KEY (`div_pec_id`) REFERENCES `tbl_peca` (`pec_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_divulgacao`
--

LOCK TABLES `tbl_divulgacao` WRITE;
/*!40000 ALTER TABLE `tbl_divulgacao` DISABLE KEYS */;
INSERT INTO `tbl_divulgacao` VALUES (1,2,4,3,320.00,'desc','2015-04-01 12:22:35','2015-04-01 12:22:59'),(3,2,11,1,25.00,'','2015-04-01 12:25:22','2015-04-01 12:25:22'),(4,2,11,1,2.40,'caderinho','2015-05-04 23:33:05','2015-05-04 23:33:05'),(5,2,13,2,360.00,'123','2015-05-04 23:34:16','2015-05-04 23:34:16'),(6,2,10,5,1.23,'','2015-05-07 01:10:46','2015-05-07 01:10:46');
/*!40000 ALTER TABLE `tbl_divulgacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_encrypto`
--

DROP TABLE IF EXISTS `tbl_encrypto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_encrypto` (
  `enc_id` int(11) NOT NULL AUTO_INCREMENT,
  `enc_string` varchar(255) DEFAULT NULL,
  `enc_funcao` varchar(255) DEFAULT NULL,
  `enc_ativo` varchar(1) DEFAULT NULL,
  `enc_criado_em` timestamp NULL DEFAULT NULL,
  `enc_modificado_em` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`enc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_encrypto`
--

LOCK TABLES `tbl_encrypto` WRITE;
/*!40000 ALTER TABLE `tbl_encrypto` DISABLE KEYS */;
INSERT INTO `tbl_encrypto` VALUES (1,'767974f307453e6b305af06d5aec22275ab4b42c','iniciacao/cadastrarPapel/2/coordenador','0','2015-05-27 12:02:06','2015-05-27 12:02:06'),(2,'99a0da171ac698bad7e907fa2655bec55ee27aef','iniciacao/cadastrarPapel/3/coordenador','0','2015-05-27 12:03:41','2015-05-27 12:03:41');
/*!40000 ALTER TABLE `tbl_encrypto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_equipamento`
--

DROP TABLE IF EXISTS `tbl_equipamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_equipamento` (
  `equ_id` int(11) NOT NULL AUTO_INCREMENT,
  `equ_obj_id` int(11) DEFAULT NULL,
  `equ_endereco` varchar(255) DEFAULT NULL,
  `equ_numero` varchar(255) DEFAULT NULL,
  `equ_bairro` varchar(255) DEFAULT NULL,
  `equ_complemento` varchar(255) DEFAULT NULL,
  `equ_cidade` varchar(255) DEFAULT NULL,
  `equ_estado` varchar(2) DEFAULT NULL,
  `equ_cep` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`equ_id`),
  KEY `equip_objeto_id_idx` (`equ_obj_id`),
  CONSTRAINT `equip_objeto_id` FOREIGN KEY (`equ_obj_id`) REFERENCES `tbl_objeto` (`obj_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_equipamento`
--

LOCK TABLES `tbl_equipamento` WRITE;
/*!40000 ALTER TABLE `tbl_equipamento` DISABLE KEYS */;
INSERT INTO `tbl_equipamento` VALUES (1,1,'Rua Doutor João de Azevedo - de 148','697','Centro','Centro','Itajubá','MG','37500020'),(2,8,'Rua Cachoeira Paulista','123','Cidade Salvador','','Jacareí','SP','12312290');
/*!40000 ALTER TABLE `tbl_equipamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_evento`
--

DROP TABLE IF EXISTS `tbl_evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_evento` (
  `eve_id` int(11) NOT NULL AUTO_INCREMENT,
  `eve_obj_id` int(11) DEFAULT NULL,
  `eve_nome` varchar(255) DEFAULT NULL,
  `eve_descricao` text,
  `eve_proposta` text,
  `eve_justificativa` text,
  `eve_objetivo` text,
  `eve_acessibilidade` text,
  `eve_democratizacao` text,
  `eve_impacto_ambiental` text,
  `eve_publico_interesse` text,
  `eve_data_inicial` date DEFAULT NULL,
  `eve_data_final` date DEFAULT NULL,
  `eve_orcamento` float(11,2) DEFAULT NULL,
  `eve_publico` varchar(1) DEFAULT NULL,
  `eve_inscricao` varchar(1) DEFAULT NULL,
  `eve_finalizado` varchar(1) DEFAULT NULL,
  `eve_criado_em` timestamp NULL DEFAULT NULL,
  `eve_modificado_em` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`eve_id`),
  KEY `evento_objeto_id_idx` (`eve_obj_id`),
  CONSTRAINT `evento_objeto_id` FOREIGN KEY (`eve_obj_id`) REFERENCES `tbl_objeto` (`obj_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_evento`
--

LOCK TABLES `tbl_evento` WRITE;
/*!40000 ALTER TABLE `tbl_evento` DISABLE KEYS */;
INSERT INTO `tbl_evento` VALUES (2,3,'Teatro na Praça','Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo ','Proposta ','Justificativa','Objetivo','Acessibilidade','Democratização ','Impacto ','Público ','2015-04-13','2015-04-15',15500.00,'1','1','0','2015-03-24 01:45:55','2015-05-08 00:05:15'),(3,3,'Torneio de Magic','Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo ','','','','','','','','2015-04-03','2015-04-04',0.00,'0','1','0','2015-03-27 15:55:21','2015-05-27 12:05:27'),(4,7,'nome teste','$objId$objIdnimo de 100 caracteres. Máximo de 400 caracteresnimo de 100 caracteres. Máximo de 400 caracteresnimo de 100 caracteres. Máximo de 400 caracteresnimo de 100 caracteres. Máximo de 400 caracteresnimo de 100 caracteres. Máximo de 400 caracteresnimo de 100 caracteres. Máximo de 400 caracteresnimo de 100 caracteres. Máximo de 400 caracteresnimo de 100 caracteres. Máximo de 400 caracteres',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,'0','2015-04-06 19:36:20','2015-04-06 19:36:20'),(5,7,'nome teste','$objId$objIdnimo de 100 caracteres. Máximo de 400 caracteresnimo de 100 caracteres. Máximo de 400 caracteresnimo de 100 caracteres. Máximo de 400 caracteresnimo de 100 caracteres. Máximo de 400 caracteresnimo de 100 caracteres. Máximo de 400 caracteresnimo de 100 caracteres. Máximo de 400 caracteresnimo de 100 caracteres. Máximo de 400 caracteresnimo de 100 caracteres. Máximo de 400 caracteres',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,'0','2015-04-06 19:38:11','2015-04-06 19:38:11'),(6,3,'Festão da Galera','Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo ','','','','','','','','2015-06-24','2015-06-24',1.23,'1','1','0','2015-04-22 01:45:26','2015-06-24 23:19:23');
/*!40000 ALTER TABLE `tbl_evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_financiamento`
--

DROP TABLE IF EXISTS `tbl_financiamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_financiamento` (
  `fin_id` int(11) NOT NULL AUTO_INCREMENT,
  `fin_nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`fin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_financiamento`
--

LOCK TABLES `tbl_financiamento` WRITE;
/*!40000 ALTER TABLE `tbl_financiamento` DISABLE KEYS */;
INSERT INTO `tbl_financiamento` VALUES (2,'Orçamento próprio'),(3,'Agências públicas de fomento'),(4,'Leis de incentivo'),(5,'Patrocínio direto'),(6,'Convênios'),(7,'Sem financiamento'),(8,'Outro');
/*!40000 ALTER TABLE `tbl_financiamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_financiamento_objeto`
--

DROP TABLE IF EXISTS `tbl_financiamento_objeto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_financiamento_objeto` (
  `fio_id` int(11) NOT NULL AUTO_INCREMENT,
  `fio_fin_id` int(11) DEFAULT NULL,
  `fio_obj_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`fio_id`),
  KEY `finan_finan_id_idx` (`fio_fin_id`),
  KEY `finan_objeto_id_idx` (`fio_obj_id`),
  CONSTRAINT `finan_finan_id` FOREIGN KEY (`fio_fin_id`) REFERENCES `tbl_financiamento` (`fin_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `finan_objeto_id` FOREIGN KEY (`fio_obj_id`) REFERENCES `tbl_objeto` (`obj_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_financiamento_objeto`
--

LOCK TABLES `tbl_financiamento_objeto` WRITE;
/*!40000 ALTER TABLE `tbl_financiamento_objeto` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_financiamento_objeto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_hospedagem`
--

DROP TABLE IF EXISTS `tbl_hospedagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_hospedagem` (
  `hos_id` int(11) NOT NULL AUTO_INCREMENT,
  `hos_eve_id` int(11) DEFAULT NULL,
  `hos_nome` varchar(255) DEFAULT NULL,
  `hos_descricao` text,
  `hos_solidaria` varchar(1) DEFAULT NULL,
  `hos_lugares` int(11) DEFAULT NULL,
  `hos_email` varchar(255) DEFAULT NULL,
  `hos_telefone` varchar(11) DEFAULT NULL,
  `hos_celular1` varchar(11) DEFAULT NULL,
  `hos_celular2` varchar(11) DEFAULT NULL,
  `hos_endereco` varchar(255) DEFAULT NULL,
  `hos_numero` varchar(255) DEFAULT NULL,
  `hos_complemento` varchar(255) DEFAULT NULL,
  `hos_bairro` varchar(255) DEFAULT NULL,
  `hos_cidade` varchar(255) DEFAULT NULL,
  `hos_estado` varchar(2) DEFAULT NULL,
  `hos_cep` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`hos_id`),
  KEY `hosped_usuario_id_idx` (`hos_eve_id`),
  CONSTRAINT `hosped_evento_id` FOREIGN KEY (`hos_eve_id`) REFERENCES `tbl_evento` (`eve_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_hospedagem`
--

LOCK TABLES `tbl_hospedagem` WRITE;
/*!40000 ALTER TABLE `tbl_hospedagem` DISABLE KEYS */;
INSERT INTO `tbl_hospedagem` VALUES (1,2,'Pauliceia Hostel','descrição','1',6,'email@email.com','9849849849','98498498498','98498498498','Rua Cachoeira Paulista','123','123','Cidade Salvador','Jacareí','SP','12312290');
/*!40000 ALTER TABLE `tbl_hospedagem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_item`
--

DROP TABLE IF EXISTS `tbl_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_item` (
  `ite_id` int(11) NOT NULL AUTO_INCREMENT,
  `ite_descricao` varchar(255) DEFAULT NULL,
  `ite_tipo` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`ite_id`)
) ENGINE=InnoDB AUTO_INCREMENT=943 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_item`
--

LOCK TABLES `tbl_item` WRITE;
/*!40000 ALTER TABLE `tbl_item` DISABLE KEYS */;
INSERT INTO `tbl_item` VALUES (253,'Acesso informatizado','1'),(254,'Acessórios','1'),(255,'Aderecista','1'),(256,'Afinador','1'),(257,'Afinador de Piano','1'),(258,'Agogô','1'),(259,'Água','1'),(260,'Alfaia','1'),(261,'Alugueis para cenografia','1'),(262,'Aluguel de câmera completa','1'),(263,'Aluguel de Caminhões','1'),(264,'Aluguel de container','1'),(265,'Aluguel de instrumentos','1'),(266,'Aluguel de Locações','1'),(267,'Aluguel de ônibus','1'),(268,'Aluguel de Sede de Produção','1'),(269,'Aluguel de vaga/ Garagem','1'),(270,'Aluguel de vans','1'),(271,'Ambulância','1'),(272,'Animador','1'),(273,'Aparelhos e luminárias','1'),(274,'Apostila','1'),(275,'Aquisição de partituras','1'),(276,'Arquiteto/engenheiro','1'),(277,'Arranjador','1'),(278,'Arregimentador','1'),(279,'Arte educador','1'),(280,'Assessor de imprensa','1'),(281,'Assessoria de Comunicação','1'),(282,'Assistente administrativo','1'),(283,'Assistente de cenografia','1'),(284,'Assistente de Coreógrafo','1'),(285,'Assistente de curadoria','1'),(286,'Assistente de desmontagem','1'),(287,'Assistente de Diretor','1'),(288,'Assistente de diretor musical','1'),(289,'Assistente de figurino','1'),(290,'Assistente de iluminação','1'),(291,'Assistente de Maestro','1'),(292,'Assistente de produção','1'),(293,'Assistente de som','1'),(294,'Assistentes','1'),(295,'Ator/Atriz','1'),(296,'Automação','1'),(297,'Bailarinos','1'),(298,'Banda/Grupo local','1'),(299,'Baquetas de madeira','1'),(300,'Batuta','1'),(301,'Bombo sinfônico','1'),(302,'Bongô profissional','1'),(303,'Cabeleireiro','1'),(304,'Caixa','1'),(305,'Caixa Amplificada','1'),(306,'Cajón','1'),(307,'Camareira','1'),(308,'Cantor / Solista - Cachê de Ensaio','1'),(309,'Capa para proteção/armazenamento de instrumentos musicais','1'),(310,'Carregador','1'),(311,'Carrilhão','1'),(312,'Caxixi','1'),(313,'CDs','1'),(314,'Cenário','1'),(315,'Cenógrafo','1'),(316,'Cenotécnico','1'),(317,'Clarinete','1'),(318,'Comercial de TV (criação)','1'),(319,'Confecção de troféus e placas comemorativas','1'),(320,'Construção (detalhar na justificativa)','1'),(321,'Consultores','1'),(322,'Consultoria Técnica','1'),(323,'Contrabaixo','1'),(324,'Contra-regra','1'),(325,'Contratação de Técnicos','1'),(326,'Coordenação artística','1'),(327,'Coordenação elenco','1'),(328,'Coordenação geral','1'),(329,'Coordenação pedagógica','1'),(330,'Coordenação Técnica','1'),(331,'Coordenador de produção','1'),(332,'Coordenador do Projeto','1'),(333,'Cópias','1'),(334,'Copista - Partituras','1'),(335,'Coreógrafo','1'),(336,'Costureira','1'),(337,'Credenciais','1'),(338,'Cuíca','1'),(339,'Curador','1'),(340,'Curadoria','1'),(341,'Desenhos técnicos','1'),(342,'Designer de som','1'),(343,'Designer gráfico','1'),(344,'Designer gráfico','1'),(345,'Despachante aduaneiro','1'),(346,'Direção Artística','1'),(347,'Direção Cênica','1'),(348,'Direitos Autorais','1'),(349,'Diretor Artístico','1'),(350,'Diretor Artístico e Musical','1'),(351,'Diretor de harmonia','1'),(352,'Diretor de Palco ou de Cena','1'),(353,'Diretor de produção','1'),(354,'Diretor geral','1'),(355,'Diretor musical','1'),(356,'Dramaturgista','1'),(357,'Efeitos visuais','1'),(358,'Elaboração de Roteiro','1'),(359,'Elenco coadjuvante','1'),(360,'Elenco protagonista','1'),(361,'Eletricista','1'),(362,'Ensaios','1'),(363,'Equipamento de Proteção Individual - EPI','1'),(364,'Estagiário','1'),(365,'Estante para instrumento musical','1'),(366,'Estúdio de áudio','1'),(367,'Euphonium','1'),(368,'Figurantes','1'),(369,'Figurinista','1'),(370,'Figurino','1'),(371,'Flauta doce','1'),(372,'Flauta Transversa','1'),(373,'Flugelhorn','1'),(374,'Fonoaudióloga','1'),(375,'Fotografia Artística (Fotógrafo, Tratamento, Revelação, etc.)','1'),(376,'Frete rodoviário','1'),(377,'Ganzá','1'),(378,'Hospedagem com Alimentação','1'),(379,'Hospedagem sem Alimentação','1'),(380,'Iluminador','1'),(381,'Ilustração','1'),(382,'Imagens','1'),(383,'Impressão','1'),(384,'Instrutor','1'),(385,'Jogos educativos','1'),(386,'Lavanderia','1'),(387,'Libretista','1'),(388,'Licenças','1'),(389,'Limpeza','1'),(390,'Locação de ar condicionado','1'),(391,'Locação de Equipamento de projeção','1'),(392,'Locação de equipamentos','1'),(393,'Locação de equipamentos de luz (torres, mesas, racks, cabos, refletores, máquina de fumaça, monitor)','1'),(394,'Locação de estúdio','1'),(395,'Locação de Gerador de Energia','1'),(396,'Locação de guindastes','1'),(397,'Locação de palco c/ cobertura','1'),(398,'Locação de palco sem cobertura','1'),(399,'Locação de Partituras','1'),(400,'Locação de rádio de comunicação','1'),(401,'Locação de Sala de Espetáculo','1'),(402,'Locação de sala para ensaios','1'),(403,'Locação de teatro','1'),(404,'Manutenção de instrumentos musicais','1'),(405,'Maquiador','1'),(406,'Maquiagem','1'),(407,'Maquinista','1'),(408,'Maquinista assistente','1'),(409,'Materiais e equipamentos para montagem','1'),(410,'Material cenográfico','1'),(411,'Material de execução dos figurinos','1'),(412,'Material efeito especial','1'),(413,'Material maquiagem / cabelos','1'),(414,'Microfone sem fio','1'),(415,'Microfonista','1'),(416,'Montador','1'),(417,'Montagem e desmontagem','1'),(418,'Músico Base - Cachê de ensaio','1'),(419,'Músico Complemento- Cachê de ensaio','1'),(420,'Músico Coro - Cachê de ensaio','1'),(421,'Músico de Base','1'),(422,'Músicos / Intérpretes','1'),(423,'Oboé','1'),(424,'Operador de canhão','1'),(425,'Operador de som','1'),(426,'Operador/Técnico de Luz/Som - Ensaios','1'),(427,'Painel de led - locação','1'),(428,'Palestra','1'),(429,'Pandeiro','1'),(430,'Passagens Aéreas (Descrever os trechos na tela de deslocamentos)','1'),(431,'Passagens terrestres','1'),(432,'Pasta para partitura','1'),(433,'Pele de couro 24','1'),(434,'Pele de nylon para instrumentos','1'),(435,'Pele para instrumento de percussão','1'),(436,'Perícias e Vistorias','1'),(437,'Perucaria - material e confecção','1'),(438,'Peruqueira','1'),(439,'Pesquisa','1'),(440,'Pianista','1'),(441,'Piano de Cauda','1'),(442,'Praticáveis','1'),(443,'Prato (instrumento musical)','1'),(444,'Preparação Técnica','1'),(445,'Preparador Corporal','1'),(446,'Preparador Vocal','1'),(447,'Produção de Texto','1'),(448,'Produtor','1'),(449,'Produtor de elenco','1'),(450,'Produtor de figurinos','1'),(451,'Produtor Executivo','1'),(452,'Produtor musical','1'),(453,'Programa','1'),(454,'Programador','1'),(455,'Programador Visual','1'),(456,'Projeto Acústico','1'),(457,'Projeto cenográfico','1'),(458,'Projeto de Iluminação','1'),(459,'Projeto Educativo','1'),(460,'Projeto Estrutural','1'),(461,'Projeto Gráfico','1'),(462,'Recepcionista','1'),(463,'Refeição','1'),(464,'Regente','1'),(465,'Registro videográfico','1'),(466,'Repinique','1'),(467,'Roadie','1'),(468,'Roteirista','1'),(469,'Sax soprano','1'),(470,'Saxofone','1'),(471,'Saxofone Alto Mib','1'),(472,'Saxofone Tenor Sib','1'),(473,'Segurança','1'),(474,'Seguro (pessoas, obras e equipamentos - especificar)','1'),(475,'Serralheiro','1'),(476,'Sonorização','1'),(477,'Surdo','1'),(478,'Tamborim','1'),(479,'Teclado','1'),(480,'Técnico de Luz','1'),(481,'Técnico de Palco','1'),(482,'Técnico de som','1'),(483,'Texto','1'),(484,'Timbal','1'),(485,'Tímpano','1'),(486,'Tradução','1'),(487,'Transporte Local / Locação de Automóvel / Combustível','1'),(488,'Trilha sonora original','1'),(489,'Trombone','1'),(490,'Trompa','1'),(491,'Trompete','1'),(492,'Tuba','1'),(493,'Tumbadora','1'),(494,'Uniforme','1'),(495,'Vídeo','1'),(496,'Viola','1'),(497,'Violão elétrico','1'),(498,'Violino','1'),(499,'Violoncelo','1'),(500,'Visagista','1'),(501,'Webdesigner','1'),(502,'Xequerê','1'),(503,'Xilofone','1'),(504,'Zabumba','1'),(505,'1º casal de mestre-sala e porta-bandeira','2'),(506,'A.R.T. de execução','2'),(507,'Acervo infantil','2'),(508,'Acesso informatizado','2'),(509,'Afinador','2'),(510,'Água','2'),(511,'Alugueis para cenografia','2'),(512,'Aluguel de Caminhões','2'),(513,'Aluguel de instrumentos','2'),(514,'Aluguel de Locações','2'),(515,'Aluguel de objetos de cena','2'),(516,'Aluguel de ônibus','2'),(517,'Aluguel de Partituras','2'),(518,'Aluguel de Sede de Produção','2'),(519,'Aluguel de vaga/ Garagem','2'),(520,'Aluguel de vans','2'),(521,'Alvenaria mista','2'),(522,'Alvenaria revestida','2'),(523,'Ambulância','2'),(524,'Amplificadores de Potência','2'),(525,'Amplificadores de Potência para Sub-Woofer','2'),(526,'Andaimes: Montagem e Desmontagem','2'),(527,'Aparelho de Multimídia','2'),(528,'Apresentador / Maitre','2'),(529,'Apresentador /locutor','2'),(530,'Aquisição de partituras','2'),(531,'Aquisição de Veículo','2'),(532,'Argumento/roteiro','2'),(533,'Arquiteto/engenheiro','2'),(534,'Arquivista','2'),(535,'Arranjador','2'),(536,'Arregimentador','2'),(537,'Arte-finalista','2'),(538,'Artista criação','2'),(539,'Assessor de imprensa','2'),(540,'Assessoria de Comunicação','2'),(541,'Assistente administrativo','2'),(542,'Assistente de câmera','2'),(543,'Assistente de cenografia','2'),(544,'Assistente de Cenotécnico','2'),(545,'Assistente de contra-regra','2'),(546,'Assistente de Coreógrafo','2'),(547,'Assistente de Diretor','2'),(548,'Assistente de iluminação','2'),(549,'Assistente de Maestro','2'),(550,'Assistente de monstagem / AVID','2'),(551,'Assistente de produção','2'),(552,'Assistente de som','2'),(553,'Assistentes','2'),(554,'Ator/Atriz','2'),(555,'Automação','2'),(556,'Bailarinos','2'),(557,'Baixo Mono - Instrumento musical percutido, produzido em madeira, metal e isopor','2'),(558,'Balsa flutuante para montagem de palco','2'),(559,'Bancos','2'),(560,'Banda/Grupo internacional','2'),(561,'Banda/Grupo local','2'),(562,'Banda/Grupo nacional','2'),(563,'Banheiro químico','2'),(564,'Baquetas de madeira','2'),(565,'Bases/Estrutura','2'),(566,'Bateria','2'),(567,'Bilheteiro','2'),(568,'Blocos de madeira','2'),(569,'Boletim','2'),(570,'Bolsa Incentivo','2'),(571,'Bombeiro','2'),(572,'Bongô profissional','2'),(573,'Cabeleireiro','2'),(574,'Cadeiras novas','2'),(575,'Caixa de bateria com estante','2'),(576,'Caixa de Produção','2'),(577,'Camareira','2'),(578,'Camarim','2'),(579,'Camarim (para montagem de estrutura no caso de locais abertos)','2'),(580,'Camisetas','2'),(581,'Cantor / Solista','2'),(582,'Captação de som direto','2'),(583,'Carregador','2'),(584,'Case','2'),(585,'Catraca comum','2'),(586,'CDs','2'),(587,'Cenário','2'),(588,'Cenografia/material/confecção','2'),(589,'Cenógrafo','2'),(590,'Cenotécnico','2'),(591,'Cftv de operação','2'),(592,'Cinegrafista','2'),(593,'Clarinete','2'),(594,'Clipping','2'),(595,'Cobertura','2'),(596,'Combustível','2'),(597,'Companhias e/ou escolas de Dança','2'),(598,'Compositor','2'),(599,'Comunicação Visual','2'),(600,'Confecção de Convites','2'),(601,'Confecção de ingressos','2'),(602,'Confecção material cenográfico','2'),(603,'Consertos e reposições','2'),(604,'Consultores','2'),(605,'Consultoria Técnica','2'),(606,'Contrabaixo','2'),(607,'Contra-regra','2'),(608,'Contratação de Técnicos','2'),(609,'Coordenação artística','2'),(610,'Coordenação de Comunicação','2'),(611,'Coordenação de Programação','2'),(612,'Coordenação de segurança','2'),(613,'Coordenação geral','2'),(614,'Coordenação pedagógica','2'),(615,'Coordenação Técnica','2'),(616,'Coordenador Administrativo','2'),(617,'Coordenador de produção','2'),(618,'Coordenador do Projeto','2'),(619,'Cópias','2'),(620,'Copista - Partituras','2'),(621,'Corda de amarração','2'),(622,'Coreógrafo','2'),(623,'Coro','2'),(624,'Correios','2'),(625,'Cortina de boca de cena','2'),(626,'Costureira','2'),(627,'Crachá','2'),(628,'Credenciais','2'),(629,'Curador','2'),(630,'Decoração','2'),(631,'Desenho de som','2'),(632,'Desenvolvimento e Produção de Figurino','2'),(633,'Designer','2'),(634,'Designer gráfico','2'),(635,'Despachante aduaneiro','2'),(636,'Despacho de instrumentos (via aérea)','2'),(637,'Diárias','2'),(638,'Digitalização','2'),(639,'Direção musical','2'),(640,'Direitos Autorais','2'),(641,'Diretor Artístico','2'),(642,'Diretor Artístico e Musical','2'),(643,'Diretor cinematográfico','2'),(644,'Diretor de arte','2'),(645,'Diretor de Criação','2'),(646,'Diretor de fotografia','2'),(647,'Diretor de harmonia','2'),(648,'Diretor de Palco ou de Cena','2'),(649,'Diretor de produção','2'),(650,'Diretor geral','2'),(651,'Diretor musical','2'),(652,'Disc Jockey (DJ)','2'),(653,'Distribuidor de impresso','2'),(654,'Dublagem','2'),(655,'ECAD (caso de o evento ser aberto e gratuito)','2'),(656,'Edição de imagem','2'),(657,'Edição de som direto','2'),(658,'Editor','2'),(659,'Editoração Eletrônica','2'),(660,'Efeitos visuais','2'),(661,'Elenco coadjuvante','2'),(662,'Elenco protagonista','2'),(663,'Eletricista','2'),(664,'Embalagem para remessa','2'),(665,'Encordamento para Contrabaixo','2'),(666,'Encordamento para guitarra','2'),(667,'Encordamento para Viola','2'),(668,'Encordamento para Violão','2'),(669,'Encordamento para Violino','2'),(670,'Encordamento para Violoncelo','2'),(671,'Energia Elétrica','2'),(672,'Ensaios','2'),(673,'Equipamento som com operador','2'),(674,'Equipamentos de projeção','2'),(675,'Estagiário','2'),(676,'Estante para partituras','2'),(677,'Estantes e luminárias para orquestra','2'),(678,'Estrutura Metálica','2'),(679,'Estúdio de vídeo','2'),(680,'Euphonium','2'),(681,'Exposição','2'),(682,'Extintores','2'),(683,'Fagote','2'),(684,'Faixas','2'),(685,'Fechamentos com Ferragens','2'),(686,'Figurantes','2'),(687,'Figurinista','2'),(688,'Figurino','2'),(689,'Filme fotográfico','2'),(690,'Flauta doce','2'),(691,'Flauta Transversa','2'),(692,'Força e luz','2'),(693,'Fotografia Artística (Fotógrafo, Tratamento, Revelação, etc.)','2'),(694,'Fotógrafo','2'),(695,'Frete aéreo','2'),(696,'Frete marítimo','2'),(697,'Frete rodoviário','2'),(698,'Gerador - Aquisição','2'),(699,'Geradorista','2'),(700,'Gestor financeiro','2'),(701,'Grades','2'),(702,'Gravador de som','2'),(703,'Grupo musical / banda','2'),(704,'Grupo teatral','2'),(705,'Grupos Folclóricos','2'),(706,'Guitarra','2'),(707,'Hidro-Sanitarias','2'),(708,'Hospedagem com Alimentação','2'),(709,'Hospedagem sem Alimentação','2'),(710,'Iluminação de emergência','2'),(711,'Iluminação do salão de eventos','2'),(712,'Iluminação e balizamento do piso','2'),(713,'Iluminador','2'),(714,'Impressão','2'),(715,'Impressora Jato de Tinta','2'),(716,'Imunização / Limpeza','2'),(717,'Instalação provisória de água e esgoto','2'),(718,'Instalação provisória de força de luz','2'),(719,'Instalações de prevenção e combate a incêndio','2'),(720,'Instrutor','2'),(721,'Intérprete de libras','2'),(722,'Jornalista assistente','2'),(723,'Jurado','2'),(724,'Lavanderia','2'),(725,'Legendagem','2'),(726,'Licenças','2'),(727,'Limpeza','2'),(728,'Linóleo - Aquisição','2'),(729,'Locação de ar condicionado','2'),(730,'Locação de arquibancadas','2'),(731,'Locação de auditório','2'),(732,'Locação de automóveis','2'),(733,'Locação de caçamba para remoção de entulho','2'),(734,'Locação de cadeiras','2'),(735,'Locação de Cadeiras de Rodas','2'),(736,'Locação de Cadeiras e Mesas','2'),(737,'Locação de câmera completa','2'),(738,'Locação de computadores','2'),(739,'Locação de Equipamento de projeção','2'),(740,'Locação de equipamentos','2'),(741,'Locação de equipamentos de luz (torres, mesas, racks, cabos, refletores, máquina de fumaça, monitor)','2'),(742,'Locação de espaço aberto privado','2'),(743,'Locação de espaço para evento','2'),(744,'Locação de estúdio','2'),(745,'Locação de Gerador de Energia','2'),(746,'Locação de ginásio / estádio','2'),(747,'Locação de linóleo','2'),(748,'Locação de mesa de som/ equipamentos','2'),(749,'Locação de Microfones','2'),(750,'Locação de Mobiliário','2'),(751,'Locação de palco c/ cobertura','2'),(752,'Locação de palco sem cobertura','2'),(753,'Locação de Piano','2'),(754,'Locação de rádio de comunicação','2'),(755,'Locação de Sala de Espetáculo','2'),(756,'Locação de sala para ensaios','2'),(757,'Locação de teatro','2'),(758,'Locação de trio elétrico','2'),(759,'Locação de veículo','2'),(760,'Locação e montagem de palco','2'),(761,'Locação equipamento de iluminação','2'),(762,'Locação equipamento de som','2'),(763,'Locação/montagem de stand','2'),(764,'Lonas','2'),(765,'Maestro','2'),(766,'Manutenção de Informática','2'),(767,'Manutenção de instrumentos musicais','2'),(768,'Manutenção de site','2'),(769,'Manutenção e Materiais hidráulicos','2'),(770,'Maquiador','2'),(771,'Maquiagem','2'),(772,'Maquinista','2'),(773,'Maquinista assistente','2'),(774,'Materiais e equipamentos para montagem','2'),(775,'Material cenográfico','2'),(776,'Material de apoio pedagógico','2'),(777,'Material de consumo','2'),(778,'Material de Consumo Cenotécnico','2'),(779,'Material de escritório','2'),(780,'Material efeito especial','2'),(781,'Material expográfico','2'),(782,'Mediador','2'),(783,'Mestre de Cerimônia','2'),(784,'Microfone com fio','2'),(785,'Microfone sem fio','2'),(786,'Microfonista','2'),(787,'Mixagem do áudio / Masterização','2'),(788,'Monitores','2'),(789,'Montador','2'),(790,'Montagem e desmontagem','2'),(791,'Motoboy','2'),(792,'Motoristas','2'),(793,'Móveis e Utensílios','2'),(794,'Mudas de árvore','2'),(795,'Músico Base - Cachê de ensaio','2'),(796,'Músico de Base','2'),(797,'Músico de Complemento','2'),(798,'Músico de Coro','2'),(799,'Músico Internacional','2'),(800,'Músico Local','2'),(801,'Músico nacional','2'),(802,'Músicos / Intérpretes','2'),(803,'Narrador/locutor','2'),(804,'Neutralização de Carbono','2'),(805,'Oboé','2'),(806,'Operador de câmera','2'),(807,'Operador de canhão','2'),(808,'Operador de Luz','2'),(809,'Operador de Multimídia','2'),(810,'Operador de som','2'),(811,'Operador de vídeo','2'),(812,'Orquestra','2'),(813,'Painéis de LED','2'),(814,'Painel de led - locação','2'),(815,'Painel rebatedor de som da orquestra','2'),(816,'Palco (praticável) 50 m²','2'),(817,'Palestrante','2'),(818,'Palheta','2'),(819,'Palheta para clarinete','2'),(820,'Passadeira','2'),(821,'Passagens Aéreas (Descrever os trechos na tela de deslocamentos)','2'),(822,'Passagens terrestres','2'),(823,'Passarela flutuante de acesso','2'),(824,'Pasta para partitura','2'),(825,'Pele de nylon para instrumentos','2'),(826,'Pele para instrumento de percussão','2'),(827,'Peruqueira','2'),(828,'Pianista','2'),(829,'Piano','2'),(830,'Pinturas','2'),(831,'Pisos','2'),(832,'Plantio de Árvores','2'),(833,'Ploter adesivo para paredes','2'),(834,'Posto médico','2'),(835,'Praticáveis','2'),(836,'Prato (instrumento musical)','2'),(837,'Prêmios','2'),(838,'Preparador Corporal','2'),(839,'Preparador de Naipe','2'),(840,'Preparador Vocal','2'),(841,'Produtor','2'),(842,'Produtor cinematográfico','2'),(843,'Produtor de cenários','2'),(844,'Produtor de elenco','2'),(845,'Produtor de finalização','2'),(846,'Produtor de palco','2'),(847,'Produtor Executivo','2'),(848,'Produtor local','2'),(849,'Produtor musical','2'),(850,'Professor','2'),(851,'Programa','2'),(852,'Programador Visual','2'),(853,'Projeção de copião','2'),(854,'Projeto cenográfico','2'),(855,'Projeto de Iluminação','2'),(856,'Projeto e execução de decoração','2'),(857,'Projeto Educativo','2'),(858,'Projeto Gráfico','2'),(859,'Provas de carga','2'),(860,'Pulseira (Credencial)','2'),(861,'Questionário','2'),(862,'Rack de mixagem','2'),(863,'Rebocador marítimo','2'),(864,'Recepcionista','2'),(865,'Redator','2'),(866,'Refeição','2'),(867,'Regente','2'),(868,'Registro e documentação fotográfica','2'),(869,'Registro videográfico','2'),(870,'Reparos e manutenção','2'),(871,'Repinique','2'),(872,'Revisão de Texto','2'),(873,'Revisor','2'),(874,'Revista / Encarte de revista','2'),(875,'Roadie','2'),(876,'Roteirista','2'),(877,'Sala de imprensa','2'),(878,'Sax alto','2'),(879,'Secretária','2'),(880,'Segurança','2'),(881,'Seguro (pessoas, obras e equipamentos - especificar)','2'),(882,'Serigrafias','2'),(883,'Serviço de limpeza','2'),(884,'Serviços de Manutenção e instalação elétrica','2'),(885,'Sinalização','2'),(886,'Sítio de Internet - Design e criação','2'),(887,'Sítio de Internet - Hospedagem','2'),(888,'Sítio de Internet - Manutenção/Atualização','2'),(889,'Solista','2'),(890,'Sonoplasta','2'),(891,'Sonorização','2'),(892,'Spalla','2'),(893,'Supervisão de som','2'),(894,'Suporte metálico para banner (2,5 x 3,5)','2'),(895,'Surdo','2'),(896,'Talabarte','2'),(897,'Tapumes/cercas','2'),(898,'Teclado','2'),(899,'Técnico de audiovisual','2'),(900,'Técnico de Informática','2'),(901,'Técnico de Luz','2'),(902,'Técnico de Palco','2'),(903,'Técnico de segurança','2'),(904,'Técnico de som','2'),(905,'Técnico efeitos especiais','2'),(906,'Telão','2'),(907,'Telefone','2'),(908,'Tendas','2'),(909,'Timbal','2'),(910,'Tímpano','2'),(911,'Torre de Segurança (para eventos em locais abertos)','2'),(912,'Tradução simultânea','2'),(913,'Tradutor e Adaptador','2'),(914,'Transmissão em tempo real (internet) - estrutura técnica','2'),(915,'Transporte de material','2'),(916,'Transporte Local / Locação de Automóvel / Combustível','2'),(917,'Triângulo','2'),(918,'Trombone','2'),(919,'Trombone de Vara Sib/Fa','2'),(920,'Trompa','2'),(921,'Trompete','2'),(922,'Tumbadora','2'),(923,'Uniforme','2'),(924,'Vibrafone','2'),(925,'Vídeo Jockey (VJ)','2'),(926,'Viola','2'),(927,'Violão','2'),(928,'Violão Eólico - Dedilhado, produzido em madeira e metal.','2'),(929,'Violino','2'),(930,'Webdesigner','2'),(931,'Xilofone','2'),(932,'CIDE - Contribuição de Intervenção no Domínio Econômico','4'),(933,'Contribuição Patronal','4'),(934,'Direitos Autorais','4'),(935,'ECAD (caso de o evento ser aberto e gratuito)','4'),(936,'FGTS','4'),(937,'INSS','4'),(938,'ISS (Se não estiver incluído no valor do cachê)','4'),(939,'Licenças','4'),(940,'PIS (trabalhista)','4'),(941,'Seguro (pessoas, obras e equipamentos - especificar)','4'),(942,'Taxa de empréstimo','4');
/*!40000 ALTER TABLE `tbl_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_local`
--

DROP TABLE IF EXISTS `tbl_local`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_local` (
  `loc_id` int(11) NOT NULL AUTO_INCREMENT,
  `loc_eve_id` int(11) DEFAULT NULL,
  `loc_equ_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`loc_id`),
  KEY `local_evento_id_idx` (`loc_eve_id`),
  KEY `local_equip_id_idx` (`loc_equ_id`),
  CONSTRAINT `local_equip_id` FOREIGN KEY (`loc_equ_id`) REFERENCES `tbl_equipamento` (`equ_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `local_evento_id` FOREIGN KEY (`loc_eve_id`) REFERENCES `tbl_evento` (`eve_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_local`
--

LOCK TABLES `tbl_local` WRITE;
/*!40000 ALTER TABLE `tbl_local` DISABLE KEYS */;
INSERT INTO `tbl_local` VALUES (7,2,1),(8,2,2),(9,3,1);
/*!40000 ALTER TABLE `tbl_local` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_meio`
--

DROP TABLE IF EXISTS `tbl_meio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_meio` (
  `mei_id` int(11) NOT NULL AUTO_INCREMENT,
  `mei_nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`mei_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_meio`
--

LOCK TABLES `tbl_meio` WRITE;
/*!40000 ALTER TABLE `tbl_meio` DISABLE KEYS */;
INSERT INTO `tbl_meio` VALUES (1,'Impressos'),(2,'Internet'),(3,'Jornal'),(4,'Mídia Exterior'),(5,'Rádio'),(6,'Revista'),(7,'TV');
/*!40000 ALTER TABLE `tbl_meio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_motorista`
--

DROP TABLE IF EXISTS `tbl_motorista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_motorista` (
  `mot_id` int(11) NOT NULL AUTO_INCREMENT,
  `mot_eve_id` int(11) DEFAULT NULL,
  `mot_nome` varchar(255) DEFAULT NULL,
  `mot_celular1` varchar(11) DEFAULT NULL,
  `mot_celular2` varchar(11) DEFAULT NULL,
  `mot_email` varchar(255) DEFAULT NULL,
  `mot_telefone` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`mot_id`),
  KEY `motorista_evento_idx` (`mot_eve_id`),
  CONSTRAINT `motorista_evento` FOREIGN KEY (`mot_eve_id`) REFERENCES `tbl_evento` (`eve_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_motorista`
--

LOCK TABLES `tbl_motorista` WRITE;
/*!40000 ALTER TABLE `tbl_motorista` DISABLE KEYS */;
INSERT INTO `tbl_motorista` VALUES (1,2,'João da silva','65465465465','65465465465','email@email','65456464654');
/*!40000 ALTER TABLE `tbl_motorista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_noticia`
--

DROP TABLE IF EXISTS `tbl_noticia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_noticia` (
  `not_id` int(11) NOT NULL AUTO_INCREMENT,
  `not_usu_id` int(11) DEFAULT NULL,
  `not_eve_id` int(11) DEFAULT NULL,
  `not_titulo` varchar(255) DEFAULT NULL,
  `not_descricao` text,
  `not_criado_em` timestamp NULL DEFAULT NULL,
  `not_modificado_em` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`not_id`),
  KEY `noticia_usu_id_idx` (`not_usu_id`),
  KEY `noticia_evento_id_idx` (`not_eve_id`),
  CONSTRAINT `noticia_evento_id` FOREIGN KEY (`not_eve_id`) REFERENCES `tbl_evento` (`eve_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `noticia_usu_id` FOREIGN KEY (`not_usu_id`) REFERENCES `tbl_usuario` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_noticia`
--

LOCK TABLES `tbl_noticia` WRITE;
/*!40000 ALTER TABLE `tbl_noticia` DISABLE KEYS */;
INSERT INTO `tbl_noticia` VALUES (1,9,2,'Noticia muito boa!','mentira, nem tanto','2015-04-17 00:06:36','2015-04-17 00:22:18');
/*!40000 ALTER TABLE `tbl_noticia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_objeto`
--

DROP TABLE IF EXISTS `tbl_objeto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_objeto` (
  `obj_id` int(11) NOT NULL AUTO_INCREMENT,
  `obj_usu_id` int(11) DEFAULT NULL,
  `obj_tip_id` int(11) DEFAULT NULL,
  `obj_sub_id` int(11) DEFAULT NULL,
  `obj_ssu_id` int(11) DEFAULT NULL,
  `obj_res_id` int(11) DEFAULT NULL,
  `obj_nome` varchar(255) DEFAULT NULL,
  `obj_resumo` text,
  `obj_foto1` varchar(255) DEFAULT NULL,
  `obj_foto2` varchar(255) DEFAULT NULL,
  `obj_foto3` varchar(255) DEFAULT NULL,
  `obj_link_video` varchar(255) DEFAULT NULL,
  `obj_link_site` varchar(255) DEFAULT NULL,
  `obj_link_facebook` varchar(255) DEFAULT NULL,
  `obj_link_youtube` varchar(255) DEFAULT NULL,
  `obj_link_redesocial` varchar(255) DEFAULT NULL,
  `obj_info` text,
  `obj_publico` varchar(1) DEFAULT NULL,
  `obj_criado_em` timestamp NULL DEFAULT NULL,
  `obj_modificado_em` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`obj_id`),
  KEY `objeto_usuario_id_idx` (`obj_usu_id`),
  KEY `objeto_subsubtipo_id_idx` (`obj_ssu_id`),
  KEY `objeto_subtipo_id_idx` (`obj_sub_id`),
  KEY `objeto_tipo_id_idx` (`obj_tip_id`),
  KEY `objeto_responsavel_id_idx` (`obj_res_id`),
  CONSTRAINT `objeto_responsavel_id` FOREIGN KEY (`obj_res_id`) REFERENCES `tbl_responsavel` (`res_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `objeto_subsubtipo_id` FOREIGN KEY (`obj_ssu_id`) REFERENCES `tbl_subsubtipo` (`ssu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `objeto_subtipo_id` FOREIGN KEY (`obj_sub_id`) REFERENCES `tbl_subtipo` (`sub_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `objeto_tipo_id` FOREIGN KEY (`obj_tip_id`) REFERENCES `tbl_tipo` (`tip_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `objeto_usuario_id` FOREIGN KEY (`obj_usu_id`) REFERENCES `tbl_usuario` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_objeto`
--

LOCK TABLES `tbl_objeto` WRITE;
/*!40000 ALTER TABLE `tbl_objeto` DISABLE KEYS */;
INSERT INTO `tbl_objeto` VALUES (1,9,3,20,49,2,'O Teatro das sombras ocultas da morte','resumo resumo resumo resumoresumo resumoresumo resumoresumo resumoresumo resumoresumo resumoresumo resumoresumo resumo\r\nresumo resumoresumo resumoresumo resumoresumo resumoresumo resumo\r\n\r\nresumo resumoresumo resumoresumo resumoresumo resumo','1_foto.jpg','','','vei56','asd565','asd656','asd565','asd65','asd3453','1','2015-03-16 12:22:47','2015-03-27 11:50:59'),(2,9,2,5,29,2,'Curta metragem','video da hora locao hehehevideo da hora locao hehehevideo da hora locao hehehevideo da hora locao hehehevideo da hora locao hehehevideo da hora locao hehehevideo da hora locao hehehevideo da hora locao hehehevideo da hora locao hehehevideo da hora locao hehehevideo da hora locao hehehevideo da hora locao hehehevideo da hora locao hehehevideo da hora locao hehehevideo da hora locao hehehevideo da h','2_foto.jpg','','','','','','','','nenhuma informacao adiona','2','2015-03-16 23:43:31','2015-06-13 13:36:44'),(3,9,1,1,6,2,'Festão da Galera','Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo Resumo ','3_foto.jpg',NULL,NULL,'','','','','','','2','2015-03-22 20:17:19','2015-06-12 00:19:59'),(6,9,1,1,1,2,'Geoparque Uberaba – Uma Proposta de Valorização de Seus Patrimônios Geológico, Histórico e Cultural','Mínimo de 100 caracteres. Máximo de 400 caracteresMínimo de 100 caracteres. Máximo de 400 caracteresMínimo de 100 caracteres. Máximo de 400 caracteresMínimo de 100 caracteres. Máximo de 400 caracteresMínimo de 100 caracteres. Máximo de 400 caracteresMínimo de 100 caracteres. Máximo de 400 caracteres','6_foto.jpg',NULL,NULL,'','','','','','','1','2015-03-22 20:27:05','2015-06-12 00:19:23'),(7,9,1,1,4,2,'nome teste','$objId$objIdnimo de 100 caracteres. Máximo de 400 caracteresnimo de 100 caracteres. Máximo de 400 caracteresnimo de 100 caracteres. Máximo de 400 caracteresnimo de 100 caracteres. Máximo de 400 caracteresnimo de 100 caracteres. Máximo de 400 caracteresnimo de 100 caracteres. Máximo de 400 caracteresnimo de 100 caracteres. Máximo de 400 caracteresnimo de 100 caracteres. Máximo de 400 caracteres','7_foto.jpg',NULL,NULL,'','','','','','','1','2015-03-22 20:28:19','2015-03-22 20:28:19'),(8,9,3,23,55,2,'Palco 2','Mínimo de 100 caracteres. Máximo de 400 caracteresMínimo de 100 caracteres. Máximo de 400 caracteresMínimo de 100 caracteres. Máximo de 400 caracteresMínimo de 100 caracteres. Máximo de 400 caracteresMínimo de 100 caracteres. Máximo de 400 caracteresMínimo de 100 caracteres. Máximo de 400 caracteres','8_foto.jpg',NULL,NULL,'','','','','','','1','2015-03-26 01:57:16','2015-04-06 23:07:32'),(9,9,1,3,22,2,'Teatro Infantil','Mínimo de 100 caracteres. Máximo de 400 caracteresMínimo de 100 caracteres. Máximo de 400 caracteresMínimo de 100 caracteres. Máximo de 400 caracteresMínimo de 100 caracteres. Máximo de 400 caracteresMínimo de 100 caracteres. Máximo de 400 caracteres','9_foto.jpg',NULL,NULL,'','','','','','','0','2015-04-09 00:02:48','2015-06-11 23:39:29'),(10,12,1,1,2,7,'123','123123123 1231 2312312312 3123 123123123 12312312312312 31 231231 231231231231231   231231231231 231 23123213 213 213213213213211232','10_foto.jpg',NULL,NULL,'','','','','','','1','2015-06-11 01:05:16','2015-06-11 01:18:14'),(11,9,2,4,28,2,'12312','123123123de 100 caracteres. Mde 100 caracteres. Mde 100 caracteres. Mde 100 caracteres. Mde 100 caracteres. Mde 100 caracteres. Mde 100 caracteres. Mde 100 caracteres. Mde 100 caracteres. Mde 100 caracteres. Mde 100 caracteres. Mde 100 caracteres. Mde 100 caracteres. Mde 100 caracteres. Mde 100 caracteres. M','11_foto.jpg',NULL,NULL,'www.uol.com.br','http://stackoverflow.com/questions/7111816/any-equivalent-to-for-adding-to-beginning-of-string-in-php','www.redeglobo.com.br','www.pudim.com.br','http://www.youtube.com.br','','1','2015-06-13 13:41:08','2015-07-02 13:58:39');
/*!40000 ALTER TABLE `tbl_objeto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_papel`
--

DROP TABLE IF EXISTS `tbl_papel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_papel` (
  `pap_id` int(11) NOT NULL AUTO_INCREMENT,
  `pap_usu_id` int(11) DEFAULT NULL,
  `pap_eve_id` int(11) DEFAULT NULL,
  `pap_papel` varchar(45) DEFAULT NULL,
  `pap_cargo` varchar(100) DEFAULT NULL,
  `pap_criado_em` timestamp NULL DEFAULT NULL,
  `pap_modificado_em` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pap_id`),
  KEY `papel_usuario_id_idx` (`pap_usu_id`),
  KEY `papel_evento_id_idx` (`pap_eve_id`),
  CONSTRAINT `papel_evento_id` FOREIGN KEY (`pap_eve_id`) REFERENCES `tbl_evento` (`eve_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `papel_usuario_id` FOREIGN KEY (`pap_usu_id`) REFERENCES `tbl_usuario` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_papel`
--

LOCK TABLES `tbl_papel` WRITE;
/*!40000 ALTER TABLE `tbl_papel` DISABLE KEYS */;
INSERT INTO `tbl_papel` VALUES (2,9,2,'admin','Coordenação Geral','2015-03-24 01:45:55','2015-04-30 22:52:51'),(3,9,3,'admin','Coordenação Geral','2015-03-27 15:55:21','2015-03-27 15:55:21'),(4,9,4,'admin','Coordenação Geral','2015-04-06 19:36:20','2015-04-06 19:36:20'),(5,9,5,'admin','Coordenação Geral','2015-04-06 19:38:11','2015-04-06 19:38:11'),(6,9,6,'admin','Coordenação Geral','2015-04-22 01:45:26','2015-04-22 01:45:26'),(8,11,2,'produtor','Produção','2015-04-28 12:05:30','2015-04-30 22:52:53'),(9,10,2,'coordenador','Coordenação de Produção','2015-05-27 12:03:04','2015-05-27 12:07:59'),(10,10,3,'coordenador','Coordenação de Programação','2015-05-27 12:04:03','2015-05-28 00:05:21');
/*!40000 ALTER TABLE `tbl_papel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_participacao`
--

DROP TABLE IF EXISTS `tbl_participacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_participacao` (
  `par_id` int(11) NOT NULL AUTO_INCREMENT,
  `par_eve_id` int(11) DEFAULT NULL,
  `par_pap_id` int(11) DEFAULT NULL,
  `par_apr_id` int(11) DEFAULT NULL,
  `par_observacao` text,
  `par_criado_em` timestamp NULL DEFAULT NULL,
  `par_modificado_em` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`par_id`),
  KEY `particip_evento_id_idx` (`par_eve_id`),
  KEY `particip_usuario_id_idx` (`par_pap_id`),
  KEY `particip_atracao_id_idx` (`par_apr_id`),
  CONSTRAINT `particip_apresentacao_id` FOREIGN KEY (`par_apr_id`) REFERENCES `tbl_apresentacao` (`apr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `particip_evento_id` FOREIGN KEY (`par_eve_id`) REFERENCES `tbl_evento` (`eve_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `particip_papel_id` FOREIGN KEY (`par_pap_id`) REFERENCES `tbl_papel` (`pap_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_participacao`
--

LOCK TABLES `tbl_participacao` WRITE;
/*!40000 ALTER TABLE `tbl_participacao` DISABLE KEYS */;
INSERT INTO `tbl_participacao` VALUES (2,2,8,4,'200456','2015-04-30 12:17:42','2015-04-30 12:17:42'),(6,2,2,4,'','2015-05-28 01:55:16','2015-05-28 01:55:16');
/*!40000 ALTER TABLE `tbl_participacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_peca`
--

DROP TABLE IF EXISTS `tbl_peca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_peca` (
  `pec_id` int(11) NOT NULL AUTO_INCREMENT,
  `pec_nome` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pec_id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_peca`
--

LOCK TABLES `tbl_peca` WRITE;
/*!40000 ALTER TABLE `tbl_peca` DISABLE KEYS */;
INSERT INTO `tbl_peca` VALUES (1,'Adesivo de chão'),(2,'Album/book'),(3,'Anúncio de  página dupla'),(4,'Anúncio de 1 de página'),(5,'Anúncio de 1/2 de  página'),(6,'Anúncio de 1/3 de página'),(7,'Anúncio de 1/4 de página'),(8,'Anúncio de 1/8 de página'),(9,'Anúncio de 2/3 de página'),(10,'Anúncio de Rodapé'),(11,'Apostila'),(12,'Apresentação multimídia '),(13,'Arte slide/insert'),(14,'Audiovisual 3 a 5 minutos'),(15,'Back-drop/paínel'),(16,'Back-light/front-light/empenas de prédios'),(17,'Balão / Dirigível / Blimp'),(18,'Banner/faixa adesiva/faixa de lona/saia de palco/testeira/pórtico'),(19,'Boletim'),(20,'Broadside por página'),(21,'Busdoor (vidro traseiro)'),(22,'Caderno'),(23,'Calendário/folinha por lâmina'),(24,'Capa de caderno/livro/Revista/ Relaório/Catálogo/Carilha Manual Técnico'),(25,'Capa de CD/DVD/Rótulo de CD/DVD/Adesivo de CD'),(26,'Carro de som'),(27,'Cartão postal'),(28,'Cartaz'),(29,'Cartaz Quadroplo A1'),(30,'Cartaz/Poster'),(31,'Cartazete'),(32,'Cartilha'),(33,'Catalogo'),(34,'CD_ROM'),(35,'Circular/carta'),(36,'Comercial de TV (criação)'),(37,'Convite'),(38,'Convite Eletrônico/Folder Eletrônico'),(39,'Display'),(40,'Elemídia'),(41,'E-Mail'),(42,'Encarte de CD por página'),(43,'Envelopamento ônibus'),(44,'Envelopamento taxi'),(45,'Estandartes / Banners'),(46,'Etiqueta/Adesivo/Etiqueta de Bagagem'),(47,'Faixa'),(48,'Filipeta'),(49,'Filme/VT Institucional acima de 30\"/Informativo Eletrônico'),(50,'Filme/VT Institucional até 30\"'),(51,'Folder formato até A1(84x59,4cm)'),(52,'Folder formato até A2(59,4x42cm)'),(53,'Folder formato até A3(29,7x42cm)'),(54,'Folder formato até A4(21x29,7cm)'),(55,'Folder formato até A5(15,5x21cm)'),(56,'Folders'),(57,'Folheto'),(58,'Jingle acima de 30\"'),(59,'Jingle de até 30\"'),(60,'Jornal / Encarte de jornal'),(61,'Lateral de Onibus'),(62,'Livreto'),(63,'Livro'),(64,'Luminoso teto de táxi'),(65,'Manual Técnico'),(66,'Mídia em Metrô'),(67,'Mídia impressa'),(68,'Mídia internet'),(69,'Mídia radiofônica'),(70,'Mídia Televisiva'),(71,'Mobiliário Expositivo'),(72,'Outdoor simples'),(73,'Outdoors'),(74,'Painéis'),(75,'Painéis em mobiliário urbano (banca de revistas, relógio, toten, ponto de ônibus)'),(76,'Painel externo metrô'),(77,'Paínel Frontal de Ponto de Onibus'),(78,'Paínel Lateral de Ponto de Onibus'),(79,'Panfleto'),(80,'Peças de Audio'),(81,'Peças de Internet(criação/textos/frames/multmídia)'),(82,'Placa de Estrada, de Obra e de Sinalização'),(83,'Placa de rua (esquina)'),(84,'Programa'),(85,'Revista / Encarte de revista'),(86,'Sítio de internet'),(87,'Spot acima de 30\"'),(88,'Spot de até 15\"'),(89,'Spot de até 30\"'),(90,'Spot de rádio 30 segundos'),(91,'Testeira de Ponto de Onibus'),(92,'Traseira de Onibus'),(93,'Traseira de taxi (vidro)'),(94,'VT varejo acima de 30\"/Vinhetas acima 30\"'),(95,'VT varejo até 15\"/Vinheta até 15\"'),(96,'VT varejo até 30\"/Vinheta até 30\"');
/*!40000 ALTER TABLE `tbl_peca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_presenca`
--

DROP TABLE IF EXISTS `tbl_presenca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_presenca` (
  `pre_id` int(11) NOT NULL AUTO_INCREMENT,
  `pre_reu_id` int(11) DEFAULT NULL,
  `pre_pap_id` int(11) DEFAULT NULL,
  `pre_presente` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`pre_id`),
  KEY `reuniao_id_idx` (`pre_reu_id`),
  KEY `usuario_id_idx` (`pre_pap_id`),
  CONSTRAINT `papel_id` FOREIGN KEY (`pre_pap_id`) REFERENCES `tbl_papel` (`pap_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reuniao_id` FOREIGN KEY (`pre_reu_id`) REFERENCES `tbl_reuniao` (`reu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_presenca`
--

LOCK TABLES `tbl_presenca` WRITE;
/*!40000 ALTER TABLE `tbl_presenca` DISABLE KEYS */;
INSERT INTO `tbl_presenca` VALUES (15,2,2,NULL),(16,2,9,NULL);
/*!40000 ALTER TABLE `tbl_presenca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_produto`
--

DROP TABLE IF EXISTS `tbl_produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_produto` (
  `pro_id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_obj_id` int(11) DEFAULT NULL,
  `pro_censura` varchar(45) DEFAULT NULL,
  `pro_integrantes` int(11) DEFAULT NULL,
  `pro_cache` float(11,2) DEFAULT NULL,
  `pro_rider` text,
  `pro_duracao` varchar(45) DEFAULT NULL,
  `pro_ficha_tecnica` text,
  PRIMARY KEY (`pro_id`),
  KEY `produ_objeto_id_idx` (`pro_obj_id`),
  CONSTRAINT `produ_objeto_id` FOREIGN KEY (`pro_obj_id`) REFERENCES `tbl_objeto` (`obj_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_produto`
--

LOCK TABLES `tbl_produto` WRITE;
/*!40000 ALTER TABLE `tbl_produto` DISABLE KEYS */;
INSERT INTO `tbl_produto` VALUES (1,2,'10 anos',5,0.00,'rider tecnico cabuloso\r\nhehehe','20 minutos','memnbro 1\r\nmembo 2memnbro 1\r\nmembo 2memnbro 1memnbro 1\r\nmembo 2memnbro 1\r\nmembo 2memnbro 1\r\nmembo 2memnbro 1\r\nmembo 2memnbro 1\r\nmembo 2memnbro 1\r\nmembo 2memnbro 1\r\nmembo 2memnbro 1\r\nmembo 2memnbro 1\r\nmembo 2memnbro 1\r\nmembo 2\r\nmembo 2memnbro 1\r\nmembo 2memnbro 1\r\nmembo 2memnbro 1\r\nmembo 2memnbro 1\r\nmembo 2memnbro 1\r\nmembo 2memnbro 1\r\nmembo 2memnbro 1\r\nmembo 2memnbro 1\r\nmembo 2memnbro 1\r\nmembo 2memnbro 1\r\nmembo 2memnbro 1\r\nmembo 2memnbro 1\r\nmembo 2\r\n'),(2,9,'123123',12,1200.00,'','12 min',''),(3,10,'12312',123,1.23,'123','123','123'),(4,11,'12312123',123,NULL,'123','123121','123');
/*!40000 ALTER TABLE `tbl_produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_responsavel`
--

DROP TABLE IF EXISTS `tbl_responsavel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_responsavel` (
  `res_id` int(11) NOT NULL AUTO_INCREMENT,
  `res_usu_id` int(11) DEFAULT NULL,
  `res_nome` varchar(255) DEFAULT NULL,
  `res_instituicao` varchar(255) DEFAULT NULL,
  `res_cargo` varchar(255) DEFAULT NULL,
  `res_datanasc` date DEFAULT NULL,
  `res_email` varchar(255) DEFAULT NULL,
  `res_telefone` varchar(11) DEFAULT NULL,
  `res_celular1` varchar(11) DEFAULT NULL,
  `res_celular2` varchar(11) DEFAULT NULL,
  `res_endereco` varchar(255) DEFAULT NULL,
  `res_numero` varchar(255) DEFAULT NULL,
  `res_bairro` varchar(255) DEFAULT NULL,
  `res_complemento` varchar(255) DEFAULT NULL,
  `res_cidade` varchar(255) DEFAULT NULL,
  `res_estado` varchar(2) DEFAULT NULL,
  `res_cep` varchar(8) DEFAULT NULL,
  `res_criado_em` timestamp NULL DEFAULT NULL,
  `res_modificado_em` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`res_id`),
  KEY `usuario_id_idx` (`res_usu_id`),
  CONSTRAINT `usuario_id` FOREIGN KEY (`res_usu_id`) REFERENCES `tbl_usuario` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_responsavel`
--

LOCK TABLES `tbl_responsavel` WRITE;
/*!40000 ALTER TABLE `tbl_responsavel` DISABLE KEYS */;
INSERT INTO `tbl_responsavel` VALUES (2,9,'admin','inst3','cargo4','1987-08-09','admin@sistemaeva.com.br','8498498498','9848484848','98498498498','Rua Cachoeira Paulista','12','Cidade Salvador','','Jacareí','SP','12312290','2015-03-14 01:58:38','2015-06-11 01:19:03'),(7,12,'Paulo Joao ','','','2015-06-10','teste@teste.com','','12312312312','','Rua Cachoeira Paulista','123','Cidade Salvador','','Jacareí','SP','12312290','2015-06-11 01:04:13','2015-06-11 01:16:33'),(8,16,'teste endereco',NULL,NULL,NULL,'teste@endereco.com',NULL,NULL,NULL,'Rua Cachoeira Paulista','123','Cidade Salvador','','Jacareí','SP','12312290','2015-06-15 20:42:10','2015-06-15 20:42:10');
/*!40000 ALTER TABLE `tbl_responsavel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_reuniao`
--

DROP TABLE IF EXISTS `tbl_reuniao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_reuniao` (
  `reu_id` int(11) NOT NULL AUTO_INCREMENT,
  `reu_eve_id` int(11) DEFAULT NULL,
  `reu_titulo` varchar(255) DEFAULT NULL,
  `reu_data` date DEFAULT NULL,
  `reu_hora` time DEFAULT NULL,
  `reu_local` varchar(255) DEFAULT NULL,
  `reu_pauta` text,
  `reu_ata` text,
  `reu_criado_em` timestamp NULL DEFAULT NULL,
  `reu_modificado_em` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`reu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_reuniao`
--

LOCK TABLES `tbl_reuniao` WRITE;
/*!40000 ALTER TABLE `tbl_reuniao` DISABLE KEYS */;
INSERT INTO `tbl_reuniao` VALUES (2,2,'Reuniao final','2015-06-06','15:00:00','Rep. Ama','pauta ta','ata ta','2015-06-04 00:18:55','2015-06-06 18:11:24'),(3,3,'123123','2015-06-24','12:23:00','123123','123','12312','2015-06-24 23:14:47','2015-06-24 23:14:47');
/*!40000 ALTER TABLE `tbl_reuniao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_subsubtipo`
--

DROP TABLE IF EXISTS `tbl_subsubtipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_subsubtipo` (
  `ssu_id` int(11) NOT NULL AUTO_INCREMENT,
  `ssu_sub_id` int(11) DEFAULT NULL,
  `ssu_nome` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ssu_id`),
  KEY `subtipo_id_idx` (`ssu_sub_id`),
  CONSTRAINT `subtipo_id` FOREIGN KEY (`ssu_sub_id`) REFERENCES `tbl_subtipo` (`sub_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_subsubtipo`
--

LOCK TABLES `tbl_subsubtipo` WRITE;
/*!40000 ALTER TABLE `tbl_subsubtipo` DISABLE KEYS */;
INSERT INTO `tbl_subsubtipo` VALUES (1,1,'1.1.1 - Festival'),(2,1,'1.1.2 - Exposição'),(3,1,'1.1.3 - Exibição'),(4,1,'1.1.4 - Feira'),(5,1,'1.1.5 - Mostra'),(6,1,'1.1.6 - Intercâmbio Cultural'),(7,1,'1.1.7 - Festa Popular'),(8,1,'1.1.8 - Festa Religiosa'),(9,1,'1.1.9 - Parada e Desfile'),(19,3,'1.2.1 - Seminário'),(20,3,'1.2.2 - Congresso'),(21,3,'1.2.3 - Palestra'),(22,3,'1.2.4 - Simpósio'),(23,3,'1.2.5 - Fórum'),(24,3,'1.2.6 - Curso'),(25,3,'1.2.7 - Oficina'),(26,3,'1.2.8 - Jornada'),(27,3,'1.2.9 - Conferência'),(28,4,'2.1.1 - Cultura e Arte'),(29,5,'2.2.1 - Arte Visual'),(30,6,'2.3.1 - Fotografia'),(31,7,'2.4.1 - Design'),(32,8,'2.5.1 - Moda'),(33,9,'2.6.1 - Circo Tradicional'),(34,9,'2.6.2 - Circo Moderno'),(35,10,'2.7.1 - Arquitetura'),(36,11,'2.8.1 - Teatro'),(37,12,'2.9.1 - Dança'),(38,13,'2.10.1 - Audiovisual'),(39,14,'2.11.1 - Livro e leitura'),(40,15,'2.12.1 - Música'),(41,16,'2.13.1 - Arte Digital'),(42,17,'2.14.1 - Acervo itinerante'),(43,18,'2.15.1 - Ciência e Arte'),(44,19,'3.1.1 - Cine itinerante'),(45,19,'3.1.2 - Espaco Público Para Projeção de Filmes'),(46,19,'3.1.3 - Sala de cinema'),(47,20,'3.2.1 - Teatro Público'),(48,20,'3.2.2 - Teatro Privado'),(49,20,'3.2.3 - Teatro de Arena'),(50,21,'3.3.1 - Circo Itinerante'),(51,21,'3.3.2 - Circo Fixo'),(52,21,'3.3.3 - Terreno para Circo'),(53,22,'3.4.1 - Centro Cultural Público'),(54,22,'3.4.2 - Centro Cultural Privado'),(55,23,'3.5.1 - Museu Público'),(56,23,'3.5.2 - Museu Privado'),(57,23,'3.5.3 - Centro de Memória'),(58,24,'3.6.1 - Audioteca'),(59,24,'3.6.2 - Galeria de arte'),(60,24,'3.6.3 - Ateliê de Artes Plásticas'),(61,24,'3.6.4 - Centro de artesanato'),(62,24,'3.6.5 - Estúdio'),(63,24,'3.6.6 - Concha acústica'),(64,24,'3.6.7 - Estádio'),(65,24,'3.6.8 - Ginásio Poliesportivo'),(66,24,'3.6.9 - TV Universitária'),(67,24,'3.6.10 - Rádio Universitária'),(78,3,'1.2.10 - Outro'),(80,1,'1.1.10 - Outro'),(81,26,'2.16.1 - Coletivo'),(82,29,'2.19.1 - Instalação'),(83,24,'3.6.11 - Outro'),(84,27,'2.17.1 - Intervenção'),(85,28,'2.18.1 - Performance'),(86,30,'2.20.1 - Outro');
/*!40000 ALTER TABLE `tbl_subsubtipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_subtipo`
--

DROP TABLE IF EXISTS `tbl_subtipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_subtipo` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_tip_id` int(11) DEFAULT NULL,
  `sub_nome` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`sub_id`),
  KEY `tipo_id_idx` (`sub_tip_id`),
  CONSTRAINT `tipo_id` FOREIGN KEY (`sub_tip_id`) REFERENCES `tbl_tipo` (`tip_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_subtipo`
--

LOCK TABLES `tbl_subtipo` WRITE;
/*!40000 ALTER TABLE `tbl_subtipo` DISABLE KEYS */;
INSERT INTO `tbl_subtipo` VALUES (1,1,'1.1 - Eventos Difusão Cultural'),(3,1,'1.2 - Eventos de Capacitação e Reflexão'),(4,2,'2.1 - Cultura e Arte'),(5,2,'2.2 - Artes Visuais'),(6,2,'2.3 - Fotografia'),(7,2,'2.4 - Design'),(8,2,'2.5 - Moda'),(9,2,'2.6 - Circo'),(10,2,'2.7 - Arquitetura'),(11,2,'2.8 - Teatro'),(12,2,'2.9 - Dança'),(13,2,'2.10 - Audiovisual'),(14,2,'2.11 - Livro e leitura'),(15,2,'2.12 - Música'),(16,2,'2.13 - Arte Digital'),(17,2,'2.14 - Acervo itinerante'),(18,2,'2.15 - Ciência e Arte'),(19,3,'3.1 - Espaços de Exibição de Filmes'),(20,3,'3.2 - Teatros'),(21,3,'3.3 - Circos (Espaços)'),(22,3,'3.4 - Centros Culturais'),(23,3,'3.5 - Museus'),(24,3,'3.6 - Demais Equipamentos Culturais'),(26,2,'2.16 - Coletivo'),(27,2,'2.17 - Intervenção'),(28,2,'2.18 - Performance'),(29,2,'2.19 - Instalação'),(30,2,'2.20 - Outro');
/*!40000 ALTER TABLE `tbl_subtipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tarefa`
--

DROP TABLE IF EXISTS `tbl_tarefa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tarefa` (
  `tar_id` int(11) NOT NULL AUTO_INCREMENT,
  `tar_usu_id` int(11) DEFAULT NULL,
  `tar_eve_id` int(11) DEFAULT NULL,
  `tar_categoria` varchar(100) DEFAULT NULL,
  `tar_titulo` varchar(255) DEFAULT NULL,
  `tar_descricao` text,
  `tar_situacao` varchar(45) DEFAULT NULL,
  `tar_prioridade` varchar(45) DEFAULT NULL,
  `tar_data_inicio` date DEFAULT NULL,
  `tar_data_conclusao` date DEFAULT NULL,
  `tar_tempo` time DEFAULT NULL,
  `tar_criado_em` timestamp NULL DEFAULT NULL,
  `tar_modificado_em` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`tar_id`),
  KEY `usuario_tarefa_id_idx` (`tar_usu_id`),
  KEY `evento_tarefa_id_idx` (`tar_eve_id`),
  CONSTRAINT `evento_tarefa_id` FOREIGN KEY (`tar_eve_id`) REFERENCES `tbl_evento` (`eve_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `usuario_tarefa_id` FOREIGN KEY (`tar_usu_id`) REFERENCES `tbl_usuario` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tarefa`
--

LOCK TABLES `tbl_tarefa` WRITE;
/*!40000 ALTER TABLE `tbl_tarefa` DISABLE KEYS */;
INSERT INTO `tbl_tarefa` VALUES (3,9,2,'Coordenação Geral','Desfazer as malas','Como arrumar as malas','Aberta','Normal','2015-04-02','2015-06-01','00:12:00','2015-04-02 12:18:43','2015-05-26 20:42:50'),(8,11,2,'Coordenação Administrativa e Financeira','Lavar roupa','fasdfsdaf','Concluída','','0000-00-00','2015-05-31','00:00:00','2015-04-02 23:08:30','2015-05-12 12:08:06'),(9,9,2,'Coordenação de Produção','Verificar instalações','Ir no local tal e verificar a porra toda','Executando','Normal','2015-04-15','2015-05-31','00:30:00','2015-04-16 23:22:56','2015-05-12 12:08:01'),(10,9,2,'Coordenação de Comunicação','Divulgação da peça Apostila','caderinho','Aberta','Alta','0000-00-00','2015-05-30','00:00:00','2015-05-04 23:33:05','2015-05-12 12:07:48'),(11,9,2,'Coordenação de Comunicação','Divulgação da peça Arte slide/insert','123','Aberta','Normal',NULL,NULL,NULL,'2015-05-04 23:34:16','2015-05-04 23:34:16'),(12,9,2,'Coordenação Administrativa e Financeira','Adquirir o item ','4 pontas','Aberta','Normal','0000-00-00','2015-05-26','00:00:00','2015-05-04 23:39:41','2015-05-12 12:07:42'),(13,9,2,'Coordenação Administrativa e Financeira','Adquirir o item Aluguel de vaga/ Garagem','','Aprovada','Normal','0000-00-00','0000-00-00','00:00:00','2015-05-04 23:40:24','2015-05-05 21:47:32'),(14,9,2,'Coordenação Administrativa e Financeira','Adquirir o item Água','gelada','Aberta','Normal',NULL,NULL,NULL,'2015-05-04 23:40:59','2015-05-04 23:40:59'),(15,9,2,'Coordenação Administrativa e Financeira','Adquirir o item Contribuição Patronal','teste','Aberta','Normal',NULL,NULL,NULL,'2015-05-05 00:04:08','2015-05-05 00:04:08'),(16,9,2,'Coordenação Administrativa e Financeira','Adquirir o item Direitos Autorais','','Aberta','Normal',NULL,NULL,NULL,'2015-05-05 00:16:31','2015-05-05 00:16:31'),(18,9,2,'Coordenação Geral','Teste','teste','','Alta','0000-00-00','2015-05-29','00:00:00','2015-05-05 22:22:31','2015-05-26 20:42:54'),(19,11,2,'Coordenação Administrativa e Financeira','Tes','tes','','Urgente','0000-00-00','2015-05-16','00:00:00','2015-05-05 22:22:39','2015-05-12 12:07:12'),(21,9,2,'Coordenação de Comunicação','Divulgação da peça Anúncio de Rodapé','','Aberta','Normal',NULL,NULL,NULL,'2015-05-07 01:10:46','2015-05-07 01:10:46'),(22,11,2,'Coordenação de Produção','Com link','para o visu','Concluída','Urgente','0000-00-00','2015-05-16','00:00:00','2015-05-07 21:37:50','2015-05-12 12:07:29');
/*!40000 ALTER TABLE `tbl_tarefa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tipo`
--

DROP TABLE IF EXISTS `tbl_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tipo` (
  `tip_id` int(11) NOT NULL AUTO_INCREMENT,
  `tip_nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`tip_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipo`
--

LOCK TABLES `tbl_tipo` WRITE;
/*!40000 ALTER TABLE `tbl_tipo` DISABLE KEYS */;
INSERT INTO `tbl_tipo` VALUES (1,'1 - Eventos'),(2,'2 - Produtos de Cultura'),(3,'3 - Equipamentos Culturais');
/*!40000 ALTER TABLE `tbl_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usuario`
--

DROP TABLE IF EXISTS `tbl_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_usuario` (
  `usu_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_nome` varchar(255) DEFAULT NULL,
  `usu_email` varchar(255) DEFAULT NULL,
  `usu_senha` varchar(45) DEFAULT NULL,
  `usu_roteiro` varchar(1) DEFAULT NULL,
  `usu_criado_em` timestamp NULL DEFAULT NULL,
  `usu_modificado_em` timestamp NULL DEFAULT NULL,
  `usu_ultimo_login` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`usu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuario`
--

LOCK TABLES `tbl_usuario` WRITE;
/*!40000 ALTER TABLE `tbl_usuario` DISABLE KEYS */;
INSERT INTO `tbl_usuario` VALUES (9,'admin','admin@sistemaeva.com.br','bc38fd3f7d160c35550de2b4a0bf42903d74deff','0','2015-03-13 22:03:27','2015-06-11 01:19:03','2015-07-02 14:06:03'),(10,'Lucas Peixoto','lucaspeixoto.cco@gmail.com','bc38fd3f7d160c35550de2b4a0bf42903d74deff','1','2015-04-27 11:37:44','2015-05-04 11:50:21','2015-05-27 12:05:47'),(11,'Gabriele Evaristo','gabi@gabi.com','bc38fd3f7d160c35550de2b4a0bf42903d74deff','1','2015-04-28 12:05:20','2015-04-28 12:05:20','2015-04-28 12:05:30'),(12,'Paulo Joao ','teste@teste.com','293823ed1ab1255a3a4281e7a545755affa360d9','1','2015-06-11 01:04:13','2015-06-11 01:16:24','2015-06-11 01:04:22'),(13,'nome pklenoi','email@meial.om','ad13d2e1fb670afab3deb4fcbb922062866fdf31','1','2015-06-15 20:39:05','2015-06-15 20:39:05',NULL),(14,'nome completo','asdsad@asdsa.com','26b9d71e9d549a9cf92b14418a206828c5bae17e','1','2015-06-15 20:39:43','2015-06-15 20:39:43',NULL),(15,'nome cmpleto','mdmsa@masmdsa.com','6c15fc3083ac4a9586c2f4b1f897867a6a2e9f25','1','2015-06-15 20:40:37','2015-06-15 20:40:37',NULL),(16,'teste endereco','teste@endereco.com','ad13d2e1fb670afab3deb4fcbb922062866fdf31','1','2015-06-15 20:42:10','2015-06-15 20:42:10','2015-06-15 20:42:18');
/*!40000 ALTER TABLE `tbl_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_veiculo`
--

DROP TABLE IF EXISTS `tbl_veiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_veiculo` (
  `vei_id` int(11) NOT NULL AUTO_INCREMENT,
  `vei_eve_id` int(11) DEFAULT NULL,
  `vei_modelo` varchar(45) DEFAULT NULL,
  `vei_marca` varchar(45) DEFAULT NULL,
  `vei_cor` varchar(45) DEFAULT NULL,
  `vei_placa` varchar(45) DEFAULT NULL,
  `vei_lugares` int(11) DEFAULT NULL,
  PRIMARY KEY (`vei_id`),
  KEY `veiculo_evento_idx` (`vei_eve_id`),
  CONSTRAINT `veiculo_evento` FOREIGN KEY (`vei_eve_id`) REFERENCES `tbl_evento` (`eve_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_veiculo`
--

LOCK TABLES `tbl_veiculo` WRITE;
/*!40000 ALTER TABLE `tbl_veiculo` DISABLE KEYS */;
INSERT INTO `tbl_veiculo` VALUES (1,2,'corsa','vw','rosa','ast-32423',5);
/*!40000 ALTER TABLE `tbl_veiculo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-07-07  9:21:49
