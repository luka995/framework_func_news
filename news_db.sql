CREATE DATABASE  IF NOT EXISTS `news_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `news_db`;
--
-- Host: localhost    Database: news_db
-- ------------------------------------------------------

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
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `pub_time` datetime NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `member_id` (`member_id`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (1,1,1,'2021-01-07 23:04:09','Intel gubi vodeću poziciju!'),(2,1,1,'2021-01-07 23:04:18','Novi komentar'),(3,3,2,'2021-01-07 23:17:13','Objavom Edge-a za Linux, Microsoft jasno želi da privuče developere na svoju platformu');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `type_id` (`type_id`),
  CONSTRAINT `member_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `member_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member`
--

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` VALUES (1,1,'Admin','admin','$2y$10$QxMOnoSQLI3VHiaDmkmBkuJfETXBUyoMgFRfsDKHF6uMcVBvjrwmC'),(2,2,'Korisnik','korisnik','$2y$10$jeazXPWhRZzqrevHyhKAjeCmpz8Sz5CNoyTBAdJOCRVAHC5o5Vtge'),(3,1,'Ivana','admin2','$2y$10$X5bEbu1HYMpbV/b0hEBSAuiKTZMiEX68uR9BlfmOtDDFyolmH5Zb6');
/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_type`
--

DROP TABLE IF EXISTS `member_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `can_create_post` tinyint(4) NOT NULL,
  `can_comment` tinyint(4) NOT NULL,
  `can_register_member` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `type_name` (`type_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_type`
--

LOCK TABLES `member_type` WRITE;
/*!40000 ALTER TABLE `member_type` DISABLE KEYS */;
INSERT INTO `member_type` VALUES (1,'Administrator',1,1,1),(2,'Korisnik',0,1,0);
/*!40000 ALTER TABLE `member_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pub_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (1,1,'Apple predstavio MacBook Pro sa M1 čipom, zasnovanim na ARM-u','img/m1.jpg','<p>Apple je predstavio svoj prvi MacBook Pro laptop, koji koristi procesor dizajniran od strane Apple-a, a zasnovan je na ARM arhitekturi.</p>\r\n\r\n<p>Novi MacBook Pro ima veličinu od 13.3 inča, a koristiće Apple-ov najnoviji Apple M1 procesor, za koji kompanija tvrdi da ima najbrže CPU jezgro na svetu, najbržu integrisanu grafičku kartu i velika poboljšanja u performansama i potrošnji u odnosu na Intel čipove koji su do sada korišćeni. Laptop stiže uz macOS 11 Big Sur softver, za koji Apple ističe da je dizajniran za rad sa novim hardverom.</p>\r\n\r\n<p>Apple je pomenuo da su performanse novog 13-inčnog MacBook Pro laptopa za 2,8 puta brže od prethodne generacije, dok je grafika za pet puta brža.</p>\r\n\r\n<p>Laptop ima i aktivni sistem hlađenja, touch bar, dva Thunderbolt 4 porta. Radni vek baterije takođe dobija poboljšanja i sada nudi do 17 sati pregleda interneta, kao i 20 sati reprodukcije videa.\r\n\r\nPored MacBook Pro laptopova, novi Apple Silicon M1 čip dobijaju i novi 13-inčni MacBook Air i novi Mac mini.\r\n\r\nMacBook Pro od 13.3 inča stiže sa početnom cenom od 1299 dolara, a na tržištu će se naći od naredne nedelje.\r\n</p>','2021-01-07 20:59:19'),(2,1,'Nove Dell Latitude 9000 laptopove karakteriše automatski zatvarač veb kamere','https://www.benchmark.rs/assets/img/news/main/e296fa896d6600091452ddb36fbcd3ee.jpg','<p>Dell je pred početak ovogodišnjeg CES 2021 sajma najavio liniju laptopova za 2021. godinu. Jedna od novih funkcija za Latitude 9000 seriju bi mogla omogućiti korisnicima veći osećaj sigurnosti kada rade ili uče od kuće.</p>\r\n\r\n<p>Latitude 9420 i Latitude 9520 laptopovi stižu sa funkcijom koja nosi naziv SafeShutter. Dell ističe da je u pitanju prvi industrijski zatvarač za veb kamere, koji može da se otvara ili zatvara samostalno, u zavisnosti od sinhronizovanja sa aplikacijama za video konferencije.\r\n</p>\r\n\r\n<p>Pored ovoga, novi modeli laptopova imaju i nadogradnju procesora, pa su tako sada tu Intel Core vPro CPU-ovi 11. generacije. Detalji o 9520 modelu nisu objavljeni, ali Dell ističe da će Latitud 9420 stići sa poboiljšanjima za rad od kuće. Tu su bolji ugrađeni zvučnici, poboljšanja kamere uključujući i automatsku korekciju svetla i pozadinskog zamućenja.\r\n</p>\r\n\r\n<p>Nova Latitude 9000 serija laptopova je distupna u preklopnoj ili 2-u-1 konfiguraciji (koja ima 5G ili 4G LTE i eSIM opcije). Latitude 9420 će biti dostupan u prodaji na proleće, po početnoj ceni od 1949 dolara, dok će detalji o Latitude 9520 modelu biti poznati kasnije.\r\n</p>\r\n\r\n<p>Za one koji žele laptop sa velikim ekranom, Dell nudi novi Latitude 7520. Uređaj ima 15-inčni 4K UHD displej, sa opcionom kamerom visoke definicije. Laptop će se na tržištu naći od 12. januara, po ceni od 1049 dolara.\r\n</p>','2021-01-07 23:09:06'),(3,1,'Linux korisnici od oktobra dobijaju Microsoft Edge preview','https://www.benchmark.rs/assets/img/news/main/c83dac57b21b617257a011978e6c028c.jpg','<p>Microsoftov prerađeni i redizajnirani Edge pregledač, zasnovan na Chromiumu, konačno od narednog meseca stiže na Linux. Edge će na platformu stići u preview obliku za developere.\r\n</p>\r\n<p>Korisnici će moći da browser preuzmu preko Edge Insider kanala, kada postane dostupan, ili preko Linux package managera. Kao i na Windows i Mac platformama, novi Edge koristi isti \"browser engine\" koji pokreće i Google Chrome, a podržava i Chrome ekstenzije.\r\n</p>\r\n<p>Microsoft je dodao više funkcija koje se fokusiraju na privatnost, a korisnik ima direktnu kontrolu nad tim kako ih sajtovi prate. Tu su i inovacije, kao što je Collections, za organizovanje informacija širom veba.\r\n</p>\r\n <p>Objavom Edge-a za Linux, Microsoft jasno želi da privuče developere na svoju platformu. Da li će se kompanijini napori isplatiti, ostaje da se vidi, s obzirom na to da postoje alternative kao što su Firefox ili Brave, koje već imaju dobar renome i potpuno su otvorenog koda.\r\n</p>\r\n\r\n','2021-01-07 23:15:23');
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'news_db'
--

--
-- Dumping routines for database 'news_db'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-01-07 23:23:46
