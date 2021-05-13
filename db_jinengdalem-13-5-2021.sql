/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.14-MariaDB : Database - db_jinengdalem
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `tb_agama` */

DROP TABLE IF EXISTS `tb_agama`;

CREATE TABLE `tb_agama` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agama` varchar(190) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_agama` */

insert  into `tb_agama`(`id`,`agama`,`created_at`,`updated_at`) values (1,'Hindu','2021-05-13 12:36:43','2021-05-13 12:36:43');
insert  into `tb_agama`(`id`,`agama`,`created_at`,`updated_at`) values (2,'Islam','2021-05-13 12:39:32','2021-05-13 12:39:32');
insert  into `tb_agama`(`id`,`agama`,`created_at`,`updated_at`) values (4,'Budha','2021-05-13 12:40:06','2021-05-13 12:40:06');

/*Table structure for table `tb_desa` */

DROP TABLE IF EXISTS `tb_desa`;

CREATE TABLE `tb_desa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_desa` varchar(190) DEFAULT NULL,
  `batas_desa` text DEFAULT NULL,
  `marker_desa` text DEFAULT NULL,
  `warna_batas_desa` varchar(190) DEFAULT NULL,
  `zoom` tinyint(4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_desa` */

/*Table structure for table `tb_jenis_potensi` */

DROP TABLE IF EXISTS `tb_jenis_potensi`;

CREATE TABLE `tb_jenis_potensi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_potensi` varchar(190) DEFAULT NULL,
  `tablelink` varchar(190) DEFAULT NULL,
  `icon` varchar(190) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_jenis_potensi` */

/*Table structure for table `tb_sekolah` */

DROP TABLE IF EXISTS `tb_sekolah`;

CREATE TABLE `tb_sekolah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `potensi_id` int(11) DEFAULT NULL,
  `jenis` enum('swasta','negeri') DEFAULT NULL,
  `tingkat` enum('Paud','SD','SMP','SMA','Universitas') DEFAULT NULL,
  `nama_sekolah` varchar(190) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `lat` varchar(190) DEFAULT NULL,
  `lng` varchar(190) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_sekolah` */

/*Table structure for table `tb_sumber_air` */

DROP TABLE IF EXISTS `tb_sumber_air`;

CREATE TABLE `tb_sumber_air` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `potensi_id` int(11) DEFAULT NULL,
  `nama_sumber` varchar(190) DEFAULT NULL,
  `lat` varchar(190) DEFAULT NULL,
  `lng` varchar(190) DEFAULT NULL,
  `debit` double DEFAULT NULL,
  `pengelola` varchar(190) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_sumber_air` */

/*Table structure for table `tb_tempat_ibadah` */

DROP TABLE IF EXISTS `tb_tempat_ibadah`;

CREATE TABLE `tb_tempat_ibadah` (
  `id` int(11) DEFAULT NULL,
  `potensi_id` int(11) DEFAULT NULL,
  `agama_id` int(11) DEFAULT NULL,
  `nama_tempat_ibadah` varchar(190) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `lat` varchar(190) DEFAULT NULL,
  `lng` varchar(190) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_tempat_ibadah` */

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(190) DEFAULT NULL,
  `password` varchar(190) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_user` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
