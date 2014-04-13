CREATE TABLE IF NOT EXISTS `42k_game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nb_players` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `players` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;