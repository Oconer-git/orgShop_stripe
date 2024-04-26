-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: mydb
-- ------------------------------------------------------
-- Server version	8.2.0

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `checkouts`
--

DROP TABLE IF EXISTS `checkouts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `checkouts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `quantity` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_checkouts_products_idx` (`product_id`) /*!80000 INVISIBLE */,
  KEY `fk_checkouts_users_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `checkouts`
--

LOCK TABLES `checkouts` WRITE;
/*!40000 ALTER TABLE `checkouts` DISABLE KEYS */;
/*!40000 ALTER TABLE `checkouts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `default_billing_informations`
--

DROP TABLE IF EXISTS `default_billing_informations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `default_billing_informations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `address1` varchar(45) DEFAULT NULL,
  `address2` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `zip` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_shipping_information_users1_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `default_billing_informations`
--

LOCK TABLES `default_billing_informations` WRITE;
/*!40000 ALTER TABLE `default_billing_informations` DISABLE KEYS */;
INSERT INTO `default_billing_informations` VALUES (46,'John','Wick','Mandaluyong City','Mandaluyong City','Mandaluyong City','Metro Manila','2131','2024-04-07 23:09:29','2024-04-07 23:10:12',3),(47,'Jennyxxx','Rosexx','Mandaluyong City','Mandaluyong City','Mandaluyong City','Metro Manila','2131','2024-04-07 23:11:36','2024-04-07 23:11:36',8);
/*!40000 ALTER TABLE `default_billing_informations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `default_shipping_informations`
--

DROP TABLE IF EXISTS `default_shipping_informations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `default_shipping_informations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `address1` varchar(45) DEFAULT NULL,
  `address2` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `zip` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_shipping_information_users1_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `default_shipping_informations`
--

LOCK TABLES `default_shipping_informations` WRITE;
/*!40000 ALTER TABLE `default_shipping_informations` DISABLE KEYS */;
INSERT INTO `default_shipping_informations` VALUES (43,'Jenny','Rose','Mandaluyong City','Mandaluyong City','Mandaluyong City','Metro Manila','2131','2024-04-07 23:09:29','2024-04-07 23:10:12',3),(44,'Jennyxx','Rosexx','Mandaluyong City','Mandaluyong City','Mandaluyong City','Metro Manila','2131','2024-04-07 23:11:36','2024-04-07 23:11:36',8);
/*!40000 ALTER TABLE `default_shipping_informations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `int` int NOT NULL,
  `quantity` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`int`),
  KEY `fk_orders_products1_idx` (`product_id`),
  KEY `fk_orders_users1_idx` (`user_id`),
  CONSTRAINT `fk_orders_products1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `fk_orders_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` text,
  `price` varchar(45) DEFAULT NULL,
  `inventory` varchar(45) DEFAULT NULL,
  `sold` varchar(45) DEFAULT NULL,
  `image` blob,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `image1` blob,
  `image2` blob,
  `image3` blob,
  `image4` blob,
  `category_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_products_categories1_idx` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (8,'Banana','Basdfasfasfasfasfa','50','99','0',_binary '/uploads/Bananas.jpg','2024-04-07 12:38:04','2024-04-07 12:38:04',_binary '/uploads/4eQJtFs0-720.jpg',_binary '/uploads/120604032828-fresh-ripe-bananas.jpg',_binary '/uploads/img_193773_banana.jpg',NULL,2),(7,'Asparagus','sdfasfasfasfasfasfasfa','99','100','0',_binary '/uploads/images_(1)2.jpg','2024-04-07 12:36:54','2024-04-07 12:36:54',_binary '/uploads/images_(1)3.jpg',_binary '/uploads/asparagus4.jpg',_binary '/uploads/images1.jpg',NULL,1),(9,'Brisket Beef','dafasfasfafa','288','199','0',_binary '/uploads/brisket_beef.jpg','2024-04-07 12:38:44','2024-04-07 12:38:44',_binary '/uploads/brisket_beef1.jpg',_binary '/uploads/images2.jpg',_binary '/uploads/oven-baked-beef-brisket-206-scaled.jpg',NULL,4),(10,'Brussels Sprouts','asdfasfasfasfafaf','288','100','0',_binary '/uploads/images3.jpg','2024-04-07 12:39:18','2024-04-07 12:39:18',_binary '/uploads/brussel_sprouts.jpg',_binary '/uploads/Roasted_Brussels_Sprouts_292-744afc74903e4e8b80b75b7ed288fbfc.jpg',_binary '/uploads/Roasted-Brussels-Sprouts-With-Garlic-hwvg-square640.jpg',NULL,1),(22,'Pork loin','adsfasdfasfasfafa','100','199','0',_binary '/uploads/pork_loin.jpg','2024-04-07 13:17:22','2024-04-07 13:17:22',NULL,NULL,NULL,NULL,1),(13,'Cucumber','asdfasfddasfdasdfdasfsafafafafafafa','99','1211','0',_binary '/uploads/images4.jpg','2024-04-07 12:41:35','2024-04-07 12:41:35',_binary '/uploads/cucumbers21.jpg',_binary '/uploads/images_(1)6.jpg',_binary '/uploads/Simply-Recipes-Waxy-Cucumbers-LEAD-f46dbda3d589434ab63a3b50b7cbd94c1.jpg',NULL,2),(15,'Oranges','dafasfsafasfasfadfdasdfasfasfafaf','99','100','0',_binary '/uploads/oranges-85fb2b6.jpg','2024-04-07 12:42:42','2024-04-07 12:42:42',_binary '/uploads/images6.jpg',_binary '/uploads/oranges.jpg',_binary '/uploads/TypesOfOranges-f95153e786554ba5b6da0370387ee563.jpg',NULL,2),(16,'Beef chuck','asdfasfasfasfasfasfa','250','112','0',_binary '/uploads/beef_chuck.jpg','2024-04-07 12:44:13','2024-04-07 12:44:13',NULL,NULL,NULL,NULL,4),(17,'Beef Ribs','asofjdjasfjsafoajfpasf','251','1218','0',_binary '/uploads/beef_ribs.jpg','2024-04-07 12:44:48','2024-04-07 12:44:48',NULL,NULL,NULL,NULL,4),(18,'Carrots','osadfasfasfjl;asjflksajfl;ajfl;asjfl;asjfljasl;fasfafa','87','123131','0',_binary '/uploads/carrots.jpg','2024-04-07 12:45:15','2024-04-07 12:45:15',NULL,NULL,NULL,NULL,1),(19,'Cherriess','dadjflasjflasjfl;asjf;lasjfl;ja;lfjasljfl;asjf;lasjfa','89','100','0',_binary '/uploads/cherries.jpg','2024-04-07 12:45:46','2024-04-07 12:45:46',NULL,NULL,NULL,NULL,2),(20,'Chicken breast','asdfja;sfjlasjfl;asjflk;asjfl;asjfl;asjfl;aksjfl;kasfjl;asjfl;fal','259','123','0',_binary '/uploads/chicken_breast.jpg','2024-04-07 12:46:14','2024-04-07 12:46:14',NULL,NULL,NULL,NULL,5),(21,'Chicken Drumsticks','asdfjasdfjalsfjasfasfj;jasf','100','1102','0',_binary '/uploads/chicken_drumsticks.jpg','2024-04-07 12:47:11','2024-04-07 12:47:11',NULL,NULL,NULL,NULL,5),(23,'Onions','adfjlasdfjlsafjlsafjlasfjlasjfjasl;fjaljfalfjalfjlasfjasfl;asjflfjlasfl;asjfdas','100','199','0',_binary '/uploads/onions.jpg','2024-04-07 13:18:20','2024-04-07 13:18:20',NULL,NULL,NULL,NULL,1),(24,'Potato','adfj;asfl;sadfjlasjflsajfl;asjflasjflsajflasjfl;asjf;lasasfasfasfsafa','100','100','0',_binary '/uploads/potato.jpg','2024-04-07 13:20:50','2024-04-07 13:20:50',NULL,NULL,NULL,NULL,1),(25,'Spinach','asjdfasjfl;sajflkjfl;asjfl;sajfl;asjflkl;jasl;fjasfkla;sjfkl;asjflk;asjfl;asjfl;asjfl;aksj','100','123131','0',_binary '/uploads/spinach-leaf-on-white-background-ai-generative-photo.jpg','2024-04-07 13:22:19','2024-04-07 13:22:19',NULL,NULL,NULL,NULL,1),(26,'Pork','adfadfafafaadfafadafasfafafafa','90','100','0',_binary '/uploads/pork_native.jpg','2024-04-07 14:34:12','2024-04-07 14:34:12',NULL,NULL,NULL,NULL,1),(27,'Short Plate Beef','dasfjasdfjasdflasjfl;ajfa','200','1121','0',_binary '/uploads/short_plate_beef.jpg','2024-04-07 14:42:24','2024-04-07 14:42:24',NULL,NULL,NULL,NULL,4),(28,'Peach','asldhfkahfkahfklahsfkasfasfafafaf','100','90','0',_binary '/uploads/peach.jpg','2024-04-07 14:50:59','2024-04-07 14:50:59',NULL,NULL,NULL,NULL,2),(29,'Pork belly','dasfasfasdfsadfasfasfasfasfasfasfa','100','1000','0',_binary '/uploads/pork_belly.jpg','2024-04-07 15:04:22','2024-04-07 15:04:22',NULL,NULL,NULL,NULL,3),(30,'Pork Ribs','asdfsafsafasfasfsfjdasljf;lasjfasfljas;jfa;sfjl;as','299','199','0',_binary '/uploads/pork_ribs.jpg','2024-04-07 15:08:12','2024-04-07 15:08:12',NULL,NULL,NULL,NULL,3);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `star` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reviews_users1_idx` (`user_id`),
  KEY `fk_reviews_products1_idx` (`product_id`),
  CONSTRAINT `fk_reviews_products1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `fk_reviews_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipping_informations`
--

DROP TABLE IF EXISTS `shipping_informations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shipping_informations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `last_name` varchar(45) DEFAULT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `address1` varchar(45) DEFAULT NULL,
  `address2` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `zip` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_shipping_information_users1_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipping_informations`
--

LOCK TABLES `shipping_informations` WRITE;
/*!40000 ALTER TABLE `shipping_informations` DISABLE KEYS */;
INSERT INTO `shipping_informations` VALUES (37,'Rose','Jenny','Mandaluyong City','Mandaluyong City','Mandaluyong City','Metro Manila','2131','pending','2024-04-07 13:03:29','2024-04-07 13:03:29',3),(38,'Rose','Jenny','Mandaluyong City','Mandaluyong City','Mandaluyong City','Metro Manila','2131','pending','2024-04-07 13:11:36','2024-04-07 13:11:36',3),(39,'Rose','Jenny','Mandaluyong City','Mandaluyong City','Mandaluyong City','Metro Manila','2131','pending','2024-04-07 13:23:28','2024-04-07 13:23:28',3),(40,'Rose','John','Mandaluyong City','Mandaluyong City','Mandaluyong City','Metro Manila','2131','pending','2024-04-07 14:36:40','2024-04-07 14:36:40',3),(41,'Rose','Jenny','Mandaluyong City','Mandaluyong City','Mandaluyong City','Metro Manila','2131','pending','2024-04-07 14:44:25','2024-04-07 14:44:25',3),(42,'Rose','Jenny','Mandaluyong City','Mandaluyong City','Mandaluyong City','Metro Manila','2131','pending','2024-04-07 14:53:10','2024-04-07 14:53:10',3),(43,'Rose','Jennyaaaaa','Mandaluyong City','Mandaluyong City','Mandaluyong City','Metro Manila','2131','pending','2024-04-07 14:54:44','2024-04-07 14:54:44',6),(44,'Rose','Jenny','Mandaluyong City','Mandaluyong City','Mandaluyong City','Metro Manila','2131','pending','2024-04-07 15:10:41','2024-04-07 15:10:41',3),(45,'Rosexx','Jennyxx','Mandaluyong City','Mandaluyong City','Mandaluyong City','Metro Manila','2131','pending','2024-04-07 15:11:53','2024-04-07 15:11:53',8);
/*!40000 ALTER TABLE `shipping_informations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `contact_number` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `last_failed_log_in` datetime DEFAULT NULL,
  `is_admin` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,'\'Donell\'','\'Oconer\'','\'donellpie@gmail.com\'','\'09451830225\'','5dcda98e956af64004384c547086f824','6c35074e0ab4736c479292e930b18b6544ea39c68534','2024-04-06 08:44:33','2024-04-06 08:44:33','2024-04-07 23:02:24',1),(4,'\'Jenny\'','\'Rose\'','\'foni@email.com\'','\'09451820226\'','d8712676741c48ce13faa1aa53b539ca','775984d316209228675eb145b924e27dd3e9a11c08d1','2024-04-07 18:00:49','2024-04-07 18:00:49',NULL,NULL),(5,'\'Jenny\'','\'Rose\'','\'foni1@email.com\'','\'09451830229\'','fd89c30f6d8758d927ebec17fe9def81','5053f001f479fc972f9c274b8eae62e5c52573c83b28','2024-04-07 22:41:46','2024-04-07 22:41:46',NULL,NULL),(6,'\'Jenny\'','\'Rose\'','\'foni2@email.com\'','\'09451830212\'','511fd6951f48f00faef60984b2b9d0cf','bcc630787b61b677bb3dd076d13da2652e4bbbfca044','2024-04-07 22:49:58','2024-04-07 22:49:58','2024-04-07 22:53:36',NULL),(7,'\'Michael\'','\'Choi\'','\'village88@email.com\'','\'09451890225\'','0a260f94323ba9a862cf111bcc1d4bcf','929f6d9a80d6b00ebd6fe030e8500c311c5012bf7f12','2024-04-07 23:03:21','2024-04-07 23:03:21',NULL,NULL),(8,'\'John\'','\'Wick\'','\'john@email.com\'','\'09451810225\'','4b5a10c96013d8973da9595ceb087eb1','a40083896261bf6d219ba187529d13a658eef49a5393','2024-04-07 23:07:31','2024-04-07 23:07:31',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-07 23:17:34
