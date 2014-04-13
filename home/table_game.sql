CREATE TABLE IF NOT EXISTS `42k_game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nb_players` int(11) NOT NULL,
  `player1` varchar(255) DEFAULT NULL,
  `player2` varchar(255) DEFAULT NULL,
  `player3` varchar(255) DEFAULT NULL,
  `player4` varchar(255) DEFAULT NULL,
  `playing` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;