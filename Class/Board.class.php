<?php

class Board
{
	public				$width;
	public				$height;
	public				$grid;

	public function		__construct($width, $height)
	{
		$this->width = intval($width);
		$this->height = intval($height);
		$this->grid = array();

		for ($i = 0; $i < $this->height; $i++)
			$this->grid[$i] = array_fill(0, $this->width, 0);
	}
}

?>
