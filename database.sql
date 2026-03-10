-- =============================================
-- Interview haryana — Database Schema
-- CodeIgniter 3 | MySQL / MariaDB (WAMP)
-- =============================================

CREATE DATABASE IF NOT EXISTS `interview_haryana`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `interview_haryana`;

-- ----------------------------
-- Categories
-- ----------------------------
CREATE TABLE `categories` (
  `id`         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name`       VARCHAR(100) NOT NULL,
  `slug`       VARCHAR(120) NOT NULL UNIQUE,
  `color`      VARCHAR(20)  DEFAULT '#e63946',
  `sort_order` TINYINT      DEFAULT 0,
  `is_active`  TINYINT(1)   DEFAULT 1,
  `created_at` DATETIME     DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME     DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Tags
-- ----------------------------
CREATE TABLE `tags` (
  `id`         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name`       VARCHAR(80)  NOT NULL,
  `slug`       VARCHAR(100) NOT NULL UNIQUE,
  `created_at` DATETIME     DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Admins
-- ----------------------------
CREATE TABLE `admins` (
  `id`         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name`       VARCHAR(100) NOT NULL,
  `email`      VARCHAR(150) NOT NULL UNIQUE,
  `password`   VARCHAR(255) NOT NULL,
  `role`       ENUM('superadmin','editor') DEFAULT 'editor',
  `is_active`  TINYINT(1)   DEFAULT 1,
  `last_login` DATETIME     NULL,
  `created_at` DATETIME     DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME     DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- News / Articles
-- ----------------------------
CREATE TABLE `news` (
  `id`            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `category_id`   INT UNSIGNED NOT NULL,
  `admin_id`      INT UNSIGNED NOT NULL,
  `title`         VARCHAR(300) NOT NULL,
  `slug`          VARCHAR(320) NOT NULL UNIQUE,
  `summary`       TEXT         NULL,
  `body`          LONGTEXT     NOT NULL,
  `banner_image`  VARCHAR(255) NULL,
  `is_featured`   TINYINT(1)   DEFAULT 0,
  `is_breaking`   TINYINT(1)   DEFAULT 0,
  `status`        ENUM('draft','published','archived') DEFAULT 'draft',
  `views`         INT UNSIGNED DEFAULT 0,
  `published_at`  DATETIME     NULL,
  `created_at`    DATETIME     DEFAULT CURRENT_TIMESTAMP,
  `updated_at`    DATETIME     DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE RESTRICT,
  FOREIGN KEY (`admin_id`)    REFERENCES `admins`(`id`)     ON DELETE RESTRICT,
  INDEX `idx_status`      (`status`),
  INDEX `idx_featured`    (`is_featured`),
  INDEX `idx_breaking`    (`is_breaking`),
  INDEX `idx_category`    (`category_id`),
  INDEX `idx_published`   (`published_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- News <-> Tags Pivot
-- ----------------------------
CREATE TABLE `news_tags` (
  `news_id` INT UNSIGNED NOT NULL,
  `tag_id`  INT UNSIGNED NOT NULL,
  PRIMARY KEY (`news_id`, `tag_id`),
  FOREIGN KEY (`news_id`) REFERENCES `news`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`tag_id`)  REFERENCES `tags`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Banners / Sliders
-- ----------------------------
CREATE TABLE `banners` (
  `id`         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `title`      VARCHAR(200) NOT NULL,
  `subtitle`   VARCHAR(300) NULL,
  `image`      VARCHAR(255) NOT NULL,
  `link_url`   VARCHAR(500) NULL,
  `position`   ENUM('homepage_slider','sidebar','footer') DEFAULT 'homepage_slider',
  `sort_order` TINYINT      DEFAULT 0,
  `is_active`  TINYINT(1)   DEFAULT 1,
  `created_at` DATETIME     DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME     DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Site Settings
-- ----------------------------
CREATE TABLE `settings` (
  `id`         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `key`        VARCHAR(100) NOT NULL UNIQUE,
  `value`      TEXT         NULL,
  `updated_at` DATETIME     DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Seed: Default Admin
-- Password: Admin@1234
-- ----------------------------
INSERT INTO `admins` (`name`, `email`, `password`, `role`) VALUES
('Super Admin', 'admin@interviewharyana.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uXcWb/SCa', 'superadmin');
-- NOTE: The hash above is for the string "password"
-- Change it immediately after first login!

-- ----------------------------
-- Seed: Default Categories
-- ----------------------------
INSERT INTO `categories` (`name`, `slug`, `color`, `sort_order`) VALUES
('हरियाणा',    'haryana',       '#e63946', 1),
('राजनीति',    'politics',      '#457b9d', 2),
('क्राइम',     'crime',         '#1d1d1d', 3),
('खेल',        'sports',        '#2a9d8f', 4),
('व्यापार',    'business',      '#e9a820', 5),
('मनोरंजन',    'entertainment', '#f4a261', 6),
('शिक्षा',     'education',     '#264653', 7),
('स्वास्थ्य',  'health',        '#43aa8b', 8),
('तकनीक',      'technology',    '#577590', 9);

-- ----------------------------
-- Seed: Default Settings
-- ----------------------------
INSERT INTO `settings` (`key`, `value`) VALUES
('site_name',           'Interview haryana'),
('site_tagline',        'हरियाणा की हर खबर'),
('site_email',          'contact@interviewharyana.com'),
('site_phone',          '+91 00000 00000'),
('facebook_url',        ''),
('twitter_url',         ''),
('youtube_url',         ''),
('instagram_url',       ''),
('breaking_news_text',  'Breaking: Interview haryana में आपका स्वागत है!'),
('footer_about',        'Interview haryana हरियाणा की ताज़ा खबरों का विश्वसनीय स्रोत है।');
('site_logo',           '');