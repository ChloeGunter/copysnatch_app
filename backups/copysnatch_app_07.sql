-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 08, 2021 at 10:15 PM
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
(5, 1, 'good one', '2021-11-03 11:20:48', 10, 1),
(6, 1, 'This is a great recipe 10/10!', '2021-11-07 11:03:35', 16, 1),
(7, 1, 'This is a great recipe 10/10!', '2021-11-07 11:04:32', 16, 1),
(8, 1, 'So good!', '2021-11-08 16:29:18', 19, 1),
(9, 1, 'So good!', '2021-11-08 16:31:29', 19, 1),
(10, 1, 'So good!', '2021-11-08 16:31:31', 19, 1),
(11, 1, 'Great!', '2021-11-08 20:08:21', 25, 1),
(12, 1, 'hello', '2021-11-08 20:09:30', 26, 1),
(13, 1, 'hello', '2021-11-08 20:09:36', 26, 1),
(14, 1, 'hello', '2021-11-08 20:09:37', 26, 1),
(15, 1, 'This is amazing!', '2021-11-08 20:25:56', 26, 1);

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
(27, '4454e580ef91321a53853fe0b1ed645ffaee148c', 'Turkey Chili', 'This is a simple hardy turkey chili that is high in protein. This recipe is flavorful and has a variety of textures for an exciting dish!', '35', '8', '350', 1, 'a:8:{i:0;s:34:\"2 packages: 90% Lean Ground Turkey\";i:1;s:22:\"4 cans: stewed tomatos\";i:2;s:19:\"2 cans: black beans\";i:3;s:25:\"18 grams: chili seasoning\";i:4;s:7:\"parsley\";i:5;s:7:\"oregano\";i:6;s:10:\"red pepper\";i:7;s:7:\"peppper\";}', 'a:6:{i:0;s:35:\"Spray a pan with pam on medium heat\";i:1;s:16:\"Cook ground beef\";i:2;s:19:\"Add chili seasoning\";i:3;s:42:\"Once beef is cooked, add tomatos and beans\";i:4;s:23:\"Add seasoning to liking\";i:5;s:6:\"Enjoy!\";}', 3, '2021-11-08 21:14:01', 1, 1, 1),
(28, '09326f9a9c2d3b08f48ba36a6efc30af52c8693c', 'Baja Cod Tacos', 'This is a copycat recipe of Rubios tacos. These tacos have a white fish that is low in calorie and surrounded with amazing flavors to make the dish exciting!', '28', '1', '315', 2, 'a:5:{i:0;s:22:\"100 grams: Cabbage Mix\";i:1;s:21:\"100 grams: Cooked Cod\";i:2;s:21:\"78 grams: Mango Salsa\";i:3;s:35:\"2 Tortillas: Carb Counter Tortillas\";i:4;s:35:\"15 grams: Low Cal Chick-Fil-A Sauce\";}', 'a:3:{i:0;s:28:\"Pre-Heat oven to 460 degrees\";i:1;s:23:\"Cook Cod for 20 minutes\";i:2;s:15:\"Assemble tacos!\";}', 2, '2021-11-08 21:22:59', 4, 1, 1),
(29, '635d080cfc76d198a30992db94128cf3a45c58a1', 'Protein French Toast', 'French Toast but HEALTHY! This recipe with blow you away. It tastes just like french toast but it is lower in cals and very high in protein. Hope you enjoy!', '20', '1', '450', 2, 'a:5:{i:0;s:15:\"3 slices: Bread\";i:1;s:26:\"3 1/2 servings: Egg Whites\";i:2;s:32:\"2 Tablespoons: Zero Cal Sweetner\";i:3;s:23:\"1 Scoop: Protein Powder\";i:4;s:16:\"225 grams: syrup\";}', 'a:6:{i:0;s:53:\"Mix egg whites, protein powder and sweetner together.\";i:1;s:40:\"Soak bread slices in liquid until soggy.\";i:2;s:44:\"Spray pan on stove with pam over medium heat\";i:3;s:27:\"Place and cook bread in pan\";i:4;s:36:\"Flip bread once first side is cooked\";i:5;s:25:\"Plate, pour syrup, enjoy!\";}', 1, '2021-11-08 21:28:46', 2, 1, 1),
(30, 'f256165fb28e74d5468a8093710038ebc370fba0', 'Ronto Wrap', 'This recipe is inspired by the breakfast &#39;Ronto Wrap&#39; from Star Wars Disneyland. Except this amazing, flavorful dish is high protein and low calorie, dare I say better!', '15', '1', '400', 1, 'a:7:{i:0;s:35:\"2 Tortillas: Carb Counter Tortillas\";i:1;s:34:\"1 sausage: Low cal chicken sausage\";i:2;s:21:\"1 cup: egg substitute\";i:3;s:20:\"30 grams: light mayo\";i:4;s:28:\"5 grams: horseradish mustard\";i:5;s:27:\"peppercorn medley seasoning\";i:6;s:10:\"grlic salt\";}', 'a:5:{i:0;s:47:\"Cut sausage in half and cook on medium heat pan\";i:1;s:59:\"Cook eggs and season with peppercorn medley and garlic salt\";i:2;s:35:\"For the sauce, mix mayo and mustard\";i:3;s:29:\"Season with peppercorn medley\";i:4;s:25:\"Assemble tacos and ENJOY!\";}', 1, '2021-11-08 21:40:50', 3, 1, 1),
(31, '043a8e3ad19400aaf86ed99ade91593ca53c9c3e', 'Shrimp Fried Rice', 'Shrimp fried rice is sooooo delicious, but sadly so high in calories. This recipe isn&#39;t made with rice, but does have the same amazing and powerful flavors that will satisfy that want.', '25', '1', '330', 2, 'a:6:{i:0;s:16:\"Cauliflower Rice\";i:1;s:13:\"Veggie Medley\";i:2;s:6:\"Shrimp\";i:3;s:9:\"Egg White\";i:4;s:9:\"Soy Sauce\";i:5;s:20:\"Fried Rice Seasoning\";}', 'a:7:{i:0;s:11:\"Cook shrimp\";i:1;s:44:\"Cook cauliflower rice with the veggie medley\";i:2;s:22:\"Scramble the eggwhites\";i:3;s:44:\"Combine all cooked ingredients in heated pan\";i:4;s:27:\"Mic soy sauce and seasoning\";i:5;s:31:\"Add seasoning mix to fried rice\";i:6;s:6:\"Enjoy!\";}', 2, '2021-11-08 21:47:59', 5, 1, 1),
(32, 'ce99108e9e2a368f050e7e482d4baaa2b2f90a1e', 'Low Carb Spaghetti', 'Lets get noodlyyyy! Oh yes, low calorie pasta, your wishes were answered. No more struggling with plain meals. Try out this amazing and flavorful pastaaaa!', '35', '1', '330', 1, 'a:9:{i:0;s:23:\"1 Packet: Palmi Noodles\";i:1;s:27:\"3/4 cup: Ragu low cal sauce\";i:2;s:29:\"1 serving: lean ground turkey\";i:3;s:10:\"red pepper\";i:4;s:13:\"garlic powder\";i:5;s:5:\"basil\";i:6;s:7:\"parsley\";i:7;s:25:\"garlic and herb seasoning\";i:8;s:12:\"spray butter\";}', 'a:6:{i:0;s:22:\"Rinse noodles in water\";i:1;s:38:\"Cook ground turkey with the seasonings\";i:2;s:25:\"Pour in sauce and noodles\";i:3;s:23:\"Spray with spray butter\";i:4;s:16:\"Season alottttt!\";i:5;s:6:\"Enjoy!\";}', 3, '2021-11-08 21:54:37', 8, 1, 1);

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
(25, 1, 10, 3),
(26, 5, 8, 3),
(27, 4, 16, 1),
(28, 2, 17, 1),
(29, 5, 19, 1),
(30, 4, 31, 8),
(31, 3, 30, 8),
(32, 5, 29, 8),
(33, 5, 27, 8),
(34, 4, 32, 8),
(35, 2, 28, 8),
(36, 4, 32, 1),
(37, 4, 31, 1),
(38, 5, 30, 1),
(39, 4, 29, 1),
(40, 3, 28, 1),
(41, 4, 27, 1),
(42, 4, 32, 2),
(43, 5, 31, 2),
(44, 5, 30, 2),
(45, 2, 29, 2),
(46, 4, 28, 2),
(47, 3, 27, 2),
(48, 5, 32, 5),
(49, 3, 31, 5),
(50, 5, 30, 5),
(51, 4, 29, 5),
(52, 3, 28, 5),
(53, 4, 27, 5),
(54, 4, 32, 4),
(55, 5, 31, 4),
(56, 5, 30, 4),
(57, 3, 29, 4),
(58, 4, 28, 4),
(59, 2, 27, 4),
(60, 4, 32, 3),
(61, 5, 31, 3),
(62, 5, 30, 3),
(63, 3, 29, 3),
(64, 3, 28, 3),
(65, 4, 27, 3),
(66, 1, 28, 6),
(67, 5, 30, 6),
(68, 5, 32, 6);

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
(1, 'Chloe Gunter ', 'chloe@gmail.com', '$2y$10$bz3yLq4YljOqWGUaQfNB9O6of4aXrAu/FqAeI6oMels933sO5gyQS', 'avatars/48a7cdf29b1f24b9de5ee504730ebb5b48893e6a_small.jpg', 'This is my new bio!!', '2021-10-26 11:46:42', 0, ''),
(2, 'Cheryl', 'cheryl@gmail.com', '$2y$10$1JMdV9Nw2jrlYWb/rs5YrO8VEsqtTZGLZenhmSwkjatFhlXp4i8OG', 'avatars/768abe317f3eef2d2e7336f0aa8cd7ca8cfd6b95_small.jpg', NULL, '2021-10-27 18:39:05', 0, ''),
(3, 'Maddy', 'maddy@gmail.com', '$2y$10$ZVvNjPmiYqs4DKoyw9f3w.8S2xxJSBTEZz3MmOBs5kBuGooW5/gpy', 'avatars/f3453e04f438ba1e597502066f13b658fa7153e6_small.jpg', NULL, '2021-10-28 09:51:28', 0, ''),
(4, 'chris', 'chris@gmail.com', '$2y$10$G2akYvBdBKL5SzdFqxCpj.QbPJVYh6vrh4NC3IDbmz3bE0NnNpq6K', 'avatars/160a7fa70b3e35e471ec0a99c8354cd774a99f9f_small.jpg', NULL, '2021-11-01 18:17:15', 0, ''),
(5, 'parker', 'parker@gmail.com', '$2y$10$BQKgGmhWOXF2gYa3PedoN.irwbjKZydpOy.67H08FMRdFQOIINlka', 'avatars/901d11fac4dbb3e04fb9f03dd563158c3fa1e2c3_small.jpg', NULL, '2021-11-01 18:32:59', 0, ''),
(6, 'hannah', 'hannah@gmail.com', '$2y$10$hQxFJNJRzLB7HZHttRgHUOmTs/Od7z0bUbW7MomWOvNRCmT5cBRxG', 'avatars/h_102_35_94.png', NULL, '2021-11-01 18:39:54', 0, '2748046c830c4bd6248461a8c5d689266cdef642873b62921b5d066fa2ac'),
(7, 'edward', 'ed@gmail.com', '$2y$10$Hnu75A.D8AuMS5nJGhZmR.IDggop3wSi9ppvRN6OFMGWYT3ryYdvO', 'avatars/e_243_33_94.png', NULL, '2021-11-01 18:46:01', 0, '51dc1a35e06f17717cb49cde63fa748470dd3f8376647ac407570d2ae7a4'),
(8, 'ryan', 'ryan@gmail.com', '$2y$10$AlxxzLNdsxneO.Q28E6T5u4nkurQPDOxPau9h1vzttNIZXeeN74Oa', 'avatars/9028fa41ff2cefe1d806f62f641a6ca26d64bcf2_small.jpg', NULL, '2021-11-07 18:03:04', 0, ''),
(9, 'bryan', 'bryan@gmail.com', '$2y$10$nKfvkbo9/FCdfBZIu1ZsY.KM.fRuh9I5pSunmQnfVqcOFUl.VqckC', 'avatars/b_318_45_91.png', NULL, '2021-11-07 18:04:07', 0, NULL),
(10, 'will', 'will@gmail.com', '$2y$10$YRQDpkqbPwAKOOEfdGphQ./wODdPMpkquLHSwHtNaWb.zPFEM0aX2', 'avatars/w_277_30_95.png', NULL, '2021-11-07 18:05:31', 0, NULL),
(11, 'christopher', 'christopher@gmail.com', '$2y$10$tEPKPKZkcdeuUUEEqUBQ8ezL8J.y0yVVvyxeeayYFlyQ1a8oLlKpa', 'avatars/c_49_36_95.png', NULL, '2021-11-08 14:27:06', 0, NULL),
(12, 'ezra', 'ezra@gmail.com', '$2y$10$y6TE8vaKZAU29Cls6EmjFuHvYJJ.PSvz5ZG2DkP8bpk2MjnJtQFL6', 'avatars/e_132_29_96.png', NULL, '2021-11-08 14:29:55', 0, NULL);

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
  MODIFY `comment_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `level_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
