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

		case "MoveUp":

			break;
	}

	echo $game;
	file_put_contents("../1.game", serialize($game));
}





//	RotateLeft
//	RotateRight
//	Fire
//	SelectShip
//	UnselectShip
//	FinishRound

?>
