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
		array_push($this->ships, new Ship(8, 4, 5 * $player, 25 * $player));
		array_push($this->ships, new Ship(1, 3, 10 * $player, 35 * $player));
	}

	public function		__toString()
	{
		$string = "{\n"
			."\"ships\":\n[\n";
		$numItems = count($this->ships);
		$i = 0;
		foreach ($this->ships as $ship)
		{
			$string .= $ship;
			if (++$i < $numItems)
				$string .= ",";
		}
		$string.= "]\n"
			."}\n";
		return $string;
	}
}

?>
