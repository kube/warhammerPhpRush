<?php

session_start();
require_once "../Class/Game.class.php";

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH'])
	&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
{
	$game = unserialize($_SESSION['game']);
	echo $game;
}

?>
