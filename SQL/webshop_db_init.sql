CREATE DATABASE  IF NOT EXISTS `webshop` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `webshop`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: webshop
-- ------------------------------------------------------
-- Server version	5.7.11

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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `pic_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='kategoria';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Kijelző','mock_monitor'),(2,'Merevlemez','mock_hdd'),(3,'Processzor','mock_cpu'),(4,'Memóriakártya','mock_ram');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `user_role` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='vasarlo adatai';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (20,'a@b.hu','7815696ecbf1c96e6894b779456d330e','CUSTOMER'),(21,'teszt@elek.hu','6c90aa3760658846a86a263a4e92630e','CUSTOMER'),(22,'hodiger@gmail.com','7815696ecbf1c96e6894b779456d330e','MANAGER');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `id` varchar(128) CHARACTER SET utf8 NOT NULL,
  `amount` double NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_num` int(10) unsigned NOT NULL,
  `customer_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `customer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_phone` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_order_customer1_idx` (`customer_address`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='rendeles';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES ('15ee055b-62a5-4a98-bf4e-3fda19c7cebf',130000,'2016-11-29 21:06:52',5,'Budapest asdasd','teszt@elek.hu','teszt elek','123123'),('3b8b98c9-d3e0-40f7-a6cd-b0ff67699fde',46000,'2016-11-29 17:21:48',3,'Budapest asdasd','teszt@elek.hu','teszt elek','123123'),('4bb77c1c-0b69-4070-8969-57d82c3facb2',90000,'2016-12-05 11:37:18',9,'Budapest asdasd','a@b.hu','AB','123223'),('873b500c-768b-43cb-8890-8a12efe4e254',56000,'2016-11-29 16:57:16',1,'Budapest asdasd','teszt@elek.hu','teszt elek','123123'),('912014d2-c0c1-4baf-b535-de9786bc3a31',90000,'2016-12-05 12:22:23',10,'Budapest asdasd','a@b.hu','AB','123223'),('abee3aa5-5a58-4eb3-8eea-264c62536c82',62000,'2016-12-03 22:48:29',8,'Budapest asdasd','teszt@elek.hu','teszt elek','543543'),('bb24a7a9-2ed2-4dc2-a205-acc879eff301',200000,'2016-11-29 17:45:12',4,'Budapest asdasd','teszt@elek.hu','teszt elek','123123'),('bd87eae3-9011-4aa9-bb14-ea37fa0b08c8',135000,'2016-11-29 17:08:09',2,'Budapest asdasd','teszt@elek.hu','teszt elek','123123'),('c0a64784-de86-4ebb-a8b7-6fb528e02b81',130000,'2016-12-05 12:25:46',11,'Budapest asdasd','hodiger@gmail.com','Hodány Gerg?','123123'),('c274d37d-14c5-4c80-acee-cba0b76a7667',60000,'2016-11-30 02:23:51',6,'Budapest asdasd','hodiger@gmail.com','Hodány Gerg?','123123'),('e9d8f236-f4a1-47a7-8820-90dfaf852e46',86000,'2016-11-30 02:27:47',7,'Budapest asdasd','hodiger@gmail.com','Hodány Gerg?','asdasd');
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_details` (
  `id` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_id` varchar(128) CHARACTER SET utf8 NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ORDER_DETAIL_PROD_FK` (`product_id`),
  KEY `ORDER_DETAIL_ORD_FK_idx` (`order_id`),
  CONSTRAINT `ORDER_DETAIL_ORD_FK` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ORDER_DETAIL_PROD_FK` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_details`
--

LOCK TABLES `order_details` WRITE;
/*!40000 ALTER TABLE `order_details` DISABLE KEYS */;
INSERT INTO `order_details` VALUES ('07b4454c-6875-44b0-96ba-33243a661e63',20000,20000,1,'c274d37d-14c5-4c80-acee-cba0b76a7667',37),('21eaab4d-028c-4dbc-84a7-9ee8afbe48fb',40000,40000,1,'912014d2-c0c1-4baf-b535-de9786bc3a31',33),('2ad9cdea-c1a9-4657-95ec-d70caf6d3f78',50000,50000,1,'4bb77c1c-0b69-4070-8969-57d82c3facb2',34),('50a8cc17-d95d-46f2-a6bf-083870fadd9f',22000,22000,1,'3b8b98c9-d3e0-40f7-a6cd-b0ff67699fde',38),('61aa1887-e908-4769-b2bb-0e5a8bce6fb3',70000,70000,1,'c0a64784-de86-4ebb-a8b7-6fb528e02b81',36),('6ca5a7d6-d31a-4fc0-8c17-8a6b5e4b8df2',40000,40000,1,'abee3aa5-5a58-4eb3-8eea-264c62536c82',33),('6de4ed16-535b-4d17-9110-a0f00d7265a8',60000,60000,1,'c0a64784-de86-4ebb-a8b7-6fb528e02b81',35),('771ce073-7ff1-47cc-8be8-94662db27b03',60000,60000,1,'15ee055b-62a5-4a98-bf4e-3fda19c7cebf',35),('7e885384-d91f-473a-9f7a-90efc0311821',24000,24000,1,'3b8b98c9-d3e0-40f7-a6cd-b0ff67699fde',39),('8bdadf16-ee99-4449-9b70-ec1b4006c2da',70000,70000,1,'bb24a7a9-2ed2-4dc2-a205-acc879eff301',36),('8d5d9097-434b-452c-a104-fa5c5f6ef76f',130000,65000,2,'bb24a7a9-2ed2-4dc2-a205-acc879eff301',44),('914f2a74-dbb3-425e-83ed-818ebc34f9d4',40000,40000,1,'c274d37d-14c5-4c80-acee-cba0b76a7667',33),('a1da1116-6cb6-4027-ae51-d3f2b158ef40',65000,65000,1,'bd87eae3-9011-4aa9-bb14-ea37fa0b08c8',44),('a4e560bd-3aa2-4a45-9249-120fed16d002',26000,26000,1,'e9d8f236-f4a1-47a7-8820-90dfaf852e46',40),('c249d0ef-a499-41da-8d0e-75ba89a03b6a',70000,70000,1,'bd87eae3-9011-4aa9-bb14-ea37fa0b08c8',36),('c4e42b30-94ec-4e31-8d97-2a5916586915',50000,50000,1,'912014d2-c0c1-4baf-b535-de9786bc3a31',34),('d55ba9d6-b543-49b3-8ad2-c84787f2a1fb',60000,60000,1,'e9d8f236-f4a1-47a7-8820-90dfaf852e46',35),('d9a449c9-7bc5-4f9f-bbc1-71ef35cde9ac',70000,70000,1,'15ee055b-62a5-4a98-bf4e-3fda19c7cebf',36),('dcd33f28-6ec6-4d0a-b6d4-5f3836e30eb8',24000,24000,1,'873b500c-768b-43cb-8890-8a12efe4e254',39),('e42ba7f5-a9e6-43e1-b813-49695c5977b9',40000,40000,1,'4bb77c1c-0b69-4070-8969-57d82c3facb2',33),('f6dcb62e-065e-4c98-8bea-cb75d107b9f7',22000,22000,1,'abee3aa5-5a58-4eb3-8eea-264c62536c82',38),('f72216d9-61c3-4b36-a2ed-7d3d4d919ee8',32000,32000,1,'873b500c-768b-43cb-8890-8a12efe4e254',46);
/*!40000 ALTER TABLE `order_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(7,0) NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_category_idx` (`category_id`),
  CONSTRAINT `fk_product_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='termek';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (33,'Kijelző1',40000,1),(34,'Kijelző2',50000,1),(35,'Kijelző3',60000,1),(36,'Kijelző4',70000,1),(37,'Merevlemez1',20000,2),(38,'Merevlemez2',22000,2),(39,'Merevlemez3',24000,2),(40,'Merevlemez4',26000,2),(41,'Processzor1',50000,3),(42,'Processzor2',55000,3),(43,'Processzor3',60000,3),(44,'Processzor4',65000,3),(45,'Memóriakártya1',30000,4),(46,'Memóriakártya1',32000,4),(47,'Memóriakártya1',34000,4),(48,'Memóriakártya1',36000,4);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-05 23:06:57
