-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 03, 2013 at 12:58 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `malinda`
--

-- --------------------------------------------------------

--
-- Table structure for table `favourite`
--

CREATE TABLE IF NOT EXISTS `favourite` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `type` varchar(2) NOT NULL,
  `resource` text NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `favourite`
--

INSERT INTO `favourite` (`id`, `type`, `resource`, `comment`) VALUES
(1, 'f', '&quot;http://farm9.static.flickr.com/8043/8440047659_d7f5968ebb_s.jpg&quot;', ''),
(2, 'f', '&quot;http://farm9.static.flickr.com/8499/8441136994_14bfec42de_s.jpg&quot;', ''),
(3, 'g', 'http://t1.gstatic.com/images?q=tbn:ANd9GcSURxkOAic1ZfNelE1tv-UscgGhl1_XweaGufoNAmm0CGhHcN8jeCqSnk0L', ''),
(4, 'g', 'http://t2.gstatic.com/images?q=tbn:ANd9GcSP0iv1YWT5xz0GCNUelzz6jqBfCKuuItT_TzTZIC5IFrjWwYtr04yYu4ix', '');
