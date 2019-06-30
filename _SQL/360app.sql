-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2019 at 07:26 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `360app`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_06_24_083001_create_quotes_table', 1),
(4, '2019_06_24_091750_create_quote_photos_table', 1),
(5, '2019_06_24_092037_create_quote_items_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `id` int(10) UNSIGNED NOT NULL,
  `quote_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_contact` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_1` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_2` mediumtext COLLATE utf8mb4_unicode_ci,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_code` int(4) NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `comment` mediumtext COLLATE utf8mb4_unicode_ci,
  `draft_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=draft,1=approved,2=rejected,3=completed',
  `reject_reason` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`id`, `quote_number`, `c_name`, `c_email`, `c_contact`, `address_1`, `address_2`, `city`, `post_code`, `grand_total`, `tax`, `total`, `comment`, `draft_date`, `expiry_date`, `status`, `reject_reason`, `created_at`, `updated_at`) VALUES
(1, '157896', 'Shafna', 'shafi.2288@gmail.com', '0404489532', 'Unit 5/3, Atkell Ave, Campbelltown, SA, 5074', NULL, '', 0, '0.00', '0.00', '0.00', NULL, '0000-00-00', '0000-00-00', 2, NULL, '2019-06-25 02:21:54', '2019-06-27 04:02:01'),
(2, '157896', 'Shafna', 'shafi.2288@gmail.com', '0404489532', 'Unit 5/3, Atkell Ave', NULL, '', 0, '0.00', '0.00', '0.00', 'This is a comment', '0000-00-00', '2019-07-09', 2, NULL, '2019-06-25 02:56:45', '2019-06-27 03:58:37'),
(3, '157896', 'Shafna', 'shafi.2288@gmail.com', '0404489532', 'Unit 5/3, Atkell Ave', NULL, '', 0, '0.00', '0.00', '0.00', 'test comment', '0000-00-00', '2019-07-10', 0, NULL, '2019-06-25 23:18:24', '2019-06-25 23:18:24'),
(4, '157896', 'Shafna', 'shafi.2288@gmail.com', '0404489532', 'Unit 5/3, Atkell Ave', NULL, '', 0, '0.00', '0.00', '0.00', 'test comment', '0000-00-00', '2019-07-10', 0, NULL, '2019-06-25 23:18:48', '2019-06-25 23:18:48'),
(5, '157896', 'Shafna', 'shafi.2288@gmail.com', '0404489532', 'Unit 5/3, Atkell Ave', NULL, '', 0, '376.00', '37.60', '413.60', 'test comment', '0000-00-00', '2019-07-10', 0, NULL, '2019-06-26 01:04:22', '2019-06-26 01:04:22'),
(6, '157896', 'Shafna', 'shafi.2288@gmail.com', '0404489532', 'Unit 5/3, Atkell Ave', NULL, '', 0, '376.00', '37.60', '413.60', 'test comment', '0000-00-00', '2019-07-10', 0, NULL, '2019-06-26 01:06:04', '2019-06-26 01:06:04'),
(7, '157896', 'Shafna', 'shafi.2288@gmail.com', '0404489532', 'Unit 5/3, Atkell Ave', NULL, '', 0, '591.00', '59.10', '650.10', 'hello', '0000-00-00', '2019-07-10', 1, NULL, '2019-06-26 01:32:41', '2019-06-28 03:51:21'),
(8, '157896', 'Shafna', 'shafi.2288@gmail.com', '0404489532', 'Unit 5/3, Atkell Ave', NULL, '', 0, '15.00', '1.50', '16.50', 'test', '0000-00-00', '2019-07-10', 1, NULL, '2019-06-26 01:36:00', '2019-06-28 03:50:04'),
(9, '157896', 'Shafna Mikdar', 'shafi.2288@gmail.com', '0404489532', 'Unit 5/3, Atkell Ave, Campbelltown', NULL, '', 0, '316.00', '31.60', '347.60', 'Comment DESCRIPTION', '0000-00-00', '2019-07-10', 1, NULL, '2019-06-26 01:39:19', '2019-06-28 03:41:03'),
(10, '157896', 'Shafna', 'shafi.2288@gmail.com', '0404489532', 'Unit 5/3, Atkell Ave', NULL, '', 0, '759.00', '75.90', '834.90', 'Comment', '0000-00-00', '2019-07-10', 1, NULL, '2019-06-26 01:41:53', '2019-06-28 03:37:25'),
(11, '157896', 'Shafna', 'shafi.2288@gmail.com', '0404489532', 'Unit 5/3, Atkell Ave', NULL, '', 0, '646.00', '64.60', '710.60', 'Job Address', '0000-00-00', '2019-07-10', 1, NULL, '2019-06-26 03:22:05', '2019-06-27 03:54:44'),
(12, '157896', 'Shafna', 'shafnamikdar@outlook.com', '0404489532', 'Unit 5/3, Atkell Ave', NULL, 'Campbelltown', 5074, '140.00', '14.00', '154.00', 'yuyiyui', '0000-00-00', '2019-07-13', 1, 'Labour charges too much', '2019-06-27 20:54:57', '2019-06-29 08:02:23'),
(13, '157896', 'Thimalka Heshan', 'thimalkaheshan@gmail.com', '(040) 448-9532', 'Unit 5/3, Atkell Ave', NULL, 'Campbelltown', 5074, '2937.00', '293.70', '3230.70', NULL, '2019-06-29', '2019-07-13', 1, NULL, '2019-06-29 05:34:15', '2019-06-29 07:32:30');

-- --------------------------------------------------------

--
-- Table structure for table `quote_items`
--

CREATE TABLE `quote_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `quote_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `qty` int(10) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quote_items`
--

INSERT INTO `quote_items` (`id`, `quote_id`, `name`, `description`, `qty`, `unit_price`, `sub_total`, `created_at`, `updated_at`) VALUES
(1, 4, 'Labour', NULL, 0, '0.00', '0.00', '2019-06-25 23:18:49', '2019-06-25 23:18:49'),
(2, 4, 'Callout Fee', NULL, 0, '0.00', '0.00', '2019-06-25 23:18:49', '2019-06-25 23:18:49'),
(3, 4, 'Equipment', NULL, 0, '0.00', '0.00', '2019-06-25 23:18:49', '2019-06-25 23:18:49'),
(4, 4, 'Travel', NULL, 0, '0.00', '0.00', '2019-06-25 23:18:49', '2019-06-25 23:18:49'),
(5, 4, 'Other', NULL, 0, '0.00', '0.00', '2019-06-25 23:18:49', '2019-06-25 23:18:49'),
(6, 5, 'Labour', NULL, 0, '0.00', '0.00', '2019-06-26 01:04:22', '2019-06-26 01:04:22'),
(7, 5, 'Callout Fee', NULL, 0, '0.00', '0.00', '2019-06-26 01:04:22', '2019-06-26 01:04:22'),
(8, 5, 'Equipment', NULL, 0, '0.00', '0.00', '2019-06-26 01:04:22', '2019-06-26 01:04:22'),
(9, 5, 'Travel', NULL, 0, '0.00', '0.00', '2019-06-26 01:04:22', '2019-06-26 01:04:22'),
(10, 5, 'Other', NULL, 0, '0.00', '0.00', '2019-06-26 01:04:22', '2019-06-26 01:04:22'),
(11, 6, 'Labour', NULL, 0, '0.00', '0.00', '2019-06-26 01:06:04', '2019-06-26 01:06:04'),
(12, 6, 'Callout Fee', NULL, 0, '0.00', '0.00', '2019-06-26 01:06:05', '2019-06-26 01:06:05'),
(13, 6, 'Equipment', NULL, 0, '0.00', '0.00', '2019-06-26 01:06:05', '2019-06-26 01:06:05'),
(14, 6, 'Travel', NULL, 0, '0.00', '0.00', '2019-06-26 01:06:05', '2019-06-26 01:06:05'),
(15, 6, 'Other', NULL, 0, '0.00', '0.00', '2019-06-26 01:06:05', '2019-06-26 01:06:05'),
(16, 7, 'item_1', NULL, 0, '0.00', '0.00', '2019-06-26 01:32:41', '2019-06-26 01:32:41'),
(17, 7, 'item_1', NULL, 0, '0.00', '0.00', '2019-06-26 01:32:41', '2019-06-26 01:32:41'),
(18, 7, 'item_1', NULL, 0, '0.00', '0.00', '2019-06-26 01:32:41', '2019-06-26 01:32:41'),
(19, 7, 'item_1', NULL, 0, '0.00', '0.00', '2019-06-26 01:32:41', '2019-06-26 01:32:41'),
(20, 8, 'item_1', 'test', 0, '0.00', '0.00', '2019-06-26 01:36:00', '2019-06-26 01:36:00'),
(21, 8, 'item_1', 'test', 0, '0.00', '0.00', '2019-06-26 01:36:00', '2019-06-26 01:36:00'),
(22, 8, 'item_1', 'test', 0, '0.00', '0.00', '2019-06-26 01:36:01', '2019-06-26 01:36:01'),
(23, 8, 'item_1', 'test', 0, '0.00', '0.00', '2019-06-26 01:36:01', '2019-06-26 01:36:01'),
(24, 9, 'Callout Fee', 'Callout Fee DESCRIPTION', 1, '52.00', '52.00', '2019-06-26 01:39:19', '2019-06-26 01:39:19'),
(25, 9, 'Equipment', 'Equipment DESCRIPTION', 1, '23.00', '23.00', '2019-06-26 01:39:19', '2019-06-26 01:39:19'),
(26, 9, 'Travel', 'Travel DESCRIPTION', 1, '89.00', '89.00', '2019-06-26 01:39:19', '2019-06-26 01:39:19'),
(27, 9, 'Other', 'Other DESCRIPTION', 1, '52.00', '52.00', '2019-06-26 01:39:19', '2019-06-26 01:39:19'),
(28, 10, 'Labour', 'Labour Comment', 1, '45.00', '45.00', '2019-06-26 01:41:53', '2019-06-26 01:41:53'),
(29, 10, 'Callout Fee', 'Callout Fee Comment', 1, '20.00', '20.00', '2019-06-26 01:41:53', '2019-06-26 01:41:53'),
(30, 10, 'Equipment', 'Equipment Comment', 1, '78.00', '78.00', '2019-06-26 01:41:53', '2019-06-26 01:41:53'),
(31, 10, 'Travel', 'Travel Comment', 1, '51.00', '51.00', '2019-06-26 01:41:53', '2019-06-26 01:41:53'),
(32, 10, 'Other', 'Other Comment', 1, '565.00', '565.00', '2019-06-26 01:41:53', '2019-06-26 01:41:53'),
(33, 11, 'Labour', 'Job Address', 1, '75.00', '75.00', '2019-06-26 03:22:05', '2019-06-26 03:22:05'),
(34, 11, 'Callout Fee', 'Job Address', 1, '466.00', '466.00', '2019-06-26 03:22:05', '2019-06-26 03:22:05'),
(35, 11, 'Equipment', 'Job Address', 1, '75.00', '75.00', '2019-06-26 03:22:05', '2019-06-26 03:22:05'),
(36, 11, 'Travel', 'Job Address', 1, '12.00', '12.00', '2019-06-26 03:22:05', '2019-06-26 03:22:05'),
(37, 11, 'Other', 'Job Address', 1, '18.00', '18.00', '2019-06-26 03:22:05', '2019-06-26 03:22:05'),
(38, 12, 'Labour', 'iuiuiu', 10, '10.00', '100.00', '2019-06-27 20:54:57', '2019-06-27 20:54:57'),
(39, 12, 'Callout Fee', 'iyuiyui', 1, '10.00', '10.00', '2019-06-27 20:54:57', '2019-06-27 20:54:57'),
(40, 12, 'Equipment', 'uyiuyiuy', 1, '10.00', '10.00', '2019-06-27 20:54:57', '2019-06-27 20:54:57'),
(41, 12, 'Travel', 'iuyg', 1, '10.00', '10.00', '2019-06-27 20:54:57', '2019-06-27 20:54:57'),
(42, 12, 'Other', 'fhfseere', 1, '10.00', '10.00', '2019-06-27 20:54:57', '2019-06-27 20:54:57'),
(43, 13, 'Labour', 'Labour', 1, '100.00', '100.00', '2019-06-29 05:34:15', '2019-06-29 05:34:15'),
(44, 13, 'Callout Fee', 'Callout', 1, '150.00', '150.00', '2019-06-29 05:34:16', '2019-06-29 05:34:16'),
(45, 13, 'Equipment', 'Equipment', 1, '175.00', '175.00', '2019-06-29 05:34:16', '2019-06-29 05:34:16'),
(46, 13, 'Travel', 'Travel', 5, '500.00', '2500.00', '2019-06-29 05:34:16', '2019-06-29 05:34:16'),
(47, 13, 'Other', 'Other', 1, '12.00', '12.00', '2019-06-29 05:34:16', '2019-06-29 05:34:16');

-- --------------------------------------------------------

--
-- Table structure for table `quote_photos`
--

CREATE TABLE `quote_photos` (
  `id` int(10) UNSIGNED NOT NULL,
  `quote_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quote_photos`
--

INSERT INTO `quote_photos` (`id`, `quote_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 11, 'heart-1561553525.jpg', '2019-06-26 03:22:05', '2019-06-26 03:22:05'),
(2, 11, 'round-1561553525.jpg', '2019-06-26 03:22:05', '2019-06-26 03:22:05'),
(3, 11, 'square-1561553525.jpg', '2019-06-26 03:22:05', '2019-06-26 03:22:05'),
(4, 12, 'heart-1561703097.jpg', '2019-06-27 20:54:57', '2019-06-27 20:54:57'),
(5, 12, 'round-1561703097.jpg', '2019-06-27 20:54:57', '2019-06-27 20:54:57'),
(6, 12, 'square-1561703097.jpg', '2019-06-27 20:54:57', '2019-06-27 20:54:57'),
(7, 13, 'avatar-01-1561820656.jpg', '2019-06-29 05:34:16', '2019-06-29 05:34:16'),
(8, 13, 'avatar-02-1561820656.jpg', '2019-06-29 05:34:16', '2019-06-29 05:34:16'),
(9, 13, 'avatar-03-1561820656.jpg', '2019-06-29 05:34:16', '2019-06-29 05:34:16'),
(10, 13, 'avatar-04-1561820656.jpg', '2019-06-29 05:34:16', '2019-06-29 05:34:16'),
(11, 13, 'avatar-05-1561820656.jpg', '2019-06-29 05:34:16', '2019-06-29 05:34:16'),
(12, 13, 'avatar-06-1561820656.jpg', '2019-06-29 05:34:16', '2019-06-29 05:34:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Shafna Mikdar', 'shafnawitel@gmail.com', '$2y$10$aPFxDGbDYId30jHXahEHi.UPp7qzDAU1qhT4AUkLKns.ulhi4VbZ2', 'ydUySYTztXWNjlP6tFaUbq0SsaUHIU5jJBTe1FT3cdc1hgNxZihmoVJqQgMF', '2019-06-29 06:22:50', '2019-06-29 06:22:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quote_items`
--
ALTER TABLE `quote_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quote_photos`
--
ALTER TABLE `quote_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `quote_items`
--
ALTER TABLE `quote_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `quote_photos`
--
ALTER TABLE `quote_photos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
