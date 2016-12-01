/*
SQLyog Ultimate v11.24 (32 bit)
MySQL - 5.5.52-0ubuntu0.14.04.1 : Database - warehouse
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `ClientContacts` */

DROP TABLE IF EXISTS `ClientContacts`;

CREATE TABLE `ClientContacts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ClientId` int(11) DEFAULT NULL,
  `ContactId` int(11) DEFAULT NULL,
  `Memo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `ClientContacts` */

insert  into `ClientContacts`(`id`,`ClientId`,`ContactId`,`Memo`) values (1,5,8,NULL),(2,6,9,NULL),(3,7,9,NULL),(4,8,10,NULL),(5,9,11,NULL),(6,10,12,NULL);

/*Table structure for table `Clients` */

DROP TABLE IF EXISTS `Clients`;

CREATE TABLE `Clients` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(200) DEFAULT NULL,
  `Phone` varchar(50) DEFAULT NULL,
  `Fax` varchar(50) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Address` varchar(200) DEFAULT NULL,
  `ContactId` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `Clients` */

insert  into `Clients`(`Id`,`Name`,`Phone`,`Fax`,`Email`,`Address`,`ContactId`) values (1,'client1','326666','8888','a@a.com','326666',8),(2,'client2','6666','8888','a@a.com','6666',NULL),(3,'newclient','3332','3453','c@c.com','address',NULL),(4,'newclient166666333','3332','345322','c@c.com','3332',NULL),(5,'newclient2','3332','3453','c@c.com','address',8),(6,'newclient3','3222','666','a@a.com','add',NULL),(7,'newclient4','3222','666','a@a.com','add',9),(8,'test2','3333','444','a@a.com','address',10),(9,'阿斯顿发斯蒂芬','asdf','dsfadsf','asdf','asdf',11),(10,'大萨达','啊','萨达','as','撒地方',12);

/*Table structure for table `Contacts` */

DROP TABLE IF EXISTS `Contacts`;

CREATE TABLE `Contacts` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(200) DEFAULT NULL,
  `Phone` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Cellphone` varchar(50) DEFAULT NULL,
  `qq` varchar(50) DEFAULT NULL,
  `weixin` varchar(50) DEFAULT NULL,
  `Address` varchar(200) DEFAULT NULL,
  `Memo` text,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `Contacts` */

insert  into `Contacts`(`Id`,`Name`,`Phone`,`Email`,`Cellphone`,`qq`,`weixin`,`Address`,`Memo`) values (1,'qiangdong','3333','a@a.com','333',NULL,NULL,'3333',NULL),(2,'liusan','3333','a@a.com','333','aabb','no','3333',NULL),(3,'liusan','3333','a@a.com','333','aabb','no','3333',NULL),(4,'qiangd2ong2','3333','a@a.com','333','aabb','no','3333',NULL),(5,'michael',NULL,NULL,'13905329087',NULL,NULL,NULL,NULL),(6,'StevenFu','646353','233@22.com','1395322222',NULL,NULL,'address4',NULL),(7,'StevenFu','646353','233@22.com','1395322222',NULL,NULL,'address4',NULL),(8,'Tom','3332','c@c.com','Cluse',NULL,NULL,'address',NULL),(9,'Hillary','3222','a@a.com','54232322',NULL,NULL,'add',NULL),(10,'contact1','3333','a@a.com','138',NULL,NULL,'address',NULL),(11,'asdf','asdf','asdf','sadf',NULL,NULL,'sadfa',NULL),(12,'as','啊','as','阿萨德',NULL,NULL,'撒地方',NULL),(13,'3223232','23','2','23232323',NULL,NULL,NULL,NULL),(14,'大名','23','2','128',NULL,NULL,'多',NULL);

/*Table structure for table `Inventories` */

DROP TABLE IF EXISTS `Inventories`;

CREATE TABLE `Inventories` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `StoreId` int(11) DEFAULT NULL,
  `ProductId` int(11) DEFAULT NULL,
  `Quantity` decimal(10,2) DEFAULT NULL,
  `MaxPrice` decimal(10,2) DEFAULT NULL,
  `MinPrice` decimal(10,2) DEFAULT NULL,
  `MinOutPrice` decimal(10,2) DEFAULT NULL,
  `MaxOutPrice` decimal(10,2) DEFAULT NULL,
  `Index` int(11) DEFAULT NULL,
  `LastUpdate` datetime DEFAULT NULL,
  `UserId` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `Inventories` */

insert  into `Inventories`(`Id`,`StoreId`,`ProductId`,`Quantity`,`MaxPrice`,`MinPrice`,`MinOutPrice`,`MaxOutPrice`,`Index`,`LastUpdate`,`UserId`) values (7,2,1,'0.00','380.00','5000.00','395.21',NULL,9,'2016-11-28 09:41:45',1),(8,2,2,'-7807.11','33.25','45.00','33.25',NULL,5,'2016-11-29 12:18:11',4),(9,2,4,'-67.00','1.25','1.25','1.25',NULL,4,'2016-11-28 09:41:46',1),(10,1,1,'6.00','9000.00','9000.00',NULL,NULL,1,'2016-11-28 12:04:16',1),(11,1,2,'10.00','3333.00','3333.00',NULL,NULL,1,'2016-11-28 12:04:18',1),(12,3,2,'0.00','33.25','33.25','33.25',NULL,2,'2016-11-28 13:50:29',1),(13,3,5,'0.00','1.25','1.25','1.25',NULL,3,'2016-11-28 13:52:14',1),(14,7,8,'3.25','1.25','89.00','1.25',NULL,7,'2016-11-29 04:06:30',4),(15,7,7,'64.00','1.25','100.00','36.00',NULL,8,'2016-11-29 04:14:34',4),(16,7,4,'10.00','1.25','1.25',NULL,NULL,1,'2016-11-29 04:14:33',4),(17,1,8,'20.00','1.25','1.25',NULL,NULL,1,'2016-11-29 08:55:28',4);

/*Table structure for table `Products` */

DROP TABLE IF EXISTS `Products`;

CREATE TABLE `Products` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(200) DEFAULT NULL,
  `Specification` varchar(200) DEFAULT NULL,
  `Unit` varchar(20) DEFAULT NULL,
  `Width` decimal(10,0) DEFAULT NULL,
  `Height` decimal(10,0) DEFAULT NULL,
  `Length` decimal(10,0) DEFAULT NULL,
  `Brand` varchar(200) DEFAULT NULL,
  `Barcode` varchar(100) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `Products` */

insert  into `Products`(`Id`,`Name`,`Specification`,`Unit`,`Width`,`Height`,`Length`,`Brand`,`Barcode`,`Price`) values (1,'tv','hisense2dddd','unit','888','777','999','HiSense2','3356983safds','395.21'),(2,'icefrozer','specifincaton','1','10','20','50','HiSense','335698','33.25'),(3,'cellphone','hisense','12','102','202','502','HiSense','335698','1.25'),(4,'microwave','hisense','1','10','20','50','HiSense','335698','1.25'),(5,'电饼铛','hisense','1','10','20','50','HiSense','335698','1.25'),(6,'newone','specification','3','3','4','2','haier','22222','1.25'),(7,'test1','spe','un','4','5','2','223e','sdf','1.25'),(8,'test33333',NULL,'2','2','2','1','no','afsdfasdf','1.25');

/*Table structure for table `StockInDetails` */

DROP TABLE IF EXISTS `StockInDetails`;

CREATE TABLE `StockInDetails` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `StockInId` int(11) DEFAULT NULL,
  `ProductId` int(11) DEFAULT NULL,
  `Specification` varchar(200) DEFAULT NULL,
  `Quantity` decimal(10,2) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `Memo` varchar(2000) DEFAULT NULL,
  `StoreId` int(11) DEFAULT NULL,
  `InventoryId` int(11) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `UpdateSequ` int(11) DEFAULT NULL,
  `BeforeUpdate` decimal(10,2) DEFAULT NULL,
  `AfterUpdate` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

/*Data for the table `StockInDetails` */

insert  into `StockInDetails`(`Id`,`StockInId`,`ProductId`,`Specification`,`Quantity`,`Price`,`Memo`,`StoreId`,`InventoryId`,`UpdateDate`,`UpdateSequ`,`BeforeUpdate`,`AfterUpdate`) values (4,4,1,'hisense2dddd','3.00','395.21','',2,4,'2016-11-28 08:36:29',1,'0.00','3.00'),(5,4,2,'specifincaton','2.00','33.25','',2,5,'2016-11-28 08:36:30',1,'0.00','2.00'),(6,4,4,'hisense','3.00','1.25','',2,6,'2016-11-28 08:36:30',1,'0.00','3.00'),(7,5,1,'hisense2dddd','3.00','395.21','',2,7,'2016-11-28 08:38:11',1,'0.00','3.00'),(8,5,2,'specifincaton','2.00','33.25','',2,8,'2016-11-28 08:38:12',1,'0.00','2.00'),(9,5,4,'hisense','3.00','1.25','',2,9,'2016-11-28 08:38:12',1,'0.00','3.00'),(10,6,1,'hisense2dddd','3.00','395.21','',2,7,'2016-11-28 08:38:33',2,'3.00','6.00'),(11,6,2,'specifincaton','2.00','33.25','',2,8,'2016-11-28 08:38:33',2,'2.00','4.00'),(12,6,4,'hisense','3.00','1.25','',2,9,'2016-11-28 08:38:34',2,'3.00','6.00'),(13,7,1,'hisense2dddd','2.50','380.00','',2,7,'2016-11-28 08:40:44',3,'6.00','8.50'),(14,7,2,'specifincaton','0.89','45.00','',2,8,'2016-11-28 08:40:44',3,'4.00','4.89'),(15,8,1,'hisense2dddd','-1.00','395.21','',2,7,'2016-11-28 08:43:16',4,'8.50','7.50'),(16,9,1,'hisense2dddd','-1.00','395.21','',2,7,'2016-11-28 08:58:48',5,'7.50','6.50'),(17,9,1,'hisense2dddd','10.00','5000.00','',2,7,'2016-11-28 08:58:49',6,'6.50','16.50'),(18,10,1,'hisense2dddd','100.00','395.21','',2,7,'2016-11-28 09:53:46',7,'16.50','116.50'),(21,13,1,'hisense2dddd','6.00','9000.00','',1,10,'2016-11-28 12:04:17',1,'0.00','6.00'),(22,13,2,'specifincaton','10.00','3333.00','',1,11,'2016-11-28 12:04:19',1,'0.00','10.00'),(23,14,2,'specifincaton','10.00','33.25','',3,12,'2016-11-28 13:49:16',1,'0.00','10.00'),(24,14,5,'hisense','20.00','1.25','',3,13,'2016-11-28 13:49:16',1,'0.00','20.00'),(25,15,8,NULL,'10.00','1.25','',7,14,'2016-11-29 03:23:55',1,'0.00','10.00'),(26,15,7,'spe','100.00','100.00','',7,15,'2016-11-29 03:23:55',1,'0.00','100.00'),(27,16,8,NULL,'3.00','89.00','',7,14,'2016-11-29 03:28:38',3,'9.00','12.00'),(28,16,7,'spe','56.00','1.25','',7,15,'2016-11-29 03:28:39',3,'75.00','131.00'),(29,17,7,'spe','21.00','1.25','',7,15,'2016-11-29 03:31:48',5,'2.00','23.00'),(30,17,8,NULL,'1.25','68.00','',7,14,'2016-11-29 03:31:49',5,'0.00','1.25'),(31,18,8,'','1.00','1.25','',7,14,'2016-11-29 03:36:25',6,'1.25','2.25'),(32,18,7,'spe','1.00','1.25','',7,15,'2016-11-29 03:36:26',6,'23.00','24.00'),(33,19,8,'','1.00','1.25','',7,14,'2016-11-29 04:06:30',7,'2.25','3.25'),(34,19,7,'spe','20.00','1.25','',7,15,'2016-11-29 04:06:31',7,'24.00','44.00'),(35,20,4,'hisense','10.00','1.25','',7,16,'2016-11-29 04:14:34',1,'0.00','10.00'),(36,20,7,'spe','20.00','25.00','',7,15,'2016-11-29 04:14:34',8,'44.00','64.00'),(37,21,8,'special','20.00','1.25','',1,17,'2016-11-29 08:55:28',1,'0.00','20.00');

/*Table structure for table `StockIns` */

DROP TABLE IF EXISTS `StockIns`;

CREATE TABLE `StockIns` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `InvoiceNo` varchar(200) DEFAULT NULL,
  `EnteredDate` date DEFAULT NULL,
  `VendorId` int(11) DEFAULT NULL,
  `TotalPrice` decimal(10,2) DEFAULT NULL,
  `TotalNo` decimal(10,2) DEFAULT NULL,
  `UserId` int(11) DEFAULT NULL,
  `Memo` varchar(2000) DEFAULT NULL,
  `StoreId` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `StockIns` */

insert  into `StockIns`(`Id`,`InvoiceNo`,`EnteredDate`,`VendorId`,`TotalPrice`,`TotalNo`,`UserId`,`Memo`,`StoreId`) values (4,'002','2016-11-18',7,'1255.88','8.00',1,'',2),(5,'002','2016-11-18',7,'1255.88','8.00',1,'',2),(6,'002','2016-11-18',7,'1255.88','8.00',1,'',2),(7,'002','2016-11-18',7,'990.05','3.39',1,'',2),(8,'002','2016-11-18',7,'-395.21','-1.00',1,'',2),(9,'002','2016-11-18',7,'49604.79','9.00',1,'',2),(10,'sss','2016-11-11',10,'39521.00','100.00',1,'',2),(13,'fasdfsd','2016-11-09',7,'87330.00','16.00',1,'',0),(14,'','2016-11-28',2,'357.50','30.00',1,'',3),(15,'002','2016-11-29',14,'10012.50','110.00',4,'',7),(16,'003','2016-11-29',13,'337.00','59.00',4,'',0),(17,'005','2016-11-29',16,'111.25','22.25',4,'',7),(18,'','2016-11-29',11,'2.50','2.00',4,'',7),(19,'001','2016-11-29',2,'26.25','21.00',4,'',7),(20,'003','2016-11-29',11,'512.50','30.00',4,'',7),(21,'','2016-11-29',0,'25.00','20.00',4,'',1);

/*Table structure for table `StockOutDetails` */

DROP TABLE IF EXISTS `StockOutDetails`;

CREATE TABLE `StockOutDetails` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `StockOutId` int(11) DEFAULT NULL,
  `StoreId` int(11) DEFAULT NULL,
  `ProductId` int(11) DEFAULT NULL,
  `Quantity` decimal(10,2) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `Memo` varchar(2000) DEFAULT NULL,
  `InventoryId` int(11) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `UpdateSequ` int(11) DEFAULT NULL,
  `BeforeUpdate` decimal(10,2) DEFAULT NULL,
  `AfterUpdate` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

/*Data for the table `StockOutDetails` */

insert  into `StockOutDetails`(`Id`,`StockOutId`,`StoreId`,`ProductId`,`Quantity`,`Price`,`Memo`,`InventoryId`,`UpdateDate`,`UpdateSequ`,`BeforeUpdate`,`AfterUpdate`) values (18,10,2,1,'100.00','395.21','',7,'2016-11-28 09:55:27',8,'116.50','16.50'),(19,10,2,2,'35.00','33.25','',8,'2016-11-28 09:55:27',4,'4.89','-30.11'),(20,10,2,4,'6.00','1.25','',9,'2016-11-28 09:55:28',3,'6.00','0.00'),(21,11,2,1,'16.50','395.21','',7,'2016-11-28 09:41:45',9,'16.50','0.00'),(22,11,2,4,'67.00','1.25','',9,'2016-11-28 09:41:46',4,'0.00','-67.00'),(23,12,3,2,'10.00','33.25','',12,'2016-11-28 13:50:29',2,'10.00','0.00'),(24,12,3,5,'10.00','1.25','',13,'2016-11-28 13:50:30',2,'20.00','10.00'),(25,13,3,5,'10.00','1.25','',13,'2016-11-28 13:52:15',3,'10.00','0.00'),(26,14,7,8,'1.00','1.25','',14,'2016-11-29 03:25:03',2,'10.00','9.00'),(27,14,7,7,'25.00','36.00','',15,'2016-11-29 03:25:04',2,'100.00','75.00'),(28,15,7,8,'12.00','1.25','8',14,'2016-11-29 03:29:37',4,'12.00','0.00'),(29,15,7,7,'129.00','1.25','',15,'2016-11-29 03:29:37',4,'131.00','2.00'),(30,16,2,2,'7777.00','33.25','',8,'2016-11-29 12:18:12',5,'-30.11','-7807.11');

/*Table structure for table `StockOuts` */

DROP TABLE IF EXISTS `StockOuts`;

CREATE TABLE `StockOuts` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `InvoiceNo` varchar(200) DEFAULT NULL,
  `EnteredDate` date DEFAULT NULL,
  `ClientId` int(11) DEFAULT NULL,
  `TotalPrice` decimal(10,2) DEFAULT NULL,
  `TotalNo` decimal(10,2) DEFAULT NULL,
  `UserId` int(11) DEFAULT NULL,
  `Memo` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `StockOuts` */

insert  into `StockOuts`(`Id`,`InvoiceNo`,`EnteredDate`,`ClientId`,`TotalPrice`,`TotalNo`,`UserId`,`Memo`) values (10,'111','2016-11-12',2,'40692.25','141.00',1,''),(11,'','2016-11-28',0,'6604.71','83.50',1,''),(12,'','2016-11-28',0,'345.00','20.00',1,''),(13,'','2016-11-28',2,'12.50','10.00',1,''),(14,'001','2016-11-29',3,'901.25','26.00',4,''),(15,'003','2016-11-29',3,'176.25','141.00',4,''),(16,'99000','2016-11-29',9,'258585.25','7777.00',4,'');

/*Table structure for table `Stores` */

DROP TABLE IF EXISTS `Stores`;

CREATE TABLE `Stores` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(200) DEFAULT NULL,
  `Address` varchar(200) DEFAULT NULL,
  `Phone` varchar(50) DEFAULT NULL,
  `Fax` varchar(50) DEFAULT NULL,
  `Manager` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `Stores` */

insert  into `Stores`(`Id`,`Name`,`Address`,`Phone`,`Fax`,`Manager`) values (1,'中心仓库','333332','333332','88882',3),(2,'第一仓库','3','3','88883',3),(3,'第二仓库','33333','33333','8888',1),(7,'test4','332','332','3332',1),(9,'zhognxin','33','33','22',10),(10,'zhongxin2','aa','aa','33',2);

/*Table structure for table `Users` */

DROP TABLE IF EXISTS `Users`;

CREATE TABLE `Users` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) DEFAULT NULL,
  `Password` varchar(20) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Cellphone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `Users` */

insert  into `Users`(`Id`,`Name`,`Password`,`Email`,`Cellphone`) values (1,'Steven','123456','fuxinyu@gmail.com','13953253109'),(2,'管理员','123456','fuxinyu@gmail.com','13953253109'),(4,'admin','2','aa@aa.com','admin');

/*Table structure for table `VendorContacts` */

DROP TABLE IF EXISTS `VendorContacts`;

CREATE TABLE `VendorContacts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `VendorId` int(11) DEFAULT NULL,
  `ContactId` int(11) DEFAULT NULL,
  `Memo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `VendorContacts` */

insert  into `VendorContacts`(`id`,`VendorId`,`ContactId`,`Memo`) values (2,19,6,NULL),(3,20,13,NULL),(4,21,14,NULL);

/*Table structure for table `Vendors` */

DROP TABLE IF EXISTS `Vendors`;

CREATE TABLE `Vendors` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(200) DEFAULT NULL,
  `Phone` varchar(30) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Address` varchar(200) DEFAULT NULL,
  `Fax` varchar(30) DEFAULT NULL,
  `ContactId` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `Vendors` */

insert  into `Vendors`(`Id`,`Name`,`Phone`,`Email`,`Address`,`Fax`,`ContactId`) values (1,'太古百货','12345678AAAA','test@test.comAAAA','12345678AAAA','33333AAAA',NULL),(2,'test','12345678','test@test.com','unknown','',NULL),(7,'test1','12345678','','unknow',NULL,NULL),(10,'test1','12345678','','unknow',NULL,NULL),(11,'vendor2','139532','email','139532','fax',NULL),(13,'21century_2','3333','a@a.com','3333','888',NULL),(14,'newvendor','87654321','test@test.com','87654321','333333',NULL),(16,'new3','3333','b@b.com','address2','555',5),(17,'new4','646353','233@22.com','address4','24234243',6),(19,'new6','646353','233@22.com','address4','24234243',6),(20,'新的','23','2',NULL,'23',13),(21,'新的2','23','2','多','23',14);

/* Procedure structure for procedure `Init_Warehouse` */

/*!50003 DROP PROCEDURE IF EXISTS  `Init_Warehouse` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `Init_Warehouse`()
BEGIN
	TRUNCATE TABLE ClientContacts;
	TRUNCATE TABLE Clients;
	TRUNCATE TABLE Contacts;
	TRUNCATE TABLE Inventories;
	TRUNCATE TABLE Products;
	TRUNCATE TABLE StockInDetails;
	TRUNCATE TABLE StockIns;
	TRUNCATE TABLE StockOutDetails;
	TRUNCATE TABLE StockOuts;
	TRUNCATE TABLE Stores;
	TRUNCATE TABLE VendorContacts;
	TRUNCATE TABLE Vendors;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `Update_Inventory` */

/*!50003 DROP PROCEDURE IF EXISTS  `Update_Inventory` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `Update_Inventory`(out s int)
BEGIN
	select count(*) into s from Products;
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
