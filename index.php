<?php

session_start();
require_once "Class/Game.class.php";

?>
<html>
<head>
	<title>VoisinWar42K</title>
	<link rel="stylesheet" href="styles.css">
	<script language="javascript">

		function	initializeGame()
		{
			document.addEventListener("keydown", function(e)
			{
				if (e.ctrlKey && e.keyCode == 46)
				{
					window.location = "reset";
				}
			});
		}

		function	player1()
		{
			alert("Coucou le Player 2!");
		}

		function	player2()
		{
			alert("Coucou le Player 1!");
		}

	</script>
</head>
<body onLoad="initializeGame();">
<?php

if (!array_key_exists('game', $_SESSION))
	$_SESSION['game'] = serialize(new Game());

$game = unserialize($_SESSION['game']);
$game->player1->ships[0]->position['x']++;
$game->player1->ships[0]->position['y']--;

$game->displayBoard();


// Save Current Game
$_SESSION['game'] = serialize($game);

?>
</body>
</html>