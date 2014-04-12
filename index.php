<?php

session_start();
require_once "Class/Game.class.php";

?>
<html>
<head>
	<title>VoisinWar42K</title>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<link rel="stylesheet" href="styles.css">
	<script src="scripts/game.js"></script>
</head>
<body onLoad="initializeGame();">
<div id="boardWrapper">
<?php

if (!array_key_exists('game', $_SESSION))
	$_SESSION['game'] = serialize(new Game());

$game = unserialize($_SESSION['game']);
$game->displayBoard();

// Save Current Game
$_SESSION['game'] = serialize($game);

?>
</div>
</body>
</html>
