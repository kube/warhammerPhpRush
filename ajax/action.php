<?php

session_start();
require_once "../Class/Game.class.php";

$action = $_GET['action'];

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH'])
	&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
{
	$game = unserialize(file_get_contents("../1.game"));
	
	switch ($action)
	{
		case "SelectShip":
			$game->selectShip($_GET['ship']);
			break;

		case "FinishRound":
			$game->finishRound();
			break;

		case "MoveUp":
			$game->getSelectedShip()->moveUp(1);
			break;
		
		case "RotateLeft":
			$game->getSelectedShip()->rotateLeft();
			break;

		case "RotateRight":
			$game->getSelectedShip()->rotateRight();
			break;

		case "Fire":
		{
			echo "Cire";
			$game->getSelectedShip()->fire();
		}
	}

	// echo $game;
	file_put_contents("../1.game", serialize($game));
}






//	Fire
//	UnselectShip
//	FinishRound

?>
