<?php

class Ship
{
	public				$width;
	public				$height;
	public				$position;
	public				$direction;	// 0, 1, 2, 3

	public function		__construct($width, $height, $x, $y)
	{
		$this->width = $width;
		$this->height = $height;
		$this->direction = 3;
		$this->position = array('x' => $x, 'y' => $y);
	}

	public function 	moveUp(){
		if ($this->direction == 0)
			$this->position['x'] = $this->position['x'] + 1;
		else if ($this->direction == 1)
			$this->position['y'] = $this->position['y'] - 1;
		else if ($this->direction == 2)
			$this->position['x'] = $this->position['x'] - 1;
		else if ($this->direction == 3)
			$this->position['y'] = $this->position['y'] + 1;
	}

	public function 	rotateLeft(){
		$this->direction = $this->direction + 1;
		if ($this->direction > 3)
			$this->direction = 0;
	}

	public function 	rotateRight(){
		$this->direction = $this->direction - 1;
		if ($this->direction < 0)
			$this->direction = 3;
	}
}

?>
