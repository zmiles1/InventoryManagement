-- MySQL dump 10.13  Distrib 5.7.28, for Linux (x86_64)
--
-- Host: localhost    Database: chickens
-- ------------------------------------------------------
-- Server version	5.7.28-0ubuntu0.18.04.4

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
-- Table structure for table `Bird_type`
--

DROP TABLE IF EXISTS `Bird_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Bird_type` (
  `bird_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `bird_desc` varchar(90) DEFAULT NULL,
  `unit_sold` enum('pound','head') DEFAULT NULL,
  `default_price` decimal(3,2) DEFAULT NULL,
  PRIMARY KEY (`bird_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Bird_type`
--

LOCK TABLES `Bird_type` WRITE;
/*!40000 ALTER TABLE `Bird_type` DISABLE KEYS */;
INSERT INTO `Bird_type` VALUES (29,'yellow pullet','pound',1.70),(30,'gray pullet','pound',1.70),(31,'yellow cockerel','pound',1.50),(32,'gray cockerel','pound',1.50),(33,'white pullet','pound',0.85),(34,'white cockerel','pound',0.85),(35,'white rooster','pound',0.95),(36,'white baby','pound',0.90),(37,'white straight run','pound',0.85),(38,'gray baby','pound',1.75),(39,'yellow baby','pound',1.75),(40,'silky','head',4.50),(41,'red fowl','head',2.25),(42,'white breeder fowl','pound',0.70),(43,'old white cockerel','pound',0.70),(44,'guinea hen','pound',1.65),(45,'turkey - tom','pound',1.25),(46,'turkey - hen','pound',1.15);
/*!40000 ALTER TABLE `Bird_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Building`
--

DROP TABLE IF EXISTS `Building`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Building` (
  `building_id` int(11) NOT NULL AUTO_INCREMENT,
  `building_number` int(11) NOT NULL,
  `building_floor` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`building_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Building`
--

LOCK TABLES `Building` WRITE;
/*!40000 ALTER TABLE `Building` DISABLE KEYS */;
INSERT INTO `Building` VALUES (1,1,'lower'),(2,1,'upper'),(3,2,'lower'),(4,2,'upper'),(5,3,'lower'),(6,3,'upper'),(7,4,'lower'),(8,4,'upper'),(9,5,'lower'),(10,5,'upper'),(11,6,'lower'),(12,6,'upper'),(13,7,'lower');
/*!40000 ALTER TABLE `Building` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Delivery`
--

DROP TABLE IF EXISTS `Delivery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Delivery` (
  `delivery_id` int(11) NOT NULL AUTO_INCREMENT,
  `truck_driver_id` int(11) NOT NULL,
  `stop_in_route` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `total_coops` int(11) NOT NULL,
  PRIMARY KEY (`delivery_id`),
  KEY `truck_driver_fk_idx` (`truck_driver_id`),
  KEY `store_fk_idx` (`store_id`),
  CONSTRAINT `store_fk` FOREIGN KEY (`store_id`) REFERENCES `Store` (`store_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `truck_driver_fk` FOREIGN KEY (`truck_driver_id`) REFERENCES `Truck_Driver` (`truck_driver_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=174 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Delivery`
--

LOCK TABLES `Delivery` WRITE;
/*!40000 ALTER TABLE `Delivery` DISABLE KEYS */;
INSERT INTO `Delivery` VALUES (100,104,1,15,21),(111,110,1,11,57),(112,110,2,32,18),(113,110,3,33,7),(114,110,4,22,8),(123,113,1,15,1),(124,113,2,23,254),(125,114,1,29,6),(126,114,2,30,5),(127,114,3,12,7),(128,114,4,16,7),(131,116,1,25,50),(132,116,2,30,100),(154,124,1,15,45),(155,124,2,26,33),(160,126,1,22,15),(161,126,2,29,20),(162,126,3,23,20),(163,126,4,24,40),(164,127,1,28,18),(171,132,1,36,28),(172,132,2,34,6),(173,132,3,30,15);
/*!40000 ALTER TABLE `Delivery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Delivery_Order`
--

DROP TABLE IF EXISTS `Delivery_Order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Delivery_Order` (
  `delivery_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `delivery_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  PRIMARY KEY (`delivery_order_id`),
  KEY `delivery_id` (`delivery_id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `Delivery_Order_ibfk_1` FOREIGN KEY (`delivery_id`) REFERENCES `Delivery` (`delivery_id`),
  CONSTRAINT `Delivery_Order_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `Orders` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=548 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Delivery_Order`
--

LOCK TABLES `Delivery_Order` WRITE;
/*!40000 ALTER TABLE `Delivery_Order` DISABLE KEYS */;
INSERT INTO `Delivery_Order` VALUES (318,100,57),(319,100,58),(320,100,59),(321,100,60),(322,100,61),(323,100,106),(347,111,90),(348,111,124),(350,112,73),(351,112,81),(352,112,82),(353,112,83),(357,113,79),(358,113,80),(360,114,68),(361,114,70),(380,124,69),(381,124,128),(382,124,129),(383,124,130),(384,124,131),(387,125,71),(389,127,99),(390,127,100),(392,128,125),(393,128,126),(394,128,127),(403,131,151),(404,132,152),(405,132,153),(406,132,154),(407,132,155),(460,154,199),(461,154,200),(462,154,201),(463,155,204),(464,155,205),(465,155,206),(488,160,253),(489,161,248),(490,161,249),(492,162,250),(493,162,251),(494,162,252),(495,163,240),(496,163,241),(497,163,242),(498,163,243),(499,163,244),(500,163,245),(501,163,246),(502,163,247),(510,164,284),(511,164,285),(512,164,286),(535,171,291),(536,171,292),(537,171,293),(538,171,294),(539,171,295),(540,171,296),(541,171,298),(542,172,287),(543,172,288),(544,172,289),(545,173,263),(546,173,264),(547,173,265);
/*!40000 ALTER TABLE `Delivery_Order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Dispatch`
--

DROP TABLE IF EXISTS `Dispatch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Dispatch` (
  `dispatch_id` int(11) NOT NULL AUTO_INCREMENT,
  `driver_id` int(11) DEFAULT NULL,
  `truck_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`dispatch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Dispatch`
--

LOCK TABLES `Dispatch` WRITE;
/*!40000 ALTER TABLE `Dispatch` DISABLE KEYS */;
/*!40000 ALTER TABLE `Dispatch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Driver`
--

DROP TABLE IF EXISTS `Driver`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Driver` (
  `driver_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT 'null',
  `last_name` varchar(45) DEFAULT 'null',
  `phone_number` varchar(45) DEFAULT 'null',
  `date_of_birth` datetime DEFAULT NULL,
  `license_st` varchar(45) DEFAULT NULL,
  `license_number` varchar(45) DEFAULT NULL,
  `license_type` enum('CDL','NON-CDL') DEFAULT NULL,
  `license_expiration` datetime DEFAULT NULL,
  `medical_expiration` datetime DEFAULT NULL,
  `transmission_type` enum('MANUAL','AUTOMATIC') DEFAULT NULL,
  `driver_status` smallint(2) DEFAULT NULL,
  `user_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`driver_id`),
  KEY `FK_user_driver_idx` (`user_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Driver`
--

LOCK TABLES `Driver` WRITE;
/*!40000 ALTER TABLE `Driver` DISABLE KEYS */;
INSERT INTO `Driver` VALUES (1,'Andrew','Glouberman','1231231234','2000-04-02 00:00:00','NJ','1234567','CDL','2020-09-28 00:00:00','2022-07-19 00:00:00','MANUAL',0,31),(2,'Nick','Birch','1111111111','1999-12-22 00:00:00','NY','5437895','NON-CDL','2026-05-01 00:00:00','2021-12-24 00:00:00','AUTOMATIC',0,35),(3,'Peter','Griffin','9879879876','1974-07-19 00:00:00','RI','70432C6','CDL','2022-11-18 00:00:00','2023-03-03 00:00:00','MANUAL',1,32),(4,'Lorelai','Gilmore','2223334444','1984-10-02 00:00:00','PA','324IPO8','CDL','2024-03-19 00:00:00','2026-06-29 00:00:00','MANUAL',1,30),(7,'Lane','Kim','2022022020','1982-07-03 00:00:00','MD','FIS2JD2','CDL','2030-09-22 00:00:00','2025-04-05 00:00:00','AUTOMATIC',1,34),(9,'Luke','Danes','4441117777','1950-03-03 00:00:00','NY','REW3214','CDL','2033-03-03 00:00:00','2044-04-04 00:00:00','MANUAL',1,33),(26,'John','Cena','6096687931','2019-12-20 00:00:00','NJ','6516514','NON-CDL','2019-12-13 00:00:00','2019-12-11 00:00:00','MANUAL',1,28),(30,'Connor','Astemborski','5648491894','2019-12-18 00:00:00','NJ','5616516','CDL','2019-12-27 00:00:00','2019-12-18 00:00:00','AUTOMATIC',1,36),(79,'John','DiSteffano','555 555 5555','1997-12-28 00:00:00','NJ','123456789','CDL','2019-12-28 00:00:00','2019-12-28 00:00:00','AUTOMATIC',1,42),(80,'Joe','Kim','6096687931','2019-12-17 00:00:00','New Jersey','123124','CDL','2019-12-27 00:00:00','2019-12-18 00:00:00','AUTOMATIC',1,44),(81,'Trucky','McTruckFace','6096687931','1978-02-22 00:00:00','NJ','598542','CDL','2023-06-14 00:00:00','2028-03-09 00:00:00','MANUAL',1,37),(82,'Tommy','Wiseau','5555555555','1990-12-17 00:00:00','NJ','12345','CDL','2020-06-16 00:00:00','2020-02-11 00:00:00','AUTOMATIC',1,43);
/*!40000 ALTER TABLE `Driver` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Farm`
--

DROP TABLE IF EXISTS `Farm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Farm` (
  `farm_id` int(11) NOT NULL AUTO_INCREMENT,
  `farm_name` varchar(60) NOT NULL,
  `farm_address` varchar(45) DEFAULT NULL,
  `farm_city` varchar(45) NOT NULL,
  PRIMARY KEY (`farm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Farm`
--

LOCK TABLES `Farm` WRITE;
/*!40000 ALTER TABLE `Farm` DISABLE KEYS */;
INSERT INTO `Farm` VALUES (3,'Webster','20 Main St','New York City'),(33,'Lakewood','500 Broad St','Philadelphia'),(34,'Livestock','3 Third Ave','New Brunswick'),(35,'Lee','306 Johnson St','Brooklyn'),(36,'Shaffer','10 Fifth Ave','Lancaster'),(89,'Penn Farm','141 Coles Rd','Pittsburgh'),(90,'Zimmerman','30 Look Ave','Philadelphia'),(91,'Hamming','85 Pine Way','Red Bank'),(92,'Cooper','600 Hamilton Rd','Milford'),(94,'New Farm Era','510 Breakneck Road','Swedesboro'),(95,'Old MacDonald\'s','31310 Farm Rd','Farmville'),(97,'Prestige Farms World Wide','255 Anchor Road','Somerset'),(98,'Rowan','26 Street','glassboro');
/*!40000 ALTER TABLE `Farm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Flock`
--

DROP TABLE IF EXISTS `Flock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Flock` (
  `flock_id` int(11) NOT NULL AUTO_INCREMENT,
  `bird_type_id` int(11) NOT NULL,
  `farm_id` int(11) NOT NULL,
  `birds_per_coop` int(11) DEFAULT NULL,
  `building_id` int(11) NOT NULL,
  `delivery_date` date DEFAULT NULL,
  `hatchlings` int(11) DEFAULT NULL,
  `flock_mortality` int(11) DEFAULT NULL,
  `flock_weight` double(4,2) DEFAULT NULL,
  `health_cert_url` varchar(45) DEFAULT NULL,
  `available` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`flock_id`),
  KEY `farm_flock_id_idx` (`farm_id`),
  KEY `building_flock_id_idx` (`building_id`),
  KEY `bird_type_flock_id_idx` (`bird_type_id`),
  CONSTRAINT `bird_type_flock_id` FOREIGN KEY (`bird_type_id`) REFERENCES `Bird_type` (`bird_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `building_flock_id` FOREIGN KEY (`building_id`) REFERENCES `Building` (`building_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `farm_flock_id` FOREIGN KEY (`farm_id`) REFERENCES `Farm` (`farm_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Flock`
--

LOCK TABLES `Flock` WRITE;
/*!40000 ALTER TABLE `Flock` DISABLE KEYS */;
INSERT INTO `Flock` VALUES (22,41,3,8,1,'2019-12-18',20,NULL,5.50,NULL,1),(23,42,3,10,2,'2019-11-01',0,NULL,4.90,NULL,1),(24,40,33,18,4,'2019-10-31',15000,NULL,2.30,NULL,1),(25,36,36,16,2,'2019-10-29',12000,NULL,3.05,NULL,1),(26,35,89,5,3,'2019-12-18',0,NULL,8.75,NULL,1),(27,39,34,14,5,'2019-10-29',9001,NULL,3.55,NULL,1),(30,29,33,9,1,'2019-11-01',11600,NULL,NULL,NULL,1),(32,35,33,15,4,'2019-11-25',150,NULL,NULL,NULL,1),(35,31,3,15,1,'2019-12-18',9500,NULL,NULL,NULL,1),(45,29,3,10,1,'2019-12-31',0,NULL,NULL,NULL,1),(46,41,35,10,5,'2019-12-18',30500,NULL,NULL,NULL,1),(47,44,90,15,11,'2019-12-25',1500,NULL,NULL,NULL,1),(48,40,92,NULL,3,'2019-12-03',300,NULL,NULL,NULL,NULL),(52,45,94,NULL,10,'2019-12-13',4500,NULL,NULL,NULL,NULL),(54,29,95,NULL,1,'2019-12-15',12000,NULL,NULL,NULL,NULL),(55,30,95,NULL,2,'2019-12-15',11900,NULL,NULL,NULL,NULL),(56,43,91,NULL,10,'2019-12-10',500,NULL,NULL,NULL,NULL),(57,41,90,NULL,10,'2019-12-19',5000,NULL,NULL,NULL,NULL),(58,42,95,NULL,12,'2019-12-24',4000,NULL,NULL,NULL,NULL),(59,45,33,NULL,4,'2019-12-21',2000,NULL,NULL,NULL,NULL),(60,34,34,NULL,8,'2019-12-18',4000,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `Flock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Invoice`
--

DROP TABLE IF EXISTS `Invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Invoice` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_date` date NOT NULL,
  `truck_driver_id` int(11) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `dispatch_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`invoice_id`),
  KEY `truck_driver_id_idx` (`truck_driver_id`),
  KEY `store_id_idx` (`store_id`),
  KEY `FK_dispatchinvoice_idx` (`dispatch_id`),
  CONSTRAINT `FK_dispatchinvoice` FOREIGN KEY (`dispatch_id`) REFERENCES `Dispatch` (`dispatch_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `store_id` FOREIGN KEY (`store_id`) REFERENCES `Store` (`store_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `truck_driver_id` FOREIGN KEY (`truck_driver_id`) REFERENCES `Truck_Driver` (`truck_driver_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Invoice`
--

LOCK TABLES `Invoice` WRITE;
/*!40000 ALTER TABLE `Invoice` DISABLE KEYS */;
INSERT INTO `Invoice` VALUES (6,'2019-12-01',1,11,NULL),(7,'2019-12-01',2,15,NULL),(8,'2019-12-01',NULL,13,NULL),(9,'2019-12-01',NULL,12,NULL),(10,'2019-12-01',1,15,NULL),(11,'2019-12-01',2,13,NULL),(12,'2019-12-01',1,11,NULL),(13,'2019-12-01',NULL,16,NULL),(14,'2019-12-01',NULL,22,NULL),(15,'2019-12-01',NULL,23,NULL),(16,'2019-12-01',NULL,29,NULL),(17,'2019-12-01',NULL,30,NULL),(18,'2019-12-01',NULL,32,NULL),(19,'2019-12-01',NULL,35,NULL),(20,'2019-12-01',NULL,33,NULL),(21,'2019-12-01',NULL,31,NULL),(22,'2019-12-01',NULL,34,NULL),(23,'2019-12-02',NULL,16,NULL),(24,'2019-12-04',NULL,11,NULL),(25,'2019-12-02',NULL,24,NULL),(26,'2019-12-02',NULL,12,NULL),(27,'2019-12-02',NULL,13,NULL),(28,'2019-12-03',NULL,15,NULL),(29,'2019-12-03',NULL,24,NULL),(30,'2019-12-03',NULL,22,NULL),(31,'2019-12-05',NULL,16,NULL),(32,'2019-12-06',NULL,16,NULL),(33,'2019-12-10',NULL,29,NULL),(34,'2019-12-02',NULL,30,NULL),(35,'2019-12-04',NULL,11,NULL),(36,'2019-12-04',NULL,16,NULL),(37,'2019-12-04',NULL,23,NULL),(38,'2019-12-04',NULL,28,NULL),(39,'2019-12-05',NULL,12,NULL),(40,'2019-12-10',NULL,11,NULL),(41,'2019-12-11',NULL,15,NULL),(42,'2019-12-11',NULL,28,NULL),(43,'2019-12-12',NULL,22,NULL),(44,'2019-12-12',NULL,25,NULL),(45,'2019-12-12',NULL,30,NULL),(46,'2019-12-15',NULL,36,NULL),(47,'2019-12-15',NULL,11,NULL),(48,'2019-12-15',NULL,36,NULL),(49,'2019-12-15',NULL,24,NULL),(50,'2019-12-19',NULL,11,NULL),(51,'2019-12-18',NULL,11,NULL),(52,'2019-12-18',NULL,11,NULL),(53,'2019-12-18',NULL,11,NULL),(54,'2019-12-14',NULL,15,NULL),(55,'2019-12-15',NULL,16,NULL),(56,'2019-12-15',NULL,14,NULL),(57,'2019-12-15',NULL,16,NULL),(58,'2019-12-15',NULL,22,NULL),(59,'2019-12-16',NULL,11,NULL),(60,'2019-12-17',NULL,15,NULL),(61,'2019-12-16',NULL,35,NULL),(62,'2019-12-17',NULL,26,NULL),(63,'2019-12-18',NULL,11,NULL),(64,'2019-12-18',NULL,16,NULL),(65,'2019-12-18',NULL,15,NULL),(66,'2019-12-18',NULL,22,NULL),(67,'2019-12-18',NULL,22,NULL),(68,'2019-12-17',NULL,31,NULL),(69,'2019-12-17',NULL,24,NULL),(70,'2019-12-17',NULL,29,NULL),(71,'2019-12-17',NULL,23,NULL),(72,'2019-12-17',NULL,22,NULL),(73,'2019-12-18',NULL,15,NULL),(74,'2019-12-18',NULL,30,NULL),(75,'2019-12-18',NULL,22,NULL),(76,'2019-12-18',NULL,22,NULL),(77,'2019-12-18',NULL,16,NULL),(78,'2019-12-18',NULL,16,NULL),(79,'2019-12-18',NULL,28,NULL),(80,'2019-12-18',NULL,34,NULL),(81,'2019-12-18',NULL,36,NULL),(82,'2019-12-18',NULL,16,NULL),(83,'2019-12-18',NULL,32,NULL),(84,'2019-12-18',NULL,32,NULL),(85,'2019-12-18',NULL,32,NULL),(86,'2019-12-18',NULL,32,NULL),(87,'2019-12-18',NULL,35,NULL),(88,'2019-12-18',NULL,32,NULL),(89,'2019-12-18',NULL,32,NULL),(90,'2019-12-18',NULL,39,NULL),(91,'2019-12-18',NULL,40,NULL);
/*!40000 ALTER TABLE `Invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Manager`
--

DROP TABLE IF EXISTS `Manager`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Manager` (
  `manager_id` int(11) NOT NULL AUTO_INCREMENT,
  `manager_name` varchar(45) DEFAULT NULL,
  `manager_phone` bigint(14) DEFAULT NULL,
  PRIMARY KEY (`manager_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Manager`
--

LOCK TABLES `Manager` WRITE;
/*!40000 ALTER TABLE `Manager` DISABLE KEYS */;
INSERT INTO `Manager` VALUES (1,'Barry Boswick',8565551212),(2,'Chester Copperpot',6095551212),(3,'Hermoine Granger',2155551212),(4,'George Costanza',2128646137),(5,'John DiStefano',8561234567),(6,'Belinda Bloomenthal',3213213211),(7,'Bella Ridley',3334445555),(8,'Alfonz Stirbacker',7778889999),(9,'Jim Sterling',3453453455),(10,'Peter Rouse',8885552222),(11,'Tony Sylvester',980980988),(12,'Giselle Marzchakoverdeklotz',4324324322),(13,'Cosmo Macaroon',1011011010),(14,'Ken Dewsbury',8488488484),(15,'Patrick O\'Hamlin',4344344343),(16,'Dez Martin',1234567890),(17,'Dave Wilcox',3332221111),(18,'Georgie Porgey',8658658654),(19,'James Spooner',4782938746),(20,'Chiara Montegue',1092746597);
/*!40000 ALTER TABLE `Manager` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Message`
--

DROP TABLE IF EXISTS `Message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `content` longtext,
  `date_created` timestamp NULL DEFAULT NULL,
  `flockmanager_flag` tinyint(4) DEFAULT NULL,
  `salesmanager_flag` tinyint(4) DEFAULT NULL,
  `truckdriver_flag` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`message_id`),
  KEY `user_message_id_idx` (`user_id`),
  CONSTRAINT `user_message_id` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_ID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=180 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Message`
--

LOCK TABLES `Message` WRITE;
/*!40000 ALTER TABLE `Message` DISABLE KEYS */;
INSERT INTO `Message` VALUES (1,4,'This is an example message for Sales Managers.','2019-12-04 00:00:00',0,1,0),(2,4,'This is an example message for Flock Managers.','2019-12-04 00:00:00',1,0,0),(3,9,'Who’s better at math than a robot? They’re made of math!','2019-12-04 00:00:00',1,1,1),(4,10,'Hey you guys are watching Bird Up, the worst show on television!','2019-12-04 00:00:00',1,1,1),(5,15,'Everybody betray me! I fed up with this world.','2019-12-04 00:00:00',1,1,1),(6,4,'My boy, this peace is what all true warriors strive for.','2019-12-04 00:00:00',1,1,1),(7,13,'Ah buckle this: LUDICROUS SPEED, GO!.','2019-12-04 00:00:00',1,1,1),(8,4,'This is an example message for Truck Drivers.','2019-12-04 00:00:00',0,0,1),(9,5,'This is an example message for ALL USERS.','2019-12-04 00:00:00',1,1,1),(114,5,'Happy holidays!','2019-12-04 00:00:00',1,1,1),(115,15,'New Messages are cool','2019-12-04 00:00:00',1,1,1),(116,15,'Happy Holidays!\n','2019-12-03 16:24:41',1,1,1),(117,15,'New Message','2019-12-03 17:16:37',1,1,1),(118,15,'Start Sellling Chickens','2019-12-09 14:32:03',0,1,0),(119,15,'Test','2019-12-09 14:32:26',0,0,1),(120,15,'Test','2019-12-09 14:32:43',1,0,0),(121,13,'Oh hi Mark','2019-12-10 15:12:16',1,1,1),(122,15,'Happy Holidays!','2019-12-10 15:14:11',1,1,1),(123,15,'Hey','2019-12-12 12:04:31',1,1,1),(124,15,'Happy Holidays!','2019-12-14 04:11:40',1,1,1),(125,15,'New','2019-12-14 14:10:16',0,1,0),(126,15,'asdf','2019-12-14 14:10:26',0,1,0),(127,15,'lklklkl','2019-12-14 17:21:20',0,0,0),(128,15,'hey','2019-12-14 17:21:44',1,1,1),(129,13,'This is Sparta','2019-12-14 19:53:12',1,1,1),(130,13,'jfdklsa;','2019-12-15 20:49:28',1,1,1),(131,15,'Howdy','2019-12-16 17:34:44',1,1,1),(132,15,'Have a great clucking day, everyone!','2019-12-17 00:37:29',1,1,1),(133,15,'Flock Managers, update your hatchling counts today!','2019-12-17 00:39:10',1,0,0),(138,15,'Truck drivers, roads are very icy. be careful!','2019-12-17 01:10:44',0,0,1),(142,15,'Sales managers, be sure to set your dispatches!','2019-12-17 01:17:57',0,1,0),(179,5,'Happy Holidays!','2019-12-17 15:52:18',1,1,1);
/*!40000 ALTER TABLE `Message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Order_Weights`
--

DROP TABLE IF EXISTS `Order_Weights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Order_Weights` (
  `order_weights_id` int(11) NOT NULL AUTO_INCREMENT,
  `weight_1` int(11) DEFAULT NULL,
  `weight_2` int(11) DEFAULT NULL,
  `num_coops` int(11) DEFAULT NULL,
  `flock_id` int(11) DEFAULT NULL,
  `trailer_id` int(11) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `bird_weight` double(5,3) DEFAULT NULL,
  PRIMARY KEY (`order_weights_id`),
  KEY `trailer_weight_id_idx` (`trailer_id`),
  KEY `flock_wieght_id_idx` (`flock_id`),
  CONSTRAINT `flock_wieght_id` FOREIGN KEY (`flock_id`) REFERENCES `Flock` (`flock_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `trailer_weight_id` FOREIGN KEY (`trailer_id`) REFERENCES `Trailer` (`trailer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Order_Weights`
--

LOCK TABLES `Order_Weights` WRITE;
/*!40000 ALTER TABLE `Order_Weights` DISABLE KEYS */;
INSERT INTO `Order_Weights` VALUES (1,350,351,10,22,1,'2019-11-11',NULL),(2,350,351,10,22,2,'2019-11-11',NULL),(3,350,350,10,23,3,'2019-11-18',NULL),(4,350,350,10,23,4,'2019-11-18',NULL),(5,355,351,10,22,5,'2019-11-19',NULL),(6,50,50,2,22,6,'2019-11-20',NULL),(7,70,70,2,24,7,'2019-11-20',NULL),(8,350,351,10,30,8,'2019-11-22',NULL),(9,350,351,10,32,9,'2019-11-23',NULL),(10,350,351,10,32,10,'2019-11-23',NULL),(11,356,359,10,27,11,'2019-11-24',4.036),(12,350,351,10,46,12,'2019-12-20',NULL),(13,150,155,10,24,13,'2019-12-20',NULL);
/*!40000 ALTER TABLE `Order_Weights` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Orders`
--

DROP TABLE IF EXISTS `Orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) DEFAULT NULL,
  `number_coops` int(11) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `flock_id` int(11) DEFAULT NULL,
  `order_weights_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `invoice_order_id_idx` (`invoice_id`),
  KEY `store_order_id_idx` (`store_id`),
  KEY `flock_order_id_idx` (`flock_id`),
  KEY `order_weights_id_idx` (`order_weights_id`),
  CONSTRAINT `flock_order_id` FOREIGN KEY (`flock_id`) REFERENCES `Flock` (`flock_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `invoice_order_id` FOREIGN KEY (`invoice_id`) REFERENCES `Invoice` (`invoice_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `order_weights_id` FOREIGN KEY (`order_weights_id`) REFERENCES `Order_Weights` (`order_weights_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `store_order_id` FOREIGN KEY (`store_id`) REFERENCES `Store` (`store_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=320 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Orders`
--

LOCK TABLES `Orders` WRITE;
/*!40000 ALTER TABLE `Orders` DISABLE KEYS */;
INSERT INTO `Orders` VALUES (51,6,4,11,22,NULL,NULL,'2019-12-03'),(52,6,3,11,23,NULL,NULL,'2019-12-03'),(54,6,2,11,26,NULL,NULL,'2019-12-03'),(55,6,4,11,24,NULL,NULL,'2019-12-03'),(56,6,3,11,27,NULL,NULL,'2019-12-03'),(57,7,4,15,24,NULL,NULL,'2019-12-03'),(58,7,4,15,26,NULL,NULL,'2019-12-03'),(59,7,4,15,23,NULL,NULL,'2019-12-03'),(60,10,5,15,26,NULL,NULL,'2019-12-03'),(61,10,3,15,23,NULL,NULL,'2019-12-03'),(62,12,3,11,22,NULL,NULL,'2019-12-03'),(63,12,1,11,25,NULL,NULL,'2019-12-03'),(68,14,4,22,22,NULL,NULL,'2019-12-04'),(69,15,4,23,22,NULL,NULL,'2019-12-04'),(70,14,4,22,45,NULL,NULL,'2019-12-04'),(71,16,6,29,46,NULL,NULL,'2019-12-04'),(73,18,6,32,32,NULL,NULL,'2019-12-04'),(74,19,3,35,22,NULL,NULL,'2019-12-04'),(75,19,4,35,24,NULL,NULL,'2019-12-04'),(76,19,5,35,25,NULL,NULL,'2019-12-03'),(77,19,5,35,46,NULL,NULL,'2019-12-04'),(78,20,5,33,35,NULL,NULL,'2019-12-03'),(79,20,4,33,32,NULL,NULL,'2019-12-04'),(80,20,3,33,24,NULL,NULL,'2019-12-04'),(81,18,4,32,30,NULL,NULL,'2019-12-04'),(82,18,4,32,26,NULL,NULL,'2019-12-04'),(83,18,4,32,24,NULL,NULL,'2019-12-04'),(86,22,4,34,46,NULL,NULL,'2019-12-04'),(87,22,5,34,47,NULL,NULL,'2019-12-04'),(90,24,1,11,23,NULL,NULL,'2019-12-04'),(92,25,14,24,25,NULL,NULL,'2019-12-04'),(93,25,10,24,22,NULL,NULL,'2019-12-04'),(94,25,18,24,27,NULL,NULL,'2019-12-04'),(95,25,16,24,26,NULL,NULL,'2019-12-04'),(96,25,20,24,46,NULL,NULL,'2019-12-04'),(97,25,24,24,35,NULL,NULL,'2019-12-04'),(98,25,22,24,47,NULL,NULL,'2019-12-04'),(99,26,3,12,22,NULL,NULL,'2019-12-04'),(100,26,4,12,23,NULL,NULL,'2019-12-04'),(103,27,2,13,25,NULL,NULL,'2019-12-04'),(104,27,4,13,27,NULL,NULL,'2019-12-04'),(105,27,1,13,24,NULL,NULL,'2019-12-04'),(106,28,1,15,30,NULL,NULL,'2019-12-03'),(109,30,1,22,27,NULL,NULL,'2019-12-03'),(110,30,2,22,46,NULL,NULL,'2019-12-03'),(111,30,3,22,24,NULL,NULL,'2019-12-03'),(112,31,1,16,22,NULL,NULL,'2019-12-05'),(113,31,2,16,23,NULL,NULL,'2019-12-05'),(114,31,3,16,25,NULL,NULL,'2019-12-05'),(115,31,4,16,26,NULL,NULL,'2019-12-05'),(116,31,5,16,46,NULL,NULL,'2019-12-05'),(120,33,2,29,25,NULL,NULL,'2019-12-10'),(121,33,3,29,27,NULL,NULL,'2019-12-10'),(122,33,1,29,22,NULL,NULL,'2019-12-10'),(124,35,56,11,46,NULL,NULL,'2019-12-04'),(125,36,2,16,22,NULL,NULL,'2019-12-04'),(126,36,4,16,25,NULL,NULL,'2019-12-04'),(127,36,1,16,48,NULL,NULL,'2019-12-04'),(128,37,120,23,48,NULL,NULL,'2019-12-04'),(129,37,50,23,35,NULL,NULL,'2019-12-04'),(130,37,50,23,27,NULL,NULL,'2019-12-04'),(131,37,30,23,25,NULL,NULL,'2019-12-04'),(132,38,5,28,22,NULL,NULL,'2019-12-04'),(133,38,5,28,25,NULL,NULL,'2019-12-04'),(134,39,5,12,47,NULL,NULL,'2019-12-05'),(136,40,15,11,46,NULL,NULL,'2019-12-10'),(137,40,10,11,24,NULL,NULL,'2019-12-10'),(138,41,25,15,22,NULL,NULL,'2019-12-11'),(139,41,50,15,30,NULL,NULL,'2019-12-11'),(140,41,75,15,46,NULL,NULL,'2019-12-11'),(141,42,20,28,46,NULL,NULL,'2019-12-11'),(142,42,20,28,47,NULL,NULL,'2019-12-11'),(143,42,20,28,35,NULL,NULL,'2019-12-11'),(144,42,20,28,22,NULL,NULL,'2019-12-11'),(145,42,100,28,48,NULL,NULL,'2019-12-11'),(146,42,20,28,26,NULL,NULL,'2019-12-11'),(147,43,25,22,24,NULL,NULL,'2019-12-12'),(148,43,100,22,23,NULL,NULL,'2019-12-12'),(149,43,25,22,26,NULL,NULL,'2019-12-12'),(150,43,25,22,48,NULL,NULL,'2019-12-12'),(151,44,50,25,46,NULL,NULL,'2019-12-12'),(152,45,30,30,47,NULL,NULL,'2019-12-12'),(153,45,30,30,46,NULL,NULL,'2019-12-12'),(154,45,20,30,52,NULL,NULL,'2019-12-12'),(155,45,20,30,24,NULL,NULL,'2019-12-12'),(161,48,20,36,54,NULL,NULL,'2019-12-15'),(162,48,10,36,55,NULL,NULL,'2019-12-15'),(163,48,30,36,24,NULL,NULL,'2019-12-15'),(164,49,12,24,46,NULL,NULL,'2019-12-15'),(165,49,12,24,54,NULL,NULL,'2019-12-15'),(166,49,6,24,22,NULL,NULL,'2019-12-15'),(170,54,10,15,45,NULL,NULL,'2019-12-14'),(171,54,12,15,30,NULL,NULL,'2019-12-14'),(172,54,14,15,46,NULL,NULL,'2019-12-14'),(173,55,10,16,30,NULL,NULL,'2019-12-15'),(174,55,12,16,46,NULL,NULL,'2019-12-15'),(175,55,14,16,47,NULL,NULL,'2019-12-15'),(187,57,2,16,23,NULL,NULL,'2019-12-15'),(188,57,3,16,24,NULL,NULL,'2019-12-15'),(189,58,1,22,22,NULL,NULL,'2019-12-15'),(190,58,4,22,27,NULL,NULL,'2019-12-15'),(191,58,3,22,32,NULL,NULL,'2019-12-15'),(192,58,5,22,56,NULL,NULL,'2019-12-15'),(193,58,2,22,24,NULL,NULL,'2019-12-15'),(194,58,7,22,52,NULL,NULL,'2019-12-15'),(195,58,6,22,47,NULL,NULL,'2019-12-15'),(196,58,8,22,55,NULL,NULL,'2019-12-15'),(199,60,10,15,24,NULL,NULL,'2019-12-16'),(200,60,15,15,35,NULL,NULL,'2019-12-16'),(201,60,20,15,46,NULL,NULL,'2019-12-16'),(202,61,14,35,52,NULL,NULL,'2019-12-16'),(203,61,20,35,26,NULL,NULL,'2019-12-16'),(204,62,12,26,55,NULL,NULL,'2019-12-16'),(205,62,11,26,56,NULL,NULL,'2019-12-16'),(206,62,10,26,46,NULL,NULL,'2019-12-16'),(240,69,5,24,23,NULL,NULL,'2019-12-17'),(241,69,5,24,22,NULL,NULL,'2019-12-17'),(242,69,5,24,35,NULL,NULL,'2019-12-17'),(243,69,5,24,45,NULL,NULL,'2019-12-17'),(244,69,5,24,25,NULL,NULL,'2019-12-17'),(245,69,5,24,26,NULL,NULL,'2019-12-17'),(246,69,5,24,56,NULL,NULL,'2019-12-17'),(247,69,5,24,48,NULL,NULL,'2019-12-17'),(248,70,12,29,30,NULL,NULL,'2019-12-17'),(249,70,8,29,32,NULL,NULL,'2019-12-17'),(250,71,2,23,25,NULL,NULL,'2019-12-17'),(251,71,15,23,47,NULL,NULL,'2019-12-17'),(252,71,3,23,26,NULL,NULL,'2019-12-17'),(253,72,15,22,45,NULL,NULL,'2019-12-17'),(263,74,3,30,45,NULL,NULL,'2019-12-18'),(264,74,7,30,35,NULL,NULL,'2019-12-18'),(265,74,5,30,47,NULL,NULL,'2019-12-18'),(270,75,5,22,24,NULL,NULL,'2019-12-18'),(271,75,5,22,46,NULL,NULL,'2019-12-18'),(272,75,5,22,32,NULL,NULL,'2019-12-18'),(273,75,5,22,27,NULL,NULL,'2019-12-18'),(274,76,10,22,23,NULL,NULL,'2019-12-18'),(275,76,10,22,22,NULL,NULL,'2019-12-18'),(276,76,10,22,45,NULL,NULL,'2019-12-18'),(277,76,10,22,35,NULL,NULL,'2019-12-18'),(284,79,6,28,22,NULL,NULL,'2019-12-18'),(285,79,6,28,23,NULL,NULL,'2019-12-18'),(286,79,6,28,35,NULL,NULL,'2019-12-18'),(287,80,2,34,56,NULL,NULL,'2019-12-18'),(288,80,1,34,57,NULL,NULL,'2019-12-18'),(289,80,3,34,52,NULL,NULL,'2019-12-18'),(291,81,1,36,22,NULL,NULL,'2019-12-18'),(292,81,1,36,23,NULL,NULL,'2019-12-18'),(293,81,1,36,35,NULL,NULL,'2019-12-18'),(294,81,1,36,45,NULL,NULL,'2019-12-18'),(295,81,22,36,48,NULL,NULL,'2019-12-18'),(296,81,1,36,59,NULL,NULL,'2019-12-18'),(298,81,1,36,56,NULL,NULL,'2019-12-18'),(303,82,7,16,22,NULL,NULL,'2019-12-18'),(305,82,7,16,26,NULL,NULL,'2019-12-18'),(310,86,1,32,22,NULL,NULL,'2019-12-18'),(311,87,2,35,23,NULL,NULL,'2019-12-18'),(313,89,1,32,23,NULL,NULL,'2019-12-18'),(314,90,1,39,56,NULL,NULL,'2019-12-18'),(315,90,3,39,55,NULL,NULL,'2019-12-18'),(316,90,2,39,52,NULL,NULL,'2019-12-18'),(317,91,100,40,56,NULL,NULL,'2019-12-18');
/*!40000 ALTER TABLE `Orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Price_Arrangement`
--

DROP TABLE IF EXISTS `Price_Arrangement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Price_Arrangement` (
  `price_arrangement_id` int(11) NOT NULL AUTO_INCREMENT,
  `bird_type_id` int(11) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `weight_discount` decimal(3,2) DEFAULT NULL,
  `special_price` decimal(3,2) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  PRIMARY KEY (`price_arrangement_id`),
  KEY `bird_type_pa_id_idx` (`bird_type_id`),
  KEY `store_pa_id_idx` (`store_id`),
  CONSTRAINT `bird_type_pa_id` FOREIGN KEY (`bird_type_id`) REFERENCES `Bird_type` (`bird_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `store_pa_id` FOREIGN KEY (`store_id`) REFERENCES `Store` (`store_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Price_Arrangement`
--

LOCK TABLES `Price_Arrangement` WRITE;
/*!40000 ALTER TABLE `Price_Arrangement` DISABLE KEYS */;
INSERT INTO `Price_Arrangement` VALUES (3,29,12,0.07,1.40,'2019-11-01 19:07:03'),(4,36,12,0.07,NULL,'2019-11-01 19:07:35'),(5,40,12,NULL,4.10,'2019-11-01 19:08:21');
/*!40000 ALTER TABLE `Price_Arrangement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Store`
--

DROP TABLE IF EXISTS `Store`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Store` (
  `store_id` int(11) NOT NULL AUTO_INCREMENT,
  `store_name` varchar(60) DEFAULT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `store_phone` bigint(14) DEFAULT NULL,
  `store_address` varchar(60) DEFAULT NULL,
  `store_city` varchar(60) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `store_zip` varchar(5) DEFAULT NULL,
  `store_state` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`store_id`),
  KEY `manager_store_id_idx` (`manager_id`),
  CONSTRAINT `manager_store_id` FOREIGN KEY (`manager_id`) REFERENCES `Manager` (`manager_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Store`
--

LOCK TABLES `Store` WRITE;
/*!40000 ALTER TABLE `Store` DISABLE KEYS */;
INSERT INTO `Store` VALUES (11,'U Do It',5,8567654321,'157 Bridgeton Pike','Mullica Hill',0,'18062','NJ'),(12,'Astemborski\'s',2,1234567890,'20 Woods St','Newark',0,'17112','NJ'),(13,'Hedwig\'s Hattery',3,2125649531,'3348 3rd Ave','Brooklyn',0,'11223','NY'),(14,'Pengquin\'s Pengquins',1,2128524695,'392 Queens Blvd','Queens',1,'11354','NY'),(15,'Vandelay Industries',4,2128646137,'2880 Broadway','New York',1,'10081','NY'),(16,'7 Grand Dad',1,9872345692,'1928 Street St','Rockaway',1,'78660','NJ'),(22,'Shoprite',6,9284630192,'123 Decupage Ln','Devon',1,'19333','PA'),(23,'Chicks R Us',7,1928362739,'928 Breakfast Lasagna Ln','Trenton',1,'18601','NJ'),(24,'Acme',8,1928374657,'83 Chocolate Dr','Atlantic City',1,'18201','NJ'),(25,'Chicks Chicks Chicks',9,1231231231,'43 Monster Ave','Wilmington',1,'19801','DE'),(26,'Birdie Bird',10,4839203849,'12 Dutch Ave','Wildwood',1,'18260','NJ'),(27,'Steele\'s Pots and Pans',11,2938475667,'222 Leather Ln','Glassboro',1,'18028','NJ'),(28,'McDonalds',12,2039485768,'1470 Espionage Rd','Thorofare',1,'18066','NJ'),(29,'Birdie Bird',13,1092839405,'13 Australia Dr','Philadelphia',1,'19019','PA'),(30,'Chicken Bell',14,1110002222,'293 Yorkshire Ave','Smyrna',1,'19977','DE'),(31,'Kash n Karry',15,1091091098,'3948 Ireland Rd','King of Prussia',0,'19406','PA'),(32,'Independent Buyer',16,7584930201,'321 Lonesome Ln','Buena',1,'18310','NJ'),(33,'We Got The Meats',17,1928374657,'10 Regional Sales Manager Rd','Darby',1,'19023','PA'),(34,'Georgie\'s Sandwich Shop',18,1091091092,'345 Enemy Ave','Marlton',1,'18053','NJ'),(35,'Spoons',19,6549872385,'4 Spy Dr','Williamstown',1,'18094','NJ'),(36,'Best Customer',NULL,7776665555,'1234 chicken st','chickenville',0,'99999','nj'),(37,'Saturday',NULL,6096687931,'2 cox farm road','burlington',1,'08016','New Jersey'),(38,'Connor M Astemborski',NULL,6096687931,'2 cox farm road','burlington',0,'08016','New Jersey'),(39,'Gilmore\'s Glorious Goods',NULL,6096687931,'2 cox farm road','burlington',0,'08016','New Jersey'),(40,'The Invulnerable Vagrant',NULL,6096687931,'2 cox farm road','burlington',0,'08016','New Jersey'),(41,'Morshu\'s',NULL,6096687931,'2 cox farm road','burlington',0,'08016','New Jersey'),(42,'Beetle\'s Shop Ship',NULL,6096687931,'2 cox farm road','burlington',0,'08016','New Jersey'),(43,'Steam Marketplace',NULL,6096687931,'2 cox farm road','burlington',0,'08016','New Jersey'),(44,'The Wii Shop Channel',NULL,6096687931,'2 cox farm road','burlington',0,'08016','New Jersey');
/*!40000 ALTER TABLE `Store` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Trailer`
--

DROP TABLE IF EXISTS `Trailer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Trailer` (
  `trailer_id` int(11) NOT NULL AUTO_INCREMENT,
  `company` varchar(45) DEFAULT NULL,
  `trailer_number` int(11) DEFAULT NULL,
  `trailer_weight_empty` int(11) DEFAULT NULL,
  `trailer_weights_loaded` int(11) DEFAULT NULL,
  `num_coops_in` int(11) DEFAULT NULL,
  `num_coops_out` int(11) DEFAULT NULL,
  `rec_date` date DEFAULT NULL,
  PRIMARY KEY (`trailer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Trailer`
--

LOCK TABLES `Trailer` WRITE;
/*!40000 ALTER TABLE `Trailer` DISABLE KEYS */;
INSERT INTO `Trailer` VALUES (1,NULL,149,NULL,NULL,NULL,NULL,NULL),(2,NULL,149,NULL,NULL,NULL,NULL,NULL),(3,NULL,159,NULL,NULL,NULL,NULL,NULL),(4,NULL,159,NULL,NULL,NULL,NULL,NULL),(5,NULL,149,NULL,NULL,NULL,NULL,NULL),(6,NULL,6,NULL,NULL,NULL,NULL,NULL),(7,NULL,7,NULL,NULL,NULL,NULL,NULL),(8,NULL,159,NULL,NULL,NULL,NULL,NULL),(9,NULL,19,NULL,NULL,NULL,NULL,NULL),(10,NULL,19,NULL,NULL,NULL,NULL,NULL),(11,NULL,19,NULL,NULL,NULL,NULL,NULL),(12,NULL,101,NULL,NULL,NULL,NULL,NULL),(13,NULL,1001,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `Trailer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Truck`
--

DROP TABLE IF EXISTS `Truck`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Truck` (
  `truck_id` int(11) NOT NULL AUTO_INCREMENT,
  `truck_status` tinyint(4) DEFAULT '1',
  `truck_vin` varchar(17) DEFAULT NULL,
  `truck_plate_number` varchar(7) DEFAULT NULL,
  `truck_max_coops` int(11) DEFAULT NULL,
  `truck_transmission` enum('Manual','Automatic') DEFAULT NULL,
  `truck_number` int(11) DEFAULT NULL,
  `box_type` enum('Open','Closed') DEFAULT NULL,
  PRIMARY KEY (`truck_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Truck`
--

LOCK TABLES `Truck` WRITE;
/*!40000 ALTER TABLE `Truck` DISABLE KEYS */;
INSERT INTO `Truck` VALUES (11,1,'12341','12441',225,'Automatic',1,NULL),(12,1,'90001','87654',250,'Automatic',2,NULL),(13,1,'67854','12987',175,'Manual',3,NULL),(14,1,'28405','12345',200,'Automatic',4,NULL),(15,1,'20573','29123',200,'Manual',5,NULL),(16,1,'29184','21093',250,'Manual',6,NULL),(17,1,'56038','01294',200,'Automatic',7,NULL),(18,1,'03492','28384',175,'Automatic',8,NULL),(19,1,'18384','94827',250,'Automatic',9,NULL),(20,0,'94829','27284',250,'Manual',10,NULL),(24,0,'10395','38175',250,'Manual',11,NULL),(25,0,'10294','67584',300,'Automatic',12,NULL),(26,0,'89898','78787',250,'Automatic',13,NULL),(27,0,'43434','32323',200,'Manual',14,NULL),(28,0,'43265','78965',250,'Automatic',15,NULL),(29,0,'58302','75894',300,'Manual',16,NULL),(30,1,'94037','28476',250,'Manual',17,NULL),(31,1,'3948','48292',250,'Manual',18,NULL),(33,0,'124123','12341',225,'Automatic',321,NULL),(34,1,'124515','123141',124,'Automatic',576,NULL),(35,1,'651465','65416',500,'Automatic',777,NULL),(36,0,'65465','45785',22,'Automatic',888,NULL),(48,0,'232352352623','123412',23,'Automatic',9999,NULL),(49,0,'123412','1234',12,'Automatic',56565,NULL),(50,1,'123','312',13,'Automatic',123,NULL),(51,1,'56848','dog',2,'Automatic',34,NULL),(52,1,'41654','cat',24,'Automatic',76,NULL);
/*!40000 ALTER TABLE `Truck` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Truck_Driver`
--

DROP TABLE IF EXISTS `Truck_Driver`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Truck_Driver` (
  `truck_driver_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_driven` datetime DEFAULT NULL,
  `truck_id` int(11) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`truck_driver_id`),
  KEY `td_driver_id_idx` (`driver_id`),
  KEY `td_truck_id_idx` (`truck_id`),
  CONSTRAINT `td_driver_id` FOREIGN KEY (`driver_id`) REFERENCES `Driver` (`driver_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `td_truck_id` FOREIGN KEY (`truck_id`) REFERENCES `Truck` (`truck_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Truck_Driver`
--

LOCK TABLES `Truck_Driver` WRITE;
/*!40000 ALTER TABLE `Truck_Driver` DISABLE KEYS */;
INSERT INTO `Truck_Driver` VALUES (1,'2019-11-22 00:00:00',11,1),(2,'2019-11-22 00:00:00',12,2),(6,'2019-11-30 00:00:00',11,1),(104,'2019-12-02 00:00:00',28,2),(110,'2019-12-04 00:00:00',34,7),(113,'2019-12-04 00:00:00',20,3),(114,'2019-12-04 00:00:00',24,4),(116,'2019-12-12 00:00:00',27,9),(124,'2019-12-16 00:00:00',17,79),(126,'2019-12-17 00:00:00',34,79),(127,'2019-12-18 00:00:00',13,3),(132,'2019-12-18 00:00:00',14,79);
/*!40000 ALTER TABLE `Truck_Driver` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Truck_Order`
--

DROP TABLE IF EXISTS `Truck_Order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Truck_Order` (
  `truck_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `truck_id` int(11) NOT NULL,
  `delivery_date` date DEFAULT NULL,
  `stop_number` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`truck_order_id`),
  KEY `ti_truck_id_idx` (`truck_id`),
  KEY `ti_order_id_idx` (`order_id`),
  CONSTRAINT `to_order_id` FOREIGN KEY (`order_id`) REFERENCES `Orders` (`order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `to_truck_id` FOREIGN KEY (`truck_id`) REFERENCES `Truck` (`truck_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Truck_Order`
--

LOCK TABLES `Truck_Order` WRITE;
/*!40000 ALTER TABLE `Truck_Order` DISABLE KEYS */;
/*!40000 ALTER TABLE `Truck_Order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `user_ID` int(11) NOT NULL AUTO_INCREMENT,
  `name_string` varchar(45) NOT NULL,
  `auth_string` varchar(45) DEFAULT NULL,
  `permission_set` enum('Sales Manager','Flock Manager','Admin','Truck Driver') DEFAULT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `salt` varchar(45) DEFAULT NULL,
  `active_status` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`user_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (4,'bbob','e876e901054ad24fbcc5a258fd47d90f9b32be90','Admin','Billy','Bob','e07859',1),(5,'maddy','*7CFC270F79AAAAB51B5F0AB7F4734EB07C34E7C5','Admin','Maddy','Presnell','4a6e3b',1),(8,'tinabelcher','*ECACE9890696938D826D90BB6DE4679AD46E4468','Truck Driver','Tina','Belcher','fb97a9',0),(9,'genebelcher','*CE95EF80B6C3141857339EE6F0DC24863A0A61BC','Sales Manager','Gene','Belcher','9b0ca4',1),(10,'bobbelcher','*35A083F6E363492E3CE93723781F9E6E4E39440E','Flock Manager','Bob','Belcher','0c96b8',1),(11,'cborski','*A2BB7D237CE46850C9E572358548475ECAC7F62D','Admin','Connor','Astemborski','266278',1),(13,'zach','*E01B60D5C91C602A7895BBF400B04083EF967744','Admin','Zach','Miles','f77ce3',1),(14,'barret','*323CB9CEECD564A4CF22901A86704948011A6F7C','Admin','Barret','Vogtman','567336',1),(15,'joe','*FB3600F3DCA620D514046B8CFAF9A987EDE7BAA4','Truck Driver','Joe','Tagliaferro','a81cfc',1),(16,'riddhi','*16993347A577CF06EFDE8DCA852EB9AC086C0A1C','Admin','Riddhi','Patel','ba324f',1),(17,'brian','*4526DB87C1E8841B782DA5E749293B6F4537CFBC','Admin','Brian','Mendoza','8167d2',1),(26,'freshprince','*96D215F9F2708D688E26806B0BD592675C466782','Sales Manager','Will','Smith','47967f',1),(30,'lgilmore','*036F60D0A9D82A269C5839040A372B9303A24B79','Truck Driver','Lorelai','Gilmore','86f8ff',1),(31,'aglouberman','*F25C8B5928CB9F0DE3A64C638990159C9A407BC0','Truck Driver','Andrew','Glouberman','aac7ec',1),(32,'pgriffin','*0CE7CBCD3CCD93A7D076793D8D95EB614D237775','Truck Driver','Peter','Griffin','ae510f',1),(33,'ldanes','*C8D88CB5E95245BC3680C00BAB0D695193A279CB','Truck Driver','Luke','Danes','fb9995',1),(34,'lkim','*2326CA51DDA62CED2423397598B409FD56E3C23B','Truck Driver','Lane','Kim','99370c',1),(35,'nbirch','*02EC69D0A1B95BE15461EA7C4C2936D417E9D30B','Truck Driver','Nick','Birch','e476ff',1),(37,'Truckguy','*921EC865F8EA40DF991D46C937DF943563348274','Truck Driver','Truck','McTruckFace','73146a',1),(38,'louisebelcher','*1B96AD1219F59A770525E25D5BA23E741AEC0BDB','Sales Manager','Louise','Belcher','fc0fa9',1),(39,'cassie','*2D7DD27F2DA30089220A7CC0C52324C469B1B65F','Admin','Cassie','Bailey','f17f66',1),(41,'cborski15','*B06BC9FCD744635DAB627766DEF9A847605CAF1A','Admin','Connor','Astemborski','2927cb',1),(42,'truck','*98B9FEF3E4A586B4677FDA7A680C323053A0273F','Truck Driver','John','DiSteffano','365ac2',1),(43,'hidoggy','*FCE698B2FDAA82AE036D1248AEB68B210F20BDBB','Truck Driver','Tommy','Wiseau','520faf',1),(44,'TestTues','*937CBF75337311E9D05F35D00A9F795C45F58775','Truck Driver','Joe','Kim','c5d866',1),(47,'kj13','*669C2F8215ACF61C7985CCA1E5DDE085E4ACDF36','Truck Driver','Kyle','jake','f76cd5',1),(48,'htom12','*DBC343DAF5FDA09585C36F331128E07C2C722206','Truck Driver','Hannah','Tom','caddca',1),(49,'joe2','*1F9C4C20F9DE2B2E42FC09EC0428EBC0945503C3','Sales Manager','joe2','t','9a7a1f',1);
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`connor`@`localhost`*/ /*!50003 TRIGGER `chickens`.`User_BEFORE_INSERT` BEFORE INSERT ON `User` FOR EACH ROW
BEGIN
	
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Temporary table structure for view `User_Messages`
--

DROP TABLE IF EXISTS `User_Messages`;
/*!50001 DROP VIEW IF EXISTS `User_Messages`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `User_Messages` AS SELECT 
 1 AS `name_string`,
 1 AS `content`,
 1 AS `date_created`,
 1 AS `flockmanager_flag`,
 1 AS `salesmanager_flag`,
 1 AS `truckdriver_flag`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `User_Messages`
--

/*!50001 DROP VIEW IF EXISTS `User_Messages`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`connor`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `User_Messages` AS select `u`.`name_string` AS `name_string`,`m`.`content` AS `content`,`m`.`date_created` AS `date_created`,`m`.`flockmanager_flag` AS `flockmanager_flag`,`m`.`salesmanager_flag` AS `salesmanager_flag`,`m`.`truckdriver_flag` AS `truckdriver_flag` from (`Message` `m` join `User` `u` on((`u`.`user_ID` = `m`.`user_id`))) */;
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

-- Dump completed on 2019-12-18  0:23:59
