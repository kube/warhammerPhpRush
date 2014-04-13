<?php 

/**
*  Class mysql, query et connexion
*/
class Mysql
{
	private $_host = "local.42.fr";
	private $_dbName = "42K";
	private $_co;

	function __construct(array $kwargs)
	{
		if (array_key_exists('login' , $kwargs) && array_key_exists('passwd', $kwargs) && array_key_exists('create', $kwargs))
			$this->_Create_bd($kwargs);
		else if (array_key_exists('co', $kwargs))
		{
			$this->_co = new PDO('mysql:host='.$kwargs['host'].';dbname='.$this->_dbName, $kwargs['login'], $kwargs['passwd'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			return ($this);
		}		
	}

	private function _Create_bd(array $kwargs)
	{
		$this->_co = new PDO('mysql:host='.$kwargs['host'].';', $kwargs['login'], $kwargs['passwd'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		$query = $this->_co->prepare(" DROP DATABASE IF EXISTS ".$this->_dbName."; CREATE DATABASE IF NOT EXISTS ".$this->_dbName.";");
		$query->execute();
		$table_users = "USE ".$this->_dbName.";".file_get_contents('table_users.sql');
		$query = $this->_co->prepare($table_users);
		$query->execute();
		$table_game = "USE ".$this->_dbName.";".file_get_contents('table_game.sql');
		$query = $this->_co->prepare($table_game);
		$query->execute();
	}

	public function add_user(array $usr)
	{
		if (!array_key_exists('login', $usr) || !array_key_exists('passwd', $usr) || !array_key_exists('mail', $usr))
			return (false);
		else
		{
			$l = $usr['login'];	$m = $usr['mail']; $p = $usr['passwd'];
			$query = "INSERT INTO `42k_users`(`login`, `mail`, `passwd`) VALUES ('$l','$m','$p')";
			$q = $this->_co->prepare($query);
			$q->execute();
			return (true);
		}
	}

	public function check_login($login)
	{
		$q = "SELECT `login` FROM `42k_users` WHERE `login` = '$login'";
		$res = $this->_co->query($q);
		while ($l = $res->fetch()) {
			$ret[] = $l;
		}
		if (isset($ret))
			return (true);
		else
			return (false);
	}

	public function get_login($login)
	{
		$q = "SELECT * FROM `42k_users` WHERE `login` = '$login'";
		$res = $this->_co->query($q);
		while ($l = $res->fetch()) {
			$ret[] = $l;
		}
		if (isset($ret[0]))
			return ($ret[0]);
	}

	public function get_users()
	{
		$q = "SELECT `login` FROM `42k_users` WHERE 1";
		$res = $this->_co->query($q);
		while ($l = $res->fetch())
			$ret[] = $l;
		return ($ret);
	}

	public function record_player($shop, $faction, $usr)
	{
		$query = "UPDATE `42k_users` SET `shop` = '$shop', `faction` = '$faction' WHERE `login` = '$usr'";
		$q = $this->_co->prepare($query);
		$q->execute();
	}

	public function clean_players($usr, $versus)
	{
		$query = "UPDATE `42k_users` SET `shop` = '', `faction` = '' WHERE `login` = '$usr';";
		foreach ($versus as $v) {
			$query .= "UPDATE `42k_users` SET `shop` = '', `faction` = '' WHERE `login` = '$v';";
		}
		$q = $this->_co->prepare($query);
		$q->execute();
	}

	public function get_games()
	{
		$q = "SELECT * FROM `42k_game` WHERE 1";
		$res = $this->_co->query($q);
		print_r($res);
		while ($l = $res->fetch())
			$ret[] = $l;
		return ($ret);	
	}

	public function new_game($nb, $name)
	{
		$query = "INSERT INTO `42k_game`(`nb_players`) VALUES ('$nb', '$name')";
		$q = $this->_co->prepare($query);
		$q->execute();
	}
}

?>
