-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2019 at 10:42 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`) VALUES
(1, 'Shoes', NULL),
(2, 'Computer', NULL),
(3, 'Cloths', NULL),
(4, 'PVC Pipe 10 inch ', NULL),
(5, 'test1', NULL),
(6, 'test 2', NULL),
(7, 'test1', NULL),
(8, 'test 2', NULL),
(9, 'Water supply +6+', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_items`
--

CREATE TABLE `category_items` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `model_no` varchar(255) DEFAULT NULL,
  `brand_name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `zone_no` char(1) DEFAULT '0',
  `column_no` int(11) DEFAULT '0',
  `shelf_no` int(11) DEFAULT '0',
  `carton_no` varchar(255) DEFAULT '0',
  `quantity` int(11) NOT NULL DEFAULT '0',
  `total_quantity` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_items`
--

INSERT INTO `category_items` (`id`, `category_id`, `description`, `model_no`, `brand_name`, `photo`, `zone_no`, `column_no`, `shelf_no`, `carton_no`, `quantity`, `total_quantity`) VALUES
(1, 3, 'Polo Shirt', 'P-23', 'Polo', 'polo_1549278611.jpg', 'A', 1, 1, 'C454', 10, 12),
(2, 3, 'Nike Shirt', 'N-434', 'Nike', 'ABC Solutions (1)_1549278631.png', 'B', 2, 2, 'C454ertr', 1, 12),
(3, 2, 'Dell', 'D23', 'Dell', 'laptop_1549278661.png', 'A', 1, 1, 'C454', 0, 220),
(4, 2, 'Hp 15 inch', 'H-23', 'Hp', 'laptop2_1549278687.jpg', 'A', 2, 2, 'C454', 3, 12),
(5, 2, 'HP tablet', 'H324', 'Hp', 'laptop3_1549278703.png', '0', 0, 0, NULL, 0, 0),
(6, 1, 'Nike slippers', 'N-234', 'Nike', 'nike_1549278730.jpg', 'A', 1, 1, 'C454', 157, 33),
(7, 1, 'Addidas formals', 'A-123', 'Addidas', 'ABC Solutions (1)_1549351648.png', 'A', 1, 1, 'C454', 250, 200),
(8, 9, 'PPR PN20  50mm', 'rj50', 'Proplus', 'afghan card_1549366392.pdf', 'A', 1, 1, '1150', 50, 100),
(9, 4, 'uPVC Pipe 6inch Above Ground', '5555', 'Cosmoplast', 'afghan card_1549366441.pdf', 'B', 3, 3, '555', 60, 100),
(10, 9, 'PPR PN20 50mm', NULL, 'cosmo', 'afghan card_1549367470.pdf', '0', 0, 0, NULL, -23, 0),
(11, 8, 'rqwer', 'er', 're', 'ferrair_1549440368.jpg', '0', 0, 0, NULL, 0, 0),
(12, 8, 'gsd', 'sdfg', 'gdfs', '8_1549440379.PNG', '0', 0, 0, NULL, 0, 0),
(13, 8, 'trew', 'fsd', 'fasd', 'ferrair_1549440392.jpg', '0', 0, 0, NULL, 0, 0),
(14, 8, 'yre', 'wret', 'ret', 'ferrair_1549440413.jpg', '0', 0, 0, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `form_items`
--

CREATE TABLE `form_items` (
  `id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form_items`
--

INSERT INTO `form_items` (`id`, `form_id`, `item_id`, `quantity`) VALUES
(2, 3, 2, 12),
(3, 3, 1, 20),
(4, 4, 6, 200),
(5, 4, 4, 210),
(6, 4, 3, 220),
(7, 5, 1, 12),
(8, 5, 4, 12),
(9, 5, 6, 33),
(10, 6, 7, 200),
(11, 7, 7, 200),
(12, 8, 8, 100),
(13, 8, 9, 100);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `description`, `link`, `created_at`) VALUES
(1, 'Goods Requested', 'Engineer Requested Goods. Please Take Required Action', 'requestedGoods/PendingRequests', '2019-02-05 02:15:30'),
(2, 'Goods Requested', 'Engineer Requested Goods. Please Take Required Action', 'requestedGoods/PendingRequests', '2019-02-05 03:06:06'),
(3, 'Goods Requested', 'Engineer Requested Goods. Please Take Required Action', 'requestedGoods/PendingRequests', '2019-02-05 03:06:59'),
(4, 'Goods Requested', 'Engineer Requested Goods. Please Take Required Action', 'requestedGoods/PendingRequests', '2019-02-05 03:07:42'),
(5, 'Goods Requested', 'Engineer Requested Goods. Please Take Required Action', 'requestedGoods/PendingRequests', '2019-02-05 03:10:34'),
(6, 'Goods Requested', 'Engineer Requested Goods. Please Take Required Action', 'requestedGoods/PendingRequests', '2019-02-05 03:29:39'),
(7, 'Goods Requested', 'Engineer Requested Goods. Please Take Required Action', 'requestedGoods/PendingRequests', '2019-02-05 03:36:13'),
(8, 'Request Approved', 'Procurement Accepted Goods Request. Please Take Required Action', 'requestedGoods/PendingRequests', '2019-02-05 05:35:29'),
(9, 'Request Approved', 'Procurement Accepted Goods Request. Please Take Required Action', 'requestedGoods/PendingRequests', '2019-02-05 05:37:30'),
(10, 'Request Approved', 'Procurement Accepted Goods Request. Please Take Required Action', 'requestedGoods/PendingRequests', '2019-02-05 05:37:31'),
(11, 'Request Approved', 'Procurement Accepted Goods Request. Please Take Required Action', 'requestedGoods/PendingRequests', '2019-02-05 05:37:33'),
(12, 'Request Approved', 'Procurement Accepted Goods Request. Please Take Required Action', 'requestedGoods/PendingRequests', '2019-02-05 05:37:34'),
(13, 'Request Approved', 'Procurement Accepted Goods Request. Please Take Required Action', 'requestedGoods/PendingRequests', '2019-02-05 05:39:09'),
(14, 'Request Approved', 'Procurement Accepted Goods Request. Please Take Required Action', 'requestedGoods/PendingRequests', '2019-02-05 05:39:10'),
(15, 'Request Approved', 'Your Request is Been Approved', 'requestedGoods/MyOrders', '2019-02-05 05:43:22'),
(16, 'Request Approved', 'Your Request is Been Approved', 'requestedGoods/MyOrders', '2019-02-05 05:47:19'),
(17, 'Request Approved', 'Your Request is Been Approved', 'requestedGoods/MyOrders', '2019-02-05 05:51:34'),
(18, 'Request Approved', 'Your Request is Been Approved', 'requestedGoods/MyOrders', '2019-02-05 05:51:45'),
(19, 'Request Approved', 'Your Request is Been Approved', 'requestedGoods/MyOrders', '2019-02-05 05:56:40'),
(20, 'Request Approved', 'Procurement Accepted Goods Request. Please Take Required Action', 'requestedGoods/PendingRequests', '2019-02-05 05:57:42'),
(21, 'Request Rejected', 'Rejected By Procurement', 'requestedGoods/MyOrders', '2019-02-05 10:00:53'),
(22, 'Request Rejected', 'Rejected By Store Manager', 'requestedGoods/MOrders', '2019-02-05 06:01:23'),
(23, 'Request Rejected', 'Rejected By Store Manager', 'requestedGoods/Morders', '2019-02-05 06:01:44'),
(24, 'Request Rejected', 'Rejected By Store Manager', 'requestedGoods/MyOrders', '2019-02-05 06:01:59'),
(25, 'Goods Requested', 'Engineer Requested Goods. Please Take Required Action', 'requestedGoods/PendingRequests', '2019-02-05 06:15:11'),
(26, 'Request Rejected', 'Rejected By Store Manager', 'requestedGoods/MyOrders', '2019-02-05 06:16:03'),
(27, 'Request Rejected', 'Rejected By Store Manager', 'requestedGoods/MyOrders', '2019-02-05 06:16:24'),
(28, 'Request Rejected', 'Rejected By Store Manager', 'requestedGoods/MyOrders', '2019-02-05 06:16:25'),
(29, 'Request Rejected', 'Rejected By Store Manager', 'requestedGoods/MyOrders', '2019-02-05 06:16:26'),
(30, 'Goods Requested', 'Engineer Requested Goods. Please Take Required Action', 'requestedGoods/PendingRequests', '2019-02-05 06:16:50'),
(31, 'Request Rejected', 'Rejected By Store Manager', 'requestedGoods/MyOrders', '2019-02-05 06:16:57'),
(32, 'Goods Requested', 'Engineer Requested Goods. Please Take Required Action', 'requestedGoods/PendingRequests', '2019-02-05 06:17:42'),
(33, 'Request Rejected', 'Rejected By Procurement Manager', 'requestedGoods/MyOrders', '2019-02-05 06:17:48'),
(34, 'Goods Requested', 'Engineer Requested Goods. Please Take Required Action', 'requestedGoods/PendingRequests', '2019-02-05 06:18:18'),
(35, 'Request Approved', 'Procurement Accepted Goods Request. Please Take Required Action', 'requestedGoods/PendingRequests', '2019-02-05 06:18:23'),
(36, 'Request Rejected', 'Rejected By Store Manager', 'requestedGoods/MyOrders', '2019-02-05 06:19:11'),
(37, 'Goods Requested', 'Engineer Requested Goods. Please Take Required Action', 'requestedGoods/PendingRequests', '2019-02-05 06:20:31'),
(38, 'Request Rejected', 'Rejected By Procurement Manager', 'requestedGoods/MyOrders', '2019-02-05 06:20:52'),
(39, 'Goods Requested', 'Engineer Requested Goods. Please Take Required Action', 'requestedGoods/PendingRequests', '2019-02-05 06:27:49'),
(40, 'Goods Requested', 'Engineer Requested Goods. Please Take Required Action', 'requestedGoods/PendingRequests', '2019-02-05 06:28:11'),
(41, 'Request Rejected', 'Rejected By Procurement Manager', 'requestedGoods/MyOrders', '2019-02-05 06:28:45'),
(42, 'Goods Requested', 'Engineer Requested Goods. Please Take Required Action', 'requestedGoods/PendingRequests', '2019-02-05 06:30:22'),
(43, 'Request Rejected', 'Rejected By Procurement Manager', 'requestedGoods/MyOrders', '2019-02-05 06:30:29'),
(44, 'Goods Requested', 'Engineer Requested Goods. Please Take Required Action', 'requestedGoods/PendingRequests', '2019-02-05 06:31:35'),
(45, 'Request Rejected', 'Rejected By Procurement Manager', 'requestedGoods/MyOrders', '2019-02-05 06:31:41'),
(46, 'Goods Requested', 'Engineer Requested Goods. Please Take Required Action', 'requestedGoods/PendingRequests', '2019-02-05 06:31:53'),
(47, 'Request Approved', 'Procurement Accepted Goods Request. Please Take Required Action', 'requestedGoods/PendingRequests', '2019-02-05 06:32:11'),
(48, 'Request Rejected', 'Rejected By Store Manager', 'requestedGoods/MyOrders', '2019-02-05 06:32:28'),
(49, 'Goods Requested', 'Engineer Requested Goods. Please Take Required Action', 'requestedGoods/PendingRequests', '2019-02-05 06:33:43'),
(50, 'Goods Requested', 'Engineer Requested Goods. Please Take Required Action', 'requestedGoods/PendingRequests', '2019-02-05 07:37:40'),
(51, 'Goods Requested', 'Engineer Requested Goods. Please Take Required Action', 'requestedGoods/PendingRequests', '2019-02-06 03:47:27');

-- --------------------------------------------------------

--
-- Table structure for table `notification_users`
--

CREATE TABLE `notification_users` (
  `id` int(11) NOT NULL,
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_read` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification_users`
--

INSERT INTO `notification_users` (`id`, `notification_id`, `user_id`, `is_read`, `created_at`) VALUES
(1, 1, 2, 1, '2019-02-05 09:30:49'),
(2, 2, 2, 1, '2019-02-05 09:30:49'),
(3, 3, 2, 1, '2019-02-05 09:30:49'),
(4, 4, 2, 1, '2019-02-05 09:30:49'),
(5, 5, 2, 1, '2019-02-05 09:30:49'),
(6, 6, 2, 1, '2019-02-05 09:30:49'),
(7, 7, 2, 1, '2019-02-05 09:30:49'),
(8, 8, 1, 1, '2019-02-05 09:37:07'),
(9, 9, 1, 0, '2019-02-05 05:37:30'),
(10, 10, 1, 0, '2019-02-05 05:37:31'),
(11, 11, 1, 0, '2019-02-05 05:37:33'),
(12, 12, 1, 1, '2019-02-05 09:47:41'),
(13, 13, 1, 0, '2019-02-05 05:39:09'),
(14, 14, 1, 1, '2019-02-05 09:39:25'),
(15, 15, 1, 1, '2019-02-05 09:46:44'),
(16, 16, 1, 1, '2019-02-05 09:47:24'),
(17, 17, 1, 0, '2019-02-05 05:51:34'),
(18, 18, 1, 1, '2019-02-05 09:52:19'),
(19, 19, 1, 1, '2019-02-05 09:56:43'),
(20, 20, 1, 0, '2019-02-05 05:57:42'),
(21, 21, 1, 1, '2019-02-05 10:00:18'),
(22, 22, 1, 0, '2019-02-05 06:01:23'),
(23, 23, 1, 0, '2019-02-05 06:01:44'),
(24, 24, 1, 1, '2019-02-05 10:02:01'),
(25, 25, 2, 1, '2019-02-05 10:15:34'),
(26, 26, 3, 1, '2019-02-05 10:16:37'),
(27, 27, 1, 0, '2019-02-05 06:16:24'),
(28, 28, 1, 0, '2019-02-05 06:16:25'),
(29, 29, 3, 1, '2019-02-05 10:16:34'),
(30, 30, 2, 1, '2019-02-05 10:16:55'),
(31, 31, 3, 1, '2019-02-05 10:17:02'),
(32, 32, 2, 1, '2019-02-05 10:17:47'),
(33, 33, 3, 1, '2019-02-05 10:17:54'),
(34, 34, 2, 1, '2019-02-05 10:18:40'),
(35, 35, 1, 1, '2019-02-05 10:18:57'),
(36, 36, 3, 1, '2019-02-05 10:19:16'),
(37, 37, 2, 1, '2019-02-05 10:20:47'),
(38, 38, 4, 0, '2019-02-05 06:20:52'),
(39, 39, 2, 0, '2019-02-05 06:27:49'),
(40, 40, 2, 1, '2019-02-05 10:28:26'),
(41, 41, 4, 1, '2019-02-05 10:28:51'),
(42, 42, 2, 1, '2019-02-05 10:30:27'),
(43, 43, 4, 1, '2019-02-05 10:30:35'),
(44, 44, 2, 1, '2019-02-05 10:31:39'),
(45, 45, 4, 0, '2019-02-05 06:31:41'),
(46, 46, 2, 0, '2019-02-05 06:31:53'),
(47, 47, 1, 1, '2019-02-05 10:32:25'),
(48, 48, 4, 0, '2019-02-05 06:32:28'),
(49, 49, 2, 0, '2019-02-05 06:33:43'),
(50, 50, 2, 0, '2019-02-05 07:37:40'),
(51, 51, 2, 0, '2019-02-06 03:47:27');

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
-- Table structure for table `reciving_goods`
--

CREATE TABLE `reciving_goods` (
  `id` int(11) NOT NULL,
  `reciving_from` varchar(255) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reciving_goods`
--

INSERT INTO `reciving_goods` (`id`, `reciving_from`, `project_name`, `date`) VALUES
(3, 'Khan', 'P44', '2019-02-04'),
(4, 'iqbal', 'P34', '2019-02-04'),
(5, 'KhaN', 'p223', '2019-02-05'),
(6, 'Jan', 'p43', '2019-02-05'),
(7, 'asad', 'P43', '2019-02-05'),
(8, 'adi', 'P45', '2019-02-05');

-- --------------------------------------------------------

--
-- Table structure for table `request_goods`
--

CREATE TABLE `request_goods` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `requested_qty` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `proc_approval` int(11) NOT NULL DEFAULT '0',
  `store_approval` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_goods`
--

INSERT INTO `request_goods` (`id`, `category_id`, `item_id`, `user_id`, `requested_qty`, `project_name`, `date`, `proc_approval`, `store_approval`) VALUES
(1, 2, 4, 1, 150, 'EMS', NULL, 1, 1),
(2, 3, 2, 1, 7, 'EMS', NULL, 1, 1),
(3, 3, 2, 1, 1, 'P22', NULL, 1, 0),
(4, 3, 2, 1, 1, 'P22', NULL, 1, 1),
(5, 3, 2, 1, 1, 'p33', NULL, 1, 1),
(6, 2, 4, 1, 34, 'p33', NULL, 1, 1),
(7, 1, 6, 1, 44, 'p33', NULL, 1, 1),
(8, 1, 6, 1, 22, 'P33', NULL, 1, 2),
(9, 1, 6, 1, 10, 'p33', NULL, 1, 2),
(10, 2, 4, 1, 15, 'EMS', NULL, 1, 2),
(11, 3, 1, 1, 12, 'EMS', NULL, 2, 0),
(12, 1, 7, 1, 100, 'P43', NULL, 2, 0),
(13, 1, 7, 1, 50, 'EMS', NULL, 2, 0),
(14, 3, 2, 3, 1, 'P44', NULL, 2, 0),
(15, 2, 4, 3, 20, 'P44', NULL, 2, 0),
(16, 3, 1, 3, 10, 'building of school', NULL, 2, 0),
(17, 2, 3, 3, 20, 'building of school', NULL, 2, 0),
(18, 2, 3, 3, 100, 'building of school', NULL, 1, 2),
(19, 2, 3, 4, 50, 'P44', NULL, 2, 0),
(20, 2, 3, 3, 20, 'building of school', NULL, 0, 0),
(21, 2, 3, 4, 20, 'P3234', NULL, 2, 0),
(22, 2, 3, 4, 5, 'building of school', NULL, 2, 0),
(23, 2, 3, 4, 5, 'building of school', NULL, 2, 0),
(24, 2, 3, 4, 5, 'building of school', NULL, 1, 2),
(25, 2, 3, 4, 5, 'building of school', NULL, 0, 0),
(26, 9, 8, 1, 50, 'P45', NULL, 0, 0),
(27, 4, 9, 1, 40, 'P45', NULL, 0, 0),
(28, 9, 10, 1, 23, 'EMS', '2019-02-06', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_no` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` int(11) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone_no`, `address`, `email_verified_at`, `password`, `user_type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'user', 'user@abc-gcc.com', '058951054', 'Ajman', NULL, '$2y$10$SQ7n7Q2sQzq4KMbHFObaxO6rcXNAQleMjsUomTvfpPEdFQsw4Gmme', 101, 'hFYFJTMKE9l2WWr8ULjEtZn4XT51vmxonYxc1sZZawNriOD5oeYtm9bE2Fos', '2019-02-18 20:00:00', '2019-02-14 20:00:00'),
(2, 'Khan', 'khan@yahoo.com', '0567776555', 'Dubai', NULL, '$2y$10$.5lsPoAoAmn.r05hysdSN..euIoZuyPlc.0xk1oDC2nufnzjnrha6', 2, 'V0zUP7FDLPaLSTrgIybwA79Csac9xOR8I9iNvN3xGOrxOdOIrlxeCo5mzifS', NULL, NULL),
(3, 'zakir', 'zakir@yahoo.com', '34533453', 'Abu Dhabi', NULL, '$2y$10$DdQV1Q7uFSWCopiB6xwAr.popOzGLyKD44433aVh94hJqmftxyi82', 1, 'Krs69JhyYEl0hdP0VXu8EQLuJAqd7xIURFksA4uEDk6XYXdZMTC1DKwWohjY', NULL, NULL),
(4, 'jan', 'jan@jan.com', '2343423', 'chakdara', NULL, '$2y$10$zOJcUYU.nBmW0kMXVNpFl.TVEbjsW9DNiCo.64su.9I5a6XTtWBeG', 1, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_items`
--
ALTER TABLE `category_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_items`
--
ALTER TABLE `form_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_users`
--
ALTER TABLE `notification_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `reciving_goods`
--
ALTER TABLE `reciving_goods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_goods`
--
ALTER TABLE `request_goods`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category_items`
--
ALTER TABLE `category_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `form_items`
--
ALTER TABLE `form_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `notification_users`
--
ALTER TABLE `notification_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `reciving_goods`
--
ALTER TABLE `reciving_goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `request_goods`
--
ALTER TABLE `request_goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
