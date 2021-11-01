-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 01, 2021 at 09:47 AM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `copysnatch_app`
--
CREATE DATABASE IF NOT EXISTS `copysnatch_app` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `copysnatch_app`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `category_id` mediumint(9) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'breakfast'),
(2, 'lunch'),
(3, 'dinner'),
(4, 'snacks');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `comment_id` mediumint(9) NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `body` varchar(2000) NOT NULL,
  `date` datetime NOT NULL,
  `post_id` mediumint(9) NOT NULL,
  `is_approved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `user_id`, `body`, `date`, `post_id`, `is_approved`) VALUES
(1, 1, 'this is a test comment', '2021-10-29 16:13:36', 1, 1),
(2, 1, 'this is a test comment', '2021-10-29 16:15:28', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

DROP TABLE IF EXISTS `levels`;
CREATE TABLE `levels` (
  `level_id` mediumint(9) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`level_id`, `name`) VALUES
(1, 'easy'),
(2, 'medium'),
(3, 'hard');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `post_id` mediumint(9) NOT NULL,
  `image` varchar(100) NOT NULL,
  `title` varchar(50) NOT NULL,
  `body` varchar(2000) NOT NULL,
  `time` varchar(20) NOT NULL,
  `servings` varchar(20) NOT NULL,
  `calories` varchar(20) NOT NULL,
  `level_id` mediumint(9) NOT NULL,
  `ingredients` text NOT NULL,
  `steps` text NOT NULL,
  `category_id` mediumint(9) NOT NULL,
  `date` datetime NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `allow_comments` tinyint(1) NOT NULL,
  `is_published` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `image`, `title`, `body`, `time`, `servings`, `calories`, `level_id`, `ingredients`, `steps`, `category_id`, `date`, `user_id`, `allow_comments`, `is_published`) VALUES
(1, 'e66324c137e15d8930740b0ed49caa6a67e402bf', 'Test Test Test', 'This is a test to see post', '10 minutes', '1 serving', '480 cals', 1, '-bread - protein powder', '-dip dip - cook cook', 1, '2021-10-28 07:04:56', 1, 0, 1),
(2, '1d2d7e18aa0c23bada3c197d9b0be961b0c0b177', 'Pitbull test', 'hello', '20 minutes', '2 servings', '400 cals', 1, 'bread', '', 2, '2021-10-28 09:43:32', 1, 1, 1),
(3, 'd9aefeda34f2aecb2c4542a5a1075e187a9746c1', 'French Toast', 'THIS S PROTEIN FRENCH TOAST?', '13 minutes', '3 servings', '200 cals', 1, 'bread', 'dip cook serve', 1, '2021-10-29 16:17:49', 1, 1, 1),
(4, '02d19c17496bacf2c0d749975973a77dd9ebb85d', 'FRENCH TOAST', 'THIS IS A TEST FOR INGREDIENTS LIST', '13 minutes', '3 servings', '300 cals', 1, 'bread', 'pan cook', 1, '2021-10-29 18:35:22', 1, 1, 1),
(5, '4a8b7bba7d63fb2cb3b1767c2f404316148ab9d1', 'toast', 'toast', '', '', '', 1, '', '', 0, '2021-10-29 19:00:37', 1, 0, 0),
(6, 'cb30d4325c4e6d5819c27032e6a77ae17c72beaa', 'Test', 'test test', '', '', '', 1, 'a:3:{i:0;s:5:\"toast\";i:1;s:5:\"bread\";i:2;s:1:\"b\";}', 'a:3:{i:0;s:4:\"cook\";i:1;s:3:\"eat\";i:2;s:1:\"a\";}', 1, '2021-11-01 08:37:12', 1, 1, 1),
(7, '955a7d4a655680bffd282424d4f09ea74c8b96dc', '', '', '', '', '', 1, '', '', 0, '2021-11-01 08:56:52', 1, 0, 0),
(8, 'a660c9a930008f0da5a69c5b62fe0878689e2f65', 'this is the next test', 'testing again', '', '', '', 1, 'a:3:{i:0;s:5:\"happy\";i:1;s:6:\"monday\";i:2;s:5:\"today\";}', 'a:3:{i:0;s:5:\"hello\";i:1;s:9:\"thereeeee\";i:2;s:3:\"jfj\";}', 3, '2021-11-01 09:39:02', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
CREATE TABLE `ratings` (
  `rate_id` mediumint(9) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `post_id` mediumint(9) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` mediumint(9) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(100) NOT NULL,
  `bio` varchar(2000) DEFAULT NULL,
  `date` datetime NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `access_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `profile_pic`, `bio`, `date`, `is_admin`, `access_token`) VALUES
(1, 'Chloe Gunter', 'chloe@gmail.com', '$2y$10$bz3yLq4YljOqWGUaQfNB9O6of4aXrAu/FqAeI6oMels933sO5gyQS', 'avatars/C_339_43_94.png', NULL, '2021-10-26 11:46:42', 0, '539885dc03a5ddfc2bc4f91868dbc0ab9d7483c7bbab1c84404c604ef273'),
(2, 'Cheryl', 'cheryl@gmail.com', '$2y$10$1JMdV9Nw2jrlYWb/rs5YrO8VEsqtTZGLZenhmSwkjatFhlXp4i8OG', 'avatars/C_44_46_92.png', NULL, '2021-10-27 18:39:05', 0, NULL),
(3, 'Maddy', 'maddy@gmail.com', '$2y$10$ZVvNjPmiYqs4DKoyw9f3w.8S2xxJSBTEZz3MmOBs5kBuGooW5/gpy', 'avatars/M_10_48_94.png', NULL, '2021-10-28 09:51:28', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rate_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `level_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rate_id` mediumint(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
