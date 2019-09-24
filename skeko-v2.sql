-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 29, 2019 at 08:40 AM
-- Server version: 5.7.21
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skeko`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(1024) NOT NULL,
  `title` varchar(512) NOT NULL,
  `body` text NOT NULL,
  `view` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `thumbnail_base_url` varchar(1024) DEFAULT NULL,
  `thumbnail_path` varchar(1024) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `published_at` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_article_author` (`created_by`),
  KEY `fk_article_updater` (`updated_by`),
  KEY `fk_article_category` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `article_attachment`
--

DROP TABLE IF EXISTS `article_attachment`;
CREATE TABLE IF NOT EXISTS `article_attachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `base_url` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_article_attachment_article` (`article_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `article_category`
--

DROP TABLE IF EXISTS `article_category`;
CREATE TABLE IF NOT EXISTS `article_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(1024) NOT NULL,
  `title` varchar(512) NOT NULL,
  `body` text,
  `parent_id` int(11) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_article_category_section` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `article_category`
--

INSERT INTO `article_category` (`id`, `slug`, `title`, `body`, `parent_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'news', 'News', NULL, NULL, 1, 1548746624, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `file_storage_item`
--

DROP TABLE IF EXISTS `file_storage_item`;
CREATE TABLE IF NOT EXISTS `file_storage_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `component` varchar(255) NOT NULL,
  `base_url` varchar(1024) NOT NULL,
  `path` varchar(1024) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `upload_ip` varchar(15) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `i18n_message`
--

DROP TABLE IF EXISTS `i18n_message`;
CREATE TABLE IF NOT EXISTS `i18n_message` (
  `id` int(11) NOT NULL,
  `language` varchar(16) NOT NULL,
  `translation` text,
  PRIMARY KEY (`id`,`language`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `i18n_source_message`
--

DROP TABLE IF EXISTS `i18n_source_message`;
CREATE TABLE IF NOT EXISTS `i18n_source_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(32) DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `key_storage_item`
--

DROP TABLE IF EXISTS `key_storage_item`;
CREATE TABLE IF NOT EXISTS `key_storage_item` (
  `key` varchar(128) NOT NULL,
  `value` text NOT NULL,
  `comment` text,
  `updated_at` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`key`),
  UNIQUE KEY `idx_key_storage_item_key` (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `key_storage_item`
--

INSERT INTO `key_storage_item` (`key`, `value`, `comment`, `updated_at`, `created_at`) VALUES
('backend.theme-skin', 'skin-purple', 'skin-blue, skin-black, skin-purple, skin-green, skin-red, skin-yellow', 1548748369, NULL),
('backend.layout-fixed', '0', NULL, 1548748333, NULL),
('backend.layout-boxed', '0', NULL, 1548748326, NULL),
('backend.layout-collapsed-sidebar', '0', NULL, 1548748342, NULL),
('frontend.maintenance', 'disabled', 'Set it to \"enabled\" to turn on maintenance mode', NULL, NULL),
('backend.sidebar-mini', '0', NULL, 1548748347, 1548748278);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(2048) NOT NULL,
  `title` varchar(512) NOT NULL,
  `body` text NOT NULL,
  `view` varchar(255) DEFAULT NULL,
  `status` smallint(6) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `slug`, `title`, `body`, `view`, `status`, `created_at`, `updated_at`) VALUES
(1, 'about', 'About', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', NULL, 1, 1548746623, 1548746623);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `bcode` varchar(50) NOT NULL,
  `price` varchar(20) NOT NULL,
  `function` text NOT NULL,
  `notes` text NOT NULL,
  `product_status_id` int(11) NOT NULL,
  `ware_house_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `fk_ware_house-region_id-id` (`ware_house_id`),
  KEY `product_status_id` (`product_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_history`
--

DROP TABLE IF EXISTS `product_history`;
CREATE TABLE IF NOT EXISTS `product_history` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `ware_house_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `fk_ware_house-region_id-id` (`ware_house_id`),
  KEY `product_status_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_status`
--

DROP TABLE IF EXISTS `product_status`;
CREATE TABLE IF NOT EXISTS `product_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `state` varchar(16) NOT NULL,
  `sort` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `color` varchar(6) NOT NULL,
  `parent_id` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rbac_auth_assignment`
--

DROP TABLE IF EXISTS `rbac_auth_assignment`;
CREATE TABLE IF NOT EXISTS `rbac_auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rbac_auth_assignment`
--

INSERT INTO `rbac_auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('administrator', '1', 1548747469),
('manager', '2', 1548747469),
('user', '3', 1548747469);

-- --------------------------------------------------------

--
-- Table structure for table `rbac_auth_item`
--

DROP TABLE IF EXISTS `rbac_auth_item`;
CREATE TABLE IF NOT EXISTS `rbac_auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rbac_auth_item`
--

INSERT INTO `rbac_auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('administrator', 1, NULL, NULL, NULL, 1548747469, 1548747469),
('editOwnModel', 2, NULL, 'ownModelRule', NULL, 1548747469, 1548747469),
('loginToBackend', 2, NULL, NULL, NULL, 1548747469, 1548747469),
('manager', 1, NULL, NULL, NULL, 1548747469, 1548747469),
('user', 1, NULL, NULL, NULL, 1548747469, 1548747469);

-- --------------------------------------------------------

--
-- Table structure for table `rbac_auth_item_child`
--

DROP TABLE IF EXISTS `rbac_auth_item_child`;
CREATE TABLE IF NOT EXISTS `rbac_auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rbac_auth_item_child`
--

INSERT INTO `rbac_auth_item_child` (`parent`, `child`) VALUES
('user', 'editOwnModel'),
('administrator', 'loginToBackend'),
('manager', 'loginToBackend'),
('administrator', 'manager'),
('administrator', 'user'),
('manager', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `rbac_auth_rule`
--

DROP TABLE IF EXISTS `rbac_auth_rule`;
CREATE TABLE IF NOT EXISTS `rbac_auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rbac_auth_rule`
--

INSERT INTO `rbac_auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
('ownModelRule', 0x4f3a32393a22636f6d6d6f6e5c726261635c72756c655c4f776e4d6f64656c52756c65223a333a7b733a343a226e616d65223b733a31323a226f776e4d6f64656c52756c65223b733a393a22637265617465644174223b693a313534383734373436393b733a393a22757064617465644174223b693a313534383734373436393b7d, 1548747469, 1548747469);

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

DROP TABLE IF EXISTS `regions`;
CREATE TABLE IF NOT EXISTS `regions` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `longitude` double(15,8) NOT NULL,
  `latitude` double(15,8) NOT NULL,
  `color` varchar(10) NOT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `system_db_migration`
--

DROP TABLE IF EXISTS `system_db_migration`;
CREATE TABLE IF NOT EXISTS `system_db_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system_db_migration`
--

INSERT INTO `system_db_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1548746613),
('m140703_123000_user', 1548746618),
('m140703_123055_log', 1548746619),
('m140703_123104_page', 1548746619),
('m140703_123803_article', 1548746619),
('m140703_123813_rbac', 1548746620),
('m140709_173306_widget_menu', 1548746620),
('m140709_173333_widget_text', 1548746620),
('m140712_123329_widget_carousel', 1548746621),
('m140805_084745_key_storage_item', 1548746621),
('m141012_101932_i18n_tables', 1548746621),
('m150318_213934_file_storage_item', 1548746621),
('m150414_195800_timeline_event', 1548746621),
('m150725_192740_seed_data', 1548746624),
('m150929_074021_article_attachment_order', 1548746624),
('m160203_095604_user_token', 1548746624);

-- --------------------------------------------------------

--
-- Table structure for table `system_log`
--

DROP TABLE IF EXISTS `system_log`;
CREATE TABLE IF NOT EXISTS `system_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `level` int(11) DEFAULT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `log_time` double DEFAULT NULL,
  `prefix` text COLLATE utf8_unicode_ci,
  `message` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `idx_log_level` (`level`),
  KEY `idx_log_category` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `system_log`
--

INSERT INTO `system_log` (`id`, `level`, `category`, `log_time`, `prefix`, `message`) VALUES
(1, 1, 'yii\\base\\ErrorException:8', 1548747182.3187, '[frontend][/skeko/frontend/web/user/sign-in/signup]', 'yii\\base\\ErrorException: Trying to get property of non-object in D:\\wamp64\\www\\skeko\\vendor\\yiisoft\\yii2\\rbac\\DbManager.php:849\nStack trace:\n#0 D:\\wamp64\\www\\skeko\\frontend\\modules\\user\\models\\SignupForm.php(90): common\\models\\User->afterSignup()\n#1 D:\\wamp64\\www\\skeko\\frontend\\modules\\user\\controllers\\SignInController.php(148): frontend\\modules\\user\\models\\SignupForm->signup()\n#2 D:\\wamp64\\www\\skeko\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): frontend\\modules\\user\\controllers\\SignInController->actionSignup()\n#3 D:\\wamp64\\www\\skeko\\vendor\\yiisoft\\yii2\\base\\InlineAction.php(57): ::call_user_func_array:{D:\\wamp64\\www\\skeko\\vendor\\yiisoft\\yii2\\base\\InlineAction.php:57}()\n#4 D:\\wamp64\\www\\skeko\\vendor\\yiisoft\\yii2\\base\\Controller.php(157): yii\\base\\InlineAction->runWithParams()\n#5 D:\\wamp64\\www\\skeko\\vendor\\yiisoft\\yii2\\base\\Module.php(528): frontend\\modules\\user\\controllers\\SignInController->runAction()\n#6 D:\\wamp64\\www\\skeko\\vendor\\yiisoft\\yii2\\web\\Application.php(103): yii\\web\\Application->runAction()\n#7 D:\\wamp64\\www\\skeko\\vendor\\yiisoft\\yii2\\base\\Application.php(386): yii\\web\\Application->handleRequest()\n#8 D:\\wamp64\\www\\skeko\\frontend\\web\\index.php(22): yii\\web\\Application->run()\n#9 {main}');

-- --------------------------------------------------------

--
-- Table structure for table `system_rbac_migration`
--

DROP TABLE IF EXISTS `system_rbac_migration`;
CREATE TABLE IF NOT EXISTS `system_rbac_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system_rbac_migration`
--

INSERT INTO `system_rbac_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1548747467),
('m150625_214101_roles', 1548747469),
('m150625_215624_init_permissions', 1548747469),
('m151223_074604_edit_own_model', 1548747469),
('m190129_073730_init_roles', 1548747469);

-- --------------------------------------------------------

--
-- Table structure for table `timeline_event`
--

DROP TABLE IF EXISTS `timeline_event`;
CREATE TABLE IF NOT EXISTS `timeline_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `application` varchar(64) NOT NULL,
  `category` varchar(64) NOT NULL,
  `event` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_created_at` (`created_at`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `timeline_event`
--

INSERT INTO `timeline_event` (`id`, `application`, `category`, `event`, `data`, `created_at`) VALUES
(1, 'frontend', 'user', 'signup', '{\"public_identity\":\"webmaster\",\"user_id\":1,\"created_at\":1548746621}', 1548746621),
(2, 'frontend', 'user', 'signup', '{\"public_identity\":\"manager\",\"user_id\":2,\"created_at\":1548746621}', 1548746621),
(3, 'frontend', 'user', 'signup', '{\"public_identity\":\"user\",\"user_id\":3,\"created_at\":1548746621}', 1548746621),
(4, 'frontend', 'user', 'signup', '{\"public_identity\":\"umar\",\"user_id\":4,\"created_at\":1548747182}', 1548747182);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) DEFAULT NULL,
  `auth_key` varchar(32) NOT NULL,
  `access_token` varchar(40) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `oauth_client` varchar(255) DEFAULT NULL,
  `oauth_client_user_id` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '2',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `logged_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `access_token`, `password_hash`, `oauth_client`, `oauth_client_user_id`, `email`, `status`, `created_at`, `updated_at`, `logged_at`) VALUES
(1, 'webmaster', 'WERm4m67Ea7C1bETjMZb0ZXgmjC09RTn', 'iA3Tikmefu6D3U_x7EkKaIW-CCIzuHuP75ad8X-s', '$2y$13$cOhLhTf9QdJuP4WQRRVuT.CP0vIZQLJG86NN/6Gnd2x0Aj4HOIrqi', NULL, NULL, 'webmaster@example.com', 2, 1548746622, 1548746622, 1548747307),
(2, 'manager', 'vkV7VF9Fuv6DjDB4RwL4SCWfzZ-pd4J6', 'tHxCdMGFu_GQzKzeXpte62vu-RyUnxmxtPToMNOd', '$2y$13$81IMKKjI209hAobFpeSCheFuaEt3JUdNIxnVoabEvLBXDSU50hODq', NULL, NULL, 'manager@example.com', 2, 1548746623, 1548746623, NULL),
(3, 'user', 'w9zXmzuW03Psua5Uou1-ywzHiASptmDz', 'XJcyNWdGw3dD0jAFgL8aUB-XWWFLgGTB2zwXLfSq', '$2y$13$8zXTeTmv026IJ2bQnR28UuN9RHClRxOZO0Tlf8Q5D8sugpgJro6K.', NULL, NULL, 'user@example.com', 2, 1548746623, 1548746623, NULL),
(4, 'umar', '6bzB_bTXxT5n9lmqNU1VOZ4O18Baaip0', '9rcGVPYVEdRJs8TufWSRwMigfKQz0PENf_MhUY0W', '$2y$13$1gzbasR1IDF5Uu0WLaJeDu87Xwj9cOsGTx8IvUEn1LSQNtqAqIwwi', NULL, NULL, 'umarzaman2010@gmail.com', 2, 1548747182, 1548747182, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

DROP TABLE IF EXISTS `user_profile`;
CREATE TABLE IF NOT EXISTS `user_profile` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `avatar_path` varchar(255) DEFAULT NULL,
  `avatar_base_url` varchar(255) DEFAULT NULL,
  `locale` varchar(32) NOT NULL,
  `gender` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`user_id`, `firstname`, `middlename`, `lastname`, `avatar_path`, `avatar_base_url`, `locale`, `gender`) VALUES
(1, 'John', NULL, 'Doe', NULL, NULL, 'en-US', NULL),
(2, NULL, NULL, NULL, NULL, NULL, 'en-US', NULL),
(3, NULL, NULL, NULL, NULL, NULL, 'en-US', NULL),
(4, NULL, NULL, NULL, NULL, NULL, 'en-US', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

DROP TABLE IF EXISTS `user_token`;
CREATE TABLE IF NOT EXISTS `user_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `token` varchar(40) NOT NULL,
  `expire_at` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ware_house`
--

DROP TABLE IF EXISTS `ware_house`;
CREATE TABLE IF NOT EXISTS `ware_house` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `region_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `short_code` varchar(20) NOT NULL,
  `address` varchar(150) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `fk_ware_house-region_id-id` (`region_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `widget_carousel`
--

DROP TABLE IF EXISTS `widget_carousel`;
CREATE TABLE IF NOT EXISTS `widget_carousel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `status` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `widget_carousel`
--

INSERT INTO `widget_carousel` (`id`, `key`, `status`) VALUES
(1, 'index', 1);

-- --------------------------------------------------------

--
-- Table structure for table `widget_carousel_item`
--

DROP TABLE IF EXISTS `widget_carousel_item`;
CREATE TABLE IF NOT EXISTS `widget_carousel_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `carousel_id` int(11) NOT NULL,
  `base_url` varchar(1024) DEFAULT NULL,
  `path` varchar(1024) DEFAULT NULL,
  `asset_url` varchar(1024) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `url` varchar(1024) DEFAULT NULL,
  `caption` varchar(1024) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `order` int(11) DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_item_carousel` (`carousel_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `widget_carousel_item`
--

INSERT INTO `widget_carousel_item` (`id`, `carousel_id`, `base_url`, `path`, `asset_url`, `type`, `url`, `caption`, `status`, `order`, `created_at`, `updated_at`) VALUES
(1, 1, 'http://localhost/skeko/frontend/web', 'img/yii2-starter-kit.gif', 'http://localhost/skeko/frontend/web/img/yii2-starter-kit.gif', 'image/gif', '/', NULL, 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `widget_menu`
--

DROP TABLE IF EXISTS `widget_menu`;
CREATE TABLE IF NOT EXISTS `widget_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(32) NOT NULL,
  `title` varchar(255) NOT NULL,
  `items` text NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `widget_menu`
--

INSERT INTO `widget_menu` (`id`, `key`, `title`, `items`, `status`) VALUES
(1, 'frontend-index', 'Frontend index menu', '[\n    {\n        \"label\": \"Get started with Yii2\",\n        \"url\": \"http://www.yiiframework.com\",\n        \"options\": {\n            \"tag\": \"span\"\n        },\n        \"template\": \"<a href=\\\"{url}\\\" class=\\\"btn btn-lg btn-success\\\">{label}</a>\"\n    },\n    {\n        \"label\": \"Yii2 Starter Kit on GitHub\",\n        \"url\": \"https://github.com/yii2-starter-kit/yii2-starter-kit\",\n        \"options\": {\n            \"tag\": \"span\"\n        },\n        \"template\": \"<a href=\\\"{url}\\\" class=\\\"btn btn-lg btn-primary\\\">{label}</a>\"\n    },\n    {\n        \"label\": \"Find a bug?\",\n        \"url\": \"https://github.com/yii2-starter-kit/yii2-starter-kit/issues\",\n        \"options\": {\n            \"tag\": \"span\"\n        },\n        \"template\": \"<a href=\\\"{url}\\\" class=\\\"btn btn-lg btn-danger\\\">{label}</a>\"\n    }\n]', 1);

-- --------------------------------------------------------

--
-- Table structure for table `widget_text`
--

DROP TABLE IF EXISTS `widget_text`;
CREATE TABLE IF NOT EXISTS `widget_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `status` smallint(6) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_widget_text_key` (`key`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `widget_text`
--

INSERT INTO `widget_text` (`id`, `key`, `title`, `body`, `status`, `created_at`, `updated_at`) VALUES
(1, 'backend_welcome', 'Welcome to backend', '<p>Welcome to Yii2 Starter Kit Dashboard</p>', 1, 1548746624, 1548746624),
(2, 'ads-example', 'Google Ads Example Block', '<div class=\"lead\">\n                <script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>\n                <ins class=\"adsbygoogle\"\n                     style=\"display:block\"\n                     data-ad-client=\"ca-pub-9505937224921657\"\n                     data-ad-slot=\"2264361777\"\n                     data-ad-format=\"auto\"></ins>\n                <script>\n                (adsbygoogle = window.adsbygoogle || []).push({});\n                </script>\n            </div>', 0, 1548746624, 1548746624);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products-created_by-id` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_products-product_status_id-id` FOREIGN KEY (`product_status_id`) REFERENCES `product_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_products-updated_by-id` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_products-ware_house_id-id` FOREIGN KEY (`ware_house_id`) REFERENCES `ware_house` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_history`
--
ALTER TABLE `product_history`
  ADD CONSTRAINT `fk_product_history-created_by-id` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_history-product_id-id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_history-updated_by-id` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_history-ware_house_id-id` FOREIGN KEY (`ware_house_id`) REFERENCES `ware_house` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rbac_auth_assignment`
--
ALTER TABLE `rbac_auth_assignment`
  ADD CONSTRAINT `rbac_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `rbac_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rbac_auth_item`
--
ALTER TABLE `rbac_auth_item`
  ADD CONSTRAINT `rbac_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `rbac_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `rbac_auth_item_child`
--
ALTER TABLE `rbac_auth_item_child`
  ADD CONSTRAINT `rbac_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `rbac_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rbac_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `rbac_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ware_house`
--
ALTER TABLE `ware_house`
  ADD CONSTRAINT `fk_ware_house-created_by-id` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ware_house-region_id-id` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ware_house-updated_by-id` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
