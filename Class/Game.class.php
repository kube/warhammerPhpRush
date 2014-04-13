<?php

require_once "Board.class.php";
require_once "Player.class.php";

class Game
{
	protected			$_currentPlayer;
	public				$player1;
	public				$player2;
	public				$board;

	public function		__construct($players)
	{
		$this->board = new Board(150, 100);

		$this->players = array();
		for ($i = 0; $i < $players; $i++)
			array_push($this->players, new Player($i + 1));

		$this->_currentPlayer =
			rand(1, 1000000) % count($this->players) + 1;

		$this->players[0]->createShip(3, 10, 5, 10, 0);
		$this->players[0]->createShip(3, 10, 10, 10, 0);
		$this->players[0]->createShip(2, 7, 15, 10, 0);
		$this->players[0]->createShip(2, 7, 20, 10, 0);
		$this->players[0]->createShip(1, 3, 25, 10, 0);
		$this->players[0]->createShip(1, 3, 30, 10, 0);

		$this->players[1]->createShip(3, 10, 145, 90, 2);
		$this->players[1]->createShip(3, 10, 140, 90, 2);
		$this->players[1]->createShip(2, 7, 135, 90, 2);
		$this->players[1]->createShip(2, 7, 130, 90, 2);
		$this->players[1]->createShip(1, 3, 125, 90, 2);
		$this->players[1]->createShip(1, 3, 120, 90, 2);
	}

	private function	displaySquare($square, $i, $j)
	{
		echo "<div";
		echo " id='sq_x".$i."y".$j."'";
		echo " class='boardSquare";
		echo "'></div>";
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

	public function		__toString()
	{
		return "{"
			.'"currentPlayer": '.$this->_currentPlayer.",\n"
			.'"board": '.$this->board.",\n"
			.'"players": '.json_encode($this->players)
			."}";
	}
}

?>
