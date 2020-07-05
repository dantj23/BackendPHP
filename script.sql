/*
SQLyog Community
MySQL - 5.7.24 : Database - backendphp
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`backendphp` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci */;

/*Table structure for table `bck_user_tbl` */

DROP TABLE IF EXISTS `bck_user_tbl`;

CREATE TABLE `bck_user_tbl` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(25) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `password` varchar(25) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `bck_user_tbl` */

insert  into `bck_user_tbl`(`idUser`,`user`,`password`) values 
(1,'admin','123');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
