/*
 Navicat Premium Dump SQL

 Source Server         : mysql
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : db_sakura_hidroponik

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 08/11/2025 06:49:17
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admins_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES (1, 'Administrator', 'admin@example.com', '$2y$12$jUBy7fokNEOU858wmlaTyeLmZybIvXbwhceml557sxyC2jV7d2KfO', '2EGZwYGXMUPJY9ifGQNEjbLeBYmXWmzSKnkKyj1PM6xwDZcgyJRwrSZH0UE8', '2025-10-24 05:59:35', '2025-10-24 05:59:35');

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache
-- ----------------------------

-- ----------------------------
-- Table structure for cache_locks
-- ----------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache_locks
-- ----------------------------

-- ----------------------------
-- Table structure for detail_pesanans
-- ----------------------------
DROP TABLE IF EXISTS `detail_pesanans`;
CREATE TABLE `detail_pesanans`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pesanan_id` bigint UNSIGNED NOT NULL,
  `produk_id` bigint UNSIGNED NULL DEFAULT NULL,
  `nama_produk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `harga_produk` int NOT NULL,
  `jumlah_kg` int NOT NULL,
  `harga` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `detail_pesanans_pesanan_id_foreign`(`pesanan_id` ASC) USING BTREE,
  INDEX `detail_pesanans_produk_id_foreign`(`produk_id` ASC) USING BTREE,
  CONSTRAINT `detail_pesanans_pesanan_id_foreign` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanans` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `detail_pesanans_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_pesanans
-- ----------------------------
INSERT INTO `detail_pesanans` VALUES (1, 1, 1, 'Selada', 20000, 1, 20000, '2025-10-24 06:01:02', '2025-10-24 06:01:02');
INSERT INTO `detail_pesanans` VALUES (2, 2, 1, 'Selada', 20000, 2, 40000, '2025-10-24 06:03:46', '2025-10-24 06:03:46');
INSERT INTO `detail_pesanans` VALUES (3, 3, 1, 'Selada', 20000, 1, 20000, '2025-10-24 06:08:52', '2025-10-24 06:08:52');
INSERT INTO `detail_pesanans` VALUES (4, 4, 1, 'Selada', 20000, 3, 60000, '2025-10-31 02:00:51', '2025-10-31 02:00:51');
INSERT INTO `detail_pesanans` VALUES (5, 5, 1, 'Selada', 20000, 3, 60000, '2025-10-31 02:13:00', '2025-10-31 02:13:00');
INSERT INTO `detail_pesanans` VALUES (6, 6, 1, 'Selada', 20000, 1, 20000, '2025-10-31 02:16:28', '2025-10-31 02:16:28');
INSERT INTO `detail_pesanans` VALUES (7, 7, 1, 'Selada', 20000, 2, 40000, '2025-11-07 09:58:36', '2025-11-07 09:58:36');
INSERT INTO `detail_pesanans` VALUES (11, 10, NULL, 'selada roma', 12000, 1, 12000, '2025-11-07 12:47:51', '2025-11-07 12:47:51');
INSERT INTO `detail_pesanans` VALUES (12, 10, 3, 'kangkung', 23000, 1, 23000, '2025-11-07 12:47:51', '2025-11-07 12:47:51');
INSERT INTO `detail_pesanans` VALUES (13, 10, 2, 'bayam', 12000, 1, 12000, '2025-11-07 12:47:51', '2025-11-07 12:47:51');
INSERT INTO `detail_pesanans` VALUES (14, 10, 1, 'Selada', 20000, 1, 20000, '2025-11-07 12:47:51', '2025-11-07 12:47:51');
INSERT INTO `detail_pesanans` VALUES (15, 11, 3, 'kangkung', 23000, 1, 23000, '2025-11-07 12:52:10', '2025-11-07 12:52:10');
INSERT INTO `detail_pesanans` VALUES (16, 11, 2, 'bayam', 12000, 1, 12000, '2025-11-07 12:52:10', '2025-11-07 12:52:10');
INSERT INTO `detail_pesanans` VALUES (17, 11, 1, 'Selada', 20000, 1, 20000, '2025-11-07 12:52:10', '2025-11-07 12:52:10');
INSERT INTO `detail_pesanans` VALUES (18, 12, 3, 'kangkung', 23000, 5, 115000, '2025-11-07 13:30:40', '2025-11-07 13:30:40');
INSERT INTO `detail_pesanans` VALUES (19, 12, 2, 'bayam', 12000, 6, 72000, '2025-11-07 13:30:40', '2025-11-07 13:30:40');
INSERT INTO `detail_pesanans` VALUES (20, 12, 1, 'Selada', 20000, 3, 60000, '2025-11-07 13:30:40', '2025-11-07 13:30:40');
INSERT INTO `detail_pesanans` VALUES (21, 13, 3, 'kangkung', 23000, 2, 46000, '2025-11-07 20:34:46', '2025-11-07 20:34:46');
INSERT INTO `detail_pesanans` VALUES (22, 14, 2, 'bayam', 12000, 3, 36000, '2025-11-07 20:39:33', '2025-11-07 20:39:33');
INSERT INTO `detail_pesanans` VALUES (23, 15, 3, 'kangkung', 23000, 1, 23000, '2025-11-07 20:41:24', '2025-11-07 20:41:24');
INSERT INTO `detail_pesanans` VALUES (24, 16, 2, 'bayam', 12000, 1, 12000, '2025-11-07 20:46:49', '2025-11-07 20:46:49');
INSERT INTO `detail_pesanans` VALUES (25, 16, 3, 'kangkung', 23000, 2, 46000, '2025-11-07 20:46:49', '2025-11-07 20:46:49');
INSERT INTO `detail_pesanans` VALUES (26, 17, 1, 'Selada', 20000, 3, 60000, '2025-11-07 23:29:01', '2025-11-07 23:29:01');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for job_batches
-- ----------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `cancelled_at` int NULL DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of job_batches
-- ----------------------------

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED NULL DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jobs_queue_index`(`queue` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 53 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (43, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (44, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` VALUES (45, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` VALUES (46, '2025_09_01_060903_create_produks_table', 1);
INSERT INTO `migrations` VALUES (47, '2025_09_01_060927_create_stoks_table', 1);
INSERT INTO `migrations` VALUES (48, '2025_09_01_060935_create_pesanans_table', 1);
INSERT INTO `migrations` VALUES (49, '2025_09_01_060950_create_detail_pesanans_table', 1);
INSERT INTO `migrations` VALUES (50, '2025_09_03_022355_create_sessions_table', 1);
INSERT INTO `migrations` VALUES (51, '2025_09_26_030524_create_profils_table', 1);
INSERT INTO `migrations` VALUES (52, '2025_10_22_053753_create_admins_table', 1);

-- ----------------------------
-- Table structure for pesanans
-- ----------------------------
DROP TABLE IF EXISTS `pesanans`;
CREATE TABLE `pesanans`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_pelanggan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_pesanan` date NOT NULL,
  `jenis_pengambilan` enum('diantar','ambil di kebun','ambil di rumah') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'diantar',
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `no_whatsapp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `total_harga` int NOT NULL,
  `status_pesanan` enum('diproses','selesai','dibatalkan') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'diproses',
  `alasan_dibatalkan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pesanans
-- ----------------------------
INSERT INTO `pesanans` VALUES (1, 'della', '2025-10-24', 'ambil di kebun', '-', '082231300513', 20000, 'selesai', NULL, '2025-10-24 06:01:02', '2025-10-24 06:03:13');
INSERT INTO `pesanans` VALUES (2, 'della', '2025-10-24', 'diantar', 'kromasan', '082231300513', 40000, 'selesai', NULL, '2025-10-24 06:03:46', '2025-11-07 09:52:47');
INSERT INTO `pesanans` VALUES (3, 'salsa', '2025-10-24', 'ambil di kebun', '-', '082231300513', 20000, 'dibatalkan', 'Salah Pesan', '2025-10-24 06:08:52', '2025-10-31 01:59:59');
INSERT INTO `pesanans` VALUES (4, 'sabrina', '2025-10-31', 'diantar', 'kromasan', '082231300513', 60000, 'selesai', NULL, '2025-10-31 02:00:51', '2025-10-31 02:02:00');
INSERT INTO `pesanans` VALUES (5, 'llaa', '2025-10-31', 'diantar', 'kromasan', '082231300513', 60000, 'selesai', NULL, '2025-10-31 02:12:59', '2025-10-31 02:13:36');
INSERT INTO `pesanans` VALUES (6, 'bu nurul', '2025-10-31', 'diantar', 'wlingi', '081553037562', 20000, 'selesai', NULL, '2025-10-31 02:16:28', '2025-10-31 02:23:56');
INSERT INTO `pesanans` VALUES (7, 'suharti', '2025-11-07', 'diantar', 'kromasan', '085232678978', 40000, 'selesai', NULL, '2025-11-07 09:58:36', '2025-11-07 11:16:58');
INSERT INTO `pesanans` VALUES (10, 'della', '2025-11-07', 'diantar', '2', '081231600235', 67000, 'dibatalkan', 'Alamat Tidak Jelas', '2025-11-07 12:47:51', '2025-11-07 21:15:30');
INSERT INTO `pesanans` VALUES (11, 'della', '2025-11-07', 'diantar', '7', '081231600235', 55000, 'diproses', NULL, '2025-11-07 12:52:10', '2025-11-07 12:52:10');
INSERT INTO `pesanans` VALUES (12, 'della', '2025-11-07', 'diantar', '-', '081231600235', 247000, 'selesai', NULL, '2025-11-07 13:30:39', '2025-11-07 20:35:32');
INSERT INTO `pesanans` VALUES (13, 'della', '2025-11-07', 'diantar', 'RT/RW, Dusun, Desa, Kelurahan, Kecamatan, Nama Jalan', '081231600235', 46000, 'diproses', NULL, '2025-11-07 20:34:46', '2025-11-07 20:34:46');
INSERT INTO `pesanans` VALUES (14, 'della', '2025-11-07', 'ambil di kebun', '-', '081231600235', 36000, 'diproses', NULL, '2025-11-07 20:39:33', '2025-11-07 20:39:33');
INSERT INTO `pesanans` VALUES (15, 'della', '2025-11-07', 'diantar', 'RT/RW, Dusun, Desa, Kelurahan, Kecamatan, Nama Jalan', '081231600235', 23000, 'diproses', NULL, '2025-11-07 20:41:24', '2025-11-07 20:41:24');
INSERT INTO `pesanans` VALUES (16, 'suharti', '2025-11-08', 'diantar', 'RT/RW, Dusun, Desa, Kelurahan, Kecamatan, Nama Jalan', '085232678978', 58000, 'selesai', NULL, '2025-11-07 20:46:49', '2025-11-07 20:47:09');
INSERT INTO `pesanans` VALUES (17, 'dimas', '2025-11-07', 'ambil di kebun', '-', '082231300513', 60000, 'diproses', NULL, '2025-11-07 23:29:01', '2025-11-07 23:29:01');

-- ----------------------------
-- Table structure for produks
-- ----------------------------
DROP TABLE IF EXISTS `produks`;
CREATE TABLE `produks`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `foto_produk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `deskripsi_produk` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `harga_kg` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of produks
-- ----------------------------
INSERT INTO `produks` VALUES (1, 'Selada', 'produk/HPt057tyDvEYODs3uOFFoqakkAhU3PMIqpjfacrs.png', 'Selada keriting', 20000, '2025-10-24 06:00:38', '2025-10-24 06:00:38');
INSERT INTO `produks` VALUES (2, 'bayam', 'produk/LVWEmyAJ6NrGVdZImjTjLTe5dYiMQs98V996SWTf.png', '-', 12000, '2025-10-31 02:20:36', '2025-11-07 11:19:34');
INSERT INTO `produks` VALUES (3, 'kangkung', 'produk/mzfDAnm34IzGtb4XTFuNblXEHiydGZU8Wpfoa5FF.png', 'ini adalah produk kangkung hidroponik', 23000, '2025-11-07 10:46:41', '2025-11-07 10:46:41');

-- ----------------------------
-- Table structure for profils
-- ----------------------------
DROP TABLE IF EXISTS `profils`;
CREATE TABLE `profils`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of profils
-- ----------------------------

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sessions_user_id_index`(`user_id` ASC) USING BTREE,
  INDEX `sessions_last_activity_index`(`last_activity` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sessions
-- ----------------------------

-- ----------------------------
-- Table structure for stoks
-- ----------------------------
DROP TABLE IF EXISTS `stoks`;
CREATE TABLE `stoks`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `produk_id` bigint UNSIGNED NOT NULL,
  `stok_kg` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `stoks_produk_id_foreign`(`produk_id` ASC) USING BTREE,
  CONSTRAINT `stoks_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of stoks
-- ----------------------------
INSERT INTO `stoks` VALUES (1, 1, 0, 0, '2025-10-24 06:00:38', '2025-11-07 23:29:01');
INSERT INTO `stoks` VALUES (2, 2, 69, 1, '2025-10-31 02:20:36', '2025-11-07 21:15:30');
INSERT INTO `stoks` VALUES (3, 3, 7, 1, '2025-11-07 10:46:41', '2025-11-07 21:15:30');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `role` enum('admin','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'admin',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
