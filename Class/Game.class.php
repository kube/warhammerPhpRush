<?php

require_once "Board.class.php";
require_once "Player.class.php";

class Game
{
	protected			$_currentPlayer;
	public				$player1;
	public				$player2;
	protected			$_board;

	public function		__construct()
	{
		$this->_currentPlayer = rand(1, 2);
		$this->_board = new Board(150, 100);
		$this->player1 = new Player(1);
		$this->player2 = new Player(2);
	}


	private function 	between($val ,$b1 , $b2)
	{
		if ($b2 < $b1)
		{
			if ($val >= $b2 && $val < $b1)
				return True;
		}
		else if ($val >= $b1 && $val < $b2)
			return True;

		return False;
	}			

	private function 	rotateWidth($width, $height, $direction)
	{
		if ($direction == 1)
			return (-$height);
		else if ($direction == 2)
			return (-$width);
		else if ($direction == 3)
			return ($height);
		else
			return ($width);
	}

	private function 	rotateHeight($height, $width, $direction)
	{
		if ($direction == 1)
			return ($width);
		else if ($direction == 2)
			return (-$height);
		else if ($direction == 3)
			return (-$width);
		else
			return ($height);
	}

	private function	isShipInSquare($ship, $i, $j)
	{
		$width = $this->rotateWidth($ship->width, $ship->height, $ship->direction);
		$height = $this->rotateHeight($ship->height, $ship->width, $ship->direction);

		if ($this->between($i, $ship->position['x'], $ship->position['x'] + $width)
			&& $this->between ($j, $ship->position['y'], $ship->position['y'] + $height))
			return True;
		else
			return False;
	}

	private function	displaySquare($square, $i, $j)
	{
		echo "<div class='boardSquare";
		foreach ($this->player1->ships as $ship)
		{
			if ($this->isShipInSquare($ship, $i, $j))
				echo " ship player1' onclick='player1();";
		}
		foreach ($this->player2->ships as $ship)
		{
			if ($this->isShipInSquare($ship, $i, $j))
				echo " ship player2' onclick='player2();";
		}
		echo "'></div>";
	}

	public function		displayBoard()
	{
		echo "<div id='board'>";
		foreach ($this->_board->grid as $j => $line)
		{
			echo "<div class='boardLine'>";
			foreach ($line as $i => $square)
			{
				// echo "$i $j <br>";
				$this->displaySquare($square, $i, $j);
			}
			echo "</div>";
		}
		echo "</div>";
	}	

}

?>
