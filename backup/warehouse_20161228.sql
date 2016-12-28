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

insert  into `Clients`(`Id`,`Name`,`Phone`,`Fax`,`Email`,`Address`,`ContactId`) values (1,'客户1','456789','8888','a@a.com','456789',8),(2,'永大','66661','88881','a@a.com1','66661',NULL),(3,'Moto','null','3453','c@c.com','null',NULL),(4,'Chicago-Telcom','3332','345322','c@c.com','3332',NULL),(5,'newclient2','3332','3453','c@c.com','address',8),(6,'newclient3','3222','666','a@a.com','add',NULL),(7,'newclient4','3222','666','a@a.com','add',9),(8,'test2','3333','444','a@a.com','address',10),(9,'阿斯顿发斯蒂芬','asdf','dsfadsf','asdf','asdf',11),(10,'大萨达','gggggg','萨达','as','gggggg',12);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `Inventories` */

insert  into `Inventories`(`Id`,`StoreId`,`ProductId`,`Quantity`,`MaxPrice`,`MinPrice`,`MinOutPrice`,`MaxOutPrice`,`Index`,`LastUpdate`,`UserId`) values (1,1,1,'-4.00','14.00','0.99','0.90','14.00',13,'2016-12-10 08:41:25',4),(2,2,3,'2.00','2.50','1.25','20.00','20.00',4,'2016-12-10 10:31:41',4),(3,2,6,'1.00','1.25','1.25','1.25','1.25',5,'2016-12-10 09:08:14',4),(4,2,8,'1.00','1.25','1.25',NULL,NULL,1,'2016-12-04 12:19:43',NULL),(5,1,3,'-1.00','1.25','1.25','1.25','1.25',5,'2016-12-10 10:26:04',4),(6,1,2,'0.00','33.25','33.25',NULL,NULL,2,'2016-12-10 08:42:49',4),(7,3,2,'0.00','33.25','33.25','33.25','33.25',2,'2016-12-10 10:35:07',4);

/*Table structure for table `Messages` */

DROP TABLE IF EXISTS `Messages`;

CREATE TABLE `Messages` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ToUserId` int(11) DEFAULT NULL,
  `Title` varchar(500) DEFAULT NULL,
  `Message` varchar(2000) DEFAULT NULL,
  `Link` varchar(300) DEFAULT NULL,
  `Type` varchar(20) DEFAULT NULL,
  `Version` int(11) DEFAULT NULL,
  `GetDate` datetime DEFAULT NULL,
  `HasRead` int(11) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `Messages` */

insert  into `Messages`(`Id`,`ToUserId`,`Title`,`Message`,`Link`,`Type`,`Version`,`GetDate`,`HasRead`,`CreateDate`) values (2,0,'Update apk',NULL,'http://localhost:8000/warehouse/uploads/1480927465.apk','Install',2,NULL,NULL,NULL),(4,1,'Upload new file','http://localhost/warehouse/uploads/1480939424.png','http://localhost/warehouse/uploads/1480939424.png','Message',NULL,'2016-12-05 12:06:21',1,'2016-12-05 12:03:44'),(5,1,'Upload new file','http://192.168.31.234/warehouse/uploads/1481339559.jpg','http://192.168.31.234/warehouse/uploads/1481339559.jpg','Message',NULL,NULL,0,'2016-12-10 03:12:39');

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `Products` */

insert  into `Products`(`Id`,`Name`,`Specification`,`Unit`,`Width`,`Height`,`Length`,`Brand`,`Barcode`,`Price`) values (1,'钢管','塑钢管','10根','2','3','1','方正','','14.00'),(2,'三角','铜质','1','10','20','50','HiSense','335698','33.25'),(3,'灯泡','hisense','12','102','202','502','HiSense','335698','1.25'),(4,'被子','hisense','1','10','20','50','HiSense','335698','1.25'),(5,'电饼铛','hisense','1','10','20','50','HiSense','335698','1.25'),(6,'茶壶','specification','3','3','4','2','haier','22222','1.25'),(7,'5号钢管','spe','un','4','5','2','223e','sdf','1.25'),(8,'8号钢管','null','2','2','2','1','no','afsdfasdf','1.25'),(9,'电视','ggg','uuu','300','0','1','FDTD','d','0.00'),(10,'新产品','g','u','20','30','10','b','bar','10.00'),(11,'垃圾桶auto','8*8','a','0','0','0','','','0.00'),(12,'耳机','无线','只','0','0','45','一定发','','0.00'),(13,'椅子','自动转移','个','0','0','0','明星','','456.00'),(14,'杯子','规格','只','2','1','1','null','null','10.00');

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
  `ChangedId` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

/*Data for the table `StockInDetails` */

insert  into `StockInDetails`(`Id`,`StockInId`,`ProductId`,`Specification`,`Quantity`,`Price`,`Memo`,`StoreId`,`InventoryId`,`UpdateDate`,`UpdateSequ`,`BeforeUpdate`,`AfterUpdate`,`ChangedId`) values (1,1,1,'塑钢管','1.00','1.00','',1,1,'2016-12-04 03:31:59',1,'0.00','1.00',13),(2,2,1,'塑钢管','1.00','0.99','',1,1,'2016-12-04 03:32:48',2,'1.00','2.00',NULL),(3,3,1,'塑钢管','1.00','2.00','',1,1,'2016-12-04 03:33:11',3,'2.00','3.00',NULL),(4,4,3,'hisense','1.00','1.25','',2,2,'2016-12-04 04:53:32',1,'0.00','1.00',NULL),(5,5,6,'specification','1.00','1.25','',2,3,'2016-12-04 12:19:43',1,'0.00','1.00',NULL),(6,5,3,'hisense','1.00','1.25','',2,2,'2016-12-04 12:19:43',3,'0.00','1.00',NULL),(7,5,8,'null','1.00','1.25','',2,4,'2016-12-04 12:19:43',1,'0.00','1.00',NULL),(8,6,3,'hisense','1.00','1.25','',1,5,'2016-12-10 03:08:20',1,'0.00','1.00',18),(9,6,1,'塑钢管','1.00','14.00','',1,1,'2016-12-10 03:08:20',7,'-1.00','0.00',NULL),(10,7,1,'塑钢管','-1.00','1.00','',1,1,'2016-12-10 08:08:36',9,'-1.00','-2.00',12),(11,7,1,'塑钢管','-1.00','1.00','',1,1,'2016-12-10 08:24:18',10,'-2.00','-3.00',NULL),(12,7,1,'塑钢管','-1.00','1.00','',1,1,'2016-12-10 08:31:48',11,'-3.00','-4.00',7),(13,1,1,'塑钢管','-1.00','1.00','',1,1,'2016-12-10 08:37:22',12,'-4.00','-5.00',1),(14,8,1,'塑钢管','1.00','14.00','',1,1,'2016-12-10 08:41:25',13,'-5.00','-4.00',NULL),(15,8,2,'铜质','1.00','33.25','',1,6,'2016-12-10 08:41:26',1,'0.00','1.00',17),(16,8,3,'hisense','1.00','1.25','',1,5,'2016-12-10 08:41:26',4,'-1.00','0.00',NULL),(17,8,2,'铜质','-1.00','33.25','',1,6,'2016-12-10 08:42:50',2,'1.00','0.00',15),(18,6,3,'hisense','-1.00','1.25','',1,5,'2016-12-10 10:26:04',5,'0.00','-1.00',8),(19,6,2,'铜质','1.00','33.25','',3,7,'2016-12-10 10:31:09',1,'0.00','1.00',NULL),(20,6,3,'hisense2','1.00','2.50','',2,2,'2016-12-10 10:31:41',4,'1.00','2.00',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `StockIns` */

insert  into `StockIns`(`Id`,`InvoiceNo`,`EnteredDate`,`VendorId`,`TotalPrice`,`TotalNo`,`UserId`,`Memo`,`StoreId`) values (1,'001','2016-12-04',1,'-1.00','-1.00',4,'',1),(2,'002','2016-12-04',7,'0.99','1.00',4,'',1),(3,'002','2016-12-04',7,'2.00','1.00',4,'',1),(4,'002','2016-12-04',1,'1.25','1.00',4,'',0),(5,'009','2016-12-04',1,'3.75','3.00',NULL,'',2),(6,'009','2016-12-10',1,'49.75','3.00',4,'',1),(7,'001','2016-12-04',11,'-1.00','-1.00',4,'5555',9),(8,'1001','2016-12-10',2,'-18.00','1.00',4,'',1);

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
  `ChangedId` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `StockOutDetails` */

insert  into `StockOutDetails`(`Id`,`StockOutId`,`StoreId`,`ProductId`,`Quantity`,`Price`,`Memo`,`InventoryId`,`UpdateDate`,`UpdateSequ`,`BeforeUpdate`,`AfterUpdate`,`ChangedId`) values (1,1,1,1,'1.00','1.00','',1,'2016-12-04 03:34:03',4,'3.00','2.00',NULL),(2,2,1,1,'1.00','0.90','',1,'2016-12-04 03:41:05',5,'2.00','1.00',NULL),(3,3,1,1,'2.00','14.00','',1,'2016-12-04 03:41:38',6,'1.00','-1.00',NULL),(4,4,2,3,'1.00','20.00','',2,'2016-12-04 04:54:01',2,'1.00','0.00',NULL),(5,5,2,6,'1.00','1.25','',3,'2016-12-10 03:08:55',2,'1.00','0.00',10),(6,5,1,3,'1.00','1.25','',5,'2016-12-10 03:08:56',2,'1.00','0.00',NULL),(7,6,2,6,'1.00','1.25','',3,'2016-12-10 03:08:57',3,'0.00','-1.00',11),(8,6,1,3,'1.00','1.25','',5,'2016-12-10 03:08:58',3,'0.00','-1.00',NULL),(9,7,1,1,'1.00','14.00','',1,'2016-12-10 03:17:10',8,'0.00','-1.00',NULL),(10,5,2,6,'-1.00','1.25','',3,'2016-12-10 09:05:58',4,'-1.00','0.00',5),(11,6,2,6,'-1.00','1.25','',3,'2016-12-10 09:08:14',5,'0.00','1.00',7),(12,5,3,2,'1.00','33.25','',7,'2016-12-10 10:35:07',2,'1.00','0.00',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `StockOuts` */

insert  into `StockOuts`(`Id`,`InvoiceNo`,`EnteredDate`,`ClientId`,`TotalPrice`,`TotalNo`,`UserId`,`Memo`) values (1,'001','2016-12-04',1,'1.00','1.00',4,''),(2,'001','2016-12-04',1,'0.90','1.00',4,''),(3,'001','2016-12-04',1,'28.00','2.00',4,''),(4,'002','2016-12-04',2,'20.00','1.00',4,''),(5,'0091','2016-12-10',1,'34.50','2.00',4,'kkkkk '),(6,'009','2016-12-10',3,'1.25','1.00',4,'kkkkk '),(7,'8888','2016-12-10',4,'14.00','1.00',4,'');

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

insert  into `Stores`(`Id`,`Name`,`Address`,`Phone`,`Fax`,`Manager`) values (1,'虎山路店','333332','333332','88882',3),(2,'第一仓库','3','3','88883',3),(3,'第二仓库','33333','33333','8888',1),(7,'test4','332','332','3332',1),(9,'zhognxin','33','33','22',10),(10,'zhongxin2','aa','aa','33',2);

/*Table structure for table `Uploads` */

DROP TABLE IF EXISTS `Uploads`;

CREATE TABLE `Uploads` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) DEFAULT NULL,
  `FileName` varchar(200) DEFAULT NULL,
  `FileType` varchar(200) DEFAULT NULL,
  `FilePath` varchar(200) DEFAULT NULL,
  `FullPath` varchar(200) DEFAULT NULL,
  `RawName` varchar(200) DEFAULT NULL,
  `FileExt` varchar(20) DEFAULT NULL,
  `FileSize` decimal(10,2) DEFAULT NULL,
  `IsImage` tinyint(1) DEFAULT NULL,
  `ImageWidth` decimal(10,2) DEFAULT NULL,
  `ImageHeight` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

/*Data for the table `Uploads` */

insert  into `Uploads`(`Id`,`UserId`,`FileName`,`FileType`,`FilePath`,`FullPath`,`RawName`,`FileExt`,`FileSize`,`IsImage`,`ImageWidth`,`ImageHeight`) values (8,1,'1480917874.jpg','image/jpeg','/var/www/html/uploads/','/var/www/html/uploads/1480917874.jpg','1480917874','.jpg','71.71',1,'270.00','360.00'),(9,1,'1480924058.jpg','image/jpeg','D:/xampp563/htdocs/warehouse/uploads/','D:/xampp563/htdocs/warehouse/uploads/1480924058.jpg','1480924058','.jpg','39.37',1,'950.00','633.00'),(10,1,'1480924239.jpg','image/jpeg','D:/xampp563/htdocs/warehouse/uploads/','D:/xampp563/htdocs/warehouse/uploads/1480924239.jpg','1480924239','.jpg','271.15',1,'768.00','1152.00'),(11,1,'1480924263.jpg','image/jpeg','D:/xampp563/htdocs/warehouse/uploads/','D:/xampp563/htdocs/warehouse/uploads/1480924263.jpg','1480924263','.jpg','71.52',1,'533.00','796.00'),(12,1,'1480924574.jpg','image/jpeg','/var/www/html/uploads/','/var/www/html/uploads/1480924574.jpg','1480924574','.jpg','66.32',1,'533.00','796.00'),(13,1,'1480926322.apk','application/octet-stream','D:/xampp563/htdocs/warehouse/uploads/','D:/xampp563/htdocs/warehouse/uploads/1480926322.apk','1480926322','.apk','2083.72',0,NULL,NULL),(14,1,'1480927184.apk','application/octet-stream','D:/xampp563/htdocs/warehouse/uploads/','D:/xampp563/htdocs/warehouse/uploads/1480927184.apk','1480927184','.apk','2083.72',0,NULL,NULL),(15,1,'1480927294.apk','application/octet-stream','D:/xampp563/htdocs/warehouse/uploads/','D:/xampp563/htdocs/warehouse/uploads/1480927294.apk','1480927294','.apk','2083.72',0,NULL,NULL),(16,1,'1480927354.apk','application/octet-stream','D:/xampp563/htdocs/warehouse/uploads/','D:/xampp563/htdocs/warehouse/uploads/1480927354.apk','1480927354','.apk','2083.72',0,NULL,NULL),(17,1,'1480927454.jpg','image/jpeg','D:/xampp563/htdocs/warehouse/uploads/','D:/xampp563/htdocs/warehouse/uploads/1480927454.jpg','1480927454','.jpg','71.71',1,'270.00','360.00'),(18,1,'1480927465.apk','application/octet-stream','D:/xampp563/htdocs/warehouse/uploads/','D:/xampp563/htdocs/warehouse/uploads/1480927465.apk','1480927465','.apk','2083.72',0,NULL,NULL),(19,1,'1480937068.jpg','image/jpeg','/var/www/html/uploads/','/var/www/html/uploads/1480937068.jpg','1480937068','.jpg','73.78',1,'640.00','640.00'),(20,1,'1480938664.jpg','image/jpeg','/Applications/XAMPP/xamppfiles/htdocs/warehouse/uploads/','/Applications/XAMPP/xamppfiles/htdocs/warehouse/uploads/1480938664.jpg','1480938664','.jpg','20.95',1,'283.00','364.00'),(21,1,'1480938849.jpg','image/jpeg','/Applications/XAMPP/xamppfiles/htdocs/warehouse/uploads/','/Applications/XAMPP/xamppfiles/htdocs/warehouse/uploads/1480938849.jpg','1480938849','.jpg','267.68',1,'1775.00','2400.00'),(22,1,'1480939232.JPG','image/jpeg','/Applications/XAMPP/xamppfiles/htdocs/warehouse/uploads/','/Applications/XAMPP/xamppfiles/htdocs/warehouse/uploads/1480939232.JPG','1480939232','.JPG','2441.70',1,'4000.00','2664.00'),(23,1,'1480939300.jpg','image/jpeg','/Applications/XAMPP/xamppfiles/htdocs/warehouse/uploads/','/Applications/XAMPP/xamppfiles/htdocs/warehouse/uploads/1480939300.jpg','1480939300','.jpg','26.57',1,'287.00','460.00'),(24,1,'1480939424.png','image/png','/Applications/XAMPP/xamppfiles/htdocs/warehouse/uploads/','/Applications/XAMPP/xamppfiles/htdocs/warehouse/uploads/1480939424.png','1480939424','.png','292.44',1,'915.00','893.00'),(25,1,'1481339559.jpg','image/jpeg','/Applications/XAMPP/xamppfiles/htdocs/warehouse/uploads/','/Applications/XAMPP/xamppfiles/htdocs/warehouse/uploads/1481339559.jpg','1481339559','.jpg','138.66',1,'800.00','800.00');

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

insert  into `Vendors`(`Id`,`Name`,`Phone`,`Email`,`Address`,`Fax`,`ContactId`) values (1,'国信','12345678AAAA','test@test.comAAAA','12345678AAAA','33333AAAA',NULL),(2,'Haire','1234567812','test@test.com12','address12','fax12',NULL),(7,'Hisensez','12345678','','12345678','null',NULL),(10,'test1','12345678','','12345678','null',NULL),(11,'vendor2','139532','email','139532','fax',NULL),(13,'21century_2','3333','a@a.com','3333','888',NULL),(14,'newvendor','87654321','test@test.com','87654321','333333',NULL),(16,'new3','3333','b@b.com','address2','555',5),(17,'new4','646353','233@22.com','address4','24234243',6),(19,'new6','646353','233@22.com','address4','24234243',6),(20,'新的','23','2',NULL,'23',13),(21,'新的2','23','2','多','23',14);

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
	TRUNCATE TABLE Uploads;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `Init_Warehouse_Only_Stocks` */

/*!50003 DROP PROCEDURE IF EXISTS  `Init_Warehouse_Only_Stocks` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `Init_Warehouse_Only_Stocks`()
BEGIN
	TRUNCATE TABLE Inventories;
	TRUNCATE TABLE StockInDetails;
	TRUNCATE TABLE StockIns;
	TRUNCATE TABLE StockOutDetails;
	TRUNCATE TABLE StockOuts;	
	TRUNCATE TABLE Messages;
	TRUNCATE TABLE Uploads;
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
