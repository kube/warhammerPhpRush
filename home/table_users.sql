CREATE TABLE IF NOT EXISTS `42k_users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `nb_games` int(11) NOT NULL,
  `games_id` text NOT NULL,
  `current_game` int(11) NOT NULL,
  `passwd` varchar(512) NOT NULL,
  `exploits` text NOT NULL,
  `faction` varchar(200) NOT NULL,
  `shop` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;