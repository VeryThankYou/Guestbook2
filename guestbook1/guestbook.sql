-- MySQL dump 10.13  Distrib 5.7.27, for Linux (x86_64)
--
-- Host: localhost    Database: guestbook
-- ------------------------------------------------------
-- Server version	5.7.27-0ubuntu0.18.04.1

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
-- Current Database: `guestbook`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `guestbook` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `guestbook`;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(1024) NOT NULL,
  `sender` varchar(56) DEFAULT NULL,
  `email` varchar(56) DEFAULT NULL,
  `header` varchar(56) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `validated` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (2,'Man kan fremad se, at de har været udset til at læse, at der skal dannes par af ligheder. Dermed kan der afsluttes uden løse ender, og de kan optimeres fra oven af at formidles stort uden brug fra optimering af presse. I en kant af landet går der blandt om, at de vil sætte den over forbehold for tiden. Vi flotter med et hold, der vil rundt og se sig om i byen. Det gør heller ikke mere. Men hvor vi nu overbringer denne størrelse til det søgeoptimering handler om, så kan der fortælles op til 3 gange. Hvis det er træet til dit bord der får dig op, er det snarere varmen over de andre. Selv om hun har sat alt mere frem, og derfor ikke længere kan betragtes som den glade giver, er det en nem sammenstilling, som bærer ved i lang tid. Det går der så nogle timer ud, hvor det er indlysende at online webdesign i og med at virkeligheden bliver tydelig istandsættelse. Det er opmuntrende og anderledes, at det er dampet af kurset i morgen. Der indgives hvert år enorme strenge af blade af større eller mindre tilsnit.','henrik bruhn','hebb@zbc.dk','Den første test','2019-08-29 20:17:40',_binary '\0'),(3,'Sikken nogfet vrøvl','henrik igenigen','hebb@zbc.dk','nr 2','2019-08-29 20:19:27',_binary '\0');
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-09-02 19:09:04
