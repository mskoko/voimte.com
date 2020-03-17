-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2019 at 02:19 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `voimte.com`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer_result_like`
--

CREATE TABLE `answer_result_like` (
  `id` int(11) NOT NULL,
  `userID` text NOT NULL,
  `ownerID` text NOT NULL,
  `Date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `quizz`
--

CREATE TABLE `quizz` (
  `id` int(11) NOT NULL,
  `Type` text DEFAULT NULL,
  `Name` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quizz`
--

INSERT INTO `quizz` (`id`, `Type`, `Name`) VALUES
(1, '1', 'Test quizz');

-- --------------------------------------------------------

--
-- Table structure for table `quizz_answers`
--

CREATE TABLE `quizz_answers` (
  `id` int(11) NOT NULL,
  `qID` text DEFAULT NULL,
  `Answer` text DEFAULT NULL,
  `Image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quizz_answers`
--

INSERT INTO `quizz_answers` (`id`, `qID`, `Answer`, `Image`) VALUES
(1, '1', 'Instagram', 'assets/img/quizz/sbwadwDPqB.png'),
(2, '1', 'Facebook', 'assets/img/quizz/jEK4A5yktW.jpg'),
(3, '2', 'Macka', 'assets/img/quizz/AZ2oFpCmoU.jpg'),
(4, '2', 'Pas', 'assets/img/quizz/eGYBMdRi25.jpg'),
(5, '2', 'Papagaj', 'assets/img/quizz/vZL6iejvJK.jpg'),
(6, '3', 'Dan', 'assets/img/quizz/PkAWOfLPxI.jpg'),
(7, '3', 'Noc', 'assets/img/quizz/Mk2CYmOJoq.jpg'),
(8, '4', 'Kafa', 'assets/img/quizz/CQv6dk7PIJ.jpg'),
(9, '4', 'Caj', 'assets/img/quizz/LEpPgfX4dT.jpg'),
(10, '4', 'Sok', 'assets/img/quizz/LG7FhGhUsX.jpg'),
(11, '4', 'Alkohol', 'assets/img/quizz/J7wolJcf3j.jpg'),
(12, '5', 'Cvece', 'assets/img/quizz/tABFtNdaZA.jpg'),
(13, '5', 'Plisani medo', 'assets/img/quizz/K5aSrIQwFe.jpg'),
(14, '5', 'Nakit', 'assets/img/quizz/oyVt0G3Nrs.jpg'),
(15, '5', 'Izlet', 'assets/img/quizz/OjptoT7JFi.jpg'),
(16, '6', 'London', 'assets/img/quizz/qGYq8080vL.jpg'),
(17, '6', 'New York', 'assets/img/quizz/bljHyAyCb6.jpg'),
(18, '6', 'Moskva', 'assets/img/quizz/UbnbS30Bcj.jpg'),
(19, '6', 'Sangaj', 'assets/img/quizz/jfxovtvzxW.jpg'),
(20, '7', 'Skola', 'assets/img/quizz/6lSP1Mzhyg.jpg'),
(21, '7', 'Fakultet', 'assets/img/quizz/7KwusGEAqT.jpg'),
(22, '8', 'Slatko', 'assets/img/quizz/v5ClFkoYeZ.jpg'),
(23, '8', 'Slano', 'assets/img/quizz/hnKWepbG7s.jpg'),
(24, '9', 'Tradicionalni', 'assets/img/quizz/eNgDAEIkYA.jpg'),
(25, '9', 'Online', 'assets/img/quizz/XzReszMnKH.jpg'),
(26, '10', 'Obicna kafa', 'assets/img/quizz/x0KgMDjv9T.jpg'),
(27, '10', 'Nes kafa', 'assets/img/quizz/wj1KVLSA3Q.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `quizz_question`
--

CREATE TABLE `quizz_question` (
  `id` int(11) NOT NULL,
  `qID` text DEFAULT NULL,
  `Question` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quizz_question`
--

INSERT INTO `quizz_question` (`id`, `qID`, `Question`) VALUES
(1, '1', 'Sta vise koristis?'),
(2, '1', 'Koju zivotinju bi volio da imas?'),
(3, '1', 'Sta vise volis?'),
(4, '1', 'Koje pice vise volis?'),
(5, '1', 'Sta bi radije uzela kao poklon?'),
(6, '1', 'Gde bi prije otputovao?'),
(7, '1', 'Sta si zavrsio?'),
(8, '1', 'Sta vise volis?'),
(9, '1', 'Koji vid shopinga preferiras?'),
(10, '1', 'Koju kafu vise volis?');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL,
  `site_name` text NOT NULL,
  `site_link` text NOT NULL,
  `site_online` text NOT NULL,
  `site_update` text NOT NULL,
  `site_version` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `site_name`, `site_link`, `site_online`, `site_update`, `site_version`) VALUES
(1, 'voimte.com', 'voimte.com', '1', '1', '1.0.0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Username` text NOT NULL,
  `Password` text NOT NULL,
  `Email` text NOT NULL,
  `Name` text NOT NULL,
  `Lastname` text NOT NULL,
  `Gender` text NOT NULL,
  `Image` text DEFAULT NULL,
  `Website` text DEFAULT NULL,
  `reg_token` text NOT NULL,
  `reg_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Username`, `Password`, `Email`, `Name`, `Lastname`, `Gender`, `Image`, `Website`, `reg_token`, `reg_status`) VALUES
(6, '_muky00', 'fe01ce2a7fbac8fafaed7c982a04e229', 'jadza.muki@gmail.com', 'Muhamed', 'Skoko', '', 'user/img/dzME5gYsoxwFu0HdX3PFytG2lRXLCPTF5MshkgzRBu8OBi6tar.jpg', '', 'uhduishiudhuihsdiuhsdiuha', '1'),
(7, 'spejovic', 'fe01ce2a7fbac8fafaed7c982a04e229', 'sara@sara.com', 'Sara', 'Pejovic', '', 'user/img/1OBHF40bFCeB4q6Ugu3X.jpg', 'http://instagram.com/_sarapejovic', 'hsuidh1978hhg807gnfuighfuidhius', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user_answer`
--

CREATE TABLE `user_answer` (
  `id` int(11) NOT NULL,
  `qID` text NOT NULL,
  `cAnswer` text NOT NULL,
  `userID` text NOT NULL,
  `Date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_question`
--

CREATE TABLE `user_question` (
  `id` int(11) NOT NULL,
  `tID` text NOT NULL,
  `qID` text NOT NULL,
  `userID` text NOT NULL,
  `Date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_views`
--

CREATE TABLE `user_views` (
  `id` int(11) NOT NULL,
  `user_id` text DEFAULT NULL,
  `profile_id` text DEFAULT NULL,
  `Date` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_views`
--

INSERT INTO `user_views` (`id`, `user_id`, `profile_id`, `Date`) VALUES
(1, '6', '6', '17.11.2019, 19:29pm'),
(2, '6', '7', '17.11.2019, 21:52pm'),
(3, NULL, '6', '17.11.2019, 22:45pm'),
(4, NULL, '6', '17.11.2019, 22:52pm'),
(5, NULL, NULL, '26.11.2019, 13:08pm'),
(6, NULL, NULL, '26.11.2019, 13:08pm'),
(7, NULL, NULL, '26.11.2019, 13:08pm'),
(8, NULL, NULL, '26.11.2019, 13:08pm'),
(9, NULL, NULL, '26.11.2019, 13:08pm'),
(10, NULL, NULL, '26.11.2019, 13:08pm'),
(11, NULL, NULL, '26.11.2019, 13:08pm'),
(12, NULL, NULL, '26.11.2019, 13:08pm'),
(13, NULL, NULL, '26.11.2019, 13:08pm'),
(14, NULL, NULL, '26.11.2019, 13:08pm'),
(15, NULL, NULL, '26.11.2019, 13:08pm'),
(16, NULL, NULL, '26.11.2019, 13:08pm'),
(17, NULL, NULL, '26.11.2019, 13:08pm'),
(18, NULL, NULL, '26.11.2019, 13:08pm'),
(19, NULL, NULL, '26.11.2019, 13:08pm'),
(20, NULL, NULL, '26.11.2019, 13:08pm'),
(21, NULL, NULL, '26.11.2019, 13:08pm'),
(22, NULL, NULL, '26.11.2019, 13:08pm'),
(23, NULL, NULL, '26.11.2019, 13:08pm'),
(24, NULL, NULL, '26.11.2019, 13:08pm'),
(25, NULL, NULL, '26.11.2019, 13:08pm'),
(26, NULL, NULL, '26.11.2019, 13:08pm'),
(27, NULL, NULL, '26.11.2019, 13:08pm'),
(28, NULL, NULL, '26.11.2019, 13:08pm'),
(29, NULL, NULL, '26.11.2019, 13:08pm'),
(30, NULL, NULL, '26.11.2019, 13:08pm'),
(31, NULL, NULL, '26.11.2019, 13:08pm'),
(32, NULL, NULL, '26.11.2019, 13:08pm'),
(33, '6', NULL, '26.11.2019, 16:55pm'),
(34, NULL, NULL, '27.11.2019, 01:51am'),
(35, NULL, NULL, '27.11.2019, 01:51am'),
(36, NULL, NULL, '27.11.2019, 01:51am'),
(37, NULL, NULL, '27.11.2019, 01:51am'),
(38, NULL, NULL, '27.11.2019, 01:51am'),
(39, NULL, NULL, '27.11.2019, 01:51am'),
(40, NULL, NULL, '27.11.2019, 01:51am'),
(41, NULL, NULL, '27.11.2019, 01:51am'),
(42, NULL, NULL, '27.11.2019, 01:51am'),
(43, NULL, NULL, '27.11.2019, 01:51am'),
(44, NULL, NULL, '27.11.2019, 01:51am'),
(45, NULL, NULL, '27.11.2019, 01:51am'),
(46, NULL, NULL, '27.11.2019, 01:51am'),
(47, NULL, NULL, '27.11.2019, 01:51am'),
(48, NULL, NULL, '27.11.2019, 01:51am'),
(49, NULL, NULL, '27.11.2019, 01:51am'),
(50, NULL, NULL, '27.11.2019, 01:51am'),
(51, NULL, NULL, '27.11.2019, 01:51am'),
(52, NULL, NULL, '27.11.2019, 01:51am'),
(53, NULL, NULL, '27.11.2019, 01:51am'),
(54, NULL, NULL, '27.11.2019, 01:51am'),
(55, NULL, NULL, '27.11.2019, 01:51am'),
(56, NULL, NULL, '27.11.2019, 01:51am'),
(57, NULL, NULL, '27.11.2019, 01:51am'),
(58, NULL, NULL, '27.11.2019, 01:51am'),
(59, NULL, NULL, '27.11.2019, 01:51am'),
(60, NULL, NULL, '27.11.2019, 01:51am'),
(61, NULL, NULL, '27.11.2019, 01:51am'),
(62, NULL, NULL, '27.11.2019, 01:51am'),
(63, NULL, NULL, '27.11.2019, 01:51am'),
(64, NULL, NULL, '27.11.2019, 01:51am'),
(65, NULL, NULL, '27.11.2019, 01:51am'),
(66, NULL, NULL, '27.11.2019, 01:51am'),
(67, NULL, NULL, '27.11.2019, 01:51am'),
(68, NULL, NULL, '27.11.2019, 01:51am'),
(69, NULL, NULL, '27.11.2019, 01:51am'),
(70, NULL, NULL, '27.11.2019, 01:51am'),
(71, NULL, NULL, '27.11.2019, 01:51am'),
(72, NULL, NULL, '27.11.2019, 01:51am'),
(73, NULL, NULL, '27.11.2019, 01:51am'),
(74, NULL, NULL, '27.11.2019, 01:51am'),
(75, NULL, NULL, '27.11.2019, 01:51am'),
(76, NULL, NULL, '27.11.2019, 01:51am'),
(77, NULL, NULL, '27.11.2019, 01:51am'),
(78, NULL, NULL, '27.11.2019, 01:51am'),
(79, NULL, NULL, '27.11.2019, 01:51am'),
(80, NULL, NULL, '27.11.2019, 01:51am'),
(81, NULL, NULL, '27.11.2019, 01:51am'),
(82, NULL, NULL, '27.11.2019, 01:51am'),
(83, NULL, NULL, '27.11.2019, 01:51am'),
(84, NULL, NULL, '27.11.2019, 01:51am'),
(85, NULL, NULL, '27.11.2019, 01:51am'),
(86, NULL, NULL, '27.11.2019, 01:51am'),
(87, NULL, NULL, '27.11.2019, 01:51am'),
(88, NULL, NULL, '27.11.2019, 01:51am'),
(89, NULL, NULL, '27.11.2019, 01:51am'),
(90, NULL, NULL, '27.11.2019, 01:51am'),
(91, NULL, NULL, '27.11.2019, 01:51am'),
(92, NULL, NULL, '27.11.2019, 01:51am'),
(93, NULL, NULL, '27.11.2019, 01:52am'),
(94, NULL, NULL, '27.11.2019, 01:52am'),
(95, NULL, NULL, '27.11.2019, 01:52am'),
(96, NULL, NULL, '27.11.2019, 01:52am'),
(97, NULL, NULL, '27.11.2019, 01:52am'),
(98, NULL, NULL, '27.11.2019, 01:52am'),
(99, NULL, NULL, '27.11.2019, 01:52am'),
(100, NULL, NULL, '27.11.2019, 01:52am'),
(101, NULL, NULL, '27.11.2019, 01:52am'),
(102, NULL, NULL, '27.11.2019, 01:52am'),
(103, NULL, NULL, '27.11.2019, 01:52am'),
(104, NULL, NULL, '27.11.2019, 01:52am'),
(105, NULL, NULL, '27.11.2019, 01:52am'),
(106, NULL, NULL, '27.11.2019, 01:52am'),
(107, NULL, NULL, '27.11.2019, 01:52am'),
(108, NULL, NULL, '27.11.2019, 01:52am'),
(109, NULL, NULL, '27.11.2019, 01:52am'),
(110, NULL, NULL, '27.11.2019, 01:52am'),
(111, NULL, NULL, '27.11.2019, 01:52am'),
(112, NULL, NULL, '27.11.2019, 01:52am'),
(113, NULL, NULL, '27.11.2019, 01:52am'),
(114, NULL, NULL, '27.11.2019, 01:53am');

-- --------------------------------------------------------

--
-- Table structure for table `u_answer_quizz`
--

CREATE TABLE `u_answer_quizz` (
  `id` int(11) NOT NULL,
  `tID` text NOT NULL,
  `qID` text NOT NULL,
  `Answer` text NOT NULL,
  `userID` text NOT NULL,
  `ownerID` text NOT NULL,
  `Date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `u_answer_results`
--

CREATE TABLE `u_answer_results` (
  `id` int(11) NOT NULL,
  `qID` text NOT NULL,
  `Result` text NOT NULL,
  `userID` text NOT NULL,
  `ownerID` text NOT NULL,
  `Date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `voimte_post`
--

CREATE TABLE `voimte_post` (
  `id` int(11) NOT NULL,
  `profile_id` text DEFAULT NULL,
  `user_id` text DEFAULT NULL,
  `p_text` text DEFAULT NULL,
  `p_audio` text DEFAULT NULL,
  `fInfo` text DEFAULT NULL,
  `Annon` text DEFAULT NULL,
  `Date` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `voimte_post`
--

INSERT INTO `voimte_post` (`id`, `profile_id`, `user_id`, `p_text`, `p_audio`, `fInfo`, `Annon`, `Date`) VALUES
(1, '7', '6', 'Volim te bebo!!', '', '', '0', '26.11.2019, 16:56pm'),
(2, '7', '6', '', 'user/v/ZTs9ipkUqBJDPtMYyfKdmFahuRU1752G03utKDJytYgD6zDFBx.mp4', 'a:5:{s:15:\"duration_string\";s:4:\"0:34\";s:16:\"duration_seconds\";d:33.751;s:12:\"dimensions_y\";i:1920;s:12:\"dimensions_x\";i:1080;s:14:\"filesize_bytes\";i:72865986;}', '', '26.11.2019, 16:56pm'),
(3, '7', '6', '', 'user/v/kvqLpNANKLVi5rDYAdMcUiYTmCxBPTgRVrLdDhoITvg7R0HvVb.mp4', 'a:5:{s:15:\"duration_string\";s:4:\"0:17\";s:16:\"duration_seconds\";d:16.892;s:12:\"dimensions_y\";i:1920;s:12:\"dimensions_x\";i:1080;s:14:\"filesize_bytes\";i:36289632;}', '', '26.11.2019, 16:57pm'),
(4, '7', '6', '', 'user/audio_msg/Trh9EINvBPiM0NM5STMYVu8VY6wYcfmWTgKhk5Adrhgf7HcBNq.mp3', '', '', '26.11.2019, 16:59pm'),
(5, '7', '6', '', 'user/v/IZcbXruPKqCYoioReZ59TQojNiLJy3Exp3gNwZLskJF6DHWyBJ.mp4', 'a:5:{s:15:\"duration_string\";s:4:\"1:13\";s:16:\"duration_seconds\";d:72.732;s:12:\"dimensions_y\";i:1920;s:12:\"dimensions_x\";i:1080;s:14:\"filesize_bytes\";i:156918646;}', '', '26.11.2019, 17:00pm'),
(6, '6', '6', '', 'user/v/4A7tR5HJFneZ3QsDgxq4t8ZiHzojeG59eLk3hv9mW8EsWgn4Tr.mp4', 'a:5:{s:15:\"duration_string\";s:4:\"0:44\";s:16:\"duration_seconds\";d:44.179;s:12:\"dimensions_y\";i:1920;s:12:\"dimensions_x\";i:1080;s:14:\"filesize_bytes\";i:95341616;}', '', '26.11.2019, 17:26pm'),
(7, '6', '6', '', 'user/v/OtUVGvaDjqzPquKpzmz3dU5wJZPHKFQXM7UF7zDm6tI2BdaWtU.mp4', 'a:5:{s:15:\"duration_string\";s:4:\"0:44\";s:16:\"duration_seconds\";d:44.179;s:12:\"dimensions_y\";i:1920;s:12:\"dimensions_x\";i:1080;s:14:\"filesize_bytes\";i:95341616;}', '', '26.11.2019, 17:27pm'),
(8, '6', '6', '', 'user/v/350bf8YuWAYN9gyBhj7NAlwivVY7MlOiTwaIdNWzbRDStEFzVt.mp4', 'a:5:{s:15:\"duration_string\";s:4:\"1:13\";s:16:\"duration_seconds\";d:72.732;s:12:\"dimensions_y\";i:1920;s:12:\"dimensions_x\";i:1080;s:14:\"filesize_bytes\";i:156918646;}', '', '26.11.2019, 18:05pm'),
(9, '6', '6', '', 'user/v/IKcxETisIR1Sn27UY1Fr0lMondsJ2GkRKSrjrjtuoWZvEHVQm3.mp4', 'a:5:{s:15:\"duration_string\";s:4:\"1:13\";s:16:\"duration_seconds\";d:72.732;s:12:\"dimensions_y\";i:1920;s:12:\"dimensions_x\";i:1080;s:14:\"filesize_bytes\";i:156918646;}', '', '26.11.2019, 18:06pm'),
(10, '7', '6', 'radi li? :D', '', '', '0', '27.11.2019, 01:57am'),
(11, '7', '6', '', 'user/audio_msg/W5IgHnGmLpo3mPhT1b1u3MqpzCKmXZm7RDz5WBkQXEI8zu1GhP.mp3', NULL, '', '01.12.2019, 18:59pm');

-- --------------------------------------------------------

--
-- Table structure for table `voimte_post_like`
--

CREATE TABLE `voimte_post_like` (
  `id` int(11) NOT NULL,
  `post_id` text DEFAULT NULL,
  `user_id` text DEFAULT NULL,
  `Date` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer_result_like`
--
ALTER TABLE `answer_result_like`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizz`
--
ALTER TABLE `quizz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizz_answers`
--
ALTER TABLE `quizz_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizz_question`
--
ALTER TABLE `quizz_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_answer`
--
ALTER TABLE `user_answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_question`
--
ALTER TABLE `user_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_views`
--
ALTER TABLE `user_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `u_answer_quizz`
--
ALTER TABLE `u_answer_quizz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `u_answer_results`
--
ALTER TABLE `u_answer_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voimte_post`
--
ALTER TABLE `voimte_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voimte_post_like`
--
ALTER TABLE `voimte_post_like`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer_result_like`
--
ALTER TABLE `answer_result_like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quizz`
--
ALTER TABLE `quizz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quizz_answers`
--
ALTER TABLE `quizz_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `quizz_question`
--
ALTER TABLE `quizz_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_answer`
--
ALTER TABLE `user_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_question`
--
ALTER TABLE `user_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_views`
--
ALTER TABLE `user_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `u_answer_quizz`
--
ALTER TABLE `u_answer_quizz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `u_answer_results`
--
ALTER TABLE `u_answer_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `voimte_post`
--
ALTER TABLE `voimte_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `voimte_post_like`
--
ALTER TABLE `voimte_post_like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
