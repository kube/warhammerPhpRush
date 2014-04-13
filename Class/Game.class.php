<?php

require_once "Board.class.php";
require_once "Player.class.php";

class Game
{
	private				$_nbPlayers;
	protected			$_currentPlayer;
	protected			$_selectedShip;
	public				$players;
	public				$board;

	public function		__construct($players)
	{
		$this->_nbPlayers = $players;
		$this->board = new Board(150, 100);

		$this->players = array();
		for ($i = 0; $i < $players; $i++)
			array_push($this->players, new Player($i + 1));

		$this->_currentPlayer =
			rand(1, 1000000) % count($this->players) + 1;

		if (isset($this->players[0]))
		{
			$this->players[0]->createShip(3, 10, 5, 10, 0);
			$this->players[0]->createShip(3, 10, 10, 10, 0);
			$this->players[0]->createShip(2, 7, 15, 10, 0);
			$this->players[0]->createShip(2, 7, 20, 10, 0);
			$this->players[0]->createShip(1, 3, 25, 10, 0);
			$this->players[0]->createShip(1, 3, 30, 10, 0);
		}
		
		if (isset($this->players[1]))
		{
			$this->players[1]->createShip(3, 10, 145, 90, 2);
			$this->players[1]->createShip(3, 10, 140, 90, 2);
			$this->players[1]->createShip(2, 7, 135, 90, 2);
			$this->players[1]->createShip(2, 7, 130, 90, 2);
			$this->players[1]->createShip(1, 3, 125, 90, 2);
			$this->players[1]->createShip(1, 3, 120, 90, 2);
		}
		
		if (isset($this->players[2]))
		{
			$this->players[2]->createShip(3, 10, 145, 10, 0);
			$this->players[2]->createShip(3, 10, 140, 10, 0);
			$this->players[2]->createShip(2, 7, 135, 10, 0);
			$this->players[2]->createShip(2, 7, 130, 10, 0);
			$this->players[2]->createShip(1, 3, 125, 10, 0);
			$this->players[2]->createShip(1, 3, 120, 10, 0);
		}
		
		if (isset($this->players[3]))
		{
			$this->players[3]->createShip(3, 10, 45, 90, 2);
			$this->players[3]->createShip(3, 10, 40, 90, 2);
			$this->players[3]->createShip(2, 7, 35, 90, 2);
			$this->players[3]->createShip(2, 7, 30, 90, 2);
			$this->players[3]->createShip(1, 3, 25, 90, 2);
			$this->players[3]->createShip(1, 3, 20, 90, 2);
		}
		$this->selectShip(0);
	}

	public function		selectShip($shipId)
	{
		$this->_selectedShip = intval($shipId);
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
		// return json_encode($this);

		return "{"
			.'"nbPlayers": '.$this->_nbPlayers.",\n"
			.'"currentPlayer": '.$this->_currentPlayer.",\n"
			.'"board": '.$this->board.",\n"
			.'"selectedShip": '.number_format($this->_selectedShip, 0).",\n"
			.'"players": '.json_encode($this->players)
			."}";
	}
}

?>
