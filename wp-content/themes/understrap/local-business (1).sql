-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Час створення: Квт 16 2020 р., 16:12
-- Версія сервера: 8.0.18
-- Версія PHP: 7.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `local-business`
--

-- --------------------------------------------------------

--
-- Структура таблиці `wp_commentmeta`
--

DROP TABLE IF EXISTS `wp_commentmeta`;
CREATE TABLE IF NOT EXISTS `wp_commentmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `comment_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`meta_id`),
  KEY `comment_id` (`comment_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `wp_comments`
--

DROP TABLE IF EXISTS `wp_comments`;
CREATE TABLE IF NOT EXISTS `wp_comments` (
  `comment_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `comment_post_ID` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `comment_author` tinytext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `comment_author_email` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_type` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_ID`),
  KEY `comment_post_ID` (`comment_post_ID`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`),
  KEY `comment_author_email` (`comment_author_email`(10))
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп даних таблиці `wp_comments`
--

INSERT INTO `wp_comments` (`comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id`) VALUES
(1, 1, 'Коментатор WordPress', 'wapuu@wordpress.example', 'https://wordpress.org/', '', '2020-04-14 11:47:08', '2020-04-14 08:47:08', 'Привіт! Це коментар.\nЩоб почати модерувати, редагувати і видаляти коментарі, перейдіть в розділ Коментарів у Майстерні.\nАватари авторів коментарів завантажуються з сервісу<a href=\"https://uk.gravatar.com\">Gravatar</a>.', 0, '1', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблиці `wp_links`
--

DROP TABLE IF EXISTS `wp_links`;
CREATE TABLE IF NOT EXISTS `wp_links` (
  `link_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_image` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_target` varchar(25) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_description` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_visible` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `link_rating` int(11) NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_notes` mediumtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `link_rss` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`link_id`),
  KEY `link_visible` (`link_visible`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `wp_options`
--

DROP TABLE IF EXISTS `wp_options`;
CREATE TABLE IF NOT EXISTS `wp_options` (
  `option_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `option_name` varchar(191) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `option_value` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `autoload` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`),
  KEY `autoload` (`autoload`)
) ENGINE=MyISAM AUTO_INCREMENT=290 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп даних таблиці `wp_options`
--

INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(1, 'siteurl', 'http://local-business.local', 'yes'),
(2, 'home', 'http://local-business.local', 'yes'),
(3, 'blogname', 'Local Business', 'yes'),
(4, 'blogdescription', 'Просто ще один сайт на WordPress', 'yes'),
(5, 'users_can_register', '0', 'yes'),
(6, 'admin_email', 'svjatoslav.romanjuk@gmail.com', 'yes'),
(7, 'start_of_week', '1', 'yes'),
(8, 'use_balanceTags', '0', 'yes'),
(9, 'use_smilies', '1', 'yes'),
(10, 'require_name_email', '1', 'yes'),
(11, 'comments_notify', '1', 'yes'),
(12, 'posts_per_rss', '10', 'yes'),
(13, 'rss_use_excerpt', '0', 'yes'),
(14, 'mailserver_url', 'mail.example.com', 'yes'),
(15, 'mailserver_login', 'login@example.com', 'yes'),
(16, 'mailserver_pass', 'password', 'yes'),
(17, 'mailserver_port', '110', 'yes'),
(18, 'default_category', '1', 'yes'),
(19, 'default_comment_status', 'closed', 'yes'),
(20, 'default_ping_status', 'closed', 'yes'),
(21, 'default_pingback_flag', '', 'yes'),
(22, 'posts_per_page', '10', 'yes'),
(23, 'date_format', 'd.m.Y', 'yes'),
(24, 'time_format', 'H:i', 'yes'),
(25, 'links_updated_date_format', 'd.m.Y H:i', 'yes'),
(26, 'comment_moderation', '', 'yes'),
(27, 'moderation_notify', '1', 'yes'),
(28, 'permalink_structure', '/%postname%/', 'yes'),
(29, 'rewrite_rules', 'a:106:{s:11:\"^wp-json/?$\";s:22:\"index.php?rest_route=/\";s:14:\"^wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:21:\"^index.php/wp-json/?$\";s:22:\"index.php?rest_route=/\";s:24:\"^index.php/wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:9:\"places/?$\";s:26:\"index.php?post_type=places\";s:39:\"places/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?post_type=places&feed=$matches[1]\";s:34:\"places/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?post_type=places&feed=$matches[1]\";s:26:\"places/page/([0-9]{1,})/?$\";s:44:\"index.php?post_type=places&paged=$matches[1]\";s:47:\"category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:42:\"category/(.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:23:\"category/(.+?)/embed/?$\";s:46:\"index.php?category_name=$matches[1]&embed=true\";s:35:\"category/(.+?)/page/?([0-9]{1,})/?$\";s:53:\"index.php?category_name=$matches[1]&paged=$matches[2]\";s:17:\"category/(.+?)/?$\";s:35:\"index.php?category_name=$matches[1]\";s:44:\"tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:39:\"tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:20:\"tag/([^/]+)/embed/?$\";s:36:\"index.php?tag=$matches[1]&embed=true\";s:32:\"tag/([^/]+)/page/?([0-9]{1,})/?$\";s:43:\"index.php?tag=$matches[1]&paged=$matches[2]\";s:14:\"tag/([^/]+)/?$\";s:25:\"index.php?tag=$matches[1]\";s:45:\"type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:40:\"type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:21:\"type/([^/]+)/embed/?$\";s:44:\"index.php?post_format=$matches[1]&embed=true\";s:33:\"type/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?post_format=$matches[1]&paged=$matches[2]\";s:15:\"type/([^/]+)/?$\";s:33:\"index.php?post_format=$matches[1]\";s:32:\"places/.+?/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:42:\"places/.+?/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:62:\"places/.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:57:\"places/.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:57:\"places/.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:38:\"places/.+?/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:21:\"places/(.+?)/embed/?$\";s:39:\"index.php?places=$matches[1]&embed=true\";s:25:\"places/(.+?)/trackback/?$\";s:33:\"index.php?places=$matches[1]&tb=1\";s:45:\"places/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:45:\"index.php?places=$matches[1]&feed=$matches[2]\";s:40:\"places/(.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:45:\"index.php?places=$matches[1]&feed=$matches[2]\";s:33:\"places/(.+?)/page/?([0-9]{1,})/?$\";s:46:\"index.php?places=$matches[1]&paged=$matches[2]\";s:40:\"places/(.+?)/comment-page-([0-9]{1,})/?$\";s:46:\"index.php?places=$matches[1]&cpage=$matches[2]\";s:29:\"places/(.+?)(?:/([0-9]+))?/?$\";s:45:\"index.php?places=$matches[1]&page=$matches[2]\";s:12:\"robots\\.txt$\";s:18:\"index.php?robots=1\";s:13:\"favicon\\.ico$\";s:19:\"index.php?favicon=1\";s:48:\".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$\";s:18:\"index.php?feed=old\";s:20:\".*wp-app\\.php(/.*)?$\";s:19:\"index.php?error=403\";s:18:\".*wp-register.php$\";s:23:\"index.php?register=true\";s:32:\"feed/(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:27:\"(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:8:\"embed/?$\";s:21:\"index.php?&embed=true\";s:20:\"page/?([0-9]{1,})/?$\";s:28:\"index.php?&paged=$matches[1]\";s:27:\"comment-page-([0-9]{1,})/?$\";s:39:\"index.php?&page_id=14&cpage=$matches[1]\";s:41:\"comments/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:36:\"comments/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:17:\"comments/embed/?$\";s:21:\"index.php?&embed=true\";s:44:\"search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:39:\"search/(.+)/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:20:\"search/(.+)/embed/?$\";s:34:\"index.php?s=$matches[1]&embed=true\";s:32:\"search/(.+)/page/?([0-9]{1,})/?$\";s:41:\"index.php?s=$matches[1]&paged=$matches[2]\";s:14:\"search/(.+)/?$\";s:23:\"index.php?s=$matches[1]\";s:47:\"author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:42:\"author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:23:\"author/([^/]+)/embed/?$\";s:44:\"index.php?author_name=$matches[1]&embed=true\";s:35:\"author/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?author_name=$matches[1]&paged=$matches[2]\";s:17:\"author/([^/]+)/?$\";s:33:\"index.php?author_name=$matches[1]\";s:69:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:64:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:45:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/embed/?$\";s:74:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&embed=true\";s:57:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:81:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]\";s:39:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$\";s:63:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]\";s:56:\"([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:51:\"([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:32:\"([0-9]{4})/([0-9]{1,2})/embed/?$\";s:58:\"index.php?year=$matches[1]&monthnum=$matches[2]&embed=true\";s:44:\"([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:65:\"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]\";s:26:\"([0-9]{4})/([0-9]{1,2})/?$\";s:47:\"index.php?year=$matches[1]&monthnum=$matches[2]\";s:43:\"([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:38:\"([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:19:\"([0-9]{4})/embed/?$\";s:37:\"index.php?year=$matches[1]&embed=true\";s:31:\"([0-9]{4})/page/?([0-9]{1,})/?$\";s:44:\"index.php?year=$matches[1]&paged=$matches[2]\";s:13:\"([0-9]{4})/?$\";s:26:\"index.php?year=$matches[1]\";s:27:\".?.+?/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\".?.+?/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\".?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\".?.+?/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:16:\"(.?.+?)/embed/?$\";s:41:\"index.php?pagename=$matches[1]&embed=true\";s:20:\"(.?.+?)/trackback/?$\";s:35:\"index.php?pagename=$matches[1]&tb=1\";s:40:\"(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:35:\"(.?.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:28:\"(.?.+?)/page/?([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&paged=$matches[2]\";s:35:\"(.?.+?)/comment-page-([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&cpage=$matches[2]\";s:24:\"(.?.+?)(?:/([0-9]+))?/?$\";s:47:\"index.php?pagename=$matches[1]&page=$matches[2]\";s:27:\"[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\"[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\"[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\"[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\"[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\"[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:16:\"([^/]+)/embed/?$\";s:37:\"index.php?name=$matches[1]&embed=true\";s:20:\"([^/]+)/trackback/?$\";s:31:\"index.php?name=$matches[1]&tb=1\";s:40:\"([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?name=$matches[1]&feed=$matches[2]\";s:35:\"([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?name=$matches[1]&feed=$matches[2]\";s:28:\"([^/]+)/page/?([0-9]{1,})/?$\";s:44:\"index.php?name=$matches[1]&paged=$matches[2]\";s:35:\"([^/]+)/comment-page-([0-9]{1,})/?$\";s:44:\"index.php?name=$matches[1]&cpage=$matches[2]\";s:24:\"([^/]+)(?:/([0-9]+))?/?$\";s:43:\"index.php?name=$matches[1]&page=$matches[2]\";s:16:\"[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:26:\"[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:46:\"[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:41:\"[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:41:\"[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:22:\"[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";}', 'yes'),
(30, 'hack_file', '0', 'yes'),
(31, 'blog_charset', 'UTF-8', 'yes'),
(32, 'moderation_keys', '', 'no'),
(33, 'active_plugins', 'a:3:{i:0;s:29:\"acf-repeater/acf-repeater.php\";i:1;s:30:\"advanced-custom-fields/acf.php\";i:2;s:22:\"cyr2lat/cyr-to-lat.php\";}', 'yes'),
(34, 'category_base', '', 'yes'),
(35, 'ping_sites', 'http://rpc.pingomatic.com/', 'yes'),
(36, 'comment_max_links', '2', 'yes'),
(37, 'gmt_offset', '0', 'yes'),
(38, 'default_email_category', '1', 'yes'),
(39, 'recently_edited', '', 'no'),
(40, 'template', 'understrap', 'yes'),
(41, 'stylesheet', 'understrap', 'yes'),
(42, 'comment_whitelist', '1', 'yes'),
(43, 'blacklist_keys', '', 'no'),
(44, 'comment_registration', '', 'yes'),
(45, 'html_type', 'text/html', 'yes'),
(46, 'use_trackback', '0', 'yes'),
(47, 'default_role', 'subscriber', 'yes'),
(48, 'db_version', '47018', 'yes'),
(49, 'uploads_use_yearmonth_folders', '1', 'yes'),
(50, 'upload_path', '', 'yes'),
(51, 'blog_public', '1', 'yes'),
(52, 'default_link_category', '2', 'yes'),
(53, 'show_on_front', 'page', 'yes'),
(54, 'tag_base', '', 'yes'),
(55, 'show_avatars', '1', 'yes'),
(56, 'avatar_rating', 'G', 'yes'),
(57, 'upload_url_path', '', 'yes'),
(58, 'thumbnail_size_w', '150', 'yes'),
(59, 'thumbnail_size_h', '150', 'yes'),
(60, 'thumbnail_crop', '1', 'yes'),
(61, 'medium_size_w', '300', 'yes'),
(62, 'medium_size_h', '300', 'yes'),
(63, 'avatar_default', 'mystery', 'yes'),
(64, 'large_size_w', '1024', 'yes'),
(65, 'large_size_h', '1024', 'yes'),
(66, 'image_default_link_type', 'none', 'yes'),
(67, 'image_default_size', '', 'yes'),
(68, 'image_default_align', '', 'yes'),
(69, 'close_comments_for_old_posts', '', 'yes'),
(70, 'close_comments_days_old', '14', 'yes'),
(71, 'thread_comments', '1', 'yes'),
(72, 'thread_comments_depth', '5', 'yes'),
(73, 'page_comments', '', 'yes'),
(74, 'comments_per_page', '50', 'yes'),
(75, 'default_comments_page', 'newest', 'yes'),
(76, 'comment_order', 'asc', 'yes'),
(77, 'sticky_posts', 'a:0:{}', 'yes'),
(78, 'widget_categories', 'a:2:{i:2;a:4:{s:5:\"title\";s:0:\"\";s:5:\"count\";i:0;s:12:\"hierarchical\";i:0;s:8:\"dropdown\";i:0;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(79, 'widget_text', 'a:2:{i:1;a:0:{}s:12:\"_multiwidget\";i:1;}', 'yes'),
(80, 'widget_rss', 'a:2:{i:1;a:0:{}s:12:\"_multiwidget\";i:1;}', 'yes'),
(81, 'uninstall_plugins', 'a:0:{}', 'no'),
(82, 'timezone_string', 'Europe/Kiev', 'yes'),
(83, 'page_for_posts', '0', 'yes'),
(84, 'page_on_front', '14', 'yes'),
(85, 'default_post_format', '0', 'yes'),
(86, 'link_manager_enabled', '0', 'yes'),
(87, 'finished_splitting_shared_terms', '1', 'yes'),
(88, 'site_icon', '0', 'yes'),
(89, 'medium_large_size_w', '768', 'yes'),
(90, 'medium_large_size_h', '0', 'yes'),
(91, 'wp_page_for_privacy_policy', '3', 'yes'),
(92, 'show_comments_cookies_opt_in', '1', 'yes'),
(93, 'admin_email_lifespan', '1602406028', 'yes'),
(94, 'initial_db_version', '47018', 'yes'),
(95, 'wp_user_roles', 'a:5:{s:13:\"administrator\";a:2:{s:4:\"name\";s:13:\"Administrator\";s:12:\"capabilities\";a:61:{s:13:\"switch_themes\";b:1;s:11:\"edit_themes\";b:1;s:16:\"activate_plugins\";b:1;s:12:\"edit_plugins\";b:1;s:10:\"edit_users\";b:1;s:10:\"edit_files\";b:1;s:14:\"manage_options\";b:1;s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:6:\"import\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:8:\"level_10\";b:1;s:7:\"level_9\";b:1;s:7:\"level_8\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;s:12:\"delete_users\";b:1;s:12:\"create_users\";b:1;s:17:\"unfiltered_upload\";b:1;s:14:\"edit_dashboard\";b:1;s:14:\"update_plugins\";b:1;s:14:\"delete_plugins\";b:1;s:15:\"install_plugins\";b:1;s:13:\"update_themes\";b:1;s:14:\"install_themes\";b:1;s:11:\"update_core\";b:1;s:10:\"list_users\";b:1;s:12:\"remove_users\";b:1;s:13:\"promote_users\";b:1;s:18:\"edit_theme_options\";b:1;s:13:\"delete_themes\";b:1;s:6:\"export\";b:1;}}s:6:\"editor\";a:2:{s:4:\"name\";s:6:\"Editor\";s:12:\"capabilities\";a:34:{s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;}}s:6:\"author\";a:2:{s:4:\"name\";s:6:\"Author\";s:12:\"capabilities\";a:10:{s:12:\"upload_files\";b:1;s:10:\"edit_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;s:22:\"delete_published_posts\";b:1;}}s:11:\"contributor\";a:2:{s:4:\"name\";s:11:\"Contributor\";s:12:\"capabilities\";a:5:{s:10:\"edit_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;}}s:10:\"subscriber\";a:2:{s:4:\"name\";s:10:\"Subscriber\";s:12:\"capabilities\";a:2:{s:4:\"read\";b:1;s:7:\"level_0\";b:1;}}}', 'yes'),
(96, 'fresh_site', '0', 'yes'),
(97, 'WPLANG', 'uk', 'yes'),
(98, 'widget_search', 'a:2:{i:2;a:1:{s:5:\"title\";s:0:\"\";}s:12:\"_multiwidget\";i:1;}', 'yes'),
(99, 'widget_recent-posts', 'a:2:{i:2;a:2:{s:5:\"title\";s:0:\"\";s:6:\"number\";i:5;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(100, 'widget_recent-comments', 'a:2:{i:2;a:2:{s:5:\"title\";s:0:\"\";s:6:\"number\";i:5;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(101, 'widget_archives', 'a:2:{i:2;a:3:{s:5:\"title\";s:0:\"\";s:5:\"count\";i:0;s:8:\"dropdown\";i:0;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(102, 'widget_meta', 'a:2:{i:2;a:1:{s:5:\"title\";s:0:\"\";}s:12:\"_multiwidget\";i:1;}', 'yes'),
(103, 'sidebars_widgets', 'a:8:{s:19:\"wp_inactive_widgets\";a:0:{}s:13:\"right-sidebar\";a:3:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";}s:12:\"left-sidebar\";a:3:{i:0;s:10:\"archives-2\";i:1;s:12:\"categories-2\";i:2;s:6:\"meta-2\";}s:4:\"hero\";a:0:{}s:10:\"herocanvas\";a:0:{}s:10:\"statichero\";a:0:{}s:10:\"footerfull\";a:0:{}s:13:\"array_version\";i:3;}', 'yes'),
(104, 'cron', 'a:7:{i:1587055629;a:1:{s:34:\"wp_privacy_delete_old_export_files\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"hourly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:3600;}}}i:1587070029;a:3:{s:16:\"wp_version_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:17:\"wp_update_plugins\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:16:\"wp_update_themes\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1587113229;a:1:{s:32:\"recovery_mode_clean_expired_keys\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1587113240;a:2:{s:19:\"wp_scheduled_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}s:25:\"delete_expired_transients\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1587113241;a:1:{s:30:\"wp_scheduled_auto_draft_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1587545229;a:1:{s:30:\"wp_site_health_scheduled_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"weekly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:604800;}}}s:7:\"version\";i:2;}', 'yes'),
(105, 'widget_pages', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(106, 'widget_calendar', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(107, 'widget_media_audio', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(108, 'widget_media_image', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(109, 'widget_media_gallery', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(110, 'widget_media_video', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(111, 'widget_tag_cloud', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(112, 'widget_nav_menu', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(113, 'widget_custom_html', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(115, 'recovery_keys', 'a:0:{}', 'yes'),
(213, '_site_transient_update_core', 'O:8:\"stdClass\":4:{s:7:\"updates\";a:1:{i:0;O:8:\"stdClass\":10:{s:8:\"response\";s:6:\"latest\";s:8:\"download\";s:60:\"https://downloads.wordpress.org/release/uk/wordpress-5.4.zip\";s:6:\"locale\";s:2:\"uk\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:60:\"https://downloads.wordpress.org/release/uk/wordpress-5.4.zip\";s:10:\"no_content\";b:0;s:11:\"new_bundled\";b:0;s:7:\"partial\";b:0;s:8:\"rollback\";b:0;}s:7:\"current\";s:3:\"5.4\";s:7:\"version\";s:3:\"5.4\";s:11:\"php_version\";s:6:\"5.6.20\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"5.3\";s:15:\"partial_version\";s:0:\"\";}}s:12:\"last_checked\";i:1587026940;s:15:\"version_checked\";s:3:\"5.4\";s:12:\"translations\";a:0:{}}', 'no'),
(117, 'theme_mods_twentytwenty', 'a:3:{s:18:\"custom_css_post_id\";i:-1;s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1586855991;s:4:\"data\";a:3:{s:19:\"wp_inactive_widgets\";a:0:{}s:9:\"sidebar-1\";a:3:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";}s:9:\"sidebar-2\";a:3:{i:0;s:10:\"archives-2\";i:1;s:12:\"categories-2\";i:2;s:6:\"meta-2\";}}}s:18:\"nav_menu_locations\";a:0:{}}', 'yes'),
(133, 'can_compress_scripts', '1', 'no'),
(126, '_site_transient_timeout_browser_ba349852028a3c2f76f478e155334187', '1587458840', 'no'),
(127, '_site_transient_browser_ba349852028a3c2f76f478e155334187', 'a:10:{s:4:\"name\";s:6:\"Chrome\";s:7:\"version\";s:13:\"80.0.3987.163\";s:8:\"platform\";s:7:\"Windows\";s:10:\"update_url\";s:29:\"https://www.google.com/chrome\";s:7:\"img_src\";s:43:\"http://s.w.org/images/browsers/chrome.png?1\";s:11:\"img_src_ssl\";s:44:\"https://s.w.org/images/browsers/chrome.png?1\";s:15:\"current_version\";s:2:\"18\";s:7:\"upgrade\";b:0;s:8:\"insecure\";b:0;s:6:\"mobile\";b:0;}', 'no'),
(128, '_site_transient_timeout_php_check_84762f83841bd7717ae6e078c4ccdd1d', '1587458841', 'no'),
(129, '_site_transient_php_check_84762f83841bd7717ae6e078c4ccdd1d', 'a:5:{s:19:\"recommended_version\";s:3:\"7.3\";s:15:\"minimum_version\";s:6:\"5.6.20\";s:12:\"is_supported\";b:1;s:9:\"is_secure\";b:1;s:13:\"is_acceptable\";b:1;}', 'no'),
(279, '_site_transient_timeout_theme_roots', '1587028740', 'no'),
(280, '_site_transient_theme_roots', 'a:4:{s:14:\"twentynineteen\";s:7:\"/themes\";s:15:\"twentyseventeen\";s:7:\"/themes\";s:12:\"twentytwenty\";s:7:\"/themes\";s:10:\"understrap\";s:7:\"/themes\";}', 'no'),
(264, '_transient_timeout_acf_plugin_info_repeater', '1587041046', 'no'),
(265, '_transient_acf_plugin_info_repeater', 'a:18:{s:4:\"name\";s:38:\"Advanced Custom Fields: Repeater Field\";s:4:\"slug\";s:12:\"acf-repeater\";s:7:\"version\";s:5:\"2.1.0\";s:8:\"homepage\";s:36:\"http://www.advancedcustomfields.com/\";s:6:\"author\";s:56:\"<a href=\"http://www.elliotcondon.com/\">Elliot Condon</a>\";s:12:\"contributors\";a:1:{s:12:\"elliotcondon\";a:3:{s:7:\"profile\";s:36:\"https://www.advancedcustomfields.com\";s:6:\"avatar\";s:81:\"https://secure.gravatar.com/avatar/c296f449f92233e8d1102ff01c9bc71e?s=96&d=mm&r=g\";s:12:\"display_name\";s:22:\"Advanced Custom Fields\";}}s:8:\"requires\";s:5:\"3.6.0\";s:12:\"requires_php\";s:0:\"\";s:6:\"tested\";s:5:\"4.9.0\";s:5:\"added\";s:10:\"2013-07-18\";s:12:\"last_updated\";s:10:\"2018-07-24\";s:11:\"description\";s:304:\"<p>The Repeater field acts as a table of data where you can define the columns (sub fields) and add infinite rows.</p>\n<p>Any type of field can be added as a sub field which gives you the potential to create very flexible templates.</p>\n\n<p>http://www.advancedcustomfields.com/add-ons/repeater-field/</p>\";s:12:\"installation\";s:815:\"<p>This software can be treated as both a WP plugin and a theme include.</p>\n<p>However, only when activated as a plugin will updates be available/</p>\n\n<h4>Plugin</h4>\n<ol>\n<li>Copy the \'acf-repeater\' folder into your plugins folder</li>\n<li>Activate the plugin via the Plugins admin page</li>\n</ol>\n\n<h4>Include</h4>\n<ol>\n<li>Copy the \'acf-repeater\' folder into your theme folder (can use sub folders)</li>\n</ol>\n<p>* You can place the folder anywhere inside the \'wp-content\' directory</p>\n<ol>\n<li>Edit your functions.php file and add the following code to include the field:</li>\n</ol>\n\n<p>`</p>\n<p>include_once(\'acf-repeater/acf-repeater.php\');</p>\n<p>`</p>\n<ol>\n<li>Make sure the path is correct to include the acf-repeater.php file</li>\n<li>Remove the acf-repeater-update.php file from the folder.</li>\n</ol>\";s:9:\"changelog\";s:256:\"<h4>2.1.0</h4>\n<ul>\n<li>Added support for ACF version 5.7.0</li>\n</ul>\n\n<h4>2.0.1</h4>\n<ul>\n<li>Minor fixes and improvements</li>\n</ul>\n\n<h4>2.0.0</h4>\n<ul>\n<li>Added support for ACF version 5</li>\n</ul>\n\n<h4>0.0.1</h4>\n<ul>\n<li>Initial Release.</li>\n</ul>\";s:14:\"upgrade_notice\";s:0:\"\";s:5:\"icons\";a:1:{s:7:\"default\";s:63:\"https://ps.w.org/advanced-custom-fields/assets/icon-256x256.png\";}s:7:\"banners\";a:2:{s:3:\"low\";s:77:\"https://ps.w.org/advanced-custom-fields/assets/banner-772x250.jpg?rev=1729102\";s:4:\"high\";s:78:\"https://ps.w.org/advanced-custom-fields/assets/banner-1544x500.jpg?rev=1729099\";}s:8:\"versions\";a:6:{i:0;s:5:\"2.0.1\";i:1;s:11:\"2.0.0-beta2\";i:2;s:11:\"2.0.0-beta1\";i:3;s:5:\"2.0.0\";i:4;s:5:\"1.1.1\";i:5;s:5:\"1.0.1\";}}', 'no'),
(167, 'recently_activated', 'a:0:{}', 'yes'),
(168, 'acf_version', '5.8.9', 'yes'),
(234, '_transient_health-check-site-status-result', '{\"good\":10,\"recommended\":7,\"critical\":0}', 'yes'),
(159, 'theme_mods_understrap', 'a:6:{i:0;b:0;s:28:\"understrap_posts_index_style\";s:7:\"default\";s:27:\"understrap_sidebar_position\";s:5:\"right\";s:25:\"understrap_container_type\";s:9:\"container\";s:18:\"nav_menu_locations\";a:0:{}s:18:\"custom_css_post_id\";i:-1;}', 'yes'),
(150, 'current_theme', 'UnderStrap', 'yes'),
(151, 'theme_mods_understrap-master', 'a:7:{i:0;b:0;s:28:\"understrap_posts_index_style\";s:7:\"default\";s:27:\"understrap_sidebar_position\";s:4:\"none\";s:25:\"understrap_container_type\";s:15:\"container-fluid\";s:18:\"nav_menu_locations\";a:0:{}s:18:\"custom_css_post_id\";i:-1;s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1586855977;s:4:\"data\";a:7:{s:19:\"wp_inactive_widgets\";a:0:{}s:13:\"right-sidebar\";a:3:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";}s:12:\"left-sidebar\";a:3:{i:0;s:10:\"archives-2\";i:1;s:12:\"categories-2\";i:2;s:6:\"meta-2\";}s:4:\"hero\";a:0:{}s:10:\"herocanvas\";a:0:{}s:10:\"statichero\";a:0:{}s:10:\"footerfull\";a:0:{}}}}', 'yes'),
(152, 'theme_switched', '', 'yes'),
(162, 'recovery_mode_email_last_sent', '1586856373', 'yes'),
(275, '_transient_timeout_acf_plugin_updates', '1587196372', 'no'),
(276, '_transient_acf_plugin_updates', 'a:3:{s:7:\"plugins\";a:0:{}s:10:\"expiration\";i:172800;s:6:\"status\";i:1;}', 'no'),
(261, '_site_transient_update_plugins', 'O:8:\"stdClass\":5:{s:12:\"last_checked\";i:1587023572;s:7:\"checked\";a:5:{s:30:\"advanced-custom-fields/acf.php\";s:5:\"5.8.9\";s:29:\"acf-repeater/acf-repeater.php\";s:5:\"2.1.0\";s:19:\"akismet/akismet.php\";s:5:\"4.1.4\";s:22:\"cyr2lat/cyr-to-lat.php\";s:5:\"4.3.5\";s:9:\"hello.php\";s:5:\"1.7.2\";}s:8:\"response\";a:0:{}s:12:\"translations\";a:0:{}s:9:\"no_update\";a:4:{s:30:\"advanced-custom-fields/acf.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:36:\"w.org/plugins/advanced-custom-fields\";s:4:\"slug\";s:22:\"advanced-custom-fields\";s:6:\"plugin\";s:30:\"advanced-custom-fields/acf.php\";s:11:\"new_version\";s:5:\"5.8.9\";s:3:\"url\";s:53:\"https://wordpress.org/plugins/advanced-custom-fields/\";s:7:\"package\";s:71:\"https://downloads.wordpress.org/plugin/advanced-custom-fields.5.8.9.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:75:\"https://ps.w.org/advanced-custom-fields/assets/icon-256x256.png?rev=1082746\";s:2:\"1x\";s:75:\"https://ps.w.org/advanced-custom-fields/assets/icon-128x128.png?rev=1082746\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:78:\"https://ps.w.org/advanced-custom-fields/assets/banner-1544x500.jpg?rev=1729099\";s:2:\"1x\";s:77:\"https://ps.w.org/advanced-custom-fields/assets/banner-772x250.jpg?rev=1729102\";}s:11:\"banners_rtl\";a:0:{}}s:19:\"akismet/akismet.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:21:\"w.org/plugins/akismet\";s:4:\"slug\";s:7:\"akismet\";s:6:\"plugin\";s:19:\"akismet/akismet.php\";s:11:\"new_version\";s:5:\"4.1.4\";s:3:\"url\";s:38:\"https://wordpress.org/plugins/akismet/\";s:7:\"package\";s:56:\"https://downloads.wordpress.org/plugin/akismet.4.1.4.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:59:\"https://ps.w.org/akismet/assets/icon-256x256.png?rev=969272\";s:2:\"1x\";s:59:\"https://ps.w.org/akismet/assets/icon-128x128.png?rev=969272\";}s:7:\"banners\";a:1:{s:2:\"1x\";s:61:\"https://ps.w.org/akismet/assets/banner-772x250.jpg?rev=479904\";}s:11:\"banners_rtl\";a:0:{}}s:22:\"cyr2lat/cyr-to-lat.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:21:\"w.org/plugins/cyr2lat\";s:4:\"slug\";s:7:\"cyr2lat\";s:6:\"plugin\";s:22:\"cyr2lat/cyr-to-lat.php\";s:11:\"new_version\";s:5:\"4.3.5\";s:3:\"url\";s:38:\"https://wordpress.org/plugins/cyr2lat/\";s:7:\"package\";s:56:\"https://downloads.wordpress.org/plugin/cyr2lat.4.3.5.zip\";s:5:\"icons\";a:3:{s:2:\"2x\";s:60:\"https://ps.w.org/cyr2lat/assets/icon-256x256.jpg?rev=2022835\";s:2:\"1x\";s:52:\"https://ps.w.org/cyr2lat/assets/icon.svg?rev=2022835\";s:3:\"svg\";s:52:\"https://ps.w.org/cyr2lat/assets/icon.svg?rev=2022835\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:63:\"https://ps.w.org/cyr2lat/assets/banner-1544x500.png?rev=2022835\";s:2:\"1x\";s:62:\"https://ps.w.org/cyr2lat/assets/banner-772x250.png?rev=2022835\";}s:11:\"banners_rtl\";a:0:{}}s:9:\"hello.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:25:\"w.org/plugins/hello-dolly\";s:4:\"slug\";s:11:\"hello-dolly\";s:6:\"plugin\";s:9:\"hello.php\";s:11:\"new_version\";s:5:\"1.7.2\";s:3:\"url\";s:42:\"https://wordpress.org/plugins/hello-dolly/\";s:7:\"package\";s:60:\"https://downloads.wordpress.org/plugin/hello-dolly.1.7.2.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:64:\"https://ps.w.org/hello-dolly/assets/icon-256x256.jpg?rev=2052855\";s:2:\"1x\";s:64:\"https://ps.w.org/hello-dolly/assets/icon-128x128.jpg?rev=2052855\";}s:7:\"banners\";a:1:{s:2:\"1x\";s:66:\"https://ps.w.org/hello-dolly/assets/banner-772x250.jpg?rev=2052855\";}s:11:\"banners_rtl\";a:0:{}}}}', 'no'),
(215, '_site_transient_update_themes', 'O:8:\"stdClass\":4:{s:12:\"last_checked\";i:1587023574;s:7:\"checked\";a:4:{s:14:\"twentynineteen\";s:3:\"1.5\";s:15:\"twentyseventeen\";s:3:\"2.3\";s:12:\"twentytwenty\";s:3:\"1.2\";s:10:\"understrap\";s:5:\"0.9.4\";}s:8:\"response\";a:0:{}s:12:\"translations\";a:0:{}}', 'no'),
(250, 'category_children', 'a:0:{}', 'yes'),
(286, '_transient_is_multi_author', '0', 'yes');

-- --------------------------------------------------------

--
-- Структура таблиці `wp_postmeta`
--

DROP TABLE IF EXISTS `wp_postmeta`;
CREATE TABLE IF NOT EXISTS `wp_postmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`meta_id`),
  KEY `post_id` (`post_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=MyISAM AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп даних таблиці `wp_postmeta`
--

INSERT INTO `wp_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1, 2, '_wp_page_template', 'default'),
(2, 3, '_wp_page_template', 'default'),
(3, 5, '_wp_trash_meta_status', 'publish'),
(4, 5, '_wp_trash_meta_time', '1586854183'),
(5, 7, '_edit_last', '1'),
(6, 7, '_edit_lock', '1587053521:1'),
(7, 12, '_edit_lock', '1586857327:1'),
(8, 13, '_edit_lock', '1586857382:1'),
(9, 14, '_edit_lock', '1586857858:1'),
(10, 14, '_wp_page_template', 'home.php'),
(11, 2, '_edit_lock', '1586858773:1'),
(12, 16, '_edit_lock', '1586866944:1'),
(13, 16, '_wp_page_template', 'custom-post-templates/coffee-shops.php'),
(14, 22, '_edit_last', '1'),
(15, 22, '_edit_lock', '1586872575:1'),
(16, 23, '_wp_attached_file', '2020/04/french-coffee-shop.jpg'),
(17, 23, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:550;s:6:\"height\";i:413;s:4:\"file\";s:30:\"2020/04/french-coffee-shop.jpg\";s:5:\"sizes\";a:2:{s:6:\"medium\";a:4:{s:4:\"file\";s:30:\"french-coffee-shop-300x225.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:225;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"thumbnail\";a:4:{s:4:\"file\";s:30:\"french-coffee-shop-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(18, 22, '_thumbnail_id', '23'),
(19, 22, 'address_city', 'Київ'),
(20, 22, '_address_city', 'field_5e95842332a22'),
(21, 22, 'address_street', 'Мілютенка, 7а'),
(22, 22, '_address_street', 'field_5e958543bf2d2'),
(23, 24, '_edit_last', '1'),
(24, 24, '_edit_lock', '1586958458:1'),
(25, 33, '_edit_last', '1'),
(26, 33, '_edit_lock', '1586954716:1'),
(27, 35, '_wp_attached_file', '2020/04/simple_logo.png'),
(28, 35, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:250;s:6:\"height\";i:127;s:4:\"file\";s:23:\"2020/04/simple_logo.png\";s:5:\"sizes\";a:1:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:23:\"simple_logo-150x127.png\";s:5:\"width\";i:150;s:6:\"height\";i:127;s:9:\"mime-type\";s:9:\"image/png\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(29, 22, 'logo', '35'),
(30, 22, '_logo', 'field_5e95b2360c3cd'),
(31, 22, 'sertificate', ''),
(32, 22, '_sertificate', 'field_5e95afc23d915'),
(33, 36, '_edit_last', '1'),
(34, 36, '_edit_lock', '1587051760:1'),
(35, 36, '_thumbnail_id', '23'),
(36, 36, 'logo', '35'),
(37, 36, '_logo', 'field_5e95b2360c3cd'),
(38, 36, 'address_city', 'Київ'),
(39, 36, '_address_city', 'field_5e95842332a22'),
(40, 36, 'address_street', 'Мілютенка, 7а'),
(41, 36, '_address_street', 'field_5e958543bf2d2'),
(42, 36, 'сertificate', ''),
(43, 36, '_сertificate', 'field_5e95afc23d915'),
(44, 36, '_wp_page_template', 'default'),
(45, 1, '_edit_lock', '1586941889:1'),
(46, 37, '_edit_last', '1'),
(47, 37, '_edit_lock', '1587044100:1'),
(48, 38, '_wp_attached_file', '2020/04/brioche-french-toast.jpg'),
(49, 38, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:550;s:6:\"height\";i:367;s:4:\"file\";s:32:\"2020/04/brioche-french-toast.jpg\";s:5:\"sizes\";a:2:{s:6:\"medium\";a:4:{s:4:\"file\";s:32:\"brioche-french-toast-300x200.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:200;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:9:\"thumbnail\";a:4:{s:4:\"file\";s:32:\"brioche-french-toast-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(50, 37, '_thumbnail_id', '38'),
(51, 37, 'logo', '35'),
(52, 37, '_logo', 'field_5e95b2360c3cd'),
(53, 37, 'address_city', 'Київ'),
(54, 37, '_address_city', 'field_5e95842332a22'),
(55, 37, 'address_street', 'Братиславська, 14б'),
(56, 37, '_address_street', 'field_5e958543bf2d2'),
(57, 37, 'сertificate_0_certificate_title', 'Bonus 5'),
(58, 37, '_сertificate_0_certificate_title', 'field_5e95b0363d916'),
(59, 37, 'сertificate_0_certificate_description', 'Надаємо знижку 25% на 5 чашок кави після карантину'),
(60, 37, '_сertificate_0_certificate_description', 'field_5e95b0993d917'),
(61, 37, 'сertificate_0_certificate_cost', '50'),
(62, 37, '_сertificate_0_certificate_cost', 'field_5e95b0e33d918'),
(63, 37, 'сertificate_0_certificate_order', 'a:3:{s:5:\"title\";s:0:\"\";s:3:\"url\";s:21:\"https://somewhere.com\";s:6:\"target\";s:0:\"\";}'),
(64, 37, '_сertificate_0_certificate_order', 'field_5e95b10f3d919'),
(65, 37, 'сertificate_0_certificate_background', '#00d8ca'),
(66, 37, '_сertificate_0_certificate_background', 'field_5e95b15a3d91a'),
(67, 37, 'сertificate_1_certificate_title', 'Bonus 10'),
(68, 37, '_сertificate_1_certificate_title', 'field_5e95b0363d916'),
(69, 37, 'сertificate_1_certificate_description', 'Надаємо знижку 25% на 10 чашок кави після карантину'),
(70, 37, '_сertificate_1_certificate_description', 'field_5e95b0993d917'),
(71, 37, 'сertificate_1_certificate_cost', '75'),
(72, 37, '_сertificate_1_certificate_cost', 'field_5e95b0e33d918'),
(73, 37, 'сertificate_1_certificate_order', 'a:3:{s:5:\"title\";s:0:\"\";s:3:\"url\";s:21:\"https://somewhere.com\";s:6:\"target\";s:0:\"\";}'),
(74, 37, '_сertificate_1_certificate_order', 'field_5e95b10f3d919'),
(75, 37, 'сertificate_1_certificate_background', '#00b3c6'),
(76, 37, '_сertificate_1_certificate_background', 'field_5e95b15a3d91a'),
(77, 37, 'сertificate_2_certificate_title', 'Bonus 25'),
(78, 37, '_сertificate_2_certificate_title', 'field_5e95b0363d916'),
(79, 37, 'сertificate_2_certificate_description', 'Надаємо знижку 25% на 25 чашок кави після карантину'),
(80, 37, '_сertificate_2_certificate_description', 'field_5e95b0993d917'),
(81, 37, 'сertificate_2_certificate_cost', '100'),
(82, 37, '_сertificate_2_certificate_cost', 'field_5e95b0e33d918'),
(83, 37, 'сertificate_2_certificate_order', 'a:3:{s:5:\"title\";s:0:\"\";s:3:\"url\";s:21:\"https://somewhere.com\";s:6:\"target\";s:0:\"\";}'),
(84, 37, '_сertificate_2_certificate_order', 'field_5e95b10f3d919'),
(85, 37, 'сertificate_2_certificate_background', '#007dc6'),
(86, 37, '_сertificate_2_certificate_background', 'field_5e95b15a3d91a'),
(87, 37, 'сertificate', '3'),
(88, 37, '_сertificate', 'field_5e95afc23d915'),
(89, 16, '_wp_trash_meta_status', 'publish'),
(90, 16, '_wp_trash_meta_time', '1586958610'),
(91, 16, '_wp_desired_post_slug', 'coffee-shop'),
(92, 39, '_edit_lock', '1587042554:1'),
(93, 39, '_edit_last', '1'),
(94, 37, 'address_web', 'https://u-oli.com'),
(95, 37, '_address_web', 'field_5e985992d0776'),
(96, 37, 'coord_lattitude', '50.467214'),
(97, 37, '_coord_lattitude', 'field_5e98582cc5c46'),
(98, 37, 'coord_longitude', '30.629556'),
(99, 37, '_coord_longitude', 'field_5e9858f0c5c47'),
(100, 36, 'address_web', ''),
(101, 36, '_address_web', 'field_5e985992d0776'),
(102, 36, 'coord_lattitude', '50.478211'),
(103, 36, '_coord_lattitude', 'field_5e98582cc5c46'),
(104, 36, 'coord_longitude', '30.631412'),
(105, 36, '_coord_longitude', 'field_5e9858f0c5c47');

-- --------------------------------------------------------

--
-- Структура таблиці `wp_posts`
--

DROP TABLE IF EXISTS `wp_posts`;
CREATE TABLE IF NOT EXISTS `wp_posts` (
  `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_author` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_title` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_excerpt` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'open',
  `post_password` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `post_name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `to_ping` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `pinged` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `guid` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `post_name` (`post_name`(191)),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп даних таблиці `wp_posts`
--

INSERT INTO `wp_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(1, 1, '2020-04-14 11:47:08', '2020-04-14 08:47:08', '<!-- wp:paragraph -->\n<p>Ласкаво просимо до WordPress. Це ваш перший запис. Редагуйте або видаліть, а потім починайте писати!</p>\n<!-- /wp:paragraph -->', 'Привіт, світ!', '', 'publish', 'open', 'open', '', '%d0%bf%d1%80%d0%b8%d0%b2%d1%96%d1%82-%d1%81%d0%b2%d1%96%d1%82', '', '', '2020-04-14 11:47:08', '2020-04-14 08:47:08', '', 0, 'http://local-business.local/?p=1', 0, 'post', '', 1),
(2, 1, '2020-04-14 11:47:08', '2020-04-14 08:47:08', '<!-- wp:paragraph -->\n<p>Це приклад сторінки. Від записів у блозі вона відрізняється тим, що залишається на одному місці і відображається в меню сайту (у більшості тем). На сторінці &laquo;Деталі&raquo; власники сайтів зазвичай розповідають про себе потенційним відвідувачам. Наприклад, так:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:quote -->\n<blockquote class=\"wp-block-quote\"><p>Привіт! Вдень я кур\'єр, а ввечері &#8212; перспективний актор. Це мій блог. Я живу у Львові, люблю свого пса Джека і Пінаколаду. (І ще потрапляти під дощ.)</p></blockquote>\n<!-- /wp:quote -->\n\n<!-- wp:paragraph -->\n<p>... чи щось подібне до цього:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:quote -->\n<blockquote class=\"wp-block-quote\"><p>Компанія &laquo;Штучки XYZ&raquo; була заснована в 1971 році і з тих пір виготовляє якісні штучки. Компанія знаходиться в Готем-сіті, має штат з більш ніж 2000 співробітників і приносить багато користі жителям Готема.</p></blockquote>\n<!-- /wp:quote -->\n\n<!-- wp:paragraph -->\n<p>Перейдіть <a href=\"http://local-business.local/wp-admin/\">в майстерню</a>, щоб видалити цю сторінку і створити нові. Успіхів!</p>\n<!-- /wp:paragraph -->', 'Зразок сторінки', '', 'publish', 'closed', 'open', '', 'sample-page', '', '', '2020-04-14 11:47:08', '2020-04-14 08:47:08', '', 0, 'http://local-business.local/?page_id=2', 0, 'page', '', 0),
(3, 1, '2020-04-14 11:47:08', '2020-04-14 08:47:08', '<!-- wp:heading --><h2>Хто ми</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Наша адреса сайту: http://local-business.local.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Які особисті дані ми збираємо та чому ми їх збираємо</h2><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>Коментарі</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Коли відвідувачі залишають коментарі на сайті, ми збираємо дані, що відображаються у формі коментарів, а також IP-адреси відвідувачів та рядку агента-браузера користувача, щоб допомогти виявити спам.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>Анонімний рядок, створений за вашою адресою електронної пошти (також називається хеш), може бути наданий службі Gravatar, щоб дізнатись, чи ви його використовуєте. Політика конфіденційності служби Gravatar доступна тут: https://automattic.com/privacy/. Після схвалення вашого коментаря, ваше зображення профілю буде видно для громадськості в контексті вашого коментарю.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>Медіафайли</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Якщо ви завантажуєте зображення на сайт, вам слід уникати завантаження зображень із вбудованими даними про місцезнаходження (EXIF GPS). Відвідувачі сайту можуть завантажувати та витягувати будь-які дані про місцезнаходження із зображень на сайті.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>Контактні форми</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>Cookies</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Якщо ви залишаєте коментар на нашому сайті, ви можете ввімкнути збереження свого імені, електронної адреси та сайту в файлах cookie. Це для вашої зручності, так що вам не потрібно буде повторно заповнювати ваші дані, коли ви залишатимете наступний коментар. Ці файли cookie зберігатимуться 1 рік.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>Якщо у вас є обліковий запис на сайті і ви ввійдете в нього, ми встановимо тимчасовий cookie для визначення підтримки cookies вашим браузером, cookie не містить ніякої особистої інформації і віддаляється при закритті вашого браузера.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>Коли ви ввійдете в систему, ми також встановимо декілька файлів cookie, щоб зберегти інформацію про ваш логін та налаштування екрана. Cookie-файли для входу зберігаються 2 дні, а файли cookie-файлів налаштувань екрану - 1 рік. Якщо ви виберете &quot;Запам\'ятати мене&quot;, ваш логін буде зберігатися протягом 2 тижнів. Якщо ви вийдете зі свого облікового запису, файли cookie логіну будуть видалені.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>Якщо ви редагуєте або публікуєте статтю, у вашому веб-переглядачі буде збережений додатковий файл cookie. Цей файл cookie не містить особистих даних і просто вказує ідентифікатор статті, яку ви щойно редагували. Його термін дії закінчується через 1 день.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>Вбудований вміст з інших веб-сайтів</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Статті на цьому сайті можуть містити вбудований вміст (наприклад: відео, зображення, статті тощо). Вбудований вміст з інших сайтів веде себе так само, як би користувач відвідав інший сайт.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>Ці сайти можуть збирати дані про вас, використовувати файли cookie, вбудовані додатки відстеження третіх сторін та стежити за вашою взаємодією з цим вбудованим вмістом. Зокрема відстежувати взаємодію з вбудованим вмістом, якщо у вас є обліковий запис і ви увійшли на цей сайт.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>Аналітика</h3><!-- /wp:heading --><!-- wp:heading --><h2>З ким ми ділимося вашими даними</h2><!-- /wp:heading --><!-- wp:heading --><h2>Як довго ми зберігаємо ваші дані</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Якщо ви залишаєте коментар, він та його метадані зберігаються протягом невизначеного терміну. Таким чином, ми можемо автоматично визначати та затверджувати кожен наступний коментар замість того, щоб тримати їх у черзі на модерації.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>Для користувачів, які реєструються на нашому сайті (якщо такі є), ми зберігаємо надану ними персональну інформацію у їхньому профілі користувача. Всі користувачі можуть переглядати, редагувати або видаляти свої особисті дані в будь-який час (за винятком того, що вони не можуть змінити своє ім\'я користувача). Адміністратори сайту також можуть переглядати та редагувати цю інформацію.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Які права ви маєте відносно своїх даних</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Якщо у вас є обліковий запис на цьому сайті або ви залишили коментарі, ви можете подати запит на отримання експортованого файлу особистих даних які ми зберігаємо про вас, включаючи всі дані, які ви надали нам. Ви також можете вимагати, щоб ми стерли будь-які особисті дані, які ми маємо щодо вас. Це не включає будь-які дані, які ми зобов\'язані зберігати в адміністративних, правових та цілях безпеки.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Куди ми відправляємо ваші данні</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Коментарі відвідувачів можуть бути перевірені за допомогою служби автоматичного виявлення спаму.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Ваша контактна інформація</h2><!-- /wp:heading --><!-- wp:heading --><h2>Додаткова інформація</h2><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>Як ми захищаємо ваші данні</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>Які процедури проти втрати даних ми використовуємо</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>Від яких третіх сторін ми отримуємо дані</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>Яке автоматичне рішення приймається  і/або профілювання ми робимо з користувацькими даними</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>Вимоги до розкриття галузевих нормативних вимог</h3><!-- /wp:heading -->', 'Політика конфіденційності', '', 'draft', 'closed', 'open', '', 'privacy-policy', '', '', '2020-04-14 11:47:08', '2020-04-14 08:47:08', '', 0, 'http://local-business.local/?page_id=3', 0, 'page', '', 0),
(4, 1, '2020-04-14 11:47:21', '0000-00-00 00:00:00', '', 'Авточернетка', '', 'auto-draft', 'open', 'open', '', '', '', '', '2020-04-14 11:47:21', '0000-00-00 00:00:00', '', 0, 'http://local-business.local/?p=4', 0, 'post', '', 0),
(5, 1, '2020-04-14 11:49:43', '2020-04-14 08:49:43', '{\n    \"understrap-master::understrap_container_type\": {\n        \"value\": \"container-fluid\",\n        \"type\": \"theme_mod\",\n        \"user_id\": 1,\n        \"date_modified_gmt\": \"2020-04-14 08:49:43\"\n    },\n    \"understrap-master::understrap_sidebar_position\": {\n        \"value\": \"none\",\n        \"type\": \"theme_mod\",\n        \"user_id\": 1,\n        \"date_modified_gmt\": \"2020-04-14 08:49:43\"\n    }\n}', '', '', 'trash', 'closed', 'closed', '', 'e02609f6-fad3-4339-9ce8-a1503cf3f1df', '', '', '2020-04-14 11:49:43', '2020-04-14 08:49:43', '', 0, 'http://local-business.local/e02609f6-fad3-4339-9ce8-a1503cf3f1df/', 0, 'customize_changeset', '', 0),
(6, 1, '2020-04-14 12:31:55', '0000-00-00 00:00:00', '', 'Авточернетка', '', 'auto-draft', 'open', 'closed', '', '', '', '', '2020-04-14 12:31:55', '0000-00-00 00:00:00', '', 0, 'http://local-business.local/?post_type=coffee-shops&p=6', 0, 'coffee-shops', '', 0),
(7, 1, '2020-04-14 12:38:01', '2020-04-14 09:38:01', 'a:7:{s:8:\"location\";a:1:{i:0;a:1:{i:0;a:3:{s:5:\"param\";s:9:\"post_type\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:6:\"places\";}}}s:8:\"position\";s:6:\"normal\";s:5:\"style\";s:7:\"default\";s:15:\"label_placement\";s:3:\"top\";s:21:\"instruction_placement\";s:5:\"label\";s:14:\"hide_on_screen\";s:0:\"\";s:11:\"description\";s:0:\"\";}', 'Адреса', 'adresa', 'publish', 'closed', 'closed', '', 'group_5e9583cac1516', '', '', '2020-04-16 16:12:17', '2020-04-16 13:12:17', '', 0, 'http://local-business.local/?post_type=acf-field-group&#038;p=7', 1, 'acf-field-group', '', 0),
(8, 1, '2020-04-14 12:38:01', '2020-04-14 09:38:01', 'a:10:{s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:1;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";}', 'Місто', 'address_city', 'publish', 'closed', 'closed', '', 'field_5e95842332a22', '', '', '2020-04-14 12:38:01', '2020-04-14 09:38:01', '', 7, 'http://local-business.local/?post_type=acf-field&p=8', 0, 'acf-field', '', 0),
(9, 1, '2020-04-14 12:38:10', '0000-00-00 00:00:00', '', 'Авточернетка', '', 'auto-draft', 'open', 'closed', '', '', '', '', '2020-04-14 12:38:10', '0000-00-00 00:00:00', '', 0, 'http://local-business.local/?post_type=coffee-shops&p=9', 0, 'coffee-shops', '', 0),
(10, 1, '2020-04-14 12:42:02', '2020-04-14 09:42:02', 'a:10:{s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:1;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";}', 'Вулиця, будинок', 'address_street', 'publish', 'closed', 'closed', '', 'field_5e958543bf2d2', '', '', '2020-04-14 12:42:02', '2020-04-14 09:42:02', '', 7, 'http://local-business.local/?post_type=acf-field&p=10', 1, 'acf-field', '', 0),
(11, 1, '2020-04-14 12:42:04', '0000-00-00 00:00:00', '', 'Авточернетка', '', 'auto-draft', 'open', 'closed', '', '', '', '', '2020-04-14 12:42:04', '0000-00-00 00:00:00', '', 0, 'http://local-business.local/?post_type=coffee-shops&p=11', 0, 'coffee-shops', '', 0),
(12, 1, '2020-04-14 12:44:01', '0000-00-00 00:00:00', '', 'Авточернетка', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2020-04-14 12:44:01', '0000-00-00 00:00:00', '', 0, 'http://local-business.local/?page_id=12', 0, 'page', '', 0),
(13, 1, '2020-04-14 12:44:36', '0000-00-00 00:00:00', '', 'Авточернетка', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2020-04-14 12:44:36', '0000-00-00 00:00:00', '', 0, 'http://local-business.local/?page_id=13', 0, 'page', '', 0),
(14, 1, '2020-04-14 12:46:06', '2020-04-14 09:46:06', '', 'Головна', '', 'publish', 'closed', 'closed', '', 'home', '', '', '2020-04-14 12:52:51', '2020-04-14 09:52:51', '', 0, 'http://local-business.local/?page_id=14', 0, 'page', '', 0),
(15, 1, '2020-04-14 12:46:06', '2020-04-14 09:46:06', '', 'Головна', '', 'inherit', 'closed', 'closed', '', '14-revision-v1', '', '', '2020-04-14 12:46:06', '2020-04-14 09:46:06', '', 14, 'http://local-business.local/14-revision-v1/', 0, 'revision', '', 0),
(16, 1, '2020-04-14 13:09:21', '2020-04-14 10:09:21', '', 'Кав\'ярні', '', 'trash', 'closed', 'closed', '', 'coffee-shop__trashed', '', '', '2020-04-15 16:50:10', '2020-04-15 13:50:10', '', 0, 'http://local-business.local/?page_id=16', 0, 'page', '', 0),
(17, 1, '2020-04-14 13:09:21', '2020-04-14 10:09:21', '', 'Кав\'ярні', '', 'inherit', 'closed', 'closed', '', '16-revision-v1', '', '', '2020-04-14 13:09:21', '2020-04-14 10:09:21', '', 16, 'http://local-business.local/16-revision-v1/', 0, 'revision', '', 0),
(21, 1, '2020-04-14 13:22:33', '2020-04-14 10:22:33', '', 'Кав\'ярні', '', 'inherit', 'closed', 'closed', '', '16-revision-v1', '', '', '2020-04-14 13:22:33', '2020-04-14 10:22:33', '', 16, 'http://local-business.local/16-revision-v1/', 0, 'revision', '', 0),
(19, 1, '2020-04-14 13:13:47', '2020-04-14 10:13:47', '<!-- wp:paragraph -->\n<p>xbfvhsdkvnsd,vndkn selfjlejl selfjalfj</p>\n<!-- /wp:paragraph -->', 'Кав\'ярні', '', 'inherit', 'closed', 'closed', '', '16-revision-v1', '', '', '2020-04-14 13:13:47', '2020-04-14 10:13:47', '', 16, 'http://local-business.local/16-revision-v1/', 0, 'revision', '', 0),
(22, 1, '2020-04-14 13:30:37', '2020-04-14 10:30:37', 'Наша нова кав\'ярня бла-бла-бла Наша нова кав\'ярня бла-бла-бла Наша нова кав\'ярня бла-бла-бла Наша нова кав\'ярня бла-бла-бла Наша нова кав\'ярня бла-бла-бла Наша нова кав\'ярня бла-бла-бла Наша нова кав\'ярня бла-бла-бла Наша нова кав\'ярня бла-бла-бла Наша нова кав\'ярня бла-бла-бла Наша нова кав\'ярня бла-бла-бла', 'Нова кав\'ярня', '', 'publish', 'closed', 'closed', '', 'coffee-shop-1', '', '', '2020-04-14 15:56:08', '2020-04-14 12:56:08', '', 0, 'http://local-business.local/?post_type=coffee-shops&#038;p=22', 0, 'coffee-shops', '', 0),
(23, 1, '2020-04-14 13:30:28', '2020-04-14 10:30:28', '', 'french-coffee-shop', '', 'inherit', 'open', 'closed', '', 'french-coffee-shop', '', '', '2020-04-14 13:30:28', '2020-04-14 10:30:28', '', 22, 'http://local-business.local/wp-content/uploads/2020/04/french-coffee-shop.jpg', 0, 'attachment', 'image/jpeg', 0),
(24, 1, '2020-04-14 15:27:38', '2020-04-14 12:27:38', 'a:7:{s:8:\"location\";a:1:{i:0;a:1:{i:0;a:3:{s:5:\"param\";s:9:\"post_type\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:6:\"places\";}}}s:8:\"position\";s:6:\"normal\";s:5:\"style\";s:7:\"default\";s:15:\"label_placement\";s:3:\"top\";s:21:\"instruction_placement\";s:5:\"label\";s:14:\"hide_on_screen\";s:0:\"\";s:11:\"description\";s:0:\"\";}', 'Сертифікати', 'sertyfikaty', 'publish', 'closed', 'closed', '', 'group_5e95aba2a8280', '', '', '2020-04-15 14:21:25', '2020-04-15 11:21:25', '', 0, 'http://local-business.local/?post_type=acf-field-group&#038;p=24', 2, 'acf-field-group', '', 0),
(25, 1, '2020-04-14 15:40:19', '0000-00-00 00:00:00', '', 'Авточернетка', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2020-04-14 15:40:19', '0000-00-00 00:00:00', '', 0, 'http://local-business.local/?post_type=acf-field-group&p=25', 0, 'acf-field-group', '', 0),
(26, 1, '2020-04-14 15:40:44', '0000-00-00 00:00:00', '', 'Авточернетка', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2020-04-14 15:40:44', '0000-00-00 00:00:00', '', 0, 'http://local-business.local/?post_type=acf-field-group&p=26', 0, 'acf-field-group', '', 0),
(27, 1, '2020-04-14 15:50:54', '2020-04-14 12:50:54', 'a:10:{s:4:\"type\";s:8:\"repeater\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:9:\"collapsed\";s:0:\"\";s:3:\"min\";s:0:\"\";s:3:\"max\";s:0:\"\";s:6:\"layout\";s:5:\"table\";s:12:\"button_label\";s:0:\"\";}', 'Сертифікат', 'сertificate', 'publish', 'closed', 'closed', '', 'field_5e95afc23d915', '', '', '2020-04-14 16:07:10', '2020-04-14 13:07:10', '', 24, 'http://local-business.local/?post_type=acf-field&#038;p=27', 0, 'acf-field', '', 0),
(28, 1, '2020-04-14 15:50:54', '2020-04-14 12:50:54', 'a:10:{s:4:\"type\";s:4:\"text\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:1;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";}', 'Назва', 'certificate_title', 'publish', 'closed', 'closed', '', 'field_5e95b0363d916', '', '', '2020-04-14 16:04:55', '2020-04-14 13:04:55', '', 27, 'http://local-business.local/?post_type=acf-field&#038;p=28', 0, 'acf-field', '', 0),
(29, 1, '2020-04-14 15:50:54', '2020-04-14 12:50:54', 'a:10:{s:4:\"type\";s:8:\"textarea\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:9:\"maxlength\";s:0:\"\";s:4:\"rows\";s:0:\"\";s:9:\"new_lines\";s:0:\"\";}', 'Опис', 'certificate_description', 'publish', 'closed', 'closed', '', 'field_5e95b0993d917', '', '', '2020-04-14 16:04:55', '2020-04-14 13:04:55', '', 27, 'http://local-business.local/?post_type=acf-field&#038;p=29', 1, 'acf-field', '', 0),
(30, 1, '2020-04-14 15:50:54', '2020-04-14 12:50:54', 'a:12:{s:4:\"type\";s:6:\"number\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:1;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:3:\"min\";s:0:\"\";s:3:\"max\";s:0:\"\";s:4:\"step\";s:0:\"\";}', 'Вартість', 'certificate_cost', 'publish', 'closed', 'closed', '', 'field_5e95b0e33d918', '', '', '2020-04-14 16:04:55', '2020-04-14 13:04:55', '', 27, 'http://local-business.local/?post_type=acf-field&#038;p=30', 2, 'acf-field', '', 0),
(31, 1, '2020-04-14 15:50:54', '2020-04-14 12:50:54', 'a:6:{s:4:\"type\";s:4:\"link\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"return_format\";s:3:\"url\";}', 'Замовлення', 'certificate_order', 'publish', 'closed', 'closed', '', 'field_5e95b10f3d919', '', '', '2020-04-15 14:21:25', '2020-04-15 11:21:25', '', 27, 'http://local-business.local/?post_type=acf-field&#038;p=31', 3, 'acf-field', '', 0),
(37, 1, '2020-04-15 14:34:14', '2020-04-15 11:34:14', '<p class=\"page-description\">Не можете зараз особисто вручити подарунок другові-імениннику, хочете порадувати remote-колегу або нарешті «знайти друга на випадок кінця світу» і запросити на побачення? Купуйте сертифікат і призначте зустріч після карантину. Так ви підтримаєте улюблений заклад і наблизите нашу з вами зустріч ❤️ Потім оплачуйте покупки сертифікатом, поки на віртуальному рахунку не закінчаться гроші.</p>', 'кав\'ярня \"У Олі\"', '', 'publish', 'closed', 'closed', '', 'kavyarnya-u-oli', '', '', '2020-04-16 16:13:32', '2020-04-16 13:13:32', '', 0, 'http://local-business.local/?post_type=places&#038;p=37', 0, 'places', '', 0),
(32, 1, '2020-04-14 15:50:54', '2020-04-14 12:50:54', 'a:6:{s:4:\"type\";s:12:\"color_picker\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:7:\"#01a0fa\";}', 'Фон сертифікату', 'certificate_background', 'publish', 'closed', 'closed', '', 'field_5e95b15a3d91a', '', '', '2020-04-14 15:50:54', '2020-04-14 12:50:54', '', 27, 'http://local-business.local/?post_type=acf-field&p=32', 4, 'acf-field', '', 0),
(33, 1, '2020-04-14 15:54:02', '2020-04-14 12:54:02', 'a:7:{s:8:\"location\";a:1:{i:0;a:1:{i:0;a:3:{s:5:\"param\";s:9:\"post_type\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:6:\"places\";}}}s:8:\"position\";s:6:\"normal\";s:5:\"style\";s:7:\"default\";s:15:\"label_placement\";s:3:\"top\";s:21:\"instruction_placement\";s:5:\"label\";s:14:\"hide_on_screen\";s:0:\"\";s:11:\"description\";s:0:\"\";}', 'Логотип', 'logotyp', 'publish', 'closed', 'closed', '', 'group_5e95b2256d0c8', '', '', '2020-04-14 20:59:21', '2020-04-14 17:59:21', '', 0, 'http://local-business.local/?post_type=acf-field-group&#038;p=33', 0, 'acf-field-group', '', 0),
(34, 1, '2020-04-14 15:54:02', '2020-04-14 12:54:02', 'a:15:{s:4:\"type\";s:5:\"image\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"return_format\";s:3:\"url\";s:12:\"preview_size\";s:4:\"full\";s:7:\"library\";s:3:\"all\";s:9:\"min_width\";s:0:\"\";s:10:\"min_height\";s:0:\"\";s:8:\"min_size\";s:0:\"\";s:9:\"max_width\";s:0:\"\";s:10:\"max_height\";s:0:\"\";s:8:\"max_size\";s:0:\"\";s:10:\"mime_types\";s:0:\"\";}', 'Логотип', 'logo', 'publish', 'closed', 'closed', '', 'field_5e95b2360c3cd', '', '', '2020-04-14 15:54:02', '2020-04-14 12:54:02', '', 33, 'http://local-business.local/?post_type=acf-field&p=34', 0, 'acf-field', '', 0),
(35, 1, '2020-04-14 15:56:00', '2020-04-14 12:56:00', '', 'simple_logo', '', 'inherit', 'open', 'closed', '', 'simple_logo', '', '', '2020-04-14 15:56:00', '2020-04-14 12:56:00', '', 22, 'http://local-business.local/wp-content/uploads/2020/04/simple_logo.png', 0, 'attachment', 'image/png', 0),
(36, 1, '2020-04-14 20:59:00', '2020-04-14 17:59:00', 'вапрарапррар неоенрернер енрен ен е енг енерекрапаиа', 'Нова кав\'ярня', '', 'publish', 'closed', 'closed', '', 'nova-kavyarnya', '', '', '2020-04-16 16:38:20', '2020-04-16 13:38:20', '', 0, 'http://local-business.local/?post_type=places&#038;p=36', 0, 'places', '', 0),
(38, 1, '2020-04-15 14:31:23', '2020-04-15 11:31:23', '', 'brioche-french-toast', '', 'inherit', 'open', 'closed', '', 'brioche-french-toast', '', '', '2020-04-15 14:31:23', '2020-04-15 11:31:23', '', 37, 'http://local-business.local/wp-content/uploads/2020/04/brioche-french-toast.jpg', 0, 'attachment', 'image/jpeg', 0),
(39, 1, '2020-04-16 16:09:57', '2020-04-16 13:09:57', 'a:7:{s:8:\"location\";a:1:{i:0;a:1:{i:0;a:3:{s:5:\"param\";s:9:\"post_type\";s:8:\"operator\";s:2:\"==\";s:5:\"value\";s:6:\"places\";}}}s:8:\"position\";s:6:\"normal\";s:5:\"style\";s:7:\"default\";s:15:\"label_placement\";s:3:\"top\";s:21:\"instruction_placement\";s:5:\"label\";s:14:\"hide_on_screen\";s:0:\"\";s:11:\"description\";s:0:\"\";}', 'Координати', 'koordynaty', 'publish', 'closed', 'closed', '', 'group_5e98580e44e3a', '', '', '2020-04-16 16:09:57', '2020-04-16 13:09:57', '', 0, 'http://local-business.local/?post_type=acf-field-group&#038;p=39', 2, 'acf-field-group', '', 0),
(40, 1, '2020-04-16 16:09:57', '2020-04-16 13:09:57', 'a:12:{s:4:\"type\";s:6:\"number\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:1;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:3:\"min\";i:-90;s:3:\"max\";i:90;s:4:\"step\";s:0:\"\";}', 'Широта', 'coord_lattitude', 'publish', 'closed', 'closed', '', 'field_5e98582cc5c46', '', '', '2020-04-16 16:09:57', '2020-04-16 13:09:57', '', 39, 'http://local-business.local/?post_type=acf-field&p=40', 0, 'acf-field', '', 0),
(41, 1, '2020-04-16 16:09:57', '2020-04-16 13:09:57', 'a:12:{s:4:\"type\";s:6:\"number\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:1;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";s:7:\"prepend\";s:0:\"\";s:6:\"append\";s:0:\"\";s:3:\"min\";i:-180;s:3:\"max\";i:180;s:4:\"step\";s:0:\"\";}', 'Довгота', 'coord_longitude', 'publish', 'closed', 'closed', '', 'field_5e9858f0c5c47', '', '', '2020-04-16 16:09:57', '2020-04-16 13:09:57', '', 39, 'http://local-business.local/?post_type=acf-field&p=41', 1, 'acf-field', '', 0),
(42, 1, '2020-04-16 16:12:17', '2020-04-16 13:12:17', 'a:7:{s:4:\"type\";s:3:\"url\";s:12:\"instructions\";s:0:\"\";s:8:\"required\";i:0;s:17:\"conditional_logic\";i:0;s:7:\"wrapper\";a:3:{s:5:\"width\";s:0:\"\";s:5:\"class\";s:0:\"\";s:2:\"id\";s:0:\"\";}s:13:\"default_value\";s:0:\"\";s:11:\"placeholder\";s:0:\"\";}', 'Web', 'address_web', 'publish', 'closed', 'closed', '', 'field_5e985992d0776', '', '', '2020-04-16 16:12:17', '2020-04-16 13:12:17', '', 7, 'http://local-business.local/?post_type=acf-field&p=42', 2, 'acf-field', '', 0);

-- --------------------------------------------------------

--
-- Структура таблиці `wp_termmeta`
--

DROP TABLE IF EXISTS `wp_termmeta`;
CREATE TABLE IF NOT EXISTS `wp_termmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`meta_id`),
  KEY `term_id` (`term_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `wp_terms`
--

DROP TABLE IF EXISTS `wp_terms`;
CREATE TABLE IF NOT EXISTS `wp_terms` (
  `term_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `slug` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_id`),
  KEY `slug` (`slug`(191)),
  KEY `name` (`name`(191))
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп даних таблиці `wp_terms`
--

INSERT INTO `wp_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES
(1, 'Без категорії', 'uncategorized', 0),
(2, 'Кав\'ярні', 'coffee-shops', 0),
(3, 'Спортзали', 'gyms', 0),
(4, 'Магазини', 'shops', 0);

-- --------------------------------------------------------

--
-- Структура таблиці `wp_term_relationships`
--

DROP TABLE IF EXISTS `wp_term_relationships`;
CREATE TABLE IF NOT EXISTS `wp_term_relationships` (
  `object_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп даних таблиці `wp_term_relationships`
--

INSERT INTO `wp_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(1, 1, 0),
(36, 2, 0),
(37, 2, 0);

-- --------------------------------------------------------

--
-- Структура таблиці `wp_term_taxonomy`
--

DROP TABLE IF EXISTS `wp_term_taxonomy`;
CREATE TABLE IF NOT EXISTS `wp_term_taxonomy` (
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `description` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп даних таблиці `wp_term_taxonomy`
--

INSERT INTO `wp_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'category', '', 0, 1),
(2, 2, 'category', '', 0, 2),
(3, 3, 'category', '', 0, 0),
(4, 4, 'category', '', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблиці `wp_usermeta`
--

DROP TABLE IF EXISTS `wp_usermeta`;
CREATE TABLE IF NOT EXISTS `wp_usermeta` (
  `umeta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп даних таблиці `wp_usermeta`
--

INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'nickname', 'svirom'),
(2, 1, 'first_name', ''),
(3, 1, 'last_name', ''),
(4, 1, 'description', ''),
(5, 1, 'rich_editing', 'true'),
(6, 1, 'syntax_highlighting', 'true'),
(7, 1, 'comment_shortcuts', 'false'),
(8, 1, 'admin_color', 'fresh'),
(9, 1, 'use_ssl', '0'),
(10, 1, 'show_admin_bar_front', 'true'),
(11, 1, 'locale', ''),
(12, 1, 'wp_capabilities', 'a:1:{s:13:\"administrator\";b:1;}'),
(13, 1, 'wp_user_level', '10'),
(14, 1, 'dismissed_wp_pointers', ''),
(15, 1, 'show_welcome_panel', '1'),
(16, 1, 'session_tokens', 'a:1:{s:64:\"6e02afdee8c4cf5fe04d6c745c7c5612cdf880ca5169056d6569bcc7b43bcfd9\";a:4:{s:10:\"expiration\";i:1587202684;s:2:\"ip\";s:9:\"127.0.0.1\";s:2:\"ua\";s:114:\"Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36\";s:5:\"login\";i:1587029884;}}'),
(17, 1, 'wp_dashboard_quick_press_last_post_id', '4'),
(18, 1, 'community-events-location', 'a:1:{s:2:\"ip\";s:9:\"127.0.0.0\";}'),
(19, 1, 'enable_custom_fields', '1'),
(20, 1, 'wp_user-settings', 'libraryContent=browse'),
(21, 1, 'wp_user-settings-time', '1586860233'),
(22, 1, 'acf_user_settings', 'a:0:{}'),
(23, 1, 'closedpostboxes_coffee-shops', 'a:1:{i:0;s:23:\"acf-group_5e95aba2a8280\";}'),
(24, 1, 'metaboxhidden_coffee-shops', 'a:1:{i:0;s:7:\"slugdiv\";}'),
(25, 2, 'nickname', 'igor_kuzyo'),
(26, 2, 'first_name', ''),
(27, 2, 'last_name', ''),
(28, 2, 'description', ''),
(29, 2, 'rich_editing', 'true'),
(30, 2, 'syntax_highlighting', 'true'),
(31, 2, 'comment_shortcuts', 'false'),
(32, 2, 'admin_color', 'fresh'),
(33, 2, 'use_ssl', '0'),
(34, 2, 'show_admin_bar_front', 'true'),
(35, 2, 'locale', ''),
(36, 2, 'wp_capabilities', 'a:1:{s:13:\"administrator\";b:1;}'),
(37, 2, 'wp_user_level', '10'),
(38, 2, 'dismissed_wp_pointers', '');

-- --------------------------------------------------------

--
-- Структура таблиці `wp_users`
--

DROP TABLE IF EXISTS `wp_users`;
CREATE TABLE IF NOT EXISTS `wp_users` (
  `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_pass` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_nicename` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_email` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_url` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`),
  KEY `user_email` (`user_email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп даних таблиці `wp_users`
--

INSERT INTO `wp_users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES
(1, 'svirom', '$P$B/VyIgTnNzFiK3XnrRyiaWQ6zL2Din.', 'svirom', 'svjatoslav.romanjuk@gmail.com', 'http://local-business.local', '2020-04-14 08:47:08', '', 0, 'svirom'),
(2, 'igor_kuzyo', '$P$BFmtx8mX8qvvx/GCmmxye.k2F50Utq/', 'igor_kuzyo', 'svirom@yahoo.com', '', '2020-04-15 14:31:28', '', 0, 'igor_kuzyo');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
