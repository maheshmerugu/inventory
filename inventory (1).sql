-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Mar 21, 2024 at 02:42 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `courts_complexes`
--

CREATE TABLE `courts_complexes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `district_id` bigint(20) UNSIGNED DEFAULT NULL,
  `complex_name` varchar(30) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courts_complexes`
--

INSERT INTO `courts_complexes` (`id`, `district_id`, `complex_name`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 'A', '1', '2024-03-16 06:51:59', '2024-03-16 06:51:59'),
(3, 2, 'B', '1', '2024-03-16 06:52:09', '2024-03-17 22:56:28'),
(4, 4, 'C', '1', '2024-03-17 22:53:32', '2024-03-17 22:53:32'),
(7, 4, 'D', '1', '2024-03-17 22:56:17', '2024-03-17 22:56:17'),
(8, 1, 'C', '1', '2024-03-17 23:16:31', '2024-03-17 23:16:31'),
(9, 7, 'c1', '1', '2024-03-20 03:56:47', '2024-03-20 03:56:47');

-- --------------------------------------------------------

--
-- Table structure for table `courts_masters`
--

CREATE TABLE `courts_masters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `district_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 - Active, 0 - Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courts_masters`
--

INSERT INTO `courts_masters` (`id`, `district_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(6, '2', 'Court44', 1, '2024-03-16 10:13:36', '2024-03-20 00:48:31'),
(7, '1', 'court2', 1, '2024-03-17 22:58:06', '2024-03-17 22:58:06'),
(9, '7', 'Courtn', 1, '2024-03-20 03:58:18', '2024-03-20 03:58:18'),
(10, '7', 'Demo1', 0, '2024-03-20 05:57:34', '2024-03-20 05:58:26');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 - Active, 0 - Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ADILABAD', 1, NULL, NULL),
(2, 'BHADRADRI KOTHAGUDEM', 1, '2024-03-16 10:12:41', NULL),
(4, 'Hanumakonda', 1, '2024-03-17 22:51:28', '2024-03-17 22:51:28'),
(6, 'Hyderabad', 1, '2024-03-17 22:52:39', '2024-03-17 22:52:39'),
(7, 'Khammam', 1, '2024-03-20 03:56:25', '2024-03-20 03:56:25');

-- --------------------------------------------------------

--
-- Table structure for table `employee_masters`
--

CREATE TABLE `employee_masters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_code` varchar(255) NOT NULL,
  `employee_name` varchar(255) DEFAULT NULL,
  `employee_designation` varchar(255) DEFAULT NULL,
  `employee_mobile` varchar(255) DEFAULT NULL,
  `employee_email` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 - Active, 0 - Inactive',
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_requests`
--

CREATE TABLE `inventory_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 - initiated, 1 - received,2 - rejected',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventory_requests`
--

INSERT INTO `inventory_requests` (`id`, `subject`, `message`, `created_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'gasdfgdfg', 'xcbxcvbxcvbxcvb', '1', 0, '2024-03-16 00:01:54', '2024-03-16 00:01:54'),
(2, 'cxvxcv', 'xcvxcvxcvxcv', '2', 0, '2024-03-16 00:02:31', '2024-03-16 00:02:31');

-- --------------------------------------------------------

--
-- Table structure for table `item_entries`
--

CREATE TABLE `item_entries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_code` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `serial_number` varchar(255) NOT NULL,
  `amc_warrenty` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1 - Installed, 0 - Delivered',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_groups`
--

CREATE TABLE `item_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_code` varchar(255) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `group_short_name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 - Active, 0 - Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_groups`
--

INSERT INTO `item_groups` (`id`, `group_code`, `group_name`, `group_short_name`, `status`, `created_at`, `updated_at`) VALUES
(1, '42', 'computers', 'dfgd', 1, '2024-03-13 07:05:48', '2024-03-13 07:05:48'),
(2, '4', 'a', 'uyuiy', 1, '2024-03-14 01:42:42', '2024-03-14 01:42:42'),
(3, '4', 'a', 'uyuiy', 1, '2024-03-14 01:43:21', '2024-03-14 01:43:21'),
(4, '4234234', 'test group sadfgasf', 'uyuiy', 1, '2024-03-14 01:44:42', '2024-03-14 01:44:42'),
(5, '4232s', 'gsdf', 'mahesh', 2, '2024-03-15 02:18:55', '2024-03-15 02:18:55'),
(6, '4232', 'gsdf', 'mahesh', 1, '2024-03-15 02:19:20', '2024-03-15 02:19:20'),
(7, '4', 'gsdf', 'uyuiy', 1, '2024-03-15 02:19:30', '2024-03-18 02:15:32');

-- --------------------------------------------------------

--
-- Table structure for table `item_masters`
--

CREATE TABLE `item_masters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `pn` int(11) DEFAULT NULL,
  `critical` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 - Active, 0 - InActive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `location_masters`
--

CREATE TABLE `location_masters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location_code` varchar(255) NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `location_short_name` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 - Active, 0 - Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `location_masters`
--

INSERT INTO `location_masters` (`id`, `location_code`, `location_name`, `location_short_name`, `district`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 'M123', 'Madhapur', 'MMS', '1', 'Sri Sai Hostel Mahapur.', 1, '2024-03-18 02:34:11', '2024-03-18 02:34:11'),
(2, 'DC123', 'Durugum Cheruvu', 'DC', '1', 'Krishhie Sapphire', 0, '2024-03-18 02:48:47', '2024-03-18 02:48:56');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_02_26_071310_create_item_groups_table', 1),
(6, '2024_03_11_043324_create_vendor_masters_table', 1),
(7, '2024_03_11_090227_create_location_masters_table', 1),
(8, '2024_03_12_045620_create_employee_masters_table', 1),
(9, '2024_03_12_090617_create_user_masters_table', 1),
(10, '2024_03_12_095228_create_districts_table', 1),
(11, '2024_03_12_115756_create_section_masters_table', 1),
(12, '2024_03_12_123344_create_courts_masters_table', 1),
(13, '2024_03_13_102731_create_permission_tables', 1),
(14, '2024_03_13_102842_create_products_table', 1),
(15, '2014_10_12_100000_create_password_resets_table', 2),
(16, '2024_03_14_095544_create_item_entries_table', 3),
(17, '2024_03_15_073416_create_item_requests_table', 4),
(20, '2024_03_15_074242_create_inventory_requests_table', 5),
(21, '2024_03_16_072018_create_item_masters_table', 6),
(22, '2024_03_14_100713_create_courts_complex_table', 7),
(23, '2024_03_16_075647_create_courts_complexs_table', 8),
(27, '2024_03_16_075647_create_courts_complexes_table', 9),
(28, '2024_03_18_110644_create_user_roles_table', 10),
(29, '2024_03_13_110209_create_roles_table', 11),
(30, '2024_03_18_124046_create_roles_table', 12),
(31, '2024_03_19_063754_create_roles_table', 13),
(32, '2024_03_19_065530_create_roles_table', 14),
(33, '2024_03_19_071853_create_page_section_table', 15),
(34, '2024_03_19_073550_create_page_sections_table', 16),
(35, '2024_03_19_103304_create_pages_table', 17),
(36, '2024_03_19_124422_create_pages_table', 18),
(37, '2024_03_21_042012_create_item_masters_table', 19),
(38, '2024_03_21_042515_create_item_masters_table', 20),
(39, '2024_03_21_042852_create_item_masters_table', 21),
(40, '2024_03_21_044220_create_role_pages_table', 22),
(41, '2024_03_21_044733_create_role_pages_table', 23);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `page_name` varchar(255) NOT NULL,
  `page_url` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 - Active, 0 - InActive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page_section_id`, `page_name`, `page_url`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Create Users', 'http://localhost/inventory/users-master', 0, '2024-03-20 00:26:39', '2024-03-20 07:47:27'),
(2, 1, 'Item Master', 'http://localhost/inventory/item-masters-list', 1, '2024-03-20 00:27:37', '2024-03-20 00:27:37'),
(3, 1, 'Item Group', 'http://localhost/inventory/itemgroup', 1, '2024-03-20 00:27:37', '2024-03-20 02:27:11'),
(4, 2, 'Item Entry', 'http://localhost/inventory/item-entry-create', 1, '2024-03-20 03:32:53', '2024-03-20 03:32:53');

-- --------------------------------------------------------

--
-- Table structure for table `page_sections`
--

CREATE TABLE `page_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_section_name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 - Active, 0 - InActive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_sections`
--

INSERT INTO `page_sections` (`id`, `page_section_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Masters', 1, '2024-03-19 03:33:22', '2024-03-20 02:23:05'),
(2, 'Purchase History', 1, '2024-03-19 03:33:46', '2024-03-20 02:23:16');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'create-role', 'web', '2024-03-13 05:08:26', '2024-03-13 05:08:26'),
(2, 'edit-role', 'web', '2024-03-13 05:08:26', '2024-03-13 05:08:26'),
(3, 'delete-role', 'web', '2024-03-13 05:08:26', '2024-03-13 05:08:26'),
(4, 'create-user', 'web', '2024-03-13 05:08:26', '2024-03-13 05:08:26'),
(5, 'edit-user', 'web', '2024-03-13 05:08:26', '2024-03-13 05:08:26'),
(6, 'delete-user', 'web', '2024-03-13 05:08:26', '2024-03-13 05:08:26'),
(7, 'create-product', 'web', '2024-03-13 05:08:26', '2024-03-13 05:08:26'),
(8, 'edit-product', 'web', '2024-03-13 05:08:26', '2024-03-13 05:08:26'),
(9, 'delete-product', 'web', '2024-03-13 05:08:26', '2024-03-13 05:08:26'),
(10, 'create-item-group', 'web', NULL, NULL),
(11, 'edit-item-group', 'web', NULL, NULL),
(12, 'delete-item-group', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `role_short_name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 - Active, 0 - InActive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `role_short_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'adm', 0, '2024-03-19 01:26:21', '2024-03-19 01:26:21'),
(2, 'UserD', 'usrd', 1, '2024-03-19 01:26:39', '2024-03-19 01:28:01'),
(3, 'Captain', 'CC', 0, '2024-03-19 01:29:17', '2024-03-19 01:29:17'),
(4, 'Moderator', 'mmd', 1, '2024-03-19 01:32:10', '2024-03-19 01:32:10'),
(5, 'Class Captain', 'CC', 1, '2024-03-19 01:32:38', '2024-03-19 01:32:38'),
(6, 'Manager', 'mgr', 1, '2024-03-19 01:34:41', '2024-03-19 01:34:41'),
(7, 'Team Leader', 'TL', 1, '2024-03-19 04:21:21', '2024-03-19 04:22:18'),
(10, 'Demo', 'dd', 1, '2024-03-19 04:31:11', '2024-03-19 04:31:11'),
(12, 'Mahesh', 'MM', 1, '2024-03-21 06:13:44', '2024-03-21 06:13:44');

-- --------------------------------------------------------

--
-- Table structure for table `role_pages`
--

CREATE TABLE `role_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 - Active, 0 - InActive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_pages`
--

INSERT INTO `role_pages` (`id`, `role_id`, `page_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2024-03-21 05:53:01', '2024-03-21 05:53:01'),
(2, 1, 2, 1, '2024-03-21 05:53:01', '2024-03-21 05:53:01'),
(3, 1, 3, 1, '2024-03-21 05:53:01', '2024-03-21 05:53:01'),
(4, 1, 4, 1, '2024-03-21 05:53:01', '2024-03-21 05:53:01'),
(5, 12, 3, 1, '2024-03-21 06:14:22', '2024-03-21 06:14:22'),
(6, 12, 4, 1, '2024-03-21 06:14:22', '2024-03-21 06:14:22'),
(7, 5, 2, 1, NULL, NULL),
(8, 5, 3, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `section_masters`
--

CREATE TABLE `section_masters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 - Active, 0 - Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'superadmin@gmail.com', NULL, '$2y$12$JRAijntQnzwmc2cZUXej0eh1Vq7kgMUyudxbpV79v/A/SuCsElDQy', NULL, '2024-03-13 05:08:26', '2024-03-15 05:41:24'),
(2, 'admin', 'admin@gmail.com', NULL, '$2y$12$dBB9kprHJbfBLSvl2v2/6OKjZm47UGUBqsi.qEVmoTCt0qfZZFJie', NULL, '2024-03-13 05:08:26', '2024-03-13 05:08:26'),
(3, 'Abdul Muqeet', 'muqeet@allphptricks.com', NULL, '$2y$12$U0ugvQoZgRPW/StsCs2IJO5oXQpltpisvo0zjWwsW0XrGQphnuJFq', NULL, '2024-03-13 05:08:26', '2024-03-13 05:08:26'),
(4, 'mahesh', 'mahesh@gmail.com', NULL, '$2y$12$TZlLQFCCRnJCtIBvsgAk7eObWxhC61X1XRMa.GGRMj7MF/hyxGW7S', NULL, '2024-03-13 05:53:39', '2024-03-13 05:53:39');

-- --------------------------------------------------------

--
-- Table structure for table `user_masters`
--

CREATE TABLE `user_masters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_masters`
--

CREATE TABLE `vendor_masters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` varchar(255) NOT NULL,
  `vendor_name` varchar(255) NOT NULL,
  `vendor_email` varchar(255) NOT NULL,
  `vendor_phone` varchar(255) NOT NULL,
  `vendor_city` varchar(255) NOT NULL,
  `vendor_address` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 - Active, 0 - Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_masters`
--

INSERT INTO `vendor_masters` (`id`, `vendor_id`, `vendor_name`, `vendor_email`, `vendor_phone`, `vendor_city`, `vendor_address`, `status`, `created_at`, `updated_at`) VALUES
(1, '42134', 'sgsdf', 'mahesh@gmail.com', '8712186367', '1', '234', 0, '2024-03-14 07:33:17', '2024-03-14 07:33:17'),
(2, '123', 'LG', 'lg@gmail.com', '7878565644', '1', 'Madhapur', 1, '2024-03-18 02:21:31', '2024-03-18 02:21:31'),
(3, '22122', 'Sony', 'sony@gmail.com', '9131389382', '1', 'Durgum Cheruvu', 0, '2024-03-18 02:31:33', '2024-03-18 02:31:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courts_complexes`
--
ALTER TABLE `courts_complexes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courts_complexes_district_id_foreign` (`district_id`);

--
-- Indexes for table `courts_masters`
--
ALTER TABLE `courts_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_masters`
--
ALTER TABLE `employee_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inventory_requests`
--
ALTER TABLE `inventory_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_entries`
--
ALTER TABLE `item_entries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_groups`
--
ALTER TABLE `item_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_masters`
--
ALTER TABLE `item_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location_masters`
--
ALTER TABLE `location_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pages_page_section_id_foreign` (`page_section_id`);

--
-- Indexes for table `page_sections`
--
ALTER TABLE `page_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_pages`
--
ALTER TABLE `role_pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_pages_role_id_foreign` (`role_id`),
  ADD KEY `role_pages_page_id_foreign` (`page_id`);

--
-- Indexes for table `section_masters`
--
ALTER TABLE `section_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_masters`
--
ALTER TABLE `user_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_masters`
--
ALTER TABLE `vendor_masters`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courts_complexes`
--
ALTER TABLE `courts_complexes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `courts_masters`
--
ALTER TABLE `courts_masters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employee_masters`
--
ALTER TABLE `employee_masters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_requests`
--
ALTER TABLE `inventory_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item_entries`
--
ALTER TABLE `item_entries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_groups`
--
ALTER TABLE `item_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `item_masters`
--
ALTER TABLE `item_masters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `location_masters`
--
ALTER TABLE `location_masters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `page_sections`
--
ALTER TABLE `page_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `role_pages`
--
ALTER TABLE `role_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `section_masters`
--
ALTER TABLE `section_masters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_masters`
--
ALTER TABLE `user_masters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_masters`
--
ALTER TABLE `vendor_masters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courts_complexes`
--
ALTER TABLE `courts_complexes`
  ADD CONSTRAINT `courts_complexes_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_page_section_id_foreign` FOREIGN KEY (`page_section_id`) REFERENCES `page_sections` (`id`);

--
-- Constraints for table `role_pages`
--
ALTER TABLE `role_pages`
  ADD CONSTRAINT `role_pages_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_pages_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
