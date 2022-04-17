-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: localhost    Database: db_rich
-- ------------------------------------------------------
-- Server version	8.0.27

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
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `country` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `continent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country`
--

LOCK TABLES `country` WRITE;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
INSERT INTO `country` VALUES (6,'Pays0','Continent0'),(7,'Pays1','Continent1'),(8,'Pays2','Continent2'),(9,'Pays3','Continent3'),(10,'Pays4','Continent4');
/*!40000 ALTER TABLE `country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `destination`
--

DROP TABLE IF EXISTS `destination`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `destination` (
  `id` int NOT NULL AUTO_INCREMENT,
  `contry_id` int NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3EC63EAACD33232C` (`contry_id`),
  CONSTRAINT `FK_3EC63EAACD33232C` FOREIGN KEY (`contry_id`) REFERENCES `country` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `destination`
--

LOCK TABLES `destination` WRITE;
/*!40000 ALTER TABLE `destination` DISABLE KEYS */;
INSERT INTO `destination` VALUES (21,10,'ville 0','detail... '),(22,10,'ville 1','detail... '),(23,10,'ville 2','detail... '),(24,10,'ville 3','detail... '),(25,10,'ville 4','detail... '),(26,10,'ville 5','detail... '),(27,10,'ville 6','detail... '),(28,10,'ville 7','detail... '),(29,10,'ville 8','detail... '),(30,10,'ville 9','detail... '),(31,10,'ville 10','detail... '),(32,10,'ville 11','detail... '),(33,10,'ville 12','detail... '),(34,10,'ville 13','detail... '),(35,10,'ville 14','detail... '),(36,10,'ville 15','detail... '),(37,10,'ville 16','detail... '),(38,10,'ville 17','detail... '),(39,10,'ville 18','detail... '),(40,10,'ville 19','detail... ');
/*!40000 ALTER TABLE `destination` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20220329195029','2022-03-31 12:15:49',474),('DoctrineMigrations\\Version20220329210427','2022-03-31 12:15:49',18),('DoctrineMigrations\\Version20220331125446','2022-03-31 12:54:53',1276),('DoctrineMigrations\\Version20220402220548','2022-04-16 09:21:02',603);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_recap`
--

DROP TABLE IF EXISTS `order_recap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_recap` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_rattached_id` int NOT NULL,
  `transaction_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_adress` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_AC2469DD4AFD4C8C` (`order_rattached_id`),
  CONSTRAINT `FK_AC2469DD4AFD4C8C` FOREIGN KEY (`order_rattached_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_recap`
--

LOCK TABLES `order_recap` WRITE;
/*!40000 ALTER TABLE `order_recap` DISABLE KEYS */;
INSERT INTO `order_recap` VALUES (2,2,'card','90 Rue Tolbiac'),(3,3,'Carte','90 Rue Tolbiac'),(4,4,'Carte','90 Rue Tolbiac'),(5,5,'Carte','90 Rue Tolbiac'),(6,6,'Carte','azertyuiop'),(7,7,'Carte','rue des popol');
/*!40000 ALTER TABLE `order_recap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pack_id` int DEFAULT NULL,
  `date_of_order` datetime NOT NULL,
  `ammount` double NOT NULL,
  `user_id` int NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_stripe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last4_stripe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_charge_stripe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_stripe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_E52FFDEE1919B217` (`pack_id`),
  KEY `IDX_E52FFDEEA76ED395` (`user_id`),
  CONSTRAINT `FK_E52FFDEE1919B217` FOREIGN KEY (`pack_id`) REFERENCES `pack` (`id`),
  CONSTRAINT `FK_E52FFDEEA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (2,5,'2022-04-16 15:59:33',200,25,'Raharinosy16-04-2022-15-59',NULL,NULL,NULL,NULL,NULL,'2022-04-16 15:59:33','2022-04-16 15:59:33'),(3,6,'2022-04-16 16:00:58',200,25,'Raharinosy16-04-2022-16-00',NULL,NULL,NULL,NULL,NULL,'2022-04-16 16:00:58','2022-04-16 16:00:58'),(4,7,'2022-04-17 22:07:25',200,25,'Raharinosy17-04-2022-22-07',NULL,NULL,NULL,NULL,NULL,'2022-04-17 22:07:25','2022-04-17 22:07:25'),(5,6,'2022-04-17 22:10:46',200,25,'Raharinosy17-04-2022-22-10',NULL,NULL,NULL,NULL,NULL,'2022-04-17 22:10:46','2022-04-17 22:10:46'),(6,6,'2022-04-17 22:58:27',200,26,'azerty17-04-2022-22-58',NULL,NULL,NULL,NULL,NULL,'2022-04-17 22:58:27','2022-04-17 22:58:27'),(7,5,'2022-04-17 23:20:30',200,29,'Scientifique17-04-2022-23-20',NULL,NULL,NULL,NULL,NULL,'2022-04-17 23:20:30','2022-04-17 23:20:30');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_prestation`
--

DROP TABLE IF EXISTS `orders_prestation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders_prestation` (
  `orders_id` int NOT NULL,
  `prestation_id` int NOT NULL,
  PRIMARY KEY (`orders_id`,`prestation_id`),
  KEY `IDX_340A962A9E45C554` (`prestation_id`),
  KEY `IDX_340A962ACFFE9AD6` (`orders_id`),
  CONSTRAINT `FK_340A962A9E45C554` FOREIGN KEY (`prestation_id`) REFERENCES `prestation` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_340A962ACFFE9AD6` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_prestation`
--

LOCK TABLES `orders_prestation` WRITE;
/*!40000 ALTER TABLE `orders_prestation` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders_prestation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pack`
--

DROP TABLE IF EXISTS `pack`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pack` (
  `id` int NOT NULL AUTO_INCREMENT,
  `destination_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` longblob,
  `description` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double DEFAULT NULL,
  `nb_person_max` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_97DE5E23816C6140` (`destination_id`),
  CONSTRAINT `FK_97DE5E23816C6140` FOREIGN KEY (`destination_id`) REFERENCES `destination` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pack`
--

LOCK TABLES `pack` WRITE;
/*!40000 ALTER TABLE `pack` DISABLE KEYS */;
INSERT INTO `pack` VALUES (4,40,'pack n°2',NULL,'pack n°2',200,10),(5,40,'pack n°3',NULL,'pack n°3',200,10),(6,40,'pack n°4',NULL,'pack n°4',200,10),(7,40,'pack n°5',NULL,'pack n°5',200,10),(8,40,'pack n°6',NULL,'pack n°6',200,10),(9,40,'pack n°7',NULL,'pack n°7',200,10),(10,40,'Pack test',NULL,'ceci est un test',400,13);
/*!40000 ALTER TABLE `pack` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pack_prestation`
--

DROP TABLE IF EXISTS `pack_prestation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pack_prestation` (
  `pack_id` int NOT NULL,
  `prestation_id` int NOT NULL,
  PRIMARY KEY (`pack_id`,`prestation_id`),
  KEY `IDX_73A007BB1919B217` (`pack_id`),
  KEY `IDX_73A007BB9E45C554` (`prestation_id`),
  CONSTRAINT `FK_73A007BB1919B217` FOREIGN KEY (`pack_id`) REFERENCES `pack` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_73A007BB9E45C554` FOREIGN KEY (`prestation_id`) REFERENCES `prestation` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pack_prestation`
--

LOCK TABLES `pack_prestation` WRITE;
/*!40000 ALTER TABLE `pack_prestation` DISABLE KEYS */;
/*!40000 ALTER TABLE `pack_prestation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pays`
--

DROP TABLE IF EXISTS `pays`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pays` (
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pays`
--

LOCK TABLES `pays` WRITE;
/*!40000 ALTER TABLE `pays` DISABLE KEYS */;
/*!40000 ALTER TABLE `pays` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prestation`
--

DROP TABLE IF EXISTS `prestation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prestation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vehicle_id` int DEFAULT NULL,
  `price` double NOT NULL,
  `is_available` tinyint(1) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_person_max` int NOT NULL,
  `image` longblob,
  `prestationType` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_in_date` datetime DEFAULT NULL,
  `check_out_time` datetime DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `airport_departure` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_departure` date DEFAULT NULL,
  `departure_time` time DEFAULT NULL,
  `airport_arrival` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `arrival_time` time DEFAULT NULL,
  `date_arrival` date DEFAULT NULL,
  `picking_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pick_up_date` datetime DEFAULT NULL,
  `drop_off_date` datetime DEFAULT NULL,
  `type_of_activity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_51C88FAD545317D1` (`vehicle_id`),
  CONSTRAINT `FK_51C88FAD545317D1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prestation`
--

LOCK TABLES `prestation` WRITE;
/*!40000 ALTER TABLE `prestation` DISABLE KEYS */;
INSERT INTO `prestation` VALUES (9,7,58444,1,'Location du jetski','Vehicule incroyable',2,NULL,'vehicleRental',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'8 rue là bas','2022-02-01 00:00:00','2022-02-01 00:00:00',NULL,NULL),(10,10,58,1,'Location du vehicule','Vehicule incroyable',5,NULL,'vehicleRental',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'8 rue ici','2022-02-01 00:00:00','2022-02-01 00:00:00',NULL,NULL),(11,10,58,1,'Location du vehicule','Vehicule incroyable',5,NULL,'vehicleRental',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'8 rue ici','2022-02-01 00:00:00','2022-02-01 00:00:00',NULL,NULL),(12,10,0,1,'vol vers ville 19','Une destination de reve',5,NULL,'travel',NULL,NULL,NULL,NULL,'Aeroport Paris Charle de Gaulle','2022-02-01','16:32:56','aeroport de ville 19','16:32:56','2022-02-01',NULL,NULL,NULL,NULL,NULL),(13,10,375,1,'vol vers ville 19','Une destination de reve',5,NULL,'travel',NULL,NULL,NULL,NULL,'Aeroport Paris Charle de Gaulle','2022-02-01','16:32:56','aeroport de ville 19','16:32:56','2022-02-01',NULL,NULL,NULL,NULL,NULL),(14,10,750,1,'vol vers ville 19','Une destination de reve',5,NULL,'travel',NULL,NULL,NULL,NULL,'Aeroport Paris Charle de Gaulle','2022-02-01','16:32:56','aeroport de ville 19','16:32:56','2022-02-01',NULL,NULL,NULL,NULL,NULL),(15,10,1125,1,'vol vers ville 19','Une destination de reve',5,NULL,'travel',NULL,NULL,NULL,NULL,'Aeroport Paris Charle de Gaulle','2022-02-01','16:32:56','aeroport de ville 19','16:32:56','2022-02-01',NULL,NULL,NULL,NULL,NULL),(16,10,1500,1,'vol vers ville 19','Une destination de reve',5,NULL,'travel',NULL,NULL,NULL,NULL,'Aeroport Paris Charle de Gaulle','2022-02-01','16:32:56','aeroport de ville 19','16:32:56','2022-02-01',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `prestation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prestation_destination`
--

DROP TABLE IF EXISTS `prestation_destination`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prestation_destination` (
  `prestation_id` int NOT NULL,
  `destination_id` int NOT NULL,
  PRIMARY KEY (`prestation_id`,`destination_id`),
  KEY `IDX_6C7AE39B816C6140` (`destination_id`),
  KEY `IDX_6C7AE39B9E45C554` (`prestation_id`),
  CONSTRAINT `FK_6C7AE39B816C6140` FOREIGN KEY (`destination_id`) REFERENCES `destination` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_6C7AE39B9E45C554` FOREIGN KEY (`prestation_id`) REFERENCES `prestation` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prestation_destination`
--

LOCK TABLES `prestation_destination` WRITE;
/*!40000 ALTER TABLE `prestation_destination` DISABLE KEYS */;
INSERT INTO `prestation_destination` VALUES (9,40),(10,40),(11,40),(12,40),(13,40),(14,40),(15,40),(16,40);
/*!40000 ALTER TABLE `prestation_destination` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (19,'email2','[\"ROLE_USER\"]','password2','prenom','nom','adresse2'),(20,'email3','[\"ROLE_USER\"]','password3','prenom','nom','adresse3'),(21,'email4','[\"ROLE_USER\"]','password4','prenom','nom','adresse4'),(25,'mamilala.raharinosy@etu.univ-paris1.fr','[\"ROLE_ADMIN\"]','$2y$13$eGjEle6n9ovy8tPa7bZfQ.E98p3IrzR0KuKG1SJXOwIo5pcG5s2mK','Raharinosy','Nicolas','90 Rue Tolbiac'),(26,'nicolasraharinosy@gmail.com','[\"ROLE_ADMIN\"]','$2y$13$DgfsoW3BmycTSds./hjaEufqqawF2gZInpfIb4oEoHo3QOxObrPgG','azerty','uiop','azertyuiop'),(29,'nicolas.rnsy@gmail.com','[]','$2y$13$5ylFULXR.dz8e2YhKqeSTeJDHMkeULWxHBbfeIVjcrfxeTcwpS3i6','Scientifique','Baccalauréat','rue des popol');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle`
--

DROP TABLE IF EXISTS `vehicle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicle` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_day` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle`
--

LOCK TABLES `vehicle` WRITE;
/*!40000 ALTER TABLE `vehicle` DISABLE KEYS */;
INSERT INTO `vehicle` VALUES (7,'Boeing 1','aerien',26),(8,'Boeing 2','aerien',27),(9,'Boeing 3','aerien',28),(10,'Boeing 4','aerien',29);
/*!40000 ALTER TABLE `vehicle` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-17 23:59:08
