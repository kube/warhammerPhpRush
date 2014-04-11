<?php

session_start();
require_once "Class/Game.class.php";

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH'])
	&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
{
	$game = unserialize($_SESSION['game']);
	// $game->player1->ships[0]->direction++;
	// $game->player1->ships[0]->direction %= 4;
	$game->player1->ships[0]->moveUp(1);
//	$game->player1->ships[0]->position['y']--;
	// $game->player1->ships[0]->rotateLeft();
	$_SESSION['game'] = serialize($game);
	echo $game;
}

?>
