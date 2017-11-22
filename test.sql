-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 22, 2017 at 11:04 PM
-- Server version: 10.0.31-MariaDB-0ubuntu0.16.04.2
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `ticket_id` int(10) UNSIGNED NOT NULL,
  `text` text NOT NULL,
  `created_date` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `ticket_id`, `text`, `created_date`) VALUES
(3, 1, 1, 'cxvxcvcxvcx', 0),
(4, 1, 1, 'SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS', 0),
(5, 1, 1, 'dfsdfdsfsf', 0),
(6, 1, 1, 'sdasdasdasdasdasda3333333333333333', 1511218897),
(7, 1, 1, '1111111111111111111111111111', 1511219204),
(8, 1, 6, 'Replt', 1511305013),
(9, 1, 6, 'XXX', 1511305024),
(10, 2, 5, '1', 1511310119),
(11, 2, 7, 'Uxxsadadasdsadsa', 1511362073),
(12, 1, 1, 'csssdfdsfsd', 1511378549),
(13, 1, 1, '1111111111111111111111111111', 1511378559),
(14, 1, 1, '22222222222222', 1511378586),
(16, 1, 8, 'Исправили ошибку', 1511380512);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `title`, `text`, `status`, `created_date`) VALUES
(1, 1, 'Титле', 'Текст', 1, 1511040547),
(3, 1, 'Иесчсв', 'выавыаываываыв аываываывавыаыв dfsdmflksdfnsdjkf nsdkf nsdkjfbds,jfbadfjbads,fbsd,fbads,fhbasdjfbdsmfndsjfksdb,fn dskjfbd,fndjfb,ds md bf,sd fjdb fdjbfdsjbfdsjfbd nbfmadf', 0, 2),
(4, 1, 'ВЫАВЫА', 'ВЫАЫВАЫВАЫВАЫАВЫА', 1, 0),
(5, 2, 'Submit Ticket', 'fgdfgdfg dfgdfg df gfdgdfgdgdfgdfgdfgd', 1, 1511301156),
(6, 1, 'XXXXXXXXXX', 'YYYYYYYYYYYYYYYYYY', 1, 1511304341),
(7, 2, 'GGGGG', 'sdadasdsadasdsa', 0, 1511362002),
(8, 3, 'Сайт', 'Не работает сайт', 1, 1511379998);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `auth_key` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `auth_key`, `username`, `password`, `role`) VALUES
(1, '8cOeh35sprwemWQV1gHSo85OTVnSJncU', 'test', '$2y$13$8Zkke6aUOWHsub7VFfT0k.DNLtlyFqPZafacDramuQIcX5KhIEEge', 1),
(2, 'Y6BvuRjxUB76J7KHbYhBRlmS3X-cqkFD', 'roman', '$2y$13$7lI6c6MJhEpAhSLBqCfrz.2lW8z6f8C4Kqiqv/txbgYaedsWjwVJW', 2),
(3, '1biN6NYyoU2SN1Vm2rNmp-0Xa-79Tjvf', 'alex', '$2y$13$ND/CK3USbeuLzBWr6XXjveR27iXYKEq7D5Ay9u.THTAJtnjMjcMx6', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_id` (`ticket_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `auth_key` (`auth_key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
