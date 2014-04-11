<?php

require_once "Board.class.php";
require_once "Player.class.php";

class Game
{
	protected			$_currentPlayer;
	public				$player1;
	public				$player2;
	protected			$board;

	public function		__construct()
	{

		$this->_board = new Board(150, 100);
		$this->player1 = new Player(1);
		$this->player2 = new Player(2);
		$this->_currentPlayer = rand(1, 2);
	}

	private function 	between($val, $b1 , $b2)
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

		if ($this->between($i, $ship->position['x'] - $width / 2, $ship->position['x'] + $width / 2)
			&& $this->between($j, $ship->position['y'] - $height / 2, $ship->position['y'] + $height / 2))
			return True;
		else
			return False;
	}

	private function	displaySquare($square, $i, $j)
	{
		echo "<div";
		echo " id='sq_x".$i."y".$j."'";
		echo " class='boardSquare";
		echo "'></div>";
	}

	public function		__toString()
	{
		return "{"
			.'"currentPlayer": '.$this->_currentPlayer.",\n"
			.'"board": '.$this->board.",\n"
			.'"player1": '.$this->player1.",\n"
			.'"player2": '.$this->player2."\n"
			."}";
	}

	public function		displayBoard()
	{
		echo "<div id='board'>";
		foreach ($this->board->grid as $j => $line)
		{
			echo "<div id='line_".$j."' class='boardLine'>";
			foreach ($line as $i => $square)
				$this->displaySquare($square, $i, $j);
			echo "</div>";
		}
		echo "</div>";
	}	

}

?>
