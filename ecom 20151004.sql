-- MySQL dump 10.13  Distrib 5.5.44, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: Ecom
-- ------------------------------------------------------
-- Server version	5.5.44-0ubuntu0.14.04.1

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
-- Table structure for table `AttributeValue`
--

DROP TABLE IF EXISTS `AttributeValue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AttributeValue` (
  `Id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `AttributeId` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Value` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AttributeValue`
--

LOCK TABLES `AttributeValue` WRITE;
/*!40000 ALTER TABLE `AttributeValue` DISABLE KEYS */;
INSERT INTO `AttributeValue` VALUES ('1','1','#fff'),('10','3','3kg'),('11','3','2kg'),('12','3','1kg'),('13','4','Mỹ '),('14','4','Nhật'),('16','1','#123'),('2','1','#ddd'),('3','1','#eee'),('4','1','#333'),('5','1','#999'),('6','2','60 x 100'),('7','2','30 x 40'),('8','2','60 x 90'),('9','2','100 x 200');
/*!40000 ALTER TABLE `AttributeValue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Attributes`
--

DROP TABLE IF EXISTS `Attributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Attributes` (
  `Id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `Code` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Attributes`
--

LOCK TABLES `Attributes` WRITE;
/*!40000 ALTER TABLE `Attributes` DISABLE KEYS */;
INSERT INTO `Attributes` VALUES ('1','Màu sắc','mau-sac'),('2','Kích thước','kich-thuoc'),('3','Khối lượng','khoi-luong'),('4','Xuất xứ','xuat-xu');
/*!40000 ALTER TABLE `Attributes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Banner`
--

DROP TABLE IF EXISTS `Banner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Banner` (
  `Id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `UrlPath` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `Link` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Title` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `CreateDate` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Banner`
--

LOCK TABLES `Banner` WRITE;
/*!40000 ALTER TABLE `Banner` DISABLE KEYS */;
/*!40000 ALTER TABLE `Banner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Category`
--

DROP TABLE IF EXISTS `Category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Category` (
  `Id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `ParentId` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Order` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Category`
--

LOCK TABLES `Category` WRITE;
/*!40000 ALTER TABLE `Category` DISABLE KEYS */;
INSERT INTO `Category` VALUES ('1','Đồ gia dụng','0',1),('2','Đồ điện tử','0',2),('3','Máy tính','0',3),('5','1236','0',4),('6','a','0',5),('7','aaaaa','2',1);
/*!40000 ALTER TABLE `Category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Customer`
--

DROP TABLE IF EXISTS `Customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Customer` (
  `Id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `Phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Address` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ProvinceId` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DistrictId` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `Password` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Customer`
--

LOCK TABLES `Customer` WRITE;
/*!40000 ALTER TABLE `Customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `Customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Gallery`
--

DROP TABLE IF EXISTS `Gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Gallery` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Path` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `CreateDate` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Gallery`
--

LOCK TABLES `Gallery` WRITE;
/*!40000 ALTER TABLE `Gallery` DISABLE KEYS */;
INSERT INTO `Gallery` VALUES (1,'uploads/test.png','0000-00-00 00:00:00'),(2,'uploads/test.png','0000-00-00 00:00:00'),(3,'uploads/1441039509_MEBE_SN_300_450.gif','0000-00-00 00:00:00'),(4,'uploads/1441039231_bimsua_2505_300_450.gif','0000-00-00 00:00:00'),(5,'uploads/1441039509_MEBE_SN_300_450.gif','0000-00-00 00:00:00'),(6,'uploads/1441039231_bimsua_2505_300_450.gif','0000-00-00 00:00:00'),(7,'uploads/1441039509_MEBE_SN_300_450.gif','0000-00-00 00:00:00'),(8,'uploads/1441039231_bimsua_2505_300_450.gif','0000-00-00 00:00:00'),(9,'uploads/1441039509_MEBE_SN_300_450.gif','0000-00-00 00:00:00'),(10,'uploads/1441039231_bimsua_2505_300_450.gif','0000-00-00 00:00:00'),(11,'uploads/1441039509_MEBE_SN_300_450.gif','0000-00-00 00:00:00'),(12,'uploads/1441039231_bimsua_2505_300_450.gif','0000-00-00 00:00:00'),(13,'uploads/1441039509_MEBE_SN_300_450.gif','0000-00-00 00:00:00'),(14,'uploads/1441039509_MEBE_SN_300_450.gif','0000-00-00 00:00:00'),(15,'uploads/1441039231_bimsua_2505_300_450.gif','0000-00-00 00:00:00'),(16,'uploads/1441039509_MEBE_SN_300_450.gif','0000-00-00 00:00:00'),(17,'uploads/1441039231_bimsua_2505_300_450.gif','0000-00-00 00:00:00'),(18,'uploads/1441039231_bimsua_2505_300_450.gif','0000-00-00 00:00:00'),(19,'uploads/1441039509_MEBE_SN_300_450.gif','0000-00-00 00:00:00'),(20,'uploads/1441039509_MEBE_SN_300_450.gif','0000-00-00 00:00:00'),(21,'uploads/1441039231_bimsua_2505_300_450.gif','0000-00-00 00:00:00'),(22,'uploads/1441039509_MEBE_SN_300_450.gif','0000-00-00 00:00:00'),(23,'uploads/1441039231_bimsua_2505_300_450.gif','0000-00-00 00:00:00'),(24,'uploads/1441039231_bimsua_2505_300_450.gif','0000-00-00 00:00:00'),(25,'uploads/1441039509_MEBE_SN_300_450.gif','0000-00-00 00:00:00'),(26,'uploads/1441039231_bimsua_2505_300_450.gif','0000-00-00 00:00:00'),(27,'uploads/1441039509_MEBE_SN_300_450.gif','0000-00-00 00:00:00'),(28,'uploads/1441039231_bimsua_2505_300_450.gif','0000-00-00 00:00:00'),(29,'uploads/1441039509_MEBE_SN_300_450.gif','0000-00-00 00:00:00'),(30,'uploads/1441039231_bimsua_2505_300_450.gif','0000-00-00 00:00:00'),(31,'uploads/1441039509_MEBE_SN_300_450.gif','0000-00-00 00:00:00'),(32,'uploads/1441039509_MEBE_SN_300_450.gif','0000-00-00 00:00:00'),(33,'uploads/1441039231_bimsua_2505_300_450.gif','0000-00-00 00:00:00'),(34,'uploads/1441039509_MEBE_SN_300_450.gif','0000-00-00 00:00:00'),(35,'uploads/1441039231_bimsua_2505_300_450.gif','0000-00-00 00:00:00'),(36,'uploads/1441039509_MEBE_SN_300_450.gif','0000-00-00 00:00:00'),(37,'uploads/1441039231_bimsua_2505_300_450.gif','0000-00-00 00:00:00'),(38,'uploads/1441039509_MEBE_SN_300_450.gif','0000-00-00 00:00:00'),(39,'uploads/1441039509_MEBE_SN_300_450.gif','0000-00-00 00:00:00'),(40,'uploads/1441039231_bimsua_2505_300_450.gif','0000-00-00 00:00:00'),(41,'uploads/1441039509_MEBE_SN_300_450.gif','0000-00-00 00:00:00'),(42,'uploads/1441039231_bimsua_2505_300_450.gif','0000-00-00 00:00:00'),(43,'uploads/1441039509_MEBE_SN_300_450.gif','0000-00-00 00:00:00'),(44,'uploads/1441039231_bimsua_2505_300_450.gif','0000-00-00 00:00:00'),(45,'uploads/1441039509_MEBE_SN_300_450.gif','0000-00-00 00:00:00'),(46,'uploads/1441039509_MEBE_SN_300_450.gif','0000-00-00 00:00:00'),(47,'uploads/1441039509_MEBE_SN_300_450.gif','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `Gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Order`
--

DROP TABLE IF EXISTS `Order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Order` (
  `Id` int(11) NOT NULL,
  `CustomerId` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CustomerShipInfoId` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `OrderDate` datetime DEFAULT NULL,
  `ShipDate` datetime DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `OrderNote` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TransportType` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PaymentType` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TotalProduct` int(11) DEFAULT NULL,
  `OriginalTotalMoney` decimal(10,0) DEFAULT NULL,
  `PromotionValue` decimal(10,0) DEFAULT NULL,
  `PaymentTotal` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Order`
--

LOCK TABLES `Order` WRITE;
/*!40000 ALTER TABLE `Order` DISABLE KEYS */;
/*!40000 ALTER TABLE `Order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `OrderDetail`
--

DROP TABLE IF EXISTS `OrderDetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `OrderDetail` (
  `Id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `OrderId` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ProductId` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `OriginalPrice` decimal(10,0) NOT NULL,
  `PromotionValue` decimal(10,0) NOT NULL,
  `PromotionNote` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PaymentPrice` decimal(10,0) NOT NULL,
  `Quantity` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `OrderDetail`
--

LOCK TABLES `OrderDetail` WRITE;
/*!40000 ALTER TABLE `OrderDetail` DISABLE KEYS */;
/*!40000 ALTER TABLE `OrderDetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Product`
--

DROP TABLE IF EXISTS `Product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Product` (
  `Id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `CategoryId` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Summary` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Description` text COLLATE utf8_unicode_ci,
  `Price` decimal(10,0) NOT NULL DEFAULT '0',
  `PromotionValue` decimal(10,0) DEFAULT NULL,
  `IsPercentPromotion` bit(1) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `CreateUser` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UpdateUser` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PromotionDesc` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ProviderId` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PromotionPrice` decimal(10,0) NOT NULL,
  PRIMARY KEY (`Id`),
  FULLTEXT KEY `idx_product` (`Name`,`Code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Product`
--

LOCK TABLES `Product` WRITE;
/*!40000 ALTER TABLE `Product` DISABLE KEYS */;
INSERT INTO `Product` VALUES ('6','MG02','Máy giặt Sharp','2','Máy giặt Sharp','',6000000,15,'','2015-09-20 15:33:04','2015-10-04 13:34:13','1','1',NULL,'CONHANG','1',5100000),('5','MG01','Máy giặt Sharp','1','Máy giặt Sharp','<p>M&aacute;y giặt Sharp</p>\n\n<p><img alt=\"\" src=\"/ckfinder/userfiles/images/1441039231_bimsua_2505_300_450.gif\" style=\"height:450px; width:300px\" /></p>\n\n<p><img alt=\"\" src=\"/ckfinder/userfiles/images/1442666400-chelsea.jpg\" style=\"height:288px; width:500px\" /></p>\n',5000000,14,'','2015-09-20 15:33:04','2015-10-04 13:33:27','1','1',NULL,'CONHANG','1',4300000),('4','TV04','Ti vi Sharp','2','Ti vi Sharp','',4000000,13,'','2015-09-20 15:33:04','2015-10-04 13:34:22','1','1',NULL,'CONHANG','2',3480000),('1','TV01','Ti vi Sharp','1','Ti vi Sharp','',1000000,10,'','2015-09-20 15:33:04','2015-10-04 13:34:27','1','1',NULL,'CONHANG','2',900000),('2','TV02','Ti vi Sharp','2','Ti vi Sharp','',2000000,11,'','2015-09-20 15:33:04','2015-10-04 13:34:32','1','1',NULL,'CONHANG','2',1780000),('3','TV03','Ti vi Sharp','1','Ti vi Sharp','',3000000,12,'','2015-09-20 15:33:04','2015-10-04 13:34:37','1','1',NULL,'CONHANG','3',2640000);
/*!40000 ALTER TABLE `Product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ProductAttrValue`
--

DROP TABLE IF EXISTS `ProductAttrValue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ProductAttrValue` (
  `ProductId` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `AttributeValueId` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ProductId`,`AttributeValueId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ProductAttrValue`
--

LOCK TABLES `ProductAttrValue` WRITE;
/*!40000 ALTER TABLE `ProductAttrValue` DISABLE KEYS */;
INSERT INTO `ProductAttrValue` VALUES ('1','11'),('3','1'),('3','10'),('3','11'),('3','2'),('4','1'),('4','10'),('5','1'),('5','10'),('5','2'),('5','3'),('5','4'),('5','5'),('5','6');
/*!40000 ALTER TABLE `ProductAttrValue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ProductImage`
--

DROP TABLE IF EXISTS `ProductImage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ProductImage` (
  `ProductId` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ImageId` int(11) NOT NULL,
  `IsDefault` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ProductId`,`ImageId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ProductImage`
--

LOCK TABLES `ProductImage` WRITE;
/*!40000 ALTER TABLE `ProductImage` DISABLE KEYS */;
INSERT INTO `ProductImage` VALUES ('1',46,''),('2',46,''),('3',46,''),('4',46,''),('5',44,'\0'),('5',46,''),('6',46,'');
/*!40000 ALTER TABLE `ProductImage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Provider`
--

DROP TABLE IF EXISTS `Provider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Provider` (
  `Id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `Code` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `LogoUrl` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Provider`
--

LOCK TABLES `Provider` WRITE;
/*!40000 ALTER TABLE `Provider` DISABLE KEYS */;
INSERT INTO `Provider` VALUES ('1','Sharp','sharp','','Sharp'),('2','Sony','sony','','Sony'),('3','Toshiba','toshiba','','Toshiba');
/*!40000 ALTER TABLE `Provider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ProvinceDistrict`
--

DROP TABLE IF EXISTS `ProvinceDistrict`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ProvinceDistrict` (
  `Id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `ParentId` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ProvinceDistrict`
--

LOCK TABLES `ProvinceDistrict` WRITE;
/*!40000 ALTER TABLE `ProvinceDistrict` DISABLE KEYS */;
/*!40000 ALTER TABLE `ProvinceDistrict` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ShipInfo`
--

DROP TABLE IF EXISTS `ShipInfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ShipInfo` (
  `Id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `ProvinceId` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `DistrictId` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ShipInfo`
--

LOCK TABLES `ShipInfo` WRITE;
/*!40000 ALTER TABLE `ShipInfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `ShipInfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `Id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `CreateDate` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES ('2','Quang hợp 111','hopdq1102@gmail.com','e10adc3949ba59abbe56e057f20f883e','2015-09-23 12:02:26');
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'Ecom'
--
/*!50003 DROP PROCEDURE IF EXISTS `productAttributes_Get4ProductManager` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `productAttributes_Get4ProductManager`(in productId varchar(20))
BEGIN
	select
	av.Id,
	av.AttributeId,
	av.Value,
	case when ifnull(a.ProductId, '0') != '0' then true else false end as Checked 
	from AttributeValue av
	inner join Attributes att on av.AttributeId = att.Id
	left join 
	( 
		select pa.ProductId, pa.AttributeValueId from ProductAttrValue pa
		where pa.ProductId = productId
	) a on av.Id = a.AttributeValueId;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `productAttributeValue_InsertUpdate` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `productAttributeValue_InsertUpdate`(in productId varchar(20), in attrIdList varchar(1000))
BEGIN
	declare Cnt int;
	declare maxCnt int;
	DROP temporary TABLE IF EXISTS TmpTable;
	CREATE TEMPORARY TABLE TmpTable (
		attrbuteValueId varchar(20)
	);
	set Cnt = 1;
	set maxCnt = (length(attrIdList) - length(replace(attrIdList, ',', ''))) + 1;
	while Cnt <= maxCnt do
		insert into TmpTable
		select 
			SUBSTRING_INDEX(SUBSTRING_INDEX(attrIdList, ',', Cnt), ',', -1);
		set Cnt = Cnt + 1;
	END WHILE;
	delete from ProductAttrValue
	where ProductId = productId and AttributeValueId not in (
		select attrbuteValueId from TmpTable
	);
	insert into ProductAttrValue
	select productId, tt.attrbuteValueId from TmpTable tt
	left join 
	(
		select av.AttributeValueId from ProductAttrValue av where av.ProductId = productId
	) A on tt.attrbuteValueId = A.AttributeValueId
	where A.AttributeValueId is null;
	drop temporary table TmpTable;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `productImage_InsertUpdate` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `productImage_InsertUpdate`(in productId varchar(20), in imageIds varchar(1000), in imgDefaultId varchar(20))
BEGIN
	declare Cnt int;
	declare maxCnt int;
	DROP temporary TABLE IF EXISTS TmpTable;
	CREATE TEMPORARY TABLE TmpTable (
		imgId varchar(20)
	);
	set Cnt = 1;
	set maxCnt = (length(imageIds) - length(replace(imageIds, ',', ''))) + 1;
	while Cnt <= maxCnt do
		insert into TmpTable
		select 
			SUBSTRING_INDEX(SUBSTRING_INDEX(imageIds, ',', Cnt), ',', -1);
		set Cnt = Cnt + 1;
	END WHILE;
	delete from ProductImage
	where ProductId = productId and ImageId not in (
		select imgId from TmpTable
	);
	insert into ProductImage(ProductId, ImageId, IsDefault)
	select productId, tt.imgId, 0 from TmpTable tt
	left join 
	(
		select pi.ImageId from ProductImage pi where pi.ProductId = productId
	) A on tt.imgId = A.ImageId
	where A.ImageId is null;
	update ProductImage set IsDefault = case when ImageId = imgDefaultId then 1 else 0 end
	where ProductId = productId;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Product_GetAll_Paging` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `Product_GetAll_Paging`(in keyword varchar(250), in cateId varchar(20), in status varchar(20), in pageNumber int, in pageSize int)
BEGIN
set keyword = lower(keyword);
set @totalRow = (select count(*) from Product p
inner join Category c on p.CategoryId = c.Id
where 
	(ifnull(keyword, '') = '' or lower(p.`Code`) = keyword or lower(p.`Name`) like concat('%',keyword,'%'))
and (ifnull(cateId, '0') = '0' or p.CategoryId = cateId)
and (ifnull(`status`, '0') = '0' or p.`Status` = `status`));
set @totalPage = ceiling(cast(@totalRow as decimal)/ pageSize);
set @row_count = 0;
select * from
(
	select
		(@row_count := @row_count + 1) as RowNumber,
		p.Id,
		p.`Code`,
		p.`Name`,
		p.CategoryId,
		c.`Name` as CategoryName,
		p.Price,
		p.PromotionValue,
		p.IsPercentPromotion,
		p.CreateDate,
		u.`Name` as UserCreate,
		p.UpdateDate,
		p.`Status`,
		i.`Name` as UserUpdate,
		@totalPage as TotalPage
	from Product p
	inner join Category c on p.CategoryId = c.Id
	left join User u on p.CreateUser = u.Id
	left join User i on p.UpdateUser = i.Id
	where 
		(ifnull(keyword, '') = '' or lower(p.`Code`) = keyword or lower(p.`Name`) like concat('%',keyword,'%'))
	and (ifnull(cateId, '0') = '0' or p.CategoryId = cateId)
	and (ifnull(`status`, '0') = '0' or p.`Status` = `status`)
	order by p.UpdateDate desc, p.CreateDate desc
) A where A.RowNumber > (pageNumber - 1) * pageSize and A.RowNumber <= pageNumber * pageSize
order by A.RowNumber;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-10-04 16:42:47
