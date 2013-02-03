-- MySQL dump 10.13  Distrib 5.5.28, for Linux (i686)
--
-- Host: localhost    Database: imact
-- ------------------------------------------------------
-- Server version	5.5.29-log

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
-- Table structure for table `imact_images`
--

DROP TABLE IF EXISTS `imact_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imact_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `description` text,
  `api_resource_id` text,
  `favorite` tinyint(1) DEFAULT NULL,
  `api` varchar(45) DEFAULT NULL,
  `custom_data` longtext COMMENT 'This table will hold all the common/searchable image metadata in fields and all the \\"extra\\" data under a serialized content in the custom_data field.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imact_images`
--

LOCK TABLES `imact_images` WRITE;
/*!40000 ALTER TABLE `imact_images` DISABLE KEYS */;
INSERT INTO `imact_images` VALUES (43,'image/jpeg',624,936,381932,'Bubbles of methane in a frozen lake. ','','LWoryKw',1,NULL,'a:11:{s:8:\"datetime\";i:1359596777;s:8:\"animated\";b:0;s:5:\"views\";i:298858;s:9:\"bandwidth\";d:114143433656;s:4:\"vote\";N;s:11:\"account_url\";N;s:4:\"link\";s:30:\"http://i.imgur.com/LWoryKw.jpg\";s:3:\"ups\";i:1809;s:5:\"downs\";i:13;s:5:\"score\";i:2257;s:8:\"is_album\";b:0;}'),(44,'image/jpeg',960,960,139696,'Best 5 cents you\'ll ever spend','','q949ihH',1,NULL,'a:11:{s:8:\"datetime\";i:1359601935;s:8:\"animated\";b:0;s:5:\"views\";i:504872;s:9:\"bandwidth\";d:70528598912;s:4:\"vote\";N;s:11:\"account_url\";s:11:\"clidelennon\";s:4:\"link\";s:30:\"http://i.imgur.com/q949ihH.jpg\";s:3:\"ups\";i:1347;s:5:\"downs\";i:9;s:5:\"score\";i:1983;s:8:\"is_album\";b:0;}'),(45,'image/png',892,800,659665,'How can a TV show possibly be at risk of cancellation if they put THIS on the air for us?','','yGUDpxw',1,NULL,'a:11:{s:8:\"datetime\";i:1359602075;s:8:\"animated\";b:0;s:5:\"views\";i:257757;s:9:\"bandwidth\";d:170033271405;s:4:\"vote\";N;s:11:\"account_url\";N;s:4:\"link\";s:30:\"http://i.imgur.com/yGUDpxw.png\";s:3:\"ups\";i:1263;s:5:\"downs\";i:45;s:5:\"score\";i:1646;s:8:\"is_album\";b:0;}'),(46,'image/jpeg',640,480,85228,'Circle of life','Falcons got the snakes','3dGG6Fo',1,NULL,'a:11:{s:8:\"datetime\";i:1359594670;s:8:\"animated\";b:0;s:5:\"views\";i:590459;s:9:\"bandwidth\";d:50323639652;s:4:\"vote\";N;s:11:\"account_url\";N;s:4:\"link\";s:30:\"http://i.imgur.com/3dGG6Fo.jpg\";s:3:\"ups\";i:1214;s:5:\"downs\";i:6;s:5:\"score\";i:1806;s:8:\"is_album\";b:0;}'),(47,'image/jpeg',1024,768,127422,'I think the FBI is parked outside my apartment.','Monitoring your porn usage','sfAL6MN',1,NULL,'a:11:{s:8:\"datetime\";i:1359576991;s:8:\"animated\";b:0;s:5:\"views\";i:1484637;s:9:\"bandwidth\";d:189175415814;s:4:\"vote\";N;s:11:\"account_url\";N;s:4:\"link\";s:30:\"http://i.imgur.com/sfAL6MN.jpg\";s:3:\"ups\";i:3074;s:5:\"downs\";i:19;s:5:\"score\";i:4180;s:8:\"is_album\";b:0;}'),(48,'image/jpeg',576,768,64229,'Would make Dr. T.J. Eckleburg blush.','','ezkvfgz',1,NULL,'a:11:{s:8:\"datetime\";i:1359587223;s:8:\"animated\";b:0;s:5:\"views\";i:512484;s:9:\"bandwidth\";d:32916334836;s:4:\"vote\";N;s:11:\"account_url\";s:6:\"amanga\";s:4:\"link\";s:30:\"http://i.imgur.com/ezkvfgz.jpg\";s:3:\"ups\";i:1345;s:5:\"downs\";i:40;s:5:\"score\";i:1904;s:8:\"is_album\";b:0;}'),(49,'image/jpeg',658,960,69951,'test','ewtre','3ln55BL',1,NULL,'a:11:{s:8:\"datetime\";i:1359604789;s:8:\"animated\";b:0;s:5:\"views\";i:659340;s:9:\"bandwidth\";d:46121492340;s:4:\"vote\";N;s:11:\"account_url\";N;s:4:\"link\";s:30:\"http://i.imgur.com/3ln55BL.jpg\";s:3:\"ups\";i:1873;s:5:\"downs\";i:38;s:5:\"score\";i:2465;s:8:\"is_album\";b:0;}'),(50,'image/gif',240,154,395309,'Imgur, could you please make Fabulous another stage of Notoriety?','','w9PqIcW',1,NULL,'a:11:{s:8:\"datetime\";i:1359655615;s:8:\"animated\";b:0;s:5:\"views\";i:102014;s:9:\"bandwidth\";d:40327052326;s:4:\"vote\";N;s:11:\"account_url\";s:19:\"IWillTakeYourTalent\";s:4:\"link\";s:30:\"http://i.imgur.com/w9PqIcW.gif\";s:3:\"ups\";i:1757;s:5:\"downs\";i:47;s:5:\"score\";i:1761;s:8:\"is_album\";b:0;}'),(51,'image/jpeg',990,617,119690,'A wave up close','','XNtjDC4',1,NULL,'a:11:{s:8:\"datetime\";i:1359669475;s:8:\"animated\";b:0;s:5:\"views\";i:333035;s:9:\"bandwidth\";d:39860959150;s:4:\"vote\";N;s:11:\"account_url\";N;s:4:\"link\";s:30:\"http://i.imgur.com/XNtjDC4.jpg\";s:3:\"ups\";i:1349;s:5:\"downs\";i:6;s:5:\"score\";i:1809;s:8:\"is_album\";b:0;}'),(52,'image/jpeg',609,465,86187,'She must be really deep under cover','All the way','RAdJlHl',1,NULL,'a:11:{s:8:\"datetime\";i:1359669837;s:8:\"animated\";b:0;s:5:\"views\";i:759978;s:9:\"bandwidth\";d:65500223886;s:4:\"vote\";N;s:11:\"account_url\";s:8:\"mcgreeeg\";s:4:\"link\";s:30:\"http://i.imgur.com/RAdJlHl.jpg\";s:3:\"ups\";i:1135;s:5:\"downs\";i:16;s:5:\"score\";i:2094;s:8:\"is_album\";b:0;}');
/*!40000 ALTER TABLE `imact_images` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-02-02 11:25:08
