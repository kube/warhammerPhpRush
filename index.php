<?php

header("Location: http://e3r10p10.42.fr:8080/war");

session_start();
require_once "Class/Game.class.php";

?>
<html>
<head>
	<title>VoisinWar42K</title>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<link rel="stylesheet" href="styles.css">
	<link href="http://fonts.googleapis.com/css?family=Raleway:400,200" rel="stylesheet" type="text/css">
	<script src="scripts/keyboard.js"></script>
	<script src="scripts/initialize.js"></script>
	<script src="scripts/actions.js"></script>
</head>
<body onLoad="initializeGame();">
<div id="boardWrapper">
<h1 id="playerTurn">VoisinWar42K</h1>
<?php

if (!file_exists("1.game"))
	file_put_contents("1.game", serialize(new Game(4)));

$game = unserialize(file_get_contents("1.game"));
$game->displayBoard();

// Save Current Game
file_put_contents("1.game", serialize($game));

?>
</div>
</body>
</html>
