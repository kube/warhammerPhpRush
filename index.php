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
						url: 'ajax/refresh',
						success: function(output, status, xhr)
						{
							console.log(output);
							game = JSON.parse(output);
							refreshMap();
						}
					});
			});
		}

	</script>
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
