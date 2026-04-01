/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 8.0.30 : Database - bank
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `akad` */

DROP TABLE IF EXISTS `akad`;

CREATE TABLE `akad` (
  `id_akad` varchar(10) NOT NULL,
  `id_pengajuan` varchar(10) DEFAULT NULL,
  `id_direksi` varchar(10) DEFAULT NULL,
  `nomor_urut` int DEFAULT NULL,
  `kode_bank` varchar(20) DEFAULT NULL,
  `kode_akad` varchar(10) DEFAULT NULL,
  `tahun` int DEFAULT NULL,
  `no_akad` varchar(100) DEFAULT NULL,
  `tanggal_akad` date DEFAULT NULL,
  `jangka_waktu_bulan` int DEFAULT NULL,
  `harga_pokok` decimal(15,2) DEFAULT NULL,
  `uang_muka` decimal(15,2) DEFAULT NULL,
  `pembiayaan_bank` decimal(15,2) DEFAULT NULL,
  `margin` decimal(15,2) DEFAULT NULL,
  `harga_jual` decimal(15,2) DEFAULT NULL,
  `subsidi_pemko` decimal(15,2) DEFAULT NULL,
  `beban_nasabah` decimal(15,2) DEFAULT NULL,
  `piutang_murabahah` decimal(15,2) DEFAULT NULL,
  `angsuran_bulanan` decimal(15,2) DEFAULT NULL,
  `status_pembiayaan` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_akad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `akad` */

insert  into `akad`(`id_akad`,`id_pengajuan`,`id_direksi`,`nomor_urut`,`kode_bank`,`kode_akad`,`tahun`,`no_akad`,`tanggal_akad`,`jangka_waktu_bulan`,`harga_pokok`,`uang_muka`,`pembiayaan_bank`,`margin`,`harga_jual`,`subsidi_pemko`,`beban_nasabah`,`piutang_murabahah`,`angsuran_bulanan`,`status_pembiayaan`,`created_at`,`updated_at`) values 
('AKD001','PN001',NULL,1,'BPRS-JG','MRB',2026,'No. 0001/BPRS-JG/MRB/0126-0426/2026','2026-03-30',24,1000000.00,1750000.00,1000000.00,NULL,NULL,1750000.00,NULL,NULL,NULL,'draft','2026-03-30 14:46:19','2026-03-30 14:46:19');

/*Table structure for table `barang_permohonan` */

DROP TABLE IF EXISTS `barang_permohonan`;

CREATE TABLE `barang_permohonan` (
  `id_barang` varchar(10) NOT NULL,
  `id_pengajuan` varchar(10) NOT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `volume` int DEFAULT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `harga` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_barang`),
  KEY `id_pengajuan` (`id_pengajuan`),
  CONSTRAINT `barang_permohonan_ibfk_1` FOREIGN KEY (`id_pengajuan`) REFERENCES `pengajuan` (`id_pengajuan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `barang_permohonan` */

insert  into `barang_permohonan`(`id_barang`,`id_pengajuan`,`nama_barang`,`volume`,`satuan`,`harga`,`total`,`created_at`,`updated_at`) values 
('BP001','PN001','das',2,'1',1500000.00,3000000.00,'2026-03-26 15:26:00','2026-03-26 15:26:00'),
('BP002','PN001','tess',2,'4',12500000.00,25000000.00,'2026-03-26 15:26:00','2026-03-26 15:26:00');

/*Table structure for table `cache` */

DROP TABLE IF EXISTS `cache`;

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache` */

/*Table structure for table `cache_locks` */

DROP TABLE IF EXISTS `cache_locks`;

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache_locks` */

/*Table structure for table `detail_survei` */

DROP TABLE IF EXISTS `detail_survei`;

CREATE TABLE `detail_survei` (
  `id_detail_survei` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_survei` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jenis_dokumen` varchar(100) DEFAULT NULL,
  `opsi` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `keterangan` text,
  `file_path` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_detail_survei`),
  KEY `prioritas_survei_calon_nasabah_penilaian_id` (`id_survei`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `detail_survei` */

insert  into `detail_survei`(`id_detail_survei`,`id_survei`,`jenis_dokumen`,`opsi`,`keterangan`,`file_path`,`created_at`,`updated_at`) values 
('PSCNPD001','JDWSRV001','SLIK','Ada','kettt','uploads/survei/IElYFk3u0JzT8M6OHThMQRp7Pq01UdfMkmDKM2V5.pdf','2026-03-30 14:46:19','2026-03-30 14:46:19'),
('PSCNPD002','JDWSRV001','KTP','Ada','kettt','uploads/survei/Q2J9Kgc5So6zE3p1XMrzVxTTYLWsAEowWacbki5e.pdf','2026-03-30 14:46:19','2026-03-30 14:46:19'),
('PSCNPD003','JDWSRV001','Pas Photo','Ada','kettt','uploads/survei/mVYu1H7DhsjRaVLH7mS799wfaCUJc05zvrI9AgGq.pdf','2026-03-30 14:46:19','2026-03-30 14:46:19'),
('PSCNPD004','JDWSRV001','Kartu Keluarga','Ada','kettt','uploads/survei/RdbZSFh04x5sWEmEEFd6uqSdLHegJ5Kjaidlblxs.pdf','2026-03-30 14:46:19','2026-03-30 14:46:19'),
('PSCNPD005','JDWSRV001','RAB','Ada','kettt','uploads/survei/VXzNY6Fdv7AqQlz152P6MRbLhuuj7UGhH2x1Xr7r.pdf','2026-03-30 14:46:19','2026-03-30 14:46:19'),
('PSCNPD006','JDWSRV001','STNK','Ada','kettt','uploads/survei/4S1JqBtuyulCjHWc4joglmJ3aEaJhyfhrjOVm83W.pdf','2026-03-30 14:46:19','2026-03-30 14:46:19'),
('PSCNPD007','JDWSRV001','BPKB','Ada','kettt','uploads/survei/4nonaNfX5gQ7RvHSiHtYbk6bdQ1Iq8xnjf9ynBLx.pdf','2026-03-30 14:46:19','2026-03-30 14:46:19'),
('PSCNPD008','JDWSRV001','FOTO KB','Ada','kettt','uploads/survei/rNicSFXTgx0JLR9nG5AWZmrOhXZJM8HnxtWy9oNY.pdf','2026-03-30 14:46:19','2026-03-30 14:46:19'),
('PSCNPD009','JDWSRV001','Cek Fisik KB','Ada','kettt1','uploads/survei/BMLZUluVPpzPnBRVG3iAyyNFCkRQ8qUOaEeeq26Q.pdf','2026-03-30 14:46:19','2026-03-30 14:46:19'),
('PSCNPD010','JDWSRV001','Foto Hasil Survey','Ada','kettt2','uploads/survei/a5CS7XR6vaQpYBiILzaGnT5j1W2Q1XdEFsOAuvFm.pdf','2026-03-30 14:46:19','2026-03-30 14:46:19'),
('PSCNPD011','JDWSRV001','Lainnya (Agunan)','Ada','ketttr','uploads/survei/MHtjU82VsmoJDKCQvUUOrQE3DuOOUhLYLRnP5Plt.pdf','2026-03-30 14:46:19','2026-03-30 14:46:19'),
('PSCNPD012','JDWSRV001','Foto Rumah','Ada','kettt2','uploads/survei/ASQqBIjepgX2TdZOgkJoBAiPkac92Nx6DdycGyyi.pdf','2026-03-30 14:46:19','2026-03-30 14:46:19'),
('PSCNPD013','JDWSRV001','Foto Usaha','Ada','kettt5',NULL,'2026-03-30 14:46:19','2026-03-30 14:46:19'),
('PSCNPD014','JDWSRV001','Mapping Usaha','Ada','kettt1ss',NULL,'2026-03-30 14:46:19','2026-03-30 14:46:19'),
('PSCNPD015','JDWSRV001','Pengikatan','Ada','ketttcccc',NULL,'2026-03-30 14:46:19','2026-03-30 14:46:19'),
('PSCNPD016','JDWSRV001','Dokumen Lainnya','Ada',NULL,NULL,'2026-03-30 14:46:19','2026-03-30 14:46:19');

/*Table structure for table `dokumen` */

DROP TABLE IF EXISTS `dokumen`;

CREATE TABLE `dokumen` (
  `id_dokumen` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_pengajuan` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jenis_dokumen` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `file_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status_verifikasi` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_dokumen`),
  KEY `pengajuan_nasabah_id` (`id_pengajuan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `dokumen` */

insert  into `dokumen`(`id_dokumen`,`id_pengajuan`,`jenis_dokumen`,`file_path`,`status_verifikasi`,`created_at`,`updated_at`) values 
('PND001','PN001','file_ktp','uploads/pengajuan/c7KVBZWJrIcfJ1jxBJkD1YugLb771jDwntZjMMYb.pdf','verified','2026-03-16 14:33:23','2026-03-28 17:10:17'),
('PND002','PN001','file_kk','uploads/pengajuan/F1Q6sk4Vozrh2cv8PHogNEy9zuKrOQe5sd0Tqrgg.pdf','verified','2026-03-16 14:33:23','2026-03-28 17:10:23'),
('PND003','PN001','file_foto','uploads/pengajuan/GxAUqbgSPv2KTHZ281tD6Ee23QuBmT9x62AQKMzj.pdf','verified','2026-03-16 14:33:23','2026-03-28 17:10:32'),
('PND004','PN001','file_usaha','uploads/pengajuan/k5gW9zaofH0Yy38b5Rg5QA7sYVFhtsmTj0M8hL1W.pdf','verified','2026-03-16 14:33:23','2026-03-28 17:10:35'),
('PND005','PN001','file_jaminan','uploads/pengajuan/bnpUuc1DUd2C6TJmdxQS2PCQGeSTV3D2MLQWuGWA.pdf','verified','2026-03-16 14:33:23','2026-03-28 17:10:37');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `hasil_spk` */

DROP TABLE IF EXISTS `hasil_spk`;

CREATE TABLE `hasil_spk` (
  `id_hasil_spk` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_pengajuan` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nilai_preferensi` decimal(15,2) DEFAULT NULL,
  `status_terpilih` int DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_hasil_spk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `hasil_spk` */

insert  into `hasil_spk`(`id_hasil_spk`,`id_pengajuan`,`nilai_preferensi`,`status_terpilih`,`created_at`,`updated_at`) values 
('PSCN001','PN001',1.00,2,'2026-03-28 18:21:33','2026-03-30 14:46:19');

/*Table structure for table `jadwal_survei` */

DROP TABLE IF EXISTS `jadwal_survei`;

CREATE TABLE `jadwal_survei` (
  `id_survei` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_ao` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_pengajuan` varchar(10) DEFAULT NULL,
  `tanggal_survei` date DEFAULT NULL,
  `note` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_survei`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `jadwal_survei` */

insert  into `jadwal_survei`(`id_survei`,`id_ao`,`id_pengajuan`,`tanggal_survei`,`note`,`created_at`,`updated_at`) values 
('JDWSRV001','U003','PN001','2026-03-31','ini tesss','2026-03-29 11:34:55','2026-03-30 14:46:19');

/*Table structure for table `job_batches` */

DROP TABLE IF EXISTS `job_batches`;

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `job_batches` */

/*Table structure for table `jobs` */

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `jobs` */

/*Table structure for table `kriteria` */

DROP TABLE IF EXISTS `kriteria`;

CREATE TABLE `kriteria` (
  `id_kriteria` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `kode_kriteria` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `bobot` decimal(5,3) DEFAULT NULL,
  `jenis` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_kriteria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `kriteria` */

insert  into `kriteria`(`id_kriteria`,`nama`,`kode_kriteria`,`bobot`,`jenis`,`created_at`,`updated_at`) values 
('K001','Usia','C1',0.250,'benefit','2026-03-09 04:53:10','2026-03-14 06:22:27'),
('K002','Penghasilan Orangtua','C2',0.250,'cost','2026-03-09 04:55:52','2026-03-14 06:22:27'),
('K003','IPK','C3',0.250,'benefit','2026-03-09 04:56:23','2026-03-14 06:22:27'),
('K004','Yatim Piatu','C4',0.250,'benefit','2026-03-14 06:14:55','2026-03-14 06:22:27');

/*Table structure for table `kriteria_ahp` */

DROP TABLE IF EXISTS `kriteria_ahp`;

CREATE TABLE `kriteria_ahp` (
  `id` varchar(100) NOT NULL,
  `id_kriteria_1` varchar(100) DEFAULT NULL,
  `id_kriteria_2` varchar(100) DEFAULT NULL,
  `nilai_1` float DEFAULT NULL,
  `nilai_2` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `kriteria_ahp` */

insert  into `kriteria_ahp`(`id`,`id_kriteria_1`,`id_kriteria_2`,`nilai_1`,`nilai_2`,`created_at`,`updated_at`) values 
('KA001','K001','K002',1,1,'2026-03-14 06:22:54','2026-03-14 06:22:54'),
('KA002','K001','K003',1,1,'2026-03-14 06:22:54','2026-03-14 06:22:54'),
('KA003','K001','K004',1,1,'2026-03-14 06:22:54','2026-03-14 06:22:54'),
('KA004','K002','K003',1,1,'2026-03-14 06:22:54','2026-03-14 06:22:54'),
('KA005','K002','K004',1,1,'2026-03-14 06:22:54','2026-03-14 06:22:54'),
('KA006','K003','K004',1,1,'2026-03-14 06:22:54','2026-03-14 06:22:54');

/*Table structure for table `master_chatbots` */

DROP TABLE IF EXISTS `master_chatbots`;

CREATE TABLE `master_chatbots` (
  `id` varchar(100) NOT NULL,
  `pertanyaan` longtext,
  `jawaban` longtext,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `master_chatbots` */

insert  into `master_chatbots`(`id`,`pertanyaan`,`jawaban`,`created_at`,`updated_at`) values 
('MC001','saya riski','benar','2026-03-09 06:38:12','2026-03-09 06:38:12');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2026_02_08_090714_add_role_to_users_table',2),
(5,'2026_02_08_115727_create_user_chatbots_table',3),
(6,'2026_03_28_175414_create_status_pengajuan_log_table',4);

/*Table structure for table `nasabah_disetujui` */

DROP TABLE IF EXISTS `nasabah_disetujui`;

CREATE TABLE `nasabah_disetujui` (
  `id` varchar(100) NOT NULL,
  `id_pengajuan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nilai` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pengajuan_nasabah_id` (`id_pengajuan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `nasabah_disetujui` */

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `pengajuan` */

DROP TABLE IF EXISTS `pengajuan`;

CREATE TABLE `pengajuan` (
  `id_pengajuan` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_nasabah` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_periode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pekerjaan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jenis_usaha` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `alamat_usaha` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `penghasilan_usaha` decimal(15,2) DEFAULT NULL,
  `lama_usaha_tahun` int DEFAULT NULL,
  `tujuan_pembiayaan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jumlah_permohonan` decimal(15,2) DEFAULT NULL,
  `jangka_waktu_bulan` int DEFAULT NULL,
  `no_rek` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jumlah tanggungan` int DEFAULT NULL,
  `status_pengajuan` enum('on process','approved','revisi','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `agree` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pengajuan`),
  KEY `user_id` (`id_nasabah`),
  KEY `id_periode` (`id_periode`),
  CONSTRAINT `pengajuan_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id_periode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pengajuan` */

insert  into `pengajuan`(`id_pengajuan`,`id_nasabah`,`id_periode`,`pekerjaan`,`jenis_usaha`,`alamat_usaha`,`penghasilan_usaha`,`lama_usaha_tahun`,`tujuan_pembiayaan`,`jumlah_permohonan`,`jangka_waktu_bulan`,`no_rek`,`jumlah tanggungan`,`status_pengajuan`,`agree`,`created_at`,`updated_at`) values 
('PN001','U002','P001','programmer','dasda','das',1000000.00,1,'das',1000000.00,24,'3123213123',NULL,'approved',1,'2026-03-16 14:33:23','2026-03-28 18:00:35');

/*Table structure for table `pengajuan_nasabah_penilaian` */

DROP TABLE IF EXISTS `pengajuan_nasabah_penilaian`;

CREATE TABLE `pengajuan_nasabah_penilaian` (
  `id` varchar(100) NOT NULL,
  `pengajuan_nasabah_id` varchar(100) DEFAULT NULL,
  `kriteria_id` varchar(100) DEFAULT NULL,
  `sub_kriteria_id` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pengajuan_nasabah_id` (`pengajuan_nasabah_id`),
  KEY `kriteria_id` (`kriteria_id`),
  KEY `sub_kriteria_id` (`sub_kriteria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `pengajuan_nasabah_penilaian` */

insert  into `pengajuan_nasabah_penilaian`(`id`,`pengajuan_nasabah_id`,`kriteria_id`,`sub_kriteria_id`,`created_at`,`updated_at`) values 
('PNPN001','PN001','K001','SK001','2026-03-16 14:33:23','2026-03-16 14:33:23'),
('PNPN002','PN001','K002','SK006','2026-03-16 14:33:23','2026-03-16 14:33:23'),
('PNPN003','PN001','K003','SK011','2026-03-16 14:33:23','2026-03-16 14:33:23'),
('PNPN004','PN001','K004','SK016','2026-03-16 14:33:23','2026-03-16 14:33:23');

/*Table structure for table `penjamin` */

DROP TABLE IF EXISTS `penjamin`;

CREATE TABLE `penjamin` (
  `id_penjamin` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_pengajuan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `pekerjaan` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `no_ktp` varchar(100) DEFAULT NULL,
  `no_hp` varchar(100) DEFAULT NULL,
  `alamat` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_penjamin`),
  KEY `id_pengajuan` (`id_pengajuan`),
  CONSTRAINT `penjamin_ibfk_1` FOREIGN KEY (`id_pengajuan`) REFERENCES `pengajuan` (`id_pengajuan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `penjamin` */

insert  into `penjamin`(`id_penjamin`,`id_pengajuan`,`nama`,`pekerjaan`,`tempat_lahir`,`dob`,`no_ktp`,`no_hp`,`alamat`,`created_at`,`updated_at`) values 
('PNPS001','PN001','dasd','testtt','asdas','1998-06-17','12312321312','083232','dasdsa','2026-03-16 14:33:23','2026-03-16 14:33:23');

/*Table structure for table `periode` */

DROP TABLE IF EXISTS `periode`;

CREATE TABLE `periode` (
  `id_periode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_periode` varchar(50) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `status` enum('aktif','inactive') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_periode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `periode` */

insert  into `periode`(`id_periode`,`nama_periode`,`tanggal_mulai`,`tanggal_selesai`,`status`,`created_at`,`updated_at`) values 
('P001','periode 1','2026-01-01','2026-04-30','aktif','2026-03-16 20:51:51','2026-03-16 20:51:57');

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sessions` */

insert  into `sessions`(`id`,`user_id`,`ip_address`,`user_agent`,`payload`,`last_activity`) values 
('790aiK6uBiklmbDa5WMiEJ2GcToAEAUWX9xGcpF9','U003','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQUd1ZjFkSGZyc1oyNVlXNUtYOHZ3Zkp0V2pKZG9YQVV6b1RVenZSQiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyODoiaHR0cDovL2JhbmtfYnVraXR0aW5nZ2kudGVzdCI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjU4OiJodHRwOi8vYmFua19idWtpdHRpbmdnaS50ZXN0L25hc2FiYWgtZGlzZXR1anVpL3ByaW50L1BOMDAxIjtzOjU6InJvdXRlIjtzOjI4OiJuYXNhYmFoX2Rpc2V0dWp1aS5wcmludF9ha2FkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO3M6NDoiVTAwMyI7fQ==',1774883951),
('fAq4lUBdtJQMA7thHsZZGzk9ULLps13VVkx4vpwF',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTzlUYXRrdVdJUjNuWFd4NjRnOW1oc1Z0SWRlUmdLenZhZTd6U2dMZCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyODoiaHR0cDovL2JhbmtfYnVraXR0aW5nZ2kudGVzdCI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjI4OiJodHRwOi8vYmFua19idWtpdHRpbmdnaS50ZXN0IjtzOjU6InJvdXRlIjtzOjU6ImluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1774881571),
('j4BxmPGNpofyGxCRM9SKyFsV2Xvz5XxrJkZWjSia','U003','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUURBNExJSzRTYVVzbmpYOXp1SUxZdURNVmIzd2ZhQUxNU1NJek1FTyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NToiaHR0cDovL2JhbmtfYnVraXR0aW5nZ2kudGVzdC9wcmlvcml0YXMtc3VydmVpIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTg6Imh0dHA6Ly9iYW5rX2J1a2l0dGluZ2dpLnRlc3QvbmFzYWJhaC1kaXNldHVqdWkvcHJpbnQvUE4wMDEiO3M6NToicm91dGUiO3M6Mjg6Im5hc2FiYWhfZGlzZXR1anVpLnByaW50X2FrYWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7czo0OiJVMDAzIjt9',1774807283);

/*Table structure for table `slik_bi_checking` */

DROP TABLE IF EXISTS `slik_bi_checking`;

CREATE TABLE `slik_bi_checking` (
  `id_slik` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pengajuan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_cek` date NOT NULL,
  `status_slik` enum('lancar','kurang_lancar','diragukan','macet','tidak_ada') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tidak_ada',
  `keterangan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` decimal(15,2) DEFAULT '0.00',
  `total` decimal(15,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_slik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `slik_bi_checking` */

insert  into `slik_bi_checking`(`id_slik`,`id_pengajuan`,`tanggal_cek`,`status_slik`,`keterangan`,`harga`,`total`,`created_at`,`updated_at`) values 
('SLK001','PN001','2026-03-28','lancar','tes',1000000.00,1000000.00,'2026-03-28 18:00:22','2026-03-28 18:00:22');

/*Table structure for table `status_pengajuan_log` */

DROP TABLE IF EXISTS `status_pengajuan_log`;

CREATE TABLE `status_pengajuan_log` (
  `id_status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pengajuan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_status` datetime NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `status_pengajuan_log` */

insert  into `status_pengajuan_log`(`id_status`,`id_pengajuan`,`status`,`tanggal_status`,`keterangan`,`created_at`,`updated_at`) values 
('SPL001','PN001','approved','2026-03-28 18:00:35','tess','2026-03-28 18:00:35','2026-03-28 18:00:35'),
('SPL002','PN001','surveyed','2026-03-30 14:46:19','Survei lapangan telah dilakukan oleh admin_ao. Catatan: ini tesss','2026-03-30 14:46:19','2026-03-30 14:46:19');

/*Table structure for table `sub_kriteria` */

DROP TABLE IF EXISTS `sub_kriteria`;

CREATE TABLE `sub_kriteria` (
  `id_subkriteria` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_kriteria` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `deskripsi` varchar(100) DEFAULT NULL,
  `nilai` decimal(10,0) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_subkriteria`),
  KEY `sub_kriteria_ibfk_1` (`id_kriteria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `sub_kriteria` */

insert  into `sub_kriteria`(`id_subkriteria`,`id_kriteria`,`deskripsi`,`nilai`,`created_at`,`updated_at`) values 
('SK001','K001','18 Tahun',1,'2026-03-09 06:09:29','2026-03-09 06:09:29'),
('SK002','K001','19 Tahun',2,'2026-03-09 06:09:43','2026-03-09 06:09:43'),
('SK003','K001','20 Tahun',3,'2026-03-09 06:09:49','2026-03-09 06:09:49'),
('SK004','K001','21 Tahun',4,'2026-03-09 06:09:54','2026-03-09 06:09:54'),
('SK005','K001','22 Tahun',5,'2026-03-09 06:10:00','2026-03-09 06:10:00'),
('SK006','K002','< 1 Jt',5,'2026-03-09 06:10:15','2026-03-09 06:10:15'),
('SK007','K002','1 - 2 Jt',4,'2026-03-09 06:10:22','2026-03-09 06:10:22'),
('SK008','K002','2 - 3 juta',3,'2026-03-09 06:10:50','2026-03-09 06:10:50'),
('SK009','K002','3 - 4',2,'2026-03-09 06:12:22','2026-03-09 06:12:22'),
('SK010','K002','> 4 juta',1,'2026-03-09 06:12:36','2026-03-09 06:12:36'),
('SK011','K003','< 1',1,'2026-03-09 06:13:04','2026-03-09 06:13:04'),
('SK012','K003','1 - 2',2,'2026-03-09 06:13:15','2026-03-09 06:13:15'),
('SK013','K003','2 - 2.5',3,'2026-03-09 06:13:36','2026-03-09 06:13:36'),
('SK014','K003','2.5 - 3.5',4,'2026-03-09 06:13:59','2026-03-09 06:13:59'),
('SK015','K003','> 3.5',5,'2026-03-09 06:36:05','2026-03-09 06:36:05'),
('SK016','K004','Ya',5,'2026-03-09 06:36:22','2026-03-09 06:36:22'),
('SK017','K004','Tidak',1,'2026-03-09 06:36:30','2026-03-09 06:36:30');

/*Table structure for table `user_chatbots` */

DROP TABLE IF EXISTS `user_chatbots`;

CREATE TABLE `user_chatbots` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pertanyaan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jawaban` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_chatbots_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `user_chatbots` */

insert  into `user_chatbots`(`id`,`user_id`,`pertanyaan`,`jawaban`,`created_at`,`updated_at`) values 
('UC001','U001','saya riski','benar','2026-03-09 06:38:21','2026-03-09 06:38:21');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id_user` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `tempat_lahir` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `no_ktp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `status_aktif` tinyint(1) DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id_user`,`name`,`email`,`password`,`role`,`tempat_lahir`,`tanggal_lahir`,`no_ktp`,`no_hp`,`alamat`,`status_aktif`,`email_verified_at`,`remember_token`,`created_at`,`updated_at`) values 
('U001','tests','tes@gmail.com','$2y$12$miSXm.fNLkP7nsyXCTqYwOhyYixSjLbAr9poUPUre3NktVzjSQ1LK','admin',NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,'2026-02-08 09:22:44','2026-03-14 06:29:21'),
('U002','Rezqy Ondrizal','rezqy@deptechdigital.com','$2y$12$dxer9Xn0gxCbNc2LyqJAR.0xxWPmWVKdVnWJmjFUPG6vlCB7kHME.','nasabah','padang','2026-03-03','312312312312312312','0812321321132','dsa',1,NULL,NULL,'2026-03-14 06:30:45','2026-03-16 14:32:14'),
('U003','admin_ao','admin_ao@gmail.com','$2y$12$OHwTedMnbg5K0tNOtpoxru5/OVA24uDygMA4DFe2XvXhYRF3QfEiq','ao',NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,'2026-03-26 15:46:59','2026-03-26 15:46:59');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
