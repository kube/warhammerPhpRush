<?php

require_once "Ship.class.php";

class Player
{
	private				$_player;
	private				$_game;
	public				$ships;

	public function		__construct($player)
	{
		$this->_player = $player;
		$this->ships = array();
	}

	public function		__toString()
	{
		$string = "{\n"
			."\"ships\":\n{\n";
		$numItems = count($this->ships);
		$i = 0;
		foreach ($this->ships as $key => $ship)
		{
			$string .= "\"".$key."\": ".$ship;
			if (++$i < $numItems)
				$string .= ",";
		}
		$string.= "}\n"
			."}\n";
		return $string;
	}

	public function		createShip($width, $height, $x, $y, $direction)
	{
		array_push($this->ships, new Ship($width, $height, $x, $y, $direction));
	}
}

?>
