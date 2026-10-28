-- Encore Events Database Export
SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `decoration_item_event_team`;
CREATE TABLE `decoration_item_event_team` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `decoration_item_id` bigint unsigned NOT NULL,
  `event_team_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `decoration_item_event_team_unique` (`decoration_item_id`,`event_team_id`),
  KEY `decoration_item_event_team_event_team_id_foreign` (`event_team_id`),
  CONSTRAINT `decoration_item_event_team_decoration_item_id_foreign` FOREIGN KEY (`decoration_item_id`) REFERENCES `decoration_items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `decoration_item_event_team_event_team_id_foreign` FOREIGN KEY (`event_team_id`) REFERENCES `event_teams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `decoration_items`;
CREATE TABLE `decoration_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `subcategory_id` bigint unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `fixed_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `decoration_items_category_id_foreign` (`category_id`),
  KEY `decoration_items_subcategory_id_foreign` (`subcategory_id`),
  CONSTRAINT `decoration_items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `decoration_items_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `district_event_team`;
CREATE TABLE `district_event_team` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `district_id` bigint unsigned NOT NULL,
  `event_team_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `district_event_team_unique` (`district_id`,`event_team_id`),
  KEY `district_event_team_event_team_id_foreign` (`event_team_id`),
  CONSTRAINT `district_event_team_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `district_event_team_event_team_id_foreign` FOREIGN KEY (`event_team_id`) REFERENCES `event_teams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `districts`;
CREATE TABLE `districts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `districts` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES ('1', 'Alappuzha', '2026-10-12 17:00:43', '2026-10-12 17:00:43', NULL);
INSERT INTO `districts` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES ('2', 'Ernakulam', '2026-10-12 17:00:43', '2026-10-12 17:00:43', NULL);
INSERT INTO `districts` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES ('3', 'Idukki', '2026-10-12 17:00:43', '2026-10-12 17:00:43', NULL);
INSERT INTO `districts` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES ('4', 'Kannur', '2026-10-12 17:00:43', '2026-10-12 17:00:43', NULL);
INSERT INTO `districts` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES ('5', 'Kasaragod', '2026-10-12 17:00:43', '2026-10-12 17:00:43', NULL);
INSERT INTO `districts` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES ('6', 'Kollam', '2026-10-12 17:00:43', '2026-10-12 17:00:43', NULL);
INSERT INTO `districts` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES ('7', 'Kottayam', '2026-10-12 17:00:43', '2026-10-12 17:00:43', NULL);
INSERT INTO `districts` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES ('8', 'Kozhikode', '2026-10-12 17:00:43', '2026-10-12 17:00:43', NULL);
INSERT INTO `districts` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES ('9', 'Malappuram', '2026-10-12 17:00:43', '2026-10-12 17:00:43', NULL);
INSERT INTO `districts` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES ('10', 'Palakkad', '2026-10-12 17:00:43', '2026-10-12 17:00:43', NULL);
INSERT INTO `districts` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES ('11', 'Pathanamthitta', '2026-10-12 17:00:43', '2026-10-12 17:00:43', NULL);
INSERT INTO `districts` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES ('12', 'Thiruvananthapuram', '2026-10-12 17:00:43', '2026-10-12 17:00:43', NULL);
INSERT INTO `districts` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES ('13', 'Thrissur', '2026-10-12 17:00:43', '2026-10-12 17:00:43', NULL);
INSERT INTO `districts` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES ('14', 'Wayanad', '2026-10-12 17:00:43', '2026-10-12 17:00:43', NULL);

DROP TABLE IF EXISTS `event_estimations`;
CREATE TABLE `event_estimations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `event_id` bigint unsigned NOT NULL,
  `seating_id` bigint unsigned DEFAULT NULL,
  `guest_count` int NOT NULL,
  `catering_boys` tinyint(1) NOT NULL DEFAULT '0',
  `selected_items` json NOT NULL,
  `decoration_items` json DEFAULT NULL,
  `food_items` json DEFAULT NULL,
  `service_items` json DEFAULT NULL,
  `decoration_items_count` int NOT NULL DEFAULT '0',
  `food_items_count` int NOT NULL DEFAULT '0',
  `service_items_count` int NOT NULL DEFAULT '0',
  `decoration_items_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `food_items_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `service_items_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `item_details` json NOT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  `food_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `decoration_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `service_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `catering_boys_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_estimations_user_id_foreign` (`user_id`),
  KEY `event_estimations_event_id_foreign` (`event_id`),
  KEY `event_estimations_seating_id_foreign` (`seating_id`),
  CONSTRAINT `event_estimations_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  CONSTRAINT `event_estimations_seating_id_foreign` FOREIGN KEY (`seating_id`) REFERENCES `seatings` (`id`) ON DELETE SET NULL,
  CONSTRAINT `event_estimations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `event_teams`;
CREATE TABLE `event_teams` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `event_date` date NOT NULL,
  `district_id` bigint unsigned NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `events_user_id_foreign` (`user_id`),
  KEY `events_district_id_foreign` (`district_id`),
  CONSTRAINT `events_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `events_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

DROP TABLE IF EXISTS `food_items`;
CREATE TABLE `food_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `subcategory_id` bigint unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `amount_per_person` decimal(10,2) NOT NULL DEFAULT '0.00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `food_items_category_id_foreign` (`category_id`),
  KEY `food_items_subcategory_id_foreign` (`subcategory_id`),
  CONSTRAINT `food_items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `food_items_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `galleries`;
CREATE TABLE `galleries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('2', '2014_10_12_100000_create_password_reset_tokens_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('3', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('4', '2019_08_19_000000_create_failed_jobs_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('5', '2019_12_14_000001_create_personal_access_tokens_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('6', '2025_09_19_100130_add_is_admin_to_users_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('7', '2025_09_19_100224_create_districts_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('8', '2025_09_19_100226_create_event_teams_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('9', '2025_09_19_100228_create_categories_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('10', '2025_09_19_100231_create_decoration_items_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('11', '2025_09_19_100233_create_service_items_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('12', '2025_09_19_100235_create_food_items_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('13', '2025_09_19_100350_create_district_event_team_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('14', '2025_09_24_043742_add_profile_picture_to_users_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('15', '2025_09_25_044201_create_team_members_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('16', '2025_09_25_114027_create_events_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('17', '2025_09_26_100501_create_event_estimations_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('18', '2025_09_26_105632_add_detailed_fields_to_event_estimations_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('19', '2025_09_30_102527_add_phone_to_users_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('20', '2025_09_30_102534_add_phone_to_users_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('21', '2025_09_30_105016_make_email_nullable_in_users_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('22', '2025_10_01_051214_add_columns_to_items_tables', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('23', '2025_10_01_111420_create_reviews_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('24', '2025_10_01_112345_add_approval_status_to_reviews_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('25', '2025_10_07_052253_make_password_nullable_in_users_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('26', '2025_10_07_075516_create_decoration_item_event_team_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('27', '2025_10_07_075534_create_service_item_event_team_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('28', '2025_10_07_075623_remove_event_team_id_from_items_tables', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('29', '2025_10_07_093034_create_settings_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('30', '2025_10_15_111711_create_galleries_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('31', '2025_10_15_112550_remove_title_and_alt_text_from_galleries_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('32', '2025_10_15_112805_remove_description_from_galleries_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('33', '2025_10_28_120000_add_parent_id_to_categories_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('34', '2025_10_28_121000_create_subcategories_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('35', '2025_10_28_121100_add_subcategory_id_to_items_tables', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('36', '2025_11_22_183802_create_seatings_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('37', '2025_11_22_183803_create_seating_images_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('38', '2025_11_23_000000_add_seating_id_to_event_estimations_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('39', '2026_10_12_143604_add_columns_to_districts_and_related_tables', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('40', '2026_10_12_155652_add_is_admin_to_users_table', '2');

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `rating` int unsigned NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `admin_notes` text COLLATE utf8mb4_unicode_ci,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reviewed_by` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reviews_user_id_unique` (`user_id`),
  KEY `reviews_reviewed_by_foreign` (`reviewed_by`),
  CONSTRAINT `reviews_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `seating_images`;
CREATE TABLE `seating_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `seating_id` bigint unsigned NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `seating_images_seating_id_foreign` (`seating_id`),
  CONSTRAINT `seating_images_seating_id_foreign` FOREIGN KEY (`seating_id`) REFERENCES `seatings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `seatings`;
CREATE TABLE `seatings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `catering_boy_per_head` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `service_item_event_team`;
CREATE TABLE `service_item_event_team` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `service_item_id` bigint unsigned NOT NULL,
  `event_team_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `service_item_event_team_unique` (`service_item_id`,`event_team_id`),
  KEY `service_item_event_team_event_team_id_foreign` (`event_team_id`),
  CONSTRAINT `service_item_event_team_event_team_id_foreign` FOREIGN KEY (`event_team_id`) REFERENCES `event_teams` (`id`) ON DELETE CASCADE,
  CONSTRAINT `service_item_event_team_service_item_id_foreign` FOREIGN KEY (`service_item_id`) REFERENCES `service_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `service_items`;
CREATE TABLE `service_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `subcategory_id` bigint unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `fixed_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_items_category_id_foreign` (`category_id`),
  KEY `service_items_subcategory_id_foreign` (`subcategory_id`),
  CONSTRAINT `service_items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `service_items_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_active`, `created_at`, `updated_at`) VALUES ('1', 'facebook_url', '', 'url', 'social', 'Facebook URL', 'Your Facebook page URL', '1', '2026-10-12 17:00:43', '2026-10-12 17:00:43');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_active`, `created_at`, `updated_at`) VALUES ('2', 'instagram_url', '', 'url', 'social', 'Instagram URL', 'Your Instagram profile URL', '1', '2026-10-12 17:00:43', '2026-10-12 17:00:43');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_active`, `created_at`, `updated_at`) VALUES ('3', 'twitter_url', '', 'url', 'social', 'Twitter URL', 'Your Twitter profile URL', '1', '2026-10-12 17:00:43', '2026-10-12 17:00:43');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_active`, `created_at`, `updated_at`) VALUES ('4', 'linkedin_url', '', 'url', 'social', 'LinkedIn URL', 'Your LinkedIn profile URL', '1', '2026-10-12 17:00:43', '2026-10-12 17:00:43');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_active`, `created_at`, `updated_at`) VALUES ('5', 'youtube_url', '', 'url', 'social', 'YouTube URL', 'Your YouTube channel URL', '1', '2026-10-12 17:00:43', '2026-10-12 17:00:43');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_active`, `created_at`, `updated_at`) VALUES ('6', 'company_phone', '+91 123 456 7890', 'phone', 'contact', 'Company Phone', 'Main business phone number', '1', '2026-10-12 17:00:43', '2026-10-12 17:00:43');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_active`, `created_at`, `updated_at`) VALUES ('7', 'company_email', 'info@encoreevents.com', 'email', 'contact', 'Company Email', 'Main business email address', '1', '2026-10-12 17:00:43', '2026-10-12 17:00:43');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_active`, `created_at`, `updated_at`) VALUES ('8', 'company_address', 'Encore Complex, Arimbra Manangatta', 'text', 'contact', 'Company Address', 'Business address', '1', '2026-10-12 17:00:43', '2026-10-12 17:00:43');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_active`, `created_at`, `updated_at`) VALUES ('9', 'company_pin', '673638', 'text', 'contact', 'Company PIN', 'Postal/ZIP code', '1', '2026-10-12 17:00:43', '2026-10-12 17:00:43');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_active`, `created_at`, `updated_at`) VALUES ('10', 'company_website', '', 'url', 'contact', 'Company Website', 'Main company website URL', '1', '2026-10-12 17:00:43', '2026-10-12 17:00:43');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_active`, `created_at`, `updated_at`) VALUES ('11', 'company_name', 'Encore Events', 'text', 'general', 'Company Name', 'Your company name', '1', '2026-10-12 17:00:43', '2026-10-12 17:00:43');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `label`, `description`, `is_active`, `created_at`, `updated_at`) VALUES ('12', 'company_tagline', 'Creating Memorable Events', 'text', 'general', 'Company Tagline', 'Your company tagline or slogan', '1', '2026-10-12 17:00:43', '2026-10-12 17:00:43');

DROP TABLE IF EXISTS `subcategories`;
CREATE TABLE `subcategories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subcategories_category_id_foreign` (`category_id`),
  CONSTRAINT `subcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `team_members`;
CREATE TABLE `team_members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `team_members` (`id`, `name`, `designation`, `photo`, `created_at`, `updated_at`) VALUES ('1', 'Sarah Johnson', 'Event Coordinator', NULL, '2026-10-12 17:00:43', '2026-10-12 17:00:43');
INSERT INTO `team_members` (`id`, `name`, `designation`, `photo`, `created_at`, `updated_at`) VALUES ('2', 'Michael Chen', 'Wedding Planner', NULL, '2026-10-12 17:00:43', '2026-10-12 17:00:43');
INSERT INTO `team_members` (`id`, `name`, `designation`, `photo`, `created_at`, `updated_at`) VALUES ('3', 'Emily Rodriguez', 'Floral Designer', NULL, '2026-10-12 17:00:43', '2026-10-12 17:00:43');
INSERT INTO `team_members` (`id`, `name`, `designation`, `photo`, `created_at`, `updated_at`) VALUES ('4', 'David Thompson', 'Catering Manager', NULL, '2026-10-12 17:00:43', '2026-10-12 17:00:43');
INSERT INTO `team_members` (`id`, `name`, `designation`, `photo`, `created_at`, `updated_at`) VALUES ('5', 'Lisa Wang', 'Photography Director', NULL, '2026-10-12 17:00:43', '2026-10-12 17:00:43');
INSERT INTO `team_members` (`id`, `name`, `designation`, `photo`, `created_at`, `updated_at`) VALUES ('6', 'James Wilson', 'Audio/Visual Specialist', NULL, '2026-10-12 17:00:43', '2026-10-12 17:00:43');
INSERT INTO `team_members` (`id`, `name`, `designation`, `photo`, `created_at`, `updated_at`) VALUES ('7', 'Maria Garcia', 'Venue Coordinator', NULL, '2026-10-12 17:00:43', '2026-10-12 17:00:43');
INSERT INTO `team_members` (`id`, `name`, `designation`, `photo`, `created_at`, `updated_at`) VALUES ('8', 'Robert Brown', 'Transportation Manager', NULL, '2026-10-12 17:00:43', '2026-10-12 17:00:43');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `profile_picture`, `email_verified_at`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES ('2', 'Admin User', 'admin@encoreevent.com', NULL, NULL, NULL, '$2y$10$u4IF3BhQJrR/GwPZgvcmpuTQ0kmuvKS1RRakuFyJZMFJ2bAgL9m1y', '1', NULL, '2026-10-12 15:57:15', '2026-10-12 15:57:15');

SET FOREIGN_KEY_CHECKS=1;
