<?php

require_once "Ship.class.php";

class Player
{
	private				$_player;
	public				$ships;

	public function		__construct($player)
	{
		$this->_player = $player;
		$this->ships = array();
		array_push($this->ships, new Ship(7, 4, 20 * $player, 25 * $player));
		array_push($this->ships, new Ship(1, 3, 10 * $player, 35 * $player));
	}
}

?>
