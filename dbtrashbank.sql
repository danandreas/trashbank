-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2021 at 08:48 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbtrashbank`
--

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `code`, `name`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, '11001', 'Bank Desa 1', '084345532345', 'Polanharjo, Klaten, Jawa Tengah', '2020-11-21 11:48:29', '2020-11-21 11:51:59'),
(2, '11002', 'Bank Desa 2', '084675557865', 'Desa Aqua', '2020-11-21 11:53:16', '2020-11-21 11:53:39'),
(4, '1001', 'Saraswatra', '-', 'Dusun Polan, Desa Polan, Kec. Polanharjo, Klaten', '2021-01-14 01:25:58', '2021-01-14 01:35:55');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_id` bigint(20) UNSIGNED NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `saldo` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `bank_id`, `account_number`, `name`, `gender`, `phone`, `address`, `saldo`, `email`, `password`, `status`, `remember_token`, `device_token`, `created_at`, `updated_at`) VALUES
(1, 1, '11001001', 'Bima', 'L', '086353325466', 'Depok, Sleman', 68000, 'bima@gmail.com', '$2y$10$R6JKzguXOZQEtaCu4VmF..iFN/gWf.8QbUCYYqQ9IfyKKka.pXp/O', '1', NULL, '', '2020-12-09 09:54:30', '2021-01-12 14:49:04'),
(10, 1, '11001010', 'Yudistira', 'L', '086534657877', 'Klaten', 154000, 'yudistira@gmail.com', NULL, '1', NULL, '', '2020-12-12 12:40:07', '2021-01-12 14:49:04'),
(34, 1, '11001034', 'Nadia', 'P', '085723459876', 'Sleman', 10000, 'nadia@gmail.com', NULL, '1', NULL, '', '2020-12-13 13:26:45', '2021-01-14 02:26:32'),
(38, 1, '11001035', 'Thomas Tukiadmoko', 'L', '086355432126', 'Tawangharjo', 40000, 'thomas@gmail.com', '$2y$10$yFeDCdmZRJa8oqsyeSh30OGhI29KylZsALqNKZkTtsmi1L9E1qgxW', '0', NULL, 'ck8HZP0ISiusSKcDVoM2e5:APA91bEUXEV1hdiihqKf2G8KjZDvwVVJWQ0zJRjeaUQ8emDr8FqHcdl4KlcaL_GEw09xPO5BXJD8SVnKlNlDk3RRUeQZ592Nj6umlU_GeczIlpdkEPsQo0F8bPFzGZHBewbODGWwKlyw', '2020-12-19 23:20:27', '2021-01-13 09:26:22'),
(61, 1, '11001039', 'Tono', 'L', '087655431234', 'Polan', 5000, NULL, NULL, '1', NULL, NULL, '2021-01-14 02:01:34', '2021-01-14 02:26:32');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `bank_id`, `name`, `phone`, `email`, `password`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Afgan', '0835612777', 'afgan@gmail.com', '$2y$10$5xddi0wh3a3cbnuV5ij0YO2zCXdDl4BtA2hL6zIygp1vIcJ4XIcZ.', NULL, NULL, '2020-11-21 12:53:27', '2020-11-21 21:25:02'),
(6, 1, 'Raisa', '084356778555', 'raisa@gmail.com', '$2y$10$JGR0ZSgkAmn4WITBX2JI2um1Ir6fw2SF8p/U2IGR6BWUgXjXFDU9S', NULL, NULL, '2020-11-22 00:52:46', '2020-11-22 00:52:46'),
(7, 4, 'Sugiarti', '086512342345', 'sugiarti@gmail.com', '$2y$10$ctOo7/R0gVAeHls4GWUqJubwmQ2vn8l..u.BkgvIT0RX8pKnFIUVK', NULL, NULL, '2021-01-14 01:27:26', '2021-01-14 01:27:26');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) NOT NULL,
  `bank_id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `sender` enum('bank','customer') NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `bank_id`, `customer_id`, `sender`, `message`, `created_at`, `updated_at`) VALUES
(1, 1, 10, 'customer', 'For convenience, if you want to verify that a column is equal to a given value, you may pass the value directly as the second argument to the where method.', '2020-12-16 04:46:41', '2020-12-16 04:46:41'),
(2, 1, 1, 'customer', 'Hey John, I am looking for the best admin template.\r\n\r\nCould you please help me to find it out?', '2020-12-16 07:46:41', '2020-12-16 07:46:41'),
(3, 1, 10, 'customer', 'Komenta Ke 2 dari Yudistira. Data dapat didefinisikan sebagai bahan keterangan tentang kejadian-kejadian nyata atau fakta-fakta yang dirumuskan dalam sekelompok lambang tertentu yang tidak acak, yang menunjukkan jumlah, tindakan, atau hal.', '2020-12-16 08:46:41', '2020-12-16 08:46:41'),
(4, 1, 1, 'customer', 'Pesan ke 2 Budi. Komenta Ke 2 dari. Data dapat didefinisikan sebagai bahan keterangan tentang kejadian-kejadian nyata atau fakta-fakta yang dirumuskan dalam sekelompok lambang tertentu yang tidak acak, yang menunjukkan jumlah, tindakan, atau hal.', '2020-12-16 08:46:41', '2020-12-16 08:46:41'),
(5, 1, 10, 'bank', 'Oke Brooooooo', '2020-12-17 04:46:41', '2020-12-17 04:46:41');

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
(4, '2020_11_13_185030_create_employees_table', 1),
(5, '2020_11_13_185525_create_banks_table', 1),
(6, '2020_11_14_043214_create_customers_table', 1),
(7, '2020_11_14_050659_create_trashes_table', 1),
(8, '2020_11_14_073305_create_savings_table', 1),
(9, '2020_11_14_074109_create_transactions_table', 1),
(10, '2020_11_14_142759_create_transaction_details_table', 1);

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
-- Table structure for table `savings`
--

CREATE TABLE `savings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `bank_id` bigint(20) UNSIGNED NOT NULL,
  `trash_id` bigint(20) UNSIGNED NOT NULL,
  `weight` float NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `savings`
--

INSERT INTO `savings` (`id`, `customer_id`, `bank_id`, `trash_id`, `weight`, `description`, `transaction_status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 26, 9.2, 'Kaca minuman X', '0', '2020-12-13 23:47:09', '2020-12-13 23:55:44'),
(2, 10, 1, 1, 6.7, 'Kertas Kardus', '1', '2020-12-13 23:59:51', '2021-01-12 14:49:04'),
(3, 1, 1, 26, 34, '###', '1', '2020-12-14 06:44:56', '2021-01-12 14:49:04'),
(4, 10, 1, 26, 77, 'Kaca Beling', '1', '2021-01-12 03:26:00', '2021-01-12 14:49:04'),
(5, 34, 1, 1, 45, '-', '1', '2021-01-13 09:24:34', '2021-01-13 09:26:22'),
(6, 38, 1, 2, 20, '-', '1', '2021-01-13 09:24:52', '2021-01-13 09:26:22'),
(7, 61, 1, 1, 2.5, '-', '1', '2021-01-14 02:16:37', '2021-01-14 02:26:32'),
(8, 34, 1, 26, 5, '-', '1', '2021-01-14 02:19:09', '2021-01-14 02:26:32');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_per_weight` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `bank_id`, `name`, `description`, `price_per_weight`, `created_at`, `updated_at`) VALUES
(6, 1, 'Periode I', '-', 2000, '2021-01-12 14:49:04', '2021-01-12 14:49:04'),
(7, 1, 'Periode 2', '-', 2000, '2021-01-13 09:26:22', '2021-01-13 09:26:22'),
(8, 1, 'Periode 7 (1 Februari - 13 Februari)', '-', 2000, '2021-01-14 02:26:32', '2021-01-14 02:26:32');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_details`
--

CREATE TABLE `transaction_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `saving_id` bigint(20) UNSIGNED NOT NULL,
  `income` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_details`
--

INSERT INTO `transaction_details` (`id`, `transaction_id`, `saving_id`, `income`, `created_at`, `updated_at`) VALUES
(7, 6, 2, 13400, '2021-01-12 14:49:04', '2021-01-12 14:49:04'),
(8, 6, 3, 68000, '2021-01-12 14:49:04', '2021-01-12 14:49:04'),
(9, 6, 4, 154000, '2021-01-12 14:49:04', '2021-01-12 14:49:04'),
(10, 7, 5, 90000, '2021-01-13 09:26:22', '2021-01-13 09:26:22'),
(11, 7, 6, 40000, '2021-01-13 09:26:22', '2021-01-13 09:26:22'),
(12, 8, 7, 5000, '2021-01-14 02:26:32', '2021-01-14 02:26:32'),
(13, 8, 8, 10000, '2021-01-14 02:26:32', '2021-01-14 02:26:32');

-- --------------------------------------------------------

--
-- Table structure for table `trashes`
--

CREATE TABLE `trashes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trashes`
--

INSERT INTO `trashes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(0, 'Lain-lain', '2021-01-14 01:17:55', '2021-01-14 01:17:55'),
(1, 'Kertas', NULL, '2020-12-09 01:49:09'),
(2, 'Plastik', NULL, '2020-12-09 01:49:22'),
(3, 'Logam', NULL, '2020-12-09 01:49:31'),
(26, 'Kaca', '2020-12-09 01:49:52', '2020-12-09 01:49:52');

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
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Andreas Dan', 'andreasardaniel@gmail.com', NULL, '$2y$10$IcOpWDYl0RrgvO.kK9Z4o.ZjF5S9omzLyKNjPFprBh3yN7DVngEg6', NULL, '2020-11-19 22:01:40', '2020-11-19 22:01:40'),
(2, 'Maria Diana', 'mariadiana@gmail.com', NULL, '$2y$10$chi8jjgR1XtPZzCU6Nm61uSuFMoDAZwf.Z6heB50NNxZ834.Kp7b2', NULL, '2020-11-19 22:29:47', '2020-12-09 00:54:46'),
(8, 'Agus Hartono', 'ahartono17@gmail.com', NULL, '$2y$10$x69u2TqIcL1o2EF1IEF4suTEa9HCxxRi.Y7xwoTCZtFge4hIta7A.', NULL, '2021-01-14 01:17:01', '2021-01-14 01:17:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `banks_bank_code_unique` (`code`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_account_number_unique` (`account_number`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `savings`
--
ALTER TABLE `savings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trashes`
--
ALTER TABLE `trashes`
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
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `savings`
--
ALTER TABLE `savings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `trashes`
--
ALTER TABLE `trashes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
