-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2023 at 07:17 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hikari_log`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `log_time` datetime NOT NULL,
  `system_name` varchar(255) NOT NULL,
  `process_name` varchar(255) NOT NULL,
  `query` varchar(50) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `computer_ip` varchar(50) NOT NULL,
  `computer_name` varchar(255) NOT NULL,
  `script_name` varchar(255) NOT NULL,
  `host` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `token`, `log_time`, `system_name`, `process_name`, `query`, `employee_name`, `employee_id`, `computer_ip`, `computer_name`, `script_name`, `host`) VALUES
(1, '3b910df5d47519ba949131363732333732323136', '2022-12-30 10:50:16', 'Hikari', 'Login', 'select', 'Kanji Kato', '23437', '172.17.192.4', '172.17.192.4', '/hikari/auth/authen.php', '172.17.192.131'),
(2, '3b910df5d47519ba949131363732333732323136', '2022-12-30 11:13:06', 'Mezzanine', 'dashboard', 'read', 'Kanji Kato', '23437', '172.17.192.4', '172.17.192.4', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(3, '3b910df5d47519ba949131363732333732323136', '2022-12-30 11:13:28', 'Mezzanine', 'dashboard', 'read', 'Kanji Kato', '23437', '172.17.192.4', '172.17.192.4', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(4, '3b910df5d47519ba949131363732333732323136', '2022-12-30 11:14:02', 'Mezzanine', 'dashboard', 'read', 'Kanji Kato', '23437', '172.17.192.4', '172.17.192.4', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(5, '3b910df5d47519ba949131363732333732323136', '2022-12-30 11:25:23', 'Mezzanine', 'dashboard', 'read', 'Kanji Kato', '23437', '172.17.192.4', '172.17.192.4', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(6, 'bc8202ddf7276dcef92e31363732363137363637', '2023-01-02 07:01:07', 'Hikari', 'Login', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(7, 'bc8202ddf7276dcef92e31363732363137363637', '2023-01-02 07:01:32', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(8, 'bc8202ddf7276dcef92e31363732363137363637', '2023-01-02 07:10:59', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(9, 'bc8202ddf7276dcef92e31363732363137363637', '2023-01-02 07:11:08', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(10, 'bc8202ddf7276dcef92e31363732363137363637', '2023-01-02 07:29:11', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(11, 'bc8202ddf7276dcef92e31363732363137363637', '2023-01-02 07:37:44', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(12, 'bc8202ddf7276dcef92e31363732363137363637', '2023-01-02 07:42:34', 'Hikari', 'Logout', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/act_logout.php', '172.17.192.131'),
(13, 'd14a2324a69d94563a7b31363732363230313538', '2023-01-02 07:42:38', 'Hikari', 'Login', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(14, 'd14a2324a69d94563a7b31363732363230313538', '2023-01-02 07:43:53', 'Hikari', 'Logout', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/act_logout.php', '172.17.192.131'),
(15, 'c261b0abb0ec468abca331363732363230323336', '2023-01-02 07:43:56', 'Hikari', 'Login', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(16, 'c261b0abb0ec468abca331363732363230323336', '2023-01-02 07:44:30', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(17, 'c261b0abb0ec468abca331363732363230323336', '2023-01-02 07:44:55', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(18, 'c261b0abb0ec468abca331363732363230323336', '2023-01-02 07:48:44', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(19, 'c261b0abb0ec468abca331363732363230323336', '2023-01-02 08:15:26', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(20, 'c261b0abb0ec468abca331363732363230323336', '2023-01-02 08:15:32', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(21, 'c261b0abb0ec468abca331363732363230323336', '2023-01-02 08:15:46', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(22, 'c261b0abb0ec468abca331363732363230323336', '2023-01-02 08:18:17', 'Hikari', 'Logout', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/act_logout.php', '172.17.192.131'),
(23, '2cb98e729ea6840f25b031363732363232333031', '2023-01-02 08:18:21', 'Hikari', 'Login', 'select', 'admin ww', 'a1', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(24, '2cb98e729ea6840f25b031363732363232333031', '2023-01-02 08:20:39', 'Hikari', 'Logout', 'select', 'admin ww', 'a1', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/act_logout.php', '172.17.192.131'),
(25, '960da4339731d4f97d7a31363732363232343434', '2023-01-02 08:20:44', 'Hikari', 'Login', 'select', 'admin painting', 'b1', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(26, '960da4339731d4f97d7a31363732363232343434', '2023-01-02 08:21:59', 'Hikari', 'Logout', 'select', 'admin painting', 'b1', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/act_logout.php', '172.17.192.131'),
(27, '8090902e3081f15b192f31363732363232353234', '2023-01-02 08:22:02', 'Hikari', 'Login', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(28, '1eec0f5552f1c737db8d31363732363232353235', '2023-01-02 08:22:04', 'Hikari', 'Login', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(29, 'a6313dc333ee239262f631363732363232353530', '2023-01-02 08:22:30', 'Hikari', 'Login', 'select', 'admin ww', 'a1', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(30, '1eec0f5552f1c737db8d31363732363232353235', '2023-01-02 08:23:26', 'Hikari', 'Logout', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/act_logout.php', '172.17.192.131'),
(31, '8eec7ec96e731562425731363732363232363136', '2023-01-02 08:23:36', 'Hikari', 'Login', 'select', 'admin ww', 'a1', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(32, '8eec7ec96e731562425731363732363232363136', '2023-01-02 08:23:46', 'Mezzanine', 'dashboard', 'read', 'admin ww', 'a1', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(33, '8eec7ec96e731562425731363732363232363136', '2023-01-02 09:03:34', 'Mezzanine', 'dashboard', 'read', 'admin ww', 'a1', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(34, '8eec7ec96e731562425731363732363232363136', '2023-01-02 09:06:07', 'Hikari', 'Logout', 'select', 'admin ww', 'a1', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/act_logout.php', '172.17.192.131'),
(35, 'cbd523c032c0cd682a9d31363732363530323434', '2023-01-02 16:04:04', 'Hikari', 'Login', 'select', 'Nana Suryana', '20621', '172.17.192.59', 'nana.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(36, 'cbd523c032c0cd682a9d31363732363530323434', '2023-01-02 16:04:14', 'Mezzanine', 'dashboard', 'read', 'Nana Suryana', '20621', '172.17.192.59', 'nana.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(37, 'cbd523c032c0cd682a9d31363732363530323434', '2023-01-02 16:04:26', 'Hikari', 'Logout', 'select', 'Nana Suryana', '20621', '172.17.192.59', 'nana.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/act_logout.php', '172.17.192.131'),
(38, '915c8f1732aee7ee775d31363732373037333031', '2023-01-03 07:55:01', 'Hikari', 'Login', 'select', 'Fajar Sahara E S', '21884', '172.17.192.55', 'fajar.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(39, '4d207cba3d3337e028e331363732373038393332', '2023-01-03 08:22:12', 'Hikari', 'Login', 'select', 'Fajar Sahara E S', '21884', '172.17.192.131', 'support-center.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(40, '39df19c9aeeccd92012f31363732373138303630', '2023-01-03 10:54:20', 'Hikari', 'Login', 'select', 'Fajar Sahara E S', '21884', '172.17.192.55', 'fajar.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(41, '2a3fa43a7290c9e2498331363732373138323335', '2023-01-03 10:57:15', 'Hikari', 'Login', 'select', 'Romi Maryono', '21220', '172.17.192.94', 'romi.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(42, '9e623c6186ae6667bcbc31363732373237353232', '2023-01-03 13:32:02', 'Hikari', 'Login', 'select', 'Fajar Sahara E S', '21884', '172.17.192.55', 'fajar.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(43, 'b1f4cacfb4848a1c5fe431363732373339343034', '2023-01-03 16:50:04', 'Hikari', 'Login', 'select', 'Fajar Sahara E S', '21884', '172.17.192.55', 'fajar.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(44, 'b7b34f8da4b2f4e4a34c31363732373433303037', '2023-01-03 17:50:07', 'Hikari', 'Login', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(45, 'b7b34f8da4b2f4e4a34c31363732373433303037', '2023-01-03 17:50:18', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(46, 'b7b34f8da4b2f4e4a34c31363732373433303037', '2023-01-03 17:50:42', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(47, 'b7b34f8da4b2f4e4a34c31363732373433303037', '2023-01-03 17:50:47', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(48, 'b7b34f8da4b2f4e4a34c31363732373433303037', '2023-01-03 17:50:51', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(49, 'b7b34f8da4b2f4e4a34c31363732373433303037', '2023-01-03 17:51:55', 'Hikari', 'Logout', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/act_logout.php', '172.17.192.131'),
(50, '', '2023-01-03 17:52:02', 'Hikari', 'Logout', 'select', '', '', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/act_logout.php', '172.17.192.131'),
(51, '86a87e6929bd5f28e2d131363732373433313239', '2023-01-03 17:52:09', 'Hikari', 'Login', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(52, '86a87e6929bd5f28e2d131363732373433313239', '2023-01-03 17:52:16', 'Hikari', 'Logout', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/act_logout.php', '172.17.192.131'),
(53, '5fdbf9aea0dec54c983b31363732373931363937', '2023-01-04 07:21:37', 'Hikari', 'Login', 'select', 'Agung Sumiaji', '20607', '172.17.192.202', 'dell188.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(54, '5fdbf9aea0dec54c983b31363732373931363937', '2023-01-04 07:24:06', 'Mezzanine', 'dashboard', 'read', 'Agung Sumiaji', '20607', '172.17.192.202', 'dell188.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(55, 'b62bd00107e6c6ede8c631363732383832303936', '2023-01-05 08:28:16', 'Hikari', 'Login', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(56, 'b62bd00107e6c6ede8c631363732383832303936', '2023-01-05 08:28:20', 'Compatibility Model', 'halaman utama (dark)', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/compatibility_model/d/dashboard/index.php', '172.17.192.131'),
(57, '', '2023-01-05 08:54:51', 'Compatibility Model', 'halaman utama (dark)', 'read', '', '', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/compatibility_model/d/dashboard/index.php', '172.17.192.131'),
(58, 'f6d1be68111523151eb231363732383833363936', '2023-01-05 08:54:56', 'Hikari', 'Login', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(59, 'f6d1be68111523151eb231363732383833363936', '2023-01-05 08:54:59', 'Compatibility Model', 'halaman utama (dark)', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/compatibility_model/d/dashboard/index.php', '172.17.192.131'),
(60, 'f6d1be68111523151eb231363732383833363936', '2023-01-05 09:02:58', 'Hikari', 'Logout', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/act_logout.php', '172.17.192.131'),
(61, '48525eba33fc0fbbc0e731363732383836363035', '2023-01-05 09:43:25', 'Hikari', 'Login', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(62, '48525eba33fc0fbbc0e731363732383836363035', '2023-01-05 09:43:28', 'Compatibility Model', 'halaman utama (dark)', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/compatibility_model/d/dashboard/index.php', '172.17.192.131'),
(63, 'd10c755dca87edf9c5c731363732383839363433', '2023-01-05 10:34:03', 'Hikari', 'Login', 'select', 'Fajar Sahara E S', '21884', '172.17.192.55', 'fajar.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(64, '109ace1b77f070326d7c31363732383930373731', '2023-01-05 10:52:51', 'Hikari', 'Login', 'select', 'Agung Sumiaji', '20607', '172.17.192.4', '172.17.192.4', '/hikari/auth/authen.php', '172.17.192.131'),
(65, '24527d194b6ee9f1eac031363732383930373736', '2023-01-05 10:52:55', 'Hikari', 'Login', 'select', 'Agung Sumiaji', '20607', '172.17.192.4', '172.17.192.4', '/hikari/auth/authen.php', '172.17.192.131'),
(66, '6cb069cafd59367c302b31363732383931313736', '2023-01-05 10:59:36', 'Hikari', 'Login', 'select', 'Agung Sumiaji', '20607', '172.17.192.4', '172.17.192.4', '/hikari/auth/authen.php', '172.17.192.131'),
(67, '48525eba33fc0fbbc0e731363732383836363035', '2023-01-05 11:04:29', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(68, '', '2023-01-05 16:38:40', 'Mezzanine', 'dashboard', 'read', '', '', '172.17.192.4', '172.17.192.4', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(69, '7aa01b375d730c5a59b331363732393132363534', '2023-01-05 16:57:34', 'Hikari', 'Login', 'select', 'Agung Sumiaji', '20607', '172.17.192.4', '172.17.192.4', '/hikari/auth/authen.php', '172.17.192.131'),
(70, '6b6cdf0b9863131aae6731363732393132393232', '2023-01-05 17:02:02', 'Hikari', 'Login', 'select', 'Agung Sumiaji', '20607', '172.17.192.4', 'THINKPAD-L380', '/hikari/auth/authen.php', '172.17.192.131'),
(71, '32068c089f7fa29e3bce31363732393133323932', '2023-01-05 17:08:12', 'Hikari', 'Login', 'select', 'Agung Sumiaji', '20607', '172.17.192.4', '172.17.192.4', '/hikari/auth/authen.php', '172.17.192.131'),
(72, '3004f11f5d8bf4184e4d31363732393133343539', '2023-01-05 17:10:59', 'Hikari', 'Login', 'select', 'Agung Sumiaji', '20607', '172.17.192.4', '172.17.192.4', '/hikari/auth/authen.php', '172.17.192.131'),
(73, '3004f11f5d8bf4184e4d31363732393133343539', '2023-01-05 17:33:53', 'Mezzanine', 'dashboard', 'read', 'Agung Sumiaji', '20607', '172.17.192.4', '172.17.192.4', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(74, '3004f11f5d8bf4184e4d31363732393133343539', '2023-01-05 17:34:49', 'Hikari', 'Logout', 'select', 'Agung Sumiaji', '20607', '172.17.192.4', '172.17.192.4', '/hikari/auth/act_logout.php', '172.17.192.131'),
(75, '0f025a0b91d16068ec4b31363732393135303230', '2023-01-05 17:37:00', 'Hikari', 'Login', 'select', 'Agung Sumiaji', '20607', '10.130.91.52', '10.130.91.52', '/hikari/auth/authen.php', '172.17.192.131'),
(76, '9becd0c8eb1ea784831631363732393738393833', '2023-01-06 11:23:03', 'Hikari', 'Login', 'select', 'Agung Sumiaji', '20607', '172.17.192.4', '172.17.192.4', '/hikari/auth/authen.php', '172.17.192.131'),
(77, '9becd0c8eb1ea784831631363732393738393833', '2023-01-06 11:33:02', 'Mezzanine', 'dashboard', 'read', 'Agung Sumiaji', '20607', '172.17.192.4', '172.17.192.4', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(78, '3ab73f173e539c3adcea31363732393834393634', '2023-01-06 13:02:44', 'Hikari', 'Login', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(79, '3ab73f173e539c3adcea31363732393834393634', '2023-01-06 13:02:53', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(80, '3ab73f173e539c3adcea31363732393834393634', '2023-01-06 13:05:28', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(81, '3ab73f173e539c3adcea31363732393834393634', '2023-01-06 13:06:28', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(82, '3ab73f173e539c3adcea31363732393834393634', '2023-01-06 13:08:16', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(83, '3ab73f173e539c3adcea31363732393834393634', '2023-01-06 13:09:05', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(84, '3ab73f173e539c3adcea31363732393834393634', '2023-01-06 13:09:38', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(85, '3ab73f173e539c3adcea31363732393834393634', '2023-01-06 13:15:13', 'Compatibility Model', 'halaman utama (dark)', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/compatibility_model/d/dashboard/index.php', '172.17.192.131'),
(86, '3ab73f173e539c3adcea31363732393834393634', '2023-01-06 13:15:25', 'Compatibility Model', 'halaman utama (dark)', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/compatibility_model/d/dashboard/index.php', '172.17.192.131'),
(87, '9becd0c8eb1ea784831631363732393738393833', '2023-01-06 13:34:55', 'Mezzanine', 'dashboard', 'read', 'Agung Sumiaji', '20607', '172.17.192.4', '172.17.192.4', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(88, '343cf899fa440095c8cb31363733323237343331', '2023-01-09 08:23:51', 'Hikari', 'Login', 'select', 'Fajar Sahara E S', '21884', '172.17.192.55', 'fajar.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(89, '2fdd63bb43d5c89d0ede31363733323333373435', '2023-01-09 10:09:05', 'Hikari', 'Login', 'select', 'Agung Sumiaji', '20607', '172.17.192.4', '172.17.192.4', '/hikari/auth/authen.php', '172.17.192.131'),
(90, 'aa19da48a56b22b2d44931363733323334363737', '2023-01-09 10:24:37', 'Hikari', 'Login', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(91, 'aa19da48a56b22b2d44931363733323334363737', '2023-01-09 10:29:01', 'Hikari', 'Logout', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/act_logout.php', '172.17.192.131'),
(92, '55096365c8003ae666fc31363733323334393732', '2023-01-09 10:29:32', 'Hikari', 'Login', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(93, '55096365c8003ae666fc31363733323334393732', '2023-01-09 10:29:43', 'Hikari', 'Logout', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/act_logout.php', '172.17.192.131'),
(94, 'd484f9c8f5c555cb9f6831363733323336333734', '2023-01-09 10:52:54', 'Hikari', 'Login', 'select', 'Kanji Kato', '23437', '172.17.192.4', '172.17.192.4', '/hikari/auth/authen.php', '172.17.192.131'),
(95, '97b04b59d678441b74a631363733323336333935', '2023-01-09 10:53:15', 'Hikari', 'Login', 'select', 'Kanji Kato', '23437', '172.17.192.4', 'THINKPAD-L380', '/hikari/auth/authen.php', '172.17.192.131'),
(96, 'c357c3d6fc4ff82fc63b31363733323338363535', '2023-01-09 11:30:55', 'Hikari', 'Login', 'select', 'M Adzka SFR', '24891', '172.17.192.4', 'THINKPAD-L380', '/hikari/auth/authen.php', '172.17.192.131'),
(97, 'c357c3d6fc4ff82fc63b31363733323338363535', '2023-01-09 11:31:20', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.4', 'THINKPAD-L380', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(98, 'c357c3d6fc4ff82fc63b31363733323338363535', '2023-01-09 12:25:45', 'Hikari', 'Logout', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/act_logout.php', '172.17.192.131'),
(99, '6d7d0600e3a92b9b7e1731363733323431393832', '2023-01-09 12:26:22', 'Hikari', 'Login', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(100, '6d7d0600e3a92b9b7e1731363733323431393832', '2023-01-09 13:21:46', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.4', '172.17.192.4', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(101, '6d7d0600e3a92b9b7e1731363733323431393832', '2023-01-09 13:21:51', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.4', '172.17.192.4', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(102, '6d7d0600e3a92b9b7e1731363733323431393832', '2023-01-09 13:40:22', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(103, 'e42afb4ea7111858240531363733323439313835', '2023-01-09 14:26:25', 'Hikari', 'Login', 'select', 'Faizin', '20211', '172.17.192.160', 'faizin-pc.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(104, 'e42afb4ea7111858240531363733323439313835', '2023-01-09 14:27:03', 'Mezzanine', 'dashboard', 'read', 'Faizin', '20211', '172.17.192.160', 'faizin-pc.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(105, '954a978f948debb7f82031363733323533383039', '2023-01-09 15:43:29', 'Hikari', 'Login', 'select', 'Fajar Sahara E S', '21884', '172.17.192.4', 'THINKPAD-L380', '/hikari/auth/authen.php', '172.17.192.131'),
(106, '8ffb821b0f394d9c588a31363733333134363231', '2023-01-10 08:37:01', 'Hikari', 'Login', 'select', 'Fajar Sahara E S', '21884', '172.17.192.55', 'fajar.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(107, '2e198027b7996cc47fb831363733333135373133', '2023-01-10 08:55:12', 'Hikari', 'Login', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(108, '2e198027b7996cc47fb831363733333135373133', '2023-01-10 08:59:21', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(109, 'bf026197d80fa65f6aee31363733333437363539', '2023-01-10 17:47:39', 'Hikari', 'Login', 'select', 'Agung Sumiaji', '20607', '172.17.192.4', '172.17.192.4', '/hikari/auth/authen.php', '172.17.192.131'),
(110, 'bf026197d80fa65f6aee31363733333437363539', '2023-01-10 17:49:18', 'Mezzanine', 'dashboard', 'read', 'Agung Sumiaji', '20607', '172.17.192.4', '172.17.192.4', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(111, '0723c1363dc905a1f3b331363733333935363330', '2023-01-11 07:07:09', 'Hikari', 'Login', 'select', 'Agus Suminto', '20112', '172.17.192.47', 'agus_suminto.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(112, '0723c1363dc905a1f3b331363733333935363330', '2023-01-11 07:10:06', 'Mezzanine', 'dashboard', 'read', 'Agus Suminto', '20112', '172.17.192.47', 'agus_suminto.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(113, '', '2023-01-11 12:26:52', 'Mezzanine', 'dashboard', 'read', '', '', '172.17.192.47', 'agus_suminto.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(114, 'ab54d1d6348d1a6681f731363733343134383135', '2023-01-11 12:26:55', 'Hikari', 'Login', 'select', 'Agus Suminto', '20112', '172.17.192.47', 'agus_suminto.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(115, 'ab54d1d6348d1a6681f731363733343134383135', '2023-01-11 12:27:39', 'Mezzanine', 'dashboard', 'read', 'Agus Suminto', '20112', '172.17.192.47', 'agus_suminto.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(116, 'cd3464a9b5d27c89e5b831363733343138353638', '2023-01-11 13:29:28', 'Hikari', 'Login', 'select', 'Guest 1', '12345', '172.17.192.128', 'ari.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(117, 'cd3464a9b5d27c89e5b831363733343138353638', '2023-01-11 13:30:04', 'Compatibility Model', 'halaman utama (dark)', 'read', 'Guest 1', '12345', '172.17.192.128', 'ari.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/compatibility_model/d/dashboard/index.php', '172.17.192.131'),
(118, 'cd3464a9b5d27c89e5b831363733343138353638', '2023-01-11 13:30:23', 'Compatibility Model', 'halaman utama (light)', 'read', 'Guest 1', '12345', '172.17.192.128', 'ari.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/compatibility_model/d/dashboard/index_light.php', '172.17.192.131'),
(119, 'cd3464a9b5d27c89e5b831363733343138353638', '2023-01-11 13:30:26', 'Compatibility Model', 'halaman utama (dark)', 'read', 'Guest 1', '12345', '172.17.192.128', 'ari.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/compatibility_model/d/dashboard/index.php', '172.17.192.131'),
(120, '9ed5eceba281964150cc31363733343834313035', '2023-01-12 07:41:45', 'Hikari', 'Login', 'select', 'Denis Ibnu Adam', '23250', '172.17.192.4', '172.17.192.4', '/hikari/auth/authen.php', '172.17.192.131'),
(121, '9ed5eceba281964150cc31363733343834313035', '2023-01-12 07:45:05', 'Compatibility Model', 'halaman utama (dark)', 'read', 'Denis Ibnu Adam', '23250', '172.17.192.4', '172.17.192.4', '/hikari/app/production/compatibility_model/d/dashboard/index.php', '172.17.192.131'),
(122, '9ed5eceba281964150cc31363733343834313035', '2023-01-12 07:45:20', 'Compatibility Model', 'halaman utama (light)', 'read', 'Denis Ibnu Adam', '23250', '172.17.192.4', '172.17.192.4', '/hikari/app/production/compatibility_model/d/dashboard/index_light.php', '172.17.192.131'),
(123, '9ed5eceba281964150cc31363733343834313035', '2023-01-12 07:45:24', 'Compatibility Model', 'halaman utama (light)', 'read', 'Denis Ibnu Adam', '23250', '172.17.192.4', '172.17.192.4', '/hikari/app/production/compatibility_model/d/dashboard/index_light.php', '172.17.192.131'),
(124, '804876ca4f904d9716f031363733353034333031', '2023-01-12 13:18:21', 'Hikari', 'Login', 'select', 'Agung Sumiaji', '20607', '172.17.192.4', '172.17.192.4', '/hikari/auth/authen.php', '172.17.192.131'),
(125, '804876ca4f904d9716f031363733353034333031', '2023-01-12 13:23:35', 'Mezzanine', 'dashboard', 'read', 'Agung Sumiaji', '20607', '172.17.192.4', '172.17.192.4', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(126, '04c591c748f683be5b9c31363733353130333736', '2023-01-12 14:59:35', 'Hikari', 'Login', 'select', 'Faizin', '20211', '172.17.192.4', '172.17.192.4', '/hikari/auth/authen.php', '172.17.192.131'),
(127, '04c591c748f683be5b9c31363733353130333736', '2023-01-12 14:59:54', 'Mezzanine', 'dashboard', 'read', 'Faizin', '20211', '172.17.192.4', '172.17.192.4', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(128, '04c591c748f683be5b9c31363733353130333736', '2023-01-12 15:01:24', 'Mezzanine', 'dashboard', 'read', 'Faizin', '20211', '172.17.192.4', '172.17.192.4', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(129, '04c591c748f683be5b9c31363733353130333736', '2023-01-12 15:01:58', 'Mezzanine', 'dashboard', 'read', 'Faizin', '20211', '172.17.192.4', '172.17.192.4', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(130, '04c591c748f683be5b9c31363733353130333736', '2023-01-12 16:14:42', 'Mezzanine', 'dashboard', 'read', 'Faizin', '20211', '172.17.192.160', 'faizin-pc.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(131, 'b9b768ccbaf8a143e90531363733353733323337', '2023-01-13 08:27:17', 'Hikari', 'Login', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(132, 'dbc92b508e3b20bfbe2731363733353738333839', '2023-01-13 09:53:09', 'Hikari', 'Login', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(133, 'bdcef18d91093390ec4631363733353932333439', '2023-01-13 13:45:49', 'Hikari', 'Login', 'select', 'Erik Dwi Sandra', '24702', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(134, 'bdcef18d91093390ec4631363733353932333439', '2023-01-13 13:46:14', 'Hikari', 'Logout', 'select', 'Erik Dwi Sandra', '24702', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/act_logout.php', '172.17.192.131'),
(135, '5a5daadd217a33e0549431363733353932343038', '2023-01-13 13:46:48', 'Hikari', 'Login', 'select', 'Rian Dwi O', '20612', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(136, '5a5daadd217a33e0549431363733353932343038', '2023-01-13 13:47:32', 'Hikari', 'Logout', 'select', 'Rian Dwi O', '20612', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/act_logout.php', '172.17.192.131'),
(137, 'd947e6804c297e5f299731363733353933373631', '2023-01-13 14:09:21', 'Hikari', 'Login', 'select', 'Rian Dwi O', '20612', '172.17.192.115', 'rian.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(138, 'd947e6804c297e5f299731363733353933373631', '2023-01-13 14:09:47', 'Hikari', 'Logout', 'select', 'Rian Dwi O', '20612', '172.17.192.115', 'rian.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/act_logout.php', '172.17.192.131'),
(139, '18dc04522d6e97975f7831363733353939333931', '2023-01-13 15:43:11', 'Hikari', 'Login', 'select', 'Rian Dwi O', '20612', '172.17.192.115', 'rian.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(140, '18dc04522d6e97975f7831363733353939333931', '2023-01-13 15:43:41', 'Hikari', 'Logout', 'select', 'Rian Dwi O', '20612', '172.17.192.115', 'rian.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/act_logout.php', '172.17.192.131'),
(141, '432f78707f9122fc809431363733353939343238', '2023-01-13 15:43:48', 'Hikari', 'Login', 'select', 'Erik Dwi Sandra', '24702', '172.17.192.115', 'rian.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(142, '432f78707f9122fc809431363733353939343238', '2023-01-13 15:44:03', 'Compatibility Model', 'halaman utama (dark)', 'read', 'Erik Dwi Sandra', '24702', '172.17.192.115', 'rian.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/compatibility_model/d/dashboard/index.php', '172.17.192.131'),
(143, '43075138ee85ed12b8da31363733383337353632', '2023-01-16 09:52:42', 'Hikari', 'Login', 'select', 'Erik Dwi Sandra', '24702', '172.17.192.115', 'rian.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(144, '1ab6ebce33935a76131731363733383337353931', '2023-01-16 09:53:11', 'Hikari', 'Login', 'select', 'Faizin', '20211', '172.17.192.4', '172.17.192.4', '/hikari/auth/authen.php', '172.17.192.131'),
(145, '1ab6ebce33935a76131731363733383337353931', '2023-01-16 09:53:25', 'Mezzanine', 'dashboard', 'read', 'Faizin', '20211', '172.17.192.4', '172.17.192.4', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(146, 'd596d6ccacd315baafb831363733393136363131', '2023-01-17 07:50:11', 'Hikari', 'Login', 'select', 'Denis Ibnu Adam', '23250', '172.17.192.48', 'denis.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(147, '4ef5f238d2e670e5e19b31363733393335333232', '2023-01-17 13:02:02', 'Hikari', 'Login', 'select', 'Rian Dwi O', '20612', '172.17.192.115', 'rian.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(148, '4ef5f238d2e670e5e19b31363733393335333232', '2023-01-17 13:06:04', 'Compatibility Model', 'halaman utama (dark)', 'read', 'Rian Dwi O', '20612', '172.17.192.115', 'rian.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/compatibility_model/d/dashboard/index.php', '172.17.192.131'),
(149, '4ef5f238d2e670e5e19b31363733393335333232', '2023-01-17 13:24:08', 'Hikari', 'Logout', 'select', 'Rian Dwi O', '20612', '172.17.192.115', 'rian.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/act_logout.php', '172.17.192.131'),
(150, '62b54ee8cbb84f319d8531363734303239343235', '2023-01-18 15:10:25', 'Hikari', 'Login', 'select', 'Faizin', '20211', '172.17.192.4', '172.17.192.4', '/hikari/auth/authen.php', '172.17.192.131'),
(151, '62b54ee8cbb84f319d8531363734303239343235', '2023-01-18 15:11:38', 'Compatibility Model', 'halaman utama (dark)', 'read', 'Faizin', '20211', '172.17.192.4', '172.17.192.4', '/hikari/app/production/compatibility_model/d/dashboard/index.php', '172.17.192.131'),
(152, '62b54ee8cbb84f319d8531363734303239343235', '2023-01-18 15:12:08', 'Compatibility Model', 'halaman utama (light)', 'read', 'Faizin', '20211', '172.17.192.4', '172.17.192.4', '/hikari/app/production/compatibility_model/d/dashboard/index_light.php', '172.17.192.131'),
(153, '62b54ee8cbb84f319d8531363734303239343235', '2023-01-18 15:12:36', 'Mezzanine', 'dashboard', 'read', 'Faizin', '20211', '172.17.192.4', '172.17.192.4', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(154, '3162705e053403c85f5931363734313035393030', '2023-01-19 12:25:00', 'Hikari', 'Login', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(155, '3162705e053403c85f5931363734313035393030', '2023-01-19 12:25:11', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(156, '3162705e053403c85f5931363734313035393030', '2023-01-19 12:26:30', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(157, '', '2023-01-19 13:30:48', 'Mezzanine', 'dashboard', 'read', '', '', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(158, 'ad77ab16099b67e1c09731363734313039383532', '2023-01-19 13:30:52', 'Hikari', 'Login', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(159, '09460f902301ce0da51f31363734313238373138', '2023-01-19 18:45:18', 'Hikari', 'Login', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(160, '09460f902301ce0da51f31363734313238373138', '2023-01-19 18:45:30', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(161, '09460f902301ce0da51f31363734313238373138', '2023-01-19 18:45:37', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(162, '803784d3886d4a6a1d6a31363734343339303232', '2023-01-23 08:57:02', 'Hikari', 'Login', 'select', 'Agung Sumiaji', '20607', '172.17.192.123', 'training_5.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(163, '1a1b48e25a8926907cd631363734343339393138', '2023-01-23 09:11:58', 'Hikari', 'Login', 'select', 'Guest 1', '12345', '172.17.193.253', '172.17.193.253', '/hikari/auth/authen.php', '172.17.192.131'),
(164, '1a1b48e25a8926907cd631363734343339393138', '2023-01-23 09:12:16', 'Compatibility Model', 'halaman utama (dark)', 'read', 'Guest 1', '12345', '172.17.193.253', '172.17.193.253', '/hikari/app/production/compatibility_model/d/dashboard/index.php', '172.17.192.131'),
(165, '1a1b48e25a8926907cd631363734343339393138', '2023-01-23 09:12:34', 'Mezzanine', 'dashboard', 'read', 'Guest 1', '12345', '172.17.193.253', '172.17.193.253', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(166, '1a1b48e25a8926907cd631363734343339393138', '2023-01-23 09:13:36', 'Mezzanine', 'dashboard', 'read', 'Guest 1', '12345', '172.17.193.253', '172.17.193.253', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(167, '0a754ddc4f5ef930375631363734343432313239', '2023-01-23 09:48:49', 'Hikari', 'Login', 'select', 'Faizin', '20211', '172.17.192.4', '172.17.192.4', '/hikari/auth/authen.php', '172.17.192.131'),
(168, '0a754ddc4f5ef930375631363734343432313239', '2023-01-23 09:49:45', 'Mezzanine', 'dashboard', 'read', 'Faizin', '20211', '172.17.192.4', '172.17.192.4', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(169, '7e0b5fdac71e4ffdb38531363734343433343637', '2023-01-23 10:11:07', 'Hikari', 'Login', 'select', 'Fajar Sahara E S', '21884', '172.17.192.55', 'fajar.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(170, '41fe78d437fecde3d75631363734343436323234', '2023-01-23 10:57:03', 'Hikari', 'Login', 'select', 'Agung Sumiaji', '20607', '172.17.192.142', 'syshub.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(171, '1bc5225e4f7e8ee187ef31363734353631323938', '2023-01-24 18:54:58', 'Hikari', 'Login', 'select', 'Agung Sumiaji', '20607', '172.17.192.4', 'THINKPAD-L380', '/hikari/auth/authen.php', '172.17.192.131'),
(172, '63d1d48ecece595e3f9231363734363130363437', '2023-01-25 08:37:27', 'Hikari', 'Login', 'select', 'Ika Monika', '21235', '172.17.192.4', '172.17.192.4', '/hikari/auth/authen.php', '172.17.192.131'),
(173, 'b59d9b3d099f1846dae631363734363136393639', '2023-01-25 10:22:49', 'Hikari', 'Login', 'select', 'Agung Sumiaji', '20607', '172.17.192.123', 'training_5.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(174, 'ad0d566209a59e77ea2231363734363137323430', '2023-01-25 10:27:20', 'Hikari', 'Login', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.131'),
(175, 'ad0d566209a59e77ea2231363734363137323430', '2023-01-25 10:28:35', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(176, 'ad0d566209a59e77ea2231363734363137323430', '2023-01-25 10:43:15', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(177, 'ad0d566209a59e77ea2231363734363137323430', '2023-01-25 10:44:26', 'Mezzanine', 'dashboard', 'read', 'M Adzka SFR', '24891', '172.17.192.242', 'adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/app/production/otr_main/d/dashboard/main.php', '172.17.192.131'),
(178, '65769eac15d32560829831363734363138383432', '2023-01-25 11:05:48', 'Hikari', 'Logout', 'select', 'Suparmin', 'r2', '172.17.192.242', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/act_logout.php', '172.17.192.242'),
(179, '15767ccbcf46fb11db8531363734363139353536', '2023-01-25 11:05:56', 'Hikari', 'Login', 'select', 'Display Out Check', 'out', '172.17.192.242', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.242'),
(180, 'ac5b33de2a1bb9c2149e31363734363234363236', '2023-01-25 12:30:26', 'Hikari', 'Login', 'select', 'Vera', 'o1', '172.17.192.242', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.242'),
(181, '15767ccbcf46fb11db8531363734363139353536', '2023-01-25 12:53:46', 'Hikari', 'Logout', 'select', 'Display Out Check', 'out', '172.17.192.242', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/act_logout.php', '172.17.192.242'),
(182, '5a0e32f5834a46c046d431363734363236303332', '2023-01-25 12:53:52', 'Hikari', 'Login', 'select', 'Suparmin', 'r2', '172.17.192.242', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.242'),
(183, '5a0e32f5834a46c046d431363734363236303332', '2023-01-25 13:15:03', 'Hikari', 'Logout', 'select', 'Suparmin', 'r2', '172.17.192.242', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/act_logout.php', '172.17.192.242'),
(184, 'e444ff7903cd756a415631363734363237333130', '2023-01-25 13:15:10', 'Hikari', 'Login', 'select', 'Display Out Check', 'out', '172.17.192.242', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.242'),
(185, 'e444ff7903cd756a415631363734363237333130', '2023-01-25 14:37:50', 'Hikari', 'Logout', 'select', 'Display Out Check', 'out', '172.17.192.242', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/act_logout.php', '172.17.192.242'),
(186, 'a15bc61c30102095b69731363734363332323734', '2023-01-25 14:37:54', 'Hikari', 'Login', 'select', 'Display In Check', 'in', '172.17.192.242', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.242'),
(187, 'a15bc61c30102095b69731363734363332323734', '2023-01-25 14:45:14', 'Hikari', 'Logout', 'select', 'Display In Check', 'in', '172.17.192.242', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/act_logout.php', '172.17.192.242'),
(188, 'e779a6aa28dcbfb1380531363734363332373139', '2023-01-25 14:45:19', 'Hikari', 'Login', 'select', 'Display Out Check', 'out', '172.17.192.242', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.242'),
(189, 'e779a6aa28dcbfb1380531363734363332373139', '2023-01-25 14:46:04', 'Hikari', 'Logout', 'select', 'Display Out Check', 'out', '172.17.192.242', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/act_logout.php', '172.17.192.242'),
(190, '46fe8a3d9080665852a831363734363332383431', '2023-01-25 14:47:21', 'Hikari', 'Login', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.242'),
(191, '46fe8a3d9080665852a831363734363332383431', '2023-01-25 15:19:32', 'Hikari', 'Logout', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/act_logout.php', '172.17.192.242'),
(192, '92b430c0492ceaa8e85831363734363334373739', '2023-01-25 15:19:39', 'Hikari', 'Login', 'select', 'Rudi Haryanto', 'm1', '172.17.192.242', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.242'),
(193, '92b430c0492ceaa8e85831363734363334373739', '2023-01-25 15:21:49', 'Hikari', 'Logout', 'select', 'Rudi Haryanto', 'm1', '172.17.192.242', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/act_logout.php', '172.17.192.242'),
(194, '1d774ec9c435915eeb1331363734363334393133', '2023-01-25 15:21:53', 'Hikari', 'Login', 'select', 'M Adzka SFR', '24891', '172.17.192.242', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/auth/authen.php', '172.17.192.242');

-- --------------------------------------------------------

--
-- Table structure for table `batch_log`
--

CREATE TABLE `batch_log` (
  `id` int(255) NOT NULL,
  `log_time` datetime NOT NULL,
  `system_name` varchar(255) NOT NULL,
  `process_name` varchar(255) NOT NULL,
  `query` varchar(50) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `computer_ip` varchar(50) NOT NULL,
  `computer_name` varchar(255) NOT NULL,
  `script_name` varchar(255) NOT NULL,
  `host` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `batch_log`
--

INSERT INTO `batch_log` (`id`, `log_time`, `system_name`, `process_name`, `query`, `employee_name`, `employee_id`, `computer_ip`, `computer_name`, `script_name`, `host`) VALUES
(1, '2022-09-11 08:59:40', 'Production Result', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_result/result.php', 'localhost:8080'),
(2, '2022-09-11 09:04:57', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(3, '2022-09-11 09:07:16', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(4, '2022-09-11 09:10:09', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(5, '2022-09-11 09:11:22', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(6, '2022-09-11 09:16:52', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(7, '2022-09-11 09:20:21', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(8, '2022-09-11 09:21:32', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(9, '2022-09-11 09:22:29', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(10, '2022-09-11 09:23:32', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(11, '2022-09-11 09:43:22', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(12, '2022-09-11 09:44:03', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(13, '2022-09-11 09:44:46', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(14, '2022-09-11 09:45:22', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(15, '2022-09-11 09:46:08', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(16, '2022-09-11 09:46:46', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(17, '2022-09-11 09:47:34', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(18, '2022-09-11 09:48:05', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(19, '2022-09-11 09:49:08', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(20, '2022-09-11 09:50:24', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(21, '2022-09-11 09:51:46', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(22, '2022-09-11 09:52:09', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(23, '2022-09-11 09:52:34', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(24, '2022-09-11 09:53:25', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(25, '2022-09-11 09:58:26', 'Production Result', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_result/result.php', 'localhost:8080'),
(26, '2022-09-11 09:59:51', 'Production Result', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_result/result.php', 'localhost:8080'),
(27, '2022-09-11 10:01:03', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(28, '2022-09-11 10:01:29', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(29, '2022-09-11 10:02:24', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(30, '2022-09-11 10:08:53', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(31, '2022-09-11 10:10:08', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(32, '2022-09-11 10:10:44', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(33, '2022-09-11 10:11:42', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(34, '2022-09-11 10:13:01', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(35, '2022-09-11 10:15:25', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(36, '2022-09-11 10:17:25', 'Production Plan', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_plan/plan.php', 'localhost:8080'),
(37, '2022-09-11 11:19:58', 'Production Result', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_result/result.php', 'localhost:8080'),
(38, '2022-09-11 11:46:02', 'Production Result', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_result/result.php', 'localhost:8080'),
(39, '2022-09-11 14:52:18', 'Production Result', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '::1', 'Adzka.yamaha-ind.yamaha-indonesia.co.id', '/hikari/bat_file/production_result/result.php', 'localhost:8080'),
(40, '2022-11-01 00:00:00', 'Production Result', 'Batch', 'insert', 'SYSTEM', 'SYSTEM', '', '', 'C:xampphtdocsmylabat_fileproduction_result\result.php', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batch_log`
--
ALTER TABLE `batch_log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `batch_log`
--
ALTER TABLE `batch_log`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
