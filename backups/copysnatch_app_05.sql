-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 03, 2021 at 03:39 PM
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
(2, 1, 'this is a test comment', '2021-10-29 16:15:28', 1, 1),
(3, 1, 'this is my post', '2021-11-01 10:58:45', 8, 1),
(4, 1, 'this is my post', '2021-11-01 11:00:11', 8, 1),
(5, 1, 'good one', '2021-11-03 11:20:48', 10, 1);

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
(8, 'a660c9a930008f0da5a69c5b62fe0878689e2f65', 'this is the next test', 'testing again', '11', '10', '100', 3, 'a:3:{i:0;s:5:\"happy\";i:1;s:6:\"monday\";i:2;s:5:\"today\";}', 'a:3:{i:0;s:5:\"hello\";i:1;s:9:\"thereeeee\";i:2;s:3:\"jfj\";}', 3, '2021-11-01 09:39:02', 1, 1, 1),
(9, 'fe0a64a836b4a6b3e21ba1dedb46a36665d2073a', 'test', 'testy test', '20', '3', '300', 2, 'a:3:{i:0;s:5:\"toast\";i:1;s:5:\"kkkkk\";i:2;s:6:\"mmmmmm\";}', 'a:3:{i:0;s:4:\"Cook\";i:1;s:4:\"Cook\";i:2;s:8:\"eattt it\";}', 2, '2021-11-01 18:20:49', 4, 1, 1),
(10, '79675164c6f3f9cc50d3a17adf621655d31f862d', 'test karen', 'hello im karen', '30', '3', '200', 2, 'a:3:{i:0;s:5:\"toast\";i:1;s:5:\"bread\";i:2;s:5:\"today\";}', 'a:3:{i:0;s:5:\"hello\";i:1;s:4:\"Cook\";i:2;s:3:\"eat\";}', 4, '2021-11-02 08:14:47', 1, 1, 1),
(11, '529489f366ab35d8f5e57edc02b89c498d001576', '', '', '', '', '', 1, '', '', 0, '2021-11-02 11:17:18', 1, 0, 0),
(12, 'bdf30dc612a3f8aedee203c5a720e0b2a8634186', '', '', '', '', '', 1, '', '', 0, '2021-11-02 11:19:11', 1, 0, 0),
(13, '13ef63500627d65f2e45fa6a2aa676efafff329f', '', '', '', '', '', 1, '', '', 0, '2021-11-02 11:22:10', 1, 0, 0),
(14, '833f3442a1027d258acfc970cf0245c3a1f4f74e', 'Pooool', 'This is my poooool', '1', '1', '1', 1, 'a:2:{i:0;s:1:\"1\";i:1;s:5:\"toast\";}', 'a:2:{i:0;s:1:\"1\";i:1;s:1:\"1\";}', 3, '2021-11-03 09:18:12', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
CREATE TABLE `ratings` (
  `rating_id` mediumint(9) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `post_id` mediumint(9) NOT NULL,
  `user_id` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rating_id`, `rating`, `post_id`, `user_id`) VALUES
(5, 3, 1, 1),
(6, 5, 1, 1),
(7, 1, 1, 1),
(8, 5, 10, 1),
(9, 3, 8, 1),
(10, 4, 6, 1),
(11, 2, 4, 1),
(12, 5, 3, 1),
(13, 3, 2, 1),
(14, 5, 9, 1),
(15, 5, 14, 1),
(16, 3, 14, 4),
(17, 4, 10, 4),
(18, 4, 9, 4),
(19, 3, 14, 3),
(20, 3, 9, 3),
(21, 2, 6, 3),
(22, 4, 2, 3),
(23, 5, 1, 3),
(24, 5, 3, 3),
(25, 1, 10, 3);

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
(1, 'Chloe Gunter ', 'chloe@gmail.com', '$2y$10$bz3yLq4YljOqWGUaQfNB9O6of4aXrAu/FqAeI6oMels933sO5gyQS', 'avatars/3004fc9147d0eaff8cf8790cb7ebd3ede2a0adff_small.jpg', 'This is my new bio', '2021-10-26 11:46:42', 0, ''),
(2, 'Cheryl', 'cheryl@gmail.com', '$2y$10$1JMdV9Nw2jrlYWb/rs5YrO8VEsqtTZGLZenhmSwkjatFhlXp4i8OG', 'avatars/b5173958ea0cf8648c1e1dcaa56f2340246bd5aa_small.jpg', NULL, '2021-10-27 18:39:05', 0, ''),
(3, 'Maddy', 'maddy@gmail.com', '$2y$10$ZVvNjPmiYqs4DKoyw9f3w.8S2xxJSBTEZz3MmOBs5kBuGooW5/gpy', 'avatars/M_10_48_94.png', NULL, '2021-10-28 09:51:28', 0, '4c09cfe1b06a06b13c14815fa485e407cb6f891fbe53b019dd3cd5bbc9ec'),
(4, 'chris', 'chris@gmail.com', '$2y$10$G2akYvBdBKL5SzdFqxCpj.QbPJVYh6vrh4NC3IDbmz3bE0NnNpq6K', 'avatars/c_267_31_92.png', NULL, '2021-11-01 18:17:15', 0, ''),
(5, 'parker', 'parker@gmail.com', '$2y$10$BQKgGmhWOXF2gYa3PedoN.irwbjKZydpOy.67H08FMRdFQOIINlka', 'avatars/p_34_36_93.png', NULL, '2021-11-01 18:32:59', 0, NULL),
(6, 'hannah', 'hannah@gmail.com', '$2y$10$hQxFJNJRzLB7HZHttRgHUOmTs/Od7z0bUbW7MomWOvNRCmT5cBRxG', 'avatars/h_102_35_94.png', NULL, '2021-11-01 18:39:54', 0, ''),
(7, 'edward', 'ed@gmail.com', '$2y$10$Hnu75A.D8AuMS5nJGhZmR.IDggop3wSi9ppvRN6OFMGWYT3ryYdvO', 'avatars/e_243_33_94.png', NULL, '2021-11-01 18:46:01', 0, '51dc1a35e06f17717cb49cde63fa748470dd3f8376647ac407570d2ae7a4');

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
  ADD PRIMARY KEY (`rating_id`);

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
  MODIFY `comment_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `level_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
