-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 16, 2013 at 10:49 PM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-1ubuntu9.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shopping-list`
--

-- --------------------------------------------------------

--
-- Table structure for table `shared_list`
--

CREATE TABLE IF NOT EXISTS `shared_list` (
  `user_id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL,
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shared_list`
--

INSERT INTO `shared_list` (`user_id`, `list_id`) VALUES
(1, 3),
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_items`
--

CREATE TABLE IF NOT EXISTS `shopping_items` (
  `itm_id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_description` text NOT NULL,
  `status` enum('pending','bought') NOT NULL DEFAULT 'pending',
  KEY `itm_id` (`itm_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `shopping_items`
--

INSERT INTO `shopping_items` (`itm_id`, `fk_id`, `item_name`, `item_description`, `status`) VALUES
(8, 2, 'audi a4', 'rs4', 'bought'),
(7, 2, 'qwwwqw', 'wewqewqe                                qwqwqwq', 'pending'),
(5, 1, 'Milk', 'asdsdfsf', 'bought'),
(6, 1, 'qwert', 'wtyuiuytre', 'pending'),
(10, 3, 'soup', 'mmm jamm', 'bought'),
(11, 3, 'item two', 'item description', 'bought');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_list`
--

CREATE TABLE IF NOT EXISTS `shopping_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `list_name` varchar(100) NOT NULL,
  `list_owner` int(11) NOT NULL,
  `list_items` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `list_owner` (`list_owner`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `shopping_list`
--

INSERT INTO `shopping_list` (`id`, `list_name`, `list_owner`, `list_items`) VALUES
(1, 'Food', 1, 0),
(2, 'list two', 1, 0),
(3, 'my list', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`) VALUES
(1, 'demouser', '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(2, 'demouser1', '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(3, 'demouser2', '7c4a8d09ca3762af61e59520943dc26494f8941b');
