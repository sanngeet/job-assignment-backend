-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 06, 2023 at 01:41 PM
-- Server version: 5.7.42-0ubuntu0.18.04.1
-- PHP Version: 7.2.34-30+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ssd`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `step_id` int(11) NOT NULL,
  `item` varchar(100) NOT NULL,
  `title` varchar(20) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `step_id`, `item`, `title`, `description`, `updated`, `created`, `deleted`) VALUES
(1, 1, 'first', 'batman title 2', 'description 1 description 1 description 1 description 1 description 1 description 1 description 1', '2023-10-06 10:56:26', '2023-10-04 14:53:59', NULL),
(2, 1, '2nd', 'last', 'last', '2023-10-06 10:31:14', '2023-10-04 14:53:59', NULL),
(3, 2, 'Item 2-1', 'title 3', 'description 3 description 3 description 3 description 3 description 3 description 3 ', '2023-10-04 14:54:23', '2023-10-04 14:54:23', NULL),
(4, 2, 'Item 2-2', 'title 4', 'description 4 description 4 description 4 description 4description 4description 4description 4description 4description 4description 4', '2023-10-04 14:54:23', '2023-10-04 14:54:23', NULL),
(5, 3, 'Item 3', 'some title', 'some desc', '2023-10-05 15:47:32', '2023-10-05 15:47:32', NULL),
(6, 20, 'item of step 4', 'title of step 4', 'd of step 4', '2023-10-06 09:27:15', '2023-10-06 09:27:15', NULL),
(7, 21, 'Item of 5', 'title of 5', 'desc of 5', '2023-10-06 09:30:13', '2023-10-06 09:30:13', NULL),
(8, 21, 'item 2 of 5', 'title 2 of 5', 'description 2 of 5', '2023-10-06 09:34:30', '2023-10-06 09:34:30', NULL),
(9, 20, 'xxx', 'yyy', 'zzz', '2023-10-06 09:42:10', '2023-10-06 09:42:10', NULL),
(10, 1, 'Item 1-1 updated', 'title  updated', 'updated description 1 description 1 description 1 description 1 description 1 description 1 description 1', '2023-10-06 09:46:33', '2023-10-06 09:46:33', '2023-10-06 09:54:36'),
(11, 3, 'Item 3 new', 'some title', 'some desc', '2023-10-06 09:53:58', '2023-10-06 09:53:58', '2023-10-06 09:54:12'),
(12, 21, 'new item 2 of 5', 'title 2 of 5', 'description 2 of 5', '2023-10-06 09:54:54', '2023-10-06 09:54:54', '2023-10-06 10:33:59'),
(13, 1, 'third', 'thirs', 'sadfasdfasdf', '2023-10-06 10:29:22', '2023-10-06 10:18:15', '2023-10-06 10:56:32'),
(14, 1, 'iphone', 'fourth', '444', '2023-10-06 10:29:28', '2023-10-06 10:19:02', '2023-10-06 10:56:31'),
(15, 1, 'last', 'lAT', 'AS', '2023-10-06 10:31:27', '2023-10-06 10:31:27', '2023-10-06 10:31:40');

-- --------------------------------------------------------

--
-- Table structure for table `steps`
--

CREATE TABLE `steps` (
  `id` int(11) NOT NULL,
  `step` varchar(100) NOT NULL,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `steps`
--

INSERT INTO `steps` (`id`, `step`, `updated`, `created`, `deleted`) VALUES
(1, 'Step 1', '2023-10-04 14:52:44', '2023-10-04 14:52:44', NULL),
(2, 'Step 2', '2023-10-04 14:52:44', '2023-10-04 14:52:44', NULL),
(3, 'Step 3', '2023-10-04 14:52:58', '2023-10-04 14:52:58', NULL),
(4, 'Step 4', '2023-10-04 14:52:58', '2023-10-04 14:52:58', '2023-10-06 09:03:42'),
(5, 'hel', '2023-10-06 07:38:25', '2023-10-06 07:38:25', '2023-10-06 09:00:40'),
(6, 'wow', '2023-10-06 07:42:53', '2023-10-06 07:42:53', '2023-10-06 08:58:13'),
(7, 'final', '2023-10-06 07:44:44', '2023-10-06 07:44:44', '2023-10-06 08:58:13'),
(8, 'ok', '2023-10-06 07:45:16', '2023-10-06 07:45:16', '2023-10-06 09:00:30'),
(9, 'hwllo', '2023-10-06 07:47:02', '2023-10-06 07:47:02', '2023-10-06 08:59:10'),
(10, 'hsadflasdfasdf', '2023-10-06 07:53:04', '2023-10-06 07:53:04', '2023-10-06 08:58:20'),
(11, 'zdfsdf', '2023-10-06 07:54:53', '2023-10-06 07:54:53', '2023-10-06 08:53:34'),
(12, 'asas', '2023-10-06 08:03:04', '2023-10-06 08:03:04', '2023-10-06 08:58:17'),
(13, 'sd', '2023-10-06 08:03:44', '2023-10-06 08:03:44', '2023-10-06 08:53:36'),
(14, 'sdfdf', '2023-10-06 08:04:53', '2023-10-06 08:04:53', '2023-10-06 08:53:37'),
(15, 'sdsd', '2023-10-06 08:05:43', '2023-10-06 08:05:43', '2023-10-06 08:55:59'),
(16, 'dfdf', '2023-10-06 08:06:02', '2023-10-06 08:06:02', '2023-10-06 08:54:41'),
(17, 'heleerere', '2023-10-06 08:07:53', '2023-10-06 08:07:53', '2023-10-06 08:55:56'),
(18, 'asdfasdfd', '2023-10-06 08:11:08', '2023-10-06 08:11:08', '2023-10-06 08:58:01'),
(19, 'sangeet', '2023-10-06 08:45:17', '2023-10-06 08:45:17', '2023-10-06 08:53:45'),
(20, 'step 4', '2023-10-06 09:08:54', '2023-10-06 09:08:54', NULL),
(21, 'Step 5', '2023-10-06 09:29:48', '2023-10-06 09:29:48', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `steps`
--
ALTER TABLE `steps`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `steps`
--
ALTER TABLE `steps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
