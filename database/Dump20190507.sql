-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: 192.168.1.202    Database: sparky
-- ------------------------------------------------------
-- Server version	5.5.60-MariaDB

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
-- Table structure for table `ims_brands`
--

DROP TABLE IF EXISTS `ims_brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ims_brands` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(255) NOT NULL,
  `brand_active` int(11) NOT NULL DEFAULT '0',
  `brand_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ims_brands`
--

LOCK TABLES `ims_brands` WRITE;
/*!40000 ALTER TABLE `ims_brands` DISABLE KEYS */;
INSERT INTO `ims_brands` VALUES (1,'Nikki',1,1);
/*!40000 ALTER TABLE `ims_brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ims_categories`
--

DROP TABLE IF EXISTS `ims_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ims_categories` (
  `categories_id` int(11) NOT NULL AUTO_INCREMENT,
  `categories_name` varchar(255) NOT NULL,
  `categories_active` int(11) NOT NULL DEFAULT '0',
  `categories_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`categories_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ims_categories`
--

LOCK TABLES `ims_categories` WRITE;
/*!40000 ALTER TABLE `ims_categories` DISABLE KEYS */;
INSERT INTO `ims_categories` VALUES (1,'Carburetors',1,1);
/*!40000 ALTER TABLE `ims_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ims_clients`
--

DROP TABLE IF EXISTS `ims_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ims_clients` (
  `idims_clients` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_name` varchar(255) DEFAULT NULL,
  `client_phone` varchar(100) DEFAULT NULL,
  `client_email` varchar(255) DEFAULT NULL,
  `clent_address` varchar(255) DEFAULT NULL,
  `client_city` varchar(255) DEFAULT NULL,
  `client_state` varchar(45) DEFAULT NULL,
  `client_zip` varchar(45) DEFAULT NULL,
  `client_info` text,
  PRIMARY KEY (`idims_clients`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ims_clients`
--

LOCK TABLES `ims_clients` WRITE;
/*!40000 ALTER TABLE `ims_clients` DISABLE KEYS */;
INSERT INTO `ims_clients` VALUES (1,'test','124','bla@bla','1234','aabc','sa','01923','asdasdfasdf');
/*!40000 ALTER TABLE `ims_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ims_order_item`
--

DROP TABLE IF EXISTS `ims_order_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ims_order_item` (
  `order_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL DEFAULT '0',
  `quantity` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `order_item_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`order_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ims_order_item`
--

LOCK TABLES `ims_order_item` WRITE;
/*!40000 ALTER TABLE `ims_order_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `ims_order_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ims_orders`
--

DROP TABLE IF EXISTS `ims_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ims_orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_date` date NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_contact` varchar(255) NOT NULL,
  `sub_total` varchar(255) NOT NULL,
  `vat` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `grand_total` varchar(255) NOT NULL,
  `paid` varchar(255) NOT NULL,
  `due` varchar(255) NOT NULL,
  `payment_type` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `payment_place` int(11) NOT NULL,
  `gstn` varchar(255) NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ims_orders`
--

LOCK TABLES `ims_orders` WRITE;
/*!40000 ALTER TABLE `ims_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `ims_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ims_product`
--

DROP TABLE IF EXISTS `ims_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ims_product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `product_image` text NOT NULL,
  `brand_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ims_product`
--

LOCK TABLES `ims_product` WRITE;
/*!40000 ALTER TABLE `ims_product` DISABLE KEYS */;
INSERT INTO `ims_product` VALUES (1,'Nikki Carb xx','../assests/images/stock/16023418925cce1975d7d92.jpg',1,1,'10','110.00',1,1),(2,'Nikki Carburetor xx','../assests/images/stock/8410295155cce1a8961323.jpg',1,1,'10','100.00',1,1),(3,'test','../assests/images/stock/13162191375cce2378aa4a1.jpg',1,1,'12','111',1,1);
/*!40000 ALTER TABLE `ims_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ims_system`
--

DROP TABLE IF EXISTS `ims_system`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ims_system` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(20) NOT NULL,
  `zip` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `cell` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tax` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ims_system`
--

LOCK TABLES `ims_system` WRITE;
/*!40000 ALTER TABLE `ims_system` DISABLE KEYS */;
INSERT INTO `ims_system` VALUES (1,'NOLAParts.com','74292 Allen Rd.','Abita Springs','LA','70420','504-656-4335','504-656-4335','marc@3sys.com','10%');
/*!40000 ALTER TABLE `ims_system` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ims_users`
--

DROP TABLE IF EXISTS `ims_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ims_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ims_users`
--

LOCK TABLES `ims_users` WRITE;
/*!40000 ALTER TABLE `ims_users` DISABLE KEYS */;
INSERT INTO `ims_users` VALUES (1,'admin','43576184f07146236b8e2a2313218638','');
/*!40000 ALTER TABLE `ims_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-07  4:50:14
