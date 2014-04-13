
function addKeyListener()
{
	document.addEventListener("keydown", function(e)
	{
		console.log(e.keyCode);

		switch (e.keyCode)
		{
			case 46:
				if (e.ctrlKey)
					window.location = "reset";
				break;

			case 32:
				if (e.ctrlKey)
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
				break;

			case 38:
				moveShipUp(game.players[game.currentPlayer - 1].ships[game.selectedShip], 1);
				refreshMap();
				e.preventDefault();
				break;

			case 37:
				rotateShipLeft(game.players[game.currentPlayer - 1].ships[game.selectedShip]);
				refreshMap();
				e.preventDefault();
				break;

			case 39:
				rotateShipRight(game.players[game.currentPlayer - 1].ships[game.selectedShip]);
				refreshMap();
				e.preventDefault();
				break;

			case 13:
				game.currentPlayer = game.currentPlayer % 2 +1;
				game.selectedShip = null;
				refreshMap();
				break;

			case 70:
				if (game.selectedShip)
				{
					console.log("FIRE?");
					shipFire(getSelectedShip());
				}
				break;
		}
	});
}
