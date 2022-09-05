/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.20-MariaDB : Database - quiz_maker
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `exam_groups` */

DROP TABLE IF EXISTS `exam_groups`;

CREATE TABLE `exam_groups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exam_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=213 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `exam_groups` */

insert  into `exam_groups`(`id`,`group_name`,`exam_id`,`created_at`,`updated_at`) values 
(204,'Intro Group',86,'2021-07-16 07:14:18','2021-07-16 07:14:18'),
(205,'Question Group',86,'2021-07-16 07:14:18','2021-07-16 07:14:18'),
(206,'Results',86,'2021-07-16 07:14:19','2021-07-16 07:14:19'),
(210,'Intro Group',88,'2021-07-29 08:55:06','2021-07-29 08:55:06'),
(211,'Question Group',88,'2021-07-29 08:55:06','2021-07-29 08:55:06'),
(212,'Results',88,'2021-07-29 08:55:06','2021-07-29 08:55:06');

/*Table structure for table `exams` */

DROP TABLE IF EXISTS `exams`;

CREATE TABLE `exams` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `attempt_number` int(11) NOT NULL,
  `passing_score` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `theme_style` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `screen_height` int(11) DEFAULT NULL,
  `screen_width` int(11) DEFAULT NULL,
  `stuff_emails` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `downloaded` tinyint(4) NOT NULL,
  `published` tinyint(4) NOT NULL,
  `email_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exam_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `exams` */

insert  into `exams`(`id`,`name`,`description`,`author_id`,`status`,`attempt_number`,`passing_score`,`created_at`,`updated_at`,`theme_style`,`screen_height`,`screen_width`,`stuff_emails`,`downloaded`,`published`,`email_from`,`email_subject`,`email_comment`,`exam_icon`) values 
(86,'Text Exam 2',NULL,1,1,1,100,'2021-07-16 07:14:18','2021-07-29 08:56:41','background: unset; font-fmily:Calibri; color:rgb(0, 0, 0); background-image:url(\"http://localhost:8000/images/theme_backgrounds/abstract_beige - Copy.png\"); background-size: 100% 100%; background-repeat: no-repeat;',450,940,'rto@civilsafety.edu.au,robert@civilsafety.edu.au',0,1,'Civil Safety Assessment Desk','[%QUIZ_STATUS%] Test Quiz Results: \"%QUIZ_TITLE%\"','This is an automatically generated email from the Civil Safety Assessment Desk to report your assessment results. Please store this email in a safe place as you willy be required to produce it if asked by Civil Safety','http://localhost:8000/images/upload/60fd7fb76fcde.jpeg'),
(88,'Test Exam',NULL,1,1,1,100,'2021-07-29 08:55:06','2021-07-29 08:55:56',NULL,450,940,'rto@civilsafety.edu.au,robert@civilsafety.edu.au',0,1,'Civil Safety Assessment Desk','[%QUIZ_STATUS%] Test Quiz Results: \"%QUIZ_TITLE%\"','This is an automatically generated email from the Civil Safety Assessment Desk to report your assessment results. Please store this email in a safe place as you willy be required to produce it if asked by Civil Safety',NULL);

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2021_04_22_094331_create_permissions_table',1),
(5,'2021_04_22_094412_create_roles_table',1),
(6,'2021_04_22_095114_create_users_permissons_table',1),
(7,'2021_04_22_095253_create_users_roles_table',1),
(8,'2021_04_22_095437_create_roles_permissions_table',1),
(9,'2021_04_22_202403_update_users_add_active',1),
(10,'2021_04_23_054749_create_exams_table',1),
(11,'2021_04_23_095548_update_exams_table_update_some_fields',1),
(12,'2021_04_23_132803_create_quiz_type_table',1),
(13,'2021_04_23_141624_create_quizes_table',1),
(14,'2021_04_27_101508_update_quizes_table_add_some_fields',2),
(15,'2021_04_27_103010_create_quizes_answers_table',3),
(16,'2021_04_27_103202_create_answers_table',3),
(17,'2021_04_27_104041_create_quizes_answer_contents_table',3),
(18,'2021_04_27_104326_create_multi_choice_answer_contents_table',3),
(19,'2021_04_27_175554_drop_some_tables',4),
(20,'2021_04_27_175809_update_answers_table',5),
(21,'2021_04_27_180046_update_multi_choice_answer_contents_table',6),
(22,'2021_04_27_181016_update_quizes_table',7),
(23,'2021_04_28_200710_create_multi_response_answer_contents_table',8),
(24,'2021_04_28_201051_update_multi_response_answer_content_table',9),
(25,'2021_04_29_211602_create_numeric_answer_contents_table',10),
(26,'2021_05_04_235634_update_quizes_table_rename_some_fields',11),
(27,'2021_05_11_062811_drop_answers_table',11),
(28,'2021_05_11_063042_drop_multi_choice_answer_contents_table',12),
(29,'2021_05_11_063127_drop_multi_response_answer_contents_table',12),
(30,'2021_05_11_063231_drop_numeric_answer_contents_table',13),
(31,'2021_05_11_063557_update_quizes_table_delete_rename_add_many_fields',14),
(32,'2021_05_11_064814_create_exam_groups_table',15),
(33,'2021_05_11_091542_update_quizes_table_add_three_score_fields',16),
(34,'2021_05_14_011827_update_exams_table_add_theme_style_field',17),
(35,'2021_05_18_103621_update_quizes_table_add_fields_media_element_other_elements',18),
(36,'2021_05_18_194120_update_quizes_table_add_field_background_img',19),
(37,'2021_05_20_055945_update_quizes_table_add_two_fields_video_audio',20),
(38,'2021_05_20_104253_update_quizes_table_add_2_fields_video_element_audio_element',21),
(39,'2021_05_20_110731_update_exams_add_2_fields_screen_height_screen_width',21),
(40,'2021_05_28_084732_update_exams_table_add_field_stuff_emails',22),
(41,'2021_05_28_085409_update_exams_table_update_field_stuff_emails',23),
(42,'2016_06_01_000001_create_oauth_auth_codes_table',24),
(43,'2016_06_01_000002_create_oauth_access_tokens_table',24),
(44,'2016_06_01_000003_create_oauth_refresh_tokens_table',24),
(45,'2016_06_01_000004_create_oauth_clients_table',24),
(46,'2016_06_01_000005_create_oauth_personal_access_clients_table',24),
(47,'2021_06_19_033232_update_exams_table_add_fields_downloaded_and_published',25),
(48,'2021_07_01_064159_update_exams_table_add_3_fields',26),
(49,'2021_07_25_142506_update_exams_table_add_exam_icon_field',27),
(50,'2021_07_29_051548_create_users_exams_table',28),
(51,'2021_07_29_092655_update_exams_table_add_field_approved_exams',29),
(52,'2021_07_29_093021_update_users_table_add_field_approved_exams',30),
(53,'2021_07_29_170437_create_results_table',31);

/*Table structure for table `oauth_access_tokens` */

DROP TABLE IF EXISTS `oauth_access_tokens`;

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_access_tokens` */

insert  into `oauth_access_tokens`(`id`,`user_id`,`client_id`,`name`,`scopes`,`revoked`,`created_at`,`updated_at`,`expires_at`) values 
('330abac31f5e5717ceebc15264e876186e1ad0ffec8e2bc22c6121fce602968aa3f5ddda186eb5d6',6,1,'MyApp','[]',0,'2021-07-29 13:29:26','2021-07-29 13:29:26','2022-07-29 13:29:26'),
('34220f128f587e31cddb3d6b28f22b32e03714ea8e27d67e7f14d45731dcf57a0e26fbd8b88871e5',6,1,'MyApp','[]',0,'2021-07-16 00:05:39','2021-07-16 00:05:39','2022-07-16 00:05:39'),
('468c8b5f816a0e84638b9a899d4d6fef82202b4f8349c17c9c3ad38905aab118e3cec71e105ef1c7',6,1,'MyApp','[]',0,'2021-07-15 07:48:25','2021-07-15 07:48:25','2022-07-15 07:48:25'),
('5b4d5cbe58c1eb614294f01960eb65cbd0085a2521d7247e87b7f1ae1cd045bd3745732c59fb00f5',6,1,'MyApp','[]',0,'2021-07-29 03:55:41','2021-07-29 03:55:41','2022-07-29 03:55:41'),
('6616906b6b20a4c7596f02a8619760e5ebb52361ceefbb5067a0c8d022b1474f162f14959dbf34fb',6,1,'MyApp','[]',0,'2021-07-29 13:28:22','2021-07-29 13:28:22','2022-07-29 13:28:22'),
('90a736cf56cb5cc89cc82846dfdf968217511f97e66e003cac3b1b7b95b363055bda6a17bff9b756',6,1,'MyApp','[]',0,'2021-07-29 04:19:17','2021-07-29 04:19:17','2022-07-29 04:19:16'),
('98e81add880e6eabe68d84dfada8738f51ddedc179802b5ca0b5fdc5b053268a7623a36e8281e89d',6,1,'MyApp','[]',0,'2021-07-29 03:58:02','2021-07-29 03:58:02','2022-07-29 03:58:02'),
('c2ad138b9a4eebabf86fc70c017e18f248b6e498ddc8e85c797a1711439a0db6f14d5329f72c62cb',6,1,'MyApp','[]',0,'2021-07-29 03:58:38','2021-07-29 03:58:38','2022-07-29 03:58:38'),
('cc09e9795ee62176b63c0dad99e2144cd782f1f459db9b490c692034f4182590ea06af25a9c87c3e',6,1,'MyApp','[]',0,'2021-07-29 03:56:10','2021-07-29 03:56:10','2022-07-29 03:56:10');

/*Table structure for table `oauth_auth_codes` */

DROP TABLE IF EXISTS `oauth_auth_codes`;

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_auth_codes` */

/*Table structure for table `oauth_clients` */

DROP TABLE IF EXISTS `oauth_clients`;

CREATE TABLE `oauth_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_clients` */

insert  into `oauth_clients`(`id`,`user_id`,`name`,`secret`,`provider`,`redirect`,`personal_access_client`,`password_client`,`revoked`,`created_at`,`updated_at`) values 
(1,NULL,'Quiz Maker Personal Access Client','Ue2aO64A4BBC7eKeUGE8zYAj663gd7fuV1EMricy',NULL,'http://localhost',1,0,0,'2021-06-18 02:18:45','2021-06-18 02:18:45'),
(2,NULL,'Quiz Maker Password Grant Client','MxvuG4DshHgBzj09q5nxSnoASr7XAbAq74xAj0FV','users','http://localhost',0,1,0,'2021-06-18 02:18:45','2021-06-18 02:18:45');

/*Table structure for table `oauth_personal_access_clients` */

DROP TABLE IF EXISTS `oauth_personal_access_clients`;

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_personal_access_clients` */

insert  into `oauth_personal_access_clients`(`id`,`client_id`,`created_at`,`updated_at`) values 
(1,1,'2021-06-18 02:18:45','2021-06-18 02:18:45');

/*Table structure for table `oauth_refresh_tokens` */

DROP TABLE IF EXISTS `oauth_refresh_tokens`;

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_refresh_tokens` */

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permissions` */

/*Table structure for table `quiz_type` */

DROP TABLE IF EXISTS `quiz_type`;

CREATE TABLE `quiz_type` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `quiz_type` */

insert  into `quiz_type`(`id`,`name`,`description`,`created_at`,`updated_at`) values 
(1,'Multiple Choice',NULL,NULL,NULL),
(2,'Multiple Response',NULL,NULL,NULL),
(3,'True/False',NULL,NULL,NULL),
(4,'Short Answer',NULL,NULL,NULL),
(5,'Numeric',NULL,NULL,NULL),
(6,'Sequence',NULL,NULL,NULL),
(7,'Matching',NULL,NULL,NULL),
(8,'Fill in the Blanks',NULL,NULL,NULL),
(9,'Select from Lists',NULL,NULL,NULL),
(10,'Drag the Words',NULL,NULL,NULL),
(11,'Hotspot',NULL,NULL,NULL),
(12,'Info Slide',NULL,NULL,NULL),
(13,'Quiz Instructions',NULL,NULL,NULL),
(14,'Passed',NULL,NULL,NULL),
(15,'Failed',NULL,NULL,NULL),
(16,'User Info Form',NULL,NULL,NULL);

/*Table structure for table `quizes` */

DROP TABLE IF EXISTS `quizes`;

CREATE TABLE `quizes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `exam_group_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `question_element` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feedback_correct` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feedback_incorrect` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feedback_try_again` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `answer_element` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feedback_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branching` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `score` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attempts` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_limit_time` tinyint(1) DEFAULT NULL,
  `limit_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shuffle_answers` tinyint(1) DEFAULT NULL,
  `partially_correct` tinyint(1) DEFAULT NULL,
  `limit_number_response` tinyint(1) DEFAULT NULL,
  `case_sensitive` tinyint(1) DEFAULT NULL,
  `correct_score` int(11) DEFAULT NULL,
  `incorrect_score` int(11) DEFAULT NULL,
  `try_again_score` int(11) DEFAULT NULL,
  `media_element` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_elements` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `background_img` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `audio` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_element` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `audio_element` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1256 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `quizes` */

insert  into `quizes`(`id`,`exam_group_id`,`type_id`,`question_element`,`answer`,`feedback_correct`,`feedback_incorrect`,`feedback_try_again`,`media`,`created_at`,`updated_at`,`order`,`answer_element`,`question_type`,`feedback_type`,`branching`,`score`,`attempts`,`is_limit_time`,`limit_time`,`shuffle_answers`,`partially_correct`,`limit_number_response`,`case_sensitive`,`correct_score`,`incorrect_score`,`try_again_score`,`media_element`,`other_elements`,`background_img`,`video`,`audio`,`video_element`,`audio_element`) values 
(1235,204,16,'<div class=\"slide_view_question_element slide_view_group\" style=\"height: 70px;width: 80%;left: 10%;z-index: 3;overflow: hidden;padding:10px;position:absolute;\"><div contenteditable=\"true\" class=\"cancel_drag\">Enter Your Details</div></div>','[{\"field_name\":\"First Name\",\"condition\":\"mandatory\",\"field_type\":\"text\",\"choice_field\":[],\"value\":\"\",\"variable\":\"FIRST_NAME\"},{\"field_name\":\"Last Name\",\"condition\":\"mandatory\",\"field_type\":\"text\",\"choice_field\":[],\"value\":\"\",\"variable\":\"LAST_NAME\"},{\"field_name\":\"Course Type\",\"condition\":\"mandatory\",\"field_type\":\"choice\",\"choice_field\":[\"Full Course\",\"Refresher\",\"VOC\",\"RPL\"],\"value\":\"\",\"variable\":\"COURSE_TYPE\"},{\"field_name\":\"Email\",\"condition\":\"mandatory\",\"field_type\":\"email\",\"choice_field\":[],\"value\":\"\",\"variable\":\"EMAIL\"},{\"field_name\":\"Location\",\"condition\":\"mandatory\",\"field_type\":\"choice\",\"choice_field\":[\"Gold Coast\",\"Cairns\",\"Moranbah\",\"Mackay\",\"Townsville\",\"Weipa\",\"Gladstone\"],\"value\":\"\",\"variable\":\"LOCATION\"},{\"field_name\":\"Company\",\"condition\":\"optional\",\"field_type\":\"text\",\"choice_field\":[],\"value\":\"\",\"variable\":\"COMPANY\"},{\"field_name\":\"Date\",\"condition\":\"mandatory\",\"field_type\":\"text\",\"choice_field\":[],\"value\":\"\",\"variable\":\"DATE\"}]','That\'s right! You chose the correct response.','You did not choose the correct response.','You did not choose the correct response. Try again.',NULL,'2021-07-16 07:14:19','2021-07-18 13:46:34',0,'<div class=\"slide_view_answer_element slide_view_group\" style=\"width: 80%;top: 100px;left: 10%;z-index: 2;padding: 10px;position:absolute;overflow: hidden;\"><div class=\"col-md-12\" style=\"\"><form id=\"user_info\"><div id=\"user_FIRST_NAME_container\"><input type=\"text\" id=\"user_FIRST_NAME\" placeholder=\"First Name*\" value=\"\" required=\"\"></div><div id=\"user_LAST_NAME_container\"><input type=\"text\" id=\"user_LAST_NAME\" placeholder=\"Last Name*\" value=\"\" required=\"\"></div><div id=\"user_COURSE_TYPE_container\"><select id=\"user_COURSE_TYPE\" required=\"\"><option value=\"\" disabled=\"\">Course Type*</option><option value=\"Full Course\">Full Course</option><option value=\"Refresher\">Refresher</option><option value=\"VOC\">VOC</option><option value=\"RPL\">RPL</option></select></div><div id=\"user_EMAIL_container\"><input type=\"email\" id=\"user_EMAIL\" placeholder=\"Email*\" value=\"\" required=\"\"></div><div id=\"user_LOCATION_container\"><select id=\"user_LOCATION\" required=\"\"><option value=\"\" disabled=\"\">Location*</option><option value=\"Gold Coast\">Gold Coast</option><option value=\"Cairns\">Cairns</option><option value=\"Moranbah\">Moranbah</option><option value=\"Mackay\">Mackay</option><option value=\"Townsville\">Townsville</option><option value=\"Weipa\">Weipa</option><option value=\"Gladstone\">Gladstone</option></select></div><div id=\"user_COMPANY_container\"><input type=\"text\" id=\"user_COMPANY\" placeholder=\"Company\" value=\"\"></div><div id=\"user_DATE_container\"><input type=\"text\" id=\"user_DATE\" placeholder=\"Date*\" value=\"\" required=\"\"></div></form></div></div>','graded','by_result',NULL,NULL,'1',0,'01:00',NULL,0,NULL,NULL,0,0,0,'<div class=\"slide_view_media_element slide_view_group\" style=\"z-index: 1;display: none;position: absolute;top: 0;left: 0;width:33%;\">\n                        <img src=\"#\" alt=\"slide_view_media\" style=\"width: 100%; height: 100%; visibility: visible;\" data-nsfw-filter-status=\"sfw\">\n                    </div>',NULL,NULL,NULL,NULL,'<div class=\"slide_view_video_element slide_view_group\" style=\"z-index: 1;display: none;position: absolute;top: 0;left: 0;width:33%;\">\n                        <video controls=\"\" style=\"width: 100%;height: 100%\">\n                            <source src=\"#\">\n                        </video>\n                    </div>',NULL),
(1236,206,14,'<div class=\"slide_view_question_element slide_view_group\" style=\"height: 70px;width: 80%;left: 10%;z-index: 3;overflow: hidden;padding:10px;position:absolute;\"><div contenteditable=\"true\" class=\"cancel_drag\">Congratulations, you passed!</div></div>','','That\'s right! You chose the correct response.','You did not choose the correct response.','You did not choose the correct response. Try again.',NULL,'2021-07-16 07:14:19','2021-07-16 07:14:19',0,'<div class=\"slide_view_answer_element slide_view_group\" style=\"width: 80%;top: 100px;left: 10%;z-index: 2;padding: 10px;position:absolute;overflow: hidden;\"><div class=\"col-md-12\"><div contenteditable=\"true\"><div class=\"cancel_drag\">Your Score: %%</div><div class=\"cancel_drag\">Passing Score: ##</div></div></div></div>','graded','by_result',NULL,NULL,'1',0,NULL,NULL,0,NULL,NULL,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(1237,206,15,'<div class=\"slide_view_question_element slide_view_group\" style=\"height: 70px;width: 80%;left: 10%;z-index: 3;overflow: hidden;padding:10px;position:absolute;\"><div contenteditable=\"true\" class=\"cancel_drag\">You did not pass.</div></div>','','That\'s right! You chose the correct response.','You did not choose the correct response.','You did not choose the correct response. Try again.',NULL,'2021-07-16 07:14:19','2021-07-16 07:14:19',1,'<div class=\"slide_view_answer_element slide_view_group\" style=\"width: 80%;top: 100px;left: 10%;z-index: 2;padding: 10px;position:absolute;overflow: hidden;\"><div class=\"col-md-12\"><div contenteditable=\"true\"><div class=\"cancel_drag\">Your Score: %%</div><div class=\"cancel_drag\">Passing Score: ##</div></div></div></div>','graded','by_result',NULL,NULL,'1',0,NULL,NULL,0,NULL,NULL,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(1246,205,7,'<div class=\"slide_view_question_element slide_view_group ui-resizable ui-draggable ui-draggable-handle\" style=\"height: 70px;width: 80%;left: 10%;z-index: 3;overflow: hidden;padding:10px;position:absolute;\"><div contenteditable=\"true\" class=\"cancel_drag\">Match the following items with their descriptions:</div></div>','Item 1;Match 1@Item 2;Match 2@Item 3;Match 3@','That\'s right! You chose the correct response.','You did not choose the correct response.','You did not choose the correct response. Try again.',NULL,'2021-07-18 21:47:47','2021-07-18 21:48:09',0,'<div class=\"slide_view_answer_element slide_view_group ui-resizable ui-draggable ui-draggable-handle\" style=\"width: 80%;top: 100px;left: 10%;z-index: 2;position:absolute;overflow:hidden;\"><div class=\"col-md-12\" style=\"\"><div style=\"display: flex;justify-content: space-around;padding-bottom: 10px;\"><div class=\"ui-widget-header droppable\" style=\"width: 40%\"><p data-nsfw-filter-status=\"swf\">Item 1</p></div><div class=\"ui-widget-content draggable\" style=\"width: 40%\" isdropped=\"false\"><p data-nsfw-filter-status=\"swf\">Match 1</p></div></div><div style=\"display: flex;justify-content: space-around;padding-bottom: 10px;\"><div class=\"ui-widget-header droppable\" style=\"width: 40%\"><p data-nsfw-filter-status=\"swf\">Item 2</p></div><div class=\"ui-widget-content draggable\" style=\"width: 40%\" isdropped=\"false\"><p data-nsfw-filter-status=\"swf\">Match 2</p></div></div><div style=\"display: flex;justify-content: space-around;padding-bottom: 10px;\"><div class=\"ui-widget-header droppable\" style=\"width: 40%\"><p data-nsfw-filter-status=\"swf\">Item 3</p></div><div class=\"ui-widget-content draggable\" style=\"width: 40%\" isdropped=\"false\"><p data-nsfw-filter-status=\"swf\">Match 3</p></div></div></div></div>','graded','by_result',NULL,NULL,'1',0,'01:00',1,0,NULL,NULL,10,0,0,'<div class=\"slide_view_media_element slide_view_group\" style=\"z-index: 1;display: none;position: absolute;top: 0;left: 0;width:33%;\">\n                        <img src=\"#\" alt=\"slide_view_media\" style=\"width: 100%; height: 100%; visibility: visible;\" data-nsfw-filter-status=\"sfw\">\n                    </div>',NULL,NULL,NULL,NULL,'<div class=\"slide_view_video_element slide_view_group\" style=\"z-index: 1;display: none;position: absolute;top: 0;left: 0;width:33%;\">\n                        <video controls=\"\" style=\"width: 100%;height: 100%\">\n                            <source src=\"#\">\n                        </video>\n                    </div>',NULL),
(1247,205,10,'<div class=\"slide_view_question_element slide_view_group\" style=\"height: 70px;width: 80%;left: 10%;z-index: 3;overflow: hidden;padding:10px;position:absolute;\"><div contenteditable=\"true\" class=\"cancel_drag\">Drag and drop the words to their places:</div></div>','words;places;','That\'s right! You chose the correct response.','You did not choose the correct response.','You did not choose the correct response. Try again.',NULL,'2021-07-18 23:59:31','2021-07-18 23:59:50',1,'<div class=\"slide_view_answer_element slide_view_group\" style=\"width: 80%;top: 100px;left: 10%;z-index: 2;position:absolute;overflow:hidden;\"><div class=\"col-md-12\" style=\"\"><div id=\"slide_drag_words_question\">Drag the <div class=\"blank\" style=\"display: inline; width: 70px; height: 100%; border: 1px solid grey; background: white; padding-right: 70px;\"></div> and drop them to the appropriate <div class=\"blank\" style=\"display: inline; width: 70px; height: 100%; border: 1px solid grey; background: white; padding-right: 70px;\"></div> .</div><div id=\"slide_drag_words_answer\"><span style=\"border: 1px solid gray;background: white;color: black;\">words</span><span style=\"border: 1px solid gray;background: white;color: black;\">places</span></div></div></div>','graded','by_result',NULL,NULL,'1',0,'01:00',NULL,0,NULL,NULL,10,0,0,'<div class=\"slide_view_media_element slide_view_group\" style=\"z-index: 1;display: none;position: absolute;top: 0;left: 0;width:33%;\">\n                        <img src=\"#\" alt=\"slide_view_media\" style=\"width: 100%;height: 100%;\">\n                    </div>',NULL,NULL,NULL,NULL,'<div class=\"slide_view_video_element slide_view_group\" style=\"z-index: 1;display: none;position: absolute;top: 0;left: 0;width:33%;\">\n                        <video controls=\"\" style=\"width: 100%;height: 100%\">\n                            <source src=\"#\">\n                        </video>\n                    </div>',NULL),
(1251,210,16,'<div class=\"slide_view_question_element slide_view_group\" style=\"height: 70px;width: 80%;left: 10%;z-index: 3;overflow: hidden;padding:10px;position:absolute;\"><div contenteditable=\"true\" class=\"cancel_drag\">Enter Your Details</div></div>','[{\"field_name\": \"First Name\", \"condition\": \"mandatory\", \"field_type\": \"text\", \"choice_field\": [], \"value\": \"\", \"variable\": \"FIRST_NAME\"}, {\"field_name\": \"Last Name\", \"condition\": \"mandatory\", \"field_type\": \"text\", \"choice_field\": [], \"value\": \"\", \"variable\": \"LAST_NAME\"}, {\"field_name\": \"Course Type\", \"condition\": \"mandatory\", \"field_type\": \"choice\", \"choice_field\": [\"Full Course\", \"Refresher\", \"VOC\", \"RPL\"], \"value\": \"\", \"variable\": \"COURSE_TYPE\"}, {\"field_name\": \"Email\", \"condition\": \"mandatory\", \"field_type\": \"email\", \"choice_field\": [], \"value\": \"\", \"variable\": \"EMAIL\"}, {\"field_name\": \"Location\", \"condition\": \"mandatory\", \"field_type\": \"choice\", \"choice_field\": [\"Gold Coast\", \"Cairns\", \"Moranbah\", \"Mackay\", \"Townsville\", \"Weipa\", \"Gladstone\"], \"value\": \"\", \"variable\": \"LOCATION\"}, {\"field_name\": \"Company\", \"condition\": \"optional\", \"field_type\": \"text\", \"choice_field\": [], \"value\": \"\", \"variable\": \"COMPANY\"}, {\"field_name\": \"Date\", \"condition\": \"mandatory\", \"field_type\": \"text\", \"choice_field\": [], \"value\": \"\", \"variable\": \"DATE\"}]','That\'s right! You chose the correct response.','You did not choose the correct response.','You did not choose the correct response. Try again.',NULL,'2021-07-29 08:55:07','2021-07-29 08:55:07',0,'<div class=\"slide_view_answer_element slide_view_group\" style=\"width: 80%;top: 100px;left: 10%;z-index: 2;padding: 10px;position:absolute;overflow: hidden;\"><div class=\"col-md-12\"><form id=\"user_info\"><div id=\"user_first_name_container\"><input type=\"text\" id=\"user_FIRST_NAME\" placeholder=\"First Name*\" required></div><div id=\"user_last_name_container\"><input type=\"text\" id=\"user_LAST_NAME\" placeholder=\"Last Name*\" required></div><div id=\"user_email_container\"><input type=\"email\" id=\"user_EMAIL\" placeholder=\"Email*\" required></div><div id=\"user_course_type_container\"><select id=\"user_COURSE_TYPE\" required><option value=\"\" selected disabled>Course Type*</option><option value=\"full_course\">Full Course</option><option value=\"refresher\">Refresher</option><option value=\"voc\">VOC</option><option value=\"rpl\">RPL</option></select></div><div id=\"user_location_container\"><select id=\"user_LOCATION\" required><option value=\"\" selected disabled>Location*</option><option value=\"gold_coast\">Gold Coast</option><option value=\"cairns\">Cairns</option><option value=\"moranbah\">Moranbah</option><option value=\"mackay\">Mackay</option><option value=\"townsville\">Townsville</option><option value=\"weipa\">Weipa</option><option value=\"gladstone\">Gladstone</option></select></div><div id=\"user_company_container\"><input type=\"text\" id=\"user_COMPANY\" placeholder=\"Company\"></div><div id=\"user_date_container\"><input type=\"text\" id=\"user_DATE\" placeholder=\"Date*\" required></div></form></div></div>','graded','by_result',NULL,NULL,'1',0,NULL,NULL,0,NULL,NULL,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(1252,212,14,'<div class=\"slide_view_question_element slide_view_group\" style=\"height: 70px;width: 80%;left: 10%;z-index: 3;overflow: hidden;padding:10px;position:absolute;\"><div contenteditable=\"true\" class=\"cancel_drag\">Congratulations, you passed!</div></div>','','That\'s right! You chose the correct response.','You did not choose the correct response.','You did not choose the correct response. Try again.',NULL,'2021-07-29 08:55:07','2021-07-29 08:55:07',0,'<div class=\"slide_view_answer_element slide_view_group\" style=\"width: 80%;top: 100px;left: 10%;z-index: 2;padding: 10px;position:absolute;overflow: hidden;\"><div class=\"col-md-12\"><div contenteditable=\"true\"><div class=\"cancel_drag\">Your Score: %%</div><div class=\"cancel_drag\">Passing Score: ##</div></div></div></div>','graded','by_result',NULL,NULL,'1',0,NULL,NULL,0,NULL,NULL,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(1253,212,15,'<div class=\"slide_view_question_element slide_view_group\" style=\"height: 70px;width: 80%;left: 10%;z-index: 3;overflow: hidden;padding:10px;position:absolute;\"><div contenteditable=\"true\" class=\"cancel_drag\">You did not pass.</div></div>','','That\'s right! You chose the correct response.','You did not choose the correct response.','You did not choose the correct response. Try again.',NULL,'2021-07-29 08:55:07','2021-07-29 08:55:07',1,'<div class=\"slide_view_answer_element slide_view_group\" style=\"width: 80%;top: 100px;left: 10%;z-index: 2;padding: 10px;position:absolute;overflow: hidden;\"><div class=\"col-md-12\"><div contenteditable=\"true\"><div class=\"cancel_drag\">Your Score: %%</div><div class=\"cancel_drag\">Passing Score: ##</div></div></div></div>','graded','by_result',NULL,NULL,'1',0,NULL,NULL,0,NULL,NULL,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(1254,211,1,'<div class=\"slide_view_question_element slide_view_group\" style=\"height: 70px;width: 80%;left: 10%;z-index: 3;overflow: hidden;padding:10px;position:absolute;\"><div contenteditable=\"true\" class=\"cancel_drag\">Select the correct answer option:</div></div>','1','That\'s right! You chose the correct response.','You did not choose the correct response.','You did not choose the correct response. Try again.',NULL,'2021-07-29 08:55:22','2021-07-29 08:55:22',0,'<div class=\"slide_view_answer_element slide_view_group\" style=\"width: 80%;top: 100px;left: 10%;z-index: 2;position:absolute;overflow:hidden;\"><div class=\"col-md-12\"><div class=\"choice_item\"><input type=\"radio\" id=\"1\" name=\"answer\" value=\"1\" style=\"padding-right: 10px;\"><label for=\"1\">Option 1</label></div><div class=\"choice_item\"><input type=\"radio\" id=\"2\" name=\"answer\" value=\"2\" style=\"padding-right: 10px;\"><label for=\"2\">Option 2</label></div><div class=\"choice_item\"><input type=\"radio\" id=\"3\" name=\"answer\" value=\"3\" style=\"padding-right: 10px;\"><label for=\"3\">Option 3</label></div></div></div>','graded','by_result','by_result','by_result','1',0,NULL,1,NULL,NULL,NULL,10,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(1255,211,2,'<div class=\"slide_view_question_element slide_view_group\" style=\"height: 70px;width: 80%;left: 10%;z-index: 3;overflow: hidden;padding:10px;position:absolute;\"><div contenteditable=\"true\" class=\"cancel_drag\">Select one or more correct answers:</div></div>','1;','That\'s right! You chose the correct response.','You did not choose the correct response.','You did not choose the correct response. Try again.',NULL,'2021-07-29 08:55:29','2021-07-29 08:55:31',1,'<div class=\"slide_view_answer_element slide_view_group\" style=\"width: 80%;top: 100px;left: 10%;z-index: 2;position:absolute;overflow:hidden;\"><div class=\"col-md-12\" style=\"\"><div class=\"response_item\"><input type=\"checkbox\" id=\"1\" name=\"answer\" value=\"1\" style=\"padding-right: 10px;\"><label for=\"1\">Option 1</label></div><div class=\"response_item\"><input type=\"checkbox\" id=\"2\" name=\"answer\" value=\"2\" style=\"padding-right: 10px;\"><label for=\"2\">Option 2</label></div><div class=\"response_item\"><input type=\"checkbox\" id=\"3\" name=\"answer\" value=\"3\" style=\"padding-right: 10px;\"><label for=\"3\">Option 3</label></div></div></div>','graded','by_result',NULL,NULL,'1',0,'01:00',1,0,0,NULL,10,0,0,'<div class=\"slide_view_media_element slide_view_group\" style=\"z-index: 1;display: none;position: absolute;top: 0;left: 0;width:33%;\">\n                        <img src=\"#\" alt=\"slide_view_media\" style=\"width: 100%; height: 100%; visibility: visible;\" data-nsfw-filter-status=\"sfw\">\n                    </div>',NULL,NULL,NULL,NULL,'<div class=\"slide_view_video_element slide_view_group\" style=\"z-index: 1;display: none;position: absolute;top: 0;left: 0;width:33%;\">\n                        <video controls=\"\" style=\"width: 100%;height: 100%\">\n                            <source src=\"#\">\n                        </video>\n                    </div>',NULL);

/*Table structure for table `results` */

DROP TABLE IF EXISTS `results`;

CREATE TABLE `results` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `result` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `results` */

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`slug`,`created_at`,`updated_at`) values 
(1,'Administrator','manager',NULL,NULL),
(2,'Student','student',NULL,NULL);

/*Table structure for table `roles_permissions` */

DROP TABLE IF EXISTS `roles_permissions`;

CREATE TABLE `roles_permissions` (
  `role_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`permission_id`),
  KEY `roles_permissions_permission_id_foreign` (`permission_id`),
  CONSTRAINT `roles_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `roles_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles_permissions` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `approved_exams` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`,`active`,`approved_exams`) values 
(1,'Test Admin','manager@gmail.com',NULL,'$2y$10$B.gKC6KKUq6asvFJK4m3deBLqLtLrtksCAjY7yyIt8eClYgGAvXk6',NULL,NULL,NULL,1,NULL),
(6,'Sophie','bolesalavb@gmail.com',NULL,'$2y$10$WSQzjZbqn8wNVCSVxgaJpeB5rXb0Yeei.t8gi9XlhPdGY204m6R4m',NULL,'2021-05-28 08:40:01','2021-07-29 13:26:24',1,'88@');

/*Table structure for table `users_permissions` */

DROP TABLE IF EXISTS `users_permissions`;

CREATE TABLE `users_permissions` (
  `user_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`permission_id`),
  KEY `users_permissions_permission_id_foreign` (`permission_id`),
  CONSTRAINT `users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users_permissions` */

/*Table structure for table `users_roles` */

DROP TABLE IF EXISTS `users_roles`;

CREATE TABLE `users_roles` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `users_roles_role_id_foreign` (`role_id`),
  CONSTRAINT `users_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users_roles` */

insert  into `users_roles`(`user_id`,`role_id`) values 
(1,1),
(6,2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
