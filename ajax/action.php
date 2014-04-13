<?php

session_start();
require_once "../Class/Game.class.php";

$action = $_GET['action'];
$param1 = $_GET['param1'];


if(!empty($_SERVER['HTTP_X_REQUESTED_WITH'])
	&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
{
	$game = unserialize($_SESSION['game']);
	
	switch ($action)
	{
		case "MoveUp":

			break;
	}

	echo $game;
	$_SESSION['game'] = serialize($game);
}





//	RotateLeft
//	RotateRight
//	Fire
//	SelectShip
//	UnselectShip
//	FinishRound

?>
