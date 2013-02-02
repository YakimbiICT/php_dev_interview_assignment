--
-- Table structure for table `fav`
--

CREATE TABLE IF NOT EXISTS `fav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img_url` text NOT NULL,
  `thumb_url` text NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;