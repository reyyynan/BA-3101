-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2024 at 03:50 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `donationdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(4, 'admin', '$2y$10$DOMx1If4TmavLAbJB1vijO0zCQUu3o854Ahv.8n3wV0fjsP49zJz2');

-- --------------------------------------------------------

--
-- Table structure for table `bags_donation`
--

CREATE TABLE `bags_donation` (
  `id` int(11) NOT NULL,
  `donor_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `type` enum('kids','teens','adults','all_ages') NOT NULL,
  `condition` enum('new','gently_used','used') NOT NULL,
  `quantity` enum('1','2-5','6-10','bulk') NOT NULL,
  `pickup_dropoff` enum('pickup','dropoff') NOT NULL,
  `schedule_datetime` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bags_donation`
--

INSERT INTO `bags_donation` (`id`, `donor_id`, `name`, `contact_number`, `email`, `type`, `condition`, `quantity`, `pickup_dropoff`, `schedule_datetime`, `created_at`) VALUES
(1, 11, 'huwaw', '0988266123', 'laylojake1231@gmail.com', 'teens', 'used', '2-5', 'pickup', '2024-11-08 22:54:00', '2024-11-04 14:54:14'),
(2, 11, 'Hotdog', '0988266123', 'asdasd@asdadas', 'teens', 'new', '6-10', 'dropoff', '2024-11-09 13:16:00', '2024-11-08 13:16:30');

-- --------------------------------------------------------

--
-- Table structure for table `clothes_donation`
--

CREATE TABLE `clothes_donation` (
  `id` int(11) NOT NULL,
  `donor_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `size_category` enum('kids','teens','adults') NOT NULL,
  `condition` enum('new','gently_used','used') NOT NULL,
  `quantity` enum('1','2-5','6-10','bulk') NOT NULL,
  `pickup_dropoff` enum('pickup','dropoff') NOT NULL,
  `schedule_datetime` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clothes_donation`
--

INSERT INTO `clothes_donation` (`id`, `donor_id`, `name`, `contact_number`, `email`, `size_category`, `condition`, `quantity`, `pickup_dropoff`, `schedule_datetime`, `created_at`) VALUES
(1, 11, 'Hotdog', '0988266123', 'laylojake1231@gmail.com', 'adults', 'new', '6-10', 'pickup', '2024-11-15 13:49:00', '2024-11-04 14:49:08');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `donation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_description` text NOT NULL,
  `donation_date` date NOT NULL,
  `pickup_or_dropoff` enum('pickup','dropoff') NOT NULL,
  `status` enum('pending','completed') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `donation_assignment`
--

CREATE TABLE `donation_assignment` (
  `assignment_id` int(11) NOT NULL,
  `donation_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `assignment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `donor_reg`
--

CREATE TABLE `donor_reg` (
  `donor_id` int(11) NOT NULL,
  `donor_name` varchar(100) NOT NULL,
  `donor_email` varchar(100) NOT NULL,
  `donor_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donor_reg`
--

INSERT INTO `donor_reg` (`donor_id`, `donor_name`, `donor_email`, `donor_password`) VALUES
(8, 'deadlock', 'lock@gmail.com', '$2y$10$7dw6WuRDxWWD8.8hOhA4euwNOvsOm/BvWX/5xLTkFSH0s99RM5X6m'),
(10, 'bob', 'wow@gmail.com', '$2y$10$h9PjJe9tBG6exUPkkDoJjOyTpK1XwcyfsJK/YsF/0tDTd1aO3AZum'),
(11, 'wow', 'hotdog@gmail.com', '$2y$10$XLPMYhlx49ILjutloWeQkecML.TOJ.ShxTI2aWX/8EK8Wt3y9MLDu'),
(12, 'jeez', 'jeez@gmail.com', '$2y$10$c988e8yr99O7iA6FfoUKFeEYSzX7wx3GlIAY76vTPvrBFXf.qkmvK');

-- --------------------------------------------------------

--
-- Table structure for table `item_requests`
--

CREATE TABLE `item_requests` (
  `request_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `item_type` varchar(50) NOT NULL,
  `size_or_type` varchar(50) DEFAULT NULL,
  `condition_preference` varchar(20) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `pickup_dropoff` varchar(20) NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_requests`
--

INSERT INTO `item_requests` (`request_id`, `recipient_id`, `name`, `contact_number`, `email`, `item_type`, `size_or_type`, `condition_preference`, `quantity`, `pickup_dropoff`, `request_date`) VALUES
(1, 6, 'fgf', '09099214078', 'renanleynes@gmail.com', 'Clothes', '7', 'gently_used', 13, 'pickup', '2024-11-08 14:49:04'),
(2, 6, 'jp', '7876876', 'jp@gmail.com', 'Bags', 'backpack', 'new', 700, 'dropoff', '2024-11-08 15:03:31');

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
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1);

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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recipient_reg`
--

CREATE TABLE `recipient_reg` (
  `recipient_id` int(11) NOT NULL,
  `recipient_name` varchar(50) NOT NULL,
  `recipient_email` varchar(100) NOT NULL,
  `recipient_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recipient_reg`
--

INSERT INTO `recipient_reg` (`recipient_id`, `recipient_name`, `recipient_email`, `recipient_password`) VALUES
(3, 'Clove', 'clove@gmail.com', '$2y$10$NWZ0BmlNDfcyIjeJ3YCGsexfBH25hwclo.D2vp07hWqVB5EudGhJa'),
(5, 'w', 'w@gmail.com', '$2y$10$kAC/V5Gz/USuL9k9j1f3se.v6td0fETZeJtG1lnUyphLuePXXvgg2'),
(6, 'speed', 'speed@gmail.com', '$2y$10$t5HAG6OyER811BflS342Z.h/STvAfBUEs12.JiND33cX1uvVWKlyW');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_requested` text NOT NULL,
  `request_date` date NOT NULL,
  `status` enum('pending','approved','denied') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `shoes_donation`
--

CREATE TABLE `shoes_donation` (
  `id` int(11) NOT NULL,
  `donor_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `size_category` enum('kids','teens','adults') NOT NULL,
  `condition` enum('new','gently_used','used') NOT NULL,
  `quantity` enum('1','2-5','6-10','bulk') NOT NULL,
  `pickup_dropoff` enum('pickup','dropoff') NOT NULL,
  `schedule_datetime` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shoes_donation`
--

INSERT INTO `shoes_donation` (`id`, `donor_id`, `name`, `contact_number`, `email`, `size_category`, `condition`, `quantity`, `pickup_dropoff`, `schedule_datetime`, `created_at`) VALUES
(1, 11, 'Hotdog', '0988266123', 'asdasd@asdadas', 'teens', 'gently_used', 'bulk', 'pickup', '2024-11-05 23:18:00', '2024-11-04 13:18:29'),
(2, 11, 'Hotdog', '0988266123', 'asdasd@asdadas', 'adults', 'new', '2-5', 'dropoff', '2024-11-14 23:24:00', '2024-11-04 14:24:17'),
(3, 11, 'Hotdog', '0988266123', 'asdasd@asdadas', 'adults', 'new', '2-5', 'dropoff', '2024-11-14 23:24:00', '2024-11-04 14:27:52'),
(4, 11, 'huwaw', '098822321', 'laylojake1231@gmail.com', 'adults', 'gently_used', '1', 'pickup', '2024-11-21 15:32:00', '2024-11-04 14:28:39'),
(5, 12, 'renan', '09099214078', 'renanleynes@gmail.com', 'kids', 'gently_used', 'bulk', 'pickup', '2024-11-08 12:45:00', '2024-11-08 13:46:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `role` enum('donor','recipient') NOT NULL,
  `registration_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `bags_donation`
--
ALTER TABLE `bags_donation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `donor_id` (`donor_id`);

--
-- Indexes for table `clothes_donation`
--
ALTER TABLE `clothes_donation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `donor_id` (`donor_id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`donation_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `donation_assignment`
--
ALTER TABLE `donation_assignment`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `donation_id` (`donation_id`),
  ADD KEY `request_id` (`request_id`);

--
-- Indexes for table `donor_reg`
--
ALTER TABLE `donor_reg`
  ADD PRIMARY KEY (`donor_id`),
  ADD UNIQUE KEY `donor_email` (`donor_email`);

--
-- Indexes for table `item_requests`
--
ALTER TABLE `item_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `recipient_id` (`recipient_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `recipient_reg`
--
ALTER TABLE `recipient_reg`
  ADD PRIMARY KEY (`recipient_id`),
  ADD UNIQUE KEY `recipient_email` (`recipient_email`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `shoes_donation`
--
ALTER TABLE `shoes_donation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `donor_id` (`donor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bags_donation`
--
ALTER TABLE `bags_donation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clothes_donation`
--
ALTER TABLE `clothes_donation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `donation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `donation_assignment`
--
ALTER TABLE `donation_assignment`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `donor_reg`
--
ALTER TABLE `donor_reg`
  MODIFY `donor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `item_requests`
--
ALTER TABLE `item_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recipient_reg`
--
ALTER TABLE `recipient_reg`
  MODIFY `recipient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shoes_donation`
--
ALTER TABLE `shoes_donation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bags_donation`
--
ALTER TABLE `bags_donation`
  ADD CONSTRAINT `bags_donation_ibfk_1` FOREIGN KEY (`donor_id`) REFERENCES `donor_reg` (`donor_id`);

--
-- Constraints for table `clothes_donation`
--
ALTER TABLE `clothes_donation`
  ADD CONSTRAINT `clothes_donation_ibfk_1` FOREIGN KEY (`donor_id`) REFERENCES `donor_reg` (`donor_id`);

--
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `donations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `donation_assignment`
--
ALTER TABLE `donation_assignment`
  ADD CONSTRAINT `donation_assignment_ibfk_1` FOREIGN KEY (`donation_id`) REFERENCES `donations` (`donation_id`),
  ADD CONSTRAINT `donation_assignment_ibfk_2` FOREIGN KEY (`request_id`) REFERENCES `requests` (`request_id`);

--
-- Constraints for table `item_requests`
--
ALTER TABLE `item_requests`
  ADD CONSTRAINT `item_requests_ibfk_1` FOREIGN KEY (`recipient_id`) REFERENCES `recipient_reg` (`recipient_id`) ON DELETE CASCADE;

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `shoes_donation`
--
ALTER TABLE `shoes_donation`
  ADD CONSTRAINT `shoes_donation_ibfk_1` FOREIGN KEY (`donor_id`) REFERENCES `donor_reg` (`donor_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
