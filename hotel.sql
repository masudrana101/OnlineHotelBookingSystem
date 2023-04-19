-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2021 at 06:59 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `amount` double NOT NULL,
  `payment_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cvc_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'booked',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `room_id`, `check_in`, `check_out`, `amount`, `payment_by`, `card_no`, `cvc_no`, `month`, `year`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2021-01-01', '2021-01-02', 36, 'cash on hotel', NULL, NULL, NULL, NULL, 'canceled', '2021-01-26 11:55:43', '2021-01-26 11:56:55'),
(2, 3, 3, '2021-01-02', '2021-01-02', 72, 'online payment', '4242424242424242', '12345', '12', '2021', 'booked', '2021-01-26 11:56:24', '2021-01-26 11:56:46');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `division_id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bn_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `division_id`, `name`, `bn_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Comilla', 'কুমিল্লা', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(2, 1, 'Feni', 'ফেনী', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(3, 1, 'Brahmanbaria', 'ব্রাহ্মণবাড়িয়া', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(4, 1, 'Rangamati', 'রাঙ্গামাটি', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(5, 1, 'Noakhali', 'নোয়াখালী', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(6, 1, 'Chandpur', 'চাঁদপুর', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(7, 1, 'Lakshmipur', 'লক্ষ্মীপুর', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(8, 1, 'Chattogram', 'চট্টগ্রাম', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(9, 1, 'Coxsbazar', 'কক্সবাজার', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(10, 1, 'Khagrachhari', 'খাগড়াছড়ি', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(11, 1, 'Bandarban', 'বান্দরবান', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(12, 2, 'Sirajganj', 'সিরাজগঞ্জ', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(13, 2, 'Pabna', 'পাবনা', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(14, 2, 'Bogura', 'বগুড়া', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(15, 2, 'Rajshahi', 'রাজশাহী', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(16, 2, 'Natore', 'নাটোর', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(17, 2, 'Joypurhat', 'জয়পুরহাট', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(18, 2, 'Chapainawabganj', 'চাঁপাইনবাবগঞ্জ', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(19, 2, 'Naogaon', 'নওগাঁ', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(20, 3, 'Jashore', 'যশোর', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(21, 3, 'Satkhira', 'সাতক্ষীরা', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(22, 3, 'Meherpur', 'মেহেরপুর', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(23, 3, 'Narail', 'নড়াইল', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(24, 3, 'Chuadanga', 'চুয়াডাঙ্গা', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(25, 3, 'Kushtia', 'কুষ্টিয়া', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(26, 3, 'Magura', 'মাগুরা', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(27, 3, 'Khulna', 'খুলনা', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(28, 3, 'Bagerhat', 'বাগেরহাট', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(29, 3, 'Jhenaidah', 'ঝিনাইদহ', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(30, 4, 'Jhalakathi', 'ঝালকাঠি', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(31, 4, 'Patuakhali', 'পটুয়াখালী', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(32, 4, 'Pirojpur', 'পিরোজপুর', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(33, 4, 'Barisal', 'বরিশাল', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(34, 4, 'Bhola', 'ভোলা', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(35, 4, 'Barguna', 'বরগুনা', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(36, 5, 'Sylhet', 'সিলেট', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(37, 5, 'Moulvibazar', 'মৌলভীবাজার', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(38, 5, 'Habiganj', 'হবিগঞ্জ', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(39, 5, 'Sunamganj', 'সুনামগঞ্জ', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(40, 6, 'Narsingdi', 'নরসিংদী', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(41, 6, 'Gazipur', 'গাজীপুর', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(42, 6, 'Shariatpur', 'শরীয়তপুর', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(43, 6, 'Narayanganj', 'নারায়ণগঞ্জ', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(44, 6, 'Tangail', 'টাঙ্গাইল', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(45, 6, 'Kishoreganj', 'কিশোরগঞ্জ', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(46, 6, 'Manikganj', 'মানিকগঞ্জ', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(47, 6, 'Dhaka', 'ঢাকা', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(48, 6, 'Munshiganj', 'মুন্সিগঞ্জ', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(49, 6, 'Rajbari', 'রাজবাড়ী', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(50, 6, 'Madaripur', 'মাদারীপুর', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(51, 6, 'Gopalganj', 'গোপালগঞ্জ', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(52, 6, 'Faridpur', 'ফরিদপুর', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(53, 7, 'Panchagarh', 'পঞ্চগড়', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(54, 7, 'Dinajpur', 'দিনাজপুর', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(55, 7, 'Lalmonirhat', 'লালমনিরহাট', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(56, 7, 'Nilphamari', 'নীলফামারী', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(57, 7, 'Gaibandha', 'গাইবান্ধা', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(58, 7, 'Thakurgaon', 'ঠাকুরগাঁও', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(59, 7, 'Rangpur', 'রংপুর', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(60, 7, 'Kurigram', 'কুড়িগ্রাম', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(61, 8, 'Sherpur', 'শেরপুর', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(62, 8, 'Mymensingh', 'ময়মনসিংহ', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(63, 8, 'Jamalpur', 'জামালপুর', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(64, 8, 'Netrokona', 'নেত্রকোণা', '2021-01-26 11:46:54', '2021-01-26 11:46:54');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bn_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `bn_name`, `created_at`, `updated_at`) VALUES
(1, 'Chattagram', 'চট্টগ্রাম', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(2, 'Rajshahi', 'রাজশাহী', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(3, 'Khulna', 'খুলনা', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(4, 'Barisal', 'বরিশাল', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(5, 'Sylhet', 'সিলেট', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(6, 'Dhaka', 'ঢাকা', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(7, 'Rangpur', 'রংপুর', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(8, 'Mymensingh', 'ময়মনসিংহ', '2021-01-26 11:46:54', '2021-01-26 11:46:54');

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
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `manager_id` bigint(20) UNSIGNED NOT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `manager_id`, `district_id`, `name`, `phone`, `email`, `logo`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Austin Park 01', '12345678900', NULL, 'hotel_logos/1611683317.png', 'Voluptates excepteur', 'active', '2021-01-26 11:48:37', '2021-01-26 11:54:00'),
(2, 2, 2, 'Austin Park 02', '12345678900', 'nuga@mailinator.com', 'hotel_logos/1611683351.PNG', 'Enim harum hic nostr', 'active', '2021-01-26 11:49:11', '2021-01-26 11:54:01');

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
(14, '2014_10_12_000000_create_users_table', 1),
(15, '2014_10_12_100000_create_password_resets_table', 1),
(16, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(17, '2019_08_19_000000_create_failed_jobs_table', 1),
(18, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(19, '2020_10_23_062320_create_sessions_table', 1),
(20, '2020_11_21_141723_create_hotels_table', 1),
(21, '2020_11_21_142352_create_divisions_table', 1),
(22, '2020_11_21_143428_create_districts_table', 1),
(23, '2020_12_01_182215_create_rooms_table', 1),
(24, '2020_12_01_182357_create_room_types_table', 1),
(25, '2020_12_13_155219_create_room_checkings_table', 1),
(26, '2020_12_15_134826_create_bookings_table', 1);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hotel_id` bigint(20) UNSIGNED NOT NULL,
  `room_type_id` bigint(20) UNSIGNED NOT NULL,
  `room_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attached_bath` tinyint(1) NOT NULL DEFAULT 0,
  `type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non ac',
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `hotel_id`, `room_type_id`, `room_number`, `amount`, `description`, `attached_bath`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '884', 18, 'Corrupti nisi nulla', 1, 'non ac', 'available', '2021-01-26 11:51:53', '2021-01-26 11:51:53'),
(2, 1, 2, '397', 80, 'Consectetur fugiat', 1, 'ac', 'available', '2021-01-26 11:51:58', '2021-01-26 11:51:58'),
(3, 1, 4, '695', 72, 'Libero veniam susci', 1, 'ac', 'available', '2021-01-26 11:52:03', '2021-01-26 11:52:03'),
(4, 2, 1, '396', 9, 'Amet id anim aut vo', 1, 'ac', 'unavailabl', '2021-01-26 11:52:21', '2021-01-26 11:52:21'),
(5, 2, 4, '111', 450, NULL, 1, 'non ac', 'available', '2021-01-26 11:52:42', '2021-01-26 11:52:42');

-- --------------------------------------------------------

--
-- Table structure for table `room_checkings`
--

CREATE TABLE `room_checkings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'booked',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_checkings`
--

INSERT INTO `room_checkings` (`id`, `room_id`, `booking_id`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 2, '2021-01-02', '2021-01-02', 'booked', '2021-01-26 11:56:46', '2021-01-26 11:56:46');

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

CREATE TABLE `room_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` int(11) NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_types`
--

INSERT INTO `room_types` (`id`, `name`, `capacity`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Single', 1, 'active', '2021-01-26 11:51:02', '2021-01-26 11:51:02'),
(2, 'Double', 2, 'active', '2021-01-26 11:51:12', '2021-01-26 11:51:12'),
(3, 'Family', 3, 'active', '2021-01-26 11:51:22', '2021-01-26 11:51:22'),
(4, 'Family', 4, 'active', '2021-01-26 11:51:38', '2021-01-26 11:51:38');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Fs3uXvGdiOYwOjTiuYwSPyqglMlhrN2jvrgPDQLA', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.104 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiM0tmZ1d1amZUaWVJdjdMbkVSbHhJT3c1NTA3Sm5pWDU0YzJmM01PZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTY6Imh0dHA6Ly9sb2NhbGhvc3QvTGFyYXZlbC9PdXQvaG90ZWxfYm9va2luZy9wdWJsaWMveGFkbWluIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCRHNW9wcWdnaUVmUzBCai5nbGdzZzIudlJla0V5L20zcGRCVFMxMmxUZkpOTXBuYmRSeVJMMiI7czo1OiJhbGVydCI7YTowOnt9fQ==', 1611683860),
('mFGJcfCQy6vjbqzaPOn4xcLUIxGqR6RCCzTOx4Kb', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 Edge/18.18363', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiN1VOWjV0VVNDOVpIOVlmU3o3MXF2d2M3TmE4MWFXU0VCVTcxSk9hcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTU6Imh0dHA6Ly9sb2NhbGhvc3QvTGFyYXZlbC9PdXQvaG90ZWxfYm9va2luZy9wdWJsaWMvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJEc1MVJ4N1BDdFk3WEw1T1cud3dMOXVrL1B2dk5pdTJJOTFYYlk3LzRRdUY4Mm9lSGxKekYuIjtzOjg6ImNoZWNrX2luIjtzOjEwOiIyMDIxLTAxLTAyIjtzOjk6ImNoZWNrX291dCI7czoxMDoiMjAyMS0wMS0wMiI7czo0OiJkaWZmIjtpOjE7czo1OiJhbGVydCI7YTowOnt9fQ==', 1611683841),
('uTyV9g6vuaCpKANcUX7rflIsR8uB3kDDrvHS8e0C', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.104 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZUR4YXVvallMZDBnNTl6VTg3bFZHMU44M3dSUHdUaTFzOThRQ3RsTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTU6Imh0dHA6Ly9sb2NhbGhvc3QvTGFyYXZlbC9PdXQvaG90ZWxfYm9va2luZy9wdWJsaWMvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJFJSLlBhc0psMTBJYmJ5Q1J2UHl5SC5KSXlnc1MvMzFzRUNMV3NtTmxQeHlqNHU5WlJUV3dXIjtzOjU6ImFsZXJ0IjthOjA6e319', 1611683853);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'male',
  `type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `image`, `sex`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'RAST', '01234567890', 'admin@hotel.com', NULL, '$2y$10$G5opqggiEfS0Bj.glgsg2.vRekEy/m3pdBTS12lTfJNMpnbdRyRL2', NULL, NULL, NULL, NULL, 'male', 'admin', 'active', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(2, 'RAST Manager', '01234567892', 'manager@hotel.com', NULL, '$2y$10$RR.PasJl10IbbyCRvPyyH.JIygsS/31sECLWsmNlPxyj4u9ZRTWwW', NULL, NULL, NULL, NULL, 'male', 'manager', 'active', '2021-01-26 11:46:54', '2021-01-26 11:46:54'),
(3, 'RAST Customer', '01234567891', 'customer@hotel.com', NULL, '$2y$10$G51Rx7PCtY7XL5OW.wwL9uk/PvvNiu2I91XbY7/4QuF82oeHlJzF.', NULL, NULL, NULL, NULL, 'male', 'customer', 'active', '2021-01-26 11:46:54', '2021-01-26 11:46:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_checkings`
--
ALTER TABLE `room_checkings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `room_checkings`
--
ALTER TABLE `room_checkings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
