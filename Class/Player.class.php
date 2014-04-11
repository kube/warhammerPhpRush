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
		if ($player == 1)
		{
			array_push($this->ships, new Ship(3, 10, 5 , 10));
			array_push($this->ships, new Ship(3, 10, 10 , 10));
			array_push($this->ships, new Ship(2, 7, 15 , 10));
			array_push($this->ships, new Ship(2, 7, 20 , 10));
			array_push($this->ships, new Ship(1, 3, 25, 10));
			array_push($this->ships, new Ship(1, 3, 30, 10));
		}
		else
		{
			array_push($this->ships, new Ship(3, 10, 145 , 80));
			array_push($this->ships, new Ship(3, 10, 140 , 80));
			array_push($this->ships, new Ship(2, 7, 135 , 80));
			array_push($this->ships, new Ship(2, 7, 130 , 80));
			array_push($this->ships, new Ship(1, 3, 125, 80));
			array_push($this->ships, new Ship(1, 3, 120, 80));
		}
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
}

?>
