<?php

class Ship
{
	private				$_game;
	public				$width;
	public				$height;
	public				$position;
	public				$direction;	// 0, 1, 2, 3
	public				$endurance;
	public 				$move;
	public				$power;
	public				$PV;

	public function		__construct($game, $width, $height, $x, $y)
	{
		$this->game = $game;
		$this->width = $width;
		$this->height = $height;
		$this->direction = 0;
		$this->move = 15;
		$this->position = array('x' => $x, 'y' => $y);
	}

	public function		__toString()
	{
		return "\t{\n"
			."\t\t\"direction\": ".$this->direction.",\n"
			."\t\t\"width\": ".$this->width.",\n"
			."\t\t\"height\": ".$this->height.",\n"
			."\t\t\"position\": {\"x\": ".$this->position['x'].", \"y\": ".$this->position['y']."}\n"
			."\t}\n";
	}

	public function		moveUp($nb)
	{
		if ($this->direction == 0)
			$this->position['x'] = $this->position['x'] + $nb;
		else if ($this->direction == 1)
			$this->position['y'] = $this->position['y'] - $nb;
		else if ($this->direction == 2)
			$this->position['x'] = $this->position['x'] - $nb;
		else if ($this->direction == 3)
			$this->position['y'] = $this->position['y'] + $nb;
		$this->move --;
	}

	public function		rotateLeft()
	{
		$this->direction = $this->direction + 1;
		$this->direction %= 4;
	}

	public function		rotateRight()
	{
		$this->direction += 4;
		$this->direction --;
		$this->direction %= 4;
	}
}

?>
