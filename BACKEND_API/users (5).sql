-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2024 at 08:19 AM
-- Server version: 10.11.8-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u954141192_mos`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `school` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country_code` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `about` varchar(255) DEFAULT NULL,
  `grade` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `mobile_verified` int(2) DEFAULT 0,
  `email_verified` int(2) DEFAULT 0,
  `is_data` int(2) NOT NULL DEFAULT 0,
  `user_type` varchar(255) DEFAULT 'user',
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `email_verified_at`, `first_name`, `last_name`, `school`, `city`, `country_code`, `mobile`, `about`, `grade`, `icon`, `banner`, `mobile_verified`, `email_verified`, `is_data`, `user_type`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin@magicofskills.com', NULL, 'Magic Of Skills', NULL, NULL, NULL, NULL, '9617091766', NULL, NULL, 'assets/user_icon.png', 'assets/banner.png', 0, 0, 0, 'admin', '$2y$12$p.75F8sjh7xW1XLsNS4hd.ZrRyR/wRfFbzqUMZD854qJRZOmIxgTC', 'aWbYf72bfCaQZOQRb8SxP0YRDWUB8fWT3qaThInuQ6d4fLFXW3i350qeHQps', '2024-06-12 16:01:26', '2024-07-28 23:29:56'),
(2, 'digital.endeavour.in@gmail.com', NULL, 'Mohit', 'Mehta', 'Dr. B R Ambedkar National Institute of Technology, Jalandhar', 'Narsinghpur', '+91', '9399380920', 'Prabhat', '12', 'public/profile/icon/v4odtfEoS5icbYxG32xPlzdNrcQ9lIssFA1P1zTv.png', 'public/profile/banner/odLyu3OkexIwbIotoF7ehXZyHQKqRDzzvJruiRJX.png', 1, 1, 1, 'user', '', 'otiU0yRJztsWSLcjGe4DXkfymzuvSGlF8013gzSrh2iD3O6rGNT5rsLSEtRK', '2024-06-12 19:55:12', '2024-07-25 20:14:31'),
(3, 'aadarshkavita@gmail.com', NULL, 'Aarti', 'Pal', 'DPS', 'Dehradun', '+91', '9997238020', 'HELLO', '12', 'public/profile/icon/U8othlCqJVW0JAdpxhYu0ZSyvVZJc90evFLu7hpL.png', 'public/profile/banner/NpFOI73ZmgTvMnGi0GCwRAVW6jpsFVCDsWSlT2cp.png', 1, 1, 1, 'user', NULL, 'jMPo6KU6Z0c2x9Jh1lshLHe4mwBhgBRbNslsif6G5vsygnanBjr4iMlpQ3uE', '2024-06-18 11:21:50', '2024-06-18 12:13:40'),
(4, 'digital.endeavour.in+main@gmail.com', NULL, 'Aadarsh Gupta', 'Gupta', 'KMPS', 'Deedhori', '+91', '9617091766', 'I’m the founder of Endeavour Digital.', '12', NULL, 'public/profile/banner/NpFOI73ZmgTvMnGi0GCwRAVW6jpsFVCDsWSlT2cp.png', 1, 1, 1, 'user', NULL, 'q00lBGW3tBHuT2SmwNxKqFhQnxsOSQV8wn2hVnumlLzR56XMsqHEdboRuS6q', '2024-06-18 18:00:37', '2024-07-21 02:39:38'),
(5, 'aaaartipaal@gmail.com', NULL, 'Aarti', 'Pal', 'Sharda Public School', 'Dehradun', '+91', '8979187713', NULL, '12th', NULL, NULL, 1, 0, 1, 'user', NULL, 'rFLNa2mGbGEYYNYR0nrdV9kIvBrG3UqmiVtld4WcpZ0sQMBa2hGIvXTUk4Bw', '2024-06-18 19:22:28', '2024-06-18 21:03:00'),
(6, 'palprachipal86@gmail.com', NULL, 'Poonam', 'Pal', 'Sharda Public School', 'Dehradun', '+91', '8533838857', NULL, '12th', NULL, 'public/profile/banner/NpFOI73ZmgTvMnGi0GCwRAVW6jpsFVCDsWSlT2cp.png', 1, 1, 1, 'user', NULL, 'u4opqHwmrSiQ93tQZgxmam0M7L51td8xzZxdyJScfsPnZX6eD7CF5uIN5knY', '2024-06-18 21:04:13', '2024-06-18 21:21:17'),
(7, 'aadarshkavita+anil@gmail.com', NULL, 'Anil', 'Gupta', 'Dr. B R Ambedkar National Institute of Technology, Jalandhar', 'Jalandhar', '+91', '9691754843', NULL, '12th', NULL, 'public/profile/banner/NpFOI73ZmgTvMnGi0GCwRAVW6jpsFVCDsWSlT2cp.png', 1, 1, 1, 'user', NULL, 'Vhyinu63rbVQLfcSGbUiM9Vbgc924riiZnX9LNdYmtkXBzc3QTHuCjCmKMtv', '2024-06-18 21:43:49', '2024-06-18 21:45:43'),
(10, 'aadarshkavita+mos@gmail.com', NULL, 'Aadarsh', 'Gupta', 'Dr. B R Ambedkar National Institute of Technology, Jalandhar', 'Deedhori', '+91', '8839303700', NULL, 'M.tech', NULL, NULL, 1, 1, 1, 'user', NULL, 'aP5INODSUN6kdHMLmb2G3ThpDoBBRAI5pzkCF1VTr8laAbSaTf6apm5dVoYI', '2024-07-21 13:28:39', '2024-07-25 21:27:49'),
(11, 'yadav.gaurava@gmail.com', NULL, 'Gaurava', 'Yadav', 'CKC', 'Jhansi', '+91', '8400700199', NULL, '12', NULL, NULL, 1, 0, 1, 'user', NULL, 'cpKEALrEuhywzotuhHo2gVl07zlahHDN1bD51MSMwhIvluRYtk9iY7wxGJfM', '2024-07-22 21:12:09', '2024-07-27 16:55:22'),
(12, 'aadarshkavita+USA@gmail.com', NULL, 'Aadarsh Gupta', 'Gupta', 'Dr. B R Ambedkar National Institute of Technology, Jalandhar', 'Deedhori', '+1', '3139424892', NULL, 'M.tech', NULL, NULL, 1, 0, 1, 'user', NULL, '9Gmy2qk8PIbSF2iyf3Tk42j81yhMdp3eoQKaMLFfXezjfTp9SmuV6Unx6ycs', '2024-08-04 13:34:29', '2024-08-04 13:37:35');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
