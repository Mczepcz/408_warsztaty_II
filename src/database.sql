-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 03, 2016 at 09:30 AM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Twitter`
--

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE IF NOT EXISTS `Comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tweet_id` int(11) NOT NULL,
  `comment_text` varchar(60) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tweet_id` (`tweet_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `Comments`
--

INSERT INTO `Comments` (`id`, `tweet_id`, `comment_text`, `user_id`, `creation_date`) VALUES
(1, 3, 'Great tweet', 2, '2016-06-01 13:34:19'),
(2, 3, 'Great tweet', 2, '2016-06-01 13:38:26'),
(3, 3, 'Great Tweet', 2, '2016-06-01 13:39:40'),
(4, 3, 'Great Tweet', 2, '2016-06-01 13:42:22'),
(5, 3, 'Great Tweet', 2, '2016-06-01 13:43:45'),
(6, 3, 'Poor tweet\r\n', 2, '2016-06-01 13:44:37'),
(7, 3, 'Poor tweet\r\n', 2, '2016-06-01 13:47:03'),
(8, 3, 'meh', 2, '2016-06-01 13:47:09'),
(9, 3, 'meh', 2, '2016-06-01 13:56:09'),
(10, 3, 'meh', 2, '2016-06-01 13:57:06'),
(11, 3, 'meh', 2, '2016-06-01 14:04:22'),
(12, 7, 'First comment', 3, '2016-06-01 14:07:16'),
(13, 3, 'Pretty cool', 3, '2016-06-01 15:04:16'),
(14, 3, 'Pretty cool', 3, '2016-06-01 15:06:02'),
(15, 3, 'Pretty cool', 3, '2016-06-01 15:07:28'),
(16, 3, 'Poor', 2, '2016-06-02 09:34:55');

-- --------------------------------------------------------

--
-- Table structure for table `Messages`
--

CREATE TABLE IF NOT EXISTS `Messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `text_message` text,
  `is_read` tinyint(1) NOT NULL DEFAULT '1',
  `title` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Messages_ibfk_1` (`sender_id`),
  KEY `Messages_ibfk_2` (`receiver_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `Messages`
--

INSERT INTO `Messages` (`id`, `sender_id`, `receiver_id`, `text_message`, `is_read`, `title`) VALUES
(3, 2, 3, 'Your tweets are ok\r\nMalpa', 0, 'Hi'),
(4, 2, 3, 'Helooo from the other side', 0, 'Hello'),
(5, 3, 2, 'Thank mate', 0, 'Re');

-- --------------------------------------------------------

--
-- Table structure for table `Tweets`
--

CREATE TABLE IF NOT EXISTS `Tweets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `text` varchar(140) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `Tweets`
--

INSERT INTO `Tweets` (`id`, `user_id`, `text`) VALUES
(1, 2, 'Hello World'),
(2, 2, 'Testing'),
(3, 2, 'Tweet no 3'),
(4, 2, 'New Tweet'),
(5, 2, 'Next new tweet'),
(6, 2, 'Hello'),
(7, 3, 'My first tweet'),
(8, 3, 'My second tweet'),
(9, 2, 'Czesc'),
(10, 5, 'Hau hau'),
(11, 5, 'Wrrrrr'),
(12, 5, 'Wooof woof'),
(13, 5, 'Wooof woof'),
(14, 5, 'Piesek Leszek'),
(15, 5, 'Piesek Leszek'),
(16, 5, 'Auuu auuuu');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`id`, `email`, `password`, `full_name`, `active`) VALUES
(1, 'michal.czepczynski@gmail.com', '$2y$10$0rbw53d6D96Wqu.sVDfnv.q/CY38EfpP5Lol.3.THfYKpRxhxfDt2', 'Michal Czepczynski', 0),
(2, 'malpa@malpa.pl', '$2y$10$mlCrUIcY.BK9R3TX7p4d7OaTGZG3sLBcbtoFSVCq7mV6R5cykrkli', 'Mala Malpa', 1),
(3, 'michal@michal.pl', '$2y$10$gjB3McO9gsqJGsLLb73.NeNb03A9Iyz4ochcneXFcnDvwmYxQ21FK', 'Michal Michal', 1),
(4, 'kotek@kotek.pl', '$2y$10$dfZg2/ouXnurjyeCexwenOuk.Dj2f7F.RGPZjFZiC1URvGSUCgg2W', 'Pan Kotek', 1),
(5, 'piesek@piesek.pl', '$2y$10$oTFGgmC5FnQp/M4.7pMxhuUb1c6qsSANNSoNxLyY82nAwb18ol5pK', 'Piesek Piesek', 1),
(6, 'leszek@piesek.pl', '$2y$10$PJCfAV7.E6bxsUH4dnqHd.cQxA.SGxZlRPYnREp/HdquC/eB3T.8u', 'Piesek Leszek', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Comments`
--
ALTER TABLE `Comments`
  ADD CONSTRAINT `Comments_ibfk_1` FOREIGN KEY (`tweet_id`) REFERENCES `Tweets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `Messages`
--
ALTER TABLE `Messages`
  ADD CONSTRAINT `Messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `User` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `User` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `Tweets`
--
ALTER TABLE `Tweets`
  ADD CONSTRAINT `Tweets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
