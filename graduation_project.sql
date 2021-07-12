-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2021 at 03:19 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `graduation_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorys`
--

CREATE TABLE `categorys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `viewinnav` enum('view','hide','','') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categorys`
--

INSERT INTO `categorys` (`id`, `name`, `viewinnav`, `created_at`, `updated_at`) VALUES
(15, 'Sales', 'view', '2021-07-09 12:34:56', '2021-07-09 12:34:56'),
(16, 'Accessories', 'view', '2021-07-09 12:35:26', '2021-07-09 12:36:03'),
(17, 'Footwear', 'view', '2021-07-09 12:35:56', '2021-07-10 17:53:45'),
(18, 'Men', 'view', '2021-07-09 12:36:27', '2021-07-10 17:53:50'),
(19, 'Women', 'view', '2021-07-09 12:36:44', '2021-07-10 17:53:58'),
(20, 'Kids', 'hide', '2021-07-09 12:36:57', '2021-07-09 12:36:57');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(18, '2021_06_25_130750_sliders', 3),
(19, '2021_06_24_131609_category', 4),
(20, '2021_06_24_132846_product', 4),
(21, '2021_06_25_130710_offers', 5),
(23, '2021_06_25_130637_profiles', 6);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `Quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_before` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_after` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `sale`, `category_id`, `image`, `details`, `created_at`, `updated_at`) VALUES
(25, 'women1', '150', 'none', 19, '1625847016Women1.png', 'This is Woman Dress', NULL, NULL),
(26, 'women2', '150', 'none', 19, '1625847069women2.png', 'This dress is for woman', NULL, NULL),
(27, 'women3', '120', 'none', 19, '1625847130women3.png', 'This dress is for Woman', NULL, NULL),
(28, 'women4', '120', 'none', 19, '1625847174women4.png', 'This dress is for Woman', NULL, NULL),
(29, 'women5', '150', 'none', 19, '1625847223women5.png', 'This dress is for Woman', NULL, NULL),
(30, 'women6', '150', 'none', 19, '1625847264women6.png', 'This dress is for Woman', NULL, NULL),
(31, 'women7', '120', 'none', 19, '1625847311women7.png', 'This dress is for Woman', NULL, NULL),
(32, 'women8', '120', 'none', 19, '1625847371women8.png', 'This dress is for Woman', NULL, NULL),
(33, 'women9', '150', 'Trend', 19, '1625847596women9.png', 'This dress is for Woman', NULL, NULL),
(34, 'women10', '150', 'Trend', 19, '1625847658women10.png', 'This dress is for Woman', NULL, NULL),
(35, 'child1', '120', 'Trend', 20, '1625847726child1.png', 'This dress is for Kids', NULL, NULL),
(36, 'women11', '120', 'Trend', 19, '1625847811women11.png', 'This dress is for Woman', NULL, NULL),
(37, 'child2', '150', 'Trend', 20, '1625847870child2.png', 'This dress is for Kids', NULL, NULL),
(38, 'women12', '150', 'Trend', 19, '1625847915women12.png', 'This dress is for Woman', NULL, NULL),
(39, 'men1', '120', 'Trend', 18, '1625847965men1.png', 'This dress is for Men', NULL, NULL),
(40, 'men2', '120', 'Trend', 18, '1625848012men2.png', 'This dress is for Men', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `productsold`
--

CREATE TABLE `productsold` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aboutme` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `image`, `mobile`, `address`, `birthdate`, `gender`, `aboutme`, `created_at`, `updated_at`) VALUES
(19, 102, '1626032036upperrightlowerimage.png', '123456789101112', '65 شارع سليم الأول', '2021-07-20', 'male', 'I am decent Man', '2021-07-11 17:32:38', '2021-07-12 11:16:53'),
(22, 123456, NULL, NULL, NULL, NULL, 'male', NULL, '2021-07-11 17:53:21', '2021-07-11 17:55:06'),
(23, 123456, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-11 17:54:33', '2021-07-11 17:54:33'),
(24, 54, '1626094799upperrightlowerimage.png', NULL, NULL, NULL, NULL, NULL, '2021-07-12 08:25:15', '2021-07-12 10:59:59'),
(25, 54, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-12 09:29:20', '2021-07-12 09:29:20'),
(26, 102, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-12 10:16:44', '2021-07-12 10:16:44'),
(27, 102, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-12 10:20:40', '2021-07-12 10:20:40'),
(28, 102, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-12 11:08:04', '2021-07-12 11:08:04'),
(29, 102, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-12 11:10:35', '2021-07-12 11:10:35'),
(30, 102, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-12 11:12:17', '2021-07-12 11:12:17'),
(31, 102, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-12 11:14:30', '2021-07-12 11:14:30'),
(32, 102, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-12 11:16:24', '2021-07-12 11:16:24');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `created_at`, `updated_at`) VALUES
(2, '1625745813slider.bmp', '2021-06-30 10:26:24', '2021-07-08 10:03:33'),
(11, '1625939250upperleftimage.png', '2021-06-30 17:33:32', '2021-07-10 15:47:30'),
(13, '1625939235upperrightlowerimage.png', '2021-06-30 18:05:50', '2021-07-10 15:47:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('Admin','User','Moderator') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'User',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `blocked` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `blocked`) VALUES
(54, 'Admin', 'Admin@Admin.com', '2021-06-23 17:06:23', '$2y$10$occYPld9k4B3h60mLRqqo.FIHvzAgmRzH5K3m.FM2ZPpyAuH1/rIC', 'Admin', NULL, '2021-06-23 17:06:23', '2021-07-03 09:49:17', 0),
(55, 'I am Moderator', 'Moderator@Moderator.com', '2021-06-23 17:06:24', '$2y$10$occYPld9k4B3h60mLRqqo.FIHvzAgmRzH5K3m.FM2ZPpyAuH1/rIC', 'Moderator', NULL, '2021-06-23 17:06:24', '2021-06-23 17:06:24', 0),
(102, 'أحمد محمد عبد الظاهر عبد الرحمن', 'ahmednefa77@gmail.com', '2021-07-11 17:32:03', '$2y$10$u6qcBgLlB6DHAsQ.Yqjv4uoOhJnB/a5pHCCRcsYhb/c7ORACBrvjC', 'User', NULL, '2021-07-11 17:31:30', '2021-07-12 11:16:53', 0),
(123456, 'Ahmed AbdelZaher', 'abdelzaher@google.com', '2021-07-11 17:53:20', '$2y$10$Znv7rAOtQm967.psN9jBluoOtDNcAESpqeC9eZIGTzMFkRIXJYjSi', 'Admin', NULL, '2021-07-11 17:53:20', '2021-07-11 17:53:20', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorys`
--
ALTER TABLE `categorys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offers_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `productsold`
--
ALTER TABLE `productsold`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_user_id_foreign` (`user_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
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
-- AUTO_INCREMENT for table `categorys`
--
ALTER TABLE `categorys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `productsold`
--
ALTER TABLE `productsold`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123457;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categorys` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
