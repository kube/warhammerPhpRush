<?php

session_start();
require_once "Class/Game.class.php";

?>
<html>
<head>
	<title>VoisinWar42K</title>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<link rel="stylesheet" href="styles.css">
	<script language="javascript">

		function	initializeGame()
		{
			document.addEventListener("keydown", function(e)
			{
				console.log(e.keyCode);
				if (e.ctrlKey && e.keyCode == 46)
					window.location = "reset";
				if (e.ctrlKey && e.keyCode == 32)
					$.ajax({
						type: 'GET',
						url: 'ajax.php',
						success: function(output, status, xhr)
						{
							game = JSON.parse(output);
						}
					});
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
// $game->player1->ships[0]->position['x']++;
// $game->player1->ships[0]->position['y']--;
$game->player1->ships[0]->direction++;
$game->player1->ships[0]->direction %= 4;
$game->displayBoard();

// Save Current Game
$_SESSION['game'] = serialize($game);

?>
</body>
</html>
