-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 11, 2026 at 07:01 AM
-- Server version: 9.1.0
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `interview_haryana`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('superadmin','editor') DEFAULT 'editor',
  `is_active` tinyint(1) DEFAULT '1',
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `role`, `is_active`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@interviewharyana.com', '$2y$10$dk5/HCfRXR/NPzeNZctpfeylSZ6V40Ko94Ixj4YmXLkcNbRRDQcxm', 'superadmin', 1, '2026-03-10 15:09:51', '2026-03-10 11:50:03', '2026-03-10 20:39:51'),
(2, 'Abhimanu', 'abhimanu@admin.com', '$2y$10$dk5/HCfRXR/NPzeNZctpfeylSZ6V40Ko94Ixj4YmXLkcNbRRDQcxm', 'editor', 1, NULL, '2026-03-11 12:30:30', '2026-03-11 12:30:30');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
CREATE TABLE IF NOT EXISTS `banners` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `subtitle` varchar(300) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `link_url` varchar(500) DEFAULT NULL,
  `position` enum('homepage_slider','sidebar','footer') DEFAULT 'homepage_slider',
  `sort_order` tinyint DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `subtitle`, `image`, `link_url`, `position`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'HRERA', 'Haryana real estate', '29fe9e38e1123b3ade04f98486321917.jpg', 'https://haryanarera.gov.in/', 'homepage_slider', 0, 1, '2026-03-10 10:15:40', '2026-03-10 10:15:40');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(120) NOT NULL,
  `color` varchar(20) DEFAULT '#e63946',
  `sort_order` tinyint DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `color`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'हरियाणा', 'haryana', '#e63946', 1, 1, '2026-03-10 11:50:03', '2026-03-10 11:50:03'),
(2, 'राजनीति', 'politics', '#457b9d', 2, 1, '2026-03-10 11:50:03', '2026-03-10 11:50:03'),
(7, 'शिक्षा', 'education', '#264653', 7, 1, '2026-03-10 11:50:03', '2026-03-10 11:50:03'),
(10, 'केंद्रीय ', 'category-1773141465', '#37e6ac', 3, 1, '2026-03-10 11:17:45', '2026-03-10 11:17:58');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int UNSIGNED NOT NULL,
  `admin_id` int UNSIGNED NOT NULL,
  `title` varchar(300) NOT NULL,
  `slug` varchar(320) NOT NULL,
  `summary` text,
  `body` longtext NOT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT '0',
  `is_breaking` tinyint(1) DEFAULT '0',
  `status` enum('draft','published','archived') DEFAULT 'draft',
  `views` int UNSIGNED DEFAULT '0',
  `published_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `admin_id` (`admin_id`),
  KEY `idx_status` (`status`),
  KEY `idx_featured` (`is_featured`),
  KEY `idx_breaking` (`is_breaking`),
  KEY `idx_category` (`category_id`),
  KEY `idx_published` (`published_at`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `category_id`, `admin_id`, `title`, `slug`, `summary`, `body`, `banner_image`, `is_featured`, `is_breaking`, `status`, `views`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'USA Attacks IRAN', 'usa-attacks-iran', 'USA attaked Irana nd israil joins.', '<h2>USA attaked Irana nd israil joins.</h2>\r\n\r\nTrump gone mad\r\n\r\n <ul>\r\n<li> hello </li>\r\n<li> destroy </li>\r\n </ul>', 'eaabe9f393f24854a9026530c6764754.jpg', 0, 0, 'draft', 1, '2026-03-10 08:55:58', '2026-03-10 08:55:38', '2026-03-10 08:56:52');

-- --------------------------------------------------------

--
-- Table structure for table `news_tags`
--

DROP TABLE IF EXISTS `news_tags`;
CREATE TABLE IF NOT EXISTS `news_tags` (
  `news_id` int UNSIGNED NOT NULL,
  `tag_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`news_id`,`tag_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(100) NOT NULL,
  `value` text,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `updated_at`) VALUES
(1, 'site_name', 'Interview Haryana', '2026-03-10 15:56:28'),
(2, 'site_tagline', 'हर बात आपके साथ', '2026-03-10 15:56:28'),
(3, 'site_email', 'contact@interviewnharyana.com', '2026-03-10 15:56:28'),
(4, 'site_phone', '+91 00000 00000', '2026-03-10 11:50:04'),
(5, 'facebook_url', '', '2026-03-10 11:50:04'),
(6, 'twitter_url', '', '2026-03-10 11:50:04'),
(7, 'youtube_url', '', '2026-03-10 11:50:04'),
(8, 'instagram_url', '', '2026-03-10 11:50:04'),
(9, 'breaking_news_text', 'Breaking: Interview Haryana में आपका स्वागत है!', '2026-03-10 15:56:28'),
(10, 'footer_about', 'Interview Haryana हरियाणा की ताज़ा खबरों का विश्वसनीय स्रोत है।', '2026-03-10 15:56:28'),
(11, 'site_logo', 'logo.png', '2026-03-10 21:05:50');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `news_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `news_tags`
--
ALTER TABLE `news_tags`
  ADD CONSTRAINT `news_tags_ibfk_1` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `news_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
