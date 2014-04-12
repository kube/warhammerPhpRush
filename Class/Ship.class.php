<?php

require dirname(__FILE__)."/../lib/shipGetLimits.php";

class Ship
{
	public				$width;
	public				$height;
	public				$position;
	public				$direction;	// 0, 1, 2, 3
	public				$endurance;
	public 				$move;
	public				$power;
	public				$PV;

	public function		__construct($width, $height, $x, $y, $direction)
	{
		$this->width = $width;
		$this->height = $height;
		$this->direction = $direction;
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

	public function		getLimits($rotate)
	{
		$width = $this->width;
		$height = $this->height;

		if ($this->direction % 2 XOR $rotate)
			list($width, $height) = array($height, $width);
		$limits = array();
		$limits['x0'] = intVal($this->position['x'] - $width / 2);
		$limits['x1'] = intVal($this->position['x'] + $width / 2);
		$limits['y0'] = intVal($this->position['y'] - $height / 2);
		$limits['y1'] = intVal($this->position['y'] + $height / 2);
		return($limits);
	}

	public function		checkOverflow($action)
	{
		global $game;

		$limits = $this->getLimits();
		if ($limits['x0'] < 0 || $limits['x1'] > $game->board->width)
			return True;
		if ($limits['y0'] < 0 || $limits['y1'] > $game->board->height)
			return True;
		return False;
	}

	public function		colision($action){
		if ($action == "RotateLeft" || $action == "RotateRight"){
			if ($this->direction == 1 || $this->direction == 3){
				for ($j = $this->position['y'] - $this->width * 1.5 ; $j <= $this->position['y'] - $this->width * 0.5 ; $j++){
					for ($i = $this->position['x']  - $this->height / 2 ; $i <= $this->position['x'] + 0.5 * $this->height ; $i++){
						if ($GLOBALS['game']->board->grid[$j][$i] != 0)
							return false;
					}
				}
				for ($j = $this->position['y'] + $this->width * 0.5; $j <= $this->position['y'] + $this->width * 1.5 ; $j++){
					for ($i = $this->position['x'] - $this->height / 2 ; $i <= $this->position['x'] + 0.5 * $this->height ; $i++){
						if ($GLOBALS['game']->board->grid[$j][$i] != 0)
							return false;
					}
				}
			}
			else
			{
				// Rotate with direction 0 or 2
			}
		}
		else
		{
			switch ($this->direction)
			{
				case 0:
					$j = $this->position['y'] - $this->height / 2;
					for ($i = $this->position['x'] - $this->width / 2; $i < $this->position['x'] + 0.5 * $this->width ; $i++){
						if ($GLOBALS['game']->board->grid[$j][$i] != 0)
							return false;
					}
					break;
				case 1:
					$i = $this->position['x'] - $this->height / 2;
					for ($j = $this->position['y'] - $this->whidth / 2; $j < $this->position['y'] + $this->width / 2 ; $i++){
						if ($GLOBALS['game']->board->grid[$j][$i] != 0)
							return false;
					}
					break;
				case 2:
					$j  = $this->position['y'] + $this->height / 2;
					for ($i = $this->position['x'] - $this->width / 2; $i < $this->position['x'] + 0.5 * $this->width ; $i++){
						if ($GLOBALS['game']->board->grid[$j][$i] != 0)
							return false;
					}
					break;
				case 3:
					$i = $this->position['x'] + $this->height / 2;
					for ($j = $this->position['y'] - $this->whidth / 2; $j < $this->position['y'] + $this->width / 2 ; $i++){
						if ($GLOBALS['game']->board->grid[$j][$i] != 0)
							return false;
					}
					break;
				default:
					break;
			}
		}
		return true;
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
		$this->direction++;
		$this->direction %= 4;
	}

	public function		rotateRight()
	{
		$this->direction += 4;
		$this->direction--;
		$this->direction %= 4;
	}
}

?>
